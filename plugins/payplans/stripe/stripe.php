<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	stripe Payment App
* @contact		payplans@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Payplans Stripe Plugin
 */

class plgPayplansStripe extends XiPlugin
{
	public function onPayplansSystemStart()
	{
		$appPath = dirname(__FILE__).DS.'stripe'.DS.'app';
		PayplansHelperApp::addAppsPath($appPath);
	}
}
