<?php
namespace app\admin\controller;
use think\Db;
use app\admin\controller\Admin;
use app\admin\model\Vbank;
use app\admin\model\Vclass;
use app\admin\model\Vstyle;
use app\admin\model\Vplace;
use app\admin\model\Video;
use app\admin\model\Vtovideo;
class Manageajax extends Admin
{
	public function video()
	{
		$vt = new Vtovideo();
		$tov = $vt->manageT();
		$this->assign('tov',$tov);
		return view();
	}
	public function banksel()
	{
		$vb = new Vbank();
		$vbank = $vb->banksel();
		echo json_encode($vbank);
	}
	public function bankins()
	{

		$vb = new Vbank();
		$bankadd = $vb->bankadd();
		if($bankadd){
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
			return '添加成功';
		}else{
			return '添加失败';
		}
	}
	public function classsel()
	{
		$vc = new Vclass;
		$vclass = $vc->classsel();
		echo json_encode($vclass);
	}
	public function classins()
	{
		$vc = new Vclass;
		$vclass = $vc->classadd();
		if($vclass){
			return '添加成功';
		}else{
			return '添加失败';
		}
	}
	/*追加风格以下*/
	public function bankchange()
	{
		$vc = new Vclass();
		$vclass = $vc->classchange();
		echo json_encode($vclass,JSON_UNESCAPED_UNICODE);
	}
	public function stylesel()
	{
		$vs = new Vstyle();
		$vstyle = $vs->stylesel();
		echo json_encode($vstyle);
	}
	public function styleins()
	{
		$vs = new Vstyle();
		$vstyle = $vs->styleadd();
		if($vstyle){
			return '添加成功';
		}else{
			return '添加失败';
		}
	}
	public function bankdel()
	{
		$vb = new Vbank();
		$bank = $vb->bankdel();
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
	public function bankhui()
	{
		$vb = new Vbank();
		$bank = $vb->bankhui();
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
	public function classdel()
	{
		$vc = new Vclass();
		$class = $vc->classdel();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$this->assign('vstyle',$vstyle);
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		return view();
	}
	public function classhui()
	{
		$vc = new Vclass();
		$class = $vc->classhui();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$this->assign('vstyle',$vstyle);
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		if($class){
			return view();
		}else{
			return 0;
		}
	}
	public function styledel()
	{
		$vc = new Vclass();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$style = $vs->styledel();//删除
		$this->assign('vstyle',$vstyle);
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		return view();
	}
	public function stylehui()
	{
		$vc = new Vclass();
		$vclass = $vc->manage();
		$this->assign('vclass',$vclass);
		$vs = new Vstyle();
		$vstyle = $vs->manage();
		$this->assign('vstyle',$vstyle);
		$vb = new Vbank();
		$vbank = $vb->manage();
		$this->assign('vbank',$vbank);
		//检查板块是否被禁用
		$bank = $vb->jiancha();
		if(!$bank){
			return 00;die();
		}
		//检查类别是否被禁用
		$class = $vc->jiancha();
		if(!$class){
			return 01;die();
		}
		$style = $vs->stylehui();
		return view();
	}

}