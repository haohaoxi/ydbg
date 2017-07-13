/*
Navicat MySQL Data Transfer

Source Server         : 移动办公内网数据库
Source Server Version : 50505
Source Host           : 192.168.3.242:3306
Source Database       : ydgb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-05-25 08:15:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chuchai
-- ----------------------------
DROP TABLE IF EXISTS `chuchai`;
CREATE TABLE `chuchai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `cc_ren` varchar(500) NOT NULL,
  `cc_count` int(5) NOT NULL,
  `cc_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cc_days` float NOT NULL,
  `cc_place` varchar(50) NOT NULL,
  `status` int(3) NOT NULL COMMENT '0,未审核、1,同意、2,驳回',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出差管理';

-- ----------------------------
-- Records of chuchai
-- ----------------------------

-- ----------------------------
-- Table structure for dept_contact
-- ----------------------------
DROP TABLE IF EXISTS `dept_contact`;
CREATE TABLE `dept_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(80) NOT NULL COMMENT '机构名称',
  `dept_type` varchar(80) NOT NULL COMMENT '机构类型',
  `principal` int(11) DEFAULT NULL COMMENT '科室负责人',
  `branch_leader` int(11) DEFAULT NULL COMMENT '分管领导',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='机构通讯录';

-- ----------------------------
-- Records of dept_contact
-- ----------------------------
INSERT INTO `dept_contact` VALUES ('1', 'dept1', 'dept1', '1', '1');

-- ----------------------------
-- Table structure for gongban
-- ----------------------------
DROP TABLE IF EXISTS `gongban`;
CREATE TABLE `gongban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` int(11) NOT NULL COMMENT '所属机构',
  `gc_ren` varchar(500) NOT NULL COMMENT '公出人',
  `gc_count` int(5) NOT NULL COMMENT '公出人数',
  `gc_time` datetime NOT NULL COMMENT '公出时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `gc_place` varchar(50) DEFAULT NULL COMMENT '公出地点',
  `ygwc` text NOT NULL COMMENT '因公外出',
  `jb_ren` int(11) NOT NULL COMMENT '经办人',
  `dept_leader` int(11) NOT NULL COMMENT '科室领导',
  `yuan_leader` int(11) NOT NULL COMMENT '院领导',
  `status` int(3) NOT NULL COMMENT '审核状态（0，未审核、1，同意、2，驳回）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公出管理表';

-- ----------------------------
-- Records of gongban
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '个人办公管理', '10', '', 'personwork', 'personwork', 'index', '1', '0', '1', '1');
INSERT INTO `menu` VALUES ('14', '新增', '0', null, 'menu', 'menu', 'create', null, '13', '1', '1');
INSERT INTO `menu` VALUES ('2', '未办工作', '0', null, 'personwork', 'personwork', 'index', '1', '1', '1', '1');
INSERT INTO `menu` VALUES ('3', '代办工作', '0', null, 'personwork', 'personwork', 'index', '2', '1', '1', '1');
INSERT INTO `menu` VALUES ('4', '已办工作', '0', null, 'personwork', 'personwork', 'index', '3', '1', '1', '1');
INSERT INTO `menu` VALUES ('5', '逾期未办', '0', null, 'personwork', 'personwork', 'index', '4', '1', '1', '1');
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
INSERT INTO `menu` VALUES ('26', '人员通讯录', '0', '', 'peoplecontact', 'peoplecontact', 'index', '', '9', '1', '1');
INSERT INTO `menu` VALUES ('27', '机构信息', '2', '', 'deptcontact', 'deptcontact', 'index', '', '9', '1', '1');
INSERT INTO `menu` VALUES ('28', '发起工作', '0', '', 'personwork', 'personwork', 'index', '5', '1', '1', '1');
INSERT INTO `menu` VALUES ('29', '新增', '0', '', 'personwork', 'personwork', 'create', '5', '28', '1', '1');
INSERT INTO `menu` VALUES ('30', '新增机构', '0', '', 'deptcontact', 'deptcontact', 'create', '', '27', '1', '1');
INSERT INTO `menu` VALUES ('31', '查看', '0', '', 'deptcontact', 'deptcontact', 'view', '', '27', '1', '1');
INSERT INTO `menu` VALUES ('32', '修改', '0', '', 'deptcontact', 'deptcontact', 'update', '', '27', '1', '1');
INSERT INTO `menu` VALUES ('33', '删除', '0', '', 'deptcontact', 'deptcontact', 'delete', '', '27', '1', '1');
INSERT INTO `menu` VALUES ('34', '查看', '0', '', 'personwork', 'personwork', 'view', '5', '28', '1', '1');
INSERT INTO `menu` VALUES ('35', '催办', '0', '', 'personwork', 'personwork', 'cuiban', '5', '28', '1', '1');
INSERT INTO `menu` VALUES ('36', '删除', '0', '', 'personwork', 'personwork', 'delete', '5', '28', '1', '1');
INSERT INTO `menu` VALUES ('37', '受理', '0', '', 'personwork', 'personwork', 'sl', '1', '2', '1', '1');
INSERT INTO `menu` VALUES ('38', '审批', '0', '', 'personwork', 'personwork', 'sp', '1', '2', '1', '1');
INSERT INTO `menu` VALUES ('39', '驳回', '0', '', 'personwork', 'personwork', 'spbh', '1', '38', '1', '1');
INSERT INTO `menu` VALUES ('40', '同意', '0', '', 'personwork', 'personwork', 'spty', '1', '38', '1', '1');
INSERT INTO `menu` VALUES ('41', '代办', '0', '', 'personwork', 'personwork', 'sldb', '1', '37', '1', '1');
INSERT INTO `menu` VALUES ('42', '退办', '0', '', 'personwork', 'personwork', 'sltb', '1', '37', '1', '1');
INSERT INTO `menu` VALUES ('43', '完成', '0', '', 'personwork', 'personwork', 'slwc', '1', '37', '1', '1');

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
-- Table structure for people_contact
-- ----------------------------
DROP TABLE IF EXISTS `people_contact`;
CREATE TABLE `people_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '姓名',
  `dept_id` int(11) NOT NULL COMMENT '部门',
  `position` varchar(20) NOT NULL COMMENT '行政职务',
  `telphone` varchar(11) NOT NULL COMMENT '手机号码',
  `out1` varchar(50) DEFAULT NULL COMMENT '外线1',
  `out2` varchar(50) DEFAULT NULL COMMENT '外线2',
  `inline` varchar(50) DEFAULT NULL COMMENT '内线',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='人员通讯录';

-- ----------------------------
-- Records of people_contact
-- ----------------------------

-- ----------------------------
-- Table structure for person_work
-- ----------------------------
DROP TABLE IF EXISTS `person_work`;
CREATE TABLE `person_work` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(80) NOT NULL COMMENT '主题',
  `p_s_time` datetime NOT NULL COMMENT '开始工作时间',
  `p_e_time` datetime DEFAULT NULL COMMENT '结束工作时间',
  `p_c_time` datetime NOT NULL COMMENT '创建时间',
  `p_level` enum('一般','紧急') NOT NULL DEFAULT '一般' COMMENT '优先级',
  `p_fsq` int(11) NOT NULL COMMENT '发起人',
  `p_y_slr` varchar(250) DEFAULT NULL COMMENT '原受理人',
  `p_y_slr_text` varchar(500) DEFAULT NULL COMMENT '原受理人',
  `p_spr` varchar(250) DEFAULT NULL COMMENT '审批人',
  `p_details` text NOT NULL COMMENT '详情',
  `p_cancel_detail` text COMMENT '退办原因',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='个人办公管理';

-- ----------------------------
-- Records of person_work
-- ----------------------------
INSERT INTO `person_work` VALUES ('5', 'AAA', '2016-05-01 18:05:00', '2016-05-28 18:05:00', '2016-05-24 18:19:56', '一般', '1', '1', '崔俊11', '1,8', 'AAA', null);

-- ----------------------------
-- Table structure for person_work_workflow
-- ----------------------------
DROP TABLE IF EXISTS `person_work_workflow`;
CREATE TABLE `person_work_workflow` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `w_p_id` int(11) NOT NULL COMMENT '对应person_work表记录id',
  `w_person_id` int(11) NOT NULL COMMENT '处理人员',
  `w_person_key` char(10) NOT NULL COMMENT '处理人员key值',
  `w_s_time` datetime NOT NULL COMMENT '处理开始时间',
  `w_e_time` datetime DEFAULT NULL COMMENT '处理结束时间',
  `w_s_status` enum('未受理','未审批') NOT NULL COMMENT '开始办理专题',
  `w_e_status` enum('同意','完成','退办','驳回','无','代办') DEFAULT '无' COMMENT '最后状态',
  `w_type` enum('代办','普通') NOT NULL DEFAULT '普通' COMMENT '是否是代办(只针对受理者)',
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='个人办公工作流表';

-- ----------------------------
-- Records of person_work_workflow
-- ----------------------------
INSERT INTO `person_work_workflow` VALUES ('10', '5', '1', '0', '2016-05-24 18:19:56', '2016-05-24 18:44:58', '未审批', '同意', '普通');
INSERT INTO `person_work_workflow` VALUES ('13', '5', '8', '1', '2016-05-24 18:27:12', '2016-05-24 18:59:07', '未审批', '同意', '普通');
INSERT INTO `person_work_workflow` VALUES ('16', '5', '1', '0', '2016-05-24 18:59:07', null, '未受理', '无', '普通');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1', '1', '超级管理员');
INSERT INTO `role` VALUES ('2', '技术部管理员', '1', '1', '技术部管理员');
INSERT INTO `role` VALUES ('6', '审批角色', '0', '1', '审批角色');
INSERT INTO `role` VALUES ('10', '科长一', '0', '1', '科长一');
INSERT INTO `role` VALUES ('11', '科员一', '0', '1', '科员一');

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=505 DEFAULT CHARSET=utf8 COMMENT='角色菜单关联表';

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
INSERT INTO `role_menu` VALUES ('503', '6', '15');
INSERT INTO `role_menu` VALUES ('502', '6', '14');
INSERT INTO `role_menu` VALUES ('501', '6', '13');
INSERT INTO `role_menu` VALUES ('500', '6', '25');
INSERT INTO `role_menu` VALUES ('499', '6', '24');
INSERT INTO `role_menu` VALUES ('498', '6', '23');
INSERT INTO `role_menu` VALUES ('497', '6', '22');
INSERT INTO `role_menu` VALUES ('496', '6', '12');
INSERT INTO `role_menu` VALUES ('495', '6', '21');
INSERT INTO `role_menu` VALUES ('494', '6', '20');
INSERT INTO `role_menu` VALUES ('493', '6', '19');
INSERT INTO `role_menu` VALUES ('492', '6', '18');
INSERT INTO `role_menu` VALUES ('491', '6', '17');
INSERT INTO `role_menu` VALUES ('490', '6', '11');
INSERT INTO `role_menu` VALUES ('489', '6', '10');
INSERT INTO `role_menu` VALUES ('488', '6', '26');
INSERT INTO `role_menu` VALUES ('487', '6', '33');
INSERT INTO `role_menu` VALUES ('486', '6', '32');
INSERT INTO `role_menu` VALUES ('485', '6', '31');
INSERT INTO `role_menu` VALUES ('484', '6', '30');
INSERT INTO `role_menu` VALUES ('483', '6', '27');
INSERT INTO `role_menu` VALUES ('482', '6', '9');
INSERT INTO `role_menu` VALUES ('481', '6', '8');
INSERT INTO `role_menu` VALUES ('480', '6', '7');
INSERT INTO `role_menu` VALUES ('479', '6', '6');
INSERT INTO `role_menu` VALUES ('478', '6', '36');
INSERT INTO `role_menu` VALUES ('477', '6', '35');
INSERT INTO `role_menu` VALUES ('476', '6', '34');
INSERT INTO `role_menu` VALUES ('475', '6', '29');
INSERT INTO `role_menu` VALUES ('474', '6', '28');
INSERT INTO `role_menu` VALUES ('473', '6', '5');
INSERT INTO `role_menu` VALUES ('472', '6', '4');
INSERT INTO `role_menu` VALUES ('471', '6', '3');
INSERT INTO `role_menu` VALUES ('470', '6', '40');
INSERT INTO `role_menu` VALUES ('469', '6', '39');
INSERT INTO `role_menu` VALUES ('468', '6', '38');
INSERT INTO `role_menu` VALUES ('467', '6', '43');
INSERT INTO `role_menu` VALUES ('466', '6', '42');
INSERT INTO `role_menu` VALUES ('465', '6', '41');
INSERT INTO `role_menu` VALUES ('464', '6', '37');
INSERT INTO `role_menu` VALUES ('463', '6', '2');
INSERT INTO `role_menu` VALUES ('462', '6', '1');
INSERT INTO `role_menu` VALUES ('504', '6', '16');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='角色用户关联表';

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
INSERT INTO `role_user` VALUES ('11', '9', '6');
INSERT INTO `role_user` VALUES ('12', '10', '6');
INSERT INTO `role_user` VALUES ('13', '11', '6');
INSERT INTO `role_user` VALUES ('14', '12', '6');

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '崔俊11', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$24ILXZNwa/y6p6NX/35X6Oube8gnZQ1fZgKnIUmRKw5P/dpBV5bQK', '0', 'admin@qq.com', '10', '1454403070', '1464088621', '1464088621', '127.0.0.1', '5');
INSERT INTO `user` VALUES ('2', 'cuijun', '崔俊', 'fUwgiWl7rKRZkibw4D4xEQ-zqeWw_0lb', '$2y$13$jPTH51D6mYRodN/1qVwtVORcucE64/2rwzZ5qJn5WT8nVCkyb/WpK', null, '1111@qq.com', '10', '1457681052', '1463964189', '1463964188', '127.0.0.1', '3');
INSERT INTO `user` VALUES ('8', 'shenpi', '审批', '4BNN9RXTprCVX7V8vModU1jFuDaHb9ag', '$2y$13$pcpTm9QLP9uuxks.wJz69.LR2p5vjqXMxed2hX9aobW1mMmbDgC5u', null, null, '10', '1463727983', '1464070751', '1464070751', '127.0.0.1', '3');
INSERT INTO `user` VALUES ('9', 'shenpi2', '审批2', 'jbqz7M0aRInIWkUrKu9yXgDYDBDn5yL4', '$2y$13$UC6ofS7MByLMQ.HrwJ0lx.Y4bplwYQXOEJAghG4hbq2ekN6Yk6m8m', null, null, '10', '1464002578', '1464002588', null, '', '1');
INSERT INTO `user` VALUES ('10', 'shenpi3', '审批3', 'oOys6wPtzLCApRVqMJY0Fhur21i608l7', '$2y$13$zkN466vsbXVj/YK9DEA1M.OAUyN.w38Ng58bIFT4GBjnJkgKNh0gG', null, null, '10', '1464002610', '1464002650', null, '', '1');
INSERT INTO `user` VALUES ('11', 'shenpi4', '审批4', 'ueYVph4HqWJPAI-75XI0lyy6Im83Z1kE', '$2y$13$FLHh7rGzq9Id5iFjUn01c.fPY3kyOoJstxcQsDkTRnQ61soT2QXXy', null, null, '10', '1464002672', '1464002672', null, '', '1');
INSERT INTO `user` VALUES ('12', 'shouli', '受理人1', 'EwhzPTK-9m5NPwgYr63p8wfg2Rx7knsk', '$2y$13$qfoPJm7yrVcOIw5XQENd1Oh7I6G7wZ.sUOpcTTTZjE0/5jgo7C5bi', null, null, '10', '1464004917', '1464004917', null, '', '1');
