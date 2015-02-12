<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	multiloginrestrcition
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansadminControllerLoginviolation extends PayplansadminControllerDashboard
{
	function violationChange()
	{
		return true;
	}
}