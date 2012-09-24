<?php
/**
 * Category Model, 类目体系的超类
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	Blog
 * @subpackage	Category
 */

App::uses('AppModel', 'Model');

class Category extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys,
	// those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Tenant' => array(
			'className' => 'Tenant',
			'foreignKey' => 'tenant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'ChildCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

	// Search.Searchable Settings
	public $filterArgs = array(
		array('name' => 'name', 'type' => 'like'),
		array('name' => 'tenant_id', 'type' => 'value', 'ignored' => 0),
	);

	public $actsAs = array(
		'Utils.Sluggable' => array(
			'label' => 'name',
			'slug' => 'alias',
			'update' => true,
		),
		'Tree',
	);

	/**
	 * 获取父级栏目列表, 有缩进的, 更加直观
	 * 注意这里添加Select Parent的提示时不能使用array_unshift, 不然键会丢失
	 *
	 * @link http://stackoverflow.com/questions/2772417/add-a-element-to-a-php-associative-array
	 * @link http://php.net/manual/en/function.array-unshift.php
	 *
	 * @param $select 是否是要构造下拉列表
	 * @access public
	 * @return array
	 */
	public function getParents($select = true) {
		$this->recover('parent', 'delete');
		$categories = $this->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;');
		return $categories;
	}

	/**
	 * 获取嵌套的类目层级表
	 *
	 * @param $unify 是否使用同一的键
	 * @access public
	 * @return array
	 */
	public function getThreaded($unify = false) {
		/*
		$cacheKey = $this->alias . ($unify ? '_threaded' : '_unified_theaded');
		$categories = Cache::read($cacheKey, 'short');

		if ($categories === false) {
		*/
			$categories = $this->find('threaded', array(
				'order' => array($this->alias . '.lft' => 'ASC'),
			));

			if ($unify && !empty($categories)) {
				$categories = $this->getUnifiedCategories($categories, is_string($unify) ? $unify : 'Category');
			}

		/*
			Cache::write($cacheKey, $categories, 'short');
		}
		*/

		return $categories;
	}

	public function read($fields = null, $id = null, $unify = true) {
		$category = parent::read($fields, $id);
		if (!empty($category) && $unify) {
			$category[is_string($unify) ? $unify : 'Category'] = $category[$this->alias];
		}
		return $category;
	}

	protected function getUnifiedCategories($categories, $unify) {
		foreach ($categories as &$category) {
			$category[$unify] = $category[$this->alias];
			if (!empty($category['children'])) {
				$category['children'] = $this->getUnifiedCategories($category['children'], $unify);
			}
		}
		return $categories;
	}

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['parent_id'])
			&& empty($this->data[$this->alias]['parent_id'])
		) {
			$this->data[$this->alias]['parent_id'] = null;
		}

		return true;
	}

}
