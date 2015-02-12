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

class BriefcaseFactoryBackendModelFile extends FactoryModelAdmin
{
  protected $event_after_delete = 'onBriefcaseFactoryFileAfterDelete';
  protected $event_before_save = 'onBriefcaseFactoryFileBeforeSave';
  protected $event_after_save = 'onBriefcaseFactoryFileAfterSave';
  protected $option = 'com_briefcasefactory';

  public function getFile($id)
  {
    $table = $this->getTable();
    $table->load($id);

    return $table;
  }

  public function getTable($type = 'File', $prefix = 'BriefcaseFactoryTable', $config = array())
  {
    return parent::getTable($type, $prefix, $config);
  }

  public function getForm($data = array(), $loadData = true)
  {
    JFormHelper::addFieldPath(JPATH_COMPONENT_SITE . '/models/fields');

    $form = parent::getForm($data, $loadData);

    if ((!isset($data['filename']) || !$data['filename']) && (!$form->getValue('filename'))) {
      $form->setFieldAttribute('file', 'required', 'true');
      $form->removeField('filename');
    }

    return $form;
  }
}
