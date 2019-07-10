/*
 Navicat Premium Data Transfer

 Source Server         : 我的服务器
 Source Server Type    : MySQL
 Source Server Version : 50557
 Source Host           : 106.12.88.251:3306
 Source Schema         : demo1

 Target Server Type    : MySQL
 Target Server Version : 50557
 File Encoding         : 65001

 Date: 10/07/2019 10:47:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for demo1_address
-- ----------------------------
DROP TABLE IF EXISTS `demo1_address`;
CREATE TABLE `demo1_address`  (
  `order_address_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `province_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `city_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `region_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `order_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_address_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_appoint
-- ----------------------------
DROP TABLE IF EXISTS `demo1_appoint`;
CREATE TABLE `demo1_appoint`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 预约表',
  `user_id` int(11) NOT NULL COMMENT '预约的会员id',
  `staff_id` int(11) NOT NULL COMMENT '被预约的员工id',
  `appoint_time` int(11) NOT NULL COMMENT '预约时间戳（当天零点）',
  `timeduan_id` int(11) NOT NULL COMMENT '预约的时间段id',
  `wxapp_id` int(11) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '预约内容',
  `content_type` tinyint(3) NOT NULL COMMENT '预约内容类型（1表示一个项目最多一个服务，相同服务不能选多个）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 261 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_attr
-- ----------------------------
DROP TABLE IF EXISTS `demo1_attr`;
CREATE TABLE `demo1_attr`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 属性表',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '属性名称',
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '属性标签，用;分割',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_attr_template
-- ----------------------------
DROP TABLE IF EXISTS `demo1_attr_template`;
CREATE TABLE `demo1_attr_template`  (
  `id` int(11) NOT NULL COMMENT 'id 属性模板表',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '属性名称',
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '属性标签（;分割）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_category
-- ----------------------------
DROP TABLE IF EXISTS `demo1_category`;
CREATE TABLE `demo1_category`  (
  `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `image_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_delivery
-- ----------------------------
DROP TABLE IF EXISTS `demo1_delivery`;
CREATE TABLE `demo1_delivery`  (
  `delivery_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `method` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`delivery_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_delivery_rule
-- ----------------------------
DROP TABLE IF EXISTS `demo1_delivery_rule`;
CREATE TABLE `demo1_delivery_rule`  (
  `rule_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `region` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first` double UNSIGNED NOT NULL DEFAULT 0,
  `first_fee` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `additional` double UNSIGNED NOT NULL DEFAULT 0,
  `additional_fee` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`rule_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_dictionary
-- ----------------------------
DROP TABLE IF EXISTS `demo1_dictionary`;
CREATE TABLE `demo1_dictionary`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_flux
-- ----------------------------
DROP TABLE IF EXISTS `demo1_flux`;
CREATE TABLE `demo1_flux`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 流量表',
  `is_member` int(11) NOT NULL COMMENT '是否是注册会员（1是0否）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_goods
-- ----------------------------
DROP TABLE IF EXISTS `demo1_goods`;
CREATE TABLE `demo1_goods`  (
  `goods_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `spec_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `deduct_stock_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 20,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sales_initial` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sales_actual` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_sort` int(11) UNSIGNED NOT NULL DEFAULT 100,
  `delivery_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `is_delete` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`goods_id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_goods_image
-- ----------------------------
DROP TABLE IF EXISTS `demo1_goods_image`;
CREATE TABLE `demo1_goods_image`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `image_id` int(11) NOT NULL,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_goods_spec
-- ----------------------------
DROP TABLE IF EXISTS `demo1_goods_spec`;
CREATE TABLE `demo1_goods_spec`  (
  `goods_spec_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `goods_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `line_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `stock_num` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_sales` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_weight` double UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `spec_sku_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`goods_spec_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_goods_spec_rel
-- ----------------------------
DROP TABLE IF EXISTS `demo1_goods_spec_rel`;
CREATE TABLE `demo1_goods_spec_rel`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `spec_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `spec_value_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_item
-- ----------------------------
DROP TABLE IF EXISTS `demo1_item`;
CREATE TABLE `demo1_item`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 具体服务项目',
  `project_id` int(11) NOT NULL COMMENT '上级项目id',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '首页图片',
  `slide` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '详细图片（;分割）',
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '价格',
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `exchange` int(11) NOT NULL COMMENT '兑换积分数值',
  `describe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '项目描述',
  `attr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '对应属性(;分割)(;;大分割)',
  `wxapp_id` int(11) NOT NULL,
  `content_type` tinyint(3) NOT NULL COMMENT '内容类型',
  `is_delete` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_job
-- ----------------------------
DROP TABLE IF EXISTS `demo1_job`;
CREATE TABLE `demo1_job`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 员工职位表',
  `name` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '职位名',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `wxapp_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_member1
-- ----------------------------
DROP TABLE IF EXISTS `demo1_member1`;
CREATE TABLE `demo1_member1`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 会员表',
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '会员头像',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '昵称',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '会员真实姓名',
  `card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '会员卡号',
  `mobile` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '会员手机号码',
  `create_time` int(11) NOT NULL COMMENT '成为会员时间',
  `sex` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '性别(man男 woman女)',
  `birthday` int(11) NOT NULL COMMENT '生日',
  `shop_time` int(11) NOT NULL COMMENT '消费次数',
  `shop_money` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '消费金额',
  `wxapp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_order_del
-- ----------------------------
DROP TABLE IF EXISTS `demo1_order_del`;
CREATE TABLE `demo1_order_del`  (
  `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `total_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `pay_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `pay_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `pay_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `express_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `express_company` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `express_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `delivery_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `delivery_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `receipt_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `receipt_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `order_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `transaction_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`) USING BTREE,
  UNIQUE INDEX `order_no`(`order_no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `demo1_order_goods`;
CREATE TABLE `demo1_order_goods`  (
  `order_goods_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `image_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deduct_stock_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 20,
  `spec_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `spec_sku_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `goods_spec_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `goods_attr` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `goods_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `goods_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `line_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `goods_weight` double UNSIGNED NOT NULL DEFAULT 0,
  `total_num` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `total_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `order_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_orders
-- ----------------------------
DROP TABLE IF EXISTS `demo1_orders`;
CREATE TABLE `demo1_orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 订单表',
  `num` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '订单编号',
  `user_id` int(11) NOT NULL COMMENT '对应用户id',
  `item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '项目id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL,
  `appoint_time` int(11) NOT NULL COMMENT '预约时间',
  `staff_id` int(11) NOT NULL COMMENT '员工id',
  `wxapp_id` int(11) NOT NULL,
  `state` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '订单状态（notgo未到店 inserver服务中 waitmoney待支付 complete已完成 cancel已撤单 late已逾期）',
  `type` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '订单类型（appoint预约订单 instore在店订单）',
  `addserver` decimal(10, 2) NOT NULL COMMENT '附加服务（价格）',
  `discount` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '折扣（例如8.5）',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '备注',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `final_price` decimal(10, 2) NOT NULL COMMENT '订单最终价格',
  `is_comment` int(11) NOT NULL DEFAULT 0 COMMENT '是否已评价（1是0否）',
  `store_id` int(11) NOT NULL DEFAULT 1 COMMENT '所属门店id',
  `item` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `why_cancel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '取消原因',
  `cancel_remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '取消备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 303 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_project
-- ----------------------------
DROP TABLE IF EXISTS `demo1_project`;
CREATE TABLE `demo1_project`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 项目表',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '项目名',
  `wxapp_id` int(11) NOT NULL,
  `is_delete` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_region
-- ----------------------------
DROP TABLE IF EXISTS `demo1_region`;
CREATE TABLE `demo1_region`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NULL DEFAULT NULL,
  `shortname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merger_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level` tinyint(4) UNSIGNED NULL DEFAULT 0,
  `pinyin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zip_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lng` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name,level`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3749 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_setting
-- ----------------------------
DROP TABLE IF EXISTS `demo1_setting`;
CREATE TABLE `demo1_setting`  (
  `key` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `values` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  UNIQUE INDEX `unique_key`(`key`, `wxapp_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_shop_bag
-- ----------------------------
DROP TABLE IF EXISTS `demo1_shop_bag`;
CREATE TABLE `demo1_shop_bag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 购物袋',
  `user_id` int(11) NOT NULL COMMENT '所属会员id',
  `item_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '购物车内容（项目用;分割，数量用*分割）',
  `wxapp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_spec
-- ----------------------------
DROP TABLE IF EXISTS `demo1_spec`;
CREATE TABLE `demo1_spec`  (
  `spec_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `spec_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`spec_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_spec_value
-- ----------------------------
DROP TABLE IF EXISTS `demo1_spec_value`;
CREATE TABLE `demo1_spec_value`  (
  `spec_value_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `spec_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `spec_id` int(11) NOT NULL,
  `wxapp_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`spec_value_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_staff
-- ----------------------------
DROP TABLE IF EXISTS `demo1_staff`;
CREATE TABLE `demo1_staff`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 人员表',
  `name` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '员工姓名',
  `type` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '员工类型（admin管理员 waiter服务员）',
  `job_id` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '员工职称',
  `account` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '员工账号',
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '员工头像',
  `password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码',
  `mobile` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '员工手机号码',
  `is_vacation` tinyint(3) NOT NULL COMMENT '是否休假（1是0否）',
  `is_free` tinyint(3) NOT NULL COMMENT '是否空闲(1是0否)',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `wxapp_id` int(11) NOT NULL,
  `vacation_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '休假日期',
  `store_id` int(11) NOT NULL DEFAULT 1 COMMENT '所属门店id',
  `nick_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '昵称',
  `is_delete` int(10) NOT NULL COMMENT '是否冻结',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_store
-- ----------------------------
DROP TABLE IF EXISTS `demo1_store`;
CREATE TABLE `demo1_store`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 门店id',
  `store_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '门店名称',
  `store_mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '门店电话',
  `worktime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '营业时间',
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '省级地址名称',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '市级地址名称',
  `county` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '县级地址名称',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '具体地址',
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '经度',
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '纬度',
  `slide` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '轮播图',
  `describe` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '店铺介绍',
  `wxapp_id` int(11) NOT NULL,
  `store_num` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '门店编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_store_user
-- ----------------------------
DROP TABLE IF EXISTS `demo1_store_user`;
CREATE TABLE `demo1_store_user`  (
  `store_user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `is_super` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否为超级管理员',
  `is_delete` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否删除',
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '小程序id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`store_user_id`) USING BTREE,
  INDEX `user_name`(`user_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10003 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商家用户记录表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_time_duan
-- ----------------------------
DROP TABLE IF EXISTS `demo1_time_duan`;
CREATE TABLE `demo1_time_duan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 时间段表',
  `name` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '时间段名称',
  `begin_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `wxapp_id` int(11) NOT NULL,
  `type` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '时间类型(morning上午afternoon下午evening晚上)',
  `sort` int(11) NOT NULL COMMENT '排序',
  `begin_use_time` int(11) NOT NULL COMMENT '该时间段开始使用时间',
  `end_use_time` int(11) NOT NULL DEFAULT 2147483640 COMMENT '该时间段结束使用时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_upload_file
-- ----------------------------
DROP TABLE IF EXISTS `demo1_upload_file`;
CREATE TABLE `demo1_upload_file`  (
  `file_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storage` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `file_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `file_size` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `file_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `extension` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `is_delete` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`file_id`) USING BTREE,
  UNIQUE INDEX `path_idx`(`file_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_upload_file_used
-- ----------------------------
DROP TABLE IF EXISTS `demo1_upload_file_used`;
CREATE TABLE `demo1_upload_file_used`  (
  `used_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `from_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `from_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`used_id`) USING BTREE,
  INDEX `type_idx`(`from_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_upload_group
-- ----------------------------
DROP TABLE IF EXISTS `demo1_upload_group`;
CREATE TABLE `demo1_upload_group`  (
  `group_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `group_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`group_id`) USING BTREE,
  INDEX `type_index`(`group_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_user
-- ----------------------------
DROP TABLE IF EXISTS `demo1_user`;
CREATE TABLE `demo1_user`  (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `open_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nickName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `avatarUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `gender` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别（1男2女）',
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `address_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '地区id',
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '成为会员时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `card` int(11) NOT NULL COMMENT '会员卡号',
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '会员手机号码',
  `birthday` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '生日',
  `shop_time` int(11) NOT NULL COMMENT '消费次数',
  `shop_money` int(11) NOT NULL COMMENT '消费金额',
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '会员头像',
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `openid`(`open_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_user_address
-- ----------------------------
DROP TABLE IF EXISTS `demo1_user_address`;
CREATE TABLE `demo1_user_address`  (
  `address_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `province_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `city_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `region_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`address_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_wxapp
-- ----------------------------
DROP TABLE IF EXISTS `demo1_wxapp`;
CREATE TABLE `demo1_wxapp`  (
  `wxapp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `app_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `app_secret` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `is_service` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `service_image_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `is_phone` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `phone_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone_image_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `mchid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `apikey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `is_recycle` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否回收',
  PRIMARY KEY (`wxapp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_wxapp_help
-- ----------------------------
DROP TABLE IF EXISTS `demo1_wxapp_help`;
CREATE TABLE `demo1_wxapp_help`  (
  `help_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`help_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_wxapp_navbar
-- ----------------------------
DROP TABLE IF EXISTS `demo1_wxapp_navbar`;
CREATE TABLE `demo1_wxapp_navbar`  (
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `wxapp_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `top_text_color` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `top_background_color` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`wxapp_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for demo1_wxapp_page
-- ----------------------------
DROP TABLE IF EXISTS `demo1_wxapp_page`;
CREATE TABLE `demo1_wxapp_page`  (
  `page_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `page_data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `wxapp_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`page_id`) USING BTREE,
  INDEX `wxapp_id`(`wxapp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
