<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Vplace extends Model
{
	public function pname()
	{
		return Db::name('vplace')->select();
	}
}