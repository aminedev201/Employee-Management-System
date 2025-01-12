CREATE DATABASE  IF NOT EXISTS `employes_ms_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `employes_ms_db`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: employes_ms_db
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departements`
--

LOCK TABLES `departements` WRITE;
/*!40000 ALTER TABLE `departements` DISABLE KEYS */;
INSERT INTO `departements` VALUES (8,'Software Development','This is the core technical team responsible for designing, coding, and maintaining web, mobile, and desktop applications. the department ensures that software solutions are functional, scalable, secure, and meet client requirements.','2025-01-04 22:23:50','2025-01-04 22:23:50'),(9,'Ui/ux Design','This department focuses on creating visually appealing and user-friendly interfaces. they ensure a smooth user experience (ux) by designing intuitive user interfaces (ui) that align with client needs and project goals.','2025-01-04 22:24:32','2025-01-04 22:24:32'),(10,'Infrastructure','Responsible for managing the company’s servers, networks, and cloud infrastructure. they ensure that the company’s systems are running smoothly, securely, and efficiently.','2025-01-04 22:25:27','2025-01-04 22:25:27'),(11,'Cybersecurity','This department is responsible for protecting the company’s digital assets from cyber threats. they implement security protocols, monitor vulnerabilities, and conduct penetration tests.','2025-01-04 22:25:51','2025-01-04 22:25:51'),(12,'Data Analysis','The data analysis department collects, processes, and analyzes data to provide actionable insights. they help improve business operations, optimize marketing strategies, and enhance user experiences.','2025-01-04 22:26:13','2025-01-04 22:26:13'),(13,'Human Resources (hr)','The hr department is responsible for hiring, training, and retaining the right talent. they ensure a healthy work environment and manage employee relations.','2025-01-04 22:26:54','2025-01-04 22:26:54');
/*!40000 ALTER TABLE `departements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-12 14:14:42
