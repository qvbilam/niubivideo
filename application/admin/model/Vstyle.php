<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vstyle extends Model
{
	public function ajax()
	{
		return Db::name('vstyle')->select();
	}
	public function manage()
	{
		return Db::name('vstyle')->select();
	}
	public function stylesel()
	{
		$name = input('name');
		$bid = input('bid');
		$cid = input('cid');
		$res = Db::name('vstyle')->where(['bid'=>$bid,'cid'=>$cid,'stylename'=>$name])->select();
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function styleadd()
	{
		$name = input('name');
		$bid = input('bid');
		$cid = input('cid');
		$res = Db::name('vstyle')->insert(['bid'=>$bid,'cid'=>$cid,'stylename'=>$name]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function styledel()
	{
		$id = input('id');
		Db::name('vstyle')->where('id',$id)->update(['display'=>0]);
		Db::name('vtovideo')->where('sid',$id)->update(['display'=>0]);
		$vto = Db::name('vtovideo')->where(['sid'=>$id,'display'=>0])->select();
		foreach ($vto as $val) {
			Db::name('video')->where('tid',$val['id'])->update(['display'=>0]);
		}
		return true;
	}
	public function stylehui()
	{
		$id = input('id');
		Db::name('vstyle')->where('id',$id)->update(['display'=>1]);
		Db::name('vtovideo')->where('sid',$id)->update(['display'=>1]);
		$vto = Db::name('vtovideo')->where(['sid'=>$id,'display'=>1])->select();
		foreach ($vto as $val) {
			Db::name('video')->where('tid',$val['id'])->update(['display'=>1]);
		}
		return true;
	}
}