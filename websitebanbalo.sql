-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2022 lúc 06:20 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `websitebanbalo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hoa_don_id` bigint(20) UNSIGNED NOT NULL,
  `san_pham_id` bigint(20) UNSIGNED NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 0,
  `don_gia` double NOT NULL,
  `thanh_tien` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_hoa_don`
--

INSERT INTO `chi_tiet_hoa_don` (`id`, `hoa_don_id`, `san_pham_id`, `so_luong`, `don_gia`, `thanh_tien`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 7, 6, 1, 765000, 765000, '2022-09-10 07:37:02', '2022-09-10 07:37:02', NULL),
(7, 6, 5, 1, 720000, 720000, '2022-09-10 07:17:28', '2022-09-10 07:17:28', NULL),
(6, 6, 6, 2, 765000, 1530000, '2022-09-10 07:17:28', '2022-09-10 07:17:28', NULL),
(12, 11, 6, 2, 765000, 1530000, '2022-11-15 21:23:57', '2022-11-15 21:23:57', NULL),
(11, 10, 3, 2, 540000, 1080000, '2022-11-15 21:20:32', '2022-11-15 21:20:32', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_sp`
--

CREATE TABLE `chi_tiet_sp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `san_pham_id` bigint(20) UNSIGNED NOT NULL,
  `loai_sp_id` bigint(20) UNSIGNED NOT NULL,
  `nha_sx_id` bigint(20) UNSIGNED NOT NULL,
  `ten_sp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_lieu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_ngan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mau_sac` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khoi_luong` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kich_thuoc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tai_trong` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngan_lap` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 0,
  `giam_gia` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `hinh_anh` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_youtube` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new` int(11) NOT NULL DEFAULT 0,
  `tinh_trang` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_sp`
--

INSERT INTO `chi_tiet_sp` (`id`, `san_pham_id`, `loai_sp_id`, `nha_sx_id`, `ten_sp`, `gia`, `chat_lieu`, `so_ngan`, `mau_sac`, `khoi_luong`, `kich_thuoc`, `tai_trong`, `ngan_lap`, `so_luong`, `giam_gia`, `hinh_anh`, `mo_ta`, `link_youtube`, `new`, `tinh_trang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Balo Laptop Sành Điệu AVAR BOP AI751 - Black', '900000', 'Oxford Textile mật độ cao + Polyester fabric', '1 ngăn chính - nhiều ngăn phụ', 'Black', '1.1', '45 x 30 x 15', '15', '15.6', 10, '0', '[\"balo-laptop-mikkor-ralph-red-2 (1).jpg\",\"balo-laptop-mikkor-ralph-red-6.jpg\",\"balo-laptop-mikkor-ralph-red-7.jpg\",\"balo-laptop-mikkor-ralph-red-5.jpg\",\"balo-laptop-mikkor-ralph-red-2.jpg\",\"balo-laptop-mikkor-ralph-red-3.jpg\",\"balo-laptop-mikkor-ralph-red-4.jpg\",\"balo-laptop-mikkor-the-hopkins-black-3.jpg\"]', 'Đẹp và phong cách', NULL, 0, 0, '2021-07-08 08:06:57', '2021-11-12 09:09:08', NULL),
(2, 2, 1, 2, 'Balo Laptop Mikkor Ralph - Navy', '600000', 'Vải hoàn toàn mới chống thấm', '1 ngăn laptop - 1 ngăn chính - nhiều ngăn phụ nhỏ', 'Navy', '0.5', '26 x 12 x 4', '20', '15.6', 0, '20', '[\"balo-laptop-mikkor-ralph-navy-6.jpg\",\"balo-laptop-mikkor-ralph-navy-1.jpg\",\"balo-laptop-mikkor-ralph-navy-5.jpg\",\"balo-laptop-mikkor-ralph-navy-2.jpg\",\"balo-laptop-mikkor-ralph-navy-4.jpg\",\"balo-laptop-mikkor-ralph-navy-3.jpg\"]', 'Đẹp và phong cách', NULL, 0, 0, '2021-07-10 04:08:55', '2021-11-12 04:37:44', NULL),
(3, 3, 1, 2, 'Balo Laptop Mikkor Ralph - Graphite', '600000', 'vải hoàn toàn mới chống thấm', '1 ngăn laptop - 1 ngăn chính - nhiều ngăn phụ nhỏ', 'Graphite', '0.5', '26 x 12 x 40', '20', '15.6', 2, '10', '[\"balo-laptop-mikkor-ralph-d-grey-1.jpg\",\"balo-laptop-mikkor-ralph-d-grey-2.jpg\",\"balo-laptop-mikkor-ralph-d-grey-5.jpg\",\"balo-laptop-mikkor-ralph-d-grey-6.jpg\",\"balo-laptop-mikkor-ralph-d-grey-4.jpg\",\"balo-laptop-mikkor-ralph-d-grey-3.jpg\"]', 'Đẹp và phong cách', NULL, 1, 0, '2021-07-10 04:30:53', '2022-11-15 21:20:32', NULL),
(5, 5, 2, 1, 'Balo Du Lịch SimpleCarry Mattan 6 - Navy', '800000', 'Polyester trượt nước', '1 ngăn lớn và 2 ngăn phụ kiện', 'Navy', '1', '52 x 30 x 20', '35', '18', 4, '10', '[\"balo-du-lich-simplecarry-mattan-6-grey-2.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-1.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-3.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-7.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-6.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-4.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-5.jpg\"]', 'Đẹp và chất', NULL, 0, 0, '2021-07-10 22:54:02', '2022-09-10 07:17:28', NULL),
(6, 6, 2, 1, 'Balo Du Lịch Đa Năng REEYEE - BLACK', '850000', 'Oxford Textile mật độ cao + Polyester fabric', '1 ngăn chính - nhiều ngăn phụ', 'BLACK', '1.2', '52 x 31 x 19', '15', '15.6', 1, '10', '[\"balo-du-lich-da-nang-reeyee-ry1052-1.jpg\",\"balo-du-lich-da-nang-reeyee-ry1052-3.jpg\",\"balo-du-lich-da-nang-reeyee-ry1052-2.jpg\"]', 'Chuẩn', NULL, 1, 0, '2021-07-10 23:01:03', '2022-11-15 21:23:57', NULL),
(7, 7, 1, 2, 'Balo Laptop Sang Trọng MARK RYDEN MR9813 - Black', '800000', 'Oxford Textile mật độ cao + Polyester fabric', '1 ngăn chính - nhiều ngăn phụ', 'Black', '0.75', '43 x 30 x 10', '10', '15.6', 20, '20', '[\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-6.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-1.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-5.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-3.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-8.jpg\"]', 'New', 'Gv5a70e6FDk', 1, 0, '2021-07-16 03:23:23', '2021-11-12 04:38:37', NULL),
(8, 8, 1, 3, 'Balo Laptop Sakos Guardian i14 - Red', '860000', 'Polyester PE PU', '1 ngăn chính - 1 ngăn laptop - nhiều ngăn phụ', 'Red', '1.1', '30x18x44', '15', '15.6', 20, '25', '[\"balo-laptop-sakos-guardian-red-5 (1).png\",\"balo-laptop-sakos-guardian-red-2 (1).png\",\"balo-laptop-sakos-guardian-red-1 (1).png\",\"balo-laptop-sakos-guardian-red-4 (1).png\",\"balo-laptop-sakos-guardian-red-2.png\"]', 'Đẹp và phong cách dành cho sinh viên dùng laptop', NULL, 0, 0, '2021-11-12 04:05:51', '2021-11-12 04:38:59', NULL),
(9, 9, 3, 3, 'Balo Thời Trang Sakos Neo Sparkle USA - Pink', '640000', 'Polyester trượt nước', '1 ngăn chính - 1 ngăn phụ', 'Pink', '0.41', '42x31x13', '10', '14', 20, '0', '[\"balo-thoi-trang-sakos-neo-sparkley-1.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-4.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-2.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-5.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-3.jpg\"]', 'Balo đẹp dành cho nữ và phù hợp với Genz', NULL, 0, 0, '2021-11-12 04:13:06', '2021-11-12 04:38:49', NULL),
(10, 10, 1, 4, 'Balo Laptop SimpleCarry B2B17 i15 - Blue', '590000', 'Polyester trượt nước', '2 ngăn chính - 1 ngăn phụ', 'Blue', '0.7', '28x10x43', '25', '15.6', 20, '0', '[\"balo-laptop-simplecarry-b2b17-i15-navy-1.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-5.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-3.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-2.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-4.jpg\"]', 'Đẹp', NULL, 0, 0, '2021-11-12 04:22:56', '2021-11-12 04:39:22', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chi_tiet_sp_id` bigint(20) UNSIGNED NOT NULL,
  `diem` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_hd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khach_hang_id` bigint(20) UNSIGNED NOT NULL,
  `tong_tien` double NOT NULL,
  `ngay_dat` datetime NOT NULL,
  `dia_chi_nhan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_thuc_thanh_toan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghi_chu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinh_trang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `ma_hd`, `khach_hang_id`, `tong_tien`, `ngay_dat`, `dia_chi_nhan`, `hinh_thuc_thanh_toan`, `ghi_chu`, `tinh_trang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'HD2022-09-10 14:17:28', 54, 2250000, '2022-09-10 14:17:28', 'Phường Linh Đông, Quận Thủ Đức , TP Hồ Chí Minh', NULL, 'OK', 'Đang duyệt', '2022-09-10 07:17:28', '2022-09-10 07:17:28', NULL),
(7, 'HD2022-09-10 14:37:02', 55, 765000, '2022-09-10 14:37:02', 'TP Hồ Chí Minh', NULL, 'aaa', 'Đang duyệt', '2022-09-10 07:37:02', '2022-09-10 07:37:02', NULL),
(8, 'HD2022-11-16 04:14:11', 56, 540000, '2022-11-16 04:14:11', 'Đường Điện Biên Phủ,Phường 26 ,Quận Bình Thạnh,TP Hồ Chí Minh', NULL, 'OK', 'Đang duyệt', '2022-11-15 21:14:11', '2022-11-15 21:14:11', NULL),
(10, 'HD2022-11-16 04:20:32', 57, 1080000, '2022-11-16 04:20:32', 'Đinh Bộ Lĩnh,Phường 25,Bình Thạnh,Tp Hồ Chí Minh', NULL, 'Ok', 'Đang duyệt', '2022-11-15 21:20:32', '2022-11-15 21:20:32', NULL),
(11, 'HD2022-11-16 04:23:57', 56, 1530000, '2022-11-16 04:23:57', 'Phường 25,Bình Thạnh,TP Hồ Chí Minh', NULL, 'OK', 'Đang duyệt', '2022-11-15 21:23:57', '2022-11-15 21:23:57', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vai_tro_id` int(10) UNSIGNED NOT NULL,
  `google_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ten` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gioi_tinh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bi_khoa` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `email`, `password`, `vai_tro_id`, `google_id`, `provider_id`, `provider`, `ten`, `sdt`, `dia_chi`, `gioi_tinh`, `hinh_dai_dien`, `bi_khoa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, 'kq909981@gmail.com', '$2y$10$mbj91xDjD..pQQZkV.ppXOfZGg.h4tYr1QCgJcXuilmFI2Jx1mTcS', 1, NULL, NULL, NULL, 'Nguyễn Khánh', '0343754517', NULL, NULL, NULL, 0, '2022-09-10 07:03:57', '2022-09-10 07:03:57', NULL),
(55, NULL, NULL, 1, NULL, NULL, NULL, 'Nguyễn Khánh', '0182635273', NULL, 'Nam', NULL, 0, '2022-09-10 07:37:02', '2022-09-10 07:37:02', NULL),
(56, '0306181326@caothang.edu.vn', '$2y$10$WjAYiUjfHXTwuraZz5yXaeSUXkSxlVKMVPKvQmacbChFg3.x5s1VS', 1, NULL, NULL, NULL, 'Nguyễn Thành Trung', '0999999999', NULL, NULL, NULL, 0, '2022-11-15 21:13:08', '2022-11-15 21:13:08', NULL),
(57, NULL, NULL, 1, NULL, NULL, NULL, 'Nguyễn Văn Chung', '0971519717', NULL, 'Nam', NULL, 0, '2022-11-15 21:20:32', '2022-11-15 21:20:32', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sp`
--

CREATE TABLE `loai_sp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_sp`
--

INSERT INTO `loai_sp` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Balo Laptop', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(2, 'Balo du lịch', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(3, 'Balo Nữ', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(4, 'Balo Nam', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(5, 'Balo da', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(6, 'Balo chống nước', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(7, 'Túi xách nam', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(8, 'Túi xách nữ', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(9, 'Túi xách du lịch', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(10, 'Túi xách thời trang', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(11, 'Túi xách chống sốc', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(12, 'Túi xách máy ảnh', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(13, 'Vali kéo trẻ em', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(14, 'Vali du lich 7 tấc', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL),
(15, 'Vali du lich 5 tấc', '2021-05-26 10:00:00', '2021-05-26 10:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '2021_04_29_154552_create_khach_hang_table', 1),
(17, '2021_04_29_154842_create_quan_tri_vien_table', 1),
(18, '2021_04_29_171537_add_field_vai_tro_id_of_table_quan_tri_vien', 1),
(19, '2021_04_29_172316_add_field_vai_tro_id_of_table_khach_hang', 1),
(20, '2021_04_29_172856_create_vai_tro_table', 1),
(21, '2021_05_12_222234_create_loai_sp_table', 1),
(22, '2021_05_12_225450_create_nha_san_xuat_table', 1),
(23, '2021_05_12_231414_create_san_pham_table', 1),
(24, '2021_05_12_231437_create_chi_tiet_sp_table', 1),
(25, '2021_05_19_234349_create_chi_tiet_hoa_don', 1),
(26, '2021_05_20_233509_create_hoa_don', 1),
(27, '2021_05_26_154507_create_slide', 1),
(28, '2021_05_26_163435_create_sup_slide', 1),
(29, '2021_06_01_221726_change_data_type_field_mau_sac_table_chi_tiet_sp', 1),
(30, '2021_07_01_214631_create_danh_gia_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nha_san_xuat`
--

CREATE TABLE `nha_san_xuat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nha_san_xuat`
--

INSERT INTO `nha_san_xuat` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AVAR', '2021-07-08 08:03:14', '2021-07-08 08:03:14', NULL),
(2, 'Mikor', '2021-07-08 08:03:26', '2021-07-08 08:03:26', NULL),
(3, 'SAKOS', '2021-11-12 03:58:17', '2021-11-12 03:58:17', NULL),
(4, 'SimpleCarry', '2021-11-12 04:14:35', '2021-11-12 04:14:35', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quan_tri_vien`
--

CREATE TABLE `quan_tri_vien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_tai_khoan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vai_tro_id` int(10) UNSIGNED NOT NULL,
  `ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bi_khoa` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quan_tri_vien`
--

INSERT INTO `quan_tri_vien` (`id`, `ten_tai_khoan`, `mat_khau`, `vai_tro_id`, `ten`, `email`, `sdt`, `bi_khoa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$6e4IgiK6qH047Guh2zOPuOuJXu0vzhXLUN7xiEUmLrAwlAoJuFIMK', 1, 'Quản trị viên', NULL, NULL, 0, '2021-07-08 08:00:23', '2021-07-08 08:00:23', NULL),
(6, 'user', '$2y$10$cz.SISEJdJ9HSHWhjPnDAOHyLXdhUZMlzxcVmKzAFDaDYpYJrBe4K', 2, 'Nguyễn Văn Chung', 'user@gmail.com', '0971518362', 0, '2022-09-10 07:39:40', '2022-09-12 06:59:05', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_sp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id`, `ma_sp`, `hinh_anh`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Balo01', 'balo-laptop-mikkor-ralph-red-2 (1).jpg', '2021-07-08 08:06:57', '2021-07-08 08:06:57', NULL),
(2, 'Balo02', 'balo-laptop-mikkor-ralph-navy-6.jpg', '2021-07-10 04:08:55', '2021-07-10 04:08:56', NULL),
(3, 'Balo03', 'balo-laptop-mikkor-ralph-d-grey-1.jpg', '2021-07-10 04:30:53', '2021-07-10 04:30:53', NULL),
(5, 'Balo04', 'balo-du-lich-simplecarry-mattan-6-grey-2.jpg', '2021-07-10 22:54:02', '2021-07-10 22:54:02', NULL),
(6, 'Balo05', 'balo-du-lich-da-nang-reeyee-ry1052-1.jpg', '2021-07-10 23:01:03', '2021-07-10 23:04:24', NULL),
(7, 'BaloMark', 'balo-laptop-sang-trong-mark-ryden-mr-9813-black-6.jpg', '2021-07-16 03:23:23', '2021-07-16 03:23:24', NULL),
(8, 'Balosakos', 'balo-laptop-sakos-guardian-red-5 (1).png', '2021-11-12 04:05:51', '2021-11-12 04:05:51', NULL),
(9, 'Balosako01', 'balo-thoi-trang-sakos-neo-sparkley-1.jpg', '2021-11-12 04:13:06', '2021-11-12 04:13:06', NULL),
(10, 'BaloSC01', 'balo-laptop-simplecarry-b2b17-i15-navy-1.jpg', '2021-11-12 04:22:56', '2021-11-12 04:22:56', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `link`, `image`, `created_at`, `updated_at`) VALUES
(1, 'http://127.0.0.1:8000/sanpham', 'slide_img_1.png', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(2, 'http://127.0.0.1:8000/sanpham', 'slide_img_3.png', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(3, 'http://127.0.0.1:8000/sanpham', 'kingbag-kratos-1200x628-jpeg.jpg', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(4, 'http://127.0.0.1:8000/sanpham', 'banner509-1200x628.jpg', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(5, 'http://127.0.0.1:8000/sanpham', 'bannerr-mikkorr-thang-5-lon-jpeg.jpg', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(6, 'http://127.0.0.1:8000/sanpham', 'banner-tdl-kingbag-sky.jpg', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(7, 'http://127.0.0.1:8000/sanpham', 'hang-hieu-quang-chau-25-percentage.jpg', '2021-05-26 10:00:00', '2021-05-26 10:00:00'),
(8, 'http://127.0.0.1:8000/sanpham', 'banner-balo-mark-ryden-mr-9405-2.jpg', '2021-05-26 10:00:00', '2021-05-26 10:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vai_tro`
--

CREATE TABLE `vai_tro` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vai_tro`
--

INSERT INTO `vai_tro` (`id`, `ten`, `created_at`, `updated_at`) VALUES
(1, 'Quản trị viên', '2021-07-08 08:00:22', '2021-07-08 08:00:22'),
(2, 'Nhân viên', '2021-07-08 08:00:22', '2021-07-08 08:00:22'),
(3, 'Khách hàng', '2021-07-08 08:00:22', '2021-07-08 08:00:22');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_sp`
--
ALTER TABLE `chi_tiet_sp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khach_hang_email_unique` (`email`);

--
-- Chỉ mục cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nha_san_xuat`
--
ALTER TABLE `nha_san_xuat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quan_tri_vien`
--
ALTER TABLE `quan_tri_vien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vai_tro`
--
ALTER TABLE `vai_tro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_sp`
--
ALTER TABLE `chi_tiet_sp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `nha_san_xuat`
--
ALTER TABLE `nha_san_xuat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `quan_tri_vien`
--
ALTER TABLE `quan_tri_vien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `vai_tro`
--
ALTER TABLE `vai_tro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
