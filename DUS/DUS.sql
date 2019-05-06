-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-05-07 01:45
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
-- 데이터베이스: `DUS`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) NOT NULL,
  `f_id` int(10) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `bookings`
--

INSERT INTO `bookings` (`id`, `f_id`, `f_name`, `name`, `start_time`, `end_time`) VALUES
(16, 80, 'Sports Hall', 'Jane Smith', '2019-05-08 12:00:00', '2019-05-08 14:00:00'),
(17, 106, 'asdasd', 'luis', '2019-05-09 13:00:00', '2019-05-09 15:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `facilities`
--

CREATE TABLE `facilities` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `description` varchar(300) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(50) DEFAULT './public/img/New.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `open_time`, `close_time`, `description`, `contact`, `tel`, `price`, `image`) VALUES
(77, 'Squash Court', '09:00:00', '18:00:00', 'This is a Squash Court.', 'squash@dur.ac.kr', '072970123233', 15, './public/img/Squash-Courts.jpg'),
(80, 'Sports Hall', '11:00:00', '17:00:00', 'This is a Sports Hall', 'hall@dur.ac.kr', '07239482332', 12, './public/img/Sports-Hall.jpg'),
(82, 'Fancing Salle', '11:00:00', '16:00:00', 'This is a Fencing Salle\r\nhi', 'fencing@dur.ac.kr', '071248123', 20, './public/img/teamdurham.png'),
(106, 'asdasd', '11:00:00', '14:00:00', 'asdasd', 'asd', '1212', 12, './public/img/teamdurham.png');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_id` (`f_id`);

--
-- 테이블의 인덱스 `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
