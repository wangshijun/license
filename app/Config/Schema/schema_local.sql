-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2012 at 11:47 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easy_projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='附件表';

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类目表';

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` varchar(36) NOT NULL,
  `parent_id` varchar(36) DEFAULT NULL,
  `foreign_key` varchar(36) NOT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `model` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `is_spam` varchar(20) NOT NULL DEFAULT 'clean',
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `body` text,
  `author_name` varchar(255) DEFAULT NULL,
  `author_url` varchar(255) DEFAULT NULL,
  `author_email` varchar(128) NOT NULL DEFAULT '',
  `language` varchar(6) DEFAULT NULL,
  `comment_type` varchar(32) NOT NULL DEFAULT 'comment',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `category` char(64) NOT NULL COMMENT '设置类别',
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
  KEY `idx_tenant_category_id` (`tenant_id`,`category`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统设置表';

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='资料下载表';

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='日志记录';

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
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
  `slug` char(255) NOT NULL COMMENT '文章别名',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文章内容表';

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

DROP TABLE IF EXISTS `tenants`;
CREATE TABLE IF NOT EXISTS `tenants` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='租户表';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态(1表示启用,0表示禁用)',
  `name` char(255) NOT NULL COMMENT '用户名',
  `slug` char(255) NOT NULL COMMENT 'slug',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表';

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL DEFAULT '1' COMMENT '租户ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除标记符(1表示已删除,0表示未删除)',
  `gender` tinyint(1) NOT NULL COMMENT '性别(1表示男性,0表示女性)',
  `address` char(255) NOT NULL COMMENT '居住地址',
  `job` char(255) NOT NULL COMMENT '工作',
  `memo` varchar(1024) NOT NULL COMMENT '自我介绍',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_user_id` (`tenant_id`,`user_id`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='基本信息表';

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属的类目ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统默认模块',
  `name` char(255) NOT NULL COMMENT '栏目名称',
  `visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示咋首页(1表示是,0表示否)',
  `row` int(11) NOT NULL DEFAULT '0' COMMENT '显示在第几行',
  `column` int(11) NOT NULL DEFAULT '0' COMMENT '显示在第几列',
  `size` int(11) NOT NULL DEFAULT '3' COMMENT '显示为多大块, 依据Bootstrap中的span*',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`category_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- --------------------------------------------------------
-- 产品授权管理相关信息表
-- --------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `name` char(255) NOT NULL COMMENT '产品名称',
  `description` text NOT NULL DEFAULT '' COMMENT '产品说明',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_name_id` (`tenant_id`,`name`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='产品表';

DROP TABLE IF EXISTS `product_prices`;
CREATE TABLE IF NOT EXISTS `product_prices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `product_id` int(11) NOT NULL COMMENT '楼号ID',
  `price` int(11) NOT NULL COMMENT '价格(元)',
  `description` text NOT NULL DEFAULT '' COMMENT '定价说明',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_product_id` (`tenant_id`,`product_id`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='产品定价表';

DROP TABLE IF EXISTS `product_licenses`;
CREATE TABLE IF NOT EXISTS `product_licenses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tenant_id` int(11) NOT NULL COMMENT '租户ID',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(1表示已删除,0表示未删除)',
  `product_id` int(11) NOT NULL COMMENT '产品ID',
  `product_price_id` int(11) NOT NULL COMMENT '产品定价策略',
  `customer_name` char(255) NOT NULL COMMENT '客户名称',
  `customer_identifier` char(255) NOT NULL COMMENT '安装的机器信息',
  `license_key` char(64) NOT NULL COMMENT '授权码',
  `license_date` char(32) NOT NULL COMMENT '授权日期',
  `license_blocked` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否黑名单',
  `gmt_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `gmt_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_tenant_id` (`tenant_id`,`id`),
  KEY `idx_tenant_deleted_id` (`tenant_id`,`deleted`,`id`),
  KEY `idx_tenant_product_id` (`tenant_id`,`product_id`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='产品授权';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
