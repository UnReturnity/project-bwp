-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for project_bwp
CREATE DATABASE IF NOT EXISTS `project_bwp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `project_bwp`;

-- Dumping structure for table project_bwp.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.cache: ~0 rows (approximately)

-- Dumping structure for table project_bwp.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.cache_locks: ~0 rows (approximately)

-- Dumping structure for table project_bwp.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.carts: ~0 rows (approximately)

-- Dumping structure for table project_bwp.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.categories: ~0 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'All Products', 'Fresh Bakery Items', '2026-01-08 13:16:50', '2026-01-08 13:16:50');

-- Dumping structure for table project_bwp.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.expenses: ~3 rows (approximately)
INSERT INTO `expenses` (`id`, `description`, `amount`, `date`, `created_at`, `updated_at`) VALUES
	(1, 'Electricity Bill', 500000, '2025-12-14', '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(2, 'Flour Sack (25kg)', 250000, '2025-12-29', '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(3, 'Butter Restock', 150000, '2026-01-03', '2026-01-08 13:16:50', '2026-01-08 13:16:50');

-- Dumping structure for table project_bwp.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table project_bwp.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.jobs: ~0 rows (approximately)

-- Dumping structure for table project_bwp.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.job_batches: ~0 rows (approximately)

-- Dumping structure for table project_bwp.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0000_00_00_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2025_12_31_205039_create_categories_table', 1),
	(6, '2025_12_31_205040_create_products_table', 1),
	(7, '2025_12_31_205041_create_vouchers_table', 1),
	(8, '2025_12_31_205042_create_carts_table', 1),
	(9, '2025_12_31_205043_create_transactions_table', 1),
	(10, '2025_12_31_205045_create_transaction_details_table', 1),
	(11, '2026_01_06_210925_create_expenses_table', 1);

-- Dumping structure for table project_bwp.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table project_bwp.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '100',
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.products: ~12 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `image`, `stock`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Sourdough Loaf', 35000.00, 'images/1767903659.jpg', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:20:59'),
	(2, 'Garlic Baguette', 15000.00, 'https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?auto=format&fit=crop&w=400&q=80', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(3, 'Chocolate Muffin', 25000.00, 'https://images.unsplash.com/photo-1607958996333-41aef7caefaa?auto=format&fit=crop&w=400&q=80', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(4, 'Strawberry Cheesecake', 125000.00, 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?auto=format&fit=crop&w=400&q=80', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(5, 'Cinnamon Roll', 18000.00, 'images/1767904052.jpg', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:27:32'),
	(6, 'Whole Wheat Toast', 22000.00, 'images/1767904123.jpg', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:28:43'),
	(7, 'Almond Croissant', 28000.00, 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=400&q=80', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(8, 'Red Velvet Cake', 150000.00, 'https://images.unsplash.com/photo-1616541823729-00fe0aacd32c?auto=format&fit=crop&w=400&q=80', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(9, 'Matcha Cookie', 12000.00, 'images/1767904133.jpg', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:28:53'),
	(10, 'Sausage Roll', 32000.00, 'images/1767904155.jpg', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:29:15'),
	(11, 'Blueberry Danish', 26000.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=400&q=80', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(12, 'Rainbow Bagel', 20000.00, 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Bagel-Plain-Alt.jpg/640px-Bagel-Plain-Alt.jpg', 100, 1, '2026-01-08 13:16:50', '2026-01-08 13:16:50');

-- Dumping structure for table project_bwp.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.roles: ~0 rows (approximately)

-- Dumping structure for table project_bwp.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('TTrpbfPKEaWamkVZnUavOg0OQWpt6htXS5317mMS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNFZOQm9LTUpEbWNtc05DeHdQSmlldGljNTRqWXpkME1QTG5hUERUZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnQiO3M6NToicm91dGUiO3M6MTI6ImFkbWluLnJlcG9ydCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1767908645);

-- Dumping structure for table project_bwp.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_price` int NOT NULL,
  `transaction_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.transactions: ~16 rows (approximately)
INSERT INTO `transactions` (`id`, `user_id`, `total_price`, `transaction_date`, `created_at`, `updated_at`) VALUES
	(1, 3, 328000, '2026-01-04 20:16:50', '2026-01-04 13:16:50', '2026-01-08 13:16:50'),
	(2, 3, 150000, '2025-12-17 20:16:50', '2025-12-17 13:16:50', '2026-01-08 13:16:50'),
	(3, 3, 189000, '2025-12-14 20:16:50', '2025-12-14 13:16:50', '2026-01-08 13:16:50'),
	(4, 3, 102000, '2026-01-04 20:16:50', '2026-01-04 13:16:50', '2026-01-08 13:16:50'),
	(5, 3, 300000, '2025-12-31 20:16:50', '2025-12-31 13:16:50', '2026-01-08 13:16:50'),
	(6, 3, 28000, '2025-12-24 20:16:50', '2025-12-24 13:16:50', '2026-01-08 13:16:50'),
	(7, 3, 22000, '2025-12-10 20:16:50', '2025-12-10 13:16:50', '2026-01-08 13:16:50'),
	(8, 3, 101000, '2026-01-02 20:16:50', '2026-01-02 13:16:50', '2026-01-08 13:16:50'),
	(9, 3, 20000, '2025-12-20 20:16:50', '2025-12-20 13:16:50', '2026-01-08 13:16:50'),
	(10, 3, 324000, '2025-12-21 20:16:50', '2025-12-21 13:16:50', '2026-01-08 13:16:50'),
	(11, 3, 220000, '2025-12-21 20:16:50', '2025-12-21 13:16:50', '2026-01-08 13:16:50'),
	(12, 3, 36000, '2025-12-24 20:16:50', '2025-12-24 13:16:50', '2026-01-08 13:16:50'),
	(13, 3, 61000, '2025-12-25 20:16:50', '2025-12-25 13:16:50', '2026-01-08 13:16:50'),
	(14, 3, 62000, '2025-12-19 20:16:50', '2025-12-19 13:16:50', '2026-01-08 13:16:50'),
	(15, 3, 318000, '2025-12-18 20:16:50', '2025-12-18 13:16:50', '2026-01-08 13:16:50'),
	(16, 4, 150000, '2026-01-08 21:43:39', '2026-01-08 14:43:39', '2026-01-08 14:43:39');

-- Dumping structure for table project_bwp.transaction_details
CREATE TABLE IF NOT EXISTS `transaction_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_details_product_id_foreign` (`product_id`),
  CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.transaction_details: ~28 rows (approximately)
INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 2, 25000, '2026-01-04 13:16:50', '2026-01-04 13:16:50'),
	(2, 1, 7, 1, 28000, '2026-01-04 13:16:50', '2026-01-04 13:16:50'),
	(3, 1, 4, 2, 125000, '2026-01-04 13:16:50', '2026-01-04 13:16:50'),
	(4, 2, 8, 1, 150000, '2025-12-17 13:16:50', '2025-12-17 13:16:50'),
	(5, 3, 10, 2, 32000, '2025-12-14 13:16:50', '2025-12-14 13:16:50'),
	(6, 3, 4, 1, 125000, '2025-12-14 13:16:50', '2025-12-14 13:16:50'),
	(7, 4, 10, 1, 32000, '2026-01-04 13:16:50', '2026-01-04 13:16:50'),
	(8, 4, 1, 2, 35000, '2026-01-04 13:16:50', '2026-01-04 13:16:50'),
	(9, 5, 8, 2, 150000, '2025-12-31 13:16:50', '2025-12-31 13:16:50'),
	(10, 6, 7, 1, 28000, '2025-12-24 13:16:50', '2025-12-24 13:16:50'),
	(11, 7, 6, 1, 22000, '2025-12-10 13:16:50', '2025-12-10 13:16:50'),
	(12, 8, 11, 1, 26000, '2026-01-02 13:16:50', '2026-01-02 13:16:50'),
	(13, 8, 12, 2, 20000, '2026-01-02 13:16:50', '2026-01-02 13:16:50'),
	(14, 8, 1, 1, 35000, '2026-01-02 13:16:50', '2026-01-02 13:16:50'),
	(15, 9, 12, 1, 20000, '2025-12-20 13:16:50', '2025-12-20 13:16:50'),
	(16, 10, 8, 2, 150000, '2025-12-21 13:16:50', '2025-12-21 13:16:50'),
	(17, 10, 9, 2, 12000, '2025-12-21 13:16:50', '2025-12-21 13:16:50'),
	(18, 11, 8, 1, 150000, '2025-12-21 13:16:50', '2025-12-21 13:16:50'),
	(19, 11, 1, 2, 35000, '2025-12-21 13:16:50', '2025-12-21 13:16:50'),
	(20, 12, 5, 2, 18000, '2025-12-24 13:16:50', '2025-12-24 13:16:50'),
	(21, 13, 5, 2, 18000, '2025-12-25 13:16:50', '2025-12-25 13:16:50'),
	(22, 13, 3, 1, 25000, '2025-12-25 13:16:50', '2025-12-25 13:16:50'),
	(23, 14, 9, 1, 12000, '2025-12-19 13:16:50', '2025-12-19 13:16:50'),
	(24, 14, 3, 2, 25000, '2025-12-19 13:16:50', '2025-12-19 13:16:50'),
	(25, 15, 5, 1, 18000, '2025-12-18 13:16:50', '2025-12-18 13:16:50'),
	(26, 15, 8, 2, 150000, '2025-12-18 13:16:50', '2025-12-18 13:16:50'),
	(27, 16, 3, 1, 25000, '2026-01-08 14:43:39', '2026-01-08 14:43:39'),
	(28, 16, 4, 1, 125000, '2026-01-08 14:43:39', '2026-01-08 14:43:39');

-- Dumping structure for table project_bwp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Boss', 'admin@bwp.com', NULL, '$2y$12$iwGpUDL7groQJRpNpOAjA.PrkwWFU3xykCqzXCG2/FVRJ.0wzWZbK', 1, NULL, '2026-01-08 13:16:49', '2026-01-08 13:16:49'),
	(2, 'Bakery Admin', 'bakery@bwp.com', NULL, '$2y$12$Ck/..r3.ALwSjH21a/blRORloafUS4USqBQk4qgAyggLvgztkh/IG', 1, NULL, '2026-01-08 13:16:49', '2026-01-08 13:16:49'),
	(3, 'John Doe', 'customer@gmail.com', NULL, '$2y$12$FNrl/ph0vT9kJE77/UcY7e1iM/q//0d1xqcCCJpo2i.FrgINcHJNu', 0, NULL, '2026-01-08 13:16:50', '2026-01-08 13:16:50'),
	(4, 'Monica', 'ere@gmail.com', NULL, '$2y$12$/4SLNoqP7X8Qh15.GWPhBO5HCLeuEjgkq5HXFP4CfIYcJOG7YR//K', 0, NULL, '2026-01-08 14:43:24', '2026-01-08 14:43:24');

-- Dumping structure for table project_bwp.vouchers
CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` int NOT NULL,
  `min_purchase` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vouchers_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_bwp.vouchers: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
