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

class JBusinessDirectoryModelManageOffers extends JModelList
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
		
		$this->setId(JRequest::getVar('offerId'));
	}

	function setId($offerId)
	{
		// Set id and wipe data
		$this->_offerId		= $offerId;
		$this->_data			= null;
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
	
		$ordering ="co.subject";
		$direction="ASC";
	
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
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
			$searchFilter.=" and co.subject LIKE '%".$search."%'";
		}
		
		$statusId = $this->getState('filter.status_id');
		if (is_numeric($statusId)) {
			$searchFilter .=' and co.approved ='.(int) $statusId;
		}
	
		$stateId = $this->getState('filter.state_id');
		if (is_numeric($stateId)) {
			$searchFilter .=' and co.state ='.(int) $stateId;
		}
	
		$orderCol = $this->getState('list.ordering');
		if(!isset($orderCol) || strlen($orderCol)==0)
			$orderCol = 'co.subject';

		$orderColDir = $this->getState('list.direction');
		if(!isset($orderColDir))
			$orderCol = 'asc';
	
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
		$offersTable = $this->getTable("manageoffers");
		$filter = $this->getSearchFilter();
		if (empty( $this->_data )) 
		{
			$this->_data = $offersTable->getOffers($filter, $this->getState('limitstart'), $this->getState('limit'));
		}
		
		return $this->_data;
	}
	
	
	function &getData()
	{
		// Load the data
		$offersTable = $this->getTable("manageoffers");
		if (empty( $this->_data )) 
		{
			$this->_data = $offersTable->getOffer($this->_offerId);
		}
		
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = null;
			$this->_data->offerId = null;
			$this->_data->subject = null;
			$this->_data->description = null;
			$this->_data->price = null;
			$this->_data->specialPrice = null;
			$this->_data->startDate = date('Y-m-d');
			$this->_data->endDate = date("Y-m-d");// current date
			$this->_data->endDate = strtotime(date("Y-m-d", strtotime($this->_data->endDate)) . " +1 day");
			$this->_data->endDate = date ( 'Y-m-j' , $this->_data->endDate );
			$this->_data->pictures = array();
		}else{
			$this->_data->pictures = $this->getOfferPictures($this->_data->id);
		}
		
		$this->_data->startDate = convertToFormat($this->_data->startDate);
		$this->_data->endDate = convertToFormat($this->_data->endDate);
		//dump($this->_data->pictures);
		return $this->_data;
	}

	function getOfferPictures($offerId){
		$query = "
												SELECT 
													*
												FROM #__jbusinessdirectory_company_offer_pictures
												WHERE offerId =".$offerId ."
												ORDER BY id "
		;
		//dbg($query);
		//$this->_db->setQuery( $query );
		$files =  $this->_getList( $query );
		$pictures			= array();
		foreach( $files as $value )
		{
			$pictures[]	= array(
																				'offer_picture_info' 		=> $value->picture_info,
																				'offer_picture_path' 		=> $value->picture_path,
																				'offer_picture_enable'	=> $value->picture_enable,
			);
		}
	
		return $pictures;
	}
	
	function getTotal()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$offersTable = $this->getTable("manageoffers");
			$this->_total = $offersTable->getTotalOffers();
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
		//save in banners table
		$row = $this->getTable("manageoffers");
		
		$data['startDate']= convertToMysqlFormat($data['startDate']);
		$data['endDate']= convertToMysqlFormat($data['endDate']);
		
		if (!$row->bind($data)) 
		{
			
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		// Make sure the record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );
			return false;
		}
		
		if( $data['offerId'] =='' || $data['offerId'] ==0 || $data['offerId'] ==null )
		{
			$data['offerId'] = $this->_db->insertid();
		}
		
		$this->storePictures($data, $data['offerId']);
		return true;
	}
	
	function storePictures($data, $offerId){
	
		
		//prepare photos
		$path_old = makePathFile(JPATH_COMPONENT_ADMINISTRATOR .OFFER_PICTURES_PATH.($offerId)."/");
		$files = glob( $path_old."*.*" );
	
		$path_new = makePathFile(JPATH_COMPONENT_ADMINISTRATOR .OFFER_PICTURES_PATH.($offerId)."/");
	
		dbg($path_new);
		//dbg($offerId);
		dbg($data['pictures']);
		//exit;
		$picture_ids 	= array();
		foreach( $data['pictures'] as $value )
		{
			$row = $this->getTable('ManageOfferPictures');
	
			//dbg($key);
			$pic 						= new stdClass();
			$pic->id		= 0;
			$pic->offerId 				= $offerId;
			$pic->picture_info	= $value['offer_picture_info'];
			$pic->picture_path	= $value['offer_picture_path'];
			$pic->picture_enable	= $value['offer_picture_enable'];
			dbg($pic);
			$file_tmp = makePathFile( $path_old.basename($pic->picture_path) );
	
			//dbg($pic);
			dbg($file_tmp);
			dbg(is_file($file_tmp));
			//exit;
			if( !is_file($file_tmp) )
				continue;
			
			//exit;
			if( !is_dir($path_new) )
			{
				if( !@mkdir($path_new) )
				{
					throw( new Exception($this->_db->getErrorMsg()) );
				}
			}
	
			//dbg(($path_old.basename($pic->picture_path).",".$path_new.basename($pic->picture_path)));
			//exit;
			if( $path_old.basename($pic->picture_path) != $path_new.basename($pic->picture_path) )
			{
				if(@rename($path_old.basename($pic->picture_path),$path_new.basename($pic->picture_path)) )
				{
	
					$pic->picture_path	 = OFFER_PICTURES_PATH.($offerId).'/'.basename($pic->picture_path);
					//@unlink($path_old.basename($pic->room_picture_path));
				}
				else
				{
					throw( new Exception($this->_db->getErrorMsg()) );
				}
			}
				
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
				if( $pic == makePathFile(JPATH_COMPONENT_ADMINISTRATOR .$value['picture_path']) )
				{
					$is_find = true;
					break;
				}
			}
			if( $is_find == false )
			@unlink( makePathFile(JPATH_COMPONENT_ADMINISTRATOR .$value['picture_path']) );
		}
			
		$query = " DELETE FROM #__jbusinessdirectory_company_offer_pictures
									WHERE offerId = '".$offerId."'
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
	
	function deleteOffer($offerId){
		$offersTable = $this->getTable("manageoffers");
		return $offersTable->delete($offerId);
	}
	
	function changeState(){
		$offersTable = $this->getTable("manageoffers");
		return $offersTable->changeState($this->_offerId);
	}

	function changeStateOfferOfTheDay(){
		$offersTable = $this->getTable("manageoffers");
		return $offersTable->changeStateOfferOfTheDay($this->_offerId);
	}
	
	function changeAprovalState($state){
		$offersTable = $this->getTable("manageoffers");
		return $offersTable->changeAprovalState($this->_offerId, $state);
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
		$status->value = 0;
		$status->text = JTEXT::_("LNG_NEEDS_CREATION_APPROVAL");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = 1;
		$status->text = JTEXT::_("LNG_DISAPPROVED");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = 2;
		$status->text = JTEXT::_("LNG_APPROVED");
		$statuses[] = $status;
	
		return $statuses;
	}
	
	public function getForm($data = array(), $loadData = true)
	{
	
	}
}
?>