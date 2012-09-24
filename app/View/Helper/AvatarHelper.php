<?php
/**
 * 根据当前登录用户获取其头像
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
 * @package	default
 * @subpackage	default
 */

App::uses('AppHelper', 'View/Helper');

class AvatarHelper extends AppHelper {

	public $helpers = array('Media.Media', 'Session', 'Html');

	private $defaults = array(
		'class' => 'avatar',
		'restrict' => array('image'),
	);

	/**
	 * 根据指定的用户和版本获取头像
	 *
	 * @param array $options {element, ckfinder, toolbar, }
	 * @param bool $return 是否返回html代码
	 * @return string
	 */
	public function create($options = array(), $version = 'tiny') {
		$user = $this->Session->read(Configure::read('SessionKey'));

		if (empty($user) || empty($user['Avatar']) || empty($user['Avatar']['path'])) {
			return $this->Html->image('avatar.jpg');
		}

		$options = array_merge($this->defaults, $options);
		$filepath = $this->Media->file(sprintf('%s/%s', $version, $user['Avatar']['path']));

		return $this->Media->embed($filepath	, $options);

	}


}
