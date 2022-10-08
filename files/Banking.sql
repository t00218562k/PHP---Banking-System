-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: Banking
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `accountid` smallint(6) NOT NULL AUTO_INCREMENT,
  `guest_id` smallint(6) NOT NULL,
  `date` date NOT NULL,
  `balance` decimal(12,2) NOT NULL,
  `account` enum('NULL','CA','SA','MA','CD') DEFAULT NULL,
  PRIMARY KEY (`accountid`),
  KEY `guest_id` (`guest_id`),
  CONSTRAINT `account_ibfk_1` FOREIGN KEY (`guest_id`) REFERENCES `guest_information` (`guestid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,1,'2021-12-15',1423232534.00,'CA'),(2,2,'2021-12-15',12121412.00,'SA'),(3,3,'2021-12-15',856854.00,'SA'),(4,4,'2021-12-15',68446.00,'SA'),(5,5,'2021-12-15',8242523.00,'SA'),(7,8,'2021-12-15',2132323321.00,'SA'),(8,9,'2021-12-15',334.00,'CA');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest_information`
--

DROP TABLE IF EXISTS `guest_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest_information` (
  `guestid` smallint(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `area` varchar(22) NOT NULL,
  `county` varchar(23) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`guestid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest_information`
--

LOCK TABLES `guest_information` WRITE;
/*!40000 ALTER TABLE `guest_information` DISABLE KEYS */;
INSERT INTO `guest_information` VALUES (1,'ben','simmons','1980-02-02','12 row row','Dublin City','Dublin','benny@nba.com','+232121212'),(2,'Roy','Johnes','1967-09-22','Limerick Road','Limerick City','Limerick','johansisthejohans@jj.com','0895643546'),(3,'jell','mell','1999-12-12','23 rover street','Killarney','Kerry','roverdoendidthis@ohmy.com','0896482365'),(4,'Gill','Robbert','1970-12-12','Spa Road','Tralee','Kerry','spaboy@spa.com','0894657234'),(5,'David','Moyes','1901-09-22','Grove Street','Tralee','Kerry','yoCJ@gmail.com','0896452323'),(8,'Travis','Scott','1992-09-13','Palm Beach','Tralee','Kerry','jojowojo@jowo.com','0875554545'),(9,'Billy','Ray','1979-04-01','99 Oh no','Dingle','Kerry','ohnobillydidit@billy.com','0895786793');
/*!40000 ALTER TABLE `guest_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_history`
--

DROP TABLE IF EXISTS `transaction_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_history` (
  `transactionid` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` smallint(6) NOT NULL,
  `ammount` decimal(12,2) NOT NULL,
  `transaction` enum('NULL','W','I','L','O') DEFAULT NULL,
  PRIMARY KEY (`transactionid`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `transaction_history_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`accountid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_history`
--

LOCK TABLES `transaction_history` WRITE;
/*!40000 ALTER TABLE `transaction_history` DISABLE KEYS */;
INSERT INTO `transaction_history` VALUES (1,1,100.00,'O'),(2,4,100.00,'I'),(3,1,100.00,'O'),(4,2,100.00,'I'),(5,1,100.00,'O'),(6,2,100.00,'I'),(7,1,100.00,'O'),(8,3,100.00,'I'),(9,1,100.00,'O'),(10,5,100.00,'I'),(11,1,100.00,'O'),(12,7,100.00,'I'),(13,1,100.00,'O'),(14,8,100.00,'I'),(15,4,100.00,'L'),(16,4,100.00,'L');
/*!40000 ALTER TABLE `transaction_history` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-15 20:15:21
