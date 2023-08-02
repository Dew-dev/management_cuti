/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : fru

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 17/05/2023 15:24:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category_prod
-- ----------------------------
DROP TABLE IF EXISTS `category_prod`;
CREATE TABLE `category_prod`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category_prod
-- ----------------------------
INSERT INTO `category_prod` VALUES (1, 'Engine', 'Parts of Engine', NULL, '2022-11-18 13:48:17', NULL);
INSERT INTO `category_prod` VALUES (3, 'Body', 'Parts of Body', NULL, '2022-11-18 13:49:21', NULL);
INSERT INTO `category_prod` VALUES (4, 'Electrical', 'Parts of Electic', '2023-01-06 13:22:43', '2022-11-18 13:49:45', NULL);
INSERT INTO `category_prod` VALUES (5, 'Accessories', 'Acc', NULL, '2022-11-18 13:49:56', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `source_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `entry_price` int NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `base_price_product` int NULL DEFAULT NULL,
  `sell_price_product` int NULL DEFAULT NULL,
  `tax` int NULL DEFAULT NULL,
  `profit` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 3, 11, 2, 300000, '2023-01-06', NULL, 90000, NULL, 0, 120000, '2023-01-06 14:43:12', '2023-01-06 08:34:01', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (2, 3, 11, 2, 300000, '2023-01-07', NULL, 100000, NULL, 0, 100000, '2023-01-07 08:35:12', '2023-01-07 03:20:29', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (3, 3, 11, 4, 600000, '2023-01-07', NULL, 100000, NULL, 0, 200000, '2023-01-07 11:23:29', '2023-01-07 06:51:12', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (4, 3, 11, 5, 750000, '2023-01-07', NULL, 100000, 150000, 0, 250000, '2023-01-07 13:51:55', '2023-01-07 23:21:26', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (5, 3, 11, 1, 175000, '2022-12-08', NULL, NULL, 175000, 0, 50000, '2023-01-08 03:28:20', '2023-01-07 23:21:18', 'umarabd', 'rafifathur', 1);
INSERT INTO `orders` VALUES (6, 4, 9, 5, 800000, '2019-01-07', NULL, 120000, 165000, 25000, 200000, '2023-01-08 06:18:27', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (7, 3, 10, 3, 500000, '2019-01-24', NULL, 125000, 175000, 25000, 125000, '2023-01-08 06:19:04', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (8, 6, 9, 3, 380000, '2019-02-05', NULL, 90000, 130000, 10000, 110000, '2023-01-08 06:19:34', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (9, 5, 10, 4, 470000, '2019-02-20', NULL, 75000, 120000, 10000, 170000, '2023-01-08 06:20:10', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (10, 4, 9, 6, 950000, '2019-03-11', NULL, 120000, 165000, 40000, 230000, '2023-01-08 06:20:45', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (11, 3, 10, 7, 1200000, '2019-03-28', NULL, 125000, 175000, 25000, 325000, '2023-01-08 06:22:17', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (12, 6, 9, 4, 450000, '2019-04-03', NULL, 90000, 130000, 70000, 90000, '2023-01-08 06:23:25', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (13, 5, 9, 3, 350000, '2019-04-25', NULL, 75000, 120000, 10000, 125000, '2023-01-08 06:23:55', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (14, 4, 10, 5, 800000, '2019-05-12', NULL, 120000, 165000, 25000, 200000, '2023-01-08 06:24:25', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (15, 3, 9, 3, 450000, '2019-06-06', NULL, 125000, 175000, 75000, 75000, '2023-01-08 06:25:00', '2023-01-08 06:26:03', 'rafifathur', 'rafifathur', NULL);
INSERT INTO `orders` VALUES (16, 6, 9, 3, 350000, '2019-05-29', NULL, 90000, 130000, 40000, 80000, '2023-01-08 06:25:45', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (17, 4, 9, 7, 1100000, '2019-06-19', NULL, 120000, 165000, 55000, 260000, '2023-01-08 06:26:58', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (18, 6, 10, 1, 120000, '2019-07-04', NULL, 90000, 130000, 10000, -30000, '2023-01-08 06:28:31', '2023-01-07 23:32:16', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (19, 6, 9, 5, 600000, '2019-07-25', NULL, 90000, 130000, 50000, 150000, '2023-01-08 06:30:49', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (20, 6, 9, 1, 120000, '2019-07-10', NULL, 90000, 130000, 10000, 30000, '2023-01-08 06:33:08', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (21, 4, 9, 4, 600000, '2020-01-08', NULL, 120000, 165000, 60000, 120000, '2023-01-08 06:44:38', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (22, 3, 10, 5, 800000, '2020-01-28', NULL, 125000, 175000, 75000, 175000, '2023-01-08 06:48:35', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (23, 6, 10, 4, 470000, '2020-02-08', NULL, 90000, 130000, 50000, 110000, '2023-01-08 06:49:22', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (24, 3, 10, 5, 800000, '2020-02-27', NULL, 125000, 175000, 75000, 175000, '2023-01-08 06:49:46', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (25, 5, 9, 5, 550000, '2020-03-08', NULL, 75000, 120000, 50000, 175000, '2023-01-08 06:51:05', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (26, 3, 10, 4, 670000, '2020-03-31', NULL, 125000, 175000, 30000, 170000, '2023-01-08 06:52:06', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (27, 6, 9, 4, 495000, '2020-04-08', NULL, 90000, 130000, 25000, 135000, '2023-01-08 06:52:49', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (28, 4, 11, 5, 790000, '2020-04-30', NULL, 120000, 165000, 35000, 190000, '2023-01-08 06:53:25', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (29, 6, 9, 2, 240000, '2020-05-06', NULL, 90000, 130000, 20000, 60000, '2023-01-08 06:54:03', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (30, 3, 10, 6, 1000000, '2020-05-30', NULL, 125000, 175000, 50000, 250000, '2023-01-08 06:54:34', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (31, 7, 10, 2, 1500000, '2021-01-05', NULL, 350000, 800000, 100000, 800000, '2023-01-08 06:57:11', '2023-04-04 02:10:38', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (32, 3, 10, 4, 670000, '2021-01-19', NULL, 125000, 175000, 30000, 170000, '2023-01-08 06:57:58', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (33, 6, 9, 6, 700000, '2021-02-06', NULL, 90000, 130000, 80000, 160000, '2023-01-08 06:58:57', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (34, 7, 9, 3, 2350000, '2021-02-28', NULL, 350000, 800000, 50000, 1300000, '2023-01-08 07:00:09', '2023-04-04 02:10:30', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (35, 4, 9, 1, 150000, '2021-03-01', NULL, 120000, 165000, 15000, 30000, '2023-01-08 07:01:08', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (36, 3, 9, 3, 495000, '2023-03-25', NULL, 125000, 175000, 30000, 120000, '2023-01-08 07:01:42', '2023-01-08 00:03:31', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (37, 6, 9, 1, 200000, '2021-04-07', NULL, 90000, 130000, 0, 110000, '2023-01-08 07:02:28', '2023-01-08 07:03:40', 'rafifathur', 'rafifathur', NULL);
INSERT INTO `orders` VALUES (38, 6, 9, 2, 250000, '2021-04-30', NULL, 90000, 130000, 10000, 70000, '2023-01-08 07:04:04', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (39, 3, 10, 2, 360000, '2021-05-04', NULL, 125000, 175000, 0, 110000, '2023-01-08 07:04:23', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (40, 7, 9, 2, 1590000, '2021-05-27', NULL, 350000, 800000, 10000, 890000, '2023-01-08 07:04:51', '2023-04-04 02:10:19', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (41, 4, 9, 3, 500000, '2022-01-04', NULL, 120000, 165000, 0, 140000, '2023-01-08 07:05:14', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (42, 6, 10, 4, 500000, '2022-01-20', NULL, 90000, 130000, 20000, 140000, '2023-01-08 07:05:46', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (43, 7, 9, 1, 799000, '2022-02-03', NULL, 350000, 800000, 1000, 449000, '2023-01-08 07:06:10', '2023-04-04 02:10:16', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (44, 3, 9, 2, 320000, '2022-02-28', NULL, 125000, 175000, 30000, 70000, '2023-01-08 07:06:31', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (45, 5, 9, 2, 200000, '2022-03-06', NULL, 75000, 120000, 40000, 50000, '2023-01-08 07:08:29', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (46, 7, 9, 1, 850000, '2022-03-24', NULL, 350000, 800000, 0, 500000, '2023-01-08 07:08:51', '2023-04-04 02:10:13', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (47, 3, 9, 1, 160000, '2022-04-05', NULL, 125000, 175000, 15000, 35000, '2023-01-08 07:09:14', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (48, 6, 9, 2, 240000, '2022-04-28', NULL, 90000, 130000, 20000, 60000, '2023-01-08 07:10:04', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (49, 4, 10, 7, 1000000, '2022-05-06', NULL, 120000, 165000, 155000, 160000, '2023-01-08 07:10:33', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (50, 7, 9, 4, 3100000, '2022-05-31', NULL, 350000, 800000, 100000, 1700000, '2023-01-08 07:12:06', '2023-04-04 02:10:09', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (51, 6, 9, 5, 690000, '2023-01-06', NULL, 90000, 130000, 0, 240000, '2023-01-08 07:12:26', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (52, 4, 9, 1, 160000, '2023-05-06', NULL, 120000, 165000, 5000, 40000, '2023-04-04 10:57:01', '2023-05-06 11:46:47', 'rafifathur', 'rafifathur', 1);
INSERT INTO `orders` VALUES (53, 4, 9, 1, 130000, '2023-05-06', NULL, 120000, 165000, 35000, 10000, '2023-05-06 18:47:10', NULL, 'rafifathur', NULL, NULL);
INSERT INTO `orders` VALUES (54, 7, 9, 2, 1200000, '2023-04-01', NULL, 350000, 800000, 400000, 500000, '2023-05-06 18:48:18', NULL, 'rafifathur', NULL, NULL);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `base_price` int NULL DEFAULT NULL,
  `selling_price` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stock` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `upload` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (3, 'Cover Engine Vespa 3v Iget (1 Set)', 3, 4, 125000, 175000, 'Active', '100', NULL, '2022-12-10 03:58:44', '2023-01-08 07:09:36', NULL, 'A1231F/A1231B', 'rafifathur', 'rafifathur', NULL);
INSERT INTO `product` VALUES (4, 'Brake Cable Vespa 3v', 1, 4, 120000, 165000, 'Active', '55', '1672071720__93032919_aksisweepingfpiduaafp.jpg', '2022-12-10 21:56:32', '2023-05-06 18:47:10', NULL, 'A00001', 'rafifathur', 'rafifathur', NULL);
INSERT INTO `product` VALUES (5, 'Spakbor front List Bumper Lx Lxv S 125', 5, 1, 75000, 120000, 'Active', '56', NULL, '2023-01-08 05:54:18', '2023-01-08 07:08:29', NULL, 'B00001', 'rafifathur', 'rafifathur', NULL);
INSERT INTO `product` VALUES (6, 'SEAL SIL KRUK AS VESPA BESAR BAGIAN KANAN MAGNET', 1, 1, 90000, 130000, 'Active', '43', NULL, '2023-01-08 06:10:29', '2023-01-08 07:12:26', NULL, 'A00002', 'rafifathur', 'rafifathur', NULL);
INSERT INTO `product` VALUES (7, 'KARBU KARBURATOR VESPA SPACO DELLORTO 20 20 NOS', 1, 1, 350000, 800000, 'Active', '35', NULL, '2023-01-08 06:56:41', '2023-05-06 18:48:18', NULL, 'A00003', 'rafifathur', 'rafifathur', NULL);

-- ----------------------------
-- Table structure for source_payment
-- ----------------------------
DROP TABLE IF EXISTS `source_payment`;
CREATE TABLE `source_payment`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `source` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of source_payment
-- ----------------------------
INSERT INTO `source_payment` VALUES (9, 'Tokopedia', 'Online', '2022-11-18 13:22:20', '2022-11-18 13:17:12', NULL);
INSERT INTO `source_payment` VALUES (10, 'Shopee', 'Online', '2022-11-18 13:22:15', '2022-11-18 13:17:20', NULL);
INSERT INTO `source_payment` VALUES (11, 'Cash On Delivery', 'Non Online Store', '2022-11-18 13:29:28', '2022-11-18 13:17:32', NULL);

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'Vespa Orgin', 'Tangerang Selatan', NULL, '2022-11-18 13:27:04', NULL);
INSERT INTO `supplier` VALUES (4, '946 Store', 'Jakarta Selatan', '2022-11-20 11:42:02', '2022-11-20 11:41:29', NULL);
INSERT INTO `supplier` VALUES (5, 'Depok Street', NULL, NULL, '2022-12-26 15:17:56', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role_id` int NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Rafi FR', 'rafifathur.rahman20@gmail.com', NULL, '$2y$10$WuhaBsABM6rn0TFpTca.1uEsoZuGc0VHWNnAcfr.NLsdYszkDDDt6', NULL, '2022-12-02 00:49:19', '2023-04-04 09:18:42', 'rafifathur', '081364243280', 1, 'Depok, Indonesia', NULL);
INSERT INTO `users` VALUES (2, 'Fadhil MDA', 'fadhilmda@gmail.com', NULL, '$2y$10$Kr9IUWgDDSgH3hm49s1lMeCjblud0amepgc1Ixmemy.JpREhtxeZO', NULL, '2022-12-11 02:47:34', '2023-05-06 18:50:44', 'fadhilmda', '08123434555', 2, 'Condet', NULL);
INSERT INTO `users` VALUES (5, 'Umar', 'umarabd@gmail.com', NULL, '$2y$10$n75UDUDIBLb5vjEGrRhodOxqEDvPYSKA6djJk.l.UQmgiej4X4.xa', NULL, '2022-12-28 15:45:39', NULL, 'umarabd', '081364243280', 2, 'Selangor. Malaysia', NULL);

-- ----------------------------
-- Table structure for users_role
-- ----------------------------
DROP TABLE IF EXISTS `users_role`;
CREATE TABLE `users_role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users_role
-- ----------------------------
INSERT INTO `users_role` VALUES (1, 'Admin', 'user for admin role', NULL, '2022-11-20 13:09:55', NULL);
INSERT INTO `users_role` VALUES (2, 'User', NULL, NULL, '2022-12-11 02:46:46', NULL);

SET FOREIGN_KEY_CHECKS = 1;
