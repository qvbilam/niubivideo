<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Rold extends Model
{
	//查询权限列表
	public function left()
	{
		//查询权限位
		$fing = Db::name('rold')
			->where('id',session('rold_id'))
			->value('auth_ids');
		//判断是不是顶级权限
		if (session('rold_id') != 0) {
			$where1 = " live=0 and id in ($fing)";
			$where2 = " live=1 and id in ($fing)";
		} else {
			$where1 = " live=0 ";
			$where2 = " live=1 ";
		}
		//查询一级权限位
		$pinfo = Db::name('auth')
			->where($where1)
			->select();
		//查询次级权限位
		$sinfo = Db::name('auth')
			->where($where2)
			->select();
		return  [$pinfo,$sinfo];
	}


	//添加角色
	public function addrolds($data)
	{
		//判断角色名称是否存在
		$name = $this->where('roldname',$data['roldname'])->find();
		if (!empty($name)) {
			return "角色名称已存在";
		}
		//查询权限对应信息的拼接
		$data = $this->sertid($data);
		//插入数据		
		$sty = $this->allowField(true)->save($data);
		//判断是否插入成功
		if ($sty == 1) {
			return "角色添加成功";
		} else {
			return '角色添加失败';
		}	
	}

	//修改角色权限
	public function updatarolds($data)
	{	
		//判断是否是管理员
		if ($data['id'] == 1 ) {
			return '超级管理员无法修改';
		}
		//权限对应信息的拼接
		$data = $this->sertid($data);
		//修改角色数据
		$sty = $this->allowField(true)->save($data,['id'=>$data['id']]);
		if ($sty == 1) {
			return "角色权限修改成功";
		} else {
			return '角色权限修改失败';
		}	
		
	}

	//角色对应权限的拼接
	protected function sertid($data)
	{
		//查询权限对应的数据
		$res = Db::name('auth')->where('id' ,'in', $data['auth_ids'])->select();
		//拼接权限
		$arr = [];
		foreach ($res as $val ) {
			if (!empty($val['c']) && !empty($val['a'])) {
				$arr[] = $val['c'] . '-' . $val['a'];
			}			
		}
		$str = implode(',', $arr);
		//auth_ac 信息
		$data['auth_ac'] = $str;
		//auth_ids 信息
		$data['auth_ids'] = implode(',',$data['auth_ids']);
		return $data;
	}
}