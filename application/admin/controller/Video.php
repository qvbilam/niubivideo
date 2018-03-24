<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Video;
class Video extends Controller
{
	public function index()
	{
		return view();
	}
	public function dmadmin()
	{
		$vi = new Video();
		$vbank = $vi->vbank();
		$this->assign('vbank',$vbank);
		return view();
	}
}