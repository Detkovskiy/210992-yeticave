-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: yeticave
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Dumping data for table `bet`
--

LOCK TABLES `bet` WRITE;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
INSERT INTO `bet` VALUES (1,1,3,'2017-09-13 21:42:00',20000),(2,2,3,'2017-09-13 10:42:00',10000),(3,3,3,'2017-09-13 16:42:00',15000),(4,1,1,'2017-09-13 20:42:00',10000),(5,2,2,'2017-09-13 18:42:00',20000),(6,3,1,'2017-09-13 02:42:00',30000),(7,1,3,'2017-09-13 05:42:00',12500),(31,2,3,'2017-09-24 10:53:00',21000),(32,3,6,'2017-09-18 11:00:00',12121);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Доски и лыжи'),(2,'Крепления'),(3,'Ботинки'),(4,'Одежда'),(5,'Инструменты'),(6,'Разное');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lots`
--

LOCK TABLES `lots` WRITE;
/*!40000 ALTER TABLE `lots` DISABLE KEYS */;
INSERT INTO `lots` VALUES (1,1,NULL,1,'2017-09-13 14:42:00','2017 Rossignol District Snowboard','','img/lot-1.jpg',10500,2000,'2017-09-24',5),(2,2,NULL,1,'2017-09-13 11:42:00','DC Ply Mens 2016/2017 Snowboard','22','img/lot-2.jpg',15900,5000,'2017-09-24',6),(3,3,NULL,2,'2017-09-13 15:42:00','Крепления Union Contact Pro 2015 года размер L/XL','','img/lot-3.jpg',8000,1000,'2017-09-28',35),(4,1,NULL,3,'2017-09-13 08:42:00','Ботинки для сноуборда DC Mutiny Charocal','','img/lot-4.jpg',9000,2000,'2017-09-28',1),(5,2,NULL,4,'2017-09-13 21:42:00','Куртка для сноуборда DC Mutiny Charocal','','img/lot-5.jpg',7500,1000,'2017-09-28',11),(6,2,NULL,6,'2017-09-13 19:42:00','Маска Oakley Canopy','','img/lot-6.jpg',5400,500,'2017-09-28',21);
/*!40000 ALTER TABLE `lots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'2017-09-08 00:00:00','ignat.v@gmail.com','Игнат','$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka',NULL,NULL),(2,'2017-09-04 11:18:43','kitty_93@li.ru','Леночка','$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',NULL,NULL),(3,'2017-09-17 11:18:53','warrior07@mail.ru','Руслан','$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-26 10:44:35
