<?php
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
