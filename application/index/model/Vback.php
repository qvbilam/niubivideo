<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vback extends Model
{

	//查询回复
	public function backSelect($vid)
	{
		return Db::name('vback')->where(['vid'=>$vid,'display'=>1])->select();
		/*return Db::name('vback')
			->alias('vb')
			->join('user a','a.uid = vb.uid')
			->field(['user','username','backcountent','backtime','vb.pid'])
			->select();*/
	}

	//添加回复
	public function backAdd()
	{
		$time = date("Y-m-d H:i:s",time());
		$data = [
			'uid' => session('uid'),
			'pid' => input('pid'),
			'vid' => input('vid'),
			'backcountent' => input('val'),
			'backtime' => $time,
		];
		$res = Db::name('vback')->insert($data);
		if($res){
			return true;
		}else{
			return false;
		}
	}
}