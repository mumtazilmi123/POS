-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 05:19 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ctg_id` int(11) NOT NULL,
  `ctg_name` varchar(100) NOT NULL,
  `ctg_brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ctg_id`, `ctg_name`, `ctg_brand`) VALUES
(1, 'Makanan', '99'),
(2, 'Minuman ', '90'),
(3, 'Kosmetik', '9001');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-05-13-143548', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1652454299, 1),
(2, '2022-05-13-143728', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1652454449, 2),
(3, '2022-05-13-144141', 'App\\Database\\Migrations\\Satuan', 'default', 'App', 1652454449, 2),
(4, '2022-05-13-144302', 'App\\Database\\Migrations\\Pelanggan', 'default', 'App', 1652454449, 2),
(5, '2022-05-13-144510', 'App\\Database\\Migrations\\Penjualan', 'default', 'App', 1652454449, 2),
(6, '2022-05-13-144657', 'App\\Database\\Migrations\\Supplier', 'default', 'App', 1652454449, 2),
(7, '2022-05-13-144944', 'App\\Database\\Migrations\\Penjualandetail', 'default', 'App', 1652454449, 2),
(8, '2022-05-13-145802', 'App\\Database\\Migrations\\Pembelian', 'default', 'App', 1652454476, 3),
(9, '2022-05-13-150003', 'App\\Database\\Migrations\\Pembeliandetail', 'default', 'App', 1652454502, 4),
(10, '2022-05-13-150254', 'App\\Database\\Migrations\\Temppenjualan', 'default', 'App', 1652454502, 4),
(11, '2022-05-14-034058', 'App\\Database\\Migrations\\Users', 'default', 'App', 1652499772, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `cs_code` int(11) NOT NULL,
  `cs_name` varchar(100) NOT NULL,
  `cs_address` text NOT NULL,
  `cs_phone` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`cs_code`, `cs_name`, `cs_address`, `cs_phone`) VALUES
(1, 'Naufal Mumtaz', 'Bogor', '000000111'),
(2, 'Gilang', 'Bandung', '001929281281'),
(3, 'Muhammaf Latif', 'Bogor', '0192919191'),
(4, '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `buy_faktur` char(20) NOT NULL,
  `buy_tgl` date NOT NULL,
  `buy_jenisbayar` enum('T','K') NOT NULL DEFAULT 'T',
  `buy_supkode` int(11) NOT NULL,
  `buy_discpersen` double(11,2) NOT NULL DEFAULT 0.00,
  `buy_discuang` double(11,2) NOT NULL DEFAULT 0.00,
  `buy_totalkotor` double(11,2) NOT NULL DEFAULT 0.00,
  `buy_totalbersih` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `detbeli_id` bigint(11) NOT NULL,
  `detbeli_buy` char(20) NOT NULL,
  `detbeli_barcode` char(50) NOT NULL,
  `detbeli_hargabeli` double(11,2) NOT NULL DEFAULT 0.00,
  `detbeli_hargajual` double(11,2) NOT NULL DEFAULT 0.00,
  `detbeli_jml` double(11,2) NOT NULL DEFAULT 0.00,
  `detbeli_subtotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `sale_faktur` char(20) NOT NULL,
  `sale_tgl` date NOT NULL,
  `sale_cs` int(11) NOT NULL,
  `sale_discpersen` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_discuang` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_totalkotor` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_totalbersih` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `detjual_id` bigint(11) NOT NULL,
  `detjual_sale` char(20) NOT NULL,
  `detjual_barcode` char(50) NOT NULL,
  `detjual_hargabeli` double(11,2) NOT NULL DEFAULT 0.00,
  `detjual_hargajual` double(11,2) NOT NULL DEFAULT 0.00,
  `detjual_jml` double(11,2) NOT NULL DEFAULT 0.00,
  `detjual_subtotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idbarcode` char(50) NOT NULL,
  `pr_name` varchar(100) DEFAULT NULL,
  `pr_uid` int(11) DEFAULT NULL,
  `pr_ctgid` int(11) DEFAULT NULL,
  `readystock` double(11,2) NOT NULL DEFAULT 0.00,
  `harga_beli` double(11,2) NOT NULL DEFAULT 0.00,
  `harga_jual` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idbarcode`, `pr_name`, `pr_uid`, `pr_ctgid`, `readystock`, `harga_beli`, `harga_jual`) VALUES
('0001', 'Indomie Goreng Original', 1, 1, 200.00, 2000.00, 3000.00),
('0002', 'UltraMilk ', 1, 2, 200.00, 4000.00, 5000.00),
('0003', 'Lays Rumput Laut', 1, 1, 300.00, 2000.00, 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`u_id`, `u_name`) VALUES
(1, 'PCS'),
(2, 'Kg'),
(3, 'Liter'),
(4, 'Box');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sup_code` int(11) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_address` text NOT NULL,
  `sup_phone` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_penjualan`
--

CREATE TABLE `temp_penjualan` (
  `detjual_id` bigint(11) NOT NULL,
  `detjual_faktur` char(20) NOT NULL,
  `detjual_kodebarcode` char(50) NOT NULL,
  `detjual_hargabeli` double(11,2) NOT NULL DEFAULT 0.00,
  `detjual_hargajual` double(11,2) NOT NULL DEFAULT 0.00,
  `detjual_jml` double(11,2) NOT NULL DEFAULT 0.00,
  `detjual_subtotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `created_at`, `updated_at`) VALUES
('admin1', 'admin1', '', '2022-05-21 00:54:24', '2022-05-21 00:54:24'),
('mumtaz', 'mumtazilmi', 'Naufal Mumtaz', '2022-05-17 12:05:32', '2022-05-17 12:05:32'),
('naufal', '123\r\n', '', '2022-05-17 12:25:11', '2022-05-17 12:25:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`cs_code`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`buy_faktur`),
  ADD KEY `buy_supkode` (`buy_supkode`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`detbeli_id`),
  ADD KEY `detbeli_buy` (`detbeli_buy`),
  ADD KEY `detbeli_barcode` (`detbeli_barcode`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`sale_faktur`),
  ADD KEY `penjualan_sale_cs_foreign` (`sale_cs`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`detjual_id`),
  ADD KEY `penjualan_detail_detjual_sale_foreign` (`detjual_sale`),
  ADD KEY `penjualan_detail_detjual_barcode_foreign` (`detjual_barcode`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idbarcode`),
  ADD KEY `pr_uid` (`pr_uid`,`pr_ctgid`),
  ADD KEY `pr_ctgid` (`pr_ctgid`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sup_code`);

--
-- Indexes for table `temp_penjualan`
--
ALTER TABLE `temp_penjualan`
  ADD PRIMARY KEY (`detjual_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `cs_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `detbeli_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `detjual_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sup_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_penjualan`
--
ALTER TABLE `temp_penjualan`
  MODIFY `detjual_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`buy_supkode`) REFERENCES `supplier` (`sup_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`detbeli_buy`) REFERENCES `pembelian` (`buy_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`detbeli_barcode`) REFERENCES `produk` (`idbarcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_sale_cs_foreign` FOREIGN KEY (`sale_cs`) REFERENCES `pelanggan` (`cs_code`) ON UPDATE CASCADE;

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_detjual_barcode_foreign` FOREIGN KEY (`detjual_barcode`) REFERENCES `produk` (`idbarcode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_detail_detjual_sale_foreign` FOREIGN KEY (`detjual_sale`) REFERENCES `penjualan` (`sale_faktur`) ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`pr_ctgid`) REFERENCES `kategori` (`ctg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`pr_uid`) REFERENCES `satuan` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
