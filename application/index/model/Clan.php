<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;


class Clan extends Model
{
	//添加族氏
	public function insert_clan($date){
		$result = Db::table("clan")->insert($date);
		return $result;
	}

	//族氏显示   分页显示
	public function index(){
		$result = Db::table("clan")->paginate(10);
		$page = $result->render();
		return array('result'=>$result,'page'=>$page); 
	}

	//所有族氏
	public function indexsum(){
		$result = Db::table("clan")->select();
		return $result;
	}

	//族氏状态修改
	public function state_update($id,$state){
		$date['state'] = $state;
		$result = Db::table("clan")->where(" id='$id' ")->update($date);
	}

	//查找单条的族氏记录
	public function find($id){
		$result = Db::table("clan")->where(" id='$id' ")->find();
		return $result;
	}

	//编辑族氏
	public function update_clan($date,$id){
		$result = Db::table("clan")->where(" id='$id' ")->update($date);
		return $result;
	}

	//删除族氏
	public function delete_clan($id){
		$result = Db::table("clan")->where(" id='$id' ")->delete();
		return $result;
	}
}