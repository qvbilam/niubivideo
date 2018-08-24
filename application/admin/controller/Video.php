<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Video as Videomodel;
class Video extends Controller
{
	public function aIndex()
	{
		return view();
	}
	public function videoadd()
	{
		$vi = new Videomodel();
		//视频板块
		$vbank = $vi->vbank();
		$this->assign('vbank',$vbank);
		return view();
	}
	public function videoAddDo()
	{
		//dump(input());
		$vi = new Videomodel();
		$videoadd = $vi->videoadd();
		if($videoadd){
			$this->success('添加视频成功','admin/manage/tovideomanage');
		}else{
			$this->error('添加视频失败');
		}
		//dump(input());
	}
}