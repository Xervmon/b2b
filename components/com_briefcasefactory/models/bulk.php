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

class BriefcaseFactoryFrontendModelBulk extends FactoryModelAdmin
{
  public function getForm($data = array(), $loadData = true)
  {
    JForm::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . '/libraries/factory/component/fields');

	  $form = $this->loadForm(
      $this->option . '.file',
      'file',
      array(
        'control'   => 'jform[bulk_0]',
        'load_data' => $loadData
      ),
      false,
      '/form');

		if (empty($form)) {
			return false;
		}

    $folder = JFactory::getApplication()->input->getInt('folder');
    if ($folder) {
      $form->setValue('folder_id', null, $folder);
    }

    $form->removeField('user_id');

		return $form;
  }

  public function getTable($type = 'File', $prefix = 'BriefcaseFactoryTable', $config = array())
  {
    return parent::getTable($type, $prefix, $config);
  }

  public function getBulkLimit()
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');

    return $settings->get('uploads.bulk_limit', 5);
  }

  protected function preprocessForm(JForm $form, $data, $group = 'content')
  {
    parent::preprocessForm($form, $data, $group);

    $form->removeField('filename');
    $form->removeField('id');
  }
}
