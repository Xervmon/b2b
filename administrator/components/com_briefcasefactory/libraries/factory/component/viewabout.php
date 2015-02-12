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

class FactoryViewAbout extends FactoryView
{
  protected
    $defaultButtons   = array(array('homepage', 'homepage', 'dashboard', false)),
    $defaultVariables = array('data')
  ;

  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR.'/libraries/factory/component/views/about/');
  }
}
