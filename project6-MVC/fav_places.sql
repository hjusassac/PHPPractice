-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 22-12-26 12:02
-- 서버 버전: 10.4.21-MariaDB
-- PHP 버전: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `fav_places`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `map_provider` varchar(50) DEFAULT NULL,
  `map_link` varchar(2048) DEFAULT NULL,
  `memo` text NOT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `places`
--

INSERT INTO `places` (`id`, `name`, `map_provider`, `map_link`, `memo`, `rating`) VALUES
(1, 'sample1', NULL, NULL, 'sample data1', NULL),
(2, 'sample2', NULL, NULL, 'sample data2', NULL),
(3, 'sample3', NULL, NULL, 'sample data3', NULL),
(4, 'sample4', NULL, NULL, 'sample data4', NULL);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
