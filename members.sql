-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2017 at 05:42 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccu`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` varchar(100) NOT NULL,
  `name` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `title` varchar(150) NOT NULL,
  `date_of_birth` varchar(150) NOT NULL,
  `gender` char(1) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `date_joined` varchar(150) NOT NULL,
  `proposed_day_of_leaving` varchar(150) NOT NULL,
  `parent_name` varchar(300) NOT NULL,
  `occupation` varchar(150) NOT NULL,
  `parent_occupation` varchar(300) NOT NULL,
  `parent_phone_number` bigint(14) NOT NULL,
  `phone_number` bigint(14) NOT NULL,
  `email` varchar(300) NOT NULL,
  `rate_of_service` int(3) NOT NULL,
  `attendance` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `image`, `title`, `date_of_birth`, `gender`, `group_name`, `date_joined`, `proposed_day_of_leaving`, `parent_name`, `occupation`, `parent_occupation`, `parent_phone_number`, `phone_number`, `email`, `rate_of_service`, `attendance`) VALUES
('40404gyhty', 'bants', '40404gyhty.jpg', 'oga', '2017-09-20', 'm', 'chin yang', '2017-09-30', '2017-09-21', 'Mr and mrs Adewale', '', '', 9097787014, 9097787013, 'jack@wilason.com', 100, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone number` (`phone_number`),
  ADD KEY `name` (`name`),
  ADD KEY `group` (`group_name`),
  ADD KEY `email` (`email`),
  ADD KEY `parent's phone number` (`parent_phone_number`),
  ADD KEY `parent's name` (`parent_name`),
  ADD KEY `image` (`image`),
  ADD KEY `title` (`title`),
  ADD KEY `rate_of_service` (`rate_of_service`),
  ADD KEY `attendance` (`attendance`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
