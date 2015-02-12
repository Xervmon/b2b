<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	Export
* @contact		payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Payplans Export Plugin
 *
 * @author Team Payplans
 */
class plgPayplansExport extends XiPlugin
{
	protected   $_exportFile = "";
	protected   $_headerSeted = false;
	protected	$plan 		 = array();
	protected	$subStatus 	 = array();
	protected	$invStatus 	 = array();
	protected	$startDate   = null;
	protected	$endDate	 = null;
	protected	$gateway	 = array();
	
	public function loadTemplate($tpl)
	{
		return $this->_loadTemplate($tpl);
	}
	
	public function onPayplansViewBeforeRender(XiView &$view, $task)
	{
		$submenus = XiAbstractView::addSubmenus();
		if(!in_array('reports',$submenus)){
			XiAbstractView::addSubmenus('reports');
		}
		$layout  =  (isset($this->layout))?$this->layout:'default';

		//app will ask subscription details at order confirm page only
		if ($view instanceof PayplansadminViewReports && $task == 'display'){
			return self::renderTemplate($view, $layout);
		}
	}
	
	public function renderTemplate(&$view, $layout)
	{
		
		$planModel 	= PayplansFactory::getInstance('plan','model');
		$plans 		= $planModel->loadRecords();
		
		$subStatus 	= PayplansStatus::getStatusOf('subscription');
		$invStatus 	= PayplansStatus::getStatusOf('invoice');
		
		//none and checkout status not required
		unset($invStatus[0]);
		unset($invStatus[401]);
		
		$exportable = array('invoice','user','subscription');
		$gateways	= PayplansHelperApp::getAvailableApps('payment');
		
		$this->_assign('exportable', $exportable);
		$this->_assign('plans', $plans);
		$this->_assign('subStatus', $subStatus);
		$this->_assign('invStatus', $invStatus);
		$this->_assign('gateways', $gateways);

		if(isset($this->nodata) && $this->nodata)
		{
			$this->_assign('nodata', $this->nodata);	
		}
		
		$tabcontent = "<li class='active'><a href='#export' data-toggle='tab'>".XiText::_('COM_PAYPLANS_REPORTS_EXPORT')."</a></li>";
		$content    = $this->_loadTemplate($layout);
		
		return array('payplans-admin-reports-tabs'=> $tabcontent, 'payplans-admin-reports-contents'=> $content);
	}
	
	
	public function onPayplansExportingData()
	{	
		$this->_exportFile = dirname(__FILE__).DS.'tmp.csv';
		
		$input 		 		 = JFactory::getApplication()->input;
		$this->export 		 = $input->get('export','invoice');
		$this->plan 		 = $input->get('plan',array(),'array');
		$this->subStatus 	 = $input->get('subStatus',array(),'array');
		$this->invStatus 	 = $input->get('invStatus',array(),'array');
		$this->startDate   	 = $input->get('export_from');
		$this->endDate	 	 = $input->get('export_to');
		$this->gateway		 = $input->get('gateway',array(),'array');
		
		$records 	 = array();
				
		$query	= new XiQuery();
		
		$functionName = "exporting".ucfirst($this->export);
		
		$this->$functionName($query,$input);
		
		//delete existing file and create new file
		if(file_exists($this->_exportFile)){
			JFile::delete($this->_exportFile);
		}
			
		if($this->executeExportQuery($query) && file_exists($this->_exportFile)){
			$this->layout = "default_export_file";
			$this->_assign('file',$this->_exportFile);
			$this->_assign('tablename', $this->export);
			return true;	
		}
		
		$app = XiFactory::getApplication();
		$app->enqueueMessage(XiText::_("COM_PAYPLANS_REPORTS_EXPORT_NO_DATA"), 'warning');
		return true;
	}
	
	public function exportingUser(&$query,$input)
	{
		$fieldsToExport =  " export_users.id as `user_id`
							,export_users.username as `username`
							,export_users.email as `email` ";	

		$subsCondition = "#__payplans_subscription as `export_subscription` on export_subscription.user_id = export_users.id ";
		
		if(!empty($this->plan))
		{
			$subsCondition .= " and export_subscription.plan_id in (".implode(',',$this->plan).") ";
		}
		
		if(!empty($this->subStatus))
		{
			$subsCondition .= " and export_subscription.status in (".implode(',',$this->subStatus).") ";				
		}
		if(!empty($this->startDate))
			$subsCondition .= " and Date(export_subscription.subscription_date)   >= '$this->startDate' ";

		if(!empty($this->endDate))
			$subsCondition .= " and Date(export_subscription.subscription_date)   <= '$this->endDate' ";
			
		$query->select($fieldsToExport)
			  ->from("#__users as `export_users` ")	
			  ->innerJoin($subsCondition)		  
			  ->group("export_users.id");
	}
	
	public function exportingSubscription(&$query,$input)
	{		
		$fieldsToExport =  " export_subscription.subscription_id as `subscription_id`
							,export_subscription.user_id as `user_id`
						    ,export_subscription.status as `status`
							,export_subscription.total as `total`
							,Date(export_subscription.subscription_date) as `subscription_date` ";	

		$subsCondition = "#__payplans_subscription as export_subscription ";

		$query->select($fieldsToExport)
			  ->from($subsCondition)			  
			  ->group("export_subscription.subscription_id");
		
		if(!empty($this->plan))
		{
			$query->where(" export_subscription.plan_id in (".implode(',',$this->plan).") ");
		}
		
		if(!empty($this->subStatus))
		{
			$query->where(" export_subscription.status in (".implode(',',$this->subStatus).") ");				
		}
		if(!empty($this->startDate))
			$query->where(" Date(export_subscription.subscription_date)   >= '$this->startDate' ");

		if(!empty($this->endDate))
			$query->where(" Date(export_subscription.subscription_date)   <= '$this->endDate' ");
	}
	
	public function exportingInvoice(&$query,$input)
	{
	
		$fieldsToExport =  "	export_invoice.invoice_id as `invoice_id`
								,export_invoice.user_id as `user_id`
								,export_invoice.subtotal as `subtotal`
								,export_invoice.total as `total`
								,export_invoice.currency as `currency`
								,export_invoice.status as `status`
								,export_payment.app_id as `gateway`
								,Date(export_wallet.created_date) as `paid_date` ";

		$subsCondition    = "#__payplans_subscription as `export_subscription` on export_subscription.order_id = export_invoice.object_id ";
		$walletCondition  = "#__payplans_wallet as `export_wallet` on export_wallet.invoice_id = export_invoice.invoice_id ";
		$paymentCondition = "#__payplans_payment as `export_payment` on export_payment.invoice_id = export_invoice.invoice_id "; 
		
		if(!empty($this->plan))
		{
			$subsCondition .= " AND export_subscription.plan_id in (".implode(',',$this->plan).") ";
		}
		
		if(!empty($this->invStatus))
		{
			$subsCondition .= " AND export_invoice.status in (".implode(',',$this->invStatus).") ";				
		}
		if(!empty($this->startDate))
			$walletCondition .= " AND Date(export_wallet.created_date)   >= '$this->startDate' ";

		if(!empty($this->endDate))
			$walletCondition .= " AND Date(export_wallet.created_date)   <= '$this->endDate' ";
	
		if(!empty($this->gateway))
			$paymentCondition .= " AND export_payment.app_id  in (".implode(',',$this->gateway).") ";

		$query->select($fieldsToExport)
			  ->from("#__payplans_invoice as `export_invoice`")			  
			  ->innerJoin($subsCondition)
			  ->innerJoin($walletCondition)
			  ->innerJoin($paymentCondition)
			  ->group("export_invoice.invoice_id");
	}

	
	public function executeExportQuery($query,$limitStart=0)
	{
		//fetch limit from plugin param\
		$limit = $this->params->get('export_limit',50);
		
		$limitedQuery = $query;
		
		$limitedQuery->limit($limit,$limitStart);
		
		$limitStart = $limitStart + $limit; 
		
		$records = $limitedQuery->dbLoadQuery()->loadObjectList();
		
		//means if no data is fetched then return 
		if(empty($records))
		{
			return true;
		}
		
		$limitedData = $this->convertToCsv($records);
		
		if($this->createExportFile($limitedData))
		{
			$this->executeExportQuery($query,$limitStart);
		}
		else{
			return false;
		}
		
		return true;
	}
	
	public function convertToCsv($records = array())
	{
		//convert data to csv formate
		$exportData = "\"";	
		$count 		= count($records);	
		$counting   = 0;

		//create header here but only once	
		if(!$this->_headerSeted)
		{
			$header = array_keys((array)$records[0]);
			$exportData .= implode('","',$header)."\"\n\"";
			$this->_headerSeted = true;
		}
		$records = $this->modifyRecords($records);
	
		foreach ($records as $key => $record)
		{
			$counting++;
			$record = (array)$record;
			$exportData = $exportData.implode('","',$record)."\"\n\"";
		}
		
		$exportData = substr_replace($exportData ,"",-1);
		
		return $exportData;
	}
	
	public function createExportFile($data)
	{		
		try{
			$fhandle = fopen($this->_exportFile,"a");		
			fwrite($fhandle, $data);
		}
		//if something gona happens with the file may be permission issue or not found then handle it
		catch(Exception $e){
			return false;
		}
		return true;
	}

	
	public function modifyRecords($records = array())
	{
		$paymentApp = PayplansHelperApp::getAvailableApps('payment');
		foreach ($paymentApp as $app){
			$paymentGateways[$app->getId()]=$app->getType();
		}
		
		$conditionToModify = array('gateway'=>$paymentGateways);

		if(isset($records[0]->gateway)){
			foreach ($records as $key => $record){
				$records[$key]->gateway = (isset($record->gateway))? $conditionToModify['gateway'][$record->gateway]:$records[$key]->gateway;	
			}
	    }
		
		return $records;
	}

	public function onPayplansGetPlugin()
	{
		$xml = dirname(__FILE__).DS.'export.xml';
		if (file_exists($xml)) {
			$xmlContent = simplexml_load_file($xml);
		}
		else {
			$xmlContent = null;
		}
		return array('name'   => 'export',
				'value' =>$xmlContent);
	}
}

