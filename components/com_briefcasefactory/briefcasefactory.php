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
JLoader::discover('BriefcaseFactoryHelper', JPATH_COMPONENT_SITE . '/helpers');

// Initialise variables.
$app = JFactory::getApplication();

if (JFactory::getUser()->guest) {
  $app->enqueueMessage(JText::_('COM_BRIEFCASEFACTORY_YOU_MUST_LOGIN_FIRST'), 'error');
  $app->redirect(JRoute::_('index.php?option=com_users&view=login'));
}

// Check if user has access to the frontend section.
if (!JFactory::getUser()->authorise('frontend.access', $app->input->get('option'))) {
  throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
}

BriefcaseFactoryHelper::checkSystemPlugin();

// Execute component.
$controller = JControllerLegacy::getInstance('BriefcaseFactoryFrontend');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
