<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class  PayplansAppOfflinepay extends PayplansAppPayment
{
	protected $_location	= __FILE__;

	/**
	 * It will show the payment form
	 * @param $payment
	 * @param $post
	 */
	public function onPayplansPaymentForm(PayplansPayment $payment = null, $data=null)
	{
		return $this->_renderForm($payment);
	}
	
	public function _renderForm(PayplansPayment $payment = null, $form='form')
	{
		$invoice = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
		XiError::assert($invoice, XiText::_('COM_PAYPLANS_ERROR_INVALID_INVOICE_ID'));
		$this->assign('payment_key',$payment->getKey());

		$formDetail= $payment->getModelform()->getForm($payment);
		
		$transPath = dirname($this->_location).DS.'transaction.xml';
		$formDetail->loadFile($transPath, false, '//config');
		$amountInfo = array('amount' => $invoice->getTotal(), 'currency' => $invoice->getCurrency('isocode'));
		$newData = array('gateway_params' => $amountInfo);
		$formDetail->bind($newData);
		
		$this->assign('transaction_html',$formDetail);

		$this->assign('posturl',XiRoute::_('index.php?option=com_payplans&view=payment&task=complete&payment_key='.$payment->getKey()));
		return $this->_render($form);
	}
	
	public function onPayplansPaymentAfter(PayplansPayment $payment, &$action, &$data, $controller)
	{
		XiError::assert(is_array($data) , XiText::_('COM_PAYPLANS_ERROR_INVALID_DATA_ARRAY'));

		if(isset($data['Payplans_form']['gateway_params']) == false)
			return false;

		// if required data is not set then return false
		if(isset($data['Payplans_form']['gateway_params']['amount']) == false)
			return false;

		//append offline app parameter as well in the gateway params
		$appParameter 				= 	$payment->getApp(PAYPLANS_INSTANCE_REQUIRE)->getAppParams()->toArray();
		$data['Payplans_form']['gateway_params']		= 	array_merge($appParameter, $data['Payplans_form']['gateway_params']);
		$appData['gateway_params']  = 	PayplansHelperParam::arrayToIni($data['Payplans_form']['gateway_params']);

		// initiate the payment only if action equals to success else status remains none
		if($action == 'success'){
			$payment->bind($appData)->save();
			
			$invoice = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
			// get the transaction instace of lib
			$transaction = PayplansTransaction::getInstance();
			$transaction->set('user_id', $payment->getBuyer())
						->set('invoice_id', $invoice->getId())
						->set('payment_id', $payment->getId())
						->set('amount', 0)
						->set('gateway_txn_id', isset($data['Payplans_form']['gateway_params']['id']) ? $data['Payplans_form']['gateway_params']['id'] : 0)
						->set('gateway_subscr_id', 0)
						->set('gateway_parent_txn', 0)
						->set('params', PayplansHelperParam::arrayToIni($data['Payplans_form']['gateway_params']))
						->set('message',XiText::_('COM_PAYPLANS_APP_OFFLINE_TRANSACTION_CREATED_FOR_INVOICE'))
						->save();
			return true;
		}		
	}
	
	public function onPayplansTransactionRecord(PayplansTransaction $transaction = null)
	{
		$payment = $transaction->getPayment(PAYPLANS_INSTANCE_REQUIRE);
		
		//if gateway parameter exists then display in the transaction record
		if($payment->getGatewayParams()){
			$this->assign('transaction_html', $payment->getGatewayParams()->toArray());
			
			return $this->_render('transaction');
		}	
	}
	
	public function onPayplansTransactionBeforeSave($prev, $new)
	{
		//perform the below task only once,
		//i.e. only when new transaction has been created
		if($prev != null){
			return true;
		}
		
		$param = PayplansHelperParam::iniToArray($new->getParams());
		
		//if gateway transaction id is not mentioned then 
		//fetch the txn id from payment params and set as gateway txn id
		$gatewayTxnId = $new->get('gateway_txn_id', '');
		
		if(empty($gatewayTxnId) && !empty($param) && $param['id']){
			$new->set('gateway_txn_id', $param['id']);
		}
		$message    = $new->get('message','');
		if(empty($message)){
			$new->set('message', 'COM_PAYPLANS_APP_OFFLINE_TRANSACTION_CREATED');
		}
		
		return true;
	}
	
	public function onPayplansPaymentTerminate(PayplansPayment $payment, $controller)
	{
		parent::onPayplansPaymentTerminate($payment, $controller);
		return $this->_render('cancel');
	}

	public function onPayplansTransactionAfterSave($prev, $new)
	{
		if(XiFactory::getApplication()->isAdmin() || !$this->getAppParam('notify_users', false)){
			return true;
		}
		
		$payment = $new->getPayment(true);
	
		$data 		      = array();
		$config			  = XiFactory::getConfig();
		$data['mailfrom'] = $config->mailfrom;
		$data['fromname'] = $config->fromname;
		$data['sitename'] = $config->sitename;
		$user 			  = $new->getBuyer(true);
		$data['email']    = $user->getEmail();
		$data['name']     = $user->getRealname();
		$data['username'] = $user->getUsername();
		$str			  = "";

		$emailSubject = XiText::_("COM_PAYPLANS_APP_OFFLINE_ADMIN_EMAIL_SUBJECT");
		$emailBody    = XiText::sprintf("COM_PAYPLANS_APP_OFFLINE_ADMIN_EMAIL_BODY", $data['sitename'],$data['name'],$data['email'],$data['username']);

		//send email to all the admins
		$mailer = XiFactory::getMailer();
		$rows   = XiHelperJoomla::getUsersToSendSystemEmail();
		foreach ($rows as $row){
			$mailer->setSender(array($data['mailfrom'],$data['fromname']))
				   ->addRecipient($row->email)
			       ->setSubject($emailSubject)
			       ->setBody($emailBody)
				   ->IsHTML(true);
			$mailer->Send();
		}

		$emailSubject = XiText::_("COM_PAYPLANS_APP_OFFLINE_USER_EMAIL_SUBJECT");
		$emailBody    = XiText::_("COM_PAYPLANS_APP_OFFLINE_USER_EMAIL_BODY");
		
		//create new instance again and send mail to customer, otherwise pervious object properties will create conflict
		$mailer = XiFactory::getMailer();
		$invoice = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);		

		//work only when plugin is enabled
		$plgEnable = XiHelperPlugin::getStatus('pdfinvoice','payplans');

		if($plgEnable == true && ($invoice instanceof PayplansInvoice)){
			list($instance, $attachment) = $this->_attachInvoice($invoice);
			if($attachment){
				$mailer->addAttachment($attachment);
			}
		}
		$mailer->setSender(array($data['mailfrom'],$data['fromname']))
			   ->addRecipient($user->getEmail())
		       ->setSubject($emailSubject)
		       ->setBody($emailBody)
			   ->IsHTML(true);

		if($mailer->Send()){
       		//delete the file created for attachment after sending email
			if(isset($instance) && ($instance instanceof plgPayplansPdfinvoice)){
				$instance->deleteUserFiles($invoice->getBuyer());
				JFactory::getSession()->set('pdfinvoice_lock',JFactory::getSession()->get('pdfinvoice_lock',0)-1);
			}
       }
	   return true;			   
	}

	protected function _attachInvoice($invoiceObject)
	{	
		//get instance of pdfinvoice plugin
		$pluginInst = XiHelperPlugin::getPluginInstance('payplans', 'pdfinvoice');
		
		JFactory::getSession()->set('pdfinvoice_lock',JFactory::getSession()->get('pdfinvoice_lock',0)+1);
		
		$pdfObject = $pluginInst->doSiteAction($invoiceObject->getKey());
		$pluginInst->createFolder($pdfObject, $invoiceObject->getKey(), $invoiceObject->getBuyer());

		$filePath = XiHelperJoomla::getPluginPath($pluginInst).DS.'pdfinvoices'.$invoiceObject->getBuyer();
		$filename = 'invoice'.$invoiceObject->getKey().'.pdf';
		
		//check whether file exists or not
		if(file_exists($filePath.DS.$filename)){
			return array($pluginInst, $filePath.DS.$filename);
		}
		
		return false;
	}
}
