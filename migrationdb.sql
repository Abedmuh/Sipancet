-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2024 pada 05.50
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asdp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `nomor` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` text NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`nomor`, `nama`, `email`, `foto`) VALUES
(1, 'Saya Admin', 'admin@indonesiaferry.co.id', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `email` varchar(100) NOT NULL,
  `departemen` enum('Perencanaan TI','Operasional TI','Pengembangan TI','Pelayanan TI') NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `foto` text NOT NULL DEFAULT 'default.png',
  `lokasi_kerja` varchar(255) DEFAULT '-- belum terdata --',
  `alamat` text DEFAULT '-- belum terdata --'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama_karyawan`, `jenis_kelamin`, `email`, `departemen`, `tanggal_bergabung`, `foto`, `lokasi_kerja`, `alamat`) VALUES
(1, '012092740', 'Iwan Erpan', 'Laki-Laki', 'iwan.erpan@indonesiaferry.co.id', 'Pelayanan TI', '2009-01-05', 'face1.jpg', '', '-- belum terdata --'),
(2, '082134536', 'Dennish Candra', 'Laki-Laki', 'dennis.kusuma@indonesiaferry.co.id', 'Pengembangan TI', '2013-08-26', 'face21.jpg', 'HO', '-- belum terdata --'),
(4, '82134534', 'Agus Lutfiyanto', 'Laki-Laki', 'lutfi.agus@indonesiaferry.co.id', 'Operasional TI', '2013-08-26', 'face8.jpg', '-- belum terdata --', '-- belum terdata --'),
(5, 'KKP_852', 'Muhammad Sholeh', 'Laki-Laki', 'muhammad.sholeh@indonesiaferry.co.id', 'Operasional TI', '2024-07-18', 'sholeh.jpg', '', 'cuki'),
(8, 'KKP_857', 'Adriansyah Prasetya', 'Laki-Laki', 'adriansyahprasetyanugraha1@gmail.com', 'Operasional TI', '2024-08-07', 'default.png', 'HO', '-- belum terdata --'),
(9, 'KKP_847', 'Iqbal', 'Laki-Laki', 'iqbal@asdp.id', 'Pengembangan TI', '2024-07-17', 'pas photo.jpg', 'HO', 'kos sebelah'),
(10, 'KKP_111', 'Abdillah', 'Laki-Laki', 'abdillah@gmail.com', 'Perencanaan TI', '2001-01-01', 'pas photo.jpg', '', '-- belum terdata --');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`email`, `password`, `role`) VALUES
('admin@indonesiaferry.co.id', '$2a$12$L2Kr2uxAkWaK1qyepoGWaON.6SoETIDXhngOX9WgoXWOYJUGWW6zy', 'admin'),
('lutfi.agus@indonesiaferry.co.id', '$2a$12$L2Kr2uxAkWaK1qyepoGWaON.6SoETIDXhngOX9WgoXWOYJUGWW6zy', 'karyawan'),
('dennis.kusuma@indonesiaferry.co.id', '$2a$12$L2Kr2uxAkWaK1qyepoGWaON.6SoETIDXhngOX9WgoXWOYJUGWW6zy', 'karyawan'),
('muhammad.sholeh@indonesiaferry.co.id', '$2a$12$L2Kr2uxAkWaK1qyepoGWaON.6SoETIDXhngOX9WgoXWOYJUGWW6zy', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nomor`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `nomor` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
