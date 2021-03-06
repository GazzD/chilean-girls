-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: chilean_girls_website
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `admin_user_password_resets`
--

DROP TABLE IF EXISTS `admin_user_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user_password_resets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  `creation_ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('EXPIRED','NEW','USED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `usage_date` datetime NOT NULL,
  `usage_ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_user_password_resets_admin_user_id_foreign` (`admin_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_password_resets`
--

LOCK TABLES `admin_user_password_resets` WRITE;
/*!40000 ALTER TABLE `admin_user_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_roles`
--

DROP TABLE IF EXISTS `admin_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_roles`
--

LOCK TABLES `admin_user_roles` WRITE;
/*!40000 ALTER TABLE `admin_user_roles` DISABLE KEYS */;
INSERT INTO `admin_user_roles` VALUES (1,'Administrador',1,'2017-11-21 00:19:13','2017-11-21 00:19:13');
/*!40000 ALTER TABLE `admin_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_user_role_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_users_admin_user_role_id_foreign` (`admin_user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin@chileangirls.cl',1,'Jordan','D. Sosa','$2y$10$kvETCt3DV0PDsHNBKZplC.CI4Gs1XUxXUkdBZL7KKKexLibVty5cG','123456',1,'2017-11-21 00:19:13','2017-12-12 19:22:21'),(3,'cardozo.anibal@gmail.com',1,'An├¡bal','Cardozo','$2y$10$Nr4D7V6KZ9Njp1Jhz7/mqOkPm5v/CalxPzAv0mK8G2/DKGNU7PSrm','123456',1,'2017-11-29 21:29:51','2017-11-29 21:32:42');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carousel_items`
--

DROP TABLE IF EXISTS `carousel_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousel_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousel_items`
--

LOCK TABLES `carousel_items` WRITE;
/*!40000 ALTER TABLE `carousel_items` DISABLE KEYS */;
INSERT INTO `carousel_items` VALUES (1,1,'uploads/carousel-item/20171129193202_3GpQSm_1.png','https://www.facebook.com/','Imagen principal',1,'_blank','2017-11-29 23:24:46','2017-11-30 00:13:28'),(2,1,'uploads/carousel-item/20171129194059_LOZyDW_3.png','https://www.facebook.com/','Imagen terciaria',3,'_self','2017-11-29 23:32:39','2017-11-29 23:40:59'),(3,1,'uploads/carousel-item/20171129194038_5IJxl6_2.png','https://www.facebook.com/','Imagen secundaria',2,'_blank','2017-11-29 23:35:10','2017-11-29 23:40:46');
/*!40000 ALTER TABLE `carousel_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Profesional',NULL,NULL,NULL),(2,'Amateur',NULL,NULL,NULL),(3,'Cosplay',NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `birth_date` date NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` tinyint(1) NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'1990-05-05','CL','pedro@perez.com',0,'Perez','Pedro',NULL,'uploads/contact\\1-Pedro.jpg','uploads/contact\\1-Pedro.png','uploads/contact\\1-Pedro.jpg','portafolio','2018-01-05 04:15:27','2018-01-05 04:15:27'),(2,'1990-05-05','CL','pedro@perez.com',0,'Perez','Pedro',NULL,'uploads/contact\\2-pedro-1.jpg','uploads/contact\\2-pedro-2.png','uploads/contact\\2-pedro-3.jpg','portafolio','2018-01-05 04:21:06','2018-01-05 04:21:06'),(3,'1990-05-05','CL','pedro@perez.com',0,'Perez','Pedro',NULL,'uploads\\contact\\3-pedro-1.jpg','uploads\\contact\\3-pedro-2.png','uploads\\contact\\3-pedro-3.jpg','portafolio','2018-01-05 04:29:49','2018-01-05 04:29:49'),(4,'1990-05-07','CL','pedro@perez.com',0,'sadasasd','sadsad','sadsadsa',NULL,NULL,NULL,'sadsad','2018-01-05 04:54:42','2018-01-05 04:54:42'),(5,'1990-05-07','CL','pedro@perez.com',0,'sadasasd','sadsad','sadsadsa',NULL,NULL,NULL,'sadsad','2018-01-05 04:56:20','2018-01-05 04:56:20'),(6,'1990-05-07','CL','pedro@perez.com',0,'sadasasd','sadsad','sadsadsa','uploads\\contact\\6-sadsad-1.jpg','uploads\\contact\\6-sadsad-2.jpg','uploads\\contact\\6-sadsad-3.jpg','sadsad','2018-01-05 04:57:13','2018-01-05 04:57:13'),(7,'1990-05-05','CL','sadas@sad.copm',0,'dsad','sdasd','dsasdsa','uploads\\contact\\7-sdasd-1.jpg','uploads\\contact\\7-sdasd-2.jpg','uploads\\contact\\7-sdasd-3.jpg','sdasdsa','2018-01-05 05:18:06','2018-01-05 05:18:06'),(8,'1990-05-05','CL','asdsad@sadsa.com',0,'dsasad','sadsa',NULL,'uploads\\contact\\8-sadsa-1.jpg','uploads\\contact\\8-sadsa-2.jpg','uploads\\contact\\8-sadsa-3.jpg','portafolio','2018-01-05 05:18:40','2018-01-05 05:18:40'),(9,'1990-05-05','CL','pedro@perez.com',0,'Perez','Pedro',NULL,'uploads\\contact\\9-pedro-1.jpg','uploads\\contact\\9-pedro-2.jpg','uploads\\contact\\9-pedro-3.jpg',NULL,'2018-01-05 05:24:48','2018-01-05 05:24:48');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_model_id_foreign` (`model_id`),
  KEY `galleries_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,1,'asd','uploads/gallery/20180107214739_vDJQnx_1016426_512428062199827_2001945608_n.jpg',222.00,'2018-01-08 01:47:39','2018-01-08 01:49:39',1,2);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_04_192613_create_admin_user_password_resets_table',1),(4,'2016_01_04_193144_create_admin_users_table',1),(5,'2016_01_04_193145_create_admin_user_roles_table',1),(7,'2016_01_27_144552_create_carousel_items_table',2),(27,'2017_11_21_135937_create_galleries_table',8),(18,'2017_11_21_133955_create_models_table',4),(26,'2017_11_21_135812_create_videos_table',8),(15,'2017_11_21_140007_create_pictures_table',3),(25,'2018_01_03_140007_create_contacts_table',7),(28,'2018_01_07_205653_create_categories_table',8),(29,'2015_01_07_205653_create_categories_table',9),(30,'2018_01_11_191022_add_fields_to_users_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL,
  `friendly_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,1,'alexandra-oks','alexandra_oks','alexandra.oks','uploads/model/profile/20171214180355_KS9qz3_fotoperfil.png','uploads/model/profile/20171214180355_0AMuPP_modelo3.jpg','uploads/model/profile/20171214180355_RIAhmc_Hello I\'m LilyMai.mp4','Soy una persona sencilla que disfruta mucho de bailar y pasar tiempo con amigos,\r\namo la musica electr├│nica y los tatuajes.','2017-12-06 22:01:55','2017-12-14 22:03:55'),(4,1,'merlina-malina','merlinamalina','Merlina Malina','uploads/model/profile/20171214180557_G2g0U7_fotoperfil.png','uploads/model/profile/20171214180557_Ffrcrq_modelo2.jpg',NULL,'Merlina Malina Alternative Model ? ÔÖÅScorpio ?book lover, ?cigarrettes and good coffee ? #militarsquad #zivity #wizards #gothicgirl #nerdygirl','2017-12-14 22:05:57','2017-12-15 01:10:18'),(5,1,'selena-sensual-bass','dreronayne','Selena Sensual Bass','uploads/model/profile/20171214185205_uXns1r_fotoperfil.png','uploads/model/profile/20171214185205_rXsHZi_modelo4.jpg',NULL,'Dre Ronayne Content Creator ÔûÂ´©Å Makeup Artist ? Cosplayer ? Alt Model ? Internet Addict ? Bassist of @wearebadwolf ?','2017-12-14 22:52:05','2017-12-15 01:10:12'),(6,1,'isa-gallaher-f','isaagallaher','Isa Gallaher F','uploads/model/profile/20171214185606_aN1wfO_fotoperfil.png','uploads/model/profile/20171214185606_zEXX42_modelo5.jpg',NULL,'Dulce despertar','2017-12-14 22:56:06','2017-12-15 01:10:06'),(7,1,'kaslem-maria','majo_sacbaja','Kaslem Mar├¡a','uploads/model/profile/20171214185856_7HbYjC_fotoperfil.png','uploads/model/profile/20171214185856_hoaXoq_modelo8.jpg',NULL,'Focus on the good | The beatles ??','2017-12-14 22:58:56','2017-12-15 01:10:00'),(8,1,'ckata-kong','ckatak0ng','Ckata kong','uploads/model/profile/20171214192156_Mn4FZT_fotoperfil.png','uploads/model/profile/20171214192156_9IkrxO_modelo7.jpg',NULL,'Ckata kong :3 ? 23 a├▒os| ?Traducci├│n ingl├®s-espa├▒ol| ?modelo| ? 33 tattoos ? F E L I Z ?','2017-12-14 23:21:56','2017-12-14 23:21:56');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pictures_gallery_id_foreign` (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (19,1,'uploads/gallery/20180107214739_T3JGGW_5387-disgusting_zps3e003de5.png','20180107214739_T3JGGW_5387-disgusting_zps3e003de5.png',1,'2018-01-08 01:47:39','2018-01-08 01:47:39'),(17,1,'uploads/gallery/20171214193648_hsJ1Px_4.jpg','20171214193648_hsJ1Px_4.jpg',3,'2017-12-14 23:36:48','2017-12-14 23:36:48'),(18,1,'uploads/gallery/20180107214739_7Wsl6g_10-10.jpg','20180107214739_7Wsl6g_10-10.jpg',1,'2018-01-08 01:47:39','2018-01-08 01:47:39'),(15,1,'uploads/gallery/20171214193648_7gdFb5_2.jpg','20171214193648_7gdFb5_2.jpg',3,'2017-12-14 23:36:48','2017-12-14 23:36:48'),(16,1,'uploads/gallery/20171214193648_dqjvOi_3.jpg','20171214193648_dqjvOi_3.jpg',3,'2017-12-14 23:36:48','2017-12-14 23:36:48'),(14,1,'uploads/gallery/20171214193648_1KkdIl_1.jpg','20171214193648_1KkdIl_1.jpg',3,'2017-12-14 23:36:48','2017-12-14 23:36:48');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Pedro','Cardozo','bigtor.cardozo@gmail.com','$2y$10$uiC/pLlywWvm41ynaFJ95.QntwEQ13Q39xBK7dZsCKBeQmDa58.By','hVVhPxlAifHIdRnFYgkDs8iZz4psC4fE5skv7mc6Ms7gH8MUvNLfu2YApSOZ','2018-01-11 23:24:48','2018-01-11 23:24:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `videos_model_id_foreign` (`model_id`),
  KEY `videos_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,1,'sadasd',222.00,'asdasd','uploads/video/20180107215341_02uGjZ_video.webm','2018-01-08 01:53:41','2018-01-08 01:54:00',1,2);
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-12 10:16:24
