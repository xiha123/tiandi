-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2015 �?07 �?22 �?11:51
-- 服务器版本: 5.6.11
-- PHP 版本: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tiandi`
--
CREATE DATABASE IF NOT EXISTS `tiandi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tiandi`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
(5, ' Unity-3D', 'http://v.qq.com/iframe/player.html?vid=z01592zs6ck&width=770&height=400&auto=0', 1437463584, ' Unity-3D', '112312312', '你是否早已难以忍受普通路由器的种种问题：无线网络卡顿、家中角落信号弱、安装设置复杂......为了让全家人获得绝佳的极速上网体验，现在是时候换台双频AC智能路由器了：2.4GHz / 5GHz双频并发，速率快3倍；\n人人都会用的两步极简安装、一键信号覆盖拓展、防蹭网等功能，享受简单的智能；支持USB外接硬盘，可脱机下载电影、备份照片，满足娱乐生活的更多需求；支持更多的智能设备的连接与管理，让家就在你手中。', '3,2,3', '3,2,3'),
(6, 'Swift', '#', 1437295073, 'Swift', '', '', '', ''),
(7, 'web', '#', 1437295087, 'web', '', '', '', ''),
(8, ' Cocos2d-x', '#', 1437295116, ' Cocos2d-x', '', '', '', ''),
(9, 'Android', '#', 1437295129, 'Android', '', '', '', ''),
(10, '1', '1', 1437546632, '1', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `classlistcourse`
--

CREATE TABLE IF NOT EXISTS `classlistcourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0为公开课 1为付费课',
  `time` int(13) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `classlistcourse`
--

INSERT INTO `classlistcourse` (`id`, `form`, `type`, `time`, `title`, `content`) VALUES
(1, 1, 1, 1, '2', '32131'),
(2, 1, 1, 1, '2', '32131'),
(3, 1, 1, 1, '2', '32131'),
(4, 1, 1, 1, '2', '32131'),
(5, 1, 1, 1, '2', '32131'),
(6, 1, 1, 1, '2', '32131'),
(7, 1, 1, 1, '2', '32131'),
(8, 1, 1, 1, '2', '32131'),
(9, 1, 1, 1, '2', '32131'),
(10, 1, 0, 1, '2', '32131'),
(11, 1, 1, 1, '2', '32131'),
(12, 1, 1, 1, '2', '32131'),
(15, 1, 1, 1, '2', '32131'),
(24, 10, 0, 1437553127, '3123', '123312'),
(26, 5, 0, 1437602400, '第十部分：web开发案例', '07-23 20:00-21:00'),
(27, 5, 0, 1437602400, '第二部分：CSS基础课程', 'CSS基础课程 07-23 15:00-16:00'),
(28, 5, 0, 1438207200, '三部分：JavaScript入门与实践', 'JavaScript入门与实践 07-30 20:00-21:00'),
(44, 5, 0, 1437602400, '3123', '1312');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `type` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tag`
--

INSERT INTO `tag` (`id`, `form`, `tag`, `url`) VALUES
(3, 5, '测试1', '12312'),
(5, 5, '12312312312312', '12312'),
(6, 5, '123', '231');

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
