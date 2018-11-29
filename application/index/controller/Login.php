<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User;

class Login extends Controller
{
	//web网站注册
    public function register()
    {
    	if($_POST){
    		//接收注册传值
    		$id_card = $_POST['id_card'];
    		$username = $_POST['username'];
    		$pass = $_POST['pass'];

    		//验证注册信息
    		if(!is_idcard($id_card)){
    			return "请别攻击我的网站！！！";
    		}
    		if(!isChineseName($username)){
    			return "请输入完整的姓名";
    		}
    		if($pass == "123456"){
    			return "密码不能设为简单的123456";
    		}

    		$data = array('id_card'=>$id_card ,'username'=>$username ,'pass'=>md5($pass));
    		$result = Model("User")->register($data);
    		return $result;
    	}else{
    		return $this->view->fetch();
    	}
    }

    //验证该身份证是否注册
    public function verify(){
    	$result = Model("User")->verify_info($_POST['id_card']);
    	return $result;
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
