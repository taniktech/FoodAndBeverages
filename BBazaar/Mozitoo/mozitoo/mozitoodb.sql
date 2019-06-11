-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2018 at 10:21 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mozitoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_12_06_142215_create_ms_property_types_table', 1),
('2017_12_06_142602_create_ms_property_amenties_table', 1),
('2017_12_07_052204_create_ts_submitted_properties_table', 1),
('2017_12_07_052332_create_ms_user_types_table', 1),
('2017_12_30_082017_create_ms_user_statuses_table', 1),
('2017_12_30_082204_create_ms_property_statuses_table', 1),
('2018_01_03_130957_create_ms_property_furnish_statuses_table', 1),
('2018_01_03_140305_create_ms_tenant_prefrences_table', 2),
('2018_01_12_092021_create_ms_admin_actions_table', 3),
('2018_01_12_092115_create_ms_tag_reciever_actions_table', 3),
('2018_01_12_092205_create_ms_property_tag_types_table', 3),
('2018_01_12_094122_create_ms_tagged_property_statuses_table', 4),
('2018_01_11_105830_create_ts_tagged_properties_table', 5),
('2018_01_12_073238_create_ts_tag_property_requests_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ms_admin_actions`
--

CREATE TABLE `ms_admin_actions` (
  `admin_action_id` int(10) UNSIGNED NOT NULL,
  `admin_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_admin_actions`
--

INSERT INTO `ms_admin_actions` (`admin_action_id`, `admin_action`, `created_at`, `updated_at`) VALUES
(1, 'Reviewed', NULL, NULL),
(2, 'Approved', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_property_amenties`
--

CREATE TABLE `ms_property_amenties` (
  `prop_amenty_id` int(10) UNSIGNED NOT NULL,
  `prop_amenty_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_property_amenties`
--

INSERT INTO `ms_property_amenties` (`prop_amenty_id`, `prop_amenty_name`, `created_at`, `updated_at`) VALUES
(1, 'Curtains/Drapes', NULL, NULL),
(2, 'Hotwater', NULL, NULL),
(3, 'Screens', NULL, NULL),
(4, 'Oven/Range', NULL, NULL),
(5, 'Convection Oven', NULL, NULL),
(6, 'Chandelier(s)', NULL, NULL),
(7, 'Ceiling Fan', NULL, NULL),
(8, 'Refrigerator', NULL, NULL),
(9, 'Freezer', NULL, NULL),
(10, 'Light Fixtures', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_property_furnish_statuses`
--

CREATE TABLE `ms_property_furnish_statuses` (
  `prop_furnish_status_id` int(10) UNSIGNED NOT NULL,
  `prop_furnish_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_property_furnish_statuses`
--

INSERT INTO `ms_property_furnish_statuses` (`prop_furnish_status_id`, `prop_furnish_status`, `created_at`, `updated_at`) VALUES
(1, 'Not furnished', NULL, NULL),
(2, 'Semi furnished', NULL, NULL),
(3, 'Fully furnished', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_property_statuses`
--

CREATE TABLE `ms_property_statuses` (
  `prop_status_id` int(10) UNSIGNED NOT NULL,
  `prop_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_property_statuses`
--

INSERT INTO `ms_property_statuses` (`prop_status_id`, `prop_status`, `created_at`, `updated_at`) VALUES
(1, 'Verified', NULL, NULL),
(2, 'Not Verified', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_property_tag_types`
--

CREATE TABLE `ms_property_tag_types` (
  `prop_tag_type_id` int(10) UNSIGNED NOT NULL,
  `prop_tag_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_property_tag_types`
--

INSERT INTO `ms_property_tag_types` (`prop_tag_type_id`, `prop_tag_type`, `created_at`, `updated_at`) VALUES
(2, 'Tenant', NULL, NULL),
(4, 'Agent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_property_types`
--

CREATE TABLE `ms_property_types` (
  `prop_type_id` int(10) UNSIGNED NOT NULL,
  `prop_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_property_types`
--

INSERT INTO `ms_property_types` (`prop_type_id`, `prop_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Home', NULL, NULL),
(2, 'Restrurent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_tagged_property_statuses`
--

CREATE TABLE `ms_tagged_property_statuses` (
  `tagged_prop_status_id` int(10) UNSIGNED NOT NULL,
  `tagged_prop_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_tagged_property_statuses`
--

INSERT INTO `ms_tagged_property_statuses` (`tagged_prop_status_id`, `tagged_prop_status`, `created_at`, `updated_at`) VALUES
(1, 'Active', NULL, NULL),
(2, 'Not Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_tag_reciever_actions`
--

CREATE TABLE `ms_tag_reciever_actions` (
  `tag_reciever_action_id` int(10) UNSIGNED NOT NULL,
  `tag_reciever_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_tag_reciever_actions`
--

INSERT INTO `ms_tag_reciever_actions` (`tag_reciever_action_id`, `tag_reciever_action`, `created_at`, `updated_at`) VALUES
(1, 'Approved', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_tenant_prefrences`
--

CREATE TABLE `ms_tenant_prefrences` (
  `tenant_prefrences_id` int(10) UNSIGNED NOT NULL,
  `tenant_prefrences` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_tenant_prefrences`
--

INSERT INTO `ms_tenant_prefrences` (`tenant_prefrences_id`, `tenant_prefrences`, `created_at`, `updated_at`) VALUES
(1, 'Family', NULL, NULL),
(2, 'Bachelors', NULL, NULL),
(3, 'Both, Family & Bachelors', NULL, NULL),
(4, 'No Choice', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_user_statuses`
--

CREATE TABLE `ms_user_statuses` (
  `user_status_id` int(10) UNSIGNED NOT NULL,
  `user_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_user_statuses`
--

INSERT INTO `ms_user_statuses` (`user_status_id`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'Active', NULL, NULL),
(2, 'Not Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_user_types`
--

CREATE TABLE `ms_user_types` (
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_user_types`
--

INSERT INTO `ms_user_types` (`user_type_id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Tenant', NULL, NULL),
(3, 'Owner', NULL, NULL),
(4, 'Agent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_submitted_properties`
--

CREATE TABLE `ts_submitted_properties` (
  `prop_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenant_prefrences_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_bed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_bath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_amenty_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_rent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_morp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prop_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_furnish_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_furniture_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_line1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_tagged_properties`
--

CREATE TABLE `ts_tagged_properties` (
  `prop_tagged_id` int(10) UNSIGNED NOT NULL,
  `tag_prop_request_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tagged_prop_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_tag_property_requests`
--

CREATE TABLE `ts_tag_property_requests` (
  `tag_prop_request_id` int(10) UNSIGNED NOT NULL,
  `prop_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_tag_type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_action_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_reciever_action_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `mobile`, `user_info`, `password`, `user_type_id`, `user_status_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nikhil', 'nnnsns@gmail.com', '9393939399', '', '$2y$10$lHOUdh2v.4qI92XevHBsbun1PpxqP3GwwzJMIyH3wUzC0y68iQ3Zy', '2', '1', '038V5mJ9HXNxUP4wv0ARC0yNwcY073NahRm0LNK0TLTIzOKVlF9a2TK8NyaR', '2018-01-13 07:43:39', '2018-01-13 07:59:41'),
(2, 'Nikhil Vats', 'emailnkv@gmail.com', '9470668481', '', '$2y$10$ZLuYVtqS/JB/lBasdCPHHeydSaEjCPyt398xVrMS1JJ4skN4pxkyG', '3', '1', 'zfxxbj7ZOzu0YdRhgLFLKvxq30RVdlwYvt4MnGCoatsvGISbaD6jtFfQQEz8', '2018-01-13 07:15:31', '2018-01-13 07:16:33'),
(3, 'Nikhil Vats', 'emailnkv@gmail.com', '9470668481', '', '$2y$10$R6pLxQ7s/CmuLgjKaSpV7uhdGNAK52myLHIFpCoioqoZtrgXFE0Nu', '1', '1', 'KpCHWEnSGzT7cocp4YZVW959y39SyTsfezl07xyl90w1lXSzMFXoA7Mu3bTs', '2018-01-13 07:16:49', '2018-01-13 07:19:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_admin_actions`
--
ALTER TABLE `ms_admin_actions`
  ADD PRIMARY KEY (`admin_action_id`);

--
-- Indexes for table `ms_property_amenties`
--
ALTER TABLE `ms_property_amenties`
  ADD PRIMARY KEY (`prop_amenty_id`);

--
-- Indexes for table `ms_property_furnish_statuses`
--
ALTER TABLE `ms_property_furnish_statuses`
  ADD PRIMARY KEY (`prop_furnish_status_id`);

--
-- Indexes for table `ms_property_statuses`
--
ALTER TABLE `ms_property_statuses`
  ADD PRIMARY KEY (`prop_status_id`);

--
-- Indexes for table `ms_property_tag_types`
--
ALTER TABLE `ms_property_tag_types`
  ADD PRIMARY KEY (`prop_tag_type_id`);

--
-- Indexes for table `ms_property_types`
--
ALTER TABLE `ms_property_types`
  ADD PRIMARY KEY (`prop_type_id`);

--
-- Indexes for table `ms_tagged_property_statuses`
--
ALTER TABLE `ms_tagged_property_statuses`
  ADD PRIMARY KEY (`tagged_prop_status_id`);

--
-- Indexes for table `ms_tag_reciever_actions`
--
ALTER TABLE `ms_tag_reciever_actions`
  ADD PRIMARY KEY (`tag_reciever_action_id`);

--
-- Indexes for table `ms_tenant_prefrences`
--
ALTER TABLE `ms_tenant_prefrences`
  ADD PRIMARY KEY (`tenant_prefrences_id`);

--
-- Indexes for table `ms_user_statuses`
--
ALTER TABLE `ms_user_statuses`
  ADD PRIMARY KEY (`user_status_id`);

--
-- Indexes for table `ms_user_types`
--
ALTER TABLE `ms_user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `ts_submitted_properties`
--
ALTER TABLE `ts_submitted_properties`
  ADD PRIMARY KEY (`prop_id`);

--
-- Indexes for table `ts_tagged_properties`
--
ALTER TABLE `ts_tagged_properties`
  ADD PRIMARY KEY (`prop_tagged_id`);

--
-- Indexes for table `ts_tag_property_requests`
--
ALTER TABLE `ts_tag_property_requests`
  ADD PRIMARY KEY (`tag_prop_request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_admin_actions`
--
ALTER TABLE `ms_admin_actions`
  MODIFY `admin_action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_property_amenties`
--
ALTER TABLE `ms_property_amenties`
  MODIFY `prop_amenty_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ms_property_furnish_statuses`
--
ALTER TABLE `ms_property_furnish_statuses`
  MODIFY `prop_furnish_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ms_property_statuses`
--
ALTER TABLE `ms_property_statuses`
  MODIFY `prop_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_property_tag_types`
--
ALTER TABLE `ms_property_tag_types`
  MODIFY `prop_tag_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ms_property_types`
--
ALTER TABLE `ms_property_types`
  MODIFY `prop_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_tagged_property_statuses`
--
ALTER TABLE `ms_tagged_property_statuses`
  MODIFY `tagged_prop_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_tag_reciever_actions`
--
ALTER TABLE `ms_tag_reciever_actions`
  MODIFY `tag_reciever_action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ms_tenant_prefrences`
--
ALTER TABLE `ms_tenant_prefrences`
  MODIFY `tenant_prefrences_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ms_user_statuses`
--
ALTER TABLE `ms_user_statuses`
  MODIFY `user_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ms_user_types`
--
ALTER TABLE `ms_user_types`
  MODIFY `user_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_submitted_properties`
--
ALTER TABLE `ts_submitted_properties`
  MODIFY `prop_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_tagged_properties`
--
ALTER TABLE `ts_tagged_properties`
  MODIFY `prop_tagged_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_tag_property_requests`
--
ALTER TABLE `ts_tag_property_requests`
  MODIFY `tag_prop_request_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
