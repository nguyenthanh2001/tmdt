-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 17, 2022 lúc 05:04 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlgiay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chinhanh`
--

CREATE TABLE `chinhanh` (
  `MACN` int(11) NOT NULL,
  `TENCN` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chinhanh`
--

INSERT INTO `chinhanh` (`MACN`, `TENCN`) VALUES
(1, 'Can Tho city'),
(2, 'Ho Chi Minh city'),
(3, 'Thai Binh city'),
(4, 'Vinh Long city'),
(5, 'vĩnh long'),
(6, 'THÀNH PHỐ VĨNH LONG'),
(7, 'Mai Nhật Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthoadon`
--

CREATE TABLE `cthoadon` (
  `MACTHD` int(11) NOT NULL,
  `MAHD` int(11) NOT NULL,
  `MASIZE` int(11) NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `GIAGIAY` float NOT NULL,
  `TONGGIA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cthoadon`
--

INSERT INTO `cthoadon` (`MACTHD`, `MAHD`, `MASIZE`, `SOLUONG`, `GIAGIAY`, `TONGGIA`) VALUES
(1, 2, 1, 2, 200000, 400000),
(2, 3, 3, 1, 220000, 220000),
(3, 3, 4, 1, 220000, 220000),
(4, 4, 1, 2, 200000, 400000),
(5, 5, 3, 2, 220000, 440000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giay`
--

CREATE TABLE `giay` (
  `MAGIAY` int(11) NOT NULL,
  `TENGIAY` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MOTA` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MALOAI` int(11) NOT NULL,
  `MAHANG` int(11) NOT NULL,
  `MASHOP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giay`
--

INSERT INTO `giay` (`MAGIAY`, `TENGIAY`, `MOTA`, `MALOAI`, `MAHANG`, `MASHOP`) VALUES
(1, 'Adidas Ultra Boost', '', 2, 1, 1),
(2, 'Nike Air Force 1', '', 2, 3, 1),
(3, 'Gucci Princetown Leather', '', 3, 4, 1),
(4, 'Puma One8 Leadcat FTR', '', 4, 2, 1),
(5, 'Thuong dinh', '', 1, 5, 1),
(6, 'Adidas Ultra Boost', '', 2, 1, 2),
(7, 'Nike Air Force 1', '', 2, 3, 2),
(8, 'Gucci Princetown Leather', '', 3, 4, 2),
(9, 'Puma One8 Leadcat FTR', '', 4, 2, 2),
(10, 'Thuong dinh KK14-1', '', 1, 5, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanggiay`
--

CREATE TABLE `hanggiay` (
  `MAHANG` int(11) NOT NULL,
  `TENLOAI` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hanggiay`
--

INSERT INTO `hanggiay` (`MAHANG`, `TENLOAI`) VALUES
(1, 'ADIDAS'),
(2, 'PUMA'),
(3, 'NIKE'),
(4, 'GUCCI'),
(5, 'Bitis');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MAHD` int(11) NOT NULL,
  `NGAYLAP` date NOT NULL,
  `MASHOP` int(11) NOT NULL,
  `MANV` int(11) NOT NULL,
  `MAKH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MAHD`, `NGAYLAP`, `MASHOP`, `MANV`, `MAKH`) VALUES
(2, '2022-03-05', 1, 1, 2),
(3, '2022-03-05', 1, 2, 3),
(4, '2022-03-05', 2, 3, 4),
(5, '2022-03-05', 2, 4, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MAKH` int(11) NOT NULL,
  `TENKH` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SDTKH` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `GIOITINH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MAKH`, `TENKH`, `SDTKH`, `GIOITINH`) VALUES
(1, 'Nguyen Van A', '019412345', 1),
(2, 'Nguyen Van B', '019412346', 0),
(3, 'Nguyen Van C', '019412347', 1),
(4, 'Ly Van An', '0993123412', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaigiay`
--

CREATE TABLE `loaigiay` (
  `MALOAI` int(11) NOT NULL,
  `TENLOAI` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaigiay`
--

INSERT INTO `loaigiay` (`MALOAI`, `TENLOAI`) VALUES
(1, 'Normal'),
(2, 'Sport'),
(3, 'Western shoes'),
(4, 'sandal'),
(5, 'neakers');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MANV` int(11) NOT NULL,
  `TENNV` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SDTNV` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `GIOITINH` int(11) NOT NULL,
  `NGAYVAOLAM` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MANV`, `TENNV`, `SDTNV`, `GIOITINH`, `NGAYVAOLAM`) VALUES
(1, 'Ngo Quoc Thang', '091765543', 1, '2022-02-05'),
(2, 'Mai Nhat Nam', '091765544', 1, '2022-02-02'),
(3, 'Nguyen Thanh Tuan', '091765545', 1, '2022-02-02'),
(4, 'Nguyen Thanh Tu', '091765546', 1, '2022-02-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shop`
--

CREATE TABLE `shop` (
  `MASHOP` int(11) NOT NULL,
  `TENSHOP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DIACHI` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MACN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shop`
--

INSERT INTO `shop` (`MASHOP`, `TENSHOP`, `DIACHI`, `SDT`, `MACN`) VALUES
(1, 'Shop 1', 'Vinh Long city', '0123456789', 4),
(2, 'Shop 2', 'Can Tho city', '0123456788', 1),
(3, 'Shop 3', 'Ho Chi Mi city', '0123456787', 2),
(4, 'Shop 4', 'Thai Binh city', '0123456786', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `MASIZE` int(11) NOT NULL,
  `KICHCO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GIA` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `MAGIAY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`MASIZE`, `KICHCO`, `GIA`, `SOLUONG`, `MAGIAY`) VALUES
(1, '45', '200000', 10, 1),
(2, '46', '200000', 20, 1),
(3, '45', '220000', 10, 2),
(4, '46', '220000', 15, 2),
(5, '41', '230000', 10, 3),
(6, '47', '230000', 20, 3),
(7, '41', '240000', 10, 4),
(8, '47', '240000', 20, 4),
(9, '41', '250000', 10, 5),
(10, '47', '250000', 20, 5),
(11, '41', '260000', 10, 6),
(12, '47', '260000', 20, 6),
(13, '41', '270000', 10, 7),
(14, '47', '270000', 20, 7),
(15, '41', '280000', 10, 8),
(16, '47', '280000', 20, 8),
(17, '41', '290000', 10, 9),
(18, '47', '290000', 20, 9),
(19, '41', '210000', 10, 10),
(20, '47', '210000', 20, 10);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chinhanh`
--
ALTER TABLE `chinhanh`
  ADD PRIMARY KEY (`MACN`);

--
-- Chỉ mục cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD PRIMARY KEY (`MACTHD`),
  ADD KEY `MAHD` (`MAHD`),
  ADD KEY `MASIZE` (`MASIZE`);

--
-- Chỉ mục cho bảng `giay`
--
ALTER TABLE `giay`
  ADD PRIMARY KEY (`MAGIAY`),
  ADD KEY `MASHOP` (`MASHOP`),
  ADD KEY `MALOAI` (`MALOAI`),
  ADD KEY `MAHANG` (`MAHANG`);

--
-- Chỉ mục cho bảng `hanggiay`
--
ALTER TABLE `hanggiay`
  ADD PRIMARY KEY (`MAHANG`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MAHD`),
  ADD KEY `MANV` (`MANV`),
  ADD KEY `MASHOP` (`MASHOP`),
  ADD KEY `MAKH` (`MAKH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MAKH`),
  ADD UNIQUE KEY `SDTKH` (`SDTKH`);

--
-- Chỉ mục cho bảng `loaigiay`
--
ALTER TABLE `loaigiay`
  ADD PRIMARY KEY (`MALOAI`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MANV`),
  ADD UNIQUE KEY `SDTNV` (`SDTNV`);

--
-- Chỉ mục cho bảng `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`MASHOP`),
  ADD UNIQUE KEY `STD` (`SDT`),
  ADD KEY `MACN` (`MACN`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`MASIZE`),
  ADD KEY `MAGIAY` (`MAGIAY`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD CONSTRAINT `cthoadon_ibfk_1` FOREIGN KEY (`MAHD`) REFERENCES `hoadon` (`MAHD`),
  ADD CONSTRAINT `cthoadon_ibfk_2` FOREIGN KEY (`MASIZE`) REFERENCES `size` (`MASIZE`);

--
-- Các ràng buộc cho bảng `giay`
--
ALTER TABLE `giay`
  ADD CONSTRAINT `giay_ibfk_1` FOREIGN KEY (`MASHOP`) REFERENCES `shop` (`MASHOP`),
  ADD CONSTRAINT `giay_ibfk_2` FOREIGN KEY (`MALOAI`) REFERENCES `loaigiay` (`MALOAI`),
  ADD CONSTRAINT `giay_ibfk_3` FOREIGN KEY (`MAHANG`) REFERENCES `hanggiay` (`MAHANG`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`MANV`) REFERENCES `nhanvien` (`MANV`),
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`MAKH`) REFERENCES `khachhang` (`MAKH`);

--
-- Các ràng buộc cho bảng `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`MACN`) REFERENCES `chinhanh` (`MACN`);

--
-- Các ràng buộc cho bảng `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`MAGIAY`) REFERENCES `giay` (`MAGIAY`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
