-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 10:52 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(9, 'Benjamin Walters', 'jisuzoponu', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(12, 'Cameron Meadows', 'wemytepad', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(15, 'administrator', 'admin', '0cc175b9c0f1b6a831c399e269772661'),
(16, 'Lunea Blackburn', 'nyriropeca', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(18, 'Tejas Balshetwar', 'tejas', '6041d0363da08612bcb0f536e00dba50'),
(19, 'william', 'will', '18218139eec55d83cf82679934e5cd75');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(17, 'Burger', 'Food_Category_828.jpg', 'Yes', 'Yes'),
(18, 'Pizza', 'Food_Category_203.jpg', 'Yes', 'Yes'),
(19, 'Beverage', 'Food_Category_365.jfif', 'Yes', 'Yes'),
(22, 'Sandwich', 'Food_Category_7756.jfif', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(19, 'Sprite', 'This is Sprite', '55.00', 'Food_Name_266.jpg', 19, 'Yes', 'Yes'),
(21, 'Mountain Dew', 'This is Mountain Dew', '55.00', 'Food_Name_813.jpg', 19, 'Yes', 'Yes'),
(22, 'Cheese Burger', 'This is a  cheese burger.', '100.00', 'Food_Name_659.jpg', 17, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(14, 'Mountain', '55.00', 9, '495.00', '2021-10-11 04:45:40', 'Delivered', 'Brielle Baird', '+1 (432) 728-7054', 'cyxucejo@mailinator.com', 'Sed corporis qui tot'),
(15, 'Cheese', '100.00', 1, '100.00', '2021-10-11 05:01:05', 'Cancelled', 'Amaya Mccray', '+1 (289) 226-7559', 'qucuco@mailinator.com', 'Voluptatem Ducimus'),
(16, 'Sprite', '55.00', 2, '110.00', '2021-10-11 05:09:39', 'Delivered', 'Cade Banks', '+1 (925) 785-9391', 'sadamuxyd@mailinator.com', 'Aut debitis harum id'),
(17, 'Mountain', '55.00', 1, '55.00', '2021-10-11 10:56:45', 'On Delivery', 'Patrick Britt', '+1 (968) 684-8654', 'himebi@mailinator.com', 'Non proident non qu'),
(18, 'Sprite', '55.00', 478, '26290.00', '2021-10-18 09:12:12', 'Cancelled', 'Kim Justice', '+1 (543) 836-3955', 'milidu@mailinator.com', 'Quibusdam aut volupt'),
(19, 'Sprite', '55.00', 750, '41250.00', '2021-10-18 10:40:25', 'Ordered', 'Arsenio Blackwell', '+1 (814) 673-2447', 'hygih@mailinator.com', 'Officia culpa offici');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
