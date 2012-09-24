<?php

setup_clusters();

/**
 * 加载不同环境的配置文件, 如果存在
 */
function load_cluster_config($name) {
	$current = Configure::read('clusters.current');

	if (empty($current)) {
		return false;
	}

	$config = APP . 'Config' . DS . 'clusters' . DS . $current . DS . $name . '.php';
	if (is_file($config) && is_readable($config)) {
		return require_once($config);
	}

	return false;
}

/**
 * 根据主机名自动配置当前运行的机器
 */
function setup_clusters() {
	$hostname = php_uname('n');
	$clusters = Configure::read('clusters');

	if (in_array($hostname, $clusters['product'])) {
		$clusters['current'] = 'product';
	} elseif (in_array($hostname, $clusters['sandbox'])) {
		$clusters['current'] = 'sandbox';
	} else {
		$clusters['current'] = 'develop';
	}

	//debug($hostname);

	Configure::write('clusters', $clusters);
}

/**
 * 判断当前登录的用户租户是否是root
 *
 * @return boolean
 */
function is_root_tenant() {
	return intval(AuthComponent::user('tenant_id')) === ROOT_TENANT_ID;
}