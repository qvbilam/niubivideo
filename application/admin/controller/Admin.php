<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\Auth;

class Admin extends Controller
{
	public function _initialize()
	{	
		session('name','admin');
		$rold_id = Db::name('user')->where('user',session('name'))->value('roldid');
		session('rold_id',$rold_id);
		//查询当前的操作
		$request = Request::instance();
		$now = $request->controller() . '-' . $request->action();
		//默认没有限制访问的方法
		$allow_ac = ['Index-index'];
		//查询role里的auth_ac(查询有没有权限访问)
		$res = Db::name('rold')->where('id',$rold_id)->value('auth_ac');
		//判断有没有访问权限
		dump(session('name'));
		dump($now);
		dump($allow_ac);
		dump(in_array($now,$allow_ac));
		dump(strpos($res,$now));
		if (session('name') != 'admin' && !in_array($now,$allow_ac) && !strpos($res,$now) ) {
		
			$this->error('无权限','/');
		}
	}

	public function selectlist()
	{
		if(session('name') == 'admin') {
			$listc = Db::name('auth')->where('pid=0')->select();
			$lista = Db::name('auth')->where('pid!=0')->select();
			
		} else {
			$res = Db::name('rold')->where('id',session('rold_id'))->value('auth_ids');
			$listc = Db::name('auth')->where('pid=0')->where("id in ($res)")->select();
			$lista = Db::name('auth')->where('pid!=0')->where("id in ($res)")->select();
		}
		
		$this->assign('listc',$listc);
		$this->assign('lista',$lista);
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}