<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as Usermodle;

class User extends Controller
{
	public function login()
	{
		return $this->fetch();
	}

	public function dologin()
	{
		
		$res = input();
		$user = new Usermodle();
		$data = $user->dologin($res);
		return 1;
		//return $data;
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}