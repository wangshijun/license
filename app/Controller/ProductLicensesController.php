<?php
/**
 * ProductLicenses Controller
 *
 * PHP version 5
 *
 * @author	 wangshijun <wangshijun2010@gmail.com>
 * @copyright	(c) 2011-2012 by wangshijun <wangshijun2010@gmail.com>
 * @package	default
 * @subpackage	ProductLicenses
 */

App::uses('AppController', 'Controller');

class ProductLicensesController extends AppController {

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
		$this->set('productLicenses', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->ProductLicense->id = $id;
		if (!$this->ProductLicense->exists()) {
			throw new NotFoundException(__('Invalid product license'));
		}
		$this->set('productLicense', $this->ProductLicense->read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductLicense->create();
			if ($this->ProductLicense->save($this->request->data)) {
				$this->Session->setFlash(__('The product license has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product license could not be saved. Please, try again.'), 'error');
			}
		}

		$products = $this->ProductLicense->Product->find('list');
		$productPrices = $this->ProductLicense->ProductPrice->find('list');
		$this->set(compact('products', 'productPrices'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->ProductLicense->id = $id;
		if (!$this->ProductLicense->exists()) {
			throw new NotFoundException(__('Invalid product license'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductLicense->save($this->request->data)) {
				$this->Session->setFlash(__('The product license has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product license could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->ProductLicense->read(null, $id);
		}

		$products = $this->ProductLicense->Product->find('list');
		$productPrices = $this->ProductLicense->ProductPrice->find('list');
		$this->set(compact('products', 'productPrices'));
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

		$this->ProductLicense->id = $id;
		if (!$this->ProductLicense->exists()) {
			throw new NotFoundException(__('Invalid product license'));
		}

		$deleted = $this->ProductLicense->delete();
		if ($this->Session->read('ProductLicense.deleted') === true) {
			$this->Session->delete('ProductLicense.deleted');
			$this->Session->setFlash(__('Product license deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Product license was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}
}
