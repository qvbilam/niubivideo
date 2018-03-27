<?php
namespace app\index\model;
use app\index\model\Integral;
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
		//插入到积分明细表
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
		return $str;
	}

	//兑换会员
	public function duivip($num)
	{	
		//查询 用户是否是会员
		$res = Db::name('user')->where('user',session('name'))->value('isvip');
		if ($res == 0) {
			//办理会员
			$find = Db::name('user')->where('user',session('name'))->update(['isvip'=>1]);
			$add = $this->addvip();
		}
		//查询用户会员过期时间
		$data = Db::name('vipinfo')->where('uid',sesson('uid'))->find()->toarray();
		//续费会员
		$arr = [];
		if($data['vipdtime']<$data['viptime']) {
			$arr['vipdtime'] = time();
		} else {
			$arr['vipdtime'] = $data['vipdtime'];
		}
		$arr['viptime'] = time();
		$arr['expire'] = 1;
		if($num[1] == 7 ) {
			$arr['vipdtime'] += 86400*7;
		} else {
			$arr['vipdtime'] += 86400*30;
		}
		$res = Db::name('vipinfo')->where('uid',session('uid'))->updata($arr);
		//添加积分消费信息
		$ste = $this->updateintegral($num);

	
	}

	//积分兑换 插入数据 
	public function updateintegral($data)
	{
		$arr['intexotime'] = time();
		$arr['uid'] = session('uid');
		if ($data[1] == 7) {
			$arr['intchange'] = 30;
			$arr['remark'] = '兑换7天VIP';
		} else {
			$arr['intchange'] = 100;
			$arr['remark'] = '兑换30天VIP';
		}		
		$arr['bianhua'] = 'dec';
		$str = Db::name('integralinfo')->insert($arr);
		//修改 integral 数据
		$num = $data[0] - $arr['integral'];
		$int = DB::name('integral')->where('uid',session('uid'))->update(['number'=>$num]);
		return [$str,$int];
	}

	//添加到会员列表
	public function addvip()
	{
		$arr['uid'] = session('uid');
		$arr['firsttime'] = time();
		$arr['viptime'] = time();
		$arr['vipdtime'] = time();
		$res = Db::name('vipinfo')->insert($arr);
		return $res;
	}
}