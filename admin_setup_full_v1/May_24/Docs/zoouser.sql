-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2025 at 08:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoouser`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_user_id` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `f_name` text NOT NULL,
  `s_name` text NOT NULL,
  `signup_date` int NOT NULL,
  `priv` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `audit_id` int NOT NULL,
  `username` text NOT NULL,
  `taskcode` text NOT NULL,
  `task` text NOT NULL,
  `date` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `hr_id` int NOT NULL,
  `type` text NOT NULL,
  `occupancy` int NOT NULL,
  `no_of_rooms` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `h_booking`
--

CREATE TABLE `h_booking` (
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `mode_on` int NOT NULL,
  `date` int NOT NULL,
  `nights` int NOT NULL,
  `amount_paid` float NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_transaction`
--

CREATE TABLE `loyalty_transaction` (
  `loyalty_id` int NOT NULL,
  `points` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staying_in`
--

CREATE TABLE `staying_in` (
  `stay_in` int NOT NULL,
  `booking_id` int NOT NULL,
  `hr_id` int NOT NULL,
  `no_of_guests` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `t_id` int NOT NULL,
  `type` text NOT NULL,
  `price` float NOT NULL,
  `no_of_tickets` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_booking`
--

CREATE TABLE `t_booking` (
  `t_booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `made_on` int NOT NULL,
  `date` int NOT NULL,
  `amount_paid` float NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `f_name` text NOT NULL,
  `s_name` text NOT NULL,
  `signupdate` int NOT NULL,
  `user_type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int NOT NULL,
  `type` text NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_id` int NOT NULL,
  `t_booking_id` int NOT NULL,
  `t_id` int NOT NULL,
  `no_of_tickets` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD PRIMARY KEY (`hr_id`);

--
-- Indexes for table `h_booking`
--
ALTER TABLE `h_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `loyalty_transaction`
--
ALTER TABLE `loyalty_transaction`
  ADD PRIMARY KEY (`loyalty_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `staying_in`
--
ALTER TABLE `staying_in`
  ADD PRIMARY KEY (`stay_in`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `hr_id` (`hr_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD PRIMARY KEY (`t_booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `username` (`username`(255)),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `t_booking_id` (`t_booking_id`),
  ADD KEY `t_id` (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `audit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `hr_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `h_booking`
--
ALTER TABLE `h_booking`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loyalty_transaction`
--
ALTER TABLE `loyalty_transaction`
  MODIFY `loyalty_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staying_in`
--
ALTER TABLE `staying_in`
  MODIFY `stay_in` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `t_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_booking`
--
ALTER TABLE `t_booking`
  MODIFY `t_booking_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD CONSTRAINT `hotel_rooms_ibfk_1` FOREIGN KEY (`hr_id`) REFERENCES `staying_in` (`hr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `h_booking`
--
ALTER TABLE `h_booking`
  ADD CONSTRAINT `h_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loyalty_transaction`
--
ALTER TABLE `loyalty_transaction`
  ADD CONSTRAINT `loyalty_transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staying_in`
--
ALTER TABLE `staying_in`
  ADD CONSTRAINT `staying_in_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `h_booking` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD CONSTRAINT `t_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `user_type_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`t_booking_id`) REFERENCES `t_booking` (`t_booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visits_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `tickets` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
