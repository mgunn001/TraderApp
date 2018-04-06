-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2018 at 08:53 PM
-- Server version: 10.0.19-MariaDB-1~trusty-log
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Trader`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyerComments`
--

CREATE TABLE IF NOT EXISTS `buyerComments` (
  `id` int(11) NOT NULL,
  `buyerId` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyerComments`
--

INSERT INTO `buyerComments` (`id`, `buyerId`, `sellerId`, `comment`) VALUES
(1, 1, 1, 'good'),
(2, 1, 2, 'not good'),
(3, 1, 3, 'very bad'),
(4, 2, 2, 'excellent'),
(5, 2, 3, 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `buyerDetails`
--

CREATE TABLE IF NOT EXISTS `buyerDetails` (
  `id` int(11) NOT NULL,
  `buyerName` varchar(100) NOT NULL,
  `buyerPhoneNumber` varchar(10) DEFAULT NULL,
  `buyerEmail` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyerDetails`
--

INSERT INTO `buyerDetails` (`id`, `buyerName`, `buyerPhoneNumber`, `buyerEmail`) VALUES
(1, 'Buyer1', '1234567891', 'xxx@gmail.com'),
(2, 'Buyer2', '1023456789', 'xxxx@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `emailLogs`
--

CREATE TABLE IF NOT EXISTS `emailLogs` (
  `id` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `buyerId` int(11) NOT NULL,
  `emailContent` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `timePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postedVehicles`
--

CREATE TABLE IF NOT EXISTS `postedVehicles` (
  `id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `make` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `milesDriven` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `vehicleType` int(11) NOT NULL,
  `description` text NOT NULL,
  `sellerId` int(11) NOT NULL,
  `timePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postedVehicles`
--

INSERT INTO `postedVehicles` (`id`, `year`, `make`, `model`, `milesDriven`, `price`, `vehicleType`, `description`, `sellerId`, `timePosted`) VALUES
(1, 2010, 'Honda', 'Accord EX-L', 70079, '9872', 2, '', 1, '2018-04-05 00:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `sellerAddress`
--

CREATE TABLE IF NOT EXISTS `sellerAddress` (
  `id` int(11) NOT NULL,
  `addressLine1` text NOT NULL,
  `addressLine2` text,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerAddress`
--

INSERT INTO `sellerAddress` (`id`, `addressLine1`, `addressLine2`, `city`, `state`, `zipcode`) VALUES
(1, '1049 W, 49th street', 'Apt 107', 'Norfolk', 'VA', '23508'),
(2, '1049 W, 49th street', 'Apt 103', 'Norfolk', 'VA', '23508'),
(3, '1055 W, 48th street', 'Apt 23', 'Norfolk', 'VA', '23508');

-- --------------------------------------------------------

--
-- Table structure for table `sellerDetails`
--

CREATE TABLE IF NOT EXISTS `sellerDetails` (
  `id` int(11) NOT NULL,
  `sellerType` int(11) NOT NULL,
  `sellerName` varchar(100) NOT NULL,
  `sellerAddress` int(11) NOT NULL,
  `sellerPhoneNumber` varchar(10) DEFAULT NULL,
  `sellerWebsite` varchar(100) DEFAULT NULL,
  `sellerEmail` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerDetails`
--

INSERT INTO `sellerDetails` (`id`, `sellerType`, `sellerName`, `sellerAddress`, `sellerPhoneNumber`, `sellerWebsite`, `sellerEmail`) VALUES
(1, 1, 'Maheedhar Gunnam', 1, '7573554247', 'http://www.cs.odu.edu/~mgunnam/', 'maheedhargunnam@gmail.com'),
(2, 2, 'seller2', 2, '7573554247', 'http://www.cs.odu.edu/~mgunnam/', 'mgunn001@gmail.com'),
(3, 3, 'seller3', 3, '7573554247', 'http://www.cs.odu.edu/~mgunnam/', 'mgunn001@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sellerTypes`
--

CREATE TABLE IF NOT EXISTS `sellerTypes` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerTypes`
--

INSERT INTO `sellerTypes` (`id`, `type`) VALUES
(1, 'Dealer'),
(2, 'Broker'),
(3, 'Private Party'),
(4, 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `siteAccessLogs`
--

CREATE TABLE IF NOT EXISTS `siteAccessLogs` (
  `id` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `accesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicleMedia`
--

CREATE TABLE IF NOT EXISTS `vehicleMedia` (
  `id` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `mediaType` int(11) NOT NULL,
  `Path` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicleMedia`
--

INSERT INTO `vehicleMedia` (`id`, `vehicleId`, `mediaType`, `Path`) VALUES
(1, 1, 0, '...//'),
(2, 1, 0, '..//');

-- --------------------------------------------------------

--
-- Table structure for table `vehicleMetaData`
--

CREATE TABLE IF NOT EXISTS `vehicleMetaData` (
  `id` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `property` varchar(30) NOT NULL,
  `propertyValue` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicleMetaData`
--

INSERT INTO `vehicleMetaData` (`id`, `vehicleId`, `property`, `propertyValue`) VALUES
(1, 1, 'Exterior Color', 'White'),
(2, 1, 'Interior Color', 'Ivory'),
(3, 1, 'Transmission', '5-speed Automatic'),
(4, 1, 'Drivetrain', 'FWD');

-- --------------------------------------------------------

--
-- Table structure for table `vehicleTypes`
--

CREATE TABLE IF NOT EXISTS `vehicleTypes` (
  `id` int(11) NOT NULL,
  `vehicleType` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicleTypes`
--

INSERT INTO `vehicleTypes` (`id`, `vehicleType`) VALUES
(1, 'Truck'),
(2, 'Car'),
(3, 'Motorcycle'),
(4, 'RV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyerComments`
--
ALTER TABLE `buyerComments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyerId` (`buyerId`),
  ADD KEY `sellerId` (`sellerId`);

--
-- Indexes for table `buyerDetails`
--
ALTER TABLE `buyerDetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailLogs`
--
ALTER TABLE `emailLogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerId` (`sellerId`),
  ADD KEY `buyerId` (`buyerId`);

--
-- Indexes for table `postedVehicles`
--
ALTER TABLE `postedVehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerId` (`sellerId`),
  ADD KEY `vehicleType` (`vehicleType`);

--
-- Indexes for table `sellerAddress`
--
ALTER TABLE `sellerAddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellerDetails`
--
ALTER TABLE `sellerDetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerDetails_fk0` (`sellerType`),
  ADD KEY `sellerDetails_fk1` (`sellerAddress`);

--
-- Indexes for table `sellerTypes`
--
ALTER TABLE `sellerTypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `vehicleMedia`
--
ALTER TABLE `vehicleMedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- Indexes for table `vehicleMetaData`
--
ALTER TABLE `vehicleMetaData`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- Indexes for table `vehicleTypes`
--
ALTER TABLE `vehicleTypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyerComments`
--
ALTER TABLE `buyerComments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `buyerDetails`
--
ALTER TABLE `buyerDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emailLogs`
--
ALTER TABLE `emailLogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `postedVehicles`
--
ALTER TABLE `postedVehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sellerAddress`
--
ALTER TABLE `sellerAddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sellerDetails`
--
ALTER TABLE `sellerDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sellerTypes`
--
ALTER TABLE `sellerTypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vehicleMedia`
--
ALTER TABLE `vehicleMedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vehicleMetaData`
--
ALTER TABLE `vehicleMetaData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vehicleTypes`
--
ALTER TABLE `vehicleTypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyerComments`
--
ALTER TABLE `buyerComments`
  ADD CONSTRAINT `buyerComments_ibfk_1` FOREIGN KEY (`sellerId`) REFERENCES `sellerDetails` (`id`),
  ADD CONSTRAINT `buyerComments_ibfk_2` FOREIGN KEY (`buyerId`) REFERENCES `buyerDetails` (`id`);

--
-- Constraints for table `emailLogs`
--
ALTER TABLE `emailLogs`
  ADD CONSTRAINT `emailLogs_ibfk_1` FOREIGN KEY (`sellerId`) REFERENCES `sellerDetails` (`id`),
  ADD CONSTRAINT `emailLogs_ibfk_2` FOREIGN KEY (`buyerId`) REFERENCES `buyerDetails` (`id`);

--
-- Constraints for table `postedVehicles`
--
ALTER TABLE `postedVehicles`
  ADD CONSTRAINT `postedVehicles_ibfk_1` FOREIGN KEY (`vehicleType`) REFERENCES `vehicleTypes` (`id`),
  ADD CONSTRAINT `postedVehicles_ibfk_2` FOREIGN KEY (`sellerId`) REFERENCES `sellerDetails` (`id`);

--
-- Constraints for table `sellerDetails`
--
ALTER TABLE `sellerDetails`
  ADD CONSTRAINT `sellerDetails_fk0` FOREIGN KEY (`sellerType`) REFERENCES `sellerTypes` (`id`),
  ADD CONSTRAINT `sellerDetails_fk1` FOREIGN KEY (`sellerAddress`) REFERENCES `sellerAddress` (`id`);

--
-- Constraints for table `vehicleMedia`
--
ALTER TABLE `vehicleMedia`
  ADD CONSTRAINT `vehicleMedia_ibfk_1` FOREIGN KEY (`vehicleId`) REFERENCES `postedVehicles` (`id`);

--
-- Constraints for table `vehicleMetaData`
--
ALTER TABLE `vehicleMetaData`
  ADD CONSTRAINT `vehicleMetaData_ibfk_1` FOREIGN KEY (`vehicleId`) REFERENCES `postedVehicles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
