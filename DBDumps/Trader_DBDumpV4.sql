-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2018 at 06:51 PM
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
-- Table structure for table `buyercomments`
--

CREATE TABLE IF NOT EXISTS `buyercomments` (
  `id` int(11) NOT NULL,
  `buyerId` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyercomments`
--

INSERT INTO `buyercomments` (`id`, `buyerId`, `sellerId`, `comment`, `timestamp`) VALUES
(1, 1, 1, 'good', '0000-00-00 00:00:00'),
(2, 1, 2, 'not good', '0000-00-00 00:00:00'),
(3, 1, 3, 'very bad', '0000-00-00 00:00:00'),
(4, 2, 2, 'excellent', '0000-00-00 00:00:00'),
(5, 2, 3, 'nice', '0000-00-00 00:00:00'),
(6, 1, 2, 'Super duper ', '2018-04-07 22:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `buyerdetails`
--

CREATE TABLE IF NOT EXISTS `buyerdetails` (
  `id` int(11) NOT NULL,
  `buyerName` varchar(100) NOT NULL,
  `buyerPhoneNumber` varchar(10) DEFAULT NULL,
  `buyerEmail` varchar(100) NOT NULL
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

CREATE TABLE IF NOT EXISTS `emaillogs` (
  `id` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `buyerId` int(11) NOT NULL,
  `emailContent` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `timePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpertags`
--

CREATE TABLE IF NOT EXISTS `helpertags` (
  `helpertagid` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `vehicletypeid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `helpertags`
--

INSERT INTO `helpertags` (`helpertagid`, `keyword`, `vehicletypeid`) VALUES
(1, 'Super Bike', 1),
(2, 'Sport Bike', 1),
(3, 'Race Bike', 1),
(4, 'Scooty', 1),
(5, 'Economy Bike', 1),
(6, 'Gear Less Bike', 1),
(7, 'Sport Car', 2),
(8, 'Auto Car', 2),
(9, 'Manual Car', 2),
(10, 'Luxury Car', 2),
(11, 'Premium Car', 2);

-- --------------------------------------------------------

--
-- Table structure for table `postedvehicles`
--

CREATE TABLE IF NOT EXISTS `postedvehicles` (
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postedvehicles`
--

INSERT INTO `postedvehicles` (`id`, `year`, `make`, `model`, `milesDriven`, `price`, `vehicleType`, `description`, `sellerId`, `timePosted`) VALUES
(1, 2010, 'Honda', 'Accord ex-l', 70079, '9872', 2, 'Selling mainly as I am leaving the country', 1, '2018-04-07 02:35:01'),
(2, 2014, 'Bmw', 'X4', 2000, '50000', 2, 'I love My car', 2, '2018-04-07 02:35:04'),
(3, 2016, 'Yamaha', 'R1', 2000, '10000', 1, 'My Super bike', 1, '2018-04-07 03:07:48'),
(4, 2005, 'Audi', 'A3', 10000, '5000', 2, 'Brand New Audi A3', 2, '2018-04-07 21:47:58'),
(5, 2006, 'Bmw', 'X6', 20000, '8000', 2, 'Brand New X6 Bmw', 2, '2018-04-07 21:48:52'),
(6, 2015, 'Honda', 'CRV', 10000, '5000', 2, 'Brand New Honda CRV', 2, '2018-04-07 21:54:38'),
(7, 2000, 'Bmw', 'X1', 15000, '20000', 2, 'Brand New Bmw', 2, '2018-04-07 21:54:38'),
(8, 2012, 'Audi', 'Q7', 20000, '15000', 2, 'Brand New Audi', 2, '2018-04-07 21:54:38'),
(9, 2011, 'Bmw', 'X5', 5000, '25000', 2, 'Brand New Bmw X5', 2, '2018-04-07 21:54:38'),
(10, 2015, 'Yamaha', 'R15', 10000, '5000', 1, 'Brand New', 1, '2018-04-07 22:00:45'),
(11, 2000, 'Suzuki', 'HayaBusa', 15000, '20000', 1, 'Brand New', 1, '2018-04-07 22:00:45'),
(12, 2012, 'Yamaha', 'R15', 20000, '15000', 1, 'Brand New', 1, '2018-04-07 22:00:45'),
(13, 2011, 'Yamaha', 'R1', 5000, '25000', 1, 'Brand New', 1, '2018-04-07 22:00:45'),
(14, 2015, 'Suzuki', 'Hayate', 10000, '9000', 1, 'Brand New', 3, '2018-04-07 22:02:19'),
(15, 2000, 'Yamaha', 'R1', 15000, '20000', 1, 'Brand New', 3, '2018-04-07 22:00:45'),
(16, 2011, 'Yamaha', 'R15', 5000, '25000', 1, 'Super Bike', 3, '2018-04-07 22:02:02'),
(17, 2015, 'Suzuki', 'Hayate', 10000, '7000', 1, 'Super Bike', 1, '2018-04-07 22:02:25'),
(18, 2000, 'Suzuki', 'Hayate', 15000, '20000', 1, 'Super Bike', 2, '2018-04-07 22:02:02'),
(19, 2012, 'Suzuki', 'HayaBusa', 20000, '15000', 1, 'Super Bike', 2, '2018-04-07 22:02:02'),
(20, 2011, 'Yamaha', 'R1', 5000, '25000', 1, 'Super Bike', 3, '2018-04-07 22:02:02'),
(21, 2000, 'Yamaha', 'R1', 15000, '20000', 1, 'Brand New', 3, '2018-04-07 22:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `selleraddress`
--

CREATE TABLE IF NOT EXISTS `selleraddress` (
  `id` int(11) NOT NULL,
  `addressLine1` text NOT NULL,
  `addressLine2` text,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL
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

CREATE TABLE IF NOT EXISTS `sellerdetails` (
  `id` int(11) NOT NULL,
  `sellerType` int(11) NOT NULL,
  `sellerName` varchar(100) NOT NULL,
  `sellerAddress` int(11) NOT NULL,
  `sellerPhoneNumber` varchar(10) DEFAULT NULL,
  `sellerWebsite` varchar(100) DEFAULT NULL,
  `sellerEmail` varchar(100) NOT NULL
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

CREATE TABLE IF NOT EXISTS `sellertypes` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
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

CREATE TABLE IF NOT EXISTS `siteaccesslogs` (
  `id` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `accesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagsonpostedvehicles`
--

CREATE TABLE IF NOT EXISTS `tagsonpostedvehicles` (
  `vehicleid` int(11) NOT NULL,
  `helpertagid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagsonpostedvehicles`
--

INSERT INTO `tagsonpostedvehicles` (`vehicleid`, `helpertagid`) VALUES
(1, 7),
(1, 8),
(1, 10),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(3, 3),
(3, 5),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(6, 7),
(6, 9),
(6, 10),
(6, 11),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(8, 7),
(8, 8),
(8, 9),
(9, 7),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(9, 11),
(10, 1),
(10, 2),
(10, 3),
(10, 5),
(11, 1),
(11, 2),
(11, 4),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(13, 4),
(13, 6),
(14, 1),
(14, 2),
(14, 6),
(15, 1),
(15, 3),
(15, 5),
(16, 2),
(17, 1),
(17, 2),
(17, 6),
(18, 1),
(18, 3),
(19, 4),
(19, 5),
(20, 1),
(21, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemedia`
--

CREATE TABLE IF NOT EXISTS `vehiclemedia` (
  `id` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `mediaType` int(11) NOT NULL,
  `Path` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehiclemedia`
--

INSERT INTO `vehiclemedia` (`id`, `vehicleId`, `mediaType`, `Path`) VALUES
(1, 1, 1, 'https://www.andersonhonda.com/assets/misc/10928/739875.png'),
(2, 1, 1, 'https://pictures.dealer.com/v/victoryautomotivegroup/0284/a99a1dd78b56043a32a51a650ae0d568x.jpg'),
(3, 2, 1, 'http://www.industryweek.com/sites/industryweek.com/files/styles/article_featured_standard/public/BMW-X7--2_0.gif?itok=cFWK8uVh'),
(4, 2, 1, 'http://cdn1.evo.co.uk/sites/evo/files/styles/gallery_adv/public/2017/09/bmw_x7_concept_-_front_three_quarter_.jpg?itok=bEup4Zp5'),
(5, 3, 1, 'https://ic1.maxabout.us/autos/tw_india//Y/2017/3/yamaha-yzf-r1-2014-old.jpg'),
(6, 3, 1, 'http://motoparttoto.com/wp-content/uploads/2014/07/248b6f16bf-e1406744464522.png');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemetadata`
--

CREATE TABLE IF NOT EXISTS `vehiclemetadata` (
  `id` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `property` varchar(30) NOT NULL,
  `propertyValue` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehiclemetadata`
--

INSERT INTO `vehiclemetadata` (`id`, `vehicleId`, `property`, `propertyValue`) VALUES
(1, 1, 'Color', 'White'),
(2, 1, 'Owners', '2'),
(3, 1, 'Fuel', 'petrol'),
(4, 1, 'Drivetrain', 'FWD'),
(5, 2, 'Exterior Color', 'Black'),
(6, 2, 'Interior Color', 'Ivory'),
(7, 2, 'Transmission', '5-speed Automatic'),
(8, 2, 'Drivetrain', 'AWD'),
(9, 3, 'Owner', '1'),
(11, 3, 'Color', 'Black'),
(12, 3, 'Seats', '1'),
(13, 3, 'Silenser', '2');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletypes`
--

CREATE TABLE IF NOT EXISTS `vehicletypes` (
  `id` int(11) NOT NULL,
  `vehicleType` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicletypes`
--

INSERT INTO `vehicletypes` (`id`, `vehicleType`) VALUES
(1, 'Motorcycle'),
(2, 'Car'),
(3, 'RV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyercomments`
--
ALTER TABLE `buyercomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyerId` (`buyerId`),
  ADD KEY `sellerId` (`sellerId`);

--
-- Indexes for table `buyerdetails`
--
ALTER TABLE `buyerdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emaillogs`
--
ALTER TABLE `emaillogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerId` (`sellerId`),
  ADD KEY `buyerId` (`buyerId`);

--
-- Indexes for table `helpertags`
--
ALTER TABLE `helpertags`
  ADD PRIMARY KEY (`helpertagid`),
  ADD KEY `vehicletypeid` (`vehicletypeid`);

--
-- Indexes for table `postedvehicles`
--
ALTER TABLE `postedvehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerId` (`sellerId`),
  ADD KEY `vehicleType` (`vehicleType`);

--
-- Indexes for table `selleraddress`
--
ALTER TABLE `selleraddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerDetails_fk0` (`sellerType`),
  ADD KEY `sellerDetails_fk1` (`sellerAddress`);

--
-- Indexes for table `sellertypes`
--
ALTER TABLE `sellertypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tagsonpostedvehicles`
--
ALTER TABLE `tagsonpostedvehicles`
  ADD KEY `vehicletype` (`vehicleid`,`helpertagid`),
  ADD KEY `helpertagid` (`helpertagid`);

--
-- Indexes for table `vehiclemedia`
--
ALTER TABLE `vehiclemedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- Indexes for table `vehiclemetadata`
--
ALTER TABLE `vehiclemetadata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- Indexes for table `vehicletypes`
--
ALTER TABLE `vehicletypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyercomments`
--
ALTER TABLE `buyercomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `buyerdetails`
--
ALTER TABLE `buyerdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emaillogs`
--
ALTER TABLE `emaillogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `helpertags`
--
ALTER TABLE `helpertags`
  MODIFY `helpertagid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `postedvehicles`
--
ALTER TABLE `postedvehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `selleraddress`
--
ALTER TABLE `selleraddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sellertypes`
--
ALTER TABLE `sellertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vehiclemedia`
--
ALTER TABLE `vehiclemedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vehiclemetadata`
--
ALTER TABLE `vehiclemetadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `vehicletypes`
--
ALTER TABLE `vehicletypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
-- Constraints for table `helpertags`
--
ALTER TABLE `helpertags`
  ADD CONSTRAINT `helpertags_ibfk_1` FOREIGN KEY (`vehicletypeid`) REFERENCES `vehicletypes` (`id`);

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
-- Constraints for table `tagsonpostedvehicles`
--
ALTER TABLE `tagsonpostedvehicles`
  ADD CONSTRAINT `tagsonpostedvehicles_ibfk_1` FOREIGN KEY (`helpertagid`) REFERENCES `helpertags` (`helpertagid`),
  ADD CONSTRAINT `tagsonpostedvehicles_ibfk_2` FOREIGN KEY (`vehicleid`) REFERENCES `postedvehicles` (`id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
