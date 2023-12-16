-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 06:35 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(19, 12, 'ZM', 'ssd', '2023-12-03 06:42:52', '2023-12-03 06:42:52'),
(21, 13, 'VG', 'THsis', '2023-12-15 11:45:10', '2023-12-15 11:45:10'),
(22, 13, 'AU', 'HHH', '2023-12-15 11:45:10', '2023-12-15 11:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_various_artist` tinyint(1) DEFAULT NULL,
  `genre_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previously_release` tinyint(1) DEFAULT NULL,
  `release_date` datetime DEFAULT NULL,
  `label_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_release_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upc_ean_jan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `user_id`, `cover_image`, `language`, `release_title`, `title_version`, `is_various_artist`, `genre_one`, `genre_two`, `p_copy`, `c_copy`, `previously_release`, `release_date`, `label_id`, `internal_release_id`, `upc_ean_jan`, `created_at`, `updated_at`) VALUES
(2, 9, '2023-12-16-09_22_59_2023-03-04-07_47_05_Emon2.jpeg', 'Abkhazian', 'asdajsd   asdhajsd', 'hajsdas', 1, 'Acoustic Blues', 'Acoustic Blues', 'jhgsA', 'asvAS', 0, NULL, '1', 'KhsjB', '86213123', '2023-12-16 03:52:59', '2023-12-16 07:30:29'),
(5, 9, '2023-12-16-15_51_39_screencapture-humblehydrogen-admin-setting-1-edit-2023-12-02-14_08_40.png', 'Abkhazian', 'asdba', 'basndbnas', 1, 'Acoustic Blues', 'Acoustic Blues', 'asdbav', 'basndv', 1, '2023-12-14 00:00:00', '6', 'asmdbasn', '2312312', '2023-12-16 10:21:39', '2023-12-16 11:07:20'),
(7, 1, '2023-12-16-16_48_24_Semester.jpg', 'Albanian', 'ASDAS', 'JJASDB', 1, 'Acoustic Blues', 'Acoustic Blues', 'ASDAS', 'MNADBMA', 1, '2023-11-30 00:00:00', '6', 'ASDAS', '2313', '2023-12-16 11:18:24', '2023-12-16 11:18:24'),
(8, 9, '2023-12-16-16_51_11_screencapture-humblehydrogen-admin-setting-1-edit-2023-12-02-14_08_40.png', 'Abkhazian', 'ASNDVBAS', 'BNSDVA', 1, 'Adult Alternative', 'Adult Alternative', 'ASKDHBVAS', 'ASDNBASASDMNAB', 0, NULL, '6', 'ASKDH', '293712', '2023-12-16 11:21:11', '2023-12-16 11:21:11'),
(12, 9, '2023-12-16-17_07_48_screencapture-humblehydrogen-admin-setting-1-edit-2023-12-02-14_08_40.png', 'Akan', 'asjdba', 'asdn', 0, '(Jazz) Latin Jazz', '(Jazz) Latin Jazz', 'asdasnmb', 'asdnas', 0, NULL, '6', 'asdmnas', '13213', '2023-12-16 11:37:48', '2023-12-16 11:37:48'),
(13, 12, '2023-12-16-17_32_55_2023-03-04-07_47_05_Emon2.jpeg', 'Akan', 'asdkh', 'asbdna', 1, 'Adult Alternative', 'Adult Alternative', 'asdn', 'basnmdb', 1, '2023-12-16 00:00:00', '1', 'asdbm', '2312312', '2023-12-16 12:02:55', '2023-12-16 12:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `asset_artists`
--

CREATE TABLE `asset_artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `asset_artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `has_spotify_asset` tinyint(1) DEFAULT NULL,
  `has_applemusic_asset` tinyint(1) DEFAULT NULL,
  `spotify_id_ass` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id_ass` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_artists`
--

INSERT INTO `asset_artists` (`id`, `asset_id`, `asset_artist_id`, `has_spotify_asset`, `has_applemusic_asset`, `spotify_id_ass`, `apple_id_ass`, `created_at`, `updated_at`) VALUES
(2, 2, 13, 1, 0, 'qwehgqw', NULL, '2023-12-16 03:52:59', '2023-12-16 03:52:59'),
(5, 5, 2, 1, 1, 'asndmb', 'asjdhas', '2023-12-16 10:21:39', '2023-12-16 10:21:39'),
(7, 7, 1, 1, 0, 'ASDAS', NULL, '2023-12-16 11:18:24', '2023-12-16 11:18:24'),
(8, 8, 1, 0, 0, NULL, NULL, '2023-12-16 11:21:11', '2023-12-16 11:21:11'),
(12, 12, 13, 0, 0, NULL, NULL, '2023-12-16 11:37:48', '2023-12-16 11:37:48'),
(13, 13, 2, 1, 1, 'asdas', 'asda', '2023-12-16 12:02:55', '2023-12-16 12:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `asset_genres`
--

CREATE TABLE `asset_genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `genre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(25, '2023_12_03_120735_add_fields_to_users', 5),
(26, '2023_12_12_171755_create_assets_table', 6),
(27, '2023_12_12_171804_create_tracks_table', 6),
(28, '2023_12_12_172138_create_asset_artists_table', 6),
(29, '2023_12_12_172603_create_asset_genres_table', 6),
(30, '2023_12_12_173424_create_track_artists_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `audio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_t` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_title_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_isrc` tinyint(1) DEFAULT NULL,
  `isrc_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explicit_lyrics` tinyint(1) DEFAULT NULL,
  `original_public` tinyint(1) DEFAULT NULL COMMENT '0=>original, 1=>public',
  `genre_one_track` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_two_track` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_copy_t` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_copy_t` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_label_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_track_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lyrics` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `asset_id`, `audio`, `language_t`, `track_title_version`, `title_version`, `has_isrc`, `isrc_code`, `explicit_lyrics`, `original_public`, `genre_one_track`, `genre_two_track`, `p_copy_t`, `c_copy_t`, `track_label_id`, `internal_track_id`, `lyrics`, `created_at`, `updated_at`) VALUES
(1, 2, 'm4a', 'Akan', 'jghxhjgasj   jashdjasgdb', 'gahsgdj', 1, '9dasjdb', 1, 1, 'Afrobeats', 'Afro-fusion', 'asdjasjbd', 'ajdgasd', '6', 'askdhasjdb', 'asjdgahsvdn', '2023-12-16 03:52:59', '2023-12-16 07:30:29'),
(4, 5, 'm4a', 'Bashkir', 'asdbv', 'bjasbdna', 1, 'asda', 1, 0, 'Afrobeats', 'Afro-Pop', 'asdnas', 'bajsbdna', '6', 'asmdbas', 'asmdbas', '2023-12-16 10:21:39', '2023-12-16 10:21:39'),
(6, 7, 'm4a', 'Basque', 'ASDBAVSND', 'JSNDBAS', 0, NULL, 0, 0, 'Afrobeats', 'Afro-fusion', 'ASDBAS', 'MSBDA', '6', 'ASDMNABS', 'ASMDNBAS', '2023-12-16 11:18:24', '2023-12-16 11:18:24'),
(7, 8, 'D:\\Xampp\\htdocs\\album\\public\\audio/20231216_657dd57fe46cd.m4a', 'Samoan', 'ASKDHBAVS', 'JGAJSDNVA', 0, NULL, 0, 0, 'Afro-fusion', 'Alternative & Rock in Spanish', 'KSHDASJD', 'ASDMNASBD', '1', 'ASDBASN', 'ASMBDASN', '2023-12-16 11:21:11', '2023-12-16 11:21:11'),
(8, 12, '2023-12-16-17_07_48_Recording.m4a', 'Arabic', 'asdamsd', 'asdasbmd', 0, NULL, 0, 0, 'Afro-Pop', 'Afro-Beat', 'askdabsd', 'msbadnas', '6', 'asdnmabs', 'asdmbasnd', '2023-12-16 11:37:48', '2023-12-16 11:37:48'),
(9, 13, '2023-12-16-17_32_55_Recording.m4a', 'Bashkir', 'asmdb', 'nbnsabd a', 1, 'asndb', 0, 0, 'Alte', 'Afro-fusion', 'asmdb', 'bmsab da', '6', 'asmdbnvas', 'sasmdbasn', '2023-12-16 12:02:55', '2023-12-16 12:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `track_artists`
--

CREATE TABLE `track_artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `track_id` bigint(20) UNSIGNED DEFAULT NULL,
  `track_artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `has_spotify` tinyint(1) DEFAULT NULL,
  `has_applemusic` tinyint(1) DEFAULT NULL,
  `track_spotify_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_apple_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_artist_name` bigint(20) DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `share` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publishing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_artists`
--

INSERT INTO `track_artists` (`id`, `asset_id`, `track_id`, `track_artist_id`, `has_spotify`, `has_applemusic`, `track_spotify_id`, `track_apple_id`, `track_artist_name`, `role`, `share`, `publishing`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 12, 0, 1, NULL, 'dsahdvajsdv', 13, 'Arranger', '3321', 'Copyright control (self-published)', '2023-12-16 03:52:59', '2023-12-16 07:30:29'),
(4, 5, 4, 12, 1, 1, 'asd', 'asd', 3, 'Composer', '231', 'Published (managed by a publisher)', '2023-12-16 10:21:39', '2023-12-16 10:21:39'),
(6, 7, 6, 13, 1, 0, 'ASD', NULL, 12, 'Composer&Lyricist', '121', 'Public domain (no publisher)', '2023-12-16 11:18:24', '2023-12-16 11:18:24'),
(7, 8, 7, 12, 0, 0, NULL, NULL, 13, 'Adaptor', '121', 'Copyright control (self-published)', '2023-12-16 11:21:11', '2023-12-16 11:21:11'),
(8, 12, 8, 3, 0, 0, NULL, NULL, 3, 'Composer&Lyricist', '12311', 'Public domain (no publisher)', '2023-12-16 11:37:49', '2023-12-16 11:37:49'),
(9, 13, 9, 13, 1, 1, 'asdmbas', 'asmdnbas', 3, 'Arranger', '2312', 'Public domain (no publisher)', '2023-12-16 12:02:55', '2023-12-16 12:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spotify_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'artist',
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
(12, 'Honey', 'honey@mail.com', '17016055721601.PNG', 'This is the best did', 'http://127.0.0.1:8000/', '55454', NULL, '$2y$12$Fy46u46CJJhUA9Ft6gsKEukMgvAHYRLjwyhFGPOKKIJm2d2fVifnO', NULL, '2023-12-03 06:42:52', '2023-12-03 06:42:52', 'artist', 9),
(13, 'Test Viso', 'teteso@mail.com', '17026538424726.jpeg', 'Thsi is bio for the add', '121212', '12121313', NULL, '$2y$12$MFCKBBW1sDA/0wZvYeUB7.V7VuQfToECPqBlJPMWJCzI4r3WOUene', NULL, '2023-12-15 09:54:05', '2023-12-15 11:45:11', 'artist', 9);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_or_label_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'artist,label',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(49, 12, 'artist', 'XXXX', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-03 06:42:52', '2023-12-03 06:42:52'),
(52, 13, 'artist', 'Personal', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-15 11:45:10', '2023-12-15 11:45:10'),
(53, 13, 'artist', 'Test', 'http://127.0.0.1:8000/admin/artists/create', '2023-12-15 11:45:10', '2023-12-15 11:45:10');

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
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_artists`
--
ALTER TABLE `asset_artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_genres`
--
ALTER TABLE `asset_genres`
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
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_artists`
--
ALTER TABLE `track_artists`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `asset_artists`
--
ALTER TABLE `asset_artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `asset_genres`
--
ALTER TABLE `asset_genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `track_artists`
--
ALTER TABLE `track_artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
