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

JTable::addIncludePath(DS.'components'.DS.JRequest::getVar('option').DS.'models');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.'event.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'event.php');
JTable::addIncludePath(DS.'components'.DS.JRequest::getVar('option').DS.'tables');

class JBusinessDirectoryControllerManageCompanyEvent extends JControllerForm
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	 
	function __construct()
	{
		parent::__construct();
		$this->log = Logger::getInstance();
	}

	
	/**
	 * Dummy method to redirect back to standard controller
	 *
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$this->setRedirect(JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyevents', false));
	}
	
	protected function allowEdit($data = array(), $key = 'id'){
		return true;
	}
	
	protected function allowAdd($data = array())
	{
		return true;
	}

	public function add()
	{
		$app = JFactory::getApplication();
		$context = 'com_jbusinessdirectory.edit.managecompanyevent';
	
		$result = parent::add();
		if ($result)
		{
			$this->setRedirect(JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyevent'. $this->getRedirectToItemAppend(), false));
		}
	
		return $result;
	}
	
	
	/**
	 * Method to cancel an edit.
	 *
	 * @param   string  $key  The name of the primary key of the URL variable.
	 *
	 * @return  boolean  True if access level checks pass, false otherwise.

	 */
	public function cancel($key = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		$app = JFactory::getApplication();
		$context = 'com_jbusinessdirectory.edit.managecompanyevent';
		$result = parent::cancel();
	
	}
	
	/**
	 * Method to edit an existing record.
	 *
	 * @param   string  $key     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key
	 * (sometimes required to avoid router collisions).
	 *
	 * @return  boolean  True if access level check and checkout passes, false otherwise.
	 *
	 */
	public function edit($key = null, $urlVar = null)
	{
		$app = JFactory::getApplication();
		$result = parent::edit();
		
		return true;
	}
	
	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app      = JFactory::getApplication();
		$model = $this->getModel('event');
		$post = JRequest::get( 'post' );
		$post["pictures"] = $this->preparePictures($post);
		$recordId = $post["id"];
	
		if (!$model->save($post)){
			// Save the data in the session.
			$app->setUserState('com_jbusinessdirectory.edit.event.data', $data);
			
			// Redirect back to the edit screen.
			$this->setMessage(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_item . $this->getRedirectToItemAppend($recordId), false));
			
			return false;
		} 

		$this->setMessage(JText::_('COM_JBUSINESSDIRECTORY_EVENT_SAVE_SUCCESS'));
		
		// Redirect the user and adjust session state based on the chosen task.
		switch ($task)
		{
			case 'apply':
				exit;
				// Set the row data in the session.
				$recordId = $model->getState($this->context . '.id');
				$this->holdEditId($context, $recordId);
				$app->setUserState('com_jbusinessdirectory.edit.event.data', null);
			
				// Redirect back to the edit screen.
				$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_item . $this->getRedirectToItemAppend($recordId), false));
				break;

			default:
				// Clear the row id and data in the session.
				$this->releaseEditId($context, $recordId);
				$app->setUserState('com_jbusinessdirectory.edit.event.data', null);
							
				// Redirect to the list screen.
				$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
				break;
		}
	
	}
	
	
	function preparePictures($post){
		//save images
		$pictures					= array();
		foreach( $post as $key => $value )
		{
			if(
					strpos( $key, 'event_picture_info' ) !== false
					||
					strpos( $key, 'event_picture_path' ) !== false
					||
					strpos( $key, 'event_picture_enable' ) !== false
			){
				foreach( $value as $k => $v )
				{
					if( !isset($pictures[$k]) )
						$pictures[$k] = array('event_picture_info'=>'', 'event_picture_path'=>'','event_picture_enable'=>1);
					$pictures[$k][$key] = $v;
				}
			}
		}
	
		return $pictures;
	}
	
	function chageState()
	{
		$model = $this->getModel('Event');
	
		if ($model->changeState())
		{
			$msg = JText::_( '' );
		} else {
			$msg = JText::_('LNG_ERROR_CHANGE_STATE');
		}
	
	
		$this->setRedirect(JRoute::_('index.php?option=com_jbusinessdirectory&view=managecompanyevents', $msg));
	}
}