<?php
/*
* @Author: ecitlm
* @Date:   2017-05-29 19:31:05
* @Last Modified by:   ecitlm
* @Last Modified time: 2017-05-30 18:04:42
*/
namespace app\api\controller;

class Picture
{

    /**
     * 图片接口
     * @param int $page
     * @return \think\response\Json
     */
    public function index($page = 20)
    {
        $page = (isset($_GET['page'])) ? intval($_GET ['page']) : 20;
        $url = "http://pic.news.163.com/photocenter/api/list/0031/6LRK0031,6LRI0031/" . $page . "/20/data.json";
        $res = HttpGet($url);
        $arr = json_decode(substr($res, 5, -1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr
        ]);
    }


    public function down()
    {


        $url = "http://www.hbmeinv.com/index.php?m=Content&c=Index&a=gengduolist&p=2&catid=34";
        $res = HttpGet($url);
        $arr = json_decode($res, true);
        foreach ($arr as $v){
            $this->download_image($v['thumb'],"/","splider_img",array('jpg', 'gif', 'png'),1);
        }

    }


    /**
     * @param string $url 远程文件地址
     * @param string $filename 保存后的文件名（为空时则为随机生成的文件名，否则为原文件名）
     * @param array $fileType 允许的文件类型
     * @param string $dirName 文件保存的路径（路径其余部分根据时间系统自动生成）
     * @param int $type 远程获取文件的方式
     * @return json 返回文件名、文件的保存路径
     * @return bool|\think\response\Json
     */
    public function download_image($url, $fileName = '', $dirName, $fileType = array('jpg', 'gif', 'png'), $type = 1)
    {
        if ($url == '')
        {
            return false;
        }

        // 获取文件原文件名
        $defaultFileName = basename($url);

        // 获取文件类型
        $suffix = substr(strrchr($url, '.'), 1);
        if (!in_array($suffix, $fileType))
        {
            return false;
        }

        // 设置保存后的文件名
        $fileName = $fileName == '' ? time() . rand(0, 9) . '.' . $suffix : $defaultFileName;

        // 获取远程文件资源
        if ($type)
        {
            $ch = curl_init();
            $timeout = 30;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file = curl_exec($ch);
            curl_close($ch);
        }
        else
        {
            ob_start();
            readfile($url);
            $file = ob_get_contents();
            ob_end_clean();
        }

        // 设置文件保存路径
        //$dirName = $dirName . '/' . date('Y', time()) . '/' . date('m', time()) . '/' . date('d', time());
        $dirName = $dirName . '/' . date('Ym', time());
        if (!file_exists($dirName))
        {
            mkdir($dirName, 0777, true);
        }

        // 保存文件
        $res = fopen($dirName . '/' . $fileName, 'a');
        fwrite($res, $file);
        fclose($res);

        return json(array(
            'fileName' => $fileName,
            'saveDir' => $dirName
        ));
    }

}
