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

JFormHelper::loadFieldType('File');

class JFormFieldFactoryFile extends JFormFieldFile
{
  public $type = 'FactoryFile';
}

class JFormRuleFactoryFile extends JFormRule
{
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
    if ($value && isset($value->error) && $value->error) {
      return false;
    }

    return true;
	}
}
