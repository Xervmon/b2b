<?php


defined('_JEXEC') or die;
jimport('joomla.application.component.modeladmin');
/**
 * Company Model for Companies.
 *
 */
class JBusinessDirectoryModelEvent extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since   1.6
	 */
	protected $text_prefix = 'COM_JBUSINESSDIRECTORY_EVENT';

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context		= 'com_jbusinessdirectory.event';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object	A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 */
	protected function canDelete($record)
	{
		return true;
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object	A record object.
	 *
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
	 */
	protected function canEditState($record)
	{
		return true;
	}

	/**
	 * Returns a Table object, always creating it
	 *
	 * @param   type	The table type to instantiate
	 * @param   string	A prefix for the table class name. Optional.
	 * @param   array  Configuration array for model. Optional.
	 * @return  JTable	A database object
	 */
	public function getTable($type = 'Event', $prefix = 'JTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('administrator');

		// Load the User state.
		$id = JRequest::getInt('id');
		$this->setState('event.id', $id);
	}

	/**
	 * Method to get a menu item.
	 *
	 * @param   integer	The id of the menu item to get.
	 *
	 * @return  mixed  Menu item data object on success, false on failure.
	 */
	public function &getItem($itemId = null)
	{
		$itemId = (!empty($itemId)) ? $itemId : (int) $this->getState('event.id');
		$false	= false;

		// Get a menu item row instance.
		$table = $this->getTable("Event");

		// Attempt to load the row.
		$return = $table->load($itemId);

		// Check for a table object error.
		if ($return === false && $table->getError())
		{
			$this->setError($table->getError());
			return $false;
		}

		$properties = $table->getProperties(1);
		$value = JArrayHelper::toObject($properties, 'JObject');
		
		$typesTable = $this->getTable('EventType');
		$value->types = $typesTable->getEventTypes();
		
		$value->pictures = $this->getEventPictures((int) $this->getState('event.id'));
		
		if($itemId == 0){
			$value->start_date = date('Y-m-d');
			$value->end_date = date("Y-m-d");// current date
		}
		
		$value->start_date = JBusinessUtil::convertToFormat($value->start_date);
		$value->end_date = JBusinessUtil::convertToFormat($value->end_date);
		
		
		
		return $value;
	}
	
	
	function getEventPictures($eventId){
		$query = "SELECT * FROM #__jbusinessdirectory_company_event_pictures
					WHERE eventId =".$eventId ."
					ORDER BY id ";
		
		$files =  $this->_getList( $query );
		$pictures = array();
		foreach( $files as $value )
		{
			$pictures[]	= array(
					'event_picture_info' 		=> $value->picture_info,
					'event_picture_path' 		=> $value->picture_path,
					'event_picture_enable'	=> $value->picture_enable,
			);
		}
	
		return $pictures;
	}

	/**
	 * Method to get the menu item form.
	 *
	 * @param   array  $data		Data for the form.
	 * @param   boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return  JForm	A JForm object on success, false on failure
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		exit;
		// The folder and element vars are passed when saving the form.
		if (empty($data))
		{
			$item		= $this->getItem();
			// The type should already be set.
		}
		// Get the form.
		$form = $this->loadForm('com_jbusinessdirectory.event', 'item', array('control' => 'jform', 'load_data' => $loadData), true);
		if (empty($form))
		{
			return false;
		}
		
		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_jbusinessdirectory.edit.event.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
	
	
	/**
	 * Method to save the form data.
	 *
	 * @param   array  The form data.
	 * @return  boolean  True on success.
	 */
	public function save($data)
	{
		
		$id	= (!empty($data['id'])) ? $data['id'] : (int) $this->getState('event.id');
		$isNew = true;
		
		$data["start_date"] = JBusinessUtil::convertToMysqlFormat($data["start_date"]);
		$data["end_date"] = JBusinessUtil::convertToMysqlFormat($data["end_date"]);
		$data["alias"]= JBusinessUtil::getAlias($data["name"],$data["alias"]);
		
		// Get a row instance.
		$table = $this->getTable();

		// Load the row if saving an existing item.
		if ($id > 0)
		{
			$table->load($id);
			$isNew = false;
		}

		// Bind the data.
		if (!$table->bind($data))
		{
			$this->setError($table->getError());
			return false;
		}

		// Check the data.
		if (!$table->check())
		{
			$this->setError($table->getError());
			return false;
		}

		// Store the data.
		if (!$table->store())
		{
			$this->setError($table->getError());
			return false;
		}

		$this->setState('event.id', $table->id);

		// Clean the cache
		$this->cleanCache();

		//save in companycategory table
		$this->storePictures($data, $this->getState('event.id'),$id);
		
		return true;
	}

	function storePictures($data, $eventId, $oldId){
	
	
		//prepare photos
		$path_old = JBusinessUtil::makePathFile(JPATH_ROOT."/".PICTURES_PATH .EVENT_PICTURES_PATH.($oldId)."/");
		$files = glob( $path_old."*.*" );
	
		$path_new = JBusinessUtil::makePathFile(JPATH_ROOT."/".PICTURES_PATH .EVENT_PICTURES_PATH.($eventId)."/");
	
	
		//dbg($eventId);

		//exit;
		$picture_ids 	= array();
		foreach( $data['pictures'] as $value )
		{
			$row = $this->getTable('EventPictures');
	
			//dbg($key);
			$pic 						= new stdClass();
			$pic->id		= 0;
			$pic->eventId 	= $eventId;
			$pic->picture_info	= $value['event_picture_info'];
			$pic->picture_path	= $value['event_picture_path'];
			$pic->picture_enable	= $value['event_picture_enable'];
			dbg($pic);
			$file_tmp = JBusinessUtil::makePathFile( $path_old.basename($pic->picture_path) );
	
			//dbg($pic);
			dbg($file_tmp);
			dbg(is_file($file_tmp));
			//exit;
			if( !is_file($file_tmp) )
				continue;
				
			//exit;
			if( !is_dir($path_new) )
			{
				if( !@mkdir($path_new) )
				{
					throw( new Exception($this->_db->getErrorMsg()) );
				}
			}
			dump(2); 
			dbg(($path_old.basename($pic->picture_path).",".$path_new.basename($pic->picture_path)));
			//exit;
			if( $path_old.basename($pic->picture_path) != $path_new.basename($pic->picture_path) )
			{
				
				dump("rename file");
				if(@rename($path_old.basename($pic->picture_path),$path_new.basename($pic->picture_path)) )
				{
	
					$pic->picture_path	 = EVENT_PICTURES_PATH.($eventId).'/'.basename($pic->picture_path);
					//@unlink($path_old.basename($pic->room_picture_path));
				}
				else
				{
					throw( new Exception($this->_db->getErrorMsg()) );
				}
			}
	
			//exit;
			if (!$row->bind($pic))
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
					
			}
			// Make sure the record is valid
			if (!$row->check())
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
			}
	
			// Store the web link table to the database
			if (!$row->store())
			{
				throw( new Exception($this->_db->getErrorMsg()) );
				$this->setError($this->_db->getErrorMsg());
			}
	
			$picture_ids[] = $this->_db->insertid();
		}
		
		$files = glob( $path_new."*.*" );
		
		if($files && count($files)>0){	
			foreach( $files as $pic )
			{
				$is_find = false;
				foreach( $data['pictures'] as $value )
				{
					if( $pic == JBusinessUtil::makePathFile(JPATH_ROOT."/".PICTURES_PATH .$value['event_picture_path']) )
					{
						$is_find = true;
						break;
					}
				}
				//if( $is_find == false )
				//	@unlink( JBusinessUtil::makePathFile(JPATH_ROOT."/".PICTURES_PATH .$value['event_picture_path']) );
			}
		}
		
		dump($picture_ids);
		$query = " DELETE FROM #__jbusinessdirectory_company_event_pictures
		WHERE eventId = '".$eventId."'
		".( count($picture_ids)> 0 ? " AND id NOT IN (".implode(',', $picture_ids).")" : "");
	
		// dbg($query);
		
		$this->_db->setQuery( $query );
		if (!$this->_db->query())
		{
			throw( new Exception($this->_db->getErrorMsg()) );
			
		}
		dump($this->_db->getErrorMsg());
		//~prepare photos
		//exit;
	}
	
	function deleteEvent($eventId){
		$eventsTable = $this->getTable("Event");
		return $eventsTable->delete($eventId);
	}
	
	function changeState(){
		$this->populateState();
		$eventsTable = $this->getTable("Event");
		return $eventsTable->changeState($this->getState('event.id'));
	}
	
	function changeStateEventOfTheDay(){
		$this->populateState();
		$eventsTable = $this->getTable("Event");
		return $eventsTable->changeStateEventOfTheDay($this->getState('event.id'));
	}
	
	function changeAprovalState($state){
		$this->populateState();
		$eventsTable = $this->getTable("Event");
		return $eventsTable->changeAprovalState($this->getState('event.id'), $state);
	}
	
	function getCompanies(){
		$companiesTable = JTable::getInstance("Company", "JTable");
		$companies =  $companiesTable->getAllCompanies();
		return $companies;
	}
	
	function getStates(){
		$states = array();
		$state = new stdClass();
		$state->value = 0;
		$state->text = JTEXT::_("LNG_INACTIVE");
		$states[] = $state;
		$state = new stdClass();
		$state->value = 1;
		$state->text = JTEXT::_("LNG_ACTIVE");
		$states[] = $state;
	
		return $states;
	}
	
	function getStatuses(){
		$statuses = array();
		$status = new stdClass();
		$status->value = 0;
		$status->text = JTEXT::_("LNG_NEEDS_CREATION_APPROVAL");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = 1;
		$status->text = JTEXT::_("LNG_DISAPPROVED");
		$statuses[] = $status;
		$status = new stdClass();
		$status->value = 2;
		$status->text = JTEXT::_("LNG_APPROVED");
		$statuses[] = $status;
	
		return $statuses;
	}

	/**
	 * Method to delete groups.
	 *
	 * @param   array  An array of item ids.
	 * @return  boolean  Returns true on success, false on failure.
	 */
	public function delete(&$itemIds)
	{
		// Sanitize the ids.
		$itemIds = (array) $itemIds;
		JArrayHelper::toInteger($itemIds);
	
		// Get a group row instance.
		$table = $this->getTable();
	
		// Iterate the items to delete each one.
		foreach ($itemIds as $itemId)
		{
	
			if (!$table->delete($itemId))
			{
				$this->setError($table->getError());
				return false;
			}
		}
	
		// Clean the cache
		$this->cleanCache();
	
		return true;
	}
}
