<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Vtovideo extends Model
{
	public function toVideo()
	{
		return Db::name('vtovideo')->where('display',1)->select();
	}
	public function toVideoOne()//detail
	{
		$tid = input('tid');
		return Db::name('vtovideo')->where(['id'=>$tid,'display'=>1])->select();
	}
	public function list($id)
	{
		return Db::name('vtovideo')->where(['display'=>1,'bid'=>$id])->paginate(24);;	
	}
	public function listend()
	{
		return Db::query("select vend,id from damowang_vtovideo");
	}
	public function listAjax($data)
	{
		return Db::name('vtovideo')->where($data)->select();
	}
	public function search()
	{
		$data = input('search');
		$video = Db::name('vtovideo')->where('vname','like',"%$data%")->select();
		if(empty($video)){
			return '第一重滚,我还没有上传《' . $data . '》';//快滚,没有这个视屏
			die();
		}
		$video = Db::name('vtovideo')->where('vname','like',"%$data%")->where('display',1)->select();
		if(empty($video)){
			return '第三重滚,《' . $data . '》已经被管理员删除';//快滚,这集被删除
			die();
		}
		return $video;
	}
	public function more($id)
	{
		$b = Db::name('vtovideo')->where('id',$id)->select();
		$bid =$b[0]['bid'];
		return Db::query("select * from damowang_vtovideo where bid=$bid and display=1 order by rand() limit 5");
	}
	public function huan()
	{
		$id = input('id');
		$b = Db::name('vtovideo')->where('id',$id)->select();
		$bid =$b[0]['bid'];
		return Db::query("select * from damowang_vtovideo where bid=$bid and display=1 order by rand() limit 5");
	}
}