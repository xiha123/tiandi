-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-09 10:31:11
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `title`, `type`, `video`, `tags`, `description`, `chapters`, `steps`) VALUES
(1, '123', 0, '312312', '[]', '12312', '[]', '[]'),
(2, '1231', 0, '312312', '[]', '312', '[]', '[]'),
(3, '12312', 0, '12312', '[]', '3', '[]', '[]');

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

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `type`, `content`, `from`, `to`, `time`) VALUES
(1, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863663),
(2, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863727),
(3, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863727),
(4, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863743),
(5, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863744),
(6, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863746),
(7, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863752),
(8, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438863810),
(9, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868226),
(10, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868231),
(11, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868236),
(12, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868266),
(13, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868274),
(14, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868290),
(15, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868300),
(16, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868382),
(17, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868385),
(18, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868438),
(19, 0, '大神tocurd认领了您的问题，为什么说话时觉得自己说得很有道理，事后听录音时却感觉不对？', 0, 3, 1438868513),
(20, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438868672),
(21, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438870143),
(22, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438870554),
(23, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438870557),
(24, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438870571),
(25, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438870581),
(26, 0, '大神tocurd认领了您的问题，测试测试测试测试测试测试测试测试', 0, 3, 1438870586),
(27, 0, '大神tocurd认领了您的问题，如何理解这 14 道 JavaScript 题？', 0, 3, 1438870765),
(28, 0, '大神tocurd认领了您的问题，如何理解这 14 道 JavaScript 题？', 0, 3, 1438870874),
(29, 0, '大神tocurd认领了您的问题，如何理解这 14 道 JavaScript 题？', 0, 3, 1438870933),
(30, 0, '大神tocurd认领了您的问题，detail_iddetail_iddetail_iddetail_iddetail', 0, 3, 1438872314),
(31, 0, 'tocurd 关注了您的问题：detail_iddetail_iddetail_iddetail_iddetail', 3, 3, 1438872477),
(32, 0, '13 关注了您的问题：detail_iddetail_iddetail_iddetail_iddetail', 4, 3, 1438873529),
(33, 0, '13 取消关注了您的问题：detail_iddetail_iddetail_iddetail_iddetail', 4, 3, 1438873627),
(34, 0, '13 关注了您的问题：detail_iddetail_iddetail_iddetail_iddetail', 4, 3, 1438873628),
(35, 0, '13 取消关注了您的问题：detail_iddetail_iddetail_iddetail_iddetail', 4, 3, 1438874542),
(36, 0, 'tocurd 取消关注了您的问题：detail_iddetail_iddetail_iddetail_iddetail', 3, 3, 1438875217),
(37, 0, '大神tocurd认领了您的问题，对问题的描对问题的描对问题的描对问题的描对问题的描', 0, 3, 1438875465),
(38, 0, '大神1312312312认领了您的问题，如何理解这 14 道 JavaScript 题？', 0, 3, 1438965680),
(39, 0, '大神1312312312认领了您的问题，如何理解这 14 道 JavaScript 题？', 0, 3, 1438965686),
(40, 0, '大神：1312312312 回答了您的问题，如何理解这 14 道 JavaScript 题？，快去看看吧！', 0, 3, 1438965686),
(41, 0, '1312312312 关注了您的问题：123213121232131212321312', 4, 4, 1439102648),
(42, 0, '1312312312 关注了您的问题：123213121232131212321312', 4, 4, 1439102648),
(43, 0, '1312312312 取消关注了您的问题：123213121232131212321312', 4, 4, 1439102651);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `problem`
--

INSERT INTO `problem` (`id`, `title`, `owner_id`, `answer_id`, `answer_time`, `details`, `comments`, `tags`, `up_count`, `down_count`, `collect_count`, `follow_count`, `view_count`, `ctime`, `type`, `hot`, `follow_users`, `collect_users`, `up_users`, `down_users`) VALUES
(1, '测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章', 4, 0, 0, '[]', '[]', '[{"name":"测试文章"},{"name":"12231"},{"name":"javascript"},{"name":"php"},{"name":"jquery"},]', 0, 0, 0, 0, 0, '2015-08-09 06:51:39', 0, 0, '[]', '[]', '[]', '[]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `problem_detail`
--

INSERT INTO `problem_detail` (`id`, `content`, `type`, `owner_id`, `ctime`, `problem_id`, `code`) VALUES
(1, '<p>测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章</p>', 0, 4, '2015-08-09 06:51:39', 1, '测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章测试文章');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `slide`
--

INSERT INTO `slide` (`id`, `name`, `img`, `link`, `color`, `type`, `text`) VALUES
(1, '123123', '201508071246619388.jpg', '132123', '1123', 0, '13123123');

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tag`
--

INSERT INTO `tag` (`id`, `type`, `count`, `name`, `content`, `json_who`) VALUES
(1, 1, 1, '测试文章', '', '[{"t":"4"},{"t":"3"}]'),
(2, 1, 0, '12231', '', '[]'),
(3, 1, 0, 'javascript', '', '[]'),
(4, 1, 0, 'php', '', '[]'),
(5, 1, 0, 'jquery', '', '[]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `nickname`, `name`, `pwd`, `salt`, `type`, `avatar`, `email`, `cellphone`, `description`, `god_description`, `collect_problem_count`, `follow_problem_count`, `ask_count`, `answer_count`, `collect_problems`, `follow_problems`, `skilled_tags`, `alipay`, `gold_coin`, `silver_coin`, `follow_user_count`, `follower_count`, `follow_users`, `followers`, `idcar`) VALUES
(3, 'tocurd', 'tocurd@qq.com', 'deab84ffae16ca3b1c3cc035a5138112', '1f95e2b275', 1, '', '', '', '', '', 0, 0, 0, 0, '[]', '[]', '[{"t":"1"},{"t":"2"}]', '', 0, 0, 0, 0, '[]', '[]', ''),
(4, '1312312312', '123', '956549baaa8c287fc7329137dae3dcd9', '377b1328b7', 2, './static/uploads/4.jpg', '123@qq.com', '15562288082', '3123123', '', 0, 0, 0, 0, '[{"t":"4"}]', '[]', '[{"t":"10"},{"t":"10"},{"t":"2"},{"t":"9"},{"t":"1"}]', '123123', 0, 0, 0, 0, '[]', '[]', '37080219960126031X');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
