<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User;
use think\facade\Session;
use app\index\controller\Layout;

class Personaldata extends Controller
{
	public function initialize()
	{
		//获取模板信息
		$menus=new  Layout;
    	$menus ->layouts("personaldata");
	}	

	public function index(){
		return $this->view->fetch();
	}

	public function index1(){
		//获取模板信息
       	echo 11;
       	return $this->view->fetch();
	}
}	