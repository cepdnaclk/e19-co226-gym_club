-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 04:54 PM
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
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise_log`
--

CREATE TABLE `exercise_log` (
  `logId` int(50) NOT NULL,
  `SesId` int(100) NOT NULL,
  `ex_type` varchar(250) NOT NULL,
  `sets` int(15) NOT NULL,
  `reps` int(10) NOT NULL,
  `weight` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_log`
--

INSERT INTO `exercise_log` (`logId`, `SesId`, `ex_type`, `sets`, `reps`, `weight`) VALUES
(1, 1, 'Chest Press', 3, 10, 30),
(2, 3, 'Shoulder press', 4, 8, 40),
(3, 1, 'Shoulder press', 3, 10, 33),
(4, 1, 'Shoulder press', 3, 10, 33),
(5, 1, 'Shoulder press', 3, 10, 33),
(6, 2, ';bj;', 33, 3, 65),
(7, 2, '651', 62, 21, 51),
(8, 2, 'cac', 6, 6, 6),
(9, 2, 'cac', 6, 6, 6),
(10, 2, 'cac', 6, 6, 6),
(11, 2, 'cac', 6, 6, 6),
(12, 2, 'cac', 6, 6, 6),
(13, 2, 'cac', 6, 6, 6),
(14, 2, 'cac', 6, 6, 6),
(15, 2, 'cac', 6, 6, 6),
(16, 3, 'Chest Press', 3, 10, 33),
(17, 3, 'Shoulder press', 4, 8, 30),
(18, 4, 'blaaaaaaaaaaa', 3, 10, 99),
(19, 5, 'blaaaaaaaaaaa', 3, 10, 99),
(20, 1, 'barbell Row', 3, 10, 33),
(21, 1, 'Dumbell row', 3, 8, 30),
(22, 1, 'Shoulder press', 3, 10, 30),
(23, 1, 'overhead press', 4, 8, 30),
(24, 2, 'Shoulder press', 3, 10, 30),
(25, 7, 'Shoulder press', 3, 10, 30),
(26, 7, 'Chest Press', 4, 8, 33);

-- --------------------------------------------------------

--
-- Table structure for table `fitness_goal`
--

CREATE TABLE `fitness_goal` (
  `goal_id` int(250) NOT NULL,
  `goal_type` varchar(250) NOT NULL,
  `target_weight` varchar(250) NOT NULL,
  `target_bodyfat` int(250) NOT NULL,
  `target_calories` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fitness_goal`
--

INSERT INTO `fitness_goal` (`goal_id`, `goal_type`, `target_weight`, `target_bodyfat`, `target_calories`) VALUES
(1, 'Muscle Gain', '82', 12, 3000),
(2, 'Weight Loss', '68', 18, 1800),
(3, 'Cardiovascular Health', 'Maintain', 15, 2500),
(4, 'Strength Training', '91', 10, 2800),
(5, 'Flexibility and Mobility', 'Maintain', 20, 2200),
(6, 'Overall Wellness', 'Maintain', 16, 2400);

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `id` int(250) NOT NULL,
  `UId` int(250) NOT NULL,
  `goal_id` int(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `UId`, `goal_id`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 4, 1),
(4, 7, 2),
(5, 14, 1),
(6, 15, 4),
(7, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `num` int(250) NOT NULL,
  `trainee_id` int(250) NOT NULL,
  `trainer_id` int(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`num`, `trainee_id`, `trainer_id`) VALUES
(3, 14, 10),
(4, 15, 7),
(5, 1, NULL),
(6, 2, 7),
(7, 4, NULL),
(8, 16, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` enum('user','admin') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `age` int(20) NOT NULL,
  `height` int(20) DEFAULT NULL,
  `weight` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `gender`, `age`, `height`, `weight`) VALUES
(1, 'Pramuditha', 'def@gmail.com', '1ae2a53ad24da29123bf211c892a387d', 'user', 'male', 23, 3, 59),
(2, 'Vidura', 'abc@gmail.com', '827f76d04c7ee686dc84310168e28f5f', 'user', 'male', 30, 3, 30),
(4, 'Dineth', 'test@gmail.com', 'fac3b6c91a03f0896f369e471b1976e3', 'user', 'male', 23, 3, 50),
(7, 'Tharun', 't@gmail.com', 'b28ce62dad5ece65cb94be578a323c33', 'admin', 'male', 0, NULL, NULL),
(8, 'Chamath', 'c@gmail.com', 'ae08843973a451208333c073ed8dfc2e', 'user', 'male', 40, 2, 80),
(10, 'Pasindu', 'p@gmail.com', '46bf36a7193438f81fccc9c4bcc8343e', 'admin', 'male', 25, 2, 65),
(14, 'Kavindu', 'k@gmail.com', '1d430d0a0757ca4b16a57dbc5c436353', 'user', 'male', 22, 5, 40),
(15, 'Vihan', 'v@gmail.com', 'bb2495c2b8e05a7b27d14bdf986ec113', 'user', 'male', 24, 2, 60),
(16, 'Sahan', 's@gmail.com', '7812e8b74f6837fba66f86fe86688a2b', 'user', 'male', 30, 2, 69);

-- --------------------------------------------------------

--
-- Table structure for table `workout_session`
--

CREATE TABLE `workout_session` (
  `SessionId` int(10) NOT NULL,
  `UId` int(10) NOT NULL,
  `BurnedCalories` int(250) NOT NULL,
  `Date` date NOT NULL,
  `Duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_session`
--

INSERT INTO `workout_session` (`SessionId`, `UId`, `BurnedCalories`, `Date`, `Duration`) VALUES
(1, 2, 250, '2023-08-23', '00:00:15'),
(2, 2, 350, '2023-08-01', '00:00:45'),
(3, 2, 225, '2023-07-31', '00:00:30'),
(4, 4, 1000, '2023-08-02', '00:00:45'),
(5, 4, 250, '2023-08-01', '00:00:15'),
(6, 2, 2000, '2023-08-05', '00:01:05'),
(7, 16, 2000, '2023-08-06', '00:00:30'),
(8, 16, 2500, '2023-08-05', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise_log`
--
ALTER TABLE `exercise_log`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `Session_id_foreign` (`SesId`);

--
-- Indexes for table `fitness_goal`
--
ALTER TABLE `fitness_goal`
  ADD PRIMARY KEY (`goal_id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UId_foreign` (`UId`),
  ADD KEY `Goal_id_foreign` (`goal_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`num`),
  ADD KEY `trainee_id_foreign` (`trainee_id`),
  ADD KEY `trainer_id_foreign` (`trainer_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_session`
--
ALTER TABLE `workout_session`
  ADD PRIMARY KEY (`SessionId`),
  ADD KEY `User_id_foreign` (`UId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise_log`
--
ALTER TABLE `exercise_log`
  MODIFY `logId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `fitness_goal`
--
ALTER TABLE `fitness_goal`
  MODIFY `goal_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `num` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `workout_session`
--
ALTER TABLE `workout_session`
  MODIFY `SessionId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercise_log`
--
ALTER TABLE `exercise_log`
  ADD CONSTRAINT `Session_id_foreign` FOREIGN KEY (`SesId`) REFERENCES `workout_session` (`SessionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `Goal_id_foreign` FOREIGN KEY (`goal_id`) REFERENCES `fitness_goal` (`goal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UId_foreign` FOREIGN KEY (`UId`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainer`
--
ALTER TABLE `trainer`
  ADD CONSTRAINT `trainee_id_foreign` FOREIGN KEY (`trainee_id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_session`
--
ALTER TABLE `workout_session`
  ADD CONSTRAINT `User_id_foreign` FOREIGN KEY (`UId`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
