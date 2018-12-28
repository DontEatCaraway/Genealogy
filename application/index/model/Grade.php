<?php
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;


class Grade extends Model
{
	public function index(){
		$result = Db::table("grade")->paginate(10);
		$page = $result->render();
		return array('result'=>$result,'page'=>$page); 
	}

	public function grade_insert($data){
		$result = Db::table("grade")->insert($data);
		return $result;
	}

	public function find($id){
		$result = Db::table("grade")->where(" id = '$id' ")->find();
		return $result;
	}
}	