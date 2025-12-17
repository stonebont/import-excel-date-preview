-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 04:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `import_date`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_inventaris`
--

CREATE TABLE `data_inventaris` (
  `id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `hari` varchar(30) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `jumlah` int(11) NOT NULL,
  `agenda` varchar(100) NOT NULL,
  `nama_ruang` varchar(100) NOT NULL,
  `keperluan` text NOT NULL,
  `user` varchar(60) NOT NULL,
  `hod` varchar(60) NOT NULL,
  `hga` varchar(60) NOT NULL,
  `os` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_inventaris`
--

INSERT INTO `data_inventaris` (`id`, `nama`, `department`, `tanggal_masuk`, `hari`, `jam_mulai`, `jam_akhir`, `jumlah`, `agenda`, `nama_ruang`, `keperluan`, `user`, `hod`, `hga`, `os`) VALUES
(1, '', '', '0000-00-00', '', '00:00:00', '00:00:00', 5, '', '', '', '', '', '', ''),
(2, '', '', '2020-10-15', '', '00:00:00', '00:00:00', 5, '', '', '', '', '', '', ''),
(3, '', '', '0000-00-00', '', '00:00:00', '00:00:00', 20, '', '', '', '', '', '', ''),
(4, 'setiawan', '', '2023-05-10', '', '00:00:00', '00:00:00', 6, '', '', '', '', '', '', ''),
(5, 'Ani Hidayati', '', '1984-05-16', '', '00:00:00', '00:00:00', 7, '', '', '', '', '', '', ''),
(6, 'Setiawan', 'umum', '1981-10-23', '', '00:00:00', '00:00:00', 15, '', '', '', '', '', '', ''),
(7, 'Setiawan', 'umum', '1981-10-23', 'jumat', '00:00:00', '00:00:00', 15, '', '', '', '', '', '', ''),
(8, 'Inna', 'direktorat', '2012-01-12', 'rabu', '00:00:00', '00:00:00', 6, '', '', '', '', '', '', ''),
(9, 'zerina', 'rektorat', '2015-02-05', 'kamis', '02:00:00', '03:00:00', 6, '', '', '', '', '', '', ''),
(10, 'zerina', 'rektorat', '2015-02-05', 'kamis', '02:00:00', '03:00:00', 6, 'meeting', 'anggrek', 'membahas yang perlu di bahas', '', '', '', ''),
(11, 'Azmi', 'dirjen', '2019-04-15', 'selasa', '01:00:00', '04:00:00', 40, 'pertemuan', 'mawar', 'apa saja yang diperlukan adalah ini dan itu semua nya satu tujuan', 'joko', 'susilo', 'iwan', 'kurniawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_inventaris`
--
ALTER TABLE `data_inventaris`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_inventaris`
--
ALTER TABLE `data_inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
