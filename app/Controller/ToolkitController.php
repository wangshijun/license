<?php
/**
 * 系统维护工具箱
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
 * @package	System
 * @subpackage	Toolkit
 */

App::uses('AppController', 'Controller');

class ToolkitController extends AppController {

	public $name = 'Toolkit';

	public function beforeFilter() {
		parent::beforeFilter();

		if (Configure::read('debug') > 0) {
			$this->Auth->allow('*');
		}

		set_time_limit(300);
		ini_set('memory_limit','64M');
	}

	public function hasOwnMethod($method) {
		return in_array($method, array('fix', 'flush', 'migrate'));
	}

	/**
	 * 对系统的某些地方进行修正
	 */
	public function fix($marker) {
		switch ($marker) {
			case 'translation':
				$this->_fix_translation();
				exit(TMP . 'translation_fixtures.php');
				break;
			default:
				exit(__('nothing to do'));
		}
	}

	/**
	 * 清空缓存
	 */
	public function flush() {}

	/**
	 * 迁移系统的图片路径
	 */
	public function migrate() {
		if ($this->request->is('Post')) {
			$logs = array();

			extract($this->request->data['Toolkit']);

			$model = ucfirst($model);
			$fields = array_map('trim', preg_split('/(,|，)/', $fields, -1, PREG_SPLIT_NO_EMPTY));

			//debug(compact('model', 'fields', 'pattern', 'replace')); exit();

			$this->loadModel($model);
			$items = $this->{$model}->find('all');
			foreach ($items as $item) {
				foreach ($fields as $field) {
					if (isset($item[$model][$field])) {
						$item[$model][$field] = str_replace($pattern, $replace, $item[$model][$field]);
					}
				}

				if ($this->{$model}->save($item)) {
					$logs[] = 'success: ' . $item[$model]['id'];
				} else {
					$logs[] = 'failed: ' . $item[$model]['id'];
				}
			}

			$this->set('logs', $logs);

		}
	}

	/**
	 * 修正语言包遗漏导致部分消息只显示英文的错误
	 */
	protected function _fix_translation() {
		$formats = array(
			'__("Invalid %s.");',
			'__("The %s has been toggled.");',
			'__("The %s could not be toggled. Please, try again.");',
			'__("The %s has been recycled.");',
			'__("The %s could not be recycled. Please, try again.");',
			'__("The %s has been dropped.");',
			'__("The %s could not be dropped. Please, try again.");',
			'__("Add %s");',
			'__("Edit %s");',
			'__("Save %s");',
		);

		$fixtures = array();

		$models = App::objects('Model');
		foreach ($models as $name) {
			if (in_array($name, array('AppModel'))) {
				continue;
			}

			foreach ($formats as $format) {
				$fixtures[] = sprintf($format, $name);
			}
		}

		$content = sprintf("<?php\n%s;", implode("\n", $fixtures));
		file_put_contents(TMP . 'translation_fixtures.php', $content);

	}

}