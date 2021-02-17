-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 17, 2021 at 06:11 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timeclock`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

DROP TABLE IF EXISTS `audit`;
CREATE TABLE IF NOT EXISTS `audit` (
  `modified_when` bigint DEFAULT NULL,
  `modified_from` bigint NOT NULL,
  `modified_to` bigint NOT NULL,
  `modified_by_ip` varchar(39) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `modified_by_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `modified_why` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_modified` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  KEY `audit_modified_when` (`modified_when`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dbversion`
--

DROP TABLE IF EXISTS `dbversion`;
CREATE TABLE IF NOT EXISTS `dbversion` (
  `dbversion` decimal(5,1) NOT NULL,
  PRIMARY KEY (`dbversion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dbversion`
--

INSERT INTO `dbversion` (`dbversion`) VALUES
('1.4'),
('1.5');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `empfullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tstamp` bigint DEFAULT NULL,
  `employee_passwd` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `displayname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(75) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `barcode` varchar(75) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `groups` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `office` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `reports` tinyint(1) NOT NULL DEFAULT '0',
  `time_admin` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`empfullname`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empfullname`, `tstamp`, `employee_passwd`, `displayname`, `email`, `barcode`, `groups`, `office`, `admin`, `reports`, `time_admin`, `disabled`) VALUES
('admin', NULL, 'xyJkVhXGAZ8tM', 'administrator', '', '', '', '1', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `groupname` varchar(50) NOT NULL DEFAULT '',
  `groupid` int NOT NULL AUTO_INCREMENT,
  `officeid` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `inout` varchar(50) COLLATE utf8_bin NOT NULL,
  `timestamp` bigint DEFAULT NULL,
  `notes` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ipaddress` varchar(39) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `primary_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`primary_id`) USING BTREE,
  KEY `info_fullname` (`fullname`),
  KEY `info_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `metars`
--

DROP TABLE IF EXISTS `metars`;
CREATE TABLE IF NOT EXISTS `metars` (
  `station` varchar(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `metar` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`station`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `metars`
--

INSERT INTO `metars` (`station`, `metar`, `timestamp`) VALUES
('CYYT', '', '2021-02-17 12:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
CREATE TABLE IF NOT EXISTS `offices` (
  `officeid` int NOT NULL AUTO_INCREMENT,
  `officename` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`officeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `punchlist`
--

DROP TABLE IF EXISTS `punchlist`;
CREATE TABLE IF NOT EXISTS `punchlist` (
  `punchitems` varchar(50) COLLATE utf8_bin NOT NULL,
  `punchnext` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `color` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `in_or_out` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`punchitems`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `punchlist`
--

INSERT INTO `punchlist` (`punchitems`, `punchnext`, `color`, `in_or_out`) VALUES
('Morning', '', '#0066CC', 1),
('Evening', '', '#CC66FF', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
