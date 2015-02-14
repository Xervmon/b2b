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

// Load Joomla framework.
const _JEXEC = 1;

error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors', 1);

// Load system defines
if (file_exists(dirname(__DIR__) . '/defines.php')) {
	require_once dirname(__DIR__) . '/defines.php';
}

if (!defined('_JDEFINES')) {
	define('JPATH_BASE', dirname(__DIR__) . '/../..');
	require_once JPATH_BASE . '/includes/defines.php';
}

require_once JPATH_LIBRARIES . '/import.legacy.php';
require_once JPATH_LIBRARIES . '/cms.php';

// Load the configuration
require_once JPATH_CONFIGURATION . '/configuration.php';

// Load extension.
$extension = JTable::getInstance('Extension');
$result = $extension->find(array('type' => 'component', 'element' => 'com_briefcasefactory'));

// Check if extension is installed.
if (!$result) {
  return false;
}

// Define some constants.
define('JDEBUG', 0);
define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/com_briefcasefactory');
define('JPATH_COMPONENT_SITE',          JPATH_SITE . '/components/com_briefcasefactory');

// Initialise application.
$app = JFactory::getApplication('site');

$settings = JComponentHelper::getParams('com_briefcasefactory');
$request  = $app->input->get->getString('password', '');
$password = $settings->get('cron.password', '');

if ('' == $password || $password != $request) {
  return false;
}

JModelLegacy::addIncludePath(JPATH_COMPONENT_SITE . '/models');
$model = JModelLegacy::getInstance('Maintenance', 'BriefcaseFactoryFrontendModel');

$model->perform();

return true;
