-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2022 at 08:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `cart_product_id` int(11) NOT NULL,
  `cart_product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_product_quantity` int(11) DEFAULT NULL,
  `cart_order_id` int(11) DEFAULT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enable',
  `category_delete` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_details`, `category_status`, `category_delete`, `created_at`, `updated_at`) VALUES
(1, 'Mens', 'No Need', 'Enable', 1, NULL, NULL),
(2, 'Womens', 'no', 'Enable', 1, NULL, NULL),
(3, 'Baby', 'No', 'Enable', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `point_use` int(11) NOT NULL DEFAULT 0,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Processing',
  `delevered_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `customer_id`, `customer_name`, `customer_email`, `customer_phone`, `total_price`, `point_use`, `payment_status`, `payment_method`, `customer_address1`, `customer_address2`, `order_status`, `delevered_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, 0, 1, '2', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Delevered', '2022-09-11', '2022-09-11 10:39:19', NULL),
(2, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, 0, 1, '2', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-11 10:59:35', NULL),
(3, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, 0, 1, '1', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-11 11:02:34', '2022-09-22'),
(4, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 2220, 0, 1, '1', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-11 12:17:03', '2022-09-18'),
(5, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 1128, 0, 1, '1', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Delevered', '2022-09-11', '2022-09-11 14:52:19', '2022-09-18'),
(6, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 0, 0, 1, '2', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-11 21:06:49', '2022-09-19'),
(7, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 60, 1080, 1, '2', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-11 21:12:23', '2022-09-19'),
(8, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 1116, 1056, 1, '1', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-11 21:17:10', '2022-09-19'),
(9, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 60, 1080, 1, '1', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Delevered', '2022-09-12', '2022-09-11 21:18:38', '2022-09-19'),
(10, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 400, 728, 1, '1', 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', NULL, '2022-09-13 08:00:10', '2022-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `exchanges`
--

CREATE TABLE `exchanges` (
  `exc_id` bigint(20) UNSIGNED NOT NULL,
  `exchanger_id` int(11) NOT NULL,
  `exchange_product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_product_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_product_asking_price` int(11) NOT NULL,
  `exchange_product_sell_price` int(11) DEFAULT NULL,
  `exchange_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `exchange_last_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchanges`
--

INSERT INTO `exchanges` (`exc_id`, `exchanger_id`, `exchange_product_name`, `exchange_product_details`, `exchange_product_image`, `exchange_product_asking_price`, `exchange_product_sell_price`, `exchange_method`, `exchange_status`, `created_at`, `updated_at`, `exchange_last_date`) VALUES
(2, 1, 'Phone', 'No', 'public/exchange_images/1662911619.jpg', 10000, 1500, 'Point', 'Completed', '2022-09-11 15:53:39', '2022-09-11 19:22:19', '2022-09-18'),
(3, 1, 'Phone', 'eee', 'public/exchange_images/1663055844.jpg', 1000, 500, 'Point', 'Completed', '2022-09-13 07:57:24', '2022-09-13 07:59:14', '2022-09-20');

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
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_for` int(11) NOT NULL,
  `logo_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo`, `logo_for`, `logo_status`, `created_at`, `updated_at`) VALUES
(1, 'public/logos/1663070484.jpg', 1, 'Enable', NULL, NULL),
(2, 'public/logos/1663071046.jpg', 2, 'Enable', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_03_141755_create_categories_table', 1),
(6, '2022_09_03_194801_create_subcategories_table', 1),
(7, '2022_09_03_205443_create_products_table', 1),
(8, '2022_09_04_185707_create_visitors_table', 1),
(9, '2022_09_08_161254_create_cart_table', 2),
(10, '2022_09_11_160042_create_customer_orders_table', 3),
(11, '2022_09_11_160354_create_order_products_table', 3),
(12, '2022_09_11_211221_create_exchanges_table', 4),
(13, '2022_09_13_153314_create_logos_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `pnt` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cus_id`, `name`, `email`, `phone`, `amount`, `pnt`, `address`, `address2`, `status`, `transaction_id`, `currency`) VALUES
(1, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10, NULL, 'Customer Address', '', 'Pending', '631dac14298a5', 'BDT'),
(2, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10, NULL, 'Customer Address', '', 'Pending', '631dadcd3f97f', 'BDT'),
(3, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10, NULL, 'Customer Address', '', 'Pending', '631dae6ac6fa4', 'BDT'),
(4, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10, NULL, 'Customer Address', '', 'Canceled', '631daeb286aed', 'BDT'),
(5, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 10000, NULL, 'Customer Address', '', 'Pending', '631daefd54881', 'BDT'),
(6, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 11400, NULL, 'Customer Address', '', 'Canceled', '631daf9b684fd', 'BDT'),
(7, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 11400, NULL, 'Customer Address', '', 'Pending', '631dafad99be5', 'BDT'),
(8, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 11400, NULL, 'Customer Address', '', 'Pending', '631db00819193', 'BDT'),
(9, 0, 'Customer Name', 'customer@mail.com', '8801XXXXXXXXX', 11400, NULL, 'Customer Address', '', 'Pending', '631db116a8624', 'BDT'),
(10, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, NULL, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '631dbd8c52f71', 'BDT'),
(11, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, NULL, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Pending', '631dc0085f2b7', 'BDT'),
(12, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, NULL, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Pending', '631dc02e09a4f', 'BDT'),
(13, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 11400, NULL, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '631dc0383bba2', 'BDT'),
(14, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 2220, NULL, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '631dd1b2649d2', 'BDT'),
(15, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 1128, NULL, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '631df6192c1da', 'BDT'),
(16, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 60, 1056, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '631e50477d966', 'BDT'),
(17, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 60, 1080, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '631e50a3a64da', 'BDT'),
(18, 1, 'MD. MUTASIM NAIB', 'super@gmail.com', '01724698392', 400, 728, 'Dhaka,a,a', 'Zorabari,Domar,Nilphamari', 'Processing', '6320387d7adba', 'BDT');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `o_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_product_quantity` int(11) NOT NULL,
  `order_product_price` int(11) NOT NULL,
  `order_product_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`o_id`, `order_id`, `order_product_id`, `order_product_quantity`, `order_product_price`, `order_product_size`, `order_product_color`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 5, 1200, 'M', 'red', '2022-09-11 10:39:19', NULL),
(2, 1, 3, 5, 1200, 'S', 'red', '2022-09-11 10:39:19', NULL),
(3, 2, 4, 5, 1200, 'M', 'red', '2022-09-11 10:59:35', NULL),
(4, 2, 3, 5, 1200, 'S', 'red', '2022-09-11 10:59:35', NULL),
(5, 3, 4, 5, 1200, 'M', 'red', '2022-09-11 11:02:34', NULL),
(6, 3, 3, 5, 1200, 'S', 'red', '2022-09-11 11:02:34', NULL),
(7, 4, 1, 2, 1080, 'M', 'red', '2022-09-11 12:17:03', NULL),
(8, 5, 2, 1, 1068, 'S', 'red', '2022-09-11 14:52:19', NULL),
(9, 6, 3, 1, 1068, 'S', 'red', '2022-09-11 21:06:49', NULL),
(10, 7, 1, 1, 1080, 'S', 'red', '2022-09-11 21:12:23', NULL),
(11, 8, 5, 1, 1056, 'M', 'red', '2022-09-11 21:17:10', NULL),
(12, 9, 1, 1, 1080, 'S', 'red', '2022-09-11 21:18:38', NULL),
(13, 10, 3, 1, 1068, 'S', 'red', '2022-09-13 08:00:10', NULL);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_brand` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_discount` int(11) NOT NULL,
  `product_discount_price` int(11) NOT NULL,
  `product_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enable',
  `product_delete` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `category_name`, `sub_category_id`, `sub_category_name`, `product_code`, `product_name`, `product_brand`, `product_color`, `product_size`, `product_price`, `product_quantity`, `product_discount`, `product_discount_price`, `product_details`, `product_image`, `product_status`, `product_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mens', 1, 'T-shirt', 'ssss', 'mens t-shirt', 'easy', 'red', 'S,M,L', '1200', 254, 10, 1080, '<p><b>Hello</b></p>', 'public/product_images/1662454043.jpg', 'Enable', 1, '2022-09-04 16:00:12', '2022-09-06 08:47:23'),
(2, 1, 'Mens', 2, 'Bags', 'ssss', 'Men Bag', 'easy', 'red', 'S,M', '1200', 255, 11, 1068, '<p>NO DETAILS</p>', 'public/product_images/1662454311.jpg', 'Enable', 1, '2022-09-06 08:51:51', NULL),
(3, 2, 'Womens', 3, 'T-shirt', 'ssss', 'Womens t-shirt', 'easy', 'red', 'S,L,XL,XXL', '1200', 254, 11, 1068, '<p>NO</p>', 'public/product_images/1662454371.jpg', 'Enable', 1, '2022-09-06 08:52:51', NULL),
(4, 2, 'Womens', 4, 'Bags', 'ssss', 'Women Bag', 'easy', 'red', 'M,L,XL', '1200', 256, 0, 0, '<p>No</p>', 'public/product_images/1662454409.jpg', 'Enable', 1, '2022-09-06 08:53:29', NULL),
(5, 3, 'Baby', 5, 'T-shirt', 'ssss', 'Baby t-shirt', 'easy', 'red', 'M,L,XL', '1200', 255, 12, 1056, '<p>No</p>', 'public/product_images/1662454442.jpg', 'Enable', 1, '2022-09-06 08:54:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enable',
  `sub_category_delete` int(11) NOT NULL DEFAULT 1 COMMENT '0=delete , 1=not delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `category_name`, `sub_category_name`, `sub_category_details`, `sub_category_status`, `sub_category_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mens', 'T-shirt', 'No', 'Enable', 1, NULL, NULL),
(2, 1, 'Mens', 'Bags', 'No', 'Enable', 1, NULL, NULL),
(3, 2, 'Womens', 'T-shirt', 'No', 'Enable', 1, NULL, NULL),
(4, 2, 'Womens', 'Bags', 'No', 'Enable', 1, NULL, NULL),
(5, 3, 'Baby', 'T-shirt', 'No', 'Enable', 1, NULL, NULL),
(6, 3, 'Baby', 'Bags', 'No', 'Enable', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` int(11) NOT NULL COMMENT 'super_admin=1 , moderator=2 , editor=3',
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enable',
  `user_delete` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `user_role`, `user_image`, `email_verified_at`, `password`, `user_status`, `user_delete`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'S', 'super@gmail.com', '01724698392', 'Dhaka', 1, 'public/user_images/1661942640.jpg', NULL, '$2y$10$x9Pydi7KiqS7FKtFT00NhOGimqhNnZA7EUKJgw1Lo2gpFKrD0KzwO', 'Enable', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visitor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_status` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enable',
  `visitor_delete` int(11) NOT NULL DEFAULT 1,
  `visitor_points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `visitor_name`, `visitor_gender`, `visitor_email`, `visitor_phone`, `visitor_address`, `visitor_password`, `visitor_status`, `visitor_delete`, `visitor_points`, `created_at`, `updated_at`) VALUES
(1, 'MD. MUTASIM NAIB', 'Male', 'super@gmail.com', '01724698392', 'Zorabari,Domar,Nilphamari', 'e10adc3949ba59abbe56e057f20f883e', 'Enable', 1, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`exc_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `exc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `o_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
