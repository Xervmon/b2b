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

class BriefcaseFactoryBackendModelFolders extends FactoryModelList
{
  protected
    $tableAlias = 'f',
    $filters = array('search', 'general', 'category', 'public'),
    $filterSearchFields = array('title', 'u.username'),
    $defaultOrdering = 'lft',
    $defaultDirection = 'asc'
  ;

  public function getSortFields()
  {
    return array(
      $this->tableAlias . '.lft'   => JText::_('JGRID_HEADING_ORDERING'),
      'u.username'                 => FactoryText::_('list_heading_username'),
      'c.title'                    => FactoryText::_('list_heading_category'),
			$this->tableAlias . '.title' => JText::_('JGLOBAL_TITLE'),
			$this->tableAlias . '.id'    => JText::_('JGRID_HEADING_ID')
    );
  }

  public function getFilterGeneral()
  {
    return array(
      0 => FactoryText::_('folders_filter_general_option_not_general'),
      1 => FactoryText::_('folders_filter_general_option_general'),
    );
  }

  public function getFilterPublic()
  {
    return array(
      0 => FactoryText::_('folders_filter_public_option_not_public'),
      1 => FactoryText::_('folders_filter_public_option_public'),
    );
  }

  public function getFilterCategory()
  {
    return JHtml::_('category.options', 'com_briefcasefactory');
  }

  protected function getQuery()
  {
    $query = parent::getQuery();

    // Get main query.
    $query->select('f.*')
      ->from('#__briefcasefactory_folders f')
      ->where('f.id <> ' . $query->quote(1));

    // Get username.
    $query->select('u.username')
      ->leftJoin('#__users u ON u.id = f.user_id');

    // Get category.
    $query->select('c.title AS category_title')
      ->leftJoin('#__categories c ON c.id = f.category_id');

    return $query;
  }

  protected function addFilterGeneral($query)
  {
    $value = $this->getState('filter.general');

    if ('' != $value) {
      $query->where('f.general <> ' . $query->quote($value));
    }
  }

  protected function addFilterPublic($query)
  {
    $value = $this->getState('filter.public');

    if ('' != $value) {
      if (!$value) {
        $query->where('f.share_public <> ' . $query->quote(0));
      }
      else {
        $query->where('f.share_public = ' . $query->quote(0));
      }
    }
  }

  protected function addFilterCategory($query)
  {
    $value = $this->getState('filter.category');

    if ('' != $value) {
      $query->where('f.category_id = ' . $query->quote($value));
    }
  }
}
