/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.5.34 : Database - sisevaldoc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`sisevaldoc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sisevaldoc`;

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `groups` */

LOCK TABLES `groups` WRITE;

insert  into `groups`(`id`,`name`,`url`,`title`,`subtitle`,`description`,`permissions`,`created_at`,`updated_at`) values (1,'Docente','alumno','SISEVALDOC para Alumnos','Registre sus cursos, alumnos y complete su matriz de evaluación.','Commodo id natoque malesuada sollicitudin elit suscipit. Curae suspendisse mauris posuere accumsan massa posuere lacus convallis tellus interdum. Amet nullam fringilla nibh nulla convallis ut venenatis purus sit arcu sociis. Nunc fermentum adipiscing tempor cursus nascetur adipiscing adipiscing. Primis aliquam mus lacinia lobortis phasellus suscipit. Fermentum lobortis non tristique ante proin sociis accumsan lobortis. Auctor etiam porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum integer purus sapien. Nibh eleifend nulla nascetur pharetra commodo mi augue interdum tellus. Ornare cursus augue feugiat sodales velit lorem. Semper elementum ullamcorper lacinia natoque aenean scelerisque.',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Alumno','docente','SISEVALDOC para Docentes','Realiza la evaluación de tus docentes.','Commodo id natoque malesuada sollicitudin elit suscipit. Curae suspendisse mauris posuere accumsan massa posuere lacus convallis tellus interdum. Amet nullam fringilla nibh nulla convallis ut venenatis purus sit arcu sociis. Nunc fermentum adipiscing tempor cursus nascetur adipiscing adipiscing. Primis aliquam mus lacinia lobortis phasellus suscipit. Fermentum lobortis non tristique ante proin sociis accumsan lobortis. Auctor etiam porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum integer purus sapien. Nibh eleifend nulla nascetur pharetra commodo mi augue interdum tellus. Ornare cursus augue feugiat sodales velit lorem. Semper elementum ullamcorper lacinia natoque aenean scelerisque.',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Jefe de Dpto','jefedpto','SISEVALDOC para Jefes de Deparamento','Commodo id natoque malesuada sollicitudin elit suscipit','Commodo id natoque malesuada sollicitudin elit suscipit. Curae suspendisse mauris posuere accumsan massa posuere lacus convallis tellus interdum. Amet nullam fringilla nibh nulla convallis ut venenatis purus sit arcu sociis. Nunc fermentum adipiscing tempor cursus nascetur adipiscing adipiscing. Primis aliquam mus lacinia lobortis phasellus suscipit. Fermentum lobortis non tristique ante proin sociis accumsan lobortis. Auctor etiam porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum integer purus sapien. Nibh eleifend nulla nascetur pharetra commodo mi augue interdum tellus. Ornare cursus augue feugiat sodales velit lorem. Semper elementum ullamcorper lacinia natoque aenean scelerisque.',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Administrador','administrador','SISEVALDOC para Administradores','Commodo id natoque malesuada sollicitudin elit suscipit','Commodo id natoque malesuada sollicitudin elit suscipit. Curae suspendisse mauris posuere accumsan massa posuere lacus convallis tellus interdum. Amet nullam fringilla nibh nulla convallis ut venenatis purus sit arcu sociis. Nunc fermentum adipiscing tempor cursus nascetur adipiscing adipiscing. Primis aliquam mus lacinia lobortis phasellus suscipit. Fermentum lobortis non tristique ante proin sociis accumsan lobortis. Auctor etiam porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum integer purus sapien. Nibh eleifend nulla nascetur pharetra commodo mi augue interdum tellus. Ornare cursus augue feugiat sodales velit lorem. Semper elementum ullamcorper lacinia natoque aenean scelerisque.',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');

UNLOCK TABLES;

/*Table structure for table `throttle` */

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `throttle` */

LOCK TABLES `throttle` WRITE;

insert  into `throttle`(`id`,`user_id`,`ip_address`,`attempts`,`suspended`,`banned`,`last_attempt_at`,`suspended_at`,`banned_at`) values (1,1,'127.0.0.1',0,0,0,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`username`,`email`,`password`,`permissions`,`activated`,`activation_code`,`activated_at`,`last_login`,`persist_code`,`reset_password_code`,`first_name`,`last_name`,`created_at`,`updated_at`) values (1,'admin','admin@admin.com','$2y$10$f0DcTicPShdD0cjFsBkUROWajYUbSv3/inVb6BAO4p5MMnAU7bIo.',NULL,1,NULL,NULL,'2014-02-25 07:56:18','$2y$10$uqc2UmHTnyI8LUfU61dbA.llFuNjkKPEgIrcfw/PAqK7.OZXLGRjK',NULL,NULL,NULL,'2014-02-25 06:18:04','2014-02-25 07:56:18'),(2,'2323123321','jjperez@gmail.com','$2y$10$yKUNf/i3SkqCVz8ljf0h6OP7ckajdkah/g0yCAUUwhMwSLMpeKxqW',NULL,1,NULL,NULL,NULL,NULL,NULL,'Juan','Perez Perez','2014-02-25 07:39:11','2014-02-25 07:39:11'),(3,'2381209389012','nmedinson@gmail.com','$2y$10$YT6NQEUwZIRcJaGSLEVwROtO4VFCf1ajqyK82wc5NdWtlPMHA5Pei',NULL,1,NULL,NULL,NULL,NULL,NULL,'Edinson','Nuñez More','2014-02-25 07:42:53','2014-02-25 07:42:53');

UNLOCK TABLES;

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_groups` */

LOCK TABLES `users_groups` WRITE;

insert  into `users_groups`(`user_id`,`group_id`) values (1,4),(2,2),(3,2);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
