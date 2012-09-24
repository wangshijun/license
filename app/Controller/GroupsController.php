<?php
/**
 * Groups Controller
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Account
 * @subpackage	Groups
 * @todo	实现层次化的角色管理界面和扁平化的角色管理界面
 */

App::uses('AppController', 'Controller');

class GroupsController extends AppController {

	public $components = array('RequestHandler');

	public $paginate = array(
		'conditions' => array(),
		'contain' => array('ParentGroup'),
		'order' => array('id' => 'DESC'),
	);

	// Search.Searchable Settings
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'tenant_id', 'type' => 'value'),
	);

	/**
	 * index method
	 *
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('groups', $this->paginate());
	}

	public function admin_tree() {
		$this->set($this->plural, $this->{$this->modelClass}->getThreaded());
		$this->set('parents', $this->{$this->modelClass}->getParents(true));
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->set('group', $this->Group->read(null, $id));

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
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'), 'success');
				$this->redirect($this->request->referer());
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'error');
			}
		}

		$parents = $this->Group->getParents();
		$this->set(compact('parents'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
		}

		$parents = $this->Group->getParents();
		$this->set(compact('parents'));
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}

		$this->Group->delete();
		if ($this->Session->read('Group.deleted') === true) {
			$this->Session->delete('Group.deleted');
			$this->Session->setFlash(__('Group deleted'), 'success');
			$this->redirect($this->request->referer());
		}

		$this->Session->setFlash(__('Group was not deleted'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 分配角色权限
	 *
	 * @access public
	 * @return void
	 */
	public function admin_permission($id = null) {
		// 处理单个的Ajax权限变更请求
		if ($this->request->is('ajax')) {
			$response = new stdClass();
			$response->status = false;
			$response->code = null;

			$user_aro = array('model' => 'User', 'foreign_key' => $this->user('id'));
			$group_aro = $this->Session->read('Groups.active');

			$actionMaps = array(
				'allow' => 'allow',
				'deny' => 'deny',
				__('Allow') => 'allow',
				__('Deny') => 'deny',
			);

			if (isset($group_aro, $this->request->data['aco'], $this->request->data['action'])) {
				// 对于当前用户没有的权限, 是不能分配给其他人的
				if ($this->Acl->check($user_aro, $this->request->data['aco']) === false) {
					$response->code = __('You cannot change permissions that you donot have access to');
				} else {
					$aco = $this->request->data['aco'];
					$action = $actionMaps[strtolower($this->request->data['action'])];
					if (in_array($action, array('allow', 'deny'))) {
						$response->status = $this->Acl->{$action}($group_aro, $aco);
						if ($response->status) {
							$this->log(sprintf('更新角色权限: %s=>%s', $aco, $action), $group_aro['foreign_key']);
							$response->code = __('Group permissions saved');
							$this->_clear_user_menu_cache($group_aro['foreign_key']);
						} else {
							$response->code = __('Group permissions cannot be saved, please try again');
						}
					} else {
						$response->code = __('Invalid permission action');
					}
				}
			} else {
				$response->code = __('Invalid request');
			}

			$this->json($response);

		// 处理比较漫长的权限抽取
		} else {
			set_time_limit(120);
			ini_set('memory_limit','256M');

			$this->Group->id = $id;
			if (!$this->Group->exists()) {
				throw new NotFoundException(__('Invalid group'));
			}

			$start = microtime(true);

			App::uses('PackageScanner', 'Lib');
			$packages = PackageScanner::read();

			$hidden_modules = array('Tenants');
			$group_aro = array('model' => 'Group', 'foreign_key' => $id);

			foreach ($packages as $i=>$package) {
				foreach ($package['children'] as $j=>$subpackage) {
					if (in_array($subpackage['alias'], $hidden_modules)) {
						unset($packages[$i]['children'][$j]);
						continue;
					}
					foreach ($subpackage['children'] as $k=>$action) {
						$packages[$i]['children'][$j]['children'][$k]['allow'] = $this->Acl->check($group_aro, $action['aco']);
					}
				}
			}

			$end = microtime(true);
			$this->log(sprintf('It takes %d seconds to extract permissions for Group#%s', $end - $start, $id));

			$this->Session->write('Groups.active', $group_aro);

			$this->set('packages', $packages);
		}
	}

	/**
	 * 更新权限之后删除该角色之下所有用户的菜单缓存
	 *
	 * @param int $group_id 权限变更的角色的ID
	 * @return void
	 */
	private function _clear_user_menu_cache($group_id) {
		$this->loadModel('User');
		$users = $this->User->find('all', array(
			'conditions' => array('User.group_id' => $group_id),
			'recursive' => -1,
		));

		if (!empty($users)) {
			foreach ($users as $user) {
				$this->Menu->delete($user['User']);
			}
		}
	}
}
