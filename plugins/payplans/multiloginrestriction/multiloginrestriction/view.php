<?php 
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	multiloginrestrcition
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansadminViewLoginviolation extends PayplansadminViewDashboard
{
	function violationChange()
	{
		$now = new Xidate();
		$date[0]      = JRequest::getVar('violation_from',false);
		$date[1]      = JRequest::getVar('violation_to',false);
		$userId       = JRequest::getVar('violation_user_id',false);
		$usersRecords = $this->getRecordUsersWithDates($date,$userId);
		$this->assign('usersRecords',$usersRecords);
		$html         = $this->loadTemplate('user_violations');
		
		$response	= XiFactory::getAjaxResponse();
		$response->addScriptCall('payplans.jQuery(\'#payplans-login-violation-records\').html', $html);
		$response->sendResponse();
	}
	
	public static function getRecordUsersWithDates($date,$userId)
   {
   		$query = new XiQuery();
   		$query->select('*')
   			  ->from('`#__payplans_loginviolation`');
 		if($date[0]){  	
   			  $query->where('DATE(`violation_date`) >= "'.$date[0].'"');
 		}
 		
 		if($date[1]){
   			  $query->where('DATE(`violation_date`) <= "'.$date[1].'"');
 		}
   					 
   		if($userId){
   			  $query->where('`user_id` = '.$userId);
   		}
   		
   		return $query->dbLoadQuery()
   					 ->loadObjectList();
   }
   
	function _getTemplatePath($layout = 'default')
	{
		return array_merge(parent::_getTemplatePath($layout),array(dirname(__FILE__).DS.'tmpl'));
	}
   
}