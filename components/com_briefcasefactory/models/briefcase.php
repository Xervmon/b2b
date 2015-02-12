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

class BriefcaseFactoryFrontendModelBriefcase extends FactoryModelList
{
  protected
    $filters = array('search', 'category', 'public', 'extension')
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
      $table = $this->getTable('Folder', 'BriefcaseFactoryTable');

      // Check if folder exists.
      if (!$table->load($id)) {
        throw new Exception(FactoryText::sprintf('briefcase_folder_not_found', $id), 404);
      }

      // Check if user is allowed to access folder
      if (!$table->isRoot() && !$table->isOwner() && $table->user_id != 0 && !$table->general) {
        throw new Exception(FactoryText::sprintf('briefcase_folder_not_auth', $id), 403);
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

    // Process the results
    $results = $this->processResults($results);

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

  public function getFilterPublic()
  {
    return array(
      0 => FactoryText::_('briefcase_filter_public_option_no'),
      1 => FactoryText::_('briefcase_filter_public_option_yes'),
    );
  }

  public function getFilterExtension()
  {
    $parent  = $this->getParent();
    $dbo     = JFactory::getDbo();
    $user    = JFactory::getUser();
    $options = array();

    // Get the files
		$query = $dbo->getQuery(true)
      ->select('DISTINCT f.extension')
		  ->from('#__briefcasefactory_files f')
      ->where('f.published = 1')
      ->where('f.folder_id = ' . $dbo->quote($parent->id))
      ->where('f.user_id = ' . $dbo->quote($user->id))
      ->where('(f.valid_until = ' . $dbo->quote($dbo->getNullDate()) . ' OR f.valid_until > ' . $dbo->quote(JFactory::getDate()->toSql()) . ')')
      ->order('extension ASC');
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    foreach ($results as $result) {
      $options[$result->extension] = $result->extension;
    }

    return $options;
  }

  public function getFolderLimit()
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $limit = $settings->get('uploads.max_folder_size', 10) * 1024 * 1024;

    // Check of restriction is overriden.
    $admins   = $settings->get('administrators.groups', array());
    $user     = JFactory::getUser();
    $override = $settings->get('override.max_folder_size', 0);

    if ($override && $admins && array_intersect($admins, $user->groups)) {
      return 0;
    }

    return $limit;
  }

  public function getFolderSize()
  {
    $dbo = $this->getDbo();
    $query = $dbo->getQuery(true)
      ->select('SUM(f.size)')
      ->from('#__briefcasefactory_files f')
      ->where('f.user_id = ' . $dbo->quote(JFactory::getUser()->id));
    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }

  public function getEnabledPublicSharing()
  {
    $user = JFactory::getUser();
    $enabled = $user->authorise('frontend.share.public', 'com_briefcasefactory');

    return $enabled;
  }

  public function getEnabledUserSharing()
  {
    $user = JFactory::getUser();
    $enabled = $user->authorise('frontend.share.users', 'com_briefcasefactory');

    return $enabled;
  }

  public function getEnabledGroupSharing()
  {
    $user = JFactory::getUser();
    $enabled = $user->authorise('frontend.share.groups', 'com_briefcasefactory');

    return $enabled;
  }

  public function getEnabledManage()
  {
    $user = JFactory::getUser();
    $enabled = $user->authorise('frontend.manage', 'com_briefcasefactory');

    return $enabled;
  }

  public function getEnabledBulkUpload()
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');

    return $settings->get('uploads.bulk_limit', 5);
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

  public function getPagination()
  {
    $pagination = parent::getPagination();

    $pagination->setAdditionalUrlParam('format', 'html');

    return $pagination;
  }

  public function getOption()
  {
    return JFactory::getApplication()->input->getString('option');
  }

  public function processResults($results)
  {
    $array = array('folders' => array(), 'files' => array());
    foreach ($results as $result) {
      if ('folder' == $result->type) {
        $array['folders'][] = $result->id;
      } else {
        $array['files'][] = $result->id;
      }
    }

    $shares_folders = $this->getSharesFolders($array['folders']);
    $shares_files   = $this->getSharesFiles($array['files']);
    $parent_shares  = $this->getFolderParentShares();
    $parent_public  = $this->getFolderParentPublic();

    foreach ($results as &$result) {
      $array = array();
      if ('folder' == $result->type) {
        if (isset($shares_folders[$result->id])) {
          $array[] = implode(';', $shares_folders[$result->id]);
        }
      } else {
        if (isset($shares_files[$result->id])) {
          $array[] = implode(';', $shares_files[$result->id]);
        }
      }

      if ($parent_shares) {
        $array[] = implode(';', $parent_shares);
      }

      $result->shares = implode(';', $array);

      if (!$result->share_public && $parent_public) {
        $result->share_public = -1;
      }
    }

    return $results;
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

  protected function getQueryForFiles($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo     = $this->getDbo();
    $user_id = JFactory::getUser()->id;

     // Get the files
		$query = $dbo->getQuery(true)
		  ->from('#__briefcasefactory_files f')
      ->where('f.published = 1')
      ->where('f.folder_id = ' . $dbo->quote($folder_id))
      ->where('f.user_id = ' . $dbo->quote($user_id))
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

  protected function getQueryForFolders($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo     = $this->getDbo();
    $user_id = JFactory::getUser()->id;

    // Get folders
    $query = $dbo->getQuery(true)
      ->from('#__briefcasefactory_folders f')
      ->where('f.parent_id = ' . $dbo->quote($folder_id))
      ->where('(f.user_id = ' . $dbo->quote($user_id) . ' OR f.general = ' . $dbo->quote(1) . ')');

    if (!$total) {
      $query->select('f.id, f.title, "folder" AS type, NULL AS filename, NULL AS description, NULL AS size, f.share_public, f.share_until, f.user_id, ' . $dbo->quote($dbo->getNullDate()) . 'as valid_until, f.general')
        ->group('f.id');

      $this->addSelectCategoryQuery($query);
    } else {
      $query->select('COUNT(1)');
    }

    return $query;
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
      $query->where('f.title LIKE ' . $query->quote('%' . $search . '%'));
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

  protected function getSharesFolders($folders)
  {
    if (!$folders) {
      return array();
    }

    $array = array();

    $dbo      = $this->getDbo();
    $nullDate = $dbo->getNullDate();
    $now      = JFactory::getDate()->toSql();

    $query = $dbo->getQuery(true)
      ->select('s.*')
      ->from('#__briefcasefactory_shares_folders s')
      ->where('s.folder_id IN (' . implode(',', $folders) . ')')
      ->where('(s.until = ' . $dbo->quote($nullDate) . ' OR s.until >= ' . $dbo->quote($now) . ')');
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    foreach ($results as $result) {
      if (!isset($array[$result->folder_id])) {
        $array[$result->folder_id] = '';
      }
      $array[$result->folder_id][] = $result->type . ',' .$result->type_id . ',' . $result->until . ',' . $result->id;
    }

    return $array;
  }

  protected function getSharesFiles($files)
  {
    if (!$files) {
      return array();
    }

    $array = array();

    $dbo = JFactory::getDbo();
    $query = $dbo->getQuery(true)
      ->select('s.*')
      ->from('#__briefcasefactory_shares_files s')
      ->where('s.file_id IN (' . implode(',', $files) . ')');
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    foreach ($results as $result) {
      if (!isset($array[$result->file_id])) {
        $array[$result->file_id] = '';
      }
      $array[$result->file_id][] = $result->type . ',' .$result->type_id . ',' . $result->until . ',' . $result->id;
    }

    return $array;
  }

  protected function getFolderParentShares()
  {
    $folder = $this->getParent();
    $folders = array();

    foreach ($folder->getPath() as $folder) {
      $folders[] = $folder->id;
    }

    if (!$folders) {
      return array();
    }

    $parents_shares = $this->getSharesFolders($folders);
    $array = array();

    foreach ($parents_shares as $parent_share) {
      foreach ($parent_share as &$share) {
        $share = '/'.$share;
      }

      $array[] = implode(';', $parent_share);
    }

    return $array;
  }

  protected function getFolderParentPublic()
  {
    // Check if parent folders are public shared.
    $folder = $this->getParent();
    $public = false;

    foreach ($folder->getPath() as $folder) {
      if ($folder->share_public) {
        $public = true;
        break;
      }
    }

    return $public;
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
