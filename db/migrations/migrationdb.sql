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
-- --------------------------------------------------------

--
-- Struktur dari tabel `penempatan`
--

CREATE TABLE `penempatan` (
  `id` varchar(36) NOT NULL DEFAULT (UUID()),
  `nama_barang` varchar(255) NOT NULL,
  `tahun_perolehan` int(11) NOT NULL,
  `grup` int(10) NOT NULL,
  `kategori` int(10) NOT NULL,
  `kelas` int(10) NOT NULL,
  `sub_kelas` int(10) NOT NULL,
  `nomor_urut` int(10) NOT NULL,
  `kode_aset` varchar(255) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `kode_telkom` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `penempatan` (`nama_barang`, `tahun_perolehan`, `grup`, `kategori`, `kelas`, `sub_kelas`, `nomor_urut`, `kode_aset`, `qr_code`, `kode_telkom`, `serial_number`, `foto`) VALUES
('Hub / Switch Loket 5/8 Port', 2019, 1, 2, 1, 3, 4, 'TI.2019.02.01.45.000528', 'Hub / Switch Loket 16 Port/TI.2019.02.01.45.000612', 'ASDP01-0924-051300003', 'awsdwa', 'asdp.png' );

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL DEFAULT (UUID()),
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`email`, `nama`, `password`, `jabatan`, `foto`) VALUES
('admin@asdp.id', 'setya', '$2a$12$L2Kr2uxAkWaK1qyepoGWaON.6SoETIDXhngOX9WgoXWOYJUGWW6zy', 'admin', 'default.png');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_aset` (`kode_aset`);

