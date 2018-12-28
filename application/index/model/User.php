<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;

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

	//登录
	public function login($data){
		$id_card = $data['id_card'];$pass = $data['pass'];
		$result = Db::table("user")->where(" (id_card='$id_card' or username='$id_card') and pass='$pass' ")->find();
		if($result){
			Session::set("id",$result['id']);
			return 1;   //登录成功
		}else{
			return -1;   //登录失败
		}
	}

	//获取登陆者的信息
	public function index_login($id){
		$result = Db::table("user")->where("id = '$id' ")->find();
		return $result;
	}

	//修改用户信息  (身份证号和姓名)
	public function update_user2($data,$id){
		$result = Db::table("user")->where(" id = '$id' ")->update($data);
		if($result){
			return 1;
		}else{
			return -1;
		}
	}

	//删除用户
	public function delete_user($id){
		$result = Db::table("user")->where(" id = '$id' ")->delete();
		if($result){
			return 1;   //删除成功
		}else{
			return -1;  //删除失败
		}
	}

	//完善用户信息   当前登陆者修改信息
	public function update_user($arr,$head_file){
		$id = Session::get("id");
		$result = Db::table("user")->where(" id = '$id' ")->update($arr);
		if($result){
			if($head_file){
				//保存图片并销毁缓存
				move_uploaded_file($head_file["file"]["tmp_name"],$head_file["file"]["tmp"]);//将临时地址移动到指定地址 
				Session::set("head_file","");
			}
			return 1;
		}else{
			return -1;
		}
	}

	//用户管理
	public function index(){

		$result = Db::table("user")->paginate(10);
		$page = $result->render();
		return array('result'=>$result,'page'=>$page); 
	}

}
