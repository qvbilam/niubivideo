<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vstyle extends Model
{
	public function stylename()
	{
		return Db::name('vstyle')->where(['display'=>1])->select();
	}
	public function Sname($id)
	{
		return Db::name('vstyle')->where(['display'=>1,'bid'=>$id])->select();
	}
	public function styleChange()
	{
		$id = input('cid');
		return Db::name('vstyle')->where(['display'=>1,'cid'=>$id])->select();
	}
}