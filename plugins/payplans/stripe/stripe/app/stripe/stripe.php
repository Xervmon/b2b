<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayplansAppStripe extends PayplansAppPayment
{
	protected $_location = __FILE__;

	public function isSupportPaymentCancellation($invoice)
	{
		if($invoice->isRecurring()){
			return true;
		}
		return false;
	}

	function onPayplansPaymentForm(PayplansPayment $payment, $data = null)
	{

		//if some error occured when click on buy but response is not successful then show error msg
    	$error_code = JRequest::getVar('error_code');
    	$error_msg  = JRequest::getVar('error_msg');
    	if(isset($error_code) && isset($error_msg)){
    		$invoice = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
    		$this->assign('error_code', $error_code);
    		$this->assign('error_msg',  $error_msg);
    		$this->assign('invoice',  	$invoice);
    		return $this->_render('buying_error');
    	}
		
		$paymentKey  = $payment->getKey();
		$this->assign('paymentKey', $paymentKey);
		$this->assign('publicKey',	$this->getAppParam('public_key',false));
		$this->assign('post_url', 	XiRoute::_("index.php?option=com_payplans&view=payment&task=complete&action=process&payment_key=$paymentKey"));

		return $this->_render('buyer_details');
	}

	function onPayplansPaymentAfter(PayplansPayment $payment, &$action, &$data, $controller)
	{		
		if($action == 'cancel'){
			return true;
		}

		if($action == 'process'){
		
			$url = $this->stripeProcessPayment($payment,$data);
			
			if($url === true)
			$url = XiRoute::_('index.php?option=com_payplans&view=payment&task=complete&payment_key='.$payment->getKey());
			
			XiFactory::getApplication()->redirect($url);
		}
		
		return parent::onPayplansPaymentAfter($payment, $action, $data, $controller);
	}


	public function stripeProcessPayment(&$payment,$data,$invoiceCount=1)
	{
		//all variables are handeled here
		self::loadStripeLibrary();
		
		$invoice = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
		//this need to be done because stripe accept payment only in cents
		$amount  = (($invoice->getTotal($invoiceCount))*100);
		
		if(!isset($data['stripeToken']) && !isset($data['process_payment']))
		{
			return XiRoute::_('index.php?option=com_payplans&view=payment&task=pay&error_msg=Invalid_Token&payment_key='.$payment->getKey());
		}
		try {
		$user		= $payment->getBuyer(PAYPLANS_INSTANCE_REQUIRE);
    	
		//create customer if not create other wise use previous one
		
		$customerId = $payment->getGatewayParams()->get('stripe_customer');
		
		$customer = (isset($customerId))?Stripe_Customer::retrieve($customerId):self::createCustomer($user,$data['stripeToken'],$payment);
		
		//we need to check here whether the plan 1 free trial + recurring or 2 free trial + recurring
		if ($amount == 0) {
			$response = new stdClass();
			$response->paid = true;
			$response->amount = 0;
		}
		else {
			$errors['error_code']	  = "";
			$errors['error_message']  = "";

			//then i need to create charge to this customer
			$response = Stripe_Charge::create(array(
					"amount" 		=> $amount,
					"currency" 	=> $invoice->getCurrency('isocode'),
					"customer"		=> $customer,
					"description" 	=> $payment->getKey()));
		}
		}
		catch (Exception $e)
		{
			//if some exception is occured then create an log and handle it 
			$username	= $user->getUsername();
			$userId		= $user->getId();
			//It is needed to create a log for wrong response
			$errors['error_code']	  = $e->getCode();
			$errors['error_message']  = sprintf(XiText::_('COM_PAYPLANS_APP_STRIPE_LOGGER_ERROR_IN_STRIPE_PAYMENT_PROCESS_DETAILS'),$e->getMessage(),$username,$userId,$invoice->getKey());
			
			$message = XiText::_('COM_PAYPLANS_APP_STRIPE_LOGGER_ERROR_IN_STRIPE_RESPONSE_INVALID');
			PayplansHelperLogger::log(XiLogger::LEVEL_ERROR, $message, $payment,$errors);
			$errors['error_message']  = $e->getMessage();
		}
		
		if(isset($response)){
			if($response->paid){
				//if it is paid then decrease recurrence count by one
				$recurrence_count = $payment->getGatewayParams()->get('pending_recur_count');
				if($recurrence_count != 0)
				{
					$recurrence_count--;
					$payment->getGatewayParams()->set('pending_recur_count',$recurrence_count);
					$payment->save();
				}
				
				$response 	= (is_object($response)) ? $response->__toArray() : $response;
				$result 	= $this->_stripeProcessPayment($payment, $response);
				
				return true;
	
			}else{
				$response 	= (is_object($response)) ? $response->__toArray() : $response;
				$errors['error_code']		= $response['failure_code'];
				$errors['error_message']	= $response['failure_message'];
			}
		}

		$url = "index.php?option=com_payplans&view=payment&task=pay&payment_key=".$payment->getKey()
				."&error_code=".$errors['error_code']."&error_msg=".urlencode($errors['error_message']); 

		return XiRoute::_($url);
	}

public function createCustomer(PayplansUser $user, $card, &$payment)
	{
		$username = $user->getUsername();
		$email 	  = $user->getEmail();
		$response = null;
		try{
			
			$response = Stripe_Customer::create(array(
										"description" => $username,
										"email" => $email,
										"card"	=> $card
			));
			
			$invoice       = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
			$recurringType = $invoice->isRecurring();
			
			if($recurringType){
				$recurrence_count = $invoice->getRecurrenceCount();
			
				switch ($recurringType)
				{
					case PAYPLANS_RECURRING_TRIAL_1: 	$recurrence_count++;break;
					case PAYPLANS_RECURRING_TRIAL_2:	$recurrence_count = $recurrence_count+2;break;
				}				
			}
			else
				$recurrence_count = 0;
				
			$payment->getGatewayParams()->set('pending_recur_count',$recurrence_count);
			$payment->getGatewayParams()->set('stripe_customer',$response->id);
			$payment->save();
			
			return $response;
		}
		catch (Exception $e){
			//what to do if customer is not create, may be card details are wrong
			$errors['error_code']	= $e->getCode();
			$errors['error_message']= $e->getMessage();
	
			$url = "index.php?option=com_payplans&view=payment&task=pay&payment_key=".$payment->getKey()
					."&error_code=".$errors['error_code']."&error_msg=".urlencode($errors['error_message']);

			$url = XiRoute::_($url);

			XiFactory::getApplication()->redirect($url);
		}
				
	}
	
	public function loadStripeLibrary()
	{
		$path = dirname(__FILE__).DS.'lib'.DS;
		include_once ($path."Stripe.php");
		Stripe::setApiKey($this->getAppParam('secret_key'));	
	}
	
	
	
	public function _stripeProcessPayment(PayplansPayment $payment, $data)
	{
		$invoice 		= $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
		$gatewayTxn_id 	= isset($data['id']) ? $data['id'] : 0;  

		foreach ($data as $key => $value){
			if($value instanceof Stripe_Object) {
				$value = $value->__toArray(); 
			}

			if(is_array($value))
			{
				unset($data[$key]);
				$data = array_merge($data,$value);
			}
		}	

    	// if same notification then epg gateway id is same as previous one then
    	// check if transaction already exists
    	// if yes then do nothing and return
    	$transactions = $this->_getExistingTransaction($invoice->getId(), $gatewayTxn_id, 0, 0);
    	if($transactions !== false){
    		foreach($transactions as $transaction){
    			$transaction = PayplansTransaction::getInstance($transaction->transaction_id, null, $transaction);
    			//if gateway txn id is same as previous one then reject it
    			if( $transaction->get('gateway_txn_id','') == $gatewayTxn_id){
    				return true;
    			}
    		}
    	}
    	
    	$user		= $payment->getBuyer(PAYPLANS_INSTANCE_REQUIRE);
    	$username	= $user->getUsername();
    	$userId		= $user->getId();
    	$invoiceId 	= $invoice->getId();
    	
		// get the transaction instace of lib
		$transaction = PayplansTransaction::getInstance();
		$transaction->set('user_id',$userId)
					->set('invoice_id',$invoiceId)
					->set('payment_id', $payment->getId())
					->set('gateway_txn_id', $gatewayTxn_id)
					->set('gateway_subscr_id', 0)
					->set('gateway_parent_txn', 0)
					->set('params', PayplansHelperParam::arrayToIni($data));
		
		// if response code is 0 then transaction is successful
		$amount = $data['amount']/100;		
	    if($data['paid']){
	    	$transaction->set('amount',$amount)
	    				->set('message', 'COM_PAYPLANS_APP_STRIPE_TRANSACTION_COMPLETED')
	    				->save();
	    	//XiFactory::getApplication()->redirect(XiRoute::_('index.php?option=com_payplans&view=payment&task=complete&payment_key='.$payment->getKey()));
		}		
		else
		{
			$transaction->set('amount',0)
						->set('message', 'COM_PAYPLANS_APP_STRIPE_TRANSACTION_NOT_COMPLETED')
	    				->save();
	    			
	    	$transactionKey = PayplansHelperUtils::getKeyFromId($transaction->getId());
	    	$invoiceKey		= PayplansHelperUtils::getKeyFromId($invoice->getId());
	    	
			$errors['response_code']	 = $data['failure_code'];
			$errors['response_message']  = sprintf(XiText::_('COM_PAYPLANS_APP_STRIPE_LOGGER_ERROR_IN_STRIPE_PAYMENT_PROCESS_DETAILS'),$data['failure_message'],$username,$userId,$invoice->getKey());
	    				
			$message = XiText::_('COM_PAYPLANS_APP_STRIPE_LOGGER_ERROR_IN_STRIPE_PAYMENT_PROCESS');
			PayplansHelperLogger::log(XiLogger::LEVEL_ERROR, $message, $payment, $errors);
			
			return false;	
		}

		return true;
	}
	
	//function after payment is done
	public function refundRequest(PayplansTransaction $transaction, $refund_amount)
	{
 		self::loadStripeLibrary();
		
		$chargeId 		= $transaction->getGatewayTxnId();
		$amount  		= ($refund_amount*100);

		
		try{		
			$chargeObj = Stripe_Charge::retrieve($chargeId);
			//$chargeObj->_apiKey = $this->getAppParam('secret_key',''); 
			
			$response = $chargeObj->refund(array("amount"=>$amount));
		}
		catch (Exception $e)
		{
			$user		= $transaction->getBuyer(PAYPLANS_INSTANCE_REQUIRE);
    		$username	= $user->getUsername();
    		$userId		= $user->getId();
    		$invoice 	= $transaction->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
			//It is needed to create a log for wrong response
			$errors['error_code']	  = $e->getCode();
			$errors['error_message']  = sprintf(XiText::_('COM_PAYPLANS_APP_STRIPE_LOGGER_ERROR_IN_STRIPE_PAYMENT_PROCESS_DETAILS'),$e->getMessage(),$username,$userId,$invoice->getKey());
			
			$message = XiText::_('COM_PAYPLANS_APP_STRIPE_LOGGER_ERROR_IN_STRIPE_RESPONSE_INVALID');
			PayplansHelperLogger::log(XiLogger::LEVEL_ERROR, $message, $transaction, $errors);
			
			return false;
		}
		
		if($response->paid && $response->refunded)
		{
			$data = $response->__tostring();
			$data = json_decode($data,true);
			
			foreach ($data as $key => $value){
				if(is_array($value))
				{
					unset($data[$key]);
					$data = array_merge($data,$value);
				}
			}	
			
			$paymentId = PayplansHelperUtils::getIdFromKey($response->description);
			$newtransaction = PayplansTransaction::getInstance();
			$newtransaction->set('user_id', 			$transaction->getBuyer())
							->set('invoice_id', 		$transaction->getInvoice())
							->set('payment_id',		 	$paymentId)
							->set('gateway_txn_id',	 	$response->id)
							->set('gateway_subscr_id', 	0)
							->set('gateway_parent_txn', 0)
							->set('params', 			PayplansHelperParam::arrayToIni($data));

			$negativeAmt = -($refund_amount);
		    $newtransaction->set('amount',$negativeAmt)
		    				->set('message', 'COM_PAYPLANS_APP_STRIPE_TRANSACTION_COMPLETED')
		    				->save();
			return true;
		}
		
		return false;
	}
	
	public function supportForRefund()
	{
		return true;
	}
	
	public function processPayment(PayplansPayment $payment, $invoiceCount)
	{
		$invoice = $payment->getInvoice(PAYPLANS_INSTANCE_REQUIRE);
		
		$lifetime = false;
		
		$lifetime = ($invoice->getRecurrenceCount() == 0)? true : false;
		
		$invoice_count = $invoiceCount +1;
			
		if($invoice->isRecurring())
		{			
			$recurrence_count 	= $payment->getGatewayParam('pending_recur_count');
			
			if($recurrence_count > 0 || $lifetime)
			{
				self::stripeProcessPayment($payment, array('process_payment'=>true),$invoice_count);	
			}
		}
	}

	public function onPayplansPaymentTerminate(PayplansPayment $payment, $invoiceController) 
	{
		parent::onPayplansPaymentTerminate($payment, $invoiceController);
		return $this->_render('subscription_cancel'); 
	}		
}
