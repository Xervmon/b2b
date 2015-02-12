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

class JTableEvent extends JTable
{

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function JTableEvent(& $db) {

		parent::__construct('#__jbusinessdirectory_company_events', 'id', $db);
	}

	
	function setKey($k)
	{
		$this->_tbl_key = $k;
	}
	
	function getEventsByCategoriesSql($categoriesIDs, $enablePackage, $showPendingApproval){
		$whereCatCond = '';
		//dump($categoriesIDs);
		if(isset($categoriesIDs) && count($categoriesIDs)>0){
			$whereCatCond = ' ( ';
			//dump($categoriesIDs);
			foreach($categoriesIDs as $categoryId){
				$whereCatCond .= $categoryId.',';
			}
			$whereCatCond = substr($whereCatCond, 0, -1);
			$whereCatCond.=')';
			$whereCatCond = ' and cc.categoryId in '.$whereCatCond;
		}
		
		$packageFilter = '';
		if($enablePackage){
			$packageFilter = " and (((inv.state= ".PAYMENT_STATUS_PAID." and now() > (inv.start_date) and (now() < (inv.start_date + INTERVAL p.days DAY) or (inv.package_id=p.id and p.days = 0)))) or p.price=0) and pf.feature='company_offers' ";
		}
		
		$companyStatusFilter="and cp.approved = ".COMPANY_STATUS_APPROVED;
		if($showPendingApproval){
			$companyStatusFilter = "and (cp.approved = ".COMPANY_STATUS_APPROVED." or cp.approved= ".COMPANY_STATUS_CREATED.") ";
		}

		$query = " select co.*,op.picture_info,op.picture_path, et.name as eventType 
					from
					#__jbusinessdirectory_company_events co
					left join  #__jbusinessdirectory_company_event_pictures op on co.id=op.eventId
					left join  #__jbusinessdirectory_company_event_types et on co.type=et.id
					inner join #__jbusinessdirectory_companies cp on co.company_id = cp.id
					left join #__jbusinessdirectory_company_category cc on cp.id=cc.companyId
					left join #__jbusinessdirectory_categories cg on cg.id=cc.categoryId
					left join #__jbusinessdirectory_orders inv on inv.company_id=cp.id 
					left join #__jbusinessdirectory_packages p on (inv.package_id=p.id and p.status=1) or (p.price=0 and p.status=1)
					left join #__jbusinessdirectory_package_fields pf on p.id=pf.package_id
					where co.state=1 and co.approved !=-1 and co.end_date>=DATE(now()) $whereCatCond $packageFilter $companyStatusFilter and cp.state=1
					and
					(1 or op.id in (
							select  min(op1.id) as min from #__jbusinessdirectory_company_events co1
							left join  #__jbusinessdirectory_company_event_pictures op1 on co1.id=op1.eventId
							group by co1.id
						)
					)
					group by co.id
					order by co.start_date ";
		
		return $query;
	}
	
	
	function getEventsByCategories($categoriesIDs, $enablePackage, $showPendingApproval, $limitstart=0, $limit=0){
		$db =JFactory::getDBO();
	
		$query = $this->getEventsByCategoriesSql($categoriesIDs, $enablePackage, $showPendingApproval);
		//echo $query;
		$db->setQuery($query, $limitstart, $limit);
		
		return $db->loadObjectList();
	}
	
	function getTotalEventsByCategories($categoriesIDs, $enablePackage, $showPendingApproval){
		$db =JFactory::getDBO();
		
		$query = $this->getEventsByCategoriesSql($categoriesIDs, $enablePackage, $showPendingApproval);

		//dump($query);
		$db->setQuery($query);
		$db->query();
		return $db->getNumRows();
	}

	function changeAprovalState($eventId, $state){
		$db =JFactory::getDBO();
		$query = " UPDATE #__jbusinessdirectory_company_events SET approved=$state WHERE id = ".$eventId ;
		$db->setQuery( $query );

		if (!$db->query()){
			return false;
		}
		return true;
	}


	function increaseViewCount($eventId){
		$db =JFactory::getDBO();
		$query = "update  #__jbusinessdirectory_company_events set view_count = view_count + 1 where id=$eventId";
		$db->setQuery($query);
		return $db->query();
	}

	function getEvent($eventId){
		$db =JFactory::getDBO();
		$query = "select e.*, et.name as eventType
		from #__jbusinessdirectory_company_events e
		left join  #__jbusinessdirectory_company_event_types et on e.type=et.id
		where e.id=".$eventId;
		$db->setQuery($query);
		//dump($query);
		return $db->loadObject();
	}

	function getEvents($filter, $limitstart=0, $limit=0){
		$db =JFactory::getDBO();
		$query = "select co.*,cp.name as companyName from #__jbusinessdirectory_company_events co
				  LEFT join  #__jbusinessdirectory_companies cp on cp.id=co.companyId
		$filter";
		// 		dump($query);
		$db->setQuery($query, $limitstart, $limit);
		return $db->loadObjectList();
	}

	function getTotalEvents(){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_company_events";
		$db->setQuery($query);
		$db->query();
		return $db->getNumRows();
	}

	function changeState($eventId){
		$db =JFactory::getDBO();
		$query = 	" UPDATE #__jbusinessdirectory_company_events SET state = IF(state, 0, 1) WHERE id = ".$eventId ;
		$db->setQuery( $query );

		if (!$db->query()){
			return false;
		}
		return true;
	}

	function getCompanyEvents($companyId, $limitstart=0, $limit=0){
		$db =JFactory::getDBO();
		$query = "select co.*, op.picture_path, et.name as eventType
					from #__jbusinessdirectory_company_events co
					left join  #__jbusinessdirectory_company_event_pictures op on co.id=op.eventId
					left join  #__jbusinessdirectory_company_event_types et on co.type=et.id
					where co.state=1 and co.approved !=-1 and co.end_date>=DATE(now()) and company_id=$companyId 
						and (1 or op.id in (
							select  min(op1.id) as min from #__jbusinessdirectory_company_events co1
							left join  #__jbusinessdirectory_company_event_pictures op1 on co1.id=op1.eventId
							where company_id=$companyId
							group by co1.id))
					group by co.id	
					order by co.start_date";
			
		//echo($query);
		$db->setQuery($query, $limitstart, $limit);
		$result = $db->loadObjectList();
		//dump($result);
		//dump($this->_db->getErrorMsg());
		return $result;
	}

	function getUserEvents($companyIds, $limitstart=0, $limit=0){
		$db =JFactory::getDBO();
		$companyIds = implode(",", $companyIds);
		$query = "select co.*, cp.name as companyName, op.picture_path from #__jbusinessdirectory_company_events co
					left join  #__jbusinessdirectory_company_event_pictures op on co.id=op.eventId
					left join #__jbusinessdirectory_companies cp on cp.id = co.company_id
					where company_id in ($companyIds) and (1 or op.id in (
					select  min(op1.id) as min from #__jbusinessdirectory_company_events co1
					left join  #__jbusinessdirectory_company_event_pictures op1 on co1.id=op1.eventId
					where company_id in ($companyIds)
					group by co1.id))
					group by co.id	";

		//dump($query);
		$db->setQuery($query, $limitstart, $limit);
		return $db->loadObjectList();
	}

	function getTotalUserEvents($companyIds){
		$db =JFactory::getDBO();
		$companyIds = implode(",", $companyIds);
		$query = "select * from #__jbusinessdirectory_company_events where company_id in ($companyIds)";
		$db->setQuery($query);
		$db->query();
		return $db->getNumRows();
	}

	function getTotalCompanyEvents($companyId){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_company_events where company_id=$companyId";
		$db->setQuery($query);
		$db->query();
		return $db->getNumRows();
	}

	function getEventPictures($eventId){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_company_event_pictures where eventId=$eventId order by id";
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	function getTotalNumberOfEvents(){
		$db =JFactory::getDBO();
		$query = "SELECT count(*) as nr FROM #__jbusinessdirectory_company_events";
		$db->setQuery($query);
		$result = $db->loadObject();

		return $result->nr;
	}

	function getTotalActiveEvents(){
		$db =JFactory::getDBO();
		$query = "SELECT count(*) as nr FROM #__jbusinessdirectory_company_events where state =1 and end_date>now()";
		$db->setQuery($query);
		$result = $db->loadObject();

		return $result->nr;
	}
}