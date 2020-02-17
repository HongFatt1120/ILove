-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2016 at 04:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `m2_145291r`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminusername` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminusername`, `AdminPassword`) VALUES
(1, 'rickyadmin', 'rickyadmin');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `billID` int(11) NOT NULL AUTO_INCREMENT,
  `cusID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `creditCardNum` int(30) NOT NULL,
  `cardExpireDate` date NOT NULL,
  PRIMARY KEY (`billID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`billID`, `cusID`, `fullName`, `phoneNo`, `address`, `creditCardNum`, `cardExpireDate`) VALUES
(90, 19, 'siew hongfatt', '91618194', 'YISHUN', 2147483647, '2016-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cartID` int(11) NOT NULL AUTO_INCREMENT,
  `cusID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `QOH` int(11) NOT NULL,
  `discount` double NOT NULL,
  PRIMARY KEY (`cartID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `catergoryName` varchar(255) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `catergoryName`) VALUES
(1, 'Mobile Devices'),
(2, 'Laptop'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cusID` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `password` varchar(255) NOT NULL,
  `securityQn` varchar(255) NOT NULL,
  `securityAns` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `dateRegister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusID`, `fullName`, `username`, `gender`, `password`, `securityQn`, `securityAns`, `email`, `profilePicture`, `dateRegister`) VALUES
(19, 'rickysiew', 'rickysiew', 'M', '11201120', 'when is your Birthday', '1120', 'hongfatt_1120@hotmail.com', 'rickysiew_me.jpeg', '2016-02-17 15:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `cusID` int(11) NOT NULL,
  `invoiceDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`invoiceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) NOT NULL,
  `QOH` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `color` varchar(255) NOT NULL,
  `categoryID` int(11) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productname`, `QOH`, `image`, `price`, `color`, `categoryID`) VALUES
(1, 'iphone 6', 10, 'product\\iphone6.png', 700, 'gold', 1),
(2, 'Iphone 6S', 8, 'product\\iphone6S.jpg', 700, 'Rose Gold', 1),
(3, 'Ipad Mini', 10, 'product\\ipadmini4.jpg', 1000, 'sliver', 1),
(4, 'macbook pro', 10, 'product\\Macbook.jpg', 1000, 'sliver', 2),
(5, 'Macbook Air', 10, 'product\\macbookAir.jpg', 1000, 'sliver', 2),
(6, 'Macbook Light', 10, 'product\\macbkLight.jpg', 1000, 'Gold', 2),
(7, 'iphone Cable', 10, 'product\\iphoneCable.jpg', 10, 'white', 3),
(8, 'Screen Protector', 10, 'product\\screenpotector.jpg', 10, 'transparent', 3),
(9, 'Macbook Pouch', 10, 'product\\macbookPouch.jpg', 20, 'red', 3);

-- --------------------------------------------------------

--
-- Table structure for table `purchasehistory`
--

CREATE TABLE IF NOT EXISTS `purchasehistory` (
  `purchaseID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `QOH` int(11) NOT NULL,
  PRIMARY KEY (`purchaseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `shipID` int(11) NOT NULL AUTO_INCREMENT,
  `cusID` int(11) NOT NULL,
  `recevierName` varchar(255) NOT NULL,
  `recevierAddress` varchar(255) NOT NULL,
  `shippingOption` varchar(255) NOT NULL,
  PRIMARY KEY (`shipID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
