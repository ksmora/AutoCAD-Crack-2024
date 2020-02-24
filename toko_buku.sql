-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 08:10 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toko_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE IF NOT EXISTS `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(80) NOT NULL,
  `noisbn` varchar(20) NOT NULL,
  `penulis` varchar(60) NOT NULL,
  `penerbit` varchar(60) NOT NULL,
  `tahun` year(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_distributor`
--

CREATE TABLE IF NOT EXISTS `tb_distributor` (
  `id_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_distributor`
--

INSERT INTO `tb_distributor` (`id_distributor`, `nama_distributor`, `alamat`, `telepon`) VALUES
(3, '  GHONY ILYAS', 'Desa Jambu Timur', '  0895359844118'),
(4, 'HANI SALSABILA', 'Desa Cepogo', '0895359844118'),
(5, 'AHSANI NUR T', 'Desa Sinanggul', '0895358762431');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasir`
--

CREATE TABLE IF NOT EXISTS `tb_kasir` (
  `id_kasir` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kasir`
--

INSERT INTO `tb_kasir` (`id_kasir`, `nama`, `alamat`, `telepon`, `status`, `username`, `password`, `akses`) VALUES
(1, 'Ghony Ilyas', 'desa jambu timur, kecamatan mlonggo, kab jepara', '0895359855117', 'aktif', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Nurul Afifah', 'desa srobyong, kecamatan mlonggo, kab jepara', '085378929092', 'aktif', 'nurul', '6968a2c57c3a4fee8fadc79a80355e4d', 'kasir'),
(3, '  AQSOL AMRI', 'Desa Dudakawu, Kec Kembang, Kab Jepara', '  085387123999', 'aktif', 'aqsol', '1fdf81d2664ba097e14aeb4217507d2b', 'kasir'),
(4, 'Adam Wahyu Adi Wangsa', 'Desa Bangsri, Kec Bangsri , Kab Jepara', '089228397268', 'aktif', 'adam', '1d7c2923c1684726dc23d2901c4d8157', 'kasir'),
(5, 'Cindy Pramithasari', 'Desa Sekuro, Kec Mlonggo, Kab Jepara', '081644890345', 'aktif', 'cindy', 'cc4b2066cfef89f2475de1d4da4b29c7', 'kasir'),
(6, 'Danang Calvin', 'Desa Cepogo, Kec Kembang, Kab Jepara', '089338743112', 'aktif', 'danang', '6a17faad3b1275fd2558d5435c58440e', 'kasir'),
(7, 'Hani Salsabila', 'Desa Cepogo, Kec Kembang, Kab Jepara', '08953544887', 'aktif', 'salsa', '0143c1e8e97da861c623ff508a441c54', 'kasir'),
(8, 'Muhammad Farid Irawan', 'Desa Jambu Timur, Kec Mlonggo, Kab Jepara', '08577863595', 'aktif', 'farid', 'a1d12da42d4302e53d510954344ad164', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasok`
--

CREATE TABLE IF NOT EXISTS `tb_pasok` (
  `id_pasok` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE IF NOT EXISTS `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `tb_kasir`
--
ALTER TABLE `tb_kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `tb_pasok`
--
ALTER TABLE `tb_pasok`
  ADD PRIMARY KEY (`id_pasok`), ADD KEY `id_buku` (`id_buku`), ADD KEY `id_distributor` (`id_distributor`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`), ADD KEY `id_kasir` (`id_kasir`), ADD KEY `id_buku` (`id_buku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_kasir`
--
ALTER TABLE `tb_kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_pasok`
--
ALTER TABLE `tb_pasok`
  MODIFY `id_pasok` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pasok`
--
ALTER TABLE `tb_pasok`
ADD CONSTRAINT `tb_pasok_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`),
ADD CONSTRAINT `tb_pasok_ibfk_2` FOREIGN KEY (`id_distributor`) REFERENCES `tb_distributor` (`id_distributor`);

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_kasir`) REFERENCES `tb_kasir` (`id_kasir`),
ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
