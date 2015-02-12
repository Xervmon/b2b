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


class JBusinessDirectoryModelManageRatings extends JModelList
{ 
	function __construct()
	{
		parent::__construct();
		$this->setId(JRequest::getVar('reviewId'));
	}

	function setId($reviewId)
	{
		// Set id and wipe data
		$this->_reviewId		= $reviewId;
		$this->_data			= null;
	}
	/**
	 * 
	 * @return object with data
	 */
	function &getDatas()
	{
		$reviewsTable = $this->getTable();
		// Load the data
		if (empty( $this->_data )) 
		{
			
			$this->_data = $reviewsTable->getAllReviews();
		}
		//dump($this->_data);
		return $this->_data;
	}
	
	
	function &getData()
	{
		
		$reviewsTable = $this->getTable();
		// Load the data
		if (empty( $this->_data )) 
		{
			$this->_data = $reviewsTable->getReview($this->_reviewId);
			$this->_data = $this->_data[0];
		}
		
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = null;
			$this->_data->subject = null;
			$this->_data->description = null;
			$this->_data->rating = null;
			$this->_data->userId = null;
			$this->_data->likeCount = null;
			$this->_data->dislikeCount = null;
			$this->_data->state = null;
			$this->_data->companyId = null;
			$this->_data->creationDate = null;
		}
		return $this->_data;
	}

	
	function store($data)
	{	
		$row = $this->getTable();

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
	
	function deleteReview(){
		$reviewsTable = $this->getTable();
		return $reviewsTable->deleteReview($this->_reviewId);
	}
	
	function changeState(){
		$reviewsTable = $this->getTable();
		return $reviewsTable->changeState($this->_reviewId);
	}
	
	function changeAprovalState($state){
		$reviewTable = $this->getTable();
		return $reviewTable->changeAprovalState($this->_reviewId, $state);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
	
	}
	
}
?>