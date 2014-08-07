-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2014 年 08 月 07 日 09:09
-- 伺服器版本: 5.6.19
-- PHP 版本： 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `numberCosmetology`
--

-- --------------------------------------------------------

--
-- 資料表結構 `bookRoom`
--

CREATE TABLE IF NOT EXISTS `bookRoom` (
`b_ID` int(10) unsigned NOT NULL COMMENT 'book_ID',
  `b_Date` date NOT NULL COMMENT '預訂教室日期',
  `b_Rooms` text COLLATE utf8_unicode_ci NOT NULL COMMENT '預訂教室',
  `b_Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '預訂時間',
  `b_UserID` int(11) NOT NULL COMMENT '預訂人'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='預訂教室' AUTO_INCREMENT=42 ;

--
-- 資料表的匯出資料 `bookRoom`
--

INSERT INTO `bookRoom` (`b_ID`, `b_Date`, `b_Rooms`, `b_Time`, `b_UserID`) VALUES
(2, '2014-07-28', '203;204', '2014-07-25 10:21:00', 1),
(5, '2014-07-29', '403;404', '2014-07-26 17:18:52', 3),
(6, '2014-07-31', '402;303', '2014-07-28 16:02:02', 3),
(8, '2014-07-29', '206;104;506', '2014-07-29 23:38:41', 3),
(15, '2014-08-05', '201;202', '2014-08-04 17:35:35', 3),
(19, '2014-08-05', '103', '2014-08-05 10:29:34', 3),
(38, '2014-08-12', '301;302;303;304', '2014-08-06 16:37:52', 3),
(39, '2014-08-07', '303;304;305;306;404;405;204;205;302;307', '2014-08-06 16:43:44', 1),
(41, '2014-08-08', '301;302;303;304', '2014-08-07 14:44:13', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `memberdata`
--

CREATE TABLE IF NOT EXISTS `memberdata` (
`m_id` int(11) NOT NULL,
  `m_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_point` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '點數',
  `m_passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `m_sex` enum('男','女') COLLATE utf8_unicode_ci NOT NULL,
  `m_birthday` date DEFAULT NULL,
  `m_level` enum('admin','member') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `m_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_login` int(11) unsigned NOT NULL DEFAULT '0',
  `m_logintime` datetime DEFAULT NULL,
  `m_jointime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 資料表的匯出資料 `memberdata`
--

INSERT INTO `memberdata` (`m_id`, `m_name`, `m_username`, `m_point`, `m_passwd`, `m_sex`, `m_birthday`, `m_level`, `m_email`, `m_phone`, `m_address`, `m_login`, `m_logintime`, `m_jointime`) VALUES
(1, '系統管理員', 'admin', 20, '21232f297a57a5a743894a0e4a801fc3', '男', NULL, 'admin', NULL, NULL, NULL, 16, '2014-07-12 14:04:12', '2008-10-20 16:36:15'),
(3, '鄭宇劭', 'megshao', 26, '33df9ab1c181f9ae5c3f538832fdfc0a', '男', NULL, 'member', NULL, NULL, NULL, 0, NULL, '2014-07-24 14:42:23'),
(6, 'QAQ', 'megshao0918', 0, '903010ac03abcc015f3f5227a392bd91', '男', '1992-12-23', 'member', 'meg_shao@yahoo.com.tw', '', '新北市新莊區復興路二段131號5F-1', 0, NULL, '2014-08-07 15:17:39');

-- --------------------------------------------------------

--
-- 資料表結構 `pointOperation`
--

CREATE TABLE IF NOT EXISTS `pointOperation` (
`p_ID` int(11) NOT NULL COMMENT '點數事件ID',
  `p_userID` int(11) NOT NULL COMMENT '帳號ID',
  `changeValue` int(11) unsigned NOT NULL COMMENT '變動value',
  `p_operateBy` int(11) NOT NULL COMMENT '操作者ID',
  `eventTypeID` int(10) unsigned NOT NULL COMMENT '事件type',
  `eventTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '事件發生時間',
  `remark` text COLLATE utf8_unicode_ci COMMENT '備註'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- 資料表的匯出資料 `pointOperation`
--

INSERT INTO `pointOperation` (`p_ID`, `p_userID`, `changeValue`, `p_operateBy`, `eventTypeID`, `eventTime`, `remark`) VALUES
(1, 3, 1, 3, 1, '2014-08-06 17:20:54', '使用1點'),
(2, 3, 2, 1, 2, '2014-08-06 17:40:23', 'QQ'),
(3, 3, 6, 1, 2, '2014-08-07 11:19:08', NULL),
(6, 3, 10, 3, 1, '2014-08-07 11:30:28', ''),
(7, 3, 9, 1, 2, '2014-08-07 11:31:56', ''),
(8, 3, 3, 1, 2, '2014-08-07 11:36:11', ''),
(9, 3, 2, 3, 1, '2014-08-07 11:44:08', ''),
(10, 3, 10, 1, 2, '2014-08-07 11:44:42', ''),
(11, 3, 2, 3, 3, '2014-08-07 11:51:00', ''),
(12, 3, 1, 1, 2, '2014-08-07 11:51:37', ''),
(13, 1, 10, 1, 2, '2014-08-07 13:24:40', ''),
(14, 3, 4, 3, 1, '2014-08-07 14:44:13', '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `bookRoom`
--
ALTER TABLE `bookRoom`
 ADD PRIMARY KEY (`b_ID`);

--
-- 資料表索引 `memberdata`
--
ALTER TABLE `memberdata`
 ADD PRIMARY KEY (`m_id`), ADD UNIQUE KEY `m_username` (`m_username`);

--
-- 資料表索引 `pointOperation`
--
ALTER TABLE `pointOperation`
 ADD PRIMARY KEY (`p_ID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `bookRoom`
--
ALTER TABLE `bookRoom`
MODIFY `b_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'book_ID',AUTO_INCREMENT=42;
--
-- 使用資料表 AUTO_INCREMENT `memberdata`
--
ALTER TABLE `memberdata`
MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 使用資料表 AUTO_INCREMENT `pointOperation`
--
ALTER TABLE `pointOperation`
MODIFY `p_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '點數事件ID',AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
