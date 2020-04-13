-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2020 at 08:58 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `date`, `item_id`, `user_id`, `debit`, `credit`) VALUES
(111, '2018-06-30', 2, 0, 15000, 0),
(110, '2017-07-01', 1, 2, 0, 50000),
(125, '2020-03-28', 1, 2, 0, 80000),
(124, '2020-03-28', 1, 2, 0, 55000),
(114, '2019-06-30', 4, 0, 0, 30000),
(123, '2020-03-28', 1, 1, 0, 55000),
(122, '2020-03-28', 1, 1, 0, 50000),
(117, '2020-01-01', 3, 3, 3000, 0),
(118, '2020-01-01', 3, 5, 6000, 0),
(119, '2020-06-01', 3, 6, 3000, 0),
(120, '2020-06-01', 5, 6, 22500, 0),
(121, '2020-06-30', 4, 0, 0, 20000),
(126, '2020-03-29', 2, 0, 100000, 0),
(127, '2020-03-29', 2, 0, 100000, 0),
(128, '2020-03-29', 2, 0, 100000, 0),
(129, '2020-03-29', 2, 0, 100000, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entrylogs`
--

INSERT INTO `entrylogs` (`id`, `entry_id`, `date`, `user_id`, `itemType`, `amount`, `total_shares`) VALUES
(168, 111, '2018-06-30', 3, 'loss', 2500, 0),
(167, 110, '2017-07-01', 2, 'Capital', 5000, 10),
(169, 111, '2018-06-30', 1, 'loss', 7500, 0),
(170, 111, '2018-06-30', 2, 'loss', 5000, 0),
(190, 125, '2020-03-28', 2, 'Capital', 5000, 16),
(189, 124, '2020-03-28', 2, 'Capital', 5000, 11),
(173, 114, '2019-06-30', 3, 'Profit', 1200, 5),
(174, 114, '2019-06-30', 1, 'Profit', 1200, 10),
(175, 114, '2019-06-30', 2, 'Profit', 1200, 5),
(176, 114, '2019-06-30', 5, 'Profit', 1200, 5),
(188, 123, '2020-03-28', 1, 'Capital', 5000, 11),
(187, 122, '2020-03-28', 1, 'Capital', 5000, 10),
(179, 117, '2020-01-01', 3, 'Profit Withdrawn', 3000, 0),
(180, 118, '2020-01-01', 5, 'Profit Withdrawn', 6000, 0),
(181, 119, '2020-06-01', 6, 'Profit Withdrawn', 3000, 0),
(182, 120, '2020-06-01', 6, 'Capital Withdrawn', 4500, 5),
(183, 121, '2020-06-30', 3, 'Profit', 1000, 5),
(184, 121, '2020-06-30', 1, 'Profit', 1000, 5),
(185, 121, '2020-06-30', 2, 'Profit', 1000, 5),
(186, 121, '2020-06-30', 5, 'Profit', 1000, 5),
(191, 126, '2020-03-29', 3, 'loss', 7810.4993597951, 0),
(192, 126, '2020-03-29', 1, 'loss', 39667.09346991, 0),
(193, 126, '2020-03-29', 2, 'loss', 44711.907810499, 0),
(194, 126, '2020-03-29', 5, 'loss', 7810.4993597951, 0),
(195, 127, '2020-03-29', 3, 'loss', 7810.4994836489, 0),
(196, 127, '2020-03-29', 1, 'loss', 39667.09363167, 0),
(197, 127, '2020-03-29', 2, 'loss', 44711.907745267, 0),
(198, 127, '2020-03-29', 5, 'loss', 7810.4994836489, 0),
(199, 128, '2020-03-29', 3, 'loss', 7810.4992125984, 0),
(200, 128, '2020-03-29', 1, 'loss', 39667.09343832, 0),
(201, 128, '2020-03-29', 2, 'loss', 44711.907611549, 0),
(202, 128, '2020-03-29', 5, 'loss', 7810.4992125984, 0),
(203, 129, '2020-03-29', 3, 'loss', 7810.4994475138, 0),
(204, 129, '2020-03-29', 1, 'loss', 39667.09281768, 0),
(205, 129, '2020-03-29', 2, 'loss', 44711.908287293, 0),
(206, 129, '2020-03-29', 5, 'loss', 7810.4994475138, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_entries`
--

INSERT INTO `multi_entries` (`id`, `multi_entry_id`, `entry_id`) VALUES
(31, 31, 117),
(32, 32, 118),
(33, 33, 119),
(34, 33, 120);

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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `user_id`, `quantity`) VALUES
(42, 3, 5),
(40, 1, 10),
(41, 2, 33),
(44, 5, 5);

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
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `trxID`, `date`, `user_id`, `itemType`, `amount`, `total_shares`) VALUES
(35, 1, '2018-01-01', 3, 'Purchase of Profit', 0, 5),
(34, 1, '2018-01-01', 1, 'Sell', 5000, 5),
(33, 1, '2018-01-01', 1, 'Sells of Profit', 0, 5),
(36, 1, '2018-01-01', 3, 'Buy', 5000, 5),
(43, 2, '2018-07-01', 5, 'Purchase of Profit', 0, 5),
(42, 2, '2018-07-01', 2, 'Sell', 4500, 5),
(41, 2, '2018-07-01', 2, 'Sells of Profit', 0, 5),
(44, 2, '2018-07-01', 5, 'Buy', 4500, 5),
(45, 3, '2019-12-31', 1, 'Sells of Profit', 1200, 5),
(46, 3, '2019-12-31', 1, 'Sell', 4500, 5),
(47, 3, '2019-12-31', 5, 'Purchase of Profit', 1200, 5),
(48, 3, '2019-12-31', 5, 'Buy', 4500, 5),
(49, 4, '2020-03-01', 5, 'Sells of Profit', 600, 5),
(50, 4, '2020-03-01', 5, 'Sell', 4500, 5),
(51, 4, '2020-03-01', 6, 'Purchase of Profit', 600, 5),
(52, 4, '2020-03-01', 6, 'Buy', 4500, 5),
(53, 5, '2020-03-28', 1, 'Sells of Profit', 1600, 1),
(54, 5, '2020-03-28', 1, 'Sell', 4500, 1),
(55, 5, '2020-03-28', 2, 'Purchase of Profit', 1600, 1),
(56, 5, '2020-03-28', 2, 'Buy', 4500, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `pass`, `NID`, `NID_name`, `name_bangla`, `gender`, `present_division`, `present_district`, `present_address`, `permanent_division`, `permanent_district`, `permanent_address`, `profession`, `mobile`, `fb_id`, `father_name`, `father_mobile`, `mother_name`, `mother_mobile`, `spouse_name`, `spouse_mobile`, `nominee_name`, `nominee_info`, `nominee_info_details`, `bank`, `bank_acc`, `bank_acc_branch`, `bkash`, `bkash_type`, `rocket`, `rocket_type`) VALUES
(1, 'aseer999', 'Aseer Ishraque', 'aseerishraque@gmail.com', '12345678', '01843774154', 'Aseer Ishraqul Hoque', '???? ??????? ?? ', 'Male', 'Chittagong', 'Chittagongk', '2134, Shiraj bhaban, East Nasirabad, Khulshi', 'Chittagong', 'Chittagong', '2134, Shiraj bhaban, East Nasirabad, Khulshi 4000', 'Business', '01843774154', 'Ishraque2', 'Anamul Hoque', '01843774154', 'Romana Begum', '01843774154', 'thasdashdasd', '01843774154', 'Sowad Sadik', '01843774', 'BDATE', 'Mutual Trust Bank, CTG', '01843774154542115', 'CDA Avenue', '018437741545522', 'Agent', '018437741545544', 'Personal'),
(2, 'heloo12', 'Rezaul Alam', 'Hello@mail.com', '123zxxc', '01254456658745', 'Rezaul Alam', 'à¦°à§‡à¦œà¦¾à¦‰à¦² à¦à¦²à¦¾à¦®', 'Male', 'Chittagong', 'Chittagong', '2134, Shiraj bhaban, East Nasirabad, Khulshi', 'Chittagong', 'Chittagong', '2134, Shiraj bhaban, East Nasirabad, Khulshi 4000', 'Business', '01843774154', 'Ishraque2', 'Anamul Hoque', '01843774154', 'Romana Begum', '01843774154', 'thasdashdasd', '01843774154', 'Sowad Sadik', '01843774154', 'BDATE', 'Mutual Trust Bank, CTG', '01843774154542115', 'CDA Avenue', '018437741545522', 'Agent', '01843774154554425', '0'),
(3, 'abser', 'Sazzad UL Hoque', 'Hello0123@gmail.com', '123456', '123456645678', 'Aseer', 'Aseer Ishraque', 'Male', 'sdfgjjj', 'chittagong', '2134 siraj bhaban, zakir hossain road/L', 'ppppppppppp', 'chittagong', '2134 siraj bhaban, zakir hossain road/L', 'ttttttttttttt', '01843774154', 'asddfteew', 'qqqqqqqqqqqqqqq', '01843774154', 'awawaawawawawawaw', '01843774154', 'lllllllllllllllllllllllllllllll', '01843774154', 'Aseer Ishraque', 'Aseer Ishraque', 'Aseer Ishraque', 'ttttttttttttttttt', '121212333333333333333', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '+8801843774154', 'Personal', '+8801843774154', 'Personal'),
(5, 'sarminsultana', 'Sarmin', 'sarmin123@gmail.com', '12345678', '001', 'Sarmin', 'শারমিন ', 'Female', 'rahattarpul', 'rahattarpul', 'rahattarpul', 'rahattarpul', 'rahattarpul', 'rahattarpul', '', '018752340', '', 'abul kalam', '01', 'maryam', '01', '', '', 'duha', 'duha', 'duha', 'blank', 'blank', 'blank', 'blank', '0', 'blank', '0'),
(6, 'asif12', 'asif', 'asif12@gmail.com', '123456789', '0012', 'asif', 'আসিফ', 'Male', 'kalamiabazar', 'kalamiabazar', 'kalamiabazar', 'kalamiabazar', 'kalamiabazar', 'kalamiabazar', 'job', '01', '', 'al', '011', 'kj', '023', '', '', 'ratul', 'kalm', 'kalm', 'n/a', 'n/a', 'n/a', 'n/a', '0', 'n/a', '0'),
(7, 'boshir', 'Sami Ul Bashir8', 'aseerishraque@gmail.com', '12345678', '123456645678', 'Aseer', 'Aseer Ishraque', 'Male', 'sdfgjjj', 'chittagong', '2134 siraj bhaban, zakir hossain road/L', 'ppppppppppp', 'chittagong', '2134 siraj bhaban, zakir hossain road/L', 'ttttttttttttt', '+8801843774154', 'asddfteew', 'qqqqqqqqqqqqqqq', '+8801843774154', 'awawaawawawawawaw', '+8801843774154', 'lllllllllllllllllllllllllllllll', '+8801843774154', 'Aseer Ishraque', 'Aseer Ishraque', 'Aseer Ishraque', 'ttttttttttttttttt', '121212333333333333333', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '+8801843774154', 'Personal', '4444444444444444444', 'Agent'),
(8, 'mishkatctg', 'Mishkat', 'mishkat', '1234', 'fj', 'gkl', 'gjk', 'Male', 'fjk', 'gjk', 'fjl', 'fjk', 'ghk', 'fhjk', 'djk', '015', 'gjg', 'fjk', 'gjk', 'vjk', 'gjk', 'fjk', 'hjkk', 'fh', 'fhji', 'gjkk', 'gjk', 'fji', 'dhkk', 'fjkk', 'Personal', 'gjjj', 'Agent');

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
