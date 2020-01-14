-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `s1080401`
--

-- --------------------------------------------------------

--
-- 資料表結構 `01_account`
--

CREATE TABLE `01_account` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `psw` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `01_account`
--

INSERT INTO `01_account` (`id`, `acc`, `psw`, `email`) VALUES
(1, 'admin', '1234', '0'),
(2, 'user', '1234', ''),
(3, 'test01', '1234', '');

-- --------------------------------------------------------

--
-- 資料表結構 `02_works_img`
--

CREATE TABLE `02_works_img` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `acc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `02_works_img`
--

INSERT INTO `02_works_img` (`id`, `img`, `width`, `height`, `acc`, `title`, `tag`, `content`, `date`) VALUES
(1, 'https://picsum.photos/600/800/', 600, 800, 'admin', '作品no.0', '123,000', '門羅主義百年紀念半美元是美國鑄幣局生產的一種50美分面額硬幣，其正面刻有兩位前總統詹姆斯·門羅和約翰·昆西·亞當斯的頭像，旨在紀念門羅主義100周年，由舊金山鑄幣局在1923年鑄造。紀念幣由雕塑家切斯特·比奇設計。1922年，美國電影業因包括醜聞在內的多種不利因素身陷泥潭，電影公司巨頭於是尋求手段來為好萊塢爭取正面宣傳，1923年中期在洛杉磯舉行的博覽會就是這樣一種宣傳手段。為了促使國會同意發行紀念幣來為展會籌資，組織員將博覽會與門羅主義100周年聯繫起來，國會於是通過法案，授權製作半美元銀質紀念幣。博覽在成本上入不敷出，硬幣銷售狀況欠佳，共計生產的27萬枚中絕大部分都進入市場流通。貝克指控比奇設計的背面剽竊了他多年前設計的印章，但比奇和另一位雕塑家詹姆斯·厄爾·弗雷澤對此予以否認。以發行價買下的銀幣中又有許多在大蕭條期間消費掉了，大部分現存的這種紀念幣都存在一定程度磨損。\n\n\n', '2020-01-14'),
(3, 'https://picsum.photos/600/1200/?random=2', 600, 1200, 'admin', '作品no.2', '123,000', '作品內文...', '2020-01-14'),
(4, 'https://picsum.photos/300/300/?random=3', 300, 300, 'admin', '作品no.3', '132', '作品內文...', '2020-01-14'),
(5, 'https://picsum.photos/300/500/?random=4', 300, 500, 'admin', '作品no.4', '攝影 設計 官方 123', '作品內文...', '2020-01-08'),
(6, 'https://picsum.photos/300/600/?random=5', 300, 600, 'admin', '作品no.5', '攝影 設計 官方', '作品內文...', '2020-01-06'),
(7, 'https://picsum.photos/400/300/?random=6', 400, 300, 'admin', '作品no.6', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(8, 'https://picsum.photos/300/400/?random=7', 300, 400, 'admin', '作品no.7', ' 攝影 設計 官方', '作品內文...', '2020-01-06'),
(9, 'https://picsum.photos/500/300/?random=8', 500, 300, 'admin', '作品no.8', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(10, 'https://picsum.photos/300/500/?random=9', 300, 500, 'admin', '作品no.9', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(13, 'https://picsum.photos/300/400/?random=11', 300, 400, 'admin', '作品no.1', '攝影 設計 官方', '我的第一個作品', '0000-00-00'),
(14, 'https://picsum.photos/300/300/?random=12', 300, 300, 'admin', '作品no.8', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(15, 'https://picsum.photos/300/600/?random=13', 300, 600, 'admin', '作品no.2', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(16, 'https://picsum.photos/300/300/?random=14', 300, 300, 'admin', '作品no.3', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(17, 'https://picsum.photos/300/500/?random=15', 300, 500, 'test01', '作品no.4', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(18, 'https://picsum.photos/300/600/?random=16', 300, 600, 'test01', '作品no.5', '攝影 設計 官方', '作品內文...', '0000-00-00'),
(19, 'images/works_upload/admin_1578970929_text01', 1859, 937, 'admin', 'text01', '123', '.....................', '2020-01-14');

-- --------------------------------------------------------

--
-- 資料表結構 `03_user_info`
--

CREATE TABLE `03_user_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `favorite` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `following` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `03_user_info`
--

INSERT INTO `03_user_info` (`id`, `acc`, `user_img`, `name`, `info`, `favorite`, `following`) VALUES
(1, 'admin', 'images/user_img_upload/admin_1578904390_download.jpg', '官方帳號', '我是官方帳號', '', ''),
(2, 'test01', 'https://picsum.photos/300/300/', '測試帳號', '我是測試帳號...', '', ''),
(3, 'user', 'https://picsum.photos/300/300/', '使用者01', '我是使用者', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `01_account`
--
ALTER TABLE `01_account`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `02_works_img`
--
ALTER TABLE `02_works_img`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `03_user_info`
--
ALTER TABLE `03_user_info`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `01_account`
--
ALTER TABLE `01_account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `02_works_img`
--
ALTER TABLE `02_works_img`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `03_user_info`
--
ALTER TABLE `03_user_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
