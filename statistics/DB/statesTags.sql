-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2020 at 02:57 PM
-- Server version: 8.0.21-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `statesTags`
--

CREATE TABLE `statesTags` (
  `id` int NOT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tags` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `statesTags`
--

INSERT INTO `statesTags` (`id`, `state`, `name`, `tags`) VALUES
(1, 'Alborz', 'البرز', '21,30,38,68,78'),
(2, 'Ardebil', 'اردبیل', '91'),
(4, 'Bushehr', 'بوشهر', '48,58'),
(5, 'Chahar Mahall and Bakhtiari', 'چهار محال بختیاری', '71,81'),
(6, 'East Azarbaijan', 'آذربایجان شرقی', '15,25,35'),
(7, 'Esfahan', 'اصفهان', '13,23,43,53,67'),
(8, 'Fars', 'فارس', '63,73,83,93'),
(9, 'Gilan', 'گیلان', '46,56,76'),
(10, 'Golestan', 'گلستان', '59,69'),
(11, 'Hamadan', 'همدان', '18,28'),
(12, 'Hormozgan', 'هرمزگان', '84,94'),
(13, 'Ilam', 'ایلام', '98'),
(14, 'Kerman', 'کرمان', '45,65,75'),
(15, 'Kermanshah', 'کرمانشاه', '19,29'),
(16, 'Khuzestan', 'خوزستان', '34,24,14'),
(17, 'Kohgiluyeh and Buyer Ahmad', 'کهکلویه و بویر احمد', '49'),
(18, 'Kordestan', 'کردستان', '51,61'),
(19, 'Lorestan', 'لرستان', '31,41'),
(20, 'Markazi', 'مرکزی', '47,57'),
(21, 'Mazandaran', 'مازندران', '62,72,82,92'),
(22, 'North Khorasan', 'خراسان شمالی', '32,26'),
(23, 'Qazvin', 'قزوین', '79,89'),
(24, 'Qom', 'قم', '16'),
(25, 'Razavi Khorasan', 'خراسان رضوی', '12,32,42,36,74'),
(26, 'Semnan', 'سمنان', '86,96'),
(27, 'Sistan and Baluchestan', 'سیستان و بلوچستان', '85,95'),
(28, 'South Khorasan', 'خراسان جنوبی', '32,52'),
(29, 'Tehran', 'تهران', '11,22,33,44,55,66,77,88,99,10,20,30,40,21,38,78\r\n'),
(30, 'West Azarbaijan', 'آذربایجان غربی', '17,27,37'),
(31, 'Yazd', 'یزد', '54,64'),
(32, 'Zanjan', 'زنجان', '87,97');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `statesTags`
--
ALTER TABLE `statesTags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state` (`state`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `statesTags`
--
ALTER TABLE `statesTags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
