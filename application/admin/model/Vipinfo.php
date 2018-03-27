<?php

namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;
class Vipinfo extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';
}