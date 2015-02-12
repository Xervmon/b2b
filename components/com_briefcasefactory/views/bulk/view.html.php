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

class BriefcaseFactoryFrontendViewBulk extends FactoryView
{
  protected
    $variables = array('form', 'state'),
    $html = array('jquery.framework', 'behavior.tooltip'),
    $js = array('bootstrap.growl', 'factory.growl'),
    $jtexts = array('bulk_select_one_item', 'bulk_upload_error', 'bulk_upload_error_code'),
    $javascriptVariables = array('bulkLimit')
  ;
}
