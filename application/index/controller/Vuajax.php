<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Vuajax extends Controller
{
	public function login()
	{
		if(empty(session('name')))
		{
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
	}
	public function vip()
	{
		$res = Db::name('user')->where(['user'=>session('name'),'isvip'=>1])->select();
		if($res){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}
}