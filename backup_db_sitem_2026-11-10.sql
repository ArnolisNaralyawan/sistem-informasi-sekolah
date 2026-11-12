-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_sitem
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `absensis`
--

DROP TABLE IF EXISTS `absensis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','sakit','izin','alpha') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `guru_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `absensis_siswa_id_tanggal_unique` (`siswa_id`,`tanggal`),
  KEY `absensis_guru_id_foreign` (`guru_id`),
  CONSTRAINT `absensis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE SET NULL,
  CONSTRAINT `absensis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensis`
--

LOCK TABLES `absensis` WRITE;
/*!40000 ALTER TABLE `absensis` DISABLE KEYS */;
INSERT INTO `absensis` VALUES (1,1,'2025-11-23','hadir',NULL,1,'2025-11-23 00:42:01','2025-11-23 00:42:01'),(2,2,'2025-11-23','alpha',NULL,1,'2025-11-23 01:40:23','2025-11-23 01:43:10'),(3,1,'2025-11-25','izin',NULL,1,'2025-11-24 17:58:39','2025-11-24 17:58:39'),(4,2,'2025-11-25','sakit',NULL,1,'2025-11-24 17:58:39','2025-11-24 17:58:39'),(5,3,'2025-11-25','hadir',NULL,1,'2025-11-24 17:58:39','2025-11-24 17:58:39'),(6,1,'2026-11-10','sakit',NULL,2,'2026-11-09 18:26:26','2026-11-09 18:26:26'),(7,2,'2026-11-10','hadir',NULL,2,'2026-11-09 18:26:26','2026-11-09 18:26:26'),(8,3,'2026-11-10','hadir',NULL,2,'2026-11-09 18:26:26','2026-11-09 18:26:26');
/*!40000 ALTER TABLE `absensis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumentasi_files`
--

DROP TABLE IF EXISTS `dokumentasi_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dokumentasi_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dokumentasi_id` bigint unsigned NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumentasi_files_dokumentasi_id_foreign` (`dokumentasi_id`),
  CONSTRAINT `dokumentasi_files_dokumentasi_id_foreign` FOREIGN KEY (`dokumentasi_id`) REFERENCES `dokumentasis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumentasi_files`
--

LOCK TABLES `dokumentasi_files` WRITE;
/*!40000 ALTER TABLE `dokumentasi_files` DISABLE KEYS */;
INSERT INTO `dokumentasi_files` VALUES (4,4,'2.jpeg','dokumentasi/yCKUBaY1OarhJYcBnsvWrWC6DBDhlF6S1KUEoYM0.jpg',0,'2025-11-25 18:17:40','2025-11-25 18:17:40'),(5,5,'3.jpeg','dokumentasi/BxsVdKRsJlH7ARVg0p9gpfQRm9RosyZMZc9HADRd.jpg',0,'2025-11-25 18:18:05','2025-11-25 18:18:05'),(7,7,'5.jpeg','dokumentasi/5jK8KsJ812DshX0IIa6wusUrNYHq9cmG2NY028nH.jpg',0,'2025-11-25 18:20:01','2025-11-25 18:20:01'),(8,8,'6.jpeg','dokumentasi/fIg2oOIajYJtF1KjV9k3q3BZ4HaxZK6V8Nk81CVJ.jpg',0,'2025-11-25 18:20:28','2025-11-25 18:20:28'),(11,11,'7.jpeg','dokumentasi/G5lHYgBS00v4CY8oz3qoUjN5D4Hqv7z8Ad7AdLkg.jpg',0,'2025-11-25 18:26:27','2025-11-25 18:26:27'),(12,12,'4.jpeg','dokumentasi/RLMdDL6gacl3cSt6Wk9fB0rqehKDvxSHPCCDqKBZ.jpg',0,'2025-11-25 18:29:45','2025-11-25 18:29:45'),(13,13,'8.jpeg','dokumentasi/1gjj1oqOeUMmTnVlh3pVfxamZliHGtG2PgiKjiBI.jpg',0,'2025-11-25 18:40:02','2025-11-25 18:40:02'),(16,14,'gerbang.jpg','dokumentasi/pAMQkWSHifS3Jd15mujfU75O28c1yUxhDUf1v6lI.jpg',0,'2025-11-25 18:57:00','2025-11-25 18:57:00');
/*!40000 ALTER TABLE `dokumentasi_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumentasis`
--

DROP TABLE IF EXISTS `dokumentasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dokumentasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tanggal_kegiatan` date NOT NULL,
  `kategori` enum('Upacara','Porseni','Study Tour','Pentas Seni','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumentasis_created_by_foreign` (`created_by`),
  CONSTRAINT `dokumentasis_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumentasis`
--

LOCK TABLES `dokumentasis` WRITE;
/*!40000 ALTER TABLE `dokumentasis` DISABLE KEYS */;
INSERT INTO `dokumentasis` VALUES (4,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:17:40','2025-11-25 18:17:40'),(5,'Halaman Sekolah',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:18:05','2026-11-09 19:09:53'),(7,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:20:01','2025-11-25 18:20:01'),(8,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:20:28','2025-11-25 18:20:28'),(11,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:26:27','2025-11-25 18:26:27'),(12,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:29:45','2025-11-25 18:29:45'),(13,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:40:02','2025-11-25 18:40:02'),(14,'Dokumentasi',NULL,'2025-11-26','Lainnya',4,'2025-11-25 18:57:00','2025-11-25 18:57:00');
/*!40000 ALTER TABLE `dokumentasis` ENABLE KEYS */;
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
-- Table structure for table `gurus`
--

DROP TABLE IF EXISTS `gurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gurus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gurus_nip_unique` (`nip`),
  KEY `gurus_user_id_foreign` (`user_id`),
  CONSTRAINT `gurus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gurus`
--

LOCK TABLES `gurus` WRITE;
/*!40000 ALTER TABLE `gurus` DISABLE KEYS */;
INSERT INTO `gurus` VALUES (1,3,'12155201220011','2025-11-23 00:38:43','2025-11-23 00:38:43'),(2,7,'199001012024121001','2026-11-09 18:24:36','2026-11-09 18:24:36');
/*!40000 ALTER TABLE `gurus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (1,'X IPA 1',NULL,'2025-11-23 00:34:47','2025-11-23 00:34:47');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mata_pelajarans`
--

DROP TABLE IF EXISTS `mata_pelajarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mata_pelajarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mata_pelajarans_kode_unique` (`kode`),
  KEY `mata_pelajarans_guru_id_foreign` (`guru_id`),
  CONSTRAINT `mata_pelajarans_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_pelajarans`
--

LOCK TABLES `mata_pelajarans` WRITE;
/*!40000 ALTER TABLE `mata_pelajarans` DISABLE KEYS */;
INSERT INTO `mata_pelajarans` VALUES (1,'Matematika','MAT001',1,'2025-11-23 00:39:11','2025-11-23 00:39:11');
/*!40000 ALTER TABLE `mata_pelajarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materi_pelajaran`
--

DROP TABLE IF EXISTS `materi_pelajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materi_pelajaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `mata_pelajaran_id` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `link_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_upload` date NOT NULL,
  `deadline` date DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materi_pelajaran_guru_id_foreign` (`guru_id`),
  KEY `materi_pelajaran_kelas_id_foreign` (`kelas_id`),
  KEY `materi_pelajaran_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  CONSTRAINT `materi_pelajaran_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `materi_pelajaran_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `materi_pelajaran_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materi_pelajaran`
--

LOCK TABLES `materi_pelajaran` WRITE;
/*!40000 ALTER TABLE `materi_pelajaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `materi_pelajaran` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_reset_tokens_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2025_11_09_115143_create_users_table',1),(5,'2025_11_09_115152_create_gurus_table',1),(6,'2025_11_09_115211_create_kelas_table',1),(7,'2025_11_09_115214_create_siswas_table',1),(8,'2025_11_09_115215_create_mata_pelajarans_table',1),(9,'2025_11_09_115216_create_absensis_table',1),(10,'2025_11_10_131222_create_materi_pelajaran_table',1),(11,'2025_11_13_144818_create_pengumumen_table',1),(12,'2025_11_17_152709_create_pesan_table',1),(13,'2025_11_26_020951_create_dokumentasis_table',2),(14,'2025_11_26_021017_create_dokumentasi_files_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengumumen`
--

DROP TABLE IF EXISTS `pengumumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengumumen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` enum('pengumuman','berita','event') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengumuman',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengumumen`
--

LOCK TABLES `pengumumen` WRITE;
/*!40000 ALTER TABLE `pengumumen` DISABLE KEYS */;
INSERT INTO `pengumumen` VALUES (1,'libur','hari ini libur karna hari minggu','pengumuman/WDHLoH6heeOSAvsTf5Ak4XAnBuBpADhRCRf1qOGt.jpg','pengumuman','2025-11-23','2025-11-23',1,0,'2025-11-22 23:58:26','2025-11-22 23:58:26'),(2,'HARI GURU NASIONAL','Semoga Semua Guru sehat dan diberkati selalu','pengumuman/A2cIsdpzvHZEDP4KpJRrqzpXJmEBTMpGvKJxiR7M.jpg','event','2025-11-25','2025-11-25',1,0,'2025-11-24 17:06:32','2025-11-24 17:06:32');
/*!40000 ALTER TABLE `pengumumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesan`
--

DROP TABLE IF EXISTS `pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pesan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('unread','read') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `tipe` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masuk',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesan`
--

LOCK TABLES `pesan` WRITE;
/*!40000 ALTER TABLE `pesan` DISABLE KEYS */;
INSERT INTO `pesan` VALUES (2,'Benino Koupun','benino@gmail.com','Bug','Kenapa terjadi bug pada sistemnya ?','read','masuk','2025-11-24 17:50:55','2025-11-24 18:08:58');
/*!40000 ALTER TABLE `pesan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswas`
--

DROP TABLE IF EXISTS `siswas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswas_nis_unique` (`nis`),
  KEY `siswas_user_id_foreign` (`user_id`),
  KEY `siswas_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswas`
--

LOCK TABLES `siswas` WRITE;
/*!40000 ALTER TABLE `siswas` DISABLE KEYS */;
INSERT INTO `siswas` VALUES (1,2,1,'1215520122','2025-11-23 00:36:29','2025-11-23 00:36:29'),(2,5,1,'123456789','2025-11-23 01:39:22','2025-11-23 01:39:22'),(3,6,1,'23443322','2025-11-24 17:52:21','2025-11-24 17:52:21');
/*!40000 ALTER TABLE `siswas` ENABLE KEYS */;
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'arnol','arnol@gmail.com',NULL,'$2y$12$CpyNnKG7OhqUrXS.vXJ7cO3OMVmPOEPIf.gatTdug1pbvYacxx02S','admin',NULL,NULL,NULL,NULL,NULL),(2,'marten','ateng@gmail.com',NULL,'$2y$12$8lGV5FH5WY7OFzpBSRrX5.QLgUAXkcKIrWJLJqdD5KNBnt88s/pyC','siswa','081341858387',NULL,NULL,'2025-11-23 00:36:29','2025-11-23 00:36:29'),(3,'Aris','aris@gmail.com',NULL,'$2y$12$f8iK395ipVEDjsDOby1q/.PS90sac0NSVBpdpn5r.ebPeNx19ihcy','guru','0813456789',NULL,NULL,'2025-11-23 00:38:43','2025-11-23 00:38:43'),(4,'Admin','admin@gmail.com',NULL,'$2y$12$jgmVbVhwqWbZ5OgVPJ5fMeMxXGZ3UjE3FUgg8zVSpmqoOMgxnypQ6','admin',NULL,NULL,NULL,NULL,NULL),(5,'Ilona','ilona@gmail.com',NULL,'$2y$12$rZinvvqy2RnSXh8.CNMxJOY7V8VU7cq91Va.elUtl.NFnk1mIrOnm','siswa','123456789',NULL,NULL,'2025-11-23 01:39:22','2025-11-23 01:39:22'),(6,'benino Koupun','benino@gmail.com',NULL,'$2y$12$OZNl.TI05oFtprkCM1aLTuOxJYptJZQjp1z6AnxVlEvmMgWRFoh8y','siswa','081243121852',NULL,NULL,'2025-11-24 17:52:21','2025-11-24 17:52:21'),(7,'arnol','arnl@gmail.com',NULL,'$2y$12$xYfbDAZ2Wmtxzqb4wSRPjucoCqB0GwvGgOtDeb.DGwzSmlLy1sTZu','guru','081243121852',NULL,NULL,'2026-11-09 18:24:36','2026-11-09 18:24:36');
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

-- Dump completed on 2026-11-10 12:44:02
