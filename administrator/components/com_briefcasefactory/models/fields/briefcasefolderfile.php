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

class JFormFieldBriefcaseFolderFile extends JFormFieldList
{
	public $type = 'BriefcaseFolderFile';

  protected function getOptions()
  {
    // Initialise variables.
    $options = array();
    $dbo     = JFactory::getDbo();
    $table   = JTable::getInstance('Folder', 'BriefcaseFactoryTable');

    // Get items.
    $query = $dbo->getQuery(true)
      ->select('f.id, f.title, f.level')
			->from($dbo->qn('#__briefcasefactory_folders', 'f'))
			->where('f.parent_id > ' . $dbo->q(0))
			->order('f.lft');

    $userId = $this->form->getValue('user_id', null, JFactory::getUser()->id);
    $query->where('(f.user_id = ' . $dbo->q($userId) . ' OR f.general = ' . $dbo->q(1) . ')');

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
