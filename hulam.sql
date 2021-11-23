-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 04:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hulam`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announce_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_announce` datetime NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announce_id`, `user_id`, `date_announce`, `title`, `content`) VALUES
(1, 80, '2021-11-22 00:00:00', 'Announcement Sample', 'We are giving a Christmas bonus next week.'),
(2, 80, '2021-11-22 00:00:00', 'Interest rate will be lower than 1%.', 'We have decided to lower the interest rate effective next week. '),
(3, 80, '2021-11-22 00:00:00', 'This announcement is only a test.', 'Do you want a better rate to solve your financial problem.'),
(7, 80, '2021-11-22 02:44:13', 'fffffffff', 'ffffffffff'),
(10, 83, '2021-11-22 03:10:24', 'ppppppppppppppp', 'pppppppppppppppp');

-- --------------------------------------------------------

--
-- Table structure for table `debtors_info`
--

CREATE TABLE `debtors_info` (
  `user_id` int(11) NOT NULL,
  `monthly_salary` decimal(11,2) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_mobile` varchar(255) NOT NULL,
  `company_landline` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_street` varchar(255) NOT NULL,
  `company_barangay` varchar(255) NOT NULL,
  `company_city` varchar(255) NOT NULL,
  `company_province` varchar(255) NOT NULL,
  `company_zipcode` varchar(255) NOT NULL,
  `rel_name` varchar(255) NOT NULL,
  `rel_mobile` varchar(255) NOT NULL,
  `rel_type` varchar(255) NOT NULL,
  `valid_id` varchar(250) NOT NULL,
  `selfie_id` varchar(250) NOT NULL,
  `status_valid_id` varchar(50) NOT NULL,
  `status_selfie_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `debtors_info`
--

INSERT INTO `debtors_info` (`user_id`, `monthly_salary`, `company_name`, `company_mobile`, `company_landline`, `company_email`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `rel_name`, `rel_mobile`, `rel_type`, `valid_id`, `selfie_id`, `status_valid_id`, `status_selfie_id`) VALUES
(81, '20000.00', 'The Results Companies ', '09454909530', '4563698', 'aname522@gmail.com', 'Mactan', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', 'Rosel', '09454909530', 'Sister', '4811708.jpg', '268906.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `lender_id` int(100) NOT NULL,
  `debtor_id` int(100) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `ratings` varchar(250) NOT NULL,
  `dateOfRate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `lender_id`, `debtor_id`, `comments`, `ratings`, `dateOfRate`) VALUES
(8, 80, 81, 'Excellent Service.', '5', '2021-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `loan_application`
--

CREATE TABLE `loan_application` (
  `loan_app_id` int(11) NOT NULL,
  `debtor_id` int(50) NOT NULL,
  `lender_id` int(50) NOT NULL,
  `loan_amount` decimal(11,2) NOT NULL,
  `loan_term` int(11) NOT NULL,
  `fix_rate` decimal(11,2) NOT NULL,
  `total_amount` double(11,2) NOT NULL,
  `monthly_payment` decimal(11,2) NOT NULL,
  `total_interest` decimal(11,2) NOT NULL,
  `late_charges` decimal(11,2) NOT NULL,
  `date` datetime NOT NULL,
  `valid_id` varchar(250) NOT NULL,
  `barangay_clearance` varchar(250) NOT NULL,
  `payslip` varchar(250) NOT NULL,
  `cedula` varchar(250) NOT NULL,
  `atm_transaction` varchar(250) NOT NULL,
  `coe` varchar(250) NOT NULL,
  `bank_statement` varchar(250) NOT NULL,
  `proof_billing` varchar(250) NOT NULL,
  `co_maker_id` varchar(250) NOT NULL,
  `co_maker_cedula` varchar(250) NOT NULL,
  `id_pic` varchar(250) NOT NULL,
  `confirm` varchar(250) NOT NULL,
  `approval_date` datetime NOT NULL,
  `release_schedule` datetime DEFAULT NULL,
  `released_date` datetime NOT NULL,
  `loan_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_application`
--

INSERT INTO `loan_application` (`loan_app_id`, `debtor_id`, `lender_id`, `loan_amount`, `loan_term`, `fix_rate`, `total_amount`, `monthly_payment`, `total_interest`, `late_charges`, `date`, `valid_id`, `barangay_clearance`, `payslip`, `cedula`, `atm_transaction`, `coe`, `bank_statement`, `proof_billing`, `co_maker_id`, `co_maker_cedula`, `id_pic`, `confirm`, `approval_date`, `release_schedule`, `released_date`, `loan_status`) VALUES
(118, 81, 80, '30000.00', 12, '3.00', 40800.00, '3400.00', '10800.00', '5.00', '2021-11-23 16:04:35', '5336912.jpg', '', '', '', '', '', '', '', '', '', '', 'Yes', '2021-11-23 04:04:51', '2021-11-23 00:00:00', '2021-11-23 04:05:01', 'Released');

-- --------------------------------------------------------

--
-- Table structure for table `loan_features`
--

CREATE TABLE `loan_features` (
  `id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `min_loan` decimal(11,2) NOT NULL,
  `max_loan` decimal(11,2) NOT NULL,
  `min_term` int(11) NOT NULL,
  `max_term` int(11) NOT NULL,
  `fix_rate` decimal(11,2) NOT NULL,
  `late_charges` decimal(11,2) NOT NULL,
  `reloan_period` varchar(50) NOT NULL,
  `reloan_amount` decimal(11,2) NOT NULL,
  `description` text NOT NULL,
  `company_street` varchar(50) NOT NULL,
  `company_barangay` varchar(50) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `company_province` varchar(50) NOT NULL,
  `company_zipcode` varchar(50) NOT NULL,
  `company_landline` varchar(50) NOT NULL,
  `dti_permit` varchar(1000) NOT NULL,
  `b_permit` varchar(1000) NOT NULL,
  `valid_id` varchar(250) NOT NULL,
  `selfie_id` varchar(250) NOT NULL,
  `status_dti` varchar(50) NOT NULL,
  `status_b_permit` varchar(50) NOT NULL,
  `status_valid_id` varchar(50) NOT NULL,
  `status_selfie_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_features`
--

INSERT INTO `loan_features` (`id`, `lender_id`, `min_loan`, `max_loan`, `min_term`, `max_term`, `fix_rate`, `late_charges`, `reloan_period`, `reloan_amount`, `description`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `company_landline`, `dti_permit`, `b_permit`, `valid_id`, `selfie_id`, `status_dti`, `status_b_permit`, `status_valid_id`, `status_selfie_id`) VALUES
(51, 80, '30000.00', '40000.00', 12, 12, '3.00', '5.00', '8', '15000.00', 'We provide the best loan deals.', 'Behik Building', 'Quezon Highway', 'lapu-Lapu', 'Cebu', '6015', '4235689', '9035379.jpg', '8058830.jpg', '', '', '', '', '', ''),
(53, 83, '20000.00', '30000.00', 8, 10, '3.00', '5.00', '8', '10000.00', 'We offer salary loan with the lowest interest rate.', 'A & W Building', 'Looc Basak Rd', 'Lapu-Lapu City', 'Cebu', '6015', '4235689', '6165335.jpg', '8470903.jpg', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment_detail`
--

CREATE TABLE `loan_payment_detail` (
  `lp_Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_app_id` int(11) NOT NULL,
  `monthly_pay` decimal(10,0) NOT NULL,
  `payment` decimal(10,0) NOT NULL,
  `semi_payment1` decimal(10,0) NOT NULL,
  `semi_payment2` decimal(10,0) NOT NULL,
  `late_charge` decimal(10,0) NOT NULL,
  `paid_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_payment_detail`
--

INSERT INTO `loan_payment_detail` (`lp_Id`, `user_id`, `loan_app_id`, `monthly_pay`, `payment`, `semi_payment1`, `semi_payment2`, `late_charge`, `paid_date`, `due_date`, `status`) VALUES
(149, 81, 118, '3400', '3400', '0', '0', '170', '2022-01-23 04:06:00', '2021-12-23 00:00:00', 1),
(150, 81, 118, '3400', '3400', '0', '0', '0', '2022-01-23 04:06:00', '2022-01-23 00:00:00', 1),
(151, 81, 118, '3400', '3400', '1700', '1700', '0', '2022-02-23 04:08:00', '2022-02-23 00:00:00', 1),
(152, 81, 118, '3400', '3400', '1700', '1700', '0', '2022-04-24 04:14:00', '2022-03-23 00:00:00', 1),
(153, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-04-23 00:00:00', 0),
(154, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-05-23 00:00:00', 0),
(155, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-06-23 00:00:00', 0),
(156, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-07-23 00:00:00', 0),
(157, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-08-23 00:00:00', 0),
(158, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-09-23 00:00:00', 0),
(159, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-10-23 00:00:00', 0),
(160, 81, 118, '3400', '0', '0', '0', '0', '0000-00-00 00:00:00', '2022-11-23 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_receipt`
--

CREATE TABLE `loan_receipt` (
  `receipt_id` int(11) NOT NULL,
  `loan_app_id` int(11) NOT NULL,
  `receipt` varchar(1000) NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loan_requirements`
--

CREATE TABLE `loan_requirements` (
  `req_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `req_type_id` int(11) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_requirements`
--

INSERT INTO `loan_requirements` (`req_id`, `lender_id`, `req_type_id`, `remarks`) VALUES
(51, 80, 1, 'Upload Valid ID'),
(52, 80, 3, 'Atleast 2 months latest'),
(53, 80, 5, 'Latest transaction receipt'),
(56, 83, 1, 'Upload Valid ID'),
(57, 83, 2, 'Upload latest barangay clearance.gggg'),
(58, 83, 3, 'Upload at least 2months latest.'),
(59, 83, 12, 'No need to upload, this need to be submitted upon the releasing of loan.');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `date_message` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `message`, `date_message`) VALUES
(169, 80, 81, 'Your loan account number $loan_app_id payment is now posted. Thank You!', '2021-11-19 12:06:40'),
(170, 80, 81, 'Your payment for loan account number 115', '2021-11-19 12:07:59'),
(171, 80, 81, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 12:10:43'),
(172, 81, 80, 'Received Thanks.\r\n', '2021-11-19 12:15:02'),
(173, 80, 81, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 12:48:51'),
(174, 80, 81, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 12:51:02'),
(175, 80, 81, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 01:43:49'),
(176, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-19 02:36:39'),
(177, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 02:48:53'),
(178, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 03:23:54'),
(179, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 03:28:21'),
(180, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 03:29:48'),
(181, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 11:29:54'),
(182, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 11:30:26'),
(183, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 11:50:14'),
(184, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 12:05:38'),
(185, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 12:07:35'),
(186, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 12:18:48'),
(187, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 12:22:23'),
(188, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 12:26:34'),
(189, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 01:29:41'),
(190, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 01:41:48'),
(191, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 01:52:36'),
(192, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 02:08:44'),
(193, 80, 82, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-19 05:37:20'),
(194, 80, 82, 'Your loan is released! Thank you!', '2021-11-19 05:37:32'),
(195, 80, 82, 'Your loan is released! Thank you!', '2021-11-19 07:23:20'),
(196, 80, 82, 'Your loan is released! Thank you!', '2021-11-19 10:24:06'),
(197, 80, 82, 'Your loan is released! Thank you!', '2021-11-19 10:24:57'),
(198, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-19 11:18:13'),
(199, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-19 11:23:04'),
(200, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 01:06:48'),
(201, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 01:34:03'),
(202, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 01:36:53'),
(203, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:18:56'),
(204, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:20:51'),
(205, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:02'),
(206, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:07'),
(207, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:13'),
(208, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:22'),
(209, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:30'),
(210, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:37'),
(211, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:42'),
(212, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:21:49'),
(213, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:25:11'),
(214, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:29:35'),
(215, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:30:52'),
(216, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:32:48'),
(217, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:52:18'),
(218, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:55:44'),
(219, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 02:59:19'),
(220, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:02:40'),
(221, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:03:01'),
(222, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:03:14'),
(223, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:03:34'),
(224, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:03:42'),
(225, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:03:52'),
(226, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:04:01'),
(227, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:04:08'),
(228, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:04:15'),
(229, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:04:21'),
(230, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-20 03:04:30'),
(231, 0, 0, 'Additional Charge Php 170 for payment overdue.', '2021-11-20 09:23:28'),
(232, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 02:22:32'),
(233, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 02:30:57'),
(234, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 02:32:16'),
(235, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 11:01:34'),
(236, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 11:47:33'),
(237, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:16:50'),
(238, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:17:30'),
(239, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:45:44'),
(240, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:48:41'),
(241, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:53:32'),
(242, 0, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:55:51'),
(243, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:58:09'),
(244, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 12:59:51'),
(245, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:34:37'),
(246, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:40:04'),
(247, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:43:19'),
(248, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:44:31'),
(249, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:47:44'),
(250, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:48:49'),
(251, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:57:30'),
(252, 80, 0, 'Your payment for loan account number 116 is now posted. Thank You!', '2021-11-21 01:59:52'),
(253, 0, 0, '', '0000-00-00 00:00:00'),
(254, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-23 01:30:33'),
(255, 80, 81, 'Your loan is released! Thank you!', '2021-11-23 01:30:38'),
(256, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-23 03:47:14'),
(257, 80, 81, 'Your loan is released! Thank you!', '2021-11-23 03:47:39'),
(258, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-23 04:04:51'),
(259, 80, 81, 'Your loan is released! Thank you!', '2021-11-23 04:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `mode_payment`
--

CREATE TABLE `mode_payment` (
  `mode_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `mode_name` varchar(250) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mode_payment`
--

INSERT INTO `mode_payment` (`mode_id`, `lender_id`, `mode_name`, `remarks`) VALUES
(4, 80, 'ATM Deduction', 'Payment generated through ATM deduction made bi-monthly.');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `notice_title` varchar(250) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `lender_id`, `notice_title`, `remarks`) VALUES
(33, 83, 'Notice Upon Submission of Loan Requirements', 'You are required to submit all the requirements to process\r\n your loan application.'),
(34, 83, 'Notice Upon Approval of Loan', 'Loan approval will be based and approved after the credit\r\n investigation and validated the requirements submitted.'),
(35, 83, 'Notice Upon Releasing of Loan', 'You will be notified once your loan is scheduled for releasing. \r\nYou are required to visit the office and submit your ATM card upon\r\n the releasing of loan and sign the memorandum of agreement.'),
(36, 83, 'Notice Upon Releasing of Loan Time Frame', 'You will be given 30 days to claim your loan. \r\nUnclaimed loan after 30 days will be forfeited.'),
(37, 83, 'Other Notice', 'N/A'),
(43, 80, 'Notice Upon Submission of Loan Requirements', 'You are required to submit all the requirements to process\r\n your loan application.'),
(44, 80, 'Notice Upon Approval of Loan', 'Loan approval will be based and approved after the credit\r\n investigation and validated the requirements submitted.'),
(45, 80, 'Notice Upon Releasing of Loan', 'You will be notified once your loan is scheduled for releasing. \r\nYou are required to visit the office and submit your ATM card upon\r\n the releasing of loan and sign the memorandum of agreement.'),
(46, 80, 'Notice Upon Releasing of Loan Time Frame', 'You will be given 30 days to claim your loan. \r\nUnclaimed loan after 30 days will be forfeited.'),
(47, 80, 'Other Notice', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `requirements_type`
--

CREATE TABLE `requirements_type` (
  `req_type_id` int(11) NOT NULL,
  `req_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requirements_type`
--

INSERT INTO `requirements_type` (`req_type_id`, `req_name`) VALUES
(1, 'Valid ID'),
(2, 'Barangay Clearance'),
(3, 'Payslip'),
(4, 'Cedula'),
(5, 'ATM Latest Transaction Receipt'),
(6, 'Certificate of Employment'),
(7, 'Bank Statement'),
(8, 'Proof of Billing'),
(9, 'Co-Maker Valid ID'),
(10, 'Co-Maker Cedula'),
(11, '2x2 ID Picture'),
(12, 'ATM Card'),
(13, 'Vehicle Official Receipt or Certificate of Registration'),
(15, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `running_balance`
--

CREATE TABLE `running_balance` (
  `balance_id` int(11) NOT NULL,
  `loan_app_id` int(11) NOT NULL,
  `remaining_balance` decimal(11,2) NOT NULL,
  `monthly_pay` decimal(11,2) NOT NULL,
  `payment` decimal(11,2) NOT NULL,
  `late_charge` decimal(11,2) NOT NULL,
  `paid_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `running_balance`
--

INSERT INTO `running_balance` (`balance_id`, `loan_app_id`, `remaining_balance`, `monthly_pay`, `payment`, `late_charge`, `paid_date`, `status`) VALUES
(19, 118, '30600.00', '0.00', '0.00', '0.00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `terms_privacy`
--

CREATE TABLE `terms_privacy` (
  `terms_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `terms_condition` varchar(1000) NOT NULL,
  `data_privacy` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `terms_privacy`
--

INSERT INTO `terms_privacy` (`terms_id`, `admin_id`, `terms_condition`, `data_privacy`) VALUES
(1, 1, 'TERMS-AND-CONDITIONS.docx', 'Hulam-Data-Privacy.docx'),
(2, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `landline` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `b_day` date NOT NULL,
  `c_street` varchar(100) NOT NULL,
  `c_barangay` varchar(100) NOT NULL,
  `c_city` varchar(100) NOT NULL,
  `c_province` varchar(100) NOT NULL,
  `c_zipcode` varchar(50) NOT NULL,
  `p_street` varchar(100) NOT NULL,
  `p_barangay` varchar(100) NOT NULL,
  `p_city` varchar(100) NOT NULL,
  `p_province` varchar(100) NOT NULL,
  `p_zipcode` varchar(50) NOT NULL,
  `profile_pic` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `eligible` varchar(255) NOT NULL,
  `activation_date` datetime NOT NULL,
  `notice_message` varchar(250) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `company_name`, `lastname`, `firstname`, `middlename`, `email`, `password`, `mobile`, `landline`, `gender`, `b_day`, `c_street`, `c_barangay`, `c_city`, `c_province`, `c_zipcode`, `p_street`, `p_barangay`, `p_city`, `p_province`, `p_zipcode`, `profile_pic`, `status`, `eligible`, `activation_date`, `notice_message`, `token`) VALUES
(11, 1, '', 'Team', 'The', 'Hulam', 'hulamloan@gmail.com', '$2y$10$SrGZXi9WoMgYzSiS.Dgr5u9jkJZethDhVc8xaqVw7.Z3zoo5HvY6W', '0', '0', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'h_small.png', 'verified', 'no', '0000-00-00 00:00:00', '', ''),
(80, 3, 'Guilmark Finance Corporation', '', '', '', 'guilmark.lg@gmail.com', '$2y$10$2EbLEmo4gQ2jmSE3X.tSN.HzrbeHSPTqgdqilZjqXPcpsnxgkc6Lu', '09454909530', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '3542861.jpeg', 'verified', 'yes', '2021-11-16 03:49:19', 'To activate your account you need to complete updating your profile information and required to visit Hulam office for the signing of Memorandum of Agreement', ''),
(81, 2, '', 'Perdiguez', 'Aname', 'Arabis', 'aname.debtor@gmail.com', '$2y$10$Q4YPIu49JVuED0iLYy7po.oFqe7BJmhflpHOo0hyKBmARkzxCu4zi', '09454909530', '5624963', 'Female', '1986-05-22', 'Isuya', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', 'Isuya', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', '180333.jpg', 'verified', 'yes', '2021-11-18 18:56:41', 'To apply loan you need to complete updating your profile information to activate your account.', ''),
(82, 4, '', 'Supremo', 'Chris', 'Chris', 'chris.indiv@gmail.com', '$2y$10$uWpG7o7Ivn9NWWJETlZFjOX3.Rd9XJyL892zzZD9F2Z/jqMYV6g6G', '09454909530', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', '0000-00-00 00:00:00', 'To apply loan you need to complete updating your profile information to activate your account.', ''),
(83, 3, 'WVC Lending Services Inc.', '', '', '', 'wvclendinginc@gmail.com', '$2y$10$pLJ0JY.MTOAaVCgIM70RE.O7spbc/O0EjJT54A066zXzFOAW7UR7S', '09454909531', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '4588073.jpg', 'verified', 'yes', '2021-11-21 02:54:49', 'To activate your account you need to complete updating your profile information and required to visit Hulam office for the signing of Memorandum of Agreement', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_name`, `image`) VALUES
(1, 'Admin', ''),
(2, 'Debtor', 'icon-debtors.png'),
(3, 'Lending Company', 'icon-lending-company.png'),
(4, 'Individual Investor', 'icon-investor.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announce_id`);

--
-- Indexes for table `debtors_info`
--
ALTER TABLE `debtors_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_application`
--
ALTER TABLE `loan_application`
  ADD PRIMARY KEY (`loan_app_id`);

--
-- Indexes for table `loan_features`
--
ALTER TABLE `loan_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payment_detail`
--
ALTER TABLE `loan_payment_detail`
  ADD PRIMARY KEY (`lp_Id`);

--
-- Indexes for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `loan_requirements`
--
ALTER TABLE `loan_requirements`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `mode_payment`
--
ALTER TABLE `mode_payment`
  ADD PRIMARY KEY (`mode_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `requirements_type`
--
ALTER TABLE `requirements_type`
  ADD PRIMARY KEY (`req_type_id`);

--
-- Indexes for table `running_balance`
--
ALTER TABLE `running_balance`
  ADD PRIMARY KEY (`balance_id`);

--
-- Indexes for table `terms_privacy`
--
ALTER TABLE `terms_privacy`
  ADD PRIMARY KEY (`terms_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `loan_application`
--
ALTER TABLE `loan_application`
  MODIFY `loan_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `loan_features`
--
ALTER TABLE `loan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `loan_payment_detail`
--
ALTER TABLE `loan_payment_detail`
  MODIFY `lp_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_requirements`
--
ALTER TABLE `loan_requirements`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `mode_payment`
--
ALTER TABLE `mode_payment`
  MODIFY `mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `requirements_type`
--
ALTER TABLE `requirements_type`
  MODIFY `req_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `running_balance`
--
ALTER TABLE `running_balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `terms_privacy`
--
ALTER TABLE `terms_privacy`
  MODIFY `terms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
