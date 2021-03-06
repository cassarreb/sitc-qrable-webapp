-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2014 at 11:00 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sitc`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE IF NOT EXISTS `codes` (
  `code` varchar(30) NOT NULL,
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `current_code`
--

CREATE TABLE IF NOT EXISTS `current_code` (
  `code_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_code`
--

INSERT INTO `current_code` (`code_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `player_id` int(11) NOT NULL AUTO_INCREMENT,
  `mac_address` varchar(30) NOT NULL,
  `stands` text NOT NULL,
  PRIMARY KEY (`player_id`),
  UNIQUE KEY `mac_address` (`mac_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `stand`
--

CREATE TABLE IF NOT EXISTS `stand` (
  `stand_id` int(2) NOT NULL AUTO_INCREMENT,
  `qrcode` varchar(30) NOT NULL,
  `funfact` varchar(100) NOT NULL,
  PRIMARY KEY (`stand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
