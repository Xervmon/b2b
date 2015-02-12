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

JHTML::_('script', 		'manage.companies.js', 		'administrator/components/com_jbusinessdirectory/assets/js/');
JHTML::_('script', 		'jquery.upload.js',		 	'administrator/components/com_jbusinessdirectory/assets/js/');


class JBusinessDirectoryControllerManageCompanies extends JControllerLegacy
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */

	function __construct()
	{
		parent::__construct();
		$this->registerTask( 'state', 'state');  
		$this->registerTask( 'add', 'edit');
		$this->registerTask( 'save', 'save');
		$this->log = Logger::getInstance();
		$this->log->LogDebug("create manage companies controller");
	}


}
