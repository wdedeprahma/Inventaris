-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 02:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user','kepsek') NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `level`, `nama`) VALUES
(1, 'abusalam', 'a82fa8d0f94651653f03d1fc0a8c24b8', 'admin', 'Abu Salam'),
(3, '123', '202cb962ac59075b964b07152d234b70', 'user', 'User123'),
(6, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'admin123'),
(7, 'yayat', '4d1b0e29bbab6794a9a6f8d64a484f2c', 'kepsek', 'Dede'),
(8, 'dede', 'b4be1c568a6dc02dcaf2849852bdb13e', 'admin', 'dede'),
(9, 'yuda', 'ac9053a8bd7632586c3eb663a6cf15e4', 'user', 'yuda');

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id_audit` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_audit` date NOT NULL,
  `stok_aktual` int(11) NOT NULL,
  `selisih_stok` int(11) NOT NULL,
  `harga_per_unit` decimal(10,2) NOT NULL,
  `hasil_audit` enum('sesuai','tidak sesuai') NOT NULL,
  `catatan_audit` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `stok_sistem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id_audit`, `id_pegawai`, `id_kategori`, `id_barang`, `tanggal_audit`, `stok_aktual`, `selisih_stok`, `harga_per_unit`, `hasil_audit`, `catatan_audit`, `bukti`, `stok_sistem`) VALUES
(1, 1, 1, 5, '2024-07-27', 55, 10, '53.00', 'sesuai', 'da', 'JURNAL_HARIAN_GURU1.docx', 45),
(2, 1, 1, 4, '2024-07-26', 11, -4, '53000.00', 'sesuai', 'wq12e12', 'Screenshot_2023-10-16_0928141.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`) VALUES
(1, 'Laptop', '36'),
(4, 'Buku Pelajaran', '24'),
(5, 'lapangan', '45'),
(6, 'dongeng', '54');

-- --------------------------------------------------------

--
-- Table structure for table `b_hilang`
--

CREATE TABLE `b_hilang` (
  `id_hilang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `tanggal_hilang` date NOT NULL,
  `jum_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_keluar`
--

CREATE TABLE `b_keluar` (
  `id_bkeluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jumlahk` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `b_masuk`
--

CREATE TABLE `b_masuk` (
  `id_bmasuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `jumlahm` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `b_masuk`
--

INSERT INTO `b_masuk` (`id_bmasuk`, `id_barang`, `id_kategori`, `id_pegawai`, `id_supplier`, `jumlahm`, `tanggal_masuk`) VALUES
(2, 1, 1, 1, 1, 12, '2024-07-31'),
(3, 1, 1, 1, 1, 12, '2024-07-31'),
(4, 4, 1, 1, 1, 12, '2024-07-31');

--
-- Triggers `b_masuk`
--
DELIMITER $$
CREATE TRIGGER `insertmasuk` AFTER INSERT ON `b_masuk` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + NEW.jumlahm
WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Elektronik'),
(2, 'rumput'),
(3, 'hewan');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `lokasi`) VALUES
(1, 'Perpustakaan');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jabatan`) VALUES
(1, 'Rendy', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `pembaruan_b`
--

CREATE TABLE `pembaruan_b` (
  `id_pembaruan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `spesifikasi_lama` text DEFAULT NULL,
  `spesifikasi_baru` text DEFAULT NULL,
  `kondisi_lama` text DEFAULT NULL,
  `kondisi_baru` text DEFAULT NULL,
  `tanggal_pembaruan` datetime NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan_b`
--

CREATE TABLE `pemeliharaan_b` (
  `id_pemeliharaan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `tanggal_pemeliharaan` date NOT NULL,
  `tindakan` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeliharaan_b`
--

INSERT INTO `pemeliharaan_b` (`id_pemeliharaan`, `id_barang`, `id_kategori`, `id_lokasi`, `id_pegawai`, `id_status`, `tanggal_pemeliharaan`, `tindakan`, `keterangan`) VALUES
(1, 1, 1, 1, 1, 1, '2024-06-28', '-', 'Barang masih Mulus');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_b`
--

CREATE TABLE `peminjaman_b` (
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tujuan` text DEFAULT NULL,
  `status_peminjaman` enum('Menunggu Persetujuan','Disetujui','Ditolak') DEFAULT 'Menunggu Persetujuan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman_b`
--

INSERT INTO `peminjaman_b` (`id_peminjaman`, `id_barang`, `id_kategori`, `id_lokasi`, `id_pegawai`, `tanggal_peminjaman`, `tanggal_pengembalian`, `jumlah`, `tujuan`, `status_peminjaman`) VALUES
(3, 1, 1, 1, 1, '2024-07-18', '2024-09-27', 2, 'Untuk Pribadi', 'Disetujui'),
(4, 1, 1, 1, 1, '2024-07-19', '2024-07-20', 2, 'Untuk Pribadi', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahan_b`
--

CREATE TABLE `pemusnahan_b` (
  `id_pemusnahan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah_dimusnahkan` int(11) NOT NULL,
  `alasan_pemusnahan` text DEFAULT NULL,
  `tanggal_pemusnahan` datetime NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_b`
--

CREATE TABLE `pengembalian_b` (
  `id_pengembalian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_pengembalian` enum('Diterima','Belum Diterima','Dalam Proses') DEFAULT 'Dalam Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian_b`
--

INSERT INTO `pengembalian_b` (`id_pengembalian`, `id_barang`, `id_kategori`, `id_pegawai`, `id_lokasi`, `tanggal_pengembalian`, `tanggal_diterima`, `jumlah`, `status_pengembalian`) VALUES
(1, 1, 1, 1, 1, '2024-07-24', '2024-07-25', 1, 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `reorder_b`
--

CREATE TABLE `reorder_b` (
  `id_reorder` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jumlah_reorder` int(11) NOT NULL,
  `tanggal_reorder` datetime NOT NULL,
  `status_reorder` varchar(50) NOT NULL DEFAULT 'Pending',
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Baik'),
(2, 'Rusak Ringan'),
(3, 'Rusak Berat');

-- --------------------------------------------------------

--
-- Table structure for table `stok_b`
--

CREATE TABLE `stok_b` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tanggalupdate` date NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `hargaunit` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_b`
--

INSERT INTO `stok_b` (`id_stok`, `id_barang`, `id_kategori`, `tanggalupdate`, `satuan`, `hargaunit`) VALUES
(1, 1, 0, '2024-07-24', 'sad', '2000.00'),
(2, 5, 0, '2024-07-17', '', '200000.00'),
(3, 4, 0, '2024-07-24', '', '200000.00'),
(5, 4, 1, '2024-07-25', 'buah', '200000.00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(1, 'Prahm3', 'JL handil Bakti', '08343234555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id_audit`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `b_hilang`
--
ALTER TABLE `b_hilang`
  ADD PRIMARY KEY (`id_hilang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `b_keluar`
--
ALTER TABLE `b_keluar`
  ADD PRIMARY KEY (`id_bkeluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `b_masuk`
--
ALTER TABLE `b_masuk`
  ADD PRIMARY KEY (`id_bmasuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembaruan_b`
--
ALTER TABLE `pembaruan_b`
  ADD PRIMARY KEY (`id_pembaruan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pemeliharaan_b`
--
ALTER TABLE `pemeliharaan_b`
  ADD PRIMARY KEY (`id_pemeliharaan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `peminjaman_b`
--
ALTER TABLE `peminjaman_b`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pemusnahan_b`
--
ALTER TABLE `pemusnahan_b`
  ADD PRIMARY KEY (`id_pemusnahan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pengembalian_b`
--
ALTER TABLE `pengembalian_b`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `reorder_b`
--
ALTER TABLE `reorder_b`
  ADD PRIMARY KEY (`id_reorder`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `stok_b`
--
ALTER TABLE `stok_b`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `b_hilang`
--
ALTER TABLE `b_hilang`
  MODIFY `id_hilang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `b_keluar`
--
ALTER TABLE `b_keluar`
  MODIFY `id_bkeluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `b_masuk`
--
ALTER TABLE `b_masuk`
  MODIFY `id_bmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembaruan_b`
--
ALTER TABLE `pembaruan_b`
  MODIFY `id_pembaruan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeliharaan_b`
--
ALTER TABLE `pemeliharaan_b`
  MODIFY `id_pemeliharaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman_b`
--
ALTER TABLE `peminjaman_b`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemusnahan_b`
--
ALTER TABLE `pemusnahan_b`
  MODIFY `id_pemusnahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengembalian_b`
--
ALTER TABLE `pengembalian_b`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reorder_b`
--
ALTER TABLE `reorder_b`
  MODIFY `id_reorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok_b`
--
ALTER TABLE `stok_b`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `audit_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `b_hilang`
--
ALTER TABLE `b_hilang`
  ADD CONSTRAINT `b_hilang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `b_hilang_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_Lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `b_hilang_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `b_keluar`
--
ALTER TABLE `b_keluar`
  ADD CONSTRAINT `b_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `b_keluar_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `b_masuk`
--
ALTER TABLE `b_masuk`
  ADD CONSTRAINT `b_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `b_masuk_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `b_masuk_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `pembaruan_b`
--
ALTER TABLE `pembaruan_b`
  ADD CONSTRAINT `pembaruan_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pembaruan_b_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `pembaruan_b_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pemeliharaan_b`
--
ALTER TABLE `pemeliharaan_b`
  ADD CONSTRAINT `pemeliharaan_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeliharaan_b_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeliharaan_b_ibfk_3` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_Lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeliharaan_b_ibfk_4` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman_b`
--
ALTER TABLE `peminjaman_b`
  ADD CONSTRAINT `peminjaman_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `peminjaman_b_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_Lokasi`),
  ADD CONSTRAINT `peminjaman_b_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `pemusnahan_b`
--
ALTER TABLE `pemusnahan_b`
  ADD CONSTRAINT `pemusnahan_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pemusnahan_b_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `pemusnahan_b_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pengembalian_b`
--
ALTER TABLE `pengembalian_b`
  ADD CONSTRAINT `pengembalian_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pengembalian_b_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `pengembalian_b_ibfk_3` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_Lokasi`);

--
-- Constraints for table `reorder_b`
--
ALTER TABLE `reorder_b`
  ADD CONSTRAINT `reorder_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `reorder_b_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `reorder_b_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `reorder_b_ibfk_4` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `stok_b`
--
ALTER TABLE `stok_b`
  ADD CONSTRAINT `stok_b_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
