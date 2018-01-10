-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2016 at 10:55 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `info`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Message` varchar(255) DEFAULT NULL,
  `File_Name` int(11) NOT NULL,
  `Purchase_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`Id`, `Name`, `Email`, `Link`, `Message`, `File_Name`, `Purchase_Date`) VALUES
(41, 'Stan', 'stan@abv.bg', 'https://www.fmi.uni-sofia.bg', 'bohooo', 1467569480, '2016-07-03 20:11:20'),
(42, 'foo', 'Email@asd.bg', 'http://9gag.com', 'Pop-up Message', 1467570963, '2016-07-03 20:36:02'),
(43, 'Name', 'Email@asd.bg', 'http://www.giantitp.com', 'Pop-up Message', 1467574021, '2016-07-03 21:27:00'),
(44, 'Name', 'Email@adas.com', 'https://www.youtube.com', 'Pop-up Message', 1467578548, '2016-07-03 22:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `File_Name` varchar(255) NOT NULL,
  `File_Format` varchar(255) DEFAULT NULL,
  `Coordinate_X` int(11) DEFAULT NULL,
  `Coordinate_Y` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`File_Name`, `File_Format`, `Coordinate_X`, `Coordinate_Y`, `width`, `height`) VALUES
('1467569480.png', 'png', 300, 675, 25, 25),
('1467570963.png', 'png', 0, 0, 25, 25),
('1467574021.png', 'png', 575, 550, 50, 50),
('1467578548.png', 'png', 500, 725, 75, 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`File_Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
