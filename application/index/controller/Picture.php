<?php
/*
* @Author: ecitlm
* @Date:   2017-05-29 19:31:05
* @Last Modified by:   ecitlm
* @Last Modified time: 2017-05-30 18:04:42
*/
namespace app\index\controller;

class Picture
{


    /**
     * 图片接口
     * @param int $page
     * @return \think\response\Json
     */
    public function index($page=20)
    {
        $page = (isset($_GET['page'])) ? intval($_GET ['page']) : 20;
        //http://pic.news.163.com/photocenter/api/list/0031/6LRK0031,6LRI0031/20/20/data.json
        $url="http://pic.news.163.com/photocenter/api/list/0031/6LRK0031,6LRI0031/".$page."/20/data.json";
        $res = HttpGet($url);
        $arr = json_decode(substr($res,5,-1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr
        ]);
    }




}
