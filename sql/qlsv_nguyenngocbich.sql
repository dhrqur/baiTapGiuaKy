-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 06:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlsv_nguyenngocbich`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_students`
--

CREATE TABLE `table_students` (
  `id` int(10) NOT NULL,
  `fullname` text NOT NULL,
  `dob` date NOT NULL,
  `gender` int(1) NOT NULL,
  `hometown` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `group_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_students`
--

INSERT INTO `table_students` (`id`, `fullname`, `dob`, `gender`, `hometown`, `level`, `group_id`) VALUES
(1, 'Nguyễn Ngọc Bích', '2005-10-01', 0, 'Hà Nội', 0, 7),
(2, 'Nguyễn Việt Anh', '2005-06-17', 1, 'Thanh Hóa', 1, 7),
(3, 'Nguyễn Việt Hoàng An', '2005-06-03', 1, 'Hà Nội', 2, 7),
(4, 'Lại Văn Hưng', '2005-09-01', 1, 'Thanh Hóa', 3, 7),
(5, 'Trần Duy Hưng', '2005-04-27', 1, 'Hà Nội', 0, 7),
(6, 'Nguyễn Ngọc Linh', '2005-08-22', 0, 'Hà Nội', 1, 7),
(7, 'Vũ Văn Luân', '2005-06-05', 1, 'Hà Nội', 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_students`
--
ALTER TABLE `table_students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_students`
--
ALTER TABLE `table_students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
