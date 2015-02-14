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

class BriefcaseFactoryFrontendControllerShare extends FactoryController
{
  public function unShare()
  {
    $input    = JFactory::getApplication()->input;
    $type     = $input->getCmd('type', '');
    $id       = $input->getInt('id', 0);
    $model    = $this->getModel('Share');
    $response = array();

    if ($model->unShare($type, $id)) {
      $response['status']  = 1;
      $response['message'] = FactoryText::_('share_task_unshare_success');
    }
    else {
      $response['status']  = 0;
      $response['message'] = FactoryText::_('share_task_unshare_error');
      $response['error']   = $model->getError();
    }

    $this->renderJson($response);
  }
}
