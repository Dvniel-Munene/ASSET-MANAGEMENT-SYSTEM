-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2024 at 08:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Audio Equipment'),
(2, 'Network Equipment'),
(3, 'Visual Equipment');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `eq_code` varchar(50) NOT NULL,
  `eq_name` varchar(100) NOT NULL,
  `eq_brand` varchar(100) NOT NULL,
  `eq_model` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `purchase_location` varchar(255) NOT NULL,
  `receipt_no` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `accessories` varchar(250) NOT NULL,
  `eq_status` enum('Operational','Faulty','Failed','Unknown','Under Repair','Retired') NOT NULL DEFAULT 'Operational',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `eq_cat` enum('Audio Equipment','Visual Equipment','Network Equipment') NOT NULL DEFAULT 'Audio Equipment',
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `eq_code`, `eq_name`, `eq_brand`, `eq_model`, `serial_no`, `cost`, `purchase_location`, `receipt_no`, `quantity`, `accessories`, `eq_status`, `created`, `eq_cat`, `file`) VALUES
(1, 'AUD001', '12-Channel Mixer', 'OMAX', 'PMX1208DU', '-', 0.00, '-', '-', 1, 'Power Cable', 'Operational', '2024-10-15 16:27:06', 'Audio Equipment', 'mixer.png'),
(2, 'AUD002', 'Speaker [RHS]', 'PEAVEY', 'PR 15 FG 00583910', 'E0440724', 0.00, '-', '-', 1, '25m-30m TS Jack Pin Cable [Black]', 'Operational', '2024-10-15 16:27:06', 'Audio Equipment', 'speaker.png'),
(3, 'AUD002(b)', 'Speaker [LHS]', 'PEAVEY', 'PR 15 FG 00583910', 'E0440724', 0.00, '-', '-', 1, '20m-25m TS Jack Pin Cable [Black]', 'Faulty', '2024-10-15 17:15:35', 'Audio Equipment', 'speaker.png'),
(4, 'AUD003', 'Wireless Mic Receiver', 'BNK', 'BK8400', '-', 0.00, '-', '-', 1, '1) Power Cable [Black],                      2) AUD005(d) [Black]\r\n3) AUD003 (b) & AUD003 (c)', 'Operational', '2024-10-15 17:15:35', 'Audio Equipment', 'wlmr.png'),
(5, 'AUD003(b)', 'Wireless Microphone', 'BNK', 'BK8400', '-', 0.00, '-', '-', 3, 'None', 'Operational', '2024-10-15 17:36:49', 'Audio Equipment', 'wlm.png'),
(6, 'AUD003(c)', 'Wireless Microphone', 'BNK', 'BK8400', '-', 0.00, '-', '-', 1, 'None', 'Faulty', '2024-10-15 17:36:49', 'Audio Equipment', 'wlm.png'),
(7, 'NET001', 'Router', 'TP-Link', 'TL-WR840N', '22372S8000701', 0.00, '-', '-', 1, 'Power Cable', 'Operational', '2024-10-15 20:45:42', 'Network Equipment', 'router.png'),
(8, 'NET002', 'WI-FI Adapter', 'TP-Link', 'TL-WN725N (EU) Ver: 3.0', '223C4W5033698', 1100.00, 'Ken Computers', 'Cash Sale # 9874', 1, 'None', 'Operational', '2024-10-15 20:45:42', 'Network Equipment', 'WIFI ADAPTER.png'),
(9, 'VIS001', 'Splitter', '-', '1X4 Mini Splitter', '-', 0.00, 'Ken Computers', '-', 1, 'Power Adapter/Cable', 'Faulty', '2024-10-15 21:43:11', 'Visual Equipment', '4X Splitter.png'),
(10, 'VIS002', 'Splitter', '-', '1X2 Mini Splitter', '-', 0.00, 'Ken Computers', '-', 1, 'Power Adapter/Cable', 'Operational', '2024-10-15 21:43:11', 'Visual Equipment', '2X Splitter.png'),
(11, 'VIS003', 'Laptop', 'Lenovo', 'Lenovo 13', '', 30000.00, 'Ken Computers', '383', 1, 'Power Adapter/Cable', 'Operational', '2024-10-15 22:01:15', 'Visual Equipment', 'laptop.png'),
(12, 'VIS004', 'Mouse', 'Noyokere', 'Ultra Thin Wireless Mouse', '-', 500.00, 'Ken Computers', '1142', 1, 'Wireless Mouse USB Adapter', 'Operational', '2024-10-15 22:01:15', 'Visual Equipment', 'mouse.png'),
(13, 'AUD004', 'Speaker [Monitor]', 'Wharfedale', 'Pro EVP-X15', '-', 0.00, '-', '-', 1, '-', 'Faulty', '2024-10-18 10:27:53', 'Audio Equipment', 'wharfedale.png'),
(15, 'AUD005', 'Microphone Cables', 'Generic', 'XLR', '-', 0.00, '-', '-', 2, 'None', 'Operational', '2024-10-19 19:49:07', 'Audio Equipment', 'xlr.png'),
(16, 'AUD005(b)', 'Microphone Cable ', 'Generic [All Black]', 'XLR', '-', 0.00, '-', '-', 1, 'None', 'Operational', '2024-10-19 19:55:54', 'Audio Equipment', 'bxlr.png'),
(17, 'AUD005(c)', 'Microphone Cables', 'Generic [Black & Purple]', 'XLR', '-', 0.00, '-', '-', 2, 'None', 'Failed', '2024-10-19 20:07:23', 'Audio Equipment', 'bxlr.png'),
(18, 'AUD005(d)', 'Microphone Cable', 'BNK', 'BK8400 [Black]', '-', 0.00, '-', '-', 1, 'AUD003', 'Faulty', '2024-10-19 20:12:03', 'Audio Equipment', 'jp2jp.png'),
(19, 'AUD005(e)', 'Microphone Cable', 'Generic', 'Pin to XLR', '-', 0.00, '-', '-', 1, 'None', 'Operational', '2024-10-19 20:20:04', 'Audio Equipment', 'pxlr.png');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` int(11) NOT NULL,
  `asset_code` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `reported_by` varchar(150) NOT NULL,
  `fault_description` varchar(255) NOT NULL,
  `repair_action` varchar(255) NOT NULL,
  `technician_name` varchar(100) NOT NULL,
  `technician_contact` varchar(15) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `status` enum('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
  `date` date NOT NULL,
  `completion_date` date NOT NULL,
  `asset_cat` enum('Audio Equipment','Visual Equipment','Network Equipment') NOT NULL DEFAULT 'Audio Equipment',
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `asset_code`, `qty`, `reported_by`, `fault_description`, `repair_action`, `technician_name`, `technician_contact`, `cost`, `status`, `date`, `completion_date`, `asset_cat`, `file`) VALUES
(1, 'AUD004', 1, 'TEST', 'Faulty Twitter', 'Replacement of Faulty Twitter', 'Silus', '+254712345678', 6000.00, 'Pending', '2024-10-22', '2024-10-22', 'Audio Equipment', 'wharfedale.png');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`) VALUES
(1, 1, 2, 1000.00, '2021-04-04'),
(2, 3, 3, 15.00, '2021-04-04'),
(3, 10, 6, 1932.00, '2021-04-04'),
(7, 7, 5, 35.00, '2021-04-04'),
(8, 9, 2, 110.00, '2021-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Dvniel', 'admin', 'd6444af34a30aa6a027885f4b55edd65805de19d', 1, 'no_image.png', 1, '2024-10-19 19:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
