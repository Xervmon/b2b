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

JFormHelper::loadFieldType('List');

class JFormFieldBriefcaseFolder extends JFormFieldList
{
	public $type = 'BriefcaseFolder';

  public function setup(SimpleXMLElement $element, $value, $group = null)
  {
    if (!parent::setup($element, $value, $group)) {
      return false;
    }

    if (!$this->value) {
      $this->value = JFactory::getApplication()->input->getInt('folder', 1);
    }

    return true;
  }

	protected function getOptions()
  {
    // Initialise variables.
    $options = array();
    $dbo     = JFactory::getDbo();
    $table   = JTable::getInstance('Folder', 'BriefcaseFactoryTable');

    // Get items.
    $query = $dbo->getQuery(true)
      ->select('f.id, f.title, f.level')
			->from('#__briefcasefactory_folders f')
			->where('f.parent_id > 0')
			->order('f.lft');

    // Filter by general folder.
    $general = $this->form->getValue('general', 0);
    $query->where('f.general = ' . $dbo->quote($general));

    // Filter by user.
    if (!$general) {
      $userId = $this->form->getValue('user_id', 0);
      $query->where('f.user_id = ' . $dbo->quote($userId));
    }

    $items = $dbo->setQuery($query)
      ->loadObjectList();

    // Parse items.
    foreach ($items as &$item) {
      $item->title = str_repeat('- ', $item->level) . $item->title;
      $options[] = JHtml::_('select.option', $item->id, $item->title);
    }

    array_unshift($options, JHtml::_('select.option', $table->getRootId(), JText::_('JGLOBAL_ROOT')));

    return $options;
  }
}
