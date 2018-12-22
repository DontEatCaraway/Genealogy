<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;


class GenerationName extends Model
{	
	//字辈显示
	public function index(){
		$result = Db::table("generation_name")->alias('gn')->join('clan c','gn.cid = c.id')->field('gn.*,c.cname')->paginate(10);
		$page = $result->render();
		return array('result'=>$result,'page'=>$page); 
	}

	//字辈添加
	public function insert_generation_name($data){
		$result = Db::table("generation_name")->insert($data);
		return $result;
	}

	//修改字辈
	public function update_generation_name($data,$id){
		$result = Db::table("generation_name")->where(" id='$id' ")->update($data);
		return $result;
	}

	//字辈状态修改
	public function state_update($id,$state){
		$date['state'] = $state;
		$result = Db::table("generation_name")->where(" id='$id' ")->update($date);
	}

	//获取单条的字辈信息
	public function find($id){
		$result = Db::table("generation_name")->where(" id='$id' ")->find();
		return $result;
	}

	//删除字辈信息
	public function delete_generation_name($id){
		$result = Db::table("generation_name")->where(" id='$id' ")->delete();
		return $result;
	}

}