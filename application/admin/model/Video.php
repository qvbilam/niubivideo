<?php
namespace app\admin\model;
use think\Db;
use Upyun\Upyun;
use Upyun\Config;
use think\Model;

class Video extends Model
{
	public function vbank()
	{
		$data = Db::query("select * from damowang_vbank");
		return $data;
	}
	public function numajax()
	{
		$num = $_POST['num'];
		return Db::name('video')->field('videonum')->where('videoname',$num)->select();
	}
	public function videoadd()//视频添加
	{
		$createConfig = new Config('damowang', 'h534511019', 'kid123456789');
		$client = new Upyun($createConfig);
		$vbank = input('vbank');//板块
		$vclass = input('vclass');//类别
		$vstyle = input('vstyle');//风格
		$vplace = input('vplace');//产地
		$vname = input('videoname');//名字
		$vpost = input('vpost');//能否评论
		$vip = input('quanxian');//观看是佛免费
		$countent = input('countent');//视频介绍
		$vpic = $_FILES['vpic']['tmp_name'];
		//我的最引以为豪的随机名字
		$string1 = 'qwert';
		$string2 = 'poiuy';
		$sjiname = str_shuffle($string1 . time() . $string2);
		//封面文件上传
		$file = fopen($_FILES['vpic']['tmp_name'], 'r');
		$type = $_FILES['vpic']['type'];//获得类型
		$weizhi = stripos($type, '/') + 1;//最后出现位置+1
		$houzhui = substr($type, $weizhi);//找出后缀		
		$client->write("/video/images/$sjiname." . $houzhui,$file);
		$vpic = "http://damowang.test.upcdn.net/video/images/$sjiname." . $houzhui;
		//视频文件上传
		$file = fopen($_FILES['vsrc']['tmp_name'], 'r');
		$type = $_FILES['vsrc']['type'];//获得类型
		$weizhi = stripos($type, '/') + 1;//最后出现位置+1
		$houzhui = substr($type, $weizhi);//找出后缀
		if ($vbank == 1){
			if(empty(input('num'))){
				$res = $client->createDir('/video/dm/' . $vname);
			}
			$client->write("/video/dm/" . $vname . "/$sjiname." . $houzhui,$file);
			$vsrc = "http://damowang.test.upcdn.net/video/dm/" . $vname . "/$sjiname." . $houzhui;
		}
		if ($vbank == 2){
			if(empty(input('num'))){
				$res = $client->createDir('/video/dy/' . $vname);
			}
			$client->write("/video/dy/" . $vname . "/$sjiname." . $houzhui,$file);
			$vsrc = "http://damowang.test.upcdn.net/video/dy/" . $vname . "/$sjiname." . $houzhui;
		}
		if ($vbank == 3){
			if(empty(input('num'))){
				$res = $client->createDir('/video/dsj/' . $vname);
			}
			$client->write("/video/dsj/" . $vname . "/$sjiname." . $houzhui,$file);
			$vsrc = "http://damowang.test.upcdn.net/video/dsj/" . $vname . "/$sjiname." . $houzhui;
		}
		if(empty(input('num'))){
			$num = 1;
			$todata = [
				'vname' 	=> $vname,	
				'vcountent' => $countent,
				'vpic' 		=> $vpic,
				'vplace' 	=> $vplace,
				'bid' 		=> $vbank,
				'cid' 		=> $vclass,
				'sid' 		=> $vstyle
			];
			Db::name('vtovideo')->insert($todata);
			$userId = Db::name('vtovideo')->getLastInsID();
			$data = [
				'videoname'		=> $vname,
				'tid'			=> $userId,
				'videonum'		=> $num,
				'videocountent'	=> $countent,
				'vsrc'			=> $vsrc,
				'vip'			=> $vip,
				'vpost'			=> $vpost
			];
			$res = Db::name('video')->insert($data);
			if($res){
				return true;
			}else{
				return false;
			}
		}else{
			$num = input('num');
			$toid = Db::name('vtovideo')->field('id')->where('vname',$vname)->select();
			$tid = $toid[0]['id'];
			$data = [
				'videoname'		=> $vname,
				'tid'			=> $tid,
				'videonum'		=> $num,
				'videocountent'	=> $countent,
				'vsrc'			=> $vsrc,
				'vip'			=> $vip,
				'vpost'			=> $vpost
			];
			$res = Db::name('video')->insert($data);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}
	public function videomanageUp()
	{
		$num = array_keys($_FILES['psrc']['error'],0);
		$i = $num[0];
		if($_FILES['psrc']['error'][$i] ==0)
		{
			$createConfig = new Config('damowang', 'h534511019', 'kid123456789');
			$client = new Upyun($createConfig);
			$string1 = 'qwert';
			$string2 = 'poiuy';
			$sjiname = str_shuffle($string1 . time() . $string2);
			//封面文件上传
			$file = fopen($_FILES['psrc']['tmp_name'][$i], 'r');
			$type = $_FILES['psrc']['type'][$i];//获得类型
			$weizhi = stripos($type, '/') + 1;//最后出现位置+1
			$houzhui = substr($type, $weizhi);//找出后缀		
			$client->write("/video/images/$sjiname." . $houzhui,$file);
			$pic = "http://damowang.test.upcdn.net/video/images/$sjiname." . $houzhui;
			$data = [
				'vip' => input('vip'),
				'vpost' => input('vpost'),
				'vpic' => $pic,
			];
		}else{
			$data = [
				'vip' => input('vip'),
				'vpost' => input('vpost'),
			];
		}
		$id = input('id');
		$res = Db::name('video')->where('id',$id)->update($data);
		return Db::getLastSql();
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function videoAll()//post查询使用
	{
		return Db::name('video')->select();
	}
}