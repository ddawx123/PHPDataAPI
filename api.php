<?php
/**
* 引入自定义数据处理类以减少本文件体积，详细说明请转到该文件源码查看其注释。
*/
require_once('./api_class.php');

/**
* 测试数据数组，用于测试API接口的数据输出能力
* 实际使用时可以通过向远程数据库或缓存拉取数据实时展现
* 本接口支持数据以json和xml形式输出
* 调用方法：api.php?format=xml ->使用XML输出 api.php?format=json -> 使用JSON输出
* Powered By DingStudio.Club(Tech) Copyright 2017 All Rights Reserved
* 
*/
$arr = array(
	'id' => 1,
	'name' => 'dingstudio',
	'numlist' => array(12,32,54,67,83,102),
	'textinfo' => '你好，世界！'
);

api_myinit($arr);//执行API数据输出，传递$arr数组中的内容到api_myinit方法。

function api_myinit($mydata) {//API数据输出模块
	$type = @$_GET['format'];
	if (!$type) {//未传递参数时的过程
		Response::errorHandler();
	}
	else if ($type == 'xml') {//XML数据输出
		Response::xmlEncode(200,'success',$mydata);
	}
	else if ($type == 'json') {//JSON数据输出
		Response::jsonEncode(200,'success',$mydata);
	}
	else {//非法参数错误处理
		Response::errorHandler();
	}
}
