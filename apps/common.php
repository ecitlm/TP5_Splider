<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/*
 *
* @param unknown $url
*/
function HttpGet($url,$status=false){
    $curl = curl_init ();
    curl_setopt ( $curl, CURLOPT_URL, $url);
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $curl, CURLOPT_TIMEOUT,1000 );
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36');
    //curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4');
    if($status){
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept:application','X-Request:JSON','X-Requested-With:XMLHttpRequest'));
    }

    //如果用的协议是https则打开鞋面这个注释
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    $res = curl_exec ( $curl );
    curl_close ( $curl );
    return $res;
}





function Http_Spider($url) {
    $ch = curl_init();
    $ip = '115.239.211.112';  //百度蜘蛛
    $timeout = 15;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_TIMEOUT, $timeout);
    //伪造百度蜘蛛IP
    curl_setopt($ch,CURLOPT_HTTPHEADER,array('X-FORWARDED-FOR:'.$ip.'','CLIENT-IP:'.$ip.''));
    //伪造百度蜘蛛头部
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt ($ch, CURLOPT_REFERER, "http://www.baidu.com/");   //构造来路
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $content = curl_exec($ch);
    return $content;
}


/**
     * @param $url
     * @param $param
     * @return mixed
     * @HTTP curl方式请求接口
     */
   function HttpPost($url, $param)
    {

        $ch = curl_init();
       // curl_setopt($curl, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
       // curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');//这个是解释gzip内容.................
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //如果用的协议是https则打开鞋面这个注释
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }


//php脚本开始
    /*POST请求远程内容函数*/
    function ppost($url,$data){ // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址           
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_COOKIEFILE,$GLOBALS ['cookie_file']); // 读取上面所储存的Cookie信息
        curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称
     
        curl_setopt($curl, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
           echo 'Errno'.curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $tmpInfo; // 返回数据
    } 



error_reporting(E_ERROR | E_WARNING | E_PARSE);