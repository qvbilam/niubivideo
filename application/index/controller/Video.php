<?php
namespace app\index\controller;
use think\Controller;
use \app\index\model\Video as Videomodel;
use \app\index\model\Vdanmu;
use \app\index\model\Vpost;
use \app\index\model\Vback;
use \app\index\model\Vbank;
use \app\index\model\Vplace;
use \app\index\model\Vclass;
use \app\index\model\Vstyle;
use \app\index\model\Vtovideo;
use \app\index\model\Vshoucang;
use \app\index\model\Vnotes;
use \app\index\model\User;
use \think\Db;
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
		$vi = new Videomodel();
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
		$vi = new Videomodel();
		$video = $vi->videoadd();
		echo json_encode($video);
	}
	public function videoPlay($vid)
	{
		if (!isset($_SERVER['HTTP_REFERER'])){
			header('location:http://angel.qvbilam.xin');
			die;
		}	
		$vb = new Vbank(); 
		$vbank = $vb->bname();//视频类别
		$this->assign('vbank', $vbank);
		$vi = new Videomodel();
		//获得本次的视频
		$qwe = $vi->videoPlayer($vid);
		$this->assign('video',$qwe);
		$this->assign('vid',$vid);
		//增加点击次数
		$play = $vi->playadd($vid);
		//获取评论
		$po = new Vpost();
		$post = $po->postSelect($vid);
		$this->assign('vpost',$post);	
		//获取回复
		$ba = new Vback();
		$back = $ba->backSelect($vid);
		$this->assign('vback',$back);
		//上一级
		$xiangguan = $vi->other($vid);
		$this->assign('prev',$xiangguan['prev']);
		$this->assign('next',$xiangguan['next']);
		//用户信息
        $uinfo = null;
        if (!empty(session('name'))) {
        	$uinfo = Db::name('user')->where('user',session('name'))->find();
        	$vn = new Vnotes();
        	$vnotes = $vn->notesadd($vid);
        	//dump($vnotes);
        }
        $this->assign('uinfo',$uinfo);
        //看看当前用户有没有收藏这个视屏
        $vsc = new Vshoucang();
        $shoucang = $vsc->scsel($vid);
        $this->assign('shoucang',$shoucang);
        //查看当前视频能否评论
        $post = $vi->post($vid);
        if(!empty($uinfo) && $post){
        	$ispost = 1;
        }else{
        	$ispost = 0;
        }
        $this->assign('ispost',$ispost);
        //查用户和头像
        $us = new User();
        $user = $us->photo();
        //dump($user);
        $this->assign('user',$user);
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
