<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayplanssiteControllerInvoice extends XiController
{
	protected 	$_defaultTask = 'display';
	
	/*
	 * expects key instead of id
	 */
    protected   $_requireKey  = true;
    
	public function trigger($event=null,$args=null)
	{
		parent::trigger($event,$args);
	}
	
 	public function _updateUserId($userId)
	{
		try {
			//invoice
			$invoiceId = $this->getModel()->getId();
			$invoice   = PayplansInvoice::getInstance($invoiceId);
			
			// Order
			$invoice->setBuyer($userId)->save();
			$order = $invoice->getReferenceObject(true);
			           
			//modifier
			$modifiers = $invoice->getModifiers();
			foreach ($modifiers as $modifier)
			{
				$modifier->set('user_id',$userId)->save();
			}
			           
			// subscription
			$order->setBuyer($userId)->save();
			$order->getSubscription()->setBuyer($userId)->save();
			
			return true;
		}
		catch (Exception $e) {
			return false;
		}
	}
	
	//this function is added to check buyer is logged in user or not 
	public function _allowedViewInvoice($loggedInUser = 0,PayplansUser $buyer)
	{
		$buyerId = $buyer->getId();
		
		if($buyer->getUsername() == 'Not_Registered' && $buyerId != $loggedInUser){
			return $this->_updateUserId($loggedInUser);
		}
		
		if(XiHelperJoomla::isAdmin($loggedInUser) || $buyerId == $loggedInUser){
	        return true;
    	}
    	
    	return false;
	}
	
 	public function confirm($invoiceid = null, $userid = null, $appid = null)
    {
		$invoiceId 	   = (empty($invoiceid)) ? $this->getModel()->getId() : $invoiceid;
		
		//if invoice is not valid then redirect to plan page
		if(empty($invoiceId)){
			
        	$this->setMessage(XiText::_('COM_PAYPLANS_ORDER_PLEASE_SELECT_A_VALID_PLAN'));
            $this->setRedirect(XiRoute::_("index.php?option=com_payplans&view=plan"));
            
            return false;
		}		
		
		//session expired or not
		if($userid === null && $this->_checkSessionExpiry()==false){
			return false;
		}
		
		$userid     = (empty($userid)) ? XiFactory::getUser()->get('id') : $userid;

		//get the user_id from session because at time or new registration user is not activated
		if (empty($userid)){
			$userid = XiFactory::getSession()->get('REGISTRATION_NEW_USER_ID', 0);
		}
                    
		$invoice	= PayplansInvoice::getInstance($invoiceId);
		$plans 	   	= $invoice->getPlans();
		$planId  	= array_pop($plans);
		
		// Check Plan is valid or not
		if(PayplansHelperPlan::isValidPlan($planId) === false){			
			$this->setMessage(XiText::_('COM_PAYPLANS_ORDER_PLEASE_SELECT_A_VALID_PLAN'));
            $this->setRedirect(XiRoute::_("index.php?option=com_payplans&view=plan"));
            
            return false;
		}
		
		// if invoice is not attached to the logged-in user
		$buyer		= $invoice->getBuyer(PAYPLANS_INSTANCE_REQUIRE);

		if(!$this->_allowedViewInvoice($userid, $buyer)){
			$url = 'index.php?option=com_payplans&view=plan';
	        $this->setRedirect(XiRoute::_($url, false));
	        
	        return false;
	        
		}
               
        // if invoice is not confirmed by user then show the details of invoice and order
        $postVariables = JFactory::getApplication()->input;
        
        if($postVariables->get('payplans_invoice_confirm', 'BLANK') === 'BLANK'){
            $this->setTemplate(__FUNCTION__);
            return true;
        }

		//if invoice is for free plan or total amount to pay reduced to 0 on applying discount
        // then redirect to complete order page
        // XITODO : need to check where should redirect
      	if(floatval(0) == floatval($invoice->getTotal()) && !($invoice->isRecurring())){
      		
			//confirm order first
      		$invoice->setStatus(PayplansStatus::INVOICE_CONFIRMED)
      				->save();
      				
      		// get the transaction instace of lib
			$transaction = PayplansTransaction::getInstance();
			$transaction->set('user_id', $invoice->getBuyer())
						->set('invoice_id', $invoice->getId())
						->set('payment_id', 0)
						->set('message', 'COM_PAYPLANS_TRANSACTION_OF_FREE_SUBSCRIPTION')
						->save();
	    
					
			$this->setRedirect(XiRoute::_('index.php?option=com_payplans&view=invoice&task=thanks&invoice_key='.$invoice->getKey()));
			return false;
      	}

      	// XITODO : check wallet/ or  make payment
		// app_id is required for payment
      	$appId   = ($appid === null) ? $postVariables->get('app_id', 0) : $appid;
        XiError::assert($appId, XiText::_('COM_PAYPLANS_ERROR_INVALID_APP_ID'));

        //confirm order and create payment
        $invoice->confirm($appId);
        // get payemnt created
        $payment = $invoice->getPayment();

        $url = 'index.php?option=com_payplans&view=payment&task=pay&payment_key='.$payment->getKey();
        $this->setRedirect(XiRoute::_($url));
        return false;
	}
	
	public function display($cachable = false, $urlparams = false)
	{
		return $this->thanks();
	}

	public function thanks()
	{
		$userid     = (empty($userid)) ? XiFactory::getUser()->get('id') : $userid;

		//get the user_id from session because at time or new registration user is not activated
		if (empty($userid)){
			$userid = XiFactory::getSession()->get('REGISTRATION_NEW_USER_ID', 0);
		}

		$itemId = $this->getModel()->getId();

		if($itemId){
			$invoice = PayplansInvoice::getInstance($itemId);
			$buyerId	 = $invoice->getBuyer();

			if(XiHelperJoomla::isAdmin($userid) || $buyerId == $userid) {
				return true;
			}

			$url 		= XiRoute::_('index.php?option=com_payplans&view=dashboard');
			$message 	= XiText::_('COM_PAYPLANS_SUBSCRIPTION_CAN_NOT_VIEW_SUBSCRIPTION_OF_OTHERS_USER');

			XiFactory::getApplication()->redirect($url, $message, 'message');
			return false;
		}


		return false;
	}	
}
