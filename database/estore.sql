-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 06:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`, `user_type`) VALUES
(11, 'Nimal Susantha', 'nimal@mail.com', '$2y$10$ZN2lOFSKfuH0Vy8vr.qYYeYmTIku7IZtdcFDcDfwBArKYEnOkpMeu', '0', 1),
(12, 'kamal Ranasinghe', 'kamal@mail.com', '$2y$10$5/0.3f11nmIv9EmWtNg1le1zVMCtxzQUezcF.nZFwyf3whGVFVYuq', '0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(6, 'Coir');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(13, 'Wall Hanging Pots'),
(14, 'Standing Pots'),
(15, 'Pole');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `p_status` varchar(20) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `p_status`, `order_date`) VALUES
(25, 5, 8, 1, 'Completed', '2023-07-16'),
(26, 5, 7, 1, 'Inprogress', '2023-07-16'),
(27, 5, 6, 1, 'Inprogress', '2023-07-16'),
(28, 5, 6, 1, 'Inprogress', '2023-07-17'),
(29, 5, 6, 3, 'Inprogress', '2023-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_discount` float NOT NULL DEFAULT 0,
  `product_qty` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_discount`, `product_qty`, `product_desc`, `product_image`, `product_keywords`) VALUES
(6, 13, 6, 'Wall Hanging Pot', 1690, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1688985200_Wall Hanging Pot 1.jpg', 'coir,pot'),
(7, 13, 6, 'Wall Hanging Semi Cone Pot', 1550, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1688993768_Semi Cone Pot 1.jpg', 'coir,pot'),
(8, 13, 6, 'Wall Hanging Bread Shape Pot', 1890, 0, 10, 'Pre-formed rubberized coir basket liners are supplied in various colors, shapes & sizes. This can be for \r\nhanging baskets, wall mounted baskets or standalone baskets. We offer a liner with water retention \r\nfeature as well. Product can be customized with branding ready for supermarket.', '1688994145_Bread Shape Pot 1.jpg', 'coir, pot, bread'),
(11, 13, 6, 'Wall Hanging Hat Shaped Pot', 1399, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689155621_Hat Shaped Pot 1.jpg', 'hat, pot, wall hanging'),
(12, 13, 6, 'Half Round Hanging Wall Pot', 1490, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689155753_Half Round Pot 1.jpg', 'half round, wall hanging, pot'),
(13, 13, 6, 'Cone Shape Hanging Wall Pot', 1290, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689155914_Cone Shaped Pot 1.jpg', 'wall hanging pot, cone'),
(14, 14, 6, 'Standing Pot', 1690, 0, 10, 'Pre-formed rubberized coir basket liners are supplied in various colors, shapes & sizes. This can be for \r\nhanging baskets, wall mounted baskets or standalone baskets. We offer a liner with water retention \r\nfeature as well. Product can be customized with branding ready for supermarket', '1689156095_Standing Pot 1.jpg', 'standing, pot'),
(15, 14, 6, 'Standing Three Pot', 3490, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689156453_Standing Three Pot 1.jpg', 'standing, three, pot'),
(16, 13, 6, 'Wall Hanging Three Pot', 3290, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689156550_Wall Hanging Three Pot 1.jpg', 'wall hanging, three, pot'),
(17, 13, 6, 'Wall Hanging Five Pot', 4990, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689156630_Wall Hanging Five Pot 1.jpg', 'wall hanging, five, pot'),
(18, 14, 6, 'Standing Por Half Pot', 990, 0, 10, 'Coir pots are made of biodegradable coconut fibers molded with an organic rubber lining. These \r\ncoir pots will maintain their original shape for nearly 6-months while plants continue to grow in \r\nthem, after which the plant with the pot can both be transferred to the ground, and the pot will \r\ndecompose with time. \r\nCoir pots come in various sizes and a comfortable range of designs to suit any garden space. Coir \r\npots are an ideal eco friendly solution because they do not obstruct irrigation and rainfall and \r\nthey also do not prevent soil ventilation.', '1689156761_Standing Half Por Pot 1.jpg', 'standing, half por'),
(19, 15, 6, 'Coir Pole', 1190, 0, 10, 'Creeper guides are made out of preformed rubberized coir sheets wrapped around a PVC tube. The \r\ncreeper roots grow through the porous structure & ensure extensive grip thus enabling faster growth. An \r\nextendable version of creeper guide is offered for high grown creepers. The creeper guides can be \r\ninterlinked & made a fence which can be used as a live fence', '1689156864_Coir Pole 1.jpg', 'coir, pole'),
(20, 14, 6, 'Coir Seed Pot', 490, 0, 10, '100% biodegradable product as made out of natural latex & coir. Ideal for nursery plant establishment as \r\nyou can plant with the pot itself. The porous structure of the pot wall facilitate the easy root penetration \r\nwhile providing adequate aeration for root growth. Depending on the plant life we can customize the \r\npots to suit your requirements. For ornamental purpose a range of colored pots with natural dyes is on \r\nthe offer. A special range is offered where the pots can be handled with pot filling machines for \r\ncommercial scale growers', '1689156956_Coir Seed Pot 1.jpg', 'seed, pot');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(5, 'Charith', 'Wimantha', 'user@mail.com', 'a421e6b1f4ef36ee345db8db566d6b02', '0784514254', 'Flower Rd, Colombo 03', 'Sri Lanka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_cat` (`product_cat`),
  ADD KEY `fk_product_brand` (`product_brand`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `fk_product_cat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
