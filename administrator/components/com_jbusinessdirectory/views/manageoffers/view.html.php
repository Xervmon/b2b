<?php
/**
 * @copyright	Copyright (C) 2008-2009 CMSJunkie. All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );



class JBusinessDirectoryViewManageOffers extends JViewLegacy
{

	function display($tpl = null)
	{
		if(JRequest::getString( 'task') !='edit' && JRequest::getString( 'task') !='add'){
			JToolBarHelper::title(   'J-BusinessDirectory : '.JText::_('LNG_MANAGE_OFFERS'), 'generic.png' );
			JToolBarHelper::addNewX();
			JToolBarHelper::editList();
			JToolBarHelper::divider();
			JToolBarHelper::deleteList(JText::_('LNG_ARE_YOU_SURE_YOU_WANT_TO_DELETE'), 'Delete', 'Delete', 'Delete button', false, false );
			JToolBarHelper::divider();
			JToolBarHelper::custom( 'back', 'preview.png', 'preview.png', JText::_("LNG_CONTROL_PANEL"), false, false );
				
			$this->state		= $this->get('State');
			$this->statuses		= $this->get('Statuses');
			$this->states		= $this->get('States');
			
			$items		= $this->get('Datas');
			$this->assignRef('items', $items);
			
			$pagination = $this->get('Pagination');
			$this->assignRef('pagination', $pagination);

		}
		else
		{
			$item = $this->get('Data');
			$this->assignRef('item', $item);

			JToolBarHelper::title(   'J-BusinessDirectory : '.( JText::_("LNG_ADD_NEW") ).' '.JText::_('LNG_OFFER'), 'generic.png' );
			JRequest::setVar( 'hidemainmenu', 1 );
			JToolBarHelper::save(); 
			if($item->id > 0){
				JToolBarHelper::divider();
				JToolBarHelper::custom( 'aprove', 'publish.png', 'publish.png', JText::_("LNG_APROVE"), false, false );
				JToolBarHelper::custom( 'disaprove', 'unpublish.png', 'unpublish.png', JText::_("LNG_DISAPROVE"), false, false );
				JToolBarHelper::divider();
			}
			JToolBarHelper::cancel();
				
		}

		parent::display($tpl);
	}

}

