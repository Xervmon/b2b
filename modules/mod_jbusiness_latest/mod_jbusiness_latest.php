<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/defines.php';
require_once JPATH_SITE.'/administrator/components/com_jbusinessdirectory/assets/utils.php';

JHtml::_('stylesheet', 'components/com_jbusinessdirectory/assets/css/common.css');
JHtml::_('stylesheet', 'modules/mod_jbusiness_latest/assets/style.css');
// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$language = JFactory::getLanguage();
$language_tag 	= $language->getTag();

$x = $language->load(
		'com_jbusinessdirectory' , dirname(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jbusinessdirectory'.DS.'language') ,
		$language_tag,true );

$items = modJBusinessLatestHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_jbusiness_latest', $params->get('layout', 'default'));
