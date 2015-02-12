<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @contact		shyam@joomlaxi.com
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Payplans Registration JomSocial Plugin
 *
 * @package		Payplans
 * @subpackage	Plugin
 */
class  plgPayplansregistrationJomsocial extends XiPluginRegistration
{
	protected $_registrationUrl = 'index.php?option=com_community&view=register&fromPayplans=1';

	function _isRegistrationUrl()
	{
		$vars = $this->_getVars();
		// added task check since for resend activation code url is same except the task
		if($vars['option'] == 'com_community' && $vars['view'] == 'register' && $vars['task'] === 'BLANK'){
			return true;
		}
		
		return false;
	}
	
	
		protected function _doStartRegistration()
		  {
          
				  $compInfo =    XiAbstractHelperJoomla::getExtension('com_community');
				  
				  if(empty($compInfo) || array_shift($compInfo)->enabled == 0){
				      XiFactory::getApplication()->enqueueMessage(sprintf(XiText::_("COM_PAYPLANS_COMPONENT_NOT_FOUND_OR_DISABLED"), 'JomSocial'));
				      return parent::_doStartRegistration();
				  }
          
                      require_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php');
        
                       $planId = $this->_getPlan();
                       $this->_setPlan($planId);
                       $this->_session->set('fromPayplans', 1);
                       $this->_app->redirect(CRoute::_('index.php?option=com_community&view=register'));
                       return true;
       }
	
	function _isRegistrationCompleteUrl()
	{
		$vars = $this->_getVars();
		if($vars['option'] == 'com_community' && $vars['view'] == 'register' && $vars['task'] == 'registerSucess'){
			return true;
		}
		
		return false;
	}

	public function onPayplansGetPlugin()
	    {
	        $xml = dirname(__FILE__).DS.'jomsocial.xml';
	        if (file_exists($xml)) {
	                    $xmlContent = simplexml_load_file($xml);
	                }
	                else {
	                    $xmlContent = null;
	                }
	         return array('name'   => 'jomsocial', 
	                	  'value' =>$xmlContent);
	    }
	
	function onPayplansAccessCheck()
	{
		$vars = $this->_getVars(array('option', 'view', 'task', 'profileType'));
		
		$fromPayplans = $this->_session->get('fromPayplans', 0);
		
		if ($fromPayplans)
		{
			$this->_session->clear('fromPayplans');
		}
		
		if($vars['option'] == 'com_community' && $vars['view'] == 'register' && $vars['task'] == 'BLANK' && !($fromPayplans))
		{
			$this->_app->redirect(XiRoute::_("index.php?option=com_payplans&view=plan&task=subscribe", false));
		}
		
		// task is register when register through menu item
		if($vars['option'] == 'com_community' && $vars['view'] == 'register' && $vars['task'] == 'register' && !($fromPayplans))
		{
			$this->_app->redirect(XiRoute::_("index.php?option=com_payplans&view=plan&task=subscribe", false));
		}

		
		// Check when user is a new user for a site
		if($vars['option'] == 'com_community' && $this->_session->get('PAYPLANS_JS_FB_CONNECT_REG', false) == true){
			
			$this->_session->clear('PAYPLANS_JS_FB_CONNECT_REG');
			
			// if plan is not set then redirect to subscribe page
			if(!$this->_getPlan()){
				$this->_session->clear('PAYPLANS_JS_FACEBOOK_CONNECT_NEW_USER');
				$this->_app->redirect(XiRoute::_("index.php?option=com_payplans&view=plan&task=subscribe", false));
			}
						
				$this->_redirectToOrderConfirmPage();
			
			return true;
		}
		
		//Check when user is doing login to the site
		if($vars['option'] == 'com_community' && $this->_session->get('PAYPLANS_JS_FACEBOOK_CONNECT_LOGIN', false) == true){
			
			$this->_session->clear('PAYPLANS_JS_FACEBOOK_CONNECT_LOGIN');
			
			// if plan is not set then redirect to profile page
			if(!$this->_getPlan() && $this->_session->get('PAYPLANS_JS_FACEBOOK_CONNECT_NEW_USER', false) == false){
				$this->_session->clear('PAYPLANS_JS_FACEBOOK_CONNECT_NEW_USER');
			}
			
			return true;
		}
		
		//check for Facebook connect registration
		$func = JRequest::getVar('func', false);
		
		//this is for older versions of jmsocial
		if($vars['option'] == 'community' && $vars['task'] == 'azrul_ajax' && JString::strtolower($func) == 'connect,ajaxshownewuserform'){
			$this->_session->set('PAYPLANS_JS_FB_CONNECT_REG', true);
			$this->_session->set('PAYPLANS_JS_FACEBOOK_CONNECT_NEW_USER', true);
		}
		//this is for jmsocial 2.4
		if($vars['option'] == 'community' && $vars['task'] == 'azrul_ajax' && JString::strtolower($func) == 'connect,ajaxupdate'){
			$this->_session->set('PAYPLANS_JS_FACEBOOK_CONNECT_LOGIN', true);
		}
	}

	protected function _redirectToOrderConfirmPage()
	{
		$userId = $this->_getUser(); // set this user id if user is a new user
				
		if(empty($userId)){
		    $user = XiFactory::getUser();
		    $userId = $user->id; //set this user id if user is already registered with fb connect and doing just login.
		}
		
		    $order = PayplansPlan::getInstance( $this->_getPlan())
		                    ->subscribe($userId);            
		    
		$invoice     = $order->createInvoice();
		if($invoice instanceof PayplansInvoice)
		{
			$invoiceKey = $invoice->getKey();
				                    
			$this->_setUser(0);
			$this->_setPlan(0);
		
			// now redirect to confirm action
			$this->_app->redirect(XiRoute::_("index.php?option=com_payplans&view=invoice&task=confirm&invoice_key=".$invoiceKey));
		}
		else{
			$this->_app->redirect(XiRoute::_("index.php?option=com_payplans&view=plan&task=subscribe", false));
 		}
	}
	
	
	function onAfterRoute()
	{
		parent::onAfterRoute();
		
		if(isset(XiFactory::getConfig()->registrationType) && XiFactory::getConfig()->registrationType != $this->_name){
			return true;
		}
		
		$vars = $this->_getVars(array('option', 'view', 'task', 'profileType'));
		if($this->params->get('skip_ptype', 0) 
			&& $vars['option'] == 'com_community' && $vars['view'] == 'register' 
			&& $vars['task'] == 'registerProfileType'){	
		
				// default profile type
				$ptype = $this->params->get('jsmultiprofile', 0);
				
				// get all apps of jsmultiprofile
				$apps = XiFactory::getInstance('app', 'model')
								 ->loadRecords(array('type' => 'jsmultiprofile'));
				if(!empty($apps)){		 
					foreach($apps as $app){
						$appInstance = PayplansApp::getInstance($app->app_id, null, $app);
						
						// if app is applied to selected plan, on active status
						if($appInstance->getAppParam('jsmultiprofileOnActive') 
							&& ($appInstance->getAppParam('applyAll', 0) == true 
							    || in_array($this->_getPlan(), $appInstance->getPlans()))){
							
							// get ptype from app
							$ptype = $appInstance->getAppParam('jsmultiprofileOnActive', $this->params->get('jsmultiprofile', 0));
							break;
						}
					}
				}

			require_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php');
            $this->_app->redirect(CRoute::_('index.php?option=com_community&view=register&task=registerProfile&profileType='.$ptype));
		}
	}
	
	/** 
	 * @see XiPluginRegistration::_doCompleteRegistration()
	 * 
	 */
	protected function _doCompleteRegistration()
	{
		$ptype = $this->params->get('jsmultiprofile', 0);
		
		require_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php');
		
		$userId=$this->_getUser();
		$user = CFactory::getUser($userId);
		$user->set('_profile_id', $ptype);
		$user->save();
		
		// display a message regarding verification link email
		$usersConfig 	=  JComponentHelper::getParams( 'com_users' );
		$useractivation =  $usersConfig->get( 'useractivation' );
		
		if($useractivation == 1){
			$this->_app->enqueueMessage(XiText::_('PLG_PAYPLANSREGISTRATION_JOMSOCIAL_REGISTRATION_VERIFICATION_EMAIL_MSG'));
		}
		
		return parent::_doCompleteRegistration();
	}
}
