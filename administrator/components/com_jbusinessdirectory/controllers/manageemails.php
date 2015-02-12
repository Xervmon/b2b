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

class JBusinessDirectoryControllerManageEmails extends JControllerLegacy
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
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('manageemails');

		$post = JRequest::get( 'post' );
		$post['email_content'] = JRequest::getVar('email_content', '', 'post', 'string', JREQUEST_ALLOWRAW);

		
// 		exit();
		if( checkIndexKey( '#__jbusinessdirectory_emails', array('email_name' => $post['email_name']) , 'email_id', $post['email_id'] ) )
		{
			$msg = '';
			JError::raiseWarning( 500, JText::_("LNG_EMAIL_NAME_EXISTENT"));
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails&task=add', $msg );
		}
		else if ($model->store($post)) 
		{
			$msg = JText::_('LNG_EMAIL_SAVED');
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails', $msg );
		} 
		else 
		{
			$msg = "";
			JError::raiseWarning( 500, JText::_("LNG_ERROR_SAVING_EMAIL") );
			$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails', $msg );	
		}

		// Check the table in so it can be edited.... we are done with it anyway
		
		
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		
		$msg = JText::_('LNG_OPERATION_CANCELLED');
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails', $msg );
	}
	
	function delete()
	{
		$model = $this->getModel('manageemails');

		if ($model->remove()) {
			$msg = JText::_('LNG_EMAIL_HAS_BEEN_DELETED');
		} else {
			$msg = JText::_('LNG_ERROR_DELETE_EMAIL');
		}

		// Check the table in so it can be edited.... we are done with it anyway
		
		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails', $msg );
	}
	
	function edit()
	{
		JRequest::setVar( 'view', 'manageemails' );
	
		parent::display(); 
		
	}
	
	function add()
	{
		JRequest::setVar( 'view', 'manageemails' );
	
		parent::display(); 
		
	}
	
	function state()
	{
		$model = $this->getModel('manageemails');

		if ($model->state()) {
			$msg = JText::_( '' );
		} else {
			$msg = JText::_('LNG_ERROR_CHANGE_EMAIL_STATE');
		}

		$this->setRedirect( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails', $msg );
	}
}