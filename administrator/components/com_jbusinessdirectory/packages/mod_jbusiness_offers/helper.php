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

abstract class modJBusinessOffersHelper
{
	public static function getList(&$params){
		
		$appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		// Get the database object.
		$db = JFactory::getDBO();
		
		$whereCatCond = '';
		$categoriesIds = $params->get('categoryIds');
		if(isset($categoriesIds) && count($categoriesIds)>0 && $categoriesIds[0]!=""){
			$categoriesIDs = implode(",",$params->get('categoryIds'));
			$whereCatCond = " and cc.categoryId in ($categoriesIDs)";	
		}
		
		$companyStatusFilter="and cp.approved = ".COMPANY_STATUS_APPROVED;
		if($appSettings->show_pending_approval){
			$companyStatusFilter = "and (cp.approved = ".COMPANY_STATUS_APPROVED." or cp.approved= ".COMPANY_STATUS_CREATED.") ";
		}
		
		$packageFilter = '';
		if($appSettings->enable_packages){
			$packageFilter = " and ((inv.state= ".PAYMENT_STATUS_PAID." and (now() < (inv.start_date + INTERVAL p.days DAY) or (inv.package_id=p.id and p.days = 0))) or p.price=0) ";
		}
		
		$query = " select co.*,op.picture_info,op.picture_path from
					#__jbusinessdirectory_company_offers co
					left join  #__jbusinessdirectory_company_offer_pictures op on co.id=op.offerId
					where co.state=1  and co.approved !=-1 and co.companyId in (
						select cp.id
						from #__jbusinessdirectory_companies cp
						left join #__jbusinessdirectory_company_category cc on cp.id=cc.companyId
						left join #__jbusinessdirectory_categories cg on cg.id=cc.categoryId
						left join #__jbusinessdirectory_orders inv on inv.company_id=cp.id 
						left join #__jbusinessdirectory_packages p on (inv.package_id=p.id and p.status=1) or (p.price=0 and p.status=1)
						left join #__jbusinessdirectory_package_fields pf on p.id=pf.package_id
						where 1 $whereCatCond $packageFilter $companyStatusFilter and cp.state=1
						group by cp.id)
					and
					(1 or op.id in (
										select  min(op1.id) as min from #__jbusinessdirectory_company_offers co1
										left join  #__jbusinessdirectory_company_offer_pictures op1 on co1.id=op1.offerId
										group by co1.id
									)
					)
					group by co.id
					order by co.id desc";

		
		$nrResults = $params->get('count');
		// Set the query and get the result list.
		$db->setQuery($query, 0, $nrResults+10);
		$items = $db->loadObjectlist();
		
		foreach($items as $offer){
			switch($offer->view_type){
				case 1:
					$offer->link = JBusinessUtil::getofferLink($offer->id, $offer->alias);
					break;
				case 2:
					$itemId = $params->get('itemId');
					if(empty($itemId))
						$itemId = JRequest::getVar('Itemid');
					$offer->link = JRoute::_("index.php?option=com_content&view=article&Itemid=$itemId&id=".$offer->article_id, false);
					break;
				case 3:
					$offer->link = $offer->url;
					break;
				default:
					$offer->link = JBusinessUtil::getofferLink($offer->id, $offer->alias);
			}
		}
		
		//dump($items);
		shuffle($items);
		
		$items = array_slice($items, 0, $nrResults);
		
		//dump($db->getErrorMsg());
		return $items;
	}
}
?>
