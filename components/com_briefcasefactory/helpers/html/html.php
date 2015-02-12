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

class JHtmlBriefcaseFactory
{
  public static function beginForm($url, $method = 'GET')
  {
    $app  = JFactory::getApplication();
    $html = array();

    // Add the start form tag.
    $html[] = '<form action="' . $url . '" method="' . $method . '">';

    // Check if SEF it's not enabled.
    if (!$app->get('sef', 0)) {
      $url = parse_url($url);
      parse_str($url['query'], $output);

      foreach ($output as $key => $value) {
        $html[] = '<input type="hidden" name="' . $key . '" value="' . $value . '">';
      }
    }

    FactoryHtml::script('form');

    return implode("\n", $html);
  }
}
