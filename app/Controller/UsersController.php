<?php
/**
 * Users Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Account
 * @subpackage	Users
 */

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $paginate = array(
		'conditions' => array(),
		'contain' => array('Group'),
		'order' => array('id' => 'DESC'),
	);

	public $helpers = array('Media.Media');

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'tenant_id', 'type' => 'value'),
	);

	protected $genders = array(
		'0' => 'Female',
		'1' => 'Male',
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('admin_login');
	}

	public function beforeRender() {
		parent::beforeRender();
		if ($this->request->action === 'admin_login') {
			$this->layout = 'login';
		}
	}

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('users', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->find('first', array(
			'conditions' => array('User.id' => $id),
			'contain' => array('Group', 'UserProfile'),
		)));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
			}
		}

		if (is_root_tenant() === true) {
			$this->User->Group->configIsolated('find', false);
		}
		$groups = $this->User->Group->getParents();
		$this->set(compact('groups'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}

		$groups = $this->User->Group->getParents();
		$this->set(compact('groups'));
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

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->User->delete();
		if ($this->Session->read('User.deleted') === true) {
			$this->Session->delete('User.deleted');
			$this->Session->setFlash(__('User deleted'), 'success');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('User was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 后台修改密码
	 *
	 * @menu true
	 */
	public function admin_password() {
		if ($this->request->is('post')) {
			$this->User->id = $this->user('id');

			$user = $this->User->read(null);
			if (empty($user)) {
				throw new NotFoundException(__('Invalid user'));
			}

			$passwords = $this->request->data['User'];

			if (AuthComponent::password($passwords['old']) !== $user['User']['password']) {
				$this->Session->setFlash(__('Your old password is not correct!'), 'error');
			} elseif ($passwords['new'] !== $passwords['confirm']) {
				$this->Session->setFlash(__('Your new passwords are not the same!'), 'error');
			} else {
				$updates = array('User' => array('password' => $passwords['new']));
				if ($this->User->save($updates)) {
					$this->Session->setFlash(__('Congratulations, your passwords are changed, Please login with the new one!'), 'success');
					$this->log('用户更新密码: ' . $this->user('name'));
					$this->redirect(array('action' => 'logout', 'admin' => false));
				} else {
					$this->Session->setFlash(__('Sorry, your password can not be saved, please try again!'), 'error');
				}
			}
		}
	}

	/**
	 * 修改用户资料, 后续可以扩展
	 * @return void
	 */
	public function admin_profile() {
		$this->User->id = $this->user('id');
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved'), 'success');
				$this->redirect(array('action' => 'profile'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->User->getProfile();
			$this->set('genders', $this->genders);
		}
	}

	/**
	 * 修改用户头像
	 * @return void
	 * @todo $this->ajax does not work properly, it renders the admin layout
	 */
	public function admin_avatar() {
		$this->User->id = $this->user('id');
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			Configure::load('media.user');
			if ($this->User->saveAll($this->request->data, array('validate'=>'first'))) {
				$this->Session->write(Configure::read('SessionKey'), $this->User->find('first', array(
					'conditions' => array('User.id' => $this->user('id')),
					'contain' => array('Avatar'),
				)));
				$response = '<div id="status">success</div>';
				$response .= '<div id="message">' . __('The avatar has been saved') . '</div>';
			} else {
				$response = '<div id="status">error</div>';
				$response .= '<div id="message">' . __('The avatar could not be saved. Please, try again.') . '</div>';
			}
			$this->ajax($response);
		} else {
			$this->request->data = $this->User->find('first', array(
				'conditions' => array('User.id' => $this->User->id),
				'contain' => array('Avatar'),
			));
		}
	}

	/**
	 * 重置用户密码, 随机
	 */
	public function admin_reset_password($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$password = $this->_get_random_password();
		$user = $this->User->read(null, $id);

		$this->set('password', $password);
		$this->set('user', $user);

		if ($this->User->save(array('password' => $password))) {
			$this->log('重置用户密码:' . $user['User']['name'], $user['User']['id']);
			$this->Session->setFlash(__('The user password has been reset'), 'success');
		} else {
			$this->Session->setFlash(__('The user password could not be reset. Please, try again.'), 'error');
			$this->redirect(array('action' => 'index'));
		}

	}

	protected function _get_random_password() {
		$password = (string) mt_rand();
		if (strlen($password) >= 6) {
			return substr($password, 0, 6);
		} else {
			return str_pad($password, 0, 6);
		}
	}

	/**
	 * 后台用户中心
	 */
	public function admin_dashboard() {}

	/**
	 * 前台用户登录
	 */
	public function admin_login() {
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash(__('You are logged in!'), 'success');
			$this->redirect($this->Auth->loginRedirect, null, false);

		} elseif ($this->request->is('post')) {
			if ($this->Auth->login()) {

				require(APPLIBS . 'Functions.php');

				$this->User->id = $this->user('id');
				$this->User->save(array(
					'ip_last_login' => get_client_ip(),
					'gmt_last_login' => date('Y-m-d H:i:s'),
				));

				$this->log('用户登入系统: ' . $this->user('name'));

				//debug($this->Auth->loginRedirect);
				//debug($this->user()); exit();

				$this->redirect($this->Auth->loginRedirect, null, true);
			} else {
				$this->Session->setFlash(__('Your username or password was incorrect.'), 'error');
				//$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
			}
		}
	}

	/**
	 * 前台用户注销
	 */
	public function admin_logout($hasFlash = false) {
		if ($hasFlash === false) {
			$this->Session->setFlash(__('Good-Bye'), 'success');
		}

		$this->Session->delete(Configure::read('SessionKey'));

		$this->redirect($this->Auth->logout());
	}

}
