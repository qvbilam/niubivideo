<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vpost;
use app\index\model\Vback;
use app\index\model\User;
class Post extends Controller
{
	public function postAdd()
	{
		$po = new Vpost();
		$post = $po->postAdd();
		$vid = input('vid');
		//获取评论
		$po = new Vpost();
		$post = $po->postSelect($vid);
		$this->assign('vpost',$post);
		//获取回复
		$ba = new Vback();
		$back = $ba->backSelect($vid);
		$this->assign('vback',$back);
		 //查用户和头像
        $us = new User();
        $user = $us->photo();
        //dump($user);
        $this->assign('user',$user);
		return view();	
	}
}