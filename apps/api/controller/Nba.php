<?php

/**
 * @Author: ecitlm
 * @Date:   2017-10-26 21:25:53
 * @Last Modified by:   ecitlm
 * @Last Modified time: 2017-10-31 22:34:03
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
     * @return \think\response\Json
     * 联盟排名
     */
    public function team_rank(){
        $res = HttpGet("https://matchweb.sports.qq.com/rank/team?columnId=100000&from=NBA");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)[1]
        ]);
    }

    /**
     * @return \think\response\Json
     * 球队详情
     */
    public function team_info(){
        $id = (isset($_GET['teamId'])) ? $_GET ['teamId'] : "24";
        $res = HttpGet("https://live.3g.qq.com/g/s?aid=action_api&module=nba&action=team_detail&teamId={$id}&sid=");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['team_detail']
        ]);

    }

    /**
     * 球队阵容
     */
    public function Lineup(){
        $id = (isset($_GET['teamId'])) ? $_GET ['teamId'] : "24";
        $res = HttpGet("https://live.3g.qq.com/g/s?aid=action_api&module=nba&action=team_player&teamId={$id}&sid=");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)['team_player']['players']
        ]);
    }


    /**
     * @return \think\response\Json
     * 网易NBA新闻列表
     */
    public function new_list(){
        $page  = (isset($_GET['page'])) ? $_GET ['page'] : "0";
        $page= $page *15;
        $res = HttpGet("https://3g.163.com/touch/reconstruct/article/list/BD2AQH4Qwangning/{$page}-15.html");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode(substr($res, 9, -1), true)['BD2AQH4Qwangning']
        ]);
    }

    /**
     * @return \think\response\Json
     * 网易NBA新闻详情
     */
    public  function news_info(){
        $id = (isset($_GET['docid'])) ? $_GET ['docid'] : "D22DCS5S0005877U";
        $res = HttpGet("http://3g.163.com/touch/article/{$id}/full.html");
        $arr = json_decode(substr($res, 12, -1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$id]
        ]);
    }


    public function website(){
          return json([
            'msg' => 'success',
            'code' => 1,
            'data' => [
                name=>"没有故事的小明同学",
                job=>"Web开发工程师",
                icon=>"https://coding.it919.cn/static/images/zixia.jpg",
                address=>"深圳市南山区科技园",
                latitude=>"22.549990",
                longitude=>"113.950660",
                github=>"https://github.com/ecitlm",
                blog=>"https://code.it919.cn",
                mail=>"ecitlm@163.com",
                Motto=>'我们这一生，要走很远的路，有如水坦途，有荆棘挡道；有簇拥同行，有孤独漫步；有幸福如影，有苦痛袭扰；有迅跑，有疾走，有徘徊，还有回首……正因为走了许多路，经历的无数繁华与苍凉，才在时光的流逝中体会岁月的变迁，让曾经稚嫩的心慢慢地趋于成熟。',
                'music'=>[
                    src=>"https://coding.it919.cn/static/images/better_man.mp3",
                    author=>"Robbie Williams",
                    name=>"Better Man",
                    poster=>"https://coding.it919.cn/static/images/poster.jpg"
                ]
            ]
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