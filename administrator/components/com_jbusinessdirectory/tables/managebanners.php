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

class TableManageBanners extends JTable
{
	var $id = null; 
	var $name = null; 
	var $companyId = null; 
	var $start_date = null; 
	var $end_date = null; 
	var $type = null; 
	var $imageLocation = null;
	var $state = null; 
	var $url = null;


	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableManageBanners(& $db) {

		parent::__construct('#__jbusinessdirectory_banners', 'id', $db);
	}

	function setKey($k)
	{
		$this->_tbl_key = $k;
	}

	function getBanner($bannerId){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_banners where id=".$bannerId;
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	function getBanners($filter, $limitstart=0, $limit=0){
		$db =JFactory::getDBO();
		$query = "select b.*, bt.name as typeName from #__jbusinessdirectory_banners b left join #__jbusinessdirectory_banner_types bt on b.type=bt.id  $filter";
// 		dump($query);
		$db->setQuery($query, $limitstart, $limit);
		return $db->loadObjectList();
	}
	
	function getTotalBanners(){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_banners";
		$db->setQuery($query);
		$db->query();
		return $db->getNumRows();
	}
	
	function changeState($bannerId){
		$db =JFactory::getDBO();
		$query = 	" UPDATE #__jbusinessdirectory_banners SET state = IF(state, 0, 1) WHERE id = ".$bannerId ;
		$db->setQuery( $query );
		dump($query);
		if (!$db->query()){
			return false;
		}
		return true;
	}
	
	function deleteBanner($bannerId){
		$db =JFactory::getDBO();
		$query = 	" delete from #__jbusinessdirectory_banners  WHERE id = ".$bannerId ;
		$db->setQuery( $query );
		if (!$db->query()){
			return false;
		}
		return true;
	}
	
	function getBannerTypes(){
		$db =JFactory::getDBO();
		$query = "select id as value, name as text from #__jbusinessdirectory_banner_types order by name";
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	function increateViewCount($id){
		$db =JFactory::getDBO();
		$query = "update  #__jbusinessdirectory_banners set viewCount = viewCount + 1 where id=$id";
		$db->setQuery($query);
		return $db->query();
	}
}