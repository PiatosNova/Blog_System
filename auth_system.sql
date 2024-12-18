-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 02:40 AM
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
-- Database: `auth_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `parent_id`) VALUES
(1, 5, 4, 'tettettdsadsad', '2024-12-10 15:01:10', NULL),
(2, 5, 4, 'gdsajdghdsadsa', '2024-12-10 15:01:19', NULL),
(4, 5, 4, 'nnnnnnnnnnn=', '2024-12-10 15:06:30', NULL),
(5, 5, 4, 'erwre', '2024-12-10 15:11:24', NULL),
(6, 5, 4, 'rewrewrewr', '2024-12-10 15:14:23', 5),
(7, 5, 4, 'Msnsbfsbfnfnf', '2024-12-10 15:21:29', NULL),
(8, 5, 4, 'dsfsdf', '2024-12-10 15:23:55', 7),
(9, 5, 4, 'reply', '2024-12-10 15:25:02', 7),
(10, 6, 4, 'comment', '2024-12-10 15:34:13', NULL),
(11, 6, 4, 'reply', '2024-12-10 15:34:19', 10),
(12, 7, 3, 'fdsfsdf', '2024-12-10 15:36:37', NULL),
(13, 6, 3, 'rtertert', '2024-12-10 15:36:45', 10),
(14, 3, 4, 'bayot\r\n', '2024-12-11 09:12:11', NULL),
(15, 3, 4, 'bkt ka bayot\r\n', '2024-12-11 09:12:22', 14),
(17, 6, 5, 'gaya gaya', '2024-12-11 10:53:57', 10),
(18, 9, 6, 'panget ng unggoy\r\n', '2024-12-15 01:23:11', NULL),
(19, 9, 6, 'mas panget yung nag post', '2024-12-15 01:23:24', 18),
(20, 9, 7, 'banana', '2024-12-16 08:40:09', 18),
(21, 13, 9, 'hi\r\n', '2024-12-16 08:46:49', NULL),
(22, 13, 9, 'hii', '2024-12-16 08:46:54', 21);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(1, 3, 5, '2024-12-10 15:41:58'),
(2, 3, 4, '2024-12-10 15:42:20'),
(3, 4, 8, '2024-12-11 09:12:54'),
(4, 5, 8, '2024-12-11 09:17:46'),
(5, 5, 9, '2024-12-11 09:17:48'),
(6, 6, 10, '2024-12-15 01:22:55'),
(7, 6, 8, '2024-12-16 07:42:36'),
(8, 7, 11, '2024-12-16 08:36:29'),
(10, 10, 18, '2024-12-17 15:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `media_type` varchar(50) DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`, `media_type`, `media_url`) VALUES
(3, 2, 'hi hello goodbye', 'sky view', '2024-12-10 04:55:49', 'image', 'uploads/6757c9d5ed02d_a54251ce-fec1-4d40-821f-3d8aa6e8ec1f.jpg'),
(4, 3, 'Madara the Dog', 'Selfie', '2024-12-10 05:50:46', 'image', 'uploads/6757d819e589a_Doggo Pfp.jpg'),
(5, 3, 'jepoy dizon', 'minura', '2024-12-10 06:05:58', 'video', 'uploads/6757da46679e6_Tang ina mo jepoy dizon.mp4'),
(6, 4, 'tam-isgg', 'gulay', '2024-12-10 07:02:33', 'image', 'uploads/6757e78940f0f_0bded7eb-716c-417a-af34-bd09f07bd738.jpg'),
(7, 4, 'test', 'dsadsadasdasdasd', '2024-12-10 15:35:11', '', ''),
(8, 4, 'baho na bilat', 'bilat', '2024-12-11 09:12:43', 'image', 'uploads/6759579372c54_e44d9a1f-f74a-4117-b43c-ef6fd860001c.jpg'),
(9, 5, 'BLACK NIGGERS', 'YAMETE', '2024-12-11 09:16:52', 'image', 'uploads/675958849dc21_0bded7eb-716c-417a-af34-bd09f07bd738.jpg'),
(10, 6, 'I heart dog', 'Dogs', '2024-12-15 01:22:49', 'image', 'uploads/675e2f698a4de_Doggo Pfp.jpg'),
(11, 7, 'Banana', 'banana', '2024-12-16 08:36:14', 'image', 'uploads/675fe67e9cc8c_fa400eec-bccb-4abb-9040-fcbbcbc45649.jpeg'),
(13, 8, 'qwe', 'qeqe', '2024-12-16 08:44:22', '', ''),
(14, 8, 'test', '1wrqr', '2024-12-16 08:45:26', '', ''),
(15, 9, 'test1', 'tes1', '2024-12-16 08:46:20', '', ''),
(18, 10, 'hello', 'hi', '2024-12-17 15:31:20', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `profile_picture`, `bio`) VALUES
(1, 'Vincent', 'pabon@gmail.com', '$2y$10$.P49V9OQ0tbTkllueuXAgOQVU2jpRtZoIVy3AfKVUY1iswNM8f41K', '2024-12-10 04:14:09', 'uploads/profiles/6757c5a4dfe2b_b16095f0-9f80-4dd9-96b7-687483b6440f.jfif', 'Barek'),
(2, 'nobap@gmail.com', 'nobap@gmail.com', '$2y$10$NT5y9mJNNCqvU.IaeUbQAOwkXDH6OQF76uwNf4NOFOF7wE.2.wcg2', '2024-12-10 04:54:48', NULL, NULL),
(3, 'Madara_Doggo', 'MadaraTheDog@gmail.com', '$2y$10$TxZyT.c7rXwfhB8RlEjykO.1yGXRSe3HSRQJHXgTNDt8YSwmQWtk2', '2024-12-10 05:50:14', 'uploads/profiles/67585ff99b01c_♡ 𝐷𝑜𝑔 𝑤𝑖𝑡ℎ ℎ𝑎𝑡 _ 𝑀𝑎𝑑𝑎𝑟𝑎 𝑈𝑐ℎ𝑖ℎ𝑎 𝑏𝑦 𝐿𝑦𝑛𝑥™ ♡.jpg', ''),
(4, 'Dog', 'dog@gmail.com', '$2y$10$O0ndsid2K3hro3lbamBRD.eStiSvwvB8I2kows90Uktrr5Q5FqyxG', '2024-12-10 07:00:09', 'uploads/profiles/67585f90a6590_47c365a8-4cf7-4084-b32c-1f337b4645a8.jpg', ']\\bikat'),
(5, 'blaknigirl', 'blaknigirl@gmail.com', '$2y$10$rdQMtTJcp1CokP4r/81lDeZMgNI48sOSWjZuutK8L56kY2uPzsvuy', '2024-12-11 09:15:45', 'uploads/profiles/675958b3edd9e_462584346_1553702665336971_152172271220150228_n.jpg', '132213132'),
(6, 'herrica', 'eca@gmail.com', '$2y$10$qewS5uFRz3iJRCCz/rX7o.jS1Xr9CUyQhZIIUhYXq5IcAqY.sV94C', '2024-12-15 01:22:05', 'uploads/profiles/675e2fb7d067c_e44d9a1f-f74a-4117-b43c-ef6fd860001c.jpg', 'diko pa nalalabahan kase wala ako bio'),
(7, 'Banana_Creampe', 'banana@gmail.com', '$2y$10$kf/VE4Dke.BNAgE6o06RIejp2eQ7n11.biM5Y/cqbb./QCkAUfQlu', '2024-12-16 08:30:41', 'uploads/profiles/675fe656a743b_ac173ec1-7058-48f7-b941-08dff7937261.jpeg', 'I cream pie banana'),
(8, 'user3', 'user1@gmail.com', '$2y$10$xXDRcCf4u4NwamKg6vCTtOgOMLA1aB3O2GiaJefV/Xf5TxxN9e6.a', '2024-12-16 08:42:28', 'uploads/profiles/675fe99cca9f0_ac173ec1-7058-48f7-b941-08dff7937261.jpeg', ''),
(9, 'user2', 'user2@gmail.com', '$2y$10$SHrYAk9qf4l5TOmE3d.ruOO4zdTPPDRYI8OvjwIiH2aeqavSJtFaC', '2024-12-16 08:45:59', NULL, NULL),
(10, 'You', 'you@gmail.com', '$2y$10$YBCb1Jz3DaAOpQlabJVkUOQ2aZPS8dojeVlKIlwS/e88Nnzkg5/2m', '2024-12-17 14:22:11', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
