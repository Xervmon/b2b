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

class FactoryHtml
{
  public static function script($file, $framework = false, $relative = false, $path_only = false, $detect_browser = true, $detect_debug = true)
  {
    $file = self::parsePath($file);

    JHtml::script($file, $framework, $relative, $path_only, $detect_browser, $detect_debug);
  }

  public static function stylesheet($file, $attribs = array(), $relative = false, $path_only = false, $detect_browser = true, $detect_debug = true)
  {
    $file = self::parsePath($file, 'css');

    JHtml::stylesheet($file, $attribs, $relative, $path_only, $detect_browser, $detect_debug);
  }

  public static function scriptCompressed($files)
  {
    self::compress($files, 'js');
  }

  public static function stylesheetCompressed($files)
  {
    self::compress($files, 'css');
  }

  protected static function parsePath($file, $type = 'js')
  {
    $path  = array();
    $parts = explode('/', $file);

    $path[] = 'components';
    $path[] = self::getOption();

    if (isset($parts[0]) && 'admin' == $parts[0]) {
      array_unshift($path, 'administrator');
      unset($parts[0]);
      $parts = array_values($parts);
    }

    $path[] = 'assets';
    $path[] = $type;

    $count = count($parts);
    foreach ($parts as $i => $part) {
      if ($i + 1 == $count) {
        $path[] = $part . '.' . $type;
      } else {
        $path[] = $part;
      }
    }

    return implode('/', $path);
  }

  protected static function compress($files, $type = 'js')
  {
    jimport('joomla.filesystem.file');

    // Initialise variables.
    $filename = 'js' == $type ? 'javascript' : 'stylesheet';
    $output = JPATH_SITE . '/' . self::parsePath($filename, $type);
    $rebuild = false;

    // Check if output file exists.
    if (!JFile::exists($output)) {
      $content = '';
      JFile::write($output, $content);
      $rebuild = true;
    }
    else {
      $modified = filemtime($output);
    }

    // Check if a rebuild is required depending on files last modified dates.
    if (!$rebuild) {
      foreach ($files as $file) {
        $path = JPATH_SITE . '/' . self::parsePath($file, $type);

        if (!JFile::exists($path)) {
          continue;
        }

        if (filemtime($path) > $modified) {
          $rebuild = true;
          break;
        }
      }
    }

    // Rebuild output file.
    if ($rebuild) {
      $contents = array();
      foreach ($files as $file) {
        $path = JPATH_SITE . '/' . self::parsePath($file, $type);

        if (!JFile::exists($path)) {
          continue;
        }

        $contents[] = file_get_contents($path);
      }

      if ('js' == $type) {
        $contents = implode(';' . "\n", $contents);
      }
      else {
        $contents = implode("\n", $contents);
      }

      JFile::write($output, $contents);
    }

    // Output asset.
    if ('js' == $type) {
      self::script($filename);
    }
    else {
      self::stylesheet($filename);
    }
  }

  protected static function getOption()
  {
    return 'com_briefcasefactory';
  }
}
