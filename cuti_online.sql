/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : 127.0.0.1:3306
 Source Schema         : cuti_online

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 07/08/2023 14:25:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jabatans
-- ----------------------------
DROP TABLE IF EXISTS `jabatans`;
CREATE TABLE `jabatans`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for level_users
-- ----------------------------
DROP TABLE IF EXISTS `level_users`;
CREATE TABLE `level_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of level_users
-- ----------------------------
INSERT INTO `level_users` VALUES (1, 'Admin', NULL, NULL);
INSERT INTO `level_users` VALUES (2, 'Karyawan', NULL, NULL);
INSERT INTO `level_users` VALUES (3, 'Pimpinan', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2018_08_16_082805_buat_tabel_level_user', 1);
INSERT INTO `migrations` VALUES (2, '2018_08_16_084222_buat_tabel_jabatan', 1);
INSERT INTO `migrations` VALUES (3, '2018_08_16_084634_buat_tabel_status_karyawan', 1);
INSERT INTO `migrations` VALUES (4, '2018_08_16_084653_buat_tabel_user', 1);
INSERT INTO `migrations` VALUES (5, '2018_08_16_090825_buat_tabel_jenis_cuti', 1);
INSERT INTO `migrations` VALUES (6, '2018_08_16_090942_buat_tabel_pengajuan', 1);

-- ----------------------------
-- Table structure for pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dari` date NULL DEFAULT NULL,
  `sampai` date NULL DEFAULT NULL,
  `tgl_dibuat` date NOT NULL,
  `keterangan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `pemohon_id` int(10) UNSIGNED NOT NULL,
  `penyetuju_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `jenis_cuti_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `tgl_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengajuans_pemohon_id_foreign`(`pemohon_id`) USING BTREE,
  INDEX `pengajuans_penyetuju_id_foreign`(`penyetuju_id`) USING BTREE,
  INDEX `pengajuans_jenis_cuti_id_foreign`(`jenis_cuti_id`) USING BTREE,
  CONSTRAINT `pengajuans_pemohon_id_foreign` FOREIGN KEY (`pemohon_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengajuans_penyetuju_id_foreign` FOREIGN KEY (`penyetuju_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan
-- ----------------------------
INSERT INTO `pengajuan` VALUES (3, NULL, NULL, '2023-08-06', 'asdasdasd', 0, 2, NULL, NULL, '2023-08-06 22:57:29', NULL, '2023-08-07 06:55:21', '07-08-2023, 08-08-2023, 09-08-2023, 10-08-2023, 11-08-2023');
INSERT INTO `pengajuan` VALUES (4, NULL, NULL, '2023-08-07', 'mau tidur', 0, 2, NULL, NULL, '2023-08-07 12:50:41', NULL, NULL, '08-08-2023, 09-08-2023, 10-08-2023');
INSERT INTO `pengajuan` VALUES (5, NULL, NULL, '2023-08-07', 'tes', 0, 2, NULL, NULL, '2023-08-07 12:52:08', NULL, NULL, '23-08-2023, 24-08-2023');

-- ----------------------------
-- Table structure for status_karyawans
-- ----------------------------
DROP TABLE IF EXISTS `status_karyawans`;
CREATE TABLE `status_karyawans`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status_karyawans
-- ----------------------------
INSERT INTO `status_karyawans` VALUES (1, 'aktif', NULL, NULL);
INSERT INTO `status_karyawans` VALUES (2, 'tidak aktif', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telpon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` smallint(6) NULL DEFAULT NULL,
  `jns_klmin` enum('PRIA','WANITA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NOT NULL DEFAULT '2001-01-01',
  `status_karyawan_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `jabatan_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_status_karyawan_id_foreign`(`status_karyawan_id`) USING BTREE,
  INDEX `users_jabatan_id_foreign`(`jabatan_id`) USING BTREE,
  INDEX `users_user_level_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `users_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_status_karyawan_id_foreign` FOREIGN KEY (`status_karyawan_id`) REFERENCES `status_karyawans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_user_level_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `level_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '69', 'tes', 'tes@tes.com', '$2a$10$cgOBflml5rFYqxj/dJuokeS5bYqMh9Zsu6C4duRpTdZCILCIKYqkq', 'a', '090', 1, 'PRIA', '2001-01-01', NULL, NULL, 1, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, '696969', 'Ananda Dewa', 'karyawan@gmail.com', '$2y$10$u4U8IkvCgXmhvugzrAa6SuppGGqU4fF/147oxhFb59BuWqBxozree', 'Pesona Laguna Cimanggis 2 Blok N6/4, kec Tapos\r\nBlok n6/4', '08119214977', NULL, NULL, '2001-01-01', NULL, NULL, 2, '2023-08-06 00:08:22', NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, '9998998', 'Rafi', 'atasan@mail.com', '$2y$10$XR7crQWcbJzAzhwqvq5bxOxfdkSVXp8CWz69T74xtcMSnolGZ1rh.', 'depok', '0982802820', NULL, NULL, '2001-01-01', NULL, NULL, 3, '2023-08-06 21:58:02', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
