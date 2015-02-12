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

class TableManageEmails extends JTable
{
	var $email_id			= null;
	var $email_subject		= null;
	var $email_name			= null;
	var $email_type			= null;
	var $email_content		= null;
	var $is_default			= 0;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableManageEmails(& $db) {
	
		parent::__construct('#__jbusinessdirectory_emails', 'email_id', $db);
	}
	function setKey($k)
	{
		$this->_tbl_key = $k;
	}
	
}