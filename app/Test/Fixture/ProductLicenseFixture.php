<?php
/**
 * ProductLicenseFixture
 *
 */
class ProductLicenseFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => '主键ID'),
		'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => '租户ID'),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '产品ID'),
		'product_price_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '产品定价策略'),
		'customer_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '客户名称', 'charset' => 'utf8'),
		'customer_identifier' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '安装的机器信息', 'charset' => 'utf8'),
		'license_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '授权码', 'charset' => 'utf8'),
		'license_date' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '授权日期', 'charset' => 'utf8'),
		'license_blocked' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否黑名单'),
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
			'product_price_id' => 1,
			'customer_name' => 'Lorem ipsum dolor sit amet',
			'customer_identifier' => 'Lorem ipsum dolor sit amet',
			'license_key' => 'Lorem ipsum dolor sit amet',
			'license_date' => 'Lorem ipsum dolor sit amet',
			'license_blocked' => 1,
			'gmt_created' => 1348626885,
			'gmt_deleted' => 1348626885,
			'gmt_modified' => 1348626885
		),
	);
}
