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

class BriefcaseFactoryFrontendViewFolder extends FactoryView
{
  protected
    $variables = array('item', 'form', 'state'),
    $html = array('behavior.multiselect', 'formbehavior.chosen/select', 'behavior.tooltip', 'behavior.modal'),
    $css = array('icons')
  ;
}
