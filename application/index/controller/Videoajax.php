<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vtovideo;
use app\index\model\Video;
use app\index\model\Vstyle;
use app\index\model\Vpost;
class Videoajax extends Controller
{
	public function zhiding()
	{
		$vi = new Video();
		$num = $vi->countzd();
		if($num < 4){
			$zd = $vi->zhiding();
			if($zd){
				return '置顶成功';
			}
		}else{
			return '置顶数量上限.无法置顶';
		}
	}
	public function quxiao()
	{
		$vi = new Video();
		$video = $vi->quxiao();
		if($video){
			return '取消置顶成功';
		}else{
			return '失败了';
		}
	}
	public function shanchu()
	{
		$vi = new Video();
		$video = $vi->shanchu();
		if($video){
			return '删除成功';
		}else{
			return '失败';
		}
	}
}