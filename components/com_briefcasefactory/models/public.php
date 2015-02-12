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

class BriefcaseFactoryFrontendModelPublic extends FactoryModelList
{
  protected
    $filters = array('search', 'category'),
    $parentId
  ;

  public function __construct($config = array())
  {
    parent::__construct($config);

    $params = JComponentHelper::getParams('com_briefcasefactory');

    // Set pagination limit.
    $this->setState('list.limit', $params->get('pagination.resources', 10));
  }

  public function getParent($id = null)
  {
    static $parents = array();

    if (is_null($id)) {
      $id = JFactory::getApplication()->input->getInt('parent', 1);
    }

    if (!isset($parents[$id])) {
      /* @var $table BriefcaseFactoryTableFolder */
      $table = $this->getTable('Folder', 'BriefcaseFactoryTable');

      // Check if folder exists.
      if (!$table->load($id)) {
        throw new Exception(FactoryText::sprintf('briefcase_folder_not_found', $id), 404);
      }

      // Check if folder is public shared.
      if (!$table->isRoot() && !$table->isPublic()) {
        throw new Exception(FactoryText::sprintf('public_folder_not_public', $id), 403);
      }

      $parents[$id] = $table;
    }

    return $parents[$id];
  }

  public function getItems()
  {
    // Initialise variables.
    $dbo    = $this->getDbo();
    $parent = $this->getParent();

    // Get the queries for the current folder.
    $queries = $this->getItemsQueries($parent->id);

    // Compose the query.
    $query = ' (' . implode(') UNION (', $queries) . ')'
           . ' ORDER BY type DESC, title ASC'
           . ' LIMIT ' . $this->getState('list.start', 0) . ', ' . $this->getState('list.limit', 10);

    // Load the results.
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    $results = BriefcaseFactoryHelperList::filterResultsTree($results);

    return $results;
  }

  public function getTotal()
  {
    static $total = null;

    if (is_null($total)) {
      // Initialise variables.
      $dbo    = $this->getDbo();
      $folder = $this->getParent();
      $total  = 0;

      // Get the queries for the current folder.
      $queries = $this->getItemsQueries($folder->id, true);

      foreach ($queries as $query) {
        $total += $dbo->setQuery($query)->loadResult();
      }
    }

    return $total;
  }

  public function getFilterCategory()
  {
    return JHtml::_('category.options', 'com_briefcasefactory');
  }

  public function getFilters()
  {
    $input   = JFactory::getApplication()->input;
    $options = array();

    foreach ($this->filters as $filter) {
      $value = $input->getString($filter, '');
      if ('' != $value) {
        $options[] = $filter . '=' . urlencode($value);
      }
    }

    return implode('&', $options);
  }

  public function getOption()
  {
    return JFactory::getApplication()->input->getString('option');
  }

  public function getBreadcrumbs()
  {
    $breadcrumbs = array();

    $parent = $this->getParent();

    foreach ($parent->getPath() as $folder) {
      $table = $this->getTable('Folder', 'BriefcaseFactoryTable');
      $table->bind($folder);

      if ($table->isRoot() || $table->isPublic()) {
        $breadcrumbs[] = $folder;

        // Mark folder as parent id.
        if ($parent->id != $folder->id) {
          $this->parentId = $folder->id;
        }
      }
    }

    return $breadcrumbs;
  }

  public function getQueryForFiles($folder_id, $total = false, $userId = null)
  {
    // Initialise variables.
    $dbo = $this->getDbo();
    $parent = $this->getParent();

    if (is_null($userId)) {
      $userId = JFactory::getUser()->id;
    }

     // Get the files
		$query = $dbo->getQuery(true)
		  ->from('#__briefcasefactory_files f')
      ->where('f.published = 1')
      ->where('(f.valid_until = ' . $dbo->quote($dbo->getNullDate()) . ' OR f.valid_until > ' . $dbo->quote(JFactory::getDate()->toSql()) . ')');

    if (!$total) {
      $query->select('0 AS lft, 0 AS rgt');

      $query->select('u.username')
        ->leftJoin('#__users u ON u.id = f.user_id');

      $query->select('f.id, f.title, "file" AS type, f.filename, f.description, f.size, f.share_public, f.share_until, f.user_id, f.valid_until, 0 AS general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    if ($parent->isRoot()) {
      // If parent folder is root, show all the files that have been explicitly public shared.
      $dbo      = $this->getDbo();
      $nullDate = $dbo->getNullDate();
      $now      = JFactory::getDate()->toSql();

      $query->where('f.share_public = ' . $dbo->quote(1))
        ->where('(f.share_until = ' . $dbo->quote($nullDate) . ' OR f.share_until >= ' . $dbo->quote($now) . ')');

      $query->where('f.user_id <> ' . $dbo->q($userId));
    }
    else {
      // If parent folder is not root, show all the files that current folder contains.
      // Since we are allowed access to this folder, we must assume that the folder is already public shared.
      $query->where('f.folder_id = ' . $dbo->quote($folder_id));
    }

    return $query;
  }

  public function getQueryForFolders($folder_id, $total = false, $userId = null)
  {
    // Initialise variables.
    $dbo    = $this->getDbo();
    $parent = $this->getParent();

    if (is_null($userId)) {
      $userId = JFactory::getUser()->id;
    }

    // Get folders
    $query = $dbo->getQuery(true)
      ->from('#__briefcasefactory_folders f');

    if (!$total) {
      $query->select('f.lft, f.rgt');

      $query->select('u.username')
        ->leftJoin('#__users u ON u.id = f.user_id');

      $query->select('f.id, f.title, "folder" AS type, NULL AS filename, NULL AS description, NULL AS size, f.share_public, f.share_until, f.user_id, ' . $dbo->quote($dbo->getNullDate()) . 'as valid_until, f.general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    if ($parent->isRoot()) {
      // If parent folder is root, show all the folders that have been explicitly public shared.
      $dbo      = $this->getDbo();
      $nullDate = $dbo->getNullDate();
      $now      = JFactory::getDate()->toSql();

      $query->where('f.share_public = ' . $dbo->quote(1))
        ->where('(f.share_until = ' . $dbo->quote($nullDate) . ' OR f.share_until >= ' . $dbo->quote($now) . ')');

      $query->where('f.user_id <> ' . $dbo->q($userId));
    }
    else {
      // If parent folder is not root, show all the folders that current folder contains.
      // Since we are allowed access to this folder, we must assume that the folder is already public shared.
      $query->where('f.parent_id = ' . $dbo->quote($folder_id));
    }

    return $query;
  }

  public function getParentId()
  {
    return $this->parentId;
  }

  protected function getItemsQueries($folder_id, $total = false)
  {
    // Initialise variables.
    $queries = array();

     // Get the files
		$query = $this->getQueryForFiles($folder_id, $total);
    $this->filterItems($query, 'file');
    $queries[] = (string)$query;

    // Get folders
    $query = $this->getQueryForFolders($folder_id, $total);
    $this->filterItems($query, 'folder');
    $queries[] = (string)$query;

    return $queries;
  }

  protected function addSelectCategoryQuery($query)
  {
    $query->select('c.title AS category_title')
      ->leftJoin('#__categories c ON c.id = f.category_id AND c.extension = ' . $query->quote('com_briefcasefactory'));
  }

  protected function filterItems($query, $item)
  {
    // Filter by search
    $search = $this->getState('filter.search');
    if ('' != $search) {
      $array = array();
      $array[] = 'f.title LIKE ' . $query->quote('%' . $search . '%');
      $array[] = 'u.username LIKE ' . $query->quote('%' . $search . '%');

      $query->where('(' . implode(' OR ', $array) . ')');
    }

    // Filter by category
		$category = $this->getState('filter.category');
		if ('' != $category) {
			$query->where('f.category_id = ' . $query->quote($category));
		}

    // Filter by public
    $public = $this->getState('filter.public');
		if ('' != $public) {
      if (0 == $public) {
        $query->where('(f.share_public = ' . $query->quote(0) . ' OR (f.share_until <> ' . $query->quote(JFactory::getDbo()->getNullDate()) . ' AND f.share_until < ' . $query->quote(JFactory::getDate()->toSql()) . '))');
      }
      else {
        $query->where('f.share_public = ' . $query->quote(1))
          ->where('(f.share_until = ' . $query->quote(JFactory::getDbo()->getNullDate()) . ' OR f.share_until > ' . $query->quote(JFactory::getDate()->toSql()) . ')');
      }
		}

    // Filter by extension.
    if ('file' == $item) {
      $extension = $this->getState('filter.extension');
      if ('' != $extension) {
        $query->where('f.extension = ' . $query->quote($extension));
      }
    }
  }

  protected function populateState($ordering = null, $direction = null)
	{
    $app = JFactory::getApplication();

    foreach ($this->filters as $filter) {
      $clean = 'search' == $filter ? 'raw' : 'cmd';
      $value = $app->input->get($filter, '', $clean);

		  $this->setState('filter.' . $filter, $value);
    }

    $this->setState('list.start', $app->input->get('limitstart'));
	}
}
