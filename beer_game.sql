-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 01 月 08 日 13:05
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
-- 資料庫： `beer_game`
--

-- --------------------------------------------------------

--
-- 資料表結構 `content`
--

CREATE TABLE `content` (
  `roomNo` int(10) NOT NULL DEFAULT '1',
  `loginID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `gameorder`
--

CREATE TABLE `gameorder` (
  `roomNo` int(11) NOT NULL,
  `role` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `temp1` int(20) NOT NULL DEFAULT '0',
  `temp2` int(20) NOT NULL DEFAULT '0',
  `temp3` int(20) NOT NULL DEFAULT '0',
  `temp4` int(20) NOT NULL
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
-- 資料表結構 `longwhip`
--

CREATE TABLE `longwhip` (
  `roomNo` int(20) NOT NULL,
  `role` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `week1` int(20) NOT NULL DEFAULT '0',
  `week2` int(20) NOT NULL DEFAULT '0',
  `week3` int(20) NOT NULL DEFAULT '0',
  `week4` int(20) NOT NULL DEFAULT '0',
  `week5` int(20) NOT NULL DEFAULT '0',
  `week6` int(20) NOT NULL DEFAULT '0',
  `week7` int(20) NOT NULL DEFAULT '0',
  `week8` int(20) NOT NULL DEFAULT '0',
  `week9` int(20) NOT NULL DEFAULT '0',
  `week10` int(20) NOT NULL DEFAULT '0',
  `week11` int(20) NOT NULL DEFAULT '0',
  `week12` int(20) NOT NULL DEFAULT '0',
  `week13` int(20) NOT NULL DEFAULT '0',
  `week14` int(20) NOT NULL DEFAULT '0',
  `week15` int(20) NOT NULL DEFAULT '0',
  `week16` int(20) NOT NULL DEFAULT '0',
  `week17` int(20) NOT NULL DEFAULT '0',
  `week18` int(20) NOT NULL DEFAULT '0',
  `week19` int(20) NOT NULL DEFAULT '0',
  `week20` int(20) NOT NULL DEFAULT '0',
  `week21` int(20) NOT NULL DEFAULT '0',
  `week22` int(20) NOT NULL DEFAULT '0',
  `week23` int(20) NOT NULL DEFAULT '0',
  `week24` int(20) NOT NULL DEFAULT '0',
  `week25` int(20) NOT NULL DEFAULT '0',
  `week26` int(20) NOT NULL DEFAULT '0',
  `week27` int(20) NOT NULL DEFAULT '0',
  `week28` int(20) NOT NULL DEFAULT '0',
  `week29` int(20) NOT NULL DEFAULT '0',
  `week30` int(20) NOT NULL DEFAULT '0',
  `week31` int(20) NOT NULL DEFAULT '0',
  `week32` int(20) NOT NULL DEFAULT '0',
  `week33` int(20) NOT NULL DEFAULT '0',
  `week34` int(20) NOT NULL DEFAULT '0',
  `week35` int(20) NOT NULL DEFAULT '0',
  `week36` int(20) NOT NULL DEFAULT '0',
  `week37` int(20) NOT NULL DEFAULT '0',
  `week38` int(20) NOT NULL DEFAULT '0',
  `week39` int(20) NOT NULL DEFAULT '0',
  `week40` int(20) NOT NULL DEFAULT '0',
  `week41` int(20) NOT NULL DEFAULT '0',
  `week42` int(20) NOT NULL DEFAULT '0',
  `week43` int(20) NOT NULL DEFAULT '0',
  `week44` int(20) NOT NULL DEFAULT '0',
  `week45` int(20) NOT NULL DEFAULT '0',
  `week46` int(20) NOT NULL DEFAULT '0',
  `week47` int(20) NOT NULL DEFAULT '0',
  `week48` int(20) NOT NULL DEFAULT '0',
  `week49` int(20) NOT NULL DEFAULT '0',
  `week50` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `rank`
--

CREATE TABLE `rank` (
  `roomNo` int(20) NOT NULL,
  `cost` int(20) NOT NULL DEFAULT '0',
  `rank` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `store`
--

CREATE TABLE `store` (
  `roomNo` int(20) NOT NULL,
  `role` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `loginID` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`loginID`);

--
-- 資料表索引 `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`roomNo`);

--
-- 資料表索引 `longwhip`
--
ALTER TABLE `longwhip`
  ADD PRIMARY KEY (`roomNo`);

--
-- 資料表索引 `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`roomNo`);

--
-- 資料表索引 `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`roomNo`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `list`
--
ALTER TABLE `list`
  MODIFY `roomNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `longwhip`
--
ALTER TABLE `longwhip`
  MODIFY `roomNo` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `rank`
--
ALTER TABLE `rank`
  MODIFY `roomNo` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `store`
--
ALTER TABLE `store`
  MODIFY `roomNo` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
