-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-05-02 03:50
-- 서버 버전: 10.1.38-MariaDB
-- PHP 버전: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `testing`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `events`
--

INSERT INTO `events` (`id`, `name`, `startTime`, `endTime`) VALUES
(3, 'jjjj', '2019-04-11 00:00:00', '2019-04-12 00:00:00'),
(14, 'luis', '2019-05-02 10:00:00', '2019-05-02 11:00:00'),
(15, 'Jiayou', '2019-05-02 11:00:00', '2019-05-02 12:00:00'),
(16, 'lin', '2019-05-08 14:00:00', '2019-05-08 15:00:00'),
(17, 'Azman', '2019-05-08 17:00:00', '2019-05-08 18:00:00'),
(19, 'qian', '2019-05-09 09:00:00', '2019-05-09 13:00:00');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
