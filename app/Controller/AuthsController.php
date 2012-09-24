<?php
/**
 * 用户认证,权限控制系统的功能集合,
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
 * @package	System
 * @subpackage	Auths
 *
 * @todo 支持插件的Controller扫描和ACO的构造
 * @todo 支持默认权限的配置文件方式, 减少默认权限策略对这个代码的侵入性
 */

App::uses('AppController', 'Controller');

class AuthsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');

		if (Configure::read('debug') > 0) {
			$this->Auth->allow('*');
		}

		set_time_limit(300);
		ini_set('memory_limit','64M');
	}

	public function hasOwnMethod($method) {
		return in_array($method, array('admin_index', 'admin_acos', 'admin_aros', 'admin_permissions'));
	}

	/**
	 * 系统权限管理控制台
	 *
	 * @menu true
	 */
	public function admin_index() {}

	/**
	 * 重建ACO列表, 注意这里不考虑Plugin对ACO列表的贡献,
	 */
	public function admin_acos() {
		$start = microtime(true);

		// 清空ACO列表
		$logs = array();
		$Aco = $this->Acl->Aco;
		$Aco->query('TRUNCATE TABLE `acos`');

		// 创建根节点
		$Aco->create(array('parent_id' => null, 'alias' => 'controllers'));
		$root = $Aco->save();
		$root['Aco']['id'] = $Aco->id;
		$logs[] = 'Created Aco node for: controllers';

		// 重新构建package树
		App::uses('PackageScanner', 'Lib');
		$packages = PackageScanner::scan();

		// 遍历package树, 创建ACO节点
		foreach ($packages as $i=>$package) {
			foreach ($package['children'] as $j=>$subpackage) {
				$Aco->create(array('parent_id' => $root['Aco']['id'], 'alias' => $subpackage['alias']));
				$controller = $Aco->save();
				$controller['Aco']['id'] = $Aco->id;
				$logs[] = 'Created Aco node for: ' . $subpackage['aco'];
				foreach ($subpackage['children'] as $k=>$action) {
					$Aco->create(array('parent_id' => $controller['Aco']['id'], 'alias' => $action['alias']));
					$Aco->save();
					$logs[] = 'Created Aco node for: ' . $action['aco'];
				}
			}
		}

		$end = microtime(true);
		$this->log(sprintf('It takes %d seconds to built ACO tree', $end - $start));

		$this->Session->setFlash(__('Aco tree is rebuilt successfully!'), 'success');

		$this->set('logs', $logs);
		$this->render('admin_index');
	}

	/**
	 * 重建ARO列表
	 */
	public function admin_aros() {
		$start = microtime(true);

		// 清空ACO列表
		$logs = array();
		$aro = $this->Acl->Aro;
		$aro->query('TRUNCATE TABLE `aros`');

		$this->loadModel('Group');
		$this->loadModel('User');

		$this->Group->configIsolated(false);
		$this->User->configIsolated(false);

		// 创建角色的ARO列表
		$groups = $this->Group->find('all', array(
			'order' => 'Group.parent_id ASC',
			'recursive' => -1,
		));

		//debug($groups);
		$cache = array();
		foreach ($groups as $group) {
			$parent_id = NULL;
			if ($group['Group']['parent_id'] > 0) {
				$parent_aro = $aro->node(array(
					'foreign_key' => $group['Group']['parent_id'],
					'model' => 'Group',
				));
				if (is_array($parent_aro)) {
					$parent_id = $parent_aro[0]['Aro']['id'];
				}
			}

			$aro->create(array(
				'parent_id' => $parent_id,
				'foreign_key' => $group['Group']['id'],
				'model' => 'Group',
				'alias' => null,
			));

			$aro->save();
			$cache[$group['Group']['id']] = $aro->id;

			$logs[] = sprintf('Created Aro node for Group(#%s:%s)',
				$group['Group']['id'], $group['Group']['name']);
		}

		// 创建用户的ARO列表
		$users = $this->User->find('all', array(
			'order' => 'User.group_id ASC',
			'recursive' => -1,
		));

		//debug($users);
		foreach ($users as $user) {
			$aro->create(array(
				'parent_id' => $cache[$user['User']['group_id']],
				'foreign_key' => $user['User']['id'],
				'model' => 'User',
				'alias' => null,
			));

			$aro->save();

			$logs[] = sprintf('Created Aro node for User(#%s:%s)',
				$user['User']['id'], $user['User']['name']);
		}

		$end = microtime(true);
		$this->log(sprintf('It takes %d seconds to built ARO tree', $end - $start));

		$this->Session->setFlash(__('Aro tree is rebuilt successfully!'), 'success');

		$this->set('logs', $logs);
		$this->render('admin_index');
	}

	/**
	 * 重建权限列表, 默认的权限分配策略应该写到配置文件中
	 *
	 * @todo 这里应该采用更加精巧的方式实现权限分配的自动化
	 */
	public function admin_permissions() {
		$start = microtime(true);

		// 清空现有的权限列表
		$this->Acl->Aro->query('TRUNCATE TABLE `aros_acos`');

		// 加载用户组
		$this->loadModel('Group');
		$group =& $this->Group;

		// 系统管理员组权限
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');
		$logs[] = '初始化系统管理员组的权限';

		// 业务管理员组权限
		$group->id = 5;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->deny($group, 'controllers/Tenants');
		$this->Acl->deny($group, 'controllers/Auths');
		$this->Acl->deny($group, 'controllers/Logs');
		$this->Acl->deny($group, 'controllers/Configs');

		$logs[] = '初始化管理员组的权限';

		$end = microtime(true);
		$this->log(sprintf('It takes %d seconds to reset permission policies', $end - $start));

		$this->Session->setFlash(__('Permissions are intialized successfully!'), 'success');

		$this->set('logs', $logs);
		$this->render('admin_index');
	}

	protected function _set_common_permissions(&$group) {
		$this->Acl->deny($group, 'controllers');
	}

}