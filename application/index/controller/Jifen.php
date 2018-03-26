<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Feed;
use app\index\model\Integralinfo;
use think\Db;

class Jifen extends Controller
{
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
		//$res = input('get.uid');
		$res = 1;
		$integralinfo = new Integralinfo();
		$str = $integralinfo->meiri($res);
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
		dump($data);

	}


	//我的消息
	public function news()
	{
		return $this->fetch();
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}

	//VIp信息
	public function coupon()
	{

	}

}
