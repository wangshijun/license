<?php
/**
 * ConfigFixture
 *
 */
class ConfigFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
		'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
		'category' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '设置类别', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '设置的键', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'collate' => 'utf8_general_ci', 'comment' => '设置的值', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'collate' => 'utf8_general_ci', 'comment' => '设置文本描述', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '设置的输入类型', 'charset' => 'utf8'),
		'options' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'collate' => 'utf8_general_ci', 'comment' => '设置的可选项,对于select类型可设置', 'charset' => 'utf8'),
		'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
		'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
		'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0), 'idx_tenant_category_id' => array('column' => array('tenant_id', 'category', 'id'), 'unique' => 0)),
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
			'category' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'options' => 'Lorem ipsum dolor sit amet',
			'gmt_created' => 1333531857,
			'gmt_deleted' => 1333531857,
			'gmt_modified' => 1333531857
		),
	);
}
