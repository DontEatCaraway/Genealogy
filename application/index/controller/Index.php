<?php
namespace app\index\controller;

use think\Controller;
use app\index\controller\Layout;
use think\facade\Session;
use app\index\model\User;

class Index extends Controller
{
    public function index()
    {
        //获取模板信息
        $menus=new  Layout;
        $menus ->layouts("index");
       
        return $this->view->fetch();
    }

    public function index_1()
    {
        return '222';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
