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

class FactoryModelList extends JModelList
{
  protected $filters = array();
  protected $defaultOrdering = 'id';
  protected $defaultDirection = 'desc';
  protected $filterSearchFields = array('title');
  protected $tableAlias = '';

  public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array_keys($this->getSortFields());
		}

		parent::__construct($config);
	}

  public function getSortFields()
  {
    return array();
  }

  public function getListOrder()
  {
    return $this->state->get('list.ordering');
  }

  public function getListDirn()
  {
    return $this->state->get('list.direction');
  }

  public function getSaveOrder()
  {
    $result = $this->getListOrder() == $this->tableAlias . '.lft';

    return $result;
  }

  public function getFilterPublished()
  {
    return JHtml::_('jgrid.publishedOptions', array(
      'trash'    => false,
      'archived' => false,
      'all'      => false,
    ));
  }

  public function getFilterLanguage()
  {
    $array = array();
    $languages = JHtml::_('contentlanguage.existing');
    array_unshift($languages, (object)array('value' => '*', 'text' => JText::_('JALL')));

    foreach ($languages as $language) {
      $array[$language->value] = $language->text;
    }

	  return $array;
  }

  public function getFilters()
  {
    return $this->filters;
  }

  public function getTableAlias()
  {
    return $this->tableAlias;
  }

  public function getOrdering()
  {
    $array = array();

    foreach ($this->getItems() as $item) {
      if (!isset($item->parent_id)) {
        continue;
      }

			$array[$item->parent_id][] = $item->id;
		}

    return $array;
  }

  protected function getQuery()
  {
    return parent::getListQuery();
  }

  protected function getListQuery()
  {
    $query = $this->getQuery();

    // Filter and order results.
    foreach ($this->filters as $filter) {
      $method = 'addFilter' . $filter;

      if (method_exists($this, $method)) {
        call_user_func_array(array($this, $method), array(&$query));
      }
    }

    // Order results.
    $this->addOrderResults($query);

    return $query;
  }

  protected function addFilterPublished(&$query)
  {
    $published = $this->getState('filter.published');

    if ('' != $published) {
      $query->where($this->tableAlias . '.published = ' . $query->quote($published));
    }
  }

  protected function addFilterSearch(&$query)
  {
		$search = $this->getState('filter.search');

    if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where($this->tableAlias . '.id = ' . (int)substr($search, 3));
			} else {
        $search = $query->quote('%' . $query->escape($search, true) . '%');
        $array = array();

        foreach ($this->filterSearchFields as $field) {
          $tableAlias = $this->tableAlias;

          if (false !== strpos($field, '.')) {
            list($tableAlias, $field) = explode('.', $field);
          }

          $array[] = '(' . $tableAlias . '.' . $field . ' LIKE ' . $search . ')';
        }

        if ($array) {
          $query->where('(' . implode(') OR (', $array) . ')');
        }
			}
		}
  }

  protected function addFilterLanguage(&$query)
  {
    $language = $this->getState('filter.language');

    if ('' != $language) {
      $query->where($this->tableAlias . '.lang_code = ' . $query->quote($language));
    }
  }

  protected function addOrderResults(&$query)
  {
    $orderCol  = $this->state->get('list.ordering', $this->tableAlias . '.' . $this->defaultOrdering);
		$orderDirn = $this->state->get('list.direction', $this->defaultDirection);

    $query->order($query->escape($orderCol . ' ' . $orderDirn));
  }

  protected function populateState($ordering = null, $direction = null)
	{
    if (is_null($ordering)) {
      $ordering = $this->tableAlias . '.' . $this->defaultOrdering;
    }

    if (is_null($direction)) {
      $direction = $this->defaultDirection;
    }

		$app = JFactory::getApplication();

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout')) {
			$this->context .= '.' . $layout;
		}

    foreach ($this->filters as $filter) {
      $value = $this->getUserStateFromRequest($this->context.'.filter.' . $filter, 'filter_' . $filter, '');
		  $this->setState('filter.' . $filter, $value);
    }

		// List state information.
		parent::populateState($ordering, $direction);
	}
}
