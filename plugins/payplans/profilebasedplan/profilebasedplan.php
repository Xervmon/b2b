<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	Profile Based Plan
* @author		Mohit Agrawal (mohit@readybytes.in)
* @contact		payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 *  Payplans Advace Sign up plans Plugin
 */
class plgPayplansProfilebasedplan extends XiPlugin
{

	/*
	 * Do not load when default plan plguin is enabled
	 */
    public function onPayplansSystemStart()
    {
        //add app path to app loader
        $appPath = dirname(__FILE__).DS.'profilebasedplan'.DS.'app';
        PayplansHelperApp::addAppsPath($appPath);

        return true;
    }
  
	// joomla 1.6 compatibility
	public function onUserBeforeSave($user, $isnew)
	{
		return $this->onBeforeStoreUser($user, $isnew);
	}

	/*
	 * if new user then maintain into session to avoid conflict with jspt process
	 */
	public function onBeforeStoreUser($user, $isnew)
	{
		if($isnew){
			XiFactory::getSession()->set('PLG_DEFAULT_PLAN_NEW_USER', true);
		}

		return true;
	}

	// Joomla 1.6 compatibility
	public function onAfterStoreUser($user, $new)	
	{
 	    return $this->onUserAfterSave($user, $new);
	}
	
	function onUserAfterSave($user, $new)
	{
		$newUser = XiFactory::getSession()->get('PLG_DEFAULT_PLAN_NEW_USER', false);
		if($newUser === true)
		{
			XiFactory::getSession()->set('PLG_NEW_USER_DATA', $user);
		}
		return true;
	}
	
	/*
	 * Do not load when default plan plguin is enabled
	 * Use default plan if no app is created
	*/
	function onAfterRoute()
	{
		//apply default subscription plan to new registered user
		$defaultPlan 	= $this->params->get('defaultPlan', 0); 
		$profileUsed 	= $this->params->get('profile_used', 'joomla_usertype');
		
		$newUser = XiFactory::getSession()->get('PLG_DEFAULT_PLAN_NEW_USER', false);
		$user = XiFactory::getSession()->get('PLG_NEW_USER_DATA');
	
		// Do Nothing in case of dummy user's craeted by Donation and oneclickCheckout App
		if('donor_registered' == strtolower($user['name']) || 'not_registered' == strtolower($user['name'])){
			return true;
		}

		//this is because when you save the user the xipt profile type is not available, so we need to store it.		
		if ('joomlaxi_profiletype' == $profileUsed) {
			$throughJSPT = JFactory::getSession()->has('SELECTED_PROFILETYPE_ID', 'XIPT');
			if ($throughJSPT) {
				$profile = JFactory::getSession()->get("SELECTED_PROFILETYPE_ID", null, "XIPT");
				JFactory::getSession()->set('SELECTED_PROFILETYPE_ID', $profile, 'PAYPLANS_PBP');
			}
		} 
		
		if (  !( $newUser === true && !empty($user) ) ){
			return true;
		}

        switch ( $profileUsed ) {

            case 'joomla_usertype' 			:	$userProfile = array_shift($user['groups']); break;

            case 'jomsocial_profiletype' 	:	$app = JFactory::getApplication();
		                                     	$userProfile = $app->input->get('profileType', 0);
		                                     	break;

            case 'joomlaxi_profiletype' 	:	$throughJSPT = JFactory::getSession()->has('SELECTED_PROFILETYPE_ID', 'PAYPLANS_PBP');
		    									$userProfile = 0;
												if ($throughJSPT) {
													$userProfile = JFactory::getSession()->get("SELECTED_PROFILETYPE_ID", null, "PAYPLANS_PBP");
													JFactory::getSession()->clear('SELECTED_PROFILETYPE_ID','PAYPLANS_PBP');
												}
												break;

            case 'easysocial_profiletype' 	:	$app = JFactory::getApplication();
			                                 	$userProfile = $app->input->get('id', 0);
			                                 	break;

            default 						:	$userProfile = array_shift($user['groups']);
        }

		$plansToApply = $this->getPlanToAssign($userProfile);
		
		//use default plan if no app is created
		if ( empty( $plansToApply ) ) {
			if ( 0 != $defaultPlan ) {
				$this->assignPlanToUser($defaultPlan, $user);
			}
			
			return true;
		}
		
		//if there are some plans to asssign then assing them
		foreach ( $plansToApply as $planId ) {
			$this->assignPlanToUser($planId, $user);
		}
		
		return true;
	}
	
	public function getPlanToAssign($userProfile)
	{
		$profilePlans = array();
		
		if (empty( $userProfile ) ) {
			return $profilePlans;
		}
				
		$apps = PayplansHelperApp::getAvailableApps('profilebasedplan');
		
		If (empty($apps) ) {
			return $profilePlans;
		}
		
		foreach ( $apps as $app ) {
			$profileType = $app->getAppParam('profile_type', array());
			$signupPlans = $app->getAppParam('signup_plans', array());
			
			foreach ($profileType as $profile ) {
				if ( isset( $profilePlans[$profile]) ) 
					$profilePlans[$profile] = array_merge($profilePlans[$profile], $signupPlans);
				else 
					$profilePlans[$profile] = $signupPlans;
			}
		}
		
		if (! isset( $profilePlans[$userProfile] ) ) {
			return array(); 
		} 
		
		return $profilePlans[$userProfile];
	}
	
	public function assignPlanToUser($plansId, $user)
	{
		XiFactory::getSession()->clear('PLG_DEFAULT_PLAN_NEW_USER');
		XiFactory::getSession()->clear('PLG_NEW_USER_DATA');
		
		$plan 		= PayplansPlan::getInstance($plansId);
		
		$order 	= $plan->subscribe($user['id'])->save();
		
		$invoice = $order->createInvoice();
		
		//apply 100% discount
		$modifier = PayplansModifier::getInstance();
		$modifier->set('message', XiText::_('COM_PAYPLANS_SIGNUP_PLAN_TO_USER_MESSAGE' ))
							->set('invoice_id', $invoice->getId())
							->set('user_id', $invoice->getBuyer())
							->set('type', 'signup_plan')
							->set('amount', -100) // 100 percent Discount, discount must be negative
							->set('percentage', true)
							->set('frequency', PayplansModifier::FREQUENCY_ONE_TIME)
							->set('serial', PayplansModifier::FIXED_DISCOUNT)
							->save();
			
		$invoice->refresh()->save();
			
		// create a transaction with 0 amount
		$transaction = PayplansTransaction::getInstance();
		$transaction->set('user_id', $invoice->getBuyer())
								->set('invoice_id', $invoice->getId())
								->set('message', 'COM_PAYPLANS_TRANSACTION_CREATED_FOR_SIGNUP_PLAN_TO_USER')
								->save();
		
		//trigger the event
		$args = array($transaction, 0);
		PayplansHelperEvent::trigger('onPayplansWalletUpdate', $args);
	}
}
