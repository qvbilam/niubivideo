<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use Upyun\Upyun;
use Upyun\Config;

class Vtovideo extends Model
{
	public function ajax()
	{
		$name = $_POST['name'];
		$a =Db::name('vtovideo')->where('vname',$name)->select();
		if($a) return 1;
		else return 0;
	}
	public function manage()
	{
		return Db::name('vtovideo')->where('display',1)->paginate(3);
	}
	public function tovideoAll()
	{
		return Db::name('vtovideo')->paginate(5);
	}
	public function tovideoDel()//tovideo删除专用
	{
		$id = input('id');
		$del = Db::name('vtovideo')->where('id',$id)->update(['display' => '0']);
		$del = Db::name('video')->where('tid',$id)->update(['display' => '0']);
		if($del){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function tovideoHuifu()//tovideo恢复专用
	{
		$id = input('id');
		$del = Db::name('vtovideo')->where('id',$id)->update(['display' => '1']);
		$del = Db::name('video')->where('tid',$id)->update(['display' => '1']);
		if($del){
			return '恢复成功';
		}else{
			return '恢复失败';
		}
	}
	public function manageOne()
	{
		$id = input('id');
		return Db::name('vtovideo')->where('id',$id)->select();
	}
	public function manageVideo()
	{
		$id = input('id');
		return Db::name('video')->where('tid',$id)->select();
	}
	public function toMangeUp()
	{
		if($_FILES['pic']['error'] == 0)
		{
			$createConfig = new Config('damowang', 'h534511019', 'kid123456789');
			$client = new Upyun($createConfig);
			$string1 = 'qwert';
			$string2 = 'poiuy';
			$sjiname = str_shuffle($string1 . time() . $string2);
			@$file = fopen($_FILES['pic']['tmp_name'], 'r');
			$type = $_FILES['pic']['type'];//获得类型
			$weizhi = stripos($type, '/') + 1;//最后出现位置+1
			$houzhui = substr($type, $weizhi);//找出后缀		
			@$client->write("/video/images/$sjiname." . $houzhui,$file);
			@$vpic = "http://damowang.test.upcdn.net/video/images/$sjiname." . $houzhui;
			$data = [
				'vname' => input('vname'),
				'vend' => input('vend'),
				'bid' => input('bank'),
				'cid' => input('class'),
				'sid' => input('style'),
				'vpic' => $vpic
			];
		}else{
			$data = [
				'vname' => input('vname'),
				'vend' => input('vend'),
				'bid' => input('bank'),
				'cid' => input('class'),
				'sid' => input('style'),
			]; 
		}
		$id = input('id');
		Db::name('video')->where('tid',$id)->update(['videoname'=>input('vname')]);
		$res = Db::name('vtovideo')->where('id',$id)->update($data);
		if($res){
			return true;
		}else{
			return false;
		}
		
	}
	public function clackBank()
	{
		return Db::name('vtovideo')->where('bid',input('bid'))->select();
	}
	public function clackClass()
	{
		return Db::name('vtovideo')->where('cid',input('cid'))->select();
	}
	public function clackStyle()
	{
		return Db::name('vtovideo')->where('sid',input('sid'))->select();
	}
	/*admin manageajax video 查询*/
	public function manageT()
	{
		$str = input('id');
		return Db::name('vtovideo')->where($str)->select();
	}
}