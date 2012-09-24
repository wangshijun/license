<?php
/**
 * Logs Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	System
 * @subpackage	Logs
 */

App::uses('AppController', 'Controller');

class LogsController extends AppController {

	public $paginate = array(
		'conditions' => array(),
		'contain' => array(),
		'order' => array('id' => 'DESC'),
	);

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'content', 'type' => 'value'),
		array('field' => 'tenant_id', 'type' => 'value'),
	);

	public function hasOwnMethod($method) {
		return $method === 'admin_index';
	}

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('logs', $this->paginate());
	}

}
