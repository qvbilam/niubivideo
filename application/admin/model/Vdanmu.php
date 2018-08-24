<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vdanmu extends Model
{
	public function danmuAll()
	{
		return Db::name('vdanmu')->order('vid')->where('display',1)->select();
	}
	public function danmuDel()
	{
		$id = input('id');
		$res = Db::name('vdanmu')->where('id',$id)->update(['display'=>0]);
		if($res){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function huifu()
	{
		$id = input('id');
		$res = Db::name('vdanmu')->where('id',$id)->update(['display'=>1]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
}