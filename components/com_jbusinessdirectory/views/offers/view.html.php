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


JHtml::_('stylesheet', 'components/com_jbusinessdirectory/assets/css/categories.css');

JHTML::_('script',  'components/com_jbusinessdirectory/assets/js/jquery.isotope.min.js');
JHTML::_('script',  'components/com_jbusinessdirectory/assets/js/isotope.init.js');

class JBusinessDirectoryViewOffers extends JViewLegacy
{

	function __construct()
	{
		parent::__construct();
	}
	
	
	function display($tpl = null)
	{
		$categoryId= JRequest::getVar('categoryId');
		$this->assignRef('categoryId', $categoryId);
		
		if(isset($categoryId)){
			$this->categoryId=$categoryId;
			$category = $this->get('Category');
				
			if(isset($category) && count($category)>0)
				$this->category = $category[0];
		}
		
		$offers = $this->get('Offers');
		$this->assignRef('offers', $offers);
		//dump($offers);
		
		$categories = $this->get('Categories');
		$this->assignRef('categories', $categories);
		
		$this->orderBy = JRequest::getVar("orderBy", "");
		
		$this->appSettings =  JBusinessUtil::getInstance()->getApplicationSettings();
		if($this->appSettings->enable_search_filter_offers){
			$searchFilter = $this->get('SeachFilter');
			$this->assignRef('searchFilter', $searchFilter);
		}
		
		$pagination = $this->get('Pagination');
		$this->assignRef('pagination', $pagination);
		
		parent::display($tpl);
	}
}
?>
