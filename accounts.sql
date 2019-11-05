-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 05, 2019 lúc 06:35 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `members`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `username`, `password`, `email`, `activation_code`) VALUES
(11, 'Dương Tùng Anh', 'admin', '$2y$10$1QLvQahvkZ6ZWYtV6w0xluJkg0SRIlvH8LlZGujHRk86DlMbZY1Dm', 'duongtunganh2111@gmail.com', ''),
(13, 'Nguyễn Đặng Hải', 'ndhai_', '$2y$10$AIgzBu8n3.KEImj1H9n5/.PNe7bucgacbTiTfHj7IP/zp5pRb7Rs2', 'ndhai@gmail.com', ''),
(14, 'tester', 'test', '$2y$10$IrYkfGcIS5/biufbPeDlt.tz1w1chEPqVjyWl3HnGliDfz/XdHjie', 'test@test.test', ''),
(15, 'Dương Tùng Anh', 'tunganh03', '$2y$10$/.quPtgGAse75fgZ.IWhbOKB4HXgo4dnFHM0yDiDboIeMA/desZPq', 'tunnaduong@gmail.com', ''),
(16, '123213', '123123', '$2y$10$Ouhga6PxwS9k3kWJkbzn9.a8tDWbXu3AqyN32YO1TGiJpVDNFD.L6', 'sadads@gmail.com', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
