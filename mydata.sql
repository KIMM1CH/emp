-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 11:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydata`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(3) NOT NULL,
  `d_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `d_name`) VALUES
(1, 'ฝ่ายบุคคล'),
(2, 'ฝ่ายสินเชื่อ'),
(4, 'ฝ่ายขาย'),
(5, 'ฝ่ายจัดซื้อ'),
(6, 'ฝ่ายการเงิน'),
(7, 'ฝ่ายส่งของ');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `emp_title` varchar(20) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_surname` varchar(50) NOT NULL,
  `emp_birthday` date NOT NULL,
  `emp_adr` text NOT NULL,
  `emp_skill` text NOT NULL,
  `emp_tel` varchar(20) NOT NULL,
  `emp_user` varchar(20) NOT NULL,
  `emp_pass` varchar(32) NOT NULL,
  `emp_level` varchar(1) NOT NULL,
  `d_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_title`, `emp_name`, `emp_surname`, `emp_birthday`, `emp_adr`, `emp_skill`, `emp_tel`, `emp_user`, `emp_pass`, `emp_level`, `d_id`) VALUES
(20, 'นางสาว', 'ศิริพร', 'มิตรจิตดี', '2009-05-06', 'จ.ขอนแก่น', 'ขับรถได้', '0956554552', '', '', 'u', 4),
(21, 'นาย', 'ดำรง', 'จิตใจดี', '2020-06-09', 'ราชภัฏเลย', 'ร้องเพลงได้', '0810231232', '', '', 'u', 5),
(22, 'นาย', 'มานพ', 'จิตรดี', '2021-09-26', 'จ.เลย ', 'วาดรูปได้ ', '0850212245', '', '', 'u', 2),
(23, 'นางสาว', 'พรทิพย์', 'ใจดีจังเลย', '2020-02-12', 'อ.ภูเรือ', 'ร้องเพลงได้', '0856231235', '', '', 'u', 1),
(24, 'นาย', 'มาโนชcc', 'จิตแจ่มใสxxx', '2007-10-23', 'จ.เลย', 'วาดรูปได้', '0856365563', 'manoch', '81dc9bdb52d04dc20036dbd8313ed055', 'u', 5),
(33, 'นาย', 'กดเกด', 'เดกเกดเ', '2022-04-15', 'เกดเ', 'กเกดเ', 'เกดเกดเ', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'a', 0),
(36, 'นางสาว', 'ดดด', 'กกกก', '2022-04-21', 'เดกเดก', 'เดเดเดเดfsdfdsfdsfdsfsd', '0214565', 'kris', '81dc9bdb52d04dc20036dbd8313ed055', 'u', 0),
(37, 'นาย', 'สส', 'ดด', '2022-05-07', 'บบบ', 'ยยย', '0254525563', 'sss', '9f6e6800cfae7749eb6c486619254b9c', 'a', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
