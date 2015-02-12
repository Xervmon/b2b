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

class JFormFieldBriefcaseUser extends JFormField
{
	public $type = 'BriefcaseUser';

  protected function getInput()
  {
    $readOnly = (string)$this->element['readonly'] === 'readonly';

    $table  = JTable::getInstance('user');
    $userid = $this->value ? $this->value : JFactory::getUser()->id;
    $html   = array();
    $link   = FactoryRoute::view('fielduser&tmpl=component');

    $table->load($userid);

    $html[] = '<div class="input-append">';
		$html[] = '<input type="text" id="' . $this->id . '_username" value="' . htmlspecialchars($table->name, ENT_COMPAT, 'UTF-8') . '" readonly />';

    if (!$readOnly) {
      $html[] = '<a class="btn btn-primary select-user" title="' . JText::_('JLIB_FORM_CHANGE_USER') . '" href="' . $link . '">';
	    $html[] = '<i class="icon-user"></i></a>';
    }

    $html[] = '</div>';

		// Create the real field, hidden, that stored the user id.
		$html[] = '<input type="hidden" id="' . $this->id . '" name="' . $this->name . '" value="' . (int) $userid . '" />';

    return implode("\n", $html);
  }
}
