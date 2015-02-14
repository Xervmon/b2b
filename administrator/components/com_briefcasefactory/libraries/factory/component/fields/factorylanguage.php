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

class JFormFieldFactoryLanguage extends JFormFieldList
{
  protected $type = 'FactoryLanguage';

	protected function getOptions()
	{
    $array = array();
    $languages = JHtml::_('contentlanguage.existing');
    array_unshift($languages, (object)array('value' => '*', 'text' => JText::_('JALL')));

    foreach ($languages as $language) {
      $array[$language->value] = $language->text;
    }

	  return $array;
	}
}
