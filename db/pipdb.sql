-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 14, 2018 at 07:41 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pipdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

DROP TABLE IF EXISTS `proyek`;
CREATE TABLE IF NOT EXISTS `proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_laporan` varchar(100) NOT NULL,
  `no_pekerja` int(11) NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `nama_sarfas` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `merk_tahun` varchar(100) NOT NULL,
  `no_aset` varchar(100) NOT NULL,
  `file_foto` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `vendor` varchar(100) NOT NULL,
  `estimasi_selesai` date DEFAULT NULL,
  `estimasi_biaya` int(20) DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `realisasi_biaya` int(20) DEFAULT NULL,
  `file_timeline` varchar(100) NOT NULL,
  `file_oe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`no_laporan`),
  KEY `INDEX` (`status`,`no_pekerja`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `no_laporan`, `no_pekerja`, `nama_proyek`, `nama_sarfas`, `lokasi`, `tanggal_laporan`, `merk_tahun`, `no_aset`, `file_foto`, `status`, `vendor`, `estimasi_selesai`, `estimasi_biaya`, `tanggal_selesai`, `realisasi_biaya`, `file_timeline`, `file_oe`) VALUES
(1, '001/RSDP/ISG/2018', 753324, 'Perbaikan Turap Semampir Timur', 'Turap', 'Dermaga Semampir', '2018-08-14', 'PT Wijaya Karya (Persero)/2018', '001', '', 2, '', NULL, NULL, NULL, NULL, '', ''),
(2, '002/HSSE/ISG/2018', 749414, 'Perbaikan Foam Chamber', 'Foam Chamber', 'Dermaga Semampir', '2018-08-14', 'National Foam', '002', '', 3, '', NULL, NULL, NULL, NULL, '', ''),
(3, '003/SSA/ISG/2018', 753672, 'Pengadaan Kursi', 'Kursi', 'Perak', '2018-08-14', 'Fantoni/2018', '003', '', 4, '', NULL, NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rejected`
--

DROP TABLE IF EXISTS `rejected`;
CREATE TABLE IF NOT EXISTS `rejected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_laporan` varchar(100) NOT NULL,
  `rejector` int(11) NOT NULL,
  `alasan` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX` (`no_laporan`,`rejector`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nama_roles` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_proyek`
--

DROP TABLE IF EXISTS `sub_proyek`;
CREATE TABLE IF NOT EXISTS `sub_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_pekerjaan` text NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_pekerja` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `no_laporan` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX` (`no_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_pekerja` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `bagian` varchar(100) DEFAULT NULL,
  `roles` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`no_pekerja`),
  KEY `INDEX` (`roles`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `no_pekerja`, `password`, `nama`, `jabatan`, `bagian`, `roles`) VALUES
(1, 676897, '9c719e689867793779f7c4eb775f8fcc', 'Ahmad Jani Lauma', 'Operation Head', NULL, 4),
(2, 680427, '64bafab6a4706baa265858b6b4a04bc8', 'Muhammad Yunus Thahir', 'Superintendent RSD Tg Perak', 'RSD Perak', 2),
(3, 716423, '44bbba4de972e31d9cd1a3b60e65b005', 'Danang D.Kuntadi', 'Sr Loading Master Tg Perak', 'RSD Perak', 1),
(4, 750618, '15f554cb303b0e0e274cff6618369d8e', 'Rachmatullah Adicahya Nugraha', 'Spv Receiving & Storage Tg Perak', 'RSD Perak', 1),
(5, 753324, 'c7ac998fe14c53b164054fe70f41b7f9', 'Yopi Yuanggara', 'Spv Distribution Tg Perak', 'RSD Perak', 1),
(6, 653195, 'ae372f9442909c51cb0d67e67eee2784', 'Mochamad Alfan', 'Sr Spv RSD Bandaran', 'RSD Bandaran', 2),
(7, 745633, 'f301af46844ffa28df11719b70452d26', 'Adhi Sadewo Broto', 'Loading Master Bandaran', 'RSD Bandaran', 1),
(8, 749931, '9a2c52d5b557fde450c6728da9c434bf', 'Ricky Haryanto', 'Spv Receiving & Storage Bandaran', 'RSD Bandaran', 1),
(9, 744913, '01cd93fb7bc2a7fa763af83b47d895cf', 'Yusman Fitrianto', 'Spv Distribution Bandaran', 'RSD Bandaran', 1),
(10, 745676, '7e385b5d719d13108cb4181883719be3', 'Erri Luki Andriani', 'Sr Spv Quality & Quantity', 'QQ', 2),
(11, 754022, '8dcd6797c42b6fbf0e735a8c90750d38', 'Irpan Friyadi', 'Spv Quality & Quantity', 'QQ', 1),
(12, 745672, '38d6d73f99a9e7236cd53196e171468d', 'Cholishon Liwajhillah', 'Sr Spv Maintenance Planning & Services', NULL, 3),
(13, 748620, 'f1a9af45ad5e9e374829682241ad84e4', 'Sigit Trahmawan', 'Sr Spv HSSE', 'HSSE', 2),
(14, 749414, 'ee67eb6c1ae2852c27c970834e5c2242', 'Saiful Hamzah', 'Ast Fire & Safety', 'HSSE', 1),
(15, 745937, '85a4ce73f0a1a6febcbedac371def21f', 'Raden Muhsin Budiono', 'Sr Spv Sales Services & Administration', 'SSA', 2),
(16, 753672, '08f10a37be11081cc6e158d6f3b8bf5f', 'Syfa Almira', 'Spv Formality', 'SSA', 1),
(17, 111111, '96e79218965eb72c92a549dd5a330112', 'Admin', 'Admin', 'Admin', 99);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
