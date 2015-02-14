DROP TABLE IF EXISTS `#__briefcasefactory_files`;
CREATE TABLE `#__briefcasefactory_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `share_public` tinyint(1) NOT NULL,
  `share_until` datetime NOT NULL,
  `valid_until` datetime NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `share_public` (`share_public`),
  KEY `share_until` (`share_until`),
  KEY `user_id` (`user_id`),
  KEY `folder_id` (`folder_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__briefcasefactory_folders`;
CREATE TABLE `#__briefcasefactory_folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `general` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `share_public` tinyint(1) NOT NULL,
  `share_until` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `share_public` (`share_public`),
  KEY `share_until` (`share_until`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__briefcasefactory_folders` (`id`, `user_id`, `general`, `parent_id`, `category_id`, `level`, `lft`, `rgt`, `alias`, `path`, `title`, `share_public`, `share_until`) VALUES
(1,	0,	0,	0,	0,	0,	0,	1,	'',	'',	'',	0,	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `#__briefcasefactory_notifications`;
CREATE TABLE `#__briefcasefactory_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `lang_code` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `lang_code` (`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__briefcasefactory_notifications` (`id`, `type`, `lang_code`, `subject`, `body`, `published`) VALUES
(1,	'public_shared_file',	'*',	'New public shared file',	'<p>Hello %%receiver_username%%!</p>\r\n<p>%%owner_username%% has shared the file <a href=\"%%file_link%%\">%%file_name%%</a> publicly on %%date%%. Click on the link below (or copy/paste it in the browser\'s address bar) to download it:</p>\r\n<p><a href=\"%%file_link%%\">%%file_link%%</a>    </p>\r\n<p> </p>\r\n<p>Regards,</p>\r\n<p>Briefcase Factory Team!</p>',	1),
(2,	'private_group_shared_file',	'*',	'New group shared file',	'<p>Hello %%receiver_username%%!</p>\r\n<p>%%owner_username%% has shared the file <a href=\"%%file_link%%\">%%file_name%%</a> with group %%group%% on %%date%%. Click on the link below (or copy/paste it in the browser\'s address bar) to download it:</p>\r\n<p><a href=\"%%file_link%%\">%%file_link%%</a>    </p>\r\n<p> </p>\r\n<p>Regards,</p>\r\n<p>Briefcase Factory Team!</p>',	1),
(3,	'private_user_shared_file',	'*',	'New user shared file',	'<p>Hello %%receiver_username%%!</p>\r\n<p>%%owner_username%% has shared the file <a href=\"%%file_link%%\">%%file_name%%</a> with you on %%date%%. Click on the link below (or copy/paste it in the browser\'s address bar) to download it:</p>\r\n<p><a href=\"%%file_link%%\">%%file_link%%</a>    </p>\r\n<p> </p>\r\n<p>Regards,</p>\r\n<p>Briefcase Factory Team!</p>',	1),
(4,	'file_upload_for_other_user',	'*',	'A new file has been uploaded to your Briefcase',	'<p>Hello {{ receiver_username }}!</p>\r\n<p>A new file (<a href=\"{{ file_link }}\">{{ file_name }}</a>) has been uploaded by {{ uploader_username }} to your Briefcase on {{ date }}!</p>\r\n<p>Regards,</p>\r\n<p>Briefcase Factory Team!</p>',	1);

DROP TABLE IF EXISTS `#__briefcasefactory_shares_files`;
CREATE TABLE `#__briefcasefactory_shares_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `until` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `type` (`type`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__briefcasefactory_shares_folders`;
CREATE TABLE `#__briefcasefactory_shares_folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `until` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `folder_id` (`folder_id`),
  KEY `type` (`type`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__briefcasefactory_users`;
CREATE TABLE `#__briefcasefactory_users` (
  `user_id` int(11) NOT NULL,
  `params` mediumtext NOT NULL,
  `notification_public` tinyint(1) NOT NULL,
  `notification_user` tinyint(1) NOT NULL,
  `notification_group` tinyint(1) NOT NULL,
  `notification_file_upload_other_user` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
