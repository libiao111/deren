/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : deren

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-07-12 15:49:48
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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bigpho
-- ----------------------------
INSERT INTO `bigpho` VALUES ('1', '2016-05-27/20160527153420-8996.jpg', '1');
INSERT INTO `bigpho` VALUES ('2', '2016-05-27/20160527153420-8996.jpg', '1');
INSERT INTO `bigpho` VALUES ('3', '2016-05-27/20160527153420-8996.jpg', '1');
INSERT INTO `bigpho` VALUES ('4', '2016-05-27/20160527153420-8996.jpg', '1');
INSERT INTO `bigpho` VALUES ('5', '2016-05-27/20160527153420-8996.jpg', '2');
INSERT INTO `bigpho` VALUES ('6', '2016-05-27/20160527153420-8996.jpg', '3');
INSERT INTO `bigpho` VALUES ('7', '2016-05-27/20160527153420-8996.jpg', '3');
INSERT INTO `bigpho` VALUES ('8', '2016-05-27/20160527153420-8996.jpg', '8');

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
  `picture` text NOT NULL COMMENT '图文简介',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '122', '300', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '7', '2016-07-06 18:00:41', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('2', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '4545', '5656', '王老师', '3时10分', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '4', '2016-07-07 14:49:11', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('3', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '5500', '7000', '王老师', '2时10分', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '5', '2016-07-07 14:49:05', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('4', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '200', '230', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '6', '2016-07-06 18:01:04', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('5', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '500', '600', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '3', '2016-07-06 18:01:08', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');
INSERT INTO `course` VALUES ('6', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '700', '800', '王老师', '3时10分', '2016-05-27/20160527153420-8996.jpg', '', '6', '2016-07-06 17:35:05', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>');

-- ----------------------------
-- Table structure for ordera
-- ----------------------------
DROP TABLE IF EXISTS `ordera`;
CREATE TABLE `ordera` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordera_name` varchar(20) DEFAULT NULL COMMENT '购买人',
  `ordera_mobi` varchar(11) DEFAULT NULL COMMENT '购买人手机',
  `users_id` int(10) DEFAULT NULL COMMENT '用户id',
  `course_id` int(10) DEFAULT NULL COMMENT '课程id',
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '购买时间',
  `status` int(1) DEFAULT NULL COMMENT '订单状态',
  `ordera_num` char(30) DEFAULT NULL COMMENT '订单号',
  `pay_type` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of ordera
-- ----------------------------
INSERT INTO `ordera` VALUES ('1', '', '', '0', '8', '2016-07-11 15:37:38', '0', '0', null);
INSERT INTO `ordera` VALUES ('2', '', '', '0', '8', '2016-07-11 15:37:38', '0', '0', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(26) DEFAULT NULL COMMENT '密码',
  `user_mobi` varchar(11) DEFAULT NULL COMMENT '用户手机',
  `logintime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册时间',
  `username` varchar(28) DEFAULT NULL COMMENT '用户名',
  `sex` int(1) DEFAULT NULL COMMENT '性别',
  `user_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '68053af2923e00204c3ca7c6a3', '13693251022', '2016-07-12 10:56:06', '张三', '1', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png');
INSERT INTO `users` VALUES ('2', '456', '18734832258', '2016-07-12 10:56:08', '李四', '0', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png');
INSERT INTO `users` VALUES ('3', '202cb962ac59075b964b07152d', '', '2016-07-12 10:56:08', '李飞飞', '0', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png');
INSERT INTO `users` VALUES ('4', '202cb962ac59075b964b07152d', '13693251041', '2016-07-12 10:56:10', '李飞飞', '0', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png');
