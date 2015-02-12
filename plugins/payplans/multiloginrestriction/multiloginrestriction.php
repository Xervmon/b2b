<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	multiloginrestrcition
* @contact		payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgPayplansMultiloginrestriction extends XiPlugin
{

	var $_name = 'multiloginrestriction';

	public function onPayplansSystemStart()
	{
		//autoload app path and plugin files 
		$dir = dirname(__FILE__).DS.'multiloginrestriction'.DS;
		PayplansHelperLoader::addAutoLoadFile($dir.'table.php', 'PayplansTableLoginviolation');
		PayplansHelperLoader::addAutoLoadFile($dir.'controller.php', 'PayplansadminControllerLoginviolation');
		PayplansHelperLoader::addAutoLoadFile($dir.'view.php', 'PayplansadminViewLoginviolation');
		
		//to create table if not exist
		$table = new PayplansTableLoginviolation();
		return true;
	}
	
	public function onPayplansViewBeforeRender($view, $task)
	{
		if($view instanceof PayplansadminViewDashboard){			
			$now = new Xidate();
			$date[0]      = JRequest::getVar('violation_from',$now->toFormat('%Y-%m-%d'));
			$date[1]      = JRequest::getVar('violation_to',$now->toFormat('%Y-%m-%d'));
			$userId       = JRequest::getVar('violation_user_id',false);
			$usersRecords = PayplansadminViewLoginviolation::getRecordUsersWithDates($date,$userId);
			$this->_assign('usersRecords',$usersRecords);
			
			$duration = JRequest::getVar('duration',PAYPLANS_STATISCTICS_DURATION_MONTHLY);
			$dates    = PayplansHelperStatistics::getFirstAndLastDate($duration, false);
			$result   = $this->getRecordsWithDates($dates);
			$this->_assign('results',$result);
			
			
			return array(
						 'payplans-admin-dashboard-useraction' => $this->_render('default_violation_header').$this->_render('default_user_violations').$this->_render('linechart')
						);
		}
	}
	
	
	function onAfterRoute()
	{
		$app = XiFactory::getApplication();
		
		// Do not affect backend
		if($app->isAdmin()){
			return true;
		}

		$task   = JRequest::getVar('task');

		if($task != 'user.login'){
			return true;
		}
		
		//get User id
		$db      = XiFactory::getDBO();
		$query   = "Select * from `#__users` where `username` = '".JRequest::getVar('username')."'";
		$db->setQuery($query);
		$user 		   = $db->loadObject();
		//if user doesn't exist then do nothing
		if(empty($user)){
			return true;
		}
		
		$activeSession = $this->getActiveSession($user);
		
		//check whether the same user is logged-in somewhere else
		if(count($activeSession) >= $this->params->get('allowed_session',1)){
			//login violation, do actions accordingly
			if($this->increaseviolationCounter($user)){
				 $this->sendMail($user->email);
			}
			
			$url = $this->params->get('redirect_failed','index.php?option=com_users&view=login');
			
			JFactory::getApplication()->redirect($url,XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_LOGIN_VIOLATION_MESSAGE'));
		}
		
		return true;
	}
	
	function onUserAfterSave($properties, $isNew, $result, $error)
	{
		if( (JRequest::getVar('task') != 'complete'  && JRequest::getVar('view') == 'reset')|| $isNew){
			return true;
		}
		
		// password is reset by the actual user
		// so clear current running session of this user
		if(isset($properties['id']) && isset($properties['password_clear']) && !empty($properties['password_clear']) ){ 
			$query  = new XiQuery();
			return $query->delete()
						 ->from('`#__session`')
						 ->where('`userid` = '.$properties['id'] )
						 ->dbLoadQuery()
						 ->query();
		}
		
	}
	
	function onPayplansCron()
	{
		// 1 time work for a day : email to owners
		$now = new XiDate();
		if(!isset(XiFactory::getConfig()->lastviolationCronAccess)){
			return $this->doCronActions($now);
		}
		
		$lastCronAccess = XiFactory::getConfig()->lastviolationCronAccess;
		
		$cronFreq = $this->params->get('cron_frequency','15')*60;
		if(($now->toUnix() - $lastCronAccess) >= $cronFreq){
			return $this->doCronActions($now);
		}
	}
	
	function getActiveSession($user)
	{
		//get active session of logged-in user
		$query = new XiQuery();
		return $query->select('`session_id`')
					 ->from('`#__session`')
					 ->where('`userid` = "'.$user->id.'"')
					 ->where('`client_id` = 0')
					 ->dbLoadQuery()
					 ->loadColumn();

	}
	
	function sendMail($emails)
	{
		// Send a mail for informing the actual user  
		$config 	= JFactory::getConfig();
		$fromname	= $config->get('fromname');
		$mailfrom   = $this->params->get('from_email',$config->get('mailfrom'));
		$message    = $this->params->get('email_content','Login violation');
		$subject	= $this->params->get('email_subject','Login violation');
		return JFactory::getMailer()->setSender( array(
														$mailfrom,
														$fromname
														   ))
										 ->addRecipient($emails)
										 ->setSubject($subject)
										 ->setBody(strip_tags($message))
										 ->Send();		
	}
	
	function increaseviolationCounter($user)
	{
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$now   	   = new XiDate();
		$query     = new XiQuery();
		$result    = $query->select('*')
						   ->from('`#__payplans_loginviolation`')
						   ->where('`user_id` = "'.$user->id.'"')
						   ->where('`ip_address` = "'.$ipAddress.'"')
						   ->where('`violation_date` like "'.$now->toFormat('%Y-%m-%d').'%"')
						   ->dbLoadQuery()
						   ->loadResult();

		
		$query->clear();
		
		$now    = new XiDate();
		if(!empty($result)){
			$query->update('`#__payplans_loginviolation`')
					 ->set('`violation_counter` = `violation_counter` + 1')
					 ->set('`violation_date` = "'.$now->toMySQL().'"')
					 ->where('`user_id` = '.$user->id)
					 ->where('`ip_address` = "'.$ipAddress.'"')
					 ->where('`violation_date` like "'.$now->toFormat('%Y-%m-%d').'%"')
					->where('`reset_counter` <> 0')
					 ->dbLoadQuery()
					 ->query();
			return false;
		}
		
		$now   = new XiDate();
		$query->clear();
		return $query->insert('`#__payplans_loginviolation`')
					 ->set('`user_id` = '.$user->id)
					 ->set('`email` = "'.$user->email.'"')
					 ->set('`ip_address` = "'.$ipAddress.'"')
					 ->set('`violation_date` = "'.$now->toMySQL().'"')
					 ->dbLoadQuery()
					 ->query();
		
	}
	
	function doCronActions($now)
	{
		$records = $this->getviolationRecords($now,'email');
		$emails  = array_keys($records);
		
		if(!empty($emails) && $this->sendMail($emails)){
			$records = $this->getviolationRecords($now,'loginviolation_id');
			if(!empty($records)){
				$ids           = array_keys($records);
				$voliation_ids = implode(',', $ids);
				$query         = new XiQuery();
				$query->update('`#__payplans_loginviolation`')
					  ->set('`reset_counter` = 0')
					  ->where('`loginviolation_id` in('.$voliation_ids.')')
					  ->dbLoadQuery()
					  ->query();
					  
				$model = PayplansFactory::getInstance('config','model');
				$model->save(array('lastviolationCronAccess'=>'hide'));
			}
		}
		
		return true;
	}
	
	function getviolationRecords($now,$key)
	{
		//subtract one day
		$voliation_date = $now->toFormat('%Y-%m-%d');
		$query   		= new XiQuery();
		return $query->select('*')
					 ->from('`#__payplans_loginviolation`')
			         ->where('`reset_counter` <> 0')
			         ->group('`email`')
			         ->having('sum(`violation_counter`) >= '. $this->params->get('violation_limit',0))
			         ->dbLoadQuery()
			         ->loadObjectList($key);
		
   }   
   
   function getRecordsWithDates($dates)
   {
   		$query   = new XiQuery();
   		$data    = $query->select('DATE_FORMAT(`violation_date`, "%Y-%m-%d") as date, sum(`violation_counter`) as voliations')
   					     ->from('`#__payplans_loginviolation`')
   					     ->where('DATE(`violation_date`) >= "'.$dates[0]->toMySQL().'"')
   					     ->where('DATE(`violation_date`) <= "'.$dates[1]->toMySQL().'"')
   					     ->group('DATE_FORMAT(`violation_date`, "%Y-%m-%d")')
   					     ->dbLoadQuery()
   					     ->loadObjectList('date');
   					     
   		$current = unserialize(serialize($dates[0]));
		while($current->toUnix() < $dates[1]->toUnix())
		{
			$arraydate = $current;
			$key = $arraydate->toMySQL(false, '%Y-%m-%d');
			
			if(!isset($data[$key])){
				$data[$key]['voliations'] = 0;
			}else{
				$violations = $data[$key]->voliations;
				unset($data[$key]);
				$data[$key]['voliations'] = $violations;
			}
			$current->addExpiration('000001000000');
		}
		
		foreach ($data as $key=>$value){
			$data[strtotime($key)]['violations'] = $value['voliations'];
			unset($data[$key]);
		}
		
		ksort($data);
		return json_encode($data);
   }
}
