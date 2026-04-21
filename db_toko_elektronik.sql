-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2026 at 05:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko_elektronik`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int NOT NULL,
  `transaksi_id` int DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL,
  `produk_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `nama_produk`, `harga`, `qty`, `subtotal`, `produk_id`) VALUES
(7, 5, 'Smart TV', 1600000, 1, 1600000, NULL),
(8, 5, 'Blender', 65000, 1, 65000, NULL),
(9, 6, 'Mesin Cuci', 1300000, 1, 1300000, NULL),
(10, 6, 'Kulkas 2 Pintu', 2500000, 1, 2500000, NULL),
(11, 7, 'Setrika', 80000, 1, 80000, 7),
(12, 7, 'Rice Cooker', 100000, 1, 100000, 6),
(13, 8, 'Air Conditioner', 2000000, 1, 2000000, 3),
(14, 8, 'Kipas Angin', 200000, 1, 200000, 4),
(15, 9, 'Kulkas 2 Pintu', 2500000, 1, 2500000, 1),
(16, 9, 'Kipas Angin', 200000, 1, 200000, 4),
(17, 9, 'Setrika', 80000, 1, 80000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_transaksi`
--

CREATE TABLE `laporan_transaksi` (
  `id_laporan` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total_transaksi` int DEFAULT NULL,
  `total_unit` int DEFAULT NULL,
  `total_pendapatan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_transaksi`
--

INSERT INTO `laporan_transaksi` (`id_laporan`, `tanggal`, `total_transaksi`, `total_unit`, `total_pendapatan`) VALUES
(1, '2026-02-20', 1, 2, 1665000),
(2, '2026-04-13', 1, 2, 2200000),
(3, '2026-04-20', 1, 3, 2780000);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_restock`
--

CREATE TABLE `permintaan_restock` (
  `id` int NOT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah_permintaan` int DEFAULT NULL,
  `alasan_restock` text,
  `supplier` varchar(100) DEFAULT NULL,
  `tanggal_permintaan` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `kondisi_barang` varchar(50) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permintaan_restock`
--

INSERT INTO `permintaan_restock` (`id`, `produk_id`, `jumlah_permintaan`, `alasan_restock`, `supplier`, `tanggal_permintaan`, `status`, `kondisi_barang`, `catatan`) VALUES
(2, 4, 5, 'Stok barang telah menipis di gudang', 'PT Electronic Amanah', '2026-03-15 14:11:27', 'selesai', 'Baik', '5 kipas angin yang dikirim oleh supplier semua dalam kondisi baik dan layak untuk dijual'),
(3, 6, 3, 'Rice cooker sudah mendekati stok minimum di gudang', 'PT Maju Electronic', '2026-04-08 23:20:36', 'Menunggu', NULL, NULL),
(4, 7, 5, 'Setrika sudah mencapai batas minimum/sudah menipis di gudang', 'PT Elektronik Sentosa', '2026-04-20 10:08:14', 'selesai', 'baik', 'Setrika kondisi barangnya baik dan tidak ada yang cacat ');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `gambar` varchar(255) DEFAULT NULL,
  `stok_minimum` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga`, `stok`, `created_at`, `gambar`, `stok_minimum`) VALUES
(1, 'Kulkas 2 Pintu', 2500000, 13, '2026-02-27 09:45:19', 'Kulkas.jpg', 8),
(2, 'Smart TV', 1600000, 14, '2026-02-27 09:45:19', 'Smart TV.png', 9),
(3, 'Air Conditioner', 2000000, 12, '2026-02-27 09:45:19', 'AC.jpg', 8),
(4, 'Kipas Angin', 200000, 15, '2026-02-27 09:45:19', 'Kipas Angin.jpg', 12),
(5, 'Mesin Cuci', 1300000, 11, '2026-02-27 09:45:19', 'Mesin Cuci.jpg', 10),
(6, 'Rice Cooker', 100000, 10, '2026-02-27 09:45:19', 'Rice Cooker.jpg', 11),
(7, 'Setrika', 80000, 12, '2026-02-27 09:45:19', 'Setrika.jpg', 12),
(8, 'Blender', 65000, 8, '2026-02-27 09:45:19', 'Blender.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id_retur` int NOT NULL,
  `id_barang` int DEFAULT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `alasan` text,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `kondisi_barang` varchar(50) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `retur_barang`
--

INSERT INTO `retur_barang` (`id_retur`, `id_barang`, `nama_supplier`, `jumlah`, `alasan`, `foto`, `tanggal`, `status`, `kondisi_barang`, `catatan`) VALUES
(5, 1, 'PT Elektronik Sentosa', 1, 'Baut pada pintu kulkas kurang kenceng', 'upload/1773733528_Freezer.jpg', '2026-03-17 14:45:28', 'dicek', 'Baik', 'Kulkas yang dikirim oleh supplier setelah melakukan permintaan retur sudah baik, baut kulkas sudah kencang semua '),
(6, 6, 'Elektronik Makmur Sentosa', 1, 'Body rice cooker ada yang lecet ', 'upload/1773758843_Gambar_Rice_Cooker.webp', '2026-03-17 21:47:23', 'disetujui', NULL, NULL),
(7, 2, 'Elektronik Makmur Sentosa', 2, 'Layar pada TV ada yang pecah ', 'upload/1775753147_TV_Led.jpg', '2026-04-09 23:45:47', 'dikirim', NULL, NULL),
(8, 8, 'PT Elektronik Hub', 2, 'Blender tidak mau menyala sama sekali saat dihubungkan dengan listrik ', 'upload/1776654652_Blender_Rusak.jpg', '2026-04-20 10:10:52', 'dikirim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_harga` int DEFAULT NULL,
  `total_unit` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `total_harga`, `total_unit`) VALUES
(5, '2026-02-20 23:18:40', 1665000, 2),
(6, '2026-02-27 08:27:28', 3800000, 2),
(7, '2026-02-27 23:15:21', 180000, 2),
(8, '2026-04-13 21:47:46', 2200000, 2),
(9, '2026-04-20 09:59:33', 2780000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`) VALUES
(1, 'Kasir', 'Kasir01', 'kasir123'),
(2, 'Admin', 'Admin02', 'admin123'),
(3, 'Petugas_Gudang', 'Petugas_Gudang03', 'petugas_gudang123'),
(4, 'Manajer_Gudang', 'Manajer_Gudang04', 'manajer_gudang123'),
(5, 'Supplier', 'Supplier05', 'supplier123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_transaksi`
--
ALTER TABLE `laporan_transaksi`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `tanggal` (`tanggal`);

--
-- Indexes for table `permintaan_restock`
--
ALTER TABLE `permintaan_restock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `laporan_transaksi`
--
ALTER TABLE `laporan_transaksi`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permintaan_restock`
--
ALTER TABLE `permintaan_restock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id_retur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
