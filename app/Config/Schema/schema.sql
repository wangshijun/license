/*
Navicat MySQL Data Transfer

Source Server         : eharmony_dev
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2012-03-31 09:57:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `acos`
-- ----------------------------
DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`,`parent_id`,`id`),
  KEY `model` (`model`,`foreign_key`,`parent_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `aros`
-- ----------------------------
DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`,`parent_id`,`id`),
  KEY `model` (`model`,`foreign_key`,`parent_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `aros_acos`
-- ----------------------------
DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `attachments`
-- @link https://github.com/davidpersson/media
-- ----------------------------
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `featured` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐(1表示已推荐,0表示不推荐)',
  `foreign_key` int(11) NOT NULL COMMENT '外键',
  `model` char(255) NOT NULL COMMENT '关联的Model',
  `dirname` char(255) NOT NULL COMMENT '文件夹名',
  `basename` char(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `filesize` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小,B为单位',
  `checksum` char(255) NOT NULL DEFAULT '' COMMENT '校检hash',
  `alternative` char(255) NOT NULL DEFAULT '' COMMENT '文件别名',
  `group` char(255) NOT NULL COMMENT '所属类别',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_foreign_key_id` (`tenant_id`,`model`,`foreign_key`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
-- Table structure for `categories`
-- @link http://book.cakephp.org/2.0/en/core-libraries/behaviors/tree.html
-- @link http://bakery.cakephp.org/articles/AD7six/2008/03/13/polymorphic-behavior
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `parent_id` int(10) DEFAULT NULL COMMENT '父级类目ID',
  `lft` int(10) NOT NULL DEFAULT '0' COMMENT '左边界',
  `rght` int(10) NOT NULL DEFAULT '0' COMMENT '右边界',
  `type` char(64) DEFAULT NULL COMMENT '与之关联的MODEL',
  `name` char(255) NOT NULL COMMENT '类目名称',
  `alias` char(255) NOT NULL COMMENT '类目别名',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`parent_id`,`id`),
  KEY `idx_tenant_name_id` (`tenant_id`,`name`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类目表';

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `author_id` int(11) NOT NULL DEFAULT '0' COMMENT '作者ID',
  `post_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章ID',
  `approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核(1表示已发布,0表示未发布)',
  `content` varchar(1024) NOT NULL DEFAULT '' COMMENT '新闻图片地址',
  `gmt_approved` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '审核时间',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`approved`,`author_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Table structure for `configs`
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `chapter` char(64) NOT NULL COMMENT '设置类别',
  `name` char(64) NOT NULL COMMENT '设置的键',
  `value` varchar(512) NOT NULL COMMENT '设置的值',
  `description` varchar(512) NOT NULL COMMENT '设置文本描述',
  `type` char(64) NOT NULL COMMENT '设置的输入类型',
  `options` varchar(512) NOT NULL COMMENT '设置的可选项,对于select类型可设置',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_chapter_id` (`tenant_id`,`chapter`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统设置表';

-- ----------------------------
-- Table structure for `downloads`
-- ----------------------------
DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `category_id` int(11) NOT NULL COMMENT '分类ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `download_count` int(11) NOT NULL DEFAULT '0' COMMENT '下载量',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否发布(1表示已发布,0表示未发布)',
  `title` char(255) NOT NULL COMMENT '文件标题',
  `publish_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间, 默认和创建时间相同, 但是可以另行修改',
  `gmt_published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资料下载表';

-- ----------------------------
-- Records of downloads
-- ----------------------------

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `parent_id` int(11) DEFAULT NULL COMMENT '父级角色ID',
  `lft` int(10) NOT NULL DEFAULT '0' COMMENT '左边界',
  `rght` int(10) NOT NULL DEFAULT '0' COMMENT '右边界',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `name` char(255) NOT NULL COMMENT '角色名称',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_name_id` (`tenant_id`,`name`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------

-- ----------------------------
-- Table structure for `links`
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '启用标记符(1表示已启用,0表示未启用)',
  `name` char(255) NOT NULL COMMENT '连接名称',
  `url` char(255) NOT NULL COMMENT '连接地址',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`deleted`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of links
-- ----------------------------

-- ----------------------------
-- Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `user_id` int(11) NOT NULL COMMENT '操作者ID',
  `foreign_key` char(32) NOT NULL COMMENT '日志所属记录ID',
  `module` char(64) NOT NULL COMMENT '日志所属子版块,用Controller命名',
  `type` char(16) NOT NULL DEFAULT 'info' COMMENT '日志类型',
  `username` char(255) NOT NULL COMMENT '操作者用户名',
  `content` varchar(1024) NOT NULL COMMENT '日志内容',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `tenant_id` (`tenant_id`,`id`),
  KEY `tenant_module` (`tenant_id`,`module`,`id`),
  KEY `tenant_username` (`tenant_id`,`user_id`,`id`),
  KEY `tenant_module_foreign_key` (`tenant_id`,`module`,`foreign_key`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='日志记录';

-- ----------------------------
-- Records of logs
-- ----------------------------

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `author_id` int(11) NOT NULL DEFAULT '0' COMMENT '作者ID',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否发布(1表示已发布,0表示未发布)',
  `click_count` int(11) NOT NULL DEFAULT '0' COMMENT '下载量',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `type` char(64) DEFAULT NULL COMMENT '与之关联的MODEL',
  `title` char(255) NOT NULL COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `images` varchar(1024) NOT NULL DEFAULT '' COMMENT '文章图片地址',
  `cover` char(255) NOT NULL DEFAULT '' COMMENT '封面图片地址',
  `publish_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '文章发生时间, 默认和创建时间相同, 但是可以另行修改',
  `gmt_published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`author_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章内容表';

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for `tenants`
-- ----------------------------
DROP TABLE IF EXISTS `tenants`;
CREATE TABLE `tenants` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用(1表示已启用,0表示未启用)',
  `name` char(64) NOT NULL COMMENT '租户名称',
  `domain` char(255) NOT NULL COMMENT '租户的域名',
  `memo` varchar(512) NOT NULL COMMENT '租户说明',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_name_id` (`name`,`id`),
  KEY `idx_deleted_id` (`deleted`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='租户表';

-- ----------------------------
-- Records of tenants
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态(1表示启用,0表示禁用)',
  `name` char(255) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL COMMENT '登录密码',
  `mobile` char(32) NOT NULL COMMENT '手机号码',
  `email` char(255) NOT NULL COMMENT '用户邮箱',
  `ip_last_login` char(32) NOT NULL DEFAULT '0' COMMENT '上次登录IP',
  `ip_registered` char(32) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `gmt_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登录时间',
  `gmt_registered` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_active_id` (`tenant_id`,`active`,`id`),
  KEY `idx_tenant_group_id` (`tenant_id`,`group_id`,`name`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for `widgets`
-- ----------------------------
DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `chapter_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属的类目ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统默认模块',
  `name` char(255) NOT NULL COMMENT '栏目名称',
  `visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示咋首页(1表示是,0表示否)',
  `row` int(11) NOT NULL DEFAULT '0' COMMENT '显示在第几行',
  `column` int(11) NOT NULL DEFAULT '0' COMMENT '显示在第几列',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '显示为多大块, 依据Bootstrap中的span*',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`chapter_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of widgets
-- ----------------------------
