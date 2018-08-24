<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vshoucang extends Model
{
	public function scadd()
	{
		$vid = input('vid');
		$name = session('name');
		$uid = Db::name('user')->where('user',$name)->value('uid');
		$sc = Db::name('vshoucang')->where('uid',$uid)->value('vid');
		if(empty($sc)){
			$data = ['uid'=>$uid,'vid'=>$vid];
			$res = Db::name('vshoucang')->insert($data);
		}else{
			$sc .= ",$vid";
			$data = ['vid'=>$sc];
			$res = Db::name('vshoucang')->where('uid',$uid)->update($data);
		}
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function scsel($vid)
	{
		$name = session('name');
		$uid = Db::name('user')->where('user',$name)->value('uid');
		$sc = Db::name('vshoucang')->where('uid',$uid)->value('vid');
		$arr = explode(',', $sc);
		$res = array_search($vid, $arr);
		if(empty($res)){
			return 0;
		}else{
			return 1;
		}
	}
	public function scremove()
	{
		$vid = input('vid');
		$name = session('name');
		$uid = Db::name('user')->where('user',$name)->value('uid');
		$video = Db::name('vshoucang')->where('uid',$uid)->value('vid');
		$arr = explode(',', $video);
		$key = array_search($vid, $arr);
		if($key !== false){
			array_splice($arr, $key,1);
		}
		$data = implode(",", $arr);
		$res = Db::name('vshoucang')->where('uid',$uid)->update(['vid'=>$data]);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}

	//查询收藏
	public function selshoucang()
	{
		$res = Db::name('Vshoucang')
			->where('uid',session('uid'))
			->value('vid');
		$arr = explode(',', $res);
		$data = [];
		foreach ($arr as $k =>$value) {
			$data[$k] = Db::name('video')->where('id',$value)->find();
		}
		return $data;
	}
}