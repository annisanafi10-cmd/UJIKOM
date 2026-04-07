-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Apr 2026 pada 17.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_user`, `nama_user`, `aktivitas`, `waktu`) VALUES
(1, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-16 07:20:14'),
(2, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-16 07:45:16'),
(3, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-16 07:48:51'),
(4, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-16 08:06:27'),
(5, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-16 08:06:34'),
(6, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-16 08:07:14'),
(7, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-16 08:07:25'),
(8, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-16 08:12:47'),
(9, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-16 08:12:59'),
(10, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-16 08:45:42'),
(11, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-16 08:45:52'),
(12, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 01:48:58'),
(13, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 01:49:35'),
(14, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 01:57:01'),
(15, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 01:57:16'),
(16, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 01:58:01'),
(17, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 01:58:10'),
(18, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:07:27'),
(19, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:07:38'),
(20, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:11:49'),
(21, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:11:58'),
(22, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:12:06'),
(23, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:12:20'),
(24, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:12:29'),
(25, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:12:40'),
(26, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:13:41'),
(27, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:13:54'),
(28, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:14:42'),
(29, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:14:52'),
(30, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:15:39'),
(31, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:15:52'),
(32, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:16:17'),
(33, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:16:27'),
(34, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:25:27'),
(35, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:25:43'),
(36, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 02:56:39'),
(37, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 02:56:53'),
(38, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 06:22:50'),
(39, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 06:23:04'),
(40, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 06:23:58'),
(41, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 06:24:08'),
(42, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 06:47:06'),
(43, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 06:47:20'),
(44, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 06:48:56'),
(45, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 06:49:06'),
(46, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 06:55:04'),
(47, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 06:55:13'),
(48, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-21 06:55:30'),
(49, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 07:00:32'),
(50, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 07:01:43'),
(51, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-21 07:01:56'),
(52, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-21 07:03:08'),
(53, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 07:03:19'),
(54, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 07:03:55'),
(55, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 07:04:09'),
(56, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-21 07:04:18'),
(57, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-21 07:04:30'),
(58, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-21 07:04:56'),
(59, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 07:05:06'),
(60, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-21 08:42:09'),
(61, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:00:19'),
(62, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:00:56'),
(63, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:01:07'),
(64, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:02:15'),
(65, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:02:26'),
(66, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:03:14'),
(67, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:03:28'),
(68, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:06:20'),
(69, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:06:29'),
(70, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:10:11'),
(71, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:10:23'),
(72, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:12:35'),
(73, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:12:46'),
(74, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:18:38'),
(75, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:18:52'),
(76, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-02-22 22:24:56'),
(77, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-22 22:25:06'),
(78, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-02-23 04:37:46'),
(79, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-02-23 04:47:38'),
(80, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-02-23 04:47:52'),
(81, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-02-23 04:54:36'),
(82, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-23 04:54:48'),
(83, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-02-23 09:07:31'),
(84, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-03-11 15:20:38'),
(85, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-03-11 15:24:31'),
(86, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-03-11 15:24:40'),
(87, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-03-11 15:25:24'),
(88, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-03-11 15:25:35'),
(89, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-03-31 00:16:23'),
(90, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-03-31 01:06:23'),
(91, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-03-31 01:06:39'),
(92, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-03-31 01:22:21'),
(93, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-03-31 01:22:30'),
(94, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-03-31 01:23:26'),
(95, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-03-31 01:23:31'),
(96, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-03-31 01:34:17'),
(97, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-03-31 01:35:48'),
(98, 1, 'admin', 'Logout: Berhasil keluar dari sistem', '2026-03-31 01:36:17'),
(99, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-03-31 01:36:27'),
(100, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-03-31 01:49:16'),
(101, 2, 'petugas', 'Login: Berhasil masuk ke sistem', '2026-03-31 01:49:31'),
(102, 2, 'petugas', 'Logout: Berhasil keluar dari sistem', '2026-03-31 02:12:00'),
(103, 3, 'peminjam', 'Login: Berhasil masuk ke sistem', '2026-03-31 02:12:08'),
(104, 3, 'peminjam', 'Logout: Berhasil keluar dari sistem', '2026-03-31 02:17:11'),
(105, 3, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-03-31 02:18:53'),
(106, 3, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-03-31 02:20:13'),
(107, 2, 'ferlita', 'Login: Berhasil masuk ke sistem', '2026-03-31 02:20:27'),
(108, 2, 'ferlita', 'Logout: Berhasil keluar dari sistem', '2026-03-31 02:27:13'),
(109, 1, 'hendra', 'Login: Berhasil masuk ke sistem', '2026-03-31 02:27:28'),
(110, 3, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-05 09:49:28'),
(111, 3, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 09:51:06'),
(112, 2, 'lilis', 'Login: Berhasil masuk ke sistem', '2026-04-05 09:51:17'),
(113, 2, 'lilis', 'Logout: Berhasil keluar dari sistem', '2026-04-05 09:51:59'),
(114, 1, 'dimas', 'Login: Berhasil masuk ke sistem', '2026-04-05 09:52:08'),
(115, 1, 'dimas', 'Login: Berhasil masuk ke sistem', '2026-04-05 11:06:47'),
(116, 1, 'dera', 'Login: Berhasil masuk ke sistem', '2026-04-05 11:15:36'),
(117, 1, 'deraa', 'Login: Berhasil masuk ke sistem', '2026-04-05 11:41:23'),
(118, 1, 'deraa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 12:41:14'),
(119, 3, 'kyna', 'Login: Berhasil masuk ke sistem', '2026-04-05 12:41:31'),
(120, 3, 'kyna', 'Logout: Berhasil keluar dari sistem', '2026-04-05 12:45:47'),
(121, 2, 'tala', 'Login: Berhasil masuk ke sistem', '2026-04-05 12:45:56'),
(122, 2, 'tala', 'Logout: Berhasil keluar dari sistem', '2026-04-05 12:47:12'),
(123, 2, 'sakha', 'Login: Berhasil masuk ke sistem', '2026-04-05 12:47:46'),
(124, 2, 'sakha', 'Logout: Berhasil keluar dari sistem', '2026-04-05 12:47:56'),
(125, 3, 'sakha', 'Login: Berhasil masuk ke sistem', '2026-04-05 12:48:02'),
(126, 3, 'sakha', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:01:03'),
(127, 2, 'dera', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:01:10'),
(128, 2, 'dera', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:02:00'),
(129, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:02:07'),
(130, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:04:08'),
(131, 3, 'tala', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:04:16'),
(132, 3, 'tala', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:05:27'),
(133, 2, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:05:39'),
(134, 2, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:09:23'),
(135, 3, 'sakha', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:09:32'),
(136, 3, 'sakha', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:10:22'),
(137, 2, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:10:30'),
(138, 2, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:10:44'),
(139, 3, 'tala', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:10:54'),
(140, 3, 'tala', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:11:15'),
(141, 2, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-05 13:11:28'),
(142, 2, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 13:23:59'),
(143, 1, 'dera', 'Logout: Berhasil keluar dari sistem', '2026-04-05 14:28:52'),
(144, 4, 'sakhaa', 'Login: Berhasil masuk ke sistem', '2026-04-05 14:43:27'),
(145, 4, 'sakhaa', 'Logout: Berhasil keluar dari sistem', '2026-04-05 14:44:08'),
(146, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-06 01:15:27'),
(147, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-06 01:16:03'),
(148, 3, 'ica', 'Login: Berhasil masuk ke sistem', '2026-04-06 01:16:14'),
(149, 3, 'ica', 'Logout: Berhasil keluar dari sistem', '2026-04-06 01:16:47'),
(150, 2, 'dera', 'Login: Berhasil masuk ke sistem', '2026-04-06 01:17:00'),
(151, 2, 'dera', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:00:09'),
(152, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:00:23'),
(153, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:01:07'),
(154, 1, 'dimas', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:03:02'),
(155, 1, 'dimas', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:07:10'),
(156, 5, 'kurnia', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:07:19'),
(157, 5, 'kurnia', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:07:30'),
(158, 1, 'windah', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:07:38'),
(159, 1, 'windah', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:10:05'),
(160, 1, 'annisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:21:26'),
(161, 1, 'annisa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:24:40'),
(162, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:28:53'),
(163, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 01:29:13'),
(164, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 01:52:05'),
(165, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 02:07:19'),
(166, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 02:07:39'),
(167, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 02:13:23'),
(168, 1, 'sintia', 'Login: Berhasil masuk ke sistem', '2026-04-07 02:13:34'),
(169, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-04-07 12:01:00'),
(170, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-04-07 12:05:59'),
(171, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-04-07 12:29:35'),
(172, 1, 'admin', 'Login: Berhasil masuk ke sistem', '2026-04-07 12:29:54'),
(173, 1, 'raka', 'Login: Berhasil masuk ke sistem', '2026-04-07 12:32:43'),
(174, 1, 'raka', 'Logout: Berhasil keluar dari sistem', '2026-04-07 13:11:55'),
(175, 1, 'sakhaa', 'Login: Berhasil masuk ke sistem', '2026-04-07 13:12:20'),
(176, 1, 'sakhaa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 13:12:29'),
(177, 4, 'sakhaa', 'Login: Berhasil masuk ke sistem', '2026-04-07 13:12:36'),
(178, 4, 'sakhaa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 13:27:46'),
(179, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 13:27:55'),
(180, 1, 'nisa', 'Logout: Berhasil keluar dari sistem', '2026-04-07 14:26:19'),
(181, 2, 'raka', 'Login: Berhasil masuk ke sistem', '2026-04-07 14:26:31'),
(182, 2, 'raka', 'Logout: Berhasil keluar dari sistem', '2026-04-07 14:32:28'),
(183, 1, 'nisa', 'Login: Berhasil masuk ke sistem', '2026-04-07 14:32:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alat`
--

CREATE TABLE `tb_alat` (
  `id_alat` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_alat` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('tersedia','tidak tersedia') DEFAULT 'tersedia',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_alat`
--

INSERT INTO `tb_alat` (`id_alat`, `id_kategori`, `nama_alat`, `stok`, `status`, `deleted_at`) VALUES
(1, 1, 'kamera', 7, 'tersedia', NULL),
(2, 2, 'layar presentasi', 8, 'tersedia', '2026-04-05 16:52:38'),
(3, 2, 'proyektor', 7, 'tersedia', NULL),
(4, 1, 'speaker', 12, 'tersedia', NULL),
(5, 1, 'webcam', 8, 'tersedia', NULL),
(6, 1, 'tripod', 5, 'tersedia', NULL),
(7, 2, 'pointer', 5, 'tersedia', NULL),
(9, 2, 'layar presentasi', 0, 'tidak tersedia', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(150) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `deleted_at`) VALUES
(1, 'perangkat multimedia', NULL),
(2, 'perangkat presentasi', NULL),
(7, 'Kategori_Tes_1775561433', '2026-04-07 19:08:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_dikembalikan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak','kembali','dibatalkan') DEFAULT 'menunggu',
  `alasan_tolak` text DEFAULT NULL,
  `alasan_tolak_kembali` text DEFAULT NULL,
  `nama_peminjam` varchar(25) DEFAULT NULL,
  `kategori_peminjam` enum('siswa','guru','pegawai') DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `id_user`, `id_alat`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `jumlah`, `catatan`, `status`, `alasan_tolak`, `alasan_tolak_kembali`, `nama_peminjam`, `kategori_peminjam`, `deleted_at`) VALUES
(1, 3, 3, '2026-04-05', '2026-04-06', '0000-00-00', 1, '', 'kembali', NULL, NULL, NULL, NULL, NULL),
(2, 3, 4, '2026-04-05', '2026-04-06', '0000-00-00', 1, '', 'disetujui', NULL, NULL, NULL, NULL, NULL),
(3, 3, 4, '2026-04-06', '2026-04-07', '0000-00-00', 1, '', 'disetujui', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `email`, `password`, `role`, `deleted_at`) VALUES
(1, 'nisa', 'admin', 'adminn10@gmail.com', '4fbd41a36dac3cd79aa1041c9648ab89', 'admin', NULL),
(2, 'dera', 'petugas', 'petugass10@gmail.com', '559d08762ee146fcd4203bde5d14c0e2', 'petugas', NULL),
(3, 'ica', NULL, 'peminjaman10@gmail.com', '912feac441156ff3cfca25cd4177d0be', 'peminjam', '2026-04-07 09:13:49'),
(4, 'sakhaa', 'sakha10', '', '5ef020e63b325c87d517004c83c8ea4e', 'peminjam', NULL),
(5, 'kurnia', 'kkure', '', '56f488a0eda2227b26bb868b5769a200', 'peminjam', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `tb_alat`
--
ALTER TABLE `tb_alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `fk_pinjam_alat` (`id_alat`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT untuk tabel `tb_alat`
--
ALTER TABLE `tb_alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_alat`
--
ALTER TABLE `tb_alat`
  ADD CONSTRAINT `fk_alat_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `fk_pinjam_alat` FOREIGN KEY (`id_alat`) REFERENCES `tb_alat` (`id_alat`),
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `tb_alat` (`id_alat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
