-- MySQL dump 10.13  Distrib 5.7.21, for Linux (i686)
--
-- Host: localhost    Database: ishop2
-- ------------------------------------------------------
-- Server version	5.7.21-1

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

DROP DATABASE IF EXISTS `ishop2`;
CREATE DATABASE `ishop2`;
USE `ishop2`;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

----
---- Dumping data for table `departments`
----
--
--LOCK TABLES `departments` WRITE;
--/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
--INSERT INTO `departments` VALUES (2,'Техотдел'),(3,'Финотдел');
--/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
--UNLOCK TABLES;
--
----
---- Table structure for table `permissions`
----
--
--DROP TABLE IF EXISTS `permissions`;
--/*!40101 SET @saved_cs_client     = @@character_set_client */;
--/*!40101 SET character_set_client = utf8 */;
--CREATE TABLE `permissions` (
--  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
--  `code` varchar(255) DEFAULT NULL,
--  `name` varchar(255) DEFAULT NULL,
--  PRIMARY KEY (`id`),
--  KEY `code` (`code`)
--) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
--/*!40101 SET character_set_client = @saved_cs_client */;
--
----
---- Dumping data for table `permissions`
----
--
--LOCK TABLES `permissions` WRITE;
--/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
--INSERT INTO `permissions` VALUES (1,'user.view_articles','Просмотр статей'),(2,'editor.add_edit','Добавление и редактирование статей'),(3,'moderator.delete_articles','Удаление статей'),(4,'moderator.approve_articles','Одобрение статей'),(5,'moderator.discard_articles','Отклонение статей'),(6,'admin.edit_users','Управление пользователями');
--/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
--UNLOCK TABLES;
--
----
---- Table structure for table `roles_permissions`
----
--
--DROP TABLE IF EXISTS `roles_permissions`;
--/*!40101 SET @saved_cs_client     = @@character_set_client */;
--/*!40101 SET character_set_client = utf8 */;
--CREATE TABLE `roles_permissions` (
--  `role_code` varchar(255) DEFAULT NULL,
--  `permission_code` varchar(255) DEFAULT NULL,
--  KEY `role_code` (`role_code`),
--  KEY `permission_code` (`permission_code`),
--  CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role_code`) REFERENCES `roles` (`code`),
--  CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`permission_code`) REFERENCES `permissions` (`code`)
--) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--/*!40101 SET character_set_client = @saved_cs_client */;
--
----
---- Dumping data for table `roles_permissions`
----
--
--LOCK TABLES `roles_permissions` WRITE;
--/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
--INSERT INTO `roles_permissions` VALUES
--('user','user.view_articles'),
--('editor','user.view_articles'),
--('editor','editor.add_edit'),
--('moderator','user.view_articles'),
--('moderator','moderator.approve_articles'),
--('moderator','moderator.delete_articles'),
--('moderator','moderator.discard_articles'),
--('admin','admin.edit_users'),
--('admin','user.view_articles');
--/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;
--UNLOCK TABLES;
--
----
---- Table structure for table `roles`
----
--
--DROP TABLE IF EXISTS `roles`;
--/*!40101 SET @saved_cs_client     = @@character_set_client */;
--/*!40101 SET character_set_client = utf8 */;
--CREATE TABLE `roles` (
--  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--  `code` varchar(255) DEFAULT NULL,
--  `name` varchar(255) DEFAULT NULL,
--  PRIMARY KEY (`id`),
--  KEY `code` (`code`)
--) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
--/*!40101 SET character_set_client = @saved_cs_client */;
--
----
---- Dumping data for table `roles`
----
--
--LOCK TABLES `roles` WRITE;
--/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
--INSERT INTO `roles` VALUES (1,'user','Пользователь'),(2,'editor','Редактор'),(3,'moderator','Модератор'),(4,'admin','Администратор');
--/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
--UNLOCK TABLES;
--
----
---- Table structure for table `users`
----
--
--DROP TABLE IF EXISTS `users`;
--/*!40101 SET @saved_cs_client     = @@character_set_client */;
--/*!40101 SET character_set_client = utf8 */;
--CREATE TABLE `users` (
--  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
--  `login` varchar(255) DEFAULT NULL,
--  `password` varchar(255) DEFAULT NULL,
--  `email` varchar(255) DEFAULT NULL,
--  `name` varchar(255) DEFAULT NULL,
--  `department_id` int(10) unsigned DEFAULT NULL,
--  `role_id` int(11) unsigned DEFAULT NULL,
--  PRIMARY KEY (`id`),
--  KEY `indexName` (`name`) USING BTREE,
--  KEY `role_id` (`role_id`),
--  KEY `users_ibfk_1` (`department_id`),
--  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
--  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
--) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
--/*!40101 SET character_set_client = @saved_cs_client */;
--
----
---- Dumping data for table `users`
----
--
--LOCK TABLES `users` WRITE;
--/*!40000 ALTER TABLE `users` DISABLE KEYS */;
--INSERT INTO `users` VALUES (2,'petrov','4f356e71899d4e6ac647d2ed22a81dd2',NULL,'Петр Петров',2,1),(3,'sidorov','4f356e71899d4e6ac647d2ed22a81dd2',NULL,'Сидор Сидоров',3,2),(5,'slexan','4f356e71899d4e6ac647d2ed22a81dd2',NULL,'Александров',3,3),(6,'admin','d8578edf8458ce06fbc5bb76a58c5ca4',NULL,'Дмитриев',3,1);
--/*!40000 ALTER TABLE `users` ENABLE KEYS */;
--UNLOCK TABLES;
--
----
---- Table structure for table `articles`
----
--
--DROP TABLE IF EXISTS `articles`;
--/*!40101 SET @saved_cs_client     = @@character_set_client */;
--/*!40101 SET character_set_client = utf8 */;
--CREATE TABLE `articles` (
--  `id` int(11) NOT NULL AUTO_INCREMENT,
--  `title` varchar(120) NOT NULL,
--  `content` text NOT NULL,
--  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--  PRIMARY KEY (`id`),
--  UNIQUE KEY `title` (`title`)
--) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
--/*!40101 SET character_set_client = @saved_cs_client */;
--
----
---- Dumping data for table `articles`
----
--
--LOCK TABLES `articles` WRITE;
--/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
--INSERT INTO `articles` VALUES (1,'Новость 1','Содержание 1','2018-07-30 20:19:46'),(2,'Новость 2','Содержание 2','2018-07-30 20:19:46'),(43,'88jjjj','frjfjyy','2018-09-14 17:32:03'),(44,'NNNNNNNJJNJNJhhhh','KMKMKKKKKKMKKKKKKK','2018-09-11 19:40:44'),(45,'rrrrrrrrrrrrf','eeeeeeeeeee','2018-09-14 17:40:00');
--/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
--UNLOCK TABLES;
--
----
---- Table structure for table `users_roles`
----
--
--DROP TABLE IF EXISTS `users_roles`;
--/*!40101 SET @saved_cs_client     = @@character_set_client */;
--/*!40101 SET character_set_client = utf8 */;
--CREATE TABLE `users_roles` (
--  `user_id` int(11) unsigned DEFAULT NULL,
--  `role_code` varchar(255) DEFAULT NULL,
--  KEY `role_code` (`role_code`),
--  KEY `user_id` (`user_id`),
--  CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`role_code`) REFERENCES `roles` (`code`),
--  CONSTRAINT `users_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
--) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
----
---- Dumping data for table `roles_permissions`
----
--
--LOCK TABLES `users_roles` WRITE;
--/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
--INSERT INTO `users_roles` VALUES
--(2,'editor'),
--(3,'moderator'),
--(5,'editor'),
--(6,'admin'),
--(6,'moderator');
--/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
--UNLOCK TABLES;
--
--
--/*!40101 SET character_set_client = @saved_cs_client */;
--/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
--
--/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
--/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
--/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
--/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
--/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
--/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
--
---- Dump completed on 2018-09-15 22:38:19
