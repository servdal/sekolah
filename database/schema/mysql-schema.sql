/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `admin_firebase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_firebase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `firebase` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `sequence` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `is_visible` int DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domainapps` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subdomainapps` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subsubdomainapps` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressapps` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailapps` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logofrontapps` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bs_banksoal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bs_banksoal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullkode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceel` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `deskripsitambahan` text COLLATE utf8mb4_unicode_ci,
  `lampiran` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran2` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran3` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran4` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran5` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran6` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opsia` text COLLATE utf8mb4_unicode_ci,
  `opsib` text COLLATE utf8mb4_unicode_ci,
  `opsic` text COLLATE utf8mb4_unicode_ci,
  `opsid` text COLLATE utf8mb4_unicode_ci,
  `opsie` text COLLATE utf8mb4_unicode_ci,
  `kunci` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int DEFAULT NULL,
  `inputor` text COLLATE utf8mb4_unicode_ci,
  `view` int DEFAULT NULL,
  `nilai01` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai02` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan01` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan02` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesimpulan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_by` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakpanjang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bs_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bs_test` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ceel` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namaujian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idsupervisor` int DEFAULT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idsoal` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `pengumuman` int DEFAULT NULL,
  `mulai` timestamp NULL DEFAULT NULL,
  `selesai` timestamp NULL DEFAULT NULL,
  `timer` int DEFAULT NULL,
  `marking` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bs_ujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bs_ujian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ceel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `namaujian` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idmahasiswa` int DEFAULT NULL,
  `idtest` int DEFAULT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idsoal` int DEFAULT NULL,
  `urutan` int DEFAULT NULL,
  `jawaban` text COLLATE utf8mb4_unicode_ci,
  `kunci` text COLLATE utf8mb4_unicode_ci,
  `skore` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengumuman` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ch_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ch_favorites` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ch_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ch_messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_absenprogrampip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_absenprogrampip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idsekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_allstaf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_allstaf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttl` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nuptk` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `niy` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelamin` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ijasah` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statpeg` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notelp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klsajar` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smt` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tapel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_banksoalpeserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_banksoalpeserta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomorpeserta` int DEFAULT NULL,
  `idpeserta` int DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelompok` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hape` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamatasal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgllahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rotasi` int DEFAULT NULL,
  `ceel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `namaujian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mulai` timestamp NULL DEFAULT NULL,
  `akhir` timestamp NULL DEFAULT NULL,
  `timer` int DEFAULT NULL,
  `marking` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countmcq` int DEFAULT NULL,
  `countesai` int DEFAULT NULL,
  `countmultiesai` int DEFAULT NULL,
  `countlabeled` int DEFAULT NULL,
  `countyesno` int DEFAULT NULL,
  `skoremcq` decimal(11,2) DEFAULT NULL,
  `skoreesai` decimal(11,2) DEFAULT NULL,
  `skoremultiesai` decimal(11,2) DEFAULT NULL,
  `skorelabeled` decimal(11,2) DEFAULT NULL,
  `skoreyesno` decimal(11,2) DEFAULT NULL,
  `oral01` decimal(11,2) DEFAULT NULL,
  `oral02` decimal(11,2) DEFAULT NULL,
  `oral03` decimal(11,2) DEFAULT NULL,
  `oral04` decimal(11,2) DEFAULT NULL,
  `oral05` decimal(11,2) DEFAULT NULL,
  `totalskore` decimal(11,2) DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_beasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_beasiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noinduk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tapel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namabeasiswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  `inputor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmfile` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sekolah` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_datainduk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_datainduk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noinduk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmplahir` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgllahir` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `darah` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` int NOT NULL,
  `tinggi` int NOT NULL,
  `alamatortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kerjaayah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kerjaibu` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaanwali` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `klspos` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamasuk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hape` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mutasi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodepos` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `erte` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `erwe` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nokelulusan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodeortu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `jilid` int DEFAULT NULL,
  `is_asuh` int DEFAULT NULL,
  `kodeortuasuh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglkesediaan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttdoratuasuh` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_ekskul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_ekskul` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_formulirpsb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_formulirpsb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tapel` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_insidental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_insidental` (
  `id` int NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` int NOT NULL,
  `bataswaktu` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktifasi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_kd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_kd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `semester` int NOT NULL,
  `kelas` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `muatan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodekd` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kkm` int DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` int NOT NULL,
  `subtema` int NOT NULL,
  `deskripsitema` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `matpel` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_keuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_keuangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` int NOT NULL,
  `bulan` int NOT NULL,
  `tahun` year NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemasukan` int NOT NULL,
  `pengeluaran` int NOT NULL,
  `realnominal` int DEFAULT NULL,
  `realjenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bendahara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglkwitansi` date DEFAULT NULL,
  `tandatangan` longtext COLLATE utf8mb4_unicode_ci,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_kkm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_kkm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matpel` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `muatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kitiga` int NOT NULL,
  `kiempat` int NOT NULL,
  `id_sekolah` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_konseling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_konseling` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noinduk` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tglmasalah` date NOT NULL,
  `jenis` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglpenanganan` date DEFAULT NULL,
  `layanan` text COLLATE utf8mb4_unicode_ci,
  `tindaklanjut` text COLLATE utf8mb4_unicode_ci,
  `hasil` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guru` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_layanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `layanan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_loginputnilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_loginputnilai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `niy` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tema` int NOT NULL,
  `subtema` int NOT NULL,
  `matpel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodekd` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jennilai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int NOT NULL,
  `marking` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_logstaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_logstaff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sopo` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelakuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_mstsekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_mstsekolah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `domain` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_yayasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int DEFAULT NULL COMMENT '1:tk,2:sd,3:smp,4:smu',
  `nama_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_sekolah` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nss` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npsn` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kepala_sekolah` int DEFAULT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_grey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontpage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `pendaftaran` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengumuman` mediumtext COLLATE utf8mb4_unicode_ci,
  `no_rek` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_rek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_bank_rek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_mulok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_mulok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_mutasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_mutasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinduk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapel` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdtujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_nilai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noinduk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtema` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodekd` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `matpel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kkm` int DEFAULT NULL,
  `id_sekolah` int DEFAULT NULL,
  `penginput` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jennilai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_pelengkappsb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_pelengkappsb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `niksiswa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panggilan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warga` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bahasa` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyakit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anakke` int NOT NULL,
  `kandung` int NOT NULL,
  `tiri` int NOT NULL,
  `angkat` int NOT NULL,
  `jarak` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bersama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pibu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gayah` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gibu` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aayah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aaibu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hayah` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hibu` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agamawali` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hwali` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kwali` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubwali` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamattk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pindahasal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pindahkelas` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pindahtgl` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pindahkekls` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester1` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester3` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester4` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester5` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesulitan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggotarumah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatansendiri` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telinga` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wajah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gybljr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bakat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumberinfo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prestasi1` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prestasi2` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prestasi3` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prestasi4` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scanakta` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scanfoto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scankk` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scanket` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scanbukti` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinduk` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` int NOT NULL,
  `bulan` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verifikasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harian` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inputor` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buktibayar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_pembayaranzis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_pembayaranzis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namawali` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hape` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namasiswa` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jeniszakat` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orang` int NOT NULL,
  `nominal` decimal(11,2) DEFAULT NULL,
  `zakatmaal` int DEFAULT NULL,
  `donasi` int DEFAULT NULL,
  `validator` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglvalidasi` date DEFAULT NULL,
  `namafile` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_peminjamanbuku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_peminjamanbuku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodebuku` int DEFAULT NULL,
  `pengarang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerbit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglpinjam` date DEFAULT NULL,
  `tglkembali` date NOT NULL,
  `biaya` int NOT NULL,
  `denda` int NOT NULL,
  `peminjam` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinduk` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_pengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_pengumuman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siapa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengumuman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  `fakultas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_perpustakaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_perpustakaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodebuku` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengarang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cetakan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerbit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `ilustrasi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `halaman` int DEFAULT NULL,
  `id_sekolah` int DEFAULT NULL,
  `isbn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglmasuk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahunperolehan` year DEFAULT NULL,
  `jenisperolehan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rakbuku` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_presensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_presensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `noinduk` int NOT NULL,
  `tapel` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `alasan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selama` int NOT NULL,
  `surat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_presensiekskul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_presensiekskul` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `noinduk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapel` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `alasan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selama` int NOT NULL,
  `surat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_prestasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_prestasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namakegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juara` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapel` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinduk` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namafile` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_programpip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_programpip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idsekolah` int DEFAULT NULL,
  `datamasuk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelaslama` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelasbaru` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahap` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `norek` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `virtualacc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_psb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_psb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` year NOT NULL,
  `kodependaf` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodepsb` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmplahir` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgllahir` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `darah` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamatortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kerjaayah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kerjaibu` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaanwali` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamasuk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hape` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mutasi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodepos` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `erte` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `erwe` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n1` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n2` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n3` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n4` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n5` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n6` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n7` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n8` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n9` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n10` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n11` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n12` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n13` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rata` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akhirumum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nosurat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des1` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des2` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des3` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des4` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des5` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des6` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des7` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `des8` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dana1` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dana2` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dana3` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dana4` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_rapotan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_rapotan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NOMOR` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NAMA` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NISN` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NAMASD` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ALAMAT` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KELAS` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SEMESTER` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TAPEL` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `JENIS` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SSP` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DES` text COLLATE utf8mb4_unicode_ci,
  `SS` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DES2` text COLLATE utf8mb4_unicode_ci,
  `PAI3` int DEFAULT NULL,
  `H` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D` text COLLATE utf8mb4_unicode_ci,
  `PAI4` int DEFAULT NULL,
  `H2` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D2` text COLLATE utf8mb4_unicode_ci,
  `PPKN3` int DEFAULT NULL,
  `H3` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D3` text COLLATE utf8mb4_unicode_ci,
  `PPKN4` int DEFAULT NULL,
  `H4` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D4` text COLLATE utf8mb4_unicode_ci,
  `BI3` int DEFAULT NULL,
  `H5` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D5` text COLLATE utf8mb4_unicode_ci,
  `BI4` int DEFAULT NULL,
  `H6` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D6` text COLLATE utf8mb4_unicode_ci,
  `MAT3` int DEFAULT NULL,
  `H7` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D7` text COLLATE utf8mb4_unicode_ci,
  `MAT4` int DEFAULT NULL,
  `H8` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D8` text COLLATE utf8mb4_unicode_ci,
  `IPA3` int DEFAULT NULL,
  `H9` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D9` text COLLATE utf8mb4_unicode_ci,
  `IPA4` int DEFAULT NULL,
  `H10` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D10` text COLLATE utf8mb4_unicode_ci,
  `IPS3` int DEFAULT NULL,
  `H11` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D11` text COLLATE utf8mb4_unicode_ci,
  `IPS4` int DEFAULT NULL,
  `H12` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D12` text COLLATE utf8mb4_unicode_ci,
  `SBDP3` int DEFAULT NULL,
  `H13` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D13` text COLLATE utf8mb4_unicode_ci,
  `SBDP4` int DEFAULT NULL,
  `H14` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D14` text COLLATE utf8mb4_unicode_ci,
  `PJOK3` int DEFAULT NULL,
  `H15` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D15` text COLLATE utf8mb4_unicode_ci,
  `PJOK4` int DEFAULT NULL,
  `H16` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D16` text COLLATE utf8mb4_unicode_ci,
  `BJ3` int DEFAULT NULL,
  `H17` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D17` text COLLATE utf8mb4_unicode_ci,
  `BJ4` int DEFAULT NULL,
  `H18` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D18` text COLLATE utf8mb4_unicode_ci,
  `BING3` int DEFAULT NULL,
  `H19` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D19` text COLLATE utf8mb4_unicode_ci,
  `BING4` int DEFAULT NULL,
  `H20` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D20` text COLLATE utf8mb4_unicode_ci,
  `BA3` int DEFAULT NULL,
  `H21` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D21` text COLLATE utf8mb4_unicode_ci,
  `BA4` int DEFAULT NULL,
  `H22` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D22` text COLLATE utf8mb4_unicode_ci,
  `TIK3` int DEFAULT NULL,
  `H23` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D23` text COLLATE utf8mb4_unicode_ci,
  `TIK4` int DEFAULT NULL,
  `H24` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `D24` text COLLATE utf8mb4_unicode_ci,
  `EKS` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `K` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EKS2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `K2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EKS3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `K3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EKS4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `K4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EKS5` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `K5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SARAN` text COLLATE utf8mb4_unicode_ci,
  `total` int DEFAULT NULL,
  `jumlahmatpel` int DEFAULT NULL,
  `ratarata` decimal(11,2) DEFAULT NULL,
  `rangking` int DEFAULT NULL,
  `TBS1` decimal(11,2) DEFAULT NULL,
  `TBS2` decimal(11,2) DEFAULT NULL,
  `BBS1` decimal(11,2) DEFAULT NULL,
  `BBS2` decimal(11,2) DEFAULT NULL,
  `KETPD` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KETPL` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KETGG` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KETL` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRETASI1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KET` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRETASI2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KET2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRETASI3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KET3` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRETASI4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KET4` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SAKIT` int DEFAULT NULL,
  `IZIN` int DEFAULT NULL,
  `TANPA` int DEFAULT NULL,
  `TGLRAPOR` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GURUKLS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIPGURU` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KASEK` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIPKASEK` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KEPUTUSAN` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NAIK` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marking` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `markirim` date NOT NULL,
  `markcetak` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_saldotahunan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_saldotahunan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` year NOT NULL,
  `jenis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` int NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_setkeuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_setkeuangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinduk` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dpp` int NOT NULL,
  `spp` int NOT NULL,
  `paguyuban` int NOT NULL,
  `eksul1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pramuka',
  `eksul2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eksul3` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eksul4` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eksul5` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_tabungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_tabungan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noinduk` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debet` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kredit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inputor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_tema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temake` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtemake` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtema` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `db_tesppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `db_tesppdb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hari` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `ruang` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mushaf_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mushaf_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `surah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `makna` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mushaf_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mushaf_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `inputor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinduk` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tapel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int NOT NULL,
  `jilid` int NOT NULL,
  `tanggal` date NOT NULL,
  `ziyadah_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ziyadah_mulaisurah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ziyadah_mulaiayat` int DEFAULT NULL,
  `ziyadah_akhirsurah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ziyadah_akhirayat` int DEFAULT NULL,
  `adab_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adab_uraian` mediumtext COLLATE utf8mb4_unicode_ci,
  `fiqih_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fiqih_uraian` mediumtext COLLATE utf8mb4_unicode_ci,
  `murojaah_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `murojaah_mulaisurah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `murojaah_mulaiayat` int DEFAULT NULL,
  `murojaah_akhirsurah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `murojaah_akhirayat` int DEFAULT NULL,
  `akidah_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akidah_uraian` mediumtext COLLATE utf8mb4_unicode_ci,
  `lifeskil_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lifeskil_uraian` mediumtext COLLATE utf8mb4_unicode_ci,
  `literasi_tanggal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `literasi_uraian` mediumtext COLLATE utf8mb4_unicode_ci,
  `marking` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pesan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pesannya` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelompok` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sekolah` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yayasan` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepalasekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `katamutiara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendaftaran` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengumuman` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbl_komplain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_komplain` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dari` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hostname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statuser` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepada` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isikeluhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggapan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenfile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_bukutamu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_bukutamu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hape` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pejabat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sekolah` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_fasilitasruang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_fasilitasruang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idruang` int NOT NULL,
  `namabrg` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahunterima` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumberdana` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodebarang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_garasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_garasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namagd` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singgd` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodegd` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakpanjang` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_gedung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_gedung` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namagd` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singgd` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodegd` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pjgedung` int DEFAULT NULL,
  `statpinjam` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif` int DEFAULT NULL,
  `kapasitas` int NOT NULL DEFAULT '0',
  `luas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakpanjang` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_jadwal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenisjadwal` int NOT NULL DEFAULT '0',
  `ruang` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmgedung` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmruang` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gedung` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hape` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglmulai` date DEFAULT NULL,
  `tglakhir` date DEFAULT NULL,
  `jammulai` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jamakhir` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mulai` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `akhir` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `peminjam` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Universitas Brawijaya',
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `suratpermohonan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inputor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` int DEFAULT NULL,
  `buktibayar` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idsurat` int DEFAULT NULL,
  `marking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakpanjang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_kendaraan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_kendaraan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `merek` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodegarasi` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodekendaraan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nopol` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinjam` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Terawat',
  `utilitas` int NOT NULL DEFAULT '40',
  `pjgedung` int DEFAULT NULL,
  `statpinjam` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif` int DEFAULT NULL,
  `fakpanjang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_kendaraanactivity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_kendaraanactivity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idkendaraan` int DEFAULT NULL,
  `merek` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nopol` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nominal` decimal(11,2) DEFAULT NULL,
  `keterangan` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `umum_ruang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umum_ruang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namarg` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namagd` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodegd` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `koderg` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marking` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitasujian` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Terawat',
  `utilitas` int NOT NULL DEFAULT '40',
  `pinjam` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak di Sewa/Pinjamkan',
  `pjgedung` int NOT NULL DEFAULT '0',
  `tarif` int NOT NULL DEFAULT '0',
  `fakpanjang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previlage` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci,
  `fakultas` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakpanjang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merangkap` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` bigint DEFAULT NULL,
  `golongan` int DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesial` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tandatangan` longtext COLLATE utf8mb4_unicode_ci,
  `paraf` longtext COLLATE utf8mb4_unicode_ci,
  `firebaseid` longtext COLLATE utf8mb4_unicode_ci,
  `photo` longtext COLLATE utf8mb4_unicode_ci,
  `klsajar` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smt` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tapel` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sekolah` int DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `webinar_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `webinar_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `mulai` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `akhir` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `bayar` int DEFAULT NULL,
  `kontak` text COLLATE utf8mb4_unicode_ci,
  `pembicara` text COLLATE utf8mb4_unicode_ci,
  `daftarmulai` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `daftarakhir` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `absenmulai` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `absenakhir` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkwebniar` text COLLATE utf8mb4_unicode_ci,
  `linkmateri` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sertifikatdepan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sertifikatbelakang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `webinar_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `webinar_jawaban` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idevent` int NOT NULL,
  `idpeserta` int NOT NULL,
  `satu` int DEFAULT NULL,
  `dua` int DEFAULT NULL,
  `tiga` int DEFAULT NULL,
  `empat` int DEFAULT NULL,
  `lima` int DEFAULT NULL,
  `enam` int DEFAULT NULL,
  `tujuh` text COLLATE utf8mb4_unicode_ci,
  `saran` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `webinar_participan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `webinar_participan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idevent` int NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instansi` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namabank` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `norek` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hape` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar` timestamp NULL DEFAULT NULL,
  `quiz` timestamp NULL DEFAULT NULL,
  `presensi` timestamp NULL DEFAULT NULL,
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar` int NOT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (3,'2016_06_01_000001_create_oauth_auth_codes_table',1);
INSERT INTO `migrations` VALUES (4,'2016_06_01_000002_create_oauth_access_tokens_table',1);
INSERT INTO `migrations` VALUES (5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1);
INSERT INTO `migrations` VALUES (6,'2016_06_01_000004_create_oauth_clients_table',1);
INSERT INTO `migrations` VALUES (7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1);
INSERT INTO `migrations` VALUES (8,'0001_01_01_000000_create_users_table',2);
INSERT INTO `migrations` VALUES (9,'0001_01_01_000001_create_cache_table',2);
INSERT INTO `migrations` VALUES (10,'0001_01_01_000002_create_jobs_table',2);
INSERT INTO `migrations` VALUES (11,'2024_05_06_999999_add_active_status_to_users',3);
INSERT INTO `migrations` VALUES (12,'2024_05_06_999999_add_avatar_to_users',3);
INSERT INTO `migrations` VALUES (13,'2024_05_06_999999_add_dark_mode_to_users',3);
INSERT INTO `migrations` VALUES (14,'2024_05_06_999999_add_messenger_color_to_users',3);
INSERT INTO `migrations` VALUES (15,'2024_05_06_999999_create_chatify_favorites_table',3);
INSERT INTO `migrations` VALUES (16,'2024_05_06_999999_create_chatify_messages_table',3);
