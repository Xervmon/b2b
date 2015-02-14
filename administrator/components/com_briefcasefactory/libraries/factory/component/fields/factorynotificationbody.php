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

JFormHelper::loadFieldType('Editor');

class JFormFieldFactoryNotificationBody extends JFormFieldEditor
{
  public $type = 'FactoryNotificationBody';

  protected function getInput()
  {
    FactoryHtml::script('admin/fields/notificationbody');

    $html = array();
    $this->element['buttons'] = 'article,pagebreak,readmore';

    $html[] = '<div class="notification-body" data-tokens="' .htmlspecialchars(json_encode($this->getTokens()), ENT_COMPAT, 'UTF-8') . '">';
    $html[] = parent::getInput();
    $html[] = '<table class="tokens"></table>';
    $html[] = '</div>';

    return implode("\n", $html);
  }

  protected function getTokens()
  {
    $xml   = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR . '/notifications.xml');
    $array = array();

    foreach ($xml->notification as $notification) {
      foreach ($notification->option as $option) {
        $type = (string)$notification['type'];
        $option = (string)$option;
        $array[$type][$option] = FactoryText::_('notification_' . $type . '_option_' . $option . '_label');
      }
    }

    return $array;
  }
}
