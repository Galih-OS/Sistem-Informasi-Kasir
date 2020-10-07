-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2015 at 09:11 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_mentah`
--

CREATE TABLE IF NOT EXISTS `bahan_mentah` (
  `id_bahan` varchar(5) NOT NULL,
  `nama_bahan` varchar(25) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `no` int(3) NOT NULL,
  PRIMARY KEY (`id_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_mentah`
--

INSERT INTO `bahan_mentah` (`id_bahan`, `nama_bahan`, `stok`, `harga`, `no`) VALUES
('M1', 'Kancing', 1, 1000, 1),
('M2', 'Kain', 0, 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang_jadi`
--

CREATE TABLE IF NOT EXISTS `barang_jadi` (
  `id_barang` varchar(5) NOT NULL,
  `nama_barang` varchar(40) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `no` int(3) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_jadi`
--

INSERT INTO `barang_jadi` (`id_barang`, `nama_barang`, `stok`, `harga`, `no`) VALUES
('B1', 'Tas Laptop', 99, 50000, 1),
('B2', 'Tas Jinjing', 100, 40000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `id_det_pembelian` int(11) NOT NULL,
  `id_pembelian` varchar(5) DEFAULT NULL,
  `id_bahan` varchar(5) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_pembelian`),
  KEY `detail_pembelian_ibfk_1` (`id_pembelian`),
  KEY `detail_pembelian_ibfk_2` (`id_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_det_pembelian`, `id_pembelian`, `id_bahan`, `qty`, `sub_total`) VALUES
(1, 'PEM1', 'M1', 1, 1000),
(2, 'PEM2', 'M1', 1, 1000),
(3, 'PEM2', 'M2', 2, 10000),
(4, 'PEM3', 'M1', 3, 3000),
(5, 'PEM4', 'M2', 1, 5000),
(6, 'PEM5', 'M1', 2, 2000),
(7, 'PEM5', 'M2', 2, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id_det_penjualan` int(11) NOT NULL,
  `id_penjualan` varchar(5) DEFAULT NULL,
  `id_barang` varchar(5) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_penjualan`),
  KEY `detail_penjualan_ibfk_1` (`id_barang`),
  KEY `detail_penjualan_ibfk_2` (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_det_penjualan`, `id_penjualan`, `id_barang`, `kuantitas`, `sub_total`) VALUES
(1, 'PEN1', 'B1', 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan_penjualan`
--

CREATE TABLE IF NOT EXISTS `detail_permintaan_penjualan` (
  `id_det_permintaan_jual` int(11) NOT NULL,
  `id_permintaan_jual` varchar(5) DEFAULT NULL,
  `id_barang` varchar(5) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_permintaan_jual`),
  KEY `detail_permintaan_penjualan_ibfk_1` (`id_permintaan_jual`),
  KEY `detail_permintaan_penjualan_ibfk_2` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan_penjualan`
--

INSERT INTO `detail_permintaan_penjualan` (`id_det_permintaan_jual`, `id_permintaan_jual`, `id_barang`, `kuantitas`) VALUES
(1, 'PPJ1', 'B1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan_produksi`
--

CREATE TABLE IF NOT EXISTS `detail_permintaan_produksi` (
  `id_det_permintaan_prod` int(11) NOT NULL,
  `id_permintaan_prod` varchar(5) DEFAULT NULL,
  `id_bahan` varchar(5) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_permintaan_prod`),
  KEY `detail_permintaan_produksi_ibfk_1` (`id_permintaan_prod`),
  KEY `detail_permintaan_produksi_ibfk_2` (`id_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan_produksi`
--

INSERT INTO `detail_permintaan_produksi` (`id_det_permintaan_prod`, `id_permintaan_prod`, `id_bahan`, `kuantitas`) VALUES
(1, 'PRO1', 'M1', 1),
(2, 'PRO1', 'M2', 2),
(3, 'PRO2', 'M1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` varchar(5) NOT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `notelp_pegawai` varchar(16) DEFAULT NULL,
  `alamat_pegawai` varchar(50) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `bagian` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `notelp_pegawai`, `alamat_pegawai`, `username`, `password`, `bagian`) VALUES
('P1', 'Khamim', '031-1234', 'Alamat', 'coba', 'coba', 'admin'),
('P2', 'Gudang', '123', 'alamat', 'gudang', 'gudang', 'gudang'),
('P3', 'admin kasir', NULL, NULL, 'kasir', 'kasir', 'kasir'),
('P4', 'admin produk', NULL, NULL, 'produk', 'produk', 'produk');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` varchar(5) NOT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL,
  `id_supplier` varchar(5) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `no` int(3) NOT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_supplier` (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pegawai`, `id_supplier`, `tanggal_pembelian`, `total`, `no`) VALUES
('PEM1', 'P2', 'SUP1', '2015-06-14 21:54:18', 1000, 1),
('PEM2', 'P2', 'SUP1', '2015-06-14 21:58:34', 11000, 2),
('PEM3', 'P2', 'SUP2', '2015-06-14 22:00:23', 3000, 3),
('PEM4', 'P2', 'SUP2', '2015-06-14 22:01:41', 5000, 4),
('PEM5', 'P2', 'SUP1', '2015-06-14 22:02:28', 12000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` varchar(5) NOT NULL,
  `tgl_jual` datetime DEFAULT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tunai` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `no` int(3) NOT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `penjualan_ibfk_1` (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tgl_jual`, `id_pegawai`, `total`, `tunai`, `kembali`, `no`) VALUES
('PEN1', '2015-06-15 20:38:01', 'P4', 50000, 50000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_penjualan`
--

CREATE TABLE IF NOT EXISTS `permintaan_penjualan` (
  `id_permintaan_jual` varchar(5) NOT NULL,
  `id_penjualan` varchar(5) DEFAULT NULL,
  `tgl_permintaan` datetime DEFAULT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL,
  `id_peminta` varchar(5) DEFAULT NULL,
  `total_item` int(11) DEFAULT NULL,
  `no` int(3) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_permintaan_jual`),
  KEY `permintaan_penjualan_ibfk_1` (`id_pegawai`),
  KEY `permintaan_penjualan_ibfk_2` (`id_peminta`),
  KEY `permintaan_penjualan_ibfk_3` (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_penjualan`
--

INSERT INTO `permintaan_penjualan` (`id_permintaan_jual`, `id_penjualan`, `tgl_permintaan`, `id_pegawai`, `id_peminta`, `total_item`, `no`, `status`) VALUES
('PPJ1', 'PEN1', '2015-06-15 20:38:01', 'P4', 'P4', 50000, 1, 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_produksi`
--

CREATE TABLE IF NOT EXISTS `permintaan_produksi` (
  `id_permintaan_prod` varchar(5) NOT NULL,
  `tgl_permintaan` datetime DEFAULT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL,
  `id_peminta` varchar(5) DEFAULT NULL,
  `total_item` int(11) DEFAULT NULL,
  `no` int(3) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_permintaan_prod`),
  KEY `permintaan_produksi_ibfk_1` (`id_pegawai`),
  KEY `permintaan_produksi_ibfk_2` (`id_peminta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_produksi`
--

INSERT INTO `permintaan_produksi` (`id_permintaan_prod`, `tgl_permintaan`, `id_pegawai`, `id_peminta`, `total_item`, `no`, `status`) VALUES
('PRO1', '2015-06-15 09:56:54', 'P2', 'P4', 3, 1, 'accept'),
('PRO2', '2015-06-15 10:18:17', 'P1', 'P2', 3, 2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` varchar(5) NOT NULL,
  `nama_supplier` varchar(30) DEFAULT NULL,
  `alamat_supplier` varchar(50) DEFAULT NULL,
  `no` int(3) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `no`) VALUES
('SUP1', 'Canon', 'Surabaya', 1),
('SUP2', 'Prima Jaya', 'Gresik', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_mentah` (`id_bahan`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang_jadi` (`id_barang`),
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

--
-- Constraints for table `detail_permintaan_penjualan`
--
ALTER TABLE `detail_permintaan_penjualan`
  ADD CONSTRAINT `detail_permintaan_penjualan_ibfk_1` FOREIGN KEY (`id_permintaan_jual`) REFERENCES `permintaan_penjualan` (`id_permintaan_jual`),
  ADD CONSTRAINT `detail_permintaan_penjualan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang_jadi` (`id_barang`);

--
-- Constraints for table `detail_permintaan_produksi`
--
ALTER TABLE `detail_permintaan_produksi`
  ADD CONSTRAINT `detail_permintaan_produksi_ibfk_1` FOREIGN KEY (`id_permintaan_prod`) REFERENCES `permintaan_produksi` (`id_permintaan_prod`),
  ADD CONSTRAINT `detail_permintaan_produksi_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_mentah` (`id_bahan`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `permintaan_penjualan`
--
ALTER TABLE `permintaan_penjualan`
  ADD CONSTRAINT `permintaan_penjualan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `permintaan_penjualan_ibfk_2` FOREIGN KEY (`id_peminta`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `permintaan_penjualan_ibfk_3` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

--
-- Constraints for table `permintaan_produksi`
--
ALTER TABLE `permintaan_produksi`
  ADD CONSTRAINT `permintaan_produksi_ibfk_2` FOREIGN KEY (`id_peminta`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `permintaan_produksi_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
