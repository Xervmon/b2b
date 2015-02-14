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

class BriefcaseFactoryFrontendControllerBatch extends FactoryController
{
  public function unshare()
  {
    $app      = JFactory::getApplication();
    $files    = $app->input->post->get('file', array(), 'array');
    $folders  = $app->input->post->get('folder', array(), 'array');
    $model    = $this->getModel('Share');
    $response = array();

    if ($model->unshareAll($files, $folders)) {
      $response['status'] = 1;
    } else {
      $response['status'] = 0;
    }

    $this->renderJson($response);
  }

  public function delete()
  {
    $app      = JFactory::getApplication();
    $files    = $app->input->post->get('file', array(), 'array');
    $folders  = $app->input->post->get('folder', array(), 'array');

    if ($files) {
      $model = $this->getModel('File');
      $model->delete($files);
    }

    if ($folders) {
      $model = $this->getModel('Folder');
      $model->delete($folders);
    }

    $response['status'] = 1;

    $this->renderJson($response);
  }
}
