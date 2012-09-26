<?php
/**
 * EasyBakeShell, bake mvc quickly with bootstrap
 *
 * PHP 5
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 1.2.0.5012
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('BakeShell', 'Console/Command');
App::uses('Model', 'Model');

class BootstrapShell extends BakeShell {

	public $tasks = array('Project', 'DbConfig', 'Model', 'Controller', 'BootstrapView', 'Plugin', 'Fixture', 'Test');

	/**
	 * Quickly bake the MVC
	 *
	 * @return void
	 */
	public function all() {
		$this->out('Bake All');
		$this->hr();

		if (!isset($this->params['connection']) && empty($this->connection)) {
			$this->connection = $this->DbConfig->getConfig();
		}

		if (empty($this->args)) {
			$this->Model->interactive = true;
			$name = $this->Model->getName($this->connection);
		}

		foreach (array('Model', 'Controller', 'BootstrapView') as $task) {
			$this->{$task}->connection = $this->connection;
			$this->{$task}->interactive = false;
		}

		if (!empty($this->args[0])) {
			$name = $this->args[0];
		}

		$modelExists = false;
		$model = $this->_modelName($name);

		App::uses('AppModel', 'Model');
		App::uses($model, 'Model');
		if (class_exists($model)) {
			$object = new $model();
			$modelExists = true;
		} else {
			$object = new Model(array('name' => $name, 'ds' => $this->connection));
		}

		$modelBaked = $this->Model->bake($object, false);

		if ($modelBaked && $modelExists === false) {
			if ($this->_checkUnitTest()) {
				$this->Model->bakeFixture($model);
				$this->Model->bakeTest($model);
			}
			$modelExists = true;
		}

		if ($modelExists === true) {
			$controller = $this->_controllerName($name);
			if ($this->Controller->bake($controller, $this->Controller->bakeActions($controller, 'admin_'))) {
				if ($this->_checkUnitTest()) {
					$this->Controller->bakeTest($controller);
				}
			}
			App::uses($controller . 'Controller', 'Controller');
			if (class_exists($controller . 'Controller')) {
				$this->BootstrapView->args = array($name);
				$this->BootstrapView->execute();
			}
			$this->out('', 1, Shell::QUIET);
			$this->out(__d('cake_console', '<success>Bake All complete</success>'), 1, Shell::QUIET);
			array_shift($this->args);
		} else {
			$this->error(__d('cake_console', 'Bake All could not continue without a valid model'));
		}
		return $this->_stop();
	}

}
