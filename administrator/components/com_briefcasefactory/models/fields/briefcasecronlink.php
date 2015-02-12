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

class JFormFieldBriefcaseCronLink extends JFormField
{
	public $type = 'BriefcaseCronLink';

  protected function getInput()
  {
    $html = array();

    $password = $this->form->getValue('password', 'cron');
    $url = JUri::root() . 'components/com_briefcasefactory/helpers/cron.php?password=' . $password;

    $html[] = '<a href="' . $url . '" target="_blank">' . $url . '</a>';

    return implode("\n", $html);
  }
}
