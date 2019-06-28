<?php

$upgradeSql = <<<sql


### v1.0.3 ###

# 配送模板排序
ALTER TABLE `yoshop_delivery`
ADD COLUMN `sort` int(11) unsigned NOT NULL DEFAULT '0' AFTER `wxapp_id`;



### v1.0.5 ###

ALTER TABLE `yoshop_goods_spec`
ADD COLUMN `spec_sku_id` varchar(255) NOT NULL DEFAULT '' AFTER `wxapp_id`;


CREATE TABLE IF NOT EXISTS `yoshop_goods_spec_rel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0',
  `spec_id` int(11) unsigned NOT NULL DEFAULT '0',
  `spec_value_id` int(11) unsigned NOT NULL DEFAULT '0',
  `wxapp_id` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;


ALTER TABLE `yoshop_order_goods`
ADD COLUMN `spec_sku_id` varchar(255) NOT NULL DEFAULT '' AFTER `spec_type`,
ADD COLUMN `goods_attr` varchar(500) NOT NULL DEFAULT '' AFTER `goods_spec_id`;


ALTER TABLE `yoshop_setting`
DROP INDEX `key_idx`,
ADD UNIQUE INDEX `unique_key`(`key`, `wxapp_id`);


CREATE TABLE IF NOT EXISTS `yoshop_spec` (
  `spec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `spec_name` varchar(255) NOT NULL DEFAULT '',
  `wxapp_id` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`spec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `yoshop_spec_value` (
  `spec_value_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `spec_value` varchar(255) NOT NULL,
  `spec_id` int(11) NOT NULL,
  `wxapp_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`spec_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;



### v1.0.8 ###

# 订单商品记录表：库存计算方式
ALTER TABLE `yoshop_order_goods`
ADD COLUMN `deduct_stock_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '20' AFTER `image_id`;



### v1.0.9 ###

# 商品分类表：分类排序
ALTER TABLE `yoshop_category`
ADD COLUMN `sort` int(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `image_id`;



### v1.0.10 ###

# 文件库记录表：分类排序
ALTER TABLE `yoshop_upload_file`
ADD COLUMN `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `file_id`,
ADD COLUMN `is_delete` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 AFTER `extension`,
MODIFY COLUMN `storage` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `file_id`,
MODIFY COLUMN `file_size` int(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `file_name`,
MODIFY COLUMN `file_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `file_size`,
MODIFY COLUMN `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `wxapp_id`;

# 文件库分组记录表
CREATE TABLE IF NOT EXISTS `yoshop_upload_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_type` varchar(10) NOT NULL DEFAULT '',
  `group_name` varchar(30) NOT NULL DEFAULT '',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `wxapp_id` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `type_index` (`group_type`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;



### v1.0.14 ###

# 删除商品图片表索引
ALTER TABLE `yoshop_goods_image` DROP INDEX `goods_image`;


sql;

pdo_run($upgradeSql);
