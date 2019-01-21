-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2019 at 03:17 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `81265tripsdb`
--
CREATE DATABASE IF NOT EXISTS `81265tripsdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `81265tripsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `Trips`
--

CREATE TABLE `Trips` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Trips`
--

INSERT INTO `Trips` (`id`, `ownerId`, `name`) VALUES
(65, 32, 'Вкъщи - ФМИ'),
(66, 32, 'Защита на проект по Съвременни Комуникации ');

-- --------------------------------------------------------

--
-- Table structure for table `TripStops`
--

CREATE TABLE `TripStops` (
  `id` int(11) NOT NULL,
  `tripId` int(11) NOT NULL,
  `stopIndex` smallint(6) NOT NULL,
  `placeName` varchar(64) NOT NULL,
  `plannedTime` datetime NOT NULL,
  `notes` varchar(512) NOT NULL,
  `imageFileName` varchar(64) NOT NULL DEFAULT 'default.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TripStops`
--

INSERT INTO `TripStops` (`id`, `tripId`, `stopIndex`, `placeName`, `plannedTime`, `notes`, `imageFileName`) VALUES
(42, 65, 1, 'Вкъщи', '2019-01-23 08:00:00', 'Трудно ще е ставането, но няма как.', 'stop42.jpeg'),
(43, 65, 2, 'ФМИ', '2019-01-23 09:00:00', 'Дано защитата на проекта мине успешно!', 'stop43.jpeg'),
(44, 66, 1, 'Вкъщи', '2019-01-21 12:00:00', 'Винаги се тръгва от вкъщи', 'default.jpeg'),
(45, 66, 2, '2 блок на СУ', '2019-01-21 14:00:00', 'Този блок 2 е много далече..', 'stop45.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`) VALUES
(32, 'dobri', '$2y$10$a7pUk.yqY2sj.O3jIbuzPujbggyNyFoYa1dy8TD9BkqkGe0/FoDvm'),
(33, 'web', '$2y$10$haqnOedjnFV7nRTF05.w0.8Ot1aL.uj2EXpamHY9Nid82ORGwBaPq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Trips`
--
ALTER TABLE `Trips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ownerId_tripName_unique` (`ownerId`,`name`);

--
-- Indexes for table `TripStops`
--
ALTER TABLE `TripStops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tripId_stopIndex_unique` (`tripId`,`stopIndex`) USING BTREE;

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Trips`
--
ALTER TABLE `Trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `TripStops`
--
ALTER TABLE `TripStops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Trips`
--
ALTER TABLE `Trips`
  ADD CONSTRAINT `ownerId_fk` FOREIGN KEY (`ownerId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TripStops`
--
ALTER TABLE `TripStops`
  ADD CONSTRAINT `tripId_fk` FOREIGN KEY (`tripId`) REFERENCES `Trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
