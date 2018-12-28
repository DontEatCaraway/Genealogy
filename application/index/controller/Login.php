<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User;
use think\facade\Session;

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
    		//验证身份证是否已被注册
    		$ass = Model("User")->verify_info($id_card);
    		if($ass == "1" ){
    			return "该身份证已被注册";
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
        if($_POST['id']){
            //根据身份证查数据库的回调信息（查看该身份证号是否存在）
            $result = Model("User")->verify_info($_POST['id_card']);
            //获取当前用户的用户信息
            $result2 = Model("User")->index_login($_POST['id']);
            //判断输入的身份证号码数据库是否存在
            if($result == 1){
                //判断当前输入的身份证号码是否与原用户的身份证号一致
                if($result2['id_card'] == $_POST['id_card']){
                    return 2;  //身份证号未作改变
                }else{
                    return 1;  //身份证已注册
                }
            }
        }else{
            $result = Model("User")->verify_info($_POST['id_card']);
            return $result;
        }
    	
    }

    //登录
    public function login(){
    	if($_POST){
    		if(!$_POST['id_card'] && !$_POST['pass']){
    			return -2;    //账号密码为空
    		}
    		$data = array('id_card'=>$_POST['id_card'] ,'pass'=>md5($_POST['pass']));
    		$result = Model("User")->login($data);
    		return $result;

    	}
    	return $this->view->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
