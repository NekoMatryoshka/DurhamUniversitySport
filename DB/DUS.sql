-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-05-08 11:14
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
(49, 82, 'Fancing Salle', 'luis', '2019-05-16 11:00:00', '2019-05-16 14:00:00'),
(50, 82, 'Fancing Salle', 'luis', '2019-05-10 14:00:00', '2019-05-10 18:00:00'),
(51, 106, 'asdasd', 'luis', '2019-05-14 11:00:00', '2019-05-14 15:00:00'),
(52, 77, 'Squash Court', 'luis', '2019-05-21 12:00:00', '2019-05-21 18:00:00'),
(53, 77, 'Squash Court', 'luis', '2019-05-10 15:00:00', '2019-05-10 16:00:00'),
(54, 77, 'Squash Court', 'luis', '2019-05-30 13:00:00', '2019-05-30 14:00:00'),
(55, 77, 'Squash Court', 'luis', '2019-05-12 16:00:00', '2019-05-12 18:00:00'),
(56, 80, 'Sports Hall', 'luis', '2019-05-07 13:00:00', '2019-05-07 14:00:00'),
(57, 80, 'Sports Hall', 'luis', '2019-05-30 09:00:00', '2019-05-30 11:00:00'),
(58, 80, 'Sports Hall', 'luis', '2019-06-01 12:00:00', '2019-06-01 16:00:00'),
(59, 82, 'Fancing Salle', 'luis', '2019-05-26 10:00:00', '2019-05-26 18:00:00'),
(60, 82, 'Fancing Salle', 'luis', '2019-05-02 11:00:00', '2019-05-02 15:00:00'),
(61, 82, 'Fancing Salle', 'luis', '2019-04-30 09:00:00', '2019-04-30 15:00:00'),
(62, 106, 'asdasd', 'luis', '2019-05-10 10:00:00', '2019-05-10 18:00:00'),
(68, 106, 'Tennis', 'luis', '2019-05-23 11:00:00', '2019-05-23 14:00:00'),
(69, 110, 'Foot ball ', 'luis', '2019-05-21 11:00:00', '2019-05-21 15:00:00'),
(70, 110, 'Foot ball ', 'luis', '2019-05-24 14:00:00', '2019-05-24 15:00:00'),
(71, 77, 'Squash Court', 'Yating', '2019-05-15 10:00:00', '2019-05-15 13:00:00'),
(72, 77, 'Squash Court', 'Yating', '2019-05-17 11:00:00', '2019-05-17 16:00:00'),
(73, 77, 'Squash Court', 'Yating', '2019-05-27 15:00:00', '2019-05-27 18:00:00'),
(74, 106, 'Tennis', 'Yating', '2019-05-20 09:00:00', '2019-05-20 13:00:00'),
(75, 106, 'Tennis', 'Yating', '2019-05-30 13:00:00', '2019-05-30 17:00:00'),
(76, 110, 'Foot ball ', 'Yating', '2019-05-05 14:00:00', '2019-05-05 18:00:00'),
(77, 110, 'Foot ball ', 'Yating', '2019-05-03 15:00:00', '2019-05-03 18:00:00'),
(80, 80, 'Sports Hall', 'luis', '2019-05-21 11:00:00', '2019-05-21 15:00:00');

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
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `type` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`id`, `m_id`, `password`, `name`, `email`, `tel`, `type`) VALUES
(6, '121212', '1212', '1231212', '1212', '12355', 'user'),
(10, 'luis', '54321', 'WON J Y', 'kedus1234@gmail.com', '1222352342', 'admin'),
(11, 'Yating', '0726', 'Liu Yating', '213', '312213', 'user');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- 테이블의 AUTO_INCREMENT `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
