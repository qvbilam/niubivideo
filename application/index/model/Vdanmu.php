<?php

namespace app\index\model;
use thinl\Model;
use think\Db;

class Vdanmu
{
	public function addDanmu($vid,$uid=null)
	{	
		$dm = $_POST['danmu'];
		$danmu = json_decode($dm);
		$data = [
			'uid' => 1,
			'vid' => $vid,
			'text'=> "$danmu->text",
			'color'=> "$danmu->color",
			'size'=> "$danmu->size",
			'position'=> "$danmu->position",
			'time'=> "$danmu->time",
		];
		Db::table('damowang_vdanmu')->insert($data);
	}
	public function getDanmu($vid)
	{
		$data = Db::query("select * from damowang_vdanmu where display=1 and vid=?",[$vid]);
		return $data;
	}
}
