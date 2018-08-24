<?php

namespace app\index\model;
use thinl\Model;
use think\Db;

class Danmu
{
	public function addDanmu($vid,$uid=null)
	{	
		$dm = $_POST['danmu'];
		$danmu = json_decode($dm);
		//$sql = Db::execute("insert into damowang_vdanmu value (null,?)",[1]);
		/*$data = [
			'uid' => 1,
			'vid' => "1",
			'text'=> "$danmu['text']",
			'color'=> "$danmu['color']",
			'size'=> "$danmu['size']",
			'position'=> "$danmu['position']",
			'time'=> "$danmu['time']",
		];*/
		//$sql = Db::execute("insert into damwang_vdanmu value (null,1,?,?,?,?,?,?)",$dan);
		//$sql = Db::execute("insert into damowang_vdanmu value (null,?,?,?,?,?,?,?)",$data);
	}
	public function getDanmu($vid)
	{
		$data = Db::query("select * from damowang_vdanmu where vid=?",[$vid]);
		return $data;
	}
}
