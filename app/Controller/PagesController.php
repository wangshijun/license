<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html', 'Session');

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Allow all users to view pages
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('display'));
	}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = __(Inflector::humanize($path[$count - 1]));
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		if ($page === 'home') {
			// $this->set('links', $this->_get_links());
			// $this->set('downloads', $this->_get_downloads());
			$this->set('widgets', $this->_get_widgets());
		} else {
			$miscs = Configure::read('misc');
			if (!isset($miscs[$page])) {
				throw new NotFoundException(__('Invalid misc post'));
			}

			$this->loadModel('MiscPost');
			$post = $this->MiscPost->getPost($miscs[$page]['title']);

			$this->set('post', $post);
		}

		$this->render(implode('/', $path));
	}

	/**
	 * 获取友情链接列表
	 *
	 * @deprecated
	 */
	protected function _get_links() {
		if ($this->isMobile) {
			return false;
		}

		$links = Cache::read('links', 'long');
		if ($links === false) {
			$this->loadModel('Link');
			$links = $this->Link->find('all', array(
				'conditions' => array('Link.active' => 1),
				'limit' => 10,
			));
			Cache::write('links', $links, 'long');
		}

		return $links;
	}

	/**
	 * 获取首页的小部件配置,及其中的内容
	 * @return array
	 */
	protected function _get_widgets() {
		$cache_key = $this->request->is('mobile') ? 'widgets_mobile' : 'widgets';
		$widgets = Cache::read($cache_key, 'short');

		if ($widgets === false) {
			$this->loadModel('Widget');
			$this->loadModel('Article');
			$raw_widgets = $this->Widget->getAll();

			$widgets = array();
			foreach ($raw_widgets as $key => $widget) {
				if (!isset($widgets[$widget['Widget']['row']])) {
					$widgets[$widget['Widget']['row']] = array();
				}
				$widget['Widget']['class'] = 'span' . $widget['Widget']['size'];
				$widget['Widget']['articles'] = $this->Article->getList($widget['Widget']['category_id']);
				$widgets[$widget['Widget']['row']][] = $widget;
			}

			Cache::write($cache_key, $widgets, 'short');
		}
		return $widgets;
	}

	/**
	 * 获取文件下载列表
	 */
	protected function _get_downloads() {
		if ($this->isMobile) {
			return false;
		}

		$downloads = Cache::read('downloads', 'short');
		if ($downloads === false) {
			$this->loadModel('Download');
			$downloads = $this->Download->find('all', array(
				'order' => array(
					'Download.publish_date' => 'DESC',
					'Download.id' => 'DESC',
				),
				'limit' => 10,
			));
			Cache::write('downloads', $downloads, 'short');
		}

		return $downloads;
	}
}
