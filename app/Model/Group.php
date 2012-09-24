<?php
/**
 * Group Model
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @package	default
 * @subpackage	Group
 */

App::uses('Category', 'Model');

class Group extends Category {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'parent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'ParentGroup' => array(
			'className' => 'Group',
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
		'ChildGroup' => array(
			'className' => 'Group',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $actsAs = array(
		'Acl' => array('type' => 'requester'),
		'Tree',
	);

	// Search.Searchable Settings
	public $filterArgs = array(
		array('name' => 'name', 'type' => 'like'),
		array('name' => 'tenant_id', 'type' => 'value', 'ignored' => 0),
	);

	/**
	 * Group does not need Sluggable behavior
	 * @param int $id
	 * @param string  $table
	 * @param string  $ds
	 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->Behaviors->unload('Utils.Sluggable');
	}

	public function beforeSave($options = array()) {
		if (!$this->exists()) {
			if (empty($this->data['Group']['parent_id'])) {
				$this->data['Group']['parent_id'] = 0;
			}
		}
		return true;
	}

	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}

		if (isset($this->data['Group']['parent_id'])) {
			$parent_id = $this->data['Group']['parent_id'];
		} else {
			$parent_id = $this->field('parent_id');
		}

		if ($parent_id) {
			return array('Group' => array('id' => $parent_id));
		}

		return null;
	}

	/**
	 * 获取父级角色的缩进列表
	 */
	public function getParents($select = true) {
		$groups = $this->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;');

		if ($select === true) {
			$groups[0] = __('-Select Parent-');
			$groups = array_slice($groups, -1, 1, true) + array_slice($groups, 0, -1, true);
		}

		return $groups;
	}

}
