/*
Navicat MySQL Data Transfer

Source Server         : my sql
Source Server Version : 100316
Source Host           : localhost:3306
Source Database       : kuro_drive

Target Server Type    : MYSQL
Target Server Version : 100316
File Encoding         : 65001

Date: 2020-06-17 17:21:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_file
-- ----------------------------
DROP TABLE IF EXISTS `log_file`;
CREATE TABLE `log_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_file
-- ----------------------------
INSERT INTO `log_file` VALUES ('1');
INSERT INTO `log_file` VALUES ('2');
INSERT INTO `log_file` VALUES ('3');
INSERT INTO `log_file` VALUES ('4');
INSERT INTO `log_file` VALUES ('5');
INSERT INTO `log_file` VALUES ('6');
INSERT INTO `log_file` VALUES ('7');
INSERT INTO `log_file` VALUES ('8');
INSERT INTO `log_file` VALUES ('9');
INSERT INTO `log_file` VALUES ('10');
INSERT INTO `log_file` VALUES ('11');
INSERT INTO `log_file` VALUES ('12');
INSERT INTO `log_file` VALUES ('13');
INSERT INTO `log_file` VALUES ('14');
INSERT INTO `log_file` VALUES ('15');
INSERT INTO `log_file` VALUES ('16');
INSERT INTO `log_file` VALUES ('17');
INSERT INTO `log_file` VALUES ('18');
INSERT INTO `log_file` VALUES ('19');
INSERT INTO `log_file` VALUES ('20');

-- ----------------------------
-- Table structure for tbl_file
-- ----------------------------
DROP TABLE IF EXISTS `tbl_file`;
CREATE TABLE `tbl_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `file_realname` varchar(500) DEFAULT NULL,
  `file_size` double DEFAULT NULL,
  `file_create` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_folder` int(11) DEFAULT NULL,
  `file_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_file
-- ----------------------------
INSERT INTO `tbl_file` VALUES ('2', 'up001/eccbc87e4b5ce2fe28308fd9f2a7baf31.png', 'page-not-found.png', '30839', '2020-04-03 19:11:56', '1', null, 'eccbc87e4b5ce2fe28308fd9f2a7baf31');
INSERT INTO `tbl_file` VALUES ('3', 'up001/a87ff679a2f3e71d9181a67b7542122c1.jpg', 'lcd i2c.jpg', '87381', '2020-04-03 19:14:28', '1', null, 'a87ff679a2f3e71d9181a67b7542122c1');
INSERT INTO `tbl_file` VALUES ('11', 'up001/45c48cce2e2d7fbdea1afc51c7c6ad261.mp4', '2020-04-01-1421-39.mp4', '2477735', '2020-04-05 04:52:52', '1', null, '45c48cce2e2d7fbdea1afc51c7c6ad261');

-- ----------------------------
-- Table structure for tbl_folder
-- ----------------------------
DROP TABLE IF EXISTS `tbl_folder`;
CREATE TABLE `tbl_folder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `folder_name` varchar(255) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_folder
-- ----------------------------
INSERT INTO `tbl_folder` VALUES ('6', '2', 'Folder Aja', null);
INSERT INTO `tbl_folder` VALUES ('8', '1', 'folder 1', null);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'Agung', 'jojo', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `tbl_user` VALUES ('2', 'Jaja', 'jaja', 'e10adc3949ba59abbe56e057f20f883e');
SET FOREIGN_KEY_CHECKS=1;
