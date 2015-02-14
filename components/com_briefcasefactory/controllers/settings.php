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

class BriefcaseFactoryFrontendControllerSettings extends FactoryControllerForm
{
  public function cancel($key = null)
  {
    $this->setRedirect(FactoryRoute::view('briefcase'));

    return true;
  }

  protected function allowSave($data, $key = 'id')
  {
    return !JFactory::getUser()->guest;
  }
}
