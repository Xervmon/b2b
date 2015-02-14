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

class BriefcaseFactoryBackendModelUsers extends FactoryModelList
{
  protected
    $tableAlias = 'u',
    $filters = array('search', 'files'),
    $filterSearchFields = array('u.username'),
    $defaultOrdering = 'username',
    $defaultDirection = 'asc'
  ;

  public function getSortFields()
  {
    return array(
      $this->tableAlias . '.username' => FactoryText::_('list_heading_username'),
			'files'                         => FactoryText::_('users_heading_files'),
      $this->tableAlias . '.id'       => JText::_('JGRID_HEADING_ID'),
    );
  }

  public function getFilterFiles()
  {
    return array(
      0 => FactoryText::_('users_filter_files_option_without_files'),
      1 => FactoryText::_('users_filter_files_option_with_files'),
    );
  }

  protected function getQuery()
  {
    $query = parent::getQuery();

    // Get main query.
    $query->select('u.*')
      ->from('#__users u')
      ->group('u.id');

    // Get number of files.
    $query->select('COUNT(f.id) AS files')
      ->leftJoin('#__briefcasefactory_files f ON f.user_id = u.id');

    return $query;
  }

  protected function addFilterFiles($query)
  {
    $value = $this->getState('filter.files');

    if ('' != $value) {
      if (!$value) {
        $query->having('files = ' . $query->quote(0));
      }
      else {
        $query->having('files <> ' . $query->quote(0));
      }
    }
  }
}
