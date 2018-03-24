<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User as UserModel;

class User extends Controller
{
	protected $user;
	public function _initialize()
	{
		$this->user = new UserModel();
		//var_dump($this->user);
	}
	//登录界面
	public function login()
	{
		return $this->fetch('login');
	}

	//登陆执行
	public function dologin()
	{
		$res = $this->user->dologin(input());
		echo $res;
	}

	//短信验证
	public function phone()
	{	
		echo  input('phone');
		die;
		$res = $this->user->phone( input('phone'));
	
	}

	//注册页
	public function register() 
	{
		return $this->fetch();
	}

	//注册执行页
	public function doregister()
	{
		$this->user->doregister(input());
	}

	//找回密码
	public function forgot()
	{
		return $this->fetch('forgot');
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}