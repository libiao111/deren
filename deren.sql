/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : deren

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-08-01 22:50:53
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dr_adminuser
-- ----------------------------
INSERT INTO `dr_adminuser` VALUES ('1', 'admin', '123456');

-- ----------------------------
-- Table structure for dr_bills
-- ----------------------------
DROP TABLE IF EXISTS `dr_bills`;
CREATE TABLE `dr_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `course_id` int(11) NOT NULL COMMENT '课程id',
  `order_num` char(32) DEFAULT NULL COMMENT '订单号',
  `user_name` varchar(20) DEFAULT NULL COMMENT '购买人',
  `user_phone` varchar(11) DEFAULT NULL COMMENT '购买人手机',
  `course_price` int(8) DEFAULT NULL COMMENT '付款金额',
  `pay_type` char(3) DEFAULT NULL COMMENT '支付类型',
  `status` int(1) DEFAULT NULL COMMENT '订单状态（支付状态）',
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '购买时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of dr_bills
-- ----------------------------
INSERT INTO `dr_bills` VALUES ('2', '1', '2', 'DRKC14683857772318', 'ert', '18735071432', null, null, '1', '2016-08-01 22:26:45');
INSERT INTO `dr_bills` VALUES ('3', '1', '3', 'DRKC14683857772318', 'ret', '11111111111', null, '', '1', '2016-08-01 22:26:46');
INSERT INTO `dr_bills` VALUES ('4', '2', '4', 'DRKC14683859463426', 'sdf', '18734832258', null, '', '1', '2016-08-01 22:26:48');
INSERT INTO `dr_bills` VALUES ('46', '1', '27', 'DRKC14700619591480', '', '', '100', '微信支', '0', '2016-08-01 22:32:39');
INSERT INTO `dr_bills` VALUES ('47', '1', '27', 'DRKC14700619634409', '', '', '100', '微信支', '0', '2016-08-01 22:32:43');
INSERT INTO `dr_bills` VALUES ('48', '1', '27', 'DRKC14700619901446', '李飞a', '18301165215', '100', '微信支', '0', '2016-08-01 22:33:10');
INSERT INTO `dr_bills` VALUES ('49', '1', '27', 'DRKC14700620419016', '李飞a', '18301165215', '100', '微信支', '0', '2016-08-01 22:34:01');
INSERT INTO `dr_bills` VALUES ('50', '1', '27', 'DRKC14700620509419', '李飞a', '18301165215', '100', '微信支', '0', '2016-08-01 22:34:10');
INSERT INTO `dr_bills` VALUES ('51', '1', '27', 'DRKC14700620724162', '李飞a', '18301165215', '100', '微信支', '0', '2016-08-01 22:34:32');
INSERT INTO `dr_bills` VALUES ('52', '1', '27', 'DRKC14700620883177', '李飞a', '18301165215', '100', '微信支', '0', '2016-08-01 22:34:48');
INSERT INTO `dr_bills` VALUES ('53', '1', '1', 'DRKC14700621457122', '李飞a', '18301165215', '122', '微信支', '0', '2016-08-01 22:35:45');
INSERT INTO `dr_bills` VALUES ('54', '1', '1', 'DRKC14700621628862', '李飞a', '18301165215', '122', '微信支', '0', '2016-08-01 22:36:02');
INSERT INTO `dr_bills` VALUES ('55', '1', '1', 'DRKC14700622198554', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:36:59');
INSERT INTO `dr_bills` VALUES ('56', '1', '1', 'DRKC14700622481936', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:37:28');
INSERT INTO `dr_bills` VALUES ('57', '1', '1', 'DRKC14700623044076', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:38:24');
INSERT INTO `dr_bills` VALUES ('58', '1', '1', 'DRKC14700623649592', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:39:24');
INSERT INTO `dr_bills` VALUES ('59', '1', '1', 'DRKC14700623684179', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:39:28');
INSERT INTO `dr_bills` VALUES ('60', '1', '1', 'DRKC14700624054560', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:40:05');
INSERT INTO `dr_bills` VALUES ('61', '1', '1', 'DRKC14700624154941', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:40:15');
INSERT INTO `dr_bills` VALUES ('62', '1', '1', 'DRKC14700624204673', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:40:20');
INSERT INTO `dr_bills` VALUES ('63', '1', '1', 'DRKC14700624591264', '李飞a', '18301165215', '122', '', '0', '2016-08-01 22:40:59');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='课时表';

-- ----------------------------
-- Records of dr_class
-- ----------------------------
INSERT INTO `dr_class` VALUES ('2', '1', 'PS简单应运', '2016-07-31', '3', '49', null, null, null, null);
INSERT INTO `dr_class` VALUES ('3', '1', 'PS的基础进阶', '2016-07-31', '3', '49', null, null, null, null);
INSERT INTO `dr_class` VALUES ('4', '1', 'PS的基础进阶', '2016-07-31', '3', '49', null, null, null, null);
INSERT INTO `dr_class` VALUES ('5', '6', 'php简介', '2016-07-31', '3', '49', null, null, null, null);
INSERT INTO `dr_class` VALUES ('6', '6', 'php简单应运', '2016-07-31', '3', '49', null, null, null, null);
INSERT INTO `dr_class` VALUES ('7', '2', 'php基础进阶', '2016-07-31', '3', '49', 'video/579f06c18051f.mp4', null, null, null);
INSERT INTO `dr_class` VALUES ('8', '8', 'php基础进阶', '2016-07-31', '3', '49', null, null, null, null);
INSERT INTO `dr_class` VALUES ('11', '2', 'php简介', null, '1', '20', 'video/579f06c18051f.mp4', null, '1470037009', null);
INSERT INTO `dr_class` VALUES ('13', '2', 'sdfsdf', null, '2', '33', 'video/579f06c18051f.mp4', null, '1470039745', '1470040185');
INSERT INTO `dr_class` VALUES ('14', '3', '声音的魅力', null, '0', '30', 'audio/579f1ed60b5ce.mp3', null, '1470045910', null);
INSERT INTO `dr_class` VALUES ('15', '3', '声音的魅力sdf', null, '1', '10', null, null, '1470049711', '1470051341');
INSERT INTO `dr_class` VALUES ('16', '27', '课程课节', null, '1', '22', 'video/579f35fb63e62.mp4', null, '1470051835', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='音频课图片';

-- ----------------------------
-- Records of dr_class_img
-- ----------------------------
INSERT INTO `dr_class_img` VALUES ('45', '15', '3', 'image/579f32e42a110.jpg');
INSERT INTO `dr_class_img` VALUES ('44', '15', '3', 'image/579f2daf0df77.jpg');
INSERT INTO `dr_class_img` VALUES ('43', '15', '3', 'image/579f2daf0ef8b.jpg');
INSERT INTO `dr_class_img` VALUES ('42', '15', '3', 'image/579f2daf0e7ae.png');
INSERT INTO `dr_class_img` VALUES ('34', '14', '3', 'image/579f1ed60d387.jpg');
INSERT INTO `dr_class_img` VALUES ('33', '14', '3', 'image/579f1ed60cafa.jpg');
INSERT INTO `dr_class_img` VALUES ('32', '14', '3', 'image/579f1ed60c423.png');
INSERT INTO `dr_class_img` VALUES ('41', '15', '3', 'image/579f2daf0df77.jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of dr_course
-- ----------------------------
INSERT INTO `dr_course` VALUES ('1', '1', '思维口才50天速成课', '579da796492bd.jpg', '122', '300', '王老师', '3', '2016-7-19', '<p>兔兔图图图</p>', '1', null, '1470052783');
INSERT INTO `dr_course` VALUES ('2', '2', '思维口才50天速成课', '579eea574df2d.jpg', '4545', '5656', '王老师', '7', '2时10分', '<p>兔兔图图图s<span style=\"font-size: 14px;\"></span></p>', '1', null, '1470052856');
INSERT INTO `dr_course` VALUES ('3', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '5500', '7000', '王老师', '5', '2时10分', '<p>兔兔图图图</p>', '1', null, null);
INSERT INTO `dr_course` VALUES ('27', '2', '添加音频', 'image/579f35d4526c6.jpg', '100', '200', '小波', '3', '3时10分', '<p>添加音频课程</p>', '1', '1470051796', null);
INSERT INTO `dr_course` VALUES ('5', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '500', '600', '王老师', '5', '2016-7-19', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '2', null, null);
INSERT INTO `dr_course` VALUES ('6', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '700', '800', '王老师', '5', '3时10分', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1', null, null);
INSERT INTO `dr_course` VALUES ('7', '1', '思维口才50天速成课', '579da796492bd.jpg', '122', '300', '王老师', '5', '2016-7-19', '<p>兔兔图图图</p>', '2', null, null);
INSERT INTO `dr_course` VALUES ('8', '2', '思维口才50天速成课', '579eea574df2d.jpg', '4545', '5656', '王老师', '3', '2时10分', '<p>兔兔图图图s<span style=\"font-size: 14px;\"></span></p>', '2', null, null);
INSERT INTO `dr_course` VALUES ('9', '3', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '5500', '7000', '王老师', '5', '2时10分', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1', null, null);
INSERT INTO `dr_course` VALUES ('10', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '200', '230', '王老师', '5', '2016-7-19', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1', null, null);
INSERT INTO `dr_course` VALUES ('11', '1', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '500', '600', '王老师', '5', '2016-7-19', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '2', null, null);
INSERT INTO `dr_course` VALUES ('12', '2', '思维口才50天速成课', '2016-05-27/20160527153420-8996.jpg', '700', '800', '王老师', '5', '3时10分', '<p>兔兔图图图</p><img src=\"2016-05-27/20160527153420-8996.jpg\"/>', '1', null, null);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of dr_users
-- ----------------------------
INSERT INTO `dr_users` VALUES ('1', '18301165215', 'e10adc3949ba59abbe56e057f20f883e', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '李飞a', '1', '0', '2016-07-31 12:14:25');
INSERT INTO `dr_users` VALUES ('2', '18734832258', 'e10adc3949ba59abbe56e057f20f883e', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '李四', '0', '0', '2016-07-31 12:14:24');
INSERT INTO `dr_users` VALUES ('4', '13693251041', 'e10adc3949ba59abbe56e057f20f883e', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '李飞飞', '0', '0', '2016-07-20 16:48:32');
INSERT INTO `dr_users` VALUES ('5', '13716779617', 'e10adc3949ba59abbe56e057f20f883e', 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png', '李飞b', '1', '0', '2016-07-31 12:14:26');
