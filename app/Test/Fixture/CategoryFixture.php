<?php
/**
 * CategoryFixture
 *
 */
class CategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
		'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'comment' => '父级类目ID'),
		'lft' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => '左边界'),
		'rght' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => '右边界'),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '与之关联的MODEL', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'comment' => '与之关联的记录ID'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '类目名称', 'charset' => 'utf8'),
		'alias' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '类目别名', 'charset' => 'utf8'),
		'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
		'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
		'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0), 'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'parent_id', 'id'), 'unique' => 0), 'idx_tenant_name_id' => array('column' => array('tenant_id', 'name', 'id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'tenant_id' => 1,
			'deleted' => 1,
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'model' => 'Lorem ipsum dolor sit amet',
			'foreign_key' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'alias' => 'Lorem ipsum dolor sit amet',
			'gmt_created' => 1334236008,
			'gmt_deleted' => 1334236008,
			'gmt_modified' => 1334236008
		),
	);
}
