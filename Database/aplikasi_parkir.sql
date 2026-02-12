-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2026 at 03:45 AM
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
-- Database: `aplikasi_parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id_area` int NOT NULL,
  `nama_area` varchar(50) DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `terisi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(7, 'Basement', 50, 2),
(8, 'Luar Selatan', 30, 1),
(9, 'Luar Utara', 40, 1),
(11, 'Basement Lt.2', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int NOT NULL,
  `plat_nomor` varchar(15) DEFAULT NULL,
  `jenis_kendaraan` varchar(20) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`, `pemilik`, `id_user`) VALUES
(5, 'Z 2919 AZ', 'Motor', 'Merah', 'Radiva', NULL),
(7, 'D 2019 ZN', 'Mobil', 'Hitam', 'Agung', NULL),
(8, '', 'Motor', NULL, NULL, 4),
(9, 'A 1212 BB', 'mobil', NULL, NULL, 4),
(10, 'D 1234 ZZ', 'mobil', NULL, NULL, 4),
(11, 'A 1122 BB', 'mobil', NULL, NULL, 4),
(12, '12', 'motor', NULL, NULL, 4),
(13, 'A', 'mobil', NULL, NULL, 4),
(14, 'Z AGSA 22', 'mobil', NULL, NULL, 4),
(15, 'A 2191 BC', 'mobil', NULL, NULL, 4),
(16, 'B 2303 BC', 'mobil', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `aktivitas` varchar(100) DEFAULT NULL,
  `waktu_aktivitas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu_aktivitas`) VALUES
(1, 2, 'Tambah User', '2026-01-26 17:42:40'),
(2, 2, 'Hapus User', '2026-01-27 16:56:55'),
(3, 2, 'Tambah User', '2026-01-27 16:57:19'),
(4, 2, 'Hapus User', '2026-01-27 17:09:20'),
(5, 2, 'Tambah User', '2026-01-27 17:10:20'),
(6, 2, 'Hapus User', '2026-01-27 17:10:28'),
(7, 2, 'Tambah User', '2026-01-27 17:11:13'),
(8, 2, 'Hapus User', '2026-01-27 17:11:16'),
(9, 2, 'Tambah User', '2026-01-27 17:19:12'),
(10, 2, 'Hapus User', '2026-01-27 17:19:16'),
(11, 2, 'Tambah User', '2026-01-27 17:24:11'),
(12, 2, 'Hapus User', '2026-01-27 17:24:17'),
(13, 2, 'Edit User', '2026-01-27 17:29:26'),
(14, 2, 'Edit User', '2026-01-27 17:29:33'),
(15, 2, 'Tambah User', '2026-01-27 17:31:58'),
(22, 2, 'Tambah User', '2026-01-27 18:10:32'),
(23, 2, 'Hapus User ID 16', '2026-01-27 18:10:45'),
(24, 2, 'Tambah User', '2026-01-27 18:11:04'),
(25, 2, 'Hapus User ID 17', '2026-01-27 18:11:08'),
(26, 2, 'Edit User', '2026-01-27 18:11:22'),
(27, 2, 'Hapus User ID 15', '2026-01-27 18:12:25'),
(28, 2, 'Hapus User ID 15', '2026-01-27 18:12:54'),
(29, 2, 'Hapus User ID 15', '2026-01-27 18:14:03'),
(30, 2, 'Hapus User ID 15', '2026-01-27 18:33:08'),
(31, 2, 'Tambah User', '2026-01-27 18:41:59'),
(32, 2, 'Hapus User ID 18', '2026-01-28 01:50:13'),
(33, 2, 'Tambah Kendaraan: Z 2919 AZ (Motor)', '2026-01-28 02:58:12'),
(34, 2, 'Update Kendaraan: Z 2919 AZ', '2026-01-28 02:58:25'),
(35, 2, 'Tambah User', '2026-01-28 02:59:02'),
(39, 2, 'Login ke sistem sebagai admin', '2026-01-28 03:02:39'),
(40, 2, 'Logout dari sistem', '2026-01-28 20:08:23'),
(41, 2, 'Login ke sistem sebagai admin', '2026-01-28 20:08:54'),
(42, 2, 'Logout dari sistem', '2026-01-28 20:09:30'),
(43, 4, 'Login ke sistem sebagai petugas', '2026-01-28 20:09:58'),
(44, 4, 'Logout dari sistem', '2026-01-28 20:14:41'),
(45, 2, 'Login ke sistem sebagai admin', '2026-01-28 20:15:07'),
(46, 4, 'Login ke sistem sebagai petugas', '2026-01-28 20:15:22'),
(47, 4, 'Logout dari sistem', '2026-01-28 20:15:57'),
(48, 2, 'Login ke sistem sebagai admin', '2026-01-28 20:16:04'),
(49, 2, 'Hapus Kendaraan ID: 6', '2026-01-28 20:16:18'),
(50, 2, 'Hapus Kendaraan ID: 4', '2026-01-28 20:19:08'),
(51, 2, 'Tambah Kendaraan: D 2019 ZN (Mobil)', '2026-01-28 20:19:28'),
(52, 2, 'Logout dari sistem', '2026-01-28 20:20:48'),
(53, 4, 'Login ke sistem sebagai petugas', '2026-01-28 20:20:55'),
(54, 2, 'Login ke sistem sebagai admin', '2026-01-28 20:21:04'),
(55, 2, 'Logout dari sistem', '2026-01-28 20:21:07'),
(56, 4, 'Login ke sistem sebagai petugas', '2026-01-28 20:21:16'),
(57, 4, 'Logout dari sistem', '2026-01-28 20:29:48'),
(58, 2, 'Login ke sistem sebagai admin', '2026-01-28 20:29:56'),
(59, 2, 'Edit User', '2026-01-28 20:40:01'),
(60, 2, 'Tambah User', '2026-01-28 20:40:27'),
(61, 2, 'Tambah Area: Basemenet Lt.2 (Kapasitas: 30)', '2026-01-28 20:42:25'),
(62, 2, 'Hapus Area ID: 10', '2026-01-28 20:54:58'),
(63, 2, 'Tambah Area: Basement Lt.2 (Kapasitas: 30)', '2026-01-28 20:55:09'),
(64, 2, 'Logout dari sistem', '2026-01-28 20:58:17'),
(65, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:00:33'),
(66, 2, 'Logout dari sistem', '2026-01-28 21:00:42'),
(67, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:01:50'),
(68, 2, 'Tambah User', '2026-01-28 21:02:17'),
(69, 2, 'Hapus User ID 21', '2026-01-28 21:02:21'),
(70, 2, 'Logout dari sistem', '2026-01-28 21:05:20'),
(71, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:05:30'),
(72, 4, 'Logout dari sistem', '2026-01-28 21:09:06'),
(73, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:10:53'),
(74, 2, 'Tambah User', '2026-01-28 21:11:12'),
(75, 2, 'Logout dari sistem', '2026-01-28 21:11:16'),
(76, 22, 'Login ke sistem sebagai owner', '2026-01-28 21:11:25'),
(77, 22, 'Logout dari sistem', '2026-01-28 21:11:54'),
(78, 22, 'Login ke sistem sebagai owner', '2026-01-28 21:12:14'),
(79, 22, 'Logout dari sistem', '2026-01-28 21:12:24'),
(80, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:12:34'),
(81, 4, 'Logout dari sistem', '2026-01-28 21:13:38'),
(82, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:14:23'),
(83, 2, 'Logout dari sistem', '2026-01-28 21:18:08'),
(84, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:18:52'),
(85, 4, 'Logout dari sistem', '2026-01-28 21:18:55'),
(86, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:19:06'),
(87, 4, 'Logout dari sistem', '2026-01-28 21:24:23'),
(88, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:24:35'),
(89, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:25:32'),
(90, 4, 'Logout dari sistem', '2026-01-28 21:25:35'),
(91, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:25:43'),
(92, 4, 'Logout dari sistem', '2026-01-28 21:29:15'),
(93, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:29:28'),
(94, 4, 'Logout dari sistem', '2026-01-28 21:29:32'),
(95, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:29:40'),
(96, 2, 'Logout dari sistem', '2026-01-28 21:29:46'),
(97, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:30:06'),
(98, 2, 'Logout dari sistem', '2026-01-28 21:30:23'),
(99, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:30:35'),
(100, 4, 'Logout dari sistem', '2026-01-28 21:31:01'),
(101, 22, 'Login ke sistem sebagai owner', '2026-01-28 21:31:39'),
(102, 22, 'Logout dari sistem', '2026-01-28 21:32:02'),
(103, 22, 'Login ke sistem sebagai owner', '2026-01-28 21:32:56'),
(104, 22, 'Logout dari sistem', '2026-01-28 21:33:18'),
(105, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:33:25'),
(106, 4, 'Logout dari sistem', '2026-01-28 21:35:19'),
(107, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:35:27'),
(108, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:35:35'),
(109, 4, 'Logout dari sistem', '2026-01-28 21:35:41'),
(110, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:36:43'),
(111, 4, 'Logout dari sistem', '2026-01-28 21:38:06'),
(112, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:38:13'),
(113, 2, 'Logout dari sistem', '2026-01-28 21:38:16'),
(114, 22, 'Login ke sistem sebagai owner', '2026-01-28 21:38:30'),
(115, 22, 'Logout dari sistem', '2026-01-28 21:38:49'),
(116, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:39:00'),
(117, 2, 'Logout dari sistem', '2026-01-28 21:42:26'),
(118, 2, 'Login ke sistem sebagai admin', '2026-01-28 21:42:34'),
(119, 2, 'Logout dari sistem', '2026-01-28 21:42:49'),
(120, 4, 'Login ke sistem sebagai petugas', '2026-01-28 21:42:59'),
(121, 4, 'Logout dari sistem', '2026-01-28 22:33:49'),
(122, 2, 'Login ke sistem sebagai admin', '2026-01-28 22:33:57'),
(123, 2, 'Tambah Tarif: motor - Rp 3000', '2026-01-28 22:35:35'),
(124, 2, 'Hapus Tarif ID: 9', '2026-01-28 22:35:40'),
(125, 2, 'Hapus User ID 19', '2026-01-28 22:37:58'),
(126, 2, 'Edit User', '2026-01-28 22:40:20'),
(127, 2, 'Tambah User', '2026-01-28 22:40:36'),
(128, 2, 'Edit User', '2026-01-28 22:40:45'),
(129, 2, 'Hapus User ID 23', '2026-01-28 22:40:49'),
(130, 2, 'Logout dari sistem', '2026-01-28 22:41:37'),
(131, 4, 'Login ke sistem sebagai petugas', '2026-01-28 22:41:50'),
(132, 4, 'Logout dari sistem', '2026-01-28 22:47:17'),
(133, 22, 'Login ke sistem sebagai owner', '2026-01-28 22:47:28'),
(134, 22, 'Logout dari sistem', '2026-01-28 22:52:30'),
(135, 4, 'Login ke sistem sebagai petugas', '2026-01-28 22:52:40'),
(136, 4, 'Logout dari sistem', '2026-01-28 23:05:11'),
(137, 22, 'Login ke sistem sebagai owner', '2026-01-28 23:05:19'),
(138, 22, 'Logout dari sistem', '2026-01-28 23:11:34'),
(139, 2, 'Login ke sistem sebagai admin', '2026-01-28 23:11:42'),
(140, 4, 'Login ke sistem sebagai petugas', '2026-01-28 23:13:41'),
(141, 4, 'Logout dari sistem', '2026-01-28 23:57:10'),
(142, 4, 'Login ke sistem sebagai petugas', '2026-01-28 23:59:06'),
(143, 4, 'Logout dari sistem', '2026-01-29 00:22:40'),
(144, 2, 'Login ke sistem sebagai admin', '2026-01-29 00:22:58'),
(145, 2, 'Logout dari sistem', '2026-01-29 00:41:53'),
(146, 22, 'Login ke sistem sebagai owner', '2026-01-29 00:44:06'),
(147, 22, 'Logout dari sistem', '2026-01-29 00:44:33'),
(148, 2, 'Login ke sistem sebagai admin', '2026-01-31 22:36:33'),
(149, 2, 'Logout dari sistem', '2026-01-31 23:18:33'),
(150, 4, 'Login ke sistem sebagai petugas', '2026-01-31 23:19:01'),
(151, 4, 'Logout dari sistem', '2026-01-31 23:31:23'),
(152, 22, 'Login ke sistem sebagai owner', '2026-01-31 23:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','lainnya') DEFAULT NULL,
  `tarif_per_jam` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(7, 'motor', '2000'),
(8, 'mobil', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int NOT NULL,
  `id_kendaraan` int DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `id_tarif` int DEFAULT NULL,
  `durasi_jam` int DEFAULT NULL,
  `biaya_total` decimal(10,0) DEFAULT NULL,
  `status` enum('masuk','keluar','') DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_area` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `waktu_masuk`, `waktu_keluar`, `id_tarif`, `durasi_jam`, `biaya_total`, `status`, `id_user`, `id_area`) VALUES
(4, 8, '2026-01-28 20:22:24', NULL, 7, NULL, NULL, 'masuk', 4, NULL),
(5, 8, '2026-01-28 20:22:34', NULL, 7, NULL, NULL, 'masuk', 4, NULL),
(6, 8, '2026-01-28 20:25:09', NULL, 7, NULL, NULL, 'masuk', 4, NULL),
(7, 9, '2026-01-28 20:28:41', '2026-01-28 20:29:09', 8, 1, '5000', 'keluar', 4, 7),
(8, 5, '2026-01-28 20:29:27', '2026-01-28 21:30:40', 7, 2, '4000', 'keluar', 4, 7),
(9, 9, '2026-01-28 21:07:27', '2026-01-28 21:07:42', 7, 1, '2000', 'keluar', 4, 7),
(10, 7, '2026-01-28 21:08:34', '2026-01-28 21:08:47', 8, 1, '5000', 'keluar', 4, 11),
(11, 5, '2026-01-28 21:08:44', '2026-01-28 21:26:28', 8, 1, '5000', 'keluar', 4, 9),
(12, 10, '2026-01-28 21:12:55', '2026-01-28 21:47:14', 8, 1, '5000', 'keluar', 4, 9),
(13, 11, '2026-01-28 21:13:18', '2026-01-28 21:13:22', 8, 1, '5000', 'keluar', 4, 9),
(14, 12, '2026-01-28 21:20:29', '2026-01-28 21:20:45', 7, 1, '2000', 'keluar', 4, 11),
(15, 13, '2026-01-28 21:23:52', '2026-01-28 21:24:00', 8, 1, '5000', 'keluar', 4, 9),
(16, 14, '2026-01-28 21:37:00', '2026-01-28 21:37:05', 8, 1, '5000', 'keluar', 4, 9),
(17, 9, '2026-01-28 21:47:32', '2026-01-28 21:48:25', 8, 1, '5000', 'keluar', 4, 9),
(18, 11, '2026-01-28 21:47:42', '2026-01-28 21:48:12', 7, 1, '2000', 'keluar', 4, 9),
(19, 10, '2026-01-28 21:48:53', '2026-01-28 22:44:28', 7, 1, '2000', 'keluar', 4, 11),
(20, 7, '2026-01-28 21:49:03', '2026-01-28 22:33:27', 7, 1, '2000', 'keluar', 4, 11),
(21, 9, '2026-01-28 21:51:52', '2026-01-28 22:32:35', 8, 1, '5000', 'keluar', 4, 9),
(22, 7, '2026-01-28 22:44:50', '2026-01-28 22:46:48', 7, 1, '2000', 'keluar', 4, 11),
(23, 7, '2026-01-28 22:44:59', '2026-01-28 22:45:47', 8, 1, '5000', 'keluar', 4, 9),
(24, 10, '2026-01-28 22:52:48', '2026-01-28 22:52:56', 8, 1, '5000', 'keluar', 4, 8),
(25, 5, '2026-01-28 22:54:26', '2026-01-28 22:55:10', 8, 1, '5000', 'keluar', 4, 11),
(26, 10, '2026-01-28 22:55:25', '2026-01-28 23:00:33', 7, 1, '2000', 'keluar', 4, 9),
(27, 7, '2026-01-28 22:55:32', '2026-01-28 22:55:53', 8, 1, '5000', 'keluar', 4, 9),
(28, 5, '2026-01-28 23:00:52', '2026-01-28 23:04:58', 7, 1, '2000', 'keluar', 4, 11),
(29, 10, '2026-01-28 23:01:04', '2026-01-31 23:27:27', 8, 73, '365000', 'keluar', 4, 9),
(30, 11, '2026-01-28 23:01:19', '2026-01-31 23:20:34', 7, 73, '146000', 'keluar', 4, 11),
(31, 15, '2026-01-28 23:04:46', '2026-01-28 23:15:01', 8, 1, '5000', 'keluar', 4, 11),
(32, 7, '2026-01-28 23:15:17', '2026-01-28 23:59:10', 7, 1, '2000', 'keluar', 4, 11),
(33, 9, '2026-01-28 23:15:37', '2026-01-28 23:15:44', 7, 1, '2000', 'keluar', 4, 11),
(34, 10, '2026-01-28 23:16:00', '2026-01-28 23:30:31', 8, 1, '5000', 'keluar', 4, 9),
(35, 11, '2026-01-28 23:34:17', '2026-01-28 23:34:48', 7, 1, '2000', 'keluar', 4, 9),
(36, 11, '2026-01-28 23:35:19', NULL, 8, NULL, NULL, 'masuk', 4, 8),
(37, 16, '2026-01-29 00:22:00', NULL, 8, NULL, NULL, 'masuk', 4, 11),
(38, 11, '2026-01-29 00:22:17', NULL, 8, NULL, NULL, 'masuk', 4, 7),
(39, 9, '2026-01-29 00:22:36', NULL, 7, NULL, NULL, 'masuk', 4, 7),
(40, 11, '2026-01-31 23:22:45', NULL, 7, NULL, NULL, 'masuk', 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','petugas','owner') DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status_aktif`) VALUES
(2, 'bilkis', 'admin', '$2y$10$mPxmzh6duDu44xoBHsdF0eS9g1wgJ8CRn8wuvUsInZ0gCaN.xwRAC', 'admin', 1),
(4, 'radiva', 'radiva', '$2y$10$iOn4oI/cKjRS1rcRE9W8d.agVF96UYsl0qeTItH4Zj3NuhvGRKaF6', 'petugas', 1),
(20, 'Akbar', 'owner', '$2y$10$PQmYglcFuRPQ0xwJkXIOAOhkf89j3geMrnI8B11ONlckkpDteB6kG', 'owner', 1),
(22, 'budi', 'budi', '$2y$10$e4Z2XBD2W0fM8Mhs86gNaOZKkFmwmXlr45GJtWuoG.rIGQTtwdhK6', 'owner', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `fk_kendaraan_user` (`id_user`);

--
-- Indexes for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_log_user` (`id_user`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `fk_transaksi_kendaraan` (`id_kendaraan`),
  ADD KEY `fk_transaksi_tarif` (`id_tarif`),
  ADD KEY `fk_transaksi_user` (`id_user`),
  ADD KEY `fk_transaksi_area` (`id_area`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id_area` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD CONSTRAINT `fk_kendaraan_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk_transaksi_area` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
