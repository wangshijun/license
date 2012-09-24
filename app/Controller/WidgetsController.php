<?php
/**
 * Widgets Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Widgets
 * @todo Rename this module to ArticleWidget
 * @todo Implement Drag and Drop for widget organize and resize
 */

App::uses('AppController', 'Controller');

class WidgetsController extends AppController {

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

	public function beforeRender() {
		parent::beforeRender();

		if (in_array($this->request->action, array('admin_edit', 'admin_add'))) {
			$categories = $this->Widget->Category->getParents();
			$sizes = $this->Widget->getSizes();
			$columns = $this->Widget->getColumns();

			$this->set(compact('categories', 'sizes', 'columns'));
		}
	}

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('widgets', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid widget'));
		}
		$this->set('widget', $this->Widget->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Widget->create();
			if ($this->Widget->save($this->request->data)) {
				$this->Session->setFlash(__('The widget has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.'), 'error');
			}
		}

		if (isset($this->request->named['category_id'])) {
			$this->set('category', $this->Widget->Category->read(null, $this->request->named['category_id']));
		}

	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid widget'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Widget->save($this->request->data)) {
				$this->Session->setFlash(__('The widget has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Widget->read(null, $id);
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

		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid widget'));
		}

		$deleted = $this->Widget->delete();
		if ($this->Session->read('Widget.deleted') === true) {
			$this->Session->delete('Widget.deleted');
			$this->Session->setFlash(__('Widget deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Widget was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}
}
