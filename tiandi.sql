-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-11 16:39:40
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
-- 表的结构 `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `pwd` char(32) NOT NULL,
  `salt` char(10) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table for admin account' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `pwd`, `salt`, `nickname`) VALUES
(1, 'tiandi', '933e92d31cdc2748c6f84f26ec090835', '', 'tiandi');

-- --------------------------------------------------------

--
-- 表的结构 `class_guide`
--

CREATE TABLE IF NOT EXISTS `class_guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `class_guide`
--

INSERT INTO `class_guide` (`id`, `name`, `img`, `link`) VALUES
(1, '', '', ''),
(2, '', '', '\r\n'),
(3, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `video` varchar(128) NOT NULL,
  `tags` varchar(256) NOT NULL DEFAULT '[]',
  `description` text NOT NULL,
  `chapters` varchar(512) NOT NULL DEFAULT '[]',
  `steps` varchar(512) NOT NULL DEFAULT '[]',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `title`, `type`, `video`, `tags`, `description`, `chapters`, `steps`) VALUES
(5, 'Unity-3D', 0, '1', '[]', '1321', '[]', '[]'),
(6, 'swift', 1, '#', '[]', '#', '[]', '[]'),
(7, 'web', 2, '#', '[]', 'web', '[]', '[]'),
(8, 'cocos2d-x', 3, '#', '[]', '#', '[]', '[]'),
(9, 'android', 4, '#', '[{"t":2}]', '21321321', '[]', '[{"t":"img","value":"201508111290386719.jpg"}]');

-- --------------------------------------------------------

--
-- 表的结构 `course_chapter`
--

CREATE TABLE IF NOT EXISTS `course_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `course_class`
--

CREATE TABLE IF NOT EXISTS `course_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(125) NOT NULL,
  `content` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `course_step`
--

CREATE TABLE IF NOT EXISTS `course_step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `level` smallint(6) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `content` text NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `down_users` varchar(512) NOT NULL DEFAULT '[]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `problem`
--

INSERT INTO `problem` (`id`, `title`, `owner_id`, `answer_id`, `answer_time`, `details`, `comments`, `tags`, `up_count`, `down_count`, `collect_count`, `follow_count`, `view_count`, `ctime`, `type`, `hot`, `follow_users`, `collect_users`, `up_users`, `down_users`) VALUES
(2, '1232132132112321321321123213213211232132132112321321321', 5, 0, 0, '[]', '[]', '[{"name":"12321321321"},{"name":"12321321321"},{"name":"12321321321"},]', 0, 0, 0, 0, 0, '2015-08-11 14:34:58', 0, 0, '[]', '[]', '[]', '[]');

-- --------------------------------------------------------

--
-- 表的结构 `problem_comment`
--

CREATE TABLE IF NOT EXISTS `problem_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `problem_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `problem_detail`
--

CREATE TABLE IF NOT EXISTS `problem_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `problem_id` int(11) NOT NULL,
  `code` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `problem_detail`
--

INSERT INTO `problem_detail` (`id`, `content`, `type`, `owner_id`, `ctime`, `problem_id`, `code`) VALUES
(2, '<p>12321321321123213213211232132132112321321321123213213211232132132112321321321</p>', 0, 5, '2015-08-11 14:34:58', 2, '123213213211232132132112321321321');

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
  `name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  `color` varchar(32) NOT NULL,
  `type` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `slide`
--

INSERT INTO `slide` (`id`, `name`, `img`, `link`, `color`, `type`, `text`) VALUES
(1, '', '', '', '', 1, ''),
(2, '', '', '', '', 1, ''),
(3, '', '', '', '', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `count` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `content` varchar(256) DEFAULT NULL,
  `json_who` varchar(256) DEFAULT '[]',
  `link` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tag`
--

INSERT INTO `tag` (`id`, `type`, `count`, `name`, `content`, `json_who`, `link`) VALUES
(8, 1, 1, '12321321321', '', '[{"t":"5"}]', '');

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `nickname`, `name`, `pwd`, `salt`, `type`, `avatar`, `email`, `cellphone`, `description`, `god_description`, `collect_problem_count`, `follow_problem_count`, `ask_count`, `answer_count`, `collect_problems`, `follow_problems`, `skilled_tags`, `alipay`, `gold_coin`, `silver_coin`, `follow_user_count`, `follower_count`, `follow_users`, `followers`, `idcar`) VALUES
(5, 'tocurd', '', '83ae4fe597144cb330060fbcf9860592', 'a080b328b7', 0, '', 'tocurd@qq.com', '', '', '', 0, 0, 0, 0, '[]', '[]', '[{"t":"8"}]', '', 0, 0, 0, 0, '[]', '[]', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
