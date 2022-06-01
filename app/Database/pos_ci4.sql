-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 11:08 PM
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
-- Database: `pos_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ctg_name` varchar(100) NOT NULL,
  `ctg_id` int(11) NOT NULL,
  `ctg_brand` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ctg_name`, `ctg_id`, `ctg_brand`) VALUES
('Jajanan', 15, '5 Merk'),
('Minuman ', 17, '20 Merk'),
('Makanan', 18, '100 Merk'),
('Kosmetik', 19, '10 Merk'),
('Obat - Obatan', 20, '17 Merk'),
('Sayuran', 21, '4 Merk'),
('Buah ', 22, '6 Merk'),
('Rokok', 23, '12 Merk'),
('Alat Tulis', 24, '9 Merk'),
('Permen', 27, '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_phone` char(20) NOT NULL,
  `cust_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_name`, `cust_phone`, `cust_address`) VALUES
(2, 'Naufal Mumtaz ', '089571231981', 'Bandung '),
(3, 'Galang ARTP', '081263281928', 'Bogor'),
(4, 'Rafli', '08577234829', 'Karawang '),
(5, 'Bintang ', '078172199127', 'Cilangkap'),
(6, 'Adinda ', '08123102391', 'Citereup '),
(8, 'Restu', '089128371', 'Cibubur'),
(9, 'Ivana ', '089212371', 'Cibubur'),
(10, 'Marhaban ', '0891726384', 'Cibinong '),
(11, 'Tivani ', '08127391', 'Karadenan'),
(12, 'Kayra Nindya', '0819281219', 'Kamurang');

-- --------------------------------------------------------

--
-- Table structure for table `prcs_detail`
--

CREATE TABLE `prcs_detail` (
  `detprcs_id` bigint(11) NOT NULL,
  `detprcs_inv` char(25) NOT NULL,
  `detprcs_barcode` char(100) NOT NULL,
  `detprcs_prcsprice` double(11,2) NOT NULL DEFAULT 0.00,
  `detprcs_prcssale` double(11,2) NOT NULL DEFAULT 0.00,
  `detprcs_total` double(11,2) NOT NULL DEFAULT 0.00,
  `detprcs_subtotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `idbarcode` char(100) NOT NULL,
  `pr_name` varchar(100) NOT NULL,
  `pr_uid` int(11) NOT NULL,
  `pr_ctgid` int(11) NOT NULL,
  `readystock` double(11,5) NOT NULL DEFAULT 0.00000,
  `purchase_prc` double(11,5) NOT NULL DEFAULT 0.00000,
  `sell_prc` double(11,5) NOT NULL DEFAULT 0.00000,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`idbarcode`, `pr_name`, `pr_uid`, `pr_ctgid`, `readystock`, `purchase_prc`, `sell_prc`, `img`) VALUES
('001', 'Indomie Goreng', 1, 18, 10.00000, 1.50000, 2.00000, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchace`
--

CREATE TABLE `purchace` (
  `invoice` int(25) NOT NULL,
  `buy_date` enum('T','C') NOT NULL DEFAULT 'T',
  `buy_paymenttype` int(11) NOT NULL,
  `buy_supcode` int(11) NOT NULL,
  `buy_discpercenct` double(11,2) NOT NULL DEFAULT 0.00,
  `buy_discmoney` double(11,2) NOT NULL DEFAULT 0.00,
  `buy_grosstotal` double(11,2) NOT NULL DEFAULT 0.00,
  `buy_nettotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_invoice` char(20) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_custid` int(11) NOT NULL,
  `sale_discpercent` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_discmoney` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_grasstotal` double(11,2) NOT NULL DEFAULT 0.00,
  `sale_nettotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `detsale_id` bigint(11) NOT NULL,
  `detsale_inv` char(20) NOT NULL,
  `detsale_barcode` char(100) NOT NULL,
  `detsale_prcsprice` double(11,2) NOT NULL DEFAULT 0.00,
  `detsale_prcssale` double(11,2) NOT NULL DEFAULT 0.00,
  `detsale_total` double(11,2) NOT NULL DEFAULT 0.00,
  `detsale_subtotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sp_code` int(11) NOT NULL,
  `sp_name` varchar(100) NOT NULL,
  `sp_addres` text NOT NULL,
  `sp_item` varchar(111) NOT NULL,
  `sp_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temppurchase`
--

CREATE TABLE `temppurchase` (
  `detprcs_id` bigint(11) NOT NULL,
  `detprcs_inv` char(20) NOT NULL,
  `detprcs_barcode` char(50) NOT NULL,
  `detprcs_prcsprice` double(11,2) NOT NULL DEFAULT 0.00,
  `detprcs_prcssale` double(11,2) NOT NULL DEFAULT 0.00,
  `detprcs_total` double(11,2) NOT NULL DEFAULT 0.00,
  `detprcs_subtotal` double(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`u_id`, `u_name`) VALUES
(1, 'PCS'),
(2, 'KG '),
(4, 'L'),
(5, 'gr'),
(6, 'mL'),
(7, 'Kaleng'),
(8, 'Kardus'),
(9, 'Botol'),
(10, 'Karung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `prcs_detail`
--
ALTER TABLE `prcs_detail`
  ADD PRIMARY KEY (`detprcs_id`),
  ADD UNIQUE KEY `detprcs_inv` (`detprcs_inv`,`detprcs_barcode`),
  ADD UNIQUE KEY `detprcs_inv_3` (`detprcs_inv`,`detprcs_barcode`),
  ADD UNIQUE KEY `detprcs_barcode` (`detprcs_barcode`),
  ADD UNIQUE KEY `detprcs_inv_4` (`detprcs_inv`),
  ADD UNIQUE KEY `detprcs_inv_5` (`detprcs_inv`),
  ADD UNIQUE KEY `detprcs_inv_6` (`detprcs_inv`),
  ADD KEY `detprcs_inv_2` (`detprcs_inv`,`detprcs_barcode`),
  ADD KEY `detprcs_inv_7` (`detprcs_inv`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idbarcode`),
  ADD UNIQUE KEY `pr_uid` (`pr_uid`,`pr_ctgid`),
  ADD KEY `pr_ctgid` (`pr_ctgid`);

--
-- Indexes for table `purchace`
--
ALTER TABLE `purchace`
  ADD PRIMARY KEY (`invoice`),
  ADD UNIQUE KEY `buy_supcode` (`buy_supcode`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_invoice`),
  ADD UNIQUE KEY `sale_custid` (`sale_custid`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`detsale_id`),
  ADD UNIQUE KEY `detsale_inv` (`detsale_inv`,`detsale_barcode`),
  ADD UNIQUE KEY `detslae_barcode` (`detsale_barcode`),
  ADD KEY `detsale_inv_2` (`detsale_inv`,`detsale_barcode`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sp_code`);

--
-- Indexes for table `temppurchase`
--
ALTER TABLE `temppurchase`
  ADD PRIMARY KEY (`detprcs_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prcs_detail`
--
ALTER TABLE `prcs_detail`
  MODIFY `detprcs_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchace`
--
ALTER TABLE `purchace`
  MODIFY `invoice` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_detail`
--
ALTER TABLE `sale_detail`
  MODIFY `detsale_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sp_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temppurchase`
--
ALTER TABLE `temppurchase`
  MODIFY `detprcs_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`pr_uid`) REFERENCES `units` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`pr_ctgid`) REFERENCES `categories` (`ctg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchace`
--
ALTER TABLE `purchace`
  ADD CONSTRAINT `purchace_ibfk_1` FOREIGN KEY (`buy_supcode`) REFERENCES `supplier` (`sp_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`sale_custid`) REFERENCES `customers` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`sale_invoice`) REFERENCES `sale_detail` (`detsale_inv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
