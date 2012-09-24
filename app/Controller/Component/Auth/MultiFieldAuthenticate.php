<?php
/**
 * 用户多字段登录认证组件
 *
 * Copyright (c) 2011-2012 tomato
 *
 * PHP 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011-2012 tomato <wangshijun2010@gmail.com>
 * @license	http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package	App
 * @subpackage	Controller.Component.Auth
 */

App::uses('CakeSession', 'Model/Datasource');
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class MultiFieldAuthenticate extends BaseAuthenticate {

/**
 * Authenticates the identity contained in a request.  Will use the `settings.userModel`, and `settings.fields`
 * to find POST data that is used to find a matching record in the `settings.userModel`.  Will return false if
 * there is no post data, either username or password is missing, of if the scope conditions have not been met.
 *
 * @param CakeRequest $request The request that contains login information.
 * @param CakeResponse $response Unused response object.
 * @return mixed.  False on login failure.  An array of User data on success.
 */
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		$userModel = $this->settings['userModel'];
		list($plugin, $model) = pluginSplit($userModel);

		if (empty($request->data[$model])) {
			return false;
		}

		if (empty($request->data[$model][$this->settings['post_key']])
			|| empty($request->data[$model][$this->settings['fields']['password']]))
		{
			return false;
		}

		$User = ClassRegistry::init($userModel);
		$password = $request->data[$model][$this->settings['fields']['password']];

		foreach ($this->settings['fields']['username'] as $username) {
			$conditions = array();
			if (!empty($this->settings['scope'])) {
				$conditions = array_merge($conditions, $this->settings['scope']);
			}

			$conditions[$model . '.' . $username] = $request->data[$model][$this->settings['post_key']];
			$conditions[$model . '.' . $this->settings['fields']['password']] = $this->_password($password);

			$result = $User->find('first', array(
				'conditions' => $conditions,
				'contain' => $this->settings['contain'],
			));

			if (!empty($result) || !empty($result[$model])) {
				CakeSession::write(Configure::read('SessionKey'), $result);
				unset($result[$model][$this->settings['fields']['password']]);
				return $result[$model];
			}
		}

		return false;
	}

}
