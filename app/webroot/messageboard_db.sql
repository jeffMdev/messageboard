-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2015 at 07:08 PM
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(16, 'jeffrey', 'jepoy@email.com', '9b3fedba6e99b9cfe0e8def5befbe14b74a502e2', 'pic_02.jpg', '1', '1986-11-11', 'My hubby: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at molestie arcu. Morbi ut hendrerit augue. Praesent dui diam, feugiat in mi ac, gravida elementum arcu. Ut porta nisl vel neque tristique, non euismod dolor ultricies. Nullam eu urna eu dui dictum interdum. Pellentesque ut posuere orci. Sed dictum vitae odio id volutpat.\r\n\r\nInteger euismod libero a turpis commodo, finibus efficitur augue accumsan. Duis facilisis velit in blandit feugiat. Integer pellentesque sem sed dui venenatis condimentum. Morbi mattis arcu a turpis interdum, eget pharetra lectus placerat. Vivamus finibus eros quis nunc cursus dictum. Vivamus convallis tristique aliquam. Sed non tellus tristique ipsum tincidunt mollis id vel lorem. Duis efficitur mauris id nisi sodales lacinia. In ac dictum nunc. Duis faucibus turpis vel nibh tristique gravida. Ut pretium velit at semper eleifend. Maecenas a pulvinar tellus. Phasellus non dolor ipsum. Morbi in ante accumsan diam malesuada laoreet.', '2015-10-14 15:05:32', '2015-10-13 16:35:07', '2015-10-14 15:45:44', '', ''),
(15, 'admin', 'admin@admin.com', '3c39cbacf40aeaa53c4a232a5eb8b73054bfe994', NULL, NULL, NULL, NULL, '2015-10-13 16:48:23', '2015-10-13 16:34:45', '2015-10-13 16:34:45', '', ''),
(17, 'Jeffrey Merioles', 'jeffrey@email.com', 'ff935dbec485fb35469ded69f84cf35eb48715e6', '17.jpg', '1', '2005-10-10', 'My hubby', '2015-10-14 17:31:29', '2015-10-13 16:56:44', '2015-10-14 19:08:23', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
