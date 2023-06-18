-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 09:39 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

CREATE DATABASE IF NOT EXISTS gym;
USE gym;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `user_form`
--
CREATE TABLE IF NOT EXISTS `user_form` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` enum('user','admin') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `age` int(20) NOT NULL,
  `height` int(20),
  `weight` int(20),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `trainer` (
  `TrainerId` int(100) NOT NULL AUTO_INCREMENT,
  `UserId` int(100) NOT NULL,
  `TrainerType` enum('low_weght','high_weight','very_high_weight'),
  PRIMARY KEY (`TrainerId`),
  FOREIGN KEY (`UserId`) REFERENCES user_form (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `trainee` (
  `TraineeId` int(100) NOT NULL AUTO_INCREMENT,
  `UserId` int(100) NOT NULL,
  `weight` int(100),
  `height` int(100),
  PRIMARY KEY (`TraineeId`),
  FOREIGN KEY (`UserId`) REFERENCES user_form (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `trains` (
  `RelId` int(100) NOT NULL AUTO_INCREMENT,
  `TrainerId` int(100) NOT NULL,
  `TraineeId` int(100) NOT NULL,
  PRIMARY KEY (`RelId`),
  FOREIGN KEY (`TrainerId`) REFERENCES trainer (`TrainerId`),
  FOREIGN KEY (`TraineeId`) REFERENCES trainee (`TraineeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--
INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Pramuditha', 'def@gmail.com', '1ae2a53ad24da29123bf211c892a387d', 'user'),
(2, 'Vidura', 'abc@gmail.com', '827f76d04c7ee686dc84310168e28f5f', 'user');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;