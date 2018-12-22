<?php
namespace app\index\controller;

use think\Controller;
use app\index\controller\Layout;
use think\facade\Session;
use app\index\model\Clan;
use app\index\model\Generation_name;
use app\index\model\User;

//账户管理控制器
class Useradmin extends Controller
{
	public function initialize()
    {
        //获取模板信息
        $menus=new  Layout;
        $menus ->layouts("user");
    }   

    public function index(){  //用户管理

    	$result = Model("User")->index();
    	var_dump($result);exit();
    	$this->assign("result",$result['result']);
    	$this->assign("page",$result['page']);

    	return $this->view->fetch();
    }	
}