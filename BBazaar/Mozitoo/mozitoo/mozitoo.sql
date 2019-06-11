-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 10:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `id` int(10) NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_12_06_142215_create_ms_property_types_table', 1),
(4, '2017_12_06_142602_create_ms_property_amenties_table', 1),
(5, '2017_12_07_052204_create_ts_submitted_properties_table', 1),
(6, '2017_12_07_052332_create_ms_user_types_table', 1),
(7, '2017_12_30_082017_create_ms_user_statuses_table', 1),
(8, '2017_12_30_082204_create_ms_property_statuses_table', 1),
(9, '2018_01_03_130957_create_ms_property_furnish_statuses_table', 1),
(10, '2018_01_03_140305_create_ms_tenant_prefrences_table', 2),
(14, '2018_01_12_094122_create_ms_tagged_property_statuses_table', 4),
(15, '2018_01_11_105830_create_ts_tagged_properties_table', 5),
(17, '2018_01_29_113900_create_ts_agent_other_infos_table', 7),
(18, '2018_01_29_113922_create_ts_owner_other_infos_table', 7),
(19, '2018_01_29_113940_create_ts_tenant_other_infos_table', 7),
(20, '2018_01_29_114108_create_ms_service_request_types_table', 7),
(21, '2018_01_29_114145_create_ts_service_requests_table', 7),
(22, '2018_01_29_115627_create_ms_service_request_actions_table', 7),
(23, '2018_01_29_113804_create_ts_edited_submitted_properties_table', 8),
(25, '2018_08_28_105300_create_ms_prop_invnt_levels_table', 9),
(26, '2018_09_04_190713_create_ts_prop_invnt_levels_table', 10),
(27, '2018_09_05_062258_create_ms_prop_bhk_types_table', 11),
(28, '2018_09_10_204711_create_ms_prop_invnt_level_statuses_table', 12),
(29, '2018_09_13_042143_create_ts_prop_inventories_table', 13),
(30, '2018_09_13_044156_create_ms_prop_invnt_statuses_table', 14),
(31, '2018_09_13_182425_create_ms_prop_statuses_table', 15),
(32, '2018_09_17_221417_create_ts_tagged_tenants_table', 16);

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
(1, 'Reserved Parking', NULL, NULL),
(2, 'Amphiteater', NULL, NULL),
(3, 'Jogging and Strolling', NULL, NULL),
(4, 'Track', NULL, NULL),
(5, 'Fire Fighting Equipment', NULL, NULL),
(6, 'Cycling & Jogging Track', NULL, NULL),
(7, 'Kids Play Area', NULL, NULL),
(8, 'Lift', NULL, NULL),
(9, 'Vaastu Compliant', NULL, NULL),
(10, 'Power Back Up', NULL, NULL),
(11, 'Club House', NULL, NULL),
(12, 'Visitor Parking', NULL, NULL),
(13, 'Intercom Facility', NULL, NULL),
(14, 'Tennis Court', NULL, NULL),
(15, 'BasketBall Court', NULL, NULL),
(16, 'Groccery Shop', NULL, NULL),
(17, 'Swimming Pool', NULL, NULL),
(18, 'Indoor Badmintorn Court', NULL, NULL),
(19, 'Tabe Tennis', NULL, NULL),
(20, 'Snooker', NULL, NULL),
(21, 'Mini Movie Theater', NULL, NULL);

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
-- Table structure for table `ms_property_types`
--

CREATE TABLE `ms_property_types` (
  `prop_type_id` int(10) UNSIGNED NOT NULL,
  `prop_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_property_types`
--

INSERT INTO `ms_property_types` (`prop_type_id`, `prop_type`, `created_at`, `updated_at`) VALUES
(1, 'Apartment', NULL, NULL),
(2, 'Villa', NULL, NULL),
(3, 'Duplex', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_prop_bhk_types`
--

CREATE TABLE `ms_prop_bhk_types` (
  `prop_bhk_id` int(10) UNSIGNED NOT NULL,
  `prop_bhk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `room` int(10) NOT NULL,
  `bhk_value` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_prop_bhk_types`
--

INSERT INTO `ms_prop_bhk_types` (`prop_bhk_id`, `prop_bhk`, `created_at`, `updated_at`, `room`, `bhk_value`) VALUES
(1, '1 BHK', NULL, NULL, 1, 1),
(2, '2 BHK', NULL, NULL, 2, 2),
(3, '3 BHK', NULL, NULL, 3, 3),
(4, '4 BHK', NULL, NULL, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ms_prop_invnt_levels`
--

CREATE TABLE `ms_prop_invnt_levels` (
  `prop_invnt_level_id` int(10) UNSIGNED NOT NULL,
  `prop_invnt_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level_value` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_prop_invnt_levels`
--

INSERT INTO `ms_prop_invnt_levels` (`prop_invnt_level_id`, `prop_invnt_level`, `level_value`, `created_at`, `updated_at`) VALUES
(1, 'Flat', 1, NULL, NULL),
(2, 'Rooms', 2, NULL, NULL),
(3, 'Beds', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_prop_invnt_level_statuses`
--

CREATE TABLE `ms_prop_invnt_level_statuses` (
  `invnt_level_status_id` int(10) UNSIGNED NOT NULL,
  `invnt_level_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_prop_invnt_level_statuses`
--

INSERT INTO `ms_prop_invnt_level_statuses` (`invnt_level_status_id`, `invnt_level_status`, `created_at`, `updated_at`) VALUES
(1, 'Created', NULL, NULL),
(2, 'Verified', NULL, NULL),
(3, 'Assigned', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_prop_invnt_statuses`
--

CREATE TABLE `ms_prop_invnt_statuses` (
  `invnt_status_id` int(10) UNSIGNED NOT NULL,
  `invnt_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_prop_invnt_statuses`
--

INSERT INTO `ms_prop_invnt_statuses` (`invnt_status_id`, `invnt_status`, `created_at`, `updated_at`) VALUES
(1, 'Not Active', NULL, NULL),
(2, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_prop_statuses`
--

CREATE TABLE `ms_prop_statuses` (
  `prop_status_id` int(10) UNSIGNED NOT NULL,
  `prop_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_prop_statuses`
--

INSERT INTO `ms_prop_statuses` (`prop_status_id`, `prop_status`, `created_at`, `updated_at`) VALUES
(1, 'Created', NULL, NULL),
(2, 'Verified', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_service_request_actions`
--

CREATE TABLE `ms_service_request_actions` (
  `service_req_action_id` int(10) UNSIGNED NOT NULL,
  `service_req_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_service_request_actions`
--

INSERT INTO `ms_service_request_actions` (`service_req_action_id`, `service_req_action`, `created_at`, `updated_at`) VALUES
(1, 'Not Intiated', NULL, NULL),
(2, 'Intiated', NULL, NULL),
(3, 'Completed', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_service_request_types`
--

CREATE TABLE `ms_service_request_types` (
  `service_req_type_id` int(10) UNSIGNED NOT NULL,
  `service_req_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ms_service_request_types`
--

INSERT INTO `ms_service_request_types` (`service_req_type_id`, `service_req_type`, `created_at`, `updated_at`) VALUES
(1, 'Plumber Work', NULL, NULL),
(2, 'Painting', NULL, NULL);

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
(3, 'Both, Family & Bachelors', NULL, NULL);

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
-- Table structure for table `ts_agent_other_infos`
--

CREATE TABLE `ts_agent_other_infos` (
  `agent_other_info_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `rera_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adhar_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_agent_other_infos`
--

INSERT INTO `ts_agent_other_infos` (`agent_other_info_id`, `user_id`, `rera_id`, `company_name`, `adhar_id`, `address_line_1`, `address_line_2`, `city`, `state`, `pincode`, `google_plus_id`, `twitter_id`, `linkedin_id`, `facebook_id`, `created_at`, `updated_at`) VALUES
(1, 5, '12345', 'Naihara', '1234', '#32', 'Roopena Agrahara', 'Bnaglore', 'ka', '560068', 'https://google.com', 'http://twitter.com', 'http://linkedin.com', 'http://facebook.com/anationalist', '2018-03-24 17:33:37', '2018-03-25 05:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `ts_edited_submitted_properties`
--

CREATE TABLE `ts_edited_submitted_properties` (
  `tmp_prop_id` int(10) UNSIGNED NOT NULL,
  `prop_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  `prop_morp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_furnish_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_furniture_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_line1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_locality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
-- Table structure for table `ts_owner_other_infos`
--

CREATE TABLE `ts_owner_other_infos` (
  `owner_other_info_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `adhar_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gstn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_line_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_owner_other_infos`
--

INSERT INTO `ts_owner_other_infos` (`owner_other_info_id`, `user_id`, `adhar_id`, `gstn`, `address_line_1`, `address_line_2`, `city`, `state`, `pincode`, `created_at`, `updated_at`) VALUES
(1, 6, '9999999999', 'na', 'pta-203', 'Golden blossom, Opp. to Sai baba Ashram, Kadugodi', 'bangalore', 'Karnataka', '560067', '2018-03-13 16:32:41', '2018-03-13 16:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `ts_password_resets`
--

CREATE TABLE `ts_password_resets` (
  `ts_pwd_reset_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_expired` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_prop_inventories`
--

CREATE TABLE `ts_prop_inventories` (
  `ts_prop_invnt_id` int(10) UNSIGNED NOT NULL,
  `prop_id` int(10) NOT NULL,
  `ts_prop_invnt_level_id` int(10) NOT NULL,
  `fomatted_invnt_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `rent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maint_charge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rent_pay_date` int(10) NOT NULL,
  `invnt_status_id` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_prop_inventories`
--

INSERT INTO `ts_prop_inventories` (`ts_prop_invnt_id`, `prop_id`, `ts_prop_invnt_level_id`, `fomatted_invnt_id`, `user_id`, `rent`, `maint_charge`, `rent_pay_date`, `invnt_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2121, 'SS_V_3_1_1', 9, '323', '3232', 1, 2, '2018-09-20 15:58:22', '2018-09-20 18:44:24'),
(2, 1, 2121, 'SS_V_3_1_2', 9, '323', '3232', 1, 2, '2018-09-20 15:58:22', '2018-09-20 19:12:38'),
(3, 1, 2121, 'SS_V_3_2_1', 9, '323', '3232', 1, 2, '2018-09-20 15:58:22', '2018-09-20 18:42:58'),
(4, 1, 2121, 'SS_V_3_2_2', 7, '323', '3232', 1, 2, '2018-09-20 15:58:22', '2018-09-20 19:13:27'),
(5, 1, 2121, 'SS_V_3_3_1', 9, '323', '3232', 1, 2, '2018-09-20 15:58:22', '2018-09-20 18:42:14'),
(6, 1, 2121, 'SS_V_3_3_2', 9, '323', '3232', 1, 2, '2018-09-20 15:58:22', '2018-09-20 19:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `ts_prop_invnt_levels`
--

CREATE TABLE `ts_prop_invnt_levels` (
  `ts_prop_invnt_level_id` int(10) UNSIGNED NOT NULL,
  `prop_id` int(10) NOT NULL,
  `prop_invnt_level_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exp_rent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exp_deposit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `morp` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `invnt_level_status_id` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_prop_invnt_levels`
--

INSERT INTO `ts_prop_invnt_levels` (`ts_prop_invnt_level_id`, `prop_id`, `prop_invnt_level_id`, `exp_rent`, `exp_deposit`, `morp`, `invnt_level_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '10000', '20000', '15000', 2, '2018-09-16 05:39:46', '2018-09-16 05:40:56'),
(2, 1, '2', '5000', '10000', '7000', 2, '2018-09-16 05:39:46', '2018-09-16 05:40:56'),
(2121, 1, '3', '2000', '20000', '5000', 3, '2018-09-16 05:39:46', '2018-09-20 15:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `ts_service_requests`
--

CREATE TABLE `ts_service_requests` (
  `ts_service_req_id` int(10) UNSIGNED NOT NULL,
  `prop_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_req_type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_req_action_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `msg_from_mngr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_submitted_properties`
--

CREATE TABLE `ts_submitted_properties` (
  `prop_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `tenant_prefrences_id` int(10) NOT NULL,
  `prop_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_type_id` int(10) NOT NULL,
  `prop_bhk_id` int(10) NOT NULL,
  `prop_amenty_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_furnish_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_furniture_age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_line1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_locality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prop_status_id` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_submitted_properties`
--

INSERT INTO `ts_submitted_properties` (`prop_id`, `user_id`, `tenant_prefrences_id`, `prop_title`, `prop_desc`, `prop_type_id`, `prop_bhk_id`, `prop_amenty_id`, `prop_area`, `prop_age`, `prop_furnish_status_id`, `prop_furniture_age`, `prop_address_line1`, `prop_locality`, `prop_lat`, `prop_lng`, `prop_city`, `prop_pincode`, `prop_state`, `prop_status_id`, `created_at`, `updated_at`) VALUES
(1, 11, 3, 'Shakti Sprinkle', 'good', 2, 3, '4,7,8', '1000', '10', '2', '0', '#32 1st main', 'Begur, Bengaluru, Karnataka, India', '12.8787673', '77.63766759999999', 'banglore', '560080', 'karnatka', 2, '2018-09-16 05:39:46', '2018-09-16 05:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `ts_tagged_properties`
--

CREATE TABLE `ts_tagged_properties` (
  `prop_tagged_id` int(10) UNSIGNED NOT NULL,
  `prop_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tagged_prop_status_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_tagged_properties`
--

INSERT INTO `ts_tagged_properties` (`prop_tagged_id`, `prop_id`, `user_id`, `tagged_prop_status_id`, `created_at`, `updated_at`) VALUES
(1, '1', '5', '1', '2018-09-16 05:40:56', '2018-09-16 05:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `ts_tagged_tenants`
--

CREATE TABLE `ts_tagged_tenants` (
  `tagged_tenant_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `prop_id` int(10) NOT NULL,
  `ts_prop_invnt_id` int(10) NOT NULL,
  `rent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maint_charge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rent_pay_date` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `tagged_tenant_status_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_tagged_tenants`
--

INSERT INTO `ts_tagged_tenants` (`tagged_tenant_id`, `user_id`, `prop_id`, `ts_prop_invnt_id`, `rent`, `maint_charge`, `rent_pay_date`, `start_date`, `end_date`, `tagged_tenant_status_id`, `created_at`, `updated_at`) VALUES
(2, 9, 1, 5, '', '', 0, '2018-09-21', '0000-00-00', 1, '2018-09-20 18:42:14', '2018-09-20 18:42:14'),
(3, 9, 1, 3, '', '', 0, '2018-09-21', '0000-00-00', 1, '2018-09-20 18:42:58', '2018-09-20 18:42:58'),
(4, 9, 1, 1, '', '', 0, '2018-09-21', '0000-00-00', 1, '2018-09-20 18:44:24', '2018-09-20 18:44:24'),
(5, 9, 1, 2, '', '', 0, '2018-09-21', '0000-00-00', 1, '2018-09-20 19:12:38', '2018-09-20 19:12:38'),
(6, 7, 1, 4, '', '', 0, '2018-09-21', '0000-00-00', 1, '2018-09-20 19:13:27', '2018-09-20 19:13:27'),
(7, 9, 1, 6, '', '', 0, '2018-09-21', '0000-00-00', 1, '2018-09-20 19:41:05', '2018-09-20 19:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `ts_tenant_other_infos`
--

CREATE TABLE `ts_tenant_other_infos` (
  `tenant_other_info_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `address_line_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_tenant_other_infos`
--

INSERT INTO `ts_tenant_other_infos` (`tenant_other_info_id`, `user_id`, `address_line_1`, `created_at`, `updated_at`, `address_line_2`, `city`, `state`, `pincode`) VALUES
(1, 10, '#32', '2018-03-24 17:35:05', '2018-03-24 17:35:05', 'Roopena ', 'blr', 'ka', '32323');

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
(1, 'Nikhil Admin', 'emailnkv@gmail.com', '9470668481', '', '$2y$10$/Av9BtCtZ4kr.6zf0odSc.vU5dPy3pnV0o0kpVcGEyMFXVTViQkIC', '1', '1', 'CqMMAA0T0hk05d177Paso4YPuAlxDifryyMuelSigPIZxTbCXzriqWK1DbCZ', '2018-03-03 17:38:35', '2018-09-20 18:50:30'),
(2, 'Kiran Kumar', 'dkiran@live.com', '9963082323', '', '$2y$10$D1ecR9SJ5NVCulcQl1ZNo.i9nRWH6wqYY1017zKlRo/Twl9z03XYa', '3', '1', NULL, '2018-03-04 13:12:10', '2018-03-04 13:12:10'),
(3, 'Kiran', 'mail2dkiran@gmail.com', '8008575757', '', '$2y$10$D1ecR9SJ5NVCulcQl1ZNo.i9nRWH6wqYY1017zKlRo/Twl9z03XYa', '3', '1', 'tvr1OcxiyCEmJF0QlhLx5VGScsp9Lx5GXn5pfCxHNetK7oky2v11t4ZxjAoV', '2018-03-04 13:13:59', '2018-03-05 06:14:55'),
(4, 'Kiran', 'mail2kkiran@gmail.com', '9148001517', '', '$2y$10$D1ecR9SJ5NVCulcQl1ZNo.i9nRWH6wqYY1017zKlRo/Twl9z03XYa', '3', '1', 'OoPfrNh85SZbhhGi6x9UT3XD35OOe85CJeYYmGtboNC9sv92BRQSSBX6MLFS', '2018-03-04 13:17:05', '2018-03-04 13:20:18'),
(5, 'Manager Nikhil', 'emailnkv@gmail.com', '9470668481', 'Good', '$2y$10$rh4vmsv.xvp4Pt/TUu.cUug0MkXJbpNPneuxu7BcknnUbQdvPcpRW', '4', '1', 'zktBHwCfLahmbilTtBB5hbgUXvMDqCLeNj2d7tyzaTM3HQjXwYdY474syh8h', '2018-03-05 04:57:31', '2018-09-15 09:51:07'),
(6, 'sunil gupta', 'owner@gmail.com', '9909909900', 'owner testing', '$2y$10$yF.BLhLfChdd5Ub6kz4HpesxkklgL2Nvkoxepu2l1U6QfxBJ1N5oO', '3', '1', 'rgRXQIUnfLOJIP0w0k7hKpjJQSZwIpLW7erzJIrHHlP054vekCbKpL0cm6B1', '2018-03-10 03:59:47', '2018-07-13 00:22:38'),
(7, 'tenant', 'tenant@gmail.com', '9999999999', '', '$2y$10$ekqSxMA4lQCGS4.RuhPMFOfewK2HLuf1AlOgN64Jd16uBBcVfKPG.', '2', '1', 'eHkhDUDAT4nkbusAKk4PYrBvCvwXq42rGNHj1yva896SirW2EgWgYlpiSroG', '2018-03-10 05:53:37', '2018-03-29 06:30:19'),
(8, 'Agent', 'agent@gmail.com', '8990899099', 'Expertise in rental ', '$2y$10$dUnDNYlMaF5CVtPPl7rto.sWiCHIYjKGc5uVk4F03BXKI9Tx5qs/y', '4', '1', 'pbBEJXeGzdLiqlylxGqapKXCheiNkjgltd9vlWFKK7wue4VqNau8qwAG1ptl', '2018-03-10 05:54:12', '2018-07-10 22:11:58'),
(9, 'tenant1', 'tenant1@gmail.com', '6767676767', '', '$2y$10$r.OmRI3x7RSjYmnr.6FZK.D497QEv52oQCEAkMKiNgExUg./GgsZC', '2', '1', 'TLlIxYaszhvT9uwIE5ZB8rFLDlJ74Aog90v9BRxed4vSGiCrwMrougqLHxKb', '2018-03-10 07:32:51', '2018-03-10 07:42:36'),
(10, 'Nikhil Tenant', 'emailnkv@gmail.com', '9470668481', 'good', '$2y$10$qF6X9mHtE1aMoXfBfvpeQ.r0l9s1dG.nhO/h.QjBcSZWvHhBK2t9W', '2', '1', 'eYlM9QfeBgYoI7i8vBxW2lSjOKH3qwUz0IZPCv2m3OWxVCXGhCBVxoUgzZFy', '2018-03-24 15:33:26', '2018-09-20 10:02:09'),
(11, 'Owner Nikhil', 'emailnkv@gmail.com', '9470668481', '', '$2y$10$ia9QJoRMwj7lzzJX9zjShOQf8fzuvM9oHYToAnmjoUS0ytGhzACG.', '3', '1', 'u9RDAe6WJuGgorkku0JEafFb5OGSVuv6q6c3Iclryf3ifVC4J70WbW4z8RSg', '2018-03-24 17:30:30', '2018-09-16 05:39:50'),
(13, 'Test Owner', 'testowner@gmail.com', '9470668482', '', '$2y$10$a37gm91UsyhlgQGrxXEi8.VwpCbQjzGRwIQ8uZKzD6fW8yG7XE1rm', '3', '1', NULL, '2018-03-29 10:20:15', '2018-03-29 10:20:15'),
(14, 'Owner1', 'owner1@gmail.com', '9090909090', '', '$2y$10$vk94mOvzlvRYltbwV/9fvOJ1xvtZw85XqNPQnRTyhbjjkm4myHx6y', '3', '1', NULL, '2018-03-29 15:20:55', '2018-03-29 15:20:55'),
(15, 'rituparn bakshi ', 'sudhish10@gmail.com', '7074456600', '', '$2y$10$L8Zt.Du/UtOq7x5QMbH4yehZ1ZddjjEoyvs7hjfxoj7zIMMyx1sWW', '3', '1', '7qCNq9n8c0TF4keDg08UHdxyprKoPapLg5NBaoA6AS3BIUgZOHiAEoY3abd2', '2018-04-02 13:02:14', '2018-04-02 13:07:13'),
(16, 'webmasterxxxx', 'sudhish10@gmail.com', '7074456600', '', '$2y$10$A8Bh1C30a1.ItfDWRCK2Xe3RcKYOi/ZCrl.KN4dGJghJrEy7jtVN6', '2', '1', NULL, '2018-04-05 11:49:16', '2018-04-05 11:49:16'),
(17, 'webmaster123', 'sudhish.careerinfo@gmail.com', '8769084532', '', '$2y$10$tY1vSJbDqJ6NTqE1tqQofOP4Wj9kXFDDSlwNA1JP.kGgJO2xCRU26', '3', '1', NULL, '2018-04-18 05:05:17', '2018-04-18 05:05:17'),
(18, 'Mukesh', 'mukesh.anchuri@paymatrix.in', '9880671136', '', '$2y$10$1eLThy9pC3vD0545BZ19VepNNvjwhZuwqUxyQxWf4b13VE5C4hevK', '2', '1', NULL, '2018-04-19 01:44:38', '2018-04-19 01:44:38'),
(19, 'Prajeesh P', 'prajeesh.ownmanager@gmail.com', '9902552587', '', '$2y$10$N00P3kP7DmETBEwOnO9e2e/dO6glSJz75Rbt60A6BIfgpOM1C8.Nm', '3', '1', 'EOYIW2FSy0ZHSTTLAwD7eYnchzW2w5RDv5LXCMoYPIklxpsZW958s1vkwww4', '2018-06-25 03:34:59', '2018-06-25 04:48:07'),
(20, 'Saddham ', 'saddham.obm@gmail.com', '9605675069', '', '$2y$10$YhATzW1iWBUWZNaBvDVwqelhy/IIGXJdgbY.5QO5Z8SztER4w1QyK', '3', '1', 'JmlUH5Y4xYdZLBx6UmS8zuqewPHuizI5hYRydLHzgZOL1OhJmE51Ky8ocWgZ', '2018-07-08 22:51:57', '2018-07-08 22:53:16'),
(21, 'Bijan Kumar', 'er.kumarbijan@gmail.com', '9437830419', '', '$2y$10$IL8ADrsA8ILzXuOshZoMIeRA/IaGcMdIEI0zN9ZemMpssiFWYGhBW', '4', '1', 'YYRo3KVU5lAK2VlXJR9pHCmuYVuSlRR32oazChbdbz1kYU7CL0hscP8Ynr6r', '2018-07-08 22:54:38', '2018-07-08 22:56:45'),
(22, 'Bijan Kumar', 'er.kumarbijan@gmail.com', '9437830419', '', '$2y$10$2EIDhNe7twU4ZAX8KNfKieZjc7.vS6ChmYGTaQ2VNwrJraGnbOqn2', '3', '1', NULL, '2018-07-08 23:30:21', '2018-07-08 23:30:21'),
(23, 'hbhg', 'ddf@gmail.com', '4645646464', '', '$2y$10$8OZbqxbcdOIlJ1QvmB.R0OP4yQWwcR7pno3I7LFR0gnVEK29chcme', '4', '1', 'pXS0SRHrcqoDcHaoGLR0Zqb4Wyxw84fWL2gu24kadgrwIgfmqHQO7Cmlk49A', '2018-07-13 05:48:31', '2018-07-13 05:49:17'),
(24, 'Saddham', 'saddham.obm@gmail.com', '8796412320', '', '$2y$10$6zHU10wFcq87qF1.P0nni.6fISj/mFWAVb3lUJxU9GrRd3Jyj5kau', '1', '1', NULL, '2018-07-16 04:02:54', '2018-07-16 04:02:54'),
(25, 'Saddham', 'saddhambava@gmail.com', '9638264174', '', '$2y$10$O1wF3Wq0OFIcnijCs0FDoOVOWFcqdAlgCoCn5UfGnNG84mFo3fVdC', '2', '1', 'Ff2qXSHJctGk55QJcqRefOWJPj6lCZhrvJ1BK0NTDAUsGsVox9VRb1jxjeMa', '2018-08-02 03:27:39', '2018-08-02 03:32:56'),
(49, 'Nikhil', 'nik@hmail.com', '93', '', '$2y$10$amKuW3PIqhy1RWIR9BVmdOAZbMuSAxOyCUEmulRKCCZNUm7V76inu', '3', '1', NULL, '2018-09-03 05:54:47', '2018-09-03 05:54:47'),
(88, 'Nikhil Kumar', 'immihir@gmail.com', '9001122123', '', '$2y$10$1yZqjINJyJcSuyer4y2a2O5Jrqvfi9muN7x6udiN22.WTIwpiXxJ2', '3', '1', NULL, '2018-09-04 14:07:15', '2018-09-04 14:07:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ms_property_types`
--
ALTER TABLE `ms_property_types`
  ADD PRIMARY KEY (`prop_type_id`);

--
-- Indexes for table `ms_prop_bhk_types`
--
ALTER TABLE `ms_prop_bhk_types`
  ADD PRIMARY KEY (`prop_bhk_id`);

--
-- Indexes for table `ms_prop_invnt_levels`
--
ALTER TABLE `ms_prop_invnt_levels`
  ADD PRIMARY KEY (`prop_invnt_level_id`);

--
-- Indexes for table `ms_prop_invnt_level_statuses`
--
ALTER TABLE `ms_prop_invnt_level_statuses`
  ADD PRIMARY KEY (`invnt_level_status_id`);

--
-- Indexes for table `ms_prop_invnt_statuses`
--
ALTER TABLE `ms_prop_invnt_statuses`
  ADD PRIMARY KEY (`invnt_status_id`);

--
-- Indexes for table `ms_prop_statuses`
--
ALTER TABLE `ms_prop_statuses`
  ADD PRIMARY KEY (`prop_status_id`);

--
-- Indexes for table `ms_service_request_actions`
--
ALTER TABLE `ms_service_request_actions`
  ADD PRIMARY KEY (`service_req_action_id`);

--
-- Indexes for table `ms_service_request_types`
--
ALTER TABLE `ms_service_request_types`
  ADD PRIMARY KEY (`service_req_type_id`);

--
-- Indexes for table `ms_tagged_property_statuses`
--
ALTER TABLE `ms_tagged_property_statuses`
  ADD PRIMARY KEY (`tagged_prop_status_id`);

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
-- Indexes for table `ts_agent_other_infos`
--
ALTER TABLE `ts_agent_other_infos`
  ADD PRIMARY KEY (`agent_other_info_id`);

--
-- Indexes for table `ts_edited_submitted_properties`
--
ALTER TABLE `ts_edited_submitted_properties`
  ADD PRIMARY KEY (`tmp_prop_id`);

--
-- Indexes for table `ts_owner_other_infos`
--
ALTER TABLE `ts_owner_other_infos`
  ADD PRIMARY KEY (`owner_other_info_id`);

--
-- Indexes for table `ts_password_resets`
--
ALTER TABLE `ts_password_resets`
  ADD PRIMARY KEY (`ts_pwd_reset_id`);

--
-- Indexes for table `ts_prop_inventories`
--
ALTER TABLE `ts_prop_inventories`
  ADD PRIMARY KEY (`ts_prop_invnt_id`);

--
-- Indexes for table `ts_prop_invnt_levels`
--
ALTER TABLE `ts_prop_invnt_levels`
  ADD PRIMARY KEY (`ts_prop_invnt_level_id`);

--
-- Indexes for table `ts_service_requests`
--
ALTER TABLE `ts_service_requests`
  ADD PRIMARY KEY (`ts_service_req_id`);

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
-- Indexes for table `ts_tagged_tenants`
--
ALTER TABLE `ts_tagged_tenants`
  ADD PRIMARY KEY (`tagged_tenant_id`);

--
-- Indexes for table `ts_tenant_other_infos`
--
ALTER TABLE `ts_tenant_other_infos`
  ADD PRIMARY KEY (`tenant_other_info_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ms_property_amenties`
--
ALTER TABLE `ms_property_amenties`
  MODIFY `prop_amenty_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- AUTO_INCREMENT for table `ms_property_types`
--
ALTER TABLE `ms_property_types`
  MODIFY `prop_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_prop_bhk_types`
--
ALTER TABLE `ms_prop_bhk_types`
  MODIFY `prop_bhk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_prop_invnt_levels`
--
ALTER TABLE `ms_prop_invnt_levels`
  MODIFY `prop_invnt_level_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_prop_invnt_level_statuses`
--
ALTER TABLE `ms_prop_invnt_level_statuses`
  MODIFY `invnt_level_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_prop_invnt_statuses`
--
ALTER TABLE `ms_prop_invnt_statuses`
  MODIFY `invnt_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_prop_statuses`
--
ALTER TABLE `ms_prop_statuses`
  MODIFY `prop_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_service_request_actions`
--
ALTER TABLE `ms_service_request_actions`
  MODIFY `service_req_action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_service_request_types`
--
ALTER TABLE `ms_service_request_types`
  MODIFY `service_req_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_tagged_property_statuses`
--
ALTER TABLE `ms_tagged_property_statuses`
  MODIFY `tagged_prop_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_tenant_prefrences`
--
ALTER TABLE `ms_tenant_prefrences`
  MODIFY `tenant_prefrences_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `ts_agent_other_infos`
--
ALTER TABLE `ts_agent_other_infos`
  MODIFY `agent_other_info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ts_edited_submitted_properties`
--
ALTER TABLE `ts_edited_submitted_properties`
  MODIFY `tmp_prop_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_owner_other_infos`
--
ALTER TABLE `ts_owner_other_infos`
  MODIFY `owner_other_info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ts_password_resets`
--
ALTER TABLE `ts_password_resets`
  MODIFY `ts_pwd_reset_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_prop_inventories`
--
ALTER TABLE `ts_prop_inventories`
  MODIFY `ts_prop_invnt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ts_prop_invnt_levels`
--
ALTER TABLE `ts_prop_invnt_levels`
  MODIFY `ts_prop_invnt_level_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ts_service_requests`
--
ALTER TABLE `ts_service_requests`
  MODIFY `ts_service_req_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_submitted_properties`
--
ALTER TABLE `ts_submitted_properties`
  MODIFY `prop_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ts_tagged_properties`
--
ALTER TABLE `ts_tagged_properties`
  MODIFY `prop_tagged_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ts_tagged_tenants`
--
ALTER TABLE `ts_tagged_tenants`
  MODIFY `tagged_tenant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ts_tenant_other_infos`
--
ALTER TABLE `ts_tenant_other_infos`
  MODIFY `tenant_other_info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
