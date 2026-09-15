-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2026 at 08:12 PM
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
-- Database: `cravego_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'Burgers', 'Juicy burgers, crispy fries and tasty sides.', 'burgers.jpg', '2026-09-03 16:14:03'),
(2, 'Pizza', 'Freshly baked pizzas with delicious toppings.', 'pizza.jpg', '2026-09-03 16:14:03'),
(3, 'Pakistani', 'Traditional Pakistani food full of rich flavors.', 'pakistani.jpg', '2026-09-03 16:14:03'),
(4, 'Pasta', 'Creamy and delicious pasta made with fresh ingredients.', 'pasta.jpg', '2026-09-03 16:14:03'),
(5, 'BBQ', 'Juicy grilled food, BBQ and special platters.', 'bbq.jpg', '2026-09-03 16:14:03'),
(6, 'Desserts', 'Sweet treats, cakes, ice cream and more.', 'desserts.jpg', '2026-09-03 16:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `description`, `price`, `image`, `category_id`, `restaurant_id`, `created_at`) VALUES
(1, 'Classic Beef Burger', 'Juicy beef patty with fresh lettuce, tomato and special sauce.', 850.00, 'classic-beef-burger.jpg', 1, 1, '2026-09-05 12:07:21'),
(2, 'Crispy Chicken Burger', 'Crispy chicken fillet with lettuce, cheese and creamy sauce.', 750.00, 'crispy-chicken-burger.jpg', 1, 1, '2026-09-05 12:07:21'),
(3, 'Chicken Tikka Pizza', 'Loaded with chicken tikka, cheese, onions and special herbs.', 1200.00, 'chicken-tikka-pizza.jpg', 2, 2, '2026-09-05 12:07:21'),
(4, 'Cheese Lovers Pizza', 'Extra cheesy pizza with mozzarella and delicious toppings.', 1100.00, 'cheese-lovers-pizza.jpg', 2, 2, '2026-09-05 12:07:21'),
(5, 'Chicken Biryani', 'Traditional aromatic chicken biryani served with raita.', 650.00, 'chicken-biryani.jpg', 3, 3, '2026-09-05 12:07:21'),
(6, 'Chicken Karahi', 'Rich and spicy Pakistani chicken karahi with fresh spices.', 950.00, 'chicken-karahi.jpg', 3, 3, '2026-09-05 12:07:21'),
(7, 'Creamy Alfredo Pasta', 'Creamy white sauce pasta with chicken and parmesan.', 900.00, 'creamy-alfredo-pasta.jpg', 4, 4, '2026-09-05 12:07:21'),
(8, 'Chicken Penne Pasta', 'Penne pasta with tender chicken and flavorful tomato sauce.', 850.00, 'chicken-penne-pasta.jpg', 4, 4, '2026-09-05 12:07:21'),
(9, 'BBQ Chicken Platter', 'Grilled chicken served with fries, salad and special sauce.', 1300.00, 'bbq-chicken-platter.jpg', 5, 5, '2026-09-05 12:07:21'),
(10, 'Grilled Beef Steak', 'Tender grilled beef steak served with vegetables and fries.', 1500.00, 'grilled-beef-steak.jpg', 5, 5, '2026-09-05 12:07:21'),
(11, 'Chocolate Cake', 'Rich and moist chocolate cake with creamy chocolate topping.', 450.00, 'chocolate-cake.jpg', 6, 1, '2026-09-05 12:07:21'),
(12, 'Vanilla Ice Cream', 'Smooth and creamy vanilla ice cream.', 300.00, 'vanilla-ice-cream.jpg', 6, 2, '2026-09-05 12:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Cash on Delivery',
  `order_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_email`, `phone`, `address`, `total_amount`, `payment_method`, `order_status`, `created_at`) VALUES
(2, NULL, 'Noor Fatima', 'posterprime@gmail.com', '03000000000', 'Abcd', 2600.00, 'Cash on Delivery', 'Pending', '2026-09-10 06:27:29'),
(3, 2, 'Eman Fatima', 'cravego.test01@example.com', '03000000000', 'efgh', 2250.00, 'Cash on Delivery', 'Pending', '2026-09-10 12:52:16'),
(4, 2, 'Hamna Tanveer', 'abc@gmail.com', '03111111111', 'ijkl', 1050.00, 'Cash on Delivery', 'Pending', '2026-09-10 13:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `food_name`, `price`, `quantity`, `subtotal`) VALUES
(3, 2, 12, 'Vanilla Ice Cream', 300.00, 1, 300.00),
(4, 2, 6, 'Chicken Karahi', 950.00, 1, 950.00),
(5, 2, 3, 'Chicken Tikka Pizza', 1200.00, 1, 1200.00),
(6, 3, 12, 'Vanilla Ice Cream', 300.00, 1, 300.00),
(7, 3, 8, 'Chicken Penne Pasta', 850.00, 1, 850.00),
(8, 3, 6, 'Chicken Karahi', 950.00, 1, 950.00),
(9, 4, 7, 'Creamy Alfredo Pasta', 900.00, 1, 900.00);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `address`, `phone`, `image`, `created_at`) VALUES
(1, 'Burger Hub', 'Delicious burgers, fries and refreshing drinks.', 'Main Boulevard', '0300-1111111', 'burger-hub.jpg', '2026-09-02 10:13:42'),
(2, 'Pizza Point', 'Freshly baked pizzas with a variety of toppings.', 'City Center', '0301-2222222', 'pizza-point.jpg', '2026-09-02 10:13:42'),
(3, 'Spice House', 'Traditional and spicy Pakistani food.', 'Model Town', '0302-3333333', 'spice-house.jpg', '2026-09-02 10:13:42'),
(4, 'Pasta Corner', 'Creamy and delicious pasta made with fresh ingredients.', 'Food Street', '0303-4444444', 'pasta-corner.jpg', '2026-09-02 10:13:42'),
(5, 'Grill Station', 'Juicy grilled food, BBQ and special platters.', 'Garden Road', '0304-5555555', 'grill-station.jpg', '2026-09-02 10:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Test User', 'test@example.com', '$2y$10$4r0TQqaWspoQTEQUyIhYL.16Ca0PEzpICEHEGaxZV6kxH4YYDFDD6', '2026-09-02 07:45:38'),
(2, 'Nimra Fatima', 'cravego.test01@example.com', '$2y$10$2j0HdZ7t2wsZXQf4uvLCCOVpYU5BK67FrKrkPzyb1EtmX8TV9EC0u', '2026-09-02 09:30:22'),
(3, 'Fatima tul zahra', 'abcd@gmail.com', '$2y$10$qo2gq6j/QKTJXG6Kb1cUFuKk2dVv6zbmDB1bknDZ8Pyu7N0bSuvCu', '2026-09-10 13:09:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foods_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
