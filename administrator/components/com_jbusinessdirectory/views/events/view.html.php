<?php
/**
 * @package    JBusinessDirectory
 * @subpackage  com_jbusinessdirectory
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * The HTML Menus Menu Menus View.
 *
 * @package    JBusinessDirectory
 * @subpackage  com_jbusinessdirectory

 */

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php';

class JBusinessDirectoryViewEvents extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		$this->statuses		= $this->get('Statuses');
		$this->states		= $this->get('States');
		
		JBusinessDirectoryHelper::addSubmenu('events');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$canDo = JBusinessDirectoryHelper::getActions();
		$user  = JFactory::getUser();
		
		JToolBarHelper::title(   'J-BusinessDirectory : '.JText::_('LNG_EVENTS'), 'generic.png' );
		
		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_jbusinessdirectory', 'core.create'))) > 0 )
		{
			JToolbarHelper::addNew('event.add');
		}
		
		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('event.edit');
		}
		
		if($canDo->get('core.delete')){
			JToolbarHelper::divider();
			JToolbarHelper::deleteList('', 'events.delete');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_jbusinessdirectory');
		}
		
		JToolbarHelper::divider();
		JToolBarHelper::custom( 'events.back', 'dashboard', 'dashboard', JText::_("LNG_CONTROL_PANEL"), false, false );
		JToolbarHelper::help('JHELP_COMPANIES');
	}
}
