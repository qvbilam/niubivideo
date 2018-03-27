<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Video;
class Video extends Controller
{
	public function aIndex()
	{
		return view();
	}
	public function videoAdd()
	{
		$vi = new Video();
		//视频板块
		$vbank = $vi->vbank();
		$this->assign('vbank',$vbank);
		return view();
	}
	public function videoAddDo()
	{
		//dump(input());
		$vi = new Video();
		$videoadd = $vi->videoadd();
		if($videoadd){
			$this->success('添加视频成功','admin/manage/tovideomanage');
		}else{
			$this->error('添加视频失败');
		}
		//dump(input());
	}
}