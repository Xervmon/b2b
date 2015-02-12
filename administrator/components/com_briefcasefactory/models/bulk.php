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

class BriefcaseFactoryBackendModelBulk extends JModelLegacy
{
  public function getFolderContents($folder = '')
  {
    jimport('joomla.filesystem.file');
    jimport('joomla.filesystem.folder');

    $folder = '' == $folder ? JPATH_COMPONENT_ADMINISTRATOR : base64_decode($folder);
    $folders = array();
    $files = array();

    // Get folders
    $items = JFolder::folders($folder, '.', false, false, array(), array());
    foreach ($items as $item) {
      $folders[] = array('name' => $item, 'hash' => base64_encode($folder . '/' . $item));
    }
    array_unshift($folders, array('name' => '..', 'hash' => base64_encode($folder . '/..')));

    // Get files
    $items = JFolder::files($folder, '.', false, false, array(), array());
    foreach ($items as $item) {
      $files[] = array('name' => $item, 'hash' => base64_encode($folder . '/' . $item));
    }

    return array('folders' => $folders, 'files' => $files);
  }

  public function save($data)
  {
    jimport('joomla.filesystem.file');

    foreach ($data as $upload) {
      $path    = base64_decode($upload['hash']);
      $user_id = isset($upload['user_id']) && $upload['user_id'] ? $upload['user_id'] : JFactory::getUser()->id;

      $table = JTable::getInstance('File', 'BriefcaseFactoryTable');

      $table->user_id     = $user_id;
      $table->filename    = basename($path);
      $table->title       = $upload['name'];
      //$table->folder_id   = $upload['folder_id'];
      $table->category_id = $upload['category_id'];
      $table->published   = 1;
      $table->size        = filesize($path);

      if ($table->store()) {
        JFile::copy($path, $table->getFilePath());
      }
    }

    return true;
  }
}
