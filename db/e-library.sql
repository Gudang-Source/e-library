-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Sep 2020 pada 02.10
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-library`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` varchar(5) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `genre`, `penerbit`, `tahun_terbit`, `status`) VALUES
(3, 'Harry Potter and the Prisoner of Azkaban', 'J. K. Rowling', 'Novel, Fantasy', 'Bloomsbury', '1999', 1),
(4, 'Sang Pemimpi', 'Andrea Hirata', 'Novel, Fiction', 'Bentang Pustaka', '2006', 1),
(5, 'Tenggelamnya Kapal van der Wijck', 'Hamka', 'Novel, Fiction', 'Nusantara', '1938', 1),
(6, 'The Rainbow Troops', 'Andrea Hirata', 'Novel', 'Bentang Pustaka', '2005', 0),
(7, 'This Earth of Mankind', 'Pramoedya Ananta', 'Novel, Fiction', 'Hastra Mitra', '1980', 1),
(8, 'Man Tiger: A Novel', 'Eka Kurniawan', 'Novel, Thriller', 'Verso', '2004', 1),
(9, 'Lord of the Rings', 'J. R. R. Tolkien', 'Novel, Fantasy', 'Allen & Unwin', '1954', 1),
(10, 'Ayat-ayat cinta', 'Habiburrahman El Shirazy', 'Novel, Fiction', 'Republika', '2004', 1),
(11, 'Di Bawah Lindungan Ka\'bah', 'Hamka', 'Novel, Fiction', 'Nusantara', '1938', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mhs` int(11) NOT NULL,
  `npm` char(12) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `npm`, `nama_lengkap`, `alamat`, `no_hp`, `id_user`) VALUES
(3, '6706184055', 'Muhamad Azmi Rizkifar', 'Citalang Indah', '085811974425', 10),
(4, '6706174383', 'Farhan Reninda', 'Perum Griya Asri', '098933875584', 11),
(5, '', '', '', '', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `id_buku`, `id_mhs`, `tanggal_peminjaman`) VALUES
(2, 6, 4, '2020-06-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `username`, `password`, `level`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$07Y8QtgXRdFpnrjVx9OXzu7Xm9UWo/IPr33gBfDbwLQZC3VIgpz6.', 'admin'),
(10, 'azmirizkifar.edu@gmail.com', 'azmirf', '$2y$10$fKRx1GCbEdc4gX2emvcLUeqzE2qGWyuXVKW6yFOB0SOmPzOfLC3A2', 'user'),
(11, 'farhan@gmail.com', 'farhan', '$2y$10$9wtCfecGIwsbNhIpFqFI3uCX0z8n17XN.1W.XwyvjITG3lNMOad4m', 'user'),
(12, 'm.azmirizkifar20@gmail.com', 'azmirf20', '$2y$10$0fCV3g7BqMb.NqDlncPJPuKBCOuL8lwfOosCYkGexXtfpxmtoinzq', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `fk_id_buku` (`id_buku`),
  ADD KEY `fk_id_mhs_pinjam` (`id_mhs`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `fk_id_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_mhs_pinjam` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
