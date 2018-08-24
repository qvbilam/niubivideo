<?php
namespace app\index\model;
use think\Db;
use think\Model;




class Vpost extends Model
{
	public function postAdd()
	{
		//取用户ID
		if(!empty(session('name')))
		{
			/*$name = session('name'); 
			$id = Db::name('user')->where(['user'=>$name,'display'=>1])->field('id')->select();
			$uid = $id[0];*/
			$uid = session('uid');
		}else{
			$uid = 0;
		}	
		$vid = input('vid');
		$post = input('post');
		$cou = json_encode($post, JSON_UNESCAPED_UNICODE);
		$countent = trim($cou,'"');
		$time = date('Y-m-d H:i:s',time());
		$data = [
			'uid' => $uid,
			'vid' => $vid,
			'postcountent'=> $countent,
			'posttime' => $time
		];
		$inpost = Db::name('vpost')->insert($data);
		if ($inpost){
			return true;
		}else{
			return false;
		}
	}
	public function postSelect($vid)
	{
		return Db::name('vpost')->where(['vid'=>$vid,'display'=>1])->select();
	}


	/*public function postSelect($vid)
	{
		$data = Db::name('vpost')
			->alias('vp')
			->join('user a','vp.uid=a.uid')
			->join('userinfo f','f.uid=a.uid')
			->where('vid',$vid)
			->field(['user','username','userpic','posttime','postcountent','vp.id'])
			->select();
		return $data;
	}*/
	
}