<?php

namespace app\index\model;
//系统下的魔性
use think\Model;
use think\Db;
use Upyun\Upyun;
use Upyun\Config;
class Video extends Model
{
	public function videoPlay($vid)
	{
		return Db::name('video')->where('id',$vid)->select();
	}
	public function videoOne()
	{
		return Db::name('video')->select();
	}
	public function detail()//detail->where(id=tid)->all
	{
		$tid = input('tid');
		return Db::name('video')->where(['tid'=>$tid,'display'=>1])->select();
	}
	public function detailcount()//detail-count->上一个方法
	{
		$tid = input('tid');
		return Db::name('video')->where('tid',$tid)->count('tid');
	}
	public function videofirs()//detail->第一集
	{
		$tid = input('tid');
		return Db::name('video')->where('tid',$tid)->find();
	}
	public function playadd($vid)
	{
		$playnum = Db::name('video')->where('id',$vid)->field('play')->select();
		$num = $playnum[0]['play'];
		if($num){
			$num = $num + 1;
			$data = ['play' => $num];
		}else{
			$data = ['play' => 1];
		}
		return Db::name('video')->where('id',$vid)->update($data);

	}
	public function videoadd()
	{
		//我的最引以为豪的随机名字
		$string1 = 'qwert';
		$string2 = 'poiuy';
		$sjiname = str_shuffle($string1 . time() . $string2);
		$createConfig = new Config('damowang', 'h534511019', 'kid123456789');
		$client = new Upyun($createConfig);
		//后台直接传方式
		$file = fopen($_FILES['video']['tmp_name'], 'r');
		$type = $_FILES['video']['type'];//获得类型
		$weizhi = stripos($type, '/') + 1;//最后出现位置+1
		$houzhui = substr($type, $weizhi);//找出后缀
		$in = $client->write("/video/dm/$sjiname." . $houzhui,$file);
		//ajax传方式
		/*return $_POST['vsrc'];
		$file = fopen($_POST['vsrc'],'r');//字符串"C:\\fakepath\\1.mp4"
		$weizhi = stripos($file, '.') + 1;
		$houzhui = substr($file, $wzhi);
		$in = $client->write("/video/dm/$sjiname." .$houzhui,$file);*/
	}
	public function videoHot()
	{
		return Db::name('video')->order('play','desc')->where('display',1)->limit(9)->select();
	}
	public function videoNbOne()
	{
		return Db::name('video')->order('play','desc')->where('display',1)->limit(1)->select();
	}
	public function listnum()
	{
		 return Db::query("select tid,count(tid) as count from damowang_video group by tid");
	}
	public function listmark()
	{
		return Db::query("select tid,ave from damowang_vmark");
	}
	/********************** video ajax专用 *******************************/
	public function countzd()
	{ 
		return DB::name('video')->where('top',1)->count('id');
	}
	public function zhiding()
	{
		$id = input('id');	
		return Db::name('video')->where('id',$id)->update(['top'=>1]);
	}
	public function quxiao()
	{
		$id = input('id');
		return Db::name('video')->where('id',$id)->update(['top'=>0]);
	}
	public function shanchu()
	{
		$id = input('id');
		return Db::name('video')->where('id',$id)->update(['display'=>0]);
	}
	public function search($name,$num)
	{
		$videoname = Db::name('video')->where('videoname',$name)->select();
		if(!$videoname){
			return '第一重滚,我还没有上传《' . $name . '》';//快滚,没有这个视屏
			die;
		}
		$videoname = Db::name('video')->where(['videoname'=>$name,'videonum'=>$num])->select();
		if(!$videoname){
			return '第二重滚,我没有上传《' . $name . '的第' . $num . '集》';//快滚,没有这集
			die;
		}
		$videoname = Db::name('video')->where(['videoname'=>$name,'videonum'=>$num,'display'=>1])->select();
		if(!$videoname)
		{
			return '第三重滚,《' . $name . '的第' . $num . '集》已经被管理员删除';//快滚,这集被删除
			die;
		}
		return $videoname;
		//return $name;
	}
	public function other($vid)
	{
		$t = Db::name('video')->where('id',$vid)->select();
		$tid = $t[0]['tid'];//查到该视频的tid
		$num = $t[0]['videonum'];//查到该视频的集数
		$shang = $num-1;
		$xia = $num+1;
		$prev = Db::name('video')->where(['tid'=>$tid,'videonum'=>$shang,'display'=>1])->select();
		$next = Db::name('video')->where(['tid'=>$tid,'videonum'=>$xia,'display'=>1])->select();
		$arr['prev'] = $prev;
		$arr['next'] = $next;
		return $arr;
	}
}