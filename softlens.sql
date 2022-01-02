-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2021 pada 03.11
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softlens`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `nama_brand`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GEO', '2021-07-17 06:35:33', '2021-07-17 06:35:33', NULL),
(2, 'SAMPLE', '2021-07-17 07:52:05', '2021-07-17 07:52:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `username`, `alamat`, `no_tlp`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Agus Siswanto', 'agussiswanto', 'Sodonghilir, Tasikmalaya', '0851583323563', 'xcodeme21@gmail.com', '2021-07-17 06:38:04', '2021-07-17 06:38:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery`
--

CREATE TABLE `delivery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `delivery`
--

INSERT INTO `delivery` (`id`, `delivery`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JNE', '2021-07-17 06:38:28', '2021-07-17 06:38:28', NULL),
(2, 'J&T', '2021-07-17 07:32:42', '2021-07-17 07:32:42', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2021_06_20_091653_create_table_roles', 7),
(13, '2019_08_19_000000_create_failed_jobs_table', 8),
(14, '2021_06_15_051228_create_table_customers', 8),
(15, '2021_06_15_071341_create_table_brands', 8),
(20, '2021_06_20_100157_alter_table_users_add_field_roles', 9),
(22, '2021_06_21_025926_create_table_stock_temporary', 11),
(30, '2021_06_15_073413_create_table_size', 12),
(31, '2021_06_15_113354_create_table_products', 12),
(32, '2021_06_20_052614_create_table_stock_in', 12),
(33, '2021_06_20_094011_create_permission_tables', 12),
(34, '2021_06_20_124731_alter_table_users_add_field_deleted_at', 12),
(35, '2021_06_21_025926_create_table_stock_in_temporary', 12),
(36, '2021_06_21_025948_create_table_stock_list', 12),
(37, '2021_06_21_032940_alter_table_stock_in_temporary_add_fields_unique_code', 12),
(38, '2021_06_21_155029_create_table_source', 12),
(39, '2021_06_21_155038_create_table_delivery', 12),
(40, '2021_06_21_201046_create_table_stock_out_temporary', 12),
(41, '2021_06_21_201055_create_table_stock_out', 12),
(42, '2021_06_25_204637_create_table_orders', 13),
(43, '2021_06_25_205311_alter_table_products_add_field_harga', 13),
(44, '2021_06_25_204638_create_table_orders', 14),
(45, '2021_06_25_204639_create_table_orders', 15),
(46, '2021_06_25_204631_create_table_orders', 16),
(47, '2021_06_25_215717_alter_table_stockout_add_field_harga_produk_and_total_harga_produk', 17),
(48, '2021_06_25_215800_alter_table_stockouttempo_add_field_harga_produk_and_total_harga_produk', 17),
(49, '2021_06_25_215718_alter_table_stockout_add_field_harga_produk_and_total_harga_produk', 18),
(50, '2021_06_25_215801_alter_table_stockouttempo_add_field_harga_produk_and_total_harga_produk', 18),
(51, '2021_06_27_181622_alter_table_orders_add_field_notelp_alamat', 19),
(52, '2021_06_25_214631_create_table_orders', 20),
(53, '2021_06_27_181623_alter_table_orders_add_field_notelp_alamat', 20),
(54, '2021_06_28_081124_create_table_stock_opname', 21),
(55, '2021_06_28_081125_create_table_stock_opname', 22),
(56, '2021_06_30_185459_create_table_stock_opname_list', 23),
(57, '2021_06_30_185410_create_table_stock_opname_list', 24),
(58, '2021_07_10_193243_alter_table_users_add_field_username', 25),
(59, '2021_07_15_202826_alter_table_stock_in_add_barcode', 26),
(60, '2021_07_15_203131_alter_table_stock_in_temporary_add_barcode', 26),
(61, '2021_07_15_203219_alter_table_stock_list_add_barcode', 26),
(62, '2021_07_15_210604_alter_table_stock_in_add_file_barcode', 27),
(63, '2021_07_15_210620_alter_table_stock_in_temporary_add_file_barcode', 27),
(64, '2021_07_15_210631_alter_table_stock_list_add_file_barcode', 27),
(65, '2021_07_15_221753_alter_table_stock_out_temporary_add_barcode', 28),
(66, '2021_07_15_221759_alter_table_stock_out_add_barcode', 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `no_tlp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_id` tinyint(4) NOT NULL DEFAULT 0,
  `source_id` tinyint(4) NOT NULL DEFAULT 0,
  `harga_semua_produk` bigint(20) NOT NULL DEFAULT 0,
  `biaya_admin` bigint(20) NOT NULL DEFAULT 0,
  `diskon_voucher` bigint(20) NOT NULL DEFAULT 0,
  `total_harga` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_id`, `no_tlp`, `alamat`, `delivery_id`, `source_id`, `harga_semua_produk`, `biaya_admin`, `diskon_voucher`, `total_harga`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'QVWU5DYGOPTD1L', 1, '0851583323563', 'Sodonghilir, Tasikmalaya', 1, 1, 200000, 0, 0, 200000, 0, '2021-07-31 03:07:56', '2021-07-31 03:07:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'role-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(2, 'role-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(3, 'role-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(4, 'role-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(5, 'users-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(6, 'users-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(7, 'users-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(8, 'users-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(9, 'customers-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(10, 'customers-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(11, 'customers-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(12, 'customers-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(13, 'brands-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(14, 'brands-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(15, 'brands-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(16, 'brands-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(17, 'size-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(18, 'size-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(19, 'size-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(20, 'size-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(21, 'stock-in-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(22, 'stock-in-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(23, 'stock-in-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(24, 'stock-in-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(25, 'stock-list-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(26, 'stock-list-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(27, 'stock-list-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(28, 'stock-list-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(29, 'source-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(30, 'source-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(31, 'source-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(32, 'source-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(33, 'delivery-list', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(34, 'delivery-create', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(35, 'delivery-edit', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(36, 'delivery-delete', 'web', '2021-06-25 12:37:05', '2021-06-25 12:37:05', NULL),
(37, 'stock-out-list', 'web', '2021-06-25 16:20:46', '2021-06-25 16:20:46', NULL),
(38, 'stock-out-create', 'web', '2021-06-25 16:20:46', '2021-06-25 16:20:46', NULL),
(39, 'stock-out-edit', 'web', '2021-06-25 16:20:46', '2021-06-25 16:20:46', NULL),
(40, 'stock-out-delete', 'web', '2021-06-25 16:20:46', '2021-06-25 16:20:46', NULL),
(41, 'orders-list', 'web', '2021-06-25 16:24:08', '2021-06-25 16:24:08', NULL),
(42, 'orders-create', 'web', '2021-06-25 16:24:23', '2021-06-25 16:24:23', NULL),
(43, 'orders-edit', 'web', '2021-06-25 16:24:23', '2021-06-25 16:24:23', NULL),
(44, 'orders-delete', 'web', '2021-06-25 16:24:23', '2021-06-25 16:24:23', NULL),
(45, 'stock-opname-list', 'web', '2021-06-30 12:06:29', '2021-06-30 12:06:29', NULL),
(46, 'stock-opname-create', 'web', '2021-06-30 12:06:29', '2021-06-30 12:06:29', NULL),
(47, 'stock-opname-edit', 'web', '2021-06-30 12:06:29', '2021-06-30 12:06:29', NULL),
(48, 'stock-opname-delete', 'web', '2021-06-30 12:06:29', '2021-06-30 12:06:29', NULL),
(49, 'stock-opname-approve', 'web', '2021-07-01 11:13:21', '2021-07-01 11:13:21', NULL),
(50, 'report-stock-in-list', 'web', '2021-07-01 11:13:21', '2021-07-01 11:13:21', NULL),
(51, 'report-stock-out-list', 'web', '2021-07-01 11:13:21', '2021-07-01 11:13:21', NULL),
(52, 'report-orders-list', 'web', '2021-07-01 11:13:21', '2021-07-01 11:13:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint(20) NOT NULL DEFAULT 0,
  `brand_id` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `harga`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GEO LENSES 1', 100000, 1, '2021-07-17 06:35:50', '2021-07-17 06:35:50', NULL),
(2, 'GEO LENSES 2', 80000, 1, '2021-07-17 06:36:01', '2021-07-17 06:36:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'web', '2021-07-02 05:36:33', '2021-07-02 05:36:33', NULL),
(2, 'Sales', 'web', '2021-07-02 05:36:33', '2021-07-02 05:36:33', NULL),
(3, 'Warehouse', 'web', '2021-07-02 05:36:33', '2021-07-02 05:36:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `size`
--

CREATE TABLE `size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `size`
--

INSERT INTO `size` (`id`, `size`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Netral', '2021-07-17 06:36:19', '2021-07-17 06:36:33', NULL),
(2, '1', '2021-07-17 06:36:24', '2021-07-17 06:36:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `source`
--

CREATE TABLE `source` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `source`
--

INSERT INTO `source` (`id`, `source`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tokopedia', '2021-07-17 06:38:36', '2021-07-17 06:38:36', NULL),
(2, 'Shopee', '2021-07-17 07:32:30', '2021-07-17 07:32:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `brand_id` tinyint(4) NOT NULL,
  `size_id` tinyint(4) NOT NULL,
  `expired_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_in`
--

INSERT INTO `stock_in` (`id`, `product_id`, `brand_id`, `size_id`, `expired_date`, `total`, `barcode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '2023-07-31', 100, '202107311627700402', '2021-07-31 03:00:38', '2021-07-31 03:00:38', NULL),
(2, 1, 1, 1, '2022-04-26', 30, '202107311627700425', '2021-07-31 03:00:38', '2021-07-31 03:00:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_in_temporary`
--

CREATE TABLE `stock_in_temporary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `brand_id` tinyint(4) NOT NULL,
  `size_id` tinyint(4) NOT NULL,
  `expired_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_in_temporary`
--

INSERT INTO `stock_in_temporary` (`id`, `unique_code`, `product_id`, `brand_id`, `size_id`, `expired_date`, `total`, `barcode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2KIHDG2IONFTGP', 1, 1, 1, '2023-07-31', 100, '202107311627700402', '2021-07-31 03:00:02', '2021-07-31 03:00:38', '2021-07-31 03:00:38'),
(2, '2KIHDG2IONFTGP', 1, 1, 1, '2022-04-26', 30, '202107311627700425', '2021-07-31 03:00:25', '2021-07-31 03:00:38', '2021-07-31 03:00:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_list`
--

CREATE TABLE `stock_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `brand_id` tinyint(4) NOT NULL,
  `size_id` tinyint(4) NOT NULL,
  `expired_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_list`
--

INSERT INTO `stock_list` (`id`, `product_id`, `brand_id`, `size_id`, `expired_date`, `total`, `barcode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '2023-07-31', 98, '202107311627700402', '2021-07-31 03:00:38', '2021-07-31 03:07:56', NULL),
(2, 1, 1, 1, '2022-04-26', 30, '202107311627700425', '2021-07-31 03:00:38', '2021-07-31 03:04:00', '2021-07-31 03:04:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submitted_by` tinyint(4) NOT NULL DEFAULT 0,
  `submit_date` date NOT NULL,
  `submit_time` time NOT NULL,
  `approved_by` tinyint(4) NOT NULL DEFAULT 0,
  `approved_date` date DEFAULT NULL,
  `approved_time` time DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname_list`
--

CREATE TABLE `stock_opname_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_opname_id` int(11) NOT NULL DEFAULT 0,
  `stock_list_id` int(11) NOT NULL DEFAULT 0,
  `brand_id` tinyint(4) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `size_id` tinyint(4) NOT NULL DEFAULT 0,
  `jumlah_list` bigint(20) NOT NULL DEFAULT 0,
  `jumlah_sekarang` bigint(20) NOT NULL DEFAULT 0,
  `selisih` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_out`
--

CREATE TABLE `stock_out` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `brand_id` tinyint(4) NOT NULL,
  `size_id` tinyint(4) NOT NULL,
  `expired_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `harga_produk` bigint(20) NOT NULL DEFAULT 0,
  `total_harga_produk` bigint(20) NOT NULL DEFAULT 0,
  `delivery_id` tinyint(4) NOT NULL,
  `source_id` tinyint(4) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_out`
--

INSERT INTO `stock_out` (`id`, `order_number`, `customer_id`, `product_id`, `brand_id`, `size_id`, `expired_date`, `total`, `harga_produk`, `total_harga_produk`, `delivery_id`, `source_id`, `barcode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'QVWU5DYGOPTD1L', 1, 1, 1, 1, '2023-07-31', 2, 100000, 200000, 1, 1, '202107311627700402', '2021-07-31 03:07:56', '2021-07-31 03:07:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_out_temporary`
--

CREATE TABLE `stock_out_temporary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `brand_id` tinyint(4) NOT NULL,
  `size_id` tinyint(4) NOT NULL,
  `expired_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `harga_produk` bigint(20) NOT NULL DEFAULT 0,
  `total_harga_produk` bigint(20) NOT NULL DEFAULT 0,
  `delivery_id` tinyint(4) NOT NULL,
  `source_id` tinyint(4) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_out_temporary`
--

INSERT INTO `stock_out_temporary` (`id`, `order_number`, `customer_id`, `product_id`, `brand_id`, `size_id`, `expired_date`, `total`, `harga_produk`, `total_harga_produk`, `delivery_id`, `source_id`, `barcode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AGE4NCUJVERQ5Y', 1, 1, 1, 1, '2023-07-31', 2, 100000, 200000, 1, 1, '202107311627700402', '2021-07-31 03:04:12', '2021-07-31 03:04:12', NULL),
(2, 'QVWU5DYGOPTD1L', 1, 1, 1, 1, '2023-07-31', 2, 100000, 200000, 1, 1, '202107311627700402', '2021-07-31 03:07:52', '2021-07-31 03:07:56', '2021-07-31 03:07:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$10$OR9rJMoIig.jE8xWor5lxOa0XY3eelLkdvdLWB38dfF9DP76hwwIe', NULL, '2021-07-02 06:05:22', '2021-07-10 12:36:46', NULL),
(2, 'Sales', 'sales@gmail.com', 'sales', NULL, '$2y$10$A0v3o8gX3vRwTsviZImmt.HDn7ta5uYDerkOLDSr7R2WqOKsjU/e2', NULL, '2021-07-02 06:05:22', '2021-07-10 12:36:59', NULL),
(3, 'Warehouse', 'warehouse@gmail.com', 'warehouse', NULL, '$2y$10$sMy9y25.jj.416QUQnkNPu49ly.vby8Fpdic24An3sAw2rgbM8Hji', NULL, '2021-07-02 06:05:22', '2021-07-10 12:37:12', NULL),
(4, 'adnbajd', 'hjbhj@hjadgj', 'hjgajdbajd', NULL, '$2y$10$/PkGVNsX0CGB6twO89nkqucnwIh65XnBX9188Q7va0wkpemukkMwG', NULL, '2021-07-10 12:38:07', '2021-07-10 12:38:12', '2021-07-10 12:38:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_in_temporary`
--
ALTER TABLE `stock_in_temporary`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_opname_list`
--
ALTER TABLE `stock_opname_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_out_temporary`
--
ALTER TABLE `stock_out_temporary`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `size`
--
ALTER TABLE `size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `source`
--
ALTER TABLE `source`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stock_in_temporary`
--
ALTER TABLE `stock_in_temporary`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock_opname_list`
--
ALTER TABLE `stock_opname_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock_out_temporary`
--
ALTER TABLE `stock_out_temporary`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
