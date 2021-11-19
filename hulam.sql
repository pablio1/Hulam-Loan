-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 02:44 PM
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
(115, 81, 80, '30000.00', 12, '3.00', 40800.00, '3400.00', '10800.00', '5.00', '2021-11-17 23:03:05', '8843174.pdf', '9132803.jpg', '8973586.jpg', '1400815.jpg', '189981.jpg', '1333279.jpg', '8091477.jpg', '5918242.jpg', '381608.jpg', '4681295.jpg', '436782.png', 'Yes', '2021-11-19 02:36:39', '2021-11-20 00:00:00', '2021-11-19 01:52:36', 'Released');

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

INSERT INTO `loan_features` (`id`, `lender_id`, `min_loan`, `max_loan`, `min_term`, `max_term`, `fix_rate`, `late_charges`, `reloan_period`, `description`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `company_landline`, `dti_permit`, `b_permit`, `valid_id`, `selfie_id`, `status_dti`, `status_b_permit`, `status_valid_id`, `status_selfie_id`) VALUES
(51, 80, '30000.00', '40000.00', 12, 12, '3.00', '5.00', '8', 'We provide the best loan deals.', 'Behik Building', 'Quezon Highway', 'lapu-Lapu', 'Cebu', '6015', '4235689', '2883392.jpg', '8177127.jpg', '', '', '', '', '', '');

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
  `req_name` varchar(250) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_requirements`
--

INSERT INTO `loan_requirements` (`req_id`, `lender_id`, `req_name`, `remarks`) VALUES
(51, 80, 'Valid ID', 'Upload Valid ID'),
(52, 80, 'Payslip ', 'Atleast 2 months latest'),
(53, 80, 'ATM receipt ', 'Latest transaction receipt');

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
(192, 0, 0, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 02:08:44');

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
(26, 80, 'Notice Upon Submission of Loan Requirements', 'You are required to complete the requirements. There will be a credit investigation after the submission of requirements. You will be notified once your loan is approved.'),
(27, 80, 'Notice Upon Releasing of Loan', 'Once your loan is approved, you will be required to visit our office to submit your ATM card and sign the Memorandum of Agreement.');

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
  `paid_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `running_balance`
--

INSERT INTO `running_balance` (`balance_id`, `loan_app_id`, `remaining_balance`, `monthly_pay`, `payment`, `late_charge`, `paid_date`) VALUES
(12, 115, '40800.00', '3400.00', '0.00', '0.00', '0000-00-00 00:00:00');

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
  `image` varchar(255) NOT NULL,
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

INSERT INTO `user` (`user_id`, `user_type`, `company_name`, `lastname`, `firstname`, `middlename`, `email`, `password`, `mobile`, `landline`, `gender`, `image`, `b_day`, `c_street`, `c_barangay`, `c_city`, `c_province`, `c_zipcode`, `p_street`, `p_barangay`, `p_city`, `p_province`, `p_zipcode`, `profile_pic`, `status`, `eligible`, `activation_date`, `notice_message`, `token`) VALUES
(11, 1, '', 'Team', 'The Hulam ', 'Admin', 'hulamloan@gmail.com', '$2y$10$SrGZXi9WoMgYzSiS.Dgr5u9jkJZethDhVc8xaqVw7.Z3zoo5HvY6W', '0', '0', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', '0000-00-00 00:00:00', '', ''),
(80, 3, 'Guilmark Finance Corporation', '', '', '', 'guilmark.lg@gmail.com', '$2y$10$2EbLEmo4gQ2jmSE3X.tSN.HzrbeHSPTqgdqilZjqXPcpsnxgkc6Lu', '09454909530', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '3542861.jpeg', 'verified', 'yes', '2021-11-16 03:49:19', 'To activate your account you need to complete updating your profile information and required to visit Hulam office for the signing of Memorandum of Agreement', ''),
(81, 2, '', 'Perdiguez', 'Aname', 'Arabis', 'aname.debtor@gmail.com', '$2y$10$Q4YPIu49JVuED0iLYy7po.oFqe7BJmhflpHOo0hyKBmARkzxCu4zi', '09454909530', '5624963', 'Female', '', '1986-05-22', 'Isuya', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', 'Isuya', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', '180333.jpg', 'verified', 'yes', '0000-00-00 00:00:00', 'To apply loan you need to complete updating your profile information to activate your account.', '');

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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan_application`
--
ALTER TABLE `loan_application`
  MODIFY `loan_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `loan_features`
--
ALTER TABLE `loan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loan_requirements`
--
ALTER TABLE `loan_requirements`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `mode_payment`
--
ALTER TABLE `mode_payment`
  MODIFY `mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `running_balance`
--
ALTER TABLE `running_balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `terms_privacy`
--
ALTER TABLE `terms_privacy`
  MODIFY `terms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
