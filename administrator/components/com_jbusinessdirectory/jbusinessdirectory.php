<?php
/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_COMPONENT.'/assets/defines.php';
require_once JPATH_COMPONENT.'/assets/utils.php';
require_once JPATH_COMPONENT.'/assets/logger.php';

if(JBusinessUtil::isJoomla3()){
	JHtml::_('jquery.framework', true, true);
}else{
	JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.min.js');
}
JHtml::_('stylesheet', 'administrator/components/com_jbusinessdirectory/assets/css/general.css');
JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/common.js');
JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.selectlist.js');
JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/jquery.blockUI.js');
JHtml::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/utils.js');
JHtml::_('stylesheet', 'administrator/components/com_jbusinessdirectory/assets/css/forms.css');


if( !defined( '_PATH_IMG' ))
	define("_PATH_IMG", JURI::base()."components/".JRequest::getVar('option')."/assets/img/");

$log = Logger::getInstance(JPATH_COMPONENT."/logs/admin-log-".date("d-m-Y"),1);


$language = JFactory::getLanguage();
$language_tag 	= $language->getTag();

$x = $language->load(
		'com_jbusinessdirectory' , dirname(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jbusinessdirectory'.DS.'language') ,
		$language_tag,true );

JBusinessUtil::loadClasses();

$document  = JFactory::getDocument();
$document->addScriptDeclaration('
		window.onload = function()	{
		jQuery.noConflict();
			
};
		var baseUrl="'.(JURI::base().'index.php?option='.JBusinessUtil::getComponentName()).'";
		var imageRepo="'.JURI::root().'administrator/components/com_jbusinessdirectory'.'";
		var imageBaseUrl="'.(JURI::root().PICTURES_PATH).'";
			
		'
);
if( !defined( 'IMAGE_BASE_PATH') )
	define( 'IMAGE_BASE_PATH', (JURI::base()."components/".JBusinessUtil::getComponentName()));

// Execute the task.
$controller	= JControllerLegacy::getInstance('JBusinessDirectory');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
