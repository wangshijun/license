<?php
/**
 * Articles Controller, 普通新闻, 继承超类Post
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Articles
 */

App::uses('PostsController', 'Controller');

class ArticlesController extends PostsController {
	protected $hasCover = false;
}
