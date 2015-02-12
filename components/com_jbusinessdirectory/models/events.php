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

jimport('joomla.application.component.modellist');
JTable::addIncludePath(DS.'components'.DS.JRequest::getVar('option').DS.'tables');
require_once( JPATH_COMPONENT_ADMINISTRATOR.'/library/category_lib.php');

class JBusinessDirectoryModelEvents extends JModelList
{ 
	
	function __construct()
	{
		parent::__construct();
		
		$this->searchFilter = array();
		
		$this->keyword = JRequest::getVar('searchkeyword');
		$this->categoryId = JRequest::getVar('categoryId');
		
		$this->categorySearch = JRequest::getVar('categorySearch');
		
		if($this->categorySearch!=''){	
			$this->categoryId = $this->categorySearch;
		}
		
		$mainframe = JFactory::getApplication();
		
		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		$this->enablePackages = $appSettings->enable_packages;
		$this->showPendingApproval = $appSettings->show_pending_approval;
	}

	
	function getTotalEvents()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$eventsTable = JTable::getInstance("Event", "JTable");
			$categoryService = new JBusinessDirectorCategoryLib();
			$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
			if(count($categoriesIds)== 0 && isset($this->categoryId)){
				$categoriesIds = array($this->categoryId);
			}
			
						
			$this->_total = $eventsTable->getTotalEventsByCategories($categoriesIds, $this->enablePackages, $this->showPendingApproval);
		}
		return $this->_total;
	}
	
	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotalEvents(), $this->getState('limitstart'), $this->getState('limit') );
			$this->_pagination->setAdditionalUrlParam('controller','search');
			if(isset($this->categoryId) && $this->categoryId!='')
				$this->_pagination->setAdditionalUrlParam('categoryId',$this->categoryId);
			$this->_pagination->setAdditionalUrlParam('categoryId',$this->categoryId);
			if(isset($this->categorySearch) && $this->categorySearch!='')
				$this->_pagination->setAdditionalUrlParam('categorySearch',$this->categorySearch);
			if(isset($this->keyword) && $this->keyword!='')
				$this->_pagination->setAdditionalUrlParam('searchkeyword',$this->keyword);

			$this->_pagination->setAdditionalUrlParam('view','events');
		}
		return $this->_pagination;
	}
	
	function getEvents(){
		
		$eventsTable = JTable::getInstance("Event", "JTable");
		$categoryService = new JBusinessDirectorCategoryLib();
		$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
		if(count($categoriesIds)== 0 && isset($this->categoryId)){
			$categoriesIds = array($this->categoryId);
		}
		
		return  $eventsTable->getEventsByCategories($categoriesIds, $this->enablePackages, $this->showPendingApproval, $this->getState('limitstart'), $this->getState('limit'));
	}
	
	function getSeachFilter(){
		
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime; 
    
		$eventsTable = JTable::getInstance("Event", "JTable");
		$categoryService = new JBusinessDirectorCategoryLib();
		
		$category=array();
		if(isset($this->categoryId)){
			$category = $categoryService->getCompleteCategoryById($this->categoryId);
		} else {
			$category["subCategories"] = $categoryService->getCategories();
			$category["path"]=array();
			//dump($category["subCategories"]);
		}
		//dump($category);
		$subcategories= array();
		$enableSelection = false;
		$this->searchFilter["path"]=$category["path"];
		if(isset($category["subCategories"]) && count($category["subCategories"])>0){
			$subcategories = $category["subCategories"];
		}else {
			$parentCategories = $category["path"];
			//dump($parentCategories);
			if(count($parentCategories)>0){
				$categoryId = $parentCategories[count($parentCategories)][0];	
				//dump($categoryId);
				$parentCategory = $categoryService->getCompleteCategoryById($categoryId);
				$subcategories = $parentCategory["subCategories"];
				$this->searchFilter["enableSelection"]=1;
				$enableSelection = true;
			}
		}	
		
		//dump($subcategories);
		if(isset($subcategories) && $subcategories!=''){
			foreach($subcategories as $cat){
				if(!is_array($cat))
					continue;
				$childCategoryIds = $categoryService->getCategoryChilds($cat);
				if(count($childCategoryIds)==0){
					$childCategoryIds = array($cat[0]->id);
				}
				//dump($childCategoryIds);
				$companiesNumber = $eventsTable->getTotalEventsByCategories( $childCategoryIds, $this->enablePackages, $this->showPendingApproval);
				//dump($companiesNumber);
				if($companiesNumber>0 || $enableSelection)
					$this->searchFilter["categories"][]=array($cat, $companiesNumber);
			}
		}
		
		$mtime = microtime();
	    $mtime = explode(" ",$mtime);
	    $mtime = $mtime[1] + $mtime[0];
	    $endtime = $mtime;
	    $totaltime = ($endtime - $starttime);
	    //echo "This function was done in ".$totaltime." seconds";
	    
	   // dump($this->searchFilter);
		return $this->searchFilter;
	}
	
	function getCategories(){
		$categoryService = new JBusinessDirectorCategoryLib();
		return $categoryService->getCategories();
		
	}	
	
	function getCategory(){
		$categoryTable = JTable::getInstance("Category", "JTable");
		return  $categoryTable->getCategoryById($this->categoryId);
	}
}
?>