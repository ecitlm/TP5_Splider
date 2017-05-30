<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录

include '../SocketLog.class.php';
slog(array(
    'host'=>'localhost',//websocket服务器地址，默认localhost
    'optimize'=>true,//是否显示利于优化的参数，如果运行时间，消耗内存等，默认为false
    'show_included_files'=>false,//是否显示本次程序运行加载了哪些文件，默认为false
    'error_handler'=>true,//是否接管程序错误，将程序错误显示在console中，默认为false
    'force_client_id'=>'',//日志强制记录到配置的client_id,默认为空
    'allow_client_ids'=>array()//限制允许读取日志的client_id，默认为空,表示所有人都可以获得日志。
),'set_config');


define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
