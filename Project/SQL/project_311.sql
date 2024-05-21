-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 04:38 PM
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
-- Database: `project 311`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `room_no` int(3) NOT NULL,
  `booking_no` int(11) DEFAULT NULL,
  `b_from` date DEFAULT NULL,
  `b_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bill` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_no` int(3) NOT NULL,
  `category` varchar(50) NOT NULL,
  `beds` varchar(50) NOT NULL,
  `pricing` decimal(6,2) NOT NULL,
  `available` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_no`, `category`, `beds`, `pricing`, `available`) VALUES
(101, 'Single Room', 'King Bed', 150.00, b'1'),
(102, 'Single Room', 'King Bed', 150.00, b'1'),
(103, 'Single Room', 'Queen Bed', 150.00, b'1'),
(104, 'Single Room', 'Queen Bed', 150.00, b'1'),
(105, 'Single Room', 'Queen Bed', 150.00, b'1'),
(201, 'Single Room', 'King Bed', 150.00, b'1'),
(202, 'Single Room', 'King Bed', 150.00, b'1'),
(203, 'Single Room', 'King Bed', 150.00, b'1'),
(204, 'Single Room', 'Queen Bed', 150.00, b'1'),
(205, 'Single Room', 'Queen Bed', 150.00, b'1'),
(301, 'Suite ', 'King Bed', 215.00, b'1'),
(302, 'Suite ', 'Queen Bed', 215.00, b'1'),
(303, 'Suite ', 'Queen Bed', 215.00, b'1'),
(304, 'Suite ', 'King Bed', 215.00, b'1'),
(305, 'Suite ', 'Queen Bed', 215.00, b'1'),
(401, 'Suite', 'King Bed', 215.00, b'1'),
(402, 'Suite', 'Queen Bed', 215.00, b'1'),
(403, 'Suite', 'Queen Bed', 215.00, b'1'),
(404, 'Suite', 'King Bed', 215.00, b'1'),
(405, 'Suite', 'King Bed', 215.00, b'1'),
(501, 'Suite', 'Queen Bed', 215.00, b'1'),
(502, 'Suite', 'King Brd', 215.00, b'1'),
(503, 'Suite', 'Queen Bed', 215.00, b'1'),
(504, 'Suite', 'King Bed', 215.00, b'1'),
(505, 'Suite', 'Queen Bed', 215.00, b'1'),
(601, 'VIP', 'King Bed', 450.00, b'1'),
(602, 'VIP', 'King Bed', 450.00, b'1'),
(603, 'VIP', 'Queen Bed', 450.00, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` char(40) NOT NULL,
  `isAdmin` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `pass`, `isAdmin`) VALUES
(1001, 'zaid@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', b'1'),
(1002, 'jarif@email.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', b'1'),
(1003, 'abrar@email.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', b'1'),
(2001, 'mirza@email.com', '81fe8bfe87576c3ecb22426f8e57847382917acf', b'0'),
(2002, 'maisha@email.com', 'b58e6693e0ba007ce2f9e152c4cf19dd5cdbbad6', b'0'),
(2003, 'nafew@email.com', 'c5320410f64ab07e0ac5ad60bc13b07c61291b13', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`room_no`),
  ADD KEY `booking_no` (`booking_no`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_no`),
  ADD KEY `fk_cust_id` (`customer_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`booking_no`) REFERENCES `booking` (`booking_no`) ON DELETE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_cust_id` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
