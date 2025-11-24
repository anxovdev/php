-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql305.infinityfree.com
-- Generation Time: Nov 24, 2025 at 04:27 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39998083_anxo`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `password`) VALUES
(1, 'anxo', 'abc123.');

-- --------------------------------------------------------

--
-- Table structure for table `plantillas_baloncesto_25_26`
--

CREATE TABLE `plantillas_baloncesto_25_26` (
  `id` int(11) NOT NULL,
  `equipo` varchar(50) NOT NULL,
  `nombre_jugador` varchar(100) NOT NULL,
  `posicion` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `plantillas_baloncesto_25_26`
--

INSERT INTO `plantillas_baloncesto_25_26` (`id`, `equipo`, `nombre_jugador`, `posicion`, `numero`) VALUES
(1, 'Real Madrid', 'Facundo Campazzo', 'Base', 7),
(2, 'Real Madrid', 'Andrés Feliz', 'Base', 24),
(3, 'Real Madrid', 'Théo Maledon', 'Base', 12),
(4, 'Real Madrid', 'Sergio Llull', 'Escolta', 23),
(5, 'Real Madrid', 'Gabriele Procida', 'Escolta / Alero', 9),
(6, 'Real Madrid', 'Alberto Abalde', 'Alero', 6),
(7, 'Real Madrid', 'Chuma Okeke', 'Alero', 8),
(8, 'Real Madrid', 'David Krämer', 'Alero', 1),
(9, 'Real Madrid', 'Mario Hezonja', 'Alero', 11),
(10, 'Real Madrid', 'Izan Almansa', 'Ala-pívot', 13),
(11, 'Real Madrid', 'Usman Garuba', 'Pívot / Ala-pívot', 16),
(12, 'Real Madrid', 'Bruno?Fernando', 'Pívot', 20),
(13, 'Real Madrid', 'Walter Tavares', 'Pívot', 22),
(14, 'Barcelona', 'Tomas Satoransky', 'Base', NULL),
(15, 'Barcelona', 'Juan Núñez', 'Base', NULL),
(16, 'Barcelona', 'Juani Marcos', 'Base', 2),
(17, 'Barcelona', 'Kevin Punter', 'Escolta', NULL),
(18, 'Barcelona', 'Nico Laprovittola', 'Escolta', NULL),
(19, 'Barcelona', 'Darío Brizuela', 'Escolta', NULL),
(20, 'Barcelona', 'Joel Parra', 'Alero', NULL),
(21, 'Barcelona', 'Myles Cale', 'Alero', 3),
(22, 'Barcelona', 'Will Clyburn', 'Alero / Ala-pívot', 21),
(23, 'Barcelona', 'Jan Vesely', 'Ala-pívot', NULL),
(24, 'Barcelona', 'Tornike Shengelia', 'Ala-pívot', 23),
(25, 'Barcelona', 'Miles Norris', 'Ala-pívot', 5),
(26, 'Barcelona', 'Willy Hernangómez', 'Pívot', NULL),
(27, 'Barcelona', 'Youssoupha Fall', 'Pívot', NULL),
(28, 'Barcelona', 'Sayon Keita', 'Joven / Rotación', NULL),
(29, 'Barcelona', 'Nikola Kusturica', 'Joven / Rotación', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `plantillas_baloncesto_25_26`
--
ALTER TABLE `plantillas_baloncesto_25_26`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plantillas_baloncesto_25_26`
--
ALTER TABLE `plantillas_baloncesto_25_26`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
