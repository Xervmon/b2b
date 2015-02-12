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

// Include dependencies.
require_once JPATH_COMPONENT_ADMINISTRATOR . '/libraries/factory/loader.php';
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/briefcasefactory.php';

// Initialise variables.
$app = JFactory::getApplication();

// Check if user has access to the backend section
if (!JFactory::getUser()->authorise('backend.access', $app->input->get('option'))) {
  throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
}

BriefcaseFactoryHelper::checkSystemPlugin();

// Execute component.
$controller = JControllerLegacy::getInstance('BriefcaseFactoryBackend');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
