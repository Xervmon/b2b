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

class FactoryModelNotifications extends FactoryModelList
{
  protected
    $tableAlias = 'n',
    $filters = array('search', 'type', 'language', 'published'),
    $filterSearchFields = array('subject', 'body'),
    $defaultOrdering = 'subject',
    $defaultDirection = 'asc',
    $sortFields = array('type', 'subject', 'lang_code', 'published', 'id')
  ;

  public function getSortFields()
  {
    $array = array();

    foreach ($this->sortFields as $field) {
      if (false === strpos($field, '.')) {
        $array[$this->tableAlias . '.' . $field] = FactoryText::_($this->getName() . '_heading_' . $field);
      }
    }

    return $array;
  }

  public function getFilterType()
  {
    $xml   = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR . '/notifications.xml');
    $array = array();

    foreach ($xml->notification as $notification) {
      $type = (string)$notification['type'];
      $array[$type] = FactoryText::_('notification_type_' . $type . '_label');
    }

    return $array;
  }

  protected function addFilterLanguage(&$query)
  {
    $type = $this->getState('filter.type');

    if ('' != $type) {
      $query->where($this->tableAlias . '.type = ' . $query->quote($type));
    }
  }

  protected function getQuery()
  {
    $query = parent::getQuery();

    // Get main query.
    $query->select($this->tableAlias . '.*')
      ->from('#__briefcasefactory_notifications ' . $this->tableAlias);

    return $query;
  }
}
