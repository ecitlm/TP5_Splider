<?php

/**
 * @Author: ecitlm
 * @Date:   2017-10-26 21:25:53
 * @Last Modified by:   ecitlm
 * @Last Modified time: 2017-10-26 21:44:02
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
    	$res = json_decode($res,true);
    	return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $res['schedule@getList']
        ]);
    
    }
}