<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class XiAbstractJ35Factory extends XiAbstractFactoryBase
{
	/**
	 * @return XiSession
	 */
	static function getSession(array $options = array())
	{
		return parent::_getSession($options);
	}
}

class XiAbstractFactory extends XiAbstractJ35Factory
{}