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
-- Table structure for table `marcacao`
--

DROP TABLE IF EXISTS `marcacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcacao` (
  `idmarcacao` int NOT NULL AUTO_INCREMENT,
  `idpaciente` int NOT NULL,
  `iddentista` int DEFAULT NULL,
  `datamarcacao` varchar(14) NOT NULL,
  `horamarcacao` time DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `comprovativo` varchar(500) NOT NULL,
  PRIMARY KEY (`idmarcacao`),
  KEY `idpaciente_idx` (`idpaciente`),
  KEY `iddentista_idx` (`iddentista`),
  CONSTRAINT `iddentista` FOREIGN KEY (`iddentista`) REFERENCES `dentista` (`iddentista`),
  CONSTRAINT `idpaciente` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcacao`
--

LOCK TABLES `marcacao` WRITE;
/*!40000 ALTER TABLE `marcacao` DISABLE KEYS */;
INSERT INTO `marcacao` VALUES (4,18,NULL,'2023-05-25','12:12:00',1,'documentos/marcacao/646f2523928f8.pdf'),(11,19,NULL,'2023-04-26','16:00:00',1,'documentos/marcacao/6470a9ea1deda.pdf'),(13,15,NULL,'2023-05-30','10:00:00',0,'documentos/marcacao/647601233eeed.pdf'),(14,18,NULL,'2023-05-31','11:51:00',1,'documentos/marcacao/64770a8e75d7e.pdf'),(15,21,NULL,'2023-05-31','13:36:00',1,'documentos/marcacao/6477234dd4d08.pdf'),(16,21,NULL,'2023-05-31','13:36:00',0,'documentos/marcacao/6477234bc4906.pdf'),(17,17,NULL,'2023-05-31','17:02:00',1,'documentos/marcacao/6477294f325be.pdf'),(18,22,NULL,'2023-05-31','12:10:00',1,'documentos/marcacao/64772b27b1e19.pdf'),(19,23,NULL,'2023-05-31','12:20:00',1,'documentos/marcacao/64772da109261.pdf'),(20,23,NULL,'2023-05-31','16:52:00',1,'documentos/marcacao/64773523aad00.pdf'),(21,18,NULL,'2023-05-31','15:02:00',1,'documentos/marcacao/6477375c6e12b.pdf'),(22,17,NULL,'2023-06-01','12:12:00',0,'documentos/marcacao/647839f04065a.pdf'),(23,18,NULL,'2023-06-01','09:06:00',0,'documentos/marcacao/647850aa24545.pdf'),(24,24,NULL,'2023-06-01','13:30:00',1,'documentos/marcacao/6478649771e81.pdf'),(25,22,NULL,'2023-06-01','09:00:00',0,'documentos/marcacao/647868ea977aa.pdf');
/*!40000 ALTER TABLE `marcacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-06 11:09:56
