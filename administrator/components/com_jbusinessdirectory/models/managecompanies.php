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

class JBusinessDirectoryModelManageCompanies extends JModelList
{ 
	function __construct()
	{
		parent::__construct();
		$mainframe = JFactory::getApplication();
		
		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		
		$this->populateState();
		
		$this->setId(JRequest::getVar('companyId'));
	}

	function setId($companyId)
	{
		// Set id and wipe data
		$this->_companyId		= $companyId;
		$this->_data			= null;
	}

	
	function getCompany($cmpId=null){
		$companiesTable = $this->getTable("Company");
		$companyId = JRequest::getVar('companyId');
		if(isset($cmpId))
		$companyId = $cmpId;
		$company = $companiesTable->getCompany($companyId);
		return $company;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
	
		// Adjust the context to support modal layouts.
		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}
		
		$ordering ="bc.name";
		$direction="ASC";
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$typeId = $app->getUserStateFromRequest($this->context.'.filter.type_id', 'filter_type_id');
		$this->setState('filter.type_id', $typeId);
		
		$statusId = $app->getUserStateFromRequest($this->context.'.filter.status_id', 'filter_status_id');
		$this->setState('filter.status_id', $statusId);

		$stateId = $app->getUserStateFromRequest($this->context.'.filter.state_id', 'filter_state_id');
		$this->setState('filter.state_id', $stateId);	
		
		// Check if the ordering field is in the white list, otherwise use the incoming value.
		$value = $app->getUserStateFromRequest($this->context.'.ordercol', 'filter_order', $ordering);
		$this->setState('list.ordering', $value);

		// Check if the ordering direction is valid, otherwise use the incoming value.
		$value = $app->getUserStateFromRequest($this->context.'.orderdirn', 'filter_order_Dir', $direction);
		$this->setState('list.direction', $value);	

		//parent::populateState('bc.name', 'asc');
	}
	
	function getSearchFilter(){
		// Filter by author
		$searchFilter =" where 1 ";
		
		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'r:') === 0) {
				$searchFilter.='and bc.registrationCode = '.(int) substr($search, 2);
			}
			else {
				$searchFilter.=" and bc.name LIKE '%".$search."%'";
			}
		}
		
		$typeId = $this->getState('filter.type_id');
		if (is_numeric($typeId)) {
			$searchFilter.=' and bc.typeId ='.(int) $typeId;
		}

		$statusId = $this->getState('filter.status_id');
		if (is_numeric($statusId)) {
			$searchFilter .=' and bc.approved ='.(int) $statusId;
		}

		$stateId = $this->getState('filter.state_id');
		if (is_numeric($stateId)) {
			$searchFilter .=' and bc.state ='.(int) $stateId;
		}
		
		$orderCol = $this->getState('list.ordering');
		if(!isset($orderCol))
			$orderCol = 'bc.name';
		
		$orderColDir = $this->getState('list.direction');
		if(!isset($orderColDir))
			$orderCol = 'ASC';
		
		$searchFilter.= " order by $orderCol $orderColDir";
		
		return $searchFilter;
	}
	/**
	 * 
	 * @return object with data
	 */
	function &getDatas()
	{
		// Load the data
		$companiesTable = $this->getTable("Company");
		$filter = $this->getSearchFilter();
		if (empty( $this->_data )) 
		{
			
			$this->_data = $companiesTable->getCompanies($filter, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	
	
	function &getData()
	{
		// Load the data
		$companiesTable = $this->getTable("Company");
		if (empty( $this->_data )) 
		{
			$this->_data = $companiesTable->getCompany($this->_companyId);
		}
		
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->name = null;
			$this->_data->comercialName = null;
			$this->_data->description = null;
			$this->_data->address = null;
			$this->_data->city = null;
			$this->_data->county = null;
			$this->_data->countryId = null;
			$this->_data->website = null;
			$this->_data->logo = null;
			$this->_data->keywords = null;
			$this->_data->registrationCode = null;
			$this->_data->taxCode = null;
			$this->_data->telefon1 = null;
			$this->_data->telefon2 = null;
			$this->_data->fax = null;
			$this->_data->state = null;
			$this->_data->typeId = null;		
			$this->_data->latitude = null;
			$this->_data->longitude = null;
			$this->_data->phone = null;
			$this->_data->email = null;
			$this->_data->approved = null;
			
			$this->_data->pictures			= array();
			$this->_data->videos			= array();
				
			//check temporary files
			/* $pictures = makePathFile(JPATH_COMPONENT.COMPANY_PICTURES_PATH.($this->_data->id)."/*.*");
			$files = glob( $pictures );
			if(isset($files) && is_array($files)){
				sort($files);
				foreach( $files as $value )
				{
					$this->_data->pictures[]	= array(
																	'company_picture_info' 		=> 'add from cache',
																	'company_picture_path' 		=> COMPANY_PICTURES_PATH.($this->_data->id).'/'.basename($value),
																	'company_picture_enable'		=> 1
					);
				}
			} */
		}else{
				//get pictures
				$this->_data->pictures = $this->getCompanyPictures($this->_data->id);
		}
		
		//dbg($this->_data->pictures);
		$this->_data->videos = $this->getCompanyVideos($this->_data->id);
		
		$countriesTable = $this->getTable('countries');
		$this->_data->countries = $countriesTable->getCountries();
		
		$typesTable = $this->getTable('companytypes');
		$this->_data->types			= $typesTable->getCompanyTypes(); 
		
		$companyCategoryTable = $this->getTable('companycategory');
		$this->_data->selectedCategories = $companyCategoryTable->getSelectedCategories($this->_companyId);
		
		return $this->_data;
	}

	function getClaimDetails(){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->getClaimDetails($this->_companyId);
	}
	
	function getCompanyPictures($companyId){
		$query = "
											SELECT 
												*
											FROM #__jbusinessdirectory_company_pictures
											WHERE companyId =".$companyId ."
											ORDER BY id "
		;
		//dbg($query);
		//$this->_db->setQuery( $query );
		$files =  $this->_getList( $query );
		$pictures			= array();
		foreach( $files as $value )
		{
			$pictures[]	= array(
																			'company_picture_info' 		=> $value->picture_info,
																			'company_picture_path' 		=> $value->picture_path,
																			'company_picture_enable'	=> $value->picture_enable,
			);
		}
		
		return $pictures;
	}
	
	function getCompanyVideos($companyId){
		$query = "
													SELECT 
														*
													FROM #__jbusinessdirectory_company_videos
													WHERE companyId =".$companyId ."
													ORDER BY id "
		;
		//dbg($query);

		$files =  $this->_getList( $query );
		return $files;
	}
	
	function deleteCompany(){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->deteleCompany($this->_companyId);
	}
	
	function getTotal()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$filter = $this->getSearchFilter();
			$companiesTable = $this->getTable("Company");
			$this->_total = $companiesTable->getTotalCompanies($filter);
		}
		return $this->_total;
	}
	
	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
	
	
	function store($data)
	{	
		//save in companies table
		$row = $this->getTable("Company");
		$oldId = $data["companyId"];
		if(!isset($oldId) || $oldId =='')
			$oldId = 0;
		dump($data);
		// Bind the form fields to the table
		if (!$row->bind($data)) 
		{
			dump($this->_db->getErrorMsg());
			$this->setError($this->_db->getErrorMsg());
			
		}
		// Make sure the record is valid
		if (!$row->check()) {
			dump($this->_db->getErrorMsg());
			$this->setError($this->_db->getErrorMsg());
			
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			dump($this->_db->getErrorMsg());
			$this->setError( $this->_db->getErrorMsg() );
		
			return false;
		}
		
		if( $data['companyId'] =='' || $data['companyId'] ==0 || $data['companyId'] ==null )
		{
			$data['companyId'] = $this->_db->insertid();
		}

		//save in companycategory table
		$table = $this->getTable("companycategory");
		$table->insertRelations($data["companyId"], $data["selectedSubcategories"]);
		try{
			$this->storePictures($data, $data['companyId'], $oldId);
			$this->storeVideos($data, $data['companyId']);
		}catch( Exception $ex )
		{
			dump($ex);
			exit;
			
		}
		
		
		return true;
	}
	
	function storeVideos($data, $companyId){
		
		$table = $this->getTable('ManageCompanyVideos');
		$table->deleteAllForCompany($companyId);
		
		foreach( $data['videos'] as $value ){
			$row = $this->getTable('ManageCompanyVideos');
			
			$video = new stdClass();
			$video->id =0;
			$video->companyId = $companyId;
			$video->url = $value;
			
			if (!$row->bind($video))
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
					
			}
			// Make sure the record is valid
			if (!$row->check())
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
			}
			
			// Store the web link table to the database
			if (!$row->store())
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
			}
		}
	}
	
	function storePictures($data, $companyId, $oldId){
		dump("store pcis");
		dump($companyId);
		dump($oldId);
		
		//prepare photos
		$path_old = makePathFile(JPATH_COMPONENT_ADMINISTRATOR .COMPANY_PICTURES_PATH.($oldId)."/");
		$files = glob( $path_old."*.*" );
		
		$path_new = makePathFile(JPATH_COMPONENT_ADMINISTRATOR .COMPANY_PICTURES_PATH.($companyId)."/");

		//dbg($path_new);
		//dbg($data);
		//dbg($data['pictures']);
		//exit;
		$picture_ids 	= array();
		foreach( $data['pictures'] as $value )
		{
			$row = $this->getTable('ManageCompanyPictures');
		
			//dbg($key);
			$pic 						= new stdClass();
			$pic->id		= 0;
			$pic->companyId 				= $companyId;
			$pic->picture_info	= $value['company_picture_info'];
			$pic->picture_path	= $value['company_picture_path'];
			$pic->picture_enable	= $value['company_picture_enable'];
			
			$file_tmp = makePathFile( $path_old.basename($pic->picture_path) );
			//dump($file_tmp);
			if( !is_file($file_tmp) )
				continue;
			//dump("is file");
			if( !is_dir($path_new) )
			{
				if( !@mkdir($path_new) )
				{
					throw( new Exception($this->_db->getErrorMsg()) );
				}
			}
		
			//dbg(($path_old.basename($pic->picture_path).",".$path_new.basename($pic->picture_path)));
			// exit;
			if( $path_old.basename($pic->picture_path) != $path_new.basename($pic->picture_path) )
			{
				if(@rename($path_old.basename($pic->picture_path),$path_new.basename($pic->picture_path)) )
				{
		
					$pic->picture_path	 = COMPANY_PICTURES_PATH.($companyId).'/'.basename($pic->picture_path);
					//@unlink($path_old.basename($pic->room_picture_path));
				}
				else
				{
					throw( new Exception($this->_db->getErrorMsg()) );
				}
			}
			//dump("save");
			//dbg($pic);
			//exit;
			if (!$row->bind($pic))
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
					
			}
			// Make sure the record is valid
			if (!$row->check())
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
			}
		
			// Store the web link table to the database
			if (!$row->store())
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
			}
		
			$picture_ids[] = $this->_db->insertid();
		}
			
		$files = glob( $path_new."*.*" );
			
		foreach( $files as $pic )
		{
			$is_find = false;
			foreach( $data['pictures'] as $value )
			{
				if(isset($value['picture_path']) &&  $pic == makePathFile(JPATH_COMPONENT_ADMINISTRATOR .$value['picture_path']) )
				{
					$is_find = true;
					break;
				}
			}
			if( $is_find == false )
			@unlink( makePathFile(JPATH_COMPONENT_ADMINISTRATOR .$value['picture_path']) );
		}

		//dump($picture_ids);
		
		$query = " DELETE FROM #__jbusinessdirectory_company_pictures
								WHERE companyId = '".$companyId."'
								".( count($picture_ids)> 0 ? " AND id NOT IN (".implode(',', $picture_ids).")" : "");
		
		// dbg($query);
		// exit;
		$this->_db->setQuery( $query );
		if (!$this->_db->query())
		{
			throw( new Exception($this->_db->getErrorMsg()) );
		}
		//~prepare photos
	}
	
	function changeState(){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->changeState($this->_companyId);
	}
	
	function changeAprovalState($state){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->changeAprovalState($this->_companyId, $state);
	}

	function changeClaimAprovalState($state){
		$companiesTable = $this->getTable("Company");
		$companiesTable->changeClaimState($this->_companyId, $state);
		$claimDetails = $companiesTable->getClaimDetails($this->_companyId);
		
		if($state == -1){
			 $companiesTable->resetCompanyOwner($this->_companyId);
			 $this->sendClaimResponseEmail($this->_companyId, $claimDetails, "Claim Negative Response Email");
		}else{
			$this->sendClaimResponseEmail($this->_companyId, $claimDetails, "Claim Response Email");
		}
	}
	
	
	function getCompanyTypes(){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->getCompanyTypes();
	}
	
	function getStates(){
		$states = array();
		$state = new stdClass();
		$state->value = 0;
		$state->text = JTEXT::_("LNG_INACTIVE");
		$states[] = $state;
		$state = new stdClass();
		$state->value = 1;
		$state->text = JTEXT::_("LNG_ACTIVE");
		$states[] = $state;
		
		return $states;
	}
	
	function getStatuses(){
		$statuses = array();
		$status = new stdClass();
		$status->value = COMPANY_STATUS_CLAIMED;
		$status->text = JTEXT::_("LNG_NEEDS_CLAIM_APROVAL");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = COMPANY_STATUS_CREATED;
		$status->text = JTEXT::_("LNG_NEEDS_CREATION_APPROVAL");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = COMPANY_STATUS_DISAPPROVED;
		$status->text = JTEXT::_("LNG_DISAPPROVED");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = COMPANY_STATUS_APPROVED;
		$status->text = JTEXT::_("LNG_APPROVED");
		$statuses[] = $status;
		
		return $statuses;
	}
	
	function checkCompanyName($companyName){
		$companiesTable = $this->getTable("Company");
		return $companiesTable->checkCompanyName($companyName);
	}
	
	
	function sendClaimResponseEmail($companyId, $claimDetails, $template){
		$email = new stdClass();
		
		$templ = $this->getEmailTemplate($template );
		//dump($template);
	//	dump($templ);
		
		if( $templ ==null )
			return null;
	
		$company=$this->getCompany($companyId);
		//dump($company);
		
		$email->content = $this->prepareEmail($company, $templ->email_content);
		$email->subject = $templ->email_subject;
		$email->to = $claimDetails->email;
		$applicationSettings = $this->getAppSettings();
		$email->company_email = $applicationSettings->company_email;
		$email->company_name = $applicationSettings->company_name;
		$result = $this->sendEMail($email);
		//dump($email);
		//dump($result);
		//exit;
		
		return $email;
	}
	
	
	function getEmailTemplate( $template)
	{
		$query = ' SELECT * FROM #__jbusinessdirectory_emails WHERE email_type = "'.$template.'"';
		$this->_db->setQuery( $query );
		$templ=  $this->_db->loadObject();
		return $templ;
	}
	
	function sendEmail($email)
	{
	
		$mode		 = 1 ;//html
	
		//JUtility::sendMail($from, $fromname, $recipient, $subject, $body, $mode=0, $cc=null, $bcc=null, $attachment=null, $replyto=null, $replytoname=null)
		$ret = JUtility::sendMail(
		$email->company_email,
		$email->company_name,
		$email->to,
		$email->subject,
		$email->content,
		$mode
		);
		return $ret;
	}
	
	function prepareEmail($company, $templEmail)
	{
		$fistName="";
		$lastName="";
			
		$templEmail = str_replace(htmlspecialchars(EMAIL_FIRST_NAME),				$fistName,				$templEmail);
		$templEmail = str_replace(EMAIL_FIRST_NAME, 								$fistName,				$templEmail);
	
		$templEmail = str_replace(htmlspecialchars(EMAIL_LAST_NAME), 				$lastName,				$templEmail);
		$templEmail = str_replace(EMAIL_LAST_NAME, 									$lastName,				$templEmail);
		
		$applicationSettings = $this->getAppSettings();
	
		$templEmail = str_replace(htmlspecialchars(EMAIL_COMPANY_NAME),				$applicationSettings->company_name,			$templEmail);
		$templEmail = str_replace(EMAIL_COMPANY_NAME,								$applicationSettings->company_name, 		$templEmail);

		$templEmail = str_replace(htmlspecialchars(EMAIL_CLAIMED_COMPANY_NAME),				$company->name,			$templEmail);
		$templEmail = str_replace(EMAIL_CLAIMED_COMPANY_NAME,								$company->name, 		$templEmail);
		
		return "<div style='width: 600px;'>".$templEmail.'</div>';
	}
	
	function getAppSettings()
	{
		// Load the data
	
		$query = ' SELECT * FROM #__jbusinessdirectory_applicationsettings ';
		$this->_db->setQuery( $query );
		$appSettings =  $this->_db->loadObject();
	
		return $appSettings;
	}
	
	public function getForm($data = array(), $loadData = true)
	{
	
	}
}
?>