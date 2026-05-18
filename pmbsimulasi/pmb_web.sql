-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 08:41 AM
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
-- Database: `pmb_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `jurusan_pilihan` varchar(100) DEFAULT NULL,
  `file_ktp` varchar(255) DEFAULT NULL,
  `file_ijazah` varchar(255) DEFAULT NULL,
  `status` enum('pending','verifikasi','lulus','ditolak') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_aktif` enum('belum','aktif') DEFAULT 'belum',
  `file_bukti` varchar(255) DEFAULT NULL,
  `status_bayar` varchar(20) DEFAULT 'belum',
  `status_kelulusan` varchar(20) DEFAULT 'pending',
  `file_ospek` varchar(255) DEFAULT NULL,
  `status_ospek` varchar(20) DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `user_id`, `nama_lengkap`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `asal_sekolah`, `jurusan_pilihan`, `file_ktp`, `file_ijazah`, `status`, `created_at`, `bukti_pembayaran`, `status_aktif`, `file_bukti`, `status_bayar`, `status_kelulusan`, `file_ospek`, `status_ospek`) VALUES
(1, 5, 'nisa naila', 'majalengka\r\n', NULL, NULL, 'uinssc', 'it', 'WhatsApp Image 2026-05-18 at 07.32.39.jpeg', '2.png', 'ditolak', '2026-05-18 04:48:18', NULL, 'belum', NULL, 'lunas', 'tidak', NULL, 'belum'),
(2, 5, 'nisa naila', 'majalengka\r\n', NULL, NULL, 'uinssc', 'it', 'WhatsApp Image 2026-05-18 at 07.32.39.jpeg', '2.png', 'lulus', '2026-05-18 04:50:01', NULL, 'belum', NULL, 'lunas', 'lulus', NULL, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','mahasiswa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Administrator', 'admin@gmail.com', '<?= password_hash(\"admin123\", PASSWORD_DEFAULT); ?>', 'admin'),
(3, 'Administrator', 'ns@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(4, 'Budi Santoso', 'mahasiswa@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mahasiswa'),
(5, 'bilqis', 'qis@gmail.com', '$2y$10$z4ZXjfumM2OYFv5L0ZR26.lb3Blxki4TaLRLQ3GxMspxpPnR/Z7oW', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD CONSTRAINT `pendaftar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
