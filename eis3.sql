-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2020 at 02:02 AM
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
-- Database: `eis3`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jsonFile` longtext,
  `view_name` varchar(255) NOT NULL,
  `select` varchar(255) NOT NULL,
  `where` varchar(255) NOT NULL,
  `limit` varchar(255) NOT NULL,
  `order_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`) VALUES
(10, 'Dashboard'),
(17, 'Pendaftaran'),
(24, 'Mahasiswa'),
(25, 'Presensi'),
(26, 'Bimbingan');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
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
-- Table structure for table `role_access_menu`
--

CREATE TABLE `role_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_access_menu`
--

INSERT INTO `role_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(59, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `role_access_sub_menu`
--

CREATE TABLE `role_access_sub_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_access_sub_menu`
--

INSERT INTO `role_access_sub_menu` (`id`, `role_id`, `sub_menu_id`) VALUES
(29, 3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `by`) VALUES
(12, 2, 'List User', 'user/index', '', 1, NULL),
(13, 6, 'List Role', 'user_role/index', '', 1, NULL),
(14, 7, 'List Menu', 'user_menu/index', '', 1, NULL),
(18, 5, 'List View', 'user_view/index', 'fa', 1, NULL),
(19, 10, 'Home', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67675475djbd', 'fa fa-home', 1, '1'),
(20, 17, 'Grafik Perbandingan', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432g', 'fa fa-home', 1, '2'),
(21, 17, 'Pendaftar', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432pd', 'fa fa-home', 1, NULL),
(22, 17, 'Pendaftar Daftar Ulang', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432pdu', 'fa fa-home', 1, NULL),
(23, 17, 'Pendaftar Tidak Daftar Ulang', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b43ptdu', 'fa fa-home', 1, NULL),
(24, 24, 'Mahasiswa Aktif', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b43ma', 'fa fa-home', 1, NULL),
(25, 24, 'Mahasiswa Cuti', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432mc', 'fa fa-home', 1, NULL),
(26, 24, 'Mahasiswa Lulus Per TA', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432ta', 'fa fa-home', 1, NULL),
(27, 24, 'Mahasiswa Lulus Per Angkatan', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432mlpta', 'fa fa-home', 0, NULL),
(28, 24, 'Mahasiswa Lulus Tepat Waktu', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432mltpw0', 'fa fa-home', 1, NULL),
(29, 24, 'Mahasiswa Lulus IPK Tertentu', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432mlipk', 'fa fa-home', 1, NULL),
(30, 24, 'Mahasiswa Habis Masa Studi', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432mhms', 'fa fa-home', 1, NULL),
(31, 24, 'Mahasiswa Re -NPM', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432re', 'fa fa-home', 1, NULL),
(32, 25, 'Presensi Mahasiswa', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432pm', 'fa fa-home', 1, NULL),
(33, 25, 'Presensi Dosen', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432pdgfsgfjs', 'fa fa-home', 1, NULL),
(34, 26, 'Bimbingan PA', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432bpa', 'fa fa-home', 1, NULL),
(36, 27, 'Coba accordion-table', 'core_system/index/b63b3b817f9dbb51007c8c1eb47c1ae2ff79829b57c605d7ba5c6bbb5d67b432', 'fa fa-home', 1, '1'),
(37, 10, 'Card Mahasiswa Aktif', 'core_system/index/71ce24ad63461f5410e826e2d8ba63797cac62e057cfbe68daa839b33a77a8c5', 'fa fa-home', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu_access_view`
--

CREATE TABLE `sub_menu_access_view` (
  `id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu_access_view`
--

INSERT INTO `sub_menu_access_view` (`id`, `sub_menu_id`, `view_id`, `is_active`, `by`) VALUES
(19, 19, 22, 1, '1'),
(20, 19, 24, 1, '1');

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
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `id` int(11) NOT NULL,
  `type` enum('morris-line-chart','morris-bar-chart','morris-area-chart','morris-donout','table','accordion-table','header','tab','card') DEFAULT NULL,
  `api_id` int(11) DEFAULT NULL,
  `tableHeader` longtext,
  `tableTitle` varchar(255) DEFAULT NULL,
  `accordionTableTitle` varchar(255) DEFAULT NULL,
  `accordionTablePer` varchar(255) DEFAULT NULL,
  `headerTitle` varchar(255) DEFAULT NULL,
  `sizeText` varchar(255) DEFAULT NULL COMMENT 'example h1,h2',
  `chartTitle` varchar(255) DEFAULT NULL,
  `chartXkey` varchar(255) DEFAULT NULL,
  `chartYkey` varchar(255) DEFAULT NULL,
  `chartColor` varchar(255) DEFAULT NULL,
  `chartMap` varchar(255) DEFAULT NULL,
  `cardTitle` varchar(255) DEFAULT NULL,
  `cardWidth` varchar(255) DEFAULT NULL,
  `cardFilter` varchar(255) DEFAULT NULL,
  `cardDetail` varchar(255) DEFAULT NULL,
  `cardIcon` varchar(255) DEFAULT NULL,
  `cardColor` varchar(255) DEFAULT NULL,
  `tabData` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `view`
--

INSERT INTO `view` (`id`, `type`, `api_id`, `tableHeader`, `tableTitle`, `accordionTableTitle`, `accordionTablePer`, `headerTitle`, `sizeText`, `chartTitle`, `chartXkey`, `chartYkey`, `chartColor`, `chartMap`, `cardTitle`, `cardWidth`, `cardFilter`, `cardDetail`, `cardIcon`, `cardColor`, `tabData`) VALUES
(22, 'card', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jumlah Pendaftar', '4', '{\"ta\":\"2020\\/2021\",\"id_jurusan\":\"0105\"}', 'Pendaftar di Sistem Informasi', 'fa fa-users', 'primary', NULL),
(24, 'card', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jumlah Pendaftar', '4', '{\"ta\":\"2020\\/2021\"}', 'Pendaftar di Sistem Informasi', 'fa fa-users', 'primary', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access_sub_menu`
--
ALTER TABLE `role_access_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menu_access_view`
--
ALTER TABLE `sub_menu_access_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `role_access_sub_menu`
--
ALTER TABLE `role_access_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sub_menu_access_view`
--
ALTER TABLE `sub_menu_access_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `view`
--
ALTER TABLE `view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
