
--
-- Table structure for table `#__assets`
--

CREATE TABLE IF NOT EXISTS `#__assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `#__assets`
--

INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 1, 173, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":{"6":1},"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 3, 8, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(4, 1, 9, 10, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(5, 1, 11, 12, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(6, 1, 13, 14, 1, 'com_config', 'com_config', '{}'),
(7, 1, 15, 18, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(8, 1, 19, 72, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(9, 1, 73, 74, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 75, 76, 1, 'com_installer', 'com_installer', '{"core.admin":[],"core.manage":{"7":0},"core.delete":{"7":0},"core.edit.state":{"7":0}}'),
(11, 1, 77, 78, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(12, 1, 79, 80, 1, 'com_login', 'com_login', '{}'),
(13, 1, 81, 82, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 83, 84, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 85, 86, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1}}'),
(16, 1, 87, 88, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(17, 1, 89, 90, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(18, 1, 91, 136, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(19, 1, 137, 140, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(20, 1, 141, 142, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.edit":[],"core.edit.state":[]}'),
(21, 1, 143, 144, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}'),
(22, 1, 145, 146, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(23, 1, 147, 148, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(24, 1, 149, 152, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(25, 1, 153, 156, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(26, 1, 157, 158, 1, 'com_wrapper', 'com_wrapper', '{}'),
(27, 8, 20, 23, 2, 'com_content.category.2', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(28, 3, 4, 5, 2, 'com_banners.category.3', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(29, 7, 16, 17, 2, 'com_contact.category.4', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(30, 19, 138, 139, 2, 'com_newsfeeds.category.5', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(31, 25, 154, 155, 2, 'com_weblinks.category.6', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(32, 24, 150, 151, 1, 'com_users.category.7', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(33, 1, 159, 160, 1, 'com_finder', 'com_finder', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(34, 1, 161, 162, 1, 'com_joomlaupdate', 'com_joomlaupdate', '{"core.admin":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(35, 37, 61, 70, 3, 'com_content.category.8', 'Joomla', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(36, 35, 62, 63, 4, 'com_content.article.1', 'The Joomla! Community', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(37, 8, 24, 71, 2, 'com_content.category.9', 'Sample Data Article', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(38, 37, 25, 60, 3, 'com_content.category.10', 'Demo', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(39, 38, 26, 27, 4, 'com_content.article.2', 'Module Variations', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(40, 38, 28, 49, 4, 'com_content.category.11', 'Shortcode', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(41, 40, 29, 30, 5, 'com_content.article.3', 'Accordion', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(42, 40, 31, 32, 5, 'com_content.article.4', 'Carousel', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(43, 40, 33, 34, 5, 'com_content.article.5', 'Tab', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(44, 40, 35, 36, 5, 'com_content.article.6', 'Map', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(45, 40, 37, 38, 5, 'com_content.article.7', 'Testimonial ', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(46, 40, 39, 40, 5, 'com_content.article.8', 'Alert', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(47, 40, 41, 42, 5, 'com_content.article.9', 'Button', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(48, 40, 43, 44, 5, 'com_content.article.10', 'Icon', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(49, 40, 45, 46, 5, 'com_content.article.11', 'Column', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(50, 38, 50, 51, 4, 'com_content.article.12', 'Powerfull Features', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(51, 38, 52, 53, 4, 'com_content.article.13', 'Article', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(52, 38, 54, 55, 4, 'com_content.article.14', 'Typography', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(54, 40, 47, 48, 5, 'com_content.article.16', 'Gallery', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(55, 38, 56, 57, 4, 'com_content.article.17', 'Video', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(56, 38, 58, 59, 4, 'com_content.article.18', 'Module Position', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(57, 35, 64, 65, 4, 'com_content.article.19', 'The Joomla Blog', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(58, 35, 66, 67, 4, 'com_content.article.20', 'The Joomla overview', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(59, 35, 68, 69, 4, 'com_content.article.21', 'The Joomla Help', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(60, 1, 163, 164, 1, 'com_tags', 'com_tags', '{}'),
(61, 1, 165, 166, 1, 'com_contenthistory', 'com_contenthistory', '{}'),
(62, 1, 167, 168, 1, 'com_ajax', 'com_ajax', '{}'),
(63, 1, 169, 170, 1, 'com_postinstall', 'com_postinstall', '{}'),
(64, 18, 92, 93, 2, 'com_modules.module.115', 'JBanners', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(65, 18, 94, 95, 2, 'com_modules.module.116', 'Featured Businesses', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(66, 18, 96, 97, 2, 'com_modules.module.117', 'JBusinessDirectory - Progress', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(67, 18, 98, 99, 2, 'com_modules.module.118', 'JBusinessCategories', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(68, 18, 100, 101, 2, 'com_modules.module.119', 'JBusinessCategoriesOffers', ''),
(69, 18, 102, 103, 2, 'com_modules.module.120', 'JBusinessDirectory', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(70, 18, 104, 105, 2, 'com_modules.module.121', 'JBusinessOffer', ''),
(71, 18, 106, 107, 2, 'com_modules.module.122', 'JQueryLogin', ''),
(72, 18, 108, 109, 2, 'com_modules.module.123', 'JUserLogin', ''),
(74, 18, 110, 111, 2, 'com_modules.module.100', 'Front Page Feature', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(75, 3, 6, 7, 2, 'com_banners.category.12', 'Main Banners', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(76, 18, 112, 113, 2, 'com_modules.module.111', 'User1', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(77, 18, 114, 115, 2, 'com_modules.module.113', 'User3', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(78, 18, 116, 117, 2, 'com_modules.module.114', 'User2', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(79, 27, 21, 22, 3, 'com_content.article.22', 'Front page', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(80, 18, 118, 119, 2, 'com_modules.module.105', 'About Us', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(81, 18, 120, 121, 2, 'com_modules.module.124', 'Login', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(82, 18, 122, 123, 2, 'com_modules.module.103', 'Directory Features', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(83, 18, 124, 125, 2, 'com_modules.module.125', 'Popular features', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(84, 18, 126, 127, 2, 'com_modules.module.126', 'JBusinessDirectory - site', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(85, 18, 128, 129, 2, 'com_modules.module.104', 'Gallery', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(86, 18, 130, 131, 2, 'com_modules.module.127', 'JBusinessCategories (2)', ''),
(87, 18, 132, 133, 2, 'com_modules.module.128', 'JBusinessDirectory', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(91, 18, 134, 135, 2, 'com_modules.module.129', 'JBusinessDirectory - Offers', ''),
(92, 1, 171, 172, 1, 'com_jbusinessdirectory', 'jbusinessdirectory', '{}');

-- --------------------------------------------------------

--
-- Table structure for table `#__associations`
--

CREATE TABLE IF NOT EXISTS `#__associations` (
  `id` int(11) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__banners`
--

CREATE TABLE IF NOT EXISTS `#__banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `#__banners`
--

INSERT INTO `#__banners` (`id`, `cid`, `type`, `name`, `alias`, `imptotal`, `impmade`, `clicks`, `clickurl`, `state`, `catid`, `description`, `custombannercode`, `sticky`, `ordering`, `metakey`, `params`, `own_prefix`, `metakey_prefix`, `purchase_type`, `track_clicks`, `track_impressions`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `reset`, `created`, `language`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `version`) VALUES
(1, 0, 0, 'Banner 1', 'banner-1', 0, 633, 0, '', 1, 12, '', '', 0, 1, '', '{"imageurl":"images\\/banners\\/slide1.jpg","width":"","height":"","alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-02-07 12:34:07', '*', 0, '', '2014-02-07 13:50:23', 131, 3),
(2, 0, 0, 'Banner 2', 'banner-2', 0, 633, 0, '', 1, 12, '', '', 0, 2, '', '{"imageurl":"images\\/banners\\/slide2.jpg","width":"","height":"","alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-02-07 13:48:20', '*', 0, '', '2014-02-07 13:48:45', 131, 3),
(3, 0, 0, 'Banner 3', 'banner-3', 0, 633, 0, '', 1, 12, '', '', 0, 3, '', '{"imageurl":"images\\/banners\\/slide3.jpg","width":"","height":"","alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-02-07 13:48:48', '*', 0, '', '2014-02-07 13:49:00', 131, 2);

-- --------------------------------------------------------

--
-- Table structure for table `#__banner_clients`
--

CREATE TABLE IF NOT EXISTS `#__banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__banner_tracks`
--

CREATE TABLE IF NOT EXISTS `#__banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__categories`
--

CREATE TABLE IF NOT EXISTS `#__categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `#__categories`
--

INSERT INTO `#__categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`, `version`) VALUES
(1, 0, 0, 0, 23, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 131, '2009-10-18 16:07:09', 0, '0000-00-00 00:00:00', 0, '*', 1),
(2, 27, 1, 1, 2, 1, 'uncategorised', 'com_content', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 131, '2010-06-28 13:26:37', 0, '0000-00-00 00:00:00', 0, '*', 1),
(3, 28, 1, 3, 4, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 131, '2010-06-28 13:27:35', 0, '0000-00-00 00:00:00', 0, '*', 1),
(4, 29, 1, 5, 6, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 131, '2010-06-28 13:27:57', 0, '0000-00-00 00:00:00', 0, '*', 1),
(5, 30, 1, 7, 8, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 131, '2010-06-28 13:28:15', 0, '0000-00-00 00:00:00', 0, '*', 1),
(6, 31, 1, 9, 10, 1, 'uncategorised', 'com_weblinks', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 131, '2010-06-28 13:28:33', 0, '0000-00-00 00:00:00', 0, '*', 1),
(7, 32, 1, 11, 12, 1, 'uncategorised', 'com_users', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 131, '2010-06-28 13:28:33', 0, '0000-00-00 00:00:00', 0, '*', 1),
(8, 35, 9, 18, 19, 2, 'sample-data-article/joomla', 'com_content', 'Joomla', 'joomla', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 131, '2013-01-31 07:26:07', 439, '2013-01-31 08:00:22', 18, '*', 1),
(9, 37, 1, 13, 20, 1, 'sample-data-article', 'com_content', 'Sample Data Article', 'sample-data-article', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 131, '2013-01-31 07:51:48', 0, '0000-00-00 00:00:00', 0, '*', 1),
(10, 38, 9, 14, 17, 2, 'sample-data-article/demo', 'com_content', 'Demo', 'demo', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 131, '2013-01-31 07:52:06', 0, '0000-00-00 00:00:00', 0, '*', 1),
(11, 40, 10, 15, 16, 3, 'sample-data-article/demo/short-code', 'com_content', 'Shortcode', 'short-code', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 131, '2013-01-31 08:00:08', 0, '0000-00-00 00:00:00', 0, '*', 1),
(12, 75, 1, 21, 22, 1, 'main-banners', 'com_banners', 'Main Banners', 'main-banners', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 131, '2014-02-07 12:32:28', 0, '0000-00-00 00:00:00', 0, '*', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__contact_details`
--

CREATE TABLE IF NOT EXISTS `#__contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__contact_details`
--

INSERT INTO `#__contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`, `sortname1`, `sortname2`, `sortname3`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`, `version`, `hits`) VALUES
(1, 'Contact Name', 'name', 'Position', 'Street Address', 'Suburb', 'State', 'Country', 'Zip Code', 'Telephone', 'Fax', '<p>Information about or by the contact.</p>', '', 'email@email.com', 0, 1, 131, '2014-02-11 10:22:32', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"tabs","show_tags":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"Facebook","linka":"http:\\/\\/www.facebook.com\\/joomla","linkb_name":"Twitter","linkb":"http:\\/\\/twitter.com\\/joomla","linkc_name":"","linkc":false,"linkd_name":"","linkd":false,"linke_name":"","linke":"","contact_layout":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 4, 1, '', '', 'last', 'first', 'middle', '*', '2013-01-31 07:52:56', 131, '', '2014-02-11 10:22:32', 131, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `#__content`
--

CREATE TABLE IF NOT EXISTS `#__content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `#__content`
--

INSERT INTO `#__content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(1, 36, 'The Joomla! Community', 'the-joomla-community', '<p>Joomla! means All Together, and it is a community of people all working and having fun together that makes Joomla! possible. Thousands of people each year participate in the Joomla! community, and we hope you will be one of them.</p>\r\n<p>People with all kinds of skills, of all skill levels and from around the world are welcome to join in. Participate in the <a href="http://joomla.org">Joomla.org</a> family of websites (the<a href="http://forum.joomla.org"> forum </a>is a great place to start). Come to a <a href="http://community.joomla.org/events.html">Joomla! event</a>. Join or start a <a href="http://community.joomla.org/user-groups.html">Joomla! Users Group</a>. Whether you are a developer, site administrator, designer, end user or fan, there are ways for you to participate and contribute.</p>', '', 1, 8, '2013-01-31 07:27:02', 131, '', '2013-01-31 09:03:15', 439, 0, '0000-00-00 00:00:00', '2013-01-31 07:27:02', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 3, '', '', 1, 156, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(2, 39, 'Module Variations', 'module-variations', '<p>Welcome to Shaper <strong>Helix</strong> template. This is the blank template for joomla based on Helix Framewok. You are seeing main content area of this template.</p>', '', 1, 10, '2013-01-31 07:53:08', 131, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2013-01-31 07:53:08', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 5, '', '', 1, 158, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(3, 41, 'Accordion', 'sc-accordion', '<p>[accordion id="sc-accordion"] [accordion_item title=''Item 1'']Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/accordion_item] [accordion_item title=''Item 2'']consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/accordion_item] [accordion_item title=''Item 3''] Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/accordion_item] [/accordion]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[accordion] <br />    [accordion_item title=''ITEM_TITLE'']ADD_CONTENT_HERE[/accordion_item]<br />    [accordion_item title=''ITEM_TITLE'']ADD_CONTENT_HERE[/accordion_item] <br />    [accordion_item title=''ITEM_TITLE'']ADD_CONTENT_HERE[/accordion_item]<br />[/accordion]]</pre>', '', 1, 11, '2013-01-31 08:07:29', 131, '', '2013-02-04 09:56:46', 439, 0, '0000-00-00 00:00:00', '2013-01-31 08:07:29', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 11, 9, '', '', 1, 47, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(4, 42, 'Carousel', 'sc-carousel', '<p>[carousel][carousel_item]<img src="images/helix/carousel1.png" alt="" width="1500" height="550" style="border: 0;" /> [caption] Powerful templates framework to develop Joomla base website faster! [/caption] [/carousel_item] [carousel_item] <img src="images/helix/carousel2.png" alt="" width="1500" height="550" style="border: 0;" /> [caption] Powerful templates framework to develop Joomla base website faster! [/caption] [/carousel_item] [carousel_item] <img src="images/helix/carousel3.png" alt="" width="1500" height="550" style="border: 0;" />[caption] Powerful templates framework to develop Joomla base website faster! [/caption] [/carousel_item] [/carousel]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[carousel]\r\n[carousel_item]add image here [caption]Powerful templates framework to develop Joomla base website faster![/caption][/carousel_item]\r\n[/carousel]]</pre>', '', 1, 11, '2013-01-31 08:39:47', 131, '', '2013-08-20 07:01:05', 508, 0, '0000-00-00 00:00:00', '2013-01-31 08:39:47', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 25, 8, '', '', 1, 76, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(5, 43, 'Tab', 'tab', '<p>[row]</p>\r\n<p>[col class="span6"]</p>\r\n<p>[tab id="tab1" class="tabbale" button="nav-tabs"] [tab_item title="Tab1"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/tab_item] [tab_item title="Tab2"]consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/tab_item] [tab_item title="Tab3"]consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/tab_item][/tab]</p>\r\n<p>[/col]</p>\r\n<p>[col class="span6"]</p>\r\n<p>[tab id="tab2" class="tabbale" button="nav-pills"] [tab_item title="Tab1"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/tab_item] [tab_item title="Tab2"]consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/tab_item] [tab_item title="Tab3"]consectetur adipiscing elit. Proin ornare consectetur sodales. Nulla luctus cursus mauris at dapibus. Cras ac felis et neque consequat elementum a eget turpis. Aliquam erat volutpat. Integer feugiat sem eu ligula vulputate consequat. Nulla facilisi. Cras vel elit lectus, at fringilla lorem.[/tab_item][/tab]</p>\r\n<p>[/col]</p>\r\n<p>[/row]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[tab] \r\n[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item ]\r\n[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item ] \r\n[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item ]\r\n[/tab]]\r\n</pre>', '', 1, 11, '2013-01-31 08:51:31', 131, '', '2013-02-04 07:14:50', 439, 0, '0000-00-00 00:00:00', '2013-01-31 08:51:31', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 9, 7, '', '', 1, 52, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(6, 44, 'Map', 'sc-map', '<p>[spmap lat="45.743193" lng="10.388281" zoom="8" maptype="ROADMAP"]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[spmap lat="LATITUDE" lng="LONGITUDE" zoom="VALUE 1 to 10"]]</pre>', '', 1, 11, '2013-01-31 09:06:35', 131, '', '2014-02-12 14:31:20', 131, 0, '0000-00-00 00:00:00', '2013-01-31 09:06:35', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 18, 6, '', '', 1, 37, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(7, 45, 'Testimonial ', 'testimonial', '<p>[testimonial name="John Doe" email="jakirhasaneng@gmail.com" company="joomshaper" designation="Developer"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum venenatis, felis a semper mollis, mauris mi suscipit dui, non laoreet diam enim et turpis. Sed imperdiet ultrices felis, at ultricies tellus consequat a. Proin condimentum porttitor eros, vitae facilisis sapien rhoncus vitae. Aliquam dapibus elit non metus posuere blandit. Phasellus a aliquam urna. Aliquam ac massa tellus, a semper odio. In hac habitasse platea dictumst. Integer tincidunt, nisi quis congue consectetur, lacus augue scelerisque enim, eu vehicula neque tortor ac risus. Nunc mollis interdum iaculis. [/testimonial]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[testimonial name="AUTHOR_NAME" email="AUTHOR_EMAIL" company="AUTHOR_COMPANY" designation="AUTHOR_DESIGNATION"]ADD_CONTENT_HERE[/testimonial]]</pre>', '', 1, 11, '2013-01-31 09:09:00', 131, '', '2013-01-31 09:49:51', 439, 0, '0000-00-00 00:00:00', '2013-01-31 09:09:00', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 8, 5, '', '', 1, 28, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(8, 46, 'Alert', 'sc-alert', '<p>[alert type="alert"]</p>\r\n<h4>Warning!</h4>\r\n<p>Best check yo self, you''re not looking too good. Nulla vitae elit libero, a pharetra augue. [/alert] [alert type="error" style="width:85%"]</p>\r\n<h4>Error or danger!</h4>\r\n<p>Oh snap! Change a few things up and try submitting again. [/alert] [alert type="success" style="width:75%"]</p>\r\n<h4>success!</h4>\r\n<p>Well done! You successfully read this important alert message. [/alert] [alert type="info" style="width:65%"]</p>\r\n<h4>Information!</h4>\r\n<p>Heads up! This alert needs your attention, but it''s not super important. [/alert]</p>', '', 1, 11, '2013-01-31 09:13:46', 131, '', '2013-02-04 07:16:31', 439, 0, '0000-00-00 00:00:00', '2013-01-31 09:13:46', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 4, '', '', 1, 26, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(9, 47, 'Button', 'sc-button', '<p>[row] [col class="span6"] [button type="default" size="" link="#"]Default[/button]</p>\r\n<p>[button type="primary" size="" link="#"]Primary[/button]</p>\r\n<p>[button type="info" size="" link="#"]Info[/button]</p>\r\n<p>[button type="success" size="" link="#"]Success[/button]</p>\r\n<p>[button type="warning" size="" link="#"]Warning[/button]</p>\r\n<p>[button type="danger" size="" link="#"]danger[/button]</p>\r\n<p>[button type="inverse" size="" link="#"]Inverse[/button]</p>\r\n<p>[button type="block btn-primary" size="large" link="#"]Block level button[/button] [/col] [col class="span6"] [button type="default" size="large" link="#"]Large button[/button]</p>\r\n<p>[button type="primary" size="large" link="#"]Large button[/button]</p>\r\n<p>[button type="default" size="" link="#"]Default button[/button]</p>\r\n<p>[button type="primary" size="" link="#"]Default button[/button]</p>\r\n<p>[button type="default" size="small" link="#"]Small button[/button]</p>\r\n<p>[button type="primary" size="small" link="#"]Small button[/button]</p>\r\n<p>[button type="default" size="mini" link="#"]Mini button[/button]</p>\r\n<p>[button type="primary" size="mini" link="#"]Mini button[/button] [/col] [/row]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[button type="BUTTON_TYPE"]...[/button]]\r\n</pre>', '', 1, 11, '2013-01-31 09:16:06', 131, '', '2013-01-31 09:25:55', 439, 0, '0000-00-00 00:00:00', '2013-01-31 09:16:06', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 3, '', '', 1, 33, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(10, 48, 'Icon', 'sc-icon', '<p>[fontawesome_icons /]</p>', '', 1, 11, '2013-01-31 09:26:14', 131, '', '2013-11-14 09:10:48', 508, 0, '0000-00-00 00:00:00', '2013-01-31 09:26:14', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 10, 2, '', '', 1, 34, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(11, 49, 'Column', 'sc-column', '<p>[row class="show-grid"] [col class="span4 ccc"] Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id.[/col] [col class="span4"] Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id.[/col] [col class="span4"] Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id.[/col] [/row]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[row id="ROW_ID" class="ROW_CLASS"]\r\n[col class="span4"]ADD_CONTENT_HERE[/col]\r\n[col class="span4"]ADD_CONTENT_HERE[/col]\r\n[col class="span4"]ADD_CONTENT_HERE[/col]\r\n[/row]]\r\n</pre>\r\n<p>[row class="show-grid"] [col class="span8"] Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id. Nullam id dolor id nibh ultricies vehicula ut id. Donec id elit non mi porta gravida at eget metus.[/col] [col class="span4"] Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id.[/col] [/row]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[row id="ROW_ID" class="ROW_CLASS"]\r\n[col class="span8"]ADD_CONTENT_HERE[/col]\r\n[col class="span4"]ADD_CONTENT_HERE[/col]\r\n[/row]]\r\n</pre>', '', 1, 11, '2013-01-31 09:32:26', 131, '', '2013-08-22 10:11:07', 508, 0, '0000-00-00 00:00:00', '2013-01-31 09:32:26', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 11, 1, '', '', 1, 36, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(12, 50, 'Powerfull Features', 'powerfull-features', '<p>[row]</p>\r\n<p>[col class="span6"]</p>\r\n<h4>Joomla 2.5 and 3.0</h4>\r\n<p>J-BusinessDirectory is available for Joomla 2.5 and Joomla 3.0. You can choose whatever is best for you.</p>\r\n<p> </p>\r\n<h4>HTML5 &amp; CSS3</h4>\r\n<p>HTML5 based semantic markup enhanced with CSS3 animation and effects to ensure high performance and professional look.</p>\r\n<p> </p>\r\n<h4>Bootstrap</h4>\r\n<p>Take advantage of incorporated <a href="http://getbootstrap.com">Twitter Bootstrap</a> that will help you develop your websites easier and faster.</p>\r\n<p>[/col]</p>\r\n<p>[col class="span6"]</p>\r\n<h4>CSS3</h4>\r\n<p>The latest CSS3 technology has been used to make the whole web development process easier and faster with lot of scopes.  </p>\r\n<p> </p>\r\n<h4>Presets</h4>\r\n<p>Presets give the flexibility to change the design of your website without coding by selecting the desire color of your website background, header and footer etc.</p>\r\n<p> </p>\r\n<h4>Cross-Browser Support</h4>\r\n<p>The themes work great with all modern browsers like Firefox, Chrome, Safari, Opera and Internet Explorer 9+.</p>\r\n<p>[/col]</p>\r\n<p>[/row]</p>', '', 1, 10, '2013-01-31 09:34:38', 131, '', '2014-02-11 14:08:58', 131, 0, '0000-00-00 00:00:00', '2013-01-31 09:34:38', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 63, 4, '', '', 1, 876, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(13, 51, 'Article', 'article', '<ul>\r\n<li>This is a sample <strong>unordered list</strong></li>\r\n</ul>\r\n<ul class="arrow">\r\n<li>ul with class <strong>arrow</strong></li>\r\n</ul>\r\n<ul class="arrow-2">\r\n<li>ul with class <strong>arrow-2</strong></li>\r\n</ul>\r\n<ul class="star">\r\n<li>ul with class <strong>star</strong></li>\r\n</ul>\r\n<ul class="rss">\r\n<li>ul with class <strong>rss</strong></li>\r\n</ul>', '', 1, 10, '2013-01-31 11:56:10', 131, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2013-01-31 11:56:10', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 3, '', '', 1, 7, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(14, 52, 'Typography', 'typgraphy', '<p>[row]</p>\r\n<p>[col class="span6"]</p>\r\n<h1>h1. Heading 1</h1>\r\n<h2>h2. Heading 2</h2>\r\n<h3>h3. Heading 3</h3>\r\n<h4>h4. Heading 4</h4>\r\n<h5>h5. Heading 5</h5>\r\n<h6>h6. Heading 6</h6>\r\n<p>[/col]</p>\r\n<p>[col class="span6"]</p>\r\n<h3>Dropcap</h3>\r\n<p>[dropcap]This is a Magazine Style Drop Cap. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.[/dropcap]</p>\r\n<pre>[[dropcap]Dropcap Texts[/dropcap]]</pre>\r\n<p>[/col]</p>\r\n<p>[/row]</p>\r\n<p>[row]</p>\r\n<h3>Lists example</h3>\r\n<p>[col class="span6"]</p>\r\n<ul>\r\n<li>This is a sample <strong>unordered list</strong></li>\r\n</ul>\r\n<ul class="arrow">\r\n<li>ul with class <strong>arrow</strong></li>\r\n</ul>\r\n<ul class="arrow-double">\r\n<li>ul with class <strong>arrow-double</strong></li>\r\n</ul>\r\n<ul class="tick">\r\n<li>ul with class <strong>tick</strong></li>\r\n</ul>\r\n<ul class="cross">\r\n<li>ul with class <strong>cross</strong></li>\r\n</ul>\r\n<ul class="star">\r\n<li>ul with class <strong>star</strong></li>\r\n</ul>\r\n<ul class="rss">\r\n<li>ul with class <strong>rss</strong></li>\r\n</ul>\r\n<p>[/col]</p>\r\n<p>[col class="span6"]</p>\r\n<ol>\r\n<li>This is a sample <strong>ordered list</strong></li>\r\n</ol>\r\n<ul class="arrow">\r\n<li>ul with class <strong>arrow</strong></li>\r\n</ul>\r\n<ul class="arrow-double">\r\n<li>ul with class <strong>arrow-double</strong></li>\r\n</ul>\r\n<ul class="tick">\r\n<li>ul with class <strong>tick</strong></li>\r\n</ul>\r\n<ul class="cross">\r\n<li>ul with class <strong>cross</strong></li>\r\n</ul>\r\n<ul class="star">\r\n<li>ul with class <strong>star</strong></li>\r\n</ul>\r\n<ul class="rss">\r\n<li>ul with class <strong>rss</strong></li>\r\n</ul>\r\n<p>[/col]</p>\r\n<p>[/row]</p>\r\n<h3>Block Number</h3>\r\n<p>[row][col class="span4"] [blocknumber type="circle" text="01" color="#FFF" background="#34bcf5"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<p>[blocknumber type="circle" text="02" color="#FFF" background="#aacb24"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<p>[blocknumber type="circle" text="03" color="#FFF" background="#f16a10"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<pre>[[blocknumber type="circle" text="01" color="#FFF" background="#f16a10"]Circle Block Number[/blocknumber]]</pre>\r\n<p>[/col]</p>\r\n<p>[col class="span4"] [blocknumber type="rounded" text="01" color="#FFF" background="#7d2828"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<p>[blocknumber type="rounded" text="02" color="#FFF" background="#d80000"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<p>[blocknumber type="rounded" text="03" color="#FFF" background="#329491"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<pre>[[blocknumber type="rounded" text="01" color="#FFF" background="#329491"]Rounded Block Number[/blocknumber]]</pre>\r\n<p>[/col]</p>\r\n<p>[col class="span4"] [blocknumber text="01" color="#FFF" background="#999"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<p>[blocknumber text="02" color="#FFF" background="#666"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<p>[blocknumber text="03" color="#FFF" background="#000"]Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.[/blocknumber]</p>\r\n<pre>[[blocknumber text="01" color="#FFF" background="#999"]Normal Block Number[/blocknumber]]</pre>\r\n<p>[/col]<span style="line-height: 1.3em;">[/row]</span></p>\r\n<h3>Block Examples </h3>\r\n<p>[row][col class="span4"]</p>\r\n<p>[block color="#FFF" background="#34bcf5"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<p>[block color="#FFF" background="#aacb24"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<p>[block color="#FFF" background="#f16a10"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<pre>[[block color="#FFF" background="#f16a10"]Content[/block]]</pre>\r\n<p>[/col]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[block type="rounded" color="#FFF" background="#7d2828"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<p>[block type="rounded" color="#FFF" background="#329491"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<p>[block type="rounded" color="#FFF" background="#000000"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<pre>[[block type="rounded" color="#FFF" background="#000000"]Lorem ipsum dolor[/block]]</pre>\r\n<p>[/col]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[block border="1px dashed #CCC" padding="14px 15px"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<p>[block border="3px solid #34bcf5" padding="12px 15px"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<p>[block type="rounded" border="5px solid #aacb24" padding="10px 15px"]Lorem ipsum dolor sit amet, sic genero nomine Piscatore mihi. Dicis Deducitur potest flens praemio quod non dum veniens indica enim.[/block]</p>\r\n<pre>[[block border="5px solid #aacb24" padding="10px 15px"]Lorem ipsum dolor[/block]]</pre>\r\n<p>[/col]</p>\r\n<p>[/row]</p>\r\n<h3>Bubble Examples</h3>\r\n<p>[row][col class="span4"]</p>\r\n<p><span style="line-height: 1.3em;">[bubble author="Betty D. Steward"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula orci, ullamcorper vitae sodales venenatis, feugiat et felis. Donec non dui velit, a posuere dui.[/bubble]</span></p>\r\n<p><span style="line-height: 1.3em;">[/col][col class="span4"]</span></p>\r\n<p><span style="line-height: 1.3em;">[bubble color="#FFF" background="#736357" author="Barbara J. Pennebaker"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula orci, ullamcorper vitae sodales venenatis, feugiat et felis. Donec non dui velit, a posuere dui.[/bubble]</span></p>\r\n<p><span style="line-height: 1.3em;">[/col]</span><span style="line-height: 1.3em;">[col class="span4"]</span></p>\r\n<p><span style="line-height: 1.3em;">[bubble background="transparent" border="3px solid #ccc" author="Chad M. Simmons"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula orci, ullamcorper vitae sodales venenatis, feugiat et felis. Donec non dui.[/bubble]</span></p>\r\n<p><span>[/col]</span></p>\r\n<p><span style="line-height: 1.3em;">[/row]</span></p>\r\n<p><span style="line-height: 1.3em;">[row][col class="span12"]</span></p>\r\n<p> </p>\r\n<pre>[[bubble background="#FFF" color="#666" border="3px solid #ccc" author="Chad M. Simmons"]Lorem ipsum dolor sit amet.[/bubble]]</pre>\r\n<p><span style="line-height: 1.3em;">[/col]</span><span style="line-height: 1.3em;">[/row]</span></p>', '', 1, 10, '2013-01-31 11:57:09', 131, '', '2013-02-14 12:09:48', 721, 0, '0000-00-00 00:00:00', '2013-01-31 11:57:09', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 37, 2, '', '', 1, 312, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(16, 54, 'Gallery', 'gallery', '<p>[gallery columns="4" filter="yes"]</p>\r\n<p>[gallery_item tag="joomla" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="wordpress" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="joomla, wordpress" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="magento" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="opencart" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="magento, opencart" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="joomla, magento, wordpress, opencart" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[gallery_item tag="drupal" src="images/helix/gallery/300x200.png" /]</p>\r\n<p>[/gallery]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[gallery columns="4" filter="yes"]\r\n[gallery_item tag="joomla" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="wordpress" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="joomla, wordpress" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="magento" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="opencart" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="magento, opencart" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="joomla, magento, wordpress, opencart" src="images/helix/gallery/300x200.png"/]\r\n[gallery_item tag="drupal" src="images/helix/gallery/300x200.png"/]\r\n[/gallery]]\r\n</pre>', '', 1, 11, '2013-02-04 06:47:55', 131, '', '2013-02-04 07:41:41', 439, 0, '0000-00-00 00:00:00', '2013-02-04 06:47:55', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 29, 0, '', '', 1, 100, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(17, 55, 'Video', 'video', '<p>[row]</p>\r\n<p>[col class="span6"]</p>\r\n<p>[spvideo]https://www.youtube.com/watch?v=vb2eObvmvdI[/spvideo]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[spvideo]http://www.youtube.com/watch?v=vb2eObvmvdI[/spvideo]]</pre>\r\n<p>[/col]</p>\r\n<p>[col class="span6"]</p>\r\n<p>[spvideo]http://vimeo.com/3701346[/spvideo]</p>\r\n<h3>Get the code</h3>\r\n<pre>[[spvideo]http://vimeo.com/3701346[/spvideo]]</pre>\r\n<p>[/col]</p>\r\n<p>[/row]</p>', '', 1, 10, '2013-02-04 06:56:51', 131, '', '2013-06-20 11:44:02', 508, 0, '0000-00-00 00:00:00', '2013-02-04 06:56:51', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 34, 1, '', '', 1, 103, '{"robots":"","author":"","rights":"","xreference":"","tags":null}', 0, '*', ''),
(18, 56, 'Module Position', 'module-position', '<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>Header</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>logo</td>\r\n<td>menu</td>\r\n<td>search</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>feature</h4>\r\n</th></tr>\r\n</thead>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>directory</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>directory1</td>\r\n<td>directory2</td>\r\n<td>directory3</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>Main Body</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>left</td>\r\n<td>component</td>\r\n<td>right</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>business</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>directory4</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>Users</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>user1</td>\r\n<td>user2</td>\r\n<td>user3</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>breadcrumb</h4>\r\n</th></tr>\r\n</thead>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>Bottom</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>bottom1</td>\r\n<td>bottom2</td>\r\n<td>bottom3</td>\r\n<td>bottom4</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="table table-bordered table-striped center">\r\n<thead>\r\n<tr><th colspan="6">\r\n<h4>Footer</h4>\r\n</th></tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>footer1</td>\r\n<td>footer2</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>', '', 1, 10, '2013-02-04 07:49:29', 131, '', '2014-02-11 09:34:02', 131, 0, '0000-00-00 00:00:00', '2013-02-04 07:49:29', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 26, 0, '', '', 1, 70, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(19, 57, 'The Joomla Blog', 'the-joomla-blog', '<p>Joomla! means All Together, and it is a community of people all working and having fun together that makes Joomla! possible. Thousands of people each year participate in the Joomla! community, and we hope you will be one of them.</p>\r\n<p>People with all kinds of skills, of all skill levels and from around the world are welcome to join in. Participate in the <a href="http://joomla.org">Joomla.org</a> family of websites (the<a href="http://forum.joomla.org"> forum </a>is a great place to start). Come to a <a href="http://community.joomla.org/events.html">Joomla! event</a>. Join or start a <a href="http://community.joomla.org/user-groups.html">Joomla! Users Group</a>. Whether you are a developer, site administrator, designer, end user or fan, there are ways for you to participate and contribute.</p>', '', 1, 8, '2013-01-31 07:27:02', 131, '', '2013-02-04 09:19:32', 439, 0, '0000-00-00 00:00:00', '2013-01-31 07:27:02', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 2, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(20, 58, 'The Joomla overview', 'the-joomla-overview', '<p>Joomla! means All Together, and it is a community of people all working and having fun together that makes Joomla! possible. Thousands of people each year participate in the Joomla! community, and we hope you will be one of them.</p>\r\n<p>People with all kinds of skills, of all skill levels and from around the world are welcome to join in. Participate in the <a href="http://joomla.org">Joomla.org</a> family of websites (the<a href="http://forum.joomla.org"> forum </a>is a great place to start). Come to a <a href="http://community.joomla.org/events.html">Joomla! event</a>. Join or start a <a href="http://community.joomla.org/user-groups.html">Joomla! Users Group</a>. Whether you are a developer, site administrator, designer, end user or fan, there are ways for you to participate and contribute.</p>', '', 1, 8, '2013-01-31 07:27:02', 131, '', '2013-02-04 09:20:04', 439, 0, '0000-00-00 00:00:00', '2013-01-31 07:27:02', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 1, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(21, 59, 'The Joomla Help', 'the-joomla-help', '<p>Joomla! means All Together, and it is a community of people all working and having fun together that makes Joomla! possible. Thousands of people each year participate in the Joomla! community, and we hope you will be one of them.</p>\r\n<p>People with all kinds of skills, of all skill levels and from around the world are welcome to join in. Participate in the <a href="http://joomla.org">Joomla.org</a> family of websites (the<a href="http://forum.joomla.org"> forum </a>is a great place to start). Come to a <a href="http://community.joomla.org/events.html">Joomla! event</a>. Join or start a <a href="http://community.joomla.org/user-groups.html">Joomla! Users Group</a>. Whether you are a developer, site administrator, designer, end user or fan, there are ways for you to participate and contribute.</p>', '', 1, 8, '2013-01-31 07:27:02', 131, '', '2013-02-04 09:20:24', 439, 0, '0000-00-00 00:00:00', '2013-01-31 07:27:02', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');
INSERT INTO `#__content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(22, 79, 'Front page', 'front-page', '<h3 style="text-align: center;">Our directory help your business to grow.</h3>\r\n<p> </p>\r\n<p>[row]</p>\r\n<p>[col class="span1"]</p>\r\n<p>[/col]</p>\r\n<p>[col class="span4 center"]</p>\r\n<h4>Add your buisness</h4>\r\n<p>Many of directory features are free. Add your business details in order to get the right exposure.</p>\r\n<p> </p>\r\n<p>[button type="primary" size="large" link="index.php?option=com_jbusinessdirectory&amp;view=managecompanies"]Add your business[/button]</p>\r\n<p>[/col]</p>\r\n<p> </p>\r\n<p>[col class="span2"]</p>\r\n<p>[/col]</p>\r\n<p>[col class="span4 center"]</p>\r\n<h4>Manage your business</h4>\r\n<p>Access our administration panel and update your business details. Add your offers and events to attract more customers.</p>\r\n<p> </p>\r\n<p>[button type="primary" size="large" link="index.php?option=com_jbusinessdirectory&amp;view=useroptions"]Manage business[/button]</p>\r\n<p>[/col]</p>\r\n<p>[col class="span1"]</p>\r\n<p>[/col]</p>\r\n<p>[/row]</p>', '', 1, 2, '2014-02-07 21:11:05', 131, '', '2014-02-10 11:12:52', 131, 0, '0000-00-00 00:00:00', '2014-02-07 21:11:05', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"0","link_titles":"0","show_tags":"0","show_intro":"0","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 25, 0, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__contentitem_tag_map`
--

CREATE TABLE IF NOT EXISTS `#__contentitem_tag_map` (
  `type_alias` varchar(255) NOT NULL DEFAULT '',
  `core_content_id` int(10) unsigned NOT NULL COMMENT 'PK from the core content table',
  `content_item_id` int(11) NOT NULL COMMENT 'PK from the content type table',
  `tag_id` int(10) unsigned NOT NULL COMMENT 'PK from the tag table',
  `tag_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date of most recent save for this tag-item',
  `type_id` mediumint(8) NOT NULL COMMENT 'PK from the content_type table',
  UNIQUE KEY `uc_ItemnameTagid` (`type_id`,`content_item_id`,`tag_id`),
  KEY `idx_tag_type` (`tag_id`,`type_id`),
  KEY `idx_date_id` (`tag_date`,`tag_id`),
  KEY `idx_tag` (`tag_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_core_content_id` (`core_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maps items from content tables to tags';

-- --------------------------------------------------------

--
-- Table structure for table `#__content_frontpage`
--

CREATE TABLE IF NOT EXISTS `#__content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__content_frontpage`
--

INSERT INTO `#__content_frontpage` (`content_id`, `ordering`) VALUES
(15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__content_rating`
--

CREATE TABLE IF NOT EXISTS `#__content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__content_types`
--

CREATE TABLE IF NOT EXISTS `#__content_types` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_title` varchar(255) NOT NULL DEFAULT '',
  `type_alias` varchar(255) NOT NULL DEFAULT '',
  `table` varchar(255) NOT NULL DEFAULT '',
  `rules` text NOT NULL,
  `field_mappings` text NOT NULL,
  `router` varchar(255) NOT NULL DEFAULT '',
  `content_history_options` varchar(5120) NOT NULL COMMENT 'JSON string for com_contenthistory options',
  PRIMARY KEY (`type_id`),
  KEY `idx_alias` (`type_alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `#__content_types`
--

INSERT INTO `#__content_types` (`type_id`, `type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `router`, `content_history_options`) VALUES
(1, 'Article', 'com_content.article', '{"special":{"dbtable":"#__content","key":"id","type":"Content","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"state","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"introtext", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"attribs", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"asset_id"}, "special": {"fulltext":"fulltext"}}', 'ContentHelperRoute::getArticleRoute', '{"formFile":"administrator\\/components\\/com_content\\/models\\/forms\\/article.xml", "hideFields":["asset_id","checked_out","checked_out_time","version"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(2, 'Weblink', 'com_weblinks.weblink', '{"special":{"dbtable":"#__weblinks","key":"id","type":"Weblink","prefix":"WeblinksTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"state","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"url", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special": {}}', 'WeblinksHelperRoute::getWeblinkRoute', '{"formFile":"administrator\\/components\\/com_weblinks\\/models\\/forms\\/weblink.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","featured","images"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"], "convertToInt":["publish_up", "publish_down", "featured", "ordering"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(3, 'Contact', 'com_contact.contact', '{"special":{"dbtable":"#__contact_details","key":"id","type":"Contact","prefix":"ContactTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"address", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"image", "core_urls":"webpage", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special": {"con_position":"con_position","suburb":"suburb","state":"state","country":"country","postcode":"postcode","telephone":"telephone","fax":"fax","misc":"misc","email_to":"email_to","default_con":"default_con","user_id":"user_id","mobile":"mobile","sortname1":"sortname1","sortname2":"sortname2","sortname3":"sortname3"}}', 'ContactHelperRoute::getContactRoute', '{"formFile":"administrator\\/components\\/com_contact\\/models\\/forms\\/contact.xml","hideFields":["default_con","checked_out","checked_out_time","version","xreference"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"], "displayLookup":[ {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ] }'),
(4, 'Newsfeed', 'com_newsfeeds.newsfeed', '{"special":{"dbtable":"#__newsfeeds","key":"id","type":"Newsfeed","prefix":"NewsfeedsTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"link", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special": {"numarticles":"numarticles","cache_time":"cache_time","rtl":"rtl"}}', 'NewsfeedsHelperRoute::getNewsfeedRoute', '{"formFile":"administrator\\/components\\/com_newsfeeds\\/models\\/forms\\/newsfeed.xml","hideFields":["asset_id","checked_out","checked_out_time","version"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(5, 'User', 'com_users.user', '{"special":{"dbtable":"#__users","key":"id","type":"User","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"null","core_alias":"username","core_created_time":"registerdate","core_modified_time":"lastvisitDate","core_body":"null", "core_hits":"null","core_publish_up":"null","core_publish_down":"null","access":"null", "core_params":"params", "core_featured":"null", "core_metadata":"null", "core_language":"null", "core_images":"null", "core_urls":"null", "core_version":"null", "core_ordering":"null", "core_metakey":"null", "core_metadesc":"null", "core_catid":"null", "core_xreference":"null", "asset_id":"null"}, "special": {}}', 'UsersHelperRoute::getUserRoute', ''),
(6, 'Article Category', 'com_content.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'ContentHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(7, 'Contact Category', 'com_contact.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'ContactHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(8, 'Newsfeeds Category', 'com_newsfeeds.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'NewsfeedsHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(9, 'Weblinks Category', 'com_weblinks.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'WeblinksHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(10, 'Tag', 'com_tags.tag', '{"special":{"dbtable":"#__tags","key":"tag_id","type":"Tag","prefix":"TagsTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"null", "core_xreference":"null", "asset_id":"null"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path"}}', 'TagsHelperRoute::getTagRoute', '{"formFile":"administrator\\/components\\/com_tags\\/models\\/forms\\/tag.xml", "hideFields":["checked_out","checked_out_time","version", "lft", "rgt", "level", "path", "urls", "publish_up", "publish_down"],"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(11, 'Banner', 'com_banners.banner', '{"special":{"dbtable":"#__banners","key":"id","type":"Banner","prefix":"BannersTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"null","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"link", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"null", "asset_id":"null"}, "special":{"imptotal":"imptotal", "impmade":"impmade", "clicks":"clicks", "clickurl":"clickurl", "custombannercode":"custombannercode", "cid":"cid", "purchase_type":"purchase_type", "track_impressions":"track_impressions", "track_clicks":"track_clicks"}}', '', '{"formFile":"administrator\\/components\\/com_banners\\/models\\/forms\\/banner.xml", "hideFields":["checked_out","checked_out_time","version", "reset"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "imptotal", "impmade", "reset"], "convertToInt":["publish_up", "publish_down", "ordering"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"cid","targetTable":"#__banner_clients","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(12, 'Banners Category', 'com_banners.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', '', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(13, 'Banner Client', 'com_banners.client', '{"special":{"dbtable":"#__banner_clients","key":"id","type":"Client","prefix":"BannersTable"}}', '', '', '', '{"formFile":"administrator\\/components\\/com_banners\\/models\\/forms\\/client.xml", "hideFields":["checked_out","checked_out_time"], "ignoreChanges":["checked_out", "checked_out_time"], "convertToInt":[], "displayLookup":[]}'),
(14, 'User Notes', 'com_users.note', '{"special":{"dbtable":"#__user_notes","key":"id","type":"Note","prefix":"UsersTable"}}', '', '', '', '{"formFile":"administrator\\/components\\/com_users\\/models\\/forms\\/note.xml", "hideFields":["checked_out","checked_out_time", "publish_up", "publish_down"],"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(15, 'User Notes Category', 'com_users.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', '', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `#__core_log_searches`
--

CREATE TABLE IF NOT EXISTS `#__core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__extensions`
--

CREATE TABLE IF NOT EXISTS `#__extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10026 ;

--
-- Dumping data for table `#__extensions`
--

INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MAILTO_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_BANNERS_XML_DESCRIPTION","group":""}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"name":"com_checkin","type":"component","creationDate":"Unknown","author":"Joomla! Project","copyright":"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTACT_XML_DESCRIPTION","group":""}', '{"show_contact_category":"hide","show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","allow_vcard_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_category_crumb":"0","metakey":"","metadesc":"","robots":"","author":"","rights":"","xreference":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"name":"com_languages","type":"component","creationDate":"2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"en-GB","site":"en-GB"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MEDIA_XML_DESCRIPTION","group":""}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html","enable_flash":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_word_count":"0","show_headings":"1","show_name":"1","show_articles":"0","show_link":"1","show_description":"1","show_description_image":"1","display_num":"","show_pagination_limit":"1","show_pagination":"1","show_pagination_results":"1","show_cat_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 0, '{"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_SEARCH_XML_DESCRIPTION","group":""}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{"template_positions_display":"0","upload_limit":"2","image_formats":"gif,bmp,jpg,jpeg,png","source_formats":"txt,less,ini,xml,js,php,css","font_formats":"woff,ttf,otf","compressed_formats":"zip"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"show_comp_description":"1","comp_description":"","show_link_hits":"1","show_link_description":"1","show_other_cats":"0","show_headings":"0","show_numbers":"0","show_report":"1","count_clicks":"1","target":"0","link_icons":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTENT_XML_DESCRIPTION","group":""}', '{"article_layout":"_:default","show_title":"1","link_titles":"1","show_intro":"1","show_category":"1","link_category":"1","show_parent_category":"0","link_parent_category":"0","show_author":"1","link_author":"0","show_create_date":"1","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_readmore":"1","show_readmore_title":"1","readmore_limit":"100","show_icons":"1","show_print_icon":"1","show_email_icon":"1","show_hits":"0","show_noauth":"0","urls_position":"0","show_publishing_options":"1","show_article_options":"1","show_urls_images_frontend":"0","show_urls_images_backend":"1","targeta":0,"targetb":0,"targetc":0,"float_intro":"left","float_fulltext":"left","category_layout":"_:blog","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0","feed_show_readmore":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '{"filters":{"1":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"9":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"NONE","filter_tags":"","filter_attributes":""},"2":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"NONE","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_USERS_XML_DESCRIPTION","group":""}', '{"allowUserRegistration":"1","new_usertype":"2","useractivation":"1","frontend_userparams":"1","mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(27, 'com_finder', 'component', 'com_finder', '', 1, 1, 0, 0, '{"name":"com_finder","type":"component","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_FINDER_XML_DESCRIPTION","group":""}', '{"show_description":"1","description_length":255,"allow_empty_query":"0","show_url":"1","show_advanced":"1","expand_advanced":"0","show_date_filters":"0","highlight_terms":"1","opensearch_name":"","opensearch_description":"","batch_size":"50","memory_table_limit":30000,"title_multiplier":"1.7","text_multiplier":"0.7","meta_multiplier":"1.2","path_multiplier":"2.0","misc_multiplier":"0.3","stemmer":"snowball"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(28, 'com_joomlaupdate', 'component', 'com_joomlaupdate', '', 1, 1, 0, 1, '{"name":"com_joomlaupdate","type":"component","creationDate":"February 2012","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(29, 'com_tags', 'component', 'com_tags', '', 1, 1, 1, 1, '{"name":"com_tags","type":"component","creationDate":"December 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"COM_TAGS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(30, 'com_contenthistory', 'component', 'com_contenthistory', '', 1, 1, 1, 0, '{"name":"com_contenthistory","type":"component","creationDate":"May 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_CONTENTHISTORY_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(31, 'com_ajax', 'component', 'com_ajax', '', 1, 1, 1, 0, '{"name":"com_ajax","type":"component","creationDate":"August 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_AJAX_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(32, 'com_postinstall', 'component', 'com_postinstall', '', 1, 1, 1, 1, '{"name":"com_postinstall","type":"component","creationDate":"September 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_POSTINSTALL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(100, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '{"name":"PHPMailer","type":"library","creationDate":"2001","author":"PHPMailer","copyright":"(c) 2001-2003, Brent R. Matzelle, (c) 2004-2009, Andy Prevost. All Rights Reserved., (c) 2010-2013, Jim Jagielski. All Rights Reserved.","authorEmail":"jimjag@gmail.com","authorUrl":"https:\\/\\/github.com\\/PHPMailer\\/PHPMailer","version":"5.2.6","description":"LIB_PHPMAILER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(101, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '{"name":"SimplePie","type":"library","creationDate":"2004","author":"SimplePie","copyright":"Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon","authorEmail":"","authorUrl":"http:\\/\\/simplepie.org\\/","version":"1.2","description":"LIB_SIMPLEPIE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(102, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"name":"phputf8","type":"library","creationDate":"2006","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"hfuecks@gmail.com","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"0.5","description":"LIB_PHPUTF8_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 'Joomla! Platform', 'library', 'joomla', '', 0, 1, 1, 1, '{"name":"Joomla! Platform","type":"library","creationDate":"2008","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"13.1","description":"LIB_JOOMLA_XML_DESCRIPTION","group":""}', '{"mediaversion":"c0db0d2afb992b8ee256618240003591"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(104, 'IDNA Convert', 'library', 'idna_convert', '', 0, 1, 1, 1, '{"name":"IDNA Convert","type":"library","creationDate":"2004","author":"phlyLabs","copyright":"2004-2011 phlyLabs Berlin, http:\\/\\/phlylabs.de","authorEmail":"phlymail@phlylabs.de","authorUrl":"http:\\/\\/phlylabs.de","version":"0.8.0","description":"LIB_IDNA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(105, 'FOF', 'library', 'fof', '', 0, 1, 1, 1, '{"name":"FOF","type":"library","creationDate":"2014-03-09 12:54:48","author":"Nicholas K. Dionysopoulos \\/ Akeeba Ltd","copyright":"(C)2011-2014 Nicholas K. Dionysopoulos","authorEmail":"nicholas@akeebabackup.com","authorUrl":"https:\\/\\/www.akeebabackup.com","version":"2.2.1","description":"LIB_FOF_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(106, 'PHPass', 'library', 'phpass', '', 0, 1, 1, 1, '{"name":"PHPass","type":"library","creationDate":"2004-2006","author":"Solar Designer","copyright":"","authorEmail":"solar@openwall.com","authorUrl":"http:\\/\\/www.openwall.com\\/phpass\\/","version":"0.3","description":"LIB_PHPASS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 0, '{"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 0, '{"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 0, '{"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 0, '{"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 0, '{"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_RELATED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 0, '{"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 0, '{"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 0, '{"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(223, 'mod_finder', 'module', 'mod_finder', '', 0, 1, 0, 0, '{"name":"mod_finder","type":"module","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_TITLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 'mod_multilangstatus', 'module', 'mod_multilangstatus', '', 1, 1, 1, 0, '{"name":"mod_multilangstatus","type":"module","creationDate":"September 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MULTILANGSTATUS_XML_DESCRIPTION","group":""}', '{"cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(314, 'mod_version', 'module', 'mod_version', '', 1, 1, 1, 0, '{"name":"mod_version","type":"module","creationDate":"January 2012","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_VERSION_XML_DESCRIPTION","group":""}', '{"format":"short","product":"1","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(315, 'mod_stats_admin', 'module', 'mod_stats_admin', '', 1, 1, 1, 0, '{"name":"mod_stats_admin","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '{"serverinfo":"0","siteinfo":"0","counter":"0","increase":"0","cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(316, 'mod_tags_popular', 'module', 'mod_tags_popular', '', 0, 1, 1, 0, '{"name":"mod_tags_popular","type":"module","creationDate":"January 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"MOD_TAGS_POPULAR_XML_DESCRIPTION","group":""}', '{"maximum":"5","timeframe":"alltime","owncache":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(317, 'mod_tags_similar', 'module', 'mod_tags_similar', '', 0, 1, 1, 0, '{"name":"mod_tags_similar","type":"module","creationDate":"January 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"MOD_TAGS_SIMILAR_XML_DESCRIPTION","group":""}', '{"maximum":"5","matchtype":"any","owncache":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":""}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LDAP_XML_DESCRIPTION","group":""}', '{"host":"","port":"389","use_ldapV3":"0","negotiate_tls":"0","no_referrals":"0","auth_method":"bind","base_dn":"","search_string":"","users_dn":"","username":"admin","password":"bobby7","ldap_fullname":"fullName","ldap_email":"mail","ldap_uid":"uid"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(403, 'plg_content_contact', 'plugin', 'contact', 'content', 0, 1, 1, 0, '{"name":"plg_content_contact","type":"plugin","creationDate":"January 2014","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.2","description":"PLG_CONTENT_CONTACT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":""}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(405, 'plg_content_geshi', 'plugin', 'geshi', 'content', 0, 0, 1, 0, '{"name":"plg_content_geshi","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"","authorUrl":"qbnz.com\\/highlighter","version":"3.0.0","description":"PLG_CONTENT_GESHI_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":""}', '{"style":"xhtml"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 0, '{"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":""}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 0, '{"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":""}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 0, '{"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_VOTE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"3.15","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":""}', '{"lineNumbers":"1","lineWrapping":"1","matchTags":"1","matchBrackets":"1","marker-gutter":"1","autoCloseTags":"1","autoCloseBrackets":"1","autoFocus":"1","theme":"default","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"name":"plg_editors_none","type":"plugin","creationDate":"August 2004","author":"Unknown","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"3.0.0","description":"PLG_NONE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 0, '{"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2014","author":"Moxiecode Systems AB","copyright":"Moxiecode Systems AB","authorEmail":"N\\/A","authorUrl":"tinymce.moxiecode.com","version":"4.1.2","description":"PLG_TINY_XML_DESCRIPTION","group":""}', '{"mode":"2","skin":"0","entity_encoding":"raw","lang_mode":"0","lang_code":"en","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","invalid_elements":"script,applet,iframe","extended_elements":"","toolbar":"top","toolbar_align":"left","html_height":"550","html_width":"750","resizing":"true","resize_horizontal":"false","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","format_date":"%Y-%m-%d","inserttime":"1","format_time":"%H:%M:%S","colors":"1","table":"1","smilies":"1","media":"1","hr":"1","directionality":"1","fullscreen":"1","style":"1","layer":"1","xhtmlxtras":"1","visualchars":"1","visualblocks":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","advimage":"1","advlink":"1","advlist":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '{"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_READMORE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 0, '{"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_P3P_XML_DESCRIPTION","group":""}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CACHE_XML_DESCRIPTION","group":""}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":""}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LOG_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 1, 1, 1, '{"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEF_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 0, '{"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":""}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2009 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":""}', '{"autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 0, '{"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":""}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(436, 'plg_system_languagecode', 'plugin', 'languagecode', 'system', 0, 0, 1, 0, '{"name":"plg_system_languagecode","type":"plugin","creationDate":"November 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(437, 'plg_quickicon_joomlaupdate', 'plugin', 'joomlaupdate', 'quickicon', 0, 1, 1, 1, '{"name":"plg_quickicon_joomlaupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(438, 'plg_quickicon_extensionupdate', 'plugin', 'extensionupdate', 'quickicon', 0, 1, 1, 1, '{"name":"plg_quickicon_extensionupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(439, 'plg_captcha_recaptcha', 'plugin', 'recaptcha', 'captcha', 0, 1, 1, 0, '{"name":"plg_captcha_recaptcha","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION","group":""}', '{"public_key":"","private_key":"","theme":"clean"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(440, 'plg_system_highlight', 'plugin', 'highlight', 'system', 0, 1, 1, 0, '{"name":"plg_system_highlight","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(441, 'plg_content_finder', 'plugin', 'finder', 'content', 0, 0, 1, 0, '{"name":"plg_content_finder","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_FINDER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(442, 'plg_finder_categories', 'plugin', 'categories', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_categories","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CATEGORIES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(443, 'plg_finder_contacts', 'plugin', 'contacts', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_contacts","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CONTACTS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(444, 'plg_finder_content', 'plugin', 'content', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_content","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CONTENT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(445, 'plg_finder_newsfeeds', 'plugin', 'newsfeeds', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_newsfeeds","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(446, 'plg_finder_weblinks', 'plugin', 'weblinks', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_weblinks","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_WEBLINKS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(447, 'plg_finder_tags', 'plugin', 'tags', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_tags","type":"plugin","creationDate":"February 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_TAGS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(448, 'plg_twofactorauth_totp', 'plugin', 'totp', 'twofactorauth', 0, 0, 1, 0, '{"name":"plg_twofactorauth_totp","type":"plugin","creationDate":"August 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"PLG_TWOFACTORAUTH_TOTP_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(449, 'plg_authentication_cookie', 'plugin', 'cookie', 'authentication', 0, 1, 1, 0, '{"name":"plg_authentication_cookie","type":"plugin","creationDate":"July 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_AUTH_COOKIE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(450, 'plg_twofactorauth_yubikey', 'plugin', 'yubikey', 'twofactorauth', 0, 0, 1, 0, '{"name":"plg_twofactorauth_yubikey","type":"plugin","creationDate":"September 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"PLG_TWOFACTORAUTH_YUBIKEY_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(451, 'plg_search_tags', 'plugin', 'tags', 'search', 0, 0, 1, 0, '{"name":"plg_search_tags","type":"plugin","creationDate":"March 2014","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_TAGS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","show_tagged_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"hathor@tarrconsulting.com","authorUrl":"http:\\/\\/www.tarrconsulting.com","version":"3.0.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":""}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"name":"English (United Kingdom)","type":"language","creationDate":"2013-03-07","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.3.1","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"name":"English (United Kingdom)","type":"language","creationDate":"2013-03-07","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.3.1","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"name":"files_joomla","type":"file","creationDate":"September 2014","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.3.6","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10000, 'System - Helix Framework', 'plugin', 'helix', 'system', 0, 1, 1, 0, '{"name":"System - Helix Framework","type":"plugin","creationDate":"March 2011","author":"JoomShaper.com","copyright":"Copyright (C) 2010 - 2014 JoomShaper. All rights reserved.","authorEmail":"support@joomshaper.com","authorUrl":"www.joomshaper.com","version":"2.1.8","description":"Helix Framework - JoomShaper Template Framework for Joomla 2.5 and 3.X","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10002, 'isis', 'template', 'isis', '', 1, 1, 1, 0, '{"name":"isis","type":"template","creationDate":"3\\/30\\/2012","author":"Kyle Ledbetter","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"1.0","description":"TPL_ISIS_XML_DESCRIPTION","group":""}', '{"templateColor":"","logoFile":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10003, 'protostar', 'template', 'protostar', '', 0, 1, 1, 0, '{"name":"protostar","type":"template","creationDate":"4\\/30\\/2012","author":"Kyle Ledbetter","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"1.0","description":"TPL_PROTOSTAR_XML_DESCRIPTION","group":""}', '{"templateColor":"","logoFile":"","googleFont":"1","googleFontName":"Open+Sans","fluidContainer":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10004, 'beez3', 'template', 'beez3', '', 0, 1, 1, 0, '{"name":"beez3","type":"template","creationDate":"25 November 2009","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"3.1.0","description":"TPL_BEEZ3_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","templatecolor":"nature"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10005, 'plg_installer_webinstaller', 'plugin', 'webinstaller', 'installer', 0, 1, 1, 0, '{"name":"plg_installer_webinstaller","type":"plugin","creationDate":"7 October 2013","author":"Joomla! Project","copyright":"Copyright (C) 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.0.2","description":"PLG_INSTALLER_WEBINSTALLER_XML_DESCRIPTION","group":""}', '{"tab_position":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10006, 'JBanners', 'module', 'mod_jbanners', '', 0, 1, 0, 0, '{"name":"JBanners","type":"module","creationDate":"January 2012","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"JBanners","group":""}', '{"width":"1","height":"1","slideshow":"1","slide_duration":"3000","target":"1","count":"5","catid":"","tag_search":"0","ordering":"0","cache":"1","cache_time":"900"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10007, 'JBusinessDirectory - Latest Businesses', 'module', 'mod_jbusiness_latest', '', 0, 1, 0, 0, '{"name":"JBusinessDirectory - Latest Businesses","type":"module","creationDate":"November 2013","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"2.0.0","description":"JBusinessDirectory","group":""}', '{"categoryIds":"","count":"5","only_featured":"","cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10008, 'JBusinessDirectory - Progress', 'module', 'mod_jbusiness_progress', '', 0, 1, 0, 0, '{"name":"JBusinessDirectory - Progress","type":"module","creationDate":"November 2013","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"JBusinessDirectory - Progress","group":""}', '{"cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10009, 'JBusinessCategories', 'module', 'mod_jbusinesscategories', '', 0, 1, 0, 0, '{"name":"JBusinessCategories","type":"module","creationDate":"January 2012","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.1.0","description":"JBusinessCategories","group":""}', '{"cache":"1","cache_time":"900"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10010, 'JBusinessCategoriesOffers', 'module', 'mod_jbusinesscategoriesoffers', '', 0, 1, 0, 0, '{"name":"JBusinessCategoriesOffers","type":"module","creationDate":"July 2013","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"JBusinessCategoriesOffers","group":""}', '{"cache":"1","cache_time":"900"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10011, 'JBusinessDirectory Search', 'module', 'mod_jbusinessdirectory', '', 0, 1, 0, 0, '{"name":"JBusinessDirectory Search","type":"module","creationDate":"November 2011","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"2.0.0","description":"JBusinessDirectory","group":""}', '{"base-layout":"standard","layout-type":"vertical","showCategories":"0","showCities":"0","showRegions":"0","showCountries":"0","showZipcode":"0","autocomplete":"0","cache":"1","cache_time":"900"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10012, 'JBusinessOffer', 'module', 'mod_jbusinessoffer', '', 0, 1, 0, 0, '{"name":"JBusinessOffer","type":"module","creationDate":"April 2012","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"JBusinessOffer","group":""}', '{"cache":"1","cache_time":"900"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10013, 'JQueryLogin', 'module', 'mod_jquerylogin', '', 0, 1, 0, 0, '{"name":"JQueryLogin","type":"module","creationDate":"November 2011","author":"CMS Junkie","copyright":"Copyright (C) 2005 - 2011. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"Login Module","group":""}', '{"greeting":"1","name":"0","usesecure":"0","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10014, 'JUserLogin', 'module', 'mod_juserlogin', '', 0, 1, 0, 0, '{"name":"JUserLogin","type":"module","creationDate":"April 2012","author":"CMS Junkie","copyright":"Copyright (C) 2005 - 2012. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"User Login Module","group":""}', '{"greeting":"1","name":"0","usesecure":"0","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10015, 'plg_system_urltranslator', 'plugin', 'urltranslator', 'system', 0, 1, 1, 0, '{"name":"plg_system_urltranslator","type":"plugin","creationDate":"May 2012","author":"CMS Junkie","copyright":"Copyright (C) 2007 - 2012 CMS Junkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"This plugin is used for component translation","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10020, 'J-Quark', 'template', 'j-quark', '', 0, 1, 1, 0, '{"name":"J-Quark","type":"template","creationDate":"Feb 2014","author":"CMS Junkie","copyright":"Copyright (C) 2007 - 2014 CMSJunkie.com. All rights reserved.","authorEmail":"support@cmsjunkie.com","authorUrl":"http:\\/\\/www.cmsjunkie.com","version":"1.0.0","description":"\\n\\t\\t\\n\\t\\t\\tJ-Quark - the right choice for your directory. \\n\\t\\t\\tThe template is build based on Helix II framework.\\n\\t\\t\\t\\n\\t\\t\\t<h3>Key Features<\\/h3>\\n\\t\\t\\t<ul class=\\"arrow\\">\\n\\t\\t\\t\\t<li>Responsive design<\\/li>\\n\\t\\t\\t\\t<li>Unlimited module positions with the power of unique layout builder<\\/li>\\n\\t\\t\\t\\t<li>Powered by Bootstrap and compatible with Joomla 2.5 and 3.0<\\/li>\\n\\t\\t\\t\\t<li>Uses latest web technologies like html5 and css3<\\/li>\\n\\t\\t\\t\\t<li>Built with LESS CSS<\\/li>\\n\\t\\t\\t\\t<li>Megamenu, RTL Support, CSS and JS compression<\\/li>\\n\\t\\t\\t<\\/ul>\\n\\t\\t\\t\\n\\t\\t\\n\\t","group":""}', '{"layout_width":"1150","layout_type":"responsive","logo_type":"image","logo_position":"logo","logo_type_text":"Helix","logo_type_slogan":"Joomla! Templates Framework","logo_width":"130","logo_height":"50","footer_position":"footer1","showcp":"1","copyright":"Copyright \\u00a9 {year} CMS Junkie Directory - Demo. All Rights Reserved.","show_helix_logo":"0","jcredit":"0","credit_link":"0","validator":"0","showtop":"1","totop_position":"footer2","preset":"preset1","preset1_header":"#f8f8f8","preset1_bg":"#f2f2f2","preset1_text":"#666666","preset1_link":"#22b8f0","preset2_header":"#eeeeee","preset2_bg":"#f5f5f5","preset2_text":"#444444","preset2_link":"#6d7f1b","preset3_header":"#e5ddd5","preset3_bg":"#f2f2f2","preset3_text":"#333333","preset3_link":"#aa824a","menu":"mainmenu","menutype":"mega","menu_col_width":"200","show_menu_image":"1","menu_image_position":"1","submenu_position":"0","init_x":"0","init_y":"0","sub_x":"0","sub_y":"0","body_font":"","header_font":"","header_selectors":"","other_font":"","cache_time":"60","compress_css":"0","compress_js":"0","enable_ga":"0","ga_code":"","loadjquery":"0","loadfromcdn":"0","lessoption":"1","hide_component_area":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10024, 'JBusinessDirectory - Offers', 'module', 'mod_jbusiness_offers', '', 0, 1, 0, 0, '{"name":"JBusinessDirectory - Offers","type":"module","creationDate":"June 2014","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"1.0.0","description":"JBusinessDirectory","group":""}', '{"categoryIds":"","count":"5","cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10025, 'JBusinessDirectory', 'component', 'com_jbusinessdirectory', '', 1, 1, 0, 0, '{"name":"JBusinessDirectory","type":"component","creationDate":"November 2011","author":"CMSJunkie","copyright":"(C) CMSJunkie. All rights reserved.","authorEmail":"info@cmsjunkie.com","authorUrl":"www.cmsjunkie.com","version":"4.1.1","description":"JBusinessDirectory","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_filters`
--

CREATE TABLE IF NOT EXISTS `#__finder_filters` (
  `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links`
--

CREATE TABLE IF NOT EXISTS `#__finder_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms0`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms1`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms2`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms3`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms4`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms5`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms6`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms7`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms8`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_terms9`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_termsa`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_termsb`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_termsc`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_termsd`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_termse`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_links_termsf`
--

CREATE TABLE IF NOT EXISTS `#__finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_taxonomy`
--

CREATE TABLE IF NOT EXISTS `#__finder_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__finder_taxonomy`
--

INSERT INTO `#__finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_taxonomy_map`
--

CREATE TABLE IF NOT EXISTS `#__finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_terms`
--

CREATE TABLE IF NOT EXISTS `#__finder_terms` (
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  `language` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_terms_common`
--

CREATE TABLE IF NOT EXISTS `#__finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__finder_terms_common`
--

INSERT INTO `#__finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('ani', 'en'),
('any', 'en'),
('are', 'en'),
('aren''t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn''t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('noth', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('onli', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('veri', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('whi', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_tokens`
--

CREATE TABLE IF NOT EXISTS `#__finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `language` char(3) NOT NULL DEFAULT '',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_tokens_aggregate`
--

CREATE TABLE IF NOT EXISTS `#__finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  `language` char(3) NOT NULL DEFAULT '',
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__finder_types`
--

CREATE TABLE IF NOT EXISTS `#__finder_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_applicationsettings`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_applicationsettings` (
  `applicationsettings_id` int(10) NOT NULL DEFAULT '1',
  `company_name` char(255) NOT NULL,
  `company_email` char(255) NOT NULL,
  `currency_id` int(10) NOT NULL,
  `css_style` char(255) NOT NULL,
  `css_module_style` char(255) NOT NULL,
  `show_frontend_language` tinyint(1) NOT NULL DEFAULT '1',
  `default_frontend_language` char(50) NOT NULL DEFAULT 'en-GB',
  `date_format_id` int(5) NOT NULL,
  `enable_packages` tinyint(1) NOT NULL DEFAULT '0',
  `enable_ratings` tinyint(1) NOT NULL DEFAULT '1',
  `enable_reviews` tinyint(1) NOT NULL DEFAULT '1',
  `enable_offers` tinyint(1) NOT NULL DEFAULT '1',
  `enable_events` tinyint(1) NOT NULL DEFAULT '1',
  `enable_seo` tinyint(1) NOT NULL DEFAULT '1',
  `enable_search_filter` tinyint(1) NOT NULL DEFAULT '1',
  `enable_reviews_users` tinyint(4) NOT NULL DEFAULT '0',
  `enable_numbering` tinyint(1) NOT NULL DEFAULT '1',
  `enable_search_filter_offers` tinyint(1) NOT NULL DEFAULT '1',
  `enable_search_filter_events` tinyint(1) NOT NULL DEFAULT '1',
  `show_search_map` tinyint(1) NOT NULL DEFAULT '1',
  `show_search_description` tinyint(1) NOT NULL DEFAULT '1',
  `show_details_user` tinyint(1) NOT NULL DEFAULT '0',
  `company_view` tinyint(1) NOT NULL DEFAULT '1',
  `category_view` tinyint(1) NOT NULL DEFAULT '2',
  `search_result_view` tinyint(1) NOT NULL DEFAULT '1',
  `captcha` tinyint(1) NOT NULL DEFAULT '0',
  `nr_images_slide` tinyint(4) NOT NULL DEFAULT '5',
  `show_pending_approval` tinyint(1) NOT NULL DEFAULT '0',
  `allow_multiple_companies` tinyint(1) NOT NULL DEFAULT '1',
  `meta_description` text,
  `meta_keywords` text,
  `meta_description_facebook` text,
  `limit_cities` varchar(1) NOT NULL DEFAULT '0',
  `metric` varchar(1) NOT NULL DEFAULT '1',
  `user_location` varchar(1) NOT NULL DEFAULT '1',
  `search_type` varchar(1) NOT NULL DEFAULT '0',
  `zipcode_search_type` varchar(1) DEFAULT '0',
  `map_auto_show` varchar(1) DEFAULT '0',
  `menu_item_id` varchar(10) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `order_email` varchar(255) DEFAULT NULL,
  `claim_business` varchar(1) DEFAULT '1',
  `terms_conditions` blob,
  `vat` tinyint(4) DEFAULT '0',
  `expiration_day_notice` tinyint(2) DEFAULT NULL,
  `show_cat_description` tinyint(1) DEFAULT '1',
  `direct_processing` tinyint(1) DEFAULT NULL,
  `max_video` tinyint(2) DEFAULT '10',
  `max_pictures` tinyint(2) DEFAULT '15',
  `show_secondary_locations` tinyint(1) DEFAULT '0',
  `search_view_mode` tinyint(1) DEFAULT '0',
  `address_format` tinyint(1) NOT NULL DEFAULT '0',
  `offer_search_results_grid_view` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`applicationsettings_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jbusinessdirectory_applicationsettings`
--

INSERT INTO `#__jbusinessdirectory_applicationsettings` (`applicationsettings_id`, `company_name`, `company_email`, `currency_id`, `css_style`, `css_module_style`, `show_frontend_language`, `default_frontend_language`, `date_format_id`, `enable_packages`, `enable_ratings`, `enable_reviews`, `enable_offers`, `enable_events`, `enable_seo`, `enable_search_filter`, `enable_reviews_users`, `enable_numbering`, `enable_search_filter_offers`, `enable_search_filter_events`, `show_search_map`, `show_search_description`, `show_details_user`, `company_view`, `category_view`, `search_result_view`, `captcha`, `nr_images_slide`, `show_pending_approval`, `allow_multiple_companies`, `meta_description`, `meta_keywords`, `meta_description_facebook`, `limit_cities`, `metric`, `user_location`, `search_type`, `zipcode_search_type`, `map_auto_show`, `menu_item_id`, `order_id`, `order_email`, `claim_business`, `terms_conditions`, `vat`, `expiration_day_notice`, `show_cat_description`, `direct_processing`, `max_video`, `max_pictures`, `show_secondary_locations`, `search_view_mode`, `address_format`, `offer_search_results_grid_view`) VALUES
(1, 'JBusinessDirectory', 'office@site.com', 2, '', 'style.css', 1, 'en-GB', 2, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 2, 1, 0, 5, 0, 1, '', '', '', '0', '1', '1', '0', '0', '0', '', NULL, NULL, '1', '', 0, 0, 1, NULL, 10, 15, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_attributes`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_mandatory` int(1) NOT NULL DEFAULT '0',
  `show_in_filter` int(1) NOT NULL DEFAULT '1',
  `show_in_front` tinyint(1) NOT NULL DEFAULT '0',
  `show_on_search` tinyint(1) NOT NULL,
  `ordering` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_attribute_options`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_attribute_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_attribute_types`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_attribute_types` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jbusinessdirectory_attribute_types`
--

INSERT INTO `#__jbusinessdirectory_attribute_types` (`id`, `code`, `name`) VALUES
(1, 'input', 'Input'),
(2, 'select_box', 'Select Box'),
(3, 'checkbox', 'Checkbox(Multiple Select)'),
(4, 'radio', 'Radio(Single Select)');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_banners`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(145) NOT NULL,
  `companyId` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type` tinyint(2) NOT NULL,
  `imageLocation` varchar(245) DEFAULT NULL,
  `state` varchar(45) DEFAULT '0',
  `viewCount` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `#__jbusinessdirectory_banners`
--

INSERT INTO `#__jbusinessdirectory_banners` (`id`, `name`, `companyId`, `start_date`, `end_date`, `type`, `imageLocation`, `state`, `viewCount`, `url`) VALUES
(1, 'Banner 2', 12, '2011-11-10', '2013-11-10', 5, 'http://demo.cmsjunkie.com/jbusiness-directory/administrator/components/com_jbusinessdirectory/banners/1/electronics.jpg', '1', 218, 'http://demo.cmsjunkie.com/jbusiness-directory/almedia'),
(2, 'Banner 3', 12, '2011-11-10', '2013-11-10', 5, 'http://demo.cmsjunkie.com/jbusiness-directory/administrator/components/com_jbusinessdirectory/banners/2/Untitled-3.jpg', '1', 218, 'http://demo.cmsjunkie.com/jbusiness-directory/almedia'),
(6, 'Banner 5', 12, '2011-11-10', '2013-11-29', 5, 'http://demo.cmsjunkie.com/jbusiness-directory/administrator/components/com_jbusinessdirectory/banners/6/concert.jpg', '1', 218, 'http://demo.cmsjunkie.com/jbusiness-directory/almedia'),
(7, 'Banner 4', 12, '2011-11-10', '2013-11-10', 5, 'http://demo.cmsjunkie.com/jbusiness-directory/administrator/components/com_jbusinessdirectory/banners/7/image4.jpg', '0', 61, 'http://demo.cmsjunkie.com/jbusiness-directory/almedia'),
(9, 'Banner1', 0, '2011-11-10', '2013-11-10', 5, 'http://demo.cmsjunkie.com/jbusiness-directory/administrator/components/com_jbusinessdirectory/banners/9/beach.jpg', '1', 218, 'http://demo.cmsjunkie.com/jbusiness-directory/almedia');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_banner_types`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_banner_types` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `#__jbusinessdirectory_banner_types`
--

INSERT INTO `#__jbusinessdirectory_banner_types` (`id`, `name`) VALUES
(6, 'banner2'),
(5, 'banner1'),
(8, 'banner4');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_categories`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL DEFAULT '',
  `description` tinytext,
  `state` tinyint(4) NOT NULL,
  `imageLocation` varchar(250) DEFAULT NULL,
  `markerLocation` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_parent` (`parentId`),
  KEY `idx_name` (`name`),
  KEY `idx_state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `#__jbusinessdirectory_categories`
--

INSERT INTO `#__jbusinessdirectory_categories` (`id`, `parentId`, `name`, `alias`, `description`, `state`, `imageLocation`, `markerLocation`) VALUES
(1, 0, 'Automotive & Motors', 'automotive-&-motors', 'Automatics', 1, NULL, NULL),
(29, 0, 'Grocery, Health & Beauty', 'grocery,-health-&-beauty', '', 1, '', NULL),
(3, 0, 'Services', 'services', 'Services', 1, NULL, NULL),
(30, 0, 'Jewelry & Watches', 'jewelry-&-watches', '', 1, '', NULL),
(5, 0, 'Sports & Outdors', 'sports-&-outdors', 'Sport', 1, NULL, NULL),
(31, 7, 'Cell Phones & Accessories', 'cell-phones-&-accessories', '', 1, '', NULL),
(7, 0, 'Electronics', 'electronics', '', 1, '', NULL),
(8, 0, 'Fashion', 'fashion', '', 1, '', NULL),
(9, 0, 'Toy,Kids & Babies', 'toy,kids-&-babies', '', 1, '', NULL),
(10, 0, 'Movies, Music & Games ', 'movies,-music-&-games-', '', 1, '', NULL),
(11, 0, 'Home & Garden', 'home-&-garden', NULL, 1, NULL, NULL),
(12, 0, 'Books', 'books', NULL, 1, NULL, NULL),
(13, 0, 'Camera & Photography', 'camera-&-photography', NULL, 1, NULL, NULL),
(14, 1, 'Automotive Parts', 'automotive-parts', '', 1, '', NULL),
(16, 1, 'Automotive Tools', 'automotive-tools', '', 1, '', NULL),
(17, 1, 'Car Electronics', 'car-electronics', '', 1, '', NULL),
(18, 1, 'Tires ', 'tires-', '', 1, '', NULL),
(19, 12, 'Books', 'books', '', 1, '', NULL),
(22, 12, 'Children''s Books', 'children''s-books', '', 1, '', NULL),
(21, 12, 'Textbooks', 'textbooks', '', 1, '', NULL),
(23, 13, 'Camera', 'camera', '', 1, '', NULL),
(24, 13, 'Photography', 'photography', '', 1, '', NULL),
(25, 7, 'TV ', 'tv-', '', 1, '', NULL),
(26, 7, 'Home, Audio & Theater', 'home,-audio-&-theater', '', 1, '', NULL),
(28, 7, 'Electronics Accessories', 'electronics-accessories', '', 1, '', NULL),
(32, 7, 'Video Games', 'video-games', '', 1, '', NULL),
(33, 7, 'Computer Parts & Components', 'computer-parts-&-components', '', 1, '', NULL),
(34, 7, 'Software', 'software', '', 1, '', NULL),
(35, 8, 'Women', 'women', '', 1, '', NULL),
(36, 8, 'Man', 'man', '', 1, '', NULL),
(37, 8, 'Kids & Baby', 'kids-&-baby', '', 1, '', NULL),
(38, 8, 'Shoes', 'shoes', '', 1, '', NULL),
(39, 29, 'Grocery & Gourmet Food', 'grocery-&-gourmet-food', '', 1, '', NULL),
(40, 29, 'Wine', 'wine', '', 1, '', NULL),
(41, 29, 'Natural & Organic', 'natural-&-organic', '', 1, '', NULL),
(42, 29, 'Health & Personal Care', 'health-&-personal-care', '', 1, '', NULL),
(43, 11, 'Kitchen & Dining', 'kitchen-&-dining', '', 1, '', NULL),
(44, 11, 'Furniture & D', 'furniture-&-d', '', 1, '', NULL),
(45, 11, 'Bedding & Bath', 'bedding-&-bath', '', 1, '', NULL),
(46, 11, 'Patio, Lawn & Garden', 'patio,-lawn-&-garden', '', 1, '', NULL),
(47, 11, 'Arts, Crafts & Sewing', 'arts,-crafts-&-sewing', '', 1, '', NULL),
(48, 30, 'Watches', 'watches', '', 1, '', NULL),
(49, 30, 'Fine Jewelry', 'fine-jewelry', '', 1, '', NULL),
(50, 30, 'Fine Jewelry', 'fine-jewelry', '', 1, '', NULL),
(51, 30, 'Fashion Jewelry', 'fashion-jewelry', '', 1, '', NULL),
(52, 30, 'Fashion Jewelry', 'fashion-jewelry', '', 1, '', NULL),
(53, 30, 'Engagement & Wedding', 'engagement-&-wedding', '', 1, '', NULL),
(54, 10, 'Movies & TV', 'movies-&-tv', '', 1, '', NULL),
(55, 10, 'Blu-ray', 'blu-ray', '', 1, '', NULL),
(56, 10, 'Musical Instruments', 'musical-instruments', '', 1, '', NULL),
(57, 10, 'MP3 Downloads', 'mp3-downloads', '', 1, '', NULL),
(58, 10, 'Game Downloads', 'game-downloads', '', 1, '', NULL),
(59, 5, 'Exercise & Fitness', 'exercise-&-fitness', '', 1, '', NULL),
(60, 5, 'Outdoor Recreation', 'outdoor-recreation', '', 1, '', NULL),
(61, 5, 'Hunting & Fishing', 'hunting-&-fishing', '', 1, '', NULL),
(62, 5, 'Cycling', 'cycling', '', 1, '', NULL),
(63, 5, 'Team Sports', 'team-sports', '', 1, '', NULL),
(64, 9, 'Toys & Games', 'toys-&-games', '', 1, '', NULL),
(65, 9, 'Baby', 'baby', '', 1, '', NULL),
(66, 9, 'Clothing (Kids & Baby)', 'clothing-(kids-&-baby)', '', 1, '', NULL),
(67, 9, 'Video Games for Kids', 'video-games-for-kids', '', 1, '', NULL),
(68, 9, 'Baby Registry', 'baby-registry', '', 1, '', NULL),
(69, 3, 'Services', 'services', '', 1, '', NULL),
(70, 3, 'IT Services', 'it-services', '', 1, '', NULL),
(71, 0, 'TV &  Audio', 'tv-&--audio', '', 1, '', NULL),
(72, 71, 'TV', 'tv', '', 1, '', NULL),
(73, 71, 'Home Audio', 'home-audio', '', 1, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_cities`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jbusinessdirectory_cities`
--

INSERT INTO `#__jbusinessdirectory_cities` (`id`, `name`) VALUES
(1, 'Toronto'),
(2, 'Montreal');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_companies`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL DEFAULT '',
  `comercialName` varchar(120) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text,
  `street_number` varchar(20) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(60) DEFAULT NULL,
  `county` varchar(60) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `keywords` varchar(100) DEFAULT NULL,
  `registrationCode` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `typeId` int(11) NOT NULL,
  `logoLocation` varchar(245) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `mainSubcategory` int(11) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `activity_radius` float DEFAULT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `averageRating` float NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `viewCount` int(11) NOT NULL DEFAULT '0',
  `websiteCount` int(11) NOT NULL DEFAULT '0',
  `contactCount` int(11) NOT NULL DEFAULT '0',
  `taxCode` varchar(45) DEFAULT NULL,
  `package_id` int(11) NOT NULL DEFAULT '0',
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googlep` varchar(100) DEFAULT NULL,
  `postalCode` varchar(55) DEFAULT NULL,
  `mobile` varchar(55) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `publish_only_city` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_type` (`typeId`),
  KEY `idx_user` (`userId`),
  KEY `idx_state` (`state`),
  KEY `idx_approved` (`approved`),
  KEY `idx_country` (`countryId`),
  KEY `idx_package` (`package_id`),
  KEY `idx_keywords` (`keywords`),
  KEY `idx_description` (`description`(100)),
  KEY `idx_city` (`city`),
  KEY `idx_county` (`county`),
  KEY `idx_maincat` (`mainSubcategory`),
  KEY `idx_zipcode` (`latitude`,`longitude`),
  KEY `idx_phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `#__jbusinessdirectory_companies`
--

INSERT INTO `#__jbusinessdirectory_companies` (`id`, `name`, `alias`, `comercialName`, `short_description`, `description`, `street_number`, `address`, `city`, `county`, `countryId`, `website`, `keywords`, `registrationCode`, `phone`, `email`, `fax`, `state`, `typeId`, `logoLocation`, `creationDate`, `modified`, `mainSubcategory`, `latitude`, `longitude`, `activity_radius`, `userId`, `averageRating`, `approved`, `viewCount`, `websiteCount`, `contactCount`, `taxCode`, `package_id`, `facebook`, `twitter`, `googlep`, `postalCode`, `mobile`, `slogan`, `publish_only_city`, `featured`) VALUES
(1, 'Wedding company', 'wedding-company', 'Home & Gardem', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '122', 'Chestnut', 'Toronto', 'Ontario', 36, 'http://garden.com', 'ksldjfds', '342423422', '34242123123', 'email@decoration.com', '434312312321', 1, 1, '/companies/1/logo7-1392042517.jpg', '0000-00-00 00:00:00', NULL, 42, '43.654614783423014', '-79.3860912322998', NULL, 0, 3, 2, 6, 0, 0, '123123', 2, '', '', '', '3213123', '', '', 0, 0),
(4, 'Property inc', 'property-inc', 'Rent a car', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mollis justo nulla, a tempus elit pulvinar eget. Nunc tempus leo in arcu mattis lobortis. Fusce ut sollicitudin nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet feugiat ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mollis justo nulla, a tempus elit pulvinar eget. Nunc tempus leo in arcu mattis lobortis. Fusce ut sollicitudin nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet feugiat lectus id ornare. Nulla ut odio eget justo faucibus consectetur. Ut faucibus ultrices accumsan. Aenean leo neque, accumsan ac eleifend vel, pulvinar id urna. Phasellus non malesuada augue. Maecenas id egestas quam, at molestie tortor. Sed quis dictum eros.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mollis justo nulla, a tempus elit pulvinar eget. Nunc tempus leo in arcu mattis lobortis. Fusce ut sollicitudin nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet feugiat lectus id ornare. Nulla ut odio eget justo faucibus consectetur. Ut faucibus ultrices accumsan. Aenean leo neque, accumsan ac eleifend vel, pulvinar id urna. Phasellus non malesuada augue. Maecenas id egestas quam, at molestie tortor. Sed quis dictum eros.</p>', '11', 'Young Street', 'Toronto', 'Ontario', 36, 'http://google.com', '', '123123123', '0010727321321', 'office@email.com', '0010269/220123', 1, 1, '/companies/4/logo3-1392041714.jpg', '0000-00-00 00:00:00', NULL, 73, '43.64208175305137', '-79.3842687603319', 0, 0, 5, 2, 1, 0, 0, '123123', 2, '', '', '', '23123213', '', '', 0, 0),
(5, 'Organic food', 'organic-food', 'AQUACON PROJECT', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '44', 'Young Street', 'Toronto', 'Ontario', 36, '', '', '2321111', '0727321321', 'office@site.com', '0269/220123', 1, 5, '/companies/5/logo5-1392042368.jpg', '2011-11-24 03:30:40', NULL, 61, '43.650081332730466', '-79.37849521636963', 15, 0, 3, 2, 3, 0, 0, '123', 2, '', '', '', '1312312', '', '', 0, 0),
(7, 'NOBLESSE', 'noblesse', 'FINE JEWELERY', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '33', 'Richmong', 'Toronto', 'Ontario', 36, 'http://www.cmsjunkie.com', 'keywords1', '343243', '123123', 'office@shopping.com', '213123', 1, 8, '/companies/7/logo2-1392042326.jpg', '2011-11-24 03:31:39', NULL, 43, '43.649677652720534', '-79.37798023223877', 30, 0, 3.5, 2, 6, 0, 0, '123123', 2, '', '', '', '23213', '', '', 0, 0),
(8, 'It Company', 'it-company', 'Contruction Company', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '22', 'Lawrance', 'Toronto', 'Ontario', 36, 'http://google.com', '', '343412', '0727321321', 'office@site.com', '0269/220123', 1, 5, '/companies/8/logo6-1392042283.jpg', '2011-11-24 03:32:07', NULL, 67, '43.65057816594119', '-79.37493324279785', NULL, 0, 4, 2, 8, 0, 0, '12312', 2, '', '', '', '23123123', '', '', 0, 0),
(9, 'Coffe delights', 'coffe-delights', 'IT Services', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '32', 'Queen Street', 'Toronto', 'Ontario', 36, 'http://google.com', '', '3424234221212', '0727321321', 'office@company.com', '0010269/220123', 1, 4, '/companies/9/logo4-1392042222.jpg', '2011-12-01 08:24:29', NULL, 40, '43.650391853968806', '-79.38038349151611', 20, 0, 1.5, 2, 8, 0, 0, '123123', 2, '', '', '', '123213123', '', '', 0, 0),
(12, 'Better Health', 'better-health', 'Almedia', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '74444', 'Peg Keller Rd', 'Abita Springs', 'Louisiana', 226, 'http://www.cmsjunkie.com', '', 'RT545412SD', '001010727321321', 'directory@director.com', '', 1, 8, '/companies/12/logo1-1392042568.jpg', '2011-12-02 09:32:19', NULL, 5, '43.65538688599313', '-79.35828778892756', 20, 0, 4.25, 2, 69, 0, 0, '123123123', 2, 'http://https://www.facebook.com/cmsjunkie', 'http://https://twitter.com/cmsjunkie', 'http://https://plus.google.com/100376620356699373069/posts', '70420', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_activity_city`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_activity_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_UNQ` (`company_id`,`city_id`),
  KEY `idx_company` (`company_id`),
  KEY `idx_city` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_attributes`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_UNIQUE` (`company_id`,`attribute_id`,`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_category`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_category` (
  `companyId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`companyId`,`categoryId`),
  KEY `idx_category` (`companyId`,`categoryId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jbusinessdirectory_company_category`
--

INSERT INTO `#__jbusinessdirectory_company_category` (`companyId`, `categoryId`) VALUES
(1, 3),
(1, 12),
(1, 13),
(1, 41),
(1, 42),
(4, 3),
(4, 12),
(4, 13),
(4, 36),
(4, 38),
(4, 43),
(4, 56),
(4, 57),
(4, 60),
(4, 63),
(4, 73),
(5, 60),
(5, 61),
(5, 64),
(5, 68),
(5, 73),
(5, 855),
(6, 5),
(6, 17),
(7, 5),
(7, 17),
(7, 24),
(7, 43),
(7, 44),
(7, 94),
(8, 14),
(8, 16),
(8, 21),
(8, 22),
(8, 23),
(8, 24),
(8, 43),
(8, 44),
(8, 66),
(8, 67),
(8, 69),
(8, 433),
(8, 437),
(9, 21),
(9, 22),
(9, 35),
(9, 36),
(9, 40),
(9, 42),
(9, 285),
(9, 292),
(12, 5),
(12, 17),
(20, 290),
(20, 292);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_claim`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_claim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) DEFAULT NULL,
  `firstName` varchar(55) DEFAULT NULL,
  `lastName` varchar(55) DEFAULT NULL,
  `function` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_contact`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_function` varchar(50) DEFAULT NULL,
  `contact_department` varchar(100) DEFAULT NULL,
  `contact_email` varchar(60) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_fax` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`companyId`),
  KEY `R_13` (`companyId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_events`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(245) DEFAULT NULL,
  `alias` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `location` varchar(145) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  `view_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_events`
--

INSERT INTO `#__jbusinessdirectory_company_events` (`id`, `company_id`, `name`, `alias`, `description`, `location`, `type`, `start_date`, `start_time`, `end_date`, `end_time`, `state`, `approved`, `view_count`) VALUES
(9, 12, 'Celebration Party', 'celebration-party', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan enim dignissim consectetur viverra. Vestibulum a erat vitae quam pellentesque varius vel at ipsum. Pellentesque ultricies porttitor bibendum. Donec et justo quis tortor egestas rhoncus hendrerit ac massa. Sed tempus iaculis mi at sollicitudin. Etiam a ligula eget magna condimentum consectetur non pulvinar purus. Phasellus quis lobortis mauris. Nullam eleifend iaculis sem, nec hendrerit quam molestie vitae.\r\n\r\nCras condimentum, augue at pretium pellentesque, ipsum arcu ullamcorper erat, eu laoreet libero erat id erat. Vestibulum ut dolor commodo, condimentum purus in, egestas purus. In hac habitasse platea dictumst. Nam rutrum sapien quam, in viverra libero interdum a. Vivamus sollicitudin dolor eget tincidunt faucibus. Cras pretium justo neque, quis imperdiet nulla vehicula a. Nulla facilisi. Aliquam justo ligula, fringilla vel orci in, imperdiet aliquam elit. Vivamus ac lorem blandit, tempor felis eget, placerat lectus. ', 'Toronto, Canada', 4, '2014-11-21', NULL, '2014-11-22', NULL, 1, 1, 0),
(10, 12, 'Business Presentation', 'business-presentation', 'Nulla consectetur magna et cursus sagittis. Quisque ac consectetur elit. Ut volutpat tellus non orci fermentum, sit amet tincidunt quam scelerisque. Integer eleifend congue eros pellentesque pharetra. Integer sed diam lectus. Donec ultricies, arcu a vulputate fringilla, nisi quam vestibulum libero, faucibus bibendum nunc justo sed ante. Etiam luctus quis nisl nec ornare. Fusce urna leo, tincidunt at commodo non, vestibulum et erat. In faucibus posuere purus, at egestas dolor dictum ac. Maecenas volutpat lectus eget purus hendrerit, sit amet hendrerit diam mattis. Nulla imperdiet metus ac metus molestie, sed imperdiet leo eleifend. Fusce non tellus porta risus convallis vehicula. Donec quis convallis ligula. ', 'Gamble Avenue, Toronto, Canada', 5, '2014-11-21', NULL, '2014-11-21', NULL, 1, 1, 0),
(11, 1, 'Improve your communication skills', 'improve-your-communication-skills', 'Nulla sagittis pretium sagittis. Aliquam tincidunt sodales dui, a facilisis nisi sollicitudin quis. Sed nec mattis augue. Sed hendrerit odio non mauris fermentum semper. Praesent vehicula nec libero a imperdiet. Proin posuere nibh libero, ac euismod nulla tincidunt in. Mauris est nunc, fringilla ac facilisis a, ornare a leo. Nam lobortis tortor fringilla, lobortis nisl sit amet, cursus dolor. In at lectus massa. Integer ut nulla dapibus, volutpat nisi vitae, laoreet tellus. Quisque hendrerit blandit leo at dapibus. ', 'Gamble Avenue, Toronto, Canada', 3, '2014-11-21', NULL, '2014-11-21', NULL, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_event_pictures`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_event_pictures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `eventId` int(10) NOT NULL DEFAULT '0',
  `picture_info` blob NOT NULL,
  `picture_path` blob NOT NULL,
  `picture_enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_event_pictures`
--

INSERT INTO `#__jbusinessdirectory_company_event_pictures` (`id`, `eventId`, `picture_info`, `picture_path`, `picture_enable`) VALUES
(1, 9, '', 0x2f6576656e74732f392f70696e6b20706172747920776964652077616c6c70617065722d313338353033383239302e6a7067, 1),
(2, 9, '', 0x2f6576656e74732f392f70617274795f74696d655f77616c6c70617065725f65613364302d313338353033383239322e6a7067, 1),
(3, 9, '', 0x2f6576656e74732f392f696d616765732d313338353033383239342e6a7067, 1),
(4, 10, '', 0x2f6576656e74732f31302f696d616765362d313338353033383630322e706e67, 1),
(5, 10, '', 0x2f6576656e74732f31302f696d616765372d313338353033383630352e706e67, 1),
(6, 10, '', 0x2f6576656e74732f31302f696d616765352d313338353033383631332e706e67, 1),
(10, 11, '', 0x2f6576656e74732f31312f636f6d6d756e69636174696f6e5f736b696c6c2d313338353033383832352e6a7067, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_event_types`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `ordering` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_event_types`
--

INSERT INTO `#__jbusinessdirectory_company_event_types` (`id`, `name`, `ordering`) VALUES
(1, 'Seminar', NULL),
(2, 'Training', NULL),
(3, 'Workshop', NULL),
(4, 'Party', NULL),
(5, 'Presentation', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_images`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_images` (
  `companyId` char(18) NOT NULL,
  `id` char(18) NOT NULL,
  `imagePath` char(18) DEFAULT NULL,
  `typeId` char(18) NOT NULL,
  PRIMARY KEY (`companyId`,`id`,`typeId`),
  KEY `R_9` (`companyId`,`typeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_locations`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `street_number` varchar(20) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(60) DEFAULT NULL,
  `county` varchar(60) DEFAULT NULL,
  `postalCode` varchar(45) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_offers`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `specialPrice` float DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `offerOfTheDay` tinyint(1) NOT NULL DEFAULT '0',
  `viewCount` int(10) DEFAULT '0',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `county` varchar(45) DEFAULT NULL,
  `publish_start_date` date DEFAULT NULL,
  `publish_end_date` date DEFAULT NULL,
  `view_type` tinyint(2) NOT NULL DEFAULT '1',
  `url` varchar(145) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_offers`
--

INSERT INTO `#__jbusinessdirectory_company_offers` (`id`, `companyId`, `subject`, `description`, `price`, `specialPrice`, `startDate`, `endDate`, `state`, `approved`, `offerOfTheDay`, `viewCount`, `alias`, `address`, `city`, `short_description`, `county`, `publish_start_date`, `publish_end_date`, `view_type`, `url`, `article_id`, `latitude`, `longitude`) VALUES
(3, 12, 'Buy one get one free', 'Etiam eget urna est. Nullam turpis magna, pharetra id venenatis id, adipiscing at velit. In lobortis ornare congue. Sed vitae neque lacus, et rutrum lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque quis rhoncus felis. Sed adipiscing tellus laoreet neque adipiscing ac euismod felis gravida. Aenean fermentum, nulla non adipiscing tristique, lacus justo ornare nunc, eu aliquam nunc massa non justo. Sed at sapien vitae eros luctus condimentum non at libero. Morbi id arcu nec mi suscipit molestie. Integer ullamcorper suscipit erat, quis convallis quam interdum convallis. Sed lectus justo, vehicula et euismod rhoncus, tempus vel magna. Pellentesque laoreet, odio id iaculis bibendum, erat quam mollis urna, ac pretium neque mi vitae nisl. Fusce euismod bibendum risus vel suscipit. Suspendisse sapien tortor, vehicula sed lobortis tempus, pellentesque ut lectus.', 120, 110, '2013-01-01', '2014-02-10', 1, 1, 1, 8, 'buy-one-get-one-free', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(13, 12, 'Special Offer', 'Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.', 69.99, 49.99, '2013-01-03', '2014-01-04', 1, 0, 1, 5, 'special-offer', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_offer_category`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_offer_category` (
  `offerId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`offerId`,`categoryId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_offer_pictures`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_offer_pictures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `offerId` int(10) NOT NULL DEFAULT '0',
  `picture_info` blob NOT NULL,
  `picture_path` blob NOT NULL,
  `picture_enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_offer` (`offerId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_offer_pictures`
--

INSERT INTO `#__jbusinessdirectory_company_offer_pictures` (`id`, `offerId`, `picture_info`, `picture_path`, `picture_enable`) VALUES
(3, 3, '', 0x2f6f66666572732f332f696d616765342d313337333930333930312e706e67, 1),
(4, 3, '', 0x2f6f66666572732f332f696d616765362d313337333930333930352e706e67, 1),
(7, 13, '', 0x2f6f66666572732f31332f696d616765332d313337333930333836312e6a7067, 1),
(8, 13, '', 0x2f6f66666572732f31332f696d616765342d313337333930333838352e706e67, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_pictures`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_pictures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `companyId` int(10) NOT NULL DEFAULT '0',
  `picture_info` blob NOT NULL,
  `picture_path` blob NOT NULL,
  `picture_enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=222 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_pictures`
--

INSERT INTO `#__jbusinessdirectory_company_pictures` (`id`, `companyId`, `picture_info`, `picture_path`, `picture_enable`) VALUES
(220, 7, '', 0x2f636f6d70616e6965732f372f656c656374726f6e6963732e6a7067, 1),
(219, 8, '', 0x2f636f6d70616e6965732f382f696d616765362e706e67, 1),
(221, 7, '', 0x2f636f6d70616e6965732f372f696d616765732e6a7067, 1),
(218, 8, '', 0x2f636f6d70616e6965732f382f696d616765372e706e67, 1),
(213, 1, '', 0x2f636f6d70616e6965732f312f696d616765362e706e67, 1),
(212, 1, '', 0x2f636f6d70616e6965732f312f696d616765342e706e67, 1),
(217, 12, '', 0x2f636f6d70616e6965732f31322f696d616765372d313338353033373739362e706e67, 1),
(211, 9, '', 0x2f636f6d70616e6965732f392f696d616765352e706e67, 1),
(210, 9, '', 0x2f636f6d70616e6965732f392f696d616765342e706e67, 1),
(216, 12, '', 0x2f636f6d70616e6965732f31322f686f74656c5f726f6f6d2e6a7067, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_ratings`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `rating` float NOT NULL,
  `ipAddress` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_company` (`companyId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_ratings`
--

INSERT INTO `#__jbusinessdirectory_company_ratings` (`id`, `companyId`, `rating`, `ipAddress`) VALUES
(1, 8, 4, '5.15.238.52'),
(2, 12, 4, '5.15.238.52'),
(3, 5, 3, '5.15.238.52'),
(4, 4, 5, '5.15.238.52'),
(5, 1, 3, '5.15.238.52'),
(6, 7, 3.5, '5.15.238.52'),
(7, 9, 1.5, '5.15.238.52');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_reviews`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `description` text,
  `userId` int(11) NOT NULL,
  `likeCount` smallint(6) DEFAULT '0',
  `dislikeCount` smallint(6) DEFAULT '0',
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `companyId` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aproved` tinyint(1) NOT NULL DEFAULT '0',
  `ipAddress` varchar(45) DEFAULT NULL,
  `abuseReported` tinyint(1) NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_review_abuses`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_review_abuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reviewId` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_review_responses`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_review_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `reviewId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `response` text,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`reviewId`),
  KEY `R_19` (`reviewId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_types`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `ordering` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_types`
--

INSERT INTO `#__jbusinessdirectory_company_types` (`id`, `name`, `ordering`) VALUES
(1, 'Manufacturer/producer', 1),
(2, 'Distributor ', 2),
(4, 'Wholesaler ', 3),
(5, 'Retailer', 4),
(6, 'Service Provider', 5),
(7, 'Subcontractor', 6),
(8, 'Agent/Representative', 7);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_videos`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) DEFAULT NULL,
  `url` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_countries`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_countries` (
  `country_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_name` char(255) NOT NULL,
  `country_currency` char(255) NOT NULL,
  `country_currency_short` char(50) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=244 ;

--
-- Dumping data for table `#__jbusinessdirectory_countries`
--

INSERT INTO `#__jbusinessdirectory_countries` (`country_id`, `country_name`, `country_currency`, `country_currency_short`) VALUES
(1, 'Andorra', 'Euro', 'EUR'),
(2, 'United Arab Emirates', 'UAE Dirham', 'AED'),
(3, 'Afghanistan', 'Afghani', 'AFA'),
(4, 'Antigua and Barbuda', 'East Caribbean Dollar', 'XCD'),
(5, 'Anguilla', 'East Caribbean Dollar', 'XCD'),
(6, 'Albania', 'Lek', 'ALL'),
(7, 'Armenia', 'Armenian Dram', 'AMD'),
(8, 'Netherlands Antilles', 'Netherlands Antillean guilder', 'ANG'),
(9, 'Angola', 'Kwanza', 'AOA'),
(11, 'Argentina', 'Argentine Peso', 'ARS'),
(12, 'American Samoa', 'US Dollar', 'USD'),
(13, 'Austria', 'Euro', 'EUR'),
(14, 'Australia', 'Australian dollar', 'AUD'),
(15, 'Aruba', 'Aruban Guilder', 'AWG'),
(16, 'Azerbaijan', 'Azerbaijani Manat', 'AZM'),
(17, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM'),
(18, 'Barbados', 'Barbados Dollar', 'BBD'),
(19, 'Bangladesh', 'Taka', 'BDT'),
(20, 'Belgium', 'Euro', 'EUR'),
(21, 'Burkina Faso', 'CFA Franc BCEAO', 'XOF'),
(22, 'Bulgaria', 'Lev', 'BGL'),
(23, 'Bahrain', 'Bahraini Dinar', 'BHD'),
(24, 'Burundi', 'Burundi Franc', 'BIF'),
(25, 'Benin', 'CFA Franc BCEAO', 'XOF'),
(26, 'Bermuda', 'Bermudian Dollar', 'BMD'),
(27, 'Brunei Darussalam', 'Brunei Dollar', 'BND'),
(28, 'Bolivia', 'Boliviano', 'BOB'),
(29, 'Brazil', 'Brazilian Real', 'BRL'),
(30, 'The Bahamas', 'Bahamian Dollar', 'BSD'),
(31, 'Bhutan', 'Ngultrum', 'BTN'),
(32, 'Bouvet Island', 'Norwegian Krone', 'NOK'),
(33, 'Botswana', 'Pula', 'BWP'),
(34, 'Belarus', 'Belarussian Ruble', 'BYR'),
(35, 'Belize', 'Belize Dollar', 'BZD'),
(36, 'Canada', 'Canadian Dollar', 'CAD'),
(37, 'Cocos (Keeling) Islands', 'Australian Dollar', 'AUD'),
(39, 'Central African Republic', 'CFA Franc BEAC', 'XAF'),
(41, 'Switzerland', 'Swiss Franc', 'CHF'),
(42, 'Cote d''Ivoire', 'CFA Franc BCEAO', 'XOF'),
(43, 'Cook Islands', 'New Zealand Dollar', 'NZD'),
(44, 'Chile', 'Chilean Peso', 'CLP'),
(45, 'Cameroon', 'CFA Franc BEAC', 'XAF'),
(46, 'China', 'Yuan Renminbi', 'CNY'),
(47, 'Colombia', 'Colombian Peso', 'COP'),
(48, 'Costa Rica', 'Costa Rican Colon', 'CRC'),
(49, 'Cuba', 'Cuban Peso', 'CUP'),
(50, 'Cape Verde', 'Cape Verdean Escudo', 'CVE'),
(51, 'Christmas Island', 'Australian Dollar', 'AUD'),
(52, 'Cyprus', 'Cyprus Pound', 'CYP'),
(53, 'Czech Republic', 'Czech Koruna', 'CZK'),
(54, 'Germany', 'Euro', 'EUR'),
(55, 'Djibouti', 'Djibouti Franc', 'DJF'),
(56, 'Denmark', 'Danish Krone', 'DKK'),
(57, 'Dominica', 'East Caribbean Dollar', 'XCD'),
(58, 'Dominican Republic', 'Dominican Peso', 'DOP'),
(59, 'Algeria', 'Algerian Dinar', 'DZD'),
(60, 'Ecuador', 'US dollar', 'USD'),
(61, 'Estonia', 'Kroon', 'EEK'),
(62, 'Egypt', 'Egyptian Pound', 'EGP'),
(63, 'Western Sahara', 'Moroccan Dirham', 'MAD'),
(64, 'Eritrea', 'Nakfa', 'ERN'),
(65, 'Spain', 'Euro', 'EUR'),
(66, 'Ethiopia', 'Ethiopian Birr', 'ETB'),
(67, 'Finland', 'Euro', 'EUR'),
(68, 'Fiji', 'Fijian Dollar', 'FJD'),
(69, 'Falkland Islands (Islas Malvinas)', 'Falkland Islands Pound', 'FKP'),
(71, 'Faroe Islands', 'Danish Krone', 'DKK'),
(72, 'France', 'Euro', 'EUR'),
(74, 'Gabon', 'CFA Franc BEAC', 'XAF'),
(75, 'Grenada', 'East Caribbean Dollar', 'XCD'),
(76, 'Georgia', 'Lari', 'GEL'),
(77, 'French Guiana', 'Euro', 'EUR'),
(78, 'Guernsey', 'Pound Sterling', 'GBP'),
(79, 'Ghana', 'Cedi', 'GHC'),
(80, 'Gibraltar', 'Gibraltar Pound', 'GIP'),
(81, 'Greenland', 'Danish Krone', 'DKK'),
(82, 'The Gambia', 'Dalasi', 'GMD'),
(83, 'Guinea', 'Guinean Franc', 'GNF'),
(84, 'Guadeloupe', 'Euro', 'EUR'),
(85, 'Equatorial Guinea', 'CFA Franc BEAC', 'XAF'),
(86, 'Greece', 'Euro', 'EUR'),
(87, 'South Georgia and the South Sandwich Islands', 'Pound Sterling', 'GBP'),
(88, 'Guatemala', 'Quetzal', 'GTQ'),
(89, 'Guam', 'US Dollar', 'USD'),
(90, 'Guinea-Bissau', 'CFA Franc BCEAO', 'XOF'),
(91, 'Guyana', 'Guyana Dollar', 'GYD'),
(92, 'Hong Kong (SAR)', 'Hong Kong Dollar', 'HKD'),
(93, 'Heard Island and McDonald Islands', 'Australian Dollar', 'AUD'),
(94, 'Honduras', 'Lempira', 'HNL'),
(95, 'Croatia', 'Kuna', 'HRK'),
(96, 'Haiti', 'Gourde', 'HTG'),
(97, 'Hungary', 'Forint', 'HUF'),
(98, 'Indonesia', 'Rupiah', 'IDR'),
(99, 'Ireland', 'Euro', 'EUR'),
(100, 'Israel', 'New Israeli Sheqel', 'ILS'),
(102, 'India', 'Indian Rupee', 'INR'),
(103, 'British Indian Ocean Territory', 'US Dollar', 'USD'),
(104, 'Iraq', 'Iraqi Dinar', 'IQD'),
(105, 'Iran', 'Iranian Rial', 'IRR'),
(106, 'Iceland', 'Iceland Krona', 'ISK'),
(107, 'Italy', 'Euro', 'EUR'),
(108, 'Jersey', 'Pound Sterling', 'GBP'),
(109, 'Jamaica', 'Jamaican dollar', 'JMD'),
(110, 'Jordan', 'Jordanian Dinar', 'JOD'),
(111, 'Japan', 'Yen', 'JPY'),
(112, 'Kenya', 'Kenyan shilling', 'KES'),
(113, 'Kyrgyzstan', 'Som', 'KGS'),
(114, 'Cambodia', 'Riel', 'KHR'),
(115, 'Kiribati', 'Australian dollar', 'AUD'),
(116, 'Comoros', 'Comoro Franc', 'KMF'),
(117, 'Saint Kitts and Nevis', 'East Caribbean Dollar', 'XCD'),
(118, 'Korea North', 'North Korean Won', 'KPW'),
(119, 'Korea South', 'Won', 'KRW'),
(120, 'Kuwait', 'Kuwaiti Dinar', 'KWD'),
(121, 'Cayman Islands', 'Cayman Islands Dollar', 'KYD'),
(122, 'Kazakhstan', 'Tenge', 'KZT'),
(123, 'Laos', 'Kip', 'LAK'),
(124, 'Lebanon', 'Lebanese Pound', 'LBP'),
(125, 'Saint Lucia', 'East Caribbean Dollar', 'XCD'),
(126, 'Liechtenstein', 'Swiss Franc', 'CHF'),
(127, 'Sri Lanka', 'Sri Lanka Rupee', 'LKR'),
(128, 'Liberia', 'Liberian Dollar', 'LRD'),
(129, 'Lesotho', 'Loti', 'LSL'),
(130, 'Lithuania', 'Lithuanian Litas', 'LTL'),
(131, 'Luxembourg', 'Euro', 'EUR'),
(132, 'Latvia', 'Latvian Lats', 'LVL'),
(133, 'Libya', 'Libyan Dinar', 'LYD'),
(134, 'Morocco', 'Moroccan Dirham', 'MAD'),
(135, 'Monaco', 'Euro', 'EUR'),
(136, 'Moldova', 'Moldovan Leu', 'MDL'),
(137, 'Madagascar', 'Malagasy Franc', 'MGF'),
(138, 'Marshall Islands', 'US dollar', 'USD'),
(140, 'Mali', 'CFA Franc BCEAO', 'XOF'),
(141, 'Burma', 'kyat', 'MMK'),
(142, 'Mongolia', 'Tugrik', 'MNT'),
(143, 'Macao', 'Pataca', 'MOP'),
(144, 'Northern Mariana Islands', 'US Dollar', 'USD'),
(145, 'Martinique', 'Euro', 'EUR'),
(146, 'Mauritania', 'Ouguiya', 'MRO'),
(147, 'Montserrat', 'East Caribbean Dollar', 'XCD'),
(148, 'Malta', 'Maltese Lira', 'MTL'),
(149, 'Mauritius', 'Mauritius Rupee', 'MUR'),
(150, 'Maldives', 'Rufiyaa', 'MVR'),
(151, 'Malawi', 'Kwacha', 'MWK'),
(152, 'Mexico', 'Mexican Peso', 'MXN'),
(153, 'Malaysia', 'Malaysian Ringgit', 'MYR'),
(154, 'Mozambique', 'Metical', 'MZM'),
(155, 'Namibia', 'Namibian Dollar', 'NAD'),
(156, 'New Caledonia', 'CFP Franc', 'XPF'),
(157, 'Niger', 'CFA Franc BCEAO', 'XOF'),
(158, 'Norfolk Island', 'Australian Dollar', 'AUD'),
(159, 'Nigeria', 'Naira', 'NGN'),
(160, 'Nicaragua', 'Cordoba Oro', 'NIO'),
(161, 'Netherlands', 'Euro', 'EUR'),
(162, 'Norway', 'Norwegian Krone', 'NOK'),
(163, 'Nepal', 'Nepalese Rupee', 'NPR'),
(164, 'Nauru', 'Australian Dollar', 'AUD'),
(165, 'Niue', 'New Zealand Dollar', 'NZD'),
(166, 'New Zealand', 'New Zealand Dollar', 'NZD'),
(167, 'Oman', 'Rial Omani', 'OMR'),
(168, 'Panama', 'balboa', 'PAB'),
(169, 'Peru', 'Nuevo Sol', 'PEN'),
(170, 'French Polynesia', 'CFP Franc', 'XPF'),
(171, 'Papua New Guinea', 'Kina', 'PGK'),
(172, 'Philippines', 'Philippine Peso', 'PHP'),
(173, 'Pakistan', 'Pakistan Rupee', 'PKR'),
(174, 'Poland', 'Zloty', 'PLN'),
(175, 'Saint Pierre and Miquelon', 'Euro', 'EUR'),
(176, 'Pitcairn Islands', 'New Zealand Dollar', 'NZD'),
(177, 'Puerto Rico', 'US dollar', 'USD'),
(179, 'Portugal', 'Euro', 'EUR'),
(180, 'Palau', 'US dollar', 'USD'),
(181, 'Paraguay', 'Guarani', 'PYG'),
(182, 'Qatar', 'Qatari Rial', 'QAR'),
(183, 'R', 'Euro', 'EUR'),
(184, 'Romania', 'Leu', 'RON'),
(185, 'Russia', 'Russian Ruble', 'RUB'),
(186, 'Rwanda', 'Rwanda Franc', 'RWF'),
(187, 'Saudi Arabia', 'Saudi Riyal', 'SAR'),
(188, 'Solomon Islands', 'Solomon Islands Dollar', 'SBD'),
(189, 'Seychelles', 'Seychelles Rupee', 'SCR'),
(190, 'Sudan', 'Sudanese Dinar', 'SDD'),
(191, 'Sweden', 'Swedish Krona', 'SEK'),
(192, 'Singapore', 'Singapore Dollar', 'SGD'),
(193, 'Saint Helena', 'Saint Helenian Pound', 'SHP'),
(194, 'Slovenia', 'Tolar', 'SIT'),
(195, 'Svalbard', 'Norwegian Krone', 'NOK'),
(196, 'Slovakia', 'Slovak Koruna', 'SKK'),
(197, 'Sierra Leone', 'Leone', 'SLL'),
(198, 'San Marino', 'Euro', 'EUR'),
(199, 'Senegal', 'CFA Franc BCEAO', 'XOF'),
(200, 'Somalia', 'Somali Shilling', 'SOS'),
(201, 'Suriname', 'Suriname Guilder', 'SRG'),
(202, 'S', 'Dobra', 'STD'),
(203, 'El Salvador', 'El Salvador Colon', 'SVC'),
(204, 'Syria', 'Syrian Pound', 'SYP'),
(205, 'Swaziland', 'Lilangeni', 'SZL'),
(206, 'Turks and Caicos Islands', 'US Dollar', 'USD'),
(207, 'Chad', 'CFA Franc BEAC', 'XAF'),
(208, 'French Southern and Antarctic Lands', 'Euro', 'EUR'),
(209, 'Togo', 'CFA Franc BCEAO', 'XOF'),
(210, 'Thailand', 'Baht', 'THB'),
(211, 'Tajikistan', 'Somoni', 'TJS'),
(212, 'Tokelau', 'New Zealand Dollar', 'NZD'),
(213, 'Turkmenistan', 'Manat', 'TMM'),
(214, 'Tunisia', 'Tunisian Dinar', 'TND'),
(215, 'Tonga', 'Pa''anga', 'TOP'),
(216, 'East Timor', 'Timor Escudo', 'TPE'),
(217, 'Turkey', 'Turkish Lira', 'TRL'),
(218, 'Trinidad and Tobago', 'Trinidad and Tobago Dollar', 'TTD'),
(219, 'Tuvalu', 'Australian Dollar', 'AUD'),
(220, 'Taiwan', 'New Taiwan Dollar', 'TWD'),
(221, 'Tanzania', 'Tanzanian Shilling', 'TZS'),
(222, 'Ukraine', 'Hryvnia', 'UAH'),
(223, 'Uganda', 'Uganda Shilling', 'UGX'),
(224, 'United Kingdom', 'Pound Sterling', 'GBP'),
(225, 'United States Minor Outlying Islands', 'US Dollar', 'USD'),
(226, 'United States', 'US Dollar', 'USD'),
(227, 'Uruguay', 'Peso Uruguayo', 'UYU'),
(228, 'Uzbekistan', 'Uzbekistan Sum', 'UZS'),
(229, 'Holy See (Vatican City)', 'Euro', 'EUR'),
(230, 'Saint Vincent and the Grenadines', 'East Caribbean Dollar', 'XCD'),
(231, 'Venezuela', 'Bolivar', 'VEB'),
(232, 'British Virgin Islands', 'US dollar', 'USD'),
(233, 'Virgin Islands', 'US Dollar', 'USD'),
(234, 'Vietnam', 'Dong', 'VND'),
(235, 'Vanuatu', 'Vatu', 'VUV'),
(236, 'Wallis and Futuna', 'CFP Franc', 'XPF'),
(237, 'Samoa', 'Tala', 'WST'),
(238, 'Yemen', 'Yemeni Rial', 'YER'),
(239, 'Mayotte', 'Euro', 'EUR'),
(240, 'Yugoslavia', 'Yugoslavian Dinar', 'YUM'),
(241, 'South Africa', 'Rand', 'ZAR'),
(242, 'Zambia', 'Kwacha', 'ZMK'),
(243, 'Zimbabwe', 'Zimbabwe Dollar', 'ZWD');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_currencies`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_currencies` (
  `currency_id` int(10) NOT NULL AUTO_INCREMENT,
  `currency_name` char(10) NOT NULL,
  `currency_description` varchar(70) DEFAULT NULL,
  `currency_symbol` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `#__jbusinessdirectory_currencies`
--

INSERT INTO `#__jbusinessdirectory_currencies` (`currency_id`, `currency_name`, `currency_description`, `currency_symbol`) VALUES
(2, 'AED', 'UAE Dirham', '#'),
(3, 'AFN', 'Afghani', '?'),
(4, 'ALL', 'Lek', 'Lek'),
(5, 'AMD', 'Armenian Dram', '#'),
(6, 'ANG', 'Netherlands Antillian Guilder', 'f'),
(7, 'AOA', 'Kwanza', '#'),
(8, 'ARS', 'Argentine Peso', '$'),
(9, 'AUD', 'Australian Dollar', '$'),
(10, 'AWG', 'Aruban Guilder', 'f'),
(11, 'AZN', 'Azerbaijanian Manat', '???'),
(12, 'BAM', 'Convertible Marks', 'KM'),
(13, 'BBD', 'Barbados Dollar', '$'),
(14, 'BDT', 'Taka', '#'),
(15, 'BGN', 'Bulgarian Lev', '??'),
(16, 'BHD', 'Bahraini Dinar', '#'),
(17, 'BIF', 'Burundi Franc', '#'),
(18, 'BMD', 'Bermudian Dollar (customarily known as Bermuda Dollar)', '$'),
(19, 'BND', 'Brunei Dollar', '$'),
(20, 'BOB BOV', 'Boliviano Mvdol', '$b'),
(21, 'BRL', 'Brazilian Real', 'R$'),
(22, 'BSD', 'Bahamian Dollar', '$'),
(23, 'BWP', 'Pula', 'P'),
(24, 'BYR', 'Belarussian Ruble', 'p.'),
(25, 'BZD', 'Belize Dollar', 'BZ$'),
(26, 'CAD', 'Canadian Dollar', '$'),
(27, 'CDF', 'Congolese Franc', '#'),
(28, 'CHF', 'Swiss Franc', 'CHF'),
(29, 'CLP CLF', 'Chilean Peso Unidades de fomento', '$'),
(30, 'CNY', 'Yuan Renminbi', 'Y'),
(31, 'COP COU', 'Colombian Peso Unidad de Valor Real', '$'),
(32, 'CRC', 'Costa Rican Colon', '?'),
(33, 'CUP CUC', 'Cuban Peso Peso Convertible', '?'),
(34, 'CVE', 'Cape Verde Escudo', '#'),
(35, 'CZK', 'Czech Koruna', 'Kč'),
(36, 'DJF', 'Djibouti Franc', '#'),
(37, 'DKK', 'Danish Krone', 'kr'),
(38, 'DOP', 'Dominican Peso', 'RD$'),
(39, 'DZD', 'Algerian Dinar', '#'),
(40, 'EEK', 'Kroon', '#'),
(41, 'EGP', 'Egyptian Pound', 'L'),
(42, 'ERN', 'Nakfa', '#'),
(43, 'ETB', 'Ethiopian Birr', '#'),
(44, 'EUR', 'Euro', '€'),
(45, 'FJD', 'Fiji Dollar', '$'),
(46, 'FKP', 'Falkland Islands Pound', 'L'),
(47, 'GBP', 'Pound Sterling', 'L'),
(48, 'GEL', 'Lari', '#'),
(49, 'GHS', 'Cedi', '#'),
(50, 'GIP', 'Gibraltar Pound', 'L'),
(51, 'GMD', 'Dalasi', '#'),
(52, 'GNF', 'Guinea Franc', '#'),
(53, 'GTQ', 'Quetzal', 'Q'),
(54, 'GYD', 'Guyana Dollar', '$'),
(55, 'HKD', 'Hong Kong Dollar', '$'),
(56, 'HNL', 'Lempira', 'L'),
(57, 'HRK', 'Croatian Kuna', 'kn'),
(58, 'HTG USD', 'Gourde US Dollar', '#'),
(59, 'HUF', 'Forint', 'Ft'),
(60, 'IDR', 'Rupiah', 'Rp'),
(61, 'ILS', 'New Israeli Sheqel', '?'),
(62, 'INR', 'Indian Rupee', '#'),
(63, 'INR BTN', 'Indian Rupee Ngultrum', '#'),
(64, 'IQD', 'Iraqi Dinar', '#'),
(65, 'IRR', 'Iranian Rial', '?'),
(66, 'ISK', 'Iceland Krona', 'kr'),
(67, 'JMD', 'Jamaican Dollar', 'J$'),
(68, 'JOD', 'Jordanian Dinar', '#'),
(69, 'JPY', 'Yen', 'Y'),
(70, 'KES', 'Kenyan Shilling', '#'),
(71, 'KGS', 'Som', '??'),
(72, 'KHR', 'Riel', '?'),
(73, 'KMF', 'Comoro Franc', '#'),
(74, 'KPW', 'North Korean Won', '?'),
(75, 'KRW', 'Won', '?'),
(76, 'KWD', 'Kuwaiti Dinar', '#'),
(77, 'KYD', 'Cayman Islands Dollar', '$'),
(78, 'KZT', 'Tenge', '??'),
(79, 'LAK', 'Kip', '?'),
(80, 'LBP', 'Lebanese Pound', 'L'),
(81, 'LKR', 'Sri Lanka Rupee', '?'),
(82, 'LRD', 'Liberian Dollar', '$'),
(83, 'LTL', 'Lithuanian Litas', 'Lt'),
(84, 'LVL', 'Latvian Lats', 'Ls'),
(85, 'LYD', 'Libyan Dinar', '#'),
(86, 'MAD', 'Moroccan Dirham', '#'),
(87, 'MDL', 'Moldovan Leu', '#'),
(88, 'MGA', 'Malagasy Ariary', '#'),
(89, 'MKD', 'Denar', '???'),
(90, 'MMK', 'Kyat', '#'),
(91, 'MNT', 'Tugrik', '?'),
(92, 'MOP', 'Pataca', '#'),
(93, 'MRO', 'Ouguiya', '#'),
(94, 'MUR', 'Mauritius Rupee', '?'),
(95, 'MVR', 'Rufiyaa', '#'),
(96, 'MWK', 'Kwacha', '#'),
(97, 'MXN MXV', 'Mexican Peso Mexican Unidad de Inversion (UDI)', '$'),
(98, 'MYR', 'Malaysian Ringgit', 'RM'),
(99, 'MZN', 'Metical', 'MT'),
(100, 'NGN', 'Naira', '?'),
(101, 'NIO', 'Cordoba Oro', 'C$'),
(102, 'NOK', 'Norwegian Krone', 'kr'),
(103, 'NPR', 'Nepalese Rupee', '?'),
(104, 'NZD', 'New Zealand Dollar', '$'),
(105, 'OMR', 'Rial Omani', '?'),
(106, 'PAB USD', 'Balboa US Dollar', 'B/.'),
(107, 'PEN', 'Nuevo Sol', 'S/.'),
(108, 'PGK', 'Kina', '#'),
(109, 'PHP', 'Philippine Peso', 'Php'),
(110, 'PKR', 'Pakistan Rupee', '?'),
(111, 'PLN', 'Zloty', 'zł'),
(112, 'PYG', 'Guarani', 'Gs'),
(113, 'QAR', 'Qatari Rial', '?'),
(114, 'RON', 'New Leu', 'lei'),
(115, 'RSD', 'Serbian Dinar', '???.'),
(116, 'RUB', 'Russian Ruble', '???'),
(117, 'RWF', 'Rwanda Franc', '#'),
(118, 'SAR', 'Saudi Riyal', '?'),
(119, 'SBD', 'Solomon Islands Dollar', '$'),
(120, 'SCR', 'Seychelles Rupee', '?'),
(121, 'SDG', 'Sudanese Pound', '#'),
(122, 'SEK', 'Swedish Krona', 'kr'),
(123, 'SGD', 'Singapore Dollar', '$'),
(124, 'SHP', 'Saint Helena Pound', 'L'),
(125, 'SLL', 'Leone', '#'),
(126, 'SOS', 'Somali Shilling', 'S'),
(127, 'SRD', 'Surinam Dollar', '$'),
(128, 'STD', 'Dobra', '#'),
(129, 'SVC USD', 'El Salvador Colon US Dollar', '$'),
(130, 'SYP', 'Syrian Pound', 'L'),
(131, 'SZL', 'Lilangeni', '#'),
(132, 'THB', 'Baht', '?'),
(133, 'TJS', 'Somoni', '#'),
(134, 'TMT', 'Manat', '#'),
(135, 'TND', 'Tunisian Dinar', '#'),
(136, 'TOP', 'Pa''anga', '#'),
(137, 'TRY', 'Turkish Lira', 'TL'),
(138, 'TTD', 'Trinidad and Tobago Dollar', 'TT$'),
(139, 'TWD', 'New Taiwan Dollar', 'NT$'),
(140, 'TZS', 'Tanzanian Shilling', '#'),
(141, 'UAH', 'Hryvnia', '?'),
(142, 'UGX', 'Uganda Shilling', '#'),
(143, 'USD', 'US Dollar', '$'),
(144, 'UYU UYI', 'Peso Uruguayo Uruguay Peso en Unidades Indexadas', '$U'),
(145, 'UZS', 'Uzbekistan Sum', '??'),
(146, 'VEF', 'Bolivar Fuerte', 'Bs'),
(147, 'VND', 'Dong', '?'),
(148, 'VUV', 'Vatu', '#'),
(149, 'WST', 'Tala', '#'),
(150, 'XAF', 'CFA Franc BEAC', '#'),
(151, 'XAG', 'Silver', '#'),
(152, 'XAU', 'Gold', '#'),
(153, 'XBA', 'Bond Markets Units European Composite Unit (EURCO)', '#'),
(154, 'XBB', 'European Monetary Unit (E.M.U.-6)', '#'),
(155, 'XBC', 'European Unit of Account 9(E.U.A.-9)', '#'),
(156, 'XBD', 'European Unit of Account 17(E.U.A.-17)', '#'),
(157, 'XCD', 'East Caribbean Dollar', '$'),
(158, 'XDR', 'SDR', '#'),
(159, 'XFU', 'UIC-Franc', '#'),
(160, 'XOF', 'CFA Franc BCEAO', '#'),
(161, 'XPD', 'Palladium', '#'),
(162, 'XPF', 'CFP Franc', '#'),
(163, 'XPT', 'Platinum', '#'),
(164, 'XTS', 'Codes specifically reserved for testing purposes', '#'),
(165, 'YER', 'Yemeni Rial', '?'),
(166, 'ZAR', 'Rand', 'R'),
(167, 'ZAR LSL', 'Rand Loti', '#'),
(168, 'ZAR NAD', 'Rand Namibia Dollar', '#'),
(169, 'ZMK', 'Zambian Kwacha', '#'),
(170, 'ZWL', 'Zimbabwe Dollar', '#');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_date_formats`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_date_formats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `dateFormat` varchar(45) DEFAULT NULL,
  `calendarFormat` varchar(45) NOT NULL,
  `defaultDateValue` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jbusinessdirectory_date_formats`
--

INSERT INTO `#__jbusinessdirectory_date_formats` (`id`, `name`, `dateFormat`, `calendarFormat`, `defaultDateValue`) VALUES
(1, 'y-m-d', 'Y-m-d', '%Y-%m-%d', '0000-00-00'),
(2, 'd-m-y', 'd-m-Y', '%d-%m-%Y', '00-00-0000');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_default_attributes`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_default_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `config` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `#__jbusinessdirectory_default_attributes`
--

INSERT INTO `#__jbusinessdirectory_default_attributes` (`id`, `name`, `config`) VALUES
(2, 'comercial_name', 3),
(3, 'tax_code', 3),
(4, 'registration_code', 2),
(5, 'website', 2),
(6, 'company_type', 1),
(7, 'slogan', 2),
(8, 'description', 1),
(9, 'keywords', 2),
(10, 'category', 1),
(11, 'logo', 1),
(12, 'street_number', 1),
(13, 'address', 1),
(14, 'city', 1),
(15, 'region', 1),
(16, 'country', 1),
(17, 'postal_code', 1),
(18, 'map', 1),
(20, 'phone', 1),
(21, 'mobile_phone', 2),
(22, 'fax', 2),
(23, 'email', 1),
(24, 'pictures', 2),
(25, 'video', 2),
(26, 'social_networks', 2),
(27, 'short_description', 2),
(28, 'contact_person', 2);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_emails`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_emails` (
  `email_id` int(10) NOT NULL AUTO_INCREMENT,
  `email_subject` char(255) NOT NULL,
  `email_name` char(255) NOT NULL,
  `email_type` varchar(255) NOT NULL,
  `email_content` blob NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `#__jbusinessdirectory_emails`
--

INSERT INTO `#__jbusinessdirectory_emails` (`email_id`, `email_subject`, `email_name`, `email_type`, `email_content`, `is_default`) VALUES
(2, 'Your campany has received a review', 'Review Email', 'Review Email', 0x3c703e48692c3c2f703e0d0a3c703e596f7527726520726563656976696e67207468697320652d6d61696c206265636175736520796f7520686176652061206c697374696e672c20275b627573696e6573735f6e616d655d272c207768696368206861732072656365697665642061206e6577207265766965772e20596f752063616e207669657720746865207265766965772061743a3c2f703e0d0a3c703ec2a05b7265766965775f6c696e6b5d3c2f703e0d0a3c703ec2a03c2f703e0d0a3c703e42657374207769736865732c203c6272202f3e5b636f6d70616e795f6e616d655d3c2f703e, 1),
(3, 'Your review has received a response', 'Review Response Email', 'Review Response Email', 0x3c703e48692c3c6272202f3e3c6272202f3e596f752068617665207265636569766564206120726573706f6e736520666f72207468652072657669657720706f7374656420666f7220636f6d70616e79205b627573696e6573735f6e616d655d2e20596f752063616e2076696577207468652072657669657720726573706f6e73652061743a3c6272202f3e3c6272202f3e5b7265766965775f6c696e6b5d2e3c6272202f3e3c6272202f3ec2a03c6272202f3e42657374207769736865732c3c6272202f3e5b636f6d70616e795f6e616d655d3c2f703e, 1),
(4, 'Payment Receipt from [company_name]', 'Order E-mail', 'Order Email', 0x3c703e44656172205b637573746f6d65725f6e616d655d2c3c6272202f3e3c6272202f3e596f7572207061796d656e7420666f7220796f7572206f6e6c696e65206f7264657220706c61636564206f6e3c6272202f3e5b736974655f616464726573735d206f6e205b6f726465725f646174655d20686173206265656e20617070726f7665642e3c6272202f3e3c6272202f3e596f7572207061796d656e742069732063757272656e746c79206265696e672070726f6365737365642e204f726465722070726f63657373696e6720757375616c6c793c6272202f3e74616b6573206120666577206d696e757465732e3c6272202f3e3c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3ec2a0c2a0c2a0c2a0c2a0204f4e4c494e45204f52444552202d205041594d454e542044455441494c5320285041594d454e542052454345495054293c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3e3c6272202f3e576562736974653a205b736974655f616464726573735d3c6272202f3e4f72646572207265666572656e6365206e6f2e3a205b6f726465725f69645d3c6272202f3e5061796d656e74206d6574686f643a205b7061796d656e745f6d6574686f645d3c6272202f3e446174652f74696d653a5b6f726465725f646174655d3c6272202f3e4f726465722047656e6572616c20546f74616c3a205b746f74616c5f70726963655d3c6272202f3e3c6272202f3e2d2d2d2d2d2d3c6272202f3e50726f647563742f53657276696365206e616d653a5b736572766963655f6e616d655d3c6272202f3e50726963652f756e69743a205b756e69745f70726963655d3c6272202f3e54617865732028564154293a205b7461785f616d6f756e745d3c6272202f3e546f74616c3a205b746f74616c5f70726963655d3c6272202f3e3c6272202f3e2d2d2d2d2d2d3c6272202f3e3c6272202f3e4f7264657220737562746f74616c3a205b746f74616c5f70726963655d3c6272202f3e4f7264657220746f74616c3a205b746f74616c5f70726963655d3c6272202f3e3c6272202f3e42696c6c696e6720696e666f726d6174696f6e2069733a3c6272202f3e5b62696c6c696e675f696e666f726d6174696f6e5d3c6272202f3e3c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3e3c6272202f3e3c6272202f3e4265737420726567617264732c3c6272202f3e5b636f6d70616e795f6e616d655d3c2f703e, 1),
(5, 'You have been contacted on JBusinessDirectory', 'Contact E-Mail', 'Contact Email', 0x3c703e4e616d653a5b66697273745f6e616d655d205b6c6173745f6e616d655d3c6272202f3e452d6d61696c3a205b636f6e746163745f656d61696c5d3c6272202f3e3c6272202f3e5b636f6e746163745f656d61696c5f636f6e74656e745d3c2f703e, 0),
(6, 'Report abuse', 'Report Abuse', 'Report Abuse Email', 0x3c703e48692c3c6272202f3e3c6272202f3e3c2f703e0d0a3c703e596f7527726520726563656976696e67207468697320652d6d61696c206265636175736520616e20616275736520776173207265706f7274656420666f722074686520726576696577c2a03c7374726f6e673e5b7265766965775f6e616d655d3c2f7374726f6e673e2c20666f7220746865205b627573696e6573735f6e616d655d2e3c2f703e0d0a3c703e596f752063616e207669657720746865207265766965772061743a3c6272202f3e5b7265766965775f6c696e6b5d3c2f703e0d0a3c703e452d6d61696c3a205b636f6e746163745f656d61696c5d3c6272202f3e4162757365206465736372697074696f6e3a3c6272202f3e5b61627573655f6465736372697074696f6e5d3c2f703e, 0),
(7, 'Your business listing is about to expire', 'Expiration Notification', 'Expiration Notification Email', 0x3c703e48692c3c2f703e0d0a3c703e3c6272202f3e596f757220627573696e657373206c697374696e672077697468206e616d65205b627573696e6573735f6e616d655d2069732061626f757420746f2065787069726520696e205b6578705f646179735d20646179732e3c6272202f3e596f752063616e20657874656e642074686520627573696e657373206c697374696e6720627920636c69636b696e672022457874656e6420706572696f642220696e20636f6d70616e792065646974206d6f64652e3c2f703e0d0a3c703ec2a03c2f703e0d0a3c703ec2a04265737420726567617264732c3c6272202f3e5b636f6d70616e795f6e616d655d3c2f703e, 0),
(8, 'New Business Listing', 'New Business Listing Notification', 'New Company Notification Email', 0x3c703e48692c3c6272202f3e203c6272202f3e2041206e657720627573696e657373206c697374696e6773203c7374726f6e673e5b627573696e6573735f6e616d655d3c2f7374726f6e673e20686173206265656e20616464656420746f20796f7572206469726563746f72792ec2a0c2a03c2f703e, 0),
(9, 'You business listing has been approved', 'Business Listing Approval', 'Approve Email', 0x3c703e48692c3c6272202f3e203c6272202f3e20596f757220627573696e657373206c697374696e672077697468206e616d65203c7374726f6e673e5b627573696e6573735f6e616d655d3c2f7374726f6e673e20686173206265656e20617070726f7665642062792061646d696e6973747261746f722e3c6272202f3e3c6272202f3e3c6272202f3e4265737420726567617264732c3c6272202f3e5b636f6d70616e795f6e616d655d3c2f703e, 0),
(10, 'Payment details', 'Payment details', 'Payment Details Email', 0x3c703e44656172205b637573746f6d65725f6e616d655d2c3c6272202f3e3c6272202f3e596f7572206861766520706c6163656420616e206f7264657220666f72205b736572766963655f6e616d655d206f6e205b736974655f616464726573735d206f6e205b6f726465725f646174655d2e3c2f703e0d0a3c703e506c656173652066696e6420746865207061796d656e742064657461696c732062656c6c6f772e3c2f703e0d0a3c703e3c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3ec2a0c2a0c2a0c2a0c2a0205041594d454e542044455441494c533c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c2f703e0d0a3c703e5b7061796d656e745f64657461696c735d3c2f703e0d0a3c703e3c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3ec2a0c2a0c2a0c2a0c2a0204f4e4c494e45204f524445522044455441494c533c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3e3c6272202f3e576562736974653a205b736974655f616464726573735d3c6272202f3e4f72646572207265666572656e6365206e6f2e3a205b6f726465725f69645d3c6272202f3e5061796d656e74206d6574686f643a205b7061796d656e745f6d6574686f645d3c6272202f3e446174652f74696d653a5b6f726465725f646174655d3c6272202f3e4f726465722047656e6572616c20546f74616c3a205b746f74616c5f70726963655d3c6272202f3e3c6272202f3e2d2d2d2d2d2d3c6272202f3e50726f647563742f53657276696365206e616d653a5b736572766963655f6e616d655d3c6272202f3e50726963652f756e69743a205b756e69745f70726963655d3c6272202f3e54617865732028564154293a205b7461785f616d6f756e745d3c6272202f3e546f74616c3a205b746f74616c5f70726963655d3c6272202f3e3c6272202f3e2d2d2d2d2d2d3c6272202f3e3c6272202f3e42696c6c696e6720696e666f726d6174696f6e2069733a3c6272202f3e5b62696c6c696e675f696e666f726d6174696f6e5d3c6272202f3e3c6272202f3e2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a2a3c6272202f3e3c6272202f3e4265737420726567617264732c3c6272202f3e5b636f6d70616e795f6e616d655d3c2f703e, 0),
(11, 'Quote Request', 'Request Quote', 'Request Quote Email', 0x3c703e4e616d653a5b66697273745f6e616d655d205b6c6173745f6e616d655d3c6272202f3e452d6d61696c3a205b636f6e746163745f656d61696c5d3c6272202f3e43617465676f72793a205b63617465676f72795d3c6272202f3e3c6272202f3e5b636f6e746163745f656d61696c5f636f6e74656e745d3c2f703e, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_orders`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(145) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `amount_paid` decimal(8,2) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_at` datetime DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `transaction_id` varchar(145) DEFAULT NULL,
  `user_name` varchar(145) DEFAULT NULL,
  `service` varchar(145) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `currency` varchar(4) DEFAULT NULL,
  `expiration_email_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_company` (`company_id`),
  KEY `idx_package` (`package_id`),
  KEY `idx_date` (`start_date`),
  KEY `idx_order` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_packages`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(145) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `special_price` decimal(8,2) DEFAULT NULL,
  `special_from_date` date DEFAULT NULL,
  `special_to_date` date DEFAULT NULL,
  `days` smallint(6) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` tinyint(4) NOT NULL,
  `time_unit` varchar(10) NOT NULL DEFAULT 'D',
  `time_amount` mediumint(9) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__jbusinessdirectory_packages`
--

INSERT INTO `#__jbusinessdirectory_packages` (`id`, `name`, `description`, `price`, `special_price`, `special_from_date`, `special_to_date`, `days`, `status`, `ordering`, `time_unit`, `time_amount`) VALUES
(1, 'Silver Package', 'Silver Package', '120.00', '12.00', '1970-01-01', '1970-01-01', 12, 1, 2, 'D', 1),
(2, 'Basic', 'Basic Package', '0.00', '12.00', '1970-01-01', '1970-01-01', 0, 1, 1, 'D', 1),
(3, 'Gold Package', 'Gold Package', '123.00', '0.00', '1970-01-01', '1970-01-01', 20, 1, 3, 'D', 1),
(4, 'Premium Package', 'Premium Package', '123.00', '0.00', '1970-01-01', '1970-01-01', 40, 1, 4, 'D', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_package_fields`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_package_fields` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `feature` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `#__jbusinessdirectory_package_fields`
--

INSERT INTO `#__jbusinessdirectory_package_fields` (`int`, `package_id`, `feature`) VALUES
(87, 1, 'html_description'),
(88, 1, 'image_upload'),
(89, 1, 'videos'),
(90, 3, 'html_description'),
(91, 3, 'image_upload'),
(92, 3, 'videos'),
(93, 3, 'google_map'),
(94, 3, 'contact_form'),
(95, 4, 'html_description'),
(96, 4, 'image_upload'),
(97, 4, 'videos'),
(98, 4, 'google_map'),
(99, 4, 'contact_form'),
(100, 4, 'company_offers'),
(101, 4, 'social_networks');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_payments`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `processor_type` varchar(100) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_date` date NOT NULL,
  `transaction_id` varchar(80) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `currency` char(5) NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `response_code` varchar(45) DEFAULT NULL,
  `message` blob,
  `payment_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `NewIndex` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_payment_processors`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_payment_processors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `mode` enum('live','test') NOT NULL DEFAULT 'live',
  `timeout` int(7) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `displayfront` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `#__jbusinessdirectory_payment_processors`
--

INSERT INTO `#__jbusinessdirectory_payment_processors` (`id`, `name`, `type`, `mode`, `timeout`, `status`, `ordering`, `displayfront`) VALUES
(1, 'Paypal', 'Paypal', 'test', NULL, 1, NULL, 1),
(2, 'Bank Transfer', 'wiretransfer', 'live', 0, 1, 2, 1),
(3, 'Cash', 'cash', 'live', 0, 1, 3, 0),
(4, 'Buckaroo', 'buckaroo', 'test', 60, 1, NULL, 1),
(6, 'Cardsave', 'cardsave', 'test', 15, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_payment_processor_fields`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_payment_processor_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `column_name` varchar(100) DEFAULT NULL,
  `column_value` varchar(255) DEFAULT NULL,
  `processor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `#__jbusinessdirectory_payment_processor_fields`
--

INSERT INTO `#__jbusinessdirectory_payment_processor_fields` (`id`, `column_name`, `column_value`, `processor_id`) VALUES
(17, 'paypal_email', '', 1),
(88, 'bank_name', 'Bank Name', 2),
(86, 'bank_city', 'City', 2),
(87, 'bank_address', 'Address', 2),
(85, 'bank_country', 'Counntry', 2),
(84, 'swift_code', 'SW1321', 2),
(83, 'iban', 'BR213 123 123 123', 2),
(82, 'bank_account_number', '123123123123 ', 2),
(81, 'bank_holder_name', 'Account holder name', 2),
(89, 'secretKey', '5729E78B00CA4BA3994A480B169FB288', 4),
(90, 'merchantId', 'Z7bmGUrAps', 4),
(100, 'merchantId', '7714586', 6),
(98, 'preSharedKey', 'kZfhKfAsT+9st5/qVSnnYqG6M9Y+EYzHK4mwVNQmUuxs=', 6),
(99, 'password', '1M75C4R8', 6);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_reports`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(145) DEFAULT NULL,
  `description` text,
  `selected_params` text,
  `custom_params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jbusinessdirectory_reports`
--

INSERT INTO `#__jbusinessdirectory_reports` (`id`, `name`, `description`, `selected_params`, `custom_params`) VALUES
(1, 'Simple Report', 'Simple Report', 'name,short_description,website,email,averageRating,viewCount,contactCount,websiteCount', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `#__languages`
--

CREATE TABLE IF NOT EXISTS `#__languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__languages`
--

INSERT INTO `#__languages` (`lang_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `access`, `ordering`) VALUES
(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__menu`
--

CREATE TABLE IF NOT EXISTS `#__menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=502 ;

--
-- Dumping data for table `#__menu`
--

INSERT INTO `#__menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 201, 0, '*', 0),
(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 1, 10, 0, '*', 1),
(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 2, 3, 0, '*', 1),
(4, 'menu', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 4, 5, 0, '*', 1),
(5, 'menu', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 6, 7, 0, '*', 1),
(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 8, 9, 0, '*', 1),
(7, 'menu', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 129, 134, 0, '*', 1),
(8, 'menu', 'com_contact', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 130, 131, 0, '*', 1),
(9, 'menu', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 132, 133, 0, '*', 1),
(10, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 135, 140, 0, '*', 1),
(11, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 136, 137, 0, '*', 1),
(12, 'menu', 'com_messages_read', 'Read Private Message', '', 'Messaging/Read Private Message', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 138, 139, 0, '*', 1),
(13, 'menu', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 141, 146, 0, '*', 1),
(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 142, 143, 0, '*', 1),
(15, 'menu', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 144, 145, 0, '*', 1),
(16, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 159, 160, 0, '*', 1),
(17, 'menu', 'com_search', 'Basic Search', '', 'Basic Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 149, 150, 0, '*', 1),
(18, 'menu', 'com_weblinks', 'Weblinks', '', 'Weblinks', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 151, 156, 0, '*', 1),
(19, 'menu', 'com_weblinks_links', 'Links', '', 'Weblinks/Links', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 152, 153, 0, '*', 1),
(20, 'menu', 'com_weblinks_categories', 'Categories', '', 'Weblinks/Categories', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 154, 155, 0, '*', 1),
(21, 'menu', 'com_finder', 'Smart Search', '', 'Smart Search', 'index.php?option=com_finder', 'component', 0, 1, 1, 27, 0, '0000-00-00 00:00:00', 0, 0, 'class:finder', 0, '', 147, 148, 0, '*', 1),
(22, 'menu', 'com_joomlaupdate', 'Joomla! Update', '', 'Joomla! Update', 'index.php?option=com_joomlaupdate', 'component', 0, 1, 1, 28, 0, '0000-00-00 00:00:00', 0, 0, 'class:joomlaupdate', 0, '', 157, 158, 0, '*', 1),
(23, 'main', 'com_tags', 'Tags', '', 'Tags', 'index.php?option=com_tags', 'component', 0, 1, 1, 29, 0, '0000-00-00 00:00:00', 0, 1, 'class:tags', 0, '', 61, 62, 0, '', 1),
(101, 'mainmenu', 'Home', 'home', '', 'home', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":[""],"layout_type":"blog","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"0","link_titles":"","show_intro":"","info_block_position":"","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_readmore":"","show_readmore_title":"","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 11, 12, 1, '*', 0),
(102, 'mainmenu', 'Features', '2013-01-31-06-37-23', '', '2013-01-31-06-37-23', '#', 'url', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"3","group":"0","showgrouptitle":"1","cwidth":"500","colxw":"250\\r\\n250\\r\\n500","class":"","subcontent":"normal"}', 29, 82, 0, '*', 0),
(103, 'mainmenu', 'Typography', 'typgraphy', '', '2013-01-31-06-37-23/2013-01-31-06-54-32/typgraphy', 'index.php?option=com_content&view=article&id=14', 'component', 1, 106, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 31, 32, 0, '*', 0),
(104, 'mainmenu', 'Module Position', 'module-position', '', '2013-01-31-06-37-23/2013-01-31-06-54-32/module-position', 'index.php?option=com_content&view=article&id=18', 'component', 1, 106, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 33, 34, 0, '*', 0),
(105, 'mainmenu', 'Module Variations', '2013-01-31-06-39-54', '', '2013-01-31-06-37-23/2013-01-31-06-54-32/2013-01-31-06-39-54', 'index.php?option=com_content&view=article&id=2', 'component', 1, 106, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 35, 36, 0, '*', 0),
(106, 'mainmenu', 'Key Features', '2013-01-31-06-54-32', '', '2013-01-31-06-37-23/2013-01-31-06-54-32', '#', 'url', 1, 102, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"1","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 30, 43, 0, '*', 0),
(107, 'mainmenu', 'Shortcode', '2013-01-31-07-00-31', '', '2013-01-31-07-00-31', '#', 'url', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 83, 106, 0, '*', 0),
(108, 'mainmenu', 'Menu', '2013-01-31-07-00-49', '', '2013-01-31-06-37-23/2013-01-31-07-00-49', '#', 'url', 1, 102, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"1","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 44, 79, 0, '*', 0),
(109, 'mainmenu', 'Mega Menu', '2013-01-31-07-04-54', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-04-54', '?menu=mega', 'url', 1, 108, 3, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 45, 46, 0, '*', 0),
(110, 'mainmenu', 'Dropline Menu', '2013-01-31-07-06-22', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-06-22', '?menu=drop', 'url', 0, 108, 3, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 47, 48, 0, '*', 0),
(112, 'mainmenu', 'Split Menu', '2013-01-31-07-08-55', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-08-55', '?menu=split', 'url', 0, 108, 3, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 49, 50, 0, '*', 0),
(113, 'mainmenu', 'RTL Demos', '2013-01-31-07-09-06', '', '2013-01-31-06-37-23/2013-01-31-06-54-32/2013-01-31-07-09-06', '#', 'url', 1, 106, 3, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 37, 42, 0, '*', 0),
(114, 'mainmenu', 'LTR Language', '2013-01-31-07-09-56', '', '2013-01-31-06-37-23/2013-01-31-06-54-32/2013-01-31-07-09-06/2013-01-31-07-09-56', '?direction=ltr', 'url', 1, 113, 4, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 38, 39, 0, '*', 0),
(115, 'mainmenu', 'RTL Language', '2013-01-31-07-10-29', '', '2013-01-31-06-37-23/2013-01-31-06-54-32/2013-01-31-07-09-06/2013-01-31-07-10-29', '?direction=rtl', 'url', 1, 113, 4, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 40, 41, 0, '*', 0),
(116, 'mainmenu', 'Custom Module', '2013-01-31-07-13-54', '', '2013-01-31-06-37-23/2013-01-31-07-13-54', '#', 'url', 1, 102, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"1","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"modules","mods":["87"]}', 80, 81, 0, '*', 0),
(117, 'mainmenu', 'Presets', '2013-01-31-07-20-51', '', '2013-01-31-07-20-51', '#', 'url', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 107, 114, 0, '*', 0),
(118, 'mainmenu', 'Preset1', '2013-01-31-07-21-59', '', '2013-01-31-07-20-51/2013-01-31-07-21-59', '?preset=preset1', 'url', 1, 117, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 108, 109, 0, '*', 0),
(119, 'mainmenu', 'Menu Example', '2013-01-31-07-23-52', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52', '#', 'url', 1, 108, 3, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"2","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 51, 78, 0, '*', 0),
(120, 'mainmenu', 'Preset2', '2013-01-31-07-24-34', '', '2013-01-31-07-20-51/2013-01-31-07-24-34', '?preset=preset2', 'url', 1, 117, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 110, 111, 0, '*', 0),
(121, 'mainmenu', 'Preset3', '2013-01-31-07-25-04', '', '2013-01-31-07-20-51/2013-01-31-07-25-04', '?preset=preset3', 'url', 1, 117, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 112, 113, 0, '*', 0),
(123, 'mainmenu', 'Page examples', 'joomla', '', 'joomla', 'index.php?option=com_content&view=article&id=1', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_tags":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 115, 128, 0, '*', 0),
(124, 'mainmenu', 'Group2', '2013-01-31-07-29-22', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22', '#', 'url', 1, 119, 4, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"1","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 60, 77, 0, '*', 0),
(125, 'mainmenu', 'Child Item', '2013-01-31-07-32-05', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-32-05', '#', 'url', 1, 124, 5, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 61, 62, 0, '*', 0),
(126, 'mainmenu', 'Child Item', '2013-01-31-07-32-48', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-32-48', '#', 'url', 1, 124, 5, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 63, 64, 0, '*', 0),
(127, 'mainmenu', 'Child Item', '2013-01-31-07-33-25', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-33-25', '#', 'url', 1, 124, 5, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 65, 76, 0, '*', 0),
(128, 'mainmenu', 'Group1', '2013-01-31-07-34-16', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-34-16', '#', 'url', 1, 119, 4, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"1","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 52, 59, 0, '*', 0),
(129, 'mainmenu', 'Child Item', '2013-01-31-07-35-10', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-34-16/2013-01-31-07-35-10', '#', 'url', 1, 128, 5, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"images\\/folder.png","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 53, 54, 0, '*', 0),
(130, 'mainmenu', 'Child Item', '2013-01-31-07-38-19', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-34-16/2013-01-31-07-38-19', '#', 'url', 1, 128, 5, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 55, 56, 0, '*', 0),
(131, 'mainmenu', 'Child Item', '2013-01-31-07-38-54', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-34-16/2013-01-31-07-38-54', '#', 'url', 1, 128, 5, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 57, 58, 0, '*', 0),
(132, 'mainmenu', 'Category Blog', 'category-blog', '', 'joomla/category-blog', 'index.php?option=com_content&view=category&layout=blog&id=8', 'component', 1, 123, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"layout_type":"blog","show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 116, 117, 0, '*', 0),
(133, 'mainmenu', 'Single Article', 'single-article', '', 'joomla/single-article', 'index.php?option=com_content&view=article&id=1', 'component', 1, 123, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 118, 119, 0, '*', 0),
(134, 'mainmenu', 'Child Item', '2013-01-31-07-41-53', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-33-25/2013-01-31-07-41-53', '#', 'url', 1, 127, 6, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 66, 67, 0, '*', 0),
(135, 'mainmenu', 'Child Item', '2013-01-31-07-42-32', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-33-25/2013-01-31-07-42-32', '#', 'url', 1, 127, 6, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 68, 69, 0, '*', 0),
(136, 'mainmenu', 'Child Item', '2013-01-31-07-42-56', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-33-25/2013-01-31-07-42-56', '#', 'url', 1, 127, 6, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 70, 75, 0, '*', 0),
(137, 'mainmenu', 'Child Item', '2013-01-31-07-43-43', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-33-25/2013-01-31-07-42-56/2013-01-31-07-43-43', '#', 'url', 1, 136, 7, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 71, 72, 0, '*', 0),
(138, 'mainmenu', 'Child Item', '2013-01-31-07-44-11', '', '2013-01-31-06-37-23/2013-01-31-07-00-49/2013-01-31-07-23-52/2013-01-31-07-29-22/2013-01-31-07-33-25/2013-01-31-07-42-56/2013-01-31-07-44-11', '#', 'url', 1, 136, 7, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 73, 74, 0, '*', 0),
(139, 'mainmenu', 'Contact', 'contact', '', 'joomla/contact', 'index.php?option=com_contact&view=contact&id=1', 'component', 1, 123, 2, 8, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"presentation_style":"","show_contact_category":"","show_contact_list":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_links":"","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 120, 121, 0, '*', 0),
(140, 'mainmenu', 'Login', 'login', '', 'joomla/login', 'index.php?option=com_users&view=login', 'component', 1, 123, 2, 25, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"login_redirect_url":"","logindescription_show":"1","login_description":"","login_image":"","logout_redirect_url":"","logoutdescription_show":"1","logout_description":"","logout_image":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 122, 123, 0, '*', 0),
(141, 'mainmenu', 'Registration', 'registration', '', 'joomla/registration', 'index.php?option=com_users&view=registration', 'component', 1, 123, 2, 25, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 124, 125, 0, '*', 0),
(142, 'mainmenu', 'Accordion', 'accordion', '', '2013-01-31-07-00-31/accordion', 'index.php?option=com_content&view=article&id=3', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 84, 85, 0, '*', 0),
(143, 'mainmenu', 'Carousel', 'carousel', '', '2013-01-31-07-00-31/carousel', 'index.php?option=com_content&view=article&id=4', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 86, 87, 0, '*', 0),
(144, 'mainmenu', 'Tab', 'tab', '', '2013-01-31-07-00-31/tab', 'index.php?option=com_content&view=article&id=5', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 88, 89, 0, '*', 0),
(145, 'mainmenu', 'Map', 'map', '', '2013-01-31-07-00-31/map', 'index.php?option=com_content&view=article&id=6', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 90, 91, 0, '*', 0),
(146, 'mainmenu', 'Testimonial ', 'testimonial', '', '2013-01-31-07-00-31/testimonial', 'index.php?option=com_content&view=article&id=7', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 92, 93, 0, '*', 0),
(147, 'mainmenu', 'Alert', 'alert', '', '2013-01-31-07-00-31/alert', 'index.php?option=com_content&view=article&id=8', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 94, 95, 0, '*', 0),
(148, 'mainmenu', 'Button', 'button', '', '2013-01-31-07-00-31/button', 'index.php?option=com_content&view=article&id=9', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 96, 97, 0, '*', 0),
(149, 'mainmenu', 'Icon', 'icon', '', '2013-01-31-07-00-31/icon', 'index.php?option=com_content&view=article&id=10', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 98, 99, 0, '*', 0),
(150, 'mainmenu', 'Column', 'column', '', '2013-01-31-07-00-31/column', 'index.php?option=com_content&view=article&id=11', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 100, 101, 0, '*', 0),
(151, 'top-menu', 'About Us', 'about-us', '', 'about-us', 'index.php?option=com_content&view=article&id=12', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 161, 162, 0, '*', 0),
(152, 'top-menu', 'About Joomla', 'about-joomla', '', 'about-joomla', 'index.php?option=com_content&view=article&id=1', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 163, 164, 0, '*', 0),
(153, 'top-menu', 'Joomla Overview', 'joomla-overview', '', 'joomla-overview', 'index.php?option=com_content&view=article&id=1', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 165, 166, 0, '*', 0),
(154, 'mainmenu', 'Gallery', 'gallery', '', '2013-01-31-07-00-31/gallery', 'index.php?option=com_content&view=article&id=16', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 102, 103, 0, '*', 0),
(155, 'mainmenu', 'Video', 'video', '', '2013-01-31-07-00-31/video', 'index.php?option=com_content&view=article&id=17', 'component', 1, 107, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 104, 105, 0, '*', 0),
(156, 'mainmenu', '404', '2013-02-06-08-37-59', '', 'joomla/2013-02-06-08-37-59', 'index.php?option=404', 'url', 1, 123, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 126, 127, 0, '*', 0),
(157, 'main', 'com_postinstall', 'Post-installation messages', '', 'Post-installation messages', 'index.php?option=com_postinstall', 'component', 0, 1, 1, 32, 0, '0000-00-00 00:00:00', 0, 1, 'class:postinstall', 0, '', 61, 62, 0, '*', 1),
(173, 'mainmenu', 'Directory', 'directory', '', 'directory', 'index.php?option=com_jbusinessdirectory&view=catalog', 'component', 1, 1, 1, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 13, 28, 0, '*', 0),
(174, 'mainmenu', 'Categories', 'categories', '', 'directory/categories', 'index.php?option=com_jbusinessdirectory&view=categories', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 14, 15, 0, '*', 0),
(175, 'mainmenu', 'Catalog', 'catalog', '', 'directory/catalog', 'index.php?option=com_jbusinessdirectory&view=catalog', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 16, 17, 0, '*', 0),
(176, 'mainmenu', 'Packages', 'packages', '', 'directory/packages', 'index.php?option=com_jbusinessdirectory&view=packages', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 18, 19, 0, '*', 0),
(177, 'mainmenu', 'Offers', 'offers', '', 'directory/offers', 'index.php?option=com_jbusinessdirectory&view=offers', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 22, 23, 0, '*', 0),
(178, 'mainmenu', 'Events', 'offers-2', '', 'directory/offers-2', 'index.php?option=com_jbusinessdirectory&view=events', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 20, 21, 0, '*', 0),
(179, 'mainmenu', 'Add a business', 'add-a-business', '', 'directory/add-a-business', 'index.php?option=com_jbusinessdirectory&view=managecompany', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 24, 25, 0, '*', 0),
(180, 'mainmenu', 'Control Panel', 'control-panel', '', 'directory/control-panel', 'index.php?option=com_jbusinessdirectory&view=useroptions', 'component', 1, 173, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"","colxw":"","class":"","subcontent":"normal"}', 26, 27, 0, '*', 0),
(181, 'mainmenu', 'Login', 'login', '', 'login', '', 'component', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"showmenutitle":"1","desc":"","cols":"1","group":"0","showgrouptitle":"1","cwidth":"250","colxw":"200","class":"","subcontent":"modules","mods":["124"]}', 167, 168, 0, '*', 0),
(486, 'main', 'COM_J_BUSINESSDIRECTORY', 'com-j-businessdirectory', '', 'com-j-businessdirectory', 'index.php?option=com_jbusinessdirectory', 'component', 0, 1, 1, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/jbusinessdirectory.gif', 0, '', 169, 200, 0, '', 1),
(487, 'main', 'APPLICATION_SETTINGS', 'application-settings', '', 'com-j-businessdirectory/application-settings', 'index.php?option=com_jbusinessdirectory&view=applicationsettings', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/settings_16_16_icon.gif', 0, '', 170, 171, 0, '', 1),
(488, 'main', 'MANAGE_COMPANIES', 'manage-companies', '', 'com-j-businessdirectory/manage-companies', 'index.php?option=com_jbusinessdirectory&view=companies', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/managecompanies_16_16_icon.gif', 0, '', 172, 173, 0, '', 1),
(489, 'main', 'MANAGE_CUSTOM_FIELDS', 'manage-custom-fields', '', 'com-j-businessdirectory/manage-custom-fields', 'index.php?option=com_jbusinessdirectory&view=attributes', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/customfields_16_icon.gif', 0, '', 174, 175, 0, '', 1),
(490, 'main', 'MANAGE_COMPANY_TYPES', 'manage-company-types', '', 'com-j-businessdirectory/manage-company-types', 'index.php?option=com_jbusinessdirectory&view=companytypes', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/managecompanytypes_16_16_icon.gif', 0, '', 176, 177, 0, '', 1),
(491, 'main', 'MANAGE_ORDERS', 'manage-orders', '', 'com-j-businessdirectory/manage-orders', 'index.php?option=com_jbusinessdirectory&view=orders', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/manageorders_16_16_icon.gif', 0, '', 178, 179, 0, '', 1),
(492, 'main', 'MANAGE_OFFERS', 'manage-offers', '', 'com-j-businessdirectory/manage-offers', 'index.php?option=com_jbusinessdirectory&view=offers', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/manageoffers_16_16_icon.gif', 0, '', 180, 181, 0, '', 1),
(493, 'main', 'MANAGE_EVENTS', 'manage-events', '', 'com-j-businessdirectory/manage-events', 'index.php?option=com_jbusinessdirectory&view=offers', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/events_16_icon.gif', 0, '', 182, 183, 0, '', 1),
(494, 'main', 'MANAGE_EVENT_TYPES', 'manage-event-types', '', 'com-j-businessdirectory/manage-event-types', 'index.php?option=com_jbusinessdirectory&view=offers', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/event_type_16_icon.gif', 0, '', 184, 185, 0, '', 1);
INSERT INTO `#__menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(495, 'main', 'PAYMENT_PROCESSORS', 'payment-processors', '', 'com-j-businessdirectory/payment-processors', 'index.php?option=com_jbusinessdirectory&view=paymentprocessors', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/paymentprocessors_16_16_icon.gif', 0, '', 186, 187, 0, '', 1),
(496, 'main', 'MANAGE_PACKAGES', 'manage-packages', '', 'com-j-businessdirectory/manage-packages', 'index.php?option=com_jbusinessdirectory&view=packages', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/managepackages_16_16_icon.gif', 0, '', 188, 189, 0, '', 1),
(497, 'main', 'MANAGE_CATEGORIES', 'manage-categories', '', 'com-j-businessdirectory/manage-categories', 'index.php?option=com_jbusinessdirectory&view=managecategories', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/managecategories_16_16_icon.gif', 0, '', 190, 191, 0, '', 1),
(498, 'main', 'MANAGE_REVIEWS', 'manage-reviews', '', 'com-j-businessdirectory/manage-reviews', 'index.php?option=com_jbusinessdirectory&view=ratings', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/managereviews_16_16_icon.gif', 0, '', 192, 193, 0, '', 1),
(499, 'main', 'MANAGE_EMAILS', 'manage-emails', '', 'com-j-businessdirectory/manage-emails', 'index.php?option=com_jbusinessdirectory&view=emailtemplates', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jbusinessdirectory/assets/img/manageemails_16_16_icon.gif', 0, '', 194, 195, 0, '', 1),
(500, 'main', 'REPORTS', 'reports', '', 'com-j-businessdirectory/reports', 'index.php?option=com_jbusinessdirectory&view=reports', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '', 196, 197, 0, '', 1),
(501, 'main', 'UPDATE', 'update', '', 'com-j-businessdirectory/update', 'index.php?option=com_jbusinessdirectory&view=updates', 'component', 0, 486, 2, 10025, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '', 198, 199, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__menu_types`
--

CREATE TABLE IF NOT EXISTS `#__menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__menu_types`
--

INSERT INTO `#__menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(1, 'mainmenu', 'Main Menu', 'The main menu for the site'),
(2, 'top-menu', 'Top Menu', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__messages`
--

CREATE TABLE IF NOT EXISTS `#__messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__messages_cfg`
--

CREATE TABLE IF NOT EXISTS `#__messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__modules`
--

CREATE TABLE IF NOT EXISTS `#__modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `#__modules`
--

INSERT INTO `#__modules` (`id`, `asset_id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(2, 0, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 0, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 0, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(8, 0, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 0, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 0, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(12, 0, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(13, 0, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 0, 'User Status', '', '', 2, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 0, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(79, 0, 'Multilanguage status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multilangstatus', 3, 1, '{"layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(86, 0, 'Joomla Version', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_version', 3, 1, '{"format":"short","product":"1","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(87, 0, 'Menu Module', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Far far away, behind the word mountains, far from the countries.<br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>', 0, 'menumodule', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(88, 0, 'Variation Highlighted', 'Module Variation', '<p>Use module class suffix "orange"</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" highlighted","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(89, 0, 'Variation Green', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" green","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(90, 0, 'Variation Gray', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" gray","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(92, 0, 'Variation Orange', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" orange","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(93, 0, 'Variation Maroon', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard printing simply.</p>\r\n<ul>\r\n<li><a href="#">List Item 1</a></li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li><a href="#">List Item 3</a></li>\r\n</ul>', 1, 'user2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" maroon","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(94, 0, 'Variation Pink', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" pink","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(96, 0, 'Variation Dark', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" dark","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(97, 0, 'Variation Blue', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" blue","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(98, 0, 'Variation Red', '', '<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting</a> industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>\r\n<ul>\r\n<li>List Item 1</li>\r\n<li><a href="#">List Item 2</a></li>\r\n<li>List Item 3</li>\r\n</ul>', 1, 'user3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" red","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(100, 74, 'Front Page Feature', 'Frontpage Slideshow', '<p>[carousel]</p>\r\n<p>[carousel_item]</p>\r\n<h1>Helix Framework</h1>\r\n<p>Powerful templates framework to develop Joomla base website faster!</p>\r\n<p>[button type="primary" size="large" link="http://www.joomshaper.com/helix/"]Download Now[/button] <span style="line-height: 1.3em;">[button type="success" size="large" link="http://demo.joomshaper.com/?template=helix_ii"]Live Demo[/button]</span><span style="line-height: 1.3em;"> </span></p>\r\n<p>[/carousel_item]</p>\r\n<p>[carousel_item]</p>\r\n<h1>Layout Builder</h1>\r\n<p>JoomShaper brings Layout Builder first time in Joomla! It is one of the unique features introduced in Helix – II which allows anyone to customize the existing theme in any shape or dimensions without having any programming language!</p>\r\n<p>[/carousel_item]</p>\r\n<p>[carousel_item]</p>\r\n<h1>Useful Shortcodes</h1>\r\n<p>In Helix - II you can see many useful Shortcodes installed. Now you can add lots of extra features on your website, without having any coding knowledge.</p>\r\n<p>[/carousel_item]</p>\r\n<p><span style="line-height: 1.3em;">[/carousel]</span></p>', 1, 'feature', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(101, 0, 'Search', '', '', 1, 'search', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_search', 1, 1, '{"label":"","width":"20","text":"","button":"1","button_pos":"right","imagebutton":"","button_text":"","opensearch":"1","opensearch_title":"","set_itemid":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(102, 0, 'The Framework', '', '<p>[icon name="cog" size="64" color="#fff" class="pull-left" /]<span style="line-height: 1.3em;">The Helix Framework is one of the best light and feature rich responsive theme framework developed by JoomShaper, your trusted friend in this world, for an easy accessibility to the way of building Joomla and Wordpress based websites with hundreds of easy tasking features.</span></p>\r\n<p><span style="line-height: 1.3em;">It is so easy to develop and control of Joomla &amp; Wordpress templates for you and your clients. Helix framework will make your experience of creating website much smoother than ever before.</span></p>\r\n<p><span style="line-height: 1.3em;">[button type="primary" size="large" link="http://www.joomshaper.com/helix"][icon name="download-alt" /] Download Now[/button]</span></p>', 1, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" highlighted","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(103, 82, 'Directory Features', '', '<p>[row][col class="span6"]</p>\r\n<p>Extension</p>\r\n<ul class="arrow">\r\n<li><a href="#">Claim business listing</a></li>\r\n<li><a href="#">Search </a></li>\r\n<li><a href="#">Catalog</a></li>\r\n<li><a href="#">Offers</a></li>\r\n<li><a href="#">Events</a></li>\r\n<li><a href="#">Multiple modules</a></li>\r\n<li><a href="#">Responsive</a></li>\r\n</ul>\r\n<p>[/col] [col class="span6"]</p>\r\n<p>Template</p>\r\n<ul class="arrow">\r\n<li><a href="#">Fully Responsive</a></li>\r\n<li><a href="#">Powerful Layout Builder</a></li>\r\n<li><a href="#">Useful shortcodes</a></li>\r\n<li><a href="#">HelixII framework</a></li>\r\n<li><a href="#">Mega Menu</a></li>\r\n<li><a href="#">Built with LESS</a></li>\r\n<li><a href="#">HTML5 base template</a></li>\r\n</ul>\r\n<p>[/col][/row]</p>', 1, 'bottom3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(104, 85, 'Gallery', '', '<p>[gallery]</p>\r\n<p>[gallery_item src="images/directory/search.jpg" /]</p>\r\n<p>[gallery_item src="images/directory/search-results.jpg" /]</p>\r\n<p>[gallery_item src="images/directory/company-details.jpg" /]</p>\r\n<p>[gallery_item src="images/directory/events.jpg" /]</p>\r\n<p>[gallery_item src="images/directory/packages.jpg" /]</p>\r\n<p>[gallery_item src="images/directory/controlpanel.jpg" /]</p>\r\n<p>[/gallery]</p>', 1, 'bottom1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(105, 80, 'About Us', '', '<p>We Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin gravida malesuada diam, vitae sodales purus volutpat dignissim. Vestibulum hendrerit auctor mauris ut mattis.</p>\r\n<p><strong>Connet With Us</strong></p>\r\n<p><span style="line-height: 1.3em;">[button type="link social facebook" link="http://www.facebook.com/cmsjunkie"][icon name="facebook" /][/button] [button type="link social twitter" link="http://twitter.com/cmsjunkie"][icon name="twitter" /][/button] [button type="link social pinterest" link="#"][icon name="pinterest" /][/button] [button type="link social gplus" link="#"][icon name="google-plus" /][/button]</span></p>', 1, 'bottom2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(107, 0, 'Footer Menu', '', '', 1, 'footer2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 0, '{"menutype":"top-menu","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(111, 76, 'User1', '', '<p>[icon name=''envelope'' class="" size=''55'']</p>\r\n<h4>Contact company</h4>\r\n<p>Find out the services that you need and contact your favorite company.</p>', 1, 'user1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" center","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(112, 0, 'User4', '', '<p>[icon name=''coffee'' size=''48'' class=''pull-left'']</p>\r\n<h4>Built with Less</h4>\r\n<p>Reduce your development time by coding css using less that supported by latest Helix Framework.</p>', 1, 'user4', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(113, 77, 'User3', '', '<p>[icon name=''book'' class='''' size=''55'']</p>\r\n<h4>Enjoy events</h4>\r\n<p>Find the right events that will bring joy in your life.</p>', 1, 'user3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" center","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(114, 78, 'User2', '', '<p>[icon name=''money'' class="" size=''55'']</p>\r\n<h4>Business offers</h4>\r\n<p>Take advantage of your daily offers<span style="line-height: 1.3em;">.</span></p>', 1, 'user2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":" center","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(115, 64, 'JBanners', '', '', 1, 'directory2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jbanners', 1, 0, '{"width":"0","height":"391","slideshow":"1","slide_duration":"3000","target":"1","count":"5","cid":"0","catid":["12"],"tag_search":"0","ordering":"0","header_text":"","footer_text":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(116, 65, 'Featured Businesses', '', '', 1, 'directory4', 822, '2014-03-13 10:52:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jbusiness_latest', 1, 1, '{"categoryIds":[""],"count":"4","layout":"_:default","moduleclass_sfx":" ","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(117, 66, 'JBusinessDirectory - Progress', '', '', 1, 'directory2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jbusiness_progress', 1, 0, '{"title":"Sign up to manage your business","member_title":"Become a member","member_text":"Create a member account to add or manage your business.","add_business_title":"Add your business","add_business_text":"Provide some basic details and we''ll check to see if you''re already listed.","layout":"_:default","moduleclass_sfx":" progress-box","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(118, 67, 'JBusinessCategories', '', '', 1, 'directory1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jbusinesscategories', 1, 0, '{"layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(119, 68, 'JBusinessCategoriesOffers', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_jbusinesscategoriesoffers', 1, 1, '', 0, '*'),
(120, 69, 'JBusinessDirectory', '', '', 1, 'feature', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jbusinessdirectory', 1, 1, '{"title":"Let''s get started","description":"What would you like to find?","base-layout":"default","layout-type":"horizontal","showKeyword":"1","mandatoryKeyword":"0","showCategories":"1","mandatoryCategories":"0","showCities":"1","mandatoryCities":"0","showRegions":"0","mandatoryRegions":"0","showCountries":"0","mandatoryCountries":"0","showZipcode":"1","autocomplete":"1","moduleclass_sfx":"","cache":"1","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(121, 70, 'JBusinessOffer', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_jbusinessoffer', 1, 1, '', 0, '*'),
(122, 71, 'JQueryLogin', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_jquerylogin', 1, 1, '', 0, '*'),
(123, 72, 'JUserLogin', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_juserlogin', 1, 1, '', 0, '*'),
(124, 81, 'Login', '', '', 1, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{"pretext":"","posttext":"","login":"180","logout":"","greeting":"1","name":"0","usesecure":"0","usetext":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(125, 83, 'Popular features', '', '<div class="center">\r\n<p>[row]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[icon name="envelope"/]</p>\r\n<h3 class="service-heading">Contact company</h3>\r\n<p class="sevice-text">Integer libero arcu, porta id erat at, sodales lacinia tellus. Maecenas orci lacus, dignissim a purus nec, iaculis aliquam mauris felis a lorem.</p>\r\n[/col]\r\n<p>[col class="span4"]</p>\r\n<p>[icon name="magic"/]</p>\r\n<h3 class="service-heading">Claim busniess</h3>\r\n<p class="sevice-text">Fusce auctor posuere risus, in cursus est iaculis sed. Fusce quis auctor lacus, vel luctus sapien. Pellentesque tempor  accumsan adipiscing.</p>\r\n<p class="sevice-text">[/col]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[icon name="money"/]</p>\r\n<h3 class="service-heading">Offers</h3>\r\n<p class="sevice-text">Sed tempor enim id egestas varius. Donec vel euismod turpis. Donec mauris magna, tincidunt ac ipsum et, ornare pellentesque leo.</p>\r\n<p class="sevice-text">[/col]</p>\r\n<p class="sevice-text">[/row]</p>\r\n<p class="sevice-text"> </p>\r\n<p>[row]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[icon name="book"/]</p>\r\n<h3 class="service-heading">Events</h3>\r\n<p class="sevice-text">Donec mauris magna, tincidunt ac ipsum et, ornare pellentesque leo. Sed tempor enim id egestas varius. Donec vel euismod turpis.</p>\r\n<p class="sevice-text">[/col]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[icon name="map-marker"/]</p>\r\n<h3 class="service-heading">Map location &amp; search</h3>\r\n<p class="sevice-text">Quisque vel libero non augue varius tristique sed in metus. Integer pretium sem tortor. Aliquam congue consequat consequat.</p>\r\n<p class="sevice-text">[/col]</p>\r\n<p>[col class="span4"]</p>\r\n<p>[icon name="cog"/]</p>\r\n<h3 class="service-heading">Easy administration</h3>\r\n<p class="sevice-text">Aliquam congue consequat consequat. Quisque vel libero non augue varius tristique sed in metus. Integer pretium sem tortor.</p>\r\n<p class="sevice-text">[/col]</p>\r\n<p class="sevice-text">[/row]</p>\r\n</div>', 1, 'features', 202, '2014-05-16 15:05:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(126, 84, 'JBusinessDirectory - site', '', '', 1, 'dir-search', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jbusinessdirectory', 1, 1, '{"title":"","description":"","base-layout":"default","layout-type":"horizontal","showKeyword":"1","mandatoryKeyword":"0","showCategories":"1","mandatoryCategories":"0","showCities":"1","mandatoryCities":"0","showRegions":"0","mandatoryRegions":"0","showCountries":"0","mandatoryCountries":"0","showZipcode":"1","autocomplete":"1","moduleclass_sfx":"","cache":"1","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(127, 86, 'JBusinessCategories (2)', '', '', 1, 'directory1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_jbusinesscategories', 1, 0, '{"layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(128, 87, 'JBusinessDirectory', '', '', 1, 'feature', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_jbusinessdirectory', 1, 0, '{"title":"","description":"","base-layout":"default","layout-type":"horizontal","showCategories":"1","showCities":"1","showRegions":"0","showCountries":"0","showZipcode":"0","autocomplete":"1","moduleclass_sfx":"","cache":"1","cache_time":"900","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(129, 91, 'JBusinessDirectory - Offers', '', '', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_jbusiness_offers', 1, 1, '', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `#__modules_menu`
--

CREATE TABLE IF NOT EXISTS `#__modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__modules_menu`
--

INSERT INTO `#__modules_menu` (`moduleid`, `menuid`) VALUES
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(79, 0),
(86, 0),
(87, 0),
(88, 105),
(89, 105),
(90, 105),
(92, 105),
(93, 105),
(94, 105),
(96, 105),
(97, 105),
(98, 105),
(100, 101),
(101, 0),
(102, 101),
(102, 104),
(103, 0),
(104, 0),
(105, 0),
(107, 0),
(111, 101),
(112, 101),
(113, 101),
(114, 101),
(115, 101),
(116, 101),
(117, 140),
(118, 101),
(120, 101),
(124, 0),
(125, 101),
(126, -101),
(127, 101),
(128, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__newsfeeds`
--

CREATE TABLE IF NOT EXISTS `#__newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `images` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__overrider`
--

CREATE TABLE IF NOT EXISTS `#__overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__postinstall_messages`
--

CREATE TABLE IF NOT EXISTS `#__postinstall_messages` (
  `postinstall_message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `extension_id` bigint(20) NOT NULL DEFAULT '700' COMMENT 'FK to #__extensions',
  `title_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Lang key for the title',
  `description_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Lang key for description',
  `action_key` varchar(255) NOT NULL DEFAULT '',
  `language_extension` varchar(255) NOT NULL DEFAULT 'com_postinstall' COMMENT 'Extension holding lang keys',
  `language_client_id` tinyint(3) NOT NULL DEFAULT '1',
  `type` varchar(10) NOT NULL DEFAULT 'link' COMMENT 'Message type - message, link, action',
  `action_file` varchar(255) DEFAULT '' COMMENT 'RAD URI to the PHP file containing action method',
  `action` varchar(255) DEFAULT '' COMMENT 'Action method name or URL',
  `condition_file` varchar(255) DEFAULT NULL COMMENT 'RAD URI to file holding display condition method',
  `condition_method` varchar(255) DEFAULT NULL COMMENT 'Display condition method, must return boolean',
  `version_introduced` varchar(50) NOT NULL DEFAULT '3.2.0' COMMENT 'Version when this message was introduced',
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`postinstall_message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__postinstall_messages`
--

INSERT INTO `#__postinstall_messages` (`postinstall_message_id`, `extension_id`, `title_key`, `description_key`, `action_key`, `language_extension`, `language_client_id`, `type`, `action_file`, `action`, `condition_file`, `condition_method`, `version_introduced`, `enabled`) VALUES
(1, 700, 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_TITLE', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_BODY', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_ACTION', 'plg_twofactorauth_totp', 1, 'action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_condition', '3.2.0', 1),
(2, 700, 'COM_CPANEL_MSG_EACCELERATOR_TITLE', 'COM_CPANEL_MSG_EACCELERATOR_BODY', 'COM_CPANEL_MSG_EACCELERATOR_BUTTON', 'com_cpanel', 1, 'action', 'admin://components/com_admin/postinstall/eaccelerator.php', 'admin_postinstall_eaccelerator_action', 'admin://components/com_admin/postinstall/eaccelerator.php', 'admin_postinstall_eaccelerator_condition', '3.2.0', 1),
(4, 700, 'COM_CPANEL_MSG_PHPVERSION_TITLE', 'COM_CPANEL_MSG_PHPVERSION_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/phpversion.php', 'admin_postinstall_phpversion_condition', '3.2.2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__redirect_links`
--

CREATE TABLE IF NOT EXISTS `#__redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__redirect_links`
--

INSERT INTO `#__redirect_links` (`id`, `old_url`, `new_url`, `referer`, `comment`, `hits`, `published`, `created_date`, `modified_date`) VALUES
(1, 'http://localhost/helix/index.php?Itemid=181', '', 'http://localhost/helix/index.php/joomla/registration', '', 1, 0, '2014-02-11 10:23:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `#__schemas`
--

CREATE TABLE IF NOT EXISTS `#__schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__schemas`
--

INSERT INTO `#__schemas` (`extension_id`, `version_id`) VALUES
(10025, '4.1.1');

-- --------------------------------------------------------

--
-- Table structure for table `#__session`
--

CREATE TABLE IF NOT EXISTS `#__session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__session`
--

INSERT INTO `#__session` (`session_id`, `client_id`, `guest`, `time`, `data`, `userid`, `username`) VALUES
('91e37ha2idhkgpv193nkbasec3', 0, 1, '1416845387', '__default|a:8:{s:15:"session.counter";i:4;s:19:"session.timer.start";i:1416845363;s:18:"session.timer.last";i:1416845377;s:17:"session.timer.now";i:1416845385;s:22:"session.client.browser";s:72:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0";s:8:"registry";O:24:"Joomla\\Registry\\Registry":1:{s:7:"\\0\\0\\0data";O:8:"stdClass":0:{}}s:4:"user";O:5:"JUser":25:{s:9:"\\0\\0\\0isRoot";b:0;s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:5:"block";N;s:9:"sendEmail";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:6:"groups";a:1:{i:0;i:1;}s:5:"guest";i:1;s:13:"lastResetTime";N;s:10:"resetCount";N;s:12:"requireReset";N;s:10:"\\0\\0\\0_params";O:24:"Joomla\\Registry\\Registry":1:{s:7:"\\0\\0\\0data";O:8:"stdClass":0:{}}s:14:"\\0\\0\\0_authGroups";a:1:{i:0;i:1;}s:14:"\\0\\0\\0_authLevels";a:2:{i:0;i:1;i:1;i:1;}s:15:"\\0\\0\\0_authActions";N;s:12:"\\0\\0\\0_errorMsg";N;s:10:"\\0\\0\\0_errors";a:0:{}s:3:"aid";i:0;}s:13:"session.token";s:32:"8d95314f4a332793a18f56a4e2c77ede";}', 0, ''),
('kmp01f22438964iv3at5d4vl04', 1, 0, '1416845382', '__default|a:8:{s:15:"session.counter";i:17;s:19:"session.timer.start";i:1416845328;s:18:"session.timer.last";i:1416845381;s:17:"session.timer.now";i:1416845381;s:22:"session.client.browser";s:72:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0";s:8:"registry";O:24:"Joomla\\Registry\\Registry":1:{s:7:"\\0\\0\\0data";O:8:"stdClass":3:{s:11:"application";O:8:"stdClass":1:{s:4:"lang";s:5:"en-GB";}s:13:"com_installer";O:8:"stdClass":3:{s:7:"message";s:0:"";s:17:"extension_message";s:0:"";s:12:"redirect_url";N;}s:13:"com_templates";O:8:"stdClass":1:{s:4:"edit";O:8:"stdClass":1:{s:5:"style";O:8:"stdClass":2:{s:2:"id";a:0:{}s:4:"data";N;}}}}}s:4:"user";O:5:"JUser":27:{s:9:"\\0\\0\\0isRoot";b:1;s:2:"id";s:3:"322";s:4:"name";s:10:"Super User";s:8:"username";s:5:"admin";s:5:"email";s:21:"george.bara@gmail.com";s:8:"password";s:60:"$2y$10$uoCV1uXL.6sdO0p9zjD8GuCgeZFNuIHOfuWubgx0WqakVc6AIpy.O";s:14:"password_clear";s:0:"";s:5:"block";s:1:"0";s:9:"sendEmail";s:1:"1";s:12:"registerDate";s:19:"2014-11-24 16:08:30";s:13:"lastvisitDate";s:19:"0000-00-00 00:00:00";s:10:"activation";s:1:"0";s:6:"params";s:2:"{}";s:6:"groups";a:1:{i:8;s:1:"8";}s:5:"guest";i:0;s:13:"lastResetTime";s:19:"0000-00-00 00:00:00";s:10:"resetCount";s:1:"0";s:12:"requireReset";s:1:"0";s:10:"\\0\\0\\0_params";O:24:"Joomla\\Registry\\Registry":1:{s:7:"\\0\\0\\0data";O:8:"stdClass":0:{}}s:14:"\\0\\0\\0_authGroups";a:2:{i:0;i:1;i:1;i:8;}s:14:"\\0\\0\\0_authLevels";a:5:{i:0;i:1;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:6;}s:15:"\\0\\0\\0_authActions";N;s:12:"\\0\\0\\0_errorMsg";N;s:10:"\\0\\0\\0_errors";a:0:{}s:3:"aid";i:0;s:6:"otpKey";s:0:"";s:4:"otep";s:0:"";}s:13:"session.token";s:32:"7fbc9b247ad849075ddef0c0d11dcc4a";}', 322, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `#__tags`
--

CREATE TABLE IF NOT EXISTS `#__tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tag_idx` (`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__tags`
--

INSERT INTO `#__tags` (`id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `created_by_alias`, `modified_user_id`, `modified_time`, `images`, `urls`, `hits`, `language`, `version`, `publish_up`, `publish_down`) VALUES
(1, 0, 0, 1, 0, '', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 0, '2011-01-01 00:00:01', '', 0, '0000-00-00 00:00:00', '', '', 0, '*', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `#__template_styles`
--

CREATE TABLE IF NOT EXISTS `#__template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `#__template_styles`
--

INSERT INTO `#__template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(5, 'hathor', 1, '0', 'Hathor - Default', '{"showSiteName":"0","colourChoice":"","boldText":"0"}'),
(9, 'protostar', 0, '0', 'protostar - Default', '{"templateColor":"","logoFile":"","googleFont":"1","googleFontName":"Open+Sans","fluidContainer":"0"}'),
(10, 'isis', 1, '1', 'isis - Default', '{"templateColor":"","logoFile":""}'),
(11, 'beez3', 0, '0', 'beez3 - Default', '{"wrapperSmall":53,"wrapperLarge":72,"logo":"","sitetitle":"","sitedescription":"","navposition":"center","bootstrap":"","templatecolor":"nature","headerImage":"","backgroundcolor":"#eee"}'),
(15, 'j-quark', 0, '1', 'J-Quark - Default', '{"layout_width":"1150","layout_type":"responsive","logo_type":"image","logo_position":"logo","logo_type_image":"","logo_type_text":"Helix","logo_type_slogan":"Joomla! Templates Framework","logo_width":"224","logo_height":"50","footer_position":"footer1","showcp":"1","copyright":"Copyright \\u00a9 {year} CMS Junkie Directory - Demo. All Rights Reserved.","show_helix_logo":"0","jcredit":"0","credit_link":"0","validator":"0","showtop":"1","totop_position":"footer2","preset":"preset1","preset1_header":"#f8f8f8","preset1_bg":"#f2f2f2","preset1_text":"#666666","preset1_link":"#0c9fd6","preset2_header":"#eeeeee","preset2_bg":"#f5f5f5","preset2_text":"#444444","preset2_link":"#6d7f1b","preset3_header":"#e5ddd5","preset3_bg":"#f2f2f2","preset3_text":"#333333","preset3_link":"#aa824a","layout":[{"name":"Header","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"4","offset":"","type":"modules","position":"logo","style":"","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"menu","style":"none","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"search","style":"none","customclass":"","responsiveclass":"visible-desktop"}]},{"name":"Slider","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"modules","position":"feature","style":"none","customclass":"","responsiveclass":""}]},{"name":"Search","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"modules","position":"dir-search","style":"sp-xhtml","customclass":"container","responsiveclass":""}]},{"name":"Service","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"modules","position":"features","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Businesses","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"modules","position":"directory4","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Main Body","class":"container","responsive":"","backgroundcolor":"rgba(246, 180, 74, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"3","offset":"","type":"modules","position":"left","style":"xhtml","customclass":"","responsiveclass":""},{"span":"6","offset":"","type":"message","position":"","style":"xhtml","customclass":"","responsiveclass":"","children":[{"name":"Component Area","class":"","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"component","position":"","style":"xhtml","customclass":"","responsiveclass":""}]}]},{"span":"3","offset":"","type":"modules","position":"right","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Breadcrumb","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"12","offset":"","type":"modules","position":"breadcrumb","style":"none","customclass":"","responsiveclass":""}]},{"name":"Users","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"4","offset":"","type":"modules","position":"user1","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"user2","style":"sp_xhtml","customclass":"","responsiveclass":""},{"span":"4","offset":"","type":"modules","position":"user3","style":"sp_xhtml","customclass":"","responsiveclass":""}]},{"name":"Bottom","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"","children":[{"span":"3","offset":"","type":"modules","position":"bottom1","style":"sp_flat","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"bottom2","style":"sp_flat","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"bottom3","style":"sp_flat","customclass":"","responsiveclass":""},{"span":"3","offset":"","type":"modules","position":"bottom4","style":"sp_flat","customclass":"","responsiveclass":""}]},{"name":"Footer","class":"container","responsive":"","backgroundcolor":"rgba(255, 255, 255, 0)","textcolor":"rgba(255, 255, 255, 0)","linkcolor":"rgba(255, 255, 255, 0)","linkhovercolor":"rgba(255, 255, 255, 0)","margin":"","padding":"30px 0","children":[{"span":"6","offset":"","type":"modules","position":"footer1","style":"none","customclass":"","responsiveclass":""},{"span":"6","offset":"","type":"modules","position":"footer2","style":"none","customclass":"","responsiveclass":""}]}],"menu":"mainmenu","menutype":"mega","menu_col_width":"200","show_menu_image":"1","menu_image_position":"1","submenu_position":"0","init_x":"0","init_y":"0","sub_x":"0","sub_y":"0","body_font":"","body_selectors":"","header_font":"","header_selectors":"","other_font":"","other_selectors":"","cache_time":"60","compress_css":"0","compress_js":"0","enable_ga":"0","ga_code":"","loadjquery":"0","loadfromcdn":"0","lessoption":"1","hide_component_area":"0"}');

-- --------------------------------------------------------

--
-- Table structure for table `#__ucm_base`
--

CREATE TABLE IF NOT EXISTS `#__ucm_base` (
  `ucm_id` int(10) unsigned NOT NULL,
  `ucm_item_id` int(10) NOT NULL,
  `ucm_type_id` int(11) NOT NULL,
  `ucm_language_id` int(11) NOT NULL,
  PRIMARY KEY (`ucm_id`),
  KEY `idx_ucm_item_id` (`ucm_item_id`),
  KEY `idx_ucm_type_id` (`ucm_type_id`),
  KEY `idx_ucm_language_id` (`ucm_language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__ucm_content`
--

CREATE TABLE IF NOT EXISTS `#__ucm_content` (
  `core_content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `core_type_alias` varchar(255) NOT NULL DEFAULT '' COMMENT 'FK to the content types table',
  `core_title` varchar(255) NOT NULL,
  `core_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `core_body` mediumtext NOT NULL,
  `core_state` tinyint(1) NOT NULL DEFAULT '0',
  `core_checked_out_time` varchar(255) NOT NULL DEFAULT '',
  `core_checked_out_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `core_access` int(10) unsigned NOT NULL DEFAULT '0',
  `core_params` text NOT NULL,
  `core_featured` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `core_metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `core_created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `core_created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `core_created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_modified_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Most recent user that modified',
  `core_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_language` char(7) NOT NULL,
  `core_publish_up` datetime NOT NULL,
  `core_publish_down` datetime NOT NULL,
  `core_content_item_id` int(10) unsigned DEFAULT NULL COMMENT 'ID from the individual type table',
  `asset_id` int(10) unsigned DEFAULT NULL COMMENT 'FK to the #__assets table.',
  `core_images` text NOT NULL,
  `core_urls` text NOT NULL,
  `core_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `core_version` int(10) unsigned NOT NULL DEFAULT '1',
  `core_ordering` int(11) NOT NULL DEFAULT '0',
  `core_metakey` text NOT NULL,
  `core_metadesc` text NOT NULL,
  `core_catid` int(10) unsigned NOT NULL DEFAULT '0',
  `core_xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `core_type_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`core_content_id`),
  KEY `tag_idx` (`core_state`,`core_access`),
  KEY `idx_access` (`core_access`),
  KEY `idx_alias` (`core_alias`),
  KEY `idx_language` (`core_language`),
  KEY `idx_title` (`core_title`),
  KEY `idx_modified_time` (`core_modified_time`),
  KEY `idx_created_time` (`core_created_time`),
  KEY `idx_content_type` (`core_type_alias`),
  KEY `idx_core_modified_user_id` (`core_modified_user_id`),
  KEY `idx_core_checked_out_user_id` (`core_checked_out_user_id`),
  KEY `idx_core_created_user_id` (`core_created_user_id`),
  KEY `idx_core_type_id` (`core_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains core content data in name spaced fields' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__ucm_history`
--

CREATE TABLE IF NOT EXISTS `#__ucm_history` (
  `version_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ucm_item_id` int(10) unsigned NOT NULL,
  `ucm_type_id` int(10) unsigned NOT NULL,
  `version_note` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional version name',
  `save_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `character_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Number of characters in this version.',
  `sha1_hash` varchar(50) NOT NULL DEFAULT '' COMMENT 'SHA1 hash of the version_data column.',
  `version_data` mediumtext NOT NULL COMMENT 'json-encoded string of version data',
  `keep_forever` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=auto delete; 1=keep',
  PRIMARY KEY (`version_id`),
  KEY `idx_ucm_item_id` (`ucm_type_id`,`ucm_item_id`),
  KEY `idx_save_date` (`save_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__updates`
--

CREATE TABLE IF NOT EXISTS `#__updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(32) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  `extra_query` varchar(1000) DEFAULT '',
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__update_sites`
--

CREATE TABLE IF NOT EXISTS `#__update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  `extra_query` varchar(1000) DEFAULT '',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `#__update_sites`
--

INSERT INTO `#__update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`, `last_check_timestamp`, `extra_query`) VALUES
(1, 'Joomla Core', 'collection', 'http://update.joomla.org/core/list.xml', 1, 1416845335, ''),
(2, 'Joomla Extension Directory', 'collection', 'http://update.joomla.org/jed/list.xml', 0, 0, ''),
(3, 'Accredited Joomla! Translations', 'collection', 'http://update.joomla.org/language/translationlist_3.xml', 1, 0, ''),
(4, 'System - Helix Framework', 'plugin', 'http://joomshaper.com/updates/plg_system_helix.xml', 1, 0, ''),
(5, 'System - Helix Framework', 'extension', 'http://www.joomshaper.com/updates/plg_system_helix.xml', 0, 0, ''),
(6, 'WebInstaller Update Site', 'extension', 'http://appscdn.joomla.org/webapps/jedapps/webinstaller.xml', 1, 0, ''),
(11, 'J-BusinessDirectory Updates', 'extension', 'http://updates.cmsjunkie.com/directory/j-businessdirectory3.xml', 1, 0, ''),
(12, 'Joomla! Update Component Update Site', 'extension', 'http://update.joomla.org/core/extensions/com_joomlaupdate.xml', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `#__update_sites_extensions`
--

CREATE TABLE IF NOT EXISTS `#__update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

--
-- Dumping data for table `#__update_sites_extensions`
--

INSERT INTO `#__update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(2, 700),
(3, 600),
(4, 10000),
(5, 10000),
(6, 10005),
(11, 10025),
(12, 28);

-- --------------------------------------------------------

--
-- Table structure for table `#__usergroups`
--

CREATE TABLE IF NOT EXISTS `#__usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `#__usergroups`
--

INSERT INTO `#__usergroups` (`id`, `parent_id`, `lft`, `rgt`, `title`) VALUES
(1, 0, 1, 18, 'Public'),
(2, 1, 8, 15, 'Registered'),
(3, 2, 9, 14, 'Author'),
(4, 3, 10, 13, 'Editor'),
(5, 4, 11, 12, 'Publisher'),
(6, 1, 4, 7, 'Manager'),
(7, 6, 5, 6, 'Administrator'),
(8, 1, 16, 17, 'Super Users'),
(9, 1, 2, 3, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `#__users`
--

CREATE TABLE IF NOT EXISTS `#__users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) NOT NULL DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  `otpKey` varchar(1000) NOT NULL DEFAULT '' COMMENT 'Two factor authentication encrypted keys',
  `otep` varchar(1000) NOT NULL DEFAULT '' COMMENT 'One time emergency passwords',
  `requireReset` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Require user to reset password on next login',
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=823 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__user_keys`
--

CREATE TABLE IF NOT EXISTS `#__user_keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `invalid` tinyint(4) NOT NULL,
  `time` varchar(200) NOT NULL,
  `uastring` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `series` (`series`),
  UNIQUE KEY `series_2` (`series`),
  UNIQUE KEY `series_3` (`series`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__user_notes`
--

CREATE TABLE IF NOT EXISTS `#__user_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__user_profiles`
--

CREATE TABLE IF NOT EXISTS `#__user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Table structure for table `#__user_usergroup_map`
--

CREATE TABLE IF NOT EXISTS `#__user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__user_usergroup_map`
--

INSERT INTO `#__user_usergroup_map` (`user_id`, `group_id`) VALUES
(322, 8);

-- --------------------------------------------------------

--
-- Table structure for table `#__viewlevels`
--

CREATE TABLE IF NOT EXISTS `#__viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `#__viewlevels`
--

INSERT INTO `#__viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Public', 0, '[1]'),
(2, 'Registered', 1, '[6,2,8]'),
(3, 'Special', 2, '[6,3,8]'),
(5, 'Guest', 0, '[9]'),
(6, 'Super Users', 0, '[8]');

-- --------------------------------------------------------

--
-- Table structure for table `#__weblinks`
--

CREATE TABLE IF NOT EXISTS `#__weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `images` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

