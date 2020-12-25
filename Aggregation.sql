-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2020 at 11:28 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Aggregation`
--

-- --------------------------------------------------------

--
-- Table structure for table `CameraInformation`
--

CREATE TABLE `CameraInformation` (
  `ID` int(11) NOT NULL,
  `Enable` int(11) NOT NULL,
  `policeStatus` tinyint(4) NOT NULL DEFAULT '1',
  `DeviceID` int(11) NOT NULL,
  `Name` varchar(70) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `PoleName` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `PoleID` int(11) NOT NULL,
  `cameraCode` bigint(20) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `SystemID` int(11) NOT NULL,
  `PoliceCode` int(11) NOT NULL,
  `speed` int(11) NOT NULL DEFAULT '605950',
  `Location` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `State` varchar(255) DEFAULT 'Tehran',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CompanyIDMapping`
--

CREATE TABLE `CompanyIDMapping` (
  `Description` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `CodeD` int(11) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Configuration`
--

CREATE TABLE `Configuration` (
  `ID` int(11) NOT NULL,
  `ServiceURI` varchar(100) NOT NULL,
  `ServicePort` int(11) NOT NULL,
  `TokenTimeAllowed` varchar(50) NOT NULL,
  `InfoTimeAllowed` varchar(50) NOT NULL,
  `SrorePath` varchar(100) NOT NULL,
  `MDLPath` varchar(100) NOT NULL,
  `EnableCheckOCR` tinyint(4) NOT NULL,
  `DBObjCount` int(11) NOT NULL,
  `OCRObjCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KnownDevices`
--

CREATE TABLE `KnownDevices` (
  `ID` int(11) NOT NULL,
  `DeviceID` int(11) NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Token` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PassedVehicleRecords`
--

CREATE TABLE `PassedVehicleRecords` (
  `ID` bigint(20) NOT NULL,
  `Accuracy` tinyint(4) NOT NULL,
  `CameraID` int(11) NOT NULL,
  `ImageAddress` text NOT NULL,
  `Direction` tinyint(4) NOT NULL,
  `Lane` tinyint(4) NOT NULL,
  `PassedTime` datetime NOT NULL,
  `MasterPlateValue` varchar(9) NOT NULL,
  `Speed` float NOT NULL,
  `Suspicious` varchar(50) NOT NULL,
  `UUID` varchar(50) NOT NULL,
  `VehicleType` tinyint(4) NOT NULL,
  `Wanted` tinyint(4) NOT NULL,
  `NewPlateValue` varchar(9) NOT NULL,
  `CodeType` varchar(5) NOT NULL,
  `RecivedTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ServiceFields`
--

CREATE TABLE `ServiceFields` (
  `ID` int(11) NOT NULL,
  `UUID` text NOT NULL,
  `CameraID` text NOT NULL,
  `Direction` text NOT NULL,
  `PlateValue` text NOT NULL,
  `Suspicious` text NOT NULL,
  `Speed` text NOT NULL,
  `VehicleType` text NOT NULL,
  `Lane` text NOT NULL,
  `PassedTime` text NOT NULL,
  `Accuracy` text NOT NULL,
  `Wanted` text NOT NULL,
  `PlateImage` text NOT NULL,
  `ColorImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Settings`
--

CREATE TABLE `Settings` (
  `ID` int(11) NOT NULL,
  `MinPlateImageWidth` int(11) NOT NULL,
  `MaxPlateImageWidth` int(11) NOT NULL,
  `MinPlateImageHeight` int(11) NOT NULL,
  `MaxPlateImageHeight` int(11) NOT NULL,
  `MinPlateImageSize` int(11) NOT NULL,
  `MaxPlateImageSize` int(11) NOT NULL,
  `MinColorImageWidth` int(11) NOT NULL,
  `MaxColorImageWidth` int(11) NOT NULL,
  `MinColorImageHeight` int(11) NOT NULL,
  `MaxColorImageHeight` int(11) NOT NULL,
  `MinColorImageSize` int(11) NOT NULL,
  `MaxColorImageSize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statesTags`
--

CREATE TABLE `statesTags` (
  `id` int(11) NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tags` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SystemIDMapping`
--

CREATE TABLE `SystemIDMapping` (
  `Description` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `ID` int(11) NOT NULL,
  `Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UserActivities`
--

CREATE TABLE `UserActivities` (
  `id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `passedVehicleRecordID` bigint(20) NOT NULL,
  `editedPlate` varchar(12) COLLATE utf8mb4_persian_ci NOT NULL,
  `userID` int(100) NOT NULL,
  `status` int(11) NOT NULL,
  `police` tinyint(4) NOT NULL,
  `cameraID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `UserGroup` varchar(13) COLLATE latin1_general_ci NOT NULL,
  `CreatedTime` datetime NOT NULL,
  `LastLogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CameraInformation`
--
ALTER TABLE `CameraInformation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `CompanyIDMapping`
--
ALTER TABLE `CompanyIDMapping`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Configuration`
--
ALTER TABLE `Configuration`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `KnownDevices`
--
ALTER TABLE `KnownDevices`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DeviceID` (`DeviceID`);

--
-- Indexes for table `PassedVehicleRecords`
--
ALTER TABLE `PassedVehicleRecords`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UUID` (`UUID`);

--
-- Indexes for table `ServiceFields`
--
ALTER TABLE `ServiceFields`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `statesTags`
--
ALTER TABLE `statesTags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state` (`state`);

--
-- Indexes for table `SystemIDMapping`
--
ALTER TABLE `SystemIDMapping`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `UserActivities`
--
ALTER TABLE `UserActivities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `passedVehicleRecordID` (`passedVehicleRecordID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CameraInformation`
--
ALTER TABLE `CameraInformation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CompanyIDMapping`
--
ALTER TABLE `CompanyIDMapping`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PassedVehicleRecords`
--
ALTER TABLE `PassedVehicleRecords`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statesTags`
--
ALTER TABLE `statesTags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SystemIDMapping`
--
ALTER TABLE `SystemIDMapping`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserActivities`
--
ALTER TABLE `UserActivities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
