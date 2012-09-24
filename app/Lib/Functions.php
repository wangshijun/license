<?php
/**
 * 获取客户端的IP地址
 *
 * @return string
 */
function get_client_ip() {
	$detectors = array(
		'HTTP_CLIENT_IP',
		'HTTP_X_FORWARDED_FOR',
		'REMOTE_ADDR',
	);

	foreach ($detectors as $detector) {
		$ip = env($detector);
		if (!empty($ip)) {
			break;
		}
	}

	if (empty($ip)) {
		$ip = '0.0.0.0';
	}

	return $ip;
}

/**
 * 使用cUrl函数远程抽取地址
 *
 * @param string	$url
 * @param bool $post
 * @param string $request
 * @return mixed
 */
function curl_fetch($url, $post=false, $request="", $time=10) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, $time);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	}
	$data = curl_exec($ch);
	$errno = curl_errno($ch);
	if ($errno > 0) {
		$err = "[curl error]\n\t - url:{$url}\n\t - errno:{$errno}\n\t - error info:" . curl_error($ch) . "\n";
		debug($err);
	}
	curl_close($ch);
	return $data;
}

