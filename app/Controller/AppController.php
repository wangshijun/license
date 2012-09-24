<?php
/**
 * Application Controller
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
 * @package	tomato
 * @subpackage	tomato
 * @todo 将Comments加入到App核心中来, 作为基础设施使用
 * @todo Implement Search in Recycle Bin
 * @todo bugfix Undefined index: BuildingBlock in Search Form Name
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class AppController extends Controller {
	public $components = array(
		'Acl', 'Session', 'Menu',
		'DebugKit.Toolbar', 'Search.Prg',
		'Auth' => array(
			'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin' => true, 'plugin' => false),
			'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true, 'plugin' => false),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false, 'plugin' => false),
		),
	);

	public $helpers = array('Html', 'Form', 'Session', 'BootstrapForm', 'BootstrapPaginator');

	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		$this->plural = $this->_pluralName($this->modelClass);
	}

	/**
	 * 用户认证, 多国语言支持
	 */
	public function beforeFilter() {
		$this->_setup_auth();
		$this->_setup_language();
		$this->_setup_flags();
		$this->_setup_root();
		$this->_setup_inflector();
	}

	/**
	 * 设置当前登录的用户信息, 移动设备信息, 后台请求信息
	 *
	 * @warning 对于每次请求设置当前登录用户, 请避免在子类中覆盖此变量
	 */
	public function beforeRender() {
		$this->set('USER', $this->user());

		$this->layout = 'default';

		if ($this->isMobile) {
			$this->layout = 'mobile';
			$this->view = 'mobile_' . $this->request->action;
			return true;
		}

		if ($this->isAdmin) {
			$this->layout = 'admin';
		}

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		if (is_root_tenant()) {
			if (isset($this->Tenant) === false) {
				$this->loadModel('Tenant');
			}
			$this->set('tenants', $this->Tenant->getTenants());
		}

		if ($this->layout === 'default' && !isset($this->viewVars['categories'])) {
			$this->loadModel('ArticleCategory');
			$this->set('categories', $this->ArticleCategory->getThreaded(true));
		}

		$this->set('title_for_layout', __($this->name) . ' - ' . Configure::read('App.name'));

		$this->set('inflector', array(
			'plural' => $this->plural,
			'singular' => $this->singular,
			'underscore' => $this->underscore,
			'camelize' => $this->camelize,
			'shumanize' => $this->shumanize,
			'humanize' => $this->humanize,
		));
	}

	/**
	 * 用户Authentication, Authorize等的设置
	 */
	protected function _setup_auth() {

		if (Configure::read('debug') > 0) {
			//return $this->Auth->allow('*');
		}

		// 多字段登录选项
		$this->Auth->authenticate = array(
			'MultiField' => array(
				'fields' => array(
					'username' => array('email', 'mobile', 'name'),
					'password' => 'password',
				),
				'scope' => array('User.active' => 1),
				'post_key' => 'name',
				'userModel' => 'User',
				'contain' => array(),
			),
		);

		// Action级别的权限控制
		$this->Auth->authorize = array(
			'Actions' => array('actionPath' => 'controllers'),
		);

		// @todo 这里的允许搜索hack应该去掉
		$this->Auth->allow('search', 'admin_search');
	}

	/**
	 * 多国语言支持
	 */
	protected function _setup_language() {
		$this->Session->write('Config.language', Configure::read('Config.language'));
	}

	/**
	 * 移动设备检测, 管理员登陆检测
	 */
	protected function _setup_flags() {
		if ($this->request->is('mobile')) {
			$this->isMobile = true;
		} else {
			$this->isMobile = false;
		}

		$prefixes = (array)Configure::read('Routing.prefixes');
		if (isset($this->request->prefix) && in_array($this->request->prefix, $prefixes)) {
			$this->isAdmin = true;
		} else {
			$this->isAdmin = false;
		}
	}

	/**
	 * 跟租户检测
	 */
	protected function _setup_root() {
		if (is_root_tenant() && is_callable(array($this->{$this->modelClass}, 'configIsolated'))) {
			$this->{$this->modelClass}->configIsolated('find', false);
		}
	}

	/**
	 * 设置多种变形, 方便在视图中使用
	 */
	protected function _setup_inflector() {
		$this->singular = Inflector::singularize($this->plural);	// 单数, articleCategory
		$this->underscore = Inflector::underscore($this->plural);	// 复数, article_categories
		$this->camelize = Inflector::camelize($this->singular);		// 单数, ArticleCategory
		$this->humanize = Inflector::humanize($this->underscore); 	// 复数, Article Categories
		$this->shumanize = Inflector::singularize($this->humanize);	// 单数, Article Category
	}

	/**
	 * 记录日志
	 *
	 * @param string $content 日志内容
	 * @param string $foreign_key 关联的记录ID
	 * @param string $type 日志类别
	 */
	public function log($content, $foreign_key = 0, $type = LOG_INFO) {
		$content = (!is_string($content)) ? print_r($content, true) : $content;
		return CakeLog::write($type, $content, $this->modelClass, $foreign_key);
	}

	/**
	 * 获取当前用户的信息,
	 *
	 * @see AuthComponent::user
	 * @return mixed
	 */
	protected function user($key = null) {
		return AuthComponent::user($key);
	}

	/**
	 * Json输出, 无layout
	 *
	 * @return mixed
	 * @todo CakePHP 2.1版本中的JsonView
	 */
	protected function json($data) {
		$this->viewPath = false;
		$this->response->type('json');
		$this->set('data', json_encode($data));
		$this->render('json', 'ajax');
	}

	/**
	 * Ajax输出, 无layout
	 *
	 * @return mixed
	 */
	protected function ajax($data) {
		$this->viewPath = false;
		$this->response->type('html');
		$this->set('data', $data);
		$this->render('ajax', 'ajax');
	}

	/**
	 * 模板方法: 布尔字段的切换
	 *
	 * @param string $id 记录iD
	 * @param string $value target value
	 * @param string $field field name
	 */
	public function admin_toggle($id, $field) {
		return $this->__toggle($id, $field);
	}
	public function toggle($id, $field) {
		return $this->__toggle($id, $field);
	}
	protected function __toggle($id, $field) {
		$newState = $this->{$this->modelClass}->toggle($id, $field);
		if ($newState === false) {
			$message = __(sprintf('The %s could not be toggled. Please, try again.', $this->modelClass));
			$status = false;
		} else {
			$message = __(sprintf('The %s has been toggled.', $this->modelClass));
			$status = true;
		}

		if ($this->request->is('ajax')) {
			$response = new stdClass();
			$response->status = $status;
			$response->code = $message;
			return $response;
		} else {
			$this->Session->setFlash($message, ($newState !== false) ? 'success' : 'error');
			$this->redirect($this->request->referer());
		}
	}

	/**
	 * 模板方法: 处理搜索请求
	 *
	 * @link https://github.com/CakeDC/search
	 */
	public function admin_search() {
		return $this->__search();
	}
	public function search() {
		return $this->__search();
	}
	protected function __search() {
		$this->Prg->commonProcess($this->modelClass, array('action' => $this->request->action));
		$this->paginate['conditions'] = $this->{$this->modelClass}->parseCriteria($this->passedArgs);

		if (isset($this->request->named['recycle_bin'])) {
			$this->{$this->modelClass}->configRecyclable('find', false);
			$this->paginate['conditions'][$this->modelClass . '.deleted'] = 1;
		}

		$this->set($this->plural, $this->paginate());

		$prefix = ($this->request->prefix) ? $this->request->prefix . '_' : '';
		if (isset($this->request->named['recycle_bin'])) {
			$this->render($prefix . 'recycle_bin');
		} else {
			$this->render($prefix . 'index');
		}
	}

	/**
	 * 模板方法: 显示回收站的所有记录
	 *
	 * @access public
	 * @return void
	 */
	public function admin_recycle_bin() {
		return $this->__recycle_bin();
	}
	public function recycle_bin() {
		return $this->__recycle_bin();
	}
	protected function __recycle_bin() {
		$this->{$this->modelClass}->configRecyclable('find', false);
		$this->paginate['conditions'][$this->modelClass . '.deleted'] = 1;
		$this->set($this->plural, $this->paginate());
	}

	/**
	 * 模板方法: 从回收站回收某条记录
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_recycle($id = null) {
		return $this->__recycle($id);
	}
	public function recycle($id = null) {
		return $this->__recycle($id);
	}
	protected function __recycle($id = null) {
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__(sprintf('Invalid %s.', $this->modelClass)));
		}

		if ($this->{$this->modelClass}->recycle()) {
			$this->Session->setFlash(__(sprintf('The %s has been recycled.', $this->modelClass)), 'success');
			$this->redirect(array('action' => 'recycle_bin'));
		}

		$this->Session->setFlash(__(sprintf('The %s could not be recycled. Please, try again.', $this->modelClass)), 'error');
		$this->redirect(array('action' => 'recycle_bin'));
	}

	/**
	 * 模板方法: 彻底删除某条记录, 不是软删除
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_drop($id = null) {
		return $this->__drop($id);
	}
	public function drop($id = null) {
		return $this->__drop($id);
	}
	protected function __drop($id = null) {
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__(sprintf('Invalid %s.', $this->modelClass)));
		}

		if ($this->{$this->modelClass}->drop()) {
			$this->Session->setFlash(__(sprintf('The %s has been dropped.', $this->modelClass)), 'success');
			$this->redirect(array('action' => 'recycle_bin'));
		}

		$this->Session->setFlash(__(sprintf('The %s could not be dropped. Please, try again.', $this->modelClass)), 'error');
		$this->redirect(array('action' => 'recycle_bin'));
	}

	/**
	 * 将PostCategory转化为postCategories
	 */
	protected function _pluralName($name) {
		return Inflector::variable(Inflector::pluralize($name));
	}

	/**
	 * 用于判断某个方法是否应该出现在某个Controller中, 因为存在继承
	 *
	 * @param string $method
	 * @access protected
	 * @return void
	 */
	public function hasOwnMethod($method) {
		return true;
	}
}