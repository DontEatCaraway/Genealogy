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
		if($_POST){
			$head_file = Session::get("head_file");
			$arr = $this->request->param();
			if(isset($arr['hobby'])){
	    		$arr['hobby'] = implode(',',$arr['hobby']);
	    	}else{
	    		$arr['hobby'] = "";
	    	}
	    	$arr['file'] = $head_file['file']['name'];
			$result = Model("User")->update_user($arr,$head_file);
			if($result==1){
				echo "成功啦";
			}	
		}else{

			$id = Session::get("id");
			//获取个人用户信息
			$result = Model("User")->index_login($id);
			$this->assign("result",$result);
			//将爱好拆分为数组
	       if($result['hobby']){
	       	  $hobby = explode(',',$result['hobby']);
	       }else{
	       	  $hobby = "";
	       }
	       $this->assign("hobby",$hobby);
			return $this->view->fetch();

		}
		
	}

	public function upload(){
		return json_encode(2);
	}


	public function index1(){
		//获取模板信息
       	echo 11;
       	return $this->view->fetch();
	}
}	