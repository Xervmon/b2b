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

class BriefcaseFactoryFrontendModelFile extends FactoryModelAdmin
{
  protected $event_after_delete = 'onBriefcaseFactoryFileAfterDelete';
  protected $event_before_save = 'onBriefcaseFactoryFileBeforeSave';
  protected $event_after_save = 'onBriefcaseFactoryFileAfterSave';
  protected $option = 'com_briefcasefactory';
  protected $globalUploadUserId = null;

  public function getFile($id)
  {
    $table = $this->getTable();
    $table->load($id);

    return $table;
  }

  public function getForm($data = array(), $loadData = true)
  {
    /* @var $form JForm */
    JForm::addFormPath(JPATH_SITE . '/components/com_briefcasefactory/models/forms');
    JForm::addFieldPath(JPATH_SITE . '/components/com_briefcasefactory/models/fields');
    JForm::addRulePath(JPATH_SITE . '/components/com_briefcasefactory/models/rules');
    $form = parent::getForm($data, $loadData);
    $user = JFactory::getUser();

    if ((!isset($data['filename']) || !$data['filename']) && (!$form->getValue('filename'))) {
      $form->setFieldAttribute('file', 'required', 'true');
      $form->removeField('filename');
    }

    if (!$user->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      $form->removeField('user_id');
    }
    elseif ($userId = JFactory::getApplication()->input->getInt('user_id')) {
      $form->setValue('user_id', null, $userId);
      $form->setFieldAttribute('user_id', 'readonly', 'readonly');
      $form->removeField('id');
    }

    return $form;
  }

  public function move(&$pks, $target)
	{
		// Initialise variables.
		$pks   = (array)$pks;
		$table = $this->getTable();

		// Iterate the items to move each one.
    foreach ($pks as $i => $pk) {
      if (!$table->load($pk)) {
        continue;
      }

      if ($table->user_id == JFactory::getUser()->id) {
        $table->moveToFolder($target->id);
      }
    }

		return true;
	}

  public function canDownload($id)
  {
    // Initialise variables.
    $table = $this->getTable();
    $user  = JFactory::getUser();

    // Check if file exists and is valid.
    if (!$id || !$table->load($id) || !$table->isValid()) {
      $this->setError(FactoryText::_('file_download_error_file_not_found'));
      return false;
    }

    // Check if user is file owner.
    if ($user->id == $table->user_id) {
      return true;
    }

    // Check if file is public shared and user is allowed to download public shared files.
    if ($table->isPublic() && $user->authorise('frontend.download.public', 'com_briefcasefactory')) {
      return true;
    }

    // Check if file is shared with user.
    if ($table->isSharedWithUser($user->id)) {
      return true;
    }

    $this->setError(FactoryText::_('file_download_error_not_allowed'));

    return false;
  }

  public function getTable($type = 'File', $prefix = 'BriefcaseFactoryTable', $config = array())
  {
    return parent::getTable($type, $prefix, $config);
  }

  public function sendNotificationFileUploadedByAnotherUser($file, $uploader)
  {
    $receiver     = JFactory::getUser($file->user_id);
    $notification = FactoryNotification::getInstance(JFactory::getMailer());
    $settings     = JComponentHelper::getParams('com_briefcasefactory');
    $locked       = $settings->get('notifications.file_upload_for_other_user.locked', 0);
    $status       = $settings->get('notifications.file_upload_for_other_user.status', 1);

    // Check if notification is locked and disabled.
    if ($locked && !$status) {
      return true;
    }

    // Get user settings.
    $user = JTable::getInstance('BriefcaseUser', 'BriefcaseFactoryTable');
    $loaded = $user->load($file->user_id);

    if ($status) {
      if ($loaded && !$user->notification_file_upload_other_user) {
        return true;
      }
    }
    else {
      if (!$loaded || !$user->notification_file_upload_other_user) {
        return true;
      }
    }

    $notification->send('file_upload_for_other_user', $file->user_id, array(
      'receiver_username' => $receiver->username,
      'uploader_username' => $uploader->username,
      'file_name'         => $file->title,
      'file_link'         => FactoryRoute::task('file.download&id=' . $file->id, false, -1),
      'date'              => JHtml::date('now', JText::_('DATE_FORMAT_LC1')),
    ));
  }

  protected function canDelete($record)
  {
    $user = JFactory::getUser();

    if (!$user->authorise('frontend.manage', $this->option)) {
      return false;
    }

    return $record->user_id == $user->id;
  }
}
