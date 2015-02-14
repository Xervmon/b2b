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

class FactoryHelper
{
  public static function getFileContents($file)
  {
    // Try using CURL.
    if (function_exists('curl_init')) {
      $handle = curl_init();

      curl_setopt ($handle, CURLOPT_URL,            $file);
      curl_setopt ($handle, CURLOPT_MAXREDIRS,      5);
      curl_setopt ($handle, CURLOPT_AUTOREFERER,    1);
      curl_setopt ($handle, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt ($handle, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt ($handle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($handle, CURLOPT_TIMEOUT,        10);

      $buffer = curl_exec($handle);
      curl_close($handle);

      return $buffer;
    }

    // Try using fopen.
    if (ini_get('allow_url_fopen')) {
      $fp = fopen($file, 'r');

      if (!$fp) {
        return false;
      }

      stream_set_timeout($fp, 20);
      $string = '';
      while ($read = fread($fp, 4096)) {
        $string .= $read;
      }

      $info = stream_get_meta_data($fp);
      fclose($fp);

      if ($info['timed_out']) {
        return false;
      }

      return $string;
    }

    return false;
  }

  public static function createMenu($menu, $items, $component, $module)
  {
    // Check if menu already exists.
    if (self::menuTypeExists($menu['menutype'])) {
      return true;
    }

    // Create menu.
    self::createMenuType($menu);

    // Create menu items.
    self::createMenuItems($menu, $items, $component);

    // Create menu module.
    self::createMenuModule($menu, $module);

    return true;
  }

  protected static function menuTypeExists($menuType)
  {
    $table = JTable::getInstance('MenuType');
    $result = $table->load(array('menutype' => $menuType));

    return $result;
  }

  protected static function createMenuType($menu)
  {
    $table = JTable::getInstance('MenuType');

    return $table->save($menu);
  }

  protected static function createMenuItems($menu, $items, $component)
  {
    $extension = JTable::getInstance('Extension');
    $componentId = $extension->find(array('type' => 'component', 'element' => $component));

    foreach ($items as $item) {
      self::createMenuItem($menu, $item, $componentId);
    }
  }

  protected static function createMenuItem($menu, $item, $componentId)
  {
    $defaults = array(
      'menutype'     => $menu['menutype'],
      'alias'        => JFilterOutput::stringURLSafe($item['title']),
      'type'         => 'component',
      'published'    => 1,
      'parent_id'    => 1,
      'level'        => 1,
      'component_id' => $componentId,
      'access'       => 1,
      'client_id'    => 0,
      'language'     => '*',
    );

    $data = array_merge($defaults, $item);
    $table = JTable::getInstance('Menu');

    $table->setLocation($data['parent_id'], 'last-child');

    return $table->save($data);
  }

  protected static function createMenuModule($menu, $module, $position = 'position-7')
  {
    $data = array(
      'title'     => $module['title'],
      'ordering'  => 0,
      'position'  => $position,
      'published' => 1,
      'module'    => 'mod_menu',
      'access'    => 1,
      'showtitle' => 1,
      'language'  => '*',
      'client_id' => 0,
      'params'    => '{"menutype":"' . $menu['menutype'] . '"}',
    );

    $table = JTable::getInstance('Module');

    if (!$table->save($data)) {
      return false;
    }

    $dbo = JFactory::getDbo();
    $dbo->setQuery('INSERT INTO `#__modules_menu` (moduleid, menuid) VALUES (' . $table->id . ', 0)');

    return $dbo->execute();
  }
}
