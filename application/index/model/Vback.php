<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vback extends Model
{
	public function backSelect($vid)
	{
		return Db::name('vback')->where(['vid'=>$vid,'display'=>1])->select();
	}
	public function backAdd()
	{
		$time = date("Y-m-d H:i:s",time());
		$data = [
			//'uid'插入
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