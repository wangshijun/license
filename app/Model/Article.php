<?php
/**
 * Article Model, 普通新闻
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Article
 */

App::uses('Post', 'Model');

class Article extends Post {

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
		'Category' => array(
			'className' => 'ArticleCategory',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function afterSave($created) {
		App::uses('Widget', 'Model');
		Widget::deleteCache();
		return true;
	}

	public function afterDelete() {
		App::uses('Widget', 'Model');
		Widget::deleteCache();
		return true;
	}

	public function getList($category_id) {
		return $this->find('all', array(
			'fields' => array('id', 'title', 'publish_date'),
			'conditions' => array(
				'Article.category_id' => $category_id,
				'Article.published' => true,
			),
			'order' => array('Article.publish_date' => 'DESC'),
			'limit' => 10,
		));
	}

}
