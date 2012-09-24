<?php
/**
 * 系统功能包扫描仪
 *
 * Copyright (c) 2011 tomato
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * PHP version 5
 *
 * @author	 tomato <wangshijun2010@gmail.com>
 * @copyright	(c) 2011 tomato <wangshijun2010@gmail.com>
 * @license	http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package	default
 * @subpackage	default
 * @todo 能够扫描插件中的Controller并构建其菜单项
 */

Cache::config(PackageScanner::$cacheConfig, array(
	'engine' => 'File',
	'duration' => PackageScanner::$cacheDuration,
	'prefix' => PackageScanner::$cachePrefix,
));

/**
 * 从Controller中抽取菜单项目, 并组织成比较好的层次结构
 * 目前比较有用的comment tag
 *		- @package				在Controller注释中说明属于哪个package, 多个Controller可能属于1个Package
 *		- @subpackage			在Controller注释中说明属于哪个subpackage, 每个Controller都是1个单独的SubPackage
 *		- @menu					在Action注释中说明是否是菜单项
 *		- @ignore				在Controller注释中说明是否该忽略该Controller的菜单
 */
class PackageScanner {

	/**
	 * 缓存配置, 可在外部修改
	 */
	public static $cacheKey = 'items';
	public static $cachePrefix = 'lib.package.';
	public static $cacheDuration = '+30 day';
	public static $cacheConfig = 'Lib.PackageScanner';

	/**
	 * ACO 路径构造时的参数
	 */
	private static $acoSeparator = '/';
	private static $acoRoot = 'controllers';

	/**
	 * 是否已经设置了缓存
	 * @var bool
	 */
	private static $configured = false;

	/**
	 * 在AppController中出现, 但是只能内部调用的方法
	 * @var array
	 */
	private static $blackList = array('log');

	/**
	 * 白名单,这些方法是在AppController中定义, 部分子类中会继承的方法
	 * @var array
	 */
	private static $whiteList = array(
		'admin_search', 'search',
		'admin_recycle_bin', 'recycle_bin',
		'admin_recycle', 'recycle',
		'admin_drop', 'drop',
	);

	/**
	 * 读取系统功能包层级菜单
	 * @return array
	 */
	public static function read() {
		if (self::$configured === false) {
			self::config();
		}
		if (($packages = Cache::read(self::$cacheKey, self::$cacheConfig)) !== false) {
			return $packages;
		}
		return self::scan();
	}

	/**
	 * 从Controllers源代码中抽取可以用户构建ACO列表的节点
	 * @return array
	 */
	public static function scan() {
		if (self::$configured === false) {
			self::config();
		}

		// 首先获取Controller类的方法, 构造黑名单
		$reflection = new ReflectionClass('Controller');
		$methods = $reflection->getMethods();
		$exceptions = array();
		foreach ($methods as $method) {
			$exceptions[] = $method->name;
		}

		$exceptions = array_merge($exceptions, self::$blackList);

		$packages = $translations = array();
		$routePrefix = self::getRoutePrefix();

		//debug(self::$whiteList);

		// 扫描所有的AbcController文件, 逐个加载并解析其共有非静态方法
		$Controllers = App::objects('Controller');
		foreach ($Controllers as $Controller) {
			if (in_array($Controller, array('AppController', 'PagesController')) !== false) {
				continue;
			}

			App::uses($Controller, 'Controller');

			$reflection = new ReflectionClass($Controller);

			// 有些功能需要隐藏的话就在类注释中加上@ignore true标签即可
			$ignore = self::getDocComment($reflection->getDocComment(), 'ignore');

			// 获取package, subpackage名称
			$pkg = self::getDocComment($reflection->getDocComment(), 'package');
			$subpkg = self::getDocComment($reflection->getDocComment(), 'subpackage');

			if (!isset($packages[$pkg])) {
				$packages[$pkg] = array();
				$packages[$pkg]['children'] = array();
				$packages[$pkg]['title'] = Inflector::humanize($pkg);
				$packages[$pkg]['id'] = Inflector::underscore($pkg);
				$packages[$pkg]['url'] = false;
			}

			$classname = str_replace('Controller', '', $Controller);								// UserProfiles
			$tableized = Inflector::tableize(Inflector::variable($classname));				// user_profiles
			$humanized = Inflector::humanize(Inflector::underscore($tableized));		// User Profiles

			$subpackage = array();

			$subpackage['children'] = array();
			$subpackage['title'] = $humanized;
			$subpackage['id'] = $tableized;
			$subpackage['url'] = false;
			$subpackage['aco'] = self::$acoRoot . self::$acoSeparator . $classname;
			$subpackage['alias'] = $classname;
			$subpackage['menu'] = ($ignore != 'true');

			$translations[] = trim($humanized);
			if (in_array($pkg, $translations) === false) {
				$translations[] = $pkg;
			}

			$actions = array();
			$methods = $reflection->getMethods();

			$defaultProperties = $reflection->getDefaultProperties();
			$isBareController = ($defaultProperties['uses'] === false);

			// AbcController中可以定义hasOwnMethod表名是否具有某个方法
			// 以此来跳过某些父类继承而来的方法(不构造对应的菜单)
			if ($reflection->hasMethod('hasOwnMethod')) {
				$filterMethod = $reflection->getMethod('hasOwnMethod');
				array_push($exceptions, 'hasOwnMethod');
			} else {
				$filterMethod = null;
			}

			// 抽取Controller的Action(非继承,共有,非静态,非忽略)
			foreach ($methods as $method) {
				$menu = (self::getDocComment($method->getDocComment(), 'menu') == 'true');
				if ((in_array($method->name, $exceptions) === false)
					&& ($method->isPublic() === true)
					&& ($method->isStatic() === false)
					&& (($filterMethod === null) || $filterMethod->invoke($reflection->newInstance(), $method->name))
				) {
					if ($isBareController && in_array($method->name, self::$whiteList)) {
						//debug('ignore method: ' . $method->name);
						continue;
					}

					$action = Inflector::underscore($method->name);

					$beautified = str_replace($routePrefix, '', $action);
					if (stripos($beautified, 'index') !== false) {
						$beautified = 'list';
					} else {
						$humanized = Inflector::singularize($humanized);
					}

					$id = self::getMenuId($tableized, $action);
					$alias = $method->name;
					$title = Inflector::humanize($beautified) . ' ' . $humanized;
					$aco = self::$acoRoot . self::$acoSeparator . $classname . self::$acoSeparator . $method->name;
					$url = array('controller' => $tableized, 'action' => $action);
					$url[$routePrefix] = (strpos($action, $routePrefix . '_') !== false);

					$subpackage['children'][] = compact('id', 'title', 'url', 'aco', 'alias', 'menu');

					$translations[] = trim($title);
					$actions[] = $action;
				}
			}

			// 构造Controller级别的菜单URI
			$url = false;
			$action = in_array($routePrefix . '_index', $actions) ? $routePrefix . '_index' : 'index';
			if ((in_array($action, $actions) !== false)) {
				$url = array('controller' => $tableized, 'action' => $action);
				$url[$routePrefix] = (strpos($action, $routePrefix . '_') !== false);
			}
			$subpackage['url'] = $url;

			$packages[$pkg]['children'][] = $subpackage;

		}

		self::write($packages, $translations);

		return $packages;
	}

	/**
	 * 配置扫描结果的缓存设置
	 */
	protected static function config() {
		Cache::config(self::$cacheConfig, array(
			'engine' => 'File',
			'duration' => self::$cacheDuration,
			'prefix' => self::$cachePrefix,
		));
		self::$configured = true;
	}

	/**
	 * 把扫描到的功能包数据写入缓存
	 * @param  array $packages     功能包层级数组
	 * @param  array $translations 需要翻译的菜单条目
	 * @return void
	 */
	protected static function write($packages, $translations) {
		Cache::write(self::$cacheKey, $packages, self::$cacheConfig);

		$filename = APP . 'Locale' . DS . 'packages.php';
		$translations = array_map('self::translate', $translations);
		$content = sprintf("<?php\n%s", implode(PHP_EOL, $translations));
		file_put_contents($filename, $content);
	}

	/**
	 * 菜单条目翻译的预处理
	 * @return string
	 */
	protected static function translate($title) {
		return  '__("' . trim($title) . '");';
	}

	/**
	 * 从class或者method的comment当中提取指定tag的注释内容
	 *
	 * @param string $comment 需要从中抽取标签的注释内容
	 * @param string $tag 标签名称, 默认是menu
	 * @return string
	 */
	protected static function getDocComment($comment, $tag = 'menu') {
		if (empty($tag)) {
			return $comment;
		}

		$matches = array();
		preg_match('/@' . $tag . '\s+(.*)(\\r\\n|\\r|\\n)/U', $comment, $matches);

		if (isset($matches[1])) {
			return trim($matches[1]);
		}

		return '';
	}

	/**
	 * 拼接菜单项的ID, 小写下划线的格式
	 * @return string
	 */
	protected static function getMenuId() {
		return implode('_', func_get_args());
	}

	/**
	 * 路由前缀的特殊处理, 比如
	 * @return string
	 */
	protected static function getRoutePrefix() {
		$prefixes = Configure::read('Routing.prefixes');
		if (is_array($prefixes) && !empty($prefixes)) {
			return array_shift($prefixes);
		} elseif ($prefixes) {
			return $prefixes;
		}
		return false;
	}
}
