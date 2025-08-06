-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 07:10 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `ath_name` varchar(255) NOT NULL,
  `ath_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `ath_name`, `ath_image`) VALUES
(3, 'Kafka ', 'uploads/authors/1731678524_Franz_kafka.jpg'),
(5, 'Virginia Woolf', 'uploads/authors/1731748471_Virginia Woolf.jpg'),
(6, 'Stephen King', 'uploads/authors/1731748483_Stephen King.jpg'),
(7, 'Albert Camus', 'uploads/authors/1731748493_Albert-Camus.jpg'),
(8, 'J. K. Rowling', 'uploads/authors/1731748504_J. K. Rowling.jpg'),
(9, 'George Orwell', 'uploads/authors/1731748516_George Orwell.jpg'),
(13, ' H. D. Carlton', '');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `cat_id`, `description`, `image`, `price`, `rating`) VALUES
(1, 'The Castle', 3, 1, 'The Castle is the last novel by Franz Kafka. In it a protagonist known only as \"K.\" arrives in a village and struggles to gain access to the mysterious authorities who govern it from a castle supposedly owned by Graf Westwest, Kafka died before he could finish the work and the novel was posthumously published against his wishes. Dark and at times surreal, The Castle is often understood to be about alienation, unresponsive bureaucracy, the frustration of trying to conduct business with non-transparent, seemingly arbitrary controlling systems, and the futile pursuit of an unobtainable goal.', 'uploads/books/9780805211061.jpg', 18, 3.5),
(3, 'Vita and Virginia', 5, 5, 'Vita Sackville-West (1892-1962) was born at Knole in Kent, the only child of aristocratic parents. In 1913 she married diplomat Harold Nicolson, with whom she had two sons and travelled extensively. They had an unconventional marriage, and troughout her l', 'uploads/books/Vita and Virginia.jpg', 25, 4.0),
(4, 'The Shining', 6, 6, 'The Shining is a 1977 horror novel by American author Stephen King. It is King\'s third published novel and first hardcover bestseller; its success firmly established King as a preeminent author in the horror genre,Stephen Edwin King is an American author.', 'uploads/books/The Shining.jpg', 30, 4.9),
(5, '1984', 9, 3, 'Nineteen Eighty-Four is a dystopian novel and cautionary tale by English writer Eric Arthur Blair, who wrote under the pen name George Orwell. It was published on 8 June 1949 by Secker & Warburg as Orwell\'s ninth and final book completed in his lifetime.', 'uploads/books/1984.jpg', 21, 4.2),
(6, 'The Running Grave', 8, 2, 'The Running Grave is a crime fiction novel written by J. K. Rowling, and published under the pseudonym Robert Galbraith. It was published 26 September 2023. It is the seventh novel in the Cormoran Strike series.', 'uploads/books/The Running Grave.jpg', 15, 2.5),
(7, 'The Rebel', 7, 4, 'The Rebel is a 1951 book-length essay by Albert Camus, which treats both the metaphysical and the historical development of rebellion and revolution in societies, especially Western Europe ,Albert Camus was a French philosopher, author, dramatist, journal', 'uploads/books/The Rebel.jpg', 25, 4.8),
(9, 'Haunting Adeline', 13, 13, '\"The Diamond. Death walks alongside me but the reaper is no match for me. I\'m trapped in a world full of monsters dressed as men, and those who aren\'t as they seem. They won\'t keep me forever. I no longer recognize the person I\'ve become. And I\'m fighting to find my way back to the beast who hunts me in the night.', '', 12, 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `book_id`, `quantity`, `created_at`) VALUES
(4, 9, 1, 1, '2024-11-21 11:39:21'),
(5, 2, 3, 1, '2024-11-21 11:41:01'),
(10, 10, 4, 1, '2024-11-21 19:04:40'),
(12, 4, 4, 1, '2024-11-21 19:48:54'),
(13, 2, 5, 1, '2024-11-22 03:19:16'),
(14, 2, 3, 1, '2024-11-22 09:42:48'),
(15, 11, 1, 2, '2024-11-22 10:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `cname`) VALUES
(1, 'Novels'),
(2, 'Biography'),
(3, 'Business'),
(4, 'History'),
(5, 'Love Stories'),
(6, 'Horror'),
(13, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `book_id`, `created_at`) VALUES
(1, 4, 3, '2024-11-21 18:05:02'),
(2, 4, 1, '2024-11-21 18:59:00'),
(5, 2, 5, '2024-11-21 22:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_text` text NOT NULL,
  `suggestions_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `feedback_text`, `suggestions_text`, `created_at`) VALUES
(1, 2, 'as das ds asds', 'asdasdsadasdsadasdsa', '2024-11-21 23:06:15'),
(2, 11, 'adsadsad', 'asdasdsadas', '2024-11-22 05:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `shipping_fee` float DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `shipping_fee`, `order_date`, `status`) VALUES
(1, 2, 25, 1.5, '2024-11-21 11:13:22', 'Deliver On 2-15-2024'),
(2, 10, 78, 1.5, '2024-11-21 11:22:54', 'Cancelled'),
(3, 10, 30, 1.5, '2024-11-21 14:04:46', 'Cancelled'),
(4, 4, 30, 1.5, '2024-11-21 14:49:03', 'Cancelled'),
(5, 2, 46, 1.5, '2024-11-21 22:19:28', 'pending'),
(6, 11, 36, 1.5, '2024-11-22 05:06:31', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(1, 1, 3, 1, 25),
(2, 2, 1, 1, 18),
(3, 2, 4, 2, 30),
(4, 3, 4, 1, 30),
(5, 4, 4, 1, 30),
(6, 5, 3, 1, 25),
(7, 5, 5, 1, 21),
(8, 6, 1, 2, 18);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `book_id`, `user_id`, `review_text`, `rating`, `timestamp`) VALUES
(1, 1, 1, 'Nice Book!!', 3, '2024-11-15 14:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pnumber` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'uploads/Profiles/default.png',
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `email`, `pnumber`, `password`, `image`, `address`) VALUES
(1, 'Hamza', 'hkmoviestudio@gmail.com', 2147483647, 'hamza52252', '', 'gulshan-e-iqbal'),
(2, 'Hamza', 'hamza@gmail.com', 378847673, 'hamza52252', 'uploads/Profiles/', 'Aptech metro start gate'),
(3, 'saaad', 'saad@gmail.com', 313161313, 'saad52252', '\'uploads/Profiles/default.png\'', 'sadasdadasd'),
(4, 'habir', 'habir@gmail.com', 2147483647, 'hamza52252', 'uploads/Profiles/default.png', ''),
(5, 'moiz', 'moiz@gmail.com', 2147483647, '12345678', 'uploads/Profiles/default.png', ''),
(8, 'hassan', 'hassan@gmail.com', 2147483647, 'hassan1234', 'uploads/Profiles/default.png', ''),
(9, 'saad', 'hamza11@gmail.com', 1564565465, 'hamza52252', 'uploads/Profiles/default.png', ''),
(10, 'aswaad', 'aswaad@g.com', 2147483647, 'hamza52252', 'uploads/Profiles/default.png', 'korange,street 4'),
(11, 'habir', 'habir1123@gmail.com', 325647894, 'hamza52252', 'uploads/Profiles/', 'korangi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
