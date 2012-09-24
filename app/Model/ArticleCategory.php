<?php
/**
 * ArticleCategory Model, 新闻栏目, 与类目单表继承
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Category
 */

App::uses('Category', 'Model');

class ArticleCategory extends Category {

	public $actsAs = array(
		'Utils.Inheritable',
		'Tree' => array(
			'scope' => array('ArticleCategory.type' => 'ArticleCategory'),
		),
	);

	public $useTable = 'categories';

	public $alias = 'ArticleCategory';

}
