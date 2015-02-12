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

class BriefcaseFactoryFrontendModelShareUsers extends FactoryModelAdmin
{
  public function __construct($config = array())
  {
    parent::__construct($config);

    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $this->setState('list.start', JFactory::getApplication()->input->getInt('limitstart', 0));
    $this->setState('list.limit', $settings->get('pagination.users', 10));
  }

  public function getForm($data = array(), $loadData = true)
  {
    JFormHelper::addFormPath(JPATH_COMPONENT_SITE . '/models/forms');

    $input   = JFactory::getApplication()->input;
    $folders = $input->get('folder', array(), 'array');
    $files   = $input->get('file', array(), 'array');

    $form = JForm::getInstance('com_briefcasefactory.shareusers', 'shareusers', array('control' => 'jform'));

    $form->setFieldAttribute('folders', 'default', implode(',', $folders));
    $form->setFieldAttribute('files',   'default', implode(',', $files));

    $this->setLabelAndDescription($form);

    return $form;
  }

  public function getUsers()
  {
    $dbo = $this->getDbo();
    $query = $this->getListQuery()
      ->select('u.id, u.username');

    $results = $dbo->setQuery($query, $this->getState('list.start'), $this->getState('list.limit'))
      ->loadObjectList();

    return $results;
  }

  public function getPagination()
  {
    $pagination = new JPagination($this->getTotal(), $this->getState('list.start'), $this->getState('list.limit'));
    return $pagination;
  }

  public function getTotal()
  {
    $dbo = $this->getDbo();
    $query = $this->getListQuery()
      ->select('COUNT(u.id) AS total');

    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }

  public function getSearch()
  {
    return JFactory::getApplication()->input->getString('search');
  }

  protected function getListQuery()
  {
    $dbo = $this->getDbo();
    $user = JFactory::getUser();

    // Get main query.
    $query = $dbo->getQuery(true)
      ->from('#__users u')
      ->where('u.id <> ' . $dbo->quote($user->id))
      ->order('u.username ASC');

    // Filter by allowed groups.
    $groups = JComponentHelper::getParams('com_briefcasefactory')->get('restrictions.share_receive', array());
    if ($groups) {
      $query->leftJoin('#__user_usergroup_map m ON m.user_id = u.id')
        ->where('m.group_id NOT IN (' . implode(',', $groups) . ')');
    }

    // Filter by username.
    $filter = JFactory::getApplication()->input->getString('search');
    if ('' != $filter) {
      $query->where('u.username LIKE ' . $dbo->quote('%' . $filter . '%'));
    }

    return $query;
  }

  protected function populateState()
  {
  }
}
