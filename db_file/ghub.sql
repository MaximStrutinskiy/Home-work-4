-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: ghub_db
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

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
-- Table structure for table `chair`
--

DROP TABLE IF EXISTS `chair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chair` (
  `id_chair` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_university` int(11) NOT NULL,
  PRIMARY KEY (`id_chair`),
  KEY `id_university` (`id_university`),
  CONSTRAINT `chair_ibfk_1` FOREIGN KEY (`id_university`) REFERENCES `university` (`id_university`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chair`
--

LOCK TABLES `chair` WRITE;
/*!40000 ALTER TABLE `chair` DISABLE KEYS */;
INSERT INTO `chair` VALUES (1,'Advanced PHP',1),(2,'Javascript',1),(3,'Ruby on Rails',1);
/*!40000 ALTER TABLE `chair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discipline`
--

DROP TABLE IF EXISTS `discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discipline` (
  `id_discipline` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_chair` int(11) NOT NULL,
  PRIMARY KEY (`id_discipline`),
  KEY `id_chair` (`id_chair`),
  CONSTRAINT `discipline_ibfk_1` FOREIGN KEY (`id_chair`) REFERENCES `chair` (`id_chair`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discipline`
--

LOCK TABLES `discipline` WRITE;
/*!40000 ALTER TABLE `discipline` DISABLE KEYS */;
INSERT INTO `discipline` VALUES (1,'PHP OOP',1),(2,'PHP MySQL',1),(3,'JavaScript - Base',2),(4,'RoR-Base',3),(5,'PHP MVC',1),(6,'PHP CMS',1);
/*!40000 ALTER TABLE `discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discipline_teacher`
--

DROP TABLE IF EXISTS `discipline_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discipline_teacher` (
  `id_discipline_teacher` int(11) NOT NULL AUTO_INCREMENT,
  `id_discipline` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  PRIMARY KEY (`id_discipline_teacher`),
  KEY `id_discipline` (`id_discipline`),
  KEY `id_teacher` (`id_teacher`),
  CONSTRAINT `discipline_teacher_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`),
  CONSTRAINT `discipline_teacher_ibfk_2` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id_teacher`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discipline_teacher`
--

LOCK TABLES `discipline_teacher` WRITE;
/*!40000 ALTER TABLE `discipline_teacher` DISABLE KEYS */;
INSERT INTO `discipline_teacher` VALUES (1,1,3),(2,1,2),(3,2,1),(4,3,5),(5,4,6),(6,5,4),(7,5,1),(8,6,4);
/*!40000 ALTER TABLE `discipline_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homework`
--

DROP TABLE IF EXISTS `homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homework` (
  `id_homework` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_discipline` int(11) NOT NULL,
  PRIMARY KEY (`id_homework`),
  KEY `id_discipline` (`id_discipline`),
  CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homework`
--

LOCK TABLES `homework` WRITE;
/*!40000 ALTER TABLE `homework` DISABLE KEYS */;
INSERT INTO `homework` VALUES (1,'PHP OOP - base',1),(2,'Creeate DB in MySQL',2);
/*!40000 ALTER TABLE `homework` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id_student` int(11) NOT NULL AUTO_INCREMENT,
  `firsst_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `id_discipline` int(11) NOT NULL,
  PRIMARY KEY (`id_student`),
  KEY `id_discipline` (`id_discipline`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_homework`
--

DROP TABLE IF EXISTS `student_homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_homework` (
  `id_student_homework` int(11) NOT NULL AUTO_INCREMENT,
  `id_student` int(11) NOT NULL,
  `id_homework` int(11) NOT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_student_homework`),
  KEY `id_student` (`id_student`),
  KEY `id_homework` (`id_homework`),
  CONSTRAINT `student_homework_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  CONSTRAINT `student_homework_ibfk_2` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id_homework`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_homework`
--

LOCK TABLES `student_homework` WRITE;
/*!40000 ALTER TABLE `student_homework` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_homework` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id_teacher` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `id_chair` int(11) NOT NULL,
  PRIMARY KEY (`id_teacher`),
  KEY `id_chair` (`id_chair`),
  CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id_chair`) REFERENCES `chair` (`id_chair`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'Yuriy ','Tarnavskiy',1),(2,'Olexander','Moshta',1),(3,'Dmitriy','Chabanenko',1),(4,'Sergey','Polishuk',1),(5,'Sergey','Kluchnik',2),(6,'Alex','Galushka',3);
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `university` (
  `id_university` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `site` varchar(45) NOT NULL,
  PRIMARY KEY (`id_university`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `university`
--

LOCK TABLES `university` WRITE;
/*!40000 ALTER TABLE `university` DISABLE KEYS */;
INSERT INTO `university` VALUES (1,'GeekHub','Cherkasi','www.geekhub.ck.ua');
/*!40000 ALTER TABLE `university` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-05 19:26:08
