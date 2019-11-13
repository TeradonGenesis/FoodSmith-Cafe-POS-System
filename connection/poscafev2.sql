-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 09:07 AM
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

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`category_id`, `category_name`) VALUES
(1, 'Test Noodle'),
(2, 'VIP Table'),
(3, '5');

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

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`food_id`, `food_text`, `food_code`, `food_picture`, `food_name`, `food_price`, `category`, `status`, `created_on`) VALUES
(102, NULL, NULL, '5da7d57cba6d31.58167466.jpg', 'Test', '5.00', 1, 1, '2019-10-17 02:44:12'),
(105, NULL, NULL, '5da913b38a8285.93885798.jpg', 'Water', '4.50', 1, 1, '2019-10-18 01:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_id`
--

CREATE TABLE `order_id` (
  `order_id` bigint(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_id`
--

INSERT INTO `order_id` (`order_id`) VALUES
(4112019203649),
(7112019110040),
(13112019024711),
(13112019024744),
(13112019154638),
(13112019154941),
(13112019154953),
(13112019155101),
(13112019160501),
(21102019095509),
(21102019095537),
(21102019095706),
(21102019095734),
(21102019095801),
(21102019100057),
(21102019100308),
(21102019100335),
(21102019100451),
(21102019100559),
(21102019100743),
(21102019100801),
(21102019100814),
(21102019100824),
(21102019100834),
(21102019100842),
(22102019122101),
(22102019122759),
(24102019114025),
(24102019114054),
(24102019114111);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` bigint(14) NOT NULL,
  `ordered_food` int(11) NOT NULL,
  `ordered_table` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_price` decimal(6,2) DEFAULT NULL,
  `order_status` int(11) DEFAULT 1,
  `ordered_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `ordered_food`, `ordered_table`, `quantity`, `order_price`, `order_status`, `ordered_on`) VALUES
(4112019203649, 102, 1, 3, '28.50', 0, '2019-11-04 12:37:00'),
(4112019203649, 105, 1, 3, '28.50', 0, '2019-11-04 12:37:00'),
(7112019110040, 102, 4, 3, '15.00', 0, '2019-11-07 03:01:11'),
(13112019024744, 105, 4, 16, '4.50', 1, '2019-11-12 18:47:54'),
(13112019160501, 105, 23, 1, '4.50', 0, '2019-11-13 08:05:06'),
(24102019114054, 102, 2, 1, '9.50', 0, '2019-10-24 03:40:59'),
(24102019114054, 105, 2, 1, '9.50', 0, '2019-10-24 03:40:59'),
(24102019114111, 102, 2, 4, '38.00', 0, '2019-10-24 03:41:19'),
(24102019114111, 105, 2, 4, '38.00', 0, '2019-10-24 03:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reserve_id` int(11) NOT NULL,
  `reserve_name` varchar(50) NOT NULL,
  `reserve_mobile` varchar(15) NOT NULL,
  `reserve_date` date NOT NULL,
  `reserve_customers` varchar(15) NOT NULL,
  `reserve_table` int(11) NOT NULL,
  `reserve_dateReceived` datetime DEFAULT current_timestamp(),
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reserve_id`, `reserve_name`, `reserve_mobile`, `reserve_date`, `reserve_customers`, `reserve_table`, `reserve_dateReceived`, `status`) VALUES
(9, 'Eddie', '019-88757858', '2019-11-13', '6', 6, '2019-11-12 22:17:01', 2),
(10, 'Eddie', '019-88757858', '2019-11-21', '10', 23, '2019-11-13 03:18:10', 2),
(12, 'Eddie', '019-88757858', '2019-11-21', '10', 23, '2019-11-13 03:22:45', 2);

-- --------------------------------------------------------

--
-- Table structure for table `table_listing`
--

CREATE TABLE `table_listing` (
  `table_id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `table_category` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order_id` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_listing`
--

INSERT INTO `table_listing` (`table_id`, `table_no`, `table_category`, `status`, `order_id`) VALUES
(1, 1, 6, 0, 0),
(2, 2, 6, 0, 0),
(3, 23, 12, 0, 0),
(4, 4, 4, 1, 0),
(5, 6, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_listing`
--

CREATE TABLE `transaction_listing` (
  `trans_id` int(11) NOT NULL,
  `total_price` decimal(6,2) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_listing`
--

INSERT INTO `transaction_listing` (`trans_id`, `total_price`, `created_on`) VALUES
(1, '28.00', '2019-11-04 12:37:37'),
(2, '47.00', '2019-11-07 03:00:32'),
(3, '15.00', '2019-11-07 03:01:30'),
(4, '4.00', '2019-11-13 08:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'teradon', 'eddie@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

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
-- Indexes for table `order_id`
--
ALTER TABLE `order_id`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`,`ordered_food`) USING BTREE,
  ADD KEY `order_list_ibfk_2` (`ordered_table`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `ordered_food` (`ordered_food`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `table_listing`
--
ALTER TABLE `table_listing`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `transaction_listing`
--
ALTER TABLE `transaction_listing`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `food_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `table_listing`
--
ALTER TABLE `table_listing`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_listing`
--
ALTER TABLE `transaction_listing`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`category`) REFERENCES `food_category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
