-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2016 at 10:41 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fairship`
--

-- --------------------------------------------------------

--
-- Table structure for table `acara_himpunan`
--

CREATE TABLE `acara_himpunan` (
  `id` int(11) NOT NULL,
  `id_pengajuan_proposal` int(11) DEFAULT NULL,
  `nama_acara` text NOT NULL,
  `tempat_acara` text NOT NULL,
  `tanggal_acara` date NOT NULL,
  `deskripsi_acara` text NOT NULL,
  `waktu_upload` datetime NOT NULL,
  `poster_acara` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acara_himpunan`
--

INSERT INTO `acara_himpunan` (`id`, `id_pengajuan_proposal`, `nama_acara`, `tempat_acara`, `tanggal_acara`, `deskripsi_acara`, `waktu_upload`, `poster_acara`) VALUES
(7, 7, 'Seminar', 'Kampus', '2016-06-22', 'poiu', '2016-06-22 10:10:49', '7_756f86bffb55db2c85c6e6a41f8e921fd6ff41ea.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_lomba`
--

CREATE TABLE `bukti_lomba` (
  `id` int(11) NOT NULL,
  `nama_lomba` varchar(50) NOT NULL,
  `kategori_lomba` text NOT NULL,
  `penyelenggara_lomba` varchar(50) NOT NULL,
  `tingkat_kompetisi` enum('Internasional','Nasional','Regional') NOT NULL,
  `waktu_lomba` date NOT NULL,
  `sertifikat` varchar(100) NOT NULL,
  `pengupload` varchar(10) NOT NULL,
  `rekomendasi` tinyint(1) NOT NULL,
  `drive_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_lomba`
--

INSERT INTO `bukti_lomba` (`id`, `nama_lomba`, `kategori_lomba`, `penyelenggara_lomba`, `tingkat_kompetisi`, `waktu_lomba`, `sertifikat`, `pengupload`, `rekomendasi`, `drive_id`) VALUES
(2, 'GEMAStik', 'progaming', 'GEMAStik', 'Nasional', '2016-06-23', '4ce01666f70c89d6f1aea713369817e231b49987.zip', '1106124198', 0, '0B_mIc-chnSGMNFd5Q190SHZieXc'),
(9, 'coba', 'coba', 'coba', 'Internasional', '2016-06-21', 'c8116a8bccbac42feec4ad9e8831cc9bdc1f41d5.zip', '1106122133', 2, ''),
(10, '987', '987', '987', 'Regional', '2016-06-24', '', '1106124198', 0, '0B_mIc-chnSGMRk4wYnFjQngwazg'),
(11, '3213', '213', '21', 'Regional', '2016-06-24', '', '1106124198', 0, '0B_mIc-chnSGMclNjMmFFbEhzdlE');

-- --------------------------------------------------------

--
-- Table structure for table `detail_tim`
--

CREATE TABLE `detail_tim` (
  `id` int(11) NOT NULL,
  `id_proposal_lomba` int(11) NOT NULL,
  `nim_anggota` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_tim`
--

INSERT INTO `detail_tim` (`id`, `id_proposal_lomba`, `nim_anggota`) VALUES
(6, 6, '1106122133'),
(7, 7, '1106122134'),
(8, 7, '1106122133'),
(9, 10, '1106122133'),
(10, 11, '1106122133'),
(11, 13, '1106122134');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` varchar(30) NOT NULL,
  `nama_event` varchar(50) NOT NULL,
  `penyelenggara` text NOT NULL,
  `tingkat_kompetisi` enum('Internasional','Nasional','Regional') NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text NOT NULL,
  `bukti_event` varchar(100) NOT NULL,
  `pengaju_event` int(11) UNSIGNED DEFAULT NULL,
  `status` enum('disetujui','ditolak') DEFAULT NULL,
  `penanggungjawab` varchar(10) DEFAULT NULL,
  `google_url` text NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `nama_event`, `penyelenggara`, `tingkat_kompetisi`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `bukti_event`, `pengaju_event`, `status`, `penanggungjawab`, `google_url`, `deleted`) VALUES
('5lkcp3kj8luhjfivmml8nsn9pg', 'a1', 'a1', 'Regional', '2016-06-22', '2016-06-22', 'a1', '5c20dcbcfbab07ab6c2df7e27444d5ac2afca569.png', 1, 'disetujui', '12345678-9', 'https://www.google.com/calendar/event?eid=NWxrY3Aza2o4bHVoamZpdm1tbDhuc245cGcga2Vsb21wb2tnMjAxMkBt', 0),
('63l20mpslkhs3sfi0un3s1u3l0', 'International TI 5', 'Babushka', 'Internasional', '2016-06-12', '2016-06-20', 'Suka bljat', 'e77ec34739db396c9993092c2ad470abb905e4a3.PNG', 3816, 'disetujui', '12345678-9', 'https://www.google.com/calendar/event?eid=NjNsMjBtcHNsa2hzM3NmaTB1bjNzMXUzbDAga2Vsb21wb2tnMjAxMkBt', 0),
('kusogtokblcjqg2e6j4otqq344', 'INAICTA1', 'Kampus1', 'Nasional', '2016-06-22', '2016-06-22', 'deskripsi1', '', NULL, 'disetujui', '12345678-9', 'https://www.google.com/calendar/event?eid=a3Vzb2d0b2tibGNqcWcyZTZqNG90cXEzNDQga2Vsb21wb2tnMjAxMkBt', 0),
('mf2gvfcma3nb857mg9l3rjr760', 'Gemastik', '', 'Internasional', '2016-06-30', '2016-07-03', '', '', NULL, 'ditolak', '12345678-9', 'https://www.google.com/calendar/event?eid=bWYyZ3ZmY21hM25iODU3bWc5bDNyanI3NjAga2Vsb21wb2tnMjAxMkBt', 0),
('pj4tfngo7910vppt3oiprlhmi4', '232', '232', 'Regional', '2016-06-22', '2016-06-22', '232', 'a8c2974869399a040cb875ef4cb059ae38c3df6a.png', 3816, 'disetujui', '12345678-9', 'https://www.google.com/calendar/event?eid=cGo0dGZuZ283OTEwdnBwdDNvaXBybGhtaTQga2Vsb21wb2tnMjAxMkBt', 0),
('rgbmbu54pjf9tdskbfulha02fk', 'Sisfotime', '', 'Internasional', '2016-06-23', '2016-06-24', '', '', NULL, 'disetujui', '12345678-9', 'https://www.google.com/calendar/event?eid=cmdibWJ1NTRwamY5dGRza2JmdWxoYTAyZmsga2Vsb21wb2tnMjAxMkBt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `himpunan`
--

CREATE TABLE `himpunan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `id_penanggungjawab` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `himpunan`
--

INSERT INTO `himpunan` (`id`, `nama`, `prodi`, `id_penanggungjawab`) VALUES
(3, 'HMSI', 'Sistem Informasi', '1106124198'),
(5, 'HMTI', 'Teknik Industri', '1106124198');

-- --------------------------------------------------------

--
-- Stand-in structure for view `kegiatan_himpunan`
--
CREATE TABLE `kegiatan_himpunan` (
`id` int(11)
,`nama_kegiatan` text
,`tanggal_pelaksanaan` date
,`tempat_kegiatan` text
);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `namaaktifitas` varchar(50) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `logbook_detail_tim`
--
CREATE TABLE `logbook_detail_tim` (
`nama` varchar(50)
,`nim` varchar(10)
,`id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `logbook_proposal_himpunan`
--
CREATE TABLE `logbook_proposal_himpunan` (
`id` int(11)
,`pengaju` int(11)
,`tanggal_pengajuan` datetime
,`judul` text
,`tanggal_proposal_terakhir` datetime
,`status_approve` enum('y','n')
,`penanggungjawab` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `logbook_proposal_mhs`
--
CREATE TABLE `logbook_proposal_mhs` (
`id_pengajuan` int(11)
,`nama_event` varchar(50)
,`id_proposal` int(11)
,`tanggal_kompetisi` date
,`pengaju` varchar(10)
,`tanggal_pengajuan` datetime
,`kategori_kompetisi` text
,`tanggal_proposal_terakhir` datetime
,`nama_tim` varchar(100)
,`status` enum('y','n')
,`penanggungjawab` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '::1', '1106122133', 1466680175),
(2, '::1', '1106122133', 1466680183),
(3, '::1', '1106122133', 1466680189);

-- --------------------------------------------------------

--
-- Table structure for table `lpj_himpunan`
--

CREATE TABLE `lpj_himpunan` (
  `id` int(11) NOT NULL,
  `id_pengajuan_proposal` int(11) DEFAULT NULL,
  `judul_laporan` varchar(100) NOT NULL,
  `deskripsi_laporan` text NOT NULL,
  `ketercapaian_tujuan` varchar(200) NOT NULL,
  `realisasi_sasaran_kegiatan` text NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `tempat_pelaksanaan` varchar(200) NOT NULL,
  `realisasi_kegiatan` text NOT NULL,
  `realisasi_total_anggaran` text NOT NULL,
  `evaluasi_kegiatan` text NOT NULL,
  `rekomendasi` text NOT NULL,
  `penutup` text NOT NULL,
  `waktu_upload` datetime NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `file_id` varchar(30) NOT NULL,
  `folder_parent` varchar(30) NOT NULL,
  `drive_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lpj_himpunan`
--

INSERT INTO `lpj_himpunan` (`id`, `id_pengajuan_proposal`, `judul_laporan`, `deskripsi_laporan`, `ketercapaian_tujuan`, `realisasi_sasaran_kegiatan`, `tanggal_pelaksanaan`, `tempat_pelaksanaan`, `realisasi_kegiatan`, `realisasi_total_anggaran`, `evaluasi_kegiatan`, `rekomendasi`, `penutup`, `waktu_upload`, `file`, `file_id`, `folder_parent`, `drive_id`) VALUES
(1, 36, 'bvbvb', 'vb', 'vb', 'vb', '2016-06-24', 'vb', 'vb', '12312312', 'vb', 'vb', 'vb', '2016-06-24 02:59:25', '36_26c82e51d9777cf0db799778173e25afd0c37bef.pdf', '', '', '0B_mIc-chnSGMeklsX2t5MW5DOTA'),
(2, 36, 'hjh', 'jhj', 'hj', 'hj', '2016-06-24', 'hjhjh', 'jhjhjh', '6576576', 'jhj', 'hj', 'hj', '2016-06-24 03:00:55', '36_26c82e51d9777cf0db799778173e25afd0c37bef.pdf', '', '', '0B_mIc-chnSGMNGhyWDVqTzZEelU'),
(3, 36, 'kjk', 'jkj', 'kj', 'kjk', '2016-06-24', 'jkj', 'kjkj', '8878', 'kj', 'kj', 'kj', '2016-06-24 03:01:45', '36_26c82e51d9777cf0db799778173e25afd0c37bef.pdf', '', '', '0B_mIc-chnSGMbW1MRUVoRU9fSDQ');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `kelas` varchar(8) DEFAULT NULL,
  `prodi` varchar(20) DEFAULT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL,
  `jenis` enum('himpunan','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `kelas`, `prodi`, `id_user`, `jenis`) VALUES
('1106122133', 'SI-36-05', 'S1 Sistem Informasi', 3819, 'n'),
('1106122134', 'SI-36-05', 'S1 Sistem Informasi', 3820, 'n'),
('1106124198', 'SI-36-04', 'S1 Sistem Informasi', 198, 'himpunan'),
('1106124204', 'SI-36-05', 'S1 Sistem Informasi', 3821, 'n');

-- --------------------------------------------------------

--
-- Stand-in structure for view `notifikasi`
--
CREATE TABLE `notifikasi` (
`pesan` text
,`waktu` varchar(20)
,`asal` int(11) unsigned
,`tujuan` int(11) unsigned
,`terbaca` enum('y','n')
);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_asal`
--

CREATE TABLE `notifikasi_asal` (
  `id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `asal` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_tujuan`
--

CREATE TABLE `notifikasi_tujuan` (
  `id` int(11) NOT NULL,
  `id_notifikasi_asal` int(11) NOT NULL,
  `tujuan` int(11) UNSIGNED NOT NULL,
  `terbaca` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panitia`
--

CREATE TABLE `panitia` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `id_acara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panitia`
--

INSERT INTO `panitia` (`id`, `nim`, `id_acara`) VALUES
(2, '1106122133', 7),
(3, '1106122134', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_proposal_himpunan`
--

CREATE TABLE `pengajuan_proposal_himpunan` (
  `id` int(11) NOT NULL,
  `pengaju_proposal` int(11) DEFAULT NULL,
  `file_id` varchar(30) NOT NULL,
  `folder_parent` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_proposal_himpunan`
--

INSERT INTO `pengajuan_proposal_himpunan` (`id`, `pengaju_proposal`, `file_id`, `folder_parent`) VALUES
(7, 3, '', ''),
(8, 3, '', ''),
(9, 3, '', ''),
(10, 3, '', ''),
(11, 3, '', ''),
(12, 3, '', ''),
(13, 3, '', ''),
(14, 3, '', ''),
(15, 3, '', ''),
(16, 3, '', ''),
(17, 3, '', ''),
(18, 3, '', ''),
(19, 3, '', ''),
(20, 3, '', ''),
(21, 3, '', ''),
(22, 3, '', ''),
(23, 3, '', ''),
(24, 3, '', ''),
(25, 3, '', ''),
(26, 3, '', ''),
(27, 3, '', ''),
(28, 3, '', ''),
(29, 3, '', ''),
(30, 3, '', ''),
(31, 3, '', ''),
(32, 3, '', ''),
(33, 3, '', ''),
(34, 3, '', ''),
(35, 3, '', ''),
(36, 3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_proposal_mahasiswa`
--

CREATE TABLE `pengajuan_proposal_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_event` varchar(30) NOT NULL,
  `pengaju_proposal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_proposal_mahasiswa`
--

INSERT INTO `pengajuan_proposal_mahasiswa` (`id`, `id_event`, `pengaju_proposal`) VALUES
(7, 'kusogtokblcjqg2e6j4otqq344', '1106122133'),
(8, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(9, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(10, 'kusogtokblcjqg2e6j4otqq344', '1106124198'),
(11, 'kusogtokblcjqg2e6j4otqq344', '1106124198'),
(12, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(13, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(14, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(15, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(16, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(17, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(18, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(19, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(20, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198'),
(21, '63l20mpslkhs3sfi0un3s1u3l0', '1106124198');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `id_pengajuan_proposal` int(11) NOT NULL,
  `id_proposal` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `asal` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `terbaca` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_acara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `nama`, `email`, `id_acara`) VALUES
(3, 'Dadang', 'dadang@gmail.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_himpunan`
--

CREATE TABLE `proposal_himpunan` (
  `id` int(11) NOT NULL,
  `id_pengajuan_proposal` int(11) DEFAULT NULL,
  `judul` text NOT NULL,
  `tema_kegiatan` text NOT NULL,
  `tujuan_kegiatan` text NOT NULL,
  `sasaran_kegiatan` text NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `tempat_kegiatan` text NOT NULL,
  `bentuk_kegiatan` text NOT NULL,
  `anggaran` int(11) NOT NULL,
  `penutup` text NOT NULL,
  `waktu_upload` datetime NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `status_approve` enum('y','n') DEFAULT NULL,
  `penyetuju` varchar(50) DEFAULT NULL,
  `file_id` varchar(30) NOT NULL,
  `folder_parent` varchar(30) NOT NULL,
  `drive_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal_himpunan`
--

INSERT INTO `proposal_himpunan` (`id`, `id_pengajuan_proposal`, `judul`, `tema_kegiatan`, `tujuan_kegiatan`, `sasaran_kegiatan`, `tanggal_kegiatan`, `tempat_kegiatan`, `bentuk_kegiatan`, `anggaran`, `penutup`, `waktu_upload`, `file`, `status_approve`, `penyetuju`, `file_id`, `folder_parent`, `drive_id`) VALUES
(7, 7, 'Seminar', 'Seminar', 'Seminar', 'Seminar', '2016-06-29', 'Seminar', 'Seminar', 11111, 'Seminar', '2016-06-21 11:24:13', '7_048ad31155dde336e706bd06b981efbb8ac96b03.docx', 'y', '12345678-9', '', '', ''),
(8, 8, 'poiu', 'poiupio', 'upoiu', 'poi', '2016-06-22', 'upo', 'iup', 87876876, 'oiu', '2016-06-22 10:09:17', '8_0b369b9a1491093b2fc70cceafeb8c44d16202e3.pdf', NULL, NULL, '', '', ''),
(9, 9, 'poiu', 'poiu', 'poiu', 'poiu', '2016-06-23', 'poiu', 'poiu', 87658765, 'oioiuyoiuy', '2016-06-23 09:10:48', '9_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(10, 10, 'lkjhl', 'kjhl', 'kjh', 'lkjh', '2016-06-23', 'kljh', 'lkjhl', 9876876, 'lkj', '2016-06-23 09:14:59', '10_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(11, 11, 'lkjh', 'lkjhlk', 'jhlkjh', 'lkjhlk', '2016-06-23', 'lkjh', 'lkjhlkjh', 87658765, 'kuyuykjh', '2016-06-23 09:17:22', '11_4b678cbafe464cdf278c65783642b31cfdd9d697.pdf', NULL, NULL, '', '', ''),
(12, 12, 'lkjh', 'lkjhlk', 'jhlkjh', 'lkjhlk', '2016-06-23', 'lkjh', 'lkjhlkjh', 87658765, 'kuyuykjh', '2016-06-23 09:17:26', '12_4b678cbafe464cdf278c65783642b31cfdd9d697.pdf', NULL, NULL, '', '', ''),
(13, 13, 'ytyt', 'uytuy', 'tuyt', 'uyt', '2016-06-23', 'uytu', 'ytuyt', 765767, '65765765', '2016-06-23 09:19:10', '13_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(14, 14, 'ytyt', 'uytuy', 'tuyt', 'uyt', '2016-06-23', 'uytu', 'ytuyt', 765767, '65765765', '2016-06-23 09:21:36', '14_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(15, 15, 'poiu', 'poiu', 'poiu', 'oi', '2016-06-23', 'pi', '875', 876, '587', '2016-06-23 09:23:50', '15_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(16, 16, 'poiu', 'poiu', 'poiu', 'oi', '2016-06-23', 'pi', '875', 876, '587', '2016-06-23 09:26:09', '16_33abb95b6672048b5b107898b499b962569f5091.pdf', 'n', '12345678-9', '', '', ''),
(17, 17, 'poiu', 'poiu', 'poiu', 'oi', '2016-06-23', 'pi', '875', 876, '587', '2016-06-23 09:36:50', '17_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(18, 18, 'poiu', 'poiu', 'poiu', 'oi', '2016-06-23', 'pi', '875', 876, '587', '2016-06-23 09:41:01', '18_33abb95b6672048b5b107898b499b962569f5091.pdf', NULL, NULL, '', '', ''),
(19, 19, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:43:52', '19_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(20, 20, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:45:00', '20_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(21, 21, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:46:15', '21_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(22, 22, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:46:37', '22_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(23, 23, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:48:48', '23_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(24, 24, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:52:59', '24_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(25, 25, '98769', '876', '9876', '987', '2016-06-23', '698', '769', 87696, '9876', '2016-06-23 10:54:25', '25_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(26, 26, '987', '698', '76', '8976', '2016-06-23', '987', '98', 7698, '79', '2016-06-23 11:10:35', '26_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(27, 27, '987', '698', '76', '8976', '2016-06-23', '987', '98', 7698, '79', '2016-06-24 12:08:53', '27_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(28, 28, '987', '698', '76', '8976', '2016-06-23', '987', '98', 7698, '79', '2016-06-24 12:20:33', '28_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(29, 29, '987', '698', '76', '8976', '2016-06-23', '987', '98', 7698, '79', '2016-06-24 12:35:39', '29_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(30, 30, '987', '698', '76', '8976', '2016-06-23', '987', '98', 7698, '79', '2016-06-24 12:37:48', '30_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(31, 31, '987', '6987', '6987', '698', '2016-06-24', '8769', '8769', 876, '98769', '2016-06-24 12:40:40', '31_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(32, 32, '987', '6987', '6987', '698', '2016-06-24', '8769', '8769', 876, '98769', '2016-06-24 01:04:20', '32_791943aa1bbea28d557566b62f48c4e46bafd77e.pdf', NULL, NULL, '', '', ''),
(33, 34, '69876', '987', '698', '7698', '2016-06-24', '9876', '987', 6897, '9876987', '2016-06-24 02:41:47', '34_b235a358171df734b47ee523add2180f3424982c.pdf', NULL, NULL, '', '', '0B_mIc-chnSGMQnFFTmJxYVMwaE0'),
(34, 35, 'lkjh', 'lkjh', 'lkjh', 'lkjh', '2016-06-24', 'hlkjh', 'lkjh', 9876, 'oiuy', '2016-06-24 02:43:03', '35_b235a358171df734b47ee523add2180f3424982c.pdf', 'n', '12345678-9', '', '', '0B_mIc-chnSGMZlZhcVpKTjlRWGc'),
(35, 36, 'uytr', 'uytr', 'uytr', 'uytr', '2016-06-24', 'uytr', 'uytr', 7654, 'uytr', '2016-06-24 02:44:54', '36_b235a358171df734b47ee523add2180f3424982c.pdf', 'n', '12345678-9', '', '', '0B_mIc-chnSGMZ2lVbFd6NFNlTEU'),
(36, 36, 'gfdgfdgf', 'dgfdg', 'fdgf', 'dg', '2016-06-24', 'fdgf', 'gfd', 876, 'fhgfhgf', '2016-06-24 02:51:56', '36_b235a358171df734b47ee523add2180f3424982c.pdf', 'y', '12345678-9', '', '', '0B_mIc-chnSGMZmtHXy1kMy1VTGs');

-- --------------------------------------------------------

--
-- Stand-in structure for view `proposal_himpunan_a`
--
CREATE TABLE `proposal_himpunan_a` (
`id` int(11)
,`pengaju` int(11)
,`tanggal_pengajuan` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `proposal_himpunan_b`
--
CREATE TABLE `proposal_himpunan_b` (
`id` int(11)
,`judul` text
,`tanggal_proposal_terakhir` datetime
,`status_approve` enum('y','n')
,`penanggungjawab` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_lomba`
--

CREATE TABLE `proposal_lomba` (
  `id` int(11) NOT NULL,
  `id_pengajuan_proposal_mahasiswa` int(11) NOT NULL,
  `kategori_kompetisi` text NOT NULL,
  `tujuan_kompetisi` text NOT NULL,
  `sasaran_kompetisi` text NOT NULL,
  `tanggal_kompetisi` date NOT NULL,
  `tempat_kompetisi` text NOT NULL,
  `anggaran_biaya` int(11) NOT NULL,
  `nama_tim` varchar(100) NOT NULL,
  `pembimbing` varchar(100) NOT NULL,
  `waktu_upload` datetime NOT NULL,
  `file` varchar(100) NOT NULL,
  `status` enum('y','n') DEFAULT NULL,
  `penyetuju` varchar(50) DEFAULT NULL,
  `drive_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal_lomba`
--

INSERT INTO `proposal_lomba` (`id`, `id_pengajuan_proposal_mahasiswa`, `kategori_kompetisi`, `tujuan_kompetisi`, `sasaran_kompetisi`, `tanggal_kompetisi`, `tempat_kompetisi`, `anggaran_biaya`, `nama_tim`, `pembimbing`, `waktu_upload`, `file`, `status`, `penyetuju`, `drive_id`) VALUES
(6, 7, 'kjasdhfkasjdfhksajdf', 'kjashdkfjhasdkfjh', 'kjhkjashdfkjhasdkfjhaskdfjhk', '2016-06-21', 'jhkasjdfhkajsdfkasjdfhksajdfhkj', 1345134534, 'haskdfjhaskdjfhaksdjfhaskdfjh', 'kjhasdkfjhasdkfjhaskdfjhk', '2016-06-21 01:20:52', '7_6896a8696b8038f4fc8989ab005e4fccc3b90047.jpg', 'y', '12345678-9', ''),
(7, 8, 'Progaming', 'Menang', 'Noobies', '2016-06-30', 'Philipinoy', 100000, 'Napi', 'Dendy', '2016-06-22 06:22:21', '8_756f86bffb55db2c85c6e6a41f8e921fd6ff41ea.PNG', 'y', '12345678-9', '0B_mIc-chnSGMNFd5Q190SHZieXc'),
(8, 9, 'poiu', 'poiu', 'poiu', '2016-06-23', 'poiu', 9876, 'poiu', 'poiu', '2016-06-23 05:14:37', '9_4df20a8762a2dec28a8c354582f987aeb2d73d99.jpg', NULL, NULL, ''),
(9, 20, '9876865876', '587', '657', '2016-06-24', '865', 786, '8765', '7865', '2016-06-24 02:17:15', '20_b235a358171df734b47ee523add2180f3424982c.pdf', NULL, NULL, '0B_mIc-chnSGMWWd6aVlQSDU2RDQ'),
(10, 21, '0987', '0987', '0987', '2016-06-24', '0987', 70987, '0987', '098', '2016-06-24 02:20:04', '21_b235a358171df734b47ee523add2180f3424982c.pdf', 'n', '12345678-9', '0B_mIc-chnSGMdVJHekV3TUp2SXc'),
(11, 21, '1234', '1234', '1234', '2016-06-24', '1234', 1234, '1234', '1234', '2016-06-24 02:26:31', 'b235a358171df734b47ee523add2180f3424982c.pdf', 'n', '12345678-9', ''),
(12, 21, 'oiuyiuy', 'oiuyo', 'iuy', '2016-06-24', 'oiuy', 8768, 'oiuy', 'oiuyo', '2016-06-24 02:35:53', 'b235a358171df734b47ee523add2180f3424982c.pdf', NULL, NULL, '0B_mIc-chnSGMdVlBazZxa0F6dmc'),
(13, 21, 'oiuyiuy', 'oiuyo', 'iuy', '2016-06-24', 'oiuy', 8768, 'oiuy', 'oiuyo', '2016-06-24 02:37:32', 'b235a358171df734b47ee523add2180f3424982c.pdf', NULL, NULL, '0B_mIc-chnSGMdU1lY2g2OC12a1k');

-- --------------------------------------------------------

--
-- Stand-in structure for view `proposal_lomba_a`
--
CREATE TABLE `proposal_lomba_a` (
`id_pengajuan` int(11)
,`id_event` varchar(30)
,`pengaju` varchar(10)
,`tanggal_pengajuan` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `proposal_lomba_b`
--
CREATE TABLE `proposal_lomba_b` (
`id_pengajuan` int(11)
,`id_proposal` int(11)
,`kategori_kompetisi` text
,`tanggal_kompetisi` date
,`tanggal_proposal_terakhir` datetime
,`nama_tim` varchar(100)
,`status` enum('y','n')
,`penanggungjawab` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `nip` varchar(10) NOT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL,
  `jenis` enum('kaur','staff_kemahasiswaan','staff_admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`nip`, `id_user`, `jenis`) VALUES
('12345678-9', 1, 'kaur'),
('98765432-1', 3816, 'staff_admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(15) DEFAULT NULL,
  `foto_profil` text,
  `role` enum('staff','mahasiswa') NOT NULL DEFAULT 'mahasiswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `nama`, `alamat`, `telp`, `foto_profil`, `role`) VALUES
(1, '::1', 'kaur', '$2y$08$OrRCxDNx6s2bkwYGlOao1.qe6YKrR/WlFZ.eF6mtzzQ/QsrhF0U/q', NULL, 'kelompokg2012@gmail.com', NULL, 'nDIRYk2bVkAUK0Q0l3f47e50bf5ddc9f390ccb36', 1466543179, NULL, 1464805278, 1466709688, 1, 'Kakak Pertama', '', '', '1_a32fa4ac38c1ee47868625b8f362e630d3d9edc6.jpg', 'staff'),
(198, '::1', '1106124198', '$2y$08$o1WfLIZdkqjqU1ozvDVWh.FImoEP148FgfiIVS0W9Bs6WP9biad/C', NULL, 'aniskunis@students.telkomuniversity.ac.id', NULL, NULL, NULL, NULL, 1464815009, 1466708317, 1, 'ANISATUN NAFIAH', NULL, NULL, NULL, 'mahasiswa'),
(3816, '::1', 'admin', '$2y$08$cJCngUTjdg/aTLtwQv.JSuvjeZRmBFlzEsI8D0Gg44kwJREjUSIL6', NULL, 'kelompokg2012@gmail.com', NULL, NULL, NULL, '70HG9UiYnRpJOhh9cBWVlO', 1465255202, 1466703867, 1, 'LALA SULALA', 'Bukit Teletabi', NULL, NULL, 'staff'),
(3819, '::1', 'rezaharli', '$2y$08$M01BTxhhio6jweuDHfTCXeKErZw3HlZ4gEGef9tOxu5NodKmHR1BW', NULL, 'reza.harli@gmail.com', NULL, NULL, NULL, NULL, 1465944955, 1466680213, 1, 'REZA HARLI SAPUTRA', 'Perum. Bumi Banjararum Asri C-26, Singosari, Malang', '085790924932', '3819_a32fa4ac38c1ee47868625b8f362e630d3d9edc6.jpg', 'mahasiswa'),
(3820, '::1', '1106122134', '$2y$08$2woao8/N2h7fScwuXrjID.hbvxLTjxtTeojZvWy0OGqRVF5IQheMO', NULL, 'antonilmiar@students.telkomuniversity.ac.id', NULL, NULL, NULL, NULL, 1465944955, 1466453728, 1, 'ANTON ILMIAR WINDRISWARA', NULL, NULL, NULL, 'mahasiswa'),
(3821, '::1', '1106124204', '$2y$08$lLTyhEWxgS4IG0OJd8vrQO.mvJjlMvzG16ir.Us5OpY435EREPSoy', NULL, 'nurrida@students.telkomuniversity.ac.id', NULL, NULL, NULL, NULL, 1465944955, NULL, 1, 'NURRIDA AINI ZUHROH', NULL, NULL, NULL, 'mahasiswa');

-- --------------------------------------------------------

--
-- Structure for view `kegiatan_himpunan`
--
DROP TABLE IF EXISTS `kegiatan_himpunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kegiatan_himpunan`  AS  select `pph`.`id` AS `id`,`ph`.`judul` AS `nama_kegiatan`,`ph`.`tanggal_kegiatan` AS `tanggal_pelaksanaan`,`ph`.`tempat_kegiatan` AS `tempat_kegiatan` from (`proposal_himpunan` `ph` join `pengajuan_proposal_himpunan` `pph`) where ((`ph`.`id_pengajuan_proposal` = `pph`.`id`) and (`ph`.`status_approve` = 'y')) ;

-- --------------------------------------------------------

--
-- Structure for view `logbook_detail_tim`
--
DROP TABLE IF EXISTS `logbook_detail_tim`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `logbook_detail_tim`  AS  select `user`.`nama` AS `nama`,`mahasiswa`.`nim` AS `nim`,`proposal_lomba`.`id` AS `id` from (((`user` join `mahasiswa`) join `detail_tim`) join `proposal_lomba`) where ((`user`.`id` = `mahasiswa`.`id_user`) and (`mahasiswa`.`nim` = `detail_tim`.`nim_anggota`) and (`proposal_lomba`.`id` = `detail_tim`.`id_proposal_lomba`)) ;

-- --------------------------------------------------------

--
-- Structure for view `logbook_proposal_himpunan`
--
DROP TABLE IF EXISTS `logbook_proposal_himpunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `logbook_proposal_himpunan`  AS  select `proposal_himpunan_a`.`id` AS `id`,`proposal_himpunan_a`.`pengaju` AS `pengaju`,`proposal_himpunan_a`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`proposal_himpunan_b`.`judul` AS `judul`,`proposal_himpunan_b`.`tanggal_proposal_terakhir` AS `tanggal_proposal_terakhir`,`proposal_himpunan_b`.`status_approve` AS `status_approve`,`proposal_himpunan_b`.`penanggungjawab` AS `penanggungjawab` from (`proposal_himpunan_a` join `proposal_himpunan_b` on((`proposal_himpunan_a`.`id` = `proposal_himpunan_b`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `logbook_proposal_mhs`
--
DROP TABLE IF EXISTS `logbook_proposal_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `logbook_proposal_mhs`  AS  select `proposal_lomba_a`.`id_pengajuan` AS `id_pengajuan`,`event`.`nama_event` AS `nama_event`,`proposal_lomba_b`.`id_proposal` AS `id_proposal`,`proposal_lomba_b`.`tanggal_kompetisi` AS `tanggal_kompetisi`,`proposal_lomba_a`.`pengaju` AS `pengaju`,`proposal_lomba_a`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`proposal_lomba_b`.`kategori_kompetisi` AS `kategori_kompetisi`,`proposal_lomba_b`.`tanggal_proposal_terakhir` AS `tanggal_proposal_terakhir`,`proposal_lomba_b`.`nama_tim` AS `nama_tim`,`proposal_lomba_b`.`status` AS `status`,`proposal_lomba_b`.`penanggungjawab` AS `penanggungjawab` from ((`event` join `proposal_lomba_a` on((`event`.`id` = `proposal_lomba_a`.`id_event`))) join `proposal_lomba_b` on((`proposal_lomba_a`.`id_pengajuan` = `proposal_lomba_b`.`id_pengajuan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `notifikasi`
--
DROP TABLE IF EXISTS `notifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `notifikasi`  AS  select `notifikasi_asal`.`pesan` AS `pesan`,`notifikasi_asal`.`waktu` AS `waktu`,`notifikasi_asal`.`asal` AS `asal`,`notifikasi_tujuan`.`tujuan` AS `tujuan`,`notifikasi_tujuan`.`terbaca` AS `terbaca` from (`notifikasi_asal` join `notifikasi_tujuan` on((`notifikasi_asal`.`id` = `notifikasi_tujuan`.`id_notifikasi_asal`))) ;

-- --------------------------------------------------------

--
-- Structure for view `proposal_himpunan_a`
--
DROP TABLE IF EXISTS `proposal_himpunan_a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proposal_himpunan_a`  AS  select `pph`.`id` AS `id`,`pph`.`pengaju_proposal` AS `pengaju`,`ph`.`waktu_upload` AS `tanggal_pengajuan` from ((`proposal_himpunan` `ph` left join `proposal_himpunan` `prev` on(((`prev`.`id_pengajuan_proposal` = `ph`.`id_pengajuan_proposal`) and (`prev`.`waktu_upload` < `ph`.`waktu_upload`)))) join `pengajuan_proposal_himpunan` `pph` on((`pph`.`id` = `ph`.`id_pengajuan_proposal`))) where isnull(`prev`.`id`) order by `ph`.`id_pengajuan_proposal` ;

-- --------------------------------------------------------

--
-- Structure for view `proposal_himpunan_b`
--
DROP TABLE IF EXISTS `proposal_himpunan_b`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proposal_himpunan_b`  AS  select `pph`.`id` AS `id`,`ph`.`judul` AS `judul`,`ph`.`waktu_upload` AS `tanggal_proposal_terakhir`,`ph`.`status_approve` AS `status_approve`,`ph`.`penyetuju` AS `penanggungjawab` from ((`proposal_himpunan` `ph` left join `proposal_himpunan` `prev` on(((`prev`.`id_pengajuan_proposal` = `ph`.`id_pengajuan_proposal`) and (`prev`.`waktu_upload` > `ph`.`waktu_upload`)))) join `pengajuan_proposal_himpunan` `pph` on((`pph`.`id` = `ph`.`id_pengajuan_proposal`))) where isnull(`prev`.`id`) order by `ph`.`id_pengajuan_proposal` ;

-- --------------------------------------------------------

--
-- Structure for view `proposal_lomba_a`
--
DROP TABLE IF EXISTS `proposal_lomba_a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proposal_lomba_a`  AS  select `ppm`.`id` AS `id_pengajuan`,`ppm`.`id_event` AS `id_event`,`ppm`.`pengaju_proposal` AS `pengaju`,`pl`.`waktu_upload` AS `tanggal_pengajuan` from ((`proposal_lomba` `pl` left join `proposal_lomba` `prev` on(((`prev`.`id_pengajuan_proposal_mahasiswa` = `pl`.`id_pengajuan_proposal_mahasiswa`) and (`prev`.`waktu_upload` < `pl`.`waktu_upload`)))) join `pengajuan_proposal_mahasiswa` `ppm` on((`ppm`.`id` = `pl`.`id_pengajuan_proposal_mahasiswa`))) where isnull(`prev`.`id`) order by `pl`.`id_pengajuan_proposal_mahasiswa` ;

-- --------------------------------------------------------

--
-- Structure for view `proposal_lomba_b`
--
DROP TABLE IF EXISTS `proposal_lomba_b`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proposal_lomba_b`  AS  select `ppm`.`id` AS `id_pengajuan`,`pl`.`id` AS `id_proposal`,`pl`.`kategori_kompetisi` AS `kategori_kompetisi`,`pl`.`tanggal_kompetisi` AS `tanggal_kompetisi`,`pl`.`waktu_upload` AS `tanggal_proposal_terakhir`,`pl`.`nama_tim` AS `nama_tim`,`pl`.`status` AS `status`,`pl`.`penyetuju` AS `penanggungjawab` from ((`proposal_lomba` `pl` left join `proposal_lomba` `prev` on(((`prev`.`id_pengajuan_proposal_mahasiswa` = `pl`.`id_pengajuan_proposal_mahasiswa`) and (`prev`.`waktu_upload` > `pl`.`waktu_upload`)))) join `pengajuan_proposal_mahasiswa` `ppm` on((`ppm`.`id` = `pl`.`id_pengajuan_proposal_mahasiswa`))) where isnull(`prev`.`id`) order by `pl`.`id_pengajuan_proposal_mahasiswa` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acara_himpunan`
--
ALTER TABLE `acara_himpunan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengajuan_proposal` (`id_pengajuan_proposal`);

--
-- Indexes for table `bukti_lomba`
--
ALTER TABLE `bukti_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`pengupload`);

--
-- Indexes for table `detail_tim`
--
ALTER TABLE `detail_tim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proposal_lomba` (`id_proposal_lomba`),
  ADD KEY `nim` (`nim_anggota`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaju_event` (`pengaju_event`),
  ADD KEY `penyetuju_event` (`penanggungjawab`);

--
-- Indexes for table `himpunan`
--
ALTER TABLE `himpunan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penanggungjawab` (`id_penanggungjawab`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lpj_himpunan`
--
ALTER TABLE `lpj_himpunan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengajuan_proposal` (`id_pengajuan_proposal`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `notifikasi_asal`
--
ALTER TABLE `notifikasi_asal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dari` (`asal`);

--
-- Indexes for table `notifikasi_tujuan`
--
ALTER TABLE `notifikasi_tujuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_notifikasi_asal` (`id_notifikasi_asal`),
  ADD KEY `kepada` (`tujuan`);

--
-- Indexes for table `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_acara` (`id_acara`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `pengajuan_proposal_himpunan`
--
ALTER TABLE `pengajuan_proposal_himpunan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_pengaju` (`pengaju_proposal`);

--
-- Indexes for table `pengajuan_proposal_mahasiswa`
--
ALTER TABLE `pengajuan_proposal_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `pengaju_proposal` (`pengaju_proposal`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_acara` (`id_acara`);

--
-- Indexes for table `proposal_himpunan`
--
ALTER TABLE `proposal_himpunan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengajuan_proposal` (`id_pengajuan_proposal`),
  ADD KEY `penyetuju` (`penyetuju`);

--
-- Indexes for table `proposal_lomba`
--
ALTER TABLE `proposal_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengajuan_proposal_mahasiswa` (`id_pengajuan_proposal_mahasiswa`),
  ADD KEY `penyetuju` (`penyetuju`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acara_himpunan`
--
ALTER TABLE `acara_himpunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bukti_lomba`
--
ALTER TABLE `bukti_lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `detail_tim`
--
ALTER TABLE `detail_tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `himpunan`
--
ALTER TABLE `himpunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lpj_himpunan`
--
ALTER TABLE `lpj_himpunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifikasi_asal`
--
ALTER TABLE `notifikasi_asal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifikasi_tujuan`
--
ALTER TABLE `notifikasi_tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `panitia`
--
ALTER TABLE `panitia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengajuan_proposal_himpunan`
--
ALTER TABLE `pengajuan_proposal_himpunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `pengajuan_proposal_mahasiswa`
--
ALTER TABLE `pengajuan_proposal_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `proposal_himpunan`
--
ALTER TABLE `proposal_himpunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `proposal_lomba`
--
ALTER TABLE `proposal_lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3822;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acara_himpunan`
--
ALTER TABLE `acara_himpunan`
  ADD CONSTRAINT `acara_himpunan_ibfk_1` FOREIGN KEY (`id_pengajuan_proposal`) REFERENCES `pengajuan_proposal_himpunan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bukti_lomba`
--
ALTER TABLE `bukti_lomba`
  ADD CONSTRAINT `bukti_lomba_ibfk_1` FOREIGN KEY (`pengupload`) REFERENCES `mahasiswa` (`nim`);

--
-- Constraints for table `detail_tim`
--
ALTER TABLE `detail_tim`
  ADD CONSTRAINT `detail_tim_ibfk_2` FOREIGN KEY (`nim_anggota`) REFERENCES `mahasiswa` (`nim`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_tim_ibfk_3` FOREIGN KEY (`id_proposal_lomba`) REFERENCES `proposal_lomba` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`penanggungjawab`) REFERENCES `staff` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`pengaju_event`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `himpunan`
--
ALTER TABLE `himpunan`
  ADD CONSTRAINT `himpunan_ibfk_1` FOREIGN KEY (`id_penanggungjawab`) REFERENCES `mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `lpj_himpunan`
--
ALTER TABLE `lpj_himpunan`
  ADD CONSTRAINT `lpj_himpunan_ibfk_1` FOREIGN KEY (`id_pengajuan_proposal`) REFERENCES `pengajuan_proposal_himpunan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi_asal`
--
ALTER TABLE `notifikasi_asal`
  ADD CONSTRAINT `notifikasi_asal_ibfk_1` FOREIGN KEY (`asal`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi_tujuan`
--
ALTER TABLE `notifikasi_tujuan`
  ADD CONSTRAINT `notifikasi_tujuan_ibfk_1` FOREIGN KEY (`id_notifikasi_asal`) REFERENCES `notifikasi_asal` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notifikasi_tujuan_ibfk_2` FOREIGN KEY (`tujuan`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `panitia`
--
ALTER TABLE `panitia`
  ADD CONSTRAINT `panitia_ibfk_1` FOREIGN KEY (`id_acara`) REFERENCES `acara_himpunan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `panitia_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `pengajuan_proposal_himpunan`
--
ALTER TABLE `pengajuan_proposal_himpunan`
  ADD CONSTRAINT `pengajuan_proposal_himpunan_ibfk_1` FOREIGN KEY (`pengaju_proposal`) REFERENCES `himpunan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_proposal_mahasiswa`
--
ALTER TABLE `pengajuan_proposal_mahasiswa`
  ADD CONSTRAINT `pengajuan_proposal_mahasiswa_ibfk_1` FOREIGN KEY (`pengaju_proposal`) REFERENCES `mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_proposal_mahasiswa_ibfk_2` FOREIGN KEY (`id_event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_acara`) REFERENCES `acara_himpunan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `proposal_himpunan`
--
ALTER TABLE `proposal_himpunan`
  ADD CONSTRAINT `proposal_himpunan_ibfk_1` FOREIGN KEY (`id_pengajuan_proposal`) REFERENCES `pengajuan_proposal_himpunan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `proposal_himpunan_ibfk_2` FOREIGN KEY (`penyetuju`) REFERENCES `staff` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `proposal_lomba`
--
ALTER TABLE `proposal_lomba`
  ADD CONSTRAINT `proposal_lomba_ibfk_1` FOREIGN KEY (`id_pengajuan_proposal_mahasiswa`) REFERENCES `pengajuan_proposal_mahasiswa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `proposal_lomba_ibfk_2` FOREIGN KEY (`penyetuju`) REFERENCES `staff` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
