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

class JBusinessDirectoryControllerManageOffers extends JControllerLegacy
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
		$model = $this->getModel('manageoffers');
		
		$post = JRequest::get( 'post' );
		$post['id']= $post['offerId'];
		
		$this->preparePictures($post);
				
		if ($model->store($post)) 
		{
			$msg = JText::_('LNG_OFFER_SAVED');
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers', $msg );
		} 
		else 
		{
			$msg = '';
			JError::raiseWarning( 500, JText::_("LNG_ERROR_SAVING_OFFER"));
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers', $msg );	
		}

		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view='. $post["view"].'', $msg );
	}

	function preparePictures(&$post){
		//save images
		$pictures					= array();
		foreach( $post as $key => $value )
		{
			if(
			strpos( $key, 'offer_picture_info' ) !== false
			||
			strpos( $key, 'offer_picture_path' ) !== false
			||
			strpos( $key, 'offer_picture_enable' ) !== false
			){
				foreach( $value as $k => $v )
				{
					if( !isset($pictures[$k]) )
					$pictures[$k] = array('offer_picture_info'=>'', 'offer_picture_path'=>'','offer_picture_enable'=>1);
					$pictures[$k][$key] = $v;
				}
			}
		}
		
		$post['pictures'] 				= $pictures;
	}
	
	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{	
		$post = JRequest::get( 'post' );
		$msg = JText::_('LNG_OPERATION_CANCELLED');
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view='. $post["view"].'', $msg );
	}
	
	function edit()
	{
		JRequest::setVar( 'view', 'manageoffers' );
		parent::display(); 
	}
	
	function delete(){
		$post = JRequest::get( 'post' );
		$model = $this->getModel('manageoffers');
		$msg ='';
		if($model->deleteOffer($post["offerId"]))
			$msg = JText::_('LNG_OFFER_DELETED');
		else
			$msg = JText::_('LNG_OFFER_NOT_DELETED');
		
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view='. $post["view"].'', $msg );
	}
	
	function aprove(){
		$post = JRequest::get( 'post' );
		$model = $this->getModel('manageoffers');
		$model ->changeAprovalState(1);
		
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view='. $post["view"].'', $msg );
	}
	
	function disaprove(){
		$post = JRequest::get( 'post' );
		$model = $this->getModel('manageoffers');
		$model ->changeAprovalState(-1);
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view='. $post["view"].'', $msg );
	}
	
	function chageState()
	{
		$model = $this->getModel('manageoffers');
	
		if ($model->changeState())
		{
			$msg = JText::_( '' );
		} else {
			$msg = JText::_('LNG_ERROR_CHANGE_STATE');
		}
	
	
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers', $msg );
	}
	
	
	function changeStateOfferOfTheDay()
	{
		$model = $this->getModel('manageoffers');
	
		if ($model->changeStateOfferOfTheDay())
		{
			$msg = JText::_( '' );
		} else {
			$msg = JText::_('LNG_ERROR_CHANGE_STATE');
		}
	
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageoffers&view=manageoffers', $msg );
	}
	
	
		
}