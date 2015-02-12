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



class JBusinessDirectoryModelManageEmails extends JModelAdmin
{ 
	function __construct()
	{
		parent::__construct();
		$array = JRequest::getVar('email_id',  0, '', 'array');
		//var_dump($array);
		$this->setId((int)$array[0]);
	}
	function setId($email_id)
	{
		// Set id and wipe data
		$this->_email_id		= $email_id;
		$this->_data			= null;
	}

	/**
	 * Method to get applicationsettings
	 * @return object with data
	 */
	function &getDatas()
	{
		// Load the data
		if (empty( $this->_data )) 
		{
			$query = ' SELECT * FROM #__jbusinessdirectory_emails';
			//$this->_db->setQuery( $query );
			$this->_data =  $this->_getList( $query );
		}
		
		return $this->_data;
	}
	
	
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) 
		{
			$query = 	' SELECT * FROM #__jbusinessdirectory_emails'.
						' WHERE email_id = '.$this->_email_id;
			
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		
		if ( !$this->_data ) 
		{
			$this->_data = new stdClass();
			$this->_data->email_id 				= null;
			$this->_data->email_name			= null;
			$this->_data->email_subject			= null;
			$this->_data->email_type			= null;			
			$this->_data->email_content			= null;			
			$this->_data->is_default			= null;
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
			dump($this->_db->getErrorMsg());
			return false;
		}
		// Make sure the record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			dump($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );
			dump($this->_db->getErrorMsg());
			return false;
		}
		
// 		exit;
		return true;
	}
	
	function remove()
	{
		$cids = JRequest::getVar( 'email_id', array(0), 'post', 'array' );
		$row = $this->getTable();

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;

	}
	
	function state()
	{
		$query = 	' SELECT * FROM #__jbusinessdirectory_emails'.
					' WHERE email_id = '.$this->_email_id;
		
		$this->_db->setQuery( $query );
		$item = $this->_db->loadObject();
		
		$query = 	" UPDATE #__jbusinessdirectory_emails SET is_default = IF(email_id = ".$this->_email_id.", 1, 0) 
						WHERE email_type = '".$item->email_type."'
						";
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) 
		{
			return false;
		}
		return true;
	}
	
	public function getForm($data = array(), $loadData = true)
	{
	
	}
}
?>