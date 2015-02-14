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

class BriefcaseFactoryTableFile extends FactoryTable
{
  protected $file;
  protected $originalFile = null;

	public function __construct(&$db)
	{
		parent::__construct('#__briefcasefactory_files', 'id', $db);
	}

  public function check()
  {
    if (!parent::check()) {
      return false;
    }

    if (is_null($this->user_id)) {
      $this->user_id = JFactory::getUser()->id;
    }

    if (is_null($this->published)) {
      $this->published = 1;
    }

    if (is_null($this->title) || '' == $this->title) {
      $this->title = $this->filename;
    }

    // Check if folder size is valid.
    if (!$this->checkFolderSize($this->file['size'])) {
      $this->setError(FactoryText::_('file_save_error_folder_size'));
      return false;
    }

    return true;
  }

  public function getFilePath()
  {
    return $this->getStorageFolder() . $this->getFileName();
  }

  public function moveToFolder($folder_id)
  {
    $this->folder_id = $folder_id;

    return $this->store();
  }

  public function getFile()
  {
    return $this->file;
  }

  public function setOriginalFile($originalFile)
  {
    $this->originalFile = $originalFile;
  }

  public function getOriginalFile()
  {
    return $this->originalFile;
  }

  public function isValid()
  {
    // Check if file is published.
    if (!$this->published) {
      return false;
    }

    // Check if upload is valid.
    if ($this->valid_until != JFactory::getDbo()->getNullDate() &&
        $this->valid_until < JFactory::getDate()->toSql())
    {
      return false;
    }

    return true;
  }

  public function isPublic()
  {
    $nullDate = JFactory::getDbo()->getNullDate();
    $now      = JFactory::getDate()->toSql();

    // Check if file is public shared and share is valid.
    if ($this->share_public &&
       ($this->share_until == $nullDate || $this->share_until >= $now))
    {
      return true;
    }

    // Check if parent folder is shared public and share is valid.
    $folder = JTable::getInstance('Folder', 'BriefcaseFactoryTable');
    $folder->load($this->folder_id);

    if ($folder->isPublic()) {
      return true;
    }

    return false;
  }

  public function isSharedWithUser($userId)
  {
    // Check if file is shared directly with user or by group.
    if ($this->isFileSharedWithUser($this->id, $userId)) {
      return true;
    }

    // Check if parent folder is shared directly with user or by group.
    $folder = JTable::getInstance('Folder', 'BriefcaseFactoryTable');
    $folder->load($this->folder_id);

    if ($folder->isSharedWithUser($userId)) {
      return true;
    }

    return false;
  }

  protected function getStorageFolder($user_id = null)
  {
    jimport('joomla.filesystem.folder');

    if (is_null($user_id)) {
      $user_id = $this->user_id;
    }

    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $folder   = $settings->get('uploads.folder', JPATH_SITE . '/media/com_briefcasefactory') . '/' . $user_id . '/';

    if (!JFolder::exists($folder)) {
      JFolder::create($folder);
    }

    return $folder;
  }

  protected function getFileName()
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');

    return $this->id . '.' . $settings->get('general.uploads.extension', 'file');
  }

  protected function checkFolderSize($fileSize)
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $size     = $settings->get('uploads.max_folder_size', 10);
    $admins   = $settings->get('administrators.groups', array());
    $user     = JFactory::getUser();

    if (!$size) {
      return true;
    }

    // Check if user is admin and if restriction is overridden.
    $override = $settings->get('override.max_folder_size', 0);

    if ($override && $admins && array_intersect($admins, $user->groups)) {
      return true;
    }

    // Get current folder size.
    $folderSize = $this->getFolderSize($user->id);

    return $fileSize + $folderSize < $size * 1024 * 1024;
  }

  protected function getFolderSize($userId)
  {
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->select('SUM(f.size)')
      ->from('#__briefcasefactory_files f')
      ->where('f.user_id = ' . $dbo->quote($userId));
    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }

  protected function isFileSharedWithUser($fileId, $userId)
  {
    $groups   = JAccess::getGroupsByUser($userId);
    $dbo      = $this->getDbo();
    $nullDate = $dbo->getNullDate();
    $now      = JFactory::getDate()->toSql();

    $query = $dbo->getQuery(true)
      ->select('s.id')
      ->from('#__briefcasefactory_shares_files s')
      ->where('s.file_id = ' . $dbo->quote($fileId))
      ->where('(s.type = ' . $dbo->quote('user') . ' AND s.type_id = ' . $dbo->quote($userId) . ') OR (s.type = ' . $dbo->quote('group') . ' AND s.type_id IN (' . implode(',', $groups) . '))')
      ->where('(s.until = ' . $dbo->quote($nullDate) . ' OR s.until >= ' . $dbo->quote($now) . ')');
    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }
}
