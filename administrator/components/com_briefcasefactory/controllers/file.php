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

class BriefcaseFactoryBackendControllerFile extends FactoryControllerForm
{
  protected $option = 'com_briefcasefactory';

  public function download()
  {
    $app      = JFactory::getApplication();
    $input    = $app->input;
    $id       = $input->getInt('id', 0);
    $model    = $this->getModel();

    // Get file.
    $file = $model->getFile($id);
    $src  = $file->getFilePath();

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

    foreach ($files as $i => $file) {
      if (!isset($file['error']) || 4 == $file['error']) {
        $files[$i] = null;
      }
    }

    $post = array_merge($post, $files);
    $input->post->set('jform', $post);

    return parent::save($key, $urlVar);
  }
}
