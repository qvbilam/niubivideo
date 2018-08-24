<?php

namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use think\Validate;

class User extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';
	public function userinfo ()
	{
		return $this->hasOne('Userinfo','uid');
	}

	//修改用户登录权限
	public function stopme($id,$stop)
	{
		$res = Db::name('user')
			->where('uid',$id)
			->update(['islog'=>$stop]);
		return $res;
	}

	//软删除
	public function soft($id,$time)
	{
		$res = Db::name('user')
			->where('uid',$id)
			->update(['deleteTime'=>$time]);
		return $res;
	}
	
	//彻底删除
	public function deletemember($id)
	{
		//删除userinfo中数据
		$res = Db::name('userinfo')->where('uid',$id)->delete();
		//删除user中数据
		$set = Db::name('user')->where('uid',$id)->delete();
		return $set;
	}

	//评论
	public function userName()
	{
		return Db::name('user')->select();
	}

	//判断登陆
	public function dologin($data)
	{
		
		$validate = new Validate([
			'captcha|验证码'=>'require|captcha'
		]);
		$res = [
			'captcha' => $data['yzm']
		];
		if(!$validate->check($res)) {
		return  '验证码输入有误';
		} 
		$res = $this->where('user',$data['user'])->find();
		if (empty($res)) {
			return '用户名不存在';
		} else if ($res['password'] != md5($data['password'])) {
			return '密码不正确';
		}
		session('name',$data['user']);
		session('uid',$res['uid']);
		return '1';
	}	

	
}
