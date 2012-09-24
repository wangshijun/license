<?php
/**
 * MiscPosts Controller, 其他页面, 继承超类Post
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	MiscPosts
 * @todo 初始化Post的时候是否需要支持单篇文案的初始化
 */

App::uses('AppController', 'Controller');

class MiscPostsController extends AppController {

	public $helpers = array('CKEditor');

	public function hasOwnMethod($method) {
		return in_array($method, array('admin_edit', 'admin_index'));
	}

	/**
	 * 文案页面列表
	 *
	 * @access public
	 * @return void
	 * @menu true
	 */
	public function admin_index() {
		$this->set('miscs', Configure::read('misc'));
	}

	/**
	 * 编辑某个页面的文案
	 *
	 * @access public
	 * @return void
	 */
	public function admin_edit($name) {
		$miscs = Configure::read('misc');
		if (!isset($miscs[$name])) {
			throw new NotFoundException(__('Invalid misc post'));
		}

		$post = $this->MiscPost->getPost($miscs[$name]['title']);

		if (empty($post)) {
			$this->_init_posts($miscs);
			$post = $this->MiscPost->getPost($miscs[$name]['title']);
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MiscPost->save($this->request->data, false)) {
				$this->Session->setFlash(__('The content has been saved'), 'success');
				$post = $this->MiscPost->getPost($miscs[$name]['title']);
				Cache::delete('articles', 'short');
				Cache::delete('articles_mobile', 'short');
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $post;
		}

		$this->set('post', $post);
	}

	protected function _init_posts($miscs) {
		foreach ($miscs as $key=>$post) {
			$this->MiscPost->create();
			$this->MiscPost->save($post);
		}
	}
}
