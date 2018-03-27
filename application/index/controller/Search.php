<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vtovideo;
use app\index\model\Video;
use app\index\model\Vbank;
use app\index\model\Vclass;
use app\index\model\Vstyle;
use app\index\model\Vpost;
class Search extends Controller
{
	public function search()
	{
		$data = input('search');
		preg_match('/\d+/', $data, $num);//查看有没有集数
		if(!empty($num[0])){
			$name = explode('&', $data);//查看视屏video名字
			$vi = new Video();
			$video = $vi->search($name[0],$num[0]);
			
			if(is_array($video)){
				$id = $video[0]['id'];
				$this->redirect("/videoplay/$id");
				die();
			}else{
				echo "<script>alert('$video');</script>";
				die();
			}
		}else{//走tovideo
			//符合的视频
			$vt = new Vtovideo();
			$vi = new Video();
			$vto = $vt->search();
			$this->assign('vto',$vto);
			//统计视频数
			$num = $vi->listnum();
			$mark = $vi->listmark();
			$this->assign('num',$num);
			$this->assign('mark',$mark);//评分
			//视频第一
			$vfirst = $vi->videoNbOne();
       		$this->assign('vfirst',$vfirst);
       		//板块
       		$vb = new Vbank();
       		$vc = new Vclass();
       		$vs = new Vstyle();
       		$vbank = $vb->Bname();
       		$vclass = $vc->classname();
       		$vstyle = $vs->stylename();
       		$this->assign('vbank',$vbank);
       		$this->assign('vclass',$vclass);
       		$this->assign('vstyle',$vstyle);
			return view();
		}
		
	}
}