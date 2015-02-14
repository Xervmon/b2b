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

class BriefcaseFactoryFrontendModelSettings extends FactoryModelAdmin
{
  public function getTable($type = 'BriefcaseUser', $prefix = 'BriefcaseFactoryTable', $config = array())
  {
    return parent::getTable($type, $prefix, $config);
  }

  public function save($data)
  {
    $user = JFactory::getUser();
    $data['user_id'] = $user->id;

    $table = $this->getTable();
    if (!$table->load($data['user_id'])) {
      $table->createBlank($data['user_id']);
    }

    $params = new JRegistry($data['params']);
    $data['params'] = $params->toString();

    return parent::save($data);
  }

  public function getItem($pk = null)
  {
    $pk = JFactory::getUser()->id;

    return parent::getItem($pk);
  }

  protected function preprocessForm(JForm $form, $data, $group = 'content')
  {
    parent::preprocessForm($form, $data, $group);

    $user = JFactory::getUser();
    $settings = JComponentHelper::getParams('com_briefcasefactory');

    if (!$user->authorise('frontend.download.public', 'com_briefcasefactory')) {
      $form->removeField('notification_public');
    }

    if ($settings->get('notifications.public_shared_file.locked', 0)) {
      $form->removeField('notification_public');
    }

    if ($settings->get('notifications.private_user_shared_file.locked', 0)) {
      $form->removeField('notification_user');
    }

    if ($settings->get('notifications.private_group_shared_file.locked', 0)) {
      $form->removeField('notification_group');
    }
  }
}
