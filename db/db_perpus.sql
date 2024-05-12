-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2024 at 01:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id`, `nama`, `nim`, `email`, `instansi`, `password`, `alamat`, `nohp`, `level`) VALUES
(1, 'Lidya Lestari', '220214674743', 'samosir.prima@gmail.co.id', 'Univesitas Negeri Malang', '12345678', 'Ds. Bah Jaya No. 765, Sukabumi 69969, KalTim', '0517 6942 9705', 0),
(2, 'Belinda Utami', '20201235738', 'wulandari.ratih@yahoo.co.id', 'Universitas Muhammaddiyah Malang', '12345678', 'Gg. Ters. Kiaracondong No. 794, Bima 67706, SulUt', '0902 1138 170', 0),
(3, 'Ahmad Hidayat', '1234567890', 'ahmad@yahoo.com', 'Universitas Indonesia', '12345678', 'Jl. Merdeka No. 123', '081234567890', 0),
(4, 'Siti Rahayu', '0987654321', 'siti@gmail.com', 'Institut Teknologi Bandung', '12345678', 'Jl. Cipto Mangunkusumo No. 45', '085678901234', 0),
(5, 'Rudi Santoso', '1357924680', 'rudi@outlook.com', 'Universitas Gadjah Mada', '12345678', 'Jl. Surya Sumantri No. 67', '087654321098', 0),
(6, 'Dewi Fitriani', '2468013579', 'dewi@gmail.com', 'Universitas Airlangga', '12345678', 'Jl. Diponegoro No. 89', '081234567890', 0),
(7, 'Budi Susanto', '9876543210', 'budi@gmail.com', 'Institut Pertanian Bogor', '12345678', 'Jl. Juanda No. 10', '081234567890', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id` int NOT NULL,
  `isbn` varchar(12) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `tahun_terbit` year NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `jumlah_total` int NOT NULL,
  `jumlah_tersedia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id`, `isbn`, `judul`, `pengarang`, `genre`, `tahun_terbit`, `penerbit`, `jumlah_total`, `jumlah_tersedia`) VALUES
(41, '9793062797', 'Laskar Pelangi', 'Andrea Hirata', 'Fiksi', 2005, 'Bentang Pustaka', 5, 5),
(42, '978979228043', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Fiksi', 2009, 'Gramedia Pustaka Utama', 7, 7),
(43, '9793604026', 'Ayat-Ayat Cinta', 'Habiburrahman El-Shirazy', 'Fiksi', 2004, 'Republika', 8, 9),
(44, '978979051779', '5 cm', 'Donny Dhirgantoro', 'Fiksi', 2005, 'Grasindo', 5, 5),
(45, '978979127780', 'Perahu Kertas', 'Dee Lestari', 'Fiksi', 2009, 'Bentang Pustaka', 4, 4),
(46, '9792201963', 'Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Fiksi', 1982, 'Gramedia Pustaka Utama', 7, 7),
(47, '978979127025', 'Laskar Pelangi: Edensor', 'Andrea Hirata', 'Fiksi', 2007, 'Bentang Pustaka', 4, 4),
(48, '978979231205', 'Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'Fiksi', 1997, 'Gramedia Pustaka Utama', 10, 10),
(49, '978602024828', 'Dilan 1990', 'Pidi Baiq', 'Fiksi', 2014, 'Penerbit Pastel Books', 5, 5),
(50, '9799731232', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Non Fiksi', 1980, 'Lentera Dipantara', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kunjungan`
--

CREATE TABLE `tb_kunjungan` (
  `id` int NOT NULL,
  `id_anggota` int NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id` varchar(10) NOT NULL,
  `isbn` varchar(15) NOT NULL,
  `id_anggota` int NOT NULL,
  `id_petugas` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jumlah_pinjam` int NOT NULL,
  `denda` int NOT NULL DEFAULT '0',
  `returned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `tb_kunjungan`
--
ALTER TABLE `tb_kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_kunjungan`
--
ALTER TABLE `tb_kunjungan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
