<?php
/*
* @Author: ecitlm
* @Date:   2017-05-29 19:31:05
* @Last Modified by:   ecitlm
* @Last Modified time: 2017-05-30 18:04:42
*/
namespace app\index\controller;
include('QueryList.php');

class Splider
{
    public function index()
    {

    }

    public function splider()
    {
        $filePath = 'http://www.meizitu.com/';
        $data=Http_Spider($filePath);

       \phpQuery::newDocumentHTML($data);

        $arr = array();
        $list = pq('#picture')->find("a");
        foreach ($list as $li) {
            $title = pq($li)->attr('title') ;
            $url = pq($li)->attr('href');
            $img = pq($li)->find('img')->attr('src');

            $tmp = array(
                'title' => $title,
                'url' => $url,
                'img' => $img
            );
            array_push($arr, $tmp);
        }

        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr
        ]);

    }


}
