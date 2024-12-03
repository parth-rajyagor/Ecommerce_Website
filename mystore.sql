-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 12:52 PM
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
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_username`, `admin_email`, `admin_password`, `date`) VALUES
(1, 'test_admin1', 'test_admin1@gmail.com', '$2y$10$ZwLnGvTLVzH257B0O1f1l.Oh7GigBXSmuNLO//ZJvCxRQJeqCgjIi', '2024-11-26 11:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Amazon'),
(2, 'Flipkart'),
(3, 'Ajio'),
(4, 'Swiggy'),
(5, 'Blinkit'),
(6, 'Zomato');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, '  Fruits'),
(2, 'Vegetables'),
(3, 'Shoes'),
(4, 'Clothes'),
(5, 'Googles'),
(6, 'Chocolates'),
(7, 'Kids'),
(8, 'Adults');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 1, 1279571912, 1, 10, 'pending'),
(2, 1, 1045972099, 9, 2, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keyword`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'Fresh Mango', 'A mango is an edible stone fruit produced by the tropical tree Mangifera indica.', 'Mango, Mangoes, Fruits, Fruit, Yellow Mango, Green Mango, Blinkit', 1, 5, 'mangoes1.jpg', 'mangoes2.jpg', 'mangoes3.jpg', 500, '2024-11-25 08:17:51', 'true'),
(2, 'Fresh Apple', 'Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus.', 'Apple, Apples, Red Apples, Green Apples,Red Apple, Green Apple, Fruit, Fruits, Blinkit', 1, 5, 'apple1.jpg', 'apple2.jpg', 'apple3.jpg', 200, '2024-11-25 08:15:19', 'true'),
(3, 'Frocks', 'It is simply another name for a dress commonly used in UK.', 'Fock, Frocks, Blue Frocks, Red Frocks, Multicolour Frocks, Blue Frock, Red Frock, Multicolour Frock, Dress, Womens Wear, Clothes, Amazon', 4, 1, 'frock1.jpg', 'frock2.jpg', 'frock3.jpg', 500, '2024-11-25 07:24:50', 'true'),
(4, 'Capsicum', 'Capsicum, paprika, chili pepper, red pepper, sweet pepper, jalapeño, cayenne, bell pepper', 'Capsicum, paprika, chili pepper, red pepper, sweet pepper, jalapeño, cayenne, bell pepper, Red Capsicum, Green Capsicum, Yellow Capsicum, Vegetable, Blinkit', 2, 5, 'capsicum1.jpg', 'capsicum2.jpg', 'capsicum3.jpg', 100, '2024-11-25 08:13:24', 'true'),
(5, 'Dairy Milk', 'These chocolates offer versatility and can be paired with different foods to enhance their taste.', 'Dairy Milk, Chocolate, Chocolates, Swiggy', 6, 4, 'dairymilk1.jpg', 'dairymilk2.jpeg', 'dairymilk3.jpeg', 300, '2024-11-25 07:32:56', 'true'),
(6, 'Five Star Chocolate', 'Customers like the quality, taste, and value of the chocolate candy.', 'Five Star, 5 star, Chocolate, Chocolates, Swiggy', 6, 4, 'fivestar1.jpg', 'fivestar2.jpg', 'fivestar3.jpg', 250, '2024-11-25 07:34:51', 'true'),
(7, 'Goggles', 'Goggles for men and women available in all the classic styles.', 'Goggles for men, Goggles for women, Goggles, Fashion, Flipkart', 5, 2, 'goggles1.jpg', 'goggles2.jpg', 'goggles3.jpg', 400, '2024-11-25 08:16:44', 'true'),
(8, 'Guava', 'Guava is a common tropical fruit cultivated in many tropical and subtropical regions.', 'Guava, Fruit, Fruits, Red Guava, Green Guava, Blinkit', 1, 5, 'Guava1.jpg', 'Guava2.jpg', 'Guava3.jpg', 300, '2024-11-25 07:39:52', 'true'),
(9, 'Jeans', 'Jeans - Buy Jeans for men, women & kids online in India', 'Jeans, Blue Jeans, Black Jeans, Jeans for men, Jeans for women, Fashion, Clothes, Flipkart', 4, 2, 'jeans1.jpg', 'jeans2.jpg', 'jeans3.jpg', 800, '2024-11-25 07:44:52', 'true'),
(10, 'Orange', 'The orange, also called sweet orange to distinguish it from the bitter orange.', 'Orange, Fruit, Fruits, Blinkit', 1, 5, 'orange1.jpg', 'orange2.jpg', 'orange3.jpg', 140, '2024-11-25 07:47:17', 'true'),
(11, 'Shoes', 'All styles, colours & latest collections of Mens Shoes available', 'Shoe, Shoes, Fashion, Amazon, Shoes for Men, Adidas, Nike, Puma', 3, 1, 'shoes1.jpg', 'shoes2.jpg', 'shoes3.jpg', 1200, '2024-11-25 07:50:40', 'true'),
(12, 'Swimming Goggles', 'Premium Big Frame Competition Swim Goggles with UV and Anti Fog Protection for Adult.', 'Swimming Goggles, Swimming Glasses, Swimming, Flipkart', 5, 2, 'swimming_goggles1.jpg', 'swimming_goggles2.jpg', 'swimming_goggles3.jpg', 300, '2024-11-25 08:19:06', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 5000, 1279571912, 1, '2024-11-26 07:34:09', 'pending'),
(2, 1, 1600, 1045972099, 1, '2024-11-26 07:38:38', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount_due` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount_due`, `payment_mode`, `date`) VALUES
(1, 1, 765118317, 40000, 'UPI', '2024-11-25 11:56:47'),
(2, 1, 1255986372, 2400, 'UPI', '2024-11-26 07:05:02'),
(3, 2, 1045972099, 1600, 'Cash On Delivery', '2024-11-26 07:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`, `date`) VALUES
(1, 'testname1', 'testemail1@gmail.com', '$2y$10$Y5/miv9xCEW/5wkCCd294Op0IqRZ1PE5Ccj4VlLzTsCWYvfVCbzme', 'user_image1.jpg', '::1', 'testaddress1', '0000000000', '2024-11-25 09:38:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
