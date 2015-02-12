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

class JBusinessDirectoryControllerManageRatings extends JControllerLegacy
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
		$model = $this->getModel('manageratings');
		$post = JRequest::get( 'post' );
		$post["id"] = $post["reviewId"];
		if ($model->store($post)) 
		{
			$msg = JText::_('LNG_REVIEW_SAVED');
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings', $msg );
		} 
		else 
		{
			$msg = '';
			JError::raiseWarning( 500, JText::_("LNG_ERROR_SAVING_REVIEW"));
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings', $msg );	
		}

		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		
		$msg = JText::_('LNG_OPERATION_CANCELLED');
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings', $msg );
	}
	
	function delete()
	{
		$model = $this->getModel('manageratings');

		if ($model->deleteReview()) {
			$msg = JText::_('LNG_REVIEW_HAS_BEEN_DELETED');
		} else {
			$msg = JText::_('LNG_ERROR_DELETE_REVIEW');
		}

		// Check the table in so it can be edited.... we are done with it anyway
		
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings', $msg );
	}
	
	function edit()
	{
		JRequest::setVar( 'view', 'manageratings' );
	
		parent::display(); 
		
	}
	
	function chageState()
	{
		$model = $this->getModel('manageratings');
	
		if ($model->changeState()) 
		{
			$msg = JText::_( '' );
		} else {
			$msg = JText::_('LNG_ERROR_CHANGE_ROOM_STATE');
		}

	
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageratings&view=manageratings', $msg );
	}

	function aprove(){
		$post = JRequest::get( 'post' );
		$model = $this->getModel('manageratings');
		$model ->changeAprovalState(1);
	
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view=manageratings', $msg );
	}
	
	function disaprove(){
		$post = JRequest::get( 'post' );
		$model = $this->getModel('manageratings');
		$model ->changeAprovalState(-1);
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller='. $post["controller"].'&view=manageratings', $msg );
	}
}