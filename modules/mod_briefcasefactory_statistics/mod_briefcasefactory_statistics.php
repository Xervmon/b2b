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

require_once dirname(__FILE__).'/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$total  = modBriefcaseFactoryStatisticsHelper::getTotal($params);
$public = modBriefcaseFactoryStatisticsHelper::getPublic($params);

require JModuleHelper::getLayoutPath('mod_briefcasefactory_statistics', $params->get('layout', 'default'));
