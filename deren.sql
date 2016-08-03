/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : deren

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-08-03 15:55:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dr_adminuser
-- ----------------------------
DROP TABLE IF EXISTS `dr_adminuser`;
CREATE TABLE `dr_adminuser` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dr_adminuser
-- ----------------------------
INSERT INTO `dr_adminuser` VALUES ('2', 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for dr_bills
-- ----------------------------
DROP TABLE IF EXISTS `dr_bills`;
CREATE TABLE `dr_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `course_id` int(11) NOT NULL COMMENT '课程id',
  `type` tinyint(1) DEFAULT NULL COMMENT '课程类型',
  `order_num` char(32) DEFAULT NULL COMMENT '订单号',
  `trade` char(64) DEFAULT NULL COMMENT '交易号',
  `user_name` varchar(20) DEFAULT NULL COMMENT '购买人',
  `user_phone` varchar(11) DEFAULT NULL COMMENT '购买人手机',
  `course_price` int(8) DEFAULT NULL COMMENT '付款金额',
  `pay_type` char(3) DEFAULT NULL COMMENT '支付类型',
  `status` int(1) DEFAULT NULL COMMENT '订单状态（支付状态）',
  `order_time` datetime DEFAULT NULL COMMENT '购买时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of dr_bills
-- ----------------------------

-- ----------------------------
-- Table structure for dr_class
-- ----------------------------
DROP TABLE IF EXISTS `dr_class`;
CREATE TABLE `dr_class` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NOT NULL COMMENT '课程id',
  `class_name` varchar(30) DEFAULT NULL COMMENT '课时名',
  `class_day` date DEFAULT NULL,
  `class_hour` tinyint(2) DEFAULT NULL COMMENT '上课时间',
  `class_min` tinyint(2) DEFAULT NULL,
  `assets_url` varchar(255) DEFAULT NULL COMMENT '视频、音频URL',
  `paixu` int(2) DEFAULT NULL COMMENT '课节排序',
  `adate` int(11) DEFAULT NULL,
  `udate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='课时表';

-- ----------------------------
-- Records of dr_class
-- ----------------------------

-- ----------------------------
-- Table structure for dr_class_img
-- ----------------------------
DROP TABLE IF EXISTS `dr_class_img`;
CREATE TABLE `dr_class_img` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '轮播图id',
  `class_id` int(10) NOT NULL COMMENT '课节ID',
  `course_id` int(11) NOT NULL COMMENT '课程ID',
  `pho_url` varchar(255) DEFAULT NULL COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='音频课图片';

-- ----------------------------
-- Records of dr_class_img
-- ----------------------------

-- ----------------------------
-- Table structure for dr_course
-- ----------------------------
DROP TABLE IF EXISTS `dr_course`;
CREATE TABLE `dr_course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(1) NOT NULL COMMENT '1：线下课，2：视频课，3：音频课',
  `course_name` char(30) DEFAULT NULL COMMENT '课程名',
  `course_photo` varchar(255) DEFAULT NULL COMMENT '课程缩略图',
  `current_price` int(6) DEFAULT NULL COMMENT '课程现价',
  `course_price` int(6) DEFAULT NULL COMMENT '课程原价',
  `teach_name` char(20) DEFAULT NULL COMMENT '老师名',
  `class_num` int(2) DEFAULT NULL COMMENT '课节数量',
  `class_time` char(20) DEFAULT NULL COMMENT '总课时',
  `picture` text COMMENT '图文简介',
  `status` int(1) DEFAULT NULL COMMENT '1：停用，2启用',
  `adate` int(11) DEFAULT NULL COMMENT '添加时间',
  `udate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of dr_course
-- ----------------------------

-- ----------------------------
-- Table structure for dr_users
-- ----------------------------
DROP TABLE IF EXISTS `dr_users`;
CREATE TABLE `dr_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_mobi` varchar(11) DEFAULT NULL COMMENT '用户手机',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `user_photo` varchar(255) DEFAULT NULL,
  `username` varchar(28) DEFAULT NULL COMMENT '用户名',
  `sex` int(1) DEFAULT NULL COMMENT '性别',
  `status` int(1) DEFAULT NULL COMMENT '用户状态',
  `logintime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of dr_users
-- ----------------------------
