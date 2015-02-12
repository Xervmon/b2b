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

JHTML::_('script', 		'manage.banners.js', 		'administrator/components/com_jbusinessdirectory/assets/js/');
JHTML::_('script', 		'jquery.upload.js',		 	'administrator/components/com_jbusinessdirectory/assets/js/');

class JBusinessDirectoryControllerManageBanners extends JControllerLegacy
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
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('managebanners');
		
		$post = JRequest::get( 'post' );
		$post['id']= $post['bannerId'];
		 if ($model->store($post)) 
		{
			$msg = JText::_('LNG_BANNER_SAVED');
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=managebanners&view=managebanners', $msg );
		} 
		else 
		{
			$msg = '';
			JError::raiseWarning( 500, JText::_("LNG_ERROR_SAVING_BANNER"));
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=managebanners&view=managebanners', $msg );	
		}

		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=managebanners&view=managebanners', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		
		$msg = JText::_('LNG_OPERATION_CANCELLED');
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=managebanners&view=managebanners', $msg );
	}
	
	function edit()
	{
		JRequest::setVar( 'view', 'managebanners' );
	
		parent::display(); 
		
	}
	
	
	function updateBannerTypes()
	{
		$ret = true;
		if( $ret == true )
		{
			$db = JFactory::getDBO();
				
			$query = "START TRANSACTION";
			$db->setQuery($query);
			$db->queryBatch();
			if( $ret == true )
			{
				$opt_ids = $_POST['bannerIds'];
				$db->setQuery (	" DELETE FROM #__jbusinessdirectory_banner_types
									WHERE id NOT IN (".implode(',', $opt_ids).")");
	
				if (!$db->query() )
				{
				    //dbg($db);
					$ret = false;
					$e = 'INSERT / UPDATE sql STATEMENT error !';
				}
	
				foreach($_POST['bannerNames'] as $key => $value )
				{
						
	
					//dbg($value);
					$recordId 			= isset($_POST['bannerIds'][$key]) ?trim($_POST['bannerIds'][$key]) : 0;
					$recordName			= trim($_POST['bannerNames'][ $key ]);
						
						
					$db->setQuery( "
											INSERT INTO #__jbusinessdirectory_banner_types
											(
												id,
												name
											)
											VALUES
											(
												'$recordId',
												'$recordName'
												
											)
											ON DUPLICATE KEY UPDATE
												id 				= '$recordId',
												name			= '$recordName'
											" );
					//dbg($db);
					if (!$db->query() )
					{
						// dbg($db);
						$ret = false;
						$e = 'INSERT / UPDATE sql STATEMENT error !';
					}
						
				}
			}
	
			if( $ret == true )
			{
				$query = "COMMIT";
				$db->setQuery($query);
				$db->queryBatch();
				$m="Banner Type Saved Successfully!";
			}
			else
			{
				$query = "ROLLBACK";
				$db->setQuery($query);
				$db->queryBatch();
			}
	
	
		}
	
		$buff 		= $ret ? $this->getHTMLContentBannerTypes() : '';
			
		echo '<?xml version="1.0" encoding="utf-8" ?>';
		echo '<room_statement>';
		echo '<answer error="'.($ret ? "0" : "1").'" errorMessage="'.$e.'" mesage="'.$m.'" content_records="'.$buff.'" />';
		echo '</room_statement>';
		echo '</xml>';
		exit;
	}
	
	function getHTMLContentBannerTypes()
	{
		$path = JPATH_ADMINISTRATOR . '/components/com_jbusinessdirectory/views/managebanners/view.html.php';
		include_once( $path);
	
		$view = $this->getView('managebanners');
		$db = JFactory::getDBO();
		$db->setQuery( "
								SELECT 
									*
								FROM #__jbusinessdirectory_banner_types
								ORDER BY name
								" );
		$bannerTypes 	= &$db->loadObjectList();
		// dbg($bannerTypes);
		$buff = $view->displayBannerTypes($bannerTypes);
		//var_dump($buff);
		return htmlspecialchars($buff);
	}
	
	function delete(){
		$model = $this->getModel('managebanners');
		
		if ($model->deleteBanner()) {
			$msg = JText::_('LNG_BANNER_HAS_BEEN_DELETED');
		} else {
			$msg = JText::_('LNG_ERROR_DELETE_BANNER');
		}
		
		// Check the table in so it can be edited.... we are done with it anyway
		
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=managebanners&view=managebanners', $msg );
		
	}
	
	function chageState(){
		 $model = $this->getModel('managebanners');
		 if ($model->changeState()) {
		 	$msg = JText::_('LNG_BANNER_HAS_BEEN_CHANGED');
		 } else {
		 	$msg = JText::_('LNG_ERROR_CHANGING_BANNER');
		 }
		 
		 // Check the table in so it can be edited.... we are done with it anyway
		 
		 $this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=managebanners&view=managebanners', $msg );
	}
}