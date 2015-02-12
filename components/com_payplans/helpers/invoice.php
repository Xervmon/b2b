<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansHelperInvoice
{
	static function getInvoiceWithinDates($startDate, $endDate, $limitStart, $limit)
	{
		$query = new XiQuery();
		
		$query->select('*')
		      ->from('`#__payplans_invoice`')
		      ->where("Date(`paid_date`) >= '".$startDate."'")
		      ->where("Date(`paid_date`) <= '".$endDate."'" )
		      ->where("`invoice_id` <> 0")
		      ->limit($limit,$limitStart);
		
		return $query->dbLoadQuery()->loadObjectList('invoice_id');
	}

	public static function isRenewalInvoice($invoice)
	{
		// Step 1:- Check whether invoice is PayplansInvoice 
		// Step 2:- get order from invoice and ensure that it is object of PayplansOrder 
		// Step 3:- Check first_Master_Invoice_Id and current_invoice_id should not be equal.
		//			(if first_Master_Invoice_Id == current_invoice_id) then invoice is not for renewal
		// Step 4:- Check invoice has any payment record or not 
		//  		(if invoice do not have payment record then it will be treated as child invoice)
		//			(and if invoice has payment record attched then it will be considered as master invoice)
		
		// IMP:- return true if invoice is for renewal else return false
		
		// Step 1
		if(empty($invoice)){
			return false;
		}
		
		// if $invoice is not instance of PayplansInvoice then get the instance first
		if(($invoice instanceof PayplansInvoice) == false){
			$invoice = PayplansInvoice::getInstance($invoice);
			//XITODO: check $invoice
		}
		
		// Step 2
		$order = $invoice->getReferenceObject(PAYPLANS_INSTANCE_REQUIRE);
		if(($order instanceof PayplansOrder) == false){
			return false;
		}
		
		// Step 3
		if($order->getFirstInvoice() == $invoice->getId()){
			return false;
		}
		
		// Step 4
		$payment = $invoice->getPayment();
		if(($payment instanceof PayplansPayment) == false){
			// V.IMP:- Handle special case of free plan
			$total = $invoice->getTotal();
			if(number_format($total, 2) == 0.00){
				return true;
			}
			return false;
		}
		
		return true;
	}
	
	/**
	 * get the new invoice serial number for an invoice
	 * getNewSerial 
	 * @since 3.2
	 * @return string
	 */
	public static function getNewSerial(PayplansInvoice $invoice)
	{
		XiFactory::cleanStaticCache(true);
		$serialFormate = XiFactory::getConfig()->expert_invoice_serial_format;
		$lastCounter 	 = XiFactory::getConfig()->expert_invoice_last_serial;
			
		if (empty($lastCounter)) {
			$lastCounter = 0;
		}

		$lastCounter++;

		$invoicePaidOn = $invoice->getPaidDate();

		$paidDate = $paidMonth = $paidYear = $paidDay = '';
		
		$paidYear 		= PayplansHelperFormat::date($invoicePaidOn,  '%Y');
		$paidMonth	   	= PayplansHelperFormat::date($invoicePaidOn,  '%m');
		$paidDate		= PayplansHelperFormat::date($invoicePaidOn,  '%d');
		$paidDay 		= PayplansHelperFormat::date($invoicePaidOn,  '%A');
		
		$search  = array('[[number]]', '[[date]]', '[[month]]', '[[year]]','[[day]]');
		$replace = array($lastCounter, $paidDate, $paidMonth, $paidYear, $paidDay);
		
		$newSerial = str_replace($search, $replace, $serialFormate);
		
		if (strstr( $serialFormate , '[[number]]' )) {
			$configModel = XiFactory::getInstance('config', 'model');
			
			$configModel->save(array('expert_invoice_last_serial'=>$lastCounter));
		}
		
		return $newSerial;
	}
	

	
	/**
	 * reassing serial number from start to end limited records
	 * reassignSerial 
	 * @since 3.2
	 * @return bool successfull or not
	 */
	public static function reassignSerial($startLimit =0, $limit = 30)
	{
		try {

			$query = new XiQuery();
			$query->select('`invoice`.`invoice_id`')
						->from('`#__payplans_invoice` as `invoice`')
						->where("`invoice`.`status` = ".PayplansStatus::INVOICE_PAID)
						->order(' DATE(`invoice`.`paid_date`) ASC')
						->limit($limit, $startLimit);
	
			$db = PayplansFactory::getDbo();
			$db->setQuery($query, $startLimit, $limit);
			$invoiceRecords  = $db->loadObjectList();
			
			if (empty($invoiceRecords)) {
				return false;
			}
			
			foreach ($invoiceRecords as $id) {
				$invoice 		= PayplansInvoice::getInstance($id->invoice_id);
				$invoiceSerial 	= self::getNewSerial($invoice);
				
				$query 			= new XiQuery();
				$query->update('`#__payplans_invoice`')
							->set("`serial` = '".$invoiceSerial."'")
							->where("`invoice_id` = $id->invoice_id");
				
				$db = PayplansFactory::getDbo();
				$db->setQuery($query);
				$db->execute();
			}
			
			return true;
		}
		catch (Exception $e) {
			PayplansHelperLogger::log('error', $e->getMessage());
			return false;
		}
	}

	/**
	 * calculates invoice ignoring specific modifiers 
	 * @param PayplansInvoice $invoice
	 * @param integer $counter invoice number of which total should count
	 * @param array $excludedModifiers array of modifiers should not be consider while calculating total.
	 * @return string
	 * @since 3.2
	 */
	public static function totalExcludingModifiers(PayplansInvoice $invoice, $counter = 0, $excludedModifiers = array())
	{
		if ($counter == 0) {
			$counter 	= $invoice->getCounter();
		}

		$total 		= $invoice->getPrice($counter);
		$modifiers 	= $invoice->getModifiers();
		$total 		= PayplansHelperModifier::getTotal($total, $modifiers, $excludedModifiers);

		return PayplansHelperFormat::price($total);
	}
}