-- MySQL dump 10.16  Distrib 10.1.33-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: votesystdb
-- ------------------------------------------------------
-- Server version	10.1.33-MariaDB

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
-- Table structure for table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidat` (
  `id_candidat` int(2) NOT NULL,
  `nume` varchar(30) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `nume_partid` varchar(40) NOT NULL,
  `varsta` int(2) NOT NULL,
  `avere_declarata` bigint(20) DEFAULT NULL,
  `partid_anterior` varchar(50) DEFAULT NULL,
  `studii_absolvite` varchar(150) NOT NULL,
  `slujba_inainte_de_politica` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_candidat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidat`
--

LOCK TABLES `candidat` WRITE;
/*!40000 ALTER TABLE `candidat` DISABLE KEYS */;
INSERT INTO `candidat` VALUES (1,'Zonta','Mihai','Partidul Social Democrat',42,150000,'nu','Universitatea Politehnica Bucuresti, Informatica Industriala','0'),(2,'Toni','Terrario','Alianta Liberalilor si Democratilor',45,50000,'Partidul National Liberal','Universitatea Politehnica Bucuresti, Optometrie','0'),(3,'Bageac','Vasile','Alianta Oamenilor Liberi',52,20500,'nu','Universitatea din Craiova, Matematica','0'),(4,'Morneanu','Andreea','Miscarea Populara',34,10000,'nu','Universitatea de Vest Timisoara, Romana-Engleza','0'),(5,'Parzu','Sergiu','Partidul Comunistilor',60,800,'nu','Universitatea \"Babe Bolyai\" din Cluj, Literaturi Straine','0'),(6,'Gabor ','Kristof','Partidul Civic Maghiar',50,30000,'nu','Universitatea de Medicina Semmelweis din Budapesta','0'),(7,'Mihai','Valica','Partidul Conservator Roman',64,100,'nu','Universitatea Maritima din Constanta, Electromecanica navala','0'),(9,'Cladareanu','Danut','Partidul Furia Meritului',25,500000,'nu','Universitatea \"Lucian Blaga\", Chimie','0'),(10,'Jurnaru','Adelin','Partidul National Liberal',42,25000,'Partidul National Taranesc','Universitatea de Stiinte Agronomice si Medicina Veterinara din Bucuresti, Zootehnie','0'),(12,'Cucernicu','Gigi','Partidul Noii Crestini',48,2500,'nu','Universitatea Valahia din Targoviste, Teologie Ortodoxa','0'),(13,'Necali','Titi','Partidul Noua Dreapta',30,12500,'nu','Universitatea Nationala de Arte Bucuresti, Arte Plastice','0'),(14,'Popa','Ionel','Partidul Romanilor Socialisti',64,500,'Partidul Social Democrat','Universitatea \"Petrol-Gaze\" Ploiesti, Inginerie de zacamant','0'),(15,'Pana','Sevastache','Partidul Rosul Muncitoresc',65,200,'Frontul Salvarii Nationale','Universitatea din Bucuresti, Istorie','0'),(16,'Zohannis','Reinhard','Partidul Sabia Disciplinei',28,50000,'nu','Universitatea din Bucuresti, Matematica','0'),(17,'Lacar','Tica','Partidul Vocea Poporului',39,30000,'nu','Institutul de Studii Europene, Marketing','0'),(18,'Ioloszvan','Hulek','Uniunea Democratica a Maghiarilor',41,20000,'nu','Universitatea \"Babes Bolyai\" din Cluj, Istorie','0'),(19,'Tudor','Dan','Uniunea Democratica Tricolora',50,23000,'nu','Academia Tehnica Militara din Bucuresti, Telecomunicatii','0'),(20,'Racul','Marius','Partidul Rosul Muncitoresc',27,10000,'','Universitatea \"Petrol-Gaze\" Ploiesti, Informatica          ',''),(21,'Menu','Vlad','Partidul Rosul Muncitoresc',38,23000,'','Politehnica          ','');
/*!40000 ALTER TABLE `candidat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `judet`
--

DROP TABLE IF EXISTS `judet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `judet` (
  `nume_judet` varchar(35) NOT NULL,
  `total_votanti` int(8) NOT NULL,
  `pib` int(10) NOT NULL,
  `nivel_imigratie` int(3) NOT NULL,
  `regiune` varchar(35) NOT NULL,
  `partid_anterior` varchar(50) NOT NULL,
  `nivel_coruptie` int(3) NOT NULL,
  PRIMARY KEY (`nume_judet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `judet`
--

LOCK TABLES `judet` WRITE;
/*!40000 ALTER TABLE `judet` DISABLE KEYS */;
INSERT INTO `judet` VALUES ('Alba',2,8435,50,'Transilvania','Partidul National Liberal',54),('Arad',1,8272,30,'Crisana','Partidul National Liberal',32),('Arges',1,7296,42,'Muntenia','Partidul Social Democrat',70),('Bacau',2,5402,100,'Moldova','Partidul Social Democrat',93),('Bihor',1,6851,21,'Crisana','Partidul National Liberal',23),('Bistrita-Nasaud',2,6037,32,'Transilvania','Miscarea Populara',34),('Botosani',1,4171,88,'Moldova','Partidul Social Democrat',80),('Braila',1,5839,60,'Muntenia','Partidul National Liberal',71),('Brasov',1,10239,45,'Transilvania','Alianta Liberalilor si Democratilor',50),('Bucuresti',6,22667,45,'Muntenia','Partidul Social Democrat',98),('Buzau',3,5317,74,'Muntenia','Alianta Liberalilor si Democratilor',67),('Calarasi',2,4879,42,'Muntenia','Partidul Social Democrat',64),('Caras-Severin',1,6192,32,'Banat','Partidul National Liberal',100),('Cluj',1,11050,29,'Transilvania','Partidul National Liberal',38),('Constanta',0,12397,61,'Dobrogea','Partidul National Liberal',55),('Covasna',2,5827,58,'Transilvania','Uniunea Democratica a Maghiarilor',44),('Dambovita',2,5797,45,'Muntenia','Partidul Social Democrat',54),('Dolj',1,6597,80,'Oltenia','Alianta Liberalilor si Democratilor',78),('Galati',2,6155,83,'Moldova','Partidul Social Democrat',73),('Giurgiu',1,5585,79,'Muntenia','Alianta Liberalilor si Democratilor',79),('Gorj',1,7676,84,'Oltenia','Partidul Noua Dreapta',60),('Harghita',0,5849,45,'Transilvania','Partidul National Liberal',51),('Hunedoara',1,6790,41,'Transilvania','Partidul National Liberal',42),('Ialomita',0,5735,34,'Muntenia','Partidul Social Democrat',60),('Iasi',0,6611,94,'Moldova','Partidul Social Democrat',80),('Ilfov',2,10172,32,'Muntenia','Alianta Liberalilor si Democratilor',61),('Maramures',0,6034,90,'Maramures','Partidul National Liberal',100),('Mehedinti',0,4651,73,'Oltenia','Partidul Social Democrat',60),('Mures',0,6778,45,'Transilvania','Partidul National Liberal',20),('Neamt',0,4664,80,'Moldova','Partidul Social Democrat',54),('Olt',0,5308,64,'Oltenia','Alianta Liberalilor si Democratilor',81),('Prahova',2,10826,63,'Muntenia','Partidul Social Democrat',49),('Salaj',0,6293,34,'Transilvania','Partidul Social Democrat',40),('Satu Mare',0,5921,20,'Maramures','Partidul Social Democrat',38),('Sibiu',0,8848,24,'Transilvania','Partidul National Liberal',12),('Suceava',0,4885,100,'Moldova','Partidul Social Democrat',80),('Timis',0,10802,14,'Banat','Partidul National Liberal',9),('Tulcea',0,6404,69,'Dobrogea','Alianta Liberalilor si Democratilor',67),('Valcea',0,6076,58,'Oltenia','Partidul Social Democrat',55),('Vaslui',0,3884,98,'Moldova','Partidul Social Democrat',90),('Vrancea',0,5174,73,'Moldova','Partidul Social Democrat',62);
/*!40000 ALTER TABLE `judet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partid`
--

DROP TABLE IF EXISTS `partid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partid` (
  `nume_partid` varchar(40) NOT NULL,
  `membri` int(8) NOT NULL,
  `presedinte` varchar(60) NOT NULL,
  `data_infiintare` date DEFAULT NULL,
  `ultimul_procent` int(2) NOT NULL,
  `victorii_totale` int(2) NOT NULL,
  `ideologie` varchar(50) NOT NULL,
  PRIMARY KEY (`nume_partid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partid`
--

LOCK TABLES `partid` WRITE;
/*!40000 ALTER TABLE `partid` DISABLE KEYS */;
INSERT INTO `partid` VALUES ('Alianta Liberalilor si Democratilor',90231,'Cruceru Silvia','0000-00-00',7,1,'centru-dreapta'),('Alianta Oamenilor Liberi',23883,'Floreac Bogdan','0000-00-00',0,0,'centru-dreapta'),('Miscarea Populara',200123,'Marinaru Tudor','0000-00-00',2,0,'centru'),('Partidul Civic Maghiar',20193,'Arpad Hyulani','0000-00-00',0,0,'centru'),('Partidul Comunistilor',15023,'Taler Ion','0000-00-00',0,0,'extrema-stanga'),('Partidul Conservator Roman',12003,'Tania Vladu','0000-00-00',0,0,'centru-dreapta'),('Partidul Ecologic Roman',30231,'Creanta Magda','0000-00-00',1,0,'centru'),('Partidul Furia Meritului',30213,'Vladescu Vlad','0000-00-00',10,0,'extrema-dreapta'),('Partidul National Liberal',483129,'Antoniu Sevastopol','0000-00-00',30,5,'centru-dreapta'),('Partidul National Taranesc',100324,'Ion Vasiliu','0000-00-00',5,1,'centru'),('Partidul Noii Crestini',20109,'Rares Monica','0000-00-00',0,0,'centru'),('Partidul Noua Dreapta',80324,'Alunaru Gheorghe','0000-00-00',3,0,'extrema-dreapta'),('Partidul Romanilor Socialisti',12893,'Sergey Pavuskin','0000-00-00',1,0,'extrema-stanga'),('Partidul Rosul Muncitoresc',23923,'Stan Laurentiu','0000-00-00',2,0,'extrema-stanga'),('Partidul Sabia Disciplinei',8128,'Wylhemme Marius','0000-00-00',0,0,'extrema-dreapta'),('Partidul Social Democrat',509213,'Dracnea Marius','0000-00-00',39,4,'centru-stanga'),('Partidul Vocea Poporului',10381,'Mecincopshi Tudorica','0000-00-00',0,0,'centru'),('Uniunea Democratica a Maghiarilor',50128,'Kelemen Szilagy','0000-00-00',3,0,'centru-dreapta'),('Uniunea Democratica Tricolora',12123,'Albu Sagaszin','0000-00-00',1,0,'centru'),('Uniunea Salvati Romania',45923,'Vadu Traian','0000-00-00',1,0,'centru-dreapta');
/*!40000 ALTER TABLE `partid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votant`
--

DROP TABLE IF EXISTS `votant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votant` (
  `id_votant` bigint(30) NOT NULL AUTO_INCREMENT,
  `nume` varchar(30) NOT NULL,
  `prenume` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `varsta` int(3) DEFAULT NULL,
  `educatie` varchar(1) DEFAULT NULL,
  `venit_lunar` varchar(1) DEFAULT NULL,
  `casatorit` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_votant`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votant`
--

LOCK TABLES `votant` WRITE;
/*!40000 ALTER TABLE `votant` DISABLE KEYS */;
INSERT INTO `votant` VALUES (1,'','','georgesetelescu@yahoo.com','',34,'0','1','3'),(2,'','','marinelaskoompy@yahoo.com','',20,'0','2','-1'),(3,'','','stanlaurentiu@gmail.com','',40,'1','3','2'),(4,'','','tuditherudi@badmonkey.com','',18,'0','1','-1'),(5,'','','raduseletescui@yahoo.com','',70,'0','1','1'),(6,'','','zarafanalways@yahoo.com','',18,'0','1','-1'),(7,'','','mariusiksik93@yahoo.com','',24,'1','2','-1'),(8,'','','manankchips@zoho.com','',18,'0','1','-1'),(9,'','','raulanton@mail.com','',50,'0','1','1'),(10,'','','raulanton@speaker.com','',45,'0','2','0'),(11,'','','valdisparki@accountant.com','',40,'0','2','-1'),(12,'','','rodi.moni.lav@ymail.com','',28,'1','3','2'),(13,'','','usermonster@mail.com','',38,'0','5','2'),(14,'','','monae.94@ymail.com','',48,'0','1','0'),(15,'','','zorbaturculyo@yahoo.com','',50,'0','1','2'),(16,'','','asdoxzfly@yahoo.com','',23,'0','2','0'),(17,'','','iubescursii@yahoo.com','',29,'0','1','3'),(18,'','','splendidbestialmagic@yahoo.com','',38,'0','1','0'),(19,'','','iisusputernicul@protestant.com','',28,'1','3','0'),(20,'','','sweetanda90@yahoo.com','',20,'1','1','0'),(21,'','','sadu.user@programmer.uk','',28,'1','3','0'),(22,'','','tili_bili_tiristul@yahoo.com','',35,'0','2','6'),(23,'','','stefania_beautystar@yahoo.com','',28,'0','2','1'),(24,'','','hannafontana93@yahoo.com','',23,'0','1','-1'),(25,'','','imailtudor@vladi.com','',33,'0','1','1'),(26,'','','torbea.marius@yahoo.com','',30,'0','3','1'),(27,'','','anatonellasweet@yahoo.com','',18,'0','1','2'),(28,'','','maryaana94@yahoo.com','',24,'0','1','0'),(29,'','','sebi.thegodfather@gmail.com','',44,'1','2','1'),(30,'','','sahmatantoniu@gmail.com','',58,'1','1','1'),(31,'','','maryadesk.yop@gmail.com','',25,'1','1','0'),(32,'Vladi','Zaho','z.vladi@mail.com','',33,'0','0','-1'),(33,'Coriand','Zaharia','coriandzaharia@yahoo.com','',50,'1','1','1'),(34,'','','sweetanda90@yahoo.com','',0,'0','0','-1'),(35,'','','sweetanda90@yahoo.com','',0,'0','0','-1'),(36,'Zahanu','Tudora','z.tudora@yahoo.com','',30,'0','0','2'),(37,'Bercea','Marilena','bmarilena@zoho.com','',28,'0','0','4'),(38,'','','','',0,'0','0','-1'),(39,'Svesta','Maria','s.maria@yahoo.com','$2y$10$or3wV/ohjX8DfCbi4ZCHZOA5ceruVW.X/72Ao8d03n7',23,'0','0','-1'),(40,'','','','$2y$10$ffql1CueZQkAtjioEEFzUuu7goRDzkrsmeTMyiONnaY',0,'0','0','-1'),(41,'Serbea','Daniela','s.daniela@yahoo.com','$2y$10$Zd8wyjs8.9ldNy7Jcs8MI.I.noO6DEu558l.hyJkmRS',29,'1','1','1'),(42,'Unel','Vasilica','u.vasilica@yahoo.com','$2y$10$SArE5A3XifYuB7lqB67T/u9GYZw3bEOPuyzBxEpsRFU',39,'0','0','4'),(43,'Leontin','Marinela','l.marinela@yahoo.com','$2y$10$or5koF5j0JpTwMo40AVeneOEMiCxRYKpVysajxkWADn',21,'0','0','4'),(44,'Luca','Tudor','l.tudor@yahoo.com','$2y$10$RSqkapRgWIJHWR99zxw7LumLWxO0rOmaMovjrmj237H',73,'0','0','2'),(45,'Filofte','Laura','f.laura@yahoo.com','$2y$10$toWmh5E42UPSMsr5X3EAje4vIMLPKXyyyJrXuqyrrAoJn/78ao8/q',28,'1','1','0'),(46,'Hugaly','Tonia','h.tunia@yahoo.com','$2y$10$Keuh4Q7IiVOJV7.NcSSww.iiibSdmtxsQN.0L1/iQID.b/W6gJJgm',30,'0','0','-1'),(47,'Antonache','Marius','a.marius@yahoo.com','12345',32,'0','2','3'),(48,'Lagar','Leontin','l.lagar@yahoo.com','$2y$10$t266btMhFfAqBys66ZvYHuVDq/gAfohcg44DD.Lk1xfhHlNka7vUW',37,'0','0','2'),(49,'Toma','Alexandra','a.toma@yahoo.com','$2y$10$yRrIK/3HgMjqQub/LMFJ2.KICihqg0QuKN/1K05rPXYrdad6DRbOq',19,'0','0','-1'),(50,'Zacu','Relu','r.zacu@yahoo.com','$2y$10$B18HUJmDaeFjlCNMHQiFpOp4S8Wfu92F8UP0p/mGp4nZ1d9/WSi2m',50,'1','1','1'),(51,'Administrator','Administrator','administrator@vot.ro','$2y$10$GjWMY5WDwBe3cKqAaseBgesGFlNXFWj1tp5k9kbB9xPBkjbcZRTui',99,'1','1','1'),(52,'Vladu','Maria','v.maria@mail.com','$2y$10$iHyctZPszhDczIR8Ya7SSeliKQ.d3sdLqd28vepoPUt31LfmFBrgG',29,'1','1','2'),(53,'Gheorghe','Monica ','ghmonica@mail.com','$2y$10$QWeR8xoaJKAQOBK32vmYXuYRWDqLfiSuSt5XyN7bml24iNATYb6ii',21,'1','1','2'),(54,'Cors','Vaduca','c.vaduca@yahoo.com','$2y$10$EXMgRW6vufM1Wg5VC.v42.NuxV7BE5eRe/uaDYKJuMgluByscwbiO',58,'0','0','1');
/*!40000 ALTER TABLE `votant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voturi`
--

DROP TABLE IF EXISTS `voturi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voturi` (
  `id_votant` bigint(30) NOT NULL,
  `id_candidat` int(2) NOT NULL,
  `nume_partid` varchar(40) NOT NULL,
  `nume_judet` varchar(35) NOT NULL,
  `timp_vot` time NOT NULL,
  `data_vot` date NOT NULL,
  `ip` varchar(30) NOT NULL,
  `sistem_operare` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_votant`),
  KEY `id_candidat` (`id_candidat`),
  KEY `nume_partid` (`nume_partid`),
  KEY `nume_judet` (`nume_judet`),
  CONSTRAINT `voturi_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`),
  CONSTRAINT `voturi_ibfk_2` FOREIGN KEY (`nume_partid`) REFERENCES `partid` (`nume_partid`),
  CONSTRAINT `voturi_ibfk_4` FOREIGN KEY (`id_votant`) REFERENCES `votant` (`id_votant`),
  CONSTRAINT `voturi_ibfk_5` FOREIGN KEY (`nume_judet`) REFERENCES `judet` (`nume_judet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voturi`
--

LOCK TABLES `voturi` WRITE;
/*!40000 ALTER TABLE `voturi` DISABLE KEYS */;
INSERT INTO `voturi` VALUES (1,1,'Partidul Social Democrat','Prahova','08:32:23','2021-10-20','99.32.17.73','Android'),(2,16,'Partidul Sabia Disciplinei','Prahova','09:22:23','2022-10-20','99.33.18.73','Linux'),(3,19,'Uniunea Democratica Tricolora','Ilfov','19:32:23','2020-10-20','99.32.17.73','Android'),(4,3,'Alianta Oamenilor Liberi','Galati','08:30:23','2020-10-20','60.32.17.73','Windows'),(5,1,'Partidul Social Democrat','Alba','08:32:23','2021-10-20','99.33.17.73','Android'),(6,1,'Partidul Social Democrat','Arad','14:32:23','2021-10-20','99.33.17.73','Android'),(7,1,'Partidul Social Democrat','Arges','14:32:23','2021-10-20','14.33.17.73','Linux'),(8,1,'Partidul Social Democrat','Bacau','16:32:23','2021-10-20','14.33.17.73','Linux'),(9,1,'Partidul Social Democrat','Bihor','16:38:23','2021-10-20','14.33.18.73','Linux'),(10,1,'Partidul Social Democrat','Bistrita-Nasaud','18:38:23','2021-10-20','14.33.18.73','Windows'),(11,10,'Partidul National Liberal','Bistrita-Nasaud','18:39:23','2020-10-20','14.33.19.73','Windows'),(12,10,'Partidul National Liberal','Botosani','18:39:28','2020-10-20','70.33.19.73','Windows'),(13,10,'Partidul National Liberal','Braila','12:39:28','2020-10-20','70.33.79.73','Windows'),(14,10,'Partidul National Liberal','Brasov','11:39:28','2020-10-20','70.33.79.73','Windows'),(15,10,'Partidul National Liberal','Bucuresti','13:39:28','2020-10-20','70.33.29.73','Windows'),(16,10,'Partidul National Liberal','Buzau','13:39:29','2020-10-20','70.33.29.73','Linux'),(17,10,'Partidul National Liberal','Calarasi','13:19:29','2020-10-20','53.33.29.73','Android'),(18,9,'Partidul Furia Meritului','Calarasi','13:19:29','2020-10-20','53.93.29.73','Android'),(19,9,'Partidul Furia Meritului','Caras-Severin','23:19:29','2020-10-20','88.93.29.73','Android'),(20,9,'Partidul Furia Meritului','Cluj','23:19:29','2021-10-20','80.93.29.73','Android'),(21,13,'Partidul Noua Dreapta','Dolj','11:02:23','2021-10-20','50.32.70.73','Android'),(22,13,'Partidul Noua Dreapta','Galati','11:38:23','2021-10-20','47.32.70.73','Windows'),(23,13,'Partidul Noua Dreapta','Giurgiu','11:02:59','2021-10-20','33.32.70.73','Windows'),(24,14,'Partidul Romanilor Socialisti','Hunedoara','14:22:23','2021-10-20','44.32.72.73','Windows'),(25,18,'Uniunea Democratica a Maghiarilor','Covasna','10:02:23','2020-10-20','50.33.70.73','Android'),(26,13,'Partidul Ecologic Roman','Bucuresti','23:02:23','2020-10-20','55.32.70.73','Android'),(27,5,'Partidul Comunistilor','Bucuresti','23:02:23','2020-10-20','55.33.70.73','Android'),(28,1,'Partidul Social Democrat','Bucuresti','23:04:23','2020-10-20','22.30.63.73','Windows'),(29,15,'Partidul Rosul Muncitoresc','Bucuresti','13:08:23','2020-10-20','22.83.63.71','Windows'),(30,17,'Partidul Vocea Poporului','Bucuresti','13:08:23','2020-10-20','22.83.63.71','Windows'),(31,1,'Partidul Social Democrat','Ilfov','15:02:23','2021-10-20','34.32.70.73','Android'),(45,1,'Alianta Liberalilor si Democratilor','Alba','11:10:35','2018-05-03','127.0.0.1','Linux x86_64'),(46,18,'Partidul Civic Maghiar','Covasna','11:49:01','2018-05-03','127.0.0.1','Linux x86_64'),(48,1,'Partidul Social Democrat','Gorj','12:57:44','2018-05-06','127.0.0.1','Linux x86_64'),(49,1,'Partidul Social Democrat','Bacau','15:51:21','2018-05-06','127.0.0.1','Linux x86_64'),(53,2,'Partidul Sabia Disciplinei','Buzau','17:15:11','2018-05-18','127.0.0.1','Linux x86_64'),(54,1,'Partidul Social Democrat','Dambovita','18:19:23','2018-05-18','127.0.0.1','Linux x86_64');
/*!40000 ALTER TABLE `voturi` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER voturi_after_insert AFTER INSERT ON voturi FOR EACH ROW BEGIN UPDATE judet SET total_votanti=total_votanti+1 WHERE nume_judet=NEW.nume_judet; END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-18 19:37:31
