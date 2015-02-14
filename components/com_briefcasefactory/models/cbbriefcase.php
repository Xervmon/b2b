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

class BriefcaseFactoryFrontendModelCbBriefcase extends JModelLegacy
{
  protected $profile_user_id;
  protected $visitor_user_id;

  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->profile_user_id = $config['profile_user_id'];
    $this->visitor_user_id = $config['visitor_user_id'];
  }

  public function getItems()
  {
    if ($this->profile_user_id == $this->visitor_user_id) {
      return $this->getMyBriefcaseItems();
    }

    return $this->getUserBriefcaseItems();
  }

  public function getPagination()
  {
    $pagination = new JPagination($this->getTotal(), 0, 0);
    $pagination->setAdditionalUrlParam('format', 'html');

    return $pagination;
  }

  public function getParent()
  {
    /* @var $model BriefcaseFactoryFrontendModelBriefcase */
    $model = JModelLegacy::getInstance('Briefcase', 'BriefcaseFactoryFrontendModel');

    return $model->getParent(1);
  }

  public function getOption()
  {
    return JFactory::getApplication()->input->getString('option');
  }

  protected function getTotal()
  {
    static $total = null;

    if (is_null($total)) {
      // Initialise variables.
      $dbo    = $this->getDbo();
      $folder = $this->getParent();
      $total  = 0;

      // Get the queries for the current folder.
      if ($this->profile_user_id == $this->visitor_user_id) {
        $queries = $this->getMyItemsQueries($folder->id, true);
      }
      else {
        $queries = $this->getUserItemsQueries($folder->id, true);
      }

      foreach ($queries as $query) {
        $total += $dbo->setQuery($query)->loadResult();
      }
    }

    return $total;
  }

  protected function getMyBriefcaseItems()
  {
    /* @var $model BriefcaseFactoryFrontendModelBriefcase */
    $model = JModelLegacy::getInstance('Briefcase', 'BriefcaseFactoryFrontendModel');

    // Initialise variables.
    $dbo    = $this->getDbo();
    $parent = $this->getParent();

    // Get the queries for the current folder.
    $queries = $this->getMyItemsQueries($parent->id);

    // Compose the query.
    $query = ' (' . implode(') UNION (', $queries) . ')'
           . ' ORDER BY type DESC, title ASC'
           . ' LIMIT ' . $this->getState('list.start', 0) . ', ' . $this->getState('list.limit', 10);

    // Load the results.
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    // Process the results
    $results = $model->processResults($results);

    return $results;
  }

  protected function getUserBriefcaseItems()
  {
    // Initialise variables.
    $dbo    = $this->getDbo();
    $parent = $this->getParent();

    // Get the queries for the current folder.
    $queries = $this->getUserItemsQueries($parent->id);

    // Compose the query.
    $query = ' (' . implode(') UNION (', $queries) . ')'
           . ' ORDER BY type DESC, title ASC'
           . ' LIMIT ' . $this->getState('list.start', 0) . ', ' . $this->getState('list.limit', 10);

    // Load the results.
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    return $results;
  }

  protected function getMyItemsQueries($folder_id, $total = false)
  {
    // Initialise variables.
    $queries = array();

     // Get the files
		$query = $this->getMyQueryForFiles($folder_id, $total);
    $queries[] = (string)$query;

    // Get folders
    $query = $this->getMyQueryForFolders($folder_id, $total);
    $queries[] = (string)$query;

    return $queries;
  }

  protected function getMyQueryForFiles($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo = $this->getDbo();

     // Get the files
		$query = $dbo->getQuery(true)
		  ->from('#__briefcasefactory_files f')
      ->where('f.published = 1')
      ->where('f.folder_id = ' . $dbo->quote($folder_id))
      ->where('f.user_id = ' . $dbo->quote($this->profile_user_id))
      ->where('(f.valid_until = ' . $dbo->quote($dbo->getNullDate()) . ' OR f.valid_until > ' . $dbo->quote(JFactory::getDate()->toSql()) . ')');

    if (!$total) {
      $query->select('f.id, f.title, "file" AS type, f.filename, f.description, f.size, f.share_public, f.share_until, f.user_id, f.valid_until, 0 AS general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    return $query;
  }

  protected function getMyQueryForFolders($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo = $this->getDbo();

    // Get folders
    $query = $dbo->getQuery(true)
      ->from('#__briefcasefactory_folders f')
      ->where('f.parent_id = ' . $dbo->quote($folder_id))
      ->where('(f.user_id = ' . $dbo->quote($this->profile_user_id) . ' OR f.general = ' . $dbo->quote(1) . ')');

    if (!$total) {
      $query->select('f.id, f.title, "folder" AS type, NULL AS filename, NULL AS description, NULL AS size, f.share_public, f.share_until, f.user_id, ' . $dbo->quote($dbo->getNullDate()) . 'as valid_until, f.general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    return $query;
  }

  protected function getUserItemsQueries($folder_id, $total = false)
  {
    // Initialise variables.
    $queries = array();

     // Get the files
		$query = $this->getUserQueryForFiles($folder_id, $total);
    $queries[] = (string)$query;

    // Get folders
    $query = $this->getUserQueryForFolders($folder_id, $total);
    $queries[] = (string)$query;

    return $queries;
  }

  protected function getUserQueryForFiles($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo = $this->getDbo();

     // Get the files
		$query = $dbo->getQuery(true)
		  ->from('#__briefcasefactory_files f')
      ->where('f.published = 1')
      ->where('f.folder_id = ' . $dbo->quote($folder_id))
      ->where('f.user_id = ' . $dbo->q($this->visitor_user_id))
      ->where('(f.valid_until = ' . $dbo->quote($dbo->getNullDate()) . ' OR f.valid_until > ' . $dbo->quote(JFactory::getDate()->toSql()) . ')');

    $query->select('u.username')
      ->leftJoin('#__users u ON u.id = f.user_id');

    if (!$total) {
      $query->select('f.id, f.title, "file" AS type, f.filename, f.description, f.size, f.share_public, f.share_until, f.user_id, f.valid_until, 0 AS general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    $nullDate = $dbo->getNullDate();
    $now      = JFactory::getDate()->toSql();
    $groups   = JAccess::getGroupsByUser($this->profile_user_id);

    $query->leftJoin('#__briefcasefactory_shares_files s ON s.file_id = f.id')
      ->where('((s.type = ' . $dbo->quote('user') . ' AND s.type_id = ' . $dbo->quote($this->profile_user_id) . ') OR (s.type = ' . $dbo->quote('group') . ' AND s.type_id IN (' . implode(',', $groups) . ')))')
      ->where('(s.until = ' . $dbo->quote($nullDate) . ' OR s.until >= ' . $dbo->quote($now) . ')');

    return $query;
  }

  protected function getUserQueryForFolders($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo = $this->getDbo();

    // Get folders
    $query = $dbo->getQuery(true)
      ->from('#__briefcasefactory_folders f')
      ->where('f.parent_id = ' . $dbo->quote($folder_id))
      ->where('f.user_id = ' . $dbo->q($this->visitor_user_id));

    $query->select('u.username')
      ->leftJoin('#__users u ON u.id = f.user_id');

    if (!$total) {
      $query->select('f.id, f.title, "folder" AS type, NULL AS filename, NULL AS description, NULL AS size, f.share_public, f.share_until, f.user_id, ' . $dbo->quote($dbo->getNullDate()) . 'as valid_until, f.general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    $nullDate = $dbo->getNullDate();
    $now      = JFactory::getDate()->toSql();
    $groups   = JAccess::getGroupsByUser($this->profile_user_id);

    $query->leftJoin('#__briefcasefactory_shares_folders s ON s.folder_id = f.id')
      ->where('((s.type = ' . $dbo->quote('user') . ' AND s.type_id = ' . $dbo->quote($this->profile_user_id) . ') OR (s.type = ' . $dbo->quote('group') . ' AND s.type_id IN (' . implode(',', $groups) . ')))')
      ->where('(s.until = ' . $dbo->quote($nullDate) . ' OR s.until >= ' . $dbo->quote($now) . ')');

    return $query;
  }

  protected function addSelectCategoryQuery($query)
  {
    $query->select('c.title AS category_title')
      ->leftJoin('#__categories c ON c.id = f.category_id AND c.extension = ' . $query->q('com_briefcasefactory'));
  }
}
