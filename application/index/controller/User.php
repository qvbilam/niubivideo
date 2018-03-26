<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User as UserModel;
use sanfangdenglu\Open;
use think\Db;

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
		$data = input();
		$res = $this->user->doregister($data);
		return $res;
	}

	//判断用户名是否存在
	public function username()
	{

		$res = Db::name('user')->where('user',input('get.user'))->value('uid');

		if (empty($res)) {
			return 1;
		} else {
			return 0;
		}
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


	//第三方登陆
	public function disan ()
	{
		$open = new Open();
		$code = $_GET['code'];
		$data =$open->me($code);
		$res = $this->user->where('user',$data['uniq'])->value('user');
		if (!empty($res)) {
			session('name',$res);	
			$this->success('登陆成功','/');
			echo 1;	
		} else {
			echo 2;
			$this->user->disan($data);
		}
		if ($res == 1) {
			$this->session('登陆成功','/');
		} else {
			$this->error('登陆失败','login');
		}
		
	}
}