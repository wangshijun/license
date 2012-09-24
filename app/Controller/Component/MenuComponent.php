<?php
/**
 * MenuComponent
 *
 * Copyright (c) 2011-2012 tomato
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011-2012 tomato <wangshijun2010@gmail.com>
 * @license	http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package	Component
 * @subpackage	MenuComponent
 */

class MenuComponent extends Component {

	/**
	 * Components used by Menu
	 *
	 * @var array
	 */
	public $components = array('Acl', 'Auth');

	/**
	 * Set to false to disable the auto menu generation in startup()
	 * Useful if you want your menus generated off of Aro's other than the user in the current session.
	 *
	 * @var boolean
	 */
	protected $autoLoad = true;

	/**
	 * Menu cache settings
	 */
	protected $cacheKey = 'items';
	protected $cachePrefix = 'component_menu_';
	protected $cacheDuration = '+30 day';
	protected $cacheConfig = 'Component.Menu';

	/**
	 * ACP 路径构造时的参数
	 */
	protected $aclSeparator = '/';
	protected $aclPath = 'controllers/';

	/**
	 * The Completed menu for the current user.
	 */
	protected $menu = array();

	/**
	 * 初始化Component
	 *
	 * @param Object $controller
	 */
	public function startup(Controller $controller) {

		Cache::config($this->cacheConfig, array(
			'engine' => 'File',
			'duration' => $this->cacheDuration,
			'prefix' => $this->cachePrefix,
		));

		if ($controller->request->is('ajax')) {
			return false;
		}

		// no active session, no menu can be generated
		$user = $this->Auth->user();
		if (!$user) {
			return false;
		}

		if ($user['group_id'] == Configure::read('App.fontend_user_gid')) {
			return false;
		}

		if ($this->autoLoad) {
			$this->extract($user);
		}
	}

	/**
	 * Construct the menus From the Controllers in the Application.  This is an expensive
	 * Process Timewise and is cached.
	 */
	public function extract($user) {
		$cacheKey = 'user_' . $user['id'];

		$menu = Cache::read($cacheKey, $this->cacheConfig);

		if ($menu === false) {
			set_time_limit(120);
			ini_set('memory_limit','64M');

			$start = microtime(true);

			App::uses('PackageScanner', 'Lib');

			$menu = PackageScanner::read();
			$aro = array('model' => 'User', 'foreign_key' => $user['id']);

			// 注意这里的ACO路径中的Controller名称格式需要根据acos表中的格式相同
			// 否则会出现无法找到ACO节点的错误, 请根据实际需要修改
			foreach ($menu as $i=>$package) {
				foreach ($package['children'] as $j=>$subpackage) {
					if (empty($subpackage['menu'])) {
						unset($menu[$i]['children'][$j]);
						continue;
					}
					foreach ($subpackage['children'] as $k=>$action) {
						if (empty($action['menu'])) {
							unset($menu[$i]['children'][$j]['children'][$k]);
							continue;
						}
						if ($this->Acl->check($aro, $action['aco']) === false) {
							unset($menu[$i]['children'][$j]['children'][$k]);
						}
					}
					if (empty($menu[$i]['children'][$j]['children'])) {
						unset($menu[$i]['children'][$j]);
					}
				}
				if (empty($menu[$i]['children'])) {
					unset($menu[$i]);
				}
			}

			Cache::write($cacheKey, $menu, $this->cacheConfig);

			$end = microtime(true);
			$this->log(sprintf('It takes %d seconds to built menu for %s', $end - $start, $cacheKey));
		}

		$this->menu = $menu;
	}

	/**
	 * 清空菜单条目缓存
	 */
	public function delete($user) {
		$cacheKey = 'user_' . $user['id'];
		return Cache::delete($cacheKey, $this->cacheConfig);
	}

	/**
	 * BeforeRender 回调
	 */
	public function beforeRender(Controller $controller) {
		$controller->set('menu', $this->menu);
	}

}
