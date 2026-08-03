-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2026 at 03:09 PM
-- Server version: 8.0.45-cll-lve
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yahhhcom_boostyard`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sitePrice` varchar(255) NOT NULL DEFAULT '0.7',
  `usd_to_naria_rate` varchar(255) DEFAULT '1450'
);

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `sitePrice`, `usd_to_naria_rate`) VALUES
(1, 'admin', 'admin@admin.com ', 'admin@admin.com', '1.5', '1489');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `method` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `amount_in_dollar` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `account` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `paidto` int DEFAULT NULL
) ;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user`, `method`, `amount`, `amount_in_dollar`, `reference`, `status`, `account`, `created_at`, `paidto`) VALUES
(2, 5, 'paystack', 5000.00, '', 'dep_6935949f49a8a', 'pending', 0, '2025-12-07 14:52:15', 0),
(4, 5, 'paystack', 4000.00, '', 'dep_693b1a861ac6f', 'pending', 0, '2025-12-11 19:24:54', 0),
(5, 5, 'manual', 4000.00, '', 'dep_693b1aa85ad06', 'pending', 0, '2025-12-11 19:25:28', 0),
(6, 5, 'manual', 10000.00, '', 'dep_693b1e84a8c39', 'pending', 0, '2025-12-11 19:41:56', 0),
(7, 5, 'crypto', 100.00, '', 'dep_693b1ea97c81c', 'pending', 0, '2025-12-11 19:42:33', 0),
(8, 5, 'crypto', 100.00, '', 'dep_693b20595d247', 'pending', 0, '2025-12-11 19:49:45', 0),
(9, 5, 'crypto', 100.00, '', 'dep_693b20922851b', 'declined', 0, '2025-12-11 19:50:42', 0),
(10, 5, 'manual', 100.00, '', 'dep_693b20ab82d0f', 'pending', 0, '2025-12-11 19:51:07', 0),
(11, 5, 'manual', 100.00, '', 'dep_693b20cd5795c', 'pending', 0, '2025-12-11 19:51:41', 0),
(12, 5, 'manual', 10000.00, '', 'dep_693b29b86bd6e', 'pending', 0, '2025-12-11 20:29:44', 3),
(13, 5, 'crypto', 10009.00, '', 'dep_693b29e49d3b2', 'pending', 0, '2025-12-11 20:30:28', 0),
(14, 6, 'manual', 4000.00, '', 'dep_693bc4860dd52', 'approved', 0, '2025-12-12 07:30:14', 6),
(15, 5, 'crypto', 20.00, '', 'dep_693c11debafe2', 'approved', 0, '2025-12-12 13:00:14', 4),
(16, 5, 'manual', 2000.00, '', 'dep_693c120cd0209', 'approved', 0, '2025-12-12 13:01:00', 6),
(18, 6, 'manual', 14500.00, '10', 'dep_693e3b735167b', 'pending', 0, '2025-12-14 04:22:11', 6),
(19, 6, 'crypto', 7250.00, '5', 'dep_693e3ba777313', 'pending', 0, '2025-12-14 04:23:03', 5),
(20, 7, 'crypto', 2900.00, '2', 'dep_693eacfd55b8b', 'pending', 0, '2025-12-14 12:26:37', 0),
(21, 7, 'manual', 2900.00, '2', 'dep_693ead0ca7fca', 'approved', 0, '2025-12-14 12:26:52', 6),
(22, 7, 'crypto', 2900.00, '2', 'dep_693f15a65c12a', 'pending', 0, '2025-12-14 19:53:10', 0),
(23, 7, 'crypto', 2900.00, '2', 'dep_693f163966173', 'pending', 0, '2025-12-14 19:55:37', 0),
(24, 7, 'manual', 2900.00, '2', 'dep_693f1647ea910', 'pending', 0, '2025-12-14 19:55:51', 6),
(25, 9, 'manual', 1450.00, '1', 'dep_693f8ab6ab5ea', 'declined', 0, '2025-12-15 04:12:38', 0),
(26, 10, 'manual', 1450.00, '1', 'dep_693fe314b8a11', 'declined', 0, '2025-12-15 10:29:40', 0),
(27, 7, 'manual', 1450.00, '1', 'dep_694025c107458', 'pending', 0, '2025-12-15 15:14:09', 6),
(28, 12, 'manual', 2900.00, '2', 'dep_694069cc2064d', 'approved', 0, '2025-12-15 20:04:28', 6),
(29, 15, 'manual', 7250.00, '5', 'dep_694104147b076', 'pending', 0, '2025-12-16 07:02:44', 0),
(30, 15, 'manual', 2900.00, '2', 'dep_6941051c600d1', 'pending', 0, '2025-12-16 07:07:08', 0),
(31, 15, 'manual', 2900.00, '2', 'dep_6941051cf2057', 'approved', 0, '2025-12-16 07:07:08', 6),
(32, 17, 'manual', 2900.00, '2', 'dep_6941247951b84', 'pending', 0, '2025-12-16 09:20:57', 0),
(33, 15, 'manual', 4350.00, '3', 'dep_6941ba635582f', 'pending', 0, '2025-12-16 20:00:35', 0),
(34, 15, 'manual', 4350.00, '3', 'dep_6941ba85ec5d9', 'approved', 0, '2025-12-16 20:01:09', 6),
(35, 18, 'manual', 1450.00, '1', 'dep_694303daa167b', 'approved', 0, '2025-12-17 19:26:18', 6),
(36, 18, 'manual', 1450.00, '1', 'dep_69430a66efa86', 'pending', 0, '2025-12-17 19:54:14', 0),
(37, 18, 'manual', 2900.00, '2', 'dep_69430a72985be', 'pending', 0, '2025-12-17 19:54:26', 0),
(38, 18, 'manual', 2900.00, '2', 'dep_69430ae0a06d8', 'pending', 0, '2025-12-17 19:56:16', 0),
(39, 5, 'manual', 7250.00, '5', 'dep_69430e565b6c5', 'pending', 0, '2025-12-17 20:11:02', 0),
(40, 5, 'manual', 2900.00, '2', 'dep_69433468b8f6f', 'pending', 0, '2025-12-17 22:53:28', 0),
(41, 21, 'manual', 2900.00, '2', 'dep_69433a3a48d79', 'pending', 0, '2025-12-17 23:18:18', 6),
(42, 21, 'manual', 2900.00, '2', 'dep_69433a8b37bef', 'pending', 0, '2025-12-17 23:19:39', 6),
(43, 21, 'crypto', 29000.00, '20', 'dep_69433bdd751ba', 'pending', 0, '2025-12-17 23:25:17', 1),
(44, 21, 'manual', 2900.00, '2', 'dep_69434d0467ea9', 'pending', 0, '2025-12-18 00:38:28', 0),
(45, 21, 'manual', 2900.00, '2', 'dep_69434d243032d', 'approved', 0, '2025-12-18 00:39:00', 6),
(46, 21, 'manual', 2900.00, '2', 'dep_694350a38b6fd', 'approved', 0, '2025-12-18 00:53:55', 6),
(47, 23, 'manual', 2900.00, '2', 'dep_6943a90d03b17', 'pending', 0, '2025-12-18 07:11:09', 0),
(48, 23, 'manual', 2900.00, '2', 'dep_6943a9458180c', 'pending', 0, '2025-12-18 07:12:05', 0),
(49, 23, 'manual', 2900.00, '2', 'dep_6943ae57a2368', 'pending', 0, '2025-12-18 07:33:43', 0),
(50, 21, 'manual', 2900.00, '2', 'dep_6943ae9f0ba79', 'pending', 0, '2025-12-18 07:34:55', 6),
(51, 21, 'manual', 2900.00, '2', 'dep_6943b6bbd2bd5', 'pending', 0, '2025-12-18 08:09:31', 0),
(52, 21, 'manual', 2900.00, '2', 'dep_6943b6bc149a1', 'approved', 0, '2025-12-18 08:09:32', 6),
(53, 23, 'manual', 2900.00, '2', 'dep_6943c033838b3', 'pending', 0, '2025-12-18 08:49:55', 6),
(54, 23, 'manual', 2900.00, '2', 'dep_6943d9da2b9e1', 'pending', 0, '2025-12-18 10:39:22', 6),
(55, 23, 'manual', 2900.00, '2', 'dep_6944348a6169d', 'pending', 0, '2025-12-18 17:06:18', 0),
(56, 23, 'manual', 2900.00, '2', 'dep_694443820c88e', 'approved', 0, '2025-12-18 18:10:10', 6),
(57, 5, 'manual', 5800.00, '4', 'dep_6944616b09ac6', 'pending', 0, '2025-12-18 20:17:47', 0),
(58, 25, 'manual', 4350.00, '3', 'dep_6944629541c00', 'approved', 0, '2025-12-18 20:22:45', 6),
(59, 21, 'manual', 4350.00, '3', 'dep_6945112d44f9c', 'pending', 0, '2025-12-19 08:47:41', 0),
(60, 21, 'manual', 4350.00, '3', 'dep_69451168c51a9', 'approved', 0, '2025-12-19 08:48:40', 6),
(61, 21, 'manual', 2900.00, '2', 'dep_6945ee392f49b', 'approved', 0, '2025-12-20 00:30:49', 0),
(62, 21, 'manual', 2900.00, '2', 'dep_69460514d80db', 'pending', 0, '2025-12-20 02:08:20', 6),
(63, 27, 'crypto', 2900.00, '2', 'dep_6946cfcc81955', 'pending', 0, '2025-12-20 16:33:16', 0),
(64, 27, 'manual', 2900.00, '2', 'dep_6946cfe87976d', 'approved', 0, '2025-12-20 16:33:44', 6),
(65, 23, 'manual', 2900.00, '2', 'dep_6946f1cf812da', 'approved', 0, '2025-12-20 18:58:23', 0),
(66, 23, 'manual', 2900.00, '2', 'dep_6946f8210b0e4', 'pending', 0, '2025-12-20 19:25:21', 6),
(67, 20, 'manual', 2900.00, '2', 'dep_69482a377f31c', 'pending', 0, '2025-12-21 17:11:19', 0),
(68, 20, 'manual', 2900.00, '2', 'dep_69482ac03a50c', 'approved', 0, '2025-12-21 17:13:36', 0),
(69, 20, 'manual', 2900.00, '2', 'dep_69482b0a788ff', 'pending', 0, '2025-12-21 17:14:50', 6),
(70, 25, 'manual', 10150.00, '7', 'dep_69486f0287325', 'pending', 0, '2025-12-21 22:04:50', 0),
(71, 25, 'manual', 8700.00, '6', 'dep_69486f2abd9b2', 'approved', 0, '2025-12-21 22:05:30', 6),
(72, 31, 'manual', 1450.00, '1', 'dep_694a5224e35c5', 'pending', 0, '2025-12-23 08:26:12', 6),
(73, 31, 'manual', 1450.00, '1', 'dep_694a5295a663b', 'approved', 0, '2025-12-23 08:28:05', 6),
(74, 32, 'manual', 72500.00, '50', 'dep_694bc535d5bc0', 'approved', 0, '2025-12-24 10:49:25', 6),
(75, 27, 'manual', 72500.00, '50', 'dep_694bce5adea1a', 'approved', 0, '2025-12-24 11:28:26', 6),
(76, 33, 'crypto', 14500.00, '10', 'dep_694bd5c5a3f88', 'pending', 0, '2025-12-24 12:00:05', 0),
(77, 18, 'crypto', 72500.00, '50', 'dep_694c5cbfe88f1', 'pending', 0, '2025-12-24 21:35:59', 0),
(78, 18, 'manual', 72500.00, '50', 'dep_694c5ccb3df4f', 'pending', 0, '2025-12-24 21:36:11', 0),
(79, 18, 'manual', 7250.00, '5', 'dep_694c5cfd2a840', 'pending', 0, '2025-12-24 21:37:01', 0),
(80, 31, 'manual', 1450.00, '1', 'dep_695106ae60745', 'approved', 0, '2025-12-28 10:30:06', 6),
(81, 36, 'manual', 2900.00, '2', 'dep_69596fc8cae3e', 'approved', 0, '2026-01-03 19:36:40', 6),
(82, 44, 'manual', 1450.00, '1', 'dep_695cc92691e45', 'pending', 0, '2026-01-06 08:34:46', 0),
(83, 48, 'crypto', 20300.00, '14', 'dep_695d437bdb78e', 'pending', 0, '2026-01-06 17:16:43', 0),
(84, 5, 'crypto', 29000.00, '20', 'dep_695d5c1cab6af', 'pending', 0, '2026-01-06 19:01:48', 0),
(85, 5, 'crypto', 29000.00, '20', 'dep_695d5d26d40f8', 'pending', 0, '2026-01-06 19:06:14', 0),
(86, 5, 'crypto', 7250.00, '5', 'dep_695d5d39bdb23', 'pending', 0, '2026-01-06 19:06:33', 0),
(87, 5, 'crypto', 29000.00, '20', 'dep_695d5e617c2dd', 'pending', 0, '2026-01-06 19:11:29', 0),
(88, 7, 'crypto', 11600.00, '8', 'dep_695d5e8e53c5d', 'pending', 0, '2026-01-06 19:12:14', 0),
(89, 7, 'manual', 11600.00, '8', 'dep_695d5ee0c2866', 'pending', 0, '2026-01-06 19:13:36', 0),
(90, 7, 'crypto', 7250.00, '5', 'dep_695d5f01d4f59', 'pending', 0, '2026-01-06 19:14:09', 0),
(91, 7, 'crypto', 7250.00, '5', 'dep_695d5f0d437a6', 'pending', 0, '2026-01-06 19:14:21', 0),
(92, 7, 'crypto', 7250.00, '5', 'dep_695d5f1684863', 'pending', 0, '2026-01-06 19:14:30', 0),
(93, 7, 'crypto', 7250.00, '5', 'dep_695d5f1d41008', 'pending', 0, '2026-01-06 19:14:37', 0),
(94, 51, 'manual', 2900000.00, '2000', 'dep_695d8dbb15830', 'pending', 0, '2026-01-06 22:33:31', 0),
(95, 22, 'manual', 2900.00, '2', 'dep_695e541591cc5', 'approved', 0, '2026-01-07 12:39:49', 6),
(96, 56, 'manual', 1450.00, '1', 'dep_695edaeccf207', 'pending', 0, '2026-01-07 22:15:08', 0),
(97, 49, 'crypto', 2900.00, '2', 'dep_696287a0a7b4b', 'pending', 0, '2026-01-10 17:08:48', 0),
(98, 49, 'manual', 2900.00, '2', 'dep_696287b3e84c5', 'pending', 0, '2026-01-10 17:09:07', 6),
(99, 49, 'manual', 2900.00, '2', 'dep_696287fe1142f', 'pending', 0, '2026-01-10 17:10:22', 6),
(100, 49, 'manual', 4350.00, '3', 'dep_6962885f508b1', 'pending', 0, '2026-01-10 17:11:59', 6),
(101, 49, 'manual', 2900.00, '2', 'dep_6962890d1ff5a', 'pending', 0, '2026-01-10 17:14:53', 6),
(102, 49, 'manual', 2900.00, '2', 'dep_6962894d30971', 'pending', 0, '2026-01-10 17:15:57', 0),
(103, 49, 'crypto', 2900.00, '2', 'dep_6962a997d981c', 'pending', 0, '2026-01-10 19:33:43', 0),
(104, 49, 'crypto', 7250.00, '5', 'dep_6962a9b71de03', 'pending', 0, '2026-01-10 19:34:15', 5),
(105, 49, 'crypto', 2900.00, '2', 'dep_6962c04ddf97c', 'pending', 0, '2026-01-10 21:10:37', 0),
(106, 49, 'manual', 2900.00, '2', 'dep_6962c06ed16d3', 'pending', 0, '2026-01-10 21:11:10', 6),
(107, 49, 'crypto', 2900.00, '2', 'dep_6962c0cb94509', 'pending', 0, '2026-01-10 21:12:43', 0),
(108, 49, 'crypto', 2900.00, '2', 'dep_6962c18d77978', 'pending', 0, '2026-01-10 21:15:57', 0),
(109, 49, 'manual', 2900.00, '2', 'dep_6962c1b45dd8f', 'pending', 0, '2026-01-10 21:16:36', 6),
(110, 22, 'manual', 2900.00, '2', 'dep_6963ebd2b3b40', 'approved', 0, '2026-01-11 18:28:34', 6),
(111, 31, 'manual', 1450.00, '1', 'dep_6964605910005', 'pending', 0, '2026-01-12 02:45:45', 0),
(112, 31, 'manual', 1450.00, '1', 'dep_696460794c36a', 'approved', 0, '2026-01-12 02:46:17', 6),
(113, 60, 'manual', 1450.00, '1', 'dep_696527cd04b34', 'pending', 0, '2026-01-12 16:56:45', 6),
(114, 60, 'manual', 1450.00, '1', 'dep_696528837fabe', 'approved', 0, '2026-01-12 16:59:47', 6),
(115, 21, 'manual', 2900.00, '2', 'dep_6966008b76313', 'approved', 0, '2026-01-13 08:21:31', 6),
(116, 62, 'manual', 5800.00, '4', 'dep_6966439482e25', 'pending', 0, '2026-01-13 13:07:32', 0),
(117, 31, 'manual', 1450.00, '1', 'dep_6967b04694a96', 'approved', 0, '2026-01-14 15:03:34', 6),
(118, 66, 'manual', 2900.00, '2', 'dep_696ad841b5664', 'approved', 0, '2026-01-17 00:30:57', 0),
(119, 67, 'manual', 2900.00, '2', 'dep_696ae4aa35326', 'pending', 0, '2026-01-17 01:23:54', 0),
(120, 67, 'manual', 2900.00, '2', 'dep_696ae4c8574f7', 'approved', 0, '2026-01-17 01:24:24', 6),
(121, 67, 'manual', 4350.00, '3', 'dep_696be1b240768', 'pending', 0, '2026-01-17 19:23:30', 0),
(122, 67, 'manual', 4350.00, '3', 'dep_696be1ca2f300', 'approved', 0, '2026-01-17 19:23:54', 6),
(123, 31, 'manual', 1450.00, '1', 'dep_696dea5a97ecc', 'approved', 0, '2026-01-19 08:24:58', 6),
(124, 70, 'crypto', 29000.00, '20', 'dep_696df454d1289', 'pending', 0, '2026-01-19 09:07:32', 0),
(125, 70, 'manual', 29000.00, '20', 'dep_696df4716bb1a', 'approved', 0, '2026-01-19 09:08:01', 6),
(126, 72, 'manual', 29000.00, '20', 'dep_696e12d622a48', 'approved', 0, '2026-01-19 11:17:42', 0),
(127, 72, 'manual', 29000.00, '20', 'dep_696e12f73f982', 'pending', 0, '2026-01-19 11:18:15', 6),
(128, 73, 'manual', 14500.00, '10', 'dep_696fbbc0751cb', 'pending', 0, '2026-01-20 17:30:40', 0),
(129, 77, 'manual', 6000.00, '4', 'dep_69751afd24b0a', 'pending', 0, '2026-01-24 19:18:21', 0),
(130, 76, 'manual', 15000.00, '10', 'dep_6975223a6b113', 'pending', 0, '2026-01-24 19:49:14', 0),
(131, 76, 'manual', 15000.00, '10', 'dep_69752728e3eb0', 'approved', 0, '2026-01-24 20:10:16', 6),
(132, 82, 'manual', 3000.00, '2', 'dep_69775ccaa7100', 'approved', 0, '2026-01-26 12:23:38', 0),
(133, 72, 'manual', 30000.00, '20', 'dep_69775e9e06a07', 'approved', 0, '2026-01-26 12:31:26', 6),
(134, 83, 'crypto', 15000.00, '10', 'dep_69776ff75c301', 'approved', 0, '2026-01-26 13:45:27', 5),
(135, 68, 'manual', 1500.00, '1', 'dep_6977724052bd6', 'approved', 0, '2026-01-26 13:55:12', 6),
(136, 22, 'manual', 6000.00, '4', 'dep_697814178bff1', 'approved', 0, '2026-01-27 01:25:43', 6),
(137, 84, 'manual', 1500.00, '1', 'dep_69781542ce37d', 'approved', 0, '2026-01-27 01:30:42', 0),
(138, 84, 'manual', 1500.00, '1', 'dep_697816abe02f6', 'declined', 0, '2026-01-27 01:36:43', 6),
(139, 87, 'manual', 3000.00, '2', 'dep_6979ef34e76d3', 'declined', 0, '2026-01-28 11:12:52', 0),
(140, 87, 'manual', 1500.00, '1', 'dep_6979ef5bdaff2', 'approved', 0, '2026-01-28 11:13:31', 6),
(141, 87, 'manual', 3000.00, '2', 'dep_6979f063ee02b', 'declined', 0, '2026-01-28 11:17:55', 0),
(142, 87, 'manual', 3000.00, '2', 'dep_6979f07c42f9e', 'declined', 0, '2026-01-28 11:18:20', 6),
(143, 87, 'manual', 3000.00, '2', 'dep_6979f0c24635d', 'approved', 0, '2026-01-28 11:19:30', 6),
(144, 91, 'manual', 6000.00, '4', 'dep_697dc90082992', 'pending', 0, '2026-01-31 09:18:56', 0),
(145, 91, 'manual', 1500.00, '1', 'dep_697dc91899c03', 'pending', 0, '2026-01-31 09:19:20', 6),
(146, 92, 'crypto', 25500.00, '17', 'dep_697e7d733a407', 'pending', 0, '2026-01-31 22:08:51', 0),
(147, 89, 'manual', 1500.00, '1', 'dep_697f5e1dd403f', 'pending', 0, '2026-02-01 14:07:25', 0),
(148, 22, 'manual', 4500.00, '3', 'dep_6980db938d20b', 'approved', 0, '2026-02-02 17:14:59', 6),
(149, 84, 'manual', 1500.00, '1', 'dep_6981b578763b8', 'pending', 0, '2026-02-03 08:44:40', 0),
(150, 84, 'manual', 1500.00, '1', 'dep_6981b598f2d17', 'approved', 0, '2026-02-03 08:45:12', 6),
(151, 95, 'manual', 30000.00, '20', 'dep_6982409028717', 'approved', 0, '2026-02-03 18:38:08', 6),
(152, 12, 'manual', 4500000.00, '3000', 'dep_6982490676279', 'approved', 0, '2026-02-03 19:14:14', 0),
(153, 31, 'manual', 1500.00, '1', 'dep_69824e890c3bf', 'approved', 0, '2026-02-03 19:37:45', 6),
(154, 21, 'manual', 3000.00, '2', 'dep_69868c73736e7', 'approved', 0, '2026-02-07 00:50:59', 0),
(155, 21, 'manual', 3000.00, '2', 'dep_69869428d6685', 'approved', 0, '2026-02-07 01:23:52', 0),
(156, 97, 'manual', 30000.00, '20', 'dep_6986f1255889a', 'pending', 0, '2026-02-07 08:00:37', 0),
(157, 31, 'manual', 1500.00, '1', 'dep_6987ca6e4f541', 'approved', 0, '2026-02-07 23:27:42', 6),
(158, 31, 'manual', 1500.00, '1', 'dep_698c4031d4804', 'approved', 0, '2026-02-11 08:39:13', 6),
(159, 72, 'manual', 30000.00, '20', 'dep_698c775d47861', 'approved', 0, '2026-02-11 12:34:37', 6),
(160, 22, 'manual', 6000.00, '4', 'dep_6994bee27444a', 'approved', 0, '2026-02-17 19:17:54', 6),
(161, 107, 'manual', 4500.00, '3', 'dep_6998bb99d36aa', 'approved', 0, '2026-02-20 19:52:57', 0),
(162, 107, 'manual', 4500.00, '3', 'dep_6998bb9a3c4bf', 'pending', 0, '2026-02-20 19:52:58', 6),
(163, 108, 'manual', 3000.00, '2', 'dep_699a21bca7021', 'approved', 0, '2026-02-21 21:21:00', 6),
(164, 76, 'manual', 9000.00, '6', 'dep_699b12196a7c8', 'approved', 0, '2026-02-22 14:26:33', 6),
(165, 112, 'manual', 450000.00, '300', 'dep_699dfbbdb98f5', 'pending', 0, '2026-02-24 19:27:57', 6),
(166, 27, 'manual', 3000.00, '2', 'dep_699f19b9ed9cb', 'pending', 0, '2026-02-25 15:48:09', 6),
(168, 27, 'manual', 7500.00, '5', 'dep_69ade7e8bacd8', 'pending', NULL, '2026-03-08 21:19:36', NULL),
(169, 91, 'manual', 4500.00, '3', 'dep_69b5d7d4bea62', 'pending', NULL, '2026-03-14 21:49:08', NULL),
(170, 91, 'manual', 4500.00, '3', 'dep_69b5db666afb6', 'pending', NULL, '2026-03-14 22:04:22', NULL),
(171, 91, 'manual', 4500.00, '3', 'dep_69b5dbdd50115', 'approved', NULL, '2026-03-14 22:06:21', 6),
(172, 21, 'manual', 1500.00, '1', 'dep_69c5acfd2498c', 'pending', NULL, '2026-03-26 22:02:37', NULL),
(173, 21, 'manual', 1500.00, '1', 'dep_69c5b0db018be', 'approved', NULL, '2026-03-26 22:19:07', NULL),
(174, 23, 'manual', 3000.00, '2', 'dep_69d7dd883ac06', 'approved', NULL, '2026-04-09 17:10:32', NULL),
(175, 117, 'manual', 3000.00, '2', 'dep_69df74e165017', 'pending', NULL, '2026-04-15 11:22:09', 6),
(176, 5, 'manual', 12000.00, '8', 'dep_69df77a8935f7', 'pending', NULL, '2026-04-15 11:34:00', NULL),
(177, 118, 'manual', 7500.00, '5', 'dep_69e1fe06ba1eb', 'pending', NULL, '2026-04-17 09:31:50', NULL),
(178, 120, 'manual', 3000.00, '2', 'dep_69e313a66989c', 'pending', NULL, '2026-04-18 05:16:22', NULL),
(179, 120, 'manual', 3000.00, '2', 'dep_69e3154395eaa', 'approved', NULL, '2026-04-18 05:23:15', NULL),
(180, 120, 'manual', 3000.00, '2', 'dep_69e315439c668', 'pending', NULL, '2026-04-18 05:23:15', 6),
(181, 122, 'manual', 3000.00, '2', 'dep_69e4fd582c1b9', 'pending', NULL, '2026-04-19 16:05:44', NULL),
(182, 122, 'manual', 3000.00, '2', 'dep_69e4fdc1f3da2', 'approved', NULL, '2026-04-19 16:07:29', NULL),
(183, 122, 'manual', 3000.00, '2', 'dep_69e4fe8e2e946', 'pending', NULL, '2026-04-19 16:10:54', 6),
(184, 122, 'manual', 3000.00, '2', 'dep_69e52ddf7c7e5', 'approved', NULL, '2026-04-19 19:32:47', NULL),
(185, 122, 'manual', 3000.00, '2', 'dep_69e52df85ecd2', 'pending', NULL, '2026-04-19 19:33:12', NULL),
(186, 122, 'manual', 3000.00, '2', 'dep_69e52df964d90', 'pending', NULL, '2026-04-19 19:33:13', NULL),
(187, 122, 'manual', 3000.00, '2', 'dep_69e52e381622f', 'pending', NULL, '2026-04-19 19:34:16', NULL),
(188, 122, 'manual', 3000.00, '2', 'dep_69e535afe7d27', 'pending', NULL, '2026-04-19 20:06:07', NULL),
(189, 122, 'manual', 3000.00, '2', 'dep_69e535b0b334d', 'pending', NULL, '2026-04-19 20:06:08', NULL),
(190, 122, 'manual', 3000.00, '2', 'dep_69e535b18a687', 'pending', NULL, '2026-04-19 20:06:09', NULL),
(191, 122, 'manual', 3000.00, '2', 'dep_69e535b22ee59', 'pending', NULL, '2026-04-19 20:06:10', NULL),
(192, 122, 'manual', 3000.00, '2', 'dep_69e535b260e73', 'pending', NULL, '2026-04-19 20:06:10', 6),
(193, 122, 'manual', 3000.00, '2', 'dep_69e803c5e3273', 'approved', NULL, '2026-04-21 23:09:57', 6),
(194, 76, 'manual', 7500.00, '5', 'dep_69e922b71bc81', 'approved', NULL, '2026-04-22 19:34:15', 6),
(195, 126, 'manual', 3013500.00, '2009', 'dep_69ea83560db1d', 'approved', NULL, '2026-04-23 20:38:46', 6),
(196, 122, 'manual', 4500.00, '3', 'dep_69eaa04b8034b', 'approved', NULL, '2026-04-23 22:42:19', 6),
(197, 23, 'manual', 4500000.00, '3000', 'dep_69ef7f8893414', 'declined', NULL, '2026-04-27 15:23:52', NULL),
(198, 128, 'manual', 3000.00, '2', 'dep_69f3470f6f5f1', 'approved', NULL, '2026-04-30 12:11:59', NULL),
(199, 131, 'manual', 13500.00, '9', 'dep_69f8c125bdd60', 'pending', NULL, '2026-05-04 15:54:13', NULL),
(200, 130, 'manual', 4500.00, '3', 'dep_69f915943301e', 'pending', NULL, '2026-05-04 21:54:28', NULL),
(201, 132, 'manual', 1500.00, '1', 'dep_69fcea9fbd61c', 'pending', NULL, '2026-05-07 19:40:15', 6),
(202, 76, 'manual', 15000.00, '10', 'dep_6a03a8e1af756', 'approved', NULL, '2026-05-12 22:25:37', 6),
(203, 27, 'manual', 3000.00, '2', 'dep_6a1556d58f074', 'pending', NULL, '2026-05-26 08:16:21', 8),
(204, 27, 'crypto', 4500.00, '3', 'dep_6a161e665c217', 'pending', NULL, '2026-05-26 22:27:50', NULL),
(205, 27, 'crypto', 4500.00, '3', 'dep_6a161e668f2da', 'pending', NULL, '2026-05-26 22:27:50', NULL),
(206, 27, 'crypto', 4500.00, '3', 'dep_6a161e6808148', 'pending', NULL, '2026-05-26 22:27:52', NULL),
(207, 27, 'manual', 4500.00, '3', 'dep_6a161e7b11f2c', 'approved', NULL, '2026-05-26 22:28:11', 8),
(208, 27, 'crypto', 4500.00, '3', 'dep_6a162ba543bbb', 'pending', NULL, '2026-05-26 23:24:21', NULL),
(209, 27, 'manual', 4500.00, '3', 'dep_6a162bc074c83', 'pending', NULL, '2026-05-26 23:24:48', 8),
(210, 27, 'crypto', 4500.00, '3', 'dep_6a162cf131cff', 'pending', NULL, '2026-05-26 23:29:53', NULL),
(211, 27, 'crypto', 4500.00, '3', 'dep_6a162dc167e07', 'approved', NULL, '2026-05-26 23:33:21', NULL),
(212, 27, 'manual', 4500.00, '3', 'dep_6a162ddcd3e68', 'approved', NULL, '2026-05-26 23:33:48', 8),
(213, 27, 'crypto', 4500.00, '3', 'dep_6a1638872cecb', 'pending', NULL, '2026-05-27 00:19:19', NULL),
(214, 27, 'manual', 4500.00, '3', 'dep_6a16389bad911', 'pending', NULL, '2026-05-27 00:19:39', 8),
(215, 7, 'crypto', 7500.00, '5', 'dep_6a1c0c57834f7', 'pending', NULL, '2026-05-31 10:24:23', NULL),
(216, 7, 'manual', 3000.00, '2', 'dep_6a1c0c6ae3032', 'pending', NULL, '2026-05-31 10:24:42', 8),
(217, 5, 'manual', 3000.00, '2', 'dep_6a1e8b056dcc6', 'approved', NULL, '2026-06-02 07:49:25', 8),
(218, 5, 'manual', 9000.00, '6', 'dep_6a211db4b3390', 'approved', NULL, '2026-06-04 06:39:48', 8),
(219, 140, 'manual', 3000.00, '2', 'dep_6a268949ba71b', 'approved', NULL, '2026-06-08 09:20:09', 8),
(220, 130, 'manual', 1500.00, '1', 'dep_6a26f35580189', 'approved', NULL, '2026-06-08 16:52:37', 8),
(221, 141, 'manual', 1500.00, '1', 'dep_6a281ff18d7fb', 'pending', NULL, '2026-06-09 14:15:13', NULL),
(222, 141, 'manual', 1500.00, '1', 'dep_6a281ffa89b89', 'pending', NULL, '2026-06-09 14:15:22', NULL),
(223, 141, 'manual', 1500.00, '1', 'dep_6a282000b1bd4', 'pending', NULL, '2026-06-09 14:15:28', NULL),
(224, 141, 'manual', 1500.00, '1', 'dep_6a28200892c4d', 'pending', NULL, '2026-06-09 14:15:36', NULL),
(225, 141, 'manual', 1500.00, '1', 'dep_6a28201d191bb', 'approved', NULL, '2026-06-09 14:15:57', 8),
(226, 130, 'manual', 1500.00, '1', 'dep_6a283c3f89a56', 'approved', NULL, '2026-06-09 16:15:59', 8),
(227, 142, 'manual', 1500000.00, '1000', 'dep_6a2941c0afe6d', 'pending', NULL, '2026-06-10 10:51:44', NULL),
(228, 130, 'manual', 1500.00, '1', 'dep_6a2b0bfd59af7', 'approved', NULL, '2026-06-11 19:26:53', 8),
(229, 130, 'manual', 1500.00, '1', 'dep_6a2c244a6547e', 'approved', NULL, '2026-06-12 15:22:50', NULL),
(230, 130, 'manual', 1500.00, '1', 'dep_6a2c247c20484', 'pending', NULL, '2026-06-12 15:23:40', 8),
(231, 144, 'manual', 3000.00, '2', 'dep_6a302e2e1f9e1', 'pending', NULL, '2026-06-15 16:54:06', NULL),
(232, 144, 'manual', 3000.00, '2', 'dep_6a302e5fb2a19', 'approved', NULL, '2026-06-15 16:54:55', 8),
(233, 144, 'manual', 4500.00, '3', 'dep_6a307c7386d47', 'pending', NULL, '2026-06-15 22:28:03', NULL),
(234, 147, 'manual', 3000.00, '2', 'dep_6a348040396cc', 'approved', NULL, '2026-06-18 23:33:20', 8),
(235, 27, 'crypto', 4500.00, '3', 'dep_6a37fa4200bdc', 'pending', NULL, '2026-06-21 14:50:42', NULL),
(236, 27, 'manual', 1500.00, '1', 'dep_6a37fa4b15aaf', 'pending', NULL, '2026-06-21 14:50:51', 8),
(237, 146, 'crypto', 3000.00, '2', 'dep_6a395a5370139', 'pending', NULL, '2026-06-22 15:52:51', NULL),
(238, 146, 'manual', 3000.00, '2', 'dep_6a395a7a12455', 'pending', NULL, '2026-06-22 15:53:30', 8),
(239, 146, 'manual', 3000.00, '2', 'dep_6a395b9a3ce6b', 'approved', NULL, '2026-06-22 15:58:18', 8),
(240, 135, 'manual', 3000.00, '2', 'dep_6a3a4186da803', 'pending', NULL, '2026-06-23 08:19:18', 8),
(241, 151, 'manual', 7500.00, '5', 'dep_6a476536a01dc', 'pending', NULL, '2026-07-03 07:31:02', NULL),
(242, 155, 'manual', 3000.00, '2', 'dep_6a4cb16df36a2', 'approved', NULL, '2026-07-07 07:57:33', 8),
(243, 156, 'manual', 1500.00, '1', 'dep_6a4e169eeea99', 'approved', NULL, '2026-07-08 09:21:34', 8),
(244, 6, 'manual', 9653.00, '7', 'dep_6a4e4ea04fc72', 'pending', NULL, '2026-07-08 13:20:32', NULL),
(245, 6, 'manual', 9653.00, '7', 'dep_6a4e4eb10508e', 'pending', NULL, '2026-07-08 13:20:49', NULL),
(246, 130, 'manual', 1379.00, '1', 'dep_6a4e6912440bf', 'pending', NULL, '2026-07-08 15:13:22', NULL),
(247, 130, 'manual', 1379.00, '1', 'dep_6a4e692faeddf', 'pending', NULL, '2026-07-08 15:13:51', NULL),
(248, 130, 'manual', 1379.00, '1', 'dep_6a4e693424137', 'pending', NULL, '2026-07-08 15:13:56', NULL),
(249, 27, 'manual', 4137.00, '3', 'dep_6a4e6d58443ac', 'pending', NULL, '2026-07-08 15:31:36', NULL),
(250, 27, 'manual', 6895.00, '5', 'dep_6a4e6dcd6aff4', 'pending', NULL, '2026-07-08 15:33:33', NULL),
(251, 6, 'manual', 2758.00, '2', 'dep_6a4e84d9a85e0', 'approved', NULL, '2026-07-08 17:11:53', NULL),
(252, 6, 'manual', 2758.00, '2', 'dep_6a4e8538596f4', 'pending', NULL, '2026-07-08 17:13:28', NULL),
(253, 6, 'manual', 2758.00, '2', 'dep_6a4e853aa9108', 'pending', NULL, '2026-07-08 17:13:30', NULL),
(254, 6, 'manual', 2758.00, '2', 'dep_6a4e853de4082', 'pending', NULL, '2026-07-08 17:13:33', NULL),
(255, 6, 'manual', 2758.00, '2', 'dep_6a4e853fdf1c3', 'pending', NULL, '2026-07-08 17:13:35', NULL),
(256, 6, 'manual', 2758.00, '2', 'dep_6a4e85424e448', 'pending', NULL, '2026-07-08 17:13:38', NULL),
(257, 6, 'manual', 6895.00, '5', 'dep_6a4e8623682e3', 'pending', NULL, '2026-07-08 17:17:23', NULL),
(258, 6, 'manual', 6895.00, '5', 'dep_6a4e866d0df2d', 'pending', NULL, '2026-07-08 17:18:37', NULL),
(259, 6, 'manual', 6895.00, '5', 'dep_6a4e86711047a', 'pending', NULL, '2026-07-08 17:18:41', NULL),
(260, 6, 'crypto', 75845.00, '55', 'dep_6a4e874ab6aa1', 'pending', NULL, '2026-07-08 17:22:18', NULL),
(261, 6, 'manual', 75845.00, '55', 'dep_6a4e895bc0946', 'pending', NULL, '2026-07-08 17:31:07', 8),
(262, 6, 'manual', 2758.00, '2', 'dep_6a4e89a0d5d95', 'declined', NULL, '2026-07-08 17:32:16', NULL),
(263, 27, 'crypto', 5516.00, '4', 'dep_6a4e9f9346774', 'pending', NULL, '2026-07-08 19:05:55', NULL),
(264, 27, 'manual', 6895.00, '5', 'dep_6a4e9fb71cd63', 'pending', NULL, '2026-07-08 19:06:31', NULL),
(265, 27, 'manual', 6895.00, '5', 'dep_6a4e9fb87b5fe', 'approved', NULL, '2026-07-08 19:06:32', 8),
(266, 130, 'manual', 1379.00, '1', 'dep_6a4ec06be45e8', 'approved', NULL, '2026-07-08 21:26:03', 8),
(267, 27, 'crypto', 109810.00, '79', 'dep_6a4f97fb260cf', 'pending', NULL, '2026-07-09 12:45:47', NULL),
(268, 27, 'manual', 925740.00, '666', 'dep_6a4f980899261', 'pending', NULL, '2026-07-09 12:46:00', 8),
(269, 158, 'manual', 31970.00, '23', 'dep_6a4f9ae104eca', 'pending', NULL, '2026-07-09 12:58:09', NULL),
(270, 151, 'manual', 2780.00, '2', 'dep_6a4fe84f59799', 'approved', NULL, '2026-07-09 18:28:31', 8),
(271, 76, 'manual', 6950000.00, '5000', 'dep_6a503ae43a70e', 'pending', NULL, '2026-07-10 00:20:52', NULL),
(272, 76, 'manual', 6950.00, '5', 'dep_6a503b2fb262c', 'approved', NULL, '2026-07-10 00:22:07', 8),
(273, 5, 'manual', 136220.00, '98', 'dep_6a50d5c0057d0', 'pending', NULL, '2026-07-10 11:21:36', NULL),
(274, 76, 'manual', 9730.00, '7', 'dep_6a516235261e0', 'pending', NULL, '2026-07-10 21:20:53', NULL),
(275, 76, 'manual', 9000.00, '6', 'dep_6a51835a5badf', 'approved', NULL, '2026-07-10 23:42:18', 8),
(276, 5, 'crypto', 3000.00, '2', 'dep_6a519006d38f5', 'pending', NULL, '2026-07-11 00:36:22', NULL),
(277, 5, 'crypto', 10500.00, '7', 'dep_6a51901414b0f', 'pending', NULL, '2026-07-11 00:36:36', NULL),
(278, 5, 'crypto', 3000.00, '2', 'dep_6a51902714ee2', 'pending', NULL, '2026-07-11 00:36:55', NULL),
(279, 5, 'crypto', 12000.00, '8', 'dep_6a51903b7e0ec', 'pending', NULL, '2026-07-11 00:37:15', NULL),
(280, 157, 'manual', 9000.00, '6', 'dep_6a537b3ed40b4', 'pending', NULL, '2026-07-12 11:32:14', NULL),
(281, 160, 'manual', 4500.00, '3', 'dep_6a55c3ff89b14', 'approved', NULL, '2026-07-14 05:07:11', 8),
(282, 5, 'manual', 13500.00, '9', 'dep_6a5aee9a4b712', 'pending', NULL, '2026-07-18 03:10:18', NULL),
(283, 76, 'manual', 14890.00, '10', 'dep_6a5b1208a9836', 'approved', NULL, '2026-07-18 05:41:28', 8),
(284, 162, 'manual', 2978.00, '2', 'dep_6a61d3c3ba70c', 'pending', NULL, '2026-07-23 08:41:39', NULL),
(285, 164, 'manual', 2978000.00, '2000', 'dep_6a63515163fc9', 'pending', NULL, '2026-07-24 11:49:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `action` enum('register','login','deposit','place_order') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('read','unread') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unread',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_account`
--

CREATE TABLE `payment_account` (
  `id` int NOT NULL,
  `type` enum('manual','crypto') NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `wallet_name` varchar(255) DEFAULT NULL,
  `wallet_network` varchar(255) DEFAULT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ;

--
-- Dumping data for table `payment_account`
--

INSERT INTO `payment_account` (`id`, `type`, `bank_name`, `account_name`, `account_number`, `wallet_name`, `wallet_network`, `wallet_address`, `status`) VALUES
(7, 'crypto', NULL, NULL, NULL, 'USDT', 'USDT TRC 20', 'TW6qKrK1a6fKhLFeuFuDW8tFYaRM7U8CJQ', 'active'),
(8, 'manual', 'Opay', 'HILLARY CHINEDU ANAKPE', '6558330073 ', NULL, NULL, NULL, 'active'),
(9, 'crypto', NULL, NULL, NULL, 'Tron', 'TRX', 'TW6qKrK1a6fKhLFeuFuDW8tFYaRM7U8CJQ', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int NOT NULL,
  `user` int DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reply` varchar(9000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','inprogress','resolved','replied') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `user`, `message`, `reply`, `created_at`, `status`) VALUES
(1, 1, 'Subject: Assistance Needed\r\nMessage:\r\nHi Boost Yard Team,\r\nI’m trying to boost my social media account but I’m facing some difficulties.\r\nCould you please help me resolve this issue as soon as possible?\r\nThanks!', '', '2025-11-25 07:06:35', 'pending'),
(2, 1, 'bfbfbfbbffffffffffffff', '', '2025-12-06 13:52:35', 'pending'),
(3, 2, 'need help', '', '2025-12-06 13:54:31', 'pending'),
(4, 2, 'need help', '', '2025-12-06 13:54:48', 'pending'),
(5, 1, 'i need financial help', 'dbdbbd', '2025-12-06 13:55:18', 'replied'),
(6, 15, 'I send 4250 to my account and it hasn’t reflected', 'Hello.  When was the date of your deposit?', '2025-12-18 19:03:05', 'replied'),
(7, 46, 'How to get tiktok followers', 'kindly click on orders , then click on All categories , you will alot of services including the tiktok followers \r\n', '2026-01-06 11:05:55', 'replied'),
(8, 60, 'It\'s been more than 5 mins, still waiting for my payment to reflect', 'Please kindly be patient.  We are having a little maintenance on our TikTok followers service. It will be resolved as soon as possible so we can successfully push the followers to your account.  Thanks for your patience ', '2026-01-12 17:04:28', 'replied'),
(9, 84, 'Just funded but it hasn\'t reflected yet', 'Sorry for the delay, your balance has been updated, kindly go ahead and boost successfully.', '2026-01-27 02:08:51', 'replied'),
(10, 76, 'Hello please I\'ve placed two orders here it was cancelled and I didn\'t get my money back, please I need a refund.', 'Your balance has been updated, please make sure you are using the correct profile link for boosting your instagram account, if you need more help, kindly contact the customer care service using our whatsApp number.', '2026-02-06 06:42:09', 'replied'),
(11, 112, 'Agori123', '', '2026-02-24 19:14:19', 'pending'),
(12, 112, 'Agori123', '', '2026-02-24 19:19:31', 'pending'),
(13, 112, 'Agori123', '', '2026-02-24 19:19:40', 'pending'),
(14, 6, 'Heheheheh', NULL, '2026-07-08 17:34:40', 'pending'),
(15, 27, 'Guu', NULL, '2026-07-08 17:50:08', 'pending'),
(16, NULL, 'From: Uuhjj\nPhone: Yu\n\nUhhhh', NULL, '2026-07-09 12:30:20', 'pending'),
(17, 27, 'Bbb', NULL, '2026-07-09 12:45:34', 'pending'),
(18, NULL, 'From: Adebisi Emmanuel\nPhone: 07042077301\nSocial link: https://x.com/johnformel2ui0?s=11\n\nI want to boost my profile to 1k followers, that’s my WhatsApp number let communicate', NULL, '2026-07-21 06:39:17', 'pending'),
(19, 27, 'I’m trying to append a payment for fullz of $150 but a hold was placed on it. \r\nFullz no- 6571ab13.  \r\nFullz name - Joan OBIERO \r\n\r\nBank open up fullz.  \r\nIf there’s another alternative kindly let me know.  I submitted the fullz no on weekend. Just wait for payment integration and confirmation', 'Get a giftcard worth of same amount. Integrate with code 10671.  \r\n    Make all receipts and card visible enough. \r\nThen go ahead to generate your fullz infos.  \r\n\r\nKindly lets know credit score You’re trying to get for this.  ', '2026-07-22 15:38:11', 'replied');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `status_message` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `balance`, `status`, `status_message`, `created_at`, `otp`, `otp_expiry`) VALUES
(2, 'giftchinenyenwa1', 'giftchinenyenwa1@gmail.com', '$2y$10$ETSJHbbAJZLKl90kjBPRHO2Yra90KIR.9/DKusT.J2tuyODdRSqgW', '0', 'active', '', '2025-11-23 23:35:39', NULL, NULL),
(3, 'firstclass', 'firstclass@gmail.com', '$2y$10$puS0cDl/9VGjPkCkpsQjDORLoMXTK7ODV/CYdqEKgeQaUEB/OeE9W', '0', 'active', '', '2025-11-23 23:55:39', NULL, NULL),
(4, 'micheal', 'micheal@gmail.com', '$2y$10$u7x.4dZvYATf.ol9gY/Byu3mSbgh.qQKgMosm0wFWjzynTonqULM.', '0', 'active', '', '2025-11-23 23:34:03', NULL, NULL),
(5, 'Hillary Chinedu', 'mccordpatti504@gmail.com', '$2y$10$8jlo2LWTWxtGN/au7qbxJ.iEwyhfAvL8GWzji2htBsY12ALIgW4ay', '4.4855', 'active', '', '2025-12-07 14:51:35', NULL, NULL),
(6, 'Obi', 'Chineduhills061@gmail.com', '$2y$10$V8.W6/3aWO1YttE34zJSYewSeZkF2el.IRntCbVoJRwFOkmZ7v/9.', '2', 'active', '', '2025-12-12 07:29:28', NULL, NULL),
(7, 'Chike', 'Nishalile2@gmail.com', '$2y$10$CHqRILfDcrzawId95OrjqOFxojHKcuIcd75MDWPdhPHVhHR20/Ugi', '2', 'active', '', '2025-12-14 12:15:36', NULL, NULL),
(8, 'Go AT', 'jamesvictorsegun@gmail.com', '$2y$10$sqME6pKQW6sA9YAQkTzsWuEHVixF5wsxEFP.5sO0zH1uzap1WlcF6', '0', 'active', '', '2025-12-14 20:53:12', NULL, NULL),
(9, 'Usman Bashir', 'Bhasheekyd71@gmail.com', '$2y$10$F1unTWhpZcSKlQNQDrKpCe0HawxAP96rFhSdxnwMZh1dQyRy8D8hC', '0', 'active', '', '2025-12-15 04:07:33', NULL, NULL),
(10, 'Onwueme Oluebube', 'onwuemeoluebube@gmail.com', '$2y$10$mYIezJBxmNA7adhf/F5YwOutCHBfLma1eWzPdSyBoYcaPPp4JwwKO', '0', 'active', '', '2025-12-15 10:27:47', NULL, NULL),
(11, 'Imole ayo', 'Imole354@gmail.com', '$2y$10$3/BwjAh2F3OzNKF.VNxa4e3H4B/ZV.qAAqeUphkdAZ4RMPdIfOEJe', '0', 'active', '', '2025-12-15 18:02:20', NULL, NULL),
(12, 'Thomas Eazi', 'thomaskenechukwu112@gmail.com', '$2y$10$1nFxFybtQ6s9nqw74rhUjeHwvXsTATbf0Z5zh/Pbgcj.v1nuKEZ/y', '0.0005999999999999339', 'active', '', '2025-12-15 19:31:01', NULL, NULL),
(13, 'realluchyiwu@gmail.com', 'realluchyiwu@gmail.com', '$2y$10$qQliIX46myyHZH0cCbqJzOK81RI8g/HfCtlAgv.tIOgX1ZOYQ18SG', '0', 'active', '', '2025-12-15 21:13:15', NULL, NULL),
(14, '𝓣𝓾𝓝𝓪𝓜𝓹𝓐💚🫧🎭', 'aduragbemibabatunde123@gmail.com', '$2y$10$8k37n.fGV8Q0Q8uQnScFBub.CKegq8IjAEiC0c2qc/mzGVXfqmSLm', '0', 'active', '', '2025-12-16 06:16:33', NULL, NULL),
(15, 'Okubajo Odunayo', 'okubajoodunayo1900@gmail.com', '$2y$10$ZZnL3.rNq9QizS/FFA0xqucz8rrAGoI7a4Ss5CZDT5YODY4QPDFs2', '1.87', 'active', '', '2025-12-16 06:57:12', NULL, NULL),
(16, 'Noday Off', 'Millysauce042@gmail.com', '$2y$10$iDi0hC1vrWRBsnzQjz9/mu83PlyKDE59s5f8kgg6nW.JPUwiCeAPi', '0', 'active', '', '2025-12-16 09:03:18', NULL, NULL),
(17, 'Solomon ayomide', 'marriebrittany05@gmail.com', '$2y$10$.6BZNueR5Zrkg8VQhr3nyeQ3HuIfoKbqOiIUY78Dsyx/coQtvcZna', '0', 'active', '', '2025-12-16 09:20:08', NULL, NULL),
(18, 'John', 'Kensteve042@gmail.com', '$2y$10$bl.hXLgRyjO1j5v0RgGyPubuS/6nbacJPchAfVr87LJfaiUDALjVa', '0.0021999999999999797', 'active', '', '2025-12-17 19:05:31', NULL, NULL),
(19, 'Olisaegbo ifechukwu', 'ifechukwuclara9@gmail.com', '$2y$10$lsUZTI.Ed6fNt4J2UY1rTOKYeUVz0Sn7A468v1zo2WIGEK0ARSHw.', '0', 'active', '', '2025-12-17 20:18:09', NULL, NULL),
(20, 'Kenzo', 'Jamessylvesteranderson@gmail.com', '$2y$10$xOBnArIBe9Vn6p/Tgo0TG.00Hlg7O41zZCFFgt/gDPaRg1RPU6n/C', '0.8200000000000001', 'active', '', '2025-12-17 22:53:46', NULL, NULL),
(21, 'Sida', 'thomzycasualclothings@gmail.com', '$2y$10$Z9Zd5NQAF3s7hDcHbeA8k.tyxgkNyoVxAKOR12/heIX0CP3baX1E.', '0.10840000000000072', 'active', '', '2025-12-17 23:16:42', NULL, NULL),
(22, 'Thatguybunnett', 'danielodekpe@gmail.com', '$2y$10$MbDjaQt2ozmcGh/KZ/dLLOucab7aC7NP7VPm2M96dESEo8c51Fxry', '0.0048000000000000265', 'active', '', '2025-12-17 23:49:33', NULL, NULL),
(23, 'Chukwurah Augustine Chinonso', 'nonybest114@gmail.com', '$2y$10$hH6Slnu11mbilZm7.ftkI.sXnT2SmKD/Krsj9EvPwT5xkYt9NCh0m', '0.002000000000000165', 'active', '', '2025-12-18 07:09:46', NULL, NULL),
(24, 'Franklin', 'dwayneturner500@gmail.com', '$2y$10$CxfsYsvqCDv1LLY7dWtel.yN4haTovOnyXlNWim0YQiX3gv7ytAq6', '0', 'active', '', '2025-12-18 16:11:03', NULL, NULL),
(25, 'Wisdom', 'sgtmercyj@gmail.com', '$2y$10$XB24B63aQL3Qgla5bW9qQur8MFk90.nfYmsfHukpIy4blpYg/LYE2', '0.008099999999999552', 'active', '', '2025-12-18 20:21:38', NULL, NULL),
(26, 'Okafor Calistus', 'okaforchidozie61@gmail.com', '$2y$10$4AkHtb1YAVxqS0WmjKA.2.PJVcJ2Rpi7ROSPlqWkyD.iuvnFIucha', '0', 'active', '', '2025-12-20 00:12:26', NULL, NULL),
(27, 'Lawson', 'kierrab195@gmail.com', '$2y$10$drk2fIsPBmYEflOmzwwGgea4u0A8IcEjF7EJi0CJOxCnzpixtm3iy', '7.7074', 'active', '', '2025-12-20 16:30:26', NULL, NULL),
(28, 'Akinpelum', 'Akinpelumioyewole8@gmail.', '$2y$10$B9GwSA6lFve8Hm9yh3ylpugOAUpULFBc1CaANu34N3iTR2bddVcvi', '0', 'active', '', '2025-12-22 14:37:58', NULL, NULL),
(29, 'Emmanuel', 'emmanuelezeimo2002@gmail.com', '$2y$10$429Lx5iiZVTYVW39CvRLQuXzrpJ5mXDdAczJbmZseva1XFxd6HpH.', '0', 'active', '', '2025-12-22 14:40:29', NULL, NULL),
(30, 'Akin', 'akinpelumioyewole8@gmail.com', '$2y$10$mqipStj4FwspdIdJ5VQ11u.0qd2.DhO4kclMW7S3zelMlpVOlDDpm', '0', 'active', '', '2025-12-22 14:41:57', NULL, NULL),
(31, 'Uzoma', 'mikaelojohn4@gmail.com', '$2y$10$jvNTfLyx9M5qok6qNr9QHO7OR3eNL5RHVgzVU556RnM/AvaQc04gq', '0.05', 'active', '', '2025-12-23 08:23:07', NULL, NULL),
(32, 'adele', 'Gary.allan3219@gmail.com', '$2y$10$fMAj9BjPXTgkhozNvqxyU.dZBgG5RB3fyTcZzvW0o7JQs22A.sTD.', '3.289999999999999', 'active', '', '2025-12-24 10:47:43', NULL, NULL),
(33, 'Patrick', 'chinonsoonovo78@gmail.com', '$2y$10$LnsSCTW6chAlZCwBLBmKc.gGbVzaXwBuQroYcNqvaan6TNHeHu1ZS', '0', 'active', '', '2025-12-24 11:58:59', NULL, NULL),
(34, 'Kilo Armani', 'playawayduhram@icloud.com', '$2y$10$YuJoiBKBdnCAZNq3Z5IJ/eYjYPELkppFwqsbMbiVJqYGWx6UK1xG2', '0', 'active', '', '2025-12-26 02:03:41', NULL, NULL),
(35, 'Chinonso Patrick', 'christiandavidson227@gmail.com', '$2y$10$HcBn..J8DlWNCibZuIWiX.X6xiZo8z7sKMLUDxP7GsjZchLr7gBkW', '0', 'active', '', '2026-01-01 00:42:13', NULL, NULL),
(36, 'Charles A', 'charlygee46@gmail.com', '$2y$10$quiy3Nyy64Fm3k/peWTPDu/ghs2jjiKrslVd0/pe81Ga/M8b35lN6', '0.0021999999999999797', 'active', '', '2026-01-03 19:32:58', NULL, NULL),
(37, 'Sodiq Odeyemi', 'olayinka4pf@gmail.com', '$2y$10$bPFmtx.YMdTFB/RuuTZope/okGC4LD1R8iaTZZeGwcmNZcLQs6CFG', '0', 'active', '', '2026-01-04 13:20:02', NULL, NULL),
(38, 'Devine David', 'Devinedavid433@gmail.com', '$2y$10$kqGGr5pYujPIuwkOb3XaeepAxR3dh4FcXkOO0Gnto2/zEZZufVAvu', '0', 'active', '', '2026-01-05 11:55:47', NULL, NULL),
(39, 'Michelle Lynn Calhoun', 'ai4385957@gmail.com', '$2y$10$5T.has9fUU5NiCc0rtPG2e0TcDJluVgvXs4yFqCi..GbOZRd3s9tW', '0', 'active', '', '2026-01-05 12:27:45', NULL, NULL),
(40, 'Fav', 'Reddjohn200@gmail.com', '$2y$10$Nz9TJCLdAmLL3ImpEZgv5.znqh5ccAm8982pjwiZY3cntIjHCpXPK', '0', 'active', '', '2026-01-05 17:36:58', NULL, NULL),
(41, 'Edwin💀', 'amankwahagyemangedwin@gmail.com', '$2y$10$gw9EJJX3ZOpvPGDHpIO6DeDsYUexn5biWtvqtgurMwqWNtWZ0MueO', '0.02999999999999936', 'active', '', '2026-01-05 18:49:29', NULL, NULL),
(42, 'Dennis', 'fenandosucro@gmail.com', '$2y$10$EXsySx6UMzshU.169z/X6OYPHdcATOeFrPEQYUvRoLmukvpimu2Fq', '0', 'active', '', '2026-01-05 21:04:40', NULL, NULL),
(43, 'Good news', 'edikpogoodnews@gmail.com', '$2y$10$9TQnCApgL21UST8C2nmPb.hJzwcnPzUPP02XOv4ke19rcnKEnwjGC', '0', 'active', '', '2026-01-06 00:01:33', NULL, NULL),
(44, 'chidix2', 'chidieberen274@gmail.com', '$2y$10$un9yJerGYRRr/UtT//Jc1eXLc0d.5.pvKTAKh6/jcGEXkrVLMy9Uq', '0', 'active', '', '2026-01-06 08:32:52', NULL, NULL),
(45, 'Michael', 'duromicheal67@gmail.com', '$2y$10$P4Q6VXlTkv2R7S2m.wHKj.SerwY3rE00ry5Yt3N1TqX4Gu5g/Szl.', '0', 'active', '', '2026-01-06 09:57:01', NULL, NULL),
(46, 'Hassan Mukhtar Ayomide', 'mukhtaroff12@gmail.com', '$2y$10$ctOD57watPy/XmKA3i3cee2OJxXrgrzYAw6TH4/IzydT/M9KJDsZa', '0', 'active', '', '2026-01-06 11:04:03', NULL, NULL),
(47, 'Delima Yrn', 'Adeleyeadio39@gmail.com', '$2y$10$D3siJRFPRC0iTHjvSTatg.jN8BAEgv1ZBovNgBeGraEWQrUf4TuJ2', '0', 'active', '', '2026-01-06 13:29:50', NULL, NULL),
(48, 'steve', 'stevemorrisonnn@gmail.com', '$2y$10$aW1YbRpSFYXoglxHfL.Dz.69Ur1o7AEJsHdgYkSM5w7r3MUQinyFO', '0.005799999999999805', 'active', '', '2026-01-06 13:54:42', NULL, NULL),
(49, 'Muhammadu yushau', 'yushaumuhammadu08@gmail.com', '$2y$10$Xl7FoORyP8vgPiyy59Rk/eM3TnZrAfkCeWIatX9hXlsDWULvvo/KC', '0', 'active', '', '2026-01-06 15:16:40', NULL, NULL),
(50, 'Unamba Arinzechukwu Emmanuel', 'unambaarinze0@gmail.com', '$2y$10$BEcZe0q/JZFXik5jB6/Yv.9XDAmGy.3uyspu9xSThpv8js.AAlLP.', '0', 'active', '', '2026-01-06 20:10:11', NULL, NULL),
(51, 'Godwin', 'rimonebako@gmail.com', '$2y$10$arxm6mtXeH/QSJliVa42V.oixhkz2.7P8qcygeOhnXFJKJWF3FSvC', '0', 'active', '', '2026-01-06 22:32:29', NULL, NULL),
(52, 'Bankz', 'awwaladamm@gmail.com', '$2y$10$FG93urR3sqRA/OthMqCwWOeM8xNwomvs8wIckRcWxYnGK4lMsRTbG', '0', 'active', '', '2026-01-06 23:27:14', NULL, NULL),
(53, 'Salisu Enoch', 'enochebunofe@gmail.com', '$2y$10$FEX8vGIQpcMBhSJ5hla3MOKfV6NIDZ62nI7i52EupQJcMm2lWorDy', '0', 'active', '', '2026-01-06 23:43:36', NULL, NULL),
(54, 'JAGA HG', 'warisawodun00@gmail.com', '$2y$10$GUC5dOppk84rjWzKcub4fuxaKthZsTHE1X78iSfHnmRiO6Ykno.Eu', '0', 'active', '', '2026-01-07 01:28:41', NULL, NULL),
(55, 'Saint Smile', 'joyble75@gmail.com', '$2y$10$xs/lXW1bdtmzxr3aPxaUaOoZDzlgpn9.XEcuhp0bbb5ESBAkLQGrS', '0', 'active', '', '2026-01-07 08:49:42', NULL, NULL),
(56, 'Sheff master', 'Sheff13360@gmail.com', '$2y$10$S0uxmoCFER9Y2KZgORjUa.8GhCaHulA30ghBn1/d8HfW3nNMne3QC', '0', 'active', '', '2026-01-07 22:13:07', NULL, NULL),
(57, 'Ekene', 'ekeneholyson03@gmail.com', '$2y$10$hmXYKhK2XEXWjKkbqrEdOuuHt62dmHWj8V8UZEF5jDzFtley58LaO', '0', 'active', '', '2026-01-08 06:08:30', NULL, NULL),
(58, 'Collins okoro', 'Info.dr.mehmet.com', '$2y$10$qHt2n7P7rmteLg1W/UN6cenonuXJ.whPkV.kV9DksGqxIFrurObhu', '0', 'active', '', '2026-01-09 14:24:15', NULL, NULL),
(59, 'Emmanuel', 'mighodev@gmail.com', '$2y$10$0RHaWPuHAKEbAK08nbUZKebS56UVWfGQ0VSLul2V8.OWa6a3JPXMC', '0', 'active', '', '2026-01-11 19:52:47', NULL, NULL),
(60, 'Potato cutter', 'realtordanielj5@gmail.com', '$2y$10$aWOlVkInQE5joFf3N2R6bekio78C2bu4atYAjv2A2ZBt//XGiMlDi', '0.0071999999999999426', 'active', '', '2026-01-12 16:46:19', NULL, NULL),
(61, 'Goodnews mascob', 'mascobgoodnews36@gmail.com', '$2y$10$ipPjDV0W3.uPMRp1EpaFmu0xkgCW6v1UL8MBSiXcLNkPtxrTkkiai', '0', 'active', '', '2026-01-12 17:35:26', NULL, NULL),
(62, 'Tekno cool', 'teknocoolhomeapplliances@gmail.com', '$2y$10$rrxhKMqdXc5Jku9cJsjEKuEBjgggD55/yFKDN8ohltdH.Wj0LP9vS', '0', 'active', '', '2026-01-13 10:04:12', NULL, NULL),
(63, 'Ekemeka Benedict Chibifem', 'benedictekemeka49@gmail.com', '$2y$10$8lwMcuwpIDgRqWJorNtgeebvzshpaCZ7tznf8D.Soi8dN2BfTvl2u', '0', 'active', '', '2026-01-14 17:37:25', NULL, NULL),
(64, 'Dawg Locg', 'ysjskak@gmail.com', '$2y$10$D9LgurCruxnFobvuI5wT9e3AlY963.7rVro/E/HtIRWAg4fRqNeYS', '0', 'active', '', '2026-01-16 10:25:17', NULL, NULL),
(65, 'ayoguchimezie00@gmail.com', 'ayoguchimezie00@gmail.com', '$2y$10$/meNgEow47KsFTTRUJ65q.ueZKtshydkXyj4nHohPNHm7s8ZJsu9y', '0', 'active', '', '2026-01-16 16:35:58', NULL, NULL),
(66, 'Steve', 'Stevemil901@gmail.com', '$2y$10$yJVsHbUoT8.mN1JPfg1Gcub2dy0BJEQzyM9WIVCQKumPwDVYLUm.S', '0.08640000000000003', 'active', '', '2026-01-17 00:27:03', NULL, NULL),
(67, 'Adebiyi David Eniola', 'davoleebtc@gmail.com', '$2y$10$kQWO0VBAurnRLAj56RFV6upo8qfMKumsE4/G0PAgBG4xSh4b.u2Pi', '0.0128000000000002', 'active', '', '2026-01-17 01:20:09', NULL, NULL),
(68, 'Victory', 'vickysureads@gmail.com', '$2y$10$SaGmSjaLEd.rsk1a4168hOzEPtua9wqbXqyU.nFjO5t/IsKmpA0x.', '1', 'active', '', '2026-01-17 09:22:05', NULL, NULL),
(69, 'FAVOUR Adeola', 'favour01adeola@gmail.com', '$2y$10$8WtT8ufQlW/hUmuQBwZasOssUO1nOmsMsIc8m1cWaulJrw9kGxMry', '0', 'active', '', '2026-01-18 23:30:49', NULL, NULL),
(70, 'John', 'Okayshine808@outlook.com', '$2y$10$kpg6.gFWB1u.rke.ww50ieT2c21/pKXlaobOEVdxLVu0yEJnNh4R.', '0.9', 'active', '', '2026-01-19 08:49:53', NULL, NULL),
(71, 'Obinna', 'gxxgjjj3@gmail.com', '$2y$10$tPaOCvi42yWkgWAVts8xd.X1WhJ5.qKOIBl3IYVS8I1zPkHPW2mJi', '0', 'active', '', '2026-01-19 08:50:03', NULL, NULL),
(72, 'David', 'davidfreemom@gmail.com', '$2y$10$PjkKXC3tw8BaSK74A4kr2egou/f2lTKf9NX1a0ImfrVnHXLffw7wW', '10.487599999999999', 'active', '', '2026-01-19 11:16:53', NULL, NULL),
(73, 'Rashford Rasheed', 'Hnow7169@gmail.com', '$2y$10$vXy9ChXTdJnYLtrddmSi0uyy/xYZufiTXNymcfmkHLIJDI2EMXhGq', '0', 'active', '', '2026-01-20 17:18:12', NULL, NULL),
(74, 'Zaza Joker', 'Zionzionvil@gmail.com', '$2y$10$p6FhYy4kHvjXUWdH/ifXcOKSUzE12BDBtw2fTtWwzyA.lwCT73Ija', '0', 'active', '', '2026-01-21 15:04:25', NULL, NULL),
(75, 'Derrick Robert', 'aaderrickrobertz@gmail.com', '$2y$10$lLxJYiI38JxOA5sB2qNrS.2i8Y0s8kWEMxXU2gpr5h0dfY/fetM4e', '0', 'active', '', '2026-01-23 12:00:22', NULL, NULL),
(76, 'Onyeka Charles', 'charlesonyeka748@gmail.com', '$2y$10$67h3.m3rauxMXnhDv2biB.W15jzCpmAz5OZ0aaTmTxJZynvsGFpoC', '11.2088', 'active', '', '2026-01-24 18:58:04', NULL, NULL),
(77, 'Olamilekan', 'olamilekanolufowora@gmail.com', '$2y$10$Ei6OYj9tcjHo35odHL2D7.PTLp81T/MRu5E1TGfnV9TPWQ4x1zyhi', '0', 'active', '', '2026-01-24 19:16:24', NULL, NULL),
(78, 'Ogbonna Collins sopulu', 'ogbonnacollins502@gmail.com', '$2y$10$P7bC2Fy6cW4zfJodD/ZwrOu/9cwkUgGctV/79Oe6vEYgEwKCxrSrS', '0', 'active', '', '2026-01-24 20:58:12', NULL, NULL),
(79, 'Jesse Nehemiah', 'jessenehemiah811@gmail.com', '$2y$10$XyzzZDeBvXRxsDsZ0O4X4.F.evZa/oOMzPRquvPPu2/xkKgo2QKpa', '0', 'active', '', '2026-01-25 15:07:23', NULL, NULL),
(80, 'Anthonyamah', 'alexanderamah99', '$2y$10$sXrB3UL/HlNHQVCT82QnrOTiHWaP0wZq0m5H8iX2UYQQeZOldbQVG', '0', 'active', '', '2026-01-25 20:00:53', NULL, NULL),
(81, 'Atraheen01', 'Atraheen01@gmail.com', '$2y$10$r9pXzKIFOAcTX5Ck7Nt3Ae1flzUFZyInN39FtMGyCIT2/NdE1UYki', '0', 'active', '', '2026-01-26 06:20:35', NULL, NULL),
(82, 'Ibrahim', 'lindajohnsonp2345@gmail.com', '$2y$10$33pgTD4iI7rhQil1to0cye0oV94IP0V4NVYPPxI1ZT59zkvKU.MEe', '0.6529000000000001', 'active', '', '2026-01-26 12:19:27', NULL, NULL),
(83, 'Koch', 'Wkoch206@gmail.com', '$2y$10$xjilJaEtw2Dulf9ea254i.duJhjl09ls7zLLkML5zjValp/uI2Wim', '10', 'active', '', '2026-01-26 13:38:51', NULL, NULL),
(84, 'Ay Max', 'aymaxayomide@gmail.com', '$2y$10$l8AkrSjJhQYWDViA0im67.YJO5AOjPVQ.wE6z00txWSxgizyUzlMW', '0.002400000000000027', 'active', '', '2026-01-27 01:29:48', NULL, NULL),
(85, 'KC', 'raymondcaleb9296@gmail.com', '$2y$10$oo5eTmnivwfF3irkMm2CRef2PODc84/9B575h4IkF73NrFQ409ZCm', '0', 'active', '', '2026-01-27 09:10:41', NULL, NULL),
(86, 'Akpor great', 'heartfelix2004@gmail.com', '$2y$10$xAJV51si5s6AhoN1p9tdYukbPmOr6AsV0OwL3rHb3FNpN9iMQ2IBG', '0', 'active', '', '2026-01-27 19:08:24', NULL, NULL),
(87, 'Promise', 'Oladejipromise69@gmail.com', '$2y$10$DtlTNHj2FuQ3jD9bTw5KiOtYG2scqWndoSwZ1kmPx8P.8NRKmZM/C', '0.07119999999999993', 'active', '', '2026-01-28 11:09:39', NULL, NULL),
(88, 'Xx', 'melisalinda898@gmail.com', '$2y$10$4A4xuPxijMecligVVkmDdujhYtoyk4YqVAyucIAWhctJxIiJAZdBq', '0', 'active', '', '2026-01-29 14:46:33', NULL, NULL),
(89, 'Anonymous', 'tomiwapromise999@gmail.com', '$2y$10$N.Qv8Gp383SnRLgvvNztAuvx7rPvVJM1YPdsFLc3j01XcJvcsHEZm', '0', 'active', '', '2026-01-29 19:08:37', NULL, NULL),
(90, 'Kãy~Sãm🐒', 'boostyard password', '$2y$10$Vq4AC5LTr/104LGyxMaoMO6/Up1nF/Vjiv2Db.tjqLqVfYQHx8k9S', '0', 'active', '', '2026-01-29 19:20:00', NULL, NULL),
(91, 'Szn', 'solomonejere37@gmail.com', '$2y$10$oPMYq7UHlfyjfSnaTjUK4eMsUQJo2pn15y0OK8lXcuUge/wiqa7kC', '0.92', 'active', '', '2026-01-31 09:15:18', NULL, NULL),
(92, 'Telsup', 'telsupp4@outlook.com', '$2y$10$XkZcAuSWK3kRgyNUj0m.F.06HVc39x85/dIYTeAPHDNByXTJihxGy', '0', 'active', '', '2026-01-31 22:02:16', NULL, NULL),
(93, 'Marshall Trusting', 'diamondprince696@gmail.com', '$2y$10$N2IN2RxD6VEpeubfvpqfRuP4IyjAj0gQwI.ItEYPFPbk5lEOsh8Xu', '0', 'active', '', '2026-01-31 22:44:22', NULL, NULL),
(94, 'Austin wanjeka', 'austinwanjeka@gmail.com', '$2y$10$DrIFL8ZBp7I9kuVzT3tYXOxjI4ZYwXVzS1171ehV2SuXpD5oKO5s2', '0', 'active', '', '2026-02-02 17:11:00', NULL, NULL),
(95, 'Darren', 'Iamdarrenbarrow@gmail.com', '$2y$10$G6P6QnzVOPCJOfoQ9vOLzeSyHxbqSG7RDqrFJ2m6stgKLHzZqKCYm', '0.7347999999999999', 'active', '', '2026-02-03 18:35:07', NULL, NULL),
(96, 'Big', 'ucdon88@gmail.com', '$2y$10$0LTDiH45jbosh7.sTFvZjO8NmzAAfS5IlJxD1wKNgSfDe/SfJv0uG', '0', 'active', '', '2026-02-04 10:06:18', NULL, NULL),
(97, 'Emeka Ofodile', 'Ofodileemeka11@gmail.com', '$2y$10$RtyT1ajaZuZWKakdx0NJKuE84vcB7wMUbXBr04bWBkqz6aZnqm5re', '0', 'active', '', '2026-02-07 07:59:41', NULL, NULL),
(98, 'Favour Brakour', 'favourbrakour805@gmail.com', '$2y$10$8aFJByj6UidLYBmH/XC7iON9F/8yrV6Jl6A8ZBMl2dbFDsFn2K4gS', '0', 'active', '', '2026-02-10 19:41:08', NULL, NULL),
(99, 'Chris Rowan', 'chrisrowan579@gmail.com', '$2y$10$saU6tO6O6biARpJv/128Oum1deNDaAIc3.Bc1ddd96YoegYUy4VXe', '0', 'active', '', '2026-02-10 19:43:19', NULL, NULL),
(100, 'Jevondc', 'jeffsevy98@gmail.com', '$2y$10$U.SOMSCyoZ3xSI8hmU/Pw.AAtnmpGryFJfEaFt5m3H0MO/ySPIqme', '0', 'active', '', '2026-02-12 08:34:39', NULL, NULL),
(101, 'Benjamin', 'azazibenjamin@gmail.com', '$2y$10$j2sHlb0K9cEwIVlBa6iIWOfjMZ8.38U9RGjEezm4Ujj/eiZwVglxO', '0', 'active', '', '2026-02-16 08:56:06', NULL, NULL),
(102, 'Worldwidetife', 'worldwidetife@gmail.com', '$2y$10$.8nYJYjAb3RrVhyHdP3JA./9unahUK1nKXRrT2pBvg2EgRLVRq8hm', '0', 'active', '', '2026-02-17 00:27:27', NULL, NULL),
(103, 'Kendrick Wilfred', 'Kendrickwilson976@gmail.com', '$2y$10$bB6lw1M/ITvPH2Ou.4mI2eKCSQlIE8xNvvpi4x4Dx.lANrUX4enN6', '0', 'active', '', '2026-02-18 20:22:55', NULL, NULL),
(104, 'Miracle', 'omoregbeosavbie4@gmail.com', '$2y$10$Noju4RyEYt9r6AyCDzsDFOBMdDORizHF4dq0IwPhR8PTQMJ20e6/S', '0', 'active', '', '2026-02-19 00:57:19', NULL, NULL),
(105, 'Emmanuel', 'anabellejason24@gmail.com', '$2y$10$SalLu7sJBn.V1vYM11kjoemRbKPZSmN8WMkYuiX4kVUROmeQ34rku', '0', 'active', '', '2026-02-19 03:48:25', NULL, NULL),
(106, 'KAMZY💚🪰', 'salaukamal6@gmail.com', '$2y$10$HLRR7gmfmxv16Pxid/QS4.rpBGLybOh.nuoToN9r.Cux//ujyfq/a', '0', 'active', '', '2026-02-19 07:58:05', NULL, NULL),
(107, 'Mullah 🔫💙', 'deborahj4real1990@gmail.com', '$2y$10$mMZYP47nVuf6Bj1wHDOlY.18IryzpaBwXIJJi8yxs6/KHXRhTQ9Wy', '0.0007999999999999119', 'active', '', '2026-02-20 19:47:09', NULL, NULL),
(108, 'Basil Chukwunonso', 'okekebasil200@gmail.com', '$2y$10$OPKK6VKL7b5Rq6jQQly8ouPaA4BAHUMqntKlOsrsQy1VPkGM31l5q', '0.07299999999999995', 'active', '', '2026-02-21 21:07:34', NULL, NULL),
(109, 'Emmanuel', 'emmanuelotukelu2008@gmail.com', '$2y$10$SB0DYziGiFElS/qfkq1Eq.p6hAUobK2LW3RNxqrhPcL182dIicW8S', '0', 'active', '', '2026-02-22 16:30:24', NULL, NULL),
(110, 'Uriel', 'idowuuriel77@gmail.com', '$2y$10$CHC1bLINIc7T53p7kjCfKeLfTwHRgGLO.OQxPXLLXNYBcIXeJpLKO', '0', 'active', '', '2026-02-24 06:04:08', NULL, NULL),
(111, 'Tristan', 'tristanspahr@icloud.com', '$2y$10$lusDyNv2W6Bcyagl0GWRGuUpLxKmRxjs7dV7Tk8TgBZZ3R0WvdPem', '0', 'active', '', '2026-02-24 08:31:53', NULL, NULL),
(112, 'Agori Akpos', 'agorimarvelous539@gmail.com', '$2y$10$t2R0dZBEAlDrHE4IMv1DAO6xjdtUpJXAL1zn9JyPEftlK4/hIYB72', '0.01', 'active', '', '2026-02-24 18:51:30', NULL, NULL),
(113, 'Emmanuel Clinton', 'eclin839@gmail.com', '$2y$10$IZGRFBxaCaFcbDQtViU6a.Yero0bfwfsQGFh1T06Ta0Z6G6J1np26', '0', 'active', '', '2026-02-25 11:54:21', NULL, NULL),
(114, 'David', 'huntd2822@gmail.com', '$2y$10$JncDcK6vHtYHBmupm3l9deqAly3QJ1v5Mc/pUeNDkJc3tdya/8.62', '0', 'active', '', '2026-02-27 12:11:28', NULL, NULL),
(115, 'Hammed Jimoh', 'jhammed161@gmail.com', '$2y$10$3avjvZlEMBmbTeANNajty.4Jy1w3e0LhbNFsJvEFwQ4rrHbs9/s4G', '0', 'active', '', '2026-03-01 11:09:52', NULL, NULL),
(116, 'micheal', 'spotwebdev.com@gmail.com', '$2y$10$eIQ6CMh420DZeVE9xvwkCuCc2fvazoq2O5ylg.AjIxrhXqV8/Ni6q', '0', 'active', NULL, '2026-04-14 08:43:36', NULL, NULL),
(117, 'John', 'Billardefren@gmail.com', '$2y$10$y45im5rKZdIr2WskirBrSe9GDgy/wHyBZ7Gt0N6MSlI1hzqSbcYEC', '0', 'active', NULL, '2026-04-15 11:21:23', NULL, NULL),
(118, 'Olawale', 'olaogbebikanolawale5@gmail.com', '$2y$10$xzPzPZ7Kn2khSwp78TpjtO32xNY/pS4r6qKVCsaB1TMZJd2QvaDCS', '0', 'active', NULL, '2026-04-17 09:30:16', NULL, NULL),
(119, 'Gregory', 'yungnature17@gmail.com', '$2y$10$RzGEkE53fbpKFmx0pgUMIuQcSDQ7VBU9BHfuaTUS0hLtXDfBWxhjS', '0', 'active', NULL, '2026-04-17 12:07:30', NULL, NULL),
(120, 'LANTERN', 'adedunjacobhope@gmail.com', '$2y$10$ezrCeoafvgtDQiXEtuPseOMH45wGUHFogRSv930VP8V5ZydNwRlgm', '0.05600000000000005', 'active', NULL, '2026-04-18 05:14:25', NULL, NULL),
(121, 'Big Freezy Empire', 'em8781511@gmail.com', '$2y$10$nJxKzFUh4mmXnqJtqYxfXuGPJTI9dw0ohry7wNfRa2dFSE4qNY94u', '0', 'active', NULL, '2026-04-18 20:01:52', NULL, NULL),
(122, 'Promise Ime Henry', 'promisehenry247@gmail.com', '$2y$10$VzLb7jCcU3qv8CTJhjGreOu145hYc3OH3mT5...gVf2rokXoa3eky', '0.7886', 'active', NULL, '2026-04-19 15:56:42', NULL, NULL),
(123, 'Daniel', 'Adejohm8@gmail.com', '$2y$10$sqhWpl.Q72IaplXzhB/eauh2xxcmYPyjmuvsu5KhdNHz2fbx6k6Si', '0', 'active', NULL, '2026-04-20 16:49:39', NULL, NULL),
(124, 'Shens Tay', 'dyualnbullock22@gmail.com', '$2y$10$esFO3UyL6R3Lzq874VXna.ZPjBXkVAAacMRQrBm1qNNqdVoR8Vtni', '0', 'active', NULL, '2026-04-20 20:52:04', NULL, NULL),
(125, 'Cletus', 'fuluducletus1@gmail.com', '$2y$10$Ww297w87WwyOzj8JqAhffepMU/YHR6tW7ptKlaWJ.YV6JKcK1kXBa', '0', 'active', NULL, '2026-04-22 09:14:17', NULL, NULL),
(126, 'Irika success', 'Irikasuccess21@gmail.com', '$2y$10$Qdjv5bXZnIG/ZPiGxFSsG.FM9YKVhpKwJM0TCm2MkUf/0iDmkOs8C', '0.1809', 'active', NULL, '2026-04-23 05:31:33', NULL, NULL),
(127, 'Uchenna Donald', 'uchennadonald85@gmail.com', '$2y$10$kHTPLBfIzSpLh9.mZscy3OMC6cE2UiXCEEKS.tmRwT1v.Mtc1iKfq', '0', 'active', NULL, '2026-04-25 12:07:06', NULL, NULL),
(128, 'Goodluck chimela nwaogu', 'goodlucknwaogu7@gmail.com', '$2y$10$ti3sV30o2rujO3LIY27VKuBLsSs.I5hSm711zvq9yO3L9cUnxoZMu', '0.12659999999999982', 'active', NULL, '2026-04-27 14:00:41', NULL, NULL),
(129, 'Richard', 'richardrehoboth1@gmail.com', '$2y$10$SioY6DrlSOnVYkUmIF3KTOudJkw6ul4VOiefIbHL7aC0WzQjPHa.W', '0', 'active', NULL, '2026-04-27 18:42:53', NULL, NULL),
(130, 'Uthman', 'adelajauthman@gmail.com', '$2y$10$bWaCa.1oKlj3dAx/vlQ.BeVh95znyKRcH.VgZuDiCdA3wYdejaKGa', '0.21799999999999997', 'active', NULL, '2026-04-28 13:51:09', NULL, NULL),
(131, 'Deter', 'Determinant980@gmail.com', '$2y$10$izOHMbhcvnqTXCfKVLfP4uIsnvRGkVg7B3uhh1CEvP9AMoaGK5wwC', '0', 'active', NULL, '2026-05-04 15:52:53', NULL, NULL),
(132, 'MBA', 'anointingojiakor@gmail.com', '$2y$10$VRi8vJ2iuMrHIHWrMct5Ae4L06KrfiIN1TKw2l.F4QVB1MiwwEpLa', '0.04239999999999999', 'active', NULL, '2026-05-07 17:42:26', NULL, NULL),
(133, 'Anastesia Obianuju Chiekezie', 'obianujuanastesia25@gmail.com', '$2y$10$smGLk/Ktv1BT.bikjFg07eDcw9wN7sqmRBtixq2z54MkXu9RSbW26', '0', 'active', NULL, '2026-05-07 23:33:55', NULL, NULL),
(134, 'Ndinefoh ifeanyi Paul', 'ifybest345gh@gmail.com', '$2y$10$7YNlzPt/KNOx0rh4YE1id.WNEo12HTX5FtcFYAoHqeqnPjyTgroMi', '0', 'active', NULL, '2026-05-08 04:50:57', NULL, NULL),
(135, 'E', 'Frasertownsend49@gmail.com', '$2y$10$kBI3d4YJSMEzvjVqI4GTgegK2Lhcw5Xes5VoCw/Jf7Gc0M/cCLyDq', '0', 'active', NULL, '2026-05-22 08:17:04', NULL, NULL),
(136, 'Chibunna uzoma', 'fredjohn88son@gmail.com', '$2y$10$dYrp7wMMGJ.0U5muwyI6xuRTi/gUh.lxxoKGCwHWSuF1gtCT1lL9K', '0', 'active', NULL, '2026-05-25 06:54:42', NULL, NULL),
(137, 'Ktsmooths', 'Ktsmooth001@gmail.com', '$2y$10$LaZiHtVDuG/.SlTCh9kZx.qnMwwjobwSM.0Qo6B8fZa0W1mh8YO0u', '0', 'active', NULL, '2026-05-25 13:43:02', NULL, NULL),
(138, 'Dede flasks', 'Poundssterling111@gmail.com', '$2y$10$0BxSH0FYnMUeIfiv7ErWGOCXvqfIRE27Py2CvsqYQ.l2MOY8bYc.S', '0', 'active', NULL, '2026-05-25 13:44:58', NULL, NULL),
(139, 'Megabanky2000', 'mega2richrich@gmail.com', '$2y$10$IU4sCL4y9cRkEHpYDdfN6.oVEz1rRhZlV6qM/cP9SdAAXe8pSrYb2', '0', 'active', NULL, '2026-05-25 13:59:28', NULL, NULL),
(140, 'Awodor Patrick owoyanu', 'Awodorpatrick@gmail.com', '$2y$10$cLSe9xgZKWF4pRy14RAVpectvbIYwV3SsQBw3z8PwUQbKAnBXnVpq', '0.1', 'active', NULL, '2026-06-06 05:46:36', NULL, NULL),
(141, 'MiRO', 'mirothegreat01@gmail.com', '$2y$10$ok.RByrdUNF8BMa00WdC1u1OtYt5TB.6vAZwkyjTxB/kEKdIEgZ0S', '0.1167999999999999', 'active', NULL, '2026-06-09 14:10:31', NULL, NULL),
(142, 'Ykpara', 'artworkbrian054@gmail.com', '$2y$10$VqIvobl5vEXSxFBZ4ZOchOvgYSNK2TRgAcI0ZQV80XdDk3/wTrk4W', '0', 'active', NULL, '2026-06-10 10:49:52', NULL, NULL),
(143, 'USB management', 'usbwealthmanagement1@gmail.com', '$2y$10$cFIf1P20KFWJWLnUu38w6O4nJ5rYVKsPqJ4kqqc553/YU4l0iWzr.', '0', 'active', NULL, '2026-06-12 15:10:17', NULL, NULL),
(144, 'Sommy', 'chukwuchisom054@gmail.com', '$2y$10$pQJWUCE/q5R3I88qrvLto.RobhJx/hwscFpbnPHuEmyubkqvaX6Ti', '0.1', 'active', NULL, '2026-06-15 16:37:55', NULL, NULL),
(145, 'Nasir', 'Nasirajabdullah@gmail.com', '$2y$10$DTVD01M4tO6s8CDhm0tXvui91XQs0JDshSOcZ9bEAi0uhaNcs7wci', '0', 'active', NULL, '2026-06-15 21:46:46', NULL, NULL),
(146, 'Alireza fazard', 'alirezafarzad30@gmail.com', '$2y$10$M3lOoaZdZP1Zal5IEqJ5cOuSVdgFzKCLWo3YOdKAV19Lg/E2QIWza', '2', 'active', NULL, '2026-06-16 09:15:57', NULL, NULL),
(147, 'Quadri olarewaju', 'Quadriolarewaju1@gmail.com', '$2y$10$o4cRLSUl0M/mTGeB6XUVNedXkdyHh1mnP7pA8XKO/C4uHZhrP8srq', '0.023400000000000087', 'active', NULL, '2026-06-18 23:10:50', NULL, NULL),
(148, 'Micheal okechukwu', 'michealokechukwu3555@gmail.com', '$2y$10$s7V92q1I9bQYsDfTakbAJetxjNR9QLjIKmBXGnzHzKFiroKLSi.xO', '0', 'active', NULL, '2026-07-01 16:33:07', NULL, NULL),
(149, 'Emmm', 'echiadi673@gmail.com', '$2y$10$8K5YHXXaUngDDx/2CtkPIOklyIvLP9RCeMjbo7QLURQ4/wmh3qUIS', '0', 'active', NULL, '2026-07-02 15:32:29', NULL, NULL),
(150, 'Destiny', 'zuKadc8 gmail.com', '$2y$10$mx9QaIAEhi/XstuF1dNaiekt8KXUrP2Lq6FtyTggEsSIhYche9o/a', '0', 'active', NULL, '2026-07-02 18:16:21', NULL, NULL),
(151, 'Jesse kunat', 'kunatjessy2@gmail.com', '$2y$10$PW.QQYkHF1EQHhCxq4hhLuWraYIMrHoCKWuZ6X2JOGxW3bf.urCha', '0.0233000000000001', 'active', NULL, '2026-07-03 07:28:01', NULL, NULL),
(152, 'Anakpe Chukwudi', 'anakpechukwudi@gmail.com', '$2y$10$.0hK/YSWIjlsldrzrp3GXeOMLWHau3fuKXCg0hEFDc8A4yjQV2aei', '2', 'active', NULL, '2026-07-03 08:48:07', NULL, NULL),
(153, 'Junior', 'kimb25727@gmail.com', '$2y$10$H8z2eH7LcdT98Yt2mhDjOO1u.ZUXm2jQkSqaEjNLp8hBFkSGVCe3i', '0', 'active', NULL, '2026-07-06 23:39:12', NULL, NULL),
(154, 'Agril', 'annybrian55@gmail.com', '$2y$10$6bo9Md0Mkb.8afZOF6V0XOc3hoX.lp7MofIhgmJro6jlkzI28uOfu', '0', 'active', NULL, '2026-07-07 05:37:02', NULL, NULL),
(155, 'Charles', 'ezeomachibuike@gmail.com', '$2y$10$8MN0gnBxFS/L1jv0YOzHx.nCh8w6w9TI/WsOwi7N4owKriRzH2IJi', '0.8502000000000001', 'active', NULL, '2026-07-07 07:54:38', NULL, NULL),
(156, 'Chammy', 'promiseChammy@gmail.com', '$2y$10$64DzsthhpebrkiBVp8fbnu5FwHhwQ9RubLHevnHfMw73afkavtEcS', '1', 'active', NULL, '2026-07-08 09:13:15', NULL, NULL),
(157, 'Newton', 'garvisnewsom@gmail.com', '$2y$10$T6GBC0/CixKlFIK.fUPeRuBsmFzJrz3ePj0Zoe82ppi6LdG4f76ku', '0', 'active', NULL, '2026-07-09 12:25:51', NULL, NULL),
(158, 'Ghh', 'derekdraco127@gmail.com', '$2y$10$xttJsCq5tIpzjbzMXG3Ztuh8mxZa5pkRqVhpytX5V7LqaBULLh5zW', '0', 'active', NULL, '2026-07-09 12:57:47', NULL, NULL),
(159, 'Victor ogedeh', 'victoh319@gmail.com', '$2y$10$FXJwq7fuBBYwtlDZ.y7YA.12N3SCW8sSC8e9wUHYqS99SuXHuI7Y.', '0', 'active', NULL, '2026-07-10 15:02:17', NULL, NULL),
(160, '💼💼 Abacha', 'ubakatony41@gmail.com', '$2y$10$VvGVWSt0HYQ3oDsM.kkn3.xRmARtW8vl2tdPxXG21wjA1bsPeZ.XO', '0.5174999999999996', 'active', NULL, '2026-07-14 05:03:36', NULL, NULL),
(161, 'Adebisi', 'alexenderphilip75@gmail.com', '$2y$10$NZq6JZvKKyoo8F586ULVI.mYCsVHzPq2na31Nadn0lXrXlNUAAYPG', '0', 'active', NULL, '2026-07-21 06:40:13', NULL, NULL),
(162, 'Echoga Nathaniel', 'echoganathaniel@gmail.com', '$2y$10$W8.MTJ568tSbfE.lBByfjeG7FPzswZtT1owbC14ahGMtGhB3.cblu', '0', 'active', NULL, '2026-07-23 08:38:15', NULL, NULL),
(163, 'Mansa1', 'ashleygarrett180@gmail.com', '$2y$10$LT9grJUiB5gSzDRuTBKAlOvsByRVhZQbAIWsivkO0kY9y.nKDRbb6', '0', 'active', NULL, '2026-07-23 19:54:52', NULL, NULL),
(164, 'Ezike johnpaul somtochukwu', 'somtochukwuezike7@gmail.com', '$2y$10$oFj5NosxoJBRkM.yswUJpuR1CnD8KV7MvVfSBRwG1F7Lnp8GqoFIC', '0', 'active', NULL, '2026-07-24 11:48:21', NULL, NULL),
(165, 'Muhammed Ibraheem', 'moh.ibraheemtech@gmail.com', '$2y$10$DfGA.1ZOiv8XwZhOcTLIZeTNQ4UlMxfCUTbhxfGEiohwBUejJyokO', '0', 'active', NULL, '2026-07-26 19:58:22', NULL, NULL),
(166, 'Adeho favour', 'charlesfavour464@gmail.com', '$2y$10$lYitKnR2iPT66TpyDnGMouxd2P1ID3xyPGOsLV7Xd10LtluFE7frG', '0', 'active', NULL, '2026-07-30 16:44:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_api_keys`
--

CREATE TABLE `user_api_keys` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `test_key` varchar(255) DEFAULT NULL,
  `live_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `user_api_keys`
--

INSERT INTO `user_api_keys` (`id`, `user_id`, `test_key`, `live_key`, `created_at`) VALUES
(1, 146, 'test_697f14ebcc99d26dcfce0f9a995d1387', 'live_0ab2d2a5e3c5109dc2fbd1cd41e4d4d6', '2026-06-16 09:18:23'),
(5, 27, 'test_b6c75969acacf3fa8032ff966840b07f', NULL, '2026-07-08 15:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `service_id` int NOT NULL,
  `order_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `social_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `charge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `start_count` int DEFAULT '0',
  `remains` int DEFAULT '0',
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quanity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`id`, `user`, `service_id`, `order_name`, `sub_price`, `order_price`, `order_category`, `social_url`, `message`, `created_at`, `order_id`, `charge`, `start_count`, `remains`, `currency`, `quanity`) VALUES
(25, 6, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.10695', '0.857', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/16qojPdxE6/?mibextid=wwXIfr', '', '2025-12-12 12:01:52', '11955489', '0', 0, 0, NULL, '500'),
(26, 15, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '5.13', '15.93', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'www.tiktok.com/@aloud__wealth', 'Gggggg', '2025-12-16 07:12:20', '11987099', '0', 0, 0, NULL, '7200'),
(27, 15, 3274, 'TikTok Likes [ Max 5M ] | Real Mixed | No Refill ⚠️ | Instant Start | Day 200K', '0.0063', '0.7563', 'Tiktok Cheapest Likes Services', 'https://www.tiktok.com/t/ZTrgadxaj/', 'Hhh', '2025-12-16 15:30:57', '11989980', '0', 0, 0, NULL, '500'),
(28, 15, 608, 'Tiktok Views | Max 10M | Instant | 100k/Day | Cheapest |', '0.0035', '7.5035', 'TikTok Views', 'https://www.tiktok.com/t/ZTrgadxaj/', 'Jjj', '2025-12-16 15:34:19', '11990004', '0', 0, 0, NULL, '5000'),
(29, 15, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '1.63875', '5.0888', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'www.tiktok.com/@aloud__wealth', 'Jjj', '2025-12-16 15:36:36', '11990020', '0', 0, 0, NULL, '2300'),
(30, 15, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '2.85', '8.85', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'tiktok.com/arikebby31', 'Jjj', '2025-12-16 15:43:29', '11990056', '0', 0, 0, NULL, '4000'),
(31, 12, 3448, 'TikTok Followers | Low Drop | instant | LifeTime Refill♻️', '1.025', '2.525', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@andreaheike11?_r=1&_t=ZT-92HCVW006Tl', '', '2025-12-16 18:29:33', '11991126', '0', 0, 0, NULL, '1000'),
(32, 18, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.3213', '0.9978', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@andreaheike11?_r=1&_t=ZT-92ImlUO6U1n', '', '2025-12-17 19:28:09', '11998863', '0', 0, 0, NULL, '451'),
(33, 21, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.57', '1.77', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@thomzycasualclothings01?_r=1&_t=ZS-92JMNOotWxY', '', '2025-12-18 01:05:34', '11999792', '0', 0, 0, NULL, '800'),
(34, 21, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.6888', '2.1138', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@chakaplat?_r=1&_t=ZS-92JWZqFMhj0', '', '2025-12-18 03:19:43', '12000352', '0', 0, 0, NULL, '950'),
(35, 21, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.6413', '1.9913', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@jevxbby?_r=1&_t=ZS-92JsbqSwIbJ', '', '2025-12-18 08:24:48', '12002016', '0', 0, 0, NULL, '900'),
(36, 25, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.7125', '2.2125', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@priscilla47609?_r=1&_t=ZN-92Kjs341h2M', '', '2025-12-18 20:26:03', '12006214', '0', 0, 0, NULL, '1000'),
(37, 23, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.58', '1.78', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@nony.best13?_r=1&_t=ZM-92KW4MqbGIN', '', '2025-12-18 21:21:18', '12006485', '0', 0, 0, NULL, '800'),
(38, 23, 2, 'Tiktok Shares | Max 100M | 10M/Day | Non Drop | Lifetime Refill | ♻️', '0.0007', '0.0157', '⭐Cheapest Service⭐', 'https://www.tiktok.com/@nony.best13?_r=1&_t=ZM-92KW4MqbGIN', '', '2025-12-19 06:09:01', '12008256', '0', 0, 0, NULL, '10'),
(39, 21, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.6413', '1.9913', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@jevxbby?_r=1&_t=ZS-92JsbqSwIbJ', '', '2025-12-19 10:45:47', '12009384', '0', 0, 0, NULL, '900'),
(40, 21, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.57', '1.77', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@uchechukwu170?_r=1&_t=ZS-92Mit7c7Qdp', '', '2025-12-20 00:37:41', '12013675', '0', 0, 0, NULL, '800'),
(41, 27, 1164, 'Facebook Post Likes | Real | Max 10k | 10k/Day | Low Drop | No Refill  |', '0.265', '1.765', 'Facebook Post Likes', 'https://www.facebook.com/share/p/1DNRMcFBRh/?mibextid=wwXIfr', '', '2025-12-20 16:40:13', '12018728', '0', 0, 0, NULL, '1000'),
(42, 23, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.6413', '1.9913', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@nony.best13?_r=1&_t=ZM-92KW4MqbGIN', '', '2025-12-20 19:28:53', '12019711', '0', 0, 0, NULL, '900'),
(43, 25, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.0071', '0.0221', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@priscilla47609?_r=1&_t=ZN-92Osyw4OUch', '', '2025-12-21 07:00:13', '12022193', '0', 0, 0, NULL, '10'),
(44, 25, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '1.8125', '5.5625', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@priscilla47609?_r=1&_t=ZN-92PxZD6lJ14', '', '2025-12-21 22:09:35', '12029409', '0', 0, 0, NULL, '2500'),
(45, 25, 3443, 'TikTok Followers | Low Quality  | instant | No Refill', '0.3848', '1.1948', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@wiseman7970?_r=1&_t=ZS-92Pxx8b2A1l', '', '2025-12-21 22:16:37', '12029432', '0', 0, 0, NULL, '540'),
(46, 31, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.1271', '0.8771', 'Facebook Page / Profile Followers', 'https:www.facebook.com/Scarlett-Èlan-895364560332840/', '', '2025-12-23 08:38:33', '12039652', '0', 0, 0, NULL, '500'),
(47, 32, 1219, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | Low Drop | No Refill |', '4.29', '19.29', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/rickymanningchat?utm_source=qr&igsh=aGlleHFjcXU5aWxl', 'followers', '2025-12-24 12:00:58', '12048193', '0', 0, 0, NULL, '10000'),
(48, 32, 421, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | Low Drop | 30D Refill | ♻️🔥', '4.056', '16.056', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/vincenchats?igsh=Nm56NTlyb2dudm94&utm_source=qr', 'followers', '2025-12-24 12:05:16', '12048213', '0', 0, 0, NULL, '8000'),
(49, 32, 1219, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | Low Drop | No Refill |', '2.145', '9.645', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/peledear500?igsh=Z3FoYzkybjZraHY0&utm_source=qr', 'followers', '2025-12-24 18:39:49', '12050833', '0', 0, 0, NULL, '5000'),
(50, 32, 3216, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | Low Drop | 99D Refill | ♻️🔥', '2.925', '10.925', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/peledear500?igsh=Z3FoYzkybjZraHY0&utm_source=qr', 'followers', '2025-12-25 17:53:54', '12057154', '0', 0, 0, NULL, '5000'),
(51, 15, 3425, 'Instagram Followers | Indian Mixed | 0-1H Start | 10K/Day | Low Drops | No Refill |', '0.33', '1.13', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/traceejones070?igsh=ZHRibmRmbGpjdHZ1&utm_source=qr', 'Jjjj', '2025-12-28 02:44:22', '12075201', '0', 0, 0, NULL, '500'),
(52, 31, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.1398', '1.0198', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/1DXma8udTU/?mibextid=wwXIfr', '', '2025-12-28 10:37:37', '12077558', '0', 0, 0, NULL, '550'),
(53, 36, 3425, 'Instagram Followers | Indian Mixed | 0-1H Start | 10K/Day | Low Drops | No Refill |', '0.5834', '1.9978', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'tatemoryauraa', '', '2026-01-03 21:26:11', '12124308', '0', 0, 0, NULL, '884'),
(54, 5, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '2.541', '18.541', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/p/16qojPdxE6/?mibextid=wwXIfr', '', '2026-01-05 09:24:59', '12134836', '0', 0, 0, NULL, '10000'),
(55, 48, 505, 'Facebook Page Like + Followers | Max 100K | 2k-5k/Day | 30 Days Refill ♻', '2.0412', '7.6412', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/16go8FYEyx/?mibextid=wwXIfr', 'the follower can should 2000 and the like should be 1500', '2026-01-06 19:33:53', '12147678', '0', 0, 0, NULL, '3500'),
(56, 48, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.624', '3.952', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/17aakcQkkb/?mibextid=wwXIfr', '', '2026-01-07 08:03:10', '12150548', '0', 0, 0, NULL, '2080'),
(57, 48, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.36', '2.28', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/17iwu9SaxK/?mibextid=wwXIfr', '', '2026-01-07 08:04:23', '12150559', '0', 0, 0, NULL, '1200'),
(58, 41, 1219, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | No Refill |', '2.97', '14.97', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/e_d_d_i.e', '', '2026-01-07 08:28:29', '12150724', '0', 0, 0, NULL, '7500'),
(59, 22, 1885, '🇵🇰TikTok Real Followers | Pakistan | Nice Quality | Real Active | Non Drop | 5k/Day |', '1.3123', '1.9987', 'Tiktok Followers [ TARGETED ]', 'https://www.tiktok.com/@dad97213?_r=1&_t=ZT-92sBO3sF8OL', '', '2026-01-07 12:45:14', '12152730', '0', 0, 0, NULL, '429'),
(60, 48, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.177', '1.121', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/v/1KkKpdNw91/?mibextid=wwXIfr', '', '2026-01-07 17:43:32', '12155041', '0', 0, 0, NULL, '590'),
(61, 22, 1143, 'Facebook Page Followers | Max 10k | Non Drop | 30D Refill |♻️', '0.2065', '1.9985', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1J6kn3WG5k/?mibextid=wwXIfr', '', '2026-01-11 18:33:17', '12185622', '0', 0, 0, NULL, '1120'),
(62, 31, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.1398', '1.0198', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/1Ab7rYyhCt/?mibextid=wwXIfr', '', '2026-01-12 03:24:28', '12187418', '0', 0, 0, NULL, '550'),
(63, 60, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.2448', '0.6288', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@matt_01_4?_r=1&_t=ZS-930yjEDn4Xy', '', '2026-01-12 17:06:52', '12192277', '0', 0, 0, NULL, '240'),
(64, 60, 3274, 'TikTok Likes [ Max 5M ] | Real Mixed | No Refill ⚠️ | Instant Start | Day 200K', '0.0007', '0.0935', 'Tiktok Cheapest Likes Services', 'https://www.tiktok.com/@matt_01_4?_r=1&_t=ZS-930yjEDn4Xy', '', '2026-01-12 17:10:12', '12192306', '0', 0, 0, NULL, '58'),
(65, 60, 608, 'Tiktok Views | Max 10M | Instant | 100k/Day | Cheapest |', '0.0001', '0.1905', 'TikTok Views', 'https://www.tiktok.com/@matt_01_4?_r=1&_t=ZS-930yjEDn4Xy', '', '2026-01-12 17:11:38', '12192314', '0', 0, 0, NULL, '119'),
(66, 60, 608, 'Tiktok Views | Max 10M | Instant | 100k/Day | Cheapest |', '0', '0.08', 'TikTok Views', 'https://vt.tiktok.com/ZS5tVE4HJ/', '', '2026-01-12 17:18:33', '12192365', '0', 0, 0, NULL, '50'),
(67, 21, 505, 'Facebook Page Like + Followers | Max 100K | 2k-5k/Day | 30 Days Refill ♻', '0.1633', '0.6433', '⭐Cheapest Service⭐', 'https://www.facebook.com/profile.php?id=100093635829470', '', '2026-01-12 22:11:13', '12193620', '0', 0, 0, NULL, '300'),
(68, 21, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.21', '1.33', '⭐Cheapest Service⭐', 'https://www.facebook.com/profile.php?id=100093635829470', '', '2026-01-13 08:24:39', '12196060', '0', 0, 0, NULL, '700'),
(69, 31, 1219, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | No Refill |', '0.1815', '1.0615', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/fabianjude000?igsh=MTU3aTRjanF4Y3drNA%3D%3D&utm_source=qr', '', '2026-01-14 15:06:03', '12206846', '0', 0, 0, NULL, '550'),
(70, 66, 3445, 'TikTok Followers | Low Drop | instant | 30 Days Refill♻️', '0.1875', '1.8875', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@ste_ve_mic?_r=1&_t=ZS-938KZiMmJF4', '', '2026-01-17 00:44:13', '12226582', '0', 0, 0, NULL, '1000'),
(71, 67, 3420, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | No Refill |', '0.2814', '0.9954', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/apbbssgulqjruly?igsh=MnJ0ajVyZzVra3Mw&utm_source=qr', '', '2026-01-17 01:29:45', '12226714', '0', 0, 0, NULL, '420'),
(72, 67, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.3743', '0.9982', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@mikec_4?_r=1&_t=ZS-938PgfCXt2N', 'Add up', '2026-01-17 01:54:17', '12226828', '0', 0, 0, NULL, '367'),
(73, 20, 3425, 'Instagram Followers | Indian Mixed | 0-1H Start | 10K/Day | Low Drops | No Refill |', '0.33', '1.18', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/ayobami062?igsh=MTNuZjVxbmhiOWNnZQ==', '', '2026-01-17 09:11:37', '12228766', '0', 0, 0, NULL, '500'),
(74, 67, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.5202', '1.3872', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@gordon.ramsay06?_r=1&_t=ZS-939ePRsHEPM', '', '2026-01-17 19:26:54', '12232507', '0', 0, 0, NULL, '510'),
(75, 67, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.0904', '1.2804', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@mikec_4?_r=1&_t=ZS-939ifhjUDTE', '', '2026-01-17 20:21:58', '12232736', '0', 0, 0, NULL, '700'),
(76, 67, 2943, 'TikTok Followers [ Brazil 🇧🇷 ] [ Max 10M ] | 100% Brazilian Profiles | Cancel Enable | Drop 0-2% | 30 Days ♻️ | 1k-10k/Day |', '0.156', '0.326', 'Tiktok Followers [ TARGETED ]', 'https://www.tiktok.com/@mikec_4?_r=1&_t=ZS-93ASSz6OyPK', 'Followers', '2026-01-18 06:47:08', '12235083', '0', 0, 0, NULL, '100'),
(77, 31, 1219, 'Instagram Followers | 0-1H Start | Max 10k | 5k-10k/Day | No Refill |', '0.132', '0.812', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/joshua02858?igsh=MWl0Z2JwNG56bmk4YQ==', '', '2026-01-19 09:13:31', '12242875', '0', 0, 0, NULL, '400'),
(78, 70, 505, 'Facebook Page Like + Followers | Max 100K | 2k-5k/Day | 30 Days Refill ♻', '1.6332', '6.7332', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1Cvhky4Y5m/?mibextid=wwXIfr', '', '2026-01-19 09:34:04', '12242980', '0', 0, 0, NULL, '3000'),
(79, 66, 3421, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | 30D Refill |♻️', '0.6386', '1.9136', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/omo_tex?igsh=MTIyeW1yN3c3OWx4dA%3D%3D&utm_source=qr', '', '2026-01-19 10:29:42', '12243225', '0', 0, 0, NULL, '750'),
(80, 70, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.15', '1', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/17tB7HCqvq/?mibextid=wwXIfr', '', '2026-01-19 10:38:17', '12243258', '0', 0, 0, NULL, '500'),
(81, 70, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.156', '1.04', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1C1QFWjHhM/?mibextid=wwXIfr', '', '2026-01-19 10:48:14', '12243305', '0', 0, 0, NULL, '520'),
(82, 72, 505, 'Facebook Page Like + Followers | Max 100K | 2k-5k/Day | 30 Days Refill ♻', '1.6332', '6.7332', '⭐Cheapest Service⭐', 'https://www.facebook.com/profile.php?id=61586622879844&mibextid=wwXIfr&mibextid=wwXIfr', '', '2026-01-19 11:21:56', '12243452', '0', 0, 0, NULL, '3000'),
(83, 70, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.108', '0.72', '⭐Cheapest Service⭐', 'https://www.facebook.com/61586638238710/posts/pfbid0hPPLQbSVQTauVAMxu6KsbPsgiQ1WbPyp2p9YgoDve4YnHyYYbSFwWtkR3xMu4WMal/?d=w', '', '2026-01-19 13:43:40', '12244454', '0', 0, 0, NULL, '360'),
(84, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.15', '1', '⭐Cheapest Service⭐', 'https://www.facebook.com/profile.php?id=61586622879844&mibextid=wwXIfr&mibextid=wwXIfr', '', '2026-01-21 15:41:41', '12260749', '0', 0, 0, NULL, '500'),
(85, 72, 553, 'Facebook Post Likes | Max 50K | 10K/Day | Non Drop | Lifetime Guarantee 🔥', '0.3906', '1.5806', '🧡Best Services', 'https://www.facebook.com/profile.php?id=61586622879844&mibextid=wwXIfr&mibextid=wwXIfr', '', '2026-01-21 19:26:08', '12261949', '0', 0, 0, NULL, '700'),
(86, 72, 292, 'Facebook Page Followers | Max 100k | 10k-20k/Day | Non Drop | Lifetime Guarantee |🔥', '2.0096', '5.4096', '🧡Best Services', 'https://www.facebook.com/share/1FVurwGCDq/?mibextid=wwXIfr', '', '2026-01-21 19:29:03', '12261974', '0', 0, 0, NULL, '2000'),
(87, 21, 3423, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | 365D Refill |♻️', '0.475', '1.325', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'I\'m on Instagram as @laufeylooremsgacct. Install the app to follow my photos and videos. https://www.instagram.com/invites/contact/?igsh=1837oe7c9kebu&utm_content=10v7zxzi', '', '2026-01-23 02:40:16', '12271238', '0', 0, 0, NULL, '500'),
(88, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.3', '2', '⭐Cheapest Service⭐', 'https://m.facebook.com/story.php?story_fbid=pfbid033kvz7Srd3UUZEf1BE8qrR9PBut3BHq4wvc71dAQJnKC2UBRYWwoHfAsYbVnoeMayl&id=61586622879844&mibextid=wwXIfr', '', '2026-01-24 10:12:03', '12280457', '0', 0, 0, NULL, '1000'),
(89, 76, 3420, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | No Refill |', '1.2', '4.8', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/thomastyler261?igsh=MTVndTY4bjI4eDMydA==', '', '2026-01-24 20:21:27', '12284245', '0', 0, 0, NULL, '2000'),
(90, 76, 1410, '🇺🇸 Twitter Followers | USA | Max 5k | 5k/Day | No Refill |', '2.0985', '2.6385', '🇺🇸Twitter USA Services', 'https://www.instagram.com/thomastyler261?igsh=MTVndTY4bjI4eDMydA==', '', '2026-01-24 20:36:47', '12284292', '0', 0, 0, NULL, '300'),
(91, 72, 1143, 'Facebook Page Followers | Max 10k | Non Drop | 30D Refill |♻️', '0.6552', '6.0552', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1Aur1mD9Rh/?mibextid=wwXIfr', '', '2026-01-26 12:35:14', '12295581', '0', 0, 0, NULL, '3000'),
(92, 82, 3266, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.0121', '0.1921', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/1JQJmUYUq8/?mibextid=wwXIfr', '', '2026-01-26 12:52:57', '12295750', '0', 0, 0, NULL, '100'),
(93, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.3', '2.1', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/14VC2ahZB6c/?mibextid=wwXIfr', '', '2026-01-26 13:51:11', '12296302', '0', 0, 0, NULL, '1000'),
(94, 83, 505, 'Facebook Page Like + Followers | Max 100K | 2k-5k/Day | 30 Days Refill ♻', '1.6332', '7.0332', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1DDrAweqWo/?mibextid=wwXIfr', '', '2026-01-26 14:06:19', '12296441', '0', 0, 0, NULL, '3000'),
(95, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.3', '2.1', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1EyqpP5yKw/?mibextid=wwXIfr', '', '2026-01-26 15:01:57', '12296926', '0', 0, 0, NULL, '1000'),
(96, 84, 3270, 'TikTok Likes | HQ | 0% Drop | Max 20M | instant | 1 Minute Complete 🚀 |  No Refill', '0.0072', '0.4572', 'TikTok 0% Drop Likes | ᴜᴘᴅᴀᴛᴇᴅ', 'https://vt.tiktok.com/ZSaajFEWY/', '', '2026-01-27 06:19:15', '12302048', '0', 0, 0, NULL, '250'),
(97, 84, 3279, 'TikTok Likes [ Max 5M ] | Real Mixed | Lifetime ♻️ | Instant Start | Day 200K', '0.0014', '0.1454', 'Tiktok Cheapest Likes Services', 'https://vt.tiktok.com/ZSaajWKxm/', '', '2026-01-27 06:23:16', '12302059', '0', 0, 0, NULL, '80'),
(98, 84, 3279, 'TikTok Likes [ Max 5M ] | Real Mixed | Lifetime ♻️ | Instant Start | Day 200K', '0.0018', '0.1818', 'Tiktok Cheapest Likes Services', 'https://vt.tiktok.com/ZSaa6Lptf/', '', '2026-01-27 06:27:18', '12302087', '0', 0, 0, NULL, '100'),
(99, 84, 3279, 'TikTok Likes [ Max 5M ] | Real Mixed | Lifetime ♻️ | Instant Start | Day 200K', '0.0011', '0.1091', 'Tiktok Cheapest Likes Services', 'https://vt.tiktok.com/ZSaakJb2s/', '', '2026-01-27 07:05:21', '12302355', '0', 0, 0, NULL, '60'),
(100, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.45', '3.15', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1CynBkNWEy/?mibextid=wwXIfr', '', '2026-01-27 08:08:07', '12302679', '0', 0, 0, NULL, '1500'),
(101, 22, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.9894', '2.7354', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@skilolo79?_r=1&_t=ZP-93PrITIv5cU', '', '2026-01-27 08:21:49', '12302781', '0', 0, 0, NULL, '970'),
(102, 22, 3266, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.0785', '1.2485', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/1GrBSmMuhT/?mibextid=wwXIfr', '', '2026-01-27 08:44:18', '12302955', '0', 0, 0, NULL, '650'),
(103, 72, 553, 'Facebook Post Likes | Max 50K | 10K/Day | Non Drop | Lifetime Guarantee 🔥', '0.837', '3.537', '🧡Best Services', 'https://www.facebook.com/share/p/1CynBkNWEy/?mibextid=wwXIfr', '', '2026-01-27 08:58:55', '12303121', '0', 0, 0, NULL, '1500'),
(104, 82, 3295, 'Facebook Page Likes + Followers | instant | Low drop | lifetime refill♻️', '0.125', '0.485', 'Facebook Page Likes + Followers', 'https://www.facebook.com/share/1auhVEZyQT/?mibextid=wwXIfr', '', '2026-01-27 12:36:37', '12304735', '0', 0, 0, NULL, '200'),
(105, 22, 2272, '🇵🇰 TikTok Followers | Pakistan | Max 50k | 10k/Day | Non Drop | Lifetime Refill |♻️', '1.2944', '2.5004', 'Tiktok Pakistan Services 🇵🇰', 'https://www.tiktok.com/@skilolo79?_r=1&_t=ZP-93QsWNB0USE', '', '2026-01-27 22:43:27', '12308802', '0', 0, 0, NULL, '670'),
(106, 84, 1143, 'Facebook Page Followers | Max 10k | Non Drop | 30D Refill |♻️', '0.0109', '0.1009', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1CAq7VHG9a/?mibextid=wwXIfr', '', '2026-01-28 10:39:35', '12311770', '0', 0, 0, NULL, '50'),
(107, 87, 3446, 'TikTok Followers | Low Drop | instant | 90 Days Refill♻️', '0.8625', '2.6625', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@godsmusssyscie198248?_r=1&_t=ZN-93RmO44XnVO', '', '2026-01-28 11:22:05', '12312115', '0', 0, 0, NULL, '1000'),
(108, 87, 3446, 'TikTok Followers | Low Drop | instant | 90 Days Refill♻️', '0.0863', '0.2663', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@godsmusssyscie198248?_r=1&_t=ZN-93RmqVi1WFS', '', '2026-01-28 11:28:51', '12312168', '0', 0, 0, NULL, '100'),
(109, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.6', '4.2', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1RKjg6qr7j/?mibextid=wwXIfr', '', '2026-01-28 19:32:59', '12315626', '0', 0, 0, NULL, '2000'),
(110, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.3', '2.1', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1RKjg6qr7j/?mibextid=wwXIfr', '', '2026-01-28 23:33:27', '12316383', '0', 0, 0, NULL, '1000'),
(111, 22, 3222, '🇺🇸 TikTok Followers | Max 100K | 100% USA 🇺🇸 | HQ Profiles | Non Drop | 30D Refill♻️  | 50k/Day |', '1.7082', '3.0222', '🇺🇸TikTok USA Services| USA | ᴺᴱᵂ', 'https://www.tiktok.com/@wizzyuuu?_r=1&_t=ZS-93aiy4EbIZE', '', '2026-02-02 17:47:12', '12352188', '0', 0, 0, NULL, '730'),
(112, 84, 625, 'Tiktok Like | Max 100k | 5k-10k/Day | 0-30 Min Start | Non Drop | No Refill |', '0.0173', '0.5573', 'Tiktok Likes', 'https://vt.tiktok.com/ZSaswDpqk/', '', '2026-02-03 09:02:28', '12356013', '0', 0, 0, NULL, '300'),
(113, 84, 625, 'Tiktok Like | Max 100k | 5k-10k/Day | 0-30 Min Start | Non Drop | No Refill |', '0.0046', '0.1486', 'Tiktok Likes', 'https://vt.tiktok.com/ZSaswy1f1/', '', '2026-02-03 09:03:43', '12356016', '0', 0, 0, NULL, '80'),
(114, 84, 625, 'Tiktok Like | Max 100k | 5k-10k/Day | 0-30 Min Start | Non Drop | No Refill |', '0.0058', '0.1858', 'Tiktok Likes', 'https://vt.tiktok.com/ZSasw4PPn/', '', '2026-02-03 09:07:42', '12356037', '0', 0, 0, NULL, '100'),
(115, 84, 625, 'Tiktok Like | Max 100k | 5k-10k/Day | 0-30 Min Start | Non Drop | No Refill |', '0.0035', '0.1115', 'Tiktok Likes', 'https://vt.tiktok.com/ZSasKN8D4/', '', '2026-02-03 09:14:19', '12356067', '0', 0, 0, NULL, '60'),
(116, 95, 1143, 'Facebook Page Followers | Max 10k | Non Drop | 30D Refill |♻️', '0.6552', '6.0552', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1E7D1dN1wA/?mibextid=wwXIfr', '', '2026-02-03 18:44:58', '12360420', '0', 0, 0, NULL, '3000'),
(117, 12, 595, 'Tiktok Like | Real | Max 500k | 500k/Day | 𝙎𝙪𝙥𝙚𝙧𝙛𝙖𝙨𝙩 | 30D Refill | 🔥♻️', '0.1086', '2.9994', 'Tiktok Likes [ Guaranteed ]', '9076494556', '', '2026-02-03 19:25:07', '12360609', '0', 0, 0, NULL, '1606'),
(118, 31, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.122', '0.986', 'Facebook Page / Profile Followers', 'https://www.facebook.com/profile.php?id=61585461617471', '', '2026-02-03 19:43:38', '12360700', '0', 0, 0, NULL, '480'),
(119, 76, 3420, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | No Refill |', '0.48', '1.92', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/thomastyler261?igsh=MTVndTY4bjI4eDMydA==', '', '2026-02-05 23:32:37', '12375733', '0', 0, 0, NULL, '800'),
(120, 95, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.9', '6.3', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1EA3oj7paG/?mibextid=wwXIfr', 'Thank you for your services', '2026-02-06 16:59:06', '12381419', '0', 0, 0, NULL, '3000'),
(121, 21, 1437, 'Facebook Page Likes + Followers | Max 500K | 0-1H Start | 20K-50k/Day | 30D Refill |♻️', '0.3074', '1.7474', 'Facebook Page Likes + Followers', 'https://www.facebook.com/share/17qXUxu2PX/', '', '2026-02-07 00:55:51', '12383563', '0', 0, 0, NULL, '800'),
(122, 21, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.2287', '1.8487', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/1DTAFNzYZR/', '', '2026-02-07 01:34:03', '12383655', '0', 0, 0, NULL, '900'),
(123, 31, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.1474', '1.1914', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/1APNedZjPG/', '', '2026-02-07 23:35:52', '12390788', '0', 0, 0, NULL, '580'),
(124, 95, 1143, 'Facebook Page Followers | Max 10k | Non Drop | 30D Refill |♻️', '0.6552', '6.0552', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/17tanjdBag/?mibextid=wwXIfr', '', '2026-02-10 17:50:35', '12413009', '0', 0, 0, NULL, '3000'),
(125, 31, 3556, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.0213', '0.9753', 'Facebook Page/Profile Followers [ ᴄʜᴇᴀᴘᴇꜱᴛ ]', 'https://www.facebook.com/share/1843o5osPh/', '', '2026-02-11 08:49:36', '12417205', '0', 0, 0, NULL, '530'),
(126, 72, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.0366', '0.9366', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/1AUr79jfSq/?mibextid=wwXIfr', '', '2026-02-11 15:01:02', '12419709', '0', 0, 0, NULL, '500'),
(127, 72, 611, 'Facebook Emoticons Post Likes [ Care ] 🥰 | Max 100K | Instant |', '0.0366', '0.9366', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/1AUr79jfSq/?mibextid=wwXIfr', '', '2026-02-11 15:01:50', '12419719', '0', 0, 0, NULL, '500'),
(128, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.3', '2.1', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1BeLUUTEaX/?mibextid=wwXIfr', '', '2026-02-11 15:38:42', '12419979', '0', 0, 0, NULL, '1000'),
(129, 72, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.1464', '3.7464', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/1FtSZEnNmX/?mibextid=wwXIfr', '', '2026-02-11 15:48:31', '12420077', '0', 0, 0, NULL, '2000'),
(130, 72, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.0732', '1.8732', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/1JrYDJ27hB/?mibextid=wwXIfr', '', '2026-02-11 16:03:22', '12420168', '0', 0, 0, NULL, '1000'),
(131, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.3', '2.1', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/p/1GFAhZJXw3/?mibextid=wwXIfr', '', '2026-02-11 18:14:40', '12421583', '0', 0, 0, NULL, '1000'),
(132, 72, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.0732', '1.8732', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/1HhgPYGRPU/?mibextid=wwXIfr', '', '2026-02-11 18:15:43', '12421607', '0', 0, 0, NULL, '1000'),
(133, 72, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.0732', '1.8732', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/14SXMkRBzZS/?mibextid=wwXIfr', '', '2026-02-11 18:16:33', '12421615', '0', 0, 0, NULL, '1000'),
(134, 72, 610, 'Facebook Emoticons Post Likes [ Love ] ❤️ | Max 100K | Instant |', '0.161', '4.121', 'Facebook Reactions [ 𝘾𝙝𝙚𝙖𝙥𝙚𝙨𝙩 ] ɴᴇᴡ', 'https://www.facebook.com/share/p/1FS9qKE7YF/?mibextid=wwXIfr', '', '2026-02-11 21:05:40', '12422890', '0', 0, 0, NULL, '2200'),
(135, 22, 2191, 'Tiktok Followers | Real | Max 50k | 1k-10k/Day | Non Drop | Lifetime Guarantee | 🔥🔥', '1.302', '3.102', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@user8610297214831?_r=1&_t=ZT-940MFCmaTlN', '', '2026-02-17 19:40:22', '12474349', '0', 0, 0, NULL, '1000'),
(136, 22, 2191, 'Tiktok Followers | Real | Max 50k | 1k-10k/Day | Non Drop | Lifetime Guarantee | 🔥🔥', '0.3906', '0.9306', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@user8610297214831?_r=1&_t=ZT-940MFCmaTlN', '', '2026-02-17 19:44:28', '12474379', '0', 0, 0, NULL, '300'),
(137, 107, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.4998', '1.9992', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@don_mullah_of_lagos?_r=1&_t=ZS-945TiGV5TY9', 'nothing much to say', '2026-02-20 20:00:52', '12503220', '0', 0, 0, NULL, '833'),
(138, 76, 3420, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | No Refill |', '1.125', '5.625', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/nishiday2?igsh=MWpnbXczYzY1c203aA==', '', '2026-02-22 14:34:24', '12521808', '0', 0, 0, NULL, '2500'),
(139, 72, 212, 'Facebook Post Likes | Max 5K | Real | No Refill | Cheapest🤑 |', '0.45', '3.15', '⭐Cheapest Service⭐', 'https://m.facebook.com/story.php?story_fbid=pfbid0D9G8BdMXbbEpeG2hc78TFyEKoQGcrEEhqjAq1AH13SVYeZYuvqJv9J3mhKNETjU8l&id=61586622879844&mibextid=wwXIfr', '', '2026-03-08 15:09:39', '12667431', '0', 0, 0, NULL, '1500'),
(140, 32, 3420, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | No Refill |', '1.8', '10.8', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/rickmaniingchats?igsh=M3gycnp6YXhkaXZm', '', '2026-03-08 19:50:18', '12669723', '0', 0, 0, NULL, '5000'),
(141, 91, 3423, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | 365D Refill |♻️', '0.45', '2.25', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/evans_johnny7?igsh=MWxmY2dudHRneTdjcg==', '', '2026-03-14 22:22:11', '12727773', '0', 0, 0, NULL, '1000'),
(142, 91, 3423, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | 365D Refill |♻️', '0.45', '2.25', 'Instagram Followers | ᴄʜᴇᴀᴘᴇꜱᴛ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩', 'https://www.instagram.com/evans_johnny7?igsh=MWxmY2dudHRneTdjcg==', '', '2026-03-15 06:27:12', '12729887', '0', 0, 0, NULL, '1000'),
(143, 72, 292, 'Facebook Page Followers | Max 100k | 10k-20k/Day | Non Drop | Lifetime Guarantee |🔥', '0.5024', '1.4024', '🧡Best Services', 'https://www.facebook.com/profile.php?id=61572939201188&mibextid=wwXIfr&mibextid=wwXIfr', '', '2026-03-24 19:29:53', '12826377', '0', 0, 0, NULL, '500'),
(144, 21, 3266, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.1008', '1.3608', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/17qXUxu2PX/', '', '2026-03-26 23:02:59', '12850130', '0', 0, 0, NULL, '700'),
(145, 23, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.5568', '1.9968', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@nony.best13?_r=1&_t=ZM-92KW4MqbGIN', '', '2026-04-09 18:04:36', '12998542', '0', 0, 0, NULL, '800'),
(146, 120, 435, 'Tiktok Followers | Real | Max 100k | Low Drop | 5k-50k/Day | Fast🔥', '0.864', '1.944', 'Tiktok Followers [ Not Guaranteed ]', 'https://www.tiktok.com/@theavalouise11?_r=1&_t=ZN-95dMBprUq2A', '', '2026-04-18 05:54:05', '13082434', '0', 0, 0, NULL, '600'),
(147, 122, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.714', '1.974', 'Tiktok Followers [ Guaranteed ]', 'www.tiktok.com/@eva.notty462', '', '2026-04-19 16:16:26', '13095108', '0', 0, 0, NULL, '700'),
(148, 122, 3224, '🇺🇸 TikTok Likes | Max 100K | 100% USA 🇺🇸 | HQ Profiles | Non Drop | No Refill | 50K/Day |', '0.0195', '0.2895', '🇺🇸TikTok USA Services| USA | ᴺᴱᵂ', 'https://vt.tiktok.com/ZSHEUn916/', '', '2026-04-19 20:12:58', '13097054', '0', 0, 0, NULL, '150'),
(149, 122, 3224, '🇺🇸 TikTok Likes | Max 100K | 100% USA 🇺🇸 | HQ Profiles | Non Drop | No Refill | 50K/Day |', '0.0195', '0.2895', '🇺🇸TikTok USA Services| USA | ᴺᴱᵂ', 'www.tiktok.com/@eva.notty462', '', '2026-04-19 20:27:56', '13097106', '0', 0, 0, NULL, '150'),
(150, 122, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.0696', '0.2496', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'www.tiktok.com/@eva.notty462', '', '2026-04-20 10:52:57', '13101569', '0', 0, 0, NULL, '100'),
(151, 122, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.51', '1.41', 'Tiktok Followers [ Guaranteed ]', 'www.tiktok.com/@eva.notty462', '', '2026-04-21 23:19:47', '13116149', '0', 0, 0, NULL, '500'),
(152, 122, 3224, '🇺🇸 TikTok Likes | Max 100K | 100% USA 🇺🇸 | HQ Profiles | Non Drop | No Refill | 50K/Day |', '0.013', '0.193', '🇺🇸TikTok USA Services| USA | ᴺᴱᵂ', 'www.tiktok.com/@eva.notty462', '', '2026-04-21 23:24:24', '13116164', '0', 0, 0, NULL, '100'),
(153, 122, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.0918', '0.2538', 'Tiktok Followers [ Guaranteed ]', 'www.tiktok.com/@eva.notty462', '', '2026-04-21 23:25:35', '13116168', '0', 0, 0, NULL, '90'),
(154, 122, 3281, 'TikTok Followers | Max 5M | 100% Real Accounts | Cancel Enable | Drop 0-5% | 30 Days ♻️ | Instant Start | Day 100K', '0.51', '1.41', 'Tiktok Followers [ Guaranteed ]', 'www.tiktok.com/@eva.notty462', '', '2026-04-22 01:50:38', '13116722', '0', 0, 0, NULL, '500'),
(155, 76, 3666, 'Instagram Followers | Max 1M | Non Drop | Instant | 100K/Day | No Refill |', '0.4485', '3.1485', 'Instagram Followers | 𝗙𝗮𝘀𝘁𝗲𝘀𝘁 ɴᴇᴡ', 'https://www.instagram.com/yukkiishik?igsh=MWcyMXlpYWkxbnZyMA==', '', '2026-04-23 07:36:37', '13127937', '0', 0, 0, NULL, '1500'),
(156, 122, 3444, 'TikTok Followers | Low Drop | instant | No Refill', '0.348', '1.248', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'www.tiktok.com/@kevin.michael.pri1', '', '2026-04-24 01:56:08', '13134846', '0', 0, 0, NULL, '500'),
(157, 122, 3403, 'TikTok Followers  | HQ | instant | 50K/ Day | No Refill  ⛔', '0.468', '1.368', 'Tiktok Followers [ Not Guaranteed ]', 'www.tiktok.com/@kevin.michael.pri1', '', '2026-04-24 01:57:16', '13134867', '0', 0, 0, NULL, '500'),
(158, 76, 3624, 'Instagram Real Followers | Instant | Low Drop | 200k/Day | No Refill |', '0.252', '1.512', 'Instagram Followers | CHEAPEST ɴᴇᴡ', 'https://www.instagram.com/yukkiishik?igsh=MWcyMXlpYWkxbnZyMA==', '', '2026-04-25 02:01:48', '13143772', '0', 0, 0, NULL, '700'),
(159, 126, 2371, 'TikTok Likes | Non-Drop | Good Quality | 250K/Day | Lifetime Guarantee | ♻️', '0.0375', '0.9375', 'Tiktok Likes [ Guaranteed ]', 'https://www.tiktok.com/@holyboy261520?_r=1&_t=ZS-95tnnEpyULf', '', '2026-04-27 22:13:51', '13168578', '0', 0, 0, NULL, '500'),
(160, 126, 2186, 'TikTok Female 👧 Followers | Max: 50K | Real | 10k-20k/Day | 30 Days Refill ♻️ |', '0.2016', '0.3816', 'Tiktok Followers [ TARGETED ]', 'https://www.tiktok.com/@holyboy261520?_r=1&_t=ZS-95tnnEpyULf', '', '2026-04-27 22:16:02', '13168587', '0', 0, 0, NULL, '100'),
(161, 128, 436, 'Tiktok Followers | Real | Max 50K | 1K-10k/Day | Non Drop | No Refill |', '0.1071', '0.2871', 'Tiktok Followers [ Not Guaranteed ]', 'tiktok.com/@goodluck.chiemela', '', '2026-04-30 13:38:49', '13191473', '0', 0, 0, NULL, '100'),
(162, 128, 626, 'Tiktok Followers | Max 50k | 10k-50k/Day | Non Drop | 30D Refill | Fast Working🔥🔥', '0.2304', '0.4104', 'Tiktok Followers [ Guaranteed ]', 'tiktok.com/@goodluck.chiemela', '', '2026-04-30 14:58:58', '13192123', '0', 0, 0, NULL, '100'),
(163, 128, 1796, 'Tiktok Followers | Real | Max 100k | 1k-20K/Day | Non Drop | No Refill |', '0.1417', '0.3217', 'Tiktok Followers [ Not Guaranteed ]', 'tiktok.com/@goodluck.chiemela', '', '2026-04-30 15:47:14', '13192629', '0', 0, 0, NULL, '100'),
(164, 128, 1796, 'Tiktok Followers | Real | Max 100k | 1k-20K/Day | Non Drop | No Refill |', '0.1417', '0.3217', 'Tiktok Followers [ Not Guaranteed ]', 'tiktok.com/@goodluck.chiemela', '', '2026-04-30 22:15:10', '13194935', '0', 0, 0, NULL, '100'),
(165, 128, 3447, 'TikTok Followers | Low Drop | instant | 365 Days Refill♻️', '0.175', '0.355', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'tiktok.com/@goodluck.chiemela', '', '2026-05-06 13:37:18', '13242958', '0', 0, 0, NULL, '100'),
(166, 128, 3447, 'TikTok Followers | Low Drop | instant | 365 Days Refill♻️', '0.0875', '0.1775', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'tiktok.com/@goodluck.chiemela', '', '2026-05-06 14:10:55', '13243197', '0', 0, 0, NULL, '50'),
(167, 23, 2510, '🇧🇷 TikTok Likes + Views | Brazil | Max 1M | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Non Drop | Day 200K | 30D Refill ♻️|', '0.015', '0.195', '🔥New Services🔥', 'https://www.tiktok.com/@nony.best13?_r=1&_t=ZM-92KW4MqbGIN', '', '2026-05-06 22:56:00', '13247186', '0', 0, 0, NULL, '100'),
(168, 23, 2735, '🇧🇷TikTok 100% BRAZIL Likes | Non Drop | Max 500k | 50k/Day | 0-15 Min Start | No Refill |', '0.0012', '0.0192', '🔥New Services🔥', 'https://www.tiktok.com/@nony.best13?_r=1&_t=ZM-92KW4MqbGIN', '', '2026-05-06 23:00:33', '13247201', '0', 0, 0, NULL, '10'),
(169, 132, 2735, '🇧🇷TikTok 100% BRAZIL Likes | Non Drop | Max 500k | 50k/Day | 0-15 Min Start | No Refill |', '0.0576', '0.9576', '🔥New Services🔥', 'https://www.tiktok.com/@myfans360', '', '2026-05-07 21:44:55', '13256251', '0', 0, 0, NULL, '500'),
(170, 108, 3403, 'TikTok Followers  | HQ | instant | 50K/ Day | No Refill  ⛔', '0.6552', '1.9152', 'Tiktok Followers [ Not Guaranteed ]', 'https://www.facebook.com/share/17qXUxu2PX/', '', '2026-05-08 03:19:12', '13257867', '0', 0, 0, NULL, '700'),
(171, 108, 1217, 'Tiktok Followers | Real | Max 100k | 10k-20k/Day | 120 Days Refill | ♻️', '1.027', '1.927', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@bdonofficial?_r=1&_t=ZS-96B9fWdUx7f', '', '2026-05-08 04:34:15', '13258353', '0', 0, 0, NULL, '500'),
(172, 76, 3666, 'Instagram Followers | Max 1M | Non Drop | Instant | 100K/Day | No Refill |', '0.4313', '3.1313', 'Instagram Followers | 𝗙𝗮𝘀𝘁𝗲𝘀𝘁 ɴᴇᴡ', 'https://www.instagram.com/oshoheii?igsh=ejc0OGZpbzRzZ2Y3', '', '2026-05-16 15:49:50', '13333880', '0', 0, 0, NULL, '1500'),
(173, 27, 330, 'Twitter Followers | Max 50K | 5k-10k/Day | No Refill |', '0.0936', '0.2736', 'X - Twitter Followers [ Not Guaranteed ]', 'https://x.com/hoodofmen?s=21', '', '2026-05-26 23:37:13', '13427735', '0', 0, 0, NULL, '100'),
(174, 27, 330, 'Twitter Followers | Max 50K | 5k-10k/Day | No Refill |', '0.0936', '0.2736', 'X - Twitter Followers [ Not Guaranteed ]', 'https://x.com/hoodofmen?s=21', '', '2026-05-27 00:22:16', '13427958', '0', 0, 0, NULL, '100'),
(175, 5, 3556, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.1641', '1.9641', 'Facebook Page/Profile Followers [ ᴄʜᴇᴀᴘᴇꜱᴛ ]', 'https://www.facebook.com/share/16orBY8opW/?mibextid=wwXIfr', '', '2026-06-02 07:51:10', '13484276', '0', 0, 0, NULL, '1000'),
(176, 5, 334, '🇺🇸Instagram Followers | USA | Max 10K | NON DROP | 30D Refill |', '0.6504', '1.5504', 'Instagram Followers [Targeted]', 'https://www.instagram.com/noablom80?igsh=anN6eDYzcGxwdW1w', '', '2026-06-04 07:04:56', '13512430', '0', 0, 0, NULL, '500'),
(177, 130, 1649, 'Facebook Followers | Page/ Profile | Max 100k | 5k-10k/Day | No Refill |', '0.0945', '0.9945', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/19taPqCv4R/?mibextid=wwXIfr', '', '2026-06-08 17:02:34', '13564531', '0', 0, 0, NULL, '500'),
(178, 141, 1796, 'Tiktok Followers | Real | Max 100k | 1k-20K/Day | Non Drop | No Refill |', '0.156', '0.336', 'Tiktok Followers [ Not Guaranteed ]', 'https://www.tiktok.com/@askofmiro?_r=1&_t=ZS-974Sl54oaFE', '', '2026-06-09 16:10:03', '13574331', '0', 0, 0, NULL, '100'),
(179, 130, 3556, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.07', '0.97', 'Facebook Page/Profile Followers [ ᴄʜᴇᴀᴘᴇꜱᴛ ]', 'https://www.facebook.com/share/1Hj7NN46k7/?mibextid=wwXIfr', '', '2026-06-09 16:44:45', '13574675', '0', 0, 0, NULL, '500'),
(180, 141, 3403, 'TikTok Followers  | HQ | instant | 50K/ Day | No Refill  ⛔', '0.1872', '0.5472', 'Tiktok Followers [ Not Guaranteed ]', 'https://www.tiktok.com/@grantboy_1?_r=1&_t=ZS-976KvfiX40P', '', '2026-06-10 18:39:27', '13584238', '0', 0, 0, NULL, '200'),
(181, 130, 1278, 'Facebook Page Followers | Max 50K | 10k/Day | Non Drop | 30D Refill |♻️', '0.109', '0.991', 'Facebook Page / Profile Followers', 'https://www.facebook.com/share/191prfpYbK/?mibextid=wwXIfr', '', '2026-06-11 19:53:22', '13593144', '0', 0, 0, NULL, '490'),
(182, 130, 2440, 'Twitter Followers | Max 100k | Instant Start | 10k-50k/Day | 30D Refill | ♻️', '0.7371', '0.9891', 'X - Twitter Followers [ Guaranteed ]', 'https://x.com/shandycabrto0l?s=21', '', '2026-06-12 22:45:26', '13602279', '0', 0, 0, NULL, '140'),
(183, 130, 1253, 'Twitter Likes | Max 50K | 20k/Day | Fast | No Refill |', '0.0157', '0.0427', 'X - Twitter Likes', 'https://x.com/shandycabrto0l?s=21', '', '2026-06-12 23:27:02', '13602470', '0', 0, 0, NULL, '15'),
(184, 144, 1278, 'Facebook Page Followers | Max 50K | 10k/Day | Non Drop | 30D Refill |♻️', '0.0223', '0.2023', 'Facebook Page / Profile Followers', 'https://www.facebook.com/profile.php?id=61582093601953', '', '2026-06-15 16:56:38', '13628209', '0', 0, 0, NULL, '100'),
(185, 27, 3771, 'Facebook Post Likes 👍 | Max 100K | Instant |', '0.001', '0.019', 'Facebook Reactions | 𝗙𝗮𝘀𝘁𝗲𝘀𝘁 ɴᴇᴡ', 'https://www.facebook.com/share/p/1EdixkjKwV/?mibextid=wwXIfr', '', '2026-06-22 20:51:03', '13694065', '0', 0, 0, NULL, '10'),
(186, 147, 3556, 'Facebook Page / Profile Followers | instant | Low drop | No refill', '0.2015', '1.0655', 'Facebook Page/Profile Followers [ ᴄʜᴇᴀᴘᴇꜱᴛ ]', 'https://www.facebook.com/profile.php?id=61591306433246&mibextid=wwXIfr&mibextid=wwXIfr', '', '2026-06-22 21:03:13', '13694169', '0', 0, 0, NULL, '480'),
(187, 147, 1441, 'Facebook Page Likes + Followers | Max 5M | 0-1H Start | 100k/Day | No Refill |', '0.1011', '0.9111', 'Facebook Page Likes + Followers', 'https://www.facebook.com/share/1CaUVGgDfG/?mibextid=wwXIfr', '', '2026-06-23 10:15:49', '13697769', '0', 0, 0, NULL, '450'),
(188, 76, 3423, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | 365D Refill |♻️', '0.36', '1.8', 'Instagram Followers [ REFILL 365 Days ]', 'https://www.instagram.com/yukiishikawa76?utm_source=qr&igsh=Nml6ZTkwMGE5MHRt', '', '2026-06-26 22:57:45', '13728178', '0', 0, 0, NULL, '800'),
(189, 76, 3405, 'TikTok Followers | HQ |  instant | 50K/ Day | 365 Days Refill ♻️⛔', '0.75', '1.65', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@user9542272272346', '', '2026-06-29 09:44:21', '13746735', '0', 0, 0, NULL, '500'),
(190, 76, 3447, 'TikTok Followers | Low Drop | instant | 365 Days Refill♻️', '0.875', '1.775', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://tiktok.com/@yungblud_614', '', '2026-06-30 00:17:57', '13752100', '0', 0, 0, NULL, '500'),
(191, 155, 618, 'Facebook Page / Profile Followers | Max 1M | 100k/Day | Instant | Lifetime refill♻️ | 𝙁𝙖𝙨𝙩𝙚𝙨𝙩🔥', '0.2498', '1.1498', 'Facebook Page / Profile Followers| 𝗦𝘂𝗽𝗲𝗿𝗳𝗮𝘀𝘁', 'https://www.facebook.com/share/1LM6pAptPY/?mibextid=wwXIfr', '', '2026-07-07 08:07:59', '13814954', '0', 0, 0, NULL, '500'),
(192, 76, 3669, 'Instagram Followers | Max 1M | Non Drop | Instant | 100K/Day | 365D Refill |♻️', '0.264', '1.704', 'Instagram Followers | 𝑩𝒆𝒔𝒕 𝑷𝒓𝒊𝒄𝒆𝒔 | ​𝙍𝙚𝙛𝙞𝙡𝙡​♻️​𝘽𝙪𝙩𝙩𝙤𝙣 ​𝙒𝙤𝙧𝙠𝙞𝙣𝙜✅', 'https://www.instagram.com/aafam614?igsh=OGIzc2VnMmNyaWly', '', '2026-07-08 13:35:57', '13825390', '0', 0, 0, NULL, '800'),
(193, 130, 3446, 'TikTok Followers | Low Drop | instant | 90 Days Refill♻️', '0.45', '0.99', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'www.tiktok.com/@expert.option109', '', '2026-07-08 21:40:40', '13829222', '0', 0, 0, NULL, '300'),
(194, 76, 1420, 'Twitter Followers | High Quality | Max 100k | 10k-50k/Day | Low Drop | 90D Refill | ♻️', '0.3', '0.48', 'X - Twitter Followers [ Guaranteed ]', 'https://x.com/onyekachar294/status/1996224429039472740?s=46', '', '2026-07-09 10:56:24', '13833304', '0', 0, 0, NULL, '100'),
(195, 76, 1420, 'Twitter Followers | High Quality | Max 100k | 10k-50k/Day | Low Drop | 90D Refill | ♻️', '0.3', '0.48', 'X - Twitter Followers [ Guaranteed ]', 'https://x.com/onyekachar294/status/1996224429039472740?s=46', '', '2026-07-09 10:56:49', '13833307', '0', 0, 0, NULL, '100'),
(196, 151, 2634, 'Tiktok Followers | Max 100k | With Profile Picture | 10k-50k/Day | 30D Refill | ♻️', '0.9867', '1.9767', 'Tiktok Followers [ Guaranteed ]', 'tiktok.com/@kattwilliamsprivatepage', '', '2026-07-09 18:37:09', '13837134', '0', 0, 0, NULL, '550'),
(197, 130, 3446, 'TikTok Followers | Low Drop | instant | 90 Days Refill♻️', '0.3', '0.66', 'Tiktok Followers [ 𝗖𝗵𝗲𝗮𝗽𝗲𝘀𝘁 ] ɴᴇᴡ', 'https://www.tiktok.com/@expert.option109?_r=1&_t=ZS-97tl7jpB22P', '', '2026-07-09 20:36:22', '13837785', '0', 0, 0, NULL, '200'),
(198, 130, 2634, 'Tiktok Followers | Max 100k | With Profile Picture | 10k-50k/Day | 30D Refill | ♻️', '0.0897', '0.1797', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@anmccoy2?_r=1&_t=ZS-97tlUxPqfBZ', '', '2026-07-09 20:38:53', '13837802', '0', 0, 0, NULL, '50'),
(199, 76, 3423, 'Instagram Followers | Good Qualily | Instant Start | 100K/Day | Low Drops | 365D Refill |♻️', '0.675', '3.375', 'Instagram Followers [ REFILL 365 Days ]', 'https://www.instagram.com/afamefunaafam608?igsh=MTg2MmZjdDI3Z2lmcA%3D%3D&utm_source=qr', '', '2026-07-10 00:29:04', '13838702', '0', 0, 0, NULL, '1500'),
(200, 130, 1528, 'Tiktok Followers | Real | Max 5k | 5k/Day | 30D Refill |♻️', '0.312', '0.612', 'Tiktok Followers [ Guaranteed ]', 'https://www.tiktok.com/@expert.option109?_r=1&_t=ZS-97yWGffaWLl', '', '2026-07-12 15:47:32', '13859599', '0', 0, 0, NULL, '200'),
(201, 76, 1886, '🇮🇷TikTok Real Followers | Iranian | Nice Quality | Real Active | Non Drop | 5k/Day |', '1.625', '2.375', 'Tiktok Followers [ TARGETED ]', 'https://www.tiktok.com/@chen21239?_r=1&_t=ZS-97yuQS8bf4W', '', '2026-07-12 21:15:43', '13861740', '0', 0, 0, NULL, '500'),
(202, 160, 1442, 'Twitter Followers | High Quality | Max 100k | 10k-50k/Day | Low Drop | 30D Refill | ♻️', '1.7205', '2.8455', 'X - Twitter Followers [ Guaranteed ]', 'https://x.com/silvia1williams?s=11', '', '2026-07-14 05:28:13', '13872754', '0', 0, 0, NULL, '750'),
(203, 160, 1253, 'Twitter Likes | Max 50K | 20k/Day | Fast | No Refill |', '0.0209', '0.0509', 'X - Twitter Likes', 'https://x.com/Silvia1williams/status/2076829615369183529/video/1', '', '2026-07-14 05:35:05', '13872780', '0', 0, 0, NULL, '20'),
(204, 76, 3840, 'Instagram Followers | Max 100k | Low Drop | Instant | 100K/Day | 365 Days Refill |♻️', '0.19', '0.94', 'Instagram Followers | 𝗙𝗮𝘀𝘁𝗲𝘀𝘁 𝗪𝗼𝗿𝗸𝗶𝗻𝗴 |', 'https://www.instagram.com/chenrui8073?igsh=cHU3MnpqZXZ3bXRl', '', '2026-07-17 22:09:26', '13909180', '0', 0, 0, NULL, '500'),
(205, 76, 3840, 'Instagram Followers | Max 100k | Low Drop | Instant | 100K/Day | 365 Days Refill |♻️', '0.19', '0.94', 'Instagram Followers | 𝗙𝗮𝘀𝘁𝗲𝘀𝘁 𝗪𝗼𝗿𝗸𝗶𝗻𝗴 |', 'https://www.instagram.com/rayc_hvio?igsh=dmFtYjFyamNnaG02', '', '2026-07-17 22:16:32', '13909208', '0', 0, 0, NULL, '500'),
(206, 76, 3659, 'Threads Verified Account Followers | 1 Follower', '0.2', '0.35', 'Threads Services [ From VERIFIED✅ Accounts]', 'https://www.threads.com/@onyeka.charles.71', '', '2026-07-17 23:15:10', '13909453', '0', 0, 0, NULL, '100'),
(207, 76, 3659, 'Threads Verified Account Followers | 1 Follower', '0.002', '0.0038', 'Threads Services [ From VERIFIED✅ Accounts]', 'https://www.threads.com/@onyeka.charles.71', '', '2026-07-18 05:46:49', '13911372', '0', 0, 0, NULL, '1'),
(208, 160, 3838, 'Instagram Followers | Max 100k | Non Drop | Instant | 100K/Day | 30 Days Refill |♻️', '0.516', '2.676', 'Instagram Followers | 𝐒𝐮𝐩𝐞𝐫𝐟𝐚𝐬𝐭 𝐒𝐩𝐞𝐞𝐝 |ᴜᴘᴅᴀᴛᴇᴅ', 'https://www.instagram.com /akaemmawatsonfanbase?igsh= MWNwM3ZoZW5icjQwYQ==', '', '2026-07-21 02:15:25', '13940713', '0', 0, 0, NULL, '1200'),
(209, 160, 3838, 'Instagram Followers | Max 100k | Non Drop | Instant | 100K/Day | 30 Days Refill |♻️', '0.645', '3.345', 'Instagram Followers | 𝐒𝐮𝐩𝐞𝐫𝐟𝐚𝐬𝐭 𝐒𝐩𝐞𝐞𝐝 |ᴜᴘᴅᴀᴛᴇᴅ', 'https://www.instagram.com /akaemmawatsonfanbase?igsh= MWNwM3ZoZW5icjQwYQ==', '', '2026-07-21 19:02:29', '13948376', '0', 0, 0, NULL, '1500'),
(210, 160, 1143, 'Facebook Page Followers | Max 10k | Non Drop | 30D Refill |♻', '0.2475', '1.1475', '⭐Cheapest Service⭐', 'https://www.facebook.com/share/1JbmJfdzmP/', '', '2026-07-23 02:48:18', '13960708', '0', 0, 0, NULL, '500'),
(211, 76, 3667, 'Instagram Followers | Max 1M | Non Drop | Instant | 100K/Day | 30D Refill |♻️', '0.75', '3', 'Instagram Followers | 𝑩𝒆𝒔𝒕 𝑷𝒓𝒊𝒄𝒆𝒔 | ​', 'https://www.instagram.com/agubadikenaaba?igsh=bjFyb3Zvb280MGZx', '', '2026-08-02 03:46:52', '14056784', '0', 0, 0, NULL, '1500');
INSERT INTO `user_orders` (`id`, `user`, `service_id`, `order_name`, `sub_price`, `order_price`, `order_category`, `social_url`, `message`, `created_at`, `order_id`, `charge`, `start_count`, `remains`, `currency`, `quanity`) VALUES
(212, 76, 1796, 'Tiktok Followers | Real | Max 100k | 1k-20K/Day | Non Drop | No Refill |', '0.6174', '1.3674', 'Tiktok Followers [ Not Guaranteed ]', 'https://www.tiktok.com/@chen21239?_r=1&_t=ZS-98XMk4z2mZR', '', '2026-08-02 03:54:11', '14056882', '0', 0, 0, NULL, '500');

-- --------------------------------------------------------

--
-- Table structure for table `user_security_settings`
--

CREATE TABLE `user_security_settings` (
  `user_id` int NOT NULL,
  `two_step` tinyint(1) DEFAULT '0',
  `auth_type` enum('pin','password') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'password',
  `recovery_email` tinyint(1) DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_security_settings`
--

INSERT INTO `user_security_settings` (`user_id`, `two_step`, `auth_type`, `recovery_email`, `updated_at`) VALUES
(1, 1, 'pin', 1, '2025-11-25 07:58:40'),
(112, 1, 'pin', 1, '2026-02-24 19:20:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_account`
--
ALTER TABLE `payment_account`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_api_keys`
--
ALTER TABLE `user_api_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_account`
--
ALTER TABLE `payment_account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `user_api_keys`
--
ALTER TABLE `user_api_keys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
