<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vtovideo;
use app\index\model\Video;
use app\index\model\Vstyle;
use app\index\model\Vpost;
use app\index\model\Vmark;
use app\index\model\Vshoucang;
use think\Db;
class Ajax extends Controller
{
	public function listAjax()
	{
		
		$str = input('data');
		$cidnum = strpos($str,'c');
		if($cidnum){ $cidnum+=1; }
		$sidnum = strpos($str,'s');
		if($sidnum){ $sidnum+=1; }
		$pidnum = strpos($str,'p');
		if($pidnum){ $pidnum+=1; }
		$bid = substr($str,2,1);	
		$data['bid'] = $bid;	
		$cid = substr($str, $cidnum,1);
		$data['cid'] = $cid;
		$sid = substr($str, $sidnum,1);
		$data['sid'] = $sid;
		$pid = substr($str, $pidnum,1);
		$data['vplace'] = $pid;
		foreach ($data as $k => $v) {
			if($v == '*'){
				unset($data[$k]);
			}
		}
		$vt = new Vtovideo();
		$video = $vt->listAjax($data);
		$vi = new Video();
		$num = $vi->listnum();
		$mark = $vi->listmark();
		$this->assign('video',$video);
		$this->assign('num',$num);
		$this->assign('mark',$mark);
		return view();
		//echo json_encode($vto,JSON_UNESCAPED_UNICODE);
		
		//echo json_encode($data);
	}
	public function styleChange()
	{
		$vs = new Vstyle();
		$vstyle = $vs->styleChange();
		$this->assign('vstyle',$vstyle);
		return view();
	}
	public function huan()
	{
		//更多视频
		$id = request()->route('tid');
		$vt = new Vtovideo();
		$mo = $vt->huan();
		$this->assign('mo',$mo);
		//视频评分
        $ma = new Vmark();
        $mark = $ma->markSelect();
        $this->assign('mark',$mark);
		return view();
	}
	public function scadd()
	{
		$vs = new Vshoucang();
		$vsc = $vs->scadd();
		if($vsc){
			return '收藏成功';
		}else{
			return '收藏失败';
		}
	}
	public function screm()
	{
		$vs = new Vshoucang();
		$vsc =$vs->scremove();
		if($vsc){
			return 1;
		}else{
			return 0;
		}
	}
	public function uservip()
	{
		if(empty(session('name')))
		{
			echo 'error1';
		}else{
			//查看是否是vip
			$vip = Db::name('user')->where('user',session('name'))->value('isvip');
			if($vip == 1){
				echo input('id');
			}else{
				echo 'error2';
			}
		}
	}
}