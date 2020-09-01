-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2020 pada 18.06
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universitas_pamulang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`) VALUES
(6, 'admin2', 'admin2@gmail.com', '$2y$10$wkkR34LgCXGfb5VJBi/zDevjmCXHkVVTDS0MMfQqk8j.AFZ1o20Xe'),
(7, 'admin1', 'admin1@gmail.com', '$2y$10$vlh7alGrF5juIqXKmUrZweoX02g2DjZIESgrh0EyEi0sUy5FoSPDK'),
(8, 'admin', 'admin@gmail.com', '$2y$10$iMATQeLmoxq7cxRpZgY4IulS8Kw4MV2DLDVFS85y0fzzirjVugApu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mahasiswa`
--

CREATE TABLE `data_mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` char(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_mahasiswa`
--

INSERT INTO `data_mahasiswa` (`id`, `nama`, `nim`, `alamat`, `jurusan`, `email`, `no_hp`, `photo`) VALUES
(16, 'Yogie Setiawan', '191011400343', 'jl sana sini no.89', 'Teknik Informatika', 'yogisetiawan@gmail.com', '0020020020020', '5f3c96ee01637.jpg'),
(17, 'Nurul ainizatun hasanah', '191011400232', 'Jl pegangsaan timur', 'Teknik Industri', 'nurul@gmail.com', '08123124123124', '5f3c9ea61f16d.jpg'),
(18, 'Rudi bowo', '191011400245', 'Jl jonggol selatan no.23', 'Teknik Industri', 'rudibowo@gmail.com', '08124124124124', '5f3c9f03c67e2.jpg'),
(19, 'Fransisca rinjani', '191011400344', 'Jl timur barat no.83', 'Teknik Industri', 'fransiscarinjani@gmail.com', '0812412412434', '5f3c9f4858c90.png'),
(20, 'Singingkwan noq', '191011400245', 'Jl nusantara raya no.56', 'Manajemen', 'singingkwannoq@gmail.com', '089242123124124', '5f3c9fc841e65.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
