<?php /*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('script',  'components/com_jbusinessdirectory/assets/js/jquery.isotope.min.js');
JHTML::_('script',  'components/com_jbusinessdirectory/assets/js/isotope.init.js');
class JBusinessDirectoryViewSearch extends JViewLegacy
{

	function __construct()
	{
		parent::__construct();
	}
	
	
	function display($tpl = null)
	{
		$session = JFactory::getSession();
		$categoryId= $this->get('CategoryId');
		$searchkeyword = JRequest::getVar('searchkeyword');
		
		$this->companies = $this->get('CompaniesByNameAndCategory');
		$this->viewType = JRequest::getVar("view-type",LIST_VIEW);
		
		if(!empty($categoryId)){
			$this->categoryId=$categoryId;
			$category = $this->get('Category');
			
			if(isset($category) && count($category)>0)
				$this->category = $category[0];	
		}	
		
		$this->selectedCategories =  $this->get("SelectedCategories");
		$this->appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$this->categories = JRequest::getVar("categories");
		if(isset($searchkeyword)){
			$this->searchkeyword=  $searchkeyword;
		}
		
		$this->location = $this->get("Location");
		
		$this->radius= $session->get('radius');
		if($this->appSettings->enable_search_filter){
			$this->searchFilter = $this->get('SearchFilter');
		}
		$this->pagination = $this->get('Pagination');
		
		$this->orderBy = JRequest::getVar("orderBy", "packageOrder desc");
		
		$this->categorySearch = JRequest::getVar('categorySearch',null);
		$this->citySearch = JRequest::getVar('citySearch',null);
		$this->regionSearch = JRequest::getVar('regionSearch',null);
		$this->zipCode = JRequest::getVar('zipcode');
		
		$this->maincategories = $this->get("MainCategories");
		$this->subcategories = $this->get("SubCategories");
		
		parent::display($tpl);
	}
}
?>
