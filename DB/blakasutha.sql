-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2020 at 09:49 AM
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
  `harga_beli` float DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `stok`, `harga_1`, `harga_2`, `harga_3`, `harga_beli`, `updated_at`) VALUES
(18, 'POLOSL', 'Kaos Putih Polos (L)', 50, 75000, 73000, 70000, 50000, '2019-12-11'),
(19, 'POLOSXL', 'Kaos Putih Polos (XL)', 49, 75000, 73000, 70000, NULL, '2019-12-11'),
(20, 'POLOSPJGL', 'Kaos Putih Polos Panjang (XL)', 45, 80000, 77000, 78000, NULL, '2019-12-11');

--
-- Triggers `barang`
--
DELIMITER $$
CREATE TRIGGER `barang_after_update` AFTER UPDATE ON `barang` FOR EACH ROW BEGIN
INSERT INTO logs_barang(id_barang, old_harga1, old_harga2, old_harga3, new_harga1, new_harga2, new_harga3, updated_at) VALUES (OLD.id_barang, OLD.harga_1, OLD.harga_2, OLD.harga_3, NEW.harga_1, NEW.harga_2, NEW.harga_3, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_pesanan`
--

CREATE TABLE `barang_pesanan` (
  `id_barang` int(11) NOT NULL,
  `length` enum('Panjang','Pendek') NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `harga_1` float DEFAULT NULL,
  `harga_2` float DEFAULT NULL,
  `harga_3` float DEFAULT NULL,
  `type` enum('30','24') DEFAULT '30',
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `barang_pesanan`
--

INSERT INTO `barang_pesanan` (`id_barang`, `length`, `ukuran`, `harga_1`, `harga_2`, `harga_3`, `type`, `updated_at`) VALUES
(1, 'Panjang', 'S', 75000, 70000, 68000, '30', '2019-11-30'),
(2, 'Panjang', 'M', 75000, 70000, 68000, '30', '2019-11-30'),
(3, 'Panjang', 'L', 75000, 70000, 68000, '30', '2019-11-30'),
(4, 'Panjang', 'XL', 75000, 70000, 68000, '30', '2019-11-30'),
(5, 'Panjang', 'XXL', 75000, 70000, 68000, '30', '2019-11-30'),
(6, 'Panjang', 'XXXL', 75000, 70000, 68000, '30', '2019-11-30'),
(7, 'Pendek', 'S', 75000, 70000, 68000, '30', '2019-11-30'),
(8, 'Pendek', 'M', 75000, 70000, 68000, '30', '2019-11-30'),
(9, 'Pendek', 'L', 75000, 70000, 68000, '30', '2019-11-30'),
(10, 'Pendek', 'XL', 75000, 70000, 68000, '30', '2019-11-30'),
(11, 'Pendek', 'XXL', 75000, 70000, 68000, '30', '2019-11-30'),
(12, 'Pendek', 'XXXL', 75000, 70000, 68000, '30', '2019-11-30'),
(14, 'Panjang', 'S', 80000, 75000, 70000, '24', '2019-11-30'),
(15, 'Panjang', 'M', 80000, 75000, 70000, '24', '2019-11-30'),
(16, 'Panjang', 'L', 80000, 70000, 68000, '24', '2019-11-30'),
(17, 'Panjang', 'XL', 75000, 70000, 68000, '24', '2019-11-30'),
(18, 'Panjang', 'XXL', 75000, 70000, 68000, '24', '2019-11-30'),
(19, 'Panjang', 'XXXL', 75000, 70000, 68000, '24', '2019-11-30'),
(20, 'Pendek', 'S', 75000, 70000, 68000, '24', '2019-11-30'),
(21, 'Pendek', 'M', 75000, 70000, 68000, '24', '2019-11-30'),
(22, 'Pendek', 'L', 75000, 70000, 68000, '24', '2019-11-30'),
(23, 'Pendek', 'XL', 75000, 70000, 68000, '24', '2019-11-30'),
(24, 'Pendek', 'XXL', 75000, 70000, 68000, '24', '2019-11-30'),
(25, 'Pendek', 'XXXL', 75000, 70000, 68000, '24', '2019-11-30');

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
(12, 'Blakasutha', '085727298470', '@blakablaka', 'customer', '2019-12-13'),
(14, 'Alfa', '089609506242', '@alfaabad20', 'customer', '2020-01-01'),
(15, 'Dalpin', '085726562670', '@dkaalfi_', 'reseller', '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `logs_barang`
--

CREATE TABLE `logs_barang` (
  `id_logs` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL DEFAULT 0,
  `old_harga1` float DEFAULT NULL,
  `old_harga2` float DEFAULT NULL,
  `old_harga3` float DEFAULT NULL,
  `new_harga1` float DEFAULT NULL,
  `new_harga2` float DEFAULT NULL,
  `new_harga3` float DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs_barang`
--

INSERT INTO `logs_barang` (`id_logs`, `id_barang`, `old_harga1`, `old_harga2`, `old_harga3`, `new_harga1`, `new_harga2`, `new_harga3`, `updated_at`) VALUES
(1, 18, 75000, 73000, 70000, 75000, 73000, 70000, '2020-01-19 17:37:32'),
(2, 18, 75000, 73000, 70000, 75000, 73000, 70000, '2020-01-19 17:41:47'),
(3, 18, 75000, 73000, 70000, 75000, 73000, 70000, '2020-01-19 17:45:34');

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
(1, 'Blakasutha', 'Depan SMP 3 Pbg Lawas, Jln. Patung Knalpot', '082243440959', 'blaka@gmail.com', '@blakasuhta', 'Terimakasih', '2020-01-01 11:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trx` int(11) NOT NULL,
  `trx_code` varchar(255) DEFAULT NULL,
  `before_diskon` float DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `diskon` float DEFAULT 0,
  `jumlah_bayar` float DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL
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
  `file_desain` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `before_diskon` float DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `diskon` float DEFAULT NULL,
  `jumlah_bayar` float DEFAULT NULL,
  `harga_tambahan` float DEFAULT 0,
  `biaya_desain` float DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `kurang` enum('true','false') DEFAULT 'true',
  `type` enum('30','24') DEFAULT '30',
  `status` enum('diproses','selesai','lunas') DEFAULT 'diproses',
  `perkiraan_selesai` date DEFAULT NULL,
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
-- Indexes for table `logs_barang`
--
ALTER TABLE `logs_barang`
  ADD PRIMARY KEY (`id_logs`),
  ADD KEY `FK_logs_barang_barang` (`id_barang`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `logs_barang`
--
ALTER TABLE `logs_barang`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_pelunasan` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `logs_barang`
--
ALTER TABLE `logs_barang`
  ADD CONSTRAINT `FK_logs_barang_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

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
