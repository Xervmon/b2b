
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

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_cities`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  KEY `idx_name` (`name`),
  KEY `idx_keywords` (`keywords`),
  KEY `idx_description` (`description`(100)),
  KEY `idx_city` (`city`),
  KEY `idx_county` (`county`),
  KEY `idx_maincat` (`mainSubcategory`),
  KEY `idx_zipcode` (`latitude`,`longitude`),
  KEY `idx_phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

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
  `county` varchar(45) DEFAULT NULL,
  `publish_start_date` date DEFAULT NULL,
  `publish_end_date` date DEFAULT NULL,
  `view_type` tinyint(2) NOT NULL DEFAULT '0',
  `url` varchar(145) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
