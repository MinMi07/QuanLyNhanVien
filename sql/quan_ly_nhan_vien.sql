-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 04:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quan_ly_nhan_vien`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bacluong`
--

CREATE TABLE `bacluong` (
  `MaBacLuong` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `SoTien` int(11) DEFAULT NULL,
  `ThoiGianTao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `bacluong`
--

INSERT INTO `bacluong` (`MaBacLuong`, `MaNhanVien`, `SoTien`, `ThoiGianTao`) VALUES
(5, 1, 100000, '2025-03-31 00:00:00'),
(6, 2, 200000, '2025-03-31 00:00:00'),
(7, 1, 2000000, '2025-04-01 00:00:00'),
(8, 3, 100000, '2025-04-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cauhinhthongso`
--

CREATE TABLE `cauhinhthongso` (
  `CauHinh` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `GiaTri` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `cauhinhthongso`
--

INSERT INTO `cauhinhthongso` (`CauHinh`, `GiaTri`) VALUES
('thoiGianChamCong', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chamcong`
--

CREATE TABLE `chamcong` (
  `MaChamCong` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `TrangThai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chamcong`
--

INSERT INTO `chamcong` (`MaChamCong`, `MaNhanVien`, `ThoiGian`, `TrangThai`) VALUES
(6, 3, '2025-03-29 22:09:35', 0),
(8, 3, '2025-03-30 22:51:49', 0),
(9, 3, '2025-03-31 12:09:57', 0),
(10, 45, '2025-03-31 20:56:34', 1),
(11, 3, '2025-04-01 09:04:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hopdong`
--

CREATE TABLE `hopdong` (
  `MaHopDong` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `LoaiHopDong` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `NgayBatDau` datetime DEFAULT NULL,
  `NgayHetHan` datetime DEFAULT NULL,
  `BacLuong` int(11) DEFAULT NULL,
  `HeSoLuong` int(11) DEFAULT NULL,
  `PhuCap` int(11) DEFAULT NULL,
  `BaoHiem` int(11) DEFAULT NULL,
  `LuongThoaThuan` int(11) DEFAULT NULL,
  `TrangThai` int(11) DEFAULT NULL,
  `ThoiGianTao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `hopdong`
--

INSERT INTO `hopdong` (`MaHopDong`, `MaNhanVien`, `LoaiHopDong`, `NgayBatDau`, `NgayHetHan`, `BacLuong`, `HeSoLuong`, `PhuCap`, `BaoHiem`, `LuongThoaThuan`, `TrangThai`, `ThoiGianTao`) VALUES
(1, 1, 'Hợp đồng', '2024-10-17 00:00:00', '2025-06-21 00:00:00', 1, 1, 100000, 10, 2000000, 0, '2025-04-01 17:41:18'),
(2, 2, 'Công chức', '2024-12-12 00:00:00', '2025-06-21 00:00:00', 2, 2, 200000, 80, 4000000, 1, '2025-04-01 17:41:18'),
(3, 3, 'Thời vụ', '2025-03-05 00:00:00', '2025-03-28 00:00:00', 1, 1, 10000, 80, 60000000, 1, '2025-04-01 17:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `khenthuongkyluat`
--

CREATE TABLE `khenthuongkyluat` (
  `MaKhenThuongKyLuat` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `ThoiGianKhenThuongKyLuat` datetime DEFAULT NULL,
  `Loai` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `NoiDung` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `SoQuyetDinh` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `CoQuanQuyetDinh` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `HinhThuc` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `SoTien` int(11) DEFAULT 0,
  `TrangThai` varchar(50) COLLATE utf8mb4_bin DEFAULT 'Chờ duyệt',
  `GhiChu` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `khenthuongkyluat`
--

INSERT INTO `khenthuongkyluat` (`MaKhenThuongKyLuat`, `MaNhanVien`, `ThoiGianKhenThuongKyLuat`, `Loai`, `NoiDung`, `SoQuyetDinh`, `CoQuanQuyetDinh`, `HinhThuc`, `SoTien`, `TrangThai`, `GhiChu`) VALUES
(10, 1, '2025-03-06 00:00:00', 'khen thưởng', 'Hoàn thành xuất sắc', 'Q1', 'Trưởng phòng ban', 'khen thưởng', 100000, '1', 'khen thưởng công việc'),
(11, 2, '2025-03-13 00:00:00', 'Kỷ luật', 'Vi phạm hút thuốc', 'Q2', 'Hành chính', 'Giảm lương', 100000, '1', 'Kỷ luật lần 1'),
(12, 3, '2025-04-02 00:00:00', 'Khen thưởng', 'Khen thưởng thành tích', '1', 'Ban giám đốc', 'Tuyên dương', 100000, '1', 'Tăng lương lần 1');

-- --------------------------------------------------------

--
-- Table structure for table `luong`
--

CREATE TABLE `luong` (
  `MaLuong` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `ThoiGianTao` datetime DEFAULT NULL,
  `SoTien` int(11) DEFAULT NULL,
  `TheLoai` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `MoTa` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `luong`
--

INSERT INTO `luong` (`MaLuong`, `MaNhanVien`, `ThoiGianTao`, `SoTien`, `TheLoai`, `MoTa`) VALUES
(6, 2, '2025-04-01 14:15:19', 0, 'Chuyển tiền thành công', 'Lương tháng 03'),
(7, 3, '2025-04-01 14:15:19', 309920, 'Chuyển tiền thành công', 'Lương tháng 03');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` int(11) NOT NULL,
  `HoTen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TaiKhoan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrinhDo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgoaiNgu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CMND` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `DiaChi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SDT` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `TonGiao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DanToc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ChucVu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PhongBan` int(11) DEFAULT NULL,
  `NgayVaoDoan` date DEFAULT NULL,
  `NgayVaoDang` date DEFAULT NULL,
  `LoaiNhanVien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TinhTrangHonNhan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Cha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VoChong` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Con` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BacLuong` int(11) DEFAULT NULL,
  `PhongCongTac` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CongViec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgayThamGia` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `HoTen`, `TaiKhoan`, `NgaySinh`, `GioiTinh`, `TrinhDo`, `NgoaiNgu`, `CMND`, `DiaChi`, `SDT`, `Email`, `TonGiao`, `DanToc`, `ChucVu`, `PhongBan`, `NgayVaoDoan`, `NgayVaoDang`, `LoaiNhanVien`, `TinhTrangHonNhan`, `Cha`, `Me`, `VoChong`, `Con`, `BacLuong`, `PhongCongTac`, `CongViec`, `NgayThamGia`) VALUES
(1, 'Nguyễn Văn A', 'anv', '1963-12-31', 'Nam', 'Đại Học', 'B1', '001201021234', 'Hà Nội', '0964438321', 'a@gmail.com', 'Không', 'Kinh', 'Nhân Viên', 1, '2025-02-26', '2025-03-25', 'Hợp đồng', 'chưa', 'Nguyễn Văn B', 'Nguyễn Thị C', 'Nguyễn Thị D', 'Nguyễn Văn D', 2, '1', 'Xếp đồ', '2022-03-31'),
(2, 'Nguyễn Văn X', 'xvn', '1968-07-31', 'Nữ', 'Cao đẳng', 'B2', '000000000010', 'Nam Từ Liêm, Hà Nội', '0999999999', 'xvn@gmail.com', 'không', 'kinh', 'Nhân viên', 2, '2025-03-03', '2025-03-09', 'hợp đồng', 'Chưa kết hôn', 'Nguyễn Văn Y', 'Nguyễn Thị U', 'Lê Thị I', 'Nguyễn Thị O', 1, 'P1', 'Sắp xếp linh kiện', '2025-03-31'),
(3, 'Van Minh', 'minhpv', '2016-03-16', 'Nam', 'Đại học', 'B1', '001200000099', 'Ha Noi', '0964999999', 'minh@gmail.com', 'không', 'Kinh', 'Quản lý', 1, '2025-03-05', '2025-03-05', 'Hợp đồng', 'Chưa kết hôn', 'Nguyen Van A', 'Nguyen Van B', 'Nguyen Thị C', 'Nguyen Van X', 2, 'B1', 'Quản lý dậy chuyền', '2025-03-31'),
(45, 'Võ Huy Hoàng', 'hoangvh', '1999-12-15', 'Nam', 'Đại học', 'B1', '0123456789', 'Hà Tây', '0964555555', 'hoang@gmail.com', 'Không', 'Kinh', 'Nhân viên', 1, '2025-03-26', '2025-04-01', 'Hợp đồng', 'chưa', 'Võ Huy X', 'Võ Thị Y', 'Võ Thu Nhi', 'Võ Huy D', 1, 'Hành chính', 'Sắp xếp hàng', '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `phancongcongviec`
--

CREATE TABLE `phancongcongviec` (
  `MaCongViec` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `TenCongViec` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `NgayBatDau` datetime DEFAULT NULL,
  `NgayKetThuc` datetime DEFAULT NULL,
  `TrangThai` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `TienDo` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `phancongcongviec`
--

INSERT INTO `phancongcongviec` (`MaCongViec`, `MaNhanVien`, `TenCongViec`, `NgayBatDau`, `NgayKetThuc`, `TrangThai`, `TienDo`) VALUES
(1, 1, 'Quản lý kho', '2024-12-18 00:00:00', '2025-07-25 00:00:00', '1', '80'),
(2, 2, 'Sắp xếp kho', '2025-03-30 00:00:00', '2025-03-31 00:00:00', '1', '50'),
(3, 3, 'Quản lý kho', '2025-04-10 00:00:00', '2025-04-18 00:00:00', '1', '70');

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `MaPhongBan` int(11) NOT NULL,
  `TenPhongBan` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`MaPhongBan`, `TenPhongBan`) VALUES
(1, 'Hành Chính'),
(2, 'Kĩ Thuật'),
(3, 'Văn Thư');

-- --------------------------------------------------------

--
-- Table structure for table `quatrinhcongtac`
--

CREATE TABLE `quatrinhcongtac` (
  `MaQuaTrinh` int(11) NOT NULL,
  `MaNhanVien` int(11) DEFAULT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `Loai` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `MoTaChiTiet` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `quatrinhcongtac`
--

INSERT INTO `quatrinhcongtac` (`MaQuaTrinh`, `MaNhanVien`, `ThoiGian`, `Loai`, `MoTaChiTiet`) VALUES
(1, 1, '2025-03-06 00:00:00', 'Khen thưởng', 'Khen thưởng hoàn thành công việc'),
(2, 3, '2025-03-11 00:00:00', 'Kỷ Luật', 'Kỷ luật vi phạm hút thuốc'),
(3, 1, '2025-03-19 00:00:00', 'Tăng lương', 'Tăng lương 100000');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TaiKhoan` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `MatKhau` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `ThoiGian` datetime DEFAULT current_timestamp(),
  `KichHoat` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TaiKhoan`, `MatKhau`, `ThoiGian`, `KichHoat`) VALUES
('hoangvh', 'hoang123', '2025-03-31 21:57:58', 1),
('minhpv', 'minhpv123', '2025-03-31 21:55:04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bacluong`
--
ALTER TABLE `bacluong`
  ADD PRIMARY KEY (`MaBacLuong`),
  ADD KEY `IDX_BacLuong_MaNhanVien` (`MaNhanVien`);

--
-- Indexes for table `chamcong`
--
ALTER TABLE `chamcong`
  ADD PRIMARY KEY (`MaChamCong`),
  ADD KEY `IDX_ChamCong_MaNhanVien` (`MaNhanVien`),
  ADD KEY `IDX_ChamCong_ThoiGian` (`ThoiGian`);

--
-- Indexes for table `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`MaHopDong`),
  ADD KEY `IDX_HopDong_MaNhanVien` (`MaNhanVien`),
  ADD KEY `IDX_HopDong_NgayBatDau` (`NgayBatDau`),
  ADD KEY `IDX_HopDong_NgayHetHan` (`NgayHetHan`),
  ADD KEY `IDX_HopDong_TrangThai` (`TrangThai`),
  ADD KEY `IDX_HopDong_LoaiHopDong` (`LoaiHopDong`);

--
-- Indexes for table `khenthuongkyluat`
--
ALTER TABLE `khenthuongkyluat`
  ADD PRIMARY KEY (`MaKhenThuongKyLuat`),
  ADD KEY `IDX_KhenThuongKyLuat_MaNhanVien` (`MaNhanVien`),
  ADD KEY `IDX_KhenThuongKyLuat_Loai` (`Loai`),
  ADD KEY `IDX_KhenThuongKyLuat_TrangThai` (`TrangThai`),
  ADD KEY `IDX_KhenThuongKyLuat_ThoiGian` (`ThoiGianKhenThuongKyLuat`);

--
-- Indexes for table `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`MaLuong`),
  ADD KEY `IDX_Luong_MaNhanVien` (`MaNhanVien`),
  ADD KEY `IDX_Luong_ThoiGianTao` (`ThoiGianTao`),
  ADD KEY `IDX_Luong_SoTien` (`SoTien`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD UNIQUE KEY `unique_cmnd` (`CMND`),
  ADD KEY `idx_HoTen` (`HoTen`),
  ADD KEY `idx_SDT` (`SDT`),
  ADD KEY `idx_Tuoi` (`NgaySinh`),
  ADD KEY `idx_BacLuong` (`BacLuong`),
  ADD KEY `idx_TrinhDo` (`TrinhDo`),
  ADD KEY `idx_PhongCongTac` (`PhongCongTac`),
  ADD KEY `idx_CongViec` (`CongViec`),
  ADD KEY `idx_GioiTinh` (`GioiTinh`),
  ADD KEY `idx_PhongBan` (`PhongBan`);

--
-- Indexes for table `phancongcongviec`
--
ALTER TABLE `phancongcongviec`
  ADD PRIMARY KEY (`MaCongViec`),
  ADD KEY `IDX_PhanCongCongViec_MaNhanVien` (`MaNhanVien`),
  ADD KEY `IDX_PhanCongCongViec_NgayBatDau` (`NgayBatDau`),
  ADD KEY `IDX_PhanCongCongViec_NgayKetThuc` (`NgayKetThuc`),
  ADD KEY `IDX_PhanCongCongViec_TienDo` (`TienDo`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MaPhongBan`),
  ADD KEY `IDX_MaPhongBan` (`MaPhongBan`);

--
-- Indexes for table `quatrinhcongtac`
--
ALTER TABLE `quatrinhcongtac`
  ADD PRIMARY KEY (`MaQuaTrinh`),
  ADD KEY `IDX_MaNhanVien` (`MaNhanVien`),
  ADD KEY `IDX_Loai` (`Loai`),
  ADD KEY `IDX_ThoiGian` (`ThoiGian`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`TaiKhoan`),
  ADD KEY `IDX_TaiKhoan` (`TaiKhoan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bacluong`
--
ALTER TABLE `bacluong`
  MODIFY `MaBacLuong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chamcong`
--
ALTER TABLE `chamcong`
  MODIFY `MaChamCong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `MaHopDong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `khenthuongkyluat`
--
ALTER TABLE `khenthuongkyluat`
  MODIFY `MaKhenThuongKyLuat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `luong`
--
ALTER TABLE `luong`
  MODIFY `MaLuong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNhanVien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `phancongcongviec`
--
ALTER TABLE `phancongcongviec`
  MODIFY `MaCongViec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `MaPhongBan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quatrinhcongtac`
--
ALTER TABLE `quatrinhcongtac`
  MODIFY `MaQuaTrinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
