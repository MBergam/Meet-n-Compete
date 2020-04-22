-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2020 at 08:48 AM
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
  `event_date` date NOT NULL,
  `event_type` varchar(10) NOT NULL,
  `event_description` text NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_start_time` varchar(9) NOT NULL,
  `event_duration` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_marker_id`, `event_date`, `event_type`, `event_description`, `user_name`, `location`, `event_name`, `event_start_time`, `event_duration`) VALUES
(1, 1, '2020-04-30', 'Basketball', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos pariatur qui sunt corrupti accusamus non illum quia, id saepe ipsum distinctio laboriosam unde? Dicta reprehenderit distinctio ipsa magnam ducimus laboriosam.', '1', 'Glass Park, Spokane, WA', 'Glass Park 1', '14:00', 30),
(2, 1, '2020-03-31', 'soccer', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos pariatur qui sunt corrupti accusamus non illum quia, id saepe ipsum distinctio laboriosam unde? Dicta reprehenderit distinctio ipsa magnam ducimus laboriosam.', '1', 'Glass Park, Spokane, WA', 'Glass Park 2', '14:00', 30),
(3, 1, '2020-03-31', 'tennis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos pariatur qui sunt corrupti accusamus non illum quia, id saepe ipsum distinctio laboriosam unde? Dicta reprehenderit distinctio ipsa magnam ducimus laboriosam.', '1', 'Glass Park, Spokane, WA', 'Glass Park 3', '14:00', 30),
(4, 1, '2020-03-31', 'Soccer', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos pariatur qui sunt corrupti accusamus non illum quia, id saepe ipsum distinctio laboriosam unde? Dicta reprehenderit distinctio ipsa magnam ducimus laboriosam.', '1', 'Glass Park, Spokane, WA', 'Glass Park 4', '14:00', 30),
(5, 1, '2020-03-31', 'Soccer', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos pariatur qui sunt corrupti accusamus non illum quia, id saepe ipsum distinctio laboriosam unde? Dicta reprehenderit distinctio ipsa magnam ducimus laboriosam.', '1', 'Glass Park, Spokane, WA', 'Glass Park 5', '14:00', 30),
(6, 1, '2020-03-31', 'Soccer', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos pariatur qui sunt corrupti accusamus non illum quia, id saepe ipsum distinctio laboriosam unde? Dicta reprehenderit distinctio ipsa magnam ducimus laboriosam.', '1', 'Glass Park, Spokane, WA', 'Glass Park 6', '14:00', 30);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_name`, `post_id`) VALUES
(24, 'flipflop', 25),
(26, 'kingofsky95', 19),
(27, 'kingofsky95', 18),
(29, 'flipflop', 49),
(30, 'newtestuser', 50),
(31, 'newtestuser', 51),
(32, 'erenjaeger', 50),
(33, 'kingofsky95', 22),
(34, 'newtestuser', 48),
(35, 'erenjaeger', 56);

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
(18, 'Hello everyone!!!', 'kingofsky95', 'none', '2020-04-04 15:38:59', 'no', 'no', 1),
(19, 'How is everyone doing during the quarantine? ', 'kingofsky95', 'none', '2020-04-04 15:39:27', 'no', 'no', 1),
(20, 'BEEN PLAYING VIDEO GAMES!!!', 'newtestuser', 'none', '2020-04-04 15:40:03', 'no', 'no', 0),
(21, 'WOOOHOOO', 'newtestuser', 'none', '2020-04-04 15:43:05', 'no', 'no', 0),
(22, 'just fixed the loading post guys! FACK YEAH!', 'newtestuser', 'none', '2020-04-04 17:19:56', 'no', 'no', 1),
(23, 'I\'m an anime character', 'erenjaeger', 'none', '2020-04-05 21:28:07', 'no', 'no', 0),
(24, 'tomorrow is the first day of the quarter!!!', 'erenjaeger', 'none', '2020-04-05 22:48:54', 'no', 'no', 0),
(25, 'I\'m the cat driving a flip flop WEEEEEEEEEE~', 'flipflop', 'none', '2020-04-10 18:24:33', 'no', 'no', 1),
(26, 'Hello, this is for Gavin', 'erenjaeger', 'newtestuser', '2020-04-13 20:52:38', 'no', 'no', 0),
(27, 'Hello, this is for Gavin', 'erenjaeger', 'newtestuser', '2020-04-13 20:52:46', 'no', 'no', 0),
(28, '*TEST* sending post to myself', 'erenjaeger', 'none', '2020-04-13 21:26:09', 'no', 'no', 0),
(29, 'hello again', 'erenjaeger', 'newtestuser', '2020-04-13 21:26:35', 'no', 'no', 0),
(30, 'test', 'erenjaeger', 'none', '2020-04-13 21:33:00', 'no', 'no', 0),
(31, 'adwad', 'erenjaeger', 'none', '2020-04-13 21:35:02', 'no', 'no', 0),
(32, 'add', 'erenjaeger', 'none', '2020-04-13 21:37:13', 'no', 'no', 0),
(33, 'wqdqw', 'erenjaeger', 'none', '2020-04-13 21:39:18', 'no', 'yes', 0),
(34, 'sup nerd!', 'erenjaeger', 'newtestuser', '2020-04-13 21:41:21', 'no', 'no', 0),
(35, 'want some juice?', 'erenjaeger', 'newtestuser', '2020-04-13 21:41:44', 'no', 'no', 0),
(36, 'want some juice?', 'erenjaeger', 'newtestuser', '2020-04-13 21:41:55', 'no', 'no', 0),
(37, 'fef', 'erenjaeger', 'none', '2020-04-13 21:48:09', 'no', 'no', 0),
(38, 'asdasd', 'erenjaeger', 'none', '2020-04-13 21:50:45', 'no', 'no', 0),
(39, 'asd', 'erenjaeger', 'none', '2020-04-13 21:51:36', 'no', 'yes', 0),
(40, 'awdwd', 'erenjaeger', 'none', '2020-04-13 21:52:30', 'no', 'no', 0),
(41, 'hello', 'erenjaeger', 'newtestuser', '2020-04-13 21:57:18', 'no', 'no', 0),
(42, 'adwdwd', 'erenjaeger', 'newtestuser', '2020-04-13 21:57:55', 'no', 'no', 0),
(43, 'again', 'erenjaeger', 'none', '2020-04-13 21:59:32', 'no', 'no', 0),
(44, 'again', 'erenjaeger', 'none', '2020-04-13 21:59:37', 'no', 'no', 0),
(45, 'again', 'erenjaeger', 'none', '2020-04-13 21:59:39', 'no', 'no', 0),
(46, 'updated', 'erenjaeger', 'none', '2020-04-13 22:03:57', 'no', 'no', 0),
(47, 'asd', 'erenjaeger', 'none', '2020-04-13 22:05:24', 'no', 'yes', 0),
(48, 'last test', 'erenjaeger', 'none', '2020-04-13 22:05:50', 'no', 'no', 1),
(49, 'Why my newsfeed is only getting your posts? ', 'flipflop', 'none', '2020-04-13 22:26:52', 'no', 'no', 1),
(50, 'when will you release SS6 for us? Next time put  a pair of flip flop on a titan please :D', 'flipflop', 'erenjaeger', '2020-04-13 22:31:33', 'no', 'no', 2),
(51, 'will get deleted', 'newtestuser', 'none', '2020-04-14 20:32:49', 'no', 'yes', 1),
(52, 'will be deleted', 'newtestuser', 'none', '2020-04-14 22:46:56', 'no', 'yes', 0),
(53, 'interesting profile picture!', 'erenjaeger', 'flipflop', '2020-04-14 23:16:28', 'no', 'no', 0),
(54, 'wd', 'newtestuser', 'none', '2020-04-15 22:10:46', 'no', 'yes', 0),
(55, 'hello eren', 'newtestuser', 'erenjaeger', '2020-04-16 17:22:19', 'no', 'yes', 0),
(56, 'hello there', 'erenjaeger', 'none', '2020-04-18 20:51:06', 'no', 'no', 1);

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
(2, 'Gavin', 'Thomas', 'newtestuser', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-12', 'img/newtestuser_original.f85e80c4e5c940635129eaba8c2d6fb5.gif', 12, 0, 0, 'no', ',erenjaeger,flipflop,kingofsky95,anothertestuser,'),
(3, 'Another', 'Test', 'anothertestuser', 'test1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-12', 'img/reee.gif', 2, 0, 0, 'no', ',newtestuser,'),
(4, 'Khanh', 'Luu', 'kingofsky95', 'kingofsky95@gmail.com', 'eab9164e7f35f8128f98ab3b9d42b433', '2020-02-20', 'img/kingofsky95_original.e09bb7f6314ee493d3bd09ef1adece60.gif', 2, 0, 0, 'no', ',newtestuser,'),
(5, 'Eren', 'Jaeger', 'erenjaeger', 'eren@aot.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-05', 'img/eren.gif', 27, 0, 0, 'no', ',newtestuser,flipflop,'),
(6, 'Flip', 'Flop', 'flipflop', 'flipflop@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-10', 'img/flipflop.gif', 3, 0, 0, 'no', ',erenjaeger,newtestuser,');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
