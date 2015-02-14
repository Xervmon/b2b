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

class JHtmlBriefcaseFactoryShares
{
  public static function shares($shares, $resource, $unshare = true)
  {
    if (empty($shares)) {
      return '';
    }

    $html = array();

    foreach (explode(';', $shares) as $share) {
      list($type, $receiver_id, $until, $id) = explode(',', $share);

      if (0 === strpos($type, '/')) {
        $type = str_replace('/', '', $type);
        $unshare = false;
      }

      $title = self::getShareTitle($type, $receiver_id);
      $array = array();

      if ($unshare) {
        $array[] = '<a href="' . FactoryRoute::task('share.unshare&format=raw&type=' . $resource . '&id=' . $id, true, -1) . '" class="hasTooltip" title="' . FactoryText::_('share_click_to_remove') . '">';
      }
      else {
        $array[] = '<span class="hasTooltip" title="' . FactoryText::_('share_inherited_parents') . '">';
      }

      $array[] = '<i class="icon-' . ('group' == $type ? 'users' : 'user') . '"></i>' . $title;

      if ($unshare) {
        $array[] = '</a>';
      }
      else {
        $array[] = '</span>';
      }

      $array[] = self::shareUntil($until);

      $html[] = implode('', $array);
    }

    return '<span class="share">' . implode(',</span> <span class="share">', $html) . '</span>';
  }

  protected static function getShareTitle($type, $receiver_id)
  {
    if ('user' == $type) {
      return JFactory::getUser($receiver_id)->username;
    }

    return self::getGroupTitle($receiver_id);
  }

  protected static function getGroupTitle($group_id)
  {
    static $groups = null;

    if (is_null($groups)) {
      $dbo = JFactory::getDbo();
      $query = $dbo->getQuery(true)
        ->select('g.title, g.id')
        ->from('#__usergroups g');
      $results = $dbo->setQuery($query)
        ->loadObjectList();

      foreach ($results as $result) {
        $groups[$result->id] = $result->title;
      }
    }

    return $groups[$group_id];
  }

  protected static function shareUntil($until)
  {
    if (!$until || JFactory::getDbo()->getNullDate() == $until) {
      return '';
    }

    $html = array();

    $html[] = '&nbsp;<span class="muted small">(' . JHtml::_('date', $until, 'Y-m-d') . ')</span>';

    return implode("\n", $html);
  }
}
