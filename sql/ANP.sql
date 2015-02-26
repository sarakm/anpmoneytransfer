-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2010 at 11:49 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anp`
--

-- --------------------------------------------------------

--
-- Table structure for table `anp_rates`
--

CREATE TABLE IF NOT EXISTS `anp_rates` (
  `id` int(11) NOT NULL auto_increment,
  `city` varchar(200) NOT NULL COMMENT 'city ',
  `country` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `rates` float NOT NULL COMMENT 'hold the rates',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `anp_rates`
--

INSERT INTO `anp_rates` (`id`, `city`, `country`, `currency`, `rates`) VALUES
(1, 'Colobra', 'Panama', 'USD', 0.95),
(2, 'Beijing', 'Japan', 'YEN', 80),
(4, 'Toronto', 'Canada', 'CAD', 1),
(5, 'Colon', 'Panama', 'USD', 0.95),
(6, 'New York', 'USA', 'USD', 0.95),
(7, 'Scarborough', 'Canada', 'CAD', 1),
(85, 'chennai', 'india', 'Rs.', 42),
(87, 'Bengalore', 'india', 'Rs.', 41),
(86, 'somalia', 'Russia', 'ruble', 1.2),
(88, 'vijayawada', 'india', 'Rs.', 34),
(89, 'columbo', 'sri lanka', 'Rs.', 51);

-- --------------------------------------------------------

--
-- Table structure for table `anp_reason`
--

CREATE TABLE IF NOT EXISTS `anp_reason` (
  `id` int(11) NOT NULL auto_increment,
  `reason` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `anp_reason`
--

INSERT INTO `anp_reason` (`id`, `reason`) VALUES
(1, 'for relatives in needs'),
(2, 'parent''s funeral');

-- --------------------------------------------------------

--
-- Table structure for table `anp_sp`
--

CREATE TABLE IF NOT EXISTS `anp_sp` (
  `id` int(11) NOT NULL auto_increment,
  `anp_fee` float NOT NULL COMMENT 'hold the anp fees',
  `cond_for_disc` int(11) NOT NULL COMMENT 'hold the condition of numbers of transaction from the client to get the special discount of anp fees',
  `anp_fee_disc` decimal(10,0) NOT NULL COMMENT 'hold the dicount of anp fees',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `anp_sp`
--

INSERT INTO `anp_sp` (`id`, `anp_fee`, `cond_for_disc`, `anp_fee_disc`) VALUES
(1, 10, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `anp_status`
--

CREATE TABLE IF NOT EXISTS `anp_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `anp_status`
--

INSERT INTO `anp_status` (`id`, `name`) VALUES
(1, 'started'),
(2, 'assigned'),
(3, 'pending'),
(4, 'completed'),
(5, 'error');

-- --------------------------------------------------------

--
-- Table structure for table `currency_name`
--

CREATE TABLE IF NOT EXISTS `currency_name` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL COMMENT 'currency name',
  `country` varchar(200) NOT NULL COMMENT 'country',
  `province` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `currency_name`
--

INSERT INTO `currency_name` (`id`, `name`, `country`, `province`, `city`) VALUES
(1, 'CND', 'Canada', 'Ontario', 'Toronto'),
(2, 'USD', 'Panama', 'Panama', 'Colon'),
(3, 'Yuan', 'China', 'China', 'Beijing'),
(4, 'USD', 'USA', 'NJ', 'NJ'),
(5, 'USD', 'US', 'New York', 'New York'),
(6, 'CAD', 'Canada', 'Ontario', 'Scarborough');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staffid` int(100) NOT NULL auto_increment,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(50) default NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) default NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `country` varchar(25) NOT NULL,
  `postalcode` varchar(7) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) default NULL,
  `email` varchar(50) default NULL,
  `fax` varchar(15) NOT NULL,
  `PID_DLN` varchar(15) default NULL,
  `identification` varchar(40) default NULL,
  `date` date NOT NULL,
  `username` varchar(30) default NULL,
  `password` varchar(30) default NULL,
  `level` varchar(6) NOT NULL,
  `budget` double NOT NULL,
  PRIMARY KEY  (`staffid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `firstname`, `middlename`, `lastname`, `gender`, `address1`, `address2`, `city`, `province`, `country`, `postalcode`, `phone1`, `phone2`, `email`, `fax`, `PID_DLN`, `identification`, `date`, `username`, `password`, `level`, `budget`) VALUES
(6, 'Luis', 'hing', 'Ho', 'M', '29292 lawrence ave e', '', 'Scarborough', 'Veraguas', 'PANAMA', '', '416-238-7654', '', 'luis@alphawebsolutions.ca', '44433242', '', '', '2010-02-22', 'luisit', 'password', 'staff', 104),
(3, 'shanker', 'dfes', 'sabapathy', 'M', '2929 lawrence ave e', '', 'Scarborough', 'Veraguas', 'Canada', '', '416-238-7654', '', 'luis@alphawebsolutions.ca', '44433242', '49823048230', NULL, '2010-02-22', 'vijaya', 'srinivas', 'admin', 676),
(4, 'smitha', '', 'km', 'M', 'dkjfds', 'fdfsd', 'New York', 'New York', 'USA', '08830', '732-549-6543', '', 'dfjkdf@yahoo.com', '732-439-3456', '423423', '', '2010-02-12', 'vijay', 'binder', 'staff', 2200),
(13, 'simran', 'kk', 'mty', 'F', '2929 lawrence ave e', '', 'Scarborough', 'ON', 'CANADA', 'm1p2s8', '416-238-7222', '', 'sales@alphawebsolutions.ca', '416-238-7654', '1234354', 'alphalogo.jpg', '2010-03-11', 'swetha', 'swetham', '3', 1000),
(15, 'murthy', '', 'amuzuri', 'F', 'fsdffsdfd', '', 'mississauga', 'dfsdfsd', 'INDIA', 'm09876', '7654320912', '', 'vijaya@alphawebsolutions.ca', '', '', '', '2010-03-18', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transactionid` int(100) NOT NULL auto_increment,
  `userid` int(20) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `sender_address` varchar(150) NOT NULL,
  `receiver_firstname` varchar(50) NOT NULL,
  `receiver_middlename` varchar(50) default NULL,
  `receiver_lastname` varchar(50) NOT NULL,
  `receiver_gender` varchar(1) NOT NULL,
  `receiver_address1` varchar(100) NOT NULL,
  `receiver_address2` varchar(100) default NULL,
  `receiver_city` varchar(50) NOT NULL,
  `receiver_province` varchar(50) NOT NULL,
  `receiver_country` varchar(25) NOT NULL,
  `receiver_postalcode` varchar(7) NOT NULL,
  `receiver_phone1` varchar(15) NOT NULL,
  `receiver_phone2` varchar(15) default NULL,
  `receiver_email` varchar(50) default NULL,
  `receiver_PID_DLN` varchar(15) default NULL,
  `receiver_identification` varchar(40) default NULL,
  `date_submitted` date NOT NULL,
  `date_completed` date default NULL,
  `apn_total` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `amount_to_receive` decimal(10,2) NOT NULL,
  `agent` varchar(20) default NULL,
  `status` varchar(20) NOT NULL,
  `reason` varchar(150) default NULL,
  `notes` varchar(100) default NULL,
  `trans_booker` varchar(10) NOT NULL,
  `n_transc` tinyint(5) NOT NULL,
  `trans_time` varchar(10) NOT NULL,
  `amount_sending` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `rate` decimal(7,2) NOT NULL,
  `email_status` tinyint(1) unsigned NOT NULL default '0',
  `selected` varchar(5) NOT NULL default 'NO',
  PRIMARY KEY  (`transactionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionid`, `userid`, `sender`, `sender_address`, `receiver_firstname`, `receiver_middlename`, `receiver_lastname`, `receiver_gender`, `receiver_address1`, `receiver_address2`, `receiver_city`, `receiver_province`, `receiver_country`, `receiver_postalcode`, `receiver_phone1`, `receiver_phone2`, `receiver_email`, `receiver_PID_DLN`, `receiver_identification`, `date_submitted`, `date_completed`, `apn_total`, `currency`, `amount_to_receive`, `agent`, `status`, `reason`, `notes`, `trans_booker`, `n_transc`, `trans_time`, `amount_sending`, `fee`, `rate`, `email_status`, `selected`) VALUES
(1, 8, 'vijaya', 'HHHJKH', 'TTY', 'sonia', 'OIU', 'F', 'KHJKHJK', 'JJKLJ', 'vsvsvs', 'JJJ', 'JKLJJ', '234232', '778678655', '230482342', 'JKLJL@YAHOO.COM', '809809809RTYDTY', 'ÿØÿà\0JFIF\0,,\0\0ÿí	LPhotoshop 3.0\08B', '2010-03-10', '2010-03-18', 1000.00, 'USD', 950.00, '13', 'assigned', NULL, 'NEW', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(2, 6, 'vijaya', 'fsdfsdfds;', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', '', 'dfsd@gmail.com', NULL, NULL, '2010-03-11', NULL, 234234.00, 'CND', 234568.00, '3', 'error', NULL, '', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(27, 6, 'vijaya km', '2929 lawrence ave', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', NULL, 'cuddapah', 'AP', 'India', '800003', '0934848232', NULL, '423@yahoo.com', 'dfsdf', NULL, '2010-03-12', NULL, 1000.00, 'Rupee', 39000.00, '3', 'started', 'rewrew', '423432', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(43, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1254.00, 'rupee', 41956.00, '3', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(29, 0, 'vijaya      wer km', '261 e george  Newjersey Newjersey CANADA', 'vijaya     ', 'wer', 'km', 'M', '261 e george', '', 'Newjersey', 'Newjersey', 'CANADA', '08830', '732-283-2555', 'receiver_phone2', 'jfdjf@yahoo.com', '42343423423', '', '2010-03-15', NULL, 0.00, '', 34000.00, '15', 'assigned', 'for relatives in needs', '', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(37, 6, 'vijay dfsd dfd', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-18', NULL, 1020.00, 'USD', 950.00, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(38, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1110.00, 'USD', 1035.50, '4', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(39, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1110.00, 'USD', 1035.50, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(40, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1110.00, 'USD', 1035.50, '3', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(41, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1110.00, 'USD', 1035.50, '3', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(42, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 686.00, 'rupee', 22644.00, '6', 'assigned', '0', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(36, 8, 'vijay dfsd dfd', '2929 lawrence ave  Don Mills Ottawa USA', 'vijay', 'dfsd', 'dfd', 'M', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-15', '2010-03-18', 5020.00, 'CND', 250000.00, '6', 'completed', 'for relatives in needs', '        dfsd', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(44, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1254.00, 'rupee', 41956.00, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(45, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1254.00, 'rupee', 41956.00, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(46, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1254.00, 'rupee', 41956.00, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(47, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1254.00, 'rupee', 41956.00, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(48, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-18', NULL, 1254.00, 'rupee', 41956.00, '13', 'assigned', 'for relatives in needs', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(49, 6, 'vijay dfsd dfd', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-18', NULL, 520.00, 'USD', 475.00, '6', 'assigned', '0', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(50, 6, 'vijay dfsd dfd', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-18', NULL, 520.00, 'USD', 475.00, '6', 'assigned', '0', '        ', '', 0, '', 0.00, 0.00, 0.00, 0, 'NO'),
(51, 6, 'gopi  budharapu', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-19', NULL, 1020.00, 'rupee', 34000.00, '3', 'assigned', 'for relatives in needs', '        dfsdf', '', 0, '', 0.00, 0.00, 0.00, 1, 'NO'),
(52, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-24', NULL, 1010.00, 'rupee', 42000.00, '13', 'assigned', 'for relatives in needs', '        ', '', 1, '', 0.00, 0.00, 0.00, 0, 'NO'),
(53, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-24', NULL, 5010.00, 'rupee', 210000.00, '3', 'assigned', '0', '        ', '3', 1, '', 0.00, 0.00, 0.00, 1, 'NO'),
(54, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-24', NULL, 5010.00, 'rupee', 255000.00, '6', 'started', '0', '        ', '3', 1, '', 0.00, 0.00, 0.00, 0, 'NO'),
(55, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-24', NULL, 3010.00, 'rupee', 126000.00, '13', 'assigned', 'for relatives in needs', '        ', '3', 2, '15:27:08', 0.00, 0.00, 0.00, 0, 'NO'),
(56, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-25', NULL, 1010.00, 'Rs.', 51000.00, '13', 'assigned', 'for relatives in needs', '        ', '3', 3, '10:50:09', 1000.00, 10.00, 0.00, 0, 'NO'),
(57, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-25', NULL, 1010.00, 'Rs.', 51000.00, '13', 'assigned', 'for relatives in needs', '        ', '3', 3, '10:52:22', 1000.00, 10.00, 0.00, 0, 'NO'),
(58, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-25', NULL, 1010.00, 'Rs.', 51000.00, '13', 'assigned', 'for relatives in needs', '        ', '3', 3, '10:56:10', 1000.00, 10.00, 0.00, 0, 'NO'),
(59, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-25', NULL, 1510.00, 'Rs.', 51000.00, '3', 'assigned', '0', '        ', '3', 4, '11:49:58', 1500.00, 10.00, 0.00, 0, 'NO'),
(60, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-25', NULL, 1310.00, 'Rs.', 54600.00, '13', 'assigned', '0', '        ', '3', 5, '12:07:02', 1300.00, 10.00, 0.00, 0, 'NO'),
(67, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-29', NULL, 0.00, '', 0.00, '6', 'started', '0', '        ', '3', 11, '10:54:48', 0.00, 0.00, 0.00, 1, 'NO'),
(62, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-25', NULL, 2510.00, 'Rs.', 105000.00, '3', 'assigned', '0', '        ', '3', 7, '12:12:41', 2500.00, 10.00, 0.00, 0, 'NO'),
(63, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-25', NULL, 1410.00, 'Rs.', 58800.00, '15', 'assigned', 'for relatives in needs', '        ', '3', 8, '12:44:58', 1400.00, 10.00, 0.00, 0, 'NO'),
(64, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'vijay', 'dfsd', 'dfd', 'F', 'dfsdfsdfd', '', 'cuddapah', 'AP', 'India', '800003', '0934848232', 'receiver_phone2', '423@yahoo.com', 'dfsdf', '', '2010-03-25', NULL, 1010.00, 'Rs.', 34000.00, '3', 'assigned', 'for relatives in needs', '        ', '3', 9, '15:35:20', 1000.00, 10.00, 34.00, 0, 'NO'),
(65, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-25', NULL, 4010.00, 'Rs.', 136000.00, '3', 'assigned', 'for relatives in needs', '        ', '3', 10, '16:20:43', 4000.00, 10.00, 34.00, 0, 'NO'),
(66, 8, 'vijaya   M km', '2929 lawrence ave  Don Mills Ottawa USA', 'TTY', 'sonia', 'OIU', 'F', 'KHJKHJK', 'JJKLJ', 'vsvsvs', 'JJJ', 'JKLJJ', '234232', '778678655', '230482342', 'JKLJL@YAHOO.COM', '809809809RTYDTY', '', '2010-03-25', NULL, 8010.00, 'YEN', 640000.00, '6', 'assigned', 'for relatives in needs', '        ', '3', 1, '16:30:21', 8000.00, 10.00, 80.00, 0, 'NO'),
(68, 6, 'vijaya         wer km', '261 e george  Newjersey Newjersey CANADA', 'gopi', '', 'budharapu', 'M', 'dfsdfsdf', 'dfsdfsd', 'North Carolina', 'Ohio', 'USA', '948756', '732-234-6778', 'receiver_phone2', 'dfsd@gmail.com', '', '', '2010-03-29', NULL, 1010.00, 'Rs.', 42000.00, '13', 'assigned', 'for relatives in needs', '        ', '3', 12, '10:56:41', 1000.00, 10.00, 42.00, 0, 'NO'),
(69, 8, 'vijaya   M km', '2929 lawrence ave  Don Mills Ottawa USA', 'TTY', 'sonia', 'OIU', 'F', 'KHJKHJK', 'JJKLJ', 'vsvsvs', 'JJJ', 'JKLJJ', '234232', '778678655', '230482342', 'JKLJL@YAHOO.COM', '809809809RTYDTY', '', '2010-03-31', NULL, 0.00, '', 0.00, '', 'started', 'for relatives in needs', '        ', '3', 2, '17:08:43', 0.00, 0.00, 0.00, 0, 'NO'),
(70, 8, 'vijaya   M km', '2929 lawrence ave  Don Mills Ottawa USA', 'TTY', 'sonia', 'OIU', 'F', 'KHJKHJK', 'JJKLJ', 'vsvsvs', 'JJJ', 'JKLJJ', '234232', '778678655', '230482342', 'JKLJL@YAHOO.COM', '809809809RTYDTY', '', '2010-03-31', NULL, 0.00, '', 0.00, '', 'started', 'for relatives in needs', '        ', '3', 3, '17:09:39', 0.00, 0.00, 0.00, 0, 'NO'),
(71, 8, 'vijaya   M km', '2929 lawrence ave  Don Mills Ottawa USA', ' ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2010-03-31', NULL, 0.00, '', 0.00, '', 'started', '0', '        ', '3', 4, '17:16:07', 0.00, 0.00, 0.00, 0, 'NO'),
(72, 8, 'vijaya   M km', '2929 lawrence ave  Don Mills Ottawa USA', ' ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2010-03-31', NULL, 0.00, '', 0.00, '', 'started', 'for relatives in needs', '        ', '3', 5, '17:16:42', 0.00, 0.00, 0.00, 0, 'NO'),
(73, 8, 'vijaya   M km', '2929 lawrence ave  Don Mills Ottawa USA', ' ', '', '', 'F', '', '', '', '', '', '', '', '', '', '', '', '2010-03-31', NULL, 0.00, '', 0.00, '', 'started', '0', '        ', '3', 6, '17:20:55', 0.00, 0.00, 0.00, 0, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(100) NOT NULL auto_increment,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) default NULL,
  `lastname` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) default NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postalcode` varchar(7) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) default NULL,
  `email` varchar(50) default NULL,
  `PID_DLN` varchar(15) default NULL,
  `identification` varchar(40) default NULL,
  `date` date NOT NULL,
  `n_transc` int(10) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `middlename`, `lastname`, `gender`, `address1`, `address2`, `city`, `province`, `country`, `postalcode`, `phone1`, `phone2`, `email`, `PID_DLN`, `identification`, `date`, `n_transc`) VALUES
(21, 'lakshmi', 'ksdf', 'dfsdkl', 'F', 'dkfjsd', 'dkfjsd', 'dfjsd', 'dkfsdkf', 'jfsdkfsdf', 'dfjsdkf', '3412334394', '', 'dfsd@yahoo.com', 'fsdfsdfsdf', '', '2010-03-10', 0),
(8, 'vijaya ', 'M', 'km', 'F', '2929 lawrence ave', '', 'Don Mills', 'Ottawa', 'USA', 'M!P008', '732-283-2555', '732-283-2555', 'vijayakm@yahoo.com', '', '', '2010-02-09', 0),
(6, 'vijaya       ', 'wer', 'km', 'F', '261 e george', '', 'Newjersey', 'Newjersey', 'CANADA', '08830', '732-283-2555', '732-283-2555', 'jfdjf@yahoo.com', '42343423423', '', '2010-02-12', 0),
(22, 'bima', 'dsfsdf', 'sdfsd', 'F', 'fsdfdfsd', 'sdfsd', 'sdfsd', 'sfsdfs', 'sdfsdf', 'sdfsdfs', '0987654321', '', 'dfsd@yahoo.com', 'dfsdfsd', '', '2010-03-10', 0),
(28, 'lakshmi', '', 'dfd', 'M', 'sdfsd', '', 'dfsd', 'sdfsd', 'sdfsdf', '124423', '732-283-2555', '', 'qwqw@yahoo.com', '4342343', 'alphalogo.jpg', '2010-03-11', 0),
(29, 'hasini', 'dfsd', 'dfsd', 'F', 'erewrew', '', 'kodada', 'AP', 'INDIA', '324234', '1234567898', '', '3423@yahoo.com', '34234', '', '2010-03-11', 0),
(32, 'shruthi', 'NEW', 'kal', 'M', '2829 Lawrence Ave', '', 'Scarborough', 'ON', 'USA', 'M1P2S8', '7654321468', '', 'kal@yahoo.com', '567m1p876', '', '2010-03-18', 0),
(33, 'sonia', 'df', 'rtyhg', 'M', '29292 lawrence ave e', '', 'Philadelphia', '', 'USA', '', '7459876543', '', '', 'sds342332', '', '2010-03-23', 0);
