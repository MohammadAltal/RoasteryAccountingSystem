-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2018 at 11:28 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roastery`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_payment`
--

CREATE TABLE IF NOT EXISTS `advance_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Type` tinyint(1) NOT NULL DEFAULT '0',
  `emp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_emp` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Number` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Buy_Sale` tinyint(1) NOT NULL DEFAULT '0',
  `vip_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vip_id` (`vip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `Number`, `Date`, `Buy_Sale`, `vip_id`) VALUES
(1, 1996, '2017-01-02', 1, 10),
(2, 98888, '2018-03-08', 1, 10),
(3, 8555, '2018-03-09', 1, 10),
(4, 8545, '2018-03-10', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `bill_inventory`
--

CREATE TABLE IF NOT EXISTS `bill_inventory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ammount` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `const1` (`inventory_id`),
  KEY `const2` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `bill_inventory`
--

INSERT INTO `bill_inventory` (`Id`, `Ammount`, `inventory_id`, `item_id`) VALUES
(56, 5, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `bill_item`
--

CREATE TABLE IF NOT EXISTS `bill_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ammount` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_item` (`item_id`),
  KEY `bill_id` (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `bill_item`
--

INSERT INTO `bill_item` (`id`, `Ammount`, `Price`, `bill_id`, `item_id`) VALUES
(27, 50, 500, 1, 29),
(38, 50, 40000, 1, 30),
(61, 50, 500, 2, 29),
(62, 50, 500, 3, 29);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  `Date` date NOT NULL,
  `vip_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vid_id` (`vip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Balance` int(11) NOT NULL,
  `S_date` date NOT NULL,
  `E_date` date DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_person` (`id_person`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `emp_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ammount` int(11) NOT NULL,
  `Date` date NOT NULL,
  `emp_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_item` (`emp_id`),
  KEY `emp_item2` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `Date`) VALUES
(1, '2018-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `Ammount` int(11) NOT NULL DEFAULT '0',
  `Price` int(11) NOT NULL,
  `Low_Limit` int(11) NOT NULL,
  `Raw` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `Name`, `image`, `Ammount`, `Price`, `Low_Limit`, `Raw`) VALUES
(29, 'بزر أبيض', '726929_924469.jpg', 0, 3000, 50, 1),
(30, 'كريك صغير', '810639_564453.jpg', 50, 1500, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vip`
--

CREATE TABLE IF NOT EXISTS `vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Balance` int(11) NOT NULL DEFAULT '0',
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_person` (`id_person`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vip`
--

INSERT INTO `vip` (`id`, `Balance`, `id_person`) VALUES
(10, -59000, 2),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
