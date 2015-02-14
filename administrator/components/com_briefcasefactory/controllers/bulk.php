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

class BriefcaseFactoryBackendControllerBulk extends JControllerLegacy
{
  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->registerTask('apply', 'save');
  }

  public function save()
  {
    $data = $this->input->post->get('jform', array(), 'array');
    $model = $this->getModel('Bulk');

    if ($model->save($data)) {
      $msg = FactoryText::_('bulk_task_save_success');
    }
    else {
      $msg = FactoryText::_('bulk_task_save_error');
    }

    if ('save' == $this->getTask()) {
      $redirect = FactoryRoute::view('files');
    }
    else {
      $redirect = FactoryRoute::view('bulk');
    }

    $this->setRedirect($redirect, $msg);
  }

  public function cancel()
  {
    $this->setRedirect(FactoryRoute::view('files')  );
  }
}
