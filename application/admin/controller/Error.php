<?php
namespace app\admin\controller;
use think\Controller;

class Error extends Controller
{
	//空操作
	public function _empty()
	{
		$this->redirect('http://angel.qvbilam.xin');
	}
}