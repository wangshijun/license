<?php
/**
 * 系统设置项渲染Helper, 根据配置项的类型和值来输出input元素
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

class CKEditorHelper extends AppHelper {

	public $helpers = array('Html');

	private $defaults = array(
		'ckfinder' => false,
		'element' => false,
		'toolbar' => 'basic',
		'version' => array(
			'ckfinder' => '2.1.1',
			'ckeditor' => '3.6.2',
		),
	);

	private $ckfinder_path = null;
	private $ckeditor_path = null;

	/**
	 * 加载CKEditor, 和CKFinder脚本, 并且初始化实例
	 *
	 * @param array $options {element, ckfinder, toolbar, }
	 * @param bool $return 是否返回html代码
	 * @return string
	 */
	public function create($options = array(), $return = true) {
		$options = array_merge($this->defaults, $options);

		if (empty($options['element'])) {
			return false;
		}

		$this->ckfinder_path = empty($options['version']['ckfinder']) ? 'ckfinder' : 'ckfinder-' . $options['version']['ckfinder'];
		$this->ckeditor_path = empty($options['version']['ckeditor']) ? 'ckeditor' : 'ckeditor-' . $options['version']['ckeditor'];

		$output = $this->Html->script($this->ckeditor_path . '/ckeditor.js', array('inline' => false));
		$output .= $this->Html->script($this->ckeditor_path . '/adapters/jquery.js', array('inline' => false));

		if ($options['ckfinder']) {
			$output .= $this->Html->script($this->ckfinder_path . '/ckfinder.js', array('inline' => false));
		}

		$scripts = array();
		$elements = (array) $options['element'];
		foreach ($elements as $element) {
			$scripts[] = $this->__ckeditor($element, $options['ckfinder'], $options['toolbar']);
		}

		$scripts = sprintf('jQuery(function() { %s });', implode("\n", $scripts));
		$output .= $this->Html->scriptBlock($scripts, array('inline' => false));

		if ($return) {
			return $output;
		}

		echo $output;

	}

	private function __ckeditor($element, $ckfinder = false, $toobar = 'basic') {
		if ($ckfinder === false) {
			return sprintf("app.ckeditor('%s', %s, '%s');", $element, 'false', $toobar);
		} else {
			return sprintf("app.ckeditor('%s', '%s', '%s');", $element, $this->webroot . 'js/' . $this->ckfinder_path . '/', $toobar);
		}
	}

}
