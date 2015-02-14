<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	Limit Subscription
* @contact		payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Payplans Limit Subscription Plugin
 *
 */
class plgPayplansLimitsubscription extends XiPlugin
{

	public function onPayplansSystemStart()
	{
		//add app path to app loader
		$appPath = dirname(__FILE__).DS.'limitsubscription'.DS.'app';
		PayplansHelperApp::addAppsPath($appPath);

		return true;
	}
	
	function onPayplansOrderBeforeSave($previous=null, $current=null)
	{
		$user = $current->getBuyer(true);
		
		if($user->isAdmin()){
				return false;
		}
		
		$option 	= JRequest::getVar('option');
		$view   	= JRequest::getVar('view');
		$task 		= JRequest::getVar('task', null);
		$plan_id 	= JRequest::getVar('plan_id');
		
		if($option != 'com_payplans' || ($view != 'plan') || ($task != 'subscribe') || empty($plan_id)){
			return false;
		}
        
        if(!$this->_isUserAllowed($user, $plan_id)){
			$message = XiText::_('COM_PAYPLANS_APP_LIMIT_SUBSCRIPTION_NOT_ALLOWED_TO_SUBSCRIBE_THIS_PLAN');
			XiFactory::getApplication()->redirect(XiRoute::_('index.php?option=com_payplans&view=dashboard&task=frontview'),$message);
		}
		return true;
		
	}

	
	function _isUserAllowed($user, $planId)
	{
		
		$apps  = PayplansHelperApp::getAvailableApps('limitsubscription');
		$plans = array();
		
		foreach ($apps as $app){
			$app_plans = is_array($app->_appplans) ? $app->_appplans : array($app->_appplans);
			$subscriptionCount = 0;

			if($app->getParam('applyAll', false) || in_array($planId, $app_plans)){
				$limit = $app->getAppParam('limit', 0);
				$param_status = $app->getAppParam('consider_status', null);
				$consider_status = is_array($param_status) ? $param_status : array($param_status);
				
				//fetch user's subscribed plans as per consider status
				foreach ($consider_status as $status){
					$plans = $user->getPlans($status);
					// when there are no plans then blank array returned so ignore that
					// and count subscription of the plan for which app is triggered
					if(!empty($plans) && in_array($planId, $plans)){
						$user_plans = array_count_values($plans);
						$subscriptionCount += $user_plans[$planId];
					}
				}
				
				//if counter is reached then redirect user to dashboard
				if($subscriptionCount >= $limit){
					return false;
				}
			}
		}
		
		return true;
	}
	
	public function onPayplansViewBeforeRender(XiView $view, $task)
	{	
		// when try to confirm order
		if(($view instanceof PayplanssiteViewInvoice) && $task == 'confirm'){
			
			$invoiceId = $view->getModel()->getId();
			$invoice   = PayplansInvoice::getInstance($invoiceId);
			$plans 	   = $invoice->getPlans();
			$plan  	   = array_pop($plans);

			if(!isset($plan)){
				return true;
			}
			
			$order = $invoice->getReferenceObject(PAYPLANS_INSTANCE_REQUIRE);
			$invoiceCount  = count($order->getInvoices(PayplansStatus::INVOICE_PAID));
			$upgradingFrom = $order->getParam('upgrading_from',0);
			if(!$upgradingFrom && $invoiceCount > 0){ // if not upgrading or but renewing subscription so allow to renew
				return true;
			}
			
			$user = $invoice->getBuyer(PAYPLANS_INSTANCE_REQUIRE);
			if(!$this->_isUserAllowed($user, $plan)){
				$order->delete();
				
				$message = XiText::_('COM_PAYPLANS_APP_LIMIT_SUBSCRIPTION_NOT_ALLOWED_TO_SUBSCRIBE_THIS_PLAN');
				XiFactory::getApplication()->redirect(XiRoute::_('index.php?option=com_payplans&view=dashboard&task=frontview'),$message);
			}
			
			return true;
		}

	}
	

}
