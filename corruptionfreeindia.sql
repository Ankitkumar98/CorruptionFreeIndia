-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 11:10 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corruptionfreeindia`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `category_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`, `category_date`) VALUES
(1, 'corruption', 'how to report a corruption , what are the laws regarding corruption etc.', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_desc` varchar(1024) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `comment_user_id` int(11) NOT NULL,
  `comment_likes` int(5) NOT NULL,
  `comment_dislikes` int(5) NOT NULL,
  `comment_thread_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_desc`, `comment_date`, `comment_user_id`, `comment_likes`, `comment_dislikes`, `comment_thread_id`) VALUES
(1, 'Some organizations may have internal reporting system . you can also report to their seniors however the latter one is the most preferred one ', '2021-01-12 02:59:12', 5, 3, 2, 1),
(3, 'this is a sample comment to test the discussion forum', '2021-01-18 13:33:36', 5, 3, 2, 1),
(4, 'this is sample comment', '2021-01-18 13:33:57', 5, 2, 3, 1),
(5, 'this is sample comment', '2021-01-18 13:35:17', 5, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` varchar(2024) NOT NULL,
  `thread_date` datetime NOT NULL DEFAULT current_timestamp(),
  `thread_user_id` int(5) NOT NULL,
  `thread_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_date`, `thread_user_id`, `thread_category`) VALUES
(1, 'What to do if I suspect a corruption', 'I saw a person involved in the corruption , what to do and where should I report this', '2021-01-12 02:26:11', 5, 1),
(3, 'hello world', 'sample query', '2021-01-23 03:04:10', 5, 1),
(4, 'hello world', 'sample query', '2021-01-23 03:04:22', 5, 1),
(5, 'hello world', 'sample query', '2021-01-23 03:06:20', 5, 1),
(6, 'hello world', 'sample query', '2021-01-23 03:06:21', 5, 1),
(7, 'hello world', 'sample query', '2021-01-23 03:06:21', 5, 1),
(8, 'hello world', 'sample query', '2021-01-23 03:06:22', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(5, 'ankit kumar', 'ankitkumar.adi13@gmail.com', '$2y$10$TR8iBMdoNk5vVfsL8c0yRul2NCzDHeUkfwVvdBr8qPWoRsiC94q1u'),
(6, 'divyansh singh', '1805661@kiit.ac.in', '$2y$10$pYhDXCm49xAZFWDQjXoikOdpJcFhLpYAVWRpH.kwI/YBomuIjEvrm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_foreign` (`comment_user_id`),
  ADD KEY `thread_foreign_key` (`comment_thread_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `user_foreign_key` (`thread_user_id`),
  ADD KEY `category_foreign_key` (`thread_category`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `thread_foreign_key` FOREIGN KEY (`comment_thread_id`) REFERENCES `threads` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_foreign` FOREIGN KEY (`comment_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `category_foreign_key` FOREIGN KEY (`thread_category`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_foreign_key` FOREIGN KEY (`thread_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
