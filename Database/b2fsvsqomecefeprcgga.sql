-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: b2fsvsqomecefeprcgga-mysql.services.clever-cloud.com:3306
-- Generation Time: Jun 27, 2021 at 09:03 AM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b2fsvsqomecefeprcgga`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`firstname`, `lastname`, `email`, `password`) VALUES
('Charles', 'Motsisi', 'givenmatibe@gmail.com', 'Gmanrulez1');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `chargeCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chargeType` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `penalty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cellnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

CREATE TABLE `licence` (
  `id` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `licenceCode` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PrDP` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateIssued` date NOT NULL,
  `expiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`id`, `licenceCode`, `PrDP`, `dateIssued`, `expiryDate`) VALUES
('893', 'h', 'hh', '2021-06-24', '2018-06-24'),
('9402106167082', 'l code', 'Prd', '2021-06-24', '2018-06-24'),
('9512205548089', 'A1', 'No', '2021-06-24', '2018-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `staffNumber` int NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cellnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `one_time_pin` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`staffNumber`, `created_at`, `updated_at`, `firstname`, `lastname`, `cellnumber`, `email`, `password`, `one_time_pin`) VALUES
(3, '2021-06-24', '2021-06-26', 'Gaopalelwe', 'Mpetshane', '0749091540', 'G@G.com', '123456', '047609'),
(4, '2021-06-24', '2021-06-27', 'Moeletši', 'Digoro', '0731111111', 'digoro9@hotmail.com', '12345678', '11FE26'),
(6, '2021-06-25', '2021-06-26', 'George', 'Mahlangu', '0823207253', 'givenmatibe@gmail.com', 'Gmanrulez1', 'F1C0C4'),
(7, '2021-06-25', '2021-06-25', 'Charles', 'Motsisi ', '0787218701', 'Charlesmotsisi100@gmail.com', 'charlesmotsisi', '1A270C'),
(8, '2021-06-25', '2021-06-26', 'Joseph', 'Digoro', '0743690469', 'digorojoseph@gmail.com', '17495aBc', 'FA35E5'),
(10, '2021-06-26', '2021-06-26', 'John', 'Maputla', '0823204256', 'john23@gmail.com', '12345678', 'KAPLV0');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `refference` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `licenceCode` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PrDP` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cellnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `licenceDisk` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicleType` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicleColour` varchar(90) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicleOwner` varchar(90) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicleRegisteredAddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chargeCode` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chargeType` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `penalty` double NOT NULL,
  `dateIssued` date NOT NULL,
  `staffNumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastPaymentDate` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `refference`, `firstname`, `lastname`, `address`, `licenceCode`, `PrDP`, `cellnumber`, `email`, `licenceDisk`, `vehicleType`, `model`, `vehicleColour`, `vehicleOwner`, `vehicleRegisteredAddress`, `chargeCode`, `chargeType`, `penalty`, `dateIssued`, `staffNumber`, `lastPaymentDate`, `created_at`) VALUES
('9402106167082', 6, 'GGGG', 'gggg', 'GgGg', 'l code', 'Prd', '1234567890', 'GG@v.com', 'Disk', 'V Ty', 'Mode', 'coloer', 'Owner', 'rgis Ad', 'code', 'Catyp', 49.45, '2021-06-24', '3', '2022-06-25', '2021-06-25'),
('9402106167082', 7, 'GGGG', 'gggg', 'GgGg', 'l code', 'Prd', '1234567890', 'GG@v.com', 'Disk', 'V Ty', 'Mode', 'coloer', 'Owner', 'rgis Ad', 'code', 'Catyp', 49.45, '2021-06-24', '3', '2022-06-25', '2021-06-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`chargeCode`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`staffNumber`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`refference`),
  ADD UNIQUE KEY `refference` (`refference`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `staffNumber` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `refference` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
