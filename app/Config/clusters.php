<?php
/**
 * 环境的主机名配置文件
 */

$config = array(
	'clusters' => array(
		'product' => array('XP-201111020938'),
		'sandbox' => array('LOCALHOST.LOCALDOMAIN'),
		'develop' => array('TOMATO-PC'),
		'current' => null,
	),
	'ckfinders' => array(
		'develop' => '/media/static/',
		'sandbox' => '/course/app/webroot/media/static/',
		'product' => '/app/webroot/media/static/',
	),
);
