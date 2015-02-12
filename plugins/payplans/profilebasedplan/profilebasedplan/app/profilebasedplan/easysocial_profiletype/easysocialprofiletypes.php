<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Profile Based Plans
* @author		Mohit Agrawal (mohit@readybytes.in) 
* @contact 		payplans@readybytes.in
*/

if(defined('_JEXEC')===false) die();

if ( ! class_exists('JFormFieldEasysocialProfiletypes') ) {

	class JFormFieldEasysocialProfiletypes extends XiField
	{
		public $type = 'EasysocialProfiletypes';
	
		function getInput()
		{
			if(!JFolder::exists(JPATH_SITE .DS.'components'.DS.'com_easysocial')){
				return XiText::_('COM_PAYPLANS_PLEASE_INSTALL_EASYSOCIAL_BEFORE_USING_THIS_APPLICATION');
			}
			
			$profiletypes = self::_getEasysocialProfiltypes();
			if(empty($profiletypes)){
				return XiText::_('COM_PAYPLANS_APP_EASYSOCIAL_NO_PROFILTYPE_EXISTS');
			}
			
			return XiHtml::_('autocomplete.edit', $profiletypes, $this->name, array('multiple' => false), 'id', 'title', $this->value);
		}
		
		protected static function _getEasysocialProfiltypes()
		{
			$db 	= PayplansFactory::getDBO();
	
			$query = 'SELECT *'
				 	. ' FROM #__social_profiles'
				 	. ' WHERE `state` = 1'
				 	;
		 	$db->setQuery( $query );
		 	return $db->loadObjectList('id');
		} 
	}
}