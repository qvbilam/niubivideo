<?php

namespace app\index\model;
use app\index\model\Userinfo;
use think\Model;
use think\Db;
use duanxin\Ucpaas;
use think\Session;
use phpmailer\PHPMailer;
use phpmailer\SMTP;



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
		session('uid',$data['uid']);
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

	//修改密码
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

	//添加手机号
	public function addphone($data)
	{
		if ($data['yzm'] != Session::pull($data['phone'])) {
			return '验证码不对';
		} 
		$res =  $this->where('user',session('user'))->update(['phone'=>$data['phone']]);
		if ($res == 0) {
			return 1;
		}
		$arr = [];
    	$arr['intexotime'] = time();
    	$arr['uid'] = session('uid');
    	$arr['intchange'] = 50;
    	$arr['remark'] = '第一次绑定手机号，+50积分';
    	$arr['bianhua'] = 'add';
    	$set = Db::name('integralinfo')->insert($arr);
    	if ($set == 0) {
    		return 2;
    	}
    	$num = Db::name('integral')->where('uid',session('uid'))->value('number');
    	$num = $num + 50;
    	$str = Db::name('integral')->where('uid',session('uid'))->update(['number'=>$num]);
    	if ($str == 0 ) {
    		return 3;
    	} 
		return 0;
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
		session('uid',$uid);
		session('name',$arr['user']);
		//插入到userinfo表中
		$info = [];
		$info['sex'] = $data['sex'];
		$info['userpic'] = $data['img'];
		$info['uid'] = $uid;
		$userinfo = new Userinfo();
		$str = $userinfo->save($info);
		return $res;
	}

	//发送邮箱验证码
	public function send($data)
	{
        
       
        $email =$data;
       
            $subject='大魔王影院邮箱绑定';
            $str =mt_rand(100000, 999999);
            $content="尊敬的大魔王影院，本次的验证码是 $str 请勿转告他人，祝生活愉快";
            $res = sendMail($email,$subject,$content);
            if ($res) {
               session('email',$str);
            }
        }
            
    //邮箱绑定
    public function addemail($data)
    {
    	
    	if ($data['yzm'] != session('email') ) {
    		return '验证码输入错误';
    	}
    	//查询邮箱是否绑定
    	$str = Db::name('userinfo')->where('uid',session('uid'))->value('email');
    	$addji = 0;
    	//第一次绑定邮箱，增加30积分
    	if (!empty($str)) {
    		$addji = 30;
    	}
    	//修改邮箱
    	$res = Db::name('userinfo')->where('uid',session('uid'))->update(['email'=>$data['email']]);
    	if ($res == 0) {
    		return 1;
    	}	
    	//判断是否第一次绑定邮箱
    	if ($addji == 0) {
    		return 0;
    	}
    	//增加积分
    	$arr = [];
    	$arr['intexotime'] = time();
    	$arr['uid'] = session('uid');
    	$arr['intchange'] = $addji;
    	$arr['remark'] = '第一次绑定邮箱，+30积分';
    	$arr['bianhua'] = 'add';
    	$set = Db::name('integralinfo')->insert($arr);
    	if ($set == 0) {
    		return 2;
    	} 
    	$num = Db::name('integral')->where('uid',session('uid'))->value('number');
    	$num = $num + $addji;
    	$dis = Db::name('integral')->where('uid',session('uid'))->update(['number'=>$num]);
    	if ($dis == 1) {
    		return 0;
     	} else {
     		return 3;
     	}
    }

    //找回密码
    public function forgot($data)
    {
    	$phone =$data['phone'];
    	//查找手机号
    	$res = $this->where('phone',$phone)->find();
    	if (empty($res)) {
    		return 2;
    	} 
    	//判断验证码
    	if($data['yzm'] != session($phone)) {
    		return 3;
    	}
    	//修改密码
    	$pass = md5($data['pass']);
    	$res = $this->where('phone',$phone)->update(['password'=>$pass]);
    	return $res;
    }


}
