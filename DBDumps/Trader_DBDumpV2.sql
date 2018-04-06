-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2018 at 04:48 PM
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
-- Database: `trader`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyercomments`
--

DROP TABLE IF EXISTS `buyercomments`;
CREATE TABLE IF NOT EXISTS `buyercomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyerId` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `buyerId` (`buyerId`),
  KEY `sellerId` (`sellerId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyercomments`
--

INSERT INTO `buyercomments` (`id`, `buyerId`, `sellerId`, `comment`, `timestamp`) VALUES
(1, 1, 1, 'good', '0000-00-00 00:00:00'),
(2, 1, 2, 'not good', '0000-00-00 00:00:00'),
(3, 1, 3, 'very bad', '0000-00-00 00:00:00'),
(4, 2, 2, 'excellent', '0000-00-00 00:00:00'),
(5, 2, 3, 'nice', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `buyerdetails`
--

DROP TABLE IF EXISTS `buyerdetails`;
CREATE TABLE IF NOT EXISTS `buyerdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyerName` varchar(100) NOT NULL,
  `buyerPhoneNumber` varchar(10) DEFAULT NULL,
  `buyerEmail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyerdetails`
--

INSERT INTO `buyerdetails` (`id`, `buyerName`, `buyerPhoneNumber`, `buyerEmail`) VALUES
(1, 'Buyer1', '1234567891', 'xxx@gmail.com'),
(2, 'Buyer2', '1023456789', 'xxxx@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `emaillogs`
--

DROP TABLE IF EXISTS `emaillogs`;
CREATE TABLE IF NOT EXISTS `emaillogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sellerId` int(11) NOT NULL,
  `buyerId` int(11) NOT NULL,
  `emailContent` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `timePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sellerId` (`sellerId`),
  KEY `buyerId` (`buyerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postedvehicles`
--

DROP TABLE IF EXISTS `postedvehicles`;
CREATE TABLE IF NOT EXISTS `postedvehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `make` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `milesDriven` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `vehicleType` int(11) NOT NULL,
  `description` text NOT NULL,
  `sellerId` int(11) NOT NULL,
  `timePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sellerId` (`sellerId`),
  KEY `vehicleType` (`vehicleType`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postedvehicles`
--

INSERT INTO `postedvehicles` (`id`, `year`, `make`, `model`, `milesDriven`, `price`, `vehicleType`, `description`, `sellerId`, `timePosted`) VALUES
(1, 2010, 'Honda', 'Accord EX-L', 70079, '9872', 2, '', 1, '2018-04-05 00:21:41'),
(2, 2014, 'BMW', 'X4', 2000, '50000', 2, 'I love My car', 2, '2018-04-06 02:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `selleraddress`
--

DROP TABLE IF EXISTS `selleraddress`;
CREATE TABLE IF NOT EXISTS `selleraddress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addressLine1` text NOT NULL,
  `addressLine2` text,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selleraddress`
--

INSERT INTO `selleraddress` (`id`, `addressLine1`, `addressLine2`, `city`, `state`, `zipcode`) VALUES
(1, '1049 W, 49th street', 'Apt 107', 'Norfolk', 'VA', '23508'),
(2, '1049 W, 49th street', 'Apt 103', 'Norfolk', 'VA', '23508'),
(3, '1055 W, 48th street', 'Apt 23', 'Norfolk', 'VA', '23508');

-- --------------------------------------------------------

--
-- Table structure for table `sellerdetails`
--

DROP TABLE IF EXISTS `sellerdetails`;
CREATE TABLE IF NOT EXISTS `sellerdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sellerType` int(11) NOT NULL,
  `sellerName` varchar(100) NOT NULL,
  `sellerAddress` int(11) NOT NULL,
  `sellerPhoneNumber` varchar(10) DEFAULT NULL,
  `sellerWebsite` varchar(100) DEFAULT NULL,
  `sellerEmail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sellerDetails_fk0` (`sellerType`),
  KEY `sellerDetails_fk1` (`sellerAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerdetails`
--

INSERT INTO `sellerdetails` (`id`, `sellerType`, `sellerName`, `sellerAddress`, `sellerPhoneNumber`, `sellerWebsite`, `sellerEmail`) VALUES
(1, 1, 'Maheedhar Gunnam', 1, '7573554247', 'http://www.cs.odu.edu/~mgunnam/', 'maheedhargunnam@gmail.com'),
(2, 2, 'seller2', 2, '7573554247', 'http://www.cs.odu.edu/~mgunnam/', 'mgunn001@gmail.com'),
(3, 3, 'seller3', 3, '7573554247', 'http://www.cs.odu.edu/~mgunnam/', 'mgunn001@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sellertypes`
--

DROP TABLE IF EXISTS `sellertypes`;
CREATE TABLE IF NOT EXISTS `sellertypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellertypes`
--

INSERT INTO `sellertypes` (`id`, `type`) VALUES
(1, 'Dealer'),
(2, 'Broker'),
(3, 'Private Party'),
(4, 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `siteaccesslogs`
--

DROP TABLE IF EXISTS `siteaccesslogs`;
CREATE TABLE IF NOT EXISTS `siteaccesslogs` (
  `id` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `accesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemedia`
--

DROP TABLE IF EXISTS `vehiclemedia`;
CREATE TABLE IF NOT EXISTS `vehiclemedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleId` int(11) NOT NULL,
  `mediaType` int(11) NOT NULL,
  `Path` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicleId` (`vehicleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehiclemedia`
--

INSERT INTO `vehiclemedia` (`id`, `vehicleId`, `mediaType`, `Path`) VALUES
(1, 1, 1, 'http://www.industryweek.com/sites/industryweek.com/files/styles/article_featured_standard/public/BMW-X7--2_0.gif?itok=cFWK8uVh'),
(2, 1, 1, 'http://cdn1.evo.co.uk/sites/evo/files/styles/gallery_adv/public/2017/09/bmw_x7_concept_-_front_three_quarter_.jpg?itok=bEup4Zp5'),
(3, 2, 1, 'http://www.industryweek.com/sites/industryweek.com/files/styles/article_featured_standard/public/BMW-X7--2_0.gif?itok=cFWK8uVh'),
(4, 2, 1, 'http://cdn1.evo.co.uk/sites/evo/files/styles/gallery_adv/public/2017/09/bmw_x7_concept_-_front_three_quarter_.jpg?itok=bEup4Zp5');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemetadata`
--

DROP TABLE IF EXISTS `vehiclemetadata`;
CREATE TABLE IF NOT EXISTS `vehiclemetadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleId` int(11) NOT NULL,
  `property` varchar(30) NOT NULL,
  `propertyValue` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicleId` (`vehicleId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehiclemetadata`
--

INSERT INTO `vehiclemetadata` (`id`, `vehicleId`, `property`, `propertyValue`) VALUES
(1, 1, 'Exterior Color', 'White'),
(2, 1, 'Interior Color', 'Ivory'),
(3, 1, 'Transmission', '5-speed Automatic'),
(4, 1, 'Drivetrain', 'FWD'),
(5, 2, 'Exterior Color', 'Black'),
(6, 2, 'Interior Color', 'Ivory'),
(7, 2, 'Transmission', '5-speed Automatic'),
(8, 2, 'Drivetrain', 'AWD');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletypes`
--

DROP TABLE IF EXISTS `vehicletypes`;
CREATE TABLE IF NOT EXISTS `vehicletypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleType` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicletypes`
--

INSERT INTO `vehicletypes` (`id`, `vehicleType`) VALUES
(1, 'Truck'),
(2, 'Car'),
(3, 'Motorcycle'),
(4, 'RV');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyercomments`
--
ALTER TABLE `buyercomments`
  ADD CONSTRAINT `buyerComments_ibfk_1` FOREIGN KEY (`sellerId`) REFERENCES `sellerdetails` (`id`),
  ADD CONSTRAINT `buyerComments_ibfk_2` FOREIGN KEY (`buyerId`) REFERENCES `buyerdetails` (`id`);

--
-- Constraints for table `emaillogs`
--
ALTER TABLE `emaillogs`
  ADD CONSTRAINT `emailLogs_ibfk_1` FOREIGN KEY (`sellerId`) REFERENCES `sellerdetails` (`id`),
  ADD CONSTRAINT `emailLogs_ibfk_2` FOREIGN KEY (`buyerId`) REFERENCES `buyerdetails` (`id`);

--
-- Constraints for table `postedvehicles`
--
ALTER TABLE `postedvehicles`
  ADD CONSTRAINT `postedVehicles_ibfk_1` FOREIGN KEY (`vehicleType`) REFERENCES `vehicletypes` (`id`),
  ADD CONSTRAINT `postedVehicles_ibfk_2` FOREIGN KEY (`sellerId`) REFERENCES `sellerdetails` (`id`);

--
-- Constraints for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  ADD CONSTRAINT `sellerDetails_fk0` FOREIGN KEY (`sellerType`) REFERENCES `sellertypes` (`id`),
  ADD CONSTRAINT `sellerDetails_fk1` FOREIGN KEY (`sellerAddress`) REFERENCES `selleraddress` (`id`);

--
-- Constraints for table `vehiclemedia`
--
ALTER TABLE `vehiclemedia`
  ADD CONSTRAINT `vehicleMedia_ibfk_1` FOREIGN KEY (`vehicleId`) REFERENCES `postedvehicles` (`id`);

--
-- Constraints for table `vehiclemetadata`
--
ALTER TABLE `vehiclemetadata`
  ADD CONSTRAINT `vehicleMetaData_ibfk_1` FOREIGN KEY (`vehicleId`) REFERENCES `postedvehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
