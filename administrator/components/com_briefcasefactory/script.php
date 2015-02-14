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

class com_BriefcaseFactoryInstallerScript
{
  public function install($parent)
  {
  }

  public function uninstall($parent)
  {
  }

  public function update($parent)
  {
  }

  public function preflight($type, $parent)
  {
    if ('update' == $type) {
      $this->updateSchemasTable();
    }
  }

  public function postflight($type, $parent)
  {
    if ('install' == $type) {
      $this->createMenu();
    }
  }

  protected function createMenu()
  {
    JLoader::register('FactoryHelper', JPATH_ADMINISTRATOR . '/components/com_briefcasefactory/libraries/factory/helpers/helper.php');

    $menu = array(
      'menutype'    => 'briefcase-factory',
      'title'       => 'Briefcase Factory',
      'description' => 'Briefcase Factory Menu',
    );

    $items = array(
      array('title' => 'My Briefcase', 'link' => 'index.php?option=com_briefcasefactory&view=briefcase'),
      array('title' => 'Public Shares', 'link' => 'index.php?option=com_briefcasefactory&view=public'),
      array('title' => 'Private Shares', 'link' => 'index.php?option=com_briefcasefactory&view=private'),
      array('title' => 'Briefcase Settings', 'link' => 'index.php?option=com_briefcasefactory&view=settings'),
    );

    $module = array(
      'title' => 'Briefcase Factory Menu'
    );

    return FactoryHelper::createMenu($menu, $items, 'com_briefcasefactory', $module);
  }

  protected function updateSchemasTable()
  {
    $data = JInstaller::parseXMLInstallFile(JPATH_ADMINISTRATOR . '/components/com_briefcasefactory/briefcasefactory.xml');
    $extension = JTable::getInstance('Extension', 'JTable');
    $componentId = $extension->find(array('type' => 'component', 'element' => 'com_briefcasefactory'));

    $dbo = JFactory::getDbo();
    $query = $dbo->getQuery(true)
      ->select('s.version_id')
      ->from('#__schemas s')
      ->where('s.extension_id = ' . $dbo->quote($componentId));
    $result = $dbo->setQuery($query)
      ->loadResult();

    if (!$result) {
      $query = $dbo->getQuery(true)
        ->insert('#__schemas')
        ->set('extension_id = ' . $dbo->quote($componentId))
        ->set('version_id = ' . $dbo->quote($data['version']));
    }
    else {
      $query = $dbo->getQuery(true)
        ->update('#__schemas')
        ->set('version_id = ' . $dbo->quote($data['version']))
        ->where('extension_id = ' . $dbo->quote($componentId));
    }

    return $dbo->setQuery($query)
      ->execute();
  }
}
