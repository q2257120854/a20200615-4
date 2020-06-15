/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : 0.0.0.0:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 01/03/2020 00:55:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `id` int(11) NOT NULL,
  `gg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rqek` int(32) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES (1, '需要包年或其它特殊服务请联系站长', 0);

-- ----------------------------
-- Table structure for gqdd
-- ----------------------------
DROP TABLE IF EXISTS `gqdd`;
CREATE TABLE `gqdd`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 582 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lpapi
-- ----------------------------
DROP TABLE IF EXISTS `lpapi`;
CREATE TABLE `lpapi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apiid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apipwd` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apitoken` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 0,
  `gqtime` int(2) NULL DEFAULT 3,
  `skewm` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wxskewm` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qqskewm` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dqtime` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `zfbt` int(1) NULL DEFAULT 0,
  `wxt` int(1) NULL DEFAULT NULL,
  `qqt` int(1) NULL DEFAULT NULL,
  `vip` int(1) NULL DEFAULT NULL,
  `zfbpid` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `apiid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 509 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lpapi
-- ----------------------------
INSERT INTO `lpapi` VALUES (508, '53120413209b4dc7a0ee9173af6f8232', '2e0c5ecbcc4554d11e81af80854606bb', NULL, 1, 3, NULL, NULL, NULL, '6901858983', 0, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for qq
-- ----------------------------
DROP TABLE IF EXISTS `qq`;
CREATE TABLE `qq`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeAmount` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeTime` datetime(0) NOT NULL,
  `qqn` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10121 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qqs
-- ----------------------------
DROP TABLE IF EXISTS `qqs`;
CREATE TABLE `qqs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `income` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `state` int(1) NULL DEFAULT NULL,
  `gu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24688 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `etime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '修改密码错误次数',
  `lpapi` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT 0 COMMENT '权限等级',
  `yqm` int(11) NULL DEFAULT NULL COMMENT '邀请人ID',
  `money` decimal(65, 2) NULL DEFAULT 0.00 COMMENT '钱包',
  `fx` int(11) NULL DEFAULT 0 COMMENT '返现次数',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_2`(`name`(191)) USING BTREE,
  FULLTEXT INDEX `name`(`name`)
) ENGINE = InnoDB AUTO_INCREMENT = 2371 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (0, '站长', 'admin@admin.com', '$2y$10$s2FZ7hCqejlF9jtdGoA2a.K.jHp/2ohiYagD.A8KIkBU9J.etKAR6', NULL, NULL, NULL, NULL, '53120413209b4dc7a0ee9173af6f8232', 1, NULL, 0.00, 0);

-- ----------------------------
-- Table structure for wx
-- ----------------------------
DROP TABLE IF EXISTS `wx`;
CREATE TABLE `wx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeAmount` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeTime` datetime(0) NOT NULL,
  `goodsTitle` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 90188 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wxs
-- ----------------------------
DROP TABLE IF EXISTS `wxs`;
CREATE TABLE `wxs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `income` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `state` int(1) NULL DEFAULT NULL,
  `gu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 246161 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for zfb
-- ----------------------------
DROP TABLE IF EXISTS `zfb`;
CREATE TABLE `zfb`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeNo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeAmount` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tradeTime` datetime(0) NOT NULL,
  `goodsTitle` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 47523 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for zfbs
-- ----------------------------
DROP TABLE IF EXISTS `zfbs`;
CREATE TABLE `zfbs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `income` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `state` int(1) NULL DEFAULT NULL,
  `gu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '通知地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112740 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
