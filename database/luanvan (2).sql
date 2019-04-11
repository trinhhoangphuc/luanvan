-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 11, 2019 lúc 09:17 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `luanvan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `bn_ma` mediumint(8) UNSIGNED NOT NULL COMMENT 'mã',
  `bn_hinh` varchar(250) DEFAULT NULL COMMENT 'hình',
  `bn_km` int(10) UNSIGNED DEFAULT NULL COMMENT 'id khuyến mãi',
  `bn_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `bn_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'tạo mới',
  `bn_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`bn_ma`, `bn_hinh`, `bn_km`, `bn_trangThai`, `bn_taoMoi`, `bn_capNhat`) VALUES
(20, '1553437269_semtex.jpg', NULL, 1, '2019-03-24 14:21:10', '2019-03-24 14:21:10'),
(22, '1553437346_slider_item_3_image.jpg', NULL, 1, '2019-03-24 14:22:26', '2019-03-24 14:22:26'),
(23, '1553437430_1552192788_bpi-iso-hd-5-lbs.jpg', NULL, 1, '2019-03-24 14:23:50', '2019-03-24 14:23:50'),
(24, '1553437443_1552192810_cobralab-the-curse-50-servings.jpg', NULL, 1, '2019-03-24 14:24:03', '2019-03-24 14:24:03'),
(25, '1554559656_whey-gold-standard-5-lbs.jpg', NULL, 1, '2019-04-06 14:07:09', '2019-04-06 14:07:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `ctdh_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã chi tiết đơn hàng',
  `dh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'mã đơn hàng khóa ngoại',
  `n_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'nhập mã khóa ngoại',
  `ctdh_soluong` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'số lượng mua',
  `ctdh_donGia` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'đơn giá sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`ctdh_ma`, `dh_ma`, `n_ma`, `ctdh_soluong`, `ctdh_donGia`) VALUES
(2, 2, 37, 1, 1449974),
(4, 4, 36, 1, 1420000),
(9, 6, 43, 1, 1250000),
(10, 6, 42, 1, 2100000),
(11, 7, 36, 1, 1620000),
(12, 7, 44, 3, 100000),
(13, 8, 48, 2, 1200000),
(14, 9, 36, 1, 1620000),
(15, 10, 42, 1, 2100000),
(16, 11, 43, 1, 1250000),
(17, 12, 47, 1, 60000),
(18, 13, 52, 1, 1600000),
(19, 14, 37, 1, 1200000),
(20, 15, 29, 1, 1600000),
(21, 16, 46, 1, 1900000),
(22, 17, 40, 2, 1199996),
(23, 18, 36, 1, 1620000),
(24, 18, 43, 1, 1250000),
(25, 19, 27, 1, 1600000),
(26, 19, 39, 1, 2199974),
(27, 20, 39, 1, 2199974),
(28, 21, 40, 1, 1199996),
(29, 22, 29, 1, 1800000),
(30, 23, 29, 1, 1800000),
(31, 23, 53, 1, 1800000),
(32, 24, 37, 4, 1300000),
(33, 25, 27, 1, 1200000),
(34, 26, 60, 2, 550000),
(35, 27, 39, 1, 1900000),
(36, 27, 56, 1, 550000),
(37, 27, 43, 1, 1250000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethuong`
--

CREATE TABLE `chitiethuong` (
  `cthv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã chi tiết hương vị',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'sản phẩm mã khóa ngoại',
  `hv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã hương vị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethuong`
--

INSERT INTO `chitiethuong` (`cthv_ma`, `sp_ma`, `hv_ma`) VALUES
(155, 37, 6),
(156, 37, 5),
(157, 41, 7),
(158, 42, 10),
(159, 42, 9),
(160, 36, 1),
(161, 43, 11),
(162, 44, 12),
(163, 45, 9),
(164, 45, 6),
(165, 46, 1),
(175, 51, 15),
(176, 51, 14),
(177, 50, 12),
(178, 50, 5),
(179, 49, 13),
(180, 48, 9),
(181, 47, 2),
(182, 47, 1),
(187, 52, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkhuyenmai`
--

CREATE TABLE `chitietkhuyenmai` (
  `ctkm_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã chương trình khuyến mãi',
  `km_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Chương trình # km_ma # km_ten # Mã chương trình khuyến mãi',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Sản phẩm # sp_ma # sp_ten # Mã sản phẩm',
  `kmsp_giaTri` int(10) UNSIGNED DEFAULT NULL COMMENT 'Giá trị khuyến mãi # Giá trị khuyến mãi (giảm tiền/giảm % tiền, số lượng), định dạng: tien;soLuong (soLuong = 0, không giới hạn số lượng)',
  `kmsp_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái # Trạng thái khuyến mãi: 1-ngưng khuyến mãi, 2-có hiệu lực'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietkhuyenmai`
--

INSERT INTO `chitietkhuyenmai` (`ctkm_ma`, `km_ma`, `sp_ma`, `kmsp_giaTri`, `kmsp_trangThai`) VALUES
(11, 2, 37, 1600000, 2),
(12, 2, 42, 1200000, 2),
(13, 2, 48, 1900000, 2),
(15, 2, 50, 1200000, 2),
(16, 2, 51, 1600000, 2),
(17, 2, 46, 1000000, 2),
(18, 3, 36, 1200000, 2),
(19, 3, 37, 1600000, 2),
(20, 3, 41, 1250000, 2),
(21, 3, 42, 1300000, 2),
(22, 3, 43, 1900000, 2),
(23, 3, 44, 900000, 2),
(24, 3, 45, 1000000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietquyen`
--

CREATE TABLE `chitietquyen` (
  `ctq_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã hinh sản phẩm',
  `cv_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'sản phẩm mã khóa ngoại',
  `q_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'hình sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietquyen`
--

INSERT INTO `chitietquyen` (`ctq_ma`, `cv_ma`, `q_ma`) VALUES
(1, 3, 1),
(2, 3, 3),
(3, 3, 5),
(4, 3, 7),
(5, 3, 9),
(26, 4, 1),
(27, 4, 3),
(28, 4, 5),
(29, 4, 7),
(47, 1, 1),
(48, 1, 2),
(49, 1, 3),
(50, 1, 4),
(51, 1, 5),
(52, 1, 6),
(53, 1, 7),
(54, 1, 8),
(55, 1, 9),
(56, 1, 10),
(57, 1, 11),
(58, 1, 12),
(59, 1, 13),
(64, 1, 14),
(65, 1, 15),
(71, 2, 1),
(72, 2, 2),
(73, 2, 3),
(74, 2, 4),
(75, 2, 5),
(76, 2, 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `cv_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'Mã chức vụ: 1-giám đốc, 2-quản trị, 3-quản lý khp, 4-kế toán',
  `cv_ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên chức vụ',
  `cv_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời điểm đầu tiên tạo chức vụ',
  `cv_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời điểm cập nhât chức vụ',
  `cv_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'trạng thái chức vụ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`cv_ma`, `cv_ten`, `cv_taoMoi`, `cv_capNhat`, `cv_trangThai`) VALUES
(1, 'Admin', '2019-01-25 14:58:23', '2019-01-25 14:58:23', 1),
(2, 'Bán hàng', '2019-01-25 14:58:23', '2019-01-25 14:58:23', 1),
(3, 'Kế toán', '2019-01-25 14:58:23', '2019-01-25 14:58:23', 1),
(4, 'Nhập liệu', '2019-01-25 14:58:23', '2019-01-25 14:58:23', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `dg_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Đánh giá mã',
  `dg_sao` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Số sao đánh giá',
  `dg_noiDung` text COMMENT 'nội dung đánh giá',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `kh_ten` varchar(250) DEFAULT NULL COMMENT 'Mã khách hàng',
  `kh_dienThoai` varchar(15) DEFAULT NULL COMMENT 'điện thoại',
  `dg_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'trạng thái đánh giá',
  `dg_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo mới',
  `dg_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`dg_ma`, `dg_sao`, `dg_noiDung`, `sp_ma`, `kh_ten`, `kh_dienThoai`, `dg_trangThai`, `dg_taoMoi`, `dg_capNhat`) VALUES
(1, 5, 'Quá tuyệt vời, Shop phục vụ tận tình, giao hàng nhanh chóng', 36, 'Trịnh Hoàng Phúc', '0368060988', 1, '2019-03-24 14:38:20', '2019-03-29 15:47:38'),
(2, 5, 'Quá tuyệt vời', 44, 'Trịnh Hoàng Phúc', '0368060988', 1, '2019-03-28 04:31:34', '2019-03-29 15:47:10'),
(3, 1, 'Qúa tệ', 48, 'Trịnh Hoàng Phúc', '0368060988', 1, '2019-03-29 14:58:20', '2019-03-29 15:47:11'),
(4, 5, 'Qúa tốt', 37, 'Dương Hoàng Khải', '01236478', 1, '2019-04-01 04:55:50', '2019-04-01 04:55:50'),
(5, 5, '56513', 36, 'Trịnh Hoàng Phúc', '12356', 1, '2019-04-01 07:38:48', '2019-04-01 07:38:48'),
(6, 0, 'sads', 41, 'Trịnh Hoàng Phúc', 'sadasd', 1, '2019-04-03 09:57:14', '2019-04-03 09:57:14'),
(7, 5, '123456789', 52, 'Dương Hoàng Khải', '123456', 1, '2019-04-03 16:30:28', '2019-04-03 16:30:28'),
(8, 2, '132456789', 37, 'Ngọc Quỳnh', '12345645', 1, '2019-04-11 06:05:46', '2019-04-11 06:05:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `dh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'đơn hàng mã',
  `kh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'khách hàng mã(khóa ngoại)',
  `dh_nguoiNhan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'người nhận',
  `dh_diaChi` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'địa chỉ người nhận',
  `dh_dienThoai` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'điện thoại người nhận',
  `dh_daThanhToan` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1 đã thanh toán, 0 chưa',
  `nv_xuLy` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'nhân viên xử lý dh',
  `dh_nguoiXuLy` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'người xử lý',
  `dh_ngayXuLy` datetime DEFAULT NULL COMMENT 'ngày xử lý đơn hàng',
  `dh_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo mới',
  `dh_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `dh_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 chờ duyệt',
  `tt_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'khóa ngoại thanh toán',
  `vc_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'khóa ngoại vận chuyển',
  `vc_gia` bigint(20) UNSIGNED NOT NULL COMMENT 'giá vận chuyển',
  `dh_tongTien` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'tổng tiền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`dh_ma`, `kh_ma`, `dh_nguoiNhan`, `dh_diaChi`, `dh_dienThoai`, `dh_daThanhToan`, `nv_xuLy`, `dh_nguoiXuLy`, `dh_ngayXuLy`, `dh_taoMoi`, `dh_capNhat`, `dh_trangThai`, `tt_ma`, `vc_ma`, `vc_gia`, `dh_tongTien`) VALUES
(2, 16, 'Ngọc Quỳnh', '379N1/9 Nguyễn Văn Cừ, Ninh Kiều, Cần Thơ', '12345645', 1, 6, 'Nhân viên6', '2019-03-25 20:24:20', '2018-02-01 15:00:00', '2019-03-25 13:24:20', 3, 1, 3, 50000, 1499974),
(4, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:24:15', '2018-02-01 15:00:00', '2019-03-25 13:24:15', 3, 1, 2, 30000, 1450000),
(6, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:24:09', '2018-03-02 15:00:00', '2019-03-25 13:24:09', 3, 3, 2, 30000, 3380000),
(7, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:24:04', '2018-04-03 15:00:00', '2019-03-25 13:24:04', 3, 2, 2, 30000, 1750000),
(8, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:23:59', '2018-05-04 15:00:00', '2019-03-25 13:23:59', 3, 3, 2, 30000, 1230000),
(9, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:23:52', '2018-06-05 15:00:00', '2019-03-25 13:23:52', 3, 3, 2, 30000, 1650000),
(10, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:23:47', '2018-08-06 15:00:00', '2019-03-25 13:23:47', 3, 3, 2, 30000, 2130000),
(11, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:23:43', '2018-09-07 15:00:00', '2019-03-25 13:23:43', 3, 3, 2, 30000, 1280000),
(12, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:23:35', '2018-10-08 15:00:00', '2019-03-25 13:23:35', 3, 3, 2, 30000, 90000),
(13, 15, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', '0368060988', 1, 6, 'Nhân viên6', '2019-03-25 20:23:31', '2018-11-09 15:00:00', '2019-03-25 13:23:31', 3, 3, 2, 30000, 1630000),
(14, 15, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', '0368060988', 1, 6, 'Nhân viên6', '2019-03-25 20:23:25', '2018-12-10 15:00:00', '2019-03-25 13:23:25', 3, 3, 2, 30000, 1230000),
(15, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 20:23:22', '2019-02-25 13:19:29', '2019-03-25 13:23:22', 3, 2, 2, 30000, 1630000),
(16, 15, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', '0368060988', 1, 6, 'Nhân viên6', '2019-03-25 20:23:19', '2019-01-25 13:20:03', '2019-03-25 13:23:19', 3, 2, 2, 30000, 1930000),
(17, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 21:28:38', '2019-02-25 14:26:06', '2019-03-25 14:28:38', 3, 3, 2, 30000, 2429992),
(18, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 21:28:43', '2019-02-25 14:26:27', '2019-03-25 14:28:43', 3, 2, 2, 30000, 2900000),
(19, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 6, 'Nhân viên6', '2019-03-25 21:28:46', '2019-03-25 14:26:55', '2019-03-25 14:28:46', 3, 3, 2, 30000, 3829974),
(20, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 3, 'Admin', '2019-03-26 21:59:01', '2019-03-26 07:06:54', '2019-03-26 14:59:01', 3, 1, 2, 30000, 2229974),
(21, 18, 'Tạ Anh Hào 2', '379N1/9 Nguyễn Văn Cừ, Ninh Kiều, Cần Thơ 2', '12345432', 1, 3, 'Admin', '2019-03-28 16:35:39', '2019-03-28 04:35:32', '2019-03-28 09:35:39', 3, 1, 2, 30000, 1229996),
(22, 14, 'Trịnh Hoàng Phúc', '39 Nguyễn Đình Chiễu', '14608', 1, 3, 'Admin', '2019-03-30 20:49:07', '2019-03-30 13:48:47', '2019-03-30 13:49:07', 3, 2, 2, 30000, 1830000),
(23, 16, 'Ngọc Quỳnh', '379N1/9 Nguyễn Văn Cừ, Ninh Kiều, Cần Thơ', '12345645', 1, 3, 'Admin', '2019-04-03 16:19:07', '2019-04-01 04:57:25', '2019-04-03 09:19:07', 3, 1, 2, 30000, 3630000),
(24, 19, 'Tạ Anh Hào', '56132', '12356', 1, 3, 'Admin', '2019-04-04 21:14:12', '2019-04-01 07:44:19', '2019-04-04 14:14:12', 3, 1, 2, 30000, 5230000),
(25, 20, 'Hứa Xướng Điền', '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', '0553123489', 1, 3, 'Admin', '2019-04-07 22:08:09', '2019-04-07 08:00:33', '2019-04-07 15:08:09', 3, 1, 2, 30000, 1230000),
(26, 20, 'Hứa Xướng Điền', '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', '0553123489', 1, NULL, NULL, NULL, '2019-04-09 15:54:53', '2019-04-09 15:54:53', 0, 1, 2, 30000, 1130000),
(27, 16, 'Ngọc Quỳnh', '379N1/9 Nguyễn Văn Cừ, Ninh Kiều, Cần Thơ', '0123456894', 0, NULL, NULL, NULL, '2019-04-11 06:03:45', '2019-04-11 06:03:46', 0, 2, 2, 30000, 3730000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hang`
--

CREATE TABLE `hang` (
  `h_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã hãng',
  `h_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'hãng tên',
  `h_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'hãng tạo mới',
  `h_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'hãng cập nhật',
  `h_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'hãng trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hang`
--

INSERT INTO `hang` (`h_ma`, `h_ten`, `h_taoMoi`, `h_capNhat`, `h_trangThai`) VALUES
(8, 'BPI', '2019-03-01 06:29:38', '2019-03-01 06:29:38', 1),
(9, 'Nutrabolics', '2019-03-01 08:23:40', '2019-03-01 08:23:40', 1),
(10, 'MyProtein', '2019-03-02 07:56:13', '2019-03-02 07:56:43', 1),
(11, 'Dymatize', '2019-03-02 13:46:03', '2019-03-02 13:46:03', 1),
(12, 'Betancourt Nutrition', '2019-03-02 13:55:06', '2019-03-02 13:55:06', 1),
(13, 'San Nutrition USA', '2019-03-24 14:13:22', '2019-03-24 14:13:22', 1),
(14, 'Optimum Nutrition', '2019-03-24 14:30:10', '2019-03-24 14:30:10', 1),
(15, 'Muscletech', '2019-03-25 04:52:10', '2019-03-25 04:52:10', 1),
(16, 'MusclePharm', '2019-03-25 05:31:10', '2019-03-25 05:31:10', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanh`
--

CREATE TABLE `hinhanh` (
  `ha_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã hinh sản phẩm',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'sản phẩm mã khóa ngoại',
  `ha_stt` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'hình sản phẩm',
  `ha_ten` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'hình ảnh tên'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhanh`
--

INSERT INTO `hinhanh` (`ha_ma`, `sp_ma`, `ha_stt`, `ha_ten`) VALUES
(88, 36, 1, '36_1_78173_labrada-muscle-mass-gainer-12-lbs.jpg'),
(89, 36, 2, '36_2_28234_labrada-muscle-mass-gainer-12-lbs.jpg'),
(91, 41, 1, '41_1_3765_mass-effect-revolution-13-lbs-5-9kg.jpg'),
(92, 41, 2, '41_2_99822_mass-effect-revolution-13-lbs-5-9kg.jpg'),
(93, 42, 1, '42_1_29447_whey-gold-standard-5lbs-2-27kg.jpg'),
(94, 42, 2, '42_2_22545_whey-gold-standard-5lbs-2-27kg.jpg'),
(95, 43, 1, '43_1_85472_mass-tech-extreme-2000-loai-22lbs-10kg.jpg'),
(96, 43, 2, '43_2_34022_mass-tech-extreme-2000-loai-22lbs-10kg.jpg'),
(97, 44, 1, '44_1_42959_muscletech-mass-tech-7lbs.jpg'),
(98, 44, 2, '44_2_69584_muscletech-mass-tech-7lbs.jpg'),
(99, 45, 1, '45_1_66696_optimum-pro-gainer-10-lbs-4-62kg.jpg'),
(100, 45, 2, '45_2_24209_optimum-pro-gainer-10-lbs-4-62kg.jpg'),
(101, 46, 1, '46_1_37886_super-mass-5-4kg-tang-can-nhanh.jpg'),
(102, 46, 2, '46_2_31768_super-mass-5-4kg-tang-can-nhanh.jpg'),
(103, 47, 1, '47_1_26850_serious-mass-6-lbs-2-72kg.jpg'),
(104, 47, 2, '47_2_36741_serious-mass-6-lbs-2-72kg.jpg'),
(105, 48, 1, '48_1_24250_nitrotech-whey-gold-8lbs.jpg'),
(106, 48, 2, '48_2_73133_nitrotech-whey-gold-8lbs.jpg'),
(107, 49, 1, '49_1_79950_combat-crunch-bar-an-lien.jpg'),
(108, 49, 2, '49_2_64221_combat-crunch-bar-an-lien.jpg'),
(109, 50, 1, '50_1_50007_combat-100-whey-5lbs.jpg'),
(110, 50, 2, '50_2_17169_combat-100-whey-5lbs.jpg'),
(111, 51, 1, '51_1_89621_on-isolate-5lbs.jpg'),
(112, 51, 2, '51_2_46197_on-isolate-5lbs.jpg'),
(117, 52, 1, '52_1_65536_iso-100-isolate-100-5-lbs-2-27kg.png'),
(118, 52, 2, '52_2_40962_iso-100-isolate-100-5-lbs-2-27kg.png'),
(119, 52, 3, '52_3_24965_iso-100-isolate-100-5-lbs-2-27kg.png'),
(120, 52, 4, '52_4_39123_iso-100-isolate-100-5-lbs-2-27kg.png'),
(121, 52, 5, '52_5_41489_iso-100-isolate-100-5-lbs-2-27kg.png'),
(122, 52, 6, '52_6_57599_iso-100-isolate-100-5-lbs-2-27kg.png'),
(123, 52, 7, '52_7_74315_iso-100-isolate-100-5-lbs-2-27kg.png'),
(124, 52, 8, '52_8_25427_iso-100-isolate-100-5-lbs-2-27kg.png'),
(125, 52, 9, '52_9_86278_iso-100-isolate-100-5-lbs-2-27kg.png'),
(126, 52, 10, '52_10_87627_iso-100-isolate-100-5-lbs-2-27kg.png'),
(127, 52, 11, '52_11_72297_iso-100-isolate-100-5-lbs-2-27kg.png'),
(128, 52, 12, '52_12_55550_iso-100-isolate-100-5-lbs-2-27kg.png'),
(129, 52, 13, '52_13_22315_iso-100-isolate-100-5-lbs-2-27kg.png'),
(130, 52, 14, '52_14_55221_iso-100-isolate-100-5-lbs-2-27kg.png'),
(131, 52, 15, '52_15_10768_iso-100-isolate-100-5-lbs-2-27kg.png'),
(132, 52, 16, '52_16_30685_iso-100-isolate-100-5-lbs-2-27kg.png'),
(133, 52, 17, '52_17_84865_iso-100-isolate-100-5-lbs-2-27kg.png'),
(134, 52, 18, '52_18_13990_iso-100-isolate-100-5-lbs-2-27kg.png'),
(135, 52, 19, '52_19_71913_iso-100-isolate-100-5-lbs-2-27kg.png'),
(136, 52, 20, '52_20_20191_iso-100-isolate-100-5-lbs-2-27kg.png'),
(137, 52, 21, '52_21_18258_iso-100-isolate-100-5-lbs-2-27kg.png'),
(138, 52, 22, '52_22_21187_iso-100-isolate-100-5-lbs-2-27kg.png'),
(139, 52, 23, '52_23_79997_iso-100-isolate-100-5-lbs-2-27kg.png'),
(140, 52, 24, '52_24_45369_iso-100-isolate-100-5-lbs-2-27kg.png'),
(141, 52, 25, '52_25_39468_iso-100-isolate-100-5-lbs-2-27kg.png'),
(142, 52, 26, '52_26_36726_iso-100-isolate-100-5-lbs-2-27kg.png'),
(143, 52, 27, '52_27_1998_iso-100-isolate-100-5-lbs-2-27kg.png'),
(144, 37, 1, '37_1_1293_nutrabolics-hydropure-4-5-lbs.jpg'),
(145, 37, 2, '37_2_54981_nutrabolics-hydropure-4-5-lbs.jpg'),
(146, 37, 3, '37_3_54203_nutrabolics-hydropure-4-5-lbs.jpg'),
(147, 37, 4, '37_4_78487_nutrabolics-hydropure-4-5-lbs.jpg'),
(148, 53, 1, '53_1_64646_dymatize-omega-3-fish-oil.jpg'),
(149, 53, 2, '53_2_7352_dymatize-omega-3-fish-oil.jpg'),
(150, 54, 1, '54_1_44209_dymatize-cla-90-vien.jpg'),
(151, 54, 2, '54_2_91837_dymatize-cla-90-vien.jpg'),
(152, 55, 1, '55_1_60374_dymatize-creatine-300g.jpg'),
(153, 55, 2, '55_2_37881_dymatize-creatine-300g.jpg'),
(154, 56, 1, '56_1_42980_muscletech-nitrotech-ripped-4lbs.jpg'),
(155, 56, 2, '56_2_20755_muscletech-nitrotech-ripped-4lbs.jpg'),
(156, 57, 1, '57_1_72248_best-creatine-50-servings.jpg'),
(157, 57, 2, '57_2_45572_best-creatine-50-servings.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `huongvi`
--

CREATE TABLE `huongvi` (
  `hv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'Mã hương vị',
  `hv_ten` varchar(100) NOT NULL COMMENT 'Hương vị tên',
  `hv_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `hv_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'tạo mới',
  `hv_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'cập ngật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `huongvi`
--

INSERT INTO `huongvi` (`hv_ma`, `hv_ten`, `hv_trangThai`, `hv_taoMoi`, `hv_capNhat`) VALUES
(1, 'Chocolate', 1, '2019-02-16 14:24:01', '2019-02-16 14:24:01'),
(2, 'Banana', 1, '2019-02-16 14:24:34', '2019-02-16 14:24:34'),
(5, 'chocolate & cookie', 1, '2019-02-16 14:27:26', '2019-02-16 14:27:26'),
(6, 'Strawberry', 1, '2019-02-17 05:08:35', '2019-02-17 05:08:35'),
(7, 'Bean & Chocolate', 1, '2019-02-17 07:29:10', '2019-02-17 07:29:10'),
(8, 'Watermelon ice', 1, '2019-02-18 05:19:35', '2019-02-18 05:19:35'),
(9, 'Double Rich Chocolat', 1, '2019-03-24 14:27:57', '2019-03-24 14:27:57'),
(10, 'Cookies & Cream', 1, '2019-03-24 14:28:55', '2019-03-24 14:28:55'),
(11, 'Tripple Chocolate Brownie', 1, '2019-03-25 04:52:26', '2019-03-25 04:52:26'),
(12, 'Milk Chocolate', 1, '2019-03-25 04:57:35', '2019-03-25 04:57:35'),
(13, 'Chocolate Raspberry', 1, '2019-03-25 05:31:42', '2019-03-25 05:31:42'),
(14, 'Vanilla SoftServe', 1, '2019-03-25 05:49:27', '2019-03-25 05:49:27'),
(15, 'Chocolate Shake', 1, '2019-03-25 05:49:46', '2019-03-25 05:49:46'),
(17, 'Strawberry Cream', 1, '2019-04-03 09:52:57', '2019-04-03 09:52:57'),
(18, 'Không vị', 1, '2019-04-09 15:21:43', '2019-04-09 15:21:43'),
(19, 'Chocolate Fudge Brownie', 1, '2019-04-09 15:37:07', '2019-04-09 15:37:07'),
(20, 'Snow Cone', 1, '2019-04-09 15:45:34', '2019-04-09 15:45:34'),
(21, 'Icy Blue Razz', 1, '2019-04-09 15:45:45', '2019-04-09 15:45:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `kh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'khách hàng mã',
  `kh_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'khách hàng email',
  `kh_matKhau` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'khách hàng mật khẩu mã hóa MD5',
  `kh_hoTen` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'khách hàng tên',
  `kh_gioiTinh` tinyint(4) DEFAULT '1' COMMENT '1 là nam, 0 là nữ',
  `kh_diaChi` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'khách hàng địa chỉ',
  `kh_hinh` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hình ảnh',
  `kh_dienThoai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'khách hàng điện thoại',
  `kh_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày khởi tạo',
  `kh_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `kh_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 là khóa, 2 là khả dụng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`kh_ma`, `kh_email`, `kh_matKhau`, `kh_hoTen`, `kh_gioiTinh`, `kh_diaChi`, `kh_hinh`, `kh_dienThoai`, `kh_taoMoi`, `kh_capNhat`, `kh_trangThai`) VALUES
(14, 'thphucct@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Trịnh Hoàng Phúc', 1, '39 Nguyễn Đình Chiễu', '1553506000_whey-gold-standard-5lbs-2-27kg (1).jpg', '14608', '2019-03-02 06:31:13', '2019-03-29 14:59:18', 1),
(15, 'thphucct@gmail.com24', 'e10adc3949ba59abbe56e057f20f883e', 'Trịnh Hoàng Phúc', 1, '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', 'user.png', '0368060988', '2019-03-24 14:58:15', '2019-03-24 14:58:15', 1),
(16, 'quynh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ngọc Quỳnh', 0, '379N1/9 Nguyễn Văn Cừ, Ninh Kiều, Cần Thơ', '1554962707_best-creatine-50-servings.jpg', '0124568789', '2019-03-24 14:59:05', '2019-04-11 06:05:07', 1),
(17, 'khai@gmail.xn--comew-hrb', '0454edcacc3fe67e5a43b20adabc6971', 'Dương Hoàng Khải', 1, 'Quảng Trọng Hoàn, Ninh Kiều, Cần Thơ', 'user.png', '0368068', '2019-03-25 12:38:56', '2019-03-25 12:38:56', 1),
(18, 'hao@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Tạ Anh Hào', 1, '379N1/9 Nguyễn Văn Cừ, Ninh Kiều, Cần Thơ', 'user.png', '123454', '2019-03-28 04:34:04', '2019-03-28 04:34:04', 1),
(19, 'thphucc2t@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tạ Anh Hào', 1, '56132', 'user.png', '12356', '2019-04-01 07:32:23', '2019-04-01 07:32:23', 1),
(20, 'dien@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hứa Xướng Điền', 1, '39 Nguyễn Đình Chiễu, K1, P4, tp. Sóc Trăng', '1554558691_whey-gold-standard-5lbs-2-27kg (1).jpg', '0553123489', '2019-04-06 13:50:57', '2019-04-06 13:51:31', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `km_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã chương trình khuyến mãi',
  `km_ten` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên chương trình # Tên chương trình khuyến mãi',
  `km_moTaNgan` text COLLATE utf8mb4_unicode_ci COMMENT 'Mô tả ngắn',
  `km_noiDung` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Thông tin chi tiết # Nội dung chi tiết chương trình khuyến mãi',
  `km_batDau` datetime NOT NULL COMMENT 'Thời điểm bắt đầu # Thời điểm bắt đầu khuyến mãi',
  `km_ketThuc` datetime DEFAULT NULL COMMENT 'Thời điểm kết thúc # Thời điểm kết thúc khuyến mãi',
  `nv_nguoiLap` smallint(5) UNSIGNED NOT NULL COMMENT 'Lập kế hoạch # nv_ma # nv_hoTen # Mã nhân viên (người lập chương trình khuyến mãi)',
  `km_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm tạo # Thời điểm đầu tiên tạo chương trình khuyến mãi',
  `km_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm cập nhật # Thời điểm cập nhật chương trình khuyến mãi gần nhất',
  `km_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái # Trạng thái chương trình khuyến mãi: 1-ngưng khuyến mãi, 2-lập kế hoạch, 3-ký nháy, 4-duyệt kế hoạch'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`km_ma`, `km_ten`, `km_moTaNgan`, `km_noiDung`, `km_batDau`, `km_ketThuc`, `nv_nguoiLap`, `km_taoMoi`, `km_capNhat`, `km_trangThai`) VALUES
(2, 'SALE mừng Quốc tế phụ nữ 08/03/2019', '✅Đối với một người đàn ông thành đạt hay ít nhất là 1 người đàn ông trưởng thành. Việc được quan tâm và tặng quà người mẹ, người chị và người ấy của mình là 1 vinh dự và hạnh phúc. Không chỉ người được nhận quà vui, mà chính chúng ta, cũng cảm thấy hạnh phúc khi được tặng quà. Nhưng không phải anh em nào cũng có thể lựa chọn món quà khiến nửa kia hài lòng. AD tự nhận mình là 1 người lãng mạn, tâm lý sẽ tư vấn cho anh em những món quà khiến chắc chắn anh em sẽ nhận được nụ cười hạnh phúc từ người ấy.', '<p>🎁🎁🎁M&Oacute;N QU&Agrave; &Yacute; NGHĨA NHẤT CHẮC CHẮN SẼ L&Agrave;M NỬA KIA CỦA BẠN MỈM CUỜI.<img src=\"https://bizweb.dktcdn.net/100/011/344/files/banner-2.jpg?v=1551943553883\" style=\"height:360px; width:1000px\" /></p>\n\n<p>✅Đối với một người đ&agrave;n &ocirc;ng th&agrave;nh đạt hay &iacute;t nhất l&agrave; 1 người đ&agrave;n &ocirc;ng trưởng th&agrave;nh. Việc được quan t&acirc;m v&agrave; tặng qu&agrave; người mẹ, người chị v&agrave; người ấy của m&igrave;nh l&agrave; 1 vinh dự v&agrave; hạnh ph&uacute;c. Kh&ocirc;ng chỉ người được nhận qu&agrave; vui, m&agrave; ch&iacute;nh ch&uacute;ng ta, cũng cảm thấy hạnh ph&uacute;c khi được tặng qu&agrave;. Nhưng kh&ocirc;ng phải anh em n&agrave;o cũng c&oacute; thể lựa chọn m&oacute;n qu&agrave; khiến nửa&nbsp;kia h&agrave;i l&ograve;ng. AD tự nhận m&igrave;nh l&agrave; 1 người l&atilde;ng mạn, t&acirc;m l&yacute; sẽ tư vấn cho anh em những m&oacute;n qu&agrave; khiến chắc chắn anh em sẽ nhận được nụ cười hạnh ph&uacute;c từ người ấy.</p>\n\n<p>1️⃣COMBO Tăng cơ - giảm mỡ<br />\nISO Surge 1.6 Lbs: sản phẩm bổ sung Protein cao cấp. 100% Whey Isolate &amp; Hydrolyzed sẽ l&agrave;m n&agrave;ng cực ph&ecirc; với hương vị ngon tuyệt, c&ugrave;ng chất lượng tuyệt vời của 1 sản phẩm cao cấp.&nbsp;<br />\nON Opti-women: vitamin đa kho&aacute;ng gi&agrave;nh ri&ecirc;ng cho nữ giới, sẽ gi&uacute;p cải thiện sức đề kh&aacute;ng, n&acirc;ng cao khả năng trao đổi chất, v&agrave; đặc biệt cần v&agrave;o những ng&agrave;y đ&egrave;n đỏ.<br />\nCombo hỗ trợ chị em trong qu&aacute; tr&igrave;nh tập luyện, mục ti&ecirc;u l&agrave; v&oacute;c d&aacute;ng thon gọn v&agrave; săn chắc.</p>\n\n<p>2️⃣Combo Duy tr&igrave; tuổi Thanh Xu&acirc;n.<br />\nTuổi thanh xu&acirc;n, thứ một đi kh&ocirc;ng bao giờ trở lại. Thế nhưng bằng combo Astaxanthin v&agrave; D3, chị em c&oacute; thể lưu giữ lại l&acirc;u nhất, qu&atilde;ng thời gian đẹp nhất của m&igrave;nh.&nbsp;<br />\nMặc d&ugrave; combo n&agrave;y quan trọng với bất cứ ai, nhưng với chị em, t&aacute;c dụng của sản phẩm l&agrave; v&ocirc; c&ugrave;ng to lớn. Bằng khả năng chống oxy ho&aacute; cực mạnh, gấp nhiều lần so với c&aacute;c sản phẩm kh&aacute;c, c&ugrave;ng sự kết hợp D3 sẽ gi&uacute;p tăng sức khoẻ xương, khớp, c&ugrave;ng v&ocirc; v&agrave;n những lợi &iacute;ch kh&aacute;c. Sẽ gi&uacute;p chị em duy tr&igrave; tuổi thanh xu&acirc;n v&agrave; sức khoẻ vốn c&oacute;. Đ&acirc;y được xem l&agrave; m&oacute;n qu&agrave; v&ocirc; c&ugrave;ng t&acirc;m l&yacute;.</p>\n\n<p>3️⃣Combo Sức khoẻ tổng thể.<br />\nThay cho v&ograve;ng tay của anh em, sự kết hợp của Vitamin đa kho&aacute;ng gi&agrave;nh ri&ecirc;ng cho nữ giới k&egrave;m FishOil sẽ lu&ocirc;n bảo vệ sức khoẻ của chị em, gia tăng sức đề kh&aacute;ng giảm ốm đau bệnh tật, tăng sức khoẻ của hầu hết c&aacute;c cơ quan. Điều n&agrave;y sẽ khiến chị em c&oacute; sức khoẻ để l&agrave;m nhiều việc hơn, cũng l&agrave; m&oacute;n qu&agrave; v&ocirc; c&ugrave;ng &yacute; nghĩa.</p>\n\n<p>🌟🌟🌟<a href=\"https://www.facebook.com/hashtag/%C4%91%E1%BA%B7c_bi%E1%BB%87t?source=feed_text&amp;epa=HASHTAG&amp;__xts__%5B0%5D=68.ARBJVUB9upvgEbpU5dsp9-w5pCcYE0JgTOKuGCZySN95yIOA_jO3rjwkxhLuxGV7KmXGBl5qd6tZn18yo6jqibEIIlTU9rADjAUPSOMcVIj8YjAeAQsEnYZthCa6Cir0CK4KG8_0PUQGCEowaY-wemaikQcefhJ_pmAQeLttgiAmFP3VlU8jHtSVZKfPoYEq9n_TROtNp1MOhYkCkDEX7_bDTKXVCava2Xv5Fyfi_68sNEkxtoohIbxrHKpzUJYAEimqoq13wtFothtVpHCNpMcMCkxt3Uknsi6ZhG20zdrQuprkbYl94nKkrB8fuoY5Y9li4KCGXGaFEkC4s-HeOPi65g&amp;__tn__=%2ANK-R\">#ĐẶC_BIỆT</a>: Bắt đầu từ 15 giờ 00 ng&agrave;y 07/03/2019 đến hết 23 giờ 59 ng&agrave;y 08/03/2019 Gymstore xin gửi tặng qu&yacute; kh&aacute;ch h&agrave;ng m&atilde; giảm gi&aacute; 10% to&agrave;n bộ c&aacute;c sản phẩm đang b&aacute;n tại website. Khi đặt h&agrave;ng Online tại website&nbsp;<a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.gymstore.vn%2F%3Ffbclid%3DIwAR0twYtYbxBN1O54Mg1iOE14oYTfl3Laxr6FkLfxjYVFEOTnWgJFpPwtORU&amp;h=AT1YbczFx-Nr-tlQMAoDKfDtdi_7CHN0peD8r7FgXNfSK8_jtrXASW9ZuxQg2EiUg8wKjxqnbEk7dRebByLP_lWAPM5BDlRYHYgaaHJbsGEQ2KTaFizLzj7b4Tof6Mod7Kx1VXQdkANe0lY0MKOn2emOmPkI4oWBUieNlJKBIr0-3f8asU1AY0qEeDg_QNRTzIuUi5KcKZe7ikPPSZIUDqlR3_SoCW2W-hKZ_8ZyC5gYHVxKuXY3cAvh0fdj1fmSQXQ1_XfpznTiu33rBgzWGVD_UMzAnyRfjd1CZQ8m2Kxmb3dfxj9qstMrJyAK8f_BS4UlYfdOcsmzmRsRML82vS9P1kfvSCKhpUd0AZ_xO9xLEB2EbW21Gw2LhKsKa_lsa8vnwfT6ctHpK99eC1p-DALt1WuBtEFo5cd_SfrjX05mjWWp26QOKheIc9MwBMC9E6GWHAJ2YCnbipxw8OvaI4oRo6VECUaswoiYfKoKW55xgLD9BF9-QyEKQjI-SFbXPKhC_vsj4fXmuMAYM-De017QYpZIWV1VZD5orKyMqsYNYcH977YfriDUQ9PdZ-eV64cDBsDvKLhNzc6SNgfXobfl6GdhWyBgCFUADqxSVo6j4damefTjT0ZJT_nuGYmedfHBHONmbzw\" target=\"_blank\">www.gymstore.vn</a>, qu&yacute; kh&aacute;ch vui l&ograve;ng điền m&atilde; &quot;WOMENDAY10OFF&quot; để nhận ngay khuyến m&atilde;i. Ch&uacute; &yacute;, m&atilde; giảm gi&aacute; c&oacute; thể kh&ocirc;ng &aacute;p dụng chung với c&aacute;c chương tr&igrave;nh hiện c&oacute; như Freeship hoặc Freegift.</p>\n\n<p>🌺🌺🌺Cuối c&ugrave;ng, Gymstore xin gửi lời ch&uacute;c tr&acirc;n th&agrave;nh nhất tới c&aacute;c b&agrave;, c&aacute;c mẹ, c&aacute;c chị v&agrave; c&aacute;c em. Ch&uacute;c 1 nửa thế giới lu&ocirc;n xinh đẹp, mạnh khoẻ, hạnh ph&uacute;c v&agrave; rạng người nụ cười y&ecirc;u đời.&nbsp;</p>\n\n<p>Xin cảm ơn!</p>', '2019-03-07 00:00:00', '2019-03-30 00:00:00', 6, '2019-03-25 10:04:42', '2019-03-25 10:04:42', 0),
(3, 'Khuyến mãi tháng 4', '-Nhân dịp cá tháng tư shop xin ưu đãi', '<p>- Nh&acirc;n dịp c&aacute; th&aacute;ng tư shop xin ưu đ&atilde;i gi&atilde;m gi&aacute; c&aacute;c sản phẩm&nbsp;</p>', '2019-04-01 00:00:00', '2019-05-01 00:00:00', 3, '2019-04-01 07:24:58', '2019-04-01 07:24:58', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `l_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã loại',
  `l_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'loại tên',
  `l_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại tạo mới',
  `l_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại cập nhật',
  `l_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'loại trangj thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`l_ma`, `l_ten`, `l_taoMoi`, `l_capNhat`, `l_trangThai`) VALUES
(8, 'Whey protein', '2019-03-01 06:28:03', '2019-03-01 06:28:03', 1),
(9, 'Mass Gainer', '2019-03-01 06:28:16', '2019-03-01 06:28:16', 1),
(10, 'BCAA, Glutamine', '2019-03-01 06:28:26', '2019-04-09 15:20:30', 1),
(11, 'Vitamin & khoáng chất', '2019-03-01 06:28:39', '2019-04-09 15:20:02', 1),
(12, 'Phụ kiện', '2019-03-01 06:29:16', '2019-03-01 06:29:16', 1),
(13, 'Pre-workout, Creatine', '2019-03-01 06:29:24', '2019-04-09 15:20:47', 1);

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
(64, '2018_12_19_135129_create_loai_table', 1),
(65, '2018_12_19_135443_create_thanhtoan_table', 1),
(66, '2018_12_19_135504_create_vanchuyen_table', 1),
(67, '2018_12_19_135540_create_khachhang_table', 1),
(68, '2018_12_19_135739_create_chucvu_table', 1),
(69, '2018_12_19_135808_create_hang_table', 1),
(70, '2018_12_19_135924_create_sanpham_table', 1),
(71, '2018_12_19_135943_create_hinhanh_table', 1),
(72, '2018_12_19_135959_create_nhanvien_table', 1),
(73, '2018_12_19_140034_create_donhang_table', 1),
(74, '2018_12_19_140051_create_gopy_table', 1),
(75, '2018_12_19_140125_create_chitietsanpham_table', 1),
(76, '2018_12_19_140146_create_khuyenmai_table', 1),
(77, '2018_12_19_140210_create_chitietkhuyenmai_table', 1),
(78, '2018_12_19_141517_create_diachi_table', 1),
(79, '2018_12_19_153102_create_huongvi_table', 1),
(80, '2019_01_05_142237_create_quyen_table', 1),
(81, '2019_01_05_144412_create_chitietquyen_table', 1),
(82, '2019_01_21_225529_create_nhacungcap_table', 1),
(83, '2019_01_21_225610_create_phieunhap_table', 1),
(84, '2019_01_21_225656_create_chitietnhap_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `ncc_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã nhà cung cấp',
  `ncc_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nhà cung cấp tên',
  `ncc_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email nhà cung cấp',
  `ncc_dienThoai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nhà cung cấp điện thọai',
  `ncc_diaChi` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nhà cung cấp điện thọai',
  `ncc_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'nhà cung cấp tạo mới',
  `ncc_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'nhà cung cấp cập nhật',
  `ncc_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'nhà cung cấp trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `nv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã nhân viên',
  `nv_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nhân viên email',
  `nv_matKhau` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mật khẩu nhân viên',
  `nv_hoTen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'họ và tên',
  `nv_hinh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'hình nhân viên',
  `nv_gioiTinh` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 là nam, 0  là nữ',
  `nv_ngaySinh` date DEFAULT NULL COMMENT 'ngày sinh',
  `nv_diaChi` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'địa chỉ',
  `nv_dienThoai` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'điện thoại',
  `nv_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo mới',
  `nv_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `nv_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `cv_ma` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'quyền mã(khóa ngoại với bảng quyền)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`nv_ma`, `nv_email`, `nv_matKhau`, `nv_hoTen`, `nv_hinh`, `nv_gioiTinh`, `nv_ngaySinh`, `nv_diaChi`, `nv_dienThoai`, `nv_taoMoi`, `nv_capNhat`, `nv_trangThai`, `cv_ma`) VALUES
(3, 'webredshop@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '1554869990_best-creatine-50-servings.jpg', 1, '2018-11-11', '378M9/7A Nguyễn Văn Linh 2', '0368060988', '2019-01-25 14:58:24', '2019-04-10 04:22:47', 1, 1),
(4, 'nvien4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên4', 'user.png', 0, '2018-11-10', 'Omnis.', '13210', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 1),
(5, 'nvien5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên5', 'user.png', 1, '2018-11-10', 'Qui culpa.', '27858', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 1),
(6, 'nvien6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên6', 'user.png', 0, '2018-11-10', 'Est.', '44613', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 2),
(8, 'nvien8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên8', 'user.png', 1, '2018-11-10', 'Eveniet.', '47522', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 3),
(9, 'phuctrinhit@gmail.com', 'f46be7e1fedd1022f389a7ea7d77f1d6', 'sdsf', 'user.png', 1, '2019-02-23', '39 Nguyễn Đình Chiễu', '12334345', '2019-02-23 14:53:44', '2019-02-23 14:53:44', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap`
--

CREATE TABLE `nhap` (
  `n_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'mã',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'sp mã',
  `n_soLuong` int(10) UNSIGNED NOT NULL COMMENT 'sp số lượng',
  `n_soLuongNhap` int(11) UNSIGNED DEFAULT '0' COMMENT 'số lượng nhập',
  `hv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'huongw vij max',
  `n_ngaySX` date DEFAULT NULL COMMENT 'sp ngày sản xuất',
  `n_hanSD` date DEFAULT NULL COMMENT 'sp hạn sử dụng',
  `n_ngayNhap` date DEFAULT NULL COMMENT 'ngày nhập hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhap`
--

INSERT INTO `nhap` (`n_ma`, `sp_ma`, `n_soLuong`, `n_soLuongNhap`, `hv_ma`, `n_ngaySX`, `n_hanSD`, `n_ngayNhap`) VALUES
(27, 36, 48, 0, 1, '2019-03-01', '2022-03-01', '2019-04-03'),
(28, 37, 20, 20, 6, '2019-03-01', '2022-03-01', '2019-04-03'),
(29, 37, 21, 20, 6, '2019-03-01', '2020-03-01', '2019-04-03'),
(35, 41, 30, 0, 7, '2019-03-24', '2024-03-24', '2019-04-03'),
(36, 41, 25, 0, 7, '2019-03-24', '2020-03-24', '2019-04-03'),
(37, 42, 44, 0, 10, '2019-03-24', '2024-03-24', '2019-04-03'),
(38, 42, 50, 0, 9, '2019-03-24', '2024-03-24', '2019-04-03'),
(39, 43, 47, 0, 11, '2019-03-25', '2022-03-25', '2019-04-03'),
(40, 44, 47, 0, 12, '2019-03-25', '2024-03-25', '2019-04-03'),
(41, 45, 90, 0, 9, '2019-03-25', '2024-03-25', '2019-04-03'),
(42, 45, 38, 0, 6, '2019-03-25', '2022-03-25', '2019-04-03'),
(43, 46, 45, 0, 1, '2019-03-25', '2024-03-25', '2019-04-03'),
(44, 47, 49, 0, 2, '2019-03-25', '2024-03-25', '2019-04-03'),
(45, 47, 45, 0, 1, '2019-03-25', '2024-03-25', '2019-04-03'),
(46, 48, 49, 0, 9, '2019-03-25', '2024-03-25', '2019-04-03'),
(47, 49, 98, 0, 13, '2019-03-25', '2024-03-25', '2019-04-03'),
(48, 50, 28, 0, 12, '2019-03-25', '2022-03-25', '2019-04-03'),
(49, 50, 50, 0, 5, '2019-03-25', '2024-03-25', '2019-04-03'),
(50, 51, 50, 0, 15, '2019-03-25', '2021-03-25', '2019-04-03'),
(51, 51, 20, 0, 14, '2019-03-25', '2021-03-25', '2019-04-03'),
(52, 51, 7, 0, 15, '2018-03-25', '2020-03-25', '2019-04-03'),
(53, 37, 9, 9, 5, '2019-04-01', '2021-04-01', '2019-04-03'),
(55, 52, 50, 50, 9, '2019-03-01', '2022-03-01', '2019-04-03'),
(56, 53, 99, 100, 18, '2018-04-09', '2022-04-09', '2019-04-09'),
(57, 54, 100, 100, 18, '2018-04-09', '2022-04-09', '2019-04-09'),
(58, 55, 200, 200, 18, '2017-04-09', '2022-04-09', '2019-04-09'),
(59, 56, 200, 200, 19, '2018-04-09', '2022-04-09', '2019-04-09'),
(60, 57, 98, 100, 21, '2018-04-09', '2022-04-09', '2019-04-09'),
(61, 57, 100, 100, 20, '2018-04-09', '2022-04-09', '2019-04-09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `q_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã quyền',
  `q_ten` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên quyền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`q_ma`, `q_ten`) VALUES
(1, 'Quản lý sản phẩm'),
(2, 'Quản lý loại'),
(3, 'Quản lý thanh toán'),
(4, 'Quản lý vận chuyển'),
(5, 'Quản lý nhà sản xuất'),
(6, 'Quản lý nhân viên'),
(7, 'Quản lý chức vụ'),
(8, 'Quản lý khách hàng'),
(9, 'Quản lý đơn hàng'),
(10, 'Thống kê'),
(11, 'Quản lý khuyến mãi'),
(12, 'Quản lý đánh giá'),
(13, 'Quản lý banner'),
(14, 'Quản lý hương vị\r\n'),
(15, 'Quản lý tin tức');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'mã sản phẩm',
  `sp_ten` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên sản phẩm',
  `sp_giaBan` int(10) UNSIGNED NOT NULL COMMENT 'giá bán',
  `sp_giamGia` int(10) UNSIGNED DEFAULT NULL COMMENT 'giãm  giá',
  `sp_hinh` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'hình sản phẩm',
  `sp_anh360` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ảnh 360 ',
  `sp_thongTin` text COLLATE utf8mb4_unicode_ci COMMENT 'thông tin sản phẩm',
  `sp_danhGia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'đánh giá',
  `sp_soLuong` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'số lượng sản phẩm',
  `sp_tinhTrang` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 là mới, 2 là cũ',
  `sp_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo mới',
  `sp_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `sp_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 là khóa, 2 là khả dụng',
  `l_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã loại (khóa ngoại với bảng loại)',
  `h_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã hãng (khóa ngoại với bảng loại)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_giaBan`, `sp_giamGia`, `sp_hinh`, `sp_anh360`, `sp_thongTin`, `sp_danhGia`, `sp_soLuong`, `sp_tinhTrang`, `sp_taoMoi`, `sp_capNhat`, `sp_trangThai`, `l_ma`, `h_ma`) VALUES
(36, 'Labrada Muscle Mass Gainer 12 LBS', 1600000, 1200000, '36_2_28234_labrada-muscle-mass-gainer-12-lbs.jpg', 0, '<h2>1. Tăng Cân Hay Tăng Cơ? Tăng Nạc Hay Tăng Mỡ?</h2>\n\n<p>Tất nhiên khi chọn mua 1 dòng sản phẩm mass tăng cân người ta sẽ nghĩ ngay thành phần của nó có đáng giá hay không? Nó sẽ giúp mình tăng cân nhiều hay tăng cơ nhiều? Tăng nạc nhiều hay tăng mỡ nhiều. Và hơn 90% dòng mass gainer cao năng lượng (trên 1000 calo trong 1 lần dùng) đều cho 1 kết quả lừa bịp đó là tăng mỡ nhiều hơn tăng cơ và tích nước trong cơ thể tạo cảm giác \"to\". Rõ ràng điều này không tốt nhưng cũng có mặt ích lợi của nó là tạo 1 cảm giác \"lừa dối\" ngọt ngào. Bạn sẽ vui và tự tin hơn khi tăng được vài kg sau những năm dài khó tăng cân. Chỉ có 1 số ít sản phẩm trên thị trường hiện nay cho bạn 2 chữ tăng cân đúng nghĩa và Muscle Mass Gainer của hãng Labrada (còn sở hữu thương hiệu LeanBody) là 1 bước đột phá mạnh vào thị trường sản phẩm tăng cân cao cấp \"TĂNG CÂN NHANH, CƠ NẠC NHIỀU HẠN CHẾ TĂNG MỠ VÀ TÍCH NƯỚC\". Nếu chỉ nhìn vào những con số dinh dưỡng thì bạn sẽ khó phát hiện ra đâu là điểm nổi bật của sản phẩm nếu không có cái nhìn chuyên môn. Nhưng sứ mệnh của Labrada luôn cho ra những sản phẩm Lean Body (thương hiệu Tăng cơ giảm mỡ) từ lúc sáng lập đến ngày hôm nay. Rất đơn giản, mục tiêu của Muscle Mass Gainer mang đến khách hàng sử dụng là&nbsp;<strong>Tăng cân nhanh, tăng cơ, tăng sức mạnh</strong></p>\n\n<h2>2. Tại Sao Phải Dùng Muscle Mass Gainer?</h2>\n\n<p>Đơn giản là với thức ăn tự nhiên bạn không thể nào hấp thu được 1 lượng lớn calo trong thời gian ngắn, chưa kể đến hệ tiêu hóa của bạn phải ì ạch tiêu hóa 1 lượng lớn thức ăn lâu ngày sẽ bị quá tải và sinh ra nhiều bệnh nguy hiểm về đường tiêu hóa. Ăn nhiều mà không hấp thu cũng trở thành 1 vấn đề phổ biến đối với những bạn khó tăng cân, thì lúc này Muscle Mass Gainer là sư chọn lựa tuyệt vời cho mục tiêu tăng cơ, tăng cân nhanh. Hơn thế nữa với thành phần và tỉ lệ dinh dưỡng tối ưu sẽ giúp cho những người chơi thể hình hấp thu tốt nhất, tăng cơ, tăng cân hiệu quả nhất.</p>\n\n<ul>\n	<li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;được thiết kế bới Labrada, 1 thương hiệu tiên phong trong những nghiên cứu sản xuất các sản phẩm cao cấp nhằm mục tiêu&nbsp;<strong>tăng cơ, giảm mỡ</strong>, đột phá những điều gần như là không thể trong lĩnh vực tăng cân.</li>\n	<li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;cho chúng ta 1930calo và 84g protein khi được pha chung với 1 lít sữa tươi nguyên chất.</li>\n	<li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;cho chúng ta dễ dàng hấp thu 1 lượng lớn calo và protein tăng cơ có chất lượng cao nhất với 1 mùi vị tuyệt nhất.</li>\n	<li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;có thể được sử dụng như 1 bữa ăn thay thế (MRP) hay 1 sản phẩm phục hồi sau khi tập, nó chứa nhiều năng lượng với protein xây dựng cơ, carbonhydrate, creatine và nhiều thành phần dưỡng chất quan trọng khác trong đó có Vitamin và khoáng chất.</li>\n	<li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;Chứa 17g BCAA (Branch chain amino axit) giúp bạn phục hồi tốt sau tập luyện, và trở nên to hơn, khỏe hơn, nhanh hơn.</li>\n	<li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;không chứa các thành phần tinh bột rẻ tiền kém chất lượng như: dextrose, sucrose hay corn syrup solids</li>\n</ul>\n\n<p>Muscle Mass Gainer là một sản phẩm tuyệt với danh cho những vận động viên trẻ muốn gia tăng khối lượng protein và chỉ số calo để tăng cân và cơ nhanh nhất, hiệu quả nhất. Nó thật sự là 1 bước đột phá trong dòng sản phẩm protein shake mang về cho bạn 1 diện mạo mới, 1 khối lượng cơ bắp mới.</p>\n\n<p>&nbsp;</p>\n\n<h2>3. Những Ai Cần Dùng Muscle Mass Gainer?</h2>\n\n<p>Muscle Mass Gainer là 1 sản phẩm hướng đến đại đa số người dùng Việt Nam, mọi đối tượng, mọi tầng lớp. Tuy nhiên những đối tượng sau đây được ưu tiên sử dụng:</p>\n\n<ul>\n	<li>&nbsp;Người khó tăng cân, người gầy, người hấp thu kém.</li>\n	<li>&nbsp;Vận động viên thể hình trong gai đoạn xả cơ sau thi đấu</li>\n	<li>&nbsp;Người tập thể hình, GYM, trong giai đoạn bulking, cần tăng cơ</li>\n	<li>&nbsp;Người theo fitness trong giai đoạn 1, giai đoạn xây dựng cơ bắp</li>\n	<li>&nbsp;Người già, người bệnh hấp thu kém, khả năng ăn uống hạn chế (hỏi bác sĩ về liều dùng)</li>\n</ul>\n\n<h2>4. Muscle Mass Gainer Mùi Vị Cực Ngon</h2>\n\n<p>Ngoài tính năng dễ hòa tan với độ mịn cao, Muscle Mass Gainer còn sở hữu 1 mùi vị cực ngon, cực kì dễ uống so với những dòng mass tăng cân khác (thường rất khó hòa tan và mụi vị ngọt rất khó uống). Sản phẩm này đã lần lượt phá vỡ những thành tích trước đó về công nghệ cải tiến mùi vị của các bậc đàn anh. Mang đến 1 sự tự tin và hứng khởi mới dành cho những khách hàng của nó. Giúp bạn có thể chiến đấu lâu dài cùng sản phẩm này trong cuộc chiến \"xóa bỏ quá khứ gầy còm sau lưng\". Để có được sự ngon miệng tuyệt đối khi sử dụng các bạn vui lòng xem qua video hướng dẫn cách pha chế bên dưới.</p>\n\n<h2>5. Muscle Mass Gainer Những Con Số Ấn Tượng</h2>\n\n<p>1930 calo, 84g protein, 17g BCAA + Creatine khi được pha với 1 lít sữa tươi (whole milk) là 1 con số không thể ấn tượng hơn đối với 1 sản phẩm mass gainer tăng cân tăng cơ theo kiểu Lean Body như Muscle Mass Gainer. Nếu bạn 60kg, bạn chỉ cần dùng 2 liều mỗi ngày là có thể tăng cân rồi, nhưng bạn đừng làm thế, hãy dùng sản phẩm này kết hợp với ăn uống bình thường như hằng ngày để có 1 kết quả tốt mà vẫn đảm bảo được thói quen sinh hoạt hằng ngày nhé. Tất nhiên bạn không thể nạp 1 lúc chừng ấy calo, có thể sẽ có 1 sự lãng phí, hay chia làm 2 lần uống để đảm bảo hấp thu tốt nhất. Bên cạnh đó sản phẩm cũng chứa 1 lượng tương đối đầy đủ vitamin và khoáng chất kết hợp, bạn sẽ không sợ thiếu những vi chất dinh dưỡng này trong đời sống hằng ngày.</p>\n\n<h2>6. Cách Sử Dụng Muscle Mass Gainer Hiệu Quả Nhất</h2>\n\n<p>Đối với người mới sử dụng, 7 ngày đầu tiên:</p>\n\n<p>Dùng 1.5 muỗng/lần với 250 ml nước lạnh hoặc nước đun sôi để nguội, để đạt kết quả tăng cân tốt hơn bạn có thể pha sữa với 200ml nước hoa quả hoặc sữa tươi. Một ngày sử dụng 3 lần vào các thời điểm:</p>\n\n<p>Lần 1: Sau ăn sáng 1 giờ.</p>\n\n<p>Lần 2: Trước tập 1 giờ.</p>\n\n<p>Lần 3: Ngay sau tập.</p>\n\n<p>Sang tuần thứ 2 trở đi.</p>\n\n<p>Dùng 3 muỗng/lần với 400 ml nước lạnh hoặc nước đun sôi để nguội, để đạt kết quả tăng cân tốt hơn bạn có thể pha sữa với 300ml nước hoa quả hoặc sữa tươi. Một ngày sử dụng 3 lần vào các thời điểm:</p>\n\n<p>Lần 1: Sau ăn sáng 1 giờ.</p>\n\n<p>Lần 2: Trước tập 1 giờ.</p>\n\n<p>Lần 3: Ngay sau tập.</p>\n\n<p><strong><em>Lưu &nbsp;ý:</em></strong></p>\n\n<p>- Nên lắc bằng bình lắc chuyên dụng, hoặc máy xay sinh tố mới đảm bảo độ tan của sản phẩm.</p>\n\n<p>- Không pha với nước nóng.</p>\n\n<p>- Sử dụng ngay sau khi pha, không để lâu, để tủ lạnh tích trữ.</p>\n\n<p>- Duy trì chế độ ăn như trước khí sử dụng, hoặc ăn bổ sung nếu có thể sẽ giúp tăng cân tốt hơn.</p>\n\n<p>- Sau khi tăng cân đủ, mà không sử dụng sản phẩm, sẽ không bị giảm cân nếu bạn ăn đầy đủ bù thêm dinh dưỡng cho cơ thể.</p>', '5', 48, 1, '2019-03-01 06:34:14', '2019-04-07 08:00:33', 1, 9, 8),
(37, 'Nutrabolics Hydropure, 4.5 Lbs', 1800000, 1600000, '37_1_1293_nutrabolics-hydropure-4-5-lbs.jpg', 0, '<h2><strong>KHOA HỌC BÊN TRONG HYDROPURE</strong></h2>\n\n<p>Hydrolyzation là một quá trình kỹ thuật để loại bỏ các chất béo, lactose và protein predigest để hình thành các chuỗi polypeptide nhỏ của axit amin. Các axit amin này được cơ thể hấp thụ nhanh chóng, giúp thúc đẩy sự phát triển và sửa chữa cơ bắp. Kết quả là nguồn protein đậm đặc nhất được biết đến trong&nbsp;khoa học với hơn 93% protein, 5,9 gam axit amin chuỗi nhánh (BCAAs) và 13 gram axit amin thiết yếu (EAAs) trong mỗi khẩu phần!</p>\n\n<p><strong>Dễ tiêu hóa</strong><br />\nHydrolyzation cũng làm cho chất đạm whey dễ dàng hơn cho cơ thể tiêu hóa và hấp thụ, cung cấp dinh dưỡng tức thời. Nhưng để tăng cường sự hấp thụ, nhóm nghiên cứu của chúng tôi đã tăng cường&nbsp;<a href=\"https://gymstore.vn/nutrabolic\">NUTRABOLICS</a>HYDROPURE ™ với enzyme tiêu hóa protease, amylase và lactase. Điều này cho phép toàn bộ công thức để cung cấp kết quả dinh dưỡng tối đa.</p>\n\n<p><strong>Nói KHÔNG với&nbsp;Amino Spiking</strong><br />\nGiống như tất cả các protein của chúng tôi,&nbsp;<a href=\"https://gymstore.vn/nutrabolics-hydropure-4-5-lbs-68-servings\">HYDROPURE</a>&nbsp;được sản xuất tại cơ sở sản xuất được chính phủ kiểm tra để đảm bảo chất lượng tối đa mà bạn có thể tin tưởng. Công thức này chỉ chứa toàn bộ các nguồn protein không có amino acid bổ sung - chỉ là protein thuần túy với zero amino spiking. Cái gì trong nhãn là những bạn nhận được khi sử dụng sản phẩm.</p>\n\n<p><img data-thumb=\"original\" original-height=\"796\" original-width=\"710\" src=\"https://bizweb.dktcdn.net/100/011/344/files/screen-shot-2018-04-21-at-12-22-27-pm.png?v=1524288180046\" style=\"width: 250px;\" /></p>\n\n<p>Ultrabolics HydroPure được phân phối chính hãng bởi Gymstore Việt Nam, hỗ trợ giảm cân, giảm mỡ hiệu quả, không tác dụng phụ. Miễn phí giao hàng nội thành HN &amp; HCM. Giao hàng toàn quốc.&nbsp;</p>', '4', 49, 1, '2019-03-01 08:26:32', '2019-04-11 06:05:46', 1, 8, 9),
(41, 'Mass Effect Revolution 13 lbs (5.9kg)', 1620000, 1250000, '41_1_3765_mass-effect-revolution-13-lbs-5-9kg.jpg', 0, '<h2><strong>Thành phần dinh dưỡng của Mass effect Revolution</strong></h2>\n\n<p>Là một gymmer điển hình, bạn quan tâm đến chế độ ăn cung cấp đầy đủ chất dinh dưỡng với mong muốn công sức tập luyện bỏ ra phải xứng đáng với lượng calo nạp vào cơ thể. Vậy chắc hẳn bạn biết rằng để có một chế độ ăn hoàn hảo bổ sung tối đa calo phục vụ cơ thể là cả một vấn đề.</p>\n\n<p>Trong&nbsp;<strong>Mass Effect Revolution&nbsp;</strong>có chứa:</p>\n\n<ul>\n	<li>50 grams protein mỗi khẩu phần</li>\n	<li>Chỉ 9 grams đường mỗi khẩu phần</li>\n	<li>Là sự cân bằng hoàn hảo giữa protein đồng hóa và protein chống dị hóa</li>\n	<li>Nguồn carborhydrates dồi dào</li>\n	<li>Hàm chứa whey, sữa và casein protein</li>\n	<li>1,105 calo mỗi khẩu phần</li>\n	<li>5 grams creatine tiêu chuẩn</li>\n</ul>\n\n<p><strong>Mass Effect&nbsp;</strong>vừa là sản phẩm&nbsp;<a href=\"https://www.wheystore.vn/tang-can-nhanh\">hỗ trợ tăng cân nhanh</a><strong>&nbsp;</strong>vừa giúp xây dựng cơ bắp nạc đòi hỏi người tập phải ý thức trong việc bổ sung calo vào cơ thể - đặc biệt khi bạn đang trong tình trạng thiếu cân. Một chế độ ăn nhiều calo có vẻ là dễ nếu như bạn không để tâm mấy đến chất lượng thức ăn, nhưng giữ chế độ ăn khỏe mạnh lại là một chuyện khác, và vội vã áp dụng nó khi không trang bị đầy đủ hiểu biết về dinh dưỡng là một điều không thể.</p>\n\n<p>Ngoài vấn đề giá cả, thời gian và sự tiện lợi cũng đáng để cân nhắc. Không phải tất cả mọi người có thời gian chuẩn bị bữa ăn tại nhà, giữ đồ ăn nóng và ăn đúng bữa.</p>\n\n<h3><strong>Mass Effect -&nbsp;&nbsp;Nguồn cung cấp protein chất lượng</strong></h3>\n\n<p>Với mục đích đảm bảo chất lượng quá trình đồng hóa và chống dị hóa cơ bắp, một nguồn protein chất lượng là cần thiết. Đó là lí do vì sao&nbsp;<strong>Mass Effect</strong>&nbsp;ra đời với Mass Effect OctaPure8 Protein Fusion đem lại lượng protein quang phổ cân bằng.</p>\n\n<p>Sự hết hợp hoàn hảo giữa Whey protein isolate thủy phân hấp thụ nhanh, whey protein isolate, whey protein concentrate và SPI-90 ngay lập tức phục hồi mô cơ tổn thương bằng cách bổ sung dinh dưỡng sau buổi tập, khiến Mass Effect&nbsp;phát huy tối đa tính năng chống dị hóa. Micellar casein, milk protein isolate và calcium casein chậm tiêu hóa, cho phép tăng tối đa hiệu ứng đồng hóa.</p>\n\n<p>Mục tiêu của&nbsp;<strong>sữa tăng cân&nbsp;Effect Mass</strong>&nbsp;là xây dựng cơ bắp nạc thay vì chỉ tăng cơ mỡ, MyoCarb Matrix cam kết hàm chứa nguồn carbohydrates phức được tinh chiết từ tinh thể gạo, tạo nên một sản phẩm gần như không đường cho người sử dụng&nbsp;</p>\n\n<h3><strong>Mass Effect Revolution -&nbsp;Tăng cơ nạc thay vì tăng cơ mỡ</strong></h3>\n\n<p>Tăng cơ bắp không đơn thuần chỉ là tăng lượng cơ nạc mà còn là tăng kích cỡ cơ bắp, đó là lí do vì sao MASS EFFECT REVOLUTION hàm chứa ít nhất 5 grams creatine monohydrate và L-glytamine bổ sung cho mỗi khẩu phần.</p>\n\n<h3><strong>Cách sử dụng</strong>&nbsp;<strong>Mass Effect</strong></h3>\n\n<p>Với sản phẩm&nbsp;<strong>Mass Effect</strong>, WheyStore đưa ra cho bạn gợi ý về cách sử dụng như sau:</p>\n\n<p>Với 8 muỗng (1 serving) của Mass Effect, các bạn có thể chia ra uống làm nhiều lần trong ngày (3-4 lần)</p>\n\n<ul>\n	<li>Sáng - 2 muỗng (cách bữa ăn 2-2,5h)</li>\n	<li>Trước khi đi tập 1h - 2 muỗng</li>\n	<li>Sau tập (10-20ph) - 2 muỗng</li>\n	<li>Tối (trước khi đi ngủ 1-1,5h) - 2 muỗng</li>\n</ul>\n\n<p>Đó là gợi ý mà WheyStore dành cho các bạn, không có một cách uống nào là \"bắt buộc\", các bạn có thể uống khác nhau tùy vào mỗi trường hợp riêng. Pha sữa với nước nguội hoặc nước lạnh, không pha cùng nước nóng</p>\n\n<p>Keywords: Mass Effect Revolution, Mass Effect, Effect Mass</p>', '0', 55, 1, '2019-03-24 14:14:52', '2019-04-01 07:26:08', 1, 9, 13),
(42, 'Whey Gold Standard 5Lbs (2.27KG)', 1449974, 1300000, '42_2_22545_whey-gold-standard-5lbs-2-27kg.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/whey-gold-standard-5lbs-2-27kg.jpg\" style=\"width: 600px;\" /></p>\n\n<p><strong>Whey Gold Standard</strong>&nbsp;là một sản phẩm dinh dưỡng thể hình do hãng Optimum Nutrition sản xuất đang được bán chạy nhất trên thị trường hiện nay. Bởi đây là sản phẩm bổ sung Protein tốt nhất giúp xây dựng cơ bắp nạc tốt nhất.</p>\n\n<p>Sự kết hợp hoàn hảo giữa&nbsp;<strong>Protein Isolate</strong>&nbsp;hấp thụ nhanh và&nbsp;<strong>Protein concentrate</strong>&nbsp;hấp thu chậm đã tạo nên một&nbsp;<strong>Whey Gold Standard&nbsp;</strong>&nbsp;có công dụng tuyệt vời dành riêng cho nhữung người tập thể hình, thể thao.</p>\n\n<h2><strong>Tác dụng tuyệt vời của Whey Gold Standard</strong></h2>\n\n<ul>\n	<li>Bổ sung Protein nguyên chất cho cơ thể để xây dựng cơ bắp nạc</li>\n	<li>Phục hồi cơ bắp nhanh chóng, ngăn chặn suy giảm cơ bắp</li>\n	<li>Giảm suy nhược cơ bắp sau khi tập luyện</li>\n	<li>Tăng tỷ lệ trao đổi chất trong cơ thể</li>\n	<li>Đối với những người đang cần giảm cân và ăn kiêng thì đây là sự lựa chọn tuyệt vời nhất.</li>\n</ul>\n\n<h2><strong>Ưu điểm vượt trội của Gold Standard 100% Whey</strong></h2>\n\n<ul>\n	<li>Là loại Whey dễ hòa tan, có hương vị ngon, dễ uống khi pha cùng với sữa hoặc nước ép hoa quả</li>\n	<li>Cung cấp đầy đủ dưỡng chất cần thiết cho việc phát triển và phục hồi cơ cắp chỉ trong 1 muỗng bao gồm: 24g Protein, 5.5g BCAA và 4g Glutamine</li>\n	<li>Chứa hàm lượng Whey Protein Isolate – WPI nguyên chất</li>\n</ul>\n\n<h3><strong>Cách dùng&nbsp;Whey Gold</strong></h3>\n\n<p>Để đạt hiệu quả tối đa khi sử dụng&nbsp;<strong>Whey Gold,</strong>&nbsp;các bạn nên uống:</p>\n\n<ul>\n	<li>Sáng 1 lần khi ngủ dậy.</li>\n	<li>Uống sau tập 1 lần.</li>\n</ul>\n\n<p>Lưu ý: Mỗi một lần pha 1 muống với 300ml nước lạnh và uống luôn sau khi pha. Không nên pha sẵn rồi để tủ lạnh sẽ làm mất độ chất của sản phẩm! Bạn cũng có thể kết hợp với sữa tươi không có đường để tạo hương vị.</p>\n\n<p>Để có được một hương vị ngon và dễ uống nhất thì bạn cần phải biết pha chế đúng cách. Các bạn lấy 1 liều dùng Whey Gold và 300ml nước lạnh hoặc sữa tươi không đường hay nước ép hoa quả, sau đó cho vào bình lắc chuyên dụng Shaker đậy nắp lại rồi lắc trong vài giây. Vậy là bạn đã có 1 cốc Whey Gold Standard ngon tuyệt vời rồi !</p>\n\n<h3><strong>Thời gian uống Whey Gold Standard đem lại hiệu quả cao nhất</strong></h3>\n\n<p>Bạn nên uống vào sau khi lúc thức dậy và sau khi tập luyện là tốt nhất. Bởi đây là hai thời điểm&nbsp;<em>“vàng”&nbsp;</em>mà cơ thể cần lượng dưỡng chất nhiều nhất.</p>\n\n<p>Các bạn nên uống ngay sau khi pha, nếu các bạn để quá lâu thì sẽ làm mất tác dụng của Whey Gold Standard.</p>\n\n<p>Keywords: Whey Gold Standard 5Lbs 2 27KG 2018, Whey, Gold, Standard, 5Lbs, 2 27KG , 2018</p>', '0', 94, 1, '2019-03-24 14:32:30', '2019-04-01 07:44:20', 1, 8, 14),
(43, 'Mass Tech Extreme 2000 loại 22lbs 10kg', 2199974, 1900000, '43_2_34022_mass-tech-extreme-2000-loai-22lbs-10kg.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/mass-tech-extreme-2000-loai-20lbs-9kg.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<p>Không những có hàm lượng năng lượng cao để đem lại hiệu quả tăng cân tối ưu, mà còn đem lại giá trị dinh dưỡng cao nhờ có 20 loại vitamin và khoáng chất. Dưỡng chất đa lượng lẫn vi lượng đều có trong MASSTECH EXTREME 2000, có thể nói rằng siêu phẩm&nbsp;<strong>MassTech&nbsp;</strong>này&nbsp;có thể thay thế 1 bữa ăn đầy đủ dưỡng chất. Siêu phẩm này còn cung cấp hơn 10g BCAAs và 10g Glutamine, giúp chống dị hóa, phục hồi và phát triển cơ bắp vượt trội.</p>\n\n<p>Tăng sức mạnh nhờ thành phần&nbsp;chứa 10g Creatine, kích thích cơ bắp hấp thụ các chất dinh dưỡng để mau chóng tăng trưởng. Phải nói rằng trong tất cả sản phẩm tăng cân trước đến nay,&nbsp;<strong>MassTech Extreme</strong>&nbsp;2000 hoàn toàn có thể được gọi là sản phẩm cao cấp nhất, vì quá đầy đủ dưỡng chất và các đơn chất giúp phát triển cơ bắp và chống dị hóa cơ bắp đồng thời&nbsp;<a href=\"https://www.wheystore.vn/tang-can-nhanh\"><strong>hỗ trợ tăng cân nhanh</strong></a>&nbsp;hơn.</p>\n\n<h2><strong>Ưu điểm vượt trội của MassTech Extreme 2000</strong></h2>\n\n<p><strong>MassTech Extreme</strong>&nbsp;<strong>2000</strong>&nbsp;cung cấp nhiều Protein hơn các dòng Mass khác hiện nay trên thị trường. với 80gr Protein chất lượng cao (khi pha với 600ml sữa tách béo), hơn nữa, không như các dòng mass khác trên thị trường, MASS-TECH® EXTREME 2000 cung cấp lượng protein cao cấp như dòng Blend&nbsp; (97% Whey Protein Isolate, Hydolyzed Whey Protein Isolate, Whey Protein Isolate, Whey Protein Concentrate).</p>\n\n<p><strong>MassTech</strong>&nbsp;<strong>2000</strong>&nbsp;cung cấp hơn 400gr Carb (khi pha với 600ml sữa tách béo) carb phức tăng cường bổ sung glycogen phát triển cơ bắp. điều này sẽ giúp creatine dễ dàng vào cơ bắp để đưa cơ thể vào trạng thái đồng hóa protein tốt nhất.</p>\n\n<p><strong>MassTech</strong>&nbsp;cung cấp hơn 2000 kcal (khi pha với 600ml sữa tách béo), mang lại từ nguồn sữa Whey chất lượng cao và dễ dàng tiêu hóa Carb phức.</p>\n\n<p>Không như các đối thủ cạnh tranh khác, các sản phẩm Mass khác chứa rất ít hoặc hầu như không có Creatine,&nbsp;<strong>MassTech Extreme 2000</strong>&nbsp;chứa 10g Creatine để giúp người sử dụng gia tăng sức mạnh và tái tạo ATP dự trữ bị giảm dần trong lúc tập luyện.</p>\n\n<p>Mỗi khẩu phần&nbsp;<strong>MassTech Extreme</strong>&nbsp;2000 (khi pha với 600ml sữa tách béo) vận chuyển 17.8g BCAAs bao gồm 8.2g L-leucine. L-Leucine là axit amin mạnh mẽ nhất trong các axit amin thiết yếu, giúp duy trì đồng hóa Protein.</p>\n\n<p>DỰA TRÊN VIỆN NGHIÊN CỨU CỦA CÁC TRƯỜNG ĐẠI HỌC Ở MỸ</p>\n\n<p>Trong nghiên cứu kéo dài 8 tuần. Việc cung cấp chế độ ăn có giàu protein, chế dộ ăn đó chiếm khoảng 2300 kcal khi đang trong thời gian tập thể hình, bổ sung thêm 2000 kcals từ MASS-TECH® EXTREME 2000, các kết quả được kiểm tra cho ra rằng các đối tượng sử dụng&nbsp;<strong>Mass Extreme</strong>&nbsp;2000 đã tăng 6.8 lbs (2,5kg) cơ nạc.</p>\n\n<h3><strong>MassTech Extreme sử dụng công nghệ lọc tiên tiến</strong></h3>\n\n<p><strong>Tech Extreme</strong>&nbsp;2000 có chứa thành phần Whey Protein (Whey Protein isolate 97%, Whey Protein Isolate, Hydrolyzed Whey Protein) là sản phẩm Mass đầu tiên trên thị trường có chứa những nguồn Protein chất lượng cao chứ không như những sản phẩm khác có chứa quá nhiều tạp chất, kể cả còn lactose trong sản phẩm.</p>\n\n<ul>\n	<li><strong>MassTech Extreme</strong><strong>&nbsp;2000</strong>&nbsp;cung cấp nguồn Protein tinh khiết như vậy sẽ giúp cho người sử dụng hấp thụ nhanh hơn. Dễ dàng xây dựng cơ bắp tốt hơn, nhanh hơn.</li>\n	<li>MassTech Extreme 2000 được sản xuất theo tiêu chuẩn cGMP</li>\n</ul>\n\n<h3><strong>Chất lượng của&nbsp;MassTech Extreme đã được kiểm định</strong></h3>\n\n<p>Mỗi hộp&nbsp;<strong>MassTech Extreme</strong>&nbsp;2000 phải trải qua kiểm tra chất lượng nghiêm ngặt, kiểm tra bởi bên phòng thí nghiệm thứ ba để đảm bảo rằng mỗi hộp đạt tiêu chuẩn chất lượng và tính nhất quán cao nhất.</p>\n\n<h3><strong>Cách dùng MassTech Extreme</strong></h3>\n\n<p>Pha ½ khẩu phần = 3 muỗng &nbsp;với 16 oz – 20 oz (450ml – 600ml) nước lạnh hoặc sữa tươi trong ly hoặc lắc trong shaker. Hoặc theo kinh nghiệm cá nhân thì uống đậm hay nhạt thì người sử dụng có thể tùy ý thêm nhiều nước hơn.</p>\n\n<ul>\n	<li>1 Ngày sử dụng 1 serving = 6 muỗng.</li>\n	<li>Nên làm quen dần bằng cách dùng 1 muỗng sau đó tăng lên dần đến mức tiêu chuẩn.</li>\n	<li>Có thể lựa chọn 2 trong các buổi dùng sau:</li>\n	<li>Giữa các bữa ăn chính trong ngày</li>\n	<li>Trước hoặc Sau khi tập luyện.</li>\n	<li>Trước khi đi ngủ.</li>\n	<li>Không sử dụng quá 1 serving trong 24 tiếng.</li>\n</ul>\n\n<p><em><strong>Lưu ý khi dùng:</strong></em></p>\n\n<ul>\n	<li>Không sử dụng sản phẩm đối với phụ nữ đang mang thai và cho con bú.</li>\n	<li>Hỏi ý kiến bác sĩ khi một các chức năng trong cơ thể bị suy giảm hoặc bẩm sinh trước khi sử dụng sản phẩm</li>\n	<li>Ngưng sử dụng sản phẩm đối với những trường hợp có biểu hiện bất thường khi sử dụng sản phẩm và đến gặp bác sĩ</li>\n	<li>Sản phẩm này không phải là thuốc, không có tác dụng ngừa và chữa bệnh.</li>\n	<li>Sử dụng quá liều lượng tiêu chuẩn sẽ phải hỏi ý kiến bác sĩ hoặc huấn luyện viên chuyên nghiệp.</li>\n</ul>\n\n<p>Keywords: Mass Tech Extreme 2000 loại 20lbs 9kg 2018, Mass Tech, Mass Extreme,</p>', '0', 47, 1, '2019-03-25 04:53:42', '2019-04-11 06:03:45', 1, 9, 15),
(44, 'MuscleTech Mass Tech 7lbs', 1199996, 900000, '44_2_69584_muscletech-mass-tech-7lbs.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/muscletech-mass-tech.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Mass Tech&nbsp;– Cam kết tăng cơ, tăng cân, tăng sức mạnh</strong></h2>\n\n<p><strong>Mass Tech</strong>&nbsp;là một sản phẩm tăng cơ nâng cấp mới ra mắt nhằm đáp ứng nhu cầu của bất kì những ai đã và đang đau đầu&nbsp;với câu chuyện cân nặng. Chắc hẳn có không ít&nbsp; gymmer ở đây đều bắt đầu với thể trạng yếu, thân hình lỏng lẻo, thiếu cân trầm trọng hay có những gymmer đang trong giai đoạn xả cơ- cho dù bạn thuộc nhóm nào thì mong muốn chung là gia tăng tối đa khối lượng cơ thể mà không muốn làm rối loạn trạng thái sức khỏe ổn định.</p>\n\n<p><strong>Mass Tech</strong>&nbsp;hàm chứa 63 grams protein mỗi servving - Gấp 3 lần những sản phẩm whey protein thông thường mà bạn hay sử dụng. Không chỉ có vậy, hệ thống xử lý protein đa chiều cung cấp nguồn protein phức (Protein tiêu hóa nhanh, trung bình và chậm) giúp vận chuyển chuỗi amino acids quan trọng tới cơ thể ở nhiều mức độ.</p>\n\n<p>840 Clories- Nguồn calories chất lượng cao đáp ứng cả những người khó tăng cân nhất.</p>\n\n<p><strong>Mass Tech&nbsp;</strong>được sản xuất với công thức mới, độc đáo và tân tiến, giúp vận chuyển tới 840 calories kết hợp với nguồn protein chất lượng cao, carborhydrate nhanh hấp thu cũng như là chất béo đặc trưng. Không nghi ngờ gì nữa, đây chắc chắn là sản phẩm tăng cơ tăng cân đa năng nhất từng xuất hiện chỉ với 1 khẩu phần mỗi ngày (có thể chia làm 2 khẩu phần nhỏ trong ngày).</p>\n\n<p><em>13 grams BCAAs</em></p>\n\n<p>Công thức MAS TECH cung cấp 10 grams BCAAs và 5 grams Leucine, cơ bắp được tái cung cấp năng lượng sau mỗi buổi tập mệt mỏi, duy trì cơ bắp với glycogen- được ví như nguồn dự trữ năng lượng lâu dài&nbsp; giúp cơ bắp phục hồi nhanh hơn và hạn chế tối đa sự bẻ gãy quá trình tổng hợp protein.</p>\n\n<p><em>5 grams chất béo giàu omega</em></p>\n\n<p><strong>MASS-TECH</strong>&nbsp;chứa ít chất béo bão hòa hơn&nbsp; so với các sản phẩm&nbsp;<strong><a href=\"http://www.wheystore.vn/c157/sua-tang-can\">sữa hỗ trợ tăng cân nhanh</a></strong>&nbsp;khác. Không chỉ vậy, sản phẩm cung cấp tới 5 grams chất béo giàu omega đem lại lượng calo dồi dào năng lượng.</p>\n\n<p>Sản phẩm được đóng gói với 80 grams protein và&nbsp; 1170 calo khi được hòa tan với 2 cốc sữa tách béo, công thức hoàn thiện hơn với thành phần dinh dưỡng giúp đồng hóa cơ bắp cho một kết quả tối ưu- tăng cơ- tăng cân và tăng sức mạnh!</p>\n\n<h3><strong>Mass Tech - Đồng hóa cơ bắp cực nhanh</strong></h3>\n\n<p>9 trên 10 gymmer khi tìm hiểu về gainer đều cho rằng creatine chỉ làm tăng kích cỡ cơ bắp ảo- tức là chỉ làm phồng cơ chứ không làm tăng cơ nạc. Một sai lầm nghiêm trọng, bởi creatine là một thành phần không thể thiếu đóng vai trò như 1 mắt xích quan trọng trong việc xây dựng đồng hóa các mối cơ bắp. Điều chúng ta phải cân nhắc ở đây đó là lượng creatine đó có tiêu chuẩn không và có lưu lượng phù hợp không.Không giống bất kì sản phẩm gainer khác đều chứa ít hoặc không creatine,&nbsp;<strong>Muscle Tech</strong>&nbsp;<strong>Mass</strong>&nbsp;vẫn cung cấp 10 grams creatine tiêu chuẩn giúp tăng tối đa kích cỡ cơ có thể đạt được.&nbsp;&nbsp;</p>\n\n<p><em>Tái bổ sung lượng Glycogen duy trì năng lượng</em></p>\n\n<p>Cung cấp 168 grams carbohydrates kết hợp với nguồn tinh bột phức được thanh lọc xử lí kỹ, nhanh chóng vận chuyển creatine nuôi cơ bắp, tái bổ sung glycogen và đẩy cơ thể đến trạng thái đồng hóa cơ.</p>\n\n<p><em>Cung cấp chuỗi amino acids cho hiệu quả tối ưu</em></p>\n\n<p>Ngoài chuỗi thành phần chính mà sản phẩm cung cấp,&nbsp;<strong>Muscle Tech</strong>&nbsp;kết hợp một vài những thành phần dinh dưỡng bổ sung như 3 grams L-alanine. L-alanine là chuỗi amino acids thứ 2 được ưu dùng nhất sau L-leucine trong quá trình tổng hợp protein. Và còn đóng vai trò chủ đọa trong việc sản xuất glucose gia tăng năng lượng. Ngoài ra, 3 grams glycine như một loại amino acids tổng hợp&nbsp; những thành phần sinh học được đưa vào cơ thể như protein và creatine. Taurine cũng được đưa vào và là nguồn amino acids dồi dào thứ 2 được tìm thấy trong cơ bắp, sau glutamine và hỗ trợ làm dầy tế bào cơ.</p>\n\n<p><em>Hãy để đồng tiền bạn bỏ ra xứng đáng!</em></p>\n\n<p>Không như các đối thủ cạnh tranh, các thành phần đưa vào sản phẩm đều được in to rõ ràng trên nhãn mác tránh trường hợp bạn không biết mình đang bỏ tiền ra thứ gì- liệu nó có phù hợp với nhu cầu và số tiền bạn bỏ ra hay không.</p>\n\n<h3><strong>Hướng dẫn sử dụng Mass Tech&nbsp;từ WheyStore</strong></h3>\n\n<p><strong>MassTech&nbsp;</strong>với 10g creatine trong 1 serving, bạn nên cân nhắc để sử dụng, creatine là tốt nhưng chúng tôi khuyên bạn không nên nạp quá nhiều, với cân nặng 60kg bạn nên dùng từ 5-7g 1 ngày, từ đó bạn sẽ có lựa chọn thích hợp để mỗi ngày dùng bao nhiêu MassTech là đủ cho bản thân</p>\n\n<p>Khi đã xác định được một ngày nên dùng bao nhiêu, bạn có thể chia ra là 2-3 lần uống dàn trải trong ngày, nên tập trung vào trước hoặc sau quá trình tập luyện</p>\n\n<p><strong>Lưu ý :&nbsp;</strong>Pha MassTech với nước, sữa không đường hoặc bất kỳ loại nước trái cây nào mà bạn thích, pha với nước ở nhiệt độ thường hoặc nước lạnh, không pha cùng nước nóng.</p>\n\n<p>Keywords: MuscleTech Mass Tech 7lbs, MuscleTech, Mass Tech,</p>', '5', 47, 1, '2019-03-25 04:59:08', '2019-04-01 07:26:09', 1, 9, 15),
(45, 'Optimum Pro Gainer 10 lbs(4,62kg)', 2100000, 1000000, '45_2_24209_optimum-pro-gainer-10-lbs-4-62kg.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/optimum-pro-complex-10-lbs-4-62kg.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Pro Complex Gainer – Hỗ trợ&nbsp;quá trình tăng cơ nạc</strong></h2>\n\n<p>Một sai lầm thông thường của những gymmer mới chân ướt chân ráo bước chân vào giới thể hình đó là vội vàng đánh giá một sản phẩm tăng cân- tăng cơ dựa trên thông tin calories có trong mỗi khẩu phần. Bởi trong quá trình tổng hợp dưỡng chất, Không phải tất cả các nguồn calories đều được hấp thụ. Không như những công thức tăng cân điển hình cung cấp lượng lớn đường và chất béo thông thường.&nbsp;<strong>Pro Complex Gainer</strong>&nbsp;hàm chứa lượng lớn calories từ 7 nguồn protein tối ưu tiêu chuẩn.&nbsp;</p>\n\n<p>Bằng cách&nbsp; bổ sung tối đa lượng carbohydrate tổng hợp, chất xơ, chuỗi triglycerides (MCTs), enzymes tiêu hóa, vitamins, khoáng chất thiết yếu, chúng tôi tự hào ra mắt dòng&nbsp;<strong><a href=\"https://www.wheystore.vn/tang-can-nac-it-mo\">sản phẩm tăng cân nạc</a></strong>&nbsp;hoàn hảo.&nbsp;<strong>Pro Complex Gainer&nbsp;</strong>cam kết thỏa mãn khách hàng về mặt chất lượng sản phẩm, chứ không phải số lượng.&nbsp;</p>\n\n<h3><strong>Tăng cơ nạc- thay vì mỡ</strong></h3>\n\n<p>Hầu hết các sản phẩm tăng cân hiện nay đều làm đúng những gì họ đã quảng cáo. Pro Complex Gainer không như vậy, chúng tôi đem lại cho vận động viên thể hình một cơ thể mạnh mẽ, to lớn với đường vân cơ bắp sắc nét thay vì chỉ phồng và tích nước như các lại&nbsp;sữa tăng cân mass&nbsp;khác.&nbsp;</p>\n\n<h3><strong>Thành phần dinh dưỡng tạo nên Pro Complex Gainer</strong></h3>\n\n<p>Nguồn Protein chất lượng cao:&nbsp;<strong>Pro&nbsp;Gainer&nbsp;</strong>là sự kết hợp giữa nguồn protein giá trị sinh dưỡng cao, dễ tiêu hóa và hấp thụ vào cơ thể cùng với chuỗi amino acids hoàn thiện đóng vai trò phục hồi và duy trì, xây dựng đồng hóa các múi cơ bắp. Mỗi khẩu phần&nbsp;<strong>Complex Gainer</strong>&nbsp;cung cấp tới 60 grams protein hoàn thiện được tổng hợp từ 7 nguồn protein khác biệt.</p>\n\n<p>Carbohydrate phức và Lipids: Carbohydrate và lipits( chất béo và giàu) cung cấp năng lượng duy trì bảo vệ protein khỏi rò rỉ lãng phí. Mỗi khẩu phần&nbsp;<strong>Pro&nbsp;Gainer</strong>&nbsp;cung cấp 85 grams carbohydrate và 4-5 grams chất xơ và chỉ 5 grams đường. Thêm vào đó,&nbsp;<strong>Complex Gainer</strong>&nbsp;cung cấp chuỗi triglycerides (MCTs) trung bình và các lipids bổ sung năng lượng khác.</p>\n\n<p>Dưỡng chất lớn: Nguồn vitamins dồi dào cùng với những khoáng chất thiết yếu được hấp thụ trong quá trình phát triển và xây dựng cơ bắp. Không chỉ có marco (cơ thể không thể hoàn toàn hấp thụ protein, carbohydrates và chất béo). Mỗi khẩu phần triglycerides (MCTs) hàm chứa tới 26 grams vitamins và những khoáng chất cần thiết.</p>\n\n<p>Calories: Để tăng thêm 1 pound cơ nạc, bạn cần phải tiêu thụ tới 3,500 calories nhiều hơn những gì bạn có thể hấp thụ từ đồ ăn, đồ uống, thành phần bổ sung thông thường.&nbsp;<strong>Pro Complex Gainer</strong>&nbsp;hàm chứa hơn 600 calories mỗi khẩu phần. Đừng chần chừ thêm, bằng cách thêm vào chế độ ăn uống của bạn đều đặn 1 serving mỗi ngày, bạn sẽ được trải nghiệm sự lớn dần lên của kích cỡ cơ bắp chỉ trong tuần đầu tiên sử&nbsp; dụng.</p>\n\n<p><strong>Pro Complex Gainer</strong>: Nguồn mass chất lượng với sư kết hợp hoàn hảo giữa nguồn proteins phức tối ưu và lượng calories lớn vượt xa những gì bạn mong đợi.</p>\n\n<p><em>Công thức tăng tối đa cơ nạc:</em></p>\n\n<ul>\n	<li>650 calories</li>\n	<li>Ít đường</li>\n	<li>7 nguồn protein tiêu chuẩn gồm whey, Casein và trứng</li>\n	<li>Tỉ lệ protein lớn hơn tinh bột</li>\n	<li>Hòa tan dễ dàng thuận tiện với hỗn hợp mass mềm mịn, hộp shaker&nbsp; và thìa.&nbsp;</li>\n	<li>Dễ uống.</li>\n</ul>\n\n<h3><strong>Hướng dẫn sử dụng của WheyStore</strong></h3>\n\n<p>Với mỗi serving là 1 muỗng của&nbsp;<strong>Pro Gainer&nbsp;</strong>bạn có thể chia ra uống làm 2 lần dàn trải trong ngày, pha cùng nước, sữa tươi không đường hay bất kỳ loại nước trái cây nào mà bạn thích. Ngon hơn khi uống lạnh không pha cùng nước nóng!</p>\n\n<p>WheyStore khuyên bạn nên uống 2 lần vào trước tập 1-1,5h và sau tập 30ph để cho hiệu quả lớn nhất!</p>\n\n<p><strong>Lưu ý</strong>: Không nên uống quá 2 serving 1 ngày</p>\n\n<p>Keywords: Pro Gainer Optimum, Pro Gainer,</p>', '0', 128, 1, '2019-03-25 05:03:00', '2019-04-02 06:58:05', 1, 9, 14),
(46, 'Super Mass 5.4kg tăng cân nhanh', 1250000, 0, '46_1_37886_super-mass-5-4kg-tang-can-nhanh.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/super-mass-gainer-5-5kg.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Super Mass Gainer - Gia tăng kích cỡ cơ bắp vượt trội!</strong></h2>\n\n<p><strong><a href=\"https://www.wheystore.vn/tang-can-nhanh\">Sữa tăng cân nhanh</a>&nbsp;Super Mass Gainer</strong>&nbsp;là hỗn hợp tập trung cao. Nguồn protein giàu glutamine đáp ứng như cầu cơ thể với hỗn hợp Amino Acids thiết yếu đẩy nhanh khả năng phục hồi và phát triển cơ bắp tối ưu. Sử dụng công nghệ Zytrix™ độc quyền, loại bỏ tất cả những tạp chất không cần thiết giúp cơ thể nâng cao khả năng hấp thụ.&nbsp;<strong>Super Mass Gainer</strong>&nbsp;cung cấp nguồn enzyme tiêu hóa lớn cho phép cơ thể nhận tối đa lượng calories và protein mà không gây rối loạn.</p>\n\n<h3><strong>Tại sao lại nên sử dụng</strong>&nbsp;<strong>Sữa tăng cân Super Mass</strong></h3>\n\n<p>Tăng kích cỡ cơ thể không hề đơn giản đặc biệt với những người có thể trạng yếu, kém hấp thụ. Kể cả với những người có hệ tiêu hóa tốt, quá trình trao đổi chất diễn ra nhanh chóng hơn, việc cung cấp lượng calories phù hợp vào cơ thể để tăng cơ nạc có thể là một trở ngại khi nguồn dưỡng chất bổ sung kém chất lượng.&nbsp;<strong>Super Mass Gaine</strong>r có đầy đủ nguồn calories, protein, BCAAS, vitamin và các khoáng chất cần thiết khiến việc đồng hóa cơ bắp gia tăng sức mạnh trở nên đơn giản. Để cơ thể tăng được kích cỡ thì cơ thể cần phải liên tục được bổ sung đầy đủ dưỡng chất cần thiết, đó là lí do vì sao Super Mass Gainer hàm chứa cả Whey protein và Casein nhằm liên tục tái phục hồi năng lượng.</p>\n\n<p>Sữa tăng cân&nbsp;<strong>Super Mass</strong>&nbsp;với thành phần nguyên liệu chất lượng cao và nguồn dưỡng chất tiêu chuẩn giúp gia tăng tối đa sức mạnh và kích thước cơ bắp. Đủ calories nạp năng lượng và bảo vệ cơ bắp khỏi quá trình dị hóa, PROTEIN với vai trò quan trọng trong việc xây dựng và phát triển khối cơ, BCAAs như một hợp chất chắp nối và liên kết các mô cơ thành khối cơ lớn hoàn thiện và thúc đẩy sự tổng hợp Protein nuôi dưỡng cơ bắp, Creatine tăng sức mạnh hỗ trợ tối đa phát triển cơ bắp, lượng Vitamins và khoáng chất dồi dào cũng như Glutamine đẩy nhanh khả năng phục hồi.&nbsp;<strong>Mass Gainer</strong>&nbsp;là sự lựa chọn hoàn hảo cho một cơ thể khỏe mạnh và sắc nét.</p>\n\n<h3><strong>Những thành phần đặc biệt có trong Super Mass Gainer</strong></h3>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1280 Calories</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 52g Protein</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bổ sung Creatine</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cung cấp vitamins và khoáng chất</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phù hợp mọi lúc mọi nơi.</p>\n\n<h4><strong>Khi sử dụng với một lít sữa</strong></h4>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 1,900 Calories</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 83g Protein</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 17g of BCAAs</p>\n\n<p>•&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 7.7g L-Leucine</p>\n\n<p>Hương vị tuyệt vời với khả năng hòa tan nhanh,dễ dàng thuận tiện mọi lúc mọi nơi</p>\n\n<p>Bạn đã từng sử dụng hộp shaker và thất vọng khi nhìn thấy một nửa số bột vẫn chưa được hòa tan hoàn toàn và dính vào một bên hộp. Đó là lí do Hãng Dymatize tự hào với hỗn hợp mịn, dễ hòa tan, tiện lợi mọi lúc mọi nơi. Bạn có thể an tâm với sản phẩm của chúng tôi, mỗi một muỗng protein được sử dụng sẽ nhanh chóng hấp thụ vào cơ thể. Cho dù đó là nước, sữa hay bất kì đồ uống nào bạn yêu thích, sản phẩm dễ dàng được hòa tan với cấu tạo mềm, mịn.</p>\n\n<p>Hãy tự mình trải nghiệm, chúng tôi đảm bảo đem lại nguồn Protein chất lượng tiêu chuẩn, hương vị hấp dẫn và độ đặc hoàn hảo. Hãy tìm hiểu về những hương vị tuyệt vời mà sản phẩm sữa tăng cân Super Mass Gainer đem lại.</p>\n\n<p>Với những gì đã làm được, super mass xứng đáng đứng trong hàng ngũ các loại&nbsp;sữa tăng cân tốt nhất&nbsp;hiện nay</p>\n\n<h3><strong>Hướng dẫn sử dụng&nbsp;super mass</strong></h3>\n\n<p>Đối tượng : Dành cho người gầy, kém ăn, vận động viên, người chơi thể thao.</p>\n\n<p>Sử dụng bình lắc hoặc máy xay sinh tốt pha đủ 2 muỗng&nbsp;sữa super mass đầy (muỗng kèm theo hộp) trong 1 ngày.</p>\n\n<p>Chia 2 muỗng làm 3 - 4 lần : pha 200-300ml nước sôi để nguội ( nước bạn uống hàng ngày ) hoặc sữa tươi không đường. Bạn có thể cho thêm đá khi bột đã tan hết hoắc các thực phẩm khác ( như kem, chuối, mật ong, hạt lạc,...)&nbsp;</p>\n\n<p>Tuần 1: dành cho người lần đầu sử dụng&nbsp;<strong>sữa tăng cân&nbsp;Super Mass&nbsp;</strong></p>\n\n<ul>\n	<li>Lần 1 : Uống 1/2 muỗng sau bữa ăn sáng 2 - 2,5 tiếng</li>\n	<li>Lần 2 : Uống 1/2 muỗng sau khi tập ( uống luôn ) nên uống sau tập từ 10 đến 20 phút.</li>\n	<li>Lần 3 : Uống 1/2 muỗng trước khi đi ngủ 1,5 tiếng.</li>\n</ul>\n\n<p><strong>Các tuần tiếp theo</strong>: Tăng lượng bột sữa&nbsp;</p>\n\n<ul>\n	<li>Lần 1 : Uống 1/2 muỗng sau bữa ăn&nbsp;sáng 2 - 2,5 tiếng</li>\n	<li>Lần 2 : Uống 1 muỗng sau khi tập ( uống luôn ) nên uống sau tập từ 10 đến 20 phút.</li>\n	<li>Lần 3 : Uống 1/2 muỗng trước khi đi ngủ 1,5 tiếng.</li>\n</ul>\n\n<p>Nếu bạn dùng thìa (muỗng) để hòa&nbsp;:&nbsp;Bạn cho bột dinh dưỡng vào cốc, cho 1 ít sữa (hoặc nước) vào và khuấy đều, khi bột đã tan đều, cho nốt phần sữa (hoặc nước) vào và khuấy đều trong vài giây.</p>\n\n<p>Không sử dụng pha sữa&nbsp;<strong>Super Mass</strong>&nbsp;với nước nóng, bảo quản sản phẩm ở những nơi thoáng mát. Không dành cho những người đang có thai và cho con bú, tránh xa tầm tay trẻ em. Hỏi ý kiến bác sĩ nếu bạn đang điều trị bệnh bằng các loại thuốc khác.</p>\n\n<p>Keywords: Super Mass, Super, Mass, sữa tăng cân super mass</p>', '0', 45, 1, '2019-03-25 05:06:42', '2019-04-11 06:03:46', 1, 9, 11),
(47, 'Serious Mass 6 Lbs (2.72KG)', 100000, 0, '47_2_36741_serious-mass-6-lbs-2-72kg.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/serious-mass-6-lbs-2-72kg.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Serious Mass sữa tăng cân được ưa chuộng</strong></h2>\n\n<p>Bạn là người khó tăng cân? Dinh dưỡng hàng ngày thiếu hụt với nhu cầu cơ thể? Hoặc do bạn vận động, làm việc học tập khiến bạn hao tổn nhiều năng lượng? Để tăng cân bạn cần có một chế độ ăn hợp lý đủ chất dinh dưỡng giúp bạn phát triển và tăng cân nặng. Serious Mass của ON giàu chất dinh dưỡng và sẽ giúp bạn tăng cân hiệu quả nhất.</p>\n\n<p><strong>Optimum Nutrition - Serious Mass</strong>&nbsp;là một công thức tập trung cao. Thành phần protein giàu glutamine cung cấp cho bạn 1 hàm lượng amino cao giúp phục hồi nhanh chóng và tăng trưởng tối đa. Chúng tôi sử dụng công nghệ Zytrix bao gồm 1 công thức tiêu hóa cho phép bạn hấp thu lượng calo tối đa và protein cao nhất qua đó giúp&nbsp;<a href=\"https://www.wheystore.vn/tang-can-nhanh\"><strong>tăng cân nhanh lành mạnh</strong></a>.</p>\n\n<p>Chỉ với 2 Muỗng sữa&nbsp;<strong>Serious Mass&nbsp;</strong>(334g) sẽ bổ sung cho bạn:</p>\n\n<ul>\n	<li>1250 năng lượng giúp bạn dư calo để tăng cân</li>\n	<li>Giàu dinh dưỡng thiết yếu 252 g tinh bột, 50 g protein, 4.5 g chất béo</li>\n	<li>Cung cấp hơn 25 Vitamin và khoáng chất thiết yếu giúp cơ thể khoẻ mạnh dễ dàng hấp thu dinh dưỡng</li>\n	<li>Nếu bạn tập thể hình ngoài việc giúp bạn tăng cân,&nbsp;<strong>serious mass</strong>&nbsp;còn giúp bạn phát triển cơ bắp, và tăng sức khoẻ khi luyện tập</li>\n</ul>\n\n<h3><strong>Cách sử dụng Serious Mass</strong></h3>\n\n<p>Về cách sử dụng Serious Mass, Wheystore đã giới thiệu ở bài viết&nbsp;<strong>Serious Mass 12lbs</strong>&nbsp;trước đó, khách hàng và bạn đọc vùi lòng xem lại! Xin chân thành cảm ơn.</p>\n\n<p>Keywords: Serious Mass 6 Lbs 2 72KG 2018, Serious, Mass, 6, Lbs, 2 72KG , 2018</p>', '0', 94, 0, '2019-03-25 05:11:20', '2019-03-25 13:06:14', 1, 13, 15),
(48, 'Nitrotech Whey Gold 8lbs', 2100000, 0, '48_1_24250_nitrotech-whey-gold-8lbs.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/nitrotech-whey-gold-8lbs.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Nguồn gốc và hương vị của Nitrotech Whey Gold 8lbs&nbsp;</strong></h2>\n\n<p>Đây<strong>&nbsp;</strong>là một sản phẩm khác biệt không giống với bất kỳ một sản phẩm Whey Protein nào trên thị trường. Duy nhất chỉ có tại MuscleTech sử dụng công nghệ tiên tiến siêu lọc ép lạnh đã cho ra đời sản phẩm&nbsp;<strong>Nitrotech Whey Gold</strong>&nbsp;với độ tinh khiết của Whey Isolate lên đến 97%, hương vị thơm ngon, tự nhiên.</p>\n\n<p><strong>Nitrotech</strong>&nbsp;là loại Protein đầu tiên cung cấp với 3 dạng amino axit là alanine, glycine, taurine và proteinogenic amino acid dễ dàng tiêu hóa và hấp thụ thông qua các mạch máu từ đó giúp phục hồi và phát triển các mô tế bào cơ bắp một cách nhanh chóng.</p>\n\n<h3><strong>Sự khác biệt của Nitrotech 100% Whey Gold</strong></h3>\n\n<ul>\n	<li>Với sự kết hợp của 2 loại Protein là Isolate và hydrolized, cơ thể sẽ không phải mất nhiều thời gian cũng như năng lượng để phân hóa protein mà chúng sẽ được hấp thụ ngay lập tức qua các mạch máu sau khi uống.</li>\n	<li>Hàm lượng BCAA cao 5.5g và 4g Glutamine giúp cho cơ bắp có thể luyện tập với cường độ cao mà không bị dị hóa cơ bắp, không bị đau nhức cơ bắp và tăng cường khả năng hấp thụ Protein cho cơ bắp.</li>\n	<li>Có các chất xúc tác để hỗ trợ cơ thể sản xuất ra Insullin để giúp cho việc hấp thu các chất dinh dưỡng tốt hơn.</li>\n</ul>\n\n<h3><strong>Cách dùng Nitrotech Whey Gold 8lbs</strong></h3>\n\n<p><em>Cách pha:</em>&nbsp;pha 1 muỗng&nbsp;<strong>Nitrotech Whey Gold 8lbs</strong>&nbsp;với 6 oz nước tương đương với 180 ml vào trong máy xay hoặc bình lắc. Có thể thay nước lọc bằng các loại nước hoa quả, sữa tươi không đường. Tùy theo khẩu vị mà các bạn có thể tăng thêm hoặc giảm thêm nước và tuyệt đối không sử dụng nước nóng để pha.</p>\n\n<p><em>Thời gian sử dụng:</em>&nbsp;uống vào giữa các bữa ăn chính, sử dụng trước và sau khi tập.</p>\n\n<p><strong>Nitrotech Whey Gold</strong>&nbsp;được tạo nên bởi công thức xây dựng cơ bắp đặc biệt dành riêng cho các vận động viên thể hình chuyên nghiệp tìm kiếm sản phẩm hỗ trợ tăng cơ bắp nhanh chóng và mạnh mẽ nhất. Nitrotech cung cấp nguồn Protein chất lượng cao, tinh khiết nhất đảm bảo sự phát triển tối ưu các múi cơ trên cơ thể người sử dụng. Các bạn hãy đặt mua và cảm nhận sự khác biệt này nhé.</p>\n\n<p>Xem thêm về&nbsp;<a href=\"https://www.wheystore.vn/nitro-tech-whey-isolate-4-lbs-1-8kg--312.html\">MuscleTech NitroTech 4 Lbs</a>.</p>\n\n<p>Keywords: Nitrotech Whey Gold 8lbs, Whey Gold 8lbs, Nitrotech Whey Gold</p>', '1', 49, 0, '2019-03-25 05:27:52', '2019-03-30 10:33:48', 1, 8, 15),
(49, 'Combat Crunch Bar ăn liền', 60000, 0, '49_2_64221_combat-crunch-bar-an-lien.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/combat-crunch-bar-an-lien.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Combat Crunch – bữa ăn nhẹ giàu Protein</strong></h2>\n\n<p><strong>Combat Crunch</strong>&nbsp;là thanh Protein nướng được hãng MusclePharm sản xuất bằng một quy trình nướng độc quyền tạo nên hương vị mới lạ, cao cấp và bánh có kết cấu mềm mại hơn.</p>\n\n<p>MusclePharm là hãng chuyên sản xuất các sản phẩm bổ sung chất dinh dưỡng tốt nhất và an toàn nhất.</p>\n\n<p><strong>Combat Crunch Bar</strong>&nbsp;chứa Protein nguyên chất được chiết suất xứ WheyProtein Isolate cao cấp. Không phải là miếng cứng như các thanh Protein khác mà Combat Crund giống như một chiếc bánh mềm có vị ngon rất tuyệt.</p>\n\n<p>Các bạn không thể lúc nào cũng có thời gian để chuẩn bị bữa ăn&nbsp;đem đến phòng tật hay pha sinh tố, … Vì vậy thanh&nbsp;<strong>Combat Crunch</strong>&nbsp;rất tiện lợi, chỉ với một thanh mà cung cấp một lượng Protein rất lớn giúp bạn tiết kiệm được thời gian chuẩn bị bữa ăn.</p>\n\n<h3><strong>Thành phần có trong thanh Caombat Crunch</strong></h3>\n\n<ul>\n	<li>20g Protein để giúp xây dựng cơ bắp nạc</li>\n	<li>Không chứa Gluten</li>\n	<li>Đủ các loại hương vị tự nhiên: sô cô là trắng và đen, bơ đậu phộng, ốc quê, bánh ngọt, bánh kem.</li>\n	<li>Có chứa ít lượng đường và carb</li>\n	<li>Cacbohydrate phức tạp</li>\n</ul>\n\n<p><strong>Combat Crunch Bar</strong>&nbsp;cung cấp một hàm lượng Protein khá lớn để thúc đẩy quá trình hồi phục và phát triển cơ bắp tốt nhất.</p>\n\n<h3><strong>Hướng dẫn sử dụng</strong></h3>\n\n<p>Các bạn có thể dùng Combat Crunch như một bữa ăn nhẹ bổ sung chất dinh dưỡng thiết yếu cho cơ thể.</p>\n\n<p>Bạn cũng có thể vào lúc trước khi tập và sau khi tập đều được.</p>\n\n<p>Keywords: Combat Crunch Bar</p>\n\n<p><img alt=\"Combat Crunch Bar ăn liền\" id=\"img_01\" itemprop=\"image\" src=\"https://www.wheystore.vn/upload/product/catalog/combat-crunch-bar-an-lien.jpg\" style=\"width: 500px; height: 500px;\" title=\"Combat Crunch Bar ăn liền\" /></p>', '0', 98, 0, '2019-03-25 05:36:17', '2019-03-25 13:18:30', 1, 8, 16),
(50, 'Combat 100% Whey 5lbs', 1390000, 0, '50_2_17169_combat-100-whey-5lbs.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/combat-100-whey-5lbs.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<p>Mỗi muỗng&nbsp;<strong>Combat&nbsp; Whey</strong>&nbsp;được đóng gói với 25g 100%&nbsp;<a href=\"https://www.wheystore.vn/whey-protein-blend\">whey protein blend</a><strong>&nbsp;</strong>cô lập như đạm whey và cô đặc whey protein mà tiêu hóa một cách nhanh chóng để giúp đáp ứng nhu cầu protein hàng ngày của bạn. Ngoài ra, chiến đấu 100% Whey ™ là ít chất béo và không có thuốc nhuộm nhân tạo, chất độn, gluten, và các thành phần không mong muốn khác. Đi bất kỳ thời gian trong ngày, trước hoặc sau khi tập luyện, làm nhiên liệu cho các vận động viên bên trong của bạn với một siêu cao cấp, kinh nghiệm protein chất lượng.</p>\n\n<h2><strong>Chất lượng của Combat Whey</strong></h2>\n\n<p>Mỗi đợt duy nhất của chiến đấu<strong>&nbsp;Combat Whey 5lbs</strong>&nbsp;là thử nghiệm cho cả các chất cấm và xác minh tuyên bố nhãn protein. Chúng tôi có hơn 20 triệu sản phẩm được chứng nhận với toàn cầu công nhận Thông báo-Choice cho đến nay. Tại WheyStore, chúng ta đi xa thêm để đảm bảo khách hàng của chúng tôi có được chính xác những gì họ mong đợi. Chúng tôi kiểm tra tất cả các lô cho các chất bị cấm, cũng như chất lượng protein&nbsp;<strong>Combat Whey</strong>, để xác minh rằng chúng tôi luôn cung cấp 25g protein. Đó là lý do tại sao hàng triệu khách hàng tin tưởng WheyStore.&nbsp;</p>\n\n<h3><strong>Cách dùng&nbsp;Combat Whey</strong></h3>\n\n<ul>\n	<li>Mỗi lần dùng pha 1 muỗng&nbsp;<strong>Whey Combat&nbsp;</strong>+ 250ml hoặc 300ml nước lọc hoặc sữa không đường.</li>\n	<li>Dùng 2 lần mỗi ngày ( sáng và sau khi tập ) đặc biệt có thễ dùng với nữ giới.</li>\n</ul>\n\n<p>Keywords: combat whey, whey combat 5lbs, combat whey 5lbs</p>', '0', 78, 0, '2019-03-25 05:41:26', '2019-03-30 10:33:48', 1, 8, 16),
(51, 'On Isolate 5lbs', 1750000, 0, '51_2_46197_on-isolate-5lbs.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/on-isolate-5lbs.jpg\" style=\"width: 500px; height: 222px;\" /></p>\n\n<h2><strong>Tác dụng của Whey Protein Isolate</strong></h2>\n\n<p>Giống như các sản phẩm Whey Protein khác,&nbsp;<strong>Isolate</strong>&nbsp;có chứa các chuỗi Axit Amin rất cần thiết cho sự hình thành và phát triển của mô cơ.&nbsp;Chúng ta đều biết, quá trình xây dựng cơ bắp có thể khiến các mô cơ bị phá hủy và các sản phẩm hỗ trợ như Whey Protein được tạo ra nhằm thay thế các mô cơ bị mất đi đó để khiến quá trình tập luyện của cơ thể đạt được hiệu quả.</p>\n\n<p>Như một lời khẳng định về chất lượng, chúng tôi - chuyên gia dinh dưỡng hàng đầu trong ngành thể hình tự tin nói rằng: \" Nếu như Whey Protein đứng đầu về nguồn cung cấp protein thì&nbsp;<a href=\"https://www.wheystore.vn/whey-protein-isolate\"><strong>Whey Protein Isolate</strong></a>&nbsp;là số 1 trong các loại whey protein.\"</p>\n\n<p>Không chỉ giúp hình thành các khối cơ bắp mới, Isolate còn có tác dụng giải độc cơ thể, tăng cường hệ miễn dịch và đặc biệt giúp cơ thể gảm đau tự nhiên&nbsp;nhờ hàm lượng axit amin cao. Chính vì thế, Isolate là một trong những sản phẩm được các vận động viện thể hình ưa chuộng sử dụng và cũng vì thế mà WheyStore luôn phải nói lời xin lỗi đến rất nhiều khách hàng ở mỗi dịp hết hàng.</p>\n\n<h3><strong>Whey Protein&nbsp;Isolate của thương hiệu ON</strong></h3>\n\n<p>Không cần phải nhắc đi nhắc lại quá nhiều lần về thương hiệu ON, nếu bạn là tín đồ phòng tập Gym chắc chắn bạn không thể không biết đến nhãn hiệu này. Vậy&nbsp;Whey protein On Isolate có đặc điểm gì? Có thể cạnh tranh với hàng trăm thương hiệu khác trên toàn thế giới?</p>\n\n<p>Không phải ngẫu nhiên mà dinh dưỡng thể hình WheyStore chọn các sản phẩm của thương hiệu ON để phân phối, đặc biệt là với dòng sản phẩm hỗ trợ tăng cơ như Isolate.&nbsp; Được trải qua thêm một quá trình xử lý và tách lọc nhờ phương pháp tiên tiến và máy mọc hiện đại,&nbsp;<strong>On Isolate</strong>&nbsp;đã loại bỏ tối đa các tạp chất có lẫn trong nguồn cung cấp Protein. On Isolate cam kết rằng có không quá 1% các tạp chất: chất béo, lactose,...có trong sản phẩm. Đây cũng là lý do vì sao mà On Isolate được mệnh danh là sản phẩm whey protein&nbsp;tinh khiết và có giá thành cao hơn các loại whey khác.</p>\n\n<p>Keywords: On Isolate 5lbs, Whey Protein Isolate</p>', '0', 77, 0, '2019-03-25 05:53:05', '2019-03-30 10:33:48', 1, 8, 14);
INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_giaBan`, `sp_giamGia`, `sp_hinh`, `sp_anh360`, `sp_thongTin`, `sp_danhGia`, `sp_soLuong`, `sp_tinhTrang`, `sp_taoMoi`, `sp_capNhat`, `sp_trangThai`, `l_ma`, `h_ma`) VALUES
(52, 'ISO 100 Isolate 100% 5 Lbs (2,27kg)', 1900000, NULL, '52_1_65536_iso-100-isolate-100-5-lbs-2-27kg.png', 1, '<p><img src=\"https://www.wheystore.vn/upload/product/content/iso-100-whey-isolate-5lbs-2-27kg.jpg\" style=\"width: 600px;\" /></p>\n\n<h2><strong>Bạn cần, ISO 100 có?</strong></h2>\n\n<p>Mục đích của bạn là có một cơ thể săn chắc, khỏe mạnh, với những đường cơ sắc nét nhưng lại thấy khó khăn trong việc tập luyện. Còn chờ đợi gì nữa,&nbsp;<strong>ISO 100</strong>&nbsp;chính là giải pháp hoàn hảo dành cho bạn, ISO cam kết bạn đạt được mục tiêu trong khoảng thời gian sớm nhất, không chỉ vậy mà còn có những mục tiêu mới với chế độ tập luyện dày đặc hơn.</p>\n\n<p>Hấp thụ nhanh, được thủy phân với 100% whey protein isolate, đi kèm với đầy đủ hương vị hấp dẫn mà vẫn cung cấp lượng protein cũng như BCCAs dồi dào cho mỗi khẩu phần. Sử dụng ISO 100 trước mỗi buổi luyện tập, sau luyện tập hoặc bất kì khi nào bạn cần nhằm bổ sung lượng protein chất lượng cho cơ thể. Đặc biệt dành cho đối tượng có cường độ tập luyện nặng với mục đích liên tục xây dựng những mối cơ mới trong khoảng thời gian ngắn nhất!</p>\n\n<p>Sản phẩm protein tiêu thụ nhanh của hãng được điều chế đặc biệt dành cho những vận động viên thể hình chuyên nghiệp. ISO 100 có tất cả những gì cơ thể bạn cần với mục đích đẩy nhanh quá trình phục hồi, táo tạo các mô cơ đồng thời liên tục đẩy mạnh sản sinh tổng hợp nên các mô cơ mới, phải nói là không có gì mà&nbsp;<strong>ISO 100</strong>&nbsp;không thể làm được. Mỗi khẩu phần cung cấp tới 25 grams 100% whey protein isolate đã qua công nghệ thủy phân cùng với 5,5 grams chuỗi Amino acids ( BCCAs), chưa kể đến 2,7 grams BCAA L-Leucine-thành phần dưỡng chất dễ bị mất đi trong quá trình tập luyện mạnh.</p>\n\n<p>Không đi kèm gluten và lactose, với ít hơn 1 gram đường và chất béo mỗi khẩu phần, người sử dụng hoàn toàn có thể tin tưởng tin dùng mà không lo sợ lượng chất béo dư thừa có thể ảnh hưởng đến quá trình luyện tập. Một ưu điểm nữa của ISO 100 là nó có khả năng bổ sung lượng protein thiếu hụt và cần thiết ngay khi bạn sử dụng. Với những gi iso 100 làm được, nó xứng đáng là một trong&nbsp;các loại whey protein tốt nhất.</p>\n\n<p><strong>Những điều bạn cần làm là:</strong></p>\n\n<ul>\n	<li>Tập nặng hơn nữa, mạnh hơn nữa, phục hồi nhanh hơn nữa và nhanh đạt kết quả hơn nữa.</li>\n	<li>25g Hydrolyzed 100% Whey Protein Isolate ( sản phẩm whey đã thủy phân )</li>\n	<li>Gấp đôi tốc dộ hấp thụ cũng như tiêu hóa</li>\n	<li>5.5g BCAAs và 2.7g L-Leucine</li>\n	<li>0g Fat ( chất béo ) và 0g đường</li>\n	<li>Không Gluten và không lactose</li>\n	<li>Hương vị tuyệt vời đi đôi với sự tiện lợi trong sử dụng</li>\n</ul>\n\n<p>ISO 100 bổ sung&nbsp;<strong><a href=\"https://www.wheystore.vn/hydrolyzed-whey-protein-thuy-phan-tang-co-tot-nhat\">Hydrolyzed Whey</a></strong>&nbsp;đơn giản mà cơ bắp cần. Chất lượng hoàn hảo, hương vị tuyệt vời, hoàn toàn nguyên chất không pha trộn, còn chần chừ gì nữa, ISO chính là lựa chọn tuyệt vời nhất mà bạn có. Bên cạnh đó, sản phẩm được điều chế qua công nghệ lọc cross-flow micro, gấp đôi bước tinh chế nhằm lưu giữ và bảo vệ các phân tử protein siêu nhỏ thiết yếu trong quá trình loại bỏ carbonhydrate , chất béo, lactose và cholesterol không cần thiết.&nbsp;ISO 100&nbsp;được làm với nguồn protein nguyên chất đã được thủy phân từ trước cho hiệu quả đáng kinh ngạc với khả năng hấp thụ và tiêu hóa nhanh.</p>\n\n<h3><strong>Hướng dẫn dành riêng cho bạn của WheyStore</strong></h3>\n\n<p>Sáng ngủ dậy 1 lần, sau tập 1 lần, mỗi lần 1 muỗng pha với 300ml nước lạnh, uống luôn ngay sau khi pha, không được pha xong để tủ lạnh sẽ mất đi độ chất của Iso 100, bạn có thể uống cùng nước hoặc sữa tươi không đường để tăng hương vị cho&nbsp;<strong>iso 100</strong>.</p>\n\n<p>Keywords: ISO 100 Isolate 100 5 Lbs 2,27kg 2018, ISO 100, Isolate 100</p>', '5', 50, 0, '2019-04-03 07:06:57', '2019-04-11 05:14:00', 1, 8, 11),
(53, 'Dymatize Omega-3 Fish Oil', 550000, 0, '53_1_64646_dymatize-omega-3-fish-oil.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/dymatize-omega-3-fish-oil.jpg\" style=\"width: 600px; height: 267px;\" /></p>\n\n<h2><strong>Dymatize Omega - 3 Fish Oil – Top dầu cá tốt nhất</strong></h2>\n\n<p>Dymatize được công nhận trên toàn thế giới là hãng cung cấp các sản phẩm dinh dưỡng thể hình chất lượng cao cho những người luyện tập thể hình, thể dục thể thao. Các sản phẩm của Dymatize được sản xuất dựa trên những nghiên cứu khoa học mới nhất và theo tiêu chuẩn chất lượng cao nhất.</p>\n\n<p><strong>Omega - 3 Fish Oil</strong>&nbsp;là một trong những sản phẩm nổi bật của hãng, bổ sung các axit béo thiết yếu: EPA, DHA, DPA dành cho những người luyện tập thể hình, thể dục thể thao. Đây là một sản phẩm tốt không chứa Gluten, không màu nhân tạo và được sản xuất theo tiêu chuẩn cao nhất.</p>\n\n<h3><strong>Omega 3 là gì?</strong></h3>\n\n<p>Nó chính là các chất béo có lợi không bão hòa mà cơ thể không tự tổng hợp được và được tìm thấy trong mỡ của các loại cá nước lạnh như cá hồi, cá thu, cá ngừ hoặc trong hạt lanh, quả óc chó, cây gay dầu hay một số cây khác.</p>\n\n<h3><strong>Tầm quan trọng của dầu cá Omega 3 đối với người tập thể hình</strong></h3>\n\n<p><em>* Giúp tăng cường cơ bắp nạc</em></p>\n\n<p>Trong thành phần của dầu cá có chứa một nguồn axit béo rất tốt, giúp duy trì sự ổn định và phát triển của các tế bào, rất cần thiết cho việc phát triển cơ bắp. Nó thúc đẩy sự phục hồi, chống viêm cho cơ bắp, duy trì khối lượng nạc trong cơ thể và làm tăng khả năng tổng hợp Protein, axit amin và các chất dinh dưỡng khác.</p>\n\n<p><em>* Giúp chắc khỏe xương</em></p>\n\n<p>Những vận động viên, người tập thể hình luyện tập nhiều thì sẽ khiến các khớp xương bị hao mòn dẫn đến đau nhức xương, viêm khớp.&nbsp;<strong>Omega 3 Fish Oil</strong>&nbsp;sẽ giúp bôi trơn các khớp xương làm giảm tình trạng đau nhức này.</p>\n\n<p><em>* Bảo vệ tim mạch</em></p>\n\n<p>Trong thành phần của Omega có hàm lượng Cholesterol tốt, có lợi cho tim mạch giúp ngăn ngừa các bệnh về tim mạch như: đột quỵ, cao huyết áp, …</p>\n\n<p><em>* Tăng cân</em></p>\n\n<p><strong>Dầu cá</strong>&nbsp;<strong>Omega 3</strong>&nbsp;sử dụng trong bữa ăn sẽ làm tăng phản ứng đồng hóa giúp ăn ngon miệng hơn, hấp thu chất dinh dưỡng tốt hơn từ đó giúp cải thiện cân nặng.</p>\n\n<p><em>* Giảm mỡ</em></p>\n\n<p>Omega 3 giúp đốt cháy lượng mỡ thừa trong cơ thể hiệu quả hơn bởi vì nó làm tăng độ nhạy cảm của Insulin dẫn đến ít chất béo bị lưu trữ và giải phóng chất béo nhiều hơn.</p>\n\n<h3><strong>Mỗi ngày nên uống bao nhiêu viên Dymatize Omega - 3 Fish Oil?</strong></h3>\n\n<p>Các bạn nên uống 2 viên mỗi ngày cùng với thức ăn.</p>\n\n<p><strong>Dymatize Omega&nbsp;</strong>- 3 Fish Oil<strong>&nbsp;</strong>đúng là một sản phẩm cung cấp chất béo tuyệt vời cho những người tập Gym. Lưu ý, đây chỉ là một dạng thực phẩm bổ sung hỗ trợ phát triển cơ bắp chứ không phải là thuốc nên không dùng để thay thế thuốc chữa bệnh được.</p>\n\n<p>Xem thêm về&nbsp;<a href=\"https://www.wheystore.vn/bo-sung-dau-ca\">các loại dầu cá - omega</a>&nbsp;khác.</p>\n\n<p>Keywords: Dymatize Omega, Omega-3 Fish Oil, Dymatize Omega-3 Fish Oil</p>', '0', 99, 1, '2019-04-09 15:22:43', '2019-04-11 06:03:45', 1, 11, 11),
(54, 'Dymatize Cla (90 viên)', 450000, 0, '54_1_44209_dymatize-cla-90-vien.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/dymatize-cla.jpg\" style=\"width: 700px; height: 311px;\" /></p>\n\n<h2><strong>Dymatize CLA là gì?</strong></h2>\n\n<p><strong>Dymatize CLA</strong>&nbsp;cung cấp 800 mg CLA được chiết xuất từ dầu hạt cây Rum không biến đổi gen trong mỗi khẩu phần, hỗ trợ giảm mỡ hiệu quả cho vóc dáng thon thả hơn và làm tăng cơ bắp khi sử dụng CLA kết hợp với tập luyện.</p>\n\n<p>Đây là một loại thực phẩm bổ sung quan trọng cần sử dụng hàng ngày để hỗ trợ cho việc ăn uống lành mạnh bởi nó không cung cấp calo giúp thân hình thon gọn hơn và tối đa hóa các mục tiêu tập luyện.</p>\n\n<h2><strong>Tác dụng chính của Dymatize CLA</strong></h2>\n\n<p>CLA – Conjugated Linoleic Acid là một loại axit béo tự nhiên có trong nhiều thực phẩm. Đây là một chất béo hữu cơ rất tốt cho cơ thể và có những tác dụng chính sau:</p>\n\n<ul>\n	<li>Giảm nồng độ chất béo trong cơ thể, kích thích sự phân hủy mỡ và ngăn chặn quá trình hình thành mỡ.</li>\n	<li>Hỗ trợ xây dựng và phát triển cơ nạc</li>\n	<li>Chuyển hóa lượng mỡ thừa thành năng lượng trong quá trình luyện tập</li>\n	<li>Tăng cường hệ miễn dịch, chống lại quá trình Oxy hóa</li>\n	<li>Làm giảm lượng Cholesterol xấu trong cơ thể</li>\n	<li>Ổn định đường huyết, giảm huyết áp tránh nguy cơ đột quỵ, bảo vệ tim mạch.</li>\n</ul>\n\n<h3><strong>Hướng dẫn sử dụng Dymatize CLA</strong></h3>\n\n<p>Uống sau bữa ăn, ngày uống 3 lần, mỗi lần 1 viên</p>\n\n<p>Sản phẩm này chỉ phù hợp với những người luyện tập thể thao, thể hình. Tránh xa tầm tay trẻ em.</p>\n\n<p><strong>Dymatize CLA&nbsp;</strong>đúng là một sản phẩm giúp giảm cân an toàn và có nhiều lợi ích cho sức khỏe. Vì vậy mà các bạn nên sử dụng CLA hàng ngày để có vóc dáng thon gọn, quyến rũ hơn.</p>\n\n<p>Xem thêm chi tiết về các loại thực phẩm bổ sung giảm cân đốt mỡ&nbsp;<a href=\"https://www.wheystore.vn/c158/giam-can-dot-mo\">ở đây</a>.</p>\n\n<p>Keywords: Dymatize CLA, tác dụng Dymatize CLA, công dụng Dymatize CLA, cách dùng Dymatize CLA</p>', '0', 100, 1, '2019-04-09 15:27:18', '2019-04-09 15:28:19', 1, 11, 11),
(55, 'Dymatize Creatine 300g', 390000, 0, '55_1_60374_dymatize-creatine-300g.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/dymatize-creatine-300g.jpg\" style=\"width: 700px; height: 283px;\" /></p>\n\n<h2><strong>Nguồn gốc Dymatize Creatine&nbsp;Monohydrate&nbsp;(DCM)</strong></h2>\n\n<p>Là sản phẩm&nbsp;cung cấp 100% Creatine hoàn toàn&nbsp;tinh khiết có nguồn gốc tự nhiên và không chứa&nbsp;động vật.&nbsp;DCM được đánh giá là cách hiệu quả để bổ sung&nbsp;<strong>Creatine Monohydrate</strong>&nbsp;giống như một bữa ăn dinh dưỡng hàng ngày.</p>\n\n<h3><strong>Vai trò của&nbsp;Dymatize Creatine</strong></h3>\n\n<p><strong>Dymatize Creatine&nbsp;</strong>được tạo ra nhằm cải thiện hiệu suất hoạt động của cơ bắp ở các bài tập có tính cường độ cao: chạy bộ, tập thể hình - Gym hay bất gì một bài tập powerlifting nào đó. Với hàm lượng 100% là&nbsp;<a href=\"https://www.wheystore.vn/creatine\"><strong>Creatine</strong></a>&nbsp;tinh khiết,&nbsp;Dymatize Creatine được đảm bảo mang lại cho cơ thể những nguồn năng lượng cơ cao nhất. Đặc biệt là với 180 Micron đã được xử lý và sản xuất bởi Công thức phân tử quốc tế nghiêm ngặt, sử dụng các kỹ thuật hiện đại - tối tân nhất&nbsp;thì&nbsp;<strong>Dymatize Creatine&nbsp;</strong>chắc chắn sẽ đảm bảo được độ phân tán phù hợp nhất.</p>\n\n<p>Với sự hỗ trợ của dòng sản phẩm tăng sức mạnh (<strong>Pre-Work</strong>)&nbsp;này, WheyStore hy vọng bạn có thể đạt được tối đa hiệu quả tập luyện! Chúc các bạn thành công.</p>\n\n<p>Keywords: Dymatize Creatine, Creatine Monohydrate</p>', '0', 200, 1, '2019-04-09 15:30:39', '2019-04-09 15:31:33', 1, 13, 11),
(56, 'MuscleTech NitroTech Ripped 4lbs', 1460000, 0, '56_2_20755_muscletech-nitrotech-ripped-4lbs.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/nitro-tech-ripped-4lbs-1-8kg.jpg\" style=\"width: 700px; height: 311px;\" /></p>\n\n<h2><strong>Tại sao nên dùng&nbsp;Nitro Tech Ripped?</strong></h2>\n\n<p>MuscleTech&nbsp;ra mắt dòng sản phẩm thế hệ mới độc nhất với hàm lương protein siêu nguyên chất cùng với lời cam kết đốt mỡ hiệu quả- rõ rang đó là điều mà bạn chưa từng thấy trước đây. Không như những dòng whey khác,&nbsp;<strong>Nitro Tech Ripped</strong>&nbsp;cung cấp những thành phần thiết yếu trong công cuộc giảm mỡ, tiêu mỡ, C. canephora robusta, điều này đã được chứng thực và kiểm nghiệm bởi những chuyên gia hàng đầu thế giới ở lĩnh vực sức khỏe.</p>\n\n<ul>\n	<li>Dòng Whey protein peptides siêu cấp trong việc xây dựng khối cơ bắp</li>\n	<li>Thích hợp cho những vận động viên trong quá trinhg bulking ( xả cơ ) hoặc đơn giản chỉ muốn giảm lượng mỡ thừa mà cơ thể không hấp thụ.</li>\n	<li>Sử dụng thành phần L-carnitine &amp; CLA (hiệu quả trong đốt mỡ tự nhiên)</li>\n	<li>Dòng Protein siêu lọc với công dụng giảm mỡ vượt bậc là những gì cần nói ở Nitro Tech Ripped</li>\n</ul>\n\n<p><strong>Nitro Tech Ripped</strong>&nbsp;cung cấp 30 grams hỗn hợp whey peptides và whey protein isolate với công dụng dễ tiêu hóa, hấp thụ, dễ hòa tan và hàm chứa cả những chuỗi amino acids ( BCCAs) thiết yếu. Những chuyên gia của Muscle Tech không hề dừng lại ở đó, với mỗi hai muỗng whey đặc biệt này cung ứng một hỗn hợp 7 trong 1 như CLA, MCTs, L-carnitine L-tartrate, green tea extract ( chiết xuất lá trà xanh ), rose hip extract ( chiết xuất nụ hoa hồng ) and kelp powder– plus C. canephora robusta hiệu quả trong công cuộc đốt mỡ, tăng cơ!</p>\n\n<h3><strong>Phương thức hoạt động của Nitro Tech Ripped</strong></h3>\n\n<p>Như đã nói,&nbsp;<strong>Nitro Tech Ripped</strong>&nbsp;cung cấp tới 30 grams protein vừa mang giá trị dinh dưỡng cao lại vừa phục vụ tới hai mục đích : tăng cơ và giảm mỡ. Sản phẩm còn hàm chứa lượng Whey peptides lớn - một trong những thành phần cơ bản nhất cấu tạo nên whey đáp ứng nhu cầu của giới thể hình.</p>\n\n<p>Những lợi ích của Whey Peptides là không giới hạn:</p>\n\n<p>- Whey Peptides là một nguồn cung dồi dào chuỗi amino acids được tinh chiết từ&nbsp;<a href=\"https://www.wheystore.vn/whey-protein-blend\"><strong>Whey Protein Blend</strong></a></p>\n\n<p>- Whey peptides đẩy nhanh khả năng cũng như tốc độ phục hồi cơ bắp ngay cả trong với lịch tập luyện nặng.</p>\n\n<p>- Khiến cơ thể nâng cao quá trình hấp thu dưỡng chất.</p>\n\n<p>- Hơn thế nữa, Nitrotech-Ripped mang giá trị sinh học cao nhất so với tất cả các loại protein có trên thị trường hiện nay, bởi nó không chỉ tăng khả năng hấp thụ mà còn tùy thuộc và thể trạng của cơ thể để Cung cấp ĐỦ lượng protein thiết yếu.</p>\n\n<h3><strong>Được bộ y tế chứng nhận có hiệu quả đốt mỡ thật sự</strong></h3>\n\n<p><strong>Nitro Tech Ripped</strong>&nbsp;được biết đến với những thành phần đặc biệt như L-carnitine L-tartrate, green tea extract ( chiết xuất lá trà xanh ) and conjugated linoleic acid (CLA). Không chỉ có vậy, thành phần rong biển, rose hip oil extract ( chiết xuất nụ hoa hồng ) và MCT oil powder được các chuyên gia đưa vào để tạo nên một công thức độc nhất. Thêm vào đó, sản phẩm chứa C. canephora robusta để mang lại hiệu quả giảm cân tuyệt vời nhất.&nbsp;</p>\n\n<p><strong>Công nghệ lọc Multi-Phase Filtration tiên tiến</strong></p>\n\n<p>Mỗi thìa&nbsp;<strong>NitroTech Ripped</strong>&nbsp;đều cung ứng đủ 30 grams hỗn hợp Whey Protein Isolate và Whey Peptides. Whey Protein được sử dụng trong NITRO-TECH RIPPED đã được thanh lọc thông qua phương pháp lọc Multi-Phase Filtration nhằm mang lại một hỗn hợp ít béo, ít lactose và hoàn toàn nguyên chất so với các sản phẩm&nbsp;<strong>whey protein</strong>&nbsp;thị trường khác. Hơn thế nữa , NITRO- TECH RIPPED được sản xuất dựa trên tiêu chuẩn cGMP với sự cam kết về chất lượng và sự đồng nhất .</p>\n\n<p><em><strong>Công thức siêu sạch kết hợp với hương vị hấp dẫn, khó có thể cưỡng lại!</strong></em></p>\n\n<p>Nhìn vào các dòng sản phẩm whey protein khác, bạn có thể ngạc nhiên với những thành phần hàm chứa! Một số loại protein được đóng gói với lượng chất béo dư thừa không cần thiết, một số khác chứa tới hơn 10 grams carb ( tinh bột ) mỗi thìa sử dụng! NITRO- TECH RIPPED mỗi thìa chứa tới 30 grams protein, chưa kể đến hàm lượng whey peptides siêu sạch (hydrolyzed whey protein) và Whey protein isolate cung cấp lượng marco nuôi dưỡng cơ thể toàn diện.</p>\n\n<p>Hãng Muscle Tech chúng tôi khẳng định, bạn không nhất thiết phải hy sinh lượng marco cho một kết quả ưng ý. Hàm lương marco chúng tôi đề cập tới ở đây gồm 3 thành phần chính: fat( chất béo ), carb ( tinh bột ) và protein sở dĩ bởi đó là 3 nguồn dinh dưỡng cơ thể hấp thu với số lượng nhiều nhất và có ý nghĩa sống còn với cơ thể. Chính vì vậy, đội nghiên cứu kết hợp với những chuyên gia về hương liệu trên toàn thế giới làm việc không ngừng nghỉ để khiến từng hương vị của&nbsp;<strong>NitroTech Ripped</strong>có sự hấp dẫn, đặc trưng riêng. Kết quả là những công thức mới nhưng không hề có sự góp mặt của chất ngọt bổ sung, tinh bột- nhằm cung cấp cho bạn nhiều protein với lượng marco lớn hơn chỉ trong một thìa NITRO-TECH RIPPED.</p>\n\n<p>Một thìa NITRO-TECH RIPPED hàm chứa 30 grams protein với sự kết hợp của hai thành phần chủ chốt là Whey Peptides và 97% Whey protein isolate. Hầu hết các loại bột protein trôi nổi trên thị trường hiện nay sử dụng loại protein rẻ tiền với giá trị dinh dưỡng thấp và ít dinh dưỡng hơn.</p>\n\n<p>NITRO-TECH RIPPED hàm chứa tới 200 mgrams C. canephora robusta, thành phần hóa học đã được chứng minh đem lại hiệu quả giảm cân gấp đôi cho người sử dụng. Ngoài ra, còn một số loại protein được cho là có khả năng đốt mỡ khác nhưng đều đươc bộ y tế khuyến cáo không nên sử dụng bởi giá thành quá rẻ đi đôi với chất lượng kém và những thành phần chưa qua kiểm nghiệm</p>\n\n<p><strong>NITRO – TECH RIPPED&nbsp; hàm chứa tới 500 mg L-Carnitine L-Tartrate</strong>. Nhiều hơn 33% so với các sản phẩm thông thường</p>\n\n<p>Mỗi thìa NITRO- TECH RIPPED chứa 250 mg CLA powder ( bột CLA)</p>\n\n<p>Mỗi thìa chứa tới 100 mg Green tea Extract( chiết xuất lá trà xanh ) duy nhất chỉ có trong NITRO-TECH RIPPED</p>\n\n<p>Mỗi thìa chứa 20 mg rong biển trung tính</p>\n\n<p>Một số loại protein giảm cân hàm chứa cả một lượng nhỏ caffeine, NITRO-TECH RIPPED cam kết không sử dụng thành phần này trong sản phẩm</p>\n\n<p>Giống như tất cả các sản phẩm khác của Muscle Tech, những thành phần sử dụng của&nbsp; NITRO-TECH RIPPED đều được in rõ trên nhãn mác, người sử dụng có thể hoàn toàn yên tâm với hỗn hợp này.</p>\n\n<h3><strong>HƯỚNG DẪN SỬ DỤNG</strong></h3>\n\n<ul>\n	<li>Hoà tan 1 muỗng với 200 - 300ml nước sôi để nguội hoặc sữa tươi không đường.</li>\n	<li>Không pha nước nước ấm hoặc nóng.&nbsp;Để có hiệu quả tốt nhất. Uống ít nhất 2 lần mỗi ngày. Uống cách bữa ăn 1 - 2 giờ đồng hồ. Và ngay sau khi tập trong vòng khoảng 45 phút.</li>\n</ul>\n\n<p>Keywords: MuscleTech NitroTech Ripped, MuscleTech, NitroTech Ripped,</p>', '0', 200, 0, '2019-04-09 15:34:49', '2019-04-09 15:44:46', 1, 8, 15),
(57, 'Best Creatine 50 servings', 550000, 0, '57_1_72248_best-creatine-50-servings.jpg', 0, '<p><img src=\"https://www.wheystore.vn/upload/product/content/best-creatine-50-servings.jpg\" style=\"width: 700px; height: 283px;\" /></p>\n\n<h2><strong>Điểm Nổi Bật Ở BPI Best Creatine</strong></h2>\n\n<p><strong>Best Creatine&nbsp;</strong>là sản phẩm được biết đến với các vai trò:</p>\n\n<ul>\n	<li>Tối ưu hóa phục hồi cơ bắp.</li>\n	<li>Cải thiện khả năng thể thao.</li>\n	<li>6 dạng creatine khác nhau</li>\n	<li>Tăng cường sức mạnh.</li>\n	<li>Tăng trưởng cơ bắp.</li>\n</ul>\n\n<h2><strong>Hàm lượng các chất trong&nbsp;Best Creatine</strong></h2>\n\n<p>Creatine Monohydrate</p>\n\n<p><strong>Best Creatine&nbsp;</strong>là loại creatine được sử dụng nhiều nhất và đáng tin cậy nhất cho đến thời điểm hiện nay được hỗ trợ qua hàng trăm nghiên cứu. Không có 1 hình thức nào khác của creatine được cho là hiệu quả hơn creatine monohydrate.</p>\n\n<p>Creatine Magnapowertm</p>\n\n<p>Trong&nbsp;<strong>Best Creatine</strong>,&nbsp;creatine liên kết với Magie tinh khiết, do đó có khả năng tăng cưởng tính khả dụng của creatine, magie là 1 chất dinh dưỡng cần thiết cho cơ bắp, chịu trách nhiệm việc hydrate hóa tế bào.</p>\n\n<p>Creatine Akg</p>\n\n<p>Là creatine liên kết với AKG (hay alpha-ketoglutarate), 1 tiền chất của glutamine. Các liên kết có khả năng tăng cường sự hấp thu creatine cũng như cung cấp creatine, 1 axit amin quan trong cho việc tăng trưởng và phục hồi cơ bắp.</p>\n\n<p>Creatine Anhydrous</p>\n\n<p>Là creatine monohydrate khô đã loại bỏ phân tử nước, điều này giúp cho bạn sẽ có nhiều creatine hơn trong 1 đơn vị liều dùng.</p>\n\n<p>Creatine Phosphate</p>\n\n<p>Với&nbsp;<strong>Best Creatine&nbsp;</strong>thì&nbsp;creatine liên kết với gốc phosphate hoặc các dạng phổ biến nhất của phosphorous. Đó là các anion trong tế bào có nhiều nhất trong cơ thể. Nó rất quan trọng trong cấu trúc màng tế bào, vận chuyển và trao đổi năng lượng.</p>\n\n<p>pH&nbsp; Buffered Creatine alkalinetm</p>\n\n<p>Sử dụng công nghệ PH Buffering để giúp mức PH cân bằng gần như trung tính, có thể dừng lại các chuyển đổi không mong muốn từ creatine thành creatinine và qua đó tăng cường khả năng hấp thụ Creatine.</p>\n\n<p>Betaine Anhydrous (TMG)</p>\n\n<p>Là một osmolyte, giúp duy trì khối lượng tế bào bình thường, có khả năng giúp sinh tổng hợp creatine và bảo vệ các enzyme nội bào dưới điều kiện thiếu thẩm thấu.</p>\n\n<p>Himalayan Pink Salt</p>\n\n<p>Được khai thác ở chân đồi dày núi Hymalaya có 1 sự cân bằng về khoáng chất và các nguyên tố vi lượng ở dạng tự nhiên và có khả năng giúp tối ưu hóa hấp thu creatine.</p>\n\n<h3><strong>Hướng dẫn sử dụng</strong>&nbsp;<strong>Best Creatine</strong></h3>\n\n<p>Bạn nên pha 1 muỗng sản phẩm&nbsp;<strong>Best Creatine</strong>&nbsp;(1 liều dùng) vào 400-500ml nước lạnh và uống trước, trong, sau buổi tập thể hình . Vào những ngày không tập luyện uống 1 liều vào buổi sáng lúc bụng đói. Để đạt được hiệu quả cao nhất, bạn cần phải có 1 chế độ dinh dưỡng hợp lý và 1 chế độ tập luyện nghiêm túc.</p>\n\n<p><u><em>Cảnh báo</em>:</u>&nbsp;Thực phẩm này không nên dùng cho phụ nữ có thai và cho con bú, nếu bạn có bất cứ bệnh lý gì cần tham khảo ý kiến bác sĩ trước khi dùng. Không vượt quá phần ăn được khuyến cáo. Không sử dụng kết hợp với rượu hoặc các chất kích thích khác. Hạn dùng tốt nhất: xem dưới đáy hộp.</p>\n\n<p>Keywords: best creatine, creatine 50 servings, bpi creatine</p>', '0', 198, 1, '2019-04-09 15:47:41', '2019-04-11 05:13:51', 1, 13, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `tt_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã loại',
  `tt_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'loại tên',
  `tt_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại tạo mới',
  `tt_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại cập nhật',
  `tt_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT '1 là khóa, 2 là khả dụng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhtoan`
--

INSERT INTO `thanhtoan` (`tt_ma`, `tt_ten`, `tt_taoMoi`, `tt_capNhat`, `tt_trangThai`) VALUES
(1, 'Thanh toán Paypal', '2019-01-25 14:58:22', '2019-01-27 15:04:08', 1),
(2, 'Thanh toán khi nhận hàng (COD)', '2019-01-25 14:58:22', '2019-03-25 12:42:05', 1),
(3, 'Chuyển khoản ngân hàng', '2019-01-25 14:58:22', '2019-03-25 12:42:11', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vanchuyen`
--

CREATE TABLE `vanchuyen` (
  `vc_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã loại',
  `vc_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'loại tên',
  `vc_gia` int(10) UNSIGNED NOT NULL COMMENT 'giá vận chuyển',
  `vc_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại tạo mới',
  `vc_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại cập nhật',
  `vc_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT '1 là khóa, 2 là khả dụng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vanchuyen`
--

INSERT INTO `vanchuyen` (`vc_ma`, `vc_ten`, `vc_gia`, `vc_taoMoi`, `vc_capNhat`, `vc_trangThai`) VALUES
(2, 'Giao hàng tiêu chuẩn (Từ 4 - 5 ngày)', 30000, '2019-01-25 14:58:23', '2019-03-25 12:41:44', 1),
(3, 'Giao hàng nhanh (từ 1 - 3 ngày)', 50000, '2019-01-25 14:58:23', '2019-03-25 12:41:20', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`bn_ma`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`ctdh_ma`),
  ADD KEY `chitiethoadon_dh_ma_foreign` (`dh_ma`),
  ADD KEY `n_ma` (`n_ma`);

--
-- Chỉ mục cho bảng `chitiethuong`
--
ALTER TABLE `chitiethuong`
  ADD PRIMARY KEY (`cthv_ma`),
  ADD KEY `huongvi_sp_ma_foreign` (`sp_ma`),
  ADD KEY `hv_ma` (`hv_ma`);

--
-- Chỉ mục cho bảng `chitietkhuyenmai`
--
ALTER TABLE `chitietkhuyenmai`
  ADD PRIMARY KEY (`ctkm_ma`),
  ADD KEY `chitietkhuyenmai_sp_ma_foreign` (`sp_ma`),
  ADD KEY `chitietkhuyenmai_km_ma_foreign` (`km_ma`);

--
-- Chỉ mục cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD PRIMARY KEY (`ctq_ma`),
  ADD KEY `chitietquyen_cv_ma_foreign` (`cv_ma`),
  ADD KEY `chitietquyen_q_ma_foreign` (`q_ma`);

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`cv_ma`),
  ADD UNIQUE KEY `chucvu_cv_ten_unique` (`cv_ten`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`dg_ma`),
  ADD KEY `sp_ma` (`sp_ma`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`dh_ma`),
  ADD KEY `donhang_kh_ma_foreign` (`kh_ma`),
  ADD KEY `donhang_tt_ma_foreign` (`tt_ma`),
  ADD KEY `donhang_vc_ma_foreign` (`vc_ma`);

--
-- Chỉ mục cho bảng `hang`
--
ALTER TABLE `hang`
  ADD PRIMARY KEY (`h_ma`),
  ADD UNIQUE KEY `hang_h_ten_unique` (`h_ten`);

--
-- Chỉ mục cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`ha_ma`),
  ADD KEY `hinhanh_sp_ma_foreign` (`sp_ma`);

--
-- Chỉ mục cho bảng `huongvi`
--
ALTER TABLE `huongvi`
  ADD PRIMARY KEY (`hv_ma`),
  ADD UNIQUE KEY `hv_ten` (`hv_ten`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`kh_ma`),
  ADD UNIQUE KEY `khachhang_kh_email_unique` (`kh_email`),
  ADD UNIQUE KEY `khachhang_kh_dienthoai_unique` (`kh_dienThoai`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`km_ma`),
  ADD KEY `khuyenmai_nv_nguoilap_foreign` (`nv_nguoiLap`);

--
-- Chỉ mục cho bảng `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`l_ma`),
  ADD UNIQUE KEY `loai_l_ten_unique` (`l_ten`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`ncc_ma`),
  ADD UNIQUE KEY `nhacungcap_ncc_ten_unique` (`ncc_ten`),
  ADD UNIQUE KEY `nhacungcap_ncc_email_unique` (`ncc_email`),
  ADD UNIQUE KEY `nhacungcap_ncc_dienthoai_unique` (`ncc_dienThoai`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`nv_ma`),
  ADD UNIQUE KEY `nhanvien_nv_email_unique` (`nv_email`),
  ADD UNIQUE KEY `nhanvien_nv_dienthoai_unique` (`nv_dienThoai`),
  ADD KEY `nhanvien_cv_ma_foreign` (`cv_ma`);

--
-- Chỉ mục cho bảng `nhap`
--
ALTER TABLE `nhap`
  ADD PRIMARY KEY (`n_ma`),
  ADD KEY `sp_ma` (`sp_ma`),
  ADD KEY `hv_ma` (`hv_ma`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`q_ma`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`sp_ma`),
  ADD UNIQUE KEY `sanpham_sp_ten_unique` (`sp_ten`),
  ADD KEY `sanpham_l_ma_foreign` (`l_ma`),
  ADD KEY `sanpham_h_ma_foreign` (`h_ma`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`tt_ma`),
  ADD UNIQUE KEY `thanhtoan_tt_ten_unique` (`tt_ten`);

--
-- Chỉ mục cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD PRIMARY KEY (`vc_ma`),
  ADD UNIQUE KEY `vanchuyen_vc_ten_unique` (`vc_ten`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `bn_ma` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `ctdh_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã chi tiết đơn hàng', AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `chitiethuong`
--
ALTER TABLE `chitiethuong`
  MODIFY `cthv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã chi tiết hương vị', AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT cho bảng `chitietkhuyenmai`
--
ALTER TABLE `chitietkhuyenmai`
  MODIFY `ctkm_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chương trình khuyến mãi', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  MODIFY `ctq_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hinh sản phẩm', AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `cv_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chức vụ: 1-giám đốc, 2-quản trị, 3-quản lý khp, 4-kế toán', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `dg_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Đánh giá mã', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `dh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'đơn hàng mã', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `hang`
--
ALTER TABLE `hang`
  MODIFY `h_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hãng', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `ha_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hinh sản phẩm', AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT cho bảng `huongvi`
--
ALTER TABLE `huongvi`
  MODIFY `hv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã hương vị', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `kh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'khách hàng mã', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `km_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chương trình khuyến mãi', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loai`
--
ALTER TABLE `loai`
  MODIFY `l_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã loại', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `ncc_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã nhà cung cấp';

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `nv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã nhân viên', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `nhap`
--
ALTER TABLE `nhap`
  MODIFY `n_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã', AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `q_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã quyền', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `sp_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm', AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `tt_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã loại', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  MODIFY `vc_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã loại', AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_dh_ma_foreign` FOREIGN KEY (`dh_ma`) REFERENCES `donhang` (`dh_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`n_ma`) REFERENCES `nhap` (`n_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitiethuong`
--
ALTER TABLE `chitiethuong`
  ADD CONSTRAINT `chitiethuong_ibfk_1` FOREIGN KEY (`hv_ma`) REFERENCES `huongvi` (`hv_ma`),
  ADD CONSTRAINT `huongvi_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitietkhuyenmai`
--
ALTER TABLE `chitietkhuyenmai`
  ADD CONSTRAINT `chitietkhuyenmai_km_ma_foreign` FOREIGN KEY (`km_ma`) REFERENCES `khuyenmai` (`km_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietkhuyenmai_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD CONSTRAINT `chitietquyen_cv_ma_foreign` FOREIGN KEY (`cv_ma`) REFERENCES `chucvu` (`cv_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietquyen_q_ma_foreign` FOREIGN KEY (`q_ma`) REFERENCES `quyen` (`q_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_kh_ma_foreign` FOREIGN KEY (`kh_ma`) REFERENCES `khachhang` (`kh_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_tt_ma_foreign` FOREIGN KEY (`tt_ma`) REFERENCES `thanhtoan` (`tt_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_vc_ma_foreign` FOREIGN KEY (`vc_ma`) REFERENCES `vanchuyen` (`vc_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `hinhanh_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `khuyenmai_nv_nguoilap_foreign` FOREIGN KEY (`nv_nguoiLap`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_cv_ma_foreign` FOREIGN KEY (`cv_ma`) REFERENCES `chucvu` (`cv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhap`
--
ALTER TABLE `nhap`
  ADD CONSTRAINT `nhap_ibfk_1` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nhap_ibfk_2` FOREIGN KEY (`hv_ma`) REFERENCES `huongvi` (`hv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_h_ma_foreign` FOREIGN KEY (`h_ma`) REFERENCES `hang` (`h_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_l_ma_foreign` FOREIGN KEY (`l_ma`) REFERENCES `loai` (`l_ma`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
