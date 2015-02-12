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

class BriefcaseFactoryHelperList
{
  public static function filterResultsTree($results)
  {
    $tree = array();

    foreach ($results as $result) {
      if ('folder' != $result->type) {
        continue;
      }

      $tree[$result->lft] = $result->rgt;
    }

    foreach ($results as $i => $result) {
      if ('folder' != $result->type) {
        continue;
      }

      foreach ($tree as $lft => $rgt) {
        if ($result->lft > $lft && $result->rgt < $rgt) {
          unset($results[$i]);
          break;
        }
      }
    }

    return $results;
  }
}
