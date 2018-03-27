<?php
namespace app\admin\Model;
use think\Model;
use traits\model\SoftDelete;
use think\Db;

class Integral extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';

	//查询积分明细
	public function selintegral()
	{
		$res = Db::name('integralinfo')
			->alias('ii')
			->join('user a','ii.uid=a.uid')
			->join('integral i','i.uid=a.uid')
			->where('a.deleteTime is null')
			->paginate(4);
		return $res;
	}
}