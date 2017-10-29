<?php

/**
 * @Author: ecitlm
 * @Date:   2017-10-26 21:25:53
 * @Last Modified by:   ecitlm
 * @Last Modified time: 2017-10-29 11:23:39
 */

namespace app\api\controller;


class Nba
{

    /**
     * [获取赛事直播]
     */
    public function schedule()
    {
        $md = (isset($_GET['date'])) ? $_GET ['date'] : "";
        $res = HttpGet("https://nb.3g.qq.com/nba/api/schedule@getList?md={$md}&sid=");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['schedule@getList']
        ]);

    }


    /**
     * [live_detail 比赛直播详情信息]
     */
    public function live_detail()
    {
        $schid = (isset($_GET['schid'])) ? $_GET ['schid'] : "1470215";
        $liveid = (isset($_GET['liveid'])) ? $_GET ['liveid'] : "2009587";
        $res = HttpGet("https://nb.3g.qq.com/nba/api/live@getInfo?i_schid={$schid}&i_liveid={$liveid}");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['live@getInfo']['data']
        ]);
    }


    /**
     * 直播内容
     * @return \think\response\Json
     */
    public function live_content()
    {
        $schid = (isset($_GET['schid'])) ? $_GET ['schid'] : "1470215";
        $res = HttpGet("https://live.3g.qq.com/g/s?aid=action_api&module=nba&action=broadcast_content%2Cbroadcast_info&sch_id={$schid}");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['broadcast_content']['contentAry']
        ]);
    }

    /**
     * 球员技术统计
     * @return \think\response\Json
     */
    public function technical_statistics()
    {

        $schid = (isset($_GET['schid'])) ? $_GET ['schid'] : "1470215";
        $res = HttpGet("https://live.3g.qq.com/g/s?aid=action_api&module=nba&action=live_stat_4_nba%2Cbroadcast_info&sch_id={$schid}&bid=2009605");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['live_stat_4_nba']
        ]);
    }

    public function  player_detail(){

        $playerid = (isset($_GET['playerid'])) ? $_GET ['playerid'] : "4130";
        $res = HttpGet("https://live.3g.qq.com/g/s?aid=action_api&module=nba&action=player_detail&playerId={$playerid}&sid=");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['player_detail']
        ]);

    }

    /**
     * 转发图片
     */
    public function img()
    {
        $filename = (isset($_GET['imgurl'])) ? $_GET ['imgurl'] : "https://code.it919.cn/img/head.jpg";
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