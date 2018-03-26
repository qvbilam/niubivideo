<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Integralinfo extends Model
{
	//每日签到加积分
	public function meiri ($uid)
	{
		$time = time();
		$res = Db::name('integralinfo')->where('uid',$uid)->where('remark','每日签到')->order('id desc')->value('intexotime');
		if (!empty($res)) {
			if ($time - $res >= 86400 ) {
				 return $this->addintegral($uid);
			} else {
				return 3;
			}
		}
		return $this->addintegral($uid);
	}

	//增加每日签到积分
	public function addintegral($uid)
	{
		$arr = [];
		$arr['intexotime'] = time();
		$arr['intchange'] = 5;
		$arr['uid'] = $uid;
		$arr['remark'] = '每日签到';
		$arr['bianhua'] = 'add';
		$res = $this->save($arr);
		$integral = new Integral();
		$num = $integral->where('uid',$uid)->value('number');
		$num = $num +5;
		$str = $integral->where('uid',$uid)->update(['number'=>$num]);
		return $arr;
	}
}