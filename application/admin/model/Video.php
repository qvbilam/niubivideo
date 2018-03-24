<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Video extends Model
{
	public function vbank()
	{
		$data = Db::query("select * from damowang_vbank");
		return $data;
	}
}