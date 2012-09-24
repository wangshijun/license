<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public $recursive = -1;

	public $actsAs = array(
		'Utils.Isolated',
		'Utils.Recyclable',
		'Containable',
		'Search.Searchable',
	);

	public function beforeSave($options = array()) {

		// 维护记录时间戳(更新时间,修改时间)
		$timestamp = date('Y-m-d H:i:s');
		if ($this->exists() === false) {
			if ($this->hasField('gmt_created')) {
				$this->data[$this->alias]['gmt_created'] = $timestamp;
			}
			if ($this->hasField('gmt_modified')) {
				$this->data[$this->alias]['gmt_modified'] = $timestamp;
			}
		}

		return true;
	}

	/**
	 * 根据功能模块记录日志, 方便追踪和审计
	 *
	 * @param string $content 日志的内容
	 * @param string $foreign_key 绑定记录的ID
	 * @param string $type 日志类别
	 */
	public function log($content, $foreign_key = 0, $type = LOG_INFO) {
		$content = (!is_string($content)) ? print_r($content, true) : $content;
		return CakeLog::write($type, $content, $this->name, $foreign_key);
	}

	/**
	 * workaround for RecyclableBehavior to delete related records
	 */
	public function deleteDependent($id, $cascade = true) {
		return parent::_deleteDependent($id, $cascade);
	}

	/**
	 * workaround for RecyclableBehavior to delete related records
	 */
	public function deleteLinks($id) {
		return parent::_deleteLinks($id);
	}

}
