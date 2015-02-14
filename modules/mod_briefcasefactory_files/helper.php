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

class modBriefcaseFactoryFilesHelper
{
	public static function getList($params)
  {
    $dbo  = JFactory::getDbo();
    $date = JFactory::getDate();
    $user = JFactory::getUser();

    $query = $dbo->getQuery(true);

    switch ($params->get('type', 1)) {
      case 1: // Latest Public Files
      default:
        $query = self::getPublicFilesQuery();

        $query->order('f.created_at DESC');
        break;

      case 2: // Top Download Public Files
        $query = self::getPublicFilesQuery();

        $query->order('f.hits DESC');
        break;

      case 3: // Latest Private Shared Files
        $query->select('f.*')
          ->from('#__briefcasefactory_files f')
          ->leftJoin('#__briefcasefactory_shares_files s ON s.file_id = f.id AND s.type = ' . $dbo->quote('user') . ' AND s.type_id = ' . $dbo->quote($user->id))
          ->where('(s.until = ' . $dbo->quote($dbo->getNullDate()) . ' OR s.until > ' . $dbo->quote($date->toSql()) . ')')
          ->order('s.created_at DESC');
        break;
    }

    $results = $dbo->setQuery($query, 0, $params->get('count', 10))
      ->loadObjectList();

    foreach ($results as &$result) {
      $result->link = JRoute::_('index.php?option=com_briefcasefactory&task=file.download&id=' . $result->id);
    }

    return $results;
  }

  protected static function getPublicFilesQuery()
  {
    static $query = null;

    if (is_null($query)) {
      JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_briefcasefactory/tables');

      $dbo   = JFactory::getDbo();
      $date  = JFactory::getDate();
      $table = JTable::getInstance('Folder', 'BriefcaseFactoryTable');

      // Get public folders.
      $public = array();
      foreach ($table->getTree(1) as $item) {
        if (($item->share_public && ($item->share_until > $date->toSql() || $item->share_until = $dbo->getNullDate())) || in_array($item->parent_id, $public)) {
          $public[] = $item->id;
        }
      }

      // Get public files
      $query = $dbo->getQuery(true)
        ->select('f.*')
        ->from('#__briefcasefactory_files f')
        ->where('(f.share_public = ' . $dbo->quote(1) . ' AND (f.share_until = ' . $dbo->quote($dbo->getNullDate()) . ' OR f.share_until > ' . $dbo->quote($date->toSql()) . '))', 'OR');

      if ($public) {
        $query->where('f.folder_id IN ('.implode(',', $public).')');
      }
    }

    return $query;
  }
}
