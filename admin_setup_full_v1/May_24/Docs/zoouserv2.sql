-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2025 at 04:38 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_user_id`, `username`, `password`, `email`, `f_name`, `s_name`, `signup_date`, `priv`) VALUES
(17, 'adam.watkin', '$2y$10$tO44BQWSMIMScPKs9KP2suhwIswOX6pvdiL3cCPzYY.DLJtEWBa9a', 'adam.watkin@rzl.com', 'Adam', 'Watkin', 1740728872, 'SUPER'),
(18, 'james.barowik', '$2y$10$NgAo4JsXZWfWJdxFrrDbBOuh6.il.Co.sYqiSHVFgdLT/IL2QLK/q', 'james.barowik@rzl.com', 'James', 'B', 1740728909, 'CREATOR');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`audit_id`, `username`, `taskcode`, `task`, `date`) VALUES
(36, 'adam.watkin', 'SUPERREG', 'SUPER USER REGISTERED', 1740728872),
(37, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740728879),
(38, 'james.barowik', 'CREATORREG', 'james.barowik registered as a CREATOR', 1740728909),
(39, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740741830),
(40, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740741904),
(41, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740741992),
(42, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740742042),
(43, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740746272),
(44, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740747228),
(45, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740747545),
(46, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740749174),
(47, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740749250),
(48, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740749339),
(49, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740749424),
(50, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740749528),
(51, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740750614),
(52, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740750674),
(53, 'adam.watkin', 'SUPERlogin', 'adam.watkin SUPER login', 1740750828),
(54, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740753089),
(55, 'james.barowik', 'CREATORlogin', 'james.barowik CREATOR login', 1740753141),
(56, 'james.barowik', 'TICKETADD', 'james.barowik added new ticket type of adult', 1740753175),
(57, 'james.barowik', 'HOTELROOMADD', 'james.barowik added new hotel room type of Single', 1740753658),
(58, 'james.barowik', 'USERADD', 'james.barowik added new user type of standard', 1740754834),
(59, 'adamski', 'USERREG', 'adamski registered as a new user', 1741004156),
(60, 'adamski', 'adamskilogin', 'adamski 3 login', 1741004973),
(61, 'adamski', 'adamskilogin', 'adamski 3 login', 1741177158),
(62, 'adamski', 'adamskilogin', 'adamski 3 login', 1741188264),
(63, 'adamski', 'adamskilogin', 'adamski 3 login', 1741188909);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotel_rooms`
--

INSERT INTO `hotel_rooms` (`hr_id`, `type`, `occupancy`, `no_of_rooms`, `price`) VALUES
(4, 'Double', 4, 23, 110),
(5, 'Family', 5, 34, 56),
(6, 'Single', 1, 10, 45);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_transaction`
--

CREATE TABLE `loyalty_transaction` (
  `loyalty_id` int NOT NULL,
  `points` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staying_in`
--

CREATE TABLE `staying_in` (
  `stay_in` int NOT NULL,
  `booking_id` int NOT NULL,
  `hr_id` int NOT NULL,
  `no_of_guests` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `t_id` int NOT NULL,
  `type` text NOT NULL,
  `price` float NOT NULL,
  `no_of_tickets` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`t_id`, `type`, `price`, `no_of_tickets`) VALUES
(1, 'child', 24, 200),
(2, 'adult', 36, 400);

-- --------------------------------------------------------

--
-- Table structure for table `t_booking`
--

CREATE TABLE `t_booking` (
  `t_booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `t_id` int NOT NULL,
  `made_on` int NOT NULL,
  `date` date NOT NULL,
  `num_bought` int NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_booking`
--

INSERT INTO `t_booking` (`t_booking_id`, `user_id`, `t_id`, `made_on`, `date`, `num_bought`, `total_price`) VALUES
(2, 1, 2, 1741187248, '2025-03-21', 3, 56.6);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `username`, `password`, `f_name`, `s_name`, `signupdate`, `user_type_id`) VALUES
(1, 'adamski', '$2y$10$xPKA7zMJTIPd2kyg86H2PO3Hd0ingdD7WjY7OttY7A5GY8zo73HzC', 'Adam', 'Watkin', 1741004156, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int NOT NULL,
  `type` text NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `type`, `discount`) VALUES
(2, 'Business', 0.8),
(3, 'standard', 1);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `t_id` (`t_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `audit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `hr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `t_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_booking`
--
ALTER TABLE `t_booking`
  MODIFY `t_booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `staying_in_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `h_booking` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staying_in_ibfk_2` FOREIGN KEY (`hr_id`) REFERENCES `hotel_rooms` (`hr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD CONSTRAINT `t_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_booking_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `tickets` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
