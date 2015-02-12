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
if(!defined('J_JQUERY_UI_LOADED')) {
	JHtml::_('stylesheet', 'components/com_jbusinessdirectory/assets/css/jquery-ui.css');
	JHtml::_('script', 'components/com_jbusinessdirectory/assets/js/jquery-ui.js');

	define('J_JQUERY_UI_LOADED', 1);
}

class JBusinessDirectoryViewCategories extends JViewLegacy
{
	function display($tpl = null)
	{
		
		$categories = $this->get('Categories');
		$this->assignRef('categories', $categories);
		
		$this->appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		if($this->appSettings->category_view==1){
			$tpl="accordion";
		}else if($this->appSettings->category_view==3){
			$tpl="grid";
		}else{
			$tpl=null;
		}
		
		parent::display($tpl);

	}
}
?>
