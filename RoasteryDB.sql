-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2018 at 09:19 PM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roastery`
--
CREATE DATABASE IF NOT EXISTS `roastery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `roastery`;

-- --------------------------------------------------------

--
-- Table structure for table `advance_payment`
--

DROP TABLE IF EXISTS `advance_payment`;
CREATE TABLE IF NOT EXISTS `advance_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Type` tinyint(1) NOT NULL DEFAULT '0',
  `emp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_emp` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advance_payment`
--

INSERT INTO `advance_payment` (`id`, `Value`, `Date`, `Type`, `emp_id`) VALUES
(6, 1000, '2018-03-07', 0, 1),
(7, 5000, '2018-03-07', 0, 1),
(8, 4000, '2018-03-07', 1, 1),
(9, 2000, '2018-03-07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Number` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Buy_Sale` tinyint(1) NOT NULL DEFAULT '0',
  `vip_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vip_id` (`vip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `Number`, `Date`, `Buy_Sale`, `vip_id`) VALUES
(1, 1996, '2017-01-02', 1, 10),
(2, 98888, '2018-03-08', 1, 10),
(3, 8555, '2018-03-09', 1, 10),
(4, 8545, '2018-03-10', 1, 10),
(5, 532632, '2018-04-04', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `bill_inventory`
--

DROP TABLE IF EXISTS `bill_inventory`;
CREATE TABLE IF NOT EXISTS `bill_inventory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ammount` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `const1` (`inventory_id`),
  KEY `const2` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bill_item`
--

DROP TABLE IF EXISTS `bill_item`;
CREATE TABLE IF NOT EXISTS `bill_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ammount` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_item` (`item_id`),
  KEY `bill_id` (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_item`
--

INSERT INTO `bill_item` (`id`, `Ammount`, `Price`, `bill_id`, `item_id`) VALUES
(27, 50, 500, 1, 29),
(38, 50, 40000, 1, 30),
(61, 50, 500, 2, 29),
(62, 50, 500, 3, 29),
(63, 30, 500, 5, 29);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

DROP TABLE IF EXISTS `cash`;
CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  `Date` date NOT NULL,
  `vip_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vid_id` (`vip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `Value`, `Date`, `vip_id`) VALUES
(2, 500, '2018-03-06', 11),
(4, 50000, '2018-03-06', 10);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Balance` int(11) NOT NULL DEFAULT '0',
  `S_date` date NOT NULL,
  `E_date` date DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `Balance`, `S_date`, `E_date`, `salary`, `id_person`) VALUES
(1, 0, '2018-02-28', NULL, 50000, 5),
(2, 0, '2018-03-07', NULL, 10000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `emp_item`
--

DROP TABLE IF EXISTS `emp_item`;
CREATE TABLE IF NOT EXISTS `emp_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ammount` int(11) NOT NULL,
  `Date` date NOT NULL,
  `emp_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_item` (`emp_id`),
  KEY `emp_item2` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `Ammount` int(11) NOT NULL DEFAULT '0',
  `Price` int(11) NOT NULL,
  `Low_Limit` int(11) NOT NULL,
  `Raw` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `Name`, `image`, `Ammount`, `Price`, `Low_Limit`, `Raw`) VALUES
(29, 'بزر أبيض', '726929_924469.jpg', 30, 3000, 20, 1),
(30, 'كريك صغير', '810639_564453.jpg', 50, 1500, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `Name`, `Address`, `Phone`) VALUES
(2, 'أبو سليم الحمال', 'ركن الدين', 957558514),
(3, 'أبو النور', 'ساحة شمدين', 958475526),
(5, 'عابد بلو', 'مساكن برزة', 957558514),
(6, 'محمد عيد التل', 'ركن الدين', 957558514);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vip`
--

DROP TABLE IF EXISTS `vip`;
CREATE TABLE IF NOT EXISTS `vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Balance` int(11) NOT NULL DEFAULT '0',
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vip`
--

INSERT INTO `vip` (`id`, `Balance`, `id_person`) VALUES
(10, -58500, 2),
(11, -500, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_payment`
--
ALTER TABLE `advance_payment`
  ADD CONSTRAINT `pay_emp` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `vip_id` FOREIGN KEY (`vip_id`) REFERENCES `vip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_inventory`
--
ALTER TABLE `bill_inventory`
  ADD CONSTRAINT `const1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `const2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_item`
--
ALTER TABLE `bill_item`
  ADD CONSTRAINT `bill_id` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`vip_id`) REFERENCES `vip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `per_emp` FOREIGN KEY (`id_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emp_item`
--
ALTER TABLE `emp_item`
  ADD CONSTRAINT `emp_item` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_item2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vip`
--
ALTER TABLE `vip`
  ADD CONSTRAINT `per_vip` FOREIGN KEY (`id_person`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
