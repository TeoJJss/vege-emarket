-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 14, 2023 at 09:22 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vegemarket`
--
DROP DATABASE IF EXISTS `vegemarket`;
CREATE DATABASE vegemarket;
USE vegemarket;
-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cartID` varchar(100) NOT NULL,
  `userID` varchar(100) NOT NULL,
  PRIMARY KEY (`cartID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `userID`) VALUES
('C01', 'U01'),
('C02', 'U04');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `cartID` varchar(100) NOT NULL,
  `productID` varchar(100) NOT NULL,
  PRIMARY KEY (`cartID`,`productID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`cartID`, `productID`) VALUES
('C01', 'P04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` varchar(100) NOT NULL,
  `orderDate` date NOT NULL,
  `address` varchar(1000) NOT NULL,
  `orderStatus` varchar(100) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `userID` varchar(100) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `address`, `orderStatus`, `paymentMethod`, `userID`) VALUES
('O01', '2022-02-23', '12, Address 11, KL', 'paid', 'credit card', 'U01'),
('O02', '2022-02-23', '12, Address 11, KL', 'shipped', 'credit card', 'U01');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
CREATE TABLE IF NOT EXISTS `orders_products` (
  `orderID` varchar(100) NOT NULL,
  `productID` varchar(100) NOT NULL,
  `agreedPrice` float NOT NULL,
  `remark` varchar(1000) NOT NULL,
  `confirmStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`orderID`,`productID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`orderID`, `productID`, `agreedPrice`, `remark`, `confirmStatus`) VALUES
('O01', 'P01', 80, '10kg', 0),
('O01', 'P02', 40, '900g', 1),
('O02', 'P01', 60, '5kg', 0),
('O02', 'P03', 100, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productID` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `priceLabel` float(255,2) NOT NULL,
  `availabilityStatus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(1000) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `addDate` date NOT NULL,
  `unit` varchar(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `imgPath` varchar(1000) NOT NULL,
  `userID` varchar(100) NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `priceLabel`, `availabilityStatus`, `description`, `location`, `addDate`, `unit`, `category`, `imgPath`, `userID`) VALUES
('P01', 'Corns', 10.10, 'available', 'Minimum purchase 5kg. Contact us for details', 'Selangor, Malaysia', '2022-02-22', 'kg', 'Poaceae', 'U02/corn.jpg', 'U02'),
('P02', 'Potato', 20.00, 'banned', 'potato desc', 'Kedah Malaysia', '2023-03-03', 'g', 'root', '', 'U02'),
('P03', 'Carrot', 55.00, 'deleted', 'Carrots are a popular and widely consumed root vegetable known for their distinctive orange color and sweet, earthy flavor. ', 'Johor, Malaysia', '2023-03-04', 'kg', 'root', 'U05/carrot.jpg', 'U05'),
('P04', 'pumpkin', 20.00, 'available', 'Minimum purchase 10kg, contact for info :)', 'Melaka, Malaysia', '2023-09-09', 'kg', 'marrow', 'U05/pumpkin-3f3d894.jpg', 'U05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `accStatus` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `gender`, `email`, `phone`, `birthday`, `password`, `role`, `accStatus`) VALUES
('U01', 'consumer1', 'male', 'consumer1@example.com', '60111111111', '2000-01-19', '11111111', 'consumer', 'active'),
('U02', 'supplier1', 'female', 'supplier_yes@example.com', '60111111113', '2001-01-19', '11111122', 'supplier', 'banned'),
('U03', 'administrator_root', 'male', 'admin123@vegemarket.com', '60181111322', '2001-01-30', '11111133', 'admin', 'active'),
('U04', 'consumer2', 'female', 'consumer4@example.com', '60123456789', '2003-06-06', '12121212', 'consumer', 'active'),
('U05', 'supplier2', 'male', 'supplier2@example.com', '6012343434', '2000-01-01', '098765433abc', 'supplier', 'active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `cart` (`cartID`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
