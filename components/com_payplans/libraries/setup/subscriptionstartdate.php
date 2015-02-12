<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		support+payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansSetupSubscriptionstartdate extends XiSetup
{
	public $_location = __FILE__;
	public $_message  = '';

	function isRequired()
	{
		$substartdate 	= XiHelperPlugin::getStatus('subscriptionstartdate','payplans');
		$subapproval 	= XiHelperPlugin::getStatus('subscriptionapproval','payplans');
		
 		if($substartdate == true && $subapproval == true){
 			$this->_message = 'COM_PAYPLANS_SETUP_SUBCRIPTIONSTARTDATE_BOTH_PLUGIN_ENABLED';
 			return $this->_required = true;
 		}
 		
	}

	function doApply()
	{
		XiFactory::getApplication()->redirect("index.php?option=com_plugins");
	}
}