<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Feed;
use app\index\model\Integralinfo;
use think\Db;

class Jifen extends Controller
{
	protected $integralinfo;
	public function _initialize()
	{
		$this->integralinfo = new Integralinfo();
	}


	//积分
	public function points()
	{
		$res  = Db::name('user')
			->alias('a')
			->join('integral w','a.uid = w.uid')
			->join('integralinfo c','a.uid = c.uid')
			->where('user','admin')
			->select();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//每日签到
	public function qiandao()
	{
		$res = input('get.uid');
		$str = $this->integralinfo->meiri($res);
		return  $str;
	}


	//收藏
	public function collection()
	{
		return $this->fetch();
	}


	//观看历史
	public function foot()
	{
		return $this->fetch();
	}

	//意见反馈
	public function suggest()
	{
		return $this->fetch();
	}

	//添加评论
	public function dosuggest()
	{
		$res = input();
		$feed = new Feed();
		$data = $feed->addping($res);
	}


	//我的消息
	public function news()
	{
		return $this->fetch();
	}

	//消息
	public function blog()
	{
		return $this->fetch();
	}
	

	//VIp信息
	public function coupon()
	{
		return $this->fetch();
	}
	//积分兑换显示页
	public function bonus()
	{
		return $this->fetch();
	}

	//积分兑换7天VIP
	public  function duivip7()
	{
		$res =[];
		$res[0] = input('get.num');
		$res[1] = 7;
		$res = $this->integralinfo->duivip($res);
		return $res;
	}

	//积分兑换30天VIP
	public  function duivip30()
	{
		$res =[];
		$res[0] = input('get.num');
		$res[1] = 30;
		$res = $this->integralinfo->duivip($res);
		return $res;
	}


	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}