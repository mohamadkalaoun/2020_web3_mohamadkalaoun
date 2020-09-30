-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 06:27 PM
-- Server version: 5.7.17
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
-- Database: `bulbow`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(1, 10, 12, 'jsdfopkfdpo', 'omar_samir_775543', '2020-07-27 17:35:24'),
(2, 11, 13, 'suigfdiusf', 'nader_walid_972229', '2020-07-27 18:01:19'),
(3, 3, 2, 'sobe7', 'salam_yeya_145202', '2020-07-28 14:28:44'),
(4, 5, 6, 'hello dear', 'new_user_588714', '2020-07-30 14:28:01'),
(5, 14, 15, 'nice kejei san', 'piedro_gozalez_355621', '2020-09-30 13:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_idea` varchar(255) NOT NULL,
  `desc_idea` varchar(255) NOT NULL,
  `upload_image` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `size_part` int(11) NOT NULL,
  `group_pass` varchar(255) DEFAULT NULL,
  `cooldown` varchar(255) DEFAULT NULL,
  `counter_part` varchar(255) DEFAULT NULL,
  `brainstorming` longtext,
  `banned` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`post_id`, `user_id`, `title_idea`, `desc_idea`, `upload_image`, `post_date`, `size_part`, `group_pass`, `cooldown`, `counter_part`, `brainstorming`, `banned`, `price`) VALUES
(5, 6, 'mattte', 'tshuto matte', 'download (18).jpg.46', '2020-07-30 10:40:30', 50, '', '', 'a:2:{i:0;s:2:\"14\";i:1;s:1:\"7\";}', NULL, NULL, NULL),
(6, 9, 'ghost of tsushima', 'bannskljdalkd', 'download (1).png.23', '2020-07-30 15:22:50', 50, '', '', 'a:2:{i:0;s:2:\"14\";i:1;s:1:\"7\";}', 'a:7:{s:40:\"mobile_user_760833,2020-09-26 04:07:01pm\";s:6:\"asdas\n\";s:40:\"mobile_user_760833,2020-09-26 04:07:41pm\";s:6:\"shhii\n\";s:40:\"mobile_user_760833,2020-09-26 04:07:46pm\";s:5:\"damn\n\";s:40:\"mobile_user_760833,2020-09-26 04:07:55pm\";s:16:\"more quick dude\n\";s:40:\"mobile_user_760833,2020-09-26 04:08:01pm\";s:2:\"k\n\";s:40:\"mobile_user_760833,2020-09-26 04:10:22pm\";s:10:\"all is gd\n\";s:40:\"mobile_user_760833,2020-09-26 04:11:41pm\";s:4:\"tmm\n\";}', NULL, NULL),
(4, 7, 'kinsai', 'is=osaka', 'download (4).jpg.19', '2020-07-29 20:29:48', 50, '', '', 'a:2:{i:0;s:2:\"14\";i:1;s:1:\"7\";}', NULL, '14,', NULL),
(7, 1, 'nmsdfkj', 'ddddddddddddddddddrbe', 'IMG-20200509-WA0002.jpg.20', '2020-08-27 19:08:51', 50, '', '', 'a:2:{i:0;s:2:\"14\";i:1;s:1:\"7\";}', 'a:3:{s:40:\"mobile_user_760833,2020-09-21 03:16:09pm\";s:0:\"\";s:40:\"mobile_user_760833,2020-09-21 03:16:26pm\";N;s:40:\"mobile_user_760833,2020-09-21 03:16:43pm\";N;}', NULL, NULL),
(8, 1, 'bulbow', 'some investment', '20181216_170159.jpg.71', '2020-09-02 10:54:11', 50, '', '', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"7\";i:2;s:2:\"14\";}', NULL, NULL, NULL),
(9, 8, 'var char', 'ted dibi yassi', '01-changer-ampoule-led.jpg.80', '2020-09-03 13:27:20', 50, '', '', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"7\";i:2;s:2:\"14\";}', 'a:18:{s:40:\"mobile_user_760833,2020-09-25 04:16:45pm\";s:9:\"nandeska\n\";s:40:\"mobile_user_760833,2020-09-25 04:17:31pm\";s:5:\"what\n\";s:40:\"mobile_user_760833,2020-09-25 04:17:45pm\";s:24:\"why are you runing dude\n\";s:40:\"mobile_user_760833,2020-09-25 04:39:30pm\";s:8:\"3m y8li\n\";s:40:\"mobile_user_760833,2020-09-25 04:40:10pm\";s:5:\"3ale\n\";s:40:\"mobile_user_760833,2020-09-25 05:48:18pm\";s:5:\"dibe\n\";s:40:\"mobile_user_760833,2020-09-25 05:52:08pm\";s:6:\"jlede\n\";s:40:\"mobile_user_760833,2020-09-26 01:01:13pm\";s:7:\"masaka\n\";s:40:\"mobile_user_760833,2020-09-26 01:23:31pm\";s:10:\"nannniiii\n\";s:40:\"mobile_user_760833,2020-09-26 01:49:54pm\";s:9:\"sanatari\n\";s:40:\"mobile_user_760833,2020-09-26 01:55:25pm\";s:6:\"dusta\n\";s:40:\"mobile_user_760833,2020-09-26 02:04:23pm\";s:4:\"jib\n\";s:40:\"mobile_user_760833,2020-09-26 02:05:26pm\";s:10:\"asdadasda\n\";s:40:\"mobile_user_760833,2020-09-26 02:07:26pm\";s:9:\"kle hawa\n\";s:40:\"mobile_user_760833,2020-09-26 02:09:29pm\";s:7:\"jibbbb\n\";s:40:\"mobile_user_760833,2020-09-26 02:59:02pm\";s:8:\"3l cell\n\";s:40:\"mobile_user_760833,2020-09-26 03:00:29pm\";s:7:\"shfik \n\";s:40:\"mobile_user_760833,2020-09-26 04:53:15pm\";s:10:\"bootstrap\n\";}', NULL, NULL),
(10, 1, 'rdrtyhdfhgfhdf', 'hfghfghfgh', 'download (1).png.78', '2020-09-27 16:32:13', 50, '', '', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"7\";i:2;s:2:\"14\";i:3;s:2:\"12\";}', 'a:5:{s:42:\"bourbon_zeero_821289,2020-09-29 11:44:08am\";s:11:\"hello dude\n\";s:42:\"bourbon_zeero_821289,2020-09-29 11:44:33am\";s:13:\"why are you \n\";s:42:\"bourbon_zeero_821289,2020-09-29 11:44:37am\";s:8:\"running\n\";s:42:\"bourbon_zeero_821289,2020-09-29 11:45:01am\";s:5:\"dadj\n\";s:39:\"omar_samir_775543,2020-09-29 11:02:38pm\";s:8:\"bourbon\n\";}', NULL, NULL),
(11, 7, 'jledeas', 'hsadifugdsiufspdfsdf', 'GoodvBad_-Apple-and-cookie-2.png.87', '2020-09-27 16:32:59', 150, 'samir', 'two', 'a:7:{i:0;s:1:\"1\";i:3;s:2:\"12\";i:4;s:1:\"6\";i:5;s:2:\"11\";i:6;s:1:\"9\";i:7;s:1:\"7\";i:8;s:2:\"15\";}', 'a:9:{s:39:\"omar_samir_775543,2020-09-29 11:01:01pm\";s:7:\"aboodi\n\";s:35:\"majd_ka_27465,2020-09-29 11:07:53pm\";s:6:\"hello\n\";s:35:\"majd_ka_27465,2020-09-29 11:07:56pm\";s:8:\"fi2aton\n\";s:35:\"majd_ka_27465,2020-09-29 11:07:59pm\";s:5:\"bala\n\";s:37:\"new_user_588714,2020-09-30 12:51:46pm\";s:11:\"dsfdsfeesf\n\";s:43:\"piedro_gozalez_355621,2020-09-30 02:56:07pm\";s:6:\"hello\n\";s:39:\"fadi_kamil_594573,2020-09-30 03:39:30pm\";s:9:\"hsdfudsf\n\";s:39:\"salam_yeya_145202,2020-09-30 03:39:33pm\";s:12:\"ihoidshfosd\n\";s:39:\"fadi_kamil_594573,2020-09-30 03:44:39pm\";s:17:\"sdgsdfgsdfgfdgdf\n\";}', '9,11,', 'gsaidfuahfi\r\n5k$'),
(12, 14, 'sa7i7a', 'all true', 'PicsArt_06-03-01.42.16.jpg.91', '2020-09-28 10:22:29', 50, 'wre3', '', 'a:5:{i:0;s:2:\"14\";i:1;s:2:\"13\";i:2;s:2:\"12\";i:3;s:1:\"2\";i:4;s:2:\"11\";}', 'a:7:{s:42:\"bourbon_zeero_821289,2020-09-28 09:53:56pm\";s:6:\"3leke\n\";s:42:\"bourbon_zeero_821289,2020-09-28 09:54:08pm\";s:10:\"cmon dude\n\";s:42:\"bourbon_zeero_821289,2020-09-28 09:54:33pm\";s:4:\"la2\n\";s:42:\"bourbon_zeero_821289,2020-09-28 09:54:39pm\";s:5:\"jadd\n\";s:42:\"bourbon_zeero_821289,2020-09-28 09:54:45pm\";s:2:\"k\n\";s:42:\"bourbon_zeero_821289,2020-09-28 09:54:54pm\";s:12:\"mana mshkle\n\";s:39:\"omar_samir_775543,2020-09-29 11:00:22pm\";s:7:\"lk eh \n\";}', NULL, NULL),
(14, 15, 'master', 'Depart do be so he enough talent. Sociable formerly six but handsome. Up do view time they shot. He concluded disposing provision by questions .', 'Creator Education - Google Chrome 9_12_2020 9_25_48 PM.png.29', '2020-09-30 13:05:20', 50, '', '', 'a:1:{i:0;s:2:\"15\";}', NULL, NULL, NULL),
(16, 16, 'tirtlesdf', 'sdfsdfsdfsd', 'dirty-number-plate-car-923141.jpg.44', '2020-09-30 13:32:04', 50, '', '', 'a:2:{i:0;s:2:\"16\";i:1;s:1:\"7\";}', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `idea_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_username` varchar(255) NOT NULL,
  `msg_text` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `write_permission` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `idea_id`, `sender_id`, `sender_username`, `msg_text`, `date`, `write_permission`) VALUES
(17, 5, 5, 'derr_black_481597', 'nani', '2020-07-31 09:25:03', 'TRUE'),
(16, 5, 5, 'derr_black_481597', 'family trere', '2020-07-31 09:24:48', 'TRUE'),
(15, 6, 13, 'nader_walid_972229', 'evreything is ok ?\r\n', '2020-07-30 20:57:03', 'TRUE'),
(45, 6, 12, 'omar_samir_775543', 'waht is hsuaada', '2020-08-01 11:00:36', 'TRUE'),
(39, 6, 12, 'omar_samir_775543', '', '2020-08-01 10:48:53', 'TRUE'),
(40, 6, 12, 'omar_samir_775543', '', '2020-08-01 10:49:06', 'TRUE'),
(12, 6, 13, 'nader_walid_972229', 'nani', '2020-07-30 19:46:50', 'TRUE'),
(18, 6, 5, 'derr_black_481597', 'there something wrong here\r\n', '2020-07-31 09:26:11', 'TRUE'),
(19, 6, 5, 'derr_black_481597', 'yeah i know', '2020-07-31 09:26:25', 'TRUE'),
(20, 6, 5, 'derr_black_481597', 'bakka', '2020-07-31 09:26:59', 'TRUE'),
(44, 6, 12, 'omar_samir_775543', 'sukkka', '2020-08-01 11:00:18', 'TRUE'),
(69, 9, 1, 'mobile_user_760833', '', '2020-09-05 11:50:50', 'TRUE'),
(68, 7, 1, 'mobile_user_760833', 'dude', '2020-09-04 15:13:41', 'TRUE'),
(67, 7, 1, 'mobile_user_760833', '', '2020-09-04 15:13:27', 'TRUE'),
(66, 7, 1, 'mobile_user_760833', '', '2020-09-02 14:40:10', 'TRUE'),
(65, 8, 1, 'mobile_user_760833', '', '2020-09-02 13:59:04', 'TRUE'),
(64, 8, 1, 'mobile_user_760833', '', '2020-09-02 13:39:37', 'TRUE'),
(63, 6, 1, 'mobile_user_760833', '', '2020-08-29 19:14:35', 'TRUE'),
(62, 6, 12, 'omar_samir_775543', 'di i typed here before ????', '2020-08-01 11:31:29', 'TRUE'),
(61, 6, 12, 'omar_samir_775543', 'di i typed here before ????', '2020-08-01 11:31:14', 'TRUE'),
(60, 6, 12, 'omar_samir_775543', '', '2020-08-01 11:30:36', 'TRUE'),
(57, 5, 12, 'omar_samir_775543', 'rapabbbbe', '2020-08-01 11:26:14', 'TRUE'),
(58, 5, 12, 'omar_samir_775543', 'rapabbbbe', '2020-08-01 11:26:48', 'TRUE'),
(59, 5, 12, 'omar_samir_775543', 'rapabbbbe', '2020-08-01 11:27:39', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `user_name` text NOT NULL,
  `describe_user` varchar(255) NOT NULL,
  `Relationship` text NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_country` varchar(255) DEFAULT NULL,
  `user_gender` varchar(255) DEFAULT NULL,
  `user_birthday` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_cover` varchar(255) NOT NULL,
  `user_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text NOT NULL,
  `posts` text NOT NULL,
  `recovery_account` varchar(255) NOT NULL,
  `report` int(128) DEFAULT NULL,
  `reported` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `describe_user`, `Relationship`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_cover`, `user_reg_date`, `status`, `posts`, `recovery_account`, `report`, `reported`) VALUES
(1, 'mobile', 'user', 'mobile_user_760833', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'qwertyuiop@gmail.con', NULL, NULL, '2018-05-11', 'head_sun_flower.png', 'default_cover.jpg', '2020-06-19 15:37:12', 'verified', 'yes', 'ifyou', 2, 'a:3:{i:0;s:0:\"\";i:1;s:1:\"6\";i:2;s:1:\"5\";}'),
(2, 'desktop', 'user', 'desktop_user_60028', 'Hello everyone ive start using BulBow.', '........', 'qazwsxedcrfv', 'desktop@gamil.cin', NULL, NULL, '2002-02-06', 'image (12).jpg.36', 'default_cover.jpg', '2020-06-20 14:57:00', 'verified', 'yes', 'ifyou', 0, NULL),
(3, 'nader', 'habib', 'nader_habib_870025', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'nader@gmail.com', 'lebanon', 'Male', '2020-06-17', 'head_turqoise.png', 'download (1).png.87', '2020-06-21 10:28:03', 'verified', 'yes', 'ifyou', 0, NULL),
(5, 'derr', 'black', 'derr_black_481597', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'derrblackan@gmail.con', NULL, NULL, '1990-01-01', 'head_sun_flower.png', 'default_cover.jpg', '2020-06-29 19:09:17', 'verified', 'no', 'ifyou', 1, NULL),
(6, 'majd', 'ka', 'majd_ka_27465', 'Hello everyone ive start using BulBow.', '........', 'asdfghjkl', 'majdka@gmail.com', NULL, 'Male', '2020-06-08', 'image14.jpg.32', 'default_cover.jpg', '2020-06-30 14:58:49', 'verified', 'yes', 'ifyou', 8, NULL),
(7, 'salam', 'yeya', 'salam_yeya_145202', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'ahyasalam@gmail.com', NULL, 'Female', '2013-02-07', 'image (11).jpg.83', 'default_cover.jpg', '2020-07-01 09:29:19', 'verified', 'yes', 'ifyou', 0, 'a:1:{i:0;s:1:\"6\";}'),
(8, 'nstep', 'yoo', 'nstep_yoo_280975', 'Hello everyone ive start using BulBow.', '........', 'qazwsxedcrfv', 'nstep@yahoo.non', NULL, NULL, '1992-07-05', 'head_sun_flower.png', 'default_cover.jpg', '2020-07-25 11:17:29', 'verified', 'yes', 'ifyou', 3, NULL),
(9, 'new', 'user', 'new_user_588714', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'newuser@gmail.com', NULL, NULL, '2015-06-16', 'Emoji (14).png.15', 'download (17).jpg.64', '2020-07-27 10:16:12', 'verified', 'yes', 'ifyou', 0, NULL),
(11, 'new', 'participater', 'new_participater_42510', 'Hello everyone ive start using BulBow.', 'Single', 'qwertyuiop', 'newparticipater@gmail.com', 'singapore', 'Male', '2019-05-15', 'image (4).jpg.91', 'default_cover.jpg', '2020-07-27 17:21:06', 'verified', 'no', 'ifyou', 0, NULL),
(12, 'omar', 'samir', 'omar_samir_775543', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'omarsamir@gmail.conm', 'lebanon', 'Male', '2020-07-08', 'image (1).jpg.97', 'default_cover.jpg', '2020-07-27 17:27:37', 'verified', 'yes', 'ifyou', 0, NULL),
(13, 'nader', 'walid', 'nader_walid_972229', 'Hello everyone ive start using BulBow.', '........', 'qwertyuiop', 'walidenader@gmail.com', NULL, 'Male', '2008-09-27', 'image (13).jpg.8', 'default_cover.jpg', '2020-07-27 17:55:26', 'verified', 'yes', 'ifyou', 0, NULL),
(14, 'bourbon', 'zeero', 'bourbon_zeero_821289', 'Hello everyone ive start using BulBow.', 'Divorced', 'qwaszxerdfcv', 'fdstgtsrg@jaloul.teh', 'lebanon', 'Female', '2011-02-09', 'head_sun_flower.png', 'default_cover.jpg', '2020-09-28 10:13:23', 'verified', 'yes', 'ifyou', 0, 'a:0:{}'),
(15, 'piedro', 'gozalez', 'piedro_gozalez_355621', 'Hello everyone ive start using BulBow.', '........', 'qazwsxedcrfv', 'peidre@yahoo.com', NULL, NULL, '2010-02-19', 'head_red.png', 'Hyper Scape2020-7-13-16-12-29.jpg.20', '2020-09-30 12:55:04', 'verified', 'yes', 'ifyou', 0, NULL),
(16, 'fadi', 'kamil', 'fadi_kamil_594573', 'Hello everyone ive start using BulBow.', 'Married', 'qwertyuiop', 'fadi@gmail.com', 'lebanon', 'Male', '2012-01-10', 'images.png.23', 'default_cover.jpg', '2020-09-30 13:28:09', 'verified', 'yes', 'ifyou', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `msg_body` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg_seen` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_to`, `user_from`, `msg_body`, `date`, `msg_seen`) VALUES
(1, 1, 2, 'srefdgfdg', '2020-06-20 15:02:52', 'no'),
(2, 4, 3, 'hello', '2020-06-29 12:56:01', 'no'),
(3, 3, 11, 'udshfkdsf', '2020-07-27 17:24:55', 'no'),
(4, 3, 11, 'udshfkdsf', '2020-07-27 17:25:04', 'no'),
(5, 3, 12, 'sfisdjfisdf\r\n', '2020-07-27 17:32:19', 'no'),
(6, 3, 13, 'jhdsilfsld', '2020-07-27 17:59:17', 'no'),
(7, 13, 3, 'k\r\n', '2020-07-29 14:33:30', 'no'),
(8, 12, 13, 'hello', '2020-09-29 20:33:05', 'no'),
(9, 12, 13, 'tante san\r\n', '2020-09-29 20:35:37', 'no'),
(10, 7, 9, 'hello', '2020-09-30 12:52:30', 'no'),
(11, 7, 16, 'hello\r\n', '2020-09-30 13:33:47', 'no'),
(12, 6, 7, 'fghfghfgh', '2020-09-30 13:45:45', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
