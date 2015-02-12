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

class JBusinessDirectoryModelSearch extends JModelList
{ 
	
	function __construct()
	{
		parent::__construct();
		
		$this->appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$this->searchFilter = array();
		
		$this->keyword = JRequest::getVar('searchkeyword');
		$this->keywordLocation = JRequest::getVar('searchkeywordLocation');
		$this->categoryId = JRequest::getVar('categoryId',null);
		$this->citySearch = JRequest::getVar('citySearch',null);
		$this->typeSearch = JRequest::getVar('typeSearch',null);
		$this->regionSearch = JRequest::getVar('regionSearch',null);
		$this->countrySearch = JRequest::getVar('countrySearch',null);
		$this->categorySearch = JRequest::getVar('categorySearch');
		$this->zipCode = JRequest::getVar('zipcode');
		$this->radius = JRequest::getVar('radius');
		$this->preserve = JRequest::getVar('preserve',null);
		
		if(isset($this->categorySearch) || isset($this->preserve)){
			$this->categoryId = $this->categorySearch;
		}
		
		$session = JFactory::getSession();
		if(isset($this->categoryId)){
			$session->set('categorySearch', $this->categoryId);
			$session->set('searchkeyword', "");
			$session->set('searchkeywordLocation',"");
			$session->set('typeSearch',"");
			$session->set('citySearch',"");
			$session->set('regionSearch',"");
			$session->set('countrySearch',"");
			$session->set('zipcode',"");
		}
		
		if(isset($this->typeSearch)){
			$session->set('typeSearch', $this->typeSearch);
		}
		
		if(isset($this->citySearch)){
			$session->set('citySearch', $this->citySearch);
		}
		
		if(isset($this->regionSearch)){
			$session->set('regionSearch', $this->regionSearch);
		}
		
		if(isset($this->countrySearch)){
			$session->set('countrySearch', $this->countrySearch);
		}
		
		if(isset($this->keyword)){
			$session->set('searchkeyword', $this->keyword);
		}
		
		if(isset($this->keywordLocation)){
			$session->set('searchkeywordLocation', $this->keywordLocation);
		}
		
		if(isset($this->zipCode)){
			$session->set('zipcode', $this->zipCode);
		}
		
		if(isset($this->radius)){
			$session->set('radius', $this->radius);
		}
		
		$this->keyword = $session->get('searchkeyword');
		$this->keywordLocation = $session->get('searchkeywordLocation');
		$this->typeSearch = $session->get('typeSearch');
		$this->citySearch = $session->get('citySearch');
		$this->regionSearch = $session->get('regionSearch');
		$this->countrySearch = $session->get('countrySearch');
		$this->categorySearch = $session->get('categorySearch');
		$this->zipCode = $session->get('zipcode');
		$this->radius = $session->get('radius');
		$this->location = null;
		
		if($this->appSettings->metric==0){
			$this->radius  = $this->radius * 0.621371;
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
		$this->showPendingApproval = $appSettings->show_pending_approval==1;
		
		if(isset($this->zipCode) && $this->zipCode!=""){
			$this->location = JBusinessUtil::getCoordinates($this->zipCode);	
		}
	}
	
	/**
	 * Returns a Table object, always creating it
	 *
	 * @param   type	The table type to instantiate
	 * @param   string	A prefix for the table class name. Optional.
	 * @param   array  Configuration array for model. Optional.
	 * @return  JTable	A database object
	 */
	public function getTable($type = 'Companies', $prefix = 'JTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	function getCategoryId(){
		return $this->categoryId;
	}
	
	function &getCompanies(){
		return $this->companies;
	}
	
	/**
	 * 
	 * @return object with data
	 */
	function getCompaniesByName(){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->getCompaniesByName($this->keyword, $this->getState('limitstart'), $this->getState('limit'));
	}
		
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $searchParams
	 */
	function getCompaniesByPhone(){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->getCompaniesByPhone($this->keyword);
	}
	
	function getTotalComapaniesByName()
	{
		exit;
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$companiesTable = $this->getTable("Company");
			$this->_total = $companiesTable->getTotalCompaniesByName($this->keyword);
		}
		return $this->_total;
	}
	
	
	
	
	function getCompaniesByNameAndCategory(){
		//dump('get company by name');
		//dump($this->categoryId);
		$categories = $this->getSelectedCategories();
		//dump($categories);
		$companiesTable = $this->getTable("Company");
		$categoryService = new JBusinessDirectorCategoryLib();
		$categoriesIds = array();
		if(isset($this->categoryId) && $this->categoryId!=0){
			$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
			
			if(isset($this->categoryId) && $this->categoryId !=0){
				if(isset($categoriesIds) && count($categoriesIds) > 0 ){
					$categoriesIds[] = $this->categoryId;
				}else{
					$categoriesIds = array($this->categoryId);
				}
			} 
			$categoriesIds = array(implode(",", $categoriesIds));
		}else if(isset($categories) && count($categories)>0) {	
			foreach($categories as $category){
				$categoriesLevel= array();
				$cats = $categoryService->getCategoryLeafs($category);
				//dump($category);
				//dump($cats);
				if(isset($cats)){
					$categoriesLevel = array_merge($categoriesLevel,$cats);
				}
				$categoriesLevel[] = $category;
				
				$categoriesIds[] = implode(",",$categoriesLevel);
			}
		}
		
		//dump($categoriesIds);
		
		$orderBy = JRequest::getVar("orderBy", "packageOrder desc");

		$searchDetails = array();
		$searchDetails["keyword"] = $this->keyword;
		$searchDetails["keywordLocation"] = $this->keywordLocation;
		$searchDetails["categoriesIds"] = $categoriesIds;
		if(!empty($this->location)){
			$searchDetails["latitude"] = $this->location["latitude"];
			$searchDetails["longitude"] = $this->location["longitude"];
		}
		$searchDetails["radius"] = $this->radius;
		$searchDetails["typeSearch"] = $this->typeSearch;
		$searchDetails["citySearch"] = $this->citySearch;
		$searchDetails["regionSearch"] = $this->regionSearch;
		$searchDetails["countrySearch"] = $this->countrySearch;
		$searchDetails["enablePackages"] = $this->enablePackages;
		$searchDetails["showPendingApproval"] = $this->showPendingApproval;
		$searchDetails["orderBy"] = $orderBy;
		$searchDetails["facetedSearch"] = $this->appSettings->search_type;
		$searchDetails["zipcCodeSearch"] = $this->appSettings->zipcode_search_type;
		$searchDetails["limit_cities"] = $this->appSettings->limit_cities;
		
		//dump($this->getState('limitstart').' '.$this->getState('limit'));
		$companies =  $companiesTable->getCompaniesByNameAndCategories($searchDetails, $this->getState('limitstart'), $this->getState('limit'));
		foreach($companies as $company){
			$company->packageFeatures = explode(",", $company->features);
		}

		foreach($companies as $company){
			$company->packageFeatures = explode(",", $company->features);
			$attributesTable = $this->getTable('CompanyAttributes');
			$company->customAttributes = $attributesTable->getCompanyAttributes($company->id);
		}
		
		return $companies;
	}
	
	function getTotalCompaniesByNameAndCategory()
	{
		
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$companiesTable = $this->getTable("Company");
			$categoryService = new JBusinessDirectorCategoryLib();
			$categories = $this->getSelectedCategories();
			//$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
			$categoriesIds = array();
			if(isset($this->categoryId) && $this->categoryId!=0){
				$categoriesIds = $categoryService->getCategoryLeafs($this->categoryId);
	
				if(isset($this->categoryId) && $this->categoryId !=0){
					if(isset($categoriesIds) && count($categoriesIds) > 0 ){
						$categoriesIds[] = $this->categoryId;
					}else{
						$categoriesIds = array($this->categoryId);
					}
				}
				$categoriesIds = array(implode(",", $categoriesIds));
			}else if(isset($categories) && count($categories)>0) {
	
				foreach($categories as $category){
					$categoriesLevel= array();
					$cats = $categoryService->getCategoryLeafs($category);
					//dump($category);
					//dump($cats);
					if(isset($cats)){
						$categoriesLevel = array_merge($categoriesLevel,$cats);
					}
					$categoriesLevel[] = $category;
						
					$categoriesIds[] = implode(",",$categoriesLevel);
				}
			}
				
			$searchDetails = array();
			$searchDetails[0]=0;
			$searchDetails["keyword"] = $this->keyword;
			$searchDetails["keywordLocation"] = $this->keywordLocation;
			$searchDetails["categoriesIds"] = $categoriesIds;
			if(!empty($this->location)){
				$searchDetails["latitude"] = $this->location["latitude"];
				$searchDetails["longitude"] = $this->location["longitude"];
			}
			$searchDetails["radius"] = $this->radius;
			$searchDetails["typeSearch"] = $this->typeSearch;
			$searchDetails["citySearch"] = $this->citySearch;
			$searchDetails["regionSearch"] = $this->regionSearch;
			$searchDetails["countrySearch"] = $this->countrySearch;
			$searchDetails["enablePackages"] = $this->enablePackages;
			$searchDetails["showPendingApproval"] = $this->showPendingApproval;
			$searchDetails["facetedSearch"] = $this->appSettings->search_type;
			$searchDetails["zipcCodeSearch"] = $this->appSettings->zipcode_search_type;
			$searchDetails["limit_cities"] = $this->appSettings->limit_cities;
				
			$this->_total = $companiesTable->getTotalCompaniesByNameAndCategories($searchDetails);
			//dump($this->_total);
		}
		
		
		return $this->_total;
	}
	
	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotalCompaniesByNameAndCategory(), $this->getState('limitstart'), $this->getState('limit') );
			$this->_pagination->setAdditionalUrlParam('option','com_jbusinessdirectory');
			$this->_pagination->setAdditionalUrlParam('controller','search');
			if(isset($this->categoryId) && $this->categoryId!='')
				$this->_pagination->setAdditionalUrlParam('categoryId',$this->categoryId);
			$this->_pagination->setAdditionalUrlParam('categoryId',$this->categoryId);
			if(isset($this->categorySearch) && $this->categorySearch!='')
				$this->_pagination->setAdditionalUrlParam('categorySearch',$this->categorySearch);
				
			$orderBy = JRequest::getVar("orderBy", "packageOrder desc");
	
			if(!empty($orderBy))
				$this->_pagination->setAdditionalUrlParam('orderBy',$orderBy);
				
			$categories = JRequest::getVar("categories");
			if(!empty($categories))
				$this->_pagination->setAdditionalUrlParam('categories',$categories);
				
			if(isset($this->keyword) && $this->keyword!='')
				$this->_pagination->setAdditionalUrlParam('searchkeyword',$this->keyword);
	
			$this->_pagination->setAdditionalUrlParam('view','search');
		}
		return $this->_pagination;
	}
	
	function getSearchFilter(){
		
		$companiesTable = $this->getTable("Company");
		$searchDetails = array();
		$searchDetails["keyword"] = $this->keyword;
		$searchDetails["categoriesIds"] = null;
		if(!empty($this->location)){
			$searchDetails["latitude"] = $this->location["latitude"];
			$searchDetails["longitude"] = $this->location["longitude"];
		}
		$searchDetails["radius"] = $this->radius;
		$searchDetails["citySearch"] = $this->citySearch;
		$searchDetails["typeSearch"] = $this->typeSearch;
		$searchDetails["regionSearch"] = $this->regionSearch;
		$searchDetails["countrySearch"] = $this->countrySearch;
		$searchDetails["enablePackages"] = $this->enablePackages;
		$searchDetails["showPendingApproval"] = $this->showPendingApproval;
		$searchDetails["facetedSearch"] = $this->appSettings->search_type;
		$searchDetails["zipcCodeSearch"] = $this->appSettings->zipcode_search_type;
		
		$categoryiesTotal = $companiesTable->getTotalCompaniesByCategories($searchDetails);
		
		
		
		$categoryService = new JBusinessDirectorCategoryLib();
		$category=array();
		//dump($this->categoryId);
		if(isset($this->categoryId) && $this->categoryId!=0 && $this->appSettings->search_type != 1){
			$category = $categoryService->getCompleteCategoryById($this->categoryId);
		} else {
			$category["subCategories"] = $categoryService->getCategories();
			$category["path"]=array();
			//dump($category["subCategories"]);
		}

		$subcategories='';
		$enableSelection = false;
		$this->searchFilter["path"]=$category["path"];
		if(isset($category["subCategories"]) && count($category["subCategories"])>0){
			$subcategories = $category["subCategories"];
		}else {
			$parentCategories = $category["path"];
// 			dump($parentCategories);
			if(count($parentCategories)>0){
				$categoryId = $parentCategories[count($parentCategories)][0];	
				//dump($categoryId);
				$parentCategory = $categoryService->getCompleteCategoryById($categoryId);
				$subcategories = $parentCategory["subCategories"];
				$this->searchFilter["enableSelection"]=1;
				$enableSelection = true;
			}
		}	
 		
 		$categories = array();
		if(isset($subcategories) && $subcategories!=''){
			foreach($subcategories as $cat){
				if(!is_array($cat))
					continue;
				
				$childCategoryIds = $categoryService->getCategoryChilds($cat);

				if(count($childCategoryIds)==0){
					$childCategoryIds = array($cat[0]->id);
				}else{
					$mainCat = array($cat[0]->id);
					$childCategoryIds = array_merge($mainCat, $childCategoryIds);
				}
				
				$companies =array();
				foreach($categoryiesTotal as $categoryTotal){
					if(in_array( $categoryTotal->id, $childCategoryIds)){
						$cmp = explode(",",$categoryTotal->listings_ids);
				
						$companies = array_merge($companies,$cmp);
						$companies = array_unique($companies);
					}
				}
				$companiesNumber = count($companies);  
				if( $companiesNumber > 0 || $enableSelection)
					$this->searchFilter["categories"][]=array($cat, $companiesNumber);
			}
			//dump($this->searchFilter["categories"]);
		}

// 	    dump($this->searchFilter);
		return $this->searchFilter;
	}
	
	function getCategory(){
		$categoryTable = $this->getTable("Categories");
		return  $categoryTable->getCategoryById($this->categoryId);
	}
	
	function getSelectedCategories(){
		$categories = array();
		$selectedCat = JRequest::getVar("categories");
		if($selectedCat!=''){
			$categories = explode(";", $selectedCat);
			
		}
		
		if(!empty($this->categoryId)){
			$categories[]=$this->categoryId;
		}
		
		if (in_array('', $categories))
		{
			unset($categories[array_search('',$categories)]);
		}
		
		return $categories;
	}

	function getLocation(){
		return $this->location;
	}
	
	function getMainCategories(){
		$categoryTable = $this->getTable("Categories");
		return  $categoryTable->getMainCategories();
	}
	
	function getSubCategories(){
		$categoryTable = $this->getTable("Categories");
		return  $categoryTable->getSubCategories();
	}
}
?>

