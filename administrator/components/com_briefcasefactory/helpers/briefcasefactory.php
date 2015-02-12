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

class BriefcaseFactoryHelper
{
  protected static $option = 'com_briefcasefactory';
  protected static $submenu = array();

	public static function addSubmenu($vName)
	{
    $submenu = self::getSubmenu();

    foreach ($submenu as $entry) {
      switch ($entry) {
        case 'categories':
          JHtmlSidebar::addEntry(
			      JText::_(self::getOption() . '_submenu_' . $entry),
			      'index.php?option=com_categories&extension=' . self::getOption(),
			      $vName == $entry
		      );
          break;

        default:
          JHtmlSidebar::addEntry(
			      JText::_(self::getOption() . '_submenu_' . $entry),
			      'index.php?option=' . self::getOption() . '&view=' . $entry,
			      $vName == $entry
		      );
          break;
      }
    }
	}

  public static function checkSystemPlugin()
  {
    $extension = JTable::getInstance('Extension');

    $result = $extension->load(array(
      'type'    => 'plugin',
      'folder'  => 'system',
      'element' => 'briefcasefactory',
      'enabled' => 1,
    ));

    if (!$result) {
      JFactory::getApplication()->enqueueMessage(FactoryText::_('message_plugin_system_installed_enabled'), 'message');
    }

    return true;
  }

  protected static function getSubmenu()
  {
    if (self::$submenu) {
      return self::$submenu;
    }

    jimport('joomla.filesystem.file');

    $file = JPATH_ADMINISTRATOR . '/components/' . self::getOption() . '/manifest.xml';

    if (!JFile::exists($file)) {
      $filename = str_replace('com_', '', self::getOption()) . '.xml';
      $file = JPATH_ADMINISTRATOR . '/components/' . self::getOption() . '/' . $filename;
    }

    $xml = simplexml_load_file($file);
    $submenu = $xml->xpath('//extension/administration/submenu');

    if (!$submenu) {
      return self::$submenu;
    }

    $array = array();
    foreach ($submenu[0] as $menu) {
      $array[] = (string)$menu->attributes()->view;
    }

    return $array;
  }

  protected static function getOption()
  {
    return self::$option;
  }
}
