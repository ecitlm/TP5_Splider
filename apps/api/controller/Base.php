<?php
/**
 * Date: 2017/9/5
 * Time: 14:13
 */

namespace app\api\controller;
class Base
{

    public function __construct()
    {
        $this->checkSign();
    }

    /**
     * 校验签名
     */
    public function checkSign()
    {
        $params = $_REQUEST;

        if (empty($params['sign'])) {
            echo json_encode(array(
                'msg' => '缺少Sign参数',
                'code' => 999
            ));
            die();
        }else{
            $responseSign = $params['sign'];
            $params['appkey'] = config('appkey');
            unset($params['sign']);
            ksort($params);
            $str = implode($params);
            $sign= MD5($str);
            if ($sign != $responseSign) {
                echo json_encode(array(
                    'msg' => 'sign签名错误',
                    'code' => 999,
                    'sign'=>$sign
                ));
                die();
            }
        }
    }
}
