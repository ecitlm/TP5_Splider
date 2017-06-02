<?php

// 应用公共文件

/**
 * 获取用户ip
 * @return array|false|string
 */
 function getRemoteIPAddress() {
    global $ip;
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
}

/**
 * banner api地址
 * @return string
 */
function banner_url(){
    $url="http://c.m.163.com/nc/article/headline/list/0-10.html?from=toutiao&passport=&devId";
    return $url;
}

/**
 * 新闻列表url
 * @param $news_type
 * @param $page
 * @return string
 */
function new_list_url($news_type,$page){
    $url="http://c.m.163.com/nc/article/headline/{$news_type}/{$page}-10.html";
    return $url;
}

/**
 * 新闻详情
 * @param $id
 * @return string
 */
function new_detail_url($id){
    $url="http://c.m.163.com/nc/article/{$id}/full.html";
    return $url;

}

/**
 * 当地新闻列表
 * @param $name
 * @param $page
 * @return string
 */
 function local_news_url($name,$page){
    $url="http://3g.163.com/touch/jsonp/article/local/" . urlencode($name) . "/".$page."-10.html";
    return $url;
}

