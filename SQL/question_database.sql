-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 05:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `question database`
--

-- --------------------------------------------------------

--
-- Table structure for table `question properties`
--

CREATE TABLE `question properties` (
  `Qid` int(11) NOT NULL,
  `Qname` varchar(100) NOT NULL,
  `Qlevel` enum('EASY','MEDIUM','HARD') DEFAULT NULL,
  `Qaward` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Qaward`)),
  `Qdescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Qtestcase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Qpicture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question properties`
--

INSERT INTO `question properties` (`Qid`, `Qname`, `Qlevel`, `Qaward`, `Qdescription`, `Qtestcase`, `Qpicture`) VALUES
(91, 'first question', 'EASY', '[\"BB\",\"LTB\"]', 'C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Questions/first question/descriptions/', 'C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Questions/first question/testcases/', ''),
(92, 'second question', 'EASY', '[\"BB\"]', 'C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Questions/second question/descriptions/', 'C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Questions/second question/testcases/', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question properties`
--
ALTER TABLE `question properties`
  ADD PRIMARY KEY (`Qid`),
  ADD UNIQUE KEY `Qname` (`Qname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question properties`
--
ALTER TABLE `question properties`
  MODIFY `Qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
