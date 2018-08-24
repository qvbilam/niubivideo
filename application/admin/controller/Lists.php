<?php

namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\Feed;
use think\Db;
use traits\model\SoftDelete;

class Lists extends Admin
{
	//查询评论
	public function feedbackList()
	{
		$this->selectlist();
		$res = Db::name('user')
			->alias('a')
			->join('feed f','f.uid=a.uid')
			->join('userinfo b','b.uid=a.uid')
			->where('f.deleteTime is null')
			->select();
		$this->assign('res',$res);
		return $this->fetch();
	}

	//删除评论
	public function delfeed()
	{
		return (Feed::destroy(input('get.id')));
	}

	//批量软删除评论
	public function datadel()
	{
		
		$res = input('post.');
		foreach ($res['data'] as $val) {
			if (!empty($val)) {
				Feed::destroy($val);
			}			
		}
	}

	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}