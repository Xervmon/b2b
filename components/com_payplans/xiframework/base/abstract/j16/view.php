<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class XiAbstractJ16View extends XiAbstractViewBase
{
	function setModel(&$model, $default = false)
	{
		 $this->_model = $model;
		 return $this;
	}
}

class XiAbstractView extends XiAbstractJ16View
{}
