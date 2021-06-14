-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: apptanya_db
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Table structure for table `b_user`
--

DROP TABLE IF EXISTS `b_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(78) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_user`
--

LOCK TABLES `b_user` WRITE;
/*!40000 ALTER TABLE `b_user` DISABLE KEYS */;
INSERT INTO `b_user` VALUES (1,'','drosanda@outlook.co.id','e10adc3949ba59abbe56e057f20f883e','Soreang','L'),(2,'Didin Jamaludin','didin@cenah.co.id','424b03fda56d63195b1c4944d6117ab5','Kp. Tegalkembang No 26 Rt 04 Rw 08 Kec. Kutawaringin Kab. Bandung Jawa Barat Indonesia (depan TK NURI)','L'),(3,'Ruli Royana Widuran','RuliRoyanaWidura@gmail.com','424b03fda56d63195b1c4944d6117ab5','Kp. Tegalkembang No 26 Rt 04 Rw 08 Kec. Kutawaringin Kab. Bandung Jawa Barat Indonesia (depan TK NURI)','L');
/*!40000 ALTER TABLE `b_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_tanya`
--

DROP TABLE IF EXISTS `c_tanya`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_tanya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_user_id_tanya` int(11) DEFAULT NULL,
  `b_user_id_jawab` int(11) DEFAULT NULL,
  `tanya` varchar(255) NOT NULL DEFAULT '',
  `tgl_tanya` datetime DEFAULT NULL,
  `jawab` varchar(255) NOT NULL,
  `tgl_jawab` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_b_user_id_tanya` (`b_user_id_tanya`),
  KEY `fk_b_user_id_jawab` (`b_user_id_jawab`),
  KEY `idx_tanya` (`tanya`),
  CONSTRAINT `c_tanya_ibfk_1` FOREIGN KEY (`b_user_id_jawab`) REFERENCES `b_user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `c_tanya_ibfk_2` FOREIGN KEY (`b_user_id_tanya`) REFERENCES `b_user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_tanya`
--

LOCK TABLES `c_tanya` WRITE;
/*!40000 ALTER TABLE `c_tanya` DISABLE KEYS */;
INSERT INTO `c_tanya` VALUES (1,1,NULL,'Dimanakah beli Lele?','2021-06-12 12:25:31','hade euy',NULL),(2,1,3,'Dimana kah beli Lele dumbo?','2021-06-12 12:25:29','Coba cari tempat penangkaran ikan disekitar daerah kamu. Biasanya ada yang suka ternak ikan. Tapi kemungkinan besar menjual juga Lele Dumbo','2021-06-12 23:34:11'),(3,1,NULL,'Siapakah Daeng Rosanda?','2021-06-12 22:47:05','',NULL),(4,1,NULL,'test','2021-06-12 22:48:20','',NULL),(5,1,NULL,'Siapakah Daeng Rosanda?','2021-06-12 22:48:37','',NULL),(6,1,NULL,'test','2021-06-12 22:49:09','',NULL),(7,1,1,'testing','2021-06-12 22:49:50','testong','2021-06-12 22:50:29'),(8,1,1,'Apakah kamu suka mencopet?','2021-06-12 22:51:15','tidak suka, takut sama Allah SWT','2021-06-12 22:52:05'),(9,1,1,'Siapakah nama asli Sule?','2021-06-12 23:06:40','Menurut buku Tatang Sutarman, nama asli Sule adalah Entis Sutisna','2021-06-12 23:07:14'),(10,1,1,'Siapakah Tatang Sutarman?','2021-06-12 23:10:36','Tatang Sutarman adalah penulis buku sejak tahun 1718 yang terdiri dari 14 Buku naskah sunda kuno','2021-06-12 23:11:51'),(11,1,1,'Sule lahir dimana?','2021-06-12 23:18:33','Saya tidak tahu pasti, tapi kalau tgl lahir yaitu pada 15 November 1976 di Cimahi','2021-06-12 23:19:37');
/*!40000 ALTER TABLE `c_tanya` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_notifikasi`
--

DROP TABLE IF EXISTS `d_notifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_user_id` int(11) DEFAULT NULL,
  `c_tanya_id` int(11) DEFAULT NULL,
  `isi` varchar(255) NOT NULL DEFAULT '',
  `is_read` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_b_user_id` (`b_user_id`),
  KEY `c_tanya_id` (`c_tanya_id`),
  CONSTRAINT `d_notifikasi_ibfk_1` FOREIGN KEY (`b_user_id`) REFERENCES `b_user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `d_notifikasi_ibfk_2` FOREIGN KEY (`c_tanya_id`) REFERENCES `c_tanya` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=34573 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_notifikasi`
--

LOCK TABLES `d_notifikasi` WRITE;
/*!40000 ALTER TABLE `d_notifikasi` DISABLE KEYS */;
INSERT INTO `d_notifikasi` VALUES (34568,1,8,'Telah dijawab! Pertanyaan ->Apakah kamu suka mencopet?',0),(34569,1,9,'Telah dijawab! Pertanyaan ->Siapakah nama asli Sule?',0),(34570,1,10,'Telah dijawab! Pertanyaan ->Siapakah Tatang Sutarman?',0),(34571,1,11,'Telah dijawab! \"Sule lahir dimana?\"',1),(34572,3,2,'Telah dijawab! \"Dimana kah beli Lele dumbo?\"',0);
/*!40000 ALTER TABLE `d_notifikasi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-14  8:26:31
