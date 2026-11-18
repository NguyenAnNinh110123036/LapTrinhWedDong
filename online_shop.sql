-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2026 at 11:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `useradmin` varchar(20) NOT NULL,
  `passadmin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`useradmin`, `passadmin`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `loai_sach`
--

CREATE TABLE `loai_sach` (
  `maloai` varchar(5) NOT NULL,
  `tenloai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loai_sach`
--

INSERT INTO `loai_sach` (`maloai`, `tenloai`) VALUES
('', ''),
('ML001', 'Du lịch'),
('ML002', 'Xây dựng'),
('ML003', 'Công nghệ thông tin'),
('ML004', 'Văn học'),
('ML005', 'Phát triển bản thân');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `gioitinh` bit(2) NOT NULL,
  `quocgia` varchar(30) NOT NULL,
  `hinhdaidien` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`username`, `password`, `hoten`, `gioitinh`, `quocgia`, `hinhdaidien`) VALUES
('ninhbeta', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Ninh', b'00', 'vn', 'hinhanh/avatar/20261118094900_aeddca86c4f81ecd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `idsach` int(11) NOT NULL,
  `tensach` varchar(100) NOT NULL,
  `tacgia` varchar(100) NOT NULL,
  `mota` text NOT NULL,
  `sotrang` int(11) NOT NULL,
  `dongia` int(11) NOT NULL,
  `hinhsach` text NOT NULL,
  `maloai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`useradmin`);

--
-- Indexes for table `loai_sach`
--
ALTER TABLE `loai_sach`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`idsach`),
  ADD KEY `maloai` (`maloai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `idsach` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `loai_sach` (`maloai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
