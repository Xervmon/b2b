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

class BriefcaseFactoryFrontendViewFieldUser extends FactoryView
{
  protected
    $variables = array('items', 'pagination', 'search')
  ;

  public function __construct($config = array())
  {
    if (!JFactory::getUser()->authorise('frontend.upload.global', 'com_briefcasefactory')) {
      throw new Exception('Not authorized!', 403);
    }

    parent::__construct($config);
  }
}
