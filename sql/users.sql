-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 04:06 AM
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
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_pic`, `admin`) VALUES
(10, 'wally', 'wally@gmail.com', '$2y$10$.6ve85uLh.196V2reJ.Ch.kdZcIvtsw6Ttqwvwepk1byOagz8q2/C', 'uploads/wally.png', NULL),
(11, 'admin', 'admin@gmail.com', '$2y$10$TZBkdDDpJpdR9Qmf1pZTZeRDtnWqz2MTCv2r.jsn9yhC3huik3ZLm', 'uploads/662978dde10a1_admin.png', 1),
(12, 'lion', 'lion@gmail.com', '$2y$10$lev4YvEk7XOPM3xKtoezV.H7fPGMfZoDZXKPe.CPmWHxTHiNqVwtK', 'uploads/662977fb8bec5_lion.jpg', NULL),
(13, 'fish', 'fish@gmail.com', '$2y$10$LX5m9gWR/UUZCBHaSt/Ymu09Warx60m.gUUZArLDYqo73AxIlXe8i', 'uploads/6629775b25ee8_fish.png', NULL),
(14, 'wolf', 'wolf@gmail.com', '$2y$10$rzAIJibd4AfE1ljiW9ipCOlUETnFeic75d6C2vIy389ul7EuqClAC', 'uploads/6629729b83797_wolf.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
