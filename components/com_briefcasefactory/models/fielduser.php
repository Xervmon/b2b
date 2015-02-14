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

class BriefcaseFactoryFrontendModelFieldUser extends JModelLegacy
{
  public function __construct($config = array())
  {
    parent::__construct($config);

    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $this->setState('list.start', JFactory::getApplication()->input->getInt('limitstart', 0));
    $this->setState('list.limit', $settings->get('pagination.users', 10));

    //$this->setState('list.limit', 1);
  }

  public function getItems()
  {
    $dbo = $this->getDbo();
    $query = $this->getListQuery()
      ->select('u.id, u.username, u.name');

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

    // Get main query.
    $query = $dbo->getQuery(true)
      ->from('#__users u')
      ->order('u.username ASC');

    // Filter by username.
    $filter = JFactory::getApplication()->input->getString('search');
    if ('' != $filter) {
      $query->where('u.username LIKE ' . $dbo->quote('%' . $filter . '%'));
    }

    return $query;
  }
}
