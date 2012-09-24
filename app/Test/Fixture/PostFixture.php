<?php
/**
 * PostFixture
 *
 */
class PostFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
		'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
		'author_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '作者ID'),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '栏目ID'),
		'published' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否发布(1表示已发布,0表示未发布)'),
		'click_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '下载量'),
		'comment_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '评论数量'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '新闻标题', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '新闻内容', 'charset' => 'utf8'),
		'images' => array('type' => 'string', 'null' => false, 'length' => 1024, 'collate' => 'utf8_general_ci', 'comment' => '新闻图片地址', 'charset' => 'utf8'),
		'publish_date' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '新闻发生时间, 默认和创建时间相同, 但是可以另行修改'),
		'cover' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '封面图片地址', 'charset' => 'utf8'),
		'gmt_published' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '发布时间'),
		'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
		'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
		'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0), 'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'author_id', 'id'), 'unique' => 0)),
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
			'author_id' => 1,
			'category_id' => 1,
			'published' => 1,
			'click_count' => 1,
			'comment_count' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'images' => 'Lorem ipsum dolor sit amet',
			'publish_date' => 1334391619,
			'cover' => 'Lorem ipsum dolor sit amet',
			'gmt_published' => 1334391619,
			'gmt_created' => 1334391619,
			'gmt_deleted' => 1334391619,
			'gmt_modified' => 1334391619
		),
	);
}
