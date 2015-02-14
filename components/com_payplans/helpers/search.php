<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansHelperSearch
{
	static public function addSearchFunction($func=null, $class = 'PayplansHelperSearch')
	{
		static $funcs = null;
		
		
		if($func !==null){
			$funcs[md5($class.$func)] = array($class,$func);
		}
		
		return $funcs;
	}
	
	static public function doSearch($searchText,$referenceObj,$matchCriteria)
	{
		//add all functions required
		self::addSearchFunction('searchOPS');
		self::addSearchFunction('searchUsers');
		self::addSearchFunction('searchPG');
		
		// do search
		$results = array();
		foreach(self::addSearchFunction() as $func){
			$results = array_merge($results, call_user_func_array($func,array($searchText,$referenceObj,$matchCriteria)));
		}
		
		return $results;
	}
	
	
	static public function searchOPS($text,$referenceObj,$matchCriteria)
	{
		$results = array();
		
		// no need to search if text is empty
		if(empty($text)){
			return $results;
		}
		
		$id = $text;
		if(!is_numeric($text)){
			$id =  XiHelperUtils::getIdFromKey($text);
		}
		
		// if its blank
		if($id == 0){
			return $results;
		}
		
		if($referenceObj == 'order' || $referenceObj == 'all') {
			
			$tempResults = self::_searchOPS('order', $id, $matchCriteria);
			
			$results = array_merge($tempResults, $results);
		}
		
		if($referenceObj == 'payment' || $referenceObj == 'all') {
			
			$tempResults = self::_searchOPS('payment', $id, $matchCriteria);
				
			$results = array_merge($tempResults, $results);
		}
		
		if($referenceObj == 'subscription' || $referenceObj == 'all') {
			
			$tempResults = self::_searchOPS('subscription', $id, $matchCriteria);
			
			$results = array_merge($tempResults, $results);

		}
		
		if($referenceObj == 'invoice' || $referenceObj ==  'all') {
			
			$tempResults = self::_searchOPS('invoice', $id, $matchCriteria);
				
			$results = array_merge($tempResults, $results);
		}
		
		return $results;
	
	}
	
	static public function searchUsers($text,$referenceObj,$matchCriteria)
	{
		// no need to search if text is empty
		if(empty($text)){
			return true;
		}
		
		if($referenceObj != 'user' && $referenceObj !=  'all') {
			return array();
		}
		
		$results= array();
		$config = array('prefix'=>true, 'link'=>true, 'admin'=>true, 'attr'=>'');
		
		if(is_numeric($text) && ($matchCriteria != any)){ 

			// if user exist add it to results
			$user = PayplansUser::getInstance($text);
			if($user !== false){
				$temp 				= array();
				$temp['link'] 		= PayplansHelperFormat::user($user, $config); 
				$temp['id'] 		= $user->getId();
				$temp['title'] 		= $user->getRealname();
				$temp['description'] = $user->getUsername();
				$results[] 			= $temp;
			
			}			
			
			return $results;
		}
		
		$config = array('prefix'=>true, 'link'=>true, 'admin'=>true, 'attr'=>'');
		
		$user  = array();
		$model = XiFactory::getInstance('user', 'model');
		
		$query = $model->getQuery();
		$tmpQuery = $query->getClone();
		$matchCriteria = ($matchCriteria == 'any')?"'%".$text."%'":"'".$text."'";
		
		$tmpQuery->clear('where')
				 ->where("`tbl`.`id` LIKE {$matchCriteria} ","OR")
				 ->where("`tbl`.`username` LIKE {$matchCriteria} ","OR")
				 ->where("`tbl`.`name` LIKE {$matchCriteria} ","OR")
				 ->where("`tbl`.`email` = '$text'", "OR");
				 
		$users = $tmpQuery->dbLoadQuery()->loadObjectList($model->getTable()->getKeyName());
		
		foreach($users as $user){
			$temp 				= array();
			$temp['link'] 		= PayplansHelperFormat::user(PayplansUser::getInstance($user->user_id, null, $user), $config);
			$temp['id'] 		= $user->id;
			$temp['title'] 		= $user->realname;
			$temp['description'] = $user->username;
			$results[] 			= $temp;
		}
		
		return $results;
	}
	
	/**
	 * Serach plans and grooup from here
	 * @param numeric $text
	 */
	static public function searchPG($text,$referenceObj,$matchCriteria)
	{
		if(empty($text)){
			return true;
		}
		
		$results = array();
		
		$config = array('prefix'=>true, 'link'=>true, 'admin'=>true, 'attr'=>'');
			
		if(is_numeric($text) && ($matchCriteria != 'any')){
		
			if($referenceObj == 'plan' || $referenceObj == 'all') {
				// if plan exist add it to results
				$plan = PayplansPlan::getInstance($text);
				if($plan !== false){
					$temp 				= array();
					$temp['link'] 		= PayplansHelperFormat::plan($plan, $config);
					$temp['id'] 		= $plan->getId();
					$temp['title'] 		= $plan->getTitle();
					$temp['description'] = $plan->getDescription();
					$results[] 			= $temp;
				}
				
				return $results;
			}
			
			if($referenceObj == 'group' || $referenceObj == 'all') {
				// if plan exist add it to results
				$group = PayplansGroup::getInstance($text);
				if($group !== false){
					$temp 				= array();
					$temp['link'] 		= PayplansHelperFormat::group($group, $config);
					$temp['id'] 		= $group->getId();
					$temp['title'] 		= $group->getTitle();
					$temp['description'] = $group->getDescription();
					$results[] 			= $temp;
			
				}
				
				return $results;
			}
		}
		
			
		$matchCriteria = ($matchCriteria == 'any')?"'%".$text."%'":"'".$text."'";
		
		if($referenceObj == 'plan' || $referenceObj == 'all') {
			$model = XiFactory::getInstance('plan', 'model');
			
			$query = $model->getQuery();
			$tmpQuery = unserialize(serialize($query));
			$tmpQuery->clear('where')
					->where("`tbl`.`plan_id` LIKE {$matchCriteria} ","OR")
					->where("`tbl`.`title` LIKE {$matchCriteria} ","OR");
					 
			$plans = $tmpQuery->dbLoadQuery()->loadObjectList($model->getTable()->getKeyName());
			
			foreach($plans as $plan){ 
				$temp 				= array();
				$temp['link'] 		= PayplansHelperFormat::plan(PayplansPlan::getInstance($plan->plan_id, null, $plan), $config);
				$temp['id'] 		= $plan->id;
				$temp['title'] 		= $plan->title;
				$temp['description'] = $plan->description;
				$results[] 			= $temp;
			}
		}
		
		if($referenceObj == 'group' || $referenceObj == 'all') {
			$model = XiFactory::getInstance('group', 'model');
			
			$query = $model->getQuery();
			$tmpQuery = $query->getClone();
			$tmpQuery->clear('where')
					 ->where("`tbl`.`group_id` LIKE {$matchCriteria} ","OR")
					 ->where("`tbl`.`title` LIKE {$matchCriteria} ","OR");
					 
			$groups = $tmpQuery->dbLoadQuery()->loadObjectList($model->getTable()->getKeyName());
			
			foreach($groups as $group){
				$temp 				= array();
				$temp['link'] 		= PayplansHelperFormat::group(PayplansGroup::getInstance($group->group_id, null, $group), $config);
				$temp['id'] 		= $group->id;
				$temp['title'] 		= $group->title;
				$temp['description'] = $group->description;
				$results[] 			= $temp;						
			}
		}
		
		return $results;

	}

	/*
	 * this function return the search result for all enties like Oder payment subscription and invoice
	 * text can be id only in this case we will mathces it with only id's
	 * and if matched criteria is exact the direct fetch the instance of entity
	 * and if matched criteria is any then serch in model to fetch all the results
	 */
	public static function _searchOPS($entity, $text, $matchCriteria = 'any')
	{
		
		$results = array();
			
		$entityClass = 'Payplans'.ucfirst($entity);
		
		$config = array('prefix'=>true, 'link'=>true, 'admin'=>true, 'attr'=>'');
		
		if($matchCriteria != 'any') {
			// if order exist add it to results
			$entityObj = $entityClass::getInstance($text);
			
			if($entityObj !== false){
				$temp 				= array();
				$temp['link'] 		= PayplansHelperFormat::$entity($entityObj, $config);
				$temp['description'] = $entity; 
				$results[] 			= $temp;
			}
			
			return $results;
		}
		
		$model = PayplansFactory::getInstance($entity,'model');
		$query = $model->getQuery();
			
		$tmpQuery = $query->getClone();
		
		$matchCriteria = "'%".$text."%'";
		$entityId = $entity."_id";
			
		$tmpQuery->clear('where')->where("`tbl`.`$entityId` LIKE {$matchCriteria} ","OR");
	
		$records = $tmpQuery->dbLoadQuery()->loadObjectList($model->getTable()->getKeyName());
		
		foreach($records as $record){
	
			$temp 				= array();
			$temp['link'] 		= PayplansHelperFormat::$entity($entityClass::getInstance($record->$entityId, null, $record), $config);
			$temp['description'] = $entity;
			$results[] 			= $temp;
		}
			
		return $results;
	}
	
}