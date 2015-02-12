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

jimport('joomla.application.component.modelitem');
JTable::addIncludePath(DS.'components'.DS.JRequest::getVar('option').DS.'tables');


class JBusinessDirectoryModelOrders extends JModelItem
{ 
	
	function __construct()
	{
		$this->log = Logger::getInstance();
		parent::__construct();

	}

	function getOrder($orderId){
		$orderTable = JTable::getInstance("Order", "JTable", array());
		$orderTable->load($orderId);
		
		$properties = $orderTable->getProperties(1);
		$order = JArrayHelper::toObject($properties, 'JObject');
		
		$packageTable = JTable::getInstance("Package", "JTable", array());
		$order->package = $packageTable->getPackage($order->package_id);
		
		return $order;
	}
	
	function getLastCompanyOrder($companyId){
		$orderTable = JTable::getInstance("Order", "JTable", array());
		$order = $orderTable->getLastNonPaidCompanyOrder($companyId);
		
		return $order;
	}
	
	function getOrders(){
		$user = JFactory::getUser();
		$orderTable = JTable::getInstance("Order", "JTable", array());
		$orders = $orderTable->getOrders($user->id);
		return $orders;
	}
	
	function updateOrder($data, $processor){
		$orderTable = JTable::getInstance("Order", "JTable", array());
		$orderTable->load($data->order_id);
		
		$orderTable->transaction_id = $data->transaction_id;
		$orderTable->amount_paid = $data->amount;
		$orderTable->paid_at = date("Y-m-d h:m:s");
		
		// set start_date
		$packageTable = JTable::getInstance("Package", "JTable", array());
		$lastPaidPackage = $packageTable->getLastPaidPackage($orderTable->company_id);
		if(isset($lastPaidPackage) && $processor->type!="paypalsubscriptions"){
			$lastActiveDay = date('Y-m-d', strtotime($lastPaidPackage->start_date. ' + '.$lastPaidPackage->days.' days'));
			if(strtotime(date("Y-m-d"))<=strtotime($lastActiveDay)){
				$orderTable->start_date = $lastActiveDay;
			}else{
				$orderTable->start_date = date("Y-m-d");
			}
		}else{
			$orderTable->start_date = date("Y-m-d");
		}
		$orderTable->state = 1;
		
		if(!$orderTable->store()){
			throw  new Exception(JText::_("LNG_ERROR_ADDING_ORDER").$this->_db->getErrorMsg());
			$this->log->LogError("Error updating order. Order ID: ".$data->order_id);
		}
		
		$this->log->LogDebug("Order has been successfully updated. Order ID: ".$data->order_id);
		
		return $orderTable;
	}
	
}
?>

