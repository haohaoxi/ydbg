/*
Navicat MySQL Data Transfer

Source Server         : 移动办公内网数据库
Source Server Version : 50505
Source Host           : 192.168.3.242:3306
Source Database       : ydgb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-06-02 08:34:04
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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of announcement
-- ----------------------------
INSERT INTO `announcement` VALUES ('51', '111111111111', '2016-05-29 01:37:34', '崔俊11', '1464500254_707.doc', '');
INSERT INTO `announcement` VALUES ('52', 'QQQ', '2016-05-29 01:37:45', '崔俊11', '1464500265_314.doc', '');
INSERT INTO `announcement` VALUES ('57', '4787', '2016-05-29 02:06:32', '崔俊11', '1464501992_815.doc', '');
INSERT INTO `announcement` VALUES ('64', '4477857', '2016-05-29 02:14:38', '崔俊11', '1464502573_13.doc', '<p>768</p>');
INSERT INTO `announcement` VALUES ('72', '123231321232132', '2016-05-30 10:12:57', '崔俊11', '1464574377_517.doc', '<p>4646464654</p>');
INSERT INTO `announcement` VALUES ('73', '111', '2016-05-30 10:50:58', '崔俊11', '1464576679_27.doc', '<p>asd<br/></p>');
INSERT INTO `announcement` VALUES ('74', '123123213', '2016-05-30 03:07:28', '崔俊11', '1464592048_265.doc', '<p>12312</p>');
INSERT INTO `announcement` VALUES ('75', '123232', '2016-05-30 03:09:40', '崔俊11', '1464592180_321.doc', '<p>王企鹅</p>');
INSERT INTO `announcement` VALUES ('76', 'deshen', '2016-05-31 09:58:10', '崔俊11', '1464659890_487.doc', '<p>qqqqq</p>');
INSERT INTO `announcement` VALUES ('77', '11111', '2016-06-01 03:47:00', '崔俊', '', '');
INSERT INTO `announcement` VALUES ('78', '11111', '2016-06-01 03:47:01', '崔俊', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='机动车维修申请表单';

-- ----------------------------
-- Records of carwx
-- ----------------------------
INSERT INTO `carwx` VALUES ('1', '1', '2016-05-29 10:20:22', '2016-05-29', '苏At729A', '二保', '500.00', '二保二保二保二保', '13', 'xubaobao', '0', '1', '崔俊11', '2016-05-29 10:34:21', '1', null, '1', '8', '审批', '2016-05-29 10:35:05', '2', '888', '1', '8', '审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('2', '1', '2016-05-30 09:04:22', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('3', '1', '2016-05-30 09:04:23', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('4', '1', '2016-05-31 13:40:32', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('5', '1', '2016-05-31 13:41:02', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('6', '1', '2016-05-31 13:41:03', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('7', '1', '2016-05-31 13:41:03', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `carwx` VALUES ('8', '1', '2016-05-31 13:41:03', '2016-05-26', '苏A999999', '首保', '22.00', '啊啊啊啊啊啊啊啊啊', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='机构通讯录';

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
INSERT INTO `dept_contact` VALUES ('25', '地方', '王', null, null, null, null);

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
INSERT INTO `gongchu` VALUES ('1', '1', '1,2,8,', '3', '2016-05-25 00:00:00', '2016-05-25 00:00:00', '福建', '我多发点发呆发呆发呆大大方方', '1', '2', '0', '0000-00-00 00:00:00', null, '8', '0', '0000-00-00 00:00:00', null, '1', '0', '0');
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
INSERT INTO `kaoqin_day` VALUES ('7', '办公室', '111186', '孙国', '2016-04-04', '二', '正常班', '7:51', '14:51', '33.6', '15', '12.5', '395', '12.5', '5', '1', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COMMENT='会议报销申请表单';

-- ----------------------------
-- Records of meet
-- ----------------------------
INSERT INTO `meet` VALUES ('82', '会议测试', null, '2016-05-30 08:29:08', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('83', '北京人民大会堂', null, '2016-05-30 08:29:24', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('84', '北京人民大会堂', null, '2016-05-31 13:41:11', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('85', '北京人民大会堂', null, '2016-05-31 13:41:12', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('86', '北京人民大会堂', null, '2016-05-31 13:41:12', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('87', '北京人民大会堂', null, '2016-06-01 03:07:26', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('88', '北京人民大会堂', null, '2016-06-01 03:46:15', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('89', '北京人民大会堂', null, '2016-06-01 03:46:44', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');
INSERT INTO `meet` VALUES ('90', '北京人民大会堂', null, '2016-06-01 03:46:49', '2016-05-26', '1', '2', '2', '2', '7', '200.00', '500.00', '1000.00', '800.00', '121.00', '832.00', '11.00', '1222.00', '1', '张超', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', 'DSFSDFSDF', null, '0', null, '1', '1', '领导审批', null, '0', null, '1');

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
  `isdelete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1删除，0未删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='会议参与人表';

-- ----------------------------
-- Records of meet_join
-- ----------------------------
INSERT INTO `meet_join` VALUES ('1', '1', '12', '1', '0', '0');
INSERT INTO `meet_join` VALUES ('2', '1', '16', '0', '1', '1');
INSERT INTO `meet_join` VALUES ('3', '1', '15', '0', '1', '0');
INSERT INTO `meet_join` VALUES ('4', '1', '14', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('32', '12', '16', '1', '1', '0');
INSERT INTO `meet_join` VALUES ('33', '12', '15', '1', '0', '0');
INSERT INTO `meet_join` VALUES ('34', '12', '15', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('35', '12', '14', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('36', '12', '13', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('37', '13', '16', '1', '1', '1');
INSERT INTO `meet_join` VALUES ('38', '13', '1', '1', '0', '0');
INSERT INTO `meet_join` VALUES ('39', '13', '15', '0', '1', '0');
INSERT INTO `meet_join` VALUES ('40', '13', '14', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('47', '16', '1', '1', '1', '1');
INSERT INTO `meet_join` VALUES ('48', '16', '2', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('49', '16', '8', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('50', '16', '9', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('51', '16', '10', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('52', '16', '11', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('54', '14', '15', '1', '0', '0');
INSERT INTO `meet_join` VALUES ('55', '14', '16', '0', '0', '0');
INSERT INTO `meet_join` VALUES ('56', '15', '14', '1', '0', '0');
INSERT INTO `meet_join` VALUES ('57', '15', '15', '0', '0', '0');

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
  `isdelete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1删除0未删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='会议管理表';

-- ----------------------------
-- Records of meeting
-- ----------------------------
INSERT INTO `meeting` VALUES ('1', '会议1', '2016-05-26 00:00:00', '2016-05-27 00:00:00', '会议室1', '会议开始啊', '开始会呀', '', '1', '2016-05-29 16:27:10', '5', '1');
INSERT INTO `meeting` VALUES ('12', '回忆', '2016-05-30 00:00:00', '2016-06-01 00:00:00', '回忆说', '和意义是', '会意思的', '', '16', '2016-05-30 11:12:09', '1', '0');
INSERT INTO `meeting` VALUES ('13', '回忆说', '2016-05-26 00:00:00', '2016-05-31 00:00:00', '户籍意思', '发的发的', '会议的', '146457812082416.doc', '16', '2016-05-30 11:15:20', '1', '0');
INSERT INTO `meeting` VALUES ('14', '会议主题', '2016-06-05 13:00:00', '2016-06-05 16:00:00', '会议地点', '会议议程', '会议安排', null, '1', '2016-05-30 15:12:30', '5', '0');
INSERT INTO `meeting` VALUES ('15', '会议主题', '2016-06-05 13:00:00', '2016-06-05 16:00:00', '会议地点', '会议议程', '会议安排', null, '1', '2016-05-30 15:16:38', '5', '0');
INSERT INTO `meeting` VALUES ('16', '会议主题', '2016-06-05 13:00:00', '2016-06-05 16:00:00', '会议地点', '会议议程', '会议安排', null, '1', '2016-05-30 15:22:24', '5', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 COMMENT='菜单表';

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
INSERT INTO `menu` VALUES ('90', '我的申请记录', '0', '', 'welfareapply', 'welfareapply', 'index', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('91', '审批记录', '0', '', 'welfareapply', 'welfareapply', 'record', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('92', '福利领取', '0', '', 'welfareapply', 'welfareapply', 'myget', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('93', '办公用品管理', '0', '', '#', '#', '#', '', '7', '1', '1');
INSERT INTO `menu` VALUES ('94', '办公用品列表', '0', '', 'office', 'office', 'index', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('187', '新增用品', '0', '', 'office', 'office', 'create', '', '94', '0', '1');
INSERT INTO `menu` VALUES ('188', '修改用品', '0', '', 'office', 'office', 'update', '', '94', '0', '1');
INSERT INTO `menu` VALUES ('98', '学习进修管理', '5', '', 'xxjxgl', 'xxjxgl', 'index', '', '0', '1', '1');
INSERT INTO `menu` VALUES ('123', '试卷', '0', '', 'studysj', 'studysj', 'index', '', '103', '0', '1');
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
INSERT INTO `menu` VALUES ('124', '考试纪律', '0', '', 'studyjl', 'studyjl', 'index', '', '103', '0', '1');
INSERT INTO `menu` VALUES ('125', '题库', '0', '', 'studytk', 'studytk', 'index', '', '103', '0', '1');
INSERT INTO `menu` VALUES ('189', '删除用品', '0', '', 'office', 'office', 'view', '', '94', '0', '1');
INSERT INTO `menu` VALUES ('190', '用品申请表单', '0', '', 'office', 'office', 'sq', '', '94', '0', '1');
INSERT INTO `menu` VALUES ('191', '用品申请提交', '0', '', 'office', 'office', 'sqtj', '', '94', '0', '1');
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
INSERT INTO `menu` VALUES ('192', '采购申请表单', '0', '', 'office', 'office', 'cg', '', '94', '0', '1');
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
INSERT INTO `menu` VALUES ('193', '采购申请提交', '0', '', 'office', 'office', 'cgtj', '', '94', '0', '1');
INSERT INTO `menu` VALUES ('156', '会议管理', '0', '', 'meeting', 'meeting', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('157', '我的会议', '0', '', 'meeting', 'meeting', 'index', '', '156', '1', '1');
INSERT INTO `menu` VALUES ('158', '参与会议', '0', '', 'meeting', 'meetingjoin', 'index', '', '156', '1', '1');
INSERT INTO `menu` VALUES ('159', '发起会议', '0', '', 'meeting', 'meeting', 'create', '', '156', '0', '1');
INSERT INTO `menu` VALUES ('160', '查看', '0', '', 'meeting', 'meeting', 'view', '', '156', '0', '1');
INSERT INTO `menu` VALUES ('161', '删除', '0', '', 'meeting', 'meeting', 'delete', '', '156', '0', '1');
INSERT INTO `menu` VALUES ('162', '福利列表', '1', '', 'welfare', 'welfare', 'index', '', '89', '1', '1');
INSERT INTO `menu` VALUES ('163', '新增福利', '0', '', 'welfare', 'welfare', 'create', '', '162', '0', '1');
INSERT INTO `menu` VALUES ('164', '修改福利', '0', '', 'welfare', 'welfare', 'update', '', '162', '0', '1');
INSERT INTO `menu` VALUES ('165', '删除福利', '0', '', 'welfare', 'welfare', 'delete', '', '162', '0', '1');
INSERT INTO `menu` VALUES ('166', '查看福利', '0', '', 'welfare', 'welfare', 'view', '', '162', '0', '1');
INSERT INTO `menu` VALUES ('167', '申请表单', '0', '', 'welfare', 'welfare', 'sq', '', '162', '0', '1');
INSERT INTO `menu` VALUES ('168', '申请提交', '0', '', 'welfare', 'welfare', 'sqtj', '', '162', '0', '1');
INSERT INTO `menu` VALUES ('169', '查看', '0', '', 'welfareapply', 'welfareapply', 'view', '', '90', '0', '1');
INSERT INTO `menu` VALUES ('170', '删除', '0', '', 'welfareapply', 'welfareapply', 'delete', '', '90', '0', '1');
INSERT INTO `menu` VALUES ('171', '审批表单', '0', '', 'welfareapply', 'welfareapply', 'sp', '', '91', '0', '1');
INSERT INTO `menu` VALUES ('172', '同意', '0', '', 'welfareapply', 'welfareapply', 'spty', '', '91', '0', '1');
INSERT INTO `menu` VALUES ('173', '驳回', '0', '', 'welfareapply', 'welfareapply', 'spbh', '', '91', '0', '1');
INSERT INTO `menu` VALUES ('174', '查看', '0', '', 'welfareapply', 'welfareapply', 'spck', '', '91', '0', '1');
INSERT INTO `menu` VALUES ('175', '删除', '0', '', 'welfareapply', 'welfareapply', 'spdelete', '', '91', '0', '1');
INSERT INTO `menu` VALUES ('176', '领取操作', '0', '', 'welfareapply', 'welfareapply', 'lingqu', '', '92', '0', '1');
INSERT INTO `menu` VALUES ('177', '用车管理', '0', '', 'vehicle', 'vehicle', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('178', '车辆查看', '0', '', 'vehicle', 'vehicle', 'index', '', '177', '1', '1');
INSERT INTO `menu` VALUES ('179', '申请记录', '0', '', 'vehicle', 'vehicleapply', 'index', '', '177', '1', '1');
INSERT INTO `menu` VALUES ('180', '审批记录', '0', '', 'vehicle', 'audit', 'index', '', '177', '1', '1');
INSERT INTO `menu` VALUES ('181', '新增车辆', '0', '', 'vehicle', 'vehicle', 'create', '', '178', '0', '1');
INSERT INTO `menu` VALUES ('182', '批量导入', '0', '', 'vehicle', 'vehicle', 'import', '', '178', '0', '1');
INSERT INTO `menu` VALUES ('183', '批量导出', '0', '', 'vehicle', 'vehicle', 'export', '', '178', '0', '1');
INSERT INTO `menu` VALUES ('184', '查看', '0', '', 'vehicle', 'vehicle', 'view', '', '178', '0', '1');
INSERT INTO `menu` VALUES ('194', '查看', '0', '', 'vehicle', 'vehicleapply', 'view', '', '179', '0', '1');
INSERT INTO `menu` VALUES ('185', '申请', '0', '', 'vehicle', 'vehicleapply', 'create', '', '177', '0', '1');
INSERT INTO `menu` VALUES ('186', '删除', '0', '', 'vehicle', 'vehicle', 'delete', '', '178', '0', '1');
INSERT INTO `menu` VALUES ('195', '删除', '0', '', 'vehicle', 'vehicleapply', 'delete', '', '179', '0', '1');
INSERT INTO `menu` VALUES ('196', '审批', '0', '', 'vehicle', 'audit', 'update', '', '180', '0', '1');
INSERT INTO `menu` VALUES ('197', '删除', '0', '', 'vehicle', 'audit', 'delete', '', '180', '0', '1');
INSERT INTO `menu` VALUES ('198', '我的申请记录', '0', '', 'officeapply', 'officeapply', 'index', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('199', '查看', '0', '', 'officeapply', 'officeapply', 'view', '', '198', '0', '1');
INSERT INTO `menu` VALUES ('200', '删除', '0', '', 'officeapply', 'officeapply', 'delete', '', '198', '0', '1');
INSERT INTO `menu` VALUES ('201', '审批记录', '0', '', 'officeapply', 'officeapply', 'record', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('202', '请假管理', '1', '', 'qingjia', 'qingjia', 'index', '', '6', '1', '1');
INSERT INTO `menu` VALUES ('203', '申请记录', '0', '', 'qingjia', 'qingjia', 'index', '', '202', '1', '1');
INSERT INTO `menu` VALUES ('204', '审批记录', '0', '', 'qingjia', 'audit', 'index', '', '202', '1', '1');
INSERT INTO `menu` VALUES ('205', '请假申请', '0', '', 'qingjia', 'qingjia', 'create', '', '202', '0', '1');
INSERT INTO `menu` VALUES ('206', '查看', '0', '', 'qingjia', 'qingjia', 'view', '', '202', '0', '1');
INSERT INTO `menu` VALUES ('207', '删除', '0', '', 'qingjia', 'qingjia', 'delete', '', '202', '0', '1');
INSERT INTO `menu` VALUES ('208', '审批', '0', '', 'qingjia', 'audit', 'update', '', '204', '0', '1');
INSERT INTO `menu` VALUES ('209', '审批表单', '0', '', 'officeapply', 'officeapply', 'sp', '', '201', '0', '1');
INSERT INTO `menu` VALUES ('210', '审批查看', '0', '', 'officeapply', 'officeapply', 'spck', '', '201', '0', '1');
INSERT INTO `menu` VALUES ('211', '审批同意', '0', '', 'officeapply', 'officeapply', 'spty', '', '201', '0', '1');
INSERT INTO `menu` VALUES ('212', '审批驳回', '0', '', 'officeapply', 'officeapply', 'spbh', '', '201', '0', '1');
INSERT INTO `menu` VALUES ('213', '审批删除', '0', '', 'officeapply', 'officeapply', 'spdelete', '', '201', '0', '1');
INSERT INTO `menu` VALUES ('214', '办公用品领取', '0', '', 'officeapply', 'officeapply', 'myget', '', '93', '1', '1');
INSERT INTO `menu` VALUES ('215', '领取操作', '0', '', 'officeapply', 'officeapply', 'lingqu', '', '214', '0', '1');
INSERT INTO `menu` VALUES ('216', '消息管理', '0', '', 'message', 'message', 'index', '', '0', '0', '1');
INSERT INTO `menu` VALUES ('217', '设为已读', '0', '', 'message', 'message', 'yd', '', '216', '0', '1');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL COMMENT '消息类型',
  `contet` varchar(500) NOT NULL COMMENT '消息内容',
  `fsr` int(11) NOT NULL COMMENT '发送人',
  `jsr` int(11) NOT NULL COMMENT '接收人',
  `time` datetime NOT NULL COMMENT '发送时间',
  `is_reader` enum('未读','已读') NOT NULL DEFAULT '未读' COMMENT '是否读取',
  `url` varchar(500) NOT NULL COMMENT '链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '发起工作', 'admin发起了消息测试工作', '1', '2', '2016-06-01 15:53:15', '未读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":1}');
INSERT INTO `message` VALUES ('2', '发起工作', 'admin发起了测试消息2工作', '1', '1', '2016-06-01 16:09:07', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":1}');
INSERT INTO `message` VALUES ('10', '催办工作', 'admin催办了《ccccc》工作', '1', '1', '2016-06-01 17:33:28', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":1,\"PersonworkSearch[p_title]\":\"ccccc\"}');
INSERT INTO `message` VALUES ('11', '代办工作', 'admin让您代办了《title》工作', '1', '1', '2016-06-01 17:47:47', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":1,\"PersonworkSearch[p_title]\":\"title\"}');
INSERT INTO `message` VALUES ('12', '工作被代办', 'admin选择了《title》工作的代办 代办人:', '1', '1', '2016-06-01 17:47:47', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":1,\"PersonworkSearch[p_title]\":\"title\"}');
INSERT INTO `message` VALUES ('13', '退办工作', 'admin退办了《title》工作 退办原因:215', '1', '1', '2016-06-01 17:53:44', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":3,\"PersonworkSearch[p_title]\":\"title\"}');
INSERT INTO `message` VALUES ('14', '退办工作', 'admin退办了《title》工作 退办原因:66', '1', '1', '2016-06-01 17:55:35', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":3,\"PersonworkSearch[p_id]\":\"52\"}');
INSERT INTO `message` VALUES ('15', '退办工作', 'admin退办了《title》工作 退办原因:66', '1', '1', '2016-06-01 17:57:47', '已读', '{\"0\":\"personwork\\/personwork\\/index\",\"menutype\":3,\"PersonworkSearch[p_id]\":\"52\"}');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '阿萨德', '2016-05-29 03:00:53', '崔俊11', '1464505253_788.doc', '<p>爱上的</p>');
INSERT INTO `news` VALUES ('12', '111111111111111111111', '2016-06-01 05:44:45', '崔俊', '1464774285_623.doc', '<p>2112313213213</p>');
INSERT INTO `news` VALUES ('13', '12222222222222', '2016-06-01 05:46:31', '崔俊', '1464774391_181.doc', '<p>333333</p>');

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
  `office_end_time` datetime DEFAULT NULL COMMENT '申请结束时间',
  `office_part_name` varchar(100) NOT NULL COMMENT '适用机构名称，英文","号隔开',
  `office_type` varchar(20) NOT NULL COMMENT '用品类型',
  `office_id` int(11) NOT NULL AUTO_INCREMENT,
  `office_is_del` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='办公用品表';

-- ----------------------------
-- Records of office
-- ----------------------------
INSERT INTO `office` VALUES ('2222222222', '22222200', '4,5', '0', '2016-05-28 16:05:00', '2016-06-05 00:00:00', '21111e', '111111', '1', '1');
INSERT INTO `office` VALUES ('w222', '212111000', '4,5', '12', '2016-05-29 16:05:00', '2016-05-31 00:00:00', '212', '12', '2', '1');
INSERT INTO `office` VALUES ('2222222222', '3232220', '4,5', '23', '2016-05-28 16:05:00', '2016-06-05 00:00:00', '2323222222222222', '232', '3', '1');
INSERT INTO `office` VALUES ('22222222222', '2333', '4,5', '332', '2016-05-29 16:05:00', '2016-06-04 00:00:00', 'we', '323', '5', '1');
INSERT INTO `office` VALUES ('圆珠笔', '11', '4,5', '105', '2016-05-24 00:00:00', null, '科室四', '11', '6', '1');

-- ----------------------------
-- Table structure for office_apply
-- ----------------------------
DROP TABLE IF EXISTS `office_apply`;
CREATE TABLE `office_apply` (
  `apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `apply_office_id` int(11) NOT NULL COMMENT '办公用品ＩＤ',
  `apply_office_name` varchar(200) NOT NULL COMMENT '办公用品名称',
  `apply_num` int(11) NOT NULL COMMENT '需要申请办公用品数量',
  `apply_price` decimal(9,2) NOT NULL COMMENT '单价',
  `apply_money` decimal(9,2) NOT NULL COMMENT '金额',
  `apply_mee_id` int(11) NOT NULL COMMENT '申请人账号ID',
  `apply_mee_text` varchar(200) NOT NULL COMMENT '申请人',
  `apply_mee_id_is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  `apply_sq_time` datetime NOT NULL COMMENT '申请时间',
  `apply_pack_id` int(11) NOT NULL COMMENT '行装科负责人ID',
  `apply_pack_text` varchar(200) NOT NULL COMMENT '行装科负责人',
  `apply_pack_id_is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  `apply_pack_status` enum('同意','驳回','审批中') DEFAULT '审批中' COMMENT '行装科审批状态',
  `apply_pack_result` varchar(200) DEFAULT NULL COMMENT '行装科意见',
  `apply_pack_time` datetime DEFAULT NULL COMMENT '行装科处理时间',
  `apply_genneral_id` int(11) DEFAULT NULL COMMENT '检察长id',
  `apply_genneral_text` varchar(200) DEFAULT NULL COMMENT '检察长',
  `apply_genneral_id_is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  `apply_genneral_status` enum('同意','驳回','审批中') DEFAULT '审批中' COMMENT '检察长审批状态',
  `apply_genneral_result` varchar(200) DEFAULT NULL COMMENT '检察长意见',
  `apply_genneral_time` datetime DEFAULT NULL COMMENT '检察长处理时间',
  `apply_remarks` text COMMENT '备注',
  `apply_department` int(11) NOT NULL COMMENT '机构',
  `apply_lq_status` enum('已领取','未领取') DEFAULT '未领取',
  `apply_lq_time` datetime DEFAULT NULL COMMENT '领取时间',
  `apply_cgsq` enum('否','是') DEFAULT '否' COMMENT '是否采购申请',
  PRIMARY KEY (`apply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='办公用品领取详细表';

-- ----------------------------
-- Records of office_apply
-- ----------------------------
INSERT INTO `office_apply` VALUES ('16', '6', '圆珠笔', '1', '11.00', '11.00', '1', 'admin', '1', '2016-05-31 15:14:08', '1', 'xubaobao', '0', '同意', null, '2016-06-01 09:50:24', '13', 'xubaobao', '1', '同意', null, null, null, '5', '已领取', '2016-06-01 10:27:23', '否');
INSERT INTO `office_apply` VALUES ('17', '0', '121', '11', '2.00', '22.00', '1', 'admin', '1', '2016-05-31 15:14:18', '1', 'xubaobao', '1', '驳回', '112', '2016-06-01 10:04:14', '1', '崔俊', '1', '审批中', null, null, '23', '5', '未领取', null, '是');
INSERT INTO `office_apply` VALUES ('18', '0', '3日人', '11', '222.00', '244221.00', '1', 'admin', '1', '2016-05-31 15:15:11', '13', 'xubaobao', '1', '审批中', null, null, '1', '崔俊', '1', '审批中', null, null, '1', '5', '未领取', null, '是');
INSERT INTO `office_apply` VALUES ('19', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:02:58', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('20', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:03:11', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('21', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:03:11', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('22', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:03:11', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('23', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:05:21', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('24', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:05:21', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('25', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:10:19', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');
INSERT INTO `office_apply` VALUES ('26', '0', '毛笔', '22', '1.66', '37.00', '1', 'admin', '1', '2016-06-01 13:10:20', '2', '行装科负责人。', '1', '审批中', '顶顶顶顶顶', null, '2', null, '1', '审批中', '打发打发打发', null, '可以的可以的可以的可以的可以的', '5', '未领取', null, '否');

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
  `delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='人员通讯录';

-- ----------------------------
-- Records of people_contact
-- ----------------------------
INSERT INTO `people_contact` VALUES ('2', '啊', '1', '科长', '15851865478', '111111', '1111111', '1111111', '0');
INSERT INTO `people_contact` VALUES ('31', '挖潜那个啊', '1', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('30', '王啊', '2', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('21', '王嘉', '2', '科长', '13057018442', '12345678', '12345678', '1234', '0');
INSERT INTO `people_contact` VALUES ('29', '几啊', '2', '科长', '13057018442', null, null, '1234', '0');
INSERT INTO `people_contact` VALUES ('28', '人啊', '2', '科长', '13057018442', '12345678', null, null, '0');
INSERT INTO `people_contact` VALUES ('27', '王嘉啊', '2', '科长', '13057018442', '12345678', '12345678', '1234', '0');
INSERT INTO `people_contact` VALUES ('26', '人', '2', '科长', '13057018442', '12345678', null, null, '0');
INSERT INTO `people_contact` VALUES ('24', '几', '2', '科长', '13057018442', null, null, '1234', '0');
INSERT INTO `people_contact` VALUES ('23', '王', '2', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('22', '挖潜那个', '1', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('25', '留', '1', '科长', '13057018442', '12345678', '45678923', '1234', '0');
INSERT INTO `people_contact` VALUES ('32', '留啊', '1', '科长', '13057018442', '12345678', '45678923', '1234', '0');
INSERT INTO `people_contact` VALUES ('33', '王嘉啊', '2', '科长', '13057018442', '12345678', '12345678', '1234', '0');
INSERT INTO `people_contact` VALUES ('34', '人啊', '2', '科长', '13057018442', '12345678', null, null, '0');
INSERT INTO `people_contact` VALUES ('35', '几啊', '2', '科长', '13057018442', null, null, '1234', '0');
INSERT INTO `people_contact` VALUES ('37', '挖潜那个啊a', '1', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('39', '王嘉啊', '2', '科长', '13057018442', '12345678', '12345678', '1234', '0');
INSERT INTO `people_contact` VALUES ('40', '人啊', '2', '科长', '13057018442', '12345678', null, null, '0');
INSERT INTO `people_contact` VALUES ('41', '几啊', '2', '科长', '13057018442', null, null, '1234', '0');
INSERT INTO `people_contact` VALUES ('42', '王啊', '2', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('43', '挖潜那个啊', '1', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('44', '留啊', '1', '科长', '13057018442', '12345678', '45678923', '1234', '0');
INSERT INTO `people_contact` VALUES ('45', '三', '3', '科长', '13057018442', '12345678', '12345678', '1234', '0');
INSERT INTO `people_contact` VALUES ('46', '四', '2', '科长', '13057018442', '12345678', null, null, '0');
INSERT INTO `people_contact` VALUES ('47', '五', '2', '科长', '13057018442', null, null, '1234', '0');
INSERT INTO `people_contact` VALUES ('48', '六', '6', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('49', '七', '1', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('50', '八', '1', '科长', '13057018442', '12345678', '45678923', '1234', '0');
INSERT INTO `people_contact` VALUES ('51', '三', '3', '科长', '13057018442', '12345678', '12345678', '1234', '0');
INSERT INTO `people_contact` VALUES ('52', '四', '2', '科长', '13057018442', '12345678', null, null, '0');
INSERT INTO `people_contact` VALUES ('53', '五', '2', '科长', '13057018442', null, null, '1234', '0');
INSERT INTO `people_contact` VALUES ('54', '六', '6', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('55', '七', '1', '处长', '13057018442', '12345678', '12345678', null, '0');
INSERT INTO `people_contact` VALUES ('56', '八', '1', '科长', '13057018442', '12345678', '45678923', '1234', '1');
INSERT INTO `people_contact` VALUES ('58', '睡', '4', '社长', '13057018442', null, null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='个人办公管理';

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
INSERT INTO `person_work` VALUES ('52', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-27 11:17:57', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', '66', '1');
INSERT INTO `person_work` VALUES ('53', 'title', '2016-05-24 14:05:00', '2016-06-24 14:05:00', '2016-05-27 11:19:01', '一般', '1', '1,2,8,9', '崔俊11,崔俊,审批,审批2', '', '详情详情', null, '1');
INSERT INTO `person_work` VALUES ('55', '消息测试', '2016-06-01 15:06:00', '2016-07-01 15:07:00', '2016-06-01 15:53:15', '一般', '1', '2', '崔俊11', '2,8', '1515', null, '1');
INSERT INTO `person_work` VALUES ('57', '测试消息2', '2016-06-01 16:06:00', '2016-07-01 16:07:00', '2016-06-01 16:09:07', '紧急', '1', '1', '崔俊', '1,2,10', '1515', null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='个人办公工作流表';

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
INSERT INTO `person_work_workflow` VALUES ('59', '52', '1', '0', '2016-05-27 11:17:57', '2016-06-01 17:57:47', '未受理', '退办', '普通', '66', null, '1');
INSERT INTO `person_work_workflow` VALUES ('60', '52', '2', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('61', '52', '8', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('62', '52', '9', '0', '2016-05-27 11:17:57', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('63', '53', '1', '0', '2016-05-27 11:19:01', '2016-05-28 13:23:01', '未受理', '完成', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('64', '53', '2', '0', '2016-05-27 11:19:01', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('65', '53', '8', '0', '2016-05-27 11:19:01', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('66', '53', '9', '0', '2016-05-27 11:19:01', null, '未受理', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('68', '55', '2', '0', '2016-06-01 15:53:15', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('70', '57', '1', '0', '2016-06-01 16:09:07', null, '未审批', '无', '普通', null, null, '1');
INSERT INTO `person_work_workflow` VALUES ('71', '52', '1', '0', '2016-06-01 17:47:47', null, '未受理', '无', '代办', null, '1', '1');

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
-- Table structure for position
-- ----------------------------
DROP TABLE IF EXISTS `position`;
CREATE TABLE `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '职务名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='人员职务表';

-- ----------------------------
-- Records of position
-- ----------------------------
INSERT INTO `position` VALUES ('1', '书记');
INSERT INTO `position` VALUES ('2', '副书记');
INSERT INTO `position` VALUES ('3', '委员');
INSERT INTO `position` VALUES ('4', '主任');
INSERT INTO `position` VALUES ('5', '副主任');
INSERT INTO `position` VALUES ('6', '科员');

-- ----------------------------
-- Table structure for qingjia
-- ----------------------------
DROP TABLE IF EXISTS `qingjia`;
CREATE TABLE `qingjia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qj_ren` int(11) NOT NULL,
  `apply_time` datetime DEFAULT NULL,
  `dept` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL COMMENT '职务',
  `qj_type` int(11) NOT NULL,
  `qj_time` datetime NOT NULL COMMENT '请假时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `qj_day` float NOT NULL COMMENT '请假时长',
  `qj_reason` text NOT NULL,
  `dept_leader` int(11) NOT NULL,
  `dept_audit` int(3) DEFAULT '0' COMMENT '科室审核状态',
  `dept_audit_time` datetime DEFAULT NULL,
  `dept_reason` varchar(300) DEFAULT NULL,
  `branch_leader` int(11) NOT NULL,
  `branch_audit` int(3) DEFAULT '0',
  `branch_audit_time` datetime DEFAULT NULL,
  `branch_reason` varchar(300) DEFAULT NULL,
  `zzc` int(11) NOT NULL COMMENT '政治处领导',
  `zzc_audit` int(3) DEFAULT '0',
  `zzc_audit_time` datetime DEFAULT NULL,
  `zzc_reason` varchar(300) DEFAULT NULL,
  `jcz` int(11) DEFAULT NULL,
  `jcz_audit` int(3) DEFAULT '0',
  `jcz_audit_time` datetime DEFAULT NULL,
  `jcz_reason` varchar(300) DEFAULT NULL,
  `user_delete` tinyint(2) DEFAULT '0',
  `dept_delete` tinyint(2) DEFAULT '0',
  `branch_delete` tinyint(2) DEFAULT '0',
  `zzc_delete` tinyint(2) DEFAULT '0',
  `jcz_delete` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='请假表';

-- ----------------------------
-- Records of qingjia
-- ----------------------------
INSERT INTO `qingjia` VALUES ('1', '1', '2016-05-31 19:38:28', '5', '4', '1', '2016-06-02 00:00:00', '2016-06-03 00:00:00', '1', '请假原因', '2', '2', '2016-06-01 10:49:21', '院领导返驳原因', '8', '2', '2016-06-01 10:50:16', '院领导返驳原因', '9', '2', '2016-06-01 10:50:46', '院领导返驳原因', '1', '2', '2016-06-01 10:51:12', '院领导返驳原因', '1', '1', '1', '1', '1');
INSERT INTO `qingjia` VALUES ('2', '1', '2016-05-31 19:42:01', '5', '4', '1', '2016-06-02 00:00:00', '2016-06-03 00:00:00', '1', '请假原因', '2', '0', null, null, '8', '0', null, null, '9', '0', null, null, '1', '0', null, null, null, null, null, null, null);
INSERT INTO `qingjia` VALUES ('3', '1', '2016-05-31 19:45:26', '5', '4', '1', '2016-06-02 00:00:00', '2016-06-03 00:00:00', '1', '请假原因', '2', '0', null, null, '8', '0', null, null, '9', '0', null, null, '1', '0', null, null, null, null, null, null, null);
INSERT INTO `qingjia` VALUES ('4', '1', '2016-05-31 19:46:01', '5', '4', '1', '2016-06-02 00:00:00', '2016-06-03 00:00:00', '1', '请假原因', '2', '0', null, null, '8', '0', null, null, '9', '0', null, null, '1', '0', null, null, null, null, null, null, null);
INSERT INTO `qingjia` VALUES ('7', '1', '2016-05-31 19:46:01', '5', '5', '1', '2016-06-01 00:00:00', '2016-06-02 00:00:00', '1', '回家了啊', '13', '1', '2016-06-01 14:23:52', null, '15', '1', '2016-06-01 14:26:32', null, '14', '2', '2016-06-01 14:31:56', '不同意', null, '0', '2016-06-01 14:29:02', '不同意', '0', '0', '0', '1', '0');

-- ----------------------------
-- Table structure for qingjia_type
-- ----------------------------
DROP TABLE IF EXISTS `qingjia_type`;
CREATE TABLE `qingjia_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='请假类型表';

-- ----------------------------
-- Records of qingjia_type
-- ----------------------------
INSERT INTO `qingjia_type` VALUES ('1', '事假');
INSERT INTO `qingjia_type` VALUES ('2', '调休');
INSERT INTO `qingjia_type` VALUES ('3', '婚假');
INSERT INTO `qingjia_type` VALUES ('4', '产假');
INSERT INTO `qingjia_type` VALUES ('5', '病假');
INSERT INTO `qingjia_type` VALUES ('6', '丧假');
INSERT INTO `qingjia_type` VALUES ('7', '年假');
INSERT INTO `qingjia_type` VALUES ('8', '其他');

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
) ENGINE=MyISAM AUTO_INCREMENT=2356 DEFAULT CHARSET=utf8 COMMENT='角色菜单关联表';

-- ----------------------------
-- Records of role_menu
-- ----------------------------
INSERT INTO `role_menu` VALUES ('59', '3', '12');
INSERT INTO `role_menu` VALUES ('60', '3', '23');
INSERT INTO `role_menu` VALUES ('61', '3', '24');
INSERT INTO `role_menu` VALUES ('2348', '6', '22');
INSERT INTO `role_menu` VALUES ('2347', '6', '12');
INSERT INTO `role_menu` VALUES ('2346', '6', '21');
INSERT INTO `role_menu` VALUES ('2345', '6', '20');
INSERT INTO `role_menu` VALUES ('2344', '6', '19');
INSERT INTO `role_menu` VALUES ('2343', '6', '18');
INSERT INTO `role_menu` VALUES ('2342', '6', '17');
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
INSERT INTO `role_menu` VALUES ('1686', '2', '25');
INSERT INTO `role_menu` VALUES ('1685', '2', '24');
INSERT INTO `role_menu` VALUES ('1684', '2', '23');
INSERT INTO `role_menu` VALUES ('1683', '2', '22');
INSERT INTO `role_menu` VALUES ('1682', '2', '12');
INSERT INTO `role_menu` VALUES ('1681', '2', '21');
INSERT INTO `role_menu` VALUES ('1680', '2', '20');
INSERT INTO `role_menu` VALUES ('1679', '2', '19');
INSERT INTO `role_menu` VALUES ('1678', '2', '18');
INSERT INTO `role_menu` VALUES ('1677', '2', '17');
INSERT INTO `role_menu` VALUES ('1676', '2', '11');
INSERT INTO `role_menu` VALUES ('1675', '2', '130');
INSERT INTO `role_menu` VALUES ('1674', '2', '125');
INSERT INTO `role_menu` VALUES ('1673', '2', '124');
INSERT INTO `role_menu` VALUES ('1672', '2', '105');
INSERT INTO `role_menu` VALUES ('1671', '2', '123');
INSERT INTO `role_menu` VALUES ('1670', '2', '104');
INSERT INTO `role_menu` VALUES ('1669', '2', '103');
INSERT INTO `role_menu` VALUES ('1668', '2', '120');
INSERT INTO `role_menu` VALUES ('1667', '2', '99');
INSERT INTO `role_menu` VALUES ('1666', '2', '98');
INSERT INTO `role_menu` VALUES ('1665', '2', '56');
INSERT INTO `role_menu` VALUES ('1664', '2', '55');
INSERT INTO `role_menu` VALUES ('1663', '2', '54');
INSERT INTO `role_menu` VALUES ('1662', '2', '53');
INSERT INTO `role_menu` VALUES ('2341', '6', '11');
INSERT INTO `role_menu` VALUES ('2340', '6', '130');
INSERT INTO `role_menu` VALUES ('2339', '6', '125');
INSERT INTO `role_menu` VALUES ('2338', '6', '124');
INSERT INTO `role_menu` VALUES ('2337', '6', '105');
INSERT INTO `role_menu` VALUES ('2336', '6', '154');
INSERT INTO `role_menu` VALUES ('2335', '6', '153');
INSERT INTO `role_menu` VALUES ('2334', '6', '152');
INSERT INTO `role_menu` VALUES ('2333', '6', '123');
INSERT INTO `role_menu` VALUES ('2332', '6', '104');
INSERT INTO `role_menu` VALUES ('2331', '6', '103');
INSERT INTO `role_menu` VALUES ('2330', '6', '120');
INSERT INTO `role_menu` VALUES ('2329', '6', '99');
INSERT INTO `role_menu` VALUES ('2328', '6', '98');
INSERT INTO `role_menu` VALUES ('2327', '6', '56');
INSERT INTO `role_menu` VALUES ('2326', '6', '55');
INSERT INTO `role_menu` VALUES ('2325', '6', '54');
INSERT INTO `role_menu` VALUES ('2324', '6', '53');
INSERT INTO `role_menu` VALUES ('2323', '6', '26');
INSERT INTO `role_menu` VALUES ('2322', '6', '33');
INSERT INTO `role_menu` VALUES ('2321', '6', '32');
INSERT INTO `role_menu` VALUES ('2320', '6', '31');
INSERT INTO `role_menu` VALUES ('2319', '6', '30');
INSERT INTO `role_menu` VALUES ('2318', '6', '27');
INSERT INTO `role_menu` VALUES ('2317', '6', '9');
INSERT INTO `role_menu` VALUES ('2316', '6', '71');
INSERT INTO `role_menu` VALUES ('2315', '6', '70');
INSERT INTO `role_menu` VALUES ('2314', '6', '69');
INSERT INTO `role_menu` VALUES ('2313', '6', '68');
INSERT INTO `role_menu` VALUES ('2312', '6', '62');
INSERT INTO `role_menu` VALUES ('2311', '6', '61');
INSERT INTO `role_menu` VALUES ('2310', '6', '60');
INSERT INTO `role_menu` VALUES ('2309', '6', '59');
INSERT INTO `role_menu` VALUES ('2308', '6', '8');
INSERT INTO `role_menu` VALUES ('2307', '6', '94');
INSERT INTO `role_menu` VALUES ('2306', '6', '93');
INSERT INTO `role_menu` VALUES ('2305', '6', '176');
INSERT INTO `role_menu` VALUES ('2304', '6', '92');
INSERT INTO `role_menu` VALUES ('2303', '6', '175');
INSERT INTO `role_menu` VALUES ('2302', '6', '174');
INSERT INTO `role_menu` VALUES ('2301', '6', '173');
INSERT INTO `role_menu` VALUES ('2300', '6', '172');
INSERT INTO `role_menu` VALUES ('2299', '6', '171');
INSERT INTO `role_menu` VALUES ('2298', '6', '91');
INSERT INTO `role_menu` VALUES ('2297', '6', '170');
INSERT INTO `role_menu` VALUES ('2296', '6', '169');
INSERT INTO `role_menu` VALUES ('2295', '6', '90');
INSERT INTO `role_menu` VALUES ('2294', '6', '168');
INSERT INTO `role_menu` VALUES ('2293', '6', '167');
INSERT INTO `role_menu` VALUES ('2292', '6', '166');
INSERT INTO `role_menu` VALUES ('2291', '6', '165');
INSERT INTO `role_menu` VALUES ('2290', '6', '164');
INSERT INTO `role_menu` VALUES ('1661', '2', '26');
INSERT INTO `role_menu` VALUES ('1660', '2', '33');
INSERT INTO `role_menu` VALUES ('734', '1', '39');
INSERT INTO `role_menu` VALUES ('733', '1', '38');
INSERT INTO `role_menu` VALUES ('732', '1', '43');
INSERT INTO `role_menu` VALUES ('731', '1', '42');
INSERT INTO `role_menu` VALUES ('730', '1', '41');
INSERT INTO `role_menu` VALUES ('729', '1', '37');
INSERT INTO `role_menu` VALUES ('2289', '6', '163');
INSERT INTO `role_menu` VALUES ('2288', '6', '162');
INSERT INTO `role_menu` VALUES ('2287', '6', '89');
INSERT INTO `role_menu` VALUES ('2286', '6', '151');
INSERT INTO `role_menu` VALUES ('2285', '6', '150');
INSERT INTO `role_menu` VALUES ('2284', '6', '149');
INSERT INTO `role_menu` VALUES ('2283', '6', '148');
INSERT INTO `role_menu` VALUES ('2282', '6', '88');
INSERT INTO `role_menu` VALUES ('2281', '6', '147');
INSERT INTO `role_menu` VALUES ('2280', '6', '146');
INSERT INTO `role_menu` VALUES ('1659', '2', '32');
INSERT INTO `role_menu` VALUES ('1658', '2', '31');
INSERT INTO `role_menu` VALUES ('1657', '2', '30');
INSERT INTO `role_menu` VALUES ('1656', '2', '27');
INSERT INTO `role_menu` VALUES ('1655', '2', '9');
INSERT INTO `role_menu` VALUES ('1654', '2', '71');
INSERT INTO `role_menu` VALUES ('1653', '2', '70');
INSERT INTO `role_menu` VALUES ('1652', '2', '69');
INSERT INTO `role_menu` VALUES ('1651', '2', '68');
INSERT INTO `role_menu` VALUES ('1650', '2', '62');
INSERT INTO `role_menu` VALUES ('1649', '2', '61');
INSERT INTO `role_menu` VALUES ('1648', '2', '60');
INSERT INTO `role_menu` VALUES ('1647', '2', '59');
INSERT INTO `role_menu` VALUES ('2279', '6', '145');
INSERT INTO `role_menu` VALUES ('2278', '6', '87');
INSERT INTO `role_menu` VALUES ('2277', '6', '86');
INSERT INTO `role_menu` VALUES ('2276', '6', '143');
INSERT INTO `role_menu` VALUES ('2275', '6', '142');
INSERT INTO `role_menu` VALUES ('2274', '6', '141');
INSERT INTO `role_menu` VALUES ('2273', '6', '140');
INSERT INTO `role_menu` VALUES ('1646', '2', '8');
INSERT INTO `role_menu` VALUES ('1645', '2', '94');
INSERT INTO `role_menu` VALUES ('1644', '2', '93');
INSERT INTO `role_menu` VALUES ('1643', '2', '92');
INSERT INTO `role_menu` VALUES ('1642', '2', '91');
INSERT INTO `role_menu` VALUES ('1641', '2', '90');
INSERT INTO `role_menu` VALUES ('1640', '2', '89');
INSERT INTO `role_menu` VALUES ('1639', '2', '88');
INSERT INTO `role_menu` VALUES ('1638', '2', '87');
INSERT INTO `role_menu` VALUES ('1637', '2', '86');
INSERT INTO `role_menu` VALUES ('1636', '2', '85');
INSERT INTO `role_menu` VALUES ('1635', '2', '84');
INSERT INTO `role_menu` VALUES ('1634', '2', '83');
INSERT INTO `role_menu` VALUES ('1633', '2', '131');
INSERT INTO `role_menu` VALUES ('1632', '2', '122');
INSERT INTO `role_menu` VALUES ('1631', '2', '121');
INSERT INTO `role_menu` VALUES ('1630', '2', '119');
INSERT INTO `role_menu` VALUES ('1629', '2', '82');
INSERT INTO `role_menu` VALUES ('1628', '2', '118');
INSERT INTO `role_menu` VALUES ('1627', '2', '117');
INSERT INTO `role_menu` VALUES ('1626', '2', '114');
INSERT INTO `role_menu` VALUES ('1625', '2', '81');
INSERT INTO `role_menu` VALUES ('1624', '2', '80');
INSERT INTO `role_menu` VALUES ('1623', '2', '79');
INSERT INTO `role_menu` VALUES ('1622', '2', '107');
INSERT INTO `role_menu` VALUES ('1621', '2', '78');
INSERT INTO `role_menu` VALUES ('1620', '2', '7');
INSERT INTO `role_menu` VALUES ('1619', '2', '185');
INSERT INTO `role_menu` VALUES ('1618', '2', '180');
INSERT INTO `role_menu` VALUES ('1617', '2', '179');
INSERT INTO `role_menu` VALUES ('1616', '2', '186');
INSERT INTO `role_menu` VALUES ('1615', '2', '184');
INSERT INTO `role_menu` VALUES ('1614', '2', '183');
INSERT INTO `role_menu` VALUES ('1613', '2', '182');
INSERT INTO `role_menu` VALUES ('1612', '2', '181');
INSERT INTO `role_menu` VALUES ('1611', '2', '178');
INSERT INTO `role_menu` VALUES ('1610', '2', '177');
INSERT INTO `role_menu` VALUES ('1609', '2', '112');
INSERT INTO `role_menu` VALUES ('1608', '2', '111');
INSERT INTO `role_menu` VALUES ('1607', '2', '110');
INSERT INTO `role_menu` VALUES ('1606', '2', '109');
INSERT INTO `role_menu` VALUES ('1605', '2', '113');
INSERT INTO `role_menu` VALUES ('1604', '2', '116');
INSERT INTO `role_menu` VALUES ('1603', '2', '108');
INSERT INTO `role_menu` VALUES ('1602', '2', '75');
INSERT INTO `role_menu` VALUES ('1601', '2', '73');
INSERT INTO `role_menu` VALUES ('1600', '2', '72');
INSERT INTO `role_menu` VALUES ('1599', '2', '49');
INSERT INTO `role_menu` VALUES ('1598', '2', '46');
INSERT INTO `role_menu` VALUES ('1597', '2', '115');
INSERT INTO `role_menu` VALUES ('1596', '2', '44');
INSERT INTO `role_menu` VALUES ('1595', '2', '6');
INSERT INTO `role_menu` VALUES ('1594', '2', '36');
INSERT INTO `role_menu` VALUES ('1593', '2', '35');
INSERT INTO `role_menu` VALUES ('1592', '2', '34');
INSERT INTO `role_menu` VALUES ('1591', '2', '29');
INSERT INTO `role_menu` VALUES ('1590', '2', '28');
INSERT INTO `role_menu` VALUES ('1589', '2', '77');
INSERT INTO `role_menu` VALUES ('1588', '2', '5');
INSERT INTO `role_menu` VALUES ('1587', '2', '52');
INSERT INTO `role_menu` VALUES ('1586', '2', '50');
INSERT INTO `role_menu` VALUES ('1585', '2', '4');
INSERT INTO `role_menu` VALUES ('1584', '2', '48');
INSERT INTO `role_menu` VALUES ('1583', '2', '47');
INSERT INTO `role_menu` VALUES ('1582', '2', '45');
INSERT INTO `role_menu` VALUES ('1581', '2', '3');
INSERT INTO `role_menu` VALUES ('1580', '2', '40');
INSERT INTO `role_menu` VALUES ('1579', '2', '39');
INSERT INTO `role_menu` VALUES ('1578', '2', '38');
INSERT INTO `role_menu` VALUES ('1577', '2', '43');
INSERT INTO `role_menu` VALUES ('1576', '2', '42');
INSERT INTO `role_menu` VALUES ('1575', '2', '41');
INSERT INTO `role_menu` VALUES ('1574', '2', '37');
INSERT INTO `role_menu` VALUES ('1573', '2', '2');
INSERT INTO `role_menu` VALUES ('1572', '2', '1');
INSERT INTO `role_menu` VALUES ('2272', '6', '85');
INSERT INTO `role_menu` VALUES ('2271', '6', '139');
INSERT INTO `role_menu` VALUES ('2270', '6', '138');
INSERT INTO `role_menu` VALUES ('2269', '6', '137');
INSERT INTO `role_menu` VALUES ('2268', '6', '84');
INSERT INTO `role_menu` VALUES ('2267', '6', '83');
INSERT INTO `role_menu` VALUES ('2266', '6', '131');
INSERT INTO `role_menu` VALUES ('2265', '6', '122');
INSERT INTO `role_menu` VALUES ('2264', '6', '121');
INSERT INTO `role_menu` VALUES ('2263', '6', '119');
INSERT INTO `role_menu` VALUES ('2262', '6', '82');
INSERT INTO `role_menu` VALUES ('2261', '6', '118');
INSERT INTO `role_menu` VALUES ('2260', '6', '117');
INSERT INTO `role_menu` VALUES ('2259', '6', '114');
INSERT INTO `role_menu` VALUES ('2258', '6', '81');
INSERT INTO `role_menu` VALUES ('2257', '6', '80');
INSERT INTO `role_menu` VALUES ('2256', '6', '79');
INSERT INTO `role_menu` VALUES ('2255', '6', '107');
INSERT INTO `role_menu` VALUES ('2254', '6', '78');
INSERT INTO `role_menu` VALUES ('2253', '6', '7');
INSERT INTO `role_menu` VALUES ('2252', '6', '185');
INSERT INTO `role_menu` VALUES ('2251', '6', '197');
INSERT INTO `role_menu` VALUES ('2250', '6', '196');
INSERT INTO `role_menu` VALUES ('2249', '6', '180');
INSERT INTO `role_menu` VALUES ('2248', '6', '195');
INSERT INTO `role_menu` VALUES ('2247', '6', '194');
INSERT INTO `role_menu` VALUES ('2246', '6', '179');
INSERT INTO `role_menu` VALUES ('2245', '6', '186');
INSERT INTO `role_menu` VALUES ('2244', '6', '184');
INSERT INTO `role_menu` VALUES ('2243', '6', '183');
INSERT INTO `role_menu` VALUES ('2242', '6', '182');
INSERT INTO `role_menu` VALUES ('2241', '6', '181');
INSERT INTO `role_menu` VALUES ('2240', '6', '178');
INSERT INTO `role_menu` VALUES ('2239', '6', '177');
INSERT INTO `role_menu` VALUES ('2238', '6', '161');
INSERT INTO `role_menu` VALUES ('2237', '6', '160');
INSERT INTO `role_menu` VALUES ('2236', '6', '159');
INSERT INTO `role_menu` VALUES ('2235', '6', '158');
INSERT INTO `role_menu` VALUES ('2234', '6', '157');
INSERT INTO `role_menu` VALUES ('2233', '6', '156');
INSERT INTO `role_menu` VALUES ('2232', '6', '136');
INSERT INTO `role_menu` VALUES ('2231', '6', '135');
INSERT INTO `role_menu` VALUES ('2230', '6', '134');
INSERT INTO `role_menu` VALUES ('2229', '6', '133');
INSERT INTO `role_menu` VALUES ('2228', '6', '132');
INSERT INTO `role_menu` VALUES ('2227', '6', '112');
INSERT INTO `role_menu` VALUES ('2226', '6', '111');
INSERT INTO `role_menu` VALUES ('2225', '6', '110');
INSERT INTO `role_menu` VALUES ('2224', '6', '109');
INSERT INTO `role_menu` VALUES ('2223', '6', '113');
INSERT INTO `role_menu` VALUES ('2222', '6', '116');
INSERT INTO `role_menu` VALUES ('2221', '6', '108');
INSERT INTO `role_menu` VALUES ('2220', '6', '75');
INSERT INTO `role_menu` VALUES ('2219', '6', '73');
INSERT INTO `role_menu` VALUES ('2218', '6', '72');
INSERT INTO `role_menu` VALUES ('2217', '6', '49');
INSERT INTO `role_menu` VALUES ('2216', '6', '46');
INSERT INTO `role_menu` VALUES ('2215', '6', '115');
INSERT INTO `role_menu` VALUES ('2214', '6', '44');
INSERT INTO `role_menu` VALUES ('2213', '6', '207');
INSERT INTO `role_menu` VALUES ('2212', '6', '206');
INSERT INTO `role_menu` VALUES ('2211', '6', '205');
INSERT INTO `role_menu` VALUES ('2210', '6', '208');
INSERT INTO `role_menu` VALUES ('2209', '6', '204');
INSERT INTO `role_menu` VALUES ('2208', '6', '203');
INSERT INTO `role_menu` VALUES ('2207', '6', '202');
INSERT INTO `role_menu` VALUES ('2206', '6', '6');
INSERT INTO `role_menu` VALUES ('2205', '6', '36');
INSERT INTO `role_menu` VALUES ('2204', '6', '35');
INSERT INTO `role_menu` VALUES ('2203', '6', '34');
INSERT INTO `role_menu` VALUES ('2202', '6', '29');
INSERT INTO `role_menu` VALUES ('2201', '6', '28');
INSERT INTO `role_menu` VALUES ('2200', '6', '77');
INSERT INTO `role_menu` VALUES ('2199', '6', '5');
INSERT INTO `role_menu` VALUES ('2198', '6', '52');
INSERT INTO `role_menu` VALUES ('2197', '6', '50');
INSERT INTO `role_menu` VALUES ('2196', '6', '4');
INSERT INTO `role_menu` VALUES ('2195', '6', '48');
INSERT INTO `role_menu` VALUES ('2194', '6', '47');
INSERT INTO `role_menu` VALUES ('2193', '6', '45');
INSERT INTO `role_menu` VALUES ('2192', '6', '3');
INSERT INTO `role_menu` VALUES ('2191', '6', '40');
INSERT INTO `role_menu` VALUES ('2190', '6', '39');
INSERT INTO `role_menu` VALUES ('2189', '6', '38');
INSERT INTO `role_menu` VALUES ('1687', '2', '13');
INSERT INTO `role_menu` VALUES ('1688', '2', '14');
INSERT INTO `role_menu` VALUES ('1689', '2', '15');
INSERT INTO `role_menu` VALUES ('1690', '2', '16');
INSERT INTO `role_menu` VALUES ('2188', '6', '43');
INSERT INTO `role_menu` VALUES ('2187', '6', '42');
INSERT INTO `role_menu` VALUES ('2186', '6', '41');
INSERT INTO `role_menu` VALUES ('2185', '6', '37');
INSERT INTO `role_menu` VALUES ('2184', '6', '2');
INSERT INTO `role_menu` VALUES ('2183', '6', '1');
INSERT INTO `role_menu` VALUES ('2349', '6', '23');
INSERT INTO `role_menu` VALUES ('2350', '6', '24');
INSERT INTO `role_menu` VALUES ('2351', '6', '25');
INSERT INTO `role_menu` VALUES ('2352', '6', '13');
INSERT INTO `role_menu` VALUES ('2353', '6', '14');
INSERT INTO `role_menu` VALUES ('2354', '6', '15');
INSERT INTO `role_menu` VALUES ('2355', '6', '16');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_jl
-- ----------------------------
INSERT INTO `study_jl` VALUES ('1', '试卷一', '2016-05-31 11:11:11', '马云', '机构一', '1', '2016-05-31 11:11:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_sj
-- ----------------------------
INSERT INTO `study_sj` VALUES ('68', '数学试卷', '科室一,科室二,科室四,科室五,科室六,科室七,科室三,王,地方,', '10%', '2016-05-31 00:00:00', '2016-06-01 00:00:00', '0', '崔俊', '30', '30', '93,94,1,57');
INSERT INTO `study_sj` VALUES ('69', '语文试卷', '科室五,', '50%', '2016-05-31 00:00:00', '2016-05-31 00:00:00', '2', '崔俊', '30', '30', '94,1,57,93');
INSERT INTO `study_sj` VALUES ('70', '地理试卷', '科室四,', '10%', '2016-05-30 00:00:00', '2016-06-02 00:00:00', '0', '崔俊', '20', '20', '94,57,1,93');
INSERT INTO `study_sj` VALUES ('71', '测试试卷', '科室一,科室六,', '40%', '2016-05-11 00:00:00', '2016-05-18 00:00:00', '2', '崔俊', '30', '30', '93,94,57,1');
INSERT INTO `study_sj` VALUES ('72', '爱情试卷', '科室六,', '10%', '2016-05-31 00:00:00', '2016-05-31 00:00:00', '2', '崔俊', '30', '30', '57,93,1,94');
INSERT INTO `study_sj` VALUES ('73', '物理地理全能', '科室一,科室二,科室四,科室五,科室六,科室七,科室三,王,地方,', '10%', '2016-05-30 00:00:00', '2016-06-01 00:00:00', '0', '崔俊', '30', '30', '94,1,95,93,57');
INSERT INTO `study_sj` VALUES ('74', '混杂试卷', '科室一,科室二,科室四,科室五,科室六,科室七,科室三,王,地方,', '30%', '2016-05-30 00:00:00', '2016-06-02 00:00:00', '0', '崔俊', '30', '20', '57,94,1,95,93');
INSERT INTO `study_sj` VALUES ('75', '111111111', '科室一,科室二,科室四,科室五,科室六,科室七,科室三,王,地方,', '10%', '1901-03-06 00:00:00', '2016-06-29 00:00:00', '0', '崔俊', '30', '30', '133,119,1,130,129,132,95,118,94,57,93,100');

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
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study_tk
-- ----------------------------
INSERT INTO `study_tk` VALUES ('1', '完美世界 我欲战苍天111', '崔俊11', '2016-05-29 09:17:39', '{\"A\":\"11111\",\"B\":\"\\u5b8c\\u7f8e\\u4e16\\u754c2\",\"C\":\"\\u5b8c\\u7f8e\\u4e16\\u754c3\",\"D\":\"111111111\"}', 'C', '完美世界 征战的世界 谁人能懂', '1');
INSERT INTO `study_tk` VALUES ('57', '钱浩浩', '崔俊11', '2016-05-29 09:17:03', '{\"A\":\"111111\",\"B\":\"22222\",\"C\":\"33333\"}', 'A', '钱浩浩', '1');
INSERT INTO `study_tk` VALUES ('130', '11', '崔俊', '2016-06-01 11:23:38', '{\"A\":\"11\",\"B\":\"22\",\"C\":\"\",\"D\":\"\"}', 'B', '11', '1');
INSERT INTO `study_tk` VALUES ('133', '气温气温气温', '崔俊', '2016-06-01 07:09:26', '{\"A\":\"1111\",\"B\":\"1111111111\",\"C\":\"11111111111\",\"D\":\"11111111111111111\"}', 'A', '11111111111', '1');
INSERT INTO `study_tk` VALUES ('118', '王子的新衣', '崔俊', '2016-05-31 05:56:46', '{\"A\":\"1111111\",\"B\":\"222222222\",\"C\":\"\",\"D\":\"\"}', 'A', '什么的世界没有一点点东西', '1');
INSERT INTO `study_tk` VALUES ('132', '111111', '崔俊', '2016-06-01 07:08:59', '{\"A\":\"11111111111\",\"B\":\"1111111111\",\"C\":\"1111111111\",\"D\":\"11111111111\"}', 'A', '11111111111111111111', '1');
INSERT INTO `study_tk` VALUES ('129', '22222222', '崔俊', '2016-06-01 11:09:46', '{\"A\":\"11111111111111\",\"B\":\"111111111111111111111111\",\"C\":\"\",\"D\":\"\"}', 'B', '22222222222222', '1');
INSERT INTO `study_tk` VALUES ('100', '爱情三十六计11111111111111111111111111', '崔俊', '2016-05-31 03:20:44', '{\"A\":\"11111111\",\"B\":\"2222222222\",\"C\":\"333333333333\",\"D\":\"333333333333\"}', 'A', '', '1');
INSERT INTO `study_tk` VALUES ('119', '1111111', '崔俊', '2016-05-31 06:13:12', '{\"A\":\"1\",\"B\":\"1\",\"C\":\"\",\"D\":\"\"}', 'A', '11213123123123131312请二位二位二位问问我让我无法水电费水电费水电费水电费水电费水电费发送到发送到', '1');
INSERT INTO `study_tk` VALUES ('95', '爱情三十六计', '崔俊', '2016-05-31 01:42:59', '{\"A\":\"\\u8c01\\u4e0d\\u77e5\\u9053\\u8c01\\u662f\\u8c01\\u7684\\u8c01\",\"B\":\"\\u50cf\\u75af\\u4e86\\u4e00\\u6837\",\"C\":\" \\u71c3\\u70e7\\u7fc5\\u8180\",\"D\":\"4444444444444\"}', 'C', '我不知道接下来要做什么   只是不知道该怎么办', '1');
INSERT INTO `study_tk` VALUES ('94', '数学问答1+1', '崔俊11', '2016-05-31 10:25:35', '{\"A\":\"\\u7b49\\u4e8e1\",\"B\":\"\\u7b49\\u4e8e2\",\"C\":\"\\u7b49\\u4e8e3\",\"D\":\"\\u7b49\\u4e8e4\"}', 'B', '  这个题目的关键性 是要对数学有一定的了解', '1');
INSERT INTO `study_tk` VALUES ('93', '爱情三十六计', '崔俊11', '2016-05-31 10:02:52', '{\"A\":\"111111111111111\",\"B\":\"1222222222222\",\"C\":\"23333333333333\",\"D\":\"44444444444\"}', 'A', '爱情是让人捉摸不透的东西', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 COMMENT='差旅费报销申请表单';

-- ----------------------------
-- Records of travel
-- ----------------------------
INSERT INTO `travel` VALUES ('4', '2', '2016-05-28 17:10:54', '2016-04-30', '2016-05-21', '222', '1221', '50', '1', '50', '1', '50', '1', '50', '200', '8', '审批', '0', '1', '崔俊11', null, '1', null, '0', '1', '崔俊11', null, '1', null, '0', '1', '崔俊11', null, '1', null, '0');
INSERT INTO `travel` VALUES ('5', '4', '2016-05-29 09:01:36', '2016-05-29', '2016-05-31', '人民大会堂', '开会', '100', '10', '500', '10', '500', '5', '2000', '10500', '1', '崔俊11', '1', '2', '崔俊', '2016-05-29 09:22:56', '1', null, '1', '13', 'xubaobao', '2016-05-29 09:23:03', '1', null, '0', '8', '审批', '2016-05-29 09:16:01', '2', '121', '1');
INSERT INTO `travel` VALUES ('131', '1', '2016-05-30 05:15:36', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('132', '1', '2016-05-30 07:53:23', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('133', '1', '2016-05-31 09:02:50', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('134', '1', '2016-05-31 09:03:03', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('135', '1', '2016-05-31 09:03:04', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('136', '1', '2016-05-31 09:03:11', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('137', '1', '2016-05-31 09:03:21', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('138', '1', '2016-05-31 09:03:22', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('139', '1', '2016-05-31 09:03:34', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('140', '1', '2016-05-31 09:03:34', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('141', '1', '2016-05-31 13:30:41', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('142', '1', '2016-05-31 13:39:42', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('143', '1', '2016-05-31 13:39:43', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('144', '1', '2016-05-31 13:39:43', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('145', '1', '2016-05-31 13:39:43', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('146', '1', '2016-05-31 13:39:43', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('147', '1', '2016-05-31 13:39:44', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('148', '1', '2016-05-31 13:40:17', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('149', '1', '2016-05-31 13:40:17', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('150', '1', '2016-05-31 13:40:17', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('151', '1', '2016-05-31 13:40:21', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('152', '1', '2016-05-31 13:40:22', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');
INSERT INTO `travel` VALUES ('153', '1', '2016-05-31 13:40:22', '2016-05-26', '2016-05-29', '南京', '事由事由事由事由事由事由', '2', '500', '2', '500', '1', '33', '121', '832', '1', '', '1', '1', '我是证明人，证明人证明人证明人证明人', null, '0', null, '1', '1', '张超', null, '0', null, '1', '1', '张领导', null, '0', null, '1');

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
  `position` int(11) DEFAULT NULL,
  `telphone` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '电话号码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '崔俊', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$24ILXZNwa/y6p6NX/35X6Oube8gnZQ1fZgKnIUmRKw5P/dpBV5bQK', '0', 'admin@qq.com', '10', '1454403070', '1464777731', '1464777731', '127.0.0.1', '5', '22222', '001', null, '12345678974');
INSERT INTO `user` VALUES ('2', 'cuijun', '崔俊11', 'fUwgiWl7rKRZkibw4D4xEQ-zqeWw_0lb', '$2y$13$QDrNi9A8u25M7tvQBUYsAOGUDx5JX5h9LyioLHkH7BqYRHKYd0Vta', null, '1111@qq.com', '10', '1457681052', '1464483986', '1464483986', '127.0.0.1', '3', '11111', '117', null, '');
INSERT INTO `user` VALUES ('8', 'shenpi', '审批', '4BNN9RXTprCVX7V8vModU1jFuDaHb9ag', '$2y$13$pcpTm9QLP9uuxks.wJz69.LR2p5vjqXMxed2hX9aobW1mMmbDgC5u', null, null, '10', '1463727983', '1464598458', '1464598458', '127.0.0.1', '3', '33333', '003', null, '');
INSERT INTO `user` VALUES ('9', 'shenpi2', '审批2', 'jbqz7M0aRInIWkUrKu9yXgDYDBDn5yL4', '$2y$13$UC6ofS7MByLMQ.HrwJ0lx.Y4bplwYQXOEJAghG4hbq2ekN6Yk6m8m', null, null, '10', '1464002578', '1464002588', null, '', '1', '44444', '004', null, '');
INSERT INTO `user` VALUES ('10', 'shenpi3', '审批3', 'oOys6wPtzLCApRVqMJY0Fhur21i608l7', '$2y$13$zkN466vsbXVj/YK9DEA1M.OAUyN.w38Ng58bIFT4GBjnJkgKNh0gG', null, null, '10', '1464002610', '1464002650', null, '', '1', '55555', '005', null, '');
INSERT INTO `user` VALUES ('11', 'shenpi4', '审批4', 'ueYVph4HqWJPAI-75XI0lyy6Im83Z1kE', '$2y$13$FLHh7rGzq9Id5iFjUn01c.fPY3kyOoJstxcQsDkTRnQ61soT2QXXy', null, null, '10', '1464002672', '1464002672', null, '', '1', '66666', '006', null, '');
INSERT INTO `user` VALUES ('12', 'shouli', '崔俊', 'EwhzPTK-9m5NPwgYr63p8wfg2Rx7knsk', '$2y$13$qfoPJm7yrVcOIw5XQENd1Oh7I6G7wZ.sUOpcTTTZjE0/5jgo7C5bi', null, null, '10', '1464004917', '1464169584', null, '', '1', '77777', '007', null, '');
INSERT INTO `user` VALUES ('13', 'xubaobao', 'xubaobao', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464139950', '1464769632', '1464769632', '127.0.0.1', '1', '88888', '008', '6', '');
INSERT INTO `user` VALUES ('14', 'baobao1', 'baobao1', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464762411', '1464762411', '127.0.0.1', '1', '99991', '009', '6', '');
INSERT INTO `user` VALUES ('15', 'baobao2', 'baobao2', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464762372', '1464762372', '127.0.0.1', '1', '99992', '010', '6', '');
INSERT INTO `user` VALUES ('16', 'baobao3', 'baobao3', 'inDYUOvC_fkw8iDKkov4hg59Y-zN5PuS', '$2y$13$TNJA/Xvy2vXQSffvEBUNbeN/sZjtkndH3WDrRIrxnjllrr.6xrUPa', null, null, '10', '1464315570', '1464673458', '1464673458', '127.0.0.1', '1', '99993', '011', '6', '');
INSERT INTO `user` VALUES ('17', '11111', '王雪', 'X76tw5mtH2IBt818RhJglJRB26uh9SjK', '$2y$13$qCZ9Qp7rqQNOeeDSpssQleiZTL.aAZ/y0GMqt6iasiLdJQiDhHyqy', null, null, '10', '1464503220', '1464575386', '1464575386', '127.0.0.1', '0', '65651', '022', null, '');

-- ----------------------------
-- Table structure for vehicle
-- ----------------------------
DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v_usage` varchar(100) NOT NULL DEFAULT '04执法执勤用车(一般)' COMMENT '车辆用途',
  `dept` varchar(50) NOT NULL DEFAULT '闽侯县人民检察院' COMMENT '单位',
  `code_no` varchar(20) NOT NULL DEFAULT '003606526' COMMENT '组织机构代码证',
  `v_license` varchar(20) NOT NULL COMMENT '车牌号',
  `regist_no` varchar(20) NOT NULL COMMENT '机动车登记证书编号',
  `regist_date` date NOT NULL COMMENT '车辆登记日期',
  `v_type` int(11) NOT NULL COMMENT '汽车分类',
  `xinghao` varchar(50) NOT NULL COMMENT '规格型号',
  `pailiang` varchar(5) NOT NULL COMMENT '排量',
  `count` tinyint(2) NOT NULL DEFAULT '1' COMMENT '数量（只能1和0）',
  `money` float NOT NULL COMMENT '金额',
  `audit` varchar(50) NOT NULL DEFAULT '高检警堪字NO:0021797' COMMENT '省控办批审情况',
  `isdelete` tinyint(2) NOT NULL COMMENT '0未删除，1删除',
  `isreturn` tinyint(2) NOT NULL COMMENT '0未还，1已还',
  `return_time` datetime DEFAULT NULL COMMENT '还车时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='车辆表';

-- ----------------------------
-- Records of vehicle
-- ----------------------------
INSERT INTO `vehicle` VALUES ('1', '04执法执勤用车(一般)', '闽侯县人民检察院', '003606526', '闽A B132警', '1202222221', '2016-05-30', '1', '上海桑塔纳SVW7182LFJ', '1.8', '1', '12.5', '高检警堪字NO:0021797', '0', '1', null);
INSERT INTO `vehicle` VALUES ('2', '04执法执勤用车(一般)', '闽侯县人民检察院', '003606526', '闽A C251警', '0222221115', '2016-05-30', '2', '别克VSDSD', '1.8', '0', '25', '高检警堪字NO:0021797', '0', '0', null);
INSERT INTO `vehicle` VALUES ('3', '04执法执勤用车(一般)', '闽侯县人民检察院', '003606526', '闽A B521警', '2122322545', '2016-05-31', '1', '福特021DR', '2.0', '1', '25', '高检警堪字NO:0021797', '0', '1', '2016-05-31 16:34:31');
INSERT INTO `vehicle` VALUES ('9', '04执法执勤用车(一般)', '闽侯县人民检察院', '003606526', '', '', '0000-00-00', '5', '', '', '1', '0', '高检警堪字NO:0021797', '1', '0', null);
INSERT INTO `vehicle` VALUES ('10', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AB132警', '350001447780', '2004-07-05', '1', '上海桑塔纳SVW7182LFJ', '1.8', '1', '19.32', '高检警堪字NO：0021797', '0', '1', null);
INSERT INTO `vehicle` VALUES ('11', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AB133警', '350001447781', '2004-07-05', '1', '上海桑塔纳SVW7182LFJ', '1.8', '1', '19.32', '高检警堪字NO：0021796', '0', '1', null);
INSERT INTO `vehicle` VALUES ('12', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽A6A731', '350001449076', '2005-04-27', '1', '风神牌EO7200D', '2.0', '1', '19.76', '高检警堪字NO：0031605', '0', '1', null);
INSERT INTO `vehicle` VALUES ('13', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽A69366', '350001886679', '2005-04-27', '1', '东南DN7160', '1.6', '1', '11.29', '省控第NO：05002012', '0', '1', null);
INSERT INTO `vehicle` VALUES ('14', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AB135警', '350002066227', '0000-00-00', '1', '上海桑塔纳SVW7180CEI', '1.8', '1', '10.55', '高检警堪字NO：0041776', '0', '1', null);
INSERT INTO `vehicle` VALUES ('15', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽A6C672', '350003706375', '2039-05-07', '1', '蒙迪欧牌CAF7200AC3', '2.0', '1', '18.82', '高检计装字第047号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('16', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7582', '350003888699', '0000-00-00', '3', '思威牌DHW6463CCR-V', '2.4', '1', '25.13', '高检计装字第010号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('17', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7589', '350003899630', '0000-00-00', '1', '上海桑塔纳SVW7180OLE1', '1.8', '1', '8.77', '高检计装字第012号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('18', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF6901', '350004653262', '0000-00-00', '1', '三菱牌DN7243H', '2.4', '1', '21.69', '高检计装字第016号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('19', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7301', '350004736891', '0000-00-00', '1', '别克牌SCM7205ATA', '2.0', '1', '20.63', '高检计装字第002号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('20', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7322', '350004736871', '0000-00-00', '1', '别克牌SCM7205ATA', '2.0', '1', '20.63', '高检计装字第002号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('21', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7330', '350004736883', '0000-00-00', '1', '别克牌SCM7205ATA', '2.0', '1', '20.63', '高检计装字第002号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('22', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7338', '350004736929', '0000-00-00', '1', '奥德赛牌SCM7205ATA', '2.4', '1', '25.51', '高检计装字第001号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('23', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AB168警', '350002464035', '0000-00-00', '1', '三菱牌DN7160H4B', '1.6', '1', '9.57', '高检警堪字NO：0044612', '0', '1', null);
INSERT INTO `vehicle` VALUES ('24', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF7887', '350006177995', '0000-00-00', '3', '福特牌CAF6480A', '2.3', '1', '21.75', '高检计装字第051号', '0', '1', null);
INSERT INTO `vehicle` VALUES ('25', '04执法执勤用车（一般）', '闽侯县人民检察院', '003606526', '闽AF9585', '350010085153', '0000-00-00', '3', '别克牌SGM6531UAAA', '2.4', '1', '29.86', '省控第NO：201400933', '0', '1', null);

-- ----------------------------
-- Table structure for vehicle_apply
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_apply`;
CREATE TABLE `vehicle_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleid` int(11) NOT NULL COMMENT '车辆id',
  `dept` int(11) NOT NULL COMMENT '科室',
  `v_user` varchar(50) NOT NULL COMMENT '用车人',
  `driver` varchar(50) NOT NULL COMMENT '驾驶员',
  `use_time` datetime NOT NULL COMMENT '用车时间',
  `quxiang` varchar(100) NOT NULL COMMENT '去向',
  `reason` text NOT NULL COMMENT '用车是由',
  `dept_leader` int(11) NOT NULL COMMENT '科室领导',
  `dept_audit` int(3) NOT NULL DEFAULT '0' COMMENT '科室审核状态',
  `dept_audit_time` datetime DEFAULT NULL COMMENT '科室负责人审核时间',
  `dept_reason` varchar(300) DEFAULT NULL COMMENT '驳回理由',
  `branch_leader` int(11) NOT NULL COMMENT '分管领导',
  `branch_audit` int(3) NOT NULL DEFAULT '0',
  `branch_audit_time` datetime DEFAULT NULL,
  `branch_reason` varchar(300) DEFAULT NULL,
  `apply_delete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '申请人是否删除',
  `dept_delete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '部门审核是否删除',
  `branch_delete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '分管审核是否删除',
  `apply_ren` int(11) NOT NULL COMMENT '申请人',
  `apply_time` datetime NOT NULL COMMENT '申请时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='车辆申请表';

-- ----------------------------
-- Records of vehicle_apply
-- ----------------------------
INSERT INTO `vehicle_apply` VALUES ('1', '1', '1', '1', '李四', '2016-05-18 00:00:00', '去掉', '执法', '13', '1', '2016-05-31 13:28:57', null, '15', '2', '2016-05-31 13:29:22', '不过', '0', '0', '0', '1', '2016-05-31 09:42:14');
INSERT INTO `vehicle_apply` VALUES ('3', '3', '1', '1', '刘三', '2016-05-12 00:00:00', '法院', '执法', '13', '2', '2016-05-31 13:34:41', '没有', '15', '0', null, null, '1', '0', '0', '1', '2016-05-31 13:33:36');
INSERT INTO `vehicle_apply` VALUES ('4', '3', '1', '1', '李四', '2016-05-31 00:00:00', '法院', '执法', '15', '0', null, null, '16', '0', null, null, '0', '0', '0', '1', '2016-05-31 13:42:10');
INSERT INTO `vehicle_apply` VALUES ('5', '2', '5', '1', '驾驶员', '2016-05-31 00:00:00', '去向', '用车事由', '2', '2', '2016-05-31 17:31:14', '院领导返驳原因', '8', '0', null, null, '0', '1', '0', '0', '2016-05-31 14:13:35');

-- ----------------------------
-- Table structure for vehicle_type
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_type`;
CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '汽车分类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='汽车类型表';

-- ----------------------------
-- Records of vehicle_type
-- ----------------------------
INSERT INTO `vehicle_type` VALUES ('1', '小轿车');
INSERT INTO `vehicle_type` VALUES ('2', '小轿车（进口）');
INSERT INTO `vehicle_type` VALUES ('3', '旅行车');
INSERT INTO `vehicle_type` VALUES ('4', '旅行车（进口）');
INSERT INTO `vehicle_type` VALUES ('5', '吉普车');
INSERT INTO `vehicle_type` VALUES ('6', '吉普车（进口）');
INSERT INTO `vehicle_type` VALUES ('7', '中巴');
INSERT INTO `vehicle_type` VALUES ('8', '大巴');
INSERT INTO `vehicle_type` VALUES ('9', '其他');

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
  `welfare_id` int(11) NOT NULL AUTO_INCREMENT,
  `welfare_name` varchar(20) NOT NULL COMMENT '福利名称',
  `welfare_type` varchar(20) NOT NULL COMMENT '福利类型',
  `welfare_start_time` datetime NOT NULL COMMENT '开始时间',
  `welfare_end_time` datetime NOT NULL COMMENT '结束时间',
  `welfare_part_id` varchar(100) NOT NULL COMMENT '适用机构ID，每个ID用英文“，”隔开,例如：1,2,34 ',
  `welfare_part_name` varchar(20) NOT NULL COMMENT '适用机构名称,冗余字段,用英文“，”隔开,例如：机构1,机构二',
  `welfare_detail` text NOT NULL COMMENT '福利详细',
  `welfare_is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  PRIMARY KEY (`welfare_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='福利表';

-- ----------------------------
-- Records of welfare
-- ----------------------------
INSERT INTO `welfare` VALUES ('1', '优秀新人奖', '辅助性福利', '2016-05-29 10:36:35', '2016-07-15 10:36:41', '1,2,3', '机构1,机构二', '福利详细福利详细福利详细福利详细', '1');
INSERT INTO `welfare` VALUES ('2', '中秋福利', '节日', '2016-05-30 00:00:00', '2016-06-17 00:00:00', '1,2,3,5,24', '科室一,科室二,科室三,科室五,王', '中秋福利中秋福利中秋福利中秋福利', '1');
INSERT INTO `welfare` VALUES ('3', '公休假', '公休假', '2016-05-18 00:00:00', '2016-05-12 00:00:00', '7,24,25', '科室七,王,地方', '唉唉唉唉唉唉唉唉唉唉唉唉唉唉唉唉唉', '1');

-- ----------------------------
-- Table structure for welfare_apply
-- ----------------------------
DROP TABLE IF EXISTS `welfare_apply`;
CREATE TABLE `welfare_apply` (
  `welfare_apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `welfare_id` int(11) NOT NULL COMMENT '关联id',
  `welfare_name` varchar(200) NOT NULL COMMENT '福利名称',
  `welfare_apply_mee_id` int(11) NOT NULL COMMENT '申请人账号ID',
  `welfare_apply_mee_name` varchar(200) NOT NULL COMMENT '申请人账号',
  `welfare_apply_mee_id_is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  `welfare_sp_id` int(11) NOT NULL COMMENT '审批人id',
  `welfare_sp_name` varchar(200) NOT NULL COMMENT '审批人',
  `welfare_sp_id_is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除 1:否 0:是',
  `welfare_apply_pack_status` enum('审批中','驳回','同意') NOT NULL DEFAULT '审批中' COMMENT '审批人状态，是否同意，默认为0，同意为1',
  `welfare_apply_pack_cancel_detail` text COMMENT '驳回详情',
  `welfare_apply_pack_time` datetime DEFAULT NULL COMMENT '处理时间',
  `welfare_lq` enum('未领取','已领取') NOT NULL DEFAULT '未领取' COMMENT '是否领取',
  `welfare_sq_time` datetime NOT NULL COMMENT '申请时间',
  `welfare_lq_time` datetime DEFAULT NULL COMMENT '领取时间',
  `welfare_department` int(11) NOT NULL COMMENT '机构',
  PRIMARY KEY (`welfare_apply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='福利领取详细表';

-- ----------------------------
-- Records of welfare_apply
-- ----------------------------
INSERT INTO `welfare_apply` VALUES ('6', '1', '优秀新人奖', '1', '崔俊', '0', '1', 'xubaobao', '1', '同意', '6666', '2016-05-30 16:44:18', '已领取', '2016-05-30 15:36:04', '2016-05-30 16:52:17', '5');
INSERT INTO `welfare_apply` VALUES ('7', '2', '中秋福利', '1', '崔俊11', '1', '8', '审批', '1', '同意', null, '2016-05-30 16:54:27', '未领取', '2016-05-30 16:52:45', null, '5');

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxjxgl
-- ----------------------------
INSERT INTO `xxjxgl` VALUES ('1', '钱浩浩', '遵守法律法规', '崔俊11', '2016-05-11 06:43:16', '海贼王', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160526/1464259396_198.doc');
INSERT INTO `xxjxgl` VALUES ('40', '222222', '22222222222222222222222222', '崔俊', '2016-06-01 07:07:44', '2222222222222', '');
INSERT INTO `xxjxgl` VALUES ('42', '111111111111111', '1111111111111111', '崔俊', '2016-06-01 07:25:39', '111111111111', 'D:\\xampp\\htdocs\\www\\ydbg/backend/web/upload/xxjxgl/20160601/2016.5.16Ǯ?ƺƹ????ձ?.doc');
INSERT INTO `xxjxgl` VALUES ('43', '1111111111111111111111111111', '111111111111111111', '崔俊', '2016-06-01 07:26:16', '1111111111', '');
INSERT INTO `xxjxgl` VALUES ('44', '诚挚称职从自行车自行车', '111111111111111111111111', '崔俊', '2016-06-01 07:41:06', '<p>111111111111111111111111111111111111111111111<br/></p>', '');
