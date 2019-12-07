-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2019 at 07:58 AM
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
(2, 'kasir', NULL, NULL, 'kasir');

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
(11, 'PLSPTH1', 'Kaos Polos Putih (XL)', 64, 75000, 70000, 68000, '2019-11-30'),
(12, 'YP', 'Topi', 73, 30000, 26000, 25000, '2019-12-06'),
(13, 'asd', '1212', 12, 1213, 12123, 1231, '2019-12-07'),
(14, 'asdaf', '1134adxfa', 12313, 21313, 12313, 1231310, '2019-12-07'),
(15, 'asdafasda', '1134adxfa', 12313, 21313, 12313, 1231310, '2019-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `barang_pesanan`
--

CREATE TABLE `barang_pesanan` (
  `id_barang` int(11) NOT NULL,
  `nama_pesanan` varchar(255) DEFAULT NULL,
  `harga_1` float DEFAULT NULL,
  `harga_2` float DEFAULT NULL,
  `harga_3` float DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `barang_pesanan`
--

INSERT INTO `barang_pesanan` (`id_barang`, `nama_pesanan`, `harga_1`, `harga_2`, `harga_3`, `updated_at`) VALUES
(1, 'Panjang S', 75000, 70000, 68000, '2019-11-30'),
(2, 'Panjang M', 75000, 70000, 68000, '2019-11-30'),
(3, 'Panjang L', 75000, 70000, 68000, '2019-11-30'),
(4, 'Panjang XL', 75000, 70000, 68000, '2019-11-30'),
(5, 'Panjang XXL', 75000, 70000, 68000, '2019-11-30'),
(6, 'Panjang XXXL', 75000, 70000, 68000, '2019-11-30'),
(7, 'Pendek S', 75000, 70000, 68000, '2019-11-30'),
(8, 'Pendek M', 75000, 70000, 68000, '2019-11-30'),
(9, 'Pendek L', 75000, 70000, 68000, '2019-11-30'),
(10, 'Pendek XL', 75000, 70000, 68000, '2019-11-30'),
(11, 'Pendek XXL', 75000, 70000, 68000, '2019-11-30'),
(12, 'Pendek XXXL', 75000, 70000, 68000, '2019-11-30');

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
(1, 'Blaka', NULL, NULL, 'customer', '2019-11-24'),
(5, 'asda', '12313', '@123', 'customer', '2019-12-05'),
(6, 'Irwan Antonio', '082243440959', '@hjkwz', 'reseller', '2019-12-06'),
(8, 'erwin', '085747036745', '@djancok901', 'customer', '2019-12-06');

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
  `sablon_depan` varchar(255) DEFAULT NULL,
  `sablon_belakang` varchar(255) DEFAULT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `jumlah_bayar` float DEFAULT NULL,
  `status` enum('diproses','selesai','lunas') NOT NULL DEFAULT 'diproses',
  `tgl_transaksi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `FK__customer` (`id_customer`),
  ADD KEY `Index 3` (`id_barang`);

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
  ADD PRIMARY KEY (`id_tp`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pemesanan`
--
ALTER TABLE `transaksi_pemesanan`
  MODIFY `id_tp` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
