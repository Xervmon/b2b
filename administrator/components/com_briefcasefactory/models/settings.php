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

class BriefcaseFactoryBackendModelSettings extends FactoryModelSettings
{
  public function __construct($config = array())
  {
    if (!JFactory::getUser()->authorise('backend.settings', JFactory::getApplication()->input->get('option'))) {
      throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
    }

    parent::__construct($config);
  }

  public function save($data)
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $original = $settings->get('uploads.folder', JPATH_SITE . '/media/com_briefcasefactory');

    if (!parent::save($data)) {
      return false;
    }

    $this->changeStorageFolder($original);

    return true;
  }

  public function getForm($data = array(), $loadData = true)
  {
    /* @var $form JForm */
    $form = parent::getForm($data, false);

    $notifications = simplexml_load_file(JPATH_ADMINISTRATOR . '/components/com_briefcasefactory/notifications.xml');
    $results = $notifications->xpath('//notification');

    foreach ($results as $result) {
      $type = (string)$result->attributes()->type;
      $field = '<fields name="' . $type . '">'
             . '<fieldset name="notifications">'

             . '<field name="status" type="FactoryBoolean" default="1" label="' . FactoryText::_('settings_form_field_notification_status_label_' . $type) . '" description="' . FactoryText::_('settings_form_field_notification_status_desc_' . $type) . '">'
             . '<option value="1">JENABLED</option>'
             . '<option value="0">JDISABLED</option>'
             . '</field>'

             . '<field name="locked" type="FactoryBoolean" default="0" label="' . FactoryText::_('settings_form_field_notification_locked_label_' . $type) . '" description="' . FactoryText::_('settings_form_field_notification_locked_desc_' . $type) . '">'
             . '<option value="1">COM_BRIEFCASEFACTORY_LOCKED</option>'
             . '<option value="0">COM_BRIEFCASEFACTORY_UNLOCKED</option>'
             . '</field>'

             . '</fieldset>'
             . '</fields>';

      $form->setField(new SimpleXMLElement($field), 'notifications');
    }

    if ($loadData) {
      $data = $this->loadFormData();
      $this->preprocessForm($form, $data);
			$form->bind($data);
    }

    return $form;
  }

  protected function changeStorageFolder($original)
  {
    $extension = JTable::getInstance('Extension');
    $result = $extension->find(array('type' => 'component', 'element' => 'com_briefcasefactory'));
    $extension->load($result);
    $params = new JRegistry($extension->params);

    $current = $params->get('uploads.folder', JPATH_SITE . '/media/com_briefcasefactory');

    if ($original == $current) {
      return true;
    }

    jimport('joomla.filesystem.folder');
    $folders = JFolder::folders($original);

    foreach ($folders as $folder) {
      JFolder::move($original . '/' . $folder, $current . '/' . $folder);
    }

    return true;
  }
}
