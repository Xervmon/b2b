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

class BriefcaseFactoryFrontendModelBatch extends FactoryModel
{
  public function createArchive($files)
  {
    JArrayHelper::toInteger($files);
    jimport('joomla.filesystem.archive');
    jimport('joomla.filesystem.file');
    jimport('joomla.filesystem.folder');

    // Initialise variables.
    $filesToAdd = array();
    $model      = JModelLegacy::getInstance('File', 'BriefcaseFactoryFrontendModel');

    // Check if any files were selected.
    if (!$files) {
      $this->setError(FactoryText::_('briefcase_batch_download_error_no_files_selected'));
      return false;
    }

    // Load selected files.
    $results = $this->getFiles($files);

    // Parse results.
    foreach ($results as &$result) {
      // Check if user is allowed to download file.
      if (!$model->canDownload($result->id)) {
        continue;
      }

      $table = $this->getTable('File', 'BriefcaseFactoryTable');
      $table->bind($result);

      $data         = file_get_contents($table->getFilePath());
      $filesToAdd[] = array('name' => $table->filename, 'data' => $data);
    }

    // Check if user is allowed to download any files.
    if (!$filesToAdd) {
      $this->setError(FactoryText::_('briefcase_batch_download_error_no_files_allowed'));
      return false;
    }

    // Create archive.
    $app  = JFactory::getApplication();
    $zip  = JArchive::getAdapter('zip');
    $dest = $app->get('tmp_path').DS.uniqid().'.zip';

    $zip->create($dest, $filesToAdd);

    // Check if archive was created and is valid.
    if (!JFile::exists($dest) || !$zip->checkZipData(file_get_contents($dest))) {
      $this->setError(FactoryText::_('briefcase_batch_download_error_creating_archive'));
      return false;
    }

    return $dest;
  }

  public function move($data)
  {
    $target = $this->getTable('Folder', 'BriefcaseFactoryTable');
    $user   = JFactory::getUser();

    $folder  = $data['folder'];
    $folders = explode(',', $data['folders']);
    $files   = explode(',', $data['files']);

    JArrayHelper::toInteger($folders);
    JArrayHelper::toInteger($files);

    // Load target folder.
    if (!$target->load($folder)) {
      $this->setError(FactoryText::_('batch_move_error_target_folder_not_found'));
      return false;
    }

    // Check if allowed to target folder
    if ($target->user_id != $user->id && $target->user_id != 0 && !$target->general) {
      $this->setError(FactoryText::_('batch_move_error_target_folder_not_allowed'));
      return false;
    }

    if ($files) {
      $model = JModelLegacy::getInstance('File', 'BriefcaseFactoryFrontendModel');
      $model->move($files, $target);
    }

    if ($folders) {
      $model = JModelLegacy::getInstance('Folder', 'BriefcaseFactoryFrontendModel');
      $model->move($folders, $target);
    }

    return true;
  }

  protected function getFiles($files)
  {
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->select('f.*')
      ->from('#__briefcasefactory_files f')
      ->where('f.id IN (' . implode(',', $files) . ')');

    $results = $dbo->setQuery($query)
      ->loadObjectList();

    return $results;
  }
}
