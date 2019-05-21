CREATE DATABASE  IF NOT EXISTS `dus` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dus`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dus
-- ------------------------------------------------------
-- Server version	5.7.19-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `f_id` int(10) NOT NULL,
  `m_id` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `dow` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'exam period',77,21,'06:00:00','12:00:00','2019-05-20','2019-05-27','1,2,3,4'),(3,'tester',77,21,'01:00:00','02:00:00','2019-05-21','2019-05-22','1'),(4,'wewe',77,21,'01:00:00','02:00:00','2019-05-21','2019-05-22','1'),(5,'testing',77,21,'10:00:00','19:00:00','2019-05-17','2019-05-26','5');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `f_id` int(10) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_id` int(30) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `f_id` (`f_id`),
  KEY `bookings_ibfk_2` (`m_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=520 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (458,77,'Squash Court',21,'admin','2019-05-17','2019-05-17 11:00:00','2019-05-17 12:00:00'),(463,77,'Squash Court',21,'admin','2019-05-17','2019-05-17 14:00:00','2019-05-17 15:00:00'),(464,77,'Squash Court',21,'admin','2019-05-18','2019-05-18 12:00:00','2019-05-18 13:00:00'),(465,77,'Squash Court',21,'admin','2019-05-19','2019-05-19 17:00:00','2019-05-19 18:00:00'),(466,82,'Fancing Salle',21,'admin','2019-05-20','2019-05-20 12:30:00','2019-05-20 13:00:00'),(467,82,'Fancing Salle',31,'apple1','2019-05-20','2019-05-20 14:00:00','2019-05-20 14:30:00'),(469,80,'Sports Hall',31,'apple1','2019-05-21','2019-05-21 13:00:00','2019-05-21 15:00:00'),(470,80,'Sports Hall',31,'apple1','2019-05-22','2019-05-22 15:00:00','2019-05-22 17:00:00'),(471,80,'Sports Hall',31,'apple1','2019-05-23','2019-05-23 11:00:00','2019-05-23 13:00:00'),(472,80,'Sports Hall',31,'apple1','2019-05-30','2019-05-30 13:00:00','2019-05-30 15:00:00'),(473,106,'Tennis',32,'banana2','2019-05-21','2019-05-21 09:00:00','2019-05-21 12:00:00'),(474,106,'Tennis',32,'banana2','2019-05-22','2019-05-22 09:00:00','2019-05-22 12:00:00'),(475,106,'Tennis',32,'banana2','2019-05-23','2019-05-23 18:00:00','2019-05-23 21:00:00'),(476,77,'Squash Court',32,'banana2','2019-05-24','2019-05-24 15:00:00','2019-05-24 16:00:00'),(477,77,'Squash Court',32,'banana2','2019-05-25','2019-05-25 17:00:00','2019-05-25 18:00:00'),(484,77,'Squash Court',34,'yating','2019-05-29','2019-05-29 12:00:00','2019-05-29 13:00:00'),(485,77,'Squash Court',34,'yating','2019-05-30','2019-05-30 14:00:00','2019-05-30 15:00:00'),(486,77,'Squash Court',34,'yating','2019-05-31','2019-05-31 13:00:00','2019-05-31 14:00:00'),(487,77,'Squash Court',34,'yating','2019-06-01','2019-06-01 13:00:00','2019-06-01 14:00:00'),(488,77,'Squash Court',34,'yating','2019-06-02','2019-06-02 14:00:00','2019-06-02 15:00:00'),(510,106,'Tennis',36,'durham','2019-05-21','2019-05-21 12:00:00','2019-05-21 15:00:00'),(518,82,'Fancing Salle',35,'jiayou','2019-05-21','2019-05-21 13:30:00','2019-05-21 14:00:00'),(519,77,'Squash Court',35,'jiayou','2019-05-22','2019-05-22 13:00:00','2019-05-22 14:00:00');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facilities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `description` varchar(300) NOT NULL,
  `capacity` int(10) NOT NULL,
  `duration` time NOT NULL,
  `contact` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(50) DEFAULT './public/img/New.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` VALUES (77,'Squash Court','09:00:00','18:00:00','This is a Squash Court.',5,'01:00:00','squash@dur.ac.kr','072970123233',15,'./public/img/Squash-Courts.jpg'),(80,'Sports Hall','11:00:00','17:00:00','This is a Sports Hall',4,'02:00:00','hall@dur.ac.kr','07239482332',12,'./public/img/Squash-Courts.jpg'),(82,'Fancing Salle','11:00:00','16:00:00','This is a Fencing Salle\r\nhi',3,'00:30:00','fencing@dur.ac.kr','071248123',20,'./public/img/Squash-Courts.jpg'),(106,'Tennis','06:00:00','24:00:00','asdasd',1,'03:00:00','asd','1212',12,'./public/img/'),(110,'Foot ball ','10:00:00','14:00:00','sdsdfdsf',2,'01:30:00','23424','23524',20,'./public/img/Squash-Courts.jpg');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `type` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (21,'admin','$2y$10$lOwAh.Q9QCCTJnpe5QKNIeqrEWNkM4qrKtq4xxQIWTs7wJJmTJD9S','admin','admin','077777777','admin'),(31,'apple1','$2y$10$BUue1Y/1uSstjOTp5Ge/4O1MtVKTyy32KRuKDVyPXsb4V2W1Ky8yC','apple','apple@durham.ac.uk','111111','user'),(32,'banana2','$2y$10$JwWy.qA3Z99gJytRVWkIxekQzgdDSVtMB0v9qlADx/L9aE2wjktmW','banana','banana@durham.ac.uk','2222222','user'),(33,'pear3','$2y$10$ZtGASOQ3eSOTA0MrLMcRc.Rc2JCig7A4gaMTVH8xtJxG9ywdqntmS','pear','pear3@durham.ac.uk','33333333','user'),(34,'yating','$2y$10$jF4EIlider/tLScGJYIALesgNUQihGRPvT1QHWQ8qYrzwGG6q./lC','liu','cute','123','user'),(35,'jiayou','$2y$10$X5x1m.f9OJciwm9uvJHEzu1Qe76Zy1JlzHN33eR7kWB7dZbeTfqLW','jiayou','952523131@qq.com','jiayou','user'),(36,'durham','$2y$10$t9P9lQdF4JrYO2atPJOalOe2z9SR/xHDb9cMqv2VwGnCybZct1JWC','durham','jiayou.wang@durham.ac.uk','durham','user');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-21  4:25:43
