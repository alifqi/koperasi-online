-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 04:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_produk`, `nama_produk`, `jumlah_produk`, `total_harga`) VALUES
(17, 15, 'Bed kelas XII', 4, 20000),
(18, 25, 'LKS Biologi kelas XII', 1, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `gambar_produk`, `nama_produk`, `harga_produk`) VALUES
(9, 'topi.jpg', 'Topi', 15000),
(10, 'dasi.jpg', 'Dasi', 15000),
(11, 'Sabuk.jpg', 'Sabuk', 15000),
(12, 'Bed Bendera.jpg', 'Bed Bendera', 5000),
(13, 'Bed kelas X.jpg', 'Bed kelas X', 5000),
(14, 'bed kelas XI.jpg', 'bed kelas XI', 5000),
(15, 'Bed kelas XII.jpg', 'Bed kelas XII', 5000),
(16, 'Bed Logo SMA.jpg', 'Bed Logo SMA', 5000),
(17, 'Bed identitas SMA.jpg', 'Bed Identitas SMA', 5000),
(18, 'LKS Bahasa Indonesia kelas X.jpg', 'LKS Bahasa Indonesia kelas X', 40000),
(19, 'LKS Ekonomi kelas X.jpg', 'LKS Ekonomi kelas X', 40000),
(20, 'LKS Fisika kelas X.jpg', 'LKS Fisika kelas X', 40000),
(21, 'LKS Kimia kelas XI.jpg', 'LKS Kimia kelas XI', 40000),
(22, 'LKS Matematika TL kelas XI.jpg', 'LKS Matematika TL kelas XI', 40000),
(23, 'LKS Sosiologi kelas XI.jpg', 'LKS Sosiologi kelas XI', 40000),
(24, 'LKS Bahasa Inggris kelas XII.jpg', 'LKS Bahasa Inggris kelas XII', 40000),
(25, 'LKS Biologi kelas XII.jpg', 'LKS Biologi kelas XII', 40000),
(26, 'LKS Geografi kelas XII.jpg', 'LKS Geografi kelas XII', 40000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
