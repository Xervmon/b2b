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


JHtml::_('stylesheet', 	'components/com_jbusinessdirectory/assets/css/categories.css');

class JBusinessDirectoryViewEvents extends JViewLegacy
{

	function __construct()
	{
		parent::__construct();
	}
	
	
	function display($tpl = null)
	{
		$categoryId= JRequest::getVar('categoryId');
		$this->assignRef('categoryId', $categoryId);
		
		$this->appSettings =  JBusinessUtil::getInstance()->getApplicationSettings();
		
		$events = $this->get('Events');
		$this->assignRef('events', $events);
		//dump($events);
		
		$categories = $this->get('Categories');
		$this->assignRef('categories', $categories);
		
		if($this->appSettings->enable_search_filter_events){
			$serachFilter = $this->get('SeachFilter');
			$this->assignRef('searchFilter', $serachFilter);
		}
		
		$pagination = $this->get('Pagination');
		$this->assignRef('pagination', $pagination);
		

		parent::display($tpl);
	}
}
?>
