-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2022 at 08:00 AM
-- Server version: 5.7.21-20-beget-5.7.21-20-1-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmhosting_less`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloud`
--
-- Creation: Apr 24, 2022 at 06:33 PM
--

DROP TABLE IF EXISTS `cloud`;
CREATE TABLE `cloud` (
  `id` int(12) NOT NULL,
  `file_id` varchar(200) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud`
--

INSERT INTO `cloud` (`id`, `file_id`, `method`, `type`) VALUES
(1, 'AgACAgUAAxkBAAIEomJlnzGMq6IM6M0AAdTO1CymSikcQgACCrAxG_iFMVd0ImLN_3uTlQEAAwIAA3kAAyQE', 'sendPhoto', 'photo'),
(2, 'CQACAgUAAxkBAAIEqmJln80heDmkyV_Wct1D8hCBv8EJAALLBQACcpMpV-VEAwrpOPjsJAQ', 'sendAudio', 'audio'),
(3, 'BQACAgUAAxkBAAIErGJloFO45-hN8H6ZHZpxkHWMDanfAALMBQACcpMpVzWNS9nCdyrFJAQ', 'sendDocument', 'document'),
(4, 'BQACAgUAAxkBAAIErmJloGOF8x7lEL0atlt67LvWMqUfAALNBQACcpMpV6-iGFDhLTDuJAQ', 'sendDocument', 'document'),
(5, 'BAACAgUAAxkBAAIEsGJloJnabnzB5Ut-G1Q21QABIkL_4AACzgUAAnKTKVewsho5MiydkiQE', 'sendVideo', 'video'),
(6, 'BQACAgUAAxkBAAIEsmJloOxIYS8qc1vrQYyRqf6vn_9SAALPBQACcpMpV7tpDWUGO58sJAQ', 'sendDocument', 'document'),
(7, 'BAACAgUAAxkBAAIEu2Jlor2laWZZyruAU91MLTjharN5AALQBQACcpMpV9uwU-9wckhJJAQ', 'sendVideo', 'video'),
(8, 'BQACAgUAAxkBAAIHimJoZjvXbbG7T65GsV_m1ZyAGbIPAAK1BQACkx1AVwnc5CiUX0S3JAQ', 'sendDocument', 'document'),
(9, 'AgACAgUAAxkBAAIHkGJoZyPGcFyE5cu8YjwQrUFXKHdVAAIEsDEbkx1AV4VZZu-tSjw7AQADAgADeQADJAQ', 'sendPhoto', 'photo'),
(10, 'BQACAgUAAxkBAAIHkmJoZ9BS-7a1BXTAxlDqtgR7HZGCAAK2BQACkx1AV-07IuC6Lk4nJAQ', 'sendDocument', 'document'),
(11, 'AgACAgUAAxkBAAIHl2JobSdCB0-VvRoQhjXIuHJKbR0cAAIGsDEbkx1AV-p9-Xw4gbSTAQADAgADeQADJAQ', 'sendPhoto', 'photo'),
(12, 'CQACAgUAAxkBAAIHqmJobY6uAbJHNCtAzoGV06T8G7nmAAK3BQACkx1AV4UaBmZ-VfMcJAQ', 'sendAudio', 'audio');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--
-- Creation: Apr 26, 2022 at 10:57 AM
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(12) NOT NULL,
  `userid` varchar(14) DEFAULT NULL,
  `value` int(5) DEFAULT NULL,
  `emoji` text,
  `sts` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `userid`, `value`, `emoji`, `sts`) VALUES
(1, '679143250', 6, '\"\\ud83c\\udfb2\"', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--
-- Creation: Apr 25, 2022 at 05:31 AM
--

DROP TABLE IF EXISTS `invites`;
CREATE TABLE `invites` (
  `id` int(12) NOT NULL,
  `user` int(14) DEFAULT NULL,
  `score` int(10) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `user`, `score`, `name`) VALUES
(1, 713516566, 11, 'BIG BOSS'),
(2, 679143250, 6, 'XXXXXXX :*)'),
(3, 713516566, 3, 'Stalker'),
(4, 679143250, 5, 'Baby'),
(5, 713516566, 15, 'John'),
(6, 679143250, 14, 'Smal girl'),
(7, 713516566, 50, 'Stalker n1'),
(8, 679143250, 140, '? Your sun'),
(9, 713516566, 23, 'Jurabek'),
(10, 713516566, 50, 'Killer zero'),
(11, 679143250, 25, 'Hobbit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cloud`
--
ALTER TABLE `cloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cloud`
--
ALTER TABLE `cloud`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
