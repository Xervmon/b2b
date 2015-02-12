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
  public function download()
  {
    $app   = JFactory::getApplication();
    $input = $app->input;
    $files = $input->post->get('file', array(), 'array');
    $model = $this->getModel('Batch');

    $archive = $model->createArchive($files);

    if (false === $archive) {
      $app->enqueueMessage(FactoryText::_('batch_task_download_error'), 'message');
      $app->enqueueMessage($model->getError(), 'error');

      $referrer = $input->server->getString('HTTP_REFERER', FactoryRoute::view('briefcase'));
      $this->setRedirect($referrer);

      return false;
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename=' . 'briefcase.zip');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($archive));

    // Start the download.
    ob_clean();
    flush();
    readfile($archive);

    // Remove archive.
    JFile::delete($archive);

    jexit();
  }

  public function move()
  {
    $app   = JFactory::getApplication();
    $data  = $app->input->post->get('jform', array(), 'array');
    $model = $this->getModel('Batch');

    if ($model->move($data)) {
      $this->javascriptRedirect();
    } else {
      $app->enqueueMessage($model->getError(), 'error');
      $this->setRedirect(FactoryRoute::view('move&tmpl=component'));
    }
  }

  protected function javascriptRedirect()
  {
    $document = JFactory::getDocument();
    $document->addScriptDeclaration('parent.jQuery(".briefcase-update").trigger("update");');
  }
}
