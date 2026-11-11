/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: db_ukkcintaparkiran
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area_parkirs`
--

DROP TABLE IF EXISTS `area_parkirs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `area_parkirs` (
  `id_area` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(255) NOT NULL,
  `kapasitas` int NOT NULL,
  `terisi` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_parkirs`
--

LOCK TABLES `area_parkirs` WRITE;
/*!40000 ALTER TABLE `area_parkirs` DISABLE KEYS */;
INSERT INTO `area_parkirs` VALUES (1,'Gedung A, Lantai 1',50,0,'2026-10-01 12:20:50','2026-11-11 11:10:29'),(2,'Gedung B, Lantai 1',50,0,'2026-10-01 12:20:55','2026-10-01 17:53:43'),(3,'Gedung C, Lantai 1',50,0,'2026-10-01 12:21:01','2026-10-22 09:21:13'),(4,'Gedung C, Lantai 2',30,0,'2026-10-02 10:37:23','2026-10-02 10:37:23'),(5,'Gedung B, Lantai 2',50,0,'2026-10-21 06:45:52','2026-10-21 06:45:52');
/*!40000 ALTER TABLE `area_parkirs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_aktivitas`
--

DROP TABLE IF EXISTS `log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_aktivitas` (
  `id_log` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned DEFAULT NULL,
  `aktivitas` varchar(100) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_aktivitas`
--

LOCK TABLES `log_aktivitas` WRITE;
/*!40000 ALTER TABLE `log_aktivitas` DISABLE KEYS */;
INSERT INTO `log_aktivitas` VALUES (1,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:00:20','2026-10-01 12:00:20'),(2,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:00:22','2026-10-01 12:00:22'),(3,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:05:29','2026-10-01 12:05:29'),(4,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:06:30','2026-10-01 12:06:30'),(5,2,'CREATE','Menambahkan member Azka Fahrudin dengan kode member MBR-001 dan plat nomor B 1234 CDE.','2026-10-01 12:19:21','2026-10-01 12:19:21'),(6,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:19:24','2026-10-01 12:19:24'),(7,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:19:27','2026-10-01 12:19:27'),(8,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 12:19:49','2026-10-01 12:19:49'),(9,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:19:54','2026-10-01 12:19:54'),(10,2,'CREATE','Menambahkan tarif motor dengan tarif Rp 2.000','2026-10-01 12:20:24','2026-10-01 12:20:24'),(11,2,'CREATE','Menambahkan tarif mobil dengan tarif Rp 4.000','2026-10-01 12:20:32','2026-10-01 12:20:32'),(12,2,'CREATE','Menambahkan area parkir Gedung A, Lantai 1 dengan kapasitas 50 kendaraan.','2026-10-01 12:20:50','2026-10-01 12:20:50'),(13,2,'CREATE','Menambahkan area parkir Gedung B, Lantai 1 dengan kapasitas 50 kendaraan.','2026-10-01 12:20:55','2026-10-01 12:20:55'),(14,2,'CREATE','Menambahkan area parkir Gedung C, Lantai 1 dengan kapasitas 50 kendaraan.','2026-10-01 12:21:01','2026-10-01 12:21:01'),(15,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:21:06','2026-10-01 12:21:06'),(16,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:21:33','2026-10-01 12:21:33'),(17,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung A, Lantai 1 (mobil).','2026-10-01 12:21:41','2026-10-01 12:21:41'),(18,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:22:35','2026-10-01 12:22:35'),(19,3,'PARKIR_MASUK','Kendaraan B 1234 CDF masuk ke area Gedung A, Lantai 1 (mobil).','2026-10-01 12:22:57','2026-10-01 12:22:57'),(20,3,'PARKIR_KELUAR','Kendaraan B 1234 CDF keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 4.000.','2026-10-01 12:23:14','2026-10-01 12:23:14'),(21,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 12:23:32','2026-10-01 12:23:32'),(22,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:23:38','2026-10-01 12:23:38'),(23,2,'UPDATE','Mengubah area parkir Gedung A, Lantai 1 menjadi Gedung A, Lantai 2 dengan kapasitas 50 menjadi 50 kendaraan.','2026-10-01 12:23:50','2026-10-01 12:23:50'),(24,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:23:54','2026-10-01 12:23:54'),(25,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:24:00','2026-10-01 12:24:00'),(26,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 12:24:19','2026-10-01 12:24:19'),(27,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:24:22','2026-10-01 12:24:22'),(28,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 12:24:25','2026-10-01 12:24:25'),(29,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:24:31','2026-10-01 12:24:31'),(30,2,'UPDATE','Mengubah area parkir Gedung A, Lantai 2 menjadi Gedung A, Lantai 1 dengan kapasitas 50 menjadi 50 kendaraan.','2026-10-01 12:25:04','2026-10-01 12:25:04'),(31,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:25:12','2026-10-01 12:25:12'),(32,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:25:16','2026-10-01 12:25:16'),(33,3,'PARKIR_MASUK','Kendaraan B 1234 CDP masuk ke area Gedung A, Lantai 1 (motor).','2026-10-01 12:25:38','2026-10-01 12:25:38'),(34,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 12:25:47','2026-10-01 12:25:47'),(35,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:25:51','2026-10-01 12:25:51'),(36,2,'UPDATE','Mengubah area parkir Gedung A, Lantai 1 menjadi Gedung A, Lantai 1 dengan kapasitas 50 menjadi 1 kendaraan.','2026-10-01 12:26:58','2026-10-01 12:26:58'),(37,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 12:27:04','2026-10-01 12:27:04'),(38,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 12:27:09','2026-10-01 12:27:09'),(39,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 12:27:18','2026-10-01 12:27:18'),(40,NULL,'LOGIN','User admin berhasil login.','2026-10-01 12:27:23','2026-10-01 12:27:23'),(41,2,'UPDATE','Mengubah area parkir Gedung A, Lantai 1 menjadi Gedung A, Lantai 1 dengan kapasitas 1 menjadi 50 kendaraan.','2026-10-01 12:27:36','2026-10-01 12:27:36'),(42,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 14:02:01','2026-10-01 14:02:01'),(43,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 14:02:07','2026-10-01 14:02:07'),(44,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung A, Lantai 1 setelah parkir 2 jam dengan biaya Rp 8.000.','2026-10-01 14:02:15','2026-10-01 14:02:15'),(45,3,'PARKIR_KELUAR','Kendaraan B 1234 CDP keluar dari area Gedung A, Lantai 1 setelah parkir 2 jam dengan biaya Rp 4.000.','2026-10-01 14:02:33','2026-10-01 14:02:33'),(46,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 14:02:47','2026-10-01 14:02:47'),(47,NULL,'LOGIN','User admin berhasil login.','2026-10-01 14:02:53','2026-10-01 14:02:53'),(48,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 14:25:48','2026-10-01 14:25:48'),(49,NULL,'LOGIN','User owner berhasil login.','2026-10-01 14:25:56','2026-10-01 14:25:56'),(50,1,'LOGOUT','User owner keluar dari sistem.','2026-10-01 14:33:09','2026-10-01 14:33:09'),(51,NULL,'LOGIN','User owner berhasil login.','2026-10-01 14:33:15','2026-10-01 14:33:15'),(52,1,'LOGOUT','User owner keluar dari sistem.','2026-10-01 14:37:59','2026-10-01 14:37:59'),(53,NULL,'LOGIN','User owner berhasil login.','2026-10-01 14:38:03','2026-10-01 14:38:03'),(54,1,'LOGOUT','User owner keluar dari sistem.','2026-10-01 15:03:59','2026-10-01 15:03:59'),(55,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 15:04:47','2026-10-01 15:04:47'),(56,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 15:06:10','2026-10-01 15:06:10'),(57,NULL,'LOGIN','User owner berhasil login.','2026-10-01 15:06:15','2026-10-01 15:06:15'),(58,NULL,'LOGIN','User owner berhasil login.','2026-10-01 17:23:28','2026-10-01 17:23:28'),(59,1,'LOGOUT','User owner keluar dari sistem.','2026-10-01 17:40:08','2026-10-01 17:40:08'),(60,NULL,'LOGIN','User admin berhasil login.','2026-10-01 17:40:12','2026-10-01 17:40:12'),(61,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 17:40:14','2026-10-01 17:40:14'),(62,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 17:43:44','2026-10-01 17:43:44'),(63,3,'PARKIR_MASUK','Kendaraan B 1234 CDD masuk ke area Gedung B, Lantai 1 (motor).','2026-10-01 17:50:40','2026-10-01 17:50:40'),(64,3,'PARKIR_KELUAR','Kendaraan B 1234 CDD keluar dari area Gedung B, Lantai 1 setelah parkir 1 jam dengan biaya Rp 2.000.','2026-10-01 17:50:45','2026-10-01 17:50:45'),(65,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung A, Lantai 1 (mobil).','2026-10-01 17:50:53','2026-10-01 17:50:53'),(66,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-01 17:51:01','2026-10-01 17:51:01'),(67,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung B, Lantai 1 (mobil).','2026-10-01 17:53:35','2026-10-01 17:53:35'),(68,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung B, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-01 17:53:43','2026-10-01 17:53:43'),(69,3,'PARKIR_MASUK','Kendaraan D 1234 EFH masuk ke area Gedung C, Lantai 1 (motor).','2026-10-01 17:54:01','2026-10-01 17:54:01'),(70,3,'PARKIR_KELUAR','Kendaraan D 1234 EFH keluar dari area Gedung C, Lantai 1 setelah parkir 1 jam dengan biaya Rp 2.000.','2026-10-01 17:54:07','2026-10-01 17:54:07'),(71,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 17:57:21','2026-10-01 17:57:21'),(72,NULL,'LOGIN','User owner berhasil login.','2026-10-01 18:09:42','2026-10-01 18:09:42'),(73,1,'LOGOUT','User owner keluar dari sistem.','2026-10-01 18:10:16','2026-10-01 18:10:16'),(74,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 18:10:19','2026-10-01 18:10:19'),(75,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 18:10:38','2026-10-01 18:10:38'),(76,NULL,'LOGIN','User admin berhasil login.','2026-10-01 18:10:42','2026-10-01 18:10:42'),(77,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 18:10:43','2026-10-01 18:10:43'),(78,NULL,'LOGIN','User owner berhasil login.','2026-10-01 18:10:49','2026-10-01 18:10:49'),(79,1,'LOGOUT','User owner keluar dari sistem.','2026-10-01 18:10:52','2026-10-01 18:10:52'),(80,NULL,'LOGIN','User admin berhasil login.','2026-10-01 18:11:38','2026-10-01 18:11:38'),(81,2,'LOGOUT','User admin keluar dari sistem.','2026-10-01 18:20:12','2026-10-01 18:20:12'),(82,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 18:20:16','2026-10-01 18:20:16'),(83,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung A, Lantai 1 (mobil).','2026-10-01 18:21:58','2026-10-01 18:21:58'),(84,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-01 18:22:09','2026-10-01 18:22:09'),(85,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 18:26:13','2026-10-01 18:26:13'),(86,NULL,'LOGIN','User petugas berhasil login.','2026-10-01 19:11:21','2026-10-01 19:11:21'),(87,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-01 19:11:25','2026-10-01 19:11:25'),(88,NULL,'LOGIN','User admin berhasil login.','2026-10-01 19:15:24','2026-10-01 19:15:24'),(89,NULL,'LOGIN','User admin berhasil login.','2026-10-01 19:17:27','2026-10-01 19:17:27'),(90,NULL,'LOGIN','User admin berhasil login.','2026-10-01 19:18:04','2026-10-01 19:18:04'),(91,2,'CREATE','Menambahkan tarif Agya Bagas dengan tarif Rp 500','2026-10-01 19:21:54','2026-10-01 19:21:54'),(92,NULL,'LOGIN','User admin berhasil login.','2026-10-01 20:09:27','2026-10-01 20:09:27'),(93,NULL,'LOGIN','User admin berhasil login.','2026-10-01 22:15:55','2026-10-01 22:15:55'),(94,NULL,'LOGIN','User admin berhasil login.','2026-10-02 05:08:33','2026-10-02 05:08:33'),(95,2,'CREATE','Menambahkan member Kornelius Bagas Natama dengan kode member MBR-002 dan plat nomor B 4321 SGT.','2026-10-02 05:10:01','2026-10-02 05:10:01'),(96,2,'DELETE','Menghapus tarif Agya Bagas dengan tarif Rp 500','2026-10-02 05:10:39','2026-10-02 05:10:39'),(97,NULL,'LOGIN','User admin berhasil login.','2026-10-02 06:09:36','2026-10-02 06:09:36'),(98,NULL,'LOGIN','User admin berhasil login.','2026-10-02 06:12:32','2026-10-02 06:12:32'),(99,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 06:12:58','2026-10-02 06:12:58'),(100,NULL,'LOGIN','User admin berhasil login.','2026-10-02 06:13:57','2026-10-02 06:13:57'),(101,NULL,'LOGIN','User admin berhasil login.','2026-10-02 06:26:56','2026-10-02 06:26:56'),(102,NULL,'LOGIN','User admin berhasil login.','2026-10-02 06:44:50','2026-10-02 06:44:50'),(103,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 06:46:30','2026-10-02 06:46:30'),(104,NULL,'LOGIN','User petugas berhasil login.','2026-10-02 06:47:00','2026-10-02 06:47:00'),(105,3,'PARKIR_MASUK','Kendaraan B 4321 SGT masuk ke area Gedung A, Lantai 1 (mobil).','2026-10-02 06:47:33','2026-10-02 06:47:33'),(106,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung A, Lantai 1 (mobil).','2026-10-02 06:47:47','2026-10-02 06:47:47'),(107,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-02 06:47:53','2026-10-02 06:47:53'),(108,NULL,'LOGIN','User admin berhasil login.','2026-10-02 06:47:57','2026-10-02 06:47:57'),(109,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 07:05:16','2026-10-02 07:05:16'),(110,NULL,'LOGIN','User admin berhasil login.','2026-10-02 07:05:18','2026-10-02 07:05:18'),(111,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 07:05:20','2026-10-02 07:05:20'),(112,NULL,'LOGIN','User petugas berhasil login.','2026-10-02 07:05:26','2026-10-02 07:05:26'),(113,3,'PARKIR_KELUAR','Kendaraan B 4321 SGT keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-02 07:05:32','2026-10-02 07:05:32'),(114,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-02 07:05:50','2026-10-02 07:05:50'),(115,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-02 07:05:57','2026-10-02 07:05:57'),(116,NULL,'LOGIN','User owner berhasil login.','2026-10-02 07:06:12','2026-10-02 07:06:12'),(117,1,'LOGOUT','User owner keluar dari sistem.','2026-10-02 07:08:55','2026-10-02 07:08:55'),(118,NULL,'LOGIN','User admin berhasil login.','2026-10-02 07:09:01','2026-10-02 07:09:01'),(119,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 07:12:44','2026-10-02 07:12:44'),(120,NULL,'LOGIN','User petugas berhasil login.','2026-10-02 07:12:48','2026-10-02 07:12:48'),(121,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-02 07:21:37','2026-10-02 07:21:37'),(122,NULL,'LOGIN','User petugas berhasil login.','2026-10-02 07:27:04','2026-10-02 07:27:04'),(123,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-02 07:28:57','2026-10-02 07:28:57'),(124,NULL,'LOGIN','User admin berhasil login.','2026-10-02 07:29:07','2026-10-02 07:29:07'),(125,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 07:45:35','2026-10-02 07:45:35'),(126,NULL,'LOGIN','User admin berhasil login.','2026-10-02 07:45:59','2026-10-02 07:45:59'),(127,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 07:50:13','2026-10-02 07:50:13'),(128,NULL,'LOGIN','User petugas berhasil login.','2026-10-02 07:50:41','2026-10-02 07:50:41'),(129,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-02 08:23:33','2026-10-02 08:23:33'),(130,NULL,'LOGIN','User admin berhasil login.','2026-10-02 08:23:37','2026-10-02 08:23:37'),(131,2,'CREATE','Menambahkan tarif besar dengan tarif Rp 6.000','2026-10-02 08:23:53','2026-10-02 08:23:53'),(132,2,'CREATE','Menambahkan member Azka Fahrudin dengan kode member MBR-003 dan plat nomor D 1234 EFG.','2026-10-02 08:25:27','2026-10-02 08:25:27'),(133,2,'CREATE','Menambahkan member Rizal Audi dengan kode member MBR-004 dan plat nomor B 1234 CDP.','2026-10-02 08:25:59','2026-10-02 08:25:59'),(134,2,'CREATE','Menambahkan member Erica Aleysa Putri dengan kode member MBR-005 dan plat nomor B 1234 CDF.','2026-10-02 08:26:42','2026-10-02 08:26:42'),(135,2,'LOGOUT','User admin keluar dari sistem.','2026-10-02 08:26:47','2026-10-02 08:26:47'),(136,NULL,'LOGIN','User petugas berhasil login.','2026-10-02 08:26:53','2026-10-02 08:26:53'),(137,NULL,'LOGIN','User admin berhasil login.','2026-10-02 10:35:50','2026-10-02 10:35:50'),(138,2,'CREATE','Menambahkan tarif besar dengan tarif Rp 8.000','2026-10-02 10:36:47','2026-10-02 10:36:47'),(139,2,'DELETE','Menghapus tarif besar dengan tarif Rp 8.000 beserta 0 transaksi terkait.','2026-10-02 10:36:59','2026-10-02 10:36:59'),(140,2,'CREATE','Menambahkan area parkir Gedung C, Lantai 2 dengan kapasitas 30 kendaraan.','2026-10-02 10:37:23','2026-10-02 10:37:23'),(141,2,'CREATE','Menambahkan member Teddy owo dengan kode member MBR-006 dan plat nomor AB 1234 F.','2026-10-02 10:38:55','2026-10-02 10:38:55'),(142,NULL,'LOGIN','User admin berhasil login.','2026-10-03 06:48:03','2026-10-03 06:48:03'),(143,NULL,'LOGIN','User admin berhasil login.','2026-10-04 00:46:30','2026-10-04 00:46:30'),(144,2,'LOGOUT','User admin keluar dari sistem.','2026-10-04 00:47:29','2026-10-04 00:47:29'),(145,NULL,'LOGIN','User admin berhasil login.','2026-10-05 08:20:07','2026-10-05 08:20:07'),(146,NULL,'LOGIN','User admin berhasil login.','2026-10-05 19:29:23','2026-10-05 19:29:23'),(147,NULL,'LOGIN','User admin berhasil login.','2026-10-08 10:23:05','2026-10-08 10:23:05'),(148,2,'LOGOUT','User admin keluar dari sistem.','2026-10-08 10:24:10','2026-10-08 10:24:10'),(149,NULL,'LOGIN','User admin berhasil login.','2026-10-13 20:42:00','2026-10-13 20:42:00'),(150,NULL,'LOGIN','User petugas berhasil login.','2026-10-16 06:48:21','2026-10-16 06:48:21'),(151,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-16 06:48:35','2026-10-16 06:48:35'),(152,NULL,'LOGIN','User admin berhasil login.','2026-10-16 06:48:38','2026-10-16 06:48:38'),(153,NULL,'LOGIN','User admin berhasil login.','2026-10-17 20:35:46','2026-10-17 20:35:46'),(154,2,'LOGOUT','User admin keluar dari sistem.','2026-10-17 20:35:57','2026-10-17 20:35:57'),(155,NULL,'LOGIN','User admin berhasil login.','2026-10-17 20:36:32','2026-10-17 20:36:32'),(156,2,'LOGOUT','User admin keluar dari sistem.','2026-10-17 20:36:36','2026-10-17 20:36:36'),(157,NULL,'LOGIN','User admin berhasil login.','2026-10-17 20:37:49','2026-10-17 20:37:49'),(158,NULL,'LOGIN','User admin berhasil login.','2026-10-17 22:13:00','2026-10-17 22:13:00'),(159,2,'LOGOUT','User admin keluar dari sistem.','2026-10-17 22:14:56','2026-10-17 22:14:56'),(160,NULL,'LOGIN','User petugas berhasil login.','2026-10-17 22:15:10','2026-10-17 22:15:10'),(161,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-17 22:18:12','2026-10-17 22:18:12'),(162,NULL,'LOGIN','User admin berhasil login.','2026-10-17 22:18:29','2026-10-17 22:18:29'),(163,NULL,'LOGIN','User admin berhasil login.','2026-10-18 20:18:12','2026-10-18 20:18:12'),(164,NULL,'LOGIN','User admin berhasil login.','2026-10-19 19:29:47','2026-10-19 19:29:47'),(165,NULL,'LOGIN','User petugas berhasil login.','2026-10-19 20:05:15','2026-10-19 20:05:15'),(166,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung A, Lantai 1 (sedang).','2026-10-19 20:11:31','2026-10-19 20:11:31'),(167,3,'PARKIR_MASUK','Kendaraan AB 1234 F masuk ke area Gedung A, Lantai 1 (sedang).','2026-10-19 20:19:25','2026-10-19 20:19:25'),(168,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-19 20:39:09','2026-10-19 20:39:09'),(169,NULL,'LOGIN','User admin berhasil login.','2026-10-20 07:05:18','2026-10-20 07:05:18'),(170,NULL,'LOGIN','User owner berhasil login.','2026-10-20 07:06:15','2026-10-20 07:06:15'),(171,1,'LOGOUT','User owner keluar dari sistem.','2026-10-20 07:06:40','2026-10-20 07:06:40'),(172,NULL,'LOGIN','User admin berhasil login.','2026-10-20 07:06:51','2026-10-20 07:06:51'),(173,2,'LOGOUT','User admin keluar dari sistem.','2026-10-20 07:08:32','2026-10-20 07:08:32'),(174,NULL,'LOGIN','User petugas berhasil login.','2026-10-20 07:08:38','2026-10-20 07:08:38'),(175,3,'PARKIR_KELUAR','Kendaraan AB 1234 F keluar dari area Gedung A, Lantai 1 setelah parkir 11 jam dengan biaya Rp 35.200.','2026-10-20 07:08:57','2026-10-20 07:08:57'),(176,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-20 07:09:10','2026-10-20 07:09:10'),(177,NULL,'LOGIN','User owner berhasil login.','2026-10-20 07:09:18','2026-10-20 07:09:18'),(178,1,'LOGOUT','User owner keluar dari sistem.','2026-10-20 07:43:33','2026-10-20 07:43:33'),(179,NULL,'LOGIN','User admin berhasil login.','2026-10-20 21:19:01','2026-10-20 21:19:01'),(180,2,'LOGOUT','User admin keluar dari sistem.','2026-10-20 21:38:56','2026-10-20 21:38:56'),(181,NULL,'LOGIN','User petugas berhasil login.','2026-10-20 21:39:08','2026-10-20 21:39:08'),(182,NULL,'LOGIN','User owner berhasil login.','2026-10-21 06:43:30','2026-10-21 06:43:30'),(183,1,'LOGOUT','User owner keluar dari sistem.','2026-10-21 06:45:20','2026-10-21 06:45:20'),(184,NULL,'LOGIN','User admin berhasil login.','2026-10-21 06:45:25','2026-10-21 06:45:25'),(185,2,'CREATE','Menambahkan area parkir Gedung B, Lantai 2 dengan kapasitas 50 kendaraan.','2026-10-21 06:45:52','2026-10-21 06:45:52'),(186,2,'LOGOUT','User admin keluar dari sistem.','2026-10-21 06:46:09','2026-10-21 06:46:09'),(187,NULL,'LOGIN','User owner berhasil login.','2026-10-21 06:46:15','2026-10-21 06:46:15'),(188,1,'LOGOUT','User owner keluar dari sistem.','2026-10-21 07:22:55','2026-10-21 07:22:55'),(189,NULL,'LOGIN','User admin berhasil login.','2026-10-21 07:23:02','2026-10-21 07:23:02'),(190,2,'LOGOUT','User admin keluar dari sistem.','2026-10-21 08:12:03','2026-10-21 08:12:03'),(191,NULL,'LOGIN','User admin berhasil login.','2026-10-21 08:22:34','2026-10-21 08:22:34'),(192,NULL,'LOGIN','User admin berhasil login.','2026-10-21 19:20:38','2026-10-21 19:20:38'),(193,NULL,'LOGIN','User petugas berhasil login.','2026-10-21 21:08:58','2026-10-21 21:08:58'),(194,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-21 21:16:16','2026-10-21 21:16:16'),(195,NULL,'LOGIN','User owner berhasil login.','2026-10-21 21:16:19','2026-10-21 21:16:19'),(196,NULL,'LOGIN','User owner berhasil login.','2026-10-22 08:17:05','2026-10-22 08:17:05'),(197,1,'LOGOUT','User owner keluar dari sistem.','2026-10-22 08:17:08','2026-10-22 08:17:08'),(198,NULL,'LOGIN','User admin berhasil login.','2026-10-22 08:17:12','2026-10-22 08:17:12'),(199,2,'LOGOUT','User admin keluar dari sistem.','2026-10-22 08:22:22','2026-10-22 08:22:22'),(200,NULL,'LOGIN','User admin berhasil login.','2026-10-22 08:50:40','2026-10-22 08:50:40'),(201,2,'LOGOUT','User admin keluar dari sistem.','2026-10-22 08:59:43','2026-10-22 08:59:43'),(202,NULL,'LOGIN','User petugas berhasil login.','2026-10-22 08:59:46','2026-10-22 08:59:46'),(203,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung C, Lantai 1 (sedang).','2026-10-22 09:19:08','2026-10-22 09:19:08'),(204,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung C, Lantai 1 setelah parkir 1 jam dengan biaya Rp 3.200.','2026-10-22 09:21:13','2026-10-22 09:21:13'),(205,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-22 09:22:06','2026-10-22 09:22:06'),(206,NULL,'LOGIN','User owner berhasil login.','2026-10-22 09:22:11','2026-10-22 09:22:11'),(207,1,'LOGOUT','User owner keluar dari sistem.','2026-10-22 09:26:16','2026-10-22 09:26:16'),(208,NULL,'LOGIN','User admin berhasil login.','2026-10-22 09:28:40','2026-10-22 09:28:40'),(209,2,'LOGOUT','User admin keluar dari sistem.','2026-10-22 09:30:56','2026-10-22 09:30:56'),(210,NULL,'LOGIN','User admin berhasil login.','2026-10-22 09:43:15','2026-10-22 09:43:15'),(211,NULL,'LOGIN','User admin berhasil login.','2026-10-22 18:51:02','2026-10-22 18:51:02'),(212,2,'LOGOUT','User admin keluar dari sistem.','2026-10-22 18:53:52','2026-10-22 18:53:52'),(213,NULL,'LOGIN','User petugas berhasil login.','2026-10-22 18:53:56','2026-10-22 18:53:56'),(214,3,'PARKIR_MASUK','Kendaraan D 1234 EFG masuk ke area Gedung A, Lantai 1 (kecil).','2026-10-22 18:55:17','2026-10-22 18:55:17'),(215,3,'PARKIR_KELUAR','Kendaraan D 1234 EFG keluar dari area Gedung A, Lantai 1 setelah parkir 1 jam dengan biaya Rp 1.600.','2026-10-22 18:56:25','2026-10-22 18:56:25'),(216,3,'LOGOUT','User petugas keluar dari sistem.','2026-10-22 18:56:55','2026-10-22 18:56:55'),(217,NULL,'LOGIN','User owner berhasil login.','2026-10-22 18:56:59','2026-10-22 18:56:59'),(218,NULL,'LOGIN','User owner berhasil login.','2026-11-09 20:04:00','2026-11-09 20:04:00'),(219,1,'LOGOUT','User owner keluar dari sistem.','2026-11-09 20:04:04','2026-11-09 20:04:04'),(220,NULL,'LOGIN','User owner berhasil login.','2026-11-09 20:04:26','2026-11-09 20:04:26'),(221,1,'LOGOUT','User owner keluar dari sistem.','2026-11-09 20:04:32','2026-11-09 20:04:32'),(222,NULL,'LOGIN','User petugas berhasil login.','2026-11-09 20:06:52','2026-11-09 20:06:52'),(223,3,'LOGOUT','User petugas keluar dari sistem.','2026-11-09 20:07:00','2026-11-09 20:07:00'),(224,NULL,'LOGIN','User owner berhasil login.','2026-11-09 20:07:08','2026-11-09 20:07:08'),(225,1,'LOGOUT','User owner keluar dari sistem.','2026-11-09 20:07:10','2026-11-09 20:07:10'),(226,NULL,'LOGIN','User petugas berhasil login.','2026-11-09 20:31:07','2026-11-09 20:31:07'),(227,3,'PARKIR_MASUK','Kendaraan B 1234 CDE masuk ke area Gedung A, Lantai 1 (sedang).','2026-11-09 20:31:19','2026-11-09 20:31:19'),(228,3,'LOGOUT','User petugas keluar dari sistem.','2026-11-09 20:34:19','2026-11-09 20:34:19'),(229,NULL,'LOGIN','User admin berhasil login.','2026-11-09 20:37:58','2026-11-09 20:37:58'),(230,2,'LOGOUT','User admin keluar dari sistem.','2026-11-09 20:48:59','2026-11-09 20:48:59'),(231,NULL,'LOGIN','User owner berhasil login.','2026-11-09 20:49:37','2026-11-09 20:49:37'),(232,1,'LOGOUT','User owner keluar dari sistem.','2026-11-09 20:58:19','2026-11-09 20:58:19'),(233,NULL,'LOGIN','User admin berhasil login.','2026-11-09 20:58:21','2026-11-09 20:58:21'),(234,NULL,'LOGIN','User admin berhasil login.','2026-11-11 08:01:03','2026-11-11 08:01:03'),(235,2,'LOGOUT','User admin keluar dari sistem.','2026-11-11 08:06:32','2026-11-11 08:06:32'),(236,NULL,'LOGIN','User admin berhasil login.','2026-11-11 08:07:15','2026-11-11 08:07:15'),(237,2,'CREATE','Menambahkan user Petugas2 dengan role petugas.','2026-11-11 08:08:47','2026-11-11 08:08:47'),(238,2,'UPDATE','Mengubah user Petugas2 (Mikael Keyndradito, role petugas) menjadi Petugas2 (Endrico Akhtar Gunawan, role petugas).','2026-11-11 08:09:34','2026-11-11 08:09:34'),(239,2,'CREATE','Menambahkan member Sangkuriang dengan kode member MBR-007 dan plat nomor B 1234 CDG.','2026-11-11 08:13:21','2026-11-11 08:13:21'),(240,2,'DELETE','Menghapus tarif besar dengan tarif Rp 6.000 beserta 0 transaksi terkait.','2026-11-11 08:18:48','2026-11-11 08:18:48'),(241,2,'CREATE','Menambahkan tarif besar dengan tarif Rp 6.000','2026-11-11 08:19:15','2026-11-11 08:19:15'),(242,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, B 1234 CDG) menjadi Sangkuriang (MBR-007, B 1234 CDG).','2026-11-11 08:49:41','2026-11-11 08:49:41'),(243,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, B 1234 CDG) menjadi Sangkuriang (MBR-007, B 1234).','2026-11-11 08:51:01','2026-11-11 08:51:01'),(244,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, B 1234) menjadi Sangkuriang (MBR-007, B 12 BC).','2026-11-11 08:53:32','2026-11-11 08:53:32'),(245,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, B 12 BC) menjadi Sangkuriang (MBR-007, QWERTY).','2026-11-11 08:53:56','2026-11-11 08:53:56'),(246,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, QWERTY) menjadi Sangkuriang (MBR-007, BASDBBASD).','2026-11-11 08:55:47','2026-11-11 08:55:47'),(247,2,'DELETE','Menghapus member Sangkuriang dengan kode member MBR-007 dan plat nomor BASDBBASD.','2026-11-11 09:05:16','2026-11-11 09:05:16'),(248,2,'CREATE','Menambahkan member Sangkuriang dengan kode member MBR-007 dan plat nomor B 1234 CDG.','2026-11-11 09:11:15','2026-11-11 09:11:15'),(249,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, B 1234 CDG) menjadi Sangkuriang (MBR-007, B 1234 CDG).','2026-11-11 09:13:05','2026-11-11 09:13:05'),(250,2,'LOGOUT','User admin keluar dari sistem.','2026-11-11 09:40:49','2026-11-11 09:40:49'),(251,NULL,'LOGIN','User admin berhasil login.','2026-11-11 10:57:44','2026-11-11 10:57:44'),(252,2,'UPDATE','Mengubah member Sangkuriang (MBR-007, B 1234 CDG) menjadi Sangkuriang (MBR-007, B 1 RI).','2026-11-11 10:58:12','2026-11-11 10:58:12'),(253,2,'LOGOUT','User admin keluar dari sistem.','2026-11-11 11:08:45','2026-11-11 11:08:45'),(254,NULL,'LOGIN','User petugas berhasil login.','2026-11-11 11:08:49','2026-11-11 11:08:49'),(255,3,'PARKIR_KELUAR','Kendaraan B 1234 CDE keluar dari area Gedung A, Lantai 1 setelah parkir 39 jam dengan biaya Rp 124.800.','2026-11-11 11:10:30','2026-11-11 11:10:30');
/*!40000 ALTER TABLE `log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `id_member` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned DEFAULT NULL,
  `kode_member` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `plat_nomor` varchar(15) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL DEFAULT 'kecil',
  `no_hp` varchar(20) NOT NULL,
  `status_aktif` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `tanggal_kadaluarsa` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `kode_member` (`kode_member`),
  KEY `fk_member_user` (`id_user`),
  CONSTRAINT `fk_member_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,2,'MBR-001','Azka Fahrudin','B 1234 CDE','sedang','08123456789','aktif','2026-11-01','2026-10-01 12:19:21','2026-10-01 12:19:21'),(2,2,'MBR-002','Kornelius Bagas Natama','B 4321 SGT','sedang','08123456789','aktif','2026-11-02','2026-10-02 05:10:01','2026-10-02 05:10:01'),(3,2,'MBR-003','Azka Fahrudin','D 1234 EFG','kecil','08123456789','aktif','2026-11-02','2026-10-02 08:25:27','2026-10-02 08:25:27'),(4,2,'MBR-004','Rizal Audi','B 1234 CDP','sedang','08123456789','aktif','2026-11-02','2026-10-02 08:25:58','2026-10-02 08:25:58'),(5,2,'MBR-005','Erica Aleysa Putri','B 1234 CDF','kecil','08123456789','aktif','2026-11-02','2026-10-02 08:26:42','2026-10-02 08:26:42'),(6,2,'MBR-006','Teddy owo','AB 1234 F','sedang','089123456780','aktif','2026-11-02','2026-10-02 10:38:55','2026-10-02 10:38:55'),(8,2,'MBR-007','Sangkuriang','B 1 RI','kecil','08123456789','aktif','2026-12-12','2026-11-11 09:11:15','2026-11-11 10:58:12');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ran_at` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_08_20_090000_create_users_table.sql','2026-10-01 10:01:22'),(2,'2026_08_21_090000_create_roles_table.sql','2026-10-01 10:01:24'),(3,'2026_08_23_100000_add_can_register_to_roles_table.sql','2026-10-01 10:01:24'),(4,'2026_09_26_093702_create_tarifs_table.sql','2026-10-01 10:01:25'),(5,'2026_09_26_115247_create_area_parkirs_table.sql','2026-10-01 10:01:25'),(6,'2026_09_27_190833_create_members_table.sql','2026-10-01 10:01:27'),(7,'2026_09_29_210546_create_transaksis_table.sql','2026-10-01 10:01:27'),(8,'2026_10_01_105654_create_log_aktivitases_table.sql','2026-10-01 12:00:13');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `can_register` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'owner','2026-10-01 10:01:24','2026-10-01 10:01:24',0),(2,'admin','2026-10-01 10:01:24','2026-10-01 10:01:24',0),(3,'petugas','2026-10-01 10:01:24','2026-10-01 10:01:24',0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarif` (
  `id_tarif` int unsigned NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(255) NOT NULL,
  `tarif_per_jam` decimal(10,0) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarif`
--

LOCK TABLES `tarif` WRITE;
/*!40000 ALTER TABLE `tarif` DISABLE KEYS */;
INSERT INTO `tarif` VALUES (1,'kecil',2000,'2026-10-01 12:20:24','2026-10-01 12:20:24'),(2,'sedang',4000,'2026-10-01 12:20:32','2026-10-01 12:20:32'),(6,'besar',6000,'2026-11-11 08:19:15','2026-11-11 08:19:15');
/*!40000 ALTER TABLE `tarif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `id_parkir` int unsigned NOT NULL AUTO_INCREMENT,
  `id_member` int unsigned DEFAULT NULL,
  `plat_nomor` varchar(15) DEFAULT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `id_tarif` int unsigned NOT NULL,
  `durasi_jam` int unsigned NOT NULL DEFAULT '0',
  `biaya_total` decimal(10,0) NOT NULL DEFAULT '0',
  `status` enum('masuk','keluar') NOT NULL,
  `id_user` int unsigned NOT NULL,
  `id_area` int unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_parkir`),
  KEY `fk_transaksi_member` (`id_member`),
  KEY `fk_transaksi_tarif` (`id_tarif`),
  KEY `fk_transaksi_user` (`id_user`),
  KEY `fk_transaksi_area` (`id_area`),
  CONSTRAINT `fk_transaksi_area` FOREIGN KEY (`id_area`) REFERENCES `area_parkirs` (`id_area`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_member` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (1,1,'B 1234 CDE','2026-10-01 12:21:41','2026-10-01 14:02:15',2,2,8000,'keluar',3,1,'2026-10-01 12:21:41','2026-10-01 14:02:15'),(2,NULL,'B 1234 CDF','2026-10-01 12:22:57','2026-10-01 12:23:14',2,1,4000,'keluar',3,1,'2026-10-01 12:22:57','2026-10-01 12:23:14'),(3,NULL,'B 1234 CDP','2026-10-01 12:25:38','2026-10-01 14:02:33',1,2,4000,'keluar',3,1,'2026-10-01 12:25:38','2026-10-01 14:02:33'),(4,NULL,'B 1234 CDD','2026-10-01 17:50:39','2026-10-01 17:50:45',1,1,2000,'keluar',3,2,'2026-10-01 17:50:39','2026-10-01 17:50:45'),(5,1,'B 1234 CDE','2026-10-01 17:50:53','2026-10-01 17:51:01',2,1,3200,'keluar',3,1,'2026-10-01 17:50:53','2026-10-01 17:51:01'),(6,1,'B 1234 CDE','2026-10-01 17:53:35','2026-10-01 17:53:43',2,1,3200,'keluar',3,2,'2026-10-01 17:53:35','2026-10-01 17:53:43'),(7,NULL,'D 1234 EFH','2026-10-01 17:54:01','2026-10-01 17:54:07',1,1,2000,'keluar',3,3,'2026-10-01 17:54:01','2026-10-01 17:54:07'),(8,1,'B 1234 CDE','2026-10-01 18:21:58','2026-10-01 18:22:09',2,1,3200,'keluar',3,1,'2026-10-01 18:21:58','2026-10-01 18:22:09'),(9,2,'B 4321 SGT','2026-10-02 06:47:32','2026-10-02 07:05:32',2,1,3200,'keluar',3,1,'2026-10-02 06:47:32','2026-10-02 07:05:32'),(10,1,'B 1234 CDE','2026-10-02 06:47:46','2026-10-02 07:05:49',2,1,3200,'keluar',3,1,'2026-10-02 06:47:46','2026-10-02 07:05:49'),(11,1,'B 1234 CDE','2026-10-19 20:11:30','2026-10-19 20:39:09',2,1,3200,'keluar',3,1,'2026-10-19 20:11:30','2026-10-19 20:39:09'),(12,6,'AB 1234 F','2026-10-19 20:19:25','2026-10-20 07:08:57',2,11,35200,'keluar',3,1,'2026-10-19 20:19:25','2026-10-20 07:08:57'),(13,1,'B 1234 CDE','2026-10-22 09:19:08','2026-10-22 09:21:13',2,1,3200,'keluar',3,3,'2026-10-22 09:19:08','2026-10-22 09:21:13'),(14,3,'D 1234 EFG','2026-10-22 18:55:16','2026-10-22 18:56:24',1,1,1600,'keluar',3,1,'2026-10-22 18:55:16','2026-10-22 18:56:24'),(15,1,'B 1234 CDE','2026-11-09 20:31:19','2026-11-11 11:10:29',2,39,124800,'keluar',3,1,'2026-11-09 20:31:19','2026-11-11 11:10:29');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'owner','Demo Owner','$2y$12$ntn3LANEH6afERNoQs6vueMqxger3kP.hWMsMZDR9E.EnOsWC2xy6','owner','2026-10-01 10:01:22','2026-10-01 10:01:22'),(2,'admin','Demo Admin','$2y$12$ntn3LANEH6afERNoQs6vueMqxger3kP.hWMsMZDR9E.EnOsWC2xy6','admin','2026-10-01 10:01:22','2026-10-01 10:01:22'),(3,'petugas','Demo Petugas','$2y$12$ntn3LANEH6afERNoQs6vueMqxger3kP.hWMsMZDR9E.EnOsWC2xy6','petugas','2026-10-01 10:01:22','2026-10-01 10:01:22'),(4,'Petugas2','Endrico Akhtar Gunawan','$2y$10$Ly6LX5DlxjrjEty9GUtaeuttuLjQD2kBbkGZuHd./1wW.y8Ioq2aK','petugas','2026-11-11 08:08:47','2026-11-11 08:09:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-11 11:32:13
