<?php
/*
* @Author: ecitlm
* @Date:   2017-05-29 19:31:05
* @Last Modified by:   ecitlm
* @Last Modified time: 2017-05-30 18:04:42
*/
namespace app\index\controller;
use think\Loader;
class News
{
    const CM163 = 'http://c.m.163.com/nc/article';
    public function index()
    {
        return json([
            'msg' => '你好 IT开发者'
        ]);
    }


    /**
     * 新闻banner
     */
    public function banner()
    {
        $res = HttpGet(self::CM163."/headline/list/0-10.html?from=toutiao&passport=&devId");
        $arr = json_decode($res, true);
        return json($arr);
    }


    /**
     *
     * 新闻分类
     */
    public function new_list()
    {

        $type = (isset($_GET['type'])) ? intval($_GET ['type']) : 0;
        $page = (isset($_GET['page'])) ? intval($_GET ['page']) : 10;

        $data = [
            'page' => $page,
            'type' =>$type,
        ];
        $validate = Loader::validate('News');
        if(!$validate->check($data)){
            return json([
                'msg'=>$validate->getError(),
                'code' => 0,
            ]);
        }

        $news_type = \think\Config::get("news")['news_type'][$type];
        if (empty($news_type)) {
            return json([
                'msg' => '请填写正确的请求参数',
                'code' => 0
            ]);
        }
        $url = self::CM163."/headline/" . $news_type . "/" . $page . "-10.html";
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
    public function new_detail($postid = "CLJMJRRL000181KT")
    {

        $id = (isset($_GET['postid'])) ? $_GET ['postid'] : "CLJMJRRL000181KT";
        $url = self::CM163."/" . $id . "/full.html";
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
    public function local_news()
    {

        $name = (isset($_GET['name'])) ? $_GET ['name'] : $this->get_address();
        $page = (isset($_GET['page'])) ? intval($_GET ['page']) : 0;
        if (empty($name)) {
            return json([
                'msg' => '请填写正确的请求参数',
                'code' => 0
            ]);
        }

        $url = "http://3g.163.com/touch/jsonp/article/local/" . urlencode($name) . "/".$page."-10.html";
        $res = HttpGet($url);
        $arr = json_decode(substr($res, 9, -1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$name]
        ]);
    }







    public function get_address(){
        $getIp = getRemoteIPAddress();

        $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=enYCQ2yaIIjL8IZfYdA1gi6hK2eqqI2T&ip={$getIp}&coor=bd09ll");
        $json = json_decode($content, true);
        $place=$json['content']['address_detail']['province']."_".$json['content']['address_detail']['city'];

        return $place;

    }

}
