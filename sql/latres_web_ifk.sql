-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2025 pada 13.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latres_web_ifk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomer_hp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_tim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `nomer_hp`, `email`, `id_user`, `id_tim`) VALUES
(16, 'Hello Kitty', '0895111122345', 'hellokitty@gmail.com', 6, 1),
(17, 'Kuromi', '0895222288765', 'kuromi@gmail.com', 6, 1),
(18, 'Pompompurin', '0895123400456', 'bombombangkudan@gmail.com', 6, 1),
(19, 'Cinnamoroll', '0867455622889', 'cinnamorolldepan@gmail.com', 7, 2),
(20, 'My Melody', '0987333211175', 'melodysmine@gmail.com', 7, 2),
(21, 'Pochacco', '0893256788979', 'pochacco@gmail.com', 7, 2),
(22, 'Chococat', '0812234657892', 'nasichocot@gmail.com', 7, 1),
(23, 'Mimmy', '0895422724532', 'mimimimmy@gmail.com', 6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim`
--

CREATE TABLE `tim` (
  `id_tim` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gambar_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim`
--

INSERT INTO `tim` (`id_tim`, `nama`, `gambar_url`) VALUES
(1, 'Read Team', 'https://res.cloudinary.com/dazylhsxd/image/upload/v1762611954/aslab/Gemini_Generated_Image_lxeps9lxeps9lxep_vtt7hh.png'),
(2, 'Blue Team', 'https://res.cloudinary.com/dazylhsxd/image/upload/v1762611954/aslab/Gemini_Generated_Image_s1lbbzs1lbbzs1lb_h6y6ny.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `created_at`) VALUES
(6, 'Mochi Mellow', '$2y$10$4GOl2Rq5UgsRTvKVeNUQvuZ2cfNcn32unZk6M0pUiTZw8UI5TD3cu', '2025-11-15 19:32:13'),
(7, 'Poppy Pudding', '$2y$10$flsTy60ln9x9NIRrZ0sT9.BzasNx1Y8mzQUpJMBP08IbMVn21W6xu', '2025-11-15 19:38:27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `user_fk` (`id_user`),
  ADD KEY `tim_fk` (`id_tim`);

--
-- Indeks untuk tabel `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id_tim`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tim`
--
ALTER TABLE `tim`
  MODIFY `id_tim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `tim_fk` FOREIGN KEY (`id_tim`) REFERENCES `tim` (`id_tim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
