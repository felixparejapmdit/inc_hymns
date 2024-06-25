-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 10:24 AM
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
-- Database: `inc_hymns`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `changes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `changes`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'updated', 'Permission Category', 1, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-11 08:22:03', '2024-06-11 08:22:03'),
(2, 1, 'updated', 'Permission Category', NULL, 'update the category', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-11 08:27:02', '2024-06-11 08:27:02'),
(3, 9, 'created', 'Permission Category', 1, NULL, '172.18.125.134', 'Mozilla/5.0 (iPad; CPU OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', '2024-06-12 22:34:02', '2024-06-12 22:34:02'),
(4, 9, 'created', 'Permission Category', 1, NULL, '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-12 22:45:13', '2024-06-12 22:45:13'),
(5, 1, 'updated', 'Permission Category', NULL, 'update the category', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-12 23:09:28', '2024-06-12 23:09:28'),
(6, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:43:12', '2024-06-16 19:43:12'),
(7, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:43:38', '2024-06-16 19:43:38'),
(8, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:43:38', '2024-06-16 19:43:38'),
(9, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:51:18', '2024-06-16 19:51:18'),
(10, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:51:28', '2024-06-16 19:51:28'),
(11, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:51:29', '2024-06-16 19:51:29'),
(12, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Safari/605.1.15', '2024-06-16 19:52:52', '2024-06-16 19:52:52'),
(13, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Safari/605.1.15', '2024-06-16 19:52:52', '2024-06-16 19:52:52'),
(14, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:53:51', '2024-06-16 19:53:51'),
(15, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:53:51', '2024-06-16 19:53:51'),
(16, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:53:56', '2024-06-16 19:53:56'),
(17, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:53:56', '2024-06-16 19:53:56'),
(18, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:54:11', '2024-06-16 19:54:11'),
(19, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:54:11', '2024-06-16 19:54:11'),
(20, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:54:21', '2024-06-16 19:54:21'),
(21, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 19:54:21', '2024-06-16 19:54:21'),
(22, 8, 'updated', 'PMD-IT', 1, 'update group', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 20:12:56', '2024-06-16 20:12:56'),
(23, 8, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 23:06:29', '2024-06-16 23:06:29'),
(24, 8, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 23:06:29', '2024-06-16 23:06:29'),
(25, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 23:16:37', '2024-06-16 23:16:37'),
(26, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 23:16:37', '2024-06-16 23:16:37'),
(27, 8, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 23:16:47', '2024-06-16 23:16:47'),
(28, 8, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-16 23:16:47', '2024-06-16 23:16:47'),
(29, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 15:01:13', '2024-06-17 15:01:13'),
(30, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 15:01:22', '2024-06-17 15:01:22'),
(31, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 15:01:23', '2024-06-17 15:01:23'),
(32, 8, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 19:48:29', '2024-06-17 19:48:29'),
(33, 8, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 19:48:29', '2024-06-17 19:48:29'),
(34, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:36:17', '2024-06-17 20:36:17'),
(35, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:36:18', '2024-06-17 20:36:18'),
(36, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:37:17', '2024-06-17 20:37:17'),
(37, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:37:17', '2024-06-17 20:37:17'),
(38, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:38:14', '2024-06-17 20:38:14'),
(39, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:38:15', '2024-06-17 20:38:15'),
(40, 8, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:39:07', '2024-06-17 20:39:07'),
(41, 8, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 20:39:08', '2024-06-17 20:39:08'),
(42, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:19:21', '2024-06-17 21:19:21'),
(43, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:19:21', '2024-06-17 21:19:21'),
(44, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:19:44', '2024-06-17 21:19:44'),
(45, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:19:45', '2024-06-17 21:19:45'),
(46, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:24:00', '2024-06-17 21:24:00'),
(47, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:24:00', '2024-06-17 21:24:00'),
(48, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:35:23', '2024-06-17 21:35:23'),
(49, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-17 21:35:24', '2024-06-17 21:35:24'),
(50, 1, 'login', 'Felix Pareja', 1, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Avast/124.0.0.0', '2024-06-17 21:36:19', '2024-06-17 21:36:19'),
(51, 8, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 00:19:39', '2024-06-18 00:19:39'),
(52, 8, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 00:19:40', '2024-06-18 00:19:40'),
(53, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 15:11:27', '2024-06-18 15:11:27'),
(54, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 15:14:17', '2024-06-18 15:14:17'),
(55, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 15:14:17', '2024-06-18 15:14:17'),
(56, 9, 'login', 'Music Encoder', 9, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:18:00', '2024-06-18 16:18:00'),
(57, 9, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:19:12', '2024-06-18 16:19:12'),
(58, 9, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:19:12', '2024-06-18 16:19:12'),
(59, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:22:00', '2024-06-18 16:22:00'),
(60, 5, 'login', 'EVM', 5, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', '2024-06-18 16:26:27', '2024-06-18 16:26:27'),
(61, 8, 'deleted', 'CWS', 35, 'delete the category', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:29:39', '2024-06-18 16:29:39'),
(62, 8, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:30:34', '2024-06-18 16:30:34'),
(63, 8, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:30:35', '2024-06-18 16:30:35'),
(64, 8, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:31:42', '2024-06-18 16:31:42'),
(65, 8, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:31:42', '2024-06-18 16:31:42'),
(66, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:35:02', '2024-06-18 16:35:02'),
(67, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:35:21', '2024-06-18 16:35:21'),
(68, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:35:21', '2024-06-18 16:35:21'),
(69, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:36:04', '2024-06-18 16:36:04'),
(70, 8, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:36:04', '2024-06-18 16:36:04'),
(71, 5, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', '2024-06-18 16:37:55', '2024-06-18 16:37:55'),
(72, 5, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', '2024-06-18 16:37:56', '2024-06-18 16:37:56'),
(73, 9, 'login', 'Music Encoder', 9, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:37:56', '2024-06-18 16:37:56'),
(74, 9, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:38:35', '2024-06-18 16:38:35'),
(75, 9, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:38:35', '2024-06-18 16:38:35'),
(76, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', '2024-06-18 16:39:13', '2024-06-18 16:39:13'),
(77, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', '2024-06-18 16:39:14', '2024-06-18 16:39:14'),
(78, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', '2024-06-18 16:39:42', '2024-06-18 16:39:42'),
(79, 8, 'created', 'Eugene Eustaquio', 11, 'add new user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:42:49', '2024-06-18 16:42:49'),
(80, 8, 'created', 'Randolf Magan', 12, 'add new user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:43:26', '2024-06-18 16:43:26'),
(81, 8, 'updated', 'Music Encoder 01', 9, 'update the user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:44:03', '2024-06-18 16:44:03'),
(82, 8, 'created', 'Music Encoder 01', 13, 'add new user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:44:36', '2024-06-18 16:44:36'),
(83, 8, 'created', 'Music Encoder 04', 14, 'add new user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:45:05', '2024-06-18 16:45:05'),
(84, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:46:24', '2024-06-18 16:46:24'),
(85, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:47:17', '2024-06-18 16:47:17'),
(86, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 16:47:17', '2024-06-18 16:47:17'),
(87, 9, 'login', 'Music Encoder 01', 9, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', '2024-06-18 16:48:06', '2024-06-18 16:48:06'),
(88, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-18 20:21:31', '2024-06-18 20:21:31'),
(89, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-19 20:22:04', '2024-06-19 20:22:04'),
(90, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-19 20:22:45', '2024-06-19 20:22:45'),
(91, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-19 20:22:46', '2024-06-19 20:22:46'),
(92, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 15:11:19', '2024-06-20 15:11:19'),
(93, 8, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 15:12:58', '2024-06-20 15:12:58'),
(94, 8, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 15:12:58', '2024-06-20 15:12:58'),
(95, 8, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 15:15:57', '2024-06-20 15:15:57'),
(96, 8, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 15:15:58', '2024-06-20 15:15:58'),
(97, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 18:40:52', '2024-06-20 18:40:52'),
(98, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 18:40:59', '2024-06-20 18:40:59'),
(99, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 18:41:00', '2024-06-20 18:41:00'),
(100, 5, 'login', 'EVM', 5, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 20:02:12', '2024-06-20 20:02:12'),
(101, 5, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 20:02:44', '2024-06-20 20:02:44'),
(102, 5, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-20 20:02:44', '2024-06-20 20:02:44'),
(103, 5, 'login', 'EVM', 5, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-23 19:20:05', '2024-06-23 19:20:05'),
(104, 5, 'login', 'EVM', 5, 'login user', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:23:37', '2024-06-23 19:23:37'),
(105, 5, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:24:13', '2024-06-23 19:24:13'),
(106, 5, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:24:14', '2024-06-23 19:24:14'),
(107, 5, 'login', 'EVM', 5, 'login user', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:31:43', '2024-06-23 19:31:43'),
(108, 5, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:31:52', '2024-06-23 19:31:52'),
(109, 5, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:31:52', '2024-06-23 19:31:52'),
(110, 5, 'viewed', 'Kami\'y Iyong Dingin', 73, 'view hymn', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:35:27', '2024-06-23 19:35:27'),
(111, 5, 'viewed', 'Kami\'y Iyong Dingin', 73, 'view hymn', '172.18.127.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 19:35:27', '2024-06-23 19:35:27'),
(112, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-23 20:26:06', '2024-06-23 20:26:06'),
(113, 5, 'login', 'EVM', 5, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-23 20:26:22', '2024-06-23 20:26:22'),
(114, 5, 'login', 'EVM', 5, 'login user', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 20:40:34', '2024-06-23 20:40:34'),
(115, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-23 20:41:23', '2024-06-23 20:41:23'),
(116, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 22:49:54', '2024-06-23 22:49:54'),
(117, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 22:49:54', '2024-06-23 22:49:54'),
(118, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 22:50:01', '2024-06-23 22:50:01'),
(119, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 22:50:01', '2024-06-23 22:50:01'),
(120, 5, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 22:51:59', '2024-06-23 22:51:59'),
(121, 5, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-23 22:51:59', '2024-06-23 22:51:59'),
(122, 5, 'login', 'EVM', 5, 'login user', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 01:52:10', '2024-06-24 01:52:10'),
(123, 5, 'viewed', 'Sa Amin Ay Mabuti Ka Ama', 72, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 01:52:24', '2024-06-24 01:52:24'),
(124, 5, 'viewed', 'Sa Amin Ay Mabuti Ka Ama', 72, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 01:52:24', '2024-06-24 01:52:24'),
(125, 5, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:01:45', '2024-06-24 02:01:45'),
(126, 5, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:01:45', '2024-06-24 02:01:45'),
(127, 5, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:01:53', '2024-06-24 02:01:53'),
(128, 5, 'viewed', 'Ang Aming Pagsisikapan', 74, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:01:53', '2024-06-24 02:01:53'),
(129, 5, 'viewed', 'Sa Amin Ay Mabuti Ka Ama', 72, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:02:00', '2024-06-24 02:02:00'),
(130, 5, 'viewed', 'Sa Amin Ay Mabuti Ka Ama', 72, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:02:01', '2024-06-24 02:02:01'),
(131, 5, 'viewed', 'Kami\'y Iyong Dingin', 73, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:03:46', '2024-06-24 02:03:46'),
(132, 5, 'viewed', 'Kami\'y Iyong Dingin', 73, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:03:46', '2024-06-24 02:03:46'),
(133, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:15:34', '2024-06-24 02:15:34'),
(134, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:15:34', '2024-06-24 02:15:34'),
(135, 5, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:18:46', '2024-06-24 02:18:46'),
(136, 5, 'viewed', 'Sa Lugo Niya\'y Nabanal Ka Na', 76, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:18:47', '2024-06-24 02:18:47'),
(137, 5, 'viewed', 'Sa Amin Ay Mabuti Ka Ama', 72, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:20:41', '2024-06-24 02:20:41'),
(138, 5, 'viewed', 'Sa Amin Ay Mabuti Ka Ama', 72, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:20:41', '2024-06-24 02:20:41'),
(139, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:22:54', '2024-06-24 02:22:54'),
(140, 5, 'viewed', 'Jesus, Iyong Kaawaan, Palakasin Ako', 68, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:22:54', '2024-06-24 02:22:54'),
(141, 5, 'viewed', 'Sa Maluwalhating Tahanan', 75, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:26:42', '2024-06-24 02:26:42'),
(142, 5, 'viewed', 'Sa Maluwalhating Tahanan', 75, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:26:43', '2024-06-24 02:26:43'),
(143, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:28:43', '2024-06-24 02:28:43'),
(144, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 02:28:43', '2024-06-24 02:28:43'),
(145, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 03:49:47', '2024-06-24 03:49:47'),
(146, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 03:49:47', '2024-06-24 03:49:47'),
(147, 11, 'login', 'Eugene Eustaquio', 11, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 03:52:32', '2024-06-24 03:52:32'),
(148, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 03:53:05', '2024-06-24 03:53:05'),
(149, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 03:53:06', '2024-06-24 03:53:06'),
(150, 9, 'login', 'Music Encoder 01', 9, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:00:29', '2024-06-24 04:00:29'),
(151, 5, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 04:03:05', '2024-06-24 04:03:05'),
(152, 5, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.64', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', '2024-06-24 04:03:06', '2024-06-24 04:03:06'),
(153, 9, 'created', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'add new hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:03:32', '2024-06-24 04:03:32'),
(154, 9, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:03:39', '2024-06-24 04:03:39'),
(155, 9, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:03:40', '2024-06-24 04:03:40'),
(156, 9, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:04:00', '2024-06-24 04:04:00'),
(157, 9, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:04:00', '2024-06-24 04:04:00'),
(158, 9, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:06:33', '2024-06-24 04:06:33'),
(159, 9, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:06:33', '2024-06-24 04:06:33'),
(160, 9, 'updated', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'update hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:07:14', '2024-06-24 04:07:14'),
(161, 9, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:07:17', '2024-06-24 04:07:17'),
(162, 9, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:07:18', '2024-06-24 04:07:18'),
(163, 11, 'login', 'Eugene Eustaquio', 11, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:07:35', '2024-06-24 04:07:35'),
(164, 11, 'created', 'MusicCreator', 106, 'add new credit', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:08:53', '2024-06-24 04:08:53'),
(165, 9, 'login', 'Music Encoder 01', 9, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:09:15', '2024-06-24 04:09:15'),
(166, 9, 'created', 'MusicCreator', 107, 'add new credit', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:10:26', '2024-06-24 04:10:26'),
(167, 9, 'created', 'MusicCreator', 108, 'add new credit', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:10:47', '2024-06-24 04:10:47'),
(168, 9, 'created', 'MusicCreator', 109, 'add new credit', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:12:20', '2024-06-24 04:12:20'),
(169, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:15:04', '2024-06-24 04:15:04'),
(170, 5, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:15:31', '2024-06-24 04:15:31'),
(171, 5, 'viewed', 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', 80, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:15:32', '2024-06-24 04:15:32'),
(172, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:22:34', '2024-06-24 04:22:34'),
(173, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:29:37', '2024-06-24 04:29:37'),
(174, 5, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:36:20', '2024-06-24 04:36:20'),
(175, 5, 'viewed', 'Ang Aking Panalangin', 78, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:36:20', '2024-06-24 04:36:20'),
(176, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:38:56', '2024-06-24 04:38:56'),
(177, 11, 'login', 'Eugene Eustaquio', 11, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:42:15', '2024-06-24 04:42:15'),
(178, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:43:27', '2024-06-24 04:43:27'),
(179, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:43:28', '2024-06-24 04:43:28'),
(180, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:44:29', '2024-06-24 04:44:29'),
(181, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:44:30', '2024-06-24 04:44:30'),
(182, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:45:23', '2024-06-24 04:45:23'),
(183, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:45:24', '2024-06-24 04:45:24'),
(184, 11, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:51:19', '2024-06-24 04:51:19'),
(185, 11, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 04:51:19', '2024-06-24 04:51:19'),
(186, 5, 'login', 'EVM', 5, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:38:06', '2024-06-24 15:38:06'),
(187, 5, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:39:00', '2024-06-24 15:39:00'),
(188, 5, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:39:00', '2024-06-24 15:39:00'),
(189, 9, 'login', 'Music Encoder 01', 9, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:40:18', '2024-06-24 15:40:18'),
(190, 9, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:41:38', '2024-06-24 15:41:38'),
(191, 9, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:41:39', '2024-06-24 15:41:39'),
(192, 9, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:42:34', '2024-06-24 15:42:34'),
(193, 9, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 15:42:34', '2024-06-24 15:42:34'),
(194, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 17:01:49', '2024-06-24 17:01:49'),
(195, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 19:47:21', '2024-06-24 19:47:21'),
(196, 8, 'updated', 'Acierto', 3, 'update the credit', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 19:47:51', '2024-06-24 19:47:51'),
(197, 8, 'created', 'Common', 5, 'add new group', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(198, 8, 'created', 'Ryan Solitario', 15, 'add new user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 21:46:54', '2024-06-24 21:46:54'),
(199, 8, 'login', 'Admin', 8, 'login user', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:10:45', '2024-06-24 22:10:45'),
(200, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:14:23', '2024-06-24 22:14:23'),
(201, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:14:25', '2024-06-24 22:14:25'),
(202, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:16:52', '2024-06-24 22:16:52'),
(203, 8, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:16:53', '2024-06-24 22:16:53'),
(204, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:17:37', '2024-06-24 22:17:37'),
(205, 8, 'viewed', 'DARATING DIN ANG KAGALAKAN', 71, 'view hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:17:38', '2024-06-24 22:17:38');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `changes`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(206, 8, 'updated', 'Ako Nawa Ay Patawarin', 69, 'update hymn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 22:19:01', '2024-06-24 22:19:01'),
(207, 5, 'login', 'EVM', 5, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:25:27', '2024-06-24 23:25:27'),
(208, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:25:59', '2024-06-24 23:25:59'),
(209, 9, 'login', 'Music Encoder 01', 9, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:26:13', '2024-06-24 23:26:13'),
(210, 15, 'login', 'Ryan Solitario', 15, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:26:25', '2024-06-24 23:26:25'),
(211, 11, 'login', 'Eugene Eustaquio', 11, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:28:53', '2024-06-24 23:28:53'),
(212, 11, 'created', 'O Ama', 81, 'add new hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:31:20', '2024-06-24 23:31:20'),
(213, 11, 'viewed', 'O Ama', 81, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:31:29', '2024-06-24 23:31:29'),
(214, 11, 'viewed', 'O Ama', 81, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:31:29', '2024-06-24 23:31:29'),
(215, 11, 'updated', 'O Ama', 81, 'update hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:32:05', '2024-06-24 23:32:05'),
(216, 11, 'created', 'MusicCreator', 110, 'add new credit', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:33:50', '2024-06-24 23:33:50'),
(217, 11, 'updated', 'O Ama', 81, 'update hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:34:56', '2024-06-24 23:34:56'),
(218, 11, 'viewed', 'O Ama', 81, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:35:01', '2024-06-24 23:35:01'),
(219, 11, 'viewed', 'O Ama', 81, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:35:01', '2024-06-24 23:35:01'),
(220, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:35:36', '2024-06-24 23:35:36'),
(221, 11, 'viewed', 'Ako Nawa Ay Patawarin', 69, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:35:36', '2024-06-24 23:35:36'),
(222, 5, 'login', 'EVM', 5, 'login user', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:37:29', '2024-06-24 23:37:29'),
(223, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:37:39', '2024-06-24 23:37:39'),
(224, 5, 'viewed', 'Huwag Akong Limutin', 77, 'view hymn', '172.18.124.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-24 23:37:39', '2024-06-24 23:37:39'),
(225, 8, 'login', 'Admin', 8, 'login user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-25 00:06:51', '2024-06-25 00:06:51'),
(226, 8, 'updated', 'Ryan Solitario', 15, 'update the user', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-25 00:07:07', '2024-06-25 00:07:07'),
(227, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-25 00:16:01', '2024-06-25 00:16:01'),
(228, 8, 'viewed', 'Huwag Iiwan Ang', 79, 'view hymn', '172.18.125.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-06-25 00:16:02', '2024-06-25 00:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `api_documentations`
--

CREATE TABLE `api_documentations` (
  `id` int(11) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api_documentations`
--

INSERT INTO `api_documentations` (`id`, `endpoint`, `description`, `updated_at`, `created_at`) VALUES
(1, 'GET/api/musics', 'Retrieve all music records.', '2024-06-05 19:58:18', '2024-06-05 18:38:06'),
(3, 'GET/api/musics/{id}', 'Retrieve a specific music record by its ID', '2024-06-05 19:58:22', '2024-06-05 19:40:14'),
(7, 'GET/api/musics/search?title={value}', 'Search for music records by their title', '2024-06-05 19:58:47', '2024-06-05 19:41:21'),
(8, 'GET/api/musics/search?category={value}', 'Search for music records by category', '2024-06-05 19:58:51', '2024-06-05 19:41:39'),
(9, 'GET/api/musics/search?arranger={value}', 'Search for music records by arranger', '2024-06-05 19:58:56', '2024-06-05 19:42:21'),
(10, 'GET/api/musics/search?composer={value}', 'Search for music records by composer', '2024-06-05 19:59:01', '2024-06-05 19:42:57'),
(11, 'GET/api/musics/search?lyricist={value}', 'Search for music records by lyricist', '2024-06-05 19:59:06', '2024-06-05 19:43:16'),
(12, 'GET/api/musics/search?hymn_number={value}', 'Search for music records by hymn_number', '2024-06-05 20:19:49', '2024-06-05 20:19:35'),
(13, 'GET/api/api-endpoints', 'Displays all endpoints from the api_documentations', '2024-06-06 00:10:30', '2024-06-06 00:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Anibersaryo ng Iglesia', NULL, NULL),
(2, 'Bago Magteksto', NULL, NULL),
(3, 'Bago Manalangin', NULL, NULL),
(4, 'Bago Manalangin/ Panata MT', NULL, '2024-05-07 15:46:09'),
(5, 'Banal na Hapunan', NULL, NULL),
(6, 'Banal na Hapunan (bread)', NULL, NULL),
(7, 'Banal na Pamumuhay', NULL, NULL),
(8, 'Bautismo', NULL, NULL),
(9, 'Kahalagahan ng Iglesia', NULL, NULL),
(10, 'Kahalagahan ng panalangin', NULL, NULL),
(11, 'Kahalalan', NULL, NULL),
(12, 'Katapatan sa pagsunod', NULL, NULL),
(13, 'Ordenasyon', NULL, '2024-05-02 20:17:59'),
(14, 'Pag-asa sa kaligtasan', NULL, '2024-05-02 19:50:24'),
(15, 'Paggunita sa Sugo', NULL, NULL),
(16, 'Paghahandog', NULL, NULL),
(17, 'Paglabas', NULL, NULL),
(18, 'Pagpapahid ng Langis', NULL, NULL),
(19, 'Pagpapasalamat', NULL, NULL),
(20, 'Pagpupuri kay Cristo', NULL, NULL),
(21, 'Pagpupuri sa Diyos', NULL, NULL),
(22, 'Pagpupuri sa Diyos at kay Cristo', NULL, NULL),
(23, 'Pagtatalaga sa bagong Kapilya', NULL, NULL),
(24, 'Pagtatalaga sa pagsamba', NULL, NULL),
(25, 'Pagtatalaga sa Tingkulin', NULL, NULL),
(26, 'Pagtulong sa Pagpapalaganap', NULL, NULL),
(27, 'Pamamahayag', NULL, NULL),
(28, 'Pananalig kay Cristo', NULL, NULL),
(29, 'Pananalig kay Cristo / Paninindigan', NULL, NULL),
(30, 'Panananalig sa Diyos', NULL, NULL),
(31, 'Paninindigan', NULL, NULL),
(32, 'Sa panahon ng Suliranin', NULL, NULL),
(33, 'Taunang Pasalamat', NULL, NULL),
(34, 'Kasal', NULL, NULL),
(36, 'Entrance March', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `church_hymns`
--

CREATE TABLE `church_hymns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `church_hymns`
--

INSERT INTO `church_hymns` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AWS', NULL, NULL),
(2, 'CWS', NULL, NULL),
(3, 'EM', NULL, NULL),
(4, 'Wedding', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ensemble_types`
--

CREATE TABLE `ensemble_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ensemble_types`
--

INSERT INTO `ensemble_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SATB', NULL, NULL),
(2, 'TTBB', NULL, NULL),
(3, 'SA', NULL, '2024-05-02 22:27:01'),
(4, 'Adult and Children\'s choir', NULL, NULL),
(5, 'SATB with descant', NULL, NULL);

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
-- Table structure for table `group_permissions`
--

CREATE TABLE `group_permissions` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `accessrights` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_permissions`
--

INSERT INTO `group_permissions` (`group_id`, `permission_id`, `category_id`, `accessrights`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 2, 1, 0, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 3, 1, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 4, 1, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 38, 1, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 5, 6, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 6, 6, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 7, 6, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 8, 6, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 9, 6, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 43, 6, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 10, 12, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 11, 12, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 12, 12, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 14, 16, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 15, 16, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 16, 16, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 18, 21, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 19, 21, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 20, 21, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 22, 26, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 23, 26, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 24, 26, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 26, 31, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 27, 31, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 28, 31, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 30, 36, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 31, 36, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 32, 36, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 34, 41, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 35, 41, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 36, 41, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 47, 41, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 39, 48, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 40, 48, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 48, 48, 0, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 44, 54, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 45, 54, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 46, 54, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 13, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 17, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 21, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 25, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 29, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 33, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 49, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 50, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 51, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 52, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(4, 53, 58, 1, '2024-06-12 23:17:12', '2024-06-12 23:17:12'),
(3, 1, 1, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 2, 1, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 3, 1, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 4, 1, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 38, 1, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 5, 6, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 6, 6, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 7, 6, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 8, 6, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 9, 6, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 43, 6, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 10, 12, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 11, 12, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 12, 12, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 14, 16, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 15, 16, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 16, 16, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 18, 21, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 19, 21, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 20, 21, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 22, 26, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 23, 26, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 24, 26, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 26, 31, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 27, 31, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 28, 31, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 30, 36, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 31, 36, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 32, 36, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 34, 41, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 35, 41, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 36, 41, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 47, 41, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 39, 48, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 40, 48, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 48, 48, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 44, 54, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 45, 54, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 46, 54, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 13, 58, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 17, 58, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 21, 58, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 25, 58, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 29, 58, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 33, 58, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 49, 58, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 50, 58, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 51, 58, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 52, 58, 0, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(3, 53, 58, 1, '2024-06-12 23:17:25', '2024-06-12 23:17:25'),
(2, 1, 1, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 2, 1, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 3, 1, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 4, 1, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 5, 6, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 6, 6, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 7, 6, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 8, 6, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 9, 6, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 43, 6, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 10, 12, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 11, 12, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 12, 12, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 14, 16, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 15, 16, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 16, 16, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 18, 21, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 19, 21, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 20, 21, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 22, 26, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 23, 26, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 24, 26, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 26, 31, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 27, 31, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 28, 31, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 30, 36, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 31, 36, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 32, 36, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 34, 41, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 35, 41, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 36, 41, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 47, 41, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 39, 48, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 40, 48, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 48, 48, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 44, 54, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 45, 54, 1, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 46, 54, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 13, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 17, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 21, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 25, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 29, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 33, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 49, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 50, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 51, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 52, 58, 0, '2024-06-13 22:26:59', '2024-06-13 22:26:59'),
(2, 53, 58, 0, '2024-06-13 22:27:00', '2024-06-13 22:27:00'),
(1, 1, 1, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 2, 1, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 3, 1, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 4, 1, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 5, 6, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 6, 6, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 7, 6, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 8, 6, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 9, 6, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 43, 6, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 10, 12, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 11, 12, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 12, 12, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 14, 16, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 15, 16, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 16, 16, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 18, 21, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 19, 21, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 20, 21, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 22, 26, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 23, 26, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 24, 26, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 26, 31, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 27, 31, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 28, 31, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 30, 36, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 31, 36, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 32, 36, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 34, 41, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 35, 41, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 36, 41, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 47, 41, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 39, 48, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 40, 48, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 48, 48, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 44, 54, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 45, 54, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 46, 54, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 13, 58, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 17, 58, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 21, 58, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 25, 58, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 29, 58, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 33, 58, 1, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 49, 58, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 50, 58, 0, '2024-06-13 22:27:58', '2024-06-13 22:27:58'),
(1, 51, 58, 0, '2024-06-13 22:27:59', '2024-06-13 22:27:59'),
(1, 52, 58, 0, '2024-06-13 22:27:59', '2024-06-13 22:27:59'),
(1, 53, 58, 1, '2024-06-13 22:27:59', '2024-06-13 22:27:59'),
(5, 1, 1, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 2, 1, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 3, 1, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 4, 1, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 5, 6, 1, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 6, 6, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 7, 6, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 8, 6, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 9, 6, 1, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 43, 6, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 10, 12, 1, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 11, 12, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 12, 12, 1, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 14, 16, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 15, 16, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 16, 16, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 18, 21, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 19, 21, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 20, 21, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 22, 26, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 23, 26, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 24, 26, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 26, 31, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 27, 31, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 28, 31, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 30, 36, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 31, 36, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 32, 36, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 34, 41, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 35, 41, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 36, 41, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 47, 41, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 39, 48, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 40, 48, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 48, 48, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 44, 54, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 45, 54, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 46, 54, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 13, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 17, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 21, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 25, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 29, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 33, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 49, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 50, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 51, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 52, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14'),
(5, 53, 58, 0, '2024-06-24 21:46:14', '2024-06-24 21:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `instrumentations`
--

CREATE TABLE `instrumentations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instrumentations`
--

INSERT INTO `instrumentations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Organ', NULL, '2024-05-02 22:22:29'),
(2, 'Organ (four hands)', NULL, '2024-05-02 22:22:35'),
(3, 'Organ with brass', NULL, NULL),
(4, 'Organ and piano', NULL, '2024-05-02 22:25:19'),
(5, 'Organ, piano, and brass', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tagalog', NULL, NULL),
(2, 'English', NULL, NULL),
(3, 'French', NULL, NULL),
(4, 'Italian', NULL, NULL),
(5, 'Japanese', NULL, NULL),
(6, 'Portuguese', NULL, NULL),
(7, 'Spanish', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_17_050741_create_music_creators_table', 1),
(6, '2024_04_17_050930_create_church_hymns_table', 1),
(7, '2024_04_17_050938_create_categories_table', 1),
(8, '2024_04_17_051008_create_instrumentations_table', 1),
(9, '2024_04_17_051017_create_ensemble_types_table', 1),
(10, '2024_04_17_051025_create_languages_table', 1),
(11, '2024_04_17_051254_create_musics_table', 1),
(12, '2024_04_17_051910_create_music_lyricist_table', 2),
(13, '2024_04_17_051920_create_music_composer_table', 2),
(14, '2024_04_17_051950_create_music_arranger_table', 2),
(15, '2024_04_21_043736_create_music_category_table', 3),
(16, '2024_04_21_043742_create_music_instrumentation_table', 3),
(17, '2024_04_21_043748_create_music_ensemble_type_table', 3),
(18, '2024_04_21_044619_modify_musics_table', 4),
(19, '2024_06_04_062006_create_permissions_table', 5),
(20, '2024_06_11_160951_create_activity_logs_table', 6),
(21, '2024_06_12_034720_add_lyrics_to_musics_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `musics`
--

CREATE TABLE `musics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `church_hymn_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `song_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `music_score_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lyrics_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vocals_mp3_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organ_mp3_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preludes_mp3_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verses_used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lyrics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `musics`
--

INSERT INTO `musics` (`id`, `church_hymn_id`, `title`, `song_number`, `music_score_path`, `lyrics_path`, `vocals_mp3_path`, `organ_mp3_path`, `preludes_mp3_path`, `language_id`, `verses_used`, `created_by`, `updated_by`, `created_at`, `updated_at`, `lyrics`) VALUES
(68, 1, 'Jesus, Iyong Kaawaan, Palakasin Ako', '526', 'music_files/526.pdf', 'music_files/526 Lyrics Only.pdf', 'music_files/526.mp3', NULL, 'music_files/P526.mp3', 1, 'asd', 1, 1, '2024-06-05 19:34:57', '2024-06-13 22:05:14', '\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n \n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nO,\nAng\n2. \n1. \n\n\n\n\n\nkung\nhi\nI\nrap\nkaw\nnang\nang\nma\n\n\n\n\n\n\n\n\n\n\n\nsa\nbu\n\'ki\'y\nhay di\nla\n\n\n\n\n\n\n\n\n\n\ngi\nto sa\nnang\nda\nsa\nig\nsa\n\n\n\n\n\n\n\n\n\n\n\ndig;\nma,\n\n\n\n\n- - - - -\n- - - -\n-\n\n\n\n\n\n\n\n\n\n\nAng ma\nHin\n\n\n\n\n\nra\ndi\nmi\nma\nkong\ni\nti\ni\n\n\n\n\n\n\n\n\n\n\n\ni\nwa\nsin,\nsan, lung\na\n\n\n\n\n\n\n\n\n\n\nkot\nking ma\nat\nba\nli ga\nba\n\n\n\n\n\n\n\n\n\nlig\nta;\n\n\n\n\n\n- - - -\n-- - - - - -\n- - - -\n-\n\n\n\n\n\n\n\n\n\n\n\nAng\nNgu-nit\n\n\n\n\n\n\n\n\n\n\n\n\n\na\npag\nking\nsu\nma\nnod\nka\npo\n\n\n\n\n\n\n \n\n\n\n\n\n\n\n\nka\nsa\nya\nIyo\nang\nay\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\npi\nma\nnag\ni\nda\nta\nra\nta\n\n\n\n\n\n\n\n\n \n\n\n\na\ngu\nnan\nyod\n\n\n\n\n\n\n- - - - - -\n- - -\n- - -\n- - - -\nIntroduction\npage 1 of 2\nprinted 10/22/2023\nUnison\nST\nJESUS, IYONG KAAWAAN, PALAKASIN AKO\n526\nCopyright © 2023 Iglesia Ni Cristo (Church Of Christ). All Rights Reserved.\nPMD\n\n\n\n\n\n\n\n\n\n\n\n\nKung I\nPag\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkaw\nkat,\nang\nJe\na\nsus,\na\nhan\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nla\nda\nlay\nKang\nsa\na\n \n\n\n\n\n\n\n\n\n\n\n\n\n\n \n\nIyong\nko\na\nay\nbang\ntu\nling\nlu\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkod.\nngan.\n\n\n\n- - - - -\n- - - - - -\n-\n\n\n\n\n\n\n\nJe\n\n\n\n\n\n\n\n\n\n\n\n\nsus, Iyong ka a\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nwa an, pa\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nla ka sin a\n\n\n\n\n \n\n\nko,\n\n\n- - - - - - - -\n\n\n\n\n\n\n\n\nLa\n\n\n\n\n\n\n\n\n\n\n\ngi Mong sak lo\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nlo han a\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkong a li pin\n\n\n\n\n\n\n\n\n\n\n\nMo,\n\n\n- - - - - - -\n\n\n\n\n\n\n\nAt\n\n\n\n\n\n\n\n\n\n\n\n\n\nang a king pag\n\n\n\n\n\n\n\n\n\n\na sa ay\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nIyong pag ti ba\n\n\n\n\n\n\n\n\n\n\n\n\n\nyin\n\n\n- -- -- -\n\n\n\n\n\n\n\n\nNang\n\n\n\n\n\n\n\n\n\n\n\n\n\nu pang ma ti\n\n\n\n\n\n\n\n\n\n\n\n\nis ko ang\n\n\n\n\n\n\n\n\n\n\n\n\n\nmg a hi la\n\n\n\n\n\n\n\n\n\n\nhil.\n\n\n- - - - - -\nRefrain\npage 2 of 2\nSATB\nCopyright © 2023 Iglesia Ni Cristo (Church Of Christ). All Rights Reserved.\nJESUS, IYONG KAAWAAN, PALAKASIN AKO\n526\nprinted 10/22/2023\n2.\n2.'),
(69, 1, 'Ako Nawa Ay Patawarin', '10', 'music_files/10.pdf', 'music_files/Ako Nawa Ay Patawarin.pdf', 'music_files/010.mp3', NULL, 'music_files/P010.mp3', 1, NULL, 9, 9, '2024-06-13 19:26:59', '2024-06-13 22:10:28', NULL),
(71, 1, 'DARATING DIN ANG KAGALAKAN', '456', 'music_files/FILIPINO_HYMNS_AWS_1_526_551_594forprinting_23October2023_526.pdf', 'music_files/456.pdf', 'music_files/456.mp3', 'music_files/456 organ.mp3', 'music_files/P456.mp3', 1, 'sadf', 8, 8, '2024-06-13 21:58:01', '2024-06-13 21:58:01', NULL),
(72, 1, 'Sa Amin Ay Mabuti Ka Ama', '16', 'music_files/16.pdf', 'music_files/Sa Amin Ay Mabuti Ka Ama.pdf', 'music_files/016.mp3', NULL, 'music_files/P016.mp3', 1, NULL, 9, 9, '2024-06-13 22:35:10', '2024-06-13 22:35:10', NULL),
(73, 1, 'Kami\'y Iyong Dingin', '20', 'music_files/20.pdf', 'music_files/Kami\'y Iyong Dinggin.pdf', 'music_files/020.mp3', NULL, 'music_files/P020.mp3', 1, NULL, 9, 9, '2024-06-13 22:40:39', '2024-06-13 22:40:39', NULL),
(74, 1, 'Ang Aming Pagsisikapan', '12', 'music_files/12.pdf', 'music_files/Ang Aming Pagsisikapan.pdf', 'music_files/012.mp3', NULL, 'music_files/P012.mp3', 1, NULL, 9, 9, '2024-06-13 22:51:29', '2024-06-13 22:51:29', NULL),
(75, 1, 'Sa Maluwalhating Tahanan', '29', 'music_files/29.pdf', 'music_files/Sa Maluwalhating Tahanan.pdf', 'music_files/029.mp3', NULL, 'music_files/P029.mp3', 1, NULL, 9, 9, '2024-06-13 22:55:55', '2024-06-13 22:55:55', NULL),
(76, 1, 'Sa Lugo Niya\'y Nabanal Ka Na', '40', 'music_files/40.pdf', 'music_files/Sa Dugo Niya\'y Nabanal Ka Na.pdf', 'music_files/P040.mp3', NULL, 'music_files/040.mp3', 1, NULL, 9, 9, '2024-06-13 23:02:47', '2024-06-13 23:02:47', NULL),
(77, 1, 'Huwag Akong Limutin', '83', 'music_files/83.pdf', 'music_files/Huwag Akong Limutin.pdf', 'music_files/083.mp3', NULL, 'music_files/P083.mp3', 1, NULL, 9, 9, '2024-06-13 23:07:18', '2024-06-13 23:07:18', NULL),
(78, 2, 'Ang Aking Panalangin', '20', 'music_files/PNK_020 - Ang Aking Panalangin_8Jan2016.pdf', 'music_files/Ang Aking Panalangin.pdf', 'music_files/C020.mp3', NULL, 'music_files/P-C020.mp3', 1, NULL, 9, 9, '2024-06-13 23:20:03', '2024-06-13 23:20:03', NULL),
(79, 2, 'Huwag Iiwan Ang', '3', 'music_files/PNK_003 - Huwag Iiwan Ang Pagsamba 20Jan2016__.pdf', 'music_files/Huwag Iiwan Ang Pagsamba.pdf', 'music_files/C003.mp3', NULL, 'music_files/P-C003.mp3', 1, NULL, 9, 9, '2024-06-13 23:28:29', '2024-06-13 23:28:29', NULL),
(80, 1, 'Bayan Mo\'y Sumusulong Dahil Po Sa Iyong Tulong', '335', 'music_files/335_05Jun2024_v2.pdf', NULL, 'music_files/Bayan Mo\'y Sumusulong Dahil Sa Iyong Tulong.mp3', NULL, NULL, 1, NULL, 9, 9, '2024-06-24 04:03:32', '2024-06-24 04:03:32', NULL),
(81, 1, 'O Ama', '174', 'music_files/174_05June2024 - Score.pdf', NULL, 'music_files/174_12Feb2024.v2.mp3', NULL, NULL, 1, NULL, 11, 11, '2024-06-24 23:31:20', '2024-06-24 23:31:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `music_arranger`
--

CREATE TABLE `music_arranger` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `arranger_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_arranger`
--

INSERT INTO `music_arranger` (`id`, `music_id`, `arranger_id`, `created_at`, `updated_at`) VALUES
(144, 68, 1, NULL, NULL),
(145, 68, 12, NULL, NULL),
(146, 68, 13, NULL, NULL),
(147, 68, 25, NULL, NULL),
(149, 71, 2, NULL, NULL),
(150, 71, 4, NULL, NULL),
(151, 80, 52, NULL, NULL),
(152, 81, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `music_category`
--

CREATE TABLE `music_category` (
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_category`
--

INSERT INTO `music_category` (`music_id`, `category_id`) VALUES
(68, 1),
(69, 1),
(69, 3),
(69, 4),
(71, 1),
(72, 21),
(73, 30),
(74, 21),
(75, 14),
(76, 7),
(77, 28),
(78, 30),
(79, 21),
(80, 21),
(81, 7),
(81, 30);

-- --------------------------------------------------------

--
-- Table structure for table `music_composer`
--

CREATE TABLE `music_composer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `composer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_composer`
--

INSERT INTO `music_composer` (`id`, `music_id`, `composer_id`, `created_at`, `updated_at`) VALUES
(109, 68, 2, NULL, NULL),
(110, 68, 4, NULL, NULL),
(111, 69, 88, NULL, NULL),
(113, 71, 2, NULL, NULL),
(114, 71, 3, NULL, NULL),
(115, 72, 65, NULL, NULL),
(116, 73, 36, NULL, NULL),
(117, 74, 18, NULL, NULL),
(118, 76, 84, NULL, NULL),
(119, 77, 4, NULL, NULL),
(120, 78, 29, NULL, NULL),
(121, 81, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `music_creators`
--

CREATE TABLE `music_creators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duty` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `music_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_creators`
--

INSERT INTO `music_creators` (`id`, `name`, `local`, `district`, `duty`, `birthday`, `music_background`, `designation`, `created_at`, `updated_at`) VALUES
(1, 'Albert Lapuz', 'sagana', 'central', 'Choir Director', '1988-02-07 00:00:00', 'asd', 1, NULL, '2024-05-20 23:44:24'),
(2, 'Alejandro M. Pangulayan', NULL, NULL, '', NULL, NULL, 1, NULL, '2024-05-07 15:38:43'),
(3, 'Acierto', 'test', 'test', 'test', NULL, 'test', 1, NULL, '2024-06-24 19:47:51'),
(4, 'Anthony Jumipit', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(5, 'Antonio T. de Guzman Jr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(6, 'Arman Santos', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(7, 'Ariel del Rosario', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(8, 'Arnel Deseo Jr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(9, 'Benito M. Pangulayan', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(10, 'Bienvenido C. Santiago', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(11, 'Brandon Rosquites', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(12, 'Carlo Joshua Pineda', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(13, 'Catherine Wetzstein', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(14, 'Cesar Camacho', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(15, 'Cesar Feliciano', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(16, 'Charlyn Rugayan', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(17, 'Christian Sioson', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(18, 'Christian Tolentino', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(19, 'Christine Balbuena', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(20, 'Clifford Kent N. Calaguas', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(21, 'Crisnie C. Villastique', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(22, 'Danilo C. Pantollano', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(23, 'Darren Rubic', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(24, 'Darryl Paloay', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(25, 'Darvin Patio', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(26, 'David M. Magracia', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(27, 'Darl Patrick Macanas', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(28, 'Deborah Potes', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(29, 'Denniel D. Castro', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(30, 'Dennis Zason', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(31, 'Dominador Santos', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(32, 'Donald Pareña', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(33, 'Donald R. Parena', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(34, 'Ed Manguiat', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(35, 'Ednalyn Cayabvab', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(36, 'Eileen A. Pingol', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(37, 'Eileen L. Apostol', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(38, 'Eugen Magbanua', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(39, 'Emiliano P. Magtuto Sr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(40, 'Eric Don Velasco', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(41, 'Ernie Magtuto', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(42, 'EVM', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(43, 'Fausto T. Perez', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(44, 'Fe De Santis', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(45, 'Fritz Donnel Basit', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(46, 'Gabriel Along', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(47, 'Gabriel Jason De Borja', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(48, 'Gabriel Nabong', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(49, 'Gail Antolin', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(50, 'Garwin V. Cruz', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(51, 'Gelo Cruz', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(52, 'Gemma Minna M. de Guzman', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(53, 'Gerardo Roldan', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(54, 'Hermes Villados', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(55, 'Hermis Villados', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(56, 'Honesto Engay Jr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(57, 'James Hermoso', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(58, 'Jane Manahan', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(59, 'Jedernil Hidrosolo', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(60, 'Jefraem Manalo', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(61, 'Joesel Zosimo', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(62, 'Joan Solitario', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(63, 'Johenes Maghuyop Ill', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(64, 'Joon de Guia', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(65, 'Jose A. Mena Jr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(66, 'Jose Marco Valerio', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(67, 'JR Francisco', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(68, 'Katherine Ebido', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(69, 'Katherine Ebido', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(70, 'Kimo Oades', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(71, 'Lenzer Labuguen', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(72, 'Lynn V. Manalo', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(73, 'Marvin Soriano', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(74, 'May Felix', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(75, 'Michael A. Solitario', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(76, 'Michelle Vasquez', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(77, 'Mike Velasco', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(78, 'Nenita Dejan', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(79, 'Nenita Rosanes', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(80, 'Nesson Aguilar', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(81, 'Ramon C. Reyes', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(82, 'Randolf del Rosario', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(83, 'Reynaldo Gendrano', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(84, 'Rhodora A. Megia', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(85, 'Robert Smith', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(86, 'Rod Y. Ramos', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(87, 'Rodolfo C. Sanchez', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(88, 'Rogel P. Flores', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(89, 'Romeo Flores Sr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(90, 'Romeo V. Mangandi', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(91, 'Ronald M. Gabatino', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(92, 'Ryan Jomillo', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(93, 'Ryan Solitario', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(94, 'Sanrex Tinda', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(95, 'Santos Cordez', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(96, 'Serafin David Jr.', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(97, 'Tom Catangay', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(98, 'Vince Eduard Quinitio', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(99, 'Virginia Debatian', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(100, 'Von Joshua Flores', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(101, 'Willy Rivera', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(102, 'Zap Rexton Lazaro', NULL, NULL, '', '0000-00-00 00:00:00', NULL, 0, NULL, NULL),
(106, 'Eugene Eustaquio', 'Templo', 'Central', 'Ministerial Worker', '1984-02-02 00:00:00', 'Master in Music', 2, '2024-06-24 04:08:53', '2024-06-24 04:08:53'),
(107, 'Eugene Eustaquio', 'Templo', 'Central', 'Ministerial Worker', '1984-02-02 00:00:00', 'Master in Music', 3, '2024-06-24 04:10:26', '2024-06-24 04:10:26'),
(108, 'Eugene Eustaquio', 'Templo', 'Central', 'Ministerial Worker', '1984-02-02 00:00:00', 'Master in Music', 1, '2024-06-24 04:10:47', '2024-06-24 04:10:47'),
(109, 'Christian Tolentino', 'Templo', 'Central', 'Choir Director; Organist', '1987-12-18 00:00:00', 'Certified Royal College of Organist', 2, '2024-06-24 04:12:20', '2024-06-24 04:12:20'),
(110, 'Pilar Manalo-Danao', 'Templo', 'Central', '1st Overall Choir Director', NULL, 'Bachelor of Music', 3, '2024-06-24 23:33:50', '2024-06-24 23:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `music_ensemble_type`
--

CREATE TABLE `music_ensemble_type` (
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `ensemble_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_ensemble_type`
--

INSERT INTO `music_ensemble_type` (`music_id`, `ensemble_type_id`) VALUES
(68, 1),
(69, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 3),
(79, 3),
(80, 1),
(80, 3),
(81, 1),
(81, 3);

-- --------------------------------------------------------

--
-- Table structure for table `music_instrumentation`
--

CREATE TABLE `music_instrumentation` (
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `instrumentation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_instrumentation`
--

INSERT INTO `music_instrumentation` (`music_id`, `instrumentation_id`) VALUES
(68, 1),
(68, 2),
(69, 1),
(71, 2),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1);

-- --------------------------------------------------------

--
-- Table structure for table `music_lyricist`
--

CREATE TABLE `music_lyricist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `lyricist_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_lyricist`
--

INSERT INTO `music_lyricist` (`id`, `music_id`, `lyricist_id`, `created_at`, `updated_at`) VALUES
(95, 68, 1, NULL, NULL),
(98, 71, 6, NULL, NULL),
(99, 80, 32, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('felixpareja.pmdit07@gmail.com', '$2y$12$WuueKTm5hHK2JoLLziCMJefq91GXqDyqYF/KFUkfaR4etjGmVS6p2', '2024-04-16 21:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superuser', 'Super User', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(2, 'admin', 'Admin', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(3, 'csv_import', 'CSV Import', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(4, 'dashboard', 'Dashboard', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(5, 'musics.view', 'View', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(6, 'musics.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(7, 'musics.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(8, 'musics.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(9, 'musics.view_hymn', 'View Hymn', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(10, 'music_details.view', 'View', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(11, 'music_details.download', 'Download', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(12, 'music_details.play', 'Play', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(13, 'categories.view', 'View Categories', '2024-06-03 23:56:00', '2024-06-12 23:12:55'),
(14, 'categories.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(15, 'categories.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(16, 'categories.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(17, 'instrumentations.view', 'View Instrumentations', '2024-06-03 23:56:00', '2024-06-12 23:13:40'),
(18, 'instrumentations.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(19, 'instrumentations.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(20, 'instrumentations.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(21, 'ensemble_types.view', 'View Ensemble Types', '2024-06-03 23:56:00', '2024-06-12 23:13:55'),
(22, 'ensemble_types.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(23, 'ensemble_types.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(24, 'ensemble_types.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(25, 'credits.view', 'View Credits', '2024-06-03 23:56:00', '2024-06-12 23:14:04'),
(26, 'credits.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(27, 'credits.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(28, 'credits.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(29, 'groups.view', 'View Groups', '2024-06-03 23:56:00', '2024-06-12 23:14:13'),
(30, 'groups.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(31, 'groups.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(32, 'groups.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(33, 'users.view', 'View Users', '2024-06-03 23:56:00', '2024-06-12 23:14:21'),
(34, 'users.create', 'Create', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(35, 'users.edit', 'Edit', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(36, 'users.delete', 'Delete', '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(39, 'dashboard.summary', 'Summary', '2024-06-11 07:06:19', '2024-06-11 07:06:19'),
(40, 'dashboard.hymns_info', 'Hymns Info', '2024-06-11 07:07:11', '2024-06-11 07:07:11'),
(43, 'musics.action', 'Action', '2024-06-11 15:56:49', '2024-06-11 15:56:49'),
(44, 'profile.save_information', 'Save Information', '2024-06-12 22:35:13', '2024-06-12 22:35:13'),
(45, 'profile.update_password', 'Update Password', '2024-06-12 22:35:33', '2024-06-12 22:35:33'),
(46, 'profile.delete_account', 'Delete Account', '2024-06-12 22:35:53', '2024-06-12 22:35:53'),
(47, 'users.activate_account', 'Activate Account', '2024-06-12 22:55:07', '2024-06-12 22:55:07'),
(48, 'dashboard.view', 'View Dashboard', '2024-06-12 23:09:17', '2024-06-12 23:09:17'),
(49, 'permissions.view', 'View Permissions', '2024-06-12 23:09:58', '2024-06-12 23:09:58'),
(50, 'permission_categories.view', 'View Permission Categories', '2024-06-12 23:10:29', '2024-06-12 23:10:29'),
(51, 'activity_logs.view', 'View Activity Logs', '2024-06-12 23:10:47', '2024-06-12 23:10:47'),
(52, 'api_documentation.view', 'View API Documentation', '2024-06-12 23:11:02', '2024-06-12 23:11:02'),
(53, 'settings.view', 'View Settings', '2024-06-12 23:16:02', '2024-06-12 23:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `permission_categories`
--

CREATE TABLE `permission_categories` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_categories`
--

INSERT INTO `permission_categories` (`id`, `permission_id`, `category_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Global', NULL, '2024-06-03 23:56:00', '2024-06-11 07:02:43'),
(2, 1, 1, NULL, NULL, NULL, NULL),
(3, 2, 1, NULL, NULL, NULL, NULL),
(4, 3, 1, NULL, NULL, NULL, NULL),
(5, 4, 1, NULL, NULL, NULL, NULL),
(6, NULL, NULL, 'Musics', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(7, 5, 6, NULL, NULL, NULL, NULL),
(8, 6, 6, NULL, NULL, NULL, NULL),
(9, 7, 6, NULL, NULL, NULL, NULL),
(10, 8, 6, NULL, NULL, NULL, NULL),
(11, 9, 6, NULL, NULL, NULL, NULL),
(12, NULL, NULL, 'Music Details', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(13, 10, 12, NULL, NULL, NULL, NULL),
(14, 11, 12, NULL, NULL, NULL, NULL),
(15, 12, 12, NULL, NULL, NULL, NULL),
(16, NULL, NULL, 'Categories', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(18, 14, 16, NULL, NULL, NULL, NULL),
(19, 15, 16, NULL, NULL, NULL, NULL),
(20, 16, 16, NULL, NULL, NULL, NULL),
(21, NULL, NULL, 'Instrumentations', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(23, 18, 21, NULL, NULL, NULL, NULL),
(24, 19, 21, NULL, NULL, NULL, NULL),
(25, 20, 21, NULL, NULL, NULL, NULL),
(26, NULL, NULL, 'Ensemble Types', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(28, 22, 26, NULL, NULL, NULL, NULL),
(29, 23, 26, NULL, NULL, NULL, NULL),
(30, 24, 26, NULL, NULL, NULL, NULL),
(31, NULL, NULL, 'Credits', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(33, 26, 31, NULL, NULL, NULL, NULL),
(34, 27, 31, NULL, NULL, NULL, NULL),
(35, 28, 31, NULL, NULL, NULL, NULL),
(36, NULL, NULL, 'Groups', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(38, 30, 36, NULL, NULL, NULL, NULL),
(39, 31, 36, NULL, NULL, NULL, NULL),
(40, 32, 36, NULL, NULL, NULL, NULL),
(41, NULL, NULL, 'Users', NULL, '2024-06-03 23:56:00', '2024-06-03 23:56:00'),
(43, 34, 41, NULL, NULL, NULL, NULL),
(44, 35, 41, NULL, NULL, NULL, NULL),
(45, 36, 41, NULL, NULL, NULL, NULL),
(47, 38, 1, NULL, NULL, NULL, NULL),
(48, NULL, NULL, 'Dashboard', NULL, '2024-06-11 06:54:01', '2024-06-12 23:09:28'),
(49, 39, 48, NULL, NULL, NULL, NULL),
(50, 40, 48, NULL, NULL, NULL, NULL),
(51, 41, 48, NULL, NULL, NULL, NULL),
(52, 42, 48, NULL, NULL, NULL, NULL),
(53, 43, 6, NULL, NULL, NULL, NULL),
(54, NULL, NULL, 'Profile', NULL, '2024-06-12 22:34:02', '2024-06-12 22:34:02'),
(55, 44, 54, NULL, NULL, NULL, NULL),
(56, 45, 54, NULL, NULL, NULL, NULL),
(57, 46, 54, NULL, NULL, NULL, NULL),
(58, NULL, NULL, 'Settings', NULL, '2024-06-12 22:45:13', '2024-06-12 22:45:13'),
(60, 47, 41, NULL, NULL, NULL, NULL),
(61, 13, 58, NULL, NULL, NULL, NULL),
(62, 17, 58, NULL, NULL, NULL, NULL),
(63, 21, 58, NULL, NULL, NULL, NULL),
(64, 25, 58, NULL, NULL, NULL, NULL),
(65, 29, 58, NULL, NULL, NULL, NULL),
(66, 33, 58, NULL, NULL, NULL, NULL),
(67, 48, 48, NULL, NULL, NULL, NULL),
(68, 49, 58, NULL, NULL, NULL, NULL),
(69, 50, 58, NULL, NULL, NULL, NULL),
(70, 51, 58, NULL, NULL, NULL, NULL),
(71, 52, 58, NULL, NULL, NULL, NULL),
(72, 53, 58, NULL, NULL, NULL, NULL),
(73, 54, 1, NULL, NULL, NULL, NULL),
(74, 55, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'PMD-IT', NULL, '2024-06-11 02:26:33', '2024-06-11 02:26:33'),
(2, 'VIP', NULL, '2024-06-11 06:47:35', '2024-06-11 06:47:35'),
(3, 'Encoder', NULL, '2024-06-11 07:09:27', '2024-06-11 07:09:27'),
(4, 'ADMIN', NULL, '2024-06-11 15:55:08', '2024-06-11 15:55:08'),
(5, 'Common', NULL, '2024-06-24 21:46:14', '2024-06-24 21:46:14');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `permissions`, `activated`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Felix Pareja', 'fmpareja', 'felixpareja.pmdit07@gmail.com', NULL, '$2y$12$oXj7Jb0Mq2ubIdW6FnqIH.Y5QJEWSHNxkImnSGf25eEuMripxrKd.', NULL, 1, NULL, '2024-04-16 21:46:25', '2024-06-05 16:59:50'),
(3, 'Kyrt Jurada', 'kjurada', 'kjurada@gmail.com', NULL, '$2y$12$gdJNOpmcVydXmnStkBxnHe1oPVIpWlFtfNPx9c3GsHA/sycQn94ie', NULL, 1, NULL, '2024-06-02 23:08:48', '2024-06-05 16:44:33'),
(4, 'Roland Kim Amaro123', 'rkamaro', 'rkamaro@gmail.com', NULL, '$2y$12$X6mlU56RRbC5zxyy5IVGde/q0Tsr9MgUQt4afweD2JbZKokf1Nbo2', NULL, 1, NULL, '2024-06-03 19:42:53', '2024-06-07 07:08:16'),
(5, 'EVM', 'evm', 'evm@gmail.com', NULL, '$2y$12$Cp0HvJC.wabZ/NtmJ8TyquM0wSDUpNKxblvJix3j1zl0AblSLbyp.', NULL, 1, NULL, '2024-06-03 21:31:13', '2024-06-13 23:36:29'),
(6, 'ATG', 'atg', 'atg@gmail.com', NULL, '$2y$12$u3ikFSmmBU44bVQ9vK160emXzhh98nLkiGTCnO7Gdo5ClMlOcFcPe', NULL, 0, NULL, '2024-06-03 21:34:13', '2024-06-13 23:36:46'),
(7, 'GMG', 'gmg', 'gmg@gmail.com', NULL, '$2y$12$T7j3WfGYbg7Po9iFTI474epUuzRwS2sFtgLsdQNGD06imTmKxC4Im', NULL, 0, NULL, '2024-06-03 21:53:50', '2024-06-13 23:36:59'),
(8, 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$9zTjKojCzPWeitLa/ka0uerS76ygPIPIxE0Vwn/XcR/Xyd6Ynm9RG', NULL, 1, NULL, '2024-06-05 16:46:18', '2024-06-11 15:54:29'),
(9, 'Music Encoder 01', 'music.encoder01', 'music@yahoo.com', NULL, '$2y$12$nefsbqHML1NlRqegOB3.4OM4AdqdAtwulFYBkeo1eUB3eE.d6vU8i', NULL, 1, NULL, '2024-06-12 22:15:58', '2024-06-18 16:44:03'),
(10, 'Music Encoder 02', 'music.encoder02', 'music.encoder02@google.com', NULL, '$2y$12$n.9Lnz1rMCq7NPJA08lTkuGWxnNXm4hYNMP2B7atofAwPFlbltIga', NULL, 1, NULL, '2024-06-13 18:13:31', '2024-06-13 18:13:31'),
(11, 'Eugene Eustaquio', 'eeustaquio', 'eeustaquio@gmail.com', NULL, '$2y$12$eM62ZrFL9Zsrcg0w7YI7T.kNHf3/oHqUhQ3sQgQq7o7SkbZTB3YOa', NULL, 1, NULL, '2024-06-18 16:42:49', '2024-06-18 16:42:49'),
(12, 'Randolf Magan', 'rmagan', 'rmagan@gmail.com', NULL, '$2y$12$7SqN75HAKZtVsySuFLei8eGcb3weyNOqKS9Q3RzDUOIjEmKV.n4a6', NULL, 1, NULL, '2024-06-18 16:43:26', '2024-06-18 16:43:26'),
(13, 'Music Encoder 01', 'music.encoder03', 'music.encoder03@gmail.com', NULL, '$2y$12$9E0/9f764yVeAvlpB.qpQOdX4wBRC9T2KVh70VCmdpHYxI.PESixe', NULL, 1, NULL, '2024-06-18 16:44:36', '2024-06-18 16:44:36'),
(14, 'Music Encoder 04', 'music.encoder04', 'music.encoder04@gmail.com', NULL, '$2y$12$9JzAK04ldZwmtZ85C2co2u11YRkK/1pE8DUrnoAgHFJFkt5R4tFgK', NULL, 1, NULL, '2024-06-18 16:45:05', '2024-06-18 16:45:05'),
(15, 'Ryan Solitario', 'rsolitario', 'rsolitario@gmail.com', NULL, '$2y$12$INEbLKrr/sg3v4SsTmDQcO.GHJLzFcXXvznsEADQTxEEhj1Iy/55K', NULL, 1, NULL, '2024-06-24 21:46:54', '2024-06-24 21:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 4),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_index` (`user_id`);

--
-- Indexes for table `api_documentations`
--
ALTER TABLE `api_documentations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `church_hymns`
--
ALTER TABLE `church_hymns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ensemble_types`
--
ALTER TABLE `ensemble_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instrumentations`
--
ALTER TABLE `instrumentations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musics_church_hymn_id_foreign` (`church_hymn_id`),
  ADD KEY `musics_language_id_foreign` (`language_id`),
  ADD KEY `musics_created_by_foreign` (`created_by`),
  ADD KEY `musics_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `music_arranger`
--
ALTER TABLE `music_arranger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `music_arranger_music_id_foreign` (`music_id`),
  ADD KEY `music_arranger_arranger_id_foreign` (`arranger_id`);

--
-- Indexes for table `music_category`
--
ALTER TABLE `music_category`
  ADD PRIMARY KEY (`music_id`,`category_id`),
  ADD KEY `music_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `music_composer`
--
ALTER TABLE `music_composer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `music_composer_music_id_foreign` (`music_id`),
  ADD KEY `music_composer_composer_id_foreign` (`composer_id`);

--
-- Indexes for table `music_creators`
--
ALTER TABLE `music_creators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music_ensemble_type`
--
ALTER TABLE `music_ensemble_type`
  ADD PRIMARY KEY (`music_id`,`ensemble_type_id`),
  ADD KEY `music_ensemble_type_ensemble_type_id_foreign` (`ensemble_type_id`);

--
-- Indexes for table `music_instrumentation`
--
ALTER TABLE `music_instrumentation`
  ADD PRIMARY KEY (`music_id`,`instrumentation_id`),
  ADD KEY `music_instrumentation_instrumentation_id_foreign` (`instrumentation_id`);

--
-- Indexes for table `music_lyricist`
--
ALTER TABLE `music_lyricist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `music_lyricist_music_id_foreign` (`music_id`),
  ADD KEY `music_lyricist_lyricist_id_foreign` (`lyricist_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_categories`
--
ALTER TABLE `permission_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD UNIQUE KEY `user_id` (`user_id`,`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `api_documentations`
--
ALTER TABLE `api_documentations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `church_hymns`
--
ALTER TABLE `church_hymns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ensemble_types`
--
ALTER TABLE `ensemble_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instrumentations`
--
ALTER TABLE `instrumentations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `musics`
--
ALTER TABLE `musics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `music_arranger`
--
ALTER TABLE `music_arranger`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `music_composer`
--
ALTER TABLE `music_composer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `music_creators`
--
ALTER TABLE `music_creators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `music_lyricist`
--
ALTER TABLE `music_lyricist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `permission_categories`
--
ALTER TABLE `permission_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `musics`
--
ALTER TABLE `musics`
  ADD CONSTRAINT `musics_church_hymn_id_foreign` FOREIGN KEY (`church_hymn_id`) REFERENCES `church_hymns` (`id`),
  ADD CONSTRAINT `musics_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `musics_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `musics_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `music_arranger`
--
ALTER TABLE `music_arranger`
  ADD CONSTRAINT `music_arranger_arranger_id_foreign` FOREIGN KEY (`arranger_id`) REFERENCES `music_creators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_arranger_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_category`
--
ALTER TABLE `music_category`
  ADD CONSTRAINT `music_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_category_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_composer`
--
ALTER TABLE `music_composer`
  ADD CONSTRAINT `music_composer_composer_id_foreign` FOREIGN KEY (`composer_id`) REFERENCES `music_creators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_composer_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_ensemble_type`
--
ALTER TABLE `music_ensemble_type`
  ADD CONSTRAINT `music_ensemble_type_ensemble_type_id_foreign` FOREIGN KEY (`ensemble_type_id`) REFERENCES `ensemble_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_ensemble_type_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_instrumentation`
--
ALTER TABLE `music_instrumentation`
  ADD CONSTRAINT `music_instrumentation_instrumentation_id_foreign` FOREIGN KEY (`instrumentation_id`) REFERENCES `instrumentations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_instrumentation_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_lyricist`
--
ALTER TABLE `music_lyricist`
  ADD CONSTRAINT `music_lyricist_lyricist_id_foreign` FOREIGN KEY (`lyricist_id`) REFERENCES `music_creators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_lyricist_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
