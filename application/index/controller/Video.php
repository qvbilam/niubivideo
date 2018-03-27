<?php
namespace app\index\controller;
use think\Controller;
use \app\index\model\Video;
use \app\index\model\Vdanmu;
use \app\index\model\Vpost;
use \app\index\model\Vback;
use \app\index\model\Vbank;
use \app\index\model\Vplace;
use \app\index\model\Vclass;
use \app\index\model\Vstyle;
use \app\index\model\Vtovideo;

class Video extends Controller
{
	//List页面
	public function list($id)
	{
		$vp = new Vplace();
		$vb = new Vbank();
		$vc = new Vclass();
		$vs = new Vstyle();
		$vt = new Vtovideo();
		$vi = new Video();
		$vbank = $vb->bname();//视频类别
		$thisb = $vb->thisb($id);//视频类别
		$vclass = $vc->cname($id);//视频类别
		$vstyle = $vs->sname($id);//视频地点
		$vplace = $vp->pname($id);//视频地点
		$video = $vt->list($id);//视频
		$page = $video->render();
		$this->assign('page',$page);
		$this->assign('thisb',$thisb);
		$this->assign('vbank', $vbank);
		$this->assign('vclass', $vclass);
		$this->assign('vstyle', $vstyle);
		$this->assign('vplace', $vplace);
		$this->assign('video', $video);
		//统计视频数
		$num = $vi->listnum();
		$mark = $vi->listmark();
		$this->assign('num',$num);
		$this->assign('mark',$mark);
		//查看是否完结
		$end = $vt->listend();
		$this->assign('end',$end);
		//var_dump($mark);
		return view();
	}
	public function videoInsert()//视频添加
	{
		return view();
	}
	public function videoInsertDo()//视频添加执行
	{
		$vi = new Video();
		$video = $vi->videoadd();
		echo json_encode($video);
	}
	public function videoPlay($vid)
	{
		$vb = new Vbank();
		$vbank = $vb->bname();//视频类别
		$this->assign('vbank', $vbank);
		$vi = new Video();
		//获得本次的视频
		$video = $vi->videoPlay($vid);
		$this->assign('video',$video);
		$this->assign('vid',$vid);
		//增加点击次数
		$play = $vi->playadd($vid);
		//获取评论
		$po = new Vpost();
		$post = $po->postSelect($vid);
		$this->assign('vpost',$post);
		$page = $post->render();
		$this->assign('page',$page);
		//获取回复
		$ba = new Vback();
		$back = $ba->backSelect($vid);
		$this->assign('vback',$back);
		//上一级
		$xiangguan = $vi->other($vid);
		$this->assign('prev',$xiangguan['prev']);
		$this->assign('next',$xiangguan['next']);
		return view();
	}
	public function getDanmu($vid)//获得弹幕
	{
		$vdm = new Vdanmu();
		$danmu = $vdm->getDanmu($vid);
		echo $dm = json_encode($danmu);
	}
	public function addDanmu($vid)//插入弹幕
	{
		$vdm =new Vdanmu();
		$danmu = $vdm->addDanmu($vid);
	}
}
