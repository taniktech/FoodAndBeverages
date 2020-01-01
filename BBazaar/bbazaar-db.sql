-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2019 at 05:58 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbazaar-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_loyalty_flow`
--

CREATE TABLE `ms_loyalty_flow` (
  `loyalty_flow_id` int(10) NOT NULL,
  `loyalty_flow` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_loyalty_flow`
--

INSERT INTO `ms_loyalty_flow` (`loyalty_flow_id`, `loyalty_flow`) VALUES
(1, 'Added'),
(2, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `ms_menus`
--

CREATE TABLE `ms_menus` (
  `menu_id` int(10) NOT NULL,
  `menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_menus`
--

INSERT INTO `ms_menus` (`menu_id`, `menu`) VALUES
(1, 'Chicken Biryani'),
(2, 'Chicken Biryani Boneless'),
(3, 'Egg Biryani'),
(4, 'Paneer Biryani'),
(5, 'Mutton Biryani'),
(6, 'Veg Biryani'),
(7, 'Chicken Biryani Boneless');

-- --------------------------------------------------------

--
-- Table structure for table `ms_outlets`
--

CREATE TABLE `ms_outlets` (
  `outlet_id` int(10) NOT NULL,
  `outlet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_outlets`
--

INSERT INTO `ms_outlets` (`outlet_id`, `outlet`) VALUES
(1, 'Wagholi'),
(2, 'Near Sohrab Hall, Sangamvadi'),
(3, 'Opposite Wadia College, Sangamvadi'),
(4, 'Near Red Chillies, Opposite Zensar');

-- --------------------------------------------------------

--
-- Table structure for table `ms_transaction_status`
--

CREATE TABLE `ms_transaction_status` (
  `transaction_status_id` int(10) NOT NULL,
  `transaction_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_transaction_status`
--

INSERT INTO `ms_transaction_status` (`transaction_status_id`, `transaction_status`) VALUES
(1, 'Successful'),
(2, 'Failed');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user_types`
--

CREATE TABLE `ms_user_types` (
  `user_type_id` int(10) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_user_types`
--

INSERT INTO `ms_user_types` (`user_type_id`, `user_type`) VALUES
(1, 'Customer'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `ts_cart`
--

CREATE TABLE `ts_cart` (
  `ts_cart_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ts_menu_details_id` int(10) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `ts_order_id` bigint(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_cart`
--

INSERT INTO `ts_cart` (`ts_cart_id`, `user_id`, `ts_menu_details_id`, `price`, `quantity`, `ts_order_id`, `created_at`) VALUES
(1, 1, 10, 179, 13, 1, '2018-04-02 01:11:03'),
(2, 1, 19, 99, 1, 1, '2018-04-02 01:11:17'),
(3, 1, 1, 179, 1, 1, '2018-04-02 01:11:22'),
(4, 1, 13, 299, 5, 2, '2018-04-02 01:12:11'),
(6, 0, 3, 0, 0, 0, '2018-04-02 19:26:04'),
(7, 0, 5, 0, 0, 0, '2018-04-02 22:11:08'),
(9, 6, 1, 179, 1, 3, '2018-04-03 15:21:34'),
(11, 0, 21, 0, 0, 0, '2018-04-04 12:19:40'),
(12, 0, 0, 0, 0, 0, '2018-04-04 18:01:02'),
(13, 0, 1, 0, 0, 0, '2018-04-04 18:15:47'),
(14, 0, 16, 0, 0, 0, '2018-04-04 18:16:01'),
(15, 0, 7, 0, 0, 0, '2018-04-06 15:00:12'),
(16, 0, 9, 0, 0, 0, '2018-04-06 15:01:08'),
(17, 0, 3, 0, 0, 0, '2018-04-06 15:01:51'),
(19, 0, 21, 0, 0, 0, '2018-04-06 20:51:06'),
(22, 0, 1, 0, 0, 0, '2018-04-12 10:29:10'),
(23, 0, 1, 0, 0, 0, '2018-04-12 10:29:45'),
(25, 0, 19, 0, 0, 0, '2018-04-13 18:43:45'),
(26, 0, 19, 0, 0, 0, '2018-04-13 18:43:46'),
(27, 0, 19, 0, 0, 0, '2018-04-13 18:43:49'),
(28, 0, 21, 0, 0, 0, '2018-04-14 19:35:07'),
(29, 0, 0, 0, 0, 0, '2018-04-15 11:14:05'),
(30, 0, 17, 0, 0, 0, '2018-04-16 20:10:25'),
(31, 0, 16, 0, 0, 0, '2018-04-16 20:11:51'),
(32, 0, 17, 0, 0, 0, '2018-04-16 20:12:13'),
(33, 0, 18, 0, 0, 0, '2018-04-16 20:12:34'),
(34, 0, 7, 0, 0, 0, '2018-04-16 20:12:54'),
(35, 0, 2, 0, 0, 0, '2018-04-19 17:04:46'),
(36, 0, 3, 0, 0, 0, '2018-04-19 17:23:06'),
(37, 7, 21, 99, 2, 4, '2018-04-20 12:55:26'),
(38, 0, 0, 0, 0, 0, '2018-04-22 14:02:00'),
(39, 0, 4, 0, 0, 0, '2018-04-22 14:05:22'),
(42, 0, 2, 0, 0, 0, '2018-04-24 12:20:37'),
(44, 0, 19, 0, 0, 0, '2018-04-24 19:17:13'),
(45, 0, 19, 0, 0, 0, '2018-04-24 20:41:39'),
(46, 0, 10, 0, 0, 0, '2018-04-24 20:42:04'),
(47, 0, 2, 0, 0, 0, '2018-04-25 18:33:06'),
(48, 6, 1, 179, 1, 5, '2018-04-26 21:14:49'),
(49, 9, 21, 99, 1, 6, '2018-04-27 13:17:22'),
(50, 0, 21, 0, 0, 0, '2018-04-27 14:04:12'),
(51, 0, 1, 0, 0, 0, '2018-04-30 12:37:15'),
(52, 0, 16, 0, 0, 0, '2018-04-30 12:37:58'),
(53, 0, 1, 0, 0, 0, '2018-05-08 21:29:54'),
(54, 0, 7, 0, 0, 0, '2018-05-11 20:18:13'),
(56, 0, 11, 0, 0, 0, '2018-05-12 21:57:19'),
(57, 0, 4, 0, 0, 0, '2018-05-13 18:15:39'),
(58, 0, 5, 0, 0, 0, '2018-05-13 18:16:01'),
(59, 1, 19, 99, 1, 9, '2018-05-13 22:32:10'),
(60, 1, 19, 99, 1, 9, '2018-05-13 22:39:14'),
(61, 1, 20, 99, 1, 10, '2018-05-14 00:40:41'),
(62, 1, 20, 99, 1, 3456, '2018-05-14 00:48:02'),
(63, 0, 19, 0, 0, 0, '2018-05-14 09:47:09'),
(64, 1, 21, 99, 1, 3457, '2018-05-14 11:42:42'),
(65, 5, 1, 179, 1, 3458, '2018-05-16 01:46:29'),
(66, 1, 14, 749, 2, 3459, '2018-05-16 15:56:42'),
(67, 12, 3, 1249, 1, 3461, '2018-05-18 11:55:02'),
(68, 0, 3, 0, 0, 0, '2018-05-18 12:25:25'),
(71, 0, 6, 0, 0, 0, '2018-05-18 19:30:57'),
(72, 0, 1, 0, 0, 0, '2018-05-20 13:48:39'),
(74, 0, 1, 0, 0, 0, '2018-05-20 17:25:38'),
(75, 0, 21, 0, 0, 0, '2018-05-26 11:53:05'),
(76, 0, 0, 0, 0, 0, '2018-05-27 12:53:36'),
(77, 0, 3, 0, 0, 0, '2018-05-27 12:54:08'),
(78, 0, 19, 0, 0, 0, '2018-06-02 02:29:03'),
(79, 14, 19, 99, 3, 3463, '2018-06-05 13:07:28'),
(80, 0, 19, 0, 0, 0, '2018-06-05 13:07:29'),
(81, 14, 21, 99, 1, 3463, '2018-06-05 13:08:15'),
(82, 0, 21, 0, 0, 0, '2018-06-09 01:56:18'),
(83, 0, 21, 0, 0, 0, '2018-06-09 13:24:56'),
(84, 0, 1, 0, 0, 0, '2018-06-09 13:25:52'),
(85, 0, 3, 0, 0, 0, '2018-06-09 22:16:34'),
(86, 0, 0, 0, 0, 0, '2018-06-19 13:55:10'),
(87, 0, 1, 0, 0, 0, '2018-06-21 16:08:52'),
(88, 0, 1, 0, 0, 0, '2018-07-04 09:49:15'),
(89, 0, 19, 0, 0, 0, '2018-07-11 09:52:49'),
(90, 0, 20, 0, 0, 0, '2018-07-11 15:07:43'),
(91, 0, 1, 0, 0, 0, '2018-07-12 10:17:04'),
(92, 0, 6, 0, 0, 0, '2018-07-19 18:10:01'),
(93, 0, 3, 0, 0, 0, '2018-07-19 18:40:05'),
(94, 0, 1, 0, 0, 0, '2018-07-19 19:15:54'),
(95, 0, 16, 0, 0, 0, '2018-07-19 19:19:43'),
(96, 0, 19, 0, 0, 0, '2018-08-02 05:09:17'),
(97, 0, 21, 0, 0, 0, '2018-08-02 05:34:04'),
(98, 0, 20, 0, 0, 0, '2018-08-02 05:43:59'),
(99, 0, 19, 0, 0, 0, '2018-08-02 05:44:20'),
(100, 1, 20, 99, 1, 3464, '2018-08-02 05:45:15'),
(101, 1, 19, 99, 1, 3465, '2018-08-02 22:07:39'),
(102, 0, 6, 0, 0, 0, '2018-08-03 01:30:52'),
(103, 1, 20, 99, 1, 3466, '2018-08-08 12:15:47'),
(104, 0, 1, 0, 0, 0, '2018-08-12 07:15:32'),
(105, 0, 10, 0, 0, 0, '2018-08-16 09:24:15'),
(106, 0, 2, 0, 0, 0, '2018-08-16 09:24:50'),
(107, 0, 19, 0, 0, 0, '2018-08-26 11:02:50'),
(108, 0, 19, 0, 0, 0, '2018-08-28 06:12:44'),
(109, 0, 20, 0, 0, 0, '2018-08-28 06:13:56'),
(110, 0, 3, 0, 0, 0, '2018-08-30 03:38:40'),
(111, 0, 20, 0, 0, 0, '2018-09-04 06:13:31'),
(112, 0, 19, 0, 0, 0, '2018-09-06 11:23:01'),
(113, 0, 16, 0, 0, 0, '2018-09-13 10:06:53'),
(114, 0, 3, 0, 0, 0, '2018-09-16 04:08:21'),
(115, 0, 3, 0, 0, 0, '2018-09-16 04:09:53'),
(119, 0, 0, 0, 0, 0, '2018-09-20 08:13:38'),
(120, 0, 0, 0, 0, 0, '2018-09-20 08:13:40'),
(121, 0, 10, 0, 0, 0, '2018-09-20 08:14:06'),
(122, 0, 19, 0, 0, 0, '2018-09-29 21:33:13'),
(123, 0, 13, 0, 0, 0, '2018-10-19 20:26:32'),
(124, 0, 1, 0, 0, 0, '2018-10-20 07:33:45'),
(125, 0, 21, 0, 0, 0, '2018-10-24 22:55:52'),
(126, 0, 21, 0, 0, 0, '2018-10-24 23:06:59'),
(127, 0, 21, 0, 0, 0, '2018-10-25 01:46:28'),
(128, 0, 10, 0, 0, 0, '2018-10-27 02:56:28'),
(129, 1, 1, 179, 2, 3467, '2018-10-30 01:16:59'),
(130, 1, 1, 179, 1, 3467, '2018-10-30 01:17:00'),
(131, 0, 2, 0, 0, 0, '2018-10-30 03:28:47'),
(132, 0, 19, 0, 0, 0, '2018-10-30 03:30:23'),
(133, 0, 10, 0, 0, 0, '2018-11-07 23:24:23'),
(134, 0, 16, 0, 0, 0, '2018-11-07 23:24:37'),
(135, 19, 18, 899, 1, 3469, '2018-11-14 06:32:48'),
(136, 19, 16, 159, 1, 3469, '2018-11-14 06:33:28'),
(137, 19, 12, 899, 1, 3469, '2018-11-14 06:33:55'),
(138, 0, 21, 0, 0, 0, '2018-11-18 08:24:17'),
(139, 0, 1, 0, 0, 0, '2018-11-29 20:54:51'),
(140, 0, 20, 0, 0, 0, '2018-12-09 02:24:11'),
(141, 0, 10, 0, 0, 0, '2018-12-09 02:24:23'),
(142, 0, 0, 0, 0, 0, '2018-12-22 00:47:46'),
(143, 0, 4, 0, 0, 0, '2018-12-22 00:48:07'),
(144, 0, 0, 0, 0, 0, '2018-12-22 07:49:45'),
(145, 0, 4, 0, 0, 0, '2019-01-08 02:31:06'),
(147, 16, 1, 179, 1, 3470, '2019-01-12 08:16:20'),
(148, 0, 19, 0, 0, 0, '2019-01-19 02:26:59'),
(149, 0, 3, 0, 0, 0, '2019-02-04 21:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `ts_coupon_codes`
--

CREATE TABLE `ts_coupon_codes` (
  `ts_coupon_code` int(10) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_money` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_coupon_codes`
--

INSERT INTO `ts_coupon_codes` (`ts_coupon_code`, `coupon_name`, `coupon_money`) VALUES
(1, 'bb10', '10'),
(2, 'bb30', '30'),
(3, 'loyal50', '50');

-- --------------------------------------------------------

--
-- Table structure for table `ts_loyalty_points`
--

CREATE TABLE `ts_loyalty_points` (
  `loyalty_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ts_order_id` bigint(10) NOT NULL,
  `payable_money` varchar(255) NOT NULL,
  `loyalty_flow_id` int(10) NOT NULL,
  `loyalty_point` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_loyalty_points`
--

INSERT INTO `ts_loyalty_points` (`loyalty_id`, `user_id`, `ts_order_id`, `payable_money`, `loyalty_flow_id`, `loyalty_point`, `created_at`) VALUES
(1, 1, 1, '2605', 1, '130.25', '2018-04-02 01:11:46'),
(2, 1, 2, '1445', 2, '50', '2018-04-02 01:12:40'),
(3, 1, 2, '1445', 1, '72.25', '2018-04-02 01:12:40'),
(4, 6, 3, '179', 1, '8.95', '2018-04-03 15:25:47'),
(5, 7, 4, '198', 1, '9.9', '2018-04-20 12:56:33'),
(6, 6, 5, '179', 1, '8.95', '2018-04-26 21:16:31'),
(7, 9, 6, '99', 1, '4.95', '2018-04-27 13:24:45'),
(8, 1, 9, '198', 1, '9.9', '2018-05-13 22:39:32'),
(9, 14, 3463, '396', 1, '19.8', '2018-06-05 13:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `ts_menu_details`
--

CREATE TABLE `ts_menu_details` (
  `ts_menu_details_id` int(10) NOT NULL,
  `outlet_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `ppl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_menu_details`
--

INSERT INTO `ts_menu_details` (`ts_menu_details_id`, `outlet_id`, `menu_id`, `qty`, `price`, `comment`, `ppl`) VALUES
(1, 1, 1, 'Full Plate', '179', '4 piece chicken', '2'),
(2, 1, 1, 'Half Kg', '639', '10 piece chicken', '5'),
(3, 1, 1, 'One Kg', '1249', '20 piece chicken', '10'),
(4, 1, 2, 'Full Plate', '189', '6 piece chicken', '2'),
(5, 1, 2, 'Half Kg', '679', '16 piece chicken', '5'),
(6, 1, 2, 'One Kg', '1299', '32 piece chicken', '10'),
(7, 1, 3, 'Full Plate', '159', '4 piece egg', '2'),
(8, 1, 3, 'Half Kg', '479', '10 piece egg', '5'),
(9, 1, 3, 'One Kg', '899', '20 piece egg', '10'),
(10, 1, 4, 'Full Plate', '179', '100 gm paneer', '2'),
(11, 1, 4, 'Half Kg', '459', '500 gm paneer', '5'),
(12, 1, 4, 'One Kg', '899', '1000 gm paneer', '10'),
(13, 1, 5, 'Full Plate', '299', '4 piece mutton', '2'),
(14, 1, 5, 'Half Kg', '749', '10 piece mutton', '5'),
(15, 1, 5, 'One Kg', '1449', '20 piece mutton', '10'),
(16, 1, 6, 'Full Plate', '159', '100 gm veg', '2'),
(17, 1, 6, 'Half Kg', '499', '500 gm veg', '4'),
(18, 1, 6, 'One Kg', '899', '1000 gm veg', '8'),
(19, 2, 7, 'One Portion', '99', '3 piece chicken', '1'),
(20, 3, 7, 'One Portion', '99', '3 piece chicken', '1'),
(21, 4, 7, 'One Portion', '99', '3 piece chicken', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ts_orders`
--

CREATE TABLE `ts_orders` (
  `ts_order_id` bigint(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `total_moeny` int(10) NOT NULL,
  `coupon_money` int(10) NOT NULL,
  `payable_money` int(10) NOT NULL,
  `ts_address_id` int(10) NOT NULL,
  `transaction_status_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_orders`
--

INSERT INTO `ts_orders` (`ts_order_id`, `user_id`, `total_moeny`, `coupon_money`, `payable_money`, `ts_address_id`, `transaction_status_id`, `created_at`) VALUES
(1, 1, 2605, 0, 2605, 1, 1, '2018-04-02 01:11:46'),
(2, 1, 1495, 50, 1445, 17, 1, '2018-04-02 01:12:40'),
(3, 6, 179, 0, 179, 22, 1, '2018-04-03 15:25:47'),
(4, 7, 198, 0, 198, 23, 1, '2018-04-20 12:56:33'),
(5, 6, 179, 0, 179, 22, 1, '2018-04-26 21:16:31'),
(6, 9, 99, 0, 99, 24, 1, '2018-04-27 13:24:45'),
(7, 1, 99, 0, 99, 17, 2, '2018-05-13 22:32:29'),
(8, 1, 198, 0, 198, 17, 2, '2018-05-13 22:39:19'),
(9, 1, 198, 0, 198, 17, 1, '2018-05-13 22:39:32'),
(10, 1, 99, 0, 99, 1, 2, '2018-05-14 00:41:08'),
(3456, 1, 99, 0, 99, 17, 2, '2018-05-14 00:48:26'),
(3457, 1, 99, 10, 89, 17, 2, '2018-05-14 11:43:13'),
(3458, 5, 179, 0, 179, 21, 2, '2018-05-16 01:49:38'),
(3459, 1, 1498, 0, 1498, 1, 2, '2018-05-16 15:58:22'),
(3460, 12, 1249, 0, 1249, 26, 2, '2018-05-18 12:00:03'),
(3461, 12, 1249, 0, 1249, 26, 1, '2018-05-18 12:00:29'),
(3462, 14, 396, 0, 396, 27, 2, '2018-06-05 13:09:43'),
(3463, 14, 396, 0, 396, 27, 1, '2018-06-05 13:09:52'),
(3464, 1, 99, 0, 99, 1, 2, '2018-08-02 05:45:35'),
(3465, 1, 99, 0, 99, 1, 2, '2018-08-02 22:08:24'),
(3466, 1, 99, 0, 99, 1, 2, '2018-08-08 12:16:00'),
(3467, 1, 537, 10, 527, 1, 2, '2018-10-30 01:22:03'),
(3468, 19, 1957, 0, 1957, 28, 2, '2018-11-14 06:36:46'),
(3469, 19, 1957, 0, 1957, 28, 2, '2018-11-14 06:37:16'),
(3470, 16, 179, 0, 179, 29, 2, '2019-01-12 08:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `ts_otps`
--

CREATE TABLE `ts_otps` (
  `ts_otp_id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_expired` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_otps`
--

INSERT INTO `ts_otps` (`ts_otp_id`, `mobile`, `otp`, `is_expired`, `created_at`) VALUES
(1, '9762373871', '769094', '1', '2018-04-02 02:42:25'),
(2, '9860254435', '987338', '1', '2018-04-26 21:15:27'),
(3, '9999422861', '559357', '1', '2019-01-12 08:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `ts_subscribers`
--

CREATE TABLE `ts_subscribers` (
  `subscribers_id` int(10) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_subscribers`
--

INSERT INTO `ts_subscribers` (`subscribers_id`, `mobile`, `created_at`) VALUES
(1, '9762373871', '2018-03-27 14:25:38'),
(2, '8888999714', '2018-06-05 11:03:21'),
(3, '9881993389', '2018-07-04 09:44:40'),
(4, '8805595915', '2018-07-04 09:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `ts_users`
--

CREATE TABLE `ts_users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_users`
--

INSERT INTO `ts_users` (`user_id`, `name`, `mobile`, `email`, `password`, `user_type_id`, `created_at`) VALUES
(1, 'Nikhil', '9470668481', 'emailnkv@gmail.com', 'a69db5ed603b69408305d19006e144bf', 1, '2018-03-26 02:01:12'),
(2, 'Manish', '8007464285', 'luv2manish@gmail.com', '4547553f32bf9448fe49caceac38df3b', 1, '2018-03-27 09:38:39'),
(3, 'Apurv Dhumal', '9762373871', 'apurvdhumal@gmail.com', '0f1e21512f60b7740dc898ec54a64ee8', 2, '2018-03-27 14:24:52'),
(4, 'Apurv Dhumal', '9762373871', 'apurvdhumal@gmail.com', '0f1e21512f60b7740dc898ec54a64ee8', 1, '2018-03-27 14:26:50'),
(5, 'ashish Yelmote', '1234567890', 'a@a.com', '3f567f2443ebce4e173595466953ee35', 1, '2018-03-29 03:38:42'),
(6, 'Shailander Singh ', '9860254435', 'shailander.shaily@gmail.com', 'e12f36920a90ae57b5f9bd0e60ef521b', 1, '2018-04-03 15:24:25'),
(7, 'Tejpal Vinayak Sawant', '9527159759', 'fastliz@gmail.com', '9707339f013f10f615bed88f9406317d', 1, '2018-04-06 20:52:15'),
(8, 'Jaijo', '9970890321', 'mannpuramjaijo@gmail.com', '1e4e9699396bd5217cdf22e4e49094b4', 1, '2018-04-22 14:03:53'),
(9, 'Vishal Marathe', '9764575500', 'vishal.marathe@flipick.com', '8b30999f2ae37cd39a72758c57c5e7cf', 1, '2018-04-27 13:22:31'),
(10, 'B', '7028983871', 'b@b.com', '8851cdf9aec1982997d9a0491404104a', 1, '2018-05-08 21:31:34'),
(11, 'A', '7028983871', 'a@a.com', '370325e0acda541e3e5fcd45e267d2bd', 2, '2018-05-13 10:48:22'),
(12, 'Ramesh Chinnaiyan', '8600095522', 'ramesh.a282@gmail.com', 'aafee79e059927cf625856525f45d1c5', 1, '2018-05-18 11:57:39'),
(13, 'Apurv Dhumal', '9632587412', 'b@b.com', '3f567f2443ebce4e173595466953ee35', 2, '2018-05-18 19:23:11'),
(14, 'dfasfas', '1321321345', 'asfas@asdas.fdgdg', 'a989ed30b315bc5567cb0f9a1c66758f', 1, '2018-06-05 13:08:55'),
(15, 'Abcs', '1234567890', 'c@c.com', '29c42773cb16bffe8cc141d8065cd24f', 2, '2018-06-26 16:49:29'),
(16, 'Shashank Anand', '9999422861', 'shashank.anand47@gmail.com', '60ff2484f69931f408a2d49724d5c658', 1, '2018-08-04 06:02:38'),
(17, 'a', '9876543210', 'e@e.com', '59f0aa872713018dcf302a6cf99d66ec', 2, '2018-08-13 12:53:18'),
(18, 'dsgsh', '7865412365', 'A@k.com', '95c48394bdaa835870e599ea65d7d50a', 2, '2018-08-15 07:26:22'),
(19, 'Sachin Singare', '9850283589', 'sachin.singare@gmail.com', 'f7135f10b3a1daa3291304e502cd2247', 1, '2018-11-14 06:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `ts_users_address`
--

CREATE TABLE `ts_users_address` (
  `ts_address_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_users_address`
--

INSERT INTO `ts_users_address` (`ts_address_id`, `user_id`, `name`, `mobile`, `address_line_1`, `address_line_2`, `city`, `country`, `pincode`) VALUES
(1, 1, 'Nikhil', '9470668481', '#32 1st main 4th cross', 'Roopena Agrahara', 'Pune', 'India', '45606'),
(2, 4, 'Apurv Dhumal', '9762373871', 'asaf', 'asasfasf', 'Pune', 'India', '411033'),
(6, 4, 'Apurv Dhumal', '9762373871', 'rafsdgh', 'sdfghj', 'Pune', 'India', '413521'),
(7, 4, 'Apurv Dhumal', '9762373871', 'zddfas', 'asdasd', 'Pune', 'India', '413512'),
(8, 4, 'Apurv Dhumal', '9762373871', 'scascasc', 'ascasfasf', 'Pune', 'India', '413215'),
(9, 4, 'Apurv Dhumal', '9762373871', 'vjhgjhbjh', 'hhkjhkj', 'Pune', 'India', '413512'),
(10, 4, 'Apurv Dhumal', '8975538675', 'kjhkjkj', ',njnkj', 'Pune', 'India', '411033'),
(11, 4, 'Apurv Dhumal', '8975538675', 'gvjhvjhj', ',nmnbmnbm', 'Pune', 'India', '411033'),
(12, 4, 'Apurv Dhumal', '8975538675', 'gvjhvjhj', ',nmnbmnbm', 'Pune', 'India', '411033'),
(13, 4, 'Apurv Dhumal', '8975538675', 'gvjhvjhj', ',nmnbmnbm', 'Pune', 'India', '411033'),
(14, 4, 'Apurv Dhumal', '8975538675', 'gvjhvjhj', ',nmnbmnbm', 'Pune', 'India', '411033'),
(15, 4, 'Apurv Dhumal', '8975538675', 'gvjhvjhj', ',nmnbmnbm', 'Pune', 'India', '411033'),
(17, 1, 'Nikhil', '9470668481', '#32 1st main 4th cross', 'Roopena', 'Pune', 'India', '8643'),
(20, 2, 'Manish', '8007464285', 'K 601 Marval fria', 'Wagholi', 'Pune', 'India', '412207'),
(21, 5, 'ashish Yelmote', '1234567890', 'wersrdtrd', 'hgjhgy', 'Pune', 'India', '411033'),
(22, 6, 'Shailander Singh ', '9860254435', 'F - 701, Savannah Society', 'Baif Road ', 'Pune', 'India', '412207'),
(23, 7, 'Tejpal Vinayak Sawant', '9527159759', 'CAPTAIN NIWAS,Near Rakshak Nagar Phase 3, Kharadi Road, Kharadi', 'Near JK wine shop', 'Pune', 'India', '411014'),
(24, 9, 'Vishal Marathe', '9764575500', '2nd Floor, Beta Building, Giga Space IT Park. Viman Nagar. Pune', 'Viman Nagar', 'Pune', 'India', 'XXXXXX'),
(25, 10, 'B', '7028983871', 'A', 'A', 'Pune', 'India', '413512'),
(26, 12, 'Ramesh Chinnaiyan', '8600095522', 'B2-1003, Nyati Elan, Bakori Road, Near JSPM College,', 'Bakori Road, Wagholi', 'Pune', 'India', '412207'),
(27, 14, 'Harinder Singh', '1321321345', 'asd dsa sas', ' sad as das d', 'Pune', 'India', '160020'),
(28, 19, 'Sachin Singare', '9850283589', 'Bharat Forge Housing Society 17', 'Vimannagar', 'Pune', 'India', '411014'),
(29, 16, 'Shashank Anand', '9999422861', 'C2-403, Majestique City', 'Wagholi', 'Pune', 'India', '412207');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_loyalty_flow`
--
ALTER TABLE `ms_loyalty_flow`
  ADD PRIMARY KEY (`loyalty_flow_id`);

--
-- Indexes for table `ms_menus`
--
ALTER TABLE `ms_menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `ms_outlets`
--
ALTER TABLE `ms_outlets`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `ms_transaction_status`
--
ALTER TABLE `ms_transaction_status`
  ADD PRIMARY KEY (`transaction_status_id`);

--
-- Indexes for table `ms_user_types`
--
ALTER TABLE `ms_user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `ts_cart`
--
ALTER TABLE `ts_cart`
  ADD PRIMARY KEY (`ts_cart_id`);

--
-- Indexes for table `ts_coupon_codes`
--
ALTER TABLE `ts_coupon_codes`
  ADD PRIMARY KEY (`ts_coupon_code`);

--
-- Indexes for table `ts_loyalty_points`
--
ALTER TABLE `ts_loyalty_points`
  ADD PRIMARY KEY (`loyalty_id`);

--
-- Indexes for table `ts_menu_details`
--
ALTER TABLE `ts_menu_details`
  ADD PRIMARY KEY (`ts_menu_details_id`);

--
-- Indexes for table `ts_orders`
--
ALTER TABLE `ts_orders`
  ADD PRIMARY KEY (`ts_order_id`);

--
-- Indexes for table `ts_otps`
--
ALTER TABLE `ts_otps`
  ADD PRIMARY KEY (`ts_otp_id`);

--
-- Indexes for table `ts_subscribers`
--
ALTER TABLE `ts_subscribers`
  ADD PRIMARY KEY (`subscribers_id`);

--
-- Indexes for table `ts_users`
--
ALTER TABLE `ts_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ts_users_address`
--
ALTER TABLE `ts_users_address`
  ADD PRIMARY KEY (`ts_address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_loyalty_flow`
--
ALTER TABLE `ms_loyalty_flow`
  MODIFY `loyalty_flow_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_menus`
--
ALTER TABLE `ms_menus`
  MODIFY `menu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ms_outlets`
--
ALTER TABLE `ms_outlets`
  MODIFY `outlet_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_transaction_status`
--
ALTER TABLE `ms_transaction_status`
  MODIFY `transaction_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_user_types`
--
ALTER TABLE `ms_user_types`
  MODIFY `user_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ts_cart`
--
ALTER TABLE `ts_cart`
  MODIFY `ts_cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `ts_coupon_codes`
--
ALTER TABLE `ts_coupon_codes`
  MODIFY `ts_coupon_code` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ts_loyalty_points`
--
ALTER TABLE `ts_loyalty_points`
  MODIFY `loyalty_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ts_menu_details`
--
ALTER TABLE `ts_menu_details`
  MODIFY `ts_menu_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ts_orders`
--
ALTER TABLE `ts_orders`
  MODIFY `ts_order_id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3471;

--
-- AUTO_INCREMENT for table `ts_otps`
--
ALTER TABLE `ts_otps`
  MODIFY `ts_otp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ts_subscribers`
--
ALTER TABLE `ts_subscribers`
  MODIFY `subscribers_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ts_users`
--
ALTER TABLE `ts_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ts_users_address`
--
ALTER TABLE `ts_users_address`
  MODIFY `ts_address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
