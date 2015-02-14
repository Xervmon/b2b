<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	multiloginrestrcition
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansTableLoginviolation extends XiTable
{
	public function __construct($tblFullName=null, $tblPrimaryKey='loginviolation_id', $db=null)
	{
		static $isTableExist = false;

		// if table does not exist, and static variable is not true then create table
		if(!$isTableExist && XiHelperTable::isTableExist('#__payplans_loginviolation')==false)
		{
			$sql = 'CREATE TABLE IF NOT EXISTS `#__payplans_loginviolation` (
						  `loginviolation_id` INT(11) NOT NULL AUTO_INCREMENT,
						  `user_id`		      INT(11) NOT NULL,
						  `email`			  VARCHAR(255),
						  `ip_address`        VARCHAR(255),
						  `violation_date`    DATETIME,
						  `violation_counter` INT DEFAULT 1,
						  `reset_counter`     INT DEFAULT 1,
  						   PRIMARY KEY (`loginviolation_id`),
  						   KEY `idx_user_id` (`user_id`)
						)
						ENGINE = MyISAM
						DEFAULT CHARACTER SET = utf8 
						AUTO_INCREMENT=1;';
			$dbo = XiFactory::getDBO();
			$dbo->setQuery($sql);
			
			// For resolving caching issue of tables:
			// if this work is not done then the new table is not 
			// added to the cached table list even after successfully 
			// creation of the table and sometimes generate error
			if($dbo->query()){
				XiFactory::cleanStaticCache(true);
				XiHelperTable::isTableExist('#__payplans_loginviolation');
				XiFactory::cleanStaticCache(false);
				$isTableExist = true;
			}
		}
	
		return parent::__construct($tblFullName, 'loginviolation_id', $db);
	}
 }
