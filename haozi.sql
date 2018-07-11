/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : haozi

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-07-11 16:39:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hwh_admin`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_admin`;
CREATE TABLE `hwh_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(30) NOT NULL COMMENT '管理员',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(30) DEFAULT NULL COMMENT '昵称',
  `img` varchar(255) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台管理员表';

-- ----------------------------
-- Records of hwh_admin
-- ----------------------------
INSERT INTO `hwh_admin` VALUES ('1', 'haozi', '5d14438a7c70719dc20a764ac92072b3', '哎哟大文豪', 'http://haozi.com.cn/Public/Uploads/admin/1492595622_325040_58f733a6470cb.jpg');

-- ----------------------------
-- Table structure for `hwh_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_admin_log`;
CREATE TABLE `hwh_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `admin_id` int(11) DEFAULT NULL COMMENT '管理员ID',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(255) DEFAULT NULL COMMENT '登录IP地址',
  `type` tinyint(1) DEFAULT '1' COMMENT '状态 1登录 2修改密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='后台管理员登录日志表';

-- ----------------------------
-- Records of hwh_admin_log
-- ----------------------------
INSERT INTO `hwh_admin_log` VALUES ('1', '1', '2017-05-18 11:04:57', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('2', '1', '2017-05-26 11:10:12', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('3', '1', '2017-06-19 15:33:43', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('4', '1', '2017-08-01 16:34:38', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('5', '1', '2017-08-07 11:02:39', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('6', '1', '2017-08-09 10:21:38', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('7', '1', '2017-08-11 16:11:03', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('8', '1', '2017-08-21 15:06:31', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('9', '1', '2017-11-10 16:14:32', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('10', '1', '2017-11-11 09:19:08', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('11', '1', '2017-11-13 09:47:00', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('12', '1', '2017-11-14 14:49:09', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('13', '1', '2017-11-28 16:39:59', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('14', '1', '2017-11-29 09:39:37', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('15', '1', '2017-12-04 09:25:09', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('16', '1', '2018-01-04 11:46:13', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('17', '1', '2018-01-11 15:10:13', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('18', '1', '2018-01-12 09:51:06', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('19', '1', '2018-01-24 15:36:13', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('20', '1', '2018-02-07 15:08:15', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('21', '1', '2018-03-27 11:09:45', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('22', '1', '2018-04-25 15:16:58', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('23', '1', '2018-04-26 17:33:17', '127.0.0.1', '1');
INSERT INTO `hwh_admin_log` VALUES ('24', '1', '2018-05-16 10:55:16', '127.0.0.1', '1');

-- ----------------------------
-- Table structure for `hwh_area`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_area`;
CREATE TABLE `hwh_area` (
  `id` bigint(20) NOT NULL COMMENT '主键_id',
  `full_name` longtext COMMENT '全称',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `tree_path` varchar(255) DEFAULT NULL COMMENT '树路径',
  `parent_id` bigint(20) DEFAULT NULL COMMENT '上级地区',
  `orders` int(11) DEFAULT NULL COMMENT '排序',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `updated` datetime DEFAULT NULL COMMENT '最后修改日期',
  `active` bit(1) NOT NULL DEFAULT b'0' COMMENT '删除标记',
  PRIMARY KEY (`id`),
  KEY `FK9E19DA6CFE1E12FB` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
-- Records of hwh_area
-- ----------------------------
INSERT INTO `hwh_area` VALUES ('1', '北京市', '北京市', ',', null, null, null, '2016-09-29 17:54:22', '');
INSERT INTO `hwh_area` VALUES ('4', '北京市朝阳区', '朝阳区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('5', '北京市丰台区', '丰台区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('6', '北京市石景山区', '石景山区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('7', '北京市海淀区', '海淀区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('8', '北京市门头沟区', '门头沟区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('9', '北京市房山区', '房山区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('10', '北京市通州区', '通州区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('11', '北京市顺义区', '顺义区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('12', '北京市昌平区', '昌平区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('13', '北京市大兴区', '大兴区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('14', '北京市怀柔区', '怀柔区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('15', '北京市平谷区', '平谷区', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('16', '北京市密云县', '密云县', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('17', '北京市延庆县', '延庆县', ',1,', '1', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('18', '天津市', '天津市', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('19', '天津市和平区', '和平区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('20', '天津市河东区', '河东区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('21', '天津市河西区', '河西区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('22', '天津市南开区', '南开区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('23', '天津市河北区', '河北区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('24', '天津市红桥区', '红桥区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('25', '天津市东丽区', '东丽区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('26', '天津市西青区', '西青区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('27', '天津市津南区', '津南区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('28', '天津市北辰区', '北辰区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('29', '天津市武清区', '武清区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('30', '天津市宝坻区', '宝坻区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('31', '天津市滨海新区', '滨海新区', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('32', '天津市宁河县', '宁河县', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('33', '天津市静海县', '静海县', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('34', '天津市蓟县', '蓟县', ',18,', '18', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('35', '河北省', '河北省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('36', '河北省石家庄市', '石家庄市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('37', '河北省石家庄市长安区', '长安区', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('38', '河北省石家庄市桥东区', '桥东区', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('39', '河北省石家庄市桥西区', '桥西区', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('40', '河北省石家庄市新华区', '新华区', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('41', '河北省石家庄市井陉矿区', '井陉矿区', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('42', '河北省石家庄市裕华区', '裕华区', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('43', '河北省石家庄市井陉县', '井陉县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('44', '河北省石家庄市正定县', '正定县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('45', '河北省石家庄市栾城县', '栾城县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('46', '河北省石家庄市行唐县', '行唐县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('47', '河北省石家庄市灵寿县', '灵寿县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('48', '河北省石家庄市高邑县', '高邑县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('49', '河北省石家庄市深泽县', '深泽县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('50', '河北省石家庄市赞皇县', '赞皇县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('51', '河北省石家庄市无极县', '无极县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('52', '河北省石家庄市平山县', '平山县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('53', '河北省石家庄市元氏县', '元氏县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('54', '河北省石家庄市赵县', '赵县', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('55', '河北省石家庄市辛集市', '辛集市', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('56', '河北省石家庄市藁城市', '藁城市', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('57', '河北省石家庄市晋州市', '晋州市', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('58', '河北省石家庄市新乐市', '新乐市', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('59', '河北省石家庄市鹿泉市', '鹿泉市', ',35,36,', '36', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('60', '河北省唐山市', '唐山市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('61', '河北省唐山市路南区', '路南区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('62', '河北省唐山市路北区', '路北区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('63', '河北省唐山市古冶区', '古冶区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('64', '河北省唐山市开平区', '开平区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('65', '河北省唐山市丰南区', '丰南区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('66', '河北省唐山市丰润区', '丰润区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('67', '河北省唐山市曹妃甸区', '曹妃甸区', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('68', '河北省唐山市滦县', '滦县', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('69', '河北省唐山市滦南县', '滦南县', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('70', '河北省唐山市乐亭县', '乐亭县', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('71', '河北省唐山市迁西县', '迁西县', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('72', '河北省唐山市玉田县', '玉田县', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('73', '河北省唐山市遵化市', '遵化市', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('74', '河北省唐山市迁安市', '迁安市', ',35,60,', '60', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('75', '河北省秦皇岛市', '秦皇岛市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('76', '河北省秦皇岛市海港区', '海港区', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('77', '河北省秦皇岛市山海关区', '山海关区', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('78', '河北省秦皇岛市北戴河区', '北戴河区', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('79', '河北省秦皇岛市青龙满族自治县', '青龙满族自治县', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('80', '河北省秦皇岛市昌黎县', '昌黎县', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('81', '河北省秦皇岛市抚宁县', '抚宁县', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('82', '河北省秦皇岛市卢龙县', '卢龙县', ',35,75,', '75', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('83', '河北省邯郸市', '邯郸市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('84', '河北省邯郸市邯山区', '邯山区', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('85', '河北省邯郸市丛台区', '丛台区', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('86', '河北省邯郸市复兴区', '复兴区', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('87', '河北省邯郸市峰峰矿区', '峰峰矿区', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('88', '河北省邯郸市邯郸县', '邯郸县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('89', '河北省邯郸市临漳县', '临漳县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('90', '河北省邯郸市成安县', '成安县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('91', '河北省邯郸市大名县', '大名县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('92', '河北省邯郸市涉县', '涉县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('93', '河北省邯郸市磁县', '磁县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('94', '河北省邯郸市肥乡县', '肥乡县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('95', '河北省邯郸市永年县', '永年县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('96', '河北省邯郸市邱县', '邱县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('97', '河北省邯郸市鸡泽县', '鸡泽县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('98', '河北省邯郸市广平县', '广平县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('99', '河北省邯郸市馆陶县', '馆陶县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('100', '河北省邯郸市魏县', '魏县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('101', '河北省邯郸市曲周县', '曲周县', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('102', '河北省邯郸市武安市', '武安市', ',35,83,', '83', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('103', '河北省邢台市', '邢台市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('104', '河北省邢台市桥东区', '桥东区', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('105', '河北省邢台市桥西区', '桥西区', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('106', '河北省邢台市邢台县', '邢台县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('107', '河北省邢台市临城县', '临城县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('108', '河北省邢台市内丘县', '内丘县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('109', '河北省邢台市柏乡县', '柏乡县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('110', '河北省邢台市隆尧县', '隆尧县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('111', '河北省邢台市任县', '任县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('112', '河北省邢台市南和县', '南和县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('113', '河北省邢台市宁晋县', '宁晋县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('114', '河北省邢台市巨鹿县', '巨鹿县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('115', '河北省邢台市新河县', '新河县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('116', '河北省邢台市广宗县', '广宗县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('117', '河北省邢台市平乡县', '平乡县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('118', '河北省邢台市威县', '威县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('119', '河北省邢台市清河县', '清河县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('120', '河北省邢台市临西县', '临西县', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('121', '河北省邢台市南宫市', '南宫市', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('122', '河北省邢台市沙河市', '沙河市', ',35,103,', '103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('123', '河北省保定市', '保定市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('124', '河北省保定市新市区', '新市区', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('125', '河北省保定市北市区', '北市区', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('126', '河北省保定市南市区', '南市区', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('127', '河北省保定市满城县', '满城县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('128', '河北省保定市清苑县', '清苑县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('129', '河北省保定市涞水县', '涞水县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('130', '河北省保定市阜平县', '阜平县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('131', '河北省保定市徐水县', '徐水县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('132', '河北省保定市定兴县', '定兴县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('133', '河北省保定市唐县', '唐县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('134', '河北省保定市高阳县', '高阳县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('135', '河北省保定市容城县', '容城县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('136', '河北省保定市涞源县', '涞源县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('137', '河北省保定市望都县', '望都县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('138', '河北省保定市安新县', '安新县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('139', '河北省保定市易县', '易县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('140', '河北省保定市曲阳县', '曲阳县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('141', '河北省保定市蠡县', '蠡县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('142', '河北省保定市顺平县', '顺平县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('143', '河北省保定市博野县', '博野县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('144', '河北省保定市雄县', '雄县', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('145', '河北省保定市涿州市', '涿州市', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('146', '河北省保定市定州市', '定州市', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('147', '河北省保定市安国市', '安国市', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('148', '河北省保定市高碑店市', '高碑店市', ',35,123,', '123', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('149', '河北省张家口市', '张家口市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('150', '河北省张家口市桥东区', '桥东区', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('151', '河北省张家口市桥西区', '桥西区', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('152', '河北省张家口市宣化区', '宣化区', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('153', '河北省张家口市下花园区', '下花园区', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('154', '河北省张家口市宣化县', '宣化县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('155', '河北省张家口市张北县', '张北县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('156', '河北省张家口市康保县', '康保县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('157', '河北省张家口市沽源县', '沽源县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('158', '河北省张家口市尚义县', '尚义县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('159', '河北省张家口市蔚县', '蔚县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('160', '河北省张家口市阳原县', '阳原县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('161', '河北省张家口市怀安县', '怀安县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('162', '河北省张家口市万全县', '万全县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('163', '河北省张家口市怀来县', '怀来县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('164', '河北省张家口市涿鹿县', '涿鹿县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('165', '河北省张家口市赤城县', '赤城县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('166', '河北省张家口市崇礼县', '崇礼县', ',35,149,', '149', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('167', '河北省承德市', '承德市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('168', '河北省承德市双桥区', '双桥区', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('169', '河北省承德市双滦区', '双滦区', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('170', '河北省承德市鹰手营子矿区', '鹰手营子矿区', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('171', '河北省承德市承德县', '承德县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('172', '河北省承德市兴隆县', '兴隆县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('173', '河北省承德市平泉县', '平泉县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('174', '河北省承德市滦平县', '滦平县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('175', '河北省承德市隆化县', '隆化县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('176', '河北省承德市丰宁满族自治县', '丰宁满族自治县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('177', '河北省承德市宽城满族自治县', '宽城满族自治县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('178', '河北省承德市围场满族蒙古族自治县', '围场满族蒙古族自治县', ',35,167,', '167', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('179', '河北省沧州市', '沧州市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('180', '河北省沧州市新华区', '新华区', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('181', '河北省沧州市运河区', '运河区', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('182', '河北省沧州市沧县', '沧县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('183', '河北省沧州市青县', '青县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('184', '河北省沧州市东光县', '东光县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('185', '河北省沧州市海兴县', '海兴县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('186', '河北省沧州市盐山县', '盐山县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('187', '河北省沧州市肃宁县', '肃宁县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('188', '河北省沧州市南皮县', '南皮县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('189', '河北省沧州市吴桥县', '吴桥县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('190', '河北省沧州市献县', '献县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('191', '河北省沧州市孟村回族自治县', '孟村回族自治县', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('192', '河北省沧州市泊头市', '泊头市', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('193', '河北省沧州市任丘市', '任丘市', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('194', '河北省沧州市黄骅市', '黄骅市', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('195', '河北省沧州市河间市', '河间市', ',35,179,', '179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('196', '河北省廊坊市', '廊坊市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('197', '河北省廊坊市安次区', '安次区', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('198', '河北省廊坊市广阳区', '广阳区', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('199', '河北省廊坊市固安县', '固安县', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('200', '河北省廊坊市永清县', '永清县', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('201', '河北省廊坊市香河县', '香河县', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('202', '河北省廊坊市大城县', '大城县', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('203', '河北省廊坊市文安县', '文安县', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('204', '河北省廊坊市大厂回族自治县', '大厂回族自治县', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('205', '河北省廊坊市霸州市', '霸州市', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('206', '河北省廊坊市三河市', '三河市', ',35,196,', '196', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('207', '河北省衡水市', '衡水市', ',35,', '35', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('208', '河北省衡水市桃城区', '桃城区', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('209', '河北省衡水市枣强县', '枣强县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('210', '河北省衡水市武邑县', '武邑县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('211', '河北省衡水市武强县', '武强县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('212', '河北省衡水市饶阳县', '饶阳县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('213', '河北省衡水市安平县', '安平县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('214', '河北省衡水市故城县', '故城县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('215', '河北省衡水市景县', '景县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('216', '河北省衡水市阜城县', '阜城县', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('217', '河北省衡水市冀州市', '冀州市', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('218', '河北省衡水市深州市', '深州市', ',35,207,', '207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('219', '山西省', '山西省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('220', '山西省太原市', '太原市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('221', '山西省太原市小店区', '小店区', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('222', '山西省太原市迎泽区', '迎泽区', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('223', '山西省太原市杏花岭区', '杏花岭区', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('224', '山西省太原市尖草坪区', '尖草坪区', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('225', '山西省太原市万柏林区', '万柏林区', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('226', '山西省太原市晋源区', '晋源区', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('227', '山西省太原市清徐县', '清徐县', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('228', '山西省太原市阳曲县', '阳曲县', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('229', '山西省太原市娄烦县', '娄烦县', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('230', '山西省太原市古交市', '古交市', ',219,220,', '220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('231', '山西省大同市', '大同市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('232', '山西省大同市城区', '城区', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('233', '山西省大同市矿区', '矿区', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('234', '山西省大同市南郊区', '南郊区', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('235', '山西省大同市新荣区', '新荣区', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('236', '山西省大同市阳高县', '阳高县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('237', '山西省大同市天镇县', '天镇县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('238', '山西省大同市广灵县', '广灵县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('239', '山西省大同市灵丘县', '灵丘县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('240', '山西省大同市浑源县', '浑源县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('241', '山西省大同市左云县', '左云县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('242', '山西省大同市大同县', '大同县', ',219,231,', '231', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('243', '山西省阳泉市', '阳泉市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('244', '山西省阳泉市城区', '城区', ',219,243,', '243', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('245', '山西省阳泉市矿区', '矿区', ',219,243,', '243', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('246', '山西省阳泉市郊区', '郊区', ',219,243,', '243', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('247', '山西省阳泉市平定县', '平定县', ',219,243,', '243', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('248', '山西省阳泉市盂县', '盂县', ',219,243,', '243', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('249', '山西省长治市', '长治市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('250', '山西省长治市城区', '城区', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('251', '山西省长治市郊区', '郊区', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('252', '山西省长治市长治县', '长治县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('253', '山西省长治市襄垣县', '襄垣县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('254', '山西省长治市屯留县', '屯留县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('255', '山西省长治市平顺县', '平顺县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('256', '山西省长治市黎城县', '黎城县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('257', '山西省长治市壶关县', '壶关县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('258', '山西省长治市长子县', '长子县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('259', '山西省长治市武乡县', '武乡县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('260', '山西省长治市沁县', '沁县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('261', '山西省长治市沁源县', '沁源县', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('262', '山西省长治市潞城市', '潞城市', ',219,249,', '249', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('263', '山西省晋城市', '晋城市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('264', '山西省晋城市晋城市市辖区', '晋城市市辖区', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('265', '山西省晋城市城区', '城区', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('266', '山西省晋城市沁水县', '沁水县', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('267', '山西省晋城市阳城县', '阳城县', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('268', '山西省晋城市陵川县', '陵川县', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('269', '山西省晋城市泽州县', '泽州县', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('270', '山西省晋城市高平市', '高平市', ',219,263,', '263', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('271', '山西省朔州市', '朔州市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('272', '山西省朔州市朔城区', '朔城区', ',219,271,', '271', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('273', '山西省朔州市平鲁区', '平鲁区', ',219,271,', '271', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('274', '山西省朔州市山阴县', '山阴县', ',219,271,', '271', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('275', '山西省朔州市应县', '应县', ',219,271,', '271', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('276', '山西省朔州市右玉县', '右玉县', ',219,271,', '271', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('277', '山西省朔州市怀仁县', '怀仁县', ',219,271,', '271', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('278', '山西省晋中市', '晋中市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('279', '山西省晋中市榆次区', '榆次区', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('280', '山西省晋中市榆社县', '榆社县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('281', '山西省晋中市左权县', '左权县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('282', '山西省晋中市和顺县', '和顺县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('283', '山西省晋中市昔阳县', '昔阳县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('284', '山西省晋中市寿阳县', '寿阳县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('285', '山西省晋中市太谷县', '太谷县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('286', '山西省晋中市祁县', '祁县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('287', '山西省晋中市平遥县', '平遥县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('288', '山西省晋中市灵石县', '灵石县', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('289', '山西省晋中市介休市', '介休市', ',219,278,', '278', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('290', '山西省运城市', '运城市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('291', '山西省运城市盐湖区', '盐湖区', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('292', '山西省运城市临猗县', '临猗县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('293', '山西省运城市万荣县', '万荣县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('294', '山西省运城市闻喜县', '闻喜县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('295', '山西省运城市稷山县', '稷山县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('296', '山西省运城市新绛县', '新绛县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('297', '山西省运城市绛县', '绛县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('298', '山西省运城市垣曲县', '垣曲县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('299', '山西省运城市夏县', '夏县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('300', '山西省运城市平陆县', '平陆县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('301', '山西省运城市芮城县', '芮城县', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('302', '山西省运城市永济市', '永济市', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('303', '山西省运城市河津市', '河津市', ',219,290,', '290', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('304', '山西省忻州市', '忻州市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('305', '山西省忻州市忻府区', '忻府区', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('306', '山西省忻州市定襄县', '定襄县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('307', '山西省忻州市五台县', '五台县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('308', '山西省忻州市代县', '代县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('309', '山西省忻州市繁峙县', '繁峙县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('310', '山西省忻州市宁武县', '宁武县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('311', '山西省忻州市静乐县', '静乐县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('312', '山西省忻州市神池县', '神池县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('313', '山西省忻州市五寨县', '五寨县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('314', '山西省忻州市岢岚县', '岢岚县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('315', '山西省忻州市河曲县', '河曲县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('316', '山西省忻州市保德县', '保德县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('317', '山西省忻州市偏关县', '偏关县', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('318', '山西省忻州市原平市', '原平市', ',219,304,', '304', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('319', '山西省临汾市', '临汾市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('320', '山西省临汾市尧都区', '尧都区', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('321', '山西省临汾市曲沃县', '曲沃县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('322', '山西省临汾市翼城县', '翼城县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('323', '山西省临汾市襄汾县', '襄汾县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('324', '山西省临汾市洪洞县', '洪洞县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('325', '山西省临汾市古县', '古县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('326', '山西省临汾市安泽县', '安泽县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('327', '山西省临汾市浮山县', '浮山县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('328', '山西省临汾市吉县', '吉县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('329', '山西省临汾市乡宁县', '乡宁县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('330', '山西省临汾市大宁县', '大宁县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('331', '山西省临汾市隰县', '隰县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('332', '山西省临汾市永和县', '永和县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('333', '山西省临汾市蒲县', '蒲县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('334', '山西省临汾市汾西县', '汾西县', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('335', '山西省临汾市侯马市', '侯马市', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('336', '山西省临汾市霍州市', '霍州市', ',219,319,', '319', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('337', '山西省吕梁市', '吕梁市', ',219,', '219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('338', '山西省吕梁市离石区', '离石区', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('339', '山西省吕梁市文水县', '文水县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('340', '山西省吕梁市交城县', '交城县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('341', '山西省吕梁市兴县', '兴县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('342', '山西省吕梁市临县', '临县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('343', '山西省吕梁市柳林县', '柳林县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('344', '山西省吕梁市石楼县', '石楼县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('345', '山西省吕梁市岚县', '岚县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('346', '山西省吕梁市方山县', '方山县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('347', '山西省吕梁市中阳县', '中阳县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('348', '山西省吕梁市交口县', '交口县', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('349', '山西省吕梁市孝义市', '孝义市', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('350', '山西省吕梁市汾阳市', '汾阳市', ',219,337,', '337', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('351', '内蒙古自治区', '内蒙古自治区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('352', '内蒙古自治区呼和浩特市', '呼和浩特市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('353', '内蒙古自治区呼和浩特市新城区', '新城区', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('354', '内蒙古自治区呼和浩特市回民区', '回民区', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('355', '内蒙古自治区呼和浩特市玉泉区', '玉泉区', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('356', '内蒙古自治区呼和浩特市赛罕区', '赛罕区', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('357', '内蒙古自治区呼和浩特市土默特左旗', '土默特左旗', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('358', '内蒙古自治区呼和浩特市托克托县', '托克托县', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('359', '内蒙古自治区呼和浩特市和林格尔县', '和林格尔县', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('360', '内蒙古自治区呼和浩特市清水河县', '清水河县', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('361', '内蒙古自治区呼和浩特市武川县', '武川县', ',351,352,', '352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('362', '内蒙古自治区包头市', '包头市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('363', '内蒙古自治区包头市东河区', '东河区', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('364', '内蒙古自治区包头市昆都仑区', '昆都仑区', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('365', '内蒙古自治区包头市青山区', '青山区', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('366', '内蒙古自治区包头市石拐区', '石拐区', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('367', '内蒙古自治区包头市白云鄂博矿区', '白云鄂博矿区', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('368', '内蒙古自治区包头市九原区', '九原区', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('369', '内蒙古自治区包头市土默特右旗', '土默特右旗', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('370', '内蒙古自治区包头市固阳县', '固阳县', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('371', '内蒙古自治区包头市达尔罕茂明安联合旗', '达尔罕茂明安联合旗', ',351,362,', '362', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('372', '内蒙古自治区乌海市', '乌海市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('373', '内蒙古自治区乌海市海勃湾区', '海勃湾区', ',351,372,', '372', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('374', '内蒙古自治区乌海市海南区', '海南区', ',351,372,', '372', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('375', '内蒙古自治区乌海市乌达区', '乌达区', ',351,372,', '372', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('376', '内蒙古自治区赤峰市', '赤峰市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('377', '内蒙古自治区赤峰市红山区', '红山区', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('378', '内蒙古自治区赤峰市元宝山区', '元宝山区', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('379', '内蒙古自治区赤峰市松山区', '松山区', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('380', '内蒙古自治区赤峰市阿鲁科尔沁旗', '阿鲁科尔沁旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('381', '内蒙古自治区赤峰市巴林左旗', '巴林左旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('382', '内蒙古自治区赤峰市巴林右旗', '巴林右旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('383', '内蒙古自治区赤峰市林西县', '林西县', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('384', '内蒙古自治区赤峰市克什克腾旗', '克什克腾旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('385', '内蒙古自治区赤峰市翁牛特旗', '翁牛特旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('386', '内蒙古自治区赤峰市喀喇沁旗', '喀喇沁旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('387', '内蒙古自治区赤峰市宁城县', '宁城县', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('388', '内蒙古自治区赤峰市敖汉旗', '敖汉旗', ',351,376,', '376', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('389', '内蒙古自治区通辽市', '通辽市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('390', '内蒙古自治区通辽市科尔沁区', '科尔沁区', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('391', '内蒙古自治区通辽市科尔沁左翼中旗', '科尔沁左翼中旗', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('392', '内蒙古自治区通辽市科尔沁左翼后旗', '科尔沁左翼后旗', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('393', '内蒙古自治区通辽市开鲁县', '开鲁县', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('394', '内蒙古自治区通辽市库伦旗', '库伦旗', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('395', '内蒙古自治区通辽市奈曼旗', '奈曼旗', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('396', '内蒙古自治区通辽市扎鲁特旗', '扎鲁特旗', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('397', '内蒙古自治区通辽市霍林郭勒市', '霍林郭勒市', ',351,389,', '389', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('398', '内蒙古自治区鄂尔多斯市', '鄂尔多斯市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('399', '内蒙古自治区鄂尔多斯市东胜区', '东胜区', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('400', '内蒙古自治区鄂尔多斯市达拉特旗', '达拉特旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('401', '内蒙古自治区鄂尔多斯市准格尔旗', '准格尔旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('402', '内蒙古自治区鄂尔多斯市鄂托克前旗', '鄂托克前旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('403', '内蒙古自治区鄂尔多斯市鄂托克旗', '鄂托克旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('404', '内蒙古自治区鄂尔多斯市杭锦旗', '杭锦旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('405', '内蒙古自治区鄂尔多斯市乌审旗', '乌审旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('406', '内蒙古自治区鄂尔多斯市伊金霍洛旗', '伊金霍洛旗', ',351,398,', '398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('407', '内蒙古自治区呼伦贝尔市', '呼伦贝尔市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('408', '内蒙古自治区呼伦贝尔市海拉尔区', '海拉尔区', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('409', '内蒙古自治区呼伦贝尔市阿荣旗', '阿荣旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('410', '内蒙古自治区呼伦贝尔市莫力达瓦达斡尔族自治旗', '莫力达瓦达斡尔族自治旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('411', '内蒙古自治区呼伦贝尔市鄂伦春自治旗', '鄂伦春自治旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('412', '内蒙古自治区呼伦贝尔市鄂温克族自治旗', '鄂温克族自治旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('413', '内蒙古自治区呼伦贝尔市陈巴尔虎旗', '陈巴尔虎旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('414', '内蒙古自治区呼伦贝尔市新巴尔虎左旗', '新巴尔虎左旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('415', '内蒙古自治区呼伦贝尔市新巴尔虎右旗', '新巴尔虎右旗', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('416', '内蒙古自治区呼伦贝尔市满洲里市', '满洲里市', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('417', '内蒙古自治区呼伦贝尔市牙克石市', '牙克石市', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('418', '内蒙古自治区呼伦贝尔市扎兰屯市', '扎兰屯市', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('419', '内蒙古自治区呼伦贝尔市额尔古纳市', '额尔古纳市', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('420', '内蒙古自治区呼伦贝尔市根河市', '根河市', ',351,407,', '407', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('421', '内蒙古自治区巴彦淖尔市', '巴彦淖尔市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('422', '内蒙古自治区巴彦淖尔市临河区', '临河区', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('423', '内蒙古自治区巴彦淖尔市五原县', '五原县', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('424', '内蒙古自治区巴彦淖尔市磴口县', '磴口县', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('425', '内蒙古自治区巴彦淖尔市乌拉特前旗', '乌拉特前旗', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('426', '内蒙古自治区巴彦淖尔市乌拉特中旗', '乌拉特中旗', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('427', '内蒙古自治区巴彦淖尔市乌拉特后旗', '乌拉特后旗', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('428', '内蒙古自治区巴彦淖尔市杭锦后旗', '杭锦后旗', ',351,421,', '421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('429', '内蒙古自治区乌兰察布市', '乌兰察布市', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('430', '内蒙古自治区乌兰察布市集宁区', '集宁区', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('431', '内蒙古自治区乌兰察布市卓资县', '卓资县', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('432', '内蒙古自治区乌兰察布市化德县', '化德县', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('433', '内蒙古自治区乌兰察布市商都县', '商都县', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('434', '内蒙古自治区乌兰察布市兴和县', '兴和县', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('435', '内蒙古自治区乌兰察布市凉城县', '凉城县', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('436', '内蒙古自治区乌兰察布市察哈尔右翼前旗', '察哈尔右翼前旗', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('437', '内蒙古自治区乌兰察布市察哈尔右翼中旗', '察哈尔右翼中旗', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('438', '内蒙古自治区乌兰察布市察哈尔右翼后旗', '察哈尔右翼后旗', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('439', '内蒙古自治区乌兰察布市四子王旗', '四子王旗', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('440', '内蒙古自治区乌兰察布市丰镇市', '丰镇市', ',351,429,', '429', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('441', '内蒙古自治区兴安盟', '兴安盟', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('442', '内蒙古自治区兴安盟乌兰浩特市', '乌兰浩特市', ',351,441,', '441', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('443', '内蒙古自治区兴安盟阿尔山市', '阿尔山市', ',351,441,', '441', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('444', '内蒙古自治区兴安盟科尔沁右翼前旗', '科尔沁右翼前旗', ',351,441,', '441', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('445', '内蒙古自治区兴安盟科尔沁右翼中旗', '科尔沁右翼中旗', ',351,441,', '441', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('446', '内蒙古自治区兴安盟扎赉特旗', '扎赉特旗', ',351,441,', '441', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('447', '内蒙古自治区兴安盟突泉县', '突泉县', ',351,441,', '441', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('448', '内蒙古自治区锡林郭勒盟', '锡林郭勒盟', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('449', '内蒙古自治区锡林郭勒盟二连浩特市', '二连浩特市', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('450', '内蒙古自治区锡林郭勒盟锡林浩特市', '锡林浩特市', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('451', '内蒙古自治区锡林郭勒盟阿巴嘎旗', '阿巴嘎旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('452', '内蒙古自治区锡林郭勒盟苏尼特左旗', '苏尼特左旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('453', '内蒙古自治区锡林郭勒盟苏尼特右旗', '苏尼特右旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('454', '内蒙古自治区锡林郭勒盟东乌珠穆沁旗', '东乌珠穆沁旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('455', '内蒙古自治区锡林郭勒盟西乌珠穆沁旗', '西乌珠穆沁旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('456', '内蒙古自治区锡林郭勒盟太仆寺旗', '太仆寺旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('457', '内蒙古自治区锡林郭勒盟镶黄旗', '镶黄旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('458', '内蒙古自治区锡林郭勒盟正镶白旗', '正镶白旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('459', '内蒙古自治区锡林郭勒盟正蓝旗', '正蓝旗', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('460', '内蒙古自治区锡林郭勒盟多伦县', '多伦县', ',351,448,', '448', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('461', '内蒙古自治区阿拉善盟', '阿拉善盟', ',351,', '351', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('462', '内蒙古自治区阿拉善盟阿拉善左旗', '阿拉善左旗', ',351,461,', '461', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('463', '内蒙古自治区阿拉善盟阿拉善右旗', '阿拉善右旗', ',351,461,', '461', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('464', '内蒙古自治区阿拉善盟额济纳旗', '额济纳旗', ',351,461,', '461', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('465', '辽宁省', '辽宁省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('466', '辽宁省沈阳市', '沈阳市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('467', '辽宁省沈阳市和平区', '和平区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('468', '辽宁省沈阳市沈河区', '沈河区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('469', '辽宁省沈阳市大东区', '大东区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('470', '辽宁省沈阳市皇姑区', '皇姑区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('471', '辽宁省沈阳市铁西区', '铁西区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('472', '辽宁省沈阳市苏家屯区', '苏家屯区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('473', '辽宁省沈阳市东陵区', '东陵区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('474', '辽宁省沈阳市沈北新区', '沈北新区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('475', '辽宁省沈阳市于洪区', '于洪区', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('476', '辽宁省沈阳市辽中县', '辽中县', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('477', '辽宁省沈阳市康平县', '康平县', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('478', '辽宁省沈阳市法库县', '法库县', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('479', '辽宁省沈阳市新民市', '新民市', ',465,466,', '466', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('480', '辽宁省大连市', '大连市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('481', '辽宁省大连市中山区', '中山区', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('482', '辽宁省大连市西岗区', '西岗区', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('483', '辽宁省大连市沙河口区', '沙河口区', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('484', '辽宁省大连市甘井子区', '甘井子区', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('485', '辽宁省大连市旅顺口区', '旅顺口区', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('486', '辽宁省大连市金州区', '金州区', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('487', '辽宁省大连市长海县', '长海县', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('488', '辽宁省大连市瓦房店市', '瓦房店市', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('489', '辽宁省大连市普兰店市', '普兰店市', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('490', '辽宁省大连市庄河市', '庄河市', ',465,480,', '480', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('491', '辽宁省鞍山市', '鞍山市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('492', '辽宁省鞍山市铁东区', '铁东区', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('493', '辽宁省鞍山市铁西区', '铁西区', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('494', '辽宁省鞍山市立山区', '立山区', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('495', '辽宁省鞍山市千山区', '千山区', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('496', '辽宁省鞍山市台安县', '台安县', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('497', '辽宁省鞍山市岫岩满族自治县', '岫岩满族自治县', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('498', '辽宁省鞍山市海城市', '海城市', ',465,491,', '491', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('499', '辽宁省抚顺市', '抚顺市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('500', '辽宁省抚顺市新抚区', '新抚区', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('501', '辽宁省抚顺市东洲区', '东洲区', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('502', '辽宁省抚顺市望花区', '望花区', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('503', '辽宁省抚顺市顺城区', '顺城区', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('504', '辽宁省抚顺市抚顺县', '抚顺县', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('505', '辽宁省抚顺市新宾满族自治县', '新宾满族自治县', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('506', '辽宁省抚顺市清原满族自治县', '清原满族自治县', ',465,499,', '499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('507', '辽宁省本溪市', '本溪市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('508', '辽宁省本溪市平山区', '平山区', ',465,507,', '507', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('509', '辽宁省本溪市溪湖区', '溪湖区', ',465,507,', '507', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('510', '辽宁省本溪市明山区', '明山区', ',465,507,', '507', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('511', '辽宁省本溪市南芬区', '南芬区', ',465,507,', '507', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('512', '辽宁省本溪市本溪满族自治县', '本溪满族自治县', ',465,507,', '507', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('513', '辽宁省本溪市桓仁满族自治县', '桓仁满族自治县', ',465,507,', '507', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('514', '辽宁省丹东市', '丹东市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('515', '辽宁省丹东市元宝区', '元宝区', ',465,514,', '514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('516', '辽宁省丹东市振兴区', '振兴区', ',465,514,', '514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('517', '辽宁省丹东市振安区', '振安区', ',465,514,', '514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('518', '辽宁省丹东市宽甸满族自治县', '宽甸满族自治县', ',465,514,', '514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('519', '辽宁省丹东市东港市', '东港市', ',465,514,', '514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('520', '辽宁省丹东市凤城市', '凤城市', ',465,514,', '514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('521', '辽宁省锦州市', '锦州市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('522', '辽宁省锦州市古塔区', '古塔区', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('523', '辽宁省锦州市凌河区', '凌河区', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('524', '辽宁省锦州市太和区', '太和区', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('525', '辽宁省锦州市黑山县', '黑山县', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('526', '辽宁省锦州市义县', '义县', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('527', '辽宁省锦州市凌海市', '凌海市', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('528', '辽宁省锦州市北镇市', '北镇市', ',465,521,', '521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('529', '辽宁省营口市', '营口市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('530', '辽宁省营口市站前区', '站前区', ',465,529,', '529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('531', '辽宁省营口市西市区', '西市区', ',465,529,', '529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('532', '辽宁省营口市鲅鱼圈区', '鲅鱼圈区', ',465,529,', '529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('533', '辽宁省营口市老边区', '老边区', ',465,529,', '529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('534', '辽宁省营口市盖州市', '盖州市', ',465,529,', '529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('535', '辽宁省营口市大石桥市', '大石桥市', ',465,529,', '529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('536', '辽宁省阜新市', '阜新市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('537', '辽宁省阜新市海州区', '海州区', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('538', '辽宁省阜新市新邱区', '新邱区', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('539', '辽宁省阜新市太平区', '太平区', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('540', '辽宁省阜新市清河门区', '清河门区', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('541', '辽宁省阜新市细河区', '细河区', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('542', '辽宁省阜新市阜新蒙古族自治县', '阜新蒙古族自治县', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('543', '辽宁省阜新市彰武县', '彰武县', ',465,536,', '536', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('544', '辽宁省辽阳市', '辽阳市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('545', '辽宁省辽阳市白塔区', '白塔区', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('546', '辽宁省辽阳市文圣区', '文圣区', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('547', '辽宁省辽阳市宏伟区', '宏伟区', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('548', '辽宁省辽阳市弓长岭区', '弓长岭区', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('549', '辽宁省辽阳市太子河区', '太子河区', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('550', '辽宁省辽阳市辽阳县', '辽阳县', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('551', '辽宁省辽阳市灯塔市', '灯塔市', ',465,544,', '544', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('552', '辽宁省盘锦市', '盘锦市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('553', '辽宁省盘锦市双台子区', '双台子区', ',465,552,', '552', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('554', '辽宁省盘锦市兴隆台区', '兴隆台区', ',465,552,', '552', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('555', '辽宁省盘锦市大洼县', '大洼县', ',465,552,', '552', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('556', '辽宁省盘锦市盘山县', '盘山县', ',465,552,', '552', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('557', '辽宁省铁岭市', '铁岭市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('558', '辽宁省铁岭市银州区', '银州区', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('559', '辽宁省铁岭市清河区', '清河区', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('560', '辽宁省铁岭市铁岭县', '铁岭县', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('561', '辽宁省铁岭市西丰县', '西丰县', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('562', '辽宁省铁岭市昌图县', '昌图县', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('563', '辽宁省铁岭市调兵山市', '调兵山市', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('564', '辽宁省铁岭市开原市', '开原市', ',465,557,', '557', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('565', '辽宁省朝阳市', '朝阳市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('566', '辽宁省朝阳市双塔区', '双塔区', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('567', '辽宁省朝阳市龙城区', '龙城区', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('568', '辽宁省朝阳市朝阳县', '朝阳县', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('569', '辽宁省朝阳市建平县', '建平县', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('570', '辽宁省朝阳市喀喇沁左翼蒙古族自治县', '喀喇沁左翼蒙古族自治县', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('571', '辽宁省朝阳市北票市', '北票市', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('572', '辽宁省朝阳市凌源市', '凌源市', ',465,565,', '565', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('573', '辽宁省葫芦岛市', '葫芦岛市', ',465,', '465', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('574', '辽宁省葫芦岛市连山区', '连山区', ',465,573,', '573', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('575', '辽宁省葫芦岛市龙港区', '龙港区', ',465,573,', '573', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('576', '辽宁省葫芦岛市南票区', '南票区', ',465,573,', '573', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('577', '辽宁省葫芦岛市绥中县', '绥中县', ',465,573,', '573', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('578', '辽宁省葫芦岛市建昌县', '建昌县', ',465,573,', '573', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('579', '辽宁省葫芦岛市兴城市', '兴城市', ',465,573,', '573', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('580', '吉林省', '吉林省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('581', '吉林省长春市', '长春市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('582', '吉林省长春市南关区', '南关区', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('583', '吉林省长春市宽城区', '宽城区', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('584', '吉林省长春市朝阳区', '朝阳区', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('585', '吉林省长春市二道区', '二道区', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('586', '吉林省长春市绿园区', '绿园区', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('587', '吉林省长春市双阳区', '双阳区', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('588', '吉林省长春市农安县', '农安县', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('589', '吉林省长春市九台市', '九台市', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('590', '吉林省长春市榆树市', '榆树市', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('591', '吉林省长春市德惠市', '德惠市', ',580,581,', '581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('592', '吉林省吉林市', '吉林市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('593', '吉林省吉林市昌邑区', '昌邑区', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('594', '吉林省吉林市龙潭区', '龙潭区', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('595', '吉林省吉林市船营区', '船营区', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('596', '吉林省吉林市丰满区', '丰满区', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('597', '吉林省吉林市永吉县', '永吉县', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('598', '吉林省吉林市蛟河市', '蛟河市', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('599', '吉林省吉林市桦甸市', '桦甸市', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('600', '吉林省吉林市舒兰市', '舒兰市', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('601', '吉林省吉林市磐石市', '磐石市', ',580,592,', '592', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('602', '吉林省四平市', '四平市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('603', '吉林省四平市铁西区', '铁西区', ',580,602,', '602', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('604', '吉林省四平市铁东区', '铁东区', ',580,602,', '602', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('605', '吉林省四平市梨树县', '梨树县', ',580,602,', '602', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('606', '吉林省四平市伊通满族自治县', '伊通满族自治县', ',580,602,', '602', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('607', '吉林省四平市公主岭市', '公主岭市', ',580,602,', '602', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('608', '吉林省四平市双辽市', '双辽市', ',580,602,', '602', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('609', '吉林省辽源市', '辽源市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('610', '吉林省辽源市龙山区', '龙山区', ',580,609,', '609', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('611', '吉林省辽源市西安区', '西安区', ',580,609,', '609', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('612', '吉林省辽源市东丰县', '东丰县', ',580,609,', '609', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('613', '吉林省辽源市东辽县', '东辽县', ',580,609,', '609', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('614', '吉林省通化市', '通化市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('615', '吉林省通化市东昌区', '东昌区', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('616', '吉林省通化市二道江区', '二道江区', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('617', '吉林省通化市通化县', '通化县', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('618', '吉林省通化市辉南县', '辉南县', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('619', '吉林省通化市柳河县', '柳河县', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('620', '吉林省通化市梅河口市', '梅河口市', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('621', '吉林省通化市集安市', '集安市', ',580,614,', '614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('622', '吉林省白山市', '白山市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('623', '吉林省白山市浑江区', '浑江区', ',580,622,', '622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('624', '吉林省白山市江源区', '江源区', ',580,622,', '622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('625', '吉林省白山市抚松县', '抚松县', ',580,622,', '622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('626', '吉林省白山市靖宇县', '靖宇县', ',580,622,', '622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('627', '吉林省白山市长白朝鲜族自治县', '长白朝鲜族自治县', ',580,622,', '622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('628', '吉林省白山市临江市', '临江市', ',580,622,', '622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('629', '吉林省松原市', '松原市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('630', '吉林省松原市宁江区', '宁江区', ',580,629,', '629', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('631', '吉林省松原市前郭尔罗斯蒙古族自治县', '前郭尔罗斯蒙古族自治县', ',580,629,', '629', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('632', '吉林省松原市长岭县', '长岭县', ',580,629,', '629', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('633', '吉林省松原市乾安县', '乾安县', ',580,629,', '629', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('634', '吉林省松原市扶余县', '扶余县', ',580,629,', '629', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('635', '吉林省白城市', '白城市', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('636', '吉林省白城市洮北区', '洮北区', ',580,635,', '635', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('637', '吉林省白城市镇赉县', '镇赉县', ',580,635,', '635', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('638', '吉林省白城市通榆县', '通榆县', ',580,635,', '635', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('639', '吉林省白城市洮南市', '洮南市', ',580,635,', '635', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('640', '吉林省白城市大安市', '大安市', ',580,635,', '635', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('641', '吉林省延边朝鲜族自治州', '延边朝鲜族自治州', ',580,', '580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('642', '吉林省延边朝鲜族自治州延吉市', '延吉市', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('643', '吉林省延边朝鲜族自治州图们市', '图们市', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('644', '吉林省延边朝鲜族自治州敦化市', '敦化市', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('645', '吉林省延边朝鲜族自治州珲春市', '珲春市', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('646', '吉林省延边朝鲜族自治州龙井市', '龙井市', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('647', '吉林省延边朝鲜族自治州和龙市', '和龙市', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('648', '吉林省延边朝鲜族自治州汪清县', '汪清县', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('649', '吉林省延边朝鲜族自治州安图县', '安图县', ',580,641,', '641', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('650', '黑龙江省', '黑龙江省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('651', '黑龙江省哈尔滨市', '哈尔滨市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('652', '黑龙江省哈尔滨市道里区', '道里区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('653', '黑龙江省哈尔滨市南岗区', '南岗区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('654', '黑龙江省哈尔滨市道外区', '道外区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('655', '黑龙江省哈尔滨市平房区', '平房区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('656', '黑龙江省哈尔滨市松北区', '松北区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('657', '黑龙江省哈尔滨市香坊区', '香坊区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('658', '黑龙江省哈尔滨市呼兰区', '呼兰区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('659', '黑龙江省哈尔滨市阿城区', '阿城区', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('660', '黑龙江省哈尔滨市依兰县', '依兰县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('661', '黑龙江省哈尔滨市方正县', '方正县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('662', '黑龙江省哈尔滨市宾县', '宾县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('663', '黑龙江省哈尔滨市巴彦县', '巴彦县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('664', '黑龙江省哈尔滨市木兰县', '木兰县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('665', '黑龙江省哈尔滨市通河县', '通河县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('666', '黑龙江省哈尔滨市延寿县', '延寿县', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('667', '黑龙江省哈尔滨市双城市', '双城市', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('668', '黑龙江省哈尔滨市尚志市', '尚志市', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('669', '黑龙江省哈尔滨市五常市', '五常市', ',650,651,', '651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('670', '黑龙江省齐齐哈尔市', '齐齐哈尔市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('671', '黑龙江省齐齐哈尔市龙沙区', '龙沙区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('672', '黑龙江省齐齐哈尔市建华区', '建华区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('673', '黑龙江省齐齐哈尔市铁锋区', '铁锋区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('674', '黑龙江省齐齐哈尔市昂昂溪区', '昂昂溪区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('675', '黑龙江省齐齐哈尔市富拉尔基区', '富拉尔基区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('676', '黑龙江省齐齐哈尔市碾子山区', '碾子山区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('677', '黑龙江省齐齐哈尔市梅里斯达斡尔族区', '梅里斯达斡尔族区', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('678', '黑龙江省齐齐哈尔市龙江县', '龙江县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('679', '黑龙江省齐齐哈尔市依安县', '依安县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('680', '黑龙江省齐齐哈尔市泰来县', '泰来县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('681', '黑龙江省齐齐哈尔市甘南县', '甘南县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('682', '黑龙江省齐齐哈尔市富裕县', '富裕县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('683', '黑龙江省齐齐哈尔市克山县', '克山县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('684', '黑龙江省齐齐哈尔市克东县', '克东县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('685', '黑龙江省齐齐哈尔市拜泉县', '拜泉县', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('686', '黑龙江省齐齐哈尔市讷河市', '讷河市', ',650,670,', '670', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('687', '黑龙江省鸡西市', '鸡西市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('688', '黑龙江省鸡西市鸡冠区', '鸡冠区', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('689', '黑龙江省鸡西市恒山区', '恒山区', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('690', '黑龙江省鸡西市滴道区', '滴道区', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('691', '黑龙江省鸡西市梨树区', '梨树区', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('692', '黑龙江省鸡西市城子河区', '城子河区', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('693', '黑龙江省鸡西市麻山区', '麻山区', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('694', '黑龙江省鸡西市鸡东县', '鸡东县', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('695', '黑龙江省鸡西市虎林市', '虎林市', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('696', '黑龙江省鸡西市密山市', '密山市', ',650,687,', '687', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('697', '黑龙江省鹤岗市', '鹤岗市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('698', '黑龙江省鹤岗市向阳区', '向阳区', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('699', '黑龙江省鹤岗市工农区', '工农区', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('700', '黑龙江省鹤岗市南山区', '南山区', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('701', '黑龙江省鹤岗市兴安区', '兴安区', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('702', '黑龙江省鹤岗市东山区', '东山区', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('703', '黑龙江省鹤岗市兴山区', '兴山区', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('704', '黑龙江省鹤岗市萝北县', '萝北县', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('705', '黑龙江省鹤岗市绥滨县', '绥滨县', ',650,697,', '697', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('706', '黑龙江省双鸭山市', '双鸭山市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('707', '黑龙江省双鸭山市尖山区', '尖山区', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('708', '黑龙江省双鸭山市岭东区', '岭东区', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('709', '黑龙江省双鸭山市四方台区', '四方台区', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('710', '黑龙江省双鸭山市宝山区', '宝山区', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('711', '黑龙江省双鸭山市集贤县', '集贤县', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('712', '黑龙江省双鸭山市友谊县', '友谊县', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('713', '黑龙江省双鸭山市宝清县', '宝清县', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('714', '黑龙江省双鸭山市饶河县', '饶河县', ',650,706,', '706', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('715', '黑龙江省大庆市', '大庆市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('716', '黑龙江省大庆市萨尔图区', '萨尔图区', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('717', '黑龙江省大庆市龙凤区', '龙凤区', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('718', '黑龙江省大庆市让胡路区', '让胡路区', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('719', '黑龙江省大庆市红岗区', '红岗区', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('720', '黑龙江省大庆市大同区', '大同区', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('721', '黑龙江省大庆市肇州县', '肇州县', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('722', '黑龙江省大庆市肇源县', '肇源县', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('723', '黑龙江省大庆市林甸县', '林甸县', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('724', '黑龙江省大庆市杜尔伯特蒙古族自治县', '杜尔伯特蒙古族自治县', ',650,715,', '715', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('725', '黑龙江省伊春市', '伊春市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('726', '黑龙江省伊春市伊春区', '伊春区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('727', '黑龙江省伊春市南岔区', '南岔区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('728', '黑龙江省伊春市友好区', '友好区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('729', '黑龙江省伊春市西林区', '西林区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('730', '黑龙江省伊春市翠峦区', '翠峦区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('731', '黑龙江省伊春市新青区', '新青区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('732', '黑龙江省伊春市美溪区', '美溪区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('733', '黑龙江省伊春市金山屯区', '金山屯区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('734', '黑龙江省伊春市五营区', '五营区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('735', '黑龙江省伊春市乌马河区', '乌马河区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('736', '黑龙江省伊春市汤旺河区', '汤旺河区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('737', '黑龙江省伊春市带岭区', '带岭区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('738', '黑龙江省伊春市乌伊岭区', '乌伊岭区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('739', '黑龙江省伊春市红星区', '红星区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('740', '黑龙江省伊春市上甘岭区', '上甘岭区', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('741', '黑龙江省伊春市嘉荫县', '嘉荫县', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('742', '黑龙江省伊春市铁力市', '铁力市', ',650,725,', '725', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('743', '黑龙江省佳木斯市', '佳木斯市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('744', '黑龙江省佳木斯市向阳区', '向阳区', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('745', '黑龙江省佳木斯市前进区', '前进区', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('746', '黑龙江省佳木斯市东风区', '东风区', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('747', '黑龙江省佳木斯市郊区', '郊区', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('748', '黑龙江省佳木斯市桦南县', '桦南县', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('749', '黑龙江省佳木斯市桦川县', '桦川县', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('750', '黑龙江省佳木斯市汤原县', '汤原县', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('751', '黑龙江省佳木斯市抚远县', '抚远县', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('752', '黑龙江省佳木斯市同江市', '同江市', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('753', '黑龙江省佳木斯市富锦市', '富锦市', ',650,743,', '743', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('754', '黑龙江省七台河市', '七台河市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('755', '黑龙江省七台河市新兴区', '新兴区', ',650,754,', '754', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('756', '黑龙江省七台河市桃山区', '桃山区', ',650,754,', '754', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('757', '黑龙江省七台河市茄子河区', '茄子河区', ',650,754,', '754', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('758', '黑龙江省七台河市勃利县', '勃利县', ',650,754,', '754', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('759', '黑龙江省牡丹江市', '牡丹江市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('760', '黑龙江省牡丹江市东安区', '东安区', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('761', '黑龙江省牡丹江市阳明区', '阳明区', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('762', '黑龙江省牡丹江市爱民区', '爱民区', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('763', '黑龙江省牡丹江市西安区', '西安区', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('764', '黑龙江省牡丹江市东宁县', '东宁县', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('765', '黑龙江省牡丹江市林口县', '林口县', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('766', '黑龙江省牡丹江市绥芬河市', '绥芬河市', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('767', '黑龙江省牡丹江市海林市', '海林市', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('768', '黑龙江省牡丹江市宁安市', '宁安市', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('769', '黑龙江省牡丹江市穆棱市', '穆棱市', ',650,759,', '759', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('770', '黑龙江省黑河市', '黑河市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('771', '黑龙江省黑河市爱辉区', '爱辉区', ',650,770,', '770', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('772', '黑龙江省黑河市嫩江县', '嫩江县', ',650,770,', '770', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('773', '黑龙江省黑河市逊克县', '逊克县', ',650,770,', '770', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('774', '黑龙江省黑河市孙吴县', '孙吴县', ',650,770,', '770', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('775', '黑龙江省黑河市北安市', '北安市', ',650,770,', '770', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('776', '黑龙江省黑河市五大连池市', '五大连池市', ',650,770,', '770', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('777', '黑龙江省绥化市', '绥化市', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('778', '黑龙江省绥化市北林区', '北林区', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('779', '黑龙江省绥化市望奎县', '望奎县', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('780', '黑龙江省绥化市兰西县', '兰西县', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('781', '黑龙江省绥化市青冈县', '青冈县', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('782', '黑龙江省绥化市庆安县', '庆安县', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('783', '黑龙江省绥化市明水县', '明水县', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('784', '黑龙江省绥化市绥棱县', '绥棱县', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('785', '黑龙江省绥化市安达市', '安达市', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('786', '黑龙江省绥化市肇东市', '肇东市', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('787', '黑龙江省绥化市海伦市', '海伦市', ',650,777,', '777', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('788', '黑龙江省大兴安岭地区', '大兴安岭地区', ',650,', '650', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('789', '黑龙江省大兴安岭地区呼玛县', '呼玛县', ',650,788,', '788', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('790', '黑龙江省大兴安岭地区塔河县', '塔河县', ',650,788,', '788', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('791', '黑龙江省大兴安岭地区漠河县', '漠河县', ',650,788,', '788', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('792', '上海市', '上海市', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('793', '上海市黄浦区', '黄浦区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('794', '上海市徐汇区', '徐汇区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('795', '上海市长宁区', '长宁区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('796', '上海市静安区', '静安区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('797', '上海市普陀区', '普陀区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('798', '上海市闸北区', '闸北区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('799', '上海市虹口区', '虹口区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('800', '上海市杨浦区', '杨浦区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('801', '上海市闵行区', '闵行区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('802', '上海市宝山区', '宝山区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('803', '上海市嘉定区', '嘉定区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('804', '上海市浦东新区', '浦东新区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('805', '上海市金山区', '金山区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('806', '上海市松江区', '松江区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('807', '上海市青浦区', '青浦区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('808', '上海市奉贤区', '奉贤区', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('809', '上海市崇明县', '崇明县', ',792,', '792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('810', '江苏省', '江苏省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('811', '江苏省南京市', '南京市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('812', '江苏省南京市玄武区', '玄武区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('813', '江苏省南京市白下区', '白下区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('814', '江苏省南京市秦淮区', '秦淮区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('815', '江苏省南京市建邺区', '建邺区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('816', '江苏省南京市鼓楼区', '鼓楼区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('817', '江苏省南京市下关区', '下关区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('818', '江苏省南京市浦口区', '浦口区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('819', '江苏省南京市栖霞区', '栖霞区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('820', '江苏省南京市雨花台区', '雨花台区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('821', '江苏省南京市江宁区', '江宁区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('822', '江苏省南京市六合区', '六合区', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('823', '江苏省南京市溧水县', '溧水县', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('824', '江苏省南京市高淳县', '高淳县', ',810,811,', '811', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('825', '江苏省无锡市', '无锡市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('826', '江苏省无锡市崇安区', '崇安区', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('827', '江苏省无锡市南长区', '南长区', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('828', '江苏省无锡市北塘区', '北塘区', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('829', '江苏省无锡市锡山区', '锡山区', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('830', '江苏省无锡市惠山区', '惠山区', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('831', '江苏省无锡市滨湖区', '滨湖区', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('832', '江苏省无锡市江阴市', '江阴市', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('833', '江苏省无锡市宜兴市', '宜兴市', ',810,825,', '825', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('834', '江苏省徐州市', '徐州市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('835', '江苏省徐州市鼓楼区', '鼓楼区', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('836', '江苏省徐州市云龙区', '云龙区', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('837', '江苏省徐州市贾汪区', '贾汪区', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('838', '江苏省徐州市泉山区', '泉山区', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('839', '江苏省徐州市铜山区', '铜山区', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('840', '江苏省徐州市丰县', '丰县', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('841', '江苏省徐州市沛县', '沛县', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('842', '江苏省徐州市睢宁县', '睢宁县', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('843', '江苏省徐州市新沂市', '新沂市', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('844', '江苏省徐州市邳州市', '邳州市', ',810,834,', '834', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('845', '江苏省常州市', '常州市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('846', '江苏省常州市天宁区', '天宁区', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('847', '江苏省常州市钟楼区', '钟楼区', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('848', '江苏省常州市戚墅堰区', '戚墅堰区', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('849', '江苏省常州市新北区', '新北区', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('850', '江苏省常州市武进区', '武进区', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('851', '江苏省常州市溧阳市', '溧阳市', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('852', '江苏省常州市金坛市', '金坛市', ',810,845,', '845', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('853', '江苏省苏州市', '苏州市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('854', '江苏省苏州市虎丘区', '虎丘区', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('855', '江苏省苏州市吴中区', '吴中区', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('856', '江苏省苏州市相城区', '相城区', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('857', '江苏省苏州市姑苏区', '姑苏区', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('858', '江苏省苏州市吴江区', '吴江区', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('859', '江苏省苏州市常熟市', '常熟市', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('860', '江苏省苏州市张家港市', '张家港市', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('861', '江苏省苏州市昆山市', '昆山市', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('862', '江苏省苏州市太仓市', '太仓市', ',810,853,', '853', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('863', '江苏省南通市', '南通市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('864', '江苏省南通市崇川区', '崇川区', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('865', '江苏省南通市港闸区', '港闸区', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('866', '江苏省南通市通州区', '通州区', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('867', '江苏省南通市海安县', '海安县', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('868', '江苏省南通市如东县', '如东县', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('869', '江苏省南通市启东市', '启东市', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('870', '江苏省南通市如皋市', '如皋市', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('871', '江苏省南通市海门市', '海门市', ',810,863,', '863', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('872', '江苏省连云港市', '连云港市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('873', '江苏省连云港市连云区', '连云区', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('874', '江苏省连云港市新浦区', '新浦区', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('875', '江苏省连云港市海州区', '海州区', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('876', '江苏省连云港市赣榆县', '赣榆县', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('877', '江苏省连云港市东海县', '东海县', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('878', '江苏省连云港市灌云县', '灌云县', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('879', '江苏省连云港市灌南县', '灌南县', ',810,872,', '872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('880', '江苏省淮安市', '淮安市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('881', '江苏省淮安市清河区', '清河区', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('882', '江苏省淮安市淮安区', '淮安区', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('883', '江苏省淮安市淮阴区', '淮阴区', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('884', '江苏省淮安市清浦区', '清浦区', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('885', '江苏省淮安市涟水县', '涟水县', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('886', '江苏省淮安市洪泽县', '洪泽县', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('887', '江苏省淮安市盱眙县', '盱眙县', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('888', '江苏省淮安市金湖县', '金湖县', ',810,880,', '880', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('889', '江苏省盐城市', '盐城市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('890', '江苏省盐城市亭湖区', '亭湖区', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('891', '江苏省盐城市盐都区', '盐都区', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('892', '江苏省盐城市响水县', '响水县', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('893', '江苏省盐城市滨海县', '滨海县', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('894', '江苏省盐城市阜宁县', '阜宁县', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('895', '江苏省盐城市射阳县', '射阳县', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('896', '江苏省盐城市建湖县', '建湖县', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('897', '江苏省盐城市东台市', '东台市', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('898', '江苏省盐城市大丰市', '大丰市', ',810,889,', '889', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('899', '江苏省扬州市', '扬州市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('900', '江苏省扬州市广陵区', '广陵区', ',810,899,', '899', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('901', '江苏省扬州市邗江区', '邗江区', ',810,899,', '899', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('902', '江苏省扬州市江都区', '江都区', ',810,899,', '899', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('903', '江苏省扬州市宝应县', '宝应县', ',810,899,', '899', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('904', '江苏省扬州市仪征市', '仪征市', ',810,899,', '899', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('905', '江苏省扬州市高邮市', '高邮市', ',810,899,', '899', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('906', '江苏省镇江市', '镇江市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('907', '江苏省镇江市京口区', '京口区', ',810,906,', '906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('908', '江苏省镇江市润州区', '润州区', ',810,906,', '906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('909', '江苏省镇江市丹徒区', '丹徒区', ',810,906,', '906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('910', '江苏省镇江市丹阳市', '丹阳市', ',810,906,', '906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('911', '江苏省镇江市扬中市', '扬中市', ',810,906,', '906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('912', '江苏省镇江市句容市', '句容市', ',810,906,', '906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('913', '江苏省泰州市', '泰州市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('914', '江苏省泰州市海陵区', '海陵区', ',810,913,', '913', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('915', '江苏省泰州市高港区', '高港区', ',810,913,', '913', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('916', '江苏省泰州市兴化市', '兴化市', ',810,913,', '913', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('917', '江苏省泰州市靖江市', '靖江市', ',810,913,', '913', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('918', '江苏省泰州市泰兴市', '泰兴市', ',810,913,', '913', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('919', '江苏省泰州市姜堰市', '姜堰市', ',810,913,', '913', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('920', '江苏省宿迁市', '宿迁市', ',810,', '810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('921', '江苏省宿迁市宿城区', '宿城区', ',810,920,', '920', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('922', '江苏省宿迁市宿豫区', '宿豫区', ',810,920,', '920', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('923', '江苏省宿迁市沭阳县', '沭阳县', ',810,920,', '920', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('924', '江苏省宿迁市泗阳县', '泗阳县', ',810,920,', '920', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('925', '江苏省宿迁市泗洪县', '泗洪县', ',810,920,', '920', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('926', '浙江省', '浙江省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('927', '浙江省杭州市', '杭州市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('928', '浙江省杭州市上城区', '上城区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('929', '浙江省杭州市下城区', '下城区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('930', '浙江省杭州市江干区', '江干区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('931', '浙江省杭州市拱墅区', '拱墅区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('932', '浙江省杭州市西湖区', '西湖区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('933', '浙江省杭州市滨江区', '滨江区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('934', '浙江省杭州市萧山区', '萧山区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('935', '浙江省杭州市余杭区', '余杭区', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('936', '浙江省杭州市桐庐县', '桐庐县', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('937', '浙江省杭州市淳安县', '淳安县', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('938', '浙江省杭州市建德市', '建德市', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('939', '浙江省杭州市富阳市', '富阳市', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('940', '浙江省杭州市临安市', '临安市', ',926,927,', '927', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('941', '浙江省宁波市', '宁波市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('942', '浙江省宁波市海曙区', '海曙区', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('943', '浙江省宁波市江东区', '江东区', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('944', '浙江省宁波市江北区', '江北区', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('945', '浙江省宁波市北仑区', '北仑区', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('946', '浙江省宁波市镇海区', '镇海区', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('947', '浙江省宁波市鄞州区', '鄞州区', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('948', '浙江省宁波市象山县', '象山县', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('949', '浙江省宁波市宁海县', '宁海县', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('950', '浙江省宁波市余姚市', '余姚市', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('951', '浙江省宁波市慈溪市', '慈溪市', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('952', '浙江省宁波市奉化市', '奉化市', ',926,941,', '941', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('953', '浙江省温州市', '温州市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('954', '浙江省温州市鹿城区', '鹿城区', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('955', '浙江省温州市龙湾区', '龙湾区', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('956', '浙江省温州市瓯海区', '瓯海区', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('957', '浙江省温州市洞头县', '洞头县', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('958', '浙江省温州市永嘉县', '永嘉县', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('959', '浙江省温州市平阳县', '平阳县', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('960', '浙江省温州市苍南县', '苍南县', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('961', '浙江省温州市文成县', '文成县', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('962', '浙江省温州市泰顺县', '泰顺县', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('963', '浙江省温州市瑞安市', '瑞安市', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('964', '浙江省温州市乐清市', '乐清市', ',926,953,', '953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('965', '浙江省嘉兴市', '嘉兴市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('966', '浙江省嘉兴市南湖区', '南湖区', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('967', '浙江省嘉兴市秀洲区', '秀洲区', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('968', '浙江省嘉兴市嘉善县', '嘉善县', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('969', '浙江省嘉兴市海盐县', '海盐县', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('970', '浙江省嘉兴市海宁市', '海宁市', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('971', '浙江省嘉兴市平湖市', '平湖市', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('972', '浙江省嘉兴市桐乡市', '桐乡市', ',926,965,', '965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('973', '浙江省湖州市', '湖州市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('974', '浙江省湖州市吴兴区', '吴兴区', ',926,973,', '973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('975', '浙江省湖州市南浔区', '南浔区', ',926,973,', '973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('976', '浙江省湖州市德清县', '德清县', ',926,973,', '973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('977', '浙江省湖州市长兴县', '长兴县', ',926,973,', '973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('978', '浙江省湖州市安吉县', '安吉县', ',926,973,', '973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('979', '浙江省绍兴市', '绍兴市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('980', '浙江省绍兴市越城区', '越城区', ',926,979,', '979', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('981', '浙江省绍兴市绍兴县', '绍兴县', ',926,979,', '979', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('982', '浙江省绍兴市新昌县', '新昌县', ',926,979,', '979', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('983', '浙江省绍兴市诸暨市', '诸暨市', ',926,979,', '979', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('984', '浙江省绍兴市上虞市', '上虞市', ',926,979,', '979', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('985', '浙江省绍兴市嵊州市', '嵊州市', ',926,979,', '979', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('986', '浙江省金华市', '金华市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('987', '浙江省金华市婺城区', '婺城区', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('988', '浙江省金华市金东区', '金东区', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('989', '浙江省金华市武义县', '武义县', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('990', '浙江省金华市浦江县', '浦江县', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('991', '浙江省金华市磐安县', '磐安县', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('992', '浙江省金华市兰溪市', '兰溪市', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('993', '浙江省金华市义乌市', '义乌市', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('994', '浙江省金华市东阳市', '东阳市', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('995', '浙江省金华市永康市', '永康市', ',926,986,', '986', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('996', '浙江省衢州市', '衢州市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('997', '浙江省衢州市柯城区', '柯城区', ',926,996,', '996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('998', '浙江省衢州市衢江区', '衢江区', ',926,996,', '996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('999', '浙江省衢州市常山县', '常山县', ',926,996,', '996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1000', '浙江省衢州市开化县', '开化县', ',926,996,', '996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1001', '浙江省衢州市龙游县', '龙游县', ',926,996,', '996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1002', '浙江省衢州市江山市', '江山市', ',926,996,', '996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1003', '浙江省舟山市', '舟山市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1004', '浙江省舟山市定海区', '定海区', ',926,1003,', '1003', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1005', '浙江省舟山市普陀区', '普陀区', ',926,1003,', '1003', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1006', '浙江省舟山市岱山县', '岱山县', ',926,1003,', '1003', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1007', '浙江省舟山市嵊泗县', '嵊泗县', ',926,1003,', '1003', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1008', '浙江省台州市', '台州市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1009', '浙江省台州市椒江区', '椒江区', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1010', '浙江省台州市黄岩区', '黄岩区', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1011', '浙江省台州市路桥区', '路桥区', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1012', '浙江省台州市玉环县', '玉环县', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1013', '浙江省台州市三门县', '三门县', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1014', '浙江省台州市天台县', '天台县', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1015', '浙江省台州市仙居县', '仙居县', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1016', '浙江省台州市温岭市', '温岭市', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1017', '浙江省台州市临海市', '临海市', ',926,1008,', '1008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1018', '浙江省丽水市', '丽水市', ',926,', '926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1019', '浙江省丽水市莲都区', '莲都区', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1020', '浙江省丽水市青田县', '青田县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1021', '浙江省丽水市缙云县', '缙云县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1022', '浙江省丽水市遂昌县', '遂昌县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1023', '浙江省丽水市松阳县', '松阳县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1024', '浙江省丽水市云和县', '云和县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1025', '浙江省丽水市庆元县', '庆元县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1026', '浙江省丽水市景宁畲族自治县', '景宁畲族自治县', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1027', '浙江省丽水市龙泉市', '龙泉市', ',926,1018,', '1018', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1028', '安徽省', '安徽省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1029', '安徽省合肥市', '合肥市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1030', '安徽省合肥市瑶海区', '瑶海区', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1031', '安徽省合肥市庐阳区', '庐阳区', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1032', '安徽省合肥市蜀山区', '蜀山区', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1033', '安徽省合肥市包河区', '包河区', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1034', '安徽省合肥市长丰县', '长丰县', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1035', '安徽省合肥市肥东县', '肥东县', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1036', '安徽省合肥市肥西县', '肥西县', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1037', '安徽省合肥市庐江县', '庐江县', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1038', '安徽省合肥市巢湖市', '巢湖市', ',1028,1029,', '1029', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1039', '安徽省芜湖市', '芜湖市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1040', '安徽省芜湖市镜湖区', '镜湖区', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1041', '安徽省芜湖市弋江区', '弋江区', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1042', '安徽省芜湖市鸠江区', '鸠江区', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1043', '安徽省芜湖市三山区', '三山区', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1044', '安徽省芜湖市芜湖县', '芜湖县', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1045', '安徽省芜湖市繁昌县', '繁昌县', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1046', '安徽省芜湖市南陵县', '南陵县', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1047', '安徽省芜湖市无为县', '无为县', ',1028,1039,', '1039', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1048', '安徽省蚌埠市', '蚌埠市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1049', '安徽省蚌埠市龙子湖区', '龙子湖区', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1050', '安徽省蚌埠市蚌山区', '蚌山区', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1051', '安徽省蚌埠市禹会区', '禹会区', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1052', '安徽省蚌埠市淮上区', '淮上区', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1053', '安徽省蚌埠市怀远县', '怀远县', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1054', '安徽省蚌埠市五河县', '五河县', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1055', '安徽省蚌埠市固镇县', '固镇县', ',1028,1048,', '1048', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1056', '安徽省淮南市', '淮南市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1057', '安徽省淮南市大通区', '大通区', ',1028,1056,', '1056', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1058', '安徽省淮南市田家庵区', '田家庵区', ',1028,1056,', '1056', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1059', '安徽省淮南市谢家集区', '谢家集区', ',1028,1056,', '1056', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1060', '安徽省淮南市八公山区', '八公山区', ',1028,1056,', '1056', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1061', '安徽省淮南市潘集区', '潘集区', ',1028,1056,', '1056', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1062', '安徽省淮南市凤台县', '凤台县', ',1028,1056,', '1056', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1063', '安徽省马鞍山市', '马鞍山市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1064', '安徽省马鞍山市花山区', '花山区', ',1028,1063,', '1063', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1065', '安徽省马鞍山市雨山区', '雨山区', ',1028,1063,', '1063', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1066', '安徽省马鞍山市博望区', '博望区', ',1028,1063,', '1063', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1067', '安徽省马鞍山市当涂县', '当涂县', ',1028,1063,', '1063', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1068', '安徽省马鞍山市含山县', '含山县', ',1028,1063,', '1063', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1069', '安徽省马鞍山市和县', '和县', ',1028,1063,', '1063', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1070', '安徽省淮北市', '淮北市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1071', '安徽省淮北市杜集区', '杜集区', ',1028,1070,', '1070', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1072', '安徽省淮北市相山区', '相山区', ',1028,1070,', '1070', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1073', '安徽省淮北市烈山区', '烈山区', ',1028,1070,', '1070', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1074', '安徽省淮北市濉溪县', '濉溪县', ',1028,1070,', '1070', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1075', '安徽省铜陵市', '铜陵市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1076', '安徽省铜陵市铜官山区', '铜官山区', ',1028,1075,', '1075', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1077', '安徽省铜陵市狮子山区', '狮子山区', ',1028,1075,', '1075', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1078', '安徽省铜陵市郊区', '郊区', ',1028,1075,', '1075', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1079', '安徽省铜陵市铜陵县', '铜陵县', ',1028,1075,', '1075', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1080', '安徽省安庆市', '安庆市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1081', '安徽省安庆市迎江区', '迎江区', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1082', '安徽省安庆市大观区', '大观区', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1083', '安徽省安庆市宜秀区', '宜秀区', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1084', '安徽省安庆市怀宁县', '怀宁县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1085', '安徽省安庆市枞阳县', '枞阳县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1086', '安徽省安庆市潜山县', '潜山县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1087', '安徽省安庆市太湖县', '太湖县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1088', '安徽省安庆市宿松县', '宿松县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1089', '安徽省安庆市望江县', '望江县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1090', '安徽省安庆市岳西县', '岳西县', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1091', '安徽省安庆市桐城市', '桐城市', ',1028,1080,', '1080', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1092', '安徽省黄山市', '黄山市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1093', '安徽省黄山市屯溪区', '屯溪区', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1094', '安徽省黄山市黄山区', '黄山区', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1095', '安徽省黄山市徽州区', '徽州区', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1096', '安徽省黄山市歙县', '歙县', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1097', '安徽省黄山市休宁县', '休宁县', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1098', '安徽省黄山市黟县', '黟县', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1099', '安徽省黄山市祁门县', '祁门县', ',1028,1092,', '1092', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1100', '安徽省滁州市', '滁州市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1101', '安徽省滁州市琅琊区', '琅琊区', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1102', '安徽省滁州市南谯区', '南谯区', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1103', '安徽省滁州市来安县', '来安县', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1104', '安徽省滁州市全椒县', '全椒县', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1105', '安徽省滁州市定远县', '定远县', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1106', '安徽省滁州市凤阳县', '凤阳县', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1107', '安徽省滁州市天长市', '天长市', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1108', '安徽省滁州市明光市', '明光市', ',1028,1100,', '1100', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1109', '安徽省阜阳市', '阜阳市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1110', '安徽省阜阳市颍州区', '颍州区', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1111', '安徽省阜阳市颍东区', '颍东区', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1112', '安徽省阜阳市颍泉区', '颍泉区', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1113', '安徽省阜阳市临泉县', '临泉县', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1114', '安徽省阜阳市太和县', '太和县', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1115', '安徽省阜阳市阜南县', '阜南县', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1116', '安徽省阜阳市颍上县', '颍上县', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1117', '安徽省阜阳市界首市', '界首市', ',1028,1109,', '1109', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1118', '安徽省宿州市', '宿州市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1119', '安徽省宿州市埇桥区', '埇桥区', ',1028,1118,', '1118', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1120', '安徽省宿州市砀山县', '砀山县', ',1028,1118,', '1118', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1121', '安徽省宿州市萧县', '萧县', ',1028,1118,', '1118', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1122', '安徽省宿州市灵璧县', '灵璧县', ',1028,1118,', '1118', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1123', '安徽省宿州市泗县', '泗县', ',1028,1118,', '1118', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1124', '安徽省六安市', '六安市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1125', '安徽省六安市金安区', '金安区', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1126', '安徽省六安市裕安区', '裕安区', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1127', '安徽省六安市寿县', '寿县', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1128', '安徽省六安市霍邱县', '霍邱县', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1129', '安徽省六安市舒城县', '舒城县', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1130', '安徽省六安市金寨县', '金寨县', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1131', '安徽省六安市霍山县', '霍山县', ',1028,1124,', '1124', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1132', '安徽省亳州市', '亳州市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1133', '安徽省亳州市谯城区', '谯城区', ',1028,1132,', '1132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1134', '安徽省亳州市涡阳县', '涡阳县', ',1028,1132,', '1132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1135', '安徽省亳州市蒙城县', '蒙城县', ',1028,1132,', '1132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1136', '安徽省亳州市利辛县', '利辛县', ',1028,1132,', '1132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1137', '安徽省池州市', '池州市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1138', '安徽省池州市贵池区', '贵池区', ',1028,1137,', '1137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1139', '安徽省池州市东至县', '东至县', ',1028,1137,', '1137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1140', '安徽省池州市石台县', '石台县', ',1028,1137,', '1137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1141', '安徽省池州市青阳县', '青阳县', ',1028,1137,', '1137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1142', '安徽省宣城市', '宣城市', ',1028,', '1028', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1143', '安徽省宣城市宣州区', '宣州区', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1144', '安徽省宣城市郎溪县', '郎溪县', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1145', '安徽省宣城市广德县', '广德县', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1146', '安徽省宣城市泾县', '泾县', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1147', '安徽省宣城市绩溪县', '绩溪县', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1148', '安徽省宣城市旌德县', '旌德县', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1149', '安徽省宣城市宁国市', '宁国市', ',1028,1142,', '1142', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1150', '福建省', '福建省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1151', '福建省福州市', '福州市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1152', '福建省福州市鼓楼区', '鼓楼区', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1153', '福建省福州市台江区', '台江区', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1154', '福建省福州市仓山区', '仓山区', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1155', '福建省福州市马尾区', '马尾区', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1156', '福建省福州市晋安区', '晋安区', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1157', '福建省福州市闽侯县', '闽侯县', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1158', '福建省福州市连江县', '连江县', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1159', '福建省福州市罗源县', '罗源县', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1160', '福建省福州市闽清县', '闽清县', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1161', '福建省福州市永泰县', '永泰县', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1162', '福建省福州市平潭县', '平潭县', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1163', '福建省福州市福清市', '福清市', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1164', '福建省福州市长乐市', '长乐市', ',1150,1151,', '1151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1165', '福建省厦门市', '厦门市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1166', '福建省厦门市思明区', '思明区', ',1150,1165,', '1165', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1167', '福建省厦门市海沧区', '海沧区', ',1150,1165,', '1165', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1168', '福建省厦门市湖里区', '湖里区', ',1150,1165,', '1165', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1169', '福建省厦门市集美区', '集美区', ',1150,1165,', '1165', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1170', '福建省厦门市同安区', '同安区', ',1150,1165,', '1165', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1171', '福建省厦门市翔安区', '翔安区', ',1150,1165,', '1165', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1172', '福建省莆田市', '莆田市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1173', '福建省莆田市城厢区', '城厢区', ',1150,1172,', '1172', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1174', '福建省莆田市涵江区', '涵江区', ',1150,1172,', '1172', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1175', '福建省莆田市荔城区', '荔城区', ',1150,1172,', '1172', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1176', '福建省莆田市秀屿区', '秀屿区', ',1150,1172,', '1172', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1177', '福建省莆田市仙游县', '仙游县', ',1150,1172,', '1172', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1178', '福建省三明市', '三明市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1179', '福建省三明市梅列区', '梅列区', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1180', '福建省三明市三元区', '三元区', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1181', '福建省三明市明溪县', '明溪县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1182', '福建省三明市清流县', '清流县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1183', '福建省三明市宁化县', '宁化县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1184', '福建省三明市大田县', '大田县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1185', '福建省三明市尤溪县', '尤溪县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1186', '福建省三明市沙县', '沙县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1187', '福建省三明市将乐县', '将乐县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1188', '福建省三明市泰宁县', '泰宁县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1189', '福建省三明市建宁县', '建宁县', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1190', '福建省三明市永安市', '永安市', ',1150,1178,', '1178', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1191', '福建省泉州市', '泉州市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1192', '福建省泉州市鲤城区', '鲤城区', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1193', '福建省泉州市丰泽区', '丰泽区', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1194', '福建省泉州市洛江区', '洛江区', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1195', '福建省泉州市泉港区', '泉港区', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1196', '福建省泉州市惠安县', '惠安县', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1197', '福建省泉州市安溪县', '安溪县', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1198', '福建省泉州市永春县', '永春县', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1199', '福建省泉州市德化县', '德化县', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1200', '福建省泉州市金门县', '金门县', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1201', '福建省泉州市石狮市', '石狮市', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1202', '福建省泉州市晋江市', '晋江市', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1203', '福建省泉州市南安市', '南安市', ',1150,1191,', '1191', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1204', '福建省漳州市', '漳州市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1205', '福建省漳州市芗城区', '芗城区', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1206', '福建省漳州市龙文区', '龙文区', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1207', '福建省漳州市云霄县', '云霄县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1208', '福建省漳州市漳浦县', '漳浦县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1209', '福建省漳州市诏安县', '诏安县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1210', '福建省漳州市长泰县', '长泰县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1211', '福建省漳州市东山县', '东山县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1212', '福建省漳州市南靖县', '南靖县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1213', '福建省漳州市平和县', '平和县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1214', '福建省漳州市华安县', '华安县', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1215', '福建省漳州市龙海市', '龙海市', ',1150,1204,', '1204', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1216', '福建省南平市', '南平市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1217', '福建省南平市延平区', '延平区', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1218', '福建省南平市顺昌县', '顺昌县', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1219', '福建省南平市浦城县', '浦城县', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1220', '福建省南平市光泽县', '光泽县', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1221', '福建省南平市松溪县', '松溪县', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1222', '福建省南平市政和县', '政和县', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1223', '福建省南平市邵武市', '邵武市', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1224', '福建省南平市武夷山市', '武夷山市', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1225', '福建省南平市建瓯市', '建瓯市', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1226', '福建省南平市建阳市', '建阳市', ',1150,1216,', '1216', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1227', '福建省龙岩市', '龙岩市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1228', '福建省龙岩市新罗区', '新罗区', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1229', '福建省龙岩市长汀县', '长汀县', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1230', '福建省龙岩市永定县', '永定县', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1231', '福建省龙岩市上杭县', '上杭县', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1232', '福建省龙岩市武平县', '武平县', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1233', '福建省龙岩市连城县', '连城县', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1234', '福建省龙岩市漳平市', '漳平市', ',1150,1227,', '1227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1235', '福建省宁德市', '宁德市', ',1150,', '1150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1236', '福建省宁德市蕉城区', '蕉城区', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1237', '福建省宁德市霞浦县', '霞浦县', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1238', '福建省宁德市古田县', '古田县', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1239', '福建省宁德市屏南县', '屏南县', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1240', '福建省宁德市寿宁县', '寿宁县', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1241', '福建省宁德市周宁县', '周宁县', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1242', '福建省宁德市柘荣县', '柘荣县', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1243', '福建省宁德市福安市', '福安市', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1244', '福建省宁德市福鼎市', '福鼎市', ',1150,1235,', '1235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1245', '江西省', '江西省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1246', '江西省南昌市', '南昌市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1247', '江西省南昌市东湖区', '东湖区', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1248', '江西省南昌市西湖区', '西湖区', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1249', '江西省南昌市青云谱区', '青云谱区', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1250', '江西省南昌市湾里区', '湾里区', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1251', '江西省南昌市青山湖区', '青山湖区', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1252', '江西省南昌市南昌县', '南昌县', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1253', '江西省南昌市新建县', '新建县', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1254', '江西省南昌市安义县', '安义县', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1255', '江西省南昌市进贤县', '进贤县', ',1245,1246,', '1246', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1256', '江西省景德镇市', '景德镇市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1257', '江西省景德镇市昌江区', '昌江区', ',1245,1256,', '1256', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1258', '江西省景德镇市珠山区', '珠山区', ',1245,1256,', '1256', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1259', '江西省景德镇市浮梁县', '浮梁县', ',1245,1256,', '1256', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1260', '江西省景德镇市乐平市', '乐平市', ',1245,1256,', '1256', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1261', '江西省萍乡市', '萍乡市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1262', '江西省萍乡市安源区', '安源区', ',1245,1261,', '1261', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1263', '江西省萍乡市湘东区', '湘东区', ',1245,1261,', '1261', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1264', '江西省萍乡市莲花县', '莲花县', ',1245,1261,', '1261', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1265', '江西省萍乡市上栗县', '上栗县', ',1245,1261,', '1261', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1266', '江西省萍乡市芦溪县', '芦溪县', ',1245,1261,', '1261', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1267', '江西省九江市', '九江市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1268', '江西省九江市庐山区', '庐山区', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1269', '江西省九江市浔阳区', '浔阳区', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1270', '江西省九江市九江县', '九江县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1271', '江西省九江市武宁县', '武宁县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1272', '江西省九江市修水县', '修水县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1273', '江西省九江市永修县', '永修县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1274', '江西省九江市德安县', '德安县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1275', '江西省九江市星子县', '星子县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1276', '江西省九江市都昌县', '都昌县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1277', '江西省九江市湖口县', '湖口县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1278', '江西省九江市彭泽县', '彭泽县', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1279', '江西省九江市瑞昌市', '瑞昌市', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1280', '江西省九江市共青城市', '共青城市', ',1245,1267,', '1267', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1281', '江西省新余市', '新余市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1282', '江西省新余市渝水区', '渝水区', ',1245,1281,', '1281', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1283', '江西省新余市分宜县', '分宜县', ',1245,1281,', '1281', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1284', '江西省鹰潭市', '鹰潭市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1285', '江西省鹰潭市月湖区', '月湖区', ',1245,1284,', '1284', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1286', '江西省鹰潭市余江县', '余江县', ',1245,1284,', '1284', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1287', '江西省鹰潭市贵溪市', '贵溪市', ',1245,1284,', '1284', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1288', '江西省赣州市', '赣州市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1289', '江西省赣州市章贡区', '章贡区', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1290', '江西省赣州市赣县', '赣县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1291', '江西省赣州市信丰县', '信丰县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1292', '江西省赣州市大余县', '大余县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1293', '江西省赣州市上犹县', '上犹县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1294', '江西省赣州市崇义县', '崇义县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1295', '江西省赣州市安远县', '安远县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1296', '江西省赣州市龙南县', '龙南县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1297', '江西省赣州市定南县', '定南县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1298', '江西省赣州市全南县', '全南县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1299', '江西省赣州市宁都县', '宁都县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1300', '江西省赣州市于都县', '于都县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1301', '江西省赣州市兴国县', '兴国县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1302', '江西省赣州市会昌县', '会昌县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1303', '江西省赣州市寻乌县', '寻乌县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1304', '江西省赣州市石城县', '石城县', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1305', '江西省赣州市瑞金市', '瑞金市', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1306', '江西省赣州市南康市', '南康市', ',1245,1288,', '1288', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1307', '江西省吉安市', '吉安市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1308', '江西省吉安市吉州区', '吉州区', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1309', '江西省吉安市青原区', '青原区', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1310', '江西省吉安市吉安县', '吉安县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1311', '江西省吉安市吉水县', '吉水县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1312', '江西省吉安市峡江县', '峡江县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1313', '江西省吉安市新干县', '新干县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1314', '江西省吉安市永丰县', '永丰县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1315', '江西省吉安市泰和县', '泰和县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1316', '江西省吉安市遂川县', '遂川县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1317', '江西省吉安市万安县', '万安县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1318', '江西省吉安市安福县', '安福县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1319', '江西省吉安市永新县', '永新县', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1320', '江西省吉安市井冈山市', '井冈山市', ',1245,1307,', '1307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1321', '江西省宜春市', '宜春市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1322', '江西省宜春市袁州区', '袁州区', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1323', '江西省宜春市奉新县', '奉新县', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1324', '江西省宜春市万载县', '万载县', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1325', '江西省宜春市上高县', '上高县', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1326', '江西省宜春市宜丰县', '宜丰县', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1327', '江西省宜春市靖安县', '靖安县', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1328', '江西省宜春市铜鼓县', '铜鼓县', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1329', '江西省宜春市丰城市', '丰城市', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1330', '江西省宜春市樟树市', '樟树市', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1331', '江西省宜春市高安市', '高安市', ',1245,1321,', '1321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1332', '江西省抚州市', '抚州市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1333', '江西省抚州市临川区', '临川区', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1334', '江西省抚州市南城县', '南城县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1335', '江西省抚州市黎川县', '黎川县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1336', '江西省抚州市南丰县', '南丰县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1337', '江西省抚州市崇仁县', '崇仁县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1338', '江西省抚州市乐安县', '乐安县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1339', '江西省抚州市宜黄县', '宜黄县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1340', '江西省抚州市金溪县', '金溪县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1341', '江西省抚州市资溪县', '资溪县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1342', '江西省抚州市东乡县', '东乡县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1343', '江西省抚州市广昌县', '广昌县', ',1245,1332,', '1332', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1344', '江西省上饶市', '上饶市', ',1245,', '1245', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1345', '江西省上饶市信州区', '信州区', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1346', '江西省上饶市上饶县', '上饶县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1347', '江西省上饶市广丰县', '广丰县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1348', '江西省上饶市玉山县', '玉山县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1349', '江西省上饶市铅山县', '铅山县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1350', '江西省上饶市横峰县', '横峰县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1351', '江西省上饶市弋阳县', '弋阳县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1352', '江西省上饶市余干县', '余干县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1353', '江西省上饶市鄱阳县', '鄱阳县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1354', '江西省上饶市万年县', '万年县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1355', '江西省上饶市婺源县', '婺源县', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1356', '江西省上饶市德兴市', '德兴市', ',1245,1344,', '1344', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1357', '山东省', '山东省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1358', '山东省济南市', '济南市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1359', '山东省济南市历下区', '历下区', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1360', '山东省济南市市中区', '市中区', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1361', '山东省济南市槐荫区', '槐荫区', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1362', '山东省济南市天桥区', '天桥区', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1363', '山东省济南市历城区', '历城区', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1364', '山东省济南市长清区', '长清区', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1365', '山东省济南市平阴县', '平阴县', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1366', '山东省济南市济阳县', '济阳县', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1367', '山东省济南市商河县', '商河县', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1368', '山东省济南市章丘市', '章丘市', ',1357,1358,', '1358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1369', '山东省青岛市', '青岛市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1370', '山东省青岛市市南区', '市南区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1371', '山东省青岛市市北区', '市北区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1372', '山东省青岛市四方区', '四方区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1373', '山东省青岛市黄岛区', '黄岛区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1374', '山东省青岛市崂山区', '崂山区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1375', '山东省青岛市李沧区', '李沧区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1376', '山东省青岛市城阳区', '城阳区', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1377', '山东省青岛市胶州市', '胶州市', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1378', '山东省青岛市即墨市', '即墨市', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1379', '山东省青岛市平度市', '平度市', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1380', '山东省青岛市胶南市', '胶南市', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1381', '山东省青岛市莱西市', '莱西市', ',1357,1369,', '1369', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1382', '山东省淄博市', '淄博市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1383', '山东省淄博市淄川区', '淄川区', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1384', '山东省淄博市张店区', '张店区', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1385', '山东省淄博市博山区', '博山区', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1386', '山东省淄博市临淄区', '临淄区', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1387', '山东省淄博市周村区', '周村区', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1388', '山东省淄博市桓台县', '桓台县', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1389', '山东省淄博市高青县', '高青县', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1390', '山东省淄博市沂源县', '沂源县', ',1357,1382,', '1382', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1391', '山东省枣庄市', '枣庄市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1392', '山东省枣庄市市中区', '市中区', ',1357,1391,', '1391', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1393', '山东省枣庄市薛城区', '薛城区', ',1357,1391,', '1391', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1394', '山东省枣庄市峄城区', '峄城区', ',1357,1391,', '1391', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1395', '山东省枣庄市台儿庄区', '台儿庄区', ',1357,1391,', '1391', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1396', '山东省枣庄市山亭区', '山亭区', ',1357,1391,', '1391', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1397', '山东省枣庄市滕州市', '滕州市', ',1357,1391,', '1391', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1398', '山东省东营市', '东营市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1399', '山东省东营市东营区', '东营区', ',1357,1398,', '1398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1400', '山东省东营市河口区', '河口区', ',1357,1398,', '1398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1401', '山东省东营市垦利县', '垦利县', ',1357,1398,', '1398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1402', '山东省东营市利津县', '利津县', ',1357,1398,', '1398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1403', '山东省东营市广饶县', '广饶县', ',1357,1398,', '1398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1404', '山东省烟台市', '烟台市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1405', '山东省烟台市芝罘区', '芝罘区', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1406', '山东省烟台市福山区', '福山区', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1407', '山东省烟台市牟平区', '牟平区', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1408', '山东省烟台市莱山区', '莱山区', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1409', '山东省烟台市长岛县', '长岛县', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1410', '山东省烟台市龙口市', '龙口市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1411', '山东省烟台市莱阳市', '莱阳市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1412', '山东省烟台市莱州市', '莱州市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1413', '山东省烟台市蓬莱市', '蓬莱市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1414', '山东省烟台市招远市', '招远市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1415', '山东省烟台市栖霞市', '栖霞市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1416', '山东省烟台市海阳市', '海阳市', ',1357,1404,', '1404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1417', '山东省潍坊市', '潍坊市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1418', '山东省潍坊市潍城区', '潍城区', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1419', '山东省潍坊市寒亭区', '寒亭区', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1420', '山东省潍坊市坊子区', '坊子区', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1421', '山东省潍坊市奎文区', '奎文区', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1422', '山东省潍坊市临朐县', '临朐县', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1423', '山东省潍坊市昌乐县', '昌乐县', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1424', '山东省潍坊市青州市', '青州市', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1425', '山东省潍坊市诸城市', '诸城市', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1426', '山东省潍坊市寿光市', '寿光市', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1427', '山东省潍坊市安丘市', '安丘市', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1428', '山东省潍坊市高密市', '高密市', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1429', '山东省潍坊市昌邑市', '昌邑市', ',1357,1417,', '1417', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1430', '山东省济宁市', '济宁市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1431', '山东省济宁市市中区', '市中区', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1432', '山东省济宁市任城区', '任城区', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1433', '山东省济宁市微山县', '微山县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1434', '山东省济宁市鱼台县', '鱼台县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1435', '山东省济宁市金乡县', '金乡县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1436', '山东省济宁市嘉祥县', '嘉祥县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1437', '山东省济宁市汶上县', '汶上县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1438', '山东省济宁市泗水县', '泗水县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1439', '山东省济宁市梁山县', '梁山县', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1440', '山东省济宁市曲阜市', '曲阜市', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1441', '山东省济宁市兖州市', '兖州市', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1442', '山东省济宁市邹城市', '邹城市', ',1357,1430,', '1430', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1443', '山东省泰安市', '泰安市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1444', '山东省泰安市泰山区', '泰山区', ',1357,1443,', '1443', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1445', '山东省泰安市岱岳区', '岱岳区', ',1357,1443,', '1443', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1446', '山东省泰安市宁阳县', '宁阳县', ',1357,1443,', '1443', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1447', '山东省泰安市东平县', '东平县', ',1357,1443,', '1443', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1448', '山东省泰安市新泰市', '新泰市', ',1357,1443,', '1443', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1449', '山东省泰安市肥城市', '肥城市', ',1357,1443,', '1443', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1450', '山东省威海市', '威海市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1451', '山东省威海市环翠区', '环翠区', ',1357,1450,', '1450', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1452', '山东省威海市文登市', '文登市', ',1357,1450,', '1450', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1453', '山东省威海市荣成市', '荣成市', ',1357,1450,', '1450', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1454', '山东省威海市乳山市', '乳山市', ',1357,1450,', '1450', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1455', '山东省日照市', '日照市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1456', '山东省日照市东港区', '东港区', ',1357,1455,', '1455', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1457', '山东省日照市岚山区', '岚山区', ',1357,1455,', '1455', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1458', '山东省日照市五莲县', '五莲县', ',1357,1455,', '1455', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1459', '山东省日照市莒县', '莒县', ',1357,1455,', '1455', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1460', '山东省莱芜市', '莱芜市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1461', '山东省莱芜市莱城区', '莱城区', ',1357,1460,', '1460', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1462', '山东省莱芜市钢城区', '钢城区', ',1357,1460,', '1460', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1463', '山东省临沂市', '临沂市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1464', '山东省临沂市兰山区', '兰山区', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1465', '山东省临沂市罗庄区', '罗庄区', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1466', '山东省临沂市河东区', '河东区', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1467', '山东省临沂市沂南县', '沂南县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1468', '山东省临沂市郯城县', '郯城县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1469', '山东省临沂市沂水县', '沂水县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1470', '山东省临沂市苍山县', '苍山县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1471', '山东省临沂市费县', '费县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1472', '山东省临沂市平邑县', '平邑县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1473', '山东省临沂市莒南县', '莒南县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1474', '山东省临沂市蒙阴县', '蒙阴县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1475', '山东省临沂市临沭县', '临沭县', ',1357,1463,', '1463', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1476', '山东省德州市', '德州市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1477', '山东省德州市德城区', '德城区', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1478', '山东省德州市陵县', '陵县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1479', '山东省德州市宁津县', '宁津县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1480', '山东省德州市庆云县', '庆云县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1481', '山东省德州市临邑县', '临邑县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1482', '山东省德州市齐河县', '齐河县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1483', '山东省德州市平原县', '平原县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1484', '山东省德州市夏津县', '夏津县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1485', '山东省德州市武城县', '武城县', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1486', '山东省德州市乐陵市', '乐陵市', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1487', '山东省德州市禹城市', '禹城市', ',1357,1476,', '1476', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1488', '山东省聊城市', '聊城市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1489', '山东省聊城市东昌府区', '东昌府区', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1490', '山东省聊城市阳谷县', '阳谷县', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1491', '山东省聊城市莘县', '莘县', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1492', '山东省聊城市茌平县', '茌平县', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1493', '山东省聊城市东阿县', '东阿县', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1494', '山东省聊城市冠县', '冠县', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1495', '山东省聊城市高唐县', '高唐县', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1496', '山东省聊城市临清市', '临清市', ',1357,1488,', '1488', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1497', '山东省滨州市', '滨州市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1498', '山东省滨州市滨城区', '滨城区', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1499', '山东省滨州市惠民县', '惠民县', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1500', '山东省滨州市阳信县', '阳信县', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1501', '山东省滨州市无棣县', '无棣县', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1502', '山东省滨州市沾化县', '沾化县', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1503', '山东省滨州市博兴县', '博兴县', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1504', '山东省滨州市邹平县', '邹平县', ',1357,1497,', '1497', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1505', '山东省菏泽市', '菏泽市', ',1357,', '1357', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1506', '山东省菏泽市牡丹区', '牡丹区', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1507', '山东省菏泽市曹县', '曹县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1508', '山东省菏泽市单县', '单县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1509', '山东省菏泽市成武县', '成武县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1510', '山东省菏泽市巨野县', '巨野县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1511', '山东省菏泽市郓城县', '郓城县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1512', '山东省菏泽市鄄城县', '鄄城县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1513', '山东省菏泽市定陶县', '定陶县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1514', '山东省菏泽市东明县', '东明县', ',1357,1505,', '1505', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1515', '河南省', '河南省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1516', '河南省郑州市', '郑州市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1517', '河南省郑州市中原区', '中原区', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1518', '河南省郑州市二七区', '二七区', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1519', '河南省郑州市管城回族区', '管城回族区', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1520', '河南省郑州市金水区', '金水区', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1521', '河南省郑州市上街区', '上街区', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1522', '河南省郑州市惠济区', '惠济区', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1523', '河南省郑州市中牟县', '中牟县', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1524', '河南省郑州市巩义市', '巩义市', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1525', '河南省郑州市荥阳市', '荥阳市', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1526', '河南省郑州市新密市', '新密市', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1527', '河南省郑州市新郑市', '新郑市', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1528', '河南省郑州市登封市', '登封市', ',1515,1516,', '1516', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1529', '河南省开封市', '开封市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1530', '河南省开封市龙亭区', '龙亭区', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1531', '河南省开封市顺河回族区', '顺河回族区', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1532', '河南省开封市鼓楼区', '鼓楼区', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1533', '河南省开封市禹王台区', '禹王台区', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1534', '河南省开封市金明区', '金明区', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1535', '河南省开封市杞县', '杞县', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1536', '河南省开封市通许县', '通许县', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1537', '河南省开封市尉氏县', '尉氏县', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1538', '河南省开封市开封县', '开封县', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1539', '河南省开封市兰考县', '兰考县', ',1515,1529,', '1529', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1540', '河南省洛阳市', '洛阳市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1541', '河南省洛阳市老城区', '老城区', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1542', '河南省洛阳市西工区', '西工区', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1543', '河南省洛阳市瀍河回族区', '瀍河回族区', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1544', '河南省洛阳市涧西区', '涧西区', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1545', '河南省洛阳市吉利区', '吉利区', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1546', '河南省洛阳市洛龙区', '洛龙区', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1547', '河南省洛阳市孟津县', '孟津县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1548', '河南省洛阳市新安县', '新安县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1549', '河南省洛阳市栾川县', '栾川县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1550', '河南省洛阳市嵩县', '嵩县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1551', '河南省洛阳市汝阳县', '汝阳县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1552', '河南省洛阳市宜阳县', '宜阳县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1553', '河南省洛阳市洛宁县', '洛宁县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1554', '河南省洛阳市伊川县', '伊川县', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1555', '河南省洛阳市偃师市', '偃师市', ',1515,1540,', '1540', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1556', '河南省平顶山市', '平顶山市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1557', '河南省平顶山市新华区', '新华区', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1558', '河南省平顶山市卫东区', '卫东区', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1559', '河南省平顶山市石龙区', '石龙区', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1560', '河南省平顶山市湛河区', '湛河区', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1561', '河南省平顶山市宝丰县', '宝丰县', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1562', '河南省平顶山市叶县', '叶县', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1563', '河南省平顶山市鲁山县', '鲁山县', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1564', '河南省平顶山市郏县', '郏县', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1565', '河南省平顶山市舞钢市', '舞钢市', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1566', '河南省平顶山市汝州市', '汝州市', ',1515,1556,', '1556', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1567', '河南省安阳市', '安阳市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1568', '河南省安阳市文峰区', '文峰区', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1569', '河南省安阳市北关区', '北关区', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1570', '河南省安阳市殷都区', '殷都区', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1571', '河南省安阳市龙安区', '龙安区', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1572', '河南省安阳市安阳县', '安阳县', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1573', '河南省安阳市汤阴县', '汤阴县', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1574', '河南省安阳市滑县', '滑县', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1575', '河南省安阳市内黄县', '内黄县', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1576', '河南省安阳市林州市', '林州市', ',1515,1567,', '1567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1577', '河南省鹤壁市', '鹤壁市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1578', '河南省鹤壁市鹤山区', '鹤山区', ',1515,1577,', '1577', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1579', '河南省鹤壁市山城区', '山城区', ',1515,1577,', '1577', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1580', '河南省鹤壁市淇滨区', '淇滨区', ',1515,1577,', '1577', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1581', '河南省鹤壁市浚县', '浚县', ',1515,1577,', '1577', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1582', '河南省鹤壁市淇县', '淇县', ',1515,1577,', '1577', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1583', '河南省新乡市', '新乡市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1584', '河南省新乡市红旗区', '红旗区', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1585', '河南省新乡市卫滨区', '卫滨区', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1586', '河南省新乡市凤泉区', '凤泉区', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1587', '河南省新乡市牧野区', '牧野区', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1588', '河南省新乡市新乡县', '新乡县', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1589', '河南省新乡市获嘉县', '获嘉县', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1590', '河南省新乡市原阳县', '原阳县', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1591', '河南省新乡市延津县', '延津县', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1592', '河南省新乡市封丘县', '封丘县', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1593', '河南省新乡市长垣县', '长垣县', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1594', '河南省新乡市卫辉市', '卫辉市', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1595', '河南省新乡市辉县市', '辉县市', ',1515,1583,', '1583', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1596', '河南省焦作市', '焦作市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1597', '河南省焦作市解放区', '解放区', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1598', '河南省焦作市中站区', '中站区', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1599', '河南省焦作市马村区', '马村区', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1600', '河南省焦作市山阳区', '山阳区', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1601', '河南省焦作市修武县', '修武县', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1602', '河南省焦作市博爱县', '博爱县', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1603', '河南省焦作市武陟县', '武陟县', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1604', '河南省焦作市温县', '温县', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1605', '河南省焦作市沁阳市', '沁阳市', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1606', '河南省焦作市孟州市', '孟州市', ',1515,1596,', '1596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1607', '河南省濮阳市', '濮阳市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1608', '河南省濮阳市华龙区', '华龙区', ',1515,1607,', '1607', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1609', '河南省濮阳市清丰县', '清丰县', ',1515,1607,', '1607', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1610', '河南省濮阳市南乐县', '南乐县', ',1515,1607,', '1607', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1611', '河南省濮阳市范县', '范县', ',1515,1607,', '1607', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1612', '河南省濮阳市台前县', '台前县', ',1515,1607,', '1607', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1613', '河南省濮阳市濮阳县', '濮阳县', ',1515,1607,', '1607', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1614', '河南省许昌市', '许昌市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1615', '河南省许昌市魏都区', '魏都区', ',1515,1614,', '1614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1616', '河南省许昌市许昌县', '许昌县', ',1515,1614,', '1614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1617', '河南省许昌市鄢陵县', '鄢陵县', ',1515,1614,', '1614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1618', '河南省许昌市襄城县', '襄城县', ',1515,1614,', '1614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1619', '河南省许昌市禹州市', '禹州市', ',1515,1614,', '1614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1620', '河南省许昌市长葛市', '长葛市', ',1515,1614,', '1614', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1621', '河南省漯河市', '漯河市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1622', '河南省漯河市源汇区', '源汇区', ',1515,1621,', '1621', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1623', '河南省漯河市郾城区', '郾城区', ',1515,1621,', '1621', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1624', '河南省漯河市召陵区', '召陵区', ',1515,1621,', '1621', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1625', '河南省漯河市舞阳县', '舞阳县', ',1515,1621,', '1621', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1626', '河南省漯河市临颍县', '临颍县', ',1515,1621,', '1621', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1627', '河南省三门峡市', '三门峡市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1628', '河南省三门峡市湖滨区', '湖滨区', ',1515,1627,', '1627', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1629', '河南省三门峡市渑池县', '渑池县', ',1515,1627,', '1627', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1630', '河南省三门峡市陕县', '陕县', ',1515,1627,', '1627', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1631', '河南省三门峡市卢氏县', '卢氏县', ',1515,1627,', '1627', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1632', '河南省三门峡市义马市', '义马市', ',1515,1627,', '1627', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1633', '河南省三门峡市灵宝市', '灵宝市', ',1515,1627,', '1627', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1634', '河南省南阳市', '南阳市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1635', '河南省南阳市宛城区', '宛城区', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1636', '河南省南阳市卧龙区', '卧龙区', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1637', '河南省南阳市南召县', '南召县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1638', '河南省南阳市方城县', '方城县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1639', '河南省南阳市西峡县', '西峡县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1640', '河南省南阳市镇平县', '镇平县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1641', '河南省南阳市内乡县', '内乡县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1642', '河南省南阳市淅川县', '淅川县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1643', '河南省南阳市社旗县', '社旗县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1644', '河南省南阳市唐河县', '唐河县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1645', '河南省南阳市新野县', '新野县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1646', '河南省南阳市桐柏县', '桐柏县', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1647', '河南省南阳市邓州市', '邓州市', ',1515,1634,', '1634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1648', '河南省商丘市', '商丘市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1649', '河南省商丘市梁园区', '梁园区', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1650', '河南省商丘市睢阳区', '睢阳区', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1651', '河南省商丘市民权县', '民权县', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1652', '河南省商丘市睢县', '睢县', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1653', '河南省商丘市宁陵县', '宁陵县', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1654', '河南省商丘市柘城县', '柘城县', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1655', '河南省商丘市虞城县', '虞城县', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1656', '河南省商丘市夏邑县', '夏邑县', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1657', '河南省商丘市永城市', '永城市', ',1515,1648,', '1648', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1658', '河南省信阳市', '信阳市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1659', '河南省信阳市浉河区', '浉河区', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1660', '河南省信阳市平桥区', '平桥区', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1661', '河南省信阳市罗山县', '罗山县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1662', '河南省信阳市光山县', '光山县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1663', '河南省信阳市新县', '新县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1664', '河南省信阳市商城县', '商城县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1665', '河南省信阳市固始县', '固始县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1666', '河南省信阳市潢川县', '潢川县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1667', '河南省信阳市淮滨县', '淮滨县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1668', '河南省信阳市息县', '息县', ',1515,1658,', '1658', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1669', '河南省周口市', '周口市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1670', '河南省周口市川汇区', '川汇区', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1671', '河南省周口市扶沟县', '扶沟县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1672', '河南省周口市西华县', '西华县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1673', '河南省周口市商水县', '商水县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1674', '河南省周口市沈丘县', '沈丘县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1675', '河南省周口市郸城县', '郸城县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1676', '河南省周口市淮阳县', '淮阳县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1677', '河南省周口市太康县', '太康县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1678', '河南省周口市鹿邑县', '鹿邑县', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1679', '河南省周口市项城市', '项城市', ',1515,1669,', '1669', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1680', '河南省驻马店市', '驻马店市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1681', '河南省驻马店市驿城区', '驿城区', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1682', '河南省驻马店市西平县', '西平县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1683', '河南省驻马店市上蔡县', '上蔡县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1684', '河南省驻马店市平舆县', '平舆县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1685', '河南省驻马店市正阳县', '正阳县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1686', '河南省驻马店市确山县', '确山县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1687', '河南省驻马店市泌阳县', '泌阳县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1688', '河南省驻马店市汝南县', '汝南县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1689', '河南省驻马店市遂平县', '遂平县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1690', '河南省驻马店市新蔡县', '新蔡县', ',1515,1680,', '1680', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1691', '河南省济源市', '济源市', ',1515,', '1515', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1692', '湖北省', '湖北省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1693', '湖北省武汉市', '武汉市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1694', '湖北省武汉市江岸区', '江岸区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1695', '湖北省武汉市江汉区', '江汉区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1696', '湖北省武汉市硚口区', '硚口区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1697', '湖北省武汉市汉阳区', '汉阳区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1698', '湖北省武汉市武昌区', '武昌区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1699', '湖北省武汉市青山区', '青山区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1700', '湖北省武汉市洪山区', '洪山区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1701', '湖北省武汉市东西湖区', '东西湖区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1702', '湖北省武汉市汉南区', '汉南区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1703', '湖北省武汉市蔡甸区', '蔡甸区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1704', '湖北省武汉市江夏区', '江夏区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1705', '湖北省武汉市黄陂区', '黄陂区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1706', '湖北省武汉市新洲区', '新洲区', ',1692,1693,', '1693', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1707', '湖北省黄石市', '黄石市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1708', '湖北省黄石市黄石港区', '黄石港区', ',1692,1707,', '1707', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1709', '湖北省黄石市西塞山区', '西塞山区', ',1692,1707,', '1707', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1710', '湖北省黄石市下陆区', '下陆区', ',1692,1707,', '1707', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1711', '湖北省黄石市铁山区', '铁山区', ',1692,1707,', '1707', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1712', '湖北省黄石市阳新县', '阳新县', ',1692,1707,', '1707', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1713', '湖北省黄石市大冶市', '大冶市', ',1692,1707,', '1707', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1714', '湖北省十堰市', '十堰市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1715', '湖北省十堰市茅箭区', '茅箭区', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1716', '湖北省十堰市张湾区', '张湾区', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1717', '湖北省十堰市郧县', '郧县', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1718', '湖北省十堰市郧西县', '郧西县', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1719', '湖北省十堰市竹山县', '竹山县', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1720', '湖北省十堰市竹溪县', '竹溪县', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1721', '湖北省十堰市房县', '房县', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1722', '湖北省十堰市丹江口市', '丹江口市', ',1692,1714,', '1714', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1723', '湖北省宜昌市', '宜昌市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1724', '湖北省宜昌市西陵区', '西陵区', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1725', '湖北省宜昌市伍家岗区', '伍家岗区', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1726', '湖北省宜昌市点军区', '点军区', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1727', '湖北省宜昌市猇亭区', '猇亭区', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1728', '湖北省宜昌市夷陵区', '夷陵区', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1729', '湖北省宜昌市远安县', '远安县', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1730', '湖北省宜昌市兴山县', '兴山县', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1731', '湖北省宜昌市秭归县', '秭归县', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1732', '湖北省宜昌市长阳土家族自治县', '长阳土家族自治县', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1733', '湖北省宜昌市五峰土家族自治县', '五峰土家族自治县', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1734', '湖北省宜昌市宜都市', '宜都市', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1735', '湖北省宜昌市当阳市', '当阳市', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1736', '湖北省宜昌市枝江市', '枝江市', ',1692,1723,', '1723', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1737', '湖北省襄阳市', '襄阳市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1738', '湖北省襄阳市襄城区', '襄城区', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1739', '湖北省襄阳市樊城区', '樊城区', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1740', '湖北省襄阳市襄州区', '襄州区', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1741', '湖北省襄阳市南漳县', '南漳县', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1742', '湖北省襄阳市谷城县', '谷城县', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1743', '湖北省襄阳市保康县', '保康县', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1744', '湖北省襄阳市老河口市', '老河口市', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1745', '湖北省襄阳市枣阳市', '枣阳市', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1746', '湖北省襄阳市宜城市', '宜城市', ',1692,1737,', '1737', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1747', '湖北省鄂州市', '鄂州市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1748', '湖北省鄂州市梁子湖区', '梁子湖区', ',1692,1747,', '1747', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1749', '湖北省鄂州市华容区', '华容区', ',1692,1747,', '1747', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1750', '湖北省鄂州市鄂城区', '鄂城区', ',1692,1747,', '1747', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1751', '湖北省荆门市', '荆门市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1752', '湖北省荆门市东宝区', '东宝区', ',1692,1751,', '1751', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1753', '湖北省荆门市掇刀区', '掇刀区', ',1692,1751,', '1751', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1754', '湖北省荆门市京山县', '京山县', ',1692,1751,', '1751', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1755', '湖北省荆门市沙洋县', '沙洋县', ',1692,1751,', '1751', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1756', '湖北省荆门市钟祥市', '钟祥市', ',1692,1751,', '1751', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1757', '湖北省孝感市', '孝感市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1758', '湖北省孝感市孝南区', '孝南区', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1759', '湖北省孝感市孝昌县', '孝昌县', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1760', '湖北省孝感市大悟县', '大悟县', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1761', '湖北省孝感市云梦县', '云梦县', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1762', '湖北省孝感市应城市', '应城市', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1763', '湖北省孝感市安陆市', '安陆市', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1764', '湖北省孝感市汉川市', '汉川市', ',1692,1757,', '1757', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1765', '湖北省荆州市', '荆州市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1766', '湖北省荆州市沙市区', '沙市区', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1767', '湖北省荆州市荆州区', '荆州区', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1768', '湖北省荆州市公安县', '公安县', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1769', '湖北省荆州市监利县', '监利县', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1770', '湖北省荆州市江陵县', '江陵县', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1771', '湖北省荆州市石首市', '石首市', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1772', '湖北省荆州市洪湖市', '洪湖市', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1773', '湖北省荆州市松滋市', '松滋市', ',1692,1765,', '1765', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1774', '湖北省黄冈市', '黄冈市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1775', '湖北省黄冈市黄州区', '黄州区', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1776', '湖北省黄冈市团风县', '团风县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1777', '湖北省黄冈市红安县', '红安县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1778', '湖北省黄冈市罗田县', '罗田县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1779', '湖北省黄冈市英山县', '英山县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1780', '湖北省黄冈市浠水县', '浠水县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1781', '湖北省黄冈市蕲春县', '蕲春县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1782', '湖北省黄冈市黄梅县', '黄梅县', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1783', '湖北省黄冈市麻城市', '麻城市', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1784', '湖北省黄冈市武穴市', '武穴市', ',1692,1774,', '1774', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1785', '湖北省咸宁市', '咸宁市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1786', '湖北省咸宁市咸安区', '咸安区', ',1692,1785,', '1785', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1787', '湖北省咸宁市嘉鱼县', '嘉鱼县', ',1692,1785,', '1785', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1788', '湖北省咸宁市通城县', '通城县', ',1692,1785,', '1785', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1789', '湖北省咸宁市崇阳县', '崇阳县', ',1692,1785,', '1785', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1790', '湖北省咸宁市通山县', '通山县', ',1692,1785,', '1785', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1791', '湖北省咸宁市赤壁市', '赤壁市', ',1692,1785,', '1785', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1792', '湖北省随州市', '随州市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1793', '湖北省随州市曾都区', '曾都区', ',1692,1792,', '1792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1794', '湖北省随州市随县', '随县', ',1692,1792,', '1792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1795', '湖北省随州市广水市', '广水市', ',1692,1792,', '1792', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1796', '湖北省恩施土家族苗族自治州', '恩施土家族苗族自治州', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1797', '湖北省恩施土家族苗族自治州恩施市', '恩施市', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1798', '湖北省恩施土家族苗族自治州利川市', '利川市', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1799', '湖北省恩施土家族苗族自治州建始县', '建始县', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1800', '湖北省恩施土家族苗族自治州巴东县', '巴东县', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1801', '湖北省恩施土家族苗族自治州宣恩县', '宣恩县', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1802', '湖北省恩施土家族苗族自治州咸丰县', '咸丰县', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1803', '湖北省恩施土家族苗族自治州来凤县', '来凤县', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1804', '湖北省恩施土家族苗族自治州鹤峰县', '鹤峰县', ',1692,1796,', '1796', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1805', '湖北省仙桃市', '仙桃市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1806', '湖北省潜江市', '潜江市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1807', '湖北省天门市', '天门市', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1808', '湖北省神农架林区', '神农架林区', ',1692,', '1692', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1809', '湖南省', '湖南省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1810', '湖南省长沙市', '长沙市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1811', '湖南省长沙市芙蓉区', '芙蓉区', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1812', '湖南省长沙市天心区', '天心区', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1813', '湖南省长沙市岳麓区', '岳麓区', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1814', '湖南省长沙市开福区', '开福区', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1815', '湖南省长沙市雨花区', '雨花区', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1816', '湖南省长沙市望城区', '望城区', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1817', '湖南省长沙市长沙县', '长沙县', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1818', '湖南省长沙市宁乡县', '宁乡县', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1819', '湖南省长沙市浏阳市', '浏阳市', ',1809,1810,', '1810', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1820', '湖南省株洲市', '株洲市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1821', '湖南省株洲市荷塘区', '荷塘区', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1822', '湖南省株洲市芦淞区', '芦淞区', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1823', '湖南省株洲市石峰区', '石峰区', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1824', '湖南省株洲市天元区', '天元区', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1825', '湖南省株洲市株洲县', '株洲县', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1826', '湖南省株洲市攸县', '攸县', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1827', '湖南省株洲市茶陵县', '茶陵县', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1828', '湖南省株洲市炎陵县', '炎陵县', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1829', '湖南省株洲市醴陵市', '醴陵市', ',1809,1820,', '1820', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1830', '湖南省湘潭市', '湘潭市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1831', '湖南省湘潭市雨湖区', '雨湖区', ',1809,1830,', '1830', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1832', '湖南省湘潭市岳塘区', '岳塘区', ',1809,1830,', '1830', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1833', '湖南省湘潭市湘潭县', '湘潭县', ',1809,1830,', '1830', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1834', '湖南省湘潭市湘乡市', '湘乡市', ',1809,1830,', '1830', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1835', '湖南省湘潭市韶山市', '韶山市', ',1809,1830,', '1830', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1836', '湖南省衡阳市', '衡阳市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1837', '湖南省衡阳市珠晖区', '珠晖区', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1838', '湖南省衡阳市雁峰区', '雁峰区', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1839', '湖南省衡阳市石鼓区', '石鼓区', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1840', '湖南省衡阳市蒸湘区', '蒸湘区', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1841', '湖南省衡阳市南岳区', '南岳区', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1842', '湖南省衡阳市衡阳县', '衡阳县', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1843', '湖南省衡阳市衡南县', '衡南县', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1844', '湖南省衡阳市衡山县', '衡山县', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1845', '湖南省衡阳市衡东县', '衡东县', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1846', '湖南省衡阳市祁东县', '祁东县', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1847', '湖南省衡阳市耒阳市', '耒阳市', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1848', '湖南省衡阳市常宁市', '常宁市', ',1809,1836,', '1836', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1849', '湖南省邵阳市', '邵阳市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1850', '湖南省邵阳市双清区', '双清区', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1851', '湖南省邵阳市大祥区', '大祥区', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1852', '湖南省邵阳市北塔区', '北塔区', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1853', '湖南省邵阳市邵东县', '邵东县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1854', '湖南省邵阳市新邵县', '新邵县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1855', '湖南省邵阳市邵阳县', '邵阳县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1856', '湖南省邵阳市隆回县', '隆回县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1857', '湖南省邵阳市洞口县', '洞口县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1858', '湖南省邵阳市绥宁县', '绥宁县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1859', '湖南省邵阳市新宁县', '新宁县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1860', '湖南省邵阳市城步苗族自治县', '城步苗族自治县', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1861', '湖南省邵阳市武冈市', '武冈市', ',1809,1849,', '1849', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1862', '湖南省岳阳市', '岳阳市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1863', '湖南省岳阳市岳阳楼区', '岳阳楼区', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1864', '湖南省岳阳市云溪区', '云溪区', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1865', '湖南省岳阳市君山区', '君山区', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1866', '湖南省岳阳市岳阳县', '岳阳县', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1867', '湖南省岳阳市华容县', '华容县', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1868', '湖南省岳阳市湘阴县', '湘阴县', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1869', '湖南省岳阳市平江县', '平江县', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1870', '湖南省岳阳市汨罗市', '汨罗市', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1871', '湖南省岳阳市临湘市', '临湘市', ',1809,1862,', '1862', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1872', '湖南省常德市', '常德市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1873', '湖南省常德市武陵区', '武陵区', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1874', '湖南省常德市鼎城区', '鼎城区', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1875', '湖南省常德市安乡县', '安乡县', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1876', '湖南省常德市汉寿县', '汉寿县', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1877', '湖南省常德市澧县', '澧县', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1878', '湖南省常德市临澧县', '临澧县', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1879', '湖南省常德市桃源县', '桃源县', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1880', '湖南省常德市石门县', '石门县', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1881', '湖南省常德市津市市', '津市市', ',1809,1872,', '1872', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1882', '湖南省张家界市', '张家界市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1883', '湖南省张家界市永定区', '永定区', ',1809,1882,', '1882', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1884', '湖南省张家界市武陵源区', '武陵源区', ',1809,1882,', '1882', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1885', '湖南省张家界市慈利县', '慈利县', ',1809,1882,', '1882', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1886', '湖南省张家界市桑植县', '桑植县', ',1809,1882,', '1882', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1887', '湖南省益阳市', '益阳市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1888', '湖南省益阳市资阳区', '资阳区', ',1809,1887,', '1887', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1889', '湖南省益阳市赫山区', '赫山区', ',1809,1887,', '1887', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1890', '湖南省益阳市南县', '南县', ',1809,1887,', '1887', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1891', '湖南省益阳市桃江县', '桃江县', ',1809,1887,', '1887', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1892', '湖南省益阳市安化县', '安化县', ',1809,1887,', '1887', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1893', '湖南省益阳市沅江市', '沅江市', ',1809,1887,', '1887', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1894', '湖南省郴州市', '郴州市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1895', '湖南省郴州市北湖区', '北湖区', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1896', '湖南省郴州市苏仙区', '苏仙区', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1897', '湖南省郴州市桂阳县', '桂阳县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1898', '湖南省郴州市宜章县', '宜章县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1899', '湖南省郴州市永兴县', '永兴县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1900', '湖南省郴州市嘉禾县', '嘉禾县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1901', '湖南省郴州市临武县', '临武县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1902', '湖南省郴州市汝城县', '汝城县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1903', '湖南省郴州市桂东县', '桂东县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1904', '湖南省郴州市安仁县', '安仁县', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1905', '湖南省郴州市资兴市', '资兴市', ',1809,1894,', '1894', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1906', '湖南省永州市', '永州市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1907', '湖南省永州市零陵区', '零陵区', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1908', '湖南省永州市冷水滩区', '冷水滩区', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1909', '湖南省永州市祁阳县', '祁阳县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1910', '湖南省永州市东安县', '东安县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1911', '湖南省永州市双牌县', '双牌县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1912', '湖南省永州市道县', '道县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1913', '湖南省永州市江永县', '江永县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1914', '湖南省永州市宁远县', '宁远县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1915', '湖南省永州市蓝山县', '蓝山县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1916', '湖南省永州市新田县', '新田县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1917', '湖南省永州市江华瑶族自治县', '江华瑶族自治县', ',1809,1906,', '1906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1918', '湖南省怀化市', '怀化市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1919', '湖南省怀化市鹤城区', '鹤城区', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1920', '湖南省怀化市中方县', '中方县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1921', '湖南省怀化市沅陵县', '沅陵县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1922', '湖南省怀化市辰溪县', '辰溪县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1923', '湖南省怀化市溆浦县', '溆浦县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1924', '湖南省怀化市会同县', '会同县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1925', '湖南省怀化市麻阳苗族自治县', '麻阳苗族自治县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1926', '湖南省怀化市新晃侗族自治县', '新晃侗族自治县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1927', '湖南省怀化市芷江侗族自治县', '芷江侗族自治县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1928', '湖南省怀化市靖州苗族侗族自治县', '靖州苗族侗族自治县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1929', '湖南省怀化市通道侗族自治县', '通道侗族自治县', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1930', '湖南省怀化市洪江市', '洪江市', ',1809,1918,', '1918', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1931', '湖南省娄底市', '娄底市', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1932', '湖南省娄底市娄星区', '娄星区', ',1809,1931,', '1931', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1933', '湖南省娄底市双峰县', '双峰县', ',1809,1931,', '1931', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1934', '湖南省娄底市新化县', '新化县', ',1809,1931,', '1931', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1935', '湖南省娄底市冷水江市', '冷水江市', ',1809,1931,', '1931', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1936', '湖南省娄底市涟源市', '涟源市', ',1809,1931,', '1931', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1937', '湖南省湘西土家族苗族自治州', '湘西土家族苗族自治州', ',1809,', '1809', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1938', '湖南省湘西土家族苗族自治州吉首市', '吉首市', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1939', '湖南省湘西土家族苗族自治州泸溪县', '泸溪县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1940', '湖南省湘西土家族苗族自治州凤凰县', '凤凰县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1941', '湖南省湘西土家族苗族自治州花垣县', '花垣县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1942', '湖南省湘西土家族苗族自治州保靖县', '保靖县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1943', '湖南省湘西土家族苗族自治州古丈县', '古丈县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1944', '湖南省湘西土家族苗族自治州永顺县', '永顺县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1945', '湖南省湘西土家族苗族自治州龙山县', '龙山县', ',1809,1937,', '1937', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1946', '广东省', '广东省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1947', '广东省广州市', '广州市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1948', '广东省广州市荔湾区', '荔湾区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1949', '广东省广州市越秀区', '越秀区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1950', '广东省广州市海珠区', '海珠区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1951', '广东省广州市天河区', '天河区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1952', '广东省广州市白云区', '白云区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1953', '广东省广州市黄埔区', '黄埔区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1954', '广东省广州市番禺区', '番禺区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1955', '广东省广州市花都区', '花都区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1956', '广东省广州市南沙区', '南沙区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1957', '广东省广州市萝岗区', '萝岗区', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1958', '广东省广州市增城市', '增城市', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1959', '广东省广州市从化市', '从化市', ',1946,1947,', '1947', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1960', '广东省韶关市', '韶关市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1961', '广东省韶关市武江区', '武江区', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1962', '广东省韶关市浈江区', '浈江区', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1963', '广东省韶关市曲江区', '曲江区', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1964', '广东省韶关市始兴县', '始兴县', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1965', '广东省韶关市仁化县', '仁化县', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1966', '广东省韶关市翁源县', '翁源县', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1967', '广东省韶关市乳源瑶族自治县', '乳源瑶族自治县', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1968', '广东省韶关市新丰县', '新丰县', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1969', '广东省韶关市乐昌市', '乐昌市', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1970', '广东省韶关市南雄市', '南雄市', ',1946,1960,', '1960', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1971', '广东省深圳市', '深圳市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1972', '广东省深圳市罗湖区', '罗湖区', ',1946,1971,', '1971', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1973', '广东省深圳市福田区', '福田区', ',1946,1971,', '1971', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1974', '广东省深圳市南山区', '南山区', ',1946,1971,', '1971', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1975', '广东省深圳市宝安区', '宝安区', ',1946,1971,', '1971', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1976', '广东省深圳市龙岗区', '龙岗区', ',1946,1971,', '1971', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1977', '广东省深圳市盐田区', '盐田区', ',1946,1971,', '1971', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1978', '广东省珠海市', '珠海市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1979', '广东省珠海市香洲区', '香洲区', ',1946,1978,', '1978', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1980', '广东省珠海市斗门区', '斗门区', ',1946,1978,', '1978', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1981', '广东省珠海市金湾区', '金湾区', ',1946,1978,', '1978', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1982', '广东省汕头市', '汕头市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1983', '广东省汕头市龙湖区', '龙湖区', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1984', '广东省汕头市金平区', '金平区', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1985', '广东省汕头市濠江区', '濠江区', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1986', '广东省汕头市潮阳区', '潮阳区', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1987', '广东省汕头市潮南区', '潮南区', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1988', '广东省汕头市澄海区', '澄海区', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1989', '广东省汕头市南澳县', '南澳县', ',1946,1982,', '1982', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1990', '广东省佛山市', '佛山市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1991', '广东省佛山市禅城区', '禅城区', ',1946,1990,', '1990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1992', '广东省佛山市南海区', '南海区', ',1946,1990,', '1990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1993', '广东省佛山市顺德区', '顺德区', ',1946,1990,', '1990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1994', '广东省佛山市三水区', '三水区', ',1946,1990,', '1990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1995', '广东省佛山市高明区', '高明区', ',1946,1990,', '1990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1996', '广东省江门市', '江门市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1997', '广东省江门市蓬江区', '蓬江区', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1998', '广东省江门市江海区', '江海区', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('1999', '广东省江门市新会区', '新会区', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2000', '广东省江门市台山市', '台山市', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2001', '广东省江门市开平市', '开平市', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2002', '广东省江门市鹤山市', '鹤山市', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2003', '广东省江门市恩平市', '恩平市', ',1946,1996,', '1996', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2004', '广东省湛江市', '湛江市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2005', '广东省湛江市赤坎区', '赤坎区', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2006', '广东省湛江市霞山区', '霞山区', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2007', '广东省湛江市坡头区', '坡头区', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2008', '广东省湛江市麻章区', '麻章区', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2009', '广东省湛江市遂溪县', '遂溪县', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2010', '广东省湛江市徐闻县', '徐闻县', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2011', '广东省湛江市廉江市', '廉江市', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2012', '广东省湛江市雷州市', '雷州市', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2013', '广东省湛江市吴川市', '吴川市', ',1946,2004,', '2004', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2014', '广东省茂名市', '茂名市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2015', '广东省茂名市茂南区', '茂南区', ',1946,2014,', '2014', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2016', '广东省茂名市茂港区', '茂港区', ',1946,2014,', '2014', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2017', '广东省茂名市电白县', '电白县', ',1946,2014,', '2014', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2018', '广东省茂名市高州市', '高州市', ',1946,2014,', '2014', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2019', '广东省茂名市化州市', '化州市', ',1946,2014,', '2014', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2020', '广东省茂名市信宜市', '信宜市', ',1946,2014,', '2014', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2021', '广东省肇庆市', '肇庆市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2022', '广东省肇庆市端州区', '端州区', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2023', '广东省肇庆市鼎湖区', '鼎湖区', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2024', '广东省肇庆市广宁县', '广宁县', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2025', '广东省肇庆市怀集县', '怀集县', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2026', '广东省肇庆市封开县', '封开县', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2027', '广东省肇庆市德庆县', '德庆县', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2028', '广东省肇庆市高要市', '高要市', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2029', '广东省肇庆市四会市', '四会市', ',1946,2021,', '2021', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2030', '广东省惠州市', '惠州市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2031', '广东省惠州市惠城区', '惠城区', ',1946,2030,', '2030', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2032', '广东省惠州市惠阳区', '惠阳区', ',1946,2030,', '2030', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2033', '广东省惠州市博罗县', '博罗县', ',1946,2030,', '2030', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2034', '广东省惠州市惠东县', '惠东县', ',1946,2030,', '2030', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2035', '广东省惠州市龙门县', '龙门县', ',1946,2030,', '2030', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2036', '广东省梅州市', '梅州市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2037', '广东省梅州市梅江区', '梅江区', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2038', '广东省梅州市梅县', '梅县', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2039', '广东省梅州市大埔县', '大埔县', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2040', '广东省梅州市丰顺县', '丰顺县', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2041', '广东省梅州市五华县', '五华县', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2042', '广东省梅州市平远县', '平远县', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2043', '广东省梅州市蕉岭县', '蕉岭县', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2044', '广东省梅州市兴宁市', '兴宁市', ',1946,2036,', '2036', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2045', '广东省汕尾市', '汕尾市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2046', '广东省汕尾市城区', '城区', ',1946,2045,', '2045', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2047', '广东省汕尾市海丰县', '海丰县', ',1946,2045,', '2045', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2048', '广东省汕尾市陆河县', '陆河县', ',1946,2045,', '2045', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2049', '广东省汕尾市陆丰市', '陆丰市', ',1946,2045,', '2045', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2050', '广东省河源市', '河源市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2051', '广东省河源市源城区', '源城区', ',1946,2050,', '2050', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2052', '广东省河源市紫金县', '紫金县', ',1946,2050,', '2050', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2053', '广东省河源市龙川县', '龙川县', ',1946,2050,', '2050', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2054', '广东省河源市连平县', '连平县', ',1946,2050,', '2050', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2055', '广东省河源市和平县', '和平县', ',1946,2050,', '2050', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2056', '广东省河源市东源县', '东源县', ',1946,2050,', '2050', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2057', '广东省阳江市', '阳江市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2058', '广东省阳江市江城区', '江城区', ',1946,2057,', '2057', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2059', '广东省阳江市阳西县', '阳西县', ',1946,2057,', '2057', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2060', '广东省阳江市阳东县', '阳东县', ',1946,2057,', '2057', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2061', '广东省阳江市阳春市', '阳春市', ',1946,2057,', '2057', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2062', '广东省清远市', '清远市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2063', '广东省清远市清城区', '清城区', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2064', '广东省清远市佛冈县', '佛冈县', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2065', '广东省清远市阳山县', '阳山县', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2066', '广东省清远市连山壮族瑶族自治县', '连山壮族瑶族自治县', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2067', '广东省清远市连南瑶族自治县', '连南瑶族自治县', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2068', '广东省清远市清新县', '清新县', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2069', '广东省清远市英德市', '英德市', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2070', '广东省清远市连州市', '连州市', ',1946,2062,', '2062', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2071', '广东省东莞市', '东莞市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2072', '广东省中山市', '中山市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2073', '广东省潮州市', '潮州市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2074', '广东省潮州市湘桥区', '湘桥区', ',1946,2073,', '2073', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2075', '广东省潮州市潮安县', '潮安县', ',1946,2073,', '2073', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2076', '广东省潮州市饶平县', '饶平县', ',1946,2073,', '2073', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2077', '广东省揭阳市', '揭阳市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2078', '广东省揭阳市榕城区', '榕城区', ',1946,2077,', '2077', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2079', '广东省揭阳市揭东县', '揭东县', ',1946,2077,', '2077', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2080', '广东省揭阳市揭西县', '揭西县', ',1946,2077,', '2077', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2081', '广东省揭阳市惠来县', '惠来县', ',1946,2077,', '2077', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2082', '广东省揭阳市普宁市', '普宁市', ',1946,2077,', '2077', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2083', '广东省云浮市', '云浮市', ',1946,', '1946', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2084', '广东省云浮市云城区', '云城区', ',1946,2083,', '2083', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2085', '广东省云浮市新兴县', '新兴县', ',1946,2083,', '2083', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2086', '广东省云浮市郁南县', '郁南县', ',1946,2083,', '2083', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2087', '广东省云浮市云安县', '云安县', ',1946,2083,', '2083', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2088', '广东省云浮市罗定市', '罗定市', ',1946,2083,', '2083', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2089', '广西壮族自治区', '广西壮族自治区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2090', '广西壮族自治区南宁市', '南宁市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2091', '广西壮族自治区南宁市兴宁区', '兴宁区', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2092', '广西壮族自治区南宁市青秀区', '青秀区', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2093', '广西壮族自治区南宁市江南区', '江南区', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2094', '广西壮族自治区南宁市西乡塘区', '西乡塘区', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2095', '广西壮族自治区南宁市良庆区', '良庆区', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2096', '广西壮族自治区南宁市邕宁区', '邕宁区', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2097', '广西壮族自治区南宁市武鸣县', '武鸣县', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2098', '广西壮族自治区南宁市隆安县', '隆安县', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2099', '广西壮族自治区南宁市马山县', '马山县', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2100', '广西壮族自治区南宁市上林县', '上林县', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2101', '广西壮族自治区南宁市宾阳县', '宾阳县', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2102', '广西壮族自治区南宁市横县', '横县', ',2089,2090,', '2090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2103', '广西壮族自治区柳州市', '柳州市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2104', '广西壮族自治区柳州市城中区', '城中区', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2105', '广西壮族自治区柳州市鱼峰区', '鱼峰区', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2106', '广西壮族自治区柳州市柳南区', '柳南区', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2107', '广西壮族自治区柳州市柳北区', '柳北区', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2108', '广西壮族自治区柳州市柳江县', '柳江县', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2109', '广西壮族自治区柳州市柳城县', '柳城县', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2110', '广西壮族自治区柳州市鹿寨县', '鹿寨县', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2111', '广西壮族自治区柳州市融安县', '融安县', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2112', '广西壮族自治区柳州市融水苗族自治县', '融水苗族自治县', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2113', '广西壮族自治区柳州市三江侗族自治县', '三江侗族自治县', ',2089,2103,', '2103', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2114', '广西壮族自治区桂林市', '桂林市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2115', '广西壮族自治区桂林市秀峰区', '秀峰区', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2116', '广西壮族自治区桂林市叠彩区', '叠彩区', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2117', '广西壮族自治区桂林市象山区', '象山区', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2118', '广西壮族自治区桂林市七星区', '七星区', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2119', '广西壮族自治区桂林市雁山区', '雁山区', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2120', '广西壮族自治区桂林市阳朔县', '阳朔县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2121', '广西壮族自治区桂林市临桂县', '临桂县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2122', '广西壮族自治区桂林市灵川县', '灵川县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2123', '广西壮族自治区桂林市全州县', '全州县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2124', '广西壮族自治区桂林市兴安县', '兴安县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2125', '广西壮族自治区桂林市永福县', '永福县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2126', '广西壮族自治区桂林市灌阳县', '灌阳县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2127', '广西壮族自治区桂林市龙胜各族自治县', '龙胜各族自治县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2128', '广西壮族自治区桂林市资源县', '资源县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2129', '广西壮族自治区桂林市平乐县', '平乐县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2130', '广西壮族自治区桂林市荔浦县', '荔浦县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2131', '广西壮族自治区桂林市恭城瑶族自治县', '恭城瑶族自治县', ',2089,2114,', '2114', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2132', '广西壮族自治区梧州市', '梧州市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2133', '广西壮族自治区梧州市万秀区', '万秀区', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2134', '广西壮族自治区梧州市蝶山区', '蝶山区', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2135', '广西壮族自治区梧州市长洲区', '长洲区', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2136', '广西壮族自治区梧州市苍梧县', '苍梧县', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2137', '广西壮族自治区梧州市藤县', '藤县', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2138', '广西壮族自治区梧州市蒙山县', '蒙山县', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2139', '广西壮族自治区梧州市岑溪市', '岑溪市', ',2089,2132,', '2132', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2140', '广西壮族自治区北海市', '北海市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2141', '广西壮族自治区北海市海城区', '海城区', ',2089,2140,', '2140', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2142', '广西壮族自治区北海市银海区', '银海区', ',2089,2140,', '2140', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2143', '广西壮族自治区北海市铁山港区', '铁山港区', ',2089,2140,', '2140', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2144', '广西壮族自治区北海市合浦县', '合浦县', ',2089,2140,', '2140', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2145', '广西壮族自治区防城港市', '防城港市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2146', '广西壮族自治区防城港市港口区', '港口区', ',2089,2145,', '2145', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2147', '广西壮族自治区防城港市防城区', '防城区', ',2089,2145,', '2145', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2148', '广西壮族自治区防城港市上思县', '上思县', ',2089,2145,', '2145', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2149', '广西壮族自治区防城港市东兴市', '东兴市', ',2089,2145,', '2145', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2150', '广西壮族自治区钦州市', '钦州市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2151', '广西壮族自治区钦州市钦南区', '钦南区', ',2089,2150,', '2150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2152', '广西壮族自治区钦州市钦北区', '钦北区', ',2089,2150,', '2150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2153', '广西壮族自治区钦州市灵山县', '灵山县', ',2089,2150,', '2150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2154', '广西壮族自治区钦州市浦北县', '浦北县', ',2089,2150,', '2150', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2155', '广西壮族自治区贵港市', '贵港市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2156', '广西壮族自治区贵港市港北区', '港北区', ',2089,2155,', '2155', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2157', '广西壮族自治区贵港市港南区', '港南区', ',2089,2155,', '2155', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2158', '广西壮族自治区贵港市覃塘区', '覃塘区', ',2089,2155,', '2155', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2159', '广西壮族自治区贵港市平南县', '平南县', ',2089,2155,', '2155', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2160', '广西壮族自治区贵港市桂平市', '桂平市', ',2089,2155,', '2155', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2161', '广西壮族自治区玉林市', '玉林市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2162', '广西壮族自治区玉林市玉州区', '玉州区', ',2089,2161,', '2161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2163', '广西壮族自治区玉林市容县', '容县', ',2089,2161,', '2161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2164', '广西壮族自治区玉林市陆川县', '陆川县', ',2089,2161,', '2161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2165', '广西壮族自治区玉林市博白县', '博白县', ',2089,2161,', '2161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2166', '广西壮族自治区玉林市兴业县', '兴业县', ',2089,2161,', '2161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2167', '广西壮族自治区玉林市北流市', '北流市', ',2089,2161,', '2161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2168', '广西壮族自治区百色市', '百色市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2169', '广西壮族自治区百色市右江区', '右江区', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2170', '广西壮族自治区百色市田阳县', '田阳县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2171', '广西壮族自治区百色市田东县', '田东县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2172', '广西壮族自治区百色市平果县', '平果县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2173', '广西壮族自治区百色市德保县', '德保县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2174', '广西壮族自治区百色市靖西县', '靖西县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2175', '广西壮族自治区百色市那坡县', '那坡县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2176', '广西壮族自治区百色市凌云县', '凌云县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2177', '广西壮族自治区百色市乐业县', '乐业县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2178', '广西壮族自治区百色市田林县', '田林县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2179', '广西壮族自治区百色市西林县', '西林县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2180', '广西壮族自治区百色市隆林各族自治县', '隆林各族自治县', ',2089,2168,', '2168', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2181', '广西壮族自治区贺州市', '贺州市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2182', '广西壮族自治区贺州市八步区', '八步区', ',2089,2181,', '2181', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2183', '广西壮族自治区贺州市昭平县', '昭平县', ',2089,2181,', '2181', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2184', '广西壮族自治区贺州市钟山县', '钟山县', ',2089,2181,', '2181', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2185', '广西壮族自治区贺州市富川瑶族自治县', '富川瑶族自治县', ',2089,2181,', '2181', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2186', '广西壮族自治区河池市', '河池市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2187', '广西壮族自治区河池市金城江区', '金城江区', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2188', '广西壮族自治区河池市南丹县', '南丹县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2189', '广西壮族自治区河池市天峨县', '天峨县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2190', '广西壮族自治区河池市凤山县', '凤山县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2191', '广西壮族自治区河池市东兰县', '东兰县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2192', '广西壮族自治区河池市罗城仫佬族自治县', '罗城仫佬族自治县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2193', '广西壮族自治区河池市环江毛南族自治县', '环江毛南族自治县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2194', '广西壮族自治区河池市巴马瑶族自治县', '巴马瑶族自治县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2195', '广西壮族自治区河池市都安瑶族自治县', '都安瑶族自治县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2196', '广西壮族自治区河池市大化瑶族自治县', '大化瑶族自治县', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2197', '广西壮族自治区河池市宜州市', '宜州市', ',2089,2186,', '2186', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2198', '广西壮族自治区来宾市', '来宾市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2199', '广西壮族自治区来宾市兴宾区', '兴宾区', ',2089,2198,', '2198', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2200', '广西壮族自治区来宾市忻城县', '忻城县', ',2089,2198,', '2198', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2201', '广西壮族自治区来宾市象州县', '象州县', ',2089,2198,', '2198', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2202', '广西壮族自治区来宾市武宣县', '武宣县', ',2089,2198,', '2198', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2203', '广西壮族自治区来宾市金秀瑶族自治县', '金秀瑶族自治县', ',2089,2198,', '2198', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2204', '广西壮族自治区来宾市合山市', '合山市', ',2089,2198,', '2198', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2205', '广西壮族自治区崇左市', '崇左市', ',2089,', '2089', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2206', '广西壮族自治区崇左市江洲区', '江洲区', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2207', '广西壮族自治区崇左市扶绥县', '扶绥县', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2208', '广西壮族自治区崇左市宁明县', '宁明县', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2209', '广西壮族自治区崇左市龙州县', '龙州县', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2210', '广西壮族自治区崇左市大新县', '大新县', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2211', '广西壮族自治区崇左市天等县', '天等县', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2212', '广西壮族自治区崇左市凭祥市', '凭祥市', ',2089,2205,', '2205', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2213', '海南省', '海南省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2214', '海南省海口市', '海口市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2215', '海南省海口市秀英区', '秀英区', ',2213,2214,', '2214', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2216', '海南省海口市龙华区', '龙华区', ',2213,2214,', '2214', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2217', '海南省海口市琼山区', '琼山区', ',2213,2214,', '2214', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2218', '海南省海口市美兰区', '美兰区', ',2213,2214,', '2214', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2219', '海南省三亚市', '三亚市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2220', '海南省三沙市', '三沙市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2221', '海南省三沙市西沙群岛', '西沙群岛', ',2213,2220,', '2220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2222', '海南省三沙市南沙群岛', '南沙群岛', ',2213,2220,', '2220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2223', '海南省三沙市中沙群岛的岛礁及其海域', '中沙群岛的岛礁及其海域', ',2213,2220,', '2220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2224', '海南省五指山市', '五指山市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2225', '海南省琼海市', '琼海市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2226', '海南省儋州市', '儋州市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2227', '海南省文昌市', '文昌市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2228', '海南省万宁市', '万宁市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2229', '海南省东方市', '东方市', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2230', '海南省定安县', '定安县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2231', '海南省屯昌县', '屯昌县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2232', '海南省澄迈县', '澄迈县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2233', '海南省临高县', '临高县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2234', '海南省白沙黎族自治县', '白沙黎族自治县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2235', '海南省昌江黎族自治县', '昌江黎族自治县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2236', '海南省乐东黎族自治县', '乐东黎族自治县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2237', '海南省陵水黎族自治县', '陵水黎族自治县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2238', '海南省保亭黎族苗族自治县', '保亭黎族苗族自治县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2239', '海南省琼中黎族苗族自治县', '琼中黎族苗族自治县', ',2213,', '2213', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2240', '重庆市', '重庆市', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2241', '重庆市万州区', '万州区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2242', '重庆市涪陵区', '涪陵区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2243', '重庆市渝中区', '渝中区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2244', '重庆市大渡口区', '大渡口区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2245', '重庆市江北区', '江北区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2246', '重庆市沙坪坝区', '沙坪坝区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2247', '重庆市九龙坡区', '九龙坡区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2248', '重庆市南岸区', '南岸区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2249', '重庆市北碚区', '北碚区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2250', '重庆市綦江区', '綦江区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2251', '重庆市大足区', '大足区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2252', '重庆市渝北区', '渝北区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2253', '重庆市巴南区', '巴南区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2254', '重庆市黔江区', '黔江区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2255', '重庆市长寿区', '长寿区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2256', '重庆市江津区', '江津区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2257', '重庆市合川区', '合川区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2258', '重庆市永川区', '永川区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2259', '重庆市南川区', '南川区', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2260', '重庆市潼南县', '潼南县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2261', '重庆市铜梁县', '铜梁县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2262', '重庆市荣昌县', '荣昌县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2263', '重庆市璧山县', '璧山县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2264', '重庆市梁平县', '梁平县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2265', '重庆市城口县', '城口县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2266', '重庆市丰都县', '丰都县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2267', '重庆市垫江县', '垫江县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2268', '重庆市武隆县', '武隆县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2269', '重庆市忠县', '忠县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2270', '重庆市开县', '开县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2271', '重庆市云阳县', '云阳县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2272', '重庆市奉节县', '奉节县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2273', '重庆市巫山县', '巫山县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2274', '重庆市巫溪县', '巫溪县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2275', '重庆市石柱土家族自治县', '石柱土家族自治县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2276', '重庆市秀山土家族苗族自治县', '秀山土家族苗族自治县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2277', '重庆市酉阳土家族苗族自治县', '酉阳土家族苗族自治县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2278', '重庆市彭水苗族土家族自治县', '彭水苗族土家族自治县', ',2240,', '2240', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2279', '四川省', '四川省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2280', '四川省成都市', '成都市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2281', '四川省成都市锦江区', '锦江区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2282', '四川省成都市青羊区', '青羊区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2283', '四川省成都市金牛区', '金牛区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2284', '四川省成都市武侯区', '武侯区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2285', '四川省成都市成华区', '成华区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2286', '四川省成都市龙泉驿区', '龙泉驿区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2287', '四川省成都市青白江区', '青白江区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2288', '四川省成都市新都区', '新都区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2289', '四川省成都市温江区', '温江区', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2290', '四川省成都市金堂县', '金堂县', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2291', '四川省成都市双流县', '双流县', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2292', '四川省成都市郫县', '郫县', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2293', '四川省成都市大邑县', '大邑县', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2294', '四川省成都市蒲江县', '蒲江县', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2295', '四川省成都市新津县', '新津县', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2296', '四川省成都市都江堰市', '都江堰市', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2297', '四川省成都市彭州市', '彭州市', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2298', '四川省成都市邛崃市', '邛崃市', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2299', '四川省成都市崇州市', '崇州市', ',2279,2280,', '2280', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2300', '四川省自贡市', '自贡市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2301', '四川省自贡市自流井区', '自流井区', ',2279,2300,', '2300', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2302', '四川省自贡市贡井区', '贡井区', ',2279,2300,', '2300', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2303', '四川省自贡市大安区', '大安区', ',2279,2300,', '2300', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2304', '四川省自贡市沿滩区', '沿滩区', ',2279,2300,', '2300', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2305', '四川省自贡市荣县', '荣县', ',2279,2300,', '2300', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2306', '四川省自贡市富顺县', '富顺县', ',2279,2300,', '2300', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2307', '四川省攀枝花市', '攀枝花市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2308', '四川省攀枝花市东区', '东区', ',2279,2307,', '2307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2309', '四川省攀枝花市西区', '西区', ',2279,2307,', '2307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2310', '四川省攀枝花市仁和区', '仁和区', ',2279,2307,', '2307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2311', '四川省攀枝花市米易县', '米易县', ',2279,2307,', '2307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2312', '四川省攀枝花市盐边县', '盐边县', ',2279,2307,', '2307', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2313', '四川省泸州市', '泸州市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2314', '四川省泸州市江阳区', '江阳区', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2315', '四川省泸州市纳溪区', '纳溪区', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2316', '四川省泸州市龙马潭区', '龙马潭区', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2317', '四川省泸州市泸县', '泸县', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2318', '四川省泸州市合江县', '合江县', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2319', '四川省泸州市叙永县', '叙永县', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2320', '四川省泸州市古蔺县', '古蔺县', ',2279,2313,', '2313', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2321', '四川省德阳市', '德阳市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2322', '四川省德阳市旌阳区', '旌阳区', ',2279,2321,', '2321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2323', '四川省德阳市中江县', '中江县', ',2279,2321,', '2321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2324', '四川省德阳市罗江县', '罗江县', ',2279,2321,', '2321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2325', '四川省德阳市广汉市', '广汉市', ',2279,2321,', '2321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2326', '四川省德阳市什邡市', '什邡市', ',2279,2321,', '2321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2327', '四川省德阳市绵竹市', '绵竹市', ',2279,2321,', '2321', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2328', '四川省绵阳市', '绵阳市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2329', '四川省绵阳市涪城区', '涪城区', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2330', '四川省绵阳市游仙区', '游仙区', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2331', '四川省绵阳市三台县', '三台县', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2332', '四川省绵阳市盐亭县', '盐亭县', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2333', '四川省绵阳市安县', '安县', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2334', '四川省绵阳市梓潼县', '梓潼县', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2335', '四川省绵阳市北川羌族自治县', '北川羌族自治县', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2336', '四川省绵阳市平武县', '平武县', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2337', '四川省绵阳市江油市', '江油市', ',2279,2328,', '2328', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2338', '四川省广元市', '广元市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2339', '四川省广元市利州区', '利州区', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2340', '四川省广元市元坝区', '元坝区', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2341', '四川省广元市朝天区', '朝天区', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2342', '四川省广元市旺苍县', '旺苍县', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2343', '四川省广元市青川县', '青川县', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2344', '四川省广元市剑阁县', '剑阁县', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2345', '四川省广元市苍溪县', '苍溪县', ',2279,2338,', '2338', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2346', '四川省遂宁市', '遂宁市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2347', '四川省遂宁市船山区', '船山区', ',2279,2346,', '2346', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2348', '四川省遂宁市安居区', '安居区', ',2279,2346,', '2346', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2349', '四川省遂宁市蓬溪县', '蓬溪县', ',2279,2346,', '2346', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2350', '四川省遂宁市射洪县', '射洪县', ',2279,2346,', '2346', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2351', '四川省遂宁市大英县', '大英县', ',2279,2346,', '2346', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2352', '四川省内江市', '内江市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2353', '四川省内江市市中区', '市中区', ',2279,2352,', '2352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2354', '四川省内江市东兴区', '东兴区', ',2279,2352,', '2352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2355', '四川省内江市威远县', '威远县', ',2279,2352,', '2352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2356', '四川省内江市资中县', '资中县', ',2279,2352,', '2352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2357', '四川省内江市隆昌县', '隆昌县', ',2279,2352,', '2352', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2358', '四川省乐山市', '乐山市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2359', '四川省乐山市市中区', '市中区', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2360', '四川省乐山市沙湾区', '沙湾区', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2361', '四川省乐山市五通桥区', '五通桥区', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2362', '四川省乐山市金口河区', '金口河区', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2363', '四川省乐山市犍为县', '犍为县', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2364', '四川省乐山市井研县', '井研县', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2365', '四川省乐山市夹江县', '夹江县', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2366', '四川省乐山市沐川县', '沐川县', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2367', '四川省乐山市峨边彝族自治县', '峨边彝族自治县', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2368', '四川省乐山市马边彝族自治县', '马边彝族自治县', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2369', '四川省乐山市峨眉山市', '峨眉山市', ',2279,2358,', '2358', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2370', '四川省南充市', '南充市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2371', '四川省南充市顺庆区', '顺庆区', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2372', '四川省南充市高坪区', '高坪区', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2373', '四川省南充市嘉陵区', '嘉陵区', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2374', '四川省南充市南部县', '南部县', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2375', '四川省南充市营山县', '营山县', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2376', '四川省南充市蓬安县', '蓬安县', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2377', '四川省南充市仪陇县', '仪陇县', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2378', '四川省南充市西充县', '西充县', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2379', '四川省南充市阆中市', '阆中市', ',2279,2370,', '2370', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2380', '四川省眉山市', '眉山市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2381', '四川省眉山市东坡区', '东坡区', ',2279,2380,', '2380', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2382', '四川省眉山市仁寿县', '仁寿县', ',2279,2380,', '2380', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2383', '四川省眉山市彭山县', '彭山县', ',2279,2380,', '2380', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2384', '四川省眉山市洪雅县', '洪雅县', ',2279,2380,', '2380', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2385', '四川省眉山市丹棱县', '丹棱县', ',2279,2380,', '2380', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2386', '四川省眉山市青神县', '青神县', ',2279,2380,', '2380', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2387', '四川省宜宾市', '宜宾市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2388', '四川省宜宾市翠屏区', '翠屏区', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2389', '四川省宜宾市南溪区', '南溪区', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2390', '四川省宜宾市宜宾县', '宜宾县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2391', '四川省宜宾市江安县', '江安县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2392', '四川省宜宾市长宁县', '长宁县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2393', '四川省宜宾市高县', '高县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2394', '四川省宜宾市珙县', '珙县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2395', '四川省宜宾市筠连县', '筠连县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2396', '四川省宜宾市兴文县', '兴文县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2397', '四川省宜宾市屏山县', '屏山县', ',2279,2387,', '2387', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2398', '四川省广安市', '广安市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2399', '四川省广安市广安区', '广安区', ',2279,2398,', '2398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2400', '四川省广安市岳池县', '岳池县', ',2279,2398,', '2398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2401', '四川省广安市武胜县', '武胜县', ',2279,2398,', '2398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2402', '四川省广安市邻水县', '邻水县', ',2279,2398,', '2398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2403', '四川省广安市华蓥市', '华蓥市', ',2279,2398,', '2398', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2404', '四川省达州市', '达州市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2405', '四川省达州市通川区', '通川区', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2406', '四川省达州市达县', '达县', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2407', '四川省达州市宣汉县', '宣汉县', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2408', '四川省达州市开江县', '开江县', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2409', '四川省达州市大竹县', '大竹县', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2410', '四川省达州市渠县', '渠县', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2411', '四川省达州市万源市', '万源市', ',2279,2404,', '2404', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2412', '四川省雅安市', '雅安市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2413', '四川省雅安市雨城区', '雨城区', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2414', '四川省雅安市名山区', '名山区', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2415', '四川省雅安市荥经县', '荥经县', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2416', '四川省雅安市汉源县', '汉源县', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2417', '四川省雅安市石棉县', '石棉县', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2418', '四川省雅安市天全县', '天全县', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2419', '四川省雅安市芦山县', '芦山县', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2420', '四川省雅安市宝兴县', '宝兴县', ',2279,2412,', '2412', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2421', '四川省巴中市', '巴中市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2422', '四川省巴中市巴州区', '巴州区', ',2279,2421,', '2421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2423', '四川省巴中市通江县', '通江县', ',2279,2421,', '2421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2424', '四川省巴中市南江县', '南江县', ',2279,2421,', '2421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2425', '四川省巴中市平昌县', '平昌县', ',2279,2421,', '2421', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2426', '四川省资阳市', '资阳市', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2427', '四川省资阳市雁江区', '雁江区', ',2279,2426,', '2426', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2428', '四川省资阳市安岳县', '安岳县', ',2279,2426,', '2426', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2429', '四川省资阳市乐至县', '乐至县', ',2279,2426,', '2426', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2430', '四川省资阳市简阳市', '简阳市', ',2279,2426,', '2426', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2431', '四川省阿坝藏族羌族自治州', '阿坝藏族羌族自治州', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2432', '四川省阿坝藏族羌族自治州汶川县', '汶川县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2433', '四川省阿坝藏族羌族自治州理县', '理县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2434', '四川省阿坝藏族羌族自治州茂县', '茂县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2435', '四川省阿坝藏族羌族自治州松潘县', '松潘县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2436', '四川省阿坝藏族羌族自治州九寨沟县', '九寨沟县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2437', '四川省阿坝藏族羌族自治州金川县', '金川县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2438', '四川省阿坝藏族羌族自治州小金县', '小金县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2439', '四川省阿坝藏族羌族自治州黑水县', '黑水县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2440', '四川省阿坝藏族羌族自治州马尔康县', '马尔康县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2441', '四川省阿坝藏族羌族自治州壤塘县', '壤塘县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2442', '四川省阿坝藏族羌族自治州阿坝县', '阿坝县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2443', '四川省阿坝藏族羌族自治州若尔盖县', '若尔盖县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2444', '四川省阿坝藏族羌族自治州红原县', '红原县', ',2279,2431,', '2431', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2445', '四川省甘孜藏族自治州', '甘孜藏族自治州', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2446', '四川省甘孜藏族自治州康定县', '康定县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2447', '四川省甘孜藏族自治州泸定县', '泸定县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2448', '四川省甘孜藏族自治州丹巴县', '丹巴县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2449', '四川省甘孜藏族自治州九龙县', '九龙县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2450', '四川省甘孜藏族自治州雅江县', '雅江县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2451', '四川省甘孜藏族自治州道孚县', '道孚县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2452', '四川省甘孜藏族自治州炉霍县', '炉霍县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2453', '四川省甘孜藏族自治州甘孜县', '甘孜县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2454', '四川省甘孜藏族自治州新龙县', '新龙县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2455', '四川省甘孜藏族自治州德格县', '德格县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2456', '四川省甘孜藏族自治州白玉县', '白玉县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2457', '四川省甘孜藏族自治州石渠县', '石渠县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2458', '四川省甘孜藏族自治州色达县', '色达县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2459', '四川省甘孜藏族自治州理塘县', '理塘县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2460', '四川省甘孜藏族自治州巴塘县', '巴塘县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2461', '四川省甘孜藏族自治州乡城县', '乡城县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2462', '四川省甘孜藏族自治州稻城县', '稻城县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2463', '四川省甘孜藏族自治州得荣县', '得荣县', ',2279,2445,', '2445', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2464', '四川省凉山彝族自治州', '凉山彝族自治州', ',2279,', '2279', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2465', '四川省凉山彝族自治州西昌市', '西昌市', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2466', '四川省凉山彝族自治州木里藏族自治县', '木里藏族自治县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2467', '四川省凉山彝族自治州盐源县', '盐源县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2468', '四川省凉山彝族自治州德昌县', '德昌县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2469', '四川省凉山彝族自治州会理县', '会理县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2470', '四川省凉山彝族自治州会东县', '会东县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2471', '四川省凉山彝族自治州宁南县', '宁南县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2472', '四川省凉山彝族自治州普格县', '普格县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2473', '四川省凉山彝族自治州布拖县', '布拖县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2474', '四川省凉山彝族自治州金阳县', '金阳县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2475', '四川省凉山彝族自治州昭觉县', '昭觉县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2476', '四川省凉山彝族自治州喜德县', '喜德县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2477', '四川省凉山彝族自治州冕宁县', '冕宁县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2478', '四川省凉山彝族自治州越西县', '越西县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2479', '四川省凉山彝族自治州甘洛县', '甘洛县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2480', '四川省凉山彝族自治州美姑县', '美姑县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2481', '四川省凉山彝族自治州雷波县', '雷波县', ',2279,2464,', '2464', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2482', '贵州省', '贵州省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2483', '贵州省贵阳市', '贵阳市', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2484', '贵州省贵阳市南明区', '南明区', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2485', '贵州省贵阳市云岩区', '云岩区', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2486', '贵州省贵阳市花溪区', '花溪区', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2487', '贵州省贵阳市乌当区', '乌当区', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2488', '贵州省贵阳市白云区', '白云区', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2489', '贵州省贵阳市小河区', '小河区', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2490', '贵州省贵阳市开阳县', '开阳县', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2491', '贵州省贵阳市息烽县', '息烽县', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2492', '贵州省贵阳市修文县', '修文县', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2493', '贵州省贵阳市清镇市', '清镇市', ',2482,2483,', '2483', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2494', '贵州省六盘水市', '六盘水市', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2495', '贵州省六盘水市钟山区', '钟山区', ',2482,2494,', '2494', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2496', '贵州省六盘水市六枝特区', '六枝特区', ',2482,2494,', '2494', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2497', '贵州省六盘水市水城县', '水城县', ',2482,2494,', '2494', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2498', '贵州省六盘水市盘县', '盘县', ',2482,2494,', '2494', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2499', '贵州省遵义市', '遵义市', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2500', '贵州省遵义市红花岗区', '红花岗区', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2501', '贵州省遵义市汇川区', '汇川区', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2502', '贵州省遵义市遵义县', '遵义县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2503', '贵州省遵义市桐梓县', '桐梓县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2504', '贵州省遵义市绥阳县', '绥阳县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2505', '贵州省遵义市正安县', '正安县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2506', '贵州省遵义市道真仡佬族苗族自治县', '道真仡佬族苗族自治县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2507', '贵州省遵义市务川仡佬族苗族自治县', '务川仡佬族苗族自治县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2508', '贵州省遵义市凤冈县', '凤冈县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2509', '贵州省遵义市湄潭县', '湄潭县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2510', '贵州省遵义市余庆县', '余庆县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2511', '贵州省遵义市习水县', '习水县', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2512', '贵州省遵义市赤水市', '赤水市', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2513', '贵州省遵义市仁怀市', '仁怀市', ',2482,2499,', '2499', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2514', '贵州省安顺市', '安顺市', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2515', '贵州省安顺市西秀区', '西秀区', ',2482,2514,', '2514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2516', '贵州省安顺市平坝县', '平坝县', ',2482,2514,', '2514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2517', '贵州省安顺市普定县', '普定县', ',2482,2514,', '2514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2518', '贵州省安顺市镇宁布依族苗族自治县', '镇宁布依族苗族自治县', ',2482,2514,', '2514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2519', '贵州省安顺市关岭布依族苗族自治县', '关岭布依族苗族自治县', ',2482,2514,', '2514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2520', '贵州省安顺市紫云苗族布依族自治县', '紫云苗族布依族自治县', ',2482,2514,', '2514', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2521', '贵州省毕节市', '毕节市', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2522', '贵州省毕节市七星关区', '七星关区', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2523', '贵州省毕节市大方县', '大方县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2524', '贵州省毕节市黔西县', '黔西县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2525', '贵州省毕节市金沙县', '金沙县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2526', '贵州省毕节市织金县', '织金县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2527', '贵州省毕节市纳雍县', '纳雍县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2528', '贵州省毕节市威宁彝族回族苗族自治县', '威宁彝族回族苗族自治县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2529', '贵州省毕节市赫章县', '赫章县', ',2482,2521,', '2521', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2530', '贵州省铜仁市', '铜仁市', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2531', '贵州省铜仁市碧江区', '碧江区', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2532', '贵州省铜仁市万山区', '万山区', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2533', '贵州省铜仁市江口县', '江口县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2534', '贵州省铜仁市玉屏侗族自治县', '玉屏侗族自治县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2535', '贵州省铜仁市石阡县', '石阡县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2536', '贵州省铜仁市思南县', '思南县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2537', '贵州省铜仁市印江土家族苗族自治县', '印江土家族苗族自治县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2538', '贵州省铜仁市德江县', '德江县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2539', '贵州省铜仁市沿河土家族自治县', '沿河土家族自治县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2540', '贵州省铜仁市松桃苗族自治县', '松桃苗族自治县', ',2482,2530,', '2530', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2541', '贵州省黔西南布依族苗族自治州', '黔西南布依族苗族自治州', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2542', '贵州省黔西南布依族苗族自治州兴义市', '兴义市', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2543', '贵州省黔西南布依族苗族自治州兴仁县', '兴仁县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2544', '贵州省黔西南布依族苗族自治州普安县', '普安县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2545', '贵州省黔西南布依族苗族自治州晴隆县', '晴隆县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2546', '贵州省黔西南布依族苗族自治州贞丰县', '贞丰县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2547', '贵州省黔西南布依族苗族自治州望谟县', '望谟县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2548', '贵州省黔西南布依族苗族自治州册亨县', '册亨县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2549', '贵州省黔西南布依族苗族自治州安龙县', '安龙县', ',2482,2541,', '2541', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2550', '贵州省黔东南苗族侗族自治州', '黔东南苗族侗族自治州', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2551', '贵州省黔东南苗族侗族自治州凯里市', '凯里市', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2552', '贵州省黔东南苗族侗族自治州黄平县', '黄平县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2553', '贵州省黔东南苗族侗族自治州施秉县', '施秉县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2554', '贵州省黔东南苗族侗族自治州三穗县', '三穗县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2555', '贵州省黔东南苗族侗族自治州镇远县', '镇远县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2556', '贵州省黔东南苗族侗族自治州岑巩县', '岑巩县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2557', '贵州省黔东南苗族侗族自治州天柱县', '天柱县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2558', '贵州省黔东南苗族侗族自治州锦屏县', '锦屏县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2559', '贵州省黔东南苗族侗族自治州剑河县', '剑河县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2560', '贵州省黔东南苗族侗族自治州台江县', '台江县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2561', '贵州省黔东南苗族侗族自治州黎平县', '黎平县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2562', '贵州省黔东南苗族侗族自治州榕江县', '榕江县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2563', '贵州省黔东南苗族侗族自治州从江县', '从江县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2564', '贵州省黔东南苗族侗族自治州雷山县', '雷山县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2565', '贵州省黔东南苗族侗族自治州麻江县', '麻江县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2566', '贵州省黔东南苗族侗族自治州丹寨县', '丹寨县', ',2482,2550,', '2550', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2567', '贵州省黔南布依族苗族自治州', '黔南布依族苗族自治州', ',2482,', '2482', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2568', '贵州省黔南布依族苗族自治州都匀市', '都匀市', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2569', '贵州省黔南布依族苗族自治州福泉市', '福泉市', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2570', '贵州省黔南布依族苗族自治州荔波县', '荔波县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2571', '贵州省黔南布依族苗族自治州贵定县', '贵定县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2572', '贵州省黔南布依族苗族自治州瓮安县', '瓮安县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2573', '贵州省黔南布依族苗族自治州独山县', '独山县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2574', '贵州省黔南布依族苗族自治州平塘县', '平塘县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2575', '贵州省黔南布依族苗族自治州罗甸县', '罗甸县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2576', '贵州省黔南布依族苗族自治州长顺县', '长顺县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2577', '贵州省黔南布依族苗族自治州龙里县', '龙里县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2578', '贵州省黔南布依族苗族自治州惠水县', '惠水县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2579', '贵州省黔南布依族苗族自治州三都水族自治县', '三都水族自治县', ',2482,2567,', '2567', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2580', '云南省', '云南省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2581', '云南省昆明市', '昆明市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2582', '云南省昆明市五华区', '五华区', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2583', '云南省昆明市盘龙区', '盘龙区', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2584', '云南省昆明市官渡区', '官渡区', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2585', '云南省昆明市西山区', '西山区', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2586', '云南省昆明市东川区', '东川区', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2587', '云南省昆明市呈贡区', '呈贡区', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2588', '云南省昆明市晋宁县', '晋宁县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2589', '云南省昆明市富民县', '富民县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2590', '云南省昆明市宜良县', '宜良县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2591', '云南省昆明市石林彝族自治县', '石林彝族自治县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2592', '云南省昆明市嵩明县', '嵩明县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2593', '云南省昆明市禄劝彝族苗族自治县', '禄劝彝族苗族自治县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2594', '云南省昆明市寻甸回族彝族自治县', '寻甸回族彝族自治县', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2595', '云南省昆明市安宁市', '安宁市', ',2580,2581,', '2581', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2596', '云南省曲靖市', '曲靖市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2597', '云南省曲靖市麒麟区', '麒麟区', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2598', '云南省曲靖市马龙县', '马龙县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2599', '云南省曲靖市陆良县', '陆良县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2600', '云南省曲靖市师宗县', '师宗县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2601', '云南省曲靖市罗平县', '罗平县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2602', '云南省曲靖市富源县', '富源县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2603', '云南省曲靖市会泽县', '会泽县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2604', '云南省曲靖市沾益县', '沾益县', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2605', '云南省曲靖市宣威市', '宣威市', ',2580,2596,', '2596', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2606', '云南省玉溪市', '玉溪市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2607', '云南省玉溪市红塔区', '红塔区', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2608', '云南省玉溪市江川县', '江川县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2609', '云南省玉溪市澄江县', '澄江县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2610', '云南省玉溪市通海县', '通海县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2611', '云南省玉溪市华宁县', '华宁县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2612', '云南省玉溪市易门县', '易门县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2613', '云南省玉溪市峨山彝族自治县', '峨山彝族自治县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2614', '云南省玉溪市新平彝族傣族自治县', '新平彝族傣族自治县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2615', '云南省玉溪市元江哈尼族彝族傣族自治县', '元江哈尼族彝族傣族自治县', ',2580,2606,', '2606', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2616', '云南省保山市', '保山市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2617', '云南省保山市隆阳区', '隆阳区', ',2580,2616,', '2616', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2618', '云南省保山市施甸县', '施甸县', ',2580,2616,', '2616', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2619', '云南省保山市腾冲县', '腾冲县', ',2580,2616,', '2616', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2620', '云南省保山市龙陵县', '龙陵县', ',2580,2616,', '2616', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2621', '云南省保山市昌宁县', '昌宁县', ',2580,2616,', '2616', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2622', '云南省昭通市', '昭通市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2623', '云南省昭通市昭阳区', '昭阳区', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2624', '云南省昭通市鲁甸县', '鲁甸县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2625', '云南省昭通市巧家县', '巧家县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2626', '云南省昭通市盐津县', '盐津县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2627', '云南省昭通市大关县', '大关县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2628', '云南省昭通市永善县', '永善县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2629', '云南省昭通市绥江县', '绥江县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2630', '云南省昭通市镇雄县', '镇雄县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2631', '云南省昭通市彝良县', '彝良县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2632', '云南省昭通市威信县', '威信县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2633', '云南省昭通市水富县', '水富县', ',2580,2622,', '2622', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2634', '云南省丽江市', '丽江市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2635', '云南省丽江市古城区', '古城区', ',2580,2634,', '2634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2636', '云南省丽江市玉龙纳西族自治县', '玉龙纳西族自治县', ',2580,2634,', '2634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2637', '云南省丽江市永胜县', '永胜县', ',2580,2634,', '2634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2638', '云南省丽江市华坪县', '华坪县', ',2580,2634,', '2634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2639', '云南省丽江市宁蒗彝族自治县', '宁蒗彝族自治县', ',2580,2634,', '2634', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2640', '云南省普洱市', '普洱市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2641', '云南省普洱市思茅区', '思茅区', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2642', '云南省普洱市宁洱哈尼族彝族自治县', '宁洱哈尼族彝族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2643', '云南省普洱市墨江哈尼族自治县', '墨江哈尼族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2644', '云南省普洱市景东彝族自治县', '景东彝族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2645', '云南省普洱市景谷傣族彝族自治县', '景谷傣族彝族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2646', '云南省普洱市镇沅彝族哈尼族拉祜族自治县', '镇沅彝族哈尼族拉祜族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2647', '云南省普洱市江城哈尼族彝族自治县', '江城哈尼族彝族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2648', '云南省普洱市孟连傣族拉祜族佤族自治县', '孟连傣族拉祜族佤族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2649', '云南省普洱市澜沧拉祜族自治县', '澜沧拉祜族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2650', '云南省普洱市西盟佤族自治县', '西盟佤族自治县', ',2580,2640,', '2640', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2651', '云南省临沧市', '临沧市', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2652', '云南省临沧市临翔区', '临翔区', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2653', '云南省临沧市凤庆县', '凤庆县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2654', '云南省临沧市云县', '云县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2655', '云南省临沧市永德县', '永德县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2656', '云南省临沧市镇康县', '镇康县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2657', '云南省临沧市双江拉祜族佤族布朗族傣族自治县', '双江拉祜族佤族布朗族傣族自治县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2658', '云南省临沧市耿马傣族佤族自治县', '耿马傣族佤族自治县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2659', '云南省临沧市沧源佤族自治县', '沧源佤族自治县', ',2580,2651,', '2651', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2660', '云南省楚雄彝族自治州', '楚雄彝族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2661', '云南省楚雄彝族自治州楚雄市', '楚雄市', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2662', '云南省楚雄彝族自治州双柏县', '双柏县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2663', '云南省楚雄彝族自治州牟定县', '牟定县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2664', '云南省楚雄彝族自治州南华县', '南华县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2665', '云南省楚雄彝族自治州姚安县', '姚安县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2666', '云南省楚雄彝族自治州大姚县', '大姚县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2667', '云南省楚雄彝族自治州永仁县', '永仁县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2668', '云南省楚雄彝族自治州元谋县', '元谋县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2669', '云南省楚雄彝族自治州武定县', '武定县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2670', '云南省楚雄彝族自治州禄丰县', '禄丰县', ',2580,2660,', '2660', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2671', '云南省红河哈尼族彝族自治州', '红河哈尼族彝族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2672', '云南省红河哈尼族彝族自治州个旧市', '个旧市', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2673', '云南省红河哈尼族彝族自治州开远市', '开远市', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2674', '云南省红河哈尼族彝族自治州蒙自市', '蒙自市', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2675', '云南省红河哈尼族彝族自治州屏边苗族自治县', '屏边苗族自治县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2676', '云南省红河哈尼族彝族自治州建水县', '建水县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2677', '云南省红河哈尼族彝族自治州石屏县', '石屏县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2678', '云南省红河哈尼族彝族自治州弥勒县', '弥勒县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2679', '云南省红河哈尼族彝族自治州泸西县', '泸西县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2680', '云南省红河哈尼族彝族自治州元阳县', '元阳县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2681', '云南省红河哈尼族彝族自治州红河县', '红河县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2682', '云南省红河哈尼族彝族自治州金平苗族瑶族傣族自治县', '金平苗族瑶族傣族自治县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2683', '云南省红河哈尼族彝族自治州绿春县', '绿春县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2684', '云南省红河哈尼族彝族自治州河口瑶族自治县', '河口瑶族自治县', ',2580,2671,', '2671', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2685', '云南省文山壮族苗族自治州', '文山壮族苗族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2686', '云南省文山壮族苗族自治州文山市', '文山市', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2687', '云南省文山壮族苗族自治州砚山县', '砚山县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2688', '云南省文山壮族苗族自治州西畴县', '西畴县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2689', '云南省文山壮族苗族自治州麻栗坡县', '麻栗坡县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2690', '云南省文山壮族苗族自治州马关县', '马关县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2691', '云南省文山壮族苗族自治州丘北县', '丘北县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2692', '云南省文山壮族苗族自治州广南县', '广南县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2693', '云南省文山壮族苗族自治州富宁县', '富宁县', ',2580,2685,', '2685', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2694', '云南省西双版纳傣族自治州', '西双版纳傣族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2695', '云南省西双版纳傣族自治州景洪市', '景洪市', ',2580,2694,', '2694', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2696', '云南省西双版纳傣族自治州勐海县', '勐海县', ',2580,2694,', '2694', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2697', '云南省西双版纳傣族自治州勐腊县', '勐腊县', ',2580,2694,', '2694', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2698', '云南省大理白族自治州', '大理白族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2699', '云南省大理白族自治州大理市', '大理市', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2700', '云南省大理白族自治州漾濞彝族自治县', '漾濞彝族自治县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2701', '云南省大理白族自治州祥云县', '祥云县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2702', '云南省大理白族自治州宾川县', '宾川县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2703', '云南省大理白族自治州弥渡县', '弥渡县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2704', '云南省大理白族自治州南涧彝族自治县', '南涧彝族自治县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2705', '云南省大理白族自治州巍山彝族回族自治县', '巍山彝族回族自治县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2706', '云南省大理白族自治州永平县', '永平县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2707', '云南省大理白族自治州云龙县', '云龙县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2708', '云南省大理白族自治州洱源县', '洱源县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2709', '云南省大理白族自治州剑川县', '剑川县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2710', '云南省大理白族自治州鹤庆县', '鹤庆县', ',2580,2698,', '2698', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2711', '云南省德宏傣族景颇族自治州', '德宏傣族景颇族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2712', '云南省德宏傣族景颇族自治州瑞丽市', '瑞丽市', ',2580,2711,', '2711', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2713', '云南省德宏傣族景颇族自治州芒市', '芒市', ',2580,2711,', '2711', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2714', '云南省德宏傣族景颇族自治州梁河县', '梁河县', ',2580,2711,', '2711', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2715', '云南省德宏傣族景颇族自治州盈江县', '盈江县', ',2580,2711,', '2711', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2716', '云南省德宏傣族景颇族自治州陇川县', '陇川县', ',2580,2711,', '2711', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2717', '云南省怒江傈僳族自治州', '怒江傈僳族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2718', '云南省怒江傈僳族自治州泸水县', '泸水县', ',2580,2717,', '2717', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2719', '云南省怒江傈僳族自治州福贡县', '福贡县', ',2580,2717,', '2717', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2720', '云南省怒江傈僳族自治州贡山独龙族怒族自治县', '贡山独龙族怒族自治县', ',2580,2717,', '2717', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2721', '云南省怒江傈僳族自治州兰坪白族普米族自治县', '兰坪白族普米族自治县', ',2580,2717,', '2717', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2722', '云南省迪庆藏族自治州', '迪庆藏族自治州', ',2580,', '2580', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2723', '云南省迪庆藏族自治州香格里拉县', '香格里拉县', ',2580,2722,', '2722', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2724', '云南省迪庆藏族自治州德钦县', '德钦县', ',2580,2722,', '2722', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2725', '云南省迪庆藏族自治州维西傈僳族自治县', '维西傈僳族自治县', ',2580,2722,', '2722', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2726', '西藏自治区', '西藏自治区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2727', '西藏自治区拉萨市', '拉萨市', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2728', '西藏自治区拉萨市城关区', '城关区', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2729', '西藏自治区拉萨市林周县', '林周县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2730', '西藏自治区拉萨市当雄县', '当雄县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2731', '西藏自治区拉萨市尼木县', '尼木县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2732', '西藏自治区拉萨市曲水县', '曲水县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2733', '西藏自治区拉萨市堆龙德庆县', '堆龙德庆县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2734', '西藏自治区拉萨市达孜县', '达孜县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2735', '西藏自治区拉萨市墨竹工卡县', '墨竹工卡县', ',2726,2727,', '2727', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2736', '西藏自治区昌都地区', '昌都地区', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2737', '西藏自治区昌都地区昌都县', '昌都县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2738', '西藏自治区昌都地区江达县', '江达县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2739', '西藏自治区昌都地区贡觉县', '贡觉县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2740', '西藏自治区昌都地区类乌齐县', '类乌齐县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2741', '西藏自治区昌都地区丁青县', '丁青县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2742', '西藏自治区昌都地区察雅县', '察雅县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2743', '西藏自治区昌都地区八宿县', '八宿县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2744', '西藏自治区昌都地区左贡县', '左贡县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2745', '西藏自治区昌都地区芒康县', '芒康县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2746', '西藏自治区昌都地区洛隆县', '洛隆县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2747', '西藏自治区昌都地区边坝县', '边坝县', ',2726,2736,', '2736', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2748', '西藏自治区山南地区', '山南地区', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2749', '西藏自治区山南地区乃东县', '乃东县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2750', '西藏自治区山南地区扎囊县', '扎囊县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2751', '西藏自治区山南地区贡嘎县', '贡嘎县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2752', '西藏自治区山南地区桑日县', '桑日县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2753', '西藏自治区山南地区琼结县', '琼结县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2754', '西藏自治区山南地区曲松县', '曲松县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2755', '西藏自治区山南地区措美县', '措美县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2756', '西藏自治区山南地区洛扎县', '洛扎县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2757', '西藏自治区山南地区加查县', '加查县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2758', '西藏自治区山南地区隆子县', '隆子县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2759', '西藏自治区山南地区错那县', '错那县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2760', '西藏自治区山南地区浪卡子县', '浪卡子县', ',2726,2748,', '2748', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2761', '西藏自治区日喀则地区', '日喀则地区', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2762', '西藏自治区日喀则地区日喀则市', '日喀则市', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2763', '西藏自治区日喀则地区南木林县', '南木林县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2764', '西藏自治区日喀则地区江孜县', '江孜县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2765', '西藏自治区日喀则地区定日县', '定日县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2766', '西藏自治区日喀则地区萨迦县', '萨迦县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2767', '西藏自治区日喀则地区拉孜县', '拉孜县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2768', '西藏自治区日喀则地区昂仁县', '昂仁县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2769', '西藏自治区日喀则地区谢通门县', '谢通门县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2770', '西藏自治区日喀则地区白朗县', '白朗县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2771', '西藏自治区日喀则地区仁布县', '仁布县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2772', '西藏自治区日喀则地区康马县', '康马县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2773', '西藏自治区日喀则地区定结县', '定结县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2774', '西藏自治区日喀则地区仲巴县', '仲巴县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2775', '西藏自治区日喀则地区亚东县', '亚东县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2776', '西藏自治区日喀则地区吉隆县', '吉隆县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2777', '西藏自治区日喀则地区聂拉木县', '聂拉木县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2778', '西藏自治区日喀则地区萨嘎县', '萨嘎县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2779', '西藏自治区日喀则地区岗巴县', '岗巴县', ',2726,2761,', '2761', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2780', '西藏自治区那曲地区', '那曲地区', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2781', '西藏自治区那曲地区那曲县', '那曲县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2782', '西藏自治区那曲地区嘉黎县', '嘉黎县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2783', '西藏自治区那曲地区比如县', '比如县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2784', '西藏自治区那曲地区聂荣县', '聂荣县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2785', '西藏自治区那曲地区安多县', '安多县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2786', '西藏自治区那曲地区申扎县', '申扎县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2787', '西藏自治区那曲地区索县', '索县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2788', '西藏自治区那曲地区班戈县', '班戈县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2789', '西藏自治区那曲地区巴青县', '巴青县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2790', '西藏自治区那曲地区尼玛县', '尼玛县', ',2726,2780,', '2780', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2791', '西藏自治区阿里地区', '阿里地区', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2792', '西藏自治区阿里地区普兰县', '普兰县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2793', '西藏自治区阿里地区札达县', '札达县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2794', '西藏自治区阿里地区噶尔县', '噶尔县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2795', '西藏自治区阿里地区日土县', '日土县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2796', '西藏自治区阿里地区革吉县', '革吉县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2797', '西藏自治区阿里地区改则县', '改则县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2798', '西藏自治区阿里地区措勤县', '措勤县', ',2726,2791,', '2791', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2799', '西藏自治区林芝地区', '林芝地区', ',2726,', '2726', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2800', '西藏自治区林芝地区林芝县', '林芝县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2801', '西藏自治区林芝地区工布江达县', '工布江达县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2802', '西藏自治区林芝地区米林县', '米林县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2803', '西藏自治区林芝地区墨脱县', '墨脱县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2804', '西藏自治区林芝地区波密县', '波密县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2805', '西藏自治区林芝地区察隅县', '察隅县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2806', '西藏自治区林芝地区朗县', '朗县', ',2726,2799,', '2799', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2807', '陕西省', '陕西省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2808', '陕西省西安市', '西安市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2809', '陕西省西安市新城区', '新城区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2810', '陕西省西安市碑林区', '碑林区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2811', '陕西省西安市莲湖区', '莲湖区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2812', '陕西省西安市灞桥区', '灞桥区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2813', '陕西省西安市未央区', '未央区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2814', '陕西省西安市雁塔区', '雁塔区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2815', '陕西省西安市阎良区', '阎良区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2816', '陕西省西安市临潼区', '临潼区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2817', '陕西省西安市长安区', '长安区', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2818', '陕西省西安市蓝田县', '蓝田县', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2819', '陕西省西安市周至县', '周至县', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2820', '陕西省西安市户县', '户县', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2821', '陕西省西安市高陵县', '高陵县', ',2807,2808,', '2808', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2822', '陕西省铜川市', '铜川市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2823', '陕西省铜川市王益区', '王益区', ',2807,2822,', '2822', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2824', '陕西省铜川市印台区', '印台区', ',2807,2822,', '2822', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2825', '陕西省铜川市耀州区', '耀州区', ',2807,2822,', '2822', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2826', '陕西省铜川市宜君县', '宜君县', ',2807,2822,', '2822', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2827', '陕西省宝鸡市', '宝鸡市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2828', '陕西省宝鸡市渭滨区', '渭滨区', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2829', '陕西省宝鸡市金台区', '金台区', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2830', '陕西省宝鸡市陈仓区', '陈仓区', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2831', '陕西省宝鸡市凤翔县', '凤翔县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2832', '陕西省宝鸡市岐山县', '岐山县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2833', '陕西省宝鸡市扶风县', '扶风县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2834', '陕西省宝鸡市眉县', '眉县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2835', '陕西省宝鸡市陇县', '陇县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2836', '陕西省宝鸡市千阳县', '千阳县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2837', '陕西省宝鸡市麟游县', '麟游县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2838', '陕西省宝鸡市凤县', '凤县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2839', '陕西省宝鸡市太白县', '太白县', ',2807,2827,', '2827', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2840', '陕西省咸阳市', '咸阳市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2841', '陕西省咸阳市秦都区', '秦都区', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2842', '陕西省咸阳市杨陵区', '杨陵区', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2843', '陕西省咸阳市渭城区', '渭城区', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2844', '陕西省咸阳市三原县', '三原县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2845', '陕西省咸阳市泾阳县', '泾阳县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2846', '陕西省咸阳市乾县', '乾县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2847', '陕西省咸阳市礼泉县', '礼泉县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2848', '陕西省咸阳市永寿县', '永寿县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2849', '陕西省咸阳市彬县', '彬县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2850', '陕西省咸阳市长武县', '长武县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2851', '陕西省咸阳市旬邑县', '旬邑县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2852', '陕西省咸阳市淳化县', '淳化县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2853', '陕西省咸阳市武功县', '武功县', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2854', '陕西省咸阳市兴平市', '兴平市', ',2807,2840,', '2840', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2855', '陕西省渭南市', '渭南市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2856', '陕西省渭南市临渭区', '临渭区', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2857', '陕西省渭南市华县', '华县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2858', '陕西省渭南市潼关县', '潼关县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2859', '陕西省渭南市大荔县', '大荔县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2860', '陕西省渭南市合阳县', '合阳县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2861', '陕西省渭南市澄城县', '澄城县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2862', '陕西省渭南市蒲城县', '蒲城县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2863', '陕西省渭南市白水县', '白水县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2864', '陕西省渭南市富平县', '富平县', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2865', '陕西省渭南市韩城市', '韩城市', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2866', '陕西省渭南市华阴市', '华阴市', ',2807,2855,', '2855', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2867', '陕西省延安市', '延安市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2868', '陕西省延安市宝塔区', '宝塔区', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2869', '陕西省延安市延长县', '延长县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2870', '陕西省延安市延川县', '延川县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2871', '陕西省延安市子长县', '子长县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2872', '陕西省延安市安塞县', '安塞县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2873', '陕西省延安市志丹县', '志丹县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2874', '陕西省延安市吴起县', '吴起县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2875', '陕西省延安市甘泉县', '甘泉县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2876', '陕西省延安市富县', '富县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2877', '陕西省延安市洛川县', '洛川县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2878', '陕西省延安市宜川县', '宜川县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2879', '陕西省延安市黄龙县', '黄龙县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2880', '陕西省延安市黄陵县', '黄陵县', ',2807,2867,', '2867', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2881', '陕西省汉中市', '汉中市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2882', '陕西省汉中市汉台区', '汉台区', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2883', '陕西省汉中市南郑县', '南郑县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2884', '陕西省汉中市城固县', '城固县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2885', '陕西省汉中市洋县', '洋县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2886', '陕西省汉中市西乡县', '西乡县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2887', '陕西省汉中市勉县', '勉县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2888', '陕西省汉中市宁强县', '宁强县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2889', '陕西省汉中市略阳县', '略阳县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2890', '陕西省汉中市镇巴县', '镇巴县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2891', '陕西省汉中市留坝县', '留坝县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2892', '陕西省汉中市佛坪县', '佛坪县', ',2807,2881,', '2881', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2893', '陕西省榆林市', '榆林市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2894', '陕西省榆林市榆阳区', '榆阳区', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2895', '陕西省榆林市神木县', '神木县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2896', '陕西省榆林市府谷县', '府谷县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2897', '陕西省榆林市横山县', '横山县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2898', '陕西省榆林市靖边县', '靖边县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2899', '陕西省榆林市定边县', '定边县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2900', '陕西省榆林市绥德县', '绥德县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2901', '陕西省榆林市米脂县', '米脂县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2902', '陕西省榆林市佳县', '佳县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2903', '陕西省榆林市吴堡县', '吴堡县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2904', '陕西省榆林市清涧县', '清涧县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2905', '陕西省榆林市子洲县', '子洲县', ',2807,2893,', '2893', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2906', '陕西省安康市', '安康市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2907', '陕西省安康市汉滨区', '汉滨区', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2908', '陕西省安康市汉阴县', '汉阴县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2909', '陕西省安康市石泉县', '石泉县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2910', '陕西省安康市宁陕县', '宁陕县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2911', '陕西省安康市紫阳县', '紫阳县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2912', '陕西省安康市岚皋县', '岚皋县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2913', '陕西省安康市平利县', '平利县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2914', '陕西省安康市镇坪县', '镇坪县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2915', '陕西省安康市旬阳县', '旬阳县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2916', '陕西省安康市白河县', '白河县', ',2807,2906,', '2906', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2917', '陕西省商洛市', '商洛市', ',2807,', '2807', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2918', '陕西省商洛市商州区', '商州区', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2919', '陕西省商洛市洛南县', '洛南县', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2920', '陕西省商洛市丹凤县', '丹凤县', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2921', '陕西省商洛市商南县', '商南县', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2922', '陕西省商洛市山阳县', '山阳县', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2923', '陕西省商洛市镇安县', '镇安县', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2924', '陕西省商洛市柞水县', '柞水县', ',2807,2917,', '2917', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2925', '甘肃省', '甘肃省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2926', '甘肃省兰州市', '兰州市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2927', '甘肃省兰州市城关区', '城关区', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2928', '甘肃省兰州市七里河区', '七里河区', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2929', '甘肃省兰州市西固区', '西固区', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2930', '甘肃省兰州市安宁区', '安宁区', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2931', '甘肃省兰州市红古区', '红古区', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2932', '甘肃省兰州市永登县', '永登县', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2933', '甘肃省兰州市皋兰县', '皋兰县', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2934', '甘肃省兰州市榆中县', '榆中县', ',2925,2926,', '2926', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2935', '甘肃省嘉峪关市', '嘉峪关市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2936', '甘肃省金昌市', '金昌市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2937', '甘肃省金昌市金川区', '金川区', ',2925,2936,', '2936', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2938', '甘肃省金昌市永昌县', '永昌县', ',2925,2936,', '2936', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2939', '甘肃省白银市', '白银市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2940', '甘肃省白银市白银区', '白银区', ',2925,2939,', '2939', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2941', '甘肃省白银市平川区', '平川区', ',2925,2939,', '2939', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2942', '甘肃省白银市靖远县', '靖远县', ',2925,2939,', '2939', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2943', '甘肃省白银市会宁县', '会宁县', ',2925,2939,', '2939', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2944', '甘肃省白银市景泰县', '景泰县', ',2925,2939,', '2939', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2945', '甘肃省天水市', '天水市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2946', '甘肃省天水市秦州区', '秦州区', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2947', '甘肃省天水市麦积区', '麦积区', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2948', '甘肃省天水市清水县', '清水县', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2949', '甘肃省天水市秦安县', '秦安县', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2950', '甘肃省天水市甘谷县', '甘谷县', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2951', '甘肃省天水市武山县', '武山县', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2952', '甘肃省天水市张家川回族自治县', '张家川回族自治县', ',2925,2945,', '2945', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2953', '甘肃省武威市', '武威市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2954', '甘肃省武威市凉州区', '凉州区', ',2925,2953,', '2953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2955', '甘肃省武威市民勤县', '民勤县', ',2925,2953,', '2953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2956', '甘肃省武威市古浪县', '古浪县', ',2925,2953,', '2953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2957', '甘肃省武威市天祝藏族自治县', '天祝藏族自治县', ',2925,2953,', '2953', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2958', '甘肃省张掖市', '张掖市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2959', '甘肃省张掖市甘州区', '甘州区', ',2925,2958,', '2958', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2960', '甘肃省张掖市肃南裕固族自治县', '肃南裕固族自治县', ',2925,2958,', '2958', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2961', '甘肃省张掖市民乐县', '民乐县', ',2925,2958,', '2958', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2962', '甘肃省张掖市临泽县', '临泽县', ',2925,2958,', '2958', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2963', '甘肃省张掖市高台县', '高台县', ',2925,2958,', '2958', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2964', '甘肃省张掖市山丹县', '山丹县', ',2925,2958,', '2958', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2965', '甘肃省平凉市', '平凉市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2966', '甘肃省平凉市崆峒区', '崆峒区', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2967', '甘肃省平凉市泾川县', '泾川县', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2968', '甘肃省平凉市灵台县', '灵台县', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2969', '甘肃省平凉市崇信县', '崇信县', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2970', '甘肃省平凉市华亭县', '华亭县', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2971', '甘肃省平凉市庄浪县', '庄浪县', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2972', '甘肃省平凉市静宁县', '静宁县', ',2925,2965,', '2965', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2973', '甘肃省酒泉市', '酒泉市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2974', '甘肃省酒泉市肃州区', '肃州区', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2975', '甘肃省酒泉市金塔县', '金塔县', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2976', '甘肃省酒泉市瓜州县', '瓜州县', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2977', '甘肃省酒泉市肃北蒙古族自治县', '肃北蒙古族自治县', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2978', '甘肃省酒泉市阿克塞哈萨克族自治县', '阿克塞哈萨克族自治县', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2979', '甘肃省酒泉市玉门市', '玉门市', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2980', '甘肃省酒泉市敦煌市', '敦煌市', ',2925,2973,', '2973', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2981', '甘肃省庆阳市', '庆阳市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2982', '甘肃省庆阳市西峰区', '西峰区', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2983', '甘肃省庆阳市庆城县', '庆城县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2984', '甘肃省庆阳市环县', '环县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2985', '甘肃省庆阳市华池县', '华池县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2986', '甘肃省庆阳市合水县', '合水县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2987', '甘肃省庆阳市正宁县', '正宁县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2988', '甘肃省庆阳市宁县', '宁县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2989', '甘肃省庆阳市镇原县', '镇原县', ',2925,2981,', '2981', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2990', '甘肃省定西市', '定西市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2991', '甘肃省定西市安定区', '安定区', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2992', '甘肃省定西市通渭县', '通渭县', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2993', '甘肃省定西市陇西县', '陇西县', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2994', '甘肃省定西市渭源县', '渭源县', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2995', '甘肃省定西市临洮县', '临洮县', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2996', '甘肃省定西市漳县', '漳县', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2997', '甘肃省定西市岷县', '岷县', ',2925,2990,', '2990', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2998', '甘肃省陇南市', '陇南市', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('2999', '甘肃省陇南市武都区', '武都区', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3000', '甘肃省陇南市成县', '成县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3001', '甘肃省陇南市文县', '文县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3002', '甘肃省陇南市宕昌县', '宕昌县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3003', '甘肃省陇南市康县', '康县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3004', '甘肃省陇南市西和县', '西和县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3005', '甘肃省陇南市礼县', '礼县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3006', '甘肃省陇南市徽县', '徽县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3007', '甘肃省陇南市两当县', '两当县', ',2925,2998,', '2998', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3008', '甘肃省临夏回族自治州', '临夏回族自治州', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3009', '甘肃省临夏回族自治州临夏市', '临夏市', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3010', '甘肃省临夏回族自治州临夏县', '临夏县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3011', '甘肃省临夏回族自治州康乐县', '康乐县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3012', '甘肃省临夏回族自治州永靖县', '永靖县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3013', '甘肃省临夏回族自治州广河县', '广河县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3014', '甘肃省临夏回族自治州和政县', '和政县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3015', '甘肃省临夏回族自治州东乡族自治县', '东乡族自治县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3016', '甘肃省临夏回族自治州积石山保安族东乡族撒拉族自治县', '积石山保安族东乡族撒拉族自治县', ',2925,3008,', '3008', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3017', '甘肃省甘南藏族自治州', '甘南藏族自治州', ',2925,', '2925', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3018', '甘肃省甘南藏族自治州合作市', '合作市', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3019', '甘肃省甘南藏族自治州临潭县', '临潭县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3020', '甘肃省甘南藏族自治州卓尼县', '卓尼县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3021', '甘肃省甘南藏族自治州舟曲县', '舟曲县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3022', '甘肃省甘南藏族自治州迭部县', '迭部县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3023', '甘肃省甘南藏族自治州玛曲县', '玛曲县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3024', '甘肃省甘南藏族自治州碌曲县', '碌曲县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3025', '甘肃省甘南藏族自治州夏河县', '夏河县', ',2925,3017,', '3017', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3026', '青海省', '青海省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3027', '青海省西宁市', '西宁市', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3028', '青海省西宁市城东区', '城东区', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3029', '青海省西宁市城中区', '城中区', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3030', '青海省西宁市城西区', '城西区', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3031', '青海省西宁市城北区', '城北区', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3032', '青海省西宁市大通回族土族自治县', '大通回族土族自治县', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3033', '青海省西宁市湟中县', '湟中县', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3034', '青海省西宁市湟源县', '湟源县', ',3026,3027,', '3027', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3035', '青海省海东地区', '海东地区', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3036', '青海省海东地区平安县', '平安县', ',3026,3035,', '3035', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3037', '青海省海东地区民和回族土族自治县', '民和回族土族自治县', ',3026,3035,', '3035', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3038', '青海省海东地区乐都县', '乐都县', ',3026,3035,', '3035', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3039', '青海省海东地区互助土族自治县', '互助土族自治县', ',3026,3035,', '3035', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3040', '青海省海东地区化隆回族自治县', '化隆回族自治县', ',3026,3035,', '3035', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3041', '青海省海东地区循化撒拉族自治县', '循化撒拉族自治县', ',3026,3035,', '3035', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3042', '青海省海北藏族自治州', '海北藏族自治州', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3043', '青海省海北藏族自治州门源回族自治县', '门源回族自治县', ',3026,3042,', '3042', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3044', '青海省海北藏族自治州祁连县', '祁连县', ',3026,3042,', '3042', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3045', '青海省海北藏族自治州海晏县', '海晏县', ',3026,3042,', '3042', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3046', '青海省海北藏族自治州刚察县', '刚察县', ',3026,3042,', '3042', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3047', '青海省黄南藏族自治州', '黄南藏族自治州', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3048', '青海省黄南藏族自治州同仁县', '同仁县', ',3026,3047,', '3047', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3049', '青海省黄南藏族自治州尖扎县', '尖扎县', ',3026,3047,', '3047', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3050', '青海省黄南藏族自治州泽库县', '泽库县', ',3026,3047,', '3047', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3051', '青海省黄南藏族自治州河南蒙古族自治县', '河南蒙古族自治县', ',3026,3047,', '3047', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3052', '青海省海南藏族自治州', '海南藏族自治州', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3053', '青海省海南藏族自治州共和县', '共和县', ',3026,3052,', '3052', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3054', '青海省海南藏族自治州同德县', '同德县', ',3026,3052,', '3052', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3055', '青海省海南藏族自治州贵德县', '贵德县', ',3026,3052,', '3052', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3056', '青海省海南藏族自治州兴海县', '兴海县', ',3026,3052,', '3052', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3057', '青海省海南藏族自治州贵南县', '贵南县', ',3026,3052,', '3052', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3058', '青海省果洛藏族自治州', '果洛藏族自治州', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3059', '青海省果洛藏族自治州玛沁县', '玛沁县', ',3026,3058,', '3058', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3060', '青海省果洛藏族自治州班玛县', '班玛县', ',3026,3058,', '3058', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3061', '青海省果洛藏族自治州甘德县', '甘德县', ',3026,3058,', '3058', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3062', '青海省果洛藏族自治州达日县', '达日县', ',3026,3058,', '3058', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3063', '青海省果洛藏族自治州久治县', '久治县', ',3026,3058,', '3058', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3064', '青海省果洛藏族自治州玛多县', '玛多县', ',3026,3058,', '3058', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3065', '青海省玉树藏族自治州', '玉树藏族自治州', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3066', '青海省玉树藏族自治州玉树县', '玉树县', ',3026,3065,', '3065', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3067', '青海省玉树藏族自治州杂多县', '杂多县', ',3026,3065,', '3065', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3068', '青海省玉树藏族自治州称多县', '称多县', ',3026,3065,', '3065', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3069', '青海省玉树藏族自治州治多县', '治多县', ',3026,3065,', '3065', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3070', '青海省玉树藏族自治州囊谦县', '囊谦县', ',3026,3065,', '3065', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3071', '青海省玉树藏族自治州曲麻莱县', '曲麻莱县', ',3026,3065,', '3065', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3072', '青海省海西蒙古族藏族自治州', '海西蒙古族藏族自治州', ',3026,', '3026', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3073', '青海省海西蒙古族藏族自治州格尔木市', '格尔木市', ',3026,3072,', '3072', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3074', '青海省海西蒙古族藏族自治州德令哈市', '德令哈市', ',3026,3072,', '3072', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3075', '青海省海西蒙古族藏族自治州乌兰县', '乌兰县', ',3026,3072,', '3072', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3076', '青海省海西蒙古族藏族自治州都兰县', '都兰县', ',3026,3072,', '3072', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3077', '青海省海西蒙古族藏族自治州天峻县', '天峻县', ',3026,3072,', '3072', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3078', '宁夏回族自治区', '宁夏回族自治区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3079', '宁夏回族自治区银川市', '银川市', ',3078,', '3078', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3080', '宁夏回族自治区银川市兴庆区', '兴庆区', ',3078,3079,', '3079', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3081', '宁夏回族自治区银川市西夏区', '西夏区', ',3078,3079,', '3079', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3082', '宁夏回族自治区银川市金凤区', '金凤区', ',3078,3079,', '3079', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3083', '宁夏回族自治区银川市永宁县', '永宁县', ',3078,3079,', '3079', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3084', '宁夏回族自治区银川市贺兰县', '贺兰县', ',3078,3079,', '3079', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3085', '宁夏回族自治区银川市灵武市', '灵武市', ',3078,3079,', '3079', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3086', '宁夏回族自治区石嘴山市', '石嘴山市', ',3078,', '3078', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3087', '宁夏回族自治区石嘴山市大武口区', '大武口区', ',3078,3086,', '3086', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3088', '宁夏回族自治区石嘴山市惠农区', '惠农区', ',3078,3086,', '3086', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3089', '宁夏回族自治区石嘴山市平罗县', '平罗县', ',3078,3086,', '3086', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3090', '宁夏回族自治区吴忠市', '吴忠市', ',3078,', '3078', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3091', '宁夏回族自治区吴忠市利通区', '利通区', ',3078,3090,', '3090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3092', '宁夏回族自治区吴忠市红寺堡区', '红寺堡区', ',3078,3090,', '3090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3093', '宁夏回族自治区吴忠市盐池县', '盐池县', ',3078,3090,', '3090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3094', '宁夏回族自治区吴忠市同心县', '同心县', ',3078,3090,', '3090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3095', '宁夏回族自治区吴忠市青铜峡市', '青铜峡市', ',3078,3090,', '3090', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3096', '宁夏回族自治区固原市', '固原市', ',3078,', '3078', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3097', '宁夏回族自治区固原市原州区', '原州区', ',3078,3096,', '3096', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3098', '宁夏回族自治区固原市西吉县', '西吉县', ',3078,3096,', '3096', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3099', '宁夏回族自治区固原市隆德县', '隆德县', ',3078,3096,', '3096', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3100', '宁夏回族自治区固原市泾源县', '泾源县', ',3078,3096,', '3096', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3101', '宁夏回族自治区固原市彭阳县', '彭阳县', ',3078,3096,', '3096', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3102', '宁夏回族自治区中卫市', '中卫市', ',3078,', '3078', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3103', '宁夏回族自治区中卫市沙坡头区', '沙坡头区', ',3078,3102,', '3102', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3104', '宁夏回族自治区中卫市中宁县', '中宁县', ',3078,3102,', '3102', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3105', '宁夏回族自治区中卫市海原县', '海原县', ',3078,3102,', '3102', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3106', '新疆维吾尔自治区', '新疆维吾尔自治区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3107', '新疆维吾尔自治区乌鲁木齐市', '乌鲁木齐市', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3108', '新疆维吾尔自治区乌鲁木齐市天山区', '天山区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3109', '新疆维吾尔自治区乌鲁木齐市沙依巴克区', '沙依巴克区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3110', '新疆维吾尔自治区乌鲁木齐市新市区', '新市区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3111', '新疆维吾尔自治区乌鲁木齐市水磨沟区', '水磨沟区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3112', '新疆维吾尔自治区乌鲁木齐市头屯河区', '头屯河区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3113', '新疆维吾尔自治区乌鲁木齐市达坂城区', '达坂城区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3114', '新疆维吾尔自治区乌鲁木齐市米东区', '米东区', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3115', '新疆维吾尔自治区乌鲁木齐市乌鲁木齐县', '乌鲁木齐县', ',3106,3107,', '3107', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3116', '新疆维吾尔自治区克拉玛依市', '克拉玛依市', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3117', '新疆维吾尔自治区克拉玛依市独山子区', '独山子区', ',3106,3116,', '3116', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3118', '新疆维吾尔自治区克拉玛依市克拉玛依区', '克拉玛依区', ',3106,3116,', '3116', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3119', '新疆维吾尔自治区克拉玛依市白碱滩区', '白碱滩区', ',3106,3116,', '3116', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3120', '新疆维吾尔自治区克拉玛依市乌尔禾区', '乌尔禾区', ',3106,3116,', '3116', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3121', '新疆维吾尔自治区吐鲁番地区', '吐鲁番地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3122', '新疆维吾尔自治区吐鲁番地区吐鲁番市', '吐鲁番市', ',3106,3121,', '3121', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3123', '新疆维吾尔自治区吐鲁番地区鄯善县', '鄯善县', ',3106,3121,', '3121', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3124', '新疆维吾尔自治区吐鲁番地区托克逊县', '托克逊县', ',3106,3121,', '3121', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3125', '新疆维吾尔自治区哈密地区', '哈密地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3126', '新疆维吾尔自治区哈密地区哈密市', '哈密市', ',3106,3125,', '3125', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3127', '新疆维吾尔自治区哈密地区巴里坤哈萨克自治县', '巴里坤哈萨克自治县', ',3106,3125,', '3125', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3128', '新疆维吾尔自治区哈密地区伊吾县', '伊吾县', ',3106,3125,', '3125', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3129', '新疆维吾尔自治区昌吉回族自治州', '昌吉回族自治州', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3130', '新疆维吾尔自治区昌吉回族自治州昌吉市', '昌吉市', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3131', '新疆维吾尔自治区昌吉回族自治州阜康市', '阜康市', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3132', '新疆维吾尔自治区昌吉回族自治州呼图壁县', '呼图壁县', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3133', '新疆维吾尔自治区昌吉回族自治州玛纳斯县', '玛纳斯县', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3134', '新疆维吾尔自治区昌吉回族自治州奇台县', '奇台县', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3135', '新疆维吾尔自治区昌吉回族自治州吉木萨尔县', '吉木萨尔县', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3136', '新疆维吾尔自治区昌吉回族自治州木垒哈萨克自治县', '木垒哈萨克自治县', ',3106,3129,', '3129', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3137', '新疆维吾尔自治区博尔塔拉蒙古自治州', '博尔塔拉蒙古自治州', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3138', '新疆维吾尔自治区博尔塔拉蒙古自治州博乐市', '博乐市', ',3106,3137,', '3137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3139', '新疆维吾尔自治区博尔塔拉蒙古自治州精河县', '精河县', ',3106,3137,', '3137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3140', '新疆维吾尔自治区博尔塔拉蒙古自治州温泉县', '温泉县', ',3106,3137,', '3137', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3141', '新疆维吾尔自治区巴音郭楞蒙古自治州', '巴音郭楞蒙古自治州', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3142', '新疆维吾尔自治区巴音郭楞蒙古自治州库尔勒市', '库尔勒市', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3143', '新疆维吾尔自治区巴音郭楞蒙古自治州轮台县', '轮台县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3144', '新疆维吾尔自治区巴音郭楞蒙古自治州尉犁县', '尉犁县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3145', '新疆维吾尔自治区巴音郭楞蒙古自治州若羌县', '若羌县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3146', '新疆维吾尔自治区巴音郭楞蒙古自治州且末县', '且末县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3147', '新疆维吾尔自治区巴音郭楞蒙古自治州焉耆回族自治县', '焉耆回族自治县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3148', '新疆维吾尔自治区巴音郭楞蒙古自治州和静县', '和静县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3149', '新疆维吾尔自治区巴音郭楞蒙古自治州和硕县', '和硕县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3150', '新疆维吾尔自治区巴音郭楞蒙古自治州博湖县', '博湖县', ',3106,3141,', '3141', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3151', '新疆维吾尔自治区阿克苏地区', '阿克苏地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3152', '新疆维吾尔自治区阿克苏地区阿克苏市', '阿克苏市', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3153', '新疆维吾尔自治区阿克苏地区温宿县', '温宿县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3154', '新疆维吾尔自治区阿克苏地区库车县', '库车县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3155', '新疆维吾尔自治区阿克苏地区沙雅县', '沙雅县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3156', '新疆维吾尔自治区阿克苏地区新和县', '新和县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3157', '新疆维吾尔自治区阿克苏地区拜城县', '拜城县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3158', '新疆维吾尔自治区阿克苏地区乌什县', '乌什县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3159', '新疆维吾尔自治区阿克苏地区阿瓦提县', '阿瓦提县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3160', '新疆维吾尔自治区阿克苏地区柯坪县', '柯坪县', ',3106,3151,', '3151', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3161', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州', '克孜勒苏柯尔克孜自治州', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3162', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州阿图什市', '阿图什市', ',3106,3161,', '3161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3163', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州阿克陶县', '阿克陶县', ',3106,3161,', '3161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3164', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州阿合奇县', '阿合奇县', ',3106,3161,', '3161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3165', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州乌恰县', '乌恰县', ',3106,3161,', '3161', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3166', '新疆维吾尔自治区喀什地区', '喀什地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3167', '新疆维吾尔自治区喀什地区喀什市', '喀什市', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3168', '新疆维吾尔自治区喀什地区疏附县', '疏附县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3169', '新疆维吾尔自治区喀什地区疏勒县', '疏勒县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3170', '新疆维吾尔自治区喀什地区英吉沙县', '英吉沙县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3171', '新疆维吾尔自治区喀什地区泽普县', '泽普县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3172', '新疆维吾尔自治区喀什地区莎车县', '莎车县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3173', '新疆维吾尔自治区喀什地区叶城县', '叶城县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3174', '新疆维吾尔自治区喀什地区麦盖提县', '麦盖提县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3175', '新疆维吾尔自治区喀什地区岳普湖县', '岳普湖县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3176', '新疆维吾尔自治区喀什地区伽师县', '伽师县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3177', '新疆维吾尔自治区喀什地区巴楚县', '巴楚县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3178', '新疆维吾尔自治区喀什地区塔什库尔干塔吉克自治县', '塔什库尔干塔吉克自治县', ',3106,3166,', '3166', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3179', '新疆维吾尔自治区和田地区', '和田地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3180', '新疆维吾尔自治区和田地区和田市', '和田市', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3181', '新疆维吾尔自治区和田地区和田县', '和田县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3182', '新疆维吾尔自治区和田地区墨玉县', '墨玉县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3183', '新疆维吾尔自治区和田地区皮山县', '皮山县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3184', '新疆维吾尔自治区和田地区洛浦县', '洛浦县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3185', '新疆维吾尔自治区和田地区策勒县', '策勒县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3186', '新疆维吾尔自治区和田地区于田县', '于田县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3187', '新疆维吾尔自治区和田地区民丰县', '民丰县', ',3106,3179,', '3179', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3188', '新疆维吾尔自治区伊犁哈萨克自治州', '伊犁哈萨克自治州', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3189', '新疆维吾尔自治区伊犁哈萨克自治州伊宁市', '伊宁市', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3190', '新疆维吾尔自治区伊犁哈萨克自治州奎屯市', '奎屯市', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3191', '新疆维吾尔自治区伊犁哈萨克自治州伊宁县', '伊宁县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3192', '新疆维吾尔自治区伊犁哈萨克自治州察布查尔锡伯自治县', '察布查尔锡伯自治县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3193', '新疆维吾尔自治区伊犁哈萨克自治州霍城县', '霍城县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3194', '新疆维吾尔自治区伊犁哈萨克自治州巩留县', '巩留县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3195', '新疆维吾尔自治区伊犁哈萨克自治州新源县', '新源县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3196', '新疆维吾尔自治区伊犁哈萨克自治州昭苏县', '昭苏县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3197', '新疆维吾尔自治区伊犁哈萨克自治州特克斯县', '特克斯县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3198', '新疆维吾尔自治区伊犁哈萨克自治州尼勒克县', '尼勒克县', ',3106,3188,', '3188', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3199', '新疆维吾尔自治区塔城地区', '塔城地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3200', '新疆维吾尔自治区塔城地区塔城市', '塔城市', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3201', '新疆维吾尔自治区塔城地区乌苏市', '乌苏市', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3202', '新疆维吾尔自治区塔城地区额敏县', '额敏县', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3203', '新疆维吾尔自治区塔城地区沙湾县', '沙湾县', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3204', '新疆维吾尔自治区塔城地区托里县', '托里县', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3205', '新疆维吾尔自治区塔城地区裕民县', '裕民县', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3206', '新疆维吾尔自治区塔城地区和布克赛尔蒙古自治县', '和布克赛尔蒙古自治县', ',3106,3199,', '3199', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3207', '新疆维吾尔自治区阿勒泰地区', '阿勒泰地区', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3208', '新疆维吾尔自治区阿勒泰地区阿勒泰市', '阿勒泰市', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3209', '新疆维吾尔自治区阿勒泰地区布尔津县', '布尔津县', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3210', '新疆维吾尔自治区阿勒泰地区富蕴县', '富蕴县', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3211', '新疆维吾尔自治区阿勒泰地区福海县', '福海县', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3212', '新疆维吾尔自治区阿勒泰地区哈巴河县', '哈巴河县', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3213', '新疆维吾尔自治区阿勒泰地区青河县', '青河县', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3214', '新疆维吾尔自治区阿勒泰地区吉木乃县', '吉木乃县', ',3106,3207,', '3207', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3215', '新疆维吾尔自治区石河子市', '石河子市', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3216', '新疆维吾尔自治区阿拉尔市', '阿拉尔市', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3217', '新疆维吾尔自治区图木舒克市', '图木舒克市', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3218', '新疆维吾尔自治区五家渠市', '五家渠市', ',3106,', '3106', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3219', '台湾省', '台湾省', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3220', '台湾省台北市', '台北市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3221', '台湾省高雄市', '高雄市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3222', '台湾省台南市', '台南市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3223', '台湾省台中市', '台中市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3224', '台湾省金门县', '金门县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3225', '台湾省南投县', '南投县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3226', '台湾省基隆市', '基隆市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3227', '台湾省新竹市', '新竹市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3228', '台湾省嘉义市', '嘉义市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3229', '台湾省新北市', '新北市', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3230', '台湾省宜兰县', '宜兰县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3231', '台湾省新竹县', '新竹县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3232', '台湾省桃园县', '桃园县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3233', '台湾省苗栗县', '苗栗县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3234', '台湾省彰化县', '彰化县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3235', '台湾省嘉义县', '嘉义县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3236', '台湾省云林县', '云林县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3237', '台湾省屏东县', '屏东县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3238', '台湾省台东县', '台东县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3239', '台湾省花莲县', '花莲县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3240', '台湾省澎湖县', '澎湖县', ',3219,', '3219', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3241', '台湾省台北市中正区', '中正区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3242', '台湾省台北市大同区', '大同区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3243', '台湾省台北市中山区', '中山区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3244', '台湾省台北市松山区', '松山区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3245', '台湾省台北市大安区', '大安区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3246', '台湾省台北市万华区', '万华区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3247', '台湾省台北市信义区', '信义区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3248', '台湾省台北市士林区', '士林区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3249', '台湾省台北市北投区', '北投区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3250', '台湾省台北市内湖区', '内湖区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3251', '台湾省台北市南港区', '南港区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3252', '台湾省台北市文山区', '文山区', ',3219,3220,', '3220', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3253', '台湾省嘉义县东区', '东区', ',3219,3235,', '3235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3254', '台湾省嘉义县西区', '西区', ',3219,3235,', '3235', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3255', '台湾省高雄市新兴区', '新兴区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3256', '台湾省高雄市前金区', '前金区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3257', '台湾省高雄市芩雅区', '芩雅区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3258', '台湾省高雄市盐埕区', '盐埕区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3259', '台湾省高雄市鼓山区', '鼓山区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3260', '台湾省高雄市旗津区', '旗津区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3261', '台湾省高雄市前镇区', '前镇区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3262', '台湾省高雄市三民区', '三民区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3263', '台湾省高雄市左营区', '左营区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3264', '台湾省高雄市楠梓区', '楠梓区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3265', '台湾省高雄市小港区', '小港区', ',3219,3221,', '3221', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3266', '台湾省基隆市仁爱区', '仁爱区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3267', '台湾省基隆市信义区', '信义区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3268', '台湾省基隆市中正区', '中正区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3269', '台湾省基隆市中山区', '中山区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3270', '台湾省基隆市安乐区', '安乐区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3271', '台湾省基隆市暖暖区', '暖暖区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3272', '台湾省基隆市七堵区', '七堵区', ',3219,3226,', '3226', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3273', '台湾省台南市中西区', '中西区', ',3219,3222,', '3222', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3274', '台湾省台南市东区', '东区', ',3219,3222,', '3222', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3275', '台湾省台南市南区', '南区', ',3219,3222,', '3222', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3276', '台湾省台南市北区', '北区', ',3219,3222,', '3222', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3277', '台湾省台南市安平区', '安平区', ',3219,3222,', '3222', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3278', '台湾省台南市安南区', '安南区', ',3219,3222,', '3222', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3279', '台湾省新竹市东区', '东区', ',3219,3227,', '3227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3280', '台湾省新竹市北区', '北区', ',3219,3227,', '3227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3281', '台湾省新竹市香山区', '香山区', ',3219,3227,', '3227', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3282', '台湾省台中市中区', '中区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3283', '台湾省台中市东区', '东区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3284', '台湾省台中市南区', '南区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3285', '台湾省台中市西区', '西区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3286', '台湾省台中市北区', '北区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3287', '台湾省台中市北屯区', '北屯区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3288', '台湾省台中市西屯区', '西屯区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3289', '台湾省台中市南屯区', '南屯区', ',3219,3223,', '3223', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3290', '台湾省嘉义市东区', '东区', ',3219,3228,', '3228', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3291', '台湾省嘉义市西区', '西区', ',3219,3228,', '3228', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3292', '香港特别行政区', '香港特别行政区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3293', '香港特别行政区香港岛', '香港岛', ',3292,', '3292', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3294', '香港特别行政区九龙', '九龙', ',3292,', '3292', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3295', '香港特别行政区新界', '新界', ',3292,', '3292', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3296', '香港特别行政区九龙九龙城区', '九龙城区', ',3292,3294,', '3294', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3297', '香港特别行政区九龙油尖旺区', '油尖旺区', ',3292,3294,', '3294', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3298', '香港特别行政区九龙深水埗区', '深水埗区', ',3292,3294,', '3294', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3299', '香港特别行政区九龙黄大仙区', '黄大仙区', ',3292,3294,', '3294', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3300', '香港特别行政区九龙观塘区', '观塘区', ',3292,3294,', '3294', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3301', '香港特别行政区香港岛中西区', '中西区', ',3292,3293,', '3293', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3302', '香港特别行政区香港岛湾仔', '湾仔', ',3292,3293,', '3293', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3303', '香港特别行政区香港岛东区', '东区', ',3292,3293,', '3293', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3304', '香港特别行政区香港岛南区', '南区', ',3292,3293,', '3293', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3305', '香港特别行政区新界北区', '北区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3306', '香港特别行政区新界大埔区', '大埔区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3307', '香港特别行政区新界沙田区', '沙田区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3308', '香港特别行政区新界西贡区', '西贡区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3309', '香港特别行政区新界元朗区', '元朗区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3310', '香港特别行政区新界屯门区', '屯门区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3311', '香港特别行政区新界荃湾区', '荃湾区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3312', '香港特别行政区新界葵青区', '葵青区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3313', '香港特别行政区新界离岛区', '离岛区', ',3292,3295,', '3295', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3314', '澳门特别行政区', '澳门特别行政区', ',', null, null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3315', '澳门特别行政区澳门半岛', '澳门半岛', ',3314,', '3314', null, null, null, '');
INSERT INTO `hwh_area` VALUES ('3316', '澳门特别行政区离岛', '离岛', ',3314,', '3314', null, null, null, '');

-- ----------------------------
-- Table structure for `hwh_article`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_article`;
CREATE TABLE `hwh_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `uid` int(11) NOT NULL COMMENT '发布者ID',
  `categoryId` int(11) NOT NULL COMMENT '类别id',
  `uid_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发布者类型（1为后台发布  2为用户发布）',
  `author` varchar(32) DEFAULT NULL COMMENT '作者',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `jianjie` varchar(255) DEFAULT NULL COMMENT '文章简介',
  `content` text COMMENT '文章内容',
  `img_url` varchar(255) DEFAULT NULL COMMENT '文章封面图片',
  `view_count` int(11) DEFAULT '0' COMMENT '浏览量',
  `comment_count` int(11) DEFAULT '0' COMMENT '评论量',
  `like_count` int(11) DEFAULT '0' COMMENT '点赞量',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶 0不置顶 1置顶',
  `is_recommend` tinyint(4) DEFAULT '0' COMMENT '是否推荐 0不推荐 1推荐',
  `is_ok` tinyint(1) DEFAULT '1' COMMENT '是否显示（1显示  0不显示）',
  `is_black` tinyint(1) DEFAULT '0' COMMENT '是否已拉入黑名单（0：否   1：是）',
  `is_fine` tinyint(1) DEFAULT '0' COMMENT '是否是fine类型（0：不是，1：是）',
  `create_date` datetime DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of hwh_article
-- ----------------------------
INSERT INTO `hwh_article` VALUES ('1', '1', '0', '2', '呵呵哒', '随便写的', '临场发挥，好好好', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0013.gif\"/><img src=\"http://img.baidu.com/hi/jx2/j_0026.gif\"/></p>', 'http://haoziweb.com.cn/Public/Uploads/article/20170518/1495077221_179485_591d116538e1c.jpg', '111', '35', '2', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_article` VALUES ('2', '1', '0', '2', '呵呵哒', '好好的', '婀三六九等劳动时间', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0013.gif\"/></p>', 'http://haoziweb.com.cn/Public/Uploads/article/20170619/1497857602_146979_59477e42e0105.jpg', '2', '0', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_article` VALUES ('3', '1', '0', '2', '呵呵哒', '人长大了，幸福感却弱了', '小时候渴望长了，可长了，幸福感却弱了', '<p>有人问我：幸福感是什么？<br/>　　<br/>　　我说，小的时候，和小伙伴一起去放羊，一起下河捉鱼；过年的时候，男生有鞭炮放，女生有花儿玩；除夕夜和家人在一起看春晚；夏天的时候拿上一角钱买根老冰棍；妈妈骑着自行车带我去镇上赶集等等，这些都是幸福感。<br/>　　<br/>　　人长大了，幸福感却弱了。<br/>　　<br/>　　相信，很多人都有这个感觉，随着年龄的不断增长，幸福感越来越弱。究其原因，是经济发展的影响，还是文化素质的提高；是生活节奏的加快，还是物质丰富的冲击。<br/>　　<br/>　　以前，大家都很穷，住的是草房，吃的是窝头，喝的是白开水，穿的是旧衣，交通工具是自行车或者步行；现在，钱多了，住的是楼房，吃的是山珍海味，喝的是琼浆玉液，穿的是名牌，交通工具轻则汽车，重则私人飞机。<br/>　　<br/>　　钱多了，幸福感却少了。<br/>　　<br/>　　幸福感是一种长久的、内在的、坚定的心理状态，并非短暂的情绪体验。幸福与否并不是赚钱时的快乐，也不是花钱时的痛快，它在很大程度上取决于很多与财富无关的因素，例如身体健康、工作稳定、婚姻状况、心理追求以及人际关系等，这与个人对生活的认识、社会的发展也有很大关系。<br/>　　<br/>　　不能知足常乐，或是幸福感缺失的原因之一。欲望太强，感觉什么事情都满足不了，从而想去追求更多，幸福感则变得更加少了。<br/>　　<br/>　　被周围的人和事同化，攀比之风盛行，也是幸福感下降的重要因素之一。不忘初心，保持心态，或许幸福感能够随风自来。</p>', 'http://haoziweb.com.cn/Public/Uploads/article/20170630/1498807466_648343_5955fcaae8acb.jpg', '7', '0', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_article` VALUES ('4', '1', '0', '2', '呵呵哒', '哈哈', '发 枯要要', '<p>有人问我：幸福感是什么？　　<br/>　　我说，小的时候，和小伙伴一起去放羊，一起下河捉鱼；过年的时候，男生有鞭炮放，女生有花儿玩；除夕夜和家人在一起看春晚；夏天的时候拿上一角钱买根老冰棍；妈妈骑着自行车带我去镇上赶集等等，这些都是幸福感。<br/>　　人长大了，幸福感却弱了。<br/>　　相信，很多人都有这个感觉，随着年龄的不断增长，幸福感越来越弱。究其原因，是经济发展的影响，还是文化素质的提高；是生活节奏的加快，还是物质丰富的冲击。<br/>　　以前，大家都很穷，住的是草房，吃的是窝头，喝的是白开水，穿的是旧衣，交通工具是自行车或者步行；现在，钱多了，住的是楼房，吃的是山珍海味，喝的是琼浆玉液，穿的是名牌，交通工具轻则汽车，重则私人飞机。<br/>　　钱多了，幸福感却少了。<br/>　　幸福感是一种长久的、内在的、坚定的心理状态，并非短暂的情绪体验。幸福与否并不是赚钱时的快乐，也不是花钱时的痛快，它在很大程度上取决于很多与财富无关的因素，例如身体健康、工作稳定、婚姻状况、心理追求以及人际关系等，这与个人对生活的认识、社会的发展也有很大关系。<br/>　　不能知足常乐，或是幸福感缺失的原因之一。欲望太强，感觉什么事情都满足不了，从而想去追求更多，幸福感则变得更加少了。<br/>　　被周围的人和事同化，攀比之风盛行，也是幸福感下降的重要因素之一。不忘初心，保持心态，或许幸福感能够随风自来。</p>', 'http://haoziweb.com.cn/Public/Uploads/article/20170630/1498807570_582071_5955fd1225182.jpg', '7', '0', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_article` VALUES ('5', '1', '0', '2', '呵呵哒', '辊枯要在', '枯要枯要要', '<p>有人问我：幸福感是什么？<br/>　　我说，小的时候，和小伙伴一起去放羊，一起下河捉鱼；过年的时候，男生有鞭炮放，女生有花儿玩；除夕夜和家人在一起看春晚；夏天的时候拿上一角钱买根老冰棍；妈妈骑着自行车带我去镇上赶集等等，这些都是幸福感。</p><p>　　人长大了，幸福感却弱了。</p><p>　　相信，很多人都有这个感觉，随着年龄的不断增长，幸福感越来越弱。究其原因，是经济发展的影响，还是文化素质的提高；是生活节奏的加快，还是物质丰富的冲击。<br/>　　以前，大家都很穷，住的是草房，吃的是窝头，喝的是白开水，穿的是旧衣，交通工具是自行车或者步行；现在，钱多了，住的是楼房，吃的是山珍海味，喝的是琼浆玉液，穿的是名牌，交通工具轻则汽车，重则私人飞机。</p><p>　　钱多了，幸福感却少了。</p><p>　　幸福感是一种长久的、内在的、坚定的心理状态，并非短暂的情绪体验。幸福与否并不是赚钱时的快乐，也不是花钱时的痛快，它在很大程度上取决于很多与财富无关的因素，例如身体健康、工作稳定、婚姻状况、心理追求以及人际关系等，这与个人对生活的认识、社会的发展也有很大关系。</p><p>　　不能知足常乐，或是幸福感缺失的原因之一。欲望太强，感觉什么事情都满足不了，从而想去追求更多，幸福感则变得更加少了。</p><p>　　被周围的人和事同化，攀比之风盛行，也是幸福感下降的重要因素之一。不忘初心，保持心态，或许幸福感能够随风自来。</p>', 'http://haoziweb.com.cn/Public/Uploads/article/20170630/1498807652_722314_5955fd6413708.jpg', '30', '3', '1', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_article` VALUES ('6', '1', '0', '2', '呵呵哒', '呵呵sd', '枯要厅枯厅大哥哥', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0005.gif\"/></p>', 'http://haozi.com.cn/Public/Uploads/article/20170807/1502074106_241488_5987d4fabb647.jpg', '7', '0', '3', '0', '1', '1', '0', '0', '2017-08-07 10:48:26');
INSERT INTO `hwh_article` VALUES ('15', '1', '7', '1', '哎哟大文豪', '有类别的文章', '枯枯枯枯要要', '<p>枯要无可奈何村地顶替要<br/></p>', 'http://haozi.com.cn/Public/Uploads/article/1511862923_727035_5a1d328bcae17.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_article` VALUES ('16', '1', '10', '1', '哎哟大文豪', '呵呵哒', '无聊呆', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0008.gif\"/>枯要无可奈何村地顶替要</p>', 'http://haozi.com.cn/Public/Uploads/article/20170619/20180426171934.jpg', '0', '0', '0', '0', '0', '1', '0', '1', '2017-11-29 09:42:09');

-- ----------------------------
-- Table structure for `hwh_article_category`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_article_category`;
CREATE TABLE `hwh_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT '0' COMMENT '对应的分类父id（0代表顶级分类）',
  `name` varchar(50) NOT NULL COMMENT '类别名称',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='类别表（文章类别）';

-- ----------------------------
-- Records of hwh_article_category
-- ----------------------------
INSERT INTO `hwh_article_category` VALUES ('1', '0', '要要', '2018-04-26 17:53:49', '2018-04-26 17:53:52');

-- ----------------------------
-- Table structure for `hwh_article_comment`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_article_comment`;
CREATE TABLE `hwh_article_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论Id',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `article_id` int(11) DEFAULT NULL COMMENT '文章id',
  `parent_id` int(11) DEFAULT '0' COMMENT '二级评论id（与id对应 0为一级评论）',
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `state` tinyint(4) DEFAULT '1' COMMENT '状态 1显示 0不显示',
  `create_date` datetime DEFAULT NULL COMMENT '评论时间',
  `type` tinyint(4) DEFAULT '0' COMMENT '评论类型（0：PC端  1：手机端）（手机端base64加密存储）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='文章评论表';

-- ----------------------------
-- Records of hwh_article_comment
-- ----------------------------
INSERT INTO `hwh_article_comment` VALUES ('28', '1', '1', '0', 'abc', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('29', '1', '1', '28', '2222', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('30', '1', '1', '28', 'abc12', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('31', '1', '1', '0', 'bbb', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('32', '1', '1', '0', 'ddd', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('33', '1', '1', '0', 'eee', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('34', '1', '1', '31', '好样的，', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('35', '1', '16', '33', '哈哈，好样的哟，成功了', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('36', '1', '5', '0', 'sdsds', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('37', '1', '5', '0', 'sdsds', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('38', '1', '16', '0', 'wwwww', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_article_comment` VALUES ('39', '1', '16', '0', '啦啦~\\(≧▽≦)/~啦啦啦', '1', '2018-04-25 14:27:28', '0');
INSERT INTO `hwh_article_comment` VALUES ('40', '1', '16', '0', '加盟中曙是男是女', '1', '2018-04-25 14:30:33', '0');
INSERT INTO `hwh_article_comment` VALUES ('41', '1', '16', '0', '呦呦呦呦', '1', '2018-04-25 14:52:13', '0');
INSERT INTO `hwh_article_comment` VALUES ('42', '1', '16', '0', '吼吼吼吼吼', '1', '2018-04-25 14:53:40', '0');
INSERT INTO `hwh_article_comment` VALUES ('43', '1', '16', '0', '吼吼吼吼吼吼田国国', '1', '2018-04-25 14:54:04', '0');
INSERT INTO `hwh_article_comment` VALUES ('44', '2', '16', '0', '[em_4]无语', '1', '2018-04-26 11:44:10', '0');
INSERT INTO `hwh_article_comment` VALUES ('45', '2', '16', '0', '[em_37]我们另是国[em_7]', '1', '2018-04-26 13:49:31', '0');

-- ----------------------------
-- Table structure for `hwh_article_img`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_article_img`;
CREATE TABLE `hwh_article_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `article_id` int(11) DEFAULT NULL COMMENT '文章ID',
  `article_img` varchar(225) DEFAULT NULL COMMENT '文章内容相关图片',
  `state` tinyint(1) DEFAULT '1' COMMENT '状态 1显示 0不显示',
  `create_date` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章内容图片';

-- ----------------------------
-- Records of hwh_article_img
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_article_like`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_article_like`;
CREATE TABLE `hwh_article_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户ID(游客点赞记录所在IP地址)',
  `acticle_id` int(11) DEFAULT NULL COMMENT '文章ID',
  `like` tinyint(1) DEFAULT '1' COMMENT '点赞数量1',
  `create_date` datetime DEFAULT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='文章点赞表';

-- ----------------------------
-- Records of hwh_article_like
-- ----------------------------
INSERT INTO `hwh_article_like` VALUES ('1', '1', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `hwh_article_like` VALUES ('2', '1', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `hwh_article_like` VALUES ('3', '1', '5', '1', '0000-00-00 00:00:00');
INSERT INTO `hwh_article_like` VALUES ('4', '127.0.0.1', '6', '1', '2017-11-24 09:23:57');
INSERT INTO `hwh_article_like` VALUES ('5', '127.0.0.1', '6', '1', '2017-11-24 09:25:16');
INSERT INTO `hwh_article_like` VALUES ('6', '127.0.0.1', '6', '1', '2017-11-24 09:25:34');

-- ----------------------------
-- Table structure for `hwh_attribute_name`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_attribute_name`;
CREATE TABLE `hwh_attribute_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '属性id',
  `attrName` varchar(50) NOT NULL COMMENT '属性名称',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='属性名称表';

-- ----------------------------
-- Records of hwh_attribute_name
-- ----------------------------
INSERT INTO `hwh_attribute_name` VALUES ('1', '颜色', '2018-03-27 11:15:04', null);
INSERT INTO `hwh_attribute_name` VALUES ('2', '尺码', '2018-03-27 11:15:29', null);
INSERT INTO `hwh_attribute_name` VALUES ('3', '材质', '2018-03-30 15:11:07', null);

-- ----------------------------
-- Table structure for `hwh_attribute_value`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_attribute_value`;
CREATE TABLE `hwh_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attrNameId` int(11) NOT NULL COMMENT '与属性表关联',
  `value` varchar(50) NOT NULL COMMENT '属性值内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='属性值表';

-- ----------------------------
-- Records of hwh_attribute_value
-- ----------------------------
INSERT INTO `hwh_attribute_value` VALUES ('1', '1', '红色');
INSERT INTO `hwh_attribute_value` VALUES ('2', '1', '黑色');
INSERT INTO `hwh_attribute_value` VALUES ('3', '1', '白色');
INSERT INTO `hwh_attribute_value` VALUES ('4', '2', 'X');
INSERT INTO `hwh_attribute_value` VALUES ('5', '2', 'XL');
INSERT INTO `hwh_attribute_value` VALUES ('6', '3', '纯棉');

-- ----------------------------
-- Table structure for `hwh_exam`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_exam`;
CREATE TABLE `hwh_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paperName` varchar(100) NOT NULL COMMENT '试卷名称',
  `exerciseTime` int(11) DEFAULT '15' COMMENT '答题多长时间（单位分钟）',
  `startDate` datetime DEFAULT NULL COMMENT '开放答题时间',
  `endDate` datetime DEFAULT NULL COMMENT '截止答题时间',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `remake` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='试卷表';

-- ----------------------------
-- Records of hwh_exam
-- ----------------------------
INSERT INTO `hwh_exam` VALUES ('1', 'kjkj', '10', '2017-12-04 00:00:00', '2017-12-05 00:00:00', '2017-12-04 09:25:42', '');
INSERT INTO `hwh_exam` VALUES ('2', '哈哈哈哈哈哈哈哈', '10', '2017-12-04 00:00:00', '2017-12-05 00:00:00', '2017-12-04 14:00:21', '');

-- ----------------------------
-- Table structure for `hwh_exam_question`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_exam_question`;
CREATE TABLE `hwh_exam_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `examId` int(11) NOT NULL COMMENT '试卷id',
  `title` varchar(255) NOT NULL COMMENT '题目标题',
  `optionA` varchar(255) DEFAULT NULL COMMENT '题目选项A',
  `optionB` varchar(255) DEFAULT NULL COMMENT '题目选项B',
  `optionC` varchar(255) DEFAULT NULL COMMENT '题目选项C',
  `optionD` varchar(255) DEFAULT NULL COMMENT '题目选项D',
  `type` tinyint(1) DEFAULT '1' COMMENT '单选或多选（1单选  2多选）',
  `rightOption` varchar(20) DEFAULT NULL COMMENT '正确答案（多个以,号连接）',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `a` (`examId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='试卷题目表';

-- ----------------------------
-- Records of hwh_exam_question
-- ----------------------------
INSERT INTO `hwh_exam_question` VALUES ('1', '2', '我们都是坏孩子', '哈哈', '呵呵', '嘿嘿', '嘻嘻', '1', 'B', null);
INSERT INTO `hwh_exam_question` VALUES ('2', '2', '你喜欢什么', 'PHP', 'JAVA', 'MYSQL', 'C++', '2', 'A|C', null);

-- ----------------------------
-- Table structure for `hwh_exam_rank_list`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_exam_rank_list`;
CREATE TABLE `hwh_exam_rank_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `examId` int(11) NOT NULL COMMENT '试卷id',
  `userId` int(11) NOT NULL COMMENT '用户id',
  `rightNum` int(11) DEFAULT '0' COMMENT '正确答题数',
  `errorNum` int(11) DEFAULT '0' COMMENT '错误答题数',
  `accuracy` int(11) DEFAULT '0' COMMENT '正确率',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间（用户提交答案时间）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户答题排行榜';

-- ----------------------------
-- Records of hwh_exam_rank_list
-- ----------------------------
INSERT INTO `hwh_exam_rank_list` VALUES ('1', '2', '7', '0', '1', '0', '2017-12-06 11:34:51');
INSERT INTO `hwh_exam_rank_list` VALUES ('2', '2', '7', '0', '1', '0', '2017-12-06 13:56:06');
INSERT INTO `hwh_exam_rank_list` VALUES ('3', '2', '7', '3', '1', '150', '2017-12-07 14:41:56');
INSERT INTO `hwh_exam_rank_list` VALUES ('4', '2', '7', '5', '3', '250', '2017-12-08 14:24:01');
INSERT INTO `hwh_exam_rank_list` VALUES ('5', '2', '7', '2', '0', '100', '2017-12-08 14:24:35');

-- ----------------------------
-- Table structure for `hwh_exam_user_result`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_exam_user_result`;
CREATE TABLE `hwh_exam_user_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `examId` int(11) NOT NULL COMMENT '试卷id（与表hwh_exam关联）',
  `questionId` int(11) NOT NULL COMMENT '题目id（与表exam_papre_question关联）',
  `userOption` varchar(20) DEFAULT NULL COMMENT '用户选项（多个以,号连接）',
  `quesOption` varchar(20) DEFAULT NULL COMMENT '正确选项（多个以,号连接）',
  `isRightOption` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否正确（1正确  2不正确）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户答题结果表';

-- ----------------------------
-- Records of hwh_exam_user_result
-- ----------------------------
INSERT INTO `hwh_exam_user_result` VALUES ('9', '7', '2', '0', null, null, '1');
INSERT INTO `hwh_exam_user_result` VALUES ('10', '7', '2', '0', '', null, '1');

-- ----------------------------
-- Table structure for `hwh_excel`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_excel`;
CREATE TABLE `hwh_excel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `excel` varchar(255) DEFAULT NULL COMMENT '导入的excel存储路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='excel导入表';

-- ----------------------------
-- Records of hwh_excel
-- ----------------------------
INSERT INTO `hwh_excel` VALUES ('8', '1', './Public/Uploads/excel/1502099519.xlsx');

-- ----------------------------
-- Table structure for `hwh_file_upload`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_file_upload`;
CREATE TABLE `hwh_file_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminId` int(11) NOT NULL COMMENT '上传者id（与hwh_admin相关联）',
  `filename` varchar(100) NOT NULL COMMENT '文件名称',
  `fileSuffix` varchar(20) NOT NULL COMMENT '文件后缀（如txt, doc）',
  `fileUrl` varchar(100) NOT NULL COMMENT '上传成功的文件地址',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文件上传';

-- ----------------------------
-- Records of hwh_file_upload
-- ----------------------------
INSERT INTO `hwh_file_upload` VALUES ('3', '1', '重复', '.xlsx', 'Public/Uploads/document/重复.xlsx', '2018-01-12 16:04:53');

-- ----------------------------
-- Table structure for `hwh_goods`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_goods`;
CREATE TABLE `hwh_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) NOT NULL COMMENT '商品分类id',
  `attrNameIdList` varchar(30) DEFAULT NULL COMMENT '属性名称id列表（如：1,2）（与hwh_attribute_name表关联）',
  `attrNameList` varchar(30) DEFAULT NULL COMMENT '属性名称列表（如：颜色,尺码）',
  `name` varchar(255) NOT NULL COMMENT '商品名称',
  `price` double(14,2) NOT NULL COMMENT '商品售价',
  `oldPrice` double(14,2) DEFAULT NULL COMMENT '商品原价',
  `soldNum` int(11) DEFAULT '0' COMMENT '销售数量',
  `img` varchar(255) DEFAULT NULL COMMENT '封面图',
  `unitName` varchar(20) DEFAULT '件' COMMENT '数量单位名称，如: 件，名额，张',
  `isMarketable` tinyint(1) DEFAULT '1' COMMENT '是否上架：0否  1是',
  `description` text COMMENT '商品详情',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of hwh_goods
-- ----------------------------
INSERT INTO `hwh_goods` VALUES ('5', '1', '1,2', '颜色,尺码', '不知道什么鬼', '66.00', '99.00', '0', null, '', '1', null, '2018-03-30 10:44:20', null);
INSERT INTO `hwh_goods` VALUES ('6', '2', '1,2,3', '颜色,尺码,材质', 'T恤', '99.00', '125.00', '0', null, '', '1', null, '2018-03-30 10:45:20', '2018-03-30 18:01:02');

-- ----------------------------
-- Table structure for `hwh_goods_cart`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_goods_cart`;
CREATE TABLE `hwh_goods_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `goodsNum` int(11) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `amount` double(14,2) NOT NULL COMMENT '商品总价格',
  `attrValue1` varchar(100) DEFAULT NULL COMMENT '商品规格1',
  `attrValue2` varchar(100) DEFAULT NULL COMMENT '商品规格2',
  `attrValue3` varchar(100) DEFAULT NULL COMMENT '商品规格3',
  `isok` tinyint(1) DEFAULT '1' COMMENT '是否正常（0：已失效，1：正常 ）',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车';

-- ----------------------------
-- Records of hwh_goods_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_goods_category`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_goods_category`;
CREATE TABLE `hwh_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT '0' COMMENT '与id关联（0表示父类）',
  `name` varchar(30) DEFAULT NULL COMMENT '分类名称',
  `orderNum` int(11) DEFAULT '1' COMMENT '排序号',
  `isShow` tinyint(1) DEFAULT '1' COMMENT '是否显示 ：  0否  1是',
  `image` varchar(255) DEFAULT NULL COMMENT '形象图',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of hwh_goods_category
-- ----------------------------
INSERT INTO `hwh_goods_category` VALUES ('1', '0', '衣服', '1', '1', '', '2018-03-27 11:16:43', null);
INSERT INTO `hwh_goods_category` VALUES ('2', '1', '上衣', '5', '1', '', '2018-03-30 10:31:19', null);

-- ----------------------------
-- Table structure for `hwh_goods_collect`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_goods_collect`;
CREATE TABLE `hwh_goods_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `createDate` datetime DEFAULT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品收藏表';

-- ----------------------------
-- Records of hwh_goods_collect
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_goods_comment`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_goods_comment`;
CREATE TABLE `hwh_goods_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `type` tinyint(4) DEFAULT '1' COMMENT '评论状态（1：好评  2：中评  3：差评）',
  `content` text COMMENT '评论内容',
  `createDate` datetime DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品评论表';

-- ----------------------------
-- Records of hwh_goods_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_goods_store`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_goods_store`;
CREATE TABLE `hwh_goods_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `attrValue1` varchar(255) DEFAULT NULL COMMENT '属性规格1',
  `attrValue2` varchar(255) DEFAULT NULL COMMENT '属性规格2',
  `attrValue3` varchar(255) DEFAULT NULL COMMENT '属性规格3',
  `price` double(14,2) DEFAULT NULL COMMENT '商品价格',
  `stock` int(11) DEFAULT NULL COMMENT '库存数量',
  `soldNum` int(11) DEFAULT '0' COMMENT '已售数量',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `goodsId` (`goodsId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='商品库存表（属性规格）';

-- ----------------------------
-- Records of hwh_goods_store
-- ----------------------------
INSERT INTO `hwh_goods_store` VALUES ('17', '6', '白色', 'X', '纯棉', '99.00', '97', '0', '2018-04-10 10:57:52', null);
INSERT INTO `hwh_goods_store` VALUES ('18', '6', '黑色', 'XL', '', '99.00', '0', '0', '2018-03-30 17:48:53', null);

-- ----------------------------
-- Table structure for `hwh_joke`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_joke`;
CREATE TABLE `hwh_joke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '发布者ID',
  `uid_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发布者类型（1为后台发布  2为用户发布）',
  `author` varchar(30) NOT NULL COMMENT '发布人',
  `img` varchar(255) DEFAULT NULL COMMENT '封面图（不传则为用户头像）',
  `content` text COMMENT '内容',
  `like_count` int(11) DEFAULT '0' COMMENT '点赞数量',
  `maketime` datetime DEFAULT NULL COMMENT '发布时间',
  `is_ok` tinyint(1) DEFAULT '1' COMMENT '是否显示（1显示 0不显示）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hwh_joke
-- ----------------------------
INSERT INTO `hwh_joke` VALUES ('7', '1', '2', '呵呵哒', null, 'kkkkk', '0', '2017-08-09 16:35:24', '0');
INSERT INTO `hwh_joke` VALUES ('5', '1', '2', '呵呵哒', null, 'ggfgfggf', '0', '2017-08-09 16:29:32', '0');
INSERT INTO `hwh_joke` VALUES ('6', '1', '2', '呵呵哒', 'http://haozi.com.cn/Public/Uploads/user/20170525/1495697977_771607_59268a3996c59.jpg', 'hhhhh', '0', '2017-08-09 16:30:37', '0');

-- ----------------------------
-- Table structure for `hwh_joke_like`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_joke_like`;
CREATE TABLE `hwh_joke_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户ID(游客点赞记录所在IP地址)',
  `joke_id` int(11) DEFAULT NULL COMMENT '笑话ID',
  `like` tinyint(1) DEFAULT '1' COMMENT '点赞数量1',
  `create_date` datetime DEFAULT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='幽默笑话点赞表';

-- ----------------------------
-- Records of hwh_joke_like
-- ----------------------------
INSERT INTO `hwh_joke_like` VALUES ('1', '1', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `hwh_joke_like` VALUES ('2', '1', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `hwh_joke_like` VALUES ('3', '1', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `hwh_joke_like` VALUES ('4', '127.0.0.1', '1', '1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `hwh_order`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_order`;
CREATE TABLE `hwh_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `orderNo` varchar(255) NOT NULL COMMENT '订单号',
  `totalAmount` double(14,2) DEFAULT NULL COMMENT '订单总金额',
  `payAmount` double(14,2) DEFAULT NULL COMMENT '订单应付金额',
  `payState` tinyint(4) DEFAULT '1' COMMENT '支付状态（1：未支付  2：已支付  3：已过期  4：已取消）',
  `shipState` tinyint(4) DEFAULT '1' COMMENT '发货状态（1：未发货  2：已发货  3：已收货   4：退货、退款）',
  `shipAdressId` int(11) DEFAULT NULL COMMENT '收货地址id（与表hwh_ship_adress表关联）',
  `isComment` tinyint(1) DEFAULT '1' COMMENT '是否已评论（1：未评论   2：已评论） 这个字段主要是判断是否已评论了',
  `expressCompany` varchar(100) DEFAULT NULL COMMENT '快递公司名',
  `expressNumber` varchar(30) DEFAULT NULL COMMENT '快递公司单号',
  `expressDate` datetime DEFAULT NULL COMMENT '寄出日期',
  `postage` double(14,2) DEFAULT '0.00' COMMENT '邮费',
  `payChannel` varchar(50) DEFAULT 'wx' COMMENT '支付渠道. alipay:支付宝APP支付,wx:微信APP支付,upacp:银联APP支付,offline:线下支付',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  `payDate` datetime DEFAULT NULL COMMENT '支付时间',
  `remake` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of hwh_order
-- ----------------------------
INSERT INTO `hwh_order` VALUES ('1', '1', 'H17092910473711506653257', '55.00', '55.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2017-09-29 10:47:37', null, null, null);
INSERT INTO `hwh_order` VALUES ('2', '1', 'H17092910540811506653648', '77.00', '77.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2017-09-29 10:54:08', null, null, null);
INSERT INTO `hwh_order` VALUES ('3', '1', 'H17093009144211506734082', '55.00', '55.00', '2', '4', '1', '1', null, null, null, '0.00', 'wx', '2017-09-30 09:14:42', null, null, null);
INSERT INTO `hwh_order` VALUES ('6', '1', '180307', '55.00', '55.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:47:09', null, null, '12');
INSERT INTO `hwh_order` VALUES ('7', '2', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:48:22', null, null, '12');
INSERT INTO `hwh_order` VALUES ('8', '4', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:48:49', null, null, '12');
INSERT INTO `hwh_order` VALUES ('9', '3', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:49:05', null, null, '12');
INSERT INTO `hwh_order` VALUES ('10', '5', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:49:17', null, null, '12');
INSERT INTO `hwh_order` VALUES ('11', '6', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:49:27', null, null, '12');
INSERT INTO `hwh_order` VALUES ('12', '7', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:49:35', null, null, '12');
INSERT INTO `hwh_order` VALUES ('13', '8', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:49:46', null, null, '12');
INSERT INTO `hwh_order` VALUES ('14', '9', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:49:53', null, null, '12');
INSERT INTO `hwh_order` VALUES ('15', '10', '180307', '55.00', '55.00', '1', '1', '0', '1', null, null, null, '0.00', 'wx', '2018-03-07 17:50:07', null, null, '12');
INSERT INTO `hwh_order` VALUES ('16', '7', 'H18040311065271522724812', '99.00', '99.00', '1', '1', '2', '1', null, null, null, '0.00', 'wx', '2018-04-03 11:06:52', null, null, null);
INSERT INTO `hwh_order` VALUES ('17', '1', 'H18040809583911523152719', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 09:58:39', null, null, null);
INSERT INTO `hwh_order` VALUES ('18', '1', 'H18040810051711523153117', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:05:17', null, null, null);
INSERT INTO `hwh_order` VALUES ('19', '1', 'H18040810082311523153303', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:08:23', null, null, null);
INSERT INTO `hwh_order` VALUES ('20', '1', 'H18040810152911523153729', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:15:29', null, null, null);
INSERT INTO `hwh_order` VALUES ('21', '1', 'H18040810183211523153912', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:18:32', null, null, null);
INSERT INTO `hwh_order` VALUES ('22', '1', 'H18040810192011523153960', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:19:20', null, null, null);
INSERT INTO `hwh_order` VALUES ('23', '1', 'H18040810200511523154005', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:20:05', null, null, null);
INSERT INTO `hwh_order` VALUES ('24', '1', 'H18040810224911523154169', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:22:49', null, null, null);
INSERT INTO `hwh_order` VALUES ('25', '1', 'H18040810463111523155591', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:46:31', null, null, null);
INSERT INTO `hwh_order` VALUES ('26', '1', 'H18040810485611523155736', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:48:56', null, null, null);
INSERT INTO `hwh_order` VALUES ('27', '1', 'H18040810493411523155774', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:49:34', null, null, null);
INSERT INTO `hwh_order` VALUES ('28', '1', 'H18040810514811523155908', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:51:48', null, null, null);
INSERT INTO `hwh_order` VALUES ('29', '1', 'H18040810543411523156074', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-08 10:54:34', null, null, null);
INSERT INTO `hwh_order` VALUES ('42', '3', 'H18040909561231523238972', '100.00', '100.00', '1', '1', null, '1', null, null, null, '0.00', 'wx', '2018-04-09 09:56:12', null, null, '商品抢购测试');
INSERT INTO `hwh_order` VALUES ('43', '1', 'H18040909564811523239008', '100.00', '100.00', '1', '1', null, '1', null, null, null, '0.00', 'wx', '2018-04-09 09:56:48', null, null, '商品抢购测试');
INSERT INTO `hwh_order` VALUES ('44', '2', 'H18040909570521523239025', '100.00', '100.00', '1', '1', null, '1', null, null, null, '0.00', 'wx', '2018-04-09 09:57:05', null, null, '商品抢购测试');
INSERT INTO `hwh_order` VALUES ('45', '5', 'H18040904592251523264362', '99.00', '99.00', '1', '1', '5', '1', null, null, null, '0.00', 'wx', '2018-04-09 16:59:22', null, null, null);
INSERT INTO `hwh_order` VALUES ('46', '1', 'H18041010255411523327154', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-10 10:25:54', null, null, null);
INSERT INTO `hwh_order` VALUES ('47', '1', 'H18041010315111523327511', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-10 10:31:51', null, null, null);
INSERT INTO `hwh_order` VALUES ('48', '1', 'H18041010432711523328207', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-10 10:43:27', null, null, null);
INSERT INTO `hwh_order` VALUES ('49', '1', 'H18041010571911523329039', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-10 10:57:19', null, null, null);
INSERT INTO `hwh_order` VALUES ('50', '1', 'H18041010575211523329072', '99.00', '99.00', '1', '1', '1', '1', null, null, null, '0.00', 'wx', '2018-04-10 10:57:52', null, null, null);

-- ----------------------------
-- Table structure for `hwh_order_item`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_order_item`;
CREATE TABLE `hwh_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL COMMENT '订单id',
  `goodsId` int(11) NOT NULL COMMENT '商品id',
  `price` double(14,2) NOT NULL COMMENT '商品售价',
  `goodsNum` int(11) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `amount` double(14,2) NOT NULL COMMENT '商品总价格',
  `attrValue1` varchar(100) DEFAULT NULL COMMENT '商品规格1',
  `attrValue2` varchar(100) DEFAULT NULL COMMENT '商品规格2',
  `attrValue3` varchar(100) DEFAULT NULL COMMENT '商品规格3',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='订单详情表';

-- ----------------------------
-- Records of hwh_order_item
-- ----------------------------
INSERT INTO `hwh_order_item` VALUES ('1', '1', '12', '55.00', '1', '55.00', '纯棉', null, null, '2017-09-29 10:47:37', null);
INSERT INTO `hwh_order_item` VALUES ('2', '2', '14', '77.00', '1', '77.00', '羊毛', null, null, '2017-09-29 10:54:08', null);
INSERT INTO `hwh_order_item` VALUES ('3', '3', '12', '55.00', '1', '55.00', '纯棉', null, null, '2017-09-30 09:14:42', null);
INSERT INTO `hwh_order_item` VALUES ('4', '16', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-03 11:06:52', null);
INSERT INTO `hwh_order_item` VALUES ('5', '17', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 09:58:39', null);
INSERT INTO `hwh_order_item` VALUES ('6', '18', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:05:17', null);
INSERT INTO `hwh_order_item` VALUES ('7', '19', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:08:23', null);
INSERT INTO `hwh_order_item` VALUES ('8', '20', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:15:29', null);
INSERT INTO `hwh_order_item` VALUES ('9', '21', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:18:32', null);
INSERT INTO `hwh_order_item` VALUES ('10', '22', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:19:20', null);
INSERT INTO `hwh_order_item` VALUES ('11', '23', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:20:05', null);
INSERT INTO `hwh_order_item` VALUES ('12', '24', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:22:49', null);
INSERT INTO `hwh_order_item` VALUES ('13', '25', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:46:31', null);
INSERT INTO `hwh_order_item` VALUES ('14', '26', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:48:56', null);
INSERT INTO `hwh_order_item` VALUES ('15', '27', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:49:34', null);
INSERT INTO `hwh_order_item` VALUES ('16', '28', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:51:48', null);
INSERT INTO `hwh_order_item` VALUES ('17', '29', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-08 10:54:34', null);
INSERT INTO `hwh_order_item` VALUES ('18', '45', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-09 16:59:22', null);
INSERT INTO `hwh_order_item` VALUES ('19', '46', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-10 10:25:54', null);
INSERT INTO `hwh_order_item` VALUES ('20', '47', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-10 10:31:51', null);
INSERT INTO `hwh_order_item` VALUES ('21', '48', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-10 10:43:27', null);
INSERT INTO `hwh_order_item` VALUES ('22', '49', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-10 10:57:19', null);
INSERT INTO `hwh_order_item` VALUES ('23', '50', '6', '99.00', '1', '99.00', '白色', 'X', null, '2018-04-10 10:57:52', null);

-- ----------------------------
-- Table structure for `hwh_user`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user`;
CREATE TABLE `hwh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(32) DEFAULT NULL COMMENT '用户名',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `nickname` varchar(60) DEFAULT NULL COMMENT '昵称',
  `u_birthday` varchar(255) DEFAULT NULL COMMENT '生日',
  `u_img` varchar(255) DEFAULT NULL COMMENT '个人头像',
  `u_photo` int(11) DEFAULT NULL COMMENT '个人相册',
  `u_sign` varchar(255) DEFAULT NULL COMMENT '个性签名',
  `province` varchar(50) DEFAULT NULL COMMENT '省',
  `city` varchar(50) DEFAULT NULL COMMENT '市',
  `district` varchar(50) DEFAULT NULL COMMENT '区',
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `qq_openid` varchar(255) DEFAULT NULL COMMENT 'QQ的openid',
  `weix_openid` varchar(255) DEFAULT NULL COMMENT 'weix的openid',
  `remember_me` tinyint(4) DEFAULT '0' COMMENT '记住密码（默认0不记住，1记住）',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `states` tinyint(1) DEFAULT '0' COMMENT '是否激活（0未激活  1已激活）',
  `activate_code` varchar(255) DEFAULT NULL COMMENT '激活码',
  `activate_code_times` int(11) DEFAULT NULL COMMENT '激活码有效时间',
  `regist_time` datetime DEFAULT NULL COMMENT '注册时间',
  `token` varchar(255) DEFAULT NULL COMMENT '用户登录的token',
  `password_leven` tinyint(1) DEFAULT '1' COMMENT '密码强弱（1较弱   2一般   3安全）',
  `reset_password_code` varchar(255) DEFAULT '' COMMENT '密码找回识别码',
  `reset_password_state` tinyint(1) DEFAULT '0' COMMENT '是否有权限重置密码（0没有  1有）',
  `login_way` tinyint(1) DEFAULT '0' COMMENT '（登录方式）0：账号登录   1：qq登录',
  `is_black` tinyint(1) DEFAULT '0' COMMENT '是否已是黑名单用户（0不是  1是）',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hwh_user
-- ----------------------------
INSERT INTO `hwh_user` VALUES ('1', 'dawenhao', 'e10adc3949ba59abbe56e057f20f883e', '呵呵哒', '5,5', 'http://haozi.com.cn/Public/Uploads/user/20170525/1495697977_771607_59268a3996c59.jpg', null, '我们都是坏孩子', '湖北省', '仙桃市', '', '陈场镇火星村', '', '', '0', '', '1', '', '1510276292', '0000-00-00 00:00:00', '', '1', '', '0', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `hwh_user` VALUES ('2', 'a', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'http://haozi.com.cn/Public/Uploads/user/20170524/1495620031_351170_592559bf1cad7.jpg', null, null, null, null, null, null, null, null, '0', null, '1', null, null, null, null, '1', '', '0', '0', '0', null);
INSERT INTO `hwh_user` VALUES ('3', 'b', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, '0', null, '1', null, null, null, null, '1', '', '0', '0', '0', null);
INSERT INTO `hwh_user` VALUES ('4', 'c', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, '0', null, '1', null, null, null, null, '1', '', '0', '0', '0', null);
INSERT INTO `hwh_user` VALUES ('5', 'd', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, '0', null, '1', null, null, null, null, '1', '', '0', '0', '0', null);
INSERT INTO `hwh_user` VALUES ('6', 'e', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, '0', null, '1', null, null, null, null, '1', '', '0', '0', '0', null);
INSERT INTO `hwh_user` VALUES ('7', 'f', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, '0', null, '1', null, null, null, null, '1', '', '0', '0', '0', null);
INSERT INTO `hwh_user` VALUES ('8', '豪子666', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, '0', '1165092460@qq.com', '1', '', '0', '2018-04-26 15:22:29', null, '1', '7de58a10808ee677e948ad3759552465', '0', '0', '0', null);

-- ----------------------------
-- Table structure for `hwh_user_log`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_log`;
CREATE TABLE `hwh_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_time` datetime DEFAULT NULL COMMENT '操作时间',
  `user_ip` varchar(25) DEFAULT NULL COMMENT '用户登录IP',
  `user_type` tinyint(1) DEFAULT '1' COMMENT '操作类型（1用户登录  2修改密码）',
  `login_type` tinyint(1) DEFAULT '1' COMMENT '登录类型（1：账号登录  2：QQ号登录）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hwh_user_log
-- ----------------------------
INSERT INTO `hwh_user_log` VALUES ('1', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('2', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('3', '31', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('4', '32', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('5', '32', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('6', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('7', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('8', '32', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('9', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('10', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('11', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('12', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('13', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('14', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('15', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('16', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('17', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('18', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('19', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('20', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('21', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('22', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('23', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('24', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('25', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('26', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('27', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('28', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('29', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('30', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('31', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('32', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('33', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('34', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('35', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('36', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('37', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('38', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('39', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('40', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('41', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('42', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('43', '2', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('44', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('45', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('46', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('47', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('48', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('49', '1', '0000-00-00 00:00:00', '127.0.0.1', '1', '0');
INSERT INTO `hwh_user_log` VALUES ('50', '1', '2017-08-02 17:39:57', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('51', '1', '2017-08-07 09:59:00', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('52', '1', '2017-08-09 14:34:37', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('53', '1', '2017-08-10 09:27:36', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('54', '1', '2017-08-21 15:07:02', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('55', '1', '2017-08-29 15:56:09', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('56', '1', '2017-09-06 10:48:38', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('57', '1', '2017-09-07 09:16:54', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('58', '1', '2017-09-08 09:35:59', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('59', '1', '2017-09-11 15:07:56', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('60', '1', '2017-09-12 10:27:14', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('61', '1', '2017-09-13 15:22:08', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('62', '1', '2017-09-14 09:20:03', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('63', '1', '2017-09-15 10:51:54', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('64', '1', '2017-09-18 09:24:11', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('65', '1', '2017-09-19 09:30:35', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('66', '1', '2017-09-20 14:53:09', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('67', '1', '2017-09-21 14:13:36', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('68', '1', '2017-09-21 14:36:30', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('69', '1', '2017-09-22 09:27:46', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('70', '1', '2017-09-25 10:33:11', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('71', '1', '2017-09-29 09:55:10', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('72', '1', '2017-09-30 09:14:29', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('73', '1', '2017-10-11 11:12:35', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('74', '1', '2017-10-12 09:15:08', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('75', '7', '2017-11-13 14:07:47', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('76', '7', '2017-11-14 09:16:42', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('77', '7', '2017-11-23 17:42:53', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('78', '7', '2017-11-24 10:28:02', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('79', '7', '2017-11-24 14:24:09', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('80', '7', '2017-12-06 11:33:56', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('81', '7', '2017-12-07 14:40:20', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('82', '7', '2017-12-08 14:23:52', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('83', '7', '2018-01-04 11:43:05', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('84', '1', '2018-01-08 15:12:11', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('85', '7', '2018-01-08 15:42:57', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('86', '7', '2018-01-09 15:49:40', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('87', '1', '2018-01-09 16:14:04', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('88', '1', '2018-01-30 09:37:10', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('89', '1', '2018-02-07 14:48:35', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('90', '7', '2018-04-03 10:57:55', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('91', '1', '2018-04-08 09:57:45', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('92', '2', '2018-04-08 17:39:31', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('93', '3', '2018-04-08 17:40:03', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('94', '5', '2018-04-08 17:40:22', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('95', '4', '2018-04-08 17:40:52', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('96', '5', '2018-04-08 17:41:12', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('97', '4', '2018-04-08 17:41:42', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('98', '6', '2018-04-08 17:42:36', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('99', '7', '2018-04-08 17:42:49', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('100', '2', '2018-04-08 17:54:11', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('101', '1', '2018-04-09 09:22:57', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('102', '2', '2018-04-09 09:24:11', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('103', '3', '2018-04-09 09:24:29', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('104', '1', '2018-04-09 09:56:46', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('105', '2', '2018-04-09 09:57:02', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('106', '5', '2018-04-09 09:57:24', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('107', '1', '2018-04-10 10:25:18', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('108', '1', '2018-04-25 11:16:43', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('109', '1', '2018-04-25 14:22:03', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('110', '2', '2018-04-26 11:39:22', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('111', '8', '2018-04-26 15:23:44', '127.0.0.1', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('112', '7412', '0000-00-00 00:00:00', '13417499061', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('113', '3371', '0000-00-00 00:00:00', '13417499061', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('114', '1871', '0000-00-00 00:00:00', '13417499061', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('115', '1674', '0000-00-00 00:00:00', '13417499061', '1', '1');
INSERT INTO `hwh_user_log` VALUES ('116', '4552', '0000-00-00 00:00:00', '13417499061', '1', '1');

-- ----------------------------
-- Table structure for `hwh_user_message`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_message`;
CREATE TABLE `hwh_user_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '留言Id',
  `user_id` int(11) NOT NULL COMMENT '被留言Id',
  `protect_id` int(11) DEFAULT '0' COMMENT '回复留言Id（与id关联  0表示未回复 ）',
  `top_protect_id` int(11) DEFAULT NULL COMMENT '与id关联，所有留言回复内容最起始的那条id',
  `content` text NOT NULL COMMENT '留言内容',
  `createDate` datetime DEFAULT NULL COMMENT '留言时间',
  `user_type` tinyint(4) DEFAULT '1' COMMENT '留言人类型（1普通  2管理员）',
  `state` tinyint(4) DEFAULT '0' COMMENT '消息是否被对方看到（0未 1有）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='留言表';

-- ----------------------------
-- Records of hwh_user_message
-- ----------------------------
INSERT INTO `hwh_user_message` VALUES ('1', '2', '1', '0', '1', '<p>看似简单 国</p>', '2017-07-24 17:50:09', '1', '1');
INSERT INTO `hwh_user_message` VALUES ('2', '2', '1', '0', '2', '<p>看似简单 国回归国</p>', '2017-07-24 17:51:00', '1', '1');
INSERT INTO `hwh_user_message` VALUES ('3', '1', '2', '1', '1', '<p>fdsfdfd<br/></p>', '2017-07-24 17:53:05', '1', '1');
INSERT INTO `hwh_user_message` VALUES ('4', '2', '1', '3', '1', '<p>最后一条哟<br/></p>', '2017-07-25 15:10:27', '1', '1');
INSERT INTO `hwh_user_message` VALUES ('5', '1', '2', '4', '1', '<p>vbsdsd</p>', '2017-07-25 15:24:06', '1', '1');
INSERT INTO `hwh_user_message` VALUES ('6', '2', '1', '5', '1', '<p>哈马斯枯<br/></p>', '2017-07-25 16:15:32', '1', '1');
INSERT INTO `hwh_user_message` VALUES ('7', '1', '2', '6', '1', '<p>好好了了</p>', '2017-07-25 16:41:04', '1', '0');

-- ----------------------------
-- Table structure for `hwh_user_pay_log`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_pay_log`;
CREATE TABLE `hwh_user_pay_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `orderId` int(11) NOT NULL COMMENT '订单id',
  `payType` tinyint(1) DEFAULT '1' COMMENT '支付方式（1：支付宝   2：微信）',
  `payAmount` double(14,2) DEFAULT NULL COMMENT '付款金额',
  `payTimes` datetime DEFAULT NULL COMMENT '付款时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消费记录';

-- ----------------------------
-- Records of hwh_user_pay_log
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_user_photo`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_photo`;
CREATE TABLE `hwh_user_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `img` varchar(255) DEFAULT NULL COMMENT '图片',
  `is_ok` tinyint(1) DEFAULT '1' COMMENT '是否启用（1启用 0不启用）',
  `create_date` datetime DEFAULT NULL COMMENT '添加时间',
  `is_photo_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是相册列表的封面图像（0不是   1是） 唯一的',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hwh_user_photo
-- ----------------------------
INSERT INTO `hwh_user_photo` VALUES ('8', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170526/1495784850_848176_5927dd92272bd.jpg', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('9', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170526/1495788623_169273_5927ec4f9d0cc.jpg', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('10', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170526/1495788914_525532_5927ed72ba42f.jpg', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('11', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170526/1495788914_276943_5927ed72cdcb4.jpg', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('12', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170526/1495788915_414287_5927ed7310d51.jpg', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('13', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170526/1495788915_960429_5927ed7314402.jpg', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('14', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/cover/20171011/1507702230_615431_59ddb5d6e9cfe.jpg', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `hwh_user_photo` VALUES ('15', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20170802/1501666861_169627_59819e2d56c54.png', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `hwh_user_photo` VALUES ('16', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20171011/1507709178_201599_59ddd0fa6ce74.jpg', '1', '2017-10-11 16:06:18', '0');
INSERT INTO `hwh_user_photo` VALUES ('17', '1', 'http://haozi.com.cn/Public/Uploads/user/photo/20180207/1517986132_485410_5a7aa154bc468.jpg', '1', '2018-02-07 14:48:52', '0');

-- ----------------------------
-- Table structure for `hwh_user_qq`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_qq`;
CREATE TABLE `hwh_user_qq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq_openid` varchar(32) NOT NULL COMMENT '用户登录QQ的openid',
  `qq_gender` tinyint(4) DEFAULT NULL COMMENT '性别',
  `qq_img` varchar(255) DEFAULT NULL COMMENT '用户QQ头像',
  `qq_nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `createDate` datetime DEFAULT NULL COMMENT '创建的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户用QQ登录网站获取的信息';

-- ----------------------------
-- Records of hwh_user_qq
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_user_ship_address`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_ship_address`;
CREATE TABLE `hwh_user_ship_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(50) NOT NULL COMMENT '收货人姓名',
  `phone` varchar(50) NOT NULL COMMENT '收货人电话',
  `areaId` int(11) DEFAULT NULL COMMENT '地区id',
  `areaName` varchar(100) DEFAULT NULL COMMENT '地区名称',
  `areaTreePath` varchar(100) DEFAULT NULL COMMENT '树路径',
  `address` varchar(255) NOT NULL COMMENT '省市区外的详细地址',
  `zipCode` varchar(50) DEFAULT NULL COMMENT '邮编',
  `isDefault` tinyint(4) DEFAULT '0' COMMENT '是否默认（0不默认  1默认）',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更改时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户收货地址';

-- ----------------------------
-- Records of hwh_user_ship_address
-- ----------------------------
INSERT INTO `hwh_user_ship_address` VALUES ('1', '1', '黄文豪', '13417499061', '1692', '湖北省黄石市西塞山区', ',1692,1707,', '枯枯要要要', '433016', '1', '2017-09-21 17:33:33', null);
INSERT INTO `hwh_user_ship_address` VALUES ('2', '7', '大文豪', '110', '1692', '湖北省仙桃市', ',1692,', '陈场镇幼松村八组', '433016', '1', '2018-04-03 11:06:09', null);
INSERT INTO `hwh_user_ship_address` VALUES ('5', '5', 'hahah', '13417499061', '1', '北京市丰台区', ',1,', 'sddsdsdsd', '433016', '1', '2018-04-09 16:59:20', null);

-- ----------------------------
-- Table structure for `hwh_user_xcx`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_xcx`;
CREATE TABLE `hwh_user_xcx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL COMMENT '用户openId',
  `createDate` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小程序获取到的用户openid';

-- ----------------------------
-- Records of hwh_user_xcx
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_user_xcx_userinfo`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_user_xcx_userinfo`;
CREATE TABLE `hwh_user_xcx_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userxcxId` varchar(200) NOT NULL COMMENT '用户的id（与hwh_user_xcx相关联）',
  `nickname` varchar(100) DEFAULT NULL COMMENT '用户昵称',
  `avatarUrl` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `gender` tinyint(4) DEFAULT '0' COMMENT '用户的性别（0未知  1男  2女）',
  `city` varchar(50) DEFAULT NULL COMMENT '用户所在城市',
  `province` varchar(50) DEFAULT NULL COMMENT '用户所在省份',
  `country` varchar(50) DEFAULT NULL COMMENT '用户所在国家',
  `language` varchar(50) DEFAULT 'zh_CN' COMMENT '用户的语言，简体中文为zh_CN',
  `createDate` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updateDate` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信小程序的用户信息';

-- ----------------------------
-- Records of hwh_user_xcx_userinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_video`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_video`;
CREATE TABLE `hwh_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id（与表hwh_user_xcx相关联）',
  `type` tinyint(1) DEFAULT '1' COMMENT '上传类型（1管理员  2用户）',
  `videoUrl` varchar(255) DEFAULT NULL COMMENT '视频地址',
  `size` double(12,2) DEFAULT NULL COMMENT '视频文件大小（单位M）',
  `remark` text COMMENT '备注',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='视频列表（网站的）';

-- ----------------------------
-- Records of hwh_video
-- ----------------------------
INSERT INTO `hwh_video` VALUES ('1', '1', '1', 'http://jq22com.qiniudn.com/jq22-sp.mp4', '1.00', '1', '2018-02-07 13:52:40');
INSERT INTO `hwh_video` VALUES ('2', '1', '1', 'http://jq22com.qiniudn.com/jq22-sp.mp4', '22.00', '22', '2018-02-07 13:52:43');
INSERT INTO `hwh_video` VALUES ('3', '1', '2', 'https://www.beliv.cn/Public/Uploads/videos/2017-12-29/5a45eea98e392.mp4', '3.00', '3', '2018-02-07 13:52:46');

-- ----------------------------
-- Table structure for `hwh_xcx_image`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_xcx_image`;
CREATE TABLE `hwh_xcx_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id（与表hwh_user_xcx相关联）',
  `imageFolderId` int(11) NOT NULL COMMENT '图片所在的文件夹id（与表hwh_xcx_image_folder关联）',
  `imageUrl` varchar(255) DEFAULT NULL COMMENT '视频地址',
  `size` double(12,2) DEFAULT NULL COMMENT '视频文件大小（单位M）',
  `remark` text COMMENT '备注',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图片列表（小程序）';

-- ----------------------------
-- Records of hwh_xcx_image
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_xcx_image_folder`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_xcx_image_folder`;
CREATE TABLE `hwh_xcx_image_folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id（与表hwh_user_xcx关联）',
  `folderName` varchar(30) NOT NULL COMMENT '文件夹名称',
  `remark` varchar(50) DEFAULT NULL COMMENT '备注信息（15字以内）',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小程序相册名（存入图片的文件夹）';

-- ----------------------------
-- Records of hwh_xcx_image_folder
-- ----------------------------

-- ----------------------------
-- Table structure for `hwh_xcx_order`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_xcx_order`;
CREATE TABLE `hwh_xcx_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` int(11) NOT NULL COMMENT '用户标识（小程序）',
  `orderNo` varchar(255) NOT NULL COMMENT '订单号',
  `totalAmount` double(14,2) DEFAULT NULL COMMENT '订单总金额【单位：元】',
  `payState` tinyint(4) DEFAULT '1' COMMENT '支付状态（1：未支付  2：已支付  3：已过期  4：已取消）',
  `shipState` tinyint(4) DEFAULT '1' COMMENT '发货状态（1：未发货  2：已发货  3：已收货   4：退货、退款）',
  `shipAdressId` int(11) DEFAULT NULL COMMENT '收货地址id（与表hwh_ship_adress表关联）',
  `isComment` tinyint(1) DEFAULT '1' COMMENT '是否已评论（1：未评论   2：已评论） 这个字段主要是判断是否已评论了',
  `expressCompany` varchar(100) DEFAULT NULL COMMENT '快递公司名',
  `expressNumber` varchar(30) DEFAULT NULL COMMENT '快递公司单号',
  `expressDate` datetime DEFAULT NULL COMMENT '寄出日期',
  `postage` double(14,2) DEFAULT '0.00' COMMENT '邮费',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  `updateDate` datetime DEFAULT NULL COMMENT '更新时间',
  `payDate` datetime DEFAULT NULL COMMENT '支付时间',
  `remake` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of hwh_xcx_order
-- ----------------------------
INSERT INTO `hwh_xcx_order` VALUES ('1', '1', 'H17092910473711506653257', '55.00', '1', '1', '1', '1', null, null, null, '0.00', '2017-09-29 10:47:37', null, null, null);
INSERT INTO `hwh_xcx_order` VALUES ('2', '1', 'H17092910540811506653648', '77.00', '1', '1', '1', '1', null, null, null, '0.00', '2017-09-29 10:54:08', null, null, null);
INSERT INTO `hwh_xcx_order` VALUES ('3', '1', 'H17093009144211506734082', '55.00', '2', '4', '1', '1', null, null, null, '0.00', '2017-09-30 09:14:42', null, null, null);
INSERT INTO `hwh_xcx_order` VALUES ('6', '1', '180307', '55.00', '1', '1', '1', '1', null, null, null, '0.00', '2018-03-07 17:47:09', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('7', '2', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:48:22', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('8', '4', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:48:49', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('9', '3', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:49:05', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('10', '5', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:49:17', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('11', '6', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:49:27', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('12', '7', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:49:35', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('13', '8', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:49:46', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('14', '9', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:49:53', null, null, '12');
INSERT INTO `hwh_xcx_order` VALUES ('15', '10', '180307', '55.00', '1', '1', '0', '1', null, null, null, '0.00', '2018-03-07 17:50:07', null, null, '12');

-- ----------------------------
-- Table structure for `hwh_xcx_video`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_xcx_video`;
CREATE TABLE `hwh_xcx_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id（与表hwh_user_xcx相关联）',
  `videoUrl` varchar(255) DEFAULT NULL COMMENT '视频地址',
  `size` double(12,2) DEFAULT NULL COMMENT '视频文件大小（单位M）',
  `remark` text COMMENT '备注',
  `createDate` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hwh_xcx_video
-- ----------------------------
INSERT INTO `hwh_xcx_video` VALUES ('1', '1', '11111', '1.00', '1', null);
INSERT INTO `hwh_xcx_video` VALUES ('2', '1', '112222', '22.00', '22', null);
INSERT INTO `hwh_xcx_video` VALUES ('3', '1', '3333', '3.00', '3', null);

-- ----------------------------
-- Table structure for `hwh_yulu`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_yulu`;
CREATE TABLE `hwh_yulu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `content` varchar(255) NOT NULL COMMENT '语录内容',
  `uid` int(11) NOT NULL COMMENT '发布者ID',
  `uid_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发布者类型（1为后台发布  2为用户发布）',
  `author` varchar(32) NOT NULL COMMENT '作者',
  `img` varchar(255) DEFAULT NULL COMMENT '语录形象图片（不传则为发布者头像）',
  `like_count` int(11) DEFAULT '0' COMMENT '点赞数量',
  `maketime` datetime DEFAULT NULL COMMENT '发布时间',
  `is_ok` tinyint(1) DEFAULT '1' COMMENT '审核状态 0未通过 1通过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='经典语录表';

-- ----------------------------
-- Records of hwh_yulu
-- ----------------------------
INSERT INTO `hwh_yulu` VALUES ('4', 'ddddd', '1', '2', '呵呵哒', null, '0', '2017-08-09 16:24:55', '0');
INSERT INTO `hwh_yulu` VALUES ('5', 'oooooo', '1', '2', '呵呵哒', null, '0', '2017-08-09 16:40:44', '0');
INSERT INTO `hwh_yulu` VALUES ('6', 'aaaaaa', '1', '2', '呵呵哒', null, '0', '2017-08-09 16:41:10', '0');

-- ----------------------------
-- Table structure for `hwh_yulu_like`
-- ----------------------------
DROP TABLE IF EXISTS `hwh_yulu_like`;
CREATE TABLE `hwh_yulu_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户ID(游客点赞记录所在IP地址)',
  `yulu_id` int(11) DEFAULT NULL COMMENT '经典语录ID',
  `like` tinyint(1) DEFAULT '1' COMMENT '点赞数量1',
  `create_date` timestamp NULL DEFAULT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='经典语录点赞表';

-- ----------------------------
-- Records of hwh_yulu_like
-- ----------------------------
INSERT INTO `hwh_yulu_like` VALUES ('1', '1', '1', '1', '2017-05-18 11:11:05');
INSERT INTO `hwh_yulu_like` VALUES ('2', '127.0.0.1', '1', '1', '2017-06-01 17:34:52');
INSERT INTO `hwh_yulu_like` VALUES ('3', '127.0.0.1', '1', '1', '2017-07-21 14:19:04');
