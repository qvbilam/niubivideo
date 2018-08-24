<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Vtovideo;
class Tovideoajax extends Controller
{
	public function tovideoajax()
	{
		$vt = new Vtovideo();
		$vto = $vt->ajax();
		echo json_encode($vto);

	}
}