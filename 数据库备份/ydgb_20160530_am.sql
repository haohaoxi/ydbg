/*
Navicat MySQL Data Transfer

Source Server         : 移动办公内网数据库
Source Server Version : 50505
Source Host           : 192.168.3.242:3306
Source Database       : ydgb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-05-30 08:06:37
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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of announcement
-- ----------------------------
INSERT INTO `announcement` VALUES ('1', 'aaaa', '2016-05-29 11:12:43', '崔俊11', 'www.baidu.com', '11111111111');
INSERT INTO `announcement` VALUES ('50', '1 ', '2016-05-29 11:13:15', '崔俊11', '1464491595_641.doc', '');
INSERT INTO `announcement` VALUES ('51', '111111111111', '2016-05-29 01:37:34', '崔俊11', '1464500254_707.doc', '');
INSERT INTO `announcement` VALUES ('52', 'QQQ', '2016-05-29 01:37:45', '崔俊11', '1464500265_314.doc', '');
INSERT INTO `announcement` VALUES ('57', '4787', '2016-05-29 02:06:32', '崔俊11', '1464501992_815.doc', '');
INSERT INTO `announcement` VALUES ('64', '4477857', '2016-05-29 02:14:38', '崔俊11', '1464502573_13.doc', '<p>768</p>');

-- ----------------------------
-- Table structure for carwx
-- ----------------------------
DROP TABLE IF EXISTS `carwx`;
CREATE TABLE `carwx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL COMMENT '部门',
  `time` datetime DEFAULT NULL COMMENT '报销申请时间',
  `wx_time` date NOT NULL COMMENT '维修申请时间',
  `cph` varchar(100) NOT NULL COMMENT '车牌号',
  `wxnr` text NOT NULL COMMENT '维修内容及配件项目',
  `jine` decimal(9,2) NOT NULL COMMENT '金额/元',
  `remark` text COMMENT '备注',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='机动车维修申请表单';

-- ----------------------------
-- Records of carwx
-- ----------------------------
INSERT INTO `carwx` VALUES ('1', '1', '2016-05-29 10:20:22', '2016-05-29', '苏At729A', '二保', '500.00', '二保二保二保二保', '13', 'xubaobao', '0', '1', '崔俊11', '2016-05-29 10:34:21', '1', null, '1', '8', '审批', '2016-05-29 10:35:05', '2', '888', '1', '8', '审批', null, '0', null, '1');

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
INSERT INTO `chuchai` VALUES ('4', '1', '1,2,3', '3', '1', '2016-05-28 15:48:16', '2016-05-31', '2016-06-03', '出差地点', '出差任务', '交通工具', '1', '2', '2016-05-28 17:54:51', '院领导返驳原因', '2', '0', null, null, '0', '0', null, null, '0', '1', '0', '0');
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
  `principal_text` varchar(80) DEFAULT NULL,
  `branch_leader_text` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='机构通讯录';

-- ----------------------------
-- Records of dept_contact
-- ----------------------------
INSERT INTO `dept_contact` VALUES ('1', '科室一', '机构（一）', '14', '15', 'baobao1', 'baobao2');
INSERT INTO `dept_contact` VALUES ('2', '科室二', '科室二', '2', '8', '崔俊', '审批');
INSERT INTO `dept_contact` VALUES ('4', '科室四', '科室四', '16', '9', 'baobao3', '审批2');
INSERT INTO `dept_contact` VALUES ('5', '科室五', '科室二', '13', '1', 'xubaobao', '崔俊11');
INSERT INTO `dept_contact` VALUES ('6', '科室六', '机构一', '12', '9', '崔俊', '审批2');
INSERT INTO `dept_contact` VALUES ('7', '科室七', '科室二', '15', '2', 'baobao2', '崔俊');
INSERT INTO `dept_contact` VALUES ('3', '科室三', '科室三', '2', '1', '崔俊', '崔俊11');
INSERT INTO `dept_contact` VALUES ('24', '王', '教研室（一）', '10', '11', '审批3', '审批4');

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
-- Table structure for kaoqin_day
-- ----------------------------
DROP TABLE IF EXISTS `kaoqin_day`;
CREATE TABLE `kaoqin_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(50) NOT NULL COMMENT '部门',
  `worker_no` varchar(10) NOT NULL COMMENT '工号',
  `username` varchar(50) NOT NULL COMMENT '姓名',
  `kq_time` date NOT NULL COMMENT '考勤时间',
  `weekday` varchar(10) NOT NULL COMMENT '星期',
  `shangban_type` varchar(20) NOT NULL COMMENT '所上班制',
  `shuaka_time1` varchar(20) NOT NULL COMMENT '刷卡时1',
  `shuaka_time2` varchar(20) NOT NULL,
  `yingkq_minutes` varchar(20) NOT NULL COMMENT '应出勤分钟',
  `yingkq_hours` varchar(20) NOT NULL,
  `yingkq_days` varchar(20) NOT NULL,
  `shicq_hours` varchar(20) NOT NULL,
  `shicq_days` varchar(20) NOT NULL,
  `kg_minutes` varchar(20) NOT NULL COMMENT '旷工分钟',
  `qj_minutes` varchar(20) NOT NULL COMMENT '请假分钟',
  `qj_hours` varchar(20) NOT NULL COMMENT '请假小时',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='考勤日表';

-- ----------------------------
-- Records of kaoqin_day
-- ----------------------------
INSERT INTO `kaoqin_day` VALUES ('5', '办公室', '111186', '孙国', '2016-03-03', '一', '正常班', '7:50', '14:50', '32.6', '14', '11.5', '394', '11.5', '4', '0', '0');
INSERT INTO `kaoqin_day` VALUES ('6', '办公室', '111186', '孙国', '2016-03-03', '一', '正常班', '7:50', '14:50', '32.6', '14', '11.5', '394', '11.5', '4', '0', '0');
INSERT INTO `kaoqin_day` VALUES ('7', '办公室', '111187', '孙国', '2016-03-04', '二', '正常班', '7:51', '14:51', '33.6', '15', '12.5', '395', '12.5', '5', '1', '1');
INSERT INTO `kaoqin_day` VALUES ('8', '办公室', '111188', '孙国', '2016-03-05', '三', '正常班', '7:52', '14:52', '34.6', '16', '13.5', '396', '13.5', '6', '2', '2');
INSERT INTO `kaoqin_day` VALUES ('9', '办公室', '111189', '王五', '2016-03-06', '四', '正常班', '7:53', '14:53', '35.6', '17', '14.5', '397', '14.5', '7', '3', '3');
INSERT INTO `kaoqin_day` VALUES ('10', '办公室', '111190', '孙国', '2016-03-07', '五', '正常班', '7:54', '14:54', '36.6', '18', '15.5', '398', '15.5', '8', '4', '4');
INSERT INTO `kaoqin_day` VALUES ('11', '办公室', '111191', '孙国', '2016-03-08', '六', '正常班', '7:55', '14:55', '37.6', '19', '16.5', '399', '16.5', '9', '5', '5');
INSERT INTO `kaoqin_day` VALUES ('12', '办公室', '111192', '孙国', '2016-03-09', '日', '正常班', '7:56', '14:56', '38.6', '20', '17.5', '400', '17.5', '10', '6', '6');
INSERT INTO `kaoqin_day` VALUES ('13', '办公室', '111193', '孙国', '2016-03-10', '一', '正常班', '7:57', '14:57', '39.6', '21', '18.5', '401', '18.5', '11', '7', '7');
INSERT INTO `kaoqin_day` VALUES ('14', '办公室', '111194', '李四', '2016-03-11', '二', '正常班', '7:58', '14:58', '40.6', '22', '19.5', '402', '19.5', '12', '8', '8');
INSERT INTO `kaoqin_day` VALUES ('15', '办公室', '111195', '孙国', '2016-03-12', '三', '正常班', '7:59', '14:59', '41.6', '23', '20.5', '403', '20.5', '13', '9', '9');
INSERT INTO `kaoqin_day` VALUES ('16', '办公室', '111196', '孙国', '2016-03-13', '四', '正常班', '7:60', '14:60', '42.6', '24', '21.5', '404', '21.5', '14', '10', '10');
INSERT INTO `kaoqin_day` VALUES ('17', '办公室', '111197', '孙国', '2016-03-14', '五', '正常班', '7:61', '14:61', '43.6', '25', '22.5', '405', '22.5', '15', '11', '11');
INSERT INTO `kaoqin_day` VALUES ('18', '办公室', '111198', '张三', '2016-03-15', '六', '正常班', '7:62', '14:62', '44.6', '26', '23.5', '406', '23.5', '16', '12', '12');
INSERT INTO `kaoqin_day` VALUES ('19', '办公室', '111199', '孙国', '2016-03-16', '日', '正常班', '7:63', '14:63', '45.6', '27', '24.5', '407', '24.5', '17', '13', '13');
INSERT INTO `kaoqin_day` VALUES ('20', '办公室', '111200', '孙国', '2016-03-17', '一', '正常班', '7:64', '14:64', '46.6', '28', '25.5', '408', '25.5', '18', '14', '14');
INSERT INTO `kaoqin_day` VALUES ('21', '办公室', '111201', '孙国', '2016-03-18', '二', '正常班', '7:65', '14:65', '47.6', '29', '26.5', '409', '26.5', '19', '15', '15');
INSERT INTO `kaoqin_day` VALUES ('22', '办公室', '111202', '孙国', '2016-03-19', '三', '正常班', '7:66', '14:66', '48.6', '30', '27.5', '410', '27.5', '20', '16', '16');
INSERT INTO `kaoqin_day` VALUES ('23', '办公室', '111203', '孙国', '2016-03-20', '四', '正常班', '7:67', '14:67', '49.6', '31', '28.5', '411', '28.5', '21', '17', '17');
INSERT INTO `kaoqin_day` VALUES ('24', '办公室', '111204', '孙国', '2016-03-21', '五', '正常班', '7:68', '14:68', '50.6', '32', '29.5', '412', '29.5', '22', '18', '18');
INSERT INTO `kaoqin_day` VALUES ('25', '办公室', '111205', '孙国', '2016-03-22', '六', '正常班', '7:69', '14:69', '51.6', '33', '30.5', '413', '30.5', '23', '19', '19');
INSERT INTO `kaoqin_day` VALUES ('26', '办公室', '111206', '孙国', '2016-03-23', '日', '正常班', '7:70', '14:70', '52.6', '34', '31.5', '414', '31.5', '24', '20', '20');
INSERT INTO `kaoqin_day` VALUES ('27', '办公室', '111207', '孙国', '2016-03-24', '一', '正常班', '7:71', '14:71', '53.6', '35', '32.5', '415', '32.5', '25', '21', '21');
INSERT INTO `kaoqin_day` VALUES ('28', '办公室', '111208', '孙国', '2016-03-25', '二', '正常班', '7:72', '14:72', '54.6', '36', '33.5', '416', '33.5', '26', '22', '22');
INSERT INTO `kaoqin_day` VALUES ('29', '办公室', '111209', '孙国', '2016-03-26', '三', '正常班', '7:73', '14:73', '55.6', '37', '34.5', '417', '34.5', '27', '23', '23');
INSERT INTO `kaoqin_day` VALUES ('30', '办公室', '111210', '孙国', '2016-03-27', '四', '正常班', '7:74', '14:74', '56.6', '38', '35.5', '418', '35.5', '28', '24', '24');
INSERT INTO `kaoqin_day` VALUES ('31', '办公室', '111211', '孙国', '2016-03-28', '五', '正常班', '7:75', '14:75', '57.6', '39', '36.5', '419', '36.5', '29', '25', '25');
INSERT INTO `kaoqin_day` VALUES ('32', '办公室', '111212', '孙国', '2016-03-29', '六', '正常班', '7:76', '14:76', '58.6', '40', '37.5', '420', '37.5', '30', '26', '26');

-- ----------------------------
-- Table structure for kaoqin_month
-- ----------------------------
DROP TABLE IF EXISTS `kaoqin_month`;
CREATE TABLE `kaoqin_month` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(50) NOT NULL COMMENT '部门名称',
  `worker_no` varchar(10) NOT NULL COMMENT '工号',
  `card_no` varchar(10) NOT NULL COMMENT '卡号',
  `username` varchar(50) NOT NULL COMMENT '姓名',
  `kq_time` date NOT NULL COMMENT '考勤时间',
  `ycq_hours` varchar(20) NOT NULL DEFAULT '0' COMMENT '应出勤小时',
  `ycq_days` varchar(20) NOT NULL DEFAULT '0',
  `scq_hours` varchar(20) NOT NULL DEFAULT '0' COMMENT '实出勤小时',
  `scq_days` varchar(20) NOT NULL DEFAULT '0',
  `kg_hours` varchar(20) NOT NULL DEFAULT '0' COMMENT '旷工小时',
  `kg_days` varchar(20) NOT NULL DEFAULT '0',
  `total_workhours` varchar(20) NOT NULL DEFAULT '0' COMMENT '总计工时小时',
  `total_workdays` varchar(20) NOT NULL DEFAULT '0',
  `delay_times` int(11) NOT NULL DEFAULT '0' COMMENT '迟到次数',
  `zt_times` int(11) NOT NULL DEFAULT '0' COMMENT '早退次数',
  `delay_minutes` varchar(20) NOT NULL DEFAULT '0',
  `zt_minutes` varchar(20) NOT NULL DEFAULT '0',
  `shij_days` varchar(20) NOT NULL DEFAULT '0' COMMENT '事假天数',
  `sick_days` varchar(20) NOT NULL DEFAULT '0' COMMENT '病假天数',
  `tiaoxiu_days` varchar(20) NOT NULL DEFAULT '0' COMMENT '调休天数',
  `gc_days` varchar(20) NOT NULL DEFAULT '0' COMMENT '公出天数',
  `yxnj_days` varchar(20) NOT NULL DEFAULT '0' COMMENT '已休年假天数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='考勤月表';

-- ----------------------------
-- Records of kaoqin_month
-- ----------------------------
INSERT INTO `kaoqin_month` VALUES ('1', '办公室', '111186', '111186', '孙国', '2016-01-05', '', '', '394', '11.5', '4', '', '', '0', '0', '0', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('2', '办公室', '111187', '111187', '孙国', '2016-01-06', '', '', '395', '12.5', '5', '', '', '1', '1', '1', '1', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('3', '办公室', '111188', '111188', '孙国', '2016-01-07', '', '', '396', '13.5', '6', '', '', '2', '2', '2', '2', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('4', '办公室', '111189', '111189', '孙国', '2016-01-08', '', '', '397', '14.5', '7', '', '', '3', '3', '3', '3', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('5', '办公室', '111190', '111190', '孙国', '2016-01-09', '', '', '398', '15.5', '8', '', '', '4', '4', '4', '4', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('6', '办公室', '111191', '111191', '孙国', '2016-01-10', '', '', '399', '16.5', '9', '', '', '5', '5', '5', '5', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('7', '办公室', '111192', '111192', '孙国', '2016-01-11', '', '', '400', '17.5', '10', '', '', '6', '6', '6', '6', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('8', '办公室', '111193', '111193', '孙国', '2016-01-12', '', '', '401', '18.5', '11', '', '', '7', '7', '7', '7', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('9', '办公室', '111194', '111194', '孙国', '2016-01-13', '', '', '402', '19.5', '12', '', '', '8', '8', '8', '8', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('10', '办公室', '111195', '111195', '孙国', '2016-01-14', '', '', '403', '20.5', '13', '', '', '9', '9', '9', '9', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('11', '办公室', '111196', '111196', '孙国', '2016-01-15', '', '', '404', '21.5', '14', '', '', '10', '10', '10', '10', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('12', '办公室', '111197', '111197', '孙国', '2016-01-16', '', '', '405', '22.5', '15', '', '', '11', '11', '11', '11', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('13', '办公室', '111198', '111198', '李四', '2016-01-17', '', '', '406', '23.5', '16', '', '', '12', '12', '12', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('14', '办公室', '111199', '111199', '孙国', '2016-01-18', '', '', '407', '24.5', '17', '', '', '13', '13', '13', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('15', '办公室', '111200', '111200', '孙国', '2016-01-19', '', '', '408', '25.5', '18', '', '', '14', '14', '14', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('16', '办公室', '111201', '111201', '孙国', '2016-01-20', '', '', '409', '26.5', '19', '', '', '15', '15', '15', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('17', '办公室', '111202', '111202', '孙国', '2016-01-21', '', '', '410', '27.5', '20', '', '', '16', '16', '16', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('18', '办公室', '111203', '111203', '孙国', '2016-01-22', '', '', '411', '28.5', '21', '', '', '17', '17', '17', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('19', '办公室', '111204', '111204', '张三', '2016-01-23', '', '', '412', '29.5', '22', '', '', '18', '18', '18', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('20', '办公室', '111205', '111205', '孙国', '2016-01-24', '', '', '413', '30.5', '23', '', '', '19', '19', '19', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('21', '办公室', '111206', '111206', '孙国', '2016-01-25', '', '', '414', '31.5', '24', '', '', '20', '20', '20', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('22', '办公室', '111207', '111207', '孙国', '2016-01-26', '', '', '415', '32.5', '25', '', '', '21', '21', '21', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('23', '办公室', '111208', '111208', '孙国', '2016-01-27', '', '', '416', '33.5', '26', '', '', '22', '22', '22', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('24', '办公室', '111209', '111209', '孙国', '2016-01-28', '', '', '417', '34.5', '27', '', '', '23', '23', '23', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('25', '办公室', '111210', '111210', '孙国', '2016-01-29', '', '', '418', '35.5', '28', '', '', '24', '24', '24', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('26', '办公室', '111211', '111211', '孙国', '2016-01-30', '', '', '419', '36.5', '29', '', '', '25', '25', '25', '0', '', '', '', '', '', '');
INSERT INTO `kaoqin_month` VALUES ('27', '办公室', '111212', '111212', '孙国', '2016-01-31', '', '', '420', '37.5', '30', '', '', '26', '26', '26', '0', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for meet
-- ----------------------------
DROP TABLE IF EXISTS `meet`;
CREATE TABLE `meet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT '会议名称',
  `department` int(11) DEFAULT NULL COMMENT '部门',
  `time` datetime DEFAULT NULL COMMENT '报销申请时间',
  `kh_time` date NOT NULL COMMENT '开会时间',
  `wddbs` int(10) DEFAULT NULL COMMENT '外地代表数/人',
  `bddbs` int(10) DEFAULT NULL COMMENT '本地代表数/人',
  `gzrys` int(10) DEFAULT NULL COMMENT '工作人员数/人',
  `chrys` int(10) NOT NULL COMMENT '参会人员数/人',
  `hq` int(10) NOT NULL COMMENT '会期（含报到和离开时间）/天',
  `hyzf` decimal(9,2) NOT NULL COMMENT '会议资费',
  `zsf` decimal(9,2) DEFAULT NULL COMMENT '住宿费',
  `hsf` decimal(9,2) DEFAULT NULL COMMENT '伙食费',
  `hyszj` decimal(9,2) DEFAULT NULL COMMENT '会议室租金',
  `jtf` decimal(9,2) DEFAULT NULL COMMENT '交通费',
  `wjysf` decimal(9,2) DEFAULT NULL COMMENT '文件印刷费',
  `qtzc` decimal(9,2) DEFAULT NULL COMMENT '其他支出',
  `sjkz` decimal(9,2) NOT NULL COMMENT '实际开支',
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会议报销申请表单';

-- ----------------------------
-- Records of meet
-- ----------------------------
INSERT INTO `meet` VALUES ('1', '', '1', '2016-05-29 10:20:22', '2016-05-29', '0', '0', '500', '0', '0', '0.00', null, null, null, null, null, null, '0.00', '13', 'xubaobao', '0', '1', '崔俊11', '2016-05-29 10:34:21', '1', null, '0', '8', '审批', '2016-05-29 10:35:05', '2', '888', '1', '8', '审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('2', '人民代表大会', null, '2016-05-29 14:17:02', '2016-05-28', '50', '10', '50', '10', '10', '10.00', '10.00', '1.00', '1.00', '10.00', '1.00', '1.00', '5000.00', '13', 'xubaobao', '1', '1', '崔俊11', '2016-05-29 14:31:20', '1', null, '1', '8', '审批', null, '0', null, '1', '14', 'baobao1', null, '0', null, '1');
INSERT INTO `meet` VALUES ('3', '测试会议', null, '2016-05-29 14:56:52', '2016-05-29', '110', '20', '20', '150', '111', '100.00', '1000.00', '1000.00', '1000.00', '1000.00', '1000.00', '1000.00', '6000.00', '13', 'xubaobao', '1', '14', 'baobao1', null, '0', null, '1', '16', 'baobao3', null, '0', null, '1', '15', 'baobao2', null, '0', null, '1');

-- ----------------------------
-- Table structure for meet_join
-- ----------------------------
DROP TABLE IF EXISTS `meet_join`;
CREATE TABLE `meet_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meetid` int(11) NOT NULL COMMENT '会议id',
  `join_ren` int(11) NOT NULL COMMENT '参与人员',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '人员类型（0普通人员，1主持）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0，未读，1已读）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='会议参与人表';

-- ----------------------------
-- Records of meet_join
-- ----------------------------
INSERT INTO `meet_join` VALUES ('1', '1', '12', '1', '0');
INSERT INTO `meet_join` VALUES ('2', '1', '16', '0', '0');
INSERT INTO `meet_join` VALUES ('3', '1', '15', '0', '0');
INSERT INTO `meet_join` VALUES ('4', '1', '14', '0', '0');
INSERT INTO `meet_join` VALUES ('5', '2', '16', '1', '0');
INSERT INTO `meet_join` VALUES ('6', '2', '10', '0', '0');
INSERT INTO `meet_join` VALUES ('7', '2', '9', '0', '0');

-- ----------------------------
-- Table structure for meeting
-- ----------------------------
DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL COMMENT '会议主题',
  `start_time` datetime NOT NULL COMMENT '开始时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `place` varchar(50) NOT NULL COMMENT '地点',
  `agenda` text,
  `arrangement` text,
  `attachment` text,
  `initiator` int(11) NOT NULL COMMENT '发起人',
  `initiate_time` datetime NOT NULL COMMENT '发起时间',
  `initiate_dept` int(11) NOT NULL COMMENT '发起人科室',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会议管理表';

-- ----------------------------
-- Records of meeting
-- ----------------------------
INSERT INTO `meeting` VALUES ('1', '会议1', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '会议室1', '会议开始啊', '开始会呀', '', '1', '2016-05-29 16:27:10', '5');
INSERT INTO `meeting` VALUES ('2', '会议2', '2016-05-26 00:00:00', '2016-05-31 00:00:00', '会议室2', '会议2', '回忆2', '', '1', '2016-05-29 16:38:03', '5');

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
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 COMMENT='菜单表';

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
INSERT INTO `menu` VALUES ('84', '申请记录', '0', '', 'carwx', 'carwx', 'index', '', '83', '1', '1');
INSERT INTO `menu` VALUES ('85', '审批记录', '0', '', 'carwx', 'carwx', 'record', '', '83', '1', '1');
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
INSERT INTO `menu` VALUES ('132', '考勤查询', '0', '', 'kaoqinquery', 'kaoqinday', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('133', '日报', '0', '', 'kaoqinquery', 'kaoqinday', 'index', '', '132', '1', '1');
INSERT INTO `menu` VALUES ('134', '月报', '0', '', 'kaoqinquery', 'kaoqinmonth', 'index', '', '132', '1', '1');
INSERT INTO `menu` VALUES ('135', '导入日报', '0', '', 'kaoqinquery', 'kaoqinday', 'create', '', '132', '0', '1');
INSERT INTO `menu` VALUES ('136', '导入月报', '0', '', 'kaoqinquery', 'kaoqinmonth', 'create', '', '132', '0', '1');
INSERT INTO `menu` VALUES ('137', '报销申请', '0', '', 'carwx', 'carwx', 'create', '', '84', '0', '1');
INSERT INTO `menu` VALUES ('138', '查看', '0', '', 'carwx', 'carwx', 'view', '', '84', '0', '1');
INSERT INTO `menu` VALUES ('139', '删除', '0', '', 'carwx', 'carwx', 'delete', '', '84', '0', '1');
INSERT INTO `menu` VALUES ('140', '审批查看', '0', '', 'carwx', 'carwx', 'shenpi', '', '85', '0', '1');
INSERT INTO `menu` VALUES ('141', '审批同意', '0', '', 'carwx', 'carwx', 'spty', '', '85', '0', '1');
INSERT INTO `menu` VALUES ('142', '审批驳回', '0', '', 'carwx', 'carwx', 'spbh', '', '85', '0', '1');
INSERT INTO `menu` VALUES ('143', '审批删除', '0', '', 'carwx', 'carwx', 'spdelete', '', '85', '0', '1');
INSERT INTO `menu` VALUES ('144', '采购办公用品申请', '0', '', 'office', 'office-apply', 'buy-office', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('145', '报销申请', '0', '', 'meet', 'meet', 'create', '', '87', '0', '1');
INSERT INTO `menu` VALUES ('146', '查看', '0', '', 'meet', 'meet', 'view', '', '87', '0', '1');
INSERT INTO `menu` VALUES ('147', '删除', '0', '', 'meet', 'meet', 'delete', '', '87', '0', '1');
INSERT INTO `menu` VALUES ('148', '审批查看', '0', '', 'meet', 'meet', 'shenpi', '', '88', '0', '1');
INSERT INTO `menu` VALUES ('149', '审批同意', '0', '', 'meet', 'meet', 'spty', '', '88', '0', '1');
INSERT INTO `menu` VALUES ('150', '审批驳回', '0', '', 'meet', 'meet', 'spbh', '', '88', '0', '1');
INSERT INTO `menu` VALUES ('151', '审批删除', '0', '', 'meet', 'meet', 'spdelete', '', '88', '0', '1');
INSERT INTO `menu` VALUES ('152', '创建试卷', '0', '', 'studysj', 'studysj', 'create', '', '123', '0', '1');
INSERT INTO `menu` VALUES ('153', '查看', '0', '', 'studysj', 'studysj', 'view', '', '123', '0', '1');
INSERT INTO `menu` VALUES ('154', '删除', '0', '', 'studysj', 'studysj', 'delete', '', '123', '0', '1');
INSERT INTO `menu` VALUES ('155', '查看申请列表', '0', '', 'office', 'office-apply', 'index', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('156', '会议管理', '0', '', 'meeting', 'meeting', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('157', '我的会议', '0', '', 'meeting', 'meeting', 'index', '', '156', '1', '1');
INSERT INTO `menu` VALUES ('158', '参与会议', '0', '', 'meeting', 'meetingjoin', 'index', '', '156', '1', '1');
INSERT INTO `menu` VALUES ('159', '发起会议', '0', '', 'meeting', 'meeting', 'create', '', '156', '0', '1');
INSERT INTO `menu` VALUES ('160', '查看', '0', '', 'meeting', 'meeting', 'view', '', '156', '0', '1');
INSERT INTO `menu` VALUES ('161', '删除', '0', '', 'meeting', 'meeting', 'delete', '', '156', '0', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '阿萨德', '2016-05-29 03:00:53', '崔俊11', '1464505253_788.doc', '<p>爱上的</p>');

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
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='人员通讯录';

-- ----------------------------
-- Records of people_contact
-- ----------------------------
INSERT INTO `people_contact` VALUES ('1', 'aaa', '1', '社长', '12345678901', '12345678', '12345678', '1234');
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
INSERT INTO `people_contact` VALUES ('45', '三', '3', '科长', '13057018442', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('46', '四', '2', '科长', '13057018442', '12345678', null, null);
INSERT INTO `people_contact` VALUES ('47', '五', '2', '科长', '13057018442', null, null, '1234');
INSERT INTO `people_contact` VALUES ('48', '六', '6', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('49', '七', '1', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('50', '八', '1', '科长', '13057018442', '12345678', '45678923', '1234');
INSERT INTO `people_contact` VALUES ('51', '三', '3', '科长', '13057018442', '12345678', '12345678', '1234');
INSERT INTO `people_contact` VALUES ('52', '四', '2', '科长', '13057018442', '12345678', null, null);
INSERT INTO `people_contact` VALUES ('53', '五', '2', '科长', '13057018442', null, null, '1234');
INSERT INTO `people_contact` VALUES ('54', '六', '6', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('55', '七', '1', '处长', '13057018442', '12345678', '12345678', null);
INSERT INTO `people_contact` VALUES ('56', '八', '1', '科长', '13057018442', '12345678', '45678923', '1234');
INSERT INTO `people_contact` VALUES ('57', 'aaa', '1', '社长', '12345678901', null, null, null);

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1', '1', '超级管理员');
INSERT INTO `role` VALUES ('14', '技术部管理员', '3', '1', '技术部管理员');
INSERT INTO `role` VALUES ('6', '管理员', '4', '1', '超级管理员');
INSERT INTO `role` VALUES ('2', '行装科', '2', '1', '行装科');
INSERT INTO `role` VALUES ('11', '科员一', '5', '1', '科员一');
INSERT INTO `role` VALUES ('12', '科长二', '6', '1', '科长二');
INSERT INTO `role` VALUES ('13', '检察长', '7', '1', '检察长');

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1278 DEFAULT CHARSET=utf8 COMMENT='角色菜单关联表';

-- ----------------------------
-- Records of role_menu
-- ----------------------------
INSERT INTO `role_menu` VALUES ('59', '3', '12');
INSERT INTO `role_menu` VALUES ('60', '3', '23');
INSERT INTO `role_menu` VALUES ('61', '3', '24');
INSERT INTO `role_menu` VALUES ('1225', '6', '94');
INSERT INTO `role_menu` VALUES ('1224', '6', '93');
INSERT INTO `role_menu` VALUES ('1223', '6', '92');
INSERT INTO `role_menu` VALUES ('1222', '6', '91');
INSERT INTO `role_menu` VALUES ('1221', '6', '90');
INSERT INTO `role_menu` VALUES ('1220', '6', '89');
INSERT INTO `role_menu` VALUES ('1219', '6', '88');
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
INSERT INTO `role_menu` VALUES ('998', '2', '78');
INSERT INTO `role_menu` VALUES ('997', '2', '7');
INSERT INTO `role_menu` VALUES ('996', '2', '112');
INSERT INTO `role_menu` VALUES ('995', '2', '111');
INSERT INTO `role_menu` VALUES ('994', '2', '110');
INSERT INTO `role_menu` VALUES ('993', '2', '109');
INSERT INTO `role_menu` VALUES ('992', '2', '113');
INSERT INTO `role_menu` VALUES ('991', '2', '116');
INSERT INTO `role_menu` VALUES ('990', '2', '108');
INSERT INTO `role_menu` VALUES ('989', '2', '75');
INSERT INTO `role_menu` VALUES ('988', '2', '73');
INSERT INTO `role_menu` VALUES ('987', '2', '72');
INSERT INTO `role_menu` VALUES ('986', '2', '49');
INSERT INTO `role_menu` VALUES ('985', '2', '46');
INSERT INTO `role_menu` VALUES ('984', '2', '115');
INSERT INTO `role_menu` VALUES ('983', '2', '44');
INSERT INTO `role_menu` VALUES ('982', '2', '6');
INSERT INTO `role_menu` VALUES ('981', '2', '36');
INSERT INTO `role_menu` VALUES ('980', '2', '35');
INSERT INTO `role_menu` VALUES ('979', '2', '34');
INSERT INTO `role_menu` VALUES ('978', '2', '29');
INSERT INTO `role_menu` VALUES ('977', '2', '28');
INSERT INTO `role_menu` VALUES ('976', '2', '77');
INSERT INTO `role_menu` VALUES ('975', '2', '5');
INSERT INTO `role_menu` VALUES ('974', '2', '52');
INSERT INTO `role_menu` VALUES ('1218', '6', '87');
INSERT INTO `role_menu` VALUES ('1217', '6', '86');
INSERT INTO `role_menu` VALUES ('1216', '6', '143');
INSERT INTO `role_menu` VALUES ('1215', '6', '142');
INSERT INTO `role_menu` VALUES ('1214', '6', '141');
INSERT INTO `role_menu` VALUES ('1213', '6', '140');
INSERT INTO `role_menu` VALUES ('1212', '6', '85');
INSERT INTO `role_menu` VALUES ('1211', '6', '139');
INSERT INTO `role_menu` VALUES ('1210', '6', '138');
INSERT INTO `role_menu` VALUES ('1209', '6', '137');
INSERT INTO `role_menu` VALUES ('1208', '6', '84');
INSERT INTO `role_menu` VALUES ('1207', '6', '83');
INSERT INTO `role_menu` VALUES ('1206', '6', '131');
INSERT INTO `role_menu` VALUES ('1205', '6', '122');
INSERT INTO `role_menu` VALUES ('1204', '6', '121');
INSERT INTO `role_menu` VALUES ('1203', '6', '119');
INSERT INTO `role_menu` VALUES ('1202', '6', '82');
INSERT INTO `role_menu` VALUES ('1201', '6', '118');
INSERT INTO `role_menu` VALUES ('1200', '6', '117');
INSERT INTO `role_menu` VALUES ('1199', '6', '114');
INSERT INTO `role_menu` VALUES ('1198', '6', '81');
INSERT INTO `role_menu` VALUES ('1197', '6', '80');
INSERT INTO `role_menu` VALUES ('1196', '6', '79');
INSERT INTO `role_menu` VALUES ('1195', '6', '107');
INSERT INTO `role_menu` VALUES ('1194', '6', '78');
INSERT INTO `role_menu` VALUES ('1193', '6', '7');
INSERT INTO `role_menu` VALUES ('1192', '6', '136');
INSERT INTO `role_menu` VALUES ('1191', '6', '135');
INSERT INTO `role_menu` VALUES ('1190', '6', '134');
INSERT INTO `role_menu` VALUES ('1189', '6', '133');
INSERT INTO `role_menu` VALUES ('1188', '6', '132');
INSERT INTO `role_menu` VALUES ('1187', '6', '112');
INSERT INTO `role_menu` VALUES ('1186', '6', '111');
INSERT INTO `role_menu` VALUES ('1185', '6', '110');
INSERT INTO `role_menu` VALUES ('1184', '6', '109');
INSERT INTO `role_menu` VALUES ('1183', '6', '113');
INSERT INTO `role_menu` VALUES ('1182', '6', '116');
INSERT INTO `role_menu` VALUES ('1181', '6', '108');
INSERT INTO `role_menu` VALUES ('1180', '6', '75');
INSERT INTO `role_menu` VALUES ('1179', '6', '73');
INSERT INTO `role_menu` VALUES ('1178', '6', '72');
INSERT INTO `role_menu` VALUES ('1177', '6', '49');
INSERT INTO `role_menu` VALUES ('1176', '6', '46');
INSERT INTO `role_menu` VALUES ('1175', '6', '115');
INSERT INTO `role_menu` VALUES ('1174', '6', '44');
INSERT INTO `role_menu` VALUES ('1173', '6', '6');
INSERT INTO `role_menu` VALUES ('1172', '6', '36');
INSERT INTO `role_menu` VALUES ('1171', '6', '35');
INSERT INTO `role_menu` VALUES ('1170', '6', '34');
INSERT INTO `role_menu` VALUES ('1169', '6', '29');
INSERT INTO `role_menu` VALUES ('1168', '6', '28');
INSERT INTO `role_menu` VALUES ('1167', '6', '77');
INSERT INTO `role_menu` VALUES ('973', '2', '50');
INSERT INTO `role_menu` VALUES ('972', '2', '4');
INSERT INTO `role_menu` VALUES ('734', '1', '39');
INSERT INTO `role_menu` VALUES ('733', '1', '38');
INSERT INTO `role_menu` VALUES ('732', '1', '43');
INSERT INTO `role_menu` VALUES ('731', '1', '42');
INSERT INTO `role_menu` VALUES ('730', '1', '41');
INSERT INTO `role_menu` VALUES ('729', '1', '37');
INSERT INTO `role_menu` VALUES ('1166', '6', '5');
INSERT INTO `role_menu` VALUES ('1165', '6', '52');
INSERT INTO `role_menu` VALUES ('1164', '6', '50');
INSERT INTO `role_menu` VALUES ('1163', '6', '4');
INSERT INTO `role_menu` VALUES ('1162', '6', '48');
INSERT INTO `role_menu` VALUES ('1161', '6', '47');
INSERT INTO `role_menu` VALUES ('1160', '6', '45');
INSERT INTO `role_menu` VALUES ('1159', '6', '3');
INSERT INTO `role_menu` VALUES ('1158', '6', '40');
INSERT INTO `role_menu` VALUES ('1157', '6', '39');
INSERT INTO `role_menu` VALUES ('971', '2', '48');
INSERT INTO `role_menu` VALUES ('970', '2', '47');
INSERT INTO `role_menu` VALUES ('969', '2', '45');
INSERT INTO `role_menu` VALUES ('968', '2', '3');
INSERT INTO `role_menu` VALUES ('967', '2', '40');
INSERT INTO `role_menu` VALUES ('966', '2', '39');
INSERT INTO `role_menu` VALUES ('965', '2', '38');
INSERT INTO `role_menu` VALUES ('964', '2', '43');
INSERT INTO `role_menu` VALUES ('963', '2', '42');
INSERT INTO `role_menu` VALUES ('962', '2', '41');
INSERT INTO `role_menu` VALUES ('961', '2', '37');
INSERT INTO `role_menu` VALUES ('960', '2', '2');
INSERT INTO `role_menu` VALUES ('959', '2', '1');
INSERT INTO `role_menu` VALUES ('1156', '6', '38');
INSERT INTO `role_menu` VALUES ('1155', '6', '43');
INSERT INTO `role_menu` VALUES ('1154', '6', '42');
INSERT INTO `role_menu` VALUES ('1153', '6', '41');
INSERT INTO `role_menu` VALUES ('1152', '6', '37');
INSERT INTO `role_menu` VALUES ('1151', '6', '2');
INSERT INTO `role_menu` VALUES ('1150', '6', '1');
INSERT INTO `role_menu` VALUES ('999', '2', '107');
INSERT INTO `role_menu` VALUES ('1000', '2', '79');
INSERT INTO `role_menu` VALUES ('1001', '2', '80');
INSERT INTO `role_menu` VALUES ('1002', '2', '81');
INSERT INTO `role_menu` VALUES ('1003', '2', '114');
INSERT INTO `role_menu` VALUES ('1004', '2', '117');
INSERT INTO `role_menu` VALUES ('1005', '2', '118');
INSERT INTO `role_menu` VALUES ('1006', '2', '82');
INSERT INTO `role_menu` VALUES ('1007', '2', '119');
INSERT INTO `role_menu` VALUES ('1008', '2', '121');
INSERT INTO `role_menu` VALUES ('1009', '2', '122');
INSERT INTO `role_menu` VALUES ('1010', '2', '131');
INSERT INTO `role_menu` VALUES ('1011', '2', '83');
INSERT INTO `role_menu` VALUES ('1012', '2', '84');
INSERT INTO `role_menu` VALUES ('1013', '2', '85');
INSERT INTO `role_menu` VALUES ('1014', '2', '86');
INSERT INTO `role_menu` VALUES ('1015', '2', '87');
INSERT INTO `role_menu` VALUES ('1016', '2', '88');
INSERT INTO `role_menu` VALUES ('1017', '2', '89');
INSERT INTO `role_menu` VALUES ('1018', '2', '90');
INSERT INTO `role_menu` VALUES ('1019', '2', '91');
INSERT INTO `role_menu` VALUES ('1020', '2', '92');
INSERT INTO `role_menu` VALUES ('1021', '2', '93');
INSERT INTO `role_menu` VALUES ('1022', '2', '94');
INSERT INTO `role_menu` VALUES ('1023', '2', '95');
INSERT INTO `role_menu` VALUES ('1024', '2', '96');
INSERT INTO `role_menu` VALUES ('1025', '2', '126');
INSERT INTO `role_menu` VALUES ('1026', '2', '127');
INSERT INTO `role_menu` VALUES ('1027', '2', '128');
INSERT INTO `role_menu` VALUES ('1028', '2', '129');
INSERT INTO `role_menu` VALUES ('1029', '2', '8');
INSERT INTO `role_menu` VALUES ('1030', '2', '59');
INSERT INTO `role_menu` VALUES ('1031', '2', '60');
INSERT INTO `role_menu` VALUES ('1032', '2', '61');
INSERT INTO `role_menu` VALUES ('1033', '2', '62');
INSERT INTO `role_menu` VALUES ('1034', '2', '68');
INSERT INTO `role_menu` VALUES ('1035', '2', '69');
INSERT INTO `role_menu` VALUES ('1036', '2', '70');
INSERT INTO `role_menu` VALUES ('1037', '2', '71');
INSERT INTO `role_menu` VALUES ('1038', '2', '9');
INSERT INTO `role_menu` VALUES ('1039', '2', '27');
INSERT INTO `role_menu` VALUES ('1040', '2', '30');
INSERT INTO `role_menu` VALUES ('1041', '2', '31');
INSERT INTO `role_menu` VALUES ('1042', '2', '32');
INSERT INTO `role_menu` VALUES ('1043', '2', '33');
INSERT INTO `role_menu` VALUES ('1044', '2', '26');
INSERT INTO `role_menu` VALUES ('1045', '2', '53');
INSERT INTO `role_menu` VALUES ('1046', '2', '54');
INSERT INTO `role_menu` VALUES ('1047', '2', '55');
INSERT INTO `role_menu` VALUES ('1048', '2', '56');
INSERT INTO `role_menu` VALUES ('1049', '2', '98');
INSERT INTO `role_menu` VALUES ('1050', '2', '99');
INSERT INTO `role_menu` VALUES ('1051', '2', '120');
INSERT INTO `role_menu` VALUES ('1052', '2', '103');
INSERT INTO `role_menu` VALUES ('1053', '2', '104');
INSERT INTO `role_menu` VALUES ('1054', '2', '123');
INSERT INTO `role_menu` VALUES ('1055', '2', '105');
INSERT INTO `role_menu` VALUES ('1056', '2', '124');
INSERT INTO `role_menu` VALUES ('1057', '2', '125');
INSERT INTO `role_menu` VALUES ('1058', '2', '130');
INSERT INTO `role_menu` VALUES ('1059', '2', '11');
INSERT INTO `role_menu` VALUES ('1060', '2', '17');
INSERT INTO `role_menu` VALUES ('1061', '2', '18');
INSERT INTO `role_menu` VALUES ('1062', '2', '19');
INSERT INTO `role_menu` VALUES ('1063', '2', '20');
INSERT INTO `role_menu` VALUES ('1064', '2', '21');
INSERT INTO `role_menu` VALUES ('1065', '2', '12');
INSERT INTO `role_menu` VALUES ('1066', '2', '22');
INSERT INTO `role_menu` VALUES ('1067', '2', '23');
INSERT INTO `role_menu` VALUES ('1068', '2', '24');
INSERT INTO `role_menu` VALUES ('1069', '2', '25');
INSERT INTO `role_menu` VALUES ('1070', '2', '13');
INSERT INTO `role_menu` VALUES ('1071', '2', '14');
INSERT INTO `role_menu` VALUES ('1072', '2', '15');
INSERT INTO `role_menu` VALUES ('1073', '2', '16');
INSERT INTO `role_menu` VALUES ('1226', '6', '95');
INSERT INTO `role_menu` VALUES ('1227', '6', '96');
INSERT INTO `role_menu` VALUES ('1228', '6', '126');
INSERT INTO `role_menu` VALUES ('1229', '6', '127');
INSERT INTO `role_menu` VALUES ('1230', '6', '128');
INSERT INTO `role_menu` VALUES ('1231', '6', '129');
INSERT INTO `role_menu` VALUES ('1232', '6', '144');
INSERT INTO `role_menu` VALUES ('1233', '6', '8');
INSERT INTO `role_menu` VALUES ('1234', '6', '59');
INSERT INTO `role_menu` VALUES ('1235', '6', '60');
INSERT INTO `role_menu` VALUES ('1236', '6', '61');
INSERT INTO `role_menu` VALUES ('1237', '6', '62');
INSERT INTO `role_menu` VALUES ('1238', '6', '68');
INSERT INTO `role_menu` VALUES ('1239', '6', '69');
INSERT INTO `role_menu` VALUES ('1240', '6', '70');
INSERT INTO `role_menu` VALUES ('1241', '6', '71');
INSERT INTO `role_menu` VALUES ('1242', '6', '9');
INSERT INTO `role_menu` VALUES ('1243', '6', '27');
INSERT INTO `role_menu` VALUES ('1244', '6', '30');
INSERT INTO `role_menu` VALUES ('1245', '6', '31');
INSERT INTO `role_menu` VALUES ('1246', '6', '32');
INSERT INTO `role_menu` VALUES ('1247', '6', '33');
INSERT INTO `role_menu` VALUES ('1248', '6', '26');
INSERT INTO `role_menu` VALUES ('1249', '6', '53');
INSERT INTO `role_menu` VALUES ('1250', '6', '54');
INSERT INTO `role_menu` VALUES ('1251', '6', '55');
INSERT INTO `role_menu` VALUES ('1252', '6', '56');
INSERT INTO `role_menu` VALUES ('1253', '6', '98');
INSERT INTO `role_menu` VALUES ('1254', '6', '99');
INSERT INTO `role_menu` VALUES ('1255', '6', '120');
INSERT INTO `role_menu` VALUES ('1256', '6', '103');
INSERT INTO `role_menu` VALUES ('1257', '6', '104');
INSERT INTO `role_menu` VALUES ('1258', '6', '123');
INSERT INTO `role_menu` VALUES ('1259', '6', '105');
INSERT INTO `role_menu` VALUES ('1260', '6', '124');
INSERT INTO `role_menu` VALUES ('1261', '6', '125');
INSERT INTO `role_menu` VALUES ('1262', '6', '130');
INSERT INTO `role_menu` VALUES ('1263', '6', '11');
INSERT INTO `role_menu` VALUES ('1264', '6', '17');
INSERT INTO `role_menu` VALUES ('1265', '6', '18');
INSERT INTO `role_menu` VALUES ('1266', '6', '19');
INSERT INTO `role_menu` VALUES ('1267', '6', '20');
INSERT INTO `role_menu` VALUES ('1268', '6', '21');
INSERT INTO `role_menu` VALUES ('1269', '6', '12');
INSERT INTO `role_menu` VALUES ('1270', '6', '22');
INSERT INTO `role_menu` VALUES ('1271', '6', '23');
INSERT INTO `role_menu` VALUES ('1272', '6', '24');
INSERT INTO `role_menu` VALUES ('1273', '6', '25');
INSERT INTO `role_menu` VALUES ('1274', '6', '13');
INSERT INTO `role_menu` VALUES ('1275', '6', '14');
INSERT INTO `role_menu` VALUES ('1276', '6', '15');
INSERT INTO `role_menu` VALUES ('1277', '6', '16');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='角色用户关联表';

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
INSERT INTO `role_user` VALUES ('19', '17', '6');

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
  `p_id` text NOT NULL COMMENT '考试题目个数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_sj
-- ----------------------------
INSERT INTO `study_sj` VALUES ('12', '去去去', '请选择机构', '1', '2016-05-05 17:05:00', '2016-05-23 17:05:00', '0', '崔俊11', '1', '30', '85,64,84,63,74,80,60,75,61,66,81,58,77,90,87,69,68,73,92,62,79,76,59,70,57,67,86,82,88,83');
INSERT INTO `study_sj` VALUES ('13', '石头人', '请选择机构', '4', '2016-05-10 17:05:00', '2016-05-02 17:05:00', '0', '崔俊11', '30', '30', '85,64,84,63,74,80,60,75,61,66,81,58,77,90,87,69,68,73,92,62,79,76,59,70,57,67,86,82,88,83');
INSERT INTO `study_sj` VALUES ('14', '钱浩浩', '请选择机构', '4', '2016-05-12 17:05:00', '2016-05-23 17:05:00', '1', '崔俊11', '30', '30', '76,75,65,77,61,79,90,72,84,68,73,71,87,86,66,70,62,58,80,60,78,88,57,92,69,82,64,89,59,74');
INSERT INTO `study_sj` VALUES ('15', '王子的新衣', '请选择机构', '7', '2016-05-03 17:05:00', '2016-05-16 17:05:00', '1', '崔俊11', '30', '40', '67,87,88,91,78,86,73,85,61,57,89,77,84,72,92,76,65,71,80,62,75,58,63,64,69,59,83,82,68,90,66,60,70,79,81,74');
INSERT INTO `study_sj` VALUES ('16', '这个简单的世界谁不知道谁呀', '请选择机构', '7', '2016-05-02 17:05:00', '2016-05-10 17:05:00', '2', '崔俊11', '30', '30', '72,65,58,57,88,62,69,82,89,91,76,68,64,74,85,78,75,60,86,83,71,81,90,87,70,77,67,79,80,73');
INSERT INTO `study_sj` VALUES ('17', '是谁在对我', '请选择机构', '7', '2016-05-02 17:05:00', '2016-05-09 17:05:00', '2', '崔俊11', '30', '10', '85,66,75,89,78,87,61,62,92,91');

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
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_tk
-- ----------------------------
INSERT INTO `study_tk` VALUES ('66', '啊大大大', '崔俊11', '2016-05-29 11:01:47', '{\"A\":\"11111111111111\",\"B\":\"222222222222222222\",\"C\":\"33333333333333333333\"}', 'A', '啊实打实大师大师大师的权威', '1');
INSERT INTO `study_tk` VALUES ('62', '王子11111111', '崔俊11', '2016-05-29 10:49:56', '{\"A\":\"1111\",\"B\":\"222222222\"}', 'A', '666666666666', '1');
INSERT INTO `study_tk` VALUES ('63', '爱情三十六计', '崔俊11', '2016-05-29 10:59:28', '{\"A\":\"11111111111111111\",\"B\":\"2222222222222\",\"C\":\"33333333333333333333\",\"D\":\"44444444444444\"}', 'A', '爱情', '1');
INSERT INTO `study_tk` VALUES ('64', '我不知道的事情', '崔俊11', '2016-05-29 11:00:09', '{\"A\":\"\\u50cf\\u75af\\u4e86\\u4e00\\u6837\",\"B\":\"1111111\",\"C\":\"222222222222222\",\"D\":\"33333333334\",\"E\":\"44444444444444\"}', 'A', '来回答了客户的卡拉还是考虑到 ', '1');
INSERT INTO `study_tk` VALUES ('65', '疯子', '崔俊11', '2016-05-29 11:00:25', '{\"A\":\"1111111111112\",\"B\":\"222222222222222\"}', 'A', '22发的发生大法师打发第三方', '1');
INSERT INTO `study_tk` VALUES ('61', '王子的新衣', '崔俊11', '2016-05-29 10:37:33', '{\"A\":\"1111111111\",\"B\":\"2222222222222\",\"C\":\"33333333\",\"D\":\"44444444444\",\"E\":\"44455555555555555\",\"F\":\"666666666666\"}', 'A', '我不知道的事情', '1');
INSERT INTO `study_tk` VALUES ('60', '钱浩浩', '崔俊11', '2016-05-29 10:17:19', '{\"A\":\"11111111111\",\"B\":\"2222222\",\"C\":\"33333333333\",\"D\":\"44444444444\",\"E\":\"555555555555555\"}', 'A', '6666666666666', '1');
INSERT INTO `study_tk` VALUES ('59', '战苍穹111', '崔俊11', '2016-05-29 09:18:35', '{\"A\":\"\\u6218\\u82cd\\u7a791111\",\"B\":\"\\u6218\\u82cd\\u7a79222\",\"C\":\"\\u6218\\u82cd\\u7a79333\"}', 'A', '战苍穹', '3');
INSERT INTO `study_tk` VALUES ('58', '完美世界', '崔俊11', '2016-05-29 09:17:39', '{\"A\":\"\\u5b8c\\u7f8e\\u4e16\\u754c1\",\"B\":\"\\u5b8c\\u7f8e\\u4e16\\u754c2\",\"C\":\"\\u5b8c\\u7f8e\\u4e16\\u754c3\"}', 'B', '完美世界', '1');
INSERT INTO `study_tk` VALUES ('57', '钱浩浩', '崔俊11', '2016-05-29 09:17:03', '{\"A\":\"111111\",\"B\":\"22222\",\"C\":\"33333\"}', 'A', '钱浩浩', '1');
INSERT INTO `study_tk` VALUES ('67', '啊实打实的', '崔俊11', '2016-05-29 11:02:06', '{\"A\":\"111111111111111\",\"B\":\"22222222222222\",\"C\":\"33333333333333333\",\"D\":\"44444444444444\",\"E\":\"55555555555555\"}', 'E', '5打算打打', '1');
INSERT INTO `study_tk` VALUES ('68', '啊实打实的', '崔俊11', '2016-05-29 11:02:06', '{\"A\":\"111111111111111\",\"B\":\"22222222222222\",\"C\":\"33333333333333333\",\"D\":\"44444444444444\",\"E\":\"55555555555555\"}', 'E', 'asdsadsadasd', '1');
INSERT INTO `study_tk` VALUES ('69', '安静的卡拉时间打开啦', '崔俊11', '2016-05-29 11:03:56', '{\"A\":\"1111111111111111\",\"B\":\"2222222222222\"}', 'A', '333333333333333333', '1');
INSERT INTO `study_tk` VALUES ('70', '1111111', '崔俊11', '2016-05-29 11:04:20', '{\"A\":\"11111111111111\",\"B\":\"222222222\",\"C\":\"44444444444444\"}', 'A', '222333333333333333', '1');
INSERT INTO `study_tk` VALUES ('71', '的发生地方都是', '崔俊11', '2016-05-29 11:04:36', '{\"A\":\"1111111\",\"B\":\"1111111111112222222\",\"C\":\"333333333\",\"D\":\"33344444444444444\",\"E\":\"455555555555\"}', 'A', '的范德萨发的发', '1');
INSERT INTO `study_tk` VALUES ('72', '范德萨发斯蒂芬斯蒂芬', '崔俊11', '2016-05-29 11:04:49', '{\"A\":\"111111111111111\",\"B\":\"2222222222222222\",\"C\":\"333333333333333333\",\"D\":\"4444444444444444\"}', 'A', '是的范德萨发生的', '1');
INSERT INTO `study_tk` VALUES ('73', '对方水电费水电费', '崔俊11', '2016-05-29 11:05:04', '{\"A\":\"1111111111111111\",\"B\":\"222222222222222222222\",\"C\":\"333333333333\",\"D\":\"444444444444444\"}', 'A', '3333333333333333', '1');
INSERT INTO `study_tk` VALUES ('74', '发斯蒂芬斯蒂芬', '崔俊11', '2016-05-29 11:05:33', '{\"A\":\"1111111111111111\",\"B\":\"222222222222222\",\"C\":\"33333333333333333344\",\"D\":\"444444444444444444\",\"E\":\"55555555555555\"}', 'C', '的范德萨发斯蒂芬斯蒂芬', '1');
INSERT INTO `study_tk` VALUES ('75', '啊实打实大声道', '崔俊11', '2016-05-29 11:05:53', '{\"A\":\"11111111111111111\",\"B\":\"222222222222222222\",\"C\":\"3333333333333\",\"D\":\"44444444444444\"}', 'D', '地方大幅度是的发送到', '1');
INSERT INTO `study_tk` VALUES ('76', '对方水电费水电费三顿饭', '崔俊11', '2016-05-29 11:06:16', '{\"A\":\"111111111111111111\",\"B\":\"222222222222222222222222222\",\"C\":\"333333333333333\",\"D\":\"44444444444444444444\",\"E\":\"55555555555555\"}', 'A', '5的法师的法师的', '1');
INSERT INTO `study_tk` VALUES ('77', '打算打打打打', '崔俊11', '2016-05-29 11:06:31', '{\"A\":\"11111111111111111\",\"B\":\"22222222222222\",\"C\":\"33333333333333\",\"D\":\"44444444444444444\"}', 'A', '发生大幅度的分公司答复', '1');
INSERT INTO `study_tk` VALUES ('78', '第三方斯蒂芬斯蒂芬', '崔俊11', '2016-05-29 11:07:34', '{\"A\":\"1111111111111111\",\"B\":\"22222222222222222\",\"C\":\"33333333333333\",\"D\":\"4444444444444444\"}', 'A', '打发斯蒂芬斯蒂芬', '1');
INSERT INTO `study_tk` VALUES ('79', '大哥大法师打发', '崔俊11', '2016-05-29 11:08:37', '{\"A\":\"1111111111111111\",\"B\":\"222222222222222\",\"C\":\"333333333333333\",\"D\":\"44444444444444\"}', 'A', '让对方的说法是否', '1');
INSERT INTO `study_tk` VALUES ('80', '法国代购的反对他个人', '崔俊11', '2016-05-29 11:08:54', '{\"A\":\"111111111111111\",\"B\":\"222222222222222222\",\"C\":\"333333333333333333\",\"D\":\"34444444444444\"}', 'C', '规划法规和法国恢复', '1');
INSERT INTO `study_tk` VALUES ('81', '11111111111111', '崔俊11', '2016-05-29 11:09:13', '{\"A\":\"2323232\",\"B\":\"32324534534\",\"C\":\"\\u513f\\u7ae5\\u70edTV\",\"D\":\"rterte\",\"E\":\"\\u70ed\\u7279\\u7279\\u4eba\"}', 'D', '和恢复供货方让他夜夜', '1');
INSERT INTO `study_tk` VALUES ('82', '王企鹅王企鹅企鹅去', '崔俊11', '2016-05-29 11:09:27', '{\"A\":\"\\u53bb\\u59d4\\u5c48\\u59d4\\u5c48\\u59d4\\u5c48\",\"B\":\"\\u4f01\\u9e45\\u738b\\u8bf7\\u95ee\",\"C\":\"33333333333333\",\"D\":\"4444444444444444444444\"}', 'A', '为全文', '1');
INSERT INTO `study_tk` VALUES ('83', '王企鹅问问企鹅王', '崔俊11', '2016-05-29 11:09:41', '{\"A\":\"1111111111111111\",\"B\":\"22222222222222\",\"C\":\"4444444444444444\"}', 'A', '是电饭锅电饭锅的', '1');
INSERT INTO `study_tk` VALUES ('84', '的方法改革如同仁堂', '崔俊11', '2016-05-29 11:09:56', '{\"A\":\"11111111111111\",\"B\":\"22222222222222222222\",\"C\":\"44444444444444444445\",\"D\":\"55555555555555\"}', 'A', '电饭锅电饭锅电饭锅', '1');
INSERT INTO `study_tk` VALUES ('85', '恢复规划与人体有', '崔俊11', '2016-05-29 11:10:11', '{\"A\":\"222222222\",\"B\":\"222222234454\",\"C\":\"5445454545454\"}', 'A', '合格和风格也让他也太容易', '1');
INSERT INTO `study_tk` VALUES ('86', '大幅度也让他也让他', '崔俊11', '2016-05-29 11:10:22', '{\"A\":\"111111111111111\",\"B\":\"222222222222222233\"}', 'A', '33333333333333333333', '1');
INSERT INTO `study_tk` VALUES ('87', '格瑞特瑞特让他热', '崔俊11', '2016-05-29 11:10:37', '{\"A\":\"11111111111111\",\"B\":\"22222222222222222\\u56de\\u590d\\u7684\\u6d3b\\u52a8\\u8986\\u76d6\",\"C\":\"\\u55ef\\u55ef\\u55ef\\u55ef\\u55ef\\u55ef\",\"D\":\"\\u4e2a\\u68b5\\u8482\\u5188\\u5730\\u65b9\"}', 'D', '111111111111111', '1');
INSERT INTO `study_tk` VALUES ('88', '111111111111111', '崔俊11', '2016-05-29 11:10:49', '{\"A\":\"22222222222\",\"B\":\"34324234 \"}', 'A', '23423423423423', '1');
INSERT INTO `study_tk` VALUES ('89', '11111111111111111', '崔俊11', '2016-05-29 11:11:03', '{\"A\":\"23\\u4eba\\u73a9\\u513f\\u73a9\\u513f\",\"B\":\"\\u73a9\\u513f\\u73a9\\u513f\\u5b8c\",\"C\":\"4434534534534\"}', 'A', '广泛的广泛的覆盖到法国代购', '1');
INSERT INTO `study_tk` VALUES ('90', '范德萨发的', '崔俊11', '2016-05-29 11:11:20', '{\"A\":\"11111111111111\",\"B\":\"22222222222222\",\"C\":\"333333333333333\",\"D\":\"44444444444444444\"}', 'A', '打发斯蒂芬斯蒂芬的说法是否', '1');
INSERT INTO `study_tk` VALUES ('91', '改革的风格的风格让他', '崔俊11', '2016-05-29 11:11:34', '{\"A\":\"111111111111111111\",\"B\":\"22222222222222222\",\"C\":\"33333333333333333333\"}', 'A', '的GV程序写程序需', '1');
INSERT INTO `study_tk` VALUES ('92', '对方受到房地产法宣传V型', '崔俊11', '2016-05-29 11:11:45', '{\"A\":\"1111111111111111111111111\",\"B\":\"2222222222222222222\"}', 'A', '2第三方为儿童我让他热帖', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='差旅费报销申请表单';

-- ----------------------------
-- Records of travel
-- ----------------------------
INSERT INTO `travel` VALUES ('4', '2', '2016-05-28 17:10:54', '2016-04-30', '2016-05-21', '222', '1221', '50', '1', '50', '1', '50', '1', '50', '200', '8', '审批', '0', '1', '崔俊11', null, '1', null, '0', '1', '崔俊11', null, '1', null, '0', '1', '崔俊11', null, '1', null, '0');
INSERT INTO `travel` VALUES ('5', '4', '2016-05-29 09:01:36', '2016-05-29', '2016-05-31', '人民大会堂', '开会', '100', '10', '500', '10', '500', '5', '2000', '10500', '1', '崔俊11', '1', '2', '崔俊', '2016-05-29 09:22:56', '1', null, '1', '13', 'xubaobao', '2016-05-29 09:23:03', '1', null, '0', '8', '审批', '2016-05-29 09:16:01', '2', '121', '1');
INSERT INTO `travel` VALUES ('8', '1', '2016-05-29 11:10:20', '2016-05-26', '2016-05-29', '上海', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '嗷嗷嗷嗷嗷', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '崔俊11', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$24ILXZNwa/y6p6NX/35X6Oube8gnZQ1fZgKnIUmRKw5P/dpBV5bQK', '0', 'admin@qq.com', '10', '1454403070', '1464565978', '1464565978', '127.0.0.1', '5', '22222', '001');
INSERT INTO `user` VALUES ('2', 'cuijun', '崔俊', 'fUwgiWl7rKRZkibw4D4xEQ-zqeWw_0lb', '$2y$13$QDrNi9A8u25M7tvQBUYsAOGUDx5JX5h9LyioLHkH7BqYRHKYd0Vta', null, '1111@qq.com', '10', '1457681052', '1464483986', '1464483986', '127.0.0.1', '3', '11111', '117');
INSERT INTO `user` VALUES ('8', 'shenpi', '审批', '4BNN9RXTprCVX7V8vModU1jFuDaHb9ag', '$2y$13$pcpTm9QLP9uuxks.wJz69.LR2p5vjqXMxed2hX9aobW1mMmbDgC5u', null, null, '10', '1463727983', '1464484099', '1464484099', '127.0.0.1', '3', '33333', '003');
INSERT INTO `user` VALUES ('9', 'shenpi2', '审批2', 'jbqz7M0aRInIWkUrKu9yXgDYDBDn5yL4', '$2y$13$UC6ofS7MByLMQ.HrwJ0lx.Y4bplwYQXOEJAghG4hbq2ekN6Yk6m8m', null, null, '10', '1464002578', '1464002588', null, '', '1', '44444', '004');
INSERT INTO `user` VALUES ('10', 'shenpi3', '审批3', 'oOys6wPtzLCApRVqMJY0Fhur21i608l7', '$2y$13$zkN466vsbXVj/YK9DEA1M.OAUyN.w38Ng58bIFT4GBjnJkgKNh0gG', null, null, '10', '1464002610', '1464002650', null, '', '1', '55555', '005');
INSERT INTO `user` VALUES ('11', 'shenpi4', '审批4', 'ueYVph4HqWJPAI-75XI0lyy6Im83Z1kE', '$2y$13$FLHh7rGzq9Id5iFjUn01c.fPY3kyOoJstxcQsDkTRnQ61soT2QXXy', null, null, '10', '1464002672', '1464002672', null, '', '1', '66666', '006');
INSERT INTO `user` VALUES ('12', 'shouli', '崔俊', 'EwhzPTK-9m5NPwgYr63p8wfg2Rx7knsk', '$2y$13$qfoPJm7yrVcOIw5XQENd1Oh7I6G7wZ.sUOpcTTTZjE0/5jgo7C5bi', null, null, '10', '1464004917', '1464169584', null, '', '1', '77777', '007');
INSERT INTO `user` VALUES ('13', 'xubaobao', 'xubaobao', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464139950', '1464484136', '1464484136', '127.0.0.1', '1', '88888', '008');
INSERT INTO `user` VALUES ('14', 'baobao1', 'baobao1', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464426074', '1464426074', '127.0.0.1', '1', '99991', '009');
INSERT INTO `user` VALUES ('15', 'baobao2', 'baobao2', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464424567', '1464424567', '127.0.0.1', '1', '99992', '010');
INSERT INTO `user` VALUES ('16', 'baobao3', 'baobao3', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464427408', '1464427408', '127.0.0.1', '1', '99993', '011');
INSERT INTO `user` VALUES ('17', '11111', '王雪', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$bvGgs7fpxw1zjrrGQ73Jzu0ud6gpsxEX93JXxYps5zoOk6wWtaKba', null, null, '10', '1464503220', '1464516079', '1464515987', '127.0.0.1', '0', '65651', '022');

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
  PRIMARY KEY (`welfare_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of welfare
-- ----------------------------
INSERT INTO `welfare` VALUES ('0', '优秀新人奖', '辅助性福利', '2016-05-29 10:36:35', '2016-07-15 10:36:41', '1,2,3', '机构1,机构二', '福利详细福利详细福利详细福利详细');

-- ----------------------------
-- Table structure for welfare_apply
-- ----------------------------
DROP TABLE IF EXISTS `welfare_apply`;
CREATE TABLE `welfare_apply` (
  `welfare_apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `welfare_id` int(11) NOT NULL COMMENT '关联id',
  `welfare_name` varchar(200) NOT NULL COMMENT '福利名称',
  `welfare_apply_mee_id` int(11) NOT NULL COMMENT '申请人账号ID',
  `welfare_sp_id` int(11) NOT NULL COMMENT '审批人id',
  `welfare_apply_pack_status` enum('审批中','驳回','同意') NOT NULL DEFAULT '审批中' COMMENT '审批人状态，是否同意，默认为0，同意为1',
  `welfare_apply_pack_cancel_detail` text COMMENT '驳回详情',
  `welfare_lq` enum('未领取','已领取') NOT NULL DEFAULT '未领取' COMMENT '是否领取',
  PRIMARY KEY (`welfare_apply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of welfare_apply
-- ----------------------------
INSERT INTO `welfare_apply` VALUES ('1', '0', '', '1', '0', '', null, '');

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
INSERT INTO `xxjxgl` VALUES ('1', '钱浩浩', '遵守法律法规', '崔俊11', '2016-05-11 06:43:16', '海贼王', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/1464259396_198.doc');
INSERT INTO `xxjxgl` VALUES ('23', '1111', '1111', '崔俊11', '2016-05-26 07:06:17', '111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/1464260777_600.doc');
INSERT INTO `xxjxgl` VALUES ('24', '1111', '11111111111111', '崔俊11', '2016-05-26 07:26:33', '11111111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/2016.5.25Ǯ?ƺƹ?1???ձ?.doc');
INSERT INTO `xxjxgl` VALUES ('25', '11111', '11111111111', '崔俊11', '2016-05-26 07:27:40', '111111111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/2016.5.25Ǯ?ƺƹ?1???ձ?.doc');
INSERT INTO `xxjxgl` VALUES ('27', '11', '1111111', '崔俊11', '2016-05-26 07:51:16', '11111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/2016.5.26Ǯ?ƺƹ?1???ձ?.doc');
