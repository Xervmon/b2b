<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

//jimport('joomla.html.parameter');

class XiParameter extends JRegistry {
    /**
	 * 
	 * @param $data
	 * @param $format
	 */
	function bind($data, $format='JSON')
	{
		if ( is_array($data) ) {
			return $this->loadArray($data);
		} 
		
		if ( is_object($data)) {
			return $this->loadObject($data);
		}
		
		return $this->loadString($data, $format);
	}
	
}
