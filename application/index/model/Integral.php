<?php

namespace app\idnex\model;
use thinl\Model;

class Integral extends Model
{
	public function Integralinfo ()
	{
		return $this->hasOne('Integralinfo','uid');
	}

	public function selejifen()
	{
		$res =  $this->where('uid',session('uid'))->select();
		$data = $this->Integralinfo->select();
	}
}