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

JFormHelper::loadFieldType('List');

class JFormFieldFactoryNotificationType extends JFormFieldList
{
  protected $type = 'FactoryNotificationType';

  protected function getInput()
  {
    $this->element['class'] .= ' notification-type';

    return parent::getInput();
  }

	protected function getOptions()
	{
    $xml   = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR . '/notifications.xml');
    $array = array();

    foreach ($xml->notification as $notification) {
      $type = (string)$notification['type'];
      $array[$type] = FactoryText::_('notification_type_' . $type . '_label');
    }

    return $array;
	}
}
