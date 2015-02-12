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

class BriefcaseFactoryFrontendModelShare extends FactoryModel
{
  public function sharePublic($data)
  {
    $files         = $data['files'];
    $folders       = $data['folders'];
    $share_public  = $data['share_public'];
    $share_until   = $data['share_until'];
    $notifications = array();

    $files   = '' != $files   ? explode(',', $files)   : array();
    $folders = '' != $folders ? explode(',', $folders) : array();

    // Share Files
    foreach ($files as $file) {
      $table = $this->getTable('File', 'BriefcaseFactoryTable');
      $table->load($file);

      // Check if user is file owner
      if ($table->user_id != JFactory::getUser()->id) {
        continue;
      }

      $table->share_public = $share_public;
      $table->share_until  = $share_until;

      if ($table->store() && $share_public) {
        $notifications['files'][] = $table;
      }
    }

    // Share Folders
    foreach ($folders as $folder) {
      $table = $this->getTable('Folder', 'BriefcaseFactoryTable');
      $table->load($folder);

      // Check if user is folder owner and folder is not admin
      if ($table->user_id != JFactory::getUser()->id || $table->user_id == 0) {
        continue;
      }

      $table->share_public = $share_public;
      $table->share_until  = $share_until;

      $table->store();
    }

    $this->sendNotifications('public', $notifications);

    return true;
  }

  public function shareGroups($data)
  {
    $share_until   = $data['share_until'];
    $groups        = $data['groups'];
    $notifications = array();

    if (!$groups) {
      return true;
    }

    $files   = $this->getFiles($data['files']);
    $folders = $this->getFolders($data['folders']);

    if ($files) {
      // Delete current group shared files.
      $this->removeFilesShares($files, 'group', $groups);

      foreach ($files as $file) {
        foreach ($groups as $group) {
          // Share file.
          if ($this->shareFile($file, 'group', $group, $share_until)) {
            $notifications['files'][] = array('file' => $file, 'group' => $group);
          }
        }
      }
    }

    if ($folders) {
      // Delete current group shared folders
      $this->removeFoldersShares($folders, 'group', $groups);

      foreach ($folders as $folder) {
        foreach ($groups as $group) {
          // Share folder.
          $this->shareFolder($folder, 'group', $group, $share_until);
        }
      }
    }

    $this->sendNotifications('group', $notifications);

    return true;
  }

  public function shareUsers($data)
  {
    $share_users   = $data['users'];
    $share_until   = $data['share_until'];
    $users         = $data['users'];
    $notifications = array();

    $files   = $this->getFiles(isset($data['file']) ? implode(',', $data['file']) : '');
    $folders = $this->getFolders(isset($data['folder']) ? implode(',', $data['folder']) : '');

    if ($files) {
      // Delete current file shared files
      $this->removeFilesShares($files, 'user', $users);

      if ($share_users) {
        foreach ($files as $file) {
          foreach ($users as $user) {
            if ($this->shareFile($file, 'user', $user, $share_until)) {
              $notifications['files'][] = array('file' => $file, 'user' => $user);
            }
          }
        }
      }
    }

    if ($folders) {
      // Delete current group shared folders
      $this->removeFoldersShares($folders, 'user', $users);

      if ($share_users) {
        foreach ($folders as $folder) {
          foreach ($users as $user) {
            $this->shareFolder($folder, 'user', $user, $share_until);
          }
        }
      }
    }

    $this->sendNotifications('user', $notifications);

    return true;
  }

  public function unShare($type, $id)
  {
    if ('file' == $type) {
      return $this->unShareFile($id);
    }

    return $this->unShareFolder($id);
  }

  public function unShareAll($files, $folders)
  {
    $this->unshareAllFiles($files);
    $this->unshareAllFolders($folders);

    return true;
  }

  protected function unShareFile($id)
  {
    // Initialise variables.
    $user = JFactory::getUser();
    $table = JTable::getInstance('ShareFile', 'BriefcaseFactoryTable');

    // Load share.
    $table->load($id);

    // Check if share exists.
    if (!$table->id) {
      $this->setError(FactoryText::_('file_unshare_error_not_found'));
      return false;
    }

    // Load file.
    $file = $this->getTable('File', 'BriefcaseFactoryTable');
    $file->load($table->file_id);

    // Check if file belongs to use.
    if ($file->user_id != $user->id) {
      $this->setError(FactoryText::_('file_unshare_error_not_allowed'));
      return false;
    }

    // Remove share.
    if (!$table->delete()) {
      $this->setError($table->getError());
      return false;
    }

    return true;
  }

  protected function unShareFolder($id)
  {
    // Initialise variables.
    $user  = JFactory::getUser();
    $table = JTable::getInstance('ShareFolder', 'BriefcaseFactoryTable');

    // Load share.
    $table->load($id);

    // Check if share exists.
    if (!$table->id) {
      $this->setError(FactoryText::_('folder_unshare_error_not_found'));
      return false;
    }

    // Load folder.
    $folder = $this->getTable('Folder', 'BriefcaseFactoryTable');
    $folder->load($table->folder_id);

    // Check if folder belongs to use.
    if ($folder->user_id != $user->id) {
      $this->setError(FactoryText::_('folder_unshare_error_not_allowed'));
      return false;
    }

    // Remove share.
    if (!$table->delete()) {
      $this->setError($table->getError());
      return false;
    }

    return true;
  }

  protected function getFiles($files)
  {
    if ('' == $files) {
      return array();
    }

    $files = explode(',', $files);
    $dbo   = $this->getDbo();
    $user  = JFactory::getUser();

    $query = $dbo->getQuery(true)
      ->select('f.id')
      ->from('#__briefcasefactory_files f')
      ->where('f.id IN (' . implode(',', $files) . ')');

    if (!$user->authorise('backend.access', JFactory::getApplication()->input->getCmd('option')) && !$user->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      $query->where('f.user_id = ' . JFactory::getUser()->id);
    }

    $result = $dbo->setQuery($query)
      ->loadObjectList('id');

    return array_keys($result);
  }

  protected function getFolders($folders)
  {
    if ('' == $folders) {
      return array();
    }

    $folders = explode(',', $folders);
    $dbo     = $this->getDbo();
    $user    = JFactory::getUser();

    $query = $dbo->getQuery(true)
      ->select('f.id')
      ->from('#__briefcasefactory_folders f')
      ->where('f.id IN (' . implode(',', $folders) . ')')
      ->where('f.general = ' . $dbo->quote(0));

    if (!$user->authorise('backend.access', JFactory::getApplication()->input->getCmd('option'))) {
      $query->where('f.user_id = ' . JFactory::getUser()->id);
    }

    $result = $dbo->setQuery($query)
      ->loadObjectList('id');

    return array_keys($result);
  }

  protected function removeFilesShares($files, $type = 'group', $items = array())
  {
    if (!$files || !$items) {
      return false;
    }

    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_files')
      ->where('file_id IN (' . implode(',', $files) . ')')
      ->where('type = ' . $dbo->quote($type))
      ->where('type_id IN (' . implode(',', $items) . ')');

    return $dbo->setQuery($query)
      ->execute();
  }

  protected function removeFoldersShares($folders, $type = 'group', $items = array())
  {
    if (!$folders || !$items) {
      return false;
    }

    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_folders')
      ->where('folder_id IN (' . implode(',', $folders) . ')')
      ->where('type = ' . $dbo->quote($type))
      ->where('type_id IN (' . implode(',', $items) . ')');

    return $dbo->setQuery($query)
      ->execute();
  }

  protected function shareFile($fileId, $type, $item, $until)
  {
    $table = JTable::getInstance('ShareFile', 'BriefcaseFactoryTable');

    $data = array(
      'file_id' => $fileId,
      'type'    => $type,
      'type_id' => $item,
      'until'   => $until,
    );

    return $table->save($data);
  }

  protected function shareFolder($folderId, $type, $item, $until)
  {
    $table = JTable::getInstance('ShareFolder', 'BriefcaseFactoryTable');

    $data = array(
      'folder_id' => $folderId,
      'type'      => $type,
      'type_id'   => $item,
      'until'     => $until,
    );

    return $table->save($data);
  }

  protected function unshareAllFiles($files)
  {
    JArrayHelper::toInteger($files);

    if (!$files) {
      return false;
    }

    $array = array();
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->select('f.*')
      ->from('#__briefcasefactory_files f')
      ->where('f.id IN (' . implode(',', $files) . ')')
      ->where('f.user_id = ' . $dbo->quote(JFactory::getUser()->id));
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    foreach ($results as $result) {
      $table = $this->getTable('File', 'BriefcaseFactoryTable');
      $table->bind($result);

      $table->share_public = 0;
      $table->share_until  = $dbo->getNullDate();
      $table->store();

      $array[] = $table->id;
    }

    if ($array) {
      $query = $dbo->getQuery(true)
        ->delete()
        ->from('#__briefcasefactory_shares_files')
        ->where('file_id IN (' . implode(',', $array) . ')');
      $dbo->setQuery($query)
        ->execute();
    }

    return true;
  }

  protected function unshareAllFolders($folders)
  {
    JArrayHelper::toInteger($folders);

    if (!$folders) {
      return false;
    }

    $array = array();
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->select('f.*')
      ->from('#__briefcasefactory_folders f')
      ->where('f.id IN (' . implode(',', $folders) . ')')
      ->where('f.user_id = ' . $dbo->quote(JFactory::getUser()->id));
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    foreach ($results as $result) {
      $table = $this->getTable('Folder', 'BriefcaseFactoryTable');
      $table->bind($result);

      $table->share_public = 0;
      $table->share_until  = $dbo->getNullDate();
      $table->store();

      $array[] = $table->id;
    }

    if ($array) {
      $query = $dbo->getQuery(true)
        ->delete()
        ->from('#__briefcasefactory_shares_folders')
        ->where('folder_id IN (' . implode(',', $array) . ')');
      $dbo->setQuery($query)
        ->execute();
    }

    return true;
  }

  protected function sendNotifications($type, $items)
  {
    switch ($type) {
      case 'public':
        $this->sendNotificationPublic($items);
        break;

      case 'user':
        $this->sendNotificationUser($items);
        break;

      case 'group':
        $this->sendNotificationGroup($items);
        break;
    }
  }

  protected function sendNotificationPublic($items)
  {
    // Initialise variables.
    $user     = JFactory::getUser();
    $dbo      = $this->getDbo();
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $locked   = $settings->get('notifications.public_shared_file.locked', 0);
    $status   = $settings->get('notifications.public_shared_file.status', 1);

    // Check if notification is locked and disabled.
    if ($locked && !$status) {
      return true;
    }

    // 1. Retrieve all groups.
    $query = $dbo->getQuery(true)
      ->select('g.id, g.title')
      ->from('#__usergroups g')
      ->order('g.lft');
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    // 2. Filter groups that are allowed to download public files.
    $groups = array();
    foreach ($results as $result) {
      if (JAccess::checkGroup($result->id, 'frontend.download.public', 'com_briefcasefactory') ||
          JAccess::checkGroup($result->id, 'core.admin')
      ) {
        $groups[] = $result->id;
      }
    }

    if (!$groups) {
      return true;
    }

    // 3. Retrieve users that are part of the groups allowed to download public files.
    $query = $dbo->getQuery(true)
      ->select('u.id, u.username')
      ->from('#__users u')
      ->leftJoin('#__user_usergroup_map m ON m.user_id = u.id')
      ->where('m.group_id IN (' . implode(',', $groups) . ')')
      ->where('u.id <> ' . $dbo->quote($user->id))
      ->group('u.id');

    if (!$locked) {
      $query->leftJoin('#__briefcasefactory_users bu ON bu.user_id = u.id');

      if (!$status) {
        $query->where('bu.notification_public = ' . $dbo->quote(1));
      }
      else {
        $query->where('(bu.notification_public = ' . $dbo->quote(1) . ' OR bu.user_id IS NULL)');
      }
    }

    $receivers = $dbo->setQuery($query)
      ->loadObjectList();

    if (!$receivers) {
      return true;
    }

    // 4. Send notification for each file for each user.
    $notification = FactoryNotification::getInstance(JFactory::getMailer());

    foreach ($items['files'] as $item) {
      foreach ($receivers as $receiver) {
        $notification->send('public_shared_file', $receiver->id, array(
          'receiver_username' => $receiver->username,
          'owner_username'    => $user->username,
          'file_name'         => $item->title,
          'file_link'         => FactoryRoute::task('file.download&id=' . $item->id, false, -1),
          'date'              => JHtml::date('now', JText::_('DATE_FORMAT_LC1')),
        ));
      }
    }
  }

  protected function sendNotificationGroup($items)
  {
    // Initialise variables.
    $dbo          = $this->getDbo();
    $notification = FactoryNotification::getInstance(JFactory::getMailer());
    $groups       = $this->getUserGroups();
    $settings     = JComponentHelper::getParams('com_briefcasefactory');
    $locked       = $settings->get('notifications.private_group_shared_file.locked', 0);
    $status       = $settings->get('notifications.private_group_shared_file.status', 1);

    // Check if notification is locked and disabled.
    if ($locked && !$status) {
      return true;
    }

    foreach ($items['files'] as $item) {
      $file = $this->getFile($item['file']);
      $owner = JFactory::getUser($file->user_id);

      // 1. Retrieve users.
      $query = $dbo->getQuery(true)
        ->select('u.id, u.username')
        ->from('#__users u')
        ->leftJoin('#__user_usergroup_map m ON m.user_id = u.id AND m.group_id = ' . $dbo->quote($item['group']))
        ->where('u.id <> ' . $dbo->quote($owner->id))
        ->group('u.id');

      if (!$locked) {
        $query->leftJoin('#__briefcasefactory_users bu ON bu.user_id = u.id');

        if (!$status) {
          $query->where('bu.notification_group = ' . $dbo->quote(1));
        }
        else {
          $query->where('(bu.notification_group = ' . $dbo->quote(1) . ' OR bu.user_id IS NULL)');
        }
      }

      $receivers = $dbo->setQuery($query)
        ->loadObjectList();

      if (!$receivers) {
        continue;
      }

      // 2. Send notification.
      foreach ($receivers as $receiver) {
        $notification->send('private_group_shared_file', $receiver->id, array(
          'receiver_username' => $receiver->username,
          'owner_username'    => $owner->username,
          'file_name'         => $file->title,
          'file_link'         => FactoryRoute::task('file.download&id=' . $file->id, false, -1),
          'date'              => JHtml::date('now', JText::_('DATE_FORMAT_LC1')),
          'group'             => $groups[$item['group']]->title,
        ));
      }
    }
  }

  protected function sendNotificationUser($items)
  {
    // Initialise variables.
    $notification = FactoryNotification::getInstance(JFactory::getMailer());
    $user         = JFactory::getUser();
    $settings     = JComponentHelper::getParams('com_briefcasefactory');
    $locked       = $settings->get('notifications.private_user_shared_file.locked', 0);
    $status       = $settings->get('notifications.private_user_shared_file.status', 1);

    // Check if notification is locked and disabled.
    if ($locked && !$status) {
      return true;
    }

    foreach ($items['files'] as $item) {
      // 1. Check notification status.
      if (!$locked) {
        $table = JTable::getInstance('BriefcaseUser', 'BriefcaseFactoryTable');
        $loaded = $table->load($item['user']);

        if ($status) {
          if ($loaded && !$table->notification_users) {
            continue;
          }
        }
        else {
          if (!$loaded || !$table->notification_users) {
            continue;
          }
        }
      }

      $file = $this->getFile($item['file']);
      $receiver = JFactory::getUser($item['user']);

      $array[] = $receiver->username;

      // 2. Send notification.
      $notification->send('private_user_shared_file', $receiver->id, array(
        'receiver_username' => $receiver->username,
        'owner_username'    => $user->username,
        'file_name'         => $file->title,
        'file_link'         => FactoryRoute::task('file.download&id=' . $file->id, false, -1),
        'date'              => JHtml::date('now', JText::_('DATE_FORMAT_LC1')),
      ));
    }
  }

  protected function getUserGroups()
  {
    static $groups = null;

    if (is_null($groups)) {
      $dbo = $this->getDbo();
      $query = $dbo->getQuery(true)
        ->select('g.id, g.title')
        ->from('#__usergroups g');
      $groups = $dbo->setQuery($query)
        ->loadObjectList('id');
    }

    return $groups;
  }

  protected function getFile($id)
  {
    static $files = array();

    if (!isset($files[$id])) {
      $table = JTable::getInstance('File', 'BriefcaseFactoryTable');
      $table->load($id);

      $files[$id] = $table;
    }

    return $files[$id];
  }
}
