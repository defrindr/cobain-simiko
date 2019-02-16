-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2019 at 11:04 AM
-- Server version: 10.1.38-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.14-1+ubuntu18.04.1+deb.sury.org+1

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
('Admin', '4', 1549516667),
('bank.index', '8', 1549551525),
('Siswa', '7', 1550022660),
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
('Admin', 1, 'Role Admin', NULL, NULL, 1549504955, 1549529357),
('bank.create', 2, 'permission to create bank', NULL, NULL, 1549594745, 1549594745),
('bank.delete', 2, 'permission to delete bank', NULL, NULL, 1549594843, 1549594843),
('bank.index', 2, NULL, NULL, NULL, 1549551175, 1549551175),
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
('galeri.update', 2, NULL, NULL, NULL, 1549750066, 1549750066),
('Guru', 1, 'Role for teacher', NULL, NULL, 1549529378, 1549529378),
('jurusan.create', 2, 'permission to create new jurusan', NULL, NULL, 1549860859, 1549860859),
('jurusan.delete', 2, 'permission to delete data jurusan', NULL, NULL, 1549860914, 1549860914),
('jurusan.update', 2, 'permission to update data jurusan', NULL, NULL, 1549860885, 1549860885),
('mapel.create', 2, NULL, NULL, NULL, 1550045975, 1550045975),
('mapel.update', 2, NULL, NULL, NULL, 1550046179, 1550046179),
('Siswa', 1, 'Role for student', NULL, NULL, 1549529394, 1549529394),
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
('Admin', 'galeri.update'),
('Admin', 'Guru'),
('Admin', 'jurusan.create'),
('Admin', 'jurusan.delete'),
('Admin', 'jurusan.update'),
('Admin', 'mapel.create'),
('Admin', 'mapel.update'),
('Admin', 'Siswa'),
('bank.delete', 'bank.create'),
('bank.delete', 'bank.index'),
('bank.delete', 'bank.update'),
('bank.update', 'bank.create'),
('bank.update', 'bank.index'),
('berita-kategori.manage', 'berita-kategori.create'),
('berita-kategori.manage', 'berita-kategori.delete'),
('berita-kategori.manage', 'berita-kategori.update'),
('Siswa', 'bank.index');

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
(1, '1000000000', 'aldana123', 'siswa1', '21769537e1133ad50560a5e545675795_41_1549594578.jpg', 0, 0, 4, 1549855815, 4, '2019-02-11 03:30:15', 11),
(2, '1010101010', 'BNI 2', 'sri astuti', '21769537e1133ad50560a5e545675795_60_1549583023.jpg', 4, 2147483647, 4, 1549836780, 0, '2019-02-10 22:13:00', 3),
(3, '110011001001', 'BNI 1', 'Wahyu widodo', '21769537e1133ad50560a5e545675795_46_1549774866.jpg', 4, 2147483647, 4, 1549774908, 0, '2019-02-10 05:01:48', 2),
(4, '1000020000100', 'BPT', 'rahardian wisma', '21769537e1133ad50560a5e545675795_12_1549774190.jpg', 4, 1549774190, 4, 1549774190, 0, '2019-02-10 11:49:50', 0);

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
(1, 2, 'Yui - Why me', 'test artikel', 'fcad518f19f91be5958f6e38f4795749_17_1549671738.jpg', 4, 2147483647, 4, 1550254054, 0, '2019-02-15 18:07:34', 12),
(2, 2, 'YUI - feel my soul', 'Yui - feel my soul\r\n\r\nNakitsu karetetan da toi kakeru basho mo naku\r\nMayoi nagara tsumazuite mo tachi domare nai\r\nKimi ga kureta egao otoshita namida wa\r\nBoku no mune no fukai kizu ni furete kieta\r\n\r\nI feel my soul Take me your way\r\nsou tatta hitotsu wo Kitto daremo ga zutto sagashiteru no\r\n\r\nSore wa guuzen dewa nakute\r\nitsuwari no ai nanka ja nakute\r\nYou’re right, all right\r\nYou’re right, all right Scare little boy\r\n\r\nNando mo kurikaesu douka ikanaide\r\nSasayaku you na kimi no koe wa itoshikute\r\n\r\nI feel my soul Take me your way\r\nmou furimukanai\r\nKitto kono te de ima tashikametai yo\r\n\r\nItsumo tanjun na hodo kurushinde\r\nikite yuku imi wo shiritai kara\r\nYou’re right, all right\r\nYou’re right, all right Scare little boy\r\n\r\nSotto tsubuyaita kimi no kotoba you say it\r\nUgokidase mienai kedo michi wa hirakareteru\r\n\r\nI feel my soul Take me your way\r\nsou mogaki nagara mo\r\nKitto kono mama zutto aruite yukeru\r\n\r\nSore wa guuzen demo nakutte\r\narifureta yume nanka ja nakutte\r\nYou’re right, all right You’re right, all right\r\n\r\nItsumo tanjun na hodo kurushinde\r\nyorokobi no imi wo shiritai kara\r\nYou’re right, all right\r\nYou’re right, all right Scare little boy\r\n\r\nTerjemahan Indonesia\r\n\r\nAku telah lelah menangis Tak ada tempat lagi bagiku untuk bertanya\r\nWalau aku tersandung dan ragu-ragu, aku tak bisa berhenti\r\nSenyum yang kau berikan padaku serta air mata yang mengalir\r\nMenyentuh dan menghapus luka yang dalam di hatiku\r\n\r\nAku merasakan jiwaku, bawa aku ke jalanmu\r\nYa, aku yakin setiap orang selalu mencari satu hal yang berharga\r\n\r\nIni bukanlah kebetulan\r\nJuga bukan cinta yang salah\r\nKau benar, semua benar\r\nKau benar, semua benar Anak kecil yang penakut\r\n\r\nAku mengulangnya berkali-kali, bagaimanapun tanpa berlanjut\r\nSuara bisikanmu sangat menyenangkan\r\n\r\nAku merasakan jiwaku, bawa aku ke jalanmu\r\nAku tak akan berbalik lagi\r\nSekarang, aku pasti akan membuktikannya dengan tanganku ini\r\n\r\nAku sangat menderita karena sesuatu yang mudah\r\nKarena itu aku ingin tahu tentang arti hidupku\r\nKau benar, semua benar\r\nKau benar, semua benar Anak kecil yang penakut\r\n\r\nKata-kata yang kau bisikkan dengan lembut, kau mengatakannya\r\nTak bisa melihat gerakku, tapi jalanku mulai bersinar\r\n\r\nAku rasakan jiwaku, bawa aku ke jalanmu\r\nWalaupun aku berjuang\r\nAku yakin bahwa aku bisa tetap berjalan selamanya seperti diriku\r\n\r\nKau bilang ini bukan kebetulan\r\ndan ini bukan mimpi yang biasa\r\nKau benar, semua benar 2x ah..\r\n\r\nAku sangat menderita dengan hal-hal yang mudah\r\nJadi aku ingin tahu tentang arti kebahagiaan\r\nKau benar, semua benar 2x\r\nAnak kecil yang penakut', 'fcad518f19f91be5958f6e38f4795749_95_1549580907.jpg', 4, 2147483647, 4, 1549855363, 4, '2019-02-11 03:22:43', 14),
(3, 3, 'Gin tama', 'Gin tama adalah sebuah anime komedi', 'fcad518f19f91be5958f6e38f4795749_61_1549774673.jpeg', 4, 1549773856, 4, 1549855021, 0, '2019-02-11 03:17:01', 6),
(4, 3, 'Naruto', 'Naruto merupakan sebuah manga karya masashi kishimoto yang diangkat menjadi anime . Naruto merupakan sebuah anime legendaris', 'fcad518f19f91be5958f6e38f4795749_97_1549774340.jpeg', 4, 1549774315, 4, 1550254063, 0, '2019-02-15 18:07:43', 4);

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
(1, 'Adiwiyata 2', 4, 2147483647, 4, 1549773535, 0, '2019-02-07 11:26:59', 1),
(2, 'Lirik Lagu', 4, 2147483647, 4, 1549855768, 0, '2019-02-11 03:29:28', 9),
(3, 'Anime', 4, 1549773037, 4, 1549773037, 0, '2019-02-10 11:30:37', 0);

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
(2, 1, '30c2007404e1e8aef160820a2848fd7c971549770375.png', 'purple anime', 2017, 4, 2147483647, 4, 1549836976, 0, '2019-02-10 22:16:16', 7),
(3, 1, '30c2007404e1e8aef160820a2848fd7c861549770435.jpeg', 'shl', 2018, 4, 2147483647, 4, 1549855836, 0, '2019-02-11 03:30:36', 9),
(4, 1, '30c2007404e1e8aef160820a2848fd7c921549770259.jpg', 'kurumi Minimalist1', 2018, 4, 2147483647, 4, 1549855845, 0, '2019-02-11 03:30:45', 5),
(5, 1, '30c2007404e1e8aef160820a2848fd7c971549770491.jpg', 'AnimeX', 2018, 4, 2147483647, 4, 1549855856, 0, '2019-02-11 03:30:56', 2),
(6, 1, '30c2007404e1e8aef160820a2848fd7c441549634514.png', 'Logo SMKN 1 Jenangan', 2014, 4, 2147483647, 4, 1549856122, 0, '2019-02-11 03:35:22', 4),
(7, 1, '30c2007404e1e8aef160820a2848fd7c631549634816.jpg', 'I\'m losing my edge', 2014, 4, 2147483647, 4, 1550023478, 0, '0000-00-00 00:00:00', 3),
(8, 1, '30c2007404e1e8aef160820a2848fd7c301549635273.jpg', 'Jaim', 2018, 4, 1549635273, 4, 1549635273, 4, '0000-00-00 00:00:00', 0),
(9, 1, '30c2007404e1e8aef160820a2848fd7c721549637791.jpg', 'programmerLife', 2019, 4, 1549637791, 4, 1550023489, 0, '0000-00-00 00:00:00', 2),
(10, 2, '30c2007404e1e8aef160820a2848fd7c311550022419.jpg', 'Juuu', 2009, 4, 1550022419, 4, 1550022419, 0, '2019-02-13 08:46:59', 0),
(11, 2, '30c2007404e1e8aef160820a2848fd7c971550022447.png', '2000', 2000, 4, 1550022447, 4, 1550023347, 4, '2019-02-13 02:02:27', 1),
(12, 1, '30c2007404e1e8aef160820a2848fd7c871550022495.jpg', 'anime', 2019, 4, 1550022495, 4, 1550023518, 0, '2019-02-13 02:02:21', 2);

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
(1, 'Wallpaper', 4, 2147483647, 4, 1549836874, 0, '2019-02-10 22:14:34', 8),
(2, 'Palang Merah Remaja', 4, 1549746563, 4, 1549746563, 0, '2019-02-10 04:09:23', 0),
(3, 'Pramuka', 4, 1549775637, 4, 1549776213, 0, '2019-02-10 12:13:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `module_guru`
--

CREATE TABLE `module_guru` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `avatar` varchar(45) NOT NULL,
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

INSERT INTO `module_guru` (`user_id`, `nama`, `mata_pelajaran_id`, `avatar`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `lock`) VALUES
(5, 'Aryanto Ryan Putro Aji Pratama', 4, 'aaa', 1550249486, 4, 1550249486, 4, '2019-02-15 16:51:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_jadwal`
--

CREATE TABLE `module_jadwal` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `kode_mapel` int(11) NOT NULL,
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
  `kelas` varchar(2) NOT NULL,
  `grade` varchar(2) NOT NULL,
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
(1, 4, 5, 'A', 'X', '2019', 4, 1550249836, 4, 1550250449, 0, '2019-02-15 23:57:16', 3),
(2, 1, 5, 'A', 'XI', '2019', 4, 1550281321, 4, 1550281321, 0, '2019-02-16 08:42:01', 0);

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
(1, 'Matematika', 4, 1550046133, 4, 1550048322, 4, '2019-02-13 08:58:42', 1),
(2, 'Sosial budaya', 4, 1550047754, 4, 1550048286, 0, '2019-02-13 08:56:39', 3),
(3, 'Pendidikan jasmani', 4, 1550047765, 4, 1550048312, 4, '2019-02-13 08:58:32', 4),
(4, 'Fisika', 4, 1550047776, 4, 1550047776, 0, '2019-02-13 15:49:36', 0);

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
  `nama` varchar(45) DEFAULT NULL,
  `tempat_lahir` varchar(45) DEFAULT NULL,
  `tanggal_lahir` datetime DEFAULT NULL,
  `avatar` varchar(45) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `nama_wali` varchar(45) DEFAULT NULL,
  `no_telp_wali` varchar(15) DEFAULT NULL,
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

INSERT INTO `module_siswa` (`user_id`, `kelas_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `avatar`, `no_telp`, `nama_wali`, `no_telp_wali`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `lock`) VALUES
(7, 1, 'Matahari senja', 'Ponorogo', '1899-12-31 13:05:00', 'avatar lejen aang', '085604845437', 'Andrianto setiawan', '085604845437', 4, 1550251715, 4, 1550251715, 0, '2019-02-16 00:28:35', 0),
(8, 1, 'Rosalina putri damayanti', 'Ponorogo', '2019-02-11 13:10:32', 'awewewe', '085678943456', 'Bima putra abi pradana', '085678943456', 4, 1550252426, 4, 1550252426, 0, '2019-02-16 00:40:26', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `session_backend_user`
--

CREATE TABLE `session_backend_user` (
  `id` char(80) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `online` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `online`, `created_at`, `updated_at`) VALUES
(4, 'admin', '68r2xcRUUj-MNODNLTd3C-FyqU91ENQF', '$2y$13$tko/61jwvh//UgIKjsRzoe6zqSbYKtOAe1QuHVzzMFShUu/e3A8we', NULL, 'admin@web.id', 10, 10, 0, 1549491206, 1549491206),
(5, 'guru', 'fwIsNL9Vuu8A_3qHnvPURA6dRFMquctB', '$2y$13$JZlIgBJiTK18lWV9LsHPc.V2apfRtvIEHJqINOy9W2SKlaWszruCu', NULL, 'teach@bout.tech', 10, 20, 0, 1549491248, 1549491248),
(6, 'guru2', 'F96ul2asFIcIzE6Y1a9MFcsrLoV7FVuc', '$2y$13$s6S5EAa0viQAmOlPv24OQuMzQCJwdoB8fhYsenzXbwGitc0Rm/QU.', NULL, 'teacher@bout.tech', 10, 20, 0, 1549491290, 1549491290),
(7, 'siswa', 'HeAz61KeZt8Ds-SeK_0zb55cv6rC0ydU', '$2y$13$.yEydf0wQaVsO2fL9vgBSeQIToK7NFTDvZOxRAuXpFRxeRItjsbXS', NULL, 'siswa@info.tech', 10, 30, 0, 1549491316, 1549491316),
(8, 'siswa2', 'nS0hqnLo5p8uC3dPJG99GhO18QhqaKIk', '$2y$13$FoxjjD07wrv81Noqe8AcI.2f0Gjo6V58Mz8Hltv1Cwd5At7CqpwiK', NULL, 'student2@info.tech', 10, 30, 0, 1549491350, 1549491350),
(9, 'testblockuser', 'HXx8iqAuzBk35GLbWtMtsa4Vdt4ADbuJ', '$2y$13$Uaxap79k/4ESEwv4aZ8JIu9dP/z1W/7jvz6hZ1RsiFtHY2OdO0RuC', NULL, 'testblockuser@tech.in', 0, 30, 0, 1550055721, 1550055721);

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
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_module_guru_module_jadwal_mata_pelajaran1_idx` (`mata_pelajaran_id`);

--
-- Indexes for table `module_jadwal`
--
ALTER TABLE `module_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_jadwal_tbl_kelas1_idx` (`kelas_id`),
  ADD KEY `fk_tbl_jadwal_tbl_mata_pelajaran1_idx` (`kode_mapel`);

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
-- Indexes for table `session_backend_user`
--
ALTER TABLE `session_backend_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expire` (`expire`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_berita_kategori`
--
ALTER TABLE `module_berita_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_galeri`
--
ALTER TABLE `module_galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module_galeri_kategori`
--
ALTER TABLE `module_galeri_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_jadwal`
--
ALTER TABLE `module_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_jurusan`
--
ALTER TABLE `module_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_kelas`
--
ALTER TABLE `module_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module_mata_pelajaran`
--
ALTER TABLE `module_mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_materi`
--
ALTER TABLE `module_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_materi_file`
--
ALTER TABLE `module_materi_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_materi_kategori`
--
ALTER TABLE `module_materi_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_materi_komentar`
--
ALTER TABLE `module_materi_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `fk_tbl_jadwal_tbl_kelas1` FOREIGN KEY (`kelas_id`) REFERENCES `module_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_jadwal_tbl_mata_pelajaran1` FOREIGN KEY (`kode_mapel`) REFERENCES `module_mata_pelajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
