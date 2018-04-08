-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 08, 2018 at 06:30 PM
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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `FilterSearch`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `FilterSearch` (IN `in_VehicleType_ID` INT, IN `in_Keyword` VARCHAR(100), IN `in_Price` TEXT, IN `in_Mileage` TEXT, IN `in_Make` TEXT, IN `in_Model` TEXT, IN `in_Year` TEXT, IN `in_bodyType` VARCHAR(100), IN `in_color` VARCHAR(45), IN `in_Transmission` VARCHAR(100))  BEGIN

DROP TEMPORARY TABLE IF EXISTS _temp_table;
CREATE TEMPORARY TABLE IF NOT EXISTS `_temp_table` (
    `t_price` INT NULL,
    `t_mileage` INT NULL
);

set @sql = concat('insert into _temp_table (t_price) values(',  replace(in_Price, ',', '),(') ,');');
prepare insert_statement from @sql;
execute insert_statement;

set @sql = concat('insert into _temp_table (t_mileage) values(',  replace(in_Mileage, ',', '),(') ,');');
prepare insert_statement from @sql;
execute insert_statement;

set sql_safe_updates = 0;
UPDATE `_temp_table` 
SET 
    `t_price` = (t_price * 1000),
    `t_mileage` = (t_mileage * 1000);
set sql_safe_updates = 1;

SELECT MIN(t_price), MAX(t_price) INTO @min_Price , @max_Price FROM _temp_table;
SELECT MIN(t_mileage), MAX(t_mileage) INTO @min_Mileage , @max_Mileage FROM _temp_table;


    SET @sql = concat(' 
		SELECT 
			distinct pv.id, pv.year, pv.make, pv.model, pv.milesDriven, pv.price, pv.description, vt.vehicleType
		FROM
			trader.tagsonpostedvehicles tpv
				INNER JOIN
			helpertags ht ON tpv.helpertagid = ht.helpertagid and ht.keyword =', in_Keyword, '
				INNER JOIN
			vehicletypes vt on vt.id = ht.vehicletypeid and vt.id = ',in_VehicleType_ID,'
				INNER JOIN
			postedvehicles pv on pv.id = tpv.vehicleid
				INNER JOIN
			vehiclemetadata vm on vm.vehicleId = pv.id
		WHERE
			(pv.year IN (', in_Price, ')
				OR pv.make IN (', in_Make,  ')
				OR pv.model IN (', in_Model, ')
				OR (pv.milesDriven BETWEEN @min_Mileage AND @max_Mileage)
				OR (pv.price BETWEEN @min_Price AND @max_Price));');
	
    select @sql;
	
    PREPARE stmt FROM @sql;
	EXECUTE stmt;
    
    
	DEALLOCATE PREPARE stmt;
    
    


DROP TEMPORARY TABLE IF EXISTS _temp_table;
                
END$$

DELIMITER ;

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `buyerId` (`buyerId`),
  KEY `sellerId` (`sellerId`)
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
-- Table structure for table `helpertags`
--

DROP TABLE IF EXISTS `helpertags`;
CREATE TABLE IF NOT EXISTS `helpertags` (
  `helpertagid` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `vehicletypeid` int(11) NOT NULL,
  PRIMARY KEY (`helpertagid`),
  KEY `vehicletypeid` (`vehicletypeid`)
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
-- Table structure for table `tagsonpostedvehicles`
--

DROP TABLE IF EXISTS `tagsonpostedvehicles`;
CREATE TABLE IF NOT EXISTS `tagsonpostedvehicles` (
  `vehicleid` int(11) NOT NULL,
  `helpertagid` int(11) NOT NULL,
  KEY `vehicletype` (`vehicleid`,`helpertagid`),
  KEY `helpertagid` (`helpertagid`)
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

DROP TABLE IF EXISTS `vehiclemedia`;
CREATE TABLE IF NOT EXISTS `vehiclemedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleId` int(11) NOT NULL,
  `mediaType` int(11) NOT NULL,
  `Path` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicleId` (`vehicleId`)
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

DROP TABLE IF EXISTS `vehiclemetadata`;
CREATE TABLE IF NOT EXISTS `vehiclemetadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleId` int(11) NOT NULL,
  `property` varchar(30) NOT NULL,
  `propertyValue` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicleId` (`vehicleId`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehiclemetadata`
--

INSERT INTO `vehiclemetadata` (`id`, `vehicleId`, `property`, `propertyValue`) VALUES
(1, 1, 'Color', 'White'),
(2, 1, 'Owners', '2'),
(3, 1, 'Fuel', 'Petrol'),
(4, 1, 'Drivetrain', 'FWD'),
(5, 2, 'Exterior Color', 'Black'),
(6, 2, 'Interior Color', 'Ivory'),
(7, 2, 'Transmission', '5-speed Automatic'),
(8, 2, 'Drivetrain', 'AWD'),
(9, 3, 'Owner', '1'),
(11, 3, 'Color', 'Black'),
(12, 3, 'Seats', '1'),
(13, 3, 'Silenser', '2'),
(60, 4, 'Fuel', 'Petrol'),
(61, 5, 'Fuel', 'Petrol'),
(62, 6, 'Fuel', 'Petrol'),
(63, 7, 'Fuel', 'Petrol'),
(64, 8, 'Fuel', 'Petrol'),
(65, 9, 'Fuel', 'Petrol'),
(66, 10, 'Fuel', 'Petrol'),
(67, 11, 'Fuel', 'Petrol'),
(68, 12, 'Fuel', 'Petrol'),
(69, 13, 'Fuel', 'Petrol'),
(70, 14, 'Fuel', 'Petrol'),
(71, 15, 'Fuel', 'Petrol'),
(72, 16, 'Fuel', 'Petrol'),
(73, 17, 'Fuel', 'Petrol'),
(74, 18, 'Fuel', 'Petrol'),
(75, 19, 'Fuel', 'Petrol'),
(76, 20, 'Fuel', 'Petrol'),
(77, 21, 'Fuel', 'Petrol');

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
(1, 'Motorcycle'),
(2, 'Car'),
(3, 'RV');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
