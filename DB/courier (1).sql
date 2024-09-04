-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courier`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:36:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"view agents\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"create agents\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"edit agents\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"delete agents\";s:1:\"c\";s:3:\"web\";}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"view shipments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"create shipments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"edit shipments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"delete shipments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:10:\"view users\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"create users\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:10:\"edit users\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"delete users\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:10:\"view roles\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"create roles\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:10:\"edit roles\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:12:\"delete roles\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"view permissions\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:18:\"create permissions\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:16:\"edit permissions\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:18:\"delete permissions\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:11:\"view status\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"create status\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"edit status\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"delete status\";s:1:\"c\";s:3:\"web\";}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:14:\"show shipments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:25;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:10:\"show users\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:33;s:1:\"b\";s:11:\"show agents\";s:1:\"c\";s:3:\"web\";}i:27;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"download reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:28;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:5:\"print\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:29;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:14:\"view dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:30;a:3:{s:1:\"a\";i:41;s:1:\"b\";s:11:\"view riders\";s:1:\"c\";s:3:\"web\";}i:31;a:3:{s:1:\"a\";i:42;s:1:\"b\";s:13:\"create riders\";s:1:\"c\";s:3:\"web\";}i:32;a:3:{s:1:\"a\";i:43;s:1:\"b\";s:11:\"edit riders\";s:1:\"c\";s:3:\"web\";}i:33;a:3:{s:1:\"a\";i:44;s:1:\"b\";s:13:\"delete riders\";s:1:\"c\";s:3:\"web\";}i:34;a:3:{s:1:\"a\";i:45;s:1:\"b\";s:11:\"show riders\";s:1:\"c\";s:3:\"web\";}i:35;a:3:{s:1:\"a\";i:48;s:1:\"b\";s:12:\"view reports\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:4:\"user\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"agent\";s:1:\"c\";s:3:\"web\";}}}', 1725518514);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_24_111029_create_permission_tables', 1),
(5, '2024_08_25_042706_create_agents_table', 1),
(6, '2024_08_25_062325_create_statuses_table', 1),
(7, '2024_08_25_064725_create_shipments_table', 1),
(8, '2024_08_27_130145_update_shipments_table', 2),
(9, '2024_08_28_074231_create_riders_table', 3),
(10, '2024_08_30_070740_update_agents_table', 4),
(11, '2024_08_31_080010_update_agents_table', 5),
(13, '2024_08_31_081248_update_agents_table', 6),
(14, '2024_09_03_081753_create_rider_assigned_shipments_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 35),
(2, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(6, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view agents', 'web', '2024-08-27 03:33:28', '2024-08-27 03:33:28'),
(2, 'create agents', 'web', '2024-08-27 03:33:34', '2024-08-27 03:33:34'),
(3, 'edit agents', 'web', '2024-08-27 03:33:38', '2024-08-27 03:33:38'),
(4, 'delete agents', 'web', '2024-08-27 03:33:44', '2024-08-27 03:33:44'),
(5, 'view shipments', 'web', '2024-08-27 03:33:53', '2024-08-27 03:33:53'),
(6, 'create shipments', 'web', '2024-08-27 03:34:01', '2024-08-27 03:34:01'),
(7, 'edit shipments', 'web', '2024-08-27 03:34:07', '2024-08-27 03:34:07'),
(8, 'delete shipments', 'web', '2024-08-27 03:34:14', '2024-08-27 03:34:14'),
(9, 'view users', 'web', '2024-08-27 03:34:20', '2024-08-27 03:34:20'),
(10, 'create users', 'web', '2024-08-27 03:34:25', '2024-08-27 03:34:25'),
(11, 'edit users', 'web', '2024-08-27 03:34:29', '2024-08-27 03:34:29'),
(12, 'delete users', 'web', '2024-08-27 03:34:35', '2024-08-27 03:34:35'),
(13, 'view roles', 'web', '2024-08-27 03:34:51', '2024-08-27 03:34:51'),
(14, 'create roles', 'web', '2024-08-27 03:34:58', '2024-08-27 03:34:58'),
(15, 'edit roles', 'web', '2024-08-27 03:35:02', '2024-08-27 03:35:02'),
(16, 'delete roles', 'web', '2024-08-27 03:35:07', '2024-08-27 03:35:07'),
(17, 'view permissions', 'web', '2024-08-27 03:35:12', '2024-08-27 03:35:12'),
(18, 'create permissions', 'web', '2024-08-27 03:35:16', '2024-08-27 03:35:16'),
(19, 'edit permissions', 'web', '2024-08-27 03:35:20', '2024-08-27 03:35:20'),
(20, 'delete permissions', 'web', '2024-08-27 03:35:24', '2024-08-27 03:35:24'),
(21, 'view status', 'web', '2024-08-27 03:35:32', '2024-08-27 03:35:32'),
(22, 'create status', 'web', '2024-08-27 03:35:40', '2024-08-27 03:35:40'),
(23, 'edit status', 'web', '2024-08-27 03:35:45', '2024-08-27 03:35:45'),
(24, 'delete status', 'web', '2024-08-27 03:35:52', '2024-08-27 03:35:52'),
(25, 'show shipments', 'web', '2024-08-27 03:54:11', '2024-08-27 03:54:11'),
(26, 'show users', 'web', '2024-08-27 03:54:17', '2024-08-27 03:54:17'),
(33, 'show agents', 'web', '2024-08-27 06:45:22', '2024-08-27 06:45:22'),
(34, 'download reports', 'web', '2024-08-27 06:48:01', '2024-08-27 06:48:01'),
(36, 'print', 'web', '2024-08-27 06:57:28', '2024-08-27 06:57:28'),
(40, 'view dashboard', 'web', '2024-08-28 02:01:21', '2024-08-28 02:02:00'),
(41, 'view riders', 'web', '2024-08-28 02:49:16', '2024-08-28 02:49:16'),
(42, 'create riders', 'web', '2024-08-28 02:49:23', '2024-08-28 02:49:23'),
(43, 'edit riders', 'web', '2024-08-28 02:49:29', '2024-08-28 02:49:29'),
(44, 'delete riders', 'web', '2024-08-28 02:49:35', '2024-08-28 02:49:35'),
(45, 'show riders', 'web', '2024-08-28 02:51:17', '2024-08-28 02:51:17'),
(48, 'view reports', 'web', '2024-08-29 03:17:13', '2024-08-29 03:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `rider_cnic` varchar(255) NOT NULL,
  `rider_city` varchar(255) DEFAULT NULL,
  `bike_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id`, `name`, `phone`, `rider_cnic`, `rider_city`, `bike_no`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ab', '03092657113', '42201234451234', 'karachi', '55555555555', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', '2024-08-28 03:18:54', '2024-09-03 03:49:14'),
(10, 'Jamalia Velazquez', '+1 (356) 908-8544', '21312321', 'London', '111111', 'Sunt pariatur Vita', '2024-08-28 05:29:26', '2024-09-03 03:41:27'),
(11, 'Hassaaan', '55544112333', '422104455224', NULL, '1234567890', 'model', '2024-09-02 03:13:49', '2024-09-02 03:13:49'),
(12, 'SHEIKH MUHAMMAD ABDULLAH', '03092657113', '42201234451234', 'karachi', '444444444444444', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', '2024-09-03 03:40:11', '2024-09-03 03:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `rider_assigned_shipments`
--

CREATE TABLE `rider_assigned_shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rider_assigned_shipments`
--

INSERT INTO `rider_assigned_shipments` (`id`, `rider_id`, `shipment_id`, `created_at`, `updated_at`) VALUES
(1, 12, 9, '2024-09-03 03:54:22', '2024-09-03 03:54:22'),
(2, 12, 10, '2024-09-03 03:54:22', '2024-09-03 03:54:22'),
(3, 12, 11, '2024-09-03 03:54:22', '2024-09-03 03:54:22'),
(16, 11, 12, '2024-09-04 01:00:29', '2024-09-04 01:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'user', 'web', '2024-08-27 03:31:58', '2024-08-27 03:31:58'),
(3, 'agent', 'web', '2024-08-27 03:32:02', '2024-08-27 03:32:02'),
(6, 'admin', 'web', '2024-08-28 05:38:25', '2024-08-28 05:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 2),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(25, 3),
(34, 2),
(34, 3),
(36, 3),
(40, 2),
(40, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `shipping_date` date NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `sender_phone` varchar(255) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_phone` varchar(255) NOT NULL,
  `pickup_address` varchar(255) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `return_address` varchar(255) NOT NULL,
  `return_city` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `from_area` varchar(255) NOT NULL,
  `to_area` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `status_shipment` varchar(255) NOT NULL DEFAULT 'Order Initiated',
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `package_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `agent_name`, `shipping_date`, `sender_name`, `sender_email`, `receiver_email`, `sender_phone`, `receiver_name`, `receiver_phone`, `pickup_address`, `delivery_address`, `return_address`, `return_city`, `city`, `from_area`, `to_area`, `payment_method`, `order_number`, `tracking_number`, `status_shipment`, `status`, `package_type`, `description`, `quantity`, `weight`, `amount`, `created_at`, `updated_at`, `user_id`) VALUES
(9, 'Abdullah', '2024-09-01', 'Abdullah', 'abdullahsheikhmuhammad21@gmail.com', 'sheikhbillu124@gmail.com', '03092657113', 'Laraverse Spectrum', '03092657113', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'Saddar', 'Model Colony', 'karachi', 'karachi', 'Model Colony', 'Saddar', 'COD', '203560', '9253400104', 'Order Initiated', 'Pending', 'Electronics', NULL, 15, '10kg', 500, '2024-09-01 00:29:26', '2024-09-03 01:37:08', 29),
(10, 'Sheikh', '2024-09-01', 'Sheikh', 'abdullahsheikhmuhammad21@gmail.com', 'sheikhbillu124@gmail.com', '03092657113', 'Spectrum', '03092657113', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'karachi', 'karachi', 'karachi', 'Model Colony', 'Model Colony', 'bank Transfer', '131413', '8394520686', 'Order Initiated', 'Approved', 'Electronics', NULL, 15, '10kg', 67113, '2024-09-01 00:41:43', '2024-09-03 01:39:40', 38),
(11, 'Abdullah', '2024-09-01', 'Sheikh', 'abdullahsheikhmuhammad21@gmail.com', 'abdullah@gmail.com', '03092657113', 'Spectrum2', '03092657113', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'karachi', 'karachi', 'karachi', 'Model Colony', 'Model Colony', 'bank Transfer', '218706', '2077432443', 'On the way', 'Approved', 'Electronics', NULL, 15, '10kg', 500000, '2024-09-01 00:45:27', '2024-09-03 02:40:56', 29),
(12, 'Agent Lahore', '2024-09-01', 'Tanisha Lester', 'fezi@mailinator.com', 'sheikhbillu124@gmail.com', '+1 (972) 952-3758', 'Sigourney Wade', '+1 (221) 854-4091', 'Aspernatur in aliqua', 'Commodo corrupti vo', 'Aliquam ut nihil exe', 'Tenetur sint aut no', 'lahore', 'Quia et qui tempora', 'Aut non anim duis ve', 'bank Transfer', '150552', '4188159216', 'On the way', 'Pending', 'Voluptatem quis expe', 'In enim minus quae e', 327, 'Velit non magnam di', 9, '2024-09-01 02:55:51', '2024-09-03 01:44:07', 39),
(13, 'Sheikh', '2024-09-02', 'Ezra Sexton', 'abdullahsheikhmuhammad21@gmail.com', 'sheikhbillu124@gmail.com', '03003512173', 'Gannon Lynn', '03003512173', '8/10A-Hashim Raza Road Model Colony Karachi', 'Near Ummer Bin Khattab Masjid', '8/10A-Hashim Raza Road Model Colony Karachi', 'Karachi', 'Karachi', 'Model', 'Model', 'COD', '217090', '8991823668', 'Order Initiated', 'Pending', 'Electronic', 'description', 15, '20kg', 500000, '2024-09-02 01:26:55', '2024-09-03 01:40:32', 38),
(15, 'Abdullah', '2007-09-08', 'Eugenia Huber', 'debuferi@mailinator.com', 'sheikhbillu124@gmail.com', '+1 (115) 709-2805', 'Kiara Stephens', '+1 (779) 268-3744', 'Dignissimos et moles', 'Quidem laborum irure', 'Ea odio pariatur Re', 'Autem sit est et co', 'karachi', 'Tempor proident min', 'Fugiat culpa veniam', 'bank Transfer', '168115', '6992544018', 'Delivered', 'Approved', 'Beatae autem exercit', 'Est ex dolorum qui e', 114, 'Doloremque sit obcae', 100, '2024-09-03 01:57:17', '2024-09-03 01:59:59', 29),
(16, 'Abdullah', '2022-05-23', 'Damian Lamb', 'qokuzajigi@mailinator.com', 'qixy@mailinator.com', '+1 (102) 911-2879', 'Elaine Lynch', '+1 (982) 815-3663', 'Suscipit voluptate a', 'Ut eum dolor quis ar', 'Et optio possimus', 'Eius et molestias po', 'karachi', 'Anim facere voluptat', 'Officiis eius laboru', 'bank Transfer', '192358', '3344562518', 'Order Initiated', 'Approved', 'Do perspiciatis mol', 'Nulla tempora sit el', 630, 'Id quisquam aut aut', 44, '2024-09-03 01:59:34', '2024-09-03 05:36:05', 29),
(17, 'Abdullah', '1979-11-25', 'Daryl Hines', 'bube@mailinator.com', 'huky@mailinator.com', '+1 (121) 545-9788', 'Ignacia Cross', '+1 (738) 403-4188', 'Sapiente soluta qui', 'Veniam sed illum v', 'Enim pariatur Elige', 'Non aliquam consequu', 'karachi', 'Cum odio mollit volu', 'Minim voluptate accu', 'bank Transfer', '126611', '3732110425', 'Order Initiated', 'Approved', 'Recusandae Natus pe', 'Corporis facilis opt', 61, 'Alias inventore qui', 95, '2024-09-03 02:04:27', '2024-09-03 02:05:16', 29),
(18, 'Sheikh', '2018-08-24', 'Hannah Ruiz', 'pynik@mailinator.com', 'tapupo@mailinator.com', '+1 (315) 464-9387', 'Avye Barlow', '+1 (186) 619-6345', 'Nihil maxime eaque e', 'Qui id tenetur beata', 'Illo officia ullamco', 'Minim eum animi vit', 'Est dignissimos dign', 'Sint expedita ration', 'Officia dolorum debi', 'bank Transfer', '179865', '6807752886', 'Order Initiated', 'Pending', 'Recusandae Quis in', 'Atque provident lab', 294, 'Fugiat tenetur sit', 34, '2024-09-04 03:09:11', '2024-09-04 03:09:11', 38);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`, `created_at`, `updated_at`) VALUES
(3, 'Delivered', '2024-08-27 06:56:31', '2024-08-27 06:56:31'),
(4, 'On the way', '2024-08-27 06:56:36', '2024-08-27 06:56:36'),
(13, 'Order Initiated', '2024-09-03 01:36:50', '2024-09-03 01:36:50');

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
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `city`, `phone`, `address`, `branch`, `dob`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SHEIKH MUHAMMAD ABDULLAH', 'abdullahsheikhmuhammad21@gmail.com', NULL, '$2y$12$mYpUflzdytyhp3M9rmbnYu.EQHAAtomuEhuOQMwTaUM./iKzhRGL.', 'karachi', '03092657113', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', NULL, '2004-10-19', NULL, '2024-08-27 03:28:56', '2024-08-29 02:09:08'),
(29, 'Abdullah', 'agent@gmail.com', NULL, '$2y$12$BFKIsBZxbZE6fLl6t0URbOBCkygQQre7wJvqzeQNafiv1eQOZRBuu', 'karachi', '03092657113', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'Model Branch', NULL, NULL, '2024-08-31 04:12:03', '2024-08-31 04:12:03'),
(35, 'Sheikh', 'sheikhbillu124@gmail.com', NULL, '$2y$12$rG.z.JHa9UT5bvYRXqnHP.0dPBhokNjr6fakM1bRvPpqaYi955bOO', 'karachi', '03092657113', 'model colony', NULL, '2024-08-31', NULL, '2024-08-31 06:00:51', '2024-08-31 06:00:51'),
(37, 'Abdullah-User', 'abdullah@gmail.com', NULL, '$2y$12$sqph9hso5JH59j6IHk.eF.8.IJ9yTvMUKxyXRRVVYnkYyMDWHyXXC', 'Karachi', '03003512173', '8/10A-Hashim Raza Road Model Colony Karachi', NULL, '2024-08-31', NULL, '2024-08-31 09:57:20', '2024-08-31 09:57:20'),
(38, 'Sheikh', 'ajoher124@gmail.com', NULL, '$2y$12$LvJqQcDQlEzGbUY1XHJ3feJTdU/7puW1dqPXGaBS/9s0mrEd35kcG', 'karachi', '03092657113', 'Model Colony Hashim Raza Road Near Umar Bin Khattab Masjid', 'Karachi Branch', NULL, NULL, '2024-09-01 00:40:31', '2024-09-02 01:40:11'),
(39, 'Agent Lahore', 'agentlahore@gmail.com', NULL, '$2y$12$bvY32cisP3dWpe/J8DOnv.AVGjdpY7weUGp6/fnlB.0y3r9IGMZI2', 'lahore', '03092657113', 'lahore', 'Lahore Branch', NULL, NULL, '2024-09-01 02:55:22', '2024-09-01 03:27:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rider_assigned_shipments`
--
ALTER TABLE `rider_assigned_shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rider_assigned_shipments_rider_id_foreign` (`rider_id`),
  ADD KEY `rider_assigned_shipments_shipment_id_foreign` (`shipment_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_user_id_foreign` (`user_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rider_assigned_shipments`
--
ALTER TABLE `rider_assigned_shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rider_assigned_shipments`
--
ALTER TABLE `rider_assigned_shipments`
  ADD CONSTRAINT `rider_assigned_shipments_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`),
  ADD CONSTRAINT `rider_assigned_shipments_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
