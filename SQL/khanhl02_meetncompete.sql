-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2020 at 12:03 PM
-- Server version: 5.6.40-84.0-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khanhl02_meetncompete`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `about_content` varchar(500) NOT NULL,
  `user_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `about_content`, `user_name`) VALUES
(3, 'Updated about me', 'bluecat'),
(4, 'i\'m a kid', 'newtestuser'),
(10, 'I cam from One Punch Man...', 'saitama'),
(11, 'I\'m from the Uchiha clan', 'sasuke'),
(12, 'Thanks for using our site! :)', 'yeah');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'yeah bois!', 'newtestuser', 'erenjaeger', '2020-04-07 22:12:07', 'no', 24),
(2, 'boring...', 'newtestuser', 'kingofsky95', '2020-04-07 22:46:30', 'no', 19),
(3, 'how is school going?', 'erenjaeger', 'erenjaeger', '2020-04-07 22:50:00', 'no', 24),
(4, 'that would be fun huh? :3 ', 'erenjaeger', 'newtestuser', '2020-04-07 23:29:15', 'no', 13),
(5, 'unsure but soon!', 'erenjaeger', 'flipflop', '2020-04-14 23:16:00', 'no', 50),
(6, 'Who is your favorite character?', 'erenjaeger', 'flipflop', '2020-04-15 00:02:06', 'no', 50),
(7, 'good job!', 'kingofsky95', 'newtestuser', '2020-04-16 01:02:38', 'no', 22),
(8, 'sucessfully!', 'newtestuser', 'newtestuser', '2020-04-25 02:41:33', 'no', 57),
(9, 'what are you talking about?', 'erenjaeger', 'newtestuser', '2020-04-25 02:42:13', 'no', 57),
(10, 'what is DB, can i kill it?', 'sasuke', 'newtestuser', '2020-04-25 13:38:25', 'no', 57),
(11, 'i\'m waiting on that too bro~', 'newtestuser', 'flipflop', '2020-04-25 13:42:29', 'no', 50),
(12, 'Thanks!', 'shinchan', 'newtestuser', '2020-04-27 14:25:31', 'no', 58),
(13, 'hmmm... i don\'t think so', 'newtestuser', 'erenjaeger', '2020-04-29 22:42:57', 'no', 53),
(14, 'that makes you weak', 'sasuke', 'newtestuser', '2020-04-29 23:02:59', 'no', 20),
(15, 'nope! mine is way better!', 'sasuke', 'newtestuser', '2020-04-29 23:03:21', 'no', 17),
(16, 'I can play any memes huehue', 'newtestuser', 'sasuke', '2020-05-01 23:52:18', 'no', 62),
(20, 'testing', 'newtestuser', 'sasuke', '2020-05-03 14:06:34', 'no', 63),
(22, 'making a comment', 'sasuke', 'sasuke', '2020-05-03 15:04:11', 'no', 63),
(23, 'thanks, but unecessary...', 'shu', 'erenjaeger', '2020-05-05 21:07:49', 'no', 64),
(24, 'add me too', 'bluecat', 'newtestuser', '2020-05-06 19:25:21', 'no', 65),
(25, 'FUCK YEAH BOIS', 'newtestuser', 'newtestuser', '2020-05-12 00:34:09', 'no', 72),
(26, 'cool beans!', '', 'tamnguyen', '2020-05-18 14:36:23', 'no', 89),
(27, 'good song', 'sasuke', 'newtestuser', '2020-05-21 01:54:27', 'no', 75),
(28, 'how to play basketball?', 'erenjaeger', 'yeah', '2020-05-21 02:03:13', 'no', 94),
(29, 'made a comment from online version', 'erenjaeger', 'newtestuser', '2020-05-21 02:03:58', 'no', 93),
(30, 'from live', 'erenjaeger', 'bluecat', '2020-05-21 02:11:15', 'no', 92),
(31, '', 'bluecat', 'bluecat', '2020-05-21 02:14:08', 'no', 92),
(32, 'what?', 'bluecat', 'bluecat', '2020-05-21 02:14:15', 'no', 92),
(33, 'nothing', 'erenjaeger', 'bluecat', '2020-05-21 02:14:51', 'no', 92),
(34, 'what?', 'newtestuser', 'newtestuser', '2020-05-21 02:16:02', 'no', 93),
(35, 'What time?', 'newtestuser', 'yeah', '2020-05-21 02:16:29', 'no', 94),
(36, 'from a kid', 'newtestuser', 'saitama', '2020-05-21 02:20:05', 'no', 90),
(45, 'hello', 'erenjaeger', 'newtestuser', '2020-05-21 02:38:07', 'no', 93),
(46, 'hi', 'newtestuser', 'newtestuser', '2020-05-21 02:38:51', 'no', 93),
(47, 'asdasdasdad', 'shinchan', 'newtestuser', '2020-05-21 02:39:55', 'no', 93),
(48, 'dude...', 'erenjaeger', 'newtestuser', '2020-05-21 02:43:31', 'no', 93),
(51, 'another comment', 'newtestuser', 'newtestuser', '2020-05-26 21:02:15', 'no', 75),
(52, 'should work', 'newtestuser', 'newtestuser', '2020-05-26 21:02:58', 'no', 75),
(53, 'Hi there', 'saitama', 'bluecat', '2020-05-26 21:12:31', 'no', 92),
(54, 'hello', 'newtestuser', 'bluecat', '2020-05-29 23:02:53', 'no', 92);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_marker_id` varchar(30) NOT NULL,
  `event_date` date NOT NULL,
  `event_type` varchar(20) NOT NULL,
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
(4, 'ChIJG71QbrYYnlQRakcmWJP55IE', '2020-06-12', 'Basketball', '', 'tamnguyen2', 'Chief Garry Park', 'event 2', '23:15', 30),
(7, 'ChIJcR0QbpzeYVMRFvzGG7IXazI', '0000-00-00', 'Billiards', '', 'yeah', 'liberty lake ball field', 'maxtest1', '', 30),
(8, 'ChIJcR0QbpzeYVMRFvzGG7IXazI', '2020-05-14', 'Bowling', '', 'yeah', 'liberty lake ball field', 'maxtest2', '12:55', 30),
(9, 'ChIJ0YpHVG8gnlQRjQ5MsVIL5t4', '2020-05-14', 'Baseball', '', 'ProZude', 'Players & Spectators Event Center', 'FU SIDUGH', '13:25', 30),
(10, 'ChIJ54QyRO0gnlQRhD_OZFO1EuU', '2020-06-16', 'Weightlifting', '', 'yeah', 'Terrace View Park', 'Hi', '14:50', 30),
(16, 'ChIJG71QbrYYnlQRakcmWJP55IE', '2020-06-12', 'Basketball', '', 'tamnguyen', 'Chief Garry Park', 'event 3', '23:20', 30),
(17, 'ChIJG71QbrYYnlQRakcmWJP55IE', '2020-06-12', 'Basketball', '', 'tamnguyen', 'Chief Garry Park', 'event 4', '23:20', 30),
(18, 'ChIJ0YpHVG8gnlQRjQ5MsVIL5t4', '2020-05-27', 'Climbing', '', 'tamnguyen', 'Players & Spectators Event Center', 'tam test 1', '0:55', 30),
(20, 'ChIJ54QyRO0gnlQRhD_OZFO1EuU', '2020-05-22', 'Basketball', '', 'ProZude', 'Terrace View Park', 'Eric Basketball Event', '15:00', 30),
(21, 'ChIJNSf48ioanlQR1FrTX0J1PKg', '2020-05-27', 'Swimming', '', 'sasuke', 'Dwight Merkel Sports Complex', 'Swimming Competition ', '17:00', 30),
(22, 'ChIJvXoXuBkgnlQRq4mlTmmxFMY', '2020-05-31', 'Cricket', 'test description', 'tamnguyen', 'Valley Mission Park', 'Tam new test', '22:25', 30),
(23, 'ChIJLSElPvzfYVMRCuAiE3T7YrY', '2020-05-31', 'Bowling', 'aaa', 'tamnguyen', 'Mirabeau Meadows', 'Tam 2', '22:50', 30),
(24, 'ChIJ1zYZl8vfYVMR_FnE1if4ho4', '2020-05-22', 'Basketball', 'Basketball pick up games - 5 on 5', 'yeah', 'Orchard Park', 'Basketball event', '14:10', 45),
(26, 'ChIJ1zYZl8vfYVMR_FnE1if4ho4', '2020-05-20', 'Basketball', 'Pickup game - anyone welcome', 'yeah', 'Orchard Park', 'Maxs Basketball Game', '15:00', 30),
(27, 'ChIJ1zYZl8vfYVMR_FnE1if4ho4', '2020-05-21', 'Basketball', 'Pickup game - anyone welcome', 'yeah', 'Orchard Park', 'Max\'s Basketball Game', '15:50', 30),
(28, 'ChIJcR0QbpzeYVMRFvzGG7IXazI', '2020-05-26', 'Baseball', '', 'sneakurtis', 'liberty lake ball field', 'baseball game', '15:30', 60),
(30, 'ChIJV6UTC9senlQRNV7zntyC1oU', '2020-05-31', 'Climbing', '', 'newtestuser', 'Kehoe Park', 'Kehoe Climb Comp', '15:15', 57),
(31, 'ChIJx2-uDOQgnlQR2_5rZ69H3sI', '2020-05-31', 'Basketball', '', 'ProZude', 'Browns Park', 'Eric\'s Basketball Game', '13:45', 45),
(32, 'ChIJbcqr8iTcYVMR1GSWnSw6iaU', '2020-06-06', 'Baseball', '', 'yeah', 'Rocky Hill Park', 'Max Event', '15:50', 30);

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `event_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `event_join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_users`
--

INSERT INTO `event_users` (`event_id`, `user_name`, `event_join_date`) VALUES
(0, 'ProZude', '2020-05-13'),
(4, '', '2020-05-17'),
(4, 'newtestuser', '2020-05-13'),
(4, 'sneakurtis', '2020-05-25'),
(4, 'tamnguyen', '2020-05-21'),
(4, 'yeah', '2020-05-20'),
(7, '', '2020-05-17'),
(7, 'ProZude', '2020-05-14'),
(7, 'tamnguyen', '2020-05-17'),
(8, 'ProZude', '2020-05-14'),
(9, 'yeah', '2020-05-14'),
(10, 'ProZude', '2020-05-18'),
(10, 'tamnguyen', '2020-05-16'),
(16, '', '2020-05-17'),
(16, 'tamnguyen2', '2020-05-17'),
(16, 'yeah', '2020-05-21'),
(17, 'tamnguyen2', '2020-05-17'),
(17, 'yeah', '2020-05-20'),
(18, 'yeah', '2020-05-20'),
(20, 'yeah', '2020-05-20'),
(21, 'newtestuser', '2020-05-19'),
(21, 'yeah', '2020-05-20'),
(22, '', '2020-05-29'),
(22, 'yeah', '2020-05-29'),
(24, '', '2020-05-21'),
(24, 'newtestuser', '2020-05-21'),
(27, '', '2020-05-21'),
(28, '', '2020-05-26'),
(30, 'erenjaeger', '2020-05-26'),
(31, 'yeah', '2020-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(8, 'flipflop', 'sasuke'),
(12, 'flipflop', 'bluecat'),
(14, 'totoro', 'bluecat'),
(21, 'tamnguyen', 'newtestuser'),
(22, 'tamnguyen', 'newtestuser'),
(24, 'tamnguyen', 'kingofsky95'),
(25, 'tamnguyen', 'bluecat'),
(28, 'shinchan', 'bluecat'),
(31, 'anothertestuser', '');

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
(35, 'erenjaeger', 56),
(37, 'erenjaeger', 57),
(38, 'erenjaeger', 57),
(39, 'sasuke', 57),
(41, 'newtestuser', 57),
(42, 'newtestuser', 56),
(43, 'shinchan', 58),
(45, 'newtestuser', 53),
(46, 'newtestuser', 60),
(47, 'sasuke', 58),
(48, 'sasuke', 20),
(49, 'sasuke', 17),
(50, 'sasuke', 61),
(51, 'newtestuser', 62),
(52, 'newtestuser', 58),
(53, '', 62),
(54, '', 63),
(55, 'newtestuser', 63),
(56, '', 61),
(57, 'shu', 64),
(58, '', 60),
(59, '', 59),
(60, '', 58),
(61, '', 57),
(62, '', 22),
(63, '', 21),
(64, '', 17),
(65, 'newtestuser', 64),
(66, 'bluecat', 60),
(67, 'bluecat', 58),
(68, 'bluecat', 57),
(69, 'bluecat', 65),
(70, 'kingofsky95', 65),
(72, '', 69),
(73, '', 68),
(75, '', 65),
(76, '', 26),
(77, 'newtestuser', 73),
(78, 'newtestuser', 72),
(79, '', 74),
(80, '', 73),
(81, '', 72),
(82, '', 71),
(83, '', 64),
(84, 'newtestuser', 76),
(85, 'saitama', 65),
(86, '', 89),
(87, 'bluecat', 92),
(88, 'bluecat', 69),
(89, 'bluecat', 68),
(90, 'bluecat', 91),
(91, '', 93),
(92, '', 92),
(93, 'erenjaeger', 63),
(94, 'erenjaeger', 61),
(95, 'erenjaeger', 94),
(96, 'erenjaeger', 93),
(97, '', 90),
(98, '', 88),
(99, 'saitama', 93),
(100, 'newtestuser', 90),
(101, 'erenjaeger', 92),
(103, 'shinchan', 93),
(104, 'shinchan', 85),
(105, 'erenjaeger', 91),
(106, 'erenjaeger', 86),
(107, 'erenjaeger', 85),
(108, 'sasuke', 63),
(109, 'shu', 93),
(110, 'shu', 24),
(111, 'shu', 94),
(112, 'newtestuser', 85),
(113, '', 94),
(114, '', 85),
(115, '', 91),
(116, '', 84),
(117, '', 75),
(118, '', 87),
(119, '', 42),
(120, 'erenjaeger', 84),
(121, 'erenjaeger', 75),
(122, 'erenjaeger', 74);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'erenjaeger', 'newtestuser', 'hello, Eren', '2020-04-20 20:26:15', 'yes', 'yes', 'no'),
(2, 'erenjaeger', 'newtestuser', 'long time no see man, would you like to hang out sometime?', '2020-04-20 20:43:59', 'yes', 'yes', 'no'),
(3, 'erenjaeger', 'newtestuser', 'oh, hook me up with your girlfriend\'s friends too buddy *wink wink*', '2020-04-20 20:44:28', 'yes', 'yes', 'no'),
(4, 'newtestuser', 'erenjaeger', 'of course my man! Be more specific on who you wanna ask to go out with?', '2020-04-20 20:48:36', 'yes', 'yes', 'no'),
(5, 'newtestuser', 'erenjaeger', 'of course my man! Be more specific on who you wanna ask to go out with?', '2020-04-20 21:13:47', 'yes', 'yes', 'no'),
(6, 'newtestuser', 'erenjaeger', 'of course my man! Be more specific on who you wanna ask to go out with?', '2020-04-20 21:24:03', 'yes', 'yes', 'no'),
(7, 'newtestuser', 'erenjaeger', 'testing', '2020-04-20 23:00:35', 'yes', 'yes', 'no'),
(8, 'newtestuser', 'erenjaeger', 'asdadasd', '2020-04-20 23:00:38', 'yes', 'yes', 'no'),
(9, 'newtestuser', 'erenjaeger', 'asdasd', '2020-04-20 23:00:41', 'yes', 'yes', 'no'),
(10, 'newtestuser', 'erenjaeger', 'awdawdd', '2020-04-20 23:00:43', 'yes', 'yes', 'no'),
(11, 'newtestuser', 'erenjaeger', 'afawfawfafwf', '2020-04-20 23:00:45', 'yes', 'yes', 'no'),
(12, 'newtestuser', 'erenjaeger', 'fdfsdfsdfsdfdf', '2020-04-20 23:00:48', 'yes', 'yes', 'no'),
(13, 'newtestuser', 'erenjaeger', 'sorry for the spams', '2020-04-20 23:00:57', 'yes', 'yes', 'no'),
(14, 'newtestuser', 'erenjaeger', 'are  you still there?', '2020-04-20 23:01:08', 'yes', 'yes', 'no'),
(15, 'kingofsky95', 'erenjaeger', 'hey man!', '2020-04-21 01:07:55', 'yes', 'yes', 'no'),
(16, 'kingofsky95', 'erenjaeger', 'what sup dude', '2020-04-21 01:13:34', 'yes', 'yes', 'no'),
(17, 'erenjaeger', 'newtestuser', 'sorry was doing something else', '2020-04-21 01:30:00', 'yes', 'yes', 'no'),
(18, 'flipflop', 'erenjaeger', 'hey cat, sell me your flip flop', '2020-04-25 02:46:13', 'no', 'no', 'no'),
(19, 'totoro', 'bluecat', 'hello', '2020-04-25 13:24:56', 'no', 'no', 'no'),
(20, 'totoro', 'bluecat', 'can we be friends?', '2020-04-25 13:25:08', 'no', 'no', 'no'),
(21, 'shu', 'newtestuser', 'hello friend!', '2020-04-25 13:33:17', 'yes', 'yes', 'no'),
(22, 'anothertestuser', 'newtestuser', 'hi frog!', '2020-04-25 13:34:00', 'no', 'no', 'no'),
(23, 'bluecat', 'newtestuser', 'hi blue cat :3 ', '2020-04-25 13:34:22', 'yes', 'yes', 'no'),
(24, 'totoro', 'newtestuser', 'Good morning Totoro!', '2020-04-25 13:34:51', 'no', 'no', 'no'),
(25, 'kingofsky95', 'newtestuser', 'Hello Mr. Luu! are you done with this project... the website loading speed is very bad!', '2020-04-25 13:35:51', 'yes', 'yes', 'no'),
(26, 'sasuke', 'newtestuser', 'where is Naruto?', '2020-04-25 13:40:17', 'yes', 'yes', 'no'),
(27, 'shinchan', 'newtestuser', 'Hello shin-chan', '2020-04-25 13:40:40', 'no', 'yes', 'no'),
(28, 'yeah', 'newtestuser', 'Hey what\'s up', '2020-04-27 13:58:27', 'yes', 'yes', 'no'),
(29, 'yeah', 'newtestuser', 'sup dude', '2020-04-28 23:06:06', 'yes', 'yes', 'no'),
(30, 'yeah', 'newtestuser', 'why don\'t you upload a profile picture?', '2020-04-28 23:07:08', 'yes', 'yes', 'no'),
(31, 'sasuke', 'newtestuser', 'you are not friendly :( ', '2020-04-29 22:55:43', 'yes', 'yes', 'no'),
(32, 'newtestuser', 'sasuke', 'Chidoriiiiiii!!!', '2020-04-30 19:18:25', 'yes', 'yes', 'no'),
(33, 'sasuke', 'newtestuser', 'hello mate', '2020-05-02 14:15:31', 'yes', 'yes', 'no'),
(34, 'sasuke', 'newtestuser', 'asdad', '2020-05-02 14:17:51', 'yes', 'yes', 'no'),
(35, 'sasuke', 'newtestuser', 'asdad', '2020-05-02 14:20:29', 'yes', 'yes', 'no'),
(36, 'newtestuser', 'sasuke', 'wrote this in live version', '2020-05-03 15:39:14', 'yes', 'yes', 'no'),
(37, 'newtestuser', 'bluecat', 'how may i help you?\r\n', '2020-05-05 22:00:04', 'yes', 'yes', 'no'),
(38, 'bluecat', 'newtestuser', 'just want to say hi', '2020-05-06 19:55:09', 'no', 'yes', 'no'),
(39, 'tamnguyen', 'kingofsky95', 'hello', '2020-05-09 12:37:24', 'no', 'yes', 'no'),
(40, 'bluecat', 'newtestuser', 'asdawdad', '2020-05-10 14:05:21', 'no', 'yes', 'no'),
(41, 'newtestuser', 'yeah', 'hey\r\n', '2020-05-10 14:06:18', 'yes', 'yes', 'no'),
(42, 'newtestuser', 'yeah', 'asdfasdf', '2020-05-10 14:06:48', 'yes', 'yes', 'no'),
(43, 'newtestuser', 'yeah', 'holy cow it works!', '2020-05-10 14:07:52', 'yes', 'yes', 'no'),
(44, 'yeah', 'yeah', 'fasdfasd\r\n', '2020-05-12 19:54:35', 'yes', 'yes', 'no'),
(45, 'yeah', 'yeah', 'rdgdfgdf', '2020-05-13 13:49:37', 'yes', 'yes', 'no'),
(46, 'anothertestuser', '', 'sdfsdf', '2020-05-17 19:48:33', 'no', 'no', 'no'),
(47, 'yeah', 'newtestuser', 'get to work!', '2020-05-18 00:14:43', 'yes', 'yes', 'no'),
(48, 'tamnguyen', 'saitama', 'hello\r\n', '2020-05-19 17:50:24', 'no', 'yes', 'no'),
(49, 'tamnguyen', 'saitama', 'again', '2020-05-19 17:50:31', 'no', 'yes', 'no'),
(50, 'saitama', 'yeah', 'Hey whats up?', '2020-05-20 15:41:11', 'no', 'yes', 'no'),
(51, 'saitama', 'yeah', 'Hey, basketball again tomorrow?', '2020-05-20 15:52:42', 'no', 'yes', 'no'),
(52, 'erenjaeger', 'yeah', 'Hey whats up?', '2020-05-20 16:32:05', 'no', 'yes', 'no'),
(53, 'erenjaeger', 'yeah', 'Hey want to play basketball sometime again?', '2020-05-20 16:33:11', 'no', 'yes', 'no'),
(54, 'erenjaeger', 'yeah', 'Hey!', '2020-05-20 16:34:49', 'no', 'yes', 'no'),
(55, 'erenjaeger', 'yeah', 'Hey!', '2020-05-20 16:37:33', 'no', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(1, '', 'newtestuser', 'Gavin Thomas liked on your post', 'post_page.php?id=53', '2020-04-29 22:42:39', 'no', 'no'),
(2, 'erenjaeger', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=53', '2020-04-29 22:42:57', 'yes', 'yes'),
(3, 'flipflop', 'newtestuser', 'Gavin Thomas commented on your profile post', 'post_page.php?id=53', '2020-04-29 22:42:57', 'no', 'no'),
(4, '', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=53', '2020-04-29 22:42:58', 'no', 'no'),
(5, 'sasuke', 'newtestuser', 'Gavin Thomas posted on your profile', 'post_page.php?id=61', '2020-04-29 22:55:18', 'no', 'yes'),
(6, 'newtestuser', 'sasuke', 'Sasuke Uchiha liked on your post', 'post_page.php?id=58', '2020-04-29 23:02:36', 'no', 'yes'),
(7, 'newtestuser', 'sasuke', 'Sasuke Uchiha commented on your post', 'post_page.php?id=20', '2020-04-29 23:02:59', 'no', 'yes'),
(8, 'newtestuser', 'sasuke', 'Sasuke Uchiha liked on your post', 'post_page.php?id=20', '2020-04-29 23:03:09', 'no', 'yes'),
(9, 'newtestuser', 'sasuke', 'Sasuke Uchiha liked on your post', 'post_page.php?id=17', '2020-04-29 23:03:12', 'no', 'yes'),
(10, 'newtestuser', 'sasuke', 'Sasuke Uchiha commented on your post', 'post_page.php?id=17', '2020-04-29 23:03:21', 'no', 'yes'),
(11, 'newtestuser', 'sasuke', 'Sasuke Uchiha liked on your post', 'post_page.php?id=61', '2020-04-30 19:48:52', 'yes', 'yes'),
(12, 'newtestuser', 'sasuke', 'Sasuke Uchiha posted on your profile', 'post_page.php?id=62', '2020-04-30 20:01:23', 'yes', 'yes'),
(13, 'sasuke', 'newtestuser', 'Gavin Thomas liked on your post', 'post_page.php?id=62', '2020-05-01 23:51:51', 'yes', 'yes'),
(14, 'sasuke', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=62', '2020-05-01 23:52:18', 'yes', 'yes'),
(15, 'sasuke', '', '  liked on your post', 'post_page.php?id=62', '2020-05-03 13:43:03', 'yes', 'yes'),
(16, 'sasuke', '', '  liked on your post', 'post_page.php?id=63', '2020-05-03 14:00:27', 'yes', 'yes'),
(17, 'sasuke', '', '  commented on your post', 'post_page.php?id=63', '2020-05-03 14:00:32', 'yes', 'yes'),
(18, 'newtestuser', '', '  commented on your post', 'post_page.php?id=61', '2020-05-03 14:00:54', 'yes', 'yes'),
(19, 'sasuke', '', '  commented on your profile post', 'post_page.php?id=61', '2020-05-03 14:00:54', 'no', 'yes'),
(20, 'sasuke', 'newtestuser', 'Gavin Thomas liked on your post', 'post_page.php?id=63', '2020-05-03 14:05:40', 'yes', 'yes'),
(21, 'sasuke', '', '  commented on your post', 'post_page.php?id=63', '2020-05-03 14:06:16', 'yes', 'yes'),
(22, 'sasuke', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=63', '2020-05-03 14:06:34', 'yes', 'yes'),
(23, '', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=63', '2020-05-03 14:06:35', 'no', 'no'),
(24, 'sasuke', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=63', '2020-05-03 15:00:42', 'yes', 'yes'),
(25, '', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=63', '2020-05-03 15:00:42', 'no', 'no'),
(26, '', 'sasuke', 'Sasuke Uchiha commented on a post you commented on', 'post_page.php?id=63', '2020-05-03 15:04:11', 'no', 'no'),
(27, 'newtestuser', 'sasuke', 'Sasuke Uchiha commented on a post you commented on', 'post_page.php?id=63', '2020-05-03 15:04:11', 'yes', 'yes'),
(28, 'newtestuser', '', '  liked on your post', 'post_page.php?id=61', '2020-05-04 20:41:44', 'no', 'yes'),
(29, 'shu', 'erenjaeger', 'Eren Jaeger posted on your profile', 'post_page.php?id=64', '2020-05-05 21:07:11', 'yes', 'yes'),
(30, 'erenjaeger', 'shu', 'Shu Ouma liked on your post', 'post_page.php?id=64', '2020-05-05 21:07:36', 'yes', 'yes'),
(31, 'erenjaeger', 'shu', 'Shu Ouma commented on your post', 'post_page.php?id=64', '2020-05-05 21:07:50', 'yes', 'yes'),
(32, 'newtestuser', '', '  liked on your post', 'post_page.php?id=60', '2020-05-05 21:59:31', 'yes', 'yes'),
(33, 'newtestuser', '', '  liked on your post', 'post_page.php?id=59', '2020-05-05 21:59:32', 'no', 'yes'),
(34, 'newtestuser', '', '  liked on your post', 'post_page.php?id=58', '2020-05-05 21:59:33', 'no', 'yes'),
(35, 'newtestuser', '', '  liked on your post', 'post_page.php?id=57', '2020-05-05 22:00:13', 'no', 'yes'),
(36, 'newtestuser', '', '  liked on your post', 'post_page.php?id=22', '2020-05-05 22:00:37', 'no', 'yes'),
(37, 'newtestuser', '', '  liked on your post', 'post_page.php?id=21', '2020-05-05 22:00:38', 'no', 'yes'),
(38, 'newtestuser', '', '  liked on your post', 'post_page.php?id=17', '2020-05-05 22:00:45', 'no', 'yes'),
(39, 'tamnguyen', 'newtestuser', 'Gavin Thomas posted on your profile', 'post_page.php?id=65', '2020-05-06 19:23:32', 'yes', 'yes'),
(40, 'erenjaeger', 'newtestuser', 'Gavin Thomas liked on your post', 'post_page.php?id=64', '2020-05-06 19:24:04', 'yes', 'yes'),
(41, 'newtestuser', 'bluecat', 'Blue Cat liked on your post', 'post_page.php?id=60', '2020-05-06 19:24:45', 'yes', 'yes'),
(42, 'newtestuser', 'bluecat', 'Blue Cat liked on your post', 'post_page.php?id=58', '2020-05-06 19:24:49', 'no', 'yes'),
(43, 'newtestuser', 'bluecat', 'Blue Cat liked on your post', 'post_page.php?id=57', '2020-05-06 19:25:05', 'no', 'yes'),
(44, 'newtestuser', 'bluecat', 'Blue Cat liked on your post', 'post_page.php?id=65', '2020-05-06 19:25:15', 'yes', 'yes'),
(45, 'newtestuser', 'bluecat', 'Blue Cat commented on your post', 'post_page.php?id=65', '2020-05-06 19:25:21', 'yes', 'yes'),
(46, 'tamnguyen', 'bluecat', 'Blue Cat commented on your profile post', 'post_page.php?id=65', '2020-05-06 19:25:21', 'yes', 'yes'),
(47, 'newtestuser', 'kingofsky95', 'Eto Luu liked on your post', 'post_page.php?id=65', '2020-05-09 12:37:05', 'yes', 'yes'),
(48, 'newtestuser', '', '  liked on your post', 'post_page.php?id=65', '2020-05-09 14:13:01', 'yes', 'yes'),
(51, 'erenjaeger', 'newtestuser', 'The event Baseball that you joined was edited', '', '2020-05-10 13:09:27', 'no', 'yes'),
(52, 'erenjaeger', 'newtestuser', 'The event Baseball that you joined was edited', '', '2020-05-10 13:11:07', 'no', 'yes'),
(53, '', 'erenjaeger', 'The event Another Create from Khanh that you joined was edited', '', '2020-05-10 13:42:38', 'no', 'no'),
(54, 'erenjaeger', 'erenjaeger', 'The event Another Create from Khanh that you joined was edited', '', '2020-05-10 13:42:38', 'no', 'yes'),
(56, 'newtestuser', '', '  liked on your post', 'post_page.php?id=65', '2020-05-10 14:10:50', 'yes', 'yes'),
(57, 'newtestuser', '', '  liked on your post', 'post_page.php?id=65', '2020-05-10 14:10:53', 'yes', 'yes'),
(58, 'erenjaeger', '', '  liked on your post', 'post_page.php?id=26', '2020-05-10 14:11:37', 'no', 'yes'),
(59, '', 'newtestuser', 'The event tam event that you joined was edited', '', '2020-05-11 23:25:34', 'no', 'no'),
(60, 'newtestuser', 'newtestuser', 'The event Baseball that you created was edited', '', '2020-05-12 00:47:18', 'no', 'yes'),
(61, '', 'newtestuser', 'The event tam event that you joined was edited', '', '2020-05-12 00:48:13', 'no', 'no'),
(62, 'newtestuser', 'newtestuser', 'The event tam event that you created was edited', '', '2020-05-12 00:48:14', 'no', 'yes'),
(63, '', 'newtestuser', 'The event tam event that you joined was edited', '', '2020-05-12 00:51:45', 'no', 'no'),
(64, 'tamnguyen', 'newtestuser', 'The event tam event that you joined was edited', '', '2020-05-12 00:51:46', 'no', 'yes'),
(65, 'newtestuser', 'newtestuser', 'The event tam event that you created was edited', '', '2020-05-12 00:51:46', 'no', 'yes'),
(66, 'yeah', 'newtestuser', 'Member newtestuser had left the event testEv.', '', '2020-05-12 01:01:57', 'no', 'yes'),
(67, 'newtestuser', 'newtestuser', 'You had left the event testEv.', '', '2020-05-12 01:01:57', 'no', 'yes'),
(68, 'newtestuser', 'newtestuser', 'You had deleted the event .', '', '2020-05-12 01:03:47', 'no', 'yes'),
(69, 'tamnguyen', 'newtestuser', 'The event test that you joined was edited.', '', '2020-05-12 01:34:25', 'no', 'yes'),
(70, 'newtestuser', 'newtestuser', 'You had edited the event test.', '', '2020-05-12 01:34:25', 'no', 'yes'),
(71, 'tamnguyen', 'tamnguyen', 'Member tamnguyen had left the event test.', '', '2020-05-12 01:39:29', 'no', 'yes'),
(72, 'tamnguyen', 'tamnguyen', 'You had left the event test.', '', '2020-05-12 01:39:29', 'no', 'yes'),
(73, 'tamnguyen', 'tamnguyen', 'You had left the event test.', '', '2020-05-12 01:41:34', 'no', 'yes'),
(74, 'newtestuser', '', '  liked on your post', 'post_page.php?id=74', '2020-05-12 02:44:06', 'no', 'yes'),
(75, 'newtestuser', '', '  liked on your post', 'post_page.php?id=73', '2020-05-12 02:44:07', 'no', 'yes'),
(76, 'newtestuser', '', '  liked on your post', 'post_page.php?id=72', '2020-05-12 02:44:09', 'no', 'yes'),
(77, 'newtestuser', '', '  liked on your post', 'post_page.php?id=71', '2020-05-12 02:44:12', 'no', 'yes'),
(78, 'yeah', 'yeah', 'The event  that you joined was edited', '', '2020-05-12 14:16:26', 'no', 'yes'),
(79, 'ProZude', 'yeah', 'The event  that you joined was edited', '', '2020-05-12 14:16:26', 'no', 'yes'),
(80, 'testingmy-events', 'yeah', 'The event  that you joined was edited', '', '2020-05-12 14:16:26', 'no', 'no'),
(81, 'testing5-9', 'yeah', 'The event  that you joined was edited', '', '2020-05-12 14:16:26', 'no', 'no'),
(82, 'newtestuser', 'yeah', 'The event  that you joined was edited', '', '2020-05-12 14:16:27', 'no', 'yes'),
(83, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 14:47:56', 'no', 'yes'),
(84, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 14:55:52', 'no', 'yes'),
(85, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 14:57:42', 'no', 'yes'),
(86, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 14:58:55', 'no', 'yes'),
(87, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 15:01:53', 'no', 'yes'),
(88, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 15:03:55', 'no', 'yes'),
(89, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 16:13:46', 'no', 'yes'),
(90, 'yeah', 'yeah', 'The event testEv that you joined was edited', '', '2020-05-12 16:20:24', 'no', 'yes'),
(91, 'tamnguyen', 'newtestuser', 'The event name of event that you joined was edited.', '', '2020-05-12 22:47:44', 'no', 'yes'),
(92, 'newtestuser', 'newtestuser', 'You had edited the event name of event.', '', '2020-05-12 22:47:45', 'no', 'yes'),
(93, 'tamnguyen', 'newtestuser', 'The event name of event that you joined was edited.', '', '2020-05-12 22:57:25', 'no', 'yes'),
(94, 'tamnguyen2', 'newtestuser', 'The event name of event that you joined was edited.', '', '2020-05-12 22:57:26', 'no', 'yes'),
(95, 'newtestuser', 'newtestuser', 'You had edited the event name of event.', '', '2020-05-12 22:57:26', 'no', 'yes'),
(96, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 had left the event name of event.', '', '2020-05-12 23:13:18', 'no', 'yes'),
(97, 'tamnguyen2', 'tamnguyen2', 'Member tamnguyen2 had left the event name of event.', '', '2020-05-12 23:13:18', 'no', 'yes'),
(98, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 had left the event name of event.', '', '2020-05-12 23:13:18', 'no', 'yes'),
(99, 'tamnguyen2', 'tamnguyen2', 'You had left the event name of event.', '', '2020-05-12 23:13:18', 'no', 'yes'),
(100, 'tamnguyen2', 'tamnguyen', 'Member tamnguyen had left the event name of event.', '', '2020-05-12 23:15:34', 'no', 'yes'),
(101, 'newtestuser', 'tamnguyen', 'Member tamnguyen had left the event name of event.', '', '2020-05-12 23:15:34', 'no', 'yes'),
(102, 'tamnguyen', 'tamnguyen', 'You had left the event name of event.', '', '2020-05-12 23:15:35', 'no', 'yes'),
(103, 'tamnguyen', 'newtestuser', 'The event name of event that you joined was deleted.', '', '2020-05-12 23:42:41', 'no', 'yes'),
(104, 'tamnguyen2', 'newtestuser', 'The event name of event that you joined was deleted.', '', '2020-05-12 23:42:41', 'no', 'yes'),
(105, 'newtestuser', 'newtestuser', 'You had deleted the event name of event.', '', '2020-05-12 23:42:41', 'no', 'yes'),
(106, '', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-12 23:49:46', 'no', 'no'),
(107, 'tamnguyen2', 'tamnguyen2', 'You had edited the event test name.', '', '2020-05-12 23:49:47', 'no', 'yes'),
(108, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited', '', '2020-05-13 00:16:36', 'no', 'yes'),
(109, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited', '', '2020-05-13 00:16:58', 'no', 'yes'),
(110, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited', '', '2020-05-13 00:46:37', 'no', 'yes'),
(111, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-13 01:21:31', 'no', 'yes'),
(112, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:21:31', 'no', 'yes'),
(113, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-13 01:37:22', 'no', 'yes'),
(114, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:37:22', 'no', 'yes'),
(115, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-13 01:37:55', 'no', 'yes'),
(116, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:37:55', 'no', 'yes'),
(117, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-13 01:38:17', 'no', 'yes'),
(118, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:38:17', 'no', 'yes'),
(119, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:39:26', 'no', 'yes'),
(120, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited', '', '2020-05-13 01:47:48', 'no', 'yes'),
(121, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited', '', '2020-05-13 01:48:09', 'no', 'yes'),
(122, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:52:51', 'no', 'yes'),
(123, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 01:57:02', 'no', 'yes'),
(124, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 02:07:36', 'no', 'yes'),
(125, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 02:09:14', 'no', 'yes'),
(126, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 02:18:35', 'no', 'yes'),
(127, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-13 02:19:55', 'no', 'yes'),
(128, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 02:19:55', 'no', 'yes'),
(129, 'tamnguyen', 'tamnguyen2', 'The event test name that you joined was edited.', '', '2020-05-13 02:20:21', 'no', 'yes'),
(130, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 02:20:21', 'no', 'yes'),
(131, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 10:42:05', 'no', 'yes'),
(132, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 10:42:45', 'no', 'yes'),
(133, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-13 11:02:25', 'no', 'yes'),
(134, 'erenjaeger', '', '  liked on your post', 'post_page.php?id=64', '2020-05-13 12:30:58', 'no', 'yes'),
(135, '', 'ProZude', 'Member ProZude had left the event .', '', '2020-05-13 15:07:09', 'no', 'no'),
(136, '', 'ProZude', 'Member ProZude had left the event .', '', '2020-05-13 15:34:20', 'no', 'no'),
(137, 'tamnguyen', 'yeah', 'Member yeah had left the event test name.', '', '2020-05-14 14:34:16', 'no', 'yes'),
(138, 'tamnguyen2', 'yeah', 'Member yeah had left the event test name.', '', '2020-05-14 14:34:16', 'no', 'yes'),
(139, 'tamnguyen2', 'yeah', 'Member yeah had left the event test name.', '', '2020-05-14 14:34:16', 'no', 'yes'),
(140, 'yeah', 'yeah', 'You had left the event test name.', '', '2020-05-14 14:34:17', 'no', 'yes'),
(141, '', 'yeah', 'Member yeah had left the event .', '', '2020-05-14 14:34:28', 'no', 'no'),
(142, 'yeah', 'yeah', 'You had left the event FU SIDUGH.', '', '2020-05-14 14:34:28', 'no', 'yes'),
(143, '', 'yeah', 'Member yeah had left the event .', '', '2020-05-14 14:49:38', 'no', 'no'),
(144, 'yeah', 'yeah', 'You had left the event FU SIDUGH.', '', '2020-05-14 14:49:38', 'no', 'yes'),
(145, 'tamnguyen', 'tamnguyen2', 'The event tam event that you joined was edited.', '', '2020-05-16 16:59:14', 'no', 'yes'),
(146, 'tamnguyen2', 'tamnguyen2', 'The event tam event that you joined was edited.', '', '2020-05-16 16:59:14', 'no', 'yes'),
(147, 'tamnguyen2', 'tamnguyen2', 'You had edited the event .', '', '2020-05-16 16:59:14', 'no', 'yes'),
(148, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:19:59', 'no', 'yes'),
(149, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:20:00', 'no', 'yes'),
(150, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:20:00', 'no', 'yes'),
(151, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 17:20:00', 'no', 'yes'),
(152, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:21:31', 'no', 'yes'),
(153, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:21:31', 'no', 'yes'),
(154, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:21:31', 'no', 'yes'),
(155, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 17:21:31', 'no', 'yes'),
(156, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:29:13', 'no', 'yes'),
(157, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:29:13', 'no', 'yes'),
(158, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:29:13', 'no', 'yes'),
(159, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 17:29:13', 'no', 'yes'),
(160, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:29:45', 'no', 'yes'),
(161, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:29:46', 'no', 'yes'),
(162, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:29:46', 'no', 'yes'),
(163, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 17:29:46', 'no', 'yes'),
(164, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:48:05', 'no', 'yes'),
(165, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:48:05', 'no', 'yes'),
(166, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:48:05', 'no', 'yes'),
(167, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 17:48:05', 'no', 'yes'),
(168, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:56:52', 'no', 'yes'),
(169, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:56:52', 'no', 'yes'),
(170, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 17:56:53', 'no', 'yes'),
(171, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 17:56:53', 'no', 'yes'),
(172, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 18:11:57', 'no', 'yes'),
(173, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 18:11:57', 'no', 'yes'),
(174, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 18:11:57', 'no', 'yes'),
(175, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 18:38:00', 'no', 'yes'),
(176, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event Hi.', '', '2020-05-16 18:38:00', 'no', 'yes'),
(177, 'tamnguyen2', 'tamnguyen2', 'You have left the event Hi.', '', '2020-05-16 18:38:00', 'no', 'yes'),
(178, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 18:41:12', 'no', 'yes'),
(179, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 18:41:12', 'no', 'yes'),
(180, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 18:41:12', 'no', 'yes'),
(181, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:12:39', 'no', 'yes'),
(182, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:12:39', 'no', 'yes'),
(183, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 23:12:39', 'no', 'yes'),
(184, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:19:15', 'no', 'yes'),
(185, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:19:15', 'no', 'yes'),
(186, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 23:19:15', 'no', 'yes'),
(187, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:20:35', 'no', 'yes'),
(188, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:20:35', 'no', 'yes'),
(189, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 23:20:35', 'no', 'yes'),
(190, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:33:51', 'no', 'yes'),
(191, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:33:51', 'no', 'yes'),
(192, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 23:33:51', 'no', 'yes'),
(193, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:37:31', 'no', 'yes'),
(194, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:37:31', 'no', 'yes'),
(195, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 23:37:31', 'no', 'yes'),
(196, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:40:18', 'no', 'yes'),
(197, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-16 23:40:18', 'no', 'yes'),
(198, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-16 23:40:18', 'no', 'yes'),
(199, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:14:56', 'no', 'yes'),
(200, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:14:56', 'no', 'yes'),
(201, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:14:56', 'no', 'yes'),
(202, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:16:12', 'no', 'yes'),
(203, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:16:12', 'no', 'yes'),
(204, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:16:12', 'no', 'yes'),
(205, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:18:53', 'no', 'yes'),
(206, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:18:53', 'no', 'yes'),
(207, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:18:53', 'no', 'yes'),
(208, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:19:24', 'no', 'yes'),
(209, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:19:24', 'no', 'yes'),
(210, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:19:24', 'no', 'yes'),
(211, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:20:57', 'no', 'yes'),
(212, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:20:57', 'no', 'yes'),
(213, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:20:57', 'no', 'yes'),
(214, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:23:06', 'no', 'yes'),
(215, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:23:06', 'no', 'yes'),
(216, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:23:06', 'no', 'yes'),
(217, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:24:26', 'no', 'yes'),
(218, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:24:26', 'no', 'yes'),
(219, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:24:26', 'no', 'yes'),
(220, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:25:45', 'no', 'yes'),
(221, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:25:45', 'no', 'yes'),
(222, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:25:45', 'no', 'yes'),
(223, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:27:30', 'no', 'yes'),
(224, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:27:30', 'no', 'yes'),
(225, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:27:30', 'no', 'yes'),
(226, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:31:15', 'no', 'yes'),
(227, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:31:15', 'no', 'yes'),
(228, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:31:15', 'no', 'yes'),
(229, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:34:01', 'no', 'yes'),
(230, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:34:01', 'no', 'yes'),
(231, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:34:01', 'no', 'yes'),
(232, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:35:47', 'no', 'yes'),
(233, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:35:47', 'no', 'yes'),
(234, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:35:47', 'no', 'yes'),
(235, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:36:48', 'no', 'yes'),
(236, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:36:48', 'no', 'yes'),
(237, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:36:48', 'no', 'yes'),
(238, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:37:48', 'no', 'yes'),
(239, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:37:48', 'no', 'yes'),
(240, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:37:48', 'no', 'yes'),
(241, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:41:34', 'no', 'yes'),
(242, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:41:34', 'no', 'yes'),
(243, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:41:34', 'no', 'yes'),
(244, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:42:35', 'no', 'yes'),
(245, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:42:35', 'no', 'yes'),
(246, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:42:35', 'no', 'yes'),
(247, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:49:58', 'no', 'yes'),
(248, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:49:58', 'no', 'yes'),
(249, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:49:58', 'no', 'yes'),
(250, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:52:25', 'no', 'yes'),
(251, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:52:25', 'no', 'yes'),
(252, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:52:25', 'no', 'yes'),
(253, 'ProZude', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:54:38', 'no', 'yes'),
(254, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event maxtest1.', '', '2020-05-17 00:54:38', 'no', 'yes'),
(255, 'tamnguyen2', 'tamnguyen2', 'You have left the event maxtest1.', '', '2020-05-17 00:54:38', 'no', 'yes'),
(256, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:34:10', 'no', 'yes'),
(257, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:34:10', 'no', 'yes'),
(258, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:34:10', 'no', 'yes'),
(259, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:36:53', 'no', 'yes'),
(260, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:36:53', 'no', 'yes'),
(261, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:36:53', 'no', 'yes'),
(262, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:42:08', 'no', 'yes'),
(263, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:42:08', 'no', 'yes'),
(264, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:42:08', 'no', 'yes'),
(265, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:43:25', 'no', 'yes'),
(266, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:43:25', 'no', 'yes'),
(267, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:43:25', 'no', 'yes'),
(268, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:44:10', 'no', 'yes'),
(269, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:44:10', 'no', 'yes'),
(270, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:44:10', 'no', 'yes'),
(271, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:45:52', 'no', 'yes'),
(272, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:45:52', 'no', 'yes'),
(273, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:45:52', 'no', 'yes'),
(274, 'tamnguyen2', 'tamnguyen2', 'You have left the event test name.', '', '2020-05-17 01:45:52', 'no', 'yes'),
(275, 'newtestuser', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:48:16', 'no', 'yes'),
(276, 'tamnguyen', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:48:16', 'no', 'yes'),
(277, 'yeah', 'tamnguyen2', 'Member tamnguyen2 has left the event test name.', '', '2020-05-17 01:48:16', 'no', 'yes'),
(278, 'tamnguyen2', 'tamnguyen2', 'You have left the event test name.', '', '2020-05-17 01:48:16', 'no', 'yes'),
(279, 'newtestuser', 'tamnguyen', 'Member tamnguyen has left the event test name.', '', '2020-05-17 01:53:39', 'no', 'yes'),
(280, 'yeah', 'tamnguyen', 'Member tamnguyen has left the event test name.', '', '2020-05-17 01:53:39', 'no', 'yes'),
(281, 'tamnguyen', 'tamnguyen', 'You have left the event test name.', '', '2020-05-17 01:53:39', 'no', 'yes'),
(282, 'tamnguyen', 'tamnguyen', 'You had edited the event Tam 1.', '', '2020-05-17 01:57:29', 'no', 'yes'),
(283, 'tamnguyen', 'tamnguyen', 'You had deleted the event Tam 1.', '', '2020-05-17 01:58:04', 'no', 'yes'),
(284, 'newtestuser', 'tamnguyen', 'The event test name that you joined was edited.', '', '2020-05-17 11:42:46', 'no', 'yes'),
(285, 'tamnguyen', 'tamnguyen', 'You had edited the event test name.', '', '2020-05-17 11:42:46', 'no', 'yes'),
(286, 'newtestuser', 'tamnguyen', 'The event test name that you joined was edited.', '', '2020-05-17 11:48:15', 'no', 'yes'),
(287, 'tamnguyen', 'tamnguyen', 'You had edited the event test name.', '', '2020-05-17 11:48:17', 'no', 'yes'),
(288, 'newtestuser', 'tamnguyen', 'The event test name that you joined was edited.', '', '2020-05-17 11:50:01', 'no', 'yes'),
(289, 'tamnguyen', 'tamnguyen', 'You had edited the event test name.', '', '2020-05-17 11:50:04', 'no', 'yes'),
(290, 'newtestuser', 'tamnguyen', 'The event test name that you joined was edited.', '', '2020-05-17 11:51:56', 'no', 'yes'),
(291, 'tamnguyen', 'tamnguyen', 'You had edited the event test name.', '', '2020-05-17 11:51:58', 'no', 'yes'),
(292, 'newtestuser', 'tamnguyen', 'The event test name that you joined was edited.', '', '2020-05-17 11:55:05', 'no', 'yes'),
(293, 'tamnguyen', 'tamnguyen', 'You had edited the event test name.', '', '2020-05-17 11:55:07', 'no', 'yes'),
(294, 'newtestuser', 'tamnguyen', 'The event test name that you joined was edited.', '', '2020-05-17 11:58:18', 'no', 'yes'),
(295, 'tamnguyen', 'tamnguyen', 'You had edited the event test name.', '', '2020-05-17 11:58:18', 'no', 'yes'),
(296, 'tamnguyen', 'tamnguyen', 'You had deleted the event tam 2.', '', '2020-05-17 12:02:22', 'no', 'yes'),
(297, 'tamnguyen', 'tamnguyen', 'You had deleted the event tam 2.', '', '2020-05-17 12:03:45', 'no', 'yes'),
(298, 'tamnguyen', 'tamnguyen2', 'The event test name 2 that you joined was edited.', '', '2020-05-17 12:07:01', 'no', 'yes'),
(299, 'tamnguyen2', 'tamnguyen2', 'You had edited the event test name 2.', '', '2020-05-17 12:07:01', 'no', 'yes'),
(300, '', 'tamnguyen', 'Member tamnguyen has left the event .', '', '2020-05-17 12:10:36', 'no', 'no'),
(301, 'tamnguyen', 'tamnguyen', 'You have left the event test name 2.', '', '2020-05-17 12:10:36', 'no', 'yes'),
(302, 'tamnguyen', 'tamnguyen2', 'The event test name 2 that you joined was deleted.', '', '2020-05-17 12:11:16', 'no', 'yes'),
(303, 'tamnguyen2', 'tamnguyen2', 'You had deleted the event test name 2.', '', '2020-05-17 12:11:16', 'no', 'yes'),
(304, 'newtestuser', 'tamnguyen', 'The event test name that you joined was deleted.', '', '2020-05-17 12:17:25', 'no', 'yes'),
(305, 'tamnguyen', 'tamnguyen', 'You had deleted the event test name.', '', '2020-05-17 12:17:27', 'no', 'yes'),
(306, 'tamnguyen', 'tamnguyen2', 'The event tam event that you joined was deleted.', '', '2020-05-17 12:20:42', 'no', 'yes'),
(307, 'tamnguyen2', 'tamnguyen2', 'You had deleted the event tam event.', '', '2020-05-17 12:20:44', 'no', 'yes'),
(308, 'tamnguyen2', 'tamnguyen', 'The event tam 1 that you joined was deleted.', '', '2020-05-17 12:24:59', 'no', 'yes'),
(309, 'tamnguyen', 'tamnguyen', 'You had deleted the event tam 1.', '', '2020-05-17 12:24:59', 'no', 'yes'),
(310, 'tamnguyen2', 'tamnguyen', 'The event tam 1 that you joined was deleted.', '', '2020-05-17 12:32:56', 'no', 'yes'),
(311, 'tamnguyen', 'tamnguyen', 'You had deleted the event tam 1.', '', '2020-05-17 12:32:56', 'no', 'yes'),
(312, 'ProZude', 'tamnguyen', 'Member tamnguyen has joined the event maxtest1.', '', '2020-05-17 13:03:33', 'no', 'yes'),
(313, 'yeah', 'tamnguyen', 'Member tamnguyen joined the event maxtest1.', '', '2020-05-17 13:03:35', 'no', 'yes'),
(314, 'tamnguyen', 'tamnguyen', 'You have joined the event .', '', '2020-05-17 13:03:38', 'no', 'yes'),
(315, 'ProZude', 'tamnguyen', 'Member tamnguyen has left the event maxtest1.', '', '2020-05-17 13:05:52', 'no', 'yes'),
(316, 'yeah', 'tamnguyen', 'Member tamnguyen has left the event maxtest1.', '', '2020-05-17 13:05:54', 'no', 'yes'),
(317, 'tamnguyen', 'tamnguyen', 'You have left the event maxtest1.', '', '2020-05-17 13:05:57', 'no', 'yes'),
(318, 'tamnguyen', 'tamnguyen', 'You had edited the event event 3.', '', '2020-05-17 13:06:21', 'no', 'yes'),
(319, '', 'tamnguyen2', 'Member tamnguyen2 joined the event .', '', '2020-05-17 13:08:27', 'no', 'no'),
(320, 'tamnguyen2', 'tamnguyen2', 'You have joined the event .', '', '2020-05-17 13:08:27', 'no', 'yes'),
(321, '', 'tamnguyen2', 'Member tamnguyen2 joined the event .', '', '2020-05-17 13:10:24', 'no', 'no'),
(322, 'tamnguyen2', 'tamnguyen2', 'You have joined the event .', '', '2020-05-17 13:10:24', 'no', 'yes'),
(323, 'tamnguyen', 'yeah', 'The event maxtest1 that you joined was edited.', '', '2020-05-17 15:09:33', 'no', 'yes'),
(324, 'ProZude', 'yeah', 'The event maxtest1 that you joined was edited.', '', '2020-05-17 15:09:35', 'no', 'yes'),
(325, 'yeah', 'yeah', 'You had edited the event maxtest1.', '', '2020-05-17 15:09:38', 'no', 'yes'),
(326, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:11:47', 'no', 'yes'),
(327, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:11:50', 'no', 'yes'),
(328, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:13:48', 'no', 'yes'),
(329, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:13:50', 'no', 'yes'),
(330, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:15:08', 'no', 'yes'),
(331, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:15:10', 'no', 'yes'),
(332, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:16:31', 'no', 'yes'),
(333, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:16:33', 'no', 'yes'),
(334, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:18:20', 'no', 'yes'),
(335, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:18:23', 'no', 'yes'),
(336, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:19:21', 'no', 'yes'),
(337, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:19:23', 'no', 'yes'),
(338, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:21:05', 'no', 'yes'),
(339, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:21:07', 'no', 'yes'),
(340, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:25:34', 'no', 'yes'),
(341, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:25:36', 'no', 'yes'),
(342, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:26:20', 'no', 'yes'),
(343, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:26:22', 'no', 'yes'),
(344, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:26:42', 'no', 'yes'),
(345, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:26:44', 'no', 'yes'),
(346, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:27:18', 'no', 'yes'),
(347, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:27:20', 'no', 'yes'),
(348, 'tamnguyen', 'yeah', 'The event Hi that you joined was edited.', '', '2020-05-17 15:30:30', 'no', 'yes'),
(349, 'yeah', 'yeah', 'You had edited the event Hi.', '', '2020-05-17 15:30:32', 'no', 'yes'),
(350, 'newtestuser', 'yeah', 'Member yeah has left the event event 2.', '', '2020-05-17 15:50:01', 'no', 'yes'),
(351, 'tamnguyen2', 'yeah', 'Member yeah has left the event event 2.', '', '2020-05-17 15:50:03', 'no', 'no'),
(352, 'yeah', 'yeah', 'You have left the event event 2.', '', '2020-05-17 15:50:06', 'no', 'yes'),
(353, 'tamnguyen', 'tamnguyen', 'You had edited the event tam test 1.', '', '2020-05-17 22:08:13', 'no', 'yes'),
(354, 'tamnguyen', 'yeah', 'The event maxtest1 that you joined was edited.', '', '2020-05-18 14:05:36', 'no', 'yes'),
(355, 'ProZude', 'yeah', 'The event maxtest1 that you joined was edited.', '', '2020-05-18 14:05:39', 'no', 'yes'),
(356, 'yeah', 'yeah', 'You had edited the event maxtest1.', '', '2020-05-18 14:05:41', 'no', 'yes'),
(362, 'tamnguyen', 'yeah', 'The event maxtest1 that you joined was edited.', '', '2020-05-18 14:07:43', 'no', 'yes'),
(363, 'ProZude', 'yeah', 'The event maxtest1 that you joined was edited.', '', '2020-05-18 14:07:45', 'no', 'yes'),
(364, 'yeah', 'yeah', 'You had edited the event maxtest1.', '', '2020-05-18 14:07:48', 'no', 'yes'),
(365, 'saitama', 'newtestuser', 'Gavin Thomas liked on your post', 'post_page.php?id=76', '2020-05-18 14:16:42', 'no', 'yes'),
(366, 'newtestuser', 'saitama', 'Saitama Â?イタマ liked on your post', 'post_page.php?id=65', '2020-05-18 14:25:40', 'yes', 'yes'),
(367, 'yeah', 'saitama', 'Saitama Â?イタマ posted on your profile', 'post_page.php?id=88', '2020-05-18 14:26:30', 'yes', 'yes'),
(368, 'saitama', 'tamnguyen', 'Tam Nguyen posted on your profile', 'post_page.php?id=89', '2020-05-18 14:35:33', 'no', 'yes'),
(372, 'tamnguyen', 'saitama', 'Saitama Â?イタマ posted on your profile', 'post_page.php?id=90', '2020-05-18 14:37:56', 'no', 'yes'),
(373, 'saitama', 'bluecat', 'Blue Cat posted on your profile', 'post_page.php?id=92', '2020-05-18 15:16:19', 'yes', 'yes'),
(374, 'newtestuser', '', '  liked on your post', 'post_page.php?id=93', '2020-05-19 18:07:50', 'yes', 'yes'),
(375, 'bluecat', '', '  liked on your post', 'post_page.php?id=92', '2020-05-19 18:07:53', 'yes', 'yes'),
(376, 'newtestuser', 'yeah', 'Member yeah has left the event Swimming Competition .', '', '2020-05-20 14:59:30', 'no', 'yes'),
(377, 'sasuke', 'yeah', 'Member yeah has left the event Swimming Competition .', '', '2020-05-20 14:59:33', 'no', 'yes'),
(378, 'yeah', 'yeah', 'You have left the event Swimming Competition .', '', '2020-05-20 14:59:35', 'no', 'yes'),
(379, '', 'yeah', 'Member yeah has left the event .', '', '2020-05-20 15:22:37', 'no', 'no'),
(380, 'yeah', 'yeah', 'You have left the event Eric Basketball Event.', '', '2020-05-20 15:22:40', 'no', 'yes'),
(381, 'newtestuser', 'yeah', 'Member yeah has left the event event 2.', '', '2020-05-20 15:38:30', 'no', 'yes'),
(382, 'tamnguyen2', 'yeah', 'Member yeah has left the event event 2.', '', '2020-05-20 15:38:30', 'no', 'no'),
(383, 'yeah', 'yeah', 'You have left the event event 2.', '', '2020-05-20 15:38:30', 'no', 'yes'),
(384, '', 'yeah', 'Member yeah has left the event .', '', '2020-05-20 15:38:34', 'no', 'no'),
(385, 'yeah', 'yeah', 'You have left the event tam test 1.', '', '2020-05-20 15:38:34', 'no', 'yes'),
(386, 'newtestuser', 'yeah', 'Member yeah has left the event Swimming Competition .', '', '2020-05-20 15:38:39', 'no', 'yes'),
(387, 'sasuke', 'yeah', 'Member yeah has left the event Swimming Competition .', '', '2020-05-20 15:38:39', 'no', 'yes'),
(388, 'yeah', 'yeah', 'You have left the event Swimming Competition .', '', '2020-05-20 15:38:39', 'no', 'yes'),
(389, '', 'yeah', 'Member yeah has left the event .', '', '2020-05-20 15:51:30', 'no', 'no'),
(390, 'yeah', 'yeah', 'You have left the event Eric Basketball Event.', '', '2020-05-20 15:51:30', 'no', 'yes'),
(391, 'yeah', 'yeah', 'You had deleted the event BBall Game.', '', '2020-05-20 16:18:45', 'no', 'yes'),
(392, 'tamnguyen2', 'yeah', 'Member yeah has left the event event 3.', '', '2020-05-20 17:05:36', 'no', 'no'),
(393, 'tamnguyen', 'yeah', 'Member yeah has left the event event 3.', '', '2020-05-20 17:05:38', 'no', 'yes'),
(394, 'yeah', 'yeah', 'You have left the event event 3.', '', '2020-05-20 17:05:40', 'no', 'yes'),
(395, 'sasuke', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=63', '2020-05-21 01:43:10', 'yes', 'yes'),
(396, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=61', '2020-05-21 01:43:12', 'no', 'yes'),
(397, 'newtestuser', '', '  commented on your post', 'post_page.php?id=75', '2020-05-21 01:54:27', 'yes', 'yes'),
(398, 'yeah', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=94', '2020-05-21 02:01:35', 'yes', 'yes'),
(399, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=93', '2020-05-21 02:01:37', 'yes', 'yes'),
(400, 'yeah', 'erenjaeger', 'Eren Jaeger commented on your post', 'post_page.php?id=94', '2020-05-21 02:03:14', 'yes', 'yes'),
(401, 'newtestuser', '', '  commented on your post', 'post_page.php?id=93', '2020-05-21 02:03:58', 'yes', 'yes'),
(402, 'bluecat', '', '  commented on your post', 'post_page.php?id=92', '2020-05-21 02:11:15', 'yes', 'yes'),
(403, 'saitama', '', '  commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:11:15', 'yes', 'yes'),
(404, 'saitama', 'bluecat', 'Blue Cat commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:14:08', 'yes', 'yes'),
(405, '', 'bluecat', 'Blue Cat commented on a post you commented on', 'post_page.php?id=92', '2020-05-21 02:14:08', 'no', 'no'),
(406, 'saitama', 'bluecat', 'Blue Cat commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:14:15', 'yes', 'yes'),
(407, '', 'bluecat', 'Blue Cat commented on a post you commented on', 'post_page.php?id=92', '2020-05-21 02:14:15', 'no', 'no'),
(408, 'bluecat', 'erenjaeger', 'Eren Jaeger commented on your post', 'post_page.php?id=92', '2020-05-21 02:14:51', 'yes', 'yes'),
(409, 'saitama', 'erenjaeger', 'Eren Jaeger commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:14:51', 'yes', 'yes'),
(410, '', 'erenjaeger', 'Eren Jaeger commented on a post you commented on', 'post_page.php?id=92', '2020-05-21 02:14:51', 'no', 'no'),
(411, 'erenjaeger', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:16:02', 'no', 'yes'),
(412, 'yeah', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=94', '2020-05-21 02:16:29', 'yes', 'yes'),
(413, 'erenjaeger', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=94', '2020-05-21 02:16:29', 'no', 'yes'),
(414, 'saitama', '', '  liked on your post', 'post_page.php?id=90', '2020-05-21 02:19:56', 'yes', 'yes'),
(415, 'saitama', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=90', '2020-05-21 02:20:05', 'yes', 'yes'),
(416, 'tamnguyen', 'newtestuser', 'Gavin Thomas commented on your profile post', 'post_page.php?id=90', '2020-05-21 02:20:05', 'no', 'yes'),
(417, 'saitama', '', '  liked on your post', 'post_page.php?id=88', '2020-05-21 02:20:09', 'yes', 'yes'),
(418, 'newtestuser', 'saitama', 'Saitama Â?イタマ liked on your post', 'post_page.php?id=93', '2020-05-21 02:31:09', 'yes', 'yes'),
(419, 'newtestuser', '', '  commented on your post', 'post_page.php?id=93', '2020-05-21 02:31:13', 'yes', 'yes'),
(420, 'erenjaeger', '', '  commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:31:13', 'no', 'yes'),
(421, 'saitama', 'newtestuser', 'Gavin Thomas liked on your post', 'post_page.php?id=90', '2020-05-21 02:33:05', 'yes', 'yes'),
(422, 'saitama', '', '  commented on your post', 'post_page.php?id=90', '2020-05-21 02:33:13', 'yes', 'yes'),
(423, 'tamnguyen', '', '  commented on your profile post', 'post_page.php?id=90', '2020-05-21 02:33:13', 'no', 'yes'),
(424, 'newtestuser', '', '  commented on a post you commented on', 'post_page.php?id=90', '2020-05-21 02:33:13', 'no', 'yes'),
(425, 'saitama', '', '  commented on your post', 'post_page.php?id=90', '2020-05-21 02:33:21', 'yes', 'yes'),
(426, 'tamnguyen', '', '  commented on your profile post', 'post_page.php?id=90', '2020-05-21 02:33:21', 'no', 'yes'),
(427, 'newtestuser', '', '  commented on a post you commented on', 'post_page.php?id=90', '2020-05-21 02:33:21', 'no', 'yes'),
(428, 'bluecat', '', '  commented on your post', 'post_page.php?id=92', '2020-05-21 02:33:45', 'yes', 'yes'),
(429, 'saitama', '', '  commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:33:45', 'yes', 'yes'),
(430, 'erenjaeger', '', '  commented on a post you commented on', 'post_page.php?id=92', '2020-05-21 02:33:45', 'no', 'yes'),
(431, 'bluecat', '', '  commented on your post', 'post_page.php?id=92', '2020-05-21 02:34:30', 'yes', 'yes'),
(432, 'saitama', '', '  commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:34:30', 'yes', 'yes'),
(433, 'erenjaeger', '', '  commented on a post you commented on', 'post_page.php?id=92', '2020-05-21 02:34:30', 'no', 'yes'),
(434, 'bluecat', '', '  commented on your post', 'post_page.php?id=92', '2020-05-21 02:34:39', 'yes', 'yes'),
(435, 'saitama', '', '  commented on your profile post', 'post_page.php?id=92', '2020-05-21 02:34:39', 'yes', 'yes'),
(436, 'erenjaeger', '', '  commented on a post you commented on', 'post_page.php?id=92', '2020-05-21 02:34:39', 'no', 'yes'),
(437, 'bluecat', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=92', '2020-05-21 02:36:08', 'yes', 'yes'),
(438, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=85', '2020-05-21 02:36:26', 'yes', 'yes'),
(439, 'newtestuser', '', '  commented on your post', 'post_page.php?id=85', '2020-05-21 02:36:32', 'yes', 'yes'),
(440, 'newtestuser', '', '  commented on your post', 'post_page.php?id=93', '2020-05-21 02:37:26', 'no', 'yes'),
(441, 'erenjaeger', '', '  commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:37:26', 'no', 'yes'),
(442, 'newtestuser', 'erenjaeger', 'Eren Jaeger commented on your post', 'post_page.php?id=93', '2020-05-21 02:38:07', 'no', 'yes'),
(443, '', 'erenjaeger', 'Eren Jaeger commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:38:07', 'no', 'no'),
(444, 'erenjaeger', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:38:51', 'no', 'yes'),
(445, '', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:38:51', 'no', 'no');
INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(446, 'newtestuser', 'shinchan', 'Shin-chan Kureyon liked on your post', 'post_page.php?id=93', '2020-05-21 02:39:45', 'no', 'yes'),
(447, 'newtestuser', 'shinchan', 'Shin-chan Kureyon commented on your post', 'post_page.php?id=93', '2020-05-21 02:39:55', 'no', 'yes'),
(448, 'erenjaeger', 'shinchan', 'Shin-chan Kureyon commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:39:55', 'no', 'yes'),
(449, 'newtestuser', 'shinchan', 'Shin-chan Kureyon liked on your post', 'post_page.php?id=85', '2020-05-21 02:40:38', 'yes', 'yes'),
(450, 'newtestuser', 'erenjaeger', 'Eren Jaeger commented on your post', 'post_page.php?id=93', '2020-05-21 02:43:32', 'no', 'yes'),
(451, 'shinchan', 'erenjaeger', 'Eren Jaeger commented on a post you commented on', 'post_page.php?id=93', '2020-05-21 02:43:32', 'no', 'no'),
(452, 'bluecat', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=91', '2020-05-21 02:43:52', 'yes', 'yes'),
(453, 'yeah', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=86', '2020-05-21 02:43:53', 'no', 'yes'),
(454, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=85', '2020-05-21 02:43:54', 'yes', 'yes'),
(455, 'newtestuser', 'shu', 'Shu Ouma liked on your post', 'post_page.php?id=93', '2020-05-23 02:53:10', 'no', 'yes'),
(456, 'erenjaeger', 'shu', 'Shu Ouma liked on your post', 'post_page.php?id=24', '2020-05-23 02:53:34', 'no', 'yes'),
(457, 'yeah', 'shu', 'Shu Ouma liked on your post', 'post_page.php?id=94', '2020-05-23 02:54:06', 'yes', 'yes'),
(458, 'tamnguyen', 'tamnguyen', 'You had edited the event Tam new test.', '', '2020-05-23 18:31:07', 'no', 'no'),
(459, 'yeah', 'tamnguyen', 'The event tam test 1 that you joined was edited.', '', '2020-05-23 18:32:35', 'no', 'yes'),
(460, 'tamnguyen', 'tamnguyen', 'You had edited the event tam test 1.', '', '2020-05-23 18:32:37', 'no', 'no'),
(461, 'yeah', 'tamnguyen', 'The event tam test 1 that you joined was edited.', '', '2020-05-23 18:34:45', 'no', 'yes'),
(462, 'tamnguyen', 'tamnguyen', 'You had edited the event tam test 1.', '', '2020-05-23 18:34:48', 'no', 'no'),
(463, 'yeah', 'tamnguyen', 'The event tam test 1 that you joined was edited.', '', '2020-05-23 18:35:53', 'no', 'yes'),
(464, 'tamnguyen', 'tamnguyen', 'You had edited the event tam test 1.', '', '2020-05-23 18:35:55', 'no', 'no'),
(465, 'yeah', 'tamnguyen', 'The event tam test 1 that you joined was edited.', '', '2020-05-23 18:37:12', 'no', 'yes'),
(466, 'tamnguyen', 'tamnguyen', 'You had edited the event tam test 1.', '', '2020-05-23 18:37:14', 'no', 'no'),
(467, 'yeah', 'tamnguyen', 'The event tam test 1 that you joined was edited.', '', '2020-05-23 18:39:53', 'no', 'yes'),
(468, 'tamnguyen', 'tamnguyen', 'You had edited the event tam test 1.', '', '2020-05-23 18:39:56', 'no', 'no'),
(469, 'sneakurtis', 'sneakurtis', 'You had deleted the event yes.', '', '2020-05-25 16:44:26', 'no', 'yes'),
(470, 'newtestuser', 'erenjaeger', 'Member erenjaeger has left the event Swimming Competition .', '', '2020-05-26 16:48:18', 'no', 'yes'),
(471, 'yeah', 'erenjaeger', 'Member erenjaeger has left the event Swimming Competition .', '', '2020-05-26 16:48:20', 'no', 'yes'),
(472, 'sasuke', 'erenjaeger', 'Member erenjaeger has left the event Swimming Competition .', '', '2020-05-26 16:48:22', 'no', 'no'),
(473, 'erenjaeger', 'erenjaeger', 'You have left the event Swimming Competition .', '', '2020-05-26 16:48:25', 'no', 'yes'),
(474, 'newtestuser', '', '  commented on your post', 'post_page.php?id=75', '2020-05-26 20:57:23', 'yes', 'yes'),
(475, 'sasuke', '', '  commented on a post you commented on', 'post_page.php?id=75', '2020-05-26 20:57:23', 'no', 'no'),
(476, 'newtestuser', '', '  commented on your post', 'post_page.php?id=75', '2020-05-26 20:59:42', 'yes', 'yes'),
(477, 'sasuke', '', '  commented on a post you commented on', 'post_page.php?id=75', '2020-05-26 20:59:42', 'no', 'no'),
(478, 'sasuke', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=75', '2020-05-26 21:02:15', 'no', 'no'),
(479, '', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=75', '2020-05-26 21:02:15', 'no', 'no'),
(480, 'sasuke', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=75', '2020-05-26 21:02:58', 'no', 'no'),
(481, '', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=75', '2020-05-26 21:02:58', 'no', 'no'),
(482, 'yeah', '', '  liked on your post', 'post_page.php?id=94', '2020-05-26 21:07:57', 'yes', 'yes'),
(483, 'bluecat', 'saitama', 'Saitama Â?イタマ commented on your post', 'post_page.php?id=92', '2020-05-26 21:12:31', 'yes', 'yes'),
(484, 'erenjaeger', 'saitama', 'Saitama Â?イタマ commented on a post you commented on', 'post_page.php?id=92', '2020-05-26 21:12:31', 'no', 'yes'),
(485, 'tamnguyen', 'tamnguyen', 'You had edited the event Tam new test.', '', '2020-05-29 12:35:47', 'no', 'no'),
(486, 'yeah', 'tamnguyen', 'The event Tam new test that you joined was edited.', '', '2020-05-29 12:38:16', 'no', 'yes'),
(487, 'tamnguyen', 'tamnguyen', 'You had edited the event Tam new test.', '', '2020-05-29 12:38:17', 'no', 'no'),
(488, 'newtestuser', '', '  liked on your post', 'post_page.php?id=85', '2020-05-29 22:58:31', 'no', 'yes'),
(489, 'bluecat', '', '  liked on your post', 'post_page.php?id=91', '2020-05-29 22:59:47', 'yes', 'yes'),
(490, 'newtestuser', '', '  liked on your post', 'post_page.php?id=84', '2020-05-29 23:02:03', 'no', 'yes'),
(491, 'newtestuser', '', '  liked on your post', 'post_page.php?id=75', '2020-05-29 23:02:06', 'yes', 'yes'),
(492, 'bluecat', 'newtestuser', 'Gavin Thomas commented on your post', 'post_page.php?id=92', '2020-05-29 23:02:53', 'no', 'no'),
(493, 'saitama', 'newtestuser', 'Gavin Thomas commented on your profile post', 'post_page.php?id=92', '2020-05-29 23:02:53', 'yes', 'yes'),
(494, 'erenjaeger', 'newtestuser', 'Gavin Thomas commented on a post you commented on', 'post_page.php?id=92', '2020-05-29 23:02:53', 'no', 'yes'),
(495, 'saitama', '', '  liked on your post', 'post_page.php?id=87', '2020-05-29 23:03:00', 'yes', 'yes'),
(496, 'erenjaeger', '', '  liked on your post', 'post_page.php?id=42', '2020-05-29 23:03:55', 'yes', 'yes'),
(497, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=84', '2020-05-30 01:08:31', 'no', 'no'),
(498, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=75', '2020-05-30 01:08:36', 'no', 'no'),
(499, 'newtestuser', 'erenjaeger', 'Eren Jaeger liked on your post', 'post_page.php?id=74', '2020-05-30 01:09:31', 'no', 'no');

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
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(11, 'first post', 'newtestuser', 'none', '2020-03-24 23:59:18', 'no', 'no', 0, ''),
(12, 'second post', 'newtestuser', 'none', '2020-04-02 23:40:45', 'no', 'no', 0, ''),
(13, 'I\'m doing the project during the Spring break yay!!!!', 'newtestuser', 'none', '2020-04-02 23:43:48', 'no', 'no', 0, ''),
(14, 'Hello there, check this out', 'anothertestuser', 'none', '2020-04-04 01:25:12', 'no', 'no', 0, ''),
(15, 'Hi again', 'anothertestuser', 'none', '2020-04-04 14:22:52', 'no', 'no', 0, ''),
(16, 'we should work together', 'newtestuser', 'none', '2020-04-04 15:36:00', 'no', 'no', 0, ''),
(17, 'I got a cool avatar right?', 'newtestuser', 'none', '2020-04-04 15:36:20', 'no', 'no', 2, ''),
(18, 'Hello everyone!!!', 'kingofsky95', 'none', '2020-04-04 15:38:59', 'no', 'no', 1, ''),
(19, 'How is everyone doing during the quarantine? ', 'kingofsky95', 'none', '2020-04-04 15:39:27', 'no', 'no', 1, ''),
(20, 'BEEN PLAYING VIDEO GAMES!!!', 'newtestuser', 'none', '2020-04-04 15:40:03', 'no', 'no', 1, ''),
(21, 'WOOOHOOO', 'newtestuser', 'none', '2020-04-04 15:43:05', 'no', 'no', 1, ''),
(22, 'just fixed the loading post guys! FACK YEAH!', 'newtestuser', 'none', '2020-04-04 17:19:56', 'no', 'no', 2, ''),
(23, 'I\'m an anime character', 'erenjaeger', 'none', '2020-04-05 21:28:07', 'no', 'no', 0, ''),
(24, 'tomorrow is the first day of the quarter!!!', 'erenjaeger', 'none', '2020-04-05 22:48:54', 'no', 'no', 1, ''),
(25, 'I\'m the cat driving a flip flop WEEEEEEEEEE~', 'flipflop', 'none', '2020-04-10 18:24:33', 'no', 'no', 1, ''),
(26, 'Hello, this is for Gavin', 'erenjaeger', 'newtestuser', '2020-04-13 20:52:38', 'no', 'no', 1, ''),
(27, 'Hello, this is for Gavin', 'erenjaeger', 'newtestuser', '2020-04-13 20:52:46', 'no', 'no', 0, ''),
(28, '*TEST* sending post to myself', 'erenjaeger', 'none', '2020-04-13 21:26:09', 'no', 'no', 0, ''),
(29, 'hello again', 'erenjaeger', 'newtestuser', '2020-04-13 21:26:35', 'no', 'no', 0, ''),
(30, 'test', 'erenjaeger', 'none', '2020-04-13 21:33:00', 'no', 'no', 0, ''),
(31, 'adwad', 'erenjaeger', 'none', '2020-04-13 21:35:02', 'no', 'no', 0, ''),
(32, 'add', 'erenjaeger', 'none', '2020-04-13 21:37:13', 'no', 'no', 0, ''),
(33, 'wqdqw', 'erenjaeger', 'none', '2020-04-13 21:39:18', 'no', 'yes', 0, ''),
(34, 'sup nerd!', 'erenjaeger', 'newtestuser', '2020-04-13 21:41:21', 'no', 'no', 0, ''),
(35, 'want some juice?', 'erenjaeger', 'newtestuser', '2020-04-13 21:41:44', 'no', 'no', 0, ''),
(36, 'want some juice?', 'erenjaeger', 'newtestuser', '2020-04-13 21:41:55', 'no', 'no', 0, ''),
(37, 'fef', 'erenjaeger', 'none', '2020-04-13 21:48:09', 'no', 'no', 0, ''),
(38, 'asdasd', 'erenjaeger', 'none', '2020-04-13 21:50:45', 'no', 'no', 0, ''),
(39, 'asd', 'erenjaeger', 'none', '2020-04-13 21:51:36', 'no', 'yes', 0, ''),
(40, 'awdwd', 'erenjaeger', 'none', '2020-04-13 21:52:30', 'no', 'no', 0, ''),
(41, 'hello', 'erenjaeger', 'newtestuser', '2020-04-13 21:57:18', 'no', 'no', 0, ''),
(42, 'adwdwd', 'erenjaeger', 'newtestuser', '2020-04-13 21:57:55', 'no', 'no', 1, ''),
(43, 'again', 'erenjaeger', 'none', '2020-04-13 21:59:32', 'no', 'no', 0, ''),
(44, 'again', 'erenjaeger', 'none', '2020-04-13 21:59:37', 'no', 'no', 0, ''),
(45, 'again', 'erenjaeger', 'none', '2020-04-13 21:59:39', 'no', 'no', 0, ''),
(46, 'updated', 'erenjaeger', 'none', '2020-04-13 22:03:57', 'no', 'no', 0, ''),
(47, 'asd', 'erenjaeger', 'none', '2020-04-13 22:05:24', 'no', 'yes', 0, ''),
(48, 'last test', 'erenjaeger', 'none', '2020-04-13 22:05:50', 'no', 'no', 1, ''),
(49, 'Why my newsfeed is only getting your posts? ', 'flipflop', 'none', '2020-04-13 22:26:52', 'no', 'no', 1, ''),
(50, 'when will you release SS6 for us? Next time put  a pair of flip flop on a titan please :D', 'flipflop', 'erenjaeger', '2020-04-13 22:31:33', 'no', 'no', 2, ''),
(51, 'will get deleted', 'newtestuser', 'none', '2020-04-14 20:32:49', 'no', 'yes', 1, ''),
(52, 'will be deleted', 'newtestuser', 'none', '2020-04-14 22:46:56', 'no', 'yes', 0, ''),
(53, 'interesting profile picture!', 'erenjaeger', 'flipflop', '2020-04-14 23:16:28', 'no', 'no', 1, ''),
(54, 'wd', 'newtestuser', 'none', '2020-04-15 22:10:46', 'no', 'yes', 0, ''),
(55, 'hello eren', 'newtestuser', 'erenjaeger', '2020-04-16 17:22:19', 'no', 'yes', 0, ''),
(56, 'hello there', 'erenjaeger', 'none', '2020-04-18 20:51:06', 'no', 'no', 2, ''),
(57, 'send this to the siteground DB', 'newtestuser', 'none', '2020-04-25 02:41:13', 'no', 'no', 6, ''),
(58, 'I\'m your big fan!', 'newtestuser', 'shinchan', '2020-04-25 13:40:56', 'no', 'no', 5, ''),
(59, 'I\'m on the live db!', 'newtestuser', 'none', '2020-04-27 13:34:18', 'no', 'no', 1, ''),
(60, 'You are creating friction on your profile picture!', 'newtestuser', 'flipflop', '2020-04-29 22:47:03', 'no', 'no', 3, ''),
(61, 'your profile gif looks so cool!!!', 'newtestuser', 'sasuke', '2020-04-29 22:55:18', 'no', 'no', 3, ''),
(62, 'what sports can you play?', 'sasuke', 'newtestuser', '2020-04-30 20:01:23', 'no', 'no', 2, ''),
(63, 'Hello from kiet', 'sasuke', 'none', '2020-05-03 13:58:27', 'no', 'no', 4, ''),
(64, 'Your wall is so empty! Making 1st post for your wall!', 'erenjaeger', 'shu', '2020-05-05 21:07:11', 'no', 'no', 3, ''),
(65, 'add me :D', 'newtestuser', 'tamnguyen', '2020-05-06 19:23:32', 'no', 'no', 4, ''),
(66, '<br><iframe width=\'420\' height=\'315\' src=\'\'></iframe><br>', 'bluecat', 'none', '2020-05-10 10:54:50', 'no', 'yes', 0, ''),
(67, '<br><iframe width=\'420\' height=\'315\' src=\'\'></iframe><br>', 'bluecat', 'none', '2020-05-10 11:15:13', 'no', 'yes', 0, ''),
(68, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/Thj6MGQwVtc\'></iframe><br>', 'bluecat', 'none', '2020-05-10 11:17:31', 'no', 'no', 2, ''),
(69, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/Dcx9R4QSeik\'></iframe><br>', 'bluecat', 'none', '2020-05-10 11:18:29', 'no', 'no', 2, ''),
(70, 'https://www.youtube.com/watch?v=vSWQinKaFmo', 'newtestuser', 'none', '2020-05-10 14:14:00', 'no', 'yes', 0, ''),
(71, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/autZufInfMo\'></iframe><br>', 'newtestuser', 'none', '2020-05-10 14:40:23', 'no', 'no', 1, ''),
(72, 'Test upload Image', 'newtestuser', 'none', '2020-05-12 00:33:47', 'no', 'no', 2, 'img/posts5eba353b5583d1929_pepe_angry.png'),
(73, 'trying to upload a gif...is it work?', 'newtestuser', 'none', '2020-05-12 00:35:25', 'no', 'no', 2, 'img/posts5eba359d5d7b71168_PepeLazerREEEE.gif'),
(74, 'An old Maehwa char from Black Desert Online... used to be soft-caped gear...', 'newtestuser', 'none', '2020-05-12 00:41:51', 'no', 'no', 2, 'img/posts5eba371f2972041ba029b4742d9f53661528de8666c60.gif'),
(75, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/PyyT5tHbOLw\'></iframe><br>', 'newtestuser', 'none', '2020-05-16 16:23:51', 'no', 'no', 2, ''),
(76, 'post', 'saitama', 'none', '2020-05-18 13:58:20', 'no', 'no', 1, ''),
(82, 'hi', 'yeah', 'none', '2020-05-18 14:10:41', 'no', 'no', 0, ''),
(83, 'tghjgh', 'yeah', 'none', '2020-05-18 14:11:35', 'no', 'no', 0, ''),
(84, 'just me', 'newtestuser', 'none', '2020-05-18 14:13:01', 'no', 'no', 2, ''),
(85, 'just me', 'newtestuser', 'none', '2020-05-18 14:13:08', 'no', 'no', 4, ''),
(86, 'hi', 'yeah', 'none', '2020-05-18 14:18:45', 'no', 'no', 1, ''),
(87, 'post', 'saitama', 'none', '2020-05-18 14:22:59', 'no', 'no', 1, ''),
(88, 'from saitama', 'saitama', 'yeah', '2020-05-18 14:26:30', 'no', 'no', 1, ''),
(89, 'Hey Tam is here', 'tamnguyen', 'saitama', '2020-05-18 14:35:33', 'no', 'no', 1, ''),
(90, 'from saitama', 'saitama', 'tamnguyen', '2020-05-18 14:37:56', 'no', 'no', 2, ''),
(91, 'post to myself', 'bluecat', 'none', '2020-05-18 15:15:30', 'no', 'no', 3, ''),
(92, 'From blue cat', 'bluecat', 'saitama', '2020-05-18 15:16:19', 'no', 'no', 3, ''),
(93, 'i\'m a kid', 'newtestuser', 'none', '2020-05-18 17:02:10', 'no', 'no', 5, ''),
(94, 'who wants to play basketball tomorrow?', 'yeah', 'none', '2020-05-20 15:40:34', 'no', 'no', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `preference_id` int(30) NOT NULL,
  `preference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`preference_id`, `preference`) VALUES
(1, 'Baseball'),
(2, 'Basketball'),
(3, 'Billiards'),
(4, 'Bowling'),
(5, 'Climbing'),
(6, 'Cricket'),
(7, 'Curling'),
(8, 'Football'),
(9, 'Golf'),
(10, 'Rugby'),
(11, 'Skateboarding'),
(12, 'Skiing'),
(13, 'Snowboarding'),
(14, 'Soccer'),
(15, 'Swimming'),
(16, 'Tennis'),
(17, 'Volleyball'),
(18, 'Weightlifting');

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
(2, 'Gavin', 'Thomas', 'newtestuser', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-12', 'img/newtestuser_original.b9b8b4c6111fd3b53343df59a2a3ae17.gif', 26, 0, 0, 'no', ',erenjaeger,flipflop,kingofsky95,anothertestuser,totoro,totoro,bluecat,shu,shinchan,yeah,saitama,sasuke,'),
(3, 'Another', 'Test', 'anothertestuser', 'test1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-12', 'img/reee.gif', 2, 0, 0, 'no', ',newtestuser,'),
(4, 'Eto', 'Luu', 'kingofsky95', 'kingofsky95@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-20', 'img/kingofsky95_original.30ff1917c93d6e36d7dac8da1c562c61.gif', 2, 0, 0, 'no', ',newtestuser,shinchan,'),
(5, 'Eren', 'Jaeger', 'erenjaeger', 'eren@aot.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-05', 'img/eren.gif', 28, 0, 0, 'no', ',newtestuser,flipflop,yeah,sasuke,shu,bluecat,'),
(6, 'Flip', 'Flop', 'flipflop', 'flipflop@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-10', 'img/flipflop.gif', 3, 0, 0, 'no', ',erenjaeger,newtestuser,'),
(7, 'Sasuke', 'Uchiha', 'sasuke', 'sasuke@naruto.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-25', 'img/sasuke_original.551feb7437ded2d1b7ca8b977c312c96.gif', 2, 0, 0, 'no', ',erenjaeger,newtestuser,bluecat,saitama,'),
(8, 'Totoro', 'Kusakabe', 'totoro', 'totoro@ghiblistudio.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-25', 'img/totoro_original.aa2b93c9a7edb9e9c0383a65df52bddd.gif', 0, 0, 0, 'no', ',newtestuser,newtestuser,'),
(9, 'Shin-chan', 'Kureyon', 'shinchan', 'shin@Tvashi.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-25', 'img/shinchan_original.133e6bfbb1e53deb48e740f716bebae9.gif', 0, 0, 0, 'no', ',newtestuser,kingofsky95,'),
(10, 'Blue', 'Cat', 'bluecat', 'cat@eagles.ewu.edu', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-25', 'img/bluecat_original.764e3918b543c3b5c9f8ade128f5095d.gif', 6, 0, 0, 'no', ',newtestuser,erenjaeger,yeah,sasuke,shu,'),
(11, 'Shu', 'Ouma', 'shu', 'shu@guiltycrown.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-25', 'img/shu_original.9f7ba9693e31df2b3f1881fac0fd5116.gif', 0, 0, 0, 'no', ',newtestuser,erenjaeger,bluecat,yeah,'),
(12, 'Eric', 'Adams', 'yeah', 'BulletStripe2@yahoo.com', 'f30aa7a662c728b7407c54ae6bfd27d1', '2020-04-27', 'img/yeah_original.7ee608d4d9290c1739b04de77a40dd25.jpeg', 4, 0, 0, 'no', ',newtestuser,erenjaeger,,saitama,bluecat,shu,'),
(13, 'Tam', 'Nguyen', 'tamnguyen', 'ltv.minhtam@gmail.com', '26befa85b5d546567b701287c294d678', '2020-05-02', 'img/eren.gif', 1, 0, 0, 'no', ',saitama,'),
(14, 'Eric', 'Adams', 'ProZude', 'pro2427zud3@yahoo.com', 'f30aa7a662c728b7407c54ae6bfd27d1', '2020-05-05', 'img/ProZude_original.2d5357ca3ca44e3e41f1eec0b85006eb.jpeg', 0, 0, 0, 'no', ','),
(15, 'Eric', 'Adams', 'testingmy-events', 'btls2@yahoo.com', 'f30aa7a662c728b7407c54ae6bfd27d1', '2020-05-05', '', 0, 0, 0, 'no', ','),
(16, 'Eric', 'Adams', 'testing5-9', 'pro2428zud3@yahoo.com', 'f30aa7a662c728b7407c54ae6bfd27d1', '2020-05-09', '', 0, 0, 0, 'no', ','),
(17, 'Tam2', 'Nguyen2', 'tamnguyen2', 'ltv.minhtam@gmail.com', '26befa85b5d546567b701287c294d678', '2020-05-12', '', 0, 0, 0, 'no', ','),
(18, 'Saitama', 'Â?イタマ', 'saitama', 'saitama@onepunch.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-05-18', 'img/saitama_original.d03611217a7b17444dab56a1dfae3fc1.gif', 4, 0, 0, 'no', ',yeah,newtestuser,tamnguyen,sasuke,'),
(19, 'Max', 'Test', 'sneakurtis', 'actuallife87@gmail.com', '0c86aa31ff4dd9b5d5d0dbb42b615fe5', '2020-05-25', '', 0, 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_users`
--
ALTER TABLE `event_users`
  ADD PRIMARY KEY (`event_id`,`user_name`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`preference_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `preference_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
