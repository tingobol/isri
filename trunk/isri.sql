-- Adminer 3.3.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `branches` (`id`, `name`) VALUES
(1,	'ISRI22'),
(2,	'ISRI25');

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `to` varchar(255) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `message` text COLLATE utf8_spanish2_ci NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
(72,	'ricardocasares',	'Sebastian',	'hola mongoide',	'2012-03-03 11:08:00',	1),
(73,	'ricardocasares',	'Sebastian',	'hola mongoloide ',	'2012-03-03 11:08:11',	1),
(74,	'Sebastian',	'ricardocasares',	'peterete',	'2012-03-03 23:23:03',	1),
(75,	'Sebastian',	'ricardocasares',	'vos peteretetetetete!',	'2012-03-03 23:23:13',	1),
(76,	'ricardocasares',	'Sebastian',	'asqueroso',	'2012-03-03 23:27:48',	1);

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('cda4f6261f18ce0807399419c41c3ffd',	'0.0.0.0',	'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11',	1331790853,	'a:6:{s:2:\"id\";s:2:\"26\";s:8:\"username\";s:14:\"ricardocasares\";s:4:\"name\";s:15:\"Ricardo Casares\";s:9:\"branch_id\";s:1:\"2\";s:5:\"admin\";s:1:\"1\";s:4:\"mode\";s:1:\"0\";}'),
('46a82895a2a47790a7f939359afeb7f4',	'0.0.0.0',	'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:10.0.2)',	1331795367,	'a:5:{s:2:\"id\";s:1:\"9\";s:8:\"username\";s:5:\"Mayra\";s:4:\"name\";s:13:\"Mayra Merenda\";s:9:\"branch_id\";s:1:\"2\";s:5:\"admin\";s:1:\"0\";}'),
('513bef97812cd40a0c689baf939038de',	'0.0.0.0',	'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11',	1331795454,	'a:6:{s:2:\"id\";s:2:\"26\";s:8:\"username\";s:14:\"ricardocasares\";s:4:\"name\";s:15:\"Ricardo Casares\";s:9:\"branch_id\";s:1:\"2\";s:5:\"admin\";s:1:\"1\";s:4:\"mode\";s:1:\"0\";}');

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_spanish2_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `comments` (`id`, `user_id`, `comment`, `created`) VALUES
(382,	26,	'\nPruebita\n\n\n\nTAPS dependientes\nCrear nueva dependencia',	'2012-02-16 13:24:22'),
(383,	26,	'asdasd',	'2012-02-16 13:27:01'),
(384,	26,	'asdasd\nasdasdad',	'2012-02-16 13:27:07'),
(385,	26,	'asdasdasdasdasd',	'2012-02-16 13:27:12'),
(386,	26,	'asdfasfasdfasdf',	'2012-02-16 13:27:15'),
(387,	26,	'me guzta la pazta',	'2012-03-03 21:22:47');

DROP TABLE IF EXISTS `comments_tasks`;
CREATE TABLE `comments_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`comment_id`,`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `comments_tasks` (`id`, `comment_id`, `task_id`) VALUES
(384,	382,	216),
(385,	383,	216),
(386,	384,	216),
(387,	385,	216),
(388,	386,	216),
(389,	387,	214);

DROP TABLE IF EXISTS `relatedtasks_tasks`;
CREATE TABLE `relatedtasks_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `relatedtask_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`relatedtask_id`,`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `relatedtasks_tasks` (`id`, `relatedtask_id`, `task_id`) VALUES
(24,	106,	105),
(25,	108,	105),
(26,	112,	111),
(27,	127,	126),
(28,	143,	142),
(29,	189,	172),
(30,	198,	184),
(31,	209,	208),
(32,	210,	208);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `roles` (`id`, `role`) VALUES
(1,	'Solicitante'),
(2,	'Responsable'),
(3,	'Corresponsable'),
(4,	'Notificado');

DROP TABLE IF EXISTS `roles_tasks_users`;
CREATE TABLE `roles_tasks_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `update` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`role_id`,`task_id`,`user_id`,`read`,`update`),
  UNIQUE KEY `idx_name` (`user_id`,`task_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `roles_tasks_users` (`id`, `role_id`, `task_id`, `user_id`, `read`, `update`) VALUES
(1502,	1,	212,	26,	0,	0),
(1503,	4,	212,	28,	1,	0),
(1504,	1,	213,	26,	0,	0),
(1505,	2,	213,	28,	1,	0),
(1506,	1,	214,	26,	0,	0),
(1507,	2,	214,	28,	1,	1),
(1508,	1,	215,	28,	0,	0),
(1509,	2,	215,	26,	0,	0),
(1510,	1,	216,	28,	0,	0),
(1511,	2,	216,	9,	1,	1),
(1512,	3,	216,	26,	0,	0),
(1513,	1,	216,	16,	1,	0),
(1514,	1,	216,	2,	1,	0),
(1515,	1,	216,	3,	1,	0),
(1516,	1,	216,	18,	1,	0),
(1517,	1,	216,	17,	1,	0),
(1518,	1,	216,	19,	1,	0),
(1521,	1,	253,	26,	0,	0),
(1525,	4,	253,	28,	1,	0),
(1526,	4,	253,	9,	1,	0);

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `statuses` (`id`, `status`) VALUES
(1,	'Activa'),
(2,	'Vencida'),
(3,	'Postergada'),
(4,	'Finalizada');

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`slug`(50),`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `tags` (`id`, `slug`, `tag`, `deleted`) VALUES
(35,	'CISCO',	'CISCO',	1),
(36,	'java',	'JAVA',	1),
(41,	'PERONSAL-INFO',	'PERONSAL INFO',	0),
(38,	'reparacin',	'REPARACIÓN',	1),
(40,	'ACADEMICA',	'ACADEMICA',	0),
(42,	'COMERCIAL',	'COMERCIAL',	0),
(52,	'SISTEMAS',	'SISTEMAS',	0),
(43,	'ADMINISTRACION',	'ADMINISTRACION',	0),
(44,	'LEGAL',	'LEGAL',	1),
(45,	'PRESUPUESTO',	'PRESUPUESTO',	0),
(46,	'MEJORA-CONTINUA',	'MEJORA CONTINUA',	0),
(47,	'ALUMNOS',	'ALUMNOS',	0),
(48,	'DOCENTES',	'DOCENTES',	0),
(49,	'CURSOS',	'CURSOS',	0),
(50,	'DISEO',	'DISEÑO',	0),
(51,	'MANTENIMIENTO',	'MANTENIMIENTO',	0),
(53,	'REPORTES',	'REPORTES',	0),
(54,	'OTROS',	'OTROS',	0),
(55,	'PROYDESA',	'PROYDESA',	0),
(56,	'ESTUDIO-SALVO',	'ESTUDIO SALVO',	0),
(57,	'APUNTES',	'APUNTES',	0),
(58,	'CERTIFICADOS',	'CERTIFICADOS',	0),
(66,	'EMPRESAS',	'EMPRESAS',	0),
(59,	'GERENCIA',	'GERENCIA',	0),
(67,	'INSTALACIONES',	'INSTALACIONES',	0),
(68,	'LLAMADO',	'LLAMADO',	0),
(69,	'MINISTERIO',	'MINISTERIO',	0),
(70,	'PROBLEMA',	'PROBLEMA',	0),
(71,	'PUBLICIDAD',	'PUBLICIDAD',	0),
(72,	'TECNICATURA',	'TECNICATURA',	1),
(73,	'UTN',	'UTN',	0),
(74,	'URGENTE',	'URGENTE',	0);

DROP TABLE IF EXISTS `tags_tasks`;
CREATE TABLE `tags_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tag_id`,`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `body` text COLLATE utf8_spanish2_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `completed` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`,`slug`(50),`branch_id`,`user_id`,`type_id`,`tag_id`,`status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `tasks` (`id`, `slug`, `branch_id`, `user_id`, `type_id`, `tag_id`, `status_id`, `subject`, `body`, `start_date`, `end_date`, `completed`, `created`, `updated`) VALUES
(212,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	1,	'INFORME DE LIMPIEZA DEL RACK',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-03-21 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-03-15 05:54:43'),
(213,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	4,	'DECEMBER NEWSLETTER 324',	'PRUEBA 2',	'2012-03-14 23:26:00',	'2012-03-18 08:00:00',	'2012-03-15 03:08:00',	'2012-02-16 02:26:59',	'2012-03-15 06:08:20'),
(214,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	1,	'RE: ATTE. RICARDO CASARES',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-03-22 05:59:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-15 05:50:38'),
(215,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	3,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-03-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-03-15 06:07:54'),
(216,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	1,	'RESUMEN DE TICKETS',	'Pruebita',	'2012-02-15 23:38:00',	'2012-03-16 02:39:00',	NULL,	'2012-02-16 02:38:30',	'2012-03-15 05:54:57'),
(217,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(218,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(219,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(220,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(221,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(222,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(223,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(224,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(225,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(226,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(227,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(228,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(229,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(230,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(231,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(232,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(233,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(234,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(235,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(236,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(237,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(238,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(239,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(240,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(241,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(242,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(243,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(244,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(245,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(246,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(247,	'4f3c691cbc0f6-informe-de-limpieza-del-rack',	2,	26,	1,	40,	2,	'Informe de limpieza del rack',	'PRUEBA',	'2012-02-15 23:25:00',	'2012-02-16 23:25:00',	NULL,	'2012-02-16 02:25:32',	'2012-02-17 09:10:00'),
(248,	'4f3c697358b73-december-newsletter-324',	2,	26,	1,	43,	3,	'December Newsletter 324',	'PRUEBA 2',	'2012-02-15 23:26:00',	'2012-04-12 23:26:00',	NULL,	'2012-02-16 02:26:59',	'2012-02-17 09:10:00'),
(249,	'4f3c69e42d31a-re-atte.-ricardo-casares',	2,	26,	1,	48,	2,	'Re: Atte. Ricardo Casares',	'PRUEBA',	'2012-02-15 23:28:00',	'2012-02-23 23:28:00',	NULL,	'2012-02-16 02:28:52',	'2012-03-03 17:39:00'),
(250,	'4f3c6a3a3e084-a-ve-si-se-borra',	2,	28,	1,	40,	2,	'A VE SI SE BORRA!',	'PRUEBITA',	'2012-02-15 23:30:00',	'2012-02-16 23:30:00',	NULL,	'2012-02-16 02:30:18',	'2012-02-17 09:10:00'),
(251,	'4f3c6c26eeeef-resumen-de-tickets',	2,	28,	2,	40,	2,	'Resumen de tickets',	'Pruebita',	'2012-02-15 23:38:00',	'2012-02-17 23:38:00',	NULL,	'2012-02-16 02:38:30',	'2012-02-22 09:48:00'),
(253,	'4f6192c5bb40a-prueba',	2,	26,	1,	40,	1,	'Prueba',	'Prueba',	'2012-03-15 03:56:00',	'2012-03-17 03:56:00',	NULL,	'2012-03-15 06:57:09',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `types` (`id`, `type`) VALUES
(1,	'Urgente'),
(2,	'Importante'),
(3,	'Normal'),
(4,	'Diferible'),
(5,	'Informativo');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cellphone` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`,`admin`,`branch_id`,`active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `users` (`id`, `admin`, `branch_id`, `active`, `deleted`, `username`, `password`, `cellphone`, `phone`, `email`, `name`) VALUES
(16,	0,	1,	1,	1,	'Claudia',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'claudia@isri.com.ar',	'Claudia Rodriguez'),
(2,	1,	2,	1,	0,	'Marcelo',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'mposleman@isri.com.ar',	'Marcelo Pósleman'),
(3,	1,	2,	0,	0,	'Marcos',	'd3644b6f6960a710683d44caf7cf4732ab14a4a3',	'',	'',	'jmt@gmail.com',	'Juan Marcos Tripolone'),
(18,	0,	2,	1,	0,	'Monica',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'moniolivero@yahoo.com.ar',	'Monica Olivero'),
(9,	0,	2,	1,	0,	'Mayra',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'mayra@isri.com.ar',	'Mayra Merenda'),
(17,	0,	1,	1,	1,	'Erica',	'eb7846561451e4d325de81f6b587b26087d470e8',	'',	'',	'erica@isri.com.ar',	'Erica Balmaceda'),
(28,	1,	2,	1,	0,	'Sebastian',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'sebastian@isri.com.ar',	'Sebastian Sanchez'),
(19,	0,	1,	1,	0,	'Silvia ',	'd2c7eeb86b0e1cb67233930da1d7cda6b6e2f4d7',	'',	'',	'slahoz@isri.com.ar',	'Silvia Lahoz '),
(20,	0,	1,	1,	0,	'Luciano ',	'3aabc94f969fedd4b279d36d20c7e539fd4f2755',	'',	'',	'ldoncel@isri.com.ar',	'Luciano Doncel'),
(22,	0,	2,	1,	0,	'Laura ',	'31e1e995d0e14f4405257bfb9aae5cb45104d6d5',	'',	'',	'laura@isri.com.ar',	'Laura Sanchez'),
(23,	0,	2,	1,	0,	'Jesica',	'd50139138fcfa8bd1ce198e8fe34d8eab8bf1c49',	'',	'',	'jesica@isri.com.ar',	'Jesica Rodriguez'),
(26,	1,	2,	1,	0,	'ricardocasares',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'ri@isri.com.ar',	'Ricardo Casares'),
(25,	0,	2,	0,	0,	'Noelia',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'',	'',	'noelia@isri.com.ar',	'Noelia Navarro');

-- 2012-03-17 16:05:49