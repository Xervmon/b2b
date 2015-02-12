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

class TableManageBannerTypes extends JTable
{
	var $id = null; 
	var $name = null; 
	


	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableManageBannerTypes(& $db) {

		parent::__construct('#__jbusinessdirectory_banner_types', 'id', $db);
	}

	function setKey($k)
	{
		$this->_tbl_key = $k;
	}

	function getBannerType($bannerTypeId){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_banner_types where id=".$bannerTypeId;
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	function getBannerTypes(){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_banner_types order by name";
		$db->setQuery($query);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}