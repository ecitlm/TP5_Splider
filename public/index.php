<?php

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
define('APP_PATH', __DIR__ . '/../apps/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
