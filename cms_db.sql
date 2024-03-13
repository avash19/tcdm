-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: cms_db
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `checkIn` datetime NOT NULL,
  `breakStart` datetime DEFAULT NULL,
  `breakEnd` datetime DEFAULT NULL,
  `checkOut` datetime DEFAULT NULL,
  `userId` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_userid_foreign` (`userId`),
  CONSTRAINT `attendances_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,'2021-03-12 14:36:47',NULL,NULL,NULL,3,'2021-03-12 14:36:47','2021-03-12 14:36:47'),(2,'2021-03-12 20:42:34','2021-03-12 23:08:35','2021-03-12 23:09:02',NULL,2,'2021-03-12 20:42:34','2021-03-12 23:09:02');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_customers`
--

DROP TABLE IF EXISTS `client_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clientId` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_customers_email_unique` (`email`),
  UNIQUE KEY `client_customers_phonenumber_unique` (`phoneNumber`),
  KEY `client_customers_clientid_foreign` (`clientId`),
  CONSTRAINT `client_customers_clientid_foreign` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_customers`
--

LOCK TABLES `client_customers` WRITE;
/*!40000 ALTER TABLE `client_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebookPageLink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_phonenumber_unique` (`phoneNumber`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Port Lavaca Dodge Jeep Ram Exclusive Sales Event','Port Lavaca Dodge Jeep Ram 1901 Highway 35 South Port Lavaca  TX 77979','portlavacadodgejeepram@gmail.com','3614030664','https://www.facebook.com/Port-Lavaca-Dodge-Jeep-Ram-Exclusive-Sales-Event-101057181957378','active','2021-03-10 16:02:10','2021-03-10 16:02:10'),(2,'Ron Carter Hyundai TX','18100 Gulf Fwy,Friendswood, TX','roncarterhyundaifbcalendar@gmail.com','2819290246','https://business.facebook.com/Ron-Carter-Hyundai-TX-104507004511928','active','2021-03-10 16:11:07','2021-03-10 16:11:07'),(3,'Winnie Dodge Jeep Ram','Winnie Dodge Jeep Ram','winnie@gmail.com','1234567890','Winnie Dodge Jeep Ram','active','2021-03-10 16:17:42','2021-03-10 16:17:42'),(4,'Toyota-of-Boerne-TX','Toyota-of-Boerne-TX','tob@gmail.com','4567891230','https://business.facebook.com/Toyota-of-Boerne-TX-106294951506561','active','2021-03-10 16:20:01','2021-03-10 16:20:01'),(5,'Stanley-Gatesville-Chevrolet-Buick-GMC-TX','Stanley CDJR Gatesville','sdg@gmail.com','4891561230','https://business.facebook.com/Stanley-Gatesville-Chevrolet-Buick-GMC-TX-103300078316500','inactive','2021-03-10 16:26:35','2021-03-10 17:16:08'),(6,'Stanley-Ford-Mcgregor','Stanley-Ford-Mcgregor','sfc@gmail.com','44569852130','https://www.facebook.com/Stanley-Ford-Mcgregor-Holiday-Sales-Event-103958161582014/','active','2021-03-10 16:27:42','2021-03-10 16:27:42'),(7,'Stanley-Ford-Sweetwater-TX','Stanley-Ford-Sweetwater-TX','sfstx@gmail.com','4815792360','https://business.facebook.com/Stanley-Ford-Sweetwater-TX-103289905151704','active','2021-03-10 16:28:25','2021-03-10 16:28:25'),(8,'Stanley-Brownwood-CDJR','Stanley-Brownwood-CDJR','sbcdjr@gmail.com','7845981520','https://business.facebook.com/Stanley-Brownwood-CDJR-Holiday-Sales-Event-108543814441358','active','2021-03-10 16:29:19','2021-03-10 16:29:19'),(9,'Stanley-Direct-Auto-TX','Stanley-Direct-Auto-TX','sdatx@gmail.com','2369854230','https://business.facebook.com/Stanley-Direct-Auto-TX-103499945120735','active','2021-03-10 16:32:56','2021-03-10 16:32:56'),(10,'Stanley-CDJR-Gilmer-TX','Stanley-CDJR-Gilmer-TX','scgtx@gmail.com','5826397450','https://business.facebook.com/Stanley-CDJR-Gilmer-TX-107237471239416','active','2021-03-10 16:33:33','2021-03-10 16:33:33'),(11,'Stanley-Ford-Brownfield-TX','Stanley-Ford-Brownfield-TX','sfb@gmail.com','5689452010','https://business.facebook.com/Stanley-Ford-Brownfield-TX-102507501731536','active','2021-03-10 16:34:08','2021-03-10 16:34:08'),(12,'Lumberton-Kia-NC','Lumberton-Kia-NC-','lknc@gmail.com','45671236920','https://business.facebook.com/Lumberton-Kia-NC-104382671614754','active','2021-03-10 16:40:30','2021-03-10 16:40:30'),(13,'Clear-Lake-Nissan-TX','Clear-Lake-Nissan-TX','clntx@gmail.com','0000000000','https://business.facebook.com/Clear-Lake-Nissan-TX-104326188248538','active','2021-03-10 16:41:08','2021-03-10 16:41:08'),(14,'San-Marcos-Toyota-TX','San-Marcos-Toyota-TX','smttx@gmail.com','1111111111','https://business.facebook.com/San-Marcos-Toyota-TX-116376150492606','active','2021-03-10 16:41:50','2021-03-10 16:41:50'),(15,'Victoria-Dodge-Jeep-Ram-TX','Victoria-Dodge-Jeep-Ram-TX','vdjrtx@gmail.com','2222222222','https://business.facebook.com/Victoria-Dodge-Jeep-Ram-TX-103349554971720','active','2021-03-10 16:43:11','2021-03-10 16:43:11'),(16,'Mike-Calvert-Toyota-Exclusive-Sales-Event','Mike-Calvert-Toyota-Exclusive-Sales-Event','mctese@gmail.com','3333333333','https://business.facebook.com/Mike-Calvert-Toyota-Exclusive-Sales-Event-106588774642572','active','2021-03-10 16:44:04','2021-03-10 16:44:04'),(17,'Sam-Leman-Dodge-Jeep-Ram-Peoria-IL','Sam-Leman-Dodge-Jeep-Ram-Peoria-IL','sldjr@gmail.com','4444444444','https://business.facebook.com/Sam-Leman-Dodge-Jeep-Ram-Peoria-IL-114554760296960','active','2021-03-10 16:54:42','2021-03-10 16:54:42'),(18,'Clear-Lake-Infiniti-TX','Clear-Lake-Infiniti-TX','clitx@gmail.com','5555555555','https://business.facebook.com/Clear-Lake-Infiniti-TX-113726467125293','active','2021-03-10 16:55:15','2021-03-10 16:55:15'),(19,'Nyle maxwell CDJR','NylemaxwellCDJR','nmcdjr@gmail.com','6666666666','https://business.facebook.com/NylemaxwellCDJR','active','2021-03-10 16:55:58','2021-03-10 16:55:58'),(20,'Performance-Dodge-Ram-NJ-','Performance-Dodge-Ram-NJ-','pdrn@gmail.com','6666666660','https://business.facebook.com/Performance-Dodge-Ram-NJ-103898471236924','active','2021-03-10 16:56:50','2021-03-10 16:56:50'),(21,'College-Station-Nissan-TX','College-Station-Nissan-TX','csntx@gmail.com','7777777777','https://business.facebook.com/College-Station-Nissan-TX-101166925364248','active','2021-03-10 16:57:16','2021-03-10 16:57:16'),(22,'Keating-Nissan-TX','Keating-Nissan-TX','kntx@gmail.com','8888888888','https://business.facebook.com/Keating-Nissan-TX-100375248733816','active','2021-03-10 16:57:42','2021-03-10 16:57:42'),(23,'Grapevine-Dodge-Jeep-Ram-TX','Grapevine-Dodge-Jeep-Ram-TX','gdjrtx@gmail.com','9999999999','https://business.facebook.com/Grapevine-Dodge-Jeep-Ram-TX-102363238543510','active','2021-03-10 16:58:10','2021-03-10 16:58:10'),(24,'Stanley-Ford-Pilot-Point-TX','Stanley-Ford-Pilot-Point-TX','sfpp@gmail.com','0000000001','https://business.facebook.com/Stanley-Ford-Pilot-Point-TX-102278558412485','active','2021-03-10 16:58:37','2021-03-10 16:58:37'),(25,'Stanley-Ford-Eastland','Stanley-Ford-Eastland','sfe@gmail.com','0000000002','https://business.facebook.com/Stanley-Ford-Eastland-TX-108584904614809','active','2021-03-10 17:00:08','2021-03-10 17:00:08'),(26,'Stanley-Gatesville-Chevrolet-Buick-GMC-TX','Stanley-Gatesville-Chevrolet-Buick-GMC-TX','sgcb@gmail.com','0000000003','https://business.facebook.com/Stanley-Gatesville-Chevrolet-Buick-GMC-TX-103300078316500','active','2021-03-10 17:00:39','2021-03-10 17:00:39'),(27,'Stanley-Ford-Andrews-TX','Stanley-Ford-Andrews-TX','sfatx@gmail.com','0000000004','https://business.facebook.com/Stanley-Ford-Andrews-TX-106000681367793','active','2021-03-10 17:01:15','2021-03-10 17:01:15');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `messageId` bigint unsigned DEFAULT NULL,
  `commentId` bigint unsigned DEFAULT NULL,
  `calendarSpreadId` bigint unsigned DEFAULT NULL,
  `followUpId` bigint unsigned DEFAULT NULL,
  `clientId` bigint unsigned NOT NULL,
  `messageRemark` text COLLATE utf8mb4_unicode_ci,
  `messageStatus` enum('unassigned','assigned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unassigned',
  `commentRemark` text COLLATE utf8mb4_unicode_ci,
  `commentStatus` enum('unassigned','assigned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unassigned',
  `calendarSpreadRemark` text COLLATE utf8mb4_unicode_ci,
  `calendarSpreadStatus` enum('unassigned','assigned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unassigned',
  `followUpRemark` text COLLATE utf8mb4_unicode_ci,
  `followUpStatus` enum('unassigned','assigned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unassigned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_clientid_foreign` (`clientId`),
  KEY `events_messageid_foreign` (`messageId`),
  KEY `events_commentid_foreign` (`commentId`),
  KEY `events_calendarspreadid_foreign` (`calendarSpreadId`),
  KEY `events_followupid_foreign` (`followUpId`),
  CONSTRAINT `events_calendarspreadid_foreign` FOREIGN KEY (`calendarSpreadId`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `events_clientid_foreign` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `events_commentid_foreign` FOREIGN KEY (`commentId`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `events_followupid_foreign` FOREIGN KEY (`followUpId`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `events_messageid_foreign` FOREIGN KEY (`messageId`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Port Lavaca Dodge Jeep Ram Exclusive Sales Event','2021-03-12','2021-03-27',3,NULL,2,NULL,1,NULL,'assigned',NULL,'unassigned',NULL,'assigned',NULL,'unassigned','2021-03-10 16:04:10','2021-03-13 01:53:36'),(2,'Lumberton-Kia-NC','2021-03-05','2021-03-16',NULL,NULL,NULL,NULL,12,NULL,'unassigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:01:53','2021-03-13 01:54:18'),(3,'Clear-Lake-Nissan-TX','2021-03-05','2021-03-27',2,NULL,NULL,NULL,13,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:02:18','2021-03-13 01:54:19'),(4,'San-Marcos-Toyota-TX','2021-03-07','2021-04-03',2,NULL,NULL,NULL,14,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:02:49','2021-03-13 01:54:20'),(5,'Victoria-Dodge-Jeep-Ram-TX','2021-03-05','2021-03-27',3,2,NULL,NULL,15,NULL,'assigned',NULL,'assigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:03:16','2021-03-13 01:48:56'),(6,'Ron Carter Hyundai TX','2021-03-06','2021-03-15',3,2,NULL,NULL,2,NULL,'assigned',NULL,'assigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:03:35','2021-03-13 01:48:59'),(7,'Mike-Calvert-Toyota-Exclusive-Sales-Event','2021-03-06','2021-03-15',3,2,NULL,NULL,16,NULL,'assigned',NULL,'assigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:04:01','2021-03-13 01:49:01'),(8,'Performance-Dodge-Ram-NJ-','2021-03-01','2021-03-31',2,2,NULL,NULL,20,NULL,'assigned',NULL,'assigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:04:58','2021-03-13 01:49:02'),(9,'Clear-Lake-Infiniti-TX','2021-03-01','2021-03-10',2,NULL,NULL,NULL,18,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:05:45','2021-03-12 17:52:24'),(10,'Nyle maxwell CDJR','2021-03-02','2021-03-11',2,NULL,NULL,NULL,19,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:06:16','2021-03-12 17:52:22'),(11,'Stanley-Gatesville-Chevrolet-Buick-GMC-TX','2021-03-20','2021-03-29',2,NULL,NULL,NULL,5,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:09:22','2021-03-12 17:52:18'),(12,'Stanley-Ford-Mcgregor','2021-03-20','2021-03-29',2,NULL,NULL,NULL,6,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:09:56','2021-03-12 17:52:20'),(13,'Stanley-Brownwood-CDJR','2021-03-20','2021-03-29',2,NULL,NULL,NULL,8,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:10:08','2021-03-12 17:52:25'),(14,'Stanley-Ford-Sweetwater-TX','2021-03-20','2021-03-29',2,NULL,NULL,NULL,7,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:10:20','2021-03-12 17:52:27'),(15,'Stanley-CDJR-Gilmer-TX','2021-03-20','2021-03-29',2,NULL,NULL,NULL,10,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:12:47','2021-03-12 17:52:28'),(16,'Stanley-Direct-Auto-TX','2021-03-20','2021-03-29',2,NULL,NULL,NULL,9,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-10 17:13:03','2021-03-12 17:52:29'),(17,'Mike-Calvert-Toyota-Exclusive-Sales-Event','2021-03-12','2021-03-29',3,2,NULL,NULL,16,NULL,'assigned',NULL,'assigned',NULL,'unassigned',NULL,'unassigned','2021-03-13 01:45:03','2021-03-13 01:49:03'),(18,'Stanley-Gatesville-Chevrolet-Buick-GMC-TX','2021-03-12','2021-03-29',2,NULL,NULL,NULL,26,NULL,'assigned',NULL,'unassigned',NULL,'unassigned',NULL,'unassigned','2021-03-13 01:50:49','2021-03-14 07:06:14');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'{\"startDate\":\"2021-03-12\",\"endDate\":\"2021-03-27\",\"clientId\":\"1\",\"name\":\"Port Lavaca Dodge Jeep Ram Exclusive Sales Event\"}','2021-03-10 16:04:10','2021-03-10 16:04:10'),(2,'{\"startDate\":\"2021-03-05\",\"endDate\":\"2021-03-16\",\"clientId\":\"12\",\"name\":\"Lumberton-Kia-NC\"}','2021-03-10 17:01:53','2021-03-10 17:01:53'),(3,'{\"startDate\":\"2021-03-05\",\"endDate\":\"2021-03-27\",\"clientId\":\"13\",\"name\":\"Clear-Lake-Nissan-TX\"}','2021-03-10 17:02:18','2021-03-10 17:02:18'),(4,'{\"startDate\":\"2021-03-07\",\"endDate\":\"2021-04-03\",\"clientId\":\"14\",\"name\":\"San-Marcos-Toyota-TX\"}','2021-03-10 17:02:49','2021-03-10 17:02:49'),(5,'{\"startDate\":\"2021-03-05\",\"endDate\":\"2021-03-27\",\"clientId\":\"15\",\"name\":\"Victoria-Dodge-Jeep-Ram-TX\"}','2021-03-10 17:03:16','2021-03-10 17:03:16'),(6,'{\"startDate\":\"2021-03-06\",\"endDate\":\"2021-03-15\",\"clientId\":\"2\",\"name\":\"Ron Carter Hyundai TX\"}','2021-03-10 17:03:35','2021-03-10 17:03:35'),(7,'{\"startDate\":\"2021-03-06\",\"endDate\":\"2021-03-15\",\"clientId\":\"16\",\"name\":\"Mike-Calvert-Toyota-Exclusive-Sales-Event\"}','2021-03-10 17:04:01','2021-03-10 17:04:01'),(8,'{\"startDate\":\"2021-03-01\",\"endDate\":\"2021-03-31\",\"clientId\":\"20\",\"name\":\"Performance-Dodge-Ram-NJ-\"}','2021-03-10 17:04:58','2021-03-10 17:04:58'),(9,'{\"startDate\":\"2021-03-01\",\"endDate\":\"2021-03-10\",\"clientId\":\"18\",\"name\":\"Clear-Lake-Infiniti-TX\"}','2021-03-10 17:05:45','2021-03-10 17:05:45'),(10,'{\"startDate\":\"2021-03-02\",\"endDate\":\"2021-03-11\",\"clientId\":\"19\",\"name\":\"Nyle maxwell CDJR\"}','2021-03-10 17:06:16','2021-03-10 17:06:16'),(11,'{\"startDate\":\"2021-03-20\",\"endDate\":\"2021-03-29\",\"clientId\":\"5\",\"name\":\"Stanley CDJR Gatesville\"}','2021-03-10 17:09:22','2021-03-10 17:09:22'),(12,'{\"startDate\":\"2021-03-20\",\"endDate\":\"2021-03-29\",\"clientId\":\"6\",\"name\":\"Stanley-Ford-Mcgregor\"}','2021-03-10 17:09:56','2021-03-10 17:09:56'),(13,'{\"startDate\":\"2021-03-20\",\"endDate\":\"2021-03-29\",\"clientId\":\"8\",\"name\":\"Stanley-Brownwood-CDJR\"}','2021-03-10 17:10:08','2021-03-10 17:10:08'),(14,'{\"startDate\":\"2021-03-20\",\"endDate\":\"2021-03-29\",\"clientId\":\"7\",\"name\":\"Stanley-Ford-Sweetwater-TX\"}','2021-03-10 17:10:20','2021-03-10 17:10:20'),(15,'{\"startDate\":\"2021-03-20\",\"endDate\":\"2021-03-29\",\"clientId\":\"10\",\"name\":\"Stanley-CDJR-Gilmer-TX\"}','2021-03-10 17:12:47','2021-03-10 17:12:47'),(16,'{\"startDate\":\"2021-03-20\",\"endDate\":\"2021-03-29\",\"clientId\":\"9\",\"name\":\"Stanley-Direct-Auto-TX\"}','2021-03-10 17:13:03','2021-03-10 17:13:03'),(17,'[\"User of Id 2 is assigned for message\"]','2021-03-12 17:14:18','2021-03-12 17:14:18'),(18,'[\"User of Id 2 is assigned for message\"]','2021-03-12 17:14:23','2021-03-12 17:14:23'),(19,'[\"User of Id 2 is assigned for message\"]','2021-03-12 17:14:27','2021-03-12 17:14:27'),(20,'[\"User of Id 3 is assigned for message\"]','2021-03-12 17:14:29','2021-03-12 17:14:29'),(21,'[\"User of Id 3 is assigned for message\"]','2021-03-12 17:14:31','2021-03-12 17:14:31'),(22,'[\"User of Id 3 is assigned for message\"]','2021-03-12 17:14:33','2021-03-12 17:14:33'),(23,'[\"User of Id 2 is assigned for message\"]','2021-03-12 17:14:35','2021-03-12 17:14:35'),(24,'[\"User of Id 2 is assigned for comment\"]','2021-03-12 17:14:59','2021-03-12 17:14:59'),(25,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:40:39','2021-03-13 01:40:39'),(26,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:40:59','2021-03-13 01:40:59'),(27,'{\"startDate\":\"2021-03-12\",\"endDate\":\"2021-03-29\",\"clientId\":\"16\",\"name\":\"Mike-Calvert-Toyota-Exclusive-Sales-Event\"}','2021-03-13 01:45:03','2021-03-13 01:45:03'),(28,'[\"User of Id 3 is assigned for message\"]','2021-03-13 01:48:32','2021-03-13 01:48:32'),(29,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:48:52','2021-03-13 01:48:52'),(30,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:48:54','2021-03-13 01:48:54'),(31,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:48:56','2021-03-13 01:48:56'),(32,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:48:57','2021-03-13 01:48:57'),(33,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:48:59','2021-03-13 01:48:59'),(34,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:49:01','2021-03-13 01:49:01'),(35,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:49:02','2021-03-13 01:49:02'),(36,'[\"User of Id 2 is assigned for comment\"]','2021-03-13 01:49:03','2021-03-13 01:49:03'),(37,'{\"startDate\":\"2021-03-12\",\"endDate\":\"2021-03-29\",\"clientId\":\"26\",\"name\":\"Stanley-Gatesville-Chevrolet-Buick-GMC-TX\"}','2021-03-13 01:50:49','2021-03-13 01:50:49'),(38,'[\"User of Id 2 is assigned for message\"]','2021-03-13 01:51:03','2021-03-13 01:51:03'),(39,'[\"Sushil adhikari 2 rejected comment task\"]','2021-03-13 01:53:36','2021-03-13 01:53:36'),(40,'[\"Sushil adhikari 2 rejected message task\"]','2021-03-13 01:54:17','2021-03-13 01:54:17'),(41,'[\"Sushil adhikari 2 rejected comment task\"]','2021-03-13 01:54:18','2021-03-13 01:54:18'),(42,'[\"Sushil adhikari 2 rejected comment task\"]','2021-03-13 01:54:19','2021-03-13 01:54:19'),(43,'[\"Sushil adhikari 2 rejected comment task\"]','2021-03-13 01:54:20','2021-03-13 01:54:20'),(44,'[\"3 is assigned for comment\"]','2021-03-14 06:07:41','2021-03-14 06:07:41');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_02_26_065853_create_clients_table',1),(5,'2021_02_26_090623_create_events_table',1),(6,'2021_02_28_084519_create_attendances_table',1),(7,'2021_02_28_111357_create_client_customers_table',1),(8,'2021_03_02_153931_create_logs_table',1),(9,'2021_03_10_055318_create_office_hours_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_hours`
--

DROP TABLE IF EXISTS `office_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `office_hours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_hours`
--

LOCK TABLES `office_hours` WRITE;
/*!40000 ALTER TABLE `office_hours` DISABLE KEYS */;
INSERT INTO `office_hours` VALUES (1,'13:58:00','18:59:00','2021-03-12 08:14:04','2021-03-12 08:14:04');
/*!40000 ALTER TABLE `office_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','employee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `offDay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `payDay` int DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Avash','avash@admin.com','9861973307','$2y$10$2fI5q3NJAiB7o7ZHs4wQKeo7SKBzQ7XPPH2bQ26eM6vfKZf6Lx0ji','admin',NULL,NULL,NULL,NULL,'active','2024-01-29 15:40:52','2024-03-10 15:40:52');
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-14  7:11:44
