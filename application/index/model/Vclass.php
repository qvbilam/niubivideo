<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vclass extends Model
{
	public function cname($id)
	{
		return Db::name('vclass')->where(['display'=>1,'bid'=>$id])->select();
	}
	public function classname()
	{
		return Db::name('vclass')->where(['display'=>1])->select();
	}
}