-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2015 at 12:22 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tiandi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL,
  `target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `pwd` char(32) NOT NULL,
  `salt` char(10) NOT NULL,
  `nickname` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table for admin account';

-- --------------------------------------------------------

--
-- Table structure for table `class_guide`
--

CREATE TABLE IF NOT EXISTS `class_guide` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `video` varchar(128) NOT NULL,
  `tags` varchar(256) NOT NULL DEFAULT '[]',
  `description` text NOT NULL,
  `chapters` varchar(512) NOT NULL DEFAULT '[]',
  `steps` varchar(512) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_chapter`
--

CREATE TABLE IF NOT EXISTS `course_chapter` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_class`
--

CREATE TABLE IF NOT EXISTS `course_class` (
  `id` int(11) NOT NULL,
  `title` varchar(125) NOT NULL,
  `content` varchar(256) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_step`
--

CREATE TABLE IF NOT EXISTS `course_step` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `level` smallint(6) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `content` text NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `note_group`
--

CREATE TABLE IF NOT EXISTS `note_group` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `list` text NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `answer_time` int(11) NOT NULL,
  `details` varchar(512) NOT NULL DEFAULT '[]',
  `comments` varchar(512) NOT NULL DEFAULT '[]',
  `tags` varchar(512) NOT NULL DEFAULT '[]',
  `up_count` int(11) NOT NULL DEFAULT '0',
  `down_count` int(11) NOT NULL DEFAULT '0',
  `collect_count` int(11) NOT NULL DEFAULT '0',
  `follow_count` int(11) NOT NULL DEFAULT '0',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `hot` int(11) NOT NULL DEFAULT '0',
  `follow_users` varchar(1024) NOT NULL DEFAULT '[]',
  `collect_users` varchar(512) NOT NULL DEFAULT '[]',
  `up_users` varchar(1024) NOT NULL DEFAULT '[]',
  `down_users` varchar(512) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `problem_comment`
--

CREATE TABLE IF NOT EXISTS `problem_comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `problem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `problem_detail`
--

CREATE TABLE IF NOT EXISTS `problem_detail` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `problem_id` int(11) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'qq=0 | copyright=1 | icp=2 | tel=3',
  `content` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  `color` varchar(32) NOT NULL,
  `type` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `count` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `content` varchar(256) DEFAULT NULL,
  `json_who` varchar(256) DEFAULT '[]',
  `link` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `pwd` char(32) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `type` int(4) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `cellphone` char(11) NOT NULL,
  `description` text NOT NULL,
  `god_description` varchar(256) NOT NULL,
  `collect_problem_count` int(11) NOT NULL DEFAULT '0',
  `follow_problem_count` int(11) NOT NULL DEFAULT '0',
  `ask_count` int(11) NOT NULL DEFAULT '0',
  `answer_count` int(11) NOT NULL DEFAULT '0',
  `collect_problems` varchar(1024) NOT NULL DEFAULT '[]',
  `follow_problems` varchar(1024) NOT NULL DEFAULT '[]',
  `skilled_tags` varchar(256) NOT NULL DEFAULT '[]',
  `alipay` varchar(64) NOT NULL,
  `gold_coin` int(11) NOT NULL DEFAULT '0',
  `silver_coin` int(11) NOT NULL DEFAULT '0',
  `follow_user_count` int(11) NOT NULL DEFAULT '0',
  `follower_count` int(11) NOT NULL DEFAULT '0',
  `follow_users` varchar(1024) NOT NULL DEFAULT '[]',
  `followers` varchar(1024) NOT NULL DEFAULT '[]',
  `idcar` varchar(44) NOT NULL,
  `notes` varchar(512) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Indexes for table `class_guide`
--
ALTER TABLE `class_guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`), ADD KEY `title` (`title`), ADD KEY `type` (`type`);

--
-- Indexes for table `course_chapter`
--
ALTER TABLE `course_chapter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_class`
--
ALTER TABLE `course_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_step`
--
ALTER TABLE `course_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note_group`
--
ALTER TABLE `note_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem_comment`
--
ALTER TABLE `problem_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem_detail`
--
ALTER TABLE `problem_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `class_guide`
--
ALTER TABLE `class_guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `course_chapter`
--
ALTER TABLE `course_chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_class`
--
ALTER TABLE `course_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_step`
--
ALTER TABLE `course_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `note_group`
--
ALTER TABLE `note_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `problem_comment`
--
ALTER TABLE `problem_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problem_detail`
--
ALTER TABLE `problem_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
