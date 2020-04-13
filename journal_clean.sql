-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2020 at 06:43 PM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `journal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `PASS` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `email_verified`, `PASS`) VALUES
(1, 'admin', 'mdminhaj.1656@gmail.com', 1, '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `admin_email_verify`
--

DROP TABLE IF EXISTS `admin_email_verify`;
CREATE TABLE IF NOT EXISTS `admin_email_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
CREATE TABLE IF NOT EXISTS `entries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entrylogs`
--

DROP TABLE IF EXISTS `entrylogs`;
CREATE TABLE IF NOT EXISTS `entrylogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` bigint(20) DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `itemType` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT '0',
  `total_shares` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dr_cr` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_form` tinyint(4) NOT NULL DEFAULT '0',
  `share_info` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 => insert, 2 =>Subtract',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `dr_cr`, `user_form`, `share_info`) VALUES
(1, 'Capital', 'credit', 1, 1),
(2, 'loss', 'debit', 0, 0),
(3, 'Profit Withdrawn', 'debit', 1, 0),
(4, 'Profit', 'credit', 0, 0),
(5, 'Capital Withdrawn', 'debit', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `multi_entries`
--

DROP TABLE IF EXISTS `multi_entries`;
CREATE TABLE IF NOT EXISTS `multi_entries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `multi_entry_id` bigint(20) DEFAULT NULL,
  `entry_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

DROP TABLE IF EXISTS `shares`;
CREATE TABLE IF NOT EXISTS `shares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `trxID` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `itemType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `total_shares` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NID` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `NID_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `name_bangla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `present_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `present_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `present_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `permanent_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `permanent_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `fb_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `father_mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `mother_mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `spouse_mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `nominee_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `nominee_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `nominee_info_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `bank_acc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `bank_acc_branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `bkash` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `bkash_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `rocket` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `rocket_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELIMITER $$
--
-- Events
--
DROP EVENT `auto_expire`$$
CREATE DEFINER=`root`@`localhost` EVENT `auto_expire` ON SCHEDULE EVERY 20 SECOND STARTS '2020-02-22 01:03:50' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM admin_email_verify WHERE created_at < NOW() - INTERVAL 60 MINUTE$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
