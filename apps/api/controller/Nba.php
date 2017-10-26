<?php

/**
 * @Author: ecitlm
 * @Date:   2017-10-26 21:25:53
 * @Last Modified by:   ecitlm
 * @Last Modified time: 2017-10-26 22:51:14
 */

namespace app\api\controller;


class Nba
{

	/**
	 * [获取赛事直播]
	 * @return [type] [description]
	 */
    public function  schedule(){
    	$md = (isset($_GET['date'])) ? $_GET ['date'] : "";
    	$res = HttpGet("https://nb.3g.qq.com/nba/api/schedule@getList?md={$md}&sid=");
    	return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res,true)['schedule@getList']
        ]);
    
    }


	/**
	 * [live_detail 比赛直播详情信息]
	 * @return [type] [description]
	 */
    public function live_detail(){

    	$schid = (isset($_GET['schid'])) ? $_GET ['schid'] : "1470215";
    	$liveid = (isset($_GET['liveid'])) ? $_GET ['liveid'] : "2009587";
    	$res = HttpGet("https://nb.3g.qq.com/nba/api/live@getInfo?i_schid={$schid}&i_liveid={$liveid}");
    	return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res,true)['live@getInfo']['data']
        ]);

    	

    }
    /**
     * 转发图片
     * @return [type] [description]
     */
    public function img(){
    	$filename=(isset($_GET['imgurl'])) ? $_GET ['imgurl'] : "https://code.it919.cn/img/head.jpg";
		$size = getimagesize($filename);
		$fp = fopen($filename, "rb");
		if ($size && $fp) {
		    header("Content-type: {$size['mime']}");
		    fpassthru($fp);
		    exit;
		} else {
		   echo "<img src='https://code.it919.cn/img/head.jpg'>";
		}
    }
}