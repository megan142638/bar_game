-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 01 月 13 日 02:45
-- 伺服器版本: 10.1.32-MariaDB
-- PHP 版本： 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `team`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admset`
--

CREATE TABLE `admset` (
  `week` int(2) NOT NULL,
  `demand` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `admset`
--

INSERT INTO `admset` (`week`, `demand`) VALUES
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(5, 10),
(6, 29),
(7, 9),
(8, 20),
(9, 26),
(10, 14),
(11, 11),
(12, 22),
(13, 8),
(14, 21),
(15, 13),
(16, 5),
(17, 19),
(18, 3),
(19, 7),
(20, 30),
(21, 14),
(22, 26),
(23, 28),
(24, 21),
(25, 25),
(26, 27),
(27, 7),
(28, 18),
(29, 19),
(30, 13),
(31, 30),
(32, 24),
(33, 19),
(34, 14),
(35, 6),
(36, 8),
(37, 7),
(38, 18),
(39, 22),
(40, 3),
(41, 15),
(42, 24),
(43, 26),
(44, 7),
(45, 22),
(46, 10),
(47, 5),
(48, 23),
(49, 28),
(50, 18);

-- --------------------------------------------------------

--
-- 資料表結構 `content`
--

CREATE TABLE `content` (
  `roomNo` int(10) NOT NULL DEFAULT '1',
  `loginID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `distributor`
--

CREATE TABLE `distributor` (
  `week` int(2) NOT NULL,
  `ord` int(2) DEFAULT NULL,
  `store` int(2) NOT NULL,
  `debt` int(2) NOT NULL,
  `cost` int(10) NOT NULL,
  `send` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `factory`
--

CREATE TABLE `factory` (
  `week` int(2) NOT NULL,
  `ord` int(2) DEFAULT NULL,
  `store` int(2) NOT NULL,
  `debt` int(2) NOT NULL,
  `cost` int(10) NOT NULL,
  `send` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `list`
--

CREATE TABLE `list` (
  `roomNo` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `leaderID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `period`
--

CREATE TABLE `period` (
  `week` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `retailer`
--

CREATE TABLE `retailer` (
  `week` int(2) NOT NULL,
  `ord` int(2) DEFAULT NULL,
  `store` int(2) NOT NULL,
  `debt` int(2) NOT NULL,
  `cost` int(10) NOT NULL,
  `send` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `loginID` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Permission` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`loginID`, `password`, `Permission`) VALUES
('aaa', '123', 0),
('abc', '123', 0),
('adm', '123', 1),
('test', '123', 0),
('test1', '123', 0),
('test2', '123', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `wholesaler`
--

CREATE TABLE `wholesaler` (
  `week` int(2) NOT NULL,
  `ord` int(2) DEFAULT NULL,
  `store` int(2) NOT NULL,
  `debt` int(2) NOT NULL,
  `cost` int(10) NOT NULL,
  `send` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admset`
--
ALTER TABLE `admset`
  ADD PRIMARY KEY (`week`);

--
-- 資料表索引 `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`loginID`);

--
-- 資料表索引 `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`week`);

--
-- 資料表索引 `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`week`);

--
-- 資料表索引 `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`roomNo`);

--
-- 資料表索引 `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`week`);

--
-- 資料表索引 `retailer`
--
ALTER TABLE `retailer`
  ADD PRIMARY KEY (`week`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`loginID`);

--
-- 資料表索引 `wholesaler`
--
ALTER TABLE `wholesaler`
  ADD PRIMARY KEY (`week`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admset`
--
ALTER TABLE `admset`
  MODIFY `week` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表 AUTO_INCREMENT `list`
--
ALTER TABLE `list`
  MODIFY `roomNo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
