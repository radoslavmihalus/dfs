-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2016 at 12:10 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cozola_facebook_post`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facebook`
--

DROP TABLE IF EXISTS `tbl_facebook`;
CREATE TABLE IF NOT EXISTS `tbl_facebook` (
`id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `fid` varchar(32) DEFAULT NULL,
  `uid` int(111) DEFAULT '0',
  `access_token` text,
  `status` int(1) DEFAULT '1',
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

DROP TABLE IF EXISTS `tbl_posts`;
CREATE TABLE IF NOT EXISTS `tbl_posts` (
`id` int(11) NOT NULL,
  `type` varchar(32) DEFAULT NULL,
  `fid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `access_token` text,
  `cid` varchar(128) DEFAULT NULL,
  `message` text,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `url` text,
  `image` text,
  `time_post` datetime DEFAULT NULL,
  `delete` int(1) DEFAULT '0',
  `deplay` int(11) NOT NULL DEFAULT '5',
  `result` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE IF NOT EXISTS `tbl_settings` (
`id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `theme` varchar(64) DEFAULT NULL,
  `sidebar` int(1) DEFAULT '1',
  `layout` varchar(64) DEFAULT NULL,
  `register` int(1) NOT NULL DEFAULT '1',
  `default_language` varchar(128) DEFAULT 'en',
  `default_timezone` varchar(128) DEFAULT 'Asia/Ho_Chi_Minh',
  `users_limit` int(11) DEFAULT '3',
  `default_deplay` int(4) DEFAULT '5',
  `minimum_deplay` int(4) DEFAULT '5',
  `cron_delay` int(5) DEFAULT '3',
  `max_post` int(2) DEFAULT '5'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `logo`, `name`, `theme`, `sidebar`, `layout`, `register`, `default_language`, `default_timezone`, `users_limit`, `default_deplay`, `minimum_deplay`, `cron_delay`, `max_post`) VALUES
(1, 'assets/img/logo-tiger1.png', 'Tiger Post - Facebook Auto Post Multi Pages/Groups/Profiles', 'blue-light', 1, 'layout-boxed', 1, 'en', 'America/New_York', 3, 5, 5, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
`id` int(11) NOT NULL,
  `fid` varchar(255) DEFAULT NULL,
  `admin` int(1) DEFAULT '0',
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `app_id` varchar(16) DEFAULT NULL,
  `app_secret` varchar(32) DEFAULT NULL,
  `cookie` text,
  `status` int(1) DEFAULT '1',
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fid`, `admin`, `username`, `password`, `app_id`, `app_secret`, `cookie`, `status`, `changed`, `created`) VALUES
(1, '', 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, 1, '2016-03-09 13:34:04', '2016-03-08 16:46:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_facebook`
--
ALTER TABLE `tbl_facebook`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_facebook`
--
ALTER TABLE `tbl_facebook`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
