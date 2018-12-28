<?php
namespace app\index\controller;

use think\Controller;
use app\index\controller\Layout;
use think\facade\Session;
use app\index\model\Clan;
use app\index\model\Generation_name;
use app\index\model\User;
use app\index\model\Grade;

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
    	
    	$this->assign("result",$result['result']);
    	$this->assign("page",$result['page']);

    	return $this->view->fetch();
    }	

    public function insert_user(){  //用户添加
        if($_POST){
            if(isset($_GET['id'])){  //修改时判断身份证是否存在
                $verify_info = Model("User")->verify_info($_POST['id_card']);

                $result2 = Model("User")->index_login($_GET['id']);

                if($verify_info == 1){
                    if($result2['id_card'] != $_POST['id_card']){
                        $verify_info = 1;   //身份证已存在
                    }else{
                        $verify_info = 2;   //与原身份证号一致
                    }
                }
            }else{
                $verify_info = Model("User")->verify_info($_POST['id_card']);
            }
            
            if($verify_info == 1){
                $this->error('该身份证已注册！！！');
            }

            if(!is_idcard($_POST['id_card'])){
                $this->error('身份证格式错误');  
            } 

            if(!isChineseName($_POST['username'])){
                $this->error('请输入正确的中文姓名！！！');
            }
            if(!isset($_GET['id'])){
                 $data = array('username'=>$_POST['username'],'id_card'=>$_POST['id_card'],'pass'=>md5(substr($_POST['id_card'],-6)));  
            }else{
                 $data = array('username'=>$_POST['username'],'id_card'=>$_POST['id_card']); 
            }
           
            
            if(isset($_GET['id'])){  //修改用户
                $result = Model("User")->update_user2($data,$_GET['id']);
                if($result == 1){
                     $success = array('url'=>'index','name'=>'修改用户编号'.$_GET['id'].'成功！');
                     $this->assign("success",$success);
                     return $this->view->fetch("Layout/url");
                }else{
                     $this->error('未作修改！！！');
                }
            }else{  //新增用户
                $result = Model("User")->register($data);
                if($result == 1){

                     $success = array('url'=>'index','name'=>'新增用户'.$_POST['username'].'成功！');
                     $this->assign("success",$success);
                     return $this->view->fetch("Layout/url");
                }
            }
           

        }else{
            //用户ID存在为编辑
            $id = isset($_GET['id'])?$_GET['id']:"";
            $this->assign("id",$id);

            $ass = Model("user")->index_login($id);
            $this->assign("ass",$ass);
            return $this->view->fetch();  

        }
        
    }

    public function delete_user(){   //删除用户
        if($_POST['id']){
            $result = Model("User")->delete_user($_POST['id']);
            return $result;
        }
    }


    //-----------------------------------------身份等级----------------------------
    public function grade(){   
        $result = Model("Grade")->index();
        
        $this->assign("result",$result['result']);
        $this->assign("page",$result['page']);

        return $this->view->fetch();
    }

    public function grade_insert(){   
        if($_POST){

            if(!is_idcard($_POST['quanzhong'])){
                $this->error('请输入您的等级权重');  
            } 

            if(!isChineseName($_POST['name'])){
                $this->error('请输入您的等级名称！！！');
            }
            if(!isset($_GET['id'])){
                 $data = array('name'=>$_POST['name'],'quanzhong'=>$_POST['quanzhong'],'state'=>$_POST['state'],'time'=>time());  
            }else{
                 $data = array('username'=>$_POST['username'],'id_card'=>$_POST['id_card']); 
            }
           
            
            if(isset($_GET['id'])){  //修改用户
                $result = Model("User")->update_user2($data,$_GET['id']);
                if($result == 1){
                     $success = array('url'=>'index','name'=>'修改用户编号'.$_GET['id'].'成功！');
                     $this->assign("success",$success);
                     return $this->view->fetch("Layout/url");
                }else{
                     $this->error('未作修改！！！');
                }
            }else{  //新增等级
                $result = Model("Grade")->grade_insert($data);
                if($result == 1){

                     $success = array('url'=>'index','name'=>'新增等级'.$_POST['name'].'成功！');
                     $this->assign("success",$success);
                     return $this->view->fetch("Layout/url");
                }
            }
           

        }else{
            //用户ID存在为编辑
            $id = isset($_GET['id'])?$_GET['id']:"";
            $this->assign("id",$id);

            $ass = Model("Grade")->find($id);
            $this->assign("ass",$ass);
            return $this->view->fetch();  

        }
    }
}