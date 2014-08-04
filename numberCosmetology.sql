-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2014 年 08 月 04 日 05:50
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='預訂教室' AUTO_INCREMENT=10 ;

--
-- 資料表的匯出資料 `bookRoom`
--

INSERT INTO `bookRoom` (`b_ID`, `b_Date`, `b_Rooms`, `b_Time`, `b_UserID`) VALUES
(1, '2014-07-28', '101;102', '2014-07-25 10:20:21', 3),
(2, '2014-07-28', '203;204', '2014-07-25 10:21:00', 1),
(3, '2014-07-29', '301;302', '2014-07-26 17:14:46', 3),
(4, '2014-07-29', '303;304', '2014-07-26 17:16:37', 3),
(5, '2014-07-29', '403;404', '2014-07-26 17:18:52', 3),
(6, '2014-07-31', '402;303', '2014-07-28 16:02:02', 3),
(7, '2014-07-31', '203;105;607', '2014-07-28 16:05:42', 3),
(8, '2014-07-29', '206;104;506', '2014-07-29 23:38:41', 3),
(9, '2014-08-26', '301;302;403', '2014-08-02 17:12:37', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `memberdata`
--

INSERT INTO `memberdata` (`m_id`, `m_name`, `m_username`, `m_point`, `m_passwd`, `m_sex`, `m_birthday`, `m_level`, `m_email`, `m_phone`, `m_address`, `m_login`, `m_logintime`, `m_jointime`) VALUES
(1, '系統管理員', 'admin', 0, '21232f297a57a5a743894a0e4a801fc3', '男', NULL, 'admin', NULL, NULL, NULL, 16, '2014-07-12 14:04:12', '2008-10-20 16:36:15'),
(3, '鄭宇劭', 'megshao', 0, '21232f297a57a5a743894a0e4a801fc3', '男', NULL, 'member', NULL, NULL, NULL, 0, NULL, '2014-07-24 14:42:23');

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
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `bookRoom`
--
ALTER TABLE `bookRoom`
MODIFY `b_ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'book_ID',AUTO_INCREMENT=10;
--
-- 使用資料表 AUTO_INCREMENT `memberdata`
--
ALTER TABLE `memberdata`
MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
