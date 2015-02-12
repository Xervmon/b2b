<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	Profile Based Plans
* @author		Mohit Agrawal (mohit@readybytes.in) 
* @contact		payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Profile based Plans app
 */
class PayplansAppProfilebasedplan extends PayplansApp
{

 	//inherited properties
	protected $_location	= __FILE__;
	
	//just choose which XML file needs to be loaded
	public function getLocation()
	{
		static $location = '';
		
		if ( '' != $location ) {
			return $location;
		}

		$plugin 		= JPluginHelper::getPlugin('payplans','profilebasedplan');
		$params 	= new XiParameter();
		$params->bind($plugin->params);
		$profileUsed = $params->get('profile_used', 'joomla_usertype');
		 
		switch ( $profileUsed ) {
			
			case 'joomla_usertype' 		: $location = dirname(__FILE__).DS.'joomla_usertype'.DS; break;

            case 'jomsocial_profiletype' 	: $location = dirname(__FILE__).DS.'jomsocial_profiletype'.DS; break;

			case 'joomlaxi_profiletype' 	: $location = dirname(__FILE__).DS.'joomlaxi_profiletype'.DS; break;
			
			case 'easysocial_profiletype' : $location = dirname(__FILE__).DS.'easysocial_profiletype'.DS; break;
			
			default 					: $location = parent::getLocation();
		}
		
		return $location;
	}
	
}
