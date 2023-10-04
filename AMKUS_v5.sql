-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 08:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinical_presentation`
--

DROP TABLE IF EXISTS `clinical_presentation`;
CREATE TABLE IF NOT EXISTS `clinical_presentation` (
  `prescription_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `clinical_presentation` text NOT NULL,
  KEY `prescription_id` (`prescription_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

DROP TABLE IF EXISTS `diagnosis`;
CREATE TABLE IF NOT EXISTS `diagnosis` (
  `prescription_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  KEY `prescription_id` (`prescription_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `current` varchar(255) NOT NULL,
  UNIQUE KEY `doc_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `investigation`
--

DROP TABLE IF EXISTS `investigation`;
CREATE TABLE IF NOT EXISTS `investigation` (
  `prescription_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `investigation` text NOT NULL,
  KEY `prescription_id` (`prescription_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(5) NOT NULL,
  `phoneNumber` int(12) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(7) NOT NULL,
  `refferBy` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `discount` double NOT NULL,
  `net` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `receivedBy` varchar(255) NOT NULL,
  UNIQUE KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `invoice_id` int(15) NOT NULL,
  `serviceType` text NOT NULL,
  `fees` int(15) NOT NULL,
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `prescription_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  KEY `prescription_id` (`prescription_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

DROP TABLE IF EXISTS `patient_details`;
CREATE TABLE IF NOT EXISTS `patient_details` (
  `patienId` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `age` int(4) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `maritialStatus` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `pinCode` varchar(7) NOT NULL,
  `address` varchar(255) NOT NULL,
  `emName` varchar(255) NOT NULL,
  `emRelation` varchar(255) NOT NULL,
  `emNumber` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  UNIQUE KEY `PID` (`patienId`),
  KEY `unauthorized query` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `prescription_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `attending_doctor` varchar(255) NOT NULL,
  `doc_id` int(6) UNSIGNED NOT NULL,
  `visit_date` date NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `pulse` varchar(7) NOT NULL,
  `spo2` varchar(7) NOT NULL,
  `clinical_presentation` text NOT NULL,
  `investigation` text NOT NULL,
  `refer_to` varchar(255) NOT NULL,
  `advice` text NOT NULL,
  `follow_upD` varchar(255) DEFAULT NULL,
  `follow_upW` varchar(7) NOT NULL,
  `status` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `prescribed_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` varchar(8) NOT NULL,
  `amtStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prescription_id` (`prescription_id`),
  KEY `patient_id` (`patient_id`),
  KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `serviceType` text NOT NULL,
  `category` varchar(15) NOT NULL,
  `fees` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullName` varchar(30) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `role` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clinical_presentation`
--
ALTER TABLE `clinical_presentation`
  ADD CONSTRAINT `clinical_presentation_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`),
  ADD CONSTRAINT `clinical_presentation_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `prescription` (`patient_id`);

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`),
  ADD CONSTRAINT `diagnosis_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `prescription` (`patient_id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `investigation`
--
ALTER TABLE `investigation`
  ADD CONSTRAINT `investigation_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`),
  ADD CONSTRAINT `investigation_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `prescription` (`patient_id`);

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`),
  ADD CONSTRAINT `medicine_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `prescription` (`patient_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient_details` (`patienId`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
