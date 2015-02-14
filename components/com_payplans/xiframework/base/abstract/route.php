<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

abstract class XiAbstractRoute extends JRoute
{
	static protected $_prefix = false;
	/*
	 * just make default value of xhtml=false
	 */
	static function _route($url, $xhtml = false, $ssl = null)
	{
		$oldUrl = $url;
		
		if(XiFactory::getApplication()->isAdmin() == false
			&& XiFactory::getConfig()->https ){
			
				$routed = parent::_($url, $xhtml, 1);

				$ssl = JFactory::getConfig()->get('force_ssl');
				$ssl = intval($ssl);

				if (JString::strpos($oldUrl, 'view=payment') == false && $ssl !== 2) {
					$routed = JString::str_ireplace("https:", "http:", $routed);
				}
				elseif (JString::strpos($oldUrl, 'view=payment') !== false && JString::strpos($oldUrl, 'task=complete') !== false && $ssl !== 2) {
					$routed = JString::str_ireplace("https:", "http:", $routed);
				}

				return $routed;
		}

		return parent::_($url, $xhtml);
	}
	
	static public function _($url, $xhtml = false, $ssl = null)
	{
		return self::_route($url, $xhtml, $ssl);
	}
}


