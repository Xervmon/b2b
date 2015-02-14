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

class BriefcaseFactoryFrontendModelFolder extends FactoryModelAdmin
{
  protected $event_after_delete = 'onBriefcaseFactoryFolderAfterDelete';
  protected $event_before_delete = 'onBriefcaseFactoryFolderBeforeDelete';

  public function getForm($data = array(), $loadData = true)
  {
    /* @var $form JForm */
    $form = parent::getForm($data, $loadData);
    $user = JFactory::getUser();

    if ((!isset($data['filename']) || !$data['filename']) && (!$form->getValue('filename'))) {
      $form->setFieldAttribute('file', 'required', 'true');
      $form->removeField('filename');
    }

    if (!$user->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      $form->removeField('user_id');
    }

    return $form;
  }

  public function move(&$pks, $target)
	{
		// Initialise variables.
		$pks   = (array)$pks;
		$table = $this->getTable('Folder', 'BriefcaseFactoryTable');

		// Iterate the items to move each one.
		foreach ($pks as $i => $pk) {
      if (!$table->load($pk)) {
        continue;
      }

      // Check if user is owner
      if ($table->user_id == JFactory::getUser()->id) {
        $table->moveToFolder($target);
      }
		}

    $table->rebuild();

		return true;
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
