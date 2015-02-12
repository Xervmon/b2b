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

class BriefcaseFactoryFrontendModelShareGroups extends FactoryModelAdmin
{
  public function getForm($data = array(), $loadData = true)
  {
    JFormHelper::addFormPath(JPATH_COMPONENT_SITE . '/models/forms');
    JFormHelper::addFieldPath(JPATH_COMPONENT_SITE . '/models/fields');

    $input   = JFactory::getApplication()->input;
    $folders = $input->get('folder', array(), 'array');
    $files   = $input->get('file', array(), 'array');

    $form = JForm::getInstance('com_briefcasefactory.sharegroups', 'sharegroups', array('control' => 'jform'));

    $form->setFieldAttribute('folders', 'default', implode(',', $folders));
    $form->setFieldAttribute('files',   'default', implode(',', $files));

    $this->setLabelAndDescription($form);

    return $form;
  }
}
