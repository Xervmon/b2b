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

class TableManageOffers extends JTable
{

	var $id				= null;
	var $companyId		= null;
	var $subject		= null;
	var $description	= null;
	var $price			= null;
	var $specialPrice	= null;
	var $startDate		= null;
	var $endDate		= null;
	var $state			= null;
	var $approved		= null;
	var $viewCount=null;
	var $offerOfTheDay = null;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableManageOffers(& $db) {

		parent::__construct('#__jbusinessdirectory_company_offers', 'id', $db);
	}

	function setKey($k)
	{
		$this->_tbl_key = $k;
	}
	
	
}