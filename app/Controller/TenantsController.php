<?php
/**
 * Tenants Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Account
 * @subpackage	Tenants
 * @todo 创建Tenant之后的动作, 可以采用新的EventSystem来实现
 */

App::uses('AppController', 'Controller');

class TenantsController extends AppController {

	public $paginate = array(
		'conditions' => array(),
		'contain' => array(),
		'order' => array('id' => 'DESC'),
	);

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
	);

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('_tenants', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->Tenant->id = $id;
		if (!$this->Tenant->exists()) {
			throw new NotFoundException(__('Invalid tenant'));
		}
		$this->set('tenant', $this->Tenant->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Tenant->create();
			if ($this->Tenant->save($this->request->data)) {
				$this->Session->setFlash(__('The tenant has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tenant could not be saved. Please, try again.'), 'error');
			}
		}

	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Tenant->id = $id;
		if (!$this->Tenant->exists()) {
			throw new NotFoundException(__('Invalid tenant'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tenant->save($this->request->data)) {
				$this->Session->setFlash(__('The tenant has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tenant could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Tenant->read(null, $id);
		}

	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$this->Tenant->id = $id;
		if (!$this->Tenant->exists()) {
			throw new NotFoundException(__('Invalid tenant'));
		}

		$this->Tenant->delete();
		if ($this->Session->read('Tenant.deleted') === true) {
			$this->Session->delete('Tenant.deleted');
			$this->Session->setFlash(__('Tenant deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Tenant was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}
}
