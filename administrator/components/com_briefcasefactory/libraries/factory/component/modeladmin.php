<?php

/**
-------------------------------------------------------------------------
briefcasefactory - Briefcase Factory 4.0.8
-------------------------------------------------------------------------
 * @author thePHPfactory
 * @copyright Copyright (C) 2011 SKEPSIS Consult SRL. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.thePHPfactory.com
 * Technical Support: Forum - http://www.thePHPfactory.com/forum/
-------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

class FactoryModelAdmin extends JModelAdmin
{
  protected $_errors = array();

  public function __construct($config = array())
  {
    if (isset($config['option'])) {
      $this->option = $config['option'];
    }
    else {
      $this->option = JFactory::getApplication()->input->getCmd('option');
    }

    parent::__construct($config);
  }

  /**
   * @return FactoryTable
   */
  public function getTable($type = null, $prefix = null, $config = array())
	{
    if (is_null($type)) {
      $type = $this->getName();
    }

    if (is_null($prefix)) {
      $prefix = ucfirst(str_replace(array('com_', 'factory'), '', $this->option)) . 'FactoryTable';
    }

		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
    JForm::addFieldPath(JPATH_ADMINISTRATOR . '/components/com_briefcasefactory/libraries/factory/component/fields');

	  $form = $this->loadForm(
      $this->option . '.' . $this->getName(),
      $this->getName(),
      array(
        'control'   => 'jform',
        'load_data' => $loadData
      ),
      false,
      '/form');

		if (empty($form)) {
			return false;
		}

		return $form;
	}

  public function save($data)
	{
		$dispatcher = JEventDispatcher::getInstance();
		$table = $this->getTable();
		$key = $table->getKeyName();
		$pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');
		$isNew = true;

		// Include the content plugins for the on save events.
		JPluginHelper::importPlugin('content');

		// Allow an exception to be thrown.
		try
		{
			// Load the row if saving an existing record.
			if ($pk > 0)
			{
				$table->load($pk);
				$isNew = false;
			}

      // Set the new parent id if parent id not matched OR while New/Save as Copy .
      if ($table instanceof JTableNested && ($table->parent_id != $data['parent_id'] || $data['id'] == 0)) {
        $table->setLocation($data['parent_id'], 'last-child');
      }

			// Bind the data.
			if (!$table->bind($data))
			{
				$this->setError($table->getError());
				return false;
			}

			// Prepare the row for saving
			$this->prepareTable($table);

			// Check the data.
			if (!$table->check())
			{
				$this->setError($table->getError());
				return false;
			}

			// Trigger the onContentBeforeSave event.
			$result = $dispatcher->trigger($this->event_before_save, array($this->option . '.' . $this->name, $table, $isNew));
			if (in_array(false, $result, true))
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

			// Clean the cache.
			$this->cleanCache();

			// Trigger the onContentAfterSave event.
			$dispatcher->trigger($this->event_after_save, array($this->option . '.' . $this->name, $table, $isNew));

      if ($table instanceof JTableNested) {
        /* @var $table FactoryTableNested */
        // Rebuild the path for the category:
        if (!$table->rebuildPath($table->id)) {
          $this->setError($table->getError());
          return false;
        }

        // Rebuild the paths of the category's children:
        if (!$table->rebuild($table->id, $table->lft, $table->level, $table->path)) {
          $this->setError($table->getError());
          return false;
        }
      }
		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		$pkName = $table->getKeyName();

		if (isset($table->$pkName))
		{
			$this->setState($this->getName() . '.id', $table->$pkName);
		}
		$this->setState($this->getName() . '.new', $isNew);

		return true;
	}

  public function saveorder($idArray = null, $lft_array = null)
	{
		// Get an instance of the table object.
		$table = $this->getTable();

		if (!$table->saveorder($idArray, $lft_array))
		{
			$this->setError($table->getError());
			return false;
		}

		// Clear the cache
		$this->cleanCache();

		return true;
	}

	public function getError($i = null, $toString = true)
	{
		// Find the error
		if ($i === null)
		{
			// Default, return the last message
			$error = end($this->_errors);
		}
		elseif (!array_key_exists($i, $this->_errors))
		{
			// If $i has been specified but does not exist, return false
			return false;
		}
		else
		{
			$error = $this->_errors[$i];
		}

		// Check if only the string is requested
		if ($error instanceof Exception && $toString)
		{
			return (string) $error;
		}

		return $error;
	}

	public function getErrors()
	{
		return $this->_errors;
	}

	public function setError($error)
	{
		array_push($this->_errors, $error);
	}

	protected function canDelete($record)
	{
		return true;
	}

	protected function canEditState($record)
	{
		return true;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app     = JFactory::getApplication();
    $context = $this->option . '.edit.' . $this->getName();
		$data    = $app->getUserState($context . '.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

  protected function preprocessForm(JForm $form, $data, $group = 'content')
  {
    parent::preprocessForm($form, $data, $group);

    $this->setLabelAndDescription($form);
  }

  protected function setLabelAndDescription($form)
  {
    $formName = str_replace('.', '_', $form->getName());

    foreach ($form->getFieldsets() as $fieldset) {
      foreach ($form->getFieldset($fieldset->name) as $field) {
        $fieldGroup = str_replace('.', '_', $field->group);
        $fieldName = ($fieldGroup ? $fieldGroup . '_' : '') . $field->fieldname ;

        $label = $form->getFieldAttribute($field->fieldname, 'label', '', $field->group);

        if ('' == $label) {
          $label = $this->getLabelForField($fieldName, $formName);
          $form->setFieldAttribute($field->fieldname, 'label', $label, $field->group);
        }

        $desc = $form->getFieldAttribute($field->fieldname, 'description', '', $field->group);

        if ('' == $desc) {
          $desc = $this->getDescriptionForField($fieldName, $formName);
          $form->setFieldAttribute($field->fieldname, 'description', $desc, $field->group);
        }
      }
    }
  }

  protected function getLabelForField($field, $form)
  {
    $defaults = array(
      'id'        => 'JGLOBAL_FIELD_ID_LABEL',
      'published' => 'JSTATUS',
    );

    if (isset($defaults[$field])) {
      return JText::_($defaults[$field]);
    }

    return JText::_(strtoupper($form . '_form_field_' . $field . '_label'));
  }

  protected function getDescriptionForField($field, $form)
  {
    $defaults = array(
      'id'        => 'JGLOBAL_FIELD_ID_DESC',
      'published' => 'JFIELD_PUBLISHED_DESC',
    );

    if (isset($defaults[$field])) {
      return JText::_($defaults[$field]);
    }

    return JText::_(strtoupper($form . '_form_field_' . $field . '_desc'));
  }
}
