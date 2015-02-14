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

class PlgSystemBriefcaseFactory extends JPlugin
{
  public function onBriefcaseFactoryFileBeforeSave($event, $table, $isNew)
  {
    /* @var $table BriefcaseFactoryTableFile */
    if ('com_briefcasefactory.file' != $event || $isNew) {
      return true;
    }

    $file = JTable::getInstance('File', 'BriefcaseFactoryTable');
    $file->load($table->id);

    $table->setOriginalFile($file);

    return true;
  }

  public function onBriefcaseFactoryFileAfterSave($event, $table, $isNew)
  {
    /* @var $table BriefcaseFactoryTableFile */
    if ('com_briefcasefactory.file' != $event) {
      return true;
    }

    // Check if original owner has changed.
    if (!$isNew && $table->getOriginalFile()->user_id != $table->user_id) {
      jimport('joomla.filesystem.file');

      // Move file.
      JFile::move($table->getOriginalFile()->getFilePath(), $table->getFilePath());
    }

    // Upload file.
    if ($file = $table->getFile()) {
      $path = $table->getFilePath();

      jimport('joomla.filesystem.file');
      JFile::upload($file['tmp_name'], $path);

      $table->save(array(
        'filename'  => $file['name'],
        'extension' => JFile::getExt($file['name']),
        'size'      => filesize($path),
      ));
    }

    // Check if file is new.
    if ($isNew) {
      JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_briefcasefactory/models');

      // Auto share new file.
      $settings    = JComponentHelper::getParams('com_briefcasefactory');
      $groups      = $settings->get('sharing.share_only_groups', array());
      $restriction = $settings->get('sharing.autoshare', 0);

      if ($groups && $restriction) {
        $model = JModelLegacy::getInstance('Share', 'BriefcaseFactoryFrontendModel');
        $data  = array(
          'share_until' => '',
          'groups'      => $groups,
          'files'       => $table->id,
          'folders'     => '',
        );

        $model->shareGroups($data);
      }

      // Check if file was uploaded in another Briefcase.
      $user = JFactory::getUser();
      if (($user->id <> $table->user_id) && $table->user_id) {
        $model = JModelLegacy::getInstance('File', 'BriefcaseFactoryFrontendModel');
        $model->sendNotificationFileUploadedByAnotherUser($table, $user);
      }
    }

    return true;
  }

  public function onBriefcaseFactoryFileAfterDelete($event, $table)
  {
    if (!in_array($event, array('com_briefcasefactory.file', 'com_briefcasefactoryfrontend.filecron'))) {
      return true;
    }

    // 1. Remove file from disk.
    jimport('joomla.filesystem.file');
    $path = $table->getFilePath();

    if (JFile::exists($path)) {
      JFile::delete($path);
    }

    // 2. Remove shares
    $dbo = JFactory::getDbo();
    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_files')
      ->where('file_id = ' . $dbo->quote($table->id));

    $dbo->setQuery($query)
      ->execute();
  }

  public function onBriefcaseFactoryFolderBeforeDelete($event, $table)
  {
    if ('com_briefcasefactory.folder' != $event) {
      return true;
    }

    $array = array();
    foreach ($table->getTree() as $folder) {
      $array[] = $folder->id;
    }

    $table->leafs = $array;

    return true;
  }

  public function onBriefcaseFactoryFolderAfterDelete($event, $table)
  {
    if ('com_briefcasefactory.folder' != $event) {
      return true;
    }

    if (!isset($table->leafs) || !$table->leafs) {
      return true;
    }

    $dbo = JFactory::getDbo();
    $query = $dbo->getQuery(true)
      ->select('f.id')
      ->from('#__briefcasefactory_files f')
      ->where('f.folder_id IN (' . implode(',', $table->leafs) . ')');
    $results = $dbo->setQuery($query)
      ->loadObjectList('id');

    if (!$results) {
      return true;
    }

    $app = JFactory::getApplication()->isAdmin() ? 'Backend' : 'Frontend';
    $model = JModelLegacy::getInstance('File', 'BriefcaseFactory' . $app . 'Model');
    $model->delete(array_keys($results));

    return true;
  }
}
