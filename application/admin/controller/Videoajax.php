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
class Videoajax extends Controller
{
	public function videoajax()
	{
		$vb = new Vbank();
		$vc = new Vclass();
		$vs = new Vstyle();
		$vp = new Vplace();
		$bank = $vb->ajax();
		$data = [
			'bank'  => $bank,
			'class' => $vc->ajax(),
			'style' => $vs->ajax(),
			'place' => $vp->ajax(),
		];
		$data = json_encode($data,JSON_UNESCAPED_UNICODE);
		echo $data;
	}
	public function videonumajax()
	{
		$vi = new Video();
		$num = $vi->numajax();
		echo json_encode($num);
	}
	public function tovideo()
	{
		$vt = new Vtovideo();
		$vto = $vt->manage();
		echo json_encode($vto,JSON_UNESCAPED_UNICODE);
	}
	public function clickBank()
	{
		$vt = new Vtovideo();
		$vto = $vt->clackBank(); 
		echo json_encode($vto,JSON_UNESCAPED_UNICODE);
	}
	public function clickClass()
	{
		$vt = new Vtovideo();
		$vto = $vt->clackClass(); 
		echo json_encode($vto,JSON_UNESCAPED_UNICODE);
	}
	public function clickStyle()
	{
		$vt = new Vtovideo();
		$vto = $vt->clackStyle(); 
		echo json_encode($vto,JSON_UNESCAPED_UNICODE);
	}
	public function nameAdd()
	{
		$data = input('post.');
		echo json_encode($data);
	}
}