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

class JFormFieldBriefcaseFileShareGroups extends JFormField
{
	public $type = 'BriefcaseFileShareGroups';

  protected function getInput()
  {
    $html = array();

    $id = $this->form->getValue('id');

    if (!$id) {
      return '';
    }

    $html[] = '<a href="' . FactoryRoute::view('sharegroups&tmpl=component&id=' . $id) . '" class="btn btn-primary btn-small modal" rel="{ handler: \'iframe\', size: { x: 500, y: 300 }}">';
    $html[] = '<i class="icon-share"></i>&nbsp;' . FactoryText::_('file_share_group');
    $html[] = '</a>';

    return implode("\n", $html);
  }
}
