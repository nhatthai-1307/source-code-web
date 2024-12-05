-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 11:36 AM
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
-- Database: `dant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `phone`, `avatar`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Vo Dinh', 'Tu', '0962339978', NULL, 'vodinhtu28@gmail.com', '242974906Tu', '2022-11-27 05:29:57', '2022-11-27 12:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `customer_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `cart_id` int(11) DEFAULT NULL,
  `product_entity_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `base_price` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', 1, '2022-11-27 07:24:01', '2024-12-04 22:02:29'),
(2, 'Accessories', 1, '2022-11-27 08:35:44', '2024-12-04 22:02:56'),
(3, 'Heads', 1, '2022-11-27 08:37:29', '2024-12-04 22:03:22'),
(4, 'Animations', 1, '2022-12-09 03:39:50', '2024-12-04 22:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `customer_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `order_id` int(11) DEFAULT NULL,
  `product_entity_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `base_price` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `order_id` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `content_billing` text DEFAULT NULL,
  `vnpay_id` varchar(255) DEFAULT NULL,
  `bank_id` varchar(255) DEFAULT NULL,
  `time_payment` varchar(255) DEFAULT NULL,
  `result_payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(22, 'Tradable', 'Tradable', '2024-12-04 15:14:22', '2024-12-04 22:14:22'),
(23, 'Type', 'Type', '2024-12-04 15:14:22', '2024-12-04 22:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_entity`
--

CREATE TABLE `product_entity` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `decription` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_entity`
--

INSERT INTO `product_entity` (`id`, `category_id`, `name`, `decription`, `price`, `qty`, `image`, `created_at`, `updated_at`) VALUES
(20, 1, 'Black Jeans with White Shoes', 'Designed and provided to the community by TheBestKing the creator of Fresh Era Clothing. Stay fresh and be sure to check out other items made by TheBestKing in the catalog.', 0, 1000, 'upload/product/1.webp', '2024-12-04 15:14:22', '2024-12-04 22:14:22'),
(21, 1, 'ROBLOX Jacket', 'Stay stylish in the latest ROBLOX jacket.', 0, 1000, 'upload/product/2.webp', '2024-12-04 15:16:42', '2024-12-04 22:16:42'),
(22, 1, 'Wolf & Moon', 'from Wolf is Rain', 0, 1000, 'upload/product/3.webp', '2024-12-04 15:18:24', '2024-12-04 22:18:24'),
(23, 1, 'Roblox Sneakers - Gray', ' Style it up in signature black.', 0, 1000, 'upload/product/4.webp', '2024-12-04 15:19:16', '2024-12-04 22:19:16'),
(24, 2, 'Warm Pretzel Back Snacker', 'Gluten-free option in the works. * now on offer until October 15 *', 0, 1000, 'upload/product/5.webp', '2024-12-04 15:20:20', '2024-12-04 22:20:20'),
(25, 2, 'Roblox Baseball Cap', 'Powering Imagination!', 0, 1000, 'upload/product/6.webp', '2024-12-04 15:21:06', '2024-12-04 22:23:46'),
(26, 2, 'User Ads Backstage Pass', 'User Ads VIP for life', 0, 1000, 'upload/product/7.webp', '2024-12-04 15:22:29', '2024-12-04 22:24:05'),
(27, 2, 'Living Art User Ads', ' A true breakthrough in advertising technology', 0, 1000, 'upload/product/8.webp', '2024-12-04 15:23:11', '2024-12-04 22:24:13'),
(28, 3, 'Orange Beanie with Black Hair', ' She does not need a reason to love the Halloween season.', 0, 1000, 'upload/product/9.webp', '2024-12-04 15:25:17', '2024-12-04 22:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_value`
--

CREATE TABLE `product_value` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `product_entity_id` int(11) DEFAULT NULL,
  `product_attribute_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_value`
--

INSERT INTO `product_value` (`id`, `product_entity_id`, `product_attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(48, 20, 22, 'No', '2024-12-04 15:14:22', '2024-12-04 22:14:22'),
(49, 20, 23, 'Pants', '2024-12-04 15:14:22', '2024-12-04 22:14:22'),
(50, 21, 22, 'No', '2024-12-04 15:16:42', '2024-12-04 22:16:42'),
(51, 21, 23, 'Shirt', '2024-12-04 15:16:42', '2024-12-04 22:16:42'),
(52, 22, 22, 'No', '2024-12-04 15:18:24', '2024-12-04 22:18:24'),
(53, 22, 23, 'T-Shirt', '2024-12-04 15:18:24', '2024-12-04 22:18:24'),
(54, 23, 22, 'No', '2024-12-04 15:19:16', '2024-12-04 22:19:16'),
(55, 23, 23, 'Bundle', '2024-12-04 15:19:16', '2024-12-04 22:19:16'),
(56, 24, 22, 'No', '2024-12-04 15:20:20', '2024-12-04 22:20:20'),
(57, 24, 23, 'Back', '2024-12-04 15:20:20', '2024-12-04 22:20:20'),
(58, 25, 22, 'No', '2024-12-04 15:21:06', '2024-12-04 22:21:06'),
(59, 25, 23, 'Hat', '2024-12-04 15:21:06', '2024-12-04 22:21:06'),
(60, 26, 22, 'No', '2024-12-04 15:22:29', '2024-12-04 22:22:29'),
(61, 26, 23, 'Neck', '2024-12-04 15:22:29', '2024-12-04 22:22:29'),
(62, 27, 22, 'No', '2024-12-04 15:23:11', '2024-12-04 22:23:11'),
(63, 27, 23, 'Neck', '2024-12-04 15:23:11', '2024-12-04 22:23:11'),
(64, 28, 22, 'No', '2024-12-04 15:25:17', '2024-12-04 22:25:17'),
(65, 28, 23, 'Hair', '2024-12-04 15:25:17', '2024-12-04 22:25:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Customer_Cart` (`customer_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Cart_Cart_item` (`cart_id`),
  ADD KEY `FK_Product_Entity_Cart_item` (`product_entity_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Customer_Order` (`customer_id`),
  ADD KEY `FK_Cart_Order` (`cart_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Order_Order_item` (`order_id`),
  ADD KEY `FK_Product_Entity_Order_item` (`product_entity_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Payments_Order` (`order_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_entity`
--
ALTER TABLE `product_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Category_Product_entity` (`category_id`);

--
-- Indexes for table `product_value`
--
ALTER TABLE `product_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Product_Entity_Product_Value` (`product_entity_id`),
  ADD KEY `FK_Product_Attribute_Product_Value` (`product_attribute_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_entity`
--
ALTER TABLE `product_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_value`
--
ALTER TABLE `product_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_Customer_Cart` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `FK_Cart_Cart_item` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `FK_Product_Entity_Cart_item` FOREIGN KEY (`product_entity_id`) REFERENCES `product_entity` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Cart_Order` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `FK_Customer_Order` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_Order_Order_item` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `FK_Product_Entity_Order_item` FOREIGN KEY (`product_entity_id`) REFERENCES `product_entity` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_Payments_Order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product_entity`
--
ALTER TABLE `product_entity`
  ADD CONSTRAINT `FK_Category_Product_entity` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_value`
--
ALTER TABLE `product_value`
  ADD CONSTRAINT `FK_Product_Attribute_Product_Value` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`),
  ADD CONSTRAINT `FK_Product_Entity_Product_Value` FOREIGN KEY (`product_entity_id`) REFERENCES `product_entity` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
