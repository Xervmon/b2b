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

class BriefcaseFactoryFrontendModelCbPrivate extends JModelLegacy
{
  protected $profile_user_id;
  protected $visitor_user_id;
  protected $limit;
  protected $limitstart;

  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->profile_user_id = $config['profile_user_id'];
    $this->visitor_user_id = $config['visitor_user_id'];

    $this->limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
    $this->limit      = JComponentHelper::getParams('com_briefcasefactory')->get('pagination.resources', 10);
  }

  public function getOption()
  {
    return JFactory::getApplication()->input->getString('option');
  }

  public function getItems()
  {
    $results = $this->profile_user_id == $this->visitor_user_id
             ? $this->getMyPrivateItems()
             : $this->getUserPrivateItems();

    $results = BriefcaseFactoryHelperList::filterResultsTree($results);

    return $results;
  }

  public function getPagination()
  {
    $pagination = new JPagination($this->getTotal(), $this->limitstart, $this->limit);
    $pagination->setAdditionalUrlParam('format', 'html');

    return $pagination;
  }

  public function getParent()
  {
    /* @var $model BriefcaseFactoryFrontendModelBriefcase */
    $model = JModelLegacy::getInstance('Private', 'BriefcaseFactoryFrontendModel');

    return $model->getParent(1);
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

  protected function getMyPrivateItems()
  {
    // Initialise variables.
    $dbo    = $this->getDbo();
    $parent = $this->getParent();

    // Get the queries for the current folder.
    $queries = $this->getMyItemsQueries($parent->id, false);

    // Compose the query.
    $query = ' (' . implode(') UNION (', $queries) . ')'
           . ' ORDER BY type DESC, title ASC'
           . ' LIMIT ' . $this->limitstart . ', ' . $this->limit;

    // Load the results.
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    return $results;
  }

  protected function getUserPrivateItems()
  {
    // Initialise variables.
    $dbo    = $this->getDbo();
    $parent = $this->getParent();

    // Get the queries for the current folder.
    $queries = $this->getUserItemsQueries($parent->id, false);

    // Compose the query.
    $query = ' (' . implode(') UNION (', $queries) . ')'
           . ' ORDER BY type DESC, title ASC'
           . ' LIMIT ' . $this->limitstart . ', ' . $this->limit;

    // Load the results.
    $results = $dbo->setQuery($query)
      ->loadObjectList();

    return $results;
  }

  protected function getMyItemsQueries($folder_id, $total = false)
  {
    return array(
      (string)$this->getMyQueryForFiles($folder_id, $total),
      (string)$this->getMyQueryForFolders($folder_id, $total),
    );
  }

  protected function getUserItemsQueries($folder_id, $total = false)
  {
    return array(
      (string)$this->getUserQueryForFiles($folder_id, $total),
      (string)$this->getUserQueryForFolders($folder_id, $total),
    );
  }

  protected function getMyQueryForFiles($folder_id, $total = false)
  {
    // Initialise variables.
    $model = JModelLegacy::getInstance('Private', 'BriefcaseFactoryFrontendModel');

    // Get main query.
    $query = $model->getQueryForFiles($folder_id, $total, $this->profile_user_id);

    return $query;
  }

  protected function getMyQueryForFolders($folder_id, $total = false)
  {
    // Initialise variables.
    $model = JModelLegacy::getInstance('Private', 'BriefcaseFactoryFrontendModel');

    // Get main query.
    $query = $model->getQueryForFolders($folder_id, $total, $this->profile_user_id);

    return $query;
  }

  protected function getUserQueryForFiles($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo   = $this->getDbo();
    $model = JModelLegacy::getInstance('Private', 'BriefcaseFactoryFrontendModel');

    // Get main query.
    $query = $model->getQueryForFiles($folder_id, $total, $this->visitor_user_id);

    // Filter only files that belong to the current user profile.
    $query->where('f.user_id = ' . $dbo->q($this->profile_user_id));

    return $query;
  }

  protected function getUserQueryForFolders($folder_id, $total = false)
  {
    // Initialise variables.
    $dbo   = $this->getDbo();
    $model = JModelLegacy::getInstance('Private', 'BriefcaseFactoryFrontendModel');

    // Get main query.
    $query = $model->getQueryForFolders($folder_id, $total, $this->visitor_user_id);

    // Filter only folders that belong to the current user profile.
    $query->where('f.user_id = ' . $dbo->q($this->profile_user_id));

    return $query;
  }
}
