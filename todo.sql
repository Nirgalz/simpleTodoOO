-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2016 at 10:54 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_title` varchar(255) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_title`) VALUES
(1, 'code'),
(2, 'style');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE IF NOT EXISTS `priority` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(255) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`p_id`, `p_title`) VALUES
(1, 'Urgent'),
(2, 'Chaud'),
(3, 'Faut y aller'),
(4, 'Tranquille'),
(5, 'OSEF');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deadline` date DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `c_id` (`c_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`t_id`, `title`, `description`, `deadline`, `c_id`, `p_id`) VALUES
(45, 'get some rest after fixing this thing', '', '2016-06-14', 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `categories` (`c_id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `priority` (`p_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
