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

class FactoryViewItem extends FactoryView
{
  protected
    $defaultButtons = array('apply', 'save', 'save2new', 'close'),
    $defaultVariables = array('item', 'form', 'state'),
    $defaultHtml = array('behavior.tooltip', 'behavior.multiselect', 'behavior.formvalidation', 'formbehavior.chosen/select'),
    $layout = array(),
    $activeTab = null,
    $title = 'title'
  ;

  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->_addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR.'/libraries/factory/component/views/item/');
    $this->_addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR.'/libraries/factory/component/views/form/');

    $this->activeTab = JFactory::getApplication()->input->cookie->getCmd($this->option . '_settings_tab', $this->activeTab);
  }

  protected function setTitle()
  {
    if (!isset($this->item) || !$this->item) {
      parent::setTitle();
      return true;
    }

    if ($this->item->id) {
      $title = FactoryText::sprintf($this->getName() . '_page_title_edit', $this->item->{$this->title}, $this->item->id);
    } else {
      $title = FactoryText::_($this->getName() . '_page_title_new');
    }

    JToolbarHelper::title($title);

    return true;
  }

  protected function loadFieldset($fieldset)
  {
    $this->fieldset = $fieldset;

    return $this->loadTemplate('fieldset');
  }
}
