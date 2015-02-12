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

class JTableAttribute extends JTable
{

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db){

		parent::__construct('#__jbusinessdirectory_attributes', 'id', $db);
	}

	function setKey($k)
	{
		$this->_tbl_key = $k;
	}

	function getAttributes(){
		$query = "select a.*
		from #__jbusinessdirectory_attributes a";
		
		$this->_db->setQuery( $query );
		return $this->_db->loadObjectList();
	}
	
	function changeState($attributeId){
		$db =JFactory::getDBO();
		$query = 	" UPDATE #__jbusinessdirectory_attributes SET status = IF(status, 0, 1) WHERE id = ".$attributeId ;
		$db->setQuery( $query );
		if (!$db->query()){
			return false;
		}
		return true;
	}
	
}