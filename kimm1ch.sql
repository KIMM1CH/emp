-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 11:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kimm1ch`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `name`, `email`, `phone`, `address`) VALUES
(1, 'it111', '123', 'ศราวุธ แสงชาติ', '66040233111@udru.ac.th', '0653049340', '15/4'),
(2, 'it', '111', 'ศราวุธ แสงชาติ', '66040233111@udru.ac.th', '0653049340', '111'),
(3, 'ter', '1234', 'test1', '123ki@udru.ac.th', '0986503834', '125'),
(4, 'kim', '789', 'Messi', 'messi10@gmail.com', '1010101010', '10/10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_price`, `payment_method`, `shipping_address`) VALUES
(1, 'it123', '2025-09-01 11:18:45', 620.00, 'บัตรเครดิต', '15/4'),
(2, 'it111', '2025-09-01 11:40:09', 6460.00, 'เก็บเงินปลายทาง', '15/4'),
(3, 'it111', '2025-09-01 11:40:35', 2300.00, 'โอนเงิน', '1'),
(4, 'it111', '2025-09-01 11:43:53', 620.00, 'โอนเงิน', '1'),
(5, 'it111', '2025-09-01 11:45:10', 4600.00, 'โอนเงิน', '1'),
(6, 'it111', '2025-09-01 11:47:45', 2300.00, 'โอนเงิน', '12'),
(7, 'it111', '2025-09-01 11:49:36', 1240.00, 'โอนเงิน', '1'),
(8, 'it111', '2025-09-01 11:50:56', 4900.00, 'โอนเงิน', '1'),
(9, 'it111', '2025-09-01 11:56:08', 620.00, 'โอนเงิน', '8'),
(10, 'it111', '2025-09-01 12:05:13', 620.00, 'โอนเงิน', '1'),
(11, 'it111', '2025-09-01 12:07:21', 2920.00, 'โอนเงิน', '1'),
(12, 'it111', '2025-09-01 12:17:57', 620.00, 'บัตรเครดิต', '1'),
(13, 'it111', '2025-09-01 12:18:28', 620.00, 'โอนเงิน', '1'),
(14, 'it111', '2025-09-01 12:18:47', 620.00, 'โอนเงิน', '23'),
(15, 'it111', '2025-09-01 12:19:42', 2300.00, 'โอนเงิน', '1'),
(16, 'it111', '2025-09-01 12:28:02', 620.00, 'โอนเงิน', '2'),
(17, 'it111', '2025-09-01 12:28:24', 620.00, 'โอนเงิน', '2'),
(18, 'it111', '2025-09-01 12:29:46', 620.00, 'โอนเงิน', '8'),
(19, 'it111', '2025-09-01 15:12:48', 620.00, 'โอนเงิน', '15/4'),
(20, 'it111', '2025-09-01 15:15:22', 6080.00, 'เก็บเงินปลายทาง', '15/4'),
(21, 'it111', '2025-09-01 15:15:57', 620.00, 'โอนเงิน', '15/4');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`) VALUES
(1, 1, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(2, 2, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 2),
(3, 2, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 3),
(4, 3, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 1),
(5, 4, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(6, 5, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 2),
(7, 6, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 1),
(8, 7, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 2),
(9, 8, 'PK519478', 'ลูกฟุตบอล PUMA Orbita Pro PL Brilliance (FIFA Quality) ', 2600.00, 1),
(10, 8, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 1),
(11, 9, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(12, 10, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(13, 11, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(14, 11, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 1),
(15, 12, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(16, 13, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(17, 14, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(18, 15, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 1),
(19, 16, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(20, 17, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(21, 18, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(22, 19, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(23, 20, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, 1),
(24, 20, 'PK519478', 'ลูกฟุตบอล PUMA Orbita Pro PL Brilliance (FIFA Quality) ', 2600.00, 1),
(25, 20, 'PK184422', 'ลูกฟุตบอล UCL League 23/24 Knockout', 560.00, 1),
(26, 20, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1),
(27, 21, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_id`, `product_name`, `price`, `details`, `image`) VALUES
(1, 'PK184422', 'ลูกฟุตบอล UCL League 23/24 Knockout', 560.00, 'ลูกฟุตบอล', 'img_68903130a1b26.jpg'),
(2, 'PK519478', 'ลูกฟุตบอล PUMA Orbita Pro PL Brilliance (FIFA Quality) ', 2600.00, '-โครงสร้างที่ทนทานเพื่อให้ทนทานต่อการเล่นที่หนักหน่วงและบ่อยครั้ง\n-พื้นผิวที่มีเท็กซ์เจอร์ช่วยเพิ่มการยึดเกาะ การควบคุม และการเคลื่อนที่ของลูกบอล\n-คุณสมบัติการกักเก็บอากาศ มียางในและวาล์ว PUMA Air Lock (PAL) เพื่อการกักเก็บอากาศและการเด้งกลับที่เหนือกว่า\n-FIFA® Quality Pro เพื่อประสิทธิภาพระดับสูงสุด\n-ลูกฟุตบอล Puma', 'img_68903360cfc6b.jpg'),
(3, 'PK549874', 'ลูกบาส Pro 3.0 Official Game', 2300.00, '-สี: Basketball Natural / Black\r\n-โพลียูรีเทน 100%\r\n-สูบลมเพื่อใช้งาน', 'img_6890341975c7e.jpg'),
(4, 'PK293960', 'ลูกบาส Wilson DRV PRO Series No.6', 620.00, 'ลูกบาส', '68a17bf39305c_basb.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
