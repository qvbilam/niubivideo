<?php

namespace app\index\model;
//系统下的魔性
use think\Model;
use think\Db;
class Video extends Model
{
	public function vclass()
	{
		$data = Db::query("select * from damowang_vclass");
		return $data;
	}
	public function vplace()
	{
		$data = Db::query("select * from damowang_vplace");
		return $data;
	}
	public function video($vid=null)
	{
		if(empty($vid))
		{
			$data = Db::query("select * from damowang_video");
		}else{
			$data = Db::query("select * from damowang_video where id=?",[$vid]);
		}
		return $data;
	}
}