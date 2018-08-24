<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Admin;
use app\admin\model\Vbank;
use app\admin\model\Vclass;
use app\admin\model\Vstyle;
use app\admin\model\Vtovideo;
use app\admin\model\Video;
class Manage extends Admin
{
	public function videomanage()
	{
		$this->selectlist();
		//查询所有版块bank
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		//查询所有类别class
		$vc = new Vclass();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		//查询所有风格style
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$this->assign('vstyle',$vstyle);
		//所有tvideo
		$vt = new Vtovideo();
		$tov = $vt->tovideoAll();
		$this->assign('tov',$tov);
		//分页
		$page = $tov->render();
		$this->assign('page',$page);
		return view();
	}
	public function tovideoManage()
	{
		$this->selectlist();
		$vb = new Vbank();
		$bank = $vb->manage();
		$this->assign('bank',$bank);
		$vc = new Vclass();
		$class = $vc->manage();
		$this->assign('class',$class);

		$vt = new Vtovideo();
		$tov = $vt->manage();
		$page = $tov->render();
		$this->assign('tov',$tov);
		$this->assign('page',$page);
		return view();
	}
	public function classManage()
	{
		$this->selectlist();
		//查询所有版块bank
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		//查询所有类别class
		$vc = new Vclass();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		//查询所有风格style
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$this->assign('vstyle',$vstyle);
		return view();
	}
	public function tovideoDel()
	{
		$vt = new Vtovideo();
		$tov = $vt->tovideoDel();
		echo json_encode($tov,JSON_UNESCAPED_UNICODE);
		//echo 1;
	}
	public function tovideoHuifu()
	{
		$vt = new Vtovideo();
		$tov = $vt->tovideoHuifu();
		echo json_encode($tov,JSON_UNESCAPED_UNICODE);
		//echo 1;
	}
	public function updateManage()
	{
		$vb = new Vbank();
		$bank = $vb->manage();
		$this->assign('bank',$bank);//bank
		$vc = new Vclass();
		$class = $vc->manage();
		$this->assign('class',$class);//class
		$vs = new Vstyle();
		$style = $vs->manage();
		$this->assign('style',$style);//style
		$vt = new Vtovideo();
		$tovideo = $vt->manageOne();
		$vi = new Video();
		$video = $vt->manageVideo();
		$this->assign('video',$video);//video
		$this->assign('tovideo',$tovideo);//tovideo
		return view();
	}
	public function updatetoDo()
	{
		$vt = new Vtovideo();
		$vto = $vt->toMangeUp();
		$url = $_SERVER['HTTP_REFERER'];
		if($vto){
			$this->success('修改视频信息成功',$url);
		}else{
			$this->error('修改视频信息失败');
		}
	}
	public function updateviDO()
	{
		$vi = new Video();
		$video = $vi->videomanageUp(); 	
		$url = $_SERVER['HTTP_REFERER'];
		if($video){
			$this->success('修改视频分集信息成功',$url);
		}else{
			$this->error('修改视频分集信息失败');
		}
	}
	public function classManageUpd()
	{

		return view();
	}
	public function classBig()
	{
		$this->selectlist();
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		$vc = new Vclass();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$this->assign('vstyle',$vstyle);
		return view();
	}
	public function bankpic()
	{
		$vb = new Vbank();
		$bank = $vb->bankpic();
		if($bank){
			$this->success("修改成功");
		}else{
			$this->error("修改失败");
		}
	}
}