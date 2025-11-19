-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 01:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriculture_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'ketan', 'ketan');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Organic Fertilizer'),
(5, 'Gardening Plants'),
(16, 'Machines'),
(18, 'Seeds'),
(19, 'Farming Tools');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `reply`, `created_at`, `replied_at`) VALUES
(1, 'vishnu yashwant kubal', 'ketan5@gmail.com', 'hello admin', NULL, '2025-03-12 15:23:23', NULL),
(2, 'ketan kubal', 'ketankubal8@gmail.com', 'heelloo', 'hiee ketan', '2025-03-12 15:39:05', '2025-03-12 15:39:29'),
(3, 'vishnu yashwant kubal', 'ketankubal9@gmail.com', 'heeloo', 'hi', '2025-03-12 15:42:01', '2025-03-12 15:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'UPI',
  `payment_status` enum('Pending','Paid','Failed') DEFAULT 'Pending',
  `order_status` enum('Processing','Shipped','Delivered','Cancelled') DEFAULT 'Processing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_charges` decimal(10,2) NOT NULL DEFAULT 50.00,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `payment_method`, `payment_status`, `order_status`, `created_at`, `address`, `phone`, `full_name`, `email`, `order_date`, `delivery_charges`, `delivery_charge`) VALUES
(1, 23, 160.00, 'COD', 'Pending', 'Delivered', '2025-03-10 17:10:25', 'kubalwadi maneri', '9657109068', 'soham kubal', 'soham1@gmail.com', '2025-03-11 17:23:44', 50.00, 0.00),
(2, 23, 2499.00, 'COD', 'Pending', 'Shipped', '2025-03-10 17:12:34', 'kubalwadi maneri', '9087654534', 'soham kubal', 'soham@gmail.com', '2025-03-11 17:23:44', 50.00, 0.00),
(11, 26, 399.00, 'COD', 'Pending', 'Cancelled', '2025-03-13 04:32:03', 'goa', '9405294715', 'ketan kubal', 'ketankubal8@gmail.com', '2025-03-13 04:32:03', 50.00, 0.00),
(12, 27, 399.00, 'COD', 'Pending', 'Shipped', '2025-03-13 06:10:54', 'banda-Tamboli', '1234567890', 'shivram sawant', 'chinmay@gmail.com', '2025-03-13 06:10:54', 50.00, 0.00),
(13, 26, 250.00, 'COD', 'Pending', 'Processing', '2025-03-14 05:37:46', 'At post Maneri kubalwadi Tal-dodamarg', '9657109068', 'ketan vishnu kubal', 'ketankubal8@gmail.com', '2025-03-14 05:37:46', 50.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`) VALUES
(9, 12, 9, 1, 349.00, 349.00),
(10, 13, 16, 2, 100.00, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock`, `image`, `category`, `created_at`, `status`) VALUES
(8, 'Coconut Peat', '100% organic and made from renewable sources\r\nBio-degradable\r\nImproves aeration\r\nReduces frequency of irrigation\r\nStrong and healthy root system', 300.00, 6, 'coconut_peat.jpg', 'Organic Fertilizer', '2025-03-12 05:32:10', 'active'),
(9, 'Mango Picker', 'Hectare Lightweight Mango Fruit Picker/Harvester with 4 Replaceable Sharp Blade| Cotton net| Fruit Harvester, Composite Material | Without Pole', 349.00, 4, 'mango_picker.jpg', 'Farming Tools', '2025-03-12 07:24:37', 'active'),
(10, 'Bone Meal', 'Our Bone Meal Fertilizer is a natural and organic plant nutrient made from ground animal bones. It\'s a rich source of phosphorus, nitrogen, and other essential micronutrients that promote healthy plant growth.', 500.00, 18, 'bone_meal.jpg', 'Organic Fertilizer', '2025-03-13 06:15:45', 'active'),
(11, 'Basil', 'Rich in phosphorus, nitrogen, and micronutrients, our bone meal fertilizer promotes healthy plant growth, improves soil structure, and increases crop yields. OMRI listed for organic gardening.\r\n\r\n## Key Benefits:\r\n- Natural and organic\r\n- Rich in phosphorus and nitrogen\r\n- Improves soil structure', 150.00, 9, 'basil.jpg', 'Gardening Plants', '2025-03-13 06:17:14', 'active'),
(12, 'Electric Lawn Mower - 20-Inch Cutting Width', 'Maintain a lush and manicured lawn with our electric lawnmower. This eco-friendly and budget-conscious option features a powerful 12-amp motor, 20-inch cutting width, and adjustable handle height.\r\n\r\n## Key Features:\r\n- Easy to Use: Lightweight design and adjustable handle height make it easy to maneuver and control.\r\n- Efficient Cutting: 20-inch cutting width and powerful 12-amp motor ensure a quick and even cut.\r\n- Environmentally Friendly: Electric power eliminates emissions and reduces noise pollution.\r\n- Space-Saving: Compact design and foldable handle make it easy to store.', 7089.00, 3, 'lawnmower.jpg', 'Machines', '2025-03-13 06:19:37', 'active'),
(13, 'Insecticide Spray for Home and Garden', 'Protect your large spaces from pests with our industrial-grade insecticide spray. This powerful formula kills ants, roaches, spiders, and other unwanted insects on contact.\r\n\r\n## Key Features:\r\n- High-capacity spray: 1 gallon (3.8 L) bottle for large spaces\r\n- Fast-acting formula: Quickly kills insects on contact\r\n- Long-lasting protection: Provides up to 4 weeks of protection against pests\r\n- Easy to use: Simple spray application makes it easy to target pests', 4500.00, 10, 'pesticide.jpg', 'Farming Tools', '2025-03-13 06:22:49', 'active'),
(14, 'Electric Lawn Mower - 20-Inch Cutting Width', 'Maintain a lush and manicured lawn with our electric lawnmower. This eco-friendly and budget-conscious option features a powerful 12-amp motor, 20-inch cutting width, and adjustable handle height.\r\n\r\n## Key Features:\r\n- Easy to Use: Lightweight design and adjustable handle height make it easy to maneuver and control.\r\n- Efficient Cutting: 20-inch cutting width and powerful 12-amp motor ensure a quick and even cut.\r\n- Environmentally Friendly: Electric power eliminates emissions and reduces noise pollution.\r\n- Space-Saving: Compact design and foldable handle make it easy to store.', 7099.00, 3, 'lawnmower.jpg', 'Machines', '2025-03-13 06:24:52', 'active'),
(15, 'Hybrid Tomato Seeds - High-Yielding and Disease-Resistant', 'Grow delicious and juicy tomatoes in your garden with our hybrid tomato seeds. These high-yielding seeds are disease-resistant and produce large, red fruits.\r\n\r\n1 packet (20 seeds)', 50.00, 17, 'tomato_seeds.jpg', 'Seeds', '2025-03-13 06:27:12', 'active'),
(16, 'Alo vera  (Medium bottle)', 'Aloe vera is a wonderful plant with many benefits. Here are some of its uses:\r\n\r\n## Health Benefits:\r\n- Soothes skin irritations and burns\r\n- Hydrates and moisturizes the skin\r\n## Hair and Skin Care:\r\n- Promotes healthy hair growth\r\n- Reduces dandruff and itchiness', 100.00, 5, 'Aloe-01.jpg', 'Gardening Plants', '2025-03-13 06:39:11', 'active'),
(17, 'crowbar', 'A crowbar is a versatile hand tool used for various tasks such as prying, lifting, and bending. It typically consists of a sturdy metal bar with a curved or angled end, allowing for effective leverage and control.', 70.00, 2, 'crow_bar.jpg', 'Farming Tools', '2025-03-13 06:49:32', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `profile_image` varchar(255) DEFAULT 'images/default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `address`, `password`, `created_at`, `role`, `profile_image`) VALUES
(4, 'sohail', 'shaikh', 'baba', 'sohail123@gmail.com', '9876543210', NULL, '$2y$10$QABqGpu5xoFDIfZbMpz/TeKYTZGqCZAbMAd6/jw13v3R4kztI/utq', '2025-03-10 03:27:27', 'user', 'images/default-profile.png'),
(7, 'sushant', 'parab', 'sushant parab', 'sushant@gmail.com', '1234567890', 'matond', '$2y$10$uxkaTUYMcib7RYWEmnmBme/AHJIR6N3P0ldNGJYeohyi8aP/VZ6oO', '2025-03-10 07:30:09', 'user', 'images/default-profile.png'),
(8, 'bhagyashree', 'kudalkar', 'bhagu', 'bhagu@gmail.com', '9422061859', NULL, '$2y$10$zv1oJw/PvQ2xhAucGWb2/ujbeyMm7Gf6Av4hCtoLGBPzeXUbZwhG2', '2025-03-10 09:12:54', 'user', 'images/default-profile.png'),
(9, 'dipesh', 'gadekar', 'dipesh1807', 'dipeshgadekar59@gmail.com', '9142682556', NULL, '$2y$10$Kt2kWXE6mkCOHJTGSNXhze3HfOJri3VNQ6FWZk0BLCV01djNapDYy', '2025-03-10 10:10:23', 'user', 'images/default-profile.png'),
(11, 'abhi', 'redkar', 'abhi', 'abhi@gmail.com', '1243467896', NULL, '$2y$10$VSuj.R1UbQxy1QT7dI2QhuQ0g6EarRUP1/dknUiN3ub2GRNzFyEIe', '2025-03-10 10:29:14', 'user', 'images/default-profile.png'),
(24, 'ketan', 'kubal', 'ketan', 'ketankubal8@gmail.com', '9657109068', NULL, '$2y$10$tdC5iCVkCGTJW5RAHCKrAeKSVK1p38bWSvpp.GQd5uysVcao5coaK', '2025-03-12 03:48:35', 'user', 'images/default-profile.png'),
(26, 'ketan', 'kubal', 'ketan kubal', 'ketankubal9@gmail.com', '5422795649', 'At post maneri-kubalwadi Tal-Dodamarg', '$2y$10$Sb/5J7Rjx7RgeYtpdVb2WeBr2vVi9zIBL4IjZENpK7hHgIFIYlLBK', '2025-03-12 05:44:35', 'user', 'profile_26.jpg'),
(27, 'shivram', 'sawant', 'chinmay', 'chinmay@gmail.com', '9087654523', 'banda ', '$2y$10$V5FLPj5Dpv9HkcD5SrwtVOdVnPnCDE98T.MtFdluEA6E.dtDK4XkW', '2025-03-13 06:06:20', 'user', 'profile_27.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
