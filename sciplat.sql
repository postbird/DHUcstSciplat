-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 09 月 09 日 14:04
-- 服务器版本: 5.5.41
-- PHP 版本: 5.3.10-1ubuntu3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sciplat`
--

-- --------------------------------------------------------

--
-- 表的结构 `sp_access`
--

CREATE TABLE IF NOT EXISTS `sp_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sp_elite`
--

CREATE TABLE IF NOT EXISTS `sp_elite` (
  `eid` int(5) NOT NULL AUTO_INCREMENT,
  `ename` varchar(40) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sp_elite`
--

INSERT INTO `sp_elite` (`eid`, `ename`) VALUES
(1, 'PHP'),
(2, 'C++'),
(3, 'Java');

-- --------------------------------------------------------

--
-- 表的结构 `sp_elite_user`
--

CREATE TABLE IF NOT EXISTS `sp_elite_user` (
  `elite_id` int(5) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sp_elite_user`
--

INSERT INTO `sp_elite_user` (`elite_id`, `user_id`) VALUES
(1, 4),
(1, 5),
(1, 6),
(2, 5),
(3, 4);

-- --------------------------------------------------------

--
-- 表的结构 `sp_lecture`
--

CREATE TABLE IF NOT EXISTS `sp_lecture` (
  `lid` int(8) NOT NULL AUTO_INCREMENT,
  `ltitle` varchar(200) NOT NULL,
  `ldate` varchar(50) NOT NULL,
  `lplace` varchar(200) NOT NULL,
  `llecturer` varchar(100) NOT NULL,
  `lcontent` text NOT NULL,
  `ldirectornum` varchar(20) NOT NULL,
  `ldirectorname` varchar(40) NOT NULL,
  `ldirectortel` varchar(100) NOT NULL,
  `lnum` varchar(20) NOT NULL,
  `ldatestart` date NOT NULL,
  `ldateend` date NOT NULL,
  `lsheet` int(2) NOT NULL DEFAULT '0',
  `lstatus` int(2) NOT NULL DEFAULT '1',
  `lcheckstatus` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `sp_lecture`
--

INSERT INTO `sp_lecture` (`lid`, `ltitle`, `ldate`, `lplace`, `llecturer`, `lcontent`, `ldirectornum`, `ldirectorname`, `ldirectortel`, `lnum`, `ldatestart`, `ldateend`, `lsheet`, `lstatus`, `lcheckstatus`) VALUES
(1, '1', '4', '5', '3', '<p>2</p>', '', '6', '', '', '0000-00-00', '2016-07-27', 1, 1, 0),
(2, '讲座一1', '2015-9-30 17：501', '1号学院楼2591', '毛泽东1', '<p>讲座一内容1</p><p style="text-align: center;"><img title="1468310360124649.jpg" alt="3.jpg" src="/sciplat/Uploads/image/20160712/1468310360124649.jpg"/></p>', '', '周恩来1', '22331', '451', '2016-07-12', '2016-07-28', 1, 1, 0),
(4, '讲座五1', 'dfdf1', '3fdsf1', '毛泽东1', '<p>讲座五内容1</p>', '10002', '张三', '23231', '2912', '2016-07-20', '2016-07-28', 1, 1, 1),
(5, '讲座六', '32', '23', '2', '<p>讲座六内容弄</p>', '10000', '刘一', '23435', '434', '2016-07-06', '2016-08-04', 1, 1, 1),
(6, '讲座八', '2015-9-30 17：50', '净月湖', 'tdzbz', '<p>讲座八内容</p>', '10000', '刘一', '2233', '45', '2016-08-02', '2016-08-10', 1, 1, 1),
(7, '讲座九1', '323', '424', '222', '<p>讲座九2</p>', '', '', '23', '23', '2016-08-03', '2016-08-25', 1, 1, 1),
(8, '讲座十一', '22', '23', '22', '<p>讲座十一内容</p>', '10004', '王五', '123', '23', '2016-08-10', '2016-08-18', 1, 1, 0),
(9, '讲座十二', '3', '3', '22', '<p>讲座十二</p>', '10002', '张三', '23', '23', '2016-08-03', '2016-08-30', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sp_lecture_user`
--

CREATE TABLE IF NOT EXISTS `sp_lecture_user` (
  `lecture_id` int(8) NOT NULL,
  `lecture_title` varchar(200) NOT NULL,
  `user_num` varchar(10) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `lpresent` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sp_lecture_user`
--

INSERT INTO `sp_lecture_user` (`lecture_id`, `lecture_title`, `user_num`, `user_name`, `lpresent`) VALUES
(2, '讲座一1', '10002', '', 0),
(1, '1', '10002', '', 1),
(2, '讲座一1', '10003', '', 0),
(2, '讲座一1', '10005', '赵六', 1),
(2, '讲座一1', '10004', '王五', 1),
(4, '讲座五1', '10003', '李四', 0),
(4, '讲座五1', '10002', '张三', 0),
(5, '讲座六', '10002', '张三', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sp_news`
--

CREATE TABLE IF NOT EXISTS `sp_news` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `ntitle` text NOT NULL,
  `ncontent` text NOT NULL,
  `ndate` date NOT NULL,
  `npublishnum` varchar(10) NOT NULL,
  `npublishname` varchar(20) NOT NULL,
  `nstatus` int(1) NOT NULL DEFAULT '1',
  `naccessory` varchar(200) NOT NULL,
  `ntop` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `sp_news`
--

INSERT INTO `sp_news` (`nid`, `ntitle`, `ncontent`, `ndate`, `npublishnum`, `npublishname`, `nstatus`, `naccessory`, `ntop`) VALUES
(1, '信息一1', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>信息一内容1</p>', '2016-07-05', '10000', '刘一', 0, '', 0),
(2, '信息二', '2<p>3123</p>', '2016-07-06', '10000', '刘一', 1, './Uploads/news/Shadowsocks-3.0.zip', 0),
(3, '信息三', '<p>信息三内容</p>', '2016-07-06', '', '', 1, '', 0),
(4, '信息四', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>信息四</p>', '2016-07-06', '10000', '刘一', 1, '', 0),
(5, '信息五', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>信息五</p>', '2016-07-06', '10000', '刘一', 1, './Uploads/news/psb.jpg', 0),
(6, '信息六', '<p>信息六</p>', '2016-07-06', '10000', '刘一', 1, './Uploads/news/psbe97M2VI7C.jpg', 0),
(7, '信息七', '<p>信息七</p>', '2016-07-06', '10000', '刘一', 1, './Uploads/news/Shadowsocks-3.0.zip', 0),
(8, '信息八', '<p>信息八</p>', '2016-07-06', '10000', '刘一', 1, './Uploads/news/ecbae284534171e16d3d5aa9763cc0bc.zip', 0),
(9, '信息九', '<p>信息九</p>', '2016-07-06', '10000', '刘一', 1, './Uploads/news/376ba649907944d43432640105199a3a.zip', 0),
(10, '信息十12', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>信息十12</p>', '2016-07-06', '10000', '刘一', 1, '/Uploads/news/0619b57f348203fe443b612dc56377da.pdf', 0),
(11, '信息十一', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>信息十一11</p>', '2016-07-06', '10000', '刘一', 1, '/Uploads/news/ec0185bdf209e13fbe3cb988965538c2.zip', 0),
(12, '信息十二', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>信息十二</p>', '2016-07-06', '10000', '刘一', 1, '/Uploads/news/023fe3bdc1db187dc581f589aa729b90.zip', 0),
(13, '信息十三', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>信息十三</p>', '2016-07-07', '10000', '刘一', 1, '/Uploads/news/c5e4caf91067aa7f0947e7a41ef22099.pdf', 0),
(14, 'test', '<p>tset<br/></p>', '2016-07-14', '10000', '刘一', 1, '/Uploads/news/202818094744a1c3252f5a78c6925c9e.doc', 0),
(15, 'tttt', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	23</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	3434323</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>&nbsp; &nbsp; &nbsp;	2323</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>				&nbsp; &nbsp; &nbsp;	</p><p>ttttt2335667891234</p><p></p>', '2016-08-01', '10000', '刘一', 1, '', 0),
(16, '信息二十一', '<p>信息二十一内容</p>', '2016-08-01', '', '', 1, '', 0),
(17, '信息二十二', '<p>信息二十二内容</p>', '2016-08-01', '10000', '刘一', 1, '', 1),
(18, '信息二十三', '<p>				&nbsp; &nbsp; &nbsp;	</p><p>信息二十三</p>', '2016-08-02', '', '', 1, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sp_node`
--

CREATE TABLE IF NOT EXISTS `sp_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_people`
--

CREATE TABLE IF NOT EXISTS `sp_people` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pnum` int(10) NOT NULL,
  `pname` varchar(40) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pnum` (`pnum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `sp_people`
--

INSERT INTO `sp_people` (`pid`, `pnum`, `pname`) VALUES
(1, 10000, '刘一'),
(2, 10001, '薛二'),
(3, 10002, '张三'),
(4, 10003, '李四'),
(5, 10004, '王五'),
(6, 10005, '赵六'),
(7, 10006, '田七'),
(8, 10007, '阮八'),
(9, 20001, '一娃'),
(10, 20002, '二娃'),
(11, 20003, '三娃'),
(12, 20004, '四娃'),
(13, 21001, '一娃'),
(14, 21002, '二娃'),
(15, 21003, '三娃');

-- --------------------------------------------------------

--
-- 表的结构 `sp_pro`
--

CREATE TABLE IF NOT EXISTS `sp_pro` (
  `pid` int(5) NOT NULL AUTO_INCREMENT,
  `pname` varchar(30) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `sp_pro`
--

INSERT INTO `sp_pro` (`pid`, `pname`) VALUES
(1, 'PHP'),
(2, 'C++');

-- --------------------------------------------------------

--
-- 表的结构 `sp_project`
--

CREATE TABLE IF NOT EXISTS `sp_project` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(8) NOT NULL,
  `ftitle` varchar(200) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `pclass` varchar(20) NOT NULL,
  `pcaptainnum` varchar(10) NOT NULL,
  `pcaptainname` varchar(20) NOT NULL,
  `pnumber` int(5) NOT NULL,
  `pfather` varchar(50) NOT NULL,
  `pcontent` text NOT NULL,
  `pstatus` int(2) NOT NULL DEFAULT '0',
  `plevel` varchar(20) NOT NULL DEFAULT '0',
  `paccessory` varchar(200) NOT NULL,
  `pleaderstatus` int(2) NOT NULL DEFAULT '0',
  `pcheckdate` date NOT NULL,
  `pmiddlestatus` int(2) NOT NULL DEFAULT '0',
  `pmiddleaccessory` varchar(200) NOT NULL,
  `pmiddlecheck` int(2) NOT NULL DEFAULT '0',
  `pmiddlerank` int(11) NOT NULL,
  `pmiddlescore` int(11) NOT NULL,
  `pmiddleend` int(2) NOT NULL DEFAULT '0',
  `plaststatus` int(2) NOT NULL DEFAULT '0',
  `plastaccessory` varchar(200) NOT NULL,
  `plastcheck` int(2) NOT NULL DEFAULT '0',
  `plastrank` int(5) NOT NULL DEFAULT '0',
  `plastscore` int(5) NOT NULL DEFAULT '0',
  `plastend` int(2) NOT NULL DEFAULT '0',
  `pannual` int(6) NOT NULL DEFAULT '0',
  `pendstatus` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `sp_project`
--

INSERT INTO `sp_project` (`pid`, `fid`, `ftitle`, `pname`, `pclass`, `pcaptainnum`, `pcaptainname`, `pnumber`, `pfather`, `pcontent`, `pstatus`, `plevel`, `paccessory`, `pleaderstatus`, `pcheckdate`, `pmiddlestatus`, `pmiddleaccessory`, `pmiddlecheck`, `pmiddlerank`, `pmiddlescore`, `pmiddleend`, `plaststatus`, `plastaccessory`, `plastcheck`, `plastrank`, `plastscore`, `plastend`, `pannual`, `pendstatus`) VALUES
(1, 0, '', '1', '创新训练', '', '张三', 0, '3', '<p>顶顶顶</p>', 1, '0', '/Uploads/project/88d5b5e061d3e0b04ec2e16b9ed80c8e.doc', 0, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(2, 0, '', '项目二14', '创新训练', '10002', '张三', 24, '软件工程14', '<p>项目二内容14</p>', 1, '0', '/Uploads/project/1952ddc98e622271c2e7ae0b46a30d11.doc', 0, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(3, 0, '', '项目三1234567', '创业训练', '10003', '李四', 21234567, '计算机科学与技术12345', '<p>项目三内容12345</p>', 1, '上海市级', '/Uploads/project/a8fd0647f6f071898de9538bdc4700e1.doc', 1, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(4, 0, '', '项目四1', '创业实践', '10002', '张三', 31, '计算机科学与技术1', '<p>项目四内容1</p>', 1, '国家级', '/Uploads/project/caec9e698aec794c24eb0c79a4281c5d.doc', 1, '0000-00-00', 1, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(5, 0, '', '项目五12', '创新训练', '10002', '张三', 22, '软工12', '<p>项目五内容12</p>', 1, '上海市级', '/Uploads/project/9be4d20928ee3266f61cef89a757981e.doc', 1, '0000-00-00', 1, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(6, 0, '', '项目六', '创业训练', '10003', '李四', 2, '网络', '<p>项目六内容</p>', 1, '上海市级', '/Uploads/project/335d0366c1d5d74f019c37714908b00b.doc', 1, '0000-00-00', 1, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(7, 0, '', '项目七', '创业训练', '10002', '张三', 3, '网络', '<p>项目七内容</p>', 1, '0', '/Uploads/project/b43bb155bd175ffd0dbffc6d29edfd92.doc', 0, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(8, 0, '', '项目八', '创业实践', '10002', '张三', 2, '汇编', '<p>项目八</p>', 1, '校级', '', 1, '0000-00-00', 1, '/Uploads/project/c2f00168c481dc5be534b5a4b7ce6d83.doc', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(9, 0, '', '项目九1', '创新训练', '10002', '张三', 21, '人文1', '<p>项目九内容1</p>', 1, '院级', '', 1, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(10, 0, '', '项目十1', '创业实践', '10002', '张三', 21, '人文1', '<p>项目十内容1</p>', 1, '校级', '', 1, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(11, 0, '', '项目十一1', '创业训练', '10002', '张三', 21, '人文1', '<p>项目十一内容1</p>', 1, '上海市级', '', 1, '0000-00-00', 1, '/Uploads/project/f5262dcc576f31ee179b0516c2ab490c.doc', 0, 3, 80, 0, 1, '', 0, 0, 0, 0, 2016, 1),
(12, 0, '', '项目二十一', '创业训练', '10002', '张三', 2, '机械', '<p>项目二十一内容</p>', 1, '国家级', '/Uploads/project/5f11b4e773f8f877696cf119872e33fa.doc', 1, '0000-00-00', 1, '/Uploads/project/87f2af80bc3e72d44f3d5ad6a308f889.doc', 0, 1, 90, 0, 1, '/Uploads/project/cdbcb4f999c0384b4dd5bfbadc18be09.zip', 0, 1, 96, 0, 0, 0),
(13, 0, '', '项目二十二12', '创新训练', '10002', '张三', 212, '计算机12', '项目二十二简介。12', 1, '国家级', '/Uploads/project/f66793b1a93528f3dcb21796df97fdc7.doc', 1, '0000-00-00', 1, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(14, 0, '', '项目二十三', '创业训练', '10002', '张三', 2, '软工', '项目二十三内容', 1, '上海市级', '/Uploads/project/dd8108694a687bd6ef60259c09082d98.doc', 1, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 2017, 0),
(15, 0, '', '项目二十四', '创业训练', '10002', '张三', 2, '软工', '项目二十四内容', 1, '国家级', '/Uploads/project/899233f93f93e55b41a165a4399ac96c.doc', 1, '2016-06-23', 1, '', 0, 0, 0, 0, 1, '', 0, 0, 0, 0, 2016, 1),
(16, 0, '', '项目三十一1', '创新训练', '10002', '张三', 2, '软工1', '项目三十一内容1', 1, '上海市级', '/Uploads/project/5208a0999d72565c2ec3ed03f82dc51a.doc', 1, '2016-05-28', 1, '/Uploads/project/980b7cdeb3652e7821c21880443acfe3.doc', 0, 1, 95, 0, 1, '/Uploads/project/f3364d95c07ce9ed68df72bcc29b0aa2.zip', 0, 2, 90, 0, 2016, 1),
(17, 0, '', '测试中期检查和结题', '创新训练', '10002', '张三', 2, '计算机科学与技术', 'fdfdfdfdfdhghyhj', 1, '国家级', '/Uploads/project/44d5cad26082d4840dcb225a89379498.doc', 1, '2016-08-01', 1, '/Uploads/project/2cf6aa3f3f4e88a5336df7a54730ccc8.doc', 0, 1, 99, 0, 1, '/Uploads/project/92f020861d132d7471d0b16060215e51.zip', 0, 1, 98, 0, 2016, 0),
(18, 3, '项目信息三', '卡卡西123', '创新训练', '10002', '张三', 2123, '软件工程', '卡卡西123', 1, '上海市级', '/Uploads/project/7a671b2b381462ca0f1543c910099ee4.doc', 1, '2016-05-02', 1, '/Uploads/project/df4aebe54da1e7ce961d838bc822d0ba.doc', 1, 1, 99, 0, 1, '/Uploads/project/6f06e3108a82e696ca0ad2f13adc16dd.zip', 1, 1, 100, 0, 2016, 1),
(19, 3, '项目信息三', '鸣人12', '创业训练', '10003', '李四', 212, '软件工程', '鸣人内容12', 1, '上海市级', '/Uploads/project/16f4eaaeeb0967b30c8f66ff401d4275.doc', 1, '2016-08-02', 1, '/Uploads/project/d2397ef88e295a8ece1d5a2ee35fe626.doc', 1, 2, 90, 0, 1, '/Uploads/project/6f40d9fe214320f821c9907fb57ac0d6.zip', 1, 1, 93, 0, 2016, 1),
(20, 3, '项目信息三', '佐助', '创新训练', '10005', '赵六', 2, '计算机科学与技术', '佐助就是二柱子', 1, '上海市级', '/Uploads/project/f39dc133e1f160975929f4f30ca66c0b.doc', 1, '2016-05-10', 1, '/Uploads/project/090556e7e570795935f3298ec2f0d54b.doc', 1, 4, 88, 0, 1, '/Uploads/project/a44befa8fce02b04769736cccdce78e7.zip', 1, 0, 0, 0, 2016, 1),
(21, 2, '项目信息二', '项目83', '创业训练', '10005', '赵六', 3, '计算机科学与技术', '项目83内容', 1, '0', '/Uploads/project/6008cc3abb5a9aa8de0b1f978837de8e.doc', 0, '2016-08-03', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 2016, 0),
(22, 3, '项目信息三', '项目8311', '创业训练', '10004', '王五', 1, '软件工程', '项目831', 1, '0', '/Uploads/project/ae2efdf324269cd2636354c2eddc7466.doc', 0, '2016-08-03', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 2016, 0),
(23, 2, '项目信息二', '815项目', '创业训练', '10004', '王五', 2, '计算机科学与技术', 'http://10.199.155.33/sciplat/index.php/Admin/Index/index', 0, '0', '/Uploads/project/2a1d2805f4aab48bc9f7721a53534f9a.doc', 0, '0000-00-00', 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(24, 2, '项目信息二', '项目815a', '创新训练', '10003', '李四', 2, '计算机科学与技术', '项目815a', 1, '上海市级', '/Uploads/project/7311afad30b7bc4b5f0bb4a4b743e2a8.doc', 1, '2016-08-15', 1, '/Uploads/project/2aa953c1dae66d19b69e9f7d2e710524.doc', 1, 6, 89, 1, 1, '/Uploads/project/b1d7c512dbd73d2118e5c898e3b58f74.zip', 1, 1, 94, 1, 2016, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sp_projectnews`
--

CREATE TABLE IF NOT EXISTS `sp_projectnews` (
  `pid` int(8) NOT NULL AUTO_INCREMENT,
  `ptitle` varchar(200) NOT NULL,
  `pcontent` text NOT NULL,
  `pdatestart` date NOT NULL,
  `pdateend` date NOT NULL,
  `plevel` varchar(20) NOT NULL,
  `pclass` varchar(20) NOT NULL,
  `pstatus` int(2) NOT NULL DEFAULT '1',
  `paccessory` varchar(200) NOT NULL,
  `ptop` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `sp_projectnews`
--

INSERT INTO `sp_projectnews` (`pid`, `ptitle`, `pcontent`, `pdatestart`, `pdateend`, `plevel`, `pclass`, `pstatus`, `paccessory`, `ptop`) VALUES
(1, '项目信息一1', '<p>项目信息一内容1</p>', '2016-07-14', '2016-07-17', '', '', 1, '/Uploads/project/3608be18b5f0ca812a4165397fb4e2df.doc', 0),
(2, '项目信息二', '<p>嘻嘻嘻11</p>', '2016-07-14', '2016-08-31', '', '', 1, '/Uploads/modules/application book.doc', 0),
(3, '项目信息三', '<p>项目信息三12</p>', '2016-08-09', '2016-08-09', '', '', 1, '/Uploads/modules/application book.doc', 1),
(4, '项目四1', '<p>项目四</p>', '2016-08-16', '2016-09-08', '上海市级', '创业实践', 1, '/Uploads/modules/application book.doc', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sp_project_user`
--

CREATE TABLE IF NOT EXISTS `sp_project_user` (
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sp_project_user`
--

INSERT INTO `sp_project_user` (`project_id`, `user_id`) VALUES
(2, 4),
(2, 5),
(2, 8),
(3, 5),
(3, 4),
(3, 8),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(5, 4),
(5, 5),
(5, 8),
(6, 5),
(6, 6),
(6, 8),
(7, 4),
(7, 5),
(7, 6),
(7, 8),
(8, 4),
(8, 8),
(9, 4),
(9, 8),
(10, 4),
(10, 8),
(11, 4),
(11, 8),
(12, 4),
(12, 8),
(13, 4),
(13, 8),
(14, 4),
(14, 8),
(15, 4),
(15, 5),
(15, 8),
(16, 4),
(16, 5),
(16, 8),
(17, 4),
(17, 5),
(17, 8),
(18, 4),
(18, 5),
(18, 8),
(19, 5),
(19, 6),
(19, 8),
(20, 7),
(20, 6),
(20, 11),
(21, 7),
(21, 6),
(21, 11),
(22, 6),
(22, 11),
(23, 6),
(23, 4),
(23, 11),
(24, 5),
(24, 6),
(24, 11);

-- --------------------------------------------------------

--
-- 表的结构 `sp_pro_user`
--

CREATE TABLE IF NOT EXISTS `sp_pro_user` (
  `pro_id` int(5) NOT NULL,
  `user_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sp_race`
--

CREATE TABLE IF NOT EXISTS `sp_race` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rname` varchar(200) NOT NULL,
  `rdatestart` date NOT NULL,
  `rdateend` date NOT NULL,
  `rsponsor` varchar(200) NOT NULL,
  `rlevel` varchar(40) NOT NULL,
  `rcontent` text NOT NULL,
  `rapplicant` varchar(200) NOT NULL,
  `raccessory` varchar(200) NOT NULL,
  `rstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `sp_race`
--

INSERT INTO `sp_race` (`rid`, `rname`, `rdatestart`, `rdateend`, `rsponsor`, `rlevel`, `rcontent`, `rapplicant`, `raccessory`, `rstatus`) VALUES
(1, '竞赛一', '2016-07-04', '2016-07-06', '', '', '<p>竞赛一内容</p>', '毛泽东', '', 1),
(2, '竞赛二', '2016-06-26', '2016-08-06', '国务院', '', '<p>竞赛二内容</p>', '毛泽东', '', 1),
(3, '竞赛三', '2016-07-20', '2016-07-27', '22', '', '<p>竞赛三内容</p>', '33', '/Uploads/race/9ef062e39c72cf9ec514e691fa84424c.pdf', 0),
(5, '竞赛四', '2016-07-05', '2016-08-02', '国务院', '市级', '<p>竞赛四内容</p>', '周恩来', '/Uploads/race/64b360cb759eaf929a9d0cc972b40c3f.pdf', 1),
(6, '2014中国计算机大会（CNCC2014）征文通知', '2016-08-01', '2016-08-31', '东华大学计算机学院12', '校级', '<p>&nbsp;&nbsp; 第十一届CCF<span style="color: windowtext; text-decoration: none;">中国计算机大会</span>（CCF \r\nChina National Computer Congress， CCF CNCC \r\n2014）将于2014年10月23-25日在河南郑州国际会展中心举行，承办单位是信息工程大学，本届大会将以“信息安全，数据为先”为主题，交流大数据和移动互联网环境下的信息安全技术。CNCC是由中国计算机学会（CCF）于2003年创建的系列学术会议，已在不同的城市举办十届，现每年一次。</p><p>CNCC旨在探讨计算机及相关领域最新进展和宏观发展趋势，展示中国学术界、企业界最重要的学术、技术事件和成果，使不同领域的专业人士能够获得探讨交流的机会并获得所需信息。CNCC2014将有逾2000人参会交流，有近百项科研成果进行展示，是中国IT领域的一次盛会。</p><p>CNCC2014现公开征集会议论文，征文范围涵盖计算机领域各方向，要求是没有公开发表过的原创性论文。本次大会不出版会议论文集，拟挑选不超过<strong>50</strong>篇的优秀论文刊登在《<span style="color: windowtext; text-decoration: none;">计算机学报</span>》上，其他录用论文将推荐到《小型微型计算机系统》、《计算机科学》、《计算机工程与应用》、《计算机工程与科学》等CCF会刊发表。《<span style="color: windowtext; text-decoration: none;">计算机学报</span>》和《小型微型计算机系统》录用文章将在2014年10月发表。</p><p style="text-align: center;"><img title="1468239175105909.jpg" alt="3.jpg" src="/sciplat/Uploads/image/20160711/1468239175105909.jpg"/></p><p><strong><span style="font-family: 黑体; font-size: 19px;">一、大赛简介</span></strong></p><p style="text-align: left; text-indent: 28px; margin-top: auto; margin-bottom: auto; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">为推动软件和信息技术的发展，促进软件和信息技术专业人才培养，向软件和信息技术行业输送具有创新能力和实践能力的高端人才，提升高校毕业生的就业竞争力，全面推动行业发展及人才培养进程，工业和信息化部人才交流中心特举办“‘蓝桥杯’全国软件和信息技术专业人才大赛&quot;。大赛包括个人赛和团队赛两个比赛项目，个人赛设置：1、C/C++程序设计（本科A组、本科B组、高职高专组）2、Java软件开发（本科A组、本科B组、高职高专组）3、嵌入式设计与开发（大学组、研究生组）4、单片机设计与开发（大学组）5、电子设计与开发（大学组），团队赛设置：软件创业赛一个科目组别。</span></p><p><strong><span style="font-family: 黑体; font-size: 19px;">二、大赛特色：</span></strong></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">立足行业，结合实际，实战演练，促进就业。</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">政府、企业、协会联手构筑的人才培养、选拔平台。</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">预赛广泛参与，决赛重点选拔。</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">以赛促学，竞赛内容基于所学专业知识。</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">分赛区选拨赛优胜奖及以上、全国总决赛优胜奖及以上获奖选手均可获得由工业和信息化部人才交流中心及大赛组委会联合颁发的获奖证书。</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">总决赛三等奖及以上选手，如果获得本校免试推研资格，将获得北京大学软件与微电子学院及众多知名高校的面试资格，并优先录取为该院普通硕士研究生。</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">大赛优秀获奖选手将获得IBM、百度等众多知名企业的免笔试直接面试及特别优秀者直接录用的绿色通道。</span></p><p><strong><span style="font-family: 黑体; font-size: 19px;">三、大赛章程</span></strong></p><p style="text-align: left; -ms-layout-grid-mode: char;"><strong><span style="font-family: 宋体;">（一）概况 &nbsp;</span></strong><span style="font-family: 宋体;"><br/>1.1 &nbsp;</span><span style="font-family: 宋体;">大赛背景和宗旨</span></p><p style="text-align: left; text-indent: 28px; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">软 &nbsp;件和信息技术产业作为我国的核心产业，是经济社会发展的先导性、战略性产业，软件和信息技术产业在推进信息化和工业化融合，转变发展方式，维护国家安全等方面发挥着重要作用。为推动软件和信息技术产业的发展，促进软件和信息技术专业技术人才培养，向软件和信息技术行业输送具有创新能力和实践能力的高端人 &nbsp;才，提升高校毕业生的就业竞争力，全面推动行业发展及人才培养进程，工业和信息化部人才交流中心已成功举办四届“蓝桥杯”大赛。大赛的举办得到了教育部、工业和信息化部有关领导的高度重视，相关司局的大力支持，也得到了各省教育厅和各有关院校的积极响应，更得到了参赛师生的广泛好评，参赛学校超过1100余所，参赛规模已过两万人次，取得了良好的社会效果。<br/>&nbsp;&nbsp;&nbsp; 为 &nbsp;了继续加大对软件和信息技术专业人才培养的力度，促进高等院校进行计算机、软件和信息技术专业教学改革，推广优秀的软件和信息技术创业模式及政府扶持模式，发现优秀的软件和信息技术专业人才和项目，培养大学生的创新意识、市场意识和合作意识，促进大学生创业能力提高，工业和信息化部人才交流中心特举办第 &nbsp;五届“蓝桥杯”全国软件和信息技术专业人才大赛。 &nbsp;IBM公司作为官方战略合作伙伴对大赛提供赞助支持和技术服务。大赛官方网站：www.lanqiao.org。<br/>&nbsp;&nbsp;&nbsp; &nbsp;大赛分为个人赛和团队赛两个部分。本活动方案仅针对个人赛，团队赛具体方案另行通知。<br/>1.2大赛特色 &nbsp;<br/>立足行业，结合实际，实战演练，促进就业。<br/>政府、企业、协会联手构筑的人才培养、选拔平台。<br/>以赛促学，竞赛内容基于所学专业知识。<br/>以个人为单位，现场比拼，公正公平。<br/>1.3 大赛项目<br/>（1）JAVA软件开发<br/>对象：具有正式学籍的在校全日制本科及高职高专学生（以报名时状态为准），以个人为单位进行比赛。该专业方向设本科A组、本科B组、高职高专组。<br/>（2）C/C++程序设计<br/>对象：具有正式学籍的在校全日制本科及高职高专学生（以报名时状态为准) &nbsp;，以个人为单位进行比赛。该专业方向设本科A组、本科B组、高职高专组。</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">（3）嵌入式设计与开发</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">对象：具有正式学籍的在校全日制大学生及研究生(以报名时状态为准) &nbsp;，以个人为单位进行比赛。该专业方向设大学组、研究生组。</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">（4）单片机设计与开发</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">对象：具有正式学籍的在校全日制本科及高职高专学生(以报名时状态为准) &nbsp;，以个人为单位进行比赛。该专业方向设本科组、高职高专组。</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">（5）电子设计与开发</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">对象：具有正式学籍的在校全日制本科及高职高专学生(以报名时状态为准) &nbsp;，以个人为单位进行比赛。该专业方向设本科组、高职高专组。&nbsp;</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><strong><span style="font-family: 宋体;">（二）组织构架 &nbsp;</span></strong><span style="font-family: 宋体;"><br/></span><span style="font-family: 宋体;">大赛设置全国大赛组织委员会，并在全国参赛院校数量较多、参赛人数规模较大的城市选拔院校设置赛点。 <br/>2.1全国组委会 &nbsp;<br/>“蓝桥杯”大赛组委会设在工业和信息化部人才交流中心，负责领导全国范围内的大赛工作。 &nbsp;<br/>2.2举办省份 &nbsp;<br/>北京、上海、天津、重庆、河北、山西、内蒙古、辽宁、吉林、黑龙江、江苏、浙江、安徽、福建、江西、山东、河南、湖北、湖南、广东、广西、海南、四川、贵州、云南、陕西、甘肃、宁夏、青海、新疆、西藏 <br/>2．3赛点 <br/>&nbsp;&nbsp;&nbsp; 大 &nbsp;赛计划在报名人数比较集中的，符合报名要求、且能提供足够数量的符合大赛需求的软件环境和硬件设备的院校设立赛点。赛点的设立既考虑报名人数，又要考虑区域的地理分布。赛点学校必须是有实力、有声望，对于组织当年选拔赛有很大的积极性。 &nbsp;赛点的设立由“蓝桥杯”大赛组委会确认，并签订相应协议。各学校赛点严格按照大赛章程、实施办法及《“全国软件和信息技术专业人才大赛”规则与赛场纪律》组织选拔赛。 <br/>（<strong>三）报名 &nbsp;</strong><br/>3.1报名时间 &nbsp;<br/>报名时间：2013年09月——2013年12月。</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">3.2</span><span style="font-family: 宋体;">报名人数及方式： <br/>以学校为单位报名，原则上每学校报名人数上限为100人。 &nbsp;<br/>各参赛学校需为每位参赛选手配备一名指导教师，每名选手的指导教师最多一名，报多名的以排序第一的为准，其余无效。同一名指导教师可指导多位选手。 <br/><strong><span style="color: red;">报名方式：学校及选手登陆大赛官方网站在线报名。 &nbsp;<br/></span></strong>3.3报名材料： &nbsp;<br/>报名表、身份证复印件、学生证复印件、1寸相片，以上均需要电子扫描版，通过报名系统上传。 &nbsp;<br/>报名表需加盖校方或院系公章。 <br/>3.4报名及参赛费用<br/>（1）C/C++程序设计、Java软件开发报名费为每人200元；</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">（2）嵌入式设计与开发、单片机设计与开发、电子设计与开发报名费为每人300元；</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">选手及指导老师在选拔赛、决赛期间发生的住宿、用餐、交通等费用自理； <br/>报名费由“蓝桥杯”大赛组委会收取。 &nbsp;<br/>3.5组织工作：</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">大赛的报名、交费、下载准考证等工作全部通过蓝桥杯官网在线报名系统完成。<br/>（<strong>四） &nbsp;选拔赛管理</strong><br/>4.1 选拔赛时间：2014年3月或4月<br/>4.2选拔赛地点及形式:<br/>大赛选拔赛采用统一命题、分赛区比赛的组织方式。选手在指定赛点参加选拔赛。 &nbsp;<br/>大赛题目应具有实际意义和应用背景，并考虑到目前教学的基本内容和新技术的应用趋势，同时还应对教学内容和课程体系改革有一定的引导作用。<br/>公示所有获奖名单并启动监督反馈制度。 <br/>（<strong>五）总决赛管理</strong> <br/>5.1 &nbsp;决赛时间：2014年5月<br/>5.2 总决赛赛题组织<br/>大赛总决赛采用统一命题、集中考试的组织方式。<br/>大赛题目应具有实际意义和应用背景，并考虑到目前教学的基本内容和新技术的应用趋势，同时还应对教学内容和课程体系改革有一定的引导作用。<br/>题目的难易程度，既应使一般参赛学生能在规定时间内完成基本要求，又能使优秀学生有发挥与创新的余地。</span></p><p style="text-align: left; -ms-layout-grid-mode: char;"><span style="font-family: 宋体;">总决赛由“蓝桥杯”大赛命题专家组统一命题。 &nbsp;<br/>由“蓝桥杯”专家指导委员会审题组专家对所有备选题目进行审核，指定审核标准，为保证大赛的公平、公正性，所有审题、筛选过程必须保密，在总决赛前10天最终确定决赛题目。 <br/>5.3 总决赛竞赛方式 <br/>大赛总决赛采用集中比赛的组织方式。参赛学生必须按统一时间参加大赛，按时开赛，准时交卷。 <br/>比赛期间，选手需独立完成比赛任务，所需资料，均由“蓝桥杯”大赛组委会提供。<br/>5.4 赛题评审 &nbsp;<br/>总决赛评审工作由“蓝桥杯”大赛组委会组织专家进行，评审中须严格遵守大赛全国专家组制定的统一评分及考核标准。 <br/>评审组设组长1名，副组长2名，评审员若干，组长负主要责任，每位评审专家的原始评分及评审记录须交由大赛组委会保存。 &nbsp;<br/>总决赛评审结果上报大赛组委会时，须同时提交含评审组每位评审专家签字的各项详细评分记录 ，否则其评审结果无效。 <br/>（<strong>六）颁奖仪式</strong> <br/>6.1 &nbsp;时间：颁奖仪式于总决赛结束后举行。 <br/>6.2参与人员 &nbsp;<br/>&nbsp;&nbsp;&nbsp; &nbsp;工业和信息化部、教育部有关部门领导、各知名院校、有关专家、企业代表、媒体记者、大赛组委会有关负责人、参赛学校代表、参赛学生代表等。 <br/>6.3 活动安排 <br/>● &nbsp;工业和信息化部、教育部有关部门领导致辞 <br/>● 大赛组委会负责人作大赛总结 &nbsp;<br/>● 有关领导为获奖学生和获奖单位颁奖 <br/>● 获奖单位代表发言 <br/>● 企业代表发言 <br/>● &nbsp;企业现场招聘会（免笔试直接面试） <br/>（<strong>七）奖项设置及评选办法 </strong><br/>7.1选拔赛 <br/>（1）参赛选手奖 &nbsp;<br/>选拔赛每个组别设置一、二、三等奖及优秀奖，其中三等奖及以上获奖比例为实际参赛人数的50%，另根据考试成绩，设置一定比例的优秀奖。选拔赛一等奖选手获得直接进入全国总决赛资格。所有获奖选手均可获得由工业和信息化部人才交流中心及大赛组委会联合颁发的获奖证书。 <br/>（2）指导教师奖 &nbsp;<br/>选拔赛中获奖的参赛选手的指导教师，将获得“‘蓝桥杯’全国软件和信息技术专业人才大赛（XX赛区）优秀指导教师”称号。 <br/>（3）参赛学校奖 &nbsp;<br/>参赛组织工作表现突出、经审批符合相关条件的单位，将获“‘蓝桥杯’全国软件和信息技术专业人才大赛（XX &nbsp;赛区）优秀组织单位”称号； &nbsp;<br/>参赛选手成绩优异、经审批符合相关条件学校，将获“‘蓝桥杯’全国软件和信息技术专业人才大赛（XX赛区）优胜学校”称号。 <br/>7.2总决赛 <br/>全国总决赛按参赛项目和成绩，为获奖学生、教师和组织单位颁发相应证书和奖励。其中： <br/>（1）参赛选手奖 &nbsp;<br/>个人赛根据相应组别分别设立特、一、二、三等奖及优秀奖。 在决赛奖项设置中，每个组别设置特等奖一名，一等奖不高于5%，二等奖占20%，三等奖不低于25%，优秀奖不超过50%。 &nbsp;<br/>所有获奖选手均可获得由工业和信息化部人才交流中心及大赛组委会联合颁发的获奖证书。 &nbsp;<br/>总决赛三等奖及以上选手，如果获得本校免试推研资格，将获得北京大学软件与微电子学院等院校的面试资格，并优先录取为该院普通硕士研究生。 <br/>总决赛三等奖及以上选手，可免除笔试，直接获得百度、IBM等企业在员工招聘及实习生招聘中的面试机会。 <br/>（2）指导教师奖 &nbsp;<br/>所有获奖选手的指导教师，均可获得“‘蓝桥杯’全国软件和信息技术专业人才大赛优秀指导教师”证书。 &nbsp;<br/>（3）参赛学校奖 &nbsp;<br/>参赛组织工作成绩突出、经审批符合相关条件的单位，获“‘蓝桥杯’全国软件和信息技术专业人才大赛优秀组织单位”称号； <br/>参赛选手成绩优异、经审批符合相关条件的学校获“‘蓝桥杯’全国软件和信息技术专业人才大赛优胜学校”称号。 <br/>（<strong>八）监督反馈 &nbsp;</strong><br/>&nbsp;&nbsp;&nbsp; &nbsp;为保证大赛的公平、公正，对全国总决赛和各赛区选拔赛的初步评审结果执行监督反馈制度。投诉反馈期自公布评审初步结果之日起，为期5天，过期不再受理。 <br/>&nbsp;&nbsp;&nbsp; 投 &nbsp;诉反馈期间，各赛区大赛组委会和全国大赛组委会将受理有关违反大赛比赛章程、规则和纪律的行为等。投诉和异议须以书面形式提出，由个人提出的异议，须注本人的真实姓名、工作单位、通信地址，并附有本人亲笔签名；由单位提出的异议，须注明单位指定联系人的姓名、通信地址、电话，并加盖单位公章。各赛区大赛组 &nbsp;委会和全国大赛组委会须对提出异议的个人或单位严格保密。</span></p><p>&nbsp;</p>', '刘国华', '/Uploads/race/c95908649e62553d8df278cfb275a904.zip', 1),
(7, 'jingsai', '2016-07-14', '2016-07-29', 'gdfg', '市级', '<p>fsdfsdfdsgdfg</p>', 'erw', '', 1),
(8, '竞赛五', '2016-08-02', '2016-08-31', '计算机学院', '校级', '<p>竞赛五12</p>', '', '', 1),
(9, '竞赛六', '2016-08-16', '2016-09-10', '东华大学', '国家级', '<p>竞赛六内容</p>', '', '', 1),
(10, '竞赛七1', '2016-08-16', '2016-09-10', '东华大学', '国家级及国家级以上', '<p>竞赛七内容</p>', '', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sp_race_user`
--

CREATE TABLE IF NOT EXISTS `sp_race_user` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `race_id` int(10) NOT NULL,
  `race_name` varchar(200) NOT NULL,
  `race_level` varchar(40) NOT NULL,
  `unum` varchar(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `captainnum` varchar(10) NOT NULL DEFAULT '0',
  `accessory` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `bonus` varchar(40) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `sp_race_user`
--

INSERT INTO `sp_race_user` (`mid`, `race_id`, `race_name`, `race_level`, `unum`, `uname`, `captainnum`, `accessory`, `image`, `bonus`, `status`) VALUES
(5, 6, '2014中国计算机大会（CNCC2014）征文通知', '校级', '10002', '张三', '10002', '/Uploads/race/04ee9278cd9437fb4e45f29026718e54.zip', '/Uploads/race/5a79a5cf06a2ce600cdc09c2b5b79f63.jpg', '二等奖', 1),
(6, 6, '2014中国计算机大会（CNCC2014）征文通知', '校级', '10003', '李四', '10002', '/Uploads/race/04ee9278cd9437fb4e45f29026718e54.zip', '/Uploads/race/5a79a5cf06a2ce600cdc09c2b5b79f63.jpg', '二等奖', 1),
(7, 6, '2014中国计算机大会（CNCC2014）征文通知', '校级', '10004', '王五', '10004', '/Uploads/race/a4641f74e9851e542016405879174f61.zip', '/Uploads/race/76d9d88dbdc6c877da924dfd9c771eee.jpg', '一等奖', 1),
(8, 5, '竞赛四', '市级', '10002', '张三', '10002', '/Uploads/race/39c957edd6bdebab4fa64e6b85966844.zip', '/Uploads/race/76d9d88dbdc6c877da924dfd9c771eee.jpg', '特等奖', 1),
(9, 5, '竞赛四', '市级', '10003', '李四', '10003', '/Uploads/race/307c78731be5c19fb545aafe8b36f502.pdf', '/Uploads/race/d0cc466825ff8f7c31e8aef1c560a142.jpg', '一等奖', 1),
(10, 7, 'jingsai', '市级', '10002', '张三', '10002', '/Uploads/race/38257053022a4bf66d2986216b0459aa.doc', '/Uploads/race/81520bf198b4b16de9f6d6d7940027f2.jpg', '二等奖', 1),
(11, 6, '2014中国计算机大会（CNCC2014）征文通知', '校级', '10001', '薛二', '10001', '', '', '特等奖', 1),
(12, 8, '竞赛五', '校级', '10004', '王五', '10004', '', '', '三等奖', 1),
(13, 8, '竞赛五', '校级', '10005', '赵六', '10004', '', '', '三等奖', 1),
(14, 2, '竞赛二', '', '10004', '王五', '10004', '', '', '一等奖', 0),
(15, 6, '2014中国计算机大会（CNCC2014）征文通知', '校级', '10005', '赵六', '10005', '', '', '参与奖', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sp_report`
--

CREATE TABLE IF NOT EXISTS `sp_report` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `ryear` int(8) NOT NULL,
  `rmonth` int(3) NOT NULL,
  `rcontent` text NOT NULL,
  `rname` varchar(40) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `sp_report`
--

INSERT INTO `sp_report` (`rid`, `ryear`, `rmonth`, `rcontent`, `rname`) VALUES
(1, 2016, 6, 'yuebao12', ''),
(2, 2016, 7, '月报一内容', '张三'),
(4, 2016, 6, '月报一', '李四'),
(5, 2016, 7, '月报！', '张三'),
(6, 2016, 6, '六月月报', '张三'),
(7, 2016, 6, '订单', '王五'),
(8, 2016, 7, '23', '王五');

-- --------------------------------------------------------

--
-- 表的结构 `sp_report_project`
--

CREATE TABLE IF NOT EXISTS `sp_report_project` (
  `project_id` int(10) NOT NULL,
  `report_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sp_report_project`
--

INSERT INTO `sp_report_project` (`project_id`, `report_id`) VALUES
(4, 1),
(4, 2),
(3, 4),
(15, 5),
(16, 6),
(20, 7),
(20, 8);

-- --------------------------------------------------------

--
-- 表的结构 `sp_role`
--

CREATE TABLE IF NOT EXISTS `sp_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `sp_role`
--

INSERT INTO `sp_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(1, '学生', NULL, 1, 'student'),
(2, '教师', NULL, 1, 'teacher'),
(3, '科创管理员', NULL, 1, 'stutentmanage'),
(5, '高级管理员', NULL, 1, 'supermanage');

-- --------------------------------------------------------

--
-- 表的结构 `sp_role_user`
--

CREATE TABLE IF NOT EXISTS `sp_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sp_role_user`
--

INSERT INTO `sp_role_user` (`role_id`, `user_id`) VALUES
(1, '4'),
(5, '2'),
(1, '7'),
(2, '8'),
(1, '5'),
(1, '6'),
(3, '3'),
(1, '9'),
(3, '13'),
(2, '1'),
(5, '10'),
(2, '11'),
(1, '12'),
(2, '14');

-- --------------------------------------------------------

--
-- 表的结构 `sp_user`
--

CREATE TABLE IF NOT EXISTS `sp_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `unum` varchar(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upassword` varchar(64) NOT NULL,
  `master` varchar(40) NOT NULL,
  `ugrade` varchar(40) NOT NULL,
  `umail` varchar(20) NOT NULL,
  `utel` varchar(20) NOT NULL,
  `upoint` int(10) NOT NULL DEFAULT '0',
  `uflag` varchar(6) NOT NULL,
  `uprofession` varchar(10) NOT NULL,
  `uckeck` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `unum` (`unum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `sp_user`
--

INSERT INTO `sp_user` (`uid`, `unum`, `uname`, `upassword`, `master`, `ugrade`, `umail`, `utel`, `upoint`, `uflag`, `uprofession`, `uckeck`) VALUES
(2, '10000', '刘一', 'e10adc3949ba59abbe56e057f20f883e', '213', '213', '213', '13917377764', 0, '学生', '学生', 0),
(3, '10001', '薛二', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '122', 0, '学生', '学生', 0),
(4, '10002', '张三', 'e10adc3949ba59abbe56e057f20f883e', '软工', '1班级1', '1234', '123', 30, '学生', '学生', 1),
(5, '10003', '李四', 'e10adc3949ba59abbe56e057f20f883e', '计算机科学23', '2', '23', '1113', 18, '学生', '学生', 1),
(6, '10004', '王五', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '12323', 5, '学生', '学生', 0),
(7, '10005', '赵六', 'e10adc3949ba59abbe56e057f20f883e', '软工', '', '10005@qq.com', '123456', 2, '学生', '学生', 0),
(8, '20001', '一娃', 'e10adc3949ba59abbe56e057f20f883e', '计算机科学1', '2', '20001@qq.com', '123456', 0, '教师', '副教授', 0),
(9, '30001', '宋江', '451fbb024d0794ffcda2258170740a1e', '', '', '', '', 0, '', '学生', 0),
(10, '30002', '武松', '705e2dd2077bc06fbc5e2c754e75e500', '1', '2', '4', '3', 0, '', '助教', 0),
(11, '30003', '公孙胜', '09510d526df60f47c2797dee42254939', '11', '22', '', '', 6, '教师', '教授', 0),
(12, '30004', '林冲', 'ac17d8a48126ac3ddd82489b35c0cd32', '2', '2', '', '', 23, '学生', '学生', 0),
(13, '10006', '李七', '19b1b73d63d4c9ea79f8ca57e9d67095', '', '', '', '', 0, '', '学生', 0),
(14, '30005', '鲁智深', 'cb61843a4d547a8d2a199fe80a7a1add', '', '', '', '', 0, '', '讲师', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
