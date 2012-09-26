<?php
/**
 * ProductPrices Controller
 *
 * PHP version 5
 *
 * @author	 wangshijun <wangshijun2010@gmail.com>
 * @copyright	(c) 2011-2012 by wangshijun <wangshijun2010@gmail.com>
 * @package	Products
 * @subpackage	ProductPrices
 */

App::uses('AppController', 'Controller');

class ProductPricesController extends AppController {

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
		$this->set('productPrices', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->ProductPrice->id = $id;
		if (!$this->ProductPrice->exists()) {
			throw new NotFoundException(__('Invalid product price'));
		}
		$this->set('productPrice', $this->ProductPrice->read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductPrice->create();
			if ($this->ProductPrice->save($this->request->data)) {
				$this->Session->setFlash(__('The product price has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product price could not be saved. Please, try again.'), 'error');
			}
		}

		$products = $this->ProductPrice->Product->find('list');
		$this->set(compact('products'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->ProductPrice->id = $id;
		if (!$this->ProductPrice->exists()) {
			throw new NotFoundException(__('Invalid product price'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductPrice->save($this->request->data)) {
				$this->Session->setFlash(__('The product price has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product price could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->ProductPrice->read(null, $id);
		}

		$products = $this->ProductPrice->Product->find('list');
		$this->set(compact('products'));
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

		$this->ProductPrice->id = $id;
		if (!$this->ProductPrice->exists()) {
			throw new NotFoundException(__('Invalid product price'));
		}

		$deleted = $this->ProductPrice->delete();
		if ($this->Session->read('ProductPrice.deleted') === true) {
			$this->Session->delete('ProductPrice.deleted');
			$this->Session->setFlash(__('Product price deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Product price was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}
}
