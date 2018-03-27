<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vbank extends Model
{
	public function ajax()
	{
		return Db::name('vbank')->select();
	}
	public function manage()
	{
		return Db::name('vbank')->select();
	}
	public function banksel()
	{
		$name = input('name');
		$res = Db::name('vbank')->where('bankname',$name)->select();
		if($res){
			return false;
		}else{
			return true;
		}
	}
	public function bankadd()
	{
		$name = input('name');
		$res = Db::name('vbank')->insert(['bankname' => $name]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function bankdel()
	{
		$id = input('id');
		Db::name('vbank')->where('id',$id)->update(['display'=>0]);
		Db::name('vclass')->where('bid',$id)->update(['display'=>0]);
		Db::name('vstyle')->where('bid',$id)->update(['display'=>0]);
		Db::name('vtovideo')->where('bid',$id)->update(['display'=>0]);
		$vt = Db::name('vtovideo')->where(['display'=>0,'bid'=>$id])->select();
		foreach ($vt as $val) {
			Db::name('video')->where('tid',$val['id'])->update(['display'=>0]);
		}
		return Db::name('vbank')->where('id',$id)->select();
	}
	public function bankhui()
	{
		$id = input('id');
		Db::name('vbank')->where('id',$id)->update(['display'=>1]);
		Db::name('vclass')->where('bid',$id)->update(['display'=>1]);
		Db::name('vstyle')->where('bid',$id)->update(['display'=>1]);
		Db::name('vtovideo')->where('bid',$id)->update(['display'=>1]);
		$vt = Db::name('vtovideo')->where(['display'=>1,'bid'=>$id])->select();
		foreach ($vt as $val) {
			Db::name('video')->where('tid',$val['id'])->update(['display'=>1]);
		}
		return Db::name('vbank')->where('id',$id)->select();
	}
	public function jiancha()
	{
		$id = input('id');
		//先插到bid
		$b = Db::name('vstyle')->where('id',$id)->select();
		$bid = $b[0]['bid'];
		$res = Db::name('vbank')->where(['id'=>$bid,'display'=>1])->select();
		if($res){
			return true; //插到了说明是显示的。可以恢复
		}else{
			return false;
		}
	}
}