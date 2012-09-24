<?php
/**
 * Posts Controller, 作为其他文章类Controller的父类
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Posts
 * @ignore true
 */

App::uses('AppController', 'Controller');

class PostsController extends AppController {

	public $viewPath = 'Posts';

	public $helpers = array('CKEditor', 'Text');

	public $components = array(
		'Comments.Comments' => array(
			'userModelClass' => 'User',
			'userNameField' => 'name',
			'allowAnonymousComment' => true,
		),
	);

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'title', 'type' => 'value'),
		array('field' => 'category_id', 'type' => 'value'),
		array('field' => 'tenant_id', 'type' => 'value'),
	);

	public $paginate = array(
		'conditions' => array(),
		'contain' => array('Author', 'Category'),
		'order' => array('id' => 'DESC'),
	);

	/**
	 * Whether post articles has cover
	 * @var boolean
	 */
	protected $hasCover = false;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

	/**
	 * Matain search parameters, fetch building list when neccessary
	 * @return void
	 */
	public function beforeRender() {
		parent::beforeRender();
		$this->set('hasCover', $this->hasCover);

		if ($this->request->action === 'admin_search') {
			if (isset($this->request->named['category_id'])) {
				$category_id = $this->request->named['category_id'];
			} else {
				$category_id = 0;
			}
			$this->set('category_id', $category_id);
		}

		if ($this->request->prefix === 'admin') {
			$this->set('categories', $this->{$this->modelClass}->Category->getParents());
		}
	}

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set($this->plural, $this->paginate());
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
				$this->Session->setFlash(__('The post has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'error');
			}
		}

		$this->set('author_id', $this->user('id'));
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
			throw new NotFoundException(__('Invalid post'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->{$this->modelClass}->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->{$this->modelClass}->read(null, $id);
		}

		$this->set('author_id', $this->user('id'));
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

		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}

		$sessionKey = $this->modelClass . '.deleted';
		$deleted = $this->{$this->modelClass}->delete();

		if ($this->Session->read($sessionKey) === true) {
			$this->Session->delete($sessionKey);
			$this->Session->setFlash(__('Post deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Post was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 所有人: 浏览某篇文章, 更新浏览数
	 * 对于未发表或者回收站中的文章需要传入preview参数
	 */
	public function view($post_id = null) {
		$this->{$this->modelClass}->id = $post_id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}

		$conditions = array($this->modelClass . '.published' => true);
		if (isset($this->request->named['preview'])) {
			$this->{$this->modelClass}->configRecyclable('find', false);
			$conditions = array();
		}

		$post = $this->{$this->modelClass}->find('first', array(
			'conditions' => array_merge($conditions, array($this->modelClass . '.id' => $post_id)),
			'contain' => array('Author'),
		));

		$this->{$this->modelClass}->saveField('click_count', $post[$this->modelClass]['click_count'] + 1);

		$this->set($this->singular, $post);
		if (!isset($this->viewVars['categories'])) {
			$this->set('categories', $this->{$this->modelClass}->Category->getThreaded(true));
		}
	}

	/**
	 * 所有人: 浏览某个栏目下的文章
	 * @note 如果该特定栏目下只有1个文章, 那跳转到浏览页
	 * @todo 如果该栏目下有子栏目, 则子栏目摘要形式出现
	 */
	public function index() {
		if (isset($this->request->params['named']['category_id'])) {
			$category_id = $this->request->params['named']['category_id'];
		}

		if (!empty($category_id)) {
			$this->{$this->modelClass}->Category->id = $category_id;
			$this->set('title', $this->{$this->modelClass}->Category->field('name'));

			$this->paginate['conditions'] = array(
				$this->modelClass . '.category_id' => $category_id,
				$this->modelClass . '.published' => 1,
			);
		} else {
			$this->paginate['conditions'] = array(
				$this->modelClass . '.published' => 1,
			);
			$this->set('title', __($this->humanize));
		}

		$this->paginate['fields'] = array(
			$this->modelClass . '.id',
			$this->modelClass . '.title',
			$this->modelClass . '.click_count',
			$this->modelClass . '.gmt_published',
			$this->modelClass . '.publish_date',
		);

		$this->paginate['order'] = array(
			$this->modelClass . '.publish_date' => 'DESC',
			$this->modelClass . '.gmt_create' => 'DESC',
		);

		$this->paginate['contain'] = array();
		$this->paginate['limit'] = 20;

		$posts = $this->paginate();
		if (count($posts) === 1 && isset($posts[0][$this->modelClass]['id'])) {
			return $this->redirect(array('action' => 'view', $posts[0][$this->modelClass]['id']), null, false);
		}

		$this->set($this->plural, $posts);
		if (!isset($this->viewVars['categories'])) {
			$this->set('categories', $this->{$this->modelClass}->Category->getThreaded(true));
		}
	}

	/**
	 * Initializes the view type for comments widget
	 *
	 * @return string
	 * @access public
	 */
	public function callback_commentsInitType() {
		return 'threaded'; // threaded, tree and flat supported
	}

	/**
	 * 移动版的需要对HTML内容进行清理, 转换成标准的, 样式表可以控制的纯净的html
	 *
	 * @todo 清理掉img标签, 清理掉内联style, 清理掉其他非必须属性
	 */
	protected function strip_post($post) {
		if (empty($post)) {
			return $post;
		}

		$post[$this->modelClass]['content'] = preg_replace(
			array("/<img[^>]+\>/i", "/&nbsp;/i", "/<br\/?>/i", "/\sstyle=\"[^\"]+\"/i"),
			"",
			$post['Post']['content']
		);
		$content = strip_tags($post[$this->modelClass]['content'], '<p><strong><table><tr><td><thead><th><tbody><ul><li><a>');
		$content = preg_split('/\s+/', $content, -1, PREG_SPLIT_NO_EMPTY);
		foreach ($content as $p) {
			if (trim(html_entity_decode($p)) == '') {
				continue;
			}
			$content .= '<p>' . $p . '</p>';
		}

		return $post;
	}

}
