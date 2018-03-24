<?php

namespace app\index\model;
use think\Model;
use think\Db;
use think\Validate;

class Feed extends Model
{
	public function addPing($data)
	{
		$validate = new Validate([
			'captcha|验证码'=>'require|captcha'
		]);
		$res = [
			'captcha' => $data['yzm']
		];
		if(!$validate->check($res)){
			return '验证码输入失败';
		};
		$res = Db::name('feed')->where('user',session('user'))->value('tijiaotime');
		if (time()-$res < 86400) {
			return "每二十四小时只能反馈一次";
		}
		$data['tijiaotime'] = time();
		$data['user'] = 'admin';
		 $res =$this->allowfield(true)->save($data);
		 if ($res == 1) {
		 	return "反馈成功" ;
		 } else {
		 	return "反馈失败";
		 }
		

	}
			
}