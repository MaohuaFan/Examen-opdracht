-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 02:38 PM
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
-- Table structure for table `gebruiker`
--

CREATE TABLE `gebruiker` (
  `gebruiker_id` int(11) NOT NULL,
  `gebruikersnaam` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gebruiker_verkiezing`
--

CREATE TABLE `gebruiker_verkiezing` (
  `gebruiker_id` int(11) NOT NULL,
  `verkiezing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partij`
--

CREATE TABLE `partij` (
  `partij_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `goedgekeurd_door_ministerie` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partij_verkiezing`
--

CREATE TABLE `partij_verkiezing` (
  `partij_id` int(11) NOT NULL,
  `verkiezing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stem`
--

CREATE TABLE `stem` (
  `stem_id` int(11) NOT NULL,
  `verkiezing_id` int(11) DEFAULT NULL,
  `stemgerechtigde_id` int(11) DEFAULT NULL,
  `partij_id` int(11) DEFAULT NULL,
  `datum_uitgebracht` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stemlijst`
--

CREATE TABLE `stemlijst` (
  `stemlijst_id` int(11) NOT NULL,
  `verkiesbare_id` int(11) DEFAULT NULL,
  `partij_id` int(11) DEFAULT NULL,
  `positie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiesbare`
--

CREATE TABLE `verkiesbare` (
  `verkiesbare_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiesbare_partij`
--

CREATE TABLE `verkiesbare_partij` (
  `verkiesbare_id` int(11) NOT NULL,
  `partij_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiezing`
--

CREATE TABLE `verkiezing` (
  `verkiezing_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `start_datum` date NOT NULL,
  `eind_datum` date NOT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingstatus`
--

CREATE TABLE `verkiezingstatus` (
  `status_id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingstype`
--

CREATE TABLE `verkiezingstype` (
  `type_id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingsuitslag`
--

CREATE TABLE `verkiezingsuitslag` (
  `uitslag_id` int(11) NOT NULL,
  `verkiezing_id` int(11) DEFAULT NULL,
  `gepubliceerd_door` int(11) DEFAULT NULL,
  `datum_gepubliceerd` date DEFAULT NULL,
  `uitslag_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`gebruiker_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indexes for table `gebruiker_verkiezing`
--
ALTER TABLE `gebruiker_verkiezing`
  ADD PRIMARY KEY (`gebruiker_id`,`verkiezing_id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`);

--
-- Indexes for table `partij`
--
ALTER TABLE `partij`
  ADD PRIMARY KEY (`partij_id`);

--
-- Indexes for table `partij_verkiezing`
--
ALTER TABLE `partij_verkiezing`
  ADD PRIMARY KEY (`partij_id`,`verkiezing_id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexes for table `stem`
--
ALTER TABLE `stem`
  ADD PRIMARY KEY (`stem_id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`),
  ADD KEY `stemgerechtigde_id` (`stemgerechtigde_id`),
  ADD KEY `partij_id` (`partij_id`);

--
-- Indexes for table `stemlijst`
--
ALTER TABLE `stemlijst`
  ADD PRIMARY KEY (`stemlijst_id`),
  ADD KEY `verkiesbare_id` (`verkiesbare_id`),
  ADD KEY `partij_id` (`partij_id`);

--
-- Indexes for table `verkiesbare`
--
ALTER TABLE `verkiesbare`
  ADD PRIMARY KEY (`verkiesbare_id`),
  ADD KEY `gebruiker_id` (`gebruiker_id`);

--
-- Indexes for table `verkiesbare_partij`
--
ALTER TABLE `verkiesbare_partij`
  ADD PRIMARY KEY (`verkiesbare_id`,`partij_id`),
  ADD KEY `partij_id` (`partij_id`);

--
-- Indexes for table `verkiezing`
--
ALTER TABLE `verkiezing`
  ADD PRIMARY KEY (`verkiezing_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `verkiezingstatus`
--
ALTER TABLE `verkiezingstatus`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `verkiezingstype`
--
ALTER TABLE `verkiezingstype`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `verkiezingsuitslag`
--
ALTER TABLE `verkiezingsuitslag`
  ADD PRIMARY KEY (`uitslag_id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`),
  ADD KEY `gepubliceerd_door` (`gepubliceerd_door`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partij`
--
ALTER TABLE `partij`
  MODIFY `partij_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stem`
--
ALTER TABLE `stem`
  MODIFY `stem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stemlijst`
--
ALTER TABLE `stemlijst`
  MODIFY `stemlijst_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiesbare`
--
ALTER TABLE `verkiesbare`
  MODIFY `verkiesbare_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiezing`
--
ALTER TABLE `verkiezing`
  MODIFY `verkiezing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiezingstatus`
--
ALTER TABLE `verkiezingstatus`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiezingstype`
--
ALTER TABLE `verkiezingstype`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiezingsuitslag`
--
ALTER TABLE `verkiezingsuitslag`
  MODIFY `uitslag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD CONSTRAINT `gebruiker_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);

--
-- Constraints for table `gebruiker_verkiezing`
--
ALTER TABLE `gebruiker_verkiezing`
  ADD CONSTRAINT `gebruiker_verkiezing_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`gebruiker_id`),
  ADD CONSTRAINT `gebruiker_verkiezing_ibfk_2` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezing` (`verkiezing_id`);

--
-- Constraints for table `partij_verkiezing`
--
ALTER TABLE `partij_verkiezing`
  ADD CONSTRAINT `partij_verkiezing_ibfk_1` FOREIGN KEY (`partij_id`) REFERENCES `partij` (`partij_id`),
  ADD CONSTRAINT `partij_verkiezing_ibfk_2` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezing` (`verkiezing_id`);

--
-- Constraints for table `stem`
--
ALTER TABLE `stem`
  ADD CONSTRAINT `stem_ibfk_1` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezing` (`verkiezing_id`),
  ADD CONSTRAINT `stem_ibfk_2` FOREIGN KEY (`stemgerechtigde_id`) REFERENCES `gebruiker` (`gebruiker_id`),
  ADD CONSTRAINT `stem_ibfk_3` FOREIGN KEY (`partij_id`) REFERENCES `partij` (`partij_id`);

--
-- Constraints for table `stemlijst`
--
ALTER TABLE `stemlijst`
  ADD CONSTRAINT `stemlijst_ibfk_1` FOREIGN KEY (`verkiesbare_id`) REFERENCES `verkiesbare` (`verkiesbare_id`),
  ADD CONSTRAINT `stemlijst_ibfk_2` FOREIGN KEY (`partij_id`) REFERENCES `partij` (`partij_id`);

--
-- Constraints for table `verkiesbare`
--
ALTER TABLE `verkiesbare`
  ADD CONSTRAINT `verkiesbare_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`gebruiker_id`);

--
-- Constraints for table `verkiesbare_partij`
--
ALTER TABLE `verkiesbare_partij`
  ADD CONSTRAINT `verkiesbare_partij_ibfk_1` FOREIGN KEY (`verkiesbare_id`) REFERENCES `verkiesbare` (`verkiesbare_id`),
  ADD CONSTRAINT `verkiesbare_partij_ibfk_2` FOREIGN KEY (`partij_id`) REFERENCES `partij` (`partij_id`);

--
-- Constraints for table `verkiezing`
--
ALTER TABLE `verkiezing`
  ADD CONSTRAINT `verkiezing_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `verkiezingstype` (`type_id`),
  ADD CONSTRAINT `verkiezing_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `verkiezingstatus` (`status_id`);

--
-- Constraints for table `verkiezingsuitslag`
--
ALTER TABLE `verkiezingsuitslag`
  ADD CONSTRAINT `verkiezingsuitslag_ibfk_1` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezing` (`verkiezing_id`),
  ADD CONSTRAINT `verkiezingsuitslag_ibfk_2` FOREIGN KEY (`gepubliceerd_door`) REFERENCES `gebruiker` (`gebruiker_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
