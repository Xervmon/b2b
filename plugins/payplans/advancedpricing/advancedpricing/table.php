<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Advancedpricing
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansTableAdvancedpricing extends XiTable
{
	public function __construct($tblFullName=null, $tblPrimaryKey='advancedpricing_id', $db=null)
	{
		static $isAdvancedPricingTableExist = false;
		// if discount table does not exist, and static variable is not true then create table
		if(!$isAdvancedPricingTableExist && XiHelperTable::isTableExist('#__payplans_advancedpricing')==false)
		{
			$sql = 'CREATE TABLE IF NOT EXISTS `#__payplans_advancedpricing` (
						  `advancedpricing_id` INT NOT NULL AUTO_INCREMENT,
						  `plans`		   VARCHAR(255) ,
						  `title`	   VARCHAR(255) ,
						  `description`	   VARCHAR(255) ,
						  `created_date`   DATETIME , 
						  `modified_date`  DATETIME ,
						  `published`	   TINYINT(1) ,
						  `units_title`	   VARCHAR(255) ,						  
						  `params`         TEXT ,
  						   PRIMARY KEY (`advancedpricing_id`)
						)
						ENGINE = MyISAM
						DEFAULT CHARACTER SET = utf8 
						AUTO_INCREMENT=1;';
			$dbo = XiFactory::getDBO();
			$dbo->setQuery($sql);
			$dbo->query();
			
			// For resolving caching issue of tables:
			// if this work is not done then the new table is not 
			// added to the cached table list even after successfully 
			// creation of the table and sometimes generate error
			if($dbo->query()){
				XiFactory::cleanStaticCache(true);
				XiHelperTable::isTableExist('#__payplans_advancedpricing');
				XiFactory::cleanStaticCache(false);
				$isAdvancedPricingTableExist = true;
			}
		}
	
		return parent::__construct($tblFullName, 'advancedpricing_id', $db);
	}
 }
 
 
 
 class PayplansTablePricingslab extends XiTable
{
	public function __construct($tblFullName=null, $tblPrimaryKey='pricingslab_id', $db=null)
	{
		static $ispricingSlabTableExist = false;
		// if discount table does not exist, and static variable is not true then create table
		if(!$ispricingSlabTableExist && XiHelperTable::isTableExist('#__payplans_pricingslab')==false)
		{
			$sql = 'CREATE TABLE IF NOT EXISTS `#__payplans_pricingslab` (
						 `pricingslab_id` INT NOT NULL AUTO_INCREMENT,
						  `advancedpricing_id` INT,
						  `min_value`	   INT ,						  
						  `max_value`	   INT ,
						  `details`	   TEXT ,
  						   PRIMARY KEY (`pricingslab_id`)
						)
						ENGINE = MyISAM
						DEFAULT CHARACTER SET = utf8 
						AUTO_INCREMENT=1;';
			$dbo = XiFactory::getDBO();
			$dbo->setQuery($sql);
			$dbo->query();
			
			// For resolving caching issue of tables:
			// if this work is not done then the new table is not 
			// added to the cached table list even after successfully 
			// creation of the table and sometimes generate error
			if($dbo->query()){
				XiFactory::cleanStaticCache(true);
				XiHelperTable::isTableExist('#__payplans_pricingslab');
				XiFactory::cleanStaticCache(false);
				$ispricingSlabTableExist = true;
			}
		}
	
		return parent::__construct($tblFullName, 'pricingslab_id', $db);
	}
 }
