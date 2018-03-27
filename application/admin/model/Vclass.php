<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vclass extends Model
{
	public function ajax()
	{
		return Db::name('vclass')->select();
	}
	public function manage()
	{
		return Db::name('vclass')->select();
	}
	public function classsel()
	{
		$name = input('name');
		$id = input('id');
		$res = Db::name('vclass')->where(['bid'=>$id,'classname'=>$name])->select();
		if($res){
			return false;
		}else{
			return true;
		}
	}
	public function classadd()
	{
		$name = input('name');
		$id = input('id');
		$res = Db::name('vclass')->insert(['classname'=>$name,'bid'=>$id]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function classchange()
	{
		$bid = input('id');
		return Db::name('vclass')->where('bid',$bid)->select();
	}
	public function classdel()
	{
		$id = input('id');
		Db::name('vclass')->where('id',$id)->update(['display'=>0]);
		Db::name('vstyle')->where('cid',$id)->update(['display'=>0]);
		Db::name('vtovideo')->where('cid',$id)->update(['display'=>0]);
		$vt = Db::name('vtovideo')->where(['display'=>0,'cid'=>$id])->select();
		foreach ($vt as $val) {
			Db::name('video')->where('tid',$val['id'])->update(['display'=>0]);
		}
		return true;
	}
	public function classhui()
	{
		$id = input('id');
		$b = Db::name('vclass')->where('id',$id)->select();
		@$bid = $b[0]['bid'];
		$res = Db::name('vbank')->where(['id'=>$bid,'display'=>1])->select();
		if($res){
			Db::name('vclass')->where('id',$id)->update(['display'=>1]);
			Db::name('vstyle')->where('cid',$id)->update(['display'=>1]);
			Db::name('vtovideo')->where('cid',$id)->update(['display'=>1]);
			$vt = Db::name('vtovideo')->where(['display'=>1,'cid'=>$id])->select();
			foreach ($vt as $val) {
				Db::name('video')->where('tid',$val['id'])->update(['display'=>1]);
			}
			return true;
		}else{
			return false;
		}	
	}
	public function jiancha()
	{
		$id = input('id');
		$c = Db::name('vstyle')->where('id',$id)->select();
		$cid = $c[0]['cid'];
		$res = Db::name('vclass')->where(['id'=>$cid,'display'=>1])->select();
		if($res){
			return true;
		}else{
			return false;
		}
	}
}