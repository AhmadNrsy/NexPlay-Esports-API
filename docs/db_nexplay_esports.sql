-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2026 at 08:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nexplay_esports`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `durasi_jam` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_booking` enum('Pending','Active','Completed','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `room_id`, `waktu_mulai`, `durasi_jam`, `total_harga`, `status_booking`) VALUES
(1, 1, 1, '2025-05-15 14:00:00', 5, 250000, 'Completed'),
(2, 2, 9, '2025-05-15 10:00:00', 8, 400000, 'Completed'),
(3, 3, 2, '2025-05-16 13:00:00', 3, 90000, 'Active'),
(4, 4, 7, '2025-05-16 18:00:00', 4, 300000, 'Active'),
(5, 5, 4, '2025-05-17 09:00:00', 2, 30000, 'Pending'),
(6, 6, 5, '2025-05-17 11:00:00', 4, 60000, 'Pending'),
(7, 7, 10, '2025-05-15 20:00:00', 6, 360000, 'Completed'),
(8, 8, 10, '2025-05-15 20:00:00', 6, 360000, 'Completed'),
(9, 9, 3, '2025-05-18 15:00:00', 5, 150000, 'Completed'),
(10, 10, 3, '2025-05-18 15:00:00', 5, 150000, 'Pending'),
(15, 1, 10, '2025-12-25 19:30:00', 5, 300000, 'Cancelled'),
(16, 7, 2, '2025-12-30 17:00:00', 6, 180000, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `gaming_rooms`
--

CREATE TABLE `gaming_rooms` (
  `room_id` int(11) NOT NULL,
  `nama_room` varchar(50) NOT NULL,
  `tipe_room` enum('Regular','VIP','VVIP','Streaming') NOT NULL,
  `harga_per_jam` int(11) NOT NULL,
  `status_room` enum('Available','Maintenance') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaming_rooms`
--

INSERT INTO `gaming_rooms` (`room_id`, `nama_room`, `tipe_room`, `harga_per_jam`, `status_room`) VALUES
(1, 'Radiant Arena', 'VVIP', 50000, 'Available'),
(2, 'Immortal Cave', 'VIP', 30000, 'Available'),
(3, 'Ascendant Hub', 'VIP', 30000, 'Available'),
(4, 'Diamond Room', 'Regular', 15000, 'Available'),
(5, 'Platinum Spot', 'Regular', 15000, 'Available'),
(6, 'Gold Bunker', 'Regular', 15000, 'Maintenance'),
(7, 'Streamer Pod A', 'Streaming', 75000, 'Available'),
(8, 'Streamer Pod B', 'Streaming', 75000, 'Available'),
(9, 'CS2 Major Stage', 'VVIP', 50000, 'Available'),
(10, 'Valorant Bootcamp', 'VVIP', 60000, 'Available'),
(13, 'Stream Chill', 'VIP', 30000, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `metode_bayar` enum('QRIS','Gopay','OVO','Cash') NOT NULL,
  `status_bayar` enum('Unpaid','Paid') DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `metode_bayar`, `status_bayar`) VALUES
(1, 1, 'QRIS', 'Paid'),
(2, 2, 'Gopay', 'Paid'),
(3, 3, 'OVO', 'Paid'),
(4, 4, 'QRIS', 'Paid'),
(6, 6, 'Gopay', 'Unpaid'),
(7, 7, 'QRIS', 'Paid'),
(8, 8, 'QRIS', 'Paid'),
(9, 9, 'Cash', 'Unpaid'),
(10, 10, 'Cash', 'Unpaid'),
(11, 5, 'QRIS', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `pc_setups`
--

CREATE TABLE `pc_setups` (
  `pc_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `spek_cpu` varchar(100) DEFAULT NULL,
  `spek_gpu` varchar(100) DEFAULT NULL,
  `monitor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pc_setups`
--

INSERT INTO `pc_setups` (`pc_id`, `room_id`, `spek_cpu`, `spek_gpu`, `monitor`) VALUES
(1, 1, 'AMD Ryzen 9 7950X3D', 'RTX 4090', 'Zowie XL2566K 360Hz'),
(2, 1, 'AMD Ryzen 9 7950X3D', 'RTX 4090', 'Zowie XL2566K 360Hz'),
(3, 2, 'Intel Core i9-14900K', 'RTX 4080 Super', 'Asus ROG 240Hz'),
(4, 3, 'Intel Core i7-13700K', 'RTX 4070 Ti', 'LG UltraGear 165Hz'),
(5, 4, 'AMD Ryzen 5 7600X', 'RTX 4060', 'AOC 144Hz'),
(6, 5, 'AMD Ryzen 5 7600X', 'RTX 4060', 'AOC 144Hz'),
(7, 5, 'Intel Core i9-14900K', 'RTX 3070Ti', 'Alienware 500Hz'),
(8, 8, 'AMD Ryzen 9 7950X', 'RTX 4080', 'Samsung Odyssey G7'),
(9, 9, 'AMD Ryzen 7 7800X3D', 'RTX 4080', 'Zowie XL2566K 360Hz'),
(10, 10, 'Intel Core i9-13900K', 'RTX 4090', 'Asus ROG Swift 360Hz');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tier_member` enum('Bronze','Silver','Gold','Radiant') DEFAULT 'Bronze'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `tier_member`) VALUES
(1, 'TenZ', 'tenz@sen.com', 'Radiant'),
(2, 's1mple', 's1mple@navi.gg', 'Radiant'),
(3, 'f0rest', 'f0rest@nip.gl', 'Gold'),
(4, 'Shroud', 'shroud@twitch.tv', 'Radiant'),
(5, 'Tarik', 'tarik@sentinels.com', 'Gold'),
(6, 'Boaster', 'boaster@fnatic.com', 'Silver'),
(7, 'Forsaken', 'forsaken@prx.gg', 'Radiant'),
(8, 'Jinggg', 'jinggg@prx.gg', 'Radiant'),
(9, 'm0NESY', 'm0nesy@g2.com', 'Gold'),
(10, 'NiKo', 'niko@g2.com', 'Silver');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `gaming_rooms`
--
ALTER TABLE `gaming_rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `pc_setups`
--
ALTER TABLE `pc_setups`
  ADD PRIMARY KEY (`pc_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gaming_rooms`
--
ALTER TABLE `gaming_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pc_setups`
--
ALTER TABLE `pc_setups`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `gaming_rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE;

--
-- Constraints for table `pc_setups`
--
ALTER TABLE `pc_setups`
  ADD CONSTRAINT `pc_setups_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `gaming_rooms` (`room_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
