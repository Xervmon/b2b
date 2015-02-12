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

class BriefcaseFactoryBackendControllerShare extends FactoryController
{
  public function remove()
  {
    $input    = JFactory::getApplication()->input;
    $model    = $this->getModel('Share');
    $id       = $input->getInt('id');
    $response = array();

    if ($model->remove($id)) {
      $response['status'] = 1;
    }
    else {
      $response['status'] = 0;
    }

    $this->renderJson($response);
  }
}
