-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 04:46 PM
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
  `nickname` varchar(32) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '2'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Table for admin account';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `pwd`, `salt`, `nickname`, `type`) VALUES
(2, 'tiandi', '48a4f75f294a467d8cff18b4d32350ea', '1', 'tiandi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_guide`
--

CREATE TABLE IF NOT EXISTS `class_guide` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_guide`
--

INSERT INTO `class_guide` (`id`, `name`, `img`, `link`) VALUES
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', '');

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
  `steps` varchar(512) NOT NULL DEFAULT '[]',
  `site` varchar(256) DEFAULT '[]',
  `god` varchar(512) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `title`, `type`, `video`, `tags`, `description`, `chapters`, `steps`, `site`, `god`) VALUES
(10, 'Unity-3D', 0, '', '[]', '', '[]', '[{"t":5},{"t":6},{"t":7},{"t":8},{"t":9},{"t":10},{"t":11}]', '[]', '[]'),
(11, 'Swift', 1, '', '[]', '', '[]', '[]', '[]', '[]'),
(12, 'Web', 2, '', '[]', '', '[]', '[]', '[]', '[]'),
(13, 'Cocos2d-x', 3, '', '[]', '', '[]', '[]', '[]', '[]'),
(14, 'Android', 0, '', '[{"t":6}]', '', '[]', '[]', '[]', '[]');

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
-- Table structure for table `course_step`
--

CREATE TABLE IF NOT EXISTS `course_step` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `level` smallint(6) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_step`
--

INSERT INTO `course_step` (`id`, `title`, `img`, `description`, `level`, `course_id`) VALUES
(5, '1', '201509081221425678.jpg', '1', 1, 10),
(6, '2', '201509081225766569.jpg', '2', 1, 10),
(7, '3', '201509081280543895.jpg', '3', 1, 10),
(8, '4', '201509081262408345.jpg', '4', 1, 10),
(9, '5', '201509081274089232.jpg', '5', 1, 10),
(10, '6', '201509081297867634.jpg', '6', 1, 10),
(11, '7', '201509081220751722.jpg', '7', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `god_course`
--

CREATE TABLE IF NOT EXISTS `god_course` (
  `id` int(11) NOT NULL,
  `god` int(11) NOT NULL,
  `link` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `type` char(3) NOT NULL,
  `problem_id` int(11) NOT NULL DEFAULT '-1',
  `target` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_id` int(11) NOT NULL DEFAULT '-1',
  `status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `type`, `problem_id`, `target`, `ctime`, `from_id`, `status`) VALUES
(12, '000', -1, 4, '2015-08-30 17:44:03', -1, 1),
(13, '401', -1, 3, '2015-08-30 17:45:00', -1, 1),
(14, '200', 10, 4, '2015-08-30 17:45:04', 3, 0),
(15, '201', 10, 4, '2015-08-30 17:45:11', 3, 0),
(16, '402', 10, 3, '2015-08-30 17:45:11', 100, 1),
(17, '001', -1, 2, '2015-09-08 13:13:55', -1, 1),
(18, '001', -1, 2, '2015-09-08 13:15:03', -1, 1),
(19, '000', -1, 5, '2015-09-11 02:54:32', -1, 1),
(20, '300', 21, 4, '2015-09-13 04:31:02', -1, 0),
(21, '200', 23, 4, '2015-09-13 15:00:20', 3, 0);

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
  `collect_count` int(11) NOT NULL DEFAULT '0',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `hot` float NOT NULL DEFAULT '0',
  `collect_users` varchar(512) NOT NULL DEFAULT '[]',
  `up_users` varchar(1024) NOT NULL DEFAULT '[]',
  `gold_coin` int(11) NOT NULL,
  `silver_coin` int(11) NOT NULL,
  `who` varchar(512) DEFAULT '[]',
  `online` varchar(1024) NOT NULL,
  `agree` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `title`, `owner_id`, `answer_id`, `answer_time`, `details`, `comments`, `tags`, `up_count`, `collect_count`, `view_count`, `ctime`, `type`, `hot`, `collect_users`, `up_users`, `gold_coin`, `silver_coin`, `who`, `online`, `agree`) VALUES
(6, 'asdasdasd', 2, 3, 1440947167, '[]', '[1]', '["asd"]', 0, 0, 0, '2015-08-30 13:55:42', 3, 3.25, '[]', '[]', 0, 100, '[]', '[{"key":865115,"time":1440947160}]', 0),
(7, 'ttttttttttttttttttttttttt', 2, 3, 1440947376, '[]', '[]', '["html"]', 0, 0, 0, '2015-08-30 13:56:49', 0, 0.15, '[]', '[]', 0, 100, '[]', '[{"key":865115,"time":1440956700}]', 0),
(8, 'ccccccccccccccccccccccccccc', 3, 0, 0, '[]', '[]', '["html"]', 0, 0, 0, '2015-08-30 14:42:22', 0, 0.09, '[]', '[]', 0, 100, '[]', '', 0),
(9, 'nnnnnnnnnnnnnnnn', 2, 0, 0, '[]', '[]', '["html"]', 0, 0, 0, '2015-08-30 15:08:58', 0, 0.02, '[]', '[]', 0, 100, '[]', '', 0),
(11, 'position:absolute', 2, 0, 0, '[]', '[]', '["position",":absolute"]', 0, 0, 0, '2015-09-09 08:51:07', 0, 0.11, '[]', '[]', 0, 100, '[]', '', 0),
(12, '12321', 2, 0, 0, '[]', '[]', '["127"]', 0, 0, 0, '2015-09-09 09:49:20', 0, 0.36, '[]', '[]', 0, 100, '[]', '', 0),
(13, 'cescescescescescescescescesces', 2, 0, 0, '[]', '[]', '["\\u9996\\u9875","\\u6d4b\\u8bd5","\\u6e38\\u620f","\\u5168\\u90e8"]', 0, 0, 0, '2015-09-09 15:41:30', 0, 0.53, '[]', '[]', 0, 100, '[]', '', 0),
(14, '127127127127127127127127127127127127127127127127', 2, 0, 0, '[]', '[]', '["127","168"]', 0, 0, 0, '2015-09-09 16:02:19', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(15, '12712312321', 2, 0, 0, '[]', '[]', '["123"]', 0, 0, 0, '2015-09-09 16:02:40', 0, 0.29, '[]', '[]', 0, 100, '[]', '', 0),
(16, '调试调试调试调试调试调试调试调试调试调试', 5, 0, 0, '[]', '[]', '["web","wb","ds"]', 0, 0, 0, '2015-09-11 02:54:41', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(17, '调试调试调试调试调试调试调试调试调试', 5, 0, 0, '[]', '[]', '["\\u6d4b\\u8bd5"]', 0, 0, 0, '2015-09-11 02:55:13', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(18, 'asdasdasdsadasdsadasdasdasdas', 5, 0, 0, '[]', '[]', '["Web","webs"]', 0, 0, 0, '2015-09-11 02:55:34', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(19, 'WebWebWebWebWebWeb', 5, 0, 0, '[]', '[]', '["web"]', 0, 0, 0, '2015-09-11 02:57:40', 0, 0.02, '[]', '[]', 0, 100, '[]', '', 0),
(20, 'webwebwebwebwebwebwebwebwebwebwebwebweb', 5, 0, 0, '[]', '[]', '["web"]', 0, 0, 0, '2015-09-11 02:57:54', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(21, '匹配机制测试匹配匹配机制制测试匹配', 5, 0, 0, '[]', '[]', '["\\u6d4b\\u8bd5\\u5339\\u914d"]', 0, 0, 0, '2015-09-11 03:37:23', 0, 0.05, '[]', '[]', 0, 150, '["4"]', '', 0),
(22, 'webwebwebwebwebweb2', 5, 0, 0, '[]', '[]', '["web"]', 0, 0, 0, '2015-09-11 03:38:28', 0, 1.21, '[]', '[]', 0, 100, '[]', '', 0),
(23, '月山习月山习月山习', 4, 3, 1442156420, '[]', '[2]', '[{"t":"html"}]', 0, 0, 0, '2015-09-13 14:47:43', 1, 1.2, '[]', '[]', 0, 100, '[]', '[{"key":550906,"time":1442156434},{"key":865115,"time":1442156462}]', 0),
(24, 'qweqweqwe', 3, 0, 0, '[]', '[]', '[{"t":"web"}]', 0, 0, 0, '2015-09-14 09:40:47', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(25, 'test123test123', 4, 0, 0, '[]', '[]', '[{"t":"C++"}]', 0, 0, 0, '2015-09-15 14:39:43', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0),
(26, '标签中不能存在特殊字符，请检查后再提交', 4, 0, 0, '[]', '[]', '[{"t":"cocos2d-x"}]', 0, 0, 0, '2015-09-15 14:41:38', 0, 0.01, '[]', '[]', 0, 100, '[]', '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem_comment`
--

INSERT INTO `problem_comment` (`id`, `content`, `owner_id`, `ctime`, `problem_id`) VALUES
(1, '在此处输入评论asasdadadad', 3, '2015-08-30 17:42:27', 6),
(2, '<p><span style="display: none; line-height: 0px;">‍</span><br></p>', 4, '2015-09-13 15:01:01', 23);

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
  `code` text NOT NULL,
  `language` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem_detail`
--

INSERT INTO `problem_detail` (`id`, `content`, `type`, `owner_id`, `ctime`, `problem_id`, `code`, `language`) VALUES
(5, '<p>asdasdasdasd</p>', 0, 2, '2015-08-30 13:55:42', 6, '', 'html'),
(6, '<p>xcvxcvxcvxcvasdasdasd</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p>', 0, 2, '2015-08-30 13:56:49', 7, 'ttttttttttttttttttttttttttttttttttt', 'html'),
(7, '<p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p><p>bbbbbbbbbbbbbbbbbbbbbbbbbb</p>', 0, 3, '2015-08-30 14:42:22', 8, '', 'html'),
(8, '<body data-view="1" data-cq="1">\n<link rel="stylesheet" type="text/css" href="http://staticlive.douyutv.com/common/douyu/style/iconfont.css?v=v10213" /><div id="header">\n       <div class="head">\n            <a href="/" class="logo fl"></a>\n            <ul class="header_nav fl js_head_menu">\n               <li><a href="/" class=" js_index_but">首页</a></li>\n               <li><a href="/directory/all" class="current" onmouseover=''$(".js_index_but").removeClass("current");''>直播</a></li>\n               <li id="js_head_game" class="game_menu" data-arrow="menu_sj" data-css="menu_up"  onmouseover=''$(".js_index_but").removeClass("current");'' >\n                 <a href="/directory" data-arrow="menu_sj" data-css="menu_up" class="">游戏</a>\n                 <div class="menu_sj"></div>\n                 <!-- 游戏弹框 -->\n                 <div class="poptip game_cas js_head_show" style="display:none">\n                     <div class="sj_top usercase_top"></div>\n', 1, 3, '2015-08-30 15:06:07', 6, 'vvvvvvvvvvvvvvvvvvvvvvvvvv', 'html'),
(9, '在此处输入您对问题的描述nnnnnnnnnnnnnnnnnnnn', 0, 2, '2015-08-30 15:08:58', 9, '', 'html'),
(10, '<p>bbbbbbbbbbbbbbbbbbbbbbb</p>', 0, 4, '2015-08-30 17:44:51', 10, '', 'html'),
(11, '<p>nnnnnnnnnnnnnnnnnnnnn</p>', 1, 3, '2015-08-30 17:45:11', 10, 'nnnnnnnnnnnnnnnnnnnnnnnnn', 'html'),
(12, '<p><br><span></span>position:absolute;top:60px;bottom:40px;left:50%;margin-left:-1px;width:2px;background:#219ba1;</p>', 0, 2, '2015-09-09 08:51:07', 11, 'position:absolute;top:60px;bottom:40px;left:50%;margin-left:-1px;width:2px;background:#219ba1;', 'html'),
(13, '12312<img src="http://127.168.0.1/tiandi/static/home/student.jpg"></img>', 0, 2, '2015-09-09 09:49:20', 12, '', 'html'),
(14, '<p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;ul class=&quot;header_nav fl js_head_menu&quot;&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;li&gt;&lt;a href=&quot;/&quot; class=&quot; js_index_but&quot;&gt;首页&lt;/a&gt;&lt;/li&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;li&gt;&lt;a href=&quot;/directory/all&quot; class=&quot;current&quot; onmouseover=&#39;$(&quot;.js_index_but&quot;).removeClass(&quot;current&quot;);&#39;&gt;直播&lt;/a&gt;&lt;/li&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;li id=&quot;js_head_game&quot; class=&quot;game_menu&quot; data-arrow=&quot;menu_sj&quot; data-css=&quot;menu_up&quot; &nbsp;onmouseover=&#39;$(&quot;.js_index_but&quot;).removeClass(&quot;current&quot;);&#39; &gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;a href=&quot;/directory&quot; data-arrow=&quot;menu_sj&quot; data-css=&quot;menu_up&quot; class=&quot;&quot;&gt;游戏&lt;/a&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;div class=&quot;menu_sj&quot;&gt;&lt;/div&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;!-- 游戏弹框 --&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;div class=&quot;poptip game_cas js_head_show&quot; style=&quot;display:none&quot;&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;div class=&quot;sj_top usercase_top&quot;&gt;&lt;/div&gt;</span></p><p><span style="white-space: nowrap;"><br></span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;div class=&quot;poptip_nr&quot;&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;h3&gt;热门游戏&lt;/h3&gt;&lt;ul class=&quot;game_btn&quot;&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/LOL&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;英雄联盟&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/How&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;炉石传说&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/DOTA2&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;DOTA2&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/WOW&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;魔兽世界&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/CF&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;穿越火线&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/HOTS&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;风暴英雄&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h3&gt;玩家推荐&lt;/h3&gt;&lt;ul class=&quot;game_btn&quot;&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/classic&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;怀旧游戏&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/phone&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;手游&amp;amp;掌机&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/SC&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;星际争霸&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/DNF&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;地下城与勇士&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/TVgame&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;主机游戏&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/DIABLO3&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;暗黑破坏神3&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/footballgame&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;足球竞技&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/FTG&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;格斗游戏&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;/directory/game/mszb&quot; class=&quot;btn&quot; target=&quot;_blank&quot;&gt;魔兽争霸&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;div&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;a href=&quot;/directory&quot; class=&quot;all_btn dis&quot; target=&quot;_blank&quot;&gt;全部&gt;&gt;&lt;/a&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/div&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;div class=&quot;expres_pic&quot;&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;span &nbsp;class=&quot;sign_posid&quot; data-sign_posid=&quot;1&quot; id=&quot;sign_p_1&quot; style=&quot;display: none&quot;&gt;&lt;/span&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;/div&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;/div&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;/div&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;!-- 游戏弹框 --&gt;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;/li&gt;&nbsp;</span></p><p><span style="white-space: nowrap;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p><p><br></p>', 0, 2, '2015-09-09 15:41:30', 13, '', 'html'),
(15, '<p><br><span></span>1271231212<img src="http://127.168.0.1/tiandi/ueditor/php/upload/20150910/14418145364594.jpg"></p>', 0, 2, '2015-09-09 16:02:19', 14, '127127127127', 'html'),
(16, '<p><br><span></span><img src="http://127.168.0.1/tiandi/ueditor/php/upload/20150910/144181455051.jpg">12321312321312</p>', 0, 2, '2015-09-09 16:02:40', 15, '12312', 'html'),
(17, '<p><br><span></span>调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试<span></span></p>', 0, 5, '2015-09-11 02:54:41', 16, '调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试调试', 'html'),
(18, '<p style="margin-top: 0px; margin-bottom: 0px; line-height: 20px; max-width: 760px; font-family: &#39;Segoe UI&#39;, &#39;Lucida Grande&#39;, Helvetica, &#39;Microsoft YaHei&#39;, FreeSans, Arimo, &#39;Droid Sans&#39;, &#39;wenquanyi micro hei&#39;, &#39;Hiragino Sans GB&#39;, &#39;Hiragino Sans GB W3&#39;, Arial, sans-serif; font-size: 14px; white-space: normal;"><span style="color:#43a8ad"><span style="max-width: 760px;">测试</span></span>匹配机制测试匹配机制测试匹配机制测试</p><p style="margin-top: 0px; margin-bottom: 0px; line-height: 20px; max-width: 760px; font-family: &#39;Segoe UI&#39;, &#39;Lucida Grande&#39;, Helvetica, &#39;Microsoft YaHei&#39;, FreeSans, Arimo, &#39;Droid Sans&#39;, &#39;wenquanyi micro hei&#39;, &#39;Hiragino Sans GB&#39;, &#39;Hiragino Sans GB W3&#39;, Arial, sans-serif; font-size: 14px; white-space: normal;"><br></p><p style="margin-top: 0px; margin-bottom: 0px; line-height: 20px; max-width: 760px; font-family: &#39;Segoe UI&#39;, &#39;Lucida Grande&#39;, Helvetica, &#39;Microsoft YaHei&#39;, FreeSans, Arimo, &#39;Droid Sans&#39;, &#39;wenquanyi micro hei&#39;, &#39;Hiragino Sans GB&#39;, &#39;Hiragino Sans GB W3&#39;, Arial, sans-serif; font-size: 14px; white-space: normal;">匹配机制只有一个Web标签</p><p><span></span><br></p>', 0, 5, '2015-09-11 02:55:13', 17, '测试', 'html'),
(19, '<p><br><span></span></p><p style="margin-top: 0px; margin-bottom: 0px; line-height: 20px; max-width: 760px; font-family: &#39;Segoe UI&#39;, &#39;Lucida Grande&#39;, Helvetica, &#39;Microsoft YaHei&#39;, FreeSans, Arimo, &#39;Droid Sans&#39;, &#39;wenquanyi micro hei&#39;, &#39;Hiragino Sans GB&#39;, &#39;Hiragino Sans GB W3&#39;, Arial, sans-serif; font-size: 14px; white-space: normal;"><a href="http://test.tiandipeixun.com/tag?name=%E6%B5%8B%E8%AF%95" style="max-width: 760px; color: rgb(67, 168, 173);">测试</a>匹配机制测试匹配机制测试匹配机制测试匹配机制</p><p style="margin-top: 0px; margin-bottom: 0px; line-height: 20px; max-width: 760px; font-family: &#39;Segoe UI&#39;, &#39;Lucida Grande&#39;, Helvetica, &#39;Microsoft YaHei&#39;, FreeSans, Arimo, &#39;Droid Sans&#39;, &#39;wenquanyi micro hei&#39;, &#39;Hiragino Sans GB&#39;, &#39;Hiragino Sans GB W3&#39;, Arial, sans-serif; font-size: 14px; white-space: normal;"><br style="word-break: break-all; max-width: 760px; margin: 14px 0px;"></p><p style="margin-top: 0px; margin-bottom: 0px; line-height: 20px; max-width: 760px; font-family: &#39;Segoe UI&#39;, &#39;Lucida Grande&#39;, Helvetica, &#39;Microsoft YaHei&#39;, FreeSans, Arimo, &#39;Droid Sans&#39;, &#39;wenquanyi micro hei&#39;, &#39;Hiragino Sans GB&#39;, &#39;Hiragino Sans GB W3&#39;, Arial, sans-serif; font-size: 14px; white-space: normal;">只有一个Web标签</p><p><br></p>', 0, 5, '2015-09-11 02:55:34', 18, '', 'html'),
(20, '<p><br><span></span><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; white-space: pre-wrap;">Web</span><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; white-space: pre-wrap;">WebWebWebWebWebWebWeb</span></p>', 0, 5, '2015-09-11 02:57:40', 19, 'WebWebWebWebWebWeb', 'html'),
(21, '<p><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span><span style="white-space: normal;">web</span></p>', 0, 5, '2015-09-11 02:57:54', 20, 'webwebwebwebwebwebweb', 'html'),
(22, '<p><span></span></p><p><span><span>Web</span></span></p><p>匹配机制测试匹配匹配机制制测试匹配匹配机制测试匹配匹配机制制测试匹配<span></span></p>', 0, 5, '2015-09-11 03:37:23', 21, 'WebWebWebWebWebWebWebWebWeb', 'html'),
(23, '<p><span style="color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: medium;">测试匹配机制测试匹配机制测试匹配机制测试匹配机制</span><br></p><p style="color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: medium; white-space: normal;"><br></p><p style="color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: medium; white-space: normal;">只有一个web标签</p><p><br></p>', 0, 5, '2015-09-11 03:38:28', 22, 'webwebwebwebwebwebweb', 'html'),
(24, '<p><br><span></span><span style="color: rgb(102, 102, 102); font-family: STHeiti, &#39;Microsoft YaHei&#39;, arial, 宋体; font-size: 12px; line-height: 15px; white-space: normal;">月山习</span><span style="color: rgb(102, 102, 102); font-family: STHeiti, &#39;Microsoft YaHei&#39;, arial, 宋体; font-size: 12px; line-height: 15px; white-space: normal;">月山习</span><span style="color: rgb(102, 102, 102); font-family: STHeiti, &#39;Microsoft YaHei&#39;, arial, 宋体; font-size: 12px; line-height: 15px; white-space: normal;">月山习</span><span style="color: rgb(102, 102, 102); font-family: STHeiti, &#39;Microsoft YaHei&#39;, arial, 宋体; font-size: 12px; line-height: 15px; white-space: normal;">月山习</span><span style="color: rgb(102, 102, 102); font-family: STHeiti, &#39;Microsoft YaHei&#39;, arial, 宋体; font-size: 12px; line-height: 15px; white-space: normal;">月山习</span></p>', 0, 4, '2015-09-13 14:47:43', 23, '', 'html'),
(25, '<p><span style="white-space: normal;">qweqweqwe</span><span style="white-space: normal;">qweqweqwe</span><span style="white-space: normal;">qweqweqwe</span><span style="white-space: normal;">qweqweqwe</span><span style="white-space: normal;">qweqweqwe</span></p>', 0, 3, '2015-09-14 09:40:47', 24, '', 'html'),
(26, '<p><br><span></span>test123test123test123test123</p>', 0, 4, '2015-09-15 14:39:43', 25, '', 'c'),
(27, '<p><br><span></span><span style="color: rgb(196, 26, 22); font-family: Consolas, &#39;Lucida Console&#39;, monospace; font-size: 12px; line-height: 12px;">标签中不能存在特殊字符，请检查后再提交</span><span style="color: rgb(196, 26, 22); font-family: Consolas, &#39;Lucida Console&#39;, monospace; font-size: 12px; line-height: 12px;">标签中不能存在特殊字符，请检查后再提交</span></p>', 0, 4, '2015-09-15 14:41:38', 26, '', 'html');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `name`, `img`, `link`, `color`, `type`, `text`) VALUES
(4, '', '', '', '', 1, ''),
(5, '', '', '', '', 1, ''),
(6, '', '', '', '', 1, ''),
(7, '123', '201509091279860748.jpg', '123', '123', 0, '213');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `type`, `count`, `name`, `content`, `json_who`, `link`) VALUES
(4, 0, 0, 'asd', '', '[]', ''),
(5, 0, 1, 'html', '', '[]', ''),
(7, 0, 0, 'position', '', '[]', ''),
(8, 0, 0, ':absolute', '', '[]', ''),
(9, 0, 0, '127', '', '[]', ''),
(10, 0, 0, '首页', '', '[]', ''),
(11, 0, 0, '测试', '', '[]', ''),
(12, 0, 0, '游戏', '', '[]', ''),
(13, 0, 0, '全部', '', '[]', ''),
(16, 0, 1, 'web', '', '[]', ''),
(17, 0, 0, 'wb', '', '[]', ''),
(18, 0, 0, 'ds', '', '[]', ''),
(19, 0, 0, 'webs', '', '[]', ''),
(20, 0, 0, '测试匹配', '', '[]', ''),
(21, 0, 1, 'C++', '', '[]', ''),
(22, 0, 1, 'cocos2d-x', '', '[]', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
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
  `ask_count` int(11) NOT NULL DEFAULT '0',
  `answer_count` int(11) NOT NULL DEFAULT '0',
  `collect_problems` varchar(1024) NOT NULL DEFAULT '[]',
  `skilled_tags` varchar(256) NOT NULL DEFAULT '[]',
  `god_skilled_tags` varchar(126) NOT NULL DEFAULT '[]',
  `alipay` varchar(64) NOT NULL,
  `gold_coin` int(11) NOT NULL DEFAULT '0',
  `silver_coin` int(11) NOT NULL DEFAULT '0',
  `follow_user_count` int(11) NOT NULL DEFAULT '0',
  `follower_count` int(11) NOT NULL DEFAULT '0',
  `follow_users` varchar(1024) NOT NULL DEFAULT '[]',
  `followers` varchar(1024) NOT NULL DEFAULT '[]',
  `father_tag` int(11) NOT NULL,
  `Integral` int(11) NOT NULL,
  `notes` varchar(512) NOT NULL,
  `lost_time` int(11) NOT NULL,
  `prestige` int(11) NOT NULL,
  `chou` varchar(512) NOT NULL DEFAULT '[]',
  `teacher` int(11) NOT NULL,
  `key` varchar(256) NOT NULL,
  `email_active` int(11) NOT NULL,
  `course` varchar(512) NOT NULL DEFAULT '[]',
  `oauth_key` varchar(128) NOT NULL,
  `god_course_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nickname`, `name`, `pwd`, `salt`, `type`, `avatar`, `email`, `cellphone`, `description`, `god_description`, `collect_problem_count`, `ask_count`, `answer_count`, `collect_problems`, `skilled_tags`, `god_skilled_tags`, `alipay`, `gold_coin`, `silver_coin`, `follow_user_count`, `follower_count`, `follow_users`, `followers`, `father_tag`, `Integral`, `notes`, `lost_time`, `prestige`, `chou`, `teacher`, `key`, `email_active`, `course`, `oauth_key`, `god_course_count`) VALUES
(2, '123123', '', '5e5b75a978d06450f26777ce84abd604', '30af7dba56', 0, '', 'tocurd@qq.com', '', '', '', 0, 0, 0, '[]', '[]', '[]', '', 0, 9999700, 0, 0, '[]', '[]', 0, 800, '', 0, 0, '[]', 0, 'ea619a14317d63c96988f80cb366471850799c220b1aec07d26f83f2daa28a58', 0, '[]', '', 0),
(3, 'qweqwe', '', 'b65aab0f546c6ac1caeb8f9ac8e4e106', '30df9a354a', 1, '', 'qwe@qwe.com', '', '', 'Cocos2D-XCocos2D-XCocos2D-XCocos2D-X', 0, 0, 0, '[]', '[]', '["web"]', 'Cocos2D-XCocos2D-X', 0, 520, 0, 0, '[]', '[]', 0, 250, '', 0, 1, '[]', 0, '', 0, '[]', '', 0),
(4, 'asdasd', '', '7ebb96173107f626ce182470170cc6f8', '340e3a500b', 0, '', 'asd@asd.com', '', '', '', 0, 0, 0, '[]', '[]', '[]', '', 0, 1111070, 0, 0, '[]', '[]', 0, 580, '', 0, 0, '["21"]', 0, '', 0, '[]', '', 0),
(5, 'tocurd', '', '7629d7f26c7cb9bcec7bd65de8ba7a1c', '24268040d9', 1, '', 'tocurd2@qq.com', '', '', '', 0, 0, 0, '[]', '[]', '[]', '', 0, 999800, 0, 0, '[]', '[]', 0, 700, '', 0, 0, '[]', 0, '', 0, '["14"]', '', 0);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `course_step`
--
ALTER TABLE `course_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `god_course`
--
ALTER TABLE `god_course`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `class_guide`
--
ALTER TABLE `class_guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `course_chapter`
--
ALTER TABLE `course_chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_step`
--
ALTER TABLE `course_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `god_course`
--
ALTER TABLE `god_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `problem_comment`
--
ALTER TABLE `problem_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `problem_detail`
--
ALTER TABLE `problem_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `change_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` decimal(8,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `count_type` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

ALTER TABLE `user`
ADD COLUMN `sign_info` VARCHAR(255) NULL DEFAULT '{}' COMMENT '' AFTER `god_course_count`;

CREATE TABLE `user_task` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  `task_id` INT NOT NULL COMMENT '',
  `created_at` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');


ALTER TABLE `user`
ADD COLUMN `parent_id` INT NULL DEFAULT 0 COMMENT '' AFTER `sign_info`;

ALTER TABLE `user_task`
ADD COLUMN `task_val` VARCHAR(45) NULL DEFAULT '' COMMENT '' AFTER `created_at`;
ALTER TABLE `problem`
ADD COLUMN `is_prestige` INT NULL DEFAULT 0 COMMENT '是否 赞数超过20是奖励过大神经验' AFTER `agree`;

ALTER TABLE `tag`
ADD COLUMN `active_god` VARCHAR(2048) DEFAULT '{}' AFTER `link`;
ALTER TABLE `tag`
ADD COLUMN `active_stu` VARCHAR(2048) DEFAULT '{}' AFTER `link`;
