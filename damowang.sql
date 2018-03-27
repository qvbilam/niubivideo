-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-27 08:19:19
-- 服务器版本： 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `damowang`
--

-- --------------------------------------------------------

--
-- 表的结构 `damowang_article`
--

DROP TABLE IF EXISTS `damowang_article`;
CREATE TABLE IF NOT EXISTS `damowang_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `orderby` int(11) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `editorValue` longtext NOT NULL,
  `articletype` int(11) NOT NULL,
  `inttime` int(11) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  `state` int(11) NOT NULL DEFAULT '1',
  `deleteTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='资讯';

--
-- 转存表中的数据 `damowang_article`
--

INSERT INTO `damowang_article` (`id`, `uid`, `username`, `orderby`, `title`, `editorValue`, `articletype`, `inttime`, `hits`, `state`, `deleteTime`) VALUES
(1, '1', 'admin', 0, 'sadasd', '<p>asdasda</p>', 0, 1521873044, 1, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_auth`
--

DROP TABLE IF EXISTS `damowang_auth`;
CREATE TABLE IF NOT EXISTS `damowang_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authname` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL,
  `c` varchar(200) NOT NULL,
  `a` varchar(200) NOT NULL,
  `path` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `deleteTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='权限位';

--
-- 转存表中的数据 `damowang_auth`
--

INSERT INTO `damowang_auth` (`id`, `authname`, `pid`, `c`, `a`, `path`, `level`, `deleteTime`) VALUES
(1, '管理员管理', 0, 'admin_list', '', '1', 0, NULL),
(2, '角色管理', 1, 'admin_list', 'adminrole', '1-2', 0, NULL),
(3, '权限管理', 1, 'admin_lsit', 'adminpermission', '1-3', 1, NULL),
(4, '管理员列表', 1, 'admin_list', 'adminlist', '1-4', 1, NULL),
(5, '用户管理', 0, 'member', '', '5', 0, NULL),
(6, '用户列表', 5, 'member', 'memberlist', '5-6', 1, NULL),
(7, '删除的用户', 5, 'member', 'memberdel', '5-7', 1, NULL),
(8, 'VIP用户', 5, 'member', 'memberviplist', '5-8', 1, NULL),
(9, '积分管理', 5, 'member', 'memberscoreoperation', '5-9', 1, NULL),
(10, '浏览记录', 5, 'member', 'memberrecordbrowse', '5-10', 1, NULL),
(11, '评论管理', 0, 'lists', '', '11', 0, NULL),
(12, '意见反馈', 11, 'list', 'feedbacklist', '11-12', 1, NULL),
(13, '资讯管理', 0, 'index', '', '13', 0, NULL),
(14, '资讯列表', 13, 'index', 'articlelist', '13-14', 1, NULL),
(15, '资源管理', 0, '', '', '15', 0, NULL),
(16, '视频管理', 15, '', '', '15-16', 1, NULL),
(17, '分类管理', 15, ' ', ' ', '15-17', 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_controllerinfo`
--

DROP TABLE IF EXISTS `damowang_controllerinfo`;
CREATE TABLE IF NOT EXISTS `damowang_controllerinfo` (
  `id` int(11) NOT NULL,
  `statusid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `damowang_feed`
--

DROP TABLE IF EXISTS `damowang_feed`;
CREATE TABLE IF NOT EXISTS `damowang_feed` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` varchar(200) NOT NULL,
  `tijiaotime` int(11) DEFAULT NULL,
  `deleteTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='意见反馈';

--
-- 转存表中的数据 `damowang_feed`
--

INSERT INTO `damowang_feed` (`fid`, `uid`, `type`, `content`, `tijiaotime`, `deleteTime`) VALUES
(1, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(3, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(4, 1, '萨达', '萨达阿达', 1521268442, NULL),
(5, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(6, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(7, 1, '萨达', '萨达阿达', 1521268442, NULL),
(8, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(9, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(10, 1, '萨达', '萨达阿达', 1521268442, NULL),
(11, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(12, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(13, 1, '萨达', '萨达阿达', 1521268442, NULL),
(14, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(15, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(16, 1, '萨达', '萨达阿达', 1521268442, NULL),
(17, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(18, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(19, 1, '萨达', '萨达阿达', 1521268442, NULL),
(20, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(21, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(22, 1, '萨达', '萨达阿达', 1521268442, NULL),
(23, 1, '萨达', '萨达阿萨德', 1521268442, NULL),
(24, 1, '奥术大师大', '萨达阿萨斯', 1521268442, NULL),
(25, 1, '萨达', '萨达阿达', 1521268442, 1521602191);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_history`
--

DROP TABLE IF EXISTS `damowang_history`;
CREATE TABLE IF NOT EXISTS `damowang_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `IP` varchar(200) DEFAULT NULL,
  `vistime` int(11) DEFAULT NULL,
  `visvideo` varchar(200) DEFAULT NULL,
  `deleteTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='浏览记录';

--
-- 转存表中的数据 `damowang_history`
--

INSERT INTO `damowang_history` (`id`, `uid`, `IP`, `vistime`, `visvideo`, `deleteTime`) VALUES
(1, 1, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL),
(3, 1, NULL, NULL, 'qwe', NULL),
(4, 1, NULL, NULL, NULL, NULL),
(5, 2, NULL, NULL, NULL, NULL),
(6, 1, NULL, NULL, 'qwe', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_integral`
--

DROP TABLE IF EXISTS `damowang_integral`;
CREATE TABLE IF NOT EXISTS `damowang_integral` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `number` int(200) NOT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='积分表';

--
-- 转存表中的数据 `damowang_integral`
--

INSERT INTO `damowang_integral` (`iid`, `uid`, `number`) VALUES
(1, 1, 280),
(2, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_integralinfo`
--

DROP TABLE IF EXISTS `damowang_integralinfo`;
CREATE TABLE IF NOT EXISTS `damowang_integralinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `intchange` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `intexotime` int(11) DEFAULT NULL,
  `bianhua` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='积分明细表';

--
-- 转存表中的数据 `damowang_integralinfo`
--

INSERT INTO `damowang_integralinfo` (`id`, `uid`, `intchange`, `remark`, `intexotime`, `bianhua`) VALUES
(1, 1, 100, '测试', NULL, 'add'),
(2, 1, 20, '测试', NULL, 'dec'),
(3, 1, 100, '测试', NULL, NULL),
(4, 1, 20, '测试', NULL, NULL),
(5, 1, 100, '测试', NULL, NULL),
(6, 1, 20, '测试', NULL, NULL),
(7, 1, 100, '测试', NULL, NULL),
(8, 1, 20, '测试', NULL, NULL),
(29, 1, 5, '每日签到', 1522051950, 'add'),
(30, 1, 30, '第一次绑定邮箱', 1522120597, 'add'),
(31, 1, 30, '第一次绑定邮箱', 1522120696, 'add');

-- --------------------------------------------------------

--
-- 表的结构 `damowang_rold`
--

DROP TABLE IF EXISTS `damowang_rold`;
CREATE TABLE IF NOT EXISTS `damowang_rold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roldname` varchar(200) NOT NULL,
  `auth_ids` varchar(200) NOT NULL,
  `auth_ac` varchar(2000) NOT NULL,
  `remark` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='职务';

--
-- 转存表中的数据 `damowang_rold`
--

INSERT INTO `damowang_rold` (`id`, `roldname`, `auth_ids`, `auth_ac`, `remark`) VALUES
(1, '超级管理员', '', '', '超级管理员'),
(2, '管理员管理', '1,2,3,4', 'admin_list-adminrole,admin_lsit-adminpermission,admin_list-adminlist', '管理后台用户'),
(3, '评论管理员', '11,12', 'list-feedbacklist', '管理评论'),
(4, '无权限', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `damowang_user`
--

DROP TABLE IF EXISTS `damowang_user`;
CREATE TABLE IF NOT EXISTS `damowang_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) DEFAULT NULL,
  `username` varchar(2000) DEFAULT NULL,
  `password` varchar(200) DEFAULT 'e10adc3949ba59abbe56e057f20f883e ',
  `regtime` int(11) DEFAULT NULL,
  `islog` int(11) DEFAULT '0',
  `phone` varchar(200) DEFAULT NULL,
  `roldid` int(11) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `source` varchar(200) DEFAULT NULL,
  `isvip` int(11) NOT NULL DEFAULT '0',
  `deleteTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `damowang_user`
--

INSERT INTO `damowang_user` (`uid`, `user`, `username`, `password`, `regtime`, `islog`, `phone`, `roldid`, `remark`, `source`, `isvip`, `deleteTime`) VALUES
(1, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1520763409, 0, '13030303030', 1, '', NULL, 1, NULL),
(2, 'tom', '', '', NULL, 0, '', 2, '', NULL, 1, NULL),
(3, 'dawei', '', NULL, NULL, 0, NULL, 2, '', NULL, 0, NULL),
(9, 'qqYKZ61XoY8q2', '奋斗的小青年', NULL, 1522032712, 0, NULL, NULL, NULL, 'qq', 0, NULL),
(23, 'qwe', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1522049444, 0, NULL, NULL, NULL, NULL, 0, NULL),
(24, 'qwe', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1522049473, 0, NULL, NULL, NULL, NULL, 0, NULL),
(25, 'qweqwe', NULL, 'efe6398127928f1b2e9ef3207fb82663', 1522058217, 0, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_userinfo`
--

DROP TABLE IF EXISTS `damowang_userinfo`;
CREATE TABLE IF NOT EXISTS `damowang_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `realname` varchar(200) DEFAULT NULL,
  `sex` int(11) NOT NULL DEFAULT '0',
  `birthday` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `qianming` varchar(2000) DEFAULT NULL,
  `userpic` varchar(200) NOT NULL DEFAULT './static/inex/images/moren.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `damowang_userinfo`
--

INSERT INTO `damowang_userinfo` (`id`, `uid`, `realname`, `sex`, `birthday`, `email`, `qianming`, `userpic`) VALUES
(1, 1, '', 1, '1422979200', 'qwe123456@qq.com', '', 'uploads/20180319\\106a8e75f5ac5157be7c1cf182868232.jpg'),
(2, 2, '', 1, '-28800', '', NULL, 'uploads/20180327\\9b03e0636f90ab5f12c0c2c90c1afa61.jpg'),
(3, 3, NULL, 0, NULL, NULL, NULL, './static/inex/images/moren.jpg'),
(6, 9, '', 1, '1299081600', NULL, NULL, 'http://thirdqq.qlogo.cn/qqapp/100378832/FBAE88E31A3A301C982696A154835132/100');

-- --------------------------------------------------------

--
-- 表的结构 `damowang_userrold`
--

DROP TABLE IF EXISTS `damowang_userrold`;
CREATE TABLE IF NOT EXISTS `damowang_userrold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL DEFAULT '123456',
  `sex` int(11) NOT NULL DEFAULT '0',
  `statusid` int(11) NOT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

--
-- 转存表中的数据 `damowang_userrold`
--

INSERT INTO `damowang_userrold` (`id`, `username`, `password`, `sex`, `statusid`, `phone`, `email`, `addtime`) VALUES
(1, 'admin', 'admin', 0, 0, '15364932110', '123456@163.com', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `damowang_vipinfo`
--

DROP TABLE IF EXISTS `damowang_vipinfo`;
CREATE TABLE IF NOT EXISTS `damowang_vipinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `firsttime` int(11) DEFAULT NULL,
  `viptime` int(11) NOT NULL,
  `vipdtime` int(11) DEFAULT NULL,
  `expire` int(11) DEFAULT '0',
  `goinfo` varchar(200) DEFAULT NULL,
  `deleteTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `damowang_vipinfo`
--

INSERT INTO `damowang_vipinfo` (`id`, `uid`, `firsttime`, `viptime`, `vipdtime`, `expire`, `goinfo`, `deleteTime`) VALUES
(1, 1, NULL, 1234657890, NULL, 0, NULL, NULL),
(2, 2, NULL, 1234567890, NULL, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
