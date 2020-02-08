-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.2.3-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table blakasutha.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('administrator','kasir') DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.admin: ~3 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT IGNORE INTO `admin` (`id_admin`, `username`, `fullname`, `password`, `role`) VALUES
	(1, 'admin', 'Admin BLAKA', '0192023a7bbd73250516f069df18b500', 'administrator'),
	(2, 'kasir', 'Kasir Blaka', 'de28f8f7998f23ab4194b51a6029416f', 'kasir'),
	(3, 'a', 'a', NULL, NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table blakasutha.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga_1` float DEFAULT NULL,
  `harga_2` float DEFAULT NULL,
  `harga_3` float DEFAULT NULL,
  `harga_beli` float DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.barang: ~4 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT IGNORE INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `stok`, `harga_1`, `harga_2`, `harga_3`, `harga_beli`, `updated_at`) VALUES
	(18, 'POLOSL', 'Kaos Putih Polos (L)', 50, 75000, 73000, 70000, 50000, '2019-12-11'),
	(19, 'POLOSXL', 'Kaos Putih Polos (XL)', 49, 75000, 73000, 70000, NULL, '2019-12-11'),
	(20, 'POLOSPJGL', 'Kaos Putih Polos Panjang (XL)', 45, 80000, 77000, 78000, NULL, '2019-12-11'),
	(21, 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table blakasutha.barang_pesanan
CREATE TABLE IF NOT EXISTS `barang_pesanan` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `length` enum('Panjang','Pendek','Other') NOT NULL DEFAULT 'Other',
  `ukuran` varchar(255) NOT NULL,
  `harga_1` float DEFAULT NULL,
  `harga_2` float DEFAULT NULL,
  `harga_3` float DEFAULT NULL,
  `type` enum('30','24','other') DEFAULT 'other',
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table blakasutha.barang_pesanan: ~24 rows (approximately)
/*!40000 ALTER TABLE `barang_pesanan` DISABLE KEYS */;
INSERT IGNORE INTO `barang_pesanan` (`id_barang`, `length`, `ukuran`, `harga_1`, `harga_2`, `harga_3`, `type`, `updated_at`) VALUES
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
/*!40000 ALTER TABLE `barang_pesanan` ENABLE KEYS */;

-- Dumping structure for table blakasutha.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `role` enum('customer','reseller') DEFAULT 'customer',
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.customer: ~3 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT IGNORE INTO `customer` (`id_customer`, `nama_lengkap`, `phone`, `instagram`, `role`, `created_at`) VALUES
	(12, 'Blakasutha', '085727298470', '@blakablaka', 'customer', '2019-12-13'),
	(14, 'Alfa', '089609506242', '@alfaabad20', 'customer', '2020-01-01'),
	(15, 'Dalpin', '085726562670', '@dkaalfi_', 'reseller', '2020-01-01');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table blakasutha.logs_barang
CREATE TABLE IF NOT EXISTS `logs_barang` (
  `id_logs` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL DEFAULT 0,
  `old_harga1` float DEFAULT NULL,
  `old_harga2` float DEFAULT NULL,
  `old_harga3` float DEFAULT NULL,
  `new_harga1` float DEFAULT NULL,
  `new_harga2` float DEFAULT NULL,
  `new_harga3` float DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_logs`),
  KEY `FK_logs_barang_barang` (`id_barang`),
  CONSTRAINT `FK_logs_barang_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.logs_barang: ~0 rows (approximately)
/*!40000 ALTER TABLE `logs_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs_barang` ENABLE KEYS */;

-- Dumping structure for table blakasutha.pelunasan
CREATE TABLE IF NOT EXISTS `pelunasan` (
  `id_pelunasan` int(11) NOT NULL AUTO_INCREMENT,
  `trx_code` varchar(80) NOT NULL,
  `dp` float DEFAULT NULL,
  `pelunasan` float DEFAULT NULL,
  `tgl_pelunasan` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pelunasan`),
  KEY `FK__transaksi_pemesanan` (`trx_code`),
  CONSTRAINT `FK__transaksi_pemesanan` FOREIGN KEY (`trx_code`) REFERENCES `transaksi_pemesanan` (`trx_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.pelunasan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pelunasan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelunasan` ENABLE KEYS */;

-- Dumping structure for table blakasutha.pemesanan
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `trx_code` varchar(80) DEFAULT NULL,
  `subharga` float DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_order` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`),
  KEY `FK__customer` (`id_customer`),
  KEY `Index 3` (`id_barang`),
  CONSTRAINT `FK_pemesanan_barang_pesanan` FOREIGN KEY (`id_barang`) REFERENCES `barang_pesanan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table blakasutha.pemesanan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pemesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pemesanan` ENABLE KEYS */;

-- Dumping structure for table blakasutha.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `trx_code` varchar(255) NOT NULL,
  `subharga` float NOT NULL,
  `jumlah` float NOT NULL,
  `tgl_penjualan` datetime DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `FK_penjualan_customer` (`id_customer`),
  KEY `FK_penjualan_barang` (`id_barang`),
  CONSTRAINT `FK_penjualan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_penjualan_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.penjualan: ~0 rows (approximately)
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;

-- Dumping structure for table blakasutha.setting
CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bisnis` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `ucapan` text DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.setting: ~1 rows (approximately)
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT IGNORE INTO `setting` (`setting_id`, `nama_bisnis`, `alamat`, `phone`, `email`, `instagram`, `ucapan`, `update_at`) VALUES
	(1, 'Blakasutha', 'Depan SMP 3 Pbg Lawas, Jln. Patung Knalpot', '082243440959', 'blaka@gmail.com', '@blakasuhta', 'Terimakasih', '2020-01-01 11:25:58');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table blakasutha.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_trx` int(11) NOT NULL AUTO_INCREMENT,
  `trx_code` varchar(255) DEFAULT NULL,
  `before_diskon` float DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `diskon` float DEFAULT 0,
  `jumlah_bayar` float DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  PRIMARY KEY (`id_trx`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.transaksi: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table blakasutha.transaksi_pemesanan
CREATE TABLE IF NOT EXISTS `transaksi_pemesanan` (
  `id_tp` int(11) NOT NULL AUTO_INCREMENT,
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
  `tgl_transaksi` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tp`),
  UNIQUE KEY `Index 2` (`trx_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table blakasutha.transaksi_pemesanan: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaksi_pemesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_pemesanan` ENABLE KEYS */;

-- Dumping structure for trigger blakasutha.barang_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `barang_after_update` AFTER UPDATE ON `barang` FOR EACH ROW BEGIN
INSERT INTO logs_barang(id_barang, old_harga1, old_harga2, old_harga3, new_harga1, new_harga2, new_harga3, updated_at) VALUES (OLD.id_barang, OLD.harga_1, OLD.harga_2, OLD.harga_3, NEW.harga_1, NEW.harga_2, NEW.harga_3, NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
