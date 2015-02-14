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

class BriefcaseFactoryTableFolder extends FactoryTableNested
{
  protected $default;

	public function __construct(&$db)
	{
		parent::__construct('#__briefcasefactory_folders', 'id', $db);
	}

  public function check()
  {
    if (!parent::check()) {
      return false;
    }

    if (is_null($this->user_id)) {
      if ($this->default) {
        $this->user_id = -1;
      }
      else {
        $this->user_id = JFactory::getUser()->id;
      }
    }

    // Check if saving a default folder, if the parent is also a default folder.
    if (0 == $this->user_id) {
      $parent = JTable::getInstance('Folder', 'BriefcaseFactoryTable');
      $parent->load($this->parent_id);

      if (0 != $parent->user_id) {
        $this->setError(FactoryText::_('folder_save_error_default_folder_with_non_default_parent'));
        return false;
      }
    }

    return true;
  }

  public function isRoot()
  {
    return 1 == $this->id;
  }

  public function isOwner()
  {
    return $this->user_id == JFactory::getUser()->id;
  }

  public function moveToFolder($folder)
  {
    foreach ($folder->getPath() as $item) {
      if ($item->id == $this->id || $item->parent_id == $this->id) {
        return false;
      }
    }

    $this->parent_id = $folder->id;

    return $this->store();
  }

  public function isPublic()
  {
    $nullDate = JFactory::getDbo()->getNullDate();
    $now      = JFactory::getDate()->toSql();

    // Check if folder is public shared and share is valid.
    if ($this->share_public &&
       ($this->share_until == $nullDate || $this->share_until >= $now))
    {
      return true;
    }

    // Check if parent folders are shared public and shares are valid.
    foreach ($this->getPath() as $parent) {
      if ($parent->share_public &&
         ($parent->share_until == $nullDate || $parent->share_until >= $now))
      {
        return true;
      }
    }

    return false;
  }

  public function isSharedWithUser($userId = null)
  {
    if (is_null($userId)) {
      $userId = JFactory::getUser()->id;
    }

    // Check if folder is shared directly with user or by group.
    if ($this->isFolderSharedWithUser($this->id, $userId)) {
      return true;
    }

    // Check if folder parents are shared directly with user or by group.
    $parents = $this->getParentFolders();
    if ($this->areFoldersSharedWithUser($parents, $userId)) {
      return true;
    }

    return false;
  }

  protected function isFolderSharedWithUser($folderId, $userId)
  {
    static $shares = array();

    $hash = md5(implode('.', array($folderId, $userId)));

    if (!isset($shares[$hash])) {
      // Initialise variables.
      $dbo     = $this->getDbo();
      $groups  = JAccess::getGroupsByUser($userId);
      $nullDate = $dbo->getNullDate();
      $now      = JFactory::getDate()->toSql();

      $query = $dbo->getQuery(true)
        ->select('s.id')
        ->from('#__briefcasefactory_shares_folders s')
        ->where('s.folder_id = ' . $dbo->quote($folderId))
        ->where('((s.type = ' . $dbo->quote('user') . ' AND s.type_id = ' . $dbo->quote($userId) . ') OR (s.type = ' . $dbo->quote('group') . ' AND s.type_id IN (' . implode(',', $groups) . ')))')
        ->where('(s.until = ' . $dbo->quote($nullDate) . ' OR s.until >= ' . $dbo->quote($now) . ')');

      $shares[$hash] = $dbo->setQuery($query)
        ->loadResult();
    }

    return $shares[$hash];
  }

  protected function getParentFolders()
  {
    $array = array();

    foreach ($this->getPath() as $node) {
      if (1 != $node->id && $this->id != $node->id) {
        $array[] = $node->id;
      }
    }

    return $array;
  }

  protected function areFoldersSharedWithUser($folders, $userId)
  {
    if (!$folders) {
      return false;
    }

    $dbo      = $this->getDbo();
    $groups   = JAccess::getGroupsByUser($userId);
    $nullDate = $dbo->getNullDate();
    $now      = JFactory::getDate()->toSql();

    $query = $dbo->getQuery(true)
      ->select('s.id')
      ->from('#__briefcasefactory_shares_folders s')
      ->where('s.folder_id IN (' . implode(',', $folders) . ')')
      ->where('((s.type = ' . $dbo->quote('user') . ' AND s.type_id = ' . $dbo->quote($userId) . ') OR (s.type = ' . $dbo->quote('group') . ' AND s.type_id IN (' . implode(',', $groups) . ')))')
      ->where('(s.until = ' . $dbo->quote($nullDate) . ' OR s.until >= ' . $dbo->quote($now) . ')');

    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }
}
