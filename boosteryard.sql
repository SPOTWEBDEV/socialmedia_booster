-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 10:35 AM
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
-- Database: `boosteryard`
--

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','inprogress','resolved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `user`, `message`, `created_at`, `status`) VALUES
(1, 1, 'Subject: Assistance Needed\r\nMessage:\r\nHi Boost Yard Team,\r\nI’m trying to boost my social media account but I’m facing some difficulties.\r\nCould you please help me resolve this issue as soon as possible?\r\nThanks!', '2025-11-25 07:06:35', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') NOT NULL,
  `status_message` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `balance`, `status`, `status_message`, `created_at`) VALUES
(1, 'firstclass thebest', 'spotwebdev.com@gmail.com', '$2y$10$Ch57xuGlbePCW3ubVfUVi.dyEUawLqUziTvOLIHp0mN6gAVz95GMS', '0', 'active', '', '2025-11-23 23:31:39'),
(2, 'giftchinenyenwa1', 'giftchinenyenwa1@gmail.com', '$2y$10$ETSJHbbAJZLKl90kjBPRHO2Yra90KIR.9/DKusT.J2tuyODdRSqgW', '0', 'active', '', '2025-11-23 23:35:39'),
(3, 'firstclass', 'firstclass@gmail.com', '$2y$10$puS0cDl/9VGjPkCkpsQjDORLoMXTK7ODV/CYdqEKgeQaUEB/OeE9W', '0', 'active', '', '2025-11-23 23:52:39'),
(4, 'micheal', 'micheal@gmail.com', '$2y$10$u7x.4dZvYATf.ol9gY/Byu3mSbgh.qQKgMosm0wFWjzynTonqULM.', '0', 'active', '', '2025-11-23 23:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `order_category` varchar(255) NOT NULL,
  `social_url` varchar(500) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_security_settings`
--

CREATE TABLE `user_security_settings` (
  `user_id` int(11) NOT NULL,
  `two_step` tinyint(1) DEFAULT 0,
  `auth_type` enum('pin','password') DEFAULT 'password',
  `recovery_email` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_security_settings`
--

INSERT INTO `user_security_settings` (`user_id`, `two_step`, `auth_type`, `recovery_email`, `updated_at`) VALUES
(1, 1, 'pin', 1, '2025-11-25 07:58:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_security_settings`
--
ALTER TABLE `user_security_settings`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
