<?php

//	 用户头像所需不同大小的图片尺寸
$large = array('convert' => 'image/png', 'fit' => array(200, 200));
$small = array('convert' => 'image/png', 'fit' => array(100, 100));
$tiny = array('convert' => 'image/png', 'fit' => array(60, 60));

Configure::write('Media.filter', array(
	'audio' => array(),
	'document' => array(),
	'generic' => array(),
	'image' => compact('large', 'small', 'tiny'),
	'video' => array(),
));
