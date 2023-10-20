-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2023 at 06:08 AM
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
CREATE DATABASE IF NOT EXISTS `vegemarket` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vegemarket`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cartID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cartID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `userID`) VALUES
('C202310206531ebac7d41e', 'U202310206531ebac7c7c0'),
('C202310206531f0b39abc0', 'U202310206531f0b39a3ef');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `cartID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cartID`,`productID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`cartID`, `productID`) VALUES
('C202310206531f0b39abc0', 'P202310206531e77e0f3ee'),
('C202310206531f0b39abc0', 'P20231020653210d572cda'),
('C202310206531ebac7d41e', 'P202310206532113e20793');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `orderDate` date NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paymentMethod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `address`, `paymentMethod`, `userID`) VALUES
('O202310206531eed63ba2e', '2023-10-20', 'Taman Teknologi 3, Kuala Lumpur, Malaysia', 'QR', 'U202310206531ebac7c7c0'),
('O202310206531f391839b2', '2023-10-20', 'Taman Teknologi 5, KL', 'Cash On Delivery', 'U202310206531f0b39a3ef'),
('O202310206531f3ba6e263', '2023-10-20', 'tets', 'Cash On Delivery', 'U202310206531f0b39a3ef'),
('O202310206531f48bda233', '2023-10-20', 'tets', 'Cash On Delivery', 'U202310206531f0b39a3ef'),
('O2023102065320ef015976', '2023-10-20', '71 Bukit Bintang, KL', 'Card', 'U202310206531f0b39a3ef'),
('O20231020653212d36ee86', '2023-10-20', 'Jln 3 Langkawi', 'QR', 'U202310206531ebac7c7c0');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
CREATE TABLE IF NOT EXISTS `orders_products` (
  `orderID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agreedPrice` float NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`orderID`,`productID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`orderID`, `productID`, `agreedPrice`, `remark`, `status`) VALUES
('O202310206531eed63ba2e', 'P202310206531e77e0f3ee', 120, '10kg', 'paid'),
('O202310206531eed63ba2e', 'P202310206531e81aeab05', 30, '5kg', 'delivered'),
('O202310206531f48bda233', 'P202310206531e77e0f3ee', 12, '11', 'delivered'),
('O202310206531f48bda233', 'P202310206531e81aeab05', 22, '11', 'shipped'),
('O2023102065320ef015976', 'P202310206531e77e0f3ee', 310, '30KG', 'shipped'),
('O20231020653212d36ee86', 'P202310206531e77e0f3ee', 30, '1kg', 'paid'),
('O20231020653212d36ee86', 'P202310206532105881b45', 30, '', 'delivered'),
('O20231020653212d36ee86', 'P20231020653210d572cda', 21, '1.1G, Please call before arrive', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `priceLabel` float(255,2) NOT NULL,
  `availabilityStatus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `addDate` date NOT NULL,
  `unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imgPath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `priceLabel`, `availabilityStatus`, `description`, `location`, `addDate`, `unit`, `category`, `imgPath`, `userID`) VALUES
('P202310206531e77e0f3ee', 'chilis', 31.00, 'available', 'chili spicy spicy', 'Selangor', '2023-10-20', 'KG', 'spice', 'U202310206531e33e8b28b/chili.jpg', 'U202310206531e33e8b28b'),
('P202310206531e7a28e2ea', 'corn', 20.00, 'out of stock', 'yellow corn', 'Sekinchan', '2023-10-20', 'G', 'Poaceae', 'U202310206531e33e8b28b/corn.jpg', 'U202310206531e33e8b28b'),
('P202310206531e7d60d298', 'Rheum rhabarbar', 12.00, 'deleted', 'Green', 'Peris', '2023-10-20', 'oz', 'Marrow', 'U202310206531e33e8b28b/rheum.jpg', 'U202310206531e33e8b28b'),
('P202310206531e81aeab05', 'Rheum', 13.00, 'banned', 'Rheum green', 'Selangor', '2023-10-20', 'oz', 'shoot', 'U202310206531e33e8b28b/rheum.jpg', 'U202310206531e33e8b28b'),
('P202310206531e9ff750bb', 'Potato', 13.00, 'banned', 'potato ooo', 'Johor', '2023-10-20', 'G', 'Root', 'U202310206531e8b5ab143/potato.png', 'U202310206531e8b5ab143'),
('P202310206531ea1c9bf49', 'potato 2', 13.00, 'deleted', 'etst', 'Selangor', '2023-10-20', 'oz', 'Root', 'U202310206531e8b5ab143/potato.png', 'U202310206531e8b5ab143'),
('P202310206532105881b45', 'Onions', 30.00, 'available', 'Onions belong to the Allium family of plants, which also includes chives, garlic, and leeks. ', 'Kedah', '2023-10-20', 'KG', 'allium', 'U2023102065320fdfd1abc/onion.jpg', 'U2023102065320fdfd1abc'),
('P20231020653210d572cda', 'Mushroom', 20.00, 'available', 'A mushroom or toadstool is the fleshy, spore-bearing fruiting body of a fungus', 'Perak', '2023-10-20', 'G', 'fungus', 'U2023102065320fdfd1abc/mushroom.jpg', 'U2023102065320fdfd1abc'),
('P202310206532113e20793', 'cabbage', 20.00, 'available', 'Cabbage, comprising several cultivars of Brassica oleracea, is a leafy green', 'Melaka', '2023-10-20', 'KG', 'leafy', 'U2023102065320fdfd1abc/cabbage.jpg', 'U2023102065320fdfd1abc'),
('P20231020653211d4d7b8e', 'Lettuce', 19.00, 'available', 'Lettuce is an annual plant of the family Asteraceae. It is most often grown as a leaf vegetable. ', 'Pahang', '2023-10-20', 'KG', 'miscellaneous', 'U2023102065320fdfd1abc/lettuce.jpg', 'U2023102065320fdfd1abc'),
('P20231020653215e2a841e', 'Carrot', 10.00, 'available', 'carrot', 'Negeri Sembilan', '2023-10-20', 'KG', 'Root', 'U202310206531e33e8b28b/carrot.jpg', 'U202310206531e33e8b28b');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `accStatus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'active',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `gender`, `email`, `phone`, `birthday`, `password`, `role`, `accStatus`) VALUES
('U20091017652dfe100f850', 'admin_acc', 'Male', 'admin123@vegemarket.com', '60181111344', '2001-01-30', 'f77b3d72b467798a2640d147c3ab6df5', 'admin', 'active'),
('U202310206531e33e8b28b', 'Green Farm', 'Male', 'greenfarm@example.com', '601222324243', '2003-02-12', '54ebede2b3d4c163b76d4ac4eff5d47a', 'supplier', 'active'),
('U202310206531e8b5ab143', 'fresh_Green', 'Female', 'fresh_green@example.com', '110099776655', '2013-12-03', 'e581dde8ae9fab4fb7b32a67eb4e891b', 'supplier', 'banned'),
('U202310206531ebac7c7c0', 'Miss Health', 'Female', 'health@example.com', '123456781111', '2001-02-07', 'efba6c42878a2267074a07eb2ac69426', 'consumer', 'active'),
('U202310206531f0b39a3ef', 'Mr. health', 'Male', 'mrhealth@example.com', '90886632711', '2013-10-02', '8eaa1d7ed780f72c88d39f0f55965fb1', 'consumer', 'active'),
('U2023102065320fdfd1abc', 'supplier_yes', 'Male', 'supplier_yes@example.com', '61101010001', '2013-12-11', 'e2eb2a39aa1c0232653393f7d1326477', 'supplier', 'active');

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
