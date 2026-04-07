-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 07:18 PM
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
-- Database: `excavating`
--

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `name`, `description`, `image`) VALUES
(1, 'Excavator', 'Standard excavator for general use. Primarily for small excavating jobs.', 'images/excavator5.jpg'),
(2, 'Excavator 2', 'Standard excavator for general use. Primarily for small excavating jobs.', 'images/excavator3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `machine_rentals`
--

CREATE TABLE `machine_rentals` (
  `id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machine_rentals`
--

INSERT INTO `machine_rentals` (`id`, `machine_id`, `start_date`, `end_date`) VALUES
(1, 1, '2026-03-31', '2026-04-13'),
(2, 2, '2026-04-01', '2026-04-07'),
(3, 2, '2026-04-09', '2026-04-19'),
(4, 2, '2026-03-12', '2026-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolved_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `email`, `name`, `phone_number`, `resolved`, `created_at`, `resolved_at`, `category`) VALUES
(1, 'Hello World! This is a test message to test the admin page viewing', 'email@example.com', 'Eli Wood', '123-456-7890', 0, '2026-03-31 14:13:51', NULL, 'General Support');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `4susers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `4susers` (`id`, `email`, `name`, `password`) VALUES
(1, 'admin@example.com', 'admin', '$2y$10$Z2KDRWdPOW6bw7Jy/USy8OUegKiAoJ67XPHnYpPLKOBKVsXmt80wK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_rentals`
--
ALTER TABLE `machine_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_machines_rentals` (`machine_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `4susers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `machine_rentals`
--
ALTER TABLE `machine_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `4susers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `machine_rentals`
--
ALTER TABLE `machine_rentals`
  ADD CONSTRAINT `fk_machines_rentals` FOREIGN KEY (`machine_id`) REFERENCES `machines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
