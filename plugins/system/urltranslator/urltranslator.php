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

jimport('joomla.plugin.plugin');

if (file_exists(JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/defines.php')) {
	require_once JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/defines.php';
}
if (file_exists(JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/utils.php')) {
	require_once JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/utils.php';
}
/**
 * Joomla! System Remember Me Plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	System.remember
 */
class plgSystemUrlTranslator extends JPlugin
{
	function onAfterRoute()
	{
		$app = JFactory::getApplication();
		
		// No remember me for admin
		if ($app->isAdmin()) {
			return;		
		}
		
		$url = str_replace(JURI::base(),"",JURI::current());
		$url = str_replace("index.php/","",$url);

		$category = null;
		$keyword = null;
		
		$pieces = explode("/", $url);
		if(count($pieces)>1){
			$keyword= end($pieces);
			$category = prev($pieces);
		}else{
			$keyword = $url;
		}
		
		$params = array();
		if($category=="category"){
			$params = $this->getCategoryParms( $keyword);
		}else if($category=="offer-category"){
			$params = $this->getOfferCategory( $keyword);
		}else if($category=="event-category"){
			$params = $this->getEventCategoryParms($keyword);
		}else if($category=="offer"){
			$params = $this->getOffersParms($keyword);
		}else if($category=="event"){
			$params = $this->getEventParms($keyword);
		}else{
			$params = $this->getBusinessListingParms($keyword);
		}
		
		if(!empty($params)){
			JRequest::set($params,'get',true);
		}

		return;		
	}
	
	function getBusinessListingParms($companyLink){
		$params = JRequest::get('GET');
		
		$companyId = substr($companyLink, 0, strpos($companyLink, "-"));
		$companyAlias = substr($companyLink, strpos($companyLink, "-")+1);
		$companyAlias = urldecode($companyAlias);
	
		if(!is_numeric($companyId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM `#__jbusinessdirectory_companies` c where c.id = $companyId";
		
		$db->setQuery($query, 0, 1);
		$company = $db->loadObject();
		
		if(isset($company) && strcmp($companyAlias, $company->alias)==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "companies";
			$params["task"] = "showcompany";
			$params["companyId"] = $company->id;
			$params["view"] = "companies";
			$params["Itemid"] = "";
		}
		
		return $params;
	}
	
	function getCategoryParms($categoryLink){
		$params = JRequest::get('GET');
	
		$categoryId = substr($categoryLink, 0, strpos($categoryLink, "-"));
		$categoryAlias = substr($categoryLink, strpos($categoryLink, "-")+1);
		$categoryAlias = urldecode($categoryAlias);
		
		if(!is_numeric($categoryId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_categories c where c.id = $categoryId ";
	
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();
	
		if(isset($category) && strcmp(strtolower($categoryAlias), (strtolower($category->alias)))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "search";
			$params["categoryId"] = $categoryId;
			$params["categorySearch"] = $categoryId;
			$params["view"] = "search";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
	function getOfferCategory($categoryName){
		$params = JRequest::get('GET');
	
		$categoryId = substr($categoryName, 0, strpos($categoryName, "-"));
		$categoryAlias = substr($categoryName, strpos($categoryName, "-")+1);
	
		$categoryAlias = urldecode($categoryAlias);
		$categoryAlias = trim($categoryAlias);
	
	
		if(!is_numeric($categoryId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_categories c where c.id = $categoryId ";
	
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();
	
		if(isset($category) && strcmp(strtolower($categoryAlias), (strtolower($category->alias)))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "offers";
			$params["categoryId"] = $categoryId;
			$params["view"] = "offers";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
	function getEventCategoryParms($categoryName){
		$params = JRequest::get('GET');
	
		$categoryId = substr($categoryName, 0, strpos($categoryName, "-"));
		$categoryName = substr($categoryName, strpos($categoryName, "-")+1);
	
		$categoryName = urldecode($categoryName);
		$categoryName = trim($categoryName);
	
		if(!is_numeric($categoryId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_categories c where c.id = $categoryId ";
	
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();
	
		if(isset($category) && strcmp(strtolower($categoryName), (strtolower($category->alias)))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "events";
			$params["categoryId"] = $categoryId;
			$params["view"] = "events";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
	function getOffersParms($keyword){
		$params = JRequest::get('GET');
	
		$offerId = substr($keyword, 0, strpos($keyword, "-"));
		$offerName = substr($keyword, strpos($keyword, "-")+1);
	
		$offerName = urldecode($offerName);
		$offerName = trim($offerName);
	
		if(!is_numeric($offerId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_company_offers o where o.id = $offerId ";
	
		$db->setQuery($query, 0, 1);
		$offer = $db->loadObject();
	
		if(isset($offer) && strcmp(strtolower($offerName), (strtolower($offer->alias)))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "offer";
			$params["offerId"] = $offerId;
			$params["view"] = "offer";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
	function getEventParms($keyword){
		$params = JRequest::get('GET');
	
		$eventId = substr($keyword, 0, strpos($keyword, "-"));
		$eventName = substr($keyword, strpos($keyword, "-")+1);
	
		$eventName = urldecode($eventName);
		$eventName = trim($eventName);

		
		if(!is_numeric($eventId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_company_events e where e.id = $eventId ";
	
		$db->setQuery($query, 0, 1);
		$event = $db->loadObject();
	
		if(isset($event) && strcmp(strtolower($eventName), (strtolower($event->alias)))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "event";
			$params["eventId"] = $eventId;
			$params["view"] = "event";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
}
