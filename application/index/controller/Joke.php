
<?php
/*
* @Author: ecitlm
* @Date:   2017-05-29 19:31:05
* @Last Modified by:   ecitlm
* @Last Modified time: 2017-05-30 18:04:42
*/
namespace app\index\controller;

class Joke
{
    public function index($page=10)
    {
        $page = (isset($_GET['page'])) ? intval($_GET ['page']) : 10;

        $url = "http://3g.163.com/touch/jsonp/joke/chanListNews/T141931628472/2/".$page."-10.html?callback=data";

        $res = HttpGet($url);
        $arr = json_decode(substr($res,5,-1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr['段子']
        ]);
    }
}
