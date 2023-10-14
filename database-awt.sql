-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 06:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awt_testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `awt_access_authorization`
--

CREATE TABLE `awt_access_authorization` (
  `id` int(255) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `fileHash` varchar(255) NOT NULL,
  `uniqueKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_admin`
--

CREATE TABLE `awt_admin` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `last_logged_ip` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `permission_level` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_albums`
--

CREATE TABLE `awt_albums` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_media`
--

CREATE TABLE `awt_media` (
  `id` int(255) NOT NULL,
  `album_id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_menus`
--

CREATE TABLE `awt_menus` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awt_menus`
--

INSERT INTO `awt_menus` (`id`, `name`, `items`, `active`) VALUES
(1, 'Default Menu', '<a href=\"?page=Home\">Home</a>NEW_LINK <a href=\"?page=Blog\">Blog</a>NEW_LINK <a href=\"?page=Posts\">Posts</a>NEW_LINK <a href=\"?page=About Us\">About Us</a>NEW_LINK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `awt_notifications`
--

CREATE TABLE `awt_notifications` (
  `id` int(255) NOT NULL,
  `caller` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `importance` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_paging`
--

CREATE TABLE `awt_paging` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content_1` mediumtext DEFAULT NULL,
  `content_2` mediumtext DEFAULT NULL,
  `status` varchar(7) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `override` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_plugins`
--

CREATE TABLE `awt_plugins` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awt_settings`
--

CREATE TABLE `awt_settings` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `required_permission_level` int(1) NOT NULL DEFAULT 0,
  `category` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awt_settings`
--

INSERT INTO `awt_settings` (`id`, `name`, `value`, `required_permission_level`, `category`) VALUES
(1, 'enable_caching', 'false', 0, 'General'),
(2, 'page_caching_time', '150', 0, 'General'),
(3, 'cache_in_session_time', '300', 0, 'General'),
(4, 'whitelist', 'false', 0, 'Security'),
(5, 'whitelist_list', '127.0.0.1 ::1 localhost', 0, 'Security'),
(6, 'use_plugins', 'true', 0, 'General'),
(7, 'hostname_path', '/', 0, 'General'),
(10, 'Enable API', 'true', 0, 'Security'),
(11, 'API request whitelist', '*', 0, 'Security'),
(13, 'PHP Error reporting', '0', 0, 'Security');

-- --------------------------------------------------------

--
-- Table structure for table `awt_themes`
--

CREATE TABLE `awt_themes` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awt_themes`
--

INSERT INTO `awt_themes` (`id`, `name`, `description`, `version`, `placeholder`, `active`) VALUES
(1, 'Twenty-Twenty-Three', 'This is a sleeek and modern theme for your website', '0.0.1', 'placeholder.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awt_access_authorization`
--
ALTER TABLE `awt_access_authorization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_admin`
--
ALTER TABLE `awt_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_albums`
--
ALTER TABLE `awt_albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_media`
--
ALTER TABLE `awt_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_menus`
--
ALTER TABLE `awt_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_notifications`
--
ALTER TABLE `awt_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_paging`
--
ALTER TABLE `awt_paging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_plugins`
--
ALTER TABLE `awt_plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_settings`
--
ALTER TABLE `awt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awt_themes`
--
ALTER TABLE `awt_themes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awt_access_authorization`
--
ALTER TABLE `awt_access_authorization`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_admin`
--
ALTER TABLE `awt_admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_albums`
--
ALTER TABLE `awt_albums`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_media`
--
ALTER TABLE `awt_media`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_menus`
--
ALTER TABLE `awt_menus`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `awt_notifications`
--
ALTER TABLE `awt_notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_paging`
--
ALTER TABLE `awt_paging`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_plugins`
--
ALTER TABLE `awt_plugins`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awt_settings`
--
ALTER TABLE `awt_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `awt_themes`
--
ALTER TABLE `awt_themes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
