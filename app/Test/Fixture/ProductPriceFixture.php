<?php
/**
 * ProductPriceFixture
 *
 */
class ProductPriceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => '主键ID'),
		'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => '租户ID'),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '楼号ID'),
		'price' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '价格(元)'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '定价说明', 'charset' => 'utf8'),
		'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
		'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
		'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
			'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'id'), 'unique' => 0),
			'idx_tenant_product_id' => array('column' => array('tenant_id', 'product_id', 'id'), 'unique' => 0)
		),
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
			'product_id' => 1,
			'price' => 1,
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'gmt_created' => 1348626937,
			'gmt_deleted' => 1348626937,
			'gmt_modified' => 1348626937
		),
	);
}
