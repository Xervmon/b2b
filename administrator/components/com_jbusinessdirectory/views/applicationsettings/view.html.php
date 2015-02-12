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
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php';
JHTML::_('stylesheet', 	'administrator/components/'.JBusinessUtil::getComponentName().'/assets/css/joomlatabs.css');


class JBusinessDirectoryViewApplicationSettings extends JViewLegacy
{
	
	function display($tpl = null)
	{
		$this->item			= $this->get('Data');
		
		$this->packageOptions = JBusinessDirectoryHelper::getPackageOptions();
		$this->attributeConfiguration = JBusinessDirectoryHelper::getAttributeConfiguration();
		
		JBusinessDirectoryHelper::addSubmenu('applicationsettings');
		parent::display($tpl);
		$this->addToolbar();
	}
	
	protected function addToolbar()
	{
		
		$canDo = JBusinessDirectoryHelper::getActions();
		$user  = JFactory::getUser();
		
		JToolBarHelper::title(JText::_('LNG_APPLICATION_SETTINGS'), 'generic.png' );
		
		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_jbusinessdirectory', 'core.create'))) > 0 )
		{
			JToolbarHelper::apply('applicationsettings.apply');
			JToolbarHelper::save('applicationsettings.save');
		}
		
		JToolBarHelper::cancel('applicationsettings.cancel');
		
		
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_jbusinessdirectory');
		}
	}
	
}