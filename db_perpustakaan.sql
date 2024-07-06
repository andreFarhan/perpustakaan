-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2024 pada 07.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat_anggota` varchar(255) DEFAULT NULL,
  `telp_anggota` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `username`, `password`, `nama_anggota`, `jenis_kelamin`, `alamat_anggota`, `telp_anggota`, `email`) VALUES
(1, 'anggota', '$2y$10$/IjskMpIfBW7YrirUBH/AeeFnjzzpGtP4tVkjI8xiatO8y2PuCSVS', 'anggota pertama', 'Laki-laki', 'Jl. Anggota no. 1, Bogor', '082132132111', 'anggota1@example.com'),
(2, 'naya', '$2y$10$ggWUAa40dngfvXK4ke6gq.NGOLaxDowP0s42VnumSjvmxZaofGB4q', 'Naya', 'Perempuan', 'Jl. Jeruk No. 22, Jakarta', '082382138320', 'naya@example.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `stok`) VALUES
(1, 'Belajar SQL Dasar', 'Joko', 'Gramedia', '2021', 'Teknologi', 11),
(2, 'Pemrograman Python', 'Susi Susanti', 'Informatika', '2020', 'Teknologi', 8),
(3, 'Bicara itu ada seni nya', 'Oh Su Hyang', 'Bhuana Ilmu Populer', '2018', 'Komunikasi', 5),
(4, 'The 48 Laws of Power', 'Robert Greene', 'Viking Press', '1998', 'Hukum', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT NULL,
  `denda` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_anggota`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`, `denda`) VALUES
(2, 1, 4, '2024-06-09', '2024-06-12', 'dipinjam', '0'),
(6, 2, 2, '2024-06-10', '2024-06-13', 'dipinjam', '0'),
(17, 2, 3, '2024-06-10', '2024-06-13', 'dipinjam', ''),
(18, 2, 3, '2024-06-10', '2024-06-13', 'dipinjam', ''),
(20, 2, 4, '2024-06-10', '2024-06-13', 'dikembalikan', '0'),
(21, 2, 3, '2024-06-10', '2024-06-13', 'dikembalikan', '0');

--
-- Trigger `tb_transaksi`
--
DELIMITER $$
CREATE TRIGGER `hitung_denda` BEFORE UPDATE ON `tb_transaksi` FOR EACH ROW BEGIN
    DECLARE jumlah_hari_telat INT;
    
    IF NEW.tanggal_pengembalian IS NOT NULL THEN
        SET jumlah_hari_telat = DATEDIFF(NEW.tanggal_pengembalian, NEW.tanggal_peminjaman) - 3;
        IF jumlah_hari_telat > 0 THEN
            SET NEW.denda = jumlah_hari_telat * 5000; -- Misalnya denda Rp 5000 per hari
        ELSE
            SET NEW.denda = 0;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat_user` varchar(255) DEFAULT NULL,
  `telp_user` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_user`, `jenis_kelamin`, `alamat_user`, `telp_user`, `email`) VALUES
(1, 'budi', '$2y$10$Giz76qqNj9P.X.L60qGqVe0HXKlcd8iZXW2KTpCHignGs9C5wWDsm', 'Budi Santoso', 'Laki-laki', 'Jl. Melati No. 10, Jakarta', '081234567890', 'budi@example.com'),
(3, 'yunita', '$2y$10$JCdpx0rPUBAJmyCEtUwJbOPQpNoxOvoNCcZosNOJfsbsIUxvIPa..', 'Yunita', 'Perempuan', 'Jl. Tulip no. 2, Bogor', '089646608598', 'yunita@example.com'),
(4, 'irgi', '$2y$10$HeoKjOgjKvlJDWwcdhwByecxd6SgNh4g5pPji7sNsd2z42EF9Es6O', 'Irgi Alghitraf', 'Laki-laki', 'Jl. Kamboja No. 4', '089652456953', 'irgial@example.com'),
(5, 'ina', '$2y$10$Uq62yTJsUs.8q3tFXSo0w.DNzsFxQVRIJRPdXAVaTNRPZnIAL3Jaq', 'Ina Yustriana Sari', 'Perempuan', 'Jl. Anggrek no. 3', '082138128123', 'ina@example.com'),
(6, 'andre', '$2y$10$0ZbQkkZoUhwyl3XwgcjEkOPlY2yWScFUgj9j3w/FlyZtkA6hv2cIG', 'Andre Farhan Saputra', 'Laki-laki', 'Jl. Matahari No. 19, Bekasi', '087733932416', 'andre@example.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_4` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_5` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
