<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Userinfo;
use app\index\model\User;
use think\Session;

class Info extends Controller
{
	protected $userInfo;
	protected $user;

	public function _initialize()
	{
		$this->userInfo = new UserInfo();
		$this->user = new User();
	}

	//个人中心
	public function info()
	{
		$res = $this->user->geren();
		$this->assign('res',$res);
		return $this->fetch('information');
	}

	//修改个人资料
	public function doinfo()
	{

		$file = request()->file('file');
		 //	移动到框架应用根目录/public/uploads/ 目录下
		if($file){
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
				// 成功上传后 获取上传信息
				// 输出 jpg
				$info->getExtension();
				// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			$str = $info->getSaveName();
				// 输出 42a79759f284b767dfcb2a0197904287.jpg
				$info->getFilename();
			}else{
				// 上传失败获取错误信息
				echo $file->getError();
			}
		}

		$res=input();
		$arr = [];
		if (!empty($str))  {
			$arr['userpic'] = 'uploads/' . $str;
		}
		//生日日期转换为时间戳
		$str = $res['nian'] . '-' . $res['yue']. '-' . $res['day'];
		$str = strtotime($str);
		//修改昵称
		$data = $res['username'];
		$username = $this->user->where('uid',$res['uid'])->update(['username'=>$data]);
		//建立数组，输入到数据库
		$arr['birthday'] = $str;
		$arr['sex'] = $res['sex'];
		$arr['realname'] = $res['realname'];
		$set = $this->userInfo->where('id',$res['id'])->update($arr);
		$this->success('上传成功','../info');	
	}


	
	//安全设置显示页
	public function safety()
	{
		$res = $this->user->geren();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//修改密码页
	public function password()
	{

		return $this->fetch('password');
	}

	//修改密码执行页
	public function dopass()
	{
		$res = input();
		$data = $this->user->dopass($res);	
		return $data; 
	}


	//绑定手机号
	public function bindphone()
	{
		$res = $this->user->geren();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//添加手机号
	public function addphone()
	{
		$res = input();
		return 1;
		$data = $this->user->addphone($res);
		return $data;
	}

	//修改手机号
	public function upphone()
	{
		$res = input();
		//判断手机号
		if ($res['oldyzm'] != Session::pull($res['oldphone'])) {
			return "旧手机号验证失败";
		} 
		if ($res['newyzm'] != Session::pull($res['newphone'])) {
			return "新手机号验证码不对";
		} 
		//修改手机号
		session('user','admin');
		$data = $this->user->where('user',session('user'))->update(['phone'=>$res['newphone']]);
		return $data;
	}

	//绑定邮箱显示页
	public function email()
	{
		return $this->fetch();
	}



	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}