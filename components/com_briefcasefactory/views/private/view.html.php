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

JLoader::register('BriefcaseFactoryFrontendViewPublic', JPATH_SITE . '/components/com_briefcasefactory/views/public/view.html.php');

class BriefcaseFactoryFrontendViewPrivate extends BriefcaseFactoryFrontendViewPublic
{
  protected $permissions = array();

  public function __construct($config = array())
	{
    parent::__construct($config);

    $this->_addTemplatePath(JPATH_SITE . '/components/com_briefcasefactory/views/public/tmpl/');
  }
}
