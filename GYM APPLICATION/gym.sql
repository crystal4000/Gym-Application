-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 03:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8 NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `package` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_id`, `firstname`, `lastname`, `email`, `gender`, `contact_info`, `address`, `package`, `date_created`) VALUES
(16, 4567891, 'Fredrick', 'Amanda', 'fredrickamanda3@gmail.com', 'Female', '+9053478902', '3a road one, phase one, trans-ekulu', 'Zumba Dance Class', '0000-00-00 00:00:00'),
(18, 4567892, 'Jane', 'Doe', 'janedoe@gmail.com', 'Female', '+539875279', 'Suay 2, Famagusta, Cyprus', 'Zumba Dance Class', '0000-00-00 00:00:00'),
(19, 4567893, 'John', 'Doe', 'johndoe@gmail.com', 'Male', '+9053378912', 'Enugu, Nigeria', 'Zumba Dance Class', '0000-00-00 00:00:00'),
(21, 4567894, 'Adam', 'Eve', 'adameve@gmail.com', 'Male', '+5339087625', 'Lagos, Nigeria', 'Morning Yoga', '0000-00-00 00:00:00'),
(22, 4567895, 'Fish', 'Cake', 'fishcake@yahoo.com', 'Female', '+5339086527', '3a road one, phase one, trans-ekulu', 'Morning Yoga', '0000-00-00 00:00:00'),
(23, 4567896, 'Adams', 'John', 'adamjohn@gmail.com', 'Male', '+9053478902', '3a road one, phase one, trans-ekulu', 'Zumba Dance Class', '0000-00-00 00:00:00'),
(24, 4567897, 'Josh', 'Stone', 'joshstone234@gmail.com', 'Male', '+5339087625', 'Orangerie 2, Alsancak North Cyprus', 'Insanity Workout', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(30) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package` varchar(200) NOT NULL,
  `days` text NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_id`, `package`, `days`, `time_from`, `time_to`, `amount`) VALUES
(3, 4568, 'Morning Yoga', 'Mondays, Wednesdays', '10:00:00', '11:00:00', 23),
(4, 4569, 'Zumba Dance Class', 'Wednesdays, Fridays', '17:30:00', '18:45:00', 30),
(5, 4570, 'Evening Yoga', 'Wednesdays, Fridays', '17:30:00', '18:30:00', 23),
(6, 4571, 'Insanity Workout', 'Saturdays', '09:00:00', '11:00:00', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'Nefertiti', '$2y$10$92WUiqqXdYC8p.aAL2dYS.F3CUf6vKh7HmogtCggpUbpGcm1.XNOe', '2021-12-27 12:07:55'),
(5, 'Crystal333', '$2y$10$2YUsmjbf6fEURGmyccDDFucHUxXIfMdoAXdbrxxyP/SzwsoCfau8i', '2021-12-27 14:24:46'),
(6, 'Joshua', '$2y$10$kF2k5oIANqTYWwKA0kshBORFbVsaV8LMKPDOLeF5WmOAmlER49AAq', '2021-12-27 14:52:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_id` (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
