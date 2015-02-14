<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		support+payplans@readybytes.in

*/
if(defined('_JEXEC')===false) die();

class PayplansadminControllerSubscription extends XiController
{
	protected	$_defaultOrderingDirection = 'DESC';

	/**
	 * Saves an item (new or old)
	 */
	public function _save(array $data, $itemId=null, $type=null)
	{
		$callUpdateSubscription = 0;
		
		$subscription = PayplansSubscription::getInstance($itemId);
		
		if(!$itemId){
				// create order first and then subscription.
				$order = PayplansOrder::getInstance();
				$order->setBuyer($data['user_id'])
					->save();
					
				$subscription->setPlan($data['plan_id']);
				// unset the params data as $subscription has already have actual params.
				$data['order_id'] = $order->getId();
			}
			else {
				$order = $subscription->getOrder(true);
			}

		
		if(in_array($order->getStatus(), array(PayplansStatus::ORDER_HOLD, PayplansStatus::ORDER_CANCEL, PayplansStatus::ORDER_EXPIRED)))
		{
			$url = 'index.php?option=com_payplans&view=subscription';
			$msg = XiText::_('COM_PAYPLANS_SUBSCRIPTION_UPDATE_REFUND_SUBSCRIPTION');
			$this->setRedirect($url, $msg);
			return true;
		}
	
		if(in_array($subscription->getStatus(), array(PayplansStatus::NONE, PayplansStatus::SUBSCRIPTION_EXPIRED)) && 
			$data['status'] == PayplansStatus::SUBSCRIPTION_ACTIVE){
				$callUpdateSubscription= 1;
				$data['status'] = 0;
		}
				
		$subscription = $subscription->bind($data)->save();
		//now subscription is saved, refresh the order so that subscription changes can be reflected.
		$order->refresh()->save();
		if($callUpdateSubscription == 1){
			$this->updatesubscription($subscription->getId(), $order);	
		}	 

		return $subscription;
	}

	/*
	 * Attach plan with subscription
	 *
	 * If createNewOrder is true
	 *    1.a) user_id must be in post data
	 *    1.b) set this user id to user_id of subscription
	 * else
	 * 	  2.a) get order id  and load order
	 * 	  2.b) set buyer_id of order to user_id or subscription
	 *
	 * 3) create a plan for subscription
	 */

	public function edit($itemId = null)
	{
		$itemId = ($itemId === null) ? $this->getModel()->getId() : $itemId;
		$subscription = PayplansSubscription::getInstance( $itemId);
		$order 		  = PayplansOrder::getInstance();

		if(!$itemId){
			$planId = JRequest::getVar('plan_id',0);
			$subscription->setPlan(PayplansPlan::getInstance( $planId));

			$orderId = JRequest::getVar('order_id',0);
			$order = PayplansOrder::getInstance( $orderId);
			$plan = PayplansPlan::getInstance($planId);
			
			// if its a first subscription to the order
			// then change the currency of order 
			if($plan->getCurrency('isocode') != $order->getCurrency('isocode')) {
				$plans = $order->getPlans(PAYPLANS_INSTANCE_REQUIRE);
				if(!count($plans)){
					$order->set('currency', $plan->getCurrency('isocode'))->save();
				}
				else{
					$message = XiText::_('COM_PAYPLANS_ORDER_GRID_CURRENCY_MISMATCH_IN_ORDER_AND_PLAN');
					$url     = Xiroute::_('index.php?option=com_payplans&view=order');
					XiFactory::getApplication()->redirect($url, $message, 'warning');
				}
			}
			
			$subscription->set('order_id', $orderId);
			$subscription->set('user_id', $order->getBuyer());
		}

		$this->getView()->assign('subscription', $subscription);

		//set editing template
		$this->setTemplate('edit');
		return true;
	}
	
	public function extend($time = false, $subIds = array())
	{
		$time = JRequest::getVar('extend_time', $time);
		
		// if extend time is not set then show time
		if($time == false){
			$this->setTemplate('extend');
			return true;
		}
		
		$subIds = JRequest::getVar('cid', $subIds, 'request', 'array');
		 
		foreach($subIds as $id){
			$sub = PayplansSubscription::getInstance($id);
			// if subscription is expired 
			// then add expiration time from now
			// and activate the subscription
			if($sub->getStatus() == PayplansStatus::SUBSCRIPTION_EXPIRED){
				$sub->set('expiration_date', new XiDate());
				$sub->set('status', PayplansStatus::SUBSCRIPTION_ACTIVE);
			}
			
			$sub->set('expiration_date', $sub->getExpirationDate()->addExpiration($time));
			
			$sub->save();
		}
		
		$url = 'index.php?option=com_payplans&view=subscription';
		$this->setRedirect($url);
		
		return false;
	}
	
	function _remove($itemId=null, $userId=null)
	{
      if($itemId === null || $itemId === 0){
		$model = $this->getModel();
	    $itemId = $model->getId();
      }
	  $subscription = PayplansSubscription::getInstance($itemId);
	  PayplansOrder::getInstance($subscription->getOrder())->delete();

	  return true;
	}

	public function statusHelp()
	{
		$this->setTemplate('help');
		return true;
	}

	// Adds Invoice and Transaction If user activating subsctiption form Grid screen.
	public function update()
	{
		$name	= JRequest::getVar('name',	null);
		$value	= JRequest::getVar('value',	null);
		$itemId = $this->getModel()->getId();
		
		$subscription = PayplansSubscription::getInstance($itemId);
		$order 		   = PayplansSubscription::getInstance($itemId)->getOrder(PAYPLANS_INSTANCE_REQUIRE);

		// New status is ACTIVE then add fetch invoice and attch transaction.
		//Currently due to feature admin activate from grid screen, Invoice and transactions are created from admin pay.
		//So, in case of subscription approval app, Do not create invoice and transaction, 
		//case that Order is complete and Subscription is in Hold status.
		
		if(in_array($order->getStatus(), array(PayplansStatus::ORDER_HOLD, PayplansStatus::ORDER_CANCEL, PayplansStatus::ORDER_EXPIRED)))
			{
				$url = 'index.php?option=com_payplans&view=subscription';
				$msg = XiText::_('COM_PAYPLANS_SUBSCRIPTION_UPDATE_REFUND_SUBSCRIPTION');
				$this->setRedirect($url, $msg);
				return true;
			}
		
		
		if($itemId && $value == PayplansStatus::SUBSCRIPTION_ACTIVE && 
			in_array($subscription->getStatus(), array(PayplansStatus::NONE, PayplansStatus::SUBSCRIPTION_EXPIRED)))
		{
			$this->updatesubscription($itemId, $order);
		}
		return parent::update();
	}
	
	// Create Invoice & Transaction while activate subscription from backend
	public function updatesubscription($itemId, $order)
	{
		$invoices		 = $order->getInvoices();
			
		// Get Proper Object of Invoice.
		$recentInvoiceId = !empty($invoices)? max(array_keys($invoices)) : 0;
		$recentInvoice	 = !empty($recentInvoiceId) ? $invoices[$recentInvoiceId] : PayplansInvoice::getInstance();

		$invoiceStatus	 = array(PayplansStatus::INVOICE_CONFIRMED, PayplansStatus::NONE);
		// Case 1 : Subscription already have an invoice in PAID, REFUND or RECHARGE then no need to create a new invoice just add a Transaction on Recent Invoice.
		// Case 2 : Add Invoice and Transaction.
		if(($recentInvoiceId != 0) && in_array($recentInvoice->getStatus(), $invoiceStatus)){
			$transaction = $recentInvoice->addTransaction();
		}else{
			$transaction = $order->createInvoice()->addTransaction();
		}
			
	}

}
