-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2026 pada 06.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `jurusan`, `email`, `created_at`) VALUES
(1, '2021001', 'Budi Santoso', 'Teknik Informatika', 'budi@gmail.com', '2026-01-07 16:44:18'),
(2, '2021002', 'Siti Aminah', 'Sistem Informasi', 'siti@gmail.com', '2026-01-07 16:44:18'),
(3, '2021003', 'Andi Pratama', 'Teknik Komputer', 'andi@gmail.com', '2026-01-07 16:44:18'),
(4, '2021004', 'Rina Lestari', 'Teknik Informatika', 'rina@gmail.com', '2026-01-07 16:44:18'),
(5, '2021005', 'Dewi Anggraini', 'Sistem Informasi', 'dewi@gmail.com', '2026-01-07 16:44:18'),
(6, '2021006', 'Muflih Salda Maulana', 'Teknik Informatika', 'mmuflihsalda4@gmail.com', '2026-01-08 15:37:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `kode_mk`, `nama_mk`, `sks`) VALUES
(1, 'IF101', 'Pemrograman Web', 3),
(2, 'IF102', 'Basis Data', 3),
(3, 'IF103', 'Pemrograman Orientasi Objek', 3),
(4, 'IF104', 'Struktur Data', 3),
(5, 'IF105', 'Rekayasa Perangkat Lunak', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `matakuliah_id` int(11) DEFAULT NULL,
  `nilai` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `mahasiswa_id`, `matakuliah_id`, `nilai`) VALUES
(1, 1, 1, 'A'),
(2, 1, 2, 'B'),
(3, 1, 3, 'A'),
(4, 1, 4, 'B'),
(5, 1, 5, 'C'),
(6, 2, 1, 'B'),
(7, 2, 2, 'A'),
(8, 2, 3, 'A'),
(9, 2, 4, 'B'),
(10, 2, 5, 'A'),
(11, 3, 1, 'B'),
(12, 3, 2, 'A'),
(13, 3, 3, 'C'),
(14, 3, 4, 'B'),
(15, 3, 5, 'C'),
(16, 4, 1, 'B'),
(17, 4, 2, 'A'),
(18, 4, 3, 'C'),
(19, 4, 4, 'D'),
(20, 4, 5, 'A'),
(21, 5, 5, 'C'),
(22, 5, 4, 'A'),
(24, 5, 3, 'A'),
(25, 5, 2, 'B'),
(26, 5, 1, 'A'),
(27, 6, 5, 'A'),
(28, 6, 4, 'A'),
(29, 6, 3, '-A'),
(30, 6, 2, 'B'),
(31, 6, 1, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mahasiswa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `mahasiswa_id`) VALUES
(1, 'admin', 'admin123', 'admin', '2026-01-07 09:07:02', NULL),
(2, 'rina', 'rina123', 'user', '2026-01-07 09:07:02', 4),
(3, 'siti', 'siti123', 'user', '2026-01-07 16:45:49', 2),
(4, 'andi', 'andi123', 'user', '2026-01-07 16:45:49', 3),
(5, 'Budi', 'budi123', '', '2026-01-12 07:36:57', 1),
(6, 'Dewi anggraini', 'dewi123', '', '2026-01-12 07:57:08', 5),
(7, 'Muflih Salda Maulana', 'Muflih123', '', '2026-01-12 07:57:08', 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mk` (`kode_mk`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `matakuliah_id` (`matakuliah_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_mahasiswa` (`mahasiswa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliah` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_mahasiswa` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
