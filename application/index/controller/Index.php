<?php
/*
* @Author: ecitlm
* @Date:   2017-05-29 19:31:05
* @Last Modified by:   ecitlm
* @Last Modified time: 2017-05-30 18:04:42
*/

namespace app\index\controller;

use \think\View;

include('QueryList.php');

class Index
{
    public function index()
    {
        $view = new View();
        return $view->fetch('index');
    }
}
