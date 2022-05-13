-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2022 at 08:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `parking_rate`
--

CREATE TABLE `parking_rate` (
  `id` int(11) NOT NULL,
  `rate_name` varchar(255) NOT NULL,
  `parking_category` int(11) NOT NULL,
  `rate_type` tinyint(2) NOT NULL,
  `rate_price` int(11) NOT NULL,
  `rate_status` tinyint(2) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_rate`
--

INSERT INTO `parking_rate` (`id`, `rate_name`, `parking_category`, `rate_type`, `rate_price`, `rate_status`, `create_at`) VALUES
(1, 'Bus Hourly', 1, 2, 50, 1, '2022-04-06 17:02:59'),
(2, 'Bus Fixed', 1, 1, 500, 1, '2022-04-06 17:03:58'),
(3, 'Motor Cycle Hourly', 2, 2, 20, 1, '2022-04-06 17:04:58'),
(4, 'Motor Cycle Fixed', 2, 1, 100, 1, '2022-04-06 17:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_mobile` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `company_facebook` varchar(255) DEFAULT NULL,
  `company_youtube` varchar(255) DEFAULT NULL,
  `company_message` text DEFAULT NULL,
  `company_currency` varchar(255) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `company_name`, `company_address`, `company_mobile`, `company_email`, `company_website`, `company_facebook`, `company_youtube`, `company_message`, `company_currency`, `company_logo`, `company_status`, `created_at`) VALUES
(1, 'Care Care Limited', 'House No: 15/2, Road No: 03, Mohakhali, Bangladesh', '01627197089', 'minulhasanrokan@gmail.com', 'carcare.com', 'carcare.com', 'carcare.com', 'Thanks For Using Car Care parking.', 'BDT', 'Md._Minul_Hasan_Rokan_679.png', 1, '2022-02-21 03:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parking`
--

CREATE TABLE `tbl_parking` (
  `id` int(11) NOT NULL,
  `parking_code` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_licence` varchar(255) NOT NULL,
  `vehicle_user_name` varchar(255) NOT NULL,
  `vehicle_user_mobile` varchar(255) NOT NULL,
  `vechile_cat_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `total_amount` varchar(225) NOT NULL,
  `paid_status` tinyint(2) NOT NULL DEFAULT 0,
  `parking_status` tinyint(2) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_parking`
--

INSERT INTO `tbl_parking` (`id`, `parking_code`, `vehicle_name`, `vehicle_licence`, `vehicle_user_name`, `vehicle_user_mobile`, `vechile_cat_id`, `rate_id`, `slot_id`, `in_time`, `out_time`, `total_time`, `total_amount`, `paid_status`, `parking_status`, `create_at`) VALUES
(1, 'PA-A5142A', 'Bus abc', 'BD-00095', 'Md. Minul Hasan', '01627197089', 1, 1, 2, '1649264847', '1649266908', '1', '50', 1, 1, '2022-04-06 17:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slots`
--

CREATE TABLE `tbl_slots` (
  `id` int(11) NOT NULL,
  `slot_name` varchar(255) NOT NULL,
  `slot_category` int(11) NOT NULL,
  `slot_status` tinyint(2) NOT NULL DEFAULT 1,
  `availability_status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_slots`
--

INSERT INTO `tbl_slots` (`id`, `slot_name`, `slot_category`, `slot_status`, `availability_status`, `created_at`) VALUES
(1, 'Bus 01', 1, 1, 2, '2022-04-06 16:59:26'),
(2, 'Bus 02', 1, 1, 1, '2022-04-06 17:00:45'),
(3, 'Bus 03', 1, 1, 1, '2022-04-06 17:01:05'),
(4, 'Motor Cycle 01', 2, 1, 1, '2022-04-06 17:01:32'),
(5, 'Motor Cycle 02', 2, 1, 1, '2022-04-06 17:01:46'),
(6, 'Motor Cycle 03', 2, 1, 1, '2022-04-06 17:01:58'),
(7, 'Micro 01', 3, 1, 1, '2022-04-06 17:02:15'),
(8, 'Micro 02', 2, 1, 1, '2022-04-06 17:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_v_token` varchar(255) NOT NULL,
  `user_v_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `image`, `gender`, `group_id`, `user_v_token`, `user_v_status`, `status`, `create_at`) VALUES
(1, 'rokan', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin', 'admin', 'admin', 'admin', 1, 17, '', 1, 1, '2022-02-11 06:11:34'),
(2, 'Jony', '202cb962ac59075b964b07152d234b70', 'abdul@gmail.com', 'Abdul', 'Kader', '123456789', 'Jonyf0418644a5.jpg', 1, 17, '', 1, 1, '2022-04-06 16:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `user_type` int(11) NOT NULL,
  `token` varchar(225) NOT NULL,
  `v_code` varchar(10) NOT NULL,
  `v_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`, `address`, `user_type`, `token`, `v_code`, `v_status`, `status`) VALUES
(22, 'minulhasanrokan@gmail.com', '01627197089', 'minulhasanrokan@gmail.com', '202cb962ac59075b964b07152d234b70', '', 0, '5c9f1c172de62fed60cf316c09cea508', '864756', 1, 1),
(24, 'mhrokan', 'minul', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', 0, '87b90835e2140fb4845b30350d7e75f9', '196625', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `permission`, `status`, `create_at`) VALUES
(16, 'fhgfhj ery t', 'a:11:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:11:\"createGroup\";i:3;s:11:\"updateGroup\";i:4;s:14:\"updateCategory\";i:5;s:11:\"updateRates\";i:6;s:11:\"updateSlots\";i:7;s:13:\"createParking\";i:8;s:13:\"updateParking\";i:9;s:13:\"updateCompany\";i:10;s:13:\"updateSetting\";}', 1, '2022-02-12 17:25:47'),
(17, 'Main', 'a:31:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:14:\"createCategory\";i:9;s:14:\"updateCategory\";i:10;s:12:\"viewCategory\";i:11;s:14:\"deleteCategory\";i:12;s:11:\"createRates\";i:13;s:11:\"updateRates\";i:14;s:9:\"viewRates\";i:15;s:11:\"deleteRates\";i:16;s:11:\"createSlots\";i:17;s:11:\"updateSlots\";i:18;s:9:\"viewSlots\";i:19;s:11:\"deleteSlots\";i:20;s:13:\"createParking\";i:21;s:13:\"updateParking\";i:22;s:11:\"viewParking\";i:23;s:13:\"deleteParking\";i:24;s:13:\"createReports\";i:25;s:13:\"updateReports\";i:26;s:11:\"viewReports\";i:27;s:13:\"deleteReports\";i:28;s:13:\"updateCompany\";i:29;s:13:\"updateSetting\";i:30;s:11:\"viewProfile\";}', 1, '2022-04-06 16:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `vechile_category`
--

CREATE TABLE `vechile_category` (
  `vechile_category_id` int(11) NOT NULL,
  `vechile_category_name` varchar(255) NOT NULL,
  `vechile_category_status` tinyint(2) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vechile_category`
--

INSERT INTO `vechile_category` (`vechile_category_id`, `vechile_category_name`, `vechile_category_status`, `create_at`) VALUES
(1, 'Bus', 1, '2022-04-06 16:57:50'),
(2, 'Motor Cycle', 1, '2022-04-06 16:58:07'),
(3, 'Micro', 1, '2022-04-06 16:58:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking_rate`
--
ALTER TABLE `parking_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_parking`
--
ALTER TABLE `tbl_parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slots`
--
ALTER TABLE `tbl_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vechile_category`
--
ALTER TABLE `vechile_category`
  ADD PRIMARY KEY (`vechile_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking_rate`
--
ALTER TABLE `parking_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_parking`
--
ALTER TABLE `tbl_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_slots`
--
ALTER TABLE `tbl_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vechile_category`
--
ALTER TABLE `vechile_category`
  MODIFY `vechile_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
