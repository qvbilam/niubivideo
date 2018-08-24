<?php

namespace app\index\model;
use think\Model;

class Integral extends Model
{
	//一对一关联
	public function Integralinfo ()
	{
		return $this->hasOne('Integralinfo','uid');
	}

	//查询积分
	public function selejifen()
	{
		$res =  $this->where('uid',session('uid'))->select();
		$data =$res->select();
	}
}