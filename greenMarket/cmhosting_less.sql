-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2022 at 01:05 PM
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
-- Table structure for table `orders`
--
-- Creation: May 08, 2022 at 06:09 PM
-- Last update: May 09, 2022 at 08:54 AM
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(12) NOT NULL,
  `user` varchar(14) DEFAULT NULL,
  `products` text,
  `date` text,
  `order_sum` varchar(10) DEFAULT NULL,
  `sts` int(2) DEFAULT NULL,
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user`, `products`, `date`, `order_sum`, `sts`, `details`) VALUES
(2, '679143250', '[{\"title\":\"Samarqand Gilos\",\"info\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit.\",\"photo\":\"2.png\",\"price\":5000},{\"title\":\"Ananas\",\"info\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit.\",\"photo\":\"3.png\",\"price\":3500},{\"title\":\"Apelsin\",\"info\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit.\",\"photo\":\"5.png\",\"price\":3600}]', '2022-05-09 13:54:45', '12100', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: May 08, 2022 at 04:23 AM
-- Last update: May 08, 2022 at 04:59 AM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `name` text,
  `username` text,
  `language_code` varchar(3) DEFAULT NULL,
  `sts` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `username`, `language_code`, `sts`) VALUES
(1, '679143250', 'XXXXXXX', 'Yulduzingmang0808', 'ru', 'consumer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
