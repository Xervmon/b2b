INSERT IGNORE INTO `#__payplans_support` 
(`key`, `value`) 
VALUES
('db_version',		'0'),
('global_version'  , '3.2'),
('build_version'    , '5'),
('patch_enable_plugins'				, '1'),
('patch_enable_modules'				, '1');

INSERT IGNORE INTO `#__payplans_currency` (`currency_id`, `title`, `published`, `params`, `symbol`) VALUES
('ADP', 'Andorran Peseta', 1, NULL, '₧'),
('AED', 'United Arab Emirates Dirham', 1, NULL, 'د.إ'),
('AFA', 'Afghanistan Afghani', 1, NULL, NULL),
('ALL', 'Albanian Lek', 1, NULL, 'L'),
('ANG', 'Netherlands Antillian Guilder', 1, NULL, 'ƒ'),
('AOK', 'Angolan Kwanza', 1, NULL, NULL),
('ARS', 'Argentine Peso', 1, NULL, '$'),
('AUD', 'Australian Dollar', 1, NULL, '$'),
('AWG', 'Aruban Florin', 1, NULL, 'ƒ'),
('BBD', 'Barbados Dollar', 1, NULL, '$'),
('BDT', 'Bangladeshi Taka', 1, NULL, '৳'),
('BGL', 'Bulgarian Lev', 1, NULL, NULL),
('BHD', 'Bahraini Dinar', 1, NULL, 'ب.د'),
('BIF', 'Burundi Franc', 1, NULL, 'Fr'),
('BMD', 'Bermudian Dollar', 1, NULL, '$'),
('BND', 'Brunei Dollar', 1, NULL, '$'),
('BOB', 'Bolivian Boliviano', 1, NULL, 'Bs.'),
('BRL', 'Brazilian Real', 1, NULL, 'R$'),
('BSD', 'Bahamian Dollar', 1, NULL, '$'),
('BTN', 'Bhutan Ngultrum', 1, NULL, 'Nu'),
('BUK', 'Burma Kyat', 1, NULL, NULL),
('BWP', 'Botswanian Pula', 1, NULL, 'P'),
('BZD', 'Belize Dollar', 1, NULL, '$'),
('CAD', 'Canadian Dollar', 1, NULL, '$'),
('CHF', 'Swiss Franc', 1, NULL, 'Fr'),
('CLF', 'Chilean Unidades de Fomento', 1, NULL, 'UF'),
('CLP', 'Chilean Peso', 1, NULL, '$'),
('CNY', 'Yuan (Chinese) Renminbi', 1, NULL, '¥'),
('COP', 'Colombian Peso', 1, NULL, '$'),
('CRC', 'Costa Rican Colon', 1, NULL, '₡'),
('CZK', 'Czech Koruna', 1, NULL, 'Kč'),
('CUP', 'Cuban Peso', 1, NULL, '$'),
('CVE', 'Cape Verde Escudo', 1, NULL, '$, Es'),
('CYP', 'Cyprus Pound', 1, NULL, '£'),
('DKK', 'Danish Krone', 1, NULL, 'kr'),
('DOP', 'Dominican Peso', 1, NULL, '$'),
('DZD', 'Algerian Dinar', 1, NULL, 'د.ج'),
('ECS', 'Ecuador Sucre', 1, NULL, 'S/.'),
('EGP', 'Egyptian Pound', 1, NULL, '£,ج.م'),
('ETB', 'Ethiopian Birr', 1, NULL, 'Br'),
('EUR', 'Euro', 1, NULL, '€'),
('FJD', 'Fiji Dollar', 1, NULL, '$'),
('FKP', 'Falkland Islands Pound', 1, NULL, '£'),
('GBP', 'British Pound', 1, NULL, '£'),
('GHC', 'Ghanaian Cedi', 1, NULL, NULL),
('GIP', 'Gibraltar Pound', 1, NULL, '£'),
('GMD', 'Gambian Dalasi', 1, NULL, 'D'),
('GNF', 'Guinea Franc', 1, NULL, 'Fr'),
('GTQ', 'Guatemalan Quetzal', 1, NULL, 'Q'),
('GWP', 'Guinea-Bissau Peso', 1, NULL, NULL),
('GYD', 'Guyanan Dollar', 1, NULL, '$'),
('HKD', 'Hong Kong Dollar', 1, NULL, '$'),
('HNL', 'Honduran Lempira', 1, NULL, 'L'),
('HTG', 'Haitian Gourde', 1, NULL, 'G'),
('HUF', 'Hungarian Forint', 1, NULL, 'Ft'),
('IDR', 'Indonesian Rupiah', 1, NULL, 'Rp'),
('IEP', 'Irish Punt', 1, NULL, '£'),
('ILS', 'Israeli Shekel', 1, NULL, '₪'),
('INR', 'Indian Rupee', 1, NULL, '₨'),
('IQD', 'Iraqi Dinar', 1, NULL, 'ع.د'),
('IRR', 'Iranian Rial', 1, NULL, '﷼'),
('JMD', 'Jamaican Dollar', 1, NULL, '$'),
('JOD', 'Jordanian Dinar', 1, NULL, 'د.ا'),
('JPY', 'Japanese Yen', 1, NULL, '¥'),
('KES', 'Kenyan Shilling', 1, NULL, 'Sh'),
('KHR', 'Kampuchean (Cambodian) Riel', 1, NULL, '៛'),
('KMF', 'Comoros Franc', 1, NULL, 'Fr'),
('KPW', 'North Korean Won', 1, NULL, '₩'),
('KRW', '(South) Korean Won', 1, NULL, '₩'),
('KWD', 'Kuwaiti Dinar', 1, NULL, 'د.ك'),
('KYD', 'Cayman Islands Dollar', 1, NULL, '$'),
('LAK', 'Lao Kip', 1, NULL, '₭'),
('LBP', 'Lebanese Pound', 1, NULL, 'ل.ل'),
('LKR', 'Sri Lanka Rupee', 1, NULL, 'ரூ'),
('LRD', 'Liberian Dollar', 1, NULL, '$'),
('LSL', 'Lesotho Loti', 1, NULL, 'L'),
('LYD', 'Libyan Dinar', 1, NULL, 'ل.د'),
('MAD', 'Moroccan Dirham', 1, NULL, 'د.م.'),
('MGF', 'Malagasy Franc', 1, NULL, NULL),
('MNT', 'Mongolian Tugrik', 1, NULL, '₮'),
('MOP', 'Macau Pataca', 1, NULL, 'P'),
('MRO', 'Mauritanian Ouguiya', 1, NULL, 'UM'),
('MTL', 'Maltese Lira', 1, NULL, '₤'),
('MUR', 'Mauritius Rupee', 1, NULL, '₨'),
('MVR', 'Maldive Rufiyaa', 1, NULL, 'ރ.'),
('MWK', 'Malawi Kwacha', 1, NULL, 'MK'),
('MXN', 'Mexican Peso', 1, NULL, '$'),
('MYR', 'Malaysian Ringgit', 1, NULL, 'RM'),
('MZM', 'Mozambique Metical', 1, NULL, NULL),
('NGN', 'Nigerian Naira', 1, NULL, '₦'),
('NIC', 'Nicaraguan Cordoba', 1, NULL, NULL),
('NOK', 'Norwegian Kroner', 1, NULL, 'kr'),
('NPR', 'Nepalese Rupee', 1, NULL, '₨'),
('NZD', 'New Zealand Dollar', 1, NULL, '$'),
('OMR', 'Omani Rial', 1, NULL, 'ر.ع.'),
('PAB', 'Panamanian Balboa', 1, NULL, 'B/.'),
('PEN', 'Peruvian Nuevo Sol', 1, NULL, 'S/.'),
('PGK', 'Papua New Guinea Kina', 1, NULL, 'K'),
('PHP', 'Philippine Peso', 1, NULL, '₱'),
('PKR', 'Pakistan Rupee', 1, NULL, '₨'),
('PLN', 'Polish Złoty', 1, NULL, 'zł'),
('PYG', 'Paraguay Guarani', 1, NULL, '₲'),
('QAR', 'Qatari Rial', 1, NULL, 'ر.ق'),
('RON', 'Romanian Leu', 1, NULL, 'RON'),
('RWF', 'Rwanda Franc', 1, NULL, 'Fr'),
('SAR', 'Saudi Arabian Riyal', 1, NULL, 'ر.س'),
('SBD', 'Solomon Islands Dollar', 1, NULL, '$'),
('SCR', 'Seychelles Rupee', 1, NULL, '₨'),
('SDP', 'Sudanese Pound', 1, NULL, NULL),
('SEK', 'Swedish Krona', 1, NULL, 'kr'),
('SGD', 'Singapore Dollar', 1, NULL, '$'),
('SHP', 'St. Helena Pound', 1, NULL, '£'),
('SLL', 'Sierra Leone Leone', 1, NULL, 'Le'),
('SOS', 'Somali Shilling', 1, NULL, 'Sh'),
('SRG', 'Suriname Guilder', 1, NULL, NULL),
('STD', 'Sao Tome and Principe Dobra', 1, NULL, 'Db'),
('RUB', 'Russian Ruble', 1, NULL, 'р.'),
('SVC', 'El Salvador Colon', 1, NULL, '₡'),
('SYP', 'Syrian Potmd', 1, NULL, '£, ل.'),
('SZL', 'Swaziland Lilangeni', 1, NULL, 'L'),
('THB', 'Thai Bath', 1, NULL, '฿'),
('TND', 'Tunisian Dinar', 1, NULL, 'د.ت'),
('TOP', 'Tongan Pa''anga', 1, NULL, 'T$'),
('TPE', 'East Timor Escudo', 1, NULL, NULL),
('TRY', 'Turkish Lira', 1, NULL, ''),
('TTD', 'Trinidad and Tobago Dollar', 1, NULL, '$'),
('TWD', 'Taiwan Dollar', 1, NULL, '$'),
('TZS', 'Tanzanian Shilling', 1, NULL, 'Sh'),
('UGS', 'Uganda Shilling', 1, NULL, NULL),
('USD', 'US Dollar', 1, NULL, '$'),
('UYP', 'Uruguayan Peso', 1, NULL, NULL),
('VEB', 'Venezualan Bolivar', 1, NULL, NULL),
('VND', 'Vietnamese Dong', 1, NULL, '₫'),
('VUV', 'Vanuatu Vatu', 1, NULL, 'Vt'),
('WST', 'Samoan Tala', 1, NULL, 'T'),
('YDD', 'Democratic Yemeni Dinar', 1, NULL, NULL),
('YER', 'Yemeni Rial', 1, NULL, '﷼'),
('RSD', 'Dinar', 1, NULL, 'RSD'),
('ZAR', 'South African Rand', 1, NULL, 'R'),
('ZMK', 'Zambian Kwacha', 1, NULL, 'ZK'),
('ZRZ', 'Zaire Zaire', 1, NULL, NULL),
('ZWD', 'Zimbabwe Dollar', 1, NULL, '$'),
('HRK', 'Croatian kuna' , 1, NULL, 'Kn'),
('LTL', 'Lithuanian litas', '1', NULL , 'Lt'), 
('LVL', 'Latvian lats', '1', NULL , 'Ls'),
('SKK', 'Slovak Koruna', 1, NULL, 'Sk');


INSERT IGNORE INTO `#__payplans_country` 
(`country_id` , `title` , `isocode3`, `isocode2`)
VALUES
(1, 'Afghanistan', 'AFG', 'AF'),
(2, 'Albania', 'ALB', 'AL'),
(3, 'Algeria', 'DZA', 'DZ'),
(4, 'American Samoa', 'ASM', 'AS'),
(5, 'Andorra', 'AND', 'AD'),
(6, 'Angola', 'AGO', 'AO'),
(7, 'Anguilla', 'AIA', 'AI'),
(8, 'Antarctica', 'ATA', 'AQ'),
(9, 'Antigua and Barbuda', 'ATG', 'AG'),
(10, 'Argentina', 'ARG', 'AR'),
(11, 'Armenia', 'ARM', 'AM'),
(12, 'Aruba', 'ABW', 'AW'),
(13, 'Australia', 'AUS', 'AU'),
(14, 'Austria', 'AUT', 'AT'),
(15, 'Azerbaijan', 'AZE', 'AZ'),
(16, 'Bahamas', 'BHS', 'BS'),
(17, 'Bahrain', 'BHR', 'BH'),
(18, 'Bangladesh', 'BGD', 'BD'),
(19, 'Barbados', 'BRB', 'BB'),
(20, 'Belarus', 'BLR', 'BY'),
(21, 'Belgium', 'BEL', 'BE'),
(22, 'Belize', 'BLZ', 'BZ'),
(23, 'Benin', 'BEN', 'BJ'),
(24, 'Bermuda', 'BMU', 'BM'),
(25, 'Bhutan', 'BTN', 'BT'),
(26, 'Bolivia', 'BOL', 'BO'),
(27, 'Bosnia and Herzegowina', 'BIH', 'BA'),
(28, 'Botswana', 'BWA', 'BW'),
(29, 'Bouvet Island', 'BVT', 'BV'),
(30, 'Brazil', 'BRA', 'BR'),
(31, 'British Indian Ocean Territory', 'IOT', 'IO'),
(32, 'Brunei Darussalam', 'BRN', 'BN'),
(33, 'Bulgaria', 'BGR', 'BG'),
(34, 'Burkina Faso', 'BFA', 'BF'),
(35, 'Burundi', 'BDI', 'BI'),
(36, 'Cambodia', 'KHM', 'KH'),
(37, 'Cameroon', 'CMR', 'CM'),
(38, 'Canada', 'CAN', 'CA'),
(39, 'Cape Verde', 'CPV', 'CV'),
(40, 'Cayman Islands', 'CYM', 'KY'),
(41, 'Central African Republic', 'CAF', 'CF'),
(42, 'Chad', 'TCD', 'TD'),
(43, 'Chile', 'CHL', 'CL'),
(44, 'China', 'CHN', 'CN'),
(45, 'Christmas Island', 'CXR', 'CX'),
(46, 'Cocos (Keeling) Islands', 'CCK', 'CC'),
(47, 'Colombia', 'COL', 'CO'),
(48, 'Comoros', 'COM', 'KM'),
(49, 'Congo', 'COG', 'CG'),
(50, 'Cook Islands', 'COK', 'CK'),
(51, 'Costa Rica', 'CRI', 'CR'),
(52, 'Cote D''Ivoire', 'CIV', 'CI'),
(53, 'Croatia', 'HRV', 'HR'),
(54, 'Cuba', 'CUB', 'CU'),
(55, 'Cyprus', 'CYP', 'CY'),
(56, 'Czech Republic', 'CZE', 'CZ'),
(57, 'Denmark', 'DNK', 'DK'),
(58, 'Djibouti', 'DJI', 'DJ'),
(59, 'Dominica', 'DMA', 'DM'),
(60, 'Dominican Republic', 'DOM', 'DO'),
(61, 'East Timor', 'TMP', 'TP'),
(62, 'Ecuador', 'ECU', 'EC'),
(63, 'Egypt', 'EGY', 'EG'),
(64, 'El Salvador', 'SLV', 'SV'),
(65, 'Equatorial Guinea', 'GNQ', 'GQ'),
(66, 'Eritrea', 'ERI', 'ER'),
(67, 'Estonia', 'EST', 'EE'),
(68, 'Ethiopia', 'ETH', 'ET'),
(69, 'Falkland Islands (Malvinas)', 'FLK', 'FK'),
(70, 'Faroe Islands', 'FRO', 'FO'),
(71, 'Fiji', 'FJI', 'FJ'),
(72, 'Finland', 'FIN', 'FI'),
(73, 'France', 'FRA', 'FR'),
(74, 'France, Metropolitan', 'FXX', 'FX'),
(75, 'French Guiana', 'GUF', 'GF'),
(76, 'French Polynesia', 'PYF', 'PF'),
(77, 'French Southern Territories', 'ATF', 'TF'),
(78, 'Gabon', 'GAB', 'GA'),
(79, 'Gambia', 'GMB', 'GM'),
(80, 'Georgia', 'GEO', 'GE'),
(81, 'Germany', 'DEU', 'DE'),
(82, 'Ghana', 'GHA', 'GH'),
(83, 'Gibraltar', 'GIB', 'GI'),
(84, 'Greece', 'GRC', 'GR'),
(85, 'Greenland', 'GRL', 'GL'),
(86, 'Grenada', 'GRD', 'GD'),
(87, 'Guadeloupe', 'GLP', 'GP'),
(88, 'Guam', 'GUM', 'GU'),
(89, 'Guatemala', 'GTM', 'GT'),
(90, 'Guinea', 'GIN', 'GN'),
(91, 'Guinea-bissau', 'GNB', 'GW'),
(92, 'Guyana', 'GUY', 'GY'),
(93, 'Haiti', 'HTI', 'HT'),
(94, 'Heard and Mc Donald Islands', 'HMD', 'HM'),
(95, 'Honduras', 'HND', 'HN'),
(96, 'Hong Kong', 'HKG', 'HK'),
(97, 'Hungary', 'HUN', 'HU'),
(98, 'Iceland', 'ISL', 'IS'),
(99, 'India', 'IND', 'IN'),
(100, 'Indonesia', 'IDN', 'ID'),
(101, 'Iran (Islamic Republic of)', 'IRN', 'IR'),
(102, 'Iraq', 'IRQ', 'IQ'),
(103, 'Ireland', 'IRL', 'IE'),
(104, 'Israel', 'ISR', 'IL'),
(105, 'Italy', 'ITA', 'IT'),
(106, 'Jamaica', 'JAM', 'JM'),
(107, 'Japan', 'JPN', 'JP'),
(108, 'Jordan', 'JOR', 'JO'),
(109, 'Kazakhstan', 'KAZ', 'KZ'),
(110, 'Kenya', 'KEN', 'KE'),
(111, 'Kiribati', 'KIR', 'KI'),
(112, 'Korea, Democratic People''s Republic of', 'PRK', 'KP'),
(113, 'Korea, Republic of', 'KOR', 'KR'),
(114, 'Kuwait', 'KWT', 'KW'),
(115, 'Kyrgyzstan', 'KGZ', 'KG'),
(116, 'Lao People''s Democratic Republic', 'LAO', 'LA'),
(117, 'Latvia', 'LVA', 'LV'),
(118, 'Lebanon', 'LBN', 'LB'),
(119, 'Lesotho', 'LSO', 'LS'),
(120, 'Liberia', 'LBR', 'LR'),
(121, 'Libyan Arab Jamahiriya', 'LBY', 'LY'),
(122, 'Liechtenstein', 'LIE', 'LI'),
(123, 'Lithuania', 'LTU', 'LT'),
(124, 'Luxembourg', 'LUX', 'LU'),
(125, 'Macau', 'MAC', 'MO'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK'),
(127, 'Madagascar', 'MDG', 'MG'),
(128, 'Malawi', 'MWI', 'MW'),
(129, 'Malaysia', 'MYS', 'MY'),
(130, 'Maldives', 'MDV', 'MV'),
(131, 'Mali', 'MLI', 'ML'),
(132, 'Malta', 'MLT', 'MT'),
(133, 'Marshall Islands', 'MHL', 'MH'),
(134, 'Martinique', 'MTQ', 'MQ'),
(135, 'Mauritania', 'MRT', 'MR'),
(136, 'Mauritius', 'MUS', 'MU'),
(137, 'Mayotte', 'MYT', 'YT'),
(138, 'Mexico', 'MEX', 'MX'),
(139, 'Micronesia, Federated States of', 'FSM', 'FM'),
(140, 'Moldova, Republic of', 'MDA', 'MD'),
(141, 'Monaco', 'MCO', 'MC'),
(142, 'Mongolia', 'MNG', 'MN'),
(143, 'Montserrat', 'MSR', 'MS'),
(144, 'Morocco', 'MAR', 'MA'),
(145, 'Mozambique', 'MOZ', 'MZ'),
(146, 'Myanmar', 'MMR', 'MM'),
(147, 'Namibia', 'NAM', 'NA'),
(148, 'Nauru', 'NRU', 'NR'),
(149, 'Nepal', 'NPL', 'NP'),
(150, 'Netherlands', 'NLD', 'NL'),
(151, 'Netherlands Antilles', 'ANT', 'AN'),
(152, 'New Caledonia', 'NCL', 'NC'),
(153, 'New Zealand', 'NZL', 'NZ'),
(154, 'Nicaragua', 'NIC', 'NI'),
(155, 'Niger', 'NER', 'NE'),
(156, 'Nigeria', 'NGA', 'NG'),
(157, 'Niue', 'NIU', 'NU'),
(158, 'Norfolk Island', 'NFK', 'NF'),
(159, 'Northern Mariana Islands', 'MNP', 'MP'),
(160, 'Norway', 'NOR', 'NO'),
(161, 'Oman', 'OMN', 'OM'),
(162, 'Pakistan', 'PAK', 'PK'),
(163, 'Palau', 'PLW', 'PW'),
(164, 'Panama', 'PAN', 'PA'),
(165, 'Papua New Guinea', 'PNG', 'PG'),
(166, 'Paraguay', 'PRY', 'PY'),
(167, 'Peru', 'PER', 'PE'),
(168, 'Philippines', 'PHL', 'PH'),
(169, 'Pitcairn', 'PCN', 'PN'),
(170, 'Poland', 'POL', 'PL'),
(171, 'Portugal', 'PRT', 'PT'),
(172, 'Puerto Rico', 'PRI', 'PR'),
(173, 'Qatar', 'QAT', 'QA'),
(174, 'Reunion', 'REU', 'RE'),
(175, 'Romania', 'ROM', 'RO'),
(176, 'Russian Federation', 'RUS', 'RU'),
(177, 'Rwanda', 'RWA', 'RW'),
(178, 'Saint Kitts and Nevis', 'KNA', 'KN'),
(179, 'Saint Lucia', 'LCA', 'LC'),
(180, 'Saint Vincent and the Grenadines', 'VCT', 'VC'),
(181, 'Samoa', 'WSM', 'WS'),
(182, 'San Marino', 'SMR', 'SM'),
(183, 'Sao Tome and Principe', 'STP', 'ST'),
(184, 'Saudi Arabia', 'SAU', 'SA'),
(185, 'Senegal', 'SEN', 'SN'),
(186, 'Seychelles', 'SYC', 'SC'),
(187, 'Sierra Leone', 'SLE', 'SL'),
(188, 'Singapore', 'SGP', 'SG'),
(189, 'Slovakia (Slovak Republic)', 'SVK', 'SK'),
(190, 'Slovenia', 'SVN', 'SI'),
(191, 'Solomon Islands', 'SLB', 'SB'),
(192, 'Somalia', 'SOM', 'SO'),
(193, 'South Africa', 'ZAF', 'ZA'),
(194, 'South Georgia and the South Sandwich Islands', 'SGS', 'GS'),
(195, 'Spain', 'ESP', 'ES'),
(196, 'Sri Lanka', 'LKA', 'LK'),
(197, 'St. Helena', 'SHN', 'SH'),
(198, 'St. Pierre and Miquelon', 'SPM', 'PM'),
(199, 'Sudan', 'SDN', 'SD'),
(200, 'Suriname', 'SUR', 'SR'),
(201, 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ'),
(202, 'Swaziland', 'SWZ', 'SZ'),
(203, 'Sweden', 'SWE', 'SE'),
(204, 'Switzerland', 'CHE', 'CH'),
(205, 'Syrian Arab Republic', 'SYR', 'SY'),
(206, 'Taiwan', 'TWN', 'TW'),
(207, 'Tajikistan', 'TJK', 'TJ'),
(208, 'Tanzania, United Republic of', 'TZA', 'TZ'),
(209, 'Thailand', 'THA', 'TH'),
(210, 'Togo', 'TGO', 'TG'),
(211, 'Tokelau', 'TKL', 'TK'),
(212, 'Tonga', 'TON', 'TO'),
(213, 'Trinidad and Tobago', 'TTO', 'TT'),
(214, 'Tunisia', 'TUN', 'TN'),
(215, 'Turkey', 'TUR', 'TR'),
(216, 'Turkmenistan', 'TKM', 'TM'),
(217, 'Turks and Caicos Islands', 'TCA', 'TC'),
(218, 'Tuvalu', 'TUV', 'TV'),
(219, 'Uganda', 'UGA', 'UG'),
(220, 'Ukraine', 'UKR', 'UA'),
(221, 'United Arab Emirates', 'ARE', 'AE'),
(222, 'United Kingdom', 'GBR', 'GB'),
(223, 'United States', 'USA', 'US'),
(224, 'United States Minor Outlying Islands', 'UMI', 'UM'),
(225, 'Uruguay', 'URY', 'UY'),
(226, 'Uzbekistan', 'UZB', 'UZ'),
(227, 'Vanuatu', 'VUT', 'VU'),
(228, 'Vatican City State (Holy See)', 'VAT', 'VA'),
(229, 'Venezuela', 'VEN', 'VE'),
(230, 'Viet Nam', 'VNM', 'VN'),
(231, 'Virgin Islands (British)', 'VGB', 'VG'),
(232, 'Virgin Islands (U.S.)', 'VIR', 'VI'),
(233, 'Wallis and Futuna Islands', 'WLF', 'WF'),
(234, 'Western Sahara', 'ESH', 'EH'),
(235, 'Yemen', 'YEM', 'YE'),
(236, 'Serbia', 'SRB', 'RS'),
(237, 'The Democratic Republic of Congo', 'DRC', 'DC'),
(238, 'Zambia', 'ZMB', 'ZM'),
(239, 'Zimbabwe', 'ZWE', 'ZW'),
(240, 'East Timor', 'XET', 'XE'),
(241, 'Jersey', 'XJE', 'XJ'),
(242, 'St. Barthelemy', 'XSB', 'XB'),
(243, 'St. Eustatius', 'XSE', 'XU'),
(244, 'Canary Islands', 'XCA', 'XC'),
(245, 'Montenegro', 'MNE', 'ME')
;

INSERT IGNORE INTO `#__payplans_config` 
(`key`, `value`)
VALUES
('theme', 'dark_ef723b'),
('subscription_status', '["0","1601","1602","1603"]'),
('note', ''),
('add_token', ''),
('companyPhone', '9982231113'),
('companyName', 'ReadyBytes Software Labs'),
('companyCityCountry', 'Bhilwara, India'),
('displayRenewLink', '1'),
('currentCronAcessTime', '1372821166'),
('companyAddress', '59, Ashok Nagar Bhilwara'),
('expert_auto_delete', 'NEVER'),
('expert_wait_for_payment', '000001000000'),
('expert_run_automatic_cron', '1'),
('expert_useminjs', '0'),
('expert_use_bootstrap_jquery', '1'),
('expert_use_jquery', '1'),
('blockLogging', ''),
('expert_encryption_key', 'RBSLRBSL'),
('cronAcessTime', '1372821166'),
('cronFrequency', '900'),
('multipleDiscount', '0'),
('displayExistingSubscribedPlans', '1'),
('https', '0'),
('microsubscription', '0'),
('log_bucket', '1'),
('allowedMaxPercentDiscount', '100'),
('fractionDigitCount', '2'),
('price_decimal_separator', '.'),
('show_currency_at', 'before'),
('show_currency_as', 'symbol'),
('date_format', '%Y-%m-%d'),
('currency', 'USD'),
('enableDiscount', '1'),
('useGroupsForPlan', '0'),
('accessLoginBlock', '1'),
('registrationType', 'auto'),
('rtl_support', '0'),
('layout', 'horizontal'),
('row_plan_counter', ''),
('rewriter', ''),
('companyLogo', ''),
('expert_use_bootstrap_css', '1');
