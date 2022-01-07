-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2022 年 01 月 07 日 06:04
-- 伺服器版本: 5.6.13
-- PHP 版本: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `easyui`
--
CREATE DATABASE IF NOT EXISTS `easyui` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `easyui`;

-- --------------------------------------------------------

--
-- 表的結構 `easyui_admin`
--

CREATE TABLE IF NOT EXISTS `easyui_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `manager` char(20) NOT NULL COMMENT '管理员帐号',
  `password` char(40) NOT NULL COMMENT '管理密码',
  `auth` char(50) NOT NULL DEFAULT '' COMMENT '权限',
  `date` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `easyui_admin`
--

INSERT INTO `easyui_admin` (`id`, `manager`, `password`, `auth`, `date`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '管理員管理,會員管理', 1406080825),
(4, 'jash.liao', 'fecdda7743d6828422556e3b3ec271c1ecd711a5', '管理員管理,基本統計圖', 1640847929);

-- --------------------------------------------------------

--
-- 表的結構 `easyui_nav`
--

CREATE TABLE IF NOT EXISTS `easyui_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `text` char(20) NOT NULL COMMENT '导航名称',
  `state` char(10) NOT NULL DEFAULT '' COMMENT '导航状态',
  `iconCls` char(20) NOT NULL DEFAULT '' COMMENT '导航图标',
  `url` char(50) NOT NULL DEFAULT '' COMMENT '导航链接',
  `nid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `easyui_nav`
--

INSERT INTO `easyui_nav` (`id`, `text`, `state`, `iconCls`, `url`, `nid`) VALUES
(1, '系統模塊', 'closed', 'icon-system', '', 0),
(2, '管理員管理', 'open', 'icon-manager', 'manager', 1),
(3, '數據統計模塊', 'closed', 'icon-shapes', '', 0),
(4, '基本統計圖', 'open', 'icon-chart', 'chart', 3);

-- --------------------------------------------------------

--
-- 表的結構 `val2db`
--

CREATE TABLE IF NOT EXISTS `val2db` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `date` char(50) NOT NULL COMMENT '寫入時間',
  `value` int(10) unsigned NOT NULL COMMENT '數值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 轉存資料表中的資料 `val2db`
--

INSERT INTO `val2db` (`id`, `date`, `value`) VALUES
(1, '2022-01-07 14:04:10', 32);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
