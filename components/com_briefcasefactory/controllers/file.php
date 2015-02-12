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

class BriefcaseFactoryFrontendControllerFile extends FactoryControllerForm
{
  protected $view_list = 'briefcase';
  protected $option = 'com_briefcasefactory';

  public function download()
  {
    $app      = JFactory::getApplication();
    $input    = $app->input;
    $id       = $input->getInt('id', 0);
    $model    = $this->getModel();

    if (!$model->canDownload($id)) {
      $app->enqueueMessage(FactoryText::_('file_task_download_error'), 'message');
      $app->enqueueMessage($model->getError(), 'error');

      $referrer = $input->server->getString('HTTP_REFERER', FactoryRoute::view('briefcase'));
      $this->setRedirect($referrer);

      return false;
    }

    // Get file.
    $file = $model->getFile($id);
    $src  = $file->getFilePath();

    if ($file->user_id != JFactory::getUser()->id) {
      $file->hit();
    }

    // Set headers.
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file->filename.'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($src));

    // Start the download.
    ob_clean();
    flush();
    readfile($src);

    jexit();
  }

  public function save($key = null, $urlVar = null)
  {
    $input = JFactory::getApplication()->input;
    $post  = $input->post->get('jform', array(), 'array');
    $files = $input->files->get('jform', array(), 'array');
    $redirect = $input->post->getBase64('redirect');

    foreach ($files as $i => $file) {
      if (!isset($file['error']) || 4 == $file['error']) {
        $files[$i] = null;
      }
    }

    $post = array_merge($post, $files);
    $input->post->set('jform', $post);

    $result = parent::save($key, $urlVar);

    if ($redirect) {
      $this->setRedirect(base64_decode($redirect));
    }

    return $result;
  }

  public function addBulk()
  {
    if (!parent::add()) {
      return false;
    }

    $folder = $this->input->getInt('parent', 1);
    $this->setRedirect(FactoryRoute::view('bulk&layout=edit&folder=' . $folder));

    return true;
  }

  public function saveBulk()
  {
    $response = array();

    $post = $this->input->post->get('jform', array(), 'array');
    $files = $this->input->files->get('jform', array(), 'array');

    foreach ($files as $id => $file) {
      if (!isset($file['file']['error']) || 4 == $file['file']['error']) {
        continue;
      }

      if (isset($post[$id])) {
        $post[$id]['file'] = $file['file'];
      }

      $this->input->post->set('jform', $post[$id]);

      if (parent::save()) {
        $response[] = array(
          'status'  => 1,
          'id'      => $id,
          'name'    => $file['file']['name'],
          'message' => FactoryText::sprintf('file_save_bulk_task_success', $file['file']['name']),
        );
      }
      else {
        /** @noinspection PhpDeprecationInspection */
        $response[] = array(
          'status'  => 0,
          'id'      => $id,
          'name'    => $file['file']['name'],
          'message' => FactoryText::sprintf('file_save_bulk_task_error', $file['file']['name'], $this->getError()),
        );
      }
    }

    // Check if ajaxa request.
    if ($this->isXmlHttpRequest()) {
      $this->renderJson($response);
    }

    $app = JFactory::getApplication();
    $this->setMessage(null, 'message');
    $this->setMessage(null, 'error');

    foreach ($response as $file) {
      if ($file['status']) {
        $app->enqueueMessage($file['message'], 'message');
      }
      else {
        $app->enqueueMessage($file['message'], 'error');
      }
    }

    $this->setRedirect(FactoryRoute::view('briefcase'));

    return true;
  }

  protected function getRedirectToListAppend()
	{
    $append = parent::getRedirectToListAppend();
    $id = $this->input->getInt('id', 0);

    if ($id) {
      $table = JTable::getInstance('File', 'BriefcaseFactoryTable');
      $table->load($id);
      $append .= '&parent=' . $table->folder_id;
    }
    elseif ($parent = $this->input->getInt('parent')) {
      $append .= '&parent=' . $parent;
    }

		return $append;
	}

  protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
    $append = parent::getRedirectToItemAppend($recordId, $urlVar);
		$parent = $this->input->getInt('parent', 0);
    $id     = $this->input->getInt('id', 0);

		if ($parent) {
			$append .= '&parent=' . $parent;
		}
    elseif ($id) {
      $table = JTable::getInstance('File', 'BriefcaseFactoryTable');
      $table->load($id);

      $append .= '&parent=' . $table->folder_id;
    }

		return $append;
	}

  protected function allowAdd($data = array())
	{
		$user = JFactory::getUser();

    if ($user->authorise('core.admin')) {
      return true;
    }

    return $user->authorise('frontend.manage', $this->option);
	}

  protected function allowEdit($data = array(), $key = 'id')
  {
    $user = JFactory::getUser();

    if ($user->authorise('core.admin') || $user->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      return true;
    }

    if (!$user->authorise('frontend.manage', $this->option)) {
      return false;
    }

    $model = $this->getModel();
    $table = $model->getTable();

    $table->load($data[$key]);

    return $table->user_id == $user->id;
  }
}
