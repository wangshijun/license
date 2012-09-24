<?php
/**
 * Configs Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	System
 * @subpackage	Configs
 */

App::uses('AppController', 'Controller');

class ConfigsController extends AppController {

	public function hasOwnMethod($method) {
		return in_array($method, array('admin_edit', 'admin_index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		if ($this->Config->find('count') === 0) {
			$this->Config->initialize();
		}
	}

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('configs', $this->paginate());
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Config->id = $id;
		if (!$this->Config->exists()) {
			throw new NotFoundException(__('Invalid config'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Config->save($this->request->data)) {
				$this->Session->setFlash(__('The config has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The config could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Config->read(null, $id);
		}
	}

	/**
	 * 恢复到设置的初始状态
	 *
	 * @access public
	 * @return void
	 */
	public function admin_restore() {

	}

}
