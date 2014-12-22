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
