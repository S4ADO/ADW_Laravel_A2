-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 08:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laraveldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `importance`
--

CREATE TABLE IF NOT EXISTS `importance` (
  `importanceid` int(11) NOT NULL AUTO_INCREMENT,
  `importance` varchar(255) NOT NULL,
  PRIMARY KEY (`importanceid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `importance`
--

INSERT INTO `importance` (`importanceid`, `importance`) VALUES
(1, 'Not important'),
(2, 'Somewhat important'),
(3, 'Quite important'),
(4, 'Very important'),
(5, 'Urgent');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_08_074434_create_tasks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `complete_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `userid` int(11) DEFAULT NULL,
  `importanceid` int(11) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `fk_importance` (`importanceid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `body`, `created_at`, `updated_at`, `complete_date`, `complete`, `userid`, `importanceid`) VALUES
(11, 'Task 1', 'owner saad', '2018-01-24 16:25:07', '2018-01-24 16:25:07', '2018-01-24 16:25:07', 0, 1, 4),
(12, 'Task 2', 'test owner', '2018-01-24 16:25:07', '2018-01-24 16:25:07', '2018-01-24 16:25:07', 0, 3, 4),
(13, 'Task 2', 'owner saad', '2018-01-24 16:25:07', '2018-01-24 16:25:07', '2018-01-24 16:25:07', 0, 1, 4),
(21, 'Go to the gym', 'You''re getting fat. Go to ze gym!', '2018-01-24 19:47:37', '2018-04-29 17:53:15', '2018-01-31 01:30:00', 1, 1, 5),
(22, 'new words', 'Hell yeah', '2018-04-29 17:24:38', '2018-04-29 18:00:04', '2018-03-09 11:11:00', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) NOT NULL DEFAULT 'None',
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `remember_token`, `avatar`) VALUES
(1, 'Saad musejee', 'saadmusejee@live.com', '$2y$10$6EyDMvVnZuQcudoLnn7DHeUgfjs/wDUoJFV5ihUvdnt.rX6nAvwfG', '2018-01-24 12:39:59', '2018-04-29 16:48:39', 'z0wNxMFbcTQ3U1aBnIIPKDgZrytlzBFzGzPPyykjypgL94XFTFHJflMGdlXf', 'Saad musejee.jpg'),
(3, 'adam', 'adam@live.com', '$2y$10$nD7pqDfxs4E8QGMlHaCRHubNobzs3C6UGBxTggNrfhDSruXNrNrOK', '2018-01-24 14:54:22', '2018-01-24 14:54:22', '0ZAsHsKsvddSbXiLWjNFq9fDqOYg0xZKGqxY4hFSFKtFTbDGCY37wKw65ybv', ''),
(4, 'test3', 'test3@live.com', '$2y$10$M4IRxXpCWGc79ghxjmN/SeSspujud0x.4o4EV4ZYZnhc6WJqkC2IC', '2018-01-24 15:19:58', '2018-01-24 15:19:58', 'BzG6FBkpXeKsdsa6bzN0KZJ4RjReshb50b0BtMKQigvLHGTrKq9667mV28mU', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_importance` FOREIGN KEY (`importanceid`) REFERENCES `importance` (`importanceid`),
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
