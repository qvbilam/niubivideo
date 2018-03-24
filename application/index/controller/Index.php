<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
   		$this->assign('user',session('user'));
	    return $this->fetch('index');
    } 
    public function code()
    {
    	return $this->fetch();
    }

    //空操作
	public function _empty()
	{
		$this->redirect('/');
	}
}
