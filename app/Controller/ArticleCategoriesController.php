<?php
/**
 * ArticleCategories Controller, 新闻栏目
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Categories
 */

App::uses('CategoriesController', 'Controller');

class ArticleCategoriesController extends CategoriesController {
	protected $actAsWidget = true;
}
