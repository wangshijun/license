<?php
class Schema20120513 extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'acos' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'comment' => '主键ID'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'alias' => array('column' => array('alias', 'parent_id', 'id'), 'unique' => 0),
						'model' => array('column' => array('model', 'foreign_key', 'parent_id', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'aros' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'comment' => '主键ID'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'alias' => array('column' => array('alias', 'parent_id', 'id'), 'unique' => 0),
						'model' => array('column' => array('model', 'foreign_key', 'parent_id', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'aros_acos' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'comment' => '主键ID'),
					'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
					'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
					'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'categories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'comment' => '父级类目ID'),
					'lft' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => '左边界'),
					'rght' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => '右边界'),
					'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '与之关联的MODEL', 'charset' => 'utf8'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '类目名称', 'charset' => 'utf8'),
					'alias' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '类目别名', 'charset' => 'utf8'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'parent_id', 'id'), 'unique' => 0),
						'idx_tenant_name_id' => array('column' => array('tenant_id', 'name', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'configs' => array(
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
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_category_id' => array('column' => array('tenant_id', 'category', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'downloads' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'download_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '下载量'),
					'published' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否发布(1表示已发布,0表示未发布)'),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '文件标题', 'charset' => 'utf8'),
					'publish_date' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '发布时间, 默认和创建时间相同, 但是可以另行修改'),
					'gmt_published' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '发布时间'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'groups' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => '父级角色ID'),
					'lft' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => '左边界'),
					'rght' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => '右边界'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '角色名称', 'charset' => 'utf8'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'id'), 'unique' => 0),
						'idx_tenant_name_id' => array('column' => array('tenant_id', 'name', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'logs' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'comment' => '操作者ID'),
					'foreign_key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '日志所属记录ID', 'charset' => 'utf8'),
					'module' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '日志所属子版块,用Controller命名', 'charset' => 'utf8'),
					'type' => array('type' => 'string', 'null' => false, 'default' => 'info', 'length' => 16, 'collate' => 'utf8_general_ci', 'comment' => '日志类型', 'charset' => 'utf8'),
					'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '操作者用户名', 'charset' => 'utf8'),
					'content' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024, 'collate' => 'utf8_general_ci', 'comment' => '日志内容', 'charset' => 'utf8'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'tenant_module' => array('column' => array('tenant_id', 'module', 'id'), 'unique' => 0),
						'tenant_username' => array('column' => array('tenant_id', 'user_id', 'id'), 'unique' => 0),
						'tenant_module_foreign_key' => array('column' => array('tenant_id', 'module', 'foreign_key', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'posts' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'author_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '作者ID'),
					'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '栏目ID'),
					'published' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否发布(1表示已发布,0表示未发布)'),
					'click_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '下载量'),
					'comment_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '评论数量'),
					'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'comment' => '与之关联的MODEL', 'charset' => 'utf8'),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '文章标题', 'charset' => 'utf8'),
					'content' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '文章内容', 'charset' => 'utf8'),
					'images' => array('type' => 'string', 'null' => false, 'length' => 1024, 'collate' => 'utf8_general_ci', 'comment' => '文章图片地址', 'charset' => 'utf8'),
					'cover' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '封面图片地址', 'charset' => 'utf8'),
					'publish_date' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '文章发生时间, 默认和创建时间相同, 但是可以另行修改'),
					'gmt_published' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '发布时间'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'author_id', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'tenants' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'active' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '是否启用(1表示已启用,0表示未启用)'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '租户名称', 'charset' => 'utf8'),
					'domain' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '租户的域名', 'charset' => 'utf8'),
					'memo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'collate' => 'utf8_general_ci', 'comment' => '租户说明', 'charset' => 'utf8'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_name_id' => array('column' => array('name', 'id'), 'unique' => 0),
						'idx_deleted_id' => array('column' => array('deleted', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'comment' => '用户组ID'),
					'active' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '用户状态(1表示启用,0表示禁用)'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '用户名', 'charset' => 'utf8'),
					'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'comment' => '登录密码', 'charset' => 'utf8'),
					'mobile' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '手机号码', 'charset' => 'utf8'),
					'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '用户邮箱', 'charset' => 'utf8'),
					'ip_last_login' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '上次登录IP', 'charset' => 'utf8'),
					'ip_registered' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '注册IP', 'charset' => 'utf8'),
					'gmt_last_login' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '登录时间'),
					'gmt_registered' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '注册时间'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'id'), 'unique' => 0),
						'idx_tenant_active_id' => array('column' => array('tenant_id', 'active', 'id'), 'unique' => 0),
						'idx_tenant_group_id' => array('column' => array('tenant_id', 'group_id', 'name', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'widgets' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '主键ID'),
					'tenant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => '租户ID'),
					'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '所属的类目ID'),
					'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否删除(1表示已删除,0表示未删除)'),
					'system' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否系统默认模块'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '栏目名称', 'charset' => 'utf8'),
					'visible' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '是否显示咋首页(1表示是,0表示否)'),
					'row' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '显示在第几行'),
					'column' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '显示在第几列'),
					'size' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '显示为多大块, 依据Bootstrap中的span*'),
					'gmt_created' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间'),
					'gmt_deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '删除时间'),
					'gmt_modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'idx_tenant_id' => array('column' => array('tenant_id', 'id'), 'unique' => 0),
						'idx_tenant_deleted_id' => array('column' => array('tenant_id', 'deleted', 'category_id', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'acos', 'aros', 'aros_acos', 'categories', 'configs', 'downloads', 'groups', 'logs', 'posts', 'tenants', 'users', 'widgets'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
