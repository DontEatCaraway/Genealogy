<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\model\User;
use think\Request;

class Layout extends Controller
{
	public function layouts($catalog){
		 //获取登录人
        $id = Session::get('id');
        $result = Model("User")->index_login($id);
        //头像
        $img = $result['file'];
        $this->assign("img",$img);
        $this->assign("template",$result);
        $this->assign("catalog",$catalog);
	}

	public function upload_img(){
		
	    // 获取文件后缀
	    $temp = explode(".", $_FILES["file"]["name"]);
	    $extension = end($temp);
	    // 判断文件是否合法
	    if(!in_array($extension,array("gif","jpeg","jpg","png"))){
	        exit(json_encode(array('code'=>1,'msg'=>'上传图片不合法')));
	    }
	    $id_name = Session::get("id");
	    $imgname = $id_name . "." .$extension;
	    
	   	$newpath="../public/static/uploads/".$imgname;
		move_uploaded_file($_FILES["file"]["tmp_name"],$newpath);//将临时地址移动到指定地址 
		$_FILES['file']['name'] = $imgname;
		$_FILES['file']['tmp'] = $newpath;
		Session::set("head_file",$_FILES);
		return json_encode($_FILES);
	   
 }
}