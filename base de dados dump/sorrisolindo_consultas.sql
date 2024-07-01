-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: sorrisolindo
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas` (
  `idconsulta` int NOT NULL AUTO_INCREMENT,
  `idmarcacao` int NOT NULL,
  `idservico` int NOT NULL,
  `dataConsulta` varchar(12) NOT NULL,
  `qtd` varchar(45) NOT NULL,
  PRIMARY KEY (`idconsulta`),
  KEY `idmarcacao_idx` (`idmarcacao`),
  KEY `idservico_idx` (`idservico`),
  CONSTRAINT `idmarcacao` FOREIGN KEY (`idmarcacao`) REFERENCES `marcacao` (`idmarcacao`),
  CONSTRAINT `idservico` FOREIGN KEY (`idservico`) REFERENCES `servicos` (`idservicos`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,1,1,'2023-05-11','2'),(2,1,7,'2023-05-11','4'),(6,3,7,'2023-05-11','2'),(7,3,8,'2023-05-11','3'),(9,5,7,'2023-05-12','3'),(10,5,7,'2023-05-12','3'),(11,5,7,'2023-05-12','3'),(12,5,8,'2023-05-12','9'),(13,5,1,'2023-05-12','9'),(14,5,6,'2023-05-12','4'),(15,5,7,'2023-05-12','3'),(16,5,7,'2023-05-12','8'),(17,6,8,'2023-05-12','4'),(18,6,9,'2023-05-12','2'),(19,6,8,'2023-05-12','2'),(20,6,9,'2023-05-12','2'),(21,6,8,'2023-05-12','2'),(22,6,9,'2023-05-12','2'),(23,6,6,'2023-05-12','5'),(24,6,9,'2023-05-12',''),(25,6,9,'2023-05-12','2'),(26,6,9,'2023-05-12','2'),(27,6,1,'2023-05-12','2'),(28,6,7,'2023-05-12','6'),(29,6,7,'2023-05-12','4'),(30,6,9,'2023-05-12','2'),(31,6,6,'2023-05-12','4'),(32,6,1,'2023-05-12','2'),(33,6,9,'2023-05-12','9'),(34,6,6,'2023-05-12','9'),(35,6,6,'2023-05-12','9'),(36,6,9,'2023-05-12','7'),(37,6,9,'2023-05-12','2'),(38,6,8,'2023-05-12','2'),(39,6,1,'2023-05-12','2'),(40,7,8,'2023-05-12','7'),(41,7,6,'2023-05-12','7'),(42,8,9,'2023-05-12','4'),(43,8,8,'2023-05-12','2'),(44,8,1,'2023-05-12','1'),(45,9,7,'2023-05-12','2'),(46,9,8,'2023-05-12','6'),(47,9,1,'2023-05-12','1'),(48,10,9,'2023-05-15','2'),(49,10,8,'2023-05-15','2'),(50,11,8,'2023-05-15','2'),(51,11,9,'2023-05-15','2'),(52,11,7,'2023-05-15','3'),(53,11,9,'2023-05-15','2'),(54,11,8,'2023-05-15','2'),(55,12,6,'2023-05-15','2'),(56,12,8,'2023-05-15','2'),(57,12,9,'2023-05-15','3'),(58,17,8,'2023-05-17','2'),(59,17,1,'2023-05-17','1'),(60,18,9,'2023-05-24','2'),(61,18,9,'2023-05-24','3'),(62,18,7,'2023-05-24','1'),(63,22,8,'2023-05-25','8'),(64,4,8,'2023-05-25','2'),(65,11,6,'2023-05-26','3'),(66,11,9,'2023-05-26','2'),(67,11,1,'2023-05-26','1'),(68,14,8,'2023-05-31','3'),(69,14,7,'2023-05-31','2'),(70,15,6,'2023-05-31','4'),(71,18,1,'2023-05-31','1'),(72,18,1,'2023-05-31','1'),(73,19,8,'2023-05-31','1'),(74,20,1,'2023-05-31','1'),(75,21,7,'2023-05-31','2'),(76,21,1,'2023-05-31','1'),(77,24,1,'2023-06-01','1'),(78,24,9,'2023-06-01','2');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-06 11:09:55
