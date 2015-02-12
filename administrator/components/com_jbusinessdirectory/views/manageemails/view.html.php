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



class JBusinessDirectoryViewManageEmails extends JViewLegacy
{
	function display($tpl = null)
	{
		if( 
			JRequest::getString( 'task') !='edit' 
			&& 
			JRequest::getString( 'task') !='add' 
		) 
		{
			JToolBarHelper::title(  'J-BusinessDirectory : '. JText::_('LNG_MANAGE_EMAILS'), 'generic.png' );
			//JRequest::setVar( 'hidemainmenu', 1 );  
			JToolBarHelper::addNewX(); 
			JToolBarHelper::editList();
			JToolBarHelper::divider();
			JToolBarHelper::deleteList(JText::_('LNG_ARE_YOU_SURE_YOU_WANT_TO_DELETE'), 'Delete', 'Delete', 'Detele button', false, false );
			JToolBarHelper::divider();
			JToolBarHelper::custom( 'back', 'preview.png', 'preview.png', JText::_("LNG_CONTROL_PANEL"), false, false );
				
			
			$items		= $this->get('Datas'); 
			$this->assignRef('items', $items); 
			
		}
		else 
		{
		
			$item				= $this->get('Data'); 
			$this->assignRef('item', $item); 
		
			JToolBarHelper::title(   'J-BusinessDirectory : '.( $item->email_id > 0? JText::_("LNG_EDIT") : JText::_("LNG_ADD_NEW") ).' '.JText::_('LNG_EMAIL') , 'generic.png' );
			JRequest::setVar( 'hidemainmenu', 1 );  
			JToolBarHelper::save(); 
			JToolBarHelper::cancel();
		}
		parent::display($tpl);
	}
}