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

class BriefcaseFactoryFrontendViewBriefcase extends FactoryView
{
  protected
    $variables = array(
      'parent',
      'items',
      'pagination',
      'state',
      'filterCategory',
      'filterPublic',
      'filterExtension',
      'filters',
      'folderLimit',
      'folderSize',
      'enabledPublicSharing',
      'enabledUserSharing',
      'enabledGroupSharing',
      'enabledManage',
      'enabledBulkUpload',
      'option'
    ),
    $html = array('behavior.multiselect', 'formbehavior.chosen/select', 'behavior.modal'),
    $css = array('icons'),
    $js = array('list', 'bootstrap.growl', 'factory.growl'),
    $jtexts = array('select_one_item')
  ;
}
