<?php
/**
 * Categories Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Categories
 * @ignore true
 * @todo bugfix tree view
 */

App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

	public $viewPath = 'Categories';

	public $components = array('RequestHandler');

	public $paginate = array(
		'conditions' => array(),
		'contain' => array('ParentCategory'),
		'order' => array('id' => 'DESC'),
	);

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'tenant_id', 'type' => 'value'),
	);

	/**
	 * 是否是极简的分类, 没有父节点, 没有子节点
	 * @var boolean
	 */
	protected $simpleCategory = false;

	/**
	 * 是否可以作为首页的小部件
	 * @var boolean
	 */
	protected $actAsWidget = false;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('children');
	}

	public function beforeRender() {
		parent::beforeRender();
		$this->set('simpleCategory', $this->simpleCategory);
		$this->set('actAsWidget', $this->actAsWidget);
	}

	/**
	 * 以扁平化的方式管理类目
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set($this->plural, $this->paginate());
		$this->set('parents', $this->{$this->modelClass}->getParents(true));
	}

	/**
	 * 以树结构的方式管理类目
	 *
	 * @return void
	 */
	public function admin_tree() {
		$this->set($this->plural, $this->{$this->modelClass}->getThreaded());
		$this->set('parents', $this->{$this->modelClass}->getParents(true));
	}

	public function admin_children() {
		$parent_id = null;
		if (isset($this->request->query['parent_id'])) {
			$parent_id = $this->request->query['parent_id'];
		}

		$items = $this->{$this->modelClass}->find('all', array(
			'conditions' => array(
				$this->modelClass . '.parent_id' => $parent_id,
			),
		));

		$response = array();
		if (!empty($items)) {
			foreach ($items as $item) {
				$has_child = (($item[$this->modelClass]['lft'] + 1) < $item[$this->modelClass]['rght']) ? true : false;
				$response[] = array(
					'title' => $item[$this->modelClass]['name'],
					'isFolder' => $has_child,
					'isLazy' => $has_child,
					'key' => $item[$this->modelClass]['id'],
				);
			}
		}

		$this->set('response', $response);
		$this->set('_serialize', 'response');
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}

		$this->set($this->singular, $this->{$this->modelClass}->read(null, $id));

		if ($this->request->is('ajax')) {
			$this->set('_serialize', $this->singular);
		}
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->{$this->modelClass}->create();
			if ($this->{$this->modelClass}->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'), 'success');
				$this->redirect($this->request->referer());
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'), 'error');
			}
		}

		$parents = $this->{$this->modelClass}->getParents();
		$this->set(compact('parents'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->{$this->modelClass}->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->{$this->modelClass}->read(null, $id);
		}

		$parents = $this->{$this->modelClass}->getParents();
		$this->set(compact('parents'));
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}

		$sessionKey = $this->modelClass . '.deleted';
		$this->{$this->modelClass}->delete();

		if ($this->Session->read($sessionKey) === true) {
			$this->Session->delete($sessionKey);
			$this->Session->setFlash(__('Category deleted'), 'success');
			$this->redirect($this->request->referer());
		}

		$this->Session->setFlash(__('Category was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

}
