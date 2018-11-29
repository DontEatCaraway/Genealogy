<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\model\User;

class Layout extends Controller
{
	public function layouts($catalog){
		 //获取登录人
        $id = Session::get('id');
        $result = Model("User")->index_login($id);
        $this->assign("template",$result);
        $this->assign("catalog",$catalog);
	}
}