-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 07:14 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eis2`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`) VALUES
(12, 'Kepala Prodi SI', 'kaprodisi@darmajaya.ac.id', 'default.png', '$2y$10$DaEsnN4HJwZtL/oA4kmaN.xTc9ODuuBqa/crzHOAwrHW1QplIu0PK', 3, 1),
(13, 'Administrator', 'admin@darmajaya.ac.id', 'default.png', '$2y$10$GJovJ.oSL8BD/12i4wEJee7EMCnq.Br.K3mfXcwpdic43lLFsMk4e', 1, 1),
(14, 'Kepala Prodi TI', 'kaproditi@darmajaya.ac.id', 'default.png', '$2y$10$PzWRqowuHCwyGxfKmbzKI.tTxCCXtGt.9Wf1MV9KAVVOjIUJWqvwu', 4, 1),
(15, 'Kepala Prodi SK', 'kaprodisk@darmajaya.ac.id', 'default.png', '$2y$10$KZYzPRbIXU/Xwt.UFk/8auwTtiU6kav1Opv5f7Q9mUGYBB2bbh7Uq', 5, 1),
(16, 'Kepala Prodi MTI', 'kaprodimti@darmajaya.ac.id', 'default.png', '$2y$10$LB7ijB0nJ0qIGgLa8ekFyeET1MFD4/EHwSefK8AVE1ZQ9uW2GZ3tK', 6, 1),
(17, 'Kepala Prodi AK', 'kaprodiak@darmajaya.ac.id', 'default.png', '$2y$10$qWgnHktBd5g0DkD.KTJ0P.DWbRnOM9nBPu5nE.tvsPD8bN.I8qB1q', 7, 1),
(18, 'Kepala Prodi MA', 'kaprodima@darmajaya.ac.id', 'default.png', '$2y$10$vbqpB4R9UDuFNk8UNnIIMOQjNOu03quiXgjXs2LZhEreFib0kDP6a', 8, 1),
(19, 'Kepala Prodi MM', 'kaprodimm@darmajaya.ac.id', 'default.png', '$2y$10$eHuKwf/ud/h4orta72g99ufLBh.WsuYQV2QY5AyJBl3UBpOX80e82', 9, 1),
(20, 'Coba core_system', 'core_system@darmajaya.ac.id', 'default.png', '$2y$10$qha9BMrMjx26lu/.IcbI7uuIIZ6OOX8HAZICPoCr3CG9tTvST1xVi', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `user_id`, `menu_id`) VALUES
(18, 13, 2),
(19, 13, 5),
(20, 13, 6),
(21, 13, 7),
(23, 12, 10),
(24, 12, 17),
(25, 12, 24),
(26, 12, 25),
(27, 12, 26),
(28, 14, 10),
(29, 14, 17),
(30, 14, 24),
(31, 14, 25),
(32, 14, 26),
(33, 15, 10),
(34, 15, 17),
(35, 15, 24),
(36, 15, 25),
(37, 15, 26),
(38, 16, 10),
(39, 16, 17),
(40, 16, 24),
(41, 16, 25),
(42, 16, 26),
(43, 17, 10),
(44, 17, 17),
(45, 17, 24),
(46, 17, 25),
(47, 17, 26),
(48, 18, 10),
(49, 18, 17),
(50, 18, 24),
(51, 18, 25),
(52, 18, 26),
(53, 19, 10),
(54, 19, 17),
(55, 19, 24),
(56, 19, 25),
(57, 19, 26),
(58, 20, 27);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id`, `user_id`, `sub_menu_id`) VALUES
(25, 13, 12),
(26, 13, 13),
(27, 13, 14),
(28, 13, 18),
(29, 12, 19),
(30, 12, 20),
(31, 12, 21),
(32, 12, 22),
(33, 12, 23),
(34, 12, 24),
(35, 12, 25),
(36, 12, 26),
(37, 12, 27),
(38, 12, 27),
(39, 12, 27),
(40, 12, 28),
(41, 12, 29),
(42, 12, 30),
(43, 12, 31),
(44, 12, 32),
(45, 12, 33),
(46, 12, 34),
(47, 14, 20),
(48, 14, 19),
(49, 14, 21),
(50, 14, 22),
(51, 14, 23),
(52, 14, 24),
(53, 14, 25),
(54, 14, 26),
(55, 14, 27),
(56, 14, 28),
(57, 14, 29),
(58, 14, 30),
(59, 14, 31),
(60, 14, 32),
(61, 14, 33),
(62, 14, 34),
(63, 20, 36);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(2, 'User'),
(5, 'View'),
(6, 'Role'),
(7, 'Menu'),
(10, 'Dashboard'),
(17, 'Pendaftaran'),
(24, 'Mahasiswa'),
(25, 'Presensi'),
(26, 'Bimbingan'),
(27, 'Coba Core System');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(3, 'KaProdi SI'),
(4, 'KaProdi TI'),
(5, 'KaProdi SK'),
(6, 'KaProdi MTI'),
(7, 'KaProdi AK'),
(8, 'KaProdi MA'),
(9, 'KaProdi MM');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `by`) VALUES
(12, 2, 'List User', 'user/index', '', 1, NULL),
(13, 6, 'List Role', 'user_role/index', '', 1, NULL),
(14, 7, 'List Menu', 'user_menu/index', '', 1, NULL),
(18, 5, 'List View', 'user_view/index', 'fa', 1, NULL),
(19, 10, 'Home', 'dashboard/index', 'fa fa-home', 1, NULL),
(20, 17, 'Grafik Perbandingan', 'kaprodi/grafik_perbandingan', 'fa fa-home', 1, NULL),
(21, 17, 'Pendaftar', 'kaprodi/pendaftar', 'fa fa-home', 1, NULL),
(22, 17, 'Pendaftar Daftar Ulang', 'kaprodi/pendaftar_daftar_ulang', 'fa fa-home', 1, NULL),
(23, 17, 'Pendaftar Tidak Daftar Ulang', 'kaprodi/pendaftar_tidak_daftar_ulang', 'fa fa-home', 1, NULL),
(24, 24, 'Mahasiswa Aktif', 'kaprodi/mahasiswa_aktif', 'fa fa-home', 1, NULL),
(25, 24, 'Mahasiswa Cuti', 'kaprodi/mahasiswa_cuti', 'fa fa-home', 1, NULL),
(26, 24, 'Mahasiswa Lulus Per TA', 'kaprodi/mahasiswa_lulus_per_ta', 'fa fa-home', 1, NULL),
(27, 24, 'Mahasiswa Lulus Per Angkatan', 'kaprodi/mahasiswa_lulus_per_angkatan', 'fa fa-home', 0, NULL),
(28, 24, 'Mahasiswa Lulus Tepat Waktu', 'kaprodi/mahasiswa_lulus_tepat_waktu', 'fa fa-home', 1, NULL),
(29, 24, 'Mahasiswa Lulus IPK Tertentu', 'kaprodi/mahasiswa_lulus_ipk_tertentu', 'fa fa-home', 1, NULL),
(30, 24, 'Mahasiswa Habis Masa Studi', 'kaprodi/mahasiswa_habis_masa_studi', 'fa fa-home', 1, NULL),
(31, 24, 'Mahasiswa Re -NPM', 'kaprodi/mahasiswa_re_npm', 'fa fa-home', 1, NULL),
(32, 25, 'Presensi Mahasiswa', 'kaprodi/presensi_mahasiswa', 'fa fa-home', 1, NULL),
(33, 25, 'Presensi Dosen', 'kaprodi/presensi_dosen', 'fa fa-home', 1, NULL),
(34, 26, 'Bimbingan PA', 'kaprodi/bimbingan_pa', 'fa fa-home', 1, NULL),
(36, 27, 'Coba accordion-table', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432', 'fa fa-home', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu_access_view`
--

CREATE TABLE `user_sub_menu_access_view` (
  `id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu_access_view`
--

INSERT INTO `user_sub_menu_access_view` (`id`, `sub_menu_id`, `view_id`, `is_active`, `by`) VALUES
(3, 21, 5, 1, NULL),
(6, 21, 6, 1, NULL),
(7, 36, 12, 1, NULL),
(8, 36, 8, 1, NULL),
(9, 36, 9, 1, NULL),
(10, 36, 10, 1, NULL),
(11, 36, 11, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_view`
--

CREATE TABLE `user_view` (
  `id` int(11) NOT NULL,
  `jsonFile` longtext,
  `view` varchar(255) NOT NULL,
  `view_name` varchar(255) NOT NULL,
  `select` varchar(255) NOT NULL,
  `where` varchar(255) NOT NULL,
  `limit` varchar(255) NOT NULL,
  `order_by` varchar(255) NOT NULL,
  `type` enum('morris-line-chart','morris-bar-chart','morris-area-chart','morris-donout','accordion','table','accordion-table','accordion-table-filter','table-filter','accordion-morris-line-chart','accordion-morris-bar-chart','accordion-morris-area-chart','accordion-morris-donout','accordion-morris-line-chart-filter','accordion-morris-bar-chart-filter','accordion-morris-area-chart-filter','accordion-morris-donout-filter','header','tab','tab-table','tab-morris-line-chart','tab-morris-bar-chart','tab-morris-area-chart','tab-morris-donout-chart') DEFAULT NULL,
  `tableHeader` longtext,
  `tableTitle` varchar(255) DEFAULT NULL,
  `accordionTableTitle` varchar(255) NOT NULL,
  `accordionTablePer` varchar(255) NOT NULL,
  `accordionTableUnik` varchar(255) NOT NULL,
  `headerTitle` varchar(255) DEFAULT NULL,
  `sizeText` varchar(255) DEFAULT NULL COMMENT 'example h1,h2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_view`
--

INSERT INTO `user_view` (`id`, `jsonFile`, `view`, `view_name`, `select`, `where`, `limit`, `order_by`, `type`, `tableHeader`, `tableTitle`, `accordionTableTitle`, `accordionTablePer`, `accordionTableUnik`, `headerTitle`, `sizeText`) VALUES
(5, NULL, 'Grafik Pendaftar', 'EIS_Prodi_GrafikPendaftaran', '*', '', '-1', 'id_jurusan desc', 'morris-line-chart', NULL, NULL, '', '', '', NULL, NULL),
(6, NULL, 'Accordion Pendaftar', 'EIS_Prodi_Pendaftar', '*', '', '-1', 'id_jurusan desc', 'accordion-table', NULL, NULL, '', '', '', NULL, NULL),
(8, NULL, 'Pendaftar', 'EIS_Prodi_MahasiswaCuti', '*', 'id_jurusan=\'0105\'', '-1', 'id_jurusan asc', 'accordion-table', NULL, NULL, 'Tabulasi Pendaftar Sistem Informasi', 'kdta', '0', NULL, NULL),
(9, NULL, 'Pendaftar', 'EIS_Prodi_Pendaftar', '*', 'id_jurusan=\'0105\'', '-1', 'id_jurusan asc', 'morris-line-chart', NULL, NULL, 'Tabulasi Pendaftar Sistem Informasi', 'ta', '0', NULL, NULL),
(10, NULL, 'Pendaftar', 'EIS_Prodi_Pendaftar', '*', 'id_jurusan=\'0105\'', '-1', 'id_jurusan asc', 'morris-line-chart', NULL, NULL, 'Tabulasi Pendaftar Sistem Informasi', 'ta', '0', NULL, NULL),
(11, NULL, 'Pendaftar', 'EIS_Prodi_Pendaftar', '*', 'id_jurusan=\'0105\'', '-1', 'id_jurusan asc', 'accordion-table', NULL, NULL, 'Tabulasi Pendaftar Sistem Informasi', 'ta', '0', NULL, NULL),
(12, NULL, '', '', '', '', '', '', 'header', NULL, NULL, '', '', '', 'Ini title', 'h1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu_access_view`
--
ALTER TABLE `user_sub_menu_access_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_view`
--
ALTER TABLE `user_view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_sub_menu_access_view`
--
ALTER TABLE `user_sub_menu_access_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_view`
--
ALTER TABLE `user_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
