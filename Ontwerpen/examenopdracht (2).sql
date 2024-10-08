-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 11:58 AM
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
-- Database: `examenopdracht`
--

-- --------------------------------------------------------

--
-- Table structure for table `kandidaten`
--

CREATE TABLE `kandidaten` (
  `Kandidaat_ID` int(11) NOT NULL,
  `Kandidaat_Naam` varchar(100) NOT NULL,
  `Partij_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kandidaten`
--

INSERT INTO `kandidaten` (`Kandidaat_ID`, `Kandidaat_Naam`, `Partij_ID`) VALUES
(1, 'Jan Jansen', 1),
(2, 'Piet Pieters', 2);

-- --------------------------------------------------------

--
-- Table structure for table `partijen`
--

CREATE TABLE `partijen` (
  `Partij_ID` int(11) NOT NULL,
  `Partij_Naam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partijen`
--

INSERT INTO `partijen` (`Partij_ID`, `Partij_Naam`) VALUES
(1, 'Partij A'),
(2, 'Partij B'),
(3, 'Partij C');

-- --------------------------------------------------------

--
-- Table structure for table `stemgerechtigden`
--

CREATE TABLE `stemgerechtigden` (
  `Stemgerechtigde_ID` int(11) NOT NULL,
  `Naam` varchar(100) NOT NULL,
  `Geboortedatum` date NOT NULL,
  `Woonplaats` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stemgerechtigden`
--

INSERT INTO `stemgerechtigden` (`Stemgerechtigde_ID`, `Naam`, `Geboortedatum`, `Woonplaats`) VALUES
(1, 'Kees Klaas', '1980-01-01', 'Amsterdam'),
(2, 'Lisa Smit', '1990-05-10', 'Rotterdam');

-- --------------------------------------------------------

--
-- Table structure for table `stemmen`
--

CREATE TABLE `stemmen` (
  `Stem_ID` int(11) NOT NULL,
  `Stemgerechtigde_ID` int(11) NOT NULL,
  `Kandidaat_ID` int(11) NOT NULL,
  `Verkiezing_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stemmen`
--

INSERT INTO `stemmen` (`Stem_ID`, `Stemgerechtigde_ID`, `Kandidaat_ID`, `Verkiezing_ID`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingen`
--

CREATE TABLE `verkiezingen` (
  `Verkiezing_ID` int(11) NOT NULL,
  `VerkiezingType_ID` int(11) NOT NULL,
  `Naam` varchar(100) NOT NULL,
  `Startdatum` date NOT NULL,
  `Einddatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verkiezingen`
--

INSERT INTO `verkiezingen` (`Verkiezing_ID`, `VerkiezingType_ID`, `Naam`, `Startdatum`, `Einddatum`) VALUES
(1, 1, 'Tweede Kamer', '2024-10-01', '2024-10-02'),
(2, 2, 'Provinciale Staten', '2024-03-01', '2024-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingtypes`
--

CREATE TABLE `verkiezingtypes` (
  `VerkiezingType_ID` int(11) NOT NULL,
  `VerkiezingType_Naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verkiezingtypes`
--

INSERT INTO `verkiezingtypes` (`VerkiezingType_ID`, `VerkiezingType_Naam`) VALUES
(1, 'Landelijk'),
(2, 'Provinciaal'),
(3, 'Waterschap'),
(4, 'Gemeente'),
(5, 'Referendum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kandidaten`
--
ALTER TABLE `kandidaten`
  ADD PRIMARY KEY (`Kandidaat_ID`),
  ADD KEY `Partij_ID` (`Partij_ID`);

--
-- Indexes for table `partijen`
--
ALTER TABLE `partijen`
  ADD PRIMARY KEY (`Partij_ID`);

--
-- Indexes for table `stemgerechtigden`
--
ALTER TABLE `stemgerechtigden`
  ADD PRIMARY KEY (`Stemgerechtigde_ID`);

--
-- Indexes for table `stemmen`
--
ALTER TABLE `stemmen`
  ADD PRIMARY KEY (`Stem_ID`),
  ADD KEY `Stemgerechtigde_ID` (`Stemgerechtigde_ID`),
  ADD KEY `Kandidaat_ID` (`Kandidaat_ID`),
  ADD KEY `Verkiezing_ID` (`Verkiezing_ID`);

--
-- Indexes for table `verkiezingen`
--
ALTER TABLE `verkiezingen`
  ADD PRIMARY KEY (`Verkiezing_ID`),
  ADD KEY `VerkiezingType_ID` (`VerkiezingType_ID`);

--
-- Indexes for table `verkiezingtypes`
--
ALTER TABLE `verkiezingtypes`
  ADD PRIMARY KEY (`VerkiezingType_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kandidaten`
--
ALTER TABLE `kandidaten`
  MODIFY `Kandidaat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partijen`
--
ALTER TABLE `partijen`
  MODIFY `Partij_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stemgerechtigden`
--
ALTER TABLE `stemgerechtigden`
  MODIFY `Stemgerechtigde_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stemmen`
--
ALTER TABLE `stemmen`
  MODIFY `Stem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verkiezingen`
--
ALTER TABLE `verkiezingen`
  MODIFY `Verkiezing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verkiezingtypes`
--
ALTER TABLE `verkiezingtypes`
  MODIFY `VerkiezingType_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kandidaten`
--
ALTER TABLE `kandidaten`
  ADD CONSTRAINT `kandidaten_ibfk_1` FOREIGN KEY (`Partij_ID`) REFERENCES `partijen` (`Partij_ID`);

--
-- Constraints for table `stemmen`
--
ALTER TABLE `stemmen`
  ADD CONSTRAINT `stemmen_ibfk_1` FOREIGN KEY (`Stemgerechtigde_ID`) REFERENCES `stemgerechtigden` (`Stemgerechtigde_ID`),
  ADD CONSTRAINT `stemmen_ibfk_2` FOREIGN KEY (`Kandidaat_ID`) REFERENCES `kandidaten` (`Kandidaat_ID`),
  ADD CONSTRAINT `stemmen_ibfk_3` FOREIGN KEY (`Verkiezing_ID`) REFERENCES `verkiezingen` (`Verkiezing_ID`);

--
-- Constraints for table `verkiezingen`
--
ALTER TABLE `verkiezingen`
  ADD CONSTRAINT `verkiezingen_ibfk_1` FOREIGN KEY (`VerkiezingType_ID`) REFERENCES `verkiezingtypes` (`VerkiezingType_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
