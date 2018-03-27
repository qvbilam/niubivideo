<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Vbank;
use app\admin\model\Vclass;
use app\admin\model\Vstyle;
use app\admin\model\Vplace;
use app\admin\model\Video;
use app\admin\model\Vtovideo;
use app\admin\model\Vpost;
use app\admin\model\Vback;
use app\admin\model\Vdanmu;
use app\admin\model\User;
class Post extends Controller
{
	public function post()
	{
		//评论
		$vp = new Vpost();
		$vpost = $vp->postAll();
		$this->assign('vpost',$vpost);
		//视频
		$vi = new Video();
		$vvideo = $vi->videoAll();
		$this->assign('vvideo',$vvideo);
		//用户
		$vu = new User();
		$vuser = $vu->userName();
		$this->assign('vuser',$vuser);
		return view();
	}
	public function back()
	{
		$vp = new Vpost();
		$vpost = $vp->postAll();
		$this->assign('vpost',$vpost);
		$vb = new Vback();
		$vback = $vb->backAll();
		$this->assign('vback',$vback);
		$vu = new User();
		$vuser = $vu->userName();
		$this->assign('vuser',$vuser);
		$vi = new Video();
		$vvideo = $vi->videoAll();
		$this->assign('vvideo',$vvideo);
		return view();
	}
	public function danmu()
	{
		$vd = new Vdanmu();
		$vdanmu = $vd->danmuAll();
		$this->assign('vdanmu',$vdanmu);
		$vu = new User();
		$vuser = $vu->userName();
		$this->assign('vuser',$vuser);
		$vi = new Video();
		$vvideo = $vi->videoAll();
		$this->assign('vvideo',$vvideo);
		return view();
	}
	public function recycle()
	{
		$vu = new User();
		$vuser = $vu->userName();
		$this->assign('vuser',$vuser);
		$vi = new Video();
		$vvideo = $vi->videoAll();
		$this->assign('vvideo',$vvideo);
		$vp = new Vpost();
		$vpost = $vp->recycle();
		$this->assign('vpost',$vpost);
		return view();
	}
}