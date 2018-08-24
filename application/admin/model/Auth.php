<?php

namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Auth extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';

	public function addauth($data)
	{
		//查询板块是否存在
		$name =  Db::name('auth')->where('authname',$data['authname'])->find();
		if (!empty($name)) {
			return '板块名称存在';
		}

		//获取表最后一条id;
		$res = Db::name('auth')->order('id desc')->find();
		if ($data['level'] == 0) {
			$data['pid'] = 0;
			$data['path'] =$res['id']+1;
			$res = $this->allowField(true)->save($data);
			if($res == 1) {
				return '添加成功';
			} else {
				return '添加失败';
			}	
		} 	

		//获取父级权限信息
		$str = Db::name('auth')->where('authname',$data['pauthname'])->where('pid','0')->find();
		if ($str == false) {
			return '父级权限输入有误';
		}
		$data['pid'] = $str['id'];
		$data['path'] =$str['id'] . '-'. ($res['id'] + 1);
		$db = $this->allowField(true)->save($data);
		if($db == 1) {
			return '添加成功';
		} else {
			return '添加失败';
		}
	}

}
	