-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost:3310	Database: pollen_plus
-- ------------------------------------------------------
-- Server version 	5.5.5-10.3.14-MariaDB-log
-- Date: Mon, 20 May 2019 16:38:51 +0200

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
-- Table structure for table `customers`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `siteweb` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `siteweb` (`siteweb`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `customers` VALUES (3,'Particulier','Louis Blanc','aurelie.lelievre@girard.com','+33 (0)1 79 72 95 22','Lelievre','Tokelau','457, rue de Marin\n02901 Pages-sur-Normand',NULL,'20','2019-04-21 12:39:12','2019-04-24 10:48:12'),(7,'Particulier','François-Théophile Guillon','francois.oceane@lagarde.com','0155885908','MarchalVille','Réunion (La)','impasse de Descamps\n78 998 Diallo',NULL,'20','2019-04-21 12:39:12','2019-04-24 10:48:14'),(8,'Particulier','Adélaïde Lucas','michelle10@voila.fr','09 39 33 92 45','Henry-les-Bains','Argentine','rue Garcia\n08220 Navarro',NULL,'20','2019-04-21 12:39:12','2019-04-24 10:48:17'),(11,'Particulier','Alphonse-Christophe Delmas','gregoire.berger@ifrance.com','+33 8 23 74 39 91','Laportedan','Israël','9, rue Valérie Bruneau\n86609 Mahe',NULL,'20','2019-04-21 12:39:12','2019-04-24 10:48:20'),(13,'Compagnie','Pollen Plus','pollenplus228@gmail.com','92328454','Lomé','TOGO','Lome-TOGO','pollen-plus.net','10','2019-04-21 14:28:39','2019-04-21 14:28:39'),(14,'Particulier','Synergie d\'Action Culturel','admin@localhost.com','93761527','Lomé','TOGO','Lome-TOGO','synac.org','10','2019-04-24 10:48:05','2019-04-24 10:48:05');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `databases`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `databases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fichier` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `databases`
--

LOCK TABLES `databases` WRITE;
/*!40000 ALTER TABLE `databases` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `databases` VALUES (1,'data24-04-2019','2019-04-24 12:05:17','2019-04-24 12:05:17');
/*!40000 ALTER TABLE `databases` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `invoices`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_id` (`customers_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `invoices` VALUES (1,13,1,'92328454','T-Money','0','2019-04-22 13:36:16','2019-04-22 13:36:16');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `phinxlog`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `phinxlog` VALUES (20181120102438,'CreateUsersTable','2019-04-21 12:38:13','2019-04-21 12:38:14',0),(20190110233937,'CustomersTable','2019-04-21 12:38:14','2019-04-21 12:38:14',0),(20190112222810,'ProjectsTable','2019-04-21 12:38:14','2019-04-21 12:38:15',0),(20190118182916,'MembersProjectsTable','2019-04-21 12:38:15','2019-04-21 12:38:17',0),(20190129235416,'InvoiceTable','2019-04-21 12:38:17','2019-04-21 12:38:17',0),(20190205161656,'ProductsTable','2019-04-21 12:38:18','2019-04-21 12:38:19',0),(20190220203137,'RolesTable','2019-04-21 12:38:19','2019-04-21 12:38:19',0),(20190413224451,'CreateDatabaseTable','2019-04-21 12:38:20','2019-04-21 12:38:20',0);
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `products`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `invoices_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_id` (`invoices_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `products` VALUES (1,'Serveur + nom de domaine',1,'60000','Le Nom de domaine et le serveur serviront  pour l\'application d\'administration de Pollen Plus et pour le Projet Cres (community of Restaurant)',1,'2019-04-22 13:38:39','2019-04-22 13:38:39'),(2,'Main d\'oeuvre',3,'0','elle est a 0 car le projet Pollen plus et Cres nous appartient a nous meme...',1,'2019-04-22 13:39:39','2019-04-22 13:39:39'),(3,'Hebergement',2,'0','elle est a 0 car le projet Pollen plus et Cres nous appartient a nous meme...',1,'2019-04-22 13:40:07','2019-04-22 13:40:07');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `projects`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `budget` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime NOT NULL,
  `start` tinyint(1) NOT NULL DEFAULT 0,
  `finish` tinyint(1) NOT NULL DEFAULT 0,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '10',
  `month` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `projects` VALUES (3,'Cres ','Multiplatform','100000','Raw denim you probably haven\'t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.','2019-01-01 12:00:00','2019-05-30 12:00:00',1,0,13,'10','Jan','2019-04-21 14:30:19','2019-04-25 14:58:08'),(4,'Site de Rencontre ','Developpement Web','100000','Un site de Rencontre pour les personnes du troisieme age les permettres de se retrouver et de se donner une seconde chance dans la vie','2019-06-10 12:00:00','2019-07-31 12:00:00',0,0,13,'20','Jun','2019-04-22 13:44:15','2019-04-25 14:55:51'),(5,'American Gods','Developpement Web','100000','wdgsfdhfjgilomomdg','2019-04-26 12:00:00','2019-05-10 12:00:00',0,0,3,'20','Apr','2019-04-22 20:08:55','2019-04-24 10:35:33'),(6,'marvel','Developpement Web','100000','cvdfgdjgll  ;kluimom fhdjd kyuoyiilgndghs ','2019-04-13 12:00:00','2019-04-30 12:00:00',0,0,8,'20','Apr','2019-04-22 20:10:33','2019-04-24 10:35:27'),(7,'Synergie d\'Action Culturel','Developpement Web','10','site web Frontend et backend pour l\'association SAC (Synergie d\'Action Culturel)','2019-04-24 11:00:00','2019-05-10 12:00:00',1,0,14,'10','Apr','2019-04-24 10:52:42','2019-04-24 10:52:54');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `projects_users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `projects_id` (`projects_id`),
  CONSTRAINT `projects_users_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_users_ibfk_2` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_users`
--

LOCK TABLES `projects_users` WRITE;
/*!40000 ALTER TABLE `projects_users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `projects_users` VALUES (7,1,3),(8,2,3),(9,1,4),(10,2,4),(11,1,5),(12,1,6),(13,3,6),(14,1,7);
/*!40000 ALTER TABLE `projects_users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `roles`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `roles` VALUES (1,'admin',1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `work` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Stephane','Piou Hassan','Masculin','piouhassan@gmail.com','92363533','admin','Developpeur multiplateforme','38159062b0d4b13fa105e280cdd89c980705c691','copy_wherethelove.jpg','10','2019-04-21 12:39:12','2019-05-20 09:42:34'),(2,'Michel','Michel Akpabla','Masculin','mawulice@gmail.com','+228 98647306','user','Charger de la communication','2c7f9fd20fbeb41ce8894ec4653d66fa7f3b6e1a',NULL,'10','2019-04-21 12:39:12','2019-04-24 10:36:14'),(3,'Grafikart','Johnatan Boyer','Masculin','grafikart@contact.com','98647306123','user','Developpeur PhP','2c7f9fd20fbeb41ce8894ec4653d66fa7f3b6e1a',NULL,'10','2019-04-21 12:39:12',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 20 May 2019 16:38:51 +0200
