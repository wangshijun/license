<?php
/* 注意这里的插件加载必须在DbLog配置前调用, 否则会出现错误 */
CakePlugin::loadAll(array(
	'Media' => array('bootstrap' => true),
));

/* 配置LogStream Writer */
App::uses('CakeLog', 'Log');

CakeLog::config('DbLog', array(
    'engine' => 'DbLog',
    'model' => 'Log',
));
