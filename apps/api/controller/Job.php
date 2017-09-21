<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 22:54
 */

namespace app\api\controller;
include('QueryList.php');
class Job{
    public function index(){
        $pageNo = (isset($_GET['pageNo'])) ? intval($_GET ['pageNo']) : 1;
        $url = "https://m.lagou.com/search.json?city=%E6%B7%B1%E5%9C%B3&positionName=web&pageNo={$pageNo}&pageSize=15";
        $res = HttpGet($url);
        return json([
            'msg' => 'success',
            'code' => 1,
            'domain'=>'https://static.lagou.com',
            'data' => json_decode($res, true)['content']['data']
        ]);
    }

    public  function  dedtail(){
        $positionId = (isset($_GET['positionId'])) ? $_GET ['positionId'] : "2662779";
        $url="https://m.lagou.com/jobs/{$positionId}.html";
        $res = HttpGet($url);
        \phpQuery::newDocumentHTML($res);
        $result=array(
            'title'=>pq('.title')->text(),
            "content"=>pq('.content')->html(),
            'salary'=>pq('.salary')->find('.text')->html(),
            'workyear'=>pq('.workyear')->find('.text')->text(),
            'workaddress'=> pq('.workaddress')->find('.text')->text(),
            'education'=> pq('.education')->find('.text')->text(),
            'temptation'=> pq('.temptation')->text(),
        );
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $result
        ]);
    }
}