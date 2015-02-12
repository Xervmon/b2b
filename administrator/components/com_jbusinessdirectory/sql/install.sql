DROP TABLE IF EXISTS `#__jbusinessdirectory_applicationsettings`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_banners`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_banner_types`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_categories`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_companies`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_category`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_contact`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_claim`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_images`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_contact`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_offers`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_offer_pictures`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_pictures`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_ratings`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_reviews`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_review_abuses`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_review_responses`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_types`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_videos`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_countries`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_currencies`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_date_formats`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_emails`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_packages`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_package_fields`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_orders`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_payment_processors`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_payment_processor_fields`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_attributes`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_attribute_options`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_attribute_types`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_attributes`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_payments`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_events`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_event_pictures`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_event_types`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_default_attributes`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_cities`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_activity_city`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_reports`;
DROP TABLE IF EXISTS `#__jbusinessdirectory_company_locations`;


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
(1, 'JBusinessDirectory', 'office@site.com', 143, '', 'style.css', 1, 'en-GB', 2, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 3, 3, 1, 0, 5, 0, 1, '', '', '', '0', '1', '1', '0', '0', '0', '', NULL, NULL, '1', '', 0, 0, 1, 0, 10, 15, 0, 0, 0, 0);

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
(1, 0, 'Automotive & Motors', 'automotive-motors', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image4-1411751295.jpg', '/categories/marker_auto-1411754020.png'),
(29, 0, 'Health & Beauty', 'grocery-health-beauty', '', 1, '/categories/image7-1411751543.jpg', '/categories/marker_health-1411754146.png'),
(3, 0, 'Services', 'services', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image9-1411751440.png', '/categories/marker_service-1411754187.png'),
(30, 0, 'Jewelry & Watches', 'jewelry-watches', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image12-1411751408.jpg', '/categories/marker_electronics-1411754433.png'),
(5, 0, 'Sports & Outdors', 'sports-outdors', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image3-1411751531.jpg', '/categories/marker_sport-1411754446.png'),
(31, 7, 'Cell Phones & Accessories', 'cell-phones-&-accessories', '', 1, '', NULL),
(7, 0, 'Electronics', 'electronics', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image1-1411751352.jpg', '/categories/marker_electronics-1411754102.png'),
(8, 0, 'Fashion', 'fashion', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image8-1411751366.jpg', '/categories/marker_mask-1411754410.png'),
(9, 0, 'Toy,Kids & Babies', 'toy-kids-babies', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image6-1411751447.jpg', '/categories/marker_electronics-1411754456.png'),
(10, 0, 'Movies, Music & Games', 'movies-music-games', '', 1, '/categories/image5-1411751431.jpg', '/categories/marker_music-1411754173.png'),
(11, 0, 'Home & Garden', 'home-garden', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image10-1411751395.jpg', '/categories/marker_home-1411754161.png'),
(12, 0, 'Books', 'books', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image11-1411751324.jpg', '/categories/marker_book-1411754028.png'),
(13, 0, 'Camera & Photography', 'camera-photography', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image2-1411751337.jpg', '/categories/marker_photo-1411754091.png'),
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
(71, 0, 'TV &  Audio', 'tv-audio', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices po', 1, '/categories/image-1411751466.jpg', '/categories/marker_electronics-1411754489.png'),
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
  `modified` DATETIME  DEFAULT NULL ,
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

--
-- Dumping data for table `#__jbusinessdirectory_companies`
--

INSERT INTO `#__jbusinessdirectory_companies` (`id`, `name`, `alias`, `comercialName`, `short_description`, `description`, `street_number`, `address`, `city`, `county`, `countryId`, `website`, `keywords`, `registrationCode`, `phone`, `email`, `fax`, `state`, `typeId`, `logoLocation`, `creationDate`, `modified`, `mainSubcategory`, `latitude`, `longitude`, `activity_radius`, `userId`, `averageRating`, `approved`, `viewCount`, `websiteCount`, `contactCount`, `taxCode`, `package_id`, `facebook`, `twitter`, `googlep`, `postalCode`, `mobile`, `slogan`, `publish_only_city`, `featured`) VALUES
(1, 'Wedding company', 'wedding-company', 'Home & Gardem', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '122', 'Chestnut', 'Toronto', 'Ontario', 36, 'http://garden.com', 'ksldjfds', '342423422', '34242123123', 'email@decoration.com', '434312312321', 1, 1, '/companies/1/logo7-1392042517.jpg', '0000-00-00 00:00:00', '2014-09-26 10:46:47', 42, '43.654614783423014', '-79.3860912322998', 0, 0, 4, 2, 13, 0, 0, '123123', 4, '', '', '', '3213123', '', '', 0, 0),
(4, 'Property inc', 'property-inc', 'Rent a car', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mollis justo nulla, a tempus elit pulvinar eget. Nunc tempus leo in arcu mattis lobortis. Fusce ut sollicitudin nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet feugiat ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mollis justo nulla, a tempus elit pulvinar eget. Nunc tempus leo in arcu mattis lobortis. Fusce ut sollicitudin nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet feugiat lectus id ornare. Nulla ut odio eget justo faucibus consectetur. Ut faucibus ultrices accumsan. Aenean leo neque, accumsan ac eleifend vel, pulvinar id urna. Phasellus non malesuada augue. Maecenas id egestas quam, at molestie tortor. Sed quis dictum eros.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mollis justo nulla, a tempus elit pulvinar eget. Nunc tempus leo in arcu mattis lobortis. Fusce ut sollicitudin nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet feugiat lectus id ornare. Nulla ut odio eget justo faucibus consectetur. Ut faucibus ultrices accumsan. Aenean leo neque, accumsan ac eleifend vel, pulvinar id urna. Phasellus non malesuada augue. Maecenas id egestas quam, at molestie tortor. Sed quis dictum eros.</p>', '11', 'Young Street', 'Toronto', 'Ontario', 36, 'http://google.com', '', '123123123', '0010727321321', 'office@email.com', '0010269/220123', 1, 1, '/companies/4/logo3-1392041714.jpg', '0000-00-00 00:00:00', '2014-09-26 12:21:14', 3, '43.64208175305137', '-79.3842687603319', 0, 0, 5, 2, 1, 0, 0, '123123', 2, '', '', '', '23123213', '', '', 0, 0),
(5, 'Organic food', 'organic-food', 'AQUACON PROJECT', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '44', 'Young Street', 'Toronto', 'Ontario', 36, '', '', '2321111', '0727321321', 'office@site.com', '0269/220123', 1, 5, '/companies/5/logo5-1392042368.jpg', '2011-11-24 07:30:40', NULL, 61, '43.650081332730466', '-79.37849521636963', 15, 0, 3, 2, 3, 0, 0, '123', 2, '', '', '', '1312312', '', '', 0, 0),
(7, 'NOBLESSE', 'noblesse', 'FINE JEWELERY', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '33', 'Richmong', 'Toronto', 'Ontario', 36, 'http://www.cmsjunkie.com', 'keywords1', '343243', '123123', 'office@shopping.com', '213123', 1, 8, '/companies/7/logo2-1392042326.jpg', '2011-11-24 07:31:39', NULL, 43, '43.649677652720534', '-79.37798023223877', 30, 0, 3.5, 2, 6, 0, 0, '123123', 2, '', '', '', '23213', '', '', 0, 0),
(8, 'It Company', 'it-company', 'Contruction Company', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '22', 'Lawrance', 'Toronto', 'Ontario', 36, 'http://google.com', '', '343412', '0727321321', 'office@site.com', '0269/220123', 1, 5, '/companies/8/logo6-1392042283.jpg', '2011-11-24 07:32:07', '2014-09-26 16:21:03', 14, '43.65057816594119', '-79.37493324279785', 0, 0, 4.5, 2, 8, 0, 0, '12312', 4, '', '', '', '23123123', '', '', 0, 0),
(9, 'Coffe delights', 'coffe-delights', 'IT Services', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '32', 'Queen Street', 'Toronto', 'Ontario', 36, 'http://google.com', '', '3424234221212', '0727321321', 'office@company.com', '0010269/220123', 1, 4, '/companies/9/logo4-1392042222.jpg', '2011-12-01 12:24:29', '2014-09-26 11:17:51', 40, '43.650391853968806', '-79.38038349151611', 20, 0, 1.5, 2, 9, 0, 0, '123123', 1, '', '', '', '123213123', '', '', 0, 0),
(12, 'Better Health', 'better-health', 'Almedia', '', '<p>Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper ante ac nunc commodo vitae rutrum sem placerat. Morbi et nisi metus.</p>', '74444', 'Peg Keller Rd', 'Abita Springs', 'Louisiana', 226, 'http://www.cmsjunkie.com', '', 'RT545412SD', '001010727321321', 'directory@director.com', '', 1, 8, '/companies/12/logo1-1392042568.jpg', '2011-12-02 13:32:19', '2014-09-26 10:46:57', 5, '43.65538688599313', '-79.35828778892756', 20, 0, 4.25, 2, 69, 0, 0, '123123123', 3, 'http://https://www.facebook.com/cmsjunkie', 'http://https://twitter.com/cmsjunkie', 'http://https://plus.google.com/100376620356699373069/posts', '70420', '', '', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_activity_city`
--

INSERT INTO `#__jbusinessdirectory_company_activity_city` (`id`, `company_id`, `city_id`) VALUES
(24, 1, -1),
(27, 4, -1),
(23, 8, -1),
(26, 9, -1),
(25, 12, -1);

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
(4, 43),
(4, 63),
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
(8, 21),
(8, 22),
(8, 23),
(8, 43),
(9, 21),
(9, 22),
(9, 35),
(9, 36),
(9, 40),
(9, 42),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_contact`
--

INSERT INTO `#__jbusinessdirectory_company_contact` (`id`, `companyId`, `contact_name`, `contact_function`, `contact_department`, `contact_email`, `contact_phone`, `contact_fax`) VALUES
(1, 8, '', NULL, NULL, '', '', ''),
(2, 1, '', NULL, NULL, '', '', ''),
(3, 12, '', NULL, NULL, '', '', ''),
(4, 9, '', NULL, NULL, '', '', ''),
(5, 4, '', NULL, NULL, '', '', '');

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
(9, 8, 'Celebration Party', 'celebration-party', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan enim dignissim consectetur viverra. Vestibulum a erat vitae quam pellentesque varius vel at ipsum. Pellentesque ultricies porttitor bibendum. Donec et justo quis tortor egestas rhoncus hendrerit ac massa. Sed tempus iaculis mi at sollicitudin. Etiam a ligula eget magna condimentum consectetur non pulvinar purus. Phasellus quis lobortis mauris. Nullam eleifend iaculis sem, nec hendrerit quam molestie vitae.\r\n\r\nCras condimentum, augue at pretium pellentesque, ipsum arcu ullamcorper erat, eu laoreet libero erat id erat. Vestibulum ut dolor commodo, condimentum purus in, egestas purus. In hac habitasse platea dictumst. Nam rutrum sapien quam, in viverra libero interdum a. Vivamus sollicitudin dolor eget tincidunt faucibus. Cras pretium justo neque, quis imperdiet nulla vehicula a. Nulla facilisi. Aliquam justo ligula, fringilla vel orci in, imperdiet aliquam elit. Vivamus ac lorem blandit, tempor felis eget, placerat lectus. ', 'Toronto, Canada', 4, '2014-11-21', NULL, '2014-11-22', NULL, 1, 1, 0),
(10, 8, 'Business Presentation', 'business-presentation', 'Nulla consectetur magna et cursus sagittis. Quisque ac consectetur elit. Ut volutpat tellus non orci fermentum, sit amet tincidunt quam scelerisque. Integer eleifend congue eros pellentesque pharetra. Integer sed diam lectus. Donec ultricies, arcu a vulputate fringilla, nisi quam vestibulum libero, faucibus bibendum nunc justo sed ante. Etiam luctus quis nisl nec ornare. Fusce urna leo, tincidunt at commodo non, vestibulum et erat. In faucibus posuere purus, at egestas dolor dictum ac. Maecenas volutpat lectus eget purus hendrerit, sit amet hendrerit diam mattis. Nulla imperdiet metus ac metus molestie, sed imperdiet leo eleifend. Fusce non tellus porta risus convallis vehicula. Donec quis convallis ligula. ', 'Gamble Avenue, Toronto, Canada', 5, '2014-11-21', NULL, '2014-11-21', NULL, 1, 1, 0),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_event_pictures`
--

INSERT INTO `#__jbusinessdirectory_company_event_pictures` (`id`, `eventId`, `picture_info`, `picture_path`, `picture_enable`) VALUES
(15, 9, '', 0x2f6576656e74732f392f70617274795f74696d655f77616c6c70617065725f65613364302d313338353033383239322e6a7067, 1),
(14, 9, '', 0x2f6576656e74732f392f70696e6b20706172747920776964652077616c6c70617065722d313338353033383239302e6a7067, 1),
(10, 11, '', 0x2f6576656e74732f31312f636f6d6d756e69636174696f6e5f736b696c6c2d313338353033383832352e6a7067, 1),
(11, 10, '', 0x2f6576656e74732f31302f696d616765362d313338353033383630322e706e67, 1),
(12, 10, '', 0x2f6576656e74732f31302f696d616765372d313338353033383630352e706e67, 1),
(13, 10, '', 0x2f6576656e74732f31302f696d616765352d313338353033383631332e706e67, 1),
(16, 9, '', 0x2f6576656e74732f392f696d616765732d313338353033383239342e6a7067, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_offers`
--

INSERT INTO `#__jbusinessdirectory_company_offers` (`id`, `companyId`, `subject`, `description`, `price`, `specialPrice`, `startDate`, `endDate`, `state`, `approved`, `offerOfTheDay`, `viewCount`, `alias`, `address`, `city`, `short_description`, `county`, `publish_start_date`, `publish_end_date`, `view_type`, `url`, `article_id`, `latitude`, `longitude`) VALUES
(3, 12, 'Buy one get one free', 'Etiam eget urna est. Nullam turpis magna, pharetra id venenatis id, adipiscing at velit. In lobortis ornare congue. Sed vitae neque lacus, et rutrum lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque quis rhoncus felis. Sed adipiscing tellus laoreet neque adipiscing ac euismod felis gravida. Aenean fermentum, nulla non adipiscing tristique, lacus justo ornare nunc, eu aliquam nunc massa non justo. Sed at sapien vitae eros luctus condimentum non at libero. Morbi id arcu nec mi suscipit molestie. Integer ullamcorper suscipit erat, quis convallis quam interdum convallis. Sed lectus justo, vehicula et euismod rhoncus, tempus vel magna. Pellentesque laoreet, odio id iaculis bibendum, erat quam mollis urna, ac pretium neque mi vitae nisl. Fusce euismod bibendum risus vel suscipit. Suspendisse sapien tortor, vehicula sed lobortis tempus, pellentesque ut lectus.', 120, 110, '2014-01-01', '2015-02-10', 1, 1, 1, 10, 'buy-one-get-one-free', '7777 Forest Blvd', 'Dallas', 'Etiam eget urna est. Nullam turpis magna, pharetra id venenatis id, adipiscing at velit. In lobortis ornare congue. Sed vitae neque lacus, et rutrum lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;', 'Texas', '0000-00-00', '0000-00-00', 1, '', 0, '32.9113547', '-96.77428509999999'),
(13, 12, 'Special Offer', 'Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc. Proin pellentesque, lorem porttitor commodo hendrerit, enim leo mattis risus, ac viverra ante tellus quis velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi dignissim tristique sapien ut pretium. Duis sollicitudin dolor sed nisi venenatis quis fringilla diam suscipit. Sed convallis lectus non nibh suscipit ullamcorper. Fusce in magna ac lacus semper convallis. Morbi sagittis auctor massa vel consequat. Nulla fermentum, sapien a sagittis accumsan, tellus ipsum posuere tellus, a lacinia tortor lacus in nisl. Vestibulum posuere dictum ipsum ac viverra. Integer neque neque, blandit non adipiscing vel, auctor non odio. Maecenas quis nibh a diam eleifend rhoncus sed in turpis. Pellentesque mollis fermentum dolor et mollis. Cum sociis natoque penatibus et mag', 69.99, 49.99, '2015-01-03', '2015-01-04', 1, 1, 1, 5, 'special-offer', 'Country Hills Blvd NW', 'Beaumont', 'Quisque cursus nunc ut diam pulvinar luctus. Nulla facilisi. Donec porta lorem id diam malesuada nec pretium enim euismod. Donec massa augue, lobortis eu cursus in, tincidunt ut nunc', 'Texas', '0000-00-00', '0000-00-00', 1, '', 0, '43.70957890823799', '-79.50366217643023'),
(14, 8, 'Register now and get 10% off', ' Duis faucibus odio quis sapien imperdiet, nec congue turpis pellentesque. Integer mi turpis, eleifend et mollis eu, dapibus quis elit. Pellentesque at turpis urna. Sed scelerisque Diam scelerisque fermentum finibus. Mauris elementum euismod erat sed condimentum. Nulla imperdiet mattis massa, at fermentum erat tristique ac. Praesent eget velit maximus, blandit nisi at, porta ligula. Etiam quis libero nisl. Vestibulum quis ornare dui. Suspendisse quis lobortis nunc. Pellentesque quis pharetra metus. Phasellus vulputate orci in pharetra feugiat. Etiam vehicula lacus augue, et lacinia turpis mollis id.\r\n\r\nPhasellus sed feugiat nunc, sed pharetra risus. Etiam eleifend quis lectus et gravida. Nunc pretium nisi id mi maximus mollis. Aliquam tempus dictum mi. Donec cursus pharetra neque, at gravida dolor vestibulum sit amet. Donec quam urna, molestie pharetra venenatis in, tincidunt quis elit. Praesent pharetra eget metus vitae vestibulum. Mauris gravida turpis lorem, aliquam semper justo auc.', 0, 0, '2014-09-25', '2014-09-25', 1, 0, 0, 2, 'register-now-and-get-10-off', 'Chopin Ave', 'Toronto', 'Diam scelerisque fermentum finibus. Mauris elementum euismod erat sed condimentum. Nulla imperdiet mattis massa, at fermentum erat tristique ac. Praesent eget velit maximus, blandit nisi at, porta ligula.', 'Ontario', '0000-00-00', '0000-00-00', 1, '', 0, '43.737594787503966', '-79.27854752537314'),
(15, 1, 'Book now and get 20 % off', 'Morbi porta luctus enim at scelerisque. Cras imperdiet nibh eget commodo blandit. Aliquam nec commodo lectus. Donec pellentesque, massa quis porta aliquet, massa metus accumsan metus, nec dignissim tortor mi eu erat. Phasellus pulvinar metus a tortor eleifend, a hendrerit tortor rutrum. Aliquam in tellus gravida, varius sem quis, interdum elit. Pellentesque nec egestas augue. Donec ullamcorper ante eu libero hendrerit, vel tempus dolor dapibus. Quisque finibus nisi eu sem venenatis porta. Praesent tempor nisi urna.\r\n\r\nInteger convallis dolor id ullamcorper consectetur. Morbi sodales mi et orci sollicitudin, sit amet pretium ante vulputate. Nullam ultrices vehicula urna in condimentum. Nulla lacus tortor, lobortis pulvinar turpis vitae, hendrerit gravida enim. Vestibulum eros magna, elementum ut pulvinar eget, placerat et augue. Vestibulum eget sapien vitae dui facilisis maximus a vel ligula. Nunc urna tortor, lobortis eu interdum vitae, mattis sit amet libero. Phasellus quis dapibus arcu, vulputate hendrerit est. Ut mattis bibendum gravida. Ut molestie ornare sapien nec dictum. ', 0, 0, '2014-09-26', '2015-12-31', 1, 0, 0, 2, 'book-now-and-get-20-off', 'Chopin Ave', 'Toronto', 'Morbi porta luctus enim at scelerisque. Cras imperdiet nibh eget commodo blandit. Aliquam nec commodo lectus. Donec pellentesque, massa quis porta aliquet, massa metus accumsan metus, nec dignissim tortor mi eu erat. Phasellus pulvinar metus a torto', 'Ontario', '0000-00-00', '0000-00-00', 1, '', 0, '43.737032009283475', '-79.27838659283225'),
(16, 1, 'Special Offer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas maximus arcu a posuere. Phasellus eget tellus ac purus vulputate auctor. Donec nec semper elit, quis iaculis purus. Praesent vitae facilisis enim. Vestibulum laoreet tristique velit quis porttitor. Nam venenatis vestibulum est ut aliquam. Vivamus placerat sollicitudin est ut aliquet. Fusce imperdiet auctor felis, ut egestas sem condimentum sed. Pellentesque porta sit amet justo non imperdiet. Mauris leo lorem, ultricies eu consectetur eu, laoreet nec tortor.\r\n\r\nIn hac habitasse platea dictumst. Donec facilisis nulla vitae est vulputate feugiat. Nam consequat orci elit, quis condimentum massa aliquet id. Sed tortor est, dictum ac viverra a, aliquam vel lectus. Ut non ipsum sodales, cursus neque id, sollicitudin nunc. Duis vitae placerat lacus. Vestibulum sit amet neque congue, euismod diam id, sagittis felis. Aenean fringilla tempor velit sit amet pretium. Praesent sollicitudin libero in quam semper, ac vestibulum libero tempus. Integer euismod ipsum et varius mollis. ', 0, 0, '2014-09-26', '2016-09-26', 1, 0, 0, 0, 'special-offer', '130 Yorkland Boulevard', 'Beaumont', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas maximus arcu a posuere. Phasellus eget tellus ac purus vulputate auctor. Donec nec semper elit, quis iaculis purus.', 'Texas', '0000-00-00', '0000-00-00', 1, '', 0, '29.874468564024614', '-94.1099853347987');

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_company_offer_category`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_company_offer_category` (
  `offerId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`offerId`,`categoryId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jbusinessdirectory_company_offer_category`
--

INSERT INTO `#__jbusinessdirectory_company_offer_category` (`offerId`, `categoryId`) VALUES
(14, 12),
(14, 14),
(14, 21),
(16, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_offer_pictures`
--

INSERT INTO `#__jbusinessdirectory_company_offer_pictures` (`id`, `offerId`, `picture_info`, `picture_path`, `picture_enable`) VALUES
(24, 13, '', 0x2f6f66666572732f31332f696d616765342d313337333930333838352e706e67, 1),
(23, 13, '', 0x2f6f66666572732f31332f696d616765332d313337333930333836312e6a7067, 1),
(26, 3, '', 0x2f6f66666572732f332f696d616765362d313337333930333930352e706e67, 1),
(25, 3, '', 0x2f6f66666572732f332f696d616765342d313337333930333930312e706e67, 1),
(43, 15, '', 0x2f6f66666572732f31352f4b696e67526f6f6d2d313431313734343133302e6a7067, 1),
(44, 15, '', 0x2f6f66666572732f31352f696e742d67756573742d726f6f6d73312d313431313734343133342e6a7067, 1),
(42, 15, '', 0x2f6f66666572732f31352f6e65775f796f726b5f6e65775f796f726b5f686f74656c5f636173696e6f5f6c61735f76656761735f73747269702d6c61735f76656761732d313431313734343133392e6a7067, 1),
(46, 16, '', 0x2f6f66666572732f31362f3133353746756c6c4d6f6f6e526973696e675f706963312d313431313734343339392e6a7067, 1),
(47, 14, '', 0x2f6f66666572732f31342f696d616765732d313431313635373333362e6a7067, 1),
(48, 14, '', 0x2f6f66666572732f31342f70696e6b20706172747920776964652077616c6c70617065722d313431313635373334322e6a7067, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_pictures`
--

INSERT INTO `#__jbusinessdirectory_company_pictures` (`id`, `companyId`, `picture_info`, `picture_path`, `picture_enable`) VALUES
(220, 7, '', 0x2f636f6d70616e6965732f372f656c656374726f6e6963732e6a7067, 1),
(225, 1, '', 0x2f636f6d70616e6965732f312f696d616765362e706e67, 1),
(221, 7, '', 0x2f636f6d70616e6965732f372f696d616765732e6a7067, 1),
(224, 1, '', 0x2f636f6d70616e6965732f312f696d616765342e706e67, 1),
(226, 12, '', 0x2f636f6d70616e6965732f31322f686f74656c5f726f6f6d2e6a7067, 1),
(229, 9, '', 0x2f636f6d70616e6965732f392f696d616765352e706e67, 1),
(231, 8, '', 0x2f636f6d70616e6965732f382f696d616765362e706e67, 1),
(230, 8, '', 0x2f636f6d70616e6965732f382f696d616765372e706e67, 1),
(228, 9, '', 0x2f636f6d70616e6965732f392f696d616765342e706e67, 1),
(227, 12, '', 0x2f636f6d70616e6965732f31322f696d616765372d313338353033373739362e706e67, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
(7, 9, 1.5, '5.15.238.52'),
(8, 8, 5, '127.0.0.1'),
(9, 1, 5, '127.0.0.1');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jbusinessdirectory_company_reviews`
--

INSERT INTO `#__jbusinessdirectory_company_reviews` (`id`, `name`, `subject`, `description`, `userId`, `likeCount`, `dislikeCount`, `state`, `companyId`, `creationDate`, `aproved`, `ipAddress`, `abuseReported`, `rating`) VALUES
(1, 'Kelly Smith', 'Very impresive', 'I had such a good experience with this company.', 0, 0, 0, 1, 1, '2014-09-26 15:18:03', 0, '127.0.0.1', 0, 5),
(2, 'Kevin', 'The best experience ever', 'Pellentesque convallis est vel velit luctus, in consequat tortor rutrum. In lectus quam, tempor eu diam efficitur, fringilla aliquet sapien. Praesent quis tellus id enim imperdiet tempor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras interdum ut ante non porta.', 0, 0, 0, 1, 8, '2014-09-26 18:43:50', 0, '127.0.0.1', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__jbusinessdirectory_orders`
--

INSERT INTO `#__jbusinessdirectory_orders` (`id`, `order_id`, `company_id`, `package_id`, `amount`, `amount_paid`, `created`, `paid_at`, `state`, `transaction_id`, `user_name`, `service`, `description`, `start_date`, `type`, `currency`, `expiration_email_date`) VALUES
(1, 'Upgrade-Package: Premium Package', 8, 4, '99.99', NULL, '2014-09-26 13:46:35', '2014-09-26 00:00:00', 1, '', NULL, 'It Company', 'Upgrade-Package: Premium Package', '2014-09-26', 1, 'USD', NULL),
(2, 'Upgrade-Package: Premium Package', 1, 4, '99.99', NULL, '2014-09-26 13:46:47', '2014-09-26 00:00:00', 1, '', NULL, 'Wedding company', 'Upgrade-Package: Premium Package', '2014-09-26', 1, 'USD', NULL),
(3, 'Upgrade-Package: Gold Package', 12, 3, '59.99', NULL, '2014-09-26 13:46:57', '2014-09-26 00:00:00', 1, '', NULL, 'Better Health', 'Upgrade-Package: Gold Package', '2014-09-26', 1, 'USD', NULL),
(4, 'Upgrade-Package: Silver Package', 9, 1, '49.99', NULL, '2014-09-26 14:17:51', '2014-09-26 00:00:00', 1, '', NULL, 'Coffe delights', 'Upgrade-Package: Silver Package', '2014-09-26', 1, 'USD', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_packages`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(145) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
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
(1, 'Silver Package', 'Silver Package', '49.99', '12.00', '1970-01-01', '1970-01-01', 70, 1, 2, 'W', 10),
(2, 'Basic', 'Basic Package', '0.00', '12.00', '1970-01-01', '1970-01-01', 0, 1, 1, 'D', 0),
(3, 'Gold Package', 'Gold Package', '59.99', '0.00', '1970-01-01', '1970-01-01', 180, 1, 3, 'M', 6),
(4, 'Premium Package', 'Premium Package', '99.99', '0.00', '1970-01-01', '1970-01-01', 356, 1, 4, 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jbusinessdirectory_package_fields`
--

CREATE TABLE IF NOT EXISTS `#__jbusinessdirectory_package_fields` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `feature` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `#__jbusinessdirectory_package_fields`
--

INSERT INTO `#__jbusinessdirectory_package_fields` (`int`, `package_id`, `feature`) VALUES
(142, 1, 'image_upload'),
(141, 1, 'html_description'),
(122, 3, 'website_address'),
(121, 3, 'company_logo'),
(120, 3, 'html_description'),
(138, 4, 'company_offers'),
(137, 4, 'contact_form'),
(136, 4, 'google_map'),
(135, 4, 'videos'),
(134, 4, 'image_upload'),
(133, 4, 'website_address'),
(132, 4, 'company_logo'),
(131, 4, 'featured_companies'),
(130, 4, 'html_description'),
(123, 3, 'image_upload'),
(124, 3, 'videos'),
(125, 3, 'google_map'),
(126, 3, 'contact_form'),
(127, 3, 'company_offers'),
(128, 3, 'company_events'),
(129, 3, 'social_networks'),
(139, 4, 'company_events'),
(140, 4, 'social_networks'),
(143, 1, 'website_address'),
(144, 1, 'videos'),
(145, 1, 'contact_form'),
(146, 1, 'google_map');

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

