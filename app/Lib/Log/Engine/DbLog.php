<?php
/**
 * Database Storage stream for Logging
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

App::uses('CakeLogInterface', 'Log');
App::uses('AuthComponent', 'Controller/Component');

class DbLog implements CakeLogInterface {

	/**
	 * Model to handover log actions to
	 *
	 * @var Model
	 */
	protected static $_model = null;

	/**
	 * Constructs a new Database Logger.
	 *
	 * @param array $options Options for the DatabaseLogger
	 */
	public function __construct($options = array()) {
		$options += array('model' => 'Log');
		if (empty(self::$_model)) {
			App::uses('AppModel', 'Model');
			App::uses($options['model'], 'Model');
			self::$_model = new $options['model'];
		}
	}

	/**
	 * Implements writing to log table.
	 *
	 * @param string $type The type of log you are making.
	 * @param string $content The message you want to log.
	 * @return boolean success of write.
	 */
	public function write($type, $content, $module = 'system', $foreign_key = 0) {
		$data = compact('type', 'content', 'module', 'foreign_key');
		$user = AuthComponent::user();
		if (!empty($user)) {
			$data['user_id'] = $user['id'];
			$data['username'] = $user['name'];
		}
		self::$_model->create();
		return self::$_model->save($data);
	}
}
