<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vbank extends Model
{
	public function Bname()
	{
		return Db::name('vbank')->where('display','1')->select();
	}
	public function thisb($id)
	{
		return Db::name('vbank')->where(['display'=>'1','id'=>$id])->select();
	}
}