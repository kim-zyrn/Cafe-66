-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 05:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `best_seller`
--

CREATE TABLE `best_seller` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `best_seller`
--

INSERT INTO `best_seller` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Mocha Latte', 'Hot Latte', 130, 'mocha_latte.png'),
(2, 'Caramel Latte', 'Hot Latte', 130, 'caramel_latte.png'),
(3, 'Strawberry Milk', 'Non Coffee', 125, 'strawberry_milk.png'),
(4, 'Iced Red Velvet Latte', 'Special Flavored Iced Coffee', 125, 'iced_red_velvet_latte.png'),
(5, 'Cookies & Cream', 'Premium Series', 90, 'cookies&cream.png'),
(6, 'Iced Caramel Latte', 'Iced Coffee', 105, 'iced_caramel_latte.png'),
(7, 'Okinawa', 'Classic Series', 85, 'okinawa.png'),
(8, 'Chocolate Cheesecake', 'Cheesecake Series', 100, 'chocolate_cheesecake.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `featured_products`
--

CREATE TABLE `featured_products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `featured_products`
--

INSERT INTO `featured_products` (`id`, `name`, `category`, `category_id`, `price`, `image`) VALUES
(1, 'Iced Red Velvet Latte', 'Special Flavored Iced Coffee', 'special-flavored', 125, 'iced_red_velvet_latte.png'),
(2, 'Iced Coffee Matcha', 'Special Flavored Iced Coffee', 'special-flavored', 125, 'iced_coffee_matcha.png'),
(3, 'Iced Strawberry Latte', 'Special Flavored Iced Coffee', 'special-flavored', 125, 'iced_strawberry_latte.png'),
(4, 'Iced Taro Latte', 'Special Flavored Iced Coffee', 'special-flavored', 125, 'iced_taro_latte.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `category_id`, `details`, `price`, `image`) VALUES
(1, 'Mocha Latte', 'Hot Latte', 'hot-latte', 'none', 130, 'mocha_latte.png'),
(2, 'Matcha Latte', 'Hot Latte', 'hot-latte', 'none', 130, 'matcha_latte.png'),
(3, 'Caramel Latte', 'Hot Latte', 'hot-latte', 'none', 130, 'caramel_latte.png'),
(4, 'Iced Red Velvet Latte', 'Special Flavored Iced Coffee', 'special-flavored', 'none', 125, 'iced_red_velvet_latte.png'),
(5, 'Iced Coffee Matcha', 'Special Flavored Iced Coffee', 'special-flavored', 'none', 125, 'iced_coffee_matcha.png'),
(6, 'Iced Strawberry Latte', 'Special Flavored Iced Coffee', 'special-flavored', 'none', 125, 'iced_strawberry_latte.png'),
(7, 'Iced Taro Matcha', 'Special Flavored Iced Coffee', 'special-flavored', 'none', 125, 'iced_taro_latte.png'),
(8, 'Matcha Cheesecake', 'Cheesecake Series', 'cheesecake', 'none', 100, 'matcha_cheesecake.png'),
(9, 'Rockyroad Cheesecake', 'Cheesecake Series', 'cheesecake', 'none', 100, 'rockyroad_cheesecake.png'),
(10, 'Chocolate Cheesecake', 'Cheesecake Series', 'cheesecake', 'none', 100, 'chocolate_cheesecake.png'),
(11, 'Cheesecake & Pearls', 'Cheesecake Series', 'cheesecake', 'none', 100, 'cheesecake&pearls.png'),
(12, 'Wintermelon', 'Classic Series', 'classic', 'none', 85, 'wintermelon.png'),
(13, 'Okinawa', 'Classic Series', 'classic', 'none', 85, 'okinawa.png'),
(14, 'Cookies & Cream', 'Premium Series', 'premium', 'none', 90, 'cookies&cream.png'),
(15, 'TEApsy', 'Liquor Series', 'liquor', 'none', 155, 'teapsy.png'),
(16, 'Iced Caramel Latte', 'Iced Coffee', 'iced-coffee', 'none', 105, 'iced_caramel_latte.png'),
(17, 'Label Latte', 'Alcohol x Coffee', 'alcohol-coffee', 'none', 140, 'label_latte.png'),
(18, 'Iced Matcha', 'Non Coffee', 'non-coffee', 'none', 120, 'iced_matcha.png'),
(19, 'Iced Choco', 'Non Coffee', 'non-coffee', 'none', 120, 'iced_choco.png'),
(20, 'Strawberry Milk', 'Non Coffee', 'non-coffee', 'none', 125, 'strawberry_milk.png'),
(21, 'Blue Ocean', 'Italian Soda', 'soda', 'none', 100, 'blue_ocean.png'),
(22, 'Passion Fruit', 'Italian Soda', 'soda', 'none', 100, 'passion_fruit.png'),
(23, 'Strawberry', 'Italian Soda', 'soda', 'none', 100, 'strawberry.png'),
(24, 'Lychee', 'Italian Soda', 'soda', 'none', 100, 'lychee.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`, `image`, `name`) VALUES
(59, 'kimzyrenedomino@gmail.com', '1701c5ba2b4133cc4a6626ca68e0df8c', 'admin', '308325014_489909546420081_6237688091353629097_n.jpg', 'KIM ZYRENE DOMINO'),
(60, 'kcnantiza.melitante@bicol-u.edu.ph', 'kc', 'admin', 'admin2.jpg', 'KC Melitante'),
(61, 'angelineayeng@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'id2.jpg', 'Angeline Ayeng'),
(62, 'leirafloresta@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'id1.jpg', 'Leira Me Floresta'),
(63, 'diannacenera@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'id3.JPG', 'Dianna Cenera'),
(64, 'nestlenatural@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'id4.JPG', 'Nestle Natural'),
(65, 'patrickatillo@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'id5.jpg', 'Patrick Atillo'),
(66, 'jailenasilum@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'id6.jpg', 'Jailen Escel Asilum'),
(67, 'melitantekc0917@gmail.com', '190a4568b24548e0dc8592f61f0a8cd2', 'admin', 'admin2.jpg', 'KC Melitante'),
(68, 'wosag26419@bubblybank.com', '190a4568b24548e0dc8592f61f0a8cd2', 'user', 'admin2.jpg', 'Kaycee');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `best_seller`
--
ALTER TABLE `best_seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_products`
--
ALTER TABLE `featured_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `best_seller`
--
ALTER TABLE `best_seller`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featured_products`
--
ALTER TABLE `featured_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
