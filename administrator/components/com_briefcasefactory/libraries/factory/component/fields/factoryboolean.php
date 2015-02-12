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

JFormHelper::loadFieldType('Radio');

class JFormFieldFactoryBoolean extends JFormFieldRadio
{
  protected $type = 'FactoryBoolean';

  protected function getInput()
  {
    $this->class = 'btn-group btn-group-yesno';
    $this->element['filter'] = 'integer';

    return parent::getInput();
  }

	protected function getOptions()
	{
    $options = parent::getOptions();

    if ($options) {
      return $options;
    }

    $options = array(
      (object)array('value' => 1, 'text' => JText::_('JYES')),
      (object)array('value' => 0, 'text' => JText::_('JNO')),
    );

    if ('true' == $this->element['global']) {
      array_unshift($options, (object)array(
        'value' => '', 'text' => JText::_('JGLOBAL_USE_GLOBAL')
      ));
    }

    return $options;
	}
}
