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
-- Table structure for table `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorio` (
  `idrelatorio` int NOT NULL AUTO_INCREMENT,
  `Dentista` int DEFAULT NULL,
  `Marcacao` int DEFAULT NULL,
  `Relatorio` longtext,
  PRIMARY KEY (`idrelatorio`),
  KEY `Dentista_idx` (`Dentista`),
  KEY `Marcacao_idx` (`Marcacao`),
  CONSTRAINT `Dentista` FOREIGN KEY (`Dentista`) REFERENCES `dentista` (`iddentista`),
  CONSTRAINT `Marcacao` FOREIGN KEY (`Marcacao`) REFERENCES `marcacao` (`idmarcacao`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorio`
--

LOCK TABLES `relatorio` WRITE;
/*!40000 ALTER TABLE `relatorio` DISABLE KEYS */;
INSERT INTO `relatorio` VALUES (1,2,24,'\n         wesrdctfvgybhnjikmo,l;.yhgtfvcdxszaawzsexdrfcgtvbhjnkml,kmjnhbgvfcdxszqawsedrfgtyhnjmk,ll,kmjnhbgvfcd aswxdcfgvbhjnmk,l,kmjnhbgvfc'),(2,2,3,'\n         kjhtr4e;.l,kmjnhygtrfelkjmhnbgfv,jmh'),(3,2,9,'\n         +0çpol9ik8uj7hy6t5fr4edw+ºpçolikju7hy6t5grf4eº+çpolikjuhytgfredwsqa'),(4,2,9,'\n         +0çpol9ik8uj7hy6t5fr4edw+ºpçolikju7hy6t5grf4eº+çpolikjuhytgfredwsqa'),(5,2,9,'\n         +0çpol9ik8uj7hy6t5fr4edw+ºpçolikju7hy6t5grf4eº+çpolikjuhytgfredwsqa'),(6,2,17,'\n      12 dentes'),(7,2,18,'\n         qawsedrfgthyjklaqswdecfvgbhnjmk,l.'),(8,2,18,'\n         sxdcfvgbhnjmkl,'),(9,2,11,'q2w3e4r5t6y7qwsedrfgthyjutgyhuji\n         '),(10,2,14,'o dente 3 estava em um pessimo estado\n         '),(11,2,18,'\n         durante a consulta o paciente nao teve nenhuma contradicao '),(12,2,19,'O paciente teve uma boa cirurgia\n         '),(13,2,17,'\n        bom'),(14,2,20,'Durante a a consulta correu tudo bem, não houve inconvenientes\n         '),(15,2,21,'Durante não houve inconveniente\n         '),(16,2,24,'\n         remvemos o dente 4');
/*!40000 ALTER TABLE `relatorio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-06 11:09:57
