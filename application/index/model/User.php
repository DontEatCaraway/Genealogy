<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;

class User extends Model
{
	//网站注册用户
	public function register($data){
		$user = new User;
		$result = $user->save($data);
		if($result){
			return 1;   //注册成功
		}else{
			return -1;	//注册失败
		}
	}

	//验证身份证是否已被注册
	public function verify_info($id_card){
		$result = Db::table("user")->where(" id_card = '$id_card' ")->find();
		if($result){
			return 1;	//该身份证已被注册	
		}else{
			return -1;	
		}
	}
}
