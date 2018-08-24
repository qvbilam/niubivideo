<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vback extends Model
{
	public function backAll()
	{
		return Db::name('vback')->where('display',1)->select();
	}
	public function backdel()
	{
		$id = input('id');
		$res = Db::name('vback')->where('id',$id)->update(['display'=>0]);
		if($res){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function huifu()
	{
		$id = input('id');
		$res = Db::name('vback')->where('id',$id)->update(['display'=>1]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
}