-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 12:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlch_fruit`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `slug`) VALUES
(1, 'Thịt', 0, ''),
(2, 'Rau', 0, ''),
(3, 'Trái cây', 0, ''),
(4, 'Thức ăn nhanh', 0, ''),
(5, 'Các loại sữa', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `category_id` int(11) NOT NULL,
  `product_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(1, 'SP03'),
(3, 'SP01'),
(1, 'SP02'),
(4, 'SP04'),
(3, 'SP05'),
(3, 'SP06'),
(3, 'SP07'),
(2, 'SP08'),
(2, 'SP09'),
(4, 'SP03'),
(3, 'SP10'),
(2, 'SP12'),
(3, 'SP11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `MaSP` varchar(11) NOT NULL,
  `TenSP` varchar(100) NOT NULL,
  `LoaiSP` varchar(250) DEFAULT NULL,
  `AnhSP` varchar(250) NOT NULL,
  `Gia` decimal(10,2) NOT NULL,
  `SoLuong` int(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`MaSP`, `TenSP`, `LoaiSP`, `AnhSP`, `Gia`, `SoLuong`, `description`) VALUES
('SP01', 'Cam', NULL, '[\"cat-1.jpg\",\"feature-6.jpg\"]', 12000.00, 12, 'Cam sành nhà quê'),
('SP02', 'Thịt bò', NULL, '[\"cat-5.jpg\"]', 12000.00, 12, 'Thịt bò nhập khẩu từ Úc'),
('SP03', 'Gà', NULL, '[\"lp-3.jpg\"]', 12000.00, 12, 'Gà rán KFC'),
('SP04', 'Hamburger', NULL, '[\"feature-6.jpg\"]', 25000.00, 10, 'Hamburger thịt'),
('SP05', 'Chuối', NULL, '[\"feature-2.jpg\"]', 25000.00, 10, 'Chuối Đà Lạt'),
('SP06', 'Ổi hồng', NULL, '[\"feature-3.jpg\"]', 25000.00, 10, 'Ổi hồng nữ hoàng'),
('SP07', 'Dưa hấu', NULL, '[\"feature-4.jpg\"]', 25000.00, 10, 'Dưa hấu Đắk Lắk'),
('SP08', 'Rau cải xanh', NULL, '[\"lp-1.jpg\"]', 25000.00, 10, 'Rau cải xanh từ Đà Lạt'),
('SP09', 'Rau chân vịt', NULL, '[\"lp-1.jpg\"]', 25000.00, 10, 'Rau chân vịt từ Đà Lạt'),
('SP10', 'Xoài', NULL, '[\"feature-7.jpg\"]', 13000.00, 12, 'Xoài cát Cam Ranh'),
('SP12', 'Ớt chuông', NULL, '[\"lp-2.jpg\"]', 13000.00, 12, 'Ớt chuông Đà Lạt'),
('SP11', 'Nho tím', NULL, '[\"hung.jpg\"]', 13000.00, 12, 'Nho tím Thụy sĩ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `address`) VALUES
(1, 'Khánh Hưng', 'chil5179@gmail.com', '2024-08-25 18:57:30', '$2y$12$XfNX4961GCW5Yau9pVAdkeQJ1Vlq6nrCWmKi65RIOsig0Q07mo82O', NULL, '2024-06-25 18:46:12', '2024-08-28 19:12:24', '(+84) 965479040', 'Nha Trang, Khánh Hòa'),
(2, 'Lữ Huỳnh Khánh Hưng', 'khanhhung7444@gmail.com', NULL, '$2y$12$PtoqKJNsc.8pnTquGVOqYOJMT.fSAZxK.MfDh4lrTXD11ZjiHD.0e', NULL, '2024-08-27 20:26:25', '2024-08-27 20:26:25', '(+84) 965479040', 'Nha Trang, Khánh Hòa'),
(3, 'Khánh Hưng', 'chil79@gmail.com', NULL, '$2y$12$Z/x4SLdBAI6bNKiE/7xQzO1BKkJgZhGDJTZOTPzZst4l08ljJoLnK', NULL, '2024-08-27 21:01:01', '2024-08-27 21:01:01', '', ''),
(4, 'Lữ Huỳnh Khánh Hưng', 'lhkhungg@gmail.com', NULL, '$2y$12$qdYVyHITfq3PkLb03RBdLOrDSNBiz0qMDA9K5B5/KznMp.pyn69lW', NULL, '2024-09-02 19:50:13', '2024-09-02 19:50:13', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
