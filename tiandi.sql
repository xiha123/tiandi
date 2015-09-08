-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-09-08 15:06:02
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
  `type` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table for admin account' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `pwd`, `salt`, `nickname`, `type`) VALUES
(2, 'tiandi', '48a4f75f294a467d8cff18b4d32350ea', '1', 'tiandi', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `class_guide`
--

INSERT INTO `class_guide` (`id`, `name`, `img`, `link`) VALUES
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', '');

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
  `site` varchar(256) DEFAULT '[]',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `title`, `type`, `video`, `tags`, `description`, `chapters`, `steps`, `site`) VALUES
(10, 'Unity-3D', 0, '', '[]', '', '[]', '[]', '[]'),
(11, 'Swift', 1, '', '[]', '', '[]', '[]', '[]'),
(12, 'Web', 2, '', '[]', '', '[]', '[]', '[]'),
(13, 'Cocos2d-x', 3, '', '[]', '', '[]', '[]', '[]'),
(14, 'Android', 4, '', '[]', '', '[]', '[]', '[]');

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
  `form` int(11) NOT NULL,
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
  `type` char(3) NOT NULL,
  `problem_id` int(11) NOT NULL DEFAULT '-1',
  `target` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_id` int(11) NOT NULL DEFAULT '-1',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `type`, `problem_id`, `target`, `ctime`, `from_id`, `status`) VALUES
(12, '000', -1, 4, '2015-08-30 17:44:03', -1, 1),
(13, '401', -1, 3, '2015-08-30 17:45:00', -1, 1),
(14, '200', 10, 4, '2015-08-30 17:45:04', 3, 0),
(15, '201', 10, 4, '2015-08-30 17:45:11', 3, 0),
(16, '402', 10, 3, '2015-08-30 17:45:11', 100, 1);

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `note_group`
--

CREATE TABLE IF NOT EXISTS `note_group` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `list` text NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `hot` float NOT NULL DEFAULT '0',
  `follow_users` varchar(1024) NOT NULL DEFAULT '[]',
  `collect_users` varchar(512) NOT NULL DEFAULT '[]',
  `up_users` varchar(1024) NOT NULL DEFAULT '[]',
  `down_users` varchar(512) NOT NULL DEFAULT '[]',
  `gold_coin` int(11) NOT NULL,
  `silver_coin` int(11) NOT NULL,
  `who` varchar(512) DEFAULT '[]',
  `online` varchar(1024) NOT NULL,
  `agree` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `problem`
--

INSERT INTO `problem` (`id`, `title`, `owner_id`, `answer_id`, `answer_time`, `details`, `comments`, `tags`, `up_count`, `down_count`, `collect_count`, `follow_count`, `view_count`, `ctime`, `type`, `hot`, `follow_users`, `collect_users`, `up_users`, `down_users`, `gold_coin`, `silver_coin`, `who`, `online`, `agree`) VALUES
(6, 'asdasdasd', 2, 3, 1440947167, '[]', '[1]', '[{"t":"asd"}]', 0, 0, 0, 0, 0, '2015-08-30 13:55:42', 3, 1.6, '[]', '[]', '[]', '[]', 0, 100, '[]', '[{"key":865115,"time":1440947160}]', 0),
(7, 'ttttttttttttttttttttttttt', 2, 3, 1440947376, '[]', '[]', '[{"t":"html"}]', 0, 0, 0, 0, 0, '2015-08-30 13:56:49', 0, 0.15, '[]', '[]', '[]', '[]', 0, 100, '[]', '[{"key":865115,"time":1440956700}]', 0),
(8, 'ccccccccccccccccccccccccccc', 3, 0, 0, '[]', '[]', '[{"t":"html"}]', 0, 0, 0, 0, 0, '2015-08-30 14:42:22', 0, 0.09, '[]', '[]', '[]', '[]', 0, 100, '[]', '', 0),
(9, 'nnnnnnnnnnnnnnnn', 2, 0, 0, '[]', '[]', '[{"t":"html"}]', 0, 0, 0, 0, 0, '2015-08-30 15:08:58', 0, 0.02, '[]', '[]', '[]', '[]', 0, 100, '[]', '', 0),
(10, 'bbbbbbbbbbbbbbbbbb', 4, 3, 1440956711, '[]', '[]', '[{"t":"html"}]', 0, 0, 0, 0, 0, '2015-08-30 17:44:51', 3, 0.07, '[]', '[]', '[]', '[]', 0, 100, '[]', '[{"key":865115,"time":1440956705}]', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `problem_comment`
--

INSERT INTO `problem_comment` (`id`, `content`, `owner_id`, `ctime`, `problem_id`) VALUES
(1, '在此处输入评论asasdadadad', 3, '2015-08-30 17:42:27', 6);

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
  `language` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `problem_detail`
--

INSERT INTO `problem_detail` (`id`, `content`, `type`, `owner_id`, `ctime`, `problem_id`, `code`, `language`) VALUES
(5, '<p>asdasdasdasd</p>', 0, 2, '2015-08-30 13:55:42', 6, '', 'html'),
(6, '<p>xcvxcvxcvxcvasdasdasd</p>', 0, 2, '2015-08-30 13:56:49', 7, 'ttttttttttttttttttttttttttttttttttt', 'html'),
(7, '<p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p>', 0, 3, '2015-08-30 14:42:22', 8, '', 'html'),
(8, '<p>vvvvvvvvvvvvvvvvvvvvvvvv</p>', 1, 3, '2015-08-30 15:06:07', 6, 'vvvvvvvvvvvvvvvvvvvvvvvvvv', 'html'),
(9, '在此处输入您对问题的描述nnnnnnnnnnnnnnnnnnnn', 0, 2, '2015-08-30 15:08:58', 9, '', 'html'),
(10, '<p>bbbbbbbbbbbbbbbbbbbbbbb</p>', 0, 4, '2015-08-30 17:44:51', 10, '', 'html'),
(11, '<p>nnnnnnnnnnnnnnnnnnnnn</p>', 1, 3, '2015-08-30 17:45:11', 10, 'nnnnnnnnnnnnnnnnnnnnnnnnn', 'html');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `slide`
--

INSERT INTO `slide` (`id`, `name`, `img`, `link`, `color`, `type`, `text`) VALUES
(4, '', '', '', '', 1, ''),
(5, '', '', '', '', 1, ''),
(6, '', '', '', '', 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tag`
--

INSERT INTO `tag` (`id`, `type`, `count`, `name`, `content`, `json_who`, `link`) VALUES
(4, 0, 0, 'asd', '', '[]', ''),
(5, 0, 0, 'html', '', '[]', '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(64) NOT NULL,
  `name` varchar(10) NOT NULL,
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
  `god_skilled_tags` varchar(126) NOT NULL DEFAULT '[]',
  `alipay` varchar(64) NOT NULL,
  `gold_coin` int(11) NOT NULL DEFAULT '0',
  `silver_coin` int(11) NOT NULL DEFAULT '0',
  `follow_user_count` int(11) NOT NULL DEFAULT '0',
  `follower_count` int(11) NOT NULL DEFAULT '0',
  `agree_count` int(11) NOT NULL,
  `follow_users` varchar(1024) NOT NULL DEFAULT '[]',
  `followers` varchar(1024) NOT NULL DEFAULT '[]',
  `idcar` varchar(44) NOT NULL,
  `father_tag` int(11) NOT NULL,
  `Integral` int(11) NOT NULL,
  `notes` varchar(512) NOT NULL,
  `lost_time` int(11) NOT NULL,
  `prestige` int(11) NOT NULL,
  `chou` varchar(512) NOT NULL DEFAULT '[]',
  `teacher` int(11) NOT NULL,
  `key` varchar(256) NOT NULL,
  `email_activa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `nickname`, `name`, `pwd`, `salt`, `type`, `avatar`, `email`, `cellphone`, `description`, `god_description`, `collect_problem_count`, `follow_problem_count`, `ask_count`, `answer_count`, `collect_problems`, `follow_problems`, `skilled_tags`, `god_skilled_tags`, `alipay`, `gold_coin`, `silver_coin`, `follow_user_count`, `follower_count`, `agree_count`, `follow_users`, `followers`, `idcar`, `father_tag`, `Integral`, `notes`, `lost_time`, `prestige`, `chou`, `teacher`, `key`, `email_activa`) VALUES
(2, '123123', '', 'f554fb16bfc063cd058cf3ee7097953b', '30af7dba56', 0, '', 'tocurd@qq.com', '', '', '', 0, 0, 0, 0, '[]', '[]', '[]', '[]', '', 0, 200, 0, 0, 0, '[]', '[]', '', 0, 300, '', 0, 0, '[]', 0, '', 0),
(3, 'qweqwe', '', 'b65aab0f546c6ac1caeb8f9ac8e4e106', '30df9a354a', 1, '', 'qwe@qwe.com', '', '', '', 0, 0, 0, 0, '[]', '[]', '[]', '[]', '', 0, 620, 0, 0, 0, '[]', '[]', '', 0, 150, '', 0, 1, '[]', 0, '', 0),
(4, 'asdasd', '', '7ebb96173107f626ce182470170cc6f8', '340e3a500b', 0, '', 'asd@asd.com', '', '', '', 0, 0, 0, 0, '[]', '[]', '[]', '[]', '', 0, 400, 0, 0, 0, '[]', '[]', '', 0, 100, '', 0, 0, '[]', 0, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
