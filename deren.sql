/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : deren

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-07-07 13:58:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bigpho
-- ----------------------------
DROP TABLE IF EXISTS `bigpho`;
CREATE TABLE `bigpho` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '轮播图id',
  `pho_url` varchar(255) NOT NULL COMMENT '图片路径',
  `course_id` int(10) NOT NULL COMMENT '课程id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bigpho
-- ----------------------------

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(30) NOT NULL COMMENT '课时名',
  `class_time` varchar(30) NOT NULL COMMENT '上课时间',
  `class_add` varchar(255) NOT NULL COMMENT '上课地址',
  `course_id` int(10) NOT NULL COMMENT '课程id',
  `class_mins` varchar(30) NOT NULL COMMENT '课时长',
  `paixu` int(2) NOT NULL COMMENT '课节排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='课时表';

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES ('1', 'PS简介', '2016.07.1--15:00', '北京市', '1', '', '1');
INSERT INTO `class` VALUES ('2', 'PS简单应运', '2016.07.1--15:00', '北京市', '1', '', '2');
INSERT INTO `class` VALUES ('3', 'PS的基础进阶', '2016.07.1--15:00', '北京市', '1', '', '3');
INSERT INTO `class` VALUES ('4', 'PS的基础进阶', '2016.07.1--15:00', '北京市', '1', '', '4');
INSERT INTO `class` VALUES ('5', 'php简介', '2016.07.1--15:00', '北京市', '6', '3时30分', '1');
INSERT INTO `class` VALUES ('6', 'php简单应运', '2016.07.1--15:00', '北京市', '6', '3时30分', '2');
INSERT INTO `class` VALUES ('7', 'php基础进阶', '2016.07.1--15:00', '北京市', '2', '3时30分', '3');
INSERT INTO `class` VALUES ('8', 'php基础进阶', '2016.07.1--15:00', '北京市', '8', '3时30分', '4');

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(1) NOT NULL COMMENT '课程分类',
  `course_name` varchar(20) NOT NULL COMMENT '课程名',
  `course_photo` varchar(255) NOT NULL COMMENT '课程缩略图',
  `current_price` int(6) NOT NULL COMMENT '课程现价',
  `course_price` int(6) NOT NULL COMMENT '课程原价',
  `teach_name` varchar(20) NOT NULL COMMENT '老师名',
  `classtime` varchar(20) NOT NULL COMMENT '总课时',
  `offline_url` varchar(255) NOT NULL COMMENT '线下课图片路径',
  `video_url` varchar(255) NOT NULL COMMENT '音视频路径',
  `class_num` int(3) NOT NULL COMMENT '总课节',
  `addtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `status` int(1) NOT NULL COMMENT '是否已购买',
  `picture` text NOT NULL COMMENT '图文简介',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '122', '300', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '7', '2016-07-06 18:00:41', '0', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('2', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '4545', '5656', '王老师', '3时10分', '', 'video.mp4/video.webm', '4', '2016-07-06 18:00:56', '1', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('3', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '5500', '7000', '王老师', '2时10分', '', 'video.mp4/video.webm', '5', '2016-07-06 18:01:00', '0', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('4', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '200', '230', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '6', '2016-07-06 18:01:04', '1', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('5', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '500', '600', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '3', '2016-07-06 18:01:08', '0', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('6', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '700', '800', '王老师', '3时10分', '2016-05-27/20160527153420-8996.jpg', '', '6', '2016-07-06 17:35:05', '0', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('7', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '450', '500', '王老师', '3时10分', '', 'video.mp4/video.webm', '8', '2016-07-06 18:01:14', '0', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('8', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '350', '400', '王老师', '1时10分', '', 'video.mp4/video.webm', '2', '2016-07-06 18:01:16', '0', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');

-- ----------------------------
-- Table structure for ordera
-- ----------------------------
DROP TABLE IF EXISTS `ordera`;
CREATE TABLE `ordera` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordera_name` varchar(20) NOT NULL COMMENT '购买人',
  `ordera_mobi` varchar(11) NOT NULL COMMENT '购买人手机',
  `users_id` int(10) NOT NULL COMMENT '用户id',
  `course_id` int(10) NOT NULL COMMENT '课程id',
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '购买时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of ordera
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(26) NOT NULL COMMENT '密码',
  `user_mobi` varchar(11) NOT NULL COMMENT '用户手机',
  `logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '68053af2923e00204c3ca7c6a3', '13693251022', '2016-06-30 16:55:24');
INSERT INTO `users` VALUES ('2', '456', '18734832258', '2016-06-30 16:29:10');
