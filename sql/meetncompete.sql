-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 03:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meetncompete`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_marker_id` int(11) NOT NULL,
  `event_time` date NOT NULL,
  `event_type` varchar(10) NOT NULL,
  `event_description` text NOT NULL,
  `user_name` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_marker_id`, `event_time`, `event_type`, `event_description`, `user_name`, `location`, `event_name`) VALUES
(1, 1, '2020-03-31', '', '', 1, 'Glass Park, Spokane, WA', 'Glass Park 1'),
(2, 1, '2020-03-31', '', '', 1, 'Glass Park, Spokane, WA', 'Glass Park 2'),
(3, 1, '2020-03-31', '', '', 1, 'Glass Park, Spokane, WA', 'Glass Park 3'),
(4, 1, '2020-03-31', '', '', 1, 'Glass Park, Spokane, WA', 'Glass Park 4'),
(5, 1, '2020-03-31', '', '', 1, 'Glass Park, Spokane, WA', 'Glass Park 5'),
(6, 1, '2020-03-31', '', '', 1, 'Glass Park, Spokane, WA', 'Glass Park 6');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(11, 'first post', 'newtestuser', 'none', '2020-03-24 23:59:18', 'no', 'no', 0),
(12, 'second post', 'newtestuser', 'none', '2020-04-02 23:40:45', 'no', 'no', 0),
(13, 'I\'m doing the project during the Spring break yay!!!!', 'newtestuser', 'none', '2020-04-02 23:43:48', 'no', 'no', 0),
(14, 'Hello there, check this out', 'anothertestuser', 'none', '2020-04-04 01:25:12', 'no', 'no', 0),
(15, 'Hi again', 'anothertestuser', 'none', '2020-04-04 14:22:52', 'no', 'no', 0),
(16, 'we should work together', 'newtestuser', 'none', '2020-04-04 15:36:00', 'no', 'no', 0),
(17, 'I got a cool avatar right?', 'newtestuser', 'none', '2020-04-04 15:36:20', 'no', 'no', 0),
(18, 'Hello everyone!!!', 'kingofsky95', 'none', '2020-04-04 15:38:59', 'no', 'no', 0),
(19, 'How is everyone doing during the quarantine? ', 'kingofsky95', 'none', '2020-04-04 15:39:27', 'no', 'no', 0),
(20, 'BEEN PLAYING VIDEO GAMES!!!', 'newtestuser', 'none', '2020-04-04 15:40:03', 'no', 'no', 0),
(21, 'WOOOHOOO', 'newtestuser', 'none', '2020-04-04 15:43:05', 'no', 'no', 0),
(22, 'just fixed the loading post guys! FACK YEAH!', 'newtestuser', 'none', '2020-04-04 17:19:56', 'no', 'no', 0),
(23, 'I\'m an anime character', 'erenjaeger', 'none', '2020-04-05 21:28:07', 'no', 'no', 0),
(24, 'tomorrow is the first day of the quarter!!!', 'erenjaeger', 'none', '2020-04-05 22:48:54', 'no', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `post_by` varchar(60) NOT NULL,
  `post_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `past_events` int(11) NOT NULL,
  `current_events` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `password`, `signup_date`, `profile_picture`, `num_posts`, `past_events`, `current_events`, `user_closed`, `friend_array`) VALUES
(2, 'Gavin', 'Thomas', 'newtestuser', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-12', 'img/gavin.gif', 8, 0, 0, 'no', ',kingofsky95,erenjaeger,'),
(3, 'Another', 'Test', 'anothertestuser', 'test1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-12', 'img/reee.gif', 2, 0, 0, 'no', ','),
(4, 'Khanh', 'Luu', 'kingofsky95', 'kingofsky95@gmail.com', 'eab9164e7f35f8128f98ab3b9d42b433', '2020-02-20', 'img/kingofsky95.gif', 2, 0, 0, 'no', ',newtestuser,'),
(5, 'Eren', 'Jaeger', 'erenjaeger', 'eren@aot.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-05', 'img/eren.gif', 2, 0, 0, 'no', ',newtestuser,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
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
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
