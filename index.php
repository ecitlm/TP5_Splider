<?php




//获取域名或主机地址
echo $_SERVER['HTTP_HOST']."<br />";
 
//获取网页地址
echo $_SERVER['PHP_SELF']."<br />";
 
//获取网址参数
echo $_SERVER["QUERY_STRING"]."<br />";
 
//获取用户代理
echo $_SERVER['HTTP_REFERER']."<br />";
 
//获取完整的url
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
 
//包含端口号的完整url
echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 
//只取路径
$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
echo dirname($url);

die();



header("Access-Control-Allow-Origin: *");
//入口文件绑定模块名
//define('BIND_MODULE','api');
define('APP_PATH', __DIR__ . '/apps/');
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';
