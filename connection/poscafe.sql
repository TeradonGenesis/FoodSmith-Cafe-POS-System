-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 07:16 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poscafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `food_id` int(16) NOT NULL,
  `food_text` varchar(2) DEFAULT NULL,
  `food_code` varchar(2) DEFAULT NULL,
  `food_picture` varchar(255) DEFAULT NULL,
  `food_name` varchar(30) DEFAULT NULL,
  `food_price` decimal(6,2) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int(11) NOT NULL,
  `ordered_food` int(11) NOT NULL,
  `ordered_table` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_price` decimal(6,2) DEFAULT NULL,
  `order_status` int(11) DEFAULT 1,
  `ordered_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_listing`
--

CREATE TABLE `table_listing` (
  `table_id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `table_category` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_listing`
--

CREATE TABLE `transaction_listing` (
  `trans_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `total_price` decimal(6,2) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `ordered_food` (`ordered_food`),
  ADD KEY `ordered_table` (`ordered_table`);

--
-- Indexes for table `table_listing`
--
ALTER TABLE `table_listing`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `transaction_listing`
--
ALTER TABLE `transaction_listing`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `food_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_listing`
--
ALTER TABLE `table_listing`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_listing`
--
ALTER TABLE `transaction_listing`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`category`) REFERENCES `food_category` (`category_id`);

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`ordered_food`) REFERENCES `menu` (`food_id`),
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`ordered_table`) REFERENCES `table_listing` (`table_id`);

--
-- Constraints for table `transaction_listing`
--
ALTER TABLE `transaction_listing`
  ADD CONSTRAINT `transaction_listing_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
