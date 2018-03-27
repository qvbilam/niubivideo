<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vbank;
use app\index\model\Video;
use app\index\model\Vmark;
use app\index\model\Vtovideo;
class Index extends Controller
{
    public function index()
    {
    	//板块名字
    	$vb = new Vbank();
    	$bank = $vb->Bname();
    	$this->assign('bank',$bank);
        //视屏信息过度
        $vt = new Vtovideo();
        $tovideo = $vt->toVideo();
        $this->assign('tovideo',$tovideo);
    	//视频信息
    	$vi = new Video();
    	$video = $vi->videoOne();
    	$this->assign('video',$video);
        //热播
        $videohot = $vi->videoHot();
        array_shift($videohot);
        $this->assign('videohot',$videohot);
        //热播第一
        $vfirst = $vi->videoNbOne();
        $this->assign('vfirst',$vfirst);
        //视频评分
        $ma = new Vmark();
        $mark = $ma->markSelect();
        $this->assign('mark',$mark);
        return view();
    }
}
