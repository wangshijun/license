<?php
/**
 * BuildingResidentFixture
 *
 */
class BuildingResidentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => '主键ID'),
		'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => '租户ID'),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
		'building_room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '房间ID'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '姓名', 'charset' => 'utf8'),
		'gender' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => '性别(1表示男性,0表示女性)'),
		'id_card_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '身份证号码', 'charset' => 'utf8'),
		'origin' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '籍贯', 'charset' => 'utf8'),
		'height' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '身高'),
		'ethnic_group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '民族'),
		'religion' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '宗教信仰', 'charset' => 'utf8'),
		'family_status' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '与户主关系(0户主,1子女,2配偶,3父母,4其他)'),
		'marriage_status' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '婚姻状况', 'charset' => 'utf8'),
		'political_status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '政治面貌(0群众,1团员,2党员,3民主党派,4其他)'),
		'is_owner' => array('type' => 'integer', 'null' => false, 'default' => '1', 'comment' => '居住状态(1表示自住,0表示租住)'),
		'mobile' => array('type' => 'string', 'null' => false, 'length' => 11, 'collate' => 'utf8_general_ci', 'comment' => '电话', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'length' => 11, 'collate' => 'utf8_general_ci', 'comment' => '邮箱', 'charset' => 'utf8'),
		'company' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '工作单位', 'charset' => 'utf8'),
		'specialty' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '特长', 'charset' => 'utf8'),
		'live_date' => array('type' => 'string', 'null' => false, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '居住起始日期', 'charset' => 'utf8'),
		'live_reason' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '暂住事由', 'charset' => 'utf8'),
		'memo' => array('type' => 'string', 'null' => false, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => '备注', 'charset' => 'utf8'),
		'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
		'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
		'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
			'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'id'), 'unique' => 0),
			'idx_tenant_building_room_id' => array('column' => array('tenant_id', 'building_room_id', 'id'), 'unique' => 0)
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
			'building_room_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'gender' => 1,
			'id_card_number' => 'Lorem ipsum dolor sit amet',
			'origin' => 'Lorem ipsum dolor sit amet',
			'height' => 1,
			'ethnic_group_id' => 1,
			'religion' => 'Lorem ipsum dolor sit amet',
			'family_status' => 1,
			'marriage_status' => 'Lorem ipsum dolor sit amet',
			'political_status' => 1,
			'is_owner' => 1,
			'mobile' => 'Lorem ips',
			'email' => 'Lorem ips',
			'company' => 'Lorem ipsum dolor sit amet',
			'specialty' => 'Lorem ipsum dolor sit amet',
			'live_date' => 'Lorem ipsum dolor sit amet',
			'live_reason' => 'Lorem ipsum dolor sit amet',
			'memo' => 'Lorem ipsum dolor sit amet',
			'gmt_created' => 1347978909,
			'gmt_deleted' => 1347978909,
			'gmt_modified' => 1347978909
		),
	);
}
