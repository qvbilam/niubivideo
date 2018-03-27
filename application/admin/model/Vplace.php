<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Vplace extends Model
{
	public function ajax()
	{
		return Db::name('vplace')->select();
	}
}