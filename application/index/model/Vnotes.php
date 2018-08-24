<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vnotes extends Model
{
	//增加
	public function notesadd($vid)
	{  
		$name = session('name');
		$uid = Db::name('user')->where('user',$name)->value('uid');//当前登录的用户
		$sel = Db::name('vnotes')->where('uid',$uid)->value('vid');//查这个id有没有登录记录
		//dump($sel);
		if(empty($sel)){
			Db::name('vnotes')->insert(['uid'=>$uid,'vid'=>$vid]);
		}else{
			//清除重复的

			$arr = explode(',', $sel);

			$key = array_search($vid, $arr);

			if($key !==false){
				array_splice($arr, $key,1);		
			}
			
			//array_push($arr, $vid);
			
			//超过十条删除
			$num = count($arr);

			if($num > 9){
				array_shift($arr);
			}
			array_push($arr, $vid);
			$video = implode(',', $arr);
			//file_put_contents('2.txt', $arr);
			$res = Db::name('vnotes')->where('uid',$uid)->update(['vid'=>$video]);
			return Db::getLastSql();
		}
		
		
	}

	//历史记录
	public function selnotes()
	{
		$res = Db::name('Vnotes')
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