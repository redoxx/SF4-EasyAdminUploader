-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `black_list_ip`;
CREATE TABLE `black_list_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `campaign`;
CREATE TABLE `campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_date` datetime NOT NULL,
  `e_date` datetime NOT NULL,
  `promotext` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `draft` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `campaign` (`id`, `title`, `s_date`, `e_date`, `promotext`, `image`, `enabled`, `created_at`, `draft`) VALUES
(3,	'campaign 1',	'2018-08-05 22:02:00',	'2018-09-05 02:02:00',	'<p>fsdfdsfsdfsd</p>',	'téléchargement.jpg',	1,	'2018-06-14 09:57:51',	1),
(5,	'campaign 2',	'2018-10-22 05:05:00',	'2018-11-22 06:06:00',	'<p>text</p>',	'téléchargement.jpg',	1,	'2018-06-18 13:28:29',	0),
(6,	'campaign 3',	'2018-09-05 11:01:00',	'2018-10-06 05:05:00',	'<p>m*m&ugrave;*m*m*</p>',	'téléchargement.jpg',	0,	'2018-06-18 13:29:48',	1),
(8,	'campaign 5',	'2018-12-22 05:05:00',	'2018-12-29 06:06:00',	'<p>cwcwxcwxc</p>',	'téléchargement.jpg',	0,	'2018-06-19 08:12:15',	0),
(9,	'campaign 6',	'2018-12-14 09:09:00',	'2018-12-24 11:11:00',	'<p>hfghfghgfh fghf</p>',	'téléchargement.jpg',	1,	'2018-06-19 08:16:02',	0),
(10,	'campaign 7',	'2018-12-12 05:05:00',	'2019-01-05 08:08:00',	'<p>vcccc</p>',	'téléchargement.jpg',	0,	'2018-06-19 08:40:14',	1);

DROP TABLE IF EXISTS `code`;
CREATE TABLE `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `codes_csv_file`;
CREATE TABLE `codes_csv_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csvfile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed` tinyint(1) DEFAULT NULL,
  `start_process_at` datetime DEFAULT NULL,
  `end_process_at` datetime DEFAULT NULL,
  `campaign_id` int(11) NOT NULL,
  `nbr_lines_processed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FBC1334BF639F774` (`campaign_id`),
  CONSTRAINT `FK_FBC1334BF639F774` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `codes_csv_file` (`id`, `csvfile`, `processed`, `start_process_at`, `end_process_at`, `campaign_id`, `nbr_lines_processed`) VALUES
(1,	'téléchargement.jpg',	0,	NULL,	NULL,	3,	0),
(3,	'Bulletin_de_participation_JEU_CONCOURS_CPDM_2018.xlsx',	0,	NULL,	NULL,	3,	0),
(4,	'Bulletin_de_participation_JEU_CONCOURS_CPDM_2018.xlsx',	1,	NULL,	NULL,	3,	0),
(5,	'Bulletin_de_participation_JEU_CONCOURS_CPDM_2018.xlsx',	0,	NULL,	NULL,	5,	0),
(6,	'Genun Sys- RABAHI Redouane.pdf',	0,	NULL,	NULL,	6,	0),
(8,	'téléchargement.jpg',	0,	NULL,	NULL,	8,	0),
(9,	'téléchargement.jpg',	0,	NULL,	NULL,	9,	0),
(10,	'téléchargement.jpg',	0,	NULL,	NULL,	10,	0);

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migration_versions` (`version`) VALUES
('20180612133239'),
('20180613073616'),
('20180613074424'),
('20180613150621'),
('20180614083737'),
('20180614092541'),
('20180614095706');

-- 2018-06-20 10:15:00
