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

class JBusinessDirectoryModelManageBanners extends JModelAdminList
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
		
		$this->setId(JRequest::getVar('bannerId'));
	}

	function setId($bannerId)
	{
		// Set id and wipe data
		$this->_bannerId		= $bannerId;
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
	
		$ordering ="b.name";
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
			$searchFilter.=" and b.name LIKE '%".$search."%'";
		}
	
		$typeId = $this->getState('filter.type_id');
		if (is_numeric($typeId)) {
			$searchFilter.=' and b.type ='.(int) $typeId;
		}
	
		$statusId = $this->getState('filter.status_id');
		if (is_numeric($statusId)) {
			$searchFilter .=' and b.approved ='.(int) $statusId;
		}
	
		$stateId = $this->getState('filter.state_id');
		if (is_numeric($stateId)) {
			$searchFilter .=' and b.state ='.(int) $stateId;
		}
	
		$orderCol = $this->getState('list.ordering');
		if(!isset($orderCol))
		$orderCol = 'b.name';
	
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
		$bannersTable = $this->getTable("managebanners");
		$filter = $this->getSearchFilter();
		
		if (empty( $this->_data )) 
		{
			$this->_data = $bannersTable->getBanners($filter, $this->getState('limitstart'), $this->getState('limit'));
		}
		
		return $this->_data;
	}
	
	
	function &getData()
	{
		// Load the data
		$bannersTable = $this->getTable("managebanners");
		if (empty( $this->_data )) 
		{
			$this->_data = $bannersTable->getBanner($this->_bannerId);
			$this->_data = $this->_data[0];
		}
		
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = null;
			$this->_data->name = null;
			$this->_data->company = null;
			$this->_data->start_date = date('Y-m-d');
			$this->_data->end_date = strtotime(date("Y-m-d", strtotime($this->_data->start_date)) . " +1 day");
			$this->_data->end_date = date ( 'Y-m-d' , $this->_data->end_date );
			$this->_data->type = null;
			$this->_data->state = null;
		}
		
		$this->_data->start_date = JBusinessUtil::convertToFormat($this->_data->start_date);
		$this->_data->end_date = JBusinessUtil::convertToFormat($this->_data->end_date);
		
		$bannerTypesTable = $this->getTable('managebannertypes');
		$this->_data->types = $bannerTypesTable->getBannerTypes();
		
		return $this->_data;
	}

	function deleteBanner(){
		$bannersTable = $this->getTable("managebanners");
		return $bannersTable->deleteBanner($this->_bannerId);
	}
	
	function getTotal()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$bannersTable = $this->getTable("managebanners");
			$this->_total = $bannersTable->getTotalBanners();
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
		$row = $this->getTable("managebanners");
		$data['start_date']= JBusinessUtil::convertToMysqlFormat($data['start_date']);
		$data['end_date']= JBusinessUtil::convertToMysqlFormat($data['end_date']);

		// Bind the form fields to the table
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
		
		return true;
	}
	
	function changeState(){
		$bannersTable = $this->getTable("managebanners");
		return $bannersTable->changeState($this->_bannerId);
	}
	
	function getBannerTypes(){
		$bannersTable = $this->getTable("managebanners");
		return $bannersTable->getBannerTypes();
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