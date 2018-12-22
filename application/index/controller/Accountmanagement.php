<?php
namespace app\index\controller;

use think\Controller;
use app\index\controller\Layout;
use think\facade\Session;
use app\index\model\Clan;
use app\index\model\Generation_name;

//族氏字辈控制器
class Accountmanagement extends Controller
{
    public function initialize()
    {
        //获取模板信息
        $menus=new  Layout;
        $menus ->layouts("account_management");
    }   
    
    //氏族显示
    public function index()
    {
    	$result = Model("Clan")->index();
    	$this->assign("result",$result['result']);
    	$this->assign("page",$result['page']);
        return $this->view->fetch();
    }

    //添加族氏
    public function insert_clan()
    {
    	if($_POST){

    		$date = array('cname'=>$_POST['cname'],'state'=>isset($_POST['state'])?$_POST['state']:2,'createtime'=>time());

    		$result = Model("Clan")->insert_clan($date);

    		if($result){
	    			 $success = array('url'=>'index','name'=>'新增'.$_POST['cname'].'成功！');
					 $this->assign("success",$success);
					 return $this->view->fetch("Layout/url");
			}else{
				$this->error('新增失败');  //新增失败
			}

    	}else{
    		return $this->view->fetch("insert_clan");
    	}
        
    }

    //修改族氏状态
    public function state_update(){
    	if($_POST){
            if($_POST['no']==1){  //修改族氏状态

                $state = $_POST['type'];
                $id = $_POST['id'];
                Model("Clan")->state_update($id,$state); 
              
            }else if($_POST['no']==2){  //修改字辈状态

                $state = $_POST['type'];
                $id = $_POST['id'];
                Model("GenerationName")->state_update($id,$state); 

            }
    		
    	}
    }

    //编辑族氏
    public function update_clan(){
        if($_POST){
            $id = $_GET['id'];
            $date = array('cname'=>$_POST['cname'],'state'=>isset($_POST['state'])?$_POST['state']:2);
            $result = Model("Clan")->update_clan($date,$id);
            if($result){
                 $success = array('url'=>'index','name'=>'族氏编号'.$id.'更新成功！');
                 $this->assign("success",$success);
                 return $this->view->fetch("Layout/url");
            }else{
                 $this->error('您没有进行数据更新哦！！！');  //更新失败
            }
        }else{
             if(isset($_GET['id'])){
                $id = $_GET['id'];
                $result = Model("Clan")->find($id);
                $this->assign("result",$result);
             }
             return $this->view->fetch();
        }
       
    }

    //删除族氏
    public function delete_clan(){
        if($_POST){
            $result = Model("Clan")->delete_clan($_POST['id']);
            if($result){
                return 1;  //删除成功
            }else{
                return 2;  //删除失败 
            }
        }
    }

    //字辈显示
    public function generation_name(){
        //所有字辈显示
        $result = Model("GenerationName")->index();
        $this->assign("result",$result['result']);
        $this->assign("page",$result['page']);

        $clan = Model("Clan")->indexsum();
        return $this->view->fetch();
    }

    //新增字辈名称
    public function insert_generation_name(){
        if($_POST){

            if(isset($_GET['id'])){    //修改字辈

                $data = array('gname'=>$_POST['gname'],'state'=>isset($_POST['state'])?$_POST['state']:2,'cid'=>$_POST['cid'],'quanzhong'=>$_POST['quanzhong'],'remarks'=>$_POST['remarks']);

                if($_POST['gname'] && $_POST['cid']){   
                }else{
                     $this->error('请您完善信息再提交！！！');  //更新失败
                }
                
                $result = Model("GenerationName")->update_generation_name($data,$_GET['id']);

                if($result){    //修改字辈成功

                         $success = array('url'=>'generation_name','name'=>'字辈编号'.$_GET['id'].'修改成功！');
                         $this->assign("success",$success);
                         return $this->view->fetch("Layout/url");
                }else{
                    $this->error('修改失败');  //新增失败
                }

            }else{  //新增字辈

                $data = array('gname'=>$_POST['gname'],'state'=>isset($_POST['state'])?$_POST['state']:2,'cid'=>$_POST['cid'],'create'=>time(),'quanzhong'=>$_POST['quanzhong'],'remarks'=>$_POST['remarks']);

                if($_POST['gname'] && $_POST['cid']){   
                }else{
                     $this->error('请您完善信息再提交！！！');  //更新失败
                }
                
                $result = Model("GenerationName")->insert_generation_name($data);

                if($result){    //新增字辈成功

                         $success = array('url'=>'generation_name','name'=>'新增'.$_POST['gname'].'字辈成功！');
                         $this->assign("success",$success);
                         return $this->view->fetch("Layout/url");
                }else{
                    $this->error('新增失败');  //新增失败
                }

            }

        }else{
            //字辈ID存在为编辑
            $id = isset($_GET['id'])?$_GET['id']:"";
            $this->assign("id",$id);

            $ass = Model("GenerationName")->find($id);
            $this->assign("ass",$ass);

            $clan = Model("Clan")->indexsum();
            $this->assign("clan",$clan);

            //获取族氏记录
            return $this->view->fetch(); 
        }   
    }

    public function delete_generation_name(){   //删除字辈
        if($_POST){

            $result = Model("GenerationName")->delete_generation_name($_POST['id']);
            if($result){
                return 1;  //删除成功
            }else{
                return 2;  //删除失败 
            }
        }
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}