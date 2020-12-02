-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 02, 2020 lúc 04:58 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `yeucau`
--
CREATE DATABASE IF NOT EXISTS `yeucau` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yeucau`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongiaohang`
--

CREATE TABLE `dongiaohang` (
  `IdDonHang` int(11) NOT NULL,
  `IdCustomer` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `FullnameReceiver` varchar(1000) NOT NULL,
  `AddressReceiver` varchar(1000) NOT NULL,
  `PhoneReceiver` varchar(12) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Cost` int(11) NOT NULL,
  `PickTime` varchar(10) NOT NULL,
  `DeliveryTime` varchar(10) NOT NULL,
  `OrderTime` varchar(10) NOT NULL,
  `Collect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dongiaohang`
--

INSERT INTO `dongiaohang` (`IdDonHang`, `IdCustomer`, `Weight`, `FullnameReceiver`, `AddressReceiver`, `PhoneReceiver`, `Status`, `Cost`, `PickTime`, `DeliveryTime`, `OrderTime`, `Collect`) VALUES
(1, 1, 2, 'Đỗ Đình Toàn', '462/92/1 Hai Bà Trưng P.14 Q.1', '0375637291', 'Đang giao hàng', 35000, '26-11-2020', '27-11-2020', '25-11-2020', 480000),
(2, 5, 3, 'Trần Hồng Tuyên', '736/32 Nguyễn Văn Linh P.3 Q.7 ', '0374362892', 'Đang lấy hàng', 30000, '01-12-2020', '', '31-12-2020', 792000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `IdKh` int(12) NOT NULL,
  `IdAccount` int(12) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`IdKh`, `IdAccount`, `FirstName`, `LastName`, `Phone`, `DOB`, `Gender`, `Email`, `Address`) VALUES
(1, 7, 'Vinh', 'Nguyễn Phúc', '0123366789', '20-10-2000', 'Nam', 'vinhnguyen@gmail.cpm', '23 Nguyễn Hữu Lầu P.6 Q.6'),
(2, 8, 'Phong', 'Đỗ Nguyên', '0247542832', '02-10-1997', 'Nam', 'phongdo@gmail.com', '942 Huỳnh Tấn Phát P.3 Q.7'),
(5, 9, 'Trang', 'Nguyễn Đỗ Thu', '0772926421', '30-11-2002', 'Nữ', 'trangnguyen@gmail.com', '983 Đặng Văn Ngữ P.2 Q.Phú Nhuận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

CREATE TABLE `kho` (
  `IdKho` int(12) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`IdKho`, `Name`) VALUES
(1, 'Kho A'),
(2, 'Kho B'),
(3, 'Kho C');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `IdNv` int(12) NOT NULL,
  `IdAccount` int(12) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senior` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`IdNv`, `IdAccount`, `FirstName`, `LastName`, `Phone`, `Address`, `DOB`, `Email`, `Senior`) VALUES
(1, 1, 'Chung', 'Nguyễn Văn', '0123123123', '126/29 Nguyễn Trãi P.12 Q.5', '02-11-1998', 'chungnguyen@gmail.com', 5),
(2, 2, 'Thư', 'Đoàn Ngọc', '0126661273', '94 Nguyễn Hữu Thọ P.Tân Phong Q.7', '27-06-1996', 'thudoanngoc@gmail.com', 4),
(3, 3, 'Trinh', 'Nguyễn Thu', '0903682771', '763/92 Đoàn Văn Bơ P.9 Q.4', '29-01-1999', 'trinhnguyen@gmail.com', 2),
(4, 4, 'Toàn', 'Nguyễn Văn', '0767453622', '746 3/2 P.11 Q.5', '23-04-2000', 'toanvan@gmail.com', 1),
(5, 5, 'Tú', 'Đặng Ngọc', '0904627192', '846/27/4 Kha Vạn Cân P.Bình Thọ Q.Thủ Đức', '09-01-1995', 'tungocdang@gmail.com', 3),
(6, 6, 'Tuân', 'Nguyễn Hoàng', '0747284721', '372/98 Võ Văn Kiệt P.Bến Nghé Q.1', '18-03-2001', 'hoangtuan@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyentruycap`
--

CREATE TABLE `quyentruycap` (
  `permission` int(10) NOT NULL,
  `info` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quyentruycap`
--

INSERT INTO `quyentruycap` (`permission`, `info`) VALUES
(1, 'Admin'),
(2, 'Nhân viên kho'),
(3, 'Nhân viên xử lý đơn hàng'),
(4, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `IdAccount` int(12) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`IdAccount`, `UserName`, `Password`, `Permission`) VALUES
(1, 'Admin01', '12345678', 1),
(2, 'Admin02', '12345678', 1),
(3, 'NVK001', '12345678', 2),
(4, 'NVK002', '12345678', 2),
(5, 'NVXLDH001', '12345678', 3),
(6, 'NVXLDH002', '12345678', 3),
(7, 'KhachHang01', '123123123', 4),
(8, 'KhachHang02', '123123123', 4),
(9, 'KhachHang03', '123123123', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeucau`
--

CREATE TABLE `yeucau` (
  `IdRequest` int(12) NOT NULL,
  `IdDonHang` int(10) NOT NULL,
  `IdKho` int(12) NOT NULL,
  `Date` varchar(10) NOT NULL,
  `Note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `yeucau`
--

INSERT INTO `yeucau` (`IdRequest`, `IdDonHang`, `IdKho`, `Date`, `Note`) VALUES
(1, 1, 1, '26-11-2020', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dongiaohang`
--
ALTER TABLE `dongiaohang`
  ADD PRIMARY KEY (`IdDonHang`),
  ADD KEY `IdCustomer` (`IdCustomer`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`IdKh`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Chỉ mục cho bảng `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`IdKho`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`IdNv`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Chỉ mục cho bảng `quyentruycap`
--
ALTER TABLE `quyentruycap`
  ADD PRIMARY KEY (`permission`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`IdAccount`),
  ADD KEY `Permission` (`Permission`);

--
-- Chỉ mục cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  ADD PRIMARY KEY (`IdRequest`),
  ADD KEY `IdKho` (`IdKho`),
  ADD KEY `IdDonHang` (`IdDonHang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dongiaohang`
--
ALTER TABLE `dongiaohang`
  MODIFY `IdDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `IdKh` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `kho`
--
ALTER TABLE `kho`
  MODIFY `IdKho` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `IdNv` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `quyentruycap`
--
ALTER TABLE `quyentruycap`
  MODIFY `permission` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `IdAccount` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  MODIFY `IdRequest` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dongiaohang`
--
ALTER TABLE `dongiaohang`
  ADD CONSTRAINT `dongiaohang_ibfk_1` FOREIGN KEY (`IdCustomer`) REFERENCES `khachhang` (`IdKh`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`IdAccount`) REFERENCES `taikhoan` (`IdAccount`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`IdAccount`) REFERENCES `taikhoan` (`IdAccount`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`Permission`) REFERENCES `quyentruycap` (`permission`);

--
-- Các ràng buộc cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  ADD CONSTRAINT `yeucau_ibfk_2` FOREIGN KEY (`IdKho`) REFERENCES `kho` (`IdKho`),
  ADD CONSTRAINT `yeucau_ibfk_3` FOREIGN KEY (`IdDonHang`) REFERENCES `dongiaohang` (`IdDonHang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
