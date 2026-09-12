-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2026 at 10:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quarter`
--

-- --------------------------------------------------------

--
-- Table structure for table `act_log`
--

CREATE TABLE `act_log` (
  `id` int(11) NOT NULL,
  `user` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `user_type` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `file_name` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `place_title` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `action` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `action_title` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `tbl` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `key_name` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `key_type` int(11) NOT NULL,
  `key_var` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `rec_title` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `act_date` date NOT NULL,
  `mili` varchar(300) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `username` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `pass` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`username`, `pass`, `name`, `family`, `tel`, `email`, `active`) VALUES
('admin', '44332211', 'admin', 'admin', '123456789', 'email@web.com', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `mynote`
--

CREATE TABLE `mynote` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `txt` text COLLATE utf8_persian_ci DEFAULT NULL,
  `tarikh` date NOT NULL,
  `ordnum` int(11) NOT NULL DEFAULT 0,
  `vaz` int(11) NOT NULL DEFAULT 0,
  `fpage` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `mynote`
--

INSERT INTO `mynote` (`id`, `title`, `txt`, `tarikh`, `ordnum`, `vaz`, `fpage`) VALUES
(2, 'یادآوری', 'متن یادآوری', '2026-03-17', 99, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `rep_task` text COLLATE utf8_persian_ci DEFAULT NULL,
  `count_task` int(11) DEFAULT 0,
  `rep_peygiri` text COLLATE utf8_persian_ci DEFAULT NULL,
  `count_peygiri` int(11) DEFAULT 0,
  `rep_faktor` text COLLATE utf8_persian_ci DEFAULT NULL,
  `count_faktor` int(11) DEFAULT 0,
  `rep_more` text COLLATE utf8_persian_ci DEFAULT NULL,
  `post_date` date NOT NULL,
  `vaz_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_ip`
--

CREATE TABLE `users_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `country` int(11) DEFAULT 0,
  `tarikh` date NOT NULL,
  `pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `act_log`
--
ALTER TABLE `act_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `mynote`
--
ALTER TABLE `mynote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_ip`
--
ALTER TABLE `users_ip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `act_log`
--
ALTER TABLE `act_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mynote`
--
ALTER TABLE `mynote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_ip`
--
ALTER TABLE `users_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
