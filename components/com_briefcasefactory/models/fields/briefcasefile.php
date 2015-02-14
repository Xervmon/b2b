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

defined('JPATH_BASE') or die;

class JFormFieldBriefcaseFile extends JFormField
{
	public $type = 'BriefcaseFile';

  protected function getInput()
  {
    $id   = $this->form->getValue('id');
    $html = array();

    $html[] = '<a href="' . FactoryRoute::task('file.download&id=' . $id) . '">' . $this->value . '</a>';
    $html[] = '<input type="hidden" name="' . $this->name . '" id="' . $this->id . '"' . ' value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" />';

    return implode("\n", $html);
  }
}
