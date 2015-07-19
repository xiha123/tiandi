-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-07-19 18:04:39
-- 服务器版本： 5.6.11
-- PHP Version: 5.5.1

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
-- 表的结构 `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  `text` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `pwd` char(32) NOT NULL,
  `salt` char(10) NOT NULL,
  `nickname` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for admin account';

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `pwd`, `salt`, `nickname`) VALUES
(1, 'tiandi', '933e92d31cdc2748c6f84f26ec090835', '', 'tiandi'),
(0, 'tocurd', 'f734d30ecf38421451afe6fba0c26db5', 'bb26886376', '12312'),
(0, 'tocurd3', 'dca4fe15c87b864a043b89f647a3857e', 'bb278979ef', '123122');

-- --------------------------------------------------------

--
-- 表的结构 `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `chapter`
--

INSERT INTO `chapter` (`id`, `form`, `title`, `content`) VALUES
(4, 5, '12312312', '123123'),
(5, 5, '第一章', '教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5教会学生们如何使用Photosthop cs5');

-- --------------------------------------------------------

--
-- 表的结构 `classlist`
--

CREATE TABLE IF NOT EXISTS `classlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(124) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `video` text NOT NULL,
  `time` int(13) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `direction` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tag` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `classlist`
--

INSERT INTO `classlist` (`id`, `name`, `video`, `time`, `text`, `link`, `direction`, `tag`, `url`) VALUES
(5, '123123', '231312', 1437315977, '312', '112312312', '测试', '3,2,3', '3,2,3'),
(6, 'Swift', '#', 1437295073, 'Swift', '', '', '', ''),
(7, 'web', '#', 1437295087, 'web', '', '', '', ''),
(8, ' Cocos2d-x', '#', 1437295116, ' Cocos2d-x', '', '', '', ''),
(9, 'Android', '#', 1437295129, 'Android', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `guide`
--

CREATE TABLE IF NOT EXISTS `guide` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'qq=0 | copyright=1 | icp=2 | tel=3',
  `content` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` text NOT NULL,
  `color` text NOT NULL,
  `type` int(11) NOT NULL,
  `time` int(13) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `slide`
--

INSERT INTO `slide` (`id`, `name`, `img`, `link`, `color`, `type`, `time`, `text`) VALUES
(0, '212312', 'logo-hd1.png', '312', '#1e9ba1', 0, 1437283385, '测试'),
(18, '天地培训测试轮播', 'slide4.jpg', 'http://www.baidu.com/', '#1e9ba1', 0, 1437279877, '天地培训测试轮播'),
(21, '312', 'slide13.jpg', '12', '123', 1, 1437287609, '31212'),
(22, '测试', 'slide12.jpg', '#', '#', 1, 1437287598, '测试'),
(23, '12312', 'slide11.jpg', '312', '#123', 1, 1437287590, '#123132'),
(24, 'cs', 'slide46.jpg', 'cs', 'cs', 0, 1437287647, 'cs');

-- --------------------------------------------------------

--
-- 表的结构 `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `direction` varchar(256) NOT NULL,
  `video` varchar(128) NOT NULL,
  `tag` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` int(11) NOT NULL,
  `tag` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tag`
--

INSERT INTO `tag` (`id`, `form`, `tag`, `url`) VALUES
(3, 5, '112321', '12312'),
(5, 5, '12312312312312', '12312');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `pwd` char(32) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `type` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
