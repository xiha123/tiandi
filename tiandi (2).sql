-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-09 08:50:53
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `problem`
--

INSERT INTO `problem` (`id`, `title`, `owner_id`, `answer_id`, `answer_time`, `details`, `comments`, `tags`, `up_count`, `down_count`, `collect_count`, `follow_count`, `view_count`, `ctime`, `type`, `hot`, `follow_users`, `collect_users`, `up_users`, `down_users`) VALUES
(1, '如何理解这 14 道 JavaScript 题？', 3, 4, 1438965680, '[1]', '[]', '[{"name":"javascript"},]', 0, 0, 0, 0, 0, '2015-08-06 14:19:12', 2, 0, '[]', '[]', '[]', '[]'),
(2, 'cscscscscscscscscscscscscscscscs', 3, 0, 0, '[3]', '[]', '[{"name":"cs"},{"name":"cs"},{"name":"cs"},]', 0, 0, 0, 0, 0, '2015-08-06 14:41:24', 0, 0, '[]', '[]', '[]', '[]'),
(3, 'cscscscscscscscscscscs', 3, 0, 0, '[4]', '[]', '[{"name":"cscscscscs"},{"name":"cs"},]', 0, 0, 0, 0, 0, '2015-08-06 14:41:50', 0, 0, '[]', '[]', '[]', '[]'),
(4, 'detail_iddetail_iddetail_iddetail_iddetail', 3, 3, 1438872314, '[]', '[]', '[{"name":"detail_id"},{"name":"detail_id"},{"name":"detail_id"},]', 1, 0, 1, 0, 0, '2015-08-06 14:45:09', 2, 8, '[]', '[]', '[{"id":"4"}]', '[]'),
(5, '对问题的描对问题的描对问题的描对问题的描对问题的描', 3, 3, 1438875465, '[]', '[]', '[{"name":"的题的描对问题"},{"name":"描对问题的描对问"},{"name":"描对问题的描对问"},]', 0, 0, 0, 0, 0, '2015-08-06 15:36:16', 2, 0, '[]', '[]', '[]', '[]'),
(6, '123213121232131212321312', 4, 0, 0, '[]', '[]', '[{"name":"12321312"},{"name":"12321312"},]', 1, 0, 0, 0, 0, '2015-08-07 14:57:51', 0, 5, '[]', '[]', '[{"id":"4"}]', '[]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `problem_detail`
--

INSERT INTO `problem_detail` (`id`, `content`, `type`, `owner_id`, `ctime`, `problem_id`, `code`) VALUES
(1, '<p>1.<br/>(function(){\n    return typeof arguments;})();答案："object"<br/>arguments 是对象，虽然像数组<br/><br/>但不是数组<br/>此外，就算是数组，typeof 返回的也是 "object" <br/><br/>2.<br/>var f = function g(){ return 23; };typeof g();答案：Error<br/>g 未定义。<br/><br/>在 JS 里，声明函数只有 2 种方法：<br/>第 1 种： function foo(){...} （函数声明）<br/>第 2 种： var foo = function(){...} （等号后面必须是匿名函数，这句实质是函数表达式）<br/><br/>除此之外，类似于 var foo = function bar(){...} 这样的东西统一按 2 方法处理，即在函数外部无法通过 bar 访问到函数，因为这已经变成了一个表达式。<br/><br/>但为什么不是 "undefined"？<br/>这里如果求 typeof g ，会返回 undefined，但求的是 g()，所以会去先去调用函数 g，这里就会直接抛出异常，所以是 Error。<br/><br/>3.(function(x){\n    delete x;\n    return x;})(1);答案：1<br/>delete 操作符用于删除对象的成员变量，不能删除函数的参数。<br/><br/>4.<br/>  var y = 1, x = y = typeof x;\n  x;答案："undefined"<br/>先定义了 y 并赋值为 1，然后将 typeof x 赋值给 y ，此时 x 未定义，故为 "undefined"，最后将 y 的值赋给 x<br/><br/>5.<br/>(function f(f){\n    return typeof f();})(function(){ return 1; });答案："number"<br/>在函数里的 f() 其实是参数的那个 f 的执行结果，所以是 typeof 1，也就是 "number"<br/><br/>6.  var foo = {\n    bar: function() { return this.baz; },\n    baz: 1\n  };\n  (function(){\n    return typeof arguments[0]();\n  })(foo.bar);答案："undefined"<br/>经 @里创意 指出，这里的 this 指的是 arguments，经测试确实如此：<br/>注意方括号。<br/><br/>7.<br/>  var foo = {\n    bar: function(){ return this.baz; },\n    baz: 1\n  }\n  typeof (f = foo.bar)();答案："undefined"<br/>这个题我不懂，直接上@Saviio 的回答：<br/>第7题的是因为CallExpression是不带有上下文信息，this会指向global；<br/>当你以foo.bar() 调用时，被调用的function是「MemberExpression」，而如果进行了f=foo.bar()赋值之后，那么function就会变成「CallExpression」了，因此this绑定就失效了。<br/>8.<br/>  var f = (function f(){ return "1"; }, function g(){ return 2; })();\n  typeof f;答案："number"<br/>只有最后面的函数会被执行。<br/><br/><br/>9.<br/>  var x = 1;\n  if (function f(){}) {\n    x += typeof f;\n  }\n  x;答案："1undefined"<br/>括号内的 function f(){} 不是函数声明，会被转换成 true ，因此 f 未定义。<br/><br/>10.<br/>  var x = [typeof x, typeof y][1];\n  typeof typeof x;答案："string"<br/>第一行执行完后 x === "undefined" ，所以连续求 2 次 typeof 还是 "string"<br/><br/>11.<br/> (function(foo){\n    return typeof foo.bar;\n  })({ foo: { bar: 1 } });答案："undefined"<br/>typeof foo.bar 中的 foo 是参数，不多解释了。<br/><br/>12.<br/>(function f(){\n    function f(){ return 1; }\n    return f();\n    function f(){ return 2; }\n  })();答案：2<br/>由于声明提前，后面的 f() 会覆盖前面的 f()<br/><br/>13.<br/>function f(){ return f; }new f() instanceof f;答案：false<br/><br/>因为 f() 内部返回了自己，故此时 new f() 的结果和 f 相等。<br/><br/>14.<br/>with (function(x, undefined){}) length;答案：2<br/>with 限定了作用域是这个函数，function.length 返回函数的参数个数，所以是 2。</p>', 0, 3, '2015-08-06 14:19:12', 1, ''),
(2, '<p>在这里输入您对问题的描述!problemproblemproblemproblemproblemproblemproblem</p>', 1, 3, '2015-08-06 14:20:57', 1, ''),
(3, '<p>在这里输入您对问题的描述!cscscscscscscscscscscscscscscscscscs</p>', 0, 3, '2015-08-06 14:41:24', 1, 'cscscscscscscscscscscscscscscscscscs'),
(4, '<p>在这里输入您对问题的描述!cscscscscscscscscscscscscscscs</p>', 0, 3, '2015-08-06 14:41:50', 1, 'cscscscscscscscscscscscscscscscscscscscs'),
(5, '<p>在这里输入您对问题的描述!detail_iddetail_iddetail_iddetail_iddetail_iddetail_iddetail_iddetail_iddetail_id</p>', 0, 3, '2015-08-06 14:45:09', 4, 'detail_iddetail_iddetail_iddetail_iddetail_iddetail_id'),
(6, '<p>在这里输入您对问题的描述!_iddetail_iddetail_id_iddetail_iddetail_id_iddetail_iddetail_id_iddetail_iddetail_id_iddetail_iddetail_id_iddetail_iddetail_id_iddetail_iddetail_id</p>', 1, 3, '2015-08-06 14:45:21', 4, ''),
(7, '<p>在这里输入您对问题的描述!对问题的描对问题的描对问题的描对问题的描</p>', 0, 3, '2015-08-06 15:36:16', 5, ''),
(8, '<p>$problem_data[&#39;type&#39;] == 1</p>', 1, 3, '2015-08-06 15:37:55', 5, ''),
(9, '<p>在这里输入您对问题的描述!312312</p>', 0, 4, '2015-08-07 14:57:51', 6, '31212312'),
(10, '<p>在这里输入您对问题的描述!123$this->me</p>', 1, 4, '2015-08-07 16:41:25', 1, '$this->me$this->me$this->me');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `nickname`, `name`, `pwd`, `salt`, `type`, `avatar`, `email`, `cellphone`, `description`, `collect_problem_count`, `follow_problem_count`, `ask_count`, `answer_count`, `collect_problems`, `follow_problems`, `skilled_tags`, `alipay`, `gold_coin`, `silver_coin`, `follow_user_count`, `follower_count`, `follow_users`, `followers`) VALUES
(3, 'tocurd', 'tocurd@qq.com', 'deab84ffae16ca3b1c3cc035a5138112', '1f95e2b275', 1, '', '', '', '', 0, 0, 0, 0, '[]', '[]', '[{"t":"1"},{"t":"2"}]', '', 0, 0, 0, 0, '[]', '[]'),
(4, '1312312312', '13', '956549baaa8c287fc7329137dae3dcd9', '377b1328b7', 0, './static/uploads/4.jpg', '123@qq.com', '13123123123', '131231231231312312312313123123123131231231231312312312313123123123131231231231312312312313123123123', 0, 0, 0, 0, '[{"t":"4"}]', '[]', '[{"t":"10"},{"t":"10"},{"t":"2"},{"t":"9"}]', '12312312', 0, 0, 0, 0, '[]', '[]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
