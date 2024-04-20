-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: kcking2
-- ------------------------------------------------------
-- Server version	10.5.23-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `externalusers`
--

DROP TABLE IF EXISTS `externalusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `externalusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `hashed_password` varchar(60) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `phonenumber` varchar(10) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `visits` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `externalusers`
--

LOCK TABLES `externalusers` WRITE;
/*!40000 ALTER TABLE `externalusers` DISABLE KEYS */;
INSERT INTO `externalusers` VALUES (1,'user','$2y$10$ZmIwYjRiYzFiMzZjYWUzZ.knWDILLOMZgGuCV5YcsPjltP1.WE1y2','Church','Walkin','6623973396','123 Sesame St','Sunnytown','PA',24575,0),(3,'kcking2','$2y$10$NDk2NzZhMGQ0MTJiYjkwM.Olh113tsdz8BonGjapCOzKJ2JaU/hx2','Kylan','King','6622920779','109 Tate','Senatobia','MS',38668,0),(5,'kcking','$2y$10$OTJhODNiMzgzODE5YzlmNufxjlUJkHO9KZCCCRAIzDJ0v1ii3tEjq','Kylan','King','4567897011','109 Tate','Senitobi','MS',38668,0),(8,'kenzie','$2y$10$YTYyYmIwZTczMjU3NWVhO.JClAXGdRDaNxUKy6FS2lDXzqkZ.XAja','Kenzie','Kenzie','1111111111','8766 Hat Pl','faketown','ms',35465,0);
/*!40000 ALTER TABLE `externalusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemrequests`
--

DROP TABLE IF EXISTS `itemrequests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemrequests` (
  `reqid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`reqid`,`itemid`),
  KEY `FK_items` (`itemid`),
  CONSTRAINT `FK_items` FOREIGN KEY (`itemid`) REFERENCES `items` (`itemid`),
  CONSTRAINT `FK_req` FOREIGN KEY (`reqid`) REFERENCES `requests` (`reqid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemrequests`
--

LOCK TABLES `itemrequests` WRITE;
/*!40000 ALTER TABLE `itemrequests` DISABLE KEYS */;
INSERT INTO `itemrequests` VALUES (2,1,3),(2,3,2),(2,4,2),(2,10,2),(3,1,2),(6,19,1),(6,23,1);
/*!40000 ALTER TABLE `itemrequests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `margin` int(11) NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Jiffy',100,10),(2,'Peanut Butter',100,10),(3,'Corn',100,15),(4,'Flour',100,24),(5,'Peaches',50,12),(6,'Pinto Beans',50,10),(7,'Rice',40,10),(8,'Sugar',20,30),(9,'Crackers',20,10),(10,'Instant Potatoes',10,10),(11,'Vegetable Oil',20,10),(12,'Peanut Butter',20,10),(13,'Cereal',20,10),(14,'Soup',30,10),(15,'Vienna Sausages',95,30),(16,'Lunch Meat',39,30),(17,'Tuna',29,30),(18,'Jelly',30,30),(19,'Spaghetti Noodles',20,30),(20,'Ketchup',20,30),(21,'Mayo',20,30),(22,'Meat Sauce',20,30),(23,'Mac and Cheese',21,30),(24,'Ramen Noodles',12,30),(25,'Pork and Beans',24,30),(26,'Green Beans',40,30),(27,'Special',46,0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `reqid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `fulfilled` tinyint(1) NOT NULL,
  PRIMARY KEY (`reqid`),
  KEY `FK_user` (`userid`),
  CONSTRAINT `FK_user` FOREIGN KEY (`userid`) REFERENCES `externalusers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (1,1,'2024-01-01',1),(2,1,'2024-03-27',1),(3,3,'2024-03-27',0),(6,5,'2024-03-28',1);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  `usertype` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `FK_utype` (`usertype`),
  CONSTRAINT `FK_utype` FOREIGN KEY (`usertype`) REFERENCES `utype` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','$2y$10$ZmIwYjRiYzFiMzZjYWUzZ.knWDILLOMZgGuCV5YcsPjltP1.WE1y2',0),('kylan','$2y$10$NDFhZWVkOTgwNGIzMDNkZe7fG4/UEeQbWNh3JxKPQfQmBn4M.oj5W',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utype`
--

DROP TABLE IF EXISTS `utype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utype` (
  `typeid` int(11) NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utype`
--

LOCK TABLES `utype` WRITE;
/*!40000 ALTER TABLE `utype` DISABLE KEYS */;
INSERT INTO `utype` VALUES (0,'admin'),(1,'worker');
/*!40000 ALTER TABLE `utype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-18 23:13:11
