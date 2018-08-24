<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vmark extends Model
{
	public function markAdd()
	{
		/*获得当前登录用户的id*/
		$vid = input('vid');
		$t = Db::name('video')->where('id',$vid)->field('tid')->select();
		$tid = $t[0]['tid'];
		$mark = number_format((input('pointV1')+input('pointV2')+input('pointV3'))/3,1);
		$vid_sel = Db::name('vmark')->where('tid',$tid)->select();
		if($vid_sel){
			$marknum = $vid_sel[0]['marknum'] + $mark;
			$usernum = $vid_sel[0]['usernum'] + 1;
			$ave = (float)number_format($marknum/$usernum,1);
			$data = [
				'marknum' => $marknum,
				'usernum' => $usernum,
				'ave'	  => $ave
			];
			$res = Db::name('vmark')->where('tid',$tid)->update($data);
			if($res){
				return true;
			}else{
				return false;
			}
		}else{
			$data = [
				'tid' => $tid,
				'marknum' => $mark,
				'usernum' => 1,
				'ave'	=> $mark
			];
			$res = Db::name('vmark')->insert($data);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}

	public function markSelect()
	{
		return Db::name('vmark')->select();
	}
	public function markOne()
	{
		$tid = input('tid');
		return Db::name('vmark')->where('tid',$tid)->select();
	}
}