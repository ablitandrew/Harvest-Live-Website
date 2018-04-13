-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2014 at 08:19 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ablworks_testing_79`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `Area_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Area_Title` varchar(50) NOT NULL,
  `Phase_ID` int(11) NOT NULL,
  PRIMARY KEY (`Area_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`Area_ID`, `Area_Title`, `Phase_ID`) VALUES
(3, 'Area 1', 3),
(4, 'Area 1', 4),
(7, 'Area 1', 7),
(9, 'Area 1', 9),
(10, 'Area 1', 10),
(11, 'Area 1', 10),
(12, 'Area 1', 11),
(14, 'Area 1', 13),
(15, 'Area 1', 14),
(18, 'Area 1', 17),
(19, 'Area 1', 18),
(20, 'Area 1', 19),
(21, 'Area 1', 20),
(22, 'Area 1', 21),
(23, 'Area 1', 22),
(24, 'Area 1', 22),
(25, 'Area 1', 23),
(27, 'Area 1', 25),
(31, 'Area 1', 28),
(32, 'Area 1', 28),
(35, 'Area 1', 31),
(36, 'Area 1', 32),
(37, 'Area 1', 33),
(38, 'Area 1', 34),
(39, 'Area 1', 35),
(40, 'Area 1', 36);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `Cat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_Title` varchar(50) NOT NULL,
  PRIMARY KEY (`Cat_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Cat_ID`, `Cat_Title`) VALUES
(1, 'cat1'),
(2, 'Labour'),
(3, 'Labour'),
(4, 'cat1'),
(5, 'rrr'),
(6, 'r');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `Customer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_Fname` varchar(50) NOT NULL,
  `Customer_Lname` varchar(50) NOT NULL,
  `Company` varchar(200) NOT NULL,
  `Customer_Email` varchar(100) NOT NULL,
  `Customer_Primary_Phone` varchar(20) NOT NULL,
  `Customer_Phone_Office` varchar(20) NOT NULL,
  `Customer_Phone_Fax` varchar(20) NOT NULL,
  `Customer_Primary_Add` varchar(200) NOT NULL,
  `Customer_City` varchar(50) DEFAULT NULL,
  `Customer_State` varchar(50) DEFAULT NULL,
  `Cusotmer_Zip` int(11) DEFAULT NULL,
  `Cusotmer_Latitude` varchar(50) DEFAULT NULL,
  `Customer_Longitude` varchar(50) DEFAULT NULL,
  `Customer_Xero_ID` varchar(50) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifedDate` datetime NOT NULL,
  `Is_Deleted` int(11) NOT NULL,
  `UpdatedBy` int(11) NOT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_ID`, `Customer_Fname`, `Customer_Lname`, `Company`, `Customer_Email`, `Customer_Primary_Phone`, `Customer_Phone_Office`, `Customer_Phone_Fax`, `Customer_Primary_Add`, `Customer_City`, `Customer_State`, `Cusotmer_Zip`, `Cusotmer_Latitude`, `Customer_Longitude`, `Customer_Xero_ID`, `CreatedDate`, `ModifedDate`, `Is_Deleted`, `UpdatedBy`) VALUES
(1, 'test', 'user', 'technosis', 'test4441@test.com', '435435545', '5345454', '34535454354', '30 round street', NULL, NULL, NULL, NULL, NULL, '', '2014-05-09 08:18:24', '0000-00-00 00:00:00', 0, 0),
(2, 'Andrew', 'Holmes', 'ABL IT', 'Andrew@ablit.com.au', '0433371094', '38881612', '38881611', '220 Boundar St Spring Hill', NULL, NULL, NULL, NULL, NULL, '', '2014-05-10 05:43:06', '0000-00-00 00:00:00', 0, 0),
(3, 'jsi', 'kanand', 'jsitech', 'jsi.kanand@gmail.com', '5465646', '546545454', '43543545', 'australia', NULL, NULL, NULL, NULL, NULL, '', '2014-05-13 10:12:27', '0000-00-00 00:00:00', 0, 0),
(4, 'anderson', 'holmes', 'technosis', 'anderson@gmail.com', '43545454', '45453454', '75775764', '45,street road', NULL, NULL, NULL, NULL, NULL, '', '2014-05-13 13:11:35', '0000-00-00 00:00:00', 0, 0),
(5, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '2014-05-15 05:03:11', '0000-00-00 00:00:00', 0, 0),
(6, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '2014-07-23 04:31:44', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers_addresses`
--

CREATE TABLE IF NOT EXISTS `customers_addresses` (
  `Cust_Add_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_Phone` varchar(20) NOT NULL,
  `Customre_Email` varchar(100) NOT NULL,
  `Customer_Add1` varchar(100) NOT NULL,
  `Customer_Add2` varchar(100) NOT NULL,
  `Customer_City` varchar(50) NOT NULL,
  `Customer_State` varchar(50) NOT NULL,
  `Customer_Zip` int(11) NOT NULL,
  `Customer_Country` varchar(50) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  PRIMARY KEY (`Cust_Add_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers_quotes`
--

CREATE TABLE IF NOT EXISTS `customers_quotes` (
  `Quote_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_ID` int(11) NOT NULL,
  `Staff` varchar(50) DEFAULT NULL,
  `Quote_Title` varchar(200) NOT NULL,
  `Quote_Address` varchar(250) NOT NULL,
  `Quote_Latitude` varchar(50) NOT NULL,
  `Quote_Longitude` varchar(50) NOT NULL,
  `Quote_Description` longtext NOT NULL,
  `Project_Memo` varchar(256) DEFAULT NULL,
  `Quote_Start_Date` datetime DEFAULT NULL,
  `Quote_End_Date` datetime DEFAULT NULL,
  `Gross_Amount` decimal(10,0) NOT NULL,
  `Profit` decimal(10,0) NOT NULL,
  `Discount` decimal(10,0) NOT NULL,
  `Total_Amount` decimal(10,0) NOT NULL,
  `Is_Accepted` tinyint(1) NOT NULL,
  `Is_Job` tinyint(1) NOT NULL,
  `Is_Archived` tinyint(1) NOT NULL,
  `Is_Completed` tinyint(1) NOT NULL,
  `EmailDate` datetime NOT NULL,
  `AcceptedDate` datetime NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `UpdatedBy` int(11) NOT NULL,
  `draft` tinyint(4) NOT NULL,
  `Is_Quick` tinyint(4) NOT NULL,
  PRIMARY KEY (`Quote_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `customers_quotes`
--

INSERT INTO `customers_quotes` (`Quote_ID`, `Customer_ID`, `Staff`, `Quote_Title`, `Quote_Address`, `Quote_Latitude`, `Quote_Longitude`, `Quote_Description`, `Project_Memo`, `Quote_Start_Date`, `Quote_End_Date`, `Gross_Amount`, `Profit`, `Discount`, `Total_Amount`, `Is_Accepted`, `Is_Job`, `Is_Archived`, `Is_Completed`, `EmailDate`, `AcceptedDate`, `CreatedDate`, `ModifiedDate`, `UpdatedBy`, `draft`, `Is_Quick`) VALUES
(1, 1, NULL, 'test project', 'Indore Bypass Road, Silver Spring Phase 1, Mundla Nayta, Indore, Madhya Pradesh 452020, India', '', '', 'test', 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '0', '1100', 0, 0, 1, 0, '2014-05-09 08:25:22', '0000-00-00 00:00:00', '2014-05-09 08:18:24', '2014-05-09 08:23:08', 0, 0, 0),
(2, 1, '8,', 'test estimate', 'Indore Bypass Road, Indore, Madhya Pradesh 452016, India', '', '', 'test', 'test', '2014-05-15 00:00:00', '2014-05-18 00:00:00', '0', '0', '0', '100', 0, 1, 0, 0, '2014-05-09 23:05:28', '0000-00-00 00:00:00', '2014-05-09 08:20:30', '2014-05-12 08:25:06', 0, 0, 0),
(3, 1, NULL, 'test project 123', 'Unnamed Road, Pologround Industrial Estate, Nanda Nagar, Kushwash Nagar, Indore, Madhya Pradesh 452003, India', '', '', 'test', 'test', '2014-05-17 13:10:04', '2014-05-17 13:10:04', '0', '0', '0', '3190', 0, 0, 1, 0, '2014-05-13 10:10:15', '0000-00-00 00:00:00', '2014-05-09 08:27:19', '2014-05-17 13:10:04', 0, 0, 1),
(4, 1, '7,', 'test project', 'Bicholi Mardana Road, Gari Pipliya, Ramgarh, Madhya Pradesh 452016, India', '22.7197615', '76.0024932', 'test', 'test', '2014-05-13 00:00:00', '2014-05-16 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-09 09:37:48', '0000-00-00 00:00:00', 0, 0, 1),
(5, 2, '1,', 'Test Project Title', '220 boundary street spring hill', '', '', 'Test Project Description', 'Test project notes', '2014-05-12 00:00:00', '2014-05-14 05:43:33', '0', '0', '0', '1090', 0, 1, 0, 0, '2014-05-12 09:55:09', '0000-00-00 00:00:00', '2014-05-10 05:43:06', '2014-05-10 05:43:33', 0, 1, 1),
(6, 3, '1,6', 'test project', 'Madhya Pradesh State Highway 18, Jamgod, Madhya Pradesh 455115, India', '', '', 'test', 'test', '2014-05-13 00:00:00', '2014-05-16 00:00:00', '0', '0', '0', '1000', 1, 1, 0, 0, '2014-05-13 10:25:29', '2014-05-13 10:22:59', '2014-05-13 10:12:27', '2014-05-23 08:16:38', 0, 0, 0),
(7, 4, NULL, 'test project title', 'Indore Bypass Road, Silver Spring Phase 1, Mundla Nayta, Indore, Madhya Pradesh 452020, India', '', '', 'test desc', 'test memo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '0', '1102000', 0, 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-13 13:11:35', '2014-05-17 13:20:51', 0, 0, 0),
(8, 2, '7,', 'test project for customer', 'Indore Bypass Road, Silver Spring Phase 1, Mundla Nayta, Indore, Madhya Pradesh 452020, India', '22.6572983', '75.90828290000002', 'test', 'test', '2014-05-20 00:00:00', '2014-05-23 00:00:00', '0', '0', '0', '1100', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-13 13:12:33', '0000-00-00 00:00:00', 0, 1, 0),
(9, 1, '1,', 'test project', 'Major District Road, Madhya Pradesh 452005, India', '22.748099', '75.77509629999997', 'test', 'test', NULL, '2014-05-23 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-14 13:37:32', '0000-00-00 00:00:00', 0, 0, 1),
(10, 1, NULL, 'test project', 'Major District Road, Madhya Pradesh 452005, India', '22.748099', '75.77509629999997', 'test', 'test', '2014-05-15 04:58:47', '2014-05-15 04:58:47', '0', '0', '0', '100', 0, 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-15 04:58:47', '0000-00-00 00:00:00', 0, 0, 1),
(11, 5, '7,', 'test project', 'Bicholi Mardana Road, Gari Pipliya, Ramgarh, Madhya Pradesh 452016, India', '', '', 'test', 'test', '2014-05-16 00:00:00', '2014-05-19 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-15 04:59:49', '2014-05-15 05:03:11', 0, 0, 1),
(12, 1, NULL, 'test', 'Madhya Pradesh State Highway 27, Kamed, Madhya Pradesh 456006, India', '22.7684301', '75.8957024', 'test project ', '', '2014-05-17 13:08:29', '2014-05-17 13:08:29', '0', '0', '0', '1090', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-17 13:08:29', '0000-00-00 00:00:00', 0, 0, 1),
(13, 1, NULL, 'test demo', 'Jhonakr Palsavad Road, Lalupura, Madhya Pradesh 465106, India', '23.2561802', '75.81637899999998', 'test project title', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '0', '190', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-17 13:13:53', '2014-06-05 06:49:16', 0, 0, 0),
(14, 1, '1,8,', 'test job title', 'Ujjain - Jaora Road, Dayanand Colony, Nagda, Madhya Pradesh 456335, India', '23.1793013', '75.78490970000007', 'test job', '', '2014-05-20 00:00:00', '2014-05-23 00:00:00', '0', '0', '0', '2090', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-17 13:29:37', '0000-00-00 00:00:00', 0, 0, 0),
(15, 1, '1,1,', 'project test1', 'Shajapur - Dupada Road, Narayangaon, Madhya Pradesh 465001, India', '', '', 'demo job ', '', '2014-05-22 00:00:00', '2014-05-25 00:00:00', '0', '0', '0', '10090', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-17 13:32:37', '2014-05-17 13:34:42', 0, 0, 1),
(16, 2, NULL, 'test project', 'Unnamed Road, Pologround Industrial Estate, Nanda Nagar, Kushwash Nagar, Indore, Madhya Pradesh 452003, India', '', '', 'test', 'test', '2014-05-20 09:20:46', '2014-05-20 09:20:46', '0', '0', '0', '2090', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-20 08:50:32', '2014-05-20 09:20:46', 0, 0, 1),
(17, 3, NULL, 'test project for customer', 'Indore Bypass Road, Indore, Madhya Pradesh 452016, India', '22.7067381', '75.92861049999999', 'test desc', 'memo', NULL, NULL, '0', '0', '0', '1090', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-20 09:19:23', '0000-00-00 00:00:00', 0, 0, 0),
(18, 2, '7,', 'test project', 'Bicholi Mardana Road, Gari Pipliya, Ramgarh, Madhya Pradesh 452016, India', '', '', 'test test desc', 'test', '2014-05-20 00:00:00', '2014-05-23 00:00:00', '0', '0', '0', '0', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-20 09:26:56', '2014-05-23 07:12:32', 0, 0, 1),
(19, 4, '1,8', 'test project 123', 'Trimurti Warehousing And Marketing Road, Dakachya, Madhya Pradesh 453771, India', '', '', 'test desc', 'memo', '2014-05-21 00:00:00', '2014-05-24 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-20 09:39:15', '2014-05-23 08:12:27', 0, 0, 1),
(20, 1, '1,7,8', 'test job', 'AB Road, Dewas Naka, Lasudia Mori, Indore, Madhya Pradesh 453771, India', '', '', 'test', 'test', '2014-05-21 00:00:00', '2014-05-24 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-22 13:22:17', '2014-05-22 13:30:37', 0, 0, 0),
(21, 1, '7,8,', 'test job testing', 'Dewas Road, Dewas, Madhya Pradesh 455001, India', '22.9810795', '76.03634480000005', 'fgfgfgffg', 'fgfgfg', '2014-05-21 00:00:00', '2014-05-24 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-22 13:29:33', '0000-00-00 00:00:00', 0, 0, 0),
(22, 1, '1,7', 'test project', 'Unnamed Road, Pologround Industrial Estate, Nanda Nagar, Kushwash Nagar, Indore, Madhya Pradesh 452003, India', '22.7485197', '75.84468019999997', 'test', 'test', '2014-05-20 00:00:00', '2014-05-23 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-23 08:17:45', '0000-00-00 00:00:00', 0, 0, 1),
(23, 3, '1,7', 'test job testing', 'National Highway 59A, Tissi, Madhya Pradesh 455227, India', '22.7158887', '76.28599380000003', 'test', '', '2014-05-20 00:00:00', '2014-05-23 00:00:00', '0', '0', '0', '100', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-23 08:18:47', '0000-00-00 00:00:00', 0, 0, 0),
(24, 1, '1,7', 'test', 'National Highway 59A, Pipalya Sahab, Madhya Pradesh 455227, India', '22.7146459', '76.35300759999996', 'hdfhgfhf', 'ghgfhgfhg', '2014-06-29 00:00:00', '2014-07-02 00:00:00', '0', '0', '0', '1000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-29 07:41:30', '0000-00-00 00:00:00', 0, 0, 0),
(25, 1, '1,7', 'test abc123', 'Unnamed Road, Pologround Industrial Estate, Nanda Nagar, Kushwash Nagar, Indore, Madhya Pradesh 452003, India', '', '', 'tes''t fgfdgfghjh jhgjhgmkn ./;./'';kp'' fyhuhg', 'test', '2014-05-30 00:00:00', '2014-05-31 00:00:00', '0', '0', '0', '100', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-05-31 07:30:09', '2014-05-31 11:58:57', 0, 0, 1),
(26, 1, NULL, 'test project', 'Unnamed Road, Pologround Industrial Estate, Nanda Nagar, Kushwash Nagar, Indore, Madhya Pradesh 452003, India', '', '', 'test', 'test', '2014-06-10 10:19:55', '2014-06-10 10:19:55', '0', '0', '0', '100', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-03 05:25:25', '2014-06-10 10:19:55', 0, 0, 1),
(27, 1, NULL, 'test project', 'Indore Bypass Road, Indore, Madhya Pradesh 452016, India', '22.7067381', '75.92861049999999', 'test', 'test', NULL, NULL, '0', '0', '0', '1000', 0, 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-03 07:44:52', '0000-00-00 00:00:00', 0, 0, 0),
(28, 1, NULL, 'test project', 'Indore Bypass Road, Silver Spring Phase 1, Mundla Nayta, Indore, Madhya Pradesh 452020, India', '22.6572983', '75.90828290000002', 'test', 'test', NULL, NULL, '0', '0', '0', '1000', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-03 13:43:17', '0000-00-00 00:00:00', 0, 0, 0),
(29, 1, NULL, 'test project for customer', 'indore', '22.7195687', '75.85772580000003', 'test', 'test', NULL, NULL, '0', '0', '0', '3280', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-04 05:53:14', '0000-00-00 00:00:00', 0, 0, 0),
(30, 4, NULL, 'test project', 'Madhya Pradesh State Highway 18, Jamgod, Madhya Pradesh 455115, India', '22.977314', '76.16927570000007', 'test', '', NULL, NULL, '0', '0', '0', '500', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-04 08:40:21', '2014-06-10 10:18:54', 0, 0, 0),
(31, 2, NULL, 'new project test', 'Jhonakr Palsavad Road, Lalupura, Madhya Pradesh 465106, India', '23.2301388', '76.20019439999999', 'this is test project', '', NULL, NULL, '330', '0', '0', '300', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-05 12:44:29', '2014-06-05 12:47:40', 0, 0, 0),
(32, 2, NULL, 'this new jobs', 'dsfdf', '', '', 'this is test job ', '', NULL, NULL, '3424', '0', '0', '3113', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-05 12:49:26', '2014-06-05 13:19:48', 0, 0, 0),
(33, 3, NULL, 'project title', 'test address', '', '', 'this is test project', '', NULL, NULL, '221', '0', '0', '201', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-05 13:22:28', '2014-06-05 13:37:09', 0, 0, 1),
(34, 2, NULL, 'test project', 'Indore Bypass Road, Silver Spring Phase 1, Mundla Nayta, Indore, Madhya Pradesh 452020, India', '22.6572983', '75.90828290000002', 'test', 'test', NULL, NULL, '110', '0', '0', '100', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-09 10:37:50', '0000-00-00 00:00:00', 0, 0, 0),
(35, 1, NULL, 'test project', 'Major District Road, Madhya Pradesh 452005, India', '22.748099', '75.77509629999997', 'abc', 'abc', NULL, NULL, '110', '0', '0', '100', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-10 10:11:15', '0000-00-00 00:00:00', 0, 0, 1),
(36, 2, '1,6', 'test job', 'National Highway 59A, Pipalya Sahab, Madhya Pradesh 455227, India', '22.7146459', '76.35300759999996', 'testing', 'testing', '2014-06-10 15:44:00', '2014-06-10 18:00:00', '11000', '0', '0', '10000', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-10 10:15:18', '0000-00-00 00:00:00', 0, 0, 0),
(37, 4, NULL, 'test project', 'Indore Bypass Road, Silver Spring Phase 1, Mundla Nayta, Indore, Madhya Pradesh 452020, India', '22.6572983', '75.90828290000002', 'gfdg', 'dfg', NULL, NULL, '110', '0', '0', '100', 0, 0, 0, 0, '2014-06-11 10:49:01', '0000-00-00 00:00:00', '2014-06-11 10:42:26', '0000-00-00 00:00:00', 0, 0, 0),
(38, 2, NULL, 'test project 123', 'Bicholi Mardana Road, Gari Pipliya, Ramgarh, Madhya Pradesh 452016, India', '22.7197615', '76.0024932', 'gfhgfh', 'ghfgh', '2014-06-11 10:44:12', '2014-06-11 10:44:12', '209', '0', '0', '190', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-11 10:44:12', '0000-00-00 00:00:00', 0, 0, 1),
(39, 4, NULL, 'test project', 'Unnamed Road, Pologround Industrial Estate, Nanda Nagar, Kushwash Nagar, Indore, Madhya Pradesh 452003, India', '22.7485197', '75.84468019999997', 'gfhgf', 'fghgg', NULL, NULL, '1213', '0', '0', '1103', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-11 10:50:36', '0000-00-00 00:00:00', 0, 0, 1),
(40, 6, NULL, 'rrr', 'rrr', '', '', '', '', NULL, NULL, '1', '0', '0', '1', 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-07-23 04:31:44', '0000-00-00 00:00:00', 0, 1, 1),
(41, 1, NULL, '1', 't', '', '', '', '', '2014-07-23 05:02:25', '2014-07-23 05:02:25', '1', '0', '0', '1', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-07-23 05:01:58', '2014-07-23 05:02:25', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers_staffs`
--

CREATE TABLE IF NOT EXISTS `customers_staffs` (
  `Staff_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_Name` varchar(50) NOT NULL,
  `Staff_UName` varchar(50) NOT NULL,
  `Staff_Email` varchar(100) NOT NULL,
  `Staff_Password` varchar(50) NOT NULL,
  `Staff_Color` varchar(50) DEFAULT NULL,
  `Full_Calendar` tinyint(4) NOT NULL,
  `Staff_Is_Active` tinyint(1) NOT NULL,
  `Updated_By` int(11) NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  PRIMARY KEY (`Staff_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers_staffs`
--

INSERT INTO `customers_staffs` (`Staff_ID`, `Staff_Name`, `Staff_UName`, `Staff_Email`, `Staff_Password`, `Staff_Color`, `Full_Calendar`, `Staff_Is_Active`, `Updated_By`, `Created`, `Modified`) VALUES
(1, 'test', '', 'test21@gmail.com', '', '#ffd207', 0, 0, 0, '2014-05-10 06:25:19', '2014-05-10 06:25:19'),
(6, 'jsi', 'jsi', 'jsi.kanand@gmail.com', '', '#85223b', 0, 0, 0, '2014-06-13 06:03:59', '2014-06-13 06:03:59'),
(7, 'farhan', 'farhan', 'farhan.cs06@gmail.com', '', '#99146f', 1, 0, 0, '2014-06-12 10:23:55', '2014-06-12 10:23:55'),
(8, 'abc', 'abc', 'abc123@gmail.com', '', '#7aa9c9', 0, 0, 0, '2014-06-10 11:43:45', '2014-06-10 11:43:45'),
(9, 'testing user', 'testing user', 'testing@gmail.com', '14e1b600b1fd579f47433b88e8d85291', '#2e27ff', 0, 0, 0, '2014-06-10 10:01:19', '2014-06-10 10:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `Event_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_ID` int(11) NOT NULL,
  `Event_Name` varchar(50) NOT NULL,
  `All_Day` tinyint(4) NOT NULL,
  `Start Date/Time` datetime NOT NULL,
  `End Date/Time` datetime NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  PRIMARY KEY (`Event_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Event_ID`, `Staff_ID`, `Event_Name`, `All_Day`, `Start Date/Time`, `End Date/Time`, `Created`, `Modified`) VALUES
(1, 1, 'lunch', 1, '2014-06-06 18:48:00', '2014-06-06 20:18:00', '2014-06-06 13:18:27', '2014-06-06 13:19:09'),
(2, 6, 'lunch', 1, '2014-06-06 13:00:00', '2014-06-06 15:00:00', '2014-06-06 13:18:27', '0000-00-00 00:00:00'),
(3, 6, 'snacks', 0, '2014-06-09 10:00:00', '2014-06-09 11:30:00', '2014-06-09 07:30:58', '2014-06-09 07:32:09'),
(4, 7, 'TEST', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-07-16 08:58:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `Inv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `INV_NO` varchar(50) NOT NULL,
  `Customer_ID` int(10) NOT NULL,
  `Quote_ID` int(10) NOT NULL,
  `Customer_Name` varchar(100) NOT NULL,
  `Date` datetime NOT NULL,
  `Due_Date` datetime NOT NULL,
  `Item` varchar(100) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Quantity` varchar(50) NOT NULL,
  `Unit_Price` varchar(50) NOT NULL,
  `Discount` varchar(50) NOT NULL,
  `Account_Type` varchar(30) NOT NULL,
  `Tax_Rate` varchar(50) NOT NULL,
  `Currency` varchar(25) NOT NULL,
  `Status` varchar(20) NOT NULL,
  PRIMARY KEY (`Inv_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`Inv_ID`, `INV_NO`, `Customer_ID`, `Quote_ID`, `Customer_Name`, `Date`, `Due_Date`, `Item`, `Description`, `Quantity`, `Unit_Price`, `Discount`, `Account_Type`, `Tax_Rate`, `Currency`, `Status`) VALUES
(1, 'INV-0002', 95, 498, ' Test Customer', '2014-06-23 15:07:09', '2014-06-23 15:07:09', 'test', 'test', '1', '400', '0', 'Sales-200', '10%', 'INR', 'Draft');

-- --------------------------------------------------------

--
-- Table structure for table `job_times`
--

CREATE TABLE IF NOT EXISTS `job_times` (
  `Job_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Quote_ID` int(10) NOT NULL,
  `Staff_ID` int(10) NOT NULL,
  `Start_Date_Time` datetime NOT NULL,
  `End_Date_Time` datetime NOT NULL,
  PRIMARY KEY (`Job_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `job_times`
--

INSERT INTO `job_times` (`Job_ID`, `Quote_ID`, `Staff_ID`, `Start_Date_Time`, `End_Date_Time`) VALUES
(1, 24, 1, '2014-06-06 18:48:00', '2014-06-06 20:48:00'),
(2, 24, 7, '2014-07-16 12:00:00', '2014-07-17 09:00:00'),
(7, 25, 1, '2014-05-30 00:00:00', '2014-05-31 00:00:00'),
(8, 25, 7, '2014-05-30 00:00:00', '2014-05-31 00:00:00'),
(9, 36, 1, '2014-06-10 15:44:00', '2014-06-10 19:30:00'),
(10, 36, 6, '2014-06-10 15:44:00', '2014-06-10 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `local_inventories`
--

CREATE TABLE IF NOT EXISTS `local_inventories` (
  `Inv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_ID` int(10) NOT NULL,
  `Inv_Title` varchar(50) NOT NULL,
  `Inv_Unit_Price` decimal(10,0) NOT NULL,
  `Inv_Total_Qty` int(11) NOT NULL,
  `Inv_Unit_Type` varchar(50) NOT NULL COMMENT 'Like Sq Meter, Per Unit, Per Kg, Per Hour etc',
  `Updated_By` int(11) NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  `Is_Deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`Inv_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `local_inventories`
--

INSERT INTO `local_inventories` (`Inv_ID`, `Category_ID`, `Inv_Title`, `Inv_Unit_Price`, `Inv_Total_Qty`, `Inv_Unit_Type`, `Updated_By`, `Created`, `Modified`, `Is_Deleted`) VALUES
(1, 1, 'item1', '100', 100, 'kg', 0, '2014-06-11 10:50:36', '0000-00-00 00:00:00', 0),
(2, 1, 'item2', '1003', 100, 'mtr', 0, '2014-06-11 10:50:37', '0000-00-00 00:00:00', 0),
(3, 1, 'Computer', '10000', 100, 'kg                        ', 0, '2014-06-10 10:15:18', '2014-06-04 08:24:27', 0),
(4, 2, 'Supply and Install Parts', '90', 100, 'Hour', 0, '2014-06-05 06:49:16', '0000-00-00 00:00:00', 0),
(5, 3, 'Supply and Install Parts', '90', 100, 'Hour', 0, '2014-06-11 10:44:13', '0000-00-00 00:00:00', 0),
(6, 4, 'item1', '101', 100, 'kg', 0, '2014-06-05 13:37:11', '0000-00-00 00:00:00', 0),
(7, 2, 'test', '250', 100, 'pcs                                               ', 0, '2014-06-10 10:42:16', '2014-06-10 10:42:16', 0),
(8, 5, 'rrr', '1', 100, '1', 0, '2014-07-23 04:31:44', '0000-00-00 00:00:00', 0),
(9, 6, 't', '1', 100, '1', 0, '2014-07-23 05:02:25', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `Pay_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_ID` int(11) NOT NULL,
  `Quote_ID` int(11) NOT NULL,
  `Total_Amount` decimal(10,0) NOT NULL,
  `Paid_Amount` decimal(10,0) NOT NULL,
  `Payment_Date` datetime NOT NULL,
  `Payment_Mode` varchar(50) NOT NULL,
  `Is_Partial` varchar(50) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `UpdatedBy` tinyint(4) NOT NULL,
  `Transaction_ID` varchar(200) NOT NULL,
  PRIMARY KEY (`Pay_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

CREATE TABLE IF NOT EXISTS `phases` (
  `Phase_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Phase_Number` int(11) NOT NULL,
  `Phase_Title` varchar(50) NOT NULL,
  `Quote_ID` int(11) NOT NULL,
  PRIMARY KEY (`Phase_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `phases`
--

INSERT INTO `phases` (`Phase_ID`, `Phase_Number`, `Phase_Title`, `Quote_ID`) VALUES
(3, 0, 'Phase 1', 1),
(4, 0, 'Phase 1', 2),
(7, 0, 'Phase 1', 8),
(9, 0, 'Phase 1', 7),
(10, 0, 'Phase 1', 14),
(11, 0, 'Phase 1', 17),
(13, 0, 'Phase 1', 21),
(14, 0, 'Phase 1', 20),
(17, 0, 'Phase 1', 6),
(18, 0, 'Phase 1', 23),
(19, 0, 'Phase 1', 24),
(20, 0, 'Phase 1', 27),
(21, 0, 'Phase 1', 28),
(22, 0, 'Phase 1', 29),
(23, 1, 'Phase 2', 29),
(25, 0, 'Phase 1', 13),
(28, 0, 'Phase 2', 31),
(31, 0, 'Phase 1', 32),
(32, 1, 'Phase 2', 32),
(33, 0, 'Phase 1', 34),
(34, 0, 'Phase 1', 36),
(35, 0, 'Phase 1', 30),
(36, 0, 'Phase 1', 37);

-- --------------------------------------------------------

--
-- Table structure for table `query_comments`
--

CREATE TABLE IF NOT EXISTS `query_comments` (
  `queryid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`queryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `query_comments`
--

INSERT INTO `query_comments` (`queryid`, `userid`, `subject`, `category`, `comment`, `status`) VALUES
(1, 13, 'test', 's', 'test', 1),
(2, 13, 'add quote', 's', 'how to add a quick quote', 0),
(3, 13, 'just to test', 's', 'test', 0),
(4, 13, 'to test', 's', 'test', 0),
(5, 13, 'to test', 's', 'test', 0),
(6, 79, 'testing query', 's', 'add query', 1),
(7, 79, 'abc', 's', 'abc123', 0),
(8, 79, 'query about quote', 's', 'how to add a quick quote', 0),
(9, 79, 'test', 's', 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotes_files`
--

CREATE TABLE IF NOT EXISTS `quotes_files` (
  `File_ID` int(11) NOT NULL AUTO_INCREMENT,
  `File_Name` varchar(100) NOT NULL,
  `Quote_ID` int(11) NOT NULL,
  PRIMARY KEY (`File_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quotes_files`
--

INSERT INTO `quotes_files` (`File_ID`, `File_Name`, `Quote_ID`) VALUES
(1, '181(5).pdf', 1),
(2, 'workoffice.png', 17);

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE IF NOT EXISTS `quote_items` (
  `Quote_Item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Item_id` int(11) NOT NULL,
  `Quote_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Area_ID` int(10) NOT NULL,
  `Unit_consumed` int(11) NOT NULL,
  `Unit_Per_Price` decimal(10,0) NOT NULL,
  `Item_Desc` text NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  PRIMARY KEY (`Quote_Item_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `quote_items`
--

INSERT INTO `quote_items` (`Quote_Item_ID`, `Item_id`, `Quote_ID`, `Category_ID`, `Area_ID`, `Unit_consumed`, `Unit_Per_Price`, `Item_Desc`, `CreatedDate`, `Modified`) VALUES
(3, 1, 1, 1, 3, 1, '1000', 'item1', '2014-05-09 08:23:08', '0000-00-00 00:00:00'),
(4, 2, 1, 1, 3, 1, '100', 'item2', '2014-05-09 08:23:10', '0000-00-00 00:00:00'),
(7, 1, 4, 1, 0, 1, '1000', 'item1', '2014-05-09 09:37:48', '0000-00-00 00:00:00'),
(10, 3, 5, 1, 0, 1, '1000', 'Computer', '2014-05-10 05:43:33', '0000-00-00 00:00:00'),
(11, 4, 5, 2, 0, 2, '90', 'Supply and Install Parts', '2014-05-10 05:43:35', '0000-00-00 00:00:00'),
(12, 2, 2, 1, 4, 1, '100', 'item2', '2014-05-12 08:25:07', '0000-00-00 00:00:00'),
(15, 1, 8, 1, 7, 1, '1000', 'item1', '2014-05-13 13:12:33', '0000-00-00 00:00:00'),
(16, 2, 8, 1, 7, 1, '100', 'item2', '2014-05-13 13:12:35', '0000-00-00 00:00:00'),
(17, 1, 9, 1, 0, 1, '1000', 'item1', '2014-05-14 13:37:32', '0000-00-00 00:00:00'),
(18, 2, 10, 1, 0, 1, '100', 'item2', '2014-05-15 04:58:47', '0000-00-00 00:00:00'),
(21, 1, 11, 1, 0, 1, '1000', 'item1', '2014-05-15 05:03:11', '0000-00-00 00:00:00'),
(22, 1, 12, 1, 0, 1, '1000', 'item1', '2014-05-17 13:08:29', '0000-00-00 00:00:00'),
(23, 4, 12, 2, 0, 1, '90', 'Supply and Install Parts', '2014-05-17 13:08:31', '0000-00-00 00:00:00'),
(24, 1, 3, 1, 0, 2, '3000', 'item1', '2014-05-17 13:10:04', '0000-00-00 00:00:00'),
(25, 2, 3, 1, 0, 1, '100', 'item2', '2014-05-17 13:10:06', '0000-00-00 00:00:00'),
(26, 4, 3, 2, 0, 1, '90', 'Supply and Install Parts', '2014-05-17 13:10:07', '0000-00-00 00:00:00'),
(29, 1, 7, 1, 9, 10, '1102000', 'item1', '2014-05-17 13:20:51', '0000-00-00 00:00:00'),
(30, 1, 14, 1, 10, 1, '1000', 'item1', '2014-05-17 13:29:37', '0000-00-00 00:00:00'),
(31, 5, 14, 3, 10, 1, '90', 'Supply and Install Parts', '2014-05-17 13:29:38', '0000-00-00 00:00:00'),
(32, 1, 14, 1, 11, 1, '1000', 'item1', '2014-05-17 13:29:39', '0000-00-00 00:00:00'),
(35, 4, 15, 2, 0, 1, '90', 'Supply and Install Parts', '2014-05-17 13:34:42', '0000-00-00 00:00:00'),
(36, 1, 15, 1, 0, 10, '10000', 'item1', '2014-05-17 13:34:43', '0000-00-00 00:00:00'),
(39, 1, 17, 1, 12, 1, '1000', 'item1', '2014-05-20 09:19:23', '0000-00-00 00:00:00'),
(40, 4, 17, 2, 12, 1, '90', 'Supply and Install Parts', '2014-05-20 09:19:24', '0000-00-00 00:00:00'),
(41, 3, 16, 1, 0, 1, '1000', 'Computer', '2014-05-20 09:20:46', '0000-00-00 00:00:00'),
(42, 4, 16, 2, 0, 1, '90', 'Supply and Install Parts', '2014-05-20 09:20:48', '0000-00-00 00:00:00'),
(43, 1, 16, 1, 0, 1, '1000', 'item1', '2014-05-20 09:20:49', '0000-00-00 00:00:00'),
(51, 1, 21, 1, 14, 1, '1000', 'item1', '2014-05-22 13:29:33', '0000-00-00 00:00:00'),
(52, 1, 20, 1, 15, 1, '1000', 'item1', '2014-05-22 13:30:37', '0000-00-00 00:00:00'),
(53, 1, 19, 1, 0, 1, '1000', 'item1', '2014-05-23 08:12:27', '0000-00-00 00:00:00'),
(55, 1, 6, 1, 18, 1, '1000', 'item1', '2014-05-23 08:16:38', '0000-00-00 00:00:00'),
(56, 1, 22, 1, 0, 1, '1000', 'item1', '2014-05-23 08:17:45', '0000-00-00 00:00:00'),
(57, 2, 23, 1, 19, 1, '100', 'item2', '2014-05-23 08:18:47', '0000-00-00 00:00:00'),
(58, 1, 24, 1, 20, 1, '1000', 'item1', '2014-05-29 07:41:30', '0000-00-00 00:00:00'),
(61, 2, 25, 1, 0, 1, '100', 'item2', '2014-05-31 11:58:57', '0000-00-00 00:00:00'),
(63, 1, 27, 1, 21, 1, '1000', 'item1', '2014-06-03 07:44:52', '0000-00-00 00:00:00'),
(64, 1, 28, 1, 22, 1, '1000', 'item1', '2014-06-03 13:43:17', '0000-00-00 00:00:00'),
(65, 1, 29, 1, 23, 10, '3000', 'item1', '2014-06-04 05:53:14', '0000-00-00 00:00:00'),
(66, 2, 29, 1, 23, 1, '100', 'item2', '2014-06-04 05:53:15', '0000-00-00 00:00:00'),
(67, 4, 29, 2, 24, 5, '90', 'Supply and Install Parts', '2014-06-04 05:53:17', '0000-00-00 00:00:00'),
(68, 5, 29, 3, 25, 10, '90', 'Supply and Install Parts', '2014-06-04 05:53:19', '0000-00-00 00:00:00'),
(71, 4, 13, 2, 27, 1, '90', 'Supply and Install Parts', '2014-06-05 06:49:16', '0000-00-00 00:00:00'),
(72, 2, 13, 1, 27, 1, '100', 'item2', '2014-06-05 06:49:17', '0000-00-00 00:00:00'),
(78, 2, 31, 1, 31, 1, '100', 'item2', '2014-06-05 12:47:40', '0000-00-00 00:00:00'),
(79, 2, 31, 1, 31, 1, '100', 'item2', '2014-06-05 12:47:41', '0000-00-00 00:00:00'),
(80, 1, 31, 1, 32, 1, '100', 'item1', '2014-06-05 12:47:43', '0000-00-00 00:00:00'),
(84, 2, 32, 1, 35, 1, '1003', 'item2', '2014-06-05 13:19:48', '0000-00-00 00:00:00'),
(85, 6, 32, 4, 35, 1, '1010', 'item1', '2014-06-05 13:19:50', '0000-00-00 00:00:00'),
(86, 1, 32, 1, 36, 1, '1100', 'item1', '2014-06-05 13:19:51', '0000-00-00 00:00:00'),
(91, 1, 33, 1, 0, 1, '100', 'item1', '2014-06-05 13:37:09', '0000-00-00 00:00:00'),
(92, 6, 33, 4, 0, 1, '101', 'item1', '2014-06-05 13:37:11', '0000-00-00 00:00:00'),
(93, 1, 34, 1, 37, 1, '100', 'item1', '2014-06-09 10:37:50', '0000-00-00 00:00:00'),
(94, 1, 35, 1, 0, 1, '100', 'item1', '2014-06-10 10:11:16', '0000-00-00 00:00:00'),
(95, 3, 36, 1, 38, 1, '10000', 'Computer', '2014-06-10 10:15:18', '0000-00-00 00:00:00'),
(96, 1, 30, 1, 39, 10, '5000', 'item1', '2014-06-10 10:18:54', '0000-00-00 00:00:00'),
(97, 1, 26, 1, 0, 10, '100', 'item1', '2014-06-10 10:19:55', '0000-00-00 00:00:00'),
(98, 1, 37, 1, 40, 1, '100', 'item1', '2014-06-11 10:42:26', '0000-00-00 00:00:00'),
(99, 1, 38, 1, 0, 1, '100', 'item1', '2014-06-11 10:44:12', '0000-00-00 00:00:00'),
(100, 5, 38, 3, 0, 1, '90', 'Supply and Install Parts', '2014-06-11 10:44:13', '0000-00-00 00:00:00'),
(101, 1, 39, 1, 0, 1, '100', 'item1', '2014-06-11 10:50:36', '0000-00-00 00:00:00'),
(102, 2, 39, 1, 0, 1, '1003', 'item2', '2014-06-11 10:50:37', '0000-00-00 00:00:00'),
(103, 8, 40, 5, 0, 1, '1', 'rrr', '2014-07-23 04:31:44', '0000-00-00 00:00:00'),
(105, 9, 41, 6, 0, 1, '1', 't', '2014-07-23 05:02:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `Setting_ID` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(256) NOT NULL,
  `tradingname` varchar(256) NOT NULL,
  `companylogo` varchar(500) NOT NULL,
  `businessline` text NOT NULL,
  `orgenizationtype` varchar(500) NOT NULL,
  `ausbusinessnumber` varchar(50) NOT NULL,
  `branch` varchar(256) NOT NULL,
  `orgenisationdiscription` text NOT NULL,
  `quikfind` varchar(256) NOT NULL,
  `attention` varchar(256) NOT NULL,
  `postaladdress` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `physicaladdress` text NOT NULL,
  `Discount` float NOT NULL COMMENT 'in %',
  `Profit` float NOT NULL COMMENT 'in %',
  `Overhead` float NOT NULL COMMENT 'in %',
  `Labour_Charge` float NOT NULL COMMENT 'in %',
  `Milestones` float NOT NULL,
  `Currency` varchar(50) NOT NULL,
  `Tax` float NOT NULL,
  `T&C` longtext NOT NULL,
  PRIMARY KEY (`Setting_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`Setting_ID`, `companyname`, `tradingname`, `companylogo`, `businessline`, `orgenizationtype`, `ausbusinessnumber`, `branch`, `orgenisationdiscription`, `quikfind`, `attention`, `postaladdress`, `city`, `phone`, `zip`, `country`, `physicaladdress`, `Discount`, `Profit`, `Overhead`, `Labour_Charge`, `Milestones`, `Currency`, `Tax`, `T&C`) VALUES
(1, 'Test User', 'test', '', '645654656', '0', '566546', '', 'gfdggfdgfg', 'sdfgdsf', 'dfd', 'sdfdf', 'dfdsf', '5465456545', 'sdfd', 'sdfd', '0', 0, 0, 0, 0, 0, '', 12, '<p>All the work assigned should be done on time</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queryid` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `queryid`, `comment`) VALUES
(1, 1, 'test'),
(2, 3, 'hello'),
(3, 5, 'test test'),
(4, 6, 'test'),
(5, 7, 'test 333');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
