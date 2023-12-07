-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 07:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `album`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin album', 'admin@mail.com', NULL, '$2y$12$zBKXhnjgaVXz84vjilQPpea2vQ3qNdr1SCXMjqUB8lKHs/kl6JwHW', NULL, '2023-11-26 08:04:08', '2023-11-26 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `artist_name_localizations`
--

CREATE TABLE `artist_name_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_name_localizations`
--

INSERT INTO `artist_name_localizations` (`id`, `artist_id`, `language`, `name`, `created_at`, `updated_at`) VALUES
(4, 2, 'US', 'ww', '2023-11-26 08:08:18', '2023-11-26 08:08:18'),
(5, 2, 'CA', 'sd', '2023-11-26 08:08:19', '2023-11-26 08:08:19'),
(6, 3, 'CA', 'TEST', '2023-11-27 11:01:20', '2023-11-27 11:01:20'),
(7, 3, 'GB', 'UTIO', '2023-11-27 11:01:20', '2023-11-27 11:01:20'),
(11, NULL, NULL, NULL, '2023-12-03 00:03:41', '2023-12-03 00:03:41'),
(12, NULL, NULL, NULL, '2023-12-03 00:05:13', '2023-12-03 00:05:13'),
(15, 1, 'IN', 'sd', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(16, 1, 'CA', 'sd', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(17, 1, 'US', 'TEST', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(18, 12, 'IS', 'ww', '2023-12-03 06:42:52', '2023-12-03 06:42:52'),
(19, 12, 'ZM', 'ssd', '2023-12-03 06:42:52', '2023-12-03 06:42:52');

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
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label_id` bigint(20) UNSIGNED DEFAULT NULL,
  `genre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `label_id`, `genre_id`, `created_at`, `updated_at`) VALUES
(12, 6, 2, '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(13, 6, 5, '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(14, 6, 208, '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(15, 6, 323, '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(16, 1, 2, '2023-12-03 06:01:17', '2023-12-03 06:01:17'),
(17, 1, 6, '2023-12-03 06:01:17', '2023-12-03 06:01:17'),
(18, 1, 96, '2023-12-03 06:01:17', '2023-12-03 06:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `official_name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `image`, `official_name`, `description`, `location`, `email`, `number`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '170160307616.PNG', 'Old', 'dffd fdff f', 'Kolkata', 'bhdfuinjohn@gmail.com', '23232232332', '2023-12-03 04:41:34', '2023-12-03 06:01:17', 9),
(6, '17016027517922.PNG', 'TTT', 'kdskskdskd sksdkds', 'Kolkata1,West bengal', 'cxc@mail.com', '8383800', '2023-12-03 04:53:36', '2023-12-03 05:55:52', 8);

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
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2023_11_25_103818_create_admins_table', 1),
(17, '2023_11_26_045942_create_websites_table', 1),
(18, '2023_11_26_050242_create_artist_name_localizations_table', 1),
(19, '2023_11_26_050515_create_labels_table', 1),
(21, '2023_12_02_135917_add_fields_to_users', 2),
(22, '2023_12_03_065915_add_fields_to_labels', 3),
(24, '2023_11_26_050842_create_genres_table', 4),
(25, '2023_12_03_120735_add_fields_to_users', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `biography` longtext DEFAULT NULL,
  `spotify_id` varchar(255) DEFAULT NULL,
  `apple_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'artist',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `biography`, `spotify_id`, `apple_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `user_id`) VALUES
(1, 'Russell Blackwell', 'bhuinjohrrn@gmail.com', '17016031537880.PNG', 'This is bio', 'http://127.0.0.1:8000/', '454545', NULL, '$2y$12$R7CE27gCQ7nApsFiEVNZNe8MMubkiR8R8mb6ZZAlcyHev3QULhgha', NULL, '2023-11-26 08:04:23', '2023-12-03 06:02:35', 'artist', NULL),
(2, 'Protine shek next gen', 'test@mail.com', '17010058976541.jpg', 'RRRRRRR RRRRRRRRRRRRRRRR RRRRRRRRRRR\r\ndff', 'http://127.0.0.1:8000/', '1212', NULL, '$2y$12$rgMxP8Irj.mQSw3RuJKdQ.m9Rm6qJEy3fYEwsHcuMbubRWo2IbSrq', NULL, '2023-11-26 08:08:18', '2023-11-26 08:08:18', 'artist', NULL),
(3, 'Boris Byrd', 'bhuinjohn@gmail.com', '1701102677613.jpg', 'THsi', 'http://127.0.0.1:8000/', '12121', NULL, '$2y$12$2yaR.uUa2K.ELEn15kAFWe5KCTm0808s6MpkLLr7doqolTah0W93C', NULL, '2023-11-27 11:01:20', '2023-11-27 11:01:20', 'artist', NULL),
(8, 'Raon', 'abhisekkaran2001@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$shcCnynoOzWTRm7YRLvNWOETrUguOrZ4n3Lexja3sFZyZZAxy7xO2', NULL, '2023-12-02 09:18:48', '2023-12-02 21:57:37', 'user', NULL),
(9, 'Teso', 'teso@mail.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$kjndGwsiJUdJwzARbXQ4r.GI1KRIc89jcIwfsR4DaDi2BnlEovc2u', NULL, '2023-12-02 21:57:23', '2023-12-02 21:57:23', 'user', NULL),
(12, 'Honey', 'honey@mail.com', '17016055721601.PNG', 'This is the best did', 'http://127.0.0.1:8000/', '55454', NULL, '$2y$12$Fy46u46CJJhUA9Ft6gsKEukMgvAHYRLjwyhFGPOKKIJm2d2fVifnO', NULL, '2023-12-03 06:42:52', '2023-12-03 06:42:52', 'artist', 9);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_or_label_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'artist,label',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `user_or_label_id`, `type`, `title`, `url`, `created_at`, `updated_at`) VALUES
(35, 6, 'label', 'XXXX', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 05:55:51', '2023-12-03 05:55:51'),
(36, 6, 'label', 'dfd', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(37, 6, 'label', 'ABC', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(38, 6, 'label', 'A', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 05:55:52', '2023-12-03 05:55:52'),
(42, 1, 'artist', 'sd', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:02:33', '2023-12-03 06:02:33'),
(43, 1, 'artist', 'sdsd', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(44, 1, 'artist', 'ABC', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(45, 1, 'artist', 'sd', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(46, 1, 'artist', 'sdsd', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(47, 1, 'artist', 'f', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:02:34', '2023-12-03 06:02:34'),
(48, 12, 'artist', 'ABC', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:42:52', '2023-12-03 06:42:52'),
(49, 12, 'artist', 'XXXX', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:42:52', '2023-12-03 06:42:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `artist_name_localizations`
--
ALTER TABLE `artist_name_localizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artist_name_localizations`
--
ALTER TABLE `artist_name_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
