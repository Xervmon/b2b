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

class JFormFieldBriefcaseFileSharedGroups extends JFormField
{
	public $type = 'BriefcaseFileSharedGroups';

  protected function getInput()
  {
    $html = array();

    $id = $this->form->getValue('id');
    $shares = $this->getShares($id);

    $html[] = '<ul class="shares">';
    foreach ($shares as $share) {
      $html[] = '<li>';
      $html[] = '<a href="' . FactoryRoute::task('share.remove&format=raw&id=' . $share->id) . '">' . $share->title . '</a>';

      if ($share->until != JFactory::getDbo()->getNullDate()) {
        $html[] = '&nbsp;<span class="muted small">(' . $share->until . ')</span>';
      }

      $html[] = '</li>';
    }
    $html[] = '</ul>';

    return implode("\n", $html);
  }

  protected function getShares($id)
  {
    $dbo = JFactory::getDbo();
    $date = JFactory::getDate();

    $query = $dbo->getQuery(true)
      ->select('s.*')
      ->from('#__briefcasefactory_shares_files s')
      ->where('s.type = ' . $dbo->quote('group'))
      ->where('s.file_id = ' . $dbo->quote($id))
      ->where('(s.until = ' . $dbo->quote($dbo->getNullDate()) . ' OR s.until > ' . $dbo->quote($date->toSql()) . ')');

    // Select group title.
    $query->select('g.title')
      ->leftJoin('#__usergroups g ON g.id = s.type_id');

    $results = $dbo->setQuery($query)
      ->loadObjectList();

    return $results;
  }
}
