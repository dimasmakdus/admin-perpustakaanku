-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 Agu 2020 pada 17.45
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `penulis` varchar(32) NOT NULL,
  `penerbit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `kategori`, `penulis`, `penerbit`) VALUES
(1, 'Azab Kubur', 'Religi', 'Dadan', 'Erlangga'),
(2, 'Tutorial Hijab', 'Kecantikan', 'Azroi', 'Tiga Roda'),
(3, 'Cara Cepat MakeUp ala Syahrini', 'Kecantikan', 'Azroi', 'Erlangga'),
(4, 'Hachi', 'Fiksi', 'Alim Malik', 'Tiga Roda'),
(5, 'Kalimalang Terbelah 2', 'Fiksi', 'Dadan ', 'TB Simapupang'),
(6, 'Belajar Membaca ', 'Edukasi', 'Dadan', 'Tiga Roda'),
(7, 'Cara Memilih Cabai Unggulan', 'Edukasi', 'Dadan', 'Erlangga'),
(8, 'Cara Menyalakan Monitor', 'Edukasi', 'Agung', 'TOPMedia'),
(9, 'Berantem dalam Kubur', 'Fiksi', 'Alim Malik', 'Tiga Roda'),
(10, 'Cara Mudah Bermain Sulap', 'Edukasi', 'Dimas', 'TOPMedia'),
(11, 'Cara Mengupas Bawang agar Tidak Sedih', 'Edukasi', 'Agung', 'Tigas Roda'),
(12, 'Tips Mudah Melepas Kepala Barbie', 'Edukasi', 'Dadan', 'Bintang 7'),
(13, 'Kalkulusku Kalkulusmu', 'Edukasi', 'Ayub Subandi, MT', 'Tiga Roda'),
(14, 'Elektronika 13', 'Edukasi', 'John Adler M,Si', 'Erlangga'),
(15, 'Bahasa Inggris', 'Edukasi', 'Edi', 'Yudistira'),
(16, 'Batas Aurat Laki Laki', 'Religi', 'Dadan ', 'TOPMedia'),
(17, 'Batasan Aurat Perempuan', 'Religi', 'Alim Malik', 'Bintang 7'),
(18, 'Ada Apa dengan Palestina?', 'Religi', 'Agung', 'TOPMedia'),
(19, 'Semua, Sudah Ada yang Atur', 'Religi', 'Azroi', 'Erlangga'),
(20, 'Aqiqah Anak', 'Religi', 'Dimas', 'Yudistira'),
(21, 'Sasuke Pulang Kampung', 'Komik', 'Dimas', 'TOPmedia'),
(22, 'Dongeng si Kancil', 'Fiksi', 'Rahmat', 'Tiga Roda'),
(23, 'Dudung dan Maman', 'Fiksi', 'Rahmat', 'Erlangga'),
(24, 'Buaya dan Awkarin', 'Fiksi', 'Rahmat', 'Tiga Roda'),
(25, 'Dogma Monoteis', 'Fiksi', 'Dadan', 'Bintang 7'),
(26, 'Jangan Menangis Barbie', 'Fiksi', 'Alim Malik', 'Bintang 7'),
(27, 'Bolehkah Sulam Alis Dibibir?', 'Kesehatan', 'Rey Mysterio', 'Planet Bekasi'),
(29, 'Manfaat Air Putih', 'Kesehatan', 'Adityo Franciso Despacito', 'TOPMedia'),
(55, 'Naruto VS Boruto', 'Komik', 'Dadan', 'Bintang 7'),
(58, 'Bahaya Tatto', 'Kesehatan', 'Rey Mysterio', 'Planet Bekasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(99) NOT NULL,
  `nama` varchar(99) NOT NULL,
  `fakultas` varchar(99) NOT NULL,
  `jurusan` varchar(99) NOT NULL,
  `gambar` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `fakultas`, `jurusan`, `gambar`) VALUES
(2, '1425628', 'Bayu Pratama', 'Teknik & Ilmu Komputer', 'Teknik Informatika', '5f3b8981dccb7.png'),
(6, '4236541', 'Ayu Harmani', 'Ilmu Sosial & Politik', 'Akutansi', '5f3b8996daf1f.png'),
(14, '1236798', 'Dinda Amalia', 'Desain', 'Desain Komunikasi Visual', '5f3b89a891f4f.png'),
(15, '4321251', 'Hilman Fahmy', 'Hukum', 'Sastra Hukum', '5f3b89b9be306.png'),
(16, '5437895', 'Agung Setiawan', 'Ekonomi', 'Management', '5f3b89c95f983.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `nama` varchar(99) NOT NULL,
  `buku` varchar(99) NOT NULL,
  `pinjam` varchar(25) NOT NULL,
  `kembali` varchar(25) NOT NULL,
  `terlambat` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `nama`, `buku`, `pinjam`, `kembali`, `terlambat`, `status`) VALUES
(18, 'Ayu Harmani', 'Kalimalang Terbelah 2', '19-08-2020', '26-08-2020', '0 hari', 'Pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `buku` varchar(55) NOT NULL,
  `pinjam` varchar(55) NOT NULL,
  `kembali` varchar(55) NOT NULL,
  `terlambat` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `nama`, `buku`, `pinjam`, `kembali`, `terlambat`) VALUES
(16, 'Agung Setiawan', 'Kalkulusku Kalkulusmu', '28-08-2020', '26-08-2020', '-2 hari'),
(17, 'Dinda Amalia', 'Cara Mengupas Bawang agar Tidak Sedih', '19-08-2020', '26-08-2020', '0 hari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$9M8rP3ZlXgFJtRYMxRPkNO9p9MlDb3Ub2cKSMzLpZuqNoIgkJ/eU6', 'admin@gmail.com'),
(2, 'dimasmakdus', '$2y$10$GSWYNBdeIyFlke0U40obN.nGf93b4Dxa1QDzqOvkZzijYhVEOPH8K', 'makdus@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
