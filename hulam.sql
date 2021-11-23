-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 01:53 PM
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
(2, 80, '2021-11-22 00:00:00', 'Interest rate will be lower than 1%.', 'We have decided to lower the interest rate effective next week. ');

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
(81, '20000.00', 'The Results Companies ', '09454909530', '4563698', 'aname522@gmail.com', 'Mactan', 'Mactan', 'Lapu-Lapu City', 'Cebu', '6015', 'Rosel Perdiguez', '09454909530', 'Sister', '4811708.jpg', '268906.jpg', '', '');

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
(8, 80, 81, 'Excellent Service.', '5', '2021-11-19'),
(11, 11, 81, 'Great', '5', '2021-11-20'),
(12, 11, 81, 'Great', '5', '2021-11-20'),
(13, 11, 81, 'Great\r\n', '5', '2021-11-20'),
(14, 11, 81, 'ssss', '5', '2021-11-20'),
(16, 11, 81, 'sdfghjkjhgfdss', '5', '2021-11-21'),
(17, 11, 81, 'sdfghjkjhgfdss', '5', '2021-11-21'),
(18, 11, 81, 'sdfghjkjhgfdss', '5', '2021-11-21'),
(19, 11, 81, 'sdfghjkjhgfdss', '5', '2021-11-21');

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
  `or_cr` varchar(250) NOT NULL,
  `others` varchar(250) NOT NULL,
  `confirm` varchar(250) NOT NULL,
  `approval_date` datetime NOT NULL,
  `release_schedule` datetime DEFAULT NULL,
  `released_date` datetime NOT NULL,
  `loan_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_application`
--

INSERT INTO `loan_application` (`loan_app_id`, `debtor_id`, `lender_id`, `loan_amount`, `loan_term`, `fix_rate`, `total_amount`, `monthly_payment`, `total_interest`, `late_charges`, `date`, `valid_id`, `barangay_clearance`, `payslip`, `cedula`, `atm_transaction`, `coe`, `bank_statement`, `proof_billing`, `co_maker_id`, `co_maker_cedula`, `id_pic`, `or_cr`, `others`, `confirm`, `approval_date`, `release_schedule`, `released_date`, `loan_status`) VALUES
(115, 81, 80, '30000.00', 12, '3.00', 40800.00, '3400.00', '10800.00', '5.00', '2021-11-17 23:03:05', '5157660.jpg', '5993903.jpg', '8973586.jpg', '1400815.jpg', '189981.jpg', '1333279.jpg', '8091477.jpg', '4306853.jpg', '8357911.jpg', '4681295.jpg', '436782.png', '1736451.jpg', '6699144.jpg', 'Yes', '2021-11-21 11:38:12', '2021-11-25 00:00:00', '2021-11-22 12:06:08', 'Released');

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
(171, 80, 81, 'Your payment for loan account number 115 is now posted. Thank You!', '2021-11-19 12:10:43'),
(177, 80, 81, 'Your loan is released! Thank you!', '2021-11-19 02:48:53'),
(198, 81, 11, 'Hi ', '2021-11-20 00:00:00'),
(199, 81, 80, 'Hi Guilmark , I want to check with my loan application. Thanks.', '2021-11-20 00:00:00'),
(200, 11, 81, 'Thank you.', '2021-11-20 00:00:00'),
(201, 81, 80, 'Thank You.', '2021-11-20 00:00:00'),
(202, 83, 81, 'ssss', '2021-11-20 00:00:00'),
(203, 81, 80, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', '2021-11-20 00:00:00'),
(204, 81, 80, 'ttttttttttttttttttt', '2021-11-20 00:00:00'),
(205, 81, 80, 'kkkkkkkkkkkkkk', '2021-11-20 00:00:00'),
(206, 81, 80, 'yyyyyyyyyyyyyyyy', '2021-11-20 00:00:00'),
(207, 11, 83, 'Congratulations! Your account is now activated.', '2021-11-21 02:54:49'),
(208, 81, 80, 'Dominggo\r\n', '2021-11-21 08:58:22'),
(209, 81, 80, '', '2021-11-21 09:05:09'),
(210, 81, 80, 'Dominggo na karon.', '2021-11-21 09:53:28'),
(211, 81, 11, 'Hi Admin', '2021-11-21 10:19:36'),
(212, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-21 11:18:56'),
(213, 80, 81, 'Hi Aname', '2021-11-21 11:33:57'),
(214, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-21 11:34:36'),
(215, 80, 81, 'Your loan is approved. Please visit our office for the releasing of loan dated on your releasing schedule. Thank you.', '2021-11-21 11:38:12'),
(216, 80, 81, 'Your loan is released! Thank you!', '2021-11-21 11:39:17'),
(217, 80, 81, 'Your loan is released! Thank you!', '2021-11-21 11:44:42'),
(218, 80, 81, 'released na\r\n', '2021-11-22 12:05:15'),
(219, 80, 81, 'Your loan is released! Thank you!', '2021-11-22 12:06:08');

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
(4, 80, 'ATM Deduction', 'Payment generated through ATM deduction made bi-monthly.'),
(5, 83, 'ATM Deduction', 'Payment will be generated through ATM deduction made bi-monthly.');

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
  `paid_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `running_balance`
--

INSERT INTO `running_balance` (`balance_id`, `loan_app_id`, `remaining_balance`, `monthly_pay`, `payment`, `late_charge`, `paid_date`) VALUES
(18, 115, '39100.00', '3400.00', '1700.00', '0.00', '2021-11-19 04:12:52');

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
(11, 1, '', 'Team', 'The Hulam ', 'Admin', 'hulamloan@gmail.com', '$2y$10$SrGZXi9WoMgYzSiS.Dgr5u9jkJZethDhVc8xaqVw7.Z3zoo5HvY6W', '0', '0', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'h_small.png', 'verified', 'no', '0000-00-00 00:00:00', '', ''),
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
  MODIFY `announce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `loan_application`
--
ALTER TABLE `loan_application`
  MODIFY `loan_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `loan_features`
--
ALTER TABLE `loan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loan_requirements`
--
ALTER TABLE `loan_requirements`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `mode_payment`
--
ALTER TABLE `mode_payment`
  MODIFY `mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
