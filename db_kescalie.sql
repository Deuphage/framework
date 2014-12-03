-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2014 at 01:34 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_kescalie`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `name` varchar(42) NOT NULL,
  `description` varchar(150) NOT NULL,
  `reg_start` datetime NOT NULL,
  `reg_end` datetime NOT NULL,
  `activity_start` datetime NOT NULL,
  `activity_end` datetime NOT NULL,
  `places_nb` int(11) NOT NULL,
  `group_size` int(11) NOT NULL,
  `group_gen` set('auto','manual') NOT NULL DEFAULT 'auto',
  `peer_correcting_nb` int(11) NOT NULL,
  `type` set('project','exam') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('02beca54ee1f998bfd5e71e4236e9bfb', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1417599223, ''),
('6aedc8f7474c5c35d9769b53125f65d9', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1417452283, 'a:5:{s:9:"user_data";s:0:"";s:5:"login";s:5:"admin";s:6:"online";b:1;s:6:"status";s:1:"2";s:8:"language";s:6:"french";}');

-- --------------------------------------------------------

--
-- Table structure for table `forum_admins`
--

CREATE TABLE IF NOT EXISTS `forum_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_messages`
--

CREATE TABLE IF NOT EXISTS `forum_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` varchar(20) DEFAULT NULL,
  `pid` varchar(20) NOT NULL,
  `tid` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `last_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `replies` int(11) NOT NULL DEFAULT '0',
  `last_username` varchar(100) NOT NULL,
  `last_mid` varchar(50) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `notify` char(1) DEFAULT NULL,
  `login` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`,`pid`,`tid`,`title`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `forum_messages`
--

INSERT INTO `forum_messages` (`id`, `mid`, `pid`, `tid`, `date`, `email`, `title`, `message`, `last_date`, `replies`, `last_username`, `last_mid`, `hits`, `notify`, `login`) VALUES
(5, NULL, '', 4, '2014-11-26 14:08:31', 'arx@hotmail.fr', 'frogmage', 'underworld', '2014-11-26 13:08:31', 0, '', NULL, NULL, NULL, 'admin'),
(6, NULL, '', 4, '2014-11-26 14:08:40', 'arx@hotmail.fr', 'Classe', 'Un message serieux', '2014-11-26 13:08:54', 0, '', NULL, NULL, NULL, 'admin');

--
-- Triggers `forum_messages`
--
DROP TRIGGER IF EXISTS `forum_messages_date_trigger`;
DELIMITER //
CREATE TRIGGER `forum_messages_date_trigger` BEFORE INSERT ON `forum_messages`
 FOR EACH ROW SET NEW.date = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` datetime DEFAULT NULL,
  `gid` varchar(20) NOT NULL,
  `last_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `messages` int(11) NOT NULL DEFAULT '0',
  `last_username` varchar(100) NOT NULL,
  `last_mid` varchar(50) DEFAULT NULL,
  `login` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`,`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `tid`, `title`, `description`, `email`, `date`, `gid`, `last_date`, `messages`, `last_username`, `last_mid`, `login`) VALUES
(4, '', 'hello', 'world', 'arx@hotmail.fr', '2014-11-26 14:07:07', '', '2014-11-26 13:07:07', 0, '', NULL, 'admin');

--
-- Triggers `forum_topics`
--
DROP TRIGGER IF EXISTS `forum_topics_date_trigger`;
DELIMITER //
CREATE TRIGGER `forum_topics_date_trigger` BEFORE INSERT ON `forum_topics`
 FOR EACH ROW SET NEW.date = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ldap`
--

CREATE TABLE IF NOT EXISTS `ldap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dn` tinytext NOT NULL,
  `cn` tinytext NOT NULL,
  `uid` tinytext NOT NULL,
  `mobilephone` tinytext,
  `birthdate` tinytext,
  `photo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `action` varchar(100) NOT NULL,
  `other` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=636 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `login`, `action`, `other`, `date`) VALUES
(1, 'admin', 'login', NULL, '2014-10-21 14:26:12'),
(2, 'admin', 'logout', NULL, '2014-10-21 14:43:10'),
(3, 'raton', 'new account', NULL, '2014-10-21 14:43:46'),
(4, 'raton', 'login', NULL, '2014-10-21 14:43:51'),
(5, 'raton', 'visite', 'main', '2014-10-21 14:43:51'),
(6, 'raton', 'visite', 'profile', '2014-10-21 14:43:56'),
(7, 'raton', 'visite', 'main', '2014-10-21 14:43:58'),
(8, 'raton', 'logout', NULL, '2014-10-21 15:15:53'),
(9, 'rtyutre', 'new account', NULL, '2014-10-21 15:16:56'),
(10, 'jean1234', 'login', NULL, '2014-10-21 15:17:53'),
(11, 'jean1234', 'visite', 'main', '2014-10-21 15:17:53'),
(12, 'jean1234', 'visite', 'main', '2014-10-21 15:17:55'),
(13, 'jean1234', 'visite', 'main', '2014-10-21 15:17:56'),
(14, 'jean1234', 'visite', 'profile', '2014-10-21 15:17:56'),
(15, 'jean1234', 'logout', NULL, '2014-10-21 15:17:59'),
(16, 'admin', 'visite', 'index', '2014-10-22 10:36:17'),
(17, 'admin', 'visite', 'index', '2014-10-22 10:37:10'),
(18, 'admin', 'visite', 'index', '2014-10-22 10:37:11'),
(19, 'admin', 'visite', 'index', '2014-10-22 10:37:15'),
(20, 'admin', 'visite', 'index', '2014-10-22 10:44:05'),
(21, 'admin', 'visite', 'main', '2014-10-22 10:44:07'),
(22, 'admin', 'visite', 'index', '2014-10-22 10:47:58'),
(23, 'admin', 'visite', 'index', '2014-10-22 11:01:45'),
(24, 'admin', 'visite', 'index', '2014-10-22 11:01:46'),
(25, 'admin', 'visite', 'index', '2014-10-22 11:01:49'),
(26, 'admin', 'visite', 'index', '2014-10-22 11:01:50'),
(27, 'admin', 'visite', 'index', '2014-10-22 11:01:51'),
(28, 'admin', 'visite', 'index', '2014-10-22 11:01:52'),
(29, 'admin', 'visite', 'index', '2014-10-22 11:01:53'),
(30, 'admin', 'visite', 'index', '2014-10-22 11:01:58'),
(31, 'admin', 'visite', 'main', '2014-10-22 11:01:59'),
(32, 'admin', 'visite', 'profile', '2014-10-22 11:01:59'),
(33, 'admin', 'visite', 'admin', '2014-10-22 11:02:01'),
(34, 'admin', 'visite', 'profile', '2014-10-22 11:08:47'),
(35, 'admin', 'visite', 'admin', '2014-10-22 11:08:48'),
(36, 'admin', 'visite', 'index', '2014-10-22 11:08:49'),
(37, 'admin', 'logout', NULL, '2014-10-22 11:08:51'),
(38, 'admin', 'login', NULL, '2014-10-22 11:08:57'),
(39, 'admin', 'visite', 'main', '2014-10-22 11:08:57'),
(40, 'admin', 'logout', NULL, '2014-10-22 11:09:00'),
(41, 'Usulmaster', 'new account', NULL, '2014-10-22 11:09:30'),
(42, 'admin', 'login', NULL, '2014-10-22 13:35:39'),
(43, 'admin', 'visite', 'main', '2014-10-22 13:35:39'),
(44, 'admin', 'visite', 'admin', '2014-10-22 13:35:40'),
(45, 'admin', 'visite', 'index', '2014-10-22 14:00:00'),
(46, 'admin', 'visite', 'main', '2014-10-22 14:00:04'),
(47, 'admin', 'visite', 'main', '2014-10-22 14:00:39'),
(48, 'admin', 'visite', 'admin', '2014-10-22 14:00:42'),
(49, 'admin', 'visite', 'admin', '2014-10-22 14:15:17'),
(50, 'admin', 'visite', 'index', '2014-10-22 14:43:55'),
(51, 'admin', 'visite', 'admin', '2014-10-22 14:43:57'),
(52, 'admin', 'visite', 'index', '2014-10-22 14:47:33'),
(53, 'admin', 'visite', 'admin', '2014-10-22 14:49:57'),
(54, 'admin', 'visite', 'admin', '2014-10-22 14:50:04'),
(55, 'admin', 'visite', 'admin', '2014-10-22 14:50:13'),
(56, 'admin', 'visite', 'index', '2014-10-22 15:15:17'),
(57, 'admin', 'visite', 'admin', '2014-10-22 15:15:18'),
(58, 'admin', 'visite', 'admin', '2014-10-22 15:15:24'),
(59, 'admin', 'visite', 'index', '2014-10-22 15:16:51'),
(60, 'admin', 'visite', 'admin', '2014-10-22 15:16:52'),
(61, 'admin', 'visite', 'index', '2014-10-22 15:42:06'),
(62, 'admin', 'visite', 'admin', '2014-10-22 15:42:07'),
(63, 'admin', 'visite', 'admin', '2014-10-22 15:50:55'),
(64, 'admin', 'visite', 'admin', '2014-10-22 15:51:15'),
(65, 'admin', 'visite', 'admin', '2014-10-22 15:51:37'),
(66, 'admin', 'visite', 'admin', '2014-10-22 15:52:03'),
(67, 'admin', 'visite', 'index', '2014-10-22 15:55:13'),
(68, 'admin', 'login', NULL, '2014-10-29 16:41:32'),
(69, 'admin', 'visite', 'main', '2014-10-29 16:41:32'),
(70, 'admin', 'visite', 'main', '2014-10-29 16:47:19'),
(71, 'admin', 'visite', 'main', '2014-10-29 16:50:58'),
(72, 'admin', 'visite', 'main', '2014-10-29 16:53:35'),
(73, 'admin', 'visite', 'main', '2014-10-29 16:54:15'),
(74, 'admin', 'visite', 'main', '2014-10-29 16:56:03'),
(75, 'admin', 'visite', 'main', '2014-10-29 16:59:26'),
(76, 'admin', 'visite', 'main', '2014-10-29 17:00:38'),
(77, 'admin', 'visite', 'main', '2014-10-29 17:01:09'),
(78, 'admin', 'login', NULL, '2014-10-30 11:28:30'),
(79, 'admin', 'visite', 'main', '2014-10-30 13:27:42'),
(80, 'admin', 'visite', 'main', '2014-10-30 13:37:45'),
(81, 'admin', 'visite', 'main', '2014-10-30 13:39:57'),
(82, 'admin', 'visite', 'main', '2014-10-30 13:42:03'),
(83, 'admin', 'visite', 'main', '2014-10-30 13:42:52'),
(84, 'admin', 'visite', 'main', '2014-10-30 13:43:17'),
(85, 'admin', 'visite', 'main', '2014-10-30 13:47:26'),
(86, 'admin', 'visite', 'main', '2014-10-30 13:58:06'),
(87, 'admin', 'visite', 'main', '2014-10-30 13:58:44'),
(88, 'admin', 'visite', 'main', '2014-10-30 14:02:41'),
(89, 'admin', 'visite', 'main', '2014-10-30 14:06:32'),
(90, 'admin', 'visite', 'main', '2014-10-30 14:07:19'),
(91, 'admin', 'visite', 'main', '2014-10-30 14:07:55'),
(92, 'admin', 'visite', 'main', '2014-10-30 14:08:37'),
(93, 'admin', 'visite', 'main', '2014-10-30 14:08:48'),
(94, 'admin', 'visite', 'main', '2014-10-30 14:10:12'),
(95, 'admin', 'visite', 'main', '2014-10-30 14:10:16'),
(96, 'admin', 'login', NULL, '2014-10-31 14:49:59'),
(97, 'admin', 'visite', 'main', '2014-10-31 14:50:08'),
(98, 'admin', 'visite', 'index', '2014-10-31 14:52:39'),
(99, 'admin', 'logout', NULL, '2014-10-31 14:52:44'),
(100, 'admin', 'login', NULL, '2014-10-31 14:52:51'),
(101, 'admin', 'login', NULL, '2014-10-31 14:54:46'),
(102, 'admin', 'visite', 'main', '2014-10-31 14:54:55'),
(103, 'admin', 'login', NULL, '2014-10-31 15:06:53'),
(104, 'admin', 'login', NULL, '2014-10-31 15:07:24'),
(105, 'admin', 'login', NULL, '2014-10-31 15:28:01'),
(106, 'admin', 'login', NULL, '2014-10-31 15:28:49'),
(107, 'admin', 'visite', 'index', '2014-10-31 15:33:23'),
(108, 'admin', 'visite', 'index', '2014-10-31 15:35:59'),
(109, 'admin', 'visite', 'profile', '2014-10-31 15:36:11'),
(110, 'admin', 'visite', 'index', '2014-10-31 15:38:02'),
(111, 'admin', 'visite', 'profile', '2014-10-31 15:38:13'),
(112, 'admin', 'logout', NULL, '2014-10-31 15:38:24'),
(113, 'admin', 'login', NULL, '2014-10-31 15:38:44'),
(114, 'admin', 'visite', 'main', '2014-10-31 15:39:03'),
(115, 'admin', 'visite', 'main', '2014-10-31 15:39:05'),
(116, 'admin', 'visite', 'profile', '2014-10-31 15:39:06'),
(117, 'admin', 'visite', 'main', '2014-10-31 15:39:08'),
(118, 'admin', 'visite', 'index', '2014-10-31 15:50:27'),
(119, 'admin', 'visite', 'main', '2014-10-31 15:50:29'),
(120, 'admin', 'logout', NULL, '2014-10-31 15:50:30'),
(121, 'kescalie', 'login', NULL, '2014-11-01 10:09:44'),
(122, 'kescalie', 'visite', 'main', '2014-11-01 10:09:54'),
(123, 'kescalie', 'visite', 'index', '2014-11-01 10:09:56'),
(124, 'kescalie', 'logout', NULL, '2014-11-01 10:09:59'),
(125, 'kescalie', 'visite', 'index', '2014-11-01 10:10:02'),
(126, 'kescalie', 'login', NULL, '2014-11-01 10:10:08'),
(127, 'kescalie', 'visite', 'main', '2014-11-01 10:10:17'),
(128, 'kescalie', 'visite', 'main', '2014-11-01 10:10:32'),
(129, 'kescalie', 'visite', 'profile', '2014-11-01 10:10:34'),
(130, 'kescalie', 'logout', NULL, '2014-11-01 10:11:58'),
(131, 'admin', 'login', NULL, '2014-11-01 10:30:02'),
(132, 'admin', 'visite', 'main', '2014-11-01 10:30:10'),
(133, 'admin', 'logout', NULL, '2014-11-01 10:43:46'),
(134, 'admin', 'login', NULL, '2014-11-01 10:44:51'),
(135, 'admin', 'visite', 'main', '2014-11-01 10:44:59'),
(136, 'admin', 'visite', 'main', '2014-11-01 10:45:49'),
(137, '0', 'logout', NULL, '2014-11-01 10:46:35'),
(138, 'kescalie', 'login', NULL, '2014-11-01 11:43:22'),
(139, 'kescalie', 'visite', 'index', '2014-11-01 11:43:49'),
(140, 'kescalie', 'logout', NULL, '2014-11-01 11:43:51'),
(141, 'kescalie', 'visite', 'main', '2014-11-01 11:43:52'),
(142, 'eglondu', 'login', NULL, '2014-11-01 11:44:12'),
(143, 'eglondu', 'visite', 'main', '2014-11-01 11:44:12'),
(144, 'eglondu', 'visite', 'main', '2014-11-01 11:44:21'),
(145, 'eglondu', 'logout', NULL, '2014-11-01 11:44:34'),
(146, 'admin', 'login', NULL, '2014-11-01 14:34:37'),
(147, 'admin', 'login', NULL, '2014-11-01 14:51:18'),
(148, 'admin', 'visite', 'main', '2014-11-01 14:51:29'),
(149, 'admin', 'login', NULL, '2014-11-01 14:51:30'),
(150, 'admin', 'visite', 'main', '2014-11-01 14:51:30'),
(151, 'admin', 'logout', NULL, '2014-11-01 14:51:33'),
(152, 'admin', 'login', NULL, '2014-11-01 14:54:47'),
(153, 'admin', 'visite', 'main', '2014-11-01 14:54:47'),
(154, 'kescalie', 'login', NULL, '2014-11-01 14:58:06'),
(155, 'kescalie', 'visite', 'main', '2014-11-01 14:58:06'),
(156, 'kescalie', 'visite', 'main', '2014-11-01 14:58:53'),
(157, 'kescalie', 'logout', NULL, '2014-11-01 15:01:21'),
(158, 'admin', 'login', NULL, '2014-11-01 15:01:35'),
(159, 'admin', 'visite', 'main', '2014-11-01 15:01:36'),
(160, 'admin', 'visite', 'admin', '2014-11-01 15:05:24'),
(161, 'admin', 'visite', 'index', '2014-11-01 15:05:34'),
(162, 'admin', 'visite', 'main', '2014-11-01 15:05:51'),
(163, 'admin', 'visite', 'admin', '2014-11-01 15:06:18'),
(164, 'admin', 'visite', 'index', '2014-11-01 15:06:22'),
(165, 'admin', 'visite', 'index', '2014-11-01 15:06:25'),
(166, 'admin', 'visite', 'admin', '2014-11-01 15:25:18'),
(167, 'admin', 'visite', 'admin', '2014-11-01 15:25:36'),
(168, 'admin', 'visite', 'admin', '2014-11-01 15:25:58'),
(169, 'admin', 'visite', 'admin', '2014-11-01 15:25:59'),
(170, 'admin', 'visite', 'admin', '2014-11-01 15:30:28'),
(171, 'admin', 'visite', 'admin', '2014-11-01 15:30:38'),
(172, 'admin', 'logout', NULL, '2014-11-01 15:33:35'),
(173, 'admin', 'login', NULL, '2014-11-01 15:33:49'),
(174, 'admin', 'visite', 'main', '2014-11-01 15:33:49'),
(175, 'admin', 'visite', 'admin', '2014-11-01 15:33:52'),
(176, 'admin', 'visite', 'admin', '2014-11-01 15:33:58'),
(177, 'admin', 'visite', 'index', '2014-11-01 15:35:11'),
(178, 'admin', 'visite', 'main', '2014-11-01 15:35:13'),
(179, 'admin', 'visite', 'admin', '2014-11-01 15:35:25'),
(180, 'admin', 'visite', 'admin', '2014-11-01 15:35:53'),
(181, 'admin', 'visite', 'index', '2014-11-01 15:35:55'),
(182, 'admin', 'logout', NULL, '2014-11-01 15:36:40'),
(183, 'kescalie', 'login', NULL, '2014-11-01 15:36:47'),
(184, 'kescalie', 'visite', 'main', '2014-11-01 15:36:56'),
(185, 'kescalie', 'visite', 'profile', '2014-11-01 15:37:06'),
(186, 'kescalie', 'visite', 'main', '2014-11-01 15:37:08'),
(187, 'kescalie', 'visite', 'main', '2014-11-01 15:44:09'),
(188, 'kescalie', 'visite', 'profile', '2014-11-01 15:44:10'),
(189, 'kescalie', 'logout', NULL, '2014-11-01 15:44:14'),
(190, 'admin', 'login', NULL, '2014-11-01 15:44:20'),
(191, 'admin', 'visite', 'main', '2014-11-01 15:44:53'),
(192, 'admin', 'visite', 'main', '2014-11-01 15:44:56'),
(193, 'admin', 'visite', 'main', '2014-11-01 15:44:58'),
(194, 'admin', 'visite', 'admin', '2014-11-01 15:45:22'),
(195, 'admin', 'visite', 'index', '2014-11-01 16:06:08'),
(196, 'admin', 'visite', 'main', '2014-11-01 16:06:09'),
(197, 'admin', 'visite', 'main', '2014-11-01 16:27:52'),
(198, 'admin', 'visite', 'main', '2014-11-01 16:29:48'),
(199, 'admin', 'visite', 'admin', '2014-11-01 16:38:01'),
(200, 'admin', 'visite', 'index', '2014-11-01 16:38:18'),
(201, 'admin', 'visite', 'index', '2014-11-01 16:46:19'),
(202, 'admin', 'logout', NULL, '2014-11-01 16:46:20'),
(203, 'admin', 'login', NULL, '2014-11-01 16:47:30'),
(204, 'admin', 'visite', 'main', '2014-11-01 16:47:41'),
(205, 'admin', 'login', NULL, '2014-11-01 16:47:46'),
(206, 'admin', 'visite', 'main', '2014-11-01 16:47:46'),
(207, 'admin', 'logout', NULL, '2014-11-01 16:50:15'),
(208, 'kescalie', 'login', NULL, '2014-11-01 16:50:21'),
(209, 'kescalie', 'visite', 'main', '2014-11-01 16:50:31'),
(210, 'kescalie', 'logout', NULL, '2014-11-01 16:50:43'),
(211, 'admin', 'login', NULL, '2014-11-01 16:50:47'),
(212, 'admin', 'visite', 'main', '2014-11-01 16:50:57'),
(213, 'admin', 'visite', 'admin', '2014-11-01 16:51:11'),
(214, 'admin', 'login', NULL, '2014-11-01 16:58:57'),
(215, 'admin', 'visite', 'main', '2014-11-01 16:59:09'),
(216, 'admin', 'login', NULL, '2014-11-01 16:59:12'),
(217, 'admin', 'login', NULL, '2014-11-01 16:59:13'),
(218, 'admin', 'login', NULL, '2014-11-01 16:59:13'),
(219, 'admin', 'login', NULL, '2014-11-01 16:59:15'),
(220, 'admin', 'visite', 'main', '2014-11-01 16:59:15'),
(221, 'kescalie', 'login', NULL, '2014-11-05 14:53:06'),
(222, 'kescalie', 'visite', 'main', '2014-11-05 14:53:06'),
(223, 'kescalie', 'visite', 'index', '2014-11-05 14:53:35'),
(224, 'kescalie', 'logout', NULL, '2014-11-05 14:53:40'),
(225, 'kescalie', 'login', NULL, '2014-11-05 14:53:48'),
(226, 'kescalie', 'visite', 'main', '2014-11-05 14:53:48'),
(227, 'kescalie', 'visite', 'main', '2014-11-05 14:54:03'),
(228, 'kescalie', 'visite', 'profile', '2014-11-05 14:54:05'),
(229, 'kescalie', 'logout', NULL, '2014-11-05 14:54:15'),
(230, 'admin', 'login', NULL, '2014-11-05 14:54:21'),
(231, 'admin', 'visite', 'main', '2014-11-05 14:54:22'),
(232, 'mdrissi', 'login', NULL, '2014-11-06 17:14:44'),
(233, 'mdrissi', 'visite', 'main', '2014-11-06 17:14:44'),
(234, 'mdrissi', 'visite', 'index', '2014-11-06 17:16:37'),
(235, 'mdrissi', 'visite', 'profile', '2014-11-06 17:16:43'),
(236, 'mdrissi', 'visite', 'main', '2014-11-06 17:17:09'),
(237, 'mdrissi', 'visite', 'index', '2014-11-06 17:17:10'),
(238, 'mdrissi', 'logout', NULL, '2014-11-06 17:19:38'),
(239, 'admin', 'login', NULL, '2014-11-06 17:19:47'),
(240, 'admin', 'visite', 'main', '2014-11-06 17:19:48'),
(241, 'admin', 'visite', 'admin', '2014-11-06 17:19:56'),
(242, 'admin', 'visite', 'main', '2014-11-06 17:21:13'),
(243, 'admin', 'visite', 'admin', '2014-11-06 17:21:24'),
(244, 'admin', 'visite', 'main', '2014-11-06 17:21:45'),
(245, 'admin', 'visite', 'index', '2014-11-06 17:21:47'),
(246, 'admin', 'logout', NULL, '2014-11-06 17:21:51'),
(247, 'totot', 'new account', NULL, '2014-11-06 17:22:38'),
(248, 'totot', 'login', NULL, '2014-11-06 17:22:51'),
(249, 'totot', 'visite', 'main', '2014-11-06 17:22:51'),
(250, 'totot', 'logout', NULL, '2014-11-06 17:22:59'),
(251, 'admin', 'login', NULL, '2014-11-06 17:23:08'),
(252, 'admin', 'visite', 'main', '2014-11-06 17:23:08'),
(253, 'admin', 'visite', 'admin', '2014-11-06 17:23:10'),
(254, 'kescalie', 'login', NULL, '2014-11-08 14:22:15'),
(255, 'kescalie', 'visite', 'main', '2014-11-08 14:22:38'),
(256, 'kescalie', 'logout', NULL, '2014-11-08 14:22:44'),
(257, 'kescalie', 'login', NULL, '2014-11-08 14:32:36'),
(258, 'kescalie', 'visite', 'main', '2014-11-08 14:32:36'),
(259, 'kescalie', 'logout', NULL, '2014-11-08 14:34:53'),
(260, 'kescalie', 'login', NULL, '2014-11-08 14:35:02'),
(261, 'kescalie', 'visite', 'main', '2014-11-08 14:35:43'),
(262, 'kescalie', 'logout', NULL, '2014-11-08 14:43:58'),
(263, 'admin', 'login', NULL, '2014-11-08 14:44:04'),
(264, 'admin', 'visite', 'main', '2014-11-08 14:44:04'),
(265, 'admin', 'logout', NULL, '2014-11-08 14:53:17'),
(266, 'admin', 'login', NULL, '2014-11-08 14:53:26'),
(267, 'admin', 'visite', 'main', '2014-11-08 14:53:27'),
(268, 'admin', 'logout', NULL, '2014-11-08 14:53:40'),
(269, 'admin', 'login', NULL, '2014-11-08 14:53:46'),
(270, 'admin', 'visite', 'main', '2014-11-08 14:53:46'),
(271, 'admin', 'visite', 'main', '2014-11-08 14:55:04'),
(272, 'admin', 'logout', NULL, '2014-11-08 14:55:06'),
(273, 'admin', 'login', NULL, '2014-11-08 14:55:11'),
(274, 'admin', 'visite', 'main', '2014-11-08 14:55:12'),
(275, 'admin', 'visite', 'main', '2014-11-08 14:55:35'),
(276, 'admin', 'visite', 'main', '2014-11-08 14:55:37'),
(277, 'admin', 'logout', NULL, '2014-11-08 14:55:38'),
(278, 'admin', 'login', NULL, '2014-11-08 14:55:45'),
(279, 'admin', 'visite', 'main', '2014-11-08 14:55:45'),
(280, 'admin', 'visite', 'main', '2014-11-08 14:57:40'),
(281, 'admin', 'logout', NULL, '2014-11-08 14:57:42'),
(282, 'admin', 'login', NULL, '2014-11-08 14:57:46'),
(283, 'admin', 'visite', 'main', '2014-11-08 14:57:47'),
(284, 'admin', 'visite', 'main', '2014-11-08 14:57:57'),
(285, 'admin', 'logout', NULL, '2014-11-08 14:57:58'),
(286, 'admin', 'login', NULL, '2014-11-08 14:58:03'),
(287, 'admin', 'visite', 'main', '2014-11-08 14:58:03'),
(288, 'admin', 'logout', NULL, '2014-11-08 14:58:27'),
(289, 'admin', 'login', NULL, '2014-11-08 14:58:31'),
(290, 'admin', 'visite', 'main', '2014-11-08 14:58:32'),
(291, 'admin', 'logout', NULL, '2014-11-08 14:58:51'),
(292, 'admin', 'login', NULL, '2014-11-08 14:58:55'),
(293, 'admin', 'visite', 'main', '2014-11-08 14:58:55'),
(294, 'admin', 'visite', 'main', '2014-11-08 14:59:59'),
(295, 'admin', 'logout', NULL, '2014-11-08 15:00:03'),
(296, '0', 'logout', NULL, '2014-11-08 15:00:03'),
(297, 'admin', 'logout', NULL, '2014-11-08 15:00:03'),
(298, 'kescalie', 'login', NULL, '2014-11-08 15:07:30'),
(299, 'kescalie', 'visite', 'main', '2014-11-08 15:07:31'),
(300, 'kescalie', 'logout', NULL, '2014-11-08 15:07:38'),
(301, 'kescalie', 'login', NULL, '2014-11-08 15:35:36'),
(302, 'kescalie', 'visite', 'main', '2014-11-08 15:35:36'),
(303, 'kescalie', 'visite', 'main', '2014-11-08 15:36:01'),
(304, 'kescalie', 'visite', 'main', '2014-11-08 15:36:04'),
(305, 'kescalie', 'login', NULL, '2014-11-08 15:36:20'),
(306, 'kescalie', 'visite', 'main', '2014-11-08 15:39:46'),
(307, 'kescalie', 'visite', 'main', '2014-11-08 15:41:55'),
(308, 'kescalie', 'logout', NULL, '2014-11-08 15:41:57'),
(309, 'admin', 'login', NULL, '2014-11-08 15:47:58'),
(310, 'admin', 'login', NULL, '2014-11-08 15:48:44'),
(311, 'admin', 'login', NULL, '2014-11-08 15:58:25'),
(312, 'admin', 'visite', 'main', '2014-11-08 15:58:26'),
(313, 'admin', 'logout', NULL, '2014-11-08 15:58:44'),
(314, 'kescalie', 'login', NULL, '2014-11-08 16:03:30'),
(315, 'kescalie', 'visite', 'main', '2014-11-08 16:03:30'),
(316, 'kescalie', 'logout', NULL, '2014-11-08 16:03:39'),
(317, 'kescalie', 'login', NULL, '2014-11-08 16:04:24'),
(318, 'kescalie', 'visite', 'main', '2014-11-08 16:04:24'),
(319, 'kescalie', 'logout', NULL, '2014-11-08 16:04:29'),
(320, 'kescalie', 'login', NULL, '2014-11-08 16:04:38'),
(321, 'kescalie', 'visite', 'main', '2014-11-08 16:04:38'),
(322, 'kescalie', 'visite', 'main', '2014-11-08 16:05:38'),
(323, 'kescalie', 'logout', NULL, '2014-11-08 16:05:40'),
(324, 'kescalie', 'login', NULL, '2014-11-08 16:05:53'),
(325, 'kescalie', 'visite', 'main', '2014-11-08 16:05:53'),
(326, 'kescalie', 'visite', 'main', '2014-11-08 16:06:24'),
(327, 'kescalie', 'logout', NULL, '2014-11-08 16:06:25'),
(328, 'kescalie', 'login', NULL, '2014-11-08 16:06:31'),
(329, 'kescalie', 'visite', 'main', '2014-11-08 16:06:31'),
(330, 'kescalie', 'visite', 'main', '2014-11-08 16:07:43'),
(331, 'kescalie', 'logout', NULL, '2014-11-08 16:07:45'),
(332, 'kescalie', 'login', NULL, '2014-11-08 16:07:52'),
(333, 'kescalie', 'visite', 'main', '2014-11-08 16:07:52'),
(334, 'kescalie', 'logout', NULL, '2014-11-08 16:07:59'),
(335, 'eglondu', 'login', NULL, '2014-11-08 16:08:28'),
(336, 'eglondu', 'visite', 'main', '2014-11-08 16:08:28'),
(337, 'eglondu', 'visite', 'main', '2014-11-08 16:12:38'),
(338, 'eglondu', 'logout', NULL, '2014-11-08 16:12:39'),
(339, 'admin', 'login', NULL, '2014-11-08 16:12:45'),
(340, 'admin', 'visite', 'main', '2014-11-08 16:13:37'),
(341, 'admin', 'logout', NULL, '2014-11-08 16:13:39'),
(342, 'kescalie', 'login', NULL, '2014-11-08 16:13:47'),
(343, 'kescalie', 'visite', 'main', '2014-11-08 16:13:47'),
(344, 'kescalie', 'visite', 'index', '2014-11-08 16:14:45'),
(345, 'kescalie', 'logout', NULL, '2014-11-08 16:14:51'),
(346, 'admin', 'login', NULL, '2014-11-08 16:15:23'),
(347, 'admin', 'visite', 'main', '2014-11-08 16:15:23'),
(348, 'admin', 'logout', NULL, '2014-11-08 16:15:26'),
(349, 'kescalie', 'login', NULL, '2014-11-08 16:15:38'),
(350, 'kescalie', 'visite', 'main', '2014-11-08 16:15:38'),
(351, 'kescalie', 'logout', NULL, '2014-11-08 16:15:40'),
(352, 'kescalie', 'login', NULL, '2014-11-09 11:19:34'),
(353, 'kescalie', 'visite', 'main', '2014-11-09 11:19:34'),
(354, 'kescalie', 'visite', 'index', '2014-11-09 11:19:39'),
(355, 'kescalie', 'logout', NULL, '2014-11-09 11:21:18'),
(356, 'kescalie', 'login', NULL, '2014-11-09 11:21:53'),
(357, 'kescalie', 'visite', 'main', '2014-11-09 11:21:53'),
(358, 'kescalie', 'visite', 'main', '2014-11-09 11:27:38'),
(359, 'kescalie', 'visite', 'index', '2014-11-09 11:27:42'),
(360, 'kescalie', 'visite', 'index', '2014-11-09 11:27:58'),
(361, 'kescalie', 'visite', 'main', '2014-11-09 11:28:01'),
(362, 'kescalie', 'visite', 'profile', '2014-11-09 11:28:02'),
(363, 'kescalie', 'visite', 'index', '2014-11-09 11:28:05'),
(364, 'admin', 'login', NULL, '2014-11-18 10:02:12'),
(365, 'admin', 'visite', 'main', '2014-11-18 10:02:13'),
(366, 'admin', 'login', NULL, '2014-11-26 10:59:46'),
(367, 'admin', 'visite', 'main', '2014-11-26 10:59:46'),
(368, 'admin', 'visite', 'index', '2014-11-26 11:00:09'),
(369, 'admin', 'visite', 'profile', '2014-11-26 11:00:11'),
(370, 'admin', 'visite', 'admin', '2014-11-26 11:00:13'),
(371, 'admin', 'logout', NULL, '2014-11-26 11:04:54'),
(372, 'admin', 'login', NULL, '2014-11-26 11:05:17'),
(373, 'admin', 'visite', 'main', '2014-11-26 11:05:17'),
(374, 'admin', 'logout', NULL, '2014-11-26 11:05:25'),
(375, 'admin', 'login', NULL, '2014-11-26 11:06:11'),
(376, 'admin', 'visite', 'main', '2014-11-26 11:06:11'),
(377, 'admin', 'logout', NULL, '2014-11-26 11:08:15'),
(378, 'admin', 'login', NULL, '2014-11-26 11:08:39'),
(379, 'admin', 'visite', 'main', '2014-11-26 11:08:39'),
(380, 'admin', 'logout', NULL, '2014-11-26 11:08:58'),
(381, 'admin', 'login', NULL, '2014-11-26 11:09:08'),
(382, 'admin', 'visite', 'main', '2014-11-26 11:09:08'),
(383, 'admin', 'visite', 'main', '2014-11-26 11:17:37'),
(384, 'admin', 'logout', NULL, '2014-11-26 11:17:39'),
(385, 'admin', 'login', NULL, '2014-11-26 11:17:43'),
(386, 'admin', 'visite', 'main', '2014-11-26 11:17:43'),
(387, 'admin', 'logout', NULL, '2014-11-26 11:18:18'),
(388, 'admin', 'login', NULL, '2014-11-26 11:18:23'),
(389, 'admin', 'visite', 'main', '2014-11-26 11:18:23'),
(390, 'admin', 'logout', NULL, '2014-11-26 11:20:38'),
(391, 'admin', 'login', NULL, '2014-11-26 11:23:53'),
(392, 'admin', 'visite', 'main', '2014-11-26 11:23:53'),
(393, 'admin', 'logout', NULL, '2014-11-26 11:29:42'),
(394, 'admin', 'login', NULL, '2014-11-26 11:29:45'),
(395, 'admin', 'visite', 'main', '2014-11-26 11:29:45'),
(396, 'admin', 'logout', NULL, '2014-11-26 11:30:01'),
(397, 'admin', 'login', NULL, '2014-11-26 13:06:52'),
(398, 'admin', 'visite', 'main', '2014-11-26 13:06:52'),
(399, 'admin', 'visite', 'index', '2014-11-26 13:06:59'),
(400, 'admin', 'visite', 'main', '2014-11-26 13:09:39'),
(401, 'admin', 'logout', NULL, '2014-11-26 13:09:40'),
(402, 'admin', 'login', NULL, '2014-11-26 13:31:10'),
(403, 'admin', 'visite', 'main', '2014-11-26 13:31:10'),
(404, 'admin', 'visite', 'main', '2014-11-26 13:33:13'),
(405, 'admin', 'visite', 'admin', '2014-11-26 13:33:15'),
(406, 'admin', 'visite', 'admin', '2014-11-26 13:34:17'),
(407, 'admin', 'login', NULL, '2014-11-26 15:02:43'),
(408, 'admin', 'visite', 'main', '2014-11-26 15:02:43'),
(409, 'admin', 'logout', NULL, '2014-11-26 15:02:48'),
(410, 'admin', 'login', NULL, '2014-11-26 15:12:46'),
(411, 'admin', 'visite', 'main', '2014-11-26 15:12:46'),
(412, 'admin', 'visite', 'admin', '2014-11-26 15:12:48'),
(413, 'admin', 'visite', 'admin', '2014-11-26 15:13:21'),
(414, 'admin', 'visite', 'admin', '2014-11-26 15:24:04'),
(415, 'admin', 'visite', 'admin', '2014-11-26 15:24:34'),
(416, 'admin', 'visite', 'admin', '2014-11-26 15:38:34'),
(417, 'admin', 'visite', 'admin', '2014-11-26 15:38:43'),
(418, 'admin', 'visite', 'admin', '2014-11-26 16:21:06'),
(419, 'admin', 'visite', 'admin', '2014-11-26 16:24:32'),
(420, 'admin', 'visite', 'admin', '2014-11-26 16:26:42'),
(421, 'admin', 'visite', 'admin', '2014-11-26 16:28:48'),
(422, 'admin', 'visite', 'admin', '2014-11-26 16:29:34'),
(423, 'admin', 'visite', 'admin', '2014-11-26 16:30:02'),
(424, 'admin', 'visite', 'admin', '2014-11-26 16:35:24'),
(425, 'admin', 'visite', 'admin', '2014-11-26 16:35:43'),
(426, 'admin', 'visite', 'admin', '2014-11-26 16:35:52'),
(427, 'admin', 'visite', 'admin', '2014-11-26 16:35:53'),
(428, 'admin', 'visite', 'admin', '2014-11-26 16:36:01'),
(429, 'admin', 'visite', 'admin', '2014-11-26 16:50:37'),
(430, 'admin', 'visite', 'admin', '2014-11-26 17:18:11'),
(431, 'admin', 'visite', 'admin', '2014-11-26 17:20:29'),
(432, 'admin', 'visite', 'admin', '2014-11-26 17:22:19'),
(433, 'admin', 'visite', 'admin', '2014-11-26 17:27:33'),
(434, 'admin', 'visite', 'admin', '2014-11-26 17:27:48'),
(435, 'admin', 'visite', 'admin', '2014-11-26 17:28:13'),
(436, 'admin', 'visite', 'admin', '2014-11-26 17:28:45'),
(437, 'admin', 'visite', 'admin', '2014-11-26 17:29:12'),
(438, 'admin', 'visite', 'admin', '2014-11-26 17:31:38'),
(439, 'admin', 'visite', 'admin', '2014-11-26 17:48:56'),
(440, 'admin', 'visite', 'admin', '2014-11-26 17:49:34'),
(441, 'admin', 'logout', NULL, '2014-11-26 17:54:58'),
(442, 'admin', 'login', NULL, '2014-11-26 17:55:17'),
(443, 'admin', 'visite', 'main', '2014-11-26 17:55:17'),
(444, 'admin', 'visite', 'admin', '2014-11-26 17:55:20'),
(445, 'admin', 'visite', 'admin', '2014-11-26 18:03:18'),
(446, 'admin', 'visite', 'admin', '2014-11-26 18:03:43'),
(447, 'admin', 'visite', 'admin', '2014-11-26 18:20:10'),
(448, 'admin', 'visite', 'admin', '2014-11-26 18:21:53'),
(449, 'admin', 'visite', 'admin', '2014-11-26 18:22:02'),
(450, 'admin', 'visite', 'admin', '2014-11-26 18:26:44'),
(451, 'admin', 'login', NULL, '2014-11-27 10:04:10'),
(452, 'admin', 'visite', 'main', '2014-11-27 10:04:10'),
(453, 'admin', 'visite', 'admin', '2014-11-27 10:04:14'),
(454, 'admin', 'visite', 'admin', '2014-11-27 10:18:15'),
(455, 'admin', 'login', NULL, '2014-11-27 13:41:18'),
(456, 'admin', 'visite', 'main', '2014-11-27 13:41:18'),
(457, 'admin', 'visite', 'index', '2014-11-27 13:41:23'),
(458, 'admin', 'visite', 'index', '2014-11-27 13:41:30'),
(459, 'admin', 'visite', 'index', '2014-11-27 14:23:55'),
(460, 'admin', 'logout', NULL, '2014-11-27 14:24:09'),
(461, 'admin', 'login', NULL, '2014-11-27 14:32:33'),
(462, 'admin', 'visite', 'main', '2014-11-27 14:32:33'),
(463, 'admin', 'visite', 'index', '2014-11-27 14:33:32'),
(464, 'admin', 'visite', 'profile', '2014-11-27 14:54:33'),
(465, 'admin', 'visite', 'profile', '2014-11-27 15:18:41'),
(466, 'admin', 'visite', 'profile', '2014-11-27 15:24:04'),
(467, 'admin', 'visite', 'profile', '2014-11-27 16:08:28'),
(468, 'admin', 'visite', 'index', '2014-11-27 17:06:50'),
(469, 'admin', 'visite', 'profile', '2014-11-27 17:06:52'),
(470, 'admin', 'visite', 'profile', '2014-11-27 17:07:30'),
(471, 'admin', 'visite', 'profile', '2014-11-27 17:28:27'),
(472, 'admin', 'visite', 'profile', '2014-11-27 17:28:54'),
(473, 'admin', 'visite', 'profile', '2014-11-27 17:29:15'),
(474, 'admin', 'visite', 'profile', '2014-11-27 17:38:59'),
(475, 'admin', 'login', NULL, '2014-11-27 17:39:31'),
(476, 'admin', 'visite', 'main', '2014-11-27 17:39:31'),
(477, 'admin', 'visite', 'profile', '2014-11-27 17:39:34'),
(478, 'admin', 'visite', 'profile', '2014-11-27 17:39:36'),
(479, 'admin', 'logout', NULL, '2014-11-27 17:40:42'),
(480, 'admin', 'login', NULL, '2014-11-28 11:05:18'),
(481, 'admin', 'visite', 'main', '2014-11-28 11:05:18'),
(482, 'admin', 'visite', 'admin', '2014-11-28 11:05:23'),
(483, 'admin', 'visite', 'admin', '2014-11-28 11:05:57'),
(484, 'admin', 'logout', NULL, '2014-11-28 11:07:54'),
(485, 'haricot', 'login', NULL, '2014-11-28 11:07:59'),
(486, 'haricot', 'visite', 'main', '2014-11-28 11:07:59'),
(487, 'haricot', 'visite', 'index', '2014-11-28 11:08:03'),
(488, 'haricot', 'logout', NULL, '2014-11-28 11:08:04'),
(489, 'admin', 'login', NULL, '2014-11-28 11:08:42'),
(490, 'admin', 'visite', 'main', '2014-11-28 11:08:42'),
(491, 'admin', 'visite', 'admin', '2014-11-28 11:08:44'),
(492, 'admin', 'visite', 'admin', '2014-11-28 11:09:03'),
(493, 'admin', 'visite', 'admin', '2014-11-28 11:10:37'),
(494, 'admin', 'visite', 'admin', '2014-11-28 11:12:13'),
(495, 'admin', 'visite', 'admin', '2014-11-28 11:52:02'),
(496, 'admin', 'logout', NULL, '2014-11-28 11:52:03'),
(497, 'admin', 'login', NULL, '2014-11-28 11:52:08'),
(498, 'admin', 'visite', 'index', '2014-11-28 12:58:21'),
(499, 'admin', 'login', NULL, '2014-11-28 12:58:41'),
(500, 'admin', 'visite', 'main', '2014-11-28 12:59:01'),
(501, 'admin', 'visite', 'admin', '2014-11-28 13:17:09'),
(502, 'admin', 'visite', 'admin', '2014-11-28 13:19:51'),
(503, 'admin', 'visite', 'admin', '2014-11-28 13:24:54'),
(504, 'admin', 'visite', 'profile', '2014-11-28 13:27:35'),
(505, 'admin', 'visite', 'profile', '2014-11-28 13:32:06'),
(506, 'admin', 'visite', 'profile', '2014-11-28 13:32:35'),
(507, 'admin', 'visite', 'profile', '2014-11-28 13:33:18'),
(508, 'admin', 'visite', 'profile', '2014-11-28 13:39:51'),
(509, 'admin', 'logout', NULL, '2014-11-28 13:40:07'),
(510, 'admin', 'login', NULL, '2014-11-28 13:41:05'),
(511, 'admin', 'visite', 'main', '2014-11-28 13:41:26'),
(512, 'admin', 'visite', 'admin', '2014-11-28 13:41:28'),
(513, 'admin', 'visite', 'admin', '2014-11-28 14:00:21'),
(514, 'admin', 'visite', 'admin', '2014-11-28 14:06:44'),
(515, 'admin', 'visite', 'admin', '2014-11-28 14:07:57'),
(516, 'admin', 'visite', 'index', '2014-11-28 14:08:00'),
(517, 'admin', 'visite', 'admin', '2014-11-28 14:08:02'),
(518, 'admin', 'visite', 'admin', '2014-11-28 14:09:15'),
(519, 'admin', 'visite', 'admin', '2014-11-28 14:11:09'),
(520, 'admin', 'visite', 'admin', '2014-11-28 14:28:02'),
(521, 'admin', 'visite', 'admin', '2014-11-28 14:31:17'),
(522, 'admin', 'visite', 'admin', '2014-11-28 14:46:40'),
(523, 'admin', 'visite', 'admin', '2014-11-28 14:47:03'),
(524, 'admin', 'visite', 'admin', '2014-11-28 14:47:28'),
(525, 'admin', 'visite', 'admin', '2014-11-28 14:48:47'),
(526, 'admin', 'visite', 'admin', '2014-11-28 14:54:54'),
(527, 'admin', 'visite', 'admin', '2014-11-28 14:55:15'),
(528, 'admin', 'visite', 'admin', '2014-11-28 14:57:38'),
(529, 'admin', 'visite', 'admin', '2014-11-28 14:57:43'),
(530, 'admin', 'visite', 'admin', '2014-11-28 14:58:00'),
(531, 'admin', 'visite', 'admin', '2014-11-28 14:58:16'),
(532, 'admin', 'visite', 'admin', '2014-11-28 15:05:19'),
(533, 'admin', 'visite', 'admin', '2014-11-28 15:28:18'),
(534, 'admin', 'visite', 'admin', '2014-11-28 16:10:09'),
(535, 'admin', 'visite', 'admin', '2014-11-28 16:10:16'),
(536, 'admin', 'visite', 'admin', '2014-11-28 16:33:25'),
(537, 'admin', 'visite', 'index', '2014-11-28 16:47:55'),
(538, 'admin', 'visite', 'admin', '2014-11-28 16:47:59'),
(539, 'admin', 'visite', 'index', '2014-11-28 16:48:24'),
(540, 'admin', 'login', NULL, '2014-11-28 16:52:11'),
(541, 'admin', 'visite', 'main', '2014-11-28 16:52:41'),
(542, 'admin', 'login', NULL, '2014-11-28 16:52:43'),
(543, 'admin', 'visite', 'main', '2014-11-28 16:52:43'),
(544, 'admin', 'visite', 'admin', '2014-11-28 16:52:48'),
(545, 'admin', 'visite', 'admin', '2014-11-28 16:59:37'),
(546, 'admin', 'visite', 'profile', '2014-11-28 16:59:39'),
(547, 'admin', 'visite', 'admin', '2014-11-28 16:59:45'),
(548, 'admin', 'visite', 'admin', '2014-11-28 17:24:52'),
(549, 'admin', 'visite', 'admin', '2014-11-28 17:29:48'),
(550, 'admin', 'visite', 'admin', '2014-11-28 17:46:30'),
(551, 'admin', 'visite', 'admin', '2014-11-28 17:49:02'),
(552, 'admin', 'visite', 'admin', '2014-11-28 17:55:23'),
(553, 'admin', 'visite', 'admin', '2014-11-28 18:01:48'),
(554, 'admin', 'visite', 'admin', '2014-11-28 18:02:02'),
(555, 'admin', 'visite', 'admin', '2014-11-28 18:03:28'),
(556, 'admin', 'login', NULL, '2014-11-29 10:49:26'),
(557, 'admin', 'visite', 'main', '2014-11-29 10:50:06'),
(558, 'admin', 'login', NULL, '2014-11-29 10:50:07'),
(559, 'admin', 'login', NULL, '2014-11-29 10:50:23'),
(560, 'admin', 'visite', 'index', '2014-11-29 10:50:25'),
(561, 'admin', 'login', NULL, '2014-11-29 10:50:31'),
(562, 'admin', 'visite', 'index', '2014-11-29 10:50:33'),
(563, 'admin', 'visite', 'admin', '2014-11-29 10:53:02'),
(564, 'admin', 'login', NULL, '2014-11-29 13:52:32'),
(565, 'admin', 'visite', 'main', '2014-11-29 13:53:04'),
(566, 'admin', 'visite', 'admin', '2014-11-29 13:58:00'),
(567, 'admin', 'visite', 'admin', '2014-11-29 13:58:17'),
(568, 'admin', 'visite', 'admin', '2014-11-29 13:58:36'),
(569, 'admin', 'visite', 'admin', '2014-11-29 13:58:55'),
(570, 'admin', 'visite', 'admin', '2014-11-29 13:59:07'),
(571, 'admin', 'visite', 'index', '2014-11-29 13:59:55'),
(572, 'admin', 'visite', 'admin', '2014-11-29 13:59:56'),
(573, 'admin', 'visite', 'admin', '2014-11-29 14:30:44'),
(574, 'admin', 'visite', 'admin', '2014-11-29 14:31:01'),
(575, 'admin', 'visite', 'admin', '2014-11-29 14:33:23'),
(576, 'admin', 'visite', 'admin', '2014-11-29 14:35:27'),
(577, 'admin', 'visite', 'admin', '2014-11-29 14:58:10'),
(578, 'admin', 'visite', 'admin', '2014-11-29 14:59:49'),
(579, 'admin', 'visite', 'admin', '2014-11-29 15:01:15'),
(580, 'admin', 'visite', 'admin', '2014-11-29 15:01:23'),
(581, 'admin', 'visite', 'admin', '2014-11-29 15:02:27'),
(582, 'admin', 'visite', 'admin', '2014-11-29 15:02:41'),
(583, 'admin', 'visite', 'admin', '2014-11-29 15:03:24'),
(584, 'admin', 'visite', 'admin', '2014-11-29 15:03:29'),
(585, 'admin', 'visite', 'admin', '2014-11-29 15:18:11'),
(586, 'admin', 'visite', 'admin', '2014-11-29 15:18:16'),
(587, 'admin', 'visite', 'admin', '2014-11-29 15:19:32'),
(588, 'admin', 'visite', 'admin', '2014-11-29 15:19:34'),
(589, 'admin', 'visite', 'profile', '2014-11-29 15:19:48'),
(590, 'admin', 'visite', 'admin', '2014-11-29 15:20:04'),
(591, 'admin', 'visite', 'admin', '2014-11-29 15:20:08'),
(592, 'admin', 'visite', 'profile', '2014-11-29 15:20:10'),
(593, 'admin', 'visite', 'admin', '2014-11-29 15:20:11'),
(594, 'admin', 'logout', NULL, '2014-11-29 15:21:25'),
(595, 'kescalie', 'login', NULL, '2014-11-29 15:21:44'),
(596, 'kescalie', 'visite', 'main', '2014-11-29 15:22:13'),
(597, 'kescalie', 'visite', 'profile', '2014-11-29 16:02:38'),
(598, 'kescalie', 'visite', 'profile', '2014-11-29 16:03:03'),
(599, 'kescalie', 'visite', 'profile', '2014-11-29 16:04:58'),
(600, 'kescalie', 'logout', NULL, '2014-11-29 16:06:09'),
(601, 'admin', 'login', NULL, '2014-11-29 16:06:15'),
(602, 'admin', 'visite', 'main', '2014-11-29 16:06:45'),
(603, 'admin', 'visite', 'admin', '2014-11-29 16:08:01'),
(604, 'admin', 'login', NULL, '2014-12-01 15:13:07'),
(605, 'admin', 'visite', 'main', '2014-12-01 15:13:36'),
(606, 'admin', 'login', NULL, '2014-12-01 15:14:03'),
(607, 'admin', 'visite', 'main', '2014-12-01 15:14:03'),
(608, 'admin', 'visite', 'admin', '2014-12-01 15:38:23'),
(609, 'admin', 'visite', 'admin', '2014-12-01 15:58:12'),
(610, 'admin', 'visite', 'admin', '2014-12-01 15:58:15'),
(611, 'admin', 'visite', 'admin', '2014-12-01 15:58:45'),
(612, 'admin', 'visite', 'admin', '2014-12-01 15:58:46'),
(613, 'admin', 'visite', 'admin', '2014-12-01 15:59:59'),
(614, 'admin', 'visite', 'admin', '2014-12-01 16:10:35'),
(615, 'admin', 'visite', 'admin', '2014-12-01 16:10:40'),
(616, 'admin', 'visite', 'admin', '2014-12-01 16:10:42'),
(617, 'admin', 'visite', 'admin', '2014-12-01 16:10:43'),
(618, 'admin', 'visite', 'admin', '2014-12-01 16:10:52'),
(619, 'admin', 'visite', 'admin', '2014-12-01 16:18:45'),
(620, 'admin', 'visite', 'admin', '2014-12-01 16:18:46'),
(621, 'admin', 'visite', 'admin', '2014-12-01 16:18:47'),
(622, 'admin', 'visite', 'admin', '2014-12-01 16:18:49'),
(623, 'admin', 'visite', 'admin', '2014-12-01 16:19:50'),
(624, 'admin', 'visite', 'admin', '2014-12-01 16:19:52'),
(625, 'admin', 'visite', 'admin', '2014-12-01 16:20:03'),
(626, 'admin', 'visite', 'admin', '2014-12-01 16:20:35'),
(627, 'admin', 'visite', 'admin', '2014-12-01 16:20:47'),
(628, 'admin', 'visite', 'admin', '2014-12-01 16:20:55'),
(629, 'admin', 'visite', 'admin', '2014-12-01 16:20:57'),
(630, 'admin', 'visite', 'admin', '2014-12-01 16:20:59'),
(631, 'admin', 'visite', 'admin', '2014-12-01 16:21:01'),
(632, 'admin', 'visite', 'admin', '2014-12-01 16:21:02'),
(633, 'admin', 'visite', 'admin', '2014-12-01 16:25:47'),
(634, 'admin', 'visite', 'admin', '2014-12-01 16:44:43'),
(635, 'admin', 'visite', 'admin', '2014-12-01 16:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(42) NOT NULL,
  `description` varchar(150) NOT NULL,
  `places_nb` int(11) NOT NULL,
  `reg_start` datetime NOT NULL,
  `reg_end` datetime NOT NULL,
  `module_start` datetime NOT NULL,
  `module_end` datetime NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL COMMENT 'Summary of the problem',
  `description` text NOT NULL COMMENT 'description of the issue',
  `login` tinytext NOT NULL,
  `admin` tinytext NOT NULL,
  `priority` tinyint(4) NOT NULL COMMENT 'the more the value the more the urgency',
  `open` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `login`, `admin`, `priority`, `open`) VALUES
(1, 'creation de ticket', 'je sais pas si ça marche oulala', 'admin', 'admin', 2, 1),
(2, 'Des gauffres volantes', 'Je me suis fait attaqué ce matin par une gauffre volante, appelez la police', 'admin', 'admin', 0, 1),
(3, 'test reouverture', 'si ca marche pas je fais quoi ?', 'kescalie', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_messages`
--

CREATE TABLE IF NOT EXISTS `tickets_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT 'message''s ticket id',
  `message` text NOT NULL,
  `login` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `tid_2` (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tickets_messages`
--

INSERT INTO `tickets_messages` (`id`, `tid`, `message`, `login`) VALUES
(2, 1, 'coucou', 'admin'),
(3, 1, 'Oui ?', 'Unknown'),
(4, 1, 'Bonjour', 'admin'),
(5, 1, 'ca a marche', 'admin'),
(6, 2, 'bonjour,\nnon,\ncordialement', 'admin'),
(7, 3, 'je m''en fous. Ha non c''est moi', 'kescalie'),
(8, 3, 'je m''en fous. Ha non c''est moi', 'kescalie'),
(9, 3, 'Heu double poste normal ?', 'admin'),
(10, 3, 'Heu double poste normal ?', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` tinytext NOT NULL,
  `pass` text NOT NULL,
  `email` tinytext NOT NULL,
  `first_name` tinytext NOT NULL,
  `surname` tinytext NOT NULL,
  `avatar` text,
  `gender` int(11) NOT NULL DEFAULT '0',
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `language` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `first_name`, `surname`, `avatar`, `gender`, `creation`, `status`, `language`) VALUES
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'arx@hotmail.fr', 'admin', 'admin', '0', 1, '2014-09-26 16:40:38', 2, 'french'),
(9, 'Nournous', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lol@hotmail.fr', 'po', '', NULL, 1, '2014-11-26 17:49:33', 0, NULL),
(10, 'haricot', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'lol@hotmail.fr', 'vert', '', NULL, 1, '2014-11-28 11:05:57', -1, 'french'),
(11, 'Castor Raptor', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lol@hotmail.fr', 'Teddy', '', NULL, 1, '2014-11-28 11:09:03', 1, NULL),
(12, 'chicou', '1a2bf0adea0f4b41ed9f7a02d31fa535d5743f3e', 'magic_lutin@mystic.creature.com', 'Eric', '', NULL, 1, '2014-11-28 11:10:37', 0, NULL),
(13, 'Mouhahaha', '1411678a0b9e25ee2f7c8b2f7ac92b6a74b3f9c5', 'Devil_horn@hell.hl', 'Devil', '', NULL, 1, '2014-11-28 11:12:11', 0, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `module` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_messages`
--
ALTER TABLE `forum_messages`
  ADD CONSTRAINT `forum_messages_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `forum_topics` (`id`);

--
-- Constraints for table `tickets_messages`
--
ALTER TABLE `tickets_messages`
  ADD CONSTRAINT `tickets_messages_tid` FOREIGN KEY (`tid`) REFERENCES `tickets` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
