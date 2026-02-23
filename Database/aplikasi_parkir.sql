-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Feb 2026 pada 08.16
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 8.3.8

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
-- Struktur dari tabel `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(50) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `terisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data untuk tabel `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(1, 'Luar Utara', 30, 2),
(2, 'Basement', 50, 2),
(3, 'Gedung A', 20, 1),
(5, 'Gedung B', 15, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `plat_nomor` varchar(15) DEFAULT NULL,
  `jenis_kendaraan` varchar(20) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data untuk tabel `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`, `pemilik`, `id_user`) VALUES
(1, 'B 1234 VZ', 'motor', NULL, NULL, 4),
(2, 'Z 2233 AA', 'mobil', NULL, NULL, 4),
(3, 'D 3467 GH', 'motor', NULL, NULL, 4),
(4, 'B 7891 AA', 'mobil', NULL, NULL, 4),
(5, 'B 1987 G', 'motor', NULL, NULL, 4),
(6, 'T 5437H', 'mobil', NULL, NULL, 4),
(7, 'F 4578J', 'motor', NULL, NULL, 4),
(8, 'C 5489H', 'motor', NULL, NULL, 4),
(9, 'B 12345 H', 'motor', NULL, NULL, 4),
(10, 'B 1234H', 'mobil', NULL, NULL, 4),
(11, 'B 1234 BB', 'motor', NULL, NULL, 4),
(12, 'Z 1212 AC', 'Motor', 'Merah', '-', 4),
(16, 'B 1213 ZZ', 'motor', NULL, NULL, 4),
(17, 'J 5690KI', 'mobil', NULL, NULL, 4),
(18, 'D 3789 IK', 'motor', NULL, NULL, 4),
(19, 'M 3456 T', 'Mobil', 'Hitam ', 'ardeng', NULL),
(20, 'D1235 H', 'mobil', NULL, NULL, 4),
(21, 'B 123T CU', 'mobil', NULL, NULL, 4),
(22, 'B 123T TV', 'mobil', NULL, NULL, 4),
(23, 'K 3789AJ', 'motor', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` varchar(100) DEFAULT NULL,
  `waktu_aktivitas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data untuk tabel `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu_aktivitas`) VALUES
(1, 2, 'Login ke sistem sebagai admin', '2026-01-29 19:19:43'),
(2, 2, 'Hapus User ID 1', '2026-01-29 19:27:26'),
(3, 2, 'Tambah User', '2026-01-29 19:27:54'),
(4, 2, 'Tambah User', '2026-01-29 19:36:40'),
(5, 2, 'Tambah Tarif: motor - Rp 3000', '2026-01-29 19:36:55'),
(6, 2, 'Tambah Tarif: mobil - Rp 5000', '2026-01-29 19:37:09'),
(7, 2, 'Tambah Area: Luar Utara (Kapasitas: 30)', '2026-01-29 19:37:36'),
(8, 2, 'Tambah Area: Basement (Kapasitas: 50)', '2026-01-29 19:38:22'),
(9, 2, 'Logout dari sistem', '2026-01-29 19:38:38'),
(10, 4, 'Login ke sistem sebagai petugas', '2026-01-29 19:39:01'),
(11, 4, 'Logout dari sistem', '2026-01-29 19:46:10'),
(12, 3, 'Login ke sistem sebagai owner', '2026-01-29 19:46:31'),
(13, 3, 'Logout dari sistem', '2026-01-29 19:49:10'),
(14, 2, 'Login ke sistem sebagai admin', '2026-01-29 19:49:32'),
(15, 2, 'Logout dari sistem', '2026-01-29 19:52:04'),
(16, 2, 'Login ke sistem sebagai admin', '2026-01-29 19:53:01'),
(17, 2, 'Tambah User', '2026-01-29 19:54:12'),
(18, 2, 'Logout dari sistem', '2026-01-29 19:55:33'),
(19, 3, 'Login ke sistem sebagai owner', '2026-01-29 19:56:02'),
(20, 3, 'Logout dari sistem', '2026-01-29 19:56:07'),
(21, 3, 'Login ke sistem sebagai owner', '2026-01-29 19:56:41'),
(22, 3, 'Logout dari sistem', '2026-01-29 19:56:53'),
(23, 4, 'Login ke sistem sebagai petugas', '2026-01-29 19:57:12'),
(24, 4, 'Logout dari sistem', '2026-01-29 19:59:33'),
(25, 2, 'Login ke sistem sebagai admin', '2026-01-29 21:00:58'),
(26, 2, 'Logout dari sistem', '2026-01-29 21:02:42'),
(27, 4, 'Login ke sistem sebagai petugas', '2026-01-29 21:02:57'),
(28, 4, 'Logout dari sistem', '2026-01-29 21:05:07'),
(29, 3, 'Login ke sistem sebagai owner', '2026-01-29 21:05:24'),
(30, 3, 'Logout dari sistem', '2026-01-29 21:05:59'),
(31, 2, 'Login ke sistem sebagai admin', '2026-01-30 05:10:57'),
(32, 4, 'Login ke sistem sebagai petugas', '2026-01-30 05:12:52'),
(33, 4, 'Logout dari sistem', '2026-01-30 05:13:37'),
(34, 3, 'Login ke sistem sebagai owner', '2026-01-30 05:13:51'),
(35, 3, 'Logout dari sistem', '2026-01-30 05:14:09'),
(36, 2, 'Login ke sistem sebagai admin', '2026-01-30 14:38:18'),
(37, 2, 'Login ke sistem sebagai admin', '2026-01-31 16:25:31'),
(38, 2, 'Edit User', '2026-01-31 16:26:24'),
(39, 2, 'Edit User', '2026-01-31 16:27:53'),
(40, 2, 'Edit User', '2026-01-31 16:28:06'),
(41, 2, 'Logout dari sistem', '2026-01-31 16:28:31'),
(42, 2, 'Login ke sistem sebagai admin', '2026-01-31 16:28:52'),
(43, 2, 'Login ke sistem sebagai admin', '2026-01-31 16:28:53'),
(44, 2, 'Logout dari sistem', '2026-01-31 16:29:08'),
(45, 2, 'Logout dari sistem', '2026-01-31 16:29:08'),
(46, 4, 'Login ke sistem sebagai petugas', '2026-01-31 16:29:24'),
(47, 4, 'Logout dari sistem', '2026-01-31 16:30:19'),
(48, 3, 'Login ke sistem sebagai owner', '2026-01-31 16:30:35'),
(49, 3, 'Logout dari sistem', '2026-01-31 16:31:14'),
(50, 2, 'Login ke sistem sebagai admin', '2026-02-01 08:35:40'),
(51, 2, 'Logout dari sistem', '2026-02-01 08:37:22'),
(52, 4, 'Login ke sistem sebagai petugas', '2026-02-01 08:37:42'),
(53, 4, 'Logout dari sistem', '2026-02-01 08:38:31'),
(54, 3, 'Login ke sistem sebagai owner', '2026-02-01 08:38:51'),
(55, 3, 'Logout dari sistem', '2026-02-01 08:39:08'),
(56, 2, 'Login ke sistem sebagai admin', '2026-02-03 10:39:48'),
(57, 4, 'Login ke sistem sebagai petugas', '2026-02-04 13:12:58'),
(58, 4, 'Login ke sistem sebagai petugas', '2026-02-04 13:23:16'),
(59, 4, 'Logout dari sistem', '2026-02-04 13:24:48'),
(60, 2, 'Login ke sistem sebagai admin', '2026-02-04 15:08:58'),
(61, 2, 'Logout dari sistem', '2026-02-04 15:09:55'),
(62, 4, 'Login ke sistem sebagai petugas', '2026-02-04 15:10:09'),
(63, 4, 'Logout dari sistem', '2026-02-04 15:10:58'),
(64, 4, 'Login ke sistem sebagai petugas', '2026-02-04 15:11:44'),
(65, 4, 'Logout dari sistem', '2026-02-04 15:12:03'),
(66, 3, 'Login ke sistem sebagai owner', '2026-02-04 15:12:16'),
(67, 3, 'Logout dari sistem', '2026-02-04 15:12:42'),
(68, 2, 'Login ke sistem sebagai admin', '2026-02-04 15:14:16'),
(69, 2, 'Login ke sistem sebagai admin', '2026-02-04 15:20:17'),
(70, 2, 'Login ke sistem sebagai admin', '2026-02-04 15:39:01'),
(71, 2, 'Login ke sistem sebagai admin', '2026-02-04 19:30:17'),
(72, 2, 'Logout dari sistem', '2026-02-04 19:31:13'),
(73, 4, 'Login ke sistem sebagai petugas', '2026-02-04 19:31:30'),
(74, 4, 'Logout dari sistem', '2026-02-04 19:31:41'),
(75, 3, 'Login ke sistem sebagai owner', '2026-02-04 19:31:58'),
(76, 3, 'Logout dari sistem', '2026-02-04 19:33:32'),
(77, 2, 'Login ke sistem sebagai admin', '2026-02-04 19:33:55'),
(78, 4, 'Login ke sistem sebagai petugas', '2026-02-04 19:34:35'),
(79, 4, 'Logout dari sistem', '2026-02-04 19:34:43'),
(80, 3, 'Login ke sistem sebagai owner', '2026-02-04 19:34:54'),
(81, 2, 'Login ke sistem sebagai admin', '2026-02-04 21:28:58'),
(82, 2, 'Login ke sistem sebagai admin', '2026-02-04 21:55:54'),
(83, 4, 'Login ke sistem sebagai petugas', '2026-02-05 07:40:29'),
(84, 4, 'Logout dari sistem', '2026-02-05 07:42:21'),
(85, 2, 'Login ke sistem sebagai admin', '2026-02-05 07:42:32'),
(86, 5, 'Login ke sistem sebagai admin', '2026-02-05 09:42:05'),
(87, 5, 'Login ke sistem sebagai admin', '2026-02-05 09:46:39'),
(88, 5, 'Login ke sistem sebagai admin', '2026-02-09 12:11:40'),
(89, 5, 'Logout dari sistem', '2026-02-09 12:16:15'),
(90, 4, 'Login ke sistem sebagai petugas', '2026-02-09 12:16:33'),
(91, 5, 'Login ke sistem sebagai admin', '2026-02-11 14:33:38'),
(92, 4, 'Login ke sistem sebagai petugas', '2026-02-11 14:34:37'),
(93, 4, 'Logout dari sistem', '2026-02-11 14:35:09'),
(94, 3, 'Login ke sistem sebagai owner', '2026-02-11 14:35:41'),
(95, 4, 'Login ke sistem sebagai petugas', '2026-02-11 15:13:17'),
(96, 4, 'Login ke sistem sebagai petugas', '2026-02-11 15:19:43'),
(97, 4, 'Logout dari sistem', '2026-02-11 15:20:17'),
(98, 2, 'Login ke sistem sebagai admin', '2026-02-11 15:20:32'),
(99, 3, 'Login ke sistem sebagai owner', '2026-02-11 15:32:19'),
(100, 3, 'Logout dari sistem', '2026-02-11 15:37:26'),
(101, 2, 'Login ke sistem sebagai admin', '2026-02-11 15:38:21'),
(102, 2, 'Logout dari sistem', '2026-02-11 15:39:57'),
(103, 4, 'Login ke sistem sebagai petugas', '2026-02-11 15:40:11'),
(104, 4, 'Logout dari sistem', '2026-02-11 15:40:15'),
(105, 3, 'Login ke sistem sebagai owner', '2026-02-11 15:42:14'),
(106, 3, 'Logout dari sistem', '2026-02-11 15:50:59'),
(107, 2, 'Login ke sistem sebagai admin', '2026-02-11 15:51:14'),
(108, 2, 'Logout dari sistem', '2026-02-11 15:51:33'),
(109, 3, 'Login ke sistem sebagai owner', '2026-02-11 15:51:46'),
(110, 3, 'Logout dari sistem', '2026-02-11 15:52:30'),
(111, 4, 'Login ke sistem sebagai petugas', '2026-02-11 16:13:13'),
(112, 4, 'Logout dari sistem', '2026-02-11 16:55:08'),
(113, 2, 'Login ke sistem sebagai admin', '2026-02-11 16:58:02'),
(114, 2, 'Hapus Tarif ID: 3', '2026-02-11 17:35:43'),
(115, 2, 'Tambah Tarif: motor - Rp 1000', '2026-02-11 17:35:49'),
(116, 2, 'Hapus Tarif ID: 4', '2026-02-11 17:35:56'),
(117, 2, 'Tambah Area: Gedung A (Kapasitas: 20)', '2026-02-11 17:36:09'),
(118, 2, 'Tambah Kendaraan: B 1122 ZZ (Motor)', '2026-02-11 17:36:44'),
(119, 2, 'Hapus Kendaraan ID: 13', '2026-02-11 17:36:54'),
(120, 2, 'Update Kendaraan: Z 1212 AC', '2026-02-11 17:37:17'),
(121, 2, 'Tambah User: Agus', '2026-02-11 17:40:56'),
(122, 2, 'Edit User: Jamal', '2026-02-11 17:41:12'),
(123, 2, 'Hapus User: Jamal', '2026-02-11 17:41:24'),
(124, 2, 'Logout dari sistem', '2026-02-11 17:52:28'),
(125, 2, 'Login ke sistem sebagai admin', '2026-02-11 17:57:44'),
(126, 2, 'Logout dari sistem', '2026-02-11 17:57:58'),
(127, 4, 'Login ke sistem sebagai petugas', '2026-02-11 17:58:25'),
(128, 4, 'Logout dari sistem', '2026-02-11 17:59:00'),
(129, 2, 'Login ke sistem sebagai admin', '2026-02-11 17:59:09'),
(130, 2, 'Logout dari sistem', '2026-02-11 17:59:39'),
(131, 3, 'Login ke sistem sebagai owner', '2026-02-11 18:00:05'),
(132, 3, 'Logout dari sistem', '2026-02-11 18:01:37'),
(133, 2, 'Login ke sistem sebagai admin', '2026-02-11 18:02:07'),
(134, 2, 'Tambah User: toji', '2026-02-11 18:02:45'),
(135, 2, 'Hapus User: toji', '2026-02-11 18:03:03'),
(136, 2, 'Tambah Area: Besment 2 (Kapasitas: 20)', '2026-02-11 18:03:45'),
(137, 2, 'Mengubah tarif motor menjadi Rp 4000', '2026-02-11 18:09:35'),
(138, 2, 'Mengubah tarif motor menjadi Rp 3000', '2026-02-11 18:09:47'),
(139, 2, 'Menambah area parkir: Gedung B (Kapasitas: 10)', '2026-02-11 18:10:00'),
(140, 2, 'Mengupdate area Gedung B (Kapasitas baru: 15)', '2026-02-11 18:10:09'),
(141, 2, 'Update Kendaraan: Z 1212 AC', '2026-02-11 18:15:01'),
(142, 2, 'Update Area: Besment 2 (Kapasitas: 21)', '2026-02-11 18:15:27'),
(143, 2, 'Hapus area ID: 4', '2026-02-11 18:15:32'),
(144, 2, 'Hapus kendaraan ID: 14', '2026-02-11 18:18:39'),
(145, 2, 'Update Tarif: motor', '2026-02-11 18:18:55'),
(146, 2, 'Update Tarif: motor', '2026-02-11 18:19:08'),
(147, 2, 'Tambah Tarif: motor - Rp 1000', '2026-02-11 18:19:15'),
(148, 2, 'Hapus tarif ID: 5', '2026-02-11 18:19:20'),
(149, 2, 'Tambah Area: G (Kapasitas: 1)', '2026-02-11 18:19:31'),
(150, 2, 'Update Area: G (Kapasitas: 10)', '2026-02-11 18:19:40'),
(151, 2, 'Hapus area ID: 6', '2026-02-11 18:19:45'),
(152, 2, 'Tambah Kendaraan: b', '2026-02-11 18:19:58'),
(153, 2, 'Update Kendaraan: b', '2026-02-11 18:20:07'),
(154, 2, 'Hapus kendaraan ID: 15', '2026-02-11 18:20:14'),
(155, 2, 'Logout dari sistem', '2026-02-11 18:20:32'),
(156, 3, 'Login ke sistem sebagai owner', '2026-02-11 18:20:44'),
(157, 3, 'Logout dari sistem', '2026-02-11 18:21:00'),
(158, 4, 'Login ke sistem sebagai petugas', '2026-02-11 18:21:08'),
(159, 4, 'Logout dari sistem', '2026-02-11 18:21:45'),
(160, 3, 'Login ke sistem sebagai owner', '2026-02-11 18:21:56'),
(161, 3, 'Logout dari sistem', '2026-02-11 18:22:16'),
(162, 2, 'Login ke sistem sebagai admin', '2026-02-11 20:30:09'),
(163, 2, 'Tambah User: toji', '2026-02-11 20:30:51'),
(164, 2, 'Edit User: toji', '2026-02-11 20:31:09'),
(165, 2, 'Hapus User: toji', '2026-02-11 20:31:15'),
(166, 2, 'Update Tarif: motor', '2026-02-11 20:31:39'),
(167, 2, 'Update Tarif: motor', '2026-02-11 20:31:54'),
(168, 2, 'Update Kendaraan: Z 1212 AC', '2026-02-11 20:32:33'),
(169, 2, 'Logout dari sistem', '2026-02-11 20:33:43'),
(170, 4, 'Login ke sistem sebagai petugas', '2026-02-11 20:33:57'),
(171, 4, 'Logout dari sistem', '2026-02-11 20:34:45'),
(172, 3, 'Login ke sistem sebagai owner', '2026-02-11 20:34:57'),
(173, 3, 'Logout dari sistem', '2026-02-11 20:35:17'),
(174, 2, 'Login ke sistem sebagai admin', '2026-02-12 08:13:32'),
(175, 4, 'Login ke sistem sebagai petugas', '2026-02-12 08:16:03'),
(176, 4, 'Logout dari sistem', '2026-02-12 08:16:51'),
(177, 3, 'Login ke sistem sebagai owner', '2026-02-12 08:17:11'),
(178, 3, 'Logout dari sistem', '2026-02-12 08:17:25'),
(179, 2, 'Login ke sistem sebagai admin', '2026-02-12 08:17:34'),
(180, 2, 'Tambah User: arya', '2026-02-12 08:19:00'),
(181, 2, 'Edit User: arya', '2026-02-12 08:19:56'),
(182, 2, 'Hapus User: arya', '2026-02-12 08:20:04'),
(183, 2, 'Tambah Tarif: motor - Rp 5000', '2026-02-12 08:20:27'),
(184, 2, 'Hapus tarif ID: 1', '2026-02-12 08:20:34'),
(185, 2, 'Tambah Area: Luar Selatan  (Kapasitas: 15)', '2026-02-12 08:21:42'),
(186, 2, 'Update Area: Luar Selatan  (Kapasitas: 20)', '2026-02-12 08:21:55'),
(187, 2, 'Hapus area ID: 7', '2026-02-12 08:22:05'),
(188, 2, 'Tambah Kendaraan: M 3456 T', '2026-02-12 08:23:52'),
(189, 2, 'Update Kendaraan: M 3456 T', '2026-02-12 08:24:47'),
(190, 4, 'Login ke sistem sebagai petugas', '2026-02-13 13:27:35'),
(191, 4, 'Login ke sistem sebagai petugas', '2026-02-13 13:27:42'),
(192, 4, 'Logout dari sistem', '2026-02-13 13:29:38'),
(193, 2, 'Login ke sistem sebagai admin', '2026-02-13 13:30:04'),
(194, 2, 'Login ke sistem sebagai admin', '2026-02-17 20:11:18'),
(195, 2, 'Logout dari sistem', '2026-02-17 20:11:48'),
(196, 4, 'Login ke sistem sebagai petugas', '2026-02-17 20:12:00'),
(197, 4, 'Login ke sistem sebagai petugas', '2026-02-23 08:46:36'),
(198, 4, 'Logout dari sistem', '2026-02-23 08:49:00'),
(199, 5, 'Login ke sistem sebagai admin', '2026-02-23 08:49:09'),
(200, 4, 'Login ke sistem sebagai petugas', '2026-02-23 08:49:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int(11) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','lainnya') DEFAULT NULL,
  `tarif_per_jam` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data untuk tabel `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(2, 'mobil', 5000),
(6, 'motor', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int(11) NOT NULL,
  `id_kendaraan` int(11) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL,
  `durasi_jam` int(11) DEFAULT NULL,
  `biaya_total` decimal(10,0) DEFAULT NULL,
  `status` enum('masuk','keluar','') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `waktu_masuk`, `waktu_keluar`, `id_tarif`, `durasi_jam`, `biaya_total`, `status`, `id_user`, `id_area`) VALUES
(2, 2, '2026-01-29 19:44:28', '2026-01-29 19:44:51', 2, 1, 5000, 'keluar', 4, 1),
(4, 4, '2026-01-29 19:58:45', '2026-01-31 16:30:08', 2, 45, 225000, 'keluar', 4, 1),
(6, 6, '2026-01-30 05:13:13', '2026-02-01 08:38:24', 2, 52, 260000, 'keluar', 4, 2),
(10, 10, '2026-02-04 15:10:35', '2026-02-04 15:11:53', 2, 1, 5000, 'keluar', 4, 2),
(15, 17, '2026-02-11 20:34:23', '2026-02-11 20:34:39', 2, 1, 5000, 'keluar', 4, 5),
(17, 20, '2026-02-17 20:12:20', '2026-02-23 08:48:36', 2, 133, 665000, 'keluar', 4, 3),
(18, 21, '2026-02-23 08:47:11', NULL, 2, NULL, NULL, 'masuk', 4, 2),
(19, 21, '2026-02-23 08:48:12', NULL, 2, NULL, NULL, 'masuk', 4, 2),
(20, 22, '2026-02-23 08:48:12', NULL, 2, NULL, NULL, 'masuk', 4, 1),
(21, 23, '2026-02-23 08:50:05', NULL, 6, NULL, NULL, 'masuk', 4, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','petugas','owner') DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status_aktif`) VALUES
(2, 'radiva', 'radiva ', '$2y$10$/4EU6UDHTzHuyAarW/aJFujiZzEsjMapAh5fdEZ1byEeVDosxVICS', 'admin', 1),
(3, 'bilkis', 'bilkis', '$2y$10$p3HyLLNdvQGRV/36SD7uAecEktsdypvk8oMvlE/vT0QozqxI1LNkO', 'owner', 1),
(4, 'gajah', 'gajah', '$2y$10$vbtO.DS0Fu.nb5INZmg9Fuaz0DCRbN.K.inwvYN26evctbGJbNKnS', 'petugas', 1),
(5, 'masimo', 'masimo', '$2y$10$D2gThfDSzGz74hnmSM0Q..PTTojDQw6DpmV2U8NvWDHTYdwNIWnjG', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `fk_kendaraan_user` (`id_user`);

--
-- Indeks untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_log_user` (`id_user`);

--
-- Indeks untuk tabel `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `fk_transaksi_kendaraan` (`id_kendaraan`),
  ADD KEY `fk_transaksi_tarif` (`id_tarif`),
  ADD KEY `fk_transaksi_user` (`id_user`),
  ADD KEY `fk_transaksi_area` (`id_area`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT untuk tabel `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD CONSTRAINT `fk_kendaraan_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk_transaksi_area` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
