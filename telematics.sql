-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2018 at 01:08 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telematics`
--

-- --------------------------------------------------------

--
-- Table structure for table `telematics`
--

DROP TABLE IF EXISTS `telematics`;
CREATE TABLE IF NOT EXISTS `telematics` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `reported_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telematics`
--

INSERT INTO `telematics` (`id`, `device_id`, `label`, `reported_time`) VALUES
(1, '5572', 'Shine', '2018-05-19 08:31:22'),
(2, '5572', 'shine', '2018-05-20 05:22:38'),
(3, '5572', 'honda', '2018-05-15 13:34:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
