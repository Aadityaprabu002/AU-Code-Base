-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 05:42 PM
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
-- Database: `account database`
--

-- --------------------------------------------------------

--
-- Table structure for table `account details`
--

CREATE TABLE `account details` (
  `Firstname` varchar(50) DEFAULT NULL,
  `Lastname` varchar(25) NOT NULL,
  `Email_id` varchar(55) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password_hash` varchar(65) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `Github` varchar(255) DEFAULT NULL,
  `Twitter` varchar(255) DEFAULT NULL,
  `Bio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account details`
--

-- INSERT INTO `account details` (`Firstname`, `Lastname`, `Email_id`, `Username`, `Password_hash`, `Status`, `Github`, `Twitter`, `Bio`) VALUES
-- ('aaditya', 'prabu', 'aadityaprabu@gmail.com', 'cyber002', '$2y$08$sJ1eTtwXDY5bMGI0p3VViOdygVQg8dAepwrvsX1Neb.a0Cp6PACQy', 0, 'https://github.com/Aadityaprabu002', 'https://github.com/Aadityaprabu002', 'I am a passionate in cp and i can develop games and websites.'),
-- ('sample', 'dwadd', 'alexander@gmail.com', 'galaxydoom002', '$2y$08$QD/IYXLchFHeMnKR7c5ov.M.gMljSbyMp30Z/FLZLe5IRgLa6ECvq', 0, '', '', ''),
-- ('sai', 'sabitha', 'saibabitha@gmail.com', 'saibabitha12', '$2y$08$B7w0Qgg82JezCFKJbj.4FuzQYErZcaeJwQ1M.7JxOTDsakIwFAIne', 0, 'https://github.com/Aadityaprabu002', '', ''),
-- ('aaditya', 'prabu ', 'sample@gmail.com', 'cyber001', '$2y$08$vLI32Cb6alriOf/Def52J.ql3ZJjLJp1OlVelgOcBMppKaQM7wjMW', 0, 'https://github.com/Aadityaprabu002', 'https://github.com/Aadityaprabu002', 'i like to code, and i am really passionate about it '),
-- ('Suraj', 'Kumar', 'surajpkumar08@gmail.com', 'surajpkumar08', '$2y$08$qK0131Aup91Zsbnxy6OUjeQJjn3OBo6ZR3wVYzcVtiGTSOQr/zmKW', 0, 'https://github.com/suraj16101', 'https://github.com/suraj16101', '');

-- --------------------------------------------------------

--
-- Table structure for table `account score`
--

CREATE TABLE `account score` (
  `Username` varchar(50) NOT NULL,
  `Points` varchar(5) NOT NULL DEFAULT '0',
  `Badges` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Solved` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account score`
--

-- INSERT INTO `account score` (`Username`, `Points`, `Badges`, `Solved`) VALUES
-- ('cyber001', '200', '[\"BB\",\"LTB\"]', '[\"91\"]'),
-- ('cyber002', '0', '[]', '[]'),
-- ('galaxydoom002', '0', '[]', '[]'),
-- ('saibabitha12', '200', '[\"BB\",\"LTB\"]', '[\"91\"]'),
-- ('surajpkumar08', '200', '[\"BB\",\"LTB\"]', '[\"91\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account details`
--
ALTER TABLE `account details`
  ADD PRIMARY KEY (`Email_id`),
  ADD UNIQUE KEY `username` (`Username`);

--
-- Indexes for table `account score`
--
ALTER TABLE `account score`
  ADD PRIMARY KEY (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
