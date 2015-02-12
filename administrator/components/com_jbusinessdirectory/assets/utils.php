<?php
/*------------------------------------------------------------------------
 # JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

function dump( $text ){
	echo "<pre>";
	var_dump($text);
	echo "</pre>";
}

function dbg( $text )
{
	echo "<pre>";
	var_dump($text);
	echo "</pre>";
}


class JBusinessUtil{

	var $applicationSettings ;

	private function __construct()
	{

	}

	public static function getInstance()
	{
		static $instance;
		if ($instance === null) {
			$instance = new JBusinessUtil();
		}
		return $instance;
	}

	public static function getApplicationSettings(){
		$instance = JBusinessUtil::getInstance();

		if(!isset($instance->applicationSettings)){
			$instance->applicationSettings = self::getAppSettings();
		}
		return $instance->applicationSettings;
	}
	
	static function getAppSettings(){
		$db		= JFactory::getDBO();
		$query	= "	SELECT * FROM #__jbusinessdirectory_applicationsettings fas
		inner join  #__jbusinessdirectory_date_formats df on fas.date_format_id=df.id
		inner join  #__jbusinessdirectory_currencies c on fas.currency_id=c.currency_id";
	
		//dump($query);
		$db->setQuery( $query );
		if (!$db->query() )
		{
			JError::raiseWarning( 500, JText::_("LNG_UNKNOWN_ERROR") );
			return true;
		}
		return  $db->loadObject();
	}

	public static function loadClasses(){
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');


		//load payment processors
		$classpath = JPATH_COMPONENT_SITE  .DS.'classes'.DS.'payment'.DS.'processors';
		foreach( JFolder::files($classpath) as $file ) {
			JLoader::register(JFile::stripExt($file), $classpath.DS.$file);
		}

		//load payment processors
		$classpath = JPATH_COMPONENT_SITE  .DS.'classes'.DS.'payment';
		foreach( JFolder::files($classpath) as $file ) {
			JLoader::register(JFile::stripExt($file), $classpath.DS.$file);
		}

		//load services
		$classpath = JPATH_COMPONENT_SITE  .DS.'classes'.DS.'services';
		foreach( JFolder::files($classpath) as $file ) {
			JLoader::register(JFile::stripExt($file), $classpath.DS.$file);
		}
	}


	public static function getURLData($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	public static function getCoordinates($zipCode){
		$location = null;
		
		$url ="http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".urlencode($zipCode);
		$data = file_get_contents($url);
		$search_data = json_decode($data);
		if(!empty($data)){
			$lat =  $search_data->results[0]->geometry->location->lat;
			$lng =  $search_data->results[0]->geometry->location->lng;
	
			$location =  array();
			$location["latitude"] = $lat;
			$location["longitude"] = $lng;
		}
		
		return $location;
	}


	public static function parseDays($days){
		$date1 = time();
		$date2 = strtotime("+$days day");

		$diff = abs($date2 - $date1);

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			
		$result = new stdClass();

		$result->days = $days;
		$result->months = $months;
		$result->years = $years;

		return $result;
	}

	
	static function getComponentName(){
		$componentname = JRequest::getVar('option');
		return $componentname;
	}
	
	static function makePathFile($path)
	{
		$path_tmp = str_replace( '\\', DIRECTORY_SEPARATOR, $path );
		$path_tmp = str_replace( '/', DIRECTORY_SEPARATOR, $path_tmp);
		return $path_tmp;
	}
	
	
	static function convertToFormat($date){
		if(isset($date) && strlen($date)>6 && $date!="0000-00-00" && $date!="00-00-0000"){
			try{
				$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
				$date = substr($date,0,10);
				list($yy,$mm,$dd)=explode("-",$date);
				if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd)){
					$date = date($appSettings->dateFormat, strtotime($date));
				}else{
					$date="";
				}
			}catch(Exception $e){
				$date="";
			}
		}
		return $date;
	}
	
	static function convertToMysqlFormat($date){
		if(isset($date) && strlen($date)>6){
			$date = date("Y-m-d", strtotime($date));
		}
		return $date;
	}
	
	static function getDateGeneralFormat($data){
		$dateS="";
		if(isset($data) && strlen($data)>6  && $data!="0000-00-00"){
			$data =strtotime($data);
			$dateS = date( 'j F Y', $data );
		}
	
		return $dateS;
	}
	
	static function getDateGeneralShortFormat($data){
		$dateS="";
		if(isset($data) && strlen($data)>6  && $data!="0000-00-00"){
			$data =strtotime($data);
			$dateS = date( 'j M Y', $data );
		}
	
		return $dateS;
	}
	
	
	
	static function getDateGeneralFormatWithTime($data){
		$data =strtotime($data);
		$dateS = date( 'j M Y  G:i:s', $data );
	
		return $dateS;
	}
	
	static function loadModules($position){
	
		require_once(JPATH_ROOT.DS.'libraries'.DS.'joomla'.DS.'application'.DS.'module'.DS.'helper.php');
		$document = JFactory::getDocument();
		$renderer = $document->loadRenderer('module');
		$db =JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__modules WHERE position='$position' AND published=1 ORDER BY ordering");
		$modules = $db->loadObjectList();
		if( count( $modules ) > 0 )
		{
			foreach( $modules as $module )
			{
				//just to get rid of that stupid php warning
				$module->user = '';
				$params = array('style'=>'xhtml');
				echo $renderer->render($module, $params);
			}
		}
	}
	
	static function getCompanyLink($company, $addIndex=null){
		$itemid = JRequest::getInt('Itemid');
			
		$companyAlias = trim($company->alias);
		$companyAlias = stripslashes(strtolower($companyAlias));
		$companyAlias = str_replace(" ", "-", $companyAlias);
	
		$conf = JFactory::getConfig();
		$index ="";
	
		if(!JFactory::getConfig()->get("sef_rewrite")){
			$index ="index.php/";
		}
	
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
	
		$companyLink = $company->id;
		if(JFactory::getConfig()->get("sef") || $appSettings->enable_seo){
			$companyLink = $company->id."-".htmlentities(urlencode($companyAlias));
		}
	
		$url = JURI::base().$index.$companyLink;
	
		if(!$appSettings->enable_seo){
			$url = JRoute::_('index.php?option=com_jbusinessdirectory&view=companies&companyId='.$companyLink.'&Itemid='.$itemid);
		}
	
		return $url;
	}
	
	static function getCategoryLink($categoryId, $categoryAlias, $addIndex=null){
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$itemid = JRequest::getInt('Itemid');
		$categoryAlias = trim($categoryAlias);
		$categoryAlias = stripslashes(strtolower($categoryAlias));
		$categoryAlias = str_replace(" ", "-", $categoryAlias);
	
		$conf = JFactory::getConfig();
		$index ="";
		if(!JFactory::getConfig()->get("sef_rewrite")){
			$index ="index.php/";
		}
	
		$categoryLink = $categoryId;
		if(JFactory::getConfig()->get("sef") || $appSettings->enable_seo){
			$categoryLink = $categoryId."-".htmlentities(urlencode($categoryAlias));
		}
	
		$url = JURI::base().$index."category/".$categoryLink;
		
		if(!$appSettings->enable_seo){
			$url = JRoute::_('index.php?option=com_jbusinessdirectory&view=search&categoryId='.$categoryLink.'&Itemid='.$itemid);
		}
	
		return $url;
	}
	
	static function getOfferCategoryLink($categoryId, $categoryAlias, $addIndex=null){
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		$itemid = JRequest::getInt('Itemid');
	
		$categoryAlias = trim($categoryAlias);
		$categoryAlias = stripslashes(strtolower($categoryAlias));
		$categoryAlias = str_replace(" ", "-", $categoryAlias);
	
		$conf = JFactory::getConfig();
		$index ="";
		if(!JFactory::getConfig()->get("sef_rewrite")){
			$index ="index.php/";
		}
	
		$offerCategoryLink = $categoryId;
		if(JFactory::getConfig()->get("sef") || $appSettings->enable_seo){
			$offerCategoryLink = $categoryId."-".htmlentities(urlencode($categoryAlias));
		}
	
		$url = JURI::base().$index."offer-category/".$offerCategoryLink;
		
		if(!$appSettings->enable_seo){
			$url = JRoute::_('index.php?option=com_jbusinessdirectory&view=offers&categoryId='.$offerCategoryLink.'&Itemid='.$itemid);
		}
	
		return $url;
	}
	
	static function getEventCategoryLink($categoryId, $categoryAlias, $addIndex=null){
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		$itemid = JRequest::getInt('Itemid');
	
		$categoryAlias = trim($categoryAlias);
		$categoryAlias = stripslashes(strtolower($categoryAlias));
		$categoryAlias = str_replace(" ", "-", $categoryAlias);
	
		$conf = JFactory::getConfig();
		$index ="";
		if(!JFactory::getConfig()->get("sef_rewrite")){
			$index ="index.php/";
		}
	
		$eventCategoryLink = $categoryId;
		if(JFactory::getConfig()->get("sef") || $appSettings->enable_seo){
			$eventCategoryLink = $categoryId."-".htmlentities(urlencode($categoryAlias));
		}
	
		$url = JURI::base().$index."event-category/".$eventCategoryLink;
	
		if(!$appSettings->enable_seo){
			$url = JRoute::_('index.php?option=com_jbusinessdirectory&view=events&categoryId='.$eventCategoryLink.'&Itemid='.$itemid);
		}
	
		return $url;
	}
	
	static function getOfferLink($offerId, $offerAlias, $addIndex=null){
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		$itemid = JRequest::getInt('Itemid');
	
		$offerAlias = trim($offerAlias);
		$offerAlias = stripslashes(strtolower($offerAlias));
		$offerAlias = str_replace(" ", "-", $offerAlias);
	
		$conf = JFactory::getConfig();
		$index ="";
		if(!JFactory::getConfig()->get("sef_rewrite")){
			$index ="index.php/";
		}
	
		$offerLink = $offerId;
		if(JFactory::getConfig()->get("sef") || $appSettings->enable_seo){
			$offerLink = $offerId."-".htmlentities(urlencode($offerAlias));
		}
	
		$url = JURI::base().$index."offer/".$offerLink;
		
	
		if(!$appSettings->enable_seo){
			$url = JRoute::_('index.php?option=com_jbusinessdirectory&view=offer&offerId='.$offerLink.'&Itemid='.$itemid);
		}
	
		return $url;
	}
	
	static function getEventLink($eventId, $eventAlias, $addIndex=null){
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$itemid = JRequest::getInt('Itemid');
	
		$eventAlias = trim($eventAlias);
		$eventAlias = stripslashes(strtolower($eventAlias));
		$eventAlias = str_replace(" ", "-", $eventAlias);
	
		$conf = JFactory::getConfig();
		$index ="";
		if(!JFactory::getConfig()->get("sef_rewrite")){
			$index ="index.php/";
		}
	
		$eventLink = $eventId;
		if(JFactory::getConfig()->get("sef") || $appSettings->enable_seo){
			$eventLink = $eventId."-".htmlentities(urlencode($eventAlias));
		}
	
		$url = JURI::base().$index."event/".$eventLink;
		
		if(!$appSettings->enable_seo){
			$url = JRoute::_('index.php?option=com_jbusinessdirectory&view=event&eventId='.$eventLink.'&Itemid='.$itemid);
		}
	
		return $url;
	}
	
	static function isJoomla3(){
		$version = new JVersion();
		$versionA =  explode(".", $version->getShortVersion());
		if($versionA[0] =="3"){
			return true;
		}
		return false;
	}
	
	
	static function truncate($text, $length, $suffix = '&hellip;', $isHTML = true){
		$i = 0;
		$tags = array();
		if($isHTML){
			preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
			foreach($m as $o){
				if($o[0][1] - $i >= $length)
					break;
				$t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
				if($t[0] != '/')
					$tags[] = $t;
				elseif(end($tags) == substr($t, 1))
				array_pop($tags);
				$i += $o[1][1] - $o[0][1];
			}
		}
	
		$output = substr($text, 0, $length = min(strlen($text),  $length + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
	
		// Get everything until last space
		$one = substr($output, 0, strrpos($output, " "));
		// Get the rest
		$two = substr($output, strrpos($output, " "), (strlen($output) - strrpos($output, " ")));
		// Extract all tags from the last bit
		preg_match_all('/<(.*?)>/s', $two, $tags);
		// Add suffix if needed
		if (strlen($text) > $length) {
			$one .= $suffix;
		}
		// Re-attach tags
		$output = $one . implode($tags[0]);
	
		return $output;
	}
	
	static function getAlias($title, $alias){
		if (empty($alias) || trim($alias) == ''){
			$alias = $title;
		}
		
		$alias = JApplication::stringURLSafe($alias);
		
		if (trim(str_replace('-', '', $alias)) == ''){
			$alias = JFactory::getDate()->format('Y-m-d-H-i-s');
		}
		
		return $alias;
	}
	
	static function getAddressText($company){
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$address="";
		if($company->publish_only_city){
			$address=$company->city.' '.$company->county;
			return $address;
		}					
		
		if($appSettings->address_format==0){
			$address = $company->street_number.' '.$company->address;
		}else{
			$address = $company->address.' '.$company->street_number;
		}
		
		if(!empty($company->city)){
			$address .= ", ".$company->city;
		}
		
		if(!empty($company->county)){
			$address .= ", ".$company->county;
		}
		
		if(!empty($company->postalCode)){
			$address .= " ".$company->postalCode;
		}
		
		
		return $address;
	}
	
	static function getLocationTextOffer($offer){
		$location="";
	
		if(!empty($offer->address)){
			$location .= $offer->address;
		}
		
		if(!empty($offer->city)){
			$location .= ", ".$offer->city;
		}
		if(!empty($offer->county)){
			$location .= ", ".$offer->county;
		}
	
		return $location;
	}
	

	static function getBusinessCategoryPath($company){
		require_once( JPATH_ADMINISTRATOR.'/components/com_jbusinessdirectory/library/category_lib.php');
		
		$categoryService = new JBusinessDirectorCategoryLib();
		$categories = self::getCategories();
		//dump($categories);
		$category = null;
		
		if(!empty($company->mainSubcategory)){
			//dump($company->mainSubcategory);
			$categoryService->findCategoryById($categories, $category, $company->mainSubcategory);
		}else{
			$categoryIds = explode(",",$company->categoryIds);
			$categoryService->findCategoryById($categories, $category,$categoryIds[0]);
		}
		
		//dump($category);
		
		$path=array();
		$path[]=$category[0]->name;
		while($category[0]->parentId != 0){
			$categoryService->findCategoryById($categories, $category, $category[0]->parentId);
			//dump($category);
			$path[] = $category[0]->name;
		}
		
		$path = array_reverse($path);

		return $path;
	}
	
	static function getCategories(){
		require_once( JPATH_ADMINISTRATOR.'/components/com_jbusinessdirectory/library/category_lib.php');
		$instance = JBusinessUtil::getInstance();
		
		if(!isset($instance->categories)){
			$categoryService = new JBusinessDirectorCategoryLib();
			$categories = $categoryService->getAllCategories();
			$categories = $categoryService->processCategories($categories);
			$instance->categories = $categories;
			
		}
		//dump("categories");
		//dump($instance->categories);
		return $instance->categories;
	}
}
?>