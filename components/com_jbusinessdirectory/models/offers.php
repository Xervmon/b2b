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

class JBusinessDirectoryModelOffers extends JModelList
{ 
	
	function __construct()
	{
		parent::__construct();
		
		$this->searchFilter = array();
		
		$this->keyword = JRequest::getVar('searchkeyword');
		$this->categoryId = JRequest::getVar('categoryId',null);
		$this->orderBy = JRequest::getVar("orderBy", "");
		
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

	
	function getTotalOffers()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$offersTable = JTable::getInstance("Offer", "JTable");
			
			$categoriesIds = null;
				if(!empty($this->categoryId)){
				$categoryService = new JBusinessDirectorCategoryLib();
				$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
				if(count($categoriesIds)== 0 && isset($this->categoryId)){
					$categoriesIds = array($this->categoryId);
				}else{
					if(!empty($this->categoryId)){
						$categoriesIds[] = $this->categoryId;
					}
				}
			}	
			
			$this->_total = $offersTable->getTotalOffersByCategories($categoriesIds, $this->enablePackages, $this->showPendingApproval);
		}
		return $this->_total;
	}
	
	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotalOffers(), $this->getState('limitstart'), $this->getState('limit') );
			$this->_pagination->setAdditionalUrlParam('controller','offers');
			if(!empty($this->categoryId))
				$this->_pagination->setAdditionalUrlParam('categoryId',$this->categoryId);
			$this->_pagination->setAdditionalUrlParam('categoryId',$this->categoryId);
			if(!empty($this->categorySearch))
				$this->_pagination->setAdditionalUrlParam('categorySearch',$this->categorySearch);
			if(!empty($this->keyword))
				$this->_pagination->setAdditionalUrlParam('searchkeyword',$this->keyword);

			$this->_pagination->setAdditionalUrlParam('view','offers');
		}
		return $this->_pagination;
	}
	
	function getOffers(){
		$offersTable = JTable::getInstance("Offer", "JTable");
		$categoryService = new JBusinessDirectorCategoryLib();
		
		$categoriesIds = null;
		if(!empty($this->categoryId)){
			$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
			if(count($categoriesIds)== 0 && isset($this->categoryId)){
				$categoriesIds = array($this->categoryId);
			}else{
				$categoriesIds[] = $this->categoryId;
			}
		}
		
		$offers =  $offersTable->getOffersByCategories($categoriesIds, $this->enablePackages, $this->showPendingApproval, $this->orderBy, $this->getState('limitstart'), $this->getState('limit'));
		
		foreach($offers as $offer){
			switch($offer->view_type){
				case 1:
					$offer->link = JBusinessUtil::getofferLink($offer->id, $offer->alias);
					break;
				case 2:
					$itemId = JRequest::getVar('Itemid');
					$offer->link = JRoute::_("index.php?option=com_content&view=article&Itemid=$itemId&id=".$offer->article_id);
					break;
				case 3:
					$offer->link = $offer->url;
					break;
				default:
					$offer->link = JBusinessUtil::getofferLink($offer->id, $offer->alias);
			}
		}
		
		return $offers;
	}
	
function getSeachFilter(){
		
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime; 
    
		$offersTable = JTable::getInstance("Offer", "JTable");
		$categoryService = new JBusinessDirectorCategoryLib();
		
		$category=array();
		if(!empty($this->categoryId)){
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
				}else{
					if(!empty($category[0]->id))
					$childCategoryIds[] = $category[0]->id;
				}
				
				$companiesNumber = $offersTable->getTotalOffersByCategories( $childCategoryIds, $this->enablePackages,$this->showPendingApproval);
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
		$categoryTable = JTable::getInstance("Categories");
		return  $categoryTable->getCategoryById($this->categoryId);
	}
}
?>