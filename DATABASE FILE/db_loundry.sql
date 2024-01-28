/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80031
 Source Host           : localhost:3306
 Source Schema         : putri_laundry

 Target Server Type    : MySQL
 Target Server Version : 80031
 File Encoding         : 65001

 Date: 20/11/2023 15:23:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `karyawan_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_karyawan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jeniskelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gaji_perbulan` int NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `tgl_berhenti` date NOT NULL,
  `aktif` int NOT NULL,
  PRIMARY KEY (`karyawan_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES ('K-16529875421671043159', 'gempi', 'Female', 'gobah', '081340720044', 0, '0000-00-00', '0000-00-00', 1);

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pelanggan_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pelanggan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jeniskelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pelanggan_id`) USING BTREE,
  UNIQUE INDEX `UNIQUE`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES (26, 'P-10543799151671043036', 'tatang', 'Male', 'purwodadi', '0813407210123');
INSERT INTO `pelanggan` VALUES (27, 'P-6528569571671043081', 'kalfi', 'Male', 'sm amin', '081397494455');

-- ----------------------------
-- Table structure for t_hargakiloan
-- ----------------------------
DROP TABLE IF EXISTS `t_hargakiloan`;
CREATE TABLE `t_hargakiloan`  (
  `id_kilo` int NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` double NULL DEFAULT NULL,
  PRIMARY KEY (`id_kilo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hargakiloan
-- ----------------------------
INSERT INTO `t_hargakiloan` VALUES (1, 'cuci', 5000);
INSERT INTO `t_hargakiloan` VALUES (3, 'cuci & gosok', 6000);
INSERT INTO `t_hargakiloan` VALUES (6, 'jas', 30000);
INSERT INTO `t_hargakiloan` VALUES (7, 'bed cover', 45000);

-- ----------------------------
-- Table structure for t_hargasatuan
-- ----------------------------
DROP TABLE IF EXISTS `t_hargasatuan`;
CREATE TABLE `t_hargasatuan`  (
  `id_satuan` int NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`id_satuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hargasatuan
-- ----------------------------
INSERT INTO `t_hargasatuan` VALUES (3, 'Seprei bantal', 7000);
INSERT INTO `t_hargasatuan` VALUES (4, 'Jas', 30000);
INSERT INTO `t_hargasatuan` VALUES (6, 'Handuk', 7000);

-- ----------------------------
-- Table structure for t_layanan
-- ----------------------------
DROP TABLE IF EXISTS `t_layanan`;
CREATE TABLE `t_layanan`  (
  `id_layanan` int NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`id_layanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_layanan
-- ----------------------------
INSERT INTO `t_layanan` VALUES (1, 'Express', 2);
INSERT INTO `t_layanan` VALUES (3, 'Reguler', 1);

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `transaksi_id` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pelanggan_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `karyawan_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `diskon` float NOT NULL,
  `berat` int NULL DEFAULT NULL,
  `item_satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `layanan_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `layanan_kiloan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_layanan` enum('kiloan','satuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total` int NOT NULL,
  `status` enum('menunggu','dikerjakan','selesai','diantar','sampai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_order` date NOT NULL,
  `tgl_selesai` date NULL DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('20231117213200', 'P-10543799151671043036', 'K-16529875421671043159', 0, 1, NULL, '3', '1', 'satuan', 5000, 'menunggu', '2023-11-17', '2023-11-17');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namauser` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` char(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('U001', 'admin utama', 'admin', '3d0fc5b8104205415d090df2cc9dda9b', 'f0961185368be4d7e26423b87e4faebf9c435dec38b2', 'superuser');
INSERT INTO `user` VALUES ('U002', 'gempi unyu', 'gempi', 'f52c14c84c68842d8179a935db207efd', 'fe887d934dbec5543e29fba4e43c74a15b447108cacf', 'superuser');
INSERT INTO `user` VALUES ('U003', 'aku', 'sedang', '70204bc0f5bfb41c0e30c5bdadbe33cb', 'c6fd24ba27548fb9f84137a575fc798d72ef7b8b2cca', 'superuser');
INSERT INTO `user` VALUES ('U004', 'cimin cimin', 'cimin', '970588d80ea68761393ba610121f3ac5', '23039f2e93d5c28b05b03d83719ea5c6e3f8b98eb948', 'superuser');
INSERT INTO `user` VALUES ('U005', 'lutfi prayogo', 'lutfi123', '7bb2dd8debbd6b3d97e753c06e21b2d7', 'ec9a7d55c2716c1144d88002437a5721d8eb2d8beccd', 'superuser');

SET FOREIGN_KEY_CHECKS = 1;
