-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 10:44 AM
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
-- Database: `sign`
--

-- --------------------------------------------------------

--
-- Table structure for table `adhaar`
--

CREATE TABLE `adhaar` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `aadhar_number` varchar(12) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adhaar`
--

INSERT INTO `adhaar` (`id`, `name`, `aadhar_number`, `dob`) VALUES
(1, 'Ajay', '585854545656', '2006-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_details`
--

CREATE TABLE `candidate_details` (
  `id` int(11) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `party_symbol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_details`
--

INSERT INTO `candidate_details` (`id`, `party_name`, `candidate_name`, `state`, `district`, `party_symbol`) VALUES
(1, 'Bharatiya Janata Party (BJP)', 'Narendra Modi', 'Gujarat', '', 'party-symbols/bjp-logo-png.png'),
(2, 'Indian National Congress', 'Rahul Rajiv Gandhi', 'Gujarat', '', 'party-symbols/Indian_National_Congress_hand_logo.png'),
(3, 'Apna Dal', 'Gagan Prakash Yadav', 'Gujarat', '', 'party-symbols/apna_dal.png');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_result`
--

CREATE TABLE `candidate_result` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `party_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_result`
--

INSERT INTO `candidate_result` (`id`, `candidate_name`, `party_name`) VALUES
(1, 'Rahul Rajiv Gandhi', 'Indian National Congress'),
(2, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(3, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(4, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(5, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(6, 'Arvind Kejriwal', 'Aam Aadmi Party (AAP)'),
(7, 'Rahul Rajiv Gandhi', 'Indian National Congress'),
(8, 'Rahul Rajiv Gandhi', 'Indian National Congress'),
(9, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(10, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(11, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(12, 'Narendra Modi', 'Bharatiya Janata Party (BJP)'),
(13, 'Narendra Modi', 'Bharatiya Janata Party (BJP)');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `email`, `password`, `usertype`) VALUES
(1, 'admin@gmail.com', 'Admin@123', 'Admin'),
(2, 'ajay@gmail.com', 'Ajay@123', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adhaar`
--
ALTER TABLE `adhaar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_details`
--
ALTER TABLE `candidate_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_result`
--
ALTER TABLE `candidate_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adhaar`
--
ALTER TABLE `adhaar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidate_details`
--
ALTER TABLE `candidate_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `candidate_result`
--
ALTER TABLE `candidate_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
