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

class BriefcaseFactoryFrontendControllerFolder extends FactoryControllerForm
{
  protected $view_list = 'briefcase';

  protected function getRedirectToListAppend()
	{
    $append = parent::getRedirectToListAppend();
    $id = $this->input->getInt('id', 0);

    if ($id) {
      $table = JTable::getInstance('Folder', 'BriefcaseFactoryTable');
      $table->load($id);
      $append .= '&parent=' . $table->parent_id;
    }

		return $append;
	}

  protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
    $append = parent::getRedirectToItemAppend($recordId, $urlVar);
		$parent = $this->input->getInt('parent', 0);
    $id     = $this->input->getInt('id', 0);

		if ($parent) {
			$append .= '&parent=' . $parent;
		}
    elseif ($id) {
      $table = JTable::getInstance('Folder', 'BriefcaseFactoryTable');
      $table->load($id);

      $append .= '&parent=' . $table->parent_id;
    }

		return $append;
	}

  protected function allowAdd($data = array())
	{
		$user = JFactory::getUser();

    if ($user->authorise('core.admin')) {
      return true;
    }

    return $user->authorise('frontend.manage', $this->option);
	}

  protected function allowEdit($data = array(), $key = 'id')
  {
    $user = JFactory::getUser();

    if ($user->authorise('core.admin') || $user->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      return true;
    }

    if (!$user->authorise('frontend.manage', $this->option)) {
      return false;
    }

    $model = $this->getModel();
    $table = $model->getTable();

    $table->load($data[$key]);

    return $table->user_id == $user->id;
  }
}
