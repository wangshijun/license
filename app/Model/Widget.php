<?php
/**
 * Widget Model
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	default
 * @subpackage	Widget
 */

App::uses('AppModel', 'Model');

class Widget extends AppModel {

	const MAX_COLUMN = 4;
	const MIN_COLUMN = 1;
	const MIN_SIZE = 3;
	const MAX_SIZE = 12;

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'system' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'visible' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'row' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'column' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'size' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Category' => array(
			'className' => 'ArticleCategory',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	// Search.Searchable Settings
	public $filterArgs = array(
		array('name' => 'name', 'type' => 'like'),
		array('name' => 'tenant_id', 'type' => 'value', 'ignored' => 0),
	);

	public $actsAs = array(
		'Utils.Toggleable' => array(
			'fields' => array('visible' => array(0, 1))
		),
	);

	public function afterSave($created) {
		self::deleteCache();
		return true;
	}

	public function afterDelete() {
		self::deleteCache();
		return true;
	}

	public function getColumns() {
		return range(self::MIN_COLUMN, self::MAX_COLUMN);
	}

	public function getSizes() {
		return range(self::MIN_SIZE, self::MAX_SIZE, self::MIN_SIZE);
	}

	public function getAll() {
		return $this->find('all', array(
			'conditions' => array(
				'Widget.visible' => true,
				'Widget.system' => false,
			),
			'contain' => array(),
			'order' => array(
				'Widget.row' => 'ASC',
				'Widget.column' => 'ASC',
			),
		));
	}

	public static function deleteCache() {
		Cache::delete('widgets', 'short');
		Cache::delete('widgets_mobile', 'short');
	}
}
