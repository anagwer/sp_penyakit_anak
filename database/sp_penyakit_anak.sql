-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2025 at 01:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_penyakit_anak`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `penyakit_id` int(11) DEFAULT NULL,
  `gejala_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id`, `penyakit_id`, `gejala_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 1, 6),
(6, 1, 7),
(7, 1, 8),
(8, 2, 7),
(9, 2, 8),
(10, 2, 9),
(11, 2, 10),
(12, 2, 11),
(13, 2, 12),
(14, 2, 13),
(15, 3, 4),
(16, 3, 7),
(17, 3, 11),
(18, 3, 13),
(19, 3, 15),
(20, 3, 16),
(21, 3, 17),
(22, 4, 3),
(23, 4, 11),
(24, 4, 13),
(25, 4, 18),
(26, 4, 19),
(27, 4, 20),
(28, 5, 21),
(29, 5, 22),
(30, 5, 23),
(31, 5, 24),
(32, 5, 25),
(33, 5, 26);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `kode`, `nama`) VALUES
(2, 'L01', 'Bab cair lebih dan 3x sehat'),
(3, 'L02', 'Lesu'),
(4, 'L03', 'Nafsu makan berkurang'),
(5, 'L04', 'Keram pada perut'),
(6, 'L05', 'Perut kembung'),
(7, 'L06', 'Demam'),
(8, 'L07', 'Muntah'),
(9, 'L08', 'Kejang 1-2x sehari'),
(10, 'L09', 'Bab cair'),
(11, 'L10', 'Sesak nafas'),
(12, 'L11', 'Terlihat sangat mengantuk'),
(13, 'L12', 'Batuk'),
(14, 'L13', 'Pilek'),
(15, 'L14', 'Menggigil'),
(16, 'L15', 'Dada terasa sakit'),
(17, 'L16', 'Sakit kepala'),
(18, 'L17', 'Nafas berbunyi (mengi)'),
(19, 'L18', 'Faktor keturunan'),
(20, 'L19', 'Susah tidur'),
(21, 'L20', 'Anak tampak kurus'),
(22, 'L21', 'Pucat'),
(23, 'L22', 'Gatal sekitar anus'),
(24, 'L23', 'Gelisah atau tidak nyaman saat tidur'),
(25, 'L24', 'Iritasi kulit sekitar anus'),
(26, 'L25', 'Sering sakit perut');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `kode`, `nama`, `deskripsi`) VALUES
(1, 'T01', 'DIARE', 'DIARE'),
(2, 'T02', 'KEJANG DEMAM', 'KEJANG DEMAM'),
(3, 'T03', 'BRONCHOPNEUMONIA', 'BRONCHOPNEUMONIA'),
(4, 'T04', 'ASMA', 'ASMA'),
(5, 'T05', 'CACINGAN', 'CACINGAN\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyakit_id` (`penyakit_id`),
  ADD KEY `gejala_id` (`gejala_id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`),
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`gejala_id`) REFERENCES `gejala` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
