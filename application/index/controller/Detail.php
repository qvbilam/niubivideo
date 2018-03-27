<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vtovideo;
use app\index\model\Video;
use app\index\model\Vmark;
use app\index\model\Vbank;
use app\index\model\Vclass;
use app\index\model\Vstyle;
use app\index\model\Vplace;
class Detail extends Controller
{
	public function detail()
	{
		//tovideo插一条
		$vt = new Vtovideo();
		$tovideo = $vt->toVideoOne();
		$this->assign('tovideo',$tovideo);
		//video查tid的的视屏数和统计总数
		$vi = new Video();
		$video = $vi->detail();//视屏数
		$this->assign('video',$video);
		$count = $vi->detailcount();//所有的所有
		$this->assign('count',$count);
		$vone = $vi->videofirs();//第一条哦~
		$this->assign('vone',$vone);
		//查看评分
		$ma = new Vmark();
		$mark = $ma->markOne();
		@$ave = $mark[0]['ave'];
		@$this->assign('ave',$ave);
		$vb = new Vbank();
		$vbank = $vb->Bname();
		$this->assign('vbank',$vbank);
		$vc = new Vclass();
		$vclass = $vc->classname();
		$this->assign('vclass',$vclass);
		$vs = new Vstyle();
		$vstyle = $vs->stylename();
		$this->assign('vstyle',$vstyle);
		$vp = new Vplace();
		$vplace = $vp->pname();
		$this->assign('vplace',$vplace);
		//更多视频
		$id = request()->route('tid');
		$mo = $vt->more($id);
		$this->assign('mo',$mo);
		//视频评分
        $ma = new Vmark();
        $mark = $ma->markSelect();
        $this->assign('mark',$mark);
		return view();
	}
}