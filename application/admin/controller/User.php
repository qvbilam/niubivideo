<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as Usermodle;
use think\Session;

class User extends Controller
{
	//登录展示页
	public function login()
	{
		return $this->fetch();
	}

	//登录执行
	public function dologin()
	{
		
		$res = input();
		$user = new Usermodle();
		$data = $user->dologin($res);
		return $data;
		//return $data;
	}

	//退出登录
	public function delname()
	{
		Session::clear();
		$this->success('退出成功','/');
	}


	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}