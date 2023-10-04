-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 02:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2023_paud`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_autentikasi`
--

CREATE TABLE `tb_autentikasi` (
  `id` bigint(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` enum('admin','guru','orangtua','kepsek') NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `pendidikan_terakhir` varchar(25) DEFAULT NULL,
  `agama` varchar(25) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_autentikasi`
--

INSERT INTO `tb_autentikasi` (`id`, `username`, `password`, `role`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `nip`, `pendidikan_terakhir`, `agama`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'guru', '77e69c137812518e359196bb2f5e9bb9', 'guru', 'Nesciunt consequatu', 'Laki-laki', '2012-04-07', '123456789012345669', 'Voluptate quia irure', 'Et recusandae Nesci', '082299921720', 'Beatae inventore off', '2021-11-16 03:24:07', '2021-11-16 03:24:07'),
(3, 'orangtua', '344c999a63cd55b3035cbf76c2691f88', 'orangtua', 'Orang Tua', 'Perempuan', '2023-05-30', '-', '-', 'Islam', '1072510982', 'alamat rumah', '2023-05-30 04:42:47', '2023-05-30 06:42:47'),
(4, 'kepsek', '8561863b55faf85b9ad67c52b3b851ac', 'kepsek', 'Mulyono', 'Laki-laki', '2023-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Revalina Farzani', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'guru1', '92afb435ceb16630e9827f54330c59c9', 'guru', 'guru1', 'Perempuan', '2023-06-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_mata_pelajaran`
--

CREATE TABLE `tb_data_mata_pelajaran` (
  `id_mapel` bigint(20) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(26) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_mata_pelajaran`
--

INSERT INTO `tb_data_mata_pelajaran` (`id_mapel`, `kode_mapel`, `mata_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'BTQ', 'BTQ', '2021-11-16 03:25:29', '2021-11-16 03:25:29'),
(2, 'IQRA', 'IQRA', '2021-11-16 03:25:39', '2021-11-16 03:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_siswa`
--

CREATE TABLE `tb_data_siswa` (
  `id_siswa` bigint(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_wali` varchar(25) NOT NULL,
  `tahun_masuk` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_siswa`
--

INSERT INTO `tb_data_siswa` (`id_siswa`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `nama_wali`, `tahun_masuk`, `created_at`, `updated_at`, `id`) VALUES
(1, 'Sunt maxime dolor vo', 'Laki-laki', '2021-11-16', 'Sunt maxime', '2020', '2021-11-16 03:24:56', '2021-11-16 03:24:56', 3),
(2, 'Amet ut ut nemo dol', 'Perempuan', '2021-11-16', 'Amet ut ut', '2020', '2021-11-16 03:25:18', '2021-11-16 03:25:18', 3),
(3, 'Pariatur Ipsum dolo', 'Perempuan', '2001-06-20', 'Quidem rep', '2020', '2021-11-16 04:51:17', '2021-11-16 04:51:17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_tahun_ajaran`
--

CREATE TABLE `tb_data_tahun_ajaran` (
  `id_ta` bigint(20) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_tahun_ajaran`
--

INSERT INTO `tb_data_tahun_ajaran` (`id_ta`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(1, '2020/2021', '2', '2021-11-16 03:25:46', '2021-11-16 03:25:46'),
(2, '2021/2022', '1', '2021-11-16 04:08:15', '2021-11-16 04:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(5) NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `jk` varchar(40) NOT NULL,
  `status` int(1) NOT NULL,
  `role` varchar(10) NOT NULL,
  `email_guru` varchar(100) NOT NULL,
  `pend_terakhir` varchar(5) NOT NULL,
  `nmr_hp` varchar(16) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `username`, `password`, `jk`, `status`, `role`, `email_guru`, `pend_terakhir`, `nmr_hp`, `alamat`) VALUES
(1, 'guru', 'guru', '77e69c137812518e359196bb2f5e9bb9', 'Laki-Laki', 1, 'guru', 'email@gmail.com', 'S1', '081928283737', 'cibodas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `pengajaran_id` bigint(20) NOT NULL,
  `siswa_id` bigint(20) NOT NULL,
  `mapel_id` bigint(20) NOT NULL,
  `nilai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`pengajaran_id`, `siswa_id`, `mapel_id`, `nilai`) VALUES
(1, 1, 1, 70),
(1, 1, 2, 80),
(1, 2, 1, 0),
(1, 2, 2, 0),
(1, 3, 1, 39),
(1, 3, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajaran`
--

CREATE TABLE `tb_pengajaran` (
  `id_pengajaran` bigint(20) NOT NULL,
  `guru_id` bigint(20) NOT NULL,
  `ta_id` bigint(20) NOT NULL,
  `kelas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajaran`
--

INSERT INTO `tb_pengajaran` (`id_pengajaran`, `guru_id`, `ta_id`, `kelas`) VALUES
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajaran_mapel`
--

CREATE TABLE `tb_pengajaran_mapel` (
  `pengajaran_id` bigint(20) NOT NULL,
  `mapel_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajaran_mapel`
--

INSERT INTO `tb_pengajaran_mapel` (`pengajaran_id`, `mapel_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajaran_siswa`
--

CREATE TABLE `tb_pengajaran_siswa` (
  `pengajaran_id` bigint(20) NOT NULL,
  `siswa_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajaran_siswa`
--

INSERT INTO `tb_pengajaran_siswa` (`pengajaran_id`, `siswa_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesan`
--

CREATE TABLE `tb_pesan` (
  `id_pesan` int(5) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `isi_pesan` text NOT NULL,
  `id` int(5) NOT NULL,
  `subjek` varchar(200) NOT NULL,
  `status_pesan` varchar(15) NOT NULL,
  `id_guru` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pesan`
--

INSERT INTO `tb_pesan` (`id_pesan`, `tgl_pesan`, `isi_pesan`, `id`, `subjek`, `status_pesan`, `id_guru`) VALUES
(1, '2023-06-18', 'etaf', 3, 'tes', 'masuk', 1),
(2, '2023-06-19', 'oke', 3, 'selamat', 'keluar', 1),
(3, '2023-06-19', 'as', 3, 'as', 'masuk', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`pengajaran_id`,`siswa_id`,`mapel_id`),
  ADD KEY `tb_nilai_ibfk_3` (`siswa_id`),
  ADD KEY `tb_nilai_ibfk_4` (`mapel_id`);

--
-- Indexes for table `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  ADD PRIMARY KEY (`id_pengajaran`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `ta_id` (`ta_id`);

--
-- Indexes for table `tb_pengajaran_mapel`
--
ALTER TABLE `tb_pengajaran_mapel`
  ADD PRIMARY KEY (`pengajaran_id`,`mapel_id`),
  ADD KEY `tb_pengajaran_mapel_ibfk_1` (`mapel_id`);

--
-- Indexes for table `tb_pengajaran_siswa`
--
ALTER TABLE `tb_pengajaran_siswa`
  ADD PRIMARY KEY (`pengajaran_id`,`siswa_id`),
  ADD KEY `tb_pengajaran_siswa_ibfk_2` (`siswa_id`);

--
-- Indexes for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  MODIFY `id_mapel` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  MODIFY `id_ta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  MODIFY `id_pengajaran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  MODIFY `id_pesan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `tb_nilai_ibfk_2` FOREIGN KEY (`pengajaran_id`) REFERENCES `tb_pengajaran` (`id_pengajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_3` FOREIGN KEY (`siswa_id`) REFERENCES `tb_pengajaran_siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_4` FOREIGN KEY (`mapel_id`) REFERENCES `tb_pengajaran_mapel` (`mapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  ADD CONSTRAINT `tb_pengajaran_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `tb_autentikasi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengajaran_ibfk_2` FOREIGN KEY (`ta_id`) REFERENCES `tb_data_tahun_ajaran` (`id_ta`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_pengajaran_mapel`
--
ALTER TABLE `tb_pengajaran_mapel`
  ADD CONSTRAINT `tb_pengajaran_mapel_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `tb_data_mata_pelajaran` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengajaran_mapel_ibfk_2` FOREIGN KEY (`pengajaran_id`) REFERENCES `tb_pengajaran` (`id_pengajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pengajaran_siswa`
--
ALTER TABLE `tb_pengajaran_siswa`
  ADD CONSTRAINT `tb_pengajaran_siswa_ibfk_1` FOREIGN KEY (`pengajaran_id`) REFERENCES `tb_pengajaran` (`id_pengajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengajaran_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `tb_data_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
