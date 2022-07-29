-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Apr 2022 pada 20.01
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spoki`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `agenda` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `waktu` date NOT NULL,
  `jam` time NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `agenda`, `penyelenggara`, `waktu`, `jam`, `tempat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Fakultaria FKI UMS', 'BEM FKI UMS', '2022-01-01', '08:00:00', 'Hall FKI UMS', NULL, NULL, NULL),
(3, 'Upgrading Bersama', 'BEM FKI UMS', '2022-03-21', '09:15:00', 'Fakultas Komunikasi dan Informatika', NULL, '2022-04-27 22:06:29', NULL),
(5, 'Dekan Cup FKI', 'BEM FKI UMS', '2022-03-27', '21:00:00', 'GOR UMS Kampus 2', NULL, NULL, NULL),
(7, 'Anjangsana BEM FKI x BEM KM UGM', 'BEM FKI UMS', '2022-03-27', '10:00:00', 'Gedung J FKI, UMSurakarta', NULL, NULL, NULL),
(8, 'ICCEE', 'DOSEN & MAHASISWA FKI UMS', '2022-09-24', '07:00:00', 'Gedung Induk Siti Walidah lt. 7', NULL, NULL, NULL),
(9, 'Makrab Ormawa FKI', 'BEM FKI UMS x ORMAWA FKI', '2022-04-24', '17:30:00', 'Villa Indah Sekali II, Kalisoro, Tawangmangu', NULL, NULL, NULL),
(10, 'Pameran Besar FINIC UMS', 'FINIC UMS', '2022-08-20', '08:30:00', 'Gedung Edutorium UMS', NULL, NULL, NULL),
(11, 'KINEMA #15', 'KINE CLUB UMS', '2022-11-29', '07:45:00', 'Auditorium Muh. Djazman UMS', NULL, NULL, NULL),
(12, 'Fakultaria FKI UMS', 'BEM FKI UMS', '2022-04-22', '08:00:00', 'Gedung J Fakultas Komunikasi dan Informatika, Unmuh Surakarta', '2022-04-24 17:02:25', '2022-04-24 17:02:25', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'admin pengelola per ormawa'),
(2, 'superadmin', 'pengelola admin dan selebihnya'),
(3, 'adm_bem', 'kelola bem'),
(4, 'adm_dpm', 'kelola dpm'),
(5, 'adm_lpm', 'kelola lpm'),
(6, 'adm_himatif', 'kelola himatif'),
(7, 'adm_himakom', 'kelola himakom'),
(8, 'adm_finic', 'kelola finic'),
(9, 'adm_kine', 'kelola kine'),
(10, 'adm_fosti', 'kelola fosti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(3, 8),
(4, 10),
(5, 11),
(6, 12),
(7, 13),
(8, 14),
(9, 15),
(10, 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'u', NULL, '2022-02-14 05:52:48', 0),
(2, '::1', 'u', NULL, '2022-02-15 19:12:36', 0),
(3, '::1', 'ivann', NULL, '2022-03-20 05:10:46', 0),
(4, '::1', 'ivan.rivai6921@gmail.com', NULL, '2022-03-20 05:33:02', 0),
(5, '::1', 'bemfkiums', 2, '2022-03-20 05:33:20', 0),
(6, '::1', 'spokiums@gmail.com', 3, '2022-03-20 05:56:18', 0),
(7, '::1', 'ivan.rivai6921@gmail.com', NULL, '2022-03-20 06:58:46', 0),
(8, '::1', 'ivan.rivai6921@gmail.com', 4, '2022-03-20 06:58:54', 0),
(9, '::1', 'bemfkiums', 5, '2022-03-20 07:03:05', 0),
(10, '::1', 'bemfkiums', 5, '2022-03-20 07:11:36', 0),
(11, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-26 22:36:56', 1),
(12, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-26 23:20:47', 1),
(13, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-26 23:53:33', 1),
(14, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-27 02:24:36', 1),
(15, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-27 02:25:34', 1),
(16, '::1', 'bemfkiums', NULL, '2022-03-27 02:28:33', 0),
(17, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-27 02:28:44', 1),
(18, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-27 02:35:01', 1),
(19, '::1', 'l200180214@student.ums.ac.id', NULL, '2022-03-27 03:26:21', 0),
(20, '::1', 'l200180214@student.ums.ac.id', 9, '2022-03-27 03:26:52', 0),
(21, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-27 03:28:56', 1),
(22, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-27 11:15:38', 1),
(23, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-28 06:58:27', 1),
(24, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-28 08:17:42', 1),
(25, '::1', 'ivan.rivai21@gmail.com', 14, '2022-03-28 08:23:07', 1),
(26, '::1', 'ivan.rivai21@gmail.com', 14, '2022-03-28 08:23:43', 1),
(27, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-28 08:25:49', 1),
(28, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-28 08:37:09', 1),
(29, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-28 21:37:02', 1),
(30, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-28 21:43:42', 1),
(31, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-28 21:46:35', 1),
(32, '::1', 'bemfkiums', NULL, '2022-03-28 21:50:05', 0),
(33, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-28 21:50:13', 1),
(34, '::1', 'bemfkiums', NULL, '2022-03-28 22:14:08', 0),
(35, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-28 22:14:18', 1),
(36, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 05:51:49', 1),
(37, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 06:55:45', 1),
(38, '::1', 'fostiums', NULL, '2022-03-29 06:56:29', 0),
(39, '::1', 'fostiums', NULL, '2022-03-29 06:56:41', 0),
(40, '::1', 'fostiums', NULL, '2022-03-29 06:57:12', 0),
(41, '::1', 'fostiums', NULL, '2022-03-29 06:57:26', 0),
(42, '::1', 'irvanrifai23@yahoo.com', 15, '2022-03-29 06:58:21', 1),
(43, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 07:10:49', 1),
(44, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-29 07:11:39', 1),
(45, '::1', 'ivan.rivai@gmail.com', 12, '2022-03-29 07:15:14', 1),
(46, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 07:43:51', 1),
(47, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-29 07:45:00', 1),
(48, '::1', 'spokiums@gmail.com', 11, '2022-03-29 07:45:25', 1),
(49, '::1', 'ivan.rivai@gmail.com', 12, '2022-03-29 07:46:37', 1),
(50, '::1', 'ivan.rivai69@gmail.com', 13, '2022-03-29 07:50:20', 1),
(51, '::1', 'ivan.rivai21@gmail.com', 14, '2022-03-29 07:50:48', 1),
(52, '::1', 'ivan.rivai21@gmail.com', 14, '2022-03-29 07:53:19', 1),
(53, '::1', 'irvanrifai23@yahoo.com', 15, '2022-03-29 07:54:39', 1),
(54, '::1', 'irvanrifai646@yahoo.com', 19, '2022-03-29 07:55:08', 1),
(55, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 07:58:11', 1),
(56, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-29 07:58:34', 1),
(57, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 08:45:41', 1),
(58, '::1', 'irvanrifai646@yahoo.com', 19, '2022-03-29 08:55:12', 1),
(59, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:03:31', 1),
(60, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:05:14', 1),
(61, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:06:31', 1),
(62, '::1', 'spokiums@gmail.com', 11, '2022-03-29 09:08:36', 1),
(63, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:13:17', 1),
(64, '::1', 'irvanrifai646@yahoo.com', 19, '2022-03-29 09:31:14', 1),
(65, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:43:51', 1),
(66, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:44:27', 1),
(67, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:46:19', 1),
(68, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 09:57:52', 1),
(69, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 10:06:35', 1),
(70, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 10:07:07', 1),
(71, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 10:11:11', 1),
(72, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 10:12:04', 1),
(73, '::1', 'irvanrifai646@yahoo.com', 19, '2022-03-29 17:13:59', 1),
(74, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-29 17:54:13', 1),
(75, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 17:59:03', 1),
(76, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-29 19:23:50', 1),
(77, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 19:25:25', 1),
(78, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-29 19:32:16', 1),
(79, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-30 01:28:56', 1),
(80, '::1', 'l200180214@student.ums.ac.id', 10, '2022-03-30 01:53:47', 1),
(81, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-30 06:39:23', 1),
(82, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-30 20:16:44', 1),
(83, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-31 01:53:15', 1),
(84, '::1', 'bemfkiums', NULL, '2022-03-31 18:52:12', 0),
(85, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-03-31 18:52:24', 1),
(86, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-01 00:43:10', 1),
(87, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-01 08:40:41', 1),
(88, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-01 18:34:49', 1),
(89, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-01 19:29:21', 1),
(90, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-01 19:30:40', 1),
(91, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-03 00:46:23', 1),
(92, '::1', 'fostiums', NULL, '2022-04-03 02:22:15', 0),
(93, '::1', 'fostiums', NULL, '2022-04-03 02:22:32', 0),
(94, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-03 02:22:43', 1),
(95, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-03 02:25:26', 1),
(96, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-03 02:32:32', 1),
(97, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-03 02:45:16', 1),
(98, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-03 02:56:58', 1),
(99, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-03 04:53:45', 1),
(100, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-03 05:39:34', 1),
(101, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-07 11:44:09', 1),
(102, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-10 00:35:06', 1),
(103, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-10 04:46:29', 1),
(104, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-10 04:48:26', 1),
(105, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-10 05:02:27', 1),
(106, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-10 10:21:22', 1),
(107, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-10 10:37:27', 1),
(108, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-10 10:51:20', 1),
(109, '::1', 'ivan.rivai69@gmail.com', 13, '2022-04-10 11:16:40', 1),
(110, '::1', 'ivan.rivai@gmail.com', 12, '2022-04-10 11:27:25', 1),
(111, '::1', 'irvanrifai23@yahoo.com', 15, '2022-04-10 11:38:44', 1),
(112, '::1', 'spokiums@gmail.com', 11, '2022-04-10 11:50:16', 1),
(113, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-10 12:02:23', 1),
(114, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-11 00:04:00', 1),
(115, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-11 00:23:52', 1),
(116, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-11 00:28:22', 1),
(117, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-11 00:39:40', 1),
(118, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-11 00:47:15', 1),
(119, '::1', 'spokiums@gmail.com', 11, '2022-04-11 00:47:51', 1),
(120, '::1', 'irvanrifai23@yahoo.com', 15, '2022-04-11 00:48:16', 1),
(121, '::1', 'himakomums', NULL, '2022-04-11 00:48:49', 0),
(122, '::1', 'ivan.rivai69@gmail.com', 13, '2022-04-11 00:48:59', 1),
(123, '::1', 'ivan.rivai@gmail.com', 12, '2022-04-11 00:49:24', 1),
(124, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-11 01:12:19', 1),
(125, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-11 03:41:42', 1),
(126, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-11 07:51:48', 1),
(127, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-11 09:33:09', 1),
(128, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-11 09:36:58', 1),
(129, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-11 09:37:57', 1),
(130, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-11 09:39:01', 1),
(131, '::1', 'spokiums@gmail.com', 11, '2022-04-11 09:49:06', 1),
(132, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-12 10:24:13', 1),
(133, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-13 00:46:39', 1),
(134, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-15 01:05:17', 1),
(135, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-15 04:26:20', 1),
(136, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-14 23:21:21', 1),
(137, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-15 00:48:20', 1),
(138, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-15 00:48:37', 1),
(139, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-15 01:17:26', 1),
(140, '::1', 'spokiums@gmail.com', 11, '2022-04-15 01:28:28', 1),
(141, '::1', 'ivan.rivai69@gmail.com', 13, '2022-04-15 01:29:20', 1),
(142, '::1', 'ivan.rivai@gmail.com', 12, '2022-04-15 01:30:34', 1),
(143, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-15 01:31:43', 1),
(144, '::1', 'finicums', NULL, '2022-04-15 01:32:10', 0),
(145, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-15 01:32:19', 1),
(146, '::1', 'irvanrifai23@yahoo.com', 15, '2022-04-15 01:33:01', 1),
(147, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-17 03:38:52', 1),
(148, '::1', 'bemfkiums', NULL, '2022-04-17 04:17:00', 0),
(149, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-17 04:17:08', 1),
(150, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-17 12:20:43', 1),
(151, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-17 12:34:57', 1),
(152, '::1', 'spokiums@gmail.com', 11, '2022-04-17 12:39:47', 1),
(153, '::1', 'ivan.rivai69@gmail.com', 13, '2022-04-17 12:43:04', 1),
(154, '::1', 'ivan.rivai@gmail.com', 12, '2022-04-17 12:45:43', 1),
(155, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-17 12:49:39', 1),
(156, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-17 12:52:26', 1),
(157, '::1', 'irvanrifai23@yahoo.com', 15, '2022-04-17 12:55:42', 1),
(158, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-17 13:07:47', 1),
(159, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-17 13:16:06', 1),
(160, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-17 13:19:03', 1),
(161, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-17 21:45:03', 1),
(162, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-18 18:50:34', 1),
(163, '::1', 'dpmfkiums', NULL, '2022-04-18 19:19:36', 0),
(164, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-18 19:19:45', 1),
(165, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-19 05:15:23', 1),
(166, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-19 19:24:58', 1),
(167, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-19 20:05:02', 1),
(168, '::1', 'irvanrifai23@yahoo.com', 15, '2022-04-20 18:13:38', 1),
(169, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-20 20:16:14', 1),
(170, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-20 22:46:33', 1),
(171, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-21 11:08:33', 1),
(172, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-22 05:14:49', 1),
(173, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-22 16:58:17', 1),
(174, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-23 06:17:18', 1),
(175, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-23 19:03:18', 1),
(176, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-24 00:17:59', 1),
(177, '::1', 'dpmfkiums', NULL, '2022-04-24 00:33:45', 0),
(178, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-24 00:33:54', 1),
(179, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-24 00:39:12', 1),
(180, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-24 14:59:36', 1),
(181, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-25 00:39:38', 1),
(182, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-25 01:27:15', 1),
(183, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-25 01:52:01', 1),
(184, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-25 01:53:07', 1),
(185, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-25 02:07:51', 1),
(186, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-25 02:57:47', 1),
(187, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-25 03:03:15', 1),
(188, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-25 03:07:19', 1),
(189, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-25 14:40:56', 1),
(190, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-25 21:32:05', 1),
(191, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-25 21:47:13', 1),
(192, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-25 21:58:27', 1),
(193, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-25 22:01:32', 1),
(194, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-26 02:24:22', 1),
(195, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-27 21:35:35', 1),
(196, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-27 22:06:53', 1),
(197, '::1', 'ivan.rivai21@gmail.com', 14, '2022-04-27 22:09:39', 1),
(198, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-27 22:12:17', 1),
(199, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-27 22:31:17', 1),
(200, '::1', 'l200180214@student.ums.ac.id', 10, '2022-04-27 22:33:32', 1),
(201, '::1', 'irvanrifai646@yahoo.com', 19, '2022-04-28 20:38:39', 1),
(202, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-29 02:04:17', 1),
(203, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-29 02:04:35', 1),
(204, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-29 09:34:36', 1),
(205, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-30 04:06:29', 1),
(206, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-30 09:34:34', 1),
(207, '::1', 'ivan.rivai6921@gmail.com', 8, '2022-04-30 09:35:31', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-self', 'admin pengelola masing-masing scopenya'),
(2, 'manage-admin', 'superadmin pengelola admin dan selebihnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` varchar(255) NOT NULL,
  `nomor` int(100) NOT NULL,
  `kepemilikan` varchar(100) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `status_kondisi` varchar(255) NOT NULL,
  `jumlah_kapasitas` varchar(150) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nomor`, `kepemilikan`, `nama_aset`, `status_kondisi`, `jumlah_kapasitas`, `gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
('INV 90', 42, '', 'iScape', 'Rusak', '9', '5990d8eb181a1bf884e3a99f11667291.jpg', '2022-02-13 05:19:07', '2022-02-14 10:16:53', NULL),
('INV KU', 43, '', 'Aquarium', 'Baik', '1', 'images (3).jpg', '2022-02-13 06:08:41', '2022-02-13 22:53:15', NULL),
('Printer 02', 47, '', 'Printer', 'Rusak', '11', 'images (2).jpg', '2022-02-13 21:35:52', '2022-02-13 22:53:23', NULL),
('111', 48, '', 'INV 12', 'Baik', '12', 'images.jpg', '2022-02-13 22:58:26', '2022-02-13 22:58:26', NULL),
('234', 49, '', 'ini', 'baik', '3', 'scape.jpg', '2022-02-14 02:22:14', '2022-02-14 02:22:14', NULL),
('890', 51, '', 'Apik', 'Baik', '7', 'images (6).jpg', '2022-02-14 10:13:48', '2022-02-14 10:13:48', NULL),
('89889', 52, '', 'njih', 'Rusak', '8', 'images (2).jpg', '2022-02-14 10:45:05', '2022-02-14 10:46:35', NULL),
('987', 54, '', 'Sense', 'Perbaikan', '23', 'images (3).jpg', '2022-02-15 18:12:47', '2022-02-15 18:12:47', NULL),
('iojh', 56, '', 'ihohi', 'Baik', '7', 'images (2).jpg', '2022-02-16 03:52:27', '2022-02-16 03:52:42', NULL),
('hih', 57, '', 'hihilh', 'Baik', '9', 'images (3).jpg', '2022-02-16 04:04:05', '2022-02-16 04:04:19', NULL),
('ubihu', 62, '', 'uihu', 'Baik', '3', 'images (4).jpg', '2022-02-16 07:42:35', '2022-02-16 07:42:54', NULL),
('9y1', 65, '', 'adlawd', 'Rusak', '11', '1645674042_8227dca6f06d493844db.jpg', '2022-02-17 18:14:16', '2022-02-23 21:40:42', NULL),
('waqww', 79, '', 'wqwsswsa', 'Baik', '22', '1645676349_383dd32ab5116a607562.png', '2022-02-23 21:50:20', '2022-02-24 06:25:27', NULL),
('qqs', 80, '', 'wsq', 'Baik', '2', '1645676257_a9ec0303a8b7febf80a1.jpg', '2022-02-23 22:13:19', '2022-02-23 22:21:58', NULL),
('iiii', 81, '', 'iouh', 'Baik', '4', '1645706373_816d018014f639315e2c.png', '2022-02-24 06:39:33', '2022-02-24 06:39:33', NULL),
('wa', 87, '', 'porje', 'Baik', '3', 'SD-default-image.png', '2022-03-17 08:09:52', '2022-03-17 08:09:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1644838891, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `asal_instansi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_inventaris` varchar(150) NOT NULL,
  `wk_peminjamandr` datetime NOT NULL,
  `wk_peminjamansp` datetime NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tempat_pelaksanaan` varchar(255) NOT NULL,
  `wk_pelaksanaandr` datetime NOT NULL,
  `wk_pelaksanaansp` datetime NOT NULL,
  `st_ts` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjam`, `nama_peminjam`, `asal_instansi`, `email`, `no_hp`, `alamat`, `id_inventaris`, `wk_peminjamandr`, `wk_peminjamansp`, `nama_kegiatan`, `tempat_pelaksanaan`, `wk_pelaksanaandr`, `wk_pelaksanaansp`, `st_ts`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Irvan Rifa\'i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'RT 02 RW 03 Gatak Borongan Polanharjo Klaten', 'INV FINIC 01', '2022-05-19 09:30:00', '2022-05-19 12:30:00', 'RAKOR BEM SR', 'Hotel Alana Lantai 2', '2022-05-19 10:00:00', '2022-05-19 12:00:00', 1, '2022-04-19 05:01:46', '2022-04-19 19:26:39', NULL),
(3, 'Muhammad Alroyan', 'Eksternal FKI', 'alroyan@gmail.com', '08219388178', 'Semarang, Jalan Cemara 123456', 'INV HIMAKOM 021', '2022-04-30 12:00:00', '2022-04-30 17:00:00', 'Workshop Kemasyarakatan FT UMS', 'The Alana Hotel Solo', '2022-04-30 13:30:00', '2022-04-30 16:30:00', 1, '2022-04-19 07:25:18', '2022-04-19 08:45:26', NULL),
(4, 'Irvan Rifa\'i', 'Ormawa FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Yogyakarta jalan pemuda 123', 'INV BEM FKI 02', '2022-04-20 07:45:00', '2022-04-20 13:30:00', 'Persiapan Fakultaria', 'Hall Fakultas Komunikasi dan Informatika', '2022-04-20 08:00:00', '2022-04-20 12:30:00', 0, '2022-04-19 19:28:18', '2022-04-25 21:32:29', NULL),
(5, 'Arief Ahmad Handoko', 'Internal FKI', 'l200180214@student.ums.ac.id', '082939882012', 'Medan, Jalan Kawanan 2314', 'INV FINIC 0211', '2022-04-29 07:30:00', '2022-04-29 16:00:00', 'Pelatihan Digitalent Kominfo', 'Gd. Induk Siti Walidah UMS', '2022-04-29 07:00:00', '2022-04-29 15:00:00', 1, '2022-04-19 19:36:30', '2022-04-21 12:31:26', NULL),
(6, 'Muhammad Firdaus', 'Ormawa FKI', 'ivan.rivai6921@gmail.com', '08213461790', 'Jalan Wakhid Hasyim 12, Banjarsari, Surakarta', 'INV LPM KONEKSI 02', '2022-04-28 07:45:00', '2022-04-28 13:00:00', 'Pelatihan Fullstack Web Developer with Ruby', 'Gd. Pascasarjana UMS lt. 5 ', '2022-04-28 08:00:00', '2022-04-28 12:30:00', NULL, '2022-04-19 19:51:46', '2022-04-19 19:51:46', NULL),
(7, 'Irvan Rifa\'i', 'Internal FKI', 'spokiums@gmail.com', '082138109809', 'RT 02 RW 03 Gatak Borongan Polanharjo Klaten', 'INV FOSTI 022', '2022-04-20 09:00:00', '2022-04-20 11:00:00', 'Rakornas', 'Yogyakarta (UMY)', '2022-04-20 09:30:00', '2022-04-20 10:30:00', 1, '2022-04-19 20:02:22', '2022-04-20 20:16:36', NULL),
(8, 'Anas Al-amin', 'Ormawa FKI', 'ivan.rivai6921@gmail.com', '081321453167', 'Jalan Krawajati No. 78 Klodran, Surakarta', 'INV LPM KONEKSI 01', '2022-04-27 07:00:00', '2022-04-27 16:30:00', 'Upgrading Ormawa', 'J Seminar 2 FKI', '2022-04-27 07:30:00', '2022-04-27 15:45:00', NULL, '2022-04-19 20:19:23', '2022-04-19 20:19:23', NULL),
(9, 'Joko Susanto', 'Eksternal FKI', 'ivan.rivai6921@gmail.com', '087658237745', 'Jakarta, Jalan Pemuda 12345', 'INV BEM FKI 04', '2022-04-26 08:30:00', '2022-04-26 13:00:00', 'Workshop Digital Marketing', 'Seminar FEB UMS', '2022-04-26 09:00:00', '2022-04-26 12:00:00', 1, '2022-04-19 20:25:00', '2022-04-25 21:32:18', NULL),
(10, 'cek aja', 'Ormawa FKI', 'l200180214@student.ums.ac.id', '80870709', 'Jalan Krawajati No. 78 Klodran, Surakarta', 'INV BEM FKI 05', '2022-04-20 09:00:00', '2022-04-20 10:15:00', 'Pelatihan Digitalent Kominfo', 'J Seminar 2 FKI', '2022-04-20 09:00:00', '2022-04-20 10:00:00', 0, '2022-04-19 20:26:23', '2022-04-21 12:39:11', '2022-04-21 12:39:11'),
(11, 'Dimas Aryo', 'Ormawa FKI', 'daa310@ums.ac.id', '-2', 'Solo', 'INV FINIC 0211', '2022-04-25 01:15:00', '2022-04-26 12:30:00', 'Rakornas', 'Hall Fakultas Komunikasi dan Informatika', '2022-04-25 09:30:00', '2022-04-25 10:00:00', 0, '2022-04-20 23:22:54', '2022-04-21 12:39:02', NULL),
(12, 'Irvan Rifa\'i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '08870767578', 'Jakarta, Jalan Pemuda 12345', 'INV BEM FKI 05', '2022-04-24 06:00:00', '2022-04-24 08:00:00', 'Pelatihan Digitalent Kominfo', 'Yogyakarta (UMY)', '2022-04-24 06:30:00', '2022-04-24 07:30:00', 1, '2022-04-23 17:34:51', '2022-04-27 22:15:33', NULL),
(13, 'Ahmad Al-amin', 'Eksternal FKI', 'ivan.rivai6921@gmail.com', '081234567892', 'Yogyakarta jalan pemuda 123', 'INV FINIC 0211', '2022-04-24 06:15:00', '2022-04-24 07:45:00', 'Rakornas', 'Makam Haji', '2022-04-24 06:15:00', '2022-04-24 07:30:00', NULL, '2022-04-23 18:15:13', '2022-04-23 18:15:13', NULL),
(15, 'Irvan Rifa\'i', 'Internal FKI', 'l200180214@student.ums.ac.id', '082138109809', 'RT 02 RW 03 Gatak Borongan Polanharjo Klaten', 'INV DPM FKI 04', '2022-04-24 06:30:00', '2022-04-24 09:30:00', 'Pelatihan Digitalent Kominfo', 'Yogyakarta (UMY)', '2022-04-24 07:00:00', '2022-04-24 09:00:00', 1, '2022-04-23 18:18:59', '2022-04-26 02:24:46', NULL),
(18, 'Syafiq Muhammad Ikhsan', 'Ormawa FKI', 'irvanrifai646@yahoo.com', '089123456789', 'Jalan Krawajati No. 78 Klodran, Surakarta', 'INV BEM FKI 04', '2022-04-24 06:30:00', '2022-04-24 07:45:00', 'Persiapan Fakultaria', 'Hall Fakultas Komunikasi dan Informatika', '2022-04-24 06:30:00', '2022-04-24 07:45:00', NULL, '2022-04-23 18:26:46', '2022-04-23 18:26:46', NULL),
(19, 'Syafiq Muhammad Ikhsan', 'Ormawa FKI', 'irvanrifai646@yahoo.com', '089123456789', 'Jalan Krawajati No. 78 Klodran, Surakarta', 'INV LPM KONEKSI 01', '2022-04-24 06:30:00', '2022-04-24 07:45:00', 'Persiapan Fakultaria', 'Hall Fakultas Komunikasi dan Informatika', '2022-04-24 06:30:00', '2022-04-24 07:45:00', NULL, '2022-04-23 18:26:47', '2022-04-23 18:26:47', NULL),
(20, 'Syafiq Muhammad Ikhsan', 'Ormawa FKI', 'irvanrifai646@yahoo.com', '089123456789', 'Jalan Krawajati No. 78 Klodran, Surakarta', 'INV HIMATIF 16', '2022-04-24 06:30:00', '2022-04-24 07:45:00', 'Persiapan Fakultaria', 'Hall Fakultas Komunikasi dan Informatika', '2022-04-24 06:30:00', '2022-04-24 07:45:00', NULL, '2022-04-23 18:26:47', '2022-04-23 18:26:47', NULL),
(21, 'Rifa\'i Ahmad', 'Eksternal FKI', 'ivan.rivai6921@gmail.com', '08123431568', 'Jalan Krawajati No. 78 Klodran, Surakarta', 'INV FOSTI 022', '2022-04-30 08:00:00', '2022-05-05 10:36:00', 'Seminar Internasional Pemrograman Dart', 'Edutorium Muh. Djazman UMS', '2022-04-30 10:36:00', '2022-05-04 10:36:00', 1, '2022-04-27 22:37:00', '2022-04-28 20:38:57', NULL),
(22, 'Irvan Rifa’i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Gatak, Borongan, Polanharjo, Klaten', 'INV FOSTI 022', '2022-05-26 00:00:00', '2022-06-01 22:00:00', 'Anjangsana FKI x FIK UMS', 'Auditorium Muh Djazman UMS', '2022-06-01 22:00:00', '2022-06-02 23:00:00', NULL, '2022-04-30 09:33:11', '2022-04-30 09:33:11', NULL),
(23, 'Irvan Rifa’i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Gatak, Borongan, Polanharjo, Klaten', 'INV BEM 12345', '2022-05-19 00:30:00', '2022-05-27 21:32:00', 'Anjangsana FKI x FIK UMS', 'Auditorium Muh Djazman UMS', '2022-06-01 22:00:00', '2022-06-02 23:00:00', 1, '2022-04-30 09:33:11', '2022-04-30 09:35:45', NULL),
(24, 'Irvan Rifa’i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Gatak, Borongan, Polanharjo, Klaten', 'INV KINE 01', '2022-05-12 00:30:00', '2022-05-13 22:00:00', 'Anjangsana FKI x FIK UMS', 'Auditorium Muh Djazman UMS', '2022-06-01 22:00:00', '2022-06-02 23:00:00', NULL, '2022-04-30 09:33:11', '2022-04-30 09:33:11', NULL),
(25, 'Irvan Rifa’i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Gatak, Borongan, Polanharjo, Klaten', 'INV FOSTI 022', '2022-05-26 00:00:00', '2022-06-01 22:00:00', 'Anjangsana FKI x FIK UMS', 'Auditorium Muh Djazman UMS', '2022-06-01 22:00:00', '2022-06-02 23:00:00', NULL, '2022-04-30 09:33:32', '2022-04-30 09:33:32', NULL),
(26, 'Irvan Rifa’i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Gatak, Borongan, Polanharjo, Klaten', 'INV BEM 12345', '2022-05-19 00:30:00', '2022-05-27 21:32:00', 'Anjangsana FKI x FIK UMS', 'Auditorium Muh Djazman UMS', '2022-06-01 22:00:00', '2022-06-02 23:00:00', 0, '2022-04-30 09:33:32', '2022-04-30 09:37:00', NULL),
(27, 'Irvan Rifa’i', 'Internal FKI', 'ivan.rivai6921@gmail.com', '082138109809', 'Gatak, Borongan, Polanharjo, Klaten', 'INV KINE 01', '2022-05-12 00:30:00', '2022-05-13 22:00:00', 'Anjangsana FKI x FIK UMS', 'Auditorium Muh Djazman UMS', '2022-06-01 22:00:00', '2022-06-02 23:00:00', NULL, '2022-04-30 09:33:32', '2022-04-30 09:33:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarpras`
--

CREATE TABLE `sarpras` (
  `id_sarpras` int(11) NOT NULL,
  `keputusan` tinyint(1) NOT NULL,
  `id_inventaris` varchar(150) NOT NULL,
  `id_peminjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aset`
--

CREATE TABLE `tb_aset` (
  `nomor` int(100) NOT NULL,
  `id_inventaris` varchar(150) NOT NULL,
  `kepemilikan` varchar(150) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL,
  `kondisi` varchar(150) NOT NULL,
  `jumlah_kapasitas` varchar(75) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `cb_nb` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_aset`
--

INSERT INTO `tb_aset` (`nomor`, `id_inventaris`, `kepemilikan`, `nama_aset`, `status`, `kondisi`, `jumlah_kapasitas`, `gambar`, `cb_nb`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'INV BEM FKI 01', 'BEM FKI UMS', 'Komputer Acer', 'Tersedia', 'Baik', '1', '1650216401_5a72ad116bd68d77bdd2.jpg', NULL, '2022-04-17 12:26:41', '2022-04-17 12:33:25', NULL),
(2, 'INV BEM FKI 02', 'BEM FKI UMS', 'Megaphone Type 2R', 'Tersedia', 'Baik', '1', '1650216537_ecd55ae6c5b0c05db69c.jpg', 1, '2022-04-17 12:28:57', '2022-04-17 12:28:57', NULL),
(3, 'INV BEM FKI 03', 'BEM FKI UMS', 'Printer EPSON 2022', 'Tersedia', 'Baik', '1', '1650216581_99bd04ec471e3d39dad1.jpg', 1, '2022-04-17 12:29:41', '2022-04-17 12:29:41', NULL),
(4, 'INV BEM FKI 04', 'BEM FKI UMS', 'Projector Acer 2211', 'Tersedia', 'Baik', '1', '1650216637_e7c57bc58ee1cd12ebdf.png', 1, '2022-04-17 12:30:37', '2022-04-17 12:30:37', NULL),
(5, 'INV BEM FKI 05', 'BEM FKI UMS', 'Sound System Blutooth', 'Tersedia', 'Baik', '1', '1650216682_e7fe63d8f8962d107725.png', 1, '2022-04-17 12:31:22', '2022-04-17 12:31:33', NULL),
(6, 'INV BEM FKI 07', 'BEM FKI UMS', 'Loker Besi ', 'Tersedia', 'Baik', '1', '1650216737_3e4451aeb4e1b9822c21.jpg', NULL, '2022-04-17 12:32:17', '2022-04-17 12:32:17', NULL),
(7, 'INV BEM FKI 06', 'BEM FKI UMS', 'Microphone Wireless 1 set', 'Tersedia', 'Baik', '2', '1650216790_cb8a615c7709b0fa9258.jpg', 1, '2022-04-17 12:33:10', '2022-04-17 12:33:10', NULL),
(8, 'INV BEM FKI 08', 'BEM FKI UMS', 'Kursi Kantor ', 'Tersedia', 'Rusak', '1', '1650216852_d212f6aaaa7ddf7f1e6a.jpg', NULL, '2022-04-17 12:34:12', '2022-04-17 12:34:12', NULL),
(9, 'INV DPM FKI 01', 'DPM FKI UMS', 'Komputer MSI', 'Tersedia', 'Baik', '1', '1650216937_106025e9a59f44ea7717.jpg', NULL, '2022-04-17 12:35:38', '2022-04-17 12:35:38', NULL),
(10, 'INV DPM FKI 02', 'DPM FKI UMS', 'Printer CANON 202112', 'Tersedia', 'Baik', '1', '1650216990_4889180437e7dba8a312.jpg', 1, '2022-04-17 12:36:30', '2022-04-17 12:36:30', NULL),
(11, 'INV DPM FKI 16', 'DPM FKI UMS', 'Buku Madilog', 'Tersedia', 'Baik', '1', '1650217033_f62031ac22979d7ff227.jpg', 1, '2022-04-17 12:37:13', '2022-04-27 22:08:08', NULL),
(12, 'INV DPM FKI 04', 'DPM FKI UMS', 'Microphone Wireless 1 set', 'Tersedia', 'Baik', '1', '1650217097_bc4929d0c3d7eb4a3ed8.jpg', 1, '2022-04-17 12:38:17', '2022-04-17 12:38:17', NULL),
(13, 'INV LPM KONEKSI 01', 'LPM KONEKSI', 'Kamera Mirrorless SONY', 'Tersedia', 'Baik', '1', '1650217239_7d5928d374d82801ef26.png', 1, '2022-04-17 12:40:39', '2022-04-17 12:41:44', NULL),
(14, 'INV LPM KONEKSI 02', 'LPM KONEKSI', 'Perekam Suara', 'Tersedia', 'Baik', '1', '1650217292_f6cf4d344c278306e699.jpg', 1, '2022-04-17 12:41:32', '2022-04-17 12:41:32', NULL),
(15, 'INV LPM KONEKSI 03', 'LPM KONEKSI', 'Komputer Acer', 'Tersedia', 'Baik', '1', '1650217352_788d016808f4d942b386.jpg', NULL, '2022-04-17 12:42:32', '2022-04-17 12:42:32', NULL),
(16, 'INV HIMAKOM 022', 'HIMAKOM UMS', 'Komputer Asus', 'Tersedia', 'Baik', '1', '1650217422_252ddab783bf2eae2bfb.jpg', NULL, '2022-04-17 12:43:42', '2022-04-17 12:43:42', NULL),
(17, 'INV HIMAKOM 021', 'HIMAKOM UMS', 'Microphone Wireless', 'Tersedia', 'Baik', '1', '1650217466_a7d24116afb02d7c3dab.png', 1, '2022-04-17 12:44:26', '2022-04-17 12:44:26', NULL),
(18, 'INV HIMAKOM 024', 'HIMAKOM UMS', 'Papan Karya HIMAKOM', 'Tersedia', 'Baik', '1', 'SD-default-image.png', 1, '2022-04-17 12:45:09', '2022-04-17 12:45:09', NULL),
(19, 'INV HIMATIF 022', 'HIMATIF UMS', 'Komputer Axioo', 'Tersedia', 'Baik', '1', '1650217585_e416849d394db3e9ef95.jpg', NULL, '2022-04-17 12:46:25', '2022-04-17 12:46:25', NULL),
(20, 'INV HIMATIF 12', 'HIMATIF UMS', 'Printer CANON 20265', 'Tersedia', 'Baik', '1', '1650217626_bfdca885dd154f2de133.jpg', 1, '2022-04-17 12:47:06', '2022-04-17 12:47:06', NULL),
(21, 'INV HIMATIF 01', 'HIMATIF UMS', 'Loker Besi ', 'Tersedia', 'Baik', '1', '1650217694_17a4cf9771987bfe0ade.jpg', NULL, '2022-04-17 12:48:14', '2022-04-17 12:48:14', NULL),
(22, 'INV HIMATIF 16', 'HIMATIF UMS', 'Buku Tutorial Ruby on Rails', 'Tersedia', 'Baik', '1', '1650217752_4b92f989c18f8488a257.jpg', 1, '2022-04-17 12:49:12', '2022-04-17 12:49:12', NULL),
(23, 'INV FOSTI 022', 'FOSTI UMS', 'Drone DJI MAVIC', 'Tersedia', 'Baik', '1', '1650217871_d1eb52111ff5ec164afd.jpg', 1, '2022-04-17 12:51:11', '2022-04-17 12:51:11', NULL),
(24, 'INV FOSTI 021', 'FOSTI UMS', 'Komputer Asus', 'Tersedia', 'Baik', '1', '1650217898_2a01930d7fd28302f2da.jpg', NULL, '2022-04-17 12:51:38', '2022-04-17 12:51:38', NULL),
(25, 'INV FOSTI 026', 'FOSTI UMS', 'Printer CANON 202698', 'Tersedia', 'Baik', '1', '1650217930_680cde46663e52372386.jpg', 1, '2022-04-17 12:52:10', '2022-04-17 12:52:10', NULL),
(26, 'INV FINIC 0211', 'FINIC UMS', 'Kamera Fuji X-A7', 'Tersedia', 'Baik', '1', '1650218014_399b7ca6c18449295303.png', 1, '2022-04-17 12:53:34', '2022-04-17 12:53:34', NULL),
(27, 'INV FINIC 01', 'FINIC UMS', 'Kamera Mirrorless SONY', 'Tersedia', 'Baik', '1', '1650218046_a1a24ddc3a7164e85896.jpg', 1, '2022-04-17 12:54:06', '2022-04-17 12:54:06', NULL),
(28, 'INV FINIC 03', 'FINIC UMS', 'Sketsel Foto', 'Tersedia', 'Baik', '1', '1650218080_644d012e5e709e37ea93.jpg', 1, '2022-04-17 12:54:40', '2022-04-17 12:54:40', NULL),
(29, 'INV FINIC 09', 'FINIC UMS', 'Komputer MSI', 'Tersedia', 'Baik', '1', '1650218119_1972d4e5205a93ee11dd.jpg', NULL, '2022-04-17 12:55:19', '2022-04-17 12:55:19', NULL),
(31, 'INV KINE 01', 'KINE CLUB UMS', 'Kamera NIKON 20i1', 'Tersedia', 'Baik', '1', 'SD-default-image.png', 1, '2022-04-17 12:56:57', '2022-04-17 12:56:57', NULL),
(32, 'INV KINE 05', 'KINE CLUB UMS', 'Komputer Asus', 'Tersedia', 'Baik', '1', '1650218242_39ed6e00055d0023a572.jpg', NULL, '2022-04-17 12:57:22', '2022-04-17 12:57:22', NULL),
(33, 'INV KINE 0553', 'KINE CLUB UMS', 'Meja Kecil', 'Tersedia', 'Baik', '1', '1650218270_6cc5bf77900f0e1cf8f0.jpg', 1, '2022-04-17 12:57:50', '2022-04-17 12:57:50', NULL),
(34, 'INV BEM 12345', 'BEM FKI UMS', 'Sound Card', 'Tersedia', 'Baik', '1', 'SD-default-image.png', 1, '2022-04-24 17:44:42', '2022-04-27 21:59:46', NULL),
(35, 'INV FINIC 0334', 'FINIC UMS', 'Karpet Merah', 'Tersedia', 'Baik', '1', '1651115431_60f14e08caf8be4c6953.jpg', NULL, '2022-04-27 22:10:31', '2022-04-27 22:10:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aset_pinjam`
--

CREATE TABLE `tb_aset_pinjam` (
  `id` int(11) NOT NULL,
  `id_inventaris` varchar(150) DEFAULT NULL,
  `id_peminjam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dpm`
--

CREATE TABLE `tb_dpm` (
  `nomor` int(100) NOT NULL,
  `id_inventaris` varchar(150) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL,
  `kondisi` varchar(150) NOT NULL,
  `jumlah_kapasitas` varchar(75) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dpm`
--

INSERT INTO `tb_dpm` (`nomor`, `id_inventaris`, `nama_aset`, `status`, `kondisi`, `jumlah_kapasitas`, `gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '123iii', 'iScape', 'Tersedia', 'Baik', '1', '1647530597_e4b735baeecf2d2acdc4.jpg', '2022-03-17 10:23:17', '2022-04-01 19:30:08', NULL),
(4, 'uehfh398', 'iScape', 'Tersedia', 'Baik', '0', 'SD-default-image.png', '2022-03-29 07:59:18', '2022-03-29 07:59:18', NULL),
(5, 'iuihohyoi', 'ipjpi', 'Tersedia', 'Baik', '1', 'SD-default-image.png', '2022-03-29 08:28:41', '2022-04-03 02:57:10', NULL),
(8, 'wwww', 'wwtt', 'Tersedia', 'Baik', '1', 'SD-default-image.png', '2022-04-03 02:32:45', '2022-04-03 02:35:03', NULL),
(10, 'iyah', 'ya', 'Tersedia', 'Baik', '2', 'SD-default-image.png', '2022-04-03 03:11:09', '2022-04-03 03:11:09', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'ivan.rivai6921@gmail.com', 'bemfkiums', '$2y$10$gt3Y1nWGY7JMfyRs7SdYK.mOtRoQnJWa9n3oxc7vk2a/pKwjSpNOW', 'c72b55fcf7dae74d61c23e6d860684c5', NULL, '2022-03-28 09:44:41', NULL, NULL, NULL, 1, 0, '2022-03-26 22:36:40', '2022-03-28 08:44:41', NULL),
(10, 'l200180214@student.ums.ac.id', 'dpmfkiums', '$2y$10$TvebuwriJhQGbPPaEpysgeJRcliLZ3pfnHZHgQgNJVFSv3LcajU/W', '86c9da7cd8d109c465dc7c6e66881c7b', NULL, '2022-03-27 04:29:32', NULL, NULL, NULL, 1, 0, '2022-03-27 03:28:35', '2022-03-27 03:29:32', NULL),
(11, 'spokiums@gmail.com', 'lpmkoneksi', '$2y$10$AfFERTZ1wqgQict2lMo3KeV.g.COC6gQX3vyORZXY8KJ.OkIYURC.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-03-28 07:26:00', '2022-03-28 07:26:00', NULL),
(12, 'ivan.rivai@gmail.com', 'himatifums', '$2y$10$Ly.UAakGReyWE/XiR4E3NeM9z1sB6ZykBHIf89TbkhuzvGz14O.8G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-03-28 07:27:59', '2022-03-28 07:27:59', NULL),
(13, 'ivan.rivai69@gmail.com', 'himakomums', '$2y$10$yWzTIs79fWlVgQIDbVGdEe5iNEj/s0HvN0OkPY2GLRXTLfO8.Q9Ge', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-03-28 07:34:05', '2022-03-28 07:34:05', NULL),
(14, 'ivan.rivai21@gmail.com', 'finicums', '$2y$10$zMPxzBiu8qofFqLxBTzcG.70DuGNg8YC4p3jnOaUq29RvuYv7tc6u', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-03-28 07:35:29', '2022-03-28 07:35:29', NULL),
(15, 'irvanrifai23@yahoo.com', 'kineclubums', '$2y$10$SReEHyeMidWjy2.jPtDIY.tvGL/xBySoVDE1X5SvyDhKznaftrFPe', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-03-28 07:37:15', '2022-03-28 07:37:15', NULL),
(19, 'irvanrifai646@yahoo.com', 'fostiums', '$2y$10$cUg.SayK5fZeibhfSkPXJO88e8N/NLlMF3cMAtMC43I0EDGeUapcK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-03-29 07:42:49', '2022-03-29 07:42:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`nomor`),
  ADD KEY `nama_aset` (`nama_aset`),
  ADD KEY `jumlah_kapasitas` (`jumlah_kapasitas`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjam`),
  ADD KEY `id_inventaris` (`id_inventaris`);

--
-- Indeks untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  ADD PRIMARY KEY (`id_sarpras`),
  ADD KEY `sarpras_has_inventaris` (`id_inventaris`),
  ADD KEY `sarpras_has_peminjaman` (`id_peminjaman`);

--
-- Indeks untuk tabel `tb_aset`
--
ALTER TABLE `tb_aset`
  ADD PRIMARY KEY (`nomor`),
  ADD UNIQUE KEY `id_inventaris` (`id_inventaris`),
  ADD UNIQUE KEY `nomor_2` (`nomor`),
  ADD KEY `nomor` (`nomor`);

--
-- Indeks untuk tabel `tb_aset_pinjam`
--
ALTER TABLE `tb_aset_pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inventaris` (`id_inventaris`),
  ADD KEY `id_peminjam` (`id_peminjam`);

--
-- Indeks untuk tabel `tb_dpm`
--
ALTER TABLE `tb_dpm`
  ADD PRIMARY KEY (`nomor`),
  ADD UNIQUE KEY `id_inventaris` (`id_inventaris`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `nomor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  MODIFY `id_sarpras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_aset`
--
ALTER TABLE `tb_aset`
  MODIFY `nomor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_aset_pinjam`
--
ALTER TABLE `tb_aset_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_dpm`
--
ALTER TABLE `tb_dpm`
  MODIFY `nomor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_inventaris`) REFERENCES `tb_aset` (`id_inventaris`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
