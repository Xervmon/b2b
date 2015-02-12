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

class BriefcaseFactoryBackendModelShare extends JModelLegacy
{
  public function remove($id)
  {
    $table = $this->getTable('ShareFile', 'BriefcaseFactoryTable');

    return $table->delete($id);
  }

  public function shareGroups($fileId, $data)
  {
    if (!$data['groups']) {
      return true;
    }

    $this->removeGroupShares($fileId, $data['groups']);

    foreach ($data['groups'] as $group) {
      $table = JTable::getInstance('ShareFile', 'BriefcaseFactoryTable');

      $bind = array(
        'file_id' => $fileId,
        'type'    => 'group',
        'type_id' => $group,
        'until'   => $data['share_until'],
      );

      $table->save($bind);
    }
  }

  public function shareUsers($fileId, $data)
  {
    if (!$data['users']) {
      return true;
    }

    $this->removeUserShares($fileId, $data['users']);

    foreach ($data['users'] as $user) {
      $table = JTable::getInstance('ShareFile', 'BriefcaseFactoryTable');

      $bind = array(
        'file_id' => $fileId,
        'type'    => 'user',
        'type_id' => $user,
        'until'   => $data['share_until'],
      );

      $table->save($bind);
    }
  }

  protected function removeGroupShares($fileId, $groups)
  {
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_files')
      ->where('file_id = ' . $dbo->quote($fileId))
      ->where('type = ' . $dbo->quote('group'))
      ->where('type_id IN (' . implode(',', $groups) . ')');

    return $dbo->setQuery($query)
      ->execute();
  }

  protected function removeUserShares($fileId, $users)
  {
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->delete()
      ->from('#__briefcasefactory_shares_files')
      ->where('file_id = ' . $dbo->quote($fileId))
      ->where('type = ' . $dbo->quote('user'))
      ->where('type_id IN (' . implode(',', $users) . ')');

    return $dbo->setQuery($query)
      ->execute();
  }
}
