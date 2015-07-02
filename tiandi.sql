-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2015 at 05:53 PM
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
-- Table structure for table `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(11) NOT NULL,
  `img` varchar(128) COLLATE utf8_bin NOT NULL,
  `link` varchar(128) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `pwd` char(32) COLLATE utf8_bin NOT NULL,
  `salt` char(10) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table for admin account';

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'qq=0 | copyright=1 | icp=2 | tel=3',
  `content` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL,
  `img` varchar(128) COLLATE utf8_bin NOT NULL,
  `link` varchar(128) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `direction` varchar(64) COLLATE utf8_bin NOT NULL,
  `detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `subject_detial`
--

CREATE TABLE IF NOT EXISTS `subject_detial` (
  `id` int(11) NOT NULL,
  `video` varchar(128) COLLATE utf8_bin NOT NULL,
  `tag` varchar(64) COLLATE utf8_bin NOT NULL,
  `ad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_detial`
--
ALTER TABLE `subject_detial`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
