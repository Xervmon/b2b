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

class modBriefcaseFactoryStatisticsHelper
{
	public static function getTotal($params)
  {
    if (!$params->get('total', 1)) {
      return false;
    }

    $dbo = JFactory::getDbo();
    $query = $dbo->getQuery(true)
      ->select('COUNT(1) AS count')
      ->from('#__briefcasefactory_files f');
    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }

  public static function getPublic($params)
  {
    if (!$params->get('public', 1)) {
      return false;
    }

    $dbo  = JFactory::getDbo();
    $date = JFactory::getDate();

    JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_briefcasefactory/tables');
    $table = JTable::getInstance('Folder', 'BriefcaseFactoryTable');

    // Get public folders.
    $public = array();
    foreach ($table->getTree(1) as $item) {
      if (($item->share_public && ($item->share_until > $date->toSql() || $item->share_until = $dbo->getNullDate())) || in_array($item->parent_id, $public)) {
        $public[] = $item->id;
      }
    }

    $query = $dbo->getQuery(true)
      ->select('COUNT(1) AS count')
      ->from('#__briefcasefactory_files f')
      ->where('(f.share_public = ' . $dbo->quote(1) . ' AND (f.share_until = ' . $dbo->quote($dbo->getNullDate()) . ' OR f.share_until > ' . $dbo->quote($date->toSql()) . '))', 'OR');

    if ($public) {
      $query->where('f.folder_id IN (' . implode(',', $public) . ')');
    }

    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }
}
