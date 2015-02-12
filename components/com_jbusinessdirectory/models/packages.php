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


class JBusinessDirectoryModelPackages extends JModelItem
{ 
	
	function __construct()
	{
		parent::__construct();

	}

	function getPackages(){
		$packageTable = JTable::getInstance("Package", "JTable");
		$packages = $packageTable->getPackages();
		foreach($packages as $package){
			$package->features = explode(",", $package->featuresS);
		}
		
		return $packages;
	}
	
	
}
?>

