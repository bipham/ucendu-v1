-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 15, 2017 lúc 02:01 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ucendu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reading_english_stories`
--

CREATE TABLE `reading_english_stories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_cover` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'author.png',
  `level` tinyint(4) NOT NULL DEFAULT '1',
  `genre` tinyint(4) NOT NULL DEFAULT '1',
  `length` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'medium',
  `viewed` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reading_english_stories`
--

INSERT INTO `reading_english_stories` (`id`, `title`, `image_cover`, `author`, `avatar_author`, `level`, `genre`, `length`, `viewed`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A Love for Life', '1-tet_mode_3.jpg', 'Penny Hanscock', '1-15000772_1195724590507171_826078311814804741_o.jpg', 4, 1, 'Longer', 0, 1, '2017-09-14 16:01:56', '2017-09-14 16:01:56');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `reading_english_stories`
--
ALTER TABLE `reading_english_stories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reading_english_stories_title_unique` (`title`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `reading_english_stories`
--
ALTER TABLE `reading_english_stories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
