<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Vbank;
use app\admin\model\Vclass;
use app\admin\model\Vstyle;
use app\admin\model\Vtovideo;
use app\admin\model\Video;
use app\admin\model\Vpost;
use app\admin\model\Vback;
use app\admin\model\Vdanmu;
class Postajax extends Controller
{
	public function postdel()
	{
		$vp = new Vpost();
		$post = $vp->postdel();
		echo $post;
	}
	public function backdel()
	{
		$vp = new Vback();
		$post = $vp->backdel();
		echo $post;
	}
	public function danmudel()
	{
		$vp = new Vdanmu();
		$post = $vp->danmudel();
		echo $post;
	}
	public function huifu()
	{
		$vp = new Vpost;
		$vb = new Vback;
		$vd = new Vdanmu;
		if(input('type') == 'p'){
			$hui = $vp->huifu();
		} 
		if(input('type') == 'b'){
			$hui = $vb->huifu();
		} 
		if(input('type') == 'd'){
			$hui = $vd->huifu();
		} 
		if($hui){
			return '成功';
		}else{
			return '失败';
		}
	}
}