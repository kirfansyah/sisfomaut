-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jul 2022 pada 14.56
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sisfomaut`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bobot_kriteria`
--

CREATE TABLE `tb_bobot_kriteria` (
  `id_bobot_k` int(11) NOT NULL,
  `kriteria_kost` varchar(128) NOT NULL,
  `bobot` varchar(128) NOT NULL,
  `normalisasi_bobot` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bobot_kriteria`
--

INSERT INTO `tb_bobot_kriteria` (`id_bobot_k`, `kriteria_kost`, `bobot`, `normalisasi_bobot`) VALUES
(1, 'Harga', '383', '0.204594017'),
(2, 'Lokasi Kost Ke Kampus', '335', '0.178952991'),
(3, 'Kondisi Air', '295', '0.15758547'),
(4, 'Luas Kamar', '250', '0.133547009'),
(5, 'Letak Kamar Mandi', '242', '0.129273504'),
(6, 'Dapur', '144', '0.076923077'),
(7, 'Akses Internet (WIFI)', '124', '0.066239316'),
(8, 'Garasi', '99', '0.052884615');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_graph`
--

CREATE TABLE `tb_graph` (
  `id_graph` int(11) NOT NULL,
  `graphAwal` varchar(255) NOT NULL,
  `graphAkhir` varchar(255) NOT NULL,
  `graphJarak` varchar(255) NOT NULL,
  `id_graphAwal` varchar(128) NOT NULL,
  `id_graphAkhir` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_graph`
--

INSERT INTO `tb_graph` (`id_graph`, `graphAwal`, `graphAkhir`, `graphJarak`, `id_graphAwal`, `id_graphAkhir`) VALUES
(1, 'S43', 'S114', '0.239255615863', '43', '120'),
(2, 'S114', 'S43', '0.239255615863', '120', '43'),
(5, 'S114', 'S113', '0.13040583468079', '120', '119'),
(6, 'S113', 'S114', '0.13040583468079', '119', '120'),
(7, 'S113', 'S112', '0.14420609748704', '119', '118'),
(8, 'S112', 'S113', '0.14420609748704', '118', '119'),
(9, 'S111', 'S112', '0.11596963659402', '117', '118'),
(10, 'S112', 'S111', '0.11596963659402', '118', '117'),
(11, 'S111', 'S110', '0.09692690543335', '117', '116'),
(12, 'S110', 'S111', '0.09692690543335', '116', '117'),
(13, 'S110', 'S42', '0.19771362770131', '116', '42'),
(14, 'S42', 'S110', '0.19771362770131', '42', '116'),
(15, 'S42', 'S41', '0.30481988308462', '42', '41'),
(16, 'S41', 'S42', '0.30481988308462', '41', '42'),
(21, 'S79', 'S64', '0.066823621085753', '79', '64'),
(22, 'S64', 'S79', '0.066823621085753', '64', '79'),
(23, 'S44', 'S64', '0.19058755557104', '44', '64'),
(24, 'S64', 'S44', '0.19058755557104', '64', '44'),
(25, 'S44', 'S80', '0.057375665507627', '44', '80'),
(26, 'S80', 'S44', '0.057375665507627', '80', '44'),
(27, 'S41', 'S64', '0.18467571598942', '41', '64'),
(28, 'S64', 'S41', '0.18467571598942', '64', '41'),
(29, 'S79', 'S80', '0.16172125148354', '79', '80'),
(30, 'S80', 'S79', '0.16172125148354', '80', '79'),
(31, 'S121', 'S64', '0.14549585240425', '301', '64'),
(32, 'S64', 'S121', '0.14549585240425', '64', '301');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembobotan_kriteria`
--

CREATE TABLE `tb_pembobotan_kriteria` (
  `id_pembobotan` int(11) NOT NULL,
  `id_rekap_data_kost` int(11) NOT NULL,
  `nama_kost` varchar(128) NOT NULL,
  `jenis_kost` varchar(128) NOT NULL,
  `harga_kost` varchar(128) NOT NULL,
  `rute_ke_kampus` varchar(128) NOT NULL,
  `kondisi_air` varchar(128) NOT NULL,
  `luas_kamar` varchar(128) NOT NULL,
  `letak_kamar_mandi` varchar(128) NOT NULL,
  `dapur` varchar(128) NOT NULL,
  `wifi` varchar(128) NOT NULL,
  `garasi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembobotan_kriteria`
--

INSERT INTO `tb_pembobotan_kriteria` (`id_pembobotan`, `id_rekap_data_kost`, `nama_kost`, `jenis_kost`, `harga_kost`, `rute_ke_kampus`, `kondisi_air`, `luas_kamar`, `letak_kamar_mandi`, `dapur`, `wifi`, `garasi`) VALUES
(1, 1, 'Zona Kost', 'Laki-laki', '0.75', '3', '3', '2.25', '1', '1', '0', '3'),
(2, 2, 'RCB', 'Perempuan', '2.25', '3', '1', '1.5', '1', '1', '3', '1'),
(3, 3, '4G Boarding House', 'Perempuan', '0.375', '3', '3', '2.25', '3', '2', '3', '3'),
(4, 4, 'Kost Pak Rusli', 'Laki-laki', '2.25', '3', '1', '1.5', '1', '1', '0', '1'),
(5, 5, 'Kost Global Raya', 'Perempuan', '1.875', '2.5', '1', '2.625', '1', '1', '1', '1'),
(6, 6, 'Kost Hj. Madriah', 'Perempuan', '1.875', '2.5', '3', '2.625', '3', '1', '0', '1'),
(7, 7, 'Kost Pak Jafar', 'Perempuan', '2.25', '2.5', '1', '0.375', '1', '1', '3', '2'),
(8, 8, 'Kost Buk Ana', 'Laki-laki', '0.375', '2', '3', '2.625', '3', '0', '3', '3'),
(9, 9, 'Kost Keluarga', 'Laki-laki', '1.875', '2.5', '3', '1.125', '1', '0', '3', '2'),
(10, 10, 'Kost Kucing Putih', 'Laki-laki', '1.5', '2.5', '1', '3', '1', '1', '0', '1'),
(11, 11, 'Kost Buna', 'Laki-laki', '0.75', '2.5', '3', '2.25', '1', '1', '0', '3'),
(12, 12, 'Kost Paknek', 'Perempuan', '2.625', '2.5', '1', '2.625', '1', '1', '0', '2'),
(13, 13, 'Kost Kak Anis', 'Perempuan', '2.625', '2.5', '1', '2.25', '1', '1', '0', '1'),
(14, 14, 'Kost Pak Mudin', 'Perempuan', '2.25', '3', '1', '0.375', '1', '1', '3', '1'),
(15, 15, 'Kost H. Bukhari', 'Perempuan', '1.125', '3', '3', '1.125', '3', '1', '3', '0'),
(16, 16, 'Kost Buk Yul', 'Perempuan', '0.75', '2', '3', '2.25', '1', '3', '3', '2'),
(17, 17, 'Kost Mahema', 'Perempuan', '1.875', '1.5', '3', '1.5', '1', '1', '0', '1'),
(18, 18, 'Kost Nuvo Family', 'Laki-laki', '1.875', '2', '3', '2.25', '1', '2', '3', '2'),
(19, 19, 'Kost Buk Wanti', 'Perempuan', '0.375', '1.5', '3', '1.5', '1', '2', '0', '2'),
(20, 20, 'Kost Buk Ros', 'Perempuan', '2.25', '2', '1', '1.5', '1', '1', '0', '1'),
(21, 21, 'Kost Nusantara', 'Perempuan', '0.375', '2', '1', '2.25', '3', '2', '3', '3'),
(22, 22, 'Kost Cek Ti', 'Laki-laki', '1.5', '2', '3', '2.25', '1', '2', '1', '3'),
(23, 23, 'Kost Hijau', 'laki-laki', '1.875', '2', '3', '1.5', '1', '1', '3', '2'),
(24, 24, 'Kost Tengku Wan', 'Perempuan', '0.375', '1.5', '3', '2.25', '1', '1', '1', '1'),
(25, 25, 'Kost Pak Rusdi', 'Perempuan', '0.75', '1.5', '3', '1.5', '1', '2', '0', '1'),
(26, 26, 'Kost Diva', 'Perempuan', '3', '1.5', '3', '0.75', '1', '1', '0', '1'),
(27, 27, 'Kost Pak Talip', 'Laki-laki', '3', '1.5', '3', '1.5', '1', '1', '0', '2'),
(28, 28, 'Kost Fahlin', 'Perempuan', '1.125', '1.5', '1', '2.25', '1', '0', '3', '1'),
(29, 29, 'Kost Ungu', 'Perempuan', '0.375', '1.5', '1', '3', '1', '2', '3', '2'),
(30, 30, 'Kost Pelangi', 'Perempuan', '1.125', '2', '3', '2.25', '1', '1', '3', '3'),
(31, 31, 'Kost Ceiza', 'Perempuan', '0.75', '2', '3', '3', '3', '2', '3', '3'),
(32, 32, 'Kost Muarif', 'Perempuan', '0.75', '2', '3', '1.5', '1', '2', '0', '3'),
(33, 33, 'Kost Pak Herman', 'Perempuan', '1.875', '1', '1', '2.25', '1', '1', '0', '1'),
(34, 34, 'Kost Nurazam', 'Perempuan', '0.75', '1', '3', '1.5', '3', '1', '3', '2'),
(35, 35, 'Kost Hasan', 'Laki-laki', '0.75', '1.5', '3', '3', '3', '0', '0', '0'),
(36, 36, 'Kost Pondok Jambu', 'Perempuan', '1.5', '1', '3', '1.5', '1', '1', '3', '3'),
(37, 37, 'Kost Shadz', 'Perempuan', '0.375', '1', '3', '3', '3', '3', '3', '3'),
(38, 38, 'Kost PTK', 'Laki-laki', '0.75', '1', '1', '1.5', '1', '1', '3', '2'),
(39, 39, 'Kost Pak Muhammad', 'Perempuan', '1.125', '1.5', '3', '2.25', '3', '1', '3', '3'),
(40, 40, 'Kost Buk Ana', 'Perempuan', '1.125', '1', '3', '3', '1', '1', '1', '1'),
(41, 41, 'Kost Buk Fitiriani', 'Perempuan', '1.875', '1.5', '3', '2.25', '1', '1', '0', '2'),
(42, 42, 'Kost Buk Emi', 'Perempuan', '2.25', '1', '3', '2.25', '1', '0', '0', '1'),
(43, 43, 'Kost Mustofa', 'Perempuan', '1.875', '0.5', '1', '1.875', '1', '1', '0', '1'),
(44, 44, 'Kost Pak Saiful', 'Laki-laki', '2.625', '1', '1', '1.5', '1', '1', '0', '1'),
(45, 45, 'Kost RM Keluarga', 'Laki-laki', '2.625', '0.5', '1', '1.5', '1', '1', '0', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_preferensi`
--

CREATE TABLE `tb_preferensi` (
  `id_preferensi` int(11) NOT NULL,
  `id_rekap_data_kost` int(11) NOT NULL,
  `preferensi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_preferensi`
--

INSERT INTO `tb_preferensi` (`id_preferensi`, `id_rekap_data_kost`, `preferensi`) VALUES
(1, 1, '0.53968253968254'),
(2, 2, '0.49183455433455'),
(3, 3, '0.73160866910867'),
(4, 4, '0.42559523809524'),
(5, 5, '0.43989112739113'),
(6, 6, '0.70467032967033'),
(7, 7, '0.41643772893773'),
(8, 8, '0.62782356532357'),
(9, 9, '0.55731074481074'),
(10, 10, '0.40766178266178'),
(11, 11, '0.50389194139194'),
(12, 12, '0.49389499389499'),
(13, 13, '0.45718864468864'),
(14, 14, '0.43460012210012'),
(15, 15, '0.65430402930403'),
(16, 16, '0.56799450549451'),
(17, 17, '0.4465811965812'),
(18, 18, '0.63003663003663'),
(19, 19, '0.37293956043956'),
(20, 20, '0.35401404151404'),
(21, 21, '0.502442002442'),
(22, 22, '0.57427757427757'),
(23, 23, '0.56623931623932'),
(24, 24, '0.38990638990639'),
(25, 25, '0.38453907203907'),
(26, 26, '0.49610805860806'),
(27, 27, '0.55189255189255'),
(28, 28, '0.30929487179487'),
(29, 29, '0.35790598290598'),
(30, 30, '0.56356837606838'),
(31, 31, '0.72741147741148'),
(32, 32, '0.45558608058608'),
(33, 33, '0.29136141636142'),
(34, 34, '0.53624847374847'),
(35, 35, '0.5212148962149'),
(36, 36, '0.48305860805861'),
(37, 37, '0.65224358974359'),
(38, 38, '0.2493894993895'),
(39, 39, '0.65705128205128'),
(40, 40, '0.45072751322751'),
(41, 41, '0.50236568986569'),
(42, 42, '0.45253357753358'),
(43, 43, '0.23649267399267'),
(44, 44, '0.31166056166056'),
(45, 45, '0.27586996336996');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekap_data_kost`
--

CREATE TABLE `tb_rekap_data_kost` (
  `id_rekap_data_kost` int(11) NOT NULL,
  `nama_kost` varchar(128) NOT NULL,
  `jenis_kost` varchar(128) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `harga_kost` varchar(128) NOT NULL,
  `rute_ke_kampus` varchar(128) NOT NULL,
  `kondisi_air` varchar(128) NOT NULL,
  `luas_kamar` varchar(128) NOT NULL,
  `letak_kamar_mandi` varchar(128) NOT NULL,
  `dapur` varchar(128) NOT NULL,
  `wifi` varchar(50) NOT NULL,
  `garasi` varchar(50) NOT NULL,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `narahubung` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rekap_data_kost`
--

INSERT INTO `tb_rekap_data_kost` (`id_rekap_data_kost`, `nama_kost`, `jenis_kost`, `alamat_lengkap`, `harga_kost`, `rute_ke_kampus`, `kondisi_air`, `luas_kamar`, `letak_kamar_mandi`, `dapur`, `wifi`, `garasi`, `latitude`, `longitude`, `narahubung`, `gambar`) VALUES
(1, 'Zona Kost', 'Laki-laki', 'Lorong SMPN 8 Lhokseumawe, Desa Blang Pulo, Kecamatan Muara Satu, Lhokseumawe', '5000000', '0.8', 'Jernih', '3 x 4\n', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Luas', '5.208255', '97.067226', 'Buk Ros\n081360150730', ''),
(2, 'RCB', 'Perempuan', 'Lorong SMPN 8 Lhokseumawe, Desa Blang Pulo, Kecamatan Muara Satu, Lhokseumawe', '3500000', '0.8', 'Tidak Jernih ', '3 x 3 ', 'Diluar Kamar', 'Kosong', 'Lancar', 'Kecil', '5.208178', '97.067111', 'Kak Rija\n082292964053', ''),
(3, '4G Boarding House', 'Perempuan', 'Lorong SMPN 8 Lhokseumawe, Desa Blang Pulo, \nKecamatan Muara Satu, Lhokseumawe', '6000000', '0.6', 'Jernih', '3 x 4', 'Dalam Kamar', 'Tidak \nLengkap', 'Lancar', 'Luas', '5.208125', '97.068239', 'Buk Emi\n085260905891', ''),
(4, 'Kost Pak Rusli', 'Laki-laki', 'Lorong SMPN 8 Lhokseumawe, Desa Blang Pulo,\nKecamatan Muara Satu, Lhokseumawe ', '3500000', '0.95', 'Tidak Jernih ', '3 x 3 ', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.208772', '97.067645', 'Pak Rusli\n082218899264', ''),
(5, 'Kost Global Raya', 'Perempuan', 'Jalan Medan - B. Aceh Dusun Arongan, Desa \nBlang Pulo, Kecamatan Muara Satu, Lhokseumawe', '4000000', '1.3', 'Tidak Jernih ', '3,5 x 3,5', 'Diluar Kamar', 'Kosong', 'Tidak Lancar', 'Kecil', '5.210873', '97.069731', 'Hj. Madriah \n082361054544', ''),
(6, 'Kost Hj. Madriah', 'Perempuan', 'Jalan Medan - B. Aceh Lorong Pribadi (Belakang\nIrham Kupi) Dusun Arongan, Desa Blang Pulo,\nKecamatan Muara Satu, Lhoksemawe', '4000000', '1.4', 'Jernih', '3,5 x 3,5', 'Didalam Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.209791', '97.070377', 'Hj. Madriah \n082361054544', ''),
(7, 'Kost Pak Jafar', 'Perempuan', 'Jalan Medan - B. Aceh Lorong IE RO Malaya, \nDesa Blang Pulo, Kecamatan Muara Satu, \nLhokseumawe', '3500000', '1.5', 'Tidak Jernih ', '2 x 3', 'Diluar Kamar', 'Kosong', 'Lancar', 'Sedang', '5.21016', '97.071524', 'Pak Jafar\n082179599712', ''),
(8, 'Kost Buk Ana', 'Laki-laki', 'Jalan PNKA, Desa Blang Pulo, Kecamatan Muara\nSatu, Lhokseumawe', '6000000', '1.8', 'Jernih', '3,5 x 3.5', 'Didalam Kamar', 'Tidak Ada ', 'Lancar', 'Luas', '5.21623', '97.062096', 'Buk Ana\n085358210873', ''),
(9, 'Kost Keluarga', 'Laki-laki', 'Jalan Medan - B. Aceh Lorong Keluarga Dusun Tengah, Desa Blang Pulo, Kecamatan Muara Satu, Lhokseumawe', '4000000', '1.2', 'Jernih', '2,5 x 3', 'Diluar Kamar', 'Tidak Ada ', 'Lancar', 'Sedang', '5.212951', '97.066128', 'Buk Cut\n081377396006', ''),
(10, 'Kost Kucing Putih', 'Laki-laki', 'Jalan Medan - B. Aceh Dusun Tengah Desa Blang Pulo, Kecamatan Muara Satu, Lhokseumawe', '4300000', '1.2', 'Tidak Jernih ', '4 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.212982', '97.06653', 'Buk Ariani\n082286999531', ''),
(11, 'Kost Buna', 'Laki-laki', 'Lorong Putra Neng Meunasah Arun, Desa Blang Pulo, Kecamatan Muara Satu\n Lhokseumawe', '5350000', '1.4', 'Jernih', '3 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Luas', '5.208915', '97.073684', 'Buk Ana\n', ''),
(12, 'Kost Paknek', 'Perempuan', 'Jalan Medan - B. Aceh Lorong Petuah, Dusun\nTengah, Desa Blang Pulo, Kecamatan Muara Satu,\nLhokseumawe', '3000000', '1.3', 'Tidak Jernih ', '3,5 x 3,5', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Sedang', '5.211303', '97.065426', 'Buk Upi\n081260132656', ''),
(13, 'Kost Kak Anis', 'Perempuan', 'Jalan Medan - B. Aceh Dusun Cot Monturap, Desa Blang Pulo, Kecamatan Muara Satu, Lhokseumawe', '3000000', '1.4', 'Tidak Jernih ', '3 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.213978', '97.063907', 'Kak Anis\n082317538321', ''),
(14, 'Kost Pak Mudin', 'Perempuan', 'Jalan Kampus Unimal Bukit Indah\n(Belakang Kantin K13), Desa Blang Pulo, Kecamatan Muara Satu, Lhokseumawe', '3500000', '0.95', 'Tidak Jernih ', '2 x 3', 'Diluar Kamar', 'Kosong', 'Lancar', 'Kecil', '5.210232', '97.066775', 'Pak Mudin\n085295454983', ''),
(15, 'Kost H. Bukhari', 'Perempuan', 'Jalan Kampus Unimal Bukit Indah, Desa\nBlang Pulo, Kecamatan Muara Satu, Lhokseumawe', '5000000', '0.6', 'Jernih', '2,5 x 3', 'Didalam Kamar', 'Kosong', 'Lancar', 'Tidak Ada', '5.208532', '97.065915', 'H. Bukhari\n081362732833', ''),
(16, 'Kost Buk Yul', 'Perempuan', 'Jalan Kampus Bukit Indah, Desa Padang Sakti, Kecamatan \nMuara Satu, Lhokseumawe', '5500000', '1.6', 'Jernih', '3 x 4', 'Diluar Kamar', 'Lengkap', 'Lancar', 'Sedang', '5.2053359', '97.0760926', 'Kadri\n08116709725', ''),
(17, 'Kost Mahema', 'Perempuan', 'Jalan Line Pipa, Lorong Cot Suwe, Dusun Uteun\nRayeuk, Desa Padang Sakti, Kecamatan Muara\nSatu, Lhokseumawe', '4000000', '2.1', 'Jernih', '3 x 3', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.2027462', '97.0782284', 'Pak Mukhtar\n08126566672', ''),
(18, 'Kost Nuvo Family', 'Laki-laki', 'Jalan Line Pipa, Lorong Cot Suwe, Dusun Uteun\nRayeuk, Desa Padang Sakti, Kecamatan Muara\nSatu, Lhokseumawe. (Depan Kebun Buah Naga)', '4000000', '2', 'Jernih', '3 x 4', 'Diluar Kamar', 'Tidak\nLengkap', 'Lancar', 'Sedang', '5.2040887', '97.0780321', 'Pak Zainal\n085277777985', ''),
(19, 'Kost Buk Wanti', 'Perempuan', 'Jalan Line Pipa Lorong Tengku (Depan Balai \nPertemuan Tengku Dipanyang), Desa Padang Sakti, Kecamatan Muara Satu, Lhokseumawe', '5750000', '2.2', 'Jernih', '3 x 3', 'Diluar Kamar', 'Tidak\nLengkap', 'Tidak Ada', 'Sedang', '5.2087852', '97.0792874', 'Buk Wanti\n085359484395', ''),
(20, 'Kost Buk Ros', 'Perempuan', 'Jalan Line Pipa Lorong Aman, Dusun Tengku \nDipanyang, Desa Padang Sakti, Kecamatan Muara\nSatu, Lhokseumawe', '3500000', '2', 'Tidak Jernih ', '3 x 3', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.2084199', '97.0787185', 'Kost Buk Ros\n082288567613', ''),
(21, 'Kost Nusantara', 'Perempuan', 'Jalan Line Pipa Lorong Lambideng, Desa Padang\nSakti, Kecamatan Muara Satu, Lhokseumawe', '6000000', '2', 'Tidak Jernih ', '3 x 4', 'Didalam Kamar', 'Tidak\nLengkap', 'Lancar', 'Luas', '5.2076724', '97.0784933', 'Pak Zufri', ''),
(22, 'Kost Cek Ti', 'Laki-laki', 'Jalan Line Pipa Lorong Sumatera, Desa Padang \nSakti, Kecamatan Muara Satu, Lhokseumawe', '4500000', '2', 'Jernih', '3 x 4', 'Diluar Kamar', 'Tidak\nLengkap', 'Tidak Lancar', 'Luas', '5.2067437', '97.0793806', 'Buk Nurbaiti\n085373636820', ''),
(23, 'Kost Hijau', 'laki-laki', 'Jalan Line Pipa Lorong Sumatera, Desa Padang \nSakti, Kecamatan Muara Satu, Lhokseumawe', '4000000', '1.9', 'Jernih', '3 x 3', 'Diluar Kamar', 'Kosong', 'Lancar', 'Sedang', '5.2068319', '97.0792209', 'Buk Nursiah\n085277199900', ''),
(24, 'Kost Tengku Wan', 'Perempuan', 'Jalan Line Pipa Lorong Rahman, Desa Padang\nSakti, Kecamatan Muara Satu, Lhokseumawe', '6000000', '2.2', 'Jernih', '3 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Lancar', 'Kecil', '5.206695', '97.0804503', 'Buk Leni\n081360498246', ''),
(25, 'Kost Pak Rusdi', 'Perempuan', 'Jalan Line Pipa, Komplek Taman Sakti Permai \n(Komplek BTN), Desa Padang Sakti, \nLhokseumawe', '5500000', '2.4', 'Jernih', '3 x 3', 'Diluar Kamar', 'Tidak\nLengkap', 'Tidak Ada', 'Kecil', '5.203498', '97.0804139', 'Pak Rusdi\n081361734542', ''),
(26, 'Kost Diva', 'Perempuan', 'Jalan Pioner, Dusun Cot Suwe Desa Padang Sakti\nKecamatan Muara Satu, Lhokseumawe', '2500000', '2.2', 'Jernih', '2,5 x 2,5', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.2108698', '97.0795319', 'Buk Diva\n085277243834', ''),
(27, 'Kost Pak Talip', 'Laki-laki', 'Jalan Pioner, Dusun Cot Suwe Desa Padang Sakti\nKecamatan Muara Satu, Lhokseumawe', '2000000', '2.1', 'Jernih', '3 x 3', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Sedang', '5.2109787', '97.0794639', 'Pak Talip\n085260473337', ''),
(28, 'Kost Fahlin', 'Perempuan', 'Jalan Line Pipa Komplek BTN No. 100 Taman\nSakti Permai, Desa Padang Sakti, Lhokseumawe', '5000000', '2.5', 'Tidak Jernih ', '3 x 4', 'Diluar Kamar', 'Tidak Ada ', 'Lancar', 'Kecil', '5.2045886', '97.0810524', 'Buk Fahlin\n085296929174', ''),
(29, 'Kost Ungu', 'Perempuan', 'Jalan Line Pipa Komplek BTN Taman Sakti Permai, Lorong Tengku Cik Dipaloh, Desa Padang Sakti, Lhokseumawe', '6750000', '2.5', 'Tidak Jernih ', '4 x 4', 'Diluar Kamar', 'Tidak\nLengkap', 'Lancar', 'Sedang', '5.204587', '97.0814351', 'Buk Anita\n08116700777', ''),
(30, 'Kost Pelangi', 'Perempuan', 'Jalan Line Pipa Lorong Sumatera, Desa Padang \nSakti, Kecamatan Muara Satu, Lhokseumawe', '5000000', '1.9', 'Jernih', '3 x 4', 'Diluar Kamar', 'Kosong', 'Lancar', 'Luas', '5.2069567', '97.0789725', 'Pak Idris\n081360007430', ''),
(31, 'Kost Ceiza', 'Perempuan', 'Jalan Medan - B. Aceh, Desa Batuphat Timur,\nKecamatan Muara Satu, Lhokseumawe', '5250000', '1.8', 'Jernih', '4 x 4', 'Didalam Kamar', 'Tidak\nLengkap', 'Lancar', 'Luas', '5.216084', '97.06118', 'Ibu Kost\n085213686328', ''),
(32, 'Kost Muarif', 'Perempuan', 'Jalan Medan - B. Aceh, Desa Batuphat Timur,\nKecamatan Muara Satu, Lhokseumawe', '5500000', '1.8', 'Jernih', '3 x 3', 'Diluar Kamar', 'Tidak\nLengkap', 'Tidak Ada', 'Luas', '5.216438', '97.06108', 'Buk Yuli\n085376997188', ''),
(33, 'Kost Pak Herman', 'Perempuan', 'Jalan Medan - B. Aceh, Lorong Mulia Dusun D \nRT. 1, Desa Batuphat Timur, Kecamatan Muara Satu Lhokseumawe ', '4000000', '2.7', 'Tidak Jernih ', '3 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.2163985', '97.0566599', 'Pak Herman\n08126485153', ''),
(34, 'Kost Nurazam', 'Perempuan', 'Jalan Medan - B. Aceh, Lorong Mulia Dusun D \nRT. 1, Desa Batuphat Timur, Kecamatan Muara Satu, Lhokseumawe ', '5500000', '2.6', 'Jernih', '3 x 3', 'Didalam Kamar', 'Kosong', 'Lancar', 'Sedang', '5.2168112', '97.0559967', 'Buk Nurazam\n081263683358', ''),
(35, 'Kost Hasan', 'Laki-laki', 'Jalan Medan - B. Aceh, Lorong Masjid, Dusun C Desa Batuphat Timur, Kecamatan Muara Satu, Lhokseumawe', '5500000', '2.4', 'Jernih', '4 x 4', 'Didalam Kamar', 'Tidak Ada ', 'Tidak Ada', 'Tidak Ada', '5.2184926', '97.0574037', 'Pak Ibrahim\n0811670961', ''),
(36, 'Kost Pondok Jambu', 'Perempuan', 'Jalan Medan - B. Aceh Lorong Masjis, Dusun C, \nDesa Batuphat Timur, Kecamatan Muara Satu, Lhokseumawe', '4500000', '2.6', 'Jernih', '3 x 3', 'Diluar Kamar', 'Kosong', 'Lancar', 'Luas', '5.2186981', '97.0569558', 'Bang Harun\n082277125754', ''),
(37, 'Kost Shadz', 'Perempuan', 'Jalan Medan B. Aceh, Depan Pajak Batuphat Timur, Desa Batuphat Timur, Kecamatan Muara Satu, Lhokseumawe', '6000000', '2.6', 'Jernih', '4 x 4', 'Didalam Kamar', 'Lengkap', 'Lancar', 'Luas', '5.2182856', '97.0543897', 'Pak Dahlan\n085360355221', ''),
(38, 'Kost PTK', 'Laki-laki', 'Jalan Medan B. Aceh, Lorong Mulia dusun C, Desa Batuphat Timur, Kecamatan Muara Satu, \nLhokseumawe', '5500000', '2.6', 'Tidak Jernih ', '3 x 3', 'Diluar Kamar', 'Kosong', 'Lancar', 'Sedang', '5.216902', '97.0550396', 'Pak Amir\n081269137525', ''),
(39, 'Kost Pak \nMuhammad', 'Perempuan', 'Jalan Medan B. Aceh (Belakang Tenggo), Desa Batuphat Timur, Kecamatan Muara Satu, \nLhokseumawe', '5000000', '2.3', 'Jernih', '3 x 4', 'Didalam Kamar', 'Kosong', 'Lancar', 'Luas', '5.217235', '97.0566981', 'Pak Muhammad\n081377428882', ''),
(40, 'Kost Buk Ana', 'Perempuan', 'Jalan Medan - B. Aceh, Lorong Melati Dusun B, \nDesa Batuphat Timur, Kecamatan Muara Satu,\nLhokseumawe', '4750000', '2.9', 'Jernih', '4 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Lancar', 'Kecil', '5.2189337', '97.0540297', 'Buk Ana\n082360848834', ''),
(41, 'Kost Buk Fitiriani', 'Perempuan', 'Jalan PNKA, Desa Batuphat Timur, Kecamatan\nMuara Satu, Lhokseumawe', '4000000', '2.5', 'Jernih', '3 x 4', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Sedang', '5.217868', '97.0577186', 'Buk Fitriani\n082294110743', ''),
(42, 'Kost Buk Emi', 'Perempuan', 'Lorong Belakang Bank BSI Batuphat Timur, Desa\nBatuphat Tmur, Kecamatan Muara Satu, \nLhokseumawe', '3500000', '2.9', 'Jernih', '3 x 4', 'Diluar Kamar', 'Tidak Ada ', 'Tidak Ada', 'Kecil', '5.2193425', '97.0533684', 'Buk Emi\n082316085662', ''),
(43, 'Kost Mustofa', 'Perempuan', 'Jalan Rancong, Desa Batuphat Timur, Kecamatan\nMuara Satu, Lhokseumawe', '4000000', '3.5', 'Tidak Jernih ', '3 x 3,5', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.220896', '97.051254', 'Pak Mustofa\n08126431694', ''),
(44, 'Kost Pak Saiful', 'Laki-laki', 'Jalan PNKA, Desa Batuphat Timur, Kecamatan\nMuara Satu, Lhokseumawe', '3000000', '3', 'Tidak Jernih ', '3 x 3', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.218518', '97.0581', 'Pak Saiful\n081362896344', ''),
(45, 'Kost RM Keluarga', 'Laki-laki', 'Jalan Rancong, Desa Batuphat Timur, Kecamatan\nMuara Satu, Lhokseumawe', '3000000', '3.6', 'Tidak Jernih ', '3 x 3', 'Diluar Kamar', 'Kosong', 'Tidak Ada', 'Kecil', '5.220492', '97.051349', 'Buk Kost\n085201211100', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_simpul`
--

CREATE TABLE `tb_simpul` (
  `id_simpul` int(11) NOT NULL,
  `nama_simpul` varchar(128) NOT NULL,
  `sLatitude` varchar(128) NOT NULL,
  `sLongitude` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_simpul`
--

INSERT INTO `tb_simpul` (`id_simpul`, `nama_simpul`, `sLatitude`, `sLongitude`) VALUES
(1, 'S1', '5.205377', '97.075858'),
(2, 'S2', '5.205922', '97.075932'),
(3, 'S3', '5.205329', '97.076183'),
(4, 'S4', '5.206253', '97.077998'),
(5, 'S5', '5.206465', '97.078006'),
(6, 'S6', '5.208802', '97.078938'),
(7, 'S7', '5.209155', '97.078941'),
(8, 'S8', '5.209475', '97.078944'),
(9, 'S9', '5.210193', '97.080403'),
(10, 'S10', '5.209351', '97.078449'),
(11, 'S11', '5.208521', '97.078961'),
(12, 'S12', '5.208445', '97.077968'),
(13, 'S13', '5.209339', '97.077894'),
(14, 'S14', '5.207448', '97.078941'),
(15, 'S15', '5.207853', '97.077988'),
(16, 'S16', '5.207124', '97.078004'),
(17, 'S17', '5.206812', '97.079385'),
(18, 'S18', '5.207053', '97.079478'),
(19, 'S19', '5.206090', '97.080048'),
(20, 'S20', '5.202606', ' 97.079462'),
(21, 'S21', '5.204421', '97.081165'),
(22, 'S22', '5.210557', '97.079485'),
(23, 'S23', '5.210680', '97.080757'),
(24, 'S24', '5.210411', '97.080752'),
(25, 'S25', '5.210383', '97.077869'),
(26, 'S26', '5.209462', '97.07784'),
(27, 'S27', '5.209092', '97.080209'),
(28, 'S28', '5.208768', '97.078457'),
(29, 'S29', '5.204728', '97.081499'),
(30, 'S30', '5.204156', '97.082410'),
(31, 'S31', '5.203799', '97.082189'),
(32, 'S32', '5.204079', '97.080941'),
(33, 'S33', '5.203033', '97.081834'),
(34, 'S34', '5.203727', '97.080633'),
(35, 'S35', '5.201884', '97.077015'),
(36, 'S36', '5.206443', '97.080554'),
(37, 'S37', '5.208720', '97.079354'),
(38, 'S38', '5.211161', '97.079401'),
(39, 'S39', '5.207474', '97.071490'),
(40, 'S40', '5.207431', '97.068799'),
(41, 'S41', '5.207087', '97.066792'),
(42, 'S42', '5.206829', '97.064066'),
(43, 'S43', '5.199970', '97.063642'),
(44, 'S44', '5.208540', '97.066925'),
(45, 'S45', '5.209327', '97.072210'),
(46, 'S46', '5.209930', '97.072647'),
(47, 'S47', '5.208904', '97.074302'),
(48, 'S48', '5.209651', '97.074596'),
(49, 'S49', '5.210191', '97.072712'),
(50, 'S50', '5.210519', '97.071652'),
(51, 'S51', '5.209838', '97.071469'),
(52, 'S52', '5.209718', '97.070921'),
(53, 'S53', '5.210600', '97.071205'),
(54, 'S54', '5.209843', '97.070445'),
(55, 'S55', '5.210729', '97.070723'),
(56, 'S56', '5.210205', '97.069250'),
(57, 'S57', '5.210978', '97.069508'),
(58, 'S58', '5.208561', '97.071869'),
(59, 'S59', '5.210881', '97.070032'),
(60, 'S60', '5.210013', '97.069835'),
(61, 'S61', '5.209110', '97.070216'),
(62, 'S62', '5.209872', '97.070176'),
(63, 'S63', '5.209184', '97.069970'),
(64, 'S64', '5.207614', '97.068365'),
(65, 'S65', '5.211463', '97.067863'),
(66, 'S66', '5.212262', '97.068110'),
(67, 'S67', '5.210622', '97.068144'),
(68, 'S68', '5.211157', '97.068379'),
(69, 'S69', '5.210405', '97.066328'),
(70, 'S70', '5.211242', '97.067937'),
(71, 'S71', '5.210570', '97.066331'),
(72, 'S72', '5.211676', '97.066702'),
(73, 'S73', '5.212204', '97.065941'),
(74, 'S74', '5.212649', '97.065668'),
(75, 'S75', '5.212269', '97.066117'),
(76, 'S76', '5.213086', '97.066815'),
(77, 'S77', '5.215612', '97.062385'),
(78, 'S78', '5.215894', '97.062610'),
(79, 'S79', '5.208192', '97.068527'),
(80, 'S80', '5.208922', '97.067271'),
(81, 'S81', '5.211246', '97.065201'),
(82, 'S82', '5.210135', '97.066757'),
(83, 'S83', '5.217041', '97.058462'),
(84, 'S84', '5.215907', '97.057771'),
(85, 'S85', '5.216760', '97.055466'),
(86, 'S86', '5.217678', '97.055752'),
(87, 'S87', '5.216884', '97.055000'),
(88, 'S88', '5.217178', '97.055049'),
(89, 'S89', '5.217503', '97.054281'),
(90, 'S90', '5.218077', '97.054303'),
(91, 'S91', '5.220157', '97.050118'),
(92, 'S92', '5.221058', '97.051027'),
(93, 'S93', '5.218879', '97.051460'),
(94, 'S94', '5.220545', '97.051712'),
(95, 'S95', '5.220155', '97.052549'),
(96, 'S96', '5.218600', '97.052298'),
(97, 'S97', '5.218541', '97.052493'),
(98, 'S98', '5.220029', '97.052933'),
(99, 'S99', '5.219837', '97.053361'),
(100, 'S100', '5.218502', '97.053041'),
(101, 'S101', '5.219555', '97.054039'),
(102, 'S102', '5.218743', '97.056267'),
(103, 'S103', '5.217749', '97.056122'),
(104, 'S104', '5.217442', '97.057616'),
(105, 'S105', '5.218238', '97.057765'),
(106, 'S106', '5.217852', '97.058759'),
(107, 'S107', '5.217206', '97.058456'),
(108, 'S108', '5.218233', '97.057863'),
(109, 'S109', '5.217419', '97.056776'),
(116, 'S110', '5.205477277048472', '97.06291395628786'),
(117, 'S111', '5.204756066982631', '97.06242614855341'),
(118, 'S112', '5.20371431764987', '97.062426718765'),
(119, 'S113', '5.202448189215453', '97.06270052552595'),
(120, 'S114', '5.202111623000469', '97.06382256358773'),
(301, 'S121', '5.208255', '97.067226'),
(302, 'S122', '5.208178', '97.067111'),
(303, 'S123', '5.208125', '97.068239'),
(304, 'S124', '5.208772', '97.067645'),
(305, 'S125', '5.210873', '97.069731'),
(306, 'S126', '5.209791', '97.070377'),
(307, 'S127', '5.21016', '97.071524'),
(308, 'S128', '5.21623', '97.062096'),
(309, 'S129', '5.212951', '97.066128'),
(310, 'S130', '5.212982', '97.06653'),
(311, 'S131', '5.208915', '97.073684'),
(312, 'S132', '5.211303', '97.065426'),
(313, 'S133', '5.213978', '97.063907'),
(314, 'S134', '5.210232', '97.066775'),
(315, 'S135', '5.208532', '97.065915'),
(316, 'S136', '5.2053359', '97.0760926'),
(317, 'S137', '5.2027462', '97.0782284'),
(318, 'S138', '5.2040887', '97.0780321'),
(319, 'S139', '5.2087852', '97.0792874'),
(320, 'S140', '5.2084199', '97.0787185'),
(321, 'S141', '5.2076724', '97.0784933'),
(322, 'S142', '5.2067437', '97.0793806'),
(323, 'S143', '5.2068319', '97.0792209'),
(324, 'S144', '5.206695', '97.0804503'),
(325, 'S145', '5.203498', '97.0804139'),
(326, 'S146', '5.2108698', '97.0795319'),
(327, 'S147', '5.2109787', '97.0794639'),
(328, 'S148', '5.2045886', '97.0810524'),
(329, 'S149', '5.204587', '97.0814351'),
(330, 'S150', '5.2069567', '97.0789725'),
(331, 'S151', '5.216084', '97.06118'),
(332, 'S152', '5.216438', '97.06108'),
(333, 'S153', '5.2163985', '97.0566599'),
(334, 'S154', '5.2168112', '97.0559967'),
(335, 'S155', '5.2184926', '97.0574037'),
(336, 'S156', '5.2186981', '97.0569558'),
(337, 'S157', '5.2182856', '97.0543897'),
(338, 'S158', '5.216902', '97.0550396'),
(339, 'S159', '5.217235', '97.0566981'),
(340, 'S160', '5.2189337', '97.0540297'),
(341, 'S161', '5.217868', '97.0577186'),
(342, 'S162', '5.2193425', '97.0533684'),
(343, 'S163', '5.220896', '97.051254'),
(344, 'S164', '5.218518', '97.0581'),
(345, 'S165', '5.220492', '97.051349');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(7, 'Ayu', 'maut@mail.com', 'Desert.jpg', '$2y$10$hkON3tj4j0iBXYlZE71VL.3p/P4ErjHyS3GhHEX3.mT0Ah5eLYTEm', 1, 1, 1612069383),
(11, 'User', 'user@mail.com', 'default.jpg', '$2y$10$AXHtBfoTiOnr8kZ4R87iTu.Ttukf1xAUrn5PCsyz.eg31/0jjG3Pu', 2, 1, 1658403713);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(7, 2, 4),
(30, 1, 3),
(34, 2, 6),
(35, 1, 2),
(48, 1, 4),
(56, 1, 6),
(58, 1, 9),
(60, 1, 10),
(62, 1, 11),
(63, 2, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(5, 'Menu'),
(6, 'User'),
(7, 'Data'),
(9, 'Maut'),
(10, 'Astar'),
(11, 'Guest');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/index', 'fas fa-fw fa-tachometer-alt', 1),
(5, 6, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(6, 6, 'Edit Profile', 'user/edit_profile', 'fas fa-fw fa-user-edit', 1),
(7, 5, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(8, 5, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(9, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(11, 6, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(12, 7, 'Tampil Data', 'data/', 'fas fa-fw fa-file', 1),
(13, 7, 'Data Uji', 'data/datauji', 'fas fa-fw fa-file', 1),
(14, 7, 'Map', 'data/map', 'fas fa-fw fa-globe', 0),
(15, 9, 'Rekap Data', 'maut/', 'fas fa-fw fa-file', 1),
(16, 9, 'Pembobotan', 'maut/pembobotank', 'fas fa-fw fa-file', 1),
(17, 9, 'Bobot', 'maut/bobot', 'fas fa-fw fa-file', 1),
(18, 9, 'Perhitungan Maut', 'maut/perhitungan', 'fas fa-fw fa-file', 1),
(19, 10, 'Simpul', 'astar/simpul', 'fas fa-fw fa-file', 1),
(20, 10, 'Graph', 'astar/graph', 'fas fa-fw fa-file', 1),
(21, 10, 'Cari Rute', 'astar/rute', 'fas fa-fw fa-file', 1),
(22, 11, 'Home', 'guest/home', 'fas fa-fw fa-file', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bobot_kriteria`
--
ALTER TABLE `tb_bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot_k`);

--
-- Indexes for table `tb_graph`
--
ALTER TABLE `tb_graph`
  ADD PRIMARY KEY (`id_graph`);

--
-- Indexes for table `tb_pembobotan_kriteria`
--
ALTER TABLE `tb_pembobotan_kriteria`
  ADD PRIMARY KEY (`id_pembobotan`);

--
-- Indexes for table `tb_preferensi`
--
ALTER TABLE `tb_preferensi`
  ADD PRIMARY KEY (`id_preferensi`);

--
-- Indexes for table `tb_rekap_data_kost`
--
ALTER TABLE `tb_rekap_data_kost`
  ADD PRIMARY KEY (`id_rekap_data_kost`);

--
-- Indexes for table `tb_simpul`
--
ALTER TABLE `tb_simpul`
  ADD PRIMARY KEY (`id_simpul`);

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
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bobot_kriteria`
--
ALTER TABLE `tb_bobot_kriteria`
  MODIFY `id_bobot_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_graph`
--
ALTER TABLE `tb_graph`
  MODIFY `id_graph` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tb_pembobotan_kriteria`
--
ALTER TABLE `tb_pembobotan_kriteria`
  MODIFY `id_pembobotan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tb_preferensi`
--
ALTER TABLE `tb_preferensi`
  MODIFY `id_preferensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tb_rekap_data_kost`
--
ALTER TABLE `tb_rekap_data_kost`
  MODIFY `id_rekap_data_kost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `tb_simpul`
--
ALTER TABLE `tb_simpul`
  MODIFY `id_simpul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
