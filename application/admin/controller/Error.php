<?php

namespace app\admin\controller;

use think\Contriller;

class Error extends Controller
{
	//空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}