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

class BriefcaseFactoryFrontendControllerShare extends FactoryControllerForm
{
  public function sharePublic()
  {
    $app   = JFactory::getApplication();
    $data  = $app->input->post->get('jform', array(), 'array');
    $model = $this->getModel('Share');

    if ($model->sharePublic($data)) {
      $this->javascriptRedirect();
    } else {
      $app->enqueueMessage($model->getError(), 'error');
      $this->setRedirect(FactoryRoute::view('sharepublic&tmpl=component'));
    }
  }

  public function shareGroups()
  {
    $app   = JFactory::getApplication();
    $data  = $app->input->post->get('jform', array(), 'array');
    $model = $this->getModel('Share');

    if ($model->shareGroups($data)) {
      $this->javascriptRedirect();
    } else {
      $app->enqueueMessage($model->getError(), 'error');
      $this->setRedirect(FactoryRoute::view('sharegroups&tmpl=component'));
    }
  }

  public function shareUsers()
  {
    $app   = JFactory::getApplication();
    $data  = $app->input->post->get('jform', array(), 'array');
    $model = $this->getModel('Share');

    if ($model->shareUsers($data)) {
      $this->javascriptRedirect();
    } else {
      $app->enqueueMessage($model->getError(), 'error');
      $this->setRedirect(FactoryRoute::view('shareusers&tmpl=component'));
    }
  }

  protected function javascriptRedirect()
  {
    $document = JFactory::getDocument();
    $document->addScriptDeclaration('parent.jQuery(".briefcase-update").trigger("update");');
  }
}
