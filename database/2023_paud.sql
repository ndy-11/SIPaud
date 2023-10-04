-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 11:36 AM
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
-- Table structure for table `tb_aspek_perkembangan`
--

CREATE TABLE `tb_aspek_perkembangan` (
  `id` int(11) NOT NULL,
  `kode_mapel` varchar(4) NOT NULL,
  `sub_mapel` varchar(50) NOT NULL,
  `pertanyaan_penilaian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_aspek_perkembangan`
--

INSERT INTO `tb_aspek_perkembangan` (`id`, `kode_mapel`, `sub_mapel`, `pertanyaan_penilaian`) VALUES
(1, '1', '-', 'Mengetahui agama yang dianutnya'),
(2, '1', '-', 'Meniru gerakan beribadah dengan urutan yang benar'),
(3, '1', '-', 'Mengucapkan doa sebelum dan/sesudah melakukan sesuatu'),
(4, '1', '-', 'Mengenal perilaku baik/sopan dan buruk'),
(5, '1', '-', 'Membiasakan diri berperilaku baik'),
(6, '1', '-', 'Mengucapkan salam dan membalas salam'),
(7, '2', 'Motorik Kasar', 'Meniru gerakan binatang, pohon tertiup angin, pesawat terbang, dsb'),
(8, '2', 'Motorik Kasar', 'Melakukan gerakan menggelantung (bergelayut)'),
(9, '2', 'Motorik Kasar', 'Melakukan gerakan melompat, meloncat dan berlari secara terkoordinasi'),
(10, '2', 'Motorik Kasar', 'Melempar sesuatu secara terarah'),
(11, '2', 'Motorik Kasar', 'Menangkap sesuatu secara tepat'),
(12, '2', 'Motorik Kasar', 'Melakukan gerakan antisipasi'),
(13, '2', 'Motorik Kasar', 'Menendang sesuatu secara terarah'),
(14, '2', 'Motorik Kasar', 'Memanfaatkan alat permainan diluar kelas'),
(15, '2', 'Motorik Halus', 'Membuat garis vertikal,horizontal, lengkung kiri/kanan, miring kiri/kanan dan lingkaran'),
(16, '2', 'Motorik Halus', 'Menjiplak bentuk'),
(17, '2', 'Motorik Halus', 'Mengkoordinasikan mata dan tangan untuk melakukan gerakan yang rumit'),
(18, '2', 'Motorik Halus', 'Melakukan gerakan manipulatif untuk menghasilkan suatu bentuk dengan menggunakan berbagai media'),
(19, '2', 'Motorik Halus', 'Mengekspresikan diri dengan berkarya seni menggunakan berbagai media'),
(20, '2', 'Motorik Halus', 'Mengontrol gerakan tangan yang menggunakan otot halus (menjumput, mengelus, mencolek, mengepal, memelintir, memillin, memeras)'),
(21, '2', 'Kesehatan dan Perilaku Keselamatan', 'Berat badan sesuai tingkat usia'),
(22, '2', 'Kesehatan dan Perilaku Keselamatan', 'Tinggi badan sesuai tingkat usia'),
(23, '2', 'Kesehatan dan Perilaku Keselamatan', 'Berat badan sesuai dengan standar tinggi badan'),
(24, '2', 'Kesehatan dan Perilaku Keselamatan', 'Lingkar kepala sesuai tingkat usia'),
(25, '2', 'Kesehatan dan Perilaku Keselamatan', 'Menggukan toilet (penggunaan air, membersihkan diri) dengan bantuan minimal'),
(26, '2', 'Kesehatan dan Perilaku Keselamatan', 'Memahami berbagai alarm bahaya (kebakaran, banjir, gempa)'),
(27, '2', 'Kesehatan dan Perilaku Keselamatan', 'Mengenal rambu lalu lintas yang ada di jalan'),
(28, '3', 'Belajar dan Pemecahan Masalah', 'Mengenal benda berdasarkan fungsi (pisau untuk memotong, pensil untuk menulis)'),
(29, '3', 'Belajar dan Pemecahan Masalah', 'Menggunkan benda benda sebagai permainan simbolik (kursi sebagai mobil)'),
(30, '3', 'Belajar dan Pemecahan Masalah', 'Mengenal konsep sederhana dalam kehidupan sehari-hari (gerimis, hujan, gelap dsb)'),
(31, '3', 'Belajar dan Pemecahan Masalah', 'Mengetahui konsep banyak dan sedikit'),
(32, '3', 'Belajar dan Pemecahan Masalah', 'Mengkreasikan sesuatu sesuai dengan idenya sendiri yang terkait dengan berbagai pemecahan masalah'),
(33, '3', 'Belajar dan Pemecahan Masalah', 'Mengamati benda dan gejala dengan rasa ingin tahu'),
(34, '3', 'Belajar dan Pemecahan Masalah', 'Mengenal pola kegiatan dan menyadari pentingnya waktu'),
(35, '3', 'Belajar dan Pemecahan Masalah', 'Memahami posisi/kedudukan dalam keluarga, ruang, lingkungan sosial (misal:sebagai peserta)'),
(36, '3', 'Berpikir Logis', 'Mengklasifikasikan benda berdasarkan fungsi, bentuk atau warna atau ukuran'),
(37, '3', 'Berpikir Logis', 'Mengenal gejala sebab-akibat yang terkait dengan dirinya'),
(38, '3', 'Berpikir Logis', 'Mengkalsifikasikan benda kedalam kelompok yang sama atau yang sejenis atau kelompok yang berpasangan dengan 2 variasi'),
(39, '3', 'Berpikir Logis', 'Mengenal pola (misal : AB-AB dan ABC-ABC) dan mengulanginya'),
(40, '3', 'Berpikir Logis', 'Mengurutkan benda berdasarkan 5 serias ukuran atau warna'),
(41, '3', 'Berpikir Simbolik', 'Membilang banyak benda satu sampai sepuluh'),
(42, '3', 'Berpikir Simbolik', 'Mengenal konsep bilangan'),
(43, '3', 'Berpikir Simbolik', 'Mengenal lambang bilangan'),
(44, '3', 'Berpikir Simbolik', 'Mengenal lambang huruf'),
(45, '4', 'Memahami Bahasa', 'Menyimak perkataan orang lain (bahasa ibu atau bahasa lainnya)'),
(46, '4', 'Memahami Bahasa', 'Mengerti dua perintah yang diberikan bersamaan'),
(47, '4', 'Memahami Bahasa', 'Memahami cerita yang dibacakan'),
(48, '4', 'Memahami Bahasa', 'Mengenal perbendaharaan kata mengenai kata sifat (nakal, pelit, baik hati, berani, baik, jelek, dll)'),
(49, '4', 'Memahami Bahasa', 'Mendengar dan membedakan bunyi-bunyian dalam bahasa indonesia (contoh : bunyi dan ucapan harus sama)'),
(50, '4', 'Mengungkapkan Bahasa', 'Mengulang kalimat sederhana'),
(51, '4', 'Mengungkapkan Bahasa', 'Bertanya dengan kalimat yang benar'),
(52, '4', 'Mengungkapkan Bahasa', 'Menjawab pertanyaan sesuai pertanyaan'),
(53, '4', 'Mengungkapkan Bahasa', 'Mengungkapkan perasaan dengan kata sifat (baik, senang, nakal, pelit dsb)'),
(54, '4', 'Mengungkapkan Bahasa', 'Menyebutkan kata-kata yang dikenal');

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
(2, 'guru', '77e69c137812518e359196bb2f5e9bb9', 'guru', 'Bagas Kurniawan', 'Laki-laki', NULL, '123456789012345669', 'S1', NULL, '098795875', 'Tangerang', '2021-11-16 03:24:07', '2023-06-29 13:17:45'),
(3, 'indah', 'f3385c508ce54d577fd205a1b2ecdfb7', 'orangtua', 'Indah Permatasari', 'Perempuan', '2023-05-30', '-', '-', 'Islam', '1072510982', 'alamat rumah', '2023-05-30 04:42:47', '2023-06-29 13:50:58'),
(4, 'kepsek', '8561863b55faf85b9ad67c52b3b851ac', 'kepsek', 'Mulyono', 'Laki-laki', '2023-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Revalina Farzani', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'guru1', '92afb435ceb16630e9827f54330c59c9', 'guru', 'guru1', 'Perempuan', '2023-06-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'suryadi', 'b5bc52b16032f3ead952c6e396a2cb57', 'guru', 'Suryadi', 'Laki-laki', '1991-06-29', '-', 'S1', 'Kristen', '09868966970', 'Tangerang', '2023-06-29 12:51:55', '2023-06-29 13:03:08'),
(8, 'bayu', 'a430e06de5ce438d499c2e4063d60fd6', 'guru', 'Bayu Paratama', 'Laki-laki', '1990-06-29', '-', 'S1', 'Islam', '0987558969', 'Tangerang', '2023-06-29 13:22:25', NULL);

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
(1, 'AM', 'AGAMA DAN MORAL', '2021-11-16 03:25:29', '2021-11-16 03:25:29'),
(2, 'FM', 'FISIK MOTORIK', '2021-11-16 03:25:39', '2021-11-16 03:25:39'),
(3, 'K', 'KOGNITIF', '2023-06-23 23:03:48', '2023-06-23 23:03:48'),
(4, 'B', 'BAHASA', '2023-06-23 23:03:48', '2023-06-23 23:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_siswa`
--

CREATE TABLE `tb_data_siswa` (
  `id_siswa` bigint(20) NOT NULL,
  `nm_siswa` varchar(125) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_ortu` int(11) NOT NULL,
  `tahun_masuk` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_siswa`
--

INSERT INTO `tb_data_siswa` (`id_siswa`, `nm_siswa`, `jenis_kelamin`, `tanggal_lahir`, `id_ortu`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
(1, 'Anake Bagas', 'Laki-laki', '2021-11-16', 3, '2020', '2021-11-16 03:24:56', '2021-11-16 03:24:56'),
(4, 'Susanti', 'Perempuan', '2023-06-29', 3, '2020', '2023-06-29 13:58:37', '2023-06-29 13:59:50');

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
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `pengajaran_id` bigint(20) NOT NULL,
  `siswa_id` bigint(20) NOT NULL,
  `mapel_id` bigint(20) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`pengajaran_id`, `siswa_id`, `mapel_id`, `nilai`) VALUES
(1, 1, 1, 88.8235),
(1, 1, 2, 89.0476),
(1, 1, 3, 88.8235),
(1, 1, 4, 95);

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
(1, 2, 1, 1),
(3, 7, 2, 2);

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
(1, 2),
(1, 3),
(1, 4),
(3, 2);

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
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian_aspek_perkembangan`
--

CREATE TABLE `tb_penilaian_aspek_perkembangan` (
  `id` int(11) NOT NULL,
  `id_aspek` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penilaian_aspek_perkembangan`
--

INSERT INTO `tb_penilaian_aspek_perkembangan` (`id`, `id_aspek`, `id_mapel`, `id_siswa`, `id_ta`, `nilai`) VALUES
(55, 1, 1, 1, 1, 80),
(56, 2, 1, 1, 1, 90),
(57, 3, 1, 1, 1, 80),
(58, 4, 1, 1, 1, 80),
(59, 5, 1, 1, 1, 80),
(60, 6, 1, 1, 1, 90),
(61, 7, 2, 1, 1, 90),
(62, 8, 2, 1, 1, 90),
(63, 9, 2, 1, 1, 80),
(64, 10, 2, 1, 1, 80),
(65, 11, 2, 1, 1, 80),
(66, 12, 2, 1, 1, 80),
(67, 13, 2, 1, 1, 100),
(68, 14, 2, 1, 1, 100),
(69, 15, 2, 1, 1, 90),
(70, 16, 2, 1, 1, 80),
(71, 17, 2, 1, 1, 90),
(72, 18, 2, 1, 1, 90),
(73, 19, 2, 1, 1, 90),
(74, 20, 2, 1, 1, 90),
(75, 21, 2, 1, 1, 80),
(76, 22, 2, 1, 1, 80),
(77, 23, 2, 1, 1, 100),
(78, 24, 2, 1, 1, 90),
(79, 25, 2, 1, 1, 100),
(80, 26, 2, 1, 1, 100),
(81, 27, 2, 1, 1, 90),
(82, 28, 3, 1, 1, 100),
(83, 29, 3, 1, 1, 100),
(84, 30, 3, 1, 1, 100),
(85, 31, 3, 1, 1, 100),
(86, 32, 3, 1, 1, 100),
(87, 33, 3, 1, 1, 100),
(88, 34, 3, 1, 1, 100),
(89, 35, 3, 1, 1, 80),
(90, 36, 3, 1, 1, 80),
(91, 37, 3, 1, 1, 80),
(92, 38, 3, 1, 1, 80),
(93, 39, 3, 1, 1, 80),
(94, 40, 3, 1, 1, 80),
(95, 41, 3, 1, 1, 80),
(96, 42, 3, 1, 1, 80),
(97, 43, 3, 1, 1, 80),
(98, 44, 3, 1, 1, 90),
(99, 45, 4, 1, 1, 100),
(100, 46, 4, 1, 1, 100),
(101, 47, 4, 1, 1, 100),
(102, 48, 4, 1, 1, 100),
(103, 49, 4, 1, 1, 100),
(104, 50, 4, 1, 1, 100),
(105, 51, 4, 1, 1, 100),
(106, 52, 4, 1, 1, 90),
(107, 53, 4, 1, 1, 80),
(108, 54, 4, 1, 1, 80);

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
(1, '2023-06-18', 'etaf', 3, 'tes', 'masuk', 2),
(2, '2023-06-19', 'oke', 3, 'selamat', 'keluar', 2),
(3, '2023-06-19', 'as', 3, 'as', 'masuk', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_temp_nilai`
--

CREATE TABLE `tb_temp_nilai` (
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_temp_nilai`
--

INSERT INTO `tb_temp_nilai` (`id_siswa`, `id_mapel`, `nilai`) VALUES
(1, 1, 83.3333),
(1, 2, 89.0476),
(1, 3, 88.8235),
(1, 4, 95);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aspek_perkembangan`
--
ALTER TABLE `tb_aspek_perkembangan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_penilaian_aspek_perkembangan`
--
ALTER TABLE `tb_penilaian_aspek_perkembangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_aspek_perkembangan`
--
ALTER TABLE `tb_aspek_perkembangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  MODIFY `id_mapel` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  MODIFY `id_ta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  MODIFY `id_pengajaran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_penilaian_aspek_perkembangan`
--
ALTER TABLE `tb_penilaian_aspek_perkembangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

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
