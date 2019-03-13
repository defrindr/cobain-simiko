-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2019 at 05:02 AM
-- Server version: 10.1.38-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '14', 1551699147),
('Admin', '4', 1549516667),
('Guru', '12', 1551394325),
('Guru', '13', 1551499840),
('Guru', '5', 1551505462),
('Siswa', '7', 1550022660),
('Siswa', '8', 1552275815),
('spp-manage', '5', 1551505469),
('spp.validator', '6', 1552424176),
('tambah-admin', '4', 1551699038),
('user-manage.activate', '4', 1550094562),
('user-manage.deactivate', '4', 1550094562);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8,
  `rule_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1551504594, 1551504594),
('/bank/*', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/bank/add-module-spp', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/bank/create', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/bank/data-restore', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/bank/delete', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/bank/dpermanent', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/bank/index', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/bank/restore', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/bank/update', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/bank/view', 2, NULL, NULL, NULL, 1551504620, 1551504620),
('/berita/*', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/create', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/create-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/data-restore', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/data-restore-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/delete', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/delete-image', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/delete-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/dpermanent', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/dpermanent-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/index', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/restore', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/restore-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/update', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/update-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/berita/view', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/galeri/*', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/create', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/create-kategori', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/data-restore', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/galeri/data-restore-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/galeri/delete', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/delete-kategori', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/dpermanent', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/dpermanent-kategori', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/index', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/galeri/restore', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/galeri/restore-kategori', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/galeri/update', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/update-kategori', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/galeri/view', 2, NULL, NULL, NULL, 1551504621, 1551504621),
('/guru/*', 2, NULL, NULL, NULL, 1551504232, 1551504232),
('/guru/add-module-kelas', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/create', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/data-restore', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/delete', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/index', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/restore', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/update', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/guru/view', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/jurusan/*', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/jurusan/add-module-kelas', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/jurusan/create', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/jurusan/data-restore', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/jurusan/delete', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/jurusan/index', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/jurusan/restore', 2, NULL, NULL, NULL, 1551504622, 1551504622),
('/jurusan/update', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/*', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/add-module-jadwal', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/add-module-materi', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/add-module-siswa', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/create', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/data-restore', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/delete', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/index', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/restore', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/update', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/kelas/view', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/*', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/mata-pelajaran/add-module-guru', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/add-module-jadwal', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/mata-pelajaran/add-module-materi-kategori', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/mata-pelajaran/create', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/data-restore', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/delete', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/dpermanent', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/index', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/restore', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/mata-pelajaran/update', 2, NULL, NULL, NULL, 1551504623, 1551504623),
('/materi-file/*', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/create', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/data-restore', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/delete', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/index', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/restore', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/update', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-file/view', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-kategori/*', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-kategori/add-module-materi', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-kategori/create', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-kategori/data-restore', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-kategori/delete', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-kategori/index', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-kategori/restore', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-kategori/update', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-kategori/view', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi-komentar/*', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/create', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/data-restore', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/delete', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/index', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/restore', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/update', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-komentar/view', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal-file/*', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-file/create', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-file/data-restore', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-file/delete', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-file/index', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal-file/restore', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-file/update', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-file/view', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/*', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/create', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/data-restore', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/delete', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/index', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/restore', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/update', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal-jawaban/view', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/materi-soal/*', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/add-module-materi-soal-file', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/add-module-materi-soal-jawaban', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/create', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/data-restore', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/delete', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/index', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/restore', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/update', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi-soal/view', 2, NULL, NULL, NULL, 1551504625, 1551504625),
('/materi/*', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/add-module-materi-file', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/add-module-materi-komentar', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/add-module-materi-soal', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/create', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/data-restore', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/delete', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/index', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/restore', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/update', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/materi/view', 2, NULL, NULL, NULL, 1551504624, 1551504624),
('/profile/*', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/profile/all', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/profile/data-restore', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/profile/delete', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/profile/index', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/profile/restore', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/profile/update', 2, NULL, NULL, NULL, 1551504626, 1551504626),
('/profile/view-modal', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/*', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/add-module-spp', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/create', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/data-restore', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/delete', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/index', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/restore', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/update', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/siswa/view', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/site/*', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/site/error', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/site/index', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/site/login', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/site/logout', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/spp/*', 2, NULL, NULL, NULL, 1551504628, 1551504628),
('/spp/create', 2, NULL, NULL, NULL, 1551504628, 1551504628),
('/spp/data-restore', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/spp/delete', 2, NULL, NULL, NULL, 1551504628, 1551504628),
('/spp/index', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/spp/pdf', 2, NULL, NULL, NULL, 1551504628, 1551504628),
('/spp/restore', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/spp/update', 2, NULL, NULL, NULL, 1551504628, 1551504628),
('/spp/view', 2, NULL, NULL, NULL, 1551504627, 1551504627),
('/user-manage/*', 2, NULL, NULL, NULL, 1551504594, 1551504594),
('/user-manage/activate', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/add-module-materi-komentar', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/create-guru', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/create-siswa', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/data-restore', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/deactivate', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/delete', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/index', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/update', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('/user-manage/view', 2, NULL, NULL, NULL, 1551504593, 1551504593),
('Admin', 1, 'Role Admin', NULL, NULL, 1549504955, 1549529357),
('bank.create', 2, 'permission to create bank', NULL, NULL, 1549594745, 1549594745),
('bank.delete', 2, 'permission to delete bank', NULL, NULL, 1549594843, 1549594843),
('bank.index', 2, 'permission to show index', NULL, NULL, 1549551175, 1549551175),
('bank.restore', 2, NULL, NULL, NULL, 1552279736, 1552279736),
('bank.update', 2, 'permission to update bank', NULL, NULL, 1549594812, 1549594812),
('berita-kategori.create', 2, 'permission to create berita kategori', NULL, NULL, 1549516188, 1549516188),
('berita-kategori.delete', 2, NULL, NULL, NULL, 1549837790, 1549837790),
('berita-kategori.manage', 2, NULL, NULL, NULL, 1549519192, 1549519192),
('berita-kategori.update', 2, NULL, NULL, NULL, 1549519135, 1549519135),
('berita.create', 2, 'permission to create berita', NULL, NULL, 1549504855, 1549504855),
('berita.delete', 2, 'permission to delete berita', NULL, NULL, 1549504904, 1549504904),
('berita.index', 2, 'permission to show index berita', NULL, NULL, 1549507997, 1549507997),
('berita.update', 2, 'permission to update berita', NULL, NULL, 1549504886, 1549504886),
('berita.view', 2, 'permission to view berita', NULL, NULL, 1549504930, 1549504930),
('galeri-kategori.create', 2, 'permission to create galeri kategori', NULL, NULL, 1549775826, 1549775826),
('galeri-kategori.delete', 2, NULL, NULL, NULL, 1549775783, 1549775783),
('galeri-kategori.update', 2, 'permission to update galeri kategori', NULL, NULL, 1549775855, 1549775855),
('galeri.create', 2, NULL, NULL, NULL, 1549747510, 1549747510),
('galeri.delete', 2, NULL, NULL, NULL, 1550761321, 1550761321),
('galeri.update', 2, NULL, NULL, NULL, 1549750066, 1549750066),
('Guru', 1, 'Role for teacher', NULL, NULL, 1549529378, 1549529378),
('jurusan.create', 2, 'permission to create new jurusan', NULL, NULL, 1549860859, 1549860859),
('jurusan.delete', 2, 'permission to delete data jurusan', NULL, NULL, 1549860914, 1549860914),
('jurusan.update', 2, 'permission to update data jurusan', NULL, NULL, 1549860885, 1549860885),
('mapel.create', 2, NULL, NULL, NULL, 1550045975, 1550045975),
('mapel.delete', 2, NULL, NULL, NULL, 1551340216, 1551340216),
('mapel.update', 2, NULL, NULL, NULL, 1550046179, 1550046179),
('materi', 2, NULL, NULL, NULL, 1552280680, 1552280680),
('Siswa', 1, 'Role for student', NULL, NULL, 1549529394, 1549529394),
('siswa.create', 2, NULL, NULL, NULL, 1550543083, 1550543083),
('siswa.data-restore', 2, NULL, NULL, NULL, 1550543095, 1550543095),
('siswa.delete', 2, NULL, NULL, NULL, 1550543112, 1550543112),
('siswa.index', 2, NULL, NULL, NULL, 1550543102, 1550543102),
('siswa.update', 2, NULL, NULL, NULL, 1550546338, 1550546338),
('siswa.view', 2, NULL, NULL, NULL, 1550544470, 1550544470),
('spp-manage', 2, NULL, NULL, NULL, 1551505416, 1551505556),
('spp.create', 2, 'permission to create spp', NULL, NULL, 1552187522, 1552276946),
('spp.delete', 2, 'permission to delete spp\r\n', NULL, NULL, 1552276999, 1552276999),
('spp.index', 2, 'permission to view index', NULL, NULL, 1552277274, 1552277274),
('spp.update', 2, 'permission to update spp\r\n', NULL, NULL, 1552276965, 1552276965),
('spp.validator', 2, 'permission to check valid or not spp', NULL, NULL, 1552424108, 1552424108),
('spp.view', 2, NULL, NULL, NULL, 1552277358, 1552277358),
('tambah-admin', 2, NULL, NULL, NULL, 1551699019, 1551699019),
('user-manage.activate', 2, NULL, NULL, NULL, 1550057440, 1550057440),
('user-manage.deactivate', 2, NULL, NULL, NULL, 1550057456, 1550057456);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'bank.create'),
('Admin', 'bank.delete'),
('Admin', 'bank.index'),
('Admin', 'bank.restore'),
('Admin', 'bank.update'),
('Admin', 'berita-kategori.create'),
('Admin', 'berita-kategori.delete'),
('Admin', 'berita-kategori.manage'),
('Admin', 'berita-kategori.update'),
('Admin', 'berita.create'),
('Admin', 'berita.delete'),
('Admin', 'berita.index'),
('Admin', 'berita.update'),
('Admin', 'berita.view'),
('Admin', 'galeri-kategori.create'),
('Admin', 'galeri-kategori.delete'),
('Admin', 'galeri-kategori.update'),
('Admin', 'galeri.create'),
('Admin', 'galeri.delete'),
('Admin', 'galeri.update'),
('Admin', 'Guru'),
('Admin', 'jurusan.create'),
('Admin', 'jurusan.delete'),
('Admin', 'jurusan.update'),
('Admin', 'mapel.create'),
('Admin', 'mapel.delete'),
('Admin', 'mapel.update'),
('Admin', 'materi'),
('Admin', 'Siswa'),
('Admin', 'siswa.create'),
('Admin', 'siswa.data-restore'),
('Admin', 'siswa.delete'),
('Admin', 'siswa.index'),
('Admin', 'siswa.update'),
('Admin', 'siswa.view'),
('Admin', 'spp-manage'),
('Admin', 'spp.validator'),
('Admin', 'user-manage.activate'),
('Admin', 'user-manage.deactivate'),
('bank.create', '/bank/create'),
('bank.delete', '/bank/delete'),
('bank.index', '/bank/index'),
('bank.restore', '/bank/data-restore'),
('bank.restore', '/bank/dpermanent'),
('bank.restore', '/bank/restore'),
('bank.update', '/bank/update'),
('berita-kategori.manage', 'berita-kategori.create'),
('berita-kategori.manage', 'berita-kategori.delete'),
('berita-kategori.manage', 'berita-kategori.update'),
('Guru', 'materi'),
('materi', '/materi-file/*'),
('materi', '/materi-file/create'),
('materi', '/materi-file/data-restore'),
('materi', '/materi-file/delete'),
('materi', '/materi-file/index'),
('materi', '/materi-file/restore'),
('materi', '/materi-file/update'),
('materi', '/materi-file/view'),
('materi', '/materi-kategori/*'),
('materi', '/materi-kategori/add-module-materi'),
('materi', '/materi-kategori/create'),
('materi', '/materi-kategori/data-restore'),
('materi', '/materi-kategori/delete'),
('materi', '/materi-kategori/index'),
('materi', '/materi-kategori/restore'),
('materi', '/materi-kategori/update'),
('materi', '/materi-kategori/view'),
('materi', '/materi-komentar/*'),
('materi', '/materi-komentar/create'),
('materi', '/materi-komentar/data-restore'),
('materi', '/materi-komentar/delete'),
('materi', '/materi-komentar/index'),
('materi', '/materi-komentar/restore'),
('materi', '/materi-komentar/update'),
('materi', '/materi-komentar/view'),
('materi', '/materi-soal-file/*'),
('materi', '/materi-soal-file/create'),
('materi', '/materi-soal-file/data-restore'),
('materi', '/materi-soal-file/delete'),
('materi', '/materi-soal-file/index'),
('materi', '/materi-soal-file/restore'),
('materi', '/materi-soal-file/update'),
('materi', '/materi-soal-file/view'),
('materi', '/materi-soal-jawaban/*'),
('materi', '/materi-soal-jawaban/create'),
('materi', '/materi-soal-jawaban/data-restore'),
('materi', '/materi-soal-jawaban/delete'),
('materi', '/materi-soal-jawaban/index'),
('materi', '/materi-soal-jawaban/restore'),
('materi', '/materi-soal-jawaban/update'),
('materi', '/materi-soal-jawaban/view'),
('materi', '/materi-soal/*'),
('materi', '/materi-soal/add-module-materi-soal-file'),
('materi', '/materi-soal/add-module-materi-soal-jawaban'),
('materi', '/materi-soal/create'),
('materi', '/materi-soal/data-restore'),
('materi', '/materi-soal/delete'),
('materi', '/materi-soal/index'),
('materi', '/materi-soal/restore'),
('materi', '/materi-soal/update'),
('materi', '/materi-soal/view'),
('materi', '/materi/*'),
('materi', '/materi/add-module-materi-file'),
('materi', '/materi/add-module-materi-komentar'),
('materi', '/materi/add-module-materi-soal'),
('materi', '/materi/create'),
('materi', '/materi/data-restore'),
('materi', '/materi/delete'),
('materi', '/materi/index'),
('materi', '/materi/restore'),
('materi', '/materi/update'),
('materi', '/materi/view'),
('Siswa', 'bank.index'),
('Siswa', 'spp.create'),
('Siswa', 'spp.delete'),
('Siswa', 'spp.index'),
('Siswa', 'spp.update'),
('Siswa', 'spp.view'),
('spp-manage', '/spp/*'),
('spp-manage', '/spp/pdf'),
('spp.create', '/spp/create'),
('spp.delete', '/spp/delete'),
('spp.index', '/spp/index'),
('spp.update', '/spp/update'),
('spp.validator', '/spp/*'),
('spp.view', '/spp/view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1543992559),
('m130524_201442_init', 1543992561),
('m140506_102106_rbac_init', 1542255981),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1542255981),
('m180523_151638_rbac_updates_indexes_without_prefix', 1542255981);

-- --------------------------------------------------------

--
-- Table structure for table `module_bank`
--

CREATE TABLE `module_bank` (
  `id` int(11) NOT NULL,
  `no_rekening` varchar(45) NOT NULL,
  `nama_bank` varchar(30) NOT NULL,
  `atas_nama` varchar(45) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_bank`
--

INSERT INTO `module_bank` (`id`, `no_rekening`, `nama_bank`, `atas_nama`, `gambar`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, '1000000000', 'aldana123', 'siswa1', '21769537e1133ad50560a5e545675795_41_1549594578.jpg', 0, 0, 4, 1552280190, 0, '2019-03-11 11:56:30', 12),
(2, '1010101010', 'BNI 2', 'sri astuti', '21769537e1133ad50560a5e545675795_12_1550403000.jpg', 4, 2147483647, 4, 1550403000, 0, '2019-02-10 22:13:00', 6),
(3, '110011001001', 'BNI 1', 'Wahyu widodo', '21769537e1133ad50560a5e545675795_47_1551159555.jpg', 4, 2147483647, 4, 1551159555, 0, '2019-02-10 05:01:48', 3),
(4, '1000020000100', 'BPT', 'rahardian wisma', '21769537e1133ad50560a5e545675795_87_1550402976.jpg', 4, 1549774190, 4, 1550402976, 0, '2019-02-10 11:49:50', 2);

-- --------------------------------------------------------

--
-- Table structure for table `module_berita`
--

CREATE TABLE `module_berita` (
  `id` int(11) NOT NULL,
  `berita_kategori_id` int(11) NOT NULL,
  `judul` varchar(65) NOT NULL,
  `isi` longtext NOT NULL,
  `gambar` varchar(150) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_berita`
--

INSERT INTO `module_berita` (`id`, `berita_kategori_id`, `judul`, `isi`, `gambar`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 2, 'Yui - Why me', 'test artikel', 'fcad518f19f91be5958f6e38f4795749_27_1550500361.jpg', 4, 2147483647, 4, 1550500361, 0, '2019-02-17 10:38:19', 16),
(2, 2, 'YUI - feel my soul', 'Yui - feel my soul\r\n\r\nNakitsu karetetan da toi kakeru basho mo naku\r\nMayoi nagara tsumazuite mo tachi domare nai\r\nKimi ga kureta egao otoshita namida wa\r\nBoku no mune no fukai kizu ni furete kieta\r\n\r\nI feel my soul Take me your way\r\nsou tatta hitotsu wo Kitto daremo ga zutto sagashiteru no\r\n\r\nSore wa guuzen dewa nakute\r\nitsuwari no ai nanka ja nakute\r\nYou’re right, all right\r\nYou’re right, all right Scare little boy\r\n\r\nNando mo kurikaesu douka ikanaide\r\nSasayaku you na kimi no koe wa itoshikute\r\n\r\nI feel my soul Take me your way\r\nmou furimukanai\r\nKitto kono te de ima tashikametai yo\r\n\r\nItsumo tanjun na hodo kurushinde\r\nikite yuku imi wo shiritai kara\r\nYou’re right, all right\r\nYou’re right, all right Scare little boy\r\n\r\nSotto tsubuyaita kimi no kotoba you say it\r\nUgokidase mienai kedo michi wa hirakareteru\r\n\r\nI feel my soul Take me your way\r\nsou mogaki nagara mo\r\nKitto kono mama zutto aruite yukeru\r\n\r\nSore wa guuzen demo nakutte\r\narifureta yume nanka ja nakutte\r\nYou’re right, all right You’re right, all right\r\n\r\nItsumo tanjun na hodo kurushinde\r\nyorokobi no imi wo shiritai kara\r\nYou’re right, all right\r\nYou’re right, all right Scare little boy\r\n\r\nTerjemahan Indonesia\r\n\r\nAku telah lelah menangis Tak ada tempat lagi bagiku untuk bertanya\r\nWalau aku tersandung dan ragu-ragu, aku tak bisa berhenti\r\nSenyum yang kau berikan padaku serta air mata yang mengalir\r\nMenyentuh dan menghapus luka yang dalam di hatiku\r\n\r\nAku merasakan jiwaku, bawa aku ke jalanmu\r\nYa, aku yakin setiap orang selalu mencari satu hal yang berharga\r\n\r\nIni bukanlah kebetulan\r\nJuga bukan cinta yang salah\r\nKau benar, semua benar\r\nKau benar, semua benar Anak kecil yang penakut\r\n\r\nAku mengulangnya berkali-kali, bagaimanapun tanpa berlanjut\r\nSuara bisikanmu sangat menyenangkan\r\n\r\nAku merasakan jiwaku, bawa aku ke jalanmu\r\nAku tak akan berbalik lagi\r\nSekarang, aku pasti akan membuktikannya dengan tanganku ini\r\n\r\nAku sangat menderita karena sesuatu yang mudah\r\nKarena itu aku ingin tahu tentang arti hidupku\r\nKau benar, semua benar\r\nKau benar, semua benar Anak kecil yang penakut\r\n\r\nKata-kata yang kau bisikkan dengan lembut, kau mengatakannya\r\nTak bisa melihat gerakku, tapi jalanku mulai bersinar\r\n\r\nAku rasakan jiwaku, bawa aku ke jalanmu\r\nWalaupun aku berjuang\r\nAku yakin bahwa aku bisa tetap berjalan selamanya seperti diriku\r\n\r\nKau bilang ini bukan kebetulan\r\ndan ini bukan mimpi yang biasa\r\nKau benar, semua benar 2x ah..\r\n\r\nAku sangat menderita dengan hal-hal yang mudah\r\nJadi aku ingin tahu tentang arti kebahagiaan\r\nKau benar, semua benar 2x\r\nAnak kecil yang penakut', 'fcad518f19f91be5958f6e38f4795749_95_1549580907.jpg', 4, 2147483647, 4, 1550399905, 0, '2019-02-17 10:38:25', 15),
(3, 3, 'Gin tama', 'Gin tama adalah sebuah anime komedi', 'fcad518f19f91be5958f6e38f4795749_61_1549774673.jpeg', 4, 1549773856, 4, 1551255299, 0, '2019-02-27 08:14:59', 12),
(4, 3, 'Naruto', 'Naruto merupakan sebuah manga karya masashi kishimoto yang diangkat menjadi anime . Naruto merupakan sebuah anime legendaris', 'fcad518f19f91be5958f6e38f4795749_97_1549774340.jpeg', 4, 1549774315, 4, 1551255314, 0, '2019-02-27 08:15:14', 6),
(5, 2, 'Heartache', 'so this is Heartache ?\r\nso this is Heartache ?', 'fcad518f19f91be5958f6e38f4795749_86_1551580137.png', 4, 1551580137, 4, 1551580137, 0, '2019-03-03 09:28:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_berita_kategori`
--

CREATE TABLE `module_berita_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_berita_kategori`
--

INSERT INTO `module_berita_kategori` (`id`, `nama`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 'Adiwiyata', 4, 2147483647, 4, 1551238500, 0, '2019-02-07 11:26:59', 3),
(2, 'Lirik Lagu', 4, 2147483647, 4, 1550325467, 0, '2019-02-16 13:57:47', 15),
(3, 'Anime', 4, 1549773037, 4, 1551255293, 0, '2019-02-27 08:14:53', 16);

-- --------------------------------------------------------

--
-- Table structure for table `module_galeri`
--

CREATE TABLE `module_galeri` (
  `id` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `judul` varchar(45) NOT NULL,
  `tahun` year(4) NOT NULL,
  `uploaded_by` int(11) NOT NULL DEFAULT '0',
  `uploaded_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_galeri`
--

INSERT INTO `module_galeri` (`id`, `kategori`, `link`, `judul`, `tahun`, `uploaded_by`, `uploaded_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(3, 4, '30c2007404e1e8aef160820a2848fd7c861549770435.jpeg', 'Surabaya Hacker Link', 2018, 4, 2147483647, 4, 1551875406, 0, '0000-00-00 00:00:00', 12),
(4, 1, '30c2007404e1e8aef160820a2848fd7c921549770259.jpg', 'kurumi Minimalist1', 2018, 4, 2147483647, 4, 1550800524, 0, '0000-00-00 00:00:00', 8),
(5, 1, '30c2007404e1e8aef160820a2848fd7c971549770491.jpg', 'AnimeX', 2018, 4, 2147483647, 4, 1550800542, 0, '0000-00-00 00:00:00', 3),
(6, 5, '30c2007404e1e8aef160820a2848fd7c441549634514.png', 'Logo SMKN 1 Jenangan', 2014, 4, 2147483647, 4, 1551875428, 0, '0000-00-00 00:00:00', 7),
(7, 1, '30c2007404e1e8aef160820a2848fd7c631549634816.jpg', 'I\'m losing my edge', 2014, 4, 2147483647, 4, 1550800547, 0, '0000-00-00 00:00:00', 4),
(8, 1, '30c2007404e1e8aef160820a2848fd7c301549635273.jpg', 'Jaim', 2018, 4, 1549635273, 4, 1550800600, 0, '0000-00-00 00:00:00', 2),
(10, 2, '30c2007404e1e8aef160820a2848fd7c311550022419.jpg', 'Juuu', 2009, 4, 1550022419, 4, 1550800602, 0, '0000-00-00 00:00:00', 1),
(12, 1, '30c2007404e1e8aef160820a2848fd7c871550022495.jpg', 'anime', 2019, 4, 1550022495, 4, 1551875357, 0, '2019-02-27 08:50:18', 6),
(13, 4, '30c2007404e1e8aef160820a2848fd7c691551232468.png', 'test1', 2019, 4, 1551232468, 4, 1551875412, 0, '0000-00-00 00:00:00', 1),
(14, 4, '30c2007404e1e8aef160820a2848fd7c681551232469.png', 'test1', 2019, 4, 1551232469, 4, 1551875419, 0, '0000-00-00 00:00:00', 1),
(15, 4, '30c2007404e1e8aef160820a2848fd7c501551232469.png', 'test1', 2019, 4, 1551232469, 4, 1551875435, 0, '0000-00-00 00:00:00', 1),
(16, 4, '30c2007404e1e8aef160820a2848fd7c621551232469.png', 'test1', 2019, 4, 1551232469, 4, 1551875442, 0, '0000-00-00 00:00:00', 1),
(17, 4, '30c2007404e1e8aef160820a2848fd7c881551232469.png', 'test1', 2019, 4, 1551232469, 4, 1551915790, 0, '0000-00-00 00:00:00', 1),
(18, 5, '30c2007404e1e8aef160820a2848fd7c211551232521.png', 'test2', 2019, 4, 1551232521, 4, 1551915861, 0, '0000-00-00 00:00:00', 1),
(19, 5, '30c2007404e1e8aef160820a2848fd7c191551232521.png', 'test2', 2019, 4, 1551232521, 4, 1551915869, 0, '0000-00-00 00:00:00', 1),
(20, 5, '30c2007404e1e8aef160820a2848fd7c781551232521.png', 'test2', 2019, 4, 1551232521, 4, 1551915875, 0, '0000-00-00 00:00:00', 1),
(21, 5, '30c2007404e1e8aef160820a2848fd7c871551232521.png', 'test2', 2019, 4, 1551232521, 4, 1551915883, 0, '0000-00-00 00:00:00', 1),
(22, 5, '30c2007404e1e8aef160820a2848fd7c991551232521.png', 'test2', 2019, 4, 1551232521, 4, 1551915892, 0, '0000-00-00 00:00:00', 1),
(23, 4, '30c2007404e1e8aef160820a2848fd7c591551232556.png', 'test3', 2019, 4, 1551232556, 4, 1551915802, 0, '0000-00-00 00:00:00', 1),
(24, 4, '30c2007404e1e8aef160820a2848fd7c671551232556.png', 'test3', 2019, 4, 1551232556, 4, 1551915810, 0, '0000-00-00 00:00:00', 1),
(25, 4, '30c2007404e1e8aef160820a2848fd7c601551232556.png', 'test3', 2019, 4, 1551232556, 4, 1551915834, 0, '0000-00-00 00:00:00', 1),
(26, 4, '30c2007404e1e8aef160820a2848fd7c771551232556.png', 'test3', 2019, 4, 1551232556, 4, 1551915842, 0, '0000-00-00 00:00:00', 1),
(27, 4, '30c2007404e1e8aef160820a2848fd7c741551232556.png', 'test3', 2019, 4, 1551232556, 4, 1551915854, 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_galeri_kategori`
--

CREATE TABLE `module_galeri_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_galeri_kategori`
--

INSERT INTO `module_galeri_kategori` (`id`, `nama`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 'Wallpaper hd', 4, 2147483647, 4, 1550800483, 0, '2019-02-22 01:54:43', 11),
(2, 'Palang Merah Remaja', 4, 1549746563, 4, 1550800559, 0, '2019-02-22 01:55:59', 10),
(3, 'Pramuka', 4, 1549775637, 4, 1551875372, 0, '2019-03-06 19:29:32', 6),
(4, 'Telegram', 4, 1550734938, 4, 1551875382, 0, '2019-03-06 19:29:42', 6),
(5, 'Osis', 4, 1550758966, 4, 1551875389, 0, '2019-03-06 19:29:49', 5);

-- --------------------------------------------------------

--
-- Table structure for table `module_guru`
--

CREATE TABLE `module_guru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_guru`
--

INSERT INTO `module_guru` (`id`, `user_id`, `mata_pelajaran_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `lock`) VALUES
(1, 5, 4, 1550328256, 4, 1550622794, 7, '2019-02-16 14:44:16', 0, 1),
(2, 6, 2, 1550328280, 4, 1550328280, 4, '2019-02-16 14:44:40', 0, 0),
(3, 11, 2, 1551273992, 4, 1551273992, 4, '2019-02-27 06:26:32', 0, 0),
(4, 12, 7, 1551394325, 4, 1551394325, 4, '2019-02-28 15:52:05', 0, 0),
(5, 13, 1, 1551499840, 4, 1551499840, 4, '2019-03-01 21:10:40', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_jadwal`
--

CREATE TABLE `module_jadwal` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `kode_guru` int(11) NOT NULL,
  `jam_mulai` varchar(45) NOT NULL,
  `jam_selesai` varchar(45) NOT NULL,
  `hari` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_jadwal`
--

INSERT INTO `module_jadwal` (`id`, `kelas_id`, `kode_guru`, `jam_mulai`, `jam_selesai`, `hari`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 3, 2, '07.00', '07.40', 'senin', 4, 1552348462, 4, 1552348462, 0, '2019-03-12 06:54:22', 0),
(2, 3, 2, '07.00', '07.40', 'selasa', 4, 1552348696, 4, 1552348696, 0, '2019-03-12 06:58:16', 0),
(3, 3, 4, '10.40', '15.00', 'sabtu', 4, 1552426138, 4, 1552426138, 0, '2019-03-13 04:28:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_jurusan`
--

CREATE TABLE `module_jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `kepala_jurusan` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_jurusan`
--

INSERT INTO `module_jurusan` (`id`, `nama`, `kepala_jurusan`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 'Rekayasa Perangkat Lunak', 'Drs. Bambang', 4, 1549858875, 4, 1550022860, 0, '2019-02-13 01:54:20', 9),
(2, 'peternak lele', 'Drs. Irvan Dwi', 4, 1549861305, 4, 1550023194, 4, '2019-02-13 01:59:54', 2),
(3, 'Jadi Direktur', 'Muslihat', 4, 1549862871, 4, 1550023243, 0, '2019-02-13 02:00:43', 8),
(4, 'Otomasi Industri ', 'No Name', 4, 1550022695, 4, 1550023292, 0, '2019-02-13 02:01:32', 6);

-- --------------------------------------------------------

--
-- Table structure for table `module_kelas`
--

CREATE TABLE `module_kelas` (
  `id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kelas` varchar(1) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `tahun` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_kelas`
--

INSERT INTO `module_kelas` (`id`, `jurusan_id`, `guru_id`, `kelas`, `grade`, `tahun`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(3, 4, 5, 'A', 'XI', '2018', 4, 1550329739, 4, 1550329739, 0, '2019-02-20 00:33:14', 0),
(4, 1, 6, 'A', 'XI', '2019', 4, 1550618539, 4, 1550619477, 0, '2019-02-19 23:37:57', 3),
(5, 3, 11, 'B', 'XII', '2019', 4, 1551580969, 4, 1551580969, 0, '2019-03-03 09:42:49', 0),
(6, 3, 13, 'A', 'XII', '2019', 4, 1551842243, 4, 1551842243, 0, '2019-03-06 10:17:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_mata_pelajaran`
--

CREATE TABLE `module_mata_pelajaran` (
  `id` int(11) NOT NULL,
  `nama_mapel` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_mata_pelajaran`
--

INSERT INTO `module_mata_pelajaran` (`id`, `nama_mapel`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 'Matematika', 4, 1550046133, 4, 1551339653, 0, '2019-02-28 07:40:53', 2),
(2, 'Sosial budaya', 4, 1550047754, 4, 1550048286, 0, '2019-02-13 08:56:39', 3),
(3, 'Pendidikan jasmani', 4, 1550047765, 4, 1550048312, 4, '2019-02-13 08:58:32', 4),
(4, 'Fisika', 4, 1550047776, 4, 1550047776, 0, '2019-02-13 15:49:36', 0),
(6, 'Bahasa Indonesia', 4, 1551339662, 4, 1551339662, 0, '2019-02-28 14:41:02', 0),
(7, 'Desain Grafis', 4, 1551339684, 4, 1551339684, 0, '2019-02-28 14:41:24', 0),
(8, 'Basis data ', 4, 1551339720, 4, 1551339720, 0, '2019-02-28 14:42:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_materi`
--

CREATE TABLE `module_materi` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `materi_kategori_id` int(11) NOT NULL,
  `judul` varchar(45) NOT NULL,
  `gambar` varchar(45) DEFAULT NULL,
  `isi` longtext NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_materi`
--

INSERT INTO `module_materi` (`id`, `kelas_id`, `materi_kategori_id`, `judul`, `gambar`, `isi`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 4, 4, 'Belajar Menggunakan Pentool', 'materi_63_1551753067.png', 'Cara menggunakan Pen tool di Photoshop dan Illustrator – Salah satu alat yang sangat berguna namun dianggap sulit untuk digunakan di Photoshop adalah Pen tool. Sehingga banyak orang tidak menggunakan Pen Tool ini meskipun dia sudah bertahun-tahun menggunakan Photoshop.\r\n\r\nPen tool memang bisa sangat menakutkan pada awalnya, namun dengan sedikit belajar untuk mengetahui cara penggunaannya lalu diikuti dengan latihan akan lebih memudahkan untuk memahami dan bahkan menguasai cara penggunaan Pen tool.\r\n\r\nPen tool sangat berguna, apalagi untuk orang yang senang menggambar secara digital, misalnya jika Anda ingin membuat bentuk, objek, karakter atau gambar kartun di komputer.\r\n\r\nCara menggunakan Pen tool di Photoshop dan Illustrator tidak jauh berbeda, bahkan bisa dibilang sama. Oleh karena itu informasi pada tulisan kali ini bisa digunakan di dua aplikasi tersebut.\r\n\r\nNah, untuk Anda yang ingin sekali menguasai Pen tool, berikut ada beberapa tutorial yang bisa Anda ikuti.\r\n\r\n1. Photoshop Pen Tool: Panduan Komprehensif\r\npen tool\r\n\r\nTutorial pertama ini mengajarkan dasar-dasar penggunaan Pen tool, mulai dari fungsi dasarnya, kombinasi tombol shortcuts keyboard nya, kursor, hingga fungsi-fungsi lain yang ada di Pen tool, disediakan juga file latihannya.\r\n\r\nPelajari disini ????\r\n\r\n2. Panduan Pen Tool Photoshop\r\nTutorial ini mengajarkan dasar-dasar membuat berbagai bentuk dengan menggunakan Pen tool di Photoshop.\r\n\r\nBaca panduannya disini ????\r\n\r\n3. Membuat seleksi dengan Pen Tool\r\nAda beberapa cara untuk membuat seleksi di Photoshop, namun yang dianggap paling sulit adalah dengan Pen tool, namun artikel tersebut bisa mengajarkan bagaimana cara mudah membuat seleksi dengan Pen tool di Photoshop.\r\n\r\nLihat tutorialnya disini ????\r\n\r\n4. Menjadi master Pen Tool dalam 30 menit\r\npen tool photoshop penguin\r\n\r\nSeperti judulnya, tutorial ini bermaksud untuk mengajarkan bagaimana agar bisa memahami Pen tool dengan waktu yang cukup singkat, 30 menit saja untuk bisa menjadi master Pen tool. Disana dicontohkan bagaimana membuat sebuah karakter penguin dengan menggunakan Pen tool.\r\n\r\nPenasaran, langsung saja pelajari disini ????\r\n\r\n5. Adobe Pen Tool cheatsheet\r\nCheatsheet ini bisa membantu memahami cara cepat menggunakan pen tool di hampir semua produk Adobe, baik itu Photoshop, Illustrator bahkan InDesign. Cheatsheet tersebut bisa Anda print dan tempel di dinding depan komputer Anda agar lebih mudah diingat saat proses belajar menggunakan Pen tool.\r\n\r\nDownload disini ????\r\n\r\n6. Bagaimana menggunakan Pen Tool Photoshop\r\nTutorial ini akan mengekplorasi bagaimana cara menggunakan Pen tool di Photoshop, mulai dari kontrol dasar Pen tool, hingga membuat jalur/path, kurva dan memahami anchor point.\r\n\r\nPelajari disini ????\r\n\r\n7. Belajar menggunakan Tool Pen di Photoshop dan Illustrator\r\nArtikel ini merupakan panduan belajar Pen tool yang ditulis dengan bahasa Indonesia, ditujukan untuk para pemula yang masih awal dengan penggunaan pen tool, diajarkan cara membuat kurva, bahkan ada video tutorialnya.\r\n\r\nPelajari disini ????\r\n\r\n8. Bagaimana menggunakan Pen Tool di Adobe Photoshop\r\npen tool adobe photoshop\r\nPen tool Adobe Photoshop (Image: Design Modo)\r\n\r\nTutorial ini mengajarkan dasar-dasar penggunaan Pen tool, dimana akan diajarkan cara membuat berbagai bentuk yang Anda inginkan. Selain itu tulisan tersebut dilengkapi dengan latihan penggunaan Pen tool.\r\n\r\nBaca tutorialnya disini ????\r\n\r\n9. Photoshop untuk pemula: Pen Tool\r\nTutorial ini mengajarkan cara menggunakan pen tool untuk para pemula dalam menggunakan Photoshop. Tutorial ini bisa dibilagn cukup komplit, mulai dari pemahaman dasar pen tool, membuat kurva, bahkan praktek membuat objek seperti gambar awan, dan bentuk lainnya.\r\n\r\nBaca selengkapnya disini ????\r\n\r\n10. Tips Belajar Pen Tool di Adobe Photoshop\r\nArtikel ini membahas beberapa tips dalam mempelajari cara menggunakan Pen tool yang ada di Photoshop. Mulai dari memahami kegunaannya, hingga membuat kurva dan bezier.\r\n\r\nBaca selengkapnya disini ????\r\n\r\n', 4, 1551342750, 4, 1551753715, 0, '2019-02-28 15:32:30', 3),
(2, 4, 3, 'Penerapan Gaya Dalam Kehidupan', '', 'pojok programmer id', 5, 1551345213, 5, 1551345213, 0, '2019-02-28 16:13:33', 0),
(3, 4, 9, 'Pengenalan Matriks', '', 'test Pengenalan Matriks', 13, 1551499980, 13, 1551499980, 0, '2019-03-02 11:13:00', 0),
(4, 3, 9, 'Pengenalan Matriks', '', 'test Pengenalan Matriks', 13, 1551500021, 7, 1552185173, 7, '2019-03-10 09:32:53', 1),
(5, 4, 9, 'Matriks invers', '', 'test Matriks invers', 13, 1551500090, 13, 1551500090, 0, '2019-03-02 11:14:50', 0),
(8, 6, 3, 'Gaya Gesek', 'materi_541551872777.jpeg', 'Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek Gaya Gesek ', 5, 1551872777, 5, 1551872777, 0, '2019-03-06 18:46:17', 0),
(9, 4, 1, '\" onload=\"alert(1);\"', 'materi_2_1552055198.jpg', '<img src=\"../uploaded/materi/materi_541551872777.jpeg\" alt=\"aa\" /><b>Bold test</b>\n<h1>test h1</h1>\n<h2>test h2</h2>\n<h3>test h3</h3>\n<h4>test h4</h4>\n<h5>test h5</h5>\n<h6>test h6</h6>\n<img src=\"http://localhost/sekolah/administrator/uploaded/materi/materi_541551872777.jpeg\" alt=\"aa\" />', 4, 1551882305, 4, 1552055197, 0, '2019-03-06 21:25:05', 5);

-- --------------------------------------------------------

--
-- Table structure for table `module_materi_file`
--

CREATE TABLE `module_materi_file` (
  `id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `nama_file` varchar(45) NOT NULL,
  `link_file` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_materi_file`
--

INSERT INTO `module_materi_file` (`id`, `materi_id`, `nama_file`, `link_file`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 9, 'Fa', '', 4, 1551884676, 4, 1552055197, 0, '2019-03-06 22:04:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_materi_kategori`
--

CREATE TABLE `module_materi_kategori` (
  `id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_materi_kategori`
--

INSERT INTO `module_materi_kategori` (`id`, `mata_pelajaran_id`, `nama`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(1, 4, 'Atom', 4, 1551321346, 4, 1551321346, 0, '2019-02-28 09:35:46', 0),
(2, 2, 'Seni Tari Daerah', 4, 1551339463, 4, 1551339463, 0, '2019-02-28 14:37:43', 0),
(3, 4, 'Gaya', 4, 1551339523, 4, 1551339523, 0, '2019-02-28 14:38:43', 0),
(4, 7, 'Bekerja dengan photoshop', 4, 1551340331, 4, 1551340331, 0, '2019-02-28 14:52:11', 0),
(5, 8, 'Pengenalan perintah-perintah dasar', 4, 1551340368, 4, 1551340368, 0, '2019-02-28 14:52:48', 0),
(6, 1, 'Sistem persamaan linier 2 variable', 4, 1551340417, 4, 1551340417, 0, '2019-02-28 14:53:37', 0),
(7, 1, 'Sistem persamaan linier 3 variable', 4, 1551496583, 4, 1551496583, 0, '2019-03-02 10:16:23', 0),
(8, 1, 'Geometri', 4, 1551496594, 4, 1551496594, 0, '2019-03-02 10:16:34', 0),
(9, 1, 'Matriks', 4, 1551496611, 4, 1551496611, 0, '2019-03-02 10:16:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_materi_komentar`
--

CREATE TABLE `module_materi_komentar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `komentar` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_materi_komentar`
--

INSERT INTO `module_materi_komentar` (`id`, `user_id`, `materi_id`, `subject`, `komentar`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `lock`) VALUES
(1, 4, 1, 'a', 'a', 0, 1551774527, 4, 1551774527, 4, '2019-03-05 08:28:47', 0, 0),
(4, 4, 1, 'Wah keren', 'keren banget materinya h3h3', 0, 1551775349, 4, 1551775349, 4, '2019-03-05 08:42:29', 0, 0),
(5, 5, 8, 'Gaya Gesek', 'Di pelajari lebih lanjut dan dikerjakan soalnya .', 0, 1551873061, 5, 1551873061, 5, '2019-03-06 11:51:01', 0, 0),
(8, 4, 8, 'Ok', 'Siap pak !!!!', 0, 1551873361, 4, 1551873361, 4, '2019-03-06 11:56:01', 0, 0),
(12, 4, 9, '<i>Hai</i>', 'test komen italic', 0, 1551882942, 4, 1551882942, 4, '2019-03-08 14:26:37', 4, 0),
(13, 4, 8, '<i>miring </i>', '<i>ini italic</i>\r\n<b>ini bold</b>\r\n<u>ini underline</u>\r\n', 0, 1551885232, 4, 1551885232, 4, '2019-03-06 15:13:52', 0, 0),
(14, 4, 9, '\"&gt;', '\"&gt;', 0, 1552055394, 4, 1552055394, 4, '2019-03-08 14:29:54', 0, 0),
(15, 4, 9, 'quot;gt;<s></s>', 'quot;gt;<s></s>', 0, 1552055646, 4, 1552055646, 4, '2019-03-08 14:34:06', 0, 0),
(16, 4, 3, '.', 'quot;gt;<s></s>', 0, 1552055695, 4, 1552055695, 4, '2019-03-08 14:34:55', 0, 0),
(17, 8, 1, 'Wah keren', 'Wowowowowo', 0, 1552281902, 8, 1552281902, 8, '2019-03-11 05:25:03', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_materi_soal`
--

CREATE TABLE `module_materi_soal` (
  `id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `judul` varchar(45) NOT NULL,
  `isi` text NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_materi_soal_file`
--

CREATE TABLE `module_materi_soal_file` (
  `id` int(11) NOT NULL,
  `materi_soal_id` int(11) NOT NULL,
  `gambar` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_materi_soal_jawaban`
--

CREATE TABLE `module_materi_soal_jawaban` (
  `id` int(11) NOT NULL,
  `materi_soal_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_siswa`
--

CREATE TABLE `module_siswa` (
  `user_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_siswa`
--

INSERT INTO `module_siswa` (`user_id`, `kelas_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(7, 3, 4, 1550331738, 4, 1551224220, 0, '2019-02-26 23:37:00', 1),
(8, 4, 4, 1551224158, 4, 1551224158, 0, '2019-02-27 06:35:58', 0),
(9, 4, 4, 1551224127, 4, 1551224127, 0, '2019-02-27 06:35:27', 0),
(10, 3, 4, 1551272918, 4, 1551272918, 0, '2019-02-27 13:08:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_spp`
--

CREATE TABLE `module_spp` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bulan` varchar(45) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bukti_bayar` varchar(250) NOT NULL,
  `spp` bigint(20) DEFAULT NULL,
  `tabungan_prakerin` bigint(20) DEFAULT NULL,
  `tabungan_study_tour` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_spp`
--

INSERT INTO `module_spp` (`id`, `siswa_id`, `bank_id`, `bulan`, `tahun`, `bukti_bayar`, `spp`, `tabungan_prakerin`, `tabungan_study_tour`, `total`, `created_by`, `status`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(2, 7, 4, 'September', 2019, '1', 150000, 30000, 25000, NULL, 4, 0, 1551525146, 7, 1552190731, 7, '2019-03-10 11:05:31', 1),
(3, 7, 2, 'Maret', 2019, '7_1552190001_49_2019.jpg', 150000, 30000, 25000, 205000, 7, 0, 1552190001, 7, 1552190001, 0, '2019-03-10 10:53:22', 0),
(5, 8, 2, 'April', 2019, '8_1552276421_8_2019.jpg', 175000, 30000, 30000, 235000, 8, 0, 1552276421, 8, 1552276421, 0, '2019-03-11 10:53:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` int(11) DEFAULT NULL,
  `tempat_lahir` varchar(70) DEFAULT NULL,
  `bio` text,
  `no_telp` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `nama`, `tgl_lahir`, `tempat_lahir`, `bio`, `no_telp`, `avatar`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(4, 'Administrator', 1401901200, 'Ponorogo', 'Try , error , and never give up :v', '+6285604845437', 'admin_1552279194.png', 4, 1550309550, 4, 1552279194, 0, '2019-02-16 16:32:30', 27),
(5, 'Bima arya nugraha', 12309876, 'ponorogo', '', '', '', 4, 1550328503, 4, 1550328503, 0, '2019-02-16 21:48:23', 0),
(6, 'Narendra edi darma budi arta', 994291200, 'Ponorogo', 'Dont judge person by cover', '+6286754884930', NULL, 4, 1550615604, 6, 1551275186, 0, '2019-02-20 05:33:24', 1),
(7, 'Ryan Erlangga', 1502064000, 'Ponorogo', '', '+6276544487', 'siswa_1550622519.jpeg', 4, 1550331594, 7, 1551687916, 0, '2019-02-16 22:39:54', 13),
(8, 'Daniel', 0, '', '', '', 'siswa2_1552276218.png', 4, 1550616352, 8, 1552276218, 0, '2019-02-20 05:45:52', 1),
(9, 'Aldi Wahyu Ghanesa putra', 15, 'Ponorogo', 'Why me ??', '6285604845437', NULL, 4, 1550628649, 4, 1550628649, 0, '2019-02-20 09:10:49', 0),
(10, 'Renaldi Arfi Saputra', NULL, NULL, NULL, NULL, NULL, 4, 1551272918, 4, 1551272918, 0, '2019-02-27 13:08:37', 0),
(11, 'Arsyad Rifa\'i', NULL, NULL, NULL, NULL, NULL, 4, 1551273991, 4, 1551273991, 0, '2019-02-27 13:26:31', 0),
(12, 'Sasmita', NULL, NULL, NULL, NULL, NULL, 4, 1551394325, 4, 1551394325, 0, '2019-02-28 22:52:05', 0),
(13, 'Test Guru Matematika', 0, '', '', '', 'endah_k_1551499909.png', 4, 1551499840, 13, 1551499909, 0, '2019-03-02 04:10:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `online` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `last_login`, `online`, `created_at`, `updated_at`) VALUES
(4, 'admin', '68r2xcRUUj-MNODNLTd3C-FyqU91ENQF', '$2y$13$tko/61jwvh//UgIKjsRzoe6zqSbYKtOAe1QuHVzzMFShUu/e3A8we', NULL, 'admin@web.id', 10, 10, 1552423460, 0, 1549491206, 1552423460),
(5, 'guru', 'fwIsNL9Vuu8A_3qHnvPURA6dRFMquctB', '$2y$13$JZlIgBJiTK18lWV9LsHPc.V2apfRtvIEHJqINOy9W2SKlaWszruCu', NULL, 'teach@bout.tech', 10, 20, 1552351678, 0, 1549491248, 1552351678),
(6, 'guru2', 'F96ul2asFIcIzE6Y1a9MFcsrLoV7FVuc', '$2y$13$s6S5EAa0viQAmOlPv24OQuMzQCJwdoB8fhYsenzXbwGitc0Rm/QU.', NULL, 'teacher@bout.tech', 10, 20, 0, 0, 1549491290, 1550327675),
(7, 'siswa', 'HeAz61KeZt8Ds-SeK_0zb55cv6rC0ydU', '$2y$13$.yEydf0wQaVsO2fL9vgBSeQIToK7NFTDvZOxRAuXpFRxeRItjsbXS', 'g6NOJB9m3dIJzbnyWTmhb8M2PpsZgysy_1551502679', 'siswa@info.tech', 10, 30, 1552281097, 0, 1549491316, 1552281097),
(8, 'siswa2', 'nS0hqnLo5p8uC3dPJG99GhO18QhqaKIk', '$2y$13$FoxjjD07wrv81Noqe8AcI.2f0Gjo6V58Mz8Hltv1Cwd5At7CqpwiK', NULL, 'student2@info.tech', 10, 30, 1552281110, 0, 1549491350, 1552281110),
(9, 'testblockuser', 'HXx8iqAuzBk35GLbWtMtsa4Vdt4ADbuJ', '$2y$13$Uaxap79k/4ESEwv4aZ8JIu9dP/z1W/7jvz6hZ1RsiFtHY2OdO0RuC', NULL, 'testblockuser@tech.in', 0, 30, 0, 0, 1550055721, 1551833729),
(10, 'renaldi51', 'piKTrMUtSUFe4e7H3PrlyKOQc0fcIrDf', '$2y$13$9t/yUerRsn8KdL8mFpsnauBtYj0EBZ3Wf6VTRNyF08TwRPfJX7h6C', NULL, 'renaldi51@gmail.com', 0, 30, 0, 0, 1551272917, 1551833735),
(11, 'arsyadC0d', 'Ykysv63DyDvQXc6qaGINpSfT-Om0Nr0z', '$2y$13$nOT71z2L6W0YF.fCgL9/T.RF7dS3KljqM4NR6LlbBVMRUzZ2Td8Mu', NULL, 'arsyadC0d@gmail.com', 10, 20, 0, 0, 1551273991, 1551273991),
(12, 'sasmita12', 'l8r003CUgwYnIZ-ueqX-IwB5wflHTYVG', '$2y$13$3kfUEeX5fyXAGthN5llUneBqQj7XfI000n52avxTXbRloPzH/WVK2', NULL, 'sasmita12@gmail.com', 10, 20, 0, 0, 1551394325, 1551394325),
(13, 'endah_k', 'x_aXu1-UxgbustpuBWRx3klWOKcC3Fit', '$2y$13$Gk7H3QtFoh2n0peWQeiGjeeFttkwkmYlx12LpVtdvlxiNhMVFBEBW', NULL, 'end4hK@gmail.com', 0, 20, 0, 0, 1551499840, 1551833741);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module_bank`
--
ALTER TABLE `module_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_berita`
--
ALTER TABLE `module_berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_berita_tbl_berita_kategori1_idx` (`berita_kategori_id`);

--
-- Indexes for table `module_berita_kategori`
--
ALTER TABLE `module_berita_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_galeri`
--
ALTER TABLE `module_galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_galeri_tbl_galeri_kategori1_idx` (`kategori`);

--
-- Indexes for table `module_galeri_kategori`
--
ALTER TABLE `module_galeri_kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `module_guru`
--
ALTER TABLE `module_guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_module_guru_module_jadwal_mata_pelajaran1_idx` (`mata_pelajaran_id`);

--
-- Indexes for table `module_jadwal`
--
ALTER TABLE `module_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_jadwal_tbl_kelas1_idx` (`kelas_id`),
  ADD KEY `fk_tbl_jadwal_tbl_guru1_idx` (`kode_guru`);

--
-- Indexes for table `module_jurusan`
--
ALTER TABLE `module_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_kelas`
--
ALTER TABLE `module_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_kelas_tbl_jurusan_idx` (`jurusan_id`),
  ADD KEY `fk_module_kelas_module_guru1_idx` (`guru_id`);

--
-- Indexes for table `module_mata_pelajaran`
--
ALTER TABLE `module_mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_mapel` (`nama_mapel`);

--
-- Indexes for table `module_materi`
--
ALTER TABLE `module_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_materi_tbl_materi_kategori1_idx` (`materi_kategori_id`),
  ADD KEY `fk_tbl_materi_tbl_kelas1_idx` (`kelas_id`);

--
-- Indexes for table `module_materi_file`
--
ALTER TABLE `module_materi_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_materi_file_tbl_materi1_idx` (`materi_id`);

--
-- Indexes for table `module_materi_kategori`
--
ALTER TABLE `module_materi_kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_materi_kategori_module_mata_pelajaran1_idx` (`mata_pelajaran_id`);

--
-- Indexes for table `module_materi_komentar`
--
ALTER TABLE `module_materi_komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_materi_komentar_module_materi1_idx` (`materi_id`),
  ADD KEY `fk_module_materi_komentar_user1_idx` (`user_id`);

--
-- Indexes for table `module_materi_soal`
--
ALTER TABLE `module_materi_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_materi_soal_tbl_materi1_idx` (`materi_id`);

--
-- Indexes for table `module_materi_soal_file`
--
ALTER TABLE `module_materi_soal_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_materi_soal_gambar_tbl_materi_soal1_idx` (`materi_soal_id`);

--
-- Indexes for table `module_materi_soal_jawaban`
--
ALTER TABLE `module_materi_soal_jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_materi_soal_jawaban_tbl_materi_soal1_idx` (`materi_soal_id`);

--
-- Indexes for table `module_siswa`
--
ALTER TABLE `module_siswa`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_tbl_siswa_tbl_kelas1_idx` (`kelas_id`);

--
-- Indexes for table `module_spp`
--
ALTER TABLE `module_spp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_siswa_has_tbl_spp_tbl_bank1_idx` (`bank_id`),
  ADD KEY `fk_module_spp_bayar_module_siswa1_idx` (`siswa_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_profile_user1_idx` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module_bank`
--
ALTER TABLE `module_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_berita`
--
ALTER TABLE `module_berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_berita_kategori`
--
ALTER TABLE `module_berita_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_galeri`
--
ALTER TABLE `module_galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `module_galeri_kategori`
--
ALTER TABLE `module_galeri_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_guru`
--
ALTER TABLE `module_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_jadwal`
--
ALTER TABLE `module_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_jurusan`
--
ALTER TABLE `module_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_kelas`
--
ALTER TABLE `module_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `module_mata_pelajaran`
--
ALTER TABLE `module_mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module_materi`
--
ALTER TABLE `module_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `module_materi_file`
--
ALTER TABLE `module_materi_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_materi_kategori`
--
ALTER TABLE `module_materi_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `module_materi_komentar`
--
ALTER TABLE `module_materi_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `module_materi_soal`
--
ALTER TABLE `module_materi_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_materi_soal_file`
--
ALTER TABLE `module_materi_soal_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_materi_soal_jawaban`
--
ALTER TABLE `module_materi_soal_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_spp`
--
ALTER TABLE `module_spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_berita`
--
ALTER TABLE `module_berita`
  ADD CONSTRAINT `fk_tbl_berita_tbl_berita_kategori1` FOREIGN KEY (`berita_kategori_id`) REFERENCES `module_berita_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_galeri`
--
ALTER TABLE `module_galeri`
  ADD CONSTRAINT `fk_tbl_galeri_tbl_galeri_kategori1` FOREIGN KEY (`kategori`) REFERENCES `module_galeri_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_guru`
--
ALTER TABLE `module_guru`
  ADD CONSTRAINT `fk_module_guru_module_jadwal_mata_pelajaran1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `module_mata_pelajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_module_guru_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_jadwal`
--
ALTER TABLE `module_jadwal`
  ADD CONSTRAINT `fk_tbl_jadwal_tbl_guru1` FOREIGN KEY (`kode_guru`) REFERENCES `module_guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_jadwal_tbl_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `module_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_kelas`
--
ALTER TABLE `module_kelas`
  ADD CONSTRAINT `fk_module_kelas_module_guru1` FOREIGN KEY (`guru_id`) REFERENCES `module_guru` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_kelas_tbl_jurusan` FOREIGN KEY (`jurusan_id`) REFERENCES `module_jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi`
--
ALTER TABLE `module_materi`
  ADD CONSTRAINT `fk_tbl_materi_tbl_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `module_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_materi_tbl_materi_kategori1` FOREIGN KEY (`materi_kategori_id`) REFERENCES `module_materi_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi_file`
--
ALTER TABLE `module_materi_file`
  ADD CONSTRAINT `fk_tbl_materi_file_tbl_materi1` FOREIGN KEY (`materi_id`) REFERENCES `module_materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi_kategori`
--
ALTER TABLE `module_materi_kategori`
  ADD CONSTRAINT `fk_module_materi_kategori_module_mata_pelajaran1` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `module_mata_pelajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi_komentar`
--
ALTER TABLE `module_materi_komentar`
  ADD CONSTRAINT `fk_module_materi_komentar_module_materi1` FOREIGN KEY (`materi_id`) REFERENCES `module_materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_module_materi_komentar_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi_soal`
--
ALTER TABLE `module_materi_soal`
  ADD CONSTRAINT `fk_tbl_materi_soal_tbl_materi1` FOREIGN KEY (`materi_id`) REFERENCES `module_materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi_soal_file`
--
ALTER TABLE `module_materi_soal_file`
  ADD CONSTRAINT `fk_tbl_materi_soal_gambar_tbl_materi_soal1` FOREIGN KEY (`materi_soal_id`) REFERENCES `module_materi_soal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_materi_soal_jawaban`
--
ALTER TABLE `module_materi_soal_jawaban`
  ADD CONSTRAINT `fk_tbl_materi_soal_jawaban_tbl_materi_soal1` FOREIGN KEY (`materi_soal_id`) REFERENCES `module_materi_soal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_siswa`
--
ALTER TABLE `module_siswa`
  ADD CONSTRAINT `fk_module_siswa_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_siswa_tbl_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `module_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_spp`
--
ALTER TABLE `module_spp`
  ADD CONSTRAINT `fk_module_spp_module_siswa1` FOREIGN KEY (`siswa_id`) REFERENCES `module_siswa` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_siswa_has_tbl_spp_tbl_bank1` FOREIGN KEY (`bank_id`) REFERENCES `module_bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
