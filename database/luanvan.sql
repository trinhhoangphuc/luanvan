-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 03, 2019 lúc 07:31 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.2.11

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
(16, '1551505541_slider_item_1_image.jpg', NULL, 1, '2019-03-02 05:45:41', '2019-03-02 05:45:41'),
(17, '1551505548_slider_item_2_image.jpg', NULL, 1, '2019-03-02 05:45:48', '2019-03-02 05:45:48'),
(18, '1551505556_slider_item_3_image.jpg', NULL, 1, '2019-03-02 05:45:56', '2019-03-02 05:45:56'),
(19, '1551513314_banner4.jpg', NULL, 1, '2019-03-02 07:55:14', '2019-03-02 07:55:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `ctdh_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã chi tiết đơn hàng',
  `dh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'mã đơn hàng khóa ngoại',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'sản phẩm mã khóa ngoại',
  `ctdh_soluong` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'số lượng mua',
  `ctdh_donGia` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'đơn giá sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(136, 36, 1),
(137, 37, 6),
(138, 37, 5),
(141, 38, 6),
(142, 38, 5),
(148, 40, 8),
(151, 39, 2),
(152, 39, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkhuyenmai`
--

CREATE TABLE `chitietkhuyenmai` (
  `kmsp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã chương trình khuyến mãi',
  `km_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Chương trình # km_ma # km_ten # Mã chương trình khuyến mãi',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Sản phẩm # sp_ma # sp_ten # Mã sản phẩm',
  `kmsp_giaTri` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'Giá trị khuyến mãi # Giá trị khuyến mãi (giảm tiền/giảm % tiền, số lượng), định dạng: tien;soLuong (soLuong = 0, không giới hạn số lượng)',
  `kmsp_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái # Trạng thái khuyến mãi: 1-ngưng khuyến mãi, 2-có hiệu lực'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietnhap`
--

CREATE TABLE `chitietnhap` (
  `ctn_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'chi tiết nhập mã',
  `pn_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'phiếu nhập mã',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'phiếu nhập mã',
  `ctn_soLuong` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'số lượng nhập',
  `ctn_donGia` int(5) UNSIGNED DEFAULT NULL COMMENT 'số lượng nhập',
  `sp_ngaySX` date DEFAULT NULL COMMENT 'ngày sản xuất',
  `sp_hanSD` date DEFAULT NULL COMMENT 'Hạn sử dụng',
  `ctn_thanhTien` int(11) DEFAULT NULL COMMENT 'tổng hạn sử dụng',
  `sp_tonKho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, 5, 1),
(14, 5, 2),
(15, 5, 3),
(16, 5, 4),
(17, 5, 5),
(18, 5, 6),
(19, 5, 7),
(20, 5, 8),
(21, 5, 9),
(22, 5, 10),
(26, 4, 1),
(27, 4, 3),
(28, 4, 5),
(29, 4, 7),
(30, 2, 1),
(31, 2, 2),
(32, 2, 3),
(33, 2, 4),
(34, 2, 5),
(35, 1, 1),
(36, 1, 2),
(37, 1, 3),
(38, 1, 4),
(39, 1, 5),
(40, 1, 6),
(41, 1, 7),
(42, 1, 8),
(43, 1, 9),
(44, 1, 10),
(45, 1, 11),
(46, 1, 12);

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
(4, 'Nhập liệu', '2019-01-25 14:58:23', '2019-01-25 14:58:23', 1),
(5, 'hello', '2019-01-30 02:55:03', '2019-02-12 09:17:03', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `dg_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Đánh giá mã',
  `dg_sao` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Số sao đánh giá',
  `dg_noiDung` text COMMENT 'nội dung đánh giá',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `kh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã khách hàng',
  `dg_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'trạng thái đánh giá',
  `dg_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo mới',
  `dg_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `dc_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'mã hinh sản phẩm',
  `kh_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'khách hàng khóa ngoại',
  `dc_md` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'địa chỉ mặc đinh',
  `dc_ten` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'địa chỉ tên',
  `dc_duong` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'địa chỉ đường',
  `dc_sdt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'địa chỉ sđt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12, 'Betancourt Nutrition', '2019-03-02 13:55:06', '2019-03-02 13:55:06', 1);

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
(79, 36, 2, '36_2_77287_labrada-muscle-mass-gainer-12-lbs.jpg'),
(80, 37, 4, '37_4_24982_nutrabolics-hydropure-4-5-lbs.png'),
(81, 38, 1, '38_1_13565_myprotein-impact-whey-protein-2-5-kg.jpg'),
(82, 38, 2, '38_2_36041_myprotein-impact-whey-protein-2-5-kg.jpg'),
(83, 38, 3, '38_3_39282_myprotein-impact-whey-protein-2-5-kg.jpg'),
(84, 39, 1, '39_1_59928_dymatize-iso•100-5-lbs-2-27-kg.jpg'),
(85, 39, 2, '39_2_58805_dymatize-iso•100-5-lbs-2-27-kg.jpg'),
(86, 39, 3, '39_3_73186_dymatize-iso•100-5-lbs-2-27-kg.jpg'),
(87, 40, 1, '40_1_19294_betancourt-nutrition-bcaa-plus-series.jpg');

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
(8, 'Watermelon ice', 1, '2019-02-18 05:19:35', '2019-02-18 05:19:35');

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
  `kh_dienThoai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'khách hàng điện thoại',
  `kh_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày khởi tạo',
  `kh_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `kh_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 là khóa, 2 là khả dụng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`kh_ma`, `kh_email`, `kh_matKhau`, `kh_hoTen`, `kh_gioiTinh`, `kh_diaChi`, `kh_dienThoai`, `kh_taoMoi`, `kh_capNhat`, `kh_trangThai`) VALUES
(14, 'thphucct@gmail.com', 'ef4c8bc698b235872006dc96e05b7fbc', 'Trịnh Hoàng Phúc', 0, '39 Nguyễn Đình Chiễu', '14608', '2019-03-02 06:31:13', '2019-03-02 06:31:13', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `km_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'Mã chương trình khuyến mãi',
  `km_ten` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên chương trình # Tên chương trình khuyến mãi',
  `km_noiDung` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Thông tin chi tiết # Nội dung chi tiết chương trình khuyến mãi',
  `km_batDau` datetime NOT NULL COMMENT 'Thời điểm bắt đầu # Thời điểm bắt đầu khuyến mãi',
  `km_ketThuc` datetime DEFAULT NULL COMMENT 'Thời điểm kết thúc # Thời điểm kết thúc khuyến mãi',
  `nv_nguoiLap` smallint(5) UNSIGNED NOT NULL COMMENT 'Lập kế hoạch # nv_ma # nv_hoTen # Mã nhân viên (người lập chương trình khuyến mãi)',
  `km_ngayLap` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm lập # Thời điểm lập kế hoạch khuyến mãi',
  `km_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm tạo # Thời điểm đầu tiên tạo chương trình khuyến mãi',
  `km_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời điểm cập nhật # Thời điểm cập nhật chương trình khuyến mãi gần nhất',
  `km_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái # Trạng thái chương trình khuyến mãi: 1-ngưng khuyến mãi, 2-lập kế hoạch, 3-ký nháy, 4-duyệt kế hoạch'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `l_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'mã loại',
  `l_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'loại tên',
  `l_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại tạo mới',
  `l_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'loại cập nhật',
  `l_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'loại trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`l_ma`, `l_ten`, `l_taoMoi`, `l_capNhat`, `l_trangThai`) VALUES
(8, 'Whey protein', '2019-03-01 06:28:03', '2019-03-01 06:28:03', 1),
(9, 'Mass Gainer', '2019-03-01 06:28:16', '2019-03-01 06:28:16', 1),
(10, 'BCAA', '2019-03-01 06:28:26', '2019-03-01 06:28:26', 1),
(11, 'Vitamin', '2019-03-01 06:28:39', '2019-03-01 06:28:39', 1),
(12, 'Phụ kiện', '2019-03-01 06:29:16', '2019-03-01 06:29:16', 1),
(13, 'Pre-workout', '2019-03-01 06:29:24', '2019-03-01 06:29:24', 1);

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
(3, 'webredshop@gmail.com', 'f109d031808395f2f349b0d8a20b3fcd', 'Admin', 'avatarRedshop.png', 1, '2018-11-10', '378M9/7A Nguyễn Văn Linh', '012345678', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 1),
(4, 'nvien4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên4', NULL, 0, '2018-11-10', 'Omnis.', '13210', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 1),
(5, 'nvien5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên5', NULL, 1, '2018-11-10', 'Qui culpa.', '27858', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 1),
(6, 'nvien6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên6', NULL, 0, '2018-11-10', 'Est.', '44613', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 2),
(8, 'nvien8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên8', NULL, 1, '2018-11-10', 'Eveniet.', '47522', '2019-01-25 14:58:24', '2019-01-25 14:58:24', 1, 3),
(9, 'phuctrinhit@gmail.com', 'f46be7e1fedd1022f389a7ea7d77f1d6', 'sdsf', NULL, 1, '2019-02-23', '39 Nguyễn Đình Chiễu', '12334345', '2019-02-23 14:53:44', '2019-02-23 14:53:44', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap`
--

CREATE TABLE `nhap` (
  `n_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'mã',
  `sp_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'sp mã',
  `n_soLuong` int(10) UNSIGNED NOT NULL COMMENT 'sp số lượng',
  `hv_ma` smallint(5) UNSIGNED NOT NULL COMMENT 'huongw vij max',
  `n_ngaySX` date DEFAULT NULL COMMENT 'sp ngày sản xuất',
  `n_hanSD` date DEFAULT NULL COMMENT 'sp hạn sử dụng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhap`
--

INSERT INTO `nhap` (`n_ma`, `sp_ma`, `n_soLuong`, `hv_ma`, `n_ngaySX`, `n_hanSD`) VALUES
(27, 36, 50, 1, '2019-03-01', '2022-03-01'),
(28, 37, 20, 6, '2019-03-01', '2022-03-01'),
(29, 37, 23, 6, '2019-03-01', '2020-03-01'),
(30, 38, 60, 6, '2019-03-02', '2025-03-02'),
(31, 38, 50, 5, '2019-03-02', '2025-03-02'),
(32, 39, 20, 2, '2019-03-02', '2025-03-02'),
(33, 39, 20, 1, '2019-03-02', '2025-03-02'),
(34, 40, 30, 8, '2019-03-02', '2022-03-02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `pn_ma` bigint(20) UNSIGNED NOT NULL COMMENT 'đơn hàng mã',
  `pn_soHoaDon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'số hóa đơn',
  `pn_ngayXuatHoaDon` date DEFAULT NULL COMMENT 'ngày xuất hóa đơn',
  `pn_ghiChu` text COLLATE utf8mb4_unicode_ci COMMENT 'phiếu nhập ghi chú',
  `nv_lapPhieu` smallint(5) UNSIGNED NOT NULL COMMENT 'nhân viên lập phiếu',
  `pn_ngayXacNhan` date DEFAULT NULL COMMENT 'ngày xuất hóa đơn',
  `nv_xuLy` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nhân viên xử lý dh',
  `pn_taoMoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày tạo mới',
  `pn_capNhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngày cập nhật',
  `pn_trangThai` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 chờ duyệt',
  `ncc_ma` tinyint(3) UNSIGNED NOT NULL COMMENT 'khóa ngoại nhà cung cấp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, 'Quản lý banner');

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

INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_giaBan`, `sp_giamGia`, `sp_hinh`, `sp_thongTin`, `sp_danhGia`, `sp_soLuong`, `sp_tinhTrang`, `sp_taoMoi`, `sp_capNhat`, `sp_trangThai`, `l_ma`, `h_ma`) VALUES
(36, 'LABRADA MUSCLE MASS GAINER 12 LBS', 1600000, 1500000, '36_2_77287_labrada-muscle-mass-gainer-12-lbs.jpg', '<h2>1. Tăng Cân Hay Tăng Cơ? Tăng Nạc Hay Tăng Mỡ?</h2><p>Tất nhiên khi chọn mua 1 dòng sản phẩm mass tăng cân người ta sẽ nghĩ ngay thành phần của nó có đáng giá hay không? Nó sẽ giúp mình tăng cân nhiều hay tăng cơ nhiều? Tăng nạc nhiều hay tăng mỡ nhiều. Và hơn 90% dòng mass gainer cao năng lượng (trên 1000 calo trong 1 lần dùng) đều cho 1 kết quả lừa bịp đó là tăng mỡ nhiều hơn tăng cơ và tích nước trong cơ thể tạo cảm giác \"to\". Rõ ràng điều này không tốt nhưng cũng có mặt ích lợi của nó là tạo 1 cảm giác \"lừa dối\" ngọt ngào. Bạn sẽ vui và tự tin hơn khi tăng được vài kg sau những năm dài khó tăng cân. Chỉ có 1 số ít sản phẩm trên thị trường hiện nay cho bạn 2 chữ tăng cân đúng nghĩa và Muscle Mass Gainer của hãng Labrada (còn sở hữu thương hiệu LeanBody) là 1 bước đột phá mạnh vào thị trường sản phẩm tăng cân cao cấp \"TĂNG CÂN NHANH, CƠ NẠC NHIỀU HẠN CHẾ TĂNG MỠ VÀ TÍCH NƯỚC\". Nếu chỉ nhìn vào những con số dinh dưỡng thì bạn sẽ khó phát hiện ra đâu là điểm nổi bật của sản phẩm nếu không có cái nhìn chuyên môn. Nhưng sứ mệnh của Labrada luôn cho ra những sản phẩm Lean Body (thương hiệu Tăng cơ giảm mỡ) từ lúc sáng lập đến ngày hôm nay. Rất đơn giản, mục tiêu của Muscle Mass Gainer mang đến khách hàng sử dụng là&nbsp;<strong>Tăng cân nhanh, tăng cơ, tăng sức mạnh</strong></p><h2>2. Tại Sao Phải Dùng Muscle Mass Gainer?</h2><p>Đơn giản là với thức ăn tự nhiên bạn không thể nào hấp thu được 1 lượng lớn calo trong thời gian ngắn, chưa kể đến hệ tiêu hóa của bạn phải ì ạch tiêu hóa 1 lượng lớn thức ăn lâu ngày sẽ bị quá tải và sinh ra nhiều bệnh nguy hiểm về đường tiêu hóa. Ăn nhiều mà không hấp thu cũng trở thành 1 vấn đề phổ biến đối với những bạn khó tăng cân, thì lúc này Muscle Mass Gainer là sư chọn lựa tuyệt vời cho mục tiêu tăng cơ, tăng cân nhanh. Hơn thế nữa với thành phần và tỉ lệ dinh dưỡng tối ưu sẽ giúp cho những người chơi thể hình hấp thu tốt nhất, tăng cơ, tăng cân hiệu quả nhất.</p><ul><li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;được thiết kế bới Labrada, 1 thương hiệu tiên phong trong những nghiên cứu sản xuất các sản phẩm cao cấp nhằm mục tiêu&nbsp;<strong>tăng cơ, giảm mỡ</strong>, đột phá những điều gần như là không thể trong lĩnh vực tăng cân.</li><li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;cho chúng ta 1930calo và 84g protein khi được pha chung với 1 lít sữa tươi nguyên chất.</li><li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;cho chúng ta dễ dàng hấp thu 1 lượng lớn calo và protein tăng cơ có chất lượng cao nhất với 1 mùi vị tuyệt nhất.</li><li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;có thể được sử dụng như 1 bữa ăn thay thế (MRP) hay 1 sản phẩm phục hồi sau khi tập, nó chứa nhiều năng lượng với protein xây dựng cơ, carbonhydrate, creatine và nhiều thành phần dưỡng chất quan trọng khác trong đó có Vitamin và khoáng chất.</li><li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;Chứa 17g BCAA (Branch chain amino axit) giúp bạn phục hồi tốt sau tập luyện, và trở nên to hơn, khỏe hơn, nhanh hơn.</li><li>&nbsp;<strong>Muscle Mass Gainer</strong>&nbsp;không chứa các thành phần tinh bột rẻ tiền kém chất lượng như: dextrose, sucrose hay corn syrup solids</li></ul><p>Muscle Mass Gainer là một sản phẩm tuyệt với danh cho những vận động viên trẻ muốn gia tăng khối lượng protein và chỉ số calo để tăng cân và cơ nhanh nhất, hiệu quả nhất. Nó thật sự là 1 bước đột phá trong dòng sản phẩm protein shake mang về cho bạn 1 diện mạo mới, 1 khối lượng cơ bắp mới.</p><p><img alt=\"Lee Labrada Vietnam\" src=\"http://media.bizwebmedia.net/sites/101366/data/Upload/2015/7/lee_labrada_thumb.jpg\" />Lee Labrada<em>Founder, Labrada Nutrition IFBB Pro Bodybuilding Hall of Fame</em></p><h2>3. Những Ai Cần Dùng Muscle Mass Gainer?</h2><p>Muscle Mass Gainer là 1 sản phẩm hướng đến đại đa số người dùng Việt Nam, mọi đối tượng, mọi tầng lớp. Tuy nhiên những đối tượng sau đây được ưu tiên sử dụng:</p><ul><li>&nbsp;Người khó tăng cân, người gầy, người hấp thu kém.</li><li>&nbsp;Vận động viên thể hình trong gai đoạn xả cơ sau thi đấu</li><li>&nbsp;Người tập thể hình, GYM, trong giai đoạn bulking, cần tăng cơ</li><li>&nbsp;Người theo fitness trong giai đoạn 1, giai đoạn xây dựng cơ bắp</li><li>&nbsp;Người già, người bệnh hấp thu kém, khả năng ăn uống hạn chế (hỏi bác sĩ về liều dùng)</li></ul><h2>4. Muscle Mass Gainer Mùi Vị Cực Ngon</h2><p>Ngoài tính năng dễ hòa tan với độ mịn cao, Muscle Mass Gainer còn sở hữu 1 mùi vị cực ngon, cực kì dễ uống so với những dòng mass tăng cân khác (thường rất khó hòa tan và mụi vị ngọt rất khó uống). Sản phẩm này đã lần lượt phá vỡ những thành tích trước đó về công nghệ cải tiến mùi vị của các bậc đàn anh. Mang đến 1 sự tự tin và hứng khởi mới dành cho những khách hàng của nó. Giúp bạn có thể chiến đấu lâu dài cùng sản phẩm này trong cuộc chiến \"xóa bỏ quá khứ gầy còm sau lưng\". Để có được sự ngon miệng tuyệt đối khi sử dụng các bạn vui lòng xem qua video hướng dẫn cách pha chế bên dưới.</p><h2>5. Muscle Mass Gainer Những Con Số Ấn Tượng</h2><p>1930 calo, 84g protein, 17g BCAA + Creatine khi được pha với 1 lít sữa tươi (whole milk) là 1 con số không thể ấn tượng hơn đối với 1 sản phẩm mass gainer tăng cân tăng cơ theo kiểu Lean Body như Muscle Mass Gainer. Nếu bạn 60kg, bạn chỉ cần dùng 2 liều mỗi ngày là có thể tăng cân rồi, nhưng bạn đừng làm thế, hãy dùng sản phẩm này kết hợp với ăn uống bình thường như hằng ngày để có 1 kết quả tốt mà vẫn đảm bảo được thói quen sinh hoạt hằng ngày nhé. Tất nhiên bạn không thể nạp 1 lúc chừng ấy calo, có thể sẽ có 1 sự lãng phí, hay chia làm 2 lần uống để đảm bảo hấp thu tốt nhất. Bên cạnh đó sản phẩm cũng chứa 1 lượng tương đối đầy đủ vitamin và khoáng chất kết hợp, bạn sẽ không sợ thiếu những vi chất dinh dưỡng này trong đời sống hằng ngày.</p><h2>6. Cách Sử Dụng Muscle Mass Gainer Hiệu Quả Nhất</h2><p>Đối với người mới sử dụng, 7 ngày đầu tiên:</p><p>Dùng 1.5 muỗng/lần với 250 ml nước lạnh hoặc nước đun sôi để nguội, để đạt kết quả tăng cân tốt hơn bạn có thể pha sữa với 200ml nước hoa quả hoặc sữa tươi. Một ngày sử dụng 3 lần vào các thời điểm:</p><p>Lần 1: Sau ăn sáng 1 giờ.</p><p>Lần 2: Trước tập 1 giờ.</p><p>Lần 3: Ngay sau tập.</p><p>Sang tuần thứ 2 trở đi.</p><p>Dùng 3 muỗng/lần với 400 ml nước lạnh hoặc nước đun sôi để nguội, để đạt kết quả tăng cân tốt hơn bạn có thể pha sữa với 300ml nước hoa quả hoặc sữa tươi. Một ngày sử dụng 3 lần vào các thời điểm:</p><p>Lần 1: Sau ăn sáng 1 giờ.</p><p>Lần 2: Trước tập 1 giờ.</p><p>Lần 3: Ngay sau tập.</p><p><strong><em>Lưu &nbsp;ý:</em></strong></p><p>- Nên lắc bằng bình lắc chuyên dụng, hoặc máy xay sinh tố mới đảm bảo độ tan của sản phẩm.</p><p>- Không pha với nước nóng.</p><p>- Sử dụng ngay sau khi pha, không để lâu, để tủ lạnh tích trữ.</p><p>- Duy trì chế độ ăn như trước khí sử dụng, hoặc ăn bổ sung nếu có thể sẽ giúp tăng cân tốt hơn.</p><p>- Sau khi tăng cân đủ, mà không sử dụng sản phẩm, sẽ không bị giảm cân nếu bạn ăn đầy đủ bù thêm dinh dưỡng cho cơ thể.</p>', '0', 50, 1, '2019-03-01 06:34:14', '2019-03-02 05:41:56', 1, 9, 8),
(37, 'Nutrabolics Hydropure, 4.5 Lbs', 1800000, NULL, '37_4_24982_nutrabolics-hydropure-4-5-lbs.png', '<h2><strong>KHOA HỌC BÊN TRONG HYDROPURE</strong></h2><p>Hydrolyzation là một quá trình kỹ thuật để loại bỏ các chất béo, lactose và protein predigest để hình thành các chuỗi polypeptide nhỏ của axit amin. Các axit amin này được cơ thể hấp thụ nhanh chóng, giúp thúc đẩy sự phát triển và sửa chữa cơ bắp. Kết quả là nguồn protein đậm đặc nhất được biết đến trong&nbsp;khoa học với hơn 93% protein, 5,9 gam axit amin chuỗi nhánh (BCAAs) và 13 gram axit amin thiết yếu (EAAs) trong mỗi khẩu phần!</p><p><strong>Dễ tiêu hóa</strong><br />Hydrolyzation cũng làm cho chất đạm whey dễ dàng hơn cho cơ thể tiêu hóa và hấp thụ, cung cấp dinh dưỡng tức thời. Nhưng để tăng cường sự hấp thụ, nhóm nghiên cứu của chúng tôi đã tăng cường&nbsp;<a href=\"https://gymstore.vn/nutrabolic\">NUTRABOLICS</a>HYDROPURE ™ với enzyme tiêu hóa protease, amylase và lactase. Điều này cho phép toàn bộ công thức để cung cấp kết quả dinh dưỡng tối đa.</p><p><strong>Nói KHÔNG với&nbsp;Amino Spiking</strong><br />Giống như tất cả các protein của chúng tôi,&nbsp;<a href=\"https://gymstore.vn/nutrabolics-hydropure-4-5-lbs-68-servings\">HYDROPURE</a>&nbsp;được sản xuất tại cơ sở sản xuất được chính phủ kiểm tra để đảm bảo chất lượng tối đa mà bạn có thể tin tưởng. Công thức này chỉ chứa toàn bộ các nguồn protein không có amino acid bổ sung - chỉ là protein thuần túy với zero amino spiking. Cái gì trong nhãn là những bạn nhận được khi sử dụng sản phẩm.</p><p><img data-thumb=\"original\" original-height=\"796\" original-width=\"710\" src=\"https://bizweb.dktcdn.net/100/011/344/files/screen-shot-2018-04-21-at-12-22-27-pm.png?v=1524288180046\" /></p><p>Ultrabolics HydroPure được phân phối chính hãng bởi Gymstore Việt Nam, hỗ trợ giảm cân, giảm mỡ hiệu quả, không tác dụng phụ. Miễn phí giao hàng nội thành HN &amp; HCM. Giao hàng toàn quốc.&nbsp;</p>', '0', 43, 1, '2019-03-01 08:26:32', '2019-03-02 06:28:29', 1, 8, 9),
(38, 'MyProtein Impact Whey Protein, 2.5 Kg', 1300000, NULL, '38_2_36041_myprotein-impact-whey-protein-2-5-kg.jpg', '<p><img src=\"https://bizweb.dktcdn.net/100/011/344/files/dip-belt-1-lg.jpg?v=1479402928259\" /></p><p>- &nbsp;Impact Whey Protein&nbsp;đại diện cho một phương pháp chất lượng cao thuận tiện của việc đảm bảo cơ bắp của bạn được cung cấp đủ chất đạm trong suốt cả ngày. Hàm lượng protein cao của sản phẩm này sẽ góp phần vào sự phát triển và duy trì khối lượng cơ bắp. Chỉ &nbsp;với 103 calo mỗi khẩu phần, Impact Whey Protein là một bạn đồng hành lý tưởng cho việc hỗ trợ một loạt các vận động viên, cho dù nghiệp dư, trung cấp hoặc chuyên gia.</p><p>Lợi ích</p><p>* 18g-21g protein mỗi lần dùng tuỳ theo hương vị</p><p>* 4.5g của bao gồm 2g BCAA của leucine mỗi lần dùng</p><p>* Hạng A hạng trên LabDoor</p><p>&nbsp;</p><p>* Hỗ trợ tất cả các mục tiêu đào tạo</p><p><b><font>Cách dùng:</font></b>&nbsp;<font>1 muỗng&nbsp;</font>(25g)&nbsp;+ 200ml nước hoặc sữa tươi&nbsp;</p><p><font>Các thời điểm dùng tốt nhất&nbsp;</font>30 phút trước và / hoặc sau khi tập luyện của bạn&nbsp;</p><p>Trộn 1 muỗng với sữa , yến mạch , ngũ cốc bạn sẽ có 1 bữa sáng đầy dinh dưỡng</p><p>Ngoài ra, có thể giữa các bữa ăn trong ngày để tăng lượng protein hàng ngày của bạn.</p><p><img src=\"https://bizweb.dktcdn.net/100/011/344/files/d-7dd6c99b-598c-4716-a8b0-03842768ab4f.png?v=1479402771230\" /></p>', '0', 110, 1, '2019-03-02 07:58:54', '2019-03-02 08:05:15', 1, 8, 10),
(39, 'Dymatize ISO•100 5 Lbs (2,27 kg)', 2300000, NULL, '39_1_59928_dymatize-iso•100-5-lbs-2-27-kg.jpg', '<p>&nbsp;&nbsp;&nbsp;Nhu cầu cung cấp&nbsp;<a href=\"http://gymstore.vn/protein-phat-trien-co\"><strong>whey protein isolate</strong></a>&nbsp;là thiết yếu, và hầu hết các chuyên gia dinh dưỡng và những người chơi thể thao sau khi dùng Dymatize Iso 100 đều nhận định rằng Iso 100 mang lại mùi vị, và hiệu quả thật khác biệt. Với công nghệ khoa học cao, whey protein Isolate đã được tách và xử lý một cách hoàn hảo, 100 % whey Isolate đã được phân nhánh trải qua 5 quá trình kiểm tra và kiểm soát về chất lượng. Iso 100 được thiết kế đánh bật hoàn toàn lactose và chất béo, không còn gì khiến bạn bận tâm và lo lắng ngoài protein và các chất đồng hóa khác giúp tiêu hóa dễ dàng.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; Trong thực tế protein đóng vai trò quan trọng để nuôi dưỡng xây dựng cơ bắp và duy trì trạng thái cân bằng Nito, một phần không thể thiếu trong suốt quá trình tập luyện căng thẳng. Iso 100 được thiết kế nhằm mục đích mang lại nguồn cung cấp với hàm lượng protein cao nhất, bởi vậy với Iso 100 bạn hoàn toàn tự tin rằng các khối cơ bắp sẽ được nuôi dưỡng hàng ngày một cách hiệu quả.&nbsp;</p><p><img alt=\"\" src=\"http://media.bizwebmedia.net/sites/101366/data/Upload/2015/4/screenclip.png\" /></p><p><strong><em>Gymstore.vn cam kết hàng chính hãng, giá&nbsp;Dymatize ISO•100 tốt nhất thị trường.</em></strong></p>', '0', 40, 1, '2019-03-02 13:49:17', '2019-03-02 13:58:57', 1, 8, 11),
(40, 'Betancourt Nutrition BCAA Plus Series', 550000, NULL, '40_1_19294_betancourt-nutrition-bcaa-plus-series.jpg', '<h2>TẦM QUAN TRỌNG CỦA L-LEUCINE</h2><p>BCAA (Axit amin chuỗi nhánh) là 3 axit amin thiết yếu cho cơ thể. Chúng được coi là ’thiết yếu vì cơ thể không sản xuất ra chúng và chúng phải được tiêu thụ trong chế độ ăn kiêng. Có rất nhiều nghiên cứu cho thấy rằng BCAA thúc đẩy phục hồi, duy trì và tăng trưởng cơ bắp. Điều quan trọng nhất của BCAA tăng cường khả năng&nbsp;tổng hợp protein nhờ&nbsp;L-Leucine.</p><h2>ACTIVE TR ™ LEUCINE</h2><p>Cung cấp axit amin thiết yếu đồng hóa nhất cho cơ thể theo thời gian để kéo dài tín hiệu tổng hợp protein. Đó là lý do vì sao sản phẩm lại có tỉ lệ BCAA 4:1:1 với hàm lượng lớn&nbsp;L-Leucine</p><h2>BCAA HẤP THU NHANH CHÓNG</h2><p>Sẽ thật tuyệt vời khi cơ thể đang trong trạng thái mệt mỏi được bổ sung BCAA ngay lập tức với hương vị thơm ngon, dễ chịu. Điều đó sẽ giúp bạn quay trở lại trạng thái sung mãn nhất để hoàn thành buổi tập một cách hiệu quả, đồng thời kéo dài thời gian tổng hợp protein sau tập, một yêu tố rất quan trọng của quá trình phát triển cơ bắp. Chính vì vậy đừng bỏ qua BCAA trong tập vì đó là sản phẩm \"THIẾT YẾU\" của một GYMER đích thực</p><ul><li>HỖ&nbsp;TRỢ PHỤC HỒI&nbsp;&amp; TỔNG HỢP PROTEIN.&nbsp;</li><li>TỶ LỆ BCAA 4: 1: 1&nbsp;</li><li>BỔ SUNG CHẤT ĐIỆN GIẢI VÀ SUSTAMINE®.&nbsp;</li><li>GIẢI PHÁP BÙ NƯỚC NHANH CHÓNG, TĂNG SỨC BÊN HIỆU QUẢ</li></ul><p>&nbsp;</p><p><img data-thumb=\"original\" original-height=\"410\" original-width=\"480\" src=\"https://bizweb.dktcdn.net/100/011/344/files/bcaa-plus-series-171ed3ae-be28-48ce-b25d-cc05c2bb9256.png?v=1546320604217\" /></p>', '0', 30, 1, '2019-03-02 13:55:51', '2019-03-02 13:56:52', 1, 10, 12);

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
(2, 'COD', '2019-01-25 14:58:22', '2019-01-25 14:58:22', 1),
(3, 'Chuyển khoản', '2019-01-25 14:58:22', '2019-01-25 14:58:22', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtin`
--

CREATE TABLE `thongtin` (
  `ch_ma` int(10) UNSIGNED NOT NULL COMMENT 'mã',
  `ch_ten` varchar(250) DEFAULT NULL COMMENT 'Tên',
  `ch_email` varchar(250) DEFAULT NULL COMMENT 'email',
  `ch_diaChi` varchar(150) DEFAULT NULL COMMENT 'đại chỉ',
  `ch_dienThoai` varchar(12) DEFAULT NULL COMMENT 'điện thoại',
  `ch_thongTin` text COMMENT 'thông tin',
  `ch_logo_title` varchar(100) DEFAULT NULL COMMENT 'logo nhỏ',
  `ch_logo_header` varchar(150) DEFAULT NULL COMMENT 'Logo Lớn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'SupperShip', 20000, '2019-01-25 14:58:23', '2019-02-28 04:51:09', 1),
(2, 'ViettelPost', 30000, '2019-01-25 14:58:23', '2019-02-28 04:51:15', 1),
(3, 'Giao hàng nhanh', 50000, '2019-01-25 14:58:23', '2019-02-28 04:51:20', 1);

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
  ADD KEY `chitiethoadon_sp_ma_foreign` (`sp_ma`);

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
  ADD PRIMARY KEY (`kmsp_ma`),
  ADD KEY `chitietkhuyenmai_sp_ma_foreign` (`sp_ma`),
  ADD KEY `chitietkhuyenmai_km_ma_foreign` (`km_ma`);

--
-- Chỉ mục cho bảng `chitietnhap`
--
ALTER TABLE `chitietnhap`
  ADD PRIMARY KEY (`ctn_ma`),
  ADD KEY `chitietnhap_pn_ma_foreign` (`pn_ma`),
  ADD KEY `chitietnhap_sp_ma_foreign` (`sp_ma`);

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
  ADD KEY `sp_ma` (`sp_ma`),
  ADD KEY `kh_ma` (`kh_ma`);

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`dc_ma`),
  ADD KEY `diachi_kh_ma_foreign` (`kh_ma`);

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
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`pn_ma`),
  ADD KEY `phieunhap_ncc_ma_foreign` (`ncc_ma`),
  ADD KEY `phieunhap_nv_lapphieu_foreign` (`nv_lapPhieu`);

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
-- Chỉ mục cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  ADD PRIMARY KEY (`ch_ma`);

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
  MODIFY `bn_ma` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `ctdh_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã chi tiết đơn hàng';

--
-- AUTO_INCREMENT cho bảng `chitiethuong`
--
ALTER TABLE `chitiethuong`
  MODIFY `cthv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã chi tiết hương vị', AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT cho bảng `chitietkhuyenmai`
--
ALTER TABLE `chitietkhuyenmai`
  MODIFY `kmsp_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chương trình khuyến mãi';

--
-- AUTO_INCREMENT cho bảng `chitietnhap`
--
ALTER TABLE `chitietnhap`
  MODIFY `ctn_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'chi tiết nhập mã';

--
-- AUTO_INCREMENT cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  MODIFY `ctq_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hinh sản phẩm', AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `cv_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chức vụ: 1-giám đốc, 2-quản trị, 3-quản lý khp, 4-kế toán', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `dg_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Đánh giá mã';

--
-- AUTO_INCREMENT cho bảng `diachi`
--
ALTER TABLE `diachi`
  MODIFY `dc_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hinh sản phẩm';

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `dh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'đơn hàng mã';

--
-- AUTO_INCREMENT cho bảng `hang`
--
ALTER TABLE `hang`
  MODIFY `h_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hãng', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `ha_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã hinh sản phẩm', AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `huongvi`
--
ALTER TABLE `huongvi`
  MODIFY `hv_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã hương vị', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `kh_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'khách hàng mã', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `km_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chương trình khuyến mãi';

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
  MODIFY `n_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `pn_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'đơn hàng mã';

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `q_ma` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã quyền', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `sp_ma` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `tt_ma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã loại', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  MODIFY `ch_ma` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã';

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
  ADD CONSTRAINT `chitiethoadon_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Các ràng buộc cho bảng `chitietnhap`
--
ALTER TABLE `chitietnhap`
  ADD CONSTRAINT `chitietnhap_pn_ma_foreign` FOREIGN KEY (`pn_ma`) REFERENCES `phieunhap` (`pn_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietnhap_sp_ma_foreign` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`kh_ma`) REFERENCES `khachhang` (`kh_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `diachi_kh_ma_foreign` FOREIGN KEY (`kh_ma`) REFERENCES `khachhang` (`kh_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ncc_ma_foreign` FOREIGN KEY (`ncc_ma`) REFERENCES `nhacungcap` (`ncc_ma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phieunhap_nv_lapphieu_foreign` FOREIGN KEY (`nv_lapPhieu`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE CASCADE ON UPDATE CASCADE;

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
