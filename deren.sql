/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : deren

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-07-21 10:01:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adminuser
-- ----------------------------
DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE `adminuser` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adminuser
-- ----------------------------
INSERT INTO `adminuser` VALUES ('1', 'admin', '123456');

-- ----------------------------
-- Table structure for bigpho
-- ----------------------------
DROP TABLE IF EXISTS `bigpho`;
CREATE TABLE `bigpho` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '轮播图id',
  `pho_url` varchar(255) NOT NULL COMMENT '图片路径',
  `class_id` int(10) NOT NULL COMMENT '课程id',
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
  `type` varchar(1) DEFAULT NULL COMMENT '课程分类',
  `course_name` char(30) DEFAULT NULL COMMENT '课程名',
  `course_photo` varchar(255) DEFAULT NULL COMMENT '课程缩略图',
  `current_price` int(6) DEFAULT NULL COMMENT '课程现价',
  `course_price` int(6) DEFAULT NULL COMMENT '课程原价',
  `teach_name` varchar(20) DEFAULT NULL COMMENT '老师名',
  `classtime` varchar(20) DEFAULT NULL COMMENT '总课时',
  `offline_url` varchar(255) DEFAULT NULL COMMENT '线下课图片路径',
  `video_url` varchar(255) DEFAULT NULL COMMENT '音视频路径',
  `class_num` int(3) DEFAULT NULL COMMENT '总课节',
  `addtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `picture` text COMMENT '图文简介',
  `status` int(1) DEFAULT NULL COMMENT '课程状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '122', '300', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '7', '2016-07-19 10:14:40', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1');
INSERT INTO `course` VALUES ('2', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '4545', '5656', '王老师', '3时10分', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '4', '2016-07-19 10:14:49', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '0');
INSERT INTO `course` VALUES ('3', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '5500', '7000', '王老师', '2时10分', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '5', '2016-07-19 10:14:41', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '0');
INSERT INTO `course` VALUES ('4', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '200', '230', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '6', '2016-07-19 10:14:42', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1');
INSERT INTO `course` VALUES ('5', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '500', '600', '王老师', '07-1', '2016-05-27/20160527153420-8996.jpg', 'video.mp4/video.webm', '3', '2016-07-19 10:14:43', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1');
INSERT INTO `course` VALUES ('6', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '700', '800', '王老师', '3时10分', '2016-05-27/20160527153420-8996.jpg', '', '6', '2016-07-19 10:14:44', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1');

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
  `pay_type` char(3) DEFAULT NULL COMMENT '支付类型',
  `course_photo` varchar(255) DEFAULT NULL COMMENT '课程缩略图',
  `type` int(1) DEFAULT NULL COMMENT '课程类型',
  `course_name` varchar(100) DEFAULT NULL COMMENT '课程名称',
  `current_price` int(8) DEFAULT NULL COMMENT '付款金额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of ordera
-- ----------------------------
INSERT INTO `ordera` VALUES ('1', 'er', '13693251022', '1', '1', '2016-07-20 16:43:03', '1', 'Deren14683857772318', null, null, '1', null, null);
INSERT INTO `ordera` VALUES ('2', 'ert', '18735071432', '1', '2', '2016-07-20 16:43:03', '1', 'Deren14683857772318', null, null, '1', null, null);
INSERT INTO `ordera` VALUES ('3', 'ret', '11111111111', '1', '3', '2016-07-20 16:43:03', '1', 'Deren14683857772318', '', null, '1', null, null);
INSERT INTO `ordera` VALUES ('4', 'sdf', '18734832258', '2', '4', '2016-07-20 16:43:03', '1', 'Deren14683859463426', '', null, '2', null, null);
INSERT INTO `ordera` VALUES ('5', '都肌肤而', '18734832258', '2', '6', '2016-07-20 16:43:03', '1', 'Deren14684759333858', '微信支', null, '2', null, null);
INSERT INTO `ordera` VALUES ('6', 'set', '13693251022', '2', '1', '2016-07-20 16:42:39', '0', 'Deren14684755443601', '微信支', null, '3', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `user_mobi` varchar(11) DEFAULT NULL COMMENT '用户手机',
  `logintime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册时间',
  `username` varchar(28) DEFAULT NULL COMMENT '用户名',
  `sex` int(1) DEFAULT NULL COMMENT '性别',
  `user_photo` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '用户状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '6c14da109e294d1e8155be8aa4b1ce8e', '18301165215', '2016-07-20 16:48:32', '李飞', '1', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '0');
INSERT INTO `users` VALUES ('2', 'e10adc3949ba59abbe56e057f20f883e', '18734832258', '2016-07-20 16:48:32', '李四', '0', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '0');
INSERT INTO `users` VALUES ('3', 'e10adc3949ba59abbe56e057f20f883e', '', '2016-07-20 16:48:32', '李飞飞', '0', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '0');
INSERT INTO `users` VALUES ('4', 'e10adc3949ba59abbe56e057f20f883e', '13693251041', '2016-07-20 16:48:32', '李飞飞', '0', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '0');
INSERT INTO `users` VALUES ('5', '827ccb0eea8a706c4c34a16891f84e7b', '13716779617', '2016-07-20 16:48:32', '李飞', '1', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '0');
