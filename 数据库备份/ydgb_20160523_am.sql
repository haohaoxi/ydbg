/*
Navicat MySQL Data Transfer

Source Server         : 移动办公线上数据库
Source Server Version : 50534
Source Host           : 121.42.205.190:3306
Source Database       : ydgb

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2016-05-23 08:54:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(200) NOT NULL COMMENT '名称',
  `order` int(11) DEFAULT '0' COMMENT '排序',
  `class` varchar(500) DEFAULT NULL COMMENT '样式',
  `module` char(100) NOT NULL COMMENT '模块',
  `controller` char(100) NOT NULL COMMENT '控制器',
  `action` char(100) NOT NULL COMMENT '方法',
  `menutype` varchar(50) DEFAULT NULL COMMENT '参数',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '菜单是否显示',
  `is_run` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许操作',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '个人办公管理', '10', null, 'grgbgl', 'grgbgl', 'index', '1', '0', '1', '1');
INSERT INTO `menu` VALUES ('14', '新增', '0', null, 'menu', 'menu', 'create', null, '13', '1', '1');
INSERT INTO `menu` VALUES ('2', '未办工作', '0', null, 'grgbgl', 'grgbgl', 'index', '1', '1', '1', '1');
INSERT INTO `menu` VALUES ('3', '代办工作', '0', null, 'grgbgl', 'grgbgl', 'index', '2', '1', '1', '1');
INSERT INTO `menu` VALUES ('4', '已办工作', '0', null, 'grgbgl', 'grgbgl', 'index', '3', '1', '1', '1');
INSERT INTO `menu` VALUES ('5', '逾期未办', '0', null, 'grgbgl', 'grgbgl', 'index', '4', '1', '1', '1');
INSERT INTO `menu` VALUES ('6', '综合办公管理', '9', null, 'zhgbgl', 'zhgbgl', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('7', '行政办公管理', '0', null, 'xzbggl', 'xzbggl', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('8', '通知公告管理', '0', null, 'tzgggl', 'tzgggl', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('9', '通讯录管理', '0', null, 'txlgl', 'txlgl', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('10', '学习进修管理', '0', null, 'xxjxgl', 'xxjxgl', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('11', '账号管理', '0', null, 'user', 'user', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('12', '角色管理', '0', null, 'role', 'role', 'index', '', '11', '1', '1');
INSERT INTO `menu` VALUES ('13', '菜单管理', '0', null, 'menu', 'menu', 'index', null, '11', '1', '1');
INSERT INTO `menu` VALUES ('15', '修改', '0', null, 'menu', 'menu', 'update', null, '13', '1', '1');
INSERT INTO `menu` VALUES ('16', '删除', '0', null, 'menu', 'menu', 'delete', null, '13', '1', '1');
INSERT INTO `menu` VALUES ('17', '账号管理', '1', null, 'user', 'user', 'index', null, '11', '1', '1');
INSERT INTO `menu` VALUES ('18', '新增', '0', null, 'user', 'user', 'create', null, '17', '1', '1');
INSERT INTO `menu` VALUES ('19', '修改', '0', null, 'user', 'user', 'update', null, '17', '1', '1');
INSERT INTO `menu` VALUES ('20', '删除', '0', null, 'user', 'user', 'delete', null, '17', '1', '1');
INSERT INTO `menu` VALUES ('21', '密码修改', '0', null, 'user', 'user', 'update-pwd', null, '17', '1', '1');
INSERT INTO `menu` VALUES ('22', '新增', '0', null, 'role', 'role', 'create', null, '12', '1', '1');
INSERT INTO `menu` VALUES ('23', '修改', '0', null, 'role', 'role', 'update', null, '12', '1', '1');
INSERT INTO `menu` VALUES ('24', '删除', '0', null, 'role', 'role', 'delete', null, '12', '1', '1');
INSERT INTO `menu` VALUES ('25', '权限分配', '0', null, 'role', 'role', 'permissions', null, '12', '1', '1');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m130524_201442_init', '1454402762');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1457591716');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(200) NOT NULL COMMENT '角色名称',
  `order` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1:启用 0:禁用',
  `descript` varchar(200) DEFAULT NULL COMMENT '角色描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1', '1', '超级管理员');
INSERT INTO `role` VALUES ('2', '技术部管理员', '1', '1', '技术部管理员');
INSERT INTO `role` VALUES ('6', '审批角色', '0', '1', '审批角色');

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=404 DEFAULT CHARSET=utf8 COMMENT='角色菜单关联表';

-- ----------------------------
-- Records of role_menu
-- ----------------------------
INSERT INTO `role_menu` VALUES ('59', '3', '12');
INSERT INTO `role_menu` VALUES ('60', '3', '23');
INSERT INTO `role_menu` VALUES ('61', '3', '24');
INSERT INTO `role_menu` VALUES ('152', '1', '11');
INSERT INTO `role_menu` VALUES ('153', '1', '17');
INSERT INTO `role_menu` VALUES ('154', '1', '18');
INSERT INTO `role_menu` VALUES ('155', '1', '19');
INSERT INTO `role_menu` VALUES ('156', '1', '20');
INSERT INTO `role_menu` VALUES ('157', '1', '21');
INSERT INTO `role_menu` VALUES ('158', '1', '22');
INSERT INTO `role_menu` VALUES ('159', '1', '12');
INSERT INTO `role_menu` VALUES ('160', '1', '23');
INSERT INTO `role_menu` VALUES ('161', '1', '24');
INSERT INTO `role_menu` VALUES ('162', '1', '13');
INSERT INTO `role_menu` VALUES ('163', '1', '25');
INSERT INTO `role_menu` VALUES ('164', '1', '26');
INSERT INTO `role_menu` VALUES ('165', '1', '27');
INSERT INTO `role_menu` VALUES ('166', '1', '28');
INSERT INTO `role_menu` VALUES ('167', '1', '29');
INSERT INTO `role_menu` VALUES ('168', '1', '14');
INSERT INTO `role_menu` VALUES ('169', '1', '30');
INSERT INTO `role_menu` VALUES ('170', '1', '31');
INSERT INTO `role_menu` VALUES ('171', '1', '32');
INSERT INTO `role_menu` VALUES ('172', '1', '33');
INSERT INTO `role_menu` VALUES ('173', '1', '15');
INSERT INTO `role_menu` VALUES ('174', '1', '34');
INSERT INTO `role_menu` VALUES ('175', '1', '35');
INSERT INTO `role_menu` VALUES ('176', '1', '36');
INSERT INTO `role_menu` VALUES ('177', '1', '7');
INSERT INTO `role_menu` VALUES ('178', '1', '37');
INSERT INTO `role_menu` VALUES ('179', '1', '38');
INSERT INTO `role_menu` VALUES ('180', '1', '39');
INSERT INTO `role_menu` VALUES ('181', '1', '16');
INSERT INTO `role_menu` VALUES ('182', '1', '40');
INSERT INTO `role_menu` VALUES ('183', '1', '41');
INSERT INTO `role_menu` VALUES ('184', '1', '6');
INSERT INTO `role_menu` VALUES ('185', '1', '42');
INSERT INTO `role_menu` VALUES ('186', '1', '52');
INSERT INTO `role_menu` VALUES ('187', '1', '53');
INSERT INTO `role_menu` VALUES ('188', '1', '54');
INSERT INTO `role_menu` VALUES ('189', '1', '55');
INSERT INTO `role_menu` VALUES ('190', '1', '43');
INSERT INTO `role_menu` VALUES ('191', '1', '44');
INSERT INTO `role_menu` VALUES ('192', '1', '45');
INSERT INTO `role_menu` VALUES ('193', '1', '46');
INSERT INTO `role_menu` VALUES ('194', '1', '47');
INSERT INTO `role_menu` VALUES ('195', '1', '49');
INSERT INTO `role_menu` VALUES ('196', '1', '50');
INSERT INTO `role_menu` VALUES ('197', '1', '51');
INSERT INTO `role_menu` VALUES ('403', '2', '16');
INSERT INTO `role_menu` VALUES ('402', '2', '15');
INSERT INTO `role_menu` VALUES ('401', '2', '14');
INSERT INTO `role_menu` VALUES ('400', '2', '13');
INSERT INTO `role_menu` VALUES ('399', '2', '25');
INSERT INTO `role_menu` VALUES ('398', '2', '24');
INSERT INTO `role_menu` VALUES ('397', '2', '23');
INSERT INTO `role_menu` VALUES ('396', '2', '22');
INSERT INTO `role_menu` VALUES ('395', '2', '12');
INSERT INTO `role_menu` VALUES ('394', '2', '21');
INSERT INTO `role_menu` VALUES ('393', '2', '20');
INSERT INTO `role_menu` VALUES ('392', '2', '19');
INSERT INTO `role_menu` VALUES ('391', '2', '18');
INSERT INTO `role_menu` VALUES ('390', '2', '17');
INSERT INTO `role_menu` VALUES ('389', '2', '11');
INSERT INTO `role_menu` VALUES ('388', '2', '10');
INSERT INTO `role_menu` VALUES ('387', '2', '9');
INSERT INTO `role_menu` VALUES ('386', '2', '8');
INSERT INTO `role_menu` VALUES ('385', '2', '7');
INSERT INTO `role_menu` VALUES ('384', '2', '6');
INSERT INTO `role_menu` VALUES ('383', '2', '5');
INSERT INTO `role_menu` VALUES ('382', '2', '4');
INSERT INTO `role_menu` VALUES ('381', '2', '3');
INSERT INTO `role_menu` VALUES ('380', '2', '2');
INSERT INTO `role_menu` VALUES ('379', '2', '1');
INSERT INTO `role_menu` VALUES ('363', '6', '42');
INSERT INTO `role_menu` VALUES ('362', '6', '59');
INSERT INTO `role_menu` VALUES ('361', '6', '58');
INSERT INTO `role_menu` VALUES ('360', '6', '57');
INSERT INTO `role_menu` VALUES ('359', '6', '56');
INSERT INTO `role_menu` VALUES ('358', '6', '46');
INSERT INTO `role_menu` VALUES ('357', '6', '96');
INSERT INTO `role_menu` VALUES ('356', '6', '95');
INSERT INTO `role_menu` VALUES ('355', '6', '93');
INSERT INTO `role_menu` VALUES ('354', '6', '92');
INSERT INTO `role_menu` VALUES ('353', '6', '70');
INSERT INTO `role_menu` VALUES ('352', '6', '91');
INSERT INTO `role_menu` VALUES ('351', '6', '90');
INSERT INTO `role_menu` VALUES ('350', '6', '89');
INSERT INTO `role_menu` VALUES ('349', '6', '122');
INSERT INTO `role_menu` VALUES ('348', '6', '103');
INSERT INTO `role_menu` VALUES ('347', '6', '102');
INSERT INTO `role_menu` VALUES ('346', '6', '104');
INSERT INTO `role_menu` VALUES ('345', '6', '105');
INSERT INTO `role_menu` VALUES ('344', '6', '100');
INSERT INTO `role_menu` VALUES ('343', '6', '109');
INSERT INTO `role_menu` VALUES ('342', '6', '112');
INSERT INTO `role_menu` VALUES ('341', '6', '117');
INSERT INTO `role_menu` VALUES ('340', '6', '106');
INSERT INTO `role_menu` VALUES ('339', '6', '99');
INSERT INTO `role_menu` VALUES ('338', '6', '107');
INSERT INTO `role_menu` VALUES ('337', '6', '16');
INSERT INTO `role_menu` VALUES ('364', '6', '52');
INSERT INTO `role_menu` VALUES ('365', '6', '53');
INSERT INTO `role_menu` VALUES ('366', '6', '54');
INSERT INTO `role_menu` VALUES ('367', '6', '55');
INSERT INTO `role_menu` VALUES ('368', '6', '74');
INSERT INTO `role_menu` VALUES ('369', '6', '81');
INSERT INTO `role_menu` VALUES ('370', '6', '82');
INSERT INTO `role_menu` VALUES ('371', '6', '84');
INSERT INTO `role_menu` VALUES ('372', '6', '119');
INSERT INTO `role_menu` VALUES ('373', '6', '120');
INSERT INTO `role_menu` VALUES ('374', '6', '121');
INSERT INTO `role_menu` VALUES ('375', '6', '47');
INSERT INTO `role_menu` VALUES ('376', '6', '49');
INSERT INTO `role_menu` VALUES ('377', '6', '50');
INSERT INTO `role_menu` VALUES ('378', '6', '51');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='角色用户关联表';

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '2');
INSERT INTO `role_user` VALUES ('2', '2', '2');
INSERT INTO `role_user` VALUES ('5', '5', '2');
INSERT INTO `role_user` VALUES ('6', '6', '1');
INSERT INTO `role_user` VALUES ('10', '8', '6');
INSERT INTO `role_user` VALUES ('8', '3', '1');
INSERT INTO `role_user` VALUES ('9', '4', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '0 删除 10 正常',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `last_login_ip` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(10) NOT NULL COMMENT '部门',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '崔俊11', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$24ILXZNwa/y6p6NX/35X6Oube8gnZQ1fZgKnIUmRKw5P/dpBV5bQK', '0', 'admin@qq.com', '10', '1454403070', '1463902631', '1463902631', '127.0.0.1', '5');
INSERT INTO `user` VALUES ('2', 'cuijun', '崔俊', 'fUwgiWl7rKRZkibw4D4xEQ-zqeWw_0lb', '$2y$13$jPTH51D6mYRodN/1qVwtVORcucE64/2rwzZ5qJn5WT8nVCkyb/WpK', null, '1111@qq.com', '10', '1457681052', '1463964189', '1463964188', '127.0.0.1', '3');
INSERT INTO `user` VALUES ('8', 'shenpi', '', '4BNN9RXTprCVX7V8vModU1jFuDaHb9ag', '$2y$13$pcpTm9QLP9uuxks.wJz69.LR2p5vjqXMxed2hX9aobW1mMmbDgC5u', null, null, '10', '1463727983', '1463878752', '1463878752', '127.0.0.1', '3');
