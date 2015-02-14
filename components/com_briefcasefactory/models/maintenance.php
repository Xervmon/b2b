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

class BriefcaseFactoryFrontendModelMaintenance extends JModelLegacy
{
  public function perform()
  {
    $this->cleanupExpiredFiles();
    $this->cleanupExpiredFolderShares();
    $this->cleanupExpiredFileShares();
    $this->cleanupExpiredPublicFolderShares();
    $this->cleanupExpiredPublicFileShares();
  }

  protected function cleanupExpiredFiles()
  {
    $dbo  = $this->getDbo();
    $date = JFactory::getDate();

    $query = $dbo->getQuery(true)
      ->select('f.id')
      ->from('#__briefcasefactory_files f')
      ->where('f.valid_until <> ' . $dbo->quote($dbo->getNullDate()))
      ->where('f.valid_until < ' . $dbo->quote($date->toSql()));
    $results = $dbo->setQuery($query)
      ->loadObjectList('id');

    require_once JPATH_COMPONENT_ADMINISTRATOR . '/libraries/factory/loader.php';
    JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');
    $model = JModelLegacy::getInstance('FileCron', 'BriefcaseFactoryFrontendModel');

    $model->delete(array_keys($results));
  }

  protected function cleanupExpiredFolderShares()
  {
    $dbo = $this->getDbo();

    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_folders')
      ->where('until <>' . $dbo->quote($dbo->getNullDate()))
      ->where('until < ' . $dbo->quote(JFactory::getDate()->toSql()));

    return $dbo->setQuery($query)
      ->execute();
  }

  protected function cleanupExpiredFileShares()
  {
    $dbo = $this->getDbo();

    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_files')
      ->where('until <>' . $dbo->quote($dbo->getNullDate()))
      ->where('until < ' . $dbo->quote(JFactory::getDate()->toSql()));

    return $dbo->setQuery($query)
      ->execute();
  }

  protected function cleanupExpiredPublicFolderShares()
  {
    $dbo = $this->getDbo();
    $query= $dbo->getQuery(true)
      ->update('#__briefcasefactory_folders')
      ->set('share_public = ' . $dbo->quote(0))
      ->set('share_until = ' . $dbo->quote($dbo->getNullDate()))
      ->where('share_public = ' . $dbo->quote(1))
      ->where('share_until <> ' . $dbo->quote($dbo->getNullDate()))
      ->where('share_until < ' . $dbo->quote(JFactory::getDate()->toSql()));

    return $dbo->setQuery($query)
      ->execute();
  }

  protected function cleanupExpiredPublicFileShares()
  {
    $dbo = $this->getDbo();
    $query= $dbo->getQuery(true)
      ->update('#__briefcasefactory_files')
      ->set('share_public = ' . $dbo->quote(0))
      ->set('share_until = ' . $dbo->quote($dbo->getNullDate()))
      ->where('share_public = ' . $dbo->quote(1))
      ->where('share_until <> ' . $dbo->quote($dbo->getNullDate()))
      ->where('share_until < ' . $dbo->quote(JFactory::getDate()->toSql()));

    return $dbo->setQuery($query)
      ->execute();
  }
}
