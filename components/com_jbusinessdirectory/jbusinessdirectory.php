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
require_once JPATH_COMPONENT_ADMINISTRATOR.'/assets/defines.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/assets/utils.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/assets/logger.php';
JHtml::_('behavior.framework');

JHTML::_('stylesheet', 	'components/com_jbusinessdirectory/assets/css/common.css');
JHTML::_('stylesheet', 'administrator/components/com_jbusinessdirectory/assets/css/forms.css');
JHTML::_('stylesheet', 	'components/com_jbusinessdirectory/assets/css/responsive.css');
if(JBusinessUtil::isJoomla3()){
	JHtml::_('jquery.framework', true, true);
	define('J_JQUERY_LOADED', 1);
}else{
	if(!defined('J_JQUERY_LOADED')) {
		JHTML::_('script',  'components/com_jbusinessdirectory/assets/js/jquery.min.js');
		JHTML::_('script',  'components/com_jbusinessdirectory/assets/js/jquery-noconflict.js');
		define('J_JQUERY_LOADED', 1);
	}
}

JHTML::_('script', 	'components/com_jbusinessdirectory/assets/js/jquery.raty.min.js');
JHTML::_('script', 	'components/com_jbusinessdirectory/assets/js/jquery.blockUI.js');
JHTML::_('script', 	'components/com_jbusinessdirectory/assets/js/common.js');
JHTML::_('script', 	'administrator/components/com_jbusinessdirectory/assets/js/utils.js');

if( !defined('COMPONENT_IMAGE_PATH' ))
	define("COMPONENT_IMAGE_PATH", JURI::base()."components/".JRequest::getVar('option')."/assets/images/");
if( !defined( 'IMAGE_BASE_PATH') )
	define( 'IMAGE_BASE_PATH', (JURI::base()."administrator/components/".JBusinessUtil::getComponentName()));

JBusinessUtil::loadClasses();

$document  =JFactory::getDocument();
$document->addScriptDeclaration('
		var baseUrl="'.(JURI::base().'index.php?option='.JBusinessUtil::getComponentName()).'";
		var imageRepo="'.JURI::root().'administrator/components/com_jbusinessdirectory'.'";
		var imageBaseUrl="'.(JURI::root().PICTURES_PATH).'";		
		'
);

$session = JFactory::getSession();
//setting menu item Id
$app = JFactory::getApplication();
$menu = $app->getMenu();
$activeMenu = $app->getMenu()->getActive();

if (!empty($activeMenu) && $activeMenu != $menu->getDefault()) {
	$menuId = $activeMenu->id;
	$session->set('menuId', $menuId);
}

$menuId = $session->get('menuId');

$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();

if(!empty($appSettings->menu_item_id) && ($menuId == $menu->getDefault() || empty($menuId))){
	$menuId = $appSettings->menu_item_id;
}

if(!empty($menuId)){
	JFactory::getApplication()->getMenu()->setActive($menuId);
	JRequest::setVar('Itemid',$menuId);
}

$language = JFactory::getLanguage();
$language_tag 	= $language->getTag();

$x = $language->load(
		'com_jbusinessdirectory' , dirname(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jbusinessdirectory'.DS.'language') ,
		$language_tag,true );

$log = Logger::getInstance(JPATH_COMPONENT."/logs/site-log-".date("d-m-Y").'.log',1);

// Execute the task.
$controller	= JControllerLegacy::getInstance('JBusinessDirectory');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

