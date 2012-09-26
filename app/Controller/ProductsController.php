<?php
/**
 * Products Controller
 *
 * PHP version 5
 *
 * @author	 wangshijun <wangshijun2010@gmail.com>
 * @copyright	(c) 2011-2012 by wangshijun <wangshijun2010@gmail.com>
 * @package	Products
 * @subpackage	Products
 */

App::uses('AppController', 'Controller');

class ProductsController extends AppController {

	public $paginate = array(
		'conditions' => array(),
		'contain' => array(),
		'order' => array('id' => 'DESC'),
	);

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'tenant_id', 'type' => 'value'),
	);


	/**
	 * admin_index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('products', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'), 'error');
			}
		}

	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Product->read(null, $id);
		}

	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}

		$deleted = $this->Product->delete();
		if ($this->Session->read('Product.deleted') === true) {
			$this->Session->delete('Product.deleted');
			$this->Session->setFlash(__('Product deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Product was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}
}
