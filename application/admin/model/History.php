<?php

namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class History extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';
	//查询浏览历史
	public function selrec()
	{
		$res = Db::name('user')
			->alias('a')
			->join('history h','h.uid=a.uid')
			->where('h.deleteTime is Null')
			->select();
		return $res;
	}

}