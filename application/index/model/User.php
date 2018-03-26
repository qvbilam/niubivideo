<?php

namespace app\index\model;
use app\index\model\Userinfo;
use think\Model;
use think\Db;
use duanxin\Ucpaas;
use think\Session;


class User extends Model
{
	//登陆判断页面
	public function dologin($data)
	{
		$res = Db::name('user')
			->where('user',$data['user'])
			->find();
		if (!$res) {
			return "用户名不存在";
		} else if ($res['password'] != md5($data['password'])) {
			return "用户名密码不对";
		} else if ($res['islog'] != 0 ) {
			return "用户被限制登录";
		}
		session('name',$data['user']);
		return 0;		
	}

	//手机短信验证
	public function phone($data)
	{
		$res = Db::table('damowang_user')
				->where('phone',$data)
				->find();
		/*if (!$res) { 
			return '手机号已存在';
		}*/
		$options['accountsid']='fdd76caa9175ab6d30da2e281e1372ee';
		$options['token']='61995aa241a28e7efed581f92809b9eb';
		$ucpaas = new Ucpaas($options);
		$appid = "4bebc7fea3084c4cb2fe8be1c262d8dd";	//应用的ID，可在开发者控制台内的短信产品下查看
		$templateid = "272080"; 
		$str = '0123456789';
		$str=str_shuffle($str);
		$res = substr($str,0,6);				   
		//可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
		$param = $res; 
		session($data,$res);
		//多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
		$mobile = $data;
		$uid = "";

		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

		$res = $ucpaas->SendSms($appid,$templateid,$param,$mobile,$uid);
		var_dump($res['code']);
	}

	//注册页
	public function doregister($data)
	{
		if ($data['yzm'] != session($data['phone'])) {
			return 3;
		}
		$array = [];
		$array['regtime'] = time();
		$array['password'] = md5($data['password']);
		$array['user'] = $data['user'];
		$res = Db::name('user')
				->insert($array);
		if ($res == 1) {
			session('name',$array['user']);
			return 1;
		} else {
			return 0;
		}
	}

	//user 与 userInfo 关联
	public function userinfo ()
	{
		return $this->hasOne('Userinfo','uid');
	}

	//user 查询个人信息
	public function geren()
	{	
		$res = $this->where('user',session('name'))->find();
		$res1 =$res->toarray();
		$res2 = $res->userinfo->toarray();
		return array_merge($res1,$res2);
	}


	public function dopass($data)
	{
		$res = Db::name('user')->where('user',session('name'))->find();
		$data['newpass'] = md5($data['newpass']);
		$data['password'] = md5($data['password']);
		if ($res['password'] == $data['password']) {
			$set = Db::name('user')->where('uid',$res['uid'])->update(['password'=>$data['newpass']]);
			if ($set) {
				return '1';
			} else {
				return '2'; 
			}
		} else {
			return '0';
		}
	}


	public function addphone($data)
	{
		/*if ($data['yzm'] != Session::pull($data['phone'])) {
			return '验证码不对';
		} */
		$res =  $this->where('user',session('user'))->update(['phone'=>$data['phone']]);
		return $res;
	}

	//第三方登陆
	public function disan($data)
	{
		$arr = [];
		//插入到user表中
		$arr['user'] = $data['uniq'];
		$arr['username'] = $data['name'];
		$arr['source'] = $data['from'];
		$arr['regtime'] = time();
		$res = $this->save($arr);
		$uid = $this->uid;
		//插入到userinfo表中
		$info = [];
		$info['sex'] = $data['sex'];
		$info['userpic'] = $data['img'];
		$info['uid'] = $uid;
		$userinfo = new Userinfo();
		$str = $userinfo->save($info);
		return $res;
	}
}
