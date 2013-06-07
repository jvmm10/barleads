-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2013 at 02:36 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `accounts_development`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbank`
--

CREATE TABLE IF NOT EXISTS `tblbank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblbank`
--

INSERT INTO `tblbank` (`id`, `bank_name`) VALUES
(1, 'UCPB');

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE IF NOT EXISTS `tblbranch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`id`, `branch_name`) VALUES
(1, 'Makati');

-- --------------------------------------------------------

--
-- Table structure for table `tbllead`
--

CREATE TABLE IF NOT EXISTS `tbllead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbllead`
--

INSERT INTO `tbllead` (`id`, `lead_name`) VALUES
(2, 'tutuy');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupervisor`
--

CREATE TABLE IF NOT EXISTS `tblsupervisor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supervisor_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tblsupervisor`
--

INSERT INTO `tblsupervisor` (`id`, `supervisor_name`) VALUES
(1, 'SDFSDFSDF'),
(9, 'jett'),
(11, 'opiuy'),
(14, 'jyijyu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
