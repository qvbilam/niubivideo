<?php
namespace app\admin\controller;

use app\admin\controller\Admin;
use app\admin\model\User;
use app\admin\model\Auth;
use app\admin\model\Rold;
use app\admin\model\Userinfo;
use think\Db;

class AdminList extends Admin
{
	protected $user;
	protected $auth;
	protected $rold;
	public function _initialize()
	{
		$this->user = new User();
		$this->auth = new Auth();
		$this->rold = new Rold();
		$this->userinfo = new userinfo();
	}

	//权限管理
	public function adminPermission ()
	{
		$this->selectlist();
		//父级板块
		$res = Db::name('auth')->where('pid=0')->where('deleteTime is Null')->paginate(1);
		//二级分类
		$auth = Db::name('auth')->where('pid!=0')->where('deleteTime is Null')->select();
		$page = $res->render();		
		$this->assign('page',$page);
		$this->assign('auth',$auth);
		$this->assign('res',$res);
		return $this->fetch();
	}

	//角色管理
	public function adminRole ()
	{
		$this->selectlist();
		//查询所有角色数据
		$res = Db::name('rold')->select();
		$data = Db::name('user')
				->alias('a')
				->join('rold r','a.roldid =r.id ')
				->select();
		$this->assign('data',$data);
		$this->assign('res',$res);
		return $this->fetch();
	}

	//添加角色页面
	public function adminRoleAdd ()
	{
		//一级权限
		$res = Db::name('auth')->where('pid=0')->select();
		//二级权限
		$auth = Db::name('auth')->where('pid!=0')->select();
		$this->assign('auth',$auth);
		$this->assign('res',$res);
		return $this->fetch();
	}

	//添加角色
	public function addrold()
	{
		//添加角色
		$res = $this->rold->addrolds(input());
		echo $res;
	}

	//修改角色页面
	public function adminRoleupdata ()
	{
		//一级权限
		$res = Db::name('auth')->where('pid=0')->select();
		//二级权限
		$auth = Db::name('auth')->where('pid!=0')->select();
		$this->assign('auth',$auth);
		$this->assign('res',$res);
		//获取当前角色ip 
		$id = input('get.id');
		//查询角色拥有权限
		$data = $this->rold->where('id',$id)->find();
		$data['auth_ids'] = explode(',', $data['auth_ids']);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//修改角色
	public function updatarold()
	{
		$data = input('post.');
		$res = $this->rold->updatarolds($data);
		echo $res;

	}

	//管理员列表
	public function adminList ()
	{
		$this->selectlist();
		//查询用户信息
		$res = Db::name('user')
			->alias('a')
			->join('rold r','a.roldid=r.id')
			->where('deleteTime is Null')
			->where('roldid is not null')
			->select();	

		$this->assign('res',$res);
		return $this->fetch();
	}

	//添加管理员页面
	public function adminAdd()
	{
		$res = Db::name('rold')->column('roldname','id');
		$this->assign('res',$res);
		return $this->fetch();
	}

	//添加管理员
	public function addadmin()
	{

		$res = input('post.');
		$res['adtime'] = time();
		//插入数据到user表中
		$this->user->allowField(true)->save($res);
		$str = $this->user->uid;
		$res['uid'] = $str;
		//插入数据到userinfo表中
		$str =$this->userinfo->allowField(true)->save($res);
		if ($str == 1) {
			return '添加成功';
		} else {
			return '添加失败';
		}
	}
	//修改管理员权限页面
	public function adminupdata()
	{
		$id=input('get.id');
		
		$res = Db::name('rold')->column('roldname','id');
		$this->assign('res',$res);
		//查询管理员信息
		$data = Db::name('user')
				->alias('a')
				->join('userinfo b','b.uid=a.uid')
				->where('id',$id)	
				->find();
			
		$this->assign('data',$data);
		return $this->fetch();	
	}

	//软删除管理员
	public function deladmin()
	{
		
		User::destroy(input('get.id'));
	}
	
	//修改管理员信息
	public function updataadmin()
	{
		$data= input();		
		$str = $this->user->allowField(true)->save($data,['uid'=>$data['uid']]);
		$info = $this->userinfo->allowField(true)->save($data,['uid'=>$data['uid']]);
		if ($str == 1 || $info == 1 ) {
			echo '修改成功'; 
		} else {
			echo '修改失败';
		}

	}

	//停用管理员
	public function stopadmin()
	{
		echo input('get.id');
		Db::name('user')->where('uid',input('get.id'))->update(['islog'=>1]);
	}

	//启用管理员
	public function startadmin()
	{
		echo input('get.id');
		Db::name('user')->where('uid',input('get.id'))->update(['islog'=>0]);
	}

	//添加权限节点页面
	public function adminPermissionadd ()
	{
		return $this->fetch();
	}

	//添加权限节点
	public function addauth()	
	{
		input(('post.'));
		$res = $this->auth->addauth(input('post.'));
		return $res;

	}
	//修改权限节点页面
	public function adminPermissionupdata ()
	{
		$data = input('get.id');
		$res = Db::name('auth')->where('id',$data)->find();
		if ($res['level'] == 1 ) {
			$pauthname  = Db::name('auth')->where('id',$res['pid'])->value('authname');
			$this->assign('pauthname',$pauthname);
		}
		$this->assign('res',$res);
		return $this->fetch();
	}

	//修改权限节点
	public function updataauth()
	{
		$res = input('post.');
		$str = $this->auth->allowField(true)->save($res,['id'=>1]);
		if ($str == 1) {
			return '修改成功';
		} else {
			return '修改失败';
		}
	}
	//软删除权限节点
	public function delauth()
	{
		return (Auth::destroy(input('get.id')));
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}