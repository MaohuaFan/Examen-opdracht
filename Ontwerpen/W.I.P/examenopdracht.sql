-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 11:41 AM
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
-- Table structure for table `partijen`
--

CREATE TABLE `partijen` (
  `id` int(11) NOT NULL,
  `partijnaam` varchar(255) NOT NULL,
  `gecreëerd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stemgerechtigden`
--

CREATE TABLE `stemgerechtigden` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `geboortedatum` date DEFAULT NULL,
  `woonplaats` varchar(255) DEFAULT NULL,
  `is_geregistreerd` tinyint(1) DEFAULT 0,
  `gecreëerd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stemgerechtigden_verkiezingen`
--

CREATE TABLE `stemgerechtigden_verkiezingen` (
  `id` int(11) NOT NULL,
  `stemgerechtigde_id` int(11) DEFAULT NULL,
  `verkiezing_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stemmen`
--

CREATE TABLE `stemmen` (
  `id` int(11) NOT NULL,
  `verkiezing_id` int(11) DEFAULT NULL,
  `verkiesbare_id` int(11) DEFAULT NULL,
  `stemgerechtigde_id` int(11) DEFAULT NULL,
  `stemdatum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiesbaren`
--

CREATE TABLE `verkiesbaren` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `gecreëerd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiesbaren_partijen`
--

CREATE TABLE `verkiesbaren_partijen` (
  `id` int(11) NOT NULL,
  `verkiesbare_id` int(11) DEFAULT NULL,
  `partij_id` int(11) DEFAULT NULL,
  `verkiezing_id` int(11) DEFAULT NULL,
  `positie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingen`
--

CREATE TABLE `verkiezingen` (
  `id` int(11) NOT NULL,
  `verkiezingsnaam` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `verkiezingstype_id` int(11) DEFAULT NULL,
  `gecreëerd_op` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingstypes`
--

CREATE TABLE `verkiezingstypes` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `partijen`
--
ALTER TABLE `partijen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stemgerechtigden`
--
ALTER TABLE `stemgerechtigden`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stemgerechtigden_verkiezingen`
--
ALTER TABLE `stemgerechtigden_verkiezingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stemgerechtigde_id` (`stemgerechtigde_id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`);

--
-- Indexes for table `stemmen`
--
ALTER TABLE `stemmen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`),
  ADD KEY `verkiesbare_id` (`verkiesbare_id`),
  ADD KEY `stemgerechtigde_id` (`stemgerechtigde_id`);

--
-- Indexes for table `verkiesbaren`
--
ALTER TABLE `verkiesbaren`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verkiesbaren_partijen`
--
ALTER TABLE `verkiesbaren_partijen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verkiesbare_id` (`verkiesbare_id`),
  ADD KEY `partij_id` (`partij_id`),
  ADD KEY `verkiezing_id` (`verkiezing_id`);

--
-- Indexes for table `verkiezingen`
--
ALTER TABLE `verkiezingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verkiezingstype_id` (`verkiezingstype_id`);

--
-- Indexes for table `verkiezingstypes`
--
ALTER TABLE `verkiezingstypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `partijen`
--
ALTER TABLE `partijen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stemgerechtigden`
--
ALTER TABLE `stemgerechtigden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stemgerechtigden_verkiezingen`
--
ALTER TABLE `stemgerechtigden_verkiezingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stemmen`
--
ALTER TABLE `stemmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiesbaren`
--
ALTER TABLE `verkiesbaren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiesbaren_partijen`
--
ALTER TABLE `verkiesbaren_partijen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiezingen`
--
ALTER TABLE `verkiezingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkiezingstypes`
--
ALTER TABLE `verkiezingstypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stemgerechtigden_verkiezingen`
--
ALTER TABLE `stemgerechtigden_verkiezingen`
  ADD CONSTRAINT `stemgerechtigden_verkiezingen_ibfk_1` FOREIGN KEY (`stemgerechtigde_id`) REFERENCES `stemgerechtigden` (`id`),
  ADD CONSTRAINT `stemgerechtigden_verkiezingen_ibfk_2` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezingen` (`id`);

--
-- Constraints for table `stemmen`
--
ALTER TABLE `stemmen`
  ADD CONSTRAINT `stemmen_ibfk_1` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezingen` (`id`),
  ADD CONSTRAINT `stemmen_ibfk_2` FOREIGN KEY (`verkiesbare_id`) REFERENCES `verkiesbaren` (`id`),
  ADD CONSTRAINT `stemmen_ibfk_3` FOREIGN KEY (`stemgerechtigde_id`) REFERENCES `stemgerechtigden` (`id`);

--
-- Constraints for table `verkiesbaren_partijen`
--
ALTER TABLE `verkiesbaren_partijen`
  ADD CONSTRAINT `verkiesbaren_partijen_ibfk_1` FOREIGN KEY (`verkiesbare_id`) REFERENCES `verkiesbaren` (`id`),
  ADD CONSTRAINT `verkiesbaren_partijen_ibfk_2` FOREIGN KEY (`partij_id`) REFERENCES `partijen` (`id`),
  ADD CONSTRAINT `verkiesbaren_partijen_ibfk_3` FOREIGN KEY (`verkiezing_id`) REFERENCES `verkiezingen` (`id`);

--
-- Constraints for table `verkiezingen`
--
ALTER TABLE `verkiezingen`
  ADD CONSTRAINT `verkiezingen_ibfk_1` FOREIGN KEY (`verkiezingstype_id`) REFERENCES `verkiezingstypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
