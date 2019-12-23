-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2019 at 04:29 AM
-- Server version: 10.2.3-MariaDB-log
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blakasutha`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('administrator','kasir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `fullname`, `password`, `role`) VALUES
(1, 'admin', 'Admin BLAKA', '0192023a7bbd73250516f069df18b500', 'administrator'),
(2, 'kasir', 'Kasir Blaka', 'de28f8f7998f23ab4194b51a6029416f', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga_1` float DEFAULT NULL,
  `harga_2` float DEFAULT NULL,
  `harga_3` float DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `stok`, `harga_1`, `harga_2`, `harga_3`, `updated_at`) VALUES
(18, 'POLOSL', 'Kaos Putih Polos (L)', 4, 75000, 73000, 70000, '2019-12-11'),
(19, 'POLOSXL', 'Kaos Putih Polos (XL)', 82, 75000, 73000, 70000, '2019-12-11'),
(20, 'POLOSPJGL', 'Kaos Putih Polos Panjang (XL)', 64, 80000, 78000, 76000, '2019-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `barang_pesanan`
--

CREATE TABLE `barang_pesanan` (
  `id_barang` int(11) NOT NULL,
  `nama_pesanan` varchar(255) DEFAULT NULL,
  `ukuran` varchar(255) NOT NULL,
  `harga_1` float DEFAULT NULL,
  `harga_2` float DEFAULT NULL,
  `harga_3` float DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `barang_pesanan`
--

INSERT INTO `barang_pesanan` (`id_barang`, `nama_pesanan`, `ukuran`, `harga_1`, `harga_2`, `harga_3`, `updated_at`) VALUES
(1, 'Panjang S', 'S', 75000, 70000, 68000, '2019-11-30'),
(2, 'Panjang M', 'M', 75000, 70000, 68000, '2019-11-30'),
(3, 'Panjang L', 'L', 75000, 70000, 68000, '2019-11-30'),
(4, 'Panjang XL', 'XL', 75000, 70000, 68000, '2019-11-30'),
(5, 'Panjang XXL', 'XXL', 75000, 70000, 68000, '2019-11-30'),
(6, 'Panjang XXXL', 'XXXL', 75000, 70000, 68000, '2019-11-30'),
(7, 'Pendek S', 'S', 75000, 70000, 68000, '2019-11-30'),
(8, 'Pendek M', 'M', 75000, 70000, 68000, '2019-11-30'),
(9, 'Pendek L', 'L', 75000, 70000, 68000, '2019-11-30'),
(10, 'Pendek XL', 'XL', 75000, 70000, 68000, '2019-11-30'),
(11, 'Pendek XXL', 'XXL', 75000, 70000, 68000, '2019-11-30'),
(12, 'Pendek XXXL', 'XXXL', 75000, 70000, 68000, '2019-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `role` enum('customer','reseller') DEFAULT 'customer',
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_lengkap`, `phone`, `instagram`, `role`, `created_at`) VALUES
(9, 'Irwan Antonio', '082243440959', '@hjkwz', 'reseller', '2019-12-13'),
(12, 'Blakasutha', '085727298470', '@blakablaka', 'customer', '2019-12-13'),
(13, 'Jaka', '0912341521', '@jaka123', 'customer', '2019-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `pelunasan`
--

CREATE TABLE `pelunasan` (
  `id_pelunasan` int(11) NOT NULL,
  `trx_code` varchar(80) NOT NULL,
  `dp` float DEFAULT NULL,
  `pelunasan` float DEFAULT NULL,
  `tgl_pelunasan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `trx_code` varchar(80) DEFAULT NULL,
  `subharga` float DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_order` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_customer`, `id_barang`, `trx_code`, `subharga`, `jumlah`, `tanggal_order`) VALUES
(4, 9, 10, 'fC6Lv9kcjx', 75000, 12, '2019-12-21 12:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `kebutuhan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_pengeluaran` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `trx_code` varchar(255) NOT NULL,
  `subharga` float NOT NULL,
  `jumlah` float NOT NULL,
  `tgl_penjualan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_customer`, `id_barang`, `trx_code`, `subharga`, `jumlah`, `tgl_penjualan`) VALUES
(1, 12, 20, 'TG0TXMMAcn', 72400, 6, '2019-12-19 12:46:04'),
(2, 12, 19, 'TG0TXMMAcn', 68000, 10, '2019-12-19 12:46:04'),
(3, 9, 18, 'CaVuFHd3oj', 68000, 10, '2019-12-19 12:46:43'),
(4, 9, 19, 'CaVuFHd3oj', 68000, 5, '2019-12-19 12:46:44'),
(5, 12, 20, 'qbtOpBI8XC', 80000, 1, '2019-12-21 12:17:47'),
(6, 12, 18, 'UxIn41og2u', 75000, 5, '2019-12-21 12:33:35'),
(7, 12, 20, 'UxIn41og2u', 80000, 2, '2019-12-21 12:33:36'),
(8, 9, 18, '7pibiL4sYx', 68000, 1, '2019-12-21 17:21:14'),
(9, 9, 19, '7pibiL4sYx', 68000, 2, '2019-12-21 17:21:14'),
(10, 13, 20, 'ZYeyfTmptQ', 80000, 1, '2019-11-22 09:36:23'),
(11, 12, 20, 'Nwv8NNr7DG', 80000, 1, '2019-10-23 09:48:11'),
(12, 12, 19, 'Nwv8NNr7DG', 75000, 6, '2019-10-23 09:48:12'),
(13, 13, 20, 'kpB8BKNnYI', 80000, 1, '2019-12-23 10:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_bisnis` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `ucapan` text DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_bisnis`, `alamat`, `phone`, `email`, `instagram`, `ucapan`, `update_at`) VALUES
(1, 'BLAKA', 'Depan SMP 3 Pbg Lawas, Jln. Patung Knalpot', '082243440959', 'blaka@gmail.com', '@blakasuhta', 'Terimakasih', '2019-12-06 14:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trx` int(11) NOT NULL,
  `trx_code` varchar(255) NOT NULL,
  `total_harga` float NOT NULL,
  `jumlah_bayar` float NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_trx`, `trx_code`, `total_harga`, `jumlah_bayar`, `tgl_transaksi`) VALUES
(4, 'UxIn41og2u', 535000, 540000, '2019-12-21 12:33:35'),
(5, '7pibiL4sYx', 202500, 202500, '2019-12-21 17:21:14'),
(6, 'ZYeyfTmptQ', 80000, 80000, '2019-11-22 09:36:22'),
(7, 'Nwv8NNr7DG', 530000, 530000, '2019-10-23 09:48:10'),
(8, 'kpB8BKNnYI', 80000, 80000, '2019-12-23 10:02:58'),
(9, 'kpB8BKNnYI', 80000, 80000, '2019-12-23 10:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pemesanan`
--

CREATE TABLE `transaksi_pemesanan` (
  `id_tp` int(11) NOT NULL,
  `trx_code` varchar(80) DEFAULT NULL,
  `jenis_pemesanan` enum('jaket','jersey','kaos','hoodie','kemeja','topi') DEFAULT NULL,
  `model_baju` varchar(50) DEFAULT NULL,
  `jenis_sablon` varchar(80) DEFAULT NULL,
  `file_desain` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `jumlah_bayar` float DEFAULT NULL,
  `kurang` enum('true','false') DEFAULT NULL,
  `status` enum('diproses','selesai','lunas') DEFAULT 'diproses',
  `perkiraan_selesai` date DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pemesanan`
--

INSERT INTO `transaksi_pemesanan` (`id_tp`, `trx_code`, `jenis_pemesanan`, `model_baju`, `jenis_sablon`, `file_desain`, `deskripsi`, `jumlah_pesanan`, `total_harga`, `jumlah_bayar`, `kurang`, `status`, `perkiraan_selesai`, `tgl_transaksi`) VALUES
(8, 'fC6Lv9kcjx', 'kaos', 'kerah', 'plastisol', '../image/fC6Lv9kcjx.jpg', 'Miring Food, belakang kaos', 12, 780000, 400000, 'true', 'selesai', '2020-01-04', '2019-12-21 12:34:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD PRIMARY KEY (`id_pelunasan`),
  ADD KEY `FK__transaksi_pemesanan` (`trx_code`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `FK__customer` (`id_customer`),
  ADD KEY `Index 3` (`id_barang`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `FK_penjualan_customer` (`id_customer`),
  ADD KEY `FK_penjualan_barang` (`id_barang`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `transaksi_pemesanan`
--
ALTER TABLE `transaksi_pemesanan`
  ADD PRIMARY KEY (`id_tp`),
  ADD UNIQUE KEY `Index 2` (`trx_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_pelunasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi_pemesanan`
--
ALTER TABLE `transaksi_pemesanan`
  MODIFY `id_tp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD CONSTRAINT `FK__transaksi_pemesanan` FOREIGN KEY (`trx_code`) REFERENCES `transaksi_pemesanan` (`trx_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `FK_pemesanan_barang_pesanan` FOREIGN KEY (`id_barang`) REFERENCES `barang_pesanan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `FK_penjualan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_penjualan_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
