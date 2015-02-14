<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Terms of Services
* @contact 	payplans@readybytes.in
* 
*/
if(defined('_JEXEC')===false) die();

class PayplansAppTos extends PayplansApp
{
	protected $_location	= __FILE__;
	
	public function isApplicable($refObject = null, $eventName='')
	{
		 // On order screen we need to ask user ifnormation, 
		// during this subscriptoion is not active
		if($refObject instanceof PayplanssiteViewInvoice){
			$model = $refObject->getModel();
			if($model){
				$libInstance = XiLib::getInstance($refObject->getName(),$model->getId());
				return parent::isApplicable($libInstance,$eventName);
			}
		}
				
		return false;
	}

    public function collectAppParams(array $data)
	{
		// encode editor content
		if(isset($data['app_params']) && isset($data['app_params']['custom_content'])){
			$data['app_params']['custom_content'] = base64_encode($data['app_params']['custom_content']);
		}

		return parent::collectAppParams($data);
	}
}

