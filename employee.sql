-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 10:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` int(11) DEFAULT 0 COMMENT '0 = absent, 1 = present, 2 = half day, 3 = paid leave',
  `is_update` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `attendance_date`, `attendance_status`, `is_update`, `created_date`) VALUES
(1, 2, '2023-03-01', 1, 'updated', '2023-03-27 12:29:52'),
(2, 2, '2023-03-02', 1, 'updated', '2023-03-27 12:29:52'),
(3, 2, '2023-03-03', 1, 'updated', '2023-03-27 12:29:52'),
(4, 2, '2023-03-04', 3, 'updated', '2023-03-27 12:29:52'),
(5, 2, '2023-03-05', 3, 'updated', '2023-03-27 12:29:52'),
(6, 2, '2023-03-06', 1, 'updated', '2023-03-27 12:29:52'),
(7, 2, '2023-03-07', 1, 'updated', '2023-03-27 12:29:52'),
(8, 2, '2023-03-08', 3, 'updated', '2023-03-27 12:29:52'),
(9, 2, '2023-03-09', 2, 'updated', '2023-03-27 12:29:52'),
(10, 2, '2023-03-10', 1, 'updated', '2023-03-27 12:29:52'),
(11, 2, '2023-03-11', 3, 'updated', '2023-03-27 12:29:52'),
(12, 2, '2023-03-12', 0, 'not_updated', '2023-03-27 12:29:52'),
(13, 2, '2023-03-13', 1, 'updated', '2023-03-27 12:29:52'),
(14, 2, '2023-03-14', 2, 'updated', '2023-03-27 12:29:52'),
(15, 2, '2023-03-15', 1, 'updated', '2023-03-27 12:29:52'),
(16, 2, '2023-03-16', 1, 'updated', '2023-03-27 12:29:52'),
(17, 2, '2023-03-17', 2, 'updated', '2023-03-27 12:29:52'),
(18, 2, '2023-03-18', 3, 'updated', '2023-03-27 12:29:52'),
(19, 2, '2023-03-19', 3, 'updated', '2023-03-27 12:29:52'),
(20, 2, '2023-03-20', 0, 'not_updated', '2023-03-27 12:29:52'),
(21, 2, '2023-03-21', 0, 'not_updated', '2023-03-27 12:29:52'),
(22, 2, '2023-03-22', 0, 'not_updated', '2023-03-27 12:29:52'),
(23, 2, '2023-03-23', 0, 'not_updated', '2023-03-27 12:29:52'),
(24, 2, '2023-03-24', 1, 'medical_leave', '2023-03-27 12:29:52'),
(25, 2, '2023-03-25', 1, 'updated', '2023-03-27 12:29:52'),
(26, 2, '2023-03-26', 1, 'updated', '2023-03-27 12:29:52'),
(27, 2, '2023-03-27', 0, 'on_leave', '2023-03-27 12:29:52'),
(28, 2, '2023-03-28', 0, 'on_leave', '2023-03-27 12:29:52'),
(29, 2, '2023-03-29', 0, 'on_leave', '2023-03-27 12:29:52'),
(30, 2, '2023-03-30', 0, 'on_leave', '2023-03-27 12:29:52'),
(31, 2, '2023-03-31', 0, 'on_leave', '2023-03-27 12:29:52'),
(32, 3, '2023-03-01', 0, 'not_updated', '2023-03-27 12:30:28'),
(33, 3, '2023-03-02', 0, 'not_updated', '2023-03-27 12:30:28'),
(34, 3, '2023-03-03', 0, 'not_updated', '2023-03-27 12:30:28'),
(35, 3, '2023-03-04', 3, 'updated', '2023-03-27 12:30:28'),
(36, 3, '2023-03-05', 3, 'updated', '2023-03-27 12:30:28'),
(37, 3, '2023-03-06', 0, 'not_updated', '2023-03-27 12:30:28'),
(38, 3, '2023-03-07', 0, 'not_updated', '2023-03-27 12:30:28'),
(39, 3, '2023-03-08', 3, 'updated', '2023-03-27 12:30:28'),
(40, 3, '2023-03-09', 0, 'not_updated', '2023-03-27 12:30:28'),
(41, 3, '2023-03-10', 0, 'not_updated', '2023-03-27 12:30:28'),
(42, 3, '2023-03-11', 3, 'updated', '2023-03-27 12:30:28'),
(43, 3, '2023-03-12', 0, 'not_updated', '2023-03-27 12:30:28'),
(44, 3, '2023-03-13', 0, 'not_updated', '2023-03-27 12:30:28'),
(45, 3, '2023-03-14', 0, 'not_updated', '2023-03-27 12:30:28'),
(46, 3, '2023-03-15', 0, 'not_updated', '2023-03-27 12:30:28'),
(47, 3, '2023-03-16', 0, 'not_updated', '2023-03-27 12:30:28'),
(48, 3, '2023-03-17', 0, 'not_updated', '2023-03-27 12:30:28'),
(49, 3, '2023-03-18', 3, 'updated', '2023-03-27 12:30:28'),
(50, 3, '2023-03-19', 3, 'updated', '2023-03-27 12:30:28'),
(51, 3, '2023-03-20', 0, 'not_updated', '2023-03-27 12:30:28'),
(52, 3, '2023-03-21', 0, 'not_updated', '2023-03-27 12:30:28'),
(53, 3, '2023-03-22', 0, 'not_updated', '2023-03-27 12:30:28'),
(54, 3, '2023-03-23', 0, 'not_updated', '2023-03-27 12:30:28'),
(55, 3, '2023-03-24', 0, 'not_updated', '2023-03-27 12:30:28'),
(56, 3, '2023-03-25', 3, 'updated', '2023-03-27 12:30:28'),
(57, 3, '2023-03-26', 3, 'updated', '2023-03-27 12:30:28'),
(58, 3, '2023-03-27', 0, 'not_updated', '2023-03-27 12:30:28'),
(59, 3, '2023-03-28', 0, 'not_updated', '2023-03-27 12:30:28'),
(60, 3, '2023-03-29', 0, 'not_updated', '2023-03-27 12:30:28'),
(61, 3, '2023-03-30', 0, 'not_updated', '2023-03-27 12:30:28'),
(62, 3, '2023-03-31', 0, 'not_updated', '2023-03-27 12:30:28'),
(63, 1, '2023-03-01', 0, 'not_updated', '2023-03-27 12:31:36'),
(64, 1, '2023-03-02', 0, 'not_updated', '2023-03-27 12:31:36'),
(65, 1, '2023-03-03', 0, 'not_updated', '2023-03-27 12:31:36'),
(66, 1, '2023-03-04', 3, 'updated', '2023-03-27 12:31:36'),
(67, 1, '2023-03-05', 3, 'updated', '2023-03-27 12:31:36'),
(68, 1, '2023-03-06', 0, 'not_updated', '2023-03-27 12:31:36'),
(69, 1, '2023-03-07', 0, 'not_updated', '2023-03-27 12:31:36'),
(70, 1, '2023-03-08', 3, 'updated', '2023-03-27 12:31:36'),
(71, 1, '2023-03-09', 0, 'not_updated', '2023-03-27 12:31:36'),
(72, 1, '2023-03-10', 0, 'not_updated', '2023-03-27 12:31:36'),
(73, 1, '2023-03-11', 3, 'updated', '2023-03-27 12:31:36'),
(74, 1, '2023-03-12', 0, 'not_updated', '2023-03-27 12:31:36'),
(75, 1, '2023-03-13', 0, 'not_updated', '2023-03-27 12:31:36'),
(76, 1, '2023-03-14', 0, 'not_updated', '2023-03-27 12:31:36'),
(77, 1, '2023-03-15', 0, 'not_updated', '2023-03-27 12:31:36'),
(78, 1, '2023-03-16', 0, 'not_updated', '2023-03-27 12:31:36'),
(79, 1, '2023-03-17', 0, 'not_updated', '2023-03-27 12:31:36'),
(80, 1, '2023-03-18', 3, 'updated', '2023-03-27 12:31:36'),
(81, 1, '2023-03-19', 3, 'updated', '2023-03-27 12:31:36'),
(82, 1, '2023-03-20', 0, 'not_updated', '2023-03-27 12:31:36'),
(83, 1, '2023-03-21', 0, 'not_updated', '2023-03-27 12:31:36'),
(84, 1, '2023-03-22', 0, 'not_updated', '2023-03-27 12:31:36'),
(85, 1, '2023-03-23', 0, 'not_updated', '2023-03-27 12:31:36'),
(86, 1, '2023-03-24', 0, 'not_updated', '2023-03-27 12:31:36'),
(87, 1, '2023-03-25', 3, 'updated', '2023-03-27 12:31:36'),
(88, 1, '2023-03-26', 3, 'updated', '2023-03-27 12:31:36'),
(89, 1, '2023-03-27', 2, 'updated', '2023-03-27 12:31:36'),
(90, 1, '2023-03-28', 0, 'not_updated', '2023-03-27 12:31:36'),
(91, 1, '2023-03-29', 0, 'not_updated', '2023-03-27 12:31:36'),
(92, 1, '2023-03-30', 0, 'not_updated', '2023-03-27 12:31:36'),
(93, 1, '2023-03-31', 0, 'not_updated', '2023-03-27 12:31:36'),
(94, 2, '2023-04-01', 3, 'updated', '2023-04-03 10:49:05'),
(95, 2, '2023-04-02', 3, 'updated', '2023-04-03 10:49:05'),
(96, 2, '2023-04-03', 2, 'updated', '2023-04-03 10:49:05'),
(97, 2, '2023-04-04', 0, 'not_updated', '2023-04-03 10:49:05'),
(98, 2, '2023-04-05', 2, 'updated', '2023-04-03 10:49:05'),
(99, 2, '2023-04-06', 0, 'not_updated', '2023-04-03 10:49:05'),
(100, 2, '2023-04-07', 0, 'not_updated', '2023-04-03 10:49:05'),
(101, 2, '2023-04-08', 3, 'updated', '2023-04-03 10:49:05'),
(102, 2, '2023-04-09', 3, 'updated', '2023-04-03 10:49:05'),
(103, 2, '2023-04-10', 2, 'updated', '2023-04-03 10:49:05'),
(104, 2, '2023-04-11', 0, 'not_updated', '2023-04-03 10:49:05'),
(105, 2, '2023-04-12', 0, 'not_updated', '2023-04-03 10:49:05'),
(106, 2, '2023-04-13', 0, 'not_updated', '2023-04-03 10:49:05'),
(107, 2, '2023-04-14', 0, 'not_updated', '2023-04-03 10:49:05'),
(108, 2, '2023-04-15', 3, 'updated', '2023-04-03 10:49:05'),
(109, 2, '2023-04-16', 3, 'updated', '2023-04-03 10:49:05'),
(110, 2, '2023-04-17', 0, 'not_updated', '2023-04-03 10:49:05'),
(111, 2, '2023-04-18', 0, 'not_updated', '2023-04-03 10:49:05'),
(112, 2, '2023-04-19', 0, 'not_updated', '2023-04-03 10:49:05'),
(113, 2, '2023-04-20', 0, 'not_updated', '2023-04-03 10:49:05'),
(114, 2, '2023-04-21', 0, 'not_updated', '2023-04-03 10:49:05'),
(115, 2, '2023-04-22', 3, 'updated', '2023-04-03 10:49:05'),
(116, 2, '2023-04-23', 3, 'updated', '2023-04-03 10:49:05'),
(117, 2, '2023-04-24', 0, 'not_updated', '2023-04-03 10:49:05'),
(118, 2, '2023-04-25', 0, 'not_updated', '2023-04-03 10:49:05'),
(119, 2, '2023-04-26', 0, 'not_updated', '2023-04-03 10:49:05'),
(120, 2, '2023-04-27', 0, 'not_updated', '2023-04-03 10:49:05'),
(121, 2, '2023-04-28', 0, 'not_updated', '2023-04-03 10:49:05'),
(122, 2, '2023-04-29', 3, 'updated', '2023-04-03 10:49:05'),
(123, 2, '2023-04-30', 3, 'updated', '2023-04-03 10:49:05'),
(124, 3, '2023-04-01', 3, 'updated', '2023-04-03 11:14:33'),
(125, 3, '2023-04-02', 3, 'updated', '2023-04-03 11:14:33'),
(126, 3, '2023-04-03', 2, 'updated', '2023-04-03 11:14:33'),
(127, 3, '2023-04-04', 0, 'not_updated', '2023-04-03 11:14:33'),
(128, 3, '2023-04-05', 0, 'not_updated', '2023-04-03 11:14:33'),
(129, 3, '2023-04-06', 0, 'not_updated', '2023-04-03 11:14:33'),
(130, 3, '2023-04-07', 0, 'not_updated', '2023-04-03 11:14:33'),
(131, 3, '2023-04-08', 3, 'updated', '2023-04-03 11:14:33'),
(132, 3, '2023-04-09', 3, 'updated', '2023-04-03 11:14:33'),
(133, 3, '2023-04-10', 0, 'not_updated', '2023-04-03 11:14:33'),
(134, 3, '2023-04-11', 0, 'not_updated', '2023-04-03 11:14:33'),
(135, 3, '2023-04-12', 0, 'not_updated', '2023-04-03 11:14:33'),
(136, 3, '2023-04-13', 0, 'not_updated', '2023-04-03 11:14:33'),
(137, 3, '2023-04-14', 0, 'not_updated', '2023-04-03 11:14:33'),
(138, 3, '2023-04-15', 3, 'updated', '2023-04-03 11:14:33'),
(139, 3, '2023-04-16', 3, 'updated', '2023-04-03 11:14:33'),
(140, 3, '2023-04-17', 0, 'not_updated', '2023-04-03 11:14:33'),
(141, 3, '2023-04-18', 0, 'not_updated', '2023-04-03 11:14:33'),
(142, 3, '2023-04-19', 0, 'not_updated', '2023-04-03 11:14:33'),
(143, 3, '2023-04-20', 0, 'not_updated', '2023-04-03 11:14:33'),
(144, 3, '2023-04-21', 0, 'not_updated', '2023-04-03 11:14:33'),
(145, 3, '2023-04-22', 3, 'updated', '2023-04-03 11:14:33'),
(146, 3, '2023-04-23', 3, 'updated', '2023-04-03 11:14:33'),
(147, 3, '2023-04-24', 0, 'not_updated', '2023-04-03 11:14:33'),
(148, 3, '2023-04-25', 0, 'not_updated', '2023-04-03 11:14:33'),
(149, 3, '2023-04-26', 0, 'not_updated', '2023-04-03 11:14:33'),
(150, 3, '2023-04-27', 0, 'not_updated', '2023-04-03 11:14:33'),
(151, 3, '2023-04-28', 0, 'not_updated', '2023-04-03 11:14:33'),
(152, 3, '2023-04-29', 3, 'updated', '2023-04-03 11:14:33'),
(153, 3, '2023-04-30', 3, 'updated', '2023-04-03 11:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_type` int(11) NOT NULL COMMENT '1 = one day , 2 = multiple day',
  `holiday_start_date` date NOT NULL,
  `holiday_end_date` date NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday_name`, `holiday_type`, `holiday_start_date`, `holiday_end_date`, `created_date`) VALUES
(1, 'Holi', 1, '2023-03-08', '2023-03-08', '2023-03-28 12:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `leaves_count`
--

CREATE TABLE `leaves_count` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medical_leave` int(11) NOT NULL DEFAULT 1,
  `paid_leave` int(11) NOT NULL DEFAULT 1,
  `total_medical_leave` int(11) NOT NULL,
  `total_paid_leave` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaves_count`
--

INSERT INTO `leaves_count` (`id`, `user_id`, `medical_leave`, `paid_leave`, `total_medical_leave`, `total_paid_leave`, `created_date`) VALUES
(1, 2, 0, 1, 0, 0, '2023-03-22 16:38:10'),
(2, 3, 0, 1, 0, 0, '2023-03-24 13:10:16'),
(3, 1, 1, 1, 0, 0, '2023-03-27 18:47:40'),
(4, 2, 1, 1, 0, 0, '2023-04-10 13:08:12'),
(5, 3, 1, 1, 0, 0, '2023-04-10 13:08:30'),
(6, 1, 1, 1, 0, 0, '2023-04-10 15:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `leave_data`
--

CREATE TABLE `leave_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_reason` varchar(255) NOT NULL,
  `leave_description` text NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `leave_start_date` date NOT NULL,
  `leave_end_date` date DEFAULT NULL,
  `total_days` varchar(255) NOT NULL,
  `leave_status` varchar(255) NOT NULL DEFAULT 'pending',
  `leave_reject_reason` varchar(255) NOT NULL,
  `read_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_data`
--

INSERT INTO `leave_data` (`id`, `user_id`, `leave_reason`, `leave_description`, `leave_type`, `leave_start_date`, `leave_end_date`, `total_days`, `leave_status`, `leave_reject_reason`, `read_status`, `created_date`) VALUES
(1, 2, '123', '123', 'Normal Leave', '2023-03-27', '2023-03-31', '4', 'Approve', '', 0, '2023-03-22 18:12:46'),
(2, 2, '123', '123', 'Paid Leave', '2023-03-23', '2023-03-23', '1', 'Pending', '', 0, '2023-03-22 18:36:27'),
(3, 2, '123', '123', 'Medical Leave', '2023-03-24', '2023-03-24', '1', 'Approve', '', 0, '2023-03-22 18:36:52'),
(4, 3, '123', '123', 'Medical Leave', '2023-03-27', '2023-03-27', '1', 'Pending', '', 0, '2023-03-24 13:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start` varchar(355) NOT NULL,
  `end` varchar(355) NOT NULL,
  `date` date NOT NULL,
  `month` date NOT NULL,
  `year` year(4) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '1 = pending, 0 = approved , 2 = reject',
  `is_deleted` varchar(255) NOT NULL,
  `total_hours` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `user_id`, `start`, `end`, `date`, `month`, `year`, `status`, `is_deleted`, `total_hours`, `created_date`) VALUES
(1, 2, '20:10', '21:15', '2023-03-21', '2023-03-21', 2023, '0', '1', '01:05:00', '2023-03-21 17:10:58'),
(2, 2, '20:20', '22:31', '2023-03-22', '2023-03-22', 2023, '0', '1', '02:11:00', '2023-03-22 10:31:56'),
(3, 3, '20:00', '21:37', '2023-03-24', '2023-03-24', 2023, '0', '1', '01:37:00', '2023-03-24 15:37:16'),
(4, 2, '20:00', '21:20', '2023-04-03', '2023-04-03', 2023, '0', '1', '01:20:00', '2023-04-03 11:52:30'),
(5, 2, '21:00', '22:10', '2023-04-04', '2023-04-04', 2023, '1', '1', '01:10:00', '2023-04-03 13:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `monthly_salary` varchar(255) NOT NULL,
  `daily_salary` varchar(255) NOT NULL,
  `total_salary` varchar(255) NOT NULL,
  `update_date` date NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `user_id`, `monthly_salary`, `daily_salary`, `total_salary`, `update_date`, `created_date`) VALUES
(1, 2, '17000', '566', '6611', '2023-04-06', '2023-03-16 13:03:33'),
(2, 3, '14000', '466', '3968', '2023-03-24', '2023-03-24 13:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_type` int(50) NOT NULL DEFAULT 1 COMMENT '1 = user, 2 = admin',
  `user_image` text NOT NULL,
  `monthly_salary` int(15) DEFAULT NULL,
  `daily_salary` int(15) NOT NULL DEFAULT 0,
  `user_status` varchar(50) NOT NULL DEFAULT '1' COMMENT '1 = active , 0 = deactive',
  `created_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Created time and date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`, `user_image`, `monthly_salary`, `daily_salary`, `user_status`, `created_date`) VALUES
(1, 'Admin    ', 'admin@gmail.com', '123', 2, 'img/white-curved.jpeg', NULL, 0, '1', '2023-03-15 11:34:08'),
(2, 'Jinal', 'jinalkansagara1@gmail.com', '123', 1, 'img/1.JPG', 17000, 566, '1', '2023-03-15 11:36:07'),
(3, '123 ', '123@gmail.com', '123', 1, 'img/bruce-mars.jpg', 14000, 466, '1', '2023-03-24 13:10:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves_count`
--
ALTER TABLE `leaves_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_data`
--
ALTER TABLE `leave_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leaves_count`
--
ALTER TABLE `leaves_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_data`
--
ALTER TABLE `leave_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
