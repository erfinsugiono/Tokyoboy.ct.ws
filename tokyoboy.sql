-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.infinityfree.com
-- Generation Time: Aug 12, 2025 at 04:41 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39003567_db_erfin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'Shafa');

-- --------------------------------------------------------

--
-- Table structure for table `aired`
--

CREATE TABLE `aired` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aired`
--

INSERT INTO `aired` (`id`, `name`) VALUES
(10, 'Jan 10'),
(11, '2015 to Jun 20'),
(12, '2015'),
(13, 'Jan 10, 2015 to Jun 20, 2015'),
(14, 'Jul 12, 2017 to Sep 27, 2017'),
(15, 'Apr 5, 2013 to Jun 28, 2013'),
(16, 'Oct 4, 2018 to Dec 27, 2018'),
(17, 'Jul 5, 2015 to Sep 27, 2015'),
(18, 'Apr 6, 2011 to Sep 14, 2011'),
(19, 'Jan 7, 2024 to Mar 31, 2024'),
(20, 'Jul 4, 2015 to Sep 19, 2015'),
(21, 'Jun 29, 2023 to Sep 14, 2023'),
(22, 'Sep 29, 2023 to Mar 22, 2024'),
(23, 'Apr 5, 2009 to Jul 4, 2010'),
(24, 'Jan 5, 2025 to Mar 30, 2025'),
(25, 'Jul 6, 2025 to ?'),
(26, 'Jul 5, 2025 to ?');

-- --------------------------------------------------------

--
-- Table structure for table `broadcasts`
--

CREATE TABLE `broadcasts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `broadcasts`
--

INSERT INTO `broadcasts` (`id`, `name`) VALUES
(1, 'Saturdays at 01:25 (JST)'),
(2, 'Sundays at 17:00 (JST)'),
(3, 'Saturdays at 00:55 (JST)'),
(4, 'Wednesdays at 23:30 (JST)'),
(5, 'Fridays at 01:28 (JST)'),
(6, 'Thursdays at 02:20 (JST)'),
(7, 'Sundays at 00:00 (JST)'),
(8, 'Wednesdays at 02:05 (JST)'),
(9, 'Saturdays at 00:30 (JST)'),
(10, 'Thursdays at 23:00 (JST)'),
(11, 'Fridays at 23:00 (JST)'),
(12, 'Saturdays at 23:30 (JST)');

-- --------------------------------------------------------

--
-- Table structure for table `demographics`
--

CREATE TABLE `demographics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `demographics`
--

INSERT INTO `demographics` (`id`, `name`) VALUES
(1, 'Shounen'),
(2, 'Shoujo'),
(3, 'Seinen'),
(4, 'Josei'),
(5, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `download_batch`
--

CREATE TABLE `download_batch` (
  `id` int(11) NOT NULL,
  `post_id` int(36) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `resolution` varchar(10) DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `download_batch`
--

INSERT INTO `download_batch` (`id`, `post_id`, `platform`, `resolution`, `url`) VALUES
(1, 1, 'mega', '240p', 'https://ouo.io/vMwmfpC'),
(2, 1, 'mega', '360p', 'https://ouo.io/0bt2kKP'),
(3, 1, 'mega', '480p', 'https://ouo.io/yzaeH2'),
(4, 1, 'mega', '720p', 'https://ouo.io/3rGo0j'),
(5, 1, 'mega', '1080p', 'https://ouo.io/tgfUVp'),
(6, 2, 'mega', '240p', 'https://ouo.io/vMwmfpC'),
(7, 2, 'mega', '360p', 'https://ouo.io/0bt2kKP'),
(8, 2, 'mega', '480p', 'https://ouo.io/yzaeH2'),
(9, 2, 'mega', '720p', 'https://ouo.io/3rGo0j'),
(10, 2, 'mega', '1080p', 'https://ouo.io/tgfUVp'),
(11, 3, 'mega', '240p', 'https://ouo.io/vMwmfpC'),
(12, 3, 'mega', '360p', 'https://ouo.io/0bt2kKP'),
(13, 3, 'mega', '480p', 'https://ouo.io/yzaeH2'),
(14, 3, 'mega', '720p', 'https://ouo.io/3rGo0j'),
(15, 3, 'mega', '1080p', 'https://ouo.io/tgfUVp');

-- --------------------------------------------------------

--
-- Table structure for table `download_links`
--

CREATE TABLE `download_links` (
  `id` int(11) NOT NULL,
  `episode_number` varchar(11) NOT NULL,
  `resolution` varchar(10) NOT NULL,
  `url` text NOT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `download_links`
--

INSERT INTO `download_links` (`id`, `episode_number`, `resolution`, `url`, `post_id`) VALUES
(1, '1', '240p', 'https://ouo.io/2vfIRF', 1),
(2, '2', '240p', 'https://ouo.io/XeYNUq', 1),
(3, '3', '240p', 'https://ouo.io/eMPJyX', 1),
(4, '4', '240p', 'https://ouo.io/Dt9I78', 1),
(5, '5', '240p', 'https://ouo.io/M9h98z', 1),
(6, '6', '240p', 'https://ouo.io/U7dFjsL', 1),
(7, '7', '240p', 'https://ouo.io/7Bhf2T5', 1),
(8, '7.5', '240p', 'https://ouo.io/4OU0eM', 1),
(9, '8', '240p', 'https://ouo.io/4OU0eM', 1),
(10, '9', '240p', 'https://ouo.io/WnMW5A', 1),
(11, '10', '240p', 'https://ouo.io/ed7yK3', 1),
(12, '11', '240p', 'https://ouo.io/qUji4t', 1),
(13, '12', '240p', 'https://ouo.io/zHVcwES', 1),
(14, '13', '240p', 'https://ouo.io/WNe6Co', 1),
(15, '1', '360p', 'https://ouo.io/sgYARp', 1),
(16, '2', '360p', 'https://ouo.io/cAmJZd', 1),
(17, '3', '360p', 'https://ouo.io/jTklHs', 1),
(18, '4', '360p', 'https://ouo.io/AAk7yMV', 1),
(19, '5', '360p', 'https://ouo.io/FP79kP', 1),
(20, '6', '360p', 'https://ouo.io/6O4QQrp', 1),
(21, '7', '360p', 'https://ouo.io/VWFKzwq', 1),
(22, '7.5', '360p', 'https://ouo.io/FKZn6h', 1),
(23, '8', '360p', 'https://ouo.io/FKZn6h', 1),
(24, '9', '360p', 'https://ouo.io/V2C1Qs', 1),
(25, '10', '360p', 'https://ouo.io/EvzLz5', 1),
(26, '11', '360p', 'https://ouo.io/LAJD4P2', 1),
(27, '12', '360p', 'https://ouo.io/RhjX5Jn', 1),
(28, '13', '360p', 'https://ouo.io/lbvk6B', 1),
(29, '1', '480p', 'https://ouo.io/UGHXopc', 1),
(30, '2', '480p', 'https://ouo.io/C738uK', 1),
(31, '3', '480p', 'https://ouo.io/ZPDhzpM', 1),
(32, '4', '480p', 'https://ouo.io/lgXHbwY', 1),
(33, '5', '480p', 'https://ouo.io/rx12Ma', 1),
(34, '6', '480p', 'https://ouo.io/w9ri3fI', 1),
(35, '7', '480p', 'https://ouo.io/u4Hlqc', 1),
(36, '7.5', '480p', 'https://ouo.io/RdVmuW', 1),
(37, '8', '480p', 'https://ouo.io/RdVmuW', 1),
(38, '9', '480p', 'https://ouo.io/KerTbY', 1),
(39, '10', '480p', 'https://ouo.io/HNS4Kmx', 1),
(40, '11', '480p', 'https://ouo.io/RIqRTV', 1),
(41, '12', '480p', 'https://ouo.io/T5vrTw2', 1),
(42, '13', '480p', 'https://ouo.io/iipsebQ', 1),
(43, '1', '720p', 'https://ouo.io/jzBZLIU', 1),
(44, '2', '720p', 'https://ouo.io/zBMq0hI', 1),
(45, '3', '720p', 'https://ouo.io/uPnPrU', 1),
(46, '4', '720p', 'https://ouo.io/B5kvhr', 1),
(47, '5', '720p', 'https://ouo.io/SntP5BA', 1),
(48, '6', '720p', 'https://ouo.io/SBZIpG', 1),
(49, '7', '720p', 'https://ouo.io/IEApXQi', 1),
(50, '7.5', '720p', 'https://ouo.io/Zk1l7b', 1),
(51, '8', '720p', 'https://ouo.io/Zk1l7b', 1),
(52, '9', '720p', 'https://ouo.io/7ygzDM', 1),
(53, '10', '720p', 'https://ouo.io/04TT4p', 1),
(54, '11', '720p', 'https://ouo.io/4ARekq', 1),
(55, '12', '720p', 'https://ouo.io/uMy2qA', 1),
(56, '13', '720p', 'https://ouo.io/98stxfl', 1),
(57, '1', '1080p', 'https://ouo.io/ckSQuTc', 1),
(58, '2', '1080p', 'https://ouo.io/gj948W3', 1),
(59, '3', '1080p', 'https://ouo.io/d12eYr', 1),
(60, '4', '1080p', 'https://ouo.io/WlMQUo1', 1),
(61, '5', '1080p', 'https://ouo.io/0f3tjx', 1),
(62, '6', '1080p', 'https://ouo.io/CEnSQD', 1),
(63, '7', '1080p', 'https://ouo.io/rtfwdn', 1),
(64, '7.5', '1080p', 'https://ouo.io/uLgpLU', 1),
(65, '8', '1080p', 'https://ouo.io/uLgpLU', 1),
(66, '9', '1080p', 'https://ouo.io/QwAMpLM', 1),
(67, '10', '1080p', 'https://ouo.io/3fRRqa8', 1),
(68, '11', '1080p', 'https://ouo.io/E4PNM7', 1),
(69, '12', '1080p', 'https://ouo.io/ioJ2caJ', 1),
(70, '13', '1080p', 'https://ouo.io/jlPydm', 1),
(71, '1', '240p', 'https://ouo.io/2vfIRF', 2),
(72, '2', '240p', 'https://ouo.io/XeYNUq', 2),
(73, '3', '240p', 'https://ouo.io/eMPJyX', 2),
(74, '4', '240p', 'https://ouo.io/Dt9I78', 2),
(75, '5', '240p', 'https://ouo.io/M9h98z', 2),
(76, '6', '240p', 'https://ouo.io/U7dFjsL', 2),
(77, '7', '240p', 'https://ouo.io/7Bhf2T5', 2),
(78, '7.5', '240p', 'https://ouo.io/4OU0eM', 2),
(79, '8', '240p', 'https://ouo.io/4OU0eM', 2),
(80, '9', '240p', 'https://ouo.io/WnMW5A', 2),
(81, '10', '240p', 'https://ouo.io/ed7yK3', 2),
(82, '11', '240p', 'https://ouo.io/qUji4t', 2),
(83, '12', '240p', 'https://ouo.io/zHVcwES', 2),
(84, '13', '240p', 'https://ouo.io/WNe6Co', 2),
(85, '1', '360p', 'https://ouo.io/sgYARp', 2),
(86, '2', '360p', 'https://ouo.io/cAmJZd', 2),
(87, '3', '360p', 'https://ouo.io/jTklHs', 2),
(88, '4', '360p', 'https://ouo.io/AAk7yMV', 2),
(89, '5', '360p', 'https://ouo.io/FP79kP', 2),
(90, '6', '360p', 'https://ouo.io/6O4QQrp', 2),
(91, '7', '360p', 'https://ouo.io/VWFKzwq', 2),
(92, '7.5', '360p', 'https://ouo.io/FKZn6h', 2),
(93, '8', '360p', 'https://ouo.io/FKZn6h', 2),
(94, '9', '360p', 'https://ouo.io/V2C1Qs', 2),
(95, '10', '360p', 'https://ouo.io/EvzLz5', 2),
(96, '11', '360p', 'https://ouo.io/LAJD4P2', 2),
(97, '12', '360p', 'https://ouo.io/RhjX5Jn', 2),
(98, '13', '360p', 'https://ouo.io/lbvk6B', 2),
(99, '1', '480p', 'https://ouo.io/UGHXopc', 2),
(100, '2', '480p', 'https://ouo.io/C738uK', 2),
(101, '3', '480p', 'https://ouo.io/ZPDhzpM', 2),
(102, '4', '480p', 'https://ouo.io/lgXHbwY', 2),
(103, '5', '480p', 'https://ouo.io/rx12Ma', 2),
(104, '6', '480p', 'https://ouo.io/w9ri3fI', 2),
(105, '7', '480p', 'https://ouo.io/u4Hlqc', 2),
(106, '7.5', '480p', 'https://ouo.io/RdVmuW', 2),
(107, '8', '480p', 'https://ouo.io/RdVmuW', 2),
(108, '9', '480p', 'https://ouo.io/KerTbY', 2),
(109, '10', '480p', 'https://ouo.io/HNS4Kmx', 2),
(110, '11', '480p', 'https://ouo.io/RIqRTV', 2),
(111, '12', '480p', 'https://ouo.io/T5vrTw2', 2),
(112, '13', '480p', 'https://ouo.io/iipsebQ', 2),
(113, '1', '720p', 'https://ouo.io/jzBZLIU', 2),
(114, '2', '720p', 'https://ouo.io/zBMq0hI', 2),
(115, '3', '720p', 'https://ouo.io/uPnPrU', 2),
(116, '4', '720p', 'https://ouo.io/B5kvhr', 2),
(117, '5', '720p', 'https://ouo.io/SntP5BA', 2),
(118, '6', '720p', 'https://ouo.io/SBZIpG', 2),
(119, '7', '720p', 'https://ouo.io/IEApXQi', 2),
(120, '7.5', '720p', 'https://ouo.io/Zk1l7b', 2),
(121, '8', '720p', 'https://ouo.io/Zk1l7b', 2),
(122, '9', '720p', 'https://ouo.io/7ygzDM', 2),
(123, '10', '720p', 'https://ouo.io/04TT4p', 2),
(124, '11', '720p', 'https://ouo.io/4ARekq', 2),
(125, '12', '720p', 'https://ouo.io/uMy2qA', 2),
(126, '13', '720p', 'https://ouo.io/98stxfl', 2),
(127, '1', '1080p', 'https://ouo.io/ckSQuTc', 2),
(128, '2', '1080p', 'https://ouo.io/gj948W3', 2),
(129, '3', '1080p', 'https://ouo.io/d12eYr', 2),
(130, '4', '1080p', 'https://ouo.io/WlMQUo1', 2),
(131, '5', '1080p', 'https://ouo.io/0f3tjx', 2),
(132, '6', '1080p', 'https://ouo.io/CEnSQD', 2),
(133, '7', '1080p', 'https://ouo.io/rtfwdn', 2),
(134, '7.5', '1080p', 'https://ouo.io/uLgpLU', 2),
(135, '8', '1080p', 'https://ouo.io/uLgpLU', 2),
(136, '9', '1080p', 'https://ouo.io/QwAMpLM', 2),
(137, '10', '1080p', 'https://ouo.io/3fRRqa8', 2),
(138, '11', '1080p', 'https://ouo.io/E4PNM7', 2),
(139, '12', '1080p', 'https://ouo.io/ioJ2caJ', 2),
(140, '13', '1080p', 'https://ouo.io/jlPydm', 2),
(141, '1', '240p', 'https://ouo.io/2vfIRF', 3),
(142, '2', '240p', 'https://ouo.io/XeYNUq', 3),
(143, '3', '240p', 'https://ouo.io/eMPJyX', 3),
(144, '4', '240p', 'https://ouo.io/Dt9I78', 3),
(145, '5', '240p', 'https://ouo.io/M9h98z', 3),
(146, '6', '240p', 'https://ouo.io/U7dFjsL', 3),
(147, '7', '240p', 'https://ouo.io/7Bhf2T5', 3),
(148, '7.5', '240p', 'https://ouo.io/4OU0eM', 3),
(149, '8', '240p', 'https://ouo.io/4OU0eM', 3),
(150, '9', '240p', 'https://ouo.io/WnMW5A', 3),
(151, '10', '240p', 'https://ouo.io/ed7yK3', 3),
(152, '11', '240p', 'https://ouo.io/qUji4t', 3),
(153, '12', '240p', 'https://ouo.io/zHVcwES', 3),
(154, '13', '240p', 'https://ouo.io/WNe6Co', 3),
(155, '1', '360p', 'https://ouo.io/sgYARp', 3),
(156, '2', '360p', 'https://ouo.io/cAmJZd', 3),
(157, '3', '360p', 'https://ouo.io/jTklHs', 3),
(158, '4', '360p', 'https://ouo.io/AAk7yMV', 3),
(159, '5', '360p', 'https://ouo.io/FP79kP', 3),
(160, '6', '360p', 'https://ouo.io/6O4QQrp', 3),
(161, '7', '360p', 'https://ouo.io/VWFKzwq', 3),
(162, '7.5', '360p', 'https://ouo.io/FKZn6h', 3),
(163, '8', '360p', 'https://ouo.io/FKZn6h', 3),
(164, '9', '360p', 'https://ouo.io/V2C1Qs', 3),
(165, '10', '360p', 'https://ouo.io/EvzLz5', 3),
(166, '11', '360p', 'https://ouo.io/LAJD4P2', 3),
(167, '12', '360p', 'https://ouo.io/RhjX5Jn', 3),
(168, '13', '360p', 'https://ouo.io/lbvk6B', 3),
(169, '1', '480p', 'https://ouo.io/UGHXopc', 3),
(170, '2', '480p', 'https://ouo.io/C738uK', 3),
(171, '3', '480p', 'https://ouo.io/ZPDhzpM', 3),
(172, '4', '480p', 'https://ouo.io/lgXHbwY', 3),
(173, '5', '480p', 'https://ouo.io/rx12Ma', 3),
(174, '6', '480p', 'https://ouo.io/w9ri3fI', 3),
(175, '7', '480p', 'https://ouo.io/u4Hlqc', 3),
(176, '7.5', '480p', 'https://ouo.io/RdVmuW', 3),
(177, '8', '480p', 'https://ouo.io/RdVmuW', 3),
(178, '9', '480p', 'https://ouo.io/KerTbY', 3),
(179, '10', '480p', 'https://ouo.io/HNS4Kmx', 3),
(180, '11', '480p', 'https://ouo.io/RIqRTV', 3),
(181, '12', '480p', 'https://ouo.io/T5vrTw2', 3),
(182, '13', '480p', 'https://ouo.io/iipsebQ', 3),
(183, '1', '720p', 'https://ouo.io/jzBZLIU', 3),
(184, '2', '720p', 'https://ouo.io/zBMq0hI', 3),
(185, '3', '720p', 'https://ouo.io/uPnPrU', 3),
(186, '4', '720p', 'https://ouo.io/B5kvhr', 3),
(187, '5', '720p', 'https://ouo.io/SntP5BA', 3),
(188, '6', '720p', 'https://ouo.io/SBZIpG', 3),
(189, '7', '720p', 'https://ouo.io/IEApXQi', 3),
(190, '7.5', '720p', 'https://ouo.io/Zk1l7b', 3),
(191, '8', '720p', 'https://ouo.io/Zk1l7b', 3),
(192, '9', '720p', 'https://ouo.io/7ygzDM', 3),
(193, '10', '720p', 'https://ouo.io/04TT4p', 3),
(194, '11', '720p', 'https://ouo.io/4ARekq', 3),
(195, '12', '720p', 'https://ouo.io/uMy2qA', 3),
(196, '13', '720p', 'https://ouo.io/98stxfl', 3),
(197, '1', '1080p', 'https://ouo.io/ckSQuTc', 3),
(198, '2', '1080p', 'https://ouo.io/gj948W3', 3),
(199, '3', '1080p', 'https://ouo.io/d12eYr', 3),
(200, '4', '1080p', 'https://ouo.io/WlMQUo1', 3),
(201, '5', '1080p', 'https://ouo.io/0f3tjx', 3),
(202, '6', '1080p', 'https://ouo.io/CEnSQD', 3),
(203, '7', '1080p', 'https://ouo.io/rtfwdn', 3),
(204, '7.5', '1080p', 'https://ouo.io/uLgpLU', 3),
(205, '8', '1080p', 'https://ouo.io/uLgpLU', 3),
(206, '9', '1080p', 'https://ouo.io/QwAMpLM', 3),
(207, '10', '1080p', 'https://ouo.io/3fRRqa8', 3),
(208, '11', '1080p', 'https://ouo.io/E4PNM7', 3),
(209, '12', '1080p', 'https://ouo.io/ioJ2caJ', 3),
(210, '13', '1080p', 'https://ouo.io/jlPydm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `durations`
--

CREATE TABLE `durations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `durations`
--

INSERT INTO `durations` (`id`, `name`) VALUES
(1, '23 min. per ep.'),
(2, '24 min. per ep.');

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `name`) VALUES
(1, '12'),
(2, '13');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Romance'),
(2, 'Drama'),
(3, 'Supernatural'),
(4, 'Action'),
(5, 'Adventure'),
(6, 'Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `licensors`
--

CREATE TABLE `licensors` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `licensors`
--

INSERT INTO `licensors` (`id`, `name`) VALUES
(1, 'None found'),
(2, 'add some');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alt_titles` mediumtext DEFAULT NULL,
  `information` mediumtext DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `score` float DEFAULT 0,
  `type` varchar(50) DEFAULT NULL,
  `episodes` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `aired` varchar(255) DEFAULT NULL,
  `premiered` varchar(100) DEFAULT NULL,
  `broadcast` varchar(255) DEFAULT NULL,
  `producers` mediumtext DEFAULT NULL,
  `licensors` mediumtext DEFAULT NULL,
  `studios` mediumtext DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uuid`, `title`, `alt_titles`, `information`, `slug`, `image_path`, `content`, `views`, `created_at`, `score`, `type`, `episodes`, `status`, `aired`, `premiered`, `broadcast`, `producers`, `licensors`, `studios`, `source`, `duration`, `rating`, `is_published`) VALUES
(1, NULL, 'Ore dake Level Up na Ken', 'Synonyms: Na Honjaman Level Up, 나 혼자만 레벨업, I Level Up Alone\r\nJapanese: 俺だけレベルアップな件\r\nEnglish: Solo Leveling', 'Type: TV\r\nEpisodes: 12\r\nStatus: Finished Airing\r\nAired: Jan 7, 2024 to Mar 31, 2024\r\nPremiered: Winter 2024\r\nBroadcast: Sundays at 00:00 (JST)\r\nProducers: Aniplex, Crunchyroll, Netmarble, Kakao piccoma, D&C Media\r\nLicensors: None found, add some\r\nStudios: A-1 Pictures\r\nSource: Web manga\r\nGenres: Action, Adventure, Fantasy\r\nThemes: Adult Cast, Urban Fantasy\r\nDuration: 23 min. per ep.\r\nRating: R - 17+ (violence & profanity)', 'ore-dake-level-up-na-ken', 'uploads/142390.jpg', 'Umat manusia berada di ambang jurang satu dekade lalu ketika gerbang pertama—portal yang terhubung dengan dimensi lain yang menyimpan monster-monster yang kebal terhadap persenjataan konvensional—muncul di seluruh dunia. Bersamaan dengan kemunculan gerbang-gerbang tersebut, berbagai manusia bertransformasi menjadi pemburu dan dianugerahi kemampuan super. Bertanggung jawab untuk memasuki gerbang dan membersihkan ruang bawah tanah di dalamnya, banyak pemburu memilih untuk membentuk serikat demi mengamankan mata pencaharian mereka.\r\n\r\nSung Jin-Woo adalah seorang pemburu peringkat-E yang dijuluki sebagai pemburu terlemah di seluruh umat manusia. Saat menjelajahi ruang bawah tanah yang konon aman, ia dan kelompoknya menemukan sebuah terowongan tak biasa yang mengarah ke area yang lebih dalam. Tergoda oleh prospek harta karun, kelompok itu terus maju, hanya untuk dihadapkan pada kengerian yang tak terbayangkan. Ajaibnya, Jin-Woo selamat dari insiden itu dan segera menyadari bahwa ia kini memiliki akses ke sebuah antarmuka yang hanya dapat dilihat olehnya. Sistem misterius ini menjanjikan kekuatan yang telah lama ia impikan—tetapi semuanya harus dibayar dengan harga yang mahal.\r\n\r\n[Ditulis oleh MAL Rewrite]', 0, '2025-07-15 15:13:56', 8.25, 'TV', 12, 'Finished Airing', 'Jan 7, 2024 to Mar 31, 2024', 'Winter 2024', 'Sundays at 00:00 (JST)', 'Aniplex, Crunchyroll, Netmarble, Kakao piccoma, D&C Media', 'None found, add some', 'A-1 Pictures', 'Web manga', '23 min. per ep.', 'R - 17+ (violence & profanity)', 1),
(2, NULL, 'Ore dake Level Up na Ken', 'Synonyms: Na Honjaman Level Up, 나 혼자만 레벨업, I Level Up Alone\r\nJapanese: 俺だけレベルアップな件\r\nEnglish: Solo Leveling', 'Type: TV\r\nEpisodes: 12\r\nStatus: Finished Airing\r\nAired: Jan 7, 2024 to Mar 31, 2024\r\nPremiered: Winter 2024\r\nBroadcast: Sundays at 00:00 (JST)\r\nProducers: Crunchyroll, Aniplex, Netmarble, Kakao piccoma, D&C Media\r\nLicensors: None found, add some\r\nStudios: A-1 Pictures\r\nGenres: Action, Adventure, Fantasy\r\nThemes: Adult Cast, Urban Fantasy\r\nDuration: 23 min. per ep.\r\nRating: R - 17+ (violence & profanity)', 'ore-dake-level-up-na-ken-season-1', 'uploads/142390.jpg', 'Umat manusia berada di ambang jurang satu dekade lalu ketika gerbang pertama—portal yang terhubung dengan dimensi lain yang menyimpan monster-monster yang kebal terhadap persenjataan konvensional—muncul di seluruh dunia. Bersamaan dengan kemunculan gerbang-gerbang tersebut, berbagai manusia bertransformasi menjadi pemburu dan dianugerahi kemampuan super. Bertanggung jawab untuk memasuki gerbang dan membersihkan ruang bawah tanah di dalamnya, banyak pemburu memilih untuk membentuk serikat demi mengamankan mata pencaharian mereka.\r\n\r\nSung Jin-Woo adalah seorang pemburu peringkat-E yang dijuluki sebagai pemburu terlemah di seluruh umat manusia. Saat menjelajahi ruang bawah tanah yang konon aman, ia dan kelompoknya menemukan sebuah terowongan tak biasa yang mengarah ke area yang lebih dalam. Tergoda oleh prospek harta karun, kelompok itu terus maju, hanya untuk dihadapkan pada kengerian yang tak terbayangkan. Ajaibnya, Jin-Woo selamat dari insiden itu dan segera menyadari bahwa ia kini memiliki akses ke sebuah antarmuka yang hanya dapat dilihat olehnya. Sistem misterius ini menjanjikan kekuatan yang telah lama ia impikan—tetapi semuanya harus dibayar dengan harga yang mahal.', 0, '2025-08-02 02:08:29', 8.75, 'TV', 12, 'Finished Airing', 'Jan 7, 2024 to Mar 31, 2024', 'Winter 2024', 'Sundays at 00:00 (JST)', 'Crunchyroll, Aniplex, Netmarble, Kakao piccoma, D&C Media', 'None found, add some', 'A-1 Pictures', NULL, '23 min. per ep.', 'R - 17+ (violence & profanity)', 1),
(3, NULL, 'Ore dake Level Up na Ken', 'Synonyms: Na Honjaman Level Up, 나 혼자만 레벨업, I Level Up Alone\r\nJapanese: 俺だけレベルアップな件\r\nEnglish: Solo Leveling', 'Type: TV\r\nEpisodes: 12\r\nStatus: Finished Airing\r\nAired: Jan 7, 2024 to Mar 31, 2024\r\nPremiered: Winter 2024\r\nBroadcast: Sundays at 00:00 (JST)\r\nProducers: Crunchyroll, Aniplex, Netmarble, Kakao piccoma, D&C Media\r\nLicensors: None found, add some\r\nStudios: A-1 Pictures\r\nGenres: Action, Adventure, Fantasy\r\nThemes: Adult Cast, Urban Fantasy\r\nDuration: 23 min. per ep.\r\nRating: R - 17+ (violence & profanity)', 'ore-dake-level-up-na-ken-season-1', 'uploads/142390.jpg', 'Umat manusia berada di ambang jurang satu dekade lalu ketika gerbang pertama—portal yang terhubung dengan dimensi lain yang menyimpan monster-monster yang kebal terhadap persenjataan konvensional—muncul di seluruh dunia. Bersamaan dengan kemunculan gerbang-gerbang tersebut, berbagai manusia bertransformasi menjadi pemburu dan dianugerahi kemampuan super. Bertanggung jawab untuk memasuki gerbang dan membersihkan ruang bawah tanah di dalamnya, banyak pemburu memilih untuk membentuk serikat demi mengamankan mata pencaharian mereka.\r\n\r\nSung Jin-Woo adalah seorang pemburu peringkat-E yang dijuluki sebagai pemburu terlemah di seluruh umat manusia. Saat menjelajahi ruang bawah tanah yang konon aman, ia dan kelompoknya menemukan sebuah terowongan tak biasa yang mengarah ke area yang lebih dalam. Tergoda oleh prospek harta karun, kelompok itu terus maju, hanya untuk dihadapkan pada kengerian yang tak terbayangkan. Ajaibnya, Jin-Woo selamat dari insiden itu dan segera menyadari bahwa ia kini memiliki akses ke sebuah antarmuka yang hanya dapat dilihat olehnya. Sistem misterius ini menjanjikan kekuatan yang telah lama ia impikan—tetapi semuanya harus dibayar dengan harga yang mahal.', 0, '2025-08-06 08:37:47', 8.25, 'TV', 12, 'Finished Airing', 'Jan 7, 2024 to Mar 31, 2024', 'Winter 2024', 'Sundays at 00:00 (JST)', 'Crunchyroll, Aniplex, Netmarble, Kakao piccoma, D&C Media', 'None found, add some', 'A-1 Pictures', NULL, '23 min. per ep.', 'R - 17+ (violence & profanity)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_aired`
--

CREATE TABLE `post_aired` (
  `post_id` int(11) NOT NULL,
  `aired_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_aired`
--

INSERT INTO `post_aired` (`post_id`, `aired_id`) VALUES
(1, 19),
(2, 19),
(3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `post_broadcasts`
--

CREATE TABLE `post_broadcasts` (
  `post_id` int(11) NOT NULL,
  `broadcast_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_broadcasts`
--

INSERT INTO `post_broadcasts` (`post_id`, `broadcast_id`) VALUES
(1, 7),
(2, 7),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `post_demographics`
--

CREATE TABLE `post_demographics` (
  `post_id` int(11) NOT NULL,
  `demographic_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_durations`
--

CREATE TABLE `post_durations` (
  `post_id` int(11) NOT NULL,
  `duration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_durations`
--

INSERT INTO `post_durations` (`post_id`, `duration_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_episodes`
--

CREATE TABLE `post_episodes` (
  `post_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_episodes`
--

INSERT INTO `post_episodes` (`post_id`, `episode_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_genres`
--

CREATE TABLE `post_genres` (
  `post_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_genres`
--

INSERT INTO `post_genres` (`post_id`, `genre_id`) VALUES
(1, 4),
(1, 5),
(1, 6),
(2, 4),
(2, 5),
(2, 6),
(3, 4),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `post_licensors`
--

CREATE TABLE `post_licensors` (
  `post_id` int(11) NOT NULL,
  `licensor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_licensors`
--

INSERT INTO `post_licensors` (`post_id`, `licensor_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_premiered`
--

CREATE TABLE `post_premiered` (
  `post_id` int(11) NOT NULL,
  `premiered_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_premiered`
--

INSERT INTO `post_premiered` (`post_id`, `premiered_id`) VALUES
(1, 9),
(2, 9),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `post_producers`
--

CREATE TABLE `post_producers` (
  `post_id` int(11) NOT NULL,
  `producer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_producers`
--

INSERT INTO `post_producers` (`post_id`, `producer_id`) VALUES
(1, 20),
(1, 29),
(1, 42),
(1, 43),
(1, 44),
(2, 20),
(2, 29),
(2, 42),
(2, 43),
(2, 44),
(3, 20),
(3, 29),
(3, 42),
(3, 43),
(3, 44);

-- --------------------------------------------------------

--
-- Table structure for table `post_ratings`
--

CREATE TABLE `post_ratings` (
  `post_id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_ratings`
--

INSERT INTO `post_ratings` (`post_id`, `rating_id`) VALUES
(1, 3),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `post_sources`
--

CREATE TABLE `post_sources` (
  `post_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_sources`
--

INSERT INTO `post_sources` (`post_id`, `source_id`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `post_statuses`
--

CREATE TABLE `post_statuses` (
  `post_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_statuses`
--

INSERT INTO `post_statuses` (`post_id`, `status_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_studios`
--

CREATE TABLE `post_studios` (
  `post_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_studios`
--

INSERT INTO `post_studios` (`post_id`, `studio_id`) VALUES
(1, 8),
(2, 8),
(3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `post_themes`
--

CREATE TABLE `post_themes` (
  `post_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_themes`
--

INSERT INTO `post_themes` (`post_id`, `theme_id`) VALUES
(1, 1),
(1, 47),
(2, 1),
(2, 47),
(3, 1),
(3, 47);

-- --------------------------------------------------------

--
-- Table structure for table `post_types`
--

CREATE TABLE `post_types` (
  `post_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_types`
--

INSERT INTO `post_types` (`post_id`, `type_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `premiered`
--

CREATE TABLE `premiered` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `premiered`
--

INSERT INTO `premiered` (`id`, `name`) VALUES
(1, 'Summer 2019'),
(2, 'Spring 2016'),
(3, 'Winter 2015'),
(4, 'Summer 2017'),
(5, 'Spring 2013'),
(6, 'Fall 2018'),
(7, 'Summer 2015'),
(8, 'Spring 2011'),
(9, 'Winter 2024'),
(10, 'Summer 2023'),
(11, 'Fall 2023'),
(12, 'Spring 2009'),
(13, 'Winter 2025'),
(14, 'Summer 2025');

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE `producers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`id`, `name`) VALUES
(1, 'Mainichi Broadcasting System'),
(2, 'Kodansha'),
(3, 'bilibili'),
(4, 'DMM pictures'),
(5, 'DMM Music'),
(6, 'Dentsu'),
(7, 'Movic'),
(8, 'TOHO animation'),
(9, 'Shueisha'),
(10, 'Studio Hibari'),
(11, 'Fuji TV'),
(12, 'DAX Production'),
(13, 'BS Fuji'),
(14, 'Avex Pictures'),
(15, 'Avex Pict'),
(16, 'Lantis'),
(17, 'AT-X'),
(18, 'Sony Music Communications'),
(19, 'Toranoana'),
(20, 'Crunchyroll'),
(21, 'Kadokawa Media House'),
(22, 'Kadokawa'),
(23, 'AKABEiSOFT2'),
(24, 'Geneon Universal Entertainment'),
(25, 'TBS'),
(26, 'Delfi Sound'),
(27, 'Marvelous AQL'),
(28, 'Atelier Musa'),
(29, 'Aniplex'),
(30, 'Tokyo MX'),
(31, 'Hakuhodo DY Music & Pictures'),
(32, 'Nagoya Broadcasting Network'),
(33, 'BS11'),
(34, 'ABC Animation'),
(35, 'Visual Arts'),
(36, 'ASCII Media Works'),
(37, 'Frontier Works'),
(38, 'Media Factory'),
(39, 'Kadokawa Shoten'),
(40, 'Kadokawa Pictures Japan'),
(41, 'Nitroplus'),
(42, 'Netmarble'),
(43, 'Kakao piccoma'),
(44, 'D&C Media'),
(45, 'Genco'),
(46, 'Magic Capsule'),
(47, 'Warner Bros. Japan'),
(48, 'KlockWorx'),
(49, 'Showgate'),
(50, 'Bandai Namco Games'),
(51, 'Ultra Super Pictures'),
(52, 'Bushiroad'),
(53, 'Good Smile Company'),
(54, 'Bushiroad Music'),
(55, 'HoriPro International'),
(56, 'Ace Crew Entertainment'),
(57, 'Shogakukan-Shueisha Productions'),
(58, 'Nippon Television Network'),
(59, 'Shogakukan'),
(60, 'Square Enix'),
(61, 'Techno Sound'),
(62, 'Sonilude'),
(63, 'Studio Mausu'),
(64, 'Half H.P Studio');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `name`) VALUES
(1, 'PG-13 - Teens 13 or older'),
(2, 'PG-13 - Teens 13 or older'),
(3, 'R - 17+ (violence & profanity)');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `name`) VALUES
(1, 'Manga'),
(2, 'Light novel'),
(3, 'Original'),
(4, 'Visual novel'),
(5, 'Web manga'),
(6, 'Mixed media');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Finished Airing'),
(2, 'Currently Airing');

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE `studios` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`id`, `name`) VALUES
(1, 'David Production'),
(2, 'Bones'),
(3, 'Lerche'),
(4, 'Brain\'s Base'),
(5, 'CloverWorks'),
(6, 'P.A. Works'),
(7, 'White Fox'),
(8, 'A-1 Pictures'),
(9, 'SANZIGEN'),
(10, 'Madhouse');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`) VALUES
(1, 'Adult Cast'),
(2, 'Anthropomorphic'),
(3, 'CGDCT'),
(4, 'Childcare'),
(5, 'Combat Sports'),
(6, 'Crossdressing'),
(7, 'Delinquents'),
(8, 'Detective'),
(9, 'Educational'),
(10, 'Gag Humor'),
(11, 'Gore'),
(12, 'Harem'),
(13, 'High Stakes Game'),
(14, 'Historical'),
(15, 'Idols (Female)'),
(16, 'Idols (Male)'),
(17, 'Isekai'),
(18, 'Iyashikei'),
(19, 'Love Polygon'),
(20, 'Love Status Quo'),
(21, 'Magical Sex Shift'),
(22, 'Mahou Shoujo'),
(23, 'Martial Arts'),
(24, 'Mecha'),
(25, 'Medical'),
(26, 'Military'),
(27, 'Music'),
(28, 'Mythology'),
(29, 'Organized Crime'),
(30, 'Otaku Culture'),
(31, 'Parody'),
(32, 'Performing Arts'),
(33, 'Pets'),
(34, 'Psychological'),
(35, 'Racing'),
(36, 'Reincarnation'),
(37, 'Reverse Harem'),
(38, 'Samurai'),
(39, 'School'),
(40, 'Showbiz'),
(41, 'Space'),
(42, 'Strategy Game'),
(43, 'Super Power'),
(44, 'Survival'),
(45, 'Team Sports'),
(46, 'Time Travel'),
(47, 'Urban Fantasy'),
(48, 'Vampire'),
(49, 'Video Game'),
(50, 'Villainess'),
(51, 'Visual Arts'),
(52, 'Workplace');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `aired`
--
ALTER TABLE `aired`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demographics`
--
ALTER TABLE `demographics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `download_batch`
--
ALTER TABLE `download_batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `download_links`
--
ALTER TABLE `download_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `durations`
--
ALTER TABLE `durations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `licensors`
--
ALTER TABLE `licensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `post_aired`
--
ALTER TABLE `post_aired`
  ADD PRIMARY KEY (`post_id`,`aired_id`);

--
-- Indexes for table `post_broadcasts`
--
ALTER TABLE `post_broadcasts`
  ADD PRIMARY KEY (`post_id`,`broadcast_id`);

--
-- Indexes for table `post_demographics`
--
ALTER TABLE `post_demographics`
  ADD PRIMARY KEY (`post_id`,`demographic_id`),
  ADD KEY `demographic_id` (`demographic_id`);

--
-- Indexes for table `post_durations`
--
ALTER TABLE `post_durations`
  ADD PRIMARY KEY (`post_id`,`duration_id`);

--
-- Indexes for table `post_episodes`
--
ALTER TABLE `post_episodes`
  ADD PRIMARY KEY (`post_id`,`episode_id`);

--
-- Indexes for table `post_genres`
--
ALTER TABLE `post_genres`
  ADD PRIMARY KEY (`post_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `post_licensors`
--
ALTER TABLE `post_licensors`
  ADD PRIMARY KEY (`post_id`,`licensor_id`);

--
-- Indexes for table `post_premiered`
--
ALTER TABLE `post_premiered`
  ADD PRIMARY KEY (`post_id`,`premiered_id`);

--
-- Indexes for table `post_producers`
--
ALTER TABLE `post_producers`
  ADD PRIMARY KEY (`post_id`,`producer_id`);

--
-- Indexes for table `post_ratings`
--
ALTER TABLE `post_ratings`
  ADD PRIMARY KEY (`post_id`,`rating_id`);

--
-- Indexes for table `post_sources`
--
ALTER TABLE `post_sources`
  ADD PRIMARY KEY (`post_id`,`source_id`);

--
-- Indexes for table `post_statuses`
--
ALTER TABLE `post_statuses`
  ADD PRIMARY KEY (`post_id`,`status_id`);

--
-- Indexes for table `post_studios`
--
ALTER TABLE `post_studios`
  ADD PRIMARY KEY (`post_id`,`studio_id`);

--
-- Indexes for table `post_themes`
--
ALTER TABLE `post_themes`
  ADD PRIMARY KEY (`post_id`,`theme_id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `post_types`
--
ALTER TABLE `post_types`
  ADD PRIMARY KEY (`post_id`,`type_id`);

--
-- Indexes for table `premiered`
--
ALTER TABLE `premiered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aired`
--
ALTER TABLE `aired`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `demographics`
--
ALTER TABLE `demographics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `download_batch`
--
ALTER TABLE `download_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `download_links`
--
ALTER TABLE `download_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `durations`
--
ALTER TABLE `durations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `licensors`
--
ALTER TABLE `licensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `premiered`
--
ALTER TABLE `premiered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
