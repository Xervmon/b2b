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

class BriefcaseFactoryBackendModelShareUsers extends FactoryModelAdmin
{
  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->setState('list.limit', 10);
    $this->setState('list.start', JFactory::getApplication()->input->getInt('limitstart', 0));
  }

  public function getItem($pk = null)
  {
  }

  public function getFileId()
  {
    return JFactory::getApplication()->input->getInt('id');
  }

  public function getUsers()
  {
    $dbo = $this->getDbo();
    $query = $this->getListQuery()
      ->select('u.id, u.username');

    $results = $dbo->setQuery($query, $this->getState('list.start'), $this->getState('list.limit'))
      ->loadObjectList();

    return $results;
  }

  public function getPagination()
  {
    $pagination = new ShareUsersPagination($this->getTotal(), $this->getState('list.start'), $this->getState('list.limit'));

    $pagination->setAdditionalUrlParam('search', $this->getSearch());

    return $pagination;
  }

  public function getTotal()
  {
    $dbo = $this->getDbo();
    $query = $this->getListQuery()
      ->select('COUNT(u.id) AS total');

    $result = $dbo->setQuery($query)
      ->loadResult();

    return $result;
  }

  public function getSearch()
  {
    return JFactory::getApplication()->input->getString('search');
  }

  protected function getListQuery()
  {
    $dbo = $this->getDbo();
    $user = JFactory::getUser();

    // Get main query.
    $query = $dbo->getQuery(true)
      ->from('#__users u')
//      ->where('u.id <> ' . $dbo->quote($user->id))
      ->order('u.username ASC');

    // Filter by allowed groups.
    $groups = JComponentHelper::getParams('com_briefcasefactory')->get('restrictions.share_receive', array());
    if ($groups) {
      $query->leftJoin('#__user_usergroup_map m ON m.user_id = u.id')
        ->where('m.group_id NOT IN (' . implode(',', $groups) . ')');
    }

    // Filter by username.
    $filter = JFactory::getApplication()->input->getString('search');
    if ('' != $filter) {
      $query->where('u.username LIKE ' . $dbo->quote('%' . $filter . '%'));
    }

    return $query;
  }

  protected function populateState()
  {
  }
}

// Implement select instead of pagination !!!!!!!!!

class ShareUsersPagination extends JPagination
{
  public function getPagesLinks()
	{
		// Build the page navigation list.
		$data = $this->_buildDataObject();

		$list = array();
		$list['prefix'] = $this->prefix;

		$itemOverride = false;
		$listOverride = false;

		// Build the select list
		if ($data->all->base !== null)
		{
			$list['all']['active'] = true;
			$list['all']['data'] = ($itemOverride) ? pagination_item_active($data->all) : $this->_item_active($data->all);
		}
		else
		{
			$list['all']['active'] = false;
			$list['all']['data'] = ($itemOverride) ? pagination_item_inactive($data->all) : $this->_item_inactive($data->all);
		}

		if ($data->start->base !== null)
		{
			$list['start']['active'] = true;
			$list['start']['data'] = ($itemOverride) ? pagination_item_active($data->start) : $this->_item_active($data->start);
		}
		else
		{
			$list['start']['active'] = false;
			$list['start']['data'] = ($itemOverride) ? pagination_item_inactive($data->start) : $this->_item_inactive($data->start);
		}
		if ($data->previous->base !== null)
		{
			$list['previous']['active'] = true;
			$list['previous']['data'] = ($itemOverride) ? pagination_item_active($data->previous) : $this->_item_active($data->previous);
		}
		else
		{
			$list['previous']['active'] = false;
			$list['previous']['data'] = ($itemOverride) ? pagination_item_inactive($data->previous) : $this->_item_inactive($data->previous);
		}

		// Make sure it exists
		$list['pages'] = array();
		foreach ($data->pages as $i => $page)
		{
			if ($page->base !== null)
			{
				$list['pages'][$i]['active'] = true;
				$list['pages'][$i]['data'] = ($itemOverride) ? pagination_item_active($page) : $this->_item_active($page);
			}
			else
			{
				$list['pages'][$i]['active'] = false;
				$list['pages'][$i]['data'] = ($itemOverride) ? pagination_item_inactive($page) : $this->_item_inactive($page);
			}
		}

		if ($data->next->base !== null)
		{
			$list['next']['active'] = true;
			$list['next']['data'] = ($itemOverride) ? pagination_item_active($data->next) : $this->_item_active($data->next);
		}
		else
		{
			$list['next']['active'] = false;
			$list['next']['data'] = ($itemOverride) ? pagination_item_inactive($data->next) : $this->_item_inactive($data->next);
		}

		if ($data->end->base !== null)
		{
			$list['end']['active'] = true;
			$list['end']['data'] = ($itemOverride) ? pagination_item_active($data->end) : $this->_item_active($data->end);
		}
		else
		{
			$list['end']['active'] = false;
			$list['end']['data'] = ($itemOverride) ? pagination_item_inactive($data->end) : $this->_item_inactive($data->end);
		}

		if ($this->total > $this->limit)
		{
			return ($listOverride) ? pagination_list_render($list) : $this->_list_render($list);
		}
		else
		{
			return '';
		}
	}

  protected function _item_active(JPaginationObject $item)
  {
    $item->link .= '&option=com_briefcasefactory&view=shareusers&format=raw';

    // Check for "Start" item
    if ($item->text == JText::_('JLIB_HTML_START'))
    {
      $display = '<i class="icon-first"></i>';
    }

    // Check for "Prev" item
    if ($item->text == JText::_('JPREV'))
    {
      $display = '<i class="icon-previous"></i>';
    }

    // Check for "Next" item
    if ($item->text == JText::_('JNEXT'))
    {
      $display = '<i class="icon-next"></i>';
    }

    // Check for "End" item
    if ($item->text == JText::_('JLIB_HTML_END'))
    {
      $display = '<i class="icon-last"></i>';
    }

    // If the display object isn't set already, just render the item with its text
    if (!isset($display))
    {
      $display = $item->text;
    }

    return "<li><a title=\"" . $item->text . "\" href=\"" . $item->link . "\" class=\"pagenav\">" . $item->text . "</a><li>";
  }
}
