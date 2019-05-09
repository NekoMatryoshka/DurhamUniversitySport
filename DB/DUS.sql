-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-05-09 21:12
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
  `m_id` int(30) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `bookings`
--

INSERT INTO `bookings` (`id`, `f_id`, `f_name`, `m_id`, `m_name`, `start_time`, `end_time`) VALUES
(108, 106, 'Tennis', 22, 'luis', '2019-05-01 12:00:00', '2019-05-01 14:00:00'),
(109, 82, 'Fancing Salle', 22, 'luis', '2019-05-21 11:00:00', '2019-05-21 15:00:00'),
(110, 77, 'Squash Court', 22, 'luis', '2019-05-20 09:00:00', '2019-05-20 16:00:00'),
(111, 80, 'Sports Hall', 22, 'luis', '2019-05-07 11:00:00', '2019-05-07 16:00:00'),
(112, 106, 'Tennis', 22, 'luis', '2019-05-15 11:00:00', '2019-05-15 14:00:00');

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
(106, 'Tennis', '11:00:00', '14:00:00', 'asdasd', 'asd', '1212', 12, './public/img/teamdurham.png'),
(110, 'Foot ball ', '10:00:00', '14:00:00', 'sdsdfdsf', '23424', '23524', 20, './public/img/New.png');

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `m_id` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `type` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`id`, `m_id`, `password`, `name`, `email`, `tel`, `type`) VALUES
(21, 'admin', '$2y$10$lOwAh.Q9QCCTJnpe5QKNIeqrEWNkM4qrKtq4xxQIWTs7wJJmTJD9S', 'admin', 'admin', '077777777', 'user'),
(22, 'luis', '$2y$10$FtZYOEch/kvkYDRPpfB7.uXVapGKm0eiHi13AmJJ1cO4/ebHB5FQK', 'luis', 'luis', '1111', 'user'),
(23, 'hello', '$2y$10$I2rfdg92AZDwIysTVriKMuBPNB0jZo/dVSNIYea7T6kczKUxohH1y', 'hello', 'hello1', '2352353253', 'user');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `bookings_ibfk_2` (`m_id`);

--
-- 테이블의 인덱스 `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- 테이블의 AUTO_INCREMENT `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
