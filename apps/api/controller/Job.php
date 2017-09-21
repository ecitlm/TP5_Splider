<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 22:54
 */

namespace app\api\controller;
class Job{
    public function index(){
        $pageNo = (isset($_GET['pageNo'])) ? intval($_GET ['pageNo']) : 1;
        $type= (isset($_GET['type'])) ? $_GET ['pageNo'] : "web";
        $url = "https://m.lagou.com/search.json?city=%E6%B7%B1%E5%9C%B3&positionName={$type}&pageNo={$pageNo}&pageSize=3";
        $res = HttpGet($url);
        return json([
            'msg' => 'success',
            'code' => 1,
            'domain'=>'https://static.lagou.com',
            'data' => json_decode($res, true)['content']['data']
        ]);
    }
}