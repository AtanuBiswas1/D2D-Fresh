-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(89, 48, 29, 'lichi   500gm', 80, 1, 'lichi.png'),
(90, 48, 25, 'apple   1kg', 100, 1, 'apple.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `payment_status` varchar(20) NOT NULL DEFAULT 'completed',
  `orderstatus` varchar(20) NOT NULL DEFAULT 'pending',
  `assign_dboy` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `orderstatus`, `assign_dboy`) VALUES
(6, 48, 'Atanu Biswas', '9735461620', 'atanubiswas671@gmail.com', 'cash on delivery', 'flat no. Abash Abash Medinipore West Bengal India - 721102', ', apple   1kg ( 1 )', 100, '20-Jun-2024', 'completed', 'completed', 42),
(7, 48, 'Atanu Biswas', '9735461620', 'atanubiswas671@gmail.com', 'cash on delivery', 'flat no. Abash Abash Medinipore West Bengal India - 721102', ', ilish ( 1 )', 600, '20-Jun-2024', 'completed', 'completed', 42);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(24, 'Ilish (1kg )', 'fish', ' It is a very popular and sought-after food fish in the Indian subcontinent, and is the national fish of Bangladesh and the state fish of West Bengal', 1000, 'oily fishes.png'),
(25, 'Apple   (1kg)', 'fruits', 'This nutritious fruit offers multiple health benefits. Apples may lower your chance of developing cancer, diabetes, and heart disease.', 180, 'apple.png'),
(26, 'Banana  ( 1kg )', 'fruits', 'Bananas are fresh, versatile, and relatively inexpensive fruits. They’re packed with essential nutrients and may benefit weight loss, digestion, and heart health.', 60, 'banana.png'),
(27, 'Blue grapes  ( 1kg )', 'fruits', 'Grapes offer health benefits, primarily due to their high nutrient and antioxidant content. They may benefit the eye, heart, bones, and more.', 120, 'blue grapes.png'),
(28, 'Green grapes  (   1kg )', 'fruits', 'A mutation in green grapes prevents the production of anthocyanin, though, which decreases the levels of antioxidants in green grapes,', 100, 'green grapes.png'),
(29, 'Lychee  (  500gm )', 'fruits', 'Lychee or litchi fruits are a popular natural bounty in tropical regions, that not only render a delicious flavour to numerous pastries and desserts but also confer a plethora of health benefits.', 100, 'lichi.png'),
(30, 'orange     500gm', 'fruits', 'Many types of oranges are high in fiber and beneficial vitamins, like vitamin C. They also contain antioxidants which can have various health benefits, including supporting immune function.', 100, 'orange.png'),
(31, 'watermelon  1kg', 'fruits', 'Watermelon is around 90% water, which makes it useful for staying hydrated in the summer. It can also satisfy a sweet tooth with its natural sugars.', 40, 'th.jfif'),
(33, 'Papaya     1kg', 'fruits', 'These yellow color fruits are famous in India, for their taste and health benefits. They are also good for the digestive system.', 40, 'th (1).jfif'),
(34, 'Pineapple     1 kg', 'fruits', 'Pineapple juice makes for the most refreshing summer drinks in India. You can find it very easily anywhere. It has incredible taste and is loved by everyone.', 100, 'th (2).jfif'),
(35, 'Gooseberry  1kg', 'fruits', 'Gooseberry is another amazing summer fruit that can help you stay cool in hot Indian summers.', 60, 'th (3).jfif'),
(36, 'Fig    500gm', 'fruits', 'Fig is a delicious fruit that is grown in India during hot summers. Although a minor fruit in India, it is available throughout the year in dried form.', 35, 'th (4).jfif'),
(37, 'Pear   500gm', 'fruits', 'This fruit is mildly sweet, with many essential nutrients. Despite being highly nutritional, it has a really low-calorie count and can help you with weight loss as well.', 45, 'th (5).jfif'),
(38, 'Musk Melon   1p', 'fruits', 'Musk Melon consists of almost 90% water content, and that makes it a good choice for eating in summers. As it can keep you hydrated when the temperatures are soaring high.', 60, 'th (6).jfif'),
(40, 'Broccoli     1 pc', 'vegitables', 'Broccoli contains many vitamins, minerals, fiber, and antioxidants. Broccoli’s benefits include helping reduce inflammation, keeping blood sugar stable, and strengthening the immune system.', 42, 'broccoli.png'),
(41, 'capsicum   500gm', 'vegitables', 'Using whole chili peppers from theCapsicum genus may provide nutritional value, including the possibility of high amounts of vitamin C and vitamin A.', 65, 'capsicum.png'),
(42, 'cauliflower   1p', 'vegitables', 'Cauliflower is a great source of antioxidants, which protect your cells from harmful free radicals and inflammation', 40, 'cauliflower.png'),
(43, 'cabbage 1p', 'vegitables', 'Cabbage is a leafy green, red (purple), or white (pale green) biennial plant grown as an annual vegetable crop for its dense-leaved heads', 35, 'cabbage.png'),
(44, 'carrot  1kg', 'vegitables', 'Carrots contain many nutrients, including beta carotene and antioxidants, that may support your overall health as part of a nutrient-rich diet.', 25, 'carrot.png'),
(45, 'Beat   500gm', 'vegitables', 'Beets are particularly rich in folate, a vitamin that plays a key role in growth, development, and heart health', 23, 'beetroot.png'),
(46, 'Ginger   250gm', 'vegitables', 'Ginger is high in gingerol, a substance with potent anti-inflammatory and antioxidant properties.', 60, 'ginger_.jpg'),
(47, 'Garlic  100gm', 'vegitables', 'Garlic grows in many parts of the world and is a popular ingredient in cooking due to its strong smell and delicious taste.', 30, 'th (9).jfif'),
(48, 'Red Papper   100gm', 'vegitables', 'Providing antioxidants like phytonutrients and vitamin C that may prevent some types of cancer', 20, 'red papper.png'),
(49, 'onion   1kg ', 'vegitables', 'Antioxidants are compounds that inhibit oxidation, a process that may lead to cellular damage and contribute to diseases such as cancer, diabetes, and heart disease', 40, 'th (10).jfif'),
(50, 'semon fish   1kh', 'fish', 'test is very good', 500, 'semon fish.png'),
(51, 'chicken leg        10pieces', 'meat', '.....', 250, 'chicken.jpg'),
(52, 'chicken   1kg', 'meat', '.', 150, 'th (15).jfif'),
(53, 'karaknath chicken   1kg', 'meat', '.', 300, 'th (16).jfif'),
(54, 'fanta  1 let', 'soft drinks', '.', 50, 'fanta.jpeg'),
(55, 'Potato    1kg', 'vegitables', '.', 20, 'potato.jpg'),
(56, 'chicken leg     10pieces', 'meat', '.', 1000, 'chicken leg.jpg'),
(57, 'chicken wings   10 pic', 'meat', '.', 200, 'chicken-wings.jpg'),
(58, '7 up    2l', 'soft drinks', '.', 100, '7up.png'),
(59, 'sprite 2l', 'soft drinks', '.', 90, 'sprite.jpg'),
(60, 'Limca  2L', 'soft drinks', '.', 100, 'limca-soft-drink.jpg'),
(61, 'mazza  1.2L', 'soft drinks', '.', 100, 'maaza.jpg'),
(62, 'ORSL  200ml', 'soft drinks', '.', 30, 'ORSL-PLUS-Orange-Drink.png'),
(63, 'ORSL 200ml', 'soft drinks', '.', 30, 'orsl lemon.png'),
(64, 'ORSL      200ml', 'soft drinks', '.', 30, 'orsl-apple-electrolyte-drink.png'),
(65, 'guava   1kg', 'fruits', '.', 60, 'guava.png'),
(66, 'basmati rice   1kg', 'grocery', '.', 120, 'basmati-rice-90.png'),
(67, 'daawat-basmati-rice-rozana-gold   1kg', 'grocery', '.', 180, 'daawat-basmati-rice-rozana-gold.png'),
(69, 'kabuli   chana    500gm', 'grocery', '.', 60, 'kabuli-chana1.png'),
(70, 'kabuli chana     1kg', 'grocery', '.', 110, 'kabuli-chana.png'),
(71, 'black rice    1kg', 'grocery', '.', 138, 'black-rice-.png'),
(72, 'organic india black rice  1kg', 'grocery', '.', 150, 'organic-india-black-rice-.png'),
(73, 'kala chana   1kg', 'grocery', '.', 107, 'kala-chana.png'),
(74, 'Masoor dal   ( 1 kg )', 'grocery', 'Masoor Dal, known as Lentil in English, is one of the most ancient legume crops. It has high nutritional value as it is a rich source of protein, fiber and minerals and has low-fat content. Masoor Dal is beneficial for the skin as it keeps the skin moisturized and healthy due to the presence of vitamin B.', 111, 'masoor-dal-whole.png'),
(75, 'Mutton  (1 kg) ', 'meat', 'Fresh Mutton', 750, 'mutton.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL,
  `pincode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`, `pincode`) VALUES
(31, 'PRATIK', 'pratikkalya2017@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'user.png', NULL),
(41, 'Delivery Boy 1', 'deliveryboy1@gmail.com', 'f79ee704489986499796cf02b291a3dc', 'dboy', 'picture.png', NULL),
(42, 'Delivery Boy 2', 'deliveryboy2@gmail.com', '173013bfdf93eea0fc4d193b89d912fa', 'dboy', 'picture.png', NULL),
(43, 'Delivery Boy 3', 'deliveryboy3@gmail.com', 'c4952c5621b879776311390374c7865e', 'dboy', 'picture.png', NULL),
(45, 'ADMIN 2', 'admin2@gmail.com', 'a43c27c2babefd68df8a694900f30a1c', 'admin', 'picture.png', NULL),
(46, 'ADMIN 1', 'admin1@gmail.com', 'a43c27c2babefd68df8a694900f30a1c', 'admin', 'picture.png', NULL),
(47, 'Delivery Boy 4', 'deliveryboy4@gmail.com', '5ab23916894e337fda9d862654d4369b', 'dboy', '1.jpg', NULL),
(48, 'Atanu Biswas', 'atanu6273@gmail.com', 'c5655343f8ffe53ceae33b54925581f4', 'user', 'profile-pic.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(56, 48, 25, 'Apple   (1kg)', 180, 'apple.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
