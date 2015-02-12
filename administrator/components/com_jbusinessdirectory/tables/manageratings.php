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

class TableManageRatings extends JTable
{
	var $id = null; 
	var $name = null;
	var $subject = null; 
	var $description = null; 
	var $userId = null; 
	var $likeCount = null; 
	var $dislikeCount = null; 
	var $state = null; 
	var $companyId = null; 
	var $creationDate = null;	
	var $approved=null;
	var $ipAddress=null;
	var $rating = null;
	

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableManageRatings(& $db) {

		parent::__construct('#__jbusinessdirectory_company_reviews', 'id', $db);
	}

	function setKey($k)
	{
		$this->_tbl_key = $k;
	}


}