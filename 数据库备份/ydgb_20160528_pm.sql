/*
Navicat MySQL Data Transfer

Source Server         : 移动办公内网数据库
Source Server Version : 50505
Source Host           : 192.168.3.242:3306
Source Database       : ydgb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-05-28 17:52:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for announcement
-- ----------------------------
DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL COMMENT '通知标题',
  `pubdate` datetime DEFAULT NULL COMMENT '发布时间',
  `author` varchar(50) DEFAULT NULL COMMENT '发布人',
  `attachment` varchar(200) NOT NULL COMMENT '附件',
  `content` text NOT NULL COMMENT '正文',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of announcement
-- ----------------------------
INSERT INTO `announcement` VALUES ('14', '公司的v加', '2016-05-27 10:42:56', '崔俊11', 'C:\\WINDOWS\\system32\\drivers\\etc\\networks', '啊实打实 ');
INSERT INTO `announcement` VALUES ('15', 'wwww', '2016-05-27 02:02:09', '崔俊11', 'C:\\WINDOWS\\system32\\drivers\\etc\\hosts', 'wq');
INSERT INTO `announcement` VALUES ('16', '导航的', '2016-05-27 02:20:50', '崔俊11', 'C:\\WINDOWS\\system32\\drivers\\etc\\protocol', '');
INSERT INTO `announcement` VALUES ('17', '555', '2016-05-27 04:44:48', '崔俊11', '（王珮珮-修正版）诚合和监所动态管理平台.doc', '');
INSERT INTO `announcement` VALUES ('18', 'text', '2016-05-27 07:16:09', '崔俊11', 'C:\\WINDOWS\\system32\\drivers\\etc\\protocol', '');
INSERT INTO `announcement` VALUES ('19', '666', '2016-05-27 07:17:13', '崔俊11', '（王珮珮-修正版）诚合和监所动态管理平台.doc', '');
INSERT INTO `announcement` VALUES ('20', '给给给', '2016-05-27 07:20:25', '崔俊11', '平台二：诚合和监所动态管理平台需求文档0405 (1).docx', '');
INSERT INTO `announcement` VALUES ('21', '啊啊', '2016-05-28 09:07:17', '崔俊11', '平台二：诚合和监所动态管理平台需求文档0405 (1).docx', '');
INSERT INTO `announcement` VALUES ('22', '江湖告急', '2016-05-28 09:28:58', '崔俊11', '监所动态疑问_崔俊.docx', '');
INSERT INTO `announcement` VALUES ('23', '111', '2016-05-28 09:41:52', '崔俊11', 'py.php', '');
INSERT INTO `announcement` VALUES ('24', 'hgj ', '2016-05-28 09:42:26', '崔俊11', 'C:\\WINDOWS\\system32\\drivers\\etc\\protocol', '');
INSERT INTO `announcement` VALUES ('25', 'aa ', '2016-05-28 09:43:02', '崔俊11', 'C:\\Documents and Settings\\Administrator\\桌面\\新建 文本文档.txt', '');
INSERT INTO `announcement` VALUES ('26', 'qq', '2016-05-28 09:46:01', '崔俊11', 'C:\\Documents and Settings\\Administrator\\桌面\\新建 文本文档.txt', '');
INSERT INTO `announcement` VALUES ('27', 'fasd ', '2016-05-28 09:47:20', '崔俊11', 'C:\\Documents and Settings\\Administrator\\桌面\\新建 文本文档.txt', '');
INSERT INTO `announcement` VALUES ('28', '请我', '2016-05-28 09:55:29', '崔俊11', '账号等.txt', '');

-- ----------------------------
-- Table structure for chuchai
-- ----------------------------
DROP TABLE IF EXISTS `chuchai`;
CREATE TABLE `chuchai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` int(11) NOT NULL COMMENT '所属机构',
  `cc_ren` text NOT NULL COMMENT '出差人员',
  `cc_count` int(5) NOT NULL COMMENT '出差人数',
  `apply_ren` int(11) DEFAULT NULL COMMENT '申请人',
  `apply_time` datetime NOT NULL COMMENT '申请时间',
  `cc_date` date NOT NULL COMMENT '出差时间',
  `end_date` date NOT NULL COMMENT '结束时间',
  `cc_place` varchar(50) NOT NULL COMMENT '出差地点',
  `cc_task` text NOT NULL COMMENT '出差任务',
  `cc_transporation` varchar(80) NOT NULL COMMENT '交通工具',
  `dept_leader` int(11) NOT NULL COMMENT '科室领导审核',
  `dept_audit` int(3) NOT NULL DEFAULT '0' COMMENT '科室审核状态 0,未审核、1,同意、2,驳回',
  `dept_audit_time` datetime DEFAULT NULL COMMENT '科室审核时间',
  `dept_reason` varchar(300) DEFAULT NULL COMMENT '科室审核理由',
  `branch_leader` int(11) DEFAULT NULL COMMENT '分管领导',
  `branch_audit` int(3) DEFAULT '0' COMMENT '分管领导 0,未审核、1,同意、2,驳回',
  `branch_audit_time` datetime DEFAULT NULL COMMENT '审核时间',
  `branch_reason` varchar(300) DEFAULT NULL COMMENT '驳回理由',
  `chief` int(11) DEFAULT NULL COMMENT '检察长',
  `chief_audit` int(3) DEFAULT '0' COMMENT '检察长审核状态0,未审核、1,同意、2,驳回',
  `chief_audit_time` datetime DEFAULT NULL,
  `chief_reason` varchar(50) DEFAULT NULL,
  `user_delete` tinyint(2) DEFAULT '0' COMMENT '用户是否删除（0未删除 ,1删除）',
  `dept_delete` tinyint(2) DEFAULT '0' COMMENT '科室领导是否删除',
  `branch_delete` tinyint(2) DEFAULT '0',
  `chief_delete` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='出差管理';

-- ----------------------------
-- Records of chuchai
-- ----------------------------
INSERT INTO `chuchai` VALUES ('1', '1', '1', '1', '1', '2016-05-28 14:35:14', '2016-05-31', '2016-05-26', 'dsafasdf', 'sdfsdfsdf', 'sdafadf', '1', '0', '2016-05-28 14:36:03', '2', '1', '0', '2016-05-28 14:36:20', 'asdf', '0', '0', '2016-05-28 14:36:36', 'asdfadsf', '0', '0', '0', '0');
INSERT INTO `chuchai` VALUES ('3', '5', '13,10,9,', '3', '1', '2016-05-28 15:24:54', '2016-05-18', '2016-05-26', '香港', '吃饭', '飞机', '15', '1', '2016-05-28 17:00:37', null, '14', '2', '2016-05-28 17:01:38', '不给过', '16', '0', null, null, '1', '0', '0', '0');
INSERT INTO `chuchai` VALUES ('4', '1', '1,2,3', '3', '1', '2016-05-28 15:48:16', '2016-05-31', '2016-06-03', '出差地点', '出差任务', '交通工具', '1', '0', null, null, '2', '0', null, null, '0', '0', null, null, '0', '0', '0', '0');
INSERT INTO `chuchai` VALUES ('5', '1', '1,2,3', '3', '1', '2016-05-28 15:49:39', '2016-05-31', '2016-06-03', '出差地点', '出差任务', '交通工具', '1', '0', null, null, '2', '0', null, null, '0', '0', null, null, '0', '0', '0', '0');
INSERT INTO `chuchai` VALUES ('6', '5', '13,10,9,', '3', '1', '2016-05-28 15:50:46', '2016-05-25', '2016-05-26', '法国', '办公', '飞机', '15', '1', '2016-05-28 17:02:44', null, '14', '1', '2016-05-28 17:03:09', null, '16', '0', null, null, '0', '0', '1', '0');
INSERT INTO `chuchai` VALUES ('7', '1', '1,2,3', '3', '1', '2016-05-28 15:53:20', '2016-05-31', '2016-06-03', '出差地点', '出差任务', '交通工具', '1', '0', null, null, '2', '0', null, null, '0', '0', null, null, '0', '0', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='机构通讯录';

-- ----------------------------
-- Records of dept_contact
-- ----------------------------
INSERT INTO `dept_contact` VALUES ('1', '科室一', '机构（一）', '2', '8');
INSERT INTO `dept_contact` VALUES ('2', '科室二', '科室二', null, null);
INSERT INTO `dept_contact` VALUES ('4', '科室四', '科室四', '1', '1');
INSERT INTO `dept_contact` VALUES ('5', '科室五', '科室二', '2', '8');
INSERT INTO `dept_contact` VALUES ('6', '科室六', 'dept1', '1', '1');
INSERT INTO `dept_contact` VALUES ('7', '科室七', '科室二', null, null);
INSERT INTO `dept_contact` VALUES ('3', '科室三', '科室三', null, null);

-- ----------------------------
-- Table structure for gongchu
-- ----------------------------
DROP TABLE IF EXISTS `gongchu`;
CREATE TABLE `gongchu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` int(11) NOT NULL COMMENT '所属机构',
  `gc_ren` text NOT NULL COMMENT '公出人',
  `gc_count` int(5) NOT NULL COMMENT '公出人数',
  `gc_time` datetime NOT NULL COMMENT '公出时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `gc_place` varchar(50) DEFAULT NULL COMMENT '公出地点',
  `ygwc` text NOT NULL COMMENT '因公外出',
  `jb_ren` int(11) NOT NULL COMMENT '经办人',
  `dept_leader` int(11) NOT NULL COMMENT '科室领导',
  `dept_audit` int(3) NOT NULL COMMENT '科室领导审核状态（0，未审核、1，同意、2，驳回）',
  `dept_audit_time` datetime DEFAULT NULL COMMENT '科室领导审核时间',
  `dept_reason` varchar(300) DEFAULT NULL COMMENT '驳回原因',
  `yuan_leader` int(11) NOT NULL COMMENT '院领导',
  `yuan_audit` int(3) NOT NULL COMMENT '院领导审核状态（0，未审核、1，同意、2，驳回）',
  `yuan_audit_time` datetime DEFAULT NULL COMMENT '院领导审核时间',
  `yuan_reason` varchar(300) DEFAULT NULL COMMENT '驳回原因',
  `user_delete` tinyint(2) DEFAULT '0' COMMENT '申请人删除（0未删除，1删除）',
  `dept_delete` tinyint(2) DEFAULT '0' COMMENT '科室审核删除（0未删除，1删除）',
  `yuan_delete` tinyint(2) DEFAULT '0' COMMENT '院审核删除（0未删除，1删除）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='公出管理表';

-- ----------------------------
-- Records of gongchu
-- ----------------------------
INSERT INTO `gongchu` VALUES ('1', '1', '1,2,8,', '3', '2016-05-25 00:00:00', '2016-05-25 00:00:00', '福建', '我多发点发呆发呆发呆大大方方', '1', '2', '0', '0000-00-00 00:00:00', null, '8', '0', '0000-00-00 00:00:00', null, '0', '0', '0');
INSERT INTO `gongchu` VALUES ('2', '1', '1,2,', '2', '2016-05-25 00:00:00', '2016-05-27 00:00:00', '福建您好', '你好大啊啊', '1', '2', '0', '0000-00-00 00:00:00', null, '8', '0', '0000-00-00 00:00:00', null, '0', '0', '0');
INSERT INTO `gongchu` VALUES ('4', '5', '1,2,8,9,', '4', '2016-06-01 12:10:00', '2016-06-03 12:10:00', '南京', '对方的房间的了房间的', '1', '14', '2', '0000-00-00 00:00:00', '过程不规范', '15', '0', '0000-00-00 00:00:00', null, '0', '0', '0');
INSERT INTO `gongchu` VALUES ('5', '5', '8,9,10,', '3', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '合肥', '合肥发地方地方', '1', '14', '1', '0000-00-00 00:00:00', null, '15', '1', '2016-05-27 16:37:32', '', '0', '0', '0');
INSERT INTO `gongchu` VALUES ('6', '5', '2,8,9,', '4', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '南京', '因公外出', '1', '14', '2', '0000-00-00 00:00:00', '院领导返驳原因', '15', '0', '0000-00-00 00:00:00', '', '0', '0', '0');
INSERT INTO `gongchu` VALUES ('7', '5', '1,2,8,10,', '3', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '公出地点', '因公外出', '1', '13', '1', '0000-00-00 00:00:00', null, '15', '1', '0000-00-00 00:00:00', null, '0', '0', '0');
INSERT INTO `gongchu` VALUES ('8', '5', '1,2,8,', '3', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '公出地点', '因公外出', '1', '13', '1', '0000-00-00 00:00:00', null, '14', '1', '0000-00-00 00:00:00', null, '0', '0', '0');
INSERT INTO `gongchu` VALUES ('9', '1', '12,11,', '2', '2016-05-27 00:00:00', '2016-05-28 00:00:00', '连云港', '吃喝', '14', '13', '1', '0000-00-00 00:00:00', null, '15', '1', '0000-00-00 00:00:00', null, '0', '0', '0');
INSERT INTO `gongchu` VALUES ('10', '1', '12,11,10,9,', '4', '2016-05-26 00:00:00', '2016-05-28 00:00:00', '闽侯', 'dfdfdf', '14', '16', '1', '0000-00-00 00:00:00', null, '15', '0', '0000-00-00 00:00:00', '', '0', '0', '0');
INSERT INTO `gongchu` VALUES ('11', '5', '1,2,8,', '3', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '公出地点', '因公外出', '1', '2', '0', null, null, '8', '0', null, null, '0', '0', '0');

-- ----------------------------
-- Table structure for kaoqin
-- ----------------------------
DROP TABLE IF EXISTS `kaoqin`;
CREATE TABLE `kaoqin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='考勤表';

-- ----------------------------
-- Records of kaoqin
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
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '个人办公管理', '10', '', 'personwork', 'personwork', 'index', '1', '0', '1', '1');
INSERT INTO `menu` VALUES ('14', '新增', '0', '', 'menu', 'menu', 'create', '', '13', '0', '1');
INSERT INTO `menu` VALUES ('2', '未办工作', '0', null, 'personwork', 'personwork', 'index', '1', '1', '1', '1');
INSERT INTO `menu` VALUES ('3', '代办工作', '0', null, 'personwork', 'personwork', 'index', '2', '1', '1', '1');
INSERT INTO `menu` VALUES ('4', '已办工作', '0', null, 'personwork', 'personwork', 'index', '3', '1', '1', '1');
INSERT INTO `menu` VALUES ('5', '逾期未办', '0', null, 'personwork', 'personwork', 'index', '4', '1', '1', '1');
INSERT INTO `menu` VALUES ('6', '综合办公管理', '9', null, 'zhgbgl', 'zhgbgl', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('7', '行政办公管理', '8', '', 'xzbggl', 'xzbggl', 'index', '', '0', '1', '1');
INSERT INTO `menu` VALUES ('8', '通知公告管理', '7', '', 'tzgggl', 'tzgggl', 'index', '', '0', '1', '1');
INSERT INTO `menu` VALUES ('9', '通讯录管理', '6', '', 'txlgl', 'txlgl', 'index', '', '0', '1', '1');
INSERT INTO `menu` VALUES ('104', '新增考题', '0', '', 'studytk', 'studytk', 'create', '', '103', '0', '1');
INSERT INTO `menu` VALUES ('11', '账号管理', '0', null, 'user', 'user', 'index', null, '0', '1', '1');
INSERT INTO `menu` VALUES ('12', '角色管理', '0', null, 'role', 'role', 'index', '', '11', '1', '1');
INSERT INTO `menu` VALUES ('13', '菜单管理', '0', null, 'menu', 'menu', 'index', null, '11', '1', '1');
INSERT INTO `menu` VALUES ('15', '修改', '0', '', 'menu', 'menu', 'update', '', '13', '0', '1');
INSERT INTO `menu` VALUES ('16', '删除', '0', '', 'menu', 'menu', 'delete', '', '13', '0', '1');
INSERT INTO `menu` VALUES ('17', '账号管理', '1', null, 'user', 'user', 'index', null, '11', '1', '1');
INSERT INTO `menu` VALUES ('18', '新增', '0', '', 'user', 'user', 'create', '', '17', '0', '1');
INSERT INTO `menu` VALUES ('19', '修改', '0', '', 'user', 'user', 'update', '', '17', '0', '1');
INSERT INTO `menu` VALUES ('20', '删除', '0', '', 'user', 'user', 'delete', '', '17', '0', '1');
INSERT INTO `menu` VALUES ('21', '密码修改', '0', '', 'user', 'user', 'update-pwd', '', '17', '0', '1');
INSERT INTO `menu` VALUES ('22', '新增', '0', '', 'role', 'role', 'create', '', '12', '0', '1');
INSERT INTO `menu` VALUES ('23', '修改', '0', '', 'role', 'role', 'update', '', '12', '0', '1');
INSERT INTO `menu` VALUES ('24', '删除', '0', '', 'role', 'role', 'delete', '', '12', '0', '1');
INSERT INTO `menu` VALUES ('25', '权限分配', '0', '', 'role', 'role', 'permissions', '', '12', '0', '1');
INSERT INTO `menu` VALUES ('26', '人员通讯录', '0', '', 'peoplecontact', 'peoplecontact', 'index', '', '9', '1', '1');
INSERT INTO `menu` VALUES ('27', '机构信息', '2', '', 'deptcontact', 'deptcontact', 'index', '', '9', '1', '1');
INSERT INTO `menu` VALUES ('28', '发起工作', '0', '', 'personwork', 'personwork', 'index', '5', '1', '1', '1');
INSERT INTO `menu` VALUES ('29', '新增', '0', '', 'personwork', 'personwork', 'create', '5', '28', '0', '1');
INSERT INTO `menu` VALUES ('30', '新增机构', '0', '', 'deptcontact', 'deptcontact', 'create', '', '27', '0', '1');
INSERT INTO `menu` VALUES ('31', '查看', '0', '', 'deptcontact', 'deptcontact', 'view', '', '27', '0', '1');
INSERT INTO `menu` VALUES ('32', '修改', '0', '', 'deptcontact', 'deptcontact', 'update', '', '27', '0', '1');
INSERT INTO `menu` VALUES ('33', '删除', '0', '', 'deptcontact', 'deptcontact', 'delete', '', '27', '0', '1');
INSERT INTO `menu` VALUES ('34', '查看', '0', '', 'personwork', 'personwork', 'view', '5', '28', '0', '1');
INSERT INTO `menu` VALUES ('35', '催办', '0', '', 'personwork', 'personwork', 'cuiban', '5', '28', '0', '1');
INSERT INTO `menu` VALUES ('36', '删除', '0', '', 'personwork', 'personwork', 'delete', '5', '28', '0', '1');
INSERT INTO `menu` VALUES ('37', '受理', '0', '', 'personwork', 'personwork', 'sl', '1', '2', '0', '1');
INSERT INTO `menu` VALUES ('38', '审批', '0', '', 'personwork', 'personwork', 'sp', '1', '2', '0', '1');
INSERT INTO `menu` VALUES ('39', '驳回', '0', '', 'personwork', 'personwork', 'spbh', '1', '38', '0', '1');
INSERT INTO `menu` VALUES ('40', '同意', '0', '', 'personwork', 'personwork', 'spty', '1', '38', '0', '1');
INSERT INTO `menu` VALUES ('41', '代办', '0', '', 'personwork', 'personwork', 'sldb', '1', '37', '0', '1');
INSERT INTO `menu` VALUES ('42', '退办', '0', '', 'personwork', 'personwork', 'sltb', '1', '37', '0', '1');
INSERT INTO `menu` VALUES ('43', '完成', '0', '', 'personwork', 'personwork', 'slwc', '1', '37', '0', '1');
INSERT INTO `menu` VALUES ('44', '公出管理', '0', '', 'gongchu', 'gongchu', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('45', '受理', '0', '', 'personwork', 'personwork', 'sl', '2', '3', '0', '1');
INSERT INTO `menu` VALUES ('46', '审批记录', '0', '', 'gongchu', 'audit', 'index', '', '44', '1', '1');
INSERT INTO `menu` VALUES ('47', '退办', '0', '', 'personwork', 'personwork', 'sltb', '2', '45', '0', '1');
INSERT INTO `menu` VALUES ('48', '完成', '0', '', 'personwork', 'personwork', 'slwc', '2', '45', '0', '1');
INSERT INTO `menu` VALUES ('49', '公出申请', '0', '', 'gongchu', 'gongchu', 'create', '', '44', '0', '1');
INSERT INTO `menu` VALUES ('50', '查看', '0', '', 'personwork', 'personwork', 'view', '3', '4', '0', '1');
INSERT INTO `menu` VALUES ('52', '删除', '0', '', 'personwork', 'personwork', 'deletefalse', '3', '4', '0', '1');
INSERT INTO `menu` VALUES ('53', '添加人员', '0', '', 'peoplecontact', 'peoplecontact', 'create', '', '26', '0', '1');
INSERT INTO `menu` VALUES ('54', '查看', '0', '', 'peoplecontact', 'peoplecontact', 'view', '', '26', '0', '1');
INSERT INTO `menu` VALUES ('55', '修改', '0', '', 'peoplecontact', 'peoplecontact', 'update', '', '26', '0', '1');
INSERT INTO `menu` VALUES ('56', '删除', '0', '', 'peoplecontact', 'peoplecontact', 'delete', '', '26', '0', '1');
INSERT INTO `menu` VALUES ('59', '通知公告', '0', '', 'tzgggl', 'tzgggl', 'index', '', '8', '1', '1');
INSERT INTO `menu` VALUES ('60', '新建', '0', '', 'tzgggl', 'tzgggl', 'create', '', '59', '0', '1');
INSERT INTO `menu` VALUES ('61', '查看', '0', '', 'tzgggl', 'tzgggl', 'view', '', '59', '0', '1');
INSERT INTO `menu` VALUES ('62', '修改', '0', '', 'tzgggl', 'tzgggl', 'update', '', '59', '0', '1');
INSERT INTO `menu` VALUES ('103', '学习进修', '0', '', 'studytk', 'studytk', 'index', '', '98', '1', '1');
INSERT INTO `menu` VALUES ('99', '知识园地', '2', '', 'xxjxgl', 'xxjxgl', 'index', '', '98', '1', '1');
INSERT INTO `menu` VALUES ('68', '院内新闻', '0', '', 'news', 'news', 'index', '', '8', '1', '1');
INSERT INTO `menu` VALUES ('69', '新建', '0', '', 'news', 'news', 'create', '', '68', '0', '1');
INSERT INTO `menu` VALUES ('70', '修改', '0', '', 'news', 'news', 'update', '', '68', '0', '1');
INSERT INTO `menu` VALUES ('71', '查看', '0', '', 'news', 'news', 'view', '', '68', '0', '1');
INSERT INTO `menu` VALUES ('72', '查看', '0', '', 'gongchu', 'gongchu', 'view', '', '44', '0', '1');
INSERT INTO `menu` VALUES ('78', '工资查询', '0', '', 'wages', 'wages', 'index', '', '7', '1', '1');
INSERT INTO `menu` VALUES ('73', '删除', '0', '', 'gongchu', 'gongchu', 'delete', '', '44', '0', '1');
INSERT INTO `menu` VALUES ('77', '查看', '0', '', 'personwork', 'personwork', 'view', '4', '5', '0', '1');
INSERT INTO `menu` VALUES ('75', '审批', '0', '', 'gongchu', 'audit', 'update', '', '44', '0', '1');
INSERT INTO `menu` VALUES ('113', '审批', '0', '', 'chuchai', 'audit', 'update', '', '108', '0', '1');
INSERT INTO `menu` VALUES ('79', '报销管理', '0', '', '#', '#', '#', '', '7', '1', '1');
INSERT INTO `menu` VALUES ('80', '差旅费报销', '0', '', '#', '#', '#', '', '79', '1', '1');
INSERT INTO `menu` VALUES ('81', '申请记录', '0', '', 'travel', 'travel', 'index', '', '80', '1', '1');
INSERT INTO `menu` VALUES ('82', '审批记录', '0', '', 'travel', 'travel', 'record', '', '80', '1', '1');
INSERT INTO `menu` VALUES ('83', '机动车维修报销', '0', '', '#', '#', '#', '', '79', '1', '1');
INSERT INTO `menu` VALUES ('84', '申请记录', '0', '', 'car', 'car', 'index', '', '83', '1', '1');
INSERT INTO `menu` VALUES ('85', '审批记录', '0', '', 'car', 'car', 'record', '', '83', '1', '1');
INSERT INTO `menu` VALUES ('86', '会议报销', '0', '', '#', '#', '#', '', '79', '1', '1');
INSERT INTO `menu` VALUES ('87', '申请记录', '0', '', 'meet', 'meet', 'index', '', '86', '1', '1');
INSERT INTO `menu` VALUES ('88', '审批记录', '0', '', 'meet', 'meet', 'record', '', '86', '1', '1');
INSERT INTO `menu` VALUES ('89', '福利管理', '0', '', '#', '#', '#', '', '7', '1', '1');
INSERT INTO `menu` VALUES ('90', '我的申请记录', '0', '', 'welfa', 'welfa', 'index', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('91', '审批记录', '0', '', 'welfa', 'welfa', 'record', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('92', '福利领取', '0', '', 'welfa', 'welfa', 'myget', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('93', '办公用品管理', '0', '', '#', '#', '#', '', '7', '1', '1');
INSERT INTO `menu` VALUES ('94', '我的申请记录', '0', '', 'office', 'office', 'index', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('95', '审批记录', '0', '', 'office', 'office', 'record', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('96', '办公用品领取', '0', '', 'office', 'office', 'myget', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('98', '学习进修管理', '5', '', 'xxjxgl', 'xxjxgl', 'index', '', '0', '1', '1');
INSERT INTO `menu` VALUES ('123', '试卷', '0', '', 'studysj', 'studysj', 'index', '', '103', '1', '1');
INSERT INTO `menu` VALUES ('105', '查看', '0', '', 'studytk', 'studytk', 'view', '', '103', '0', '1');
INSERT INTO `menu` VALUES ('120', '新增案件案例', '0', '', 'xxjxgl', 'xxjxgl', 'create', '', '99', '0', '1');
INSERT INTO `menu` VALUES ('107', '导入', '0', '', 'wages', 'wages', 'loadexcel', '', '78', '0', '1');
INSERT INTO `menu` VALUES ('108', '出差管理', '0', '', 'chuchai', 'chuchai', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('109', '出差申请', '0', '', 'chuchai', 'chuchai', 'create', '', '108', '0', '1');
INSERT INTO `menu` VALUES ('110', '审批记录', '0', '', 'chuchai', 'audit', 'index', '', '108', '1', '1');
INSERT INTO `menu` VALUES ('111', '查看', '0', '', 'chuchai', 'chuchai', 'view', '', '108', '0', '1');
INSERT INTO `menu` VALUES ('112', '删除', '0', '', 'chuchai', 'chuchai', 'delete', '', '108', '0', '1');
INSERT INTO `menu` VALUES ('114', '报销申请', '0', '', 'travel', 'travel', 'create', '', '81', '0', '1');
INSERT INTO `menu` VALUES ('115', '申请记录', '1', '', 'gongchu', 'gongchu', 'index', '', '44', '1', '1');
INSERT INTO `menu` VALUES ('116', '申请记录', '1', '', 'chuchai', 'chuchai', 'index', '', '108', '1', '1');
INSERT INTO `menu` VALUES ('117', '查看', '0', '', 'travel', 'travel', 'view', '', '81', '0', '1');
INSERT INTO `menu` VALUES ('118', '删除', '0', '', 'travel', 'travel', 'delete', '', '81', '0', '1');
INSERT INTO `menu` VALUES ('119', '审批查看', '0', '', 'travel', 'travel', 'shenpi', '', '82', '0', '1');
INSERT INTO `menu` VALUES ('121', '审批同意', '0', '', 'travel', 'travel', 'spty', '', '82', '0', '1');
INSERT INTO `menu` VALUES ('122', '审批驳回', '0', '', 'travel', 'travel', 'spbh', '', '82', '0', '1');
INSERT INTO `menu` VALUES ('124', '考试纪律', '0', '', 'studyjl', 'studyjl', 'index', '', '103', '1', '1');
INSERT INTO `menu` VALUES ('125', '题库', '0', '', 'studytk', 'studytk', 'index', '', '103', '1', '1');
INSERT INTO `menu` VALUES ('126', '添加办公用品', '0', '', 'office', 'office', 'create', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('127', '查看办公用品', '0', '', 'office', 'office', 'view', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('128', '修改办公用品', '0', '', 'office', 'office', 'update', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('129', '办公用品申请', '0', '', 'office', 'office-apply', 'create', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('130', '修改', '0', '', 'studytk', 'studytk', 'update', '', '125', '0', '1');
INSERT INTO `menu` VALUES ('131', '审批删除', '0', '', 'travel', 'travel', 'spdelete', '', '82', '0', '1');

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
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
  `pubdate` datetime DEFAULT NULL COMMENT '发布时间',
  `author` varchar(50) DEFAULT NULL COMMENT '发布人',
  `attachment` varchar(200) NOT NULL COMMENT '附件',
  `content` text NOT NULL COMMENT '正文',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('2', '今天天气不错', null, '崔俊11', '', '');
INSERT INTO `news` VALUES ('3', '天气很好', null, '崔俊11', '', '');
INSERT INTO `news` VALUES ('4', 'bbb', null, '崔俊11', '', '');
INSERT INTO `news` VALUES ('5', 'cccc', null, '崔俊11', '', '');
INSERT INTO `news` VALUES ('9', '啊啊啊', null, '崔俊11', '', '');

-- ----------------------------
-- Table structure for office
-- ----------------------------
DROP TABLE IF EXISTS `office`;
CREATE TABLE `office` (
  `office_name` varchar(20) NOT NULL COMMENT '办公用品名称',
  `office_price` float NOT NULL COMMENT '预计单价',
  `office_part_id` varchar(20) NOT NULL COMMENT '适用机构ID',
  `office_num` int(11) NOT NULL COMMENT '库存数量',
  `office_start_time` datetime NOT NULL COMMENT '申请开始时间',
  `office_end_time` datetime NOT NULL COMMENT '申请结束时间',
  `office_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认为1，申请采购中的状态为0,通过申请采购审批后改为1',
  `office_part_name` varchar(100) NOT NULL COMMENT '适用机构名称，英文","号隔开',
  `office_type` varchar(20) NOT NULL COMMENT '用品类型',
  `office_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of office
-- ----------------------------
INSERT INTO `office` VALUES ('2222222222', '22222200', '', '2', '2016-05-28 16:05:00', '2016-06-05 00:00:00', '1', '21111e', '111111', '1');
INSERT INTO `office` VALUES ('w222', '212111000', '', '12', '2016-05-29 16:05:00', '2016-05-31 00:00:00', '1', '212', '12', '2');
INSERT INTO `office` VALUES ('2222222222', '3232220', '', '23', '2016-05-28 16:05:00', '2016-06-05 00:00:00', '1', '2323222222222222', '232', '3');
INSERT INTO `office` VALUES ('22222222222', '2333', '', '332', '2016-05-29 16:05:00', '2016-06-04 00:00:00', '1', 'we', '323', '5');

-- ----------------------------
-- Table structure for office_apply
-- ----------------------------
DROP TABLE IF EXISTS `office_apply`;
CREATE TABLE `office_apply` (
  `apply_id` int(11) NOT NULL,
  `apply_num` int(11) NOT NULL COMMENT '需要申请办公用品数量',
  `apply_office_id` int(11) NOT NULL COMMENT '办公用品ＩＤ',
  `apply_pack_id` int(11) NOT NULL COMMENT '行装科负责人ID',
  `apply_pack_result` varchar(200) NOT NULL COMMENT '行装科意见',
  `apply_genneral_result` varchar(200) NOT NULL COMMENT '检察长意见',
  `apply_mee_id` int(11) NOT NULL COMMENT '申请人账号ID',
  `apply_genneral_id` int(11) NOT NULL,
  `apply_pack_status` tinyint(4) NOT NULL COMMENT '行装科审批状态',
  `apply_genneral_status` tinyint(4) NOT NULL COMMENT '检察长审批状态',
  `apply_remarks` text COMMENT '备注',
  `apply_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否审批工作总状态,默认0不通过,1为通过',
  PRIMARY KEY (`apply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of office_apply
-- ----------------------------

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
  `wxone` int(8) DEFAULT NULL COMMENT '外线1',
  `wxtwo` int(8) DEFAULT NULL COMMENT '外线2',
  `inline` int(4) DEFAULT NULL COMMENT '内线',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='人员通讯录';

-- ----------------------------
-- Records of people_contact
-- ----------------------------
INSERT INTO `people_contact` VALUES ('1', 'aaaa', '1', '处长', '11111111111', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('2', '啊', '1', '科长', '15851865478', '111111', '1111111', '1111111');
INSERT INTO `people_contact` VALUES ('31', '挖潜那个啊', '1', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('30', '王啊', '2', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('21', '王嘉', '2', '科长', '13057018442', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('29', '几啊', '2', '科长', '13057018442', null, null, '1234');
INSERT INTO `people_contact` VALUES ('28', '人啊', '2', '科长', '13057018442', '12345678', null, null);
INSERT INTO `people_contact` VALUES ('27', '王嘉啊', '2', '科长', '13057018442', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('26', '人', '2', '科长', '13057018442', '12345678', null, null);
INSERT INTO `people_contact` VALUES ('24', '几', '2', '科长', '13057018442', null, null, '1234');
INSERT INTO `people_contact` VALUES ('23', '王', '2', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('22', '挖潜那个', '1', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('25', '留', '1', '科长', '13057018442', '12345678', '45678923', '1234');
INSERT INTO `people_contact` VALUES ('32', '留啊', '1', '科长', '13057018442', '12345678', '45678923', '1234');
INSERT INTO `people_contact` VALUES ('33', '王嘉啊', '2', '科长', '13057018442', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('34', '人啊', '2', '科长', '13057018442', '12345678', null, null);
INSERT INTO `people_contact` VALUES ('35', '几啊', '2', '科长', '13057018442', null, null, '1234');
INSERT INTO `people_contact` VALUES ('36', '王啊', '2', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('37', '挖潜那个啊', '1', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('38', '留啊', '1', '科长', '13057018442', '12345678', '45678923', '1234');
INSERT INTO `people_contact` VALUES ('39', '王嘉啊', '2', '科长', '13057018442', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('40', '人啊', '2', '科长', '13057018442', '12345678', null, null);
INSERT INTO `people_contact` VALUES ('41', '几啊', '2', '科长', '13057018442', null, null, '1234');
INSERT INTO `people_contact` VALUES ('42', '王啊', '2', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('43', '挖潜那个啊', '1', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('44', '留啊', '1', '科长', '13057018442', '12345678', '45678923', '1234');

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
  `p_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='个人办公管理';

-- ----------------------------
-- Records of person_work
-- ----------------------------
INSERT INTO `person_work` VALUES ('2', 'asdfadf', '2016-05-11 14:33:15', '2016-05-20 14:33:20', '2016-05-12 14:33:23', '一般', '0', null, null, null, '', null, '0');
INSERT INTO `person_work` VALUES ('4', 'AAA', '2016-05-25 15:05:00', '2016-05-28 15:05:00', '2016-05-25 15:06:22', '一般', '1', '1', '崔俊11', '8', 'AAA', null, '1');
INSERT INTO `person_work` VALUES ('5', 'BBBBB', '2016-05-25 15:05:00', '2016-05-27 15:05:00', '2016-05-25 15:15:02', '一般', '1', '1', '崔俊11', '8', 'BBBBB', null, '1');
INSERT INTO `person_work` VALUES ('6', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:15:53', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('7', 'ccccc', '2016-05-25 15:05:00', '2016-05-26 15:05:00', '2016-05-25 15:16:13', '一般', '1', '1,8', '崔俊11,审批', '1,5,8', 'ccccc', 'CCCCCC', '1');
INSERT INTO `person_work` VALUES ('8', 'DDDD', '2016-05-25 15:05:00', '2016-05-29 15:05:00', '2016-05-25 15:18:45', '一般', '1', '1,8', '崔俊11,审批', '', 'DDDD', null, '1');
INSERT INTO `person_work` VALUES ('9', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:19:39', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('10', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:21:39', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('11', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:22:23', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('12', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:24:13', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('13', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:24:20', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('14', 'jjjjj', '2016-05-25 15:05:00', '2016-05-28 15:05:00', '2016-05-25 15:24:59', '一般', '1', '1,8', '崔俊11,审批', '', 'ssss', 'XXXXXXX', '1');
INSERT INTO `person_work` VALUES ('15', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:26:45', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('16', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 15:32:27', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('17', '买东西', '2016-05-25 15:05:00', '2016-06-05 15:06:00', '2016-05-25 15:41:40', '一般', '1', '1', '崔俊11', '', '1111', null, '1');
INSERT INTO `person_work` VALUES ('35', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 17:12:23', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('36', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 17:13:14', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('38', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 17:18:56', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '3,4', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('39', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 17:20:57', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('40', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 19:59:24', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('41', 'Imj yaa ', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 19:59:36', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('42', 'Imj yaa ', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 20:01:24', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('43', 'Imj yaa ', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 20:01:25', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('44', 'aaaa ', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-25 20:02:06', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('45', 'hhhhh', '2016-05-26 10:05:00', '2016-06-05 10:06:00', '2016-05-26 10:18:43', '一般', '1', '1', '崔俊1111', '1,8', 'hhhhh', '21321', '1');
INSERT INTO `person_work` VALUES ('46', '测试', '2016-05-26 13:05:00', '2016-05-28 13:05:00', '2016-05-26 13:02:29', '一般', '1', '1', '崔俊1111', '1,2,8', 'qq群', null, '1');
INSERT INTO `person_work` VALUES ('47', '1111', '2016-05-26 15:05:00', '2016-05-28 15:05:00', '2016-05-26 15:41:55', '一般', '1', '2,8', '崔俊,审批', '8,11,2', '121212', null, '1');
INSERT INTO `person_work` VALUES ('48', '111', '2016-05-26 15:05:00', '2016-05-29 15:05:00', '2016-05-26 15:56:11', '一般', '1', '1', '崔俊11', '1', '213213', null, '1');
INSERT INTO `person_work` VALUES ('49', '111', '2016-05-26 17:05:00', '2016-05-28 17:05:00', '2016-05-26 17:48:25', '一般', '1', '2,8', '崔俊,审批', '', '666', null, '1');
INSERT INTO `person_work` VALUES ('50', '张三', '2016-05-26 17:05:00', '2016-05-29 17:05:00', '2016-05-26 17:51:12', '一般', '1', '9,10', '审批2,审批3', '9,10,13', '轻轻巧巧', null, '0');
INSERT INTO `person_work` VALUES ('51', 'test', '2016-05-27 09:05:00', '2016-05-29 09:05:00', '2016-05-27 09:02:45', '紧急', '1', '2,1', '崔俊11,崔俊', '', '999', '99', '1');
INSERT INTO `person_work` VALUES ('52', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-27 11:17:57', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('53', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-27 11:19:01', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');

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
  `w_cancel_details` varchar(500) DEFAULT NULL COMMENT '退办原因',
  `w_y_slr` int(11) DEFAULT NULL COMMENT '原受理人',
  `w_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='个人办公工作流表';

-- ----------------------------
-- Records of person_work_workflow
-- ----------------------------
INSERT INTO `person_work_workflow` VALUES ('8', '2', '8', '0', '2016-05-25 13:17:03', '2016-05-25 13:37:48', '未受理', '无', '代办', 'XXXXXXX', null, '0');
INSERT INTO `person_work_workflow` VALUES ('10', '4', '8', '0', '2016-05-25 15:06:22', '2016-05-25 15:06:47', '未审批', '同意', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('11', '4', '1', '0', '2016-05-25 15:06:47', '2016-05-25 15:14:18', '未受理', '完成', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('12', '5', '8', '0', '2016-05-25 15:15:02', '2016-05-25 15:15:11', '未审批', '同意', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('13', '5', '1', '0', '2016-05-25 15:15:11', '2016-05-25 15:15:22', '未受理', '完成', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('14', '7', '1', '0', '2016-05-25 15:16:13', '2016-05-26 10:51:51', '未受理', '同意', '普通', '', null, '1');
INSERT INTO `person_work_workflow` VALUES ('16', '8', '1', '0', '2016-05-25 15:18:45', '2016-05-25 15:18:57', '未受理', '代办', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('18', '8', '8', '0', '2016-05-25 15:18:57', '2016-05-25 15:21:16', '未受理', '完成', '代办', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('19', '14', '1', '0', '2016-05-25 15:24:59', '2016-05-25 15:25:14', '未受理', '代办', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('20', '14', '8', '0', '2016-05-25 15:24:59', '2016-05-25 15:34:47', '未受理', '完成', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('21', '14', '8', '0', '2016-05-25 15:25:14', '2016-05-25 15:35:14', '未受理', '退办', '代办', 'XXXXXXX', null, '1');
INSERT INTO `person_work_workflow` VALUES ('22', '15', '3', '0', '2016-05-25 15:26:45', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('23', '16', '3', '0', '2016-05-25 15:32:27', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('24', '17', '1', '0', '2016-05-25 15:41:40', '2016-05-25 15:42:00', '未受理', '代办', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('25', '17', '8', '0', '2016-05-25 15:42:00', null, '未受理', '无', '代办', null, '1', '1');
INSERT INTO `person_work_workflow` VALUES ('30', '35', '3', '0', '2016-05-25 17:12:23', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('31', '36', '3', '0', '2016-05-25 17:13:14', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('32', '38', '3', '0', '2016-05-25 17:18:56', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('33', '39', '1', '0', '2016-05-25 17:20:57', '2016-05-26 12:41:24', '未受理', '代办', '普通', null, null, '0');
INSERT INTO `person_work_workflow` VALUES ('34', '39', '2', '0', '2016-05-25 17:20:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('35', '39', '8', '0', '2016-05-25 17:20:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('36', '39', '9', '0', '2016-05-25 17:20:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('37', '45', '1', '0', '2016-05-26 10:18:43', '2016-05-26 11:22:07', '未审批', '无', '普通', '', null, '1');
INSERT INTO `person_work_workflow` VALUES ('42', '7', '5', '1', '2016-05-26 10:51:51', '2016-05-26 10:52:13', '未审批', '同意', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('43', '7', '8', '2', '2016-05-26 10:52:13', '2016-05-26 10:52:31', '未审批', '同意', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('44', '7', '1', '0', '2016-05-26 10:52:31', '2016-05-26 13:26:10', '未受理', '代办', '普通', '', null, '1');
INSERT INTO `person_work_workflow` VALUES ('45', '7', '8', '0', '2016-05-26 10:52:31', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('46', '45', '8', '1', '2016-05-26 11:22:07', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('47', '7', '8', '0', '2016-05-26 11:32:41', null, '未受理', '无', '代办', null, '1', '1');
INSERT INTO `person_work_workflow` VALUES ('48', '39', '8', '0', '2016-05-26 12:41:24', null, '未受理', '无', '代办', null, '1', '1');
INSERT INTO `person_work_workflow` VALUES ('49', '46', '1', '0', '2016-05-26 13:02:29', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('50', '7', '8', '0', '2016-05-26 13:26:10', null, '未受理', '无', '代办', null, '1', '1');
INSERT INTO `person_work_workflow` VALUES ('51', '47', '8', '0', '2016-05-26 15:41:55', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('52', '48', '1', '0', '2016-05-26 15:56:11', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('53', '49', '2', '0', '2016-05-26 17:48:25', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('54', '49', '8', '0', '2016-05-26 17:48:25', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('55', '50', '9', '0', '2016-05-26 17:51:12', null, '未审批', '无', '普通', null, null, '0');
INSERT INTO `person_work_workflow` VALUES ('56', '51', '2', '0', '2016-05-27 09:02:45', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('57', '51', '1', '0', '2016-05-27 09:02:45', '2016-05-27 09:04:01', '未受理', '退办', '普通', '99', null, '1');
INSERT INTO `person_work_workflow` VALUES ('58', '51', '1', '0', '2016-05-27 09:03:40', null, '未受理', '无', '代办', null, '1', '1');
INSERT INTO `person_work_workflow` VALUES ('59', '52', '1', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('60', '52', '2', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('61', '52', '8', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('62', '52', '9', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('63', '53', '1', '0', '2016-05-27 11:19:01', '2016-05-28 13:23:01', '未受理', '完成', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('64', '53', '2', '0', '2016-05-27 11:19:01', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('65', '53', '8', '0', '2016-05-27 11:19:01', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('66', '53', '9', '0', '2016-05-27 11:19:01', null, '未受理', '无', '普通', null, null, '1');

-- ----------------------------
-- Table structure for person_work_workflow_bak
-- ----------------------------
DROP TABLE IF EXISTS `person_work_workflow_bak`;
CREATE TABLE `person_work_workflow_bak` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `w_p_id` int(11) NOT NULL COMMENT '对应person_work表记录id',
  `w_person_id` int(11) NOT NULL COMMENT '处理人员',
  `w_person_key` char(10) NOT NULL COMMENT '处理人员key值',
  `w_s_time` datetime NOT NULL COMMENT '处理开始时间',
  `w_e_time` datetime DEFAULT NULL COMMENT '处理结束时间',
  `w_s_status` enum('未受理','未审批') NOT NULL COMMENT '开始办理专题',
  `w_type` enum('代办','普通') NOT NULL DEFAULT '普通' COMMENT '是否是代办(只针对受理者)',
  `w_e_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='个人办公工作流表';

-- ----------------------------
-- Records of person_work_workflow_bak
-- ----------------------------
INSERT INTO `person_work_workflow_bak` VALUES ('10', '5', '1', '0', '0000-00-00 00:00:00', '2016-05-24 18:44:58', '未审批', '普通', '1');
INSERT INTO `person_work_workflow_bak` VALUES ('13', '5', '8', '1', '2016-05-24 18:27:12', '2016-05-24 18:59:07', '未审批', '普通', '2');
INSERT INTO `person_work_workflow_bak` VALUES ('16', '5', '1', '0', '2016-05-24 18:59:07', null, '未受理', '普通', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1', '1', '超级管理员');
INSERT INTO `role` VALUES ('2', '技术部管理员', '1', '1', '技术部管理员');
INSERT INTO `role` VALUES ('6', '审批角色', '0', '1', '审批角色');
INSERT INTO `role` VALUES ('10', '科长一', '0', '1', '科长一');
INSERT INTO `role` VALUES ('11', '科员一', '0', '1', '科员一');
INSERT INTO `role` VALUES ('12', '科长二', '0', '1', '科长二');

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=959 DEFAULT CHARSET=utf8 COMMENT='角色菜单关联表';

-- ----------------------------
-- Records of role_menu
-- ----------------------------
INSERT INTO `role_menu` VALUES ('59', '3', '12');
INSERT INTO `role_menu` VALUES ('60', '3', '23');
INSERT INTO `role_menu` VALUES ('61', '3', '24');
INSERT INTO `role_menu` VALUES ('951', '6', '22');
INSERT INTO `role_menu` VALUES ('950', '6', '12');
INSERT INTO `role_menu` VALUES ('949', '6', '21');
INSERT INTO `role_menu` VALUES ('948', '6', '20');
INSERT INTO `role_menu` VALUES ('947', '6', '19');
INSERT INTO `role_menu` VALUES ('946', '6', '18');
INSERT INTO `role_menu` VALUES ('945', '6', '17');
INSERT INTO `role_menu` VALUES ('773', '1', '16');
INSERT INTO `role_menu` VALUES ('772', '1', '15');
INSERT INTO `role_menu` VALUES ('771', '1', '14');
INSERT INTO `role_menu` VALUES ('770', '1', '13');
INSERT INTO `role_menu` VALUES ('769', '1', '25');
INSERT INTO `role_menu` VALUES ('768', '1', '24');
INSERT INTO `role_menu` VALUES ('767', '1', '23');
INSERT INTO `role_menu` VALUES ('766', '1', '22');
INSERT INTO `role_menu` VALUES ('765', '1', '12');
INSERT INTO `role_menu` VALUES ('764', '1', '21');
INSERT INTO `role_menu` VALUES ('763', '1', '20');
INSERT INTO `role_menu` VALUES ('762', '1', '19');
INSERT INTO `role_menu` VALUES ('761', '1', '18');
INSERT INTO `role_menu` VALUES ('760', '1', '17');
INSERT INTO `role_menu` VALUES ('759', '1', '11');
INSERT INTO `role_menu` VALUES ('758', '1', '55');
INSERT INTO `role_menu` VALUES ('757', '1', '54');
INSERT INTO `role_menu` VALUES ('756', '1', '53');
INSERT INTO `role_menu` VALUES ('755', '1', '26');
INSERT INTO `role_menu` VALUES ('754', '1', '33');
INSERT INTO `role_menu` VALUES ('753', '1', '32');
INSERT INTO `role_menu` VALUES ('752', '1', '31');
INSERT INTO `role_menu` VALUES ('751', '1', '30');
INSERT INTO `role_menu` VALUES ('750', '1', '27');
INSERT INTO `role_menu` VALUES ('749', '1', '7');
INSERT INTO `role_menu` VALUES ('748', '1', '49');
INSERT INTO `role_menu` VALUES ('747', '1', '46');
INSERT INTO `role_menu` VALUES ('746', '1', '44');
INSERT INTO `role_menu` VALUES ('745', '1', '6');
INSERT INTO `role_menu` VALUES ('744', '1', '36');
INSERT INTO `role_menu` VALUES ('743', '1', '35');
INSERT INTO `role_menu` VALUES ('742', '1', '34');
INSERT INTO `role_menu` VALUES ('741', '1', '29');
INSERT INTO `role_menu` VALUES ('740', '1', '28');
INSERT INTO `role_menu` VALUES ('739', '1', '52');
INSERT INTO `role_menu` VALUES ('738', '1', '50');
INSERT INTO `role_menu` VALUES ('737', '1', '47');
INSERT INTO `role_menu` VALUES ('736', '1', '45');
INSERT INTO `role_menu` VALUES ('735', '1', '40');
INSERT INTO `role_menu` VALUES ('869', '2', '17');
INSERT INTO `role_menu` VALUES ('868', '2', '11');
INSERT INTO `role_menu` VALUES ('867', '2', '26');
INSERT INTO `role_menu` VALUES ('866', '2', '27');
INSERT INTO `role_menu` VALUES ('865', '2', '9');
INSERT INTO `role_menu` VALUES ('864', '2', '8');
INSERT INTO `role_menu` VALUES ('863', '2', '7');
INSERT INTO `role_menu` VALUES ('862', '2', '112');
INSERT INTO `role_menu` VALUES ('861', '2', '111');
INSERT INTO `role_menu` VALUES ('860', '2', '110');
INSERT INTO `role_menu` VALUES ('859', '2', '109');
INSERT INTO `role_menu` VALUES ('858', '2', '113');
INSERT INTO `role_menu` VALUES ('857', '2', '116');
INSERT INTO `role_menu` VALUES ('856', '2', '108');
INSERT INTO `role_menu` VALUES ('855', '2', '75');
INSERT INTO `role_menu` VALUES ('854', '2', '73');
INSERT INTO `role_menu` VALUES ('853', '2', '72');
INSERT INTO `role_menu` VALUES ('852', '2', '49');
INSERT INTO `role_menu` VALUES ('851', '2', '46');
INSERT INTO `role_menu` VALUES ('850', '2', '115');
INSERT INTO `role_menu` VALUES ('849', '2', '44');
INSERT INTO `role_menu` VALUES ('848', '2', '6');
INSERT INTO `role_menu` VALUES ('847', '2', '5');
INSERT INTO `role_menu` VALUES ('846', '2', '4');
INSERT INTO `role_menu` VALUES ('845', '2', '3');
INSERT INTO `role_menu` VALUES ('944', '6', '11');
INSERT INTO `role_menu` VALUES ('943', '6', '26');
INSERT INTO `role_menu` VALUES ('942', '6', '33');
INSERT INTO `role_menu` VALUES ('941', '6', '32');
INSERT INTO `role_menu` VALUES ('940', '6', '31');
INSERT INTO `role_menu` VALUES ('939', '6', '30');
INSERT INTO `role_menu` VALUES ('938', '6', '27');
INSERT INTO `role_menu` VALUES ('937', '6', '9');
INSERT INTO `role_menu` VALUES ('936', '6', '8');
INSERT INTO `role_menu` VALUES ('935', '6', '95');
INSERT INTO `role_menu` VALUES ('934', '6', '94');
INSERT INTO `role_menu` VALUES ('933', '6', '93');
INSERT INTO `role_menu` VALUES ('932', '6', '92');
INSERT INTO `role_menu` VALUES ('931', '6', '91');
INSERT INTO `role_menu` VALUES ('930', '6', '90');
INSERT INTO `role_menu` VALUES ('929', '6', '89');
INSERT INTO `role_menu` VALUES ('928', '6', '88');
INSERT INTO `role_menu` VALUES ('927', '6', '87');
INSERT INTO `role_menu` VALUES ('926', '6', '86');
INSERT INTO `role_menu` VALUES ('925', '6', '85');
INSERT INTO `role_menu` VALUES ('924', '6', '84');
INSERT INTO `role_menu` VALUES ('923', '6', '83');
INSERT INTO `role_menu` VALUES ('922', '6', '82');
INSERT INTO `role_menu` VALUES ('921', '6', '81');
INSERT INTO `role_menu` VALUES ('920', '6', '80');
INSERT INTO `role_menu` VALUES ('919', '6', '79');
INSERT INTO `role_menu` VALUES ('918', '6', '78');
INSERT INTO `role_menu` VALUES ('917', '6', '7');
INSERT INTO `role_menu` VALUES ('916', '6', '112');
INSERT INTO `role_menu` VALUES ('915', '6', '111');
INSERT INTO `role_menu` VALUES ('914', '6', '110');
INSERT INTO `role_menu` VALUES ('913', '6', '109');
INSERT INTO `role_menu` VALUES ('912', '6', '113');
INSERT INTO `role_menu` VALUES ('911', '6', '116');
INSERT INTO `role_menu` VALUES ('910', '6', '108');
INSERT INTO `role_menu` VALUES ('909', '6', '49');
INSERT INTO `role_menu` VALUES ('908', '6', '46');
INSERT INTO `role_menu` VALUES ('907', '6', '44');
INSERT INTO `role_menu` VALUES ('906', '6', '6');
INSERT INTO `role_menu` VALUES ('905', '6', '36');
INSERT INTO `role_menu` VALUES ('904', '6', '35');
INSERT INTO `role_menu` VALUES ('903', '6', '34');
INSERT INTO `role_menu` VALUES ('902', '6', '29');
INSERT INTO `role_menu` VALUES ('901', '6', '28');
INSERT INTO `role_menu` VALUES ('900', '6', '77');
INSERT INTO `role_menu` VALUES ('899', '6', '5');
INSERT INTO `role_menu` VALUES ('898', '6', '52');
INSERT INTO `role_menu` VALUES ('897', '6', '50');
INSERT INTO `role_menu` VALUES ('896', '6', '4');
INSERT INTO `role_menu` VALUES ('895', '6', '48');
INSERT INTO `role_menu` VALUES ('894', '6', '47');
INSERT INTO `role_menu` VALUES ('893', '6', '45');
INSERT INTO `role_menu` VALUES ('844', '2', '2');
INSERT INTO `role_menu` VALUES ('843', '2', '1');
INSERT INTO `role_menu` VALUES ('734', '1', '39');
INSERT INTO `role_menu` VALUES ('733', '1', '38');
INSERT INTO `role_menu` VALUES ('732', '1', '43');
INSERT INTO `role_menu` VALUES ('731', '1', '42');
INSERT INTO `role_menu` VALUES ('730', '1', '41');
INSERT INTO `role_menu` VALUES ('729', '1', '37');
INSERT INTO `role_menu` VALUES ('892', '6', '3');
INSERT INTO `role_menu` VALUES ('891', '6', '40');
INSERT INTO `role_menu` VALUES ('890', '6', '39');
INSERT INTO `role_menu` VALUES ('889', '6', '38');
INSERT INTO `role_menu` VALUES ('888', '6', '43');
INSERT INTO `role_menu` VALUES ('887', '6', '42');
INSERT INTO `role_menu` VALUES ('886', '6', '41');
INSERT INTO `role_menu` VALUES ('885', '6', '37');
INSERT INTO `role_menu` VALUES ('884', '6', '2');
INSERT INTO `role_menu` VALUES ('883', '6', '1');
INSERT INTO `role_menu` VALUES ('870', '2', '18');
INSERT INTO `role_menu` VALUES ('871', '2', '19');
INSERT INTO `role_menu` VALUES ('872', '2', '20');
INSERT INTO `role_menu` VALUES ('873', '2', '21');
INSERT INTO `role_menu` VALUES ('874', '2', '12');
INSERT INTO `role_menu` VALUES ('875', '2', '22');
INSERT INTO `role_menu` VALUES ('876', '2', '23');
INSERT INTO `role_menu` VALUES ('877', '2', '24');
INSERT INTO `role_menu` VALUES ('878', '2', '25');
INSERT INTO `role_menu` VALUES ('879', '2', '13');
INSERT INTO `role_menu` VALUES ('880', '2', '14');
INSERT INTO `role_menu` VALUES ('881', '2', '15');
INSERT INTO `role_menu` VALUES ('882', '2', '16');
INSERT INTO `role_menu` VALUES ('952', '6', '23');
INSERT INTO `role_menu` VALUES ('953', '6', '24');
INSERT INTO `role_menu` VALUES ('954', '6', '25');
INSERT INTO `role_menu` VALUES ('955', '6', '13');
INSERT INTO `role_menu` VALUES ('956', '6', '14');
INSERT INTO `role_menu` VALUES ('957', '6', '15');
INSERT INTO `role_menu` VALUES ('958', '6', '16');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='角色用户关联表';

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '1');
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
INSERT INTO `role_user` VALUES ('15', '13', '6');
INSERT INTO `role_user` VALUES ('16', '14', '6');
INSERT INTO `role_user` VALUES ('17', '15', '6');
INSERT INTO `role_user` VALUES ('18', '16', '6');

-- ----------------------------
-- Table structure for study_jl
-- ----------------------------
DROP TABLE IF EXISTS `study_jl`;
CREATE TABLE `study_jl` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '考试名称',
  `start_date` datetime NOT NULL COMMENT '开始考试时间',
  `username` varchar(50) NOT NULL COMMENT '人员姓名',
  `mechan` varchar(255) NOT NULL COMMENT '所属机构',
  `result` int(5) NOT NULL COMMENT '0(不通过)1(通过)',
  `pate_date` datetime NOT NULL COMMENT '参加考试时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_jl
-- ----------------------------

-- ----------------------------
-- Table structure for study_sj
-- ----------------------------
DROP TABLE IF EXISTS `study_sj`;
CREATE TABLE `study_sj` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '试卷名称',
  `mechanism` varchar(255) NOT NULL COMMENT '考试机构',
  `standard` varchar(20) NOT NULL COMMENT '合格标准',
  `start_time` datetime NOT NULL COMMENT '开始考试时间',
  `end_time` datetime NOT NULL COMMENT '结束考试时间',
  `status` int(20) NOT NULL COMMENT '0(未开始)1(进行中)2(结束时间)',
  `user` varchar(50) NOT NULL COMMENT '出卷人',
  `offen` varchar(20) NOT NULL COMMENT '考试时长',
  `questions` int(20) NOT NULL COMMENT '考试题数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_sj
-- ----------------------------

-- ----------------------------
-- Table structure for study_tk
-- ----------------------------
DROP TABLE IF EXISTS `study_tk`;
CREATE TABLE `study_tk` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '题目名',
  `users` varchar(50) NOT NULL COMMENT '录入人',
  `time` datetime NOT NULL COMMENT '录入日期',
  `tions` varchar(255) NOT NULL COMMENT '选项',
  `daan` varchar(10) NOT NULL COMMENT '答案',
  `jiexi` text NOT NULL COMMENT '解析',
  `type` varchar(100) DEFAULT NULL COMMENT '题型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_tk
-- ----------------------------
INSERT INTO `study_tk` VALUES ('48', '111', '崔俊11', '2016-05-28 05:00:51', '1,2,3', 'A', '44444', '');
INSERT INTO `study_tk` VALUES ('47', '钱浩浩', '崔俊11', '2016-05-28 05:00:18', '不回头,破碎两旁,仿', 'A', '最后一次上次地久天长', '1');
INSERT INTO `study_tk` VALUES ('49', '把梦追到', '崔俊11', '2016-05-28 05:03:13', '生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生生,管管管管管管管管管管管管管管管管管管管管管管管管,山山山山山山山山山山山山山山山山山山山山山山山山山山山山山山山山山山山', 'B', '全都一笔勾销', '');
INSERT INTO `study_tk` VALUES ('50', '千好好', '崔俊11', '2016-05-28 05:16:12', '{\"A\":\"1111111111111\",\"B\":\"222222222\",\"C\":\"3333333333333\"}', 'A', '安徽的卡号的健康好的', '1');
INSERT INTO `study_tk` VALUES ('51', '王子的新衣', '崔俊11', '2016-05-28 05:17:37', '{\"A\":\"\\u7231\\u60c5\",\"B\":\"\\u75af\\u5b50\",\"C\":\"\\u5feb\\u4e50\"}', 'A', '我现在完全不知道该怎么做', '');
INSERT INTO `study_tk` VALUES ('52', '案例和大连市', '崔俊11', '2016-05-28 05:43:08', '{\"A\":\"1111\",\"B\":\"22222222\",\"C\":\"22333333\"}', 'A', '4555555555555', '');

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `str` varchar(1000) NOT NULL DEFAULT 'null',
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES ('a:1:{s:6:&quot;format&quot;;a:2:{s:8:&quot;username&quot;;s:5:&quot;admin&quot;;s:7:&quot;pasword&quot;;s:28:&quot;ZmptaC4qJH5jaGguYWRtaW44ODg=&quot;;}}', '1');
INSERT INTO `test` VALUES ('null', '0');

-- ----------------------------
-- Table structure for travel
-- ----------------------------
DROP TABLE IF EXISTS `travel`;
CREATE TABLE `travel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL COMMENT '部门',
  `time` datetime NOT NULL COMMENT '申请时间',
  `s_time` date NOT NULL COMMENT '开始时间',
  `e_time` date NOT NULL COMMENT '结束时间',
  `dd` varchar(100) NOT NULL COMMENT '地点',
  `sy` varchar(600) NOT NULL COMMENT '事由',
  `ccf_zs` char(100) DEFAULT NULL COMMENT '车船费（张数）',
  `ccf_je` char(100) DEFAULT NULL COMMENT '车船费（金额）',
  `zsf_zs` char(100) DEFAULT NULL COMMENT '住宿费（张数）',
  `zsf_je` char(100) DEFAULT NULL COMMENT '住宿费（金额）',
  `hsbt_zs` char(100) DEFAULT NULL COMMENT '伙食补贴（张数）',
  `hsbt_je` char(100) DEFAULT NULL COMMENT '伙食补贴（金额）',
  `gzf` char(100) DEFAULT NULL COMMENT '公杂费',
  `gj` char(100) NOT NULL COMMENT '合计',
  `bxr` int(11) NOT NULL COMMENT '报销人',
  `bxr_text` varchar(100) NOT NULL COMMENT '报销人',
  `bxr_del` tinyint(1) DEFAULT '1' COMMENT '报销人是否删除 1:否 0:是',
  `zmr` int(11) NOT NULL COMMENT '证明人',
  `zmr_text` varchar(100) NOT NULL COMMENT '证明人',
  `zmr_time` datetime DEFAULT NULL COMMENT '证明人审核时间',
  `zmr_rs` tinyint(1) DEFAULT '0' COMMENT '证明人审核结果   0:审批中 1:同意 2:驳回',
  `zmr_detail` varchar(500) DEFAULT NULL COMMENT '证明人驳回详细信息',
  `zmr_del` tinyint(1) DEFAULT '1' COMMENT '证明人是否删除 1:否 0:是',
  `glkj` int(11) NOT NULL COMMENT '管理会计',
  `glkj_text` varchar(100) NOT NULL COMMENT '管理会计',
  `glkj_time` datetime DEFAULT NULL COMMENT '管理会计审核时间',
  `glkj_rs` tinyint(1) DEFAULT '0' COMMENT '管理会计审核结果  0:审批中 1:同意 2:驳回',
  `glkj_detail` varchar(500) DEFAULT NULL COMMENT '管理会计驳回详细信息',
  `glkj_del` tinyint(1) DEFAULT '1' COMMENT '管理会计是否删除 1:否 0:是',
  `ldsp` int(11) NOT NULL COMMENT '领导审批',
  `ldsp_text` varchar(100) NOT NULL COMMENT '领导审批',
  `ldsp_time` datetime DEFAULT NULL COMMENT '领导审批审核时间',
  `ldsp_rs` tinyint(1) DEFAULT '0' COMMENT '领导审批结果   0:审批中 1:同意 2:驳回',
  `ldsp_detail` varchar(500) DEFAULT NULL COMMENT '领导会计驳回详细信息',
  `ldsp_del` tinyint(1) DEFAULT '1' COMMENT '领导是否删除 1:否 0:是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='差旅费报销申请表单';

-- ----------------------------
-- Records of travel
-- ----------------------------
INSERT INTO `travel` VALUES ('4', '2', '2016-05-28 17:10:54', '2016-04-30', '2016-05-21', '222', '1221', '50', '1', '50', '1', '50', '1', '50', '200', '8', '审批', '0', '1', '崔俊11', null, '1', null, '0', '1', '崔俊11', null, '1', null, '0', '1', '崔俊11', null, '1', null, '0');

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
  `gonghao` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '工号',
  `number` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '人员编号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '崔俊11', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$24ILXZNwa/y6p6NX/35X6Oube8gnZQ1fZgKnIUmRKw5P/dpBV5bQK', '0', 'admin@qq.com', '10', '1454403070', '1464427440', '1464427440', '127.0.0.1', '5', '22222', '001');
INSERT INTO `user` VALUES ('2', 'cuijun', '崔俊', 'fUwgiWl7rKRZkibw4D4xEQ-zqeWw_0lb', '$2y$13$jPTH51D6mYRodN/1qVwtVORcucE64/2rwzZ5qJn5WT8nVCkyb/WpK', null, '1111@qq.com', '10', '1457681052', '1464315118', '1463964188', '127.0.0.1', '3', '11111', '117');
INSERT INTO `user` VALUES ('8', 'shenpi', '审批', '4BNN9RXTprCVX7V8vModU1jFuDaHb9ag', '$2y$13$pcpTm9QLP9uuxks.wJz69.LR2p5vjqXMxed2hX9aobW1mMmbDgC5u', null, null, '10', '1463727983', '1464415669', '1464415669', '127.0.0.1', '3', '33333', '003');
INSERT INTO `user` VALUES ('9', 'shenpi2', '审批2', 'jbqz7M0aRInIWkUrKu9yXgDYDBDn5yL4', '$2y$13$UC6ofS7MByLMQ.HrwJ0lx.Y4bplwYQXOEJAghG4hbq2ekN6Yk6m8m', null, null, '10', '1464002578', '1464002588', null, '', '1', '44444', '004');
INSERT INTO `user` VALUES ('10', 'shenpi3', '审批3', 'oOys6wPtzLCApRVqMJY0Fhur21i608l7', '$2y$13$zkN466vsbXVj/YK9DEA1M.OAUyN.w38Ng58bIFT4GBjnJkgKNh0gG', null, null, '10', '1464002610', '1464002650', null, '', '1', '55555', '005');
INSERT INTO `user` VALUES ('11', 'shenpi4', '审批4', 'ueYVph4HqWJPAI-75XI0lyy6Im83Z1kE', '$2y$13$FLHh7rGzq9Id5iFjUn01c.fPY3kyOoJstxcQsDkTRnQ61soT2QXXy', null, null, '10', '1464002672', '1464002672', null, '', '1', '66666', '006');
INSERT INTO `user` VALUES ('12', 'shouli', '崔俊', 'EwhzPTK-9m5NPwgYr63p8wfg2Rx7knsk', '$2y$13$qfoPJm7yrVcOIw5XQENd1Oh7I6G7wZ.sUOpcTTTZjE0/5jgo7C5bi', null, null, '10', '1464004917', '1464169584', null, '', '1', '77777', '007');
INSERT INTO `user` VALUES ('13', 'xubaobao', 'xubaobao', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464139950', '1464324120', '1464324120', '127.0.0.1', '1', '88888', '008');
INSERT INTO `user` VALUES ('14', 'baobao1', 'baobao1', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464426074', '1464426074', '127.0.0.1', '1', '99991', '009');
INSERT INTO `user` VALUES ('15', 'baobao2', 'baobao2', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464424567', '1464424567', '127.0.0.1', '1', '99992', '010');
INSERT INTO `user` VALUES ('16', 'baobao3', 'baobao3', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464427408', '1464427408', '127.0.0.1', '1', '99993', '011');

-- ----------------------------
-- Table structure for wages
-- ----------------------------
DROP TABLE IF EXISTS `wages`;
CREATE TABLE `wages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` date NOT NULL COMMENT '日期',
  `dwbh` varchar(100) NOT NULL COMMENT '单位编号',
  `number` varchar(10) NOT NULL COMMENT '人员编号',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `yfgz` varchar(20) NOT NULL COMMENT '应发工资',
  `zwdjgz` varchar(20) NOT NULL COMMENT '职务等级工资',
  `jbgz` varchar(20) NOT NULL COMMENT '级别工资津贴',
  `jcgz` varchar(20) NOT NULL COMMENT '基础工资',
  `gjhljt` varchar(20) NOT NULL COMMENT '工教护龄津贴',
  `jxjt` varchar(20) NOT NULL COMMENT '警衔津贴',
  `gzjt` varchar(20) NOT NULL COMMENT '工作津贴',
  `shbt` varchar(20) NOT NULL COMMENT '生活补贴',
  `gwjt` varchar(20) NOT NULL COMMENT '岗位津贴',
  `zwjt` varchar(20) NOT NULL COMMENT '职务津贴',
  `dqjt` varchar(20) NOT NULL COMMENT '地区津贴',
  `kqj` varchar(20) NOT NULL COMMENT '考勤奖',
  `hyxjt` varchar(20) NOT NULL COMMENT '行业性津贴',
  `tzbt` varchar(20) NOT NULL COMMENT '提租补贴',
  `blgz` varchar(20) NOT NULL COMMENT '保留工资',
  `fdgz` varchar(20) NOT NULL COMMENT '浮动工资',
  `qtyf` varchar(20) NOT NULL COMMENT '其他应发',
  `ycxbk` varchar(20) NOT NULL COMMENT '一次性补扣发',
  `dkje` varchar(20) NOT NULL COMMENT '代扣金额',
  `zfgjj` varchar(20) NOT NULL COMMENT '住房公积金',
  `ylaobxj` varchar(20) NOT NULL COMMENT '养老保险金',
  `sybxj` varchar(20) NOT NULL COMMENT '失业保险金',
  `ylbxj` varchar(20) NOT NULL COMMENT '医疗保险金',
  `grsds` varchar(20) NOT NULL COMMENT '个人所得税',
  `sdf` varchar(20) NOT NULL COMMENT '水电费',
  `fz` varchar(20) NOT NULL COMMENT '房租费',
  `qtdk` varchar(20) NOT NULL COMMENT '其他代扣',
  `sfgz` varchar(20) NOT NULL COMMENT '实发工资',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COMMENT='工资查询';

-- ----------------------------
-- Records of wages
-- ----------------------------
INSERT INTO `wages` VALUES ('1', '2016-04-01', '闽侯县检察院', '003', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('2', '2016-04-08', '闽侯县检察院', '003', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('3', '2016-04-19', '闽侯县检察院', '003', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('4', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('5', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('6', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('7', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('8', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('9', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('10', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('11', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('12', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('13', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('14', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('15', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('16', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('17', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('18', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('19', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('20', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('21', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('22', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('23', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('24', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('25', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('26', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('27', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('28', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('29', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('30', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('31', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('32', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('33', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('34', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('35', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('36', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('37', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('38', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('39', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('40', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('41', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('42', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('43', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('44', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('45', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('46', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('47', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('48', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('49', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('50', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('51', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('52', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('53', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('54', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('55', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('56', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('57', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('58', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('59', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('60', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('61', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('62', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('63', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('64', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('65', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('66', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('67', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('68', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('69', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('70', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('71', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('72', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('73', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('74', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('75', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('76', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('77', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('78', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('79', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('80', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('81', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('82', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('83', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('84', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('85', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('86', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('87', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('88', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('89', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('90', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('91', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('92', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('93', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('94', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('95', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('96', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('97', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('98', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('99', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('100', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('101', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('102', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('103', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('104', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('105', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('106', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('107', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('108', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('109', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('110', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('111', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('112', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('113', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('114', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('115', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('116', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('117', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('118', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('119', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('120', '2016-04-01', '闽侯县检察院', '5', '张功华', '7869', '1010', '2053', '0', '0', '233', '1658', '2300', '0', '0', '0', '0', '240', '375', '0', '0', '0', '0', '2498.39', '1429', '870', '0', '149.88', '49.51', '0', '0', '0', '5370.61');
INSERT INTO `wages` VALUES ('121', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('122', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('123', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('124', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('125', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('126', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('127', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('128', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('129', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('130', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('131', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');
INSERT INTO `wages` VALUES ('132', '2016-04-01', '闽侯县检察院', '9', '李淑凤', '6397', '690', '1833', '0', '0', '200', '1402', '1727', '0', '0', '0', '0', '240', '305', '0', '0', '0', '0', '1955.52', '1104', '710', '0', '121.84', '19.68', '0', '0', '0', '4441.48');

-- ----------------------------
-- Table structure for welfare
-- ----------------------------
DROP TABLE IF EXISTS `welfare`;
CREATE TABLE `welfare` (
  `welfare_id` int(11) NOT NULL,
  `welfare_name` varchar(20) NOT NULL COMMENT '福利名称',
  `welfare_type` varchar(20) NOT NULL COMMENT '福利类型',
  `welfare_start_time` datetime NOT NULL COMMENT '开始时间',
  `welfare_end_time` datetime NOT NULL COMMENT '结束时间',
  `welfare_part_id` varchar(100) NOT NULL COMMENT '适用机构ID，每个ID用英文“，”隔开,例如：1,2,34 ',
  `welfare_part_name` varchar(20) NOT NULL COMMENT '适用机构名称,冗余字段,用英文“，”隔开,例如：机构1,机构二',
  `welfare_detail` text NOT NULL COMMENT '福利详细',
  `welfare_status` tinyint(4) DEFAULT NULL COMMENT '默认为0，审核通过为1',
  PRIMARY KEY (`welfare_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of welfare
-- ----------------------------

-- ----------------------------
-- Table structure for welfare_apply
-- ----------------------------
DROP TABLE IF EXISTS `welfare_apply`;
CREATE TABLE `welfare_apply` (
  `welfare_apply_id` int(11) NOT NULL,
  `welfare_apply_approve_id` int(11) NOT NULL COMMENT '审批人ID',
  `welfare_apply_approve_result` varchar(200) NOT NULL COMMENT '审批人意见,同意写入原因',
  `welfare_apply_mee_id` int(11) NOT NULL COMMENT '申请人账号ID',
  `welfare_apply_pack_status` tinyint(4) NOT NULL COMMENT '审批人状态，是否同意，默认为0，同意为1',
  `welfare_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`welfare_apply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of welfare_apply
-- ----------------------------

-- ----------------------------
-- Table structure for xxjxgl
-- ----------------------------
DROP TABLE IF EXISTS `xxjxgl`;
CREATE TABLE `xxjxgl` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `title_content` text NOT NULL COMMENT '相关法律法规',
  `name` varchar(50) NOT NULL COMMENT '发布人',
  `xx_date` datetime NOT NULL COMMENT '发布日期',
  `content` text COMMENT '正文',
  `fujian` varchar(255) DEFAULT NULL COMMENT '附件上传',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxjxgl
-- ----------------------------
INSERT INTO `xxjxgl` VALUES ('22', '钱浩浩', '遵守法律法规', '崔俊11', '2016-05-11 06:43:16', '海贼王', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/1464259396_198.doc');
INSERT INTO `xxjxgl` VALUES ('23', '1111', '1111', '崔俊11', '2016-05-26 07:06:17', '111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/1464260777_600.doc');
INSERT INTO `xxjxgl` VALUES ('24', '1111', '11111111111111', '崔俊11', '2016-05-26 07:26:33', '11111111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/2016.5.25Ǯ?ƺƹ?1???ձ?.doc');
INSERT INTO `xxjxgl` VALUES ('25', '11111', '11111111111', '崔俊11', '2016-05-26 07:27:40', '111111111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/2016.5.25Ǯ?ƺƹ?1???ձ?.doc');
INSERT INTO `xxjxgl` VALUES ('27', '11', '1111111', '崔俊11', '2016-05-26 07:51:16', '11111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/2016.5.26Ǯ?ƺƹ?1???ձ?.doc');
