<?php
/**
 * 短信收发API包装器
 *
 * Copyright (c) 2011 tomato
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @license	http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package	Lib
 * @subpackage	Lib.SMSMessenger
 */

require_once(APP . 'Lib' . DS . 'Functions.php');

class SMSMessenger {

	protected static $apis = array(
		'send' => 'http://http.c123.com/tx/?',
		'receive' => 'http://http.c123.com/rx/?',
		'query' => 'http://http.c123.com/mm/?',
	);

	protected static $codes = array(
		'100' => '请求成功',
		'101' => '验证失败',
		'102' => '短信不足',
		'103' => '操作失败',
		'104' => '非法字符',
		'105' => '内容过多',
		'106' => '号码过多',
		'107' => '频率过快',
		'108' => '号码内容空',
		'109' => '账号冻结',
		'110' => '禁止频繁单条发送',
		'111' => '系统暂定发送',
		'112' => '号码不正确',
		'120' => '系统升级',
	);

	protected static $authenticate = array(
		'username' => '91946',
		'password'=> 'abc123',
	);

	/**
	 * 发送指定内容到指定号码
	 *
	 * @mobile mixed 接受短信的号码
	 * @content string 短信内容
	 */
	public static function send($mobile, $content, $timeout = 10) {
		if (is_array($mobile)) {
			$mobile = implode(',', $mobile);
		}
		$content = (string) $content;

		$data = array_merge(self::_prepare(), compact('mobile', 'content'));
		$code= trim(self::_post(self::$apis['send'], $data, $timeout));

		$response = new stdClass();
		$response->code = isset(self::$codes[$code]) ? self::$codes[$code] : $code;
		$response->status = ($code === '100');

		return $response;
	}

	/**
	 * 查询剩余短信条数
	 */
	public static function query() {
		$response = new stdClass();

		$params = http_build_query(self::_prepare());
		$content = curl_fetch(self::$apis['query'] . $params);
		$content = iconv('GBK', 'UTF-8', $content);

		if (!empty($content)) {
			@list($code, $result) = array_map('trim', explode('||', $content, 2));
			$response->code = isset(self::$codes[$code]) ? self::$codes[$code] : $code;
			$response->status = ($code === '100');
			$response->data = $result;
		} else {
			$response->code = '与短信服务器通信失败';
			$response->status = false;
		}

		return $response;
	}

	/**
	 * 接受短信, 返回结果数组
	 */
	public static function receive() {
		$response = new stdClass();

		$params = http_build_query(self::_prepare());
		$content = curl_fetch(self::$apis['receive'] . $params);
		$content = iconv('GBK', 'UTF-8', $content);

		if (!empty($content)) {
			$data = explode('{&}', $content);
			$code = trim(array_shift($data));
			$response->code = isset(self::$codes[$code]) ? self::$codes[$code] : $code;
			$response->status = ($code === '100');
			if ($response->status) {
				$messages = array();
				$keys = array('mobile', 'content', 'timestamp', 'gateway');
				if (!empty($data)) {
					foreach ($data as $item) {
						$messages[] = array_map('trim', explode('||', $item));
					}
				}
				$response->data = $messages;
			}
		} else {
			$response->code = '与短信服务器通信失败';
			$response->status = false;
		}

		return $response;
	}

	/**
	 * POST请求到远端接口
	 */
	protected static function _post($url, $data = array(), $timeout = 10) {
		$row = parse_url($url);
		$host = $row['host'];
		$port = isset($row['port']) ? $row['port'] : 80;
		$file = $row['path'];

		$content = '';
		while (list($k, $v) = each($data)) {
			$content .= rawurlencode($k) . "=" . rawurlencode($v) . "&";
		}
		$content = substr($content , 0 , -1 );
		$length = strlen($content);

		$fp = fsockopen( $host ,$port, $errno, $errstr, $timeout);
		if (!$fp) {
			return "($errno) $errstr";
		} else {
			$receive = '';
			$send = "POST $file HTTP/1.1\r\n";
			$send .= "Host: $host\r\n";
			$send .= "Content-type: application/x-www-form-urlencoded\r\n";
			$send .= "Connection: Close\r\n";
			$send .= "Content-Length: $length\r\n\r\n";
			$send .= $content;

			fwrite($fp, $send);
			while (!feof($fp)) {
				$receive .= fgets($fp, 128);
			}
			fclose($fp);

			$receive = explode("\r\n\r\n", $receive);
			unset($receive[0]);
			return implode("", $receive);
		}
	}

	/**
	 * 准备用户名和密码
	 */
	protected static function _prepare() {
		return array(
			'uid' => self::$authenticate['username'],
			'pwd' => strtolower(md5(self::$authenticate['password'])),
			'encode' => 'utf8',
		);
	}

}
