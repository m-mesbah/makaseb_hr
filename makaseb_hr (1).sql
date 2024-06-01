-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 05:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makaseb_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `com_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ceo_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `slug`, `com_name`, `email`, `ceo_name`) VALUES
(1, 'mk', 'makaseb', 'ceo@makaseb.sa', 'Talat'),
(2, '4tel', '4tel', 'ceo@makaseb.sa', 'Ahmed'),
(3, 'arb', 'arbah', 'ceo@makaseb.sa', 'Mohamed'),
(4, 'exa', 'exacall', 'ceo@makaseb.sa', 'kamal');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `email` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_code` int(11) NOT NULL,
  `com_name` enum('mk','4tel','arb','exa') NOT NULL,
  `labtop` tinyint(1) DEFAULT 0,
  `mouse_and_pad` tinyint(1) NOT NULL DEFAULT 0,
  `headset` tinyint(1) NOT NULL DEFAULT 0,
  `lap_stand` tinyint(1) NOT NULL DEFAULT 0,
  `others` varchar(255) DEFAULT NULL,
  `status` enum('0','1','2','3','4','5','6','7') NOT NULL DEFAULT '0',
  `st_comment` varchar(255) DEFAULT NULL,
  `re_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ceo_app_date` timestamp NULL DEFAULT NULL,
  `acc_date` timestamp NULL DEFAULT NULL,
  `buy_date` timestamp NULL DEFAULT NULL,
  `del_date` timestamp NULL DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL,
  `spcs` text DEFAULT NULL,
  `serial_num` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` enum('0','1','2','3','4','5','6','7') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT 'white'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `title`, `description`, `color`) VALUES
(1, '0', 'pendding-it', 'متوقف على وضع المواصفات والاسعار من ال it', 'white'),
(2, '1', 'pendding-ceo', 'متوقف على موافقة المدير', 'white'),
(3, '2', 'regected-ceo', 'رفض من المدير', 'white'),
(4, '3', 'pendding-acc', 'متوقف على وضع التاريخ من الحسابات', 'white'),
(5, '4', 'waiting', 'منتظر الحسابات لاستلام المبلغ المحدد', 'white'),
(6, '5', 'buying', 'تم استلام المبلغ وجاري الشراء', 'white'),
(7, '6', 'completed', 'تم الشراء ', 'white'),
(8, '7', 'delivered', 'تم التسليم', 'white');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company` int(11) NOT NULL,
  `group_id` int(11) DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `userEmail`, `password`, `company`, `group_id`, `active`) VALUES
(1, 'Mesbah', 'm.mesbah@4tel.sa', '7678fc9219058f46af43154655427fa1ec719485', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_users` (`company`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `company_users` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
