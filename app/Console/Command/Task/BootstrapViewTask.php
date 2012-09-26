<?php
/**
 * BootstrapViewTask, bake view
 *
 * PHP 5
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 1.2
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppShell', 'Console/Command');
App::uses('Controller', 'Controller');
App::uses('ViewTask', 'Console/Command/Task');

class BootstrapViewTask extends ViewTask {

	/**
	 * Tasks to be loaded by this Task
	 *
	 * @var array
	 */
	public $tasks = array('Project', 'Controller', 'DbConfig', 'Template');

	/**
	 * path to View directory
	 *
	 * @var array
	 */
	public $path = null;

	/**
	 * Name of the controller being used
	 *
	 * @var string
	 */
	public $controllerName = null;

	/**
	 * The template file to use
	 *
	 * @var string
	 */
	public $template = null;

	/**
	 * Actions to use for scaffolding
	 *
	 * @var array
	 */
	public $scaffoldActions = array('index', 'view', 'add', 'edit', 'recycle_bin');

	/**
	 * An array of action names that don't require templates.  These
	 * actions will not emit errors when doing bakeActions()
	 *
	 * @var array
	 */
	public $noTemplateActions = array('delete', 'recycle', 'drop', 'search');

}
