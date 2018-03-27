<?php

namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class User extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';
	public function userinfo ()
	{
		return $this->hasOne('Userinfo','uid');
	}

	//修改用户登录权限
	public function stopme($id,$stop)
	{
		$res = Db::name('user')
			->where('uid',$id)
			->update(['islog'=>$stop]);
		return $res;
	}

	//软删除
	public function soft($id,$time)
	{
		$res = Db::name('user')
			->where('uid',$id)
			->update(['deleteTime'=>$time]);
		return $res;
	}
	
	//彻底删除
	public function deletemember($id)
	{
		//删除userinfo中数据
		$res = Db::name('userinfo')->where('uid',$id)->delete();
		//删除user中数据
		$set = Db::name('user')->where('uid',$id)->delete();
		return $set;
	}
	//post
	public function userName()
	{
		return Db::name('user')->select();
	}

	
}
