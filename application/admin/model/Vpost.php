<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vpost extends Model
{
	public function postAll()
	{
		return Db::name('vpost')->order('vid')->where('display',1)->select();
	}
	public function postdel()
	{
		$id = input('id');
		$res = Db::name('vpost')->where('id',$id)->update(['display'=>0]);
		if($res){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function recycle()
	{
		$post = Db::name('vpost')->where('display',0)->select();
		$back = Db::name('vback')->where('display',0)->select();
		$danmu = Db::name('vdanmu')->where('display',0)->select();
		$dis['post'] = $post;
		$dis['back'] = $back;
		$dis['danmu'] = $danmu;
		return $dis;
	}
	public function huifu()
	{
		$id = input('id');
		$res = Db::name('vpost')->where('id',$id)->update(['display'=>1]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
}