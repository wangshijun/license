<?php

//	 房间所需的不同大小的图片
$thumb = array('convert' => 'image/png', 'fit' => array(64, 48));
$listview = array('convert' => 'image/png', 'fitCrop' => array(128, 96));
$gridview = array('convert' => 'image/png', 'fitCrop' => array(192, 144));
$featured = array('convert' => 'image/png', 'fitCrop' => array(384, 288));
$detail = array('convert' => 'image/png', 'zoomFit' => array(640, 480));

Configure::write('Media.filter', array(
	'audio' => array(),
	'document' => array(),
	'generic' => array(),
	'image' => compact('thumb', 'gridview', 'listview', 'detail', 'featured'),
	'video' => array(),
));
