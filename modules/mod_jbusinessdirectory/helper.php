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

class modJBusinessDirectoryHelper
{
	function getTitle( $params )
    {
		return '';
    }
		
	static function getMainCategories(){
		$db = JFactory::getDBO();
		$query = ' SELECT * FROM #__jbusinessdirectory_categories where parentId=0 order by name';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	static function getSubCategories(){
		$db = JFactory::getDBO();
		$query = ' SELECT c.* FROM #__jbusinessdirectory_categories c
                   inner join  #__jbusinessdirectory_categories  cc  on c.parentId = cc.id  where c.parentId!=0  and cc.parentId = 0
                   order by c.name';
		$db->setQuery($query,0,1000);
		$result = $db->loadObjectList();

		return $result;
	}

	static function getTypes(){
		$db = JFactory::getDBO();
		$query = ' SELECT * FROM #__jbusinessdirectory_company_types order by name';
		$db->setQuery($query);
		$result = $db->loadObjectList();
	
		return $result;
	}
	
	static function getCities(){
		$db = JFactory::getDBO();
		$query = ' SELECT distinct city FROM #__jbusinessdirectory_companies where state =1 and city!="" order by city asc';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	static function getActivityCities(){
		$db = JFactory::getDBO();
		$query = ' SELECT distinct name as city FROM #__jbusinessdirectory_cities order by name asc';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	static function getRegions(){
		$db = JFactory::getDBO();
		$query = 'SELECT distinct county FROM #__jbusinessdirectory_companies where state =1 and county!="" order by county asc';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	static function getCountries(){
		$db = JFactory::getDBO();
		$query = 'SELECT distinct c.country_id, c.* FROM #__jbusinessdirectory_countries c 
				  inner join #__jbusinessdirectory_companies cp on c.country_id = cp.countryId
				  where country_name!="" 
				  order by country_name asc';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}
?>
