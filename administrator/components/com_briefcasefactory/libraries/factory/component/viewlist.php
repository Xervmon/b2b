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

class FactoryViewList extends FactoryView
{
  protected
    $defaultButtons = array(
      'add',
      'edit',
      'publish',
      'unpublish',
      'delete',
    ),
    $defaultVariables = array(
      'items',
      'pagination',
      'state',
      'listOrder',
      'listDirn',
      'saveOrder',
      'sortFields',
      'filters',
      'tableAlias',
      'ordering',
    ),
    $defaultHtml = array(
      'bootstrap.tooltip',
      'behavior.multiselect',
      'dropdown.init',
      'formbehavior.chosen/select',
    ),
    $defaultTemplatePath = array('list', 'sidebar')
  ;

  protected function getOrderingParentString($item, $ordering)
  {
    $parentsStr = '';

    if ($item->level > 1) {
      $_currentParentId = $item->parent_id;
      $parentsStr = ' ' . $_currentParentId;

      for ($i = 0; $i < $item->level; $i++) {
        foreach ($ordering as $k => $v) {
          $v = '-' . implode('-', $v) . '-';
          if (strpos($v, '-' . $_currentParentId . '-') !== false) {
            $parentsStr .= ' ' . $k;
            $_currentParentId = $k;
            break;
          }
        }
      }
    }

    return $parentsStr;
  }

  protected function addFilters()
  {
    if (!$this->filters) {
      return true;
    }

    JHtmlSidebar::setAction('index.php?option=' . $this->option . '&view=' . $this->getName());

    foreach ($this->filters as $filter) {
      if ('search' == $filter) {
        continue;
      }

      $text = FactoryText::_('list_filter_title_' . $filter);

      JHtmlSidebar::addFilter(
			  $text,
			  'filter_' . $filter,
			  JHtml::_('select.options', $this->get('Filter' . ucfirst($filter)), 'value', 'text', $this->state->get('filter.' . $filter), true)
		  );
    }
  }

  protected function loadAdminAssets()
  {
    $this->addFilters();
    $this->addSaveOrdering();

    parent::loadAdminAssets();
  }

  protected function addSaveOrdering()
  {
    if (isset($this->saveOrder) && $this->saveOrder) {
      $saveOrderingUrl = 'index.php?option=' . $this->option . '&task=' . $this->getName() . '.saveOrderAjax&tmpl=component';
      JHtml::_('sortablelist.sortable', $this->getName() . 'List', 'adminForm', strtolower($this->listDirn), $saveOrderingUrl, false, true);
    }

    return true;
  }
}
