-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2017 at 05:35 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts` ()  BEGIN
   SELECT *  FROM shopowner;
   END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `d_id` int(5) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `after_price` float NOT NULL,
  `p_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`d_id`, `date_from`, `date_to`, `after_price`, `p_id`) VALUES
(1, '2017-05-07 00:00:00', '2017-05-07 00:00:00', 10.01, ''),
(2, '2017-05-07 00:00:00', '2017-05-07 00:00:00', 11.01, ''),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, ''),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10.01, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(5) UNSIGNED NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_description` varchar(300) NOT NULL,
  `p_category` varchar(30) NOT NULL,
  `p_image_id` varchar(500) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_stock` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `d_id` int(11) NOT NULL,
  `shop_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_description`, `p_category`, `p_image_id`, `p_price`, `p_stock`, `date_created`, `d_id`, `shop_id`) VALUES
(2, '123', '123', '123', '123', 123, 123, '2017-05-04', 1, '123');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(30) NOT NULL,
  `shop_icon` varchar(500) NOT NULL,
  `shopowner_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopowner`
--

CREATE TABLE `shopowner` (
  `e_mail` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`e_mail`, `password`, `phone`, `address`, `id`) VALUES
('tayyab@email.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '1234', 1),
('test123@gmail.com', '202cb962ac59075b964b07152d234b70', '12345', '11', 2),
('harkamal12@email.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '1234', 3),
('test@email.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '1234', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `shopowner`
--
ALTER TABLE `shopowner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `d_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shopowner`
--
ALTER TABLE `shopowner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
