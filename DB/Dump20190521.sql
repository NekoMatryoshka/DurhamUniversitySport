-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-05-23 13:39
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
-- 테이블 구조 `blocks`
--

CREATE TABLE `blocks` (
  `id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `f_id` int(10) NOT NULL,
  `m_id` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `dow` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `f_id`, `m_id`, `start_time`, `end_time`, `start_date`, `end_date`, `dow`) VALUES
(10, 'TEST', 77, 21, '06:00:00', '14:00:00', '2019-07-21', '2019-07-30', '1,3,5');

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
  `date` date NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `bookings`
--

INSERT INTO `bookings` (`id`, `f_id`, `f_name`, `m_id`, `m_name`, `date`, `start_time`, `end_time`) VALUES
(463, 77, 'Squash Court', 21, 'admin', '2019-05-17', '2019-05-17 14:00:00', '2019-05-17 15:00:00'),
(464, 77, 'Squash Court', 21, 'admin', '2019-05-18', '2019-05-18 12:00:00', '2019-05-18 13:00:00'),
(465, 77, 'Squash Court', 21, 'admin', '2019-05-19', '2019-05-19 17:00:00', '2019-05-19 18:00:00'),
(466, 82, 'Fancing Salle', 21, 'admin', '2019-05-20', '2019-05-20 12:30:00', '2019-05-20 13:00:00'),
(470, 80, 'Sports Hall', 31, 'apple1', '2019-05-22', '2019-05-22 15:00:00', '2019-05-22 17:00:00'),
(471, 80, 'Sports Hall', 31, 'apple1', '2019-05-23', '2019-05-23 11:00:00', '2019-05-23 13:00:00'),
(476, 77, 'Squash Court', 32, 'banana2', '2019-05-24', '2019-05-24 15:00:00', '2019-05-24 16:00:00'),
(477, 77, 'Squash Court', 32, 'banana2', '2019-05-25', '2019-05-25 17:00:00', '2019-05-25 18:00:00'),
(484, 77, 'Squash Court', 34, 'yating', '2019-05-29', '2019-05-29 12:00:00', '2019-05-29 13:00:00'),
(485, 77, 'Squash Court', 34, 'yating', '2019-05-30', '2019-05-30 14:00:00', '2019-05-30 15:00:00'),
(486, 77, 'Squash Court', 34, 'yating', '2019-05-31', '2019-05-31 13:00:00', '2019-05-31 14:00:00'),
(487, 77, 'Squash Court', 34, 'yating', '2019-06-01', '2019-06-01 13:00:00', '2019-06-01 14:00:00'),
(488, 77, 'Squash Court', 34, 'yating', '2019-06-02', '2019-06-02 14:00:00', '2019-06-02 15:00:00'),
(491, 77, 'Squash Court', 33, 'pear3', '2019-06-04', '2019-06-04 12:00:00', '2019-06-04 13:00:00'),
(494, 80, 'Sports Hall', 33, 'pear3', '2019-06-05', '2019-06-05 15:00:00', '2019-06-05 17:00:00'),
(500, 82, 'Fancing Salle', 21, 'admin', '2019-05-17', '2019-05-17 15:30:00', '2019-05-17 16:00:00'),
(501, 80, 'Sports Hall', 21, 'admin', '2019-05-17', '2019-05-17 15:00:00', '2019-05-17 17:00:00'),
(502, 82, 'Fancing Salle', 21, 'admin', '2019-05-16', '2019-05-16 12:30:00', '2019-05-16 13:00:00'),
(505, 80, 'Sports Hall', 32, 'banana2', '2019-05-25', '2019-05-25 11:00:00', '2019-05-25 13:00:00'),
(506, 80, 'Sports Hall', 34, 'yating', '2019-05-25', '2019-05-25 11:00:00', '2019-05-25 13:00:00'),
(507, 80, 'Sports Hall', 33, 'pear3', '2019-05-25', '2019-05-25 11:00:00', '2019-05-25 13:00:00'),
(508, 80, 'Sports Hall', 21, 'admin', '2019-05-25', '2019-05-25 11:00:00', '2019-05-25 13:00:00'),
(514, 82, 'Fancing Salle', 31, 'apple1', '2019-05-25', '2019-05-25 11:00:00', '2019-05-25 11:30:00'),
(515, 82, 'Fancing Salle', 31, 'apple1', '2019-05-26', '2019-05-26 12:30:00', '2019-05-26 13:00:00'),
(517, 80, 'Sports Hall', 21, 'admin', '2019-05-28', '2019-05-28 13:00:00', '2019-05-28 15:00:00'),
(518, 82, 'Fancing Salle', 36, 'won', '2019-05-29', '2019-05-29 12:30:00', '2019-05-29 13:00:00'),
(519, 82, 'Fancing Salle', 36, 'won', '2019-05-27', '2019-05-27 14:00:00', '2019-05-27 14:30:00'),
(520, 80, 'Sports Hall', 36, 'won', '2019-06-14', '2019-06-14 13:00:00', '2019-06-14 15:00:00'),
(521, 80, 'Sports Hall', 21, 'admin', '2019-06-22', '2019-06-22 15:00:00', '2019-06-22 17:00:00'),
(522, 80, 'Sports Hall', 21, 'admin', '2019-06-30', '2019-06-30 15:00:00', '2019-06-30 17:00:00'),
(523, 80, 'Sports Hall', 32, 'banana2', '2019-06-30', '2019-06-30 15:00:00', '2019-06-30 17:00:00');

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
  `capacity` int(10) NOT NULL,
  `duration` time NOT NULL,
  `contact` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(50) DEFAULT './public/img/New.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `open_time`, `close_time`, `description`, `capacity`, `duration`, `contact`, `tel`, `price`, `image`) VALUES
(77, 'Squash Court', '09:00:00', '18:00:00', 'This is a Squash Court.', 5, '01:00:00', 'squash@dur.ac.kr', '072970123233', 15, './public/img/Squash-Courts.jpg'),
(80, 'Sports Hall', '11:00:00', '17:00:00', 'This is a Sports Hall', 4, '02:00:00', 'hall@dur.ac.kr', '07239482332', 12, './public/img/Sports-Hall.jpg'),
(82, 'Fancing Salle', '11:00:00', '16:00:00', 'This is a Fencing Salle\r\nhi', 3, '00:30:00', 'fencing@dur.ac.kr', '071248123', 20, './public/img/Fencing-Salle.jpg');

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
(21, 'admin', '$2y$10$lOwAh.Q9QCCTJnpe5QKNIeqrEWNkM4qrKtq4xxQIWTs7wJJmTJD9S', 'admin', 'admin', '077777777', 'admin'),
(31, 'apple1', '$2y$10$BUue1Y/1uSstjOTp5Ge/4O1MtVKTyy32KRuKDVyPXsb4V2W1Ky8yC', 'apple', 'apple@durham.ac.uk', '111111', 'user'),
(32, 'banana2', '$2y$10$JwWy.qA3Z99gJytRVWkIxekQzgdDSVtMB0v9qlADx/L9aE2wjktmW', 'banana', 'banana@durham.ac.uk', '2222222', 'user'),
(33, 'pear3', '$2y$10$ZtGASOQ3eSOTA0MrLMcRc.Rc2JCig7A4gaMTVH8xtJxG9ywdqntmS', 'pear', 'pear3@durham.ac.uk', '33333333', 'user'),
(34, 'yating', '$2y$10$jF4EIlider/tLScGJYIALesgNUQihGRPvT1QHWQ8qYrzwGG6q./lC', 'liu', 'cute', '123', 'user'),
(35, 'luis', '$2y$10$tfufUeernMEPJfmygUxjzeuqdaClbtIebJG2kKi0yYKMQaqVpaV3.', 'won', 'kedus1234@gmail.com', '1123', 'user'),
(36, 'won', '$2y$10$5/a7mqgWsH8nQ3j5Fmvvc.Nu9D9DMjzIPrr3OghRNPsig7Njxhc9y', 'Won Jun Youn', 'kedus@naver.com', '123', 'user');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocks_ibfk_1` (`f_id`),
  ADD KEY `blocks_ibfk_2` (`m_id`);

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
-- 테이블의 AUTO_INCREMENT `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- 테이블의 AUTO_INCREMENT `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blocks_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
