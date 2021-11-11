-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 09:02 AM
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
  `valid_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `debtors_info`
--

INSERT INTO `debtors_info` (`user_id`, `monthly_salary`, `company_name`, `company_mobile`, `company_landline`, `company_email`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `rel_name`, `rel_mobile`, `rel_type`, `valid_id`) VALUES
(45, '21000.00', 'The Results Company', '09454909530', '032456897', 'results@gmail.com', 'Newtown', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', 'Rosel Perdiguez', '09454909530', 'Sister', '465073.');

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
  `releasing_date` datetime NOT NULL,
  `release_status` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_application`
--

INSERT INTO `loan_application` (`loan_app_id`, `debtor_id`, `lender_id`, `loan_amount`, `loan_term`, `fix_rate`, `total_amount`, `monthly_payment`, `total_interest`, `late_charges`, `date`, `valid_id`, `barangay_clearance`, `payslip`, `cedula`, `atm_transaction`, `coe`, `bank_statement`, `proof_billing`, `co_maker_id`, `co_maker_cedula`, `id_pic`, `confirm`, `approval_date`, `releasing_date`, `release_status`, `status`) VALUES
(99, 45, 63, '30000.00', 12, '3.00', 40800.00, '3400.00', '10800.00', '5.00', '2021-11-08 17:40:17', '242134.jpg', '5578631.jpg', '465448.jpg', '5590632.jpg', '2907801.png', '6959328.jpg', '3939713.jpg', '3265915.jpg', '813498.jpg', '5518583.jpg', '9948691.png', 'Yes', '2021-11-10 12:55:53', '0000-00-00 00:00:00', '', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `loan_details`
--

CREATE TABLE `loan_details` (
  `loan_details_id` int(11) NOT NULL,
  `min_amount` decimal(11,2) NOT NULL,
  `max_amount` decimal(11,2) NOT NULL,
  `min_term` int(11) NOT NULL,
  `max_term` int(11) NOT NULL,
  `interest_rate` decimal(11,2) NOT NULL,
  `penalty` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `description` text NOT NULL,
  `company_street` varchar(50) NOT NULL,
  `company_barangay` varchar(50) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `company_province` varchar(50) NOT NULL,
  `company_zipcode` varchar(50) NOT NULL,
  `company_landline` varchar(50) NOT NULL,
  `company_logo` varchar(250) NOT NULL,
  `dti_permit` varchar(1000) NOT NULL,
  `b_permit` varchar(1000) NOT NULL,
  `notice_message` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `monthly_payment` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_features`
--

INSERT INTO `loan_features` (`id`, `lender_id`, `min_loan`, `max_loan`, `min_term`, `max_term`, `fix_rate`, `late_charges`, `description`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `company_landline`, `company_logo`, `dti_permit`, `b_permit`, `notice_message`, `status`, `monthly_payment`) VALUES
(44, 63, '30000.00', '40000.00', 12, 12, '3.00', '5.00', 'We are legit loan lender that offer loan to people who are in need of Loans. ', 'Behik Building, 2483 M L', 'Quezon Highway', 'Lapu-Lapu City', 'Cebu', '6015', '(32) 340 0447', '7939155.jpeg', '959714.jpg', '4492414.jpg', 'For potential debtors to view your loan features, we request you to come to the office for the signing of Memorandum of Agreement.', 'Approved', 0),
(45, 66, '10000.00', '20000.00', 6, 12, '3.00', '2.00', '', '', '', '', '', '', '', '', '', '', '', 'Pending', 0),
(46, 65, '500.00', '10000.00', 1, 6, '10.00', '10.00', '', '', '', '', '', '', '', '', '', '', '', 'Approved', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_receipt`
--

CREATE TABLE `loan_receipt` (
  `receipt_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `images` varchar(1000) NOT NULL,
  `date_upload` datetime NOT NULL
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
(31, 63, 'Valid ID', 'Upload Valid ID'),
(32, 63, 'Pay Slip', 'Upload 2 months latest'),
(33, 63, 'Cedula ', 'Upload latest cedula'),
(34, 63, 'Bank Statement', 'Upload Bank Statement'),
(35, 63, 'Certificate of Employment (COE)', 'Upload COE'),
(36, 63, 'ATM ', 'Should be submitted upon releasing of loan. Loan deductions  from your ATM are made bi-monthly. Upload only the latest transaction receipt.'),
(47, 63, 'Barangay Clearance ', 'Upload latest');

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
(1, 63, 45, 'Hi Ms. Perdiguez,\r\nPlease complete the requirements for us to proceed with your loan application.\r\nThank you. \r\nFrom Guilmark.', '2021-11-10 12:34:59'),
(2, 63, 45, 'Hello', '2021-11-10 12:37:38'),
(3, 63, 45, 'Yes Yes', '2021-11-10 12:39:51'),
(4, 63, 45, 'test rani ha', '2021-11-10 12:43:05'),
(5, 63, 45, 'xzcvbnm,asdfgh', '2021-11-10 12:45:52'),
(6, 63, 45, 'assssssssssssss', '2021-11-10 12:46:21'),
(7, 63, 45, 'sfdghjk', '2021-11-10 12:46:49'),
(8, 63, 45, 'adsfghjkl', '2021-11-10 12:47:22'),
(9, 63, 45, 'rrrrrrrrrrrty', '2021-11-10 12:48:29'),
(10, 63, 45, 'qwertyuki', '2021-11-10 12:50:53'),
(11, 63, 45, 'adsfdghhu', '2021-11-10 12:52:35'),
(12, 63, 45, 'eeeeeeeeeeeeeeeee', '2021-11-10 12:52:57'),
(13, 63, 45, 'yyyyyyyyyyyyyyyyyyyyy', '2021-11-10 12:54:03'),
(14, 63, 45, 'adsfedrgfthg', '2021-11-10 12:54:41'),
(15, 63, 45, 'Hello! Apol are we cool? Ok paba atong thesis. Approve loan naka dae ayaw kalimot ATM inig release.', '2021-11-10 01:15:16');

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
(1, 63, '66', 'sdcfsf'),
(2, 63, '66', 'sdcfsf');

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
(10, 63, 'Notice upon submission of loan requirements', 'There will be a Credit Investigation after submission of requirements, and this will be check thoroughly. You will be notified once your loan application is approved.'),
(12, 63, 'Notice upon releasing of Loan.', 'You are required to visit our office to submit your ATM card upon releasing of loan and to perform the signing of Memorandum of Agreement. ');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `loan_payment_id` int(11) NOT NULL,
  `remittance_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(11) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `lending_company_name` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_account_no` varchar(50) NOT NULL,
  `payment_date` datetime NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `amount_paid` double(11,2) NOT NULL,
  `posted_date` datetime NOT NULL,
  `confirm` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `running_balance`
--

CREATE TABLE `running_balance` (
  `running_id` int(11) NOT NULL,
  `loan_app_id` int(11) NOT NULL,
  `paymonth_due` datetime NOT NULL,
  `principal_payment` decimal(11,2) NOT NULL,
  `interest_payment` decimal(11,2) NOT NULL,
  `total_monthly_payment` decimal(11,2) NOT NULL,
  `remaining_balance` decimal(11,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `upload_proof_payment`
--

CREATE TABLE `upload_proof_payment` (
  `id` int(11) NOT NULL,
  `uploader_id` int(100) NOT NULL,
  `upload_receipt` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `company_name`, `lastname`, `firstname`, `middlename`, `email`, `password`, `mobile`, `landline`, `gender`, `image`, `b_day`, `c_street`, `c_barangay`, `c_city`, `c_province`, `c_zipcode`, `p_street`, `p_barangay`, `p_city`, `p_province`, `p_zipcode`, `profile_pic`, `status`, `eligible`, `token`) VALUES
(11, 1, '', 'Team', 'The Hulam ', 'Admin', 'hulamloan@gmail.com', '$2y$10$SrGZXi9WoMgYzSiS.Dgr5u9jkJZethDhVc8xaqVw7.Z3zoo5HvY6W', '0', '0', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(45, 2, '', 'Perdiguez', 'Aname', 'Arabis', 'aname.debtor@gmail.com', '$2y$10$zW7OtjvEPKNM2Ta.BokAvOtioSMNM6nc88SpeZyrBvvrvzYRMqHUu', '09454909530', '1234567', 'Female', '', '1986-05-22', 'Isuya', 'Mactan', 'Lapu-Lapu', 'Cebu', '6015', 'Isuya', 'Mactan', 'Lapu-Lapu', 'Cebu', '6015', '6086218.jpg', 'verified', 'yes', ''),
(63, 3, 'Guilmark Finance Corporation', '', '', '', 'guilmark.lg@gmail.com', '$2y$10$Du9EPa/bUN2YhYQhWynqHOtuUerBCgGUj.oFzb.ETL7cxpt9yxIeG', '09569943769', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(65, 4, '', 'Supremo', 'Chris', 'Man', 'chris.indiv@gmail.com', '$2y$10$iNYBMAAqJqYiq6Izle2pKee8Z7mAMZVgkOsaOJGdK5MUvyQmK76Aa', '09454909530', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(66, 5, 'Cebuan Lhuiller', '', '', '', 'eloisa.lending@gmail.com', '$2y$10$dYLcsN3rnFhux32V/3HZ4estm3Lelf8q20o3f6bp8mz355ccDCzr2', '123123', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(67, 2, '', 'Baritos', 'Apol', 'Ban', 'apol.debtor@gmail.com', '$2y$10$.tdP0pbOfCKEnHuj4lspfuNkzqBtJkj2lkjtYttO7A0wMEv73MsjG', '09973871415', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_name`, `image`) VALUES
(1, 'Admin', ''),
(2, 'Debtor', 'icon-debtors.png'),
(3, 'Lending Company', 'icon-company.jpg'),
(4, 'Individual Investor', 'icon-investor.png'),
(5, 'Payment Centre', 'icon-payemts.png');

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
-- Indexes for table `loan_details`
--
ALTER TABLE `loan_details`
  ADD PRIMARY KEY (`loan_details_id`);

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
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`loan_payment_id`);

--
-- Indexes for table `running_balance`
--
ALTER TABLE `running_balance`
  ADD PRIMARY KEY (`running_id`);

--
-- Indexes for table `terms_privacy`
--
ALTER TABLE `terms_privacy`
  ADD PRIMARY KEY (`terms_id`);

--
-- Indexes for table `upload_proof_payment`
--
ALTER TABLE `upload_proof_payment`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_application`
--
ALTER TABLE `loan_application`
  MODIFY `loan_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `loan_details`
--
ALTER TABLE `loan_details`
  MODIFY `loan_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_features`
--
ALTER TABLE `loan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_requirements`
--
ALTER TABLE `loan_requirements`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mode_payment`
--
ALTER TABLE `mode_payment`
  MODIFY `mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `loan_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `running_balance`
--
ALTER TABLE `running_balance`
  MODIFY `running_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms_privacy`
--
ALTER TABLE `terms_privacy`
  MODIFY `terms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_proof_payment`
--
ALTER TABLE `upload_proof_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
