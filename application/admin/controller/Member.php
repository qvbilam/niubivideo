<?php
namespace app\admin\controller;

use app\admin\controller\Admin;
use app\admin\model\User;
use app\admin\model\Vipinfo;
use app\admin\model\History;
use app\admin\model\Integral;
use think\Db;

class Member extends Admin
{
	protected $user;
	protected $history;
	protected $integral;
	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
		$this->history = new History();
		$this->integral = new Integral();
	}

	//用户列表
	public  function memberList()
	{
		$this->selectlist();
		$res =$this->sel("deleteTime is null");	

		$this->assign('res',$res);
		return $this->fetch();
	}

	//修改密码页面
	public function changepassword()
	{
		$res = Db::name('user')->where('uid',input('get.id'))->find();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//修改密码
	public function uppass()
	{
		$res = input();
		$data = Db::name('user')->where('uid',$res['id'])->update(['password'=>md5($res['newpass'])]);
		if ($data == 1) {
			return '修改成功';
		} else {
			return '修改失败';
		}
	}
	//禁止登录
	public function stopmember()
	{
		$res = input('get.id'); 
		$data = $this->user->stopme($res,1);
		return $data;
	}
	//允许登陆
	public function startmember()
	{
		$res = input('get.id'); 
		$data = $this->user->stopme($res,0);
		return $data;
	}

	//软删除 用户
	public function softdel()
	{
		$res = input('get.id');
		$data = User::destroy($res);
		return $data;
	}
	//批量软删除 用户
	public function dellists()
	{
		$res = input('post.');
		foreach ($res['data'] as $value) {
			if (!empty($value)){
				$data = User::destroy($value);
			}	
		}
	}

	//删除的用户页面
	public function memberDel()
	{
		$this->selectlist();
		$res = $this->sel("deleteTime is not null");
		$this->assign('res',$res);
		return $this->fetch();
	}

	//删除还原
	public function memberres()
	{
		$res = input('get.id');
		$data = $this->user->soft($res,null);
		return $data;
	}


	//彻底删除
	public function deleteme()
	{
		$res = input('get.id');
		$data = $this->user->deletemember($res);
		return $data;
	}

	//批量彻底删除
	public function deldels()
	{
		$res = input('post.');
		foreach ($res['data'] as $val) {
			if (!empty($val)) {
				$data = $this->user->deletemember($res);
			}			
		}
		return 1;
	}
	//VIP用户列表
	public function memberVipList()
	{
		$this->selectlist();
		$res = $this->vipsel();
		$this->assign('res',$res);
		return $this->fetch();
	}


	//积分详情页面
	public  function memberScoreoperation()
	{
		$this->selectlist();
		$list = $this->integral->selintegral();
		$page = $list->render();
		$this->assign('list',$list);
		$this->assign('page',$page);
		return $this->fetch();
	}

	//观看记录
	public  function memberRecordBrowse()
	{
		$this->selectlist();
		$res = $this->history->selrec();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//删除观看记录
	public function delrec()
	{
		$res = input('post.id');
		$data = History::destroy($res);
		echo 1;
	}

	//批量删除观看记录
	public function delrecs()
	{
		$res = input('post.');
		foreach ($res['data'] as $value) {
			if (!empty($value)){
				$data = History::destroy($value);
			}	
		}
		return 1;
	}
	//查询用户
	protected function sel($res)
	{	
		$res = Db::name('user')
			->alias('a')
			->join('userinfo b','a.uid=b.uid')
			->where($res)
			->select();
		return $res;	
	}

	//查询vip用户
	protected function vipsel ()
	{
		$res = Db::name('user')
			->alias('a')
			->join('vipinfo v','v.uid = a.uid')
			->where('v.deleteTime is Null')
			->select();	
		return $res;
	}

	//删除vip用户(软删除)
	public function delvip()
	{
		$res = input('get.id');
		$data = vipinfo::destroy($res);
		return $data;
	}

	//停用会员
	public function stopexpire()
	{
		$res = input('get.id');
		$data = Db::name('vipinfo')->where('id',$res)->update(['expire'=>1]);
		return $data;
	}

	//启用会员
	public function startexpire()
	{
		$res = input('get.id');
		$data = Db::name('vipinfo')->where('id',$res)->update(['expire'=>0]);
		return $data;
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}