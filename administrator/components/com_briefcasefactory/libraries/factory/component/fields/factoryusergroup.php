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

JFormHelper::loadFieldType('UserGroup');

class JFormFieldFactoryUserGroup extends JFormFieldUsergroup
{
  protected $type = 'FactoryUserGroup';

  protected function getInput()
  {
    $html = array();

    $html[] = '<input type="hidden" name="' . $this->name . '" id="' . $this->id . '" />';
    $html[] = parent::getInput();

    return implode("\n", $html);
  }
}
