-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2023 at 07:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presentseek`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `SName` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `RollNO` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`SName`, `class_name`, `date`, `status`, `RollNO`) VALUES
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-28', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-01-28', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'A', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_Data_Struc', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-01-29', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-01-29', 'A', 2100321540126),
('Prakhar Pandey', 'CSE_DS_B_DSTL', '2023-01-29', 'A', 2100321540118),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-01-29', 'P', 2100321540126),
('Priyanshu Sharma', 'cse_ds_b_coa', '2023-01-30', 'P', 2100321540124),
('Raj Tripathi', 'cse_ds_b_coa', '2023-01-30', 'P', 2100321540126),
('Manu Varshney', 'cse_ds_b_coa', '2023-02-04', 'P', 2100321540097),
('Prakhar Pandey', 'cse_ds_b_coa', '2023-02-04', 'P', 2100321540118),
('Priyanshu Sharma', 'cse_ds_b_coa', '2023-02-04', 'P', 2100321540124),
('Rachit Tomar', 'cse_ds_b_coa', '2023-02-04', 'P', 2100321540125),
('Raj Tripathi', 'cse_ds_b_coa', '2023-02-04', 'P', 2100321540126),
('Manu Varshney', 'CSE_DS_B_DSTL', '2023-02-04', 'A', 2100321540097),
('Prakhar Pandey', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540118),
('Priyanshu Sharma', 'CSE_DS_B_DSTL', '2023-02-04', 'A', 2100321540124),
('Rachit Tomar', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540125),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540126),
('Manu Varshney', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540097),
('Manu Varshney', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540097),
('Prakhar Pandey', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540118),
('Prakhar Pandey', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540118),
('Priyanshu Sharma', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540124),
('Priyanshu Sharma', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540124),
('Rachit Tomar', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540125),
('Rachit Tomar', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540125),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540126),
('Raj Tripathi', 'CSE_DS_B_DSTL', '2023-02-04', 'P', 2100321540126);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch`) VALUES
('CSEDS'),
('IT'),
('CSE_AIML'),
('EN'),
('ECE'),
('CS'),
('Mechanical'),
('CSE');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_name` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `semester` int(1) NOT NULL,
  `term_start` date NOT NULL,
  `term_end` date NOT NULL,
  `num_lectures` bigint(255) NOT NULL,
  `section` varchar(10) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `user` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_name`, `course`, `branch`, `semester`, `term_start`, `term_end`, `num_lectures`, `section`, `subject`, `user`) VALUES
('CSE_DS_B_Data_Struc', 'B.Tech', 'CSEDS', 3, '2023-06-30', '2023-06-30', 4, 'B', 'DS', 1234),
('CSE_DS_B_DSTL', 'B.Tech', 'CSEDS', 3, '2023-01-02', '2023-06-30', 5, 'B', 'DSTL', 1234),
('cse_ds_b_coa', 'B.Tech', 'CSEDS', 3, '2023-06-30', '2023-06-30', 5, 'B', 'COA', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `cse_ds_b_coa`
--

CREATE TABLE `cse_ds_b_coa` (
  `RollNO` bigint(255) DEFAULT NULL,
  `Names` varchar(300) DEFAULT NULL,
  `Sem` int(11) DEFAULT NULL,
  `Present` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cse_ds_b_coa`
--

INSERT INTO `cse_ds_b_coa` (`RollNO`, `Names`, `Sem`, `Present`, `Total`) VALUES
(2100321540124, 'Priyanshu Sharma', 3, 2, 2),
(2100321540097, 'Manu Varshney', 3, 2, 2),
(2100321540126, 'Raj Tripathi', 3, 2, 2),
(2100321540118, 'Prakhar Pandey', 3, 1, 2),
(2100321540125, 'Rachit Tomar', 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cse_ds_b_data_struc`
--

CREATE TABLE `cse_ds_b_data_struc` (
  `RollNO` bigint(255) DEFAULT NULL,
  `Names` varchar(300) DEFAULT NULL,
  `Sem` int(11) DEFAULT NULL,
  `Present` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cse_ds_b_data_struc`
--

INSERT INTO `cse_ds_b_data_struc` (`RollNO`, `Names`, `Sem`, `Present`, `Total`) VALUES
(2100321540124, 'Priyanshu Sharma', 3, 19, 20),
(2100321540126, 'Raj Tripathi', 3, 19, 20),
(2100321540118, 'Prakhar Pandey', 3, 19, 20),
(2100321540097, 'Manu Varshney', 3, 0, 20),
(2100321540125, 'Rachit Tomar', 3, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cse_ds_b_dstl`
--

CREATE TABLE `cse_ds_b_dstl` (
  `RollNO` bigint(255) DEFAULT NULL,
  `Names` varchar(300) DEFAULT NULL,
  `Sem` int(11) DEFAULT NULL,
  `Present` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cse_ds_b_dstl`
--

INSERT INTO `cse_ds_b_dstl` (`RollNO`, `Names`, `Sem`, `Present`, `Total`) VALUES
(2100321540124, 'Priyanshu Sharma', 3, 6, 9),
(2100321540126, 'Raj Tripathi', 3, 8, 9),
(2100321540097, 'Manu Varshney', 3, 8, 9),
(2100321540118, 'Prakhar Pandey', 3, 7, 9),
(2100321540125, 'Rachit Tomar', 3, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `loginformadmin`
--

CREATE TABLE `loginformadmin` (
  `user` bigint(255) DEFAULT NULL,
  `pass` text NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` bigint(255) DEFAULT NULL,
  `experience` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginformadmin`
--

INSERT INTO `loginformadmin` (`user`, `pass`, `Name`, `email`, `phone`, `experience`) VALUES
(989, '@priyanshu', 'Mr. Sharma', 'xyz@gmail.com', 7656766700, '5 Years');

-- --------------------------------------------------------

--
-- Table structure for table `loginformstudent`
--

CREATE TABLE `loginformstudent` (
  `user` bigint(255) DEFAULT NULL,
  `pass` varchar(300) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` bigint(255) DEFAULT NULL,
  `branch` varchar(30) DEFAULT NULL,
  `section` varchar(5) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `sem` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginformstudent`
--

INSERT INTO `loginformstudent` (`user`, `pass`, `Name`, `email`, `phone`, `branch`, `section`, `course`, `sem`) VALUES
(2100321540124, '@priyanshu', 'Priyanshu Sharma', 'priyanshusharma6666@gmail.com', 8279707568, 'CSEDS', 'B', 'B.Tech', 3),
(2100321540097, '1234', 'Manu Varshney', 'xyz@gmail.com', 506070809, 'CSEDS', 'B', 'B.Tech', 3),
(2100321540126, '12345', 'Raj Tripathi', 'xyz23@gmail.com', 506070856, 'CSEDS', 'B', 'B.Tech', 3),
(2100321540118, '12345', 'Prakhar Pandey', 'xyzy23@gmail.com', 506070856, 'CSEDS', 'B', 'B.Tech', 3),
(2100321540125, '12345', 'Rachit Tomar', 'xyzy234@gmail.com', 506070859, 'CSEDS', 'B', 'B.Tech', 3);

-- --------------------------------------------------------

--
-- Table structure for table `loginformteacher`
--

CREATE TABLE `loginformteacher` (
  `user` bigint(255) DEFAULT NULL,
  `pass` varchar(300) NOT NULL,
  `position` varchar(30) DEFAULT NULL,
  `experience` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `area_of_expertise` varchar(100) DEFAULT NULL,
  `phone` bigint(255) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginformteacher`
--

INSERT INTO `loginformteacher` (`user`, `pass`, `position`, `experience`, `email`, `area_of_expertise`, `phone`, `name`) VALUES
(1234, 'P2@1', 'HOD', '7 Years', 'xyz@gmail.com', 'Compiler Design,Computer Architecture,Web Development', 9087897687, 'Sumit Narayan');

-- --------------------------------------------------------

--
-- Table structure for table `pointer`
--

CREATE TABLE `pointer` (
  `pointers` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pointer`
--

INSERT INTO `pointer` (`pointers`) VALUES
('fygc4yrt6fv4try6f23wtr4yw63');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
