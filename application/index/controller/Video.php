<?php
namespace app\index\controller;
use think\Controller;
use \app\index\model\Video;
use \app\index\model\Danmu;
use Upyun\Upyun;
use Upyun\Config;
class Video extends Controller
{
	//List页面
	public function list()
	{
		//$vi = new Video();//视频标签
		$vi = new Video();
		$vclass = $vi->vclass();//视频类别
		$vplace = $vi->vplace();//视频地点
		$video = $vi->video();//视频
		$this->assign('vclass', $vclass);
		$this->assign('vplace', $vplace);
		$this->assign('video', $video);
		//dump($vi->toArray());
		return view();
	}
	public function videoInsert()
	{
		return view();
	}
	public function videoInsertDo()
	{
		$createConfig = new Config('damowang', 'h534511019', 'kid123456789');
		$client = new Upyun($createConfig);
		var_dump($_POST);
		var_dump($_FILES);
		//$file = fopen('ceshi.txt', 'r');
		//$res = $client->write('/3.txt', $file);
	}
	public function videoPlay($vid)
	{
		$vi = new Video();
		$video = $vi->video($vid);
		$this->assign('video',$video);
		return view();
	}
	public function getDanmu($vid)
	{
		$vdm = new Danmu();
		$danmu = $vdm->getDanmu($vid);
		echo $dm = json_encode($danmu);
	}
	public function addDanmu($vid)
	{
		$vdm =new Danmu();
		$danmu = $vdm->addDanmu($vid);
	}



	public function get()
	{
		//调用静态方法
		$res=Video::get(1);
		dump($res);
	}
}