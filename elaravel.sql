-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 12:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_content` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `brand_id`, `product_desc`, `product_content`, `product_price`, `product_image`, `product_status`, `created_at`, `updated_at`, `product_name`) VALUES
(9, 6, 2, 'Áo thun nam mới nhất 2025', 'Áo thun nam', '500000', 'tuan96webp', 1, NULL, NULL, 'Áo thun nam'),
(10, 7, 2, 'Áo thun LocalBrand', 'Áo thun LocalBrand', '400000', 'na16d-082723cc-882d-4027-ac10-9bf65bc7dba381webp', 1, NULL, NULL, 'Áo thun LocalBrand'),
(12, 6, 3, 'Áo thun trơn cotton màu Đen', 'Áo thun trơn cotton màu Đen', '235000', 'ao-thun-nam-phim-dien-anh-cam-hoa-tiet-in-the-goby-form-regular__6__0344cd260c8445d1931cc23a39729eb2_master87webp', 1, NULL, NULL, 'Áo thun trơn cotton'),
(13, 7, 4, 'Áo sweater nam nữ', 'Áo sweater nam nữ', '185000', '01f4ff16-4b69-4cb5-87d1-875eb441522086webp', 1, NULL, NULL, 'Áo sweater nam nữ'),
(14, 7, 4, 'Áo thun Mát Phom Rộng Phông Unisex Nam Nữ', 'Áo thun Mát Phom Rộng Phông Unisex Nam Nữ', '365000', '202576webp', 1, NULL, NULL, 'Áo thun Unisex'),
(15, 7, 4, 'Áo thun polo form rộng SUPER', 'Áo thun polo form rộng SUPER', '583000', 'oke61jpg', 1, NULL, NULL, 'Áo thun polo Supper');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
