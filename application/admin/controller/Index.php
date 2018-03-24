<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Rold;
use app\admin\model\Article;
use think\Db;

class Index extends Admin
{
	public function index ()
	{
		$this->selectlist();
		return $this->fetch();
	}

	//资讯管理
	public function articleList()
	{
		$this->selectlist();
		$res = Db::name('article')->where('deleteTime is Null')->select();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//添加资讯展示页面
	public function articleAdd()
	{
		
		return $this->fetch();
	}

	//添加资讯
	public function doarticle()
	{

		dump(input());
		$res = input();
		$res['inttime'] = time();
		$res['uid'] = session('uid');
		$data = Db::name('article')->insert($res);
		if ($data == 1) {
			echo '添加成功';
		} else {
			echo '添加失败';
		}
	}

	//修改资讯页面
	public function articleupdata()
	{
		$res = Db::name('article')->where('id',input('get.id'))->find();

		$this->assign('res',$res);
		return $this->fetch();
	}

	//删除资讯页面
	public function delartic ()
	{
		 return Article::destroy(input('get.id'));
	}

	//发布资讯
	public function startart() 
	{
		Db::name('article')->where('id',input('get.id'))->setField('state',1);
		
	}

	//下架资讯
	public function stopart() 
	{
		Db::name('article')->where('id',input('get.id'))->setField('state',0);
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}