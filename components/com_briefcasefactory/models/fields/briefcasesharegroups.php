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

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('UserGroup');

class JFormFieldBriefcaseShareGroups extends JFormFieldUsergroup
{
	public $type = 'BriefcaseShareGroups';

  protected function getInput()
	{
		$options = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$attr .= $this->multiple ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		// Iterate through the children and build an array of options.
		foreach ($this->element->children() as $option)
		{

			// Only add <option /> elements.
			if ($option->getName() != 'option')
			{
				continue;
			}

			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_(
				'select.option', (string) $option['value'], trim((string) $option), 'value', 'text',
				((string) $option['disabled'] == 'true')
			);

			// Set some option attributes.
			$tmp->class = (string) $option['class'];

			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		return $this->getList($this->name, $this->value, $attr, $options, $this->id);
	}

  protected function getList($name, $selected, $attribs = '', $allowAll = true)
  {
    $settings = JComponentHelper::getParams('com_briefcasefactory');
    $db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id AS value, a.title AS text, COUNT(DISTINCT b.id) AS level');
		$query->from($db->quoteName('#__usergroups') . ' AS a');
		$query->join('LEFT', $db->quoteName('#__usergroups') . ' AS b ON a.lft > b.lft AND a.rgt < b.rgt');
		$query->group('a.id, a.title, a.lft, a.rgt');
		$query->order('a.lft ASC');
		$db->setQuery($query);

    // Filter restricted receive share groups.
    $groups = $settings->get('restrictions.share_receive', array());
    if ($groups) {
      $query->where('a.id NOT IN (' . implode(',', $groups) . ')');
    }

    // Filter share only with groups restriction.
    $groups   = $settings->get('sharing.share_only_groups', array());
    $override = $settings->get('override.share_only_groups', 0);
    $admins   = $settings->get('administrators.groups', array());
    $user     = JFactory::getUser();

    if ($groups && (!$override || !$admins || !array_intersect($admins, $user->groups))) {
      $query->where('a.id IN (' . implode(',', $groups) . ')');
    }

		$options = $db->loadObjectList();

		for ($i = 0, $n = count($options); $i < $n; $i++) {
			$options[$i]->text = str_repeat('- ', $options[$i]->level) . $options[$i]->text;
		}

		// If all usergroups is allowed, push it into the array.
		if ($allowAll) {
			array_unshift($options, JHtml::_('select.option', '', JText::_('JOPTION_ACCESS_SHOW_ALL_GROUPS')));
		}

		return JHtml::_('select.genericlist', $options, $name, array('list.attr' => $attribs, 'list.select' => $selected));
  }
}
