-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2025 pada 14.25
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banuatekno`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat_customer` text NOT NULL,
  `nohp_customer` varchar(20) NOT NULL,
  `email_customer` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `nama_customer`, `alamat_customer`, `nohp_customer`, `email_customer`, `keterangan`) VALUES
(1, 'Tomy Chandra', 'Jl. Brigjend Hasan Basri, Kayutangi 1', '083866031895', '-', 'Beli Sparepart'),
(2, 'Andrianto', 'Jl. Ray 17, Rt.07, Beringin, Kec.Alalak, Kab.Barito Kuala', '083866031895', 'cemot56@gmail.com', 'Service'),
(3, 'Arliyanto', 'Jl. H. M. Yunus, Sungai Rasau Rt. 03, Kec. Cerbon, Kab. Barito Kuala', '082158032790', 'exxzoss@gmail.com', 'Service'),
(4, 'Arhamni', 'Jl.Perdagangan', '085869407314', '-', 'Beli Sparepart');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_penjualan`
--

CREATE TABLE `tbl_detail_penjualan` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_penjualan`
--

INSERT INTO `tbl_detail_penjualan` (`id_detail_transaksi`, `id_penjualan`, `id_sparepart`, `qty`, `harga`, `tanggal`) VALUES
(1, 1, 9, 2, 15000, '2025-06-22');

--
-- Trigger `tbl_detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `DELETE PENJUALAN` BEFORE DELETE ON `tbl_detail_penjualan` FOR EACH ROW BEGIN
  UPDATE tbl_sparepart
  SET stok = stok + OLD.qty
  WHERE id_sparepart = OLD.id_sparepart;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT PENJUALAN` BEFORE INSERT ON `tbl_detail_penjualan` FOR EACH ROW BEGIN
  UPDATE tbl_sparepart
  SET stok = stok - NEW.qty
  WHERE id_sparepart = NEW.id_sparepart;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_transaksi`
--

CREATE TABLE `tbl_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_transaksi`
--

INSERT INTO `tbl_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_jasa`, `qty`, `harga`, `tanggal`) VALUES
(8, 14, 1, 1, 40000, '2025-06-22'),
(9, 15, 9, 1, 20000, '2025-06-22'),
(10, 15, 8, 1, 20000, '2025-06-22'),
(11, 16, 11, 1, 80000, '2025-06-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(31, 1, 10),
(32, 1, 11),
(33, 1, 12),
(34, 1, 13),
(35, 1, 14),
(36, 1, 15),
(37, 1, 16),
(38, 1, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jasa`
--

CREATE TABLE `tbl_jasa` (
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jasa`
--

INSERT INTO `tbl_jasa` (`id_jasa`, `nama_jasa`, `harga_jasa`, `keterangan`) VALUES
(1, 'Ganti LCD', 40000, 'Bisa Ditunggu'),
(2, 'Bersih LCD', 20000, 'Bisa Ditunggu'),
(3, 'Ganti Port Headset', 30000, 'Bisa Ditunggu'),
(4, 'Kena Air/ Water Damage', 100000, '1-2 Hari Kerja'),
(5, 'Mati Total/Bootloop', 80000, '1-2 Hari Kerja'),
(6, 'Reset Ulang HP', 50000, 'Bisa Ditunggu'),
(7, 'Reset Ulang Pola/Pin/Akun', 30000, 'Bisa Ditunggu'),
(8, 'Ganti Port Charge', 20000, 'Bisa Ditunggu'),
(9, 'Ganti Tombol Power', 20000, 'Bisa Ditunggu'),
(10, 'Ganti Port Headset', 20000, 'Bisa Ditunggu'),
(11, 'Ganti IC Power', 80000, '1-2 Hari Kerja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'data customer', 'tbl_customer', 'fa fa-address-book', 0, 'y'),
(11, 'data teknisi', 'tbl_teknisi', 'fa fa-user-circle', 0, 'y'),
(12, 'data sparepart', 'tbl_sparepart', 'fa fa-cogs', 0, 'y'),
(13, 'pembelian sparepart', 'tbl_pembelian', 'fa fa-shopping-cart', 0, 'y'),
(14, 'DATA HARGA JASA', 'tbl_jasa', 'fa fa-wrench', 0, 'y'),
(15, 'BOOKING JASA SERVICE', 'tbl_transaksi', 'fa fa-exchange', 0, 'y'),
(16, 'TRANSAKSI JASA SERVICE', 'tbl_transaksi/transaksi', 'fa fa-exchange', 0, 'y'),
(17, 'PENJUALAN SPAREPART', 'tbl_penjualan', 'fa fa-exchange', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `tanggal_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id_pembelian`, `id_sparepart`, `harga`, `jumlah`, `supplier`, `tanggal_pembelian`) VALUES
(1, 1, 100000, 4, 'Leo Accesories & Sparepart', '2025-04-22'),
(2, 10, 130000, 4, 'Leo Accesories & Sparepart', '2025-04-22'),
(3, 9, 12500, 14, 'Leo Accesories & Sparepart', '2025-04-24'),
(4, 8, 140500, 3, 'Leo Accesories & Sparepart', '2025-04-24'),
(5, 7, 24800, 4, 'Leo Accesories & Sparepart', '2025-04-24'),
(6, 6, 13400, 4, 'Leo Accesories & Sparepart', '2025-04-24'),
(7, 5, 22500, 5, 'Bintang Raya SParepart HP', '2025-05-07'),
(8, 4, 140800, 3, 'Bintang Raya SParepart HP', '2025-05-07'),
(9, 3, 180000, 3, 'Bintang Raya SParepart HP', '2025-05-07');

--
-- Trigger `tbl_pembelian`
--
DELIMITER $$
CREATE TRIGGER `DELETE PEMBELIAN` BEFORE DELETE ON `tbl_pembelian` FOR EACH ROW BEGIN
  UPDATE tbl_sparepart
  SET stok = stok - OLD.jumlah
  WHERE id_sparepart = OLD.id_sparepart;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT PEMBELIAN` BEFORE INSERT ON `tbl_pembelian` FOR EACH ROW BEGIN
  UPDATE tbl_sparepart
  SET stok = stok + NEW.jumlah
  WHERE id_sparepart = NEW.id_sparepart;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UPDATE PEMBELIAN` BEFORE UPDATE ON `tbl_pembelian` FOR EACH ROW BEGIN
  -- Kembalikan stok lama
  UPDATE tbl_sparepart
  SET stok = stok - OLD.jumlah
  WHERE id_sparepart = OLD.id_sparepart;

  -- Kurangi stok baru
  UPDATE tbl_sparepart
  SET stok = stok + NEW.jumlah
  WHERE id_sparepart = NEW.id_sparepart;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `id_customer` int(11) NOT NULL,
  `jenis_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `tanggal_penjualan`, `id_customer`, `jenis_pembayaran`) VALUES
(1, '2025-06-22', 4, 'QRIS/Transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sparepart`
--

CREATE TABLE `tbl_sparepart` (
  `id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(150) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `keterangan` text NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sparepart`
--

INSERT INTO `tbl_sparepart` (`id_sparepart`, `nama_sparepart`, `stok`, `keterangan`, `harga_jual`) VALUES
(2, 'Baterai Redmi Note 10 Viking', 9, 'Baru', 210000),
(3, 'LCD Samsung J3', 3, 'Baru', 100000),
(4, 'IC Power Tecno Pova 5', 3, 'Baru', 150000),
(5, 'Speaker Xiaomi Redmi Note 10', 5, 'Baru', 25000),
(6, 'Port Charger Oppo A16', 4, 'Baru', 15000),
(7, 'Port Charger Infinix Note 30 Pro', 4, 'Baru', 15000),
(8, 'LCD POCO C65', 3, 'Baru', 150000),
(9, 'Lem LCD 15ml', 12, 'Baru', 15000),
(10, 'LCD Poco X3 GT', 4, 'Baru', 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_teknisi`
--

CREATE TABLE `tbl_teknisi` (
  `id_teknisi` int(11) NOT NULL,
  `nama_teknisi` varchar(100) NOT NULL,
  `alamat_teknisi` text NOT NULL,
  `nohp_teknisi` varchar(20) NOT NULL,
  `email_teknisi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_teknisi`
--

INSERT INTO `tbl_teknisi` (`id_teknisi`, `nama_teknisi`, `alamat_teknisi`, `nohp_teknisi`, `email_teknisi`, `keterangan`) VALUES
(1, 'Dimas Agung Faisal', 'Jl.Trans Kalimantan, Komplek Graha Bhakti Mulia B RT.13, Sungai Lumbah, Alalak, Barito Kuala, Kalimantam Selatan, Indonesia', '085231630684', 'dimas.agungtkr@gmail.com', 'Teknisi'),
(2, 'Akhmad  Rahul Firdaus', 'Jl.Trans Kalimantan, Komplek Graha Bhakti Mulia B RT.13, Sungai Lumbah, Alalak, Barito Kuala, Kalimantam Selatan, Indonesia', '0895384327586', 'rahulfirdaus21@gmail.com', '-'),
(3, 'Arbi Ramdhani', 'Jl.Perintis Kemerdekaan, Gedung 9A, Ps. Lama, Kec. Banjarmasin Tengah, Kab. Banjarmasin', '082269452050', 'arbiramdhani778@gmail.com', 'Teknisi'),
(4, 'Zulkifli', 'Jl. Trans Kalimatan, Komplek Persada Raya1, Blok. A No. 57, Handil Bakti, Kec. Alalak, Kab. Barito Kuala', '085245142078', 'zulzul646@gmail.com', 'Teknisi'),
(5, 'Nor Ikram', 'Jl. Perdagangan 2, No.22, Pangeran, Kec. Banjarmasin Utara, Kab. Banjarmasin', '082253530153', 'norikram2365@gmail.com', 'Teknisi/Sekertaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jenis_pembayaran` varchar(20) DEFAULT NULL,
  `tipe_hp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tanggal_transaksi`, `id_customer`, `id_teknisi`, `status`, `tanggal_selesai`, `jenis_pembayaran`, `tipe_hp`) VALUES
(14, '2025-05-12', 4, 3, 1, '2025-05-13', NULL, 'Poco C65'),
(15, '2025-05-14', 3, 2, 2, '2025-05-15', 'QRIS/Transfer', 'Tecno'),
(16, '2025-05-22', 3, 4, 1, '2025-05-23', NULL, 'Tecno');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'Dimas', 'admin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jasa`
--
ALTER TABLE `tbl_jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_sparepart`
--
ALTER TABLE `tbl_sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indeks untuk tabel `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_jasa`
--
ALTER TABLE `tbl_jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_sparepart`
--
ALTER TABLE `tbl_sparepart`
  MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
