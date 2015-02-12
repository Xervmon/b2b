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
			require_once JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/defines.php';
			require_once JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/utils.php';
			
			$appSettings = JUtil::getInstance()->getApplicationSettings();
			if(!empty($appSettings->menu_item_id)){
				JFactory::getApplication()->getMenu()->setActive($appSettings->menu_item_id);
			}
		}

		return;		
	}
	
	function getBusinessListingParms($companyName){
		$params = JRequest::get('GET');
		
		$companyId = substr($companyName, 0, strpos($companyName, "-"));
		$companyName = substr($companyName, strpos($companyName, "-")+1);
		
		$companyName = urldecode($companyName);
		$companyName = trim($companyName);
		$companyName =  str_replace("-", " ", $companyName);
		
		if(!is_numeric($companyId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM `#__jbusinessdirectory_companies` c where c.id = $companyId";
		
		$db->setQuery($query, 0, 1);
		$company = $db->loadObject();
		
		if(isset($company) && strcmp(strtolower($companyName), str_replace("-", " ", trim(strtolower($company->name))))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "companies";
			$params["task"] = "showcompany";
			$params["companyId"] = $company->id;
			$params["view"] = "companies";
			$params["Itemid"] = "";
		}
		
		return $params;
	}
	
	function getCategoryParms($categoryName){
		$params = JRequest::get('GET');
	
		$categoryId = substr($categoryName, 0, strpos($categoryName, "-"));
		$categoryName = substr($categoryName, strpos($categoryName, "-")+1);
	
		$categoryName = urldecode($categoryName);
		$categoryName = trim($categoryName);
		$categoryName =  str_replace("-", " ", $categoryName);
	
		if(!is_numeric($categoryId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_categories c where c.id = $categoryId ";
	
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();
	
		if(isset($category) && strcmp(strtolower($categoryName), str_replace("-", " ", trim(strtolower($category->name))))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "search";
			$params["categoryId"] = $categoryId;
			$params["view"] = "search";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
	function getOfferCategory($categoryName){
		$params = JRequest::get('GET');
	
		$categoryId = substr($categoryName, 0, strpos($categoryName, "-"));
		$categoryName = substr($categoryName, strpos($categoryName, "-")+1);
	
		$categoryName = urldecode($categoryName);
		$categoryName = trim($categoryName);
		$categoryName =  str_replace("-", " ", $categoryName);
	
		if(!is_numeric($categoryId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_categories c where c.id = $categoryId ";
	
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();
	
		if(isset($category) && strcmp(strtolower($categoryName), str_replace("-", " ", trim(strtolower($category->name))))==0){
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
		$categoryName =  str_replace("-", " ", $categoryName);
	
		if(!is_numeric($categoryId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_categories c where c.id = $categoryId ";
	
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();
	
		if(isset($category) && strcmp(strtolower($categoryName), str_replace("-", " ", trim(strtolower($category->name))))==0){
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
		$offerName =  str_replace("-", " ", $offerName);
	
		if(!is_numeric($offerId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_company_offers o where o.id = $offerId ";
	
		$db->setQuery($query, 0, 1);
		$offer = $db->loadObject();
	
		if(isset($offer) && strcmp(strtolower($offerName), str_replace("-", " ", trim(strtolower($offer->subject))))==0){
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
		$eventName =  str_replace("-", " ", $eventName);
	
		if(!is_numeric($eventId)){
			return;
		}
			
		$db = JFactory::getDBO();
		$query= "SELECT * FROM #__jbusinessdirectory_company_events e where e.id = $eventId ";
	
		$db->setQuery($query, 0, 1);
		$event = $db->loadObject();
	
		if(isset($event) && strcmp(strtolower($eventName), str_replace("-", " ", trim(strtolower($event->name))))==0){
			$params["option"] = "com_jbusinessdirectory";
			$params["controller"] = "event";
			$params["eventId"] = $eventId;
			$params["view"] = "event";
			$params["Itemid"] = "";
		}
	
		return $params;
	}
	
}
