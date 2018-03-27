<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
	public function index()
	{
		return view();
	}
	public function ceshi()
	{
		$b = Db::name('vstyle')->where('id',1)->select();
		dump($b);
	}
}