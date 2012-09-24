<?php
/**
 * User Model
 *
 * @property Tenant $Tenant
 * @property Group $Group
 * @property Download $Download
 * @property Log $Log
 * @property Post $Post
 */

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tenant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
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
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mobile' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
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
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'user_id',
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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
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

	public $hasOne = array(
		'UserProfile' => array(
			'className' => 'UserProfile',
			'foreignKey' => 'user_id',
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
		'Avatar' => array(
			'className' => 'Media.Attachment',
			'foreignKey' => 'foreign_key',
			'dependent' => true,
			'conditions' => array(
				'Avatar.model' => 'User',
				'Avatar.group' => 'avatar',
			),
			'order' => array('Avatar.id' => 'DESC'),
			'limit' => 1,
		),
	);

	public $actsAs = array(
		'Acl' => array('type' => 'requester'),
		'Utils.Toggleable' => array('fields' => array('active' => array(0, 1))),
		'Utils.Sluggable' => array(
			'label' => 'name',
			'slug' => 'slug',
			'update' => true,
		),
	);

	// Search.Searchable Settings
	public $filterArgs = array(
		array('name' => 'name', 'type' => 'like'),
		array('name' => 'tenant_id', 'type' => 'value', 'ignored' => 0),
	);

	/**
	 * encypt user passwor before save
	 */
	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

	/**
	 * Create an empty user profile when new user is added
	 * @param  bool $creted if the user is newly created
	 * @return void
	 */
	public function afterSave($created) {
		if ($created) {
			$user_id = $this->getLastInsertID();
			$tenant_id = $this->getTenantId($user_id);
			$this->UserProfile->create();
			$this->UserProfile->save(compact('user_id', 'tenant_id'));
		}
	}

	/**
	 * Read user data with profile
	 * @param  int $user_id user ID
	 * @return Object
	 */
	public function getProfile($user_id = null) {
		if (empty($user_id)) {
			$user_id = $this->id;
		}

		$user = $this->find('first', array(
			'conditions' => array('User.id' => $user_id),
			'contain' => array('UserProfile'),
		));

		if (empty($user['UserProfile']['id'])) {
			$tenant_id = $this->getTenantId($user_id);
			$this->UserProfile->create();
			$this->UserProfile->save(compact('user_id', 'tenant_id'));
			return $this->find('first', array(
				'conditions' => array('User.id' => $user_id),
				'contain' => array('UserProfile'),
			));
		}

		return $user;
	}

	private function getTenantID($user_id) {
		return $this->Group->field('tenant_id', $this->field('group_id', $user_id));
	}

	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}

		if (isset($this->data['User']['group_id'])) {
			$group_id = $this->data['User']['group_id'];
		} else {
			$group_id = $this->field('group_id');
		}

		if ($group_id) {
			return array('Group' => array('id' => $group_id));
		}

		return null;
	}

	public function getGroups() {
		$groups = $this->Group->find('list');
		$groups[0] = __('-Select Group-');
		asort($groups);
		return $groups;
	}

}
