-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2013 at 09:55 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `looney`
--
CREATE DATABASE IF NOT EXISTS `looney` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `looney`;

-- --------------------------------------------------------

--
-- Table structure for table `featuredpoem`
--

CREATE TABLE IF NOT EXISTS `featuredpoem` (
  `Title` varchar(30) NOT NULL DEFAULT '',
  `Author` varchar(30) DEFAULT NULL,
  `Poem` text,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featuredpoem`
--

INSERT INTO `featuredpoem` (`Title`, `Author`, `Poem`, `Date`) VALUES
('The Lad From The South', 'James Dunn', 'There once was a lad from the south;\r\nWho rarely opened his mouth.\r\nAnd when he did\r\nEveryone hid\r\nAnd cried â€˜Good lord, close your mouth!', '2013-10-29 08:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `poems`
--

CREATE TABLE IF NOT EXISTS `poems` (
  `Title` varchar(30) NOT NULL DEFAULT '',
  `Author` varchar(30) DEFAULT NULL,
  `Poem` text,
  `Rating` double DEFAULT NULL,
  `RatingCount` int(11) DEFAULT NULL,
  `RatingAverage` double DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poems`
--

INSERT INTO `poems` (`Title`, `Author`, `Poem`, `Rating`, `RatingCount`, `RatingAverage`, `Date`) VALUES
('My Foolish Dog', 'Kathlene Bouzek', 'My dog is quite hip\r\nExcept when he takes a dip\r\nHe looks like a fool\r\nwhen he jumps in the pool\r\nand reminds me of a sinking ship', 14, 3, 4.5, '2013-10-29 08:52:45'),
('Sample Poem', 'Charles', 'There was a young rustic named Mallory\r\nwho drew but a very small salary\r\nWhen he went to the show\r\nhis purse made him go\r\nto a seat in the uppermost gallery', 7, 2, 3.5, '2013-10-29 08:49:34'),
('The Lad From The South', 'James Dunn', 'There once was a lad from the south;\r\nWho rarely opened his mouth.\r\nAnd when he did\r\nEveryone hid\r\nAnd cried â€˜Good lord, close your mouth!', 3, 1, 3, '2013-10-29 08:47:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
