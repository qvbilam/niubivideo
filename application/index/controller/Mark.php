<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Vmark;
class Mark extends Controller
{
	public function markAdd()
	{
		$ma = new Vmark();
		$mark = $ma->markAdd();
		if($mark){
			echo '评分成功哦';
		}else{
			echo '评分失败哦';
		}




		/*if($mark){
			echo '评分成功哦';
		}else{
			echo '评分失败哦';
		}*/
		//dump(input());
		//$a=$_SERVER['HTTP_REFERER'];
		//echo $a;
	}
}