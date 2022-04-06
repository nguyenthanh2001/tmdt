-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 06, 2022 lúc 12:59 PM
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
-- Cơ sở dữ liệu: `qlbn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anhct`
--

CREATE TABLE `anhct` (
  `maanhct` int(11) NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `mabanh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banh`
--

CREATE TABLE `banh` (
  `mabanh` int(11) NOT NULL,
  `tenbanh` text COLLATE utf8_unicode_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `hinhanh` text COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci NOT NULL,
  `giabanh` float NOT NULL DEFAULT 0,
  `makm` int(11) DEFAULT NULL,
  `maloai_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banh`
--

INSERT INTO `banh` (`mabanh`, `tenbanh`, `soluong`, `hinhanh`, `mota`, `giabanh`, `makm`, `maloai_id`) VALUES
(18, 'Bánh mì Pate chả lụa', 20, 'chưa có', 'Bánh mì gồm pate và chả lụa', 15000, 1, 1),
(19, 'Bánh mì socola', 20, '', 'Bánh mì moka kèm sốt socola mềm thơm còn có hũ sốt socola để chấm cho thêm phần đậm đà.\r\nMột ổ 300g', 50000, NULL, 1),
(20, 'Bánh mì phô mai dâu', 50, '.', 'Bánh mềm nhân creamcheese beo béo lại có dâu thơm dẻo ăn mlem mlem.', 15000, NULL, 1),
(21, 'Bánh bông lan phô mai Nhật', 10, 'k', 'k', 80000, NULL, 5),
(22, 'Bánh mì bơ sữa', 30, 'không', 'Bánh mì bơ sữa thơm ngon đặc biệt\r\nMột hộp 2 bánh', 25000, NULL, 1),
(23, 'Bánh mì lá dứa cốt dừa', 16, 'chưa', 'Một bánh 300g', 45000, NULL, 1),
(24, 'Bánh bông lan cuộn chà bông trứng muối', 10, 'chưa', 'không', 40000, NULL, 5),
(25, 'Bánh bông lan cuộn lá dứa socola', 14, 'không', 'không', 30000, NULL, 5),
(26, 'Bánh kem sẵn mẫu', 2, ',', 'Bánh kem có sẵn mẫu đủ size đủ giá', 0, 1, 6),
(27, 'Bánh bông lan trứng muối lớn', 10, 'c', 'Bánh bông lan trứng muối loại ổ lớn có sẵn', 200000, 1, 5),
(28, 'Bánh mì khô gà', 22, 'gà', 'Bánh mì sấy sa tế mix khô gà bơ cay', 60000, 3, 1),
(29, 'Bánh mì sấy bơ đường', 34, 'đường', 'Bánh mì sấy bơ đường thơm phức', 25000, 3, 1),
(30, 'Bánh mì củ khoai lang', 8, 'khoai lang', 'Bánh mì nhân phô mai hình củ khoai lang thơm ngon, hấp dẫn.', 10000, NULL, 1),
(31, 'Sandwich sữa', 15, 'a', 'Bánh có sữa tươi, không chất bảo quản nên dùng không hết dán kín lại để ngăn mát tủ lạnh, trước khi ăn để ngoài 15 phút hoặc microwave bánh sẽ mềm lại bình thường ạ.\r\nMột túi 13 lát.', 20000, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `makm` int(11) NOT NULL,
  `giatri` int(11) NOT NULL,
  `tenkm` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`makm`, `giatri`, `tenkm`) VALUES
(1, 10, 'Giảm 10%'),
(2, 30, 'Giảm 30%'),
(3, 5, 'Giảm 5%');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaibanh`
--

CREATE TABLE `loaibanh` (
  `maloai` int(11) NOT NULL,
  `tenloai` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaibanh`
--

INSERT INTO `loaibanh` (`maloai`, `tenloai`) VALUES
(1, 'Bánh mỳ'),
(2, 'Bánh Nem'),
(3, 'Bánh bông lan'),
(4, 'Bánh kem'),
(5, 'Bánh bao'),
(6, 'Pizza');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanquyen`
--

CREATE TABLE `phanquyen` (
  `maquyen` int(11) NOT NULL,
  `tenquyen` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phanquyen`
--

INSERT INTO `phanquyen` (`maquyen`, `tenquyen`) VALUES
(1, 'Admin'),
(2, 'Khách Hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizebanh`
--

CREATE TABLE `sizebanh` (
  `masize` int(11) NOT NULL,
  `tensize` text COLLATE utf8_unicode_ci NOT NULL,
  `mabanh` int(11) NOT NULL,
  `gia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizebanh`
--

INSERT INTO `sizebanh` (`masize`, `tensize`, `mabanh`, `gia`) VALUES
(6, '16', 26, 220000),
(7, '18', 26, 250000),
(8, '22', 26, 350000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gioitinh` int(11) NOT NULL,
  `ngaysinh` date NOT NULL,
  `sdt` bigint(20) NOT NULL,
  `diachi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `maquyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `gioitinh`, `ngaysinh`, `sdt`, `diachi`, `maquyen`) VALUES
(2, 'Mai Nhật Nam 3', 'mainhatnam123@gmail.com', NULL, '$2y$10$FKSOGfc52fDDfusKfqs76O0YV3m3W9K2pPuxg6bSAmdEnBXJawa6.', '7Ur2nuUcCVc508tKLG9EUyZnc7hbcvssihF71HVdHE9BZDaDJHUBoOyrbLkM', '2022-03-30 18:48:23', '2022-03-30 18:48:23', 0, '2000-05-26', 794320003, 'vl', 2),
(3, 'Mai Nhật Nam 2', 'mainhatnam23@gmail.com', NULL, '$2y$10$3X8ehBaO151/BEHHhMKn/O9di7p06iOB5m9gasBaLEOvFZJn04Mji', NULL, '2022-03-30 18:49:44', '2022-03-30 18:49:44', 0, '2000-05-26', 794320003, 'Vĩnh Long', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anhct`
--
ALTER TABLE `anhct`
  ADD PRIMARY KEY (`maanhct`),
  ADD KEY `fk_anhct` (`mabanh`);

--
-- Chỉ mục cho bảng `banh`
--
ALTER TABLE `banh`
  ADD PRIMARY KEY (`mabanh`),
  ADD KEY `fk_km` (`makm`),
  ADD KEY `fk_loaibanh` (`maloai_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`makm`),
  ADD UNIQUE KEY `giatri` (`giatri`),
  ADD UNIQUE KEY `tenkm` (`tenkm`) USING HASH;

--
-- Chỉ mục cho bảng `loaibanh`
--
ALTER TABLE `loaibanh`
  ADD PRIMARY KEY (`maloai`),
  ADD UNIQUE KEY `tenloai` (`tenloai`) USING HASH;

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`maquyen`);

--
-- Chỉ mục cho bảng `sizebanh`
--
ALTER TABLE `sizebanh`
  ADD PRIMARY KEY (`masize`),
  ADD KEY `fk_size` (`mabanh`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `quyen` (`maquyen`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anhct`
--
ALTER TABLE `anhct`
  MODIFY `maanhct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `banh`
--
ALTER TABLE `banh`
  MODIFY `mabanh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `makm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaibanh`
--
ALTER TABLE `loaibanh`
  MODIFY `maloai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  MODIFY `maquyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sizebanh`
--
ALTER TABLE `sizebanh`
  MODIFY `masize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anhct`
--
ALTER TABLE `anhct`
  ADD CONSTRAINT `fk_anhct` FOREIGN KEY (`mabanh`) REFERENCES `banh` (`mabanh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `banh`
--
ALTER TABLE `banh`
  ADD CONSTRAINT `fk_km` FOREIGN KEY (`makm`) REFERENCES `khuyenmai` (`makm`),
  ADD CONSTRAINT `fk_loaibanh` FOREIGN KEY (`maloai_id`) REFERENCES `loaibanh` (`maloai`);

--
-- Các ràng buộc cho bảng `sizebanh`
--
ALTER TABLE `sizebanh`
  ADD CONSTRAINT `fk_size` FOREIGN KEY (`mabanh`) REFERENCES `banh` (`mabanh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `quyen` FOREIGN KEY (`maquyen`) REFERENCES `phanquyen` (`maquyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
