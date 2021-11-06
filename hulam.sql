-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 03:36 PM
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
  `id_type` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_mobile` varchar(255) NOT NULL,
  `company_landline` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_street` varchar(255) NOT NULL,
  `company_barangay` varchar(255) NOT NULL,
  `company_city` varchar(255) NOT NULL,
  `company_province` varchar(255) NOT NULL,
  `company_zipcode` varchar(255) NOT NULL,
  `relative_name` varchar(255) NOT NULL,
  `relative_mobile` varchar(255) NOT NULL,
  `relative_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `debtors_info`
--

INSERT INTO `debtors_info` (`user_id`, `monthly_salary`, `id_type`, `id_image`, `company_name`, `company_mobile`, `company_landline`, `company_email`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `relative_name`, `relative_mobile`, `relative_type`) VALUES
(39, '50000.00', 'SSS/UMID ID', '6176c7f19d93e9.17468333.jpg', 'Young Life', '', '3409182', 'bienzki7@gmail.com', 'St. Francis Village, Purok Butterfly', 'Babag', 'Lapu-lapu city (opon)', 'Cebu', '6015', 'Kung ako si ikaw', '09876543212', 'Parent'),
(40, '10000.00', 'SSS/UMID ID', '61770b05293f54.51656042.png', 'Jane Lending Company', '095632165236', '0324567894', 'jane@gmail.com', 'Isuya', 'Mactan', 'Lapu-Lpau', 'Cebu', '6015', 'Rosel Perdiguez', '09454909530', 'Sister');

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
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `user_id` int(11) NOT NULL,
  `images` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lender_details`
--

CREATE TABLE `lender_details` (
  `lender_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `company_street` varchar(100) NOT NULL,
  `company_barangay` varchar(100) NOT NULL,
  `company_city` varchar(100) NOT NULL,
  `company_province` varchar(100) NOT NULL,
  `company_zipcode` varchar(50) NOT NULL,
  `company_mobile` varchar(50) NOT NULL,
  `company_landline` varchar(50) NOT NULL,
  `upload_id` varchar(250) NOT NULL,
  `upload_dti_permit` varchar(250) NOT NULL,
  `upload_billing_address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loan_application`
--

CREATE TABLE `loan_application` (
  `id` int(11) NOT NULL,
  `debtor_id` int(50) NOT NULL,
  `lender_id` int(50) NOT NULL,
  `total_amount` double(11,2) NOT NULL,
  `remaining_balance` decimal(11,2) NOT NULL,
  `months` int(11) NOT NULL,
  `monthly_payable` decimal(11,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_application`
--

INSERT INTO `loan_application` (`id`, `debtor_id`, `lender_id`, `total_amount`, `remaining_balance`, `months`, `monthly_payable`, `date`, `status`) VALUES
(1, 39, 38, 1315000.00, '1315000.00', 30, '109583.33', '2021-10-20 18:15:40', 'approved'),
(12, 40, 37, 5125.00, '5125.00', 12, '427.08', '2021-10-28 15:36:49', 'approved'),
(13, 40, 37, 5125.00, '5125.00', 12, '427.08', '2021-10-28 15:40:43', 'pending');

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
  `monthly_rate` decimal(11,2) NOT NULL,
  `late_rate` decimal(11,2) NOT NULL,
  `approval` int(11) NOT NULL,
  `late_charges` decimal(11,2) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `company_street` varchar(50) NOT NULL,
  `company_barangay` varchar(50) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `company_province` varchar(50) NOT NULL,
  `company_zipcode` varchar(50) NOT NULL,
  `company_mobile` varchar(50) NOT NULL,
  `company_landline` varchar(50) NOT NULL,
  `company_logo` varchar(250) NOT NULL,
  `dti_permit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_features`
--

INSERT INTO `loan_features` (`id`, `lender_id`, `min_loan`, `max_loan`, `min_term`, `max_term`, `fix_rate`, `monthly_rate`, `late_rate`, `approval`, `late_charges`, `website`, `description`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `company_mobile`, `company_landline`, `company_logo`, `dti_permit`) VALUES
(37, 37, '3000.00', '10000.00', 12, 36, '2.50', '1.50', '2.00', 2, '1.50', 'https://lending.com', 'The best lending company in the Philippines\" \" \" \" \" \" ', 'Isuya', 'Mactan', 'Lapu-Lapu', 'Cebu', '6015', '095632165236', '0324567894', '2799853.jpg', '9247749.pdf'),
(38, 38, '5000.00', '1000000.00', 12, 36, '4.50', '1.80', '3.00', 7, '2.00', 'https://asteria.com', 'Asteria Lending offers the cheapest Online Lending rates in the Philippines..\" ', '', '', '', '', '', '', '', '7656683.png', '4389480.pdf');

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
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `receiver_id` int(100) NOT NULL,
  `sender_id` int(100) NOT NULL,
  `message` varchar(250) NOT NULL,
  `date_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `remittance_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `relative_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `eligible` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `company_name`, `lastname`, `firstname`, `middlename`, `email`, `password`, `mobile`, `landline`, `gender`, `image`, `b_day`, `c_street`, `c_barangay`, `c_city`, `c_province`, `c_zipcode`, `p_street`, `p_barangay`, `p_city`, `p_province`, `p_zipcode`, `relative_type`, `status`, `eligible`, `token`) VALUES
(11, 1, '', 'Team', 'The Hulam ', 'Admin', 'hulamloan@gmail.com', '$2y$10$SrGZXi9WoMgYzSiS.Dgr5u9jkJZethDhVc8xaqVw7.Z3zoo5HvY6W', '0', '0', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(36, 2, '', 'Perdiguez', 'Aname', 'Arabis', 'debtorhulam2021@gmail.com	', '$2y$10$VTBKismieOTgMJZfH4NlMu1a/3EiiUMJdNiwN84lNx/L0haeyAkGW', '09231872635', '3401826', 'Female', '150-1.jpg', '2000-01-01', 'Street', 'Barangay', 'City', 'Province', '6015', '', '', '', '', '', '', 'verified', 'yes', ''),
(37, 3, 'WVC Lending Service Inc.', 'WVC Lending', 'WVC', 'Lending', 'lendingcompany2021@gmail.com', '$2y$10$ATVYnwlP9Rh6CRi78h4qReSUOstOF6LlqCS9g0PY.Eld1R3kOA4be', '0', '0', '', 'asteria_logo.png', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'yes', ''),
(38, 3, 'Golden Rose Pension', 'Golden Rose Pension', '', '', 'golden@gmail.com', '$2y$10$Lzx46l6LkXE0F4NuuJSVWeryPSKF42EjBGmxvuIb4OPvAJ2Vh6ZWu', '0', '0', '', 'asteria_logo.png', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'yes', ''),
(39, 2, '', 'Reyes', 'Bentong', 'Dela Cruz', 'bentong@gmail.com', '$2y$10$mJrh8jY7IwB9rwhg/.qBIekwOnOwM/A7X.Ds0e.jmFGifKmM2FON6', '09982687022', '1234567', 'Male', '', '1945-12-12', 'St. Francis Village, Purok Butterfly', 'Babag', 'Lapu-lapu city (opon)', 'Cebu', '6015', 'St. Francis Village, Purok Butterfly', 'Babag', 'Lapu-lapu city (opon)', 'Cebu', '6015', 'Parent', 'verified', 'yes', ''),
(40, 2, '', 'Ana', 'Ana', 'Ana', 'debtor@gmail.com', '$2y$10$jknjDn.5yXMCETGo5mS7A.m8DSn/QW0u3jiyNovRGdvlWMldqvb/y', '09454909530', '4615320', 'Female', '', '2021-10-13', 'Isuya', 'Mactan', 'Lap-Lapu', 'Cebu', '6015', 'Isuya', 'Mactan', 'Lapu-Lapu', 'Cebu', '6015', 'Sister', 'verified', 'yes', ''),
(41, 5, '', 'Pawnshop', 'Palawan', 'Remittance', 'paymentcentre2021@gmail.com', '$2y$10$Lzx46l6LkXE0F4NuuJSVWeryPSKF42EjBGmxvuIb4OPvAJ2Vh6ZWu', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(42, 2, '', 'Baritos', 'Apple', 'Apol', 'debtorhulam2021@gmail.com', '$2y$10$KTB28odtVAfp/DuhKyYnAOyBOdCcO7E.AdEdxY3ADzRzSwWur4tgq', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', ''),
(43, 2, '', 'Doe', 'John', 'Hanz', 'juveniel.ojt@gmail.com', '$2y$10$N66VzpIaIAFt1pVwlf.33.eUNcPj/3ZPekGvuxr8tzk63Y1wO.cwG', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'unverified', 'no', 'apEa3R2UcC'),
(44, 2, '', 'Doe', 'John', 'Hanz', 'juvenile.ojt@gmail.com', '$2y$10$w4n8gErOSzT8jI4JG7k2GO593SMUZL7MIfi0hoqaNJVQ44gIY.7xC', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 'verified', 'no', '');

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`loan_payment_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loan_features`
--
ALTER TABLE `loan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `loan_receipt`
--
ALTER TABLE `loan_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `loan_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_proof_payment`
--
ALTER TABLE `upload_proof_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
