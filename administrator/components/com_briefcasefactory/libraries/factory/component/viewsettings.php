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

class FactoryViewSettings extends FactoryView
{
  protected
    $defaultButtons = array('apply', 'save', 'close'),
    $defaultVariables = array('form'),
    $defaultHtml = array('behavior.tooltip', 'behavior.multiselect', 'formbehavior.chosen/select'),
    $css = array('settings'),
    $layout = array(),
    $activeTab = null
  ;

  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR.'/libraries/factory/component/views/settings/');
    $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR.'/libraries/factory/component/views/sidebar/');
    $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR.'/libraries/factory/component/views/form/');

    $this->activeTab = JFactory::getApplication()->input->cookie->getCmd($this->option . '_settings_tab', $this->activeTab);
  }

  protected function loadFieldset($fieldset)
  {
    $this->fieldset = $fieldset;

    return $this->loadTemplate('fieldset');
  }

  protected function getSingularName()
  {
    return $this->getName();
  }
}
