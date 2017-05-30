<?php
namespace app\index\controller;

use think\slog;

class News
{
    public function index()
    {
       return json([
           'msg'=>'你好 IT开发者'
       ]);
    }


    /**
     * 新闻banner
     */
    public function banner()
    {
        $res = HttpGet("http://c.m.163.com/nc/article/headline/list/0-10.html?from=toutiao&passport=&devId");
        $arr = json_decode($res, true);
        return  json($arr);
    }


    /**
     * @param int $type
     * @param int $page
     * @return \think\response\Json
     * @throws \Exception
     */
    public function new_list($type=0,$page=10)
    {

        $type = (isset($_GET['type'])) ? intval($_GET ['type']) : 0;
        $page = (isset($_GET['page'])) ? intval($_GET ['page']) : 10;

        $news_type=\think\Config::get("news")['news_type'][$type];
        slog($news_type);

        if (empty($news_type)) {

            return json([
                'msg' => '请填写正确的请求参数',
                'code' => 0

            ]);
        }
        $url = "http://c.m.163.com/nc/article/headline/" . $news_type . "/" . $page . "-10.html";

        $res = HttpGet($url);
        $arr = json_decode($res, true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$news_type]
        ]);
    }


    /**
     * 新闻详情
     * @param string $postid
     * @return \think\response\Json
     */
    public function new_detail($postid="CLJMJRRL000181KT"){

        $id =(isset($_GET['postid'])) ? $_GET ['postid'] : "CLJMJRRL000181KT";
        $url="http://c.m.163.com/nc/article/".$id."/full.html";
        $res = HttpGet($url);
        $arr = json_decode($res, true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$id]
        ]);
    }


    /**
     * 本地新闻
     * @param string $name
     * @return \think\response\Json
     */
    public function local_news($name="广东省_广州市"){

        $name =(isset($_GET['name'])) ? $_GET ['name'] : "广东省_广州市";
        if(empty($name)){
            return json([
                'msg' => '请填写正确的请求参数',
                'code' => 0
            ]);
        }

        $url = "http://3g.163.com/touch/jsonp/article/local/".urlencode($name)."/0-10.html";
        $res = HttpGet($url);
        $arr = json_decode(substr($res,9,-1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr
        ]);
    }
}
