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

class JFormFieldBriefcaseStorageFolder extends JFormField
{
	public $type = 'BriefcaseStorageFolder';

  protected function getInput()
  {
    if (!$this->value) {
      $this->value = JPATH_SITE . '/media/com_briefcasefactory/';
    }

    $html = array();

    $html[] = '<input type="hidden" class="storageFolder" name="' . $this->name . '" id="' . $this->id . '" value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" />';

    $html[] = '<a href="index.php?option=com_briefcasefactory&view=storagefolder&tmpl=component&folder=' . base64_encode($this->value) . '" class="modal storageFolder" rel="{ handler: \'iframe\' }">';
    $html[] = $this->value;
    $html[] = '</a>';

    return implode("\n", $html);
  }
}
