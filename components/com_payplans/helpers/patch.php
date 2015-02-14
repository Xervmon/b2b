<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
* website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();

jimport('joomla.filesystem.file');

class PayplansHelperPatch
{
	static function getMapper()
	{
		$_mapper = array();
		// when add new patch update the definition
		
		$_mapper  = Array('secondPatch',
						  'patch_enable_plugins',
						  'patch_enable_modules',
						  'patch_20_001_create_email_attachment_dir',
						  'patch_31_002_uninstall_appmanager',
						  'patch_31_003_disable_apps',
						  'patch_31_004_remove_rbinstallerlink',
						  'patch_32_001_add_invoice_paid_date',
						  'patch_32_002_invoice_adding_serial',
						  'patch_32_003_rename_email_templates',
						  'patch_32_004_remaining_wallet_balance_file',
						  'patch_32_005_adding_currency_symbol',
						);
		return $_mapper;
	}
	
	static function applyPatches($class='PayplansHelperPatch', $mapper=null)
	{
		if($mapper === null){
			$mapper = self::getMapper();
		}
		
		$lastPatch = XiHelperPatch::queryPatch();
		$key 	   = array_search($lastPatch, $mapper);
		
		$key++;
		
		while (isset($mapper[$key])){
			$nextPatch = $mapper[$key];
			if(method_exists($class, $nextPatch)===false){
				return false;
			}
			// XITODO : handle false return 
			$result = call_user_func(array($class, $nextPatch));
			//if some error return false
			if($result === false){
				return false;
			}
			//update current patch to database
			XiHelperPatch::updatePatch($nextPatch);			
			$key++;
		}
		
		return true;
	}

	//do install install.sql
	static function firstPatch()
	{
		return XiHelperPatch::applySqlFile(dirname(__FILE__).DS.'patch'.DS.'sql'.DS.'install.sql');
	}


	//install system data
	static function secondPatch()
	{
		// check if admin payment app already exists 
		// if exists then do nothing other wise insert it
		$query 	= new XiQuery();
		$result = $query->select('app_id')
						->from('#__payplans_app')
						->where(' `type` = "adminpay" ')
						->dbLoadQuery()->loadObjectList();
						
		if(empty($result)){
			$db = XiFactory::getDBO();
			$sql = "INSERT IGNORE INTO `#__payplans_app` 
					(`title`, `type`, `description`, `core_params`, `app_params`, `ordering`, `published`) 
					VALUES
					('Admin Payment', 'adminpay', 'Through this application Admin can create payment from back-end. There is no either way to create payment from back-end. This application can not be created, changed and deleted. And can not be used for fron-end payment.', 'applyAll=1\n\n', '\n', 1, 1)";
			$db->setQuery($sql);
			$db->query();
		}
		return XiHelperPatch::applySqlFile(dirname(__FILE__).DS.'patch'.DS.'sql'.DS.'system-data.sql');
	}

	static function patch_enable_plugins()
	{
		$enable=1;
		$plugins = array( 
						array('system',		'payplans'),
					 	array('payplans',	'discount'),
					 	array('payplansmigration',	'sample'),
					    array('payplansregistration', 'auto'),
					  );
						
		foreach($plugins as $plugin){
			$folder = $plugin[0];
			$pluginName = $plugin[1];
			XiHelperPatch::changePluginState($pluginName, $enable, $folder);
		}

		return true;
	}
	
	static function patch_enable_modules()
	{
		$enable=1;
		$modules	= array(
					'mod_payplans_quickicon'	=> 'icon'
				);
		foreach($modules as $module=>$position){
			XiHelperPatch::changeModuleState($module, $position, $enable);
		}

		// special case order mod_payplans_setup at least order
		XiHelperPatch::changeModuleOrder(-100, 'mod_payplans_setup');
		return true;
	}
		
    //enbale only system plugin during upgradation
	static function patch_enable_system_plugin($enable=1)
	{
		XiHelperPatch::changePluginState('payplans', $enable, 'system');
        return true;
	}

	static function patch_20_001_create_email_attachment_dir()
	{
		$path = JPATH_SITE.DS.'media'.DS.'payplans'.DS.'app'.DS.'email';
		//check if folder exist or not. If not exists then create it.
		if(JFolder::exists($path)==false)
		{	
			return JFolder::create($path);
		}
		return true;
	}
	
	static function patch_31_002_uninstall_appmanager()
	{
		XiHelperPatch::uninstallPlugin('appmanager', 'payplans');

		return true;
	}
	
	/*
	 * here we need to disable the multilogin resitrition app
	 * of date related fixes payplans 3.1
	*/
	static function patch_31_003_disable_apps()
	{
		XiHelperPatch::changePluginState('multiloginrestriction',0,'payplans');
	
		return true;
	}

	/**
	*	remove the rb-installer menu link if it already exists casue
	*	when it upgrade then it will uninstall itself
	*/
	static function patch_31_004_remove_rbinstallerlink()
	{
		$db = JFactory::getDbo();
		$query = "DELETE FROM `#__menu` WHERE `alias` = 'com-rbinstaller'";
		$db->setQuery($query);
		$db->execute();

		return true;
	}
	

	/*
	 * Create a paid_date column and migrate the wallet created date in invoice paid date
	*/
	static function patch_32_001_add_invoice_paid_date()
	{
		  $db  = XiFactory::getDBO();
          $sql = 'show columns from #__payplans_invoice';
          $db->setQuery($sql);
                  
          $columns = $db->loadColumn();
                  
          if(!in_array('paid_date', $columns)){
               $sql = "ALTER table ". $db->quoteName('#__payplans_invoice')
                    ." ADD `paid_date` datetime NOT NULL";
            	$db->setQuery($sql);
                      
            if(!$db->query()){
                  return false;
            }
          }
   
          if(XiHelperTable::isTableExist("#__payplans_wallet")){
	          $updateSql = "UPDATE". $db->quoteName('#__payplans_invoice')." as i ,"
	                       .$db->quoteName('#__payplans_wallet').
	                       "as w SET i.`paid_date` = w.`created_date` where 
	                        i.invoice_id = w.invoice_id 
	                        AND i.status = ". PayplansStatus::INVOICE_PAID;
	                  
	          $db->setQuery($updateSql);        
	          if(!$db->query()){
	                return false;
	          }
          }
	     return true;
    }    

	/**
	 * Add new column "serial" in invoice table , if exist then do not create new one
	 * patch_32_002_invoice_adding_serial 
	 * @since 3.2
	 * @return true
	 */
	static function patch_32_002_invoice_adding_serial()
	{
		$config 		= XiFactory::getConfig();
		$db 			= XiFactory::getDBO();
		$dbName 		= $config->db;
		$tablePrefix 	= $config->dbprefix;
		$tableName 		= $tablePrefix."payplans_invoice";
		
		$query 	= new XiQuery();
		
		$result = $query->select('*')
						->from('information_schema.COLUMNS')
						->where('TABLE_SCHEMA = "'.$dbName.'"')
						->where('TABLE_NAME = "'.$tableName.'"')
						->where('COLUMN_NAME = "serial"')					
						->dbLoadQuery()->loadObjectList();
						
		if(empty($result)){
			$sql = "ALTER TABLE `#__payplans_invoice` ADD `serial` VARCHAR( 255 ) DEFAULT NULL AFTER `invoice_id`";
			$db->setQuery($sql);
			$db->query();
		}
	
		return true;
	}
	
	/**
	 * we have rename the email template upper case to all lower case.
	 * @since 3.2
	 * @return boolean
	 */
	static function patch_32_003_rename_email_templates()
	{
		$folder = PAYPLANS_PATH_LIBRARY.DS.'app'.DS.'email'.DS.'tmpl';
		
		$files = JFolder::files($folder, '.php$');
		
		$results = array();
		
		if(is_array($files)) {
			foreach ($files as $file) {
				$newFile = strtolower($file);
				$results[] = JFile::move($folder.DS.$file, $folder.DS.$newFile);
			}
		}
		
		if(in_array(false, $results))
		{
			return false;
		}
		
		return true;
	}

	static function patch_32_004_remaining_wallet_balance_file()
	{
		$filePath   = JPATH_SITE.DS.'tmp'. DS.'walletamount.csv';
		
		if(file_exists($filePath)){
			return true;
		}
		
		$db    		= JFactory::getDbo();
		$query 		= $db->getQuery(true);
		if(!XiHelperPatch::isTableExist('#__payplans_wallet')){
			return true;
		}

		//SELECT u.`id`,u.`email`, sum(w.`amount`) FROM `j910_payplans_wallet`as w, `j910_users` as u where w.`user_id` = u.`id` group by w.`user_id` having sum(w.`amount`)>0 	
		$query->clear();
		$query->select('`id`,`email`, sum(`amount`) as remaining_amount')
			  ->from($db->quoteName('#__payplans_wallet'))
			  ->from($db->quoteName('#__users'))
			  ->where('`user_id` = `id`')
			  ->group('`user_id`')
			  ->having('sum(`amount`)>0');
		
		$record = $db->setQuery($query)->loadAssocList();
		if (empty($record)){
			return true;
		}
		
		file_put_contents($filePath, "id,email,remaining_amount"."\n");
		
		foreach ($record as $userid=>$result)
		 {
		  $result = implode(',', $result);
		  file_put_contents($filePath,$result."\n",  FILE_APPEND);
		 }
		return true;
	}

	static function patch_32_005_adding_currency_symbol()
	{
		$currencies	= array('ADP' => '₧', 'CLF' => 'UF', 'CYP' => '£', 'ECS' => 'S/.', 'IEP' => '£', 'MTL' => '₤', 
							'MXN' => '$', 'SVC' => '₡', 'ZWD' => '$', 'SKK' => 'Sk');
		
		
		foreach ($currencies as $key => $value) {
				$query   = new XiQuery();
        		$query->update('`#__payplans_currency`')
         		      	  ->set('`symbol` = '."'".$value."'")
	    	   	          ->where('`currency_id` = '."'".$key."'")
					      ->dbLoadQuery()
					      ->query();
		}
		
		return true;
	}
	
}
