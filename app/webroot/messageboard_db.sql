-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2015 at 06:00 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `messageboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `to_id` (`to_id`),
  KEY `from_id` (`from_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_id`, `from_id`, `content`, `created`, `modified`) VALUES
(1, 4, 1, 'ss', '2015-10-19 12:08:44', '2015-10-19 12:08:44'),
(2, 2, 1, 'sdf', '2015-10-19 14:38:57', '2015-10-19 14:38:57'),
(3, 2, 1, 'sadf', '2015-10-19 15:18:21', '2015-10-19 15:18:21'),
(4, 3, 1, 's', '2015-10-19 15:25:35', '2015-10-19 15:25:35'),
(5, 2, 1, 'd', '2015-10-19 15:32:10', '2015-10-19 15:32:10'),
(6, 2, 1, 's', '2015-10-19 15:38:24', '2015-10-19 15:38:24'),
(7, 2, 1, 's', '2015-10-19 15:39:37', '2015-10-19 15:39:37'),
(8, 2, 1, 'd', '2015-10-19 15:39:41', '2015-10-19 15:39:41'),
(9, 2, 1, 'sdf', '2015-10-19 15:40:16', '2015-10-19 15:40:16'),
(10, 2, 1, 'ssdfsdf', '2015-10-19 15:41:17', '2015-10-19 15:41:17'),
(11, 2, 1, 'sdfgsdfg', '2015-10-19 15:41:42', '2015-10-19 15:41:42'),
(12, 2, 1, 'dsfdf', '2015-10-19 15:42:58', '2015-10-19 15:42:58'),
(13, 2, 1, 'sdf', '2015-10-19 15:49:14', '2015-10-19 15:49:14'),
(14, 2, 1, 'fsadfasdfasf', '2015-10-19 15:49:17', '2015-10-19 15:49:17'),
(15, 2, 1, '23423423', '2015-10-19 15:49:22', '2015-10-19 15:49:22'),
(16, 3, 1, 'sdf', '2015-10-19 16:23:15', '2015-10-19 16:23:15'),
(17, 3, 1, 'dsfgsd', '2015-10-19 17:53:41', '2015-10-19 17:53:41'),
(18, 6, 1, 'rafael', '2015-10-19 17:54:06', '2015-10-19 17:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hubby` text,
  `last_login_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `modified_ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(1, 'Jepoy Merioles', 'jeffrey@email.com', 'ff935dbec485fb35469ded69f84cf35eb48715e6', '1.jpg', '1', '2015-10-04', 'I choose to learn more about web developments.\r\nI watch tutorials for cakePHP to enhance my knowledge and skills.', '2015-10-19 17:59:28', '2015-10-15 10:00:14', '2015-10-19 14:49:37', '', ''),
(2, 'Lester Padul', 'lester@email.com', '4412d051e679401624c66e4199280ac53735034f', '2.jpg', '1', NULL, '', '2015-10-19 10:29:13', '2015-10-15 10:00:59', '2015-10-15 17:18:43', '', ''),
(3, 'Yongbo Maniquez', 'yongbo@email.com', '8714fcc78e99b482d438dd10d752a2d4336ec2a3', '3.jpg', '1', NULL, '', '2015-10-16 14:51:07', '2015-10-15 12:56:21', '2015-10-15 17:18:00', '', ''),
(4, 'Kimberly', 'kimberly@email.com', 'ba83031e0a92d8e3c603e6dea7759442b0f29f32', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2015-10-16 17:05:11', '2015-10-16 17:05:11', '', ''),
(5, 'Richer', 'rich@email.com', '7d1435a7434e6ee9d872c0fbd0457d2f4f502f64', '5.jpg', '', NULL, '', '2015-10-19 17:59:09', '2015-10-16 17:06:12', '2015-10-19 17:59:21', '', ''),
(6, 'Rafael', 'rafael@email.com', '862cd79207404f19209f20d7068e1e07801c5e95', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2015-10-16 17:06:32', '2015-10-16 17:06:32', '', ''),
(7, 'Blezel', 'blezel@emai.com', '1636ffe3829af27df96e546c498e5e30bb5c1c0f', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2015-10-16 17:06:55', '2015-10-16 17:06:55', '', ''),
(8, 'Kate Edoloverio', 'kate@email.com', '1546987f1aef23064f867b6c893378970f3f5cb5', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2015-10-16 17:07:20', '2015-10-16 17:07:20', '', ''),
(9, 'Jessica', 'jessica@email.com', 'd47e7680a1b1adb4ba0ad299fcf89398142c42df', NULL, NULL, NULL, NULL, '2015-10-19 14:48:30', '2015-10-19 14:48:18', '2015-10-19 14:48:18', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
