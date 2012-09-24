<?php
/**
 * MiscPost Model, 页头, 页尾, 联系我们, 关于我们等页面
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Article
 */

App::uses('Post', 'Model');

class MiscPost extends Post {

	public $actsAs = array('Utils.Inheritable');

	public $useTable = 'posts';

	public $belongsTo = array(
		'Tenant' => array(
			'className' => 'Tenant',
			'foreignKey' => 'tenant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	public function getPost($title) {
		return $this->find('first', array(
			'conditions' => array('title' => $title),
		));;
	}

}
